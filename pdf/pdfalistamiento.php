<?php

# CONFIGURACION DE LA SESION
include '../config/config.php';

# Si no existe una sesion se redireciona directamente al inicio
if (!isset($_SESSION["iniciarSesion"])) {
  header("Location: " . URL_APP);
}

# SE VALIDA DE QUE EL ID SEA DE TIPO INT 
// if (isset($_REQUEST['id_inventario']) && preg_match('/^[0-9]+$/', $_REQUEST['id_inventario'])) {
//   $id_inventario = $_REQUEST['id_inventario'];
// } else {
//   header("Location: " . URL_APP);
// }

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
//$resultado = ModeloInventario::mdlListarInventario($id_inventario);
$empresa = ModeloConceptosGH::mdlVerEmpresa();
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

class InventarioPDF
{
  /* ===================== 
      GENERACION DE ARCHIVOS PDF DE LA PETICION DE OFERTA 
    ========================= */
  static public function makePDF()
  {
    // if ($info['usb_cd'] == 0) {

    //   $usb_cd = "CD";
    // } else {

    //   $usb_cd = "USB";
    // }
    // if ($info['escolar_delantero_trasero'] == 0) {

    //   $escolar_ = "Trasero";
    // } else {

    //   $escolar_ = "Delantero";
    // }
    // if ($info['interno_externo_comoConduzco'] == 0) {

    //   $avconduzco = "Externo";
    // } else {

    //   $avconduzco = "Interno";
    // }

    //LLAMADOS PRINCIPALES
    // $equiposonido = $usb_cd . ' - ' . ControladorInventario::TraducirEstadoInventario($info['Equipo_Sonido']);
    // $parlantes = ' # ' . $info['num_parlantes'] . ' - ' . ControladorInventario::TraducirEstadoInventario($info['Parlantes']);
    // $escolar = ControladorInventario::TraducirEstadoInventario($info['escolar']) . ' - ' . $escolar_;
    // $luces = ' # ' . $info['numero_luces_internas'] . ' - ' . ControladorInventario::TraducirEstadoInventario($info['Luces_internas']);
    // $salidas = ' # ' . $info['Nsalidas_martillos'] . ' - ' . ControladorInventario::TraducirEstadoInventario($info['Salidas_emergencia_martillos']);
    // $conduzco = $avconduzco . ' - ' . ControladorInventario::TraducirEstadoInventario($info['Av_Como_conduzco']);
    // $placa = $info['placa'];
    // $documentos = ControladorVehiculos::ctrDocumentosxVehiculoSinRepetir($info['idvehiculo']);
    // $fechamatricula = $info['fechamatricula'] == null ? "" : date("d/m/Y", strtotime($info['fechamatricula']));
    // $evidencias = ControladorInventario::ctrListaEvidencias($info['idvehiculo']);
    // $tr = "";

    //VALIDAR TIPO DE DOCUMENTOS 
    // foreach ($documentos as $key => $value) {
    //   if ($value['tipodocumento'] == 'Tarjeta de Operacion') {

    //     $fechaTO = $value['Ffechafin'];
    //   } else if ($value['tipodocumento'] == 'Revision preventiva') {

    //     $fechaRP = $value['Ffechafin'];
    //   } else if ($value['tipodocumento'] == 'Revision tecnico-mecanica') {

    //     $fechaRM = $value['Ffechafin'];
    //   } else if ($value['tipodocumento'] == 'Extintor') {

    //     $fechaE = $value['Ffechafin'];
    //   } else if ($value['tipodocumento'] == 'SOAT') {

    //     $fechaS = $value['Ffechafin'];
    //   } else if ($value['tipodocumento'] == 'Poliza RC - RCE') {

    //     $fechaP = $value['Ffechafin'];
    //   }
    // }

    //VALIDAR EVIDENCIAS Y LISTARLAS EN EL CUERPO DE LA TABLA 
    // foreach ($evidencias as $key => $value) {
    //   //var_dump($evidencias);
    //   if ($value['estado'] == 'RESUELTO') {

        
    //   } else {
    //     $evidencia = '<img src="../' . $value['ruta_foto'] . '">';
    //     $observaciones = $value['observaciones'];
    //     $fecha_evidencia = $value['fecha'];
    //     $estado = $value['estado'];
    //     $tr .= "
    //   <tr>
    //     <td colspan='2' height='150'>" . $evidencia . "</td>
    //     <td>" . $observaciones . "</td>
    //     <td>" . $fecha_evidencia . "</td>
    //     <td>" . $estado . "</td>
    //   </tr>";
    //   }
    // }
    // //FECHAS DE VENCIMIENTO DE LOS DOCUMENTOS
    // $fechaTO = isset($fechaTO) ? $fechaTO : "";
    // $fechaRM = isset($fechaRM) ? $fechaRM : "";
    // $fechaE = isset($fechaE) ? $fechaE : "";
    // $fechaS = isset($fechaS) ? $fechaS : "";
    // $fechaP = isset($fechaP) ? $fechaP : "";
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
    // $pdf->SetFont('helvetica', 'B', '8');
    // //Ancho de texto y de pagina
    // $anchoTexto = 130;
    // $anchoPaginaMM = $pdf->getPageWidth();
    // //Coordenadas
    // $x = ($anchoPaginaMM / 2) - ($anchoTexto / 2);
    // $y = $pdf->GetY() + 15;
    // //Titulo principal
    // $pdf->MultiCell(130, 5, 'INVENTARIO VEHICULAR', 0, 'C', 0, 1, $x, $y, true);
    // $pdf->MultiCell(130, 5, $empresa['razon_social'], 0, 'C', 0, 1, $x, '', true);
    // $pdf->SetFont('helvetica', '', '8');
    // $pdf->Ln(4);
    // //NIT
    // $pdf->SetFont('helvetica', 'B', '8');
    // $pdf->MultiCell(130, 5, "NIT:", 0, 'C', 0, 1, $x, '', true);
    // $pdf->SetFont('helvetica', 'I', '8');
    // $pdf->MultiCell(130, 5, $empresa['nit'], 0, 'C', 0, 1, $x, '', true);
    // $pdf->Ln(4);

    // //DATOS DEL VEHICULO
    // #Placa
    // $pdf->SetFont('helvetica', 'B', '8');
    // $pdf->MultiCell(30, 5, "Placa:", 0, 'L', 0, 0, '', '', true);
    // $pdf->SetFont('helvetica', '', '8');
    // $pdf->MultiCell(100, 5, $info['placa'], 0, 'L', 0, 0, '', '', true);
    // # Marca
    // $pdf->SetFont('helvetica', 'B', '8');
    // $pdf->MultiCell(20, 5, "Marca:", 0, 'L', 0, 0, '', '', true);
    // $pdf->SetFont('helvetica', '', '8');
    // $pdf->MultiCell(40, 5, $info['marca'], 0, 'L', 0, 0, '', '', true);
    // $pdf->Ln();

    // #Numero interno
    // $pdf->SetFont('helvetica', 'B', '8');
    // $pdf->MultiCell(30, 5, "Número interno:", 0, 'L', 0, 0, '', '', true);
    // $pdf->SetFont('helvetica', '', '8');
    // $pdf->MultiCell(100, 5, $info['numinterno'], 0, 'L', 0, 0, '', '', true);
    // # Modelo
    // $pdf->SetFont('helvetica', 'B', '8');
    // $pdf->MultiCell(20, 5, "Modelo:", 0, 'L', 0, 0, '', '', true);
    // $pdf->SetFont('helvetica', '', '8');
    // $pdf->MultiCell(40, 5, $info['modelo'], 0, 'L', 0, 0, '', '', true);
    // $pdf->Ln();

    // #clase de vehiculo
    // $pdf->SetFont('helvetica', 'B', '8');
    // $pdf->MultiCell(30, 5, "Clase de vehículo:", 0, 'L', 0, 0, '', '', true);
    // $pdf->SetFont('helvetica', '', '8');
    // $pdf->MultiCell(100, 5, $info['tipovehiculo'], 0, 'L', 0, 0, '', '', true);
    // # kilometraje
    // $pdf->SetFont('helvetica', 'B', '8');
    // $pdf->MultiCell(20, 5, "Kilometraje:", 0, 'L', 0, 0, '', '', true);
    // $pdf->SetFont('helvetica', '', '8');
    // $pdf->MultiCell(40, 5, $info['kilometraje'], 0, 'L', 0, 0, '', '', true);
    // $pdf->Ln();

    // #Fecha inventario
    // $pdf->SetFont('helvetica', 'B', '8');
    // $pdf->MultiCell(30, 5, "Fecha:", 0, 'L', 0, 0, '', '', true);
    // $pdf->SetFont('helvetica', '', '8');
    // $pdf->MultiCell(120, 5, $info['fecha_inventario'], 0, 'L', 0, 0, '', '', true);
    // $pdf->Ln(4);
    // $pdf->Ln(4);

    // //CONDUCTOR / SITUACION 
    // $pdf->SetFont('helvetica', 'B', '8');
    // $pdf->MultiCell(30, 5, "Conductor:", 0, 'L', 0, 0, '', '', true);
    // $pdf->SetFont('helvetica', '', '8');
    // $pdf->MultiCell(100, 5, $info['conductor'], 0, 'L', 0, 0, '', '', true);
    // //$pdf->Ln();
    // $pdf->SetFont('helvetica', 'B', '8');
    // $pdf->MultiCell(20, 5, "Situación:", 0, 'L', 0, 0, '', '', true);
    // $pdf->SetFont('helvetica', '', '8');
    // $pdf->MultiCell(40, 5,  ControladorInventario::TraducirEstadoInventario($info['recepcion_entrega_vehiculo']), 0, 'L', 0, 0, '', '', true);
    // $pdf->Ln();
    // $pdf->Ln();

    /* ===================================================
           INVENTARIO PRINCIPAL
    ===================================================*/
    //TABLA
    $tabla =
      '<table border="0" cellpadding="0" cellspacing="0" id="sheet0" class="sheet0">
      <col class="col0">
      <col class="col1">
      <col class="col2">
      <col class="col3">
      <col class="col4">
      <col class="col5">
      <col class="col6">
      <col class="col7">
      <col class="col8">
      <col class="col9">
      <col class="col10">
      <col class="col11">
      <col class="col12">
      <col class="col13">
      <col class="col14">
      <col class="col15">
      <tbody>
        <tr class="row0">
          <td class="column0 style210 null style148" colspan="2" rowspan="3">
            <div style="position: relative;"><img
                style="position: absolute; z-index: 1; left: 30px; top: 6px; width: 79px; height: 56px;"
                src="zip:///home/CloudConvertio/tmp/in_work/de4d3a8243f449a2fbd3c604c1c61680.xlsx#xl/media/image1.jpeg"
                border="0" /></div>
          </td>
          <td class="column2 style213 s style213" colspan="3">Fecha:</td>
          <td class="column5 style214 s style215" colspan="9">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;PROTOCOLO DE
            ALISTAMIENTO DIARIO DEL VEHICULO</td>
          <td class="column14 style68 s">Codigo:</td>
          <td class="column15 style71 s">GT-FR-01</td>
        </tr>
        <tr class="row1">
          <td class="column2 style76 s">Dia</td>
          <td class="column3 style77 s">Mes</td>
          <td class="column4 style76 s">Año</td>
          <td class="column5 style67 s">Conductor:</td>
          <td class="column6 style5 null"></td>
          <td class="column7 style85 s">Hora:</td>
          <td class="column8 style85 s">N° Int</td>
          <td class="column9 style85 null"></td>
          <td class="column10 style216 s style216" colspan="2">Tipo Automotor:</td>
          <td class="column12 style5 null"></td>
          <td class="column13 style85 null"></td>
          <td class="column14 style69 s">Version:</td>
          <td class="column15 style72 n">1</td>
        </tr>
        <tr class="row2">
          <td class="column2 style74 null"></td>
          <td class="column3 style75 null"></td>
          <td class="column4 style74 null"></td>
          <td class="column5 style7 null"></td>
          <td class="column6 style8 null"></td>
          <td class="column7 style7 null"></td>
          <td class="column8 style8 null"></td>
          <td class="column9 style7 null"></td>
          <td class="column10 style79 s">Marca:</td>
          <td class="column11 style8 null"></td>
          <td class="column12 style78 s">Modelo</td>
          <td class="column13 style7 null"></td>
          <td class="column14 style70 s">Pagina:</td>
          <td class="column15 style73 s">1 DE 1</td>
        </tr>
        <tr class="row3">
          <td class="column0">&nbsp;</td>
          <td class="column1">&nbsp;</td>
          <td class="column2">&nbsp;</td>
          <td class="column3">&nbsp;</td>
          <td class="column4">&nbsp;</td>
          <td class="column5">&nbsp;</td>
          <td class="column6">&nbsp;</td>
          <td class="column7">&nbsp;</td>
          <td class="column8">&nbsp;</td>
          <td class="column9">&nbsp;</td>
          <td class="column10">&nbsp;</td>
          <td class="column11">&nbsp;</td>
          <td class="column12">&nbsp;</td>
          <td class="column13">&nbsp;</td>
          <td class="column14">&nbsp;</td>
          <td class="column15">&nbsp;</td>
        </tr>
        <tr class="row4">
          <td class="column0 style41 s">Sistema de Luces</td>
          <td class="column1 style2 null"></td>
          <td class="column2 style3 null"></td>
          <td class="column3 style2 null"></td>
          <td class="column4 style42 s">B-M-NA</td>
          <td class="column5 style2 s">Luz tipo licuadora</td>
          <td class="column6 style42 s">B-M-NA</td>
          <td class="column7 style2 s">Luces Internas</td>
          <td class="column8 style42 s">B-M-NA</td>
          <td class="column9 style2 s">Stop</td>
          <td class="column10 style42 s">B-M-NA</td>
          <td class="column11 style192 s style193" colspan="5">Direccionales Traseras-parqueo-giro</td>
        </tr>
        <tr class="row5">
          <td class="column0 style43 s">B-M-NA</td>
          <td class="column1 style61 s">Frontales Altas</td>
          <td class="column2 style32 s">B-M-NA</td>
          <td class="column3 style58 s">Frontales Medias</td>
          <td class="column4 style32 s">B-M-NA</td>
          <td class="column5 style58 s">Frontales Bajas</td>
          <td class="column6 style32 s">B-M-NA</td>
          <td class="column7 style58 s">Iluminacion cabina</td>
          <td class="column8 style32 s">B-M-NA</td>
          <td class="column9 style58 s">Luz Escalera</td>
          <td class="column10 style32 s">B-M-NA</td>
          <td class="column11 style194 s style195" colspan="5">Direccionales Delanteras-parqueo -giro</td>
        </tr>
        <tr class="row6">
          <td class="column0 style25 null"></td>
          <td class="column1 style85 null"></td>
          <td class="column2 style5 null"></td>
          <td class="column3 style85 null"></td>
          <td class="column4 style5 null"></td>
          <td class="column5 style85 null"></td>
          <td class="column6 style5 null"></td>
          <td class="column7 style85 null"></td>
          <td class="column8 style5 null"></td>
          <td class="column9 style85 null"></td>
          <td class="column10 style5 null"></td>
          <td class="column11 style85 null"></td>
          <td class="column12 style44 null"></td>
          <td class="column13 style44 null"></td>
          <td class="column14 style44 null"></td>
          <td class="column15 style26 null"></td>
        </tr>
        <tr class="row7">
          <td class="column0 style45 s">Cabina</td>
          <td class="column1 style57 null"></td>
          <td class="column2 style32 s">B-M-NA</td>
          <td class="column3 style57 s">Ventaneria</td>
          <td class="column4 style32 s">B-M-NA</td>
          <td class="column5 style57 s">Pasamanos Interno</td>
          <td class="column6 style32 s">B-M-NA</td>
          <td class="column7 style57 s">Espejo central</td>
          <td class="column8 style9 null"></td>
          <td class="column9 style13 s">Niveles</td>
          <td class="column10 style32 s">B-M-NA</td>
          <td class="column11 style39 s">Limpiaparabrisas</td>
          <td class="column12 style196 s style204" colspan="4" rowspan="3">Indicadores de seguridad y manejo de emergencia
          </td>
        </tr>
        <tr class="row8">
          <td class="column0 style43 s">B-M-NA</td>
          <td class="column1 style85 s">Parabrisas</td>
          <td class="column2 style32 s">B-M-NA</td>
          <td class="column3 style85 s">Piso</td>
          <td class="column4 style32 s">B-M-NA</td>
          <td class="column5 style85 s">Cint Seg Pasajeros</td>
          <td class="column6 style32 s">B-M-NA</td>
          <td class="column7 style85 s">Espejos Laterales</td>
          <td class="column8 style5 null"></td>
          <td class="column9 style85 null"></td>
          <td class="column10 style32 s">B-M-NA</td>
          <td class="column11 style39 s">Frenos</td>
        </tr>
        <tr class="row9">
          <td class="column0 style43 s">B-M-NA</td>
          <td class="column1 style85 s">Puertas</td>
          <td class="column2 style32 s">B-M-NA</td>
          <td class="column3 style85 s">Pito</td>
          <td class="column4 style32 s">B-M-NA</td>
          <td class="column5 style85 s">Cint Seg Conductor</td>
          <td class="column6 style15 s">Indicadores</td>
          <td class="column7 style16 null"></td>
          <td class="column8 style32 s">B-M-NA</td>
          <td class="column9 style85 s">Velocimetro</td>
          <td class="column10 style32 s">B-M-NA</td>
          <td class="column11 style39 s">Refrigerante</td>
        </tr>
        <tr class="row10">
          <td class="column0 style43 s">B-M-NA</td>
          <td class="column1 style58 s">Asientos</td>
          <td class="column2 style32 s">B-M-NA</td>
          <td class="column3 style58 s">Alarma retroceso</td>
          <td class="column4 style32 s">B-M-NA</td>
          <td class="column5 style58 s">Antides escalera</td>
          <td class="column6 style32 s">B-M-NA</td>
          <td class="column7 style58 s">Hidraulico</td>
          <td class="column8 style32 s">B-M-NA</td>
          <td class="column9 style58 s">Temperatura</td>
          <td class="column10 style32 s">B-M-NA</td>
          <td class="column11 style39 s">Hidraulico</td>
          <td class="column12 style205 s style207" colspan="4">Observaciones</td>
        </tr>
        <tr class="row11">
          <td class="column0 style25 null"></td>
          <td class="column1 style85 null"></td>
          <td class="column2 style5 null"></td>
          <td class="column3 style85 null"></td>
          <td class="column4 style5 null"></td>
          <td class="column5 style85 null"></td>
          <td class="column6 style5 null"></td>
          <td class="column7 style85 null"></td>
          <td class="column8 style5 null"></td>
          <td class="column9 style85 null"></td>
          <td class="column10 style5 null"></td>
          <td class="column11 style85 null"></td>
          <td class="column12 style85 null"></td>
          <td class="column13 style85 null"></td>
          <td class="column14 style85 null"></td>
          <td class="column15 style26 null"></td>
        </tr>
        <tr class="row12">
          <td class="column0 style45 s">Llantas</td>
          <td class="column1 style57 null"></td>
          <td class="column2 style17 s">SI/NO</td>
          <td class="column3 style83 null"></td>
          <td class="column4 style18 null"></td>
          <td class="column5 style83 null"></td>
          <td class="column6 style17 s">SI/NO</td>
          <td class="column7 style83 null"></td>
          <td class="column8 style17 s">SI/NO</td>
          <td class="column9 style208 s style209" colspan="2">Presion de inflado (Lbs)</td>
          <td class="column11 style33 null"></td>
          <td class="column12 style34 null"></td>
          <td class="column13 style34 null"></td>
          <td class="column14 style34 null"></td>
          <td class="column15 style46 null"></td>
        </tr>
        <tr class="row13">
          <td class="column0 style25 null"></td>
          <td class="column1 style20 s">Cortes</td>
          <td class="column2 style32 null"></td>
          <td class="column3 style85 null"></td>
          <td class="column4 style5 null"></td>
          <td class="column5 style87 s">Profundidad de la huella a 2 mm</td>
          <td class="column6 style10 null"></td>
          <td class="column7 style20 s">Abultamientos</td>
          <td class="column8 style10 null"></td>
          <td class="column9 style20 s">Brazo vigia</td>
          <td class="column10 style32 s">B-M-NA</td>
          <td class="column11 style37 null"></td>
          <td class="column12 style38 null"></td>
          <td class="column13 style38 null"></td>
          <td class="column14 style38 null"></td>
          <td class="column15 style47 null"></td>
        </tr>
        <tr class="row14">
          <td class="column0 style48 null"></td>
          <td class="column1 style22 s">Esparragos completos</td>
          <td class="column2 style10 null"></td>
          <td class="column3 style58 null"></td>
          <td class="column4 style23 null"></td>
          <td class="column5 style22 s">Llanta de repuesto</td>
          <td class="column6 style10 null"></td>
          <td class="column7 style58 null"></td>
          <td class="column8 style10 null"></td>
          <td class="column9 style24 s">Rotor</td>
          <td class="column10 style32 s">B-M-NA</td>
          <td class="column11 style33 null"></td>
          <td class="column12 style34 null"></td>
          <td class="column13 style34 null"></td>
          <td class="column14 style34 null"></td>
          <td class="column15 style46 null"></td>
        </tr>
        <tr class="row15">
          <td class="column0 style25 null"></td>
          <td class="column1 style85 null"></td>
          <td class="column2 style5 null"></td>
          <td class="column3 style85 null"></td>
          <td class="column4 style5 null"></td>
          <td class="column5 style85 null"></td>
          <td class="column6 style5 null"></td>
          <td class="column7 style85 null"></td>
          <td class="column8 style5 null"></td>
          <td class="column9 style85 null"></td>
          <td class="column10 style5 null"></td>
          <td class="column11 style35 null"></td>
          <td class="column12 style36 null"></td>
          <td class="column13 style36 null"></td>
          <td class="column14 style36 null"></td>
          <td class="column15 style49 null"></td>
        </tr>
        <tr class="row16">
          <td class="column0 style45 s">Funcionamiento Sistemas</td>
          <td class="column1 style57 null"></td>
          <td class="column2 style9 null"></td>
          <td class="column3 style57 null"></td>
          <td class="column4 style32 s">B-M</td>
          <td class="column5 style57 s">Estado de Correas</td>
          <td class="column6 style32 s">B-M</td>
          <td class="column7 style57 s">Reloj de Vigia</td>
          <td class="column8 style32 s">B-M-NA</td>
          <td class="column9 style188 s style189" rowspan="2">Sistema de Frenos</td>
          <td class="column10 style190 s style191" rowspan="2">B-M</td>
          <td class="column11 style37 null"></td>
          <td class="column12 style38 null"></td>
          <td class="column13 style38 null"></td>
          <td class="column14 style38 null"></td>
          <td class="column15 style47 null"></td>
        </tr>
        <tr class="row17">
          <td class="column0 style217 s style218" colspan="2">Barra Direccion</td>
          <td class="column2 style32 s">B-M</td>
          <td class="column3 style58 s">Sistena Hidraulico</td>
          <td class="column4 style32 s">B-M</td>
          <td class="column5 style58 s">Sistema electrico</td>
          <td class="column6 style32 s">B-M</td>
          <td class="column7 style58 s">Sistema Refrigeracion</td>
          <td class="column8 style32 s">B-M</td>
          <td class="column11 style33 null"></td>
          <td class="column12 style34 null"></td>
          <td class="column13 style34 null"></td>
          <td class="column14 style34 null"></td>
          <td class="column15 style46 null"></td>
        </tr>
        <tr class="row18">
          <td class="column0 style25 null"></td>
          <td class="column1 style85 null"></td>
          <td class="column2 style5 null"></td>
          <td class="column3 style85 null"></td>
          <td class="column4 style5 null"></td>
          <td class="column5 style85 null"></td>
          <td class="column6 style5 null"></td>
          <td class="column7 style85 null"></td>
          <td class="column8 style5 null"></td>
          <td class="column9 style85 null"></td>
          <td class="column10 style5 null"></td>
          <td class="column11 style35 null"></td>
          <td class="column12 style36 null"></td>
          <td class="column13 style36 null"></td>
          <td class="column14 style36 null"></td>
          <td class="column15 style49 null"></td>
        </tr>
        <tr class="row19">
          <td class="column0 style45 s">Fechas Vencimiento</td>
          <td class="column1 style57 null"></td>
          <td class="column2 style27 s">Soat</td>
          <td class="column3 style86 null"></td>
          <td class="column4 style177 s style180" colspan="2" rowspan="2">RTM ANUAL</td>
          <td class="column6 style181 s style181" colspan="2" rowspan="2">R TM PREVENTIVA</td>
          <td class="column8 style182 s style183" colspan="3">Conduce</td>
          <td class="column11 style37 null"></td>
          <td class="column12 style38 null"></td>
          <td class="column13 style38 null"></td>
          <td class="column14 style38 null"></td>
          <td class="column15 style47 null"></td>
        </tr>
        <tr class="row20">
          <td class="column0 style50 s">Extracto</td>
          <td class="column1 style86 null"></td>
          <td class="column2 style22 s">TO</td>
          <td class="column3 style29 null"></td>
          <td class="column8 style184 s style185" colspan="3">Licencia</td>
          <td class="column11 style33 null"></td>
          <td class="column12 style34 null"></td>
          <td class="column13 style34 null"></td>
          <td class="column14 style34 null"></td>
          <td class="column15 style46 null"></td>
        </tr>
        <tr class="row21">
          <td class="column0 style25 null"></td>
          <td class="column1 style85 null"></td>
          <td class="column2 style5 null"></td>
          <td class="column3 style85 null"></td>
          <td class="column4 style5 null"></td>
          <td class="column5 style85 null"></td>
          <td class="column6 style5 null"></td>
          <td class="column7 style85 null"></td>
          <td class="column8 style5 null"></td>
          <td class="column9 style85 null"></td>
          <td class="column10 style5 null"></td>
          <td class="column11 style35 null"></td>
          <td class="column12 style36 null"></td>
          <td class="column13 style36 null"></td>
          <td class="column14 style36 null"></td>
          <td class="column15 style49 null"></td>
        </tr>
        <tr class="row22">
          <td class="column0 style51 s">Equipo de Prevencion y Seguridad</td>
          <td class="column1 style57 null"></td>
          <td class="column2 style9 null"></td>
          <td class="column3 style57 null"></td>
          <td class="column4 style40 s">SI/NO</td>
          <td class="column5 style57 s">Alicate</td>
          <td class="column6 style40 s">SI/NO</td>
          <td class="column7 style154 s style154" colspan="2">Extintor 10 lbr-Vencimiento</td>
          <td class="column9 style186 null style187" colspan="2"></td>
          <td class="column11 style37 null"></td>
          <td class="column12 style38 null"></td>
          <td class="column13 style38 null"></td>
          <td class="column14 style38 null"></td>
          <td class="column15 style47 null"></td>
        </tr>
        <tr class="row23">
          <td class="column0 style43 s">B-M</td>
          <td class="column1 style85 s">Disp. Velocidad</td>
          <td class="column2 style40 s">SI/NO</td>
          <td class="column3 style85 s">Tacos de Bloqueo (2)</td>
          <td class="column4 style40 s">SI/NO</td>
          <td class="column5 style85 s">Destornilladores</td>
          <td class="column6 style40 s">SI/NO</td>
          <td class="column7 style56 s">Botiquin -Vencimiento</td>
          <td class="column8 style150 null style152" colspan="3"></td>
          <td class="column11 style153 null style158" colspan="5" rowspan="2"></td>
        </tr>
        <tr class="row24">
          <td class="column0 style52 s">SI/NO</td>
          <td class="column1 style85 s">Linterna</td>
          <td class="column2 style40 s">SI/NO</td>
          <td class="column3 style85 s">Gato</td>
          <td class="column4 style40 s">SI/NO</td>
          <td class="column5 style85 s">Llave de expansion</td>
          <td class="column6 style40 s">SI/NO</td>
          <td class="column7 style159 s style163" colspan="4" rowspan="2">Antisepticos, elementos de corte, algodón, gasa
            esteril, esparadrapo, venda elastica, analgesicos, jabon.</td>
        </tr>
        <tr class="row25">
          <td class="column0 style53 s">SI/NO</td>
          <td class="column1 style7 s">Conos (2)</td>
          <td class="column2 style54 s">SI/NO</td>
          <td class="column3 style7 s">Cruceta</td>
          <td class="column4 style54 s">SI/NO</td>
          <td class="column5 style7 s">Llaves fijas</td>
          <td class="column6 style54 s">SI/NO</td>
          <td class="column11 style164 null style166" colspan="5"></td>
        </tr>
        <tr class="row26">
          <td class="column0">&nbsp;</td>
          <td class="column1">&nbsp;</td>
          <td class="column2">&nbsp;</td>
          <td class="column3">&nbsp;</td>
          <td class="column4">&nbsp;</td>
          <td class="column5">&nbsp;</td>
          <td class="column6">&nbsp;</td>
          <td class="column7">&nbsp;</td>
          <td class="column8">&nbsp;</td>
          <td class="column9">&nbsp;</td>
          <td class="column10">&nbsp;</td>
          <td class="column11">&nbsp;</td>
          <td class="column12">&nbsp;</td>
          <td class="column13">&nbsp;</td>
          <td class="column14">&nbsp;</td>
          <td class="column15">&nbsp;</td>
        </tr>
        <tr class="row27">
          <td class="column0 style167 s style170" colspan="2" rowspan="2">Responsables del Alistamiento</td>
          <td class="column2 style3 null"></td>
          <td class="column3 style2 null"></td>
          <td class="column4 style3 null"></td>
          <td class="column5 style2 null"></td>
          <td class="column6 style3 null"></td>
          <td class="column7 style2 null"></td>
          <td class="column8 style3 null"></td>
          <td class="column9 style2 null"></td>
          <td class="column10 style3 null"></td>
          <td class="column11 style2 null"></td>
          <td class="column12 style3 null"></td>
          <td class="column13 style3 null"></td>
          <td class="column14 style171 null style172" colspan="2"></td>
        </tr>
        <tr class="row28">
          <td class="column2 style5 null"></td>
          <td class="column3 style58 null"></td>
          <td class="column4 style23 null"></td>
          <td class="column5 style58 null"></td>
          <td class="column6 style23 null"></td>
          <td class="column7 style85 null"></td>
          <td class="column8 style23 null"></td>
          <td class="column9 style58 null"></td>
          <td class="column10 style23 null"></td>
          <td class="column11 style58 null"></td>
          <td class="column12 style23 null"></td>
          <td class="column13 style23 null"></td>
          <td class="column14 style173 null style174" colspan="2"></td>
        </tr>
        <tr class="row29">
          <td class="column0 style6 null"></td>
          <td class="column1 style7 null"></td>
          <td class="column2 style8 null"></td>
          <td class="column3 style7 null"></td>
          <td class="column4 style8 null"></td>
          <td class="column5 style7 s">Conductor</td>
          <td class="column6 style8 null"></td>
          <td class="column7 style7 null"></td>
          <td class="column8 style147 s style147" colspan="5">Administrador del Parque automotor</td>
          <td class="column13 style8 null"></td>
          <td class="column14 style148 null style149" colspan="2"></td>
        </tr>
        <tr class="row30">
          <td class="column0 style5 null"></td>
          <td class="column1 style85 null"></td>
          <td class="column2 style5 null"></td>
          <td class="column3 style85 null"></td>
          <td class="column4 style5 null"></td>
          <td class="column5 style85 null"></td>
          <td class="column6 style5 null"></td>
          <td class="column7 style85 null"></td>
          <td class="column8 style84 null"></td>
          <td class="column9 style84 null"></td>
          <td class="column10 style84 null"></td>
          <td class="column11 style84 null"></td>
          <td class="column12 style84 null"></td>
          <td class="column13 style5 null"></td>
          <td class="column14 style5 null"></td>
          <td class="column15">&nbsp;</td>
        </tr>
        <tr class="row31">
          <td class="column0 style210 null style148" colspan="2" rowspan="3">
            <div style="position: relative;"><img
                style="position: absolute; z-index: 1; left: 30px; top: 6px; width: 76px; height: 56px;"
                src="zip:///home/CloudConvertio/tmp/in_work/de4d3a8243f449a2fbd3c604c1c61680.xlsx#xl/media/image1.jpeg"
                border="0" /></div>
          </td>
          <td class="column2 style213 s style213" colspan="3">Fecha:</td>
          <td class="column5 style214 s style215" colspan="9">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;PROTOCOLO DE
            ALISTAMIENTO DIARIO DEL VEHICULO</td>
          <td class="column14 style68 s">Codigo:</td>
          <td class="column15 style71 s">GT-FR-01</td>
        </tr>
        <tr class="row32">
          <td class="column2 style76 s">Dia</td>
          <td class="column3 style77 s">Mes</td>
          <td class="column4 style76 s">Año</td>
          <td class="column5 style67 s">Conductor:</td>
          <td class="column6 style5 null"></td>
          <td class="column7 style85 s">Hora:</td>
          <td class="column8 style85 s">N° Int</td>
          <td class="column9 style85 null"></td>
          <td class="column10 style216 s style216" colspan="2">Tipo Automotor:</td>
          <td class="column12 style5 null"></td>
          <td class="column13 style85 null"></td>
          <td class="column14 style69 s">Version:</td>
          <td class="column15 style72 n">1</td>
        </tr>
        <tr class="row33">
          <td class="column2 style74 null"></td>
          <td class="column3 style75 null"></td>
          <td class="column4 style74 null"></td>
          <td class="column5 style7 null"></td>
          <td class="column6 style8 null"></td>
          <td class="column7 style7 null"></td>
          <td class="column8 style8 null"></td>
          <td class="column9 style7 null"></td>
          <td class="column10 style7 s">Marca:</td>
          <td class="column11 style7 null"></td>
          <td class="column12 style80 s">Modelo</td>
          <td class="column13 style7 null"></td>
          <td class="column14 style70 s">Pagina:</td>
          <td class="column15 style73 s">1 DE 1</td>
        </tr>
        <tr class="row34">
          <td class="column0">&nbsp;</td>
          <td class="column1">&nbsp;</td>
          <td class="column2">&nbsp;</td>
          <td class="column3">&nbsp;</td>
          <td class="column4">&nbsp;</td>
          <td class="column5">&nbsp;</td>
          <td class="column6">&nbsp;</td>
          <td class="column7">&nbsp;</td>
          <td class="column8">&nbsp;</td>
          <td class="column9">&nbsp;</td>
          <td class="column10">&nbsp;</td>
          <td class="column11">&nbsp;</td>
          <td class="column12">&nbsp;</td>
          <td class="column13">&nbsp;</td>
          <td class="column14">&nbsp;</td>
          <td class="column15">&nbsp;</td>
        </tr>
        <tr class="row35">
          <td class="column0 style41 s">Sistema de Luces</td>
          <td class="column1 style2 null"></td>
          <td class="column2 style3 null"></td>
          <td class="column3 style2 null"></td>
          <td class="column4 style42 s">B-M-NA</td>
          <td class="column5 style2 s">Luz tipo licuadora</td>
          <td class="column6 style42 s">B-M-NA</td>
          <td class="column7 style2 s">Luces Internas</td>
          <td class="column8 style42 s">B-M-NA</td>
          <td class="column9 style2 s">Stop</td>
          <td class="column10 style42 s">B-M-NA</td>
          <td class="column11 style192 s style193" colspan="5">Direccionales Traseras-parqueo-giro</td>
        </tr>
        <tr class="row36">
          <td class="column0 style43 s">B-M-NA</td>
          <td class="column1 style58 s">Frontales Altas</td>
          <td class="column2 style32 s">B-M-NA</td>
          <td class="column3 style58 s">Frontales Medias</td>
          <td class="column4 style32 s">B-M-NA</td>
          <td class="column5 style58 s">Frontales Bajas</td>
          <td class="column6 style32 s">B-M-NA</td>
          <td class="column7 style58 s">Iluminacion cabina</td>
          <td class="column8 style32 s">B-M-NA</td>
          <td class="column9 style58 s">Luz Escalera</td>
          <td class="column10 style32 s">B-M-NA</td>
          <td class="column11 style194 s style195" colspan="5">Direccionales Delanteras-parqueo -giro</td>
        </tr>
        <tr class="row37">
          <td class="column0 style25 null"></td>
          <td class="column1 style85 null"></td>
          <td class="column2 style5 null"></td>
          <td class="column3 style85 null"></td>
          <td class="column4 style5 null"></td>
          <td class="column5 style85 null"></td>
          <td class="column6 style5 null"></td>
          <td class="column7 style85 null"></td>
          <td class="column8 style5 null"></td>
          <td class="column9 style85 null"></td>
          <td class="column10 style5 null"></td>
          <td class="column11 style85 null"></td>
          <td class="column12 style44 null"></td>
          <td class="column13 style44 null"></td>
          <td class="column14 style44 null"></td>
          <td class="column15 style26 null"></td>
        </tr>
        <tr class="row38">
          <td class="column0 style45 s">Cabina</td>
          <td class="column1 style57 null"></td>
          <td class="column2 style32 s">B-M-NA</td>
          <td class="column3 style57 s">Ventaneria</td>
          <td class="column4 style32 s">B-M-NA</td>
          <td class="column5 style57 s">Pasamanos Interno</td>
          <td class="column6 style32 s">B-M-NA</td>
          <td class="column7 style57 s">Espejo central</td>
          <td class="column8 style9 null"></td>
          <td class="column9 style13 s">Niveles</td>
          <td class="column10 style32 s">B-M-NA</td>
          <td class="column11 style39 s">Limpiaparabrisas</td>
          <td class="column12 style196 s style204" colspan="4" rowspan="3">Indicadores de seguridad y manejo de emergencia
          </td>
        </tr>
        <tr class="row39">
          <td class="column0 style43 s">B-M-NA</td>
          <td class="column1 style85 s">Parabrisas</td>
          <td class="column2 style32 s">B-M-NA</td>
          <td class="column3 style85 s">Piso</td>
          <td class="column4 style32 s">B-M-NA</td>
          <td class="column5 style85 s">Cint Seg Pasajeros</td>
          <td class="column6 style32 s">B-M-NA</td>
          <td class="column7 style85 s">Espejos Laterales</td>
          <td class="column8 style5 null"></td>
          <td class="column9 style85 null"></td>
          <td class="column10 style32 s">B-M-NA</td>
          <td class="column11 style39 s">Frenos</td>
        </tr>
        <tr class="row40">
          <td class="column0 style43 s">B-M-NA</td>
          <td class="column1 style85 s">Puertas</td>
          <td class="column2 style32 s">B-M-NA</td>
          <td class="column3 style85 s">Pito</td>
          <td class="column4 style32 s">B-M-NA</td>
          <td class="column5 style85 s">Cint Seg Conductor</td>
          <td class="column6 style15 s">Indicadores</td>
          <td class="column7 style16 null"></td>
          <td class="column8 style32 s">B-M-NA</td>
          <td class="column9 style85 s">Velocimetro</td>
          <td class="column10 style32 s">B-M-NA</td>
          <td class="column11 style39 s">Refrigerante</td>
        </tr>
        <tr class="row41">
          <td class="column0 style43 s">B-M-NA</td>
          <td class="column1 style58 s">Asientos</td>
          <td class="column2 style32 s">B-M-NA</td>
          <td class="column3 style58 s">Alarma retroceso</td>
          <td class="column4 style32 s">B-M-NA</td>
          <td class="column5 style58 s">Antides escalera</td>
          <td class="column6 style32 s">B-M-NA</td>
          <td class="column7 style58 s">Hidraulico</td>
          <td class="column8 style32 s">B-M-NA</td>
          <td class="column9 style58 s">Temperatura</td>
          <td class="column10 style32 s">B-M-NA</td>
          <td class="column11 style39 s">Hidraulico</td>
          <td class="column12 style205 s style207" colspan="4">Observaciones</td>
        </tr>
        <tr class="row42">
          <td class="column0 style25 null"></td>
          <td class="column1 style85 null"></td>
          <td class="column2 style5 null"></td>
          <td class="column3 style85 null"></td>
          <td class="column4 style5 null"></td>
          <td class="column5 style85 null"></td>
          <td class="column6 style5 null"></td>
          <td class="column7 style85 null"></td>
          <td class="column8 style5 null"></td>
          <td class="column9 style85 null"></td>
          <td class="column10 style5 null"></td>
          <td class="column11 style85 null"></td>
          <td class="column12 style85 null"></td>
          <td class="column13 style85 null"></td>
          <td class="column14 style85 null"></td>
          <td class="column15 style26 null"></td>
        </tr>
        <tr class="row43">
          <td class="column0 style45 s">Llantas</td>
          <td class="column1 style57 null"></td>
          <td class="column2 style17 s">SI/NO</td>
          <td class="column3 style83 null"></td>
          <td class="column4 style18 null"></td>
          <td class="column5 style83 null"></td>
          <td class="column6 style17 s">SI/NO</td>
          <td class="column7 style83 null"></td>
          <td class="column8 style17 s">SI/NO</td>
          <td class="column9 style208 s style209" colspan="2">Presion de inflado (Lbs)</td>
          <td class="column11 style33 null"></td>
          <td class="column12 style34 null"></td>
          <td class="column13 style34 null"></td>
          <td class="column14 style34 null"></td>
          <td class="column15 style46 null"></td>
        </tr>
        <tr class="row44">
          <td class="column0 style25 null"></td>
          <td class="column1 style20 s">Cortes</td>
          <td class="column2 style32 null"></td>
          <td class="column3 style85 null"></td>
          <td class="column4 style5 null"></td>
          <td class="column5 style87 s">Profundidad de la huella a 2 mm</td>
          <td class="column6 style10 null"></td>
          <td class="column7 style20 s">Abultamientos</td>
          <td class="column8 style10 null"></td>
          <td class="column9 style20 s">Brazo vigia</td>
          <td class="column10 style32 s">B-M-NA</td>
          <td class="column11 style37 null"></td>
          <td class="column12 style38 null"></td>
          <td class="column13 style38 null"></td>
          <td class="column14 style38 null"></td>
          <td class="column15 style47 null"></td>
        </tr>
        <tr class="row45">
          <td class="column0 style48 null"></td>
          <td class="column1 style22 s">Esparragos completos</td>
          <td class="column2 style10 null"></td>
          <td class="column3 style58 null"></td>
          <td class="column4 style23 null"></td>
          <td class="column5 style22 s">Llanta de repuesto</td>
          <td class="column6 style10 null"></td>
          <td class="column7 style58 null"></td>
          <td class="column8 style10 null"></td>
          <td class="column9 style24 s">Rotor</td>
          <td class="column10 style32 s">B-M-NA</td>
          <td class="column11 style33 null"></td>
          <td class="column12 style34 null"></td>
          <td class="column13 style34 null"></td>
          <td class="column14 style34 null"></td>
          <td class="column15 style46 null"></td>
        </tr>
        <tr class="row46">
          <td class="column0 style25 null"></td>
          <td class="column1 style85 null"></td>
          <td class="column2 style5 null"></td>
          <td class="column3 style85 null"></td>
          <td class="column4 style5 null"></td>
          <td class="column5 style85 null"></td>
          <td class="column6 style5 null"></td>
          <td class="column7 style85 null"></td>
          <td class="column8 style5 null"></td>
          <td class="column9 style85 null"></td>
          <td class="column10 style5 null"></td>
          <td class="column11 style35 null"></td>
          <td class="column12 style36 null"></td>
          <td class="column13 style36 null"></td>
          <td class="column14 style36 null"></td>
          <td class="column15 style49 null"></td>
        </tr>
        <tr class="row47">
          <td class="column0 style45 s">Funcionamiento Sistemas</td>
          <td class="column1 style57 null"></td>
          <td class="column2 style9 null"></td>
          <td class="column3 style57 null"></td>
          <td class="column4 style32 s">B-M</td>
          <td class="column5 style57 s">Estado de Correas</td>
          <td class="column6 style32 s">B-M</td>
          <td class="column7 style57 s">Reloj de Vigia</td>
          <td class="column8 style32 s">B-M-NA</td>
          <td class="column9 style188 s style189" rowspan="2">Sistema de Frenos</td>
          <td class="column10 style190 s style191" rowspan="2">B-M</td>
          <td class="column11 style37 null"></td>
          <td class="column12 style38 null"></td>
          <td class="column13 style38 null"></td>
          <td class="column14 style38 null"></td>
          <td class="column15 style47 null"></td>
        </tr>
        <tr class="row48">
          <td class="column0 style175 s style176" colspan="2">Barra Direccion</td>
          <td class="column2 style32 s">B-M</td>
          <td class="column3 style58 s">Sistena Hidraulico</td>
          <td class="column4 style32 s">B-M</td>
          <td class="column5 style58 s">Sistema electrico</td>
          <td class="column6 style32 s">B-M</td>
          <td class="column7 style58 s">Sistema Refrigeracion</td>
          <td class="column8 style32 s">B-M</td>
          <td class="column11 style33 null"></td>
          <td class="column12 style34 null"></td>
          <td class="column13 style34 null"></td>
          <td class="column14 style34 null"></td>
          <td class="column15 style46 null"></td>
        </tr>
        <tr class="row49">
          <td class="column0 style25 null"></td>
          <td class="column1 style85 null"></td>
          <td class="column2 style5 null"></td>
          <td class="column3 style85 null"></td>
          <td class="column4 style5 null"></td>
          <td class="column5 style85 null"></td>
          <td class="column6 style5 null"></td>
          <td class="column7 style85 null"></td>
          <td class="column8 style5 null"></td>
          <td class="column9 style85 null"></td>
          <td class="column10 style5 null"></td>
          <td class="column11 style35 null"></td>
          <td class="column12 style36 null"></td>
          <td class="column13 style36 null"></td>
          <td class="column14 style36 null"></td>
          <td class="column15 style49 null"></td>
        </tr>
        <tr class="row50">
          <td class="column0 style45 s">Fechas Vencimiento</td>
          <td class="column1 style57 null"></td>
          <td class="column2 style27 s">Soat</td>
          <td class="column3 style86 null"></td>
          <td class="column4 style177 s style180" colspan="2" rowspan="2">RTM ANUAL</td>
          <td class="column6 style181 s style181" colspan="2" rowspan="2">R TM PREVENTIVA</td>
          <td class="column8 style182 s style183" colspan="3">Conduce</td>
          <td class="column11 style37 null"></td>
          <td class="column12 style38 null"></td>
          <td class="column13 style38 null"></td>
          <td class="column14 style38 null"></td>
          <td class="column15 style47 null"></td>
        </tr>
        <tr class="row51">
          <td class="column0 style50 s">Extracto</td>
          <td class="column1 style86 null"></td>
          <td class="column2 style22 s">TO</td>
          <td class="column3 style29 null"></td>
          <td class="column8 style184 s style185" colspan="3">Licencia</td>
          <td class="column11 style33 null"></td>
          <td class="column12 style34 null"></td>
          <td class="column13 style34 null"></td>
          <td class="column14 style34 null"></td>
          <td class="column15 style46 null"></td>
        </tr>
        <tr class="row52">
          <td class="column0 style25 null"></td>
          <td class="column1 style85 null"></td>
          <td class="column2 style5 null"></td>
          <td class="column3 style85 null"></td>
          <td class="column4 style5 null"></td>
          <td class="column5 style85 null"></td>
          <td class="column6 style5 null"></td>
          <td class="column7 style85 null"></td>
          <td class="column8 style5 null"></td>
          <td class="column9 style85 null"></td>
          <td class="column10 style5 null"></td>
          <td class="column11 style35 null"></td>
          <td class="column12 style36 null"></td>
          <td class="column13 style36 null"></td>
          <td class="column14 style36 null"></td>
          <td class="column15 style49 null"></td>
        </tr>
        <tr class="row53">
          <td class="column0 style51 s">Equipo de Prevencion y Seguridad</td>
          <td class="column1 style57 null"></td>
          <td class="column2 style9 null"></td>
          <td class="column3 style57 null"></td>
          <td class="column4 style40 s">SI/NO</td>
          <td class="column5 style57 s">Alicate</td>
          <td class="column6 style40 s">SI/NO</td>
          <td class="column7 style154 s style154" colspan="2">Extintor 10 lbr-Vencimiento</td>
          <td class="column9 style186 null style187" colspan="2"></td>
          <td class="column11 style37 null"></td>
          <td class="column12 style38 null"></td>
          <td class="column13 style38 null"></td>
          <td class="column14 style38 null"></td>
          <td class="column15 style47 null"></td>
        </tr>
        <tr class="row54">
          <td class="column0 style60 s">B-M</td>
          <td class="column1 style85 s">Disp. Velocidad</td>
          <td class="column2 style40 s">SI/NO</td>
          <td class="column3 style85 s">Tacos de Bloqueo (2)</td>
          <td class="column4 style40 s">SI/NO</td>
          <td class="column5 style85 s">Destornilladores</td>
          <td class="column6 style40 s">SI/NO</td>
          <td class="column7 style56 s">Botiquin -Vencimiento</td>
          <td class="column8 style150 null style152" colspan="3"></td>
          <td class="column11 style153 null style158" colspan="5" rowspan="2"></td>
        </tr>
        <tr class="row55">
          <td class="column0 style52 s">SI/NO</td>
          <td class="column1 style85 s">Linterna</td>
          <td class="column2 style40 s">SI/NO</td>
          <td class="column3 style85 s">Gato</td>
          <td class="column4 style40 s">SI/NO</td>
          <td class="column5 style85 s">Llave de expansion</td>
          <td class="column6 style40 s">SI/NO</td>
          <td class="column7 style159 s style163" colspan="4" rowspan="2">Antisepticos, elementos de corte, algodón, gasa
            esteril, esparadrapo, venda elastica, analgesicos, jabon.</td>
        </tr>
        <tr class="row56">
          <td class="column0 style53 s">SI/NO</td>
          <td class="column1 style7 s">Conos (2)</td>
          <td class="column2 style54 s">SI/NO</td>
          <td class="column3 style7 s">Cruceta</td>
          <td class="column4 style54 s">SI/NO</td>
          <td class="column5 style7 s">Llaves fijas</td>
          <td class="column6 style54 s">SI/NO</td>
          <td class="column11 style164 null style166" colspan="5"></td>
        </tr>
        <tr class="row57">
          <td class="column0">&nbsp;</td>
          <td class="column1">&nbsp;</td>
          <td class="column2">&nbsp;</td>
          <td class="column3">&nbsp;</td>
          <td class="column4">&nbsp;</td>
          <td class="column5">&nbsp;</td>
          <td class="column6">&nbsp;</td>
          <td class="column7">&nbsp;</td>
          <td class="column8">&nbsp;</td>
          <td class="column9">&nbsp;</td>
          <td class="column10">&nbsp;</td>
          <td class="column11">&nbsp;</td>
          <td class="column12">&nbsp;</td>
          <td class="column13">&nbsp;</td>
          <td class="column14">&nbsp;</td>
          <td class="column15">&nbsp;</td>
        </tr>
        <tr class="row58">
          <td class="column0 style167 s style170" colspan="2" rowspan="2">Responsables del Alistamiento</td>
          <td class="column2 style3 null"></td>
          <td class="column3 style2 null"></td>
          <td class="column4 style3 null"></td>
          <td class="column5 style2 null"></td>
          <td class="column6 style3 null"></td>
          <td class="column7 style2 null"></td>
          <td class="column8 style3 null"></td>
          <td class="column9 style2 null"></td>
          <td class="column10 style3 null"></td>
          <td class="column11 style2 null"></td>
          <td class="column12 style3 null"></td>
          <td class="column13 style3 null"></td>
          <td class="column14 style171 null style172" colspan="2"></td>
        </tr>
        <tr class="row59">
          <td class="column2 style5 null"></td>
          <td class="column3 style58 null"></td>
          <td class="column4 style23 null"></td>
          <td class="column5 style58 null"></td>
          <td class="column6 style23 null"></td>
          <td class="column7 style85 null"></td>
          <td class="column8 style23 null"></td>
          <td class="column9 style58 null"></td>
          <td class="column10 style23 null"></td>
          <td class="column11 style58 null"></td>
          <td class="column12 style23 null"></td>
          <td class="column13 style23 null"></td>
          <td class="column14 style173 null style174" colspan="2"></td>
        </tr>
        <tr class="row60">
          <td class="column0 style6 null"></td>
          <td class="column1 style7 null"></td>
          <td class="column2 style8 null"></td>
          <td class="column3 style7 null"></td>
          <td class="column4 style8 null"></td>
          <td class="column5 style7 s">Conductor</td>
          <td class="column6 style8 null"></td>
          <td class="column7 style7 null"></td>
          <td class="column8 style147 s style147" colspan="5">Administrador del Parque automotor</td>
          <td class="column13 style8 null"></td>
          <td class="column14 style148 null style149" colspan="2"></td>
        </tr>
      </tbody>
    </table>
        ';
    $pdf->SetFont('helvetica', '', '8');
    $pdf->writeHTML($tabla);
    /* ---------------------------------------------------------
    | | | | EVIDENCIAS
    ==========================================================*/
    // $pdf->SetFont('helvetica', 'B', '12');
    // $pdf->Cell(0, 0, "EVIDENCIAS", 0, 0, 'C', 0, '', 0);
    // $pdf->Ln();
    // $pdf->Ln();

    // $tabla2 = '<table cellspacing="0" cellpadding="5" border="1" class="table text-center">
    //             <thead>
    //               <tr>
    //                 <th style="text-align: center;"><strong>Evidencias</strong></th>
    //                 <th style="text-align: center;"><strong>Observaciones</strong></th>
    //                 <th style="text-align: center;"><strong>Fecha</strong></th>
    //                 <th style="text-align: center;"><strong>Estado</strong></th>
    //               </tr>
    //             </thead>
    //             <tbody> ' . $tr . ' </tbody>          
    //           </table>';

    // $pdf->SetFont('helvetica', '', '8');
    // $pdf->writeHTML($tabla2);

    // Close and output PDF document
    // This method has several options, check the source code documentation for more information.
    $pdf->Output('Inventario' . $placa, 'I');
    //============================================================+
    // END OF FILE
    //============================================================+
  }
}
# SE INSTANCIA LA CLASE PARA LA GENERACION DEL ARCHIVO PDF
InventarioPDF::makePDF();
