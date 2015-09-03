<?php

class kitcontroller extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('frontend/sessiones/sessionesmodel');
        $this->load->model("frontend/kits/kitsmodel");
        $this->load->model('frontend/parametros/parametrosmodel');
    }

    public function val_login()
    {

        if ($this->sessionesmodel->isLogged() === TRUE) {
            return TRUE;
        } else if ($this->sessionesmodel->isLogged() === FALSE) {
            redirect(base_url());
        }
    }

    public function index()
    {

        $this->val_login();

        $datos['page'] = 'kit-view';
        $datos['folder'] = 'kits';
        $base = base64_decode($this->input->get_post('exec'));
        $ex = explode(":", $base);
        $datos['info_kit'] = $this->kitsmodel->getInfoKits($ex[0]);
        $datos['verify_kit'] = $this->kitsmodel->get_verify_kit_user($ex[0], $this->session->userdata("id_user"));
        $this->load->view('frontend/plantilla-panel', $datos);
    }

    public function get_kits_all()
    {

        $this->val_login();

        $datos['page'] = 'kit-all';
        $datos['folder'] = 'kits';
        $datos['kit_alls'] = $this->kitsmodel->get_kits_all();
        $datos['verify_kit'] = $this->kitsmodel->get_my_lits_kits($this->session->userdata("id_user"));
        $this->load->view('frontend/plantilla-panel', $datos);
    }

    public function kit_pago()
    {

        $this->val_login();

        $datos['page'] = 'kit-pago';
        $datos['folder'] = 'kits';
        $base = base64_decode($this->input->get_post('qk'));
        $ex = explode(":", $base);
        $datos['parse'] = $ex;
        $datos['entidades'] = $this->parametrosmodel->get_entidades_bancarias();
        $datos['fp'] = $this->parametrosmodel->get_formas_pago();
        $datos['status_kits'] = $this->kitsmodel->get_status_buy_kits($ex[0], $this->session->userdata("id_user"));
        $this->load->view('frontend/plantilla-panel', $datos);
    }

    public function mis_kits()
    {

        $this->val_login();

        $datos['page'] = 'mis-kits';
        $datos['folder'] = 'kits';
        $datos['my_kits'] = $this->kitsmodel->get_my_lits_kits($this->session->userdata("id_user"));
        $this->load->view('frontend/plantilla-panel', $datos);
    }

    public function pago_exec()
    {

        $this->form_validation->set_rules('_product', '_product', 'trim|required|xss_clean');
        $this->form_validation->set_rules('_month', '_month', 'trim|required|xss_clean');
        $this->form_validation->set_rules('_pg', '_pg', 'trim|required|xss_clean');
        $this->form_validation->set_rules('_fecp', '_fecp', 'trim|xss_clean');
        $this->form_validation->set_rules('_fp', '_fp', 'trim|xss_clean');
        $this->form_validation->set_rules('_ent', '_ent', 'trim|xss_clean');
        $this->form_validation->set_rules('_trans', '_trans', 'trim|xss_clean');

        if ($this->form_validation->run() === TRUE) {

            $dir = Directorio_create::crear_directorio_kits($this->session->userdata("id_user"));
            $targetFile = $dir.$_FILES["files"]["name"];
            if(move_uploaded_file($_FILES["files"]["tmp_name"], $targetFile))
            {
                $this->kitsmodel->put_order_kits($this->input->post(),$targetFile);
                $this->kitsmodel->put_kits_user($this->input->post());
            }
            else{
                die("fail upload");
            }
        } else {

        }

    }

}


class Directorio_create extends kitcontroller
{
    protected function crear_directorio_kits($id_user)
    {
        $dir	= DIR_ATTACHMENT.$id_user."/";
        if (file_exists($dir))
        {
            return $dir;
        }
        else
        {
            mkdir($dir);
            chmod($dir, 0777);
            return $dir;
        }
    }
}