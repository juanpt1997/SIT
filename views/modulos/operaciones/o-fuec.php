<?php

if (!validarPermiso('M_OPERACIONES', 'R')) {
    echo "<script> window.location = 'inicio'; </script>";
}

$OrdenesServicio = ControladorOrdenServicio::ctrVerListaOrden();
$Fijos = ControladorFijos::ctrVerFijos();
$Vehiculos = ControladorVehiculos::ctrListaVehiculos();
$ObjetosContrato = ControladorFuec::ctrObjetosContrato();
$Rutas = ControladorRutas::ctrListarRutas();
$FUEC = ControladorFuec::ctrListaFUEC();
$Conductores = ControladorVehiculos::ctrListaConductores();

?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark "><b><i>FUEC <i class="fas fa-book"></i></i></b></h1>
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
            <hr class="my-4">
            <div class="row">
                <div class="col">
                    <!--BOTON NUEVO FUEC-->
                    <button type="button" class="btn btn-success btn-md btn-nuevofuec" data-toggle="modal" data-target="#NuevoFuecModal">
                        <i class="fab fa-wpforms"></i> Nuevo FUEC
                    </button>
                </div><!-- col -->
            </div> <!-- /.row -->
            <!-- ===================== 
              AGREGAR FILAS Y COLUMNAS PARA EL DESARROLLO 
            ========================= -->
            <div class="row mt-2">
                <div class="col-12">
                    <div class="card card-outline card-info">

                        <div class="card-body">
                            <table id="tblFUEC" class="table table-responsive table-sm table-striped table-bordered table-hover w-100 text-center">
                                <thead class="thead-light text-sm text-nowrap">
                                    <tr>
                                        <th style="min-width:90px;">#</th>
                                        <th>Acciones</th>
                                        <!-- <th>FUEC</th> -->
                                        <th style="min-width:90px;">Placa</th>
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
                                        <th>Sucursal</th>
                                        <th>Fecha de creación</th>
                                        <th style="min-width:90px;">Usuario</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($FUEC as $key => $value) : ?>
                                        <tr>
                                            <td><?= $value['idfuec'] ?></td>
                                            <td>
                                                <div class='btn-group'>
                                                    <button class="btn btn-editarfuec" data-toggle="modal" data-target="#NuevoFuecModal" idfuec='<?= $value['idfuec'] ?>'><i class="fas fa-lg fa-pencil-alt text-info"></i></button>
                                                    <button type='button' class='btn btn-FTFuec' idfuec='<?= $value['idfuec'] ?>'><i class='fas fa-lg fa-book text-secondary'></i></button>
                                                </div>
                                            </td>
                                            <td><?= $value['placa'] ?></td>
                                            <td><?= $value['numinterno'] ?></td>
                                            <td><?= $value['tipovinculacion'] ?></td>
                                            <td><?= $value['objetocontrato'] ?></td>
                                            <td><?= $value['origen'] ?></td>
                                            <td><?= $value['destino'] ?></td>
                                            <td><?= $value['fecha_inicial'] ?></td>
                                            <td><?= $value['fecha_vencimiento'] ?></td>
                                            <td><?= $value['conductor1'] ?></td>
                                            <td><?= $value['docConductor1'] ?></td>
                                            <td><?= $value['conductor2'] ?></td>
                                            <td><?= $value['docConductor2'] ?></td>
                                            <td><?= $value['conductor3'] ?></td>
                                            <td><?= $value['docConductor3'] ?></td>
                                            <td><?= $value['nomContratante'] ?></td>
                                            <td><?= $value['ClienteFijo'] ?></td>
                                            <td><?= $value['sucursal'] ?></td>
                                            <td><?= $value['fecha_creacion'] ?></td>
                                            <td><?= $value['usuarioCreacion'] ?></td>
                                        </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
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

<div class="modal fade" id="NuevoFuecModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="overflow-y: scroll;">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">

            <div class="modal-header bg-navy">
                <h5 class="modal-title font-weight-bold" id="titulo-modal-fuec"></h5>
                <button class="btn btn-app btn-sm bg-info ml-2 d-none btn-copy-fuec" type="button"><i class="fas fa-copy"></i> Copia</button>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form method="post" enctype="multipart/form-data" id="frmFUEC">
                    <input type="hidden" name="idfuec" id="idfuec" value="">
                    <input type="hidden" id="Observador-conductoresxvehiculo">

                    <!-- Tipo de contrato y contrato/contratante -->
                    <div class="row d-flex justify-content-md-center">
                        <div class="col-12 col-md-8 col-lg-6">
                            <div class="form-group">
                                <label>Tipo de contrato</label>
                                <div class="input-group">
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <i class="far fa-file-alt"></i>
                                        </span>
                                    </div>
                                    <select class="form-control" type="text" id="tipocontrato" name="tipocontrato" required>
                                        <option selected value="">-Seleccione un tipo-</option>
                                        <option selected value="FIJO">Fijo</option>
                                        <option selected value="OCASIONAL">Ocasional</option>
                                    </select>
                                </div>
                            </div>
                        </div><!-- /.col -->

                        <div class="col-12 col-md-10 col-lg-6 d-none" id="colContratoFijo">
                            <div class="form-group">
                                <label>Contrato fijo</label>
                                <div class="input-group">
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <i class="fas fa-file-alt"></i>
                                        </span>
                                    </div>
                                    <select id="contratofijo" class="form-control select2-single" style="width: 90%" name="contratofijo">
                                        <option value="" selected>-Seleccione una opción-</option>
                                        <?php foreach ($Fijos as $key => $value) : ?>
                                            <option value="<?= $value['idfijos'] ?>"><?= $value['idfijos'] . " - " . $value['nombre_cliente'] ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>
                        </div><!-- /.col -->

                        <div class="col-12 col-md-10 col-lg-6" id="colContratante">
                            <div class="form-group">
                                <label>Contratante</label>
                                <div class="input-group">
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <i class="fas fa-file-alt"></i>
                                        </span>
                                    </div>
                                    <select id="contratante" class="form-control select2-single input-fuec" style="width: 90%" name="contratante" required actualizo="SI">
                                        <option value="" selected>-Seleccione una opción-</option>
                                        <?php foreach ($OrdenesServicio as $key => $value) : ?>
                                            <option value="<?= $value['idorden'] ?>"><?= $value['idorden'] . " - " . $value['nomContrata'] ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>
                        </div><!-- /.col -->


                    </div><!-- /.row -->

                    <!-- Datos del cliente -->
                    <div class="row row-cliente">

                        <!-- Documento contratante -->
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label class="text-sm">Documento contratante</label>
                                <div class="input-group input-group-sm">
                                    <input class="form-control input-clientes" type="text" id="docum_empre" placeholder="Documento" readonly>
                                </div>
                            </div>
                        </div><!-- /.col -->

                        <!-- Dirección contratante -->
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label class="text-sm">Dirección contratante</label>
                                <div class="input-group input-group-sm">
                                    <input class="form-control input-clientes" type="text" id="dir_empre" placeholder="Dirección" readonly>
                                </div>
                            </div>
                        </div><!-- /.col -->

                        <!-- Teléfono contratante -->
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label class="text-sm">Teléfono contratante</label>
                                <div class="input-group input-group-sm">
                                    <input class="form-control input-clientes" type="text" min="0" id="telefono_empre" placeholder="Teléfono" readonly>
                                </div>
                            </div>
                        </div><!-- /.col -->

                        <!-- Responsable del contrato -->
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label class="text-sm">Responsable del contrato</label>
                                <div class="input-group input-group-sm">
                                    <input class="form-control input-clientes" type="text" id="nom_respo" placeholder="Nombre del responsable" readonly>
                                </div>
                            </div>
                        </div>

                        <!-- Documento cliente -->
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label class="text-sm">Documento cliente</label>
                                <div class="input-group input-group-sm">
                                    <input class="form-control input-clientes" type="text" id="docum_respo" placeholder="Documento del cliente" readonly>
                                </div>
                            </div>
                        </div><!-- /.col -->

                        <!-- Direccion cliente -->
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label class="text-sm">Dirección cliente</label>
                                <div class="input-group input-group-sm">
                                    <input class="form-control input-clientes" type="text" id="dir_respo" placeholder="Dirección cliente" readonly>
                                </div>
                            </div>
                        </div><!-- /.col -->

                        <!-- Teléfono cliente -->
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label class="text-sm">Teléfono cliente</label>
                                <div class="input-group input-group-sm">
                                    <input class="form-control input-clientes" type="text" id="telefono_cliente" placeholder="Teléfono" readonly>
                                </div>
                            </div>
                        </div><!-- /.col -->

                        <!-- Ciudad cliente -->
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label class="text-sm">Ciudad cliente</label>
                                <div class="input-group input-group-sm">
                                    <input class="form-control input-clientes" type="text" id="ciudad_cliente" placeholder="Ciudad" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label class="text-sm">Cédula cliente expedida en</label>
                                <div class="input-group input-group-sm">
                                    <input class="form-control input-clientes" type="text" id="expedicion_doccliente" placeholder="" readonly>
                                </div>
                            </div>
                        </div>



                    </div><!-- /.row -->

                    <hr class="my-4 bg-dark">

                    <!-- Datos del FUEC -->
                    <div class="row">

                        <!-- Vehículo -->
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label>Vehículo</label>
                                <div class="input-group">
                                    <div class="input-group-prepend d-none d-sm-block d-md-none d-xl-block" style="width: 10%;">
                                        <span class="input-group-text" style="height: 100%;"><i class="fas fa-car-side"></i></span>
                                    </div>
                                    <select id="vehiculofuec" class="form-control select2-single input-fuec" style="width: 90%" name="vehiculofuec" required>
                                        <option value="" selected>-Seleccione un vehículo</option>
                                        <?php foreach ($Vehiculos as $key => $value) : ?>
                                            <option value="<?= $value['idvehiculo'] ?>"><?= $value['placa'] ?> - <?= $value['numinterno'] ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>
                        </div><!-- /.col -->

                        <!-- Conductor 1 -->
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label>Conductor 1</label>
                                <div class="input-group">
                                    <div class="input-group-prepend d-none d-sm-block d-md-none d-xl-block" style="width: 10%;">
                                        <?php if (validarPermiso('M_VEHICULAR', 'U')) : ?>
                                            <span class="input-group-text bg-success btn-ModalConductores" data-toggle="modal" data-target="#agregar_conductor" style="height: 100%; cursor:pointer;"><i class="fas fa-user-check"></i></span>
                                        <?php else : ?>
                                            <span class="input-group-text" style="height: 100%;"><i class="fas fa-user-check"></i></span>
                                        <?php endif ?>
                                    </div>
                                    <select id="conductor1" class="form-control select2-single input-fuec conductores" style="width: 90%" name="conductor1" required>
                                        <option value="" selected>-Seleccione un conductor</option>
                                    </select>
                                    <div class="overlay overlay-conductores d-none">
                                        <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                                    </div>
                                </div>
                            </div>
                        </div><!-- /.col -->

                        <!-- Conductor 2 -->
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label>Conductor 2</label>
                                <div class="input-group">
                                    <div class="input-group-prepend d-none d-sm-block d-md-none d-xl-block" style="width: 10%;">
                                        <span class="input-group-text" style="height: 100%;"><i class="fas fa-user-check"></i></span>
                                    </div>
                                    <select id="conductor2" class="form-control select2-single input-fuec conductores" style="width: 90%" name="conductor2">
                                        <option value="" selected>-Seleccione un conductor</option>
                                    </select>
                                    <div class="overlay overlay-conductores d-none">
                                        <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                                    </div>
                                </div>
                            </div>
                        </div><!-- /.col -->

                        <!-- Conductor 3 -->
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label>Conductor 3</label>
                                <div class="input-group">
                                    <div class="input-group-prepend d-none d-sm-block d-md-none d-xl-block" style="width: 10%;">
                                        <span class="input-group-text" style="height: 100%;"><i class="fas fa-user-check"></i></span>
                                    </div>
                                    <select id="conductor3" class="form-control select2-single input-fuec conductores" style="width: 90%" name="conductor3">
                                        <option value="" selected>-Seleccione un conductor</option>
                                    </select>
                                    <div class="overlay overlay-conductores d-none">
                                        <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                                    </div>
                                </div>
                            </div>
                        </div><!-- /.col -->

                        <!-- Fecha inicial -->
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label>Fecha inicial</label>
                                <div class="input-group">
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <i class="far fa-calendar-plus"></i>
                                        </span>
                                    </div>
                                    <input class="form-control input-fuec input-ordenservicio" type="date" id="fechaini" name="fechaini" placeholder="Seleccione una fecha" required readonly>
                                </div>
                            </div>
                        </div><!-- /.col -->

                        <!-- Fecha de vencimiento -->
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label>Fecha de vencimiento</label>
                                <div class="input-group">
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <i class="far fa-calendar-minus"></i>
                                        </span>
                                    </div>
                                    <input class="form-control input-fuec input-ordenservicio" type="date" id="fechafin" name="fechafin" placeholder="Seleccione una fecha" required readonly>
                                </div>
                            </div>
                        </div><!-- /.col -->

                        <!-- Objeto de contrato -->
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label>Objeto de contrato</label>
                                <div class="input-group">
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <i class="fas fa-envelope-open-text"></i>
                                        </span>
                                    </div>
                                    <select id="objetocontrato" class="form-control input-fuec" name="objetocontrato" readonly required>
                                        <option value="">-Seleccione una opción-</option>
                                        <?php foreach ($ObjetosContrato as $key => $value) : ?>
                                            <?php $selected = $value['idobjeto'] == 4 ? "selected" : "" ?>
                                            <option <?= $selected ?> value="<?= $value['idobjeto'] ?>"><?= $value['objetocontrato'] ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>
                        </div><!-- /.col -->

                        <!-- Anotación objeto de contrato -->
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label>Anotación objeto de contrato</label>
                                <div class="input-group">
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <i class="fas fa-caret-right"></i>
                                        </span>
                                    </div>
                                    <input class="form-control input-fuec" type="text" id="anotObjetoContrato" name="anotObjetoContrato">
                                </div>
                            </div>

                        </div><!-- /.col -->

                    </div>

                    <hr class="my-4 bg-dark">
                    <div class="row">
                        <!-- Ruta (oculto) -->
                        <div class="col-12 d-none">
                            <hr class="my-4 bg-dark">
                            <div class="form-group">
                                <label for="idruta" class="d-flex justify-content-center"><i>RUTA</i></label>
                                <div class="input-group">
                                    <!-- <select class="form-control select2-single input-fuec input-ordenservicio" style="width: 99%" id="idruta" name="idruta" required>
                                        <option selected value="">-Seleccione una ruta-</option>
                                        <?php foreach ($Rutas as $key => $value) : ?>
                                            <option value="<?= $value['id'] ?>"><?= $value['origendestino'] ?></option>
                                        <?php endforeach ?>
                                    </select> -->
                                    <input type="hidden" id="idruta" name="idruta">
                                    <input class="form-control" type="text" id="observacionescontr" name="observacionescontr" placeholder="Seleccione una ruta de la lista" required>
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-success btn-md btn-ruta" title="Buscar una ruta existente" data-toggle="modal" data-target="#modal_general"><i class="fas fa-route"></i></button>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <!-- Origen -->
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label>Origen</label>
                                <div class="input-group">
                                    <div class="input-group-append">
                                        <span class="input-group-text bg-success btn-ruta" title="Buscar una ruta existente" data-toggle="modal" data-target="#modal_general" style="height: 100%; cursor:pointer;">
                                            <i class="fas fa-route"></i>
                                        </span>
                                    </div>
                                    <input class="form-control input-fuec" type="text" id="origen" name="origen" readonly>
                                </div>
                            </div>

                        </div><!-- /.col -->

                        <!-- Destino -->
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label>Destino</label>
                                <div class="input-group">
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <i class="fas fa-route"></i>
                                        </span>
                                    </div>
                                    <textarea class="form-control input-fuec" rows="1" id="destino" name="destino" required maxlength="2500"></textarea>
                                    <!-- <input class="form-control input-fuec" type="text" id="destino" name="destino" required maxlength="2000"> -->
                                </div>
                            </div>
                        </div><!-- /.col -->

                        <!-- Observaciones del contrato -->
                        <div class="col-12 col-md-6 d-none">
                            <div class="form-group">
                                <label>Observaciones del contrato</label>
                                <div class="input-group">
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <i class="fas fa-comment-dots"></i>
                                        </span>
                                    </div>
                                    <input class="form-control input-fuec input-ordenservicio" type="text" id="" name="" readonly>
                                </div>
                            </div>
                        </div><!-- /.col -->

                        <!-- Precio -->
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label>Precio</label>
                                <div class="input-group">
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <i class="fas fa-user"></i>
                                        </span>
                                    </div>
                                    <input class="form-control input-fuec" type="text" id="precio" name="precio">
                                </div>
                            </div>
                        </div><!-- /.col -->

                        <!-- Listado pasajeros -->
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label>Listado pasajeros</label>
                                <div class="form-group clearfix">
                                    <div class="icheck-primary d-inline">
                                        <input class="form-control input-fuec input-pasajeros" type="radio" id="pasajeros1" name="pasajeros" value="Si">
                                        <label class="font-weight-normal" for="pasajeros1">Si</label>
                                    </div>
                                    <div class="icheck-primary d-inline">
                                        <input class="form-control input-fuec input-pasajeros" type="radio" id="pasajeros2" name="pasajeros" value="No">
                                        <label class="font-weight-normal" for="pasajeros2">No</label>
                                    </div>
                                    <div class="icheck-primary d-inline">
                                        <input class="form-control input-fuec input-pasajeros" type="radio" id="pasajeros3" name="pasajeros" checked value="N/A">
                                        <label class="font-weight-normal" for="pasajeros3">N/A</label>
                                    </div>
                                </div>

                            </div>
                        </div><!-- /.col -->

                        <!-- Estado -->
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label>Estado</label>
                                <div class="form-group clearfix">
                                    <div class="icheck-primary d-inline">
                                        <input class="form-control input-fuec input-estado" type="radio" id="estado1" name="estado" value="Pago">
                                        <label class="font-weight-normal" for="estado1">Pago</label>
                                    </div>
                                    <div class="icheck-primary d-inline">
                                        <input class="form-control input-fuec input-estado" type="radio" id="estado2" name="estado" value="Pendiente">
                                        <label class="font-weight-normal" for="estado2">Pendiente</label>
                                    </div>
                                    <div class="icheck-primary d-inline">
                                        <input class="form-control input-fuec input-estado" type="radio" id="estado3" name="estado" checked value="N/A">
                                        <label class="font-weight-normal" for="estado3">N/A</label>
                                    </div>
                                </div>

                            </div>
                        </div><!-- /.col -->

                        <!-- Valor neto -->
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label>Valor neto</label>
                                <div class="input-group">
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <i class="fas fa-money-check-alt"></i>
                                        </span>
                                    </div>
                                    <input class="form-control input-fuec input-ordenservicio" type="text" id="valorneto" name="valorneto" required readonly>
                                </div>
                            </div>
                        </div><!-- /.col -->

                        <!-- Estado FUEC -->
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label>Estado FUEC</label>
                                <div class="input-group">
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <i class="fas fa-clipboard-check"></i>
                                        </span>
                                    </div>
                                    <select id="estado_fuec" class="form-control" name="estado_fuec" required>
                                        <option>Pendiente aprobar</option>
                                        <option>Aprobado</option>
                                    </select>
                                </div>
                            </div>
                        </div><!-- /.col -->

                        <!-- Adjuntar contrato -->
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label>Adjuntar contrato</label>
                                <div class="input-group">
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <i class="fas fa-file-alt"></i>
                                        </span>
                                    </div>
                                    <input type="file" class="form-control input-fuec" id="contratoadjunto" accept="image/png, image/jpeg, application/pdf">
                                </div>
                                <a id="visualizContrato" href="" target="_blank"></a>
                            </div>
                        </div><!-- /.col -->
                    </div><!-- /.row -->

                </form>
            </div>

            <div class="modal-footer bg-dark">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                <?php if (validarPermiso('M_OPERACIONES', 'U')) : ?>
                    <button type="submit" form="frmFUEC" class="btn btn-success">
                        <i class="fas fa-save"></i>
                        Guardar
                    </button>
                <?php endif ?>
            </div>
        </div>
    </div>
</div>

<!-- MODAL PARA AGREGAR CONDUCTOR -->
<div id="agregar_conductor" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h5 class="modal-title" id="my-modal-title">Agregar conductor <i class="fas fa-user-plus"></i></h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="card">
                <div class="card-body">


                    <!-- FORMULARIO DE CONDUCTORES -->
                    <form class="formulario" id="frmConductores" method="post" enctype="multipart/form-data">
                        <div class="row mt-2 border border-info rounded">
                            <!-- ===================================================
                                                    Conductor
                                                =================================================== -->
                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label for="exampleInput1">Conductor *</label>
                                    <select class="form-control select2-single " name="idconductor" required>
                                        <option value="" selected>-Seleccione un conductor-</option>
                                        <?php foreach ($Conductores as $key => $value) : ?>
                                            <option value="<?= $value['idPersonal'] ?>"><?= $value['Nombre'] ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>

                            <!-- ===================================================
                                                    Observaciones
                                                =================================================== -->
                            <div class="col-12 col-md-8 col-lg-6">
                                <div class="form-group">
                                    <label for="exampleInput1">Observaciones</label>
                                    <textarea class="form-control" name="observacion" rows="1" style="min-height:70px"></textarea>
                                </div>
                            </div>

                            <!-- ===================================================
                                                    BOTON GUARDAR FORMULARIO
                                                =================================================== -->
                            <?php if (validarPermiso('M_VEHICULAR', 'U')) : ?>
                                <div class="col-12 col-md-4 col-lg-2 text-right text-md-left align-self-center">
                                    <button type="submit" class="btn btn-success btn-agregarConductorFuec"><i class="fas fa-check-circle"></i></button>
                                    <div class="overlay d-none" id="overlayBtnGuardardetalles">
                                        <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                                    </div>
                                </div>
                            <?php endif ?>
                        </div>
                    </form>
                    <div class="table-responsive mt-2">
                        <table id="tblConductores" class="table table-sm table-striped table-bordered dt-responsive table-hover tablas w-100">
                            <thead class="thead-light text-sm text-center">
                                <tr>
                                    <th>Conductor</th>
                                    <th>Observaciones</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody id="tbodyConductores" class="text-center">
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td>

                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>


                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger ml-2" data-dismiss="modal">Cerrar</button>

            </div>
        </div>
    </div>
</div>