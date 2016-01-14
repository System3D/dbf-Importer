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
        $data['files'] = $this->import->get_dbfNames();
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

    public function editardwg(){
        
        $file = $_FILES['dwg'];
        $dwgID = $this->input->post('dwgID');
        $dbfID = $this->input->post('dbfID');
        $dgw = $this->fil2->get_by_id($dwgID);
            $_UP['tamanho'] = 1024 * 1024 * 10; 
            $_UP['extensoes'] = array('dwg', 'DWG');
            list($fileName, $extensao) = explode('.', $file['name']);
            $extensao = strtolower($extensao);

             if (array_search($extensao, $_UP['extensoes']) === false) {
              $data['erro'] = 'Erro ao importar: ' . "Favor envie arquivo com a seguinte extensão: dwg(.dwg).";
                $this->session->set_flashdata('danger', $data['erro']);
                redirect("saas/importacoes/gravardwg/".$dbfID, 'refresh');
            }

            if ($_UP['tamanho'] < $file['size']){
                $data['erro'] = 'Erro ao importar: ' . "Favor envie arquivo com no maximo 10mb!";
                $this->session->set_flashdata('danger', $data['erro']);
                 redirect("saas/importacoes/gravardwg/".$dbfID, 'refresh');
            }

            $Path = explode('/',$dgw->path);
            array_pop($Path);
            $Path = implode('/',$Path);
            $Path = $Path.'/';
            $nome_final = $fileName.'.'.$extensao;

            $verify = $this->fil2->get_by_field('path', $Path . $nome_final);
           if($verify){
                $this->session->set_flashdata('danger', "O Desenho <strong>". substr($dgw->fileName,0,-4)."</strong> ja esta cadastrado!");
                redirect("saas/importacoes/gravardwg/".$dbfID, 'refresh');
           }else{

            if (!move_uploaded_file($file['tmp_name'], $Path . $nome_final)) {
                    $data['erro'] = 'Erro ao persistir na pasta';
                    $this->session->set_flashdata('danger', $data['erro']);
                     redirect("saas/importacoes/gravardwg/".$dbfID, 'refresh');
                } else {
                unlink($dgw->path);
                $dwgData = array('fileName' => $nome_final, 
                                 'dbfName' => $dgw->dbfName, 
                                 'path' => $Path . $nome_final
                                 );
                $veryf = $this->fil2->update($dwgID, $dwgData);
                $log = 'Edicão de desenho DWG - Usuario: ' . $this->session->userdata['nomeUsuario'] . ' - IP: ' . $this->input->ip_address(). " - Troca: ". $dgw->fileName.' por '.$nome_final;
                $this->logs->gravar($log);
                $this->session->set_flashdata('success', "Desenho <strong>". $dgw->fileName ."</strong> foi substituido por <strong>". $nome_final ."</strong> com sucesso.");
                redirect("saas/importacoes/gravardwg/".$dbfID, 'refresh');
        } 
      }
    }

    public function excluirdwg($ids){
        list($idDWG, $idDBF) = explode('and', $ids);
        $dgw = $this->fil2->get_by_id($idDWG);
        if(!is_dir($dgw->path) && is_file($dgw->path)){
           if(unlink($dgw->path)){
                $dgg = $this->fil2->delete($idDWG);
                 $log = 'Exclusão de desenho DWG - Usuario: ' . $this->session->userdata['nomeUsuario'] . ' - IP: ' . $this->input->ip_address().' - Desenho: '.$dgw->fileName;
                $this->logs->gravar($log);
                $this->session->set_flashdata('success', "Desenho <strong>". substr($dgw->fileName,0,-4) ."</strong> removido com sucesso!");
                redirect("saas/importacoes/gravardwg/".$idDBF, 'refresh');
            }else{
                $this->session->set_flashdata('danger', "Erro ao Remover Desenho <strong>". substr($dgw->fileName,0,-4)."</strong>");
                end();
                redirect("saas/importacoes/gravardwg/".$idDBF, 'refresh');
            }
        }
    }

    public function excluirdbf($id){
        $dbf = $this->fil->get_by_id($id);
        $folder = explode('/',$dbf->fileName);
        $dbfName = array_pop ($folder);
        $folder = implode('/', $folder);
        $del = $this->fil2->delete_field('dbfName', $dbfName);
        $del = $this->fil->delete_field('fileName', $dbf->fileName);
        $this->rrmdir($folder);
        $log = 'Exclusão de banco DBF - Usuario: ' . $this->session->userdata['nomeUsuario'] . ' - IP: ' . $this->input->ip_address().' - Banco: '.$dbfName;
        $this->logs->gravar($log);
        $this->session->set_flashdata('success', "Banco <strong>". $dbfName."</strong> removido com sucesso!");
        redirect("saas/importacoes/dbf", 'refresh');
    }

    public function gravardwg($fileID){
        
        $file = $this->import->getFileName($fileID);
        $data['IDfil'] = $fileID;
        $data['titulo'] = 'Steel4Web - Administrador';
        $check =  $this->checkfiles($file);
        $data['status'] =  $this->statusCheck($check);
        $data['check'] = $this->checkHandler($check, $data['status']);
        $data['dados'] = $this->import->get_conjuntos($file);
        $data['files'] = $this->get_dwgs($file);
        $data['dbfFile'] = $file;
        $pagina = 'cadastro-dwg';
        $this->render($data, $pagina);

    }

     private function checkfiles($file){
        $cont = 0;
        $nont = 0;
        $sobra = array();
        $missing = array();
        $in_system = array();
        $check = array();
        $fil = explode('/', $file);
        $fil=end($fil);
        $files = $this->fil2->get_by_field('dbfName', $fil, $limit = null);
        $conjuntos = $this->import->get_conjuntos($file);
        foreach($conjuntos as $conj){
            if(!in_array($conj->FLG_DWG, $check)){
                $check[] = $conj->FLG_DWG;
            }
        }
        foreach($files as $fil){
            $in_system[] = substr($fil->fileName,0,-4);
        }
        for($x=0;$x<count($in_system);$x++){
            if(in_array($in_system[$x], $check)){
                $cont++;
            }else{
                $sobra[] =  $in_system[$x];
            }
        }
        if($cont == count($check) && empty($sobra[0])){
            return 1;
        }else{
            if(count($in_system) > 0){
                for($x=0;$x<count($check);$x++){
                   if(in_array($check[$x], $in_system)){
                        $nont++;
                    }else{
                        $missing[] =  $check[$x];
                    }
            }
            }else{
                $check[count($check) + 1] = "missing";
                return $check;
            }
            if(count($sobra) > 0 && count($missing) == 0){
              $sobra[] = "sobra";
              return $sobra;
            }elseif(count($sobra) == 0 && count($missing) > 0){
                $missing[count($missing) + 1] = "missing";
                return $missing;
            }else{
                $retorno = implode('&d&', $missing);
                $retorno .= "&b&";
                $retorno  .= implode('&d&', $sobra);
                return $retorno;
            }
        } 
    }

    private function statusCheck($check){
        if($check == 1){
            return 1;
        }elseif(is_array($check)){
            if(end($check) == "sobra"){
                return 2;
            }elseif(end($check) == "missing"){
                return 3;
            }
        }else{
            return 4;
        }
    }
    
    private function checkHandler($check, $status){
        if($status == 1){
            return 1;
        }elseif($status == 2 || $status == 3){
            array_pop($check);
            return $check;
        }else{
            return $check;
        }
    }

    private function get_dwgs($file){
        $file = explode('/', $file);
        $file=end($file);
        $files = $this->fil2->get_by_field('dbfName', $file, $limit = null);
        return $files;
    }

    public function gravardbf(){
        

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

            $veryr = $this->fil->get_by_field('fileName', $fullPath);
            if($veryr){
                $this->session->set_flashdata('danger', "O Arquivo <strong>". $file['name'] ."</strong> ja esta cadastrado!");
                redirect("saas/importacoes/dbf", 'refresh');
            }

                    if (!move_uploaded_file($file['tmp_name'], $Path . $nome_final)) {
                        $data['erro'] = 'Erro ao persistir na pasta';
                        $this->session->set_flashdata('danger', $data['erro']);
                         redirect("saas/importacoes/dbf", 'refresh');
                    } else {
                    $verify = $this->savedbf($fullPath,$observacoes);

                    if (!$verify) {
                        $arquivoParaDeletar = $fullPath;
                        unset($arquivoParaDeletar);
                        $data['erro'] = 'Erro ao Cadastrar Dados no Banco(certifique-se de que o seu arquivo .DBF segue o padrão Tecnometal.).';
                        $this->session->set_flashdata('danger', $data['erro']);
                        redirect("saas/importacoes/dbf", 'refresh');
                    }else{
                        $log = 'Importação de banco DBF - Usuario: ' . $this->session->userdata['nomeUsuario'] . ' - IP: ' . $this->input->ip_address()." - Banco: ".$file['name'];
                        $this->logs->gravar($log);
                        $data['success'] = 'Importação de DBF realizada com sucesso!';
                        $this->session->set_flashdata('success', $data['success']);
                        redirect("saas/importacoes/gravardwg/".$verify, 'refresh');
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
            $record['locatarioID'] = $this->session->userdata('locatarioID');
            if(isset($record['X']))
                return false;
            $importID = $this->fil->insert($record);
        }
        if(!empty($importID)){
            return  $importID;
        }else return false;
        fclose($fdbf); 
    }


public function cadastrardwg(){

    $file = $_FILES['dwg'];
    
    $observacoes = $this->input->post('observacoes');

    $upled = array();
    $fullPath = $this->input->post('fileName');
    $IDfil = $this->input->post('fileID');
    $togo = "gravardwg/".$IDfil;
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
            $upled[$d] = "NO&Erro ao fazer upload de <strong>".$file['name'][$d]."</strong>&Favor envie arquivo com a seguinte extensão: dwg(.dwg).";
        }else{

        if ($_UP['tamanho'] < $file['size'][$d]){
            $upled[$d] = "NO&Erro ao fazer upload de <strong>".$file['name'][$d]."</strong>&Favor envie arquivo com no maximo 10mb.";
        }else{

        $nome_final = $fileName.'.'.$extensao;
        $fullPath = $Path.$nome_final;
        $veryr = $this->fil2->get_by_field('path',  $fullPath);
        if($veryr){
            $upled[$d] = "NO&Erro ao fazer upload de <strong>".$file['name'][$d]."</strong>&Arquivo ja Cadastrado.";
        }else{

                if (!move_uploaded_file($file['tmp_name'][$d], $Path . $nome_final)) {
                    $upled[$d] = "NO&Erro ao fazer upload de <strong>".$file['name'][$d]."</strong>&Erro ao persistir na pasta.";
                } else {
                $dwgData = array('fileName' => $nome_final, 
                                 'dbfName' => $dbfName, 
                                 'path' => $fullPath,
                                 'observacoes' =>  $observacoes,
                                  'locatarioID' => $this->session->userdata('locatarioID')
                                 );
                $verify = $this->fil2->insert($dwgData);
                 $log = 'Importação de desenhos DWG - Usuario: ' . $this->session->userdata['nomeUsuario'] . ' - IP: ' . $this->input->ip_address(). " - Desenho: ". $nome_final;
                 $this->logs->gravar($log);
                if (!$verify) {
                    $arquivoParaDeletar = $fullPath;
                    unset($arquivoParaDeletar);
                    $upled[$d] = "NO&Erro ao fazer upload de <strong>".$file['name'][$d]."</strong>&Erro ao Cadastrar Dados no Banco.";
                }else{
                    $upled[$d]="YES&Sucesso!&<strong>".$file['name'][$d]."</strong> Cadastrado com Sucesso.";
                }
              }
            }
          }
        }
    }
            $this->session->set_flashdata('message', $upled);
            redirect("saas/importacoes/".$togo, 'refresh');
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

}