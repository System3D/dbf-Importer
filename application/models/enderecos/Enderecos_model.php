<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Enderecos_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function getEstados()
    {
        $this->db->select('*')->from('estados');
        $query = $this->db->get();
        if($query->num_rows() > 0):
            return $query->result();
        endif;
        return false;
    }

    public function getEstadosById($id)
    {
        $this->db->select('*')->from('estados')->where('estadoID', $id);
        $query = $this->db->get();
        if($query->num_rows() > 0):
            return $query->row();
        endif;
        return false;
    }

    public function getCidadesByEstadoID($estadoID)
    {
        $this->db->select('*')->from('cidades')->where('estado', $estadoID);
        $query = $this->db->get();
        if($query->num_rows() > 0):
            return $query->result();
        endif;
        return false;
    }

    public function getCidadesById($id)
    {
        $this->db->select('*')->from('cidades')->where('cidadeID', $id);
        $query = $this->db->get();
        if($query->num_rows() > 0):
            return $query->row();
        endif;
        return false;
    }
}