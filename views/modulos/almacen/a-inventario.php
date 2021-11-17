<?php

// if (!validarPermiso('CARGAR_OPCION', 'R')) {
//     echo "<script> window.location = 'inicio'; </script>";
// }

$ListaProovedores = ControladorProveedores::ctrListarProveedores();
$Municipios = ControladorGH::ctrDeparMunicipios();
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
                    <h1 class="m-0 text-dark "><strong><i>Inventario</i></strong> <i class="fas fa-pallet"></i></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                        <li class="breadcrumb-item active">Inventario</li>
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
                            <!--PROVEEDORES-->
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3><i class="fas fa-ellipsis-h"></i></h3>
                                    <p><i>Proveedores</i></p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-user-plus"></i>
                                </div>
                                <a href="c-proveedores" target="_blank" class="small-box-footer btn">Crear <i class="fas fa-arrow-right"></i></a>
                            </div>
                        </div>

                        <div class="col-lg-3 col-6">
                            <!--PRODUCTOS-->
                            <div class="small-box bg-warning">
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
                            <div class="small-box bg-success">
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

                    </div>

                    <hr class="my-4 bg-dark">

                    <div class="row d-flex justify-content-center">
                        <div class="col-lg-3 col-6">
                            <!--AUTORIZACION DE COMPRA-->
                            <div class="small-box bg-danger">
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
                        <!--INVENTARIO-->
                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-gray">
                                <div class="inner">
                                    <h3><i class="fas fa-ellipsis-h"></i></h3>
                                    <p><i>Inventario</i></p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-clipboard-list"></i>
                                </div>
                                <a href="#" class="small-box-footer btn" data-toggle="modal" data-target="#modal-inventario">Modificar <i class="fas fa-plus-circle"></i></a>
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
                <h4 class="modal-title">Nuevo producto</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-sm-6 col-lg-4">
                            <div class="form-group text-center">
                                <label><i>Código del producto</i> <i class="fas fa-barcode"></i></label>
                                <input type="text" class="form-control" id="cod_producto" name="cod_producto" readonly>
                            </div>
                        </div>


                        <div class="col-12 col-sm-6 col-lg-4">
                            <div class="form-group text-center">
                                <label><i>Referencia</i></label>
                                <input type="text" class="form-control" id="referencia" name="referencia" placeholder="Referencia" required>
                            </div>
                        </div>

                        <div class="col-12 col-sm-6 col-lg-4">
                            <div class="form-group text-center">
                                <label><i>Descripción</i></label>
                                <input type="text" class="form-control" id="descripcion_prod" name="descripcion_prod" placeholder="Descripción del producto / Nombre del producto" required>
                            </div>
                        </div>

                        <div class="col-12 col-sm-6 col-lg-4">
                            <div class="form-group text-center">
                                <label><i>Categoria</i></label>
                                <select class="custom-select rounded-0" id="categoria" name="categoria" required>
                                </select>
                            </div>
                        </div>

                        <div class="col-12 col-sm-6 col-lg-4">
                            <div class="form-group text-center">
                                <label><i>Marca</i> <i class="fas fa-copyright"></i></label>
                                <select class="custom-select rounded-0" id="marca" name="marca" required>
                                </select>
                            </div>
                        </div>

                        <div class="col-12 col-sm-6 col-lg-4">
                            <div class="form-group text-center">
                                <label><i>Cantidad (unidades)</i></label>
                                <input type="text" class="form-control" id="cantidad" name="cantidad" required>
                            </div>
                        </div>

                        <div class="col-12 col-sm-6 col-lg-4">
                            <div class="form-group text-center">
                                <label><i>Medida</i></label>
                                <select class="custom-select rounded-0" id="medida" name="medida" required>
                                </select>
                            </div>
                        </div>

                        <div class="col-12 col-sm-6 col-lg-4">
                            <div class="form-group text-center">
                                <label><i>Sucursal - bodega</i></label>
                                <select class="form-control input-sm select2-single input-ciudad" style="width: 99%" type="number" id="sucursal-producto" name="sucursal-producto" required>
                                    <option selected value="">Seleccione una ciudad</option>
                                    <?php foreach ($Municipios as $key => $value) : ?>
                                        <option value="<?= $value['idmunicipio'] ?>"><?= $value['DeparMunic'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>

                        <!-- <div class="col-12 col-sm-6 col-lg-4">
                            <div class="form-group text-center">
                                <label><i>Proovedor</i></label>
                                <select class="custom-select rounded-0" id="proovedorproductos" name="proovedorproductos" required>
                                    <option value="" selected>Seleccione un proovedor</option>
                                    <?php foreach ($ListaProovedores as $key => $value) : ?>
                                        <option value="<?= $value['id'] ?>"><?= $value['razon_social'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div> -->


                        <div class="col-12 col-sm-6 col-lg-4">
                            <div class="form-group text-center">
                                <label><i>Precio de compra</i> <i class="fas fa-dollar-sign"></i></label>
                                <input type="text" class="form-control" id="precio-compra-producto" name="precio-compra-producto" placeholder="$" required>
                            </div>
                        </div>

                        <!--|||TABLA RESUMEN DE PRODUCTOS|||-->
                        <div class="col-12">

                            <hr class="my-4 bg-dark">

                            <div class="card card-outline card-dark">
                                <div class="card-body">
                                    <h5 class="card-title"><i><strong>Entrada productos</strong> </i></h5>
                                    <hr class="my-4">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped text-center text-nowrap tablas">
                                            <thead>
                                                <tr>
                                                    <th>Código</th>
                                                    <th>Referencia</th>
                                                    <th>Descripción</th>
                                                    <th>Categoria</th>
                                                    <th>Marca</th>
                                                    <th>Cantidad (u)</th>
                                                    <th>Medida</th>
                                                    <th>Sucursal</th>
                                                    <th>Precio</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>12314</td>
                                                    <td>optyui-12367</td>
                                                    <td>MANUBRIO</td>
                                                    <td>TALLER</td>
                                                    <td>NISAN</td>
                                                    <td>2 - <button class="btn btn-sm btn-success" title="Actualizar inventario" data-toggle="tooltip" data-placement="top"><i class="fas fa-redo-alt"></i></button></td>
                                                    <td>centimetros</td>
                                                    <td>Dosquebradas</td>
                                                    <td>200.000</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
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
                                <label><i>Proovedor</i></label>
                                <select class="custom-select rounded-0" id="proovedorcompras" name="proovedorcompras" required>
                                    <option value="" selected>Seleccione un proovedor</option>
                                </select>
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
                                <label><i>Dirección</i></label>
                                <input type="text" class="form-control" id="direccionproveedores" name="direccionproveedores" placeholder="Digite direccion" required>
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
                                <label><i>Tipo de compra</i></label>
                                <select class="custom-select rounded-0" id="cconit" name="cconit" required>
                                    <option value="" selected>Seleccione una opción</option>
                                    <option value="">Servicio</option>
                                    <option value="">Producto</option>
                                </select>
                            </div>
                        </div>


                        

                        <div class="col-12 col-sm-6 col-lg-4">
                            <div class="form-group text-center">
                                <label><i>Elaborado por</i></label>
                                <input type="text" class="form-control" id="elaboradopor" name="elaboradopor" required>
                            </div>
                        </div>
                    </div>

                    <hr class="my-4 bg-dark">

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