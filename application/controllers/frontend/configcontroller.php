<?php

class configcontroller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('frontend/sessiones/sessionesmodel');
        $this->load->model('frontend/parametros/parametrosmodel');
        $this->load->model('frontend/config/configmodel');
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

    public function indexConfigPwd() {
        $this->val_login();
        //$datos['infoUser'] = $this->profilemodel->getInfoUser($this->session->userdata['identificacion']);
        // $datos['infoSponsor'] = $this->profilemodel->getInfoSponsor($this->session->userdata['identificacion']);
        $datos['page'] = 'config-pwd';
        $datos['folder'] = 'config';
        $this->load->view('frontend/plantilla-panel', $datos);
    }

    public function rcvPwd() {
        $this->form_validation->set_rules('pa', 'pwd temporal', 'trim|required|xss_clean|callback_validarPwdTemp');
        $this->form_validation->set_rules('nc', 'nueva clave', 'trim|required|xss_clean');
        $this->form_validation->set_rules('rpc', 'repetir clave', 'trim|required|xss_clean');
        if ($this->form_validation->run() == TRUE)
        {
            if ($this->configmodel->rcvPwd(sha1($this->input->post('rpc')), $this->session->userdata('Usuario')) == TRUE)
            {
                $datos['mensaje'] = "<div class='alert alert-success'>La clave ha sido modificada.</div>";
                $this->load->view('frontend/error/page-message', $datos);
            }
            else
            {
                $datos['mensaje'] = "<div class='alert alert-danger'>La clave no pudo ser cambiada!.</div>";
                $this->load->view('frontend/error/page-message', $datos);
            }
        }
        else
        {
            $datos['mensaje'] = validation_errors();
            $this->load->view('frontend/error/page-message', $datos);
        }
    }

    function validarPwdTemp($pwd) {
        if ($this->configmodel->validarPwdTemp(sha1($pwd), $this->session->userdata('Usuario')) == FALSE)
        {
            $datos['mensaje'] = "<div class='alert alert-danger'>La clave que ha introducido no es la correcta.</div>";
            $this->load->view('frontend/error/page-message', $datos);
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }

}
