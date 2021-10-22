<?php

// if (!validarPermiso('CARGAR_OPCION', 'R')) {
//     echo "<script> window.location = 'inicio'; </script>";
// }


?>
<!-- ===================== 
  MODELO PARA LA IMPLEMENTARCION EN EL DISEÑO DE LOS MODULOS
  ESTRUCTURA 
========================= -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark ">Inventario <i class="fas fa-pallet"></i></h1>
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
            <!-- ===================== 
              AGREGAR FILAS Y COLUMNAS PARA EL DESARROLLO 
            ========================= -->
            <div class="row mt-2 d-flex justify-content-center">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>###</h3>

                            <p>Ordenes de Compras</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-cart-arrow-down"></i>
                        </div>
                        <a href="#" class="small-box-footer btn" data-toggle="modal" data-target="#modal-ordencompra">Agregar <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>###</h3>

                            <p>Ordenes de Compras</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-cart-arrow-down"></i>
                        </div>
                        <a href="#" class="small-box-footer btn" data-toggle="modal" data-target="#modal-ordencompra">Agregar <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>###</h3>

                            <p>Ordenes de Compras</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-cart-arrow-down"></i>
                        </div>
                        <a href="#" class="small-box-footer btn" data-toggle="modal" data-target="#modal-ordencompra">Agregar <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div> <!-- /.row -->

            <div class="row d-flex justify-content-center">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>###</h3>

                            <p>Ordenes de Compras</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-cart-arrow-down"></i>
                        </div>
                        <a href="#" class="small-box-footer btn" data-toggle="modal" data-target="#modal-ordencompra">Agregar <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>###</h3>

                            <p>Ordenes de Compras</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-cart-arrow-down"></i>
                        </div>
                        <a href="#" class="small-box-footer btn" data-toggle="modal" data-target="#modal-ordencompra">Agregar <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- ===================================================
    MODAL DE ORDEN COMPRA
=================================================== -->
<div class="modal fade show" id="modal-ordencompra" style="display: none; padding-right: 17px;" aria-modal="true" role="dialog">
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
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group text-center">
                                <label><i>Descripción del producto</i></label>
                                <input type="text" class="form-control" id="descriprodcuto" name="descriprodcuto" required>
                            </div>
                        </div>

                        <div class="col-12 col-sm-6 col-lg-4">
                            <div class="form-group text-center">
                                <label><i>Referencia - Marca</i></label>
                                <input type="text" class="form-control" id="refmarca" name="refmarca" required>
                            </div>
                        </div>

                        <div class="col-12 col-sm-6 col-lg-4">
                            <div class="form-group text-center">
                                <label><i>Marca del producto</i></label>
                                <select class="custom-select rounded-0" id="marcaproducto" name="marcaproducto" required>
                                    <option value="" selected>Seleccione una marca</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-12 col-sm-6 col-lg-4">
                            <div class="form-group text-center">
                                <label><i>Medida</i></label>
                                <select class="custom-select rounded-0" id="medida" name="medida" required>
                                    <option value="" selected>Seleccione medida</option>
                                    <option>1 / 2</option>
                                    <option>1 / 4</option>
                                    <option>3 / 4</option>
                                    <option>Bandeja</option>
                                    <option>Caja</option>
                                    <option>Examen</option>
                                    <option>Galon</option>
                                    <option>Paca</option>
                                    <option>Paquete</option>
                                    <option>Talonario</option>
                                    <option>Unidad</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-12 col-sm-6 col-lg-4">
                            <div class="form-group text-center">
                                <label><i>Tipo de repuesto</i></label>
                                <select class="custom-select rounded-0" id="tiporepuesto" name="tiporepuesto" required>
                                    <option value="" selected>Seleccione un repuesto</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-12 col-sm-6 col-lg-4">
                            <div class="form-group text-center">
                                <label><i>Proovedor</i></label>
                                <select class="custom-select rounded-0" id="proovedor" name="proovedor" required>
                                    <option value="" selected>Seleccione un proovedor</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-12 col-sm-6 col-lg-4">
                            <div class="form-group text-center">
                                <label><i>Ciudad</i></label>
                                <select class="form-control input-sm select2-single input-ciudad" style="width: 99%" type="number" id="ciudad" name="ciudad" required>
                                    <option selected value="">Seleccione una ciudad</option>
                                    <?php foreach ($DeparMunicipios as $key => $value) : ?>
                                        <option value="<?= $value['idmunicipio'] ?>"><?= $value['DeparMunic'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-12 col-sm-6 col-lg-4">
                            <div class="form-group text-center">
                                <label><i>Cantidad</i></label>
                                <input type="text" class="form-control" id="cantidad" name="cantidad" required>
                            </div>
                        </div>

                        <div class="col-12 col-sm-6 col-lg-4">
                            <div class="form-group text-center">
                                <label><i>Ultimo valor comprado</i></label>
                                <input type="text" class="form-control" id="ultimovalor" name="ultimovalor" required>
                            </div>
                        </div>

                        <div class="col-12 col-sm-6 col-lg-4">
                            <div class="form-group text-center">
                                <label><i>% de IVA</i></label>
                                <input type="text" class="form-control" id="iva" name="iva" required>
                            </div>
                        </div>

                        <!--|||TABLA RESUMEN DE PRODUCTOS|||-->
                        <div class="col-12">
                            <div class="card">
                                <div class="card card-outline card-success">
                                    <div class="card-body">
                                        <h5 class="text-center"><i>Tabla resumen de compras</i></h5>
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-striped text-center text-nowrap tablas">
                                                <thead>
                                                    <tr>
                                                        <th>Descripcion del producto</th>
                                                        <th>Referencia - Marca</th>
                                                        <th>Marca del producto</th>
                                                        <th>Medida</th>
                                                        <th>Tipo de repuesto</th>
                                                        <th>Proovedor</th>
                                                        <th>Ciudad</th>
                                                        <th>Cantidad</th>
                                                        <th>Ultimo valor comprado</th>
                                                        <th>% de IVA</th>
                                                    </tr>
                                                </thead>

                                                <!-- <tbody>
                                                    <?php foreach ($inventario_almacen as $key => $value) : ?>
                                                    <tr>
                                                        <td><?= $value['descriprodcuto'] ?></td>
                                                        <td><?= $value['refmarca'] ?></td>
                                                        <td><?= $value['marcaproducto'] ?></td>
                                                        <td><?= $value['medida'] ?></td>
                                                        <td><?= $value['tiporepuesto'] ?></td>
                                                        <td><?= $value['proovedor'] ?></td>
                                                        <td><?= $value['ciudad'] ?></td>
                                                        <td><?= $value['cantidad'] ?></td>
                                                        <td><?= $value['ultimovalor'] ?></td>
                                                        <td><?= $value['iva'] ?></td>
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
                </div>
            </div>

            <div class="modal-footer justify-content-center bg-success">
                <button type="button" class="btn btn-primary"><i class="fas fa-save"></i> Guardar</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-ban"></i>
                    Cancelar</button>
            </div>
            <!-- /.modal-content -->
        </div>
    </div>
</div>