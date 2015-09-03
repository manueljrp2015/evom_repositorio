<?php

class noticescontroller extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('frontend/sessiones/sessionesmodel');
        $this->load->model("frontend/notices/noticesmodel");
        $this->load->model('frontend/parametros/parametrosmodel');
    }

    public function val_login() {

        if ($this->sessionesmodel->isLogged() === TRUE)
        {
            return TRUE;
        }
        else if ($this->sessionesmodel->isLogged() === FALSE)
        {
            redirect(base_url());
        }
    }

    public function index() {

        $this->val_login();

        $datos['page'] = 'notices-view-all';
        $datos['folder'] = 'notices';
        $datos['notices_all'] = $this->noticesmodel->getAllNotices();
        $this->load->view('frontend/plantilla-panel', $datos);
    }

}
