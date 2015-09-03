<?php

class aprobarmodel extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function getListData($limit, $offset, $estado) {
        if ($estado != '00')
        {
            $query = $this->db->query('SELECT 
                    registro.*,
                    est.estado,
                    mun.municipio,
                    par.parroquia
                    FROM vbrdb_registro AS registro
                    LEFT JOIN vbrdb_estados AS est ON est.codigo_estado = registro.estado_id
                    LEFT JOIN vbrdb_municipios AS mun ON mun.codigo_municipio = registro.municipio_id
                    LEFT JOIN vbrdb_parroquias AS par ON par.codigo_parroquia = registro.parroquia_id
                    WHERE registro.estado_id = "' . $estado . '" AND registro.`status` = 2 LIMIT ' . $offset . ',' . $limit . '');
        }
        else
        {
            $query = $this->db->query('SELECT 
                        registro.*,
                        est.estado,
                        mun.municipio,
                        par.parroquia
                        FROM vbrdb_registro AS registro
                        LEFT JOIN vbrdb_estados AS est ON est.codigo_estado = registro.estado_id
                        LEFT JOIN vbrdb_municipios AS mun ON mun.codigo_municipio = registro.municipio_id
                        LEFT JOIN vbrdb_parroquias AS par ON par.codigo_parroquia = registro.parroquia_id
                        WHERE registro.`status` = 2 LIMIT ' . $offset . ',' . $limit . '');
        }
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

    public function numRows($estado) {

        if ($estado != '00')
        {
            $query = $this->db->query('SELECT 
                    registro.*,
                    est.estado,
                    mun.municipio,
                    par.parroquia
                    FROM vbrdb_registro AS registro
                    LEFT JOIN vbrdb_estados AS est ON est.codigo_estado = registro.estado_id
                    LEFT JOIN vbrdb_municipios AS mun ON mun.codigo_municipio = registro.municipio_id
                    LEFT JOIN vbrdb_parroquias AS par ON par.codigo_parroquia = registro.parroquia_id
                    WHERE registro.estado_id = "' . $estado . '" AND registro.`status` = 2');
        }
        else
        {
            $query = $this->db->query('SELECT 
                        registro.*,
                        est.estado,
                        mun.municipio,
                        par.parroquia
                        FROM vbrdb_registro AS registro
                        LEFT JOIN vbrdb_estados AS est ON est.codigo_estado = registro.estado_id
                        LEFT JOIN vbrdb_municipios AS mun ON mun.codigo_municipio = registro.municipio_id
                        LEFT JOIN vbrdb_parroquias AS par ON par.codigo_parroquia = registro.parroquia_id
                        WHERE registro.`status` = 2');
        }
        return $query->num_rows();
    }

    function aprobarMilitantes($cedula) {
        $data = array(
            'status' => 1,
        );

        $this->db->where('cedula', $cedula);
        $this->db->update('vbrdb_registro', $data);
        return TRUE;
    }

}
