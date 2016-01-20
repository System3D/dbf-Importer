<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Etapas_model extends CI_Model{

    private $table   = 'etapas';
    private $tableID = 'etapaID';

    function __construct()
    {
        parent::__construct();
    }

    public function get_by_id($id)
    {
        $this->db->select('*')
            ->from($this->table)
            ->join('obras', 'obras.obraID = etapas.obraID', 'left')
            ->join('clientes', 'clientes.clienteID = obras.clienteID', 'left')
            ->where($this->tableID, $id)
            ->where('clientes.locatarioID', $this->session->userdata('locatarioID'));

        $query = $this->db->get();

        if($query->num_rows() > 0):
            return $query->row();
        endif;

        return false;
    }

    public function get_search(){
          $match = $this->input->post('search');
          $this->db->select('*')
            ->from($this->table)
            ->join('obras', 'obras.obraID = etapas.obraID', 'left');
          $this->db->like('etapas.codigoEtapa',$match);
          $this->db->or_like('etapas.observacao',$match)
          ->or_like('obras.nome',$match)->or_like('obras.descricao',$match)
          ->or_like('obras.codigo',$match)
          ->where('obras.locatarioID', $this->session->userdata('locatarioID'));
          $query = $this->db->get();
    return $query->result();
    }


    public function get_by_field($field, $value, $limit = null)
    {
        $this->db->select('*')
            ->from($this->table)
            ->join('obras', 'obras.obraID = etapas.obraID', 'left')
            ->join('clientes', 'clientes.clienteID = obras.clienteID', 'left')
            ->where('clientes.locatarioID', $this->session->userdata('locatarioID'))
            ->where($field, $value);

        if(!$limit == null){
            $this->db->limit($limit);
        }

        $query = $this->db->get();

        if($limit == 1):
            return $query->row();
        else:
            return $query->result();
        endif;

        return false;
    }

    public function get_all($obraID)
    {
        $this->db->select('etapas.*')
            ->from($this->table)
            ->join('obras', 'obras.obraID = etapas.obraID', 'left')
            ->join('clientes', 'clientes.clienteID = obras.clienteID', 'left')
            ->where('clientes.locatarioID', $this->session->userdata('locatarioID'))
            ->where('etapas.obraID', $obraID)
            ->order_by('codigoEtapa', 'ASC');

        $query = $this->db->get();
        return $query->result();
    }

    public function insert($attributes)
    {
        if($this->db->insert($this->table, $attributes)):
            return $this->db->insert_id();
        endif;
    }

    public function update($id, $attributes)
    {
        $this->db->where($this->tableID, $id)->limit(1);

        if($this->db->update($this->table, $attributes)):
            return $this->db->affected_rows();
        endif;
        return false;
    }

    public function delete($id, $limit = null)
    {
        $this->db->where($this->tableID, $id);

        if(!$limit == null){
            $this->db->limit($limit);
        }

        if($this->db->delete($this->table)):
            return true;
        endif;
    }
}