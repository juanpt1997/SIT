<?php
# IMPORTAMOS LA CONFIGURACION DE LA SESSION Y DE LAS VARIABLES GLOBALES
include '../config.php';

# REQUERIMOS EL CONTROLADOR Y EL MODELO PARA QUE REALICE LA PETICION
require_once '../controllers/files.controlador.php';
require_once '../controllers/vehicular.controlador.php';
require_once '../models/vehicular.modelo.php';

/**
 * 
 */
class AjaxPropietarios
{
	
	static public function ajaxDatosPropietarios($cedula)
	{
		$respuesta = ModeloPropietarios::mdlMostrar($cedula);
		echo json_encode($respuesta);
	}
}

class AjaxConvenios
{	
	static public function ajaxDatosConvenios($nit)
	{
		$respuesta = ModeloConvenios::mdlMostrar($nit);
		echo json_encode($respuesta);
	}
}

/* ===================================================
   * VEHICULOS
===================================================*/
class AjaxVehiculos
{
	/* ===================================================
       CARGAR DATOS DEL VEHICULO
    ===================================================*/
    static public function ajaxDatosVehiculo($item, $valor)
    {
        $datosVehiculo = ControladorVehiculos::ctrDatosVehiculo($item, $valor);
        $fotosVehiculo = ControladorVehiculos::ctrFotosVehiculo($item, $valor);
        $datos = [
            'datosVehiculo' => $datosVehiculo,
            'fotosVehiculo' => $fotosVehiculo
        ];
        echo json_encode($datos);
    }

	/* ===================================================
       GUARDAR DATOS DEL VEHICULO
    ===================================================*/
    static public function ajaxGuardarVehiculo($formData, $tarjetapropiedad, $foto_vehiculo)
    {
        $respuesta = ControladorVehiculos::ctrGuardarVehiculo($formData, $tarjetapropiedad, $foto_vehiculo);
        echo $respuesta;
    }

	/* ===================================================
       ELIMINAR UNA FOTO DEL VEHICULO
    ===================================================*/
    static public function ajaxEliminarFotoVehiculo($idfoto)
    {
        $datos = array(
            'tabla' => "v_fotosvehiculos",
            'item' => "idfoto",
            'valor' => $idfoto
        );
        $respuesta = ControladorVehiculos::ctrEliminarRegistro($datos);
        echo $respuesta;
    }
}



# LLAMADOS A AJAX PROPIETARIOS
if (isset($_POST['DatosPropietarios']) && $_POST['DatosPropietarios'] == "ok"){
	AjaxPropietarios::ajaxDatosPropietarios($_POST['value']);
}
# LLAMADOS A AJAX CONVENIOS
if (isset($_POST['DatosConvenios']) && $_POST['DatosConvenios'] == "ok"){
	AjaxConvenios::ajaxDatosConvenios($_POST['value']);
}

# LLAMADOS A AJAX VEHICULOS
if (isset($_POST['GuardarVehiculo']) && $_POST['GuardarVehiculo'] == "ok") {
    $tarjetapropiedad = isset($_FILES['tarjetapropiedad']) ? $_FILES['tarjetapropiedad'] : "";
    $foto_vehiculo = isset($_FILES['foto_vehiculo']) ? $_FILES['foto_vehiculo'] : "";
    AjaxVehiculos::ajaxGuardarVehiculo($_POST, $tarjetapropiedad, $foto_vehiculo);
}

if (isset($_POST['DatosVehiculo']) && $_POST['DatosVehiculo'] == "ok") {
    AjaxVehiculos::ajaxDatosVehiculo($_POST['item'], $_POST['valor']);
}

if (isset($_POST['EliminarFotoVehiculo']) && $_POST['EliminarFotoVehiculo'] == "ok") {
    AjaxVehiculos::ajaxEliminarFotoVehiculo($_POST['idfoto']);
}