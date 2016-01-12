<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Importacao_model extends CI_Model{

    private $table   = 'importacoes';
    private $tableID = 'importacaoID';

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

    public function CreateFolder($Folder) {
        $Path =  "C:/xampp/htdocs/s4w/arquivos/";
        if (!file_exists($Path . $Folder) && !is_dir($Path . $Folder)):
            mkdir($Path . $Folder, 0777);
        endif;
    }

    public function get_by_field($field, $value, $limit = null)
    {
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
        $this->db->select('obras.obraID, obras.codigo AS codigoObra, obras.nome AS nomeObra, obras.data, clientes.razao, clientes.fantasia')
                        ->from($this->table)
                        ->join('clientes', 'clientes.clienteID = obras.clienteID', 'left')
                        ->where('clientes.locatarioID', $this->session->userdata('locatarioID'));
        $query = $this->db->get();
        return $query->result();
    } 

    public function get_all_list()
    {
        $this->db->select('*')
                        ->from($this->table)
                        ->where('locatarioID', $this->session->userdata('locatarioID'));
        $query = $this->db->get();
        return $query->result();
    } 

    public function get_all_count(){
        $this->db->select('*')->from($this->table)->where('locatarioID', $this->session->userdata('locatarioID'));
        $query = $this->db->get();
        return $query->result();
    }

      public function get_all_order()
    {
        $this->db->select('*')->from($this->table)->where('locatarioID', $this->session->userdata('locatarioID'))
                        ->order_by('importacaoID', 'DESC')->limit(10);
        $query = $this->db->get();
        return $query->result();
    }

    public function get_dados($subetapaID)
    {
        $this->db->select('subetapas.subetapaID, subetapas.etapaID, etapas.obraID, obras.clienteID, clientes.locatarioID')
                ->from('subetapas')
                ->join('etapas', 'etapas.etapaID = subetapas.etapaID', 'left')
                ->join('obras', 'obras.obraID = etapas.obraID', 'left')
                ->join('clientes', 'clientes.clienteID = obras.clienteID')
                ->where('subetapas.subetapaID', $subetapaID)
                ->where('clientes.locatarioID', $this->session->userdata('locatarioID'));

        $query = $this->db->get();
        return $query->row();
    }

     public function get_names($subetapaID)
    {
        $this->db->select('subetapas.codigoSubetapa, subetapas.etapaID, etapas.codigoEtapa, obras.nome, clientes.razao')
                ->from('subetapas')
                ->join('etapas', 'etapas.etapaID = subetapas.etapaID', 'left')
                ->join('obras', 'obras.obraID = etapas.obraID', 'left')
                ->join('clientes', 'clientes.clienteID = obras.clienteID')
                ->where('subetapas.subetapaID', $subetapaID)
                ->where('clientes.locatarioID', $this->session->userdata('locatarioID'));

        $query = $this->db->get();
        return $query->row();
    }

    public function get_conjuntos($file){
        $ctable   = 'dbfdata';
        $ctableID = 'dbfID';
        $this->db->select('*')
            ->from($ctable)
            ->where('FLG_REC', '03')
            ->where('fileName', $file);
        $query = $this->db->get();
        return  $query->result();

    }

       public function get_dbfNames(){
        $ctable   = 'dbfdata';
        $ctableID = 'dbfID';
        $this->db->select('*')
            ->from($ctable);
        $query = $this->db->get();
        $all = $query->result();
        $check = array();
        foreach($all as $todos){
            if(!in_array($todos->fileName, $check)){
                $check[] = $todos->fileName;
            }
        }
        return $check;

    }

    public function nro_importacao($subetapaID)
    {
        $this->db->select('importacaoNr')
            ->from($this->table)
            ->where('subetapaID', $subetapaID)
            ->order_by('importacaoNr', 'DESC');

        $query = $this->db->get();
        return $query->row();
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