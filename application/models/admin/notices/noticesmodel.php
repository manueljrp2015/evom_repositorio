<?php

class noticesmodel extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function getNotices() {

        $q = $this->db
                ->where("_status", "A")
                ->order_by("id", "desc")
                ->get("master_noticias");

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

    public function putNotices($ar) {

        $data = array(
            '_title' => $ar[0],
            '_notice' => $ar[1],
        );

        $this->db->insert('master_noticias', $data);
        return TRUE;
    }

    public function inNotices($ar) {
        
        $data = array(
            '_status' => 'I',
        );

        $this->db->where('id', $ar[0]);
        $this->db->update('master_noticias', $data);
        return TRUE;
    }

}
