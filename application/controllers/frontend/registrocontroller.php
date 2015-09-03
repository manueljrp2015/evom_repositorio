<?php

class registrocontroller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('frontend/registro/registromodel');
        $this->load->model('frontend/parametros/parametrosmodel');
        $this->load->model('frontend/validadores/validadormodel');
    }

    public function index() {

        if ($this->registromodel->infoSponsor(str_replace("%20", " ", $this->uri->segment(2))) === 'vacio')
        {
            redirect(base_url());
        }
        else
        {
            $datos['datosSponsor'] = $this->registromodel->infoSponsor(str_replace("%20", " ", $this->uri->segment(2)));
            foreach ($this->registromodel->infoSponsor(str_replace("%20", " ", $this->uri->segment(2))) as $value)
            {
                $email = $value->email;
            }
            $datos['infoHeader'] = $this->parametrosmodel->getParamHeader();
            $datos['estadoVzla'] = $this->parametrosmodel->getEstado();
            $datos['listaPaises'] = $this->parametrosmodel->getPaises();
            $datos['ultimoRegistrado'] =$this->parametrosmodel->getUltimoRegistrado();
            $datos['countRegistrado'] =$this->parametrosmodel->getCountRegistrado();
            $datos['page'] = 'add_natural';
            $datos['subMenu'] = 'done';
            $datos['pageTop'] = 'top-menu-register';
            $datos['folder'] = 'registro';
            $this->load->view('frontend/plantilla', $datos);
        }
    }

    public function procesar() {
        $this->form_validation->set_rules('Email', 'Email', 'trim|required|xss_clean|callback_validarEmail');
        $this->form_validation->set_rules('nombre', 'Nombre', 'trim|required|xss_clean');
        $this->form_validation->set_rules('id_user', 'Identificacion', 'trim|required|xss_clean|callback_ValidarId');
        $this->form_validation->set_rules('apodo', 'Apodo', 'trim|required|xss_clean|callback_validarUser');
        $this->form_validation->set_rules('apellido', 'Apellido', 'trim|required|xss_clean');
        $this->form_validation->set_rules('password', 'Contraseña', 'trim|required|matches[confirm_password]|sha1');
        $this->form_validation->set_rules('confirm_password', 'Repetir Contraseña', 'trim|required|xss_clean');
        $this->form_validation->set_rules('hiddem-url', 'Patrocinante', 'trim|required');
        $this->form_validation->set_rules('hiddem-email', 'Email Patrocinante', 'trim|required');
        $this->form_validation->set_rules('pais', 'Pais', 'trim|required');
        $this->form_validation->set_rules('telf', 'Telefono', 'trim|required');
        $this->form_validation->set_rules('estado', 'Estado', 'trim|required');

        if ($this->form_validation->run() == TRUE)
        {
            $serial = procesos::invertirString($this->input->post('id_user'));
            $invitacion = 'EVON:' . strtoupper($this->input->post('apodo')) . ':' . sprintf("%012d", $this->input->post('id_user'));
            if ($this->registromodel->registrar($this->input->post('Email'), $this->input->post('nombre'), $this->input->post('apellido'), $this->input->post('password'), $this->input->post('id_user'), $this->input->post('apodo'), $serial, $invitacion, $this->input->post('hiddem-url'), $this->input->post('pais'), $this->input->post('telf'), $this->input->post('estado')) === TRUE)
            {
                procesos::crearFolderUser($this->input->post('Email'), $this->input->post('apodo'));
                procesos::insertBonoInicio($this->input->post('hiddem-url'), $this->input->post('id_user'));
                procesos::sendEmailRegistro($this->input->post('Email'), $this->input->post('nombre')." ". $this->input->post('apellido'), $this->input->post('confirm_password'),  $this->input->post('apodo'));
                procesos::sendEmailRegistroSponsor($this->input->post('hiddem-email'), $this->input->post('nombre')." ". $this->input->post('apellido'),  $this->input->post('apodo'));
                procesos::sendEmailRegistroSystem('red@evomtech.com', $this->input->post('nombre')." ". $this->input->post('apellido'),  $this->input->post('apodo'));
                $datos['mensaje'] = 'done';
                $this->load->view('frontend/error/page-message', $datos);
            }
        }
        else
        {
            $datos['mensaje'] = validation_errors();
            $this->load->view('frontend/error/page-message', $datos);
        }
    }

    public function validarEmail($correo) {
        if ($this->validadormodel->validarEmail($correo) === TRUE)
        {
            $datos['mensaje'] = '<ul><li style="font-size: 12px;">Este correo <b>' . $correo . '</b> ya se encuentra registrado por favor pruebe con otro.</li></ul>';
            $this->load->view('frontend/error/page-message', $datos);
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }

    public function validarUser($usr) {
        if ($this->validadormodel->validarUser($usr) === TRUE)
        {
            $datos['mensaje'] = '<ul><li style="font-size: 12px;">Este usuario <b>' . $usr . '</b> ya se encuentra en uso por favor pruebe con otro.</li></ul>';
            $this->load->view('frontend/error/page-message', $datos);
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }

    public function ValidarId($id_usr) {
        if ($this->validadormodel->ValidarId($id_usr) === TRUE)
        {
            $datos['mensaje'] = '<ul><li style="font-size: 12px;">Este participante <b>' . $id_usr . '</b> ya se encuentra registrado, recuerde que solo puede estar incluido en el sistema una sola vez.</li></ul>';
            $this->load->view('frontend/error/page-message', $datos);
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }

    
}

class procesos extends registrocontroller {

    protected function crearUsuario($email) {
        $exp = explode("@", $email);
        $nuevo_usuario = str_replace(array("-", "_"), "", $exp[0]);
        return $nuevo_usuario;
    }

    protected function crearTemPassword() {
        $string = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $st = "";
        for ($i = 0; $i <= strlen($string); $i++)
        {
            if ($i < 12)
            {
                $st .= $string[rand($i, strlen($string) - 1)];
            }
        }
        return $st;
    }

    protected function invertirString($string) {
        $date = date('Ymd');
        $newString = sprintf($string . $date);
        return $newString;
    }

    public function crearFolderUser($correo, $user) {
        $correo_eexplode = explode("@", $correo);
        $replace_correo = str_replace(array(".", "-", "*"), "_", $correo_eexplode[0]);
        $direccion_file = './assets/pictures/frontend/profile/' . strtolower($replace_correo);
        if (file_exists($direccion_file))
        {
            return FALSE;
        }
        else
        {
            mkdir($direccion_file);
            $this->registromodel->insertFolderUser($direccion_file, $user);
            chmod($direccion_file, 0777);
            return TRUE;
        }
    }

    protected function fechaExpiracionDemoLic() {
        $fecha = date_create(date("Y-m-d h:m:s"));
        date_add($fecha, date_interval_create_from_date_string('60 days'));
        return date_format($fecha, 'Y-m-d h:m:s');
    }

    protected function insertBonoInicio($refer, $newRegistre) {
        $this->registromodel->insertBonoInicio($refer, $newRegistre);
    }

    protected function sendEmailRegistro($correo, $nombre, $clave, $apodo) {
        $this->email->from('red@evomtech.com', 'Evom La tierra sin limites');
        $this->email->to($correo);
        $this->email->subject($nombre. ' Eres Nuevo Miembro Evom');
        $ref = '<a href=' . base_url() . 'add-miembro/' . str_replace(" ", "%20", $apodo) . '>' . base_url() . 'add-miembro/' . str_replace(" ", "%20", $apodo) . '</a>';
        $texto = '
           
            <div style="width: 100%; font-family: Arial; font-size: 16px;">
<div style=" color: white; padding: 10px; font-size: 25px; background: #00a65a !important;"><strong>Evom La tierra sin limites</strong></div>
<div style="padding: 25px;">
                  <p>Evom te da la bienvenida a nuestro sistema de asociados, para nosotros es un placer tenerlo como miembro de nuestra familia.</p>
                  <p><b>Datos de la cuenta:</b></p>
          
                        <table style="width: 950px;padding: 20px;border:  1px solid gainsboro;">
                            <tr>
                                <td style="background:   gainsboro;"><b>Nombre y apellido</b></td>
                                <td style="background:   gainsboro;"><b>Clave</b></td>
                                <td style="background:   gainsboro;"><b>Apodo</b></td>
                                <td style="background:   gainsboro;"><b>Link</b></td>
                            </tr>
                            <tr>
                                <td style="border:  1px solid gainsboro;">'.$nombre.'</td>
                                <td style="border:  1px solid gainsboro;">'.$clave.'</td>
                                <td style="border:  1px solid gainsboro;">'.$apodo.'</td>
                                <td style="border:  1px solid gainsboro;">'.$ref.'</td>
                            </tr>
                        </table>
                        <br />
          <hr style="border:  0.1em solid gainsboro;" />
                <div style="font-family: serif; color: white; padding: 10px; font-size: 25px; background: #00a65a !important; ">
                </div>
                <img src="http://evomtech.com/assets/pictures/frontend/page/logo.png" width="150px" />
                               <br />
        <em>Recuerda que tu informacion es confidencial, en ningun momento debes responder este correo.</em>
                <br />
                <p style="font-size: 9px; color: gray;">Evom La tierra sin limites
                </p>
                </div>
                ';

        $this->email->message($texto);
        $this->email->send();
    }
    
    protected function sendEmailRegistroSponsor($correo, $nombre, $apodo) {
        $this->email->from('red@evomtech.com', 'Evom La tierra sin limites');
        $this->email->to($correo);
        $this->email->subject('Se registro en su red '.$nombre);
        $texto = '
           
            <div style="padding: 25px;">
                  <strong><h2>Evom La tierra sin limites</h2></strong>
                  <p>Se ha asociado un nuevo miembro a su red <strong>'.$nombre.' ('.$apodo.')</strong></p>
                        <br>
        <em>Recuerda que tu informacion es confidencial, en ningun momento debes responder este correo.</em>
                <br>
                <p style="font-size: 9px; color: gray;">Evom La tierra sin limites
                </p>
                ';

        $this->email->message($texto);
        $this->email->send();
    }
    
    protected function sendEmailRegistroSystem($correo, $nombre, $apodo) {
        $this->email->from('red@evomtech.com', 'Evom La tierra sin limites');
        $this->email->to($correo);
        $this->email->subject('Se registro  '.$nombre);
        $texto = '
           
            <div style="padding: 25px;">
                  <strong><h2>Evom La tierra sin limites</h2></strong>
                  <p>Se registro <strong>'.$nombre.' ('.$apodo.') '.date("d-M-Y h:m_s").'</strong></p>
                        <br>
        <em>Recuerda que tu informacion es confidencial, en ningun momento debes responder este correo.</em>
                <br>
                <p style="font-size: 9px; color: gray;">Evom La tierra sin limites
                </p>
                ';

        $this->email->message($texto);
        $this->email->send();
    }

}
