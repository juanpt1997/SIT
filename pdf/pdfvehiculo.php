<?php

# CONFIGURACION DE LA SESION
include '../config.php';

# Si no existe una sesion se redireciona directamente al inicio
if (!isset($_SESSION["iniciarSesion"])) {
    header("Location: " . URL_APP);
}

# SE VALIDA DE QUE EL ID SEA DE TIPO INT 
if (isset($_REQUEST['idvehiculo']) && preg_match('/^[0-9]+$/', $_REQUEST['idvehiculo'])) {
    $idvehiculo = $_REQUEST['idvehiculo'];
} else {
    header("Location: " . URL_APP);
}

#SE ESTABLECE EL HORARIO 
date_default_timezone_set('America/Bogota');

# SE REQUIERE EL AUTOLOAD
require '../vendor/autoload.php';

# REQUERIMOS EL CONTROLADOR Y EL MODELO PARA HACER USO DE LA INFORMACIÓN
require '../controllers/vehicular.controlador.php';
require '../models/vehicular.modelo.php';


$resultado = ControladorVehiculos::ctrDatosVehiculo("idvehiculo", $idvehiculo);

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
        // set background image
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
        $this->Cell(0, 0, "FICHA TÉCNICA VEHÍCULO", 0, 0, 'C', 0, '', 0);
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


class PdfVehiculo
{

    /* ===================== 
      GENERACION DE ARCHIVOS PDF DE LA PETICION DE OFERTA 
    ========================= */
    static public function makePDF($info)
    {
        $Propietarios = ControladorVehiculos::ctrPropietariosxVehiculo($info['idvehiculo']);
        $Documentos = ControladorVehiculos::ctrDocumentosxVehiculo($info['idvehiculo']);
        $Fotos = ControladorVehiculos::ctrFotosVehiculo("idvehiculo", $info['idvehiculo']);

        /* ===================== 
            UTILIZANDO LA VERSION DE TCPDF PARA GENERAR EL ARCHIVO 
        ========================= */
        # orientacion => p || unidade medida => cm
        $pdf = new MYPDF(PDF_PAGE_ORIENTATION, 'mm', PDF_PAGE_FORMAT, true, 'UTF-8', false);


        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor($_SESSION['nombre']);
        $pdf->SetTitle($info['placa']);
        $pdf->SetSubject('Ficha Técnica Vehículo');
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
           FOTO VEHICULO
        ===================================================*/
        if (count($Fotos) > 0) {
            $foto = $Fotos[0]['ruta_foto'];
        } else {
            $foto = "";
        }
        $image_vehiculo =  '../' . $foto;
        $marco =  '../views/img/plantilla/marco.png';
        $pdf->Image($marco, 120, 29, 82, 57,  '', '', 'T', false, 300, '', false, false, 0, false, false, false);
        if ($foto != null && $foto != "") {
            $pdf->Image($image_vehiculo, 121, 30, 80, 55,  '', '', 'T', false, 300, '', false, false, 0, false, false, false);
        }

        /* ===================================================
           DATOS GENERALES
        ===================================================*/
        # Placa
        $pdf->writeHTML("<br>");
        $pdf->SetFont('helvetica', 'B', '10');
        $pdf->MultiCell(18, 5, "Placa:", 0, 'L', 0, 0, '', '', true);
        $pdf->SetFont('helvetica', '', '10');
        $pdf->MultiCell(82, 5, $info['placa'], $complex_cell_border, 'L', 0, 0, '', '', true);
        $pdf->Ln();
        $pdf->Ln();

        # Propietario
        if (count($Propietarios) > 0) {
            $nompropietario = $Propietarios[0]['propietario'];
        } else {
            $nompropietario = "";
        }
        $pdf->SetFont('helvetica', 'B', '10');
        $pdf->MultiCell(22, 5, "Propietario:", 0, 'L', 0, 0, '', '', true);
        $pdf->SetFont('helvetica', '', '10');
        $pdf->MultiCell(78, 5, $nompropietario, $complex_cell_border, 'L', 0, 0, '', '', true);
        $pdf->Ln();
        $pdf->Ln();

        # No Interno
        $pdf->SetFont('helvetica', 'B', '10');
        $pdf->MultiCell(22, 5, "No Interno:", 0, 'L', 0, 0, '', '', true);
        $pdf->SetFont('helvetica', '', '10');
        $pdf->MultiCell(31, 5, $info['numinterno'], $complex_cell_border, 'L', 0, 0, '', '', true);

        # Clase
        $pdf->SetFont('helvetica', 'B', '10');
        $pdf->MultiCell(16, 5, "Clase:", 0, 'L', 0, 0, '', '', true);
        $pdf->SetFont('helvetica', '', '10');
        $pdf->MultiCell(31, 5, $info['tipovehiculo'], $complex_cell_border, 'L', 0, 0, '', '', true);
        $pdf->Ln();
        $pdf->Ln();

        # Color
        $pdf->SetFont('helvetica', 'B', '10');
        $pdf->MultiCell(18, 5, "Color:", 0, 'L', 0, 0, '', '', true);
        $pdf->SetFont('helvetica', '', '10');
        $pdf->MultiCell(82, 5, $info['color'], $complex_cell_border, 'L', 0, 0, '', '', true);
        $pdf->Ln();
        $pdf->Ln();

        # Chasis
        $pdf->SetFont('helvetica', 'B', '10');
        $pdf->MultiCell(16, 5, "Chasis:", 0, 'L', 0, 0, '', '', true);
        $pdf->SetFont('helvetica', '', '10');
        $pdf->MultiCell(42, 5, $info['chasis'], $complex_cell_border, 'L', 0, 0, '', '', true);

        # Modelo
        $pdf->SetFont('helvetica', 'B', '10');
        $pdf->MultiCell(17, 5, " Modelo:", 0, 'L', 0, 0, '', '', true);
        $pdf->SetFont('helvetica', '', '10');
        $pdf->MultiCell(25, 5, $info['modelo'], $complex_cell_border, 'L', 0, 0, '', '', true);
        $pdf->Ln();
        $pdf->Ln();

        # Nro Motor
        $pdf->SetFont('helvetica', 'B', '10');
        $pdf->MultiCell(25, 5, "Nro Motor:", 0, 'L', 0, 0, '', '', true);
        $pdf->SetFont('helvetica', '', '10');
        $pdf->MultiCell(75, 5, $info['numeromotor'], $complex_cell_border, 'L', 0, 0, '', '', true);
        $pdf->Ln();
        $pdf->Ln();

        # Cap. Pasaj
        $pdf->SetFont('helvetica', 'B', '10');
        $pdf->MultiCell(22, 5, "Cap. Pasaj:", 0, 'L', 0, 0, '', '', true);
        $pdf->SetFont('helvetica', '', '10');
        $pdf->MultiCell(22, 5, $info['capacidad'], $complex_cell_border, 'L', 0, 0, '', '', true);

        # Marca
        $pdf->SetFont('helvetica', 'B', '10');
        $pdf->MultiCell(16, 5, "Marca:", 0, 'L', 0, 0, '', '', true);
        $pdf->SetFont('helvetica', '', '10');
        $pdf->MultiCell(40, 5, $info['marca'], $complex_cell_border, 'L', 0, 0, '', '', true);
        $pdf->Ln();
        $pdf->Ln();
        $pdf->Ln();
        $pdf->Ln();
        $pdf->Ln();
        $pdf->Ln();

        /* ===================================================
           VENCIMIENTO DE DOCUMENTOS
        ===================================================*/
        //var_dump($Documentos);
        foreach ($Documentos as $key => $documento) {
            switch ($documento['tipodocumento']) {
                case 'SOAT':
                    $SOAT = $documento;
                    break;

                case 'Revision tecnico-mecanica':
                    $CDA = $documento;
                    break;

                case 'Tarjeta de Operacion':
                    $TarjetaOperacion = $documento;
                    break;

                case 'Revision preventiva':
                    $RevisionPreventiva = $documento;
                    break;

                case 'Poliza RC - RCE':
                    $RCC = $documento;
                    $RCE = $documento;
                    break;

                case 'Extintor':
                    $Extintor = $documento;
                    break;

                default:

                    break;
            }
        }

        $pdf->SetFont('helvetica', 'B', '12');
        $pdf->Cell(0, 0, "VENCIMIENTO DE DOCUMENTOS", 0, 0, 'C', 0, '', 0);
        $pdf->Ln();
        $pdf->Ln();

        # Tarjeta de operación
        $pdf->SetFont('helvetica', 'B', '10');
        $pdf->MultiCell(40, 5, "Tarjeta de Operación:", 0, 'L', 0, 0, '', '', true);
        $pdf->SetFont('helvetica', '', '10');
        $fechavencimiento = isset($TarjetaOperacion) ? $TarjetaOperacion['Ffechafin'] : "";
        $pdf->MultiCell(55, 5, $fechavencimiento, $complex_cell_border, 'L', 0, 0, '', '', true);

        # Póliza RCC
        $pdf->SetFont('helvetica', 'B', '10');
        $pdf->MultiCell(24, 5, " Póliza RCC:", 0, 'L', 0, 0, '', '', true);
        $pdf->SetFont('helvetica', '', '10');
        $fechavencimiento = isset($RCC) ? $RCC['Ffechafin'] : "";
        $pdf->MultiCell(61, 5, $fechavencimiento, $complex_cell_border, 'L', 0, 0, '', '', true);
        $pdf->Ln();
        $pdf->Ln();

        # SOAT
        $pdf->SetFont('helvetica', 'B', '10');
        $pdf->MultiCell(20, 5, "SOAT:", 0, 'L', 0, 0, '', '', true);
        $pdf->SetFont('helvetica', '', '10');
        $fechavencimiento = isset($SOAT) ? $SOAT['Ffechafin'] : "";
        $pdf->MultiCell(68, 5, $fechavencimiento, $complex_cell_border, 'L', 0, 0, '', '', true);

        # Póliza RCE
        $pdf->SetFont('helvetica', 'B', '10');
        $pdf->MultiCell(24, 5, " Póliza RCE:", 0, 'L', 0, 0, '', '', true);
        $pdf->SetFont('helvetica', '', '10');
        $fechavencimiento = isset($RCE) ? $RCE['Ffechafin'] : "";
        $pdf->MultiCell(68, 5, $fechavencimiento, $complex_cell_border, 'L', 0, 0, '', '', true);
        $pdf->Ln();
        $pdf->Ln();

        # Revisión Bimestral
        $pdf->SetFont('helvetica', 'B', '10');
        $pdf->MultiCell(35, 5, "Revisión Bimestral:", 0, 'L', 0, 0, '', '', true);
        $pdf->SetFont('helvetica', '', '10');
        $fechavencimiento = isset($RevisionPreventiva) ? $RevisionPreventiva['Ffechafin'] : "";
        $pdf->MultiCell(66, 5, $fechavencimiento, $complex_cell_border, 'L', 0, 0, '', '', true);

        # CDA
        $pdf->SetFont('helvetica', 'B', '10');
        $pdf->MultiCell(12, 5, " CDA:", 0, 'L', 0, 0, '', '', true);
        $pdf->SetFont('helvetica', '', '10');
        $fechavencimiento = isset($CDA) ? $CDA['Ffechafin'] : "";
        $pdf->MultiCell(67, 5, $fechavencimiento, $complex_cell_border, 'L', 0, 0, '', '', true);
        $pdf->Ln();
        $pdf->Ln();

        # Extintor
        $pdf->SetFont('helvetica', 'B', '10');
        $pdf->MultiCell(20, 5, "Extintor:", 0, 'L', 0, 0, '', '', true);
        $pdf->SetFont('helvetica', '', '10');
        $fechavencimiento = isset($Extintor) ? $Extintor['Ffechafin'] : "";
        $pdf->MultiCell(70, 5, $fechavencimiento, $complex_cell_border, 'L', 0, 0, '', '', true);
        $pdf->Ln();
        $pdf->Ln();

        /* ===================================================
           DOCUMENTOS
        ===================================================*/
        //echo $pdf->getPageWidth();
        foreach ($Documentos as $key => $documento) {
            // Si no es pdf, se muestra la imagen el documento
            if (strpos($documento['ruta_documento'], '.pdf') === false) {
                $pdf->AddPage();
                $pdf->Ln();
                $ruta = '../' . $documento['ruta_documento'];
                $img = file_get_contents($ruta);
                $pdf->Image('@' . $img, 0, '');
                list($width, $height) = getimagesize($ruta);
                //$pdf->Image($ruta, 0, '', $width, $height, '', '', '', false, 300, '', false, false, 0, false, false, false);

                //echo $height;
                
                
                
                
                
                
                
                
                
                
                //$toolcopy = '<img src="' . $ruta . '"  width="700" height="800">';

                //$pdf->writeHTML($toolcopy, true, 0, true, 0);

                //echo $pdf->getPageWidth();
            }
        }

        // ---------------------------------------------------------

        // Close and output PDF document
        // This method has several options, check the source code documentation for more information.
        $pdf->Output('Vehículo', 'I');

        //============================================================+
        // END OF FILE
        //============================================================+
    }
}

# SE INSTANCIA LA CLASE PARA LA GENERACION DEL ARCHIVO PDF
PdfVehiculo::makePDF($resultado);