<?php

class pdfcontroller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('admin/parametros/parametrosmodel');
        $this->load->model('admin/consultar/consultarmodel');
        $this->load->model('admin/reportes/reportesmodel');
    }

    public function printstate() {
        $this->load->library('Pdf');
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('TSU Manuel Rodriguez');
        $pdf->SetTitle('VBR');
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_STRING);
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
        $pdf->SetFont('Helvetica', 'B', 8);

        $pdf->AddPage();
        $pdf->Ln(5);
        $table = '<table border ="0" width="100%"><tr><td   align="center">Reporte de militantes por Estado</td></tr></table>';
        $pdf->writeHTML($table, FALSE, 0, true, 0);
        $pdf->Ln(5);
        $html3 = '<table border ="0" width="100%" style="font-size: 25px"><tr><td align="left">Numero total de militantes inscritos a traves del portal web.</td></tr></table>';
        $pdf->writeHTML($html3, false, 0, true, 0);
        $pdf->Ln(5);
        $datos['analisis_estado'] = $this->parametrosmodel->analisisPorEstado($this->session->userdata['codigo_estado']);
        $table2 = '<table border ="0" width="100%" style="font-size: 40px"><tr><td  align="left">#Estado</td><td align="center">#Nro. Militantes</td></tr></table>';
        $pdf->writeHTML($table2, false, 0, true, 0);
        $t = 0;
        $c = 0;
        foreach ($datos['analisis_estado'] as $anes):

            $c = $c + 1;
            if ($c % 2 == 0)
            {
                $bgc = '#F78181';
            }
            else
            {
                $bgc = '#F5A9A9';
            }

            $html = '<table border ="0" width="100%" style="font-size: 40px"><tr bgcolor="' . $bgc . '"><td>' . $anes->estado . '</td><td align="right">' . $anes->total_militantes . '</td></tr></table>';
            $pdf->writeHTML($html, false, 0, true, 0);
            $t = $t + $anes->total_militantes;
        endforeach;
        $html3 = '<table border ="0" width="100%" style="font-size: 40px"><tr><td align="right">Total:</td><td align="right">' . $t . '</td></tr></table>';
        $html4 = '<table border ="0" width="100%" style="font-size: 16px"><tr><td align="left">Sistema de registros VBR Vanguardia Bicentenaria Republicana.</td></tr></table>';
        $pdf->writeHTML($html3, false, 0, true, 0);
        $pdf->Ln(5);
        $pdf->writeHTML($html4, false, 0, true, 0);
        $pdf->Output('Bitacora.pdf', 'I');
    }

    public function printmunicipios() {
        $this->load->library('Pdf');
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('TSU Manuel Rodriguez');
        $pdf->SetTitle('VBR');
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_STRING);
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
        $pdf->SetFont('Helvetica', 'B', 8);

        $pdf->AddPage();
        $pdf->Ln(5);
        $estado_name = $this->parametrosmodel->getEstadoUser($this->input->get('estado'));
        $table = '<table border ="0" width="100%"><tr><td   align="center">Reporte de Militantes por Municipios del Estado ' . $estado_name . '</td></tr></table>';
        $pdf->writeHTML($table, FALSE, 0, true, 0);
        $pdf->Ln(5);
        $html3 = '<table border ="0" width="100%" style="font-size: 25px"><tr><td align="left">Numero total de militantes inscritos a traves del portal web.</td></tr></table>';
        $pdf->writeHTML($html3, false, 0, true, 0);
        $pdf->Ln(5);
        $datos['analisis_municipio'] = $this->parametrosmodel->analisisPorMunicipio($this->input->get('estado'));
        $table2 = '<table border ="0" width="100%" style="font-size: 40px"><tr><td  align="left">#Estado</td><td align="center">#Nro. Militantes</td></tr></table>';
        $pdf->writeHTML($table2, false, 0, true, 0);
        $t = 0;
        $c = 0;
        foreach ($datos['analisis_municipio'] as $anes):

            $c = $c + 1;
            if ($c % 2 == 0)
            {
                $bgc = '#F78181';
            }
            else
            {
                $bgc = '#F5A9A9';
            }

            $html = '<table border ="0" width="100%" style="font-size: 40px"><tr bgcolor="' . $bgc . '"><td>' . $anes->municipio . '</td><td align="right">' . $anes->total_estado . '</td></tr></table>';
            $pdf->writeHTML($html, false, 0, true, 0);
            $t = $t + $anes->total_estado;
        endforeach;
        $html3 = '<table border ="0" width="100%" style="font-size: 40px"><tr><td align="right">Total:</td><td align="right">' . $t . '</td></tr></table>';
        $html4 = '<table border ="0" width="100%" style="font-size: 16px"><tr><td align="left">Sistema de registros VBR Vanguardia Bicentenaria Republicana.</td></tr></table>';
        $pdf->writeHTML($html3, false, 0, true, 0);
        $pdf->Ln(5);
        $pdf->writeHTML($html4, false, 0, true, 0);
        $pdf->Output('Bitacora.pdf', 'I');
    }

    public function comprobante() {
        $this->load->library('Pdf');
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('TSU Manuel Rodriguez');
        $pdf->SetTitle('VBR');
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
        $pdf->SetFont('Helvetica', 'B', 8);

        $pdf->AddPage();
        for($i=1;$i <=2;$i++){
            $datos['consulta'] = $this->consultarmodel->consultarCedulaPDF($this->input->get('id'));
        $table = '<table border ="0" style="width: 100%; font-size: 60px"><tr><td align="center">Comprobante de Registro</td></tr></table>';
        $pdf->writeHTML($table, FALSE, 0, true, 0);
        $pdf->Ln(5);
        
        $t = 0;
        $c = 0;
        $style = array(
            'text' => 'true',
            'stretchtext' => 8,
            'fontsize' => 4
        );
        
        foreach ($datos['consulta'] as $anes):
            $pdf->write1DBarcode($anes->serial, 'C128A', '', '', 80, 4, 0.4, $style);
            $pdf->Ln(3);
            $html = '<table border ="0" width="100%" style="font-size: 35px;"><tr><td><h2>' . $anes->nombre_primario . ' ' . $anes->nombre_secundario . ' ' . $anes->apellido_primario . ' ' . $anes->apellido_secundario . '</h2></td><td><h2>' . $anes->nacionalidad . '-' . $anes->cedula . '</h2></td></tr></table>';
            $pdf->writeHTML($html, false, 0, true, 0);
            $pdf->Ln(2);
            $html = '<table border ="0" width="100%"><tr style="font-size: 35px;"><td><h2>Telf.: ' . $anes->telefono_residencia . ' / ' . $anes->telefono_celular . '</h2></td></tr></table>';
            $pdf->writeHTML($html, false, 0, true, 0);
            $pdf->Ln(2);
            $html = '<table border ="0" width="100%"><tr style="font-size: 35px;"><td><h2>' . $anes->estado . ' / ' . $anes->municipio . ' / ' . $anes->parroquia . '</h2></td></tr></table>';
            $pdf->writeHTML($html, false, 0, true, 0);
            $pdf->Ln(2);
            $html = '<table border ="0" width="100%"><tr style="font-size: 35px;"><td><h2>' . $anes->direccion_1 . ' ' . $anes->direccion_2 . '</h2> </td></tr></table>';
            $pdf->writeHTML($html, false, 0, true, 0);
            $pdf->Ln(2);
            $html = '<table border ="0" width="100%"><tr style="font-size: 35px;"><td><h2>' . $anes->email . '</h2> </td></tr></table>';
            $pdf->writeHTML($html, false, 0, true, 0);
            $pdf->Ln(2);
            $pdf->writeHTML('<hr>', false, 0, true, 0);
            $pdf->Ln(10);
            $html = '<table border ="0" width="100%"><tr style="font-size: 35px;"><td>______________________________</td><td>______________________________</td></tr></table>';
            $pdf->writeHTML($html, false, 0, true, 0);
            $html = '<table border ="0" width="100%" style="font-size: 35px;"><tr><td>' . $anes->nombre_primario . ' ' . $anes->nombre_secundario . ' ' . $anes->apellido_primario . ' ' . $anes->apellido_secundario . '</td><td>Recibido Por:</td></tr></table>';
            $pdf->writeHTML($html, false, 0, true, 0);
            if($i == 1){
                $copia = "Copia Beneficiario";
            }
            elseif($i == 2){
                $copia = "Copia Funcionario";
            }
            $html = '<table border ="0" width="100%" style="font-size: 35px;"><tr><td>' . $anes->nacionalidad . '-' . $anes->cedula . '</td><td>'.$copia.'</td></tr></table>';
            $pdf->writeHTML($html, false, 0, true, 0);
            $pdf->Ln(10);
        endforeach;
        }
        $pdf->Output('comprobante.pdf', 'I');
    }

    public function estadosPDF() {
        $this->load->library('Pdf');
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('TSU Manuel Rodriguez');
        $pdf->SetTitle('VBR');
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_STRING, 'Reportes Por Estado');
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
        $pdf->SetFont('Helvetica', 'B', 8);


        $pdf->AddPage('L');
        $pdf->Ln(5);
        $estado_name = $this->parametrosmodel->getEstadoUser($this->input->get('estado'));
        $table = '<table border ="0" width="100%"><tr><td   align="center">MILITANTES DEL ' . $estado_name . '</td></tr></table>';
        $pdf->writeHTML($table, FALSE, 0, true, 0);
        $pdf->Ln(5);
        $html3 = '<table border ="0" width="100%" style="font-size: 25px"><tr><td align="left">Numero total de militantes inscritos a traves del portal web.</td></tr></table>';
        $pdf->writeHTML($html3, false, 0, true, 0);
        $pdf->Ln(5);
        $datos['analisis'] = $this->reportesmodel->analisisPorEstado($this->input->get('estado'));
        $table2 = '<table border ="0" width="100%" style="font-size: 25px"><tr><td align="center">#Cedula</td><td align="right">Nombres y apellidos</td><td align="right">Telf:</td><td align="right">Celular</td><td align="right">Estado</td><td align="right">Municipio</td><td align="right">Parroquia</td></tr></table>';
        $pdf->writeHTML($table2, false, 0, true, 0);
        $t = 0;
        $c = 0;
        if($datos['analisis'] == 'vacio'){
            
        }
        else{
        foreach ($datos['analisis'] as $anes):

            $c = $c + 1;
            if ($c % 2 == 0)
            {
                $bgc = '#F78181';
            }
            else
            {
                $bgc = '#F5A9A9';
            }

            $html = '<table border ="0" width="100%" style="font-size: 28px"><tr bgcolor="' . $bgc . '"><td align="center">' . $anes->nacionalidad . '-' . sprintf("%08d",$anes->cedula) . '</td><td align="right">' . $anes->nombre_primario . ' ' . $anes->nombre_secundario . ' ' . $anes->apellido_primario . ' ' . $anes->apellido_secundario . '</td><td align="right">' . $anes->telefono_residencia . '</td><td align="right">' . $anes->telefono_celular . '</td><td align="right">' . $anes->estado . '</td><td align="right">' . $anes->municipio . '</td><td align="right">' . $anes->parroquia . '</td></tr></table>';
            $pdf->writeHTML($html, false, 0, true, 0);
            $t = $t + 1;
        endforeach;
        }
        $html3 = '<table border ="0" width="100%" style="font-size: 40px"><tr><td align="right">Total:</td><td align="right">' . $t . '</td></tr></table>';
        $html4 = '<table border ="0" width="100%" style="font-size: 25px"><tr><td align="left">Sistema de registros VBR Vanguardia Bicentenaria Republicana.</td></tr></table>';
        $pdf->writeHTML($html3, false, 0, true, 0);
        $pdf->Ln(5);
        $pdf->writeHTML($html4, false, 0, true, 0);
        $pdf->Output($estado_name.'.pdf', 'I');
    }
    
    public function municipioPDF() {
        $this->load->library('Pdf');
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('TSU Manuel Rodriguez');
        $pdf->SetTitle('VBR');
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_STRING, 'Reportes Por Estado');
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
        $pdf->SetFont('Helvetica', 'B', 8);


        $pdf->AddPage('L');
        $pdf->Ln(5);
        $estado_name = $this->parametrosmodel->getMunicipioUser($this->input->get('municipio'));
        $explode = explode(':', $estado_name);
        $table = '<table border ="0" width="100%"><tr><td   align="center">MILITANTES DEL ' . $explode[1] . ' / '.$explode[0].'</td></tr></table>';
        $pdf->writeHTML($table, FALSE, 0, true, 0);
        $pdf->Ln(5);
        $html3 = '<table border ="0" width="100%" style="font-size: 25px"><tr><td align="left">Numero total de militantes inscritos a traves del portal web.</td></tr></table>';
        $pdf->writeHTML($html3, false, 0, true, 0);
        $pdf->Ln(5);
        $datos['analisis'] = $this->reportesmodel->analisisPorMunicipio($this->input->get('municipio'));
        $table2 = '<table border ="0" width="100%" style="font-size: 25px"><tr><td align="center">#Cedula</td><td align="right">Nombres y apellidos</td><td align="right">Telf:</td><td align="right">Celular</td><td align="right">Estado</td><td align="right">Municipio</td><td align="right">Parroquia</td></tr></table>';
        $pdf->writeHTML($table2, false, 0, true, 0);
        $t = 0;
        $c = 0;
        if($datos['analisis'] == 'vacio'){
            
        }
        else{
        foreach ($datos['analisis'] as $anes):

            $c = $c + 1;
            if ($c % 2 == 0)
            {
                $bgc = '#F78181';
            }
            else
            {
                $bgc = '#F5A9A9';
            }

            $html = '<table border ="0" width="100%" style="font-size: 28px"><tr bgcolor="' . $bgc . '"><td align="center">' . $anes->nacionalidad . '-' . $anes->cedula . '</td><td align="right">' . $anes->nombre_primario . ' ' . $anes->nombre_secundario . ' ' . $anes->apellido_primario . ' ' . $anes->apellido_secundario . '</td><td align="right">' . $anes->telefono_residencia . '</td><td align="right">' . $anes->telefono_celular . '</td><td align="right">' . $anes->estado . '</td><td align="right">' . $anes->municipio . '</td><td align="right">' . $anes->parroquia . '</td></tr></table>';
            $pdf->writeHTML($html, false, 0, true, 0);
            $t = $t + 1;
        endforeach;
        }
        $html3 = '<table border ="0" width="100%" style="font-size: 40px"><tr><td align="right">Total:</td><td align="right">' . $t . '</td></tr></table>';
        $html4 = '<table border ="0" width="100%" style="font-size: 25px"><tr><td align="left">Sistema de registros VBR Vanguardia Bicentenaria Republicana.</td></tr></table>';
        $pdf->writeHTML($html3, false, 0, true, 0);
        $pdf->Ln(5);
        $pdf->writeHTML($html4, false, 0, true, 0);
        $pdf->Output($explode[1] . ' / '.$explode[0].'.pdf', 'I');
    }
    
    public function parroquiaPDF() {
        $this->load->library('Pdf');
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('TSU Manuel Rodriguez');
        $pdf->SetTitle('VBR');
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_STRING, 'Reportes Por Estado');
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
        $pdf->SetFont('Helvetica', 'B', 8);


        $pdf->AddPage('L');
        $pdf->Ln(5);
        $estado_name = $this->parametrosmodel->getParroquiaUser($this->input->get('parroquia'));
        $explode = explode(':', $estado_name);
        $table = '<table border ="0" width="100%"><tr><td   align="center">MILITANTES DE ' . $explode[2] . ' / '.$explode[1].' / '.$explode[0].'</td></tr></table>';
        $pdf->writeHTML($table, FALSE, 0, true, 0);
        $pdf->Ln(5);
        $html3 = '<table border ="0" width="100%" style="font-size: 25px"><tr><td align="left">Numero total de militantes inscritos a traves del portal web.</td></tr></table>';
        $pdf->writeHTML($html3, false, 0, true, 0);
        $pdf->Ln(5);
        $datos['analisis'] = $this->reportesmodel->analisisPorParroquia($this->input->get('parroquia'));
        $table2 = '<table border ="0" width="100%" style="font-size: 25px"><tr><td align="center">#Cedula</td><td align="right">Nombres y apellidos</td><td align="right">Telf:</td><td align="right">Celular</td><td align="right">Estado</td><td align="right">Municipio</td><td align="right">Parroquia</td></tr></table>';
        $pdf->writeHTML($table2, false, 0, true, 0);
        $t = 0;
        $c = 0;
        if($datos['analisis'] == 'vacio'){
            
        }
        else{
        foreach ($datos['analisis'] as $anes):

            $c = $c + 1;
            if ($c % 2 == 0)
            {
                $bgc = '#F78181';
            }
            else
            {
                $bgc = '#F5A9A9';
            }

            $html = '<table border ="0" width="100%" style="font-size: 28px"><tr bgcolor="' . $bgc . '"><td align="center">' . $anes->nacionalidad . '-' . $anes->cedula . '</td><td align="right">' . $anes->nombre_primario . ' ' . $anes->nombre_secundario . ' ' . $anes->apellido_primario . ' ' . $anes->apellido_secundario . '</td><td align="right">' . $anes->telefono_residencia . '</td><td align="right">' . $anes->telefono_celular . '</td><td align="right">' . $anes->estado . '</td><td align="right">' . $anes->municipio . '</td><td align="right">' . $anes->parroquia . '</td></tr></table>';
            $pdf->writeHTML($html, false, 0, true, 0);
            $t = $t + 1;
        endforeach;
        }
        $html3 = '<table border ="0" width="100%" style="font-size: 40px"><tr><td align="right">Total:</td><td align="right">' . $t . '</td></tr></table>';
        $html4 = '<table border ="0" width="100%" style="font-size: 25px"><tr><td align="left">Sistema de registros VBR Vanguardia Bicentenaria Republicana.</td></tr></table>';
        $pdf->writeHTML($html3, false, 0, true, 0);
        $pdf->Ln(5);
        $pdf->writeHTML($html4, false, 0, true, 0);
        $pdf->Output($explode[2] . ' / '.$explode[1].' / '.$explode[0].'.pdf', 'I');
    }

}
