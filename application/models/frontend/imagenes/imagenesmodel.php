<?php

class imagenesmodel extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function update_profile($ruta, $ruta_ab, $img) {
        $query = $this->db->query("SELECT fk_cedula_ben FROM db_img_profile WHERE fk_cedula_ben = '" . $this->session->userdata("cedula") . "'");
        if ($query->num_rows() > 0)
        {
            $data = array(
                "ruta" => $ruta,
                "ruta_absoluta" => $ruta_ab,
                "imagen" => $img
            );
            $this->db->where('fk_cedula_ben', $this->session->userdata("cedula"));
            $this->db->update("db_img_profile", $data);
        } else
        {
            $data = array(
                "ruta" => $ruta,
                "ruta_absoluta" => $ruta_ab,
                "imagen" => $img,
                "fk_cedula_ben" => $this->session->userdata("cedula")
            );
            $this->db->insert("db_img_profile", $data);
            return TRUE;
        }
    }

}
