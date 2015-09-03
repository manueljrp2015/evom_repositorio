<?php

class configmodel extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function validarPwdTemp($pwd, $user) {
        $query = $this->db->get_where("master_usuarios", array("pwd" => $pwd, "login" => $user));
        if ($query->result() == TRUE)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    public function rcvPwd($pwd, $user) {
        $data = array(
            'pwd' => $pwd,
        );

        $this->db->where('login', $user);
        $this->db->update('master_usuarios', $data);
        return TRUE;
    }

}
