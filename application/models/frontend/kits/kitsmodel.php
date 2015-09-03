<?php

class kitsmodel extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getInfoKits($id)
    {

        $q = $this->db
            ->where("_status", "A")
            ->order_by("id", "desc")
            ->get_where("master_kits", array("id" => $id));

        if ($q->num_rows() > 0) {
            foreach ($q->result() as $value) {
                $data[] = $value;
            }
            return $data;
        } else {
            return NULL;
        }
    }

    public function put_order_kits($dat, $files)
    {
        $data = array(
            '_item'            => $dat['_product'],
            '_forma_pay'       => $dat['_fp'],
            '_banco'           => $dat['_ent'],
            '_date_pay'        => Process_kits::format_date($dat['_fecp']),
            '_trans'           => $dat['_trans'],
            '_attach'          => $files,
            '_status'          => "1",
            '_user_buy'        => $this->session->userdata("id_user"),
            '_descripcion_pay' => $dat['_month'],
        );

        $this->db->insert('master_kits_order', $data);
    }

    public function put_kits_user($dat)
    {
        $data = array(
            '_producto' => $dat['_product'],
            '_status'   => "1",
            '_user'     => $this->session->userdata("id_user")
        );

        $this->db->insert('master_kits_user', $data);
    }


    public function get_kits_all()
    {

        $q = $this->db
            ->where("_status", "A")
            ->order_by("id", "desc")
            ->get("master_kits");

        if ($q->num_rows() > 0) {
            foreach ($q->result() as $value) {
                $data[] = $value;
            }
            return $data;
        } else {
            return NULL;
        }
    }

    public function get_status_buy_kits($kit, $user)
    {
        $q = $this->db
            ->get_where("master_kits_order", array(
                "_item"     => $kit,
                "_user_buy" => $user
            ));

        if ($q->num_rows() > 0) {
            foreach ($q->result() as $value) {
                $data[] = $value;
            }
            return $data;
        } else {
            return NULL;
        }
    }

    public function get_my_lits_balance($id_user)
    {
        $q = $this->db
            ->query("
            SELECT
                mkit.*, kit._title,
                fp.descripcion_pago,
                ent._entidad
            FROM
                master_kits_order AS mkit
            LEFT JOIN master_kits AS kit ON kit.id = mkit._item
            LEFT JOIN master_formas_pagos AS fp ON fp.id = mkit._forma_pay
            LEFT JOIN master_entidades_bancarias AS ent ON ent.id = mkit._banco
            WHERE
                mkit._user_buy = '" . $id_user . "'
            ");

        if ($q->num_rows() > 0) {
            foreach ($q->result() as $value) {
                $data[] = $value;
            }
            return $data;
        } else {
            return NULL;
        }
    }

    public function get_my_lits_kits($id_user)
    {
        $q = $this->db
            ->query("
            SELECT
                mkit.*, kit._title
            FROM
                master_kits_user AS mkit
            LEFT JOIN master_kits AS kit ON kit.id = mkit._producto
            WHERE
                mkit._user = '" . $id_user . "'
            ");

        if ($q->num_rows() > 0) {
            foreach ($q->result() as $value) {
                $data[] = $value;
            }
            return $data;
        } else {
            return NULL;
        }
    }

    public function get_verify_kit_user($prod, $user)
    {
        $q = $this->db
            ->get_where("master_kits_user", array(
                "_producto" => $prod,
                "_user"     => $user
            ));

        if ($q->num_rows() > 0) {
            foreach ($q->result() as $value) {
                $data[] = $value;
            }
            return $data;
        } else {
            return NULL;
        }
    }


}

class Process_kits extends kitsmodel
{
    /**
     * @param $dates
     * @return string
     */
    protected function format_date($dates)
    {
        $date = date_create($dates);
        return date_format($date, 'Y-m-d');
    }
}
