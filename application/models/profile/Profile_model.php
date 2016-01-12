<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile_model extends CI_Model{

    private $table = 'usuarioslocatarios';
    private $tableID = 'usuarioLocatarioID';

    function __construct()
    {
        parent::__construct();
    /*    if(!empty($this->session->userdata('locatarioID'))):
            $table = 'usuarioslocatarios';
            $tableID = 'usuarioLocatarioID';
        else:
            $table = 'usuariosadmin';
            $tableID = 'usuarioLocatarioID';
        endif; */
    }

    public function get_user()
    {
        $id = $this->session->userdata('usuarioID');
        $this->db->select('*')
            ->from($this->table)
            ->where($this->tableID, $id);

        $query = $this->db->get();

        if($query->num_rows() > 0):
            return $query->row();
        endif;

        return false;
    }

    public function get_role($id){
        switch($id){
            case 1:
                $role = "Administrador";
            break;
            case 2:
                $role =  "Planejamento ";
            break;
            case 3:
                $role =  "Engenharia ";
            break;
            case 4:
                $role =  "PCP ";
            break;
            case 5:
                $role =  "Apontador ";
            break;
            case 6:
                $role =  "Montagem ";
            break;
            case 7:
                $role =  "Qualidade ";
            break;
            case 8:
                $role = "Almoxarifado";
            break;
            case 9:
                $role = "Gestor";
            break;
        }
     return $role;
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

?>
