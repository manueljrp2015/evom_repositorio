<?php

class profilemodel extends CI_Model {

    public function __construct() {
        parent::__construct();
    }
    
    public function getInfoUser($identificacion) {
        $query = $this->db->query('SELECT
                                    mus.*,
                                    mdat.*
                                    FROM master_usuarios as mus
                                    LEFT JOIN master_datos_complementarios as mdat ON mdat.identificacion = mus.identificacion
                                    WHERE mus.identificacion = "'.$identificacion.'"');
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $value) {
                $data[] = $value;
            }
            return $data;
        } else {
            $data = 'vacio';
            return $data;
        }
    }
    
    public function getInfoSponsor($id_participante) {
        $this->db->where('identificacion_participante', $id_participante);
        $query = $this->db->get('multinivel');

        if ($query->num_rows() > 0) {
            $row = $query->row();
            $query_patrocinante = $this->db->query('SELECT
                                    mus.*,
                                    mdat.*
                                    FROM master_usuarios as mus
                                    LEFT JOIN master_datos_complementarios as mdat ON mdat.identificacion = mus.identificacion
                                    WHERE mus.identificacion = "'.$row->identificacion_patrocinante.'"
                                    ');

            if ($query_patrocinante->num_rows() > 0) {
                foreach ($query_patrocinante->result() as $value) {
                    $data[] = $value;
                }
                return $data;
            }
        } else {
            $data = 'vacio';
            return $data;
        }
    }

     public function updateProfileBase($primerNombre, $segundoNombre, $primerApellido, $segundoApellido, $usr) {
        
        $data = array(
            'nombre' => strtoupper($primerNombre),
            'segundo_nombre' => strtoupper($segundoNombre),
            'apellido' => strtoupper($primerApellido),
            'segundo_apellido' => strtoupper($segundoApellido)
        );

        $this->db->where('identificacion', $usr);
        $this->db->update('master_usuarios', $data);
        return TRUE;
    }

    public function updateProfileComp($direccion, $telefono, $fechaNac, $twitter, $facebook, $instagram, $usr) {
        
        $data = array(
            'direccion' => strtoupper($direccion),
            'fecha_nacimiento' => $fechaNac,
            'telefono' => $telefono,
            'twitter' => $twitter,
            'facebook' => $facebook,
            'instagram' => $instagram
        );

        $this->db->where('identificacion', $usr);
        $this->db->update('master_datos_complementarios', $data);
        return TRUE;
    }

}
