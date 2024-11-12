<?php
// incluimos conexion base de datos
include('../../app/config.php');
// Include the main TCPDF library (search for installation path).
require_once('../../public/TCPDF-main/tcpdf.php');


//// TRAEMOS LOS DATOS DE LA INSTITUCION//////
include('../../app/controller/configuraciones/institucion/listado_de_instituciones.php');
foreach ($instituciones as $institucion) {
    $nombre_institucion = $institucion['nombre_institucion'];

    $correo = $institucion['correo'];
    $direccion = $institucion['direccion'];
    $telefono = $institucion['telefono'];
    $celular = $institucion['celular'];
    $logo = $institucion['logo'];    
}

// OBTENEMOS EL ID DEL ESTUDIANTE A TRAVES DE LA URL
$id_estudiante = $_GET['id'];

//TRAEMOS LOS DATOS DESDE EL CONTROLLER ESTUDIANTES
include('../../app/controller/estudiantes/datos_estudiantes.php');


// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, array(215, 280), true, 'UTF-8', false);

// set document information
$pdf->setCreator(PDF_CREATOR);
$pdf->setAuthor(APP_NAME);
$pdf->setTitle(APP_NAME);
$pdf->setSubject(APP_NAME);
$pdf->setKeywords(APP_NAME);

// set default header data
$pdf->setHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE . ' 001', PDF_HEADER_STRING, array(0, 64, 255), array(0, 64, 128));
$pdf->setFooterData(array(0, 64, 0), array(0, 64, 128));

// set header and footer fonts
$pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->setDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->setMargins(10, 10, 10);
$pdf->setHeaderMargin(PDF_MARGIN_HEADER);
$pdf->setFooterMargin(PDF_MARGIN_FOOTER);
$pdf->setPrintHeader(false);
// set auto page breaks
$pdf->setAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
    require_once(dirname(__FILE__) . '/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set default font subsetting mode
$pdf->setFontSubsetting(true);

// Set font
// dejavusans is a UTF-8 Unicode font, if you only need to
// print standard ASCII chars, you can use core fonts like
// helvetica or times to reduce file size.
$pdf->setFont('Times', '', 12, '', true);

// Add a page
// This method has several options, check the source code documentation for more information.
$pdf->AddPage();
// set JPEG quality
$pdf->setJPEGQuality(75);

// set text shadow effect
$pdf->setTextShadow(array('enabled' => true, 'depth_w' => 0.2, 'depth_h' => 0.2, 'color' => array(196, 196, 196), 'opacity' => 1, 'blend_mode' => 'Normal'));

// Image method signature:
// Image($file, $x='', $y='', $w=0, $h=0, $type='', $link='', $align='', $resize=false, $dpi=300, $palign='', $ismask=false, $imgmask=false, $border=0, $fitbox=false, $hidden=false, $fitonpage=false)
$pdf->Image(APP_URL.'/public/images/configuracion/'.$logo, 25, 10, 15, 13, '', '', '', true, 150, '', false, false, 1, false, false, false);

switch ($mesActual) {
    case $mesActual=='1':
        $mes = 'enero';
        break;
    case $mesActual=='2':
        $mes = 'febrero';
        break;
    case $mesActual=='3':
        $mes = 'marzo';
        break;
    case $mesActual=='4':
        $mes = 'abril';
        break;
    case $mesActual=='5':
        $mes = 'mayo';
        break;
    case $mesActual=='6':
        $mes = 'junio';
        break;
    case $mesActual=='7':
        $mes = 'julio';
        break;
    case $mesActual=='8':
        $mes = 'agosto';
        break;
    case $mesActual=='9':
        $mes = 'septiembre';
        break;
    case $mesActual=='10':
        $mes = 'octubre';
        break;
    case $mesActual=='11':
        $mes = 'noviembre';
        break;
    case $mesActual=='12':
        $mes = 'diciembre';
        break;
    default:
        # code...
        break;
}

$style = array(
    'border'=>0,
    'vpadding'=>'3',
    'hpadding'=>'3',
    'fgcolor'=>array(0, 0, 0),
    'bgcolor'=>false,
    'module_width'=>1,
    'module_height'=>1,
);

$QR =  'Este contrato es verificado por el sistema de inscripción de la Unidad Educativa '.$nombre_institucion.',
        por el El/La Señor(a) '.$nombre_apellidos.' con D.N.I.: Nro '.$dni_ppff.', habil por derecho en de fecha '.$fechaHora.'';
$pdf->write2DBarcode($QR, 'QRCODE,L', 160, 10, 35, 35, $style);

// Set some content to print
$html = '

    <table>
        <tr>
            <td width="150px" height="50px"></td>
            <td width="300px"></td>
        </tr>
        <tr>
            <td style="text-align: center" width="150px">
                <b>'.$nombre_institucion.'</b><br>
                <small>'.$celular.'</small><br>
                <small>'.$direccion.'</small>
            </td>
            <td style="text-align: center">
                <b><u>CONTRATO DE ESTUDIO PARA NIVEL PRIMARIO</u></b>
            </td>
        </tr>                     
    </table>

<p>

Entre:<br>
Nombre del Estudiante: '.$apellidos.", ".$nombres.'<br>
DNI/NIE del Estudiante: '.$dni.'<br>
Dirección del Estudiante: '.$direccion.'<br>

<br>

Y:<br>

<br>

Nombre de la Institución: '.$nombre_institucion.'<br>
Dirección de la Institución: '.$direccion.'<br>
Correo de la Institución: '.$correo.'<br>
<br>

Se acuerda lo siguiente:<br>

1. Objeto del contrato<br>
El presente contrato tiene como objetivo establecer los términos y condiciones bajo los cuales el estudiante se compromete a asistir a las clases y realizar las actividades académicas correspondientes.
<br><br>

2. Duración<br>
El contrato tendrá una duración de un año académico, comenzando el 05 de marzo del presente año y finalizando el 5 de diciembre del presente año.
<br><br>

3. Obligaciones del estudiante<br>
El estudiante se compromete a:<br>

Asistir a todas las clases programadas.<br>
Realizar las tareas y trabajos asignados en tiempo y forma.<br>
Participar activamente en las actividades académicas.<br>
Respetar las normas y reglamentos de la institución.<br>

<br>

4. Obligaciones de la institución/profesor<br>
La institución/profesor se compromete a:<br>
Proporcionar un ambiente de aprendizaje adecuado.<br>
Ofrecer las clases y recursos necesarios para el desarrollo académico del estudiante.<br>
Evaluar de manera justa y objetiva el desempeño del estudiante.<br>

<br>

5. Evaluación<br>
El desempeño del estudiante será evaluado mediante [especificar método de evaluación: exámenes, trabajos, participación, etc.].<br>
<br>

6. Modificaciones<br>
Cualquier modificación a este contrato deberá ser acordada por ambas partes y reflejada por escrito.<br>
<br>

7. Resolución de conflictos<br>
En caso de controversias relacionadas con este contrato, las partes se comprometen a resolverlas de manera amistosa. Si no se alcanza un acuerdo, se podrá recurrir a instancias legales correspondientes.<br>
<br>

8. Aceptación<br>
Al firmar este contrato, ambas partes aceptan y se comprometen a cumplir con los términos aquí establecidos.<br>
<br>

Firmas:<br><br><br><br><br><br><br>
<table>
    <tr>
        <td style="text-align: center">            
            ________________________________<br>
            <br>
            <b>La Institución: '.$nombre_institucion.'</b><br>
                Dirección: '.$direccion.'<br>                
        </td>
        <td style="text-align: center;">            
            ________________________________<br>
            <br>
            <b>Padre/Tutor: '.$nombre_apellidos.'</b><br>
            DNI: '.$dni_ppff.'<br>            
        </td>
    </tr>
</table>
<br><br><br><br>

Fecha: '. $diaActual.' de '. $mes.' del '. $yearActual.'.-
</p>
';

// Print text using writeHTMLCell()
$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

// ---------------------------------------------------------

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output('example_001.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
