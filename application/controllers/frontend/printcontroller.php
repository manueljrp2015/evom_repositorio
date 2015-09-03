<?php

class printcontroller extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index(){
        $datos['page'] = 'comprobante';
        $datos['folder'] = 'print';
        $this->load->view('frontend/plantilla', $datos);
    }
    
    public function planilla(){
        $datos['page'] = 'planilla';
        $datos['folder'] = 'print';
        $this->load->view('frontend/plantilla', $datos);
    }
}
