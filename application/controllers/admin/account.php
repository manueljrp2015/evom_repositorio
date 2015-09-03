<?php

class account extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function validaUsr() {
        $this->form_validation->set_rules('usr', 'Usr', 'trim|required|xss_clean');
        $this->form_validation->set_rules('pwd', 'Contraseña', 'trim|required|xss_clean|sha1');

        if ($this->form_validation->run() === true)
        {
            if ($this->accountmodel->validAccount($this->input->post('usr'), $this->input->post('pwd')) === TRUE)
            {
                $datos['mensaje'] = '1';
                $this->load->view('admin/error/page-message', $datos);
            }
            else
            {
                $datos['mensaje'] = '2';
                $this->load->view('admin/error/page-message', $datos);
            }
        }
        else
        {
            $datos['mensaje'] = '0';
            $this->load->view('admin/error/page-message', $datos);
        }
    }

}
