
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pesquisa extends MY_Controller {


    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('tipoUsuarioID') != 1 && $this->session->userdata('tipoUsuarioID') != 2) {
            redirect(base_url() . 'login/saas', 'refresh');
        }
    $this->load->model('etapas/Etapas_model', 'etapas');
    $this->load->model('obras/Obras_model', 'obras');
    $this->load->model('importacao/Importacao_model', 'import');
    $this->load->model('template/Template_model', 'fil');
    $this->fil->setTable('dbfdata','dbfID');
    $this->load->model('template/Template_model', 'fil2');
    $this->fil2->setTable('dwgdata','dwgID');


    }




public function search()
    {
    $data['titulo']           = 'GedSteel - Pesquisa';

    if($this->session->userdata('tipoUsuarioID') == 1){
       $data['search'] = $this->etapas->get_search();
       //   array_push($this->import->get_search(), $data['search']);
        //   array_push($this->fil->get_search(), $data['search']);
        //    array_push($this->fil2->get_search(), $data['search']);
    }/*elseif($this->session->userdata('tipoUsuarioID') == 2){
       $data['search'] = $this->etapas->get_search();
    }elseif($this->session->userdata('tipoUsuarioID') == 3){
        $data['search'] = $this->etapas->get_search();
          array_push($this->import->get_proj_search(), $data['search']);
           array_push($this->fil->get_proj_search(), $data['search']);
            array_push($this->fil2->get_proj_search(), $data['search']);
    }elseif($this->session->userdata('tipoUsuarioID') == 4){
        $data['search'] = $this->etapas->get_search();
          array_push($this->import->get_rev_search(), $data['search']);
    }elseif($this->session->userdata('tipoUsuarioID') == 5){
        $data['search'] = null;
    }elseif($this->session->userdata('tipoUsuarioID') == 6){
        $data['search'] = null;
    }elseif($this->session->userdata('tipoUsuarioID') == 7){
        $data['search'] = $this->obras->get_client_search();
         array_push($this->etapas->get_client_search(), $data['search']);
    } */
    $data['pagina'] = 'search';
    $this->render($data, $data['pagina']);
    }


    private function render($data, $pagina)
    {
        $this->load->view('sistema/includes/header', $data, FALSE);
        $this->load->view('sistema/includes/menus-saas-adm', $data, FALSE);
        $this->load->view('sistema/paginas-saas/' . $pagina, $data, FALSE);
        $this->load->view('sistema/includes/footer', $data, FALSE);
    }
}