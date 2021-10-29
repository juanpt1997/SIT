<?php

# CONFIGURACION DE LA SESION
include '../config/config.php';

# Si no existe una sesion se redireciona directamente al inicio
if (!isset($_SESSION["iniciarSesion"])) {
  header("Location: " . URL_APP);
}

# SE VALIDA DE QUE EL ID SEA DE TIPO INT 
if (isset($_REQUEST['id_inventario']) && preg_match('/^[0-9]+$/', $_REQUEST['id_inventario'])) {
  $id_inventario = $_REQUEST['id_inventario'];
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
require '../models/vehicular.modelo.php';



$resultado = ModeloInventario::mdlListarInventario($id_inventario);
$empresa = ModeloConceptosGH::mdlVerEmpresa();
/* ===================== 
  SI LA INFORMACIÓN VIENE FALSA SE REDIRECCIONA
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


class InventarioPDF
{

  /* ===================== 
      GENERACION DE ARCHIVOS PDF DE LA PETICION DE OFERTA 
    ========================= */
  static public function makePDF($info, $empresa)
  {
    if ($info['usb_cd'] == 0) {

      $usb_cd = "CD";
    } else {

      $usb_cd = "USB";
    }
    if ($info['escolar_delantero_trasero'] == 0) {

      $escolar_ = "Trasero";
    } else {

      $escolar_ = "Delantero";
    }
    if ($info['interno_externo_comoConduzco'] == 0) {

      $avconduzco = "Externo";
    } else {

      $avconduzco = "Interno";
    }

    $equiposonido = $usb_cd . ' - ' . ControladorInventario::TraducirEstadoInventario($info['Equipo_Sonido']);
    $parlantes = ' # ' . $info['num_parlantes'] . ' - ' . ControladorInventario::TraducirEstadoInventario($info['Parlantes']);
    $escolar = ControladorInventario::TraducirEstadoInventario($info['escolar']) . ' - ' . $escolar_;
    $luces = ' # ' . $info['numero_luces_internas'] . ' - ' . ControladorInventario::TraducirEstadoInventario($info['Luces_internas']);
    $salidas = ' # ' . $info['Nsalidas_martillos'] . ' - ' . ControladorInventario::TraducirEstadoInventario($info['Salidas_emergencia_martillos']);
    $conduzco = $avconduzco . ' - ' . ControladorInventario::TraducirEstadoInventario($info['Av_Como_conduzco']);
    $placa = $info['placa'];
    $documentos = ControladorVehiculos::ctrDocumentosxVehiculoSinRepetir($info['idvehiculo']);
    $fechamatricula = $info['fechamatricula'] == null ? "" : date("d/m/Y",strtotime($info['fechamatricula']));

    foreach ($documentos as $key => $value) {
      if ($value['tipodocumento'] == 'Tarjeta de Operacion') {

        $fechaTO = $value['Ffechafin'];
      } else if ($value['tipodocumento'] == 'Revision preventiva') {

        $fechaRP = $value['Ffechafin'];
      } else if ($value['tipodocumento'] == 'Revision tecnico-mecanica') {

        $fechaRM = $value['Ffechafin'];
      } else if ($value['tipodocumento'] == 'Extintor') {

        $fechaE = $value['Ffechafin'];
      } else if ($value['tipodocumento'] == 'SOAT') {

        $fechaS = $value['Ffechafin'];
      } else if ($value['tipodocumento'] == 'Poliza RC - RCE') {

        $fechaP = $value['Ffechafin'];
      }
    }

    $fechaTO = isset($fechaTO) ? $fechaTO : "";
    $fechaRM = isset($fechaRM) ? $fechaRM : "";
    $fechaE = isset($fechaE) ? $fechaE : "";
    $fechaS = isset($fechaS) ? $fechaS : "";
    $fechaP = isset($fechaP) ? $fechaP : "";
    /* ===================== 
            UTILIZANDO LA VERSION DE TCPDF PARA GENERAR EL ARCHIVO 
        ========================= */
    # orientacion => p || unidade medida => cm
    $pdf = new MYPDF(PDF_PAGE_ORIENTATION, 'mm', PDF_PAGE_FORMAT, true, 'UTF-8', false);
    // set document information
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor(PROYECTO);
    $pdf->SetTitle('Inventario');
    $pdf->SetSubject('Inventario');
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
           TITULO INVENTARIO
    ===================================================*/
    $pdf->SetFont('helvetica', 'B', '8');
    //Ancho de texto y de pagina
    $anchoTexto = 130;
    $anchoPaginaMM = $pdf->getPageWidth();
    //Coordenadas
    $x = ($anchoPaginaMM / 2) - ($anchoTexto / 2);
    $y = $pdf->GetY() + 15;
    //Titulo principal
    $pdf->MultiCell(130, 5, 'INVENTARIO VEHICULAR', 0, 'C', 0, 1, $x, $y, true);
    $pdf->MultiCell(130, 5, $empresa['razon_social'], 0, 'C', 0, 1, $x, '', true);
    $pdf->SetFont('helvetica', '', '8');
    $pdf->Ln(4);
    //NIT
    $pdf->SetFont('helvetica', 'B', '8');
    $pdf->MultiCell(130, 5, "NIT:", 0, 'C', 0, 1, $x, '', true);
    $pdf->SetFont('helvetica', 'I', '8');
    $pdf->MultiCell(130, 5, $empresa['nit'], 0, 'C', 0, 1, $x, '', true);
    $pdf->Ln(4);

    //DATOS DEL VEHICULO
    #Placa
    $pdf->SetFont('helvetica', 'B', '8');
    $pdf->MultiCell(30, 5, "Placa:", 0, 'L', 0, 0, '', '', true);
    $pdf->SetFont('helvetica', '', '8');
    $pdf->MultiCell(100, 5, $info['placa'], 0, 'L', 0, 0, '', '', true);
    # Marca
    $pdf->SetFont('helvetica', 'B', '8');
    $pdf->MultiCell(20, 5, "Marca:", 0, 'L', 0, 0, '', '', true);
    $pdf->SetFont('helvetica', '', '8');
    $pdf->MultiCell(40, 5, $info['marca'], 0, 'L', 0, 0, '', '', true);
    $pdf->Ln();

    #Numero interno
    $pdf->SetFont('helvetica', 'B', '8');
    $pdf->MultiCell(30, 5, "Número interno:", 0, 'L', 0, 0, '', '', true);
    $pdf->SetFont('helvetica', '', '8');
    $pdf->MultiCell(100, 5, $info['numinterno'], 0, 'L', 0, 0, '', '', true);
    # Modelo
    $pdf->SetFont('helvetica', 'B', '8');
    $pdf->MultiCell(20, 5, "Modelo:", 0, 'L', 0, 0, '', '', true);
    $pdf->SetFont('helvetica', '', '8');
    $pdf->MultiCell(40, 5, $info['modelo'], 0, 'L', 0, 0, '', '', true);
    $pdf->Ln();

    #clase de vehiculo
    $pdf->SetFont('helvetica', 'B', '8');
    $pdf->MultiCell(30, 5, "Clase de vehículo:", 0, 'L', 0, 0, '', '', true);
    $pdf->SetFont('helvetica', '', '8');
    $pdf->MultiCell(100, 5, $info['tipovehiculo'], 0, 'L', 0, 0, '', '', true);
    # kilometraje
    $pdf->SetFont('helvetica', 'B', '8');
    $pdf->MultiCell(20, 5, "Kilometraje:", 0, 'L', 0, 0, '', '', true);
    $pdf->SetFont('helvetica', '', '8');
    $pdf->MultiCell(40, 5, $info['kilometraje'], 0, 'L', 0, 0, '', '', true);
    $pdf->Ln();

    #Fecha inventario
    $pdf->SetFont('helvetica', 'B', '8');
    $pdf->MultiCell(30, 5, "Fecha:", 0, 'L', 0, 0, '', '', true);
    $pdf->SetFont('helvetica', '', '8');
    $pdf->MultiCell(120, 5, $info['fecha_inventario'], 0, 'L', 0, 0, '', '', true);
    $pdf->Ln(4);
    $pdf->Ln(4);
    /* ===================================================
           DOCUMENTOS
    ===================================================*/
    // $documentos = '';
    // $pdf->SetFont('helvetica', '', '8');
    // $pdf->writeHTML($documentos);


    /* ===================================================
           INVENTARIO PRINCIPAL
    ===================================================*/
    //TABLA
    $tabla =
    '<table cellspacing="0" cellpadding="5" border="1">
      <tbody>

        <tr>
        <td colspan="6" style="text-align: center;"><strong>LÁMINAS</strong></td>
        <td colspan="5" class="text-center" style="text-align: center;"><strong>Estado / Condición</strong></td>
        <td colspan="6" style="text-align: center;"><strong>DOCUMENTOS VEHICULO</strong></td>
        <td colspan="4" style="text-align: center;"><strong>Fecha de vencimiento</strong></td>
        </tr>

        <tr>
        <td colspan="6">Techo Exterior</td>
        <td colspan="5" style="text-align: center;">' . ControladorInventario::TraducirEstadoInventario($info['Techo_exterior']) . '</td>
        <td colspan="6">Tarjeta de propiedad</td>
        <td colspan="4" style="text-align: center;">'. $fechamatricula .'</td>
        </tr>

        <tr>
        <td colspan="6">Techo interior</td>
        <td colspan="5" style="text-align: center;">' . ControladorInventario::TraducirEstadoInventario($info['Techo_interior']) . '</td>
        <td colspan="6">Tarjeta de operación</td>
        <td colspan="4" style="text-align: center;">'. $fechaTO .'</td>
        </tr>

        <tr>
        <td colspan="6">Frente</td>
        <td colspan="5" style="text-align: center;">' . ControladorInventario::TraducirEstadoInventario($info['Frente']) . '</td>
        <td colspan="6">Seguro Obligatorio (SOAT)</td>
        <td colspan="4" style="text-align: center;">'. $fechaS .'</td>
        </tr>

        <tr>
        <td colspan="6">Bomper delantero</td>
        <td colspan="5" style="text-align: center;">' . ControladorInventario::TraducirEstadoInventario($info['Bomper_delantero']) . '</td>
        <td colspan="6">Revisión técnico mecánica</td>
        <td colspan="4" style="text-align: center;">'. $fechaRM .'</td>
        </tr>

        <tr>
        <td colspan="6">Bomper trasero</td>
        <td colspan="5" style="text-align: center;">' . ControladorInventario::TraducirEstadoInventario($info['Bomper_trasero']) . '</td>
        <td colspan="6">Póliza contractual</td>
        <td colspan="4" style="text-align: center;">'. $fechaP .'</td>
        </tr>

        <tr>
        <td colspan="6">Lateral derecho</td>
        <td colspan="5" style="text-align: center;">' . ControladorInventario::TraducirEstadoInventario($info['Lateral_derecho']) . '</td>
        <td colspan="6">Póliza extracontractual</td>
        <td colspan="4" style="text-align: center;">'. $fechaP .'</td>
        </tr>

        <tr>
        <td colspan="6">Lateral izquierdo</td>
        <td colspan="5" style="text-align: center;">' . ControladorInventario::TraducirEstadoInventario($info['Lateral_izquierdo']) . '</td>
        <td colspan="6" style="text-align: center;"><strong>EXTINTOR</strong></td>
        <td colspan="4" style="text-align: center;"></td>
        </tr>

        <tr>
        <td colspan="6">Puerta derecha</td>
        <td colspan="5" style="text-align: center;">' . ControladorInventario::TraducirEstadoInventario($info['puerta_derecha']) . '</td>
        <td colspan="6">Extintor Tipo: ABC</td>
        <td colspan="4" style="text-align: center;">'. $fechaE .'</td>
        </tr>

        <tr>
        <td colspan="6">Puerta izquierda</td>
        <td colspan="5" style="text-align: center;">' . ControladorInventario::TraducirEstadoInventario($info['Puerta_izquierda']) . '</td>
        <td colspan="6" style="text-align: center;"><strong>ACCESORIOS</strong></td>
        <td colspan="4" style="text-align: center;"><strong>Estado / Condición</strong></td>
        </tr>

        <tr>
        <td colspan="6" style="text-align: center;"><strong>VIDRIOS Y ESPEJOS</strong></td>
        <td colspan="5" style="text-align: center;"><strong>Estado / Condición</strong></td>
        <td colspan="6">Radioteléfono</td>
        <td colspan="4" style="text-align: center;">' . ControladorInventario::TraducirEstadoInventario($info['Radiotelefono']) . '</td>
        </tr>

        <tr>
        <td colspan="6">Parabrisas izquierdo</td>
        <td colspan="5" style="text-align: center;">' . ControladorInventario::TraducirEstadoInventario($info['Parabrisas_izquierdo']) . '</td>
        <td colspan="6">Antena</td>
        <td colspan="4" style="text-align: center;">' . ControladorInventario::TraducirEstadoInventario($info['Antena']) . '</td>
        </tr>

        <tr>
        <td colspan="6">Parabrisas derecho</td>
        <td colspan="5" style="text-align: center;">' . ControladorInventario::TraducirEstadoInventario($info['Parabrisas_derecho']) . '</td>
        <td colspan="6">Equipo de sonido</td>
        <td colspan="4" style="text-align: center;">' . $equiposonido . '</td>
        </tr>

        <tr>
        <td colspan="6">Espejo retrovisor derecho</td>
        <td colspan="5" style="text-align: center;">' . ControladorInventario::TraducirEstadoInventario($info['Espejo_retrovisor_derecho']) . '</td>
        <td colspan="6">Parlantes</td>
        <td colspan="4" style="text-align: center;">' . $parlantes . '</td>
        </tr>

        <tr>
        <td colspan="6">Espejo retrovisor izquierdo</td>
        <td colspan="5" style="text-align: center;">' . ControladorInventario::TraducirEstadoInventario($info['Espejo_retrovisor_izquierdo']) . '</td>
        <td colspan="6">Manguera de agua</td>
        <td colspan="4" style="text-align: center;">' . ControladorInventario::TraducirEstadoInventario($info['Manguera_agua']) . '</td>
        </tr>

        <tr>
        <td colspan="6">Vidrios ventanas lateral derecha</td>
        <td colspan="5" style="text-align: center;">' . ControladorInventario::TraducirEstadoInventario($info['Vidrios_ventanas_lateral_derecho']) . '</td>
        <td colspan="6">Manguera de aire</td>
        <td colspan="4" style="text-align: center;">' . ControladorInventario::TraducirEstadoInventario($info['Manguera_aire']) . '</td>
        </tr>

        <tr>
        <td colspan="6">Vidrios ventanas lateral izquierda</td>
        <td colspan="5" style="text-align: center;">' . ControladorInventario::TraducirEstadoInventario($info['Vidrios_ventanas_lateral_izquierdo']) . '</td>
        <td colspan="6">Pantalla / Televisor</td>
        <td colspan="4" style="text-align: center;">' . ControladorInventario::TraducirEstadoInventario($info['Pantalla_Televisor']) . '</td>
        </tr>

        <tr>
        <td colspan="6">Parabrisas trasero</td>
        <td colspan="5" style="text-align: center;">' . ControladorInventario::TraducirEstadoInventario($info['parabrisas_trasero']) . '</td>
        <td colspan="6">Reloj</td>
        <td colspan="4" style="text-align: center;">' . ControladorInventario::TraducirEstadoInventario($info['Reloj']) . '</td>
        </tr>

        <tr>
        <td colspan="6">Vidrios de puertas</td>
        <td colspan="5" style="text-align: center;">' . ControladorInventario::TraducirEstadoInventario($info['Vidrios_puertas']) . '</td>
        <td colspan="6">Brazo 1 Izquierdo R1</td>
        <td colspan="4" style="text-align: center;">' . ControladorInventario::TraducirEstadoInventario($info['Brazo_1_Izquierdo_R1']) . '</td>
        </tr>

        <tr>
        <td colspan="6" style="text-align: center;"><strong>LUCES</strong></td>
        <td colspan="5" style="text-align: center;"><strong>Estado / Condición</strong></td>
        <td colspan="6">Brazo 2 Derecho R2</td>
        <td colspan="4" style="text-align: center;">' . ControladorInventario::TraducirEstadoInventario($info['Brazo_2_Derecho_R2']) . '</td>
        </tr>

        <tr>
        <td colspan="6">Direccional delantera izquierda</td>
        <td colspan="5" style="text-align: center;">' . ControladorInventario::TraducirEstadoInventario($info['Direccional_delantera_izquierda']) . '</td>
        <td colspan="6">Brazo 3 Izquierdo R3</td>
        <td colspan="4" style="text-align: center;">' . ControladorInventario::TraducirEstadoInventario($info['Brazo_3_Izquierdo_R3']) . '</td>
        </tr>

        <tr>
        <td colspan="6">Direccional delantera derecha</td>
        <td colspan="5" style="text-align: center;">' . ControladorInventario::TraducirEstadoInventario($info['Direccional_delantera_derecha']) . '</td>
        <td colspan="6">Brazo 4 Derecho R6</td>
        <td colspan="4" style="text-align: center;">' . ControladorInventario::TraducirEstadoInventario($info['Brazo_4_Derecho_R6']) . '</td>
        </tr>

        <tr>
        <td colspan="6">Stop trasero derecho</td>
        <td colspan="5" style="text-align: center;">' . ControladorInventario::TraducirEstadoInventario($info['Stop_trasero_derecho']) . '</td>
        <td colspan="6" style="text-align: center;"><strong>EMBLEMAS</strong></td>
        <td colspan="4" style="text-align: center;"><strong>Estado / Condición</strong></td>
        </tr>

        <tr>
        <td colspan="6">Stop trasero izquierdo</td>
        <td colspan="5" style="text-align: center;">' . ControladorInventario::TraducirEstadoInventario($info['Stop_trasero_izquierdo']) . '</td>
        <td colspan="6">Emblema izquierdo de la empresa</td>
        <td colspan="4" style="text-align: center;">' . ControladorInventario::TraducirEstadoInventario($info['Emblema_izquierdo_empresa']) . '</td>
        </tr>

        <tr>
        <td colspan="6">Cucuyo lateral derecho</td>
        <td colspan="5" style="text-align: center;">' . ControladorInventario::TraducirEstadoInventario($info['Cucuyo_lateral_derecho']) . '</td>
        <td colspan="6">Emblema derecho de la empresa</td>
        <td colspan="4" style="text-align: center;">' . ControladorInventario::TraducirEstadoInventario($info['Emblema_derecho_empresa']) . '</td>
        </tr>

        <tr>
        <td colspan="6">Cucuyo lateral izquierdo</td>
        <td colspan="5" style="text-align: center;">' . ControladorInventario::TraducirEstadoInventario($info['Cucuyo_lateral_izquierdo']) . '</td>
        <td colspan="6">Escolar</td>
        <td colspan="4" style="text-align: center;">' . $escolar . '</td>
        </tr>

        <tr>
        <td colspan="6">Luces Internas</td>
        <td colspan="5" style="text-align: center;">' . $luces . '</td>
        <td colspan="6">Logo Izquierdo</td>
        <td colspan="4" style="text-align: center;">' . ControladorInventario::TraducirEstadoInventario($info['Logo_izquierdo']) . '</td>
        </tr>

        <tr>
        <td colspan="6">Balizas (licuadoras)</td>
        <td colspan="5" style="text-align: center;">' . ControladorInventario::TraducirEstadoInventario($info['balizas']) . '</td>
        <td colspan="6">Logo Derecho</td>
        <td colspan="4" style="text-align: center;">' . ControladorInventario::TraducirEstadoInventario($info['Logo_derecho']) . '</td>
        </tr>

        <tr>
        <td colspan="6" style="text-align: center;"><strong>LLANTAS</strong></td>
        <td colspan="5" style="text-align: center;"><strong>Estado / Condición</strong></td>
        <td colspan="6">N° Interno Delantero</td>
        <td colspan="4" style="text-align: center;">' . ControladorInventario::TraducirEstadoInventario($info['N_Interno_delantero']) . '</td>
        </tr>

        <tr>
        <td colspan="6">Delantera izquierda (R1)</td>
        <td colspan="5" style="text-align: center;">' . ControladorInventario::TraducirEstadoInventario($info['Delantera_izquierda_R1']) . '</td>
        <td colspan="6">N° Interno Trasero</td>
        <td colspan="4" style="text-align: center;">' . ControladorInventario::TraducirEstadoInventario($info['N_Interno_trasero']) . '</td>
        </tr>

        <tr>
        <td colspan="6">Delantera derecha (R2)</td>
        <td colspan="5" style="text-align: center;">' . ControladorInventario::TraducirEstadoInventario($info['Delantera_derecha_R2']) . '</td>
        <td colspan="6">N° Interno Izquierdo</td>
        <td colspan="4" style="text-align: center;">' . ControladorInventario::TraducirEstadoInventario($info['N_Interno_izquierdo']) . '</td>
        </tr>

        <tr>
        <td colspan="6">Trasera interior izquierda (R3)</td>
        <td colspan="5" style="text-align: center;">' . ControladorInventario::TraducirEstadoInventario($info['Trasera_interior_izquierda_R3']) . '</td>
        <td colspan="6">N° Interno Derecho</td>
        <td colspan="4" style="text-align: center;">' . ControladorInventario::TraducirEstadoInventario($info['N_Interno_derecho']) . '</td>
        </tr>

        <tr>
        <td colspan="6">Trasera exterior izquierda(R4)</td>
        <td colspan="5" style="text-align: center;">' . ControladorInventario::TraducirEstadoInventario($info['Trasera_exterior_izquierda_R4']) . '</td>
        <td colspan="6">Salidas de emergencia y martillos</td>
        <td colspan="4" style="text-align: center;">' . $salidas . '</td>
        </tr>

        <tr>
        <td colspan="6">Trasera interior derecha (R5)</td>
        <td colspan="5" style="text-align: center;">' . ControladorInventario::TraducirEstadoInventario($info['Trasera_interior_derecha_R5']) . '</td>
        <td colspan="6">Dispositivo de velocidad</td>
        <td colspan="4" style="text-align: center;">' . ControladorInventario::TraducirEstadoInventario($info['Dispositivo_velocidad']) . '</td>
        </tr>

        <tr>
        <td colspan="6">Trasera exterior derecha (R6)</td>
        <td colspan="5" style="text-align: center;">' . ControladorInventario::TraducirEstadoInventario($info['Trasera_exterior_derecha_R6']) . '</td>
        <td colspan="6">Aviso cómo conduzco</td>
        <td colspan="4" style="text-align: center;">' . $conduzco . '</td>
        </tr>

        <tr>
        <td colspan="8" style="text-align: center;"><strong>EQUIPO DE PREVENCIÓN Y SEGURIDAD</strong></td>
        <td colspan="3" style="text-align: center;"><strong>SI / NO</strong></td>
        <td colspan="6" style="text-align: center;"><strong>OTROS ELEMENTOS</strong></td>
        <td colspan="4" style="text-align: center;"><strong>Estado / Condición</strong></td>
        </tr>

        <tr>
        <td colspan="8">Gato</td>
        <td colspan="3" style="text-align: center;">' . ControladorInventario::TraducirEstadoInventario($info['Gato']) . '</td>
        <td colspan="6">Brazo limpiaparabrisas izquierdo</td>
        <td colspan="4" style="text-align: center;">' . ControladorInventario::TraducirEstadoInventario($info['Brazo_limpiaparabrisas_izquierdo']) . '</td>
        </tr>

        <tr>
        <td colspan="8">Cruceta o copa</td>
        <td colspan="3" style="text-align: center;">' . ControladorInventario::TraducirEstadoInventario($info['Cruceta_Copa']) . '</td>
        <td colspan="6">Plumillas limpiaparabrisas izquierdo</td>
        <td colspan="4" style="text-align: center;">' . ControladorInventario::TraducirEstadoInventario($info['Plumilla_limpiaparabrisas_izquierdo'])  . '</td>
        </tr>

        <tr>
        <td colspan="8">Dos conos o triángulos</td>
        <td colspan="3" style="text-align: center;">' . ControladorInventario::TraducirEstadoInventario($info['2Conos_Triangulos']) . '</td>
        <td colspan="6">Brazo limpiaparabrisas derecho</td>
        <td colspan="4" style="text-align: center;">' . ControladorInventario::TraducirEstadoInventario($info['Brazo_limpiaparabrisas_derecho']) . '</td>
        </tr>

        <tr>
        <td colspan="8">Botiquín</td>
        <td colspan="3" style="text-align: center;">' . ControladorInventario::TraducirEstadoInventario($info['Botiquin']) . '</td>
        <td colspan="6">Plumilla limpiaparabrisas derecho</td>
        <td colspan="4" style="text-align: center;">' . ControladorInventario::TraducirEstadoInventario($info['Plumilla_limpiaparabrisas_derecho']) . '</td>
        </tr>

        <tr>
        <td colspan="8">Extintor</td>
        <td colspan="3" style="text-align: center;">' . ControladorInventario::TraducirEstadoInventario($info['Extintor']) . '</td>
        <td colspan="6">Baterías</td>
        <td colspan="4" style="text-align: center;">' . ControladorInventario::TraducirEstadoInventario($info['Baterias']) . '</td>
        </tr>

        <tr>
        <td colspan="8">Dos tacos</td>
        <td colspan="3" style="text-align: center;">' . ControladorInventario::TraducirEstadoInventario($info['2Tacos_Bloques']) . '</td>
        <td colspan="6">Botones de tablero y timón</td>
        <td colspan="4" style="text-align: center;">' . ControladorInventario::TraducirEstadoInventario($info['Botones_tablero_timon']) . '</td>
        </tr>

        <tr>
        <td colspan="8">Alicate, destornillador</td>
        <td colspan="3" style="text-align: center;">' . ControladorInventario::TraducirEstadoInventario($info['Alicate_destornillador']) . '</td>
        <td colspan="6">Tapa radiador</td>
        <td colspan="4" style="text-align: center;">' . ControladorInventario::TraducirEstadoInventario($info['Tapa_radiador']) . '</td>
        </tr>

        <tr>
        <td colspan="8">Llave expansión, llaves fijas</td>
        <td colspan="3" style="text-align: center;">' . ControladorInventario::TraducirEstadoInventario($info['Llave_expancion_Llaves_fijas']) . '</td>
        <td colspan="6">Tapa deposito Hidr&aacute;ulico</td>
        <td colspan="4" style="text-align: center;">' . ControladorInventario::TraducirEstadoInventario($info['Tapa_deposito_hidraulico']) . '</td>
        </tr>

        <tr>
        <td colspan="8">Llanta de repuesto</td>
        <td colspan="3" style="text-align: center;">' . ControladorInventario::TraducirEstadoInventario($info['Llanta_repuesto']) . '</td>
        <td colspan="6">Cojinería en general</td>
        <td colspan="4" style="text-align: center;">' . ControladorInventario::TraducirEstadoInventario($info['Cojineria_general']) . '</td>
        </tr>

        <tr>
        <td colspan="8">Linterna con pila</td>
        <td colspan="3" style="text-align: center;">' . ControladorInventario::TraducirEstadoInventario($info['Linterna_pila']) . '</td>
        <td colspan="6">Cinturón sillas</td>
        <td colspan="4" style="text-align: center;">' . ControladorInventario::TraducirEstadoInventario($info['Cinturon_sillas_calidad']) . '</td>
        </tr>

        <tr>
        <td colspan="8">Cinturón Conductor</td>
        <td colspan="3" style="text-align: center;">' . ControladorInventario::TraducirEstadoInventario($info['Cinturon_conductor']) . '</td>
        <td colspan="6">Pasamanos</td>
        <td colspan="4" style="text-align: center;">' . ControladorInventario::TraducirEstadoInventario($info['Pasamanos']) . '</td>
        </tr>

        <tr>
        <td colspan="11"></td>
        <td colspan="6">Pito</td>
        <td colspan="4" style="text-align: center;">' . ControladorInventario::TraducirEstadoInventario($info['Claxon']) . '</td>
        </tr>

        <tr>
        <td colspan="11"></td>
        <td colspan="6">Placas reglamentarias</td>
        <td colspan="4" style="text-align: center;">' . ControladorInventario::TraducirEstadoInventario($info['Placas_reglamentarias']) . '</td>
        </tr>

      </tbody>
    </table>
        ';
    $pdf->SetFont('helvetica', '', '8');
    $pdf->writeHTML($tabla);
    /* ---------------------------------------------------------
    | | | | CONDUCTOR E/R OBSERVACIONES
    ==========================================================*/
    #conductor recibe 
    $conductor_r_e =
      $pdf->SetFont('helvetica', 'B', '8');
    $pdf->MultiCell(25, 5, "Conductor:", 0, 'L', 0, 0, '', '', true);
    $pdf->SetFont('helvetica', '', '8');
    $pdf->MultiCell(120, 5, $info['conductor'], 0, 'L', 0, 0, '', '', true);
    $pdf->Ln();

    $pdf->SetFont('helvetica', 'B', '8');
    $pdf->MultiCell(25, 5, "Situación:", 0, 'L', 0, 0, '', '', true);
    $pdf->SetFont('helvetica', '', '8');
    $pdf->MultiCell(120, 5,  ControladorInventario::TraducirEstadoInventario($info['recepcion_entrega_vehiculo']), 0, 'L', 0, 0, '', '', true);
    $pdf->Ln();
    #Observaciones
    $pdf->SetFont('helvetica', 'B', '8');
    $pdf->MultiCell(25, 5, "Observaciones:", 0, 'L', 0, 0, '', '', true);
    $pdf->SetFont('helvetica', '', '8');
    $pdf->MultiCell(120, 5, '', 0, 'L', 0, 0, '', '', true);
    $pdf->Ln();


    // Close and output PDF document
    // This method has several options, check the source code documentation for more information.
    $pdf->Output('Inventario'.$placa , 'I');

    //============================================================+
    // END OF FILE
    //============================================================+
  }
}

# SE INSTANCIA LA CLASE PARA LA GENERACION DEL ARCHIVO PDF
InventarioPDF::makePDF($resultado, $empresa);
