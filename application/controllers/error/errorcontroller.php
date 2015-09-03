<?php

class errorcontroller extends CI_Controller{
    public function __construct() {
        parent::__construct();
    }
    
    public function index(){
        $this->load->view('frontend/error/error');
    }
}

