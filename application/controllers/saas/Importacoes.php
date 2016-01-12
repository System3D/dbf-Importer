<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Importacoes extends MY_Controller {


    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('tipoUsuarioID') != 1 && $this->session->userdata('tipoUsuarioID') != 2) {
            redirect(base_url() . 'login/saas', 'refresh');
        }
        $Path =  "C:/xampp/htdocs/s4w/arquivos/";
        if (!file_exists($Path) && !is_dir($Path)):
            mkdir($Path, 0777);
        endif;

        $this->load->model('importacao/Importacao_model', 'import');
        $this->load->model('template/Template_model', 'fil');
        $this->fil->setTable('dbfdata','dbfID');
        $this->load->model('template/Template_model', 'fil2');
        $this->fil2->setTable('dwgdata','dwgID');

        // $sections = array(
        //              'config'  => TRUE,
        //              'queries' => TRUE
        //              );
        // $this->output->set_profiler_sections($sections);
        // $this->output->enable_profiler(TRUE);
    }

   public function listar($subEtapaID)
    {
        $data['titulo'] = 'Steel4Web - Administrador';
        $data['dados'] = $this->import->get_dados($subEtapaID);

        $data['importacoes'] = $this->import->get_by_field('subetapaID', $subEtapaID);

        $pagina = 'importacoes-cadastro';
        $this->render($data, $pagina);
    } 

    public function dbf()
    {
        $data['titulo'] = 'Steel4Web - Administrador';

        $pagina = 'importacoes-dbf';
        $this->render($data, $pagina);
    } 

    public function dwg()
    {
        $data['titulo'] = 'Steel4Web - Administrador';
        $data['files'] = $this->import->get_dbfNames();
        $pagina = 'importacoes-dwg';
        $this->render($data, $pagina);
    } 

    public function listar_all()
    {
        $data['titulo'] = 'Steel4Web - Administrador';

        $data['dados'] = $this->import->get_all_list();
        $d = 0;
        foreach($data['dados'] as $dado){
          
            $names = $this->import->get_names($dado->subetapaID);
            $data['import'][] = $names; 
            $data['import'][$d]->arquivo = $dado->arquivo;
            $data['import'][$d]->obraID = $dado->obraID; 
            $data['import'][$d]->etapaID = $dado->etapaID; 
            $data['import'][$d]->subetapaID = $dado->subetapaID; 
            $data['import'][$d]->clienteID = $dado->clienteID; 
            $data['import'][$d]->path = $dado->path.$dado->arquivo; 
            $d++;
        }
        $pagina = 'importacoes-listar';
        $this->render($data, $pagina);
    } 

    public function gravardwg(){
        if(empty($this->input->post('filename'))){
            redirect("saas/importacoes/dwg", 'refresh');
        }
        $file = $this->input->post('filename');
        $data['titulo'] = 'Steel4Web - Administrador';
    //    $data['check'] =  $this->checkfiles($file);
        $data['dados'] = $this->import->get_conjuntos($file);
        $data['files'] = $this->get_dwgs($file);
        $data['dbfFile'] = $file;
        $pagina = 'cadastro-dwg';
        $this->render($data, $pagina);

    }

     private function checkfiles($file){
        $check = array();
        $fil = explode('/', $file);
        $fil=end($fil);
        $files = $this->fil2->get_by_field('dbfName', $fil, $limit = null);
      //  dbug($files);
        $conjuntos = $this->import->get_conjuntos($file);
        foreach($conjuntos as $conj){
            foreach($files as $fill){
                if($conj->FLG_DWG == substr($files->fileName,0,-4)){
                    $check[] = $conj->FLG_DWG;
                }
            }
        }
        return $files;
    }

    private function get_dwgs($file){
        $file = explode('/', $file);
        $file=end($file);
        $files = $this->fil2->get_by_field('dbfName', $file, $limit = null);
        return $files;
    }

    public function gravardbf(){
        $log = 'Importação de banco DBF - Usuario: ' . $this->session->userdata['nomeUsuario'] . ' - IP: ' . $this->input->ip_address();
        $this->logs->gravar($log);

        $Path =  "C:/xampp/htdocs/s4w/arquivos/";
        if(!empty($this->input->post('observacoes'))){
            $observacoes = $this->input->post('observacoes');
        }else{
            $observacoes = null;
        }

        // Pasta onde o arquivo vai ser salvo
        $_UP['pasta'] = $Path;
        // Tamanho máximo do arquivo (em Bytes)
        $_UP['tamanho'] = 1024 * 1024 * 10; // 10Mb
        // Array com as extensões permitidas
        $_UP['extensoes'] = array('dbf', 'DBF');
        // Renomeia o arquivo? (Se true, o arquivo será salvo como .jpg e um nome único)
        $_UP['renomeia'] = false;
        // Array com os tipos de erros de upload do PHP
        $_UP['erros'][0] = 'Não houve erro';
        $_UP['erros'][1] = 'O arquivo no upload é maior do que o limite do PHP';
        $_UP['erros'][2] = 'O arquivo ultrapassa o limite de tamanho especifiado no HTML';
        $_UP['erros'][3] = 'O upload do arquivo foi feito parcialmente';
        $_UP['erros'][4] = 'Não foi feito o upload do arquivo';

        $Folder = 'dbf';

        try {
            if(empty($_FILES['dbf'])){
                $data['erro'] = 'Erro ao importar: ' . "Favor envie arquivo DBF!";
                $this->session->set_flashdata('danger', $data['erro']);
                redirect("saas/importacoes/dbf", 'refresh');
            }else{
                $file = $_FILES['dbf'];
            }

            if(empty($file['name'])){
                $data['erro'] = 'Erro ao importar: ' . "Favor envie arquivo dbf com nome valida!";
                $this->session->set_flashdata('danger', $data['erro']);
                redirect("saas/importacoes/dbf", 'refresh');
            }

            list($fileName, $extensao) = explode('.', $file['name']);
            $extensao = strtolower($extensao);

            if (array_search($extensao, $_UP['extensoes']) === false) {
              $data['erro'] = 'Erro ao importar: ' . "Favor envie arquivo com a seguinte extensão: dbf(.DBF).";
                $this->session->set_flashdata('danger', $data['erro']);
                redirect("saas/importacoes/dbf", 'refresh');
            }

            if ($_UP['tamanho'] < $file['size']){
                $data['erro'] = 'Erro ao importar: ' . "Favor envie arquivo com no maximo 10mb!";
                $this->session->set_flashdata('danger', $data['erro']);
                redirect("saas/importacoes/dbf", 'refresh');
            }

            list($y, $m) = explode('/', date('Y/m'));
            $this->import->CreateFolder("{$Folder}");
            $this->import->CreateFolder("{$Folder}/{$y}");
            $this->import->CreateFolder("{$Folder}/{$y}/{$m}/");
            $this->import->CreateFolder("{$Folder}/{$y}/{$m}/{$fileName}");
            $Path =  $Path . "{$Folder}/{$y}/{$m}/{$fileName}/";

            $html = "<html><head><title>403 Forbidden</title></head><body><p>Directory access is forbidden.</p></body></html>";

            $arquivoIndex = $Path . "index.html";
            

            if(!file_exists($arquivoIndex)):
                file_put_contents($arquivoIndex, $html);
            endif;

            

            $nome_final = $file['name'];
            $fullPath = $Path.$nome_final;

                    if (!move_uploaded_file($file['tmp_name'], $Path . $nome_final)) {
                        $data['erro'] = 'Erro ao persistir na pasta';
                        $this->session->set_flashdata('danger', $data['erro']);
                         redirect("saas/importacoes/dbf", 'refresh');
                    } else {
                    $verify = $this->savedbf($fullPath,$observacoes);
                    if (!$verify) {
                        $arquivoParaDeletar = $fullPath;
                        unset($arquivoParaDeletar);
                        $data['erro'] = 'Erro ao Cadastrar Dados no Banco.';
                        $this->session->set_flashdata('danger', $data['erro']);
                        redirect("saas/importacoes/dbf", 'refresh');
                    }else{
                        $data['success'] = 'Importação realizada com sucesso!';
                        $this->session->set_flashdata('success', $data['success']);
                        redirect("saas/importacoes/dbf", 'refresh');
                    }
                }

        } catch (Exception $e) {
            $data['erro'] = 'Erro ao importar: ' . $e->getMessage();
            $this->session->set_flashdata('danger', $data['erro']);
            redirect("saas/importacoes/listar/$subEtapaID", 'refresh');
        }

    }

    private function savedbf($dbfname,$observacoes) {
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
            $record['observacoes'] =  $observacoes;
            $record['fileName'] =  $dbfname;
            $importID = $this->fil->insert($record);
        }
        if(!empty($importID)){
            return true;
        }else return false;
        fclose($fdbf); 
    }


public function cadastrardwg(){

    $file = $_FILES['dwg'];

    $log = 'Importação de desenhos DWG - Usuario: ' . $this->session->userdata['nomeUsuario'] . ' - IP: ' . $this->input->ip_address();
    $this->logs->gravar($log);

    if(!empty($this->input->post('observacoes'))){
        $observacoes = $this->input->post('observacoes');
    }else{
        $observacoes = null;
    }

    $fullPath = $this->input->post('fileName');
    $expath = explode('/', $fullPath);
    $dbfName = end($expath);
    $dbfcount = -1 * strlen($dbfName);
    $Path = substr($fullPath, 0, $dbfcount);

    // Pasta onde o arquivo vai ser salvo
    $_UP['pasta'] = $Path;
    // Tamanho máximo do arquivo (em Bytes)
    $_UP['tamanho'] = 1024 * 1024 * 10; // 10Mb
    // Array com as extensões permitidas
    $_UP['extensoes'] = array('dwg', 'DWG');

      $tamanhoArray = count($_FILES['dwg']['name']);
      
        for($d=0;$d<$tamanhoArray;$d++){
        list($fileName, $extensao) = explode('.', $file['name'][$d]);
        $extensao = strtolower($extensao);

        

        if (array_search($extensao, $_UP['extensoes']) === false) {
          $data['erro'] = 'Erro ao importar: ' . "Favor envie arquivo com a seguinte extensão: dwg(.dwg).";
            $this->session->set_flashdata('danger', $data['erro']);
            redirect("saas/importacoes/dwg", 'refresh');
        }

        if ($_UP['tamanho'] < $file['size'][$d]){
            $data['erro'] = 'Erro ao importar: ' . "Favor envie arquivo com no maximo 10mb!";
            $this->session->set_flashdata('danger', $data['erro']);
            redirect("saas/importacoes/dwg", 'refresh');
        }

        $nome_final = $this->Name($fileName).'.'.$extensao;
        $fullPath = $Path.$nome_final;

                if (!move_uploaded_file($file['tmp_name'][$d], $Path . $nome_final)) {
                    $data['erro'] = 'Erro ao persistir na pasta';
                    $this->session->set_flashdata('danger', $data['erro']);
                     redirect("saas/importacoes/dwg", 'refresh');
                } else {
                $dwgData = array('fileName' => $file['name'][$d], 
                                 'dbfName' => $dbfName, 
                                 'path' => $fullPath
                                 );
                $verify = $this->fil2->insert($dwgData);
                if (!$verify) {
                    $arquivoParaDeletar = $fullPath;
                    unset($arquivoParaDeletar);
                    $data['erro'] = 'Erro ao Cadastrar Dados no Banco.';
                    $this->session->set_flashdata('danger', $data['erro']);
                    redirect("saas/importacoes/dwg", 'refresh');
                }
            }
        }
            $data['success'] = 'Importação realizada com sucesso!';
            $this->session->set_flashdata('success', $data['success']);
            redirect("saas/importacoes/dwg", 'refresh');
    }



    private function render($data, $pagina)
    {
        $this->load->view('sistema/includes/header', $data, FALSE);
        $this->load->view('sistema/includes/menus-saas-adm', $data, FALSE);
        $this->load->view('sistema/paginas-saas/' . $pagina, $data, FALSE);
        $this->load->view('sistema/includes/footer', $data, FALSE);
    }

    private static function Name($Name) {
        $Format = array();
        $Format['a'] = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜüÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿRr"!@#$%&*()_-+={[}]/?;:.,\\\'<>°ºª';
        $Format['b'] = 'aaaaaaaceeeeiiiidnoooooouuuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr                                 ';

        $Data = strtr(utf8_decode($Name), utf8_decode($Format['a']), $Format['b']);
        $Data = strip_tags(trim($Data));
        $Data = str_replace(' ', '-', $Data);
        $Data = str_replace(array('-----', '----', '---', '--'), '-', $Data);

        return strtolower(utf8_encode($Data));
    }

}