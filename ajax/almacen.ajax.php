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

// if (!isset($_SESSION['iniciarSesion']) || $_SESSION['iniciarSesion'] != "ok") {
//     echo "<script>window.location = 'inicio';</script>";
//     die();
// }

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
                  
            default:
                # code...
                break;
        }

        $datos = array(
            "tabla" => $tabla,
            "item"  => $item,
            "id" => $id
        );

        $respuesta = ModeloConceptosGH::mdlVer($datos);
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


