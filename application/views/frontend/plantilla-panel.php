<?php

$this->load->view('frontend/page/header-home');
$this->load->view('frontend/page/top-menu');
$this->load->view('frontend/page/sub-menu');
$this->load->view('frontend/'.$folder.'/'.$page);
$this->load->view('frontend/page/footer');
