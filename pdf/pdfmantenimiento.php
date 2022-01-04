<?php

# CONFIGURACION DE LA SESION
include '../config/config.php';

# Si no existe una sesion se redireciona directamente al inicio
// if (!isset($_SESSION["iniciarSesion"])) {
//   header("Location: " . URL_APP);
// }

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
require '../controllers/mantenimiento.controlador.php';
require '../models/mantenimiento.modelo.php';
require '../models/conceptos.modelo.php';
require '../controllers/vehicular.controlador.php';
require '../controllers/operaciones.controlador.php';
require '../models/vehicular.modelo.php';
require '../models/operaciones.modelo.php';
$empresa = ModeloEmpresaRaiz::mdlVerEmpresa();
$ServiciosExternos = ControladorMantenimientos::ctrServiciosExt($idorden);
$Repuestos = ControladorMantenimientos::ctrRepuestosOrden($idorden);
$OrdenServicios = ControladorMantenimientos::ctrCargarOrdenServicio($idorden);
$ManoObra = ControladorMantenimientos::ctrManoObraOrden($idorden);

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

class mantenimientoPDF
{
    /* ===================== 
      GENERACION DE ARCHIVOS PDF DE LA SOLICITUD 
    ========================= */
    static public function solicitudPDF($orden,$servicios,$repuestos,$empresa)
    {
       
        // echo "<pre>";
        // var_dump($repuestos);
        // echo "</pre>";
        $p="<ul>";
        //VALIDAR TIPO DE SERVICIOS 
        foreach ($servicios as $key => $value) {

            $p .= "<li>" . $value['nombre'] ."</li>";
        }
        $p.="</ul>";

        $tr="";
        foreach ($repuestos as $key => $value) {
            $tr .= "
            <tr>
                <td style='text-align: center;'>".$value['descripcion']."</td>
                <td style='text-align: center;'>".$value['referencia']."</td>
                <td style='text-align: center;'>".$value['codigo']."</td>
                <td style='text-align: center;'>".$value['valor']."</td>
            </tr>
            ";
        }

        /* ===================== 
            UTILIZANDO LA VERSION DE TCPDF PARA GENERAR EL ARCHIVO 
        ========================= */
        # orientacion => p || unidade medida => cm
        $pdf = new MYPDF(PDF_PAGE_ORIENTATION, 'mm', PDF_PAGE_FORMAT, true, 'UTF-8', false);
        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor(PROYECTO);
        $pdf->SetTitle('SolicitudOrden');
        $pdf->SetSubject('SolicitudOrden');
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
        /* ==================================================
           LOGOS CABECERA
        ===================================================*/
        $image_elsaman = '../views/img/plantilla/fuec/img_logo.jpg';

        $pdf->Image($image_elsaman, 158, 10, 45, 34,  'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);

        /* ===================================================
           TITULO ALISTAMIENTO
        ===================================================*/
        $pdf->SetFont('helvetica', 'B', '8');
        //Ancho de texto y de pagina
        $anchoTexto = 130;
        $anchoPaginaMM = $pdf->getPageWidth();
        //Coordenadas
        $x = ($anchoPaginaMM / 2) - ($anchoTexto / 2);
        $y = $pdf->GetY() + 15;
        //Titulo principal
        $pdf->MultiCell(130, 5, 'SOLICITUD DE SERVICIO', 0, 'C', 0, 1, $x, $y, true);
        $pdf->MultiCell(130, 5, $empresa['razon_social'], 0, 'C', 0, 1, $x, '', true);
        $pdf->SetFont('helvetica', '', '8');
        $pdf->Ln(3);
        //NIT
        $pdf->SetFont('helvetica', 'B', '8');
        $pdf->MultiCell(130, 5, "NIT:", 0, 'C', 0, 1, $x, '', true);
        $pdf->SetFont('helvetica', 'I', '8');
        $pdf->MultiCell(130, 5, $empresa['nit'], 0, 'C', 0, 1, $x, '', true);
        $pdf->Ln(3);

        //DATOS DEL VEHICULO
        #Placa
        $pdf->SetFont('helvetica', 'B', '8');
        $pdf->MultiCell(30, 5, "Placa:", 0, 'L', 0, 0, '', '', true);
        $pdf->SetFont('helvetica', '', '8');
        $pdf->MultiCell(100, 5, $orden['placa'], 0, 'L', 0, 0, '', '', true);
        # Marca
        $pdf->SetFont('helvetica', 'B', '8');
        $pdf->MultiCell(20, 5, "Marca:", 0, 'L', 0, 0, '', '', true);
        $pdf->SetFont('helvetica', '', '8');
        $pdf->MultiCell(100, 5, $orden['marca'], 0, 'L', 0, 0, '', '', true);
        $pdf->Ln();

        #Numero interno
        $pdf->SetFont('helvetica', 'B', '8');
        $pdf->MultiCell(30, 5, "Número interno:", 0, 'L', 0, 0, '', '', true);
        $pdf->SetFont('helvetica', '', '8');
        $pdf->MultiCell(100, 5, $orden['numinterno'], 0, 'L', 0, 0, '', '', true);
        # Modelo
        $pdf->SetFont('helvetica', 'B', '8');
        $pdf->MultiCell(20, 5, "Modelo:", 0, 'L', 0, 0, '', '', true);
        $pdf->SetFont('helvetica', '', '8');
        $pdf->MultiCell(100, 5, $orden['modelo'], 0, 'L', 0, 0, '', '', true);
        $pdf->Ln();

        #clase de vehiculo
        $pdf->SetFont('helvetica', 'B', '8');
        $pdf->MultiCell(30, 5, "Clase de vehículo:", 0, 'L', 0, 0, '', '', true);
        $pdf->SetFont('helvetica', '', '8');
        $pdf->MultiCell(100, 5, $orden['tipovehiculo'], 0, 'L', 0, 0, '', '', true);
        # kilometraje
        $pdf->SetFont('helvetica', 'B', '8');
        $pdf->MultiCell(20, 5, "Kilometraje:", 0, 'L', 0, 0, '', '', true);
        $pdf->SetFont('helvetica', '', '8');
        $pdf->MultiCell(100, 5, $orden['kilometraje'], 0, 'L', 0, 0, '', '', true);
        $pdf->Ln();

        #Fecha entrada
        $pdf->SetFont('helvetica', 'B', '8');
        $pdf->MultiCell(30, 5, "Fecha de entrada:", 0, 'L', 0, 0, '', '', true);
        $pdf->SetFont('helvetica', '', '8');
        $pdf->MultiCell(100, 5, $orden['Ffecha_entrada'], 0, 'L', 0, 0, '', '', true);
        #Orden de servicio
        $pdf->SetFont('helvetica', 'B', '8');
        $pdf->MultiCell(20, 5, "N° Orden:", 0, 'L', 0, 0, '', '', true);
        $pdf->SetFont('helvetica', '', '8');
        $pdf->MultiCell(100, 5, $orden['idorden'], 0, 'L', 0, 0, '', '', true);
        $pdf->Ln();
        $pdf->Ln();

        /* ===================================================
           ORDEN SERVICIO PRINCIPAL
        ===================================================*/
        //TABLA
        $tabla =
            '<table cellspacing="0" cellpadding="5" border="1">
            <tbody>
            <tr>
            <td colspan="6" style="text-align: center;"><strong>DESCRIPCIÓN</strong></td>
            <td colspan="6" class="text-center" style="text-align: center;"><strong>SERVICIOS EXTERNOS</strong></td>
            </tr>

            <tr>
            <td colspan="6" style="text-align: center;">' . $orden['diagnostico'] . '</td>
            <td colspan="6" class="text-center" style="text-align: center;">'.$p.'</td>
            </tr>
            </tbody>  
        </table>
        ';

        $pdf->SetFont('helvetica', '', '8');
        $pdf->writeHTML($tabla);

        $pdf->SetFont('helvetica', 'B', '10');
        $pdf->Cell(0, 0, "REPUESTOS", 0, 0, 'C', 0, '', 0);
        $pdf->Ln();
        $pdf->Ln();

        $tabla2 =
            '<table cellspacing="0" cellpadding="5" border="1">
            <thead>

            <tr>
                <th style="text-align: center;">NOMBRE</th>
                <th style="text-align: center;">REFERENCIA</th>
                <th style="text-align: center;">CÓDIGO</th>
                <th style="text-align: center;">VALOR</th>
            </tr>

            </thead>

            <tbody>
                '.$tr.'
            </tbody>  
        </table>
        ';

        $pdf->SetFont('helvetica', '', '8');
        $pdf->writeHTML($tabla2);
        /* ---------------------------------------------------------
        | | | | EVIDENCIAS
        ==========================================================*/

        // Close and output PDF document
        // This method has several options, check the source code documentation for more information.
        $pdf->Output('SolicitudOrden', 'I');
        //============================================================+
        // END OF FILE
        //============================================================+
    }

    /* ===================== 
      GENERACION DE ARCHIVOS PDF DE LA ORDEN DE SERVICIO
    ========================= */
    static public function ordenServicioPDF($orden,$servicios,$mano_obra,$repuestos,$empresa)
    {
        // $p="<ul>";
        // //VALIDAR TIPO DE SERVICIOS 
        // foreach ($servicios as $key => $value) {

        //     $p .= "<li>" . $value['nombre'] ."</li>";
        // }
        // $p.="</ul>";

        $tr="";
        foreach ($repuestos as $key => $value) {
            $tr .= "
            <tr>
                <td style='text-align: center;'>".$value['descripcion']."</td>
                <td style='text-align: center;'>".$value['referencia']."</td>
                <td style='text-align: center;'>".$value['codigo']."</td>
                <td style='text-align: center;'>".$value['cantidad']."</td>
                <td style='text-align: center;'>$".$value['valor']."</td>
                <td style='text-align: center;'>".$value['razon_social']."</td>
            </tr>
            ";
        }

        $tr2="";
        foreach ($repuestos as $key => $value) {
            $tr2 .= "
            <tr>
                <td style='text-align: center;'>".$value['sistema']."</td>
                <td style='text-align: center;'>".$value['mantenimiento']."</td>
            </tr>
            ";
        }

        $tr3="";
        foreach ($mano_obra as $key => $value) {
            $tr3 .= "
            <tr>
                <td style='text-align: center;'>".$value['descripcion']."</td>
                <td style='text-align: center;'>".$value['cantidad']."</td>
                <td style='text-align: center;'>".$value['valor']."</td>
                <td style='text-align: center;'>".$value['razon_social']."</td>
            </tr>
            ";
        }

        // $tr4="";
        // foreach ($orden as $key => $value) {
        //     $tr4 .= "
        //     <tr>
        //         <td style='text-align: center;'>".$value['diagnostico']."</td>
        //         <td style='text-align: center;'>".$value['observacion']."</td>
        //     </tr>
        //     ";
        // }

        /* ===================== 
            UTILIZANDO LA VERSION DE TCPDF PARA GENERAR EL ARCHIVO 
        ========================= */
        # orientacion => p || unidade medida => cm
        $pdf = new MYPDF(PDF_PAGE_ORIENTATION, 'mm', PDF_PAGE_FORMAT, true, 'UTF-8', false);
        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor(PROYECTO);
        $pdf->SetTitle('OrdenServicio');
        $pdf->SetSubject('OrdenServicio');
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
        /* ==================================================
           LOGOS CABECERA
        ===================================================*/
        $image_elsaman = '../views/img/plantilla/fuec/img_logo.jpg';

        $pdf->Image($image_elsaman, 158, 10, 45, 34,  'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);

        /* ===================================================
           TITULO ALISTAMIENTO
        ===================================================*/
        $pdf->SetFont('Times', 'B', '8');
        //Ancho de texto y de pagina
        $anchoTexto = 130;
        $anchoPaginaMM = $pdf->getPageWidth();
        //Coordenadas
        $x = ($anchoPaginaMM / 2) - ($anchoTexto / 2);
        $y = $pdf->GetY() + 15;
        //Titulo principal
        $pdf->MultiCell(130, 5, 'ORDEN DE SERVICIO', 0, 'C', 0, 1, $x, $y, true);
        $pdf->MultiCell(130, 5, $empresa['razon_social'], 0, 'C', 0, 1, $x, '', true);
        $pdf->SetFont('Times', '', '8');
        $pdf->Ln(3);
        //NIT
        $pdf->SetFont('Times', 'B', '8');
        $pdf->MultiCell(130, 5, "NIT:", 0, 'C', 0, 1, $x, '', true);
        $pdf->SetFont('Times', 'I', '8');
        $pdf->MultiCell(130, 5, $empresa['nit'], 0, 'C', 0, 1, $x, '', true);
        $pdf->Ln(3);

        $pdf->writeHTML("<hr>");

        //DATOS DEL VEHICULO
        #Placa
        $pdf->SetFont('helvetica', 'B', '8');
        $pdf->MultiCell(30, 5, "Placa:", 0, 'L', 0, 0, '', '', true);
        $pdf->SetFont('helvetica', '', '8');
        $pdf->MultiCell(100, 5, $orden['placa'], 0, 'L', 0, 0, '', '', true);
        # Marca
        $pdf->SetFont('helvetica', 'B', '8');
        $pdf->MultiCell(20, 5, "Marca:", 0, 'L', 0, 0, '', '', true);
        $pdf->SetFont('helvetica', '', '8');
        $pdf->MultiCell(100, 5, $orden['marca'], 0, 'L', 0, 0, '', '', true);
        $pdf->Ln();

        #Numero interno
        $pdf->SetFont('helvetica', 'B', '8');
        $pdf->MultiCell(30, 5, "Número interno:", 0, 'L', 0, 0, '', '', true);
        $pdf->SetFont('helvetica', '', '8');
        $pdf->MultiCell(100, 5, $orden['numinterno'], 0, 'L', 0, 0, '', '', true);
        # Modelo
        $pdf->SetFont('helvetica', 'B', '8');
        $pdf->MultiCell(20, 5, "Modelo:", 0, 'L', 0, 0, '', '', true);
        $pdf->SetFont('helvetica', '', '8');
        $pdf->MultiCell(100, 5, $orden['modelo'], 0, 'L', 0, 0, '', '', true);
        $pdf->Ln();

        #clase de vehiculo
        $pdf->SetFont('helvetica', 'B', '8');
        $pdf->MultiCell(30, 5, "Clase de vehículo:", 0, 'L', 0, 0, '', '', true);
        $pdf->SetFont('helvetica', '', '8');
        $pdf->MultiCell(100, 5, $orden['tipovehiculo'], 0, 'L', 0, 0, '', '', true);
        # kilometraje
        $pdf->SetFont('helvetica', 'B', '8');
        $pdf->MultiCell(20, 5, "Kilometraje:", 0, 'L', 0, 0, '', '', true);
        $pdf->SetFont('helvetica', '', '8');
        $pdf->MultiCell(100, 5, $orden['kilometraje'], 0, 'L', 0, 0, '', '', true);
        $pdf->Ln();

        #Fecha entrada
        $pdf->SetFont('helvetica', 'B', '8');
        $pdf->MultiCell(30, 5, "Fecha de entrada:", 0, 'L', 0, 0, '', '', true);
        $pdf->SetFont('helvetica', '', '8');
        $pdf->MultiCell(100, 5, $orden['Ffecha_entrada'], 0, 'L', 0, 0, '', '', true);
        #Orden de servicio
        $pdf->SetFont('helvetica', 'B', '8');
        $pdf->MultiCell(20, 5, "N° Orden:", 0, 'L', 0, 0, '', '', true);
        $pdf->SetFont('helvetica', '', '8');
        $pdf->MultiCell(100, 5, $orden['idorden'], 0, 'L', 0, 0, '', '', true);
        $pdf->Ln();
        $pdf->Ln();

        $pdf->writeHTML("<hr>");

        /* ===================================================
           ORDEN SERVICIO PRINCIPAL
        ===================================================*/
        //TABLA
        $tabla =
            '<table cellspacing="0" cellpadding="5" border="1">
                <thead>
                    <tr>
                        <td class="text-center" style="text-align: center;"><strong>Fecha de entrada</strong></td>
                        <td class="text-center" style="text-align: center;"><strong>Hora de entrada</strong></td>
                        <td class="text-center" style="text-align: center;"><strong>Fecha de aprobación</strong></td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-center" style="text-align: center;">'.$orden['fecha_entrada'].'</td>
                        <td class="text-center" style="text-align: center;">'.$orden['hora_entrada'].'</td>
                        <td class="text-center" style="text-align: center;">'.$orden['fecha_aprobacion'].'</td>
                    </tr>
                </tbody>  
            </table>
        ';

        $pdf->SetFont('helvetica', '', '7');
        $pdf->writeHTML($tabla);

        $sistema =
            '<table cellspacing="0" cellpadding="5" border="1">
                <thead>
                    <tr>
                        <th style="text-align: center;"><strong>Sistema</strong></th>
                        <th style="text-align: center;"><strong>Tipo de mantenimiento</strong></th>
                    </tr>
                </thead>
                <tbody>
                        '.$tr2.'
                </tbody>  
            </table>
        ';

        $pdf->SetFont('helvetica', '', '7');
        $pdf->writeHTML($sistema);

        $pdf->writeHTML("<hr>");

        $pdf->SetFont('helvetica', 'B', '7');
        $pdf->Cell(0, 0, "REPUESTOS", 0, 0, 'C', 0, '', 0);
        $pdf->Ln();
        $pdf->Ln();

        $tabla2 =
            '<table cellspacing="0" cellpadding="5" border="1">
                <thead>
                    <tr>
                        <th style="text-align: center;"><strong>Descripción</strong></th>
                        <th style="text-align: center;"><strong>Referencia</strong></th>
                        <th style="text-align: center;"><strong>Código</strong></th>
                        <th style="text-align: center;"><strong>Cantidad</strong></th>
                        <th style="text-align: center;"><strong>Valor unitario</strong></th>
                        <th style="text-align: center;"><strong>Proveedor</strong></th>
                    </tr>
                </thead>
                <tbody>
                    '.$tr.'
                </tbody>  
            </table>
        ';
        $pdf->SetFont('helvetica', '', '7');
        $pdf->writeHTML($tabla2);

        $pdf->writeHTML("<hr>");

        $pdf->SetFont('helvetica', 'B', '7');
        $pdf->Cell(0, 0, "MANO DE OBRA", 0, 0, 'C', 0, '', 0);
        $pdf->Ln();
        $pdf->Ln();

        $tabla3 =
            '<table cellspacing="0" cellpadding="5" border="1">
                <thead>
                    <tr>
                        <th style="text-align: center;"><strong>Descripción de la actividad</strong></th>
                        <th style="text-align: center;"><strong>Cantidad</strong></th>
                        <th style="text-align: center;"><strong>Valor unitario</strong></th>
                        <th style="text-align: center;"><strong>Proveedor</strong></th>
                    </tr>
                </thead>
                <tbody>
                    '.$tr3.'
                </tbody>  
            </table>
        ';
        $pdf->SetFont('helvetica', '', '7');
        $pdf->writeHTML($tabla3);

        // $pdf->SetFont('helvetica', 'B', '7');
        // $pdf->Cell(0, 0, "Diagnostico", 0, 0, 'C', 0, '', 0);
        // $pdf->Ln();
        // $pdf->Ln();

        $tabla4 =
            '<table cellspacing="0" cellpadding="5" border="1">
            <thead>
                <tr>
                    <th class="text-center" style="text-align: center;"><strong>Diagnóstico</strong></th>
                    <th class="text-center" style="text-align: center;"><strong>Observaciones</strong></th>
                </tr>
            </thead>
                <tbody>
                    <tr>
                        <td style="text-align: center;">'.$orden['diagnostico'].'</td>
                        <td style="text-align: center;">'.$orden['observacion'].'</td>
                    </tr>  
                </tbody>  
            </table>
        ';
        $pdf->SetFont('helvetica', '', '7');
        $pdf->writeHTML($tabla4);
        
        $pdf->Output('OrdenServicio', 'I');
    }
}

if(isset($_REQUEST['tipo_mantenimiento'])){
    
    $mantenimiento = $_REQUEST['tipo_mantenimiento'];

    if($mantenimiento == 'orden'){

        mantenimientoPDF::ordenServicioPDF($OrdenServicios,$ServiciosExternos,$ManoObra,$Repuestos,$empresa);
        
    } else if($mantenimiento == 'solicitud'){

        mantenimientoPDF::solicitudPDF($OrdenServicios,$ServiciosExternos,$Repuestos,$empresa);

    }
}

