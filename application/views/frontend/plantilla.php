<?php

$this->load->view('frontend/page/header-home');
$this->load->view('frontend/page/' . $pageTop);
if ($subMenu == 'none')
{
    
}
else
{
    $this->load->view('frontend/page/sub-menu-offline');
}
$this->load->view('frontend/' . $folder . '/' . $page);




