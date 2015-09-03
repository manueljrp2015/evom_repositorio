<?php

class kitsmodel extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function putKits($ar) {

        $data = array(
            '_title' => $ar[0],
            '_descr' => $ar[1],
            '_precio' => $ar[2],
            '_color' => $ar[3]
        );

        $this->db->insert('master_kits', $data);
        return TRUE;
    }
    
    public function getKitsAll() {

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
    
    public function inKits($ar) {
        
        $data = array(
            '_status' => 'I',
        );

        $this->db->where('id', $ar[0]);
        $this->db->update('master_kits', $data);
        return TRUE;
    }

}
