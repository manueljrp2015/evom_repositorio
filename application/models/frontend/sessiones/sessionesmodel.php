<?php

class sessionesmodel extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function initSessions($email, $pwd)
    {
        $query = $this->db->query("select * from master_usuarios where email = '" . $email . "' and pwd ='" . sha1($pwd) . "'");
        if ($query->result() == FALSE) {
            return FALSE;
        } else {
            foreach ($query->result() as $row) {
                $nuevosdatos = array(
                    'Usuario'        => $row->login,
                    'Email'          => $row->email,
                    'nombre'         => $row->nombre,
                    's_nombre'       => $row->segundo_nombre,
                    'apellido'       => $row->apellido,
                    's_apellido'     => $row->segundo_apellido,
                    'serial'         => $row->serial,
                    'invitacion'     => $row->invitacion,
                    'identificacion' => $row->identificacion,
                    'estado'         => $row->estado,
                    'id_user'        => $row->id_datos
                );
            }
            $this->session->set_userdata($nuevosdatos);
            $query->free_result();
            return TRUE;
        }
    }

    /*
     * validamos la session activa
     */

    public function isLogged()
    {
        //Comprobamos si existe la variable de sesión username. En caso de no existir, le impediremos el paso a la página para usuarios registrados

        if (isset($this->session->userdata['Email'])) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /*     * ************************************************* */

    function folder_db_profile($direccion_profile, $direccion_prf_thumbs, $id_usuario)
    {

        $query = $this->db->query("SELECT * FROM rutas_profile where usuarios_id_datos = '" . $id_usuario . "';");

        if ($query->result() == TRUE) {
            return FALSE;
        } else {

            $data = array(
                'rutas_profile'         => $direccion_profile,
                'rutas_profilec_thumbs' => $direccion_prf_thumbs,
                'date_create'           => 'NOW()',
                'usuarios_id_datos'     => $id_usuario,
            );

            $this->db->insert('rutas_profile', $data);
        }
        $query->free_result();
    }

    /*     * ************************************************* */

    function menu_session_name()
    {
        if ($this->session->userdata('email') == TRUE) {
            $nombre_usr = $this->session->userdata('nombre') . ' ' . $this->session->userdata('apellido');
            return $nombre_usr;
        } else {
            $nombre_usr = 'Login';
            return $nombre_usr;
        }
    }

    /*     * ************************************************* */

    function menu_session_ico()
    {
        if ($this->session->userdata('email') == TRUE) {
            $datos['logout_ico'] = '1';
            return $datos;
        } else {
            $datos['logout_ico'] = '0';
            return $datos;
        }
    }

    /*     * ************************************************* */

    public function close()
    {
        //cerrar sesión
        return $this->session->sess_destroy();
    }

}
