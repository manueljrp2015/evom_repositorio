<?php

class configmodel extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function putOrgano($o, $d, $r, $des) {
        $data = array(
            'organizacion' => strtoupper($o),
            'direccion' => strtoupper($d),
            'responzable' => strtoupper($r),
            'descripcion' => strtoupper($des),
        );
        $this->db->insert('db_organizaciones', $data);
    }

    public function updateOrgano($o, $d, $r, $des, $id) {
        $data = array(
            'organizacion' => strtoupper($o),
            'direccion' => strtoupper($d),
            'responzable' => strtoupper($r),
            'descripcion' => strtoupper($des),
        );
        $this->db->where("id", $id);
        $this->db->update('db_organizaciones', $data);
    }

    public function putSector($id, $sector, $process, $parroquia) {
        if ($process === 'INSERT')
        {
            $data = array(
                'codigo_sector' => $id,
                'codigo_parroquia' => $parroquia,
                'sector' => strtoupper($sector)
            );
            $this->db->insert('vbrdb_sectores', $data);
        } elseif ($process === 'UPDATE')
        {
            $data = array(
                'sector' => strtoupper($sector),
            );
            $this->db->where("codigo_sector", $id);
            $this->db->update('vbrdb_sectores', $data);
        }
    }

    public function deleteOrgano($id) {
        $this->db->where("id", $id);
        $this->db->delete('db_organizaciones');
    }

    public function getListOrganizacion() {
        $query = $this->db->get("db_organizaciones");
        if ($query->num_rows() > 0)
        {
            foreach ($query->result() as $value)
            {
                $data[] = $value;
            }
            return $data;
        } else
        {
            return FALSE;
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

    public function getEstados() {
        $query = $this->db->order_by('estado', 'ASC')->get('vbrdb_estados');
        if ($query->num_rows() > 0)
        {
            foreach ($query->result() as $row)
            {
                $data[] = $row;
            }
            return $data;
        } else
        {
            return $data = 'vacio';
        }
    }

    public function getLostIdSector($id) {
        $query = $this->db->select('codigo_parroquia,codigo_sector')
                ->where('codigo_parroquia', $id)
                ->order_by('codigo_sector', "ASC")
                ->get('vbrdb_sectores')
        ;
        if ($query->num_rows() > 0)
        {
            foreach ($query->result() as $row)
            {
                $data = sprintf("%08d",$row->codigo_sector + 1);
            }
            return $data;
        } else
        {
            return $data = $id . "01";
        }
    }

}
