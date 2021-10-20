<?php
# IMPORTAMOS LA CONFIGURACION DE LA SESSION
include '../config/config.php';
# REQUERIMOS EL CONTROLADOR Y EL MODELO PARA QUE REALICE LA PETICION
require_once '../controllers/files.controlador.php';
require_once '../controllers/mantenimiento.controlador.php';
require_once '../models/mantenimiento.modelo.php';
require_once '../controllers/vehicular.controlador.php';
require_once '../models/vehicular.modelo.php';
require_once '../models/conceptos.modelo.php';

if (!isset($_SESSION['iniciarSesion']) || $_SESSION['iniciarSesion'] != "ok") {
    echo "<script>window.location = 'inicio';</script>";
    die();
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

class AjaxInventario
{
    static public function ajaxLicenciaxVehiculo($idconductor)
    {
        $respuesta = ModeloInventario::mdlLicenciaConductor($idconductor);
        echo json_encode($respuesta);
    }

    static public function ajaxDatosInventario($documento)
    {
        $respuesta = ModeloInventario::mdlListarInventario($documento);
        echo json_encode($respuesta);
    }

    static public function ajaxGuardarEvidencias($formData, $imagen)
    {
        $response = "";

        $vehiculo = ControladorVehiculos::ctrDatosVehiculo("idvehiculo", $formData['idvehiculo']);

        /* ===================== 
            CREAMOS DIRECTORIO DONDE VAMOS A GUARDAR EL ARCHIVO
        ========================= */
        # Verificar Directorio imagenes mantenimiento
        $directorio = DIR_APP . "views/img/imgMantenimiento";
        if (!is_dir($directorio)) {
            mkdir($directorio, 0755);
        }

        # Verificar Directorio Evidencias
        $directorio .= "/evidenciasInventario";
        if (!is_dir($directorio)) {
            mkdir($directorio, 0755);
        }

        # Verificar Directorio vehículo
        $directorio .= "/{$vehiculo['placa']}";
        if (!is_dir($directorio)) {
            mkdir($directorio, 0755);
        }

        $fecha = date('Y-m-d');
        $hora = date('His');

        /* ===================================================
            GUARDAMOS EL ARCHIVO
        ===================================================*/
        $GuardarArchivo = new FilesController();
        $GuardarArchivo->file = $imagen;
        $aleatorio = mt_rand(100, 999);
        $GuardarArchivo->ruta = $directorio . "/{$aleatorio}_{$fecha}_{$hora}";

        # Si es pdf
        if ($imagen['type'] == "application/pdf") {
            $response = $GuardarArchivo->ctrPDFFiles();
        } else {
            # Si es una imagen
            if ($imagen['type'] == "image/jpeg" || $imagen['type'] == "image/png") {
                $response = $GuardarArchivo->ctrImages(null, null);
            }
        }

        # Actualizar el campo de la base de datos donde queda la ruta del archivo
        if ($response != "") {
            $rutaDoc = str_replace(DIR_APP, "", $response);

            //$actualizarRutaDoc = ModeloVehiculos::mdlActualizarVehiculo($datosRutaDoc);
            $datos = array(
                'idvehiculo' => $formData['idvehiculo'],
                'ruta_foto' => $rutaDoc,
                'observaciones' => $formData['observaciones'],
                'autor' => $_SESSION['cedula']
            );

            $guardarEvidencia = ModeloInventario::mdlGuardarEvidencia($datos);

            echo $guardarEvidencia;
        } else {
            echo "error";
        }
    }

    static public function ajaxTablaFotosVehiculo($idvehiculo)
    {
        $Respuesta = ControladorInventario::ctrListaEvidencias($idvehiculo);
        $tr = "";

        foreach ($Respuesta as $key => $value) {
            # Foto
            if ($value['ruta_foto'] != null) {
                $btnVerDoc = "<a href='" . URL_APP . $value['ruta_foto'] . "' target='_blank' class='btn btn-sm btn-info m-1' type='button'><i class='fas fa-file-alt'></i></a>";
            } else {
                $btnVerDoc = "";
            }

            # Botones
            // $btnEditar = "<button type='button' class='btn btn-info btn-sm m-1 btn-editarRegistro' idregistro='{$value['idevidencia']}' idvehiculo='{$value['idvehiculo']}'><i class='fas fa-edit'></i></button>";
            // $btnEliminar = "<button type='button' class='btn btn-danger btn-sm m-1 eliminarRegistro' idregistro='{$value['idevidencia']}' idvehiculo='{$value['idvehiculo']}'><i class='fas fa-trash-alt'></i></button>";
            // $botonAcciones = "<div class='row d-flex flex-nowrap justify-content-center'>" . $btnEditar . $btnEliminar . "</div>";

            # Estado
            $colorEstado = $value['estado'] == 'PENDIENTE' ? "danger" : "success";
            $iconoEstado = $value['estado'] == 'PENDIENTE' ? "far fa-clock" : "fas fa-check-circle";

            /* Permiso de usuario */
            //if (validarPermiso('M_OPERACIONES', 'U')) {
                $estado = '<button class="btn btn-sm btn-estado btn-' . $colorEstado . ' font-weight-bold" idevidencia="' . $value["idevidencia"] . '" idvehiculo="' . $idvehiculo . '" estado="' . $value["estado"] . '"><i class="' . $iconoEstado . '"></i> ' . $value["estado"] . '</button>';
            //} else {
            //    $estado = '<button class="btn btn-sm btn-' . $colorEstado . ' font-weight-bold"><i class="' . $iconoEstado . '"></i> ' . $value["estado"] . '</button>';
            //}

            //<td>" . $value['autor'] . "</td>
            
            $tr .= "
            <tr>
            <td>" . $value['fecha'] . "</td>
            <td>" . $btnVerDoc . "</td>
            <td id='obs_" . $value["idevidencia"] . "'>" . $value['observaciones'] . "</td>
            <td>" . $estado . "</td>
            </tr>
            ";
        }

        echo $tr;
    }

    static public function ajaxActualizaEstado($idevidencia, $estadoActual, $observaciones)
    {
        $respuesta = ControladorInventario::ctrActualizarEstado($idevidencia, $estadoActual, $observaciones);
        echo $respuesta;
    }

    static public function ajaxEliminarInventario($idvehiculo)
    {
        $respuesta = ModeloInventario::mdlEliminarInventario($idvehiculo);
        echo $respuesta;
    }
}

class AjaxRevision
{
    static public function ajaxDatosVehiculo($idvehiculo)
    {
        $respuesta = ControladorVehiculos::ctrDatosVehiculo("idvehiculo", $idvehiculo);
        echo json_encode($respuesta);
    }

    // static public function ajaxDatosRevision($idrevision)
    // {
    //     $respuesta = ControladorRevision::ctrRevisionxid($idrevision);
    //     echo json_encode($respuesta);
    // }
}
/* ===================================================
            LLAMADOS AJAX PROVEEDORES
====================================================*/
if (isset($_POST['DatosProveedor']) && $_POST['DatosProveedor'] == "ok") {
    AjaxProveedores::ajaxDatosProveedor($_POST['documento']);
}

if (isset($_POST['EliminarProveedor']) && $_POST['EliminarProveedor'] == "ok") {
    AjaxProveedores::ajaxEliminarProveedor($_POST['id']);
}

/* ===================================================
            LLAMADOS AJAX INVENTARIO
====================================================*/
if (isset($_POST['LicenciasxVehiculo']) && $_POST['LicenciasxVehiculo'] == "ok") {
    AjaxInventario::ajaxLicenciaxVehiculo($_POST['idconductor']);
}

if (isset($_POST['DatosInventario']) && $_POST['DatosInventario'] == "ok") {
    AjaxInventario::ajaxDatosInventario($_POST['id']);
}

if (isset($_POST['GuardarEvidencia']) && $_POST['GuardarEvidencia'] == "ok") {
    AjaxInventario::ajaxGuardarEvidencias($_POST, $_FILES['fotoInventario']);
}

if (isset($_POST['CambiarEstadoEvidencia']) && $_POST['CambiarEstadoEvidencia'] == "ok") {
    AjaxInventario::ajaxActualizaEstado($_POST['idevidencia'], $_POST['estadoActual'], $_POST['observaciones']);
}

if (isset($_POST['FotosVehiculos']) && $_POST['FotosVehiculos'] == "ok") {
    AjaxInventario::ajaxTablaFotosVehiculo($_POST['idvehiculo']);
}

if (isset($_POST['EliminarInventario']) && $_POST['EliminarInventario'] == "ok") {
	AjaxInventario::ajaxEliminarInventario($_POST['idvehiculo']);
}


/* ==============================================
        REVISIÓN TECNICOMECÁNICA
    ============================================== */

#Llamo a datos vehiculos para tecnomecánica

if(isset($_POST['DatosVehiculo']) && $_POST['DatosVehiculo'] == "ok") AjaxRevision::ajaxDatosVehiculo($_POST['idvehiculo']);


// if(isset($_POST['DatosRevision']) && $_POST['DatosRevision'] == "ok") AjaxRevision::ajaxDatosRevision($_POST['idrevision']);