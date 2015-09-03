<?php

class kitscontroller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('admin/kits/kitsmodel');
        $this->load->model('admin/parametros/parametrosmodel');
    }

    public function val_login() {
        if ($this->accountmodel->isLogged() === TRUE)
        {
            return TRUE;
        }
        else if ($this->accountmodel->isLogged() === FALSE)
        {
            return FALSE;
        }
    }

    public function index() {
        if ($this->val_login() === FALSE)
        {
            $datos['folder'] = 'account';
            $datos['page'] = 'account';
            $this->load->view('admin/template_admin_home', $datos);
        }
        else
        {
            $datos['usuario'] = $this->session->userdata['user'];
            $datos['infoHeader'] = $this->parametrosmodel->getParamHeader();
            $datos['kit_all'] = $this->kitsmodel->getKitsAll();
            $datos['folder'] = 'kits';
            $datos['page'] = 'crear-kits';
            $this->load->view('admin/template_admin', $datos);
        }
    }
    
    public function crearKits() {

        $this->form_validation->set_rules('_tit', '_tit', 'trim|required|xss_clean');
        $this->form_validation->set_rules('_pre', '_pre', 'trim|required|xss_clean');
        $this->form_validation->set_rules('_cont', '_cont', 'trim|required|xss_clean');
        $this->form_validation->set_rules('_color', '_color', 'trim|required|xss_clean');
        if ($this->form_validation->run() === TRUE)
        {
            $array = array(
                $this->input->post('_tit'),
                $this->input->post('_cont'),
                $this->input->post('_pre'),
                $this->input->post('_color')
            );

            $this->kitsmodel->putKits($array);
        }
        else
        {
            $datos['mensaje'] = validation_error();
            $this->load->view('admin/error/page-message', $datos);
        }
    }
    
    public function inKits() {
        sleep(2);
        $this->form_validation->set_rules('id', 'id', 'trim|required|xss_clean');

        if ($this->form_validation->run() === TRUE)
        {
            $array = array(
                $this->input->post('id')
            );

            $this->kitsmodel->inKits($array);
        }
        else
        {
            $datos['mensaje'] = validation_error();
            $this->load->view('admin/error/page-message', $datos);
        }
    }

}
