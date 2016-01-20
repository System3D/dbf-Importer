<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        // $sections = array(
        //              'config'  => TRUE,
        //              'queries' => TRUE
        //              );
        // $this->output->set_profiler_sections($sections);
        // $this->output->enable_profiler(TRUE);
    }

    public function index()
    {
        
        $this->load->helper('text');
        $data['titulo']           = 'GedSteel - Administrador';
        $data['pagina']           = 'dash-admin';
        $this->render($data);
    }


    private function render($data)
    {
        $this->load->view('sistema/includes/header', $data, FALSE);
        $this->load->view('sistema/includes/menus-saas-adm', $data, FALSE);
        $this->load->view('sistema/paginas-saas/dash-admin', $data, FALSE);
        $this->load->view('sistema/includes/footer', $data, FALSE);
    }

    
}