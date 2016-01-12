<?php
$this->load->view('sistema/includes/header');
if ($this->session->userdata('admin') == 1) {
    $this->load->view('sistema/includes/menus-adm');
} else {
    $this->load->view('sistema/includes/menus-vend');
}
if ($this->session->userdata('admin') == 1) {
    if($pagina!='') $this->load->view('sistema/paginas-admin/' . $pagina);
} else {
    if($pagina!='') $this->load->view('sistema/paginas-vendedor/' . $pagina);
}
$this->load->view('sistema/includes/footer');