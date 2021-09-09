<?php

# IMPORTAMOS LA CONFIGURACION DE LA SESSION
include '../config/config.php';

# REQUERIMOS EL CONTROLADOR Y EL MODELO PARA QUE REALICE LA PETICION
require_once '../controllers/files.controlador.php';
require_once '../controllers/mantenimiento.controlador.php';
require_once '../models/mantenimiento.modelo.php';
require_once '../models/vehicular.modelo.php';
require_once '../models/conceptos.modelo.php';

if (!isset($_SESSION['iniciarSesion']) || $_SESSION['iniciarSesion'] != "ok"){
	echo "<script>window.location = 'inicio';</script>";
	die();
}

/* ===================================================
   * PROTOCOLO DE ALISTAMIENTO
===================================================*/
class AjaxAlistamiento
{
    /* ===================================================
       TABLA PROTOCOLO DE ALISTAMIENTO
    ===================================================*/
    static public function ajaxTablaAlistamiento()
    {
        # code...
    }

    /* ===================================================
       GUARDAR DATOS DEL ALISTAMIENTO
    ===================================================*/
    static public function ajaxGuardarAlistamiento($formData)
    {
        $respuesta = ControladorAlistamiento::ctrGuardarAlistamiento($formData);
        echo $respuesta;
        //echo json_encode($respuesta);
    }

    /* ===================================================
        TABLA DE EVIDENCIAS
    ===================================================*/
    static public function ajaxTablaEvidencias($idvehiculo)
    {
        $Respuesta = ControladorAlistamiento::ctrListaEvidencias($idvehiculo);
        $tr = "";
        foreach ($Respuesta as $key => $value) {
            $btnEditar = "<button type='button' class='btn btn-info btn-sm m-1 btn-editarRegistro' idregistro='{$value['idevidencia']}' idvehiculo='{$value['idvehiculo']}'><i class='fas fa-edit'></i></button>";
            $btnEliminar = "<button type='button' class='btn btn-danger btn-sm m-1 eliminarRegistro' idregistro='{$value['idevidencia']}' idvehiculo='{$value['idvehiculo']}'><i class='fas fa-trash-alt'></i></button>";
            $botonAcciones = "<div class='row d-flex flex-nowrap justify-content-center'>" . $btnEditar . $btnEliminar . "</div>";

            $tr .= "
                <tr>
                        <td>" . $value['fecha'] . "</td>
                        <td>" . $value['ruta_foto'] . "</td>
                        <td>" . $value['observaciones'] . "</td>
                        <td>" . $value['estado'] . "</td>
                        <td>" . $value['autor'] . "</td>
                </tr>
            ";
        }

        echo $tr;
    }
}

class AjaxProveedores
{
    static public function ajaxDatosProveedor($documento)
    {
        $respuesta = ModeloProveedores::mdlListarProveedores($documento);
        echo json_encode($respuesta);
    }

    static public function ajaxEliminarProveedor($id)
    {
        $datos = array(
			"tabla" => "m_proveedores",
			"item" => "estado",
			"valor" => "0",
			"id_tabla" => "id",
			"id" => $id
		);

        $respuesta = ModeloConceptosGH::mdlEliminar($datos);
		echo $respuesta;
    }
}

#Llamados ajax alistamiento
if (isset($_POST['TablaEvidencias']) && $_POST['TablaEvidencias'] == "ok") {
    AjaxAlistamiento::ajaxTablaEvidencias($_POST['idvehiculo']);
}

if (isset($_POST['GuardarAlistamiento']) && $_POST['GuardarAlistamiento'] == "ok") {
    AjaxAlistamiento::ajaxGuardarAlistamiento($_POST);
}

#Llamados ajax proveedores
if (isset($_POST['DatosProveedor']) && $_POST['DatosProveedor'] == "ok") {
    AjaxProveedores::ajaxDatosProveedor($_POST['documento']);
}

if (isset($_POST['EliminarProveedor']) && $_POST['EliminarProveedor'] == "ok") {
    AjaxProveedores::ajaxEliminarProveedor($_POST['id']);
}


