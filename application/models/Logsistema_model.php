<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logsistema_model extends CI_Model{

    private $table = 'logs';
    private $tableID = 'logID';

    function __construct()
    {
        parent::__construct();
    }

    public function gravar($mensagem)
    {
        $attributes = array(
            'acao'        => $mensagem,
            'tipo'        => '1',
            'usuarioID'   => $this->session->userdata('usuarioID'),
            'locatarioID' => $this->session->userdata('locatarioID'),
            'query'       => $this->db->last_query(),
            'data'        => date('Y-m-d H:i:s')
        );

        $this->insert($attributes);
    }

    public function get_all()
    {
        $this->db->select('logs.*, usuariosLocatarios.nome, usuariosLocatarios.email')
                ->from($this->table)
                ->join('usuariosLocatarios', 'usuariosLocatarios.usuarioLocatarioID = logs.usuarioID', 'left')
                ->where('logs.locatarioID', $this->session->userdata('locatarioID'))
                ->where('logs.tipo','1')
                ->order_by('logs.logID', 'DESC');

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