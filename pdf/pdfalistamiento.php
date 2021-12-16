<?php

# CONFIGURACION DE LA SESION
include '../config/config.php';

# Si no existe una sesion se redireciona directamente al inicio
// if (!isset($_SESSION["iniciarSesion"])) {
//   header("Location: " . URL_APP);
// }

# SE VALIDA DE QUE EL ID SEA DE TIPO INT 
if (isset($_REQUEST['idalistamiento']) && preg_match('/^[0-9]+$/', $_REQUEST['idalistamiento'])) {
  $idalistamiento = $_REQUEST['idalistamiento'];
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
$empresa = ModeloConceptosGH::mdlVerEmpresa();

$datos = array(
  'item' => 'id',
  'valor' => $idalistamiento
);

$alistamiento = ModeloAlistamiento::mdlDatosAlistamiento($datos);


/* ===================== 
  SI LA INFORMACIÓN VIENE FALSA SE REDIRECCIONA
========================= */

// if ($resultado === false) {
//   header("Location: " . URL_APP);
// }
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

class alistamientoPDF
{
  /* ===================== 
      GENERACION DE ARCHIVOS PDF DE LA PETICION DE OFERTA 
    ========================= */
  static public function makePDF($info,$empresa)
  {

    //LLAMADOS PRINCIPALES
    $documentos = ControladorVehiculos::ctrDocumentosxVehiculoSinRepetir($info['idvehiculo']);

    //VALIDAR TIPO DE DOCUMENTOS 
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


    //VALIDAR EVIDENCIAS Y LISTARLAS EN EL CUERPO DE LA TABLA 

    //FECHAS DE VENCIMIENTO DE LOS DOCUMENTOS
    $fechaTO = isset($fechaTO) ? $fechaTO : "";
    $fechaRM = isset($fechaRM) ? $fechaRM : "";
    $fechaE = isset($fechaE) ? $fechaE : "";
    $fechaS = isset($fechaS) ? $fechaS : "";
    $fechaP = isset($fechaP) ? $fechaP : "";
    $fechaRP = isset($fechaRP) ? $fechaRP : "";

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
    $pdf->MultiCell(130, 5, 'INVENTARIO ALISTAMIENTO', 0, 'C', 0, 1, $x, $y, true);
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
    $pdf->MultiCell(100, 5, $info['placa'], 0, 'L', 0, 0, '', '', true);

    # Marca
    $pdf->SetFont('helvetica', 'B', '8');
    $pdf->MultiCell(20, 5, "Marca:", 0, 'L', 0, 0, '', '', true);
    $pdf->SetFont('helvetica', '', '8');
    $pdf->MultiCell(100, 5, $info['marca'], 0, 'L', 0, 0, '', '', true);
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
    $pdf->MultiCell(100, 5, $info['modelo'], 0, 'L', 0, 0, '', '', true);
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
    $pdf->MultiCell(100, 5, $info['kilometraje'], 0, 'L', 0, 0, '', '', true);
    $pdf->Ln();

    #Fecha alistamiento
    $pdf->SetFont('helvetica', 'B', '8');
    $pdf->MultiCell(30, 5, "Fecha:", 0, 'L', 0, 0, '', '', true);
    $pdf->SetFont('helvetica', '', '8');
    $pdf->MultiCell(100, 5, $info['fechaalista'], 0, 'L', 0, 0, '', '', true);
    $pdf->Ln(3);
    $pdf->Ln(3);

    //CONDUCTOR / SITUACION 
    $pdf->SetFont('helvetica', 'B', '8');
    $pdf->MultiCell(30, 5, "Conductor:", 0, 'L', 0, 0, '', '', true);
    $pdf->SetFont('helvetica', '', '8');
    $pdf->MultiCell(100, 5, $info['Nombre'], 0, 'L', 0, 0, '', '', true);
    //$pdf->Ln();
    $pdf->Ln();
    $pdf->Ln();

    /* ===================================================
           ALISTAMIENTO PRINCIPAL
    ===================================================*/
    //TABLA
    $tabla =
      '<table cellspacing="0" cellpadding="5" border="1">
      <tbody>
        <tr>
        <td colspan="6" style="text-align: center;"><strong>SISTEMA DE LUCES</strong></td>
        <td colspan="5" class="text-center" style="text-align: center;"><strong>Estado / Condición</strong></td>
        <td colspan="6" style="text-align: center;"><strong>DOCUMENTOS VEHICULO</strong></td>
        <td colspan="4" style="text-align: center;"><strong>Fecha de vencimiento</strong></td>
        </tr>

        <tr>
        <td colspan="6" style="text-align: center;">Luces bajas</td>
        <td colspan="5" style="text-align: center;">'.ControladorAlistamiento::FTraducirEstado($info['lucesbajas']).'</td>
        <td colspan="6" style="text-align: center;">Seguro obligatorio (SOAT)</td>
        <td colspan="4" style="text-align: center;">'. $fechaS .'</td>
        </tr>

        <tr>
        <td colspan="6" style="text-align: center;">Luces altas</td>
        <td colspan="5" style="text-align: center;">'.ControladorAlistamiento::FTraducirEstado($info['lucesaltas']).'</td>
        <td colspan="6" style="text-align: center;">Revision tecnico mecanica</td>
        <td colspan="4" style="text-align: center;">' . $fechaRM . '</td>
        </tr>

        <tr>
        <td colspan="6" style="text-align: center;">Luces de reversa</td>
        <td colspan="5" style="text-align: center;">'.ControladorAlistamiento::FTraducirEstado($info['lucesreversa']).'</td>
        <td colspan="6" style="text-align: center;">Tarjeta de operacion</td>
        <td colspan="4" style="text-align: center;">' . $fechaTO . '</td>
        </tr>

        <tr>
        <td colspan="6" style="text-align: center;">Direccionales delanteras</td>
        <td colspan="5" style="text-align: center;">'.ControladorAlistamiento::FTraducirEstado($info['direccionales_delanteras']).'</td>
        <td colspan="6" style="text-align: center;">Revicion preventiva</td>
        <td colspan="4" style="text-align: center;">' . $fechaRP . '</td>
        </tr>

        <tr>
        <td colspan="6" style="text-align: center;">Iluminacion cabina</td>
        <td colspan="5" style="text-align: center;">'.ControladorAlistamiento::FTraducirEstado($info['iluminacioncabina']).'</td>
        <td colspan="6" style="text-align: center;">Poliza contractual</td>
        <td colspan="4" style="text-align: center;">' . $fechaP . '</td>
        </tr>

        <tr>
        <td colspan="6" style="text-align: center;">Luces internas  </td>
        <td colspan="5" style="text-align: center;">'.ControladorAlistamiento::FTraducirEstado($info['lucesinternas']).'</td>
        <td colspan="6" style="text-align: center;">Licencia conductor</td>
        <td colspan="4" style="text-align: center;">'.$info['fecha_vencimiento'].'</td>
        </tr>

        <tr>
        <td colspan="6" style="text-align: center;">Luces medias</td>
        <td colspan="5" style="text-align: center;">'.ControladorAlistamiento::FTraducirEstado($info['lucesmedias']).'</td>
        <td colspan="6" style="text-align: center;"></td>
        <td colspan="4" style="text-align: center;"></td>
        </tr>

        <tr>
        <td colspan="6" style="text-align: center;">Luces de Stop</td>
        <td colspan="5" style="text-align: center;">'.ControladorAlistamiento::FTraducirEstado($info['lucesdestop']).'</td>
        <td colspan="6" style="text-align: center;">Sucursal</td>
        <td colspan="4" style="text-align: center;">'.$info['sucursal'].'</td>
        </tr>

        <tr>
        <td colspan="6" style="text-align: center;">Luces de parqueadero</td>
        <td colspan="5" style="text-align: center;">'.ControladorAlistamiento::FTraducirEstado($info['lucesdeparqueo']).'</td>
        <td colspan="6" style="text-align: center;">Extintor</td>
        <td colspan="4" style="text-align: center;">' . $fechaE . '</td>
        </tr>

        <tr>
        <td colspan="6" style="text-align: center;">Direccionales traseras</td>
        <td colspan="5" style="text-align: center;">'.ControladorAlistamiento::FTraducirEstado($info['direccionales_traseras']).'</td>
        <td colspan="6" style="text-align: center;"></td>
        <td colspan="4" style="text-align: center;"></td>
        </tr>

        <tr>
        <td colspan="6" style="text-align: center;">Luz escala</td>
        <td colspan="5" style="text-align: center;">'.ControladorAlistamiento::FTraducirEstado($info['luzescala']).'</td>
        <td colspan="6" style="text-align: center;"><strong>CARROCERIA</strong></td>
        <td colspan="4" style="text-align: center;"><strong>Estado / Condición</strong></td>
        </tr>

        <tr>
        <td colspan="6" style="text-align: center;">Baliza licuadora</td>
        <td colspan="5" style="text-align: center;">'.ControladorAlistamiento::FTraducirEstado($info['baliza_licuadora']).'</td>
        <td colspan="6" style="text-align: center;">Retrovisores izquierdo</td>
        <td colspan="4" style="text-align: center;">'.ControladorAlistamiento::FTraducirEstado($info['retrovisor_izquierdo']).'</td>
        </tr>

        <tr>
        <td colspan="6" style="text-align: center;"><strong>SISTEMAS</strong></td>
        <td colspan="5" style="text-align: center;"><strong>Estado / Condición</strong></td>
        <td colspan="6" style="text-align: center;">Espejo interno</td>
        <td colspan="4" style="text-align: center;">'.ControladorAlistamiento::FTraducirEstado($info['espejointerno']).'</td>
        </tr>

        <tr>
        <td colspan="6" style="text-align: center;">Nivel de Refrigerante</td>
        <td colspan="5" style="text-align: center;">'.ControladorAlistamiento::FTraducirEstado($info['nivel_refrigerante']).'</td>
        <td colspan="6" style="text-align: center;">Apoya cabeza - Conductor</td>
        <td colspan="4" style="text-align: center;">'.ControladorAlistamiento::FTraducirEstado($info['apoyacabeza_conductor']).'</td>
        </tr>

        <tr>
        <td colspan="6" style="text-align: center;">Nivel de Combustible</td>
        <td colspan="5" style="text-align: center;">'.ControladorAlistamiento::FTraducirEstado($info['nivel_combustible']).'</td>
        <td colspan="6" style="text-align: center;">Equipo de Audio</td>
        <td colspan="4" style="text-align: center;">'.ControladorAlistamiento::FTraducirEstado($info['equipoaudio']).'</td>
        </tr>

        <tr>
        <td colspan="6" style="text-align: center;">Baterías</td>
        <td colspan="5" style="text-align: center;">'.ControladorAlistamiento::FTraducirEstado($info['baterias']).'</td>
        <td colspan="6" style="text-align: center;">Claraboyas</td>
        <td colspan="4" style="text-align: center;">'.ControladorAlistamiento::FTraducirEstado($info['claraboya']).'</td>
        </tr>

        <tr>
        <td colspan="6" style="text-align: center;">Freno principal</td>
        <td colspan="5" style="text-align: center;">'.ControladorAlistamiento::FTraducirEstado($info['freno_principal']).'</td>
        <td colspan="6" style="text-align: center;">Alarma de Retroceso</td>
        <td colspan="4" style="text-align: center;">'.ControladorAlistamiento::FTraducirEstado($info['alarmareversa']).'</td>
        </tr>

        <tr>
        <td colspan="6" style="text-align: center;">Nivel líquido Hidráulico</td>
        <td colspan="5" style="text-align: center;">'.ControladorAlistamiento::FTraducirEstado($info['liquido_hidraulico']).' </td>
        <td colspan="6" style="text-align: center;">Parabrisas</td>
        <td colspan="4" style="text-align: center;">'.ControladorAlistamiento::FTraducirEstado($info['parabrisas']).' </td>
        </tr>

        <tr>
        <td colspan="6" style="text-align: center;">Estado de correas</td>
        <td colspan="5" style="text-align: center;">'.ControladorAlistamiento::FTraducirEstado($info['estado_correas']).' </td>
        <td colspan="6" style="text-align: center;">Retrovisor derecho</td>
        <td colspan="4" style="text-align: center;">'.ControladorAlistamiento::FTraducirEstado($info['retrovisor_derecho']).' </td>
        </tr>

        <tr>
        <td colspan="6" style="text-align: center;">Nivel líquido de Frenos</td>
        <td colspan="5" style="text-align: center;">'.ControladorAlistamiento::FTraducirEstado($info['nivel_liquido_frenos']).' </td>
        <td colspan="6" style="text-align: center;">Apoya cabeza Pasajero</td>
        <td colspan="4" style="text-align: center;">'.ControladorAlistamiento::FTraducirEstado($info['apoyacabeza_pasajero']).' </td>
        </tr>

        <tr>
        <td colspan="6" style="text-align: center;">Barra de Dirección</td>
        <td colspan="5" style="text-align: center;">'.ControladorAlistamiento::FTraducirEstado($info['direccion']).' </td>
        <td colspan="6" style="text-align: center;">Placas</td>
        <td colspan="4" style="text-align: center;">'.ControladorAlistamiento::FTraducirEstado($info['placas']).' </td>
        </tr>

        <tr>
        <td colspan="6" style="text-align: center;">Nivel de Aceite</td>
        <td colspan="5" style="text-align: center;">'.ControladorAlistamiento::FTraducirEstado($info['nivel_aceite']).' </td>
        <td colspan="6" style="text-align: center;">Limpia parabrisas Derecho</td>
        <td colspan="4" style="text-align: center;">'.ControladorAlistamiento::FTraducirEstado($info['limpiaparabrisas_derecho']).' </td>
        </tr>

        <tr>
        <td colspan="6" style="text-align: center;">Freno de Emergencia</td>
        <td colspan="5" style="text-align: center;">'.ControladorAlistamiento::FTraducirEstado($info['freno_emergencia']).' </td>
        <td colspan="6" style="text-align: center;">Limpia parabrizas Izquierdo</td>
        <td colspan="4" style="text-align: center;">'.ControladorAlistamiento::FTraducirEstado($info['limpiaparabrisas_izquierdo']).' </td>
        </tr>

        <tr>
        <td colspan="6" style="text-align: center;">Sistema Hidráulico</td>
        <td colspan="5" style="text-align: center;">'.ControladorAlistamiento::FTraducirEstado($info['sistema_hidraulico']).' </td>
        <td colspan="6" style="text-align: center;">Piso</td>
        <td colspan="4" style="text-align: center;">'.ControladorAlistamiento::FTraducirEstado($info['piso']).' </td>
        </tr>

        <tr>
        <td colspan="6" style="text-align: center;"><strong>INDICADORES TABLERO</strong></td>
        <td colspan="5" style="text-align: center;"><strong>Estado / Condicion</strong></td>
        <td colspan="6" style="text-align: center;">Bomper delantero</td>
        <td colspan="4" style="text-align: center;">'.ControladorAlistamiento::FTraducirEstado($info['limpiaparabrisas_derecho']).' </td>
        </tr>

        <tr>
        <td colspan="6" style="text-align: center;">Velocímetro</td>
        <td colspan="5" style="text-align: center;">'.ControladorAlistamiento::FTraducirEstado($info['velocimetro']).' </td>
        <td colspan="6" style="text-align: center;">Cinturones de Seguridad conductor</td>
        <td colspan="4" style="text-align: center;">'.ControladorAlistamiento::FTraducirEstado($info['cinturones_conductor']).' </td>
        </tr>

        <tr>
        <td colspan="6" style="text-align: center;">Carga de la Batería</td>
        <td colspan="5" style="text-align: center;">'.ControladorAlistamiento::FTraducirEstado($info['carga_bateria']).' </td>
        <td colspan="6" style="text-align: center;">Sillas</td>
        <td colspan="4" style="text-align: center;">'.ControladorAlistamiento::FTraducirEstado($info['sillas']).' </td>
        </tr>

        <tr>
        <td colspan="6" style="text-align: center;">Presión de Aceite</td>
        <td colspan="5" style="text-align: center;">'.ControladorAlistamiento::FTraducirEstado($info['presion_aceite']).' </td>
        <td colspan="6" style="text-align: center;">Antideslizante escaleras</td>
        <td colspan="4" style="text-align: center;">'.ControladorAlistamiento::FTraducirEstado($info['antideslizante_escaleras']).' </td>
        </tr>

        <tr>
        <td colspan="6" style="text-align: center;">Combustible</td>
        <td colspan="5" style="text-align: center;">'.ControladorAlistamiento::FTraducirEstado($info['combustible']).' </td>
        <td colspan="6" style="text-align: center;">Puertas</td>
        <td colspan="4" style="text-align: center;">'.ControladorAlistamiento::FTraducirEstado($info['puertas']).' </td>
        </tr>

        <tr>
        <td colspan="6" style="text-align: center;">Presión de Aire</td>
        <td colspan="5" style="text-align: center;">'.ControladorAlistamiento::FTraducirEstado($info['presion_aire']).'</td>
        <td colspan="6" style="text-align: center;">Bomper trasero</td>
        <td colspan="4" style="text-align: center;">'.ControladorAlistamiento::FTraducirEstado($info['bomper_trasero']).' </td>
        </tr>

        <tr>
        <td colspan="6" style="text-align: center;">Temperatura</td>
        <td colspan="5" style="text-align: center;">'.ControladorAlistamiento::FTraducirEstado($info['temperatura']).' </td>
        <td colspan="6" style="text-align: center;">Claxon</td>
        <td colspan="4" style="text-align: center;">'.ControladorAlistamiento::FTraducirEstado($info['claxon']).' </td>
        </tr>

        <tr>
        <td colspan="6" style="text-align: center;"><strong>LLANTAS</strong></td>
        <td colspan="5" style="text-align: center;"><strong>Estado / Condicion</strong></td>
        <td colspan="6" style="text-align: center;">Cinturones de seguridad Pasajeros</td>
        <td colspan="4" style="text-align: center;">'.ControladorAlistamiento::FTraducirEstado($info['cinturones_pasajero']).' </td>
        </tr>

        <tr>
        <td colspan="6" style="text-align: center;">Delanteras</td>
        <td colspan="5" style="text-align: center;">'.ControladorAlistamiento::FTraducirEstado($info['llantas_delanteras']).' </td>
        <td colspan="6" style="text-align: center;">Pasamanos interno</td>
        <td colspan="4" style="text-align: center;">'.ControladorAlistamiento::FTraducirEstado($info['pasamanos_interno']).' </td>
        </tr>

        <tr>
        <td colspan="6" style="text-align: center;">Traseras</td>
        <td colspan="5" style="text-align: center;">'.ControladorAlistamiento::FTraducirEstado($info['llantas_traseras']).' </td>
        <td colspan="6" style="text-align: center;">Indicador de Velocidad</td>
        <td colspan="4" style="text-align: center;">'.ControladorAlistamiento::FTraducirEstado($info['indicador_velocidad']).' </td>
        </tr>

        <tr>
        <td colspan="6" style="text-align: center;">Cortes</td>
        <td colspan="5" style="text-align: center;">'.ControladorAlistamiento::FTraducirEstado($info['cortes']).' </td>
        <td colspan="6" style="text-align: center;">Ventanería</td>
        <td colspan="4" style="text-align: center;">'.ControladorAlistamiento::FTraducirEstado($info['ventaneria']).' </td>
        </tr>

        <tr>
        <td colspan="6" style="text-align: center;">Espárragos</td>
        <td colspan="5" style="text-align: center;">'.ControladorAlistamiento::FTraducirEstado($info['esparragos']).' </td>
        <td colspan="6" style="text-align: center;"><strong>MANTENIMIENTO</strong></td>
        <td colspan="4" style="text-align: center;"><strong>Fecha de vencimiento</strong></td>
        </tr>

        <tr>
        <td colspan="6" style="text-align: center;">Profundidad de huella 2mm</td>
        <td colspan="5" style="text-align: center;">'.ControladorAlistamiento::FTraducirEstado($info['profundidad_huella']).'</td>
        <td colspan="6" style="text-align: center;">Cambio de aceite</td>
        <td colspan="4" style="text-align: center;">'.ControladorAlistamiento::FTraducirEstado($info['cambio_aceite']).' </td>
        </tr>

        <tr>
        <td colspan="6" style="text-align: center;">Llanta de Repuesto</td>
        <td colspan="5" style="text-align: center;">'.ControladorAlistamiento::FTraducirEstado($info['llanta_repuesto']).' </td>
        <td colspan="6" style="text-align: center;">Engrase</td>
        <td colspan="4" style="text-align: center;">'.ControladorAlistamiento::FTraducirEstado($info['engrase']).' </td>
        </tr>

        <tr>
        <td colspan="6" style="text-align: center;">Presión de Inflado</td>
        <td colspan="5" style="text-align: center;">'.ControladorAlistamiento::FTraducirEstado($info['presion_inflado']).' </td>
        <td colspan="6" style="text-align: center;">Rotación de llantas</td>
        <td colspan="4" style="text-align: center;">'.ControladorAlistamiento::FTraducirEstado($info['rotacion_llantas']).' </td>
        </tr>
        
        <tr>
        <td colspan="6" style="text-align: center;">Abultamientos</td>
        <td colspan="5" style="text-align: center;">'.ControladorAlistamiento::FTraducirEstado($info['abultamientos']).' </td>
        <td colspan="6" style="text-align: center;">Filtro de aire</td>
        <td colspan="4" style="text-align: center;">'.ControladorAlistamiento::FTraducirEstado($info['filtro_aire']).' </td>
        </tr>

        <tr>
        <td colspan="6" style="text-align: center;">Reloj / Braza viga</td>
        <td colspan="5" style="text-align: center;">'.ControladorAlistamiento::FTraducirEstado($info['reloj_braza']).' </td>
        <td colspan="6" style="text-align: center;">Sincronización</td>
        <td colspan="4" style="text-align: center;">'.ControladorAlistamiento::FTraducirEstado($info['sincronizacion']).' </td>
        </tr>

        <tr>
        <td colspan="6" style="text-align: center;">Boca de la Llanta</td>
        <td colspan="5" style="text-align: center;">'.ControladorAlistamiento::FTraducirEstado($info['boca_llanta']).' </td>
        <td colspan="6" style="text-align: center;">Alineación y balanceo</td>
        <td colspan="4" style="text-align: center;">'.ControladorAlistamiento::FTraducirEstado($info['alineacion_balanceo']).' </td>
        </tr>

        <tr>
        <td colspan="6" style="text-align: center;">Rines</td>
        <td colspan="5" style="text-align: center;">'.ControladorAlistamiento::FTraducirEstado($info['rines']).' </td>
        <td colspan="6" style="text-align: center;">Revisión preventiva</td>
        <td colspan="4" style="text-align: center;"> </td>
        </tr>

        <tr>
        <td colspan="11" rowspan="23" style="text-align: center;"><img src="' . $image_elsaman . '"></td>
        <td colspan="6" style="text-align: center;">Otros</td>
        <td colspan="4" style="text-align: center;"> </td>
        </tr>

        <tr>
        <td colspan="6" style="text-align: center;"><strong>EQUIPO DE SEGURIDAD</strong></td>
        <td colspan="4" style="text-align: center;"><strong>Estado / Condicion</strong></td>
        </tr>

        <tr>
        <td colspan="6" style="text-align: center;">Chaleco reflectivo</td>
        <td colspan="4" style="text-align: center;">'.ControladorAlistamiento::FTraducirEstado($info['chalecoreflectivo']).' </td>
        </tr>

        <tr>
        <td colspan="6" style="text-align: center;">Linterna</td>
        <td colspan="4" style="text-align: center;">'.ControladorAlistamiento::FTraducirEstado($info['linterna']).' </td>
        </tr>

        <tr>
        <td colspan="6" style="text-align: center;">Conos 2 o Triángulos</td>
        <td colspan="4" style="text-align: center;">'.ControladorAlistamiento::FTraducirEstado($info['conos_triangulos']).' </td>
        </tr>

        <tr>
        <td colspan="6" style="text-align: center;">Tacos de Bloqueo</td>
        <td colspan="4" style="text-align: center;">'.ControladorAlistamiento::FTraducirEstado($info['tacos_bloques']).' </td>
        </tr>

        <tr>
        <td colspan="6" style="text-align: center;">Gato</td>
        <td colspan="4" style="text-align: center;">'.ControladorAlistamiento::FTraducirEstado($info['gato']).' </td>
        </tr>

        <tr>
        <td colspan="6" style="text-align: center;">Cruceta o Copa</td>
        <td colspan="4" style="text-align: center;">'.ControladorAlistamiento::FTraducirEstado($info['cruceta_copa']).' </td>
        </tr>

        <tr>
        <td colspan="6" style="text-align: center;">Alicate</td>
        <td colspan="4" style="text-align: center;">'.ControladorAlistamiento::FTraducirEstado($info['alicate']).' </td>
        </tr>

        <tr>
        <td colspan="6" style="text-align: center;">Destornilladores</td>
        <td colspan="4" style="text-align: center;">'.ControladorAlistamiento::FTraducirEstado($info['destornilladores']).' </td>
        </tr>

        <tr>
        <td colspan="6" style="text-align: center;">Llaves fijas</td>
        <td colspan="4" style="text-align: center;">'.ControladorAlistamiento::FTraducirEstado($info['llavesfijas']).' </td>
        </tr>

        <tr>
        <td colspan="6" style="text-align: center;">Botiquín</td>
        <td colspan="4" style="text-align: center;">'.ControladorAlistamiento::FTraducirEstado($info['botiquin']).' </td>
        </tr>

        <tr>
        <td colspan="6" style="text-align: center;">Llave de Expansión</td>
        <td colspan="4" style="text-align: center;">'.ControladorAlistamiento::FTraducirEstado($info['llave_expansion']).' </td>
        </tr>

        <tr>
        <td colspan="6" style="text-align: center;">Extintor</td>
        <td colspan="4" style="text-align: center;">'.ControladorAlistamiento::FTraducirEstado($info['extintor']).' </td>
        </tr>

        <tr>
        <td colspan="6" style="text-align: center;">Kilometraje total</td>
        <td colspan="4" style="text-align: center;">'.ControladorAlistamiento::FTraducirEstado($info['kilometraje_total']).' </td>
        </tr>

        <tr>
        <td colspan="6" style="text-align: center;">Observaciones</td>
        <td colspan="4" style="text-align: center;">'.ControladorAlistamiento::FTraducirEstado($info['observaciones']).' </td>
        </tr>

      </tbody>  
    </table>
        ';
    $pdf->SetFont('helvetica', '', '8');
    $pdf->writeHTML($tabla);
    /* ---------------------------------------------------------
    | | | | EVIDENCIAS
    ==========================================================*/

    // Close and output PDF document
    // This method has several options, check the source code documentation for more information.
    $pdf->Output('Inventario', 'I');
    //============================================================+
    // END OF FILE
    //============================================================+
  }
}
# SE INSTANCIA LA CLASE PARA LA GENERACION DEL ARCHIVO PDF
alistamientoPDF::makePDF($alistamiento,$empresa);
