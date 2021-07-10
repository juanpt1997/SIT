<?php

# CONFIGURACION DE LA SESION
include '../config.php';

# Si no existe una sesion se redireciona directamente al inicio
if (!isset($_SESSION["iniciarSesion"])) {
    header("Location: " . URL_APP);
}

# SE VALIDA DE QUE EL ID SEA DE TIPO INT 
if (isset($_REQUEST['idPersonal']) && preg_match('/^[0-9]+$/', $_REQUEST['idPersonal'])) {
    $idPersonal = $_REQUEST['idPersonal'];
} else {
    header("Location: " . URL_APP);
}

#SE ESTABLECE EL HORARIO 
date_default_timezone_set('America/Bogota');

# SE REQUIERE EL AUTOLOAD
require '../vendor/autoload.php';

# REQUERIMOS EL CONTROLADOR Y EL MODELO PARA HACER USO DE LA INFORMACIÓN
require '../controllers/gh.controlador.php';
require '../models/gh.modelo.php';


$resultado = ControladorGH::ctrDatosEmpleado("idPersonal", $idPersonal);

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
        $this->Image($img_file, 0, 0, 210, 297, '', '', '', false, 300, '', false, false, 0);
        // restore auto-page-break status
        $this->SetAutoPageBreak($auto_page_break, $bMargin);
        // set the starting point for the page content
        $this->setPageMark();

        $this->SetFont('helvetica', 'B', '14');
        $this->Ln();
        $this->Cell(0, 0, "", 0, 0, 'C', 0, '', 0);
        $this->Ln();
        $this->Cell(0, 0, "FICHA TÉCNICA CONDUCTOR", 0, 0, 'C', 0, '', 0);
        $this->Ln();

        $this->SetFont('helvetica', 'B', '9');
        $this->Cell(0, 0, "", 0, 0, 'C', 0, '', 0);
        $this->Ln();

        /* $this->SetFont('helvetica', 'B', '9');
        $this->Cell(0, 0, "PHONE: (561) 998-0904 FACSIMILE: (561) 998-1878", 0, 0, 'C', 0, '', 0);
        $this->Ln(); */

        $this->writeHTML("<hr>");
        $this->Ln();
    }

    // Page footer
    public function Footer()
    {
        // Position at 15 mm from bottom
        $this->SetY(-10);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'Page ' . $this->getAliasNumPage() . '/' . $this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
}


class PdfConductor
{

    /* ===================== 
      GENERACION DE ARCHIVOS PDF DE LA PETICION DE OFERTA 
    ========================= */
    static public function makePDF($info)
    {

        /* ===================== 
            UTILIZANDO LA VERSION DE TCPDF PARA GENERAR EL ARCHIVO 
        ========================= */
        # orientacion => p || unidade medida => cm
        $pdf = new MYPDF(PDF_PAGE_ORIENTATION, 'mm', PDF_PAGE_FORMAT, true, 'UTF-8', false);


        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor($_SESSION['nombre']);
        $pdf->SetTitle($info['Nombre']);
        $pdf->SetSubject('Ficha Técnica Conductor');
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

        /* ===================================================
           FOTO CONDUCTOR
        ===================================================*/
        $image_conductor =  '../' . $info['foto'];
        $pdf->Image($image_conductor, 150, 30, 40, 40,  '', '', 'T', false, 300, '', false, false, 0, false, false, false);

        /* ===================================================
           DATOS GENERALES
        ===================================================*/
        # Nombre
        $pdf->writeHTML("<br>");
        $pdf->writeHTML("<br>");
        $pdf->SetFont('helvetica', 'B', '10');
        $pdf->MultiCell(20, 5, "Nombre:", 0, 'L', 0, 0, '', '', true);
        $pdf->SetFont('helvetica', '', '10');
        $pdf->MultiCell(110, 5, $info['Nombre'], $complex_cell_border, 'L', 0, 0, '', '', true);
        $pdf->Ln();
        $pdf->Ln();

        # Cédula
        $pdf->SetFont('helvetica', 'B', '10');
        $pdf->MultiCell(15, 5, "Cédula: ", 0, 'L', 0, 0, '', '', true);
        $pdf->SetFont('helvetica', '', '10');
        $pdf->MultiCell(25, 5, $info['Documento'], $complex_cell_border, 'L', 0, 0, '', '', true);

        # Nomenclatura
        $pdf->SetFont('helvetica', 'B', '10');
        $pdf->MultiCell(30, 5, " Nomenclatura:", 0, 'L', 0, 0, '', '', true);
        $pdf->SetFont('helvetica', '', '10');
        $pdf->MultiCell(60, 5, $info['direccion'], $complex_cell_border, 'L', 0, 0, '', '', true);
        $pdf->Ln();
        $pdf->Ln();

        # Ciudad
        $pdf->SetFont('helvetica', 'B', '10');
        $pdf->MultiCell(17, 5, "Ciudad:", 0, 'L', 0, 0, '', '', true);
        $pdf->SetFont('helvetica', '', '10');
        $pdf->MultiCell(45, 5, $info['Ciudad'], $complex_cell_border, 'L', 0, 0, '', '', true);

        # Barrio
        $pdf->SetFont('helvetica', 'B', '10');
        $pdf->MultiCell(15, 5, " Barrio:", 0, 'L', 0, 0, '', '', true);
        $pdf->SetFont('helvetica', '', '10');
        $pdf->MultiCell(53, 5, $info['barrio'], $complex_cell_border, 'L', 0, 0, '', '', true);
        $pdf->Ln();
        $pdf->Ln();

        # Tipo de sangre
        $pdf->SetFont('helvetica', 'B', '10');
        $pdf->MultiCell(30, 5, "Tipo de sangre:", 0, 'L', 0, 0, '', '', true);
        $pdf->SetFont('helvetica', '', '10');
        $pdf->MultiCell(10, 5, $info['tipo_sangre'], $complex_cell_border, 'L', 0, 0, '', '', true);

        # Nivel Educación
        $pdf->SetFont('helvetica', 'B', '10');
        $pdf->MultiCell(32, 5, " Nivel Educación:", 0, 'L', 0, 0, '', '', true);
        $pdf->SetFont('helvetica', '', '10');
        $pdf->MultiCell(58, 5, $info['nivel_escolaridad'], $complex_cell_border, 'L', 0, 0, '', '', true);
        $pdf->Ln();
        $pdf->Ln();

        # Años de experiencia
        $pdf->SetFont('helvetica', 'B', '10');
        $pdf->MultiCell(38, 5, "Años de experiencia:", 0, 'L', 0, 0, '', '', true);
        $pdf->SetFont('helvetica', '', '10');
        $pdf->MultiCell(10, 5, $info['anios_experiencia'], $complex_cell_border, 'L', 0, 0, '', '', true);

        # Fecha Consulta DAS
        $pdf->SetFont('helvetica', 'B', '10');
        $pdf->MultiCell(39, 5, " Fecha Consulta DAS:", 0, 'L', 0, 0, '', '', true);
        $pdf->SetFont('helvetica', '', '10');
        $pdf->MultiCell(22, 5, "", $complex_cell_border, 'L', 0, 0, '', '', true);

        # Fecha Antecedentes
        $pdf->SetFont('helvetica', 'B', '10');
        $pdf->MultiCell(39, 5, " Fecha Antecedentes:", 0, 'L', 0, 0, '', '', true);
        $pdf->SetFont('helvetica', '', '10');
        $pdf->MultiCell(22, 5, "", $complex_cell_border, 'L', 0, 0, '', '', true);
        $pdf->Ln();
        $pdf->Ln();

        # Licencia de conducción No
        $pdf->SetFont('helvetica', 'B', '10');
        $pdf->MultiCell(50, 5, "Licencia de conducción No:", 0, 'L', 0, 0, '', '', true);
        $pdf->SetFont('helvetica', '', '10');
        $pdf->MultiCell(25, 5, $info['nro_licencia'], $complex_cell_border, 'L', 0, 0, '', '', true);

        # Categoría
        $pdf->SetFont('helvetica', 'B', '10');
        $pdf->MultiCell(25, 5, " Categoría:", 0, 'L', 0, 0, '', '', true);
        $pdf->SetFont('helvetica', '', '10');
        $pdf->MultiCell(18, 5, $info['categoria'], $complex_cell_border, 'L', 0, 0, '', '', true);

        # Vencimiento
        $pdf->SetFont('helvetica', 'B', '10');
        $pdf->MultiCell(30, 5, " Vencimiento:", 0, 'L', 0, 0, '', '', true);
        $pdf->SetFont('helvetica', '', '10');
        $pdf->MultiCell(22, 5, $info['fecha_vencimiento'], $complex_cell_border, 'L', 0, 0, '', '', true);
        $pdf->Ln();
        $pdf->Ln();

        /* ===================================================
            PAGINA DOCUMENTACION
        ===================================================*/
        if ($info['ruta_documento'] != null) {
            $pdf->AddPage();
            $pdf->Ln();

            $x = $pdf->GetX();
            $y = $pdf->GetY();
            $licencia =  '../' . $info['ruta_documento'];
            //$pdf->Image($licencia, $x, $y, 0, 0, '', '', 'T', true, 300, '', false, false, 0, false, false, false);
            $horizontal_alignments = array('L', 'C', 'R');
            $vertical_alignments = array('T', 'M', 'B');
            $fitbox = $horizontal_alignments[1].' ';
            $fitbox[1] = $vertical_alignments[0];
            $pdf->Image($licencia, $x, $y, 0, 0, '', '', '', true, 300, '', false, false, 0, 'C', false, false);
            //$pdf->Rect($x, $y, 200, 200, 'F', array(), array(128,255,128));
            //$pdf->Image($licencia, $x, $y, 0, 0, '', '', '', true, 300, '', false, false, 0, $fitbox, false, false);













            //$pdf->Image();
        }





        // ---------------------------------------------------------

        // Close and output PDF document
        // This method has several options, check the source code documentation for more information.
        $pdf->Output('Empleado', 'I');

        //============================================================+
        // END OF FILE
        //============================================================+
    }
}

# SE INSTANCIA LA CLASE PARA LA GENERACION DEL ARCHIVO PDF
PdfConductor::makePDF($resultado);
