<?php

class initcontroller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('frontend/sessiones/sessionesmodel');
        $this->load->model('frontend/parametros/parametrosmodel');
        $this->load->model('frontend/notices/noticesmodel');
        $this->load->model('frontend/redes/redesmodel');
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

    public function index() {
        $this->val_login();
        $datos['noticias'] = $this->noticesmodel->getNotices();
        $datos['redAnalisis'] = $this->redesmodel->cargarAnalisis($this->session->userdata['identificacion']);
        $member = $this->redesmodel->membresia($this->session->userdata['identificacion']);
        foreach ($member as $value) {
            $id_membresia = $value->id_membresia;
        }

         /*
         * codigo qr
         */

        $this->load->library('ciqrcode');
        //hacemos configuraciones
        $params['data'] = site_url('add-miembro/' . str_replace(" ", "%20", $this->session->userdata("Usuario")));
        $params['level'] = 'H';
        $params['size'] = 3;
        //decimos el directorio a guardar el codigo qr, en este 
        //caso una carpeta en la raíz llamada qr_code
        $params['savename'] = FCPATH . 'assets/pictures/frontend/qrcode/qrcode_' . $this->session->userdata("Usuario") . '.png';
        //generamos el código qr
        $this->ciqrcode->generate($params);


        $datos['factores'] = $this->redesmodel->factores($id_membresia);
        $datos['page'] = 'home';
        $datos['folder'] = 'init-panel';
        $this->load->view('frontend/plantilla-panel', $datos);
    }
    
    public function close() {
        $this->sessionesmodel->close();
        redirect(base_url('home'));
    }

}
