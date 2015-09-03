<?php

class redesmodel extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function factores($id_membresia) {
        $query = $this->db->query("select nivel1,nivel2,nivel3,nivel4,nivel5,nivel6,nivel7,aporte from master_factores where membresia = '" . $id_membresia . "'");
        if ($query->num_rows() > 0)
        {
            foreach ($query->result() as $value)
            {
                $data[] = $value;
            }
            return $data;
        }
    }

    function redListada($cedula) {
        $query = $this->db->query("CALL spevom_redes_por_nivel('" . $cedula . "')");
        if ($query->num_rows() > 0)
        {
            foreach ($query->result() as $value)
            {
                $data[] = $value;
            }
            
            $query->next_result();
            $query->free_result();
            return $data;
        }
        else
        {
            
            $query->next_result();
            $query->free_result();
            return NULL;
        }
    }

    public function cargarAnalisis($identificador) {
        $query = $this->db->query("SELECT
                                    count(DISTINCTROW t2.participante) as numero_nivel_1,
                                    count(DISTINCTROW t3.participante) as numero_nivel_2,
                                    count(DISTINCTROW t4.participante) as numero_nivel_3,
                                    count(DISTINCTROW t5.participante) as numero_nivel_4,
                                    count(DISTINCTROW t6.participante) as numero_nivel_5,
                                    count(DISTINCTROW t7.participante) as numero_nivel_6,
                                    count(DISTINCTROW t8.participante) as numero_nivel_7
                                    FROM master_multinivel AS t1
                                    LEFT JOIN master_multinivel AS t2 ON t2.identificacion_patrocinante = t1.identificacion_participante AND t2.estado = 0
                                    LEFT JOIN master_multinivel AS t3 ON t3.identificacion_patrocinante = t2.identificacion_participante AND t3.estado = 0
                                    LEFT JOIN master_multinivel AS t4 ON t4.identificacion_patrocinante = t3.identificacion_participante AND t4.estado = 0
                                    LEFT JOIN master_multinivel AS t5 ON t5.identificacion_patrocinante = t4.identificacion_participante AND t5.estado = 0
                                    LEFT JOIN master_multinivel AS t6 ON t6.identificacion_patrocinante = t5.identificacion_participante AND t6.estado = 0
                                    LEFT JOIN master_multinivel AS t7 ON t7.identificacion_patrocinante = t6.identificacion_participante AND t7.estado = 0
                                    LEFT JOIN master_multinivel AS t8 ON t8.identificacion_patrocinante = t6.identificacion_participante AND t8.estado = 0
                                    WHERE t1.identificacion_participante = '" . $identificador . "'");
        if ($query->num_rows() > 0)
        {
            foreach ($query->result() as $value)
            {
                $data[] = $value;
            }
            return $data;
        }
    }

    public function getBalanceBonoInicio($id) {
        $query = $this->db->query("SELECT
                                    COUNT(id) as total_bonos,
                                    COUNT(id) * (((SELECT aporte FROM master_factores) * (SELECT bono_inicio FROM master_factores)) / 100) as bono_ini
                                    FROM master_bonoinicio 
                                    WHERE id_referido = '" . $id . "' AND master_bonoinicio.`status` = 'N/P'");
        if ($query->num_rows() > 0)
        {
            foreach ($query->result() as $value)
            {
                $data[] = $value;
            }
            return $data;
        }
    }

    public function getBalanceAutoConsumo($id) {
        $query = $this->db->query("SELECT
                                    COUNT(id) as total_auto,
                                    periodo,
                                    COUNT(id) * (((SELECT aporte FROM master_factores) * (SELECT auto_consumo FROM master_factores)) / 100) as auto_consumo
                                    FROM master_autoconsumo 
                                    WHERE fk_registrado = '" . $id . "' AND master_autoconsumo.`status` = 'ACTIVO' AND periodo = DATE_FORMAT(NOW(),'%m-%Y')");
        if ($query->num_rows() > 0)
        {
            foreach ($query->result() as $value)
            {
                $data[] = $value;
            }
            return $data;
        }
    }

    public function membresia($id_participante) {
        $this->db->where('identificacion_participante', $id_participante);
        $query = $this->db->get('master_multinivel');

        if ($query->num_rows() > 0)
        {
            $row = $query->row();
            $this->db->where('id_membresia', $row->membresia);
            $query_patrocinante = $this->db->get('membresias');

            if ($query_patrocinante->num_rows() > 0)
            {
                foreach ($query_patrocinante->result() as $value)
                {
                    $data[] = $value;
                }
                return $data;
            }
        }
        else
        {
            $data = 'vacio';
            return $data;
        }
    }

}
