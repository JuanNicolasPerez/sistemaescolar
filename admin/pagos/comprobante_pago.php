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

// OBTENEMOS EL ID DEL PAGO A TRAVES DE LA URL

$id_pago = $_GET['id'];

//TRAEMOS LOS DATOS DESDE EL CONTROLLER PAGOS
include('../../app/controller/pagos/datos_pago_estudiante.php');

//// TRAEMOS LOS DATOS DEL PAGO//////
foreach ($pagos as $pago) {
    $mes_pagado = $pago['mes_pagado'];
    $monto_pagado = $pago['monto_pagado'];
    $fecha_pagado = $pago['fecha_pagado'];
}

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
$pdf->setPrintFooter(false);
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
$pdf->Image(APP_URL . '/public/images/configuracion/' . $logo, 25, 10, 15, 13, '', '', '', true, 150, '', false, false, 1, false, false, false);
$pdf->Image(APP_URL . '/public/images/configuracion/' . $logo, 25, 145, 15, 13, '', '', '', true, 150, '', false, false, 1, false, false, false);

switch ($mesActual) {
    case $mesActual == '1':
        $mes = 'enero';
        break;
    case $mesActual == '2':
        $mes = 'febrero';
        break;
    case $mesActual == '3':
        $mes = 'marzo';
        break;
    case $mesActual == '4':
        $mes = 'abril';
        break;
    case $mesActual == '5':
        $mes = 'mayo';
        break;
    case $mesActual == '6':
        $mes = 'junio';
        break;
    case $mesActual == '7':
        $mes = 'julio';
        break;
    case $mesActual == '8':
        $mes = 'agosto';
        break;
    case $mesActual == '9':
        $mes = 'septiembre';
        break;
    case $mesActual == '10':
        $mes = 'octubre';
        break;
    case $mesActual == '11':
        $mes = 'noviembre';
        break;
    case $mesActual == '12':
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

$QR =  'Este recibo de caja es verificado por el sistema de administración de la Unidad Educativa '.$nombre_institucion.',
        por el pago del del mes '.$mes_pagado.', la suma de '.$monto_pagado.', habil por derecho en de fecha '.$fechaHora.'';
$pdf->write2DBarcode($QR, 'QRCODE,L', 150, 180, 35, 35, $style);

$QR2 =  'Este recibo de caja es verificado por el sistema de administración de la Unidad Educativa '.$nombre_institucion.',
        por el pago del del mes '.$mes_pagado.', la suma de '.$monto_pagado.', habil por derecho en de fecha '.$fechaHora.'';
$pdf->write2DBarcode($QR2, 'QRCODE,L', 150, 48, 35, 35, $style);

// Set some content to print
$html = '

    <table>
        <tr>
            <td width="150px" height="50px"></td>
            <td width="400px"></td>
            <td>
                <b>Nro: </b> ' . $id_pago . '<br>
                <b>Fecha: </b> ' . $fecha_pagado . '<br>
            </td>
        </tr>
        <tr>
            <td style="text-align: center" width="150px">
                <b>' . $nombre_institucion . '</b><br>
                <small>' . $direccion . '</small><br>
                <small>' . $celular . '</small>
            </td>
            <td style="text-align: center">
                <b><u>RECIBO DE CAJA</u></b>
            </td>
            <td>
                <b> ORIGINAL </b><br>
            </td>
        </tr>                     
    </table>

    <br><br>

    <table>
        <tr>
            <td><b>  Estudiante: </b></td>
            <td>' . $apellidos . ', ' . $nombres . '</td>
            <td></td>
        </tr>
        <tr>
            <td><b>  Documento: </b></td>
            <td>' . $dni . '</td>
            <td></td>
        </tr> 
        <tr>
            <td><b>  Nivel: </b></td>
            <td>' . $nivel . ' - ' . $turno . '</td>
            <td></td>
        </tr>   
        <tr>
            <td><b>  Curso: </b></td>
            <td>' . $curso . ' - ' . $paralelo . '</td>
            <td></td>
        </tr> 
        <tr>
            <td><b>  Mes cancelado: </b></td>
            <td>' . $mes_pagado . '</td>
            <td></td>
        </tr> 
        <tr>
            <td><b>  Monto cancelado: </b></td>
            <td>AR$ ' . $monto_pagado . '</td>
            <td></td>
        </tr>                 
    </table>

    <br><br>
    Fecha: ' . $diaActual . ' de ' . $mes . ' del ' . $yearActual . '.-<br>
    Firmas:<br><br><br>

    <table>
        <tr>
            <td style="text-align: center">            
                ________________________________<br>
                        Entregue conforme<br>             
                <b>La Institución: ' . $nombre_institucion . '</b><br>                
            </td>
            <td style="text-align: center;">            
                ________________________________<br>
                        Recibi conforme<br>             
            </td>
        </tr>
    </table>    
    <p style="text-align: center">------------------------------------------------------------------------------------------------------------------------------------</p>
    <table>
        <tr>
            <td width="150px" height="50px"></td>
            <td width="400px"></td>
            <td>
                <b>Nro: </b> ' . $id_pago . '<br>
                <b>Fecha: </b> ' . $fecha_pagado . '<br>
            </td>
        </tr>
        <tr>
            <td style="text-align: center" width="150px">
                <b>' . $nombre_institucion . '</b><br>
                <small>' . $direccion . '</small><br>
                <small>' . $celular . '</small>
            </td>
            <td style="text-align: center">
                <b><u>RECIBO DE CAJA</u></b>
            </td>
            <td>
                <b> DUPLICADO </b><br>
            </td>
        </tr>                     
    </table>

    <br><br>

    <table>
        <tr>
            <td><b>  Estudiante: </b></td>
            <td>' . $apellidos . ', ' . $nombres . '</td>
            <td></td>
        </tr>
        <tr>
            <td><b>  Documento: </b></td>
            <td>' . $dni . '</td>
            <td></td>
        </tr> 
        <tr>
            <td><b>  Nivel: </b></td>
            <td>' . $nivel . ' - ' . $turno . '</td>
            <td></td>
        </tr>   
        <tr>
            <td><b>  Curso: </b></td>
            <td>' . $curso . ' - ' . $paralelo . '</td>
            <td></td>
        </tr> 
        <tr>
            <td><b>  Mes cancelado: </b></td>
            <td>' . $mes_pagado . '</td>
            <td></td>
        </tr> 
        <tr>
            <td><b>  Monto cancelado: </b></td>
            <td>AR$ ' . $monto_pagado . '</td>
            <td></td>
        </tr>                 
    </table>

    <br>
    Fecha: ' . $diaActual . ' de ' . $mes . ' del ' . $yearActual . '.-<br>
    Firmas:<br><br><br>

    <table>
        <tr>
            <td style="text-align: center">            
                ________________________________<br>
                        Entregue conforme<br>             
                <b>La Institución: ' . $nombre_institucion . '</b>             
            </td>
            <td style="text-align: center;">            
                ________________________________<br>
                        Recibi conforme           
            </td>
        </tr>
    </table>
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
