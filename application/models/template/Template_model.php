<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Template_model extends CI_Model{

    private $table;
    private $tableID;

    function __construct()
    {
        parent::__construct();
    }

    public function setTable($table, $tableID)
    {
        $this->table   = $table;
        $this->tableID = $tableID;
    }

    public function get_by_id($id)
    {
        #Method Chaining APENAS PHP >= 5
        $this->db->select('*')->from($this->table)->where($this->tableID, $id) ->where('locatarioID', $this->session->userdata('locatarioID'));

        #MÉTODO NORMAL
        // $this->db->select('*');
        // $this->from($this->table);
        // $this->where($this->tableID, $id);

        $query = $this->db->get();

        if($query->num_rows() > 0):
            return $query->row();
        endif;

        return false;
    }


    public function get_by_field($field, $value, $limit = null)
    {
        #Method Chaining APENAS PHP >= 5
        $this->db->select('*')->from($this->table)->where($field, $value)
             ->where('locatarioID', $this->session->userdata('locatarioID'));

        if(!$limit == null){
            $this->db->limit($limit);
        }
        #MÉTODO NORMAL
        // $this->db->select('*');
        // $this->from($this->table);
        // $this->where($this->tableID, $id);

        $query = $this->db->get();

        if($limit == 1):
            return $query->row();
        else:
            return $query->result();
        endif;

        return false;
    }


    public function get_by_field_order($field, $value, $limit = null)
    {
        #Method Chaining APENAS PHP >= 5
        $this->db->select('*')->from($this->table)->where($field, $value)
             ->where('locatarioID', $this->session->userdata('locatarioID'))
             ->order_by('fileName','asc');

        if(!$limit == null){
            $this->db->limit($limit);
        }
        #MÉTODO NORMAL
        // $this->db->select('*');
        // $this->from($this->table);
        // $this->where($this->tableID, $id);

        $query = $this->db->get();

        if($limit == 1):
            return $query->row();
        else:
            return $query->result();
        endif;

        return false;
    }

    public function get_all()
    {
        #Method Chaining APENAS PHP >= 5
        $this->db->select('*')->from($this->table)
        ->where('locatarioID', $this->session->userdata('locatarioID'));

        #MÉTODO NORMAL
        // $this->db->select('*');
        // $this->from($this->table);

        $query = $this->db->get();
        return $query->result();
    }

     public function get_all_order()
    {
        #Method Chaining APENAS PHP >= 5
        $this->db->select('*')->from($this->table)
        ->where('locatarioID', $this->session->userdata('locatarioID'))
        ->order_by('fileName','asc');

        #MÉTODO NORMAL
        // $this->db->select('*');
        // $this->from($this->table);

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

    public function delete_field($field, $value, $limit = null)
    {
        $this->db->where($field, $value)
        ->where('locatarioID', $this->session->userdata('locatarioID'));

        if(!$limit == null){
            $this->db->limit($limit);
        }

        if($this->db->delete($this->table)):
            return true;
        endif;
    }
}