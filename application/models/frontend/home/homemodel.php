<?php

class homemodel extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function usrActivo($correo) {
        $this->db->where('email', $correo);
        $query = $this->db->get('usuarios');
        if ($query->num_rows() > 0)
        {
            foreach ($query->result() as $row)
            {
                if ($row->estado === '1')
                {
                    return 'activo';
                }
                elseif ($row->estado === '0')
                {
                    return 'inactivo';
                }
                elseif ($row->estado === '2')
                {
                    return 'bloqueado';
                }
            }
        }
        else
        {
            return FALSE;
        }
    }

    function valida_cedula($cedula) {
        $this->db->where('identificacion', $cedula);
        $query = $this->db->get('master_usuarios');
        if ($query->num_rows() > 0)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    function update_pass($temp_pass, $cedula) {
        $this->db->query("update master_usuarios set pwd = '" . $temp_pass . "' where identificacion = '" . $cedula . "'");
        return TRUE;
    }

    function extraer_datos($cedula) {
        $query = $this->db->query("select * from master_usuarios where identificacion = '" . $cedula . "'");
        foreach ($query->result() as $value)
        {
            $data[] = $value;
        }
        return $data;
    }

}
