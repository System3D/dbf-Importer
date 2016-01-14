<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('tipoUsuarioID') != 1) {
            redirect(base_url() . 'login/saas', 'refresh');
        }
        $this->load->model('usuarios/Usuarioslocatarios_model', 'locUser');
    }

    public function listar()
    {
        $data['titulo'] = 'GedSteel - Listar Usuários';
        $pagina = 'usuarios-listar';
        $data['locatariosUsuarios'] = $this->locUser->get_all();
        $this->render($data, $pagina);
    }

    public function cadastrar()
    {
        $data['titulo'] = 'GedSteel - Cadastrar Usuário';
        $pagina = 'usuario-cadastro';
        $this->render($data, $pagina);
    }

    public function editar($id)
    {
        $data['titulo'] = 'GedSteel - Editar Usuário';
        $pagina = 'usuario-cadastro';
        $data['usuarioLocatarioID'] = strip_tags(trim($id));
        $data['usuarioLocatario'] = $this->locUser->get_by_id($data['usuarioLocatarioID']);
        if (!$data['usuarioLocatario']) {
            redirect('saas/usuarios/listar/' . $this->session->userdata('locatarioID'));
        }
        $data['edicao'] = true;
        $this->render($data, $pagina);
    }

    public function ver($id)
    {
        $data['titulo'] = 'GedSteel - Perfil Usuário';
        $pagina = 'usuario-cadastro';
        $data['usuarioLocatarioID'] = strip_tags(trim($id));
        $data['usuarioLocatario'] = $this->locUser->get_by_id($data['usuarioLocatarioID']);
        if (!$data['usuarioLocatario']) {
            redirect('saas/usuarios/listar/' . $this->session->userdata('locatarioID'));
        }
        $data['edicao'] = true;
        $data['disable'] = true;
        $this->render($data, $pagina);
    }

    public function gravar()
    {
        header('Access-Control-Allow-Origin: *');
        if($_POST){
            $dados['nome']          = ucwords(strip_tags(trim($this->input->post('nome'))));
            $dados['email']         = strip_tags(trim($this->input->post('email')));
            $dados['senha']         = strip_tags(trim($this->input->post('senha')));
            $dados['tipoUsuarioID'] = $this->input->post('tipoUsuarioID');
            $dados['locatarioID']   = $this->session->userdata('locatarioID');

            if(isset($dados['nome']) && isset($dados['email']) && isset($dados['senha']) && isset($dados['locatarioID']) && isset($dados['tipoUsuarioID'])) {

                $attributes = array(
                    'nome'          => $dados['nome'],
                    'email'         => $dados['email'],
                    'senha'         => sha1('web3d@' . $dados['senha'] . '@web3d'),
                    'tipoUsuarioID' => $dados['tipoUsuarioID'],
                    'locatarioID'   => $dados['locatarioID']
                );

                $verificaEmail = $this->locUser->get_by_field('email', $dados['email']);

                if ($verificaEmail) {
                    die('erro');
                } else {
                    $locatarioUsuarioID = $this->locUser->insert($attributes);

                    $log = 'Cadastro usuário - usuarioID: ' . $locatarioUsuarioID . ' - IP: ' . $this->input->ip_address();
                    $this->logs->gravar($log);

                    if($locatarioUsuarioID){
                        die('sucesso');
                    }
                }
            }
            die('erro');
        }
    }

    public function gravarEdicao()
    {
        header('Access-Control-Allow-Origin: *');
        if($_POST){
            $dados['nome']               = ucwords(strip_tags(trim($this->input->post('nome'))));
            $dados['email']              = strip_tags(trim($this->input->post('email')));
            $dados['senha']              = strip_tags(trim($this->input->post('senha')));
            $dados['locatarioID']        = $this->session->userdata('locatarioID');
            $dados['tipoUsuarioID']      = $this->input->post('tipoUsuarioID');
            $dados['usuarioLocatarioID'] = $this->input->post('usuarioLocatarioID');

            if(isset($dados['nome']) && isset($dados['email']) && isset($dados['senha']) && isset($dados['locatarioID']) && isset($dados['usuarioLocatarioID']) && isset($dados['tipoUsuarioID'])) {

                $attributes = array(
                    'nome'          => $dados['nome'],
                    'email'         => $dados['email'],
                    'senha'         => sha1('web3d@' . $dados['senha'] . '@web3d'),
                    'tipoUsuarioID' => $dados['tipoUsuarioID'],
                    'locatarioID'   => $dados['locatarioID']
                );

                $locatarioUsuarioID = $this->locUser->update($dados['usuarioLocatarioID'], $attributes);

                $log = 'Edição usuário - usuarioID: ' . $locatarioUsuarioID . ' - IP: ' . $this->input->ip_address();
                $this->logs->gravar($log);


                if($locatarioUsuarioID){
                    die('sucesso');
                }
            }
            die('erro');
        }
    }

    public function editarStatus($id, $status)
    {
        $status = strip_tags(trim($status));

        if ($status == 'ativar') {
            $codStatus = 1;
        } else {
            $codStatus = 0;
        }

        $attributes = array(
            'status'  => $codStatus
        );

        $mudancaStatus = $this->locUser->update($id, $attributes);
        $log = 'Mudança status usuário - usuarioID: ' . $id . ' - Status: ' . $status . ' - IP: ' . $this->input->ip_address();
        $this->logs->gravar($log);
        redirect('saas/usuarios/listar/' . $this->session->userdata('locatarioID'));
    }

    public function excluir($id)
    {
        $excluir = $this->locUser->delete($id);
        $log = 'Exclusão usuário - usuarioID: ' . $id . ' - IP: ' . $this->input->ip_address();
        $this->logs->gravar($log);
        redirect('saas/usuarios/listar/' . $this->session->userdata('locatarioID'));
    }

    private function render($data, $pagina)
    {
        $this->load->view('sistema/includes/header', $data, FALSE);
        $this->load->view('sistema/includes/menus-saas-adm', $data, FALSE);
        $this->load->view('sistema/paginas-saas/' . $pagina, $data, FALSE);
        $this->load->view('sistema/includes/footer', $data, FALSE);
    }
}