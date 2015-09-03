<?php

class reportescontroller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('admin/parametros/parametrosmodel');
        $this->load->model('admin/reportes/reportesmodel');
    }

    public function val_login() {
        if ($this->accountmodel->isLogged() === TRUE)
        {
            return TRUE;
        }
        else if ($this->accountmodel->isLogged() === FALSE)
        {
            return FALSE;
        }
    }

    public function index() {
        if ($this->val_login() === FALSE)
        {
            $datos['folder'] = 'account';
            $datos['page'] = 'account';
            $this->load->view('admin/template_admin_home', $datos);
        }
        else
        {
            $datos['usuario'] = $this->session->userdata['user'];
            $datos['estados'] = $this->parametrosmodel->getEstados($this->session->userdata['codigo_estado']);
            $datos['estado'] = $this->parametrosmodel->getEstadoUser($this->session->userdata['codigo_estado']);
            $datos['folder'] = 'reportes';
            $datos['page'] = 'reportes';
            $this->load->view('admin/template_admin', $datos);
        }
    }
    
    public function getMunicipios() {
        $datos['lista'] = $this->parametrosmodel->getMunicipio($this->input->post('id'));
        $this->load->view('admin/combolist/municipios', $datos);
    }
    
    public function getParroquia() {
        $datos['lista'] = $this->parametrosmodel->getParroquia($this->input->post('id'));
        $this->load->view('admin/combolist/parroquias', $datos);
    }

}
