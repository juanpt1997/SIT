<?php

# IMPORTAMOS LA CONFIGURACION DE LA SESSION
include '../config.php';

# REQUERIMOS EL CONTROLADOR Y EL MODELO PARA QUE REALICE LA PETICION
require_once '../controllers/fuec.controlador.php';
require_once '../models/fuec.modelo.php';

require_once '../controllers/vehicular.controlador.php';
require_once '../models/vehicular.modelo.php';


if (!isset($_SESSION['iniciarSesion']) || $_SESSION['iniciarSesion'] != "ok"){
	echo "<script>window.location = 'inicio';</script>";
	die();
}

/* ===================================================
   * FUEC
===================================================*/
class AjaxFuec
{
    /* ===================================================
       DATOS DEL FUEC
    ===================================================*/
    static public function ajaxDatosFUEC($item, $valor)
    {
        $FUEC = ControladorFuec::ctrDatosFUEC($item, $valor);
        echo json_encode($FUEC);
    }

    /* ===================================================
       VERIFICAR SI EL VEHICULO NO TIENE BLOQUEOS NI DOCUMENTOS VENCIDOS
    ===================================================*/
    static public function ajaxVehiculoDisponible($idvehiculo)
    {
        # Documentos vencidos, esta consulta en realidad trae todos los documentos que puede tener un vehiculo (sin repetir) sin importar si está vencido o no
        $documentosVencidos = ControladorFuec::ctrDocumentosVencidos($idvehiculo);
        $arrayVencidos = array();
        foreach ($documentosVencidos as $key => $documento) {
            if ($documento['fechafin'] == null){
                $arrayVencidos[] = $documento;
            }
        }

        # Bloqueo vehículo
        $bloqueoVehiculo = ModeloBloqueoV::mdlUltimoBloqueoV($idvehiculo);
        if ($bloqueoVehiculo !== false){
            $bloqueado = $bloqueoVehiculo['estado'] == 0 ? $bloqueoVehiculo : "NO";
        }else{
            $bloqueado = "NO";
        }

        $respuestaArray = array('Bloqueo' => $bloqueado, 
                                'DocumentosVencidos' => $arrayVencidos);
        
        echo json_encode($respuestaArray);

    }

    /* ===================================================
       LISTA CONDUCTORES
    ===================================================*/
    static public function AjaxListaConductores($idvehiculo)
    {
        $respuesta = ControladorVehiculos::ctrConductoresxVehiculo($idvehiculo);
        echo json_encode($respuesta);
    }

    /* ===================================================
       VERIFICAR SI EL CONDUCTOR NO TIENE BLOQUEOS, SI HA PAGADO SEGURIDAD SOCIAL Y SI TIENE LA LICENCIA ACTIVA
    ===================================================*/
    static public function ajaxConductorDisponible($idconductor)
    {
        # Bloqueo conductor
        $bloqueoConductor = ModeloBloqueoP::mdlUltimoBloqueo($idconductor);
        if ($bloqueoConductor !== false){
            $bloqueado = $bloqueoConductor['estado'] == 0 ? $bloqueoConductor : "NO";
        }else{
            $bloqueado = "NO";
        }

        # Pago Seguridad social
        $ConductorPagoSS = ControladorFuec::ctrConductorPagoSS($idconductor);
        if ($ConductorPagoSS !== false){
            $pagoSS = $ConductorPagoSS['pago'] == "S" ? "SI" : "NO";
        }else{
            $pagoSS = "NO";
        }

        # Licencia activa
        $FechaLicencia = ControladorFuec::ctrConductorLicencia($idconductor);
        $licenciaActiva = $FechaLicencia['fecha_vencimiento'] != null ? "SI" : "NO";
        $respuestaArray = array('Bloqueo' => $bloqueado,
                                'PagoSS' => $pagoSS,
                                'LicenciaActiva' => $licenciaActiva);
        
        echo json_encode($respuestaArray);

    }

    /* ===================================================
       GUARDAR DATOS DEL FUEC
    ===================================================*/
    static public function ajaxGuardarFUEC($formData)
    {
        $respuesta = ControladorFuec::ctrGuardarFUEC($formData);
        echo $respuesta;
    }
}
/* ===================================================
   # LLAMADOS A AJAX FUEC
===================================================*/
if (isset($_POST['DatosFUEC']) && $_POST['DatosFUEC'] == "ok") {
    AjaxFuec::ajaxDatosFUEC($_POST['item'], $_POST['valor']);
}

if (isset($_POST['VehiculoDisponible']) && $_POST['VehiculoDisponible'] == "ok") {
   AjaxFuec::ajaxVehiculoDisponible($_POST['idvehiculo']);
}

if (isset($_POST['ListaConductores']) && $_POST['ListaConductores'] == "ok") {
   AjaxFuec::AjaxListaConductores($_POST['idvehiculo']);
}

if (isset($_POST['ConductorDisponible']) && $_POST['ConductorDisponible'] == "ok") {
   AjaxFuec::ajaxConductorDisponible($_POST['idconductor']);
}

if (isset($_POST['GuardarFUEC']) && $_POST['GuardarFUEC'] == "ok") {
    // $tarjetapropiedad = isset($_FILES['tarjetapropiedad']) ? $_FILES['tarjetapropiedad'] : "";
    // $foto_vehiculo = isset($_FILES['foto_vehiculo']) ? $_FILES['foto_vehiculo'] : "";
    AjaxFuec::ajaxGuardarFUEC($_POST);
}