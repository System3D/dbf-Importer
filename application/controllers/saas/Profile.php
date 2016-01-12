<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends MY_Controller {
	public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('tipoUsuarioID') != 1 && $this->session->userdata('tipoUsuarioID') != 2) {
            redirect(base_url() . 'login/saas', 'refresh');
        }
        $this->load->model('profile/Profile_model', 'profile');
    }

    public function editar()
    {
        $this->load->model('enderecos/Enderecos_model', 'end');
        
        $data['titulo']    = 'Steel4Web - Editar Perfil';
        $pagina            = 'usuario-profile';
        $data['usuario']   = $this->profile->get_user();
        $data['usuario']->tipoUsuario   = $this->profile->get_role($data['usuario']->tipoUsuarioID);
        $data['edicao'] = true;

        $this->render($data, $pagina);
    }

    public function ver()
    {
    	$this->load->model('locatarios/Locatarios_model', 'loc');
        $data['titulo']    = 'Steel4Web - Perfil de Usuario';
        $pagina            = 'usuario-profile';
        $data['usuario']   = $this->profile->get_user();
        $data['usuario']->tipoUsuario   = $this->profile->get_role($data['usuario']->tipoUsuarioID);
        $locatarioDados    = $this->loc->get_by_id($data['usuario']->locatarioID);
        $data['usuario']->empregador = $locatarioDados->fantasia;

        $this->render($data, $pagina);
    }

    private function render($data, $pagina)
    {
        $this->load->view('sistema/includes/header', $data, FALSE);
        $this->load->view('sistema/includes/menus-saas-adm', $data, FALSE);
        $this->load->view('sistema/paginas-saas/' . $pagina, $data, FALSE);
        $this->load->view('sistema/includes/footer', $data, FALSE);
    }
}
?>