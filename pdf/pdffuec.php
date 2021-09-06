<?php

# CONFIGURACION DE LA SESION
include '../config/config.php';

# Si no existe una sesion se redireciona directamente al inicio
// if (!isset($_SESSION["iniciarSesion"])) {
//     header("Location: " . URL_APP);
// }

# SE VALIDA DE QUE EL ID SEA DE TIPO INT 
if (isset($_REQUEST['cod']) && preg_match('/^[0-9]+$/', $_REQUEST['cod'])) {
    $idfuec = $_REQUEST['cod'];
} else {
    header("Location: " . URL_APP);
}

#SE ESTABLECE EL HORARIO 
date_default_timezone_set('America/Bogota');

# SE REQUIERE EL AUTOLOAD
require '../vendor/autoload.php';

# REQUERIMOS EL CONTROLADOR Y EL MODELO PARA HACER USO DE LA INFORMACIÓN
require '../controllers/fuec.controlador.php';
require '../models/fuec.modelo.php';
require '../models/conceptos.modelo.php';


$resultado = ControladorFuec::ctrDatosFUEC("idfuec", $idfuec);
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
        // set background image
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


class PdfFuec
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
        $pdf->SetTitle('FUEC');
        $pdf->SetSubject('FUEC');
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
        $image_vigilado = '../views/img/plantilla/fuec/img_vigilado.png';
        $image_todos = '../views/img/plantilla/fuec/img_todos.png';
        $image_ponal = '../views/img/plantilla/fuec/img_ponal.png';
        $image_mintransporte = '../views/img/plantilla/fuec/img_mintransporte.jpeg';
        $image_iso = '../views/img/plantilla/fuec/img_iso.jpeg';
        $image_elsaman = '../views/img/plantilla/fuec/img_logo.jpg';
        $image_codigos = '../views/img/plantilla/fuec/img_codigos.png';
        $image_5estrellas = '../views/img/plantilla/fuec/img_5estrellas.jpg';
        $image_qr = '../views/img/plantilla/fuec/img_qr.png';
        //$image_firma = '../views/img/plantilla/fuec/img_firma.jpg';
        $image_firma = '../' . $empresa['ruta_firma'];

        $pdf->Image($image_vigilado, 10, 20, 65, 12,  'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        $pdf->Image($image_iso, 85, 20, 28, 12,  'JPEG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        $pdf->Image($image_elsaman, 118, 10, 45, 34,  'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        $pdf->Image($image_qr, 165, 15, 20, 20,  'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);

        /* ===================================================
           CONSECUTIVO FUEC
        ===================================================*/
        // Id fuec convertido en 4 digitos, ejemplo: 0001
        $idfuecString = strval($info['idfuec']);
        $faltanteDigitos = 4 - strlen($idfuecString);
        $idfuec4digitos = "";
        for ($i=0; $i < $faltanteDigitos; $i++) { 
            $idfuec4digitos.="0";
        }
        $idfuec4digitos.=$info['idfuec'];

        // numero contrato convertido en 4 digitos, ejemplo: 0023
        $nro_contratoString = strval($info['nro_contrato']);
        $faltanteDigitos = 4 - strlen($nro_contratoString);
        $nro_contrato4digitos = "";
        for ($i=0; $i < $faltanteDigitos; $i++) { 
            $nro_contrato4digitos.="0";
        }
        $nro_contrato4digitos.=$info['nro_contrato'];

        // Consecutivo completo
        $Consecutivo = $empresa['dir_territorial'] . $empresa['nro_resolucion'] . substr($empresa['anio_resolucion'], 2, 4) . date('Y', strtotime($info['fecha_creacion'])) . $nro_contrato4digitos . $idfuec4digitos;


        /* ===================================================
           TITULO FUEC
        ===================================================*/
        $pdf->SetFont('helvetica', 'B', '8');
        $anchoTexto = 130;
        $anchoPaginaMM = $pdf->getPageWidth();
        $x = ($anchoPaginaMM / 2) - ($anchoTexto / 2);
        //$y = 35;
        $y = $pdf->GetY() + 30;
        $pdf->MultiCell(130, 5, 'FORMATO ÚNICO DE EXTRACTO DEL CONTRATO DEL SERVICIO PÚBLICO DE TRANSPORTE TERRESTRE AUTOMOTOR ESPECIAL', 0, 'C', 0, 1, $x, $y, true);

        $pdf->SetFont('helvetica', '', '8');
        $pdf->Ln(4);
        //$pdf->Cell($anchoPaginaMM, 0.5, '317005917201900020002', 0, 1, 'C');
        $pdf->MultiCell(130, 5, $Consecutivo, 0, 'C', 0, 1, $x, '', true);
        $pdf->Ln(4);

        /* ===================================================
           INFORMACIÓN DE LA EMPRESA
        ===================================================*/
        # RAZÓN SOCIAL
        $pdf->SetFont('helvetica', 'B', '8');
        $pdf->MultiCell(25, 5, "RAZÓN SOCIAL:", 0, 'L', 0, 0, '', '', true);
        $pdf->SetFont('helvetica', '', '8');
        $pdf->MultiCell(120, 5, $empresa['razon_social'], 0, 'L', 0, 0, '', '', true);
        # NIT
        $pdf->SetFont('helvetica', 'B', '8');
        $pdf->MultiCell(8, 5, "NIT:", 0, 'L', 0, 0, '', '', true);
        $pdf->SetFont('helvetica', '', '8');
        $pdf->MultiCell(25, 5, $empresa['nit'], 0, 'L', 0, 0, '', '', true);
        $pdf->Ln();

        # CONTRATO NRO.
        $pdf->SetFont('helvetica', 'B', '8');
        $pdf->MultiCell(28, 5, "CONTRATO NRO.:", 0, 'L', 0, 0, '', '', true);
        $pdf->SetFont('helvetica', '', '8');
        $pdf->MultiCell(20, 5, $idfuec4digitos, 0, 'L', 0, 0, '', '', true);
        $pdf->Ln();

        # CONTRATANTE
        $pdf->SetFont('helvetica', 'B', '8');
        $pdf->MultiCell(25, 5, "CONTRATANTE:", 0, 'L', 0, 0, '', '', true);
        $pdf->SetFont('helvetica', '', '8');
        //$contratante = $info['tipocontrato'] == "OCASIONAL" ? $info['nomContratante'] : $info['']
        $pdf->MultiCell(120, 5, $info['nomContratante'], 0, 'L', 0, 0, '', '', true);
        # NIT/CC
        $pdf->SetFont('helvetica', 'B', '8');
        $pdf->MultiCell(13, 5, "NIT/CC:", 0, 'L', 0, 0, '', '', true);
        $pdf->SetFont('helvetica', '', '8');
        $pdf->MultiCell(25, 5, $info['docContratante'], 0, 'L', 0, 0, '', '', true);
        $pdf->Ln();

        # OBJETO CONTRATO
        if ($info['anotObjetoContrato'] == null || $info['anotObjetoContrato'] == ""){
            $objetoContrato = $info['objetocontrato'];
        }
        else{
            $objetoContrato = $info['objetocontrato'] . " - " . $info['anotObjetoContrato'];
        }
        $pdf->SetFont('helvetica', 'B', '8');
        $pdf->MultiCell(32, 5, "OBJETO CONTRATO:", 0, 'L', 0, 0, '', '', true);
        $pdf->SetFont('helvetica', '', '8');
        $pdf->MultiCell(160, 5, $objetoContrato, 0, 'L', 0, 0, '', '', true);
        $pdf->Ln();

        # ORIGEN - DESTINO
        $pdf->SetFont('helvetica', 'B', '8');
        $pdf->MultiCell(30, 5, "ORIGEN - DESTINO:", 0, 'L', 0, 0, '', '', true);
        $pdf->SetFont('helvetica', '', '8');
        $pdf->MultiCell(160, 5, $info['origen'] . ' - ' . $info['destino'], 0, 'L', 0, 0, '', '', true);
        $pdf->Ln();

        # OBSERVACIONES DEL CONTRATO
        $pdf->SetFont('helvetica', 'B', '8');
        $pdf->MultiCell(52, 5, "OBSERVACIONES DEL CONTRATO:", 0, 'L', 0, 0, '', '', true);
        $pdf->SetFont('helvetica', '', '8');
        $pdf->MultiCell(140, 5, $info['observaciones'], 0, 'L', 0, 0, '', '', true);
        $pdf->Ln();

        # CONVENIO DE COLABORACIÓN EMPRESARIAL CON
        $pdf->SetFont('helvetica', 'B', '8');
        $pdf->MultiCell(77, 5, "CONVENIO DE COLABORACIÓN EMPRESARIAL CON:", 0, 'L', 0, 0, '', '', true);
        $pdf->SetFont('helvetica', '', '8');
        $pdf->MultiCell(110, 5, $info['nomconvenio'], 0, 'L', 0, 0, '', '', true);
        $pdf->Ln();

        /* ===================================================
            VIGENCIA DEL CONTRATO
        ===================================================*/
        $pdf->SetFont('helvetica', 'B', '8');
        $pdf->MultiCell(130, 5, 'VIGENCIA DEL CONTRATO:', 0, 'C', 0, 1, $x, '', true);
        # TABLA
        $tabla = '
                <table cellspacing="0" cellpadding="10" border="1">
                    <tbody>
                        <tr>
                            <th style="color:#000 ;font-weight:bold;">FECHA INICIAL:</th>
                            <td style="text-align: center; font-size:9px"><span style="font-weight:bold; font-size:10px">DÍA:</span><br>' . date('d', strtotime($info['fecha_inicial']))  . '</td>
                            <td style="text-align: center; font-size:9px"><span style="font-weight:bold; font-size:10px">MES:</span><br>' . date('m', strtotime($info['fecha_inicial']))  . '</td>
                            <td style="text-align: center; font-size:9px"><span style="font-weight:bold; font-size:10px">AÑO:</span><br>' . date('Y', strtotime($info['fecha_inicial']))  . '</td>
                        </tr>
                        <tr>
                            <th style="color:#000 ;font-weight:bold;">FECHA VENCIMIENTO:</th>
                            <td style="text-align: center; font-size:9px">' . date('d', strtotime($info['fecha_vencimiento']))  . '</td>
                            <td style="text-align: center; font-size:9px">' . date('m', strtotime($info['fecha_vencimiento']))  . '</td>
                            <td style="text-align: center; font-size:9px">' . date('Y', strtotime($info['fecha_vencimiento']))  . '</td>
                        </tr>
                    </tbody>
                </table>
        ';
        $pdf->SetFont('helvetica', '', '8');
        $pdf->writeHTML($tabla);

        /* ===================================================
            CARACTERÍSTICAS DEL VEHÍCULO
        ===================================================*/
        $pdf->SetFont('helvetica', 'B', '8');
        $pdf->MultiCell(130, 5, 'CARACTERÍSTICAS DEL VEHÍCULO:', 0, 'C', 0, 1, $x, '', true);
        # TABLA
        $tabla = '
            <table cellspacing="0" cellpadding="6">
                <tbody>
                    <tr style="text-align: center; font-weight:bold;">
                        <td colspan="2" border="1" style="font-size:9px">PLACA</td>
                        <td border="1" style="font-size:9px">MODELO</td>
                        <td colspan="2" border="1" style="font-size:9px">MARCA</td>
                        <td colspan="2" border="1" style="font-size:9px">CLASE</td>
                    </tr>
                    <tr style="text-align: center">
                        <td colspan="2" border="1">' . $info['placa'] . '</td>
                        <td border="1">' . $info['modelo'] . '</td>
                        <td colspan="2" border="1">' . $info['marca'] . '</td>
                        <td colspan="2" border="1">' . $info['tipovehiculo'] . '</td>
                    </tr>
                    <tr style="text-align: center; font-weight:bold;">
                        <td colspan="3" border="1">NÚMERO INTERNO</td>
                        <td colspan="4" border="1">NÚMERO TARJETA DE OPERACIÓN</td>
                    </tr>
                    <tr style="text-align: center;">
                        <td colspan="3" border="1">' . $info['numinterno'] . '</td>
                        <td colspan="4" border="1">' . $info['tarjetaOperacion'] . '</td>
                    </tr>
                    <tr>
                        <td style="font-weight:bold; font-size:9px" border="1">DATOS DEL CONDUCTOR 1</td>
                        <td colspan="2" border="1" style="font-size:9px"><span style="font-weight:bold;">NOMBRES Y APELLIDOS:</span><br>' . $info['conductor1'] . '</td>
                        <td border="1"><span style="font-weight:bold; font-size:9px">NRO. CÉDULA</span><br>' . $info['docConductor1'] . '</td>
                        <td colspan="2" border="1" style="font-size:9px"><span style="font-weight:bold;">NRO. LICENCIA CONDUCCIÓN</span><br>' . $info['licencia1'] . '</td>
                        <td border="1"><span style="font-weight:bold; font-size:9px">VIGENCIA</span><br>' . date("d/m/Y", strtotime($info['vigenciaLic1'])) . '</td>
                    </tr>
                    <tr>
                        <td style="font-weight:bold; font-size:9px" border="1">DATOS DEL CONDUCTOR 2</td>
                        <td colspan="2" border="1" style="font-size:9px"><span style="font-weight:bold;">NOMBRES Y APELLIDOS:</span><br>' . $info['conductor2'] . '</td>
                        <td border="1"><span style="font-weight:bold; font-size:9px">NRO. CÉDULA</span><br>' . $info['docConductor2'] . '</td>
                        <td colspan="2" border="1" style="font-size:9px"><span style="font-weight:bold;">NRO. LICENCIA CONDUCCIÓN</span><br>' . $info['licencia2'] . '</td>
                        <td border="1"><span style="font-weight:bold; font-size:9px">VIGENCIA</span><br>' . date("d/m/Y", strtotime($info['vigenciaLic2'])) . '</td>
                    </tr>
                    <tr>
                        <td style="font-weight:bold; font-size:9px;" border="1">DATOS DEL CONDUCTOR 3</td>
                        <td colspan="2" border="1" style="font-size:9px"><span style="font-weight:bold;">NOMBRES Y APELLIDOS:</span><br>' . $info['conductor3'] . '</td>
                        <td border="1"><span style="font-weight:bold; font-size:9px">NRO. CÉDULA</span><br>' . $info['docConductor3'] . '</td>
                        <td colspan="2" border="1" style="font-size:9px"><span style="font-weight:bold;">NRO. LICENCIA CONDUCCIÓN</span><br>' . $info['licencia3'] . '</td>
                        <td border="1"><span style="font-weight:bold; font-size:9px">VIGENCIA</span><br>' . date("d/m/Y", strtotime($info['vigenciaLic3'])) . '</td>
                    </tr>
                    <tr>
                        <td style="font-weight:bold; font-size:9px" border="1">RESPONSABLE DEL CONTRATANTE</td>
                        <td colspan="2" border="1" style="font-size:9px"><span style="font-weight:bold;">NOMBRES Y APELLIDOS:</span><br>' . $info['nombrerespons'] . '</td>
                        <td border="1"><span style="font-weight:bold; font-size:9px">NRO. CÉDULA</span><br>' . $info['Documentorespons'] . '</td>
                        <td border="1"><span style="font-weight:bold; font-size:9px">TELÉFONO</span><br>' . $info['telrespons'] . '</td>
                        <td colspan="2" border="1" style="font-size:9px"><span style="font-weight:bold;">DIRECCIÓN</span><br>' . $info['direccion'] . '</td>
                    </tr>
                    <tr>
                        <td rowspan="2" colspan="3" style="font-weight:bold; border-bottom: 1px solid #000000; border-left: 1px solid  #000000;"><br><br>PBX: 872 21 80 - 313 6305866<br>AV CENTENARIO 24   47   LC 102 Manizales - Caldas<br>comercial@elsaman.com.co<br>www.elsaman.com.co</td>
                        <td rowspan="2" style="border-bottom: 1px solid #000000; border-right: 1px solid  #000000"><br><br><img src="' . $image_mintransporte . '"  width="81" height="55"></td>
                        <td colspan="3" style="text-align: center; border-right: 1px solid #000000;"><img src="' . $image_firma . '"  width="112" height="60"></td>
                    </tr>
                    <tr>
                        <td colspan="3" style="text-align: center; font-weight:bold; border-right: 1px solid #000000; border-bottom: 1px solid #000000;">Representante legal<br>Firma digital amparada por ley 527 de 1999 y<br>Decreto 2364 de 2012</td>
                    </tr>
                    
                </tbody>
            </table>
        ';
        $pdf->SetFont('helvetica', '', '8');
        $pdf->writeHTML($tabla);

        /* ===================================================
           INSTRUCTIVO PARA CONSECUTIVO DEL FUEC
        ===================================================*/
        $pdf->SetMargins(25, 25, 25, true);
        $pdf->AddPage();
        $pdf->SetFont('helvetica', 'B', '8');
        $pdf->MultiCell(130, 5, 'INSTRUCTIVO PARA DETERMINACIÓN DEL NÚMERO CONSECUTIVO DEL FUEC', 0, 'C', 0, 1, $x, '', true);
        $pdf->Ln();

        // $pdf->SetFont('helvetica', '', '8');
        // $pdf->Cell(20, 0.5, 'El Formato Único de Extracto del Contrato "FUEC" estará constituido por los siguientes números: ', 0, 1, 'L');

        $pdf->SetFont('helvetica', '', '7');
        $htmlInstructivo = 'El Formato Único de Extracto del Contrato "FUEC" estará constituido por los siguientes números:
                            <ol type="a">
                                <li> Los tres primeros dígitos de izquierda a derecha corresponderán al código de la Dirección Territorial que otorgó la habilitación o de aquella a la cual se hubiera trasladado la empresa de Servicio Público de Transporte Terrestre Automotor Especial;
                                    <br>
                                    <img src="' . $image_codigos . '" alt="test alt attribute" width="463" height="140">
                                </li>
                                <br>
                                <li> Los cuatro números siguientes señalarán el número de la resolución mediante la cual se otorgó la habilitación de la empresa. En caso que la resolución no tenga estos dígitos, los faltantes serán completados con ceros a la izquierda;</li>
                                <br>
                                <li> Los dos siguientes dígitos, corresponderán a los dos últimos del año en que la empresa fue habilitada;</li>
                                <br>
                                <li> A continuación, cuatro dígitos que corresponderán al año en el que se expide el extracto del contrato; </li>
                                <br>
                                <li> Posteriormente, cuatro dígitos que identifican el número del contrato. La numeración de los contratos debe ser consecutiva, establecida por cada empresa  y continuará con la numeración dada a los contratos de prestación del servicio celebrados para el transporte de estudiantes, empleados, turistas, usuarios del servicio de salud y grupos específicos de usuarios, en vigencia de la resolución 3068 de 2014.</li>
                                <br>
                                <li> Finalmente, los cuatro últimos dígitos corresponderán al número consecutivo del extracto de contrato que se expida para la ejecución de cada contrato. Se debe expedir un nuevo extracto por vencimiento del plazo inicial del mismo o por cambio del vehículo.</li>
                            </ol>
                            <br>';
        $pdf->writeHTML($htmlInstructivo);
        # EJEMPLO
        $pdf->SetFont('helvetica', 'B', '8');
        $pdf->Cell(20, 0.5, 'EJEMPLO:', 0, 1, 'L');
        $pdf->Ln();
        $pdf->SetFont('helvetica', '', '8');
        $pdf->MultiCell(160, 5, 'Empresa habilitada por la Dirección Territorial Cundinamarca en el año 2012, con resolución de habilitación número 0155, que expide el primer extracto del contrato en el año 2015, del contrato número 255. El número del Formato Único de Extracto del Contrato "FUEC" será 425015512201502550001.', 0, 'L', 0, 0, '', '', true);
        $pdf->Ln(20);

        # NOTA
        $pdf->MultiCell(160, 10, 'NOTA: El vehículo se encuentra en perfecto estado mecánico y de aseo.', $complex_cell_border_top, 'L', 0, 0, '', '', true);
        $pdf->Ln();

        $pdf->Image($image_ponal, '', '', 26, 20,  'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        $x = $pdf->GetX() + 5;
        $pdf->MultiCell(129, 5, 'Para su autenticidad de esta planilla consultar la página web ' . $empresa['sitio_web'] . 'busqueda-fuec o escanear el código QR de la parte superior de este documento e ingresando el siguiente código: ' . $info['idfuec'], 0, 'L', 0, 0, $x, '', true);
        $pdf->Ln();


        $y = $pdf->GetY() + 20;
        $pdf->MultiCell(160, 5, 'En desarrollo de lo dispuesto al Artículo 17 de la Ley 679 del 2001, Empresa de trans Especiales El Saman s.a.s advierte al viajero que la explotación y abuso sexual de niños, niñas y adolecentes en el país son sancionados penalmente conforme a las leyes vigentes.', 0, 'L', 0, 0, '', $y, true);
        //$pdf->SetXY(120, 85);




        // ---------------------------------------------------------

        // Close and output PDF document
        // This method has several options, check the source code documentation for more information.
        $pdf->Output('FUEC', 'I');

        //============================================================+
        // END OF FILE
        //============================================================+
    }
}

# SE INSTANCIA LA CLASE PARA LA GENERACION DEL ARCHIVO PDF
PdfFuec::makePDF($resultado, $empresa);
