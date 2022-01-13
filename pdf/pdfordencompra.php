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
require '../models/almacen.modelo.php';
require '../models/conceptos.modelo.php';
$empresa = ModeloEmpresaRaiz::mdlVerEmpresa();
$ordencompra = ModeloProductos::mdlListarOrdenes($idorden);
$productos = ModeloProductos::mdlDatosProductoOrden($idorden);

//var_dump($productos);
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
        $this->Cell(0, 10, 'Tecnolab Soluciones Digitales - apps.tecnolab.com.co - Pagina ' . $this->getAliasNumPage() . '/' . $this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
}

class AlmacenPDF
{
    /* ===========================================
      GENERACION DE ARCHIVOS PDF DE LA ORDEN
    ============================================*/
    static public function ordenCompra($empresa, $orden, $productos)
    {
        /*====================================================
            LISTADO DE PRODUCTOS A INSERTAR EN UNA TABLA HTML 
        ====================================================*/
        $tr="";
        foreach ($productos as $key => $value) {
            $tr .= "
            <tr>
                <td style='text-align: center;'>".$value['descripcion']."</td>
                <td style='text-align: center;'>".$value['referencia']."</td>
                <td style='text-align: center;'>".$value['codigo']."</td>
                <td style='text-align: center;'>".$value['cantidad']."</td>
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
        $pdf->SetTitle('OrdenCompra');
        $pdf->SetSubject('OrdenCompra');
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
        $pdf->MultiCell(130, 5, 'ORDEN DE COMPRA', 0, 'C', 0, 1, $x, $y, true);
        $pdf->MultiCell(130, 5, $empresa['razon_social'], 0, 'C', 0, 1, $x, '', true);
        $pdf->SetFont('Times', '', '8');
        $pdf->Ln(3);
        //NIT
        $pdf->SetFont('Times', 'B', '8');
        $pdf->MultiCell(130, 5, "NIT", 0, 'C', 0, 1, $x, '', true);
        $pdf->SetFont('Times', 'I', '8');
        $pdf->MultiCell(130, 5, $empresa['nit'], 0, 'C', 0, 1, $x, '', true);
        $pdf->Ln(3);
        //NUMERO DE ORDEN
        $pdf->SetFont('Times', 'B', '8');
        $pdf->MultiCell(130, 5, "N° Orden", 0, 'C', 0, 1, $x, '', true);
        $pdf->SetFont('Times', 'I', '8');
        $pdf->MultiCell(130, 5, $orden['idorden'], 0, 'C', 0, 1, $x, '', true);
        $pdf->Ln(3);
        //DIRECCION
        $pdf->SetFont('Times', 'B', '8');
        $pdf->MultiCell(130, 5, "Dirección de entrega", 0, 'C', 0, 1, $x, '', true);
        $pdf->SetFont('Times', 'I', '8');
        $pdf->MultiCell(130, 5, $orden['direccion_entrega'], 0, 'C', 0, 1, $x, '', true);
        $pdf->Ln(3);

        $pdf->writeHTML("<hr>");

        //DATOS DE LA ORDEN
        $pdf->SetFont('helvetica', 'B', '8');
        $pdf->MultiCell(30, 5, "Tipo de compra:", 0, 'L', 0, 0, '', '', true);
        $pdf->SetFont('helvetica', '', '8');
        $pdf->MultiCell(80, 5, $orden['tipo_compra'], 0, 'L', 0, 0, '', '', true);

        $pdf->SetFont('helvetica', 'B', '8');
        $pdf->MultiCell(35, 5, "Fecha de elaboración:", 0, 'L', 0, 0, '', '', true);
        $pdf->SetFont('helvetica', '', '8');
        $pdf->MultiCell(45, 5, $orden['fecha_elaboracion'], 0, 'L', 0, 0, '', '', true);
        $pdf->Ln();

        $pdf->SetFont('helvetica', 'B', '8');
        $pdf->MultiCell(30, 5, "Forma de pago:", 0, 'L', 0, 0, '', '', true);
        $pdf->SetFont('helvetica', '', '8');
        $pdf->MultiCell(80, 5, $orden['forma_pago'], 0, 'L', 0, 0, '', '', true);

        $pdf->SetFont('helvetica', 'B', '8');
        $pdf->MultiCell(35, 5, "Observaciones:", 0, 'L', 0, 0, '', '', true);
        $pdf->SetFont('helvetica', '', '8');
        $pdf->MultiCell(45, 5, $orden['observaciones'], 0, 'L', 0, 0, '', '', true);
        $pdf->Ln();
        $pdf->Ln();
        $pdf->Ln();

        $pdf->writeHTML("<hr>");

        $pdf->SetFont('Times', 'B', '9');
        $pdf->MultiCell(30, 5, "Vendedor:", 0, 'L', 0, 0, '', '', true);
        $pdf->Ln();
        $pdf->Ln();

        $pdf->SetFont('helvetica', 'B', '8');
        $pdf->MultiCell(30, 5, "Razón social:", 0, 'L', 0, 0, '', '', true);
        $pdf->SetFont('helvetica', '', '8');
        $pdf->MultiCell(80, 5, $orden['razon_social'], 0, 'L', 0, 0, '', '', true);

        $pdf->SetFont('helvetica', 'B', '8');
        $pdf->MultiCell(35, 5, "Dirección:", 0, 'L', 0, 0, '', '', true);
        $pdf->SetFont('helvetica', '', '8');
        $pdf->MultiCell(45, 5, $orden['direccion'], 0, 'L', 0, 0, '', '', true);
        $pdf->Ln();

        $pdf->SetFont('helvetica', 'B', '8');
        $pdf->MultiCell(30, 5, "Contacto:", 0, 'L', 0, 0, '', '', true);
        $pdf->SetFont('helvetica', '', '8');
        $pdf->MultiCell(80, 5, $orden['nombre_contacto'], 0, 'L', 0, 0, '', '', true);

        $pdf->SetFont('helvetica', 'B', '8');
        $pdf->MultiCell(35, 5, "Documento:", 0, 'L', 0, 0, '', '', true);
        $pdf->SetFont('helvetica', '', '8');
        $pdf->MultiCell(45, 5, $orden['documento'], 0, 'L', 0, 0, '', '', true);
        $pdf->Ln();

        $pdf->SetFont('helvetica', 'B', '8');
        $pdf->MultiCell(30, 5, "Teléfono:", 0, 'L', 0, 0, '', '', true);
        $pdf->SetFont('helvetica', '', '8');
        $pdf->MultiCell(80, 5, $orden['telefono'], 0, 'L', 0, 0, '', '', true);

        $pdf->SetFont('helvetica', 'B', '8');
        $pdf->MultiCell(35, 5, "Ubicación:", 0, 'L', 0, 0, '', '', true);
        $pdf->SetFont('helvetica', '', '8');
        $pdf->MultiCell(45, 5, $orden['municipio'], 0, 'L', 0, 0, '', '', true);
        $pdf->Ln();
        $pdf->Ln();
        $pdf->Ln();

        $pdf->writeHTML("<hr>");

        $pdf->SetFont('Times', 'B', '9');
        $pdf->MultiCell(30, 5, "Productos:", 0, 'L', 0, 0, '', '', true);
        $pdf->Ln();
        $pdf->Ln();


        $tabla_productos =
            '<table cellspacing="0" cellpadding="5" border="1">
                <thead>
                    <tr>
                        <th style="text-align: center;"><strong>NOMBRE</strong></th>
                        <th style="text-align: center;"><strong>REFERENCIA</strong></th>
                        <th style="text-align: center;"><strong>CÓDIGO</strong></th>
                        <th style="text-align: center;"><strong>CANTIDAD</strong></th>
                    </tr>
                </thead>
                <tbody>
                    '.$tr.'
                </tbody>  
            </table>';

        $pdf->SetFont('Times', '', '8');
        $pdf->writeHTML($tabla_productos);
        // Close and output PDF document
        // This method has several options, check the source code documentation for more information.
        $pdf->Output('OrdenCompra-N'.$orden['idorden'], 'I');
        //============================================================+
        // END OF FILE
        //============================================================+
    }
}
AlmacenPDF::ordenCompra($empresa, $ordencompra, $productos);
