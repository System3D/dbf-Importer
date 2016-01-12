<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Exportar extends MY_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('my_pdf');
    }

    public function teste()
    {
        $dados['nome'] = 'Vitor Henckel';
        // Opcional: Também é possivel carregar uma view inteira...
        $this->render('teste', $dados);
    }

    public function render($pagina, $dados)
    {
        $view = 'relatorios/' . $pagina;
        $html = $this->load->view($view, $dados, true);
        pdf($html);
    }
}