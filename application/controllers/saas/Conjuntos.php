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
    }

     public function dbfhandler()
    {
        $data['titulo'] = 'Steel4Web - Administrador';
        $pagina = 'conjunto-view';
        $this->savedbf('C:/xampp/htdocs/dev_s4w/arquivos/2/8/4/15/52/4/PIPE2.DBF');
      //  $this->render($data, $pagina);
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

    public function grd($id){
        $data['Pesos']      = $this->getPesosID($id);
        $data['Conjuntos']  = $this->DefineDesenhos($id);
        $data['Desenhos']   = $this->getNames();
        $data['titulo']     = 'Steel4Web - Perfil de Usuario';
        $pagina             = 'desenho-view';

        $this->render($data, $pagina);
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
    			empty($Peso[$conj->dbfID]) ?? 0;
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
        return $Desenhos;
    }

     private function DefineConjuntosId($id){
        $filname = $this->fil->get_by_id($id);
        $name = $filname->fileName;

        $data['dados']  = $this->fil->get_by_field( 'fileName', $name);
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
                empty($Peso[$conj->dbfID]) ?? 0;
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
        dbug($Desenhos);
        return $Desenhos;
    }

    |||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||

    private function getPesosID($id){
        $conjuntos = $this->DefineConjuntosId($id);
        $filname = $this->fil->get_by_id($id);
        $name = explode('/',$filname->fileName);

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
        dbug($Desenhos);
        return $Desenhos;
    }

    private function getNames(){
        $desenhos   = $this->fil2->get_all();
        foreach ($desenhos as $des) {
            $data[] = substr($des->fileName,0,-4);
        }
        return $data;
    }

    private function render($data, $pagina)
    {
        $this->load->view('sistema/includes/header', $data, FALSE);
        $this->load->view('sistema/includes/menus-saas-adm', $data, FALSE);
        $this->load->view('sistema/paginas-saas/' . $pagina, $data, FALSE);
        $this->load->view('sistema/includes/footer', $data, FALSE);
    }
}