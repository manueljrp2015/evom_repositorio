<?php

class emailcontroller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('frontend/validadores/validadormodel');
        $this->load->model('frontend/sessiones/sessionesmodel');
    }
    
    public function val_login() {
        if ($this->sessionesmodel->isLogged() === TRUE) {
            return TRUE;
        } else if ($this->sessionesmodel->isLogged() === FALSE) {
            redirect(base_url());
        }
    }

    public function index() {
        $this->val_login();
        $datos['page'] = 'validar-email';
        $datos['folder'] = 'validar';
        $datos['email'] = $this->validadormodel->getEmail($this->session->userdata('serial'));
        $this->load->view('frontend/plantilla_home', $datos);
    }

    public function uriemail() {
        $this->val_login();
        $datos['page'] = 'validar-cedula';
        $datos['folder'] = 'validar';
        $datos['datos'] = $this->validadormodel->getDatos(base64_decode($this->input->get('c')));
        $this->load->view('frontend/plantilla_home', $datos);
    }

    public function cedulaVerficador() {
        if ($this->validadormodel->cedulaVerficador($this->input->post('cedula'), $this->input->post('serial')) == TRUE)
        {
            $datos['mensaje'] = 'done';
            $this->load->view('frontend/error/page-message', $datos);
        }
        else
        {
            $datos['mensaje'] = 'fail';
            $this->load->view('frontend/error/page-message', $datos);
        }
    }

    function emailVerficador() {
        $email = $this->input->post('correo');
        $cedula = $this->input->post('cedula');
        $serial = $this->input->post('serial');
        if ($this->validadormodel->emailDetector($email,$cedula) == TRUE)
        {
            $datos['mensaje'] = 'fail';
            $this->load->view('frontend/error/page-message', $datos);
        }
        else
        {
            $this->email->from('registro@viviendadigna.org.ve', 'Vivienda Digna Para Santiago Mariño');
            $this->email->to($email);
            $this->email->subject('Verificacion de correo.');
            $texto = '
                  <strong>ELISAUL REYES te da la bienvenida a:</strong>
                  <p><strong>Frente de Unidad Popular “Lucha por una vivienda digna para Mariño”.</strong></p>
                  <p>Le informo que hemos recibido una solicitud de verificación de correo electrónico, presione o haga click en el siguiente enlace.</p>
            <table>
                <tr>
                    <td><b>Enlace de Activacion y registro de datos</b></td>
                    <td align="right"><a href=' . base_url() . 'validate/process?c=' . base64_encode($email) . '>data=' . base64_encode($email) . '</a></td>
                </tr>
                </table>
                <p>Recuerda que tu información es confidencial, en ningún momento debes responder este correo.</p>
                <hr>
                
                ';

            $this->email->message($texto);
            $this->email->send();
            $this->validadormodel->update($cedula, $email, $serial);
            $datos['mensaje'] = 'done';
            $this->load->view('frontend/error/page-message', $datos);
        }
    }

}
