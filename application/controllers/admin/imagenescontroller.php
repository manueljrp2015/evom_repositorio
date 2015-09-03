<?php

class imagenescontroller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('admin/image/imagemodel');
    }

    /*
     * *****************sube la imagen***********************************************************
     * 
     */

    function uploadNewImagen() {

        if (!empty($_FILES))
        {
            $this->load->library('encrypt');
            $uploadDir = "./assets/img/profile/" . $this->encrypt->sha1($this->input->post('folder')) . '/';
            $diruri = "assets/img/profile/" . $this->encrypt->sha1($this->input->post('folder')) . '/';
            if (file_exists($uploadDir))
            {
                
            }
            else
            {
                mkdir($uploadDir);
                chmod($uploadDir, 0777);
            }

            list($ancho_tmp, $alto_tmp) = getimagesize($_FILES['Filedata']['tmp_name'][0]);

            if ($ancho_tmp < 240)
            {
                $datos['mensaje'] = '1';
                $this->load->view('frontend/error/page-message', $datos);
                return false;
            }
            if ($ancho_tmp > 2048)
            {
                $datos['mensaje'] = '3';
                $this->load->view('frontend/error/page-message', $datos);
                return false;
            }

            $tempFile = $_FILES['Filedata']['tmp_name'][0];
            $uploadDir = $uploadDir;
            $targetFile = $uploadDir . $_FILES['Filedata']['name'][0];
            if ($_FILES['Filedata']['size'][0] > '2097152')
            {
                $datos['mensaje'] = '0';
                $this->load->view('frontend/error/page-message', $datos);
                return false;
            }

            // Validate the file type
            $fileTypes = array('jpg', 'jpeg'); // Allowed file extensions
            $fileParts = pathinfo($_FILES['Filedata']['name'][0]);
            // Validate the filetype
            if (in_array($fileParts['extension'], $fileTypes))
            {
                // Save the file
                move_uploaded_file($tempFile, $targetFile);
                $opciones = array(
                    "alto" => '0',
                    "ancho" => '0',
                    "imagen" => $targetFile,
                    "calidad" => 150,
                    "crop" => FALSE
                );

                $this->redimencionar($opciones);
                $newname = $this->renameFile($uploadDir, $_FILES['Filedata']['name'][0]);
                $this->watermark($uploadDir . $newname);
                list($ancho, $alto) = getimagesize($uploadDir . $newname);
                $datos['mensaje'] = $uploadDir . $newname . ':' . $newname . ':' . $ancho . ':' . $alto . ':' . $uploadDir . ':' . $diruri;
                $this->load->view('frontend/error/page-message', $datos);
            }
            else
            {
                // The file type wasn't allowed
                $datos['mensaje'] = 'Invalid file type.';
                $this->load->view('frontend/error/page-message', $datos);
            }
        }
    }

    function uploadPollImagen() {

        if (!empty($_FILES))
            $uploadDir = "./assets/img/encuestas/" . $this->input->post('folder') . '/';
        $diruri = 'assets/img/encuestas/' . $this->input->post('folder') . '/';
        if (file_exists($uploadDir))
        {
            
        }
        else
        {
            mkdir($uploadDir);
            chmod($uploadDir, 0777);
        }

        list($ancho_tmp, $alto_tmp) = getimagesize($_FILES['Filedata']['tmp_name'][0]);

        if ($ancho_tmp < 240)
        {
            $datos['mensaje'] = '1';
            $this->load->view('admin/error/page-message', $datos);
            return false;
        }
        if ($ancho_tmp > 2048)
        {
            $datos['mensaje'] = '3';
            $this->load->view('admin/error/page-message', $datos);
            return false;
        }

        $tempFile = $_FILES['Filedata']['tmp_name'][0];
        $uploadDir = $uploadDir;
        $targetFile = $uploadDir . $_FILES['Filedata']['name'][0];
        if ($_FILES['Filedata']['size'][0] > '2097152')
        {
            $datos['mensaje'] = '0';
            $this->load->view('admin/error/page-message', $datos);
            return false;
        }

        // Validate the file type
        $fileTypes = array('jpg', 'jpeg', 'JPG', 'JPEG'); // Allowed file extensions
        $fileParts = pathinfo($_FILES['Filedata']['name'][0]);
        // Validate the filetype
        if (in_array($fileParts['extension'], $fileTypes))
        {
            // Save the file
            move_uploaded_file($tempFile, $targetFile);
            $opciones = array(
                "alto" => '0',
                "ancho" => '0',
                "imagen" => $targetFile,
                "calidad" => 150,
                "crop" => FALSE
            );
            /*
             * redimenciona
             */
            $this->redimencionar($opciones);
            /*
             * renombra
             */
            $newname = $this->renameFile($uploadDir, $_FILES['Filedata']['name'][0]);
            /*
             * marca de agua
             */
            $this->watermark($uploadDir . $newname);
            /*
             * directrio realitvo
             */
            $uri_pic = $diruri . $newname;
            /*
             * guarda la imagen
             */
            $this->imagemodel->putGalleryItem($this->input->post('items'), $uri_pic, $newname);
            /*
             * obtiene las diemciones
             */
            list($ancho, $alto) = getimagesize($uploadDir . $newname);
            /*
             * respuesta
             */
            $datos['mensaje'] = $uploadDir . $newname . ':' . $newname . ':' . $ancho . ':' . $alto . ':' . $uploadDir . ':' . $diruri . ':' . $uri_pic;
            $this->load->view('admin/error/page-message', $datos);
        }
        else
        {
            // The file type wasn't allowed
            $datos['mensaje'] = 'Invalid file type.';
            $this->load->view('admin/error/page-message', $datos);
        }
    }

    /*
     * ****************redimenciona la imagen cargada***************************************************************
     * 
     */

    public function redimencionar($options) {

        if (!file_exists($options['imagen']))
        {
            echo 'Archivo ' . $options['imagen'] . ' no existe.!';
            return false;
        }
        $img_original = imagecreatefromjpeg($options['imagen']);

        $max_ancho = 800;
        $max_alto = 600;

        list($ancho, $alto) = getimagesize($options['imagen']);
        $x_ratio = $max_ancho / $ancho;
        $y_ratio = $max_alto / $alto;
        if (($ancho <= $max_ancho) && ($alto <= $max_alto))
        {//Si ancho
            $ancho_final = $ancho;
            $alto_final = $alto;
        }
        elseif (($x_ratio * $alto) < $max_alto)
        {
            $alto_final = ceil($x_ratio * $alto);
            $ancho_final = $max_ancho;
        }
        else
        {
            $ancho_final = ceil($y_ratio * $ancho);
            $alto_final = $max_alto;
        }
        $tmp = imagecreatetruecolor($ancho_final, $alto_final);
        imagecopyresampled($tmp, $img_original, 0, 0, 0, 0, $ancho_final, $alto_final, $ancho, $alto);
        imagedestroy($img_original);

        //Definimos la calidad de la imagen final
        $calidad = 95;
        //Se crea la imagen final en el directorio indicado
        $name = $options['imagen'];
        imagejpeg($tmp, $name, $calidad);
    }

    /*
     * ****************redimenciona la imagen cargada***************************************************************
     * 
     */

    public function thumbsCreate($options) {

        if (!file_exists($options['folder'] . $options['imagen']))
        {
            echo 'Archivo ' . $options['imagen'] . ' no existe.!';
            return false;
        }
        $img_original = imagecreatefromjpeg($options['folder'] . $options['imagen']);

        $max_ancho = 75;
        $max_alto = 75;

        list($ancho, $alto) = getimagesize($options['folder'] . $options['imagen']);
        $x_ratio = $max_ancho / $ancho;
        $y_ratio = $max_alto / $alto;
        if (($ancho <= $max_ancho) && ($alto <= $max_alto))
        {//Si ancho
            $ancho_final = $ancho;
            $alto_final = $alto;
        }
        elseif (($x_ratio * $alto) < $max_alto)
        {
            $alto_final = ceil($x_ratio * $alto);
            $ancho_final = $max_ancho;
        }
        else
        {
            $ancho_final = ceil($y_ratio * $ancho);
            $alto_final = $max_alto;
        }
        $tmp = imagecreatetruecolor($ancho_final, $alto_final);
        imagecopyresampled($tmp, $img_original, 0, 0, 0, 0, $ancho_final, $alto_final, $ancho, $alto);
        imagedestroy($img_original);

        //Definimos la calidad de la imagen final
        $calidad = 150;
        //Se crea la imagen final en el directorio indicado

        $temp = explode(".", $options['imagen']);
        $nombre = $temp[0];
        $ext = $temp[1];
        $nom_tumbs = $nombre . '_thumb.' . $ext;

        imagejpeg($tmp, $options['folder'] . $nom_tumbs, $calidad);
        return $nom_tumbs;
    }

    public function redimencionarDinamico() {

        $this->form_validation->set_rules('alto', 'alto', 'trim|required|xss_clean');
        $this->form_validation->set_rules('ancho', 'ancho', 'trim|required|xss_clean');
        $this->form_validation->set_rules('img_profile', 'img_profile', 'trim|required|xss_clean');
        $this->form_validation->set_rules('ruta_profile', 'ruta_profile', 'trim|required|xss_clean');
        if ($this->form_validation->run() == TRUE)
        {
            $uploadDir = $this->input->post('ruta_profile');

            $newname = $this->input->post('img_profile');

            if (!file_exists($uploadDir . $newname))
            {
                echo 'Archivo ' . $newname . ' no existe.!';
                return false;
            }
            $img_original = imagecreatefromjpeg($uploadDir . $newname);

            $max_ancho = $this->input->post('ancho');
            $max_alto = $this->input->post('alto');

            list($ancho, $alto) = getimagesize($uploadDir . $newname);
            $x_ratio = $max_ancho / $ancho;
            $y_ratio = $max_alto / $alto;
            if (($ancho <= $max_ancho) && ($alto <= $max_alto))
            {//Si ancho
                $ancho_final = $ancho;
                $alto_final = $alto;
            }
            elseif (($x_ratio * $alto) < $max_alto)
            {
                $alto_final = ceil($x_ratio * $alto);
                $ancho_final = $max_ancho;
            }
            else
            {
                $ancho_final = ceil($y_ratio * $ancho);
                $alto_final = $max_alto;
            }
            $tmp = imagecreatetruecolor($ancho_final, $alto_final);
            imagecopyresampled($tmp, $img_original, 0, 0, 0, 0, $ancho_final, $alto_final, $ancho, $alto);
            imagedestroy($img_original);

            //Definimos la calidad de la imagen final
            $calidad = 150;
            //Se crea la imagen final en el directorio indicado

            imagejpeg($tmp, $uploadDir . $newname, $calidad);
        }
    }

    public function maximizarDinamico() {

        $this->form_validation->set_rules('alto', 'alto', 'trim|required|xss_clean');
        $this->form_validation->set_rules('ancho', 'ancho', 'trim|required|xss_clean');
        $this->form_validation->set_rules('img_profile', 'img_profile', 'trim|required|xss_clean');
        $this->form_validation->set_rules('ruta_profile', 'ruta_profile', 'trim|required|xss_clean');
        if ($this->form_validation->run() == TRUE)
        {
            $uploadDir = $this->input->post('ruta_profile');

            $newname = $this->input->post('img_profile');

            if (!file_exists($uploadDir . $newname))
            {
                echo 'Archivo ' . $newname . ' no existe.!';
                return false;
            }
            $img_original = imagecreatefromjpeg($uploadDir . $newname);

            $max_ancho = $this->input->post('ancho');
            $max_alto = $this->input->post('alto');

            list($ancho, $alto) = getimagesize($uploadDir . $newname);
            $x_ratio = $max_ancho / $ancho;
            $y_ratio = $max_alto / $alto;
            if (($ancho >= $max_ancho) && ($alto >= $max_alto))
            {//Si ancho
                $ancho_final = $ancho;
                $alto_final = $alto;
            }
            elseif (($x_ratio * $alto) < $max_alto)
            {
                $alto_final = ceil($x_ratio * $alto);
                $ancho_final = $max_ancho;
            }
            else
            {
                $ancho_final = ceil($y_ratio * $ancho);
                $alto_final = $max_alto;
            }
            $tmp = imagecreatetruecolor($ancho_final, $alto_final);
            imagecopyresampled($tmp, $img_original, 0, 0, 0, 0, $ancho_final, $alto_final, $ancho, $alto);
            imagedestroy($img_original);

            //Definimos la calidad de la imagen final
            $calidad = 150;
            //Se crea la imagen final en el directorio indicado

            imagejpeg($tmp, $uploadDir . $newname, $calidad);
        }
    }

    /*
     * **************************marca de agua****************************************************
     * 
     */

    function watermark($target) {

        $config2['source_image'] = $target;
        $config2['wm_overlay_path'] = './assets/img/page/Logo-watermark.png';
        $config2['wm_type'] = 'overlay';
        $config2['wm_opacity'] = '50';
        $config2['wm_vrt_alignment'] = 'bottom';
        $config2['wm_hor_alignment'] = 'right';
        $this->load->library('image_lib', $config2);
        $this->image_lib->watermark();
    }

    /*
     * *****************crop de imagen***************************************************
     * 
     */

    public function cropWebcam() {
        $this->form_validation->set_rules('alto', 'alto', 'trim|required|xss_clean');
        $this->form_validation->set_rules('ancho', 'ancho', 'trim|required|xss_clean');
        $this->form_validation->set_rules('folder', 'folder', 'trim|required|xss_clean');
        $this->form_validation->set_rules('h', 'h', 'trim|xss_clean');
        $this->form_validation->set_rules('img_profile', 'img_profile', 'trim|required|xss_clean');
        $this->form_validation->set_rules('ruta_profile', 'ruta_profile', 'trim|required|xss_clean');
        $this->form_validation->set_rules('w', 'w', 'trim|xss_clean');
        $this->form_validation->set_rules('x', 'x', 'trim|xss_clean');
        $this->form_validation->set_rules('y', 'y', 'trim|xss_clean');
        if ($this->form_validation->run() == TRUE)
        {
            $uploadDir = $this->input->post('ruta_profile');
            $newname = $this->input->post('img_profile');
            $x = $this->input->post('x');
            $y = $this->input->post('y');
            $h = $this->input->post('h');
            $w = $this->input->post('w');

            $targ_w = $targ_h = 250;
            $jpeg_quality = 150;

            $img_r = imagecreatefromjpeg($uploadDir . $newname);
            $dst_r = ImageCreateTrueColor($w, $h);

            imagecopyresampled($dst_r, $img_r, 0, 0, $x, $y, $w, $h, $w, $h);
            $name_crop = "crop_" . $newname;
            imagejpeg($dst_r, $uploadDir . $name_crop, $jpeg_quality);

            $opciones = array(
                "alto" => '0',
                "ancho" => '0',
                "imagen" => $name_crop,
                "folder" => $uploadDir,
                "calidad" => 150,
                "crop" => FALSE
            );

            $nom_tumbs = $this->thumbsCreate($opciones);
            //$this->watermark($uploadDir . $newname);
            $this->imagen->update_profile($name_crop, $this->input->post('folder'), $nom_tumbs);

            $datos['mensaje'] = '1';
            $this->load->view('frontend/error/page-message', $datos);
        }
    }

    /*
     * ************renombra el archivo****************************************************************
     * 
     */

    public function renameFile($dir, $img) {
        $new_name = str_replace(array(' ', '/', '-', '#', '$', '&', '*'), '_', $img);
        $name = date("YMDhms") . '_' . $new_name;
        rename($dir . $img, $dir . $name);
        return $name;
    }

    /*
     * *******************funcion generica de rotar***********************************************************
     * 
     */

    public function rotateGeneric($uploadDir, $newname, $grados) {
        $origen = imagecreatefromjpeg($uploadDir . $newname);
        $rotar = imagerotate($origen, $grados, 0);
        imagejpeg($rotar, $uploadDir . $newname);
    }

    /*
     * *************rota la imagen*****************************************************************
     * 
     */

    public function rotate() {
        $this->form_validation->set_rules('alto', 'alto', 'trim|required|xss_clean');
        $this->form_validation->set_rules('ancho', 'ancho', 'trim|required|xss_clean');
        $this->form_validation->set_rules('folder', 'folder', 'trim|required|xss_clean');
        $this->form_validation->set_rules('h', 'x', 'trim|xss_clean');
        $this->form_validation->set_rules('img_profile', 'img_profile', 'trim|required|xss_clean');
        $this->form_validation->set_rules('ruta_profile', 'ruta_profile', 'trim|required|xss_clean');
        $this->form_validation->set_rules('w', 'w', 'trim|xss_clean');
        $this->form_validation->set_rules('x', 'x', 'trim|xss_clean');
        $this->form_validation->set_rules('y', 'y', 'trim|xss_clean');
        if ($this->form_validation->run() == TRUE)
        {
            $uploadDir = $this->input->post('ruta_profile');

            $newname = $this->input->post('img_profile');

            $origen = imagecreatefromjpeg($uploadDir . $newname);

            $rotar = imagerotate($origen, 90, 0);

            imagejpeg($rotar, $uploadDir . '_' . $newname, 95);
            unlink($uploadDir . $newname);
            list($ancho, $alto) = getimagesize($uploadDir . '_' . $newname);

            $datos['mensaje'] = $uploadDir . '_' . $newname . ':' . '_' . $newname . ':' . $ancho . ':' . $alto . ':' . $uploadDir;
            $this->load->view('frontend/error/page-message', $datos);
        }
    }

}
