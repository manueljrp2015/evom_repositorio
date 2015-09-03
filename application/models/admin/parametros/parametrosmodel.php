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

    function tipoId() {
        $query = $this->db->where('status', '1')->get('vbrdb_tipo_id');
        if ($query->num_rows() > 0)
        {
            foreach ($query->result() as $value)
            {
                $data[] = $value;
            }
            return $data;
        }
    }

    public function getTelefonia() {
        $query = $this->db->get('master_telefonia');
        if ($query->num_rows() > 0)
        {
            foreach ($query->result() as $value)
            {
                $data[] = $value;
            }
            return $data;
        }
    }


}
