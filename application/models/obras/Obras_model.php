<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Obras_model extends CI_Model{

    private $table   = 'obras';
    private $tableID = 'obraID';

    function __construct()
    {
        parent::__construct();
    }

    public function get_by_id($id)
    {
        #Method Chaining APENAS PHP >= 5
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
        #Method Chaining APENAS PHP >= 5
        $this->db->select('*')->from($this->table)
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

    public function get_all()
    {
        $this->db->select('*')
                        ->from($this->table)
                        ->where('locatarioID', $this->session->userdata('locatarioID'))
                        ->order_by('status', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_all_order()
    {
        $this->db->select('*')
                        ->from($this->table)
                        ->where('locatarioID', $this->session->userdata('locatarioID'))
                        ->order_by('status', 'DESC')->limit(10);
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

    public function geraSenha($tamanho = 8, $maiusculas = true, $numeros = true, $simbolos = false){
        $lmin = 'abcdefghijklmnopqrstuvwxyz';
        $lmai = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $num = '1234567890';
        $simb = '!@#$%*-';
        $retorno = '';
        $caracteres = '';
        $caracteres .= $lmin;
        if ($maiusculas) $caracteres .= $lmai;
        if ($numeros) $caracteres .= $num;
        if ($simbolos) $caracteres .= $simb;
        $len = strlen($caracteres);
        for ($n = 1; $n <= $tamanho; $n++) {
        $rand = mt_rand(1, $len);
        $retorno .= $caracteres[$rand-1];
        }
        return $retorno;
        }

}