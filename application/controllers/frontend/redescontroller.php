<?php

class redescontroller extends CI_Controller{
    public function __construct() {
        parent::__construct();
        $this->load->model('frontend/sessiones/sessionesmodel');
        $this->load->model('frontend/parametros/parametrosmodel');
        $this->load->model('frontend/redes/redesmodel');
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
    
    public function index(){
        $this->val_login();
        $datos['redListada'] = $this->redesmodel->redListada($this->session->userdata['identificacion']);
        $datos['page'] = 'red-view';
        $datos['folder'] = 'redes';
        $this->load->view('frontend/plantilla-panel', $datos);
    }
    
    public function analisis() {
       $this->val_login();
        $datos['redAnalisis'] = $this->redesmodel->cargarAnalisis($this->session->userdata['identificacion']);
        $member = $this->redesmodel->membresia($this->session->userdata['identificacion']);
        foreach ($member as $value) {
            $id_membresia = $value->id_membresia;
        }
        $datos['factores'] = $this->redesmodel->factores($id_membresia);
        $datos['balanceBonosInicio'] = $this->redesmodel->getBalanceBonoInicio($this->session->userdata['identificacion']);
        $datos['balanceAutoConsumo'] = $this->redesmodel->getBalanceAutoConsumo($this->session->userdata['identificacion']);
        $datos['page'] = 'analisis-red-view';
        $datos['folder'] = 'redes';
        $this->load->view('frontend/plantilla-panel', $datos);
    }
    
}
