<?php

class redirect extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("frontend/parametros/parametrosmodel");
    }

    public function index() {

        $rand = $this->parametrosmodel->getRandomRefer();

        foreach ($rand as $r)
        {
            redirect(base_url('add-miembro/'.$r->login));
        }
    }

}
