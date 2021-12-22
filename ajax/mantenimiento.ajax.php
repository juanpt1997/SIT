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
require_once '../models/compras.modelo.php';

if (!isset($_SESSION['iniciarSesion']) || $_SESSION['iniciarSesion'] != "ok") {
    echo "<script>window.location = 'inicio';</script>";
    die();
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

    static public function ajaxDatosRevision($idrevision)
    {
        $respuesta = ControladorRevision::ctrRevisionxid($idrevision);
        echo json_encode($respuesta);
    }

    static public function ajaxEliminarRevision($idrevision)
    {
        $respuesta = ControladorRevision::ctrEliminarRevision($idrevision);
        echo $respuesta;
    }
}

class AjaxMantenimientos
{

    /* ===================================================
        LISTADO PRODUCTOS [SOLICITUD DE SERVICIO]    
    ===================================================*/

    static public function ajaxListadoProductos($consecutivo)
    {
        $respuesta = ModeloMantenimientos::mdlListadoProductos();
        $tr = "";

        foreach ($respuesta as $key => $value) {
            $tr .= "
            <tr>
                <td>
                <div class='btn-group' role='group' aria-label='Button group'>
                <button data-toggle='tooltip' data-placement='top' title='Seleccionar producto' consecutivo = '{$consecutivo}' codigo = '{$value["codigo"]}' idproducto='{$value["idproducto"]}' referencia='{$value["referencia"]}' descripcion='{$value["descripcion"]}' value='{$value["idproducto"]}' inventario ='{$value["idinventario"]}' valor='{$value["precio_compra"]}' nombre_proveedor='{$value["nombre_proveedor"]}' idproveedor='{$value["idproveedor"]}' class='btn btn-sm btn-success btnSeleccionarProducto'><i class='fas fa-check'></i></button>
                </div>
                </td>
                <td>" . $value['codigo']  . "</td>
                <td>" . $value['referencia'] . "</td>
                <td>" . $value['stock'] . "</td>
                <td>" . $value['sucursal'] . "</td>
                <td>" . $value['posicion'] . "</td>
                <td>" . $value['descripcion'] . "</td>
                <td>" . $value['categoria'] . "</td>
                <td>" . $value['marca'] . "</td>
                <td>" . $value['medida'] . "</td>
                <td>" . $value['precio_compra'] . "</td>
                <td>" . $value['nombre_proveedor'] . "</td>
            </tr>
            
            ";
        }

        echo $tr;
    }

    /* ===================================================
        TABLA DE SERVICIOS X VEHICULO
    ===================================================*/

    static public function ajaxServiciosxVehiculo($idvehiculo)
    {
        $respuesta = ModeloMantenimientos::mdlServiciosRecientesxVehiculo($idvehiculo);

        $tr = "";

        foreach ($respuesta as $key => $value) {

            $fecha_Actual = date('Y-m-d');

            // VALIDACIÓN SI LA FECHA YA VENCIÓ 
            if ($fecha_Actual < $value['fecha_comparar']) {
                $fecha = "<td class='bg-success' > " . $value['fecha_cambio']   . "</td>";
            } else {
                $fecha = "<td class='bg-danger' > " . $value['fecha_cambio'] .  "</td>";
            }

            //VALIDACIÓN SI EL KILOMETRAJE YA SE PASÓ
            if ($value['kilometraje_servicio'] != 0 && $value['kilometraje_actual'] >= $value['kilometraje_cambio']) {
                $kilometraje = "<td class='bg-danger'>" . $value['kilometraje_cambio'] .  "</td>";
            } else {
                $kilometraje = "<td class='bg-success'>" . $value['kilometraje_cambio'] .  "</td>";
            }

            //SI EL KILOMETRAJE DEL SERVICIO ES 0
            if ($value['kilometraje_servicio'] == 0) {
                $kilometraje = "<td>No aplica</td>";
            }

            if ($value['kilometraje_actual'] == NULL) $value['kilometraje_actual'] = 0;

            $tr .= "
            <tr>
            <td>" . $value['servicio'] . "</td>
            <td>" . $value['kilometraje_actual'] . "</td>
            $kilometraje
            $fecha
            </tr>
            ";
        }

        echo $tr;
    }

    /* ===================================================
        TABLA SERVICIOS [PROGRAMACIÓN]     
    ===================================================*/
    static public function ajaxServiciosMenores($idservicio)
    {

        if ($idservicio != 'todo') {
            $respuesta = ModeloMantenimientos::mdlServiciosRecientes($idservicio);
        } else {
            $respuesta = ModeloMantenimientos::mdlServicios();
        }

        $tr = "";
        foreach ($respuesta as $key => $value) {
            if (validarPermiso('M_OPCIONES', 'D')) {
                $btnEliminarProgra = "<button type='button' class='btn btn-xs btn-danger btnBorrarProgramacion' idservicio='{$value['idservicio']}' idserviciovehiculo='{$value['idserviciovehiculo']}'><i class='fas fa-trash-alt'></i></button>";
            }

            $fecha_Actual = date('Y-m-d');

            // VALIDACIÓN SI LA FECHA YA VENCIÓ 
            if ($fecha_Actual < $value['fecha_comparar']) {
                $fecha = "<td class='bg-success' > " . $value['fecha_cambio']   . "</td>";
            } else {
                $fecha = "<td class='bg-danger' > " . $value['fecha_cambio'] .  "</td>";
            }

            //VALIDACIÓN SI EL KILOMETRAJE YA SE PASÓ
            if ($value['kilometraje_servicio'] != 0 && $value['kilometraje_actual'] >= $value['kilometraje_cambio']) {
                $kilometraje = "<td class='bg-danger'>" . $value['kilometraje_cambio'] .  "</td>";
            } else {
                $kilometraje = "<td class='bg-success'>" . $value['kilometraje_cambio'] .  "</td>";
            }

            //SI EL KILOMETRAJE DEL SERVICIO ES 0
            if ($value['kilometraje_servicio'] == 0) {
                $kilometraje = "<td>No aplica</td>";
            }

            if ($value['kilometraje_actual'] == NULL) $value['kilometraje_actual'] = 0;

            $tr .= "
            <tr>
                <td>$btnEliminarProgra</td>
                <td>" . $value['placa'] . "</td>
                <td>" . $value['servicio'] . " </td>
                <td>" . $value['kilometraje_actual'] . "</td>
                $kilometraje
                $fecha
                    
            </tr>
            ";
        }


        echo $tr;
    }

    /* ===================================================
        TABLA DE PROVEEDORES
    ===================================================*/

    static public function ajaxListdoProveedores($consecutivo)
    {
        $respuesta =  ModeloProveedores::mdlListarProveedores(null);

        $tr = "";

        foreach ($respuesta as $key => $value) {
            $tr .= "
            <tr>
                <td>" . $value['documento']  . "</td>
                <td>" . $value['nombre_contacto'] . "</td>
                <td>" . $value['razon_social'] . "</td>
                <td>" . $value['direccion'] . "</td>
                <td>" . $value['telefono'] . "</td>
                <td>" . $value['correo'] . "</td>
                <td>
                <div class='btn-group' role='group' aria-label='Button group'>
			    <button data-toggle='tooltip' data-placement='top' title='Seleccionar producto' consecutivo = '{$consecutivo}' documento = '{$value["documento"]}' nombre_proveedor='{$value["nombre_contacto"]}' razon='{$value["razon_social"]}' direccion='{$value["direccion"]}' idproveedor='{$value["id"]}'  class='btn btn-sm btn-success btn-SeleccionarProveedor'><i class='fas fa-check'></i></button>
			    </div>
                </td>
            </tr>
            
            ";
        }

        echo $tr;
    }

    /* ===================================================
        GUARDAR/EDITAR ORDEN DE SERVICIO
    ===================================================*/

    static public function ajaxGuardarEditarOrdenServicio($datos)
    {
        
        $respuesta = ControladorMantenimientos::ctrAgregarEditarOrden($datos);
        echo $respuesta;
        
    }

    /* ===================================================
        ELIMINAR SERVICIO [PROGRAMACIÓN]
    ===================================================*/

    static public function ajaxEliminarProgramacion($idserviciovehiculo)
    {
        $respuesta = ModeloMantenimientos::mdlEliminarProgramacion($idserviciovehiculo);
        echo $respuesta;
    }

    /* ===================================================
        GUARDAR SERVICIO [PROGRAMACIÓN]    
    ===================================================*/
    static public function ajaxGuardarProgramacion($datos)
    {
        $respuesta = ControladorMantenimientos::ctrAgregarProgramacion($datos);
        echo $respuesta;
    }

    /* ===================================================
        CARGAR DATOS DE UNA ORDEN DE SERVICIO
    ===================================================*/
    static public function ajaxCargarOrden($idorden)
    {
        $datosOrden = ControladorMantenimientos::ctrCargarOrdenServicio($idorden);
        $repuestosOrden = ControladorMantenimientos::ctrRepuestosOrden($idorden);
        $manoObra = ControladorMantenimientos::ctrManoObraOrden($idorden);
        $serviciosExt = ControladorMantenimientos::ctrServiciosExt($idorden);


        $datos=[
            'datosOrden' => $datosOrden,
            'repuestosOrden' => $repuestosOrden,
            'manoObraOrden' => $manoObra,
            'serviciosExt' => $serviciosExt
        ];


        echo json_encode($datos); 
    }

    /* ===================================================
        CARGAR LISTA DE SERVICIOS
    ===================================================*/
    static public function ajaxListaServicios($consecutivo, $seccion)
    {
        $respuesta = ModeloVehiculos::mdlListadoServicios();
        $opciones = "";
        foreach ($respuesta as $key => $value) {
            
            $opciones .="
            <tr>
            <td> ". $value['servicio'] ." </td>
            <td>
                <div class='btn-group' role='group' aria-label='Button group'>
			    <button data-toggle='tooltip' data-placement='top' title='Seleccionar servicio' value='{$value["idservicio"]}' consecutivo = '{$consecutivo}' servicio='{$value['servicio']}' idservicio = '{$value["idservicio"]}' seccion='{$seccion}'   class='btn btn-sm btn-success btn-SeleccionarServicio'><i class='fas fa-check'></i></button>
			    </div>
                </td>
            </tr>";

            // <option value=" .  $value['idservicio'] . " consecutivo=" . $consecutivo ." nombre=". $nombre ." >" . $value['servicio'] . "</option>"
        }
                        

        echo $opciones;
    }

    /* ===================================================
        CARGAR LISTA DE CUENTAS CONTABLES
    ===================================================*/
    static public function ajaxListaCuentasContables($consecutivo, $seccion)
    {
        $respuesta = ModeloMantenimientos::mdlListaCuentasContables();
        $tr = "" ;

        foreach ($respuesta as $key => $value) {
            
            $tr .= "
            
            <tr>
            <td>". $value['num_cuenta'] ."</td>
            <td>". $value['nombre_cuenta'] ."</td>
            <td>
                <div class='btn-group' role='group' aria-label='Button group'>
			    <button data-toggle='tooltip' data-placement='top' title='Seleccionar cuenta contable' value='{$value["id"]}' idcuenta='{$value["id"]}' consecutivo = '{$consecutivo}' codigo='{$value['num_cuenta']}' nombre = '{$value["nombre_cuenta"]}' seccion='{$seccion}'   class='btn btn-sm btn-success btn-SeleccionarCuentaContable'><i class='fas fa-check'></i></button>
			    </div>
            </td>
            </tr>
            
            
            ";
        }
        echo $tr;
    }

    /* ===================================================
        CARGAR LISTADO CONTROL ACTIVIDADES 
    ===================================================*/
    static public function ajaxListadoControlActividades()
    {
        $respuesta = ControladorMantenimientos::ctrListadoControlActividades();
        $tr = "";

        foreach ($respuesta as $key => $value) {
            $tr .="
            <tr>

            <td> <button class='btn btn-outline-dark btn-editarOrden' title='Ir a la orden' data-toggle='tooltip' data-placement='top' idorden='{$value['idorden']}'>". $value['idorden'] . "</button></td>
            <td>". $value['placa'] . "</td>
            <td>". $value['kilometraje_orden'] . "</td>
            <td>". $value['cliente'] . "</td>
            <td>". $value['factura'] . "</td>
            <td>". $value['municipio'] . "</td>
            <td>". $value['Ffecha_entrada'] . "</td>
            <td>". $value['Ffecha_trabajos'] . "</td>
            <td>". $value['Ffecha_aprobacion'] . "</td>
            <td>". $value['servicio'] . "</td>
            <td>". $value['nombre_contacto'] . "</td>
            <td>". $value['item'] . "</td>
            <td>". $value['descripcion'] . "</td>
            <td>". $value['sistema'] . "</td>
            <td>". $value['cantidad'] . "</td>
            <td>". $value['valor'] . "</td>
            <td>". $value['iva'] . "%</td>
            <td>". $value['total'] . "</td>
            <td>". $value['mantenimiento'] . "</td>
            <td>". $value['nombre_cuenta'] . "</td>
            <td>". $value['num_cuenta'] . "</td>
            <td><button type='button' class='btn btn-success btn-asume' data-toggle='modal' data-target='#modalAsume' idvehiculo='{$value['idvehiculo']}' idcliente='{$value['idcliente']}' num_cuenta='{$value['num_cuenta']}' nombre_cuenta='{$value['nombre_cuenta']}' total='{$value['total']}' iva='{$value['iva']}' valor='{$value['valor']}' cantidad='{$value['cantidad']}' idorden='{$value['idorden']}'><i class='fas fa-wallet'></i></button></td>


            </tr>
            ";
        }
        echo $tr;
    }

    /* ===================================================
        VER EMPRESA
    ===================================================*/
    static public function ajaxAsumeVerEmpresa()
    {
        $respuesta = ModeloEmpresaRaiz::mdlVerEmpresa();
        echo json_encode( $respuesta);
    }
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

if (isset($_POST['DatosVehiculo']) && $_POST['DatosVehiculo'] == "ok") AjaxRevision::ajaxDatosVehiculo($_POST['idvehiculo']);

#Llamado de los datos de la revison tecnicomecánica
if (isset($_POST['DatosRevision']) && $_POST['DatosRevision'] == "ok") AjaxRevision::ajaxDatosRevision($_POST['idrevision']);

#Llamado a borrar revision tecnicomecánica
if (isset($_POST['EliminarRevision']) && $_POST['EliminarRevision'] == "ok") AjaxRevision::ajaxEliminarRevision($_POST['idrevision']);



/* ===================================================
    PROGRAMACIÓN
===================================================*/


#LLAMADO A SERVICIOS MENORES MÁS RECIENTES
if (isset($_POST['Servicios']) && $_POST['Servicios'] == "ok") AjaxMantenimientos::ajaxServiciosMenores($_POST['idservicio']);

#LLAMADO A ELIMINAR PROGRAMACIÓN 
if (isset($_POST['EliminarProgramacion']) && $_POST['EliminarProgramacion'] == "ok") AjaxMantenimientos::ajaxEliminarProgramacion($_POST['idserviciovehiculo']);

#LLAMADO A GUARDAR PROGRAMACIÓN 
if (isset($_POST['GuardarProgramacion']) && $_POST['GuardarProgramacion'] == "ok") AjaxMantenimientos::ajaxGuardarProgramacion($_POST);

/* ===================================================
    ORDEN DE SERVICIO
===================================================*/

#LLAMADO A LISTADO PRODUCTOS
if (isset($_POST['ListaProductos']) && $_POST['ListaProductos'] == "ok") AjaxMantenimientos::ajaxListadoProductos($_POST['consecutivo']);

#LLAMADO A SERVICIOS POR VEHICULO
if (isset($_POST['ServiciosxVehiculo']) && $_POST['ServiciosxVehiculo'] == "ok") AjaxMantenimientos::ajaxServiciosxVehiculo($_POST['idvehiculo']);

#LLAMADO A LISTA DE PROVEEDORES
if (isset($_POST['ListaProveedores']) && $_POST['ListaProveedores'] == "ok") AjaxMantenimientos::ajaxListdoProveedores($_POST['consecutivo']);

#LLAMADO A GUARDAR ORDEN DE SERVICIO
if(isset($_POST['Guardar_OrdenServicio']) && $_POST['Guardar_OrdenServicio'] == "ok") AjaxMantenimientos::ajaxGuardarEditarOrdenServicio($_POST);

#LLAMADO A CARGAR DATOS ORDEN DE SERVICIO
if(isset($_POST['DatosOrdenServicio']) && $_POST['DatosOrdenServicio'] == "ok") AjaxMantenimientos::ajaxCargarOrden($_POST['idorden']);

#LLAMADO A TABLA SERVICIOS
if(isset($_POST['ListaServicios']) && $_POST['ListaServicios'] == "ok") AjaxMantenimientos::ajaxListaServicios($_POST['consecutivo'], $_POST['seccion']);

#LLAMADO A LISTA DE CONTABLES 
if(isset($_POST['ListaCuentasContables']) && $_POST['ListaCuentasContables'] == "ok") AjaxMantenimientos::ajaxListaCuentasContables($_POST['consecutivo'], $_POST['seccion']);

#LLAMADO A CARGAR TABLA DE CONTROL DE ACTIVIDADES 
if (isset($_POST['TablaControlActividades']) && $_POST['TablaControlActividades'] == "ok") AjaxMantenimientos::ajaxListadoControlActividades();

#LLAMADO A MOSTRAR EMPRESA 
if (isset($_POST['AsumeVerEmpresa']) && $_POST['AsumeVerEmpresa'] == "ok") AjaxMantenimientos::ajaxAsumeVerEmpresa();