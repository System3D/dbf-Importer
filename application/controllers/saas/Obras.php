<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Obras extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('tipoUsuarioID') != 1 && $this->session->userdata('tipoUsuarioID') != 2 && $this->session->userdata('tipoUsuarioID') != 3 && $this->session->userdata('tipoUsuarioID') != 4) {
            redirect(base_url() . 'login/saas', 'refresh');
        }
        $this->load->model('obras/Obras_model', 'obras');
        $this->load->model('clientes/Clientes_model', 'clientes');

     /*   $sections = array(
                     'config'  => TRUE,
                     'queries' => TRUE
                     );
        $this->output->set_profiler_sections($sections);
        $this->output->enable_profiler(TRUE); */
    }

    public function listar()
    {
        $data['titulo'] = 'GedSteel - Administrador';
        $pagina = 'obras-listar';
        $data['obras'] = $this->obras->get_all();
        $this->render($data, $pagina);
    }

    public function addetapa()
    {
        $data['titulo'] = 'GedSteel - Administrador';
        $pagina = 'obras-etapa';
        $data['obras'] = $this->obras->get_all();
        $this->render($data, $pagina);
    }

  /*  public function ver($id)
    {
        $this->load->model('etapas/Etapas_model', 'etapas');
        $this->load->model('subetapa/Subetapas_model', 'subetapas');
        $this->load->helper('text');

        $data['titulo'] = 'GedSteel - Administrador';
        $pagina = 'obras-perfil';
        $data['obra']         = $this->obras->get_by_id($id);
        $data['cliente']      = $this->clientes->get_by_id($data['obra']->clienteID);
        $data['construtora']  = $this->clientes->get_by_id($data['obra']->construtoraID);
        $data['gerenciadora'] = $this->clientes->get_by_id($data['obra']->gerenciadoraID);
        $data['calculista']   = $this->clientes->get_by_id($data['obra']->calculistaID);
        $data['detalhamento'] = $this->clientes->get_by_id($data['obra']->detalhamentoID);
        $data['montagem']     = $this->clientes->get_by_id($data['obra']->montagemID);
        $data['etapas']       = $this->etapas->get_all($id);
        $cont = sizeof($data['etapas']) - 1;
        $data['obra']->descricao = character_limiter( $data['obra']->descricao, 130 );
        

        for ($i=0; $i < $cont; $i++) {
            $data['etapas'][$i]->subetapas = $this->subetapas->get_all($data['etapas'][$i]->etapaID);
        }

        $this->render($data, $pagina);
    } */



 /*    public function editarStatus($id, $status)
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

        $mudancaStatus = $this->obras->update($id, $attributes);
        $log = 'Mudança status usuário - usuarioID: ' . $id . ' - Status: ' . $status . ' - IP: ' . $this->input->ip_address();
        $this->logs->gravar($log);
        redirect('saas/obras/listar/' . $this->session->userdata('locatarioID'));
    } */

    public function cadastrar()
    {
        $this->load->model('enderecos/Enderecos_model', 'end');
        $data['estados']       = $this->end->getEstados();
        $data['titulo']        = 'GedSteel - Cadastrar Obras';
       // $data['clientes']      = $this->clientes->get_by_field('cliente', 1);
        $pagina = 'obras-cadastro';
        $this->render($data, $pagina);
    }

    public function editar($id)
    {
        $this->load->model('enderecos/Enderecos_model', 'end');
        $data['titulo']    = 'GedSteel - Editar Obras';
        $pagina            = 'obras-cadastro';
        $data['obraID'] = strip_tags(trim($id));
     //   $data['clientes']      = $this->clientes->get_by_field('cliente', 1);
        $data['obra']   = $this->obras->get_by_id($data['obraID']);
        if ($data['obra']->locatarioID != $this->session->userdata('locatarioID')) {
            redirect('saas/obras/listar/');
        }
        $data['edicao'] = true;

        $this->render($data, $pagina);
    }

    public function gravar()
    {
        header('Access-Control-Allow-Origin: *');
        $this->load->model('usuarios/usuarioslocatarios_model', 'users');
        if($_POST){
            $dados['codigo']       = strip_tags(trim($this->input->post('codigo')));
            $dados['nome']         = ucwords(strip_tags(trim($this->input->post('nome'))));
            $dados['descricao']    = strip_tags(trim($this->input->post('descricao')));
        
         //   $dados['clienteID']    = strip_tags(trim($this->input->post('clienteID')));
          

            if(isset($dados['nome']) && isset($dados['codigo'])) {

                $attributes = array(
                    'codigo'         => $dados['codigo'],
                    'nome'           => $dados['nome'],
                    'descricao'      => $dados['descricao'],
                    'cidadeID'       => '-',
                    'endereco'       => '-',
                    'cep'            => '-',
                    'clienteID'      => '-',
                    'construtoraID'  => '-',
                    'gerenciadoraID' => '-',
                    'calculistaID'   => '-',
                    'detalhamentoID' => '-',
                    'montagemID'     => '-',
                    'status'         => '1',
                    'locatarioID'    => $this->session->userdata('locatarioID'),
                    'data'           => date('Y-m-d H:i:s')
                );

                $obraID = $this->obras->insert($attributes);

                $newPass = $this->obras->geraSenha();

                 $attr = array(
                    'nome'          => $dados['nome'],
                    'senha'         => sha1('web3d@' . $newPass . '@web3d'),
                    'email'         => $dados['codigo'],
                    'status'        => '1',
                    'tipoUsuarioID' => '7',
                    'locatarioID'   => $this->session->userdata('locatarioID'),
                    'obraID'        =>  $obraID,
                    'password'      =>  $newPass
                );


                 $userId = $this->users->insert($attr);


                $log = 'Cadastro obra - ObraID: ' . $obraID . ' - IP: ' . $this->input->ip_address();
                $this->logs->gravar($log);

                if($obraID && $userId){
                    $this->session->set_flashdata('success', $dados['codigo'].'&x&'. $newPass);
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
            $dados['codigo']       = strip_tags(trim($this->input->post('codigo')));
            $dados['nome']         = ucwords(strip_tags(trim($this->input->post('nome'))));
            $dados['descricao']    = strip_tags(trim($this->input->post('descricao')));

         //   $dados['clienteID']    = strip_tags(trim($this->input->post('clienteID')));
    
            $dados['obraID']       = strip_tags(trim($this->input->post('obraID')));

            if(isset($dados['nome']) && isset($dados['clienteID'])) {

                $attributes = array(
                  'codigo'         => $dados['codigo'],
                    'nome'           => $dados['nome'],
                    'descricao'      => $dados['descricao'],
                    'cidadeID'       => '-',
                    'endereco'       => '-',
                    'cep'            => '-',
                    'clienteID'      => '-',
                    'construtoraID'  => '-',
                    'gerenciadoraID' => '-',
                    'calculistaID'   => '-',
                    'detalhamentoID' => '-',
                    'montagemID'     => '-'
                );

                $obraID = $this->obras->update($dados['obraID'],$attributes);

                $log = 'Edição obra - ObraID: ' . $obraID . ' - IP: ' . $this->input->ip_address();
                $this->logs->gravar($log);

                if($obraID){
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