<?php

class noticesmodel extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function getNotices() {

        $q = $this->db
                ->limit(5)
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
    
    public function getAllNotices() {

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

}
