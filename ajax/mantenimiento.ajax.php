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
require_once '../models/almacen.modelo.php';

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
        $respuesta = ModeloProductos::mdlListarInventario();
        $tr = "";

        foreach ($respuesta as $key => $value) {
            // <td>
            //     <div class='btn-group' role='group' aria-label='Button group'>
            //     <button data-toggle='tooltip' data-placement='top' title='Seleccionar producto' consecutivo = '{$consecutivo}' codigo = '{$value["codigo"]}' c referencia='{$value["referencia"]}' descripcion='{$value["descripcion"]}' value='{$value["idproducto"]}' inventario ='{$value["idinventario"]}' valor='{$value["precio_compra"]}' nombre_proveedor='{$value["nombre_proveedor"]}' idproveedor='{$value["idproveedor"]}' class='btn btn-sm btn-success btnSeleccionarProducto'><i class='fas fa-check'></i></button>
            //     </div>
            //     </td>
            $tr .= "
            <tr>
                <td>
                <div class='btn-group' role='group' aria-label='Button group'>
                <button type='button' class='btn btn-success btn-md btn-SucursalesProducto' idproducto='{$value["idproducto"]}' consecutivo='{$consecutivo}' title='lista repuestos' data-toggle='modal' data-target='#sucursalesProductos'><i class='fas fa-map-marker-alt'></i></button>
                </div>
                </td>
                <td>" . $value['descripcion'] . "</td>
                <td>" . $value['codigo']  . "</td>
                <td>" . $value['referencia'] . "</td>
                <td>" . $value['stock'] . "</td>
                <td>" . $value['posicion'] . "</td>
                <td>" . $value['categoria'] . "</td>
                <td>" . $value['marca'] . "</td>
                <td>" . $value['medida'] . "</td>
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


        $datos = [
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
        $respuesta = ModeloVehiculos::mdlListadoServicios("tipo");
        $opciones = "";
        foreach ($respuesta as $key => $value) {

            $opciones .= "
            <tr>
            <td> " . $value['servicio'] . " </td>
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
        $tr = "";

        foreach ($respuesta as $key => $value) {

            $tr .= "
            
            <tr>
            <td>" . $value['num_cuenta'] . "</td>
            <td>" . $value['nombre_cuenta'] . "</td>
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

        
        if(!empty($respuesta))
        {
            $ordenes = array();
            foreach ($respuesta as $key => $value) {
                array_push($ordenes, $value['idorden']);
            }
    
    
            //GENERA UN ARRRAY CON LA CANTIDAD DE VECES QUE HAY UNA PLACA 
            foreach ($ordenes as $key => $value) {
                $rowspan = array_count_values($ordenes);
            }
    
    
    
            // var_dump($rowspan);
            $cont = 0; // Define la posición en la que me encuentro dentro del arreglo de programación
    
    
    
            // Recorro el arreglo con las placas y su respectivo contador
            // var_dump($rowspan);
    
            foreach ($rowspan as $key => $value) {
                $tr = "";
    
                $numfilas = $value; //num filas repetidas de cada registro
    
    
    
    
    
                $tr .= "
                <tr>
                    <td data-datatable-multi-row-rowspan='$numfilas'> <button class='btn btn-outline-dark btn-editarOrden' title='Ir a la orden' data-toggle='tooltip' data-placement='top' idorden='{$respuesta[$cont]['idorden']}'>" . $respuesta[$cont]['idorden'] . "</button></td>
                    <td data-datatable-multi-row-rowspan='$numfilas'>" . $respuesta[$cont]['placa'] . "</td>
                    <td data-datatable-multi-row-rowspan='$numfilas'>" . $respuesta[$cont]['kilometraje_orden'] . "</td>
                    <td data-datatable-multi-row-rowspan='$numfilas'>" . $respuesta[$cont]['cliente'] . "</td>
                    <td data-datatable-multi-row-rowspan='$numfilas'>" . $respuesta[$cont]['factura'] . "</td>
                    <td data-datatable-multi-row-rowspan='$numfilas'>" . $respuesta[$cont]['municipio'] . "</td>
                    <td data-datatable-multi-row-rowspan='$numfilas'>" . $respuesta[$cont]['Ffecha_entrada'] . "</td>
                    <td data-datatable-multi-row-rowspan='$numfilas'>" . $respuesta[$cont]['Ffecha_trabajos'] . "</td>
                    <td data-datatable-multi-row-rowspan='$numfilas'>" . $respuesta[$cont]['Ffecha_aprobacion']; // . "</td>"; // La columna anterior a la columna que si tiene varias filas juntas, no se puede cerrar aún
    
    
                if ($numfilas > 1) {
                    $tr .= "<script type='x/template' class='extra-row-content'>"; // abre script
    
                    // Comienza iteración
                    for ($i = 0; $i < $numfilas - 1; $i++) { // $numfilas - 1 para cerrar el script antes de escribir el último item que debería iterar
                        // Por cada uno tiene que abrir también un tr
                        if ($respuesta[$cont]['porcentaje_cliente'] != 0) {
    
                            $valor_corresponde_cliente = ($respuesta[$cont]['total'] * ($respuesta[$cont]['porcentaje_cliente'] / 100));
                        } else {
                            $valor_corresponde_cliente = "";
                        }
                        if ($respuesta[$cont]['porcentaje_empresa'] != 0) {
                            $valor_corresponde_empresa = ($respuesta[$cont]['total'] * ($respuesta[$cont]['porcentaje_empresa'] / 100));
                        } else {
                            $valor_corresponde_empresa = "";
                        }
                        if ($respuesta[$cont]['porcentaje_contratista'] != 0) {
                            $valor_corresponde_contratista = ($respuesta[$cont]['total'] * ($respuesta[$cont]['porcentaje_contratista'] / 100));
                        } else {
                            $valor_corresponde_contratista = "";
                        }
    
                        $tr .= "
                                    <tr>
                                        <td>" . $respuesta[$cont]['servicio'] . "</td>
                                        <td>" . $respuesta[$cont]['nombre_contacto'] . "</td>
                                        <td>" . $respuesta[$cont]['item'] . "</td>
                                        <td>" . $respuesta[$cont]['descripcion'] . "</td>
                                        <td>" . $respuesta[$cont]['sistema'] . "</td>
                                        <td>" . $respuesta[$cont]['cantidad'] . "</td>
                                        <td>" . $respuesta[$cont]['valor'] . "$</td>
                                        <td>" . $respuesta[$cont]['iva'] . "%</td>
                                        <td>" . $respuesta[$cont]['cliente_asume'] . "</td>
                                        <td>" . $respuesta[$cont]['porcentaje_cliente'] . "% - " . $valor_corresponde_cliente . "$</td>
                                        <td>" . $respuesta[$cont]['empresa_asume'] . "</td>
                                        <td>" . $respuesta[$cont]['porcentaje_empresa'] . "% - " . $valor_corresponde_empresa . "$</td>
                                        <td>" . $respuesta[$cont]['contratista_asume'] . "</td>
                                        <td>" . $respuesta[$cont]['porcentaje_contratista'] . "% - " . $valor_corresponde_contratista . "$</td>
                                        <td>" . $respuesta[$cont]['total'] . "$</td>
                                        <td>" . $respuesta[$cont]['mantenimiento'] . "</td>
                                        <td>" . $respuesta[$cont]['nombre_cuenta'] . "</td>
                                        <td>" . $respuesta[$cont]['num_cuenta'] . "</td>
                                        <td><button type='button' class='btn btn-success btn-asume' data-toggle='modal' data-target='#modalAsume' idvehiculo='{$respuesta[$cont]['idvehiculo']}' idcliente='{$respuesta[$cont]['idcliente']}' idcuenta='{$respuesta[$cont]['idcuenta']}' cliente='{$respuesta[$cont]['cliente']}' num_cuenta='{$respuesta[$cont]['num_cuenta']}' nombre_cuenta='{$respuesta[$cont]['nombre_cuenta']}' total='{$respuesta[$cont]['total']}' iva='{$respuesta[$cont]['iva']}' valor='{$respuesta[$cont]['valor']}' cantidad='{$respuesta[$cont]['cantidad']}' idorden='{$respuesta[$cont]['idorden']}' id='{$respuesta[$cont]['id']}' descripcion='{$respuesta[$cont]['descripcion']}' ><i class='fas fa-wallet'></i></button></td>
    
                                        </tr>
                                        ";
    
                        $cont++; // Aumento la posición
                    }
    
                    // Cierro script
                    $tr .= "</script>";
                }
                // Cierro td anterior al td que itera muchas veces, en este caso el de fecha programación, si no entra ninguna vez a la condición anterior pues simplemente sale
                $tr .= "</td>";
    
                if ($respuesta[$cont]['porcentaje_cliente'] != 0) {
    
                    $valor_corresponde_cliente = ($respuesta[$cont]['total'] * ($respuesta[$cont]['porcentaje_cliente'] / 100));
                } else {
                    $valor_corresponde_cliente = "";
                }
                if ($respuesta[$cont]['porcentaje_empresa'] != 0) {
                    $valor_corresponde_empresa = ($respuesta[$cont]['total'] * ($respuesta[$cont]['porcentaje_empresa'] / 100));
                } else {
                    $valor_corresponde_empresa = "";
                }
                if ($respuesta[$cont]['porcentaje_contratista'] != 0) {
                    $valor_corresponde_contratista = ($respuesta[$cont]['total'] * ($respuesta[$cont]['porcentaje_contratista'] / 100));
                } else {
                    $valor_corresponde_contratista = "";
                }
    
                // Monta el último servicio que se iteró, si no tuvo que iterar solo se escribe y ya
                $tr .= "<td>" . $respuesta[$cont]['servicio'] . "</td>";
                $tr .= "<td>" . $respuesta[$cont]['nombre_contacto'] . "</td>";
                $tr .= "<td>" . $respuesta[$cont]['item'] . "</td>";
                $tr .= "<td>" . $respuesta[$cont]['descripcion'] . "</td>";
                $tr .= "<td>" . $respuesta[$cont]['sistema'] . "</td>";
                $tr .= "<td>" . $respuesta[$cont]['cantidad'] . "</td>";
                $tr .= "<td>" . $respuesta[$cont]['valor'] . "$</td>";
                $tr .= "<td>" . $respuesta[$cont]['iva'] . "%</td>";
                $tr .= "<td>" . $respuesta[$cont]['cliente_asume'] . "</td>";
                $tr .= "<td>" . $respuesta[$cont]['porcentaje_cliente'] . "% - " . $valor_corresponde_cliente . "$</td>";
                $tr .= "<td>" . $respuesta[$cont]['empresa_asume'] . "</td>";
                $tr .= "<td>" . $respuesta[$cont]['porcentaje_empresa'] . "% - " . $valor_corresponde_empresa . "$</td>";
                $tr .= "<td>" . $respuesta[$cont]['contratista_asume'] . "</td>";
                $tr .= "<td>" . $respuesta[$cont]['porcentaje_contratista'] . "% - " . $valor_corresponde_contratista . "$</td>";
                $tr .= "<td>" . $respuesta[$cont]['total'] . "$</td>";
                $tr .= "<td>" . $respuesta[$cont]['mantenimiento'] . "</td>";
                $tr .= "<td>" . $respuesta[$cont]['nombre_cuenta'] . "</td>";
                $tr .= "<td>" . $respuesta[$cont]['num_cuenta'] . "</td>";
                $tr .= "<td><button type='button' class='btn btn-success btn-asume' data-toggle='modal' data-target='#modalAsume' idvehiculo='{$respuesta[$cont]['idvehiculo']}' idcliente='{$respuesta[$cont]['idcliente']}' idcuenta='{$respuesta[$cont]['idcuenta']}' cliente='{$respuesta[$cont]['cliente']}' num_cuenta='{$respuesta[$cont]['num_cuenta']}' nombre_cuenta='{$respuesta[$cont]['nombre_cuenta']}' total='{$respuesta[$cont]['total']}' iva='{$respuesta[$cont]['iva']}' valor='{$respuesta[$cont]['valor']}' cantidad='{$respuesta[$cont]['cantidad']}' idorden='{$respuesta[$cont]['idorden']}' id='{$respuesta[$cont]['id']}' descripcion='{$respuesta[$cont]['descripcion']}' ><i class='fas fa-wallet'></i></button></td>";
    
    
                $cont++; // Aumento una posición más del contador que me posiciona dentro del arreglo de programación
    
                echo $tr;
            }

        }else{
            $tr = "";
            echo $tr;
        }

    }

    /* ===================================================
        VER EMPRESA
    ===================================================*/
    static public function ajaxAsumeVerEmpresa()
    {
        $respuesta = ModeloEmpresaRaiz::mdlVerEmpresa();
        echo json_encode($respuesta);
    }

    /* ===================================================
        LISTA DE SUCURSALES PARA EL PRODUCTO
    ===================================================*/
    static public function ajaxListaSucursalesProductos($idproducto, $consecutivo)
    {
        $respuesta = ModeloProductos::mdlSucursalesInventario($idproducto);
        $tr = "";

        foreach ($respuesta as $key => $value) {
            $tr .= "
            <tr>
            <td>
            <div class='btn-group' role='group' aria-label='Button group'>
            <button data-toggle='tooltip' data-placement='top' title='Seleccionar producto' consecutivo = '{$consecutivo}' codigo = '{$value["codigo"]}' referencia='{$value["referencia"]}' descripcion='{$value["descripcion"]}' value='{$value["idproducto"]}' inventario ='{$value["idinventario"]}' valor='{$value["precio_compra"]}' nombre_proveedor='{$value["nombre_proveedor"]}' idproveedor='{$value["idproveedor"]}' class='btn btn-sm btn-success btnSeleccionarProducto'><i class='fas fa-check'></i></button>
            </div>
            </td>
            <td>" . $value['descripcion'] . "</td>
            <td>" . $value['referencia'] . "</td>
            <td>" . $value['stock'] . "</td>
            <td>" . $value['posicion'] . "</td>
            <td>" . $value['sucursal'] . "</td>
            <td>" . $value['precio_compra'] . "</td>
            </tr>
            
            ";
        }

        echo $tr;
    }


    /* ===================================================
        GUARDAR QUIEN ASUME
    ===================================================*/
    static public function ajaxGuardarAsume($datos)
    {

        $respuesta = ControladorMantenimientos::ctrGuardaAsume($datos);
        echo $respuesta;
    }

    /* ===================================================
        CARGAR DATOS DE QUIÉN ASUME
    ===================================================*/
    static public function ajaxCargarAsume($idcontrol)
    {
        $respuesta = ModeloMantenimientos::mdlDatosAsume($idcontrol);
        echo json_encode($respuesta);
    }


    /* ===================================================
        DATOS DE UNA CUENTA CONTABLE
    ===================================================*/
    static public function ajaxCargarDatosCuenta($idcuenta)
    {
        $respuesta = ModeloMantenimientos::mdlDatosCuenta($idcuenta);
        echo json_encode($respuesta);
    }

    /* ===================================================
        TABLA PROGRAMACIÓN
    ===================================================*/
    static public function ajaxTablaProgramacion()
    {
        $respuesta = ControladorMantenimientos::ctrListaProgramacion();

        if(!empty($respuesta))
        {
            $placas = array();
            foreach ($respuesta as $key => $value) {
                array_push($placas, $value['placa']);
            }
    
            //GENERA UN ARRRAY CON LA CANTIDAD DE VECES QUE HAY UNA PLACA 
            foreach ($placas as $key => $value) {
                $rowspan = array_count_values($placas);
            }
    
            $repetidas = array();
    
            //var_dump($rowspan);
            $cont = 0; // Define la posición en la que me encuentro dentro del arreglo de programación
    
            // Recorro el arreglo con las placas y su respectivo contador
            foreach ($rowspan as $key => $value) {
                $tr = "";
    
                $numfilas = $value; //num filas repetidas de cada registro
    
                // Escribiendo las primeras columnas con rowspan de la tabla 
                $tr .= "
                         <tr>
                            <td data-datatable-multi-row-rowspan='$numfilas'>
                                <button type='button' class='btn btn-info btn-md btn-serviciosprogramacion' idsolicitud='{$respuesta[$cont]['idsolicitud']}' data-toggle='modal' data-target='#servicios'> <i class='fas fa-clipboard-list'></i></button>
                                <button type='button' class='btn btn-warning btn-md btn-programacionxvehiculo' idsolicitud='{$respuesta[$cont]['idsolicitud']}' idvehiculo='{$respuesta[$cont]['idvehiculo']}' data-toggle='modal' data-target='#serviciosxvehiculo' style='display:none;'> <i class='far fa-calendar-alt'></i> </button>
                                <button  type='button' class='btn btn-success btn-md btn-programacion' idsolicitud='{$respuesta[$cont]['idsolicitud']}' idvehiculo='{$respuesta[$cont]['idvehiculo']}' data-toggle='modal' data-target='#Programacion'> <i class='far fa-clock'></i></button>
    
                            </td>
                            <td data-datatable-multi-row-rowspan='$numfilas'>" . $respuesta[$cont]['placa'] . "</td>
                            <td data-datatable-multi-row-rowspan='$numfilas'>" . $respuesta[$cont]['numinterno'] . "</td>
                            <td data-datatable-multi-row-rowspan='$numfilas'>" . $respuesta[$cont]['kilometraje_actual'] . "</td>
                            <td data-datatable-multi-row-rowspan='$numfilas'>" . $respuesta[$cont]['fecha_solicitud'] . "</td>
                            <td data-datatable-multi-row-rowspan='$numfilas'>" . $respuesta[$cont]['fecha_programacion']; // . "</td>"; // La columna anterior a la columna que si tiene varias filas juntas, no se puede cerrar aún
                // Si existe más de una fila abre el script y luego itera por cada uno
                if ($numfilas > 1) {
                    $tr .= "<script type='x/template' class='extra-row-content'>"; // abre script
    
                    // Comienza iteración
                    for ($i = 0; $i < $numfilas - 1; $i++) { // $numfilas - 1 para cerrar el script antes de escribir el último item que debería iterar
                        // Por cada uno tiene que abrir también un tr
                        $tr .= "
                                    <tr><td>" . $respuesta[$cont]['item'] . "</td></tr>
                            ";
    
                        $cont++; // Aumento la posición
                    }
    
                    // Cierro script
                    $tr .= "</script>";
                }
                // Cierro td anterior al td que itera muchas veces, en este caso el de fecha programación, si no entra ninguna vez a la condición anterior pues simplemente sale
                $tr .= "</td>";
                // Monta el último item que se iteró, si no tuvo que iterar solo se escribe y ya
                $tr .= "<td>" . $respuesta[$cont]['item'] . "</td>";
    
                // Últimas columnas de la tabla
                if ($respuesta[$cont]['tiempo_mantenimiento'] != "") {
    
                    $tr .= "
                                <td data-datatable-multi-row-rowspan='$numfilas'>" . $respuesta[$cont]['tiempo_mantenimiento'] . " Días</td>
                                <td data-datatable-multi-row-rowspan='$numfilas'>" . $respuesta[$cont]['observacion'] . "</td>
                            </tr>
                            ";
                } else {
                    $tr .= "
                                <td data-datatable-multi-row-rowspan='$numfilas'>" . $respuesta[$cont]['tiempo_mantenimiento'] . "</td>
                                <td data-datatable-multi-row-rowspan='$numfilas'>" . $respuesta[$cont]['observacion'] . "</td>
                            </tr>
                            ";
                }
                $cont++; // Aumento una posición más del contador que me posiciona dentro del arreglo de programación
                echo $tr;
            }

        }else{
            $tr = "";
            echo $tr;
        }


        // Ejemplo
        // echo "
        //     <tr>
        //         <td data-datatable-multi-row-rowspan='3'>
        //             Brad Jones
        //             <script type='x/template' class='extra-row-content'>
        //                 <tr>
        //                 <td>
        //                     Brad Jones is such a nice guy! I have written notes about him.
        //                 </td>
        //                 <td>
        //                     Brad Jones 2 is such a nice guy! I have written notes about him.
        //                 </td>
        //                 <td>
        //                     <ul>
        //                     <li>Rachel, Wife</li>
        //                     <li>Deshawn, Son</li>
        //                     <li>Marian, Daughter</li>
        //                     </ul>
        //                 </td>
        //                 </tr>
        //                 <tr>
        //                 <td>
        //                     Brad Jones is such a nice guy! I have written notes about him.
        //                 </td>
        //                 <td>
        //                     Brad Jones 2 is such a nice guy! I have written notes about him.
        //                 </td>
        //                 <td>
        //                     <ul>
        //                     <li>Rachel, Wife</li>
        //                     <li>Deshawn, Son</li>
        //                     <li>Marian, Daughter</li>
        //                     </ul>
        //                 </td>
        //                 </tr>
        //             </script>
        //         </td>
        //         <td>4/15/2011</td>
        //         <td>Philadelphia</td>
        //         <td>3</td>
        //         <td data-datatable-multi-row-rowspan='3'>$65,000</td>
        //     </tr>
        //     <tr>
        //         <td data-datatable-multi-row-rowspan='2'>
        //         Martha Williams
        //         <script type='x/template' class='extra-row-content'>
        //             <tr>
        //             <td colspan='2'>
        //                 I first met Martha at a laundromat.
        //             </td>
        //             <td>
        //                 <ul>
        //                 <li>Marshall, Husband</li>
        //                 <li>Marshall Jr., Son</li>
        //                 </ul>
        //             </td>
        //             </tr>
        //         </script>
        //         </td>
        //         <td>9/3/2015</td>
        //         <td>Annapolis</td>
        //         <td>2</td>
        //         <td data-datatable-multi-row-rowspan='2'>$7,800</td>
        //     </tr>
        // ";
    }

    /* ===================================================
        TABLA PROGRAMACIÓN POR VEHÍCULO
    ===================================================*/
    static public function ajaxTablaProgramacionxVehiculo($idvehiculo)
    {

        $respuesta = ModeloMantenimientos::mdlProgramacionxVehiculo($idvehiculo);
        
        

        if(!empty($respuesta)){
            
            $placas = array();
            foreach ($respuesta as $key => $value) {
                array_push($placas, $value['placa']);
            }
            
            $rowspan = array();
            //GENERA UN ARRRAY CON LA CANTIDAD DE VECES QUE HAY UNA PLACA 
            foreach ($placas as $key => $value) {
                $rowspan = array_count_values($placas);
            }
    
            $repetidas = array();
    
            //var_dump($rowspan);
            $cont = 0; // Define la posición en la que me encuentro dentro del arreglo de programación
    
            // Recorro el arreglo con las placas y su respectivo contador
            foreach ($rowspan as $key => $value) {
                $tr = "";
    
                $numfilas = $value; //num filas repetidas de cada registro
    
                // Escribiendo las primeras columnas con rowspan de la tabla 
                $tr .= "
                         <tr>
                            
                            
                            <td data-datatable-multi-row-rowspan='$numfilas'>" . $respuesta[$cont]['kilometraje_actual']; // . "</td>"; // La columna anterior a la columna que si tiene varias filas juntas, no se puede cerrar aún
                // Si existe más de una fila abre el script y luego itera por cada uno
                if ($numfilas > 1) {
                    $tr .= "<script type='x/template' class='extra-row-content'>"; // abre script
    
                    // Comienza iteración
                    for ($i = 0; $i < $numfilas - 1; $i++) { // $numfilas - 1 para cerrar el script antes de escribir el último item que debería iterar
                        // Por cada uno tiene que abrir también un tr
    
                        $fecha_Actual = date('Y-m-d');
                        $semaforo = ControladorVehiculos::Semaforo_tipo1($respuesta[$cont]['fecha_comparar'], $fecha_Actual);
    
                        //VALIDACIÓN SI EL KILOMETRAJE YA SE PASÓ
                        if ($respuesta[$cont]['kilometraje_servicio'] != 0 && $respuesta[$cont]['kilometraje_actual'] >= $respuesta[$cont]['kilometraje_cambio']) {
                            $kilometraje = "<td class='bg-danger'>" . $respuesta[$cont]['kilometraje_cambio'] .  "</td>";
                        }
                        if ($respuesta[$cont]['kilometraje_servicio'] == 0) {
                            $kilometraje = "<td>No aplica</td>";
                        } else {
                            $kilometraje = "<td class='bg-success'>" . $respuesta[$cont]['kilometraje_cambio'] .  "</td>";
                        }
    
                        if ($respuesta[$cont]['ruta_foto'] != "") {
    
                            $tr .= "
                                        <tr><td>" . $respuesta[$cont]['item'] . "</td>
                                        $kilometraje
                                        <td class='bg-" . $semaforo . "' >" . $respuesta[$cont]['fecha_cambio'] . "</td>
                                        <td><a href=' " . $respuesta[$cont]['ruta_foto'] . "' target='_blank' class='btn btn-sm btn-info m-1' type='button'><i class='fas fa-file-alt'></i></a></td>
                                        </tr>
                                ";
                        } else {
                            $tr .= "
                                        <tr><td>" . $respuesta[$cont]['item'] . "</td>
                                        $kilometraje 
                                        <td class='bg-" . $semaforo . "'>" . $respuesta[$cont]['fecha_cambio'] . "</td>
                                        <td> Sin evidencia </td>
                                        </tr>
                                ";
                        }
    
    
                        $cont++; // Aumento la posición
                    }
    
                    // Cierro script
                    $tr .= "</script>";
                }
    
                $fecha_Actual = date('Y-m-d');
                $semaforo = ControladorVehiculos::Semaforo_tipo1($respuesta[$cont]['fecha_comparar'], $fecha_Actual);
    
                //VALIDACIÓN SI EL KILOMETRAJE YA SE PASÓ
                if ($respuesta[$cont]['kilometraje_servicio'] != 0 && $respuesta[$cont]['kilometraje_actual'] >= $respuesta[$cont]['kilometraje_cambio']) {
                    $kilometraje = "<td class='bg-danger'>" . $respuesta[$cont]['kilometraje_cambio'] .  "</td>";
                }
                if ($respuesta[$cont]['kilometraje_servicio'] == 0) {
                    $kilometraje = "<td>No aplica</td>";
                } else {
                    $kilometraje = "<td class='bg-success'>" . $respuesta[$cont]['kilometraje_cambio'] .  "</td>";
                }
    
    
    
    
                // Cierro td anterior al td que itera muchas veces, en este caso el de fecha programación, si no entra ninguna vez a la condición anterior pues simplemente sale
                $tr .= "</td>";
    
    
                if ($respuesta[$cont]['ruta_foto'] != "") {
                    $tr .= "<td>" . $respuesta[$cont]['item'] . "</td>";
                    $tr .= $kilometraje;
                    $tr .= "<td>No aplica</td>";
                    $tr .= "<td><a href=' " . $respuesta[$cont]['ruta_foto'] . "' target='_blank' class='btn btn-sm btn-info m-1' type='button'><i class='fas fa-file-alt'></i></a></td>";
                    $tr .= "
                            <td data-datatable-multi-row-rowspan='$numfilas'>" . $respuesta[$cont]['fecha_programacion'] . "</td>
                        </tr>
                        ";
                } else {
                    $tr .= "<td>" . $respuesta[$cont]['item'] . "</td>";
                    $tr .= $kilometraje;
                    $tr .= "<td  class='bg-" . $semaforo . "'> ".$respuesta[$cont]['fecha_cambio']."</td>";
                    $tr .= "<td>Sin evidencia </td>";
                    $tr .= "
                            <td data-datatable-multi-row-rowspan='$numfilas'>" . $respuesta[$cont]['fecha_programacion'] . "</td>
                        </tr>
                        ";
                }
    
    
                // Monta el último item que se iteró, si no tuvo que iterar solo se escribe y ya
                // $tr .= "<td>" . $respuesta[$cont]['item'] . "</td>";
                // $tr .= $kilometraje;
                // $tr .= "<td>" . $respuesta[$cont]['fecha_cambio'] . "</td>";
                // $tr .= "<td><a href=' " . $respuesta[$cont]['ruta_foto'] . "' target='_blank' class='btn btn-sm btn-info m-1' type='button'><i class='fas fa-file-alt'></i></a></td>";
                // $tr .= "
                //             <td data-datatable-multi-row-rowspan='$numfilas'>" . $respuesta[$cont]['fecha_programacion'] . "</td>
                //         </tr>
                //         ";
    
    
                $cont++; // Aumento una posición más del contador que me posiciona dentro del arreglo de programación
                echo $tr;
            }
        }else{
            $tr = "";
            echo $tr;
        }

    }

    /* ===================================================
        TABLA PROGRAMACIÓN POR VEHÍCULO
    ===================================================*/
    // static public function ajaxTablaProgramacionxVehiculo($idvehiculo)
    // {
    //     $respuesta = ModeloMantenimientos::mdlProgramacionxVehiculo($idvehiculo);

    //     $placas = array();
    //     foreach ($respuesta as $key => $value) {
    //         array_push($placas, $value['placa']);
    //     }

    //     //GENERA UN ARRRAY CON LA CANTIDAD DE VECES QUE HAY UNA PLACA 
    //     foreach ($placas as $key => $value) {
    //         $rowspan = array_count_values($placas);
    //     }

    //     //Array que nos guarda las placas que ya se pusieron en la tabla para así juntar los itemas
    //     $repetidas = array();


    //     foreach ($respuesta as $key => $value) {

    //         $tr = "";
    //         //Si la placa está en el array es porque ya se hizo una fila de sus datos en la tabla
    //         //Entonces se añaden los items a la misma fila, si no hay fila de esa placa
    //         //Se crea una nueva fila con todo

    //         if (in_array($value['placa'], $repetidas)) {
    //             $fecha_Actual = date('Y-m-d');
    //             $semaforo = ControladorVehiculos::Semaforo_tipo1($value['fecha_comparar'], $fecha_Actual);

    //             // VALIDACIÓN SI LA FECHA YA VENCIÓ 
    //             // if ($fecha_Actual < $value['fecha_comparar']) {
    //             //     $fecha = "<td class='bg-success' > " . $value['fecha_cambio']   . "</td>";
    //             // }
    //             // else if ($fecha_Actual > $value['fecha_comparar']) {
    //             //     $fecha = "<td class='bg-danger' > " . $value['fecha_cambio'] .  "</td>";
    //             // } else if($value['fecha_comparar'] == null || $value['fecha_comparar'] == "" || !isset($value['fecha_comparar'])){
    //             //     $fecha = "<td>No aplica </td>";
    //             // }



    //             //VALIDACIÓN SI EL KILOMETRAJE YA SE PASÓ
    //             if ($value['kilometraje_servicio'] != 0 && $value['kilometraje_actual'] >= $value['kilometraje_cambio']) {
    //                 $kilometraje = "<td class='bg-danger'>" . $value['kilometraje_cambio'] .  "</td>";
    //             }
    //             if ($value['kilometraje_servicio'] == 0) {
    //                 $kilometraje = "<td>No aplica</td>";
    //             } else {
    //                 $kilometraje = "<td class='bg-success'>" . $value['kilometraje_cambio'] .  "</td>";
    //             }

    //             //VALIDACION SI VIENE EVIDENCIA
    //             if ($value['ruta_foto'] != NULL or $value['ruta_foto'] != "") {

    //                 $tr .= "
    //                 <tr>
    //                 <td>" . $value['item'] . "</td>
    //                 $kilometraje 
    //                 <td>No aplica</td>
    //                 <td><a href=' " . $value['ruta_foto'] . "' target='_blank' class='btn btn-sm btn-info m-1' type='button'><i class='fas fa-file-alt'></i></a></td>


    //                 </tr>
    //                 ";
    //             } else {
    //                 $tr .= "
    //                 <tr>
    //                 <td>" . $value['item'] . "</td>
    //                 $kilometraje 
    //                 <td class='bg-{$semaforo}'> " . $value['fecha_cambio'] . "</td>
    //                 <td>Sin evidencia</td>


    //                 </tr>
    //                 ";
    //             }
    //         } else {
    //             $fecha_Actual = date('Y-m-d');


    //             // VALIDACIÓN SI LA FECHA YA VENCIÓ 
    //             // if ($fecha_Actual < $value['fecha_comparar']) {
    //             //     $fecha = "<td class='bg-success' > " . $value['fecha_cambio']   . "</td>";
    //             // }
    //             // else if ($fecha_Actual > $value['fecha_comparar']) {
    //             //     $fecha = "<td class='bg-danger' > " . $value['fecha_cambio'] .  "</td>";
    //             //     echo $value['fecha_comparar'];
    //             // } else if($value['fecha_comparar'] == null || $value['fecha_comparar'] == "" || !isset($value['fecha_comparar'])){
    //             //     $fecha = "<td>No aplica </td>";
    //             // }

    //             $semaforo = ControladorVehiculos::Semaforo_tipo1($value['fecha_comparar'], $fecha_Actual);


    //             //VALIDACIÓN SI EL KILOMETRAJE YA SE PASÓ
    //             if ($value['kilometraje_servicio'] != 0 && $value['kilometraje_actual'] >= $value['kilometraje_cambio']) {
    //                 $kilometraje = "<td class='bg-danger'>" . $value['kilometraje_cambio'] .  "</td>";
    //             }
    //             if ($value['kilometraje_servicio'] == 0) {
    //                 $kilometraje = "<td>No aplica</td>";
    //             } else {
    //                 $kilometraje = "<td class='bg-success'>" . $value['kilometraje_cambio'] .  "</td>";
    //             }

    //             array_push($repetidas, $value['placa']);
    //             //El $rowspan[$value['placa']]' me devuelve la cantidad de veces que está la misma
    //             //Placa en la programación, de ese modo sabemos cuantas filas combinar

    //             if ($value['ruta_foto'] != NULL or $value['ruta_foto'] != "") {

    //                 $tr .= "
    //                     <tr>

    //                         <td rowspan='{$rowspan[$value['placa']]}'>" . $value['kilometraje_actual'] . "</td>
    //                         <td>" . $value['item'] . "</td>
    //                         $kilometraje
    //                         <td>No aplica</td>
    //                         <td>" . $value['ruta_foto'] . "</td>
    //                         <td rowspan='{$rowspan[$value['placa']]}'>" . $value['fecha_programacion'] . " </td>
    //                         <td><a href=' " . $value['ruta_foto'] . "' target='_blank' class='btn btn-sm btn-info m-1' type='button'><i class='fas fa-file-alt'></i></a></td>

    //                     </tr>


    //                 ";
    //             } else {
    //                 $tr .= "
    //                     <tr>

    //                         <td rowspan='{$rowspan[$value['placa']]}'>" . $value['kilometraje_actual'] . "</td>
    //                         <td>" . $value['item'] . "</td>
    //                         $kilometraje
    //                         <td class='bg-{$semaforo}'> " . $value['fecha_cambio'] . "</td>
    //                         <td>Sin evidencia</td>
    //                         <td rowspan='{$rowspan[$value['placa']]}'>" . $value['fecha_programacion'] . " </td>

    //                     </tr>
    //                 ";
    //             }
    //         }
    //         echo $tr;
    //     }
    // }

    /* ===================================================
        DATOS PROGRAMACIÓN POR VEHÍCULO    
    ===================================================*/
    static public function ajaxItemsProgramacionxVehiculo($idvehiculo)
    {
        $respuesta = ModeloMantenimientos::mdlProgramacionxVehiculo($idvehiculo);

        $str = "";

        foreach ($respuesta as $key => $value) {
            $str .= "
            " . $value['item'] . " , 
            ";
        }

        //ELIMINAMOS SALTOS DE LINEA 
        $str = trim(preg_replace('/\s+/', ' ', $str));

        echo $str;
    }

    /* ===================================================
        GUARDAR SOLICITUD
    ===================================================*/

    static public function ajaxGuardarSolicitudProgramacion($datos)
    {
        $respuesta = ControladorMantenimientos::ctrGuardarSolicitudProgramacion($datos);
        echo $respuesta;
    }



    /* ===================================================
        TABLA HISTORIAL SOLICITUDES PROGRAMACIÓN
    ===================================================*/
    static public function ajaxHistorialSolicitudesProgramacion()
    {
        $respuesta = ModeloMantenimientos::mdlHistorialSolicitudesProgramacion();
        $tr = "";

        foreach ($respuesta as $key => $value) {

            if (is_numeric($value['tiempo_mantenimiento'])) {
                $tiempo = " <td> " . $value['tiempo_mantenimiento'] . " Días </td>";
            } else {
                $tiempo = " <td> " . $value['tiempo_mantenimiento'] . "</td>";
            }


            $tr .= "
            <tr>
            <td>" . $value['idsolicitud'] . "</td>
            <td>" . $value['placa'] . "</td>
            <td>" . $value['descripcion'] . "</td>
            <td>" .  $value['Ffecha_solicitud']  . "</td>
            <td>" . $value['Ffecha_programacion'] . "</td>
            $tiempo
            <td>" . $value['estado'] . "</td>
            <td>" . $value['observacion'] . "</td>
            </tr>
            ";
        }


        echo $tr;
    }

    /* ===================================================
        EXPORTAR EXCEL CONTROL DE ACTIVIDADES
    ===================================================*/
    static public function ajaxExcelControlActividades()
    {
        # AUTOLOAD
        require_once DIR_APP . 'vendor/autoload.php';


        # Requiero los modelos
        require_once DIR_APP . 'models/mantenimiento.modelo.php';
        require_once DIR_APP . 'models/conceptos.modelo.php';

        ControladorMantenimientos::ctrExcelControlActividades();
    }


    /* ===================================================
        EXPORTAR EXCEL SOLICITUDES PROGRAMACION
    ===================================================*/
    static public function ajaxExcelSolicitudesProgramacion()
    {
        # AUTOLOAD
        require_once DIR_APP . 'vendor/autoload.php';


        # Requiero los modelos
        require_once DIR_APP . 'models/mantenimiento.modelo.php';
        require_once DIR_APP . 'models/conceptos.modelo.php';

        ControladorMantenimientos::ctrExcelSolicitudesProgramacion();
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
if (isset($_POST['Guardar_OrdenServicio']) && $_POST['Guardar_OrdenServicio'] == "ok") AjaxMantenimientos::ajaxGuardarEditarOrdenServicio($_POST);

#LLAMADO A CARGAR DATOS ORDEN DE SERVICIO
if (isset($_POST['DatosOrdenServicio']) && $_POST['DatosOrdenServicio'] == "ok") AjaxMantenimientos::ajaxCargarOrden($_POST['idorden']);

#LLAMADO A TABLA SERVICIOS
if (isset($_POST['ListaServicios']) && $_POST['ListaServicios'] == "ok") AjaxMantenimientos::ajaxListaServicios($_POST['consecutivo'], $_POST['seccion']);

#LLAMADO A LISTA DE CONTABLES 
if (isset($_POST['ListaCuentasContables']) && $_POST['ListaCuentasContables'] == "ok") AjaxMantenimientos::ajaxListaCuentasContables($_POST['consecutivo'], $_POST['seccion']);

#LLAMADO A CARGAR TABLA DE CONTROL DE ACTIVIDADES 
if (isset($_POST['TablaControlActividades']) && $_POST['TablaControlActividades'] == "ok") AjaxMantenimientos::ajaxListadoControlActividades();

#LLAMADO A MOSTRAR EMPRESA 
if (isset($_POST['AsumeVerEmpresa']) && $_POST['AsumeVerEmpresa'] == "ok") AjaxMantenimientos::ajaxAsumeVerEmpresa();

#LLAMADO A LISTA DE SUCURSALES PRODUCTOS
if (isset($_POST['SucursalesProductos']) && $_POST['SucursalesProductos'] == "ok") AjaxMantenimientos::ajaxListaSucursalesProductos($_POST['idproducto'], $_POST['consecutivo']);

#LLAMADO A GUARDAR QUIEN ASUME 
if (isset($_POST['GuardarAsume']) && $_POST['GuardarAsume'] == "ok") AjaxMantenimientos::ajaxGuardarAsume($_POST);

#LLAMADO A CARGAR DATOS ASUME 
if (isset($_POST['DatosAsume']) && $_POST['DatosAsume'] == "ok") AjaxMantenimientos::ajaxCargarAsume($_POST['idcontrol']);

#LLAMADO A CARGAR DATOS DE UNA CUENTA CONTABLE 
if (isset($_POST['datosCuenta']) && $_POST['datosCuenta'] == "ok") AjaxMantenimientos::ajaxCargarDatosCuenta($_POST['idcuenta']);

#LLAMADO A CARGAR TABLA PROGRAMACIÓN 
if (isset($_POST['TablaProgramacion']) && $_POST['TablaProgramacion'] == "ok") AjaxMantenimientos::ajaxTablaProgramacion();

#LLAMADO A CARGAR TABLA DE PROGRAMACIÓN POR VEHÍCULO 
if (isset($_POST['TablaProgramacionxVehiculo']) && $_POST['TablaProgramacionxVehiculo'] == "ok") AjaxMantenimientos::ajaxTablaProgramacionxVehiculo($_POST['idvehiculo']);

#LLAMADO A ITEMS PROGRAMACIÓN POR VEHÍCULO
if (isset($_POST['ItemsProgramacionxVehiculo']) && $_POST['ItemsProgramacionxVehiculo'] == "ok") AjaxMantenimientos::ajaxItemsProgramacionxVehiculo($_POST['idvehiculo']);

#LLAMADO A GUARDAR SOLICITUD 
if (isset($_POST['GuardarSolicitudProgramacion']) && $_POST['GuardarSolicitudProgramacion'] == "ok") AjaxMantenimientos::ajaxGuardarSolicitudProgramacion($_POST);

#LLAMADO A CARGAR TABLA HISTORIAL SOLICITUDES DE PROGRAMACIÓN
if (isset($_POST['TablaHistorialSolicitudesProgramacion']) && $_POST['TablaHistorialSolicitudesProgramacion'] == "ok") AjaxMantenimientos::ajaxHistorialSolicitudesProgramacion();

#LLAMADO A EXPORTAR EXCEL CONTROL DE ACTIVIDADES 
if (isset($_GET['ExcelControlActividades']) && $_GET['ExcelControlActividades'] == "ok") AjaxMantenimientos::ajaxExcelControlActividades();

#LLAMADO A EXPORTAR EXCEL CONTROL DE ACTIVIDADES 
if (isset($_GET['ExcelSolicitudesProgramacion']) && $_GET['ExcelSolicitudesProgramacion'] == "ok") AjaxMantenimientos::ajaxExcelSolicitudesProgramacion();
