<?php

class user extends CI_Controller{
    public function __construct() {
        parent::__construct();
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
    
    public function index(){
        if ($this->val_login() === FALSE)
        {
            $datos['folder'] = 'account';
            $datos['page'] = 'account';
            $this->load->view('admin/template_admin', $datos);
        }
        else
        {
            $datos['usuario'] = $this->session->userdata['user'];
            $datos['folder'] = 'user';
            $datos['page'] = 'user';
            $this->load->view('admin/template_admin', $datos);
        }
    }
    
    public function holamundo(){
        $datos['mensaje'] = '1';
                $this->load->view('font_end/page-message', $datos);
    }
}

