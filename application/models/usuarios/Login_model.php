<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {

    private $email;
    private $senha;

    public function __construct()
    {
        parent::__construct();
    }
    /**
     * Retorna o valor da propriedade email
     *
     * @access public
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Seta o um valor à propriedade email
     *
     * @access public
     * @param mixed $email Value to set
     * @return self
     */
    public function setEmail($email)
    {
        $email = strtolower(strip_tags(trim($email)));
        $this->email = $email;
    }

    /**
     * Retorna o valor da propriedade senha
     *
     * @access public
     * @return mixed
     */
    public function getSenha()
    {
        return $this->senha;
    }

    /**
     * Seta o um valor à propriedade senha
     *
     * @access public
     * @param mixed $senha Value to set
     * @return self
     */
    public function setSenha($senha)
    {
        $this->senha = sha1('web3d@' . $senha . '@web3d');
    }

    public function logarAdmin($email, $senha)
    {
        $this->setEmail($email);
        $this->setSenha($senha);
        

        $this->db->where('email', $this->getEmail());
        $this->db->where('senha', $this->getSenha());
        $this->db->where('status', 1);

        $query = $this->db->get('usuariosAdmin');
        return $query->row();
    }

    public function logarSaas($email, $senha)
    {
        $this->setEmail($email);
        $this->setSenha($senha);


        $this->db->join('locatarios', 'locatarios.locatarioID = usuariosLocatarios.locatarioID', 'left');
        $this->db->where('usuariosLocatarios.email', $this->getEmail());
        $this->db->where('usuariosLocatarios.senha', $this->getSenha());
        $this->db->where('usuariosLocatarios.status', 1);
        $this->db->where('locatarios.status', 1);
        $this->db->limit(1);

        $query = $this->db->get('usuariosLocatarios');
        return $query->row();
    }
}