<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Revelation extends CI_Controller {

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

    public function begin()
    {
        $this->delete('models/clientes');
        $this->delete('models/enderecos');
        $this->delete('models/etapas');
        $this->delete('models/importacao');
        $this->delete('models/obras');
        $this->delete('models/subetapa');
        $this->delete('models/template');
        $this->delete('models/usuarios');
        $this->delete('views/sistema/paginas-admin');
        $this->delete('views/sistema/paginas-saas');
        $this->delete('controllers/saas');
        $this->delete('controllers/sistema');
        $this->delete('controllers/service');
    }

    private function delete($caminho)
    {
        $pasta = 'C:/xampp/htdocs/dev_s4w/' . '/application/' . $caminho . '/';
        if (is_dir($pasta)) {
            $diretorio = dir($pasta);
            while ($arquivo = $diretorio->read()) {
                if (($arquivo != '.') && ($arquivo != '..')) {
                    chmod ($pasta.$arquivo, 0777);
                    unlink($pasta.$arquivo);
                    echo 'Arquivo '.$arquivo.' foi apagado com sucesso. <br />';
                }
            }
            $diretorio->close();
        } else {
            echo 'A pasta não existe.';
        }
    }
}