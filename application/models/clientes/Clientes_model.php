<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clientes_model extends CI_Model{

    private $table   = 'clientes';
    private $tableID = 'clienteID';

    function __construct()
    {
        parent::__construct();
    }

    public function get_by_id($id)
    {
        $this->db->select('*')
            ->from($this->table)
            ->where($this->tableID, $id)
            ->where('locatarioID', $this->session->userdata('locatarioID'));

        $query = $this->db->get();

        if($query->num_rows() > 0):
            return $query->row();
        endif;

        return false;
    }

    public function get_by_field($field, $value, $limit = null)
    {
        $this->db->select('*')
            ->from($this->table)
            ->where($field, $value)
            ->where('locatarioID', $this->session->userdata('locatarioID'));

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

    public function get_all($tipoCliente=null)
    {
        $this->db->select('*')->from($this->table);
        $this->db->where('locatarioID', $this->session->userdata('locatarioID'));
        if($tipoCliente == 'clientes'){
            $this->db->where('cliente', 1);
        } else {
            $this->db->where('cliente', null);
        }
        $query = $this->db->get();
        return $query->result();
    }

    public function get_all_order($tipoCliente=null)
    {
        $this->db->select('*')->from($this->table);
        $this->db->where('locatarioID', $this->session->userdata('locatarioID'));
        if($tipoCliente == 'clientes'){
            $this->db->where('cliente', 1);
        } else {
            $this->db->where('cliente', null);
        }
        $this->db->order_by('data', 'DESC')->limit(10);
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