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
                    <h1 class="m-0 text-dark "><strong><i>Almacen</i></strong> <i class="fas fa-pallet"></i></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                        <li class="breadcrumb-item active">Almacen</li>
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

            <div class="card card-outline card-success">
                <div class="card-body">
                    <hr class="my-4 bg-dark">
                    <div class="row mt-2 d-flex justify-content-center">
                        <div class="col-lg-3 col-6">
                            <!--PRODUCTOS-->
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h3><i class="fas fa-ellipsis-h"></i></h3>
                                    <p><i>Productos</i></p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-cubes"></i>
                                </div>
                                <a href="#" class="small-box-footer btn" data-toggle="modal" data-target="#modal-productos">Nuevo <i class="fas fa-plus-circle"></i></a>
                            </div>
                        </div>

                        <div class="col-lg-3 col-6">
                            <!--ORDENES DE COMPRA-->
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3><i class="fas fa-ellipsis-h"></i></h3>
                                    <p><i>Órdenes de Compras</i></p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-shopping-cart"></i>
                                </div>
                                <a href="#" class="small-box-footer btn" data-toggle="modal" data-target="#modal-ordencompra">Nuevo <i class="fas fa-plus-circle"></i></a>
                            </div>
                        </div>

                        <div class="col-lg-3 col-6">
                            <!--AUTORIZACION DE COMPRA-->
                            <div class="small-box bg-primary">
                                <div class="inner">
                                    <h3><i class="fas fa-ellipsis-h"></i></h3>
                                    <p><i>Autorizaciones de compras</i></p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-file-invoice-dollar"></i>
                                </div>
                                <a href="#" class="small-box-footer btn" data-toggle="modal" data-target="#modal-autorizaciones">Verificar <i class="fas fa-check"></i></a>
                            </div>
                        </div>

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
<div class="modal fade show" id="modal-productos" style="display: none; padding-right: 17px;" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h4 class="modal-title" id="titulo_producto">Nuevo producto</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card-body">
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
                                            <a href="cg-almacen" target="_blank"><button type="button" class="btn btn-info btn-md btn-ruta" title="Crear nueva categoria" data-toggle="tooltip" data-placement="top"><i class="fas fa-plus"></i></button></a>
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
                                            <a href="cg-almacen" target="_blank"><button type="button" class="btn btn-info btn-md btn-ruta" title="Crear nueva marca" data-toggle="tooltip" data-placement="top"><i class="fas fa-plus"></i></button></a>
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
                                            <a href="cg-almacen" target="_blank"><button type="button" class="btn btn-info btn-md btn-ruta" title="Crear nueva medida" data-toggle="tooltip" data-placement="top"><i class="fas fa-plus"></i></button></a>
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

                    <hr>

                    <form id="formulario_addInventario" method="post" enctype="multipart/form-data">
                        <div class="row">

                            <div class="col-12 col-sm-6 col-lg-4">
                                <div class="form-group text-center">
                                    <label><i>Proveedor</i></label>
                                    <div class="input-group">
                                        <select class="select2-single rounded-0" id="proveedor" name="proveedor" required>
                                        </select>
                                        <div class="input-group-append">
                                            <a href="c-proveedores" target="_blank"><button type="button" class="btn btn-info btn-md btn-ruta" title="Crear nuevo proveedor" data-toggle="tooltip" data-placement="top"><i class="fas fa-plus"></i></button></a>
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
                                    <label><i>Cantidad (unidades)</i></label>
                                    <input type="text" class="form-control input_inventario" id="cantidad" name="cantidad" placeholder="-" required readonly>
                                </div>
                            </div>

                            <div class="col-12 col-sm-6 col-lg-4">
                                <div class="form-group text-center">
                                    <label><i>Sucursal - bodega</i></label>
                                    <div class="input-group">
                                        <select class="select2-single rounded-0" id="sucursal" name="sucursal" required>
                                        </select>
                                        <div class="input-group-append">
                                            <a href="cg-gestion-humana" target="_blank"><button type="button" class="btn btn-info btn-md btn-ruta" title="Crear nueva sucursal" data-toggle="tooltip" data-placement="top"><i class="fas fa-plus"></i></button></a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-sm-6 col-lg-4">
                                <div class="form-group text-center">
                                    <label><i>Posición</i> <i class="fas fa-sitemap"></i></label>
                                    <input type="text" class="form-control input_inventario" id="posicion" name="posicion" placeholder="-" required readonly>
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
                    <!--|||TABLA RESUMEN DE PRODUCTOS|||-->

                    <hr class="my-4 bg-success">

                    <div class="card card-success collapsed-card">
                        <div class="card-header" data-card-widget="collapse" style="cursor: pointer;">
                            <h5 class="mb-0">
                                <strong><i>Productos</i> </strong>
                                <button type="button" class="btn btn-tool" title="Ver inventario pantalla completa" data-toggle="tooltip" data-placement="top" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped text-center text-nowrap" id="tabla_productos">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nombre/Descripción</th>
                                            <th>Código</th>
                                            <th>Referencia</th>
                                            <th>Categoria</th>
                                            <th>Marca</th>
                                            <th>Medida</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody_productos">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="card card-success collapsed-card">
                        <div class="card-header" data-card-widget="collapse" style="cursor: pointer;">
                            <h5 class="mb-0">
                                <strong><i>Inventario</i> </strong>
                                <button type="button" class="btn btn-tool" title="Ver productos pantalla completa" data-toggle="tooltip" data-placement="top" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped text-center text-nowrap">
                                    <thead>
                                        <tr>
                                            <th colspan="8">PRODUCTOS</th>
                                            <th colspan="4">ENTRADAS</th>
                                            <th colspan="4">SALIDAS</th>
                                            <th colspan="3">SALDO</th>
                                            <th colspan='1'>SUCURSALES</th>
                                        </tr>
                                        <tr>
                                            <th>Código</th>
                                            <th>Referencia</th>
                                            <th>Descripción</th>
                                            <th>Categoria</th>
                                            <th>Marca</th>
                                            <th>Medida</th>
                                            <th>Sucursal</th>
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
                                            <th>Sucursal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>12314</td>
                                            <td>optyui-12367</td>
                                            <td>MANUBRIO</td>
                                            <td>TALLER</td>
                                            <td>NISAN</td>
                                            <td>2</td>
                                            <td>centimetros</td>
                                            <td>Dosquebradas</td>
                                            <td>2/02/2021</td>
                                            <td><button class="btn btn-sm btn-success" title="Actualizar inventario" data-toggle="tooltip" data-placement="top"><i class="fas fa-redo-alt"></i></button></td>
                                            <td>1</td>
                                            <td>1</td>
                                            <td>2/02/2021</td>
                                            <td><button class="btn btn-sm btn-success" title="Actualizar inventario" data-toggle="tooltip" data-placement="top"><i class="fas fa-redo-alt"></i></button></td>
                                            <td>1</td>
                                            <td>1</td>
                                            <td>1</td>
                                            <td>1</td>
                                            <td>1</td>
                                            <td><button class="btn btn-sm btn-primary" title="Ver sucursales" data-toggle="tooltip" data-placement="top"><i class="fas fa-map-marker-alt"></i></button></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-center bg-dark">

            </div>
            <!-- /.modal-content -->
        </div>
    </div>
</div>

<!-- ===================================================
    MODAL DE ORDENES DE COMPRAS
=================================================== -->
<div class="modal fade show" id="modal-ordencompra" style="display: none; padding-right: 17px;" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h4 class="modal-title">Orden de compra</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-sm-6 col-lg-4">
                            <div class="form-group text-center">
                                <label><i>Fecha de elaboración</i></label>
                                <input type="date" class="form-control" id="fechaelaboracion" name="fechaelaboracion">
                            </div>
                        </div>

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
                                    <option value="">Contado</option>
                                    <option value="">Credito</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-12 col-sm-6 col-lg-4">
                            <div class="form-group text-center">
                                <label><i>Proovedor</i></label>
                                <select class="custom-select rounded-0" id="proovedorcompras" name="proovedorcompras" required>
                                    <option value="" selected>Seleccione un proovedor</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-12 col-sm-6 col-lg-4">
                            <div class="form-group text-center">
                                <label><i>Teléfono proveedor</i></label>
                                <input type="text" class="form-control" id="numcotizacion" name="numcotizacion" required>
                            </div>
                        </div>


                        <div class="col-12 col-sm-6 col-lg-4">
                            <div class="form-group text-center">
                                <label><i>Dirección de entrega</i></label>
                                <input type="text" class="form-control" id="direccionproveedores" name="direccionproveedores" placeholder="Digite direccion" required>
                            </div>
                        </div>


                        <div class="col-12 col-sm-6 col-lg-4">
                            <div class="form-group text-center">
                                <label><i>Tipo de compra</i></label>
                                <select class="custom-select rounded-0" id="cconit" name="cconit" required>
                                    <option value="" selected>Seleccione una opción</option>
                                    <option value="">Servicio</option>
                                    <option value="">Producto</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group text-center">
                        <label for="observaciones"><i>Observaciones</i></label>
                        <textarea class="form-control" name="observaciones" id="observaciones" rows="2"></textarea>
                    </div>

                    <hr class="my-4 bg-dark">

                    <!--|||TABLA RESUMEN DE ORDENES DE PRODUCTOS|||-->
                    <div class="col-12">
                        <div class="card card-outline card-success">
                            <div class="card-body">
                                <h5 class="text-center"><i>Órdenes de compras</i></h5>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped text-center text-nowrap tablas">
                                        <thead>
                                            <tr>
                                                <th>Estado</th>
                                                <th>Proveedor</th>
                                                <th>Número de documento</th>
                                                <th>Teléfono o Celular</th>
                                                <th>Dirección</th>
                                                <th>Forma de pago</th>
                                                <th>Número de cotización</th>
                                                <th>Elaborado por</th>
                                                <th>Fecha de elaboración</th>
                                                <th>Tipo de compra</th>
                                                <th>Observaciones</th>
                                            </tr>
                                        </thead>

                                        <!-- <tbody>
                                                    <?php foreach ($inventario_almacen as $key => $value) : ?>
                                                    <tr>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td>></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                    <?php endforeach ?>
                                                </tbody> -->
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

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
        </div>
    </div>
</div>

<!-- ===================================================
    MODAL DE INVENTARIO
=================================================== -->
<div class="modal fade show" id="modal-inventario" style="display: none; padding-right: 17px;" aria-modal="true" role="dialog">
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