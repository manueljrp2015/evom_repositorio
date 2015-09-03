<?php

class configcontroller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('admin/config/configmodel');
        $this->load->model('admin/parametros/parametrosmodel');
        //$datos['infoHeader'] = $this->parametrosmodel->getParamHeader();
    }

    public function val_login() {
        if ($this->accountmodel->isLogged() === TRUE)
        {
            return TRUE;
        } else if ($this->accountmodel->isLogged() === FALSE)
        {
            return FALSE;
        }
    }

    public function configHeader() {
        if ($this->val_login() === FALSE)
        {
            $datos['folder'] = 'account';
            $datos['page'] = 'account';
            $this->load->view('admin/template_admin_home', $datos);
        } else
        {
            $datos['usuario'] = $this->session->userdata['user'];
            
            $datos['folder'] = 'config';
            $datos['page'] = 'config-header';
            $this->load->view('admin/template_admin', $datos);
        }
    }

    public function configFooter() {
        if ($this->val_login() === FALSE)
        {
            $datos['folder'] = 'account';
            $datos['page'] = 'account';
            $this->load->view('admin/template_admin_home', $datos);
        } else
        {
            $datos['usuario'] = $this->session->userdata['user'];
            $datos['estado'] = $this->parametrosmodel->getEstadoUser($this->session->userdata['codigo_estado']);
            $datos['org'] = $this->configmodel->getListOrganizacion();
            $datos['estados'] = $this->configmodel->getEstados();
            $datos['folder'] = 'config';
            $datos['page'] = 'config-sectores';
            $this->load->view('admin/template_admin', $datos);
        }
    }

    public function putOrgano() {
        $this->form_validation->set_rules('_org', '_org', 'trim|required|xss_clean');
        $this->form_validation->set_rules('_dir', '_dir', 'trim|xss_clean');
        $this->form_validation->set_rules('_resp', '_resp', 'trim|required|xss_clean');
        $this->form_validation->set_rules('_desc', '_desc', 'trim|required|xss_clean');
        if ($this->form_validation->run() === TRUE)
        {

            $this->configmodel->putOrgano($this->input->post("_org"), $this->input->post("_dir"), $this->input->post("_resp"), $this->input->post("_desc")
            );
            $datos['mensaje'] = 'done';
            $this->load->view('frontend/error/page-message', $datos);
        }
    }

    public function updateOrgano() {
        $this->form_validation->set_rules('_id', '_id', 'trim|required|xss_clean');
        $this->form_validation->set_rules('_org', '_org', 'trim|required|xss_clean');
        $this->form_validation->set_rules('_dir', '_dir', 'trim|xss_clean');
        $this->form_validation->set_rules('_resp', '_resp', 'trim|required|xss_clean');
        $this->form_validation->set_rules('_desc', '_desc', 'trim|required|xss_clean');
        if ($this->form_validation->run() === TRUE)
        {

            $this->configmodel->updateOrgano($this->input->post("_org"), $this->input->post("_dir"), $this->input->post("_resp"), $this->input->post("_desc"), $this->input->post("_id")
            );
            $datos['mensaje'] = 'done';
            $this->load->view('frontend/error/page-message', $datos);
        }
    }

    public function deleteOrgano() {
        $this->form_validation->set_rules('_id', '_id', 'trim|required|xss_clean');
        if ($this->form_validation->run() === TRUE)
        {

            $this->configmodel->deleteOrgano(
                    $this->input->post("_id")
            );
            $datos['mensaje'] = 'done';
            $this->load->view('frontend/error/page-message', $datos);
        }
    }

    function emailRegistro($email) {
        $this->email->from('webmaster@vbr.org.ve', 'VBR Vanguardia Bicentenaria Republicana');
        $this->email->to($email);
        $this->email->subject('Aprobado Como Militante, Felicitaciones');
        $texto = '
                  <strong><h2>:: VBR :: Felicitaciones Solicitud <b>Aprobada</b></h2></strong>
                  <p>Estimado, <b> Su registro como militante a las filas de Vanguardia Bicentenaria Republicana fue aprobada por nuestros dirigentes, les damos la mas cordial bienvenida.</p>
           
                <p>En ningun momento debes responder este correo.</p>
                <hr>
                <img src="' . base_url() . 'assets/pictures/frontend/page/imagen-registro_liston.png" width="30%">
                ';

        $this->email->message($texto);
        $this->email->send();
    }

    function emailWebmaster($cedula, $pn, $pa, $estado, $municip, $parroq, $t_id, $cel) {
        $this->email->from('webmaster@vbr.org.ve', 'VBR Vanguardia Bicentenaria Republicana');
        $this->email->to('webmaster@vbr.org.ve');
        $this->email->subject('Registrado militante ' . $pn . ' ' . $pa);
        $texto = '
                  <strong><h2>:: VBR :: Vanguardia Bicentenaria Republicana</h2></strong>
                  <p>El Militante, <b>' . $pn . ' ' . $pa . ' - ' . $cedula . ' del ' . $estado . ' - ' . $municip . ' - ' . $parroq . ' Cel: ' . $t_id . '-' . $cel . '</b> se registro con exito y se encuentra en status de TRANSITO.</p>
                <hr>
                <img src="' . base_url() . 'assets/pictures/frontend/page/imagen-registro_liston.png" width="30%">
                ';

        $this->email->message($texto);
        $this->email->send();
    }

    public function getMunicipios() {
        $datos['lista'] = $this->configmodel->getMunicipio($this->input->post('id'));
        $this->load->view('admin/combolist/municipios', $datos);
    }

    public function getParroquia() {
        $datos['lista'] = $this->configmodel->getParroquia($this->input->post('id'));
        $this->load->view('admin/combolist/parroquias', $datos);
    }

    public function getSector() {
        $datos['lista'] = $this->configmodel->getSector($this->input->post('id'));
        $this->load->view('admin/combolist/sectores', $datos);
    }

    public function putSector() {
        $this->form_validation->set_rules('_id_sector', '_id_sector', 'trim|required|xss_clean');
        $this->form_validation->set_rules('_nuevo_sector', '_nuevo_sector', 'trim|required|xss_clean');
        if ($this->form_validation->run() === TRUE)
        {
            if ($this->input->post("_id_sector") === "_nvo")
            {
                $id_sector = procesar::generateIdSector($this->input->post("parroquia"));
                $process = 'INSERT';
                $parroquia = $this->input->post("parroquia");
            } else
            {
                $id_sector = $this->input->post("_id_sector");
                $process = 'UPDATE';
                $parroquia = '';
            }
            $this->configmodel->putSector(
                    $id_sector, $this->input->post("_nuevo_sector"), $process,$parroquia
            );
            $datos['mensaje'] = 'done';
            $this->load->view('frontend/error/page-message', $datos);
        }
    }

}

class procesar extends configcontroller {

    protected function generateIdSector($id_parroquia) {
        return $this->configmodel->getLostIdSector($id_parroquia);
    }

}
