<?php
//============================================================+
// File name   : example_001.php
// Begin       : 2008-03-04
// Last Update : 2010-05-20
//
// Description : Example 001 for TCPDF class
//               Default Header and Footer
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com s.r.l.
//               Via Della Pace, 11
//               09044 Quartucciu (CA)
//               ITALY
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: Default Header and Footer
 * @author Nicola Asuni
 * @copyright 2004-2009 Nicola Asuni - Tecnick.com S.r.l (www.tecnick.com) Via Della Pace, 11 - 09044 - Quartucciu (CA) - ITALY - www.tecnick.com - info@tecnick.com
 * @link http://tcpdf.org
 * @license http://www.gnu.org/copyleft/lesser.html LGPL
 * @since 2008-03-04
 */
				
require_once('./config/lang/eng.php');
require_once('tcpdf.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('TSU Manuel Rodriguez');
$pdf->SetTitle('GESTION DE MATERIALES');
$pdf->SetSubject('TCPDF');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE , PDF_HEADER_STRING);


// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

//set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

//set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

//set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

//set some language-dependent strings
$pdf->setLanguageArray($l);

// ---------------------------------------------------------

// Set font 
// dejavusans is a UTF-8 Unicode font, if you only need to
// print standard ASCII chars, you can use core fonts like
// helvetica or times to reduce file size.
$pdf->SetFont('courier', 'N', 9.5);
//include('../FLD_CONEXION/INDEX.PHP');		
					
// Add a page
// This method has several options, check the source code documentation for more information.
$pdf->AddPage();
$style = array(
	'position' => 'S',
	'border' => true,
	'padding' => 'auto',
	'fgcolor' => array(0,0,128),
	'bgcolor' => array(255,255,128),
	'text' => true,
	'font' => 'helvetica',
	'fontsize' => 8,
	'stretchtext' => 4
);

// Set some content to print
	

$pdf->Ln(10);
/*----------------------------------------------------------------------------------*/
/*AQUI PUEDEN METER LAS CONSULTAS PHP*/
/*-----------------------------------------------------------------------------------------------*/


$pdf->Cell(0, 0,'FS0065455261', 0, 1);
$pdf->write1DBarcode('FS0065455261', 'C128A', '', '', 80, 8, 0.4);
$pdf->Ln(8);
$table = '<table border ="0" width="100%"><tr><td   align="LEFT"><B>SOLICITUD DEL BENEFICIARIO</B></td><TD align="RIGHT" WIDTH="5%"><B>NRO:</B></TD><TD WIDTH="15%">FS0065455261</TD></tr></table>';
$pdf->writeHTML($table, true, 0, true, 0);
$pdf->Ln(0);
$table = '<TABLE BORDER="0" WIDTH="100%" ><TR><TD><b>INFORMACION DEL SOLICITANTE:</B> <FONT SIZE="6PX">(Requerida para los archivos y registros de la Fundacion S.O.M.O.S Venezuela)</FONT></TD></TR></TABLE>';
			
$TB2 = '<TABLE BORDER="0" WIDTH="100%" BGCOLOR="BLACK"><TR><TD><B><FONT COLOR="WHITE">Primer Apellido:</FONT></B></TD><TD><B><FONT COLOR="WHITE">Segundo Apellido:</FONT></B></TD><TD><B><FONT COLOR="WHITE">Primer Nombre:</FONT></B></TD><TD><B><FONT COLOR="WHITE">Segundo Nombre:</FONT></B></TD></TR></TABLE>';
$TB3 = '<TABLE BORDER="0" WIDTH="100%"><TR><TD>RODRIGUEZ</TD><TD>PATINO</TD><TD>MANUEL</TD><TD>JOSE</TD></TR></TABLE>';
$TB4 = '<TABLE BORDER="1" WIDTH="100%" BGCOLOR="BLACK"><TR><TD><b><FONT COLOR="WHITE">Direccion Actual:</FONT></B></TD></TR></TABLE>';
$TB5 = '<TABLE BORDER="1" WIDTH="100%"><TR><TD>Urb. Curagua</TD></TR></TABLE>';
$TB6 = '<TABLE BORDER="0" WIDTH="100%" BGCOLOR="BLACK"><TR><TD><B><FONT COLOR="WHITE">Municipio:</FONT></B></TD><TD><B><FONT COLOR="WHITE">Ciudad:</FONT></B></TD><TD><B><FONT COLOR="WHITE">Estado:</FONT></B></TD><TD><B><FONT COLOR="WHITE">Codigo Postal:</FONT></B></TD></TR></TABLE>';
$HR  = '<HR>';
$TB10 = '<TABLE BORDER="0" WIDTH="100%"><TR><TD>CARONI</TD><TD>PUERTO ORDAZ</TD><TD>BOLIVAR</TD><TD>0000</TD></TR></TABLE>';
$TB11 = '<TABLE BORDER="0" WIDTH="100%" BGCOLOR="BLACK"><TR><TD><B><FONT COLOR="WHITE">Telf.: (Habitacion)</FONT></B></TD><TD><B><FONT COLOR="WHITE">Telf.: (Celular)</FONT></B></TD><TD><B><FONT COLOR="WHITE">Telf.: (Oficina)</FONT></B></TD><TD><B><FONT COLOR="WHITE">Direccion E-mail:</FONT></B></TD></TR></TABLE>';
$TB12 = '<TABLE BORDER="0" WIDTH="100%"><TR><TD>0286-0000000</TD><TD>0424-9491557</TD><TD>0000-0000000</TD><TD>MANUELJRP@GMAIL.COM</TD></TR></TABLE>';
$TB13 = '<TABLE BORDER="0" WIDTH="100%" BGCOLOR="BLACK"><TR><TD><B><FONT COLOR="WHITE">CI:</FONT></B></TD><TD><B><FONT COLOR="WHITE">Fecha De Nacimiento:</FONT></B></TD><TD><B><FONT COLOR="WHITE">CI:</FONT></B></TD><TD><B><FONT COLOR="WHITE">Fecha De Nacimiento:</FONT></B></TD></TR></TABLE>';
$TB14 = '<TABLE BORDER="0" WIDTH="100%"><TR><TD>16255456</TD><TD>12/11/1983</TD><TD>X</TD><TD>X</TD></TR></TABLE>';
$TB15 = '<TABLE BORDER="0" WIDTH="100%" BGCOLOR="BLACK"><TR><TD><B><FONT COLOR="WHITE">RIF:</FONT></B></TD><TD><B><FONT COLOR="WHITE">Nacionalidad:</FONT></B></TD><TD><B><FONT COLOR="WHITE">RIF:</FONT></B></TD><TD><B><FONT COLOR="WHITE">Nacionalidad:</FONT></B></TD></TR></TABLE>';
$TB16 = '<TABLE BORDER="0" WIDTH="100%"><TR><TD>V-16255456-1</TD><TD>VENEZOLANO</TD><TD>X</TD><TD>X</TD></TR></TABLE>';
$TB17 = '<TABLE BORDER="0" WIDTH="100%" BGCOLOR="BLACK"><TR><TD><B><FONT COLOR="WHITE">NRO. DE CUENTA:</FONT></B></TD></TR></TABLE>';
$TB18 = '<TABLE BORDER="0" WIDTH="100%"><TR><TD>0000-0000-00-0000000000</TD></TR></TABLE>';
$TB19 = '<TABLE BORDER="0" WIDTH="100%" BGCOLOR="BLACK"><TR><TD><B><FONT COLOR="WHITE">Serial:</FONT></B></TD><TD><B><FONT COLOR="WHITE">Nombre y Apellido</FONT></B></TD><TD><B><FONT COLOR="WHITE">Telf.:</FONT></B></TD><TD><B><FONT COLOR="WHITE"></FONT></B></TD></TR></TABLE>';
$TB20 = '<TABLE BORDER="0" WIDTH="100%"><TR><TD>FS0065455261</TD><TD>MANUEL RODRIGUEZ</TD><TD>0424-9491557</TD><TD></TD></TR></TABLE>';
$TB21 = '<TABLE BORDER="0" WIDTH="100%" BGCOLOR="BLACK"><TR><TD><B><FONT COLOR="WHITE">Serial:</FONT></B></TD><TD><B><FONT COLOR="WHITE">Nombre y Apellido</FONT></B></TD><TD><B><FONT COLOR="WHITE">Pais de Origen:</FONT></B></TD><TD><B><FONT COLOR="WHITE">Telf.:</FONT></B></TD></TR></TABLE>';
$TB22 = '<TABLE BORDER="0" WIDTH="100%"><TR><TD>X</TD><TD>X</TD><TD>X</TD><TD>X</TD></TR></TABLE>';
$TB23 = '<TABLE BORDER="0" WIDTH="100%"><TR><TD ALIGN="CENTER"><B>Firma del solicitante</B></TD><TD ALIGN="CENTER"><B>Firma del CO-solicitante</B></TD><TD ALIGN="CENTER"><B>Representante de la fundacion</B></TD></TR></TABLE>';
$TB24 = '<TABLE BORDER="0" WIDTH="100%"><TR><TD ALIGN="CENTER">____________________</TD><TD ALIGN="CENTER">____________________</TD><TD ALIGN="CENTER">____________________</TD></TR></TABLE>';
$TB25 = '<TABLE BORDER="0" WIDTH="100%"><TR><TD ALIGN="CENTER">Valencia, Edo. Carabobo</TD></TR></TABLE>';
						
$pdf->writeHTML($table, false, 0, true, 0);
$pdf->writeHTML($TB2, false, 0, true, 0);
$pdf->writeHTML($TB3, false, 0, true, 0);
$pdf->writeHTML($TB4, false, 0, true, 0);
$pdf->writeHTML($TB5, false, 0, true, 0);
$pdf->writeHTML($HR, false, 0, true, 0);
$pdf->writeHTML($TB6, false, 0, true, 0);
$pdf->writeHTML($HR, false, 0, true, 0);


					
					
//$pdf->writeHTML($TB7, false, 0, true, 0);
$pdf->writeHTML($HR, false, 0, true, 0);
$pdf->writeHTML($TB10, false, 0, true, 0);
$pdf->writeHTML($TB11, false, 0, true, 0);
$pdf->writeHTML($TB12, false, 0, true, 0);
$pdf->writeHTML($HR, false, 0, true, 0);
$pdf->Ln(6);
	
$table2 = '<TABLE BORDER="0" WIDTH="100%" ><TR><TD><b>IDENTIFICACION DEL SOLICITANTE:</B> </TD><TD><b>IDENTIFICACION DEL CO-SOLICITANTE:</B> </TD></TR></TABLE>';
$pdf->writeHTML($table2, false, 0, true, 0);		
$pdf->writeHTML($TB13, false, 0, true, 0);
$pdf->writeHTML($TB14, false, 0, true, 0);
$pdf->writeHTML($TB15, false, 0, true, 0);
$pdf->writeHTML($TB16, false, 0, true, 0);
$pdf->writeHTML($HR, false, 0, true, 0);
$pdf->Ln(6);

$table3 = '<TABLE BORDER="0" WIDTH="100%" ><TR><TD><b>CUENTA DEL BENEFICIARIO:</B> </TD></TR></TABLE>';
$pdf->writeHTML($table3, false, 0, true, 0);
$pdf->writeHTML($TB17, false, 0, true, 0);
$pdf->writeHTML($TB18, false, 0, true, 0);
$pdf->writeHTML($HR, false, 0, true, 0);
$pdf->Ln(6);

$table4 = '<TABLE BORDER="0" WIDTH="100%" ><TR><TD><b>BENFICIARIO AUSPICIADOR LOCAL:</B> <FONT SIZE="6PX">(Quien le promociono la FUNDACION S.O.M.O.S, VENEZUELA.)</FONT></TD></TR></TABLE>';
$pdf->writeHTML($table4, false, 0, true, 0);
$pdf->writeHTML($TB19, false, 0, true, 0);
$pdf->writeHTML($TB20, false, 0, true, 0);
$pdf->writeHTML($HR, false, 0, true, 0);
$pdf->Ln(6);

$table5 = '<TABLE BORDER="0" WIDTH="100%" ><TR><TD><b>BENFICIARIO AUSPICIADOR INTERNACIONAL:</B> <FONT SIZE="6PX">(Quien le promociono la FUNDACION S.O.M.O.S, VENEZUELA.)</FONT></TD></TR></TABLE>';
$pdf->writeHTML($table5, false, 0, true, 0);
$pdf->writeHTML($TB21, false, 0, true, 0);
$pdf->writeHTML($TB22, false, 0, true, 0);
$pdf->writeHTML($HR, false, 0, true, 0);
$pdf->Ln(6);

$table6 = '<TABLE BORDER="0" WIDTH="100%" ><TR><TD ALIGN="JUTIFY"><b><FONT SIZE="8PX">Esta solicitud de Beneficiario representa la oferta contractual de la(as) persona(as) que suscriben este documento, dirigida a la FUNDACION S.O.M.O.S. VENEZUELA, para celebrar el Contrato de Beneficiario de acuerdo a los términos y condiciones que se señalan en el dorso. El (los) Solicitante(s) hace(n) constar por el presente documento que es (son) ciudadano(s) venezolano(s), domiciliados o no domiciliado (s) autorizado(s) y que no está(n) sujeto(s) a ninguna norma legal que restrinja o prohíba comprometerse como Beneficiario de la FUNDACION S.O.M.O.S. VENEZUELA. Cuando el Solicitante provea el nombre de su Cónyuge o Parte Relacionada, ambas partes aceptan la responsabilidad por sus actos que ejecuten en relación con el Contrato de Beneficiario, para el cual se hace la presente solicitud. El Solicitante declara que la información anterior es exacta y completa. </FONT></B></TD></TR></TABLE>';
$pdf->writeHTML($table6, false, 0, true, 0);
$pdf->Ln(6);
$pdf->writeHTML($TB24, false, 0, true, 0);
$pdf->writeHTML($TB23, false, 0, true, 0);
$pdf->Ln(4);
$pdf->writeHTML($TB25, false, 0, true, 0);
/*---------------------------------------------------------------------------------------------------------------------------------------*/



// ---------------------------------------------------------

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output('Planilla_Registro_FS0065455261','I');

//============================================================+
// END OF FILE                                                
//============================================================+

?>