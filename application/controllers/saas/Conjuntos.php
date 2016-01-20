<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Conjuntos extends MY_Controller {
	public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('tipoUsuarioID') != 1 && $this->session->userdata('tipoUsuarioID') != 2) {
            redirect(base_url() . 'login/saas', 'refresh');
        }
        $this->load->model('template/Template_model', 'fil');
        $this->fil->setTable('dbfdata','dbfID');
        $this->load->model('template/Template_model', 'fil2');
        $this->fil2->setTable('dwgdata','dgwID');
        $this->load->model('importacao/Importacao_model', 'import');
        $this->load->library('FPDF');
    }


     public function listar()
    {
    	$this->load->model('template/Template_model', 'fil');
        $this->fil->setTable('dbfdata','dbfID');
        $data['dados'] = $this->DefineConjuntos();
        $data['titulo']    = 'Steel4Web - Perfil de Usuario';
        $pagina            = 'conjunto-view';
        $this->render($data, $pagina);
    }

    public function grds(){
        $data['titulo'] = 'Steel4Web - Administrador';
        $data['files'] = $this->import->get_dbfNames();
        $pagina = 'get-grd';
        $this->render($data, $pagina);
    }

    public function makeGrd($id){
        // $this->load->helper('url');
        $data['Pesos']      = $this->getPesosID($id);
        $data['Conjuntos']  = $this->DefineDesenhos($id);
        $data['Desenhos']   = $this->getNamesId($id);
        $getName            = $this->import->get_by_id($id);
        $Name = url_title($getName->name);
        if(isset($data['Conjuntos']))
            $this->makePdf($data['Desenhos'],$data['Conjuntos'],$data['Pesos'],$Name);
    }

    public function grd($id){
        $data['this_id']      = $id;
        $getName            = $this->import->get_by_id($id);
        $data['import']  = $getName;
        $data['nomeDBF']    = $getName->name;
        $data['Pesos']      = $this->getPesosID($id);
        $data['Conjuntos']  = $this->DefineDesenhos($id);
        $data['Desenhos']   = $this->getNamesId($id);
        $data['titulo']     = 'Steel4Web - Perfil de Usuario';
        $pagina             = 'desenho-view';

        $this->render($data, $pagina);
    }

    public function editTable(){
        $id = $this->input->post('id');
        $data = $this->input->post('data');
        $key = $this->input->post('key');
        dbugnd($id);
        dbugnd($data);
        dbug($key);
    }

    private function savedbf($dbfname) {
        $fdbf = fopen($dbfname,'r'); 
        $fields = array(); 
        $buf = fread($fdbf,32); 
        $header=unpack( "VRecordCount/vFirstRecord/vRecordLength", substr($buf,4,8));
        $goon = true; 
    $unpackString=''; 
    while ($goon && !feof($fdbf)) { // read fields: 
        $buf = fread($fdbf,32); 
        if (substr($buf,0,1)==chr(13)) {$goon=false;} // end of field list 
        else { 
            $field=unpack( "a11fieldname/A1fieldtype/Voffset/Cfieldlen/Cfielddec", substr($buf,0,18));
                $unpackString.="A$field[fieldlen]$field[fieldname]/"; 
                array_push($fields, $field);}} 
        fseek($fdbf, $header['FirstRecord']+1); // move back to the start of the first record (after the field definitions)
        for ($i=1; $i<=$header['RecordCount']; $i++) { 
            $buf = fread($fdbf,$header['RecordLength']); 
            $record=unpack($unpackString,$buf);
            $record['fileName'] =  $dbfname;
            $importID = $this->fil->insert($record);
        }
        fclose($fdbf); 
    } 

    private function DefineConjuntos($v2 = null){

    	$data['dados']   = $this->fil->get_all();
    	$conjuntos;
    	$Peso;
    	foreach($data['dados'] as $dado){
    		if($dado->FLG_REC === '03'){
    			$conjuntos[] = $dado;
    			$Peso[$dado->dbfID] = 0;
    		}
    	}
    	foreach ($conjuntos as $conj) {
    		foreach($data['dados'] as $dado2){
    		if($conj->MAR_PEZ == $dado2->MAR_PEZ && $dado2->FLG_REC === '04'){
    			$indice = $conj->dbfID;
    			$Peso[$conj->dbfID] = empty($Peso[$conj->dbfID]) ?  0 : $Peso[$conj->dbfID];
    			$Peso[$indice] += $dado2->PUN_LIS * $dado2->QTA_PEZ;
    		}
    	}
    	$Peso[$conj->dbfID] = $Peso[$conj->dbfID] * $conj->QTA_PEZ;
    	}
    	$y = 0;
    	foreach ($conjuntos as $conj) {
            if($v2){
            $dat[$y]['DES_PEZ']= str_replace('?','I',$conj->DES_PEZ);
            $dat[$y]['QTA_PEZ']=$conj->QTA_PEZ;
            $dat[$y]['PESO_QTA']=$Peso[$conj->dbfID] / $conj->QTA_PEZ;
            }
    		$dat[$y]['dbfID']=$conj->dbfID;
    		$dat[$y]['MAR_PEZ']=$conj->MAR_PEZ;
            $dat[$y]['FLG_DWG']=$conj->FLG_DWG;
    		$dat[$y]['peso']=$Peso[$conj->dbfID];
    		$y++;
    	}
    	return $dat;
    }

    public function desenhos(){
        $data['Pesos']      = $this->getPesos();
        $data['Conjuntos']  = $this->DefineDesenhos();
        $data['Desenhos']   = $this->getNames();
        $data['titulo']     = 'Steel4Web - Perfil de Usuario';
        $pagina             = 'desenho-view';

        $this->render($data, $pagina);
    }

    private function DefineDesenhos($id = null){
        if($id){
            $conjuntos = $this->DefineConjuntosId($id);
        }else{
            $conjuntos = $this->DefineConjuntos(true);
        }
        $desenhos   = $this->fil2->get_all();
        foreach ($desenhos as $des) {
            foreach($conjuntos as $conj){
                if($conj['FLG_DWG'] === substr($des->fileName,0,-4)){
                    $indice = substr($des->fileName,0,-4);
                    $Desenhos[$indice][] = $conj;
                }
            }
        }
        if(isset($Desenhos)){
            return $Desenhos;
        }
        else{
            return null;
        }
    }

     private function DefineConjuntosId($id){
        $data['dados']  = $this->fil->get_by_field( 'importID', $id);
        $conjuntos;
        $Peso;
        foreach($data['dados'] as $dado){
            if($dado->FLG_REC === '03'){
                $conjuntos[] = $dado;
                $Peso[$dado->dbfID] = 0;
            }
        }
        foreach ($conjuntos as $conj) {
            foreach($data['dados'] as $dado2){
            if($conj->MAR_PEZ == $dado2->MAR_PEZ && $dado2->FLG_REC === '04'){
                $indice = $conj->dbfID;
                $Peso[$conj->dbfID] = empty($Peso[$conj->dbfID]) ?  0 : $Peso[$conj->dbfID];
                $Peso[$indice] += $dado2->PUN_LIS * $dado2->QTA_PEZ;
            }
        }
        $Peso[$conj->dbfID] = $Peso[$conj->dbfID] * $conj->QTA_PEZ;
        }
        $y = 0;
        foreach ($conjuntos as $conj) {
            $dat[$y]['DES_PEZ']= str_replace('?','I',$conj->DES_PEZ);
            $dat[$y]['QTA_PEZ']=$conj->QTA_PEZ;
            $dat[$y]['PESO_QTA']=$Peso[$conj->dbfID] / $conj->QTA_PEZ;
            $dat[$y]['dbfID']=$conj->dbfID;
            $dat[$y]['MAR_PEZ']=$conj->MAR_PEZ;
            $dat[$y]['FLG_DWG']=$conj->FLG_DWG;
            $dat[$y]['peso']=$Peso[$conj->dbfID];
            $y++;
        }
        return $dat;
    }

    private function getPesos(){
        $conjuntos = $this->DefineConjuntos(true);
        $desenhos   = $this->fil2->get_all();
        $total = 0;
        $Desenhos = array();
        foreach ($desenhos as $des){
            $Desenhos[substr($des->fileName,0,-4)] = 0;
        }
        foreach ($desenhos as $des) {
            foreach($conjuntos as $conj){
                if($conj['FLG_DWG'] == substr($des->fileName,0,-4)){
                    $indice = substr($des->fileName,0,-4);
                    $Desenhos[$indice] += $conj['peso'];
                    $total += $conj['peso'];
                }
            }
        }
        $Desenhos['total'] = $total;
        return $Desenhos;
    }


    private function getPesosID($id){
        $conjuntos = $this->DefineConjuntosId($id);
        $desenhos   = $this->fil2->get_by_field( 'importID', $id);
        $total = 0;
        $Desenhos = array();
        foreach ($desenhos as $des){
            $Desenhos[substr($des->fileName,0,-4)] = 0;
        }
        foreach ($desenhos as $des) {
            foreach($conjuntos as $conj){
                if($conj['FLG_DWG'] == substr($des->fileName,0,-4)){
                    $indice = substr($des->fileName,0,-4);
                    $Desenhos[$indice] += $conj['peso'];
                    $total += $conj['peso'];
                }
            }
        }
        $Desenhos['total'] = $total;
        return $Desenhos;
    }

    private function getNames(){
        $desenhos   = $this->fil2->get_all_order();
        foreach ($desenhos as $des) {
            $data[] = substr($des->fileName,0,-4);
        }
        return $data;
    }

     private function getNamesId($id){

        $desenhos   = $this->fil2->get_by_field_order( 'importID', $id);
        foreach ($desenhos as $des) {
            $data[] = substr($des->fileName,0,-4);
        }
        if(isset($data)){
            return $data;
        }else{
            return null;
        }
        
    }

    private function rrmdir($dir) { 
   if (is_dir($dir)) { 
     $objects = scandir($dir); 
     foreach ($objects as $object) { 
       if ($object != "." && $object != "..") { 
         if (filetype($dir."/".$object) == "dir") rrmdir($dir."/".$object); else unlink($dir."/".$object); 
       } 
     } 
     reset($objects); 
     rmdir($dir); 
   } 
} 

    private function makePdf($Desenhos, $Conjuntos, $Pesos, $naome){
        define('FPDF_FONTPATH', "./assets/template/font/");
        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->Image(base_url('assets/template/img/logo-Steel4web-600.png'),10,6,30);
        $pdf->Ln(4);
        $pdf->SetFont('Arial','',12);
        $w = array(50, 30, 50, 14, 23, 23);
        $cabeca = array('Projeto', 'Empresa', 'Responsavel','Vrs','Contr.', 'Data');
        $content = array('GR0-00f3', 'Vipal', 'Vitor Lima','01','Web3d', '20/01/2016');

        for($i=0;$i<count($cabeca);$i++)
        $pdf->Cell($w[$i],8,$cabeca[$i],1,0,'C');
         $pdf->Ln();
         $pdf->SetFont('Arial','',8);
         for($i=0;$i<count($cabeca);$i++)
        $pdf->Cell($w[$i],6,$content[$i],1,0,'C');
        $pdf->Ln(20);
         $pdf->SetFont('Arial','',14);
        $header = array('Desenho', 'Tipologia', 'Peso Total(KG)');
        $total = array('TOTAL GRD', '-', $Pesos['total']);
        $data = array('Desenho', 'Conjunto', 'Tipologia', 'Quantidade', 'Peso Unid.(Kg)', 'Peso Total(Kg)');
        $w2 = array(50, 80, 60);
        $pdf->SetLineWidth(.3);
        for($i=0;$i<count($header);$i++)
        $pdf->Cell($w2[$i],8,$header[$i],1,0,'C');
        $pdf->Ln();
        $pdf->SetFont('Arial','B',12);
        for($i=0;$i<count($total);$i++)
         $pdf->Cell($w2[$i],6,$total[$i],'LRB',0,'C');
         $pdf->Ln();
        foreach($Desenhos as $des){
            $pdf->SetFont('Arial','B',10);

          //  $pdf->SetTextColor(46,46,135);
            $dese = array($des, $Conjuntos[$des][0]['DES_PEZ'],$Pesos[$des]);
            for($i=0;$i<count($dese);$i++)
                $pdf->Cell($w2[$i],6,$dese[$i],'LRB',0,'C');
                 $pdf->Ln();
        /*         $pdf->SetFont('Arial','',10);
                 $pdf->SetTextColor(0,0,0);
            foreach($Conjuntos as $conju){
                foreach($conju as $conj){
                    if($conj['FLG_DWG'] == $des){
                        $pdf->Cell($w[0],6,$conj['FLG_DWG'],'LRB',0,'C');
                        $pdf->Cell($w[1],6,$conj['MAR_PEZ'],'LRB',0,'C');
                        $pdf->Cell($w[2],6,$conj['DES_PEZ'],'LRB',0,'C');
                        $pdf->Cell($w[3],6,$conj['QTA_PEZ'],'LRB',0,'C');
                        $pdf->Cell($w[4],6,$conj['PESO_QTA'],'LRB',0,'C');
                        $pdf->Cell($w[5],6,$conj['peso'],'LRB',0,'C');
                        $pdf->Ln();
                    }
                }
            } */
        }
        $NamePdf = $naome.'.pdf';
        $pdf->Cell(array_sum($w),0,'','T');
         $pdf->Output('D',$NamePdf);
}

    private function render($data, $pagina)
    {
        $this->load->view('sistema/includes/header', $data, FALSE);
        $this->load->view('sistema/includes/menus-saas-adm', $data, FALSE);
        $this->load->view('sistema/paginas-saas/' . $pagina, $data, FALSE);
        $this->load->view('sistema/includes/footer', $data, FALSE);
    }
}