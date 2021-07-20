<?php

if (!validarModulo('M_VEHICULAR')) {
    echo "<script> window.location = 'inicio'; </script>";
}

$Vehiculos = ControladorVehiculos::ctrListaVehiculos();
$Conductores = ControladorVehiculos::ctrListaConductores();
?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark ">FUEC</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                        <li class="breadcrumb-item active">FUEC</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->


    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <!--BOTON NUEVO FUEC-->
                    <button type="button" class="btn btn-success btn-md btn-nuevofuec" data-toggle="modal" data-target="#NuevoFuec">
                        <i class="fab fa-wpforms"></i> Nuevo FUEC
                    </button>
                </div><!-- col -->
            </div> <!-- /.row -->
            <!-- ===================== 
              AGREGAR FILAS Y COLUMNAS PARA EL DESARROLLO 
            ========================= -->
            <div class="row mt-2">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header bg-info"></div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-sm table-striped table-bordered dt-responsive table-hover tablasBtnExport w-100">
                                    <thead class="thead-light text-sm text-nowrap">
                                        <tr>
                                            <th style="width:10px;">#</th>
                                            <th>Editar</th>
                                            <th>FUEC</th>
                                            <th>Placa</th>
                                            <th>Nro. Interno afiliado</th>
                                            <th>Vinculación</th>
                                            <th>Objeto contrato</th>
                                            <th>Origen</th>
                                            <th>Destino</th>
                                            <th>Fecha inicial</th>
                                            <th>Fecha final</th>
                                            <th>Conductor 1</th>
                                            <th>Documento conductor 1</th>
                                            <th>Conductor 2</th>
                                            <th>Documento conductor 2</th>
                                            <th>Conductor 3</th>
                                            <th>Documento conductor 3</th>
                                            <th>Cliente ocasional</th>
                                            <th>Cliente fijo</th>
                                            <th>Fecha de creación</th>
                                            <th>Sucursal</th>
                                            <th>USUARIO</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td></td>
                                            <td>
                                                <div class="btn-group" role="group" aria-label="Button group">
                                                    <button class="btn btn-sm btn-info btnEditarFuec" data-toggle="modal" data-target="#NuevoFuec"><i class="fas fa-pencil-alt"></i></button>
                                                </div>
                                            </td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer bg-dark"></div>
                    </div>
                </div><!-- col -->
            </div> <!-- /.row -->

        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- ==================================
     ========MODALS FUEC ==========
     ==================================-->


<!--MODAL AGREGAR FUEC-->

<div class="modal fade" id="NuevoFuec" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">

            <div class="modal-header bg-info">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form method="post" enctype="multipart/form-data">

                    <div class="row">
                        <div class="col-md-6">

                            <div class="form-group">
                                <label>Tipo de contrato</label>
                                <div class="input-group">
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <i class="far fa-file-alt"></i>
                                        </span>
                                    </div>
                                    <select class="form-control input-fuec" type="text" id="TipoContrato" name="TipoContrato" required>
                                        <option selected value="">-Seleccione un tipo-</option>
                                        <option selected value="fijo">Fijo</option>
                                        <option selected value="ocasional">Ocasional</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Vehículo</label>
                                <div class="input-group">
                                    <div class="input-group-prepend d-none d-sm-block d-md-none d-xl-block" style="width: 10%;">
                                        <span class="input-group-text" style="height: 93%;"><i class="fas fa-car-side"></i></span>
                                    </div>
                                    <select id="vehiculofuec" class="form-control select2-single input-fuec" style="width: 90%" name="vehiculofuec" required>
                                        <option value="" selected>-Seleccione un vehículo</option>
                                        <?php foreach ($Vehiculos as $key => $value) : ?>
                                            <option value="<?= $value['idvehiculo'] ?>"><?= $value['placa'] ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Conductor 1</label>
                                <div class="input-group">
                                    <div class="input-group-prepend d-none d-sm-block d-md-none d-xl-block" style="width: 10%;">
                                        <span class="input-group-text" style="height: 93%;"><i class="fas fa-user-check"></i></span>
                                    </div>
                                    <select id="conductor1" class="form-control select2-single input-fuec" style="width: 90%" name="conductor1" required>
                                        <option value="" selected>-Seleccione un conductor</option>
                                        <?php foreach ($Conductores as $key => $value) : ?>
                                            <option value="<?= $value['idPersonal'] ?>"><?= $value['Documento'] ?> - <?= $value['Nombre'] ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Conductor 2</label>
                                <div class="input-group">
                                    <div class="input-group-prepend d-none d-sm-block d-md-none d-xl-block" style="width: 10%;">
                                        <span class="input-group-text" style="height: 93%;"><i class="fas fa-user-check"></i></span>
                                    </div>
                                    <select id="conductor2" class="form-control select2-single input-fuec" style="width: 90%" name="conductor2" required>
                                        <option value="" selected>-Seleccione un conductor</option>
                                        <?php foreach ($Conductores as $key => $value) : ?>
                                            <option value="<?= $value['idPersonal'] ?>"><?= $value['Documento'] ?> - <?= $value['Nombre'] ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Conductor 3</label>
                                <div class="input-group">
                                    <div class="input-group-prepend d-none d-sm-block d-md-none d-xl-block" style="width: 10%;">
                                        <span class="input-group-text" style="height: 93%;"><i class="fas fa-user-check"></i></span>
                                    </div>
                                    <select id="conductor3" class="form-control select2-single input-fuec" style="width: 90%" name="conductor3" required>
                                        <option value="" selected>-Seleccione un conductor</option>
                                        <?php foreach ($Conductores as $key => $value) : ?>
                                            <option value="<?= $value['idPersonal'] ?>"><?= $value['Documento'] ?> - <?= $value['Nombre'] ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Fecha inicial</label>
                                <div class="input-group">
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <i class="far fa-calendar-plus"></i>
                                        </span>
                                    </div>
                                    <input class="form-control input-fuec" type="date" id="fechaini" name="fechaini" placeholder="Seleccione una fecha" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Fecha de vencimiento</label>
                                <div class="input-group">
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <i class="far fa-calendar-minus"></i>
                                        </span>
                                    </div>
                                    <input class="form-control input-fuec" type="date" id="fechafin" name="fechafin" placeholder="Seleccione una fecha" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Objeto de contrato</label>
                                <div class="input-group">
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <i class="fas fa-envelope-open-text"></i>
                                        </span>
                                    </div>
                                    <input class="form-control input-fuec" type="text" id="objetocontrato" name="objetocontrato" required>
                                </div>
                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="form-group">
                                <label>Origen</label>
                                <div class="input-group">
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <i class="fas fa-route"></i>
                                        </span>
                                    </div>
                                    <input class="form-control input-fuec" type="text" id="origen" name="origen" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Destino</label>
                                <div class="input-group">
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <i class="fas fa-route"></i>
                                        </span>
                                    </div>
                                    <input class="form-control input-fuec" type="text" id="destino" name="destino" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Observaciones del contrato</label>
                                <div class="input-group">
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <i class="fas fa-comment-dots"></i>
                                        </span>
                                    </div>
                                    <input class="form-control input-fuec" type="text" id="observacionescontr" name="observacionescontr" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Precio</label>
                                <div class="input-group">
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <i class="fas fa-user"></i>
                                        </span>
                                    </div>
                                    <input class="form-control input-fuec" type="text" id="precio" name="precio" required>
                                </div>
                            </div>

                            <div class="form-group clearfix">
                                <label>Listado pasajeros</label>
                                <div class="icheck-primary d-inline">
                                    <input class="form-control input-fuec" type="radio" id="pasajeros1" name="pasajeros" checked value="Si">
                                    <label class="font-weight-normal" for="cb1">Si</label>
                                </div>
                                <div class="icheck-primary d-inline">
                                    <input class="form-control input-fuec" type="radio" id="pasajeros2" name="pasajeros" value="No">
                                    <label class="font-weight-normal" for="cb2">No</label>
                                </div>
                                <div class="icheck-primary d-inline">
                                    <input class="form-control input-fuec" type="radio" id="pasajeros3" name="pasajeros" value="N/A">
                                    <label class="font-weight-normal" for="cb2">N/A</label>
                                </div>
                            </div>

                            <div class="form-group clearfix">
                                <label>Estado</label>
                                <div class="icheck-primary d-inline">
                                    <input class="form-control input-fuec" type="radio" id="estado1" name="estado" checked value="Pago">
                                    <label class="font-weight-normal" for="cb1">Pago</label>
                                </div>
                                <div class="icheck-primary d-inline">
                                    <input class="form-control input-fuec" type="radio" id="estado2" name="estado" value="Pendiente">
                                    <label class="font-weight-normal" for="cb2">Pendiente</label>
                                </div>
                                <div class="icheck-primary d-inline">
                                    <input class="form-control input-fuec" type="radio" id="estado3" name="estado" value="N/A">
                                    <label class="font-weight-normal" for="cb2">N/A</label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Valor neto</label>
                                <div class="input-group">
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <i class="fas fa-money-check-alt"></i>
                                        </span>
                                    </div>
                                    <input class="form-control input-fuec" type="text" id="valorneto" name="valorneto" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Documento contratante</label>
                                <div class="input-group">
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <i class="fas fa-file-alt"></i>
                                        </span>
                                    </div>
                                    <input class="form-control input-fuec" type="text" id="documcontrat" name="documcontrat" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Adjuntar contrato</label>
                                <div class="input-group">
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <i class="fas fa-file-alt"></i>
                                        </span>
                                    </div>
                                    <input class="form-control input-fuec" type="text" id="contratoadjunto" name="contratoadjunto" required>
                                </div>
                            </div>

                        </div>

                    </div>

                </form>
            </div>

            <div class="modal-footer bg-dark">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-save"></i>
                    Guardar
                </button>
            </div>
        </div>
    </div>
</div>