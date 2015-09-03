<?php

class consultarmodel extends CI_Model {

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
                    WHERE registro.estado_id = "' . $estado . '" AND registro.`status` = 1 LIMIT ' . $offset . ',' . $limit . '');
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
                        WHERE registro.`status` = 1 LIMIT ' . $offset . ',' . $limit . '');
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

    public function consultarCedula($limit, $offset, $cedula) {

        $query = $this->db->query('SELECT 
                    registro.*,
                    est.estado,
                    mun.municipio,
                    par.parroquia
                    FROM vbrdb_registro AS registro
                    LEFT JOIN vbrdb_estados AS est ON est.codigo_estado = registro.estado_id
                    LEFT JOIN vbrdb_municipios AS mun ON mun.codigo_municipio = registro.municipio_id
                    LEFT JOIN vbrdb_parroquias AS par ON par.codigo_parroquia = registro.parroquia_id
                    WHERE registro.cedula = "' . $cedula . '" AND registro.`status` = 1 LIMIT ' . $offset . ',' . $limit . '');

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
    
    public function consultarCedulaPDF($cedula) {

        $query = $this->db->query('SELECT 
                    registro.*,
                    est.estado,
                    mun.municipio,
                    par.parroquia
                    FROM vbrdb_registro AS registro
                    LEFT JOIN vbrdb_estados AS est ON est.codigo_estado = registro.estado_id
                    LEFT JOIN vbrdb_municipios AS mun ON mun.codigo_municipio = registro.municipio_id
                    LEFT JOIN vbrdb_parroquias AS par ON par.codigo_parroquia = registro.parroquia_id
                    WHERE registro.cedula = "' . $cedula . '" AND registro.`status` = 2');

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

    public function numRowsConsulta($cedula) {

        $query = $this->db->query('SELECT 
                    registro.*,
                    est.estado,
                    mun.municipio,
                    par.parroquia
                    FROM vbrdb_registro AS registro
                    LEFT JOIN vbrdb_estados AS est ON est.codigo_estado = registro.estado_id
                    LEFT JOIN vbrdb_municipios AS mun ON mun.codigo_municipio = registro.municipio_id
                    LEFT JOIN vbrdb_parroquias AS par ON par.codigo_parroquia = registro.parroquia_id
                    WHERE registro.cedula = "' . $cedula . '" AND registro.`status` = 1');

        return $query->num_rows();
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
                    WHERE registro.estado_id = "' . $estado . '" AND registro.`status` = 1');
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
                        WHERE registro.`status` = 1');
        }
        return $query->num_rows();
    }

}
