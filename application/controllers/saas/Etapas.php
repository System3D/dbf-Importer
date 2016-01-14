<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Etapas extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('tipoUsuarioID') != 1 && $this->session->userdata('tipoUsuarioID') != 2) {
            redirect(base_url() . 'login/saas', 'refresh');
        }
        $this->load->model('etapas/Etapas_model', 'etapas');

        // $sections = array(
        //              'config'  => TRUE,
        //              'queries' => TRUE
        //              );
        // $this->output->set_profiler_sections($sections);
        // $this->output->enable_profiler(TRUE);
    }

    public function cadastrar($obraID=null)
    {
        if ($obraID===null) {
            echo "<script>javascript:history.back(-2)</script>";
            die();
        }
        $data['titulo'] = 'GedSteel - Administrador';
        $data['obraID'] = $obraID;
        $pagina = 'etapas-cadastro';

        $this->render($data, $pagina);
    }

    public function excluir($obraID, $etapaID)
    {
        $log = 'Exclusão etapa - etapaID: ' . $etapaID . ' - IP: ' . $this->input->ip_address();
        $this->logs->gravar($log);

        $this->etapas->delete($etapaID);
        redirect('saas/obras/ver/' . $obraID);
    }

    public function editar($obraID, $etapaID)
    {
        $data['titulo'] = 'GedSteel - Administrador';
        $data['obraID'] = $obraID;
        $pagina = 'etapas-cadastro';
        $data['edicao'] = true;
        $data['etapa']  = $this->etapas->get_by_id($etapaID);

        $this->render($data, $pagina);
    }

    public function gravar()
    {
        header('Access-Control-Allow-Origin: *');
        if($_POST){
            $dados['codigoEtapa']         = strip_tags(trim($this->input->post('codigoEtapa')));
            $dados['peso']                = strip_tags(trim($this->input->post('peso')));
            $dados['outro']               = strip_tags(trim($this->input->post('outro')));
            $dados['observacao']          = strip_tags(trim($this->input->post('observacao')));
            $dados['obraID']              = strip_tags(trim($this->input->post('obraID')));
            $dados['estruturaPrincipal']  = strip_tags(trim($this->input->post('estruturaPrincipal')));
            $dados['estruturaSecundaria'] = strip_tags(trim($this->input->post('estruturaSecundaria')));
            $dados['telhasCobertura']     = strip_tags(trim($this->input->post('telhasCobertura')));
            $dados['telhasFechamento']    = strip_tags(trim($this->input->post('telhasFechamento')));
            $dados['calhas']              = strip_tags(trim($this->input->post('calhas')));
            $dados['rufosArremates']      = strip_tags(trim($this->input->post('rufosArremates')));
            $dados['steelDeck']           = strip_tags(trim($this->input->post('steelDeck')));
            $dados['gradesPiso']          = strip_tags(trim($this->input->post('gradesPiso')));
            $dados['escadas']             = strip_tags(trim($this->input->post('escadas')));
            $dados['corrimao']            = strip_tags(trim($this->input->post('corrimao')));

            if(isset($dados['obraID'])) {

                $attributes = array(
                    'codigoEtapa'         => $dados['codigoEtapa'],
                    'peso'                => $dados['peso'],
                    'outro'               => $dados['outro'],
                    'observacao'          => $dados['observacao'],
                    'obraID'              => $dados['obraID'],
                    'estruturaPrincipal'  => $dados['estruturaPrincipal'],
                    'estruturaSecundaria' => $dados['estruturaSecundaria'],
                    'telhasCobertura'     => $dados['telhasCobertura'],
                    'telhasFechamento'    => $dados['telhasFechamento'],
                    'calhas'              => $dados['calhas'],
                    'rufosArremates'      => $dados['rufosArremates'],
                    'steelDeck'           => $dados['steelDeck'],
                    'gradesPiso'          => $dados['gradesPiso'],
                    'escadas'             => $dados['escadas'],
                    'corrimao'            => $dados['corrimao']

                );

                $etapaID = $this->etapas->insert($attributes);

                $log = 'Cadastro etapa - etapaID: ' . $etapaID . ' - IP: ' . $this->input->ip_address();
                $this->logs->gravar($log);

                if($etapaID){
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
            $dados['codigoEtapa']         = strip_tags(trim($this->input->post('codigoEtapa')));
            $dados['peso']                = strip_tags(trim($this->input->post('peso')));
            $dados['outro']               = strip_tags(trim($this->input->post('outro')));
            $dados['observacao']          = strip_tags(trim($this->input->post('observacao')));
            $dados['obraID']              = strip_tags(trim($this->input->post('obraID')));
            $dados['estruturaPrincipal']  = strip_tags(trim($this->input->post('estruturaPrincipal')));
            $dados['estruturaSecundaria'] = strip_tags(trim($this->input->post('estruturaSecundaria')));
            $dados['telhasCobertura']     = strip_tags(trim($this->input->post('telhasCobertura')));
            $dados['telhasFechamento']    = strip_tags(trim($this->input->post('telhasFechamento')));
            $dados['calhas']              = strip_tags(trim($this->input->post('calhas')));
            $dados['rufosArremates']      = strip_tags(trim($this->input->post('rufosArremates')));
            $dados['steelDeck']           = strip_tags(trim($this->input->post('steelDeck')));
            $dados['gradesPiso']          = strip_tags(trim($this->input->post('gradesPiso')));
            $dados['escadas']             = strip_tags(trim($this->input->post('escadas')));
            $dados['corrimao']            = strip_tags(trim($this->input->post('corrimao')));
            $dados['etapaID']             = $this->input->post('etapaID');

            if(isset($dados['obraID']) && isset($dados['etapaID'])) {

                $attributes = array(
                    'codigoEtapa'         => $dados['codigoEtapa'],
                    'peso'                => $dados['peso'],
                    'outro'               => $dados['outro'],
                    'observacao'          => $dados['observacao'],
                    'obraID'              => $dados['obraID'],
                    'estruturaPrincipal'  => $dados['estruturaPrincipal'],
                    'estruturaSecundaria' => $dados['estruturaSecundaria'],
                    'telhasCobertura'     => $dados['telhasCobertura'],
                    'telhasFechamento'    => $dados['telhasFechamento'],
                    'calhas'              => $dados['calhas'],
                    'rufosArremates'      => $dados['rufosArremates'],
                    'steelDeck'           => $dados['steelDeck'],
                    'gradesPiso'          => $dados['gradesPiso'],
                    'escadas'             => $dados['escadas'],
                    'corrimao'            => $dados['corrimao']

                );

                $etapaID = $this->etapas->update($dados['etapaID'], $attributes);

                $log = 'Edição etapa - etapaID: ' . $etapaID . ' - IP: ' . $this->input->ip_address();
                $this->logs->gravar($log);

                if($etapaID){
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