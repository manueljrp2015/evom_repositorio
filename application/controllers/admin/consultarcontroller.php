<?php

class consultarcontroller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('admin/parametros/parametrosmodel');
        $this->load->model('admin/consultar/consultarmodel');
        $this->load->library('jquery_pagination');
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
            $datos['infoHeader'] = $this->parametrosmodel->getParamHeader();
            $datos['estado'] = $this->parametrosmodel->getEstadoUser($this->session->userdata['codigo_estado']);
            $datos['folder'] = 'consultar';
            $datos['page'] = 'consultar';
            $this->load->view('admin/template_admin', $datos);
        }
    }
    
    public function listMilitantes($offset = 0){
        if ($this->input->is_ajax_request())
            {
                $config['base_url'] = base_url('admin/consultarcontroller/listMilitantes');
                $config['div'] = '#table_militantes';
                $config['show_count'] = true;
                $config['total_rows'] = $this->consultarmodel->numRows($this->session->userdata['codigo_estado']);
                $config['per_page'] = 3;
                $config['num_links'] = 1;

                $config['first_link'] = 'Primero';
                $config['next_link'] = 'Siguiente';
                $this->jquery_pagination->initialize($config);
                $datalista = $this->consultarmodel->getListData($config['per_page'], $offset, $this->session->userdata['codigo_estado']);
                $paginacion = $this->jquery_pagination->create_links();

                $datos = array(
                    'datalist' => $datalista,
                    'paginacion' => $paginacion
                );
                $datos['folder'] = 'listas';
                $datos['page'] = 'lista_militantes';
                $this->load->view('admin/template_listas', $datos);
            }
        }
        
        public function consultarCedula($offset = 0){
        if ($this->input->is_ajax_request())
            {
                $config['base_url'] = base_url('admin/consultarcontroller/listMilitantes');
                $config['div'] = '#table_militantes';
                $config['show_count'] = true;
                $config['total_rows'] = $this->consultarmodel->numRowsConsulta($this->input->post('cedula'));
                $config['per_page'] = 8;
                $config['num_links'] = 1;

                $config['first_link'] = 'Primero';
                $config['next_link'] = 'Siguiente';
                $this->jquery_pagination->initialize($config);
                $datalista = $this->consultarmodel->consultarCedula($config['per_page'], $offset, $this->input->post('cedula'));
                $paginacion = $this->jquery_pagination->create_links();

                $datos = array(
                    'datalist' => $datalista,
                    'paginacion' => $paginacion
                );
                $datos['folder'] = 'listas';
                $datos['page'] = 'lista_militantes';
                $this->load->view('admin/template_listas', $datos);
            }
        }
}
