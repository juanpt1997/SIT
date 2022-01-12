<?php
# IMPORTAMOS LA CONFIGURACION DE LA SESSION
include '../config/config.php';
# REQUERIMOS EL CONTROLADOR Y EL MODELO PARA QUE REALICE LA PETICION
// require_once '../controllers/almacen.controlador.php';
// require_once '../models/almacen.modelo.php';
// require_once '../controllers/conceptos.controlador.php';
require_once '../models/conceptos.modelo.php';
require_once '../models/almacen.modelo.php';
require_once '../controllers/almacen.controlador.php';
require_once '../controllers/files.controlador.php';

if (!isset($_SESSION['iniciarSesion']) || $_SESSION['iniciarSesion'] != "ok") {
    echo "<script>window.location = 'inicio';</script>";
    die();
}

class AjaxAlmacen
{
    static public function ajaxCargarSelect($nombre)
    {
        switch ($nombre) {

            case 'categoria':

                $tabla = "a_categorias";
                $item = "categoria";
                $id = "idcategorias";
                break;

            case 'medida':

                $tabla = "a_medidas";
                $item = "medida";
                $id = "idmedidas";
                break;

            case 'marca':

                $tabla = "a_marcas";
                $item = "marca";
                $id = "idmarca";
                break;

            case 'sucursal':

                $tabla = "gh_sucursales";
                $item = "sucursal";
                $id = "ids";
                break;

            case 'producto':

                $tabla = "a_productos";
                $item = "descripcion";
                $id = "idproducto";
                break;
                
            case 'Sucursal':

                $tabla = "gh_sucursales";
                $item = "sucursal";
                $id = "ids";
                break; 
                  
            default:
                # code...
                break;
        }

        $datos = array(
            "tabla" => $tabla,
            "item"  => $item,
            "id" => $id
        );

        $respuesta = ModeloConceptosGenerales::mdlVer($datos);
        $option = "<option value='' selected>Seleccione {$nombre} </option>";

        foreach ($respuesta as $key => $value) {
            $option .= "<option value='{$value["{$datos['id']}"]}'>{$value["{$datos['item']}"]}</option>";
        }
        echo $option;
    }

    static public function ajaxAgregarProducto($frmData)
    {
        $respuesta = ModeloProductos::mdlAgregarProducto($frmData);
        echo $respuesta;
    }
    
    static public function ajaxEditarProducto($idproducto,$cod,$refer,$desc,$cate,$marca,$med)
    {
        $datos = [
            'idproducto' => $idproducto,
            'codigo' => $cod,
            'referencia' => $refer,
            'descripcion' => $desc,
            'idcategoria' => $cate,
            'idmarca' => $marca,
            'idmedida' => $med,
        ];

        $respuesta = ModeloProductos::mdlEditarProducto($datos);
        echo $respuesta;
    }

    static public function ajaxDatosProducto($item, $valor)
    {
        $datos = [
            'item' => $item,
            'valor' => $valor,
        ];

        $respuesta = ModeloProductos::mdlDatosProducto($datos);
        echo json_encode($respuesta);
    }

    static public function ajaxAgregarInventario($frmData)
    {
        // $datos = [
        //     'idproducto' => $producto,
        //     'idsucursal' => $sucursal,
        //     'stock' => $stock,
        //     'idinventario' => $idinven,
        //     'cantidad' => $canti,
        //     'tipo_movimiento' => $tipomovi,
        //     'preciocompra' => $precio,
        //     'idproveedor' => $idprov,
        //     'facturacompra' => $factu
        // ];
        // $respuesta = ModeloProductos::mdlAgregarInventario($datos);
        // echo json_encode($respuesta);

        $respuesta = ControladorAlmacen::ctrValidarInventario($frmData);

        //echo $respuesta;
        echo json_encode($respuesta);
    }

    static public function ajaxRegistrarMovimiento($idinven,$canti,$tipomovi,$precio,$idprov,$factu)
    {
        $datos = [
            'idinventario' => $idinven,
            'cantidad' => $canti,
            'tipo_movimiento' => $tipomovi,
            'preciocompra' => $precio,
            'idproveedor' => $idprov,
            'facturacompra' => $factu
        ];

        $respuesta = ModeloProductos::mdlAgregarMovimiento($datos);
        echo $respuesta;    
    }

    static public function ajaxCargarTablaProductos()
    {
        $respuesta = ModeloProductos::mdlListarProductos(null);
		$tr = "";

		foreach ($respuesta as $key => $value) {
			$tr .= "
			<tr>  
				<td>{$value["idproducto"]}</td>
				<td>{$value["descripcion"]}</td>
				<td>{$value["codigo"]}</td>
				<td>{$value["referencia"]}</td>
				<td>{$value["categoria"]}</td>
				<td>{$value["marca"]}</td>
				<td>{$value["medida"]}</td>
                <td>
                    <div class='btn-group' role='group' aria-label='Button group'>
                    <button title='Editar producto' data-toggle='tooltip' data-placement='top'  idproducto='{$value["idproducto"]}' class='btn btn-sm btn-primary btnEditar'><i class='fas fa-edit'></i></button>
                    </div>
                </td>
			</tr>
			";
		}
		echo $tr;
    }

    static public function ajaxCargarTablaInventario()
    {
        $respuesta = ModeloProductos::mdlListarInventario();
		$tr = "";

		foreach ($respuesta as $key => $value) {
			$tr .= "
			<tr>
				<td>{$value["descripcion"]}</td>
                <td>{$value["codigo"]}</td>
                <td>{$value["referencia"]}</td>
                <td>{$value["categoria"]}</td>
				<td>{$value["marca"]}</td>
                <td>{$value["medida"]}</td>
				<td>{$value["stock"]}</td>
                <td> 
                    <div class='btn-group' role='group' aria-label='Button group'>
                    <button title='Ver historial de movimientos' data-toggle='modal' data-target='#modal-historialMovimientos' idproducto='{$value["idproducto"]}' class='btn btn-sm btn-info btnHistorialMovimientos'><i class='far fa-clipboard'></i></button>
                    </div>
                    <div class='btn-group' role='group' aria-label='Button group'>
                    <button title='Ver sucursales' data-toggle='modal' data-target='#modal-sucursalesProducto' idproducto='{$value["idproducto"]}' class='btn btn-sm btn-success btnSucursalesInventario'><i class='fas fa-map-marker-alt'></i></button>
                    </div>
                    <div class='btn-group' role='group' aria-label='Button group'>
                    <button title='Generar salida' data-toggle='tooltip' data-placement='top'  idproducto='{$value["idproducto"]}' class='btn btn-sm btn-warning btnGenerarSalida'><i class='fas fa-sign-out-alt'></i></button>
                    </div>
                    <div class='btn-group' role='group' aria-label='Button group'>
                    <button title='Editar producto' data-toggle='tooltip' data-placement='top'  idproducto='{$value["idproducto"]}' class='btn btn-sm btn-primary btnEditar'><i class='fas fa-edit'></i></button>
                    </div>
                </td>
			</tr>
			";
		}
		echo $tr;
    }

    static public function ajaxSucursalesInventario($idproducto)
    {
        $respuesta = ModeloProductos::mdlSucursalesInventario($idproducto);
        $tr = "";

		foreach ($respuesta as $key => $value) {
			$tr .= "
			<tr>
                <td> 
                    <div class='btn-group' role='group' aria-label='Button group'>
                        <button title='Editar inventario' idproducto='{$value["idproducto"]}' idinventario='{$value["idinventario"]}' class='btn btn-sm btn-primary btnEditarInventario'><i class='fas fa-edit'></i></button>
                    </div>
                </td>
				<td>{$value["descripcion"]}</td>
                <td>{$value["referencia"]}</td>
                <td>{$value["stock"]}</td>
                <td>{$value["posicion"]}</td>
				<td>{$value["sucursal"]}</td>
			</tr>
			";
		}
		echo $tr;
    }

    static public function ajaxHistorialMovimientos($idproducto)
    {
        $respuesta = ModeloProductos::mdlHistorialMovimientos($idproducto);
        $tr = "";

		foreach ($respuesta as $key => $value) {
			$tr .= "
			<tr>
                <td> 
                    <div class='btn-group' role='group' aria-label='Button group'>
                        <button title='Editar movimiento' idproducto='{$value["idproducto"]}'  idmovimiento='{$value["idmovimiento"]}' class='btn btn-sm btn-primary btnEditarMovimiento'><i class='fas fa-edit'></i></button>
                    </div>
                </td>
				<td>{$value["cantidad"]}</td>
                <td>{$value["tipo_movimiento"]}</td>
                <td>{$value["fecha"]}</td>
                <td>{$value["razon_social"]}</td>
				<td>{$value["preciocompra"]}</td>
				<td>{$value["facturacompra"]}</td>
                <td>{$value["sucursal"]}</td>
                <td>{$value["observaciones"]}</td>
			</tr>
			";
		}
		echo $tr;
    }

    static public function ajaxUbicarProducto($idproducto,$sucursal)
    {
        $datos = array(
            "idproducto" => $idproducto,
            "idsucursal"  => $sucursal
        );

        $respuesta = ModeloProductos::mdlPosicionCantidad($datos);
        echo json_encode($respuesta);
    }

    static public function ajaxDatosMovimiento($idmovimiento)
    {
        $respuesta = ModeloProductos::mdlDatosMovimiento($idmovimiento);
        echo json_encode($respuesta);
    }

    static public function ajaxEditarMovimiento($frmData)
    {
        $frmData['preciocompra'] = $frmData['preciocompra'] != "" ? $frmData['preciocompra'] : null;
        $frmData['proveedorMovimiento'] = $frmData['proveedorMovimiento'] != "" ? $frmData['proveedorMovimiento'] : null;
        $frmData['facturacompra'] = $frmData['facturacompra'] != "" ? $frmData['facturacompra'] : null;
        $respuesta = ModeloProductos::mdlEditarMovimiento($frmData);
        echo $respuesta;
    }

    static public function ajaxDatosInventario($idinventario)
    {
        $respuesta = ModeloProductos::mdlDatosInventario($idinventario);
        echo json_encode($respuesta);
    }

    static public function ajaxModificarInventario($datos)
    {
        $respuesta = ControladorAlmacen::ctrModificarInventario($datos);
        echo $respuesta;
    }

    static public function ajaxContarInventario()
    {
        $respuesta = ModeloProductos::mdlContarInventario();
        echo json_encode($respuesta);
    }

    static public function ajaxCargarSelectProductos()
    {
        $respuesta = ModeloProductos::mdlDatosInventario(null);
        $option = "<option value='' selected>Seleccione un producto </option>";

        foreach ($respuesta as $key => $value) {
            $option .= "<option value='{$value['idproducto']}'>{$value['descripcion']}</option>";
        }
        echo $option;

    }

    static public function ajaxGuardarOrden($formData,$imagen,$imagen2,$imagen3)
    {
        $respuesta = ControladorAlmacen::ctrAgregarEditarOrdenCompra3($formData,$imagen,$imagen2,$imagen3);

        echo json_encode($respuesta);
    }

    static public function ajaxSeleccionarProductoOrden($consecutivo)
    {
        $respuesta = ModeloProductos::mdlListarProductos(null);
		$tr = "";

		foreach ($respuesta as $key => $value) {
			$tr .= "
			<tr>  
				<td>{$value["idproducto"]}</td>
				<td>{$value["descripcion"]}</td>
				<td>{$value["codigo"]}</td>
				<td>{$value["referencia"]}</td>
				<td>{$value["categoria"]}</td>
				<td>{$value["marca"]}</td>
				<td>{$value["medida"]}</td>
                <td>
                    <div class='btn-group' role='group' aria-label='Button group'>
                    <button title='Seleccionar producto' data-toggle='tooltip' data-placement='top' idproducto='{$value["idproducto"]}' referencia='{$value["referencia"]}' descripcion='{$value["descripcion"]}' codigo='{$value["codigo"]}' consecutivo='$consecutivo' class='btn btn-sm btn-primary btnSeleccionarProducto'><i class='fas fa-check'></i></button>
                    </div>
                </td>
			</tr>
			";
		}
		echo $tr;

    }

    static public function ajaxListarOrdenes()
    {
        $respuesta = ModeloProductos::mdlListarOrdenes(null);
		$tr = "";

		foreach ($respuesta as $key => $value) {
            //FOTO 1
            if ($value['ruta_cotizacion_1'] != null) {
                $btnVerFoto = "<a href='" . URL_APP . $value['ruta_cotizacion_1'] . "' target='_blank' class='btn btn-sm btn-secondary m-1' type='button'><i class='fas fa-file-download'></i></a>";
            }else{
                $btnVerFoto = "";
            }
            //FOTO 2
            if ($value['ruta_cotizacion_2'] != null) {
                $btnVerFoto2 = "<a href='" . URL_APP . $value['ruta_cotizacion_2'] . "' target='_blank' class='btn btn-sm btn-secondary m-1' type='button'><i class='fas fa-file-download'></i></a>";
            }else{
                $btnVerFoto2 = "";
            }
            //FOTO 3
            if ($value['ruta_cotizacion_3'] != null) {
                $btnVerFoto3 = "<a href='" . URL_APP . $value['ruta_cotizacion_3'] . "' target='_blank' class='btn btn-sm btn-secondary m-1' type='button'><i class='fas fa-file-download'></i></a>";
            }else{
                $btnVerFoto3 = "";
            }
            //color de los estados
            if ($value['estado_orden'] == "PENDIENTE") {

                $estado = "<span class='badge badge-warning'>PENDIENTE</span>";

            } else if($value['estado_orden'] == "APROBADA"){

                $estado = "<span class='badge badge-success'>APROBADA</span>";

            } else if($value['estado_orden'] == "RECHAZADA"){

                $estado = "<span class='badge badge-danger'>RECHAZADA</span>";
            } else {
                $estado = "";
            }

			$tr .= "
			<tr>
                <td>{$value['idorden']}</td>
                <td> 
                <div class='btn-group' role='group' aria-label='Button group'>
                <button idorden = '{$value['idorden']}' class='btn btn-sm btn-info btnEditarOrden' title='Editar orden de compra'><i class='fas fa-edit'></i></button>
                </div>
                <div class='btn-group' role='group' aria-label='Button group'>
                <button idorden = '{$value['idorden']}' class='btn btn-sm btn-secondary btn_pdf_orden' title='Generar PDF'><i class='fas fa-file-pdf'></i></button>
                </div>
                </td>
                <td>$estado</td>
                <td>{$value['num_cotizacion']}</td>
                <td>{$value['razon_social']}</td>
                <td>{$value['observaciones']}</td>
                <td>{$value['fecha_elaboracion']}</td>
                <td>{$value['forma_pago']}</td>
                <td>{$value['tipo_compra']}</td>
                <td>$btnVerFoto $btnVerFoto2 $btnVerFoto3</td>
                <td>{$value['usuario']}</td>
                <td>{$value['fecha_aprobacion']}</td>
			</tr>
			";
		}
		echo $tr;
    }

    static public function ajaxDatosOrden($idorden)
    {
        $respuesta = ModeloProductos::mdlListarOrdenes($idorden);
        echo json_encode($respuesta);
    }

    static public function ajaxDatosProductosOrden($idorden)
    {
        $respuesta = ModeloProductos::mdlDatosProductoOrden($idorden);
        echo json_encode($respuesta);
    }

    static public function ajaxContarOrdenes()
    {
        $respuesta = ModeloProductos::mdlContarOrdenes();
        echo json_encode($respuesta);
    }

    static public function ajaxGenerarSalida($datos)
    {
        $respuesta = ControladorAlmacen::ctrGenerarSalidaInventario($datos);
        echo json_encode($respuesta);
    }
}
/* ===================================================
            LLAMADOS AJAX EN PRODUCTOS
====================================================*/
if (isset($_POST['cargarselect']) && $_POST['cargarselect'] == "ok") {
    AjaxAlmacen::ajaxCargarSelect($_POST['nombreSelect']);
}

if (isset($_POST['AgregarProducto']) && $_POST['AgregarProducto'] == "ok") {
    AjaxAlmacen::ajaxAgregarProducto($_POST);
}

if (isset($_POST['DatosProducto']) && $_POST['DatosProducto'] == "ok") {
    AjaxAlmacen::ajaxDatosProducto($_POST['item'], $_POST['valor']);
}

if (isset($_POST['AgregarInventario']) && $_POST['AgregarInventario'] == "ok") {
    AjaxAlmacen::ajaxAgregarInventario($_POST);
}

if (isset($_POST['RegistrarMovimiento']) && $_POST['RegistrarMovimiento'] == "ok") {
    AjaxAlmacen::ajaxRegistrarMovimiento($_POST['idinventario'],$_POST['cantidad'],$_POST['tipo_movimiento'],$_POST['preciocompra'],$_POST['idproveedor'],$_POST['facturacompra']);
}

if (isset($_POST['ActualizarProducto']) && $_POST['ActualizarProducto'] == "ok") {
    AjaxAlmacen::ajaxEditarProducto($_POST['idproducto'],$_POST['codigo'],$_POST['referencia'],$_POST['descripcion'],$_POST['idcategoria'],$_POST['idmarca'],$_POST['idmedida']);
}

if (isset($_POST['CargarTablaProductos']) && $_POST['CargarTablaProductos'] == "ok") {
	AjaxAlmacen::ajaxCargarTablaProductos();
}

if (isset($_POST['CargarTablaInventario']) && $_POST['CargarTablaInventario'] == "ok") {
	AjaxAlmacen::ajaxCargarTablaInventario();
}

if (isset($_POST['CargarTablaSucursales']) && $_POST['CargarTablaSucursales'] == "ok") {
	AjaxAlmacen::ajaxSucursalesInventario($_POST['idproducto']);
}

if (isset($_POST['CargarTablaHistorial']) && $_POST['CargarTablaHistorial'] == "ok") {
	AjaxAlmacen::ajaxHistorialMovimientos($_POST['idproducto']);
}

if (isset($_POST['ubicarProducto']) && $_POST['ubicarProducto'] == "ok") {
    AjaxAlmacen::ajaxUbicarProducto($_POST['idproducto'],$_POST['idsucursal']);
}

if (isset($_POST['datosMovimiento']) && $_POST['datosMovimiento'] == "ok") {
    AjaxAlmacen::ajaxDatosMovimiento($_POST['idmovimiento']);
}

if (isset($_POST['editarMovimiento']) && $_POST['editarMovimiento'] == "ok") {
    AjaxAlmacen::ajaxEditarMovimiento($_POST);
}

if (isset($_POST['datosInventario']) && $_POST['datosInventario'] == "ok") {
    AjaxAlmacen::ajaxDatosInventario($_POST['idinventario']);
}

if (isset($_POST['modificarInventario']) && $_POST['modificarInventario'] == "ok") {
    AjaxAlmacen::ajaxModificarInventario($_POST);
}

if (isset($_POST['contarInventario']) && $_POST['contarInventario'] == "ok") {
    AjaxAlmacen::ajaxContarInventario();
}

/* ===================================================
            LLAMADOS AJAX EN ORDEN COMPRA
====================================================*/
if (isset($_POST['cargarSelectProductos']) && $_POST['cargarSelectProductos'] == "ok") {
    AjaxAlmacen::ajaxCargarSelectProductos();
}

if (isset($_REQUEST['agregarOrden']) && $_REQUEST['agregarOrden'] == "ok") {
    $imagen_cotizacion1 = isset($_FILES['imagen_cotizacion1']) ? $_FILES['imagen_cotizacion1'] : "";
    $imagen_cotizacion2 = isset($_FILES['imagen_cotizacion2']) ? $_FILES['imagen_cotizacion2'] : "";
    $imagen_cotizacion3 = isset($_FILES['imagen_cotizacion3']) ? $_FILES['imagen_cotizacion3'] : "";
    AjaxAlmacen::ajaxGuardarOrden($_POST, $imagen_cotizacion1,$imagen_cotizacion2,$imagen_cotizacion3);
}

if (isset($_POST['seleccionarProducto']) && $_POST['seleccionarProducto'] == "ok") {
    AjaxAlmacen::ajaxSeleccionarProductoOrden($_POST['consecutivo']);
}

if (isset($_POST['CargarTablaOrdenes']) && $_POST['CargarTablaOrdenes'] == "ok") {
    AjaxAlmacen::ajaxListarOrdenes();
}

if (isset($_POST['DatosOrden']) && $_POST['DatosOrden'] == "ok") {
    AjaxAlmacen::ajaxDatosOrden($_POST['idorden']);
}

if (isset($_POST['DatosProductoOrden']) && $_POST['DatosProductoOrden'] == "ok") {
    AjaxAlmacen::ajaxDatosProductosOrden($_POST['idorden']);
}

if (isset($_POST['contarOrdenes']) && $_POST['contarOrdenes'] == "ok") {
    AjaxAlmacen::ajaxContarOrdenes();
}

if (isset($_POST['GenerarSalida']) && $_POST['GenerarSalida'] == "ok") {
    AjaxAlmacen::ajaxGenerarSalida($_POST);
}


