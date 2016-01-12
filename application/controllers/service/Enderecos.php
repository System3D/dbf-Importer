<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Enderecos extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('enderecos/Enderecos_model', 'enderecos');
    }

    public function cidades()
    {
        header('Access-Control-Allow-Origin: *');
        $estadoID = $this->input->post('estadoID');
        $cidades = $this->enderecos->getCidadesByEstadoID($estadoID);

        $option = "<option value=''>Selecione...</option>";
        foreach($cidades as $cidade) {
            $option .= "<option value='$cidade->cidadeID'>$cidade->nome</option>";
        }
        echo $option;
    }
}