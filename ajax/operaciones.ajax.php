<?php

# IMPORTAMOS LA CONFIGURACION DE LA SESSION
include '../config/config.php';

# REQUERIMOS EL CONTROLADOR Y EL MODELO PARA QUE REALICE LA PETICION
require_once '../controllers/files.controlador.php';
require_once '../controllers/telegram.controlador.php';

require_once '../controllers/operaciones.controlador.php';
require_once '../models/operaciones.modelo.php';

require_once '../controllers/vehicular.controlador.php';
require_once '../models/vehicular.modelo.php';
require_once '../models/gh.modelo.php';

if (!isset($_SESSION['iniciarSesion']) || $_SESSION['iniciarSesion'] != "ok") {
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
       DATOS ALISTAMIENTO
    ===================================================*/
    static public function ajaxDatosAlistamiento($idalistamiento)
    {
        $datos = array(
            'item' => "id",
            'valor' => $idalistamiento,
        );
        $respuesta = ModeloAlistamiento::mdlDatosAlistamiento($datos);

        echo json_encode($respuesta);
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
            $iconoEstado = $value['estado'] == 'PENDIENTE' ? "far fa-clock" : "far fa-check-square";

            /* Permiso de usuario */
            if (validarPermiso('M_OPERACIONES', 'U')) {
                $estado = '<button class="btn btn-sm btn-estado btn-' . $colorEstado . ' font-weight-bold" idevidencia="' . $value["idevidencia"] . '" idvehiculo="' . $idvehiculo . '" estado="' . $value["estado"] . '"><i class="' . $iconoEstado . '"></i> ' . $value["estado"] . '</button>';
            } else {
                $estado = '<button class="btn btn-sm btn-' . $colorEstado . ' font-weight-bold"><i class="' . $iconoEstado . '"></i> ' . $value["estado"] . '</button>';
            }

            $tr .= "
                <tr>
                        <td>" . $value['fecha'] . "</td>
                        <td>" . $btnVerDoc . "</td>
                        <td id='obs_" . $value["idevidencia"] . "'>" . $value['observaciones'] . "</td>
                        <td>" . $estado . "</td>
                        <td>" . $value['autor'] . "</td>
                </tr>
            ";
        }

        echo $tr;
    }

    /* ===================================================
       GUARDAR EVIDENCIA
    ===================================================*/
    static public function ajaxGuardarEvidencia($formData, $documento)
    {
        $response = "";

        $Vehiculo = ControladorVehiculos::ctrDatosVehiculo("idvehiculo", $formData['idvehiculo']);

        /* ===================== 
            CREAMOS DIRECTORIO DONDE VAMOS A GUARDAR EL ARCHIVO
        ========================= */
        # Verificar Directorio imagenes mantenimiento
        $directorio = DIR_APP . "views/img/imgAlistamientos";
        if (!is_dir($directorio)) {
            mkdir($directorio, 0755);
        }

        # Verificar Directorio Evidencias
        $directorio .= "/evidencias";
        if (!is_dir($directorio)) {
            mkdir($directorio, 0755);
        }

        # Verificar Directorio vehículo
        $directorio .= "/{$Vehiculo['placa']}";
        if (!is_dir($directorio)) {
            mkdir($directorio, 0755);
        }

        $fecha = date('Y-m-d');
        $hora = date('His');

        /* ===================================================
            GUARDAMOS EL ARCHIVO
        ===================================================*/
        $GuardarArchivo = new FilesController();
        $GuardarArchivo->file = $documento;
        $aleatorio = mt_rand(100, 999);
        $GuardarArchivo->ruta = $directorio . "/{$aleatorio}_{$fecha}_{$hora}";

        # Si es pdf
        if ($documento['type'] == "application/pdf") {
            $response = $GuardarArchivo->ctrPDFFiles();
        } else {
            # Si es una imagen
            if ($documento['type'] == "image/jpeg" || $documento['type'] == "image/png") {
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
            $guardarEvidencia = ModeloAlistamiento::mdlGuardarEvidencia($datos);

            echo $guardarEvidencia;
        } else {
            echo "error";
        }
    }

    /* ===================================================
       CAMBIAR ESTADO EVIDENCIA
    ===================================================*/
    static public function ajaxActualizaEstado($idevidencia, $estadoActual, $observaciones)
    {
        $respuesta = ControladorAlistamiento::ctrActualizarEstado($idevidencia, $estadoActual, $observaciones);
        echo $respuesta;
    }
}

class AjaxRodamientos
{
    static public function ajaxDatosRodamiento($idrodamiento)
    {
        $respuesta = ModeloRodamiento::mdlListarRodamientos($idrodamiento);
        echo json_encode($respuesta);
    }

    static public function ajaxEliminarRodamiento($idvehiculo)
    {
        $respuesta = ModeloRodamiento::mdlEliminarRodamiento($idvehiculo);
        echo $respuesta;
    }

    static public function ajaxConsultarValor($idcliente,$idruta,$idtipovel)
    {
        $datos = array(
            'idcliente' => $idcliente,
            'idruta' => $idruta,
            'idtipovehiculo' => $idtipovel
        );

        $respuesta = ModeloRodamiento::mdlValorRecorrido($datos);

        echo json_encode($respuesta);
    }

    static public function ajaxCargarTbRodamientos () {
        $Plan_r = ControladorRodamientos::ctrListarRodamientos();
        $tr = "";
        foreach ($Plan_r as $key => $value) {

            $tr.=
            "<tr>
                <td>
                    <button type='button' class='btn btn-info btn-sm btn-editarRodamiento' title='Editar plan de rodamiento.' id_rodamiento='{$value["id"]}' data-toggle='modal' data-target='#modal-nuevoplanrodamiento'><i class='fas fa-edit'></i></button>
                    <button type='button' class='btn btn-danger btn-sm btn-eliminar-rodamiento' title='Eliminar Rodamiento.' id_rodamiento='{$value["id"]}'><i class='fas fa-trash'></i></button>
                </td>
                <td>{$value["id"]}</td>
                <td>{$value["cliente"]}</td>
                <td>{$value["conductor"]}</td>
                <td>{$value["placa"]}</td>
                <td>{$value["numinterno"]}</td>
                <td>{$value["marca"]}</td>
                <td>{$value["modelo"]}</td>
                <td>{$value["capacidad"]}</td>
                <td>{$value["tipovinculacion"]}</td>
                <td>{$value["ruta"]}</td>
                <td>{$value["tipo_contrato"]}</td>
                <td>{$value["valortotal"]}</td>
                <td>{$value["fecha_servicio"]}</td>
                <td>{$value["tipo_servicio"]}</td>
                <td>{$value["cantidad_pasajeros"]}</td>
                <td>{$value["h_inicio"]}</td>
                <td>{$value["h_final"]}</td>
                <td>{$value["kmrecorridos"]}</td>
            </tr>";
            
        }

        echo $tr;

    }
}

#Llamados ajax alistamiento
if (isset($_POST['GuardarAlistamiento']) && $_POST['GuardarAlistamiento'] == "ok") {
    AjaxAlistamiento::ajaxGuardarAlistamiento($_POST);
}

if (isset($_POST['DatosAlistamiento']) && $_POST['DatosAlistamiento'] == "ok") {
    AjaxAlistamiento::ajaxDatosAlistamiento($_POST['idalistamiento']);
}

if (isset($_POST['TablaEvidencias']) && $_POST['TablaEvidencias'] == "ok") {
    AjaxAlistamiento::ajaxTablaEvidencias($_POST['idvehiculo']);
}

if (isset($_POST['GuardarEvidencia']) && $_POST['GuardarEvidencia'] == "ok") {
    AjaxAlistamiento::ajaxGuardarEvidencia($_POST, $_FILES['fotoEvidencia']);
}

if (isset($_POST['CambiarEstadoEvidencia']) && $_POST['CambiarEstadoEvidencia'] == "ok") {
    AjaxAlistamiento::ajaxActualizaEstado($_POST['idevidencia'], $_POST['estadoActual'], $_POST['observaciones']);
}

#Llamados ajax rodamiento
if (isset($_POST['DatosRodamiento']) && $_POST['DatosRodamiento'] == "ok") {
    AjaxRodamientos::ajaxDatosRodamiento($_POST['id']);
}

if (isset($_POST['EliminarRodamiento']) && $_POST['EliminarRodamiento'] == "ok") {
    AjaxRodamientos::ajaxEliminarRodamiento($_POST['id']);
}

if (isset($_POST['ConsultarValor']) && $_POST['ConsultarValor'] == "ok") {
    AjaxRodamientos::ajaxConsultarValor($_POST['idcliente'],$_POST['idruta'],$_POST['idtipove']);
}

if (isset($_POST['CargarTbRodamientos']) && $_POST['CargarTbRodamientos'] == "ok") {
	AjaxRodamientos::ajaxCargarTbRodamientos();
}