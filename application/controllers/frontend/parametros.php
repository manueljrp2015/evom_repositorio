<?php

/*
 * @Dasarollo: TSU Manuel Rodriguez 
 * @Propiedad: VBR Vanguadia bicantanaria republicana
 * @technology: php, codeigniter PHP Framework, Jquery, Bootstrap
 */

class parametros extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('frontend/parametros/parametrosmodel');
    }

    public function getMunicipios() {
        $datos['lista'] = $this->parametrosmodel->getMunicipio($this->input->post('id'));
        $this->load->view('frontend/combolist/municipios', $datos);
    }
    
    public function getParroquia() {
        $datos['lista'] = $this->parametrosmodel->getParroquia($this->input->post('id'));
        $this->load->view('frontend/combolist/parroquias', $datos);
    }
    
    public function getSector() {
        $datos['lista'] = $this->parametrosmodel->getSector($this->input->post('id'));
        $this->load->view('frontend/combolist/sectores', $datos);
    }
    
}


