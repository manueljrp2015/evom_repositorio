<?php

class home extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('frontend/sessiones/sessionesmodel');
        $this->load->model('frontend/home/homemodel');
    }

    public function index() {
        $this->load->helper('captcha');
        $datos['page'] = 'home';
        $datos['pageTop'] = 'top-menu-login';
        $datos['subMenu'] = 'none';
        $datos['folder'] = 'home';
        $this->load->view('frontend/plantilla', $datos);
    }

    public function scry() {
        $this->form_validation->set_rules('_email', 'correo', 'trim|required');
        $this->form_validation->set_rules('_pwd', 'Contraseña', 'trim|required|xss_clean');
        $this->form_validation->set_rules('_captchaval', 'Captcha', 'trim|required|xss_clean');
        $this->form_validation->set_rules('_captchavalHash', '_captchavalHash', 'trim|required|xss_clean');
        if ($this->form_validation->run() == TRUE)
        {
            /*if (process::rpHash(strtolower($this->input->post('_captchaval'))) == $this->input->post('_captchavalHash'))
            {
                $datos['mensaje'] = 'El captcha es invalido';
                $this->load->view('frontend/error/page-message', $datos);
                return FALSE;
            }
            else
            {*/

                if ($this->sessionesmodel->initSessions($this->input->post('_email'), $this->input->post('_pwd')) === TRUE)
                {

                    $datos['mensaje'] = 'done';
                    $this->load->view('frontend/error/page-message', $datos);
                }
                else
                {
                    $datos['mensaje'] = 'ha ocurrido un error en el usuario o clave por favor revisar.';
                    $this->load->view('frontend/error/page-message', $datos);
                }
            
        }
        else
        {
            $datos['mensaje'] = 'ha ocurrido un problema con alguno de los datos por favor revise su informacion<br>tenga en cuenta si su correo esta escrito correctamente. ' . validation_errors();
            $this->load->view('frontend/error/page-message', $datos);
        }
    }

    function update() {
        $this->form_validation->set_rules('_ced', 'cedula', 'trim|required|xss_clean|callback_validcedula');

        if ($this->form_validation->run() === TRUE)
        {
            $this->load->helper('string');
            $this->load->library('encrypt');

            $key = random_string('alpha', 15);
            $temp_pass = $this->encrypt->sha1($key);
            $this->homemodel->update_pass($temp_pass, $this->input->post('_ced'));
            $datos['extraer_datos'] = $this->homemodel->extraer_datos($this->input->post('_ced'));
            foreach ($datos['extraer_datos'] as $dt):
                $email = $dt->email;
            endforeach;
            process::EmailPassword($email, $key);
            $datos['mensaje'] = 'done';
            $this->load->view('frontend/error/page-message', $datos);
        }
    }

    function validcedula($cedula) {
        if ($this->homemodel->valida_cedula($cedula) === TRUE)
        {
            return TRUE;
        }
        else
        {
            $datos['mensaje'] = '<ul><li style="font-size: 12px;"><i class="icon-warning-sign"></i> Esta cédula no se encuentra registrada.</li></ul>';
            $this->load->view('frontend/error/page-message', $datos);
            return FALSE;
        }
    }

}

class process extends home {

    protected function ramdomCaptcha() {
        $string = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $st = "";
        for ($i = 0; $i <= strlen($string); $i++)
        {
            if ($i < 6)
            {
                $st .= $string[rand($i, strlen($string) - 1)];
            }
        }
        return $st;
    }

    protected function rpHash($value) {
        $hash = 5381;
        $value = strtoupper($value);
        for ($i = 0; $i < strlen($value); $i++)
        {
            $hash = (($hash << 5) + $hash) + ord(substr($value, $i));
        }
        return $hash;
    }

    protected function EmailPassword($email, $clave) {
        $this->email->from('red@evomtech.com', 'Evom La tierra sin limites');
        $this->email->to($email);
        $this->email->subject('Recuperación de Clave Evom');
        $texto = '<div style="width: 100%; font-family: Arial; font-size: 16px;">
<div style=" color: white; padding: 10px;  background: #00a65a !important; "><strong>Evom La tierra sin limites</strong></div>
                  <p>Le proporciona una clave provisional ya que no recuerda la anterior.</p>
                  <p><b>Datos de acceso:</b></p>
            <table style="width: 650px;padding: 20px;border:  1px solid gainsboro;">
                <tr>
                    <td style="background:   gainsboro;"><b>Correo</b></td>
                    <td style="background:   gainsboro;"><b>Clave Temporal</b></td> 
                </tr>
                <tr>
                    <td style="border:  1px solid gainsboro;">'.$email.'</td>
                    <td style="border:  1px solid gainsboro;">'.$clave.'</td>
                </tr>
                </table>
                <p><h4 style="color: #00a65a;">Copie la clave temporal enviada y peguela en el campo clave de acceso, si desea escribirla debe respetar las mayusculas y las minusculas.</h4></p>
                <p>Recuerda que tu informacion es confidencial, en ningun momento debes responder este correo.</p>
                <hr style="border:  0.1em solid gainsboro;" />
                <div style=" font-family: serif; color: white; padding: 10px; font-size: 25px; background: #00a65a !important; ">
                </div>
                <img src="http://evomtech.com/assets/pictures/frontend/page/logo.png" width="150px" />
                               <br />
        <em>Recuerda que tu informacion es confidencial, en ningun momento debes responder este correo.</em>
                <br />
                <p style="font-size: 9px; color: gray;">Evom La tierra sin limites
                </p>
                </div>';

        $this->email->message($texto);
        $this->email->send();
    }

}
