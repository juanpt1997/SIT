<?php

class ControladorAlmacen
{
    //Metodo para validar un inventario existente con un producto y una sucursal
    static public function ctrValidarInventario($datos)
    {

        $inventarioExistente = ModeloProductos::mdlValidarInventario($datos);

        if (is_array($inventarioExistente)) {

            $nuevoStock = $inventarioExistente['stock'] + $datos['cantidad'];
            $datos['idinventario'] = $inventarioExistente['idinventario'];
            $datos['tipo_movimiento'] = 'ENTRADA';

            $datos2 = array(
                'idinventario' => $inventarioExistente['idinventario'],
                'stock' =>  $nuevoStock,
                'posicion' => $datos['posicion']
            );

            ModeloProductos::mdlEditarInventario($datos2);
            ModeloProductos::mdlAgregarMovimiento($datos);

            return 'editado';
        } else {
            $idinventario = ModeloProductos::mdlAgregarInventario($datos);
            $datos['idinventario'] = $idinventario;
            $datos['tipo_movimiento'] = 'ENTRADA';
            ModeloProductos::mdlAgregarMovimiento($datos);

            return 'agregado';
        }
    }

    static public function ctrModificarInventario($datos)
    {
        $inventarioExistente = ModeloProductos::mdlDatosInventario($datos['idinventario']);

        if ($datos['stock'] < $inventarioExistente['stock']) {
            $datos['tipo_movimiento'] = 'SALIDA';
            $datos['cantidad'] = abs($datos['stock'] - $inventarioExistente['stock']);

            ModeloProductos::mdlAgregarMovimiento($datos);
        } else if ($datos['stock'] > $inventarioExistente['stock']) {

            $datos['tipo_movimiento'] = 'ENTRADA';
            $datos['cantidad'] = abs($datos['stock'] - $inventarioExistente['stock']);

            ModeloProductos::mdlAgregarMovimiento($datos);
        } else {
        }

        $respuesta = ModeloProductos::mdlEditarInventario($datos);
        return $respuesta;
    }

    // static public function ctrAgregarEditarOrdenCompra($datos, $imagen, $imagen2, $imagen3)
    // {
    //     if (isset($datos['idorden_compra']) && $datos['idorden_compra'] == "") {

    //         $response = "";

    //         /* ================================================
    //         CREAMOS DIRECTORIO DONDE VAMOS A GUARDAR EL ARCHIVO
    //         ================================================ */
    //         # Verificar Directorio imagenes mantenimiento
    //         $directorio = DIR_APP . "views/img/imgCotizacionesInventario";
    //         if (!is_dir($directorio)) {
    //             mkdir($directorio, 0755);
    //         }

    //         $fecha = date('Y-m-d');
    //         $hora = date('His');

    //         /* ===================================================
    //         GUARDAMOS EL ARCHIVO 1
    //         ===================================================*/
    //         $GuardarArchivo = new FilesController();
    //         $GuardarArchivo->file = $imagen;
    //         $aleatorio = mt_rand(100, 999);
    //         $GuardarArchivo->ruta = $directorio . "/{$aleatorio}_{$fecha}_{$hora}";

    //         if (is_array($imagen)) {
    //             # Si es pdf
    //             if ($imagen['type'] == "application/pdf") {
    //                 $response = $GuardarArchivo->ctrPDFFiles();
    //             } else {
    //                 # Si es una imagen
    //                 if ($imagen['type'] == "image/jpeg" || $imagen['type'] == "image/png") {
    //                     $response = $GuardarArchivo->ctrImages(null, null);
    //                 }
    //             }
    //         } else {
    //             $response = "";
    //         }

    //         /* ===================================================
    //         GUARDAMOS EL ARCHIVO 2
    //         ===================================================*/
    //         $GuardarArchivo2 = new FilesController();
    //         $GuardarArchivo2->file = $imagen2;
    //         $aleatorio = mt_rand(100, 999);
    //         $GuardarArchivo2->ruta = $directorio . "/{$aleatorio}_{$fecha}_{$hora}";

    //         if (is_array($imagen2)) {
    //             # Si es pdf
    //             if ($imagen2['type'] == "application/pdf") {
    //                 $response2 = $GuardarArchivo2->ctrPDFFiles();
    //             } else {
    //                 # Si es una imagen
    //                 if ($imagen2['type'] == "image/jpeg" || $imagen2['type'] == "image/png") {
    //                     $response2 = $GuardarArchivo2->ctrImages(null, null);
    //                 }
    //             }
    //         } else {
    //             $response2 = "";
    //         }

    //         /* ===================================================
    //         GUARDAMOS EL ARCHIVO 3
    //         ===================================================*/
    //         $GuardarArchivo3 = new FilesController();
    //         $GuardarArchivo3->file = $imagen3;
    //         $aleatorio = mt_rand(100, 999);
    //         $GuardarArchivo3->ruta = $directorio . "/{$aleatorio}_{$fecha}_{$hora}";

    //         if (is_array($imagen3)) {
    //             # Si es pdf
    //             if ($imagen3['type'] == "application/pdf") {
    //                 $response3 = $GuardarArchivo3->ctrPDFFiles();
    //             } else {
    //                 # Si es una imagen
    //                 if ($imagen3['type'] == "image/jpeg" || $imagen3['type'] == "image/png") {
    //                     $response3 = $GuardarArchivo3->ctrImages(null, null);
    //                 }
    //             }
    //         } else {
    //             $response3 = "";
    //         }

    //         # Actualizar el campo de la base de datos donde queda la ruta del archivo
    //         if ($response != "" || $response2 != "" || $response3 != "") {

    //             $rutaDoc = str_replace(DIR_APP, "", $response);
    //             $rutaDoc2 = str_replace(DIR_APP, "", $response2);
    //             $rutaDoc3 = str_replace(DIR_APP, "", $response3);

    //             $datosGuardar = array(
    //                 'num_cotizacion' => $datos['numcotizacion'],
    //                 'forma_pago' => $datos['formadepago'],
    //                 'idproveedor' => $datos['proveedor2'],
    //                 'tipo_compra' => $datos['tipo_compra'],
    //                 'direccion_entrega' => $datos['direccion_entrega'],
    //                 'observaciones' => $datos['observaciones'],
    //                 'ruta_cotizacion_1' => $rutaDoc,
    //                 'ruta_cotizacion_2' => $rutaDoc2,
    //                 'ruta_cotizacion_3' => $rutaDoc3
    //             );

    //             $idorden = ModeloProductos::mdlAgregarOrden($datosGuardar);

    //             if (isset($datos['idproducto'])) {
    //                 foreach ($datos['idproducto'] as $key => $value) {
    //                     if ($value != "") {
    //                         $idproducto = intval($value);
    //                         ModeloProductos::mdlAgregarRegistroProductos($idorden, $idproducto);
    //                     }
    //                 }
    //             }

    //             return $idorden;
    //         } else {

    //             return "error";
    //         }
    //     }
    // }

    // static public function ctrAgregarEditarOrdenCompra2($datos, $imagen, $imagen2, $imagen3)
    // {
    //     $orden = ModeloProductos::mdlListarOrdenes($datos['idorden_compra']);

    //     $response = "";

    //     /* ================================================
    //         CREAMOS DIRECTORIO DONDE VAMOS A GUARDAR EL ARCHIVO
    //         ================================================ */
    //     # Verificar Directorio imagenes mantenimiento
    //     $directorio = DIR_APP . "views/img/imgCotizacionesInventario";
    //     if (!is_dir($directorio)) {
    //         mkdir($directorio, 0755);
    //     }

    //     $fecha = date('Y-m-d');
    //     $hora = date('His');

    //     /* ===================================================
    //         GUARDAMOS EL ARCHIVO 1
    //         ===================================================*/
    //     $GuardarArchivo = new FilesController();
    //     $GuardarArchivo->file = $imagen;
    //     $aleatorio = mt_rand(100, 999);
    //     $GuardarArchivo->ruta = $directorio . "/{$aleatorio}_{$fecha}_{$hora}";

    //     if (is_array($imagen)) {
    //         # Si es pdf
    //         if ($imagen['type'] == "application/pdf") {
    //             $response = $GuardarArchivo->ctrPDFFiles();
    //         } else {
    //             # Si es una imagen
    //             if ($imagen['type'] == "image/jpeg" || $imagen['type'] == "image/png") {
    //                 $response = $GuardarArchivo->ctrImages(null, null);
    //             }
    //         }
    //     } else {
    //         $response = "";
    //     }

    //     /* ===================================================
    //         GUARDAMOS EL ARCHIVO 2
    //         ===================================================*/
    //     $GuardarArchivo2 = new FilesController();
    //     $GuardarArchivo2->file = $imagen2;
    //     $aleatorio = mt_rand(100, 999);
    //     $GuardarArchivo2->ruta = $directorio . "/{$aleatorio}_{$fecha}_{$hora}";

    //     if (is_array($imagen2)) {
    //         # Si es pdf
    //         if ($imagen2['type'] == "application/pdf") {
    //             $response2 = $GuardarArchivo2->ctrPDFFiles();
    //         } else {
    //             # Si es una imagen
    //             if ($imagen2['type'] == "image/jpeg" || $imagen2['type'] == "image/png") {
    //                 $response2 = $GuardarArchivo2->ctrImages(null, null);
    //             }
    //         }
    //     } else {
    //         $response2 = "";
    //     }

    //     /* ===================================================
    //         GUARDAMOS EL ARCHIVO 3
    //         ===================================================*/
    //     $GuardarArchivo3 = new FilesController();
    //     $GuardarArchivo3->file = $imagen3;
    //     $aleatorio = mt_rand(100, 999);
    //     $GuardarArchivo3->ruta = $directorio . "/{$aleatorio}_{$fecha}_{$hora}";

    //     if (is_array($imagen3)) {
    //         # Si es pdf
    //         if ($imagen3['type'] == "application/pdf") {
    //             $response3 = $GuardarArchivo3->ctrPDFFiles();
    //         } else {
    //             # Si es una imagen
    //             if ($imagen3['type'] == "image/jpeg" || $imagen3['type'] == "image/png") {
    //                 $response3 = $GuardarArchivo3->ctrImages(null, null);
    //             }
    //         }
    //     } else {
    //         $response3 = "";
    //     }

    //     # Actualizar el campo de la base de datos donde queda la ruta del archivo
    //     if ($response != "" || $response2 != "" || $response3 != "") {
    //         $rutaDoc = str_replace(DIR_APP, "", $response);
    //         $rutaDoc2 = str_replace(DIR_APP, "", $response2);
    //         $rutaDoc3 = str_replace(DIR_APP, "", $response3);
    //     }

    //     if (isset($datos['idorden_compra']) && $datos['idorden_compra'] == "") {

    //         $datosGuardar = array(
    //             'idorden' => $datos['idorden_compra'],
    //             'estado_orden' => $datos['actualizar_estado'],
    //             'num_cotizacion' => $datos['numcotizacion'],
    //             'forma_pago' => $datos['formadepago'],
    //             'idproveedor' => $datos['proveedor2'],
    //             'tipo_compra' => $datos['tipo_compra'],
    //             'direccion_entrega' => $datos['direccion_entrega'],
    //             'observaciones' => $datos['observaciones'],
    //             'ruta_cotizacion_1' => $rutaDoc,
    //             'ruta_cotizacion_2' => $rutaDoc2,
    //             'ruta_cotizacion_3' => $rutaDoc3
    //         );

    //         $idorden = ModeloProductos::mdlAgregarOrden($datosGuardar);
    //         if (isset($datos['idproducto'])) {
    //             foreach ($datos['idproducto'] as $key => $value) {
    //                 if ($value != "") {
    //                     $idproducto = intval($value);
    //                     ModeloProductos::mdlAgregarRegistroProductos($idorden, $idproducto);
    //                 }
    //             }
    //         }

    //         return "agregado";
    //     } else {

    //         $datosGuardar = array(
    //             'idorden' => $datos['idorden_compra'],
    //             'estado_orden' => $datos['actualizar_estado'],
    //             'num_cotizacion' => $datos['numcotizacion'],
    //             'forma_pago' => $datos['formadepago'],
    //             'idproveedor' => $datos['proveedor2'],
    //             'tipo_compra' => $datos['tipo_compra'],
    //             'direccion_entrega' => $datos['direccion_entrega'],
    //             'observaciones' => $datos['observaciones'],
    //             'ruta_cotizacion_1' => $rutaDoc,
    //             'ruta_cotizacion_2' => $rutaDoc2,
    //             'ruta_cotizacion_3' => $rutaDoc3
    //         );
    //     }
    // }

    static public function ctrAgregarEditarOrdenCompra3($datos, $imagen, $imagen2, $imagen3)
    {
        $datosGuardar = array(
            'idorden' => $datos['idorden_compra'],
            'num_cotizacion' => $datos['numcotizacion'],
            'forma_pago' => $datos['formadepago'],
            'idproveedor' => $datos['proveedor2'],
            'tipo_compra' => $datos['tipo_compra'],
            'direccion_entrega' => $datos['direccion_entrega'],
            'observaciones' => $datos['observaciones'],
            'estado_orden' => $datos['actualizar_estado']
        );

        if (isset($datos['idorden_compra']) && $datos['idorden_compra'] == "") {

            $idorden = ModeloProductos::mdlAgregarOrden($datosGuardar);

            if (isset($datos['idproducto'])) {
                foreach ($datos['idproducto'] as $key => $value) {
                    if ($value != "") {
                        $idproducto = intval($value);
                        $cantidad = intval($datos['cantidad_producto'][$key]);
                        ModeloProductos::mdlAgregarRegistroProductos($idorden,$idproducto,$cantidad);
                    }
                }
            }

            $retorno = "agregado";
        } else {

            $idorden = ModeloProductos::mdlEditarOrden($datosGuardar);

            // if ($_POST['idregistroproducto'] == "") {
            //     if (isset($datos['idproducto'])) {
            //         foreach ($datos['idproducto'] as $key => $value) {
            //             if ($value != "") {
            //                 $idproducto = intval($value);
            //                 ModeloProductos::mdlAgregarRegistroProductos($idorden, $idproducto);
            //             }
            //         }
            //     }
            // } else {
            //     if (isset($datos['idproducto'])) {
            //         foreach ($datos['idproducto'] as $key => $value) {
            //             if ($value != "") {
            //                 $idproducto = intval($value);
            //                 ModeloProductos::mdlEditarRegistroProducto($idorden, $idproducto, $datos['idregistroproducto']);
            //             }
            //         }
            //     }
            // }
            $respuesta = ModeloProductos::mdlEliminarRegistroProductos($idorden);
            if (isset($datos['idproducto']) && $respuesta == "ok") {
                foreach ($datos['idproducto'] as $key => $value) {
                    if ($value != "") {
                        
                        $idproducto = intval($value);
                        $cantidad = intval($datos['cantidad_producto'][$key]);
                        ModeloProductos::mdlAgregarRegistroProductos($idorden,$idproducto,$cantidad);
                    }
                }
            }

            $retorno = "editado";
        }

        //SE VALIDA SI LAS IMAGENES QUE VIENEN ESTAN VACIAS O NO, PARA POSTERIORMENTE AGREGARLAS
        if ($imagen != "") {
            // CONTRATO ADJUNTO
            self::GuardarArchivoCotizacion($idorden, $imagen, "ruta_cotizacion_1");
        }
        if ($imagen2 != "") {
            // CONTRATO ADJUNTO
            self::GuardarArchivoCotizacion($idorden, $imagen2, "ruta_cotizacion_2");
        }
        if ($imagen3 != "") {
            // CONTRATO ADJUNTO
            self::GuardarArchivoCotizacion($idorden, $imagen3, "ruta_cotizacion_3");
        }
        return $retorno;
    }

    static public function GuardarArchivoCotizacion($idorden, $archivo, $ruta)
    {
        $response = "";
        /* ================================================
        CREAMOS DIRECTORIO DONDE VAMOS A GUARDAR EL ARCHIVO
        ================================================ */
        # Verificar Directorio imagenes inventario cotizaciones
        $directorio = DIR_APP . "views/img/imgCotizacionesInventario";
        if (!is_dir($directorio)) {
            mkdir($directorio, 0755);
        }

        $fecha = date('Y-m-d');
        $hora = date('His');

        /*===================================================
            GUARDAMOS EL ARCHIVO
        ===================================================*/
        $GuardarArchivo = new FilesController();
        $GuardarArchivo->file = $archivo;
        $aleatorio = mt_rand(100, 999);
        $GuardarArchivo->ruta = $directorio . "/{$aleatorio}_{$fecha}_{$hora}";

        if (is_array($archivo)) {
            # Si es pdf
            if ($archivo['type'] == "application/pdf") {
                $response = $GuardarArchivo->ctrPDFFiles();
            } else {
                # Si es una imagen
                if ($archivo['type'] == "image/jpeg" || $archivo['type'] == "image/png") {
                    $response = $GuardarArchivo->ctrImages(null, null);
                }
            }
        } else {
            $response = "";
        }

        if ($response != "") {

            $rutaDoc = str_replace(DIR_APP, "", $response);

            $datosRuta = array(
                'idorden' => $idorden,
                'valor' => $rutaDoc,
                'item' => $ruta
            );

            ModeloProductos::mdlEditarRutaFotos($datosRuta);
        }
    }
}
