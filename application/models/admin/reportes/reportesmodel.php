<?php

class reportesmodel extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function analisisPorEstado($estado) {

        $query = $this->db->query('SELECT 
                    registro.*,
                    est.estado,
                    mun.municipio,
                    par.parroquia
                    FROM vbrdb_registro AS registro
                    LEFT JOIN vbrdb_estados AS est ON est.codigo_estado = registro.estado_id
                    LEFT JOIN vbrdb_municipios AS mun ON mun.codigo_municipio = registro.municipio_id
                    LEFT JOIN vbrdb_parroquias AS par ON par.codigo_parroquia = registro.parroquia_id
                    WHERE registro.estado_id = "' . $estado . '" AND registro.`status` = 1 ORDER BY registro.municipio_id ASC, registro.cedula ');


        if ($query->num_rows() > 0)
        {
            foreach ($query->result() as $row)
            {
                $data[] = $row;
            }
            return $data;
        }
        else
        {
            return $data = 'vacio';
        }
    }

    public function analisisPorMunicipio($municipio) {

        $query = $this->db->query('SELECT 
                    registro.*,
                    est.estado,
                    mun.municipio,
                    par.parroquia
                    FROM vbrdb_registro AS registro
                    LEFT JOIN vbrdb_estados AS est ON est.codigo_estado = registro.estado_id
                    LEFT JOIN vbrdb_municipios AS mun ON mun.codigo_municipio = registro.municipio_id
                    LEFT JOIN vbrdb_parroquias AS par ON par.codigo_parroquia = registro.parroquia_id
                    WHERE registro.municipio_id = "' . $municipio . '" AND registro.`status` = 1 ORDER BY registro.cedula ASC');


        if ($query->num_rows() > 0)
        {
            foreach ($query->result() as $row)
            {
                $data[] = $row;
            }
            return $data;
        }
        else
        {
            return $data = 'vacio';
        }
    }
    
    public function analisisPorParroquia($parroquia) {

        $query = $this->db->query('SELECT 
                    registro.*,
                    est.estado,
                    mun.municipio,
                    par.parroquia
                    FROM vbrdb_registro AS registro
                    LEFT JOIN vbrdb_estados AS est ON est.codigo_estado = registro.estado_id
                    LEFT JOIN vbrdb_municipios AS mun ON mun.codigo_municipio = registro.municipio_id
                    LEFT JOIN vbrdb_parroquias AS par ON par.codigo_parroquia = registro.parroquia_id
                    WHERE registro.parroquia_id = "'.$parroquia.'" AND registro.`status` = 1 ORDER BY registro.cedula ASC');


        if ($query->num_rows() > 0)
        {
            foreach ($query->result() as $row)
            {
                $data[] = $row;
            }
            return $data;
        }
        else
        {
            return $data = 'vacio';
        }
    }

}
