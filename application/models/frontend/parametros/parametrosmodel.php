<?php

class parametrosmodel extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function getParamHeader() {
        $query = $this->db->query("select * from master_parametros_header");
        if ($query->num_rows() > 0)
        {
            foreach ($query->result() as $value)
            {
                $data[] = $value;
            }
            return $data;
        }
    }

    public function getKitsActive() {

        $q = $this->db
                ->where("_status", "A")
                ->order_by("id", "desc")
                ->get("master_kits");

        if ($q->num_rows() > 0)
        {
            foreach ($q->result() as $value)
            {
                $data[] = $value;
            }
            return $data;
        }
        else
        {
            return NULL;
        }
    }

    public function getEstado() {
        $query = $this->db->select('codigo_estado,estado')->get('master_estados_vzla');
        if ($query->num_rows() > 0)
        {
            foreach ($query->result() as $value)
            {
                $data[] = $value;
            }
            return $data;
        }
    }

    public function getPaises() {
        $query = $this->db->select('id_pais,Pais')->where('id_pais', '169')->get('master_lista_paises');
        if ($query->num_rows() > 0)
        {
            foreach ($query->result() as $value)
            {
                $data[] = $value;
            }
            return $data;
        }
    }

    function getTelefonia() {
        $query = $this->db->get('vbrdb_telefonia');
        if ($query->num_rows() > 0)
        {
            foreach ($query->result() as $value)
            {
                $data[] = $value;
            }
            return $data;
        }
    }

    function getMunicipio($id) {
        $query = $this->db->select('codigo_municipio,municipio')->where('codigo_estado', $id)->get('vbrdb_municipios');
        if ($query->num_rows() > 0)
        {
            foreach ($query->result() as $value)
            {
                $data[] = $value;
            }
            return $data;
        }
    }

    function getParroquia($id) {
        $query = $this->db->select('codigo_parroquia,parroquia')->where('codigo_municipio', $id)->get('vbrdb_parroquias');
        if ($query->num_rows() > 0)
        {
            foreach ($query->result() as $value)
            {
                $data[] = $value;
            }
            return $data;
        }
    }

    function getSector($id) {
        $query = $this->db->select('codigo_sector,sector')->order_by("sector", "ASC")->where('codigo_parroquia', $id)->get('vbrdb_sectores');
        if ($query->num_rows() > 0)
        {
            foreach ($query->result() as $value)
            {
                $data[] = $value;
            }
            return $data;
        }
    }

    function getUltimoRegistrado() {
        $query = $this->db->limit(1)->select('participante')->order_by("category_id", "DESC")->get('master_multinivel');
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
            return null;
        }
    }

    function getCountRegistrado() {
        $query = $this->db->query('select count(*) as t from master_multinivel');
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
            return null;
        }
    }

    function getRandomRefer() {

        $query = $this->db->query('SELECT
                                    u.login,
                                    u.identificacion
                                    FROM master_usuarios AS u
                                    WHERE u.identificacion IN (20286789,5151436,19985118)
                                    ORDER BY RAND()
                                    LIMIT 1');
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
            return null;
        }
    }

    function get_entidades_bancarias() {
        
        $query = $this->db->get('master_entidades_bancarias');
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
            return null;
        }
    }
    
    function get_formas_pago() {
        
        $query = $this->db->get('master_formas_pagos');
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
            return null;
        }
    }

}
