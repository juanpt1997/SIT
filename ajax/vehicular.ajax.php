<?php
# IMPORTAMOS LA CONFIGURACION DE LA SESSION Y DE LAS VARIABLES GLOBALES
include '../config.php';

# REQUERIMOS EL CONTROLADOR Y EL MODELO PARA QUE REALICE LA PETICION
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
        $respuesta = ControladorVehiculos::ctrDatosVehiculo($item, $valor);
        echo json_encode($respuesta);
    }

	/* ===================================================
       GUARDAR DATOS DEL VEHICULO
    ===================================================*/
    static public function ajaxGuardarVehiculo($formData)
    {
        $respuesta = ControladorVehiculos::ctrGuardarVehiculo($formData);
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
    AjaxVehiculos::ajaxGuardarVehiculo($_POST);
}

if (isset($_POST['DatosVehiculo']) && $_POST['DatosVehiculo'] == "ok") {
    AjaxVehiculos::ajaxDatosVehiculo($_POST['item'], $_POST['valor']);
}