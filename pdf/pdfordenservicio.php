<?php

# CONFIGURACION DE LA SESION
include '../config/config.php';

# Si no existe una sesion se redireciona directamente al inicio
if (!isset($_SESSION["iniciarSesion"])) {
    header("Location: " . URL_APP);
}

# SE VALIDA DE QUE EL ID SEA DE TIPO INT 
if (isset($_REQUEST['idorden']) && preg_match('/^[0-9]+$/', $_REQUEST['idorden'])) {
    $idorden = $_REQUEST['idorden'];
} else {
    header("Location: " . URL_APP);
}

#SE ESTABLECE EL HORARIO 
date_default_timezone_set('America/Bogota');

# SE REQUIERE EL AUTOLOAD
require '../vendor/autoload.php';

# REQUERIMOS EL CONTROLADOR Y EL MODELO PARA HACER USO DE LA INFORMACIÓN
require '../controllers/contratos.controlador.php';
require '../models/contratos.modelo.php';
require '../models/conceptos.modelo.php';


$resultado = ModeloOrdenServicio::mdlVerOrden($idorden);
$empresa = ModeloConceptosGH::mdlVerEmpresa();

/* ===================== 
  SI LA INFORMACIÓN VIENE FALSA SE REDIRECCIONA A LAS ORDERS
========================= */

if ($resultado === false) {
    header("Location: " . URL_APP);
}

/* ===================== 
  CONFIGURACIÓN DEL HEADER Y FOOTER EN EL ARCHIVO PDF 
========================= */
// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF
{

    //Page header
    public function Header()
    {
        // get the current page break margin
        $bMargin = $this->getBreakMargin();
        // get current auto-page-break mode
        $auto_page_break = $this->AutoPageBreak;
        // disable auto-page-break
        $this->SetAutoPageBreak(false, 0);
        // set bacground image
        $img_file = '../views/img/plantilla/plantillapdf.png';
        //$this->Image($img_file, 0, 0, 210, 297, '', '', '', false, 300, '', false, false, 0);
        // restore auto-page-break status
        $this->SetAutoPageBreak($auto_page_break, $bMargin);
        // set the starting point for the page content
        $this->setPageMark();
    }

    // Page footer
    public function Footer()
    {
        // Position at 15 mm from bottom
        $this->SetY(-10);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'Página ' . $this->getAliasNumPage() . '/' . $this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
}


class OrdenServicioPDF
{

    /* ===================== 
      GENERACION DE ARCHIVOS PDF DE LA PETICION DE OFERTA 
    ========================= */
    static public function makePDF($info, $empresa)
    {

        /* ===================== 
            UTILIZANDO LA VERSION DE TCPDF PARA GENERAR EL ARCHIVO 
        ========================= */
        # orientacion => p || unidade medida => cm
        $pdf = new MYPDF(PDF_PAGE_ORIENTATION, 'mm', PDF_PAGE_FORMAT, true, 'UTF-8', false);


        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor(PROYECTO);
        $pdf->SetTitle('Orden de servicio');
        $pdf->SetSubject('Orden de servicio');
        $pdf->SetKeywords('TCPDF, PDF, example, test, guide');

        // set default header data
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
        /* $pdf->setFooterData(array(0, 64, 0), array(0, 64, 128)); */

        // set header and footer fonts
        // $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        // $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, 25, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

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
        $pdf->SetFont('dejavusans', '', 14, '', true);

        // Add a page
        // This method has several options, check the source code documentation for more information.
        $pdf->AddPage();

        // set text shadow effect
        // $pdf->setTextShadow(array('enabled' => true, 'depth_w' => 0.2, 'depth_h' => 0.2, 'color' => array(196, 196, 196), 'opacity' => 1, 'blend_mode' => 'Normal'));


        // Set some content to print
        /* ===================================================
           * CONTENIDO
        ===================================================*/
        $pdf->SetFillColor(255, 255, 255);
        // ONLY BOTTOM BORDER
        $complex_cell_border = array(
            /* 'T' => array('width' => 0, 'color' => array(255, 255, 255), 'dash' => 0, 'cap' => 'butt'), */
            /* 'R' => array('width' => 0, 'color' => array(255, 255, 255), 'dash' => 0, 'cap' => 'butt'), */
            'B' => array('width' => 0.4, 'color' => array(0, 0, 0), 'dash' => 0, 'cap' => 'butt'),
            /* 'L' => array('width' => 0, 'color' => array(255, 255, 255), 'dash' => 0, 'cap' => 'butt'), */
        );

        $complex_cell_border_top = array(
            'T' => array('width' => 0.4, 'color' => array(0, 0, 0), 'dash' => 0, 'cap' => 'butt'),
            /* 'R' => array('width' => 0, 'color' => array(255, 255, 255), 'dash' => 0, 'cap' => 'butt'), */
            /* 'B' => array('width' => 0, 'color' => array(0, 0, 0), 'dash' => 0, 'cap' => 'butt'), */
            /* 'L' => array('width' => 0, 'color' => array(255, 255, 255), 'dash' => 0, 'cap' => 'butt'), */
        );


        /* ===================================================
           LOGOS CABECERA
        ===================================================*/
        // $image_vigilado = '../views/img/plantilla/fuec/img_vigilado.png';
        // $image_todos = '../views/img/plantilla/fuec/img_todos.png';
        // $image_ponal = '../views/img/plantilla/fuec/img_ponal.png';
        // $image_mintransporte = '../views/img/plantilla/fuec/img_mintransporte.jpeg';
        // $image_iso = '../views/img/plantilla/fuec/img_iso.jpeg';
        $image_elsaman = '../views/img/plantilla/fuec/img_logo.jpg';
        // $image_codigos = '../views/img/plantilla/fuec/img_codigos.png';
        // $image_5estrellas = '../views/img/plantilla/fuec/img_5estrellas.jpg';
        // $image_qr = '../views/img/plantilla/fuec/img_qr.png';
        // $image_firma = '../views/img/plantilla/fuec/img_firma.jpg';

        // $pdf->Image($image_vigilado, 10, 20, 65, 12,  'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        // $pdf->Image($image_iso, 85, 20, 28, 12,  'JPEG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        $pdf->Image($image_elsaman, 158, 10, 45, 34,  'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        // $pdf->Image($image_qr, 165, 15, 20, 20,  'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);

        /* ===================================================
           TITULO ORDEN DE SERVICIO
        ===================================================*/
        $pdf->SetFont('helvetica', 'B', '8');
        //Ancho de texto y de pagina
        $anchoTexto = 130;
        $anchoPaginaMM = $pdf->getPageWidth();
        //Coordenadas
        $x = ($anchoPaginaMM / 2) - ($anchoTexto / 2);
        $y = $pdf->GetY() + 15;
        //Titulo principal
        $pdf->MultiCell(130, 5, $empresa['razon_social'], 0, 'C', 0, 1, $x, $y, true);
        $pdf->SetFont('helvetica', '', '8');
        $pdf->Ln(4);
        //NIT
        $pdf->SetFont('helvetica', 'B', '8');
        $pdf->MultiCell(130, 5, "NIT:", 0, 'C', 0, 1, $x, '', true);
        $pdf->SetFont('helvetica', '', '8');
        $pdf->MultiCell(130, 5, $empresa['nit'], 0, 'C', 0, 1, $x, '', true);
        $pdf->Ln(4);
        //INFORME
        // $pdf->SetFont('helvetica', 'B', '8');
        // $pdf->MultiCell(130, 5, 'Informe para facturación por servicios de transporte', 0, 'C', 0, 1, $x, '', true);
        // $pdf->Ln(4);
        /* ===================================================
           INFORMACIÓN DE LA ORDEN
        ===================================================*/

        //table cellspacing="0" cellpadding="10" border="1"
        
        //TABLA
        $tabla = '<table cellspacing="0" cellpadding="10" border="1">
        <tbody>
            <tr>
                <td colspan="3"><b>Código: </b></td>
                <td colspan="8" style="text-align: center"><b> INFORME PARA FACTURACIÓN POR SERVICIOS DE TRANSPORTE </b></td>
                <td colspan="3"><b>Versión: </b></td>
            </tr>
            <tr>
                <td colspan="14" style="text-align: center"><b>DATOS DEL CLIENTE</b></td>
            </tr>
            <tr>
                <td colspan="3" style="text-align: center"><b><i>Nombre contratante</i></b></td>
                <td colspan="4">' . $info['nombre_con'] . '</td>
                <td colspan="3"  style="text-align: center"><b><i>NIT / CC</i></b></td>
                <td colspan="4">' . $info['documento_con'] . '</td>
            </tr>
            <tr>
                <td colspan="3" style="text-align: center"><b><i>Dirección</i></b></td>
                <td colspan="4">' . $info['direccion_con'] . '</td>
                <td colspan="3" style="text-align: center"><b><i>Teléfono</i></b></td>
                <td colspan="4">' . $info['tel_1'] . '</td>
            </tr>
            <tr>
                <td colspan="3" style="text-align: center"><b><i>Nombre contacto</i></b></td>
                <td colspan="4">' . $info['nombre_respo'] . '</td>
                <td colspan="3" style="text-align: center"><b><i>Teléfono 2</i></b></td>
                <td colspan="4">' . $info['tel_2'] . '</td>
            </tr>
            <tr>
                <td colspan="14" style="text-align: center"><b>DATOS DEL SERVICIO</b></td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: center"><b><i>ORD. SERV.</i></b></td>
                <td colspan="2" style="text-align: center"><b><i>Nro. contrato</i></b></td>
                <td colspan="2" style="text-align: center"><b><i>Fecha inicio</i></b></td>
                <td colspan="2" style="text-align: center"><b><i>Fecha final</i></b></td>
                <td colspan="2" style="text-align: center"><b><i>Hora de inicio</i></b></td>
                <td colspan="2" style="text-align: center"><b><i>Hora de final</i></b></td>
                <td colspan="2" style="text-align: center"><b><i>Valor a facturar</i></b></td>
            </tr>
            <tr>
                <td colspan="2">' . $info['idorden'] . '</td>
                <td colspan="2"></td>
                <td colspan="2">' . $info['fecha_inicio'] . '</td>
                <td colspan="2">' . $info['fecha_fin'] . '</td>
                <td colspan="2">' . $info['hora_salida'] . '</td>
                <td colspan="2">' . $info['hora_recogida'] . '</td>
                <td colspan="2">' . $info['valortotal'] . '</td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: center"><b><i>Origen:</i></b></td>
                <td colspan="2" style="text-align: center">' . $info['origen'] . '</td>
                <td colspan="2" style="text-align: center"><b><i>Destino:</i></b></td>
                <td colspan="2" style="text-align: center">' . $info['destino'] . '</td>
                <td colspan="2" style="text-align: center"><b><i>Ruta:</i></b></td>
                <td colspan="4" style="text-align: center">' . $info['descripcion'] . '</td>
            </tr>
            <tr>
                <td colspan="14" style="text-align: center"><b>REQUISITOS DEL CLIENTE</b></td>
            </tr>
            <tr>
                <td colspan="2"><b><i>Baño</i></b></td>
                <td colspan="2"><b><i>Música</i></b></td>
                <td colspan="2"><b><i>Aire</i></b></td>
                <td colspan="2"><b><i>WI-FI</i></b></td>
                <td colspan="2"><b><i>Silleteria reclinable</i></b></td>
                <td colspan="2"><b><i>Bodega</i></b></td>
                <td colspan="2"><b><i>Otro</i></b></td>
            </tr>
            <tr>
                <td colspan="2">' . $info['bano'] . '</td>
                <td colspan="2">' . $info['musica'] . '</td>
                <td colspan="2">' . $info['aire'] . '</td>
                <td colspan="2">' . $info['wifi'] . '</td>
                <td colspan="2">' . $info['silleriareclinable'] . '</td>
                <td colspan="2">' . $info['bodega'] . '</td>
                <td colspan="2">' . $info['otro'] . '</td>
            </tr>
            <tr>
                <td colspan="14" style="text-align: center"><b>OBSERVACIONES DE FACTURACIÓN</b></td>
            </tr>
            <tr>
                <td colspan="3" style="text-align: center"><b>Num. Factura</b></td>
                <td colspan="3">' . $info['nro_factura'] . '</td>
                <td colspan="2" style="text-align: center"><b>Fecha de facturación</b></td>
                <td colspan="2">' . $info['fecha_facturacion'] . '</td>
                <td colspan="2" style="text-align: center"><b>CANCELADA</b></td>
                <td colspan="2">' . $info['cancelada'] . '</td>
            </tr>
            <tr>
                <td colspan="14" style="text-align: center"><b>INFORMACIÓN DE LOS VEHÍCULOS</b></td>
            </tr>
            <tr>
                <td colspan="2" rowspan="2"><b>Código Cotización</b></td>
                <td colspan="4" style="text-align: center"><b>Vehículo</b></td>
                <td colspan="3" style="text-align: center"><b>Detalle</b></td>
                <td colspan="2" style="text-align: center"><b>Fecha servicio</b></td>
                <td style="font-size:9px">Total Horas</td>
                <td style="font-size:8px">K.M</td>
                <td style="font-size:8px">Valor servic.</td>
            </tr>
            <tr>
                <td style="font-size:9px">Tipo</td>
                <td style="font-size:9px">Capac.</td>
                <td style="font-size:9px">Placa</td>
                <td style="font-size:9px">No. Int</td>
                <td colspan="3" style="color:white">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Eligendi, velit quas. Tenetur aliquam laboriosam corporis quam excepturi officiis vel repellendus recusandae reprehenderit earum molestiae quae sapiente deserunt quaerat, labore dolorum?</td>
                <td colspan="2"></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        </tbody>
    </table>
        ';
        $pdf->SetFont('helvetica', '', '8');
        $pdf->writeHTML($tabla);
        -        // ---------------------------------------------------------

        // Close and output PDF document
        // This method has several options, check the source code documentation for more information.
        $pdf->Output('FUEC', 'I');

        //============================================================+
        // END OF FILE
        //============================================================+
    }
}

# SE INSTANCIA LA CLASE PARA LA GENERACION DEL ARCHIVO PDF
OrdenServicioPDF::makePDF($resultado, $empresa);
