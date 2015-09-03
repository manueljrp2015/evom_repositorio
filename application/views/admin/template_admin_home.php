<?php

$this->load->view('admin/page/header');
$this->load->view('admin/page/top-menu-home');
$this->load->view('admin/' . $folder . '/' . $page);
$this->load->view('admin/page/footer');

