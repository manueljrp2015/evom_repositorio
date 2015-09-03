<?php

class validadormodel extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function validarEmail($email) {
        $query = $this->db->get_where("master_usuarios", array("email" => $email));
        if ($query->num_rows() > 0)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    public function validarUser($user) {
        $query = $this->db->get_where("master_usuarios", array("login" => $user));
        if ($query->num_rows() > 0)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
    
    public function ValidarId($ident) {
        $query = $this->db->get_where("master_usuarios", array("identificacion" => $ident));
        if ($query->num_rows() > 0)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
   

}
