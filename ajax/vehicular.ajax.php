<?php
# IMPORTAMOS LA CONFIGURACION DE LA SESSION Y DE LAS VARIABLES GLOBALES
include '../config.php';

# REQUERIMOS EL CONTROLADOR Y EL MODELO PARA QUE REALICE LA PETICION
require_once '../controllers/files.controlador.php';
require_once '../controllers/vehicular.controlador.php';
require_once '../models/vehicular.modelo.php';

/* ===================================================
   * PROPIETARIOS
===================================================*/
class AjaxPropietarios
{
	
	static public function ajaxDatosPropietarios($cedula)
	{
		$respuesta = ModeloPropietarios::mdlMostrar($cedula);
		echo json_encode($respuesta);
	}
}

/* ===================================================
   * CONVENIOS
===================================================*/
class AjaxConvenios
{	
	static public function ajaxDatosConvenios($nit)
	{
		$respuesta = ModeloConvenios::mdlMostrar($nit);
		echo json_encode($respuesta);
	}
}

/* ===================================================
   * BLOQUEO DE PERSONAL 
===================================================*/
class AjaxBloqueoPersonal 
{
	static public function ajaxHistorial($id)
	{
		$respuesta = ControladorBloqueos::ctrHIstorial($id);
        $tr = "";
        foreach ($respuesta as $key => $value) {

            
            if( $value['estado'] == 1){

                $estado = "Desbloqueado";

            } else {

                $estado = "Bloqueado";
            }

                                             

        	$tr .= "
                <tr>
                    <td>" . $value['idbloqueo'] . "</td>
                    <td>" . $value['conductor'] . "</td>
                    <td>" . $value['motivo'] . "</td>
                    <td><b>" . $estado . "</b></td>
                    <td>" . $value['fecha'] . "</td>
                    <td>" . $value['nomUsuario'] . "</td>
                </tr>
            ";
        }

        echo $tr;
	}

    static public function ajaxMostrarConductor($id)
    {
        $respuesta = ControladorBloqueos::ctrMostrarConductor($id);
        echo json_encode($respuesta);
    }

    static public function ajaxDatosBloqueo($idpersonal)
    {
        $respuesta = ModeloBloqueoP::mdlUltimoBloqueo($idpersonal);
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
    static public function ajaxGuardarVehiculo($formData, $tarjetapropiedad, $foto_vehiculo)
    {
        $respuesta = ControladorVehiculos::ctrGuardarVehiculo($formData, $tarjetapropiedad, $foto_vehiculo);
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

# LLAMADOS A AJAX BLOQUEO PERSONAL
if (isset($_POST['ajaxHistorial']) && $_POST['ajaxHistorial'] == "ok") {
    AjaxBloqueoPersonal::ajaxHistorial($_POST['idPersonal']);
}

if (isset($_POST['ajaxMostrarConductor']) && $_POST['ajaxMostrarConductor'] == "ok") {
    AjaxBloqueoPersonal::ajaxMostrarConductor($_POST['idPersonal']);
}

if (isset($_POST['DatosBloqueo']) && $_POST['DatosBloqueo'] == "ok") {
    AjaxBloqueoPersonal::ajaxDatosBloqueo($_POST['idPersonal']);
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