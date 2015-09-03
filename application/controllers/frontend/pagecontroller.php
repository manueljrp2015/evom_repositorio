<?php 


class pagecontroller extends CI_Controller{

    public function __construct(){
        parent::__construct();
    }

    public function index(){
            $datos['page'] = 'page-who';
            $datos['subMenu'] = 'done';
            $datos['pageTop'] = 'top-menu-register';
            $datos['folder'] = 'pages-info';
            $this->load->view('frontend/plantilla', $datos);
    }

    public function page2(){
            $datos['page'] = 'page-mision-vision';
            $datos['subMenu'] = 'done';
            $datos['pageTop'] = 'top-menu-register';
            $datos['folder'] = 'pages-info';
            $this->load->view('frontend/plantilla', $datos);
    }

    public function page3(){
            $datos['page'] = 'page-valores';
            $datos['subMenu'] = 'done';
            $datos['pageTop'] = 'top-menu-register';
            $datos['folder'] = 'pages-info';
            $this->load->view('frontend/plantilla', $datos);
    }
    
    public function page4(){
            $datos['page'] = 'page-preguntas';
            $datos['subMenu'] = 'done';
            $datos['pageTop'] = 'top-menu-register';
            $datos['folder'] = 'pages-info';
            $this->load->view('frontend/plantilla-panel', $datos);
    }
}