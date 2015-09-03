<?php

/*
 * @Desarollo: TSU Manuel Rodriguez 
 * @Propiedad: empresa movil
 * @technology: php, codeigniter PHP Framework, Jquery, Bootstrap
 */

class registromodel extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function infoSponsor($usr) {
        $query = $this->db->query("select login,nombre,apellido,identificacion,email from master_usuarios where login = '" . $usr . "'");
        if ($query->num_rows() > 0)
        {
            foreach ($query->result() as $value)
            {
                $data[] = $value;
            }
            return $data;
        }
        else
        {
            $data = "vacio";
            return $data;
        }
    }

    public function registrar($email, $nombre, $apellido, $password, $ident, $login, $serial, $invitacion, $patrocinante, $pais, $telf, $estado) {
        $query = $this->db->query("insert into master_usuarios (login,email,nombre,apellido,pwd,estado,fecha_creacion,serial,invitacion,identificacion)
    values('" . $login . "','" . $email . "','" . $nombre . "','" . $apellido . "','" . $password . "',0,NOW(),'" . $serial . "','" . $invitacion . "','" . $ident . "')");
        $nombres = $nombre . ' ' . $apellido;
        $query = $this->db->query("insert into master_multinivel (participante,identificacion_patrocinante,identificacion_participante,estado,membresia) values ('" . $nombres . "','" . $patrocinante . "','" . $ident . "',1,1)");
        $query = $this->db->query("insert into master_datos_complementarios (telefono,pais,estado,identificacion) values ('" . $telf . "','" . $pais . "','" . $estado . "','" . $ident . "')");
        return TRUE;
    }

    function insertFolderUser($direccion_file, $usuario) {
        $query = $this->db->query("SELECT * FROM master_folder_profile where login = '" . $usuario . "'");
        if ($query->result() == TRUE)
        {
            return FALSE;
        }
        else
        {
            $query = $this->db->query("insert into master_folder_profile values(NULL,'" . $direccion_file . "', NULL, '" . $usuario . "', NOW(), NULL)");
        }
    }

    public function insertBonoInicio($refer, $newRegister) {
        $data = array(
            'id_referido' => $refer,
            'id_registrado' => $newRegister,
            'status' => 'N/P'
        );

        $this->db->insert('master_bonoinicio', $data);
    }

}
