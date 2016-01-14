<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clientes extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('tipoUsuarioID') != 1 && $this->session->userdata('tipoUsuarioID') != 2) {
            redirect(base_url() . 'login/saas', 'refresh');
        }
        $this->load->model('clientes/Clientes_model', 'clientes');
    }

    public function listar()
    {
        $data['titulo'] = 'Steel4Web - Administrador';
        $data['clientes'] = $this->clientes->get_all('clientes');
        $pagina = 'clientes-listar';
        $this->render($data, $pagina);
    }

    public function cadastrar()
    {
        $this->load->model('enderecos/Enderecos_model', 'end');
        $data['estados'] = $this->end->getEstados();
        $data['titulo'] = 'Steel4Web - Cadastrar Cliente';
        $pagina = 'clientes-cadastro';
        $this->render($data, $pagina);
    }

    public function editar($id)
    {
        $this->load->model('enderecos/Enderecos_model', 'end');
        $data['estados']   = $this->end->getEstados();
        $data['titulo']    = 'Steel4Web - Editar Cliente';
        $pagina            = 'clientes-cadastro';
        $data['clienteID'] = strip_tags(trim($id));
        $data['cliente']   = $this->clientes->get_by_id($data['clienteID']);
        $data['cidadeDados']   = $this->end->getCidadesById($data['cliente']->cidadeID);
        $data['estadoDados']   = $this->end->getEstadosById($data['cidadeDados']->estado);
        if ($data['cliente']->locatarioID != $this->session->userdata('locatarioID')) {
            redirect('saas/clientes/listar/');
        }
        $data['edicao']    = true;

        $this->render($data, $pagina);
    }

    public function ver($id)
    {
        $this->load->model('enderecos/Enderecos_model', 'end');
        $data['estados']   = $this->end->getEstados();
        $data['titulo']    = 'Steel4Web - Perfil Cliente';
        $pagina            = 'clientes-cadastro';
        $data['clienteID'] = strip_tags(trim($id));
        $data['cliente']   = $this->clientes->get_by_id($data['clienteID']);
        $data['cidadeDados']   = $this->end->getCidadesById($data['cliente']->cidadeID);
        $data['estadoDados']   = $this->end->getEstadosById($data['cidadeDados']->estado);
        if ($data['cliente']->locatarioID != $this->session->userdata('locatarioID')) {
            redirect('saas/clientes/listar/');
        }
        $data['edicao'] = true;
        $data['disable'] = true;

        $this->render($data, $pagina);
    }

    public function gravar()
    {
        header('Access-Control-Allow-Origin: *');
        if($_POST){
            $dados['razao']       = ucwords(strip_tags(trim($this->input->post('razao'))));
            $dados['fantasia']    = ucwords(strip_tags(trim($this->input->post('fantasia'))));
            $dados['email']       = strtolower(strip_tags(trim($this->input->post('email'))));
            $dados['tipo']        = strip_tags(trim($this->input->post('tipo')));
            $dados['documento']   = $this->util->limpaString(strip_tags(trim($this->input->post('documento'))));
            $dados['inscricao']   = $this->util->limpaString(strip_tags(trim($this->input->post('inscricao'))));
            $dados['telefone']    = $this->util->limpaString(strip_tags(trim($this->input->post('telefone'))));
            $dados['cidadeID']    = strip_tags(trim($this->input->post('cidade')));
            $dados['endereco']    = strip_tags(trim($this->input->post('endereco')));
            $dados['cep']         = strip_tags(trim($this->input->post('cep')));
            $dados['locatarioID'] = $this->session->userdata('locatarioID');


            if(isset($dados['razao']) && isset($dados['fantasia']) && isset($dados['tipo']) && isset($dados['documento']) && isset($dados['telefone']) && isset($dados['cidadeID']) && isset($dados['locatarioID'])) {

                $attributes = array(
                    'razao'       => $dados['razao'],
                    'fantasia'    => $dados['fantasia'],
                    'email'       => $dados['email'],
                    'tipo'        => $dados['tipo'],
                    'documento'   => $dados['documento'],
                    'inscricao'   => $dados['inscricao'],
                    'fone'        => $dados['telefone'],
                    'cidadeID'    => $dados['cidadeID'],
                    'endereco'    => $dados['endereco'],
                    'cep'         => $dados['cep'],
                    'locatarioID' => $dados['locatarioID'],
                    'cliente'     => 1,
                    'data'        => date('Y-m-d H:i:s')
                );

                $clienteID = $this->clientes->insert($attributes);

                $log = 'Cadastro cliente - ClienteID: ' . $clienteID . ' - IP: ' . $this->input->ip_address();
                $this->logs->gravar($log);

                if($clienteID){
                    die('sucesso');
                }
            }
            die('erro');
        }
    }

    public function gravarEdicao()
    {
        header('Access-Control-Allow-Origin: *');
        if($_POST){
            $dados['razao']       = ucwords(strip_tags(trim($this->input->post('razao'))));
            $dados['fantasia']    = ucwords(strip_tags(trim($this->input->post('fantasia'))));
            $dados['email']       = strtolower(strip_tags(trim($this->input->post('email'))));
            $dados['tipo']        = strip_tags(trim($this->input->post('tipo')));
            $dados['documento']   = $this->util->limpaString(strip_tags(trim($this->input->post('documento'))));
            $dados['inscricao']   = $this->util->limpaString(strip_tags(trim($this->input->post('inscricao'))));
            $dados['telefone']    = $this->util->limpaString(strip_tags(trim($this->input->post('telefone'))));
            $dados['cidadeID']    = strip_tags(trim($this->input->post('cidade')));
            $dados['endereco']    = strip_tags(trim($this->input->post('endereco')));
            $dados['cep']         = strip_tags(trim($this->input->post('cep')));
            $dados['locatarioID'] = $this->session->userdata('locatarioID');
            $dados['clienteID']   = strip_tags(trim($this->input->post('clienteID')));


            if(isset($dados['razao']) && isset($dados['fantasia']) && isset($dados['tipo']) && isset($dados['documento']) && isset($dados['telefone']) && isset($dados['cidadeID']) && isset($dados['locatarioID']) && isset($dados['clienteID'])) {

                $attributes = array(
                    'razao'       => $dados['razao'],
                    'fantasia'    => $dados['fantasia'],
                    'email'       => $dados['email'],
                    'tipo'        => $dados['tipo'],
                    'documento'   => $dados['documento'],
                    'inscricao'   => $dados['inscricao'],
                    'fone'        => $dados['telefone'],
                    'cidadeID'    => $dados['cidadeID'],
                    'endereco'    => $dados['endereco'],
                    'cep'         => $dados['cep'],
                    'locatarioID' => $dados['locatarioID'],
                    'cliente'     => 1,
                    'clienteID'   => $dados['clienteID']
                );

                $clienteID = $this->clientes->update($dados['clienteID'],$attributes);

                $log = 'Edição cliente - ClienteID: ' . $clienteID . ' - IP: ' . $this->input->ip_address();
                $this->logs->gravar($log);

                if($clienteID){
                    die('sucesso');
                }
            }
            die('erro');
        }
    }

    private function render($data, $pagina)
    {
        $this->load->view('sistema/includes/header', $data, FALSE);
        $this->load->view('sistema/includes/menus-saas-adm', $data, FALSE);
        $this->load->view('sistema/paginas-saas/' . $pagina, $data, FALSE);
        $this->load->view('sistema/includes/footer', $data, FALSE);
    }
}