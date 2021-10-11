<?php
# IMPORTAMOS LA CONFIGURACION DE LA SESSION Y DE LAS VARIABLES GLOBALES
include '../config/config.php';

# REQUERIMOS EL CONTROLADOR Y EL MODELO PARA QUE REALICE LA PETICION
require_once '../controllers/files.controlador.php';
require_once '../controllers/vehicular.controlador.php';
require_once '../models/vehicular.modelo.php';

if (!isset($_SESSION['iniciarSesion']) || $_SESSION['iniciarSesion'] != "ok") {
    echo "<script>window.location = 'inicio';</script>";
    die();
}

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
    static public function ajaxDatosEmpresas($nit)
    {
        $respuesta = ModeloConvenios::mdlMostrar($nit);
        echo json_encode($respuesta);
    }

    static public function ajaxDatosConvenios($idconvenio)
    {
        $respuesta = ControladorConvenios::ctrDatosConvenios($idconvenio);
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


            if ($value['estado'] == 1) {

                $estado = "<span class='badge badge-success'>Desbloqueado</span>";
            } else {

                $estado = "<span class='badge badge-danger'>Bloqueado</span>";
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
   * BLOQUEO DE VEHICULO
===================================================*/
class AjaxBloqueoVehiculo
{
    static public function ajaxMostrarPLaca($id)
    {
        $respuesta = ControladorBloqueosV::ctrMostrarPlaca($id);
        echo json_encode($respuesta);
    }

    static public function ajaxDatosBloqueoV($idpersonal)
    {
        $respuesta = ModeloBloqueoV::mdlUltimoBloqueoV($idpersonal);
        echo json_encode($respuesta);
    }

    static public function ajaxHistorialV($id)
    {
        $respuesta = ControladorBloqueosV::ctrHistorialV($id);
        $tr = "";
        foreach ($respuesta as $key => $value) {


            if ($value['estado'] == 1) {

                $estado = "<span class='badge badge-success'>Desbloqueado</span>";
            } else {

                $estado = "<span class='badge badge-danger'>Bloqueado</span>";
            }



            $tr .= "
                <tr>
                    <td>" . $value['idbloqueov'] . "</td>
                    <td>" . $value['placa'] . "</td>
                    <td>" . $value['motivo'] . "</td>
                    <td><b>" . $estado . "</b></td>
                    <td>" . $value['fecha'] . "</td>
                    <td>" . $value['nomUsuario'] . "</td>
                </tr>
            ";
        }

        echo $tr;
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

    /* ===================================================
	   ? PROPIETARIOS, CONDUCTORES Y DOCUMENTOS
	===================================================*/
    /* ===================================================
       TABLA PROPIETARIOS
    ===================================================*/
    static public function ajaxTablaPropietarios($idvehiculo)
    {
        $Respuesta = ControladorVehiculos::ctrPropietariosxVehiculo($idvehiculo);
        $tr = "";
        $cont = 1;
        foreach ($Respuesta as $key => $value) {
            /* Permiso de usuario */
            if (validarPermiso('M_VEHICULAR', 'U')) {
                $btnEditar = "<button type='button' class='btn btn-info btn-sm m-1 btn-editarRegistro' tabla='v_re_propietariosvehiculos' idregistro='{$value['idpropietariovehiculo']}' idvehiculo='{$value['idvehiculo']}' nombre='{$value['propietario']}'><i class='fas fa-edit'></i></button>";
            } else {
                $btnEditar = "";
            }

            /* Permiso de usuario */
            if (validarPermiso('M_VEHICULAR', 'D')) {
                $btnEliminar = "<button type='button' class='btn btn-danger btn-sm m-1 eliminarRegistro' tabla='v_re_propietariosvehiculos' idregistro='{$value['idpropietariovehiculo']}' idvehiculo='{$value['idvehiculo']}'><i class='fas fa-trash-alt'></i></button>";
            } else {
                $btnEliminar = "";
            }
            $botonAcciones = "<div class='row d-flex flex-nowrap justify-content-center'>" . $btnEditar . $btnEliminar . "</div>";

            $tr .= "
                <tr>
                        <td>" . $cont . "</td>
                        <td>" . $value['propietario'] . "</td>
                        <td>" . $value['participacion'] . "</td>
                        <td>" . $value['observacion'] . "</td>
                        <td>$botonAcciones</td>
                </tr>
            ";
            $cont++;
        }

        echo $tr;
    }

    /* ===================================================
       TABLA CONDUCTORES
    ===================================================*/
    static public function ajaxTablaConductores($idvehiculo)
    {
        $Respuesta = ControladorVehiculos::ctrConductoresxVehiculo($idvehiculo);
        $tr = "";
        foreach ($Respuesta as $key => $value) {
            /* Permiso de usuario */
            if (validarPermiso('M_VEHICULAR', 'U')) {
                $btnEditar = "<button type='button' class='btn btn-info btn-sm m-1 btn-editarRegistro' tabla='v_re_conductoresvehiculos' idregistro='{$value['idconductorvehiculo']}' idvehiculo='{$value['idvehiculo']}' nombre='{$value['conductor']}'><i class='fas fa-edit'></i></button>";
            } else {
                $btnEditar = "";
            }

            /* Permiso de usuario */
            if (validarPermiso('M_VEHICULAR', 'D')) {
                $btnEliminar = "<button type='button' class='btn btn-danger btn-sm m-1 eliminarRegistro' tabla='v_re_conductoresvehiculos' idregistro='{$value['idconductorvehiculo']}' idvehiculo='{$value['idvehiculo']}'><i class='fas fa-trash-alt'></i></button>";
            } else {
                $btnEliminar = "";
            }
            $botonAcciones = "<div class='row d-flex flex-nowrap justify-content-center'>" . $btnEditar . $btnEliminar . "</div>";

            $tr .= "
                <tr>
                        <td>" . $value['conductor'] . "</td>
                        <td>" . $value['observacion'] . "</td>
                        <td>$botonAcciones</td>
                </tr>
            ";
        }

        echo $tr;
    }

    /* ===================================================
       TABLA DOCUMENTOS
    ===================================================*/
    static public function ajaxTablaDocumentos($idvehiculo)
    {
        //$Respuesta = ControladorVehiculos::ctrDocumentosxVehiculo($idvehiculo); // HISTÓRICO
        $Respuesta = ControladorVehiculos::ctrDocumentosxVehiculoSinRepetir($idvehiculo);
        $tr = "";
        foreach ($Respuesta as $key => $value) {
            /* Permiso de usuario */
            if (validarPermiso('M_VEHICULAR', 'D')) {
                $btnEliminar = "<button type='button' class='btn btn-danger eliminarRegistro' tabla='v_re_documentosvehiculos' idregistro='{$value['iddocumento']}' idvehiculo='{$value['idvehiculo']}'><i class='fas fa-trash-alt'></i></button>";
            } else {
                $btnEliminar = "";
            }

            # Documento
            if ($value['ruta_documento'] != null) {
                $btnVerDoc = "<a href='" . URL_APP . $value['ruta_documento'] . "' target='_blank' class='btn btn-sm btn-info m-1' type='button'><i class='fas fa-file-alt'></i></a>";
                /* Permiso de usuario */
                if (validarPermiso('M_VEHICULAR', 'U')) {
                    $btnSubirDoc = "<button class='btn btn-sm btn-secondary m-1 btnSubirDocVehiculo' idvehiculo='{$idvehiculo}' idregistro='{$value['iddocumento']}' type='button'><i class='fas fa-file-upload'></i></button>";
                } else {
                    $btnSubirDoc = "";
                }
                $btnAccionesDoc = "<div class='row d-flex flex-nowrap justify-content-center'>" . $btnVerDoc . $btnSubirDoc . "</div>";
                //$btnEliminarDoc = "<button class='btn btn-sm btn-danger m-1 btnEliminarDocVehiculo' idvehiculo='{$idvehiculo}' idregistro='{$value['iddocumento']}' type='button'><i class='fas fa-ban'></i></button>";
                //$btnAccionesDoc = "<div class='row d-flex flex-nowrap justify-content-center'>" . $btnVerDoc . $btnEliminarDoc . "</div>";
            } else {
                /* Permiso de usuario */
                if (validarPermiso('M_VEHICULAR', 'U')) {
                    $btnSubirDoc = "<button class='btn btn-sm btn-secondary m-1 btnSubirDocVehiculo' idvehiculo='{$idvehiculo}' idregistro='{$value['iddocumento']}' type='button'><i class='fas fa-file-upload'></i></button>";
                } else {
                    $btnSubirDoc = "";
                }
                $btnAccionesDoc = "<div class='row d-flex flex-nowrap justify-content-center'>" . $btnSubirDoc . "</div>";
            }
            # Badge que indica si el documento está vencido o activo
            if ($value['fechafin'] > date("Y-m-d")) {
                $badgecolor = "success";
            } else {
                if ($value['fechafin'] == date("Y-m-d")) {
                    $badgecolor = "warning";
                } else {
                    $badgecolor = "danger";
                }
            }
            $tipodocumento = "<span class='badge badge-{$badgecolor}'>{$value['tipodocumento']}</span>";
            $fechafin = "<span class='badge badge-{$badgecolor}'>{$value['fechafin']}</span>";
            $tr .= "
                <tr>
                        <td>" . $tipodocumento . "</td>
                        <td>" . $value['nrodocumento'] . "</td>
                        <td>" . $value['fechainicio'] . "</td>
                        <td>" . $fechafin . "</td>
                        <td>" . $value['tarifa'] . "</td>
                        <td>$btnAccionesDoc</td>
                        <td>$btnEliminar</td>
                </tr>
            ";
        }

        echo $tr;
    }
    static public function ajaxTablaHistorico($idvehiculo)
    {
        $Respuesta = ControladorVehiculos::ctrDocumentosxVehiculo($idvehiculo); // HISTÓRICO
        $tr = "";
        foreach ($Respuesta as $key => $value) {
            # Documento
            if ($value['ruta_documento'] != null) {
                $btnVerDoc = "<a href='" . URL_APP . $value['ruta_documento'] . "' target='_blank' class='btn btn-sm btn-info m-1' type='button'><i class='fas fa-file-alt'></i></a>";
                $btnAccionesDoc = "<div class='row d-flex flex-nowrap justify-content-center'>" . $btnVerDoc . "</div>";
            } else {
                $btnAccionesDoc = "<div class='row d-flex flex-nowrap justify-content-center'><span class='badge badge-secondary'>sin documento</span></div>";
            }
            # Badge que indica si el documento está vencido o activo
            if ($value['fechafin'] > date("Y-m-d")) {
                $badgecolor = "success";
            } else {
                if ($value['fechafin'] == date("Y-m-d")) {
                    $badgecolor = "warning";
                } else {
                    $badgecolor = "danger";
                }
            }
            $tipodocumento = "<span class='badge badge-{$badgecolor}'>{$value['tipodocumento']}</span>";
            $fechafin = "<span class='badge badge-{$badgecolor}'>{$value['fechafin']}</span>";
            $tr .= "
                <tr>
                        <td>" . $tipodocumento . "</td>
                        <td>" . $value['nrodocumento'] . "</td>
                        <td>" . $value['fechainicio'] . "</td>
                        <td>" . $fechafin . "</td>
                        <td>" . $value['tarifa'] . "</td>
                        <td>$btnAccionesDoc</td>
                </tr>
            ";
        }

        echo $tr;
    }

    # DOCUMENTOS POR VEHICULO SIN REPETIR
    static public function ajaxDocumentosxVehiculoSinRepetir($idvehiculo)
    {
        $respuesta = ControladorVehiculos::ctrDocumentosxVehiculoSinRepetir($idvehiculo);
        echo json_encode($respuesta);
    }

    /* ===================================================
       VER DATOS DE UN REGISTRO EN ESPECIFICIO DE PROPIETARIOS O CONDUCTORES
    ===================================================*/
    static public function ajaxVerDetalleVehiculo($idregistro, $tabla)
    {
        switch ($tabla) {
            case 'v_re_propietariosvehiculos':
                $item = "idpropietariovehiculo";
                break;

            case 'v_re_conductoresvehiculos':
                $item = "idconductorvehiculo";
                break;

            default:
                $item = "";
                break;
        }

        $datos = array(
            'tabla' => $tabla,
            'item' => $item,
            'valor' => $idregistro
        );
        $respuesta = ControladorVehiculos::ctrVerDetalleVehiculo($datos);
        echo json_encode($respuesta);
    }

    /* ===================================================
       GUARDAR(agregar) OTROS DETALLES DE UN VEHICULO COMO EL PROPIETARIO, CONDUCTOR O DOCUMENTOS
    ===================================================*/
    static public function ajaxGuardarDetallesVehiculo($formData)
    {
        $respuesta = ControladorVehiculos::ctrGuardarDetallesVehiculo($formData);
        echo $respuesta;
    }

    /* ===================================================
       EDITAR OTROS DETALLES DE UN VEHICULO COMO EL PROPIETARIO O CONDUCTOR
    ===================================================*/
    static public function ajaxEditarDetalleVehiculo($formData)
    {
        switch ($formData['tabla']) {
            case 'v_re_propietariosvehiculos':
                $item2 = 'idpropietariovehiculo';
                # Actualizar porcentaje de participacion, esto es unico del propietario
                $datosActualizar = array(
                    'tabla' => $formData['tabla'],
                    'item1' => 'participacion',
                    'valor1' => $formData['participacion'],
                    'item2' => $item2,
                    'valor2' => $formData['idregistro']
                );
                ModeloVehiculos::mdlActualizarVehiculo($datosActualizar);
                break;

            case 'v_re_conductoresvehiculos':
                $item2 = 'idconductorvehiculo';
                break;

            default:
                # code...
                break;
        }

        $datosActualizar = array(
            'tabla' => $formData['tabla'],
            'item1' => 'observacion',
            'valor1' => $formData['observacion'],
            'item2' => $item2,
            'valor2' => $formData['idregistro']
        );
        $respuesta = ModeloVehiculos::mdlActualizarVehiculo($datosActualizar);

        //$respuesta = ControladorVehiculos::ctrEditarDetalleVehiculo($formData);
        echo $respuesta;
    }

    /* ===================================================
       ELIMINAR REGISTRO DE PROPIETARIO, CONDUCTOR O DOCUMENTOS
    ===================================================*/
    static public function ajaxEliminarRegistro($idregistro, $tabla)
    {
        switch ($tabla) {
            case 'v_re_propietariosvehiculos':
                $item = "idpropietariovehiculo";
                break;

            case 'v_re_conductoresvehiculos':
                $item = "idconductorvehiculo";
                break;

            case 'v_re_documentosvehiculos':
                $item = "iddocumento";
                break;

            default:
                $item = "";
                break;
        }

        $datos = array(
            'tabla' => $tabla,
            'item' => $item,
            'valor' => $idregistro
        );
        $eliminarRegistro = ControladorVehiculos::ctrEliminarRegistro($datos);
        echo $eliminarRegistro;
    }

    /* ===================================================
       CARGAR DOCUMENTO DEL VEHICULO
    ===================================================*/
    static public function ajaxCargarDocumento($idvehiculo, $documento, $idregistro)
    {
        $response = "";

        $Vehiculo = ControladorVehiculos::ctrDatosVehiculo("idvehiculo", $idvehiculo);

        /* ===================== 
            CREAMOS DIRECTORIO DONDE VAMOS A GUARDAR EL ARCHIVO
        ========================= */
        $anioActual = date("Y");

        # Verificar Directorio
        $directorio = DIR_APP . "views/docs/docsVehiculos/{$Vehiculo['placa']}";
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
        $GuardarArchivo->ruta = $directorio . "/{$idregistro}_{$fecha}_{$hora}";

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

            $datosRutaDoc = array(
                'tabla' => "v_re_documentosvehiculos",
                'item1' => 'ruta_documento',
                'valor1' => $rutaDoc,
                'item2' => "iddocumento",
                'valor2' => $idregistro
            );
            $actualizarRutaDoc = ModeloVehiculos::mdlActualizarVehiculo($datosRutaDoc);

            echo $actualizarRutaDoc;
        } else {
            echo "error";
        }
    }

    /* ===================================================
       ELIMINAR DOCUMENTO (Lo que hacemos es eliminar la ruta)
    ===================================================*/
    static public function ajaxEliminarDocumento($idregistro)
    {
        $tabla = "v_re_documentosvehiculos";
        $item2 = "iddocumento";
        # Actualizar el campo de documento como vacio
        $datosRutaDoc = array(
            'tabla' => $tabla,
            'item1' => 'ruta_documento',
            'valor1' => "",
            'item2' => $item2,
            'valor2' => $idregistro
        );
        $respuesta = ModeloVehiculos::mdlActualizarVehiculo($datosRutaDoc);
        echo $respuesta;
    }

    /* ===================================================
       REPORTE COMPLETO DOCUMENTOS VEHICULOS
    ===================================================*/
    static public function ajaxReporteDocumentos()
    {
        $Respuesta = ControladorVehiculos::ctrReporteDocumentos();
        $tr = "";

        $contadorDocumentos = 0;
        $NDocumentos = count(ControladorVehiculos::ctrTiposDocumentacion());
        for ($i = 0; $i < count($Respuesta); $i++) {
            # Badge que indica si el documento está vencido o activo
            if ($Respuesta[$i]['fechafin'] > date("Y-m-d")) {
                $badgecolor = "success";
            } else {
                if ($Respuesta[$i]['fechafin'] == date("Y-m-d")) {
                    $badgecolor = "warning";
                } else {
                    $badgecolor = "danger";
                }
            }
            $fechavencimiento = "<span class='badge badge-{$badgecolor}'>{$Respuesta[$i]['fechafin']}</span>";
            $tipodocumento = "<span class='badge badge-{$badgecolor} text-uppercase'>{$Respuesta[$i]['tipodocumento']}</span>";

            # Si es igual al siguiente
            if ($i < count($Respuesta) - 1 && $Respuesta[$i]['placa'] == $Respuesta[$i + 1]['placa']) {

                # Igual al anterior e igual al siguiente
                if ($i > 0 && $Respuesta[$i]['placa'] == $Respuesta[$i - 1]['placa']) {
                    $tr .= "
                            <td>" . $tipodocumento . "</td>
                            <td>" . $Respuesta[$i]['fechainicio'] . "</td>
                            <td>" . $fechavencimiento . "</td>";

                    $contadorDocumentos++;
                }
                # Diferente al anterior e igual al siguiente
                else {
                    $tr .= "
                            <tr>
                                    <td>" . $Respuesta[$i]['placa'] . "</td>
                                    <td>" . $Respuesta[$i]['numinterno'] . "</td>
                                    <td>" . $Respuesta[$i]['sucursal'] . "</td>
                                    <td>" . $Respuesta[$i]['tipovinculacion'] . "</td>
                                    <td>" . $Respuesta[$i]['activo'] . "</td>
                                    <td>" . $tipodocumento . "</td>
                                    <td>" . $Respuesta[$i]['fechainicio'] . "</td>
                                    <td>" . $fechavencimiento . "</td>";
                    $contadorDocumentos++;
                }
            }

            # Diferente al siguiente
            else {
                # Igual al anterior y diferente al siguiente
                if ($i > 0 && $Respuesta[$i]['placa'] == $Respuesta[$i - 1]['placa']) {
                    $tr .= "
                                <td>" . $tipodocumento . "</td>
                                <td>" . $Respuesta[$i]['fechainicio'] . "</td>
                                <td>" . $fechavencimiento . "</td>";
                    for ($j = $contadorDocumentos; $j < $NDocumentos - 1; $j++) {
                        $tr .= "
                                    <td></td>
                                    <td></td>
                                    <td></td>";
                    }

                    $tr .= "
                                <td>" . $Respuesta[$i]['nombre'] . "</td>
                                <td>" . $Respuesta[$i]['documento'] . "</td>
                                <td>" . $Respuesta[$i]['telef'] . "</td>
                                <td>" . $Respuesta[$i]['email'] . "</td>
                        </tr>";

                    $contadorDocumentos = 0;
                }
                # Diferente al anterior y diferente al siguiente
                else {
                    $tr .= "
                            <tr>
                                    <td>" . $Respuesta[$i]['placa'] . "</td>
                                    <td>" . $Respuesta[$i]['numinterno'] . "</td>
                                    <td>" . $Respuesta[$i]['sucursal'] . "</td>
                                    <td>" . $Respuesta[$i]['tipovinculacion'] . "</td>
                                    <td>" . $Respuesta[$i]['activo'] . "</td>
                                    <td>" . $tipodocumento . "</td>
                                    <td>" . $Respuesta[$i]['fechainicio'] . "</td>
                                    <td>" . $fechavencimiento . "</td>";

                    for ($j = $contadorDocumentos; $j < $NDocumentos - 1; $j++) {
                        $tr .= "
                                    <td></td>
                                    <td></td>
                                    <td></td>";
                    }

                    $tr .= "
                                    <td>" . $Respuesta[$i]['nombre'] . "</td>
                                    <td>" . $Respuesta[$i]['documento'] . "</td>
                                    <td>" . $Respuesta[$i]['telef'] . "</td>
                                    <td>" . $Respuesta[$i]['email'] . "</td>
                            </tr>
                        ";

                    $contadorDocumentos = 0;
                }
            }



            // if ($i > 0 && $Respuesta[$i]['placa'] == $Respuesta[$i - 1]['placa']){
            // }else{
            //     if ($i == 0){
            //     }
            //     else{
            //         if ($i < count($Respuesta) - 1){
            //             $tr .= "
            //                 <tr>
            //                         <td>" . $Respuesta[$i]['placa'] . "</td>
            //                         <td>" . $Respuesta[$i]['numinterno'] . "</td>
            //                         <td>" . $Respuesta[$i]['sucursal'] . "</td>
            //                         <td>" . $Respuesta[$i]['tipovinculacion'] . "</td>
            //                         <td>" . $Respuesta[$i]['activo'] . "</td>";
            //         }
            //     }
            // }

            //     $tr .= "
            //     <tr>
            //             <td>" . $Respuesta[$i]['placa'] . "</td>
            //             <td>" . $Respuesta[$i]['numinterno'] . "</td>
            //             <td>" . $Respuesta[$i]['sucursal'] . "</td>
            //             <td>" . $Respuesta[$i]['tipovinculacion'] . "</td>
            //             <td>" . $Respuesta[$i]['activo'] . "</td>
            //             <td>" . $Respuesta[$i]['tipodocumento'] . "</td>
            //             <td>" . $Respuesta[$i]['fechainicio'] . "</td>
            //             <td>" . $Respuesta[$i]['fechafin'] . "</td>
            //             <td>" . $Respuesta[$i]['nombre'] . "</td>
            //             <td>" . $Respuesta[$i]['documento'] . "</td>
            //             <td>" . $Respuesta[$i]['telef'] . "</td>
            //             <td>" . $Respuesta[$i]['email'] . "</td>
            //     </tr>
            // ";
        }
        // foreach ($Respuesta as $key => $value) {



        //     $tr .= "
        //         <tr>
        //                 <td>" . $value['placa'] . "</td>
        //                 <td>" . $value['numinterno'] . "</td>
        //                 <td>" . $value['sucursal'] . "</td>
        //                 <td>" . $value['tipovinculacion'] . "</td>
        //                 <td>" . $value['activo'] . "</td>
        //                 <td>" . $value['tipodocumento'] . "</td>
        //                 <td>" . $value['fechainicio'] . "</td>
        //                 <td>" . $value['fechafin'] . "</td>
        //                 <td>" . $value['nombre'] . "</td>
        //                 <td>" . $value['documento'] . "</td>
        //                 <td>" . $value['telef'] . "</td>
        //                 <td>" . $value['email'] . "</td>
        //         </tr>
        //     ";
        // }

        echo $tr;
    }
    // static public function ajaxReporteDocumentos2()
    // {
    //     $Vehiculos = ControladorVehiculos::ctrListaVehiculos();

    //     $tr = "";

    //     for ($i = 0; $i < 20; $i++) {
    //         $Documentos = ControladorVehiculos::ctrReporteDocumentosxVehiculo($Vehiculos[$i]['idvehiculo']);
    //         $tr .= "<tr>
    //                     <td>" . $Vehiculos[$i]['placa'] . "</td>
    //                     <td>" . $Vehiculos[$i]['numinterno'] . "</td>
    //                     <td>" . $Vehiculos[$i]['sucursal'] . "</td>
    //                     <td>" . $Vehiculos[$i]['tipovinculacion'] . "</td>
    //                     <td>" . $Vehiculos[$i]['activo'] . "</td>";
    //         foreach ($Documentos as $key2 => $value2) {
    //             $tr .= "
    //                                 <td>" . $value2['tipodocumento'] . "</td>
    //                                 <td></td>
    //                                 <td>" . $value2['fechafin'] . "</td>";
    //         }
    //         $tr .= "<td></td>
    //                 <td></td>
    //                 <td></td>
    //                 <td></td>
    //             </tr>";
    //     }
    //     foreach ($Vehiculos as $key => $value) {
    //         // $Documentos = ControladorVehiculos::ctrReporteDocumentosxVehiculo($value['idvehiculo']);
    //         // $tr .= "<tr>
    //         //             <td>" . $value['placa'] . "</td>
    //         //             <td>" . $value['numinterno'] . "</td>
    //         //             <td>" . $value['sucursal'] . "</td>
    //         //             <td>" . $value['tipovinculacion'] . "</td>
    //         //             <td>" . $value['activo'] . "</td>";
    //         // foreach ($Documentos as $key2 => $value2) {
    //         //     $tr .= "
    //         //                         <td>" . $value2['tipodocumento'] . "</td>
    //         //                         <td>" . $value2['tipodocumento'] . "</td>
    //         //                         <td>" . $value2['fechafin'] . "</td>";              
    //         // }
    //         // $tr .= "<td></td>
    //         //         <td></td>
    //         //         <td></td>
    //         //         <td></td>
    //         //     </tr>";
    //     }
    //     echo $tr;
    // }
    static public function ajaxReporteDocumentos3()
    {
        $Respuesta = ControladorVehiculos::ctrReporteDocumentos();
        $tr = "";

        $contadorDocumentos = 0;
        $TiposDocumento = ControladorVehiculos::ctrTiposDocumentacion();
        $NDocumentos = count($TiposDocumento);
        //$NDocumentos = count(ControladorVehiculos::ctrTiposDocumentacion());

        $test = array(
            'placa' => "CEE835",
            'numinterno' => "CEE835",
            'tipovinculacion' => "CEE835",
            'activo' => "CEE835",
            'fechainicio' => "CEE835",
            'fechafin' => "CEE835",
            'tipodocumento' => "CEE835",
            'idtipo' => "CEE835",
            'sucursal' => "CEE835",
            'nombre' => "CEE835",
            'documento' => "CEE835",
            'telef' => "CEE835",
            'email' => "CEE835"
        );

        # Relleno el arreglo con espacios vacios
        $Arreglo = array();
        $cont = 1;
        for ($i = 0; $i < count($Respuesta); $i++) {
            //echo $cont;

            // if ($Respuesta[$i]['idtipo'] < $cont){

            // }

            // Hay campos vacios antes de...
            if ($Respuesta[$i]['idtipo'] > $cont) {
                for ($j = $cont; $j < $Respuesta[$i]['idtipo']; $j++) {
                    $test = array(
                        'placa' => $Respuesta[$i]['placa'],
                        'numinterno' => $Respuesta[$i]['numinterno'],
                        'tipovinculacion' => $Respuesta[$i]['tipovinculacion'],
                        'activo' => $Respuesta[$i]['activo'],
                        'fechainicio' => "",
                        'fechafin' => "",
                        'tipodocumento' => "",
                        'idtipo' => $Respuesta[$i]['idtipo'],
                        'sucursal' => $Respuesta[$i]['sucursal'],
                        'nombre' => $Respuesta[$i]['nombre'],
                        'documento' => $Respuesta[$i]['documento'],
                        'telef' => $Respuesta[$i]['telef'],
                        'email' => $Respuesta[$i]['email']
                    );
                    $Arreglo[] = $test;
                    //var_dump($test);
                    //echo " Entro a llenar esto $j";
                }
            }
            // Pasa a un nuevo vehiculo y quedan vacios los espacios siguientes del vehiculo anterior
            else {
                if ($Respuesta[$i]['idtipo'] < $cont) {
                    // Completo lo que sigue
                    for ($j = $cont; $j <= $NDocumentos; $j++) {
                        $test = array(
                            'placa' => $Respuesta[$i - 1]['placa'],
                            'numinterno' => $Respuesta[$i - 1]['numinterno'],
                            'tipovinculacion' => $Respuesta[$i - 1]['tipovinculacion'],
                            'activo' => $Respuesta[$i - 1]['activo'],
                            'fechainicio' => "",
                            'fechafin' => "",
                            'tipodocumento' => "",
                            'idtipo' => "",
                            'sucursal' => $Respuesta[$i - 1]['sucursal'],
                            'nombre' => $Respuesta[$i - 1]['nombre'],
                            'documento' => $Respuesta[$i - 1]['documento'],
                            'telef' => $Respuesta[$i - 1]['telef'],
                            'email' => $Respuesta[$i - 1]['email']
                        );
                        $Arreglo[] = $test;
                        //var_dump($test);
                        //echo " Entro a llenar esto $j";
                    }
                    $cont = 1;

                    // Vuelve y ocurre que los espacios anterior estan vacios
                    if ($Respuesta[$i]['idtipo'] > $cont) {
                        for ($j = $cont; $j < $Respuesta[$i]['idtipo']; $j++) {
                            $test = array(
                                'placa' => $Respuesta[$i]['placa'],
                                'numinterno' => $Respuesta[$i]['numinterno'],
                                'tipovinculacion' => $Respuesta[$i]['tipovinculacion'],
                                'activo' => $Respuesta[$i]['activo'],
                                'fechainicio' => "",
                                'fechafin' => "",
                                'tipodocumento' => "",
                                'idtipo' => "",
                                'sucursal' => $Respuesta[$i]['sucursal'],
                                'nombre' => $Respuesta[$i]['nombre'],
                                'documento' => $Respuesta[$i]['documento'],
                                'telef' => $Respuesta[$i]['telef'],
                                'email' => $Respuesta[$i]['email']
                            );
                            $Arreglo[] = $test;
                            //var_dump($test);
                            //echo " Entro a llenar esto $j";
                        }
                    }
                }
            }
            //var_dump($Respuesta[$i]);

            $Arreglo[] = $Respuesta[$i]; // Meto el que es en la posicion correcta

            if ($cont < $NDocumentos) {
                $cont = $Respuesta[$i]['idtipo'] + 1; // Aumento contador si se que no ha llegado al final
                //echo " sumé 1 a $cont ";
            } else {
                //echo " cont = 1 ";
                $cont = 1; // Si llega al final de los posibles documentos, reinicio el contador
            }
        }

        //var_dump($Arreglo);
        //var_dump($Respuesta);




        for ($i = 0; $i < count($Arreglo); $i++) {
            # Badge que indica si el documento está vencido o activo
            if ($Arreglo[$i]['fechafin'] > date("Y-m-d")) {
                $badgecolor = "success";
            } else {
                if ($Arreglo[$i]['fechafin'] == date("Y-m-d")) {
                    $badgecolor = "warning";
                } else {
                    $badgecolor = "danger";
                }
            }
            $fechavencimiento = "<span class='badge badge-{$badgecolor}'>{$Arreglo[$i]['fechafin']}</span>";
            $tipodocumento = "<span class='badge badge-{$badgecolor} text-uppercase'>{$Arreglo[$i]['tipodocumento']}</span>";

            # Si es igual al siguiente
            if ($i < count($Arreglo) - 1 && $Arreglo[$i]['placa'] == $Arreglo[$i + 1]['placa']) {

                # Igual al anterior e igual al siguiente
                if ($i > 0 && $Arreglo[$i]['placa'] == $Arreglo[$i - 1]['placa']) {
                    $tr .= "
                            <td>" . $tipodocumento . "</td>
                            <td>" . $Arreglo[$i]['fechainicio'] . "</td>
                            <td>" . $fechavencimiento . "</td>";

                    $contadorDocumentos++;
                }
                # Diferente al anterior e igual al siguiente
                else {
                    $tr .= "
                            <tr>
                                    <td>" . $Arreglo[$i]['placa'] . "</td>
                                    <td>" . $Arreglo[$i]['numinterno'] . "</td>
                                    <td>" . $Arreglo[$i]['sucursal'] . "</td>
                                    <td>" . $Arreglo[$i]['tipovinculacion'] . "</td>
                                    <td>" . $Arreglo[$i]['activo'] . "</td>
                                    <td>" . $tipodocumento . "</td>
                                    <td>" . $Arreglo[$i]['fechainicio'] . "</td>
                                    <td>" . $fechavencimiento . "</td>";
                    $contadorDocumentos++;
                }
            }

            # Diferente al siguiente
            else {
                # Igual al anterior y diferente al siguiente
                if ($i > 0 && $Arreglo[$i]['placa'] == $Arreglo[$i - 1]['placa']) {
                    $tr .= "
                                <td>" . $tipodocumento . "</td>
                                <td>" . $Arreglo[$i]['fechainicio'] . "</td>
                                <td>" . $fechavencimiento . "</td>";
                    for ($j = $contadorDocumentos; $j < $NDocumentos - 1; $j++) {
                        $tr .= "
                                    <td></td>
                                    <td></td>
                                    <td></td>";
                    }

                    $tr .= "
                                <td>" . $Arreglo[$i]['nombre'] . "</td>
                                <td>" . $Arreglo[$i]['documento'] . "</td>
                                <td>" . $Arreglo[$i]['telef'] . "</td>
                                <td>" . $Arreglo[$i]['email'] . "</td>
                        </tr>";

                    $contadorDocumentos = 0;
                }
                # Diferente al anterior y diferente al siguiente
                else {
                    $tr .= "
                            <tr>
                                    <td>" . $Arreglo[$i]['placa'] . "</td>
                                    <td>" . $Arreglo[$i]['numinterno'] . "</td>
                                    <td>" . $Arreglo[$i]['sucursal'] . "</td>
                                    <td>" . $Arreglo[$i]['tipovinculacion'] . "</td>
                                    <td>" . $Arreglo[$i]['activo'] . "</td>
                                    <td>" . $tipodocumento . "</td>
                                    <td>" . $Arreglo[$i]['fechainicio'] . "</td>
                                    <td>" . $fechavencimiento . "</td>";

                    for ($j = $contadorDocumentos; $j < $NDocumentos - 1; $j++) {
                        $tr .= "
                                    <td></td>
                                    <td></td>
                                    <td></td>";
                    }

                    $tr .= "
                                    <td>" . $Arreglo[$i]['nombre'] . "</td>
                                    <td>" . $Arreglo[$i]['documento'] . "</td>
                                    <td>" . $Arreglo[$i]['telef'] . "</td>
                                    <td>" . $Arreglo[$i]['email'] . "</td>
                            </tr>
                        ";

                    $contadorDocumentos = 0;
                }
            }
        }

        echo $tr;
    }
}



# LLAMADOS A AJAX PROPIETARIOS
if (isset($_POST['DatosPropietarios']) && $_POST['DatosPropietarios'] == "ok") {
    AjaxPropietarios::ajaxDatosPropietarios($_POST['value']);
}
# LLAMADOS A AJAX CONVENIOS
if (isset($_POST['DatosEmpresas']) && $_POST['DatosEmpresas'] == "ok") {
    AjaxConvenios::ajaxDatosEmpresas($_POST['value']);
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

#LLAMADOS AJAX BLOQUEO DE VEHICULOS
if (isset($_POST['ajaxMostrarPlaca']) && $_POST['ajaxMostrarPlaca'] == "ok") {
    AjaxBloqueoVehiculo::ajaxMostrarPLaca($_POST['idvehiculo']);
}

if (isset($_POST['DatosBloqueoV']) && $_POST['DatosBloqueoV'] == "ok") {
    AjaxBloqueoVehiculo::ajaxDatosBloqueoV($_POST['idvehiculo']);
}

if (isset($_POST['ajaxHistorialV']) && $_POST['ajaxHistorialV'] == "ok") {
    AjaxBloqueoVehiculo::ajaxHistorialV($_POST['idvehiculo']);
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

// ? PROPIETARIOS, CONDUCTORES Y DOCUMENTOS
if (isset($_POST['TablaPropietarios']) && $_POST['TablaPropietarios'] == "ok") {
    AjaxVehiculos::ajaxTablaPropietarios($_POST['idvehiculo']);
}

if (isset($_POST['TablaConductores']) && $_POST['TablaConductores'] == "ok") {
    AjaxVehiculos::ajaxTablaConductores($_POST['idvehiculo']);
}

if (isset($_POST['TablaDocumentos']) && $_POST['TablaDocumentos'] == "ok") {
    AjaxVehiculos::ajaxTablaDocumentos($_POST['idvehiculo']);
}

if (isset($_POST['TablaHistorico']) && $_POST['TablaHistorico'] == "ok") {
    AjaxVehiculos::ajaxTablaHistorico($_POST['idvehiculo']);
}
# DOCUMENTOS POR VEHICULO SIN REPETIR
if (isset($_POST['DocumentosxVehiculo']) && $_POST['DocumentosxVehiculo'] == "ok") {
    AjaxVehiculos::ajaxDocumentosxVehiculoSinRepetir($_POST['idvehiculo']);
}


if (isset($_POST['VerDetalleVehiculo']) && $_POST['VerDetalleVehiculo'] == "ok") {
    AjaxVehiculos::ajaxVerDetalleVehiculo($_POST['idregistro'], $_POST['tabla']);
}

if (isset($_POST['GuardarDetallesVehiculo']) && $_POST['GuardarDetallesVehiculo'] == "ok") {
    AjaxVehiculos::ajaxGuardarDetallesVehiculo($_POST);
}

if (isset($_POST['EditarDetalleVehiculo']) && $_POST['EditarDetalleVehiculo'] == "ok") {
    AjaxVehiculos::ajaxEditarDetalleVehiculo($_POST);
}

if (isset($_POST['EliminarRegistro']) && $_POST['EliminarRegistro'] == "ok") {
    AjaxVehiculos::ajaxEliminarRegistro($_POST['idregistro'], $_POST['tabla']);
}

if (isset($_POST['CargarDocumentoVehiculo']) && $_POST['CargarDocumentoVehiculo'] == "ok") {
    if (isset($_FILES['documento'])) {
        AjaxVehiculos::ajaxCargarDocumento($_POST['idvehiculo'], $_FILES['documento'], $_POST['idregistro']);
    } else {
        echo "vacio";
    }
}

if (isset($_POST['EliminarDocumentoVehiculo']) && $_POST['EliminarDocumentoVehiculo'] == "ok") {
    AjaxVehiculos::ajaxEliminarDocumento($_POST['idregistro']);
}


# LLAMADO AL REPORTE COMPLETO DOCUMENTOS VEHICULOS
if (isset($_REQUEST['ReporteDocumentos']) && $_REQUEST['ReporteDocumentos'] == "ok") {
    AjaxVehiculos::ajaxReporteDocumentos3();
}

#LLAMADO A LOS DATOS DE CONVENIO

if(isset($_POST['DatosConvenio'])&& $_POST['DatosConvenio'] == "ok"){
    AjaxConvenios::ajaxDatosConvenios($_POST['idconvenio']);
}