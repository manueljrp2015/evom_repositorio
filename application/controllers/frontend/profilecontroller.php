<?php

class profilecontroller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('frontend/sessiones/sessionesmodel');
        $this->load->model('frontend/parametros/parametrosmodel');
        $this->load->model('frontend/profile/profilemodel');
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
        $datos['infoUser'] = $this->profilemodel->getInfoUser($this->session->userdata['identificacion']);
        $datos['infoSponsor'] = $this->profilemodel->getInfoSponsor($this->session->userdata['identificacion']);
        $datos['page'] = 'profile';
        $datos['folder'] = 'profile';
        $this->load->view('frontend/plantilla-panel', $datos);
    }

    public function updateProfileBase(){
        $this->form_validation->set_rules('pn', 'primer nombre', 'trim|required|xss_clean');
        $this->form_validation->set_rules('sn', 'segundo nombre', 'trim|required|xss_clean');
        $this->form_validation->set_rules('pa', 'primer apellido', 'trim|required|xss_clean');
        $this->form_validation->set_rules('sa', 'segundo apellido', 'trim|required|xss_clean');
        if ($this->form_validation->run() == TRUE)
        {
            if ($this->profilemodel->updateProfileBase(
                $this->input->post('pn'), 
                $this->input->post('sn'),
                $this->input->post('pa'),
                $this->input->post('sa'),
                $this->session->userdata('identificacion')) == TRUE)
            {
                $datos['mensaje'] = "<div class='alert alert-success'>Los datos básicos han sido actualizados.</div>";
                $this->load->view('frontend/error/page-message', $datos);
            }
            else
            {
                $datos['mensaje'] = "<div class='alert alert-danger'>Los datos no pudieron ser actualizados!.</div>";
                $this->load->view('frontend/error/page-message', $datos);
            }
        }
        else
        {
            $datos['mensaje'] = validation_errors();
            $this->load->view('frontend/error/page-message', $datos);
        }
    }

    public function updateProfileComp(){
        $this->form_validation->set_rules('dir', 'direccion', 'trim|required|xss_clean');
        $this->form_validation->set_rules('tel', 'telefono', 'trim|required|xss_clean');
        $this->form_validation->set_rules('fec', 'fecha/nac', 'trim|required|xss_clean');
        $this->form_validation->set_rules('twt', 'twitter', 'trim|xss_clean');
        $this->form_validation->set_rules('face', 'facebook', 'trim|xss_clean');
        $this->form_validation->set_rules('inst', 'instagram', 'trim|xss_clean');
        if ($this->form_validation->run() == TRUE)
        {
            if ($this->profilemodel->updateProfileComp(
                $this->input->post('dir'), 
                $this->input->post('tel'),
                procesar::formatFecha($this->input->post('fec')),
                $this->input->post('twt'),
                $this->input->post('face'),
                $this->input->post('inst'),
                $this->session->userdata('identificacion')) == TRUE)
            {
                $datos['mensaje'] = "<div class='alert alert-success'>Los datos complemetarios han sido actualizados.</div>";
                $this->load->view('frontend/error/page-message', $datos);
            }
            else
            {
                $datos['mensaje'] = "<div class='alert alert-danger'>Los datos no pudieron ser actualizados!.</div>";
                $this->load->view('frontend/error/page-message', $datos);
            }
        }
        else
        {
            $datos['mensaje'] = validation_errors();
            $this->load->view('frontend/error/page-message', $datos);
        }
    }

}

/**
* 
*/
class procesar extends profilecontroller
{
    
    protected function formatFecha($date) {
        if (!$date)
        {
            return NULL;
        }
        else
        {
            $explode = explode("-", $date);
            return $explode[2] . '-' . $explode[1] . '-' . $explode[0];
        }
    }
}