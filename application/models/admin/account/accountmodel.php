<?php

class accountmodel extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function validAccount($usr, $pass) {
        $query = $this->db->query("select * from master_admin_user where user = '" . $usr . "' and pwd_user ='" . $pass . "'");
        if ($query->result() == FALSE)
        {
            return FALSE;
        }
        else
        {
            foreach ($query->result() as $row)
            {
                $nuevosdatos = array(
                    'user' => $row->user,
                    'status' => $row->status_user,
                    'access' => $row->access,
                    'admin' => 'admin'
                );
            }
            $this->session->set_userdata($nuevosdatos);
            $query->free_result();
            return TRUE;
        }
    }

    /*     * ************************************************* */

    /*
     * validamos la session activa
     */

    public function isLogged() {
        //Comprobamos si existe la variable de sesión username. En caso de no existir, le impediremos el paso a la página para usuarios registrados

        if (isset($this->session->userdata['admin']))
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    public function close() {
        //cerrar sesión
        return $this->session->sess_destroy();
    }

}
