<?php

class home extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('admin/parametros/parametrosmodel');
        
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
            $datos['infoHeader'] = $this->parametrosmodel->getParamHeader();
            $datos['folder'] = 'account';
            $datos['page'] = 'account';
            $this->load->view('admin/template_admin_home', $datos);
        }
        else
        {
            $datos['usuario'] = $this->session->userdata['user'];
            $datos['infoHeader'] = $this->parametrosmodel->getParamHeader();
            $datos['folder'] = 'home';
            $datos['page'] = 'home';
            $this->load->view('admin/template_admin', $datos);
        }
    }

    public function graphParroquias() {
        $this->load->model('admin/parametros/parametrosmodel');
        $datos['analisis_municipio'] = $this->parametrosmodel->analisisPorParroquia($this->input->post('data'));
        $datos['folder'] = 'graph';
        $datos['page'] = 'graph-parroquias';
        $this->load->view('admin/template_listas', $datos);
    }

    public function getListParroquias() {
        $this->load->model('admin/parametros/parametrosmodel');
        $datos['lista'] = $this->parametrosmodel->analisisPorParroquia($this->input->post('data'));
        $datos['folder'] = 'listas';
        $datos['page'] = 'lista_parroquias';
        $this->load->view('admin/template_listas', $datos);
    }

    public function close() {
        $this->accountmodel->close();
        redirect(base_url() . 'admin');
    }

    public function graphMunicipio() {
        $this->load->model('admin/parametros/parametrosmodel');
        $datos['analisis_municipio'] = $this->parametrosmodel->analisisPorMunicipio($this->input->post('estado'));
        $datos['folder'] = 'graph';
        $datos['page'] = 'graph-municipios';
        $this->load->view('admin/template_listas', $datos);
    }

    public function getListMunicipios() {
        $this->load->model('admin/parametros/parametrosmodel');
        $datos['estado'] = $this->input->post('data');
        $datos['lista'] = $datos['analisis_municipio'] = $this->parametrosmodel->analisisPorMunicipio($this->input->post('data'));
        $datos['folder'] = 'listas';
        $datos['page'] = 'lista_municipios';
        $this->load->view('admin/template_listas', $datos);
    }

}
