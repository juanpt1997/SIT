<?php

// if (!validarPermiso('CARGAR_OPCION', 'R')) {
//     echo "<script> window.location = 'inicio'; </script>";
// }

///$ListaProovedores = ControladorProveedores::ctrListarProveedores();
//$Municipios = ControladorGH::ctrDeparMunicipios();
// $Repuestos = ControladorRepuestos::ctrListarRepuestos();
// $Medidas = ControladorAlmacen::ctrListarMedidas();
// $Marcas = ControladorAlmacen::ctrListarMarcas();
// $Categorias = ControladorAlmacen::ctrListarCategorias();
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark "><strong><i>Almacén</i></strong> <i class="fas fa-pallet"></i></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                        <li class="breadcrumb-item active">Almacén</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">

            <hr class="my-4">

            <div class="card card-outline card-info">
                <div class="card-body">
                    <hr class="my-4">
                    <div class="row mt-2 d-flex justify-content-center">
                        <div class="col-lg-3">
                            <!--PRODUCTOS-->
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3 id="contador_inventario"></h3>
                                    <p><i>Productos / Inventario</i></p>
                                </div>
                                <div class="icon" style="color: black;">
                                    <i class="fas fa-cubes"></i>
                                </div>
                                <a href="#" class="small-box-footer btn" data-toggle="modal" data-target="#modal-productos">Nuevo <i class="fas fa-plus-circle" style="color: white;"></i></a>
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <!--ORDENES DE COMPRA-->
                            <div class="small-box" style="background-color: #222A68; color: white;">
                                <div class="inner">
                                    <h3 id="contador_ordenes"></h3>
                                    <p><i>Órdenes de Compras</i></p>
                                </div>
                                <div class="icon" style="color: white;">
                                    <i class="fas fa-file-invoice-dollar"></i>
                                </div>
                                <a href="#" class="small-box-footer btn" data-toggle="modal" data-target="#modal-ordencompra">Nuevo <i class="fas fa-plus-circle" style="color: white;"></i></a>
                            </div>
                        </div>

                        <!--AUTORIZACION DE COMPRA-->
                        <!-- <div class="col-lg-3">
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h3><i class="fas fa-ellipsis-h"></i></h3>
                                    <p><i>Autorizaciones de compras</i></p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-tasks"></i></i>
                                </div>
                                <a href="#" class="small-box-footer btn" data-toggle="modal" data-target="#modal-autorizaciones">Verificar <i class="fas fa-check"></i></a>
                            </div>
                        </div> -->

                    </div>
                </div>
                <div class="card-footer bg-dark"></div>
            </div>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- ===================================================
    MODAL DE PRODUCTOS
=================================================== -->
<div class="modal fade" id="modal-productos" style="display: none; padding-right: 17px; overflow-y: scroll;" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h2 class="modal-title"><span id="titulo_producto">Nuevo producto</span></h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card-body">

                    <!--INGRESO DATOS PRODUCTOS-->
                    <h4><i class="fas fa-info-circle"></i> <b><i>Datos producto</i></b></h4>
                    <hr class="my-4">
                    <form id="formulario_producto" method="post" enctype="multipart/form-data">
                        <div class="row">

                            <input type="hidden" id="id_producto" name="id_producto" value="">

                            <div class="col-12 col-sm-6 col-lg-4">
                                <div class="form-group text-center">
                                    <label><i>Código del producto</i> <i class="fas fa-barcode"></i></label>
                                    <input type="text" class="form-control" id="cod_producto" name="cod_producto" required>
                                </div>
                            </div>

                            <div class="col-12 col-sm-6 col-lg-4">
                                <div class="form-group text-center">
                                    <label><i>Referencia</i></label>
                                    <input type="number" class="form-control input_producto" id="referencia" name="referencia" required>
                                </div>
                            </div>

                            <div class="col-12 col-sm-6 col-lg-4">
                                <div class="form-group text-center">
                                    <label><i>Descripción</i></label>
                                    <input type="text" class="form-control input_producto" id="descripcion_prod" name="descripcion_prod" placeholder="Nombre del producto / Descripción del producto" required>
                                </div>
                            </div>

                            <div class="col-12 col-sm-6 col-lg-4">
                                <div class="form-group text-center">
                                    <label><i>Categoría</i></label>
                                    <div class="input-group">
                                        <select class="custom-select rounded-0 input_producto" id="categoria" name="categoria" required>
                                        </select>
                                        <div class="input-group-append">
                                            <a href="cg-almacen" target="_blank"><button type="button" class="btn btn-success btn-md btn-ruta" title="Crear nueva categoria" data-toggle="tooltip" data-placement="top"><i class="fas fa-plus"></i></button></a>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="col-12 col-sm-6 col-lg-4">
                                <div class="form-group text-center">
                                    <label><i>Marca</i> <i class="fas fa-copyright"></i></label>
                                    <div class="input-group">
                                        <select class="custom-select rounded-0 input_producto" id="marca" name="marca" required>
                                        </select>
                                        <div class="input-group-append">
                                            <a href="cg-almacen" target="_blank"><button type="button" class="btn btn-success btn-md btn-ruta" title="Crear nueva marca" data-toggle="tooltip" data-placement="top"><i class="fas fa-plus"></i></button></a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-sm-6 col-lg-4">
                                <div class="form-group text-center">
                                    <label><i>Medida</i> <i class="fas fa-tachometer-alt"></i></label>
                                    <div class="input-group">
                                        <select class="custom-select rounded-0 input_producto" id="medida" name="medida" required>
                                        </select>
                                        <div class="input-group-append">
                                            <a href="cg-almacen" target="_blank"><button type="button" class="btn btn-success btn-md btn-ruta" title="Crear nueva medida" data-toggle="tooltip" data-placement="top"><i class="fas fa-plus"></i></button></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="d-flex justify-content-center">
                        <div class="form-group">
                            <button type="submit" class="btn btn-sm btn-success btn-block btn_agregarProducto" form="formulario_producto"><i class="fas fa-plus"></i> Crear producto</button>
                        </div>

                        <div class="form-group">
                            <button type="btn" class="btn btn-sm btn-info btn-block btn_actualizarProducto mb-2 mr-2 d-none"><i class="fas fa-sync-alt"></i> Actualizar producto</button>

                            <button type="submit" class="btn btn-sm btn-success btn-block btn_nuevaReferencia mb-2 mr-2 d-none" form="formulario_producto"><i class="fas fa-plus"></i> Crear nueva referencia</button>
                        </div>
                    </div>

                    <h5><i><b>Generar</b></i>

                        <input id="switch-offColor" name="switchAlmacen" type="checkbox">
                    </h5>

                    <!--ENTRADA AL ALMACEN-->
                    <div id="div_ver_inputs_entradas">
                        <hr class="bg-dark">
                        <h4><i class="fas fa-arrow-alt-circle-down"></i> <b><i>Entrada almacén</i></b></h4>
                        <hr>
                        <form id="formulario_addInventario" method="post" enctype="multipart/form-data">
                            <div class="row">

                                <div class="col-12 col-sm-6 col-lg-4">
                                    <div class="form-group text-center">
                                        <label><i>Sucursal - bodega</i></label>
                                        <div class="input-group">
                                            <select class="select2-single rounded-0" id="sucursal" name="sucursal" required>
                                            </select>
                                            <div class="input-group-append">
                                                <a href="cg-gestion-humana" target="_blank"><button type="button" class="btn btn-success btn-md btn-ruta" title="Crear nueva sucursal" data-toggle="tooltip" data-placement="top"><i class="fas fa-plus"></i></button></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-sm-6 col-lg-4">
                                    <div class="form-group text-center">
                                        <label><i>Número de factura producto</i></label>
                                        <input type="text" class="form-control input_inventario" id="num_factura" name="num_factura" placeholder="#" required readonly>
                                    </div>
                                </div>

                                <div class="col-12 col-sm-6 col-lg-4">
                                    <div class="form-group text-center">
                                        <label><i>Proveedor</i></label>
                                        <div class="input-group">
                                            <select class="select2-single rounded-0" id="proveedor" name="proveedor" required>
                                            </select>
                                            <div class="input-group-append">
                                                <a href="c-proveedores" target="_blank"><button type="button" class="btn btn-success btn-md btn-ruta" title="Crear nuevo proveedor" data-toggle="tooltip" data-placement="top"><i class="fas fa-plus"></i></button></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-sm-6 col-lg-4">
                                    <div class="form-group text-center">
                                        <label><i>Cantidad a ingresar (unidades)</i></label>
                                        <input type="number" class="form-control input_inventario" id="cantidad" name="cantidad" placeholder="-" min="0" step="1" title="Ingrese solo valores positivos" required readonly>
                                    </div>
                                </div>

                                <div class="col-12 col-sm-6 col-lg-4">
                                    <div class="form-group text-center">
                                        <label><i>Posición</i> <i class="fas fa-sitemap"></i></label>
                                        <input type="text" class="form-control input_inventario" id="posicion" name="posicion" placeholder="-" readonly>
                                    </div>
                                </div>

                                <div class="col-12 col-sm-6 col-lg-4">
                                    <div class="form-group text-center">
                                        <label><i>Precio de compra (valor unitario)</i> <i class="fas fa-dollar-sign"></i></label>
                                        <input type="text" class="form-control input_inventario" id="precio-compra-producto" name="precio-compra-producto" placeholder="$" required readonly>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="d-flex justify-content-center">
                            <div class="form-group">
                                <button type="submit" class="btn btn-sm btn-info btn-block" form="formulario_addInventario"><i class="fas fa-plus"></i> Agregar al inventario</button>
                            </div>
                        </div>
                    </div>

                    <!--SALIDA AL ALMACEN-->
                    <div class="d-none" id="div_ver_inputs_salidas">
                        <hr class="my-4 bg-dark">
                        <h4><i class="fas fa-arrow-alt-circle-up"></i> <b><i>Salida almacén</i></b></h4>
                        <hr>
                        <form id="formulario_salidaInventario" method="post" enctype="multipart/form-data">
                            <div class="row">

                                <div class="col-12 col-sm-6 col-lg-4">
                                    <div class="form-group text-center">
                                        <label><i>Sucursal - bodega</i></label>
                                        <div class="input-group">
                                            <select class="select2-single rounded-0" id="Sucursal" name="sucursal_salida" required>
                                            </select>
                                            <div class="input-group-append">
                                                <a href="cg-gestion-humana" target="_blank"><button type="button" class="btn btn-success btn-md btn-ruta" title="Crear nueva sucursal" data-toggle="tooltip" data-placement="top"><i class="fas fa-plus"></i></button></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-sm-6 col-lg-4">
                                    <div class="form-group text-center">
                                        <label><i>Cantidad</i></label>
                                        <input type="number" class="form-control" id="cantidad_salida" name="cantidad_salida" placeholder="#" min="0" step="1" title="Ingrese solo valores positivos" required>
                                    </div>
                                </div>

                                <div class="col-12 col-sm-6 col-lg-4">
                                    <div class="form-group text-center">
                                        <label for="observaciones"><i>Observaciones</i></label>
                                        <textarea class="form-control" name="observaciones_salida" id="observaciones_salida" rows="2"></textarea>
                                    </div>
                                </div>

                            </div>
                        </form>
                        <div class="d-flex justify-content-center">
                            <div class="form-group">
                                <button type="submit" class="btn btn-sm btn-info btn-block" form="formulario_salidaInventario"><i class="fas fa-plus"></i> Generar salida</button>
                            </div>
                        </div>
                    </div>

                    <hr class="my-4 bg-dark">
                    <!--TABLA PRODUCTOS-->
                    <div class="card card-info collapsed-card" id="card_productos">
                        <div class="card-header" data-card-widget="collapse" style="cursor: pointer;">
                            <h5 class="mb-0">
                                <strong><i>Productos</i> </strong>
                                <button type="button" class="btn btn-tool btn_ver_productos" title="Ver productos pantalla completa" data-toggle="tooltip" data-placement="top" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-sm table-bordered table-striped text-center text-nowrap" id="tabla_productos">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nombre/Descripción</th>
                                            <th>Código</th>
                                            <th>Referencia</th>
                                            <th>Categoria</th>
                                            <th>Marca</th>
                                            <th>Medida</th>
                                            <th>...</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody_productos">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <!--TABLA INVENTARIO-->
                    <div class="card card-info collapsed-card">
                        <div class="card-header" data-card-widget="collapse" style="cursor: pointer;">
                            <h5 class="mb-0">
                                <strong><i>Inventario</i> </strong>
                                <button type="button" class="btn btn-tool" title="Ver inventario pantalla completa" data-toggle="tooltip" data-placement="top" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-sm table-bordered table-striped text-center text-nowrap" id="tabla_inventario">
                                    <thead>
                                        <!-- <tr>
                                            <th colspan="8">PRODUCTOS</th>
                                            <th colspan="4">ENTRADAS</th>
                                            <th colspan="4">SALIDAS</th>
                                            <th colspan="3">SALDO</th>
                                            <th colspan='1'>SUCURSALES</th>
                                        </tr> -->
                                        <tr>
                                            <th>Descripción</th>
                                            <th>Código</th>
                                            <th>Referencia</th>
                                            <th>Categoria</th>
                                            <th>Marca</th>
                                            <th>Medida</th>
                                            <th>Stock</th>
                                            <th>Acciones</th>
                                            <!-- <th>Sucursal</th>
                                            <th>Precio</th>
                                            <th>Fecha de entrada</th>
                                            <th>Cantidad (u)</th>
                                            <th>Valor unitario</th>
                                            <th>Valor total</th>
                                            <th>Fecha de salida</th>
                                            <th>Cantidad (u)</th>
                                            <th>Valor unitario</th>
                                            <th>Valor total</th>
                                            <th>Cantidad (u)</th>
                                            <th>Valor unitario</th>
                                            <th>Total</th>
                                            <th>Sucursal</th> -->
                                        </tr>
                                    </thead>
                                    <tbody id="tbody_inventario">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer justify-content-center bg-dark">
                <a class="btn btn-app bg-danger" data-dismiss="modal">
                    <i class="fas fa-ban"></i> Cerrar
                </a>
            </div>
            <!-- /.modal-content -->
        </div>
    </div>
</div>
<!-- =================================================
    MODAL DE HISTORIAL DE MOVIMIENTOS
===================================================-->
<div class="modal fade" id="modal-historialMovimientos" tabindex="-1" role="dialog" aria-labelledby="tituloModalHistorial" aria-hidden="true" style="overflow-y: scroll;">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h2 class="modal-title" id="tituloModalHistorial"><span class="badge badge-light"><i class="fas fa-angle-double-right"></i> Historial de movimientos</span></h2>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card" id="card_historial">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-sm table-bordered table-striped text-center text-nowrap" id="tabla_historial">
                                <thead>
                                    <tr>
                                        <th>...</th>
                                        <th>Cantidad</th>
                                        <th>Tipo de movimiento</th>
                                        <th>Fecha</th>
                                        <th>Proveedor</th>
                                        <th>Precio de compra</th>
                                        <th>Factura de compra</th>
                                        <th>Sucursal</th>
                                        <th>Observaciones</th>
                                    </tr>
                                </thead>
                                <tbody id="tbody_historial">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-center bg-dark">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<!-- =================================================
    MODAL DE SUCURSALES DE UN PRODUCTO
===================================================-->
<div class="modal fade" id="modal-sucursalesProducto" tabindex="-1" role="dialog" aria-labelledby="tituloSucursales" aria-hidden="true" style="overflow-y: scroll;">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h2 class="modal-title" id="tituloSucursales"><span class="badge badge-light"><i class="fas fa-angle-double-right"></i> Sucursales activas</span></h2>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card card-success" id="card_sucursales">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-sm table-bordered table-striped text-center text-nowrap" id="tabla_sucursales">
                                <thead>
                                    <tr>
                                        <th>...</th>
                                        <th>Descripción</th>
                                        <th>Referencia</th>
                                        <th>Stock</th>
                                        <th>Posición</th>
                                        <th>Sucursal</th>
                                    </tr>
                                </thead>
                                <tbody id="tbody_sucursales">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-center bg-dark">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<!-- =================================================
    MODAL DE ORDENES DE COMPRAS
===================================================-->
<div class="modal fade" id="modal-ordencompra" style="display: none; padding-right: 17px; overflow-y: scroll;" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <div class="modal-header bg-info">
                <h3 class="modal-title"><span id="titulo_orden_compra"></span></h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="card-body">
                    <form method="post" enctype="multipart/form-data" id="formularioOrden">
                        <div class="row">
                            <input type="hidden" id="idorden_compra" name="idorden_compra" value="">
                            <input type="hidden" id="idregistroproducto" name="idregistroproducto" value="">

                            <div class="col-12 col-sm-6 col-lg-4">
                                <div class="form-group text-center">
                                    <label><i>Número de cotizacion</i></label>
                                    <input type="text" class="form-control" id="numcotizacion" name="numcotizacion" required>
                                </div>
                            </div>

                            <div class="col-12 col-sm-6 col-lg-4">
                                <div class="form-group text-center">
                                    <label><i>Forma de pago</i></label>
                                    <select class="custom-select rounded-0" id="formadepago" name="formadepago" required>
                                        <option value="" selected>Seleccione una opción</option>
                                        <option value="Contado">Contado</option>
                                        <option value="Credito">Credito</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-12 col-sm-6 col-lg-4">
                                <div class="form-group text-center">
                                    <label><i>Proveedor</i></label>
                                    <div class="input-group">
                                        <select class="select2-single rounded-0" id="proveedor2" name="proveedor2" required>
                                        </select>
                                        <div class="input-group-append">
                                            <a href="c-proveedores" target="_blank"><button type="button" class="btn btn-success btn-md btn-ruta" title="Crear nuevo proveedor" data-toggle="tooltip" data-placement="top"><i class="fas fa-plus"></i></button></a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-sm-6 col-lg-4">
                                <div class="form-group text-center">
                                    <label><i>Teléfono proveedor</i></label>
                                    <input type="text" class="form-control" id="num_proveedor" name="num_proveedor" readonly>
                                </div>
                            </div>

                            <div class="col-12 col-sm-6 col-lg-4">
                                <div class="form-group text-center">
                                    <label><i>Correo proveedor</i></label>
                                    <input type="text" class="form-control" id="correo_prov" name="correo_prov" readonly>
                                </div>
                            </div>

                            <div class="col-12 col-sm-6 col-lg-4">
                                <div class="form-group text-center">
                                    <label><i>Tipo de compra</i></label>
                                    <select class="custom-select rounded-0" id="tipo_compra" name="tipo_compra" required>
                                        <option value="" selected>Seleccione una opción</option>
                                        <option value="Servicio">Servicio</option>
                                        <option value="Producto">Producto</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-12 col-sm-6 col-lg-4">
                                <div class="form-group text-center">
                                    <label for="observaciones"><i>Observaciones</i></label>
                                    <textarea class="form-control" name="observaciones" id="observaciones" rows="2"></textarea>
                                </div>
                            </div>

                            <div class="col-12 col-sm-6 col-lg-4">
                                <div class="form-group text-center">
                                    <label><i>Dirección de entrega</i></label>
                                    <input type="text" class="form-control" id="direccion_entrega" name="direccion_entrega" placeholder="Digite la dirección" required>
                                </div>
                            </div>

                            <div class="col-12 col-sm-6 col-lg-4">
                                <div class="form-group d-none" id="visualizar_estado">
                                    <label for="actualizar_estado">Actualizar estado de la orden</label>
                                    <select id="actualizar_estado" class="form-control text-center" name="actualizar_estado">
                                        <option style="background-color: white; color: black;" value="" selected>-Seleccione un estado-</option>
                                        <option style="background-color: green; color: white;" value="APROBADA">APROBADA</option>
                                        <option style="background-color: red; color: white;" value="RECHAZADA">RECHAZADA</option>
                                        <option style="background-color: yellow; color: black;" value="PENDIENTE">PENDIENTE</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <hr class="my-4 bg-dark">

                        <h4><b><i>Productos</i></b>
                            <i class="fas fa-tags"></i></i>
                        </h4>

                        <div class="table-responsive" id="solicitud_productos">
                            <table class="table table table-bordered table-striped text-center" id="tblOrdenProductos">
                                <thead>
                                    <tr>
                                        <th style="width: 500px">Producto</th>
                                        <th>Referencia</th>
                                        <th>Código</th>
                                        <th>Cantidad</th>
                                    </tr>
                                </thead>
                                <tbody id="filas_tabla_productosSolicitud">
                                    <tr id="contenido_filas_productosSolicitud">
                                        <td style="width: 300px">
                                            <div class="input-group">
                                                <input class="form-control" type="text" id="producto_1" name="producto[]" placeholder="Seleccione un producto" readonly>
                                                <div class="input-group-append">
                                                    <button type="button" class="btn btn-success btn-md btn_ListaProductosOrden" consecutivo="1" title="Lista de productos" data-toggle="modal" data-target="#modalProductos"><i class="fas fa-clipboard-list"></i></button>
                                                </div>
                                            </div>
                                        </td>
                                        <input type="hidden" id="idproducto_1" name="idproducto[]">
                                        <td style="width: 300px"> <input type="text" class="form-control" id="referencia_1" name="referencia_producto[]" readonly></td>
                                        <td style="width: 300px"> <input type="text" class="form-control" id="codigo_1" name="codigo_producto[]" readonly></td>
                                        <td style="width: 300px"> <input type="text" class="form-control" id="cantidad_1" name="cantidad_producto[]"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="d-flex justify-content-center">
                            <button type="button" title="Agregar fila de productos" data-toggle="tooltip" data-placement="top" class="btn btn-success btn-toolbar btnAddProductoSolicitud">
                                <i class="fas fa-plus"></i>
                            </button>

                            <button type="button" title="Agregar fila de productos" data-toggle="tooltip" data-placement="top" class="btn btn-success btn-toolbar btnNuevoProductoEditar d-none">
                                <i class="fas fa-plus"></i>
                            </button>

                            <button type="button" title="Eliminar fila de productos" data-toggle="tooltip" data-placement="top" class="btn btn-danger btn-toolbar btnEliminarProductoSolicitud" style="margin-left: 10px">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>

                        <div class="d-flex justify-content-center">


                        </div>

                        <hr class="my-4 bg-dark">

                        <h4><b><i>Subir cotizaciones</i></b>
                            <i class="fas fa-file-upload"></i>
                        </h4>

                        <div class="row">
                            <!--SUBIR IMAGEN-->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label></label>
                                    <div class="input-group">
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                <i class="fas fa-file-alt"></i>
                                            </span>
                                        </div>
                                        <input type="file" class="form-control" name="imagen_cotizacion1" id="imagen_cotizacion1" accept="image/png, image/jpeg, application/pdf" required>
                                    </div>
                                </div>
                                <div id="foto_editar1" class="text-center">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label></label>
                                    <div class="input-group">
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                <i class="fas fa-file-alt"></i>
                                            </span>
                                        </div>
                                        <input type="file" class="form-control" name="imagen_cotizacion2" id="imagen_cotizacion2" accept="image/png, image/jpeg, application/pdf">
                                    </div>
                                </div>
                                <div id="foto_editar2" class="text-center">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label></label>
                                    <div class="input-group">
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                <i class="fas fa-file-alt"></i>
                                            </span>
                                        </div>
                                        <input type="file" class="form-control" name="imagen_cotizacion3" id="imagen_cotizacion3" accept="image/png, image/jpeg, application/pdf">
                                    </div>
                                </div>
                                <div id="foto_editar3" class="text-center">
                                </div>
                            </div>

                        </div>

                        <hr class="my-4">
                        <!--BOTON GUARDAR -->
                        <div class="text-center">
                            <button type="submit" class="btn btn-md bg-gradient-success btnCrearOrden" form="formularioOrden"><i class="fas fa-plus"></i><b id="botonCrear"> Crear Orden</b></button>
                        </div>
                    </form>

                    <hr class="my-4 bg-dark">
                    <!--|||TABLA RESUMEN DE ORDENES DE PRODUCTOS|||-->
                    <div class="col-12">
                        <div class="card card-outline card-success">

                            <div class="card-header">
                                <h5 class="card-title"><i><b>Listado de órdenes de compras</b></i></h5>
                            </div>

                            <div class="card-body">

                                <div class="table-responsive">
                                    <table class="table table-sm table-bordered table-striped text-center text-nowrap" id="tablaOrdenes">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>...</th>
                                                <th>Estado de orden</th>
                                                <th>Número de cotización</th>
                                                <th>Proveedor</th>
                                                <th>Observaciones</th>
                                                <th>Fecha elaboración</th>
                                                <th>Forma de pago</th>
                                                <th>Tipo de compra</th>
                                                <th>Cotizaciones</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbody_tablaOrdenes">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="modal-footer justify-content-center bg-dark">
                <a class="btn btn-app bg-danger" data-dismiss="modal">
                    <i class="fas fa-ban"></i> Cerrar
                </a>
            </div>
        </div>
    </div>
</div>
<!--==================================================
    MODAL DE INVENTARIO
===================================================-->
<div class="modal fade" id="modal-inventario" style="display: none; padding-right: 17px;" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h4 class="modal-title">Ingreso del producto</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card-body">

                </div>
            </div>
            <div class="modal-footer justify-content-center bg-dark">
                <a class="btn btn-app bg-success">
                    <i class="fas fa-plus"></i> Guardar
                </a>

                <a class="btn btn-app bg-danger" data-dismiss="modal">
                    <i class="fas fa-ban"></i> Cancelar
                </a>
            </div>
            <!-- /.modal-content -->
        </div>
    </div>
</div>
<!-- =================================================
    MODAL PRODUCTOS A SELECCIONAR EN ORDEN
===================================================-->
<div class="modal fade show" id="modalProductos" aria-modal="true" role="dialog" style="overflow-y: scroll;">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h4 class="modal-title">Lista de productos</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <div class="card card-outline ">
                <div class="card-body">
                    <div class="col-12">
                        <div class="table-responsive">
                            <table id="tablaProductosOrden" class="table table-sm table-striped table-bordered dt-responsive text-center table-hover w-100">
                                <thead class="text-nowrap">
                                    <th>ID</th>
                                    <th>Descripción</th>
                                    <th>Código</th>
                                    <th>Referencia</th>
                                    <th>Categoria</th>
                                    <th>Marca</th>
                                    <th>Medidad</th>
                                    <th>Seleccionar</th>
                                </thead>
                                <tbody id="tbodyProductosOrden" class="text-nowrap">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>