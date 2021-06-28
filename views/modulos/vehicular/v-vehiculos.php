<?php

/* if(!array_search('CARGAR_OPCION',$_SESSION['opciones'])) {
    echo "<script> window.location = 'inicio'; </script>";
} */

$Vehiculos = ControladorVehiculos::ctrListaVehiculos();
$Propietarios = ControladorPropietarios::ctrMostrar();
$Sucursales = ControladorGH::ctrSucursales();
$tvehiculos = ControladorVehiculos::ctrMostrarTipoVehiculo();
$marca = ControladorVehiculos::ctrMostrarMarca();
$empresaconvenio = ControladorConvenios::ctrMostrar();

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark ">Vehículos</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                        <li class="breadcrumb-item active">Vehículos</li>
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
                    <!--BOTON NUEVO VEHICULO-->
                    <button type="button" class="btn btn-success btn-md btn-agregarVehiculo" data-toggle="modal" data-target="#VehiculosModal">
                        <i class="fas fa-car-side"></i> Añadir Vehículo
                    </button>
                </div><!-- col -->
            </div> <!-- /.row -->

            <!--|||TABLA VEHICULOS|||-->
            <div class="row mt-2">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header bg-info"></div>
                        <div class="card-body">

                            <div class="table-responsive">
                                <table class="table table-sm table-striped table-bordered dt-responsive table-hover tablasBtnExport w-100">
                                    <thead class="thead-light text-sm text-center text-nowrap">
                                        <tr>
                                            <th style="width:10px;">#</th>
                                            <th>Placa</th>
                                            <th>Nro. Interno</th>
                                            <th>Sucursal</th>
                                            <th>Fecha vinculacion</th>
                                            <th>Chasis</th>
                                            <th>Nro. Motor</th>
                                            <th>Modelo</th>
                                            <th>Color</th>
                                            <th>Capacidad</th>
                                            <th>Cilindraje</th>
                                            <th>Tipo vinculacion</th>
                                            <th>Fecha importación</th>
                                            <th>Potencia</th>
                                            <th>Limitacion propiedad</th>
                                            <th>Tipo de vehiculo</th>
                                            <th>Marca</th>
                                            <th>Fecha matricula</th>
                                            <th>Activo</th>
                                            <th>Empresa Convenio</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($Vehiculos as $key => $value) : ?>
                                            <?php
                                            $BotonEditar = "<div class='btn-group'>
                                                            {$value['idvehiculo']}
                                                            <button type='button' class='btn btnEditarVehiculo' idvehiculo='{$value['idvehiculo']}' data-toggle='modal' data-target='#VehiculosModal'>
                                                                <i class='fas fa-edit text-info'></i>
                                                            </button>
                                                        </div>";
                                            ?>
                                            <tr>
                                                <!-- <td><?= $value['idvehiculo'] ?></td> -->
                                                <td><?= $BotonEditar ?></td>
                                                <td><?= $value['placa'] ?></td>
                                                <td><?= $value['numinterno'] ?></td>
                                                <td><?= $value['sucursal'] ?></td>
                                                <td><?= $value['fechavinculacion'] ?></td>
                                                <td><?= $value['chasis'] ?></td>
                                                <td><?= $value['numeromotor'] ?></td>
                                                <td><?= $value['modelo'] ?></td>
                                                <td><?= $value['color'] ?></td>
                                                <td><?= $value['capacidad'] ?></td>
                                                <td><?= $value['cilindraje'] ?></td>
                                                <td><?= $value['tipovinculacion'] ?></td>
                                                <td><?= $value['fechaimportacion'] ?></td>
                                                <td><?= $value['potenciahp'] ?></td>
                                                <td><?= $value['limitacion'] ?></td>
                                                <td><?= $value['tipovehiculo'] ?></td>
                                                <td><?= $value['marca'] ?></td>
                                                <td><?= $value['fechamatricula'] ?></td>
                                                <td><?= $value['activo'] ?></td>
                                                <td><?= $value['convenio'] ?></td>
                                                <!-- <td>
                                                    <div class="btn-group" role="group" aria-label="Button group">
                                                        <button class="btn btn-sm btn-warning btnEditarVehiculo" data-toggle="modal" data-target="#VehiculosModal"><i class="fas fa-edit"></i></button>
                                                    </div>
                                                </td> -->
                                            </tr>
                                        <?php endforeach ?>
                                    </tbody>

                                </table>

                            </div>
                        </div>
                        <div class="card-footer bg-dark"></div>
                    </div>
                </div><!-- col -->
            </div> <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div><!-- /.content -->
</div><!-- /.content-wrapper -->

<!--MODALS-->

<div class="modal fade" id="VehiculosModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">

            <div class="modal-header bg-info">
                <h5 class="modal-title font-weight-bold" id="titulo-modal-vehiculo">Agregar vehículo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">

                <!-- ===================================================
                        INFORMACION GENERAL
                    =================================================== -->
                <form id="vehiculos_form" method="post" enctype="multipart/form-data">
                    <div class="card card-secondary card-tabs">
                        <div class="card-header p-0 pt-1">
                            <ul class="nav nav-tabs" id="custom-tabs-two-tab" role="tablist">

                                <li class="pt-2 px-3">
                                    <h3 class="card-title">Información general</h3>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link active" id="datos_vehiculos" data-toggle="pill" href="#custom-tabs-two-home" role="tab" aria-controls="custom-tabs-two-home" aria-selected="true"><u>Datos vehículos</u></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="custom-tabs-two-profile-tab" data-toggle="pill" href="#custom-tabs-two-profile" role="tab" aria-controls="custom-tabs-two-profile" aria-selected="false"><u>Información técnica</u></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="custom-tabs-two-messages-tab" data-toggle="pill" href="#custom-tabs-two-messages" role="tab" aria-controls="custom-tabs-two-messages" aria-selected="false"><u>Características</u></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="custom-tabs-two-settings-tab" data-toggle="pill" href="#custom-tabs-two-settings" role="tab" aria-controls="custom-tabs-two-settings" aria-selected="false"><u>Imágenes</u></a>
                                </li>
                                <li class="d-flex align-items-center ml-2"><button type="submit" class="btn btn-sm btn-success align-bottom">
                                        <i class="fas fa-save"></i>
                                        Guardar
                                    </button></li>
                            </ul>
                        </div>

                        <div class="card-body">
                            <div class="tab-content" id="custom-tabs-two-tabContent">
                                <!-- ===================================================
                                    DATOS VEHÍCULOS
                                =================================================== -->
                                <div class="tab-pane fade show active" id="custom-tabs-two-home" role="tabpanel" aria-labelledby="custom-tabs-two-home-tab">

                                    <div class="row">
                                        <div class="col-md-6">
                                            <input type="hidden" id="idvehiculo" name="idvehiculo" value="">

                                            <div class="form-group">
                                                <label>Placa *</label>
                                                <div class="input-group">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">
                                                            <i class="fas fa-ad"></i>
                                                        </span>
                                                    </div>
                                                    <input class="form-control input-datosvehiculo" type="text" id="placa" name="placa" placeholder="Ingresar placa" autofocus required maxlength="7">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label>Tipo de vinculación</label>
                                                <div class="input-group">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">
                                                            <i class="fas fa-clipboard-list"></i>
                                                        </span>
                                                    </div>
                                                    <select class="form-control input-lg input-datosvehiculo" type="text" id="tipovinculacion" name="tipovinculacion">
                                                        <option value="" selected>-Seleccione una vinculación-</option>
                                                        <option>Propio</option>
                                                        <option>Propio afiliado</option>
                                                        <option>Convenio</option>
                                                        <option>Propio tercero</option>
                                                        <option>Administrado</option>
                                                        <option>Afiliado</option>
                                                        <option>Propio vendido</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label>Sucursal</label>
                                                <div class="input-group">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">
                                                            <i class="fas fa-map-marker-alt"></i>
                                                        </span>
                                                    </div>
                                                    <select class="form-control input-lg input-datosvehiculo" type="text" id="idsucursal" name="idsucursal">
                                                        <option value="" selected>-Seleccione una sucursal-</option>
                                                        <?php foreach ($Sucursales as $key => $value) : ?>
                                                            <option value="<?= $value['ids'] ?>"><?= $value['sucursal'] ?></option>
                                                        <?php endforeach ?>
                                                    </select>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Nro. Interno afiliado</label>
                                                <div class="input-group">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">
                                                            <i class="fas fa-hashtag"></i>
                                                        </span>
                                                    </div>
                                                    <input class="form-control input-datosvehiculo" type="text" id="numinterno" name="numinterno" placeholder="Ingresar número interno afiliado" maxlength="6">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label>Fecha de vinculación *</label>
                                                <div class="input-group">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">
                                                            <i class="far fa-calendar-alt"></i>
                                                        </span>
                                                    </div>
                                                    <input class="form-control input-datosvehiculo" type="date" id="fechavinculacion" name="fechavinculacion" placeholder="Seleccione una fecha" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- ===================================================
                                    INFORMACIÓN TÉCNICA
                                =================================================== -->
                                <div class="tab-pane fade" id="custom-tabs-two-profile" role="tabpanel" aria-labelledby="custom-tabs-two-profile-tab">

                                    <div class="row">
                                        <div class="col-md-6">

                                            <div class="form-group">
                                                <label>Número del motor</label>
                                                <div class="input-group">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">
                                                            <i class="fas fa-hashtag"></i>
                                                        </span>
                                                    </div>
                                                    <input class="form-control input-propietario" type="text" id="numeromotor" name="numeromotor" placeholder="Ingresar número del motor" maxlength="21">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label>Chasis</label>
                                                <div class="input-group">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">
                                                            <i class="fas fa-car-alt"></i>
                                                        </span>
                                                    </div>
                                                    <input class="form-control input-propietario" type="text" id="chasis" name="chasis" placeholder="Ingresar chasis" maxlength="19">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label>Modelo del vehículo</label>
                                                <div class="input-group">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">
                                                            <i class="fas fa-car-alt"></i>
                                                        </span>
                                                    </div>
                                                    <input class="form-control input-propietario" type="text" id="modelo" name="modelo" placeholder="Ingresar modelo del vehículo">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label>Color</label>
                                                <div class="input-group">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">
                                                            <i class="fas fa-palette"></i>
                                                        </span>
                                                    </div>
                                                    <input class="form-control input-propietario" type="text" id="color" name="color" placeholder="Ingresar color del vehículo" maxlength="28">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label>Capacidad</label>
                                                <div class="input-group">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">
                                                            <i class="fas fa-weight"></i>
                                                        </span>
                                                    </div>
                                                    <input class="form-control input-propietario" type="text" id="capacidad" name="capacidad" placeholder="Ingresar capacidad del vehículo" maxlength="6">
                                                </div>
                                            </div>

                                        </div>

                                        <div class="col-md-6">

                                            <div class="form-group">
                                                <label>Cilindraje</label>
                                                <div class="input-group">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">
                                                            <i class="fas fa-tachometer-alt"></i>
                                                        </span>
                                                    </div>
                                                    <input class="form-control input-propietario" type="text" id="cilindraje" name="cilindraje" placeholder="Ingresar cilindraje del vehículo" maxlength="9">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label>Tipo de vehículo</label>
                                                <div class="input-group">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">
                                                            <i class="fas fa-car-alt"></i>
                                                        </span>
                                                    </div>
                                                    <select class="form-control input-lg input-propietario" type="text" id="idtipovehiculo" name="idtipovehiculo">
                                                        <option value="" selected>-Seleccione un tipo-</option>
                                                        <?php foreach ($tvehiculos as $key => $value) : ?>
                                                            <option value="<?= $value['idtipovehiculo'] ?>"><?= $value['tipovehiculo'] ?></option>
                                                        <?php endforeach ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label>Marca</label>
                                                <div class="input-group">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">
                                                            <i class="fas fa-car-alt"></i>
                                                        </span>
                                                    </div>
                                                    <select class="form-control input-lg input-propietario" type="text" id="idmarca" name="idmarca">
                                                        <option value="" selected>-Seleccione una marca-</option>
                                                        <?php foreach ($marca as $key => $value) : ?>
                                                            <option value="<?= $value['idmarca'] ?>"><?= $value['marca'] ?></option>
                                                        <?php endforeach ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label>Carrocería</label>
                                                <div class="input-group">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">
                                                            <i class="fas fa-car-alt"></i>
                                                        </span>
                                                    </div>
                                                    <input class="form-control input-propietario" type="text" id="tipocarroceria" name="tipocarroceria" placeholder="Ingresar el tipo de carrecoria">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label>Potencia (hp)</label>
                                                <div class="input-group">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">
                                                            <i class="fas fa-tachometer-alt"></i>
                                                        </span>
                                                    </div>
                                                    <input class="form-control input-propietario" type="text" id="potenciahp" name="potenciahp" placeholder="Ingresar potencia  ">
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <!-- ===================================================
                                    CARACTERÍSTICAS
                                =================================================== -->
                                <div class="tab-pane fade" id="custom-tabs-two-messages" role="tabpanel" aria-labelledby="custom-tabs-two-messages-tab">


                                    <div class="row">
                                        <div class="col-md-6">

                                            <div class="form-group">
                                                <label>Fecha de importación</label>
                                                <div class="input-group">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">
                                                            <i class="far fa-calendar-alt"></i>
                                                        </span>
                                                    </div>
                                                    <input class="form-control input-propietario" type="date" id="fechaimportacion" name="fechaimportacion" placeholder="Ingresar fecha de importación">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label>Limitación</label>
                                                <div class="input-group">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">
                                                            <i class="fas fa-file-alt"></i>
                                                        </span>
                                                    </div>
                                                    <input class="form-control input-propietario" type="text" id="limitacion" name="limitacion" placeholder="Ingresar limitación">

                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label>Estado</label>
                                                <div class="input-group">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">
                                                            <i class="fas fa-check-circle"></i>
                                                        </span>
                                                    </div>
                                                    <select class="form-control input-lg input-propietario" type="text" id="activo" name="activo">
                                                        <option value="" selected>-Seleccione un estado-</option>
                                                        <option>Activo</option>
                                                        <option>Inactivo</option>
                                                        <option>Desvinculado</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label>Empresa convenio</label>
                                                <div class="input-group">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">
                                                            <i class="fas fa-building"></i>
                                                        </span>
                                                    </div>
                                                    <select class="form-control input-lg input-propietario" type="text" id="idconvenio" name="idconvenio">
                                                        <option value="" selected>-Seleccione una empresa-</option>
                                                        <?php foreach ($empresaconvenio as $key => $value) : ?>
                                                            <option value="<?= $value['idxc'] ?>"><?= $value['nombre'] ?></option>
                                                        <?php endforeach ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label>Declaración imp.</label>
                                                <div class="input-group">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">
                                                            <i class="fas fa-file-alt"></i>
                                                        </span>
                                                    </div>
                                                    <input class="form-control input-propietario" type="text" id="declaracionimpor" name="declaracionimpor" placeholder="Ingresar declaracion">

                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label>Fecha matrícula</label>
                                                <div class="input-group">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">
                                                            <i class="far fa-calendar-alt"></i>
                                                        </span>
                                                    </div>
                                                    <input class="form-control input-propietario" type="date" id="fechamatricula" name="fechamatricula" placeholder="Ingresar fecha de matrícula">

                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">

                                            <div class="form-group">
                                                <label>Fecha de expedición</label>
                                                <div class="input-group">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">
                                                            <i class="far fa-calendar-alt"></i>
                                                        </span>
                                                    </div>
                                                    <input class="form-control input-propietario" type="date" id="fechaexpedicion" name="fechaexpedicion" placeholder="Ingresar fecha de expedición">

                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label>Transito</label>
                                                <div class="input-group">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">
                                                            <i class="fas fa-file-alt"></i>
                                                        </span>
                                                    </div>
                                                    <input class="form-control input-propietario" type="text" id="transito" name="transito" placeholder="Ingresar transito">

                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label>Fecha convenio</label>
                                                <div class="input-group">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">
                                                            <i class="far fa-calendar-alt"></i>
                                                        </span>
                                                    </div>
                                                    <input class="form-control input-propietario" type="date" id="fechafinconvenio" name="fechafinconvenio" placeholder="Ingresar fecha de convenio">

                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label>Clave APP</label>
                                                <div class="input-group">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">
                                                            <i class="fas fa-key"></i>
                                                        </span>
                                                    </div>
                                                    <input class="form-control input-propietario" type="text" id="claveapp" name="claveapp" placeholder="Ingresar clave" maxlength="20">

                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label>Fecha de desvinculación</label>
                                                <div class="input-group">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">
                                                            <i class="far fa-calendar-alt"></i>
                                                        </span>
                                                    </div>
                                                    <input class="form-control input-propietario" type="date" id="fechadesvinculacion" name="fechadesvinculacion" placeholder="Ingresar fecha de desvinculación">

                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label>Observaciones</label>
                                                <div class="input-group">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">
                                                            <i class="fas fa-comment"></i>
                                                        </span>
                                                    </div>
                                                    <textarea class="form-control input-propietario" type="text" id="observaciones" name="observaciones" placeholder="Escriba una observación" style="min-height:70px"></textarea>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <!-- ===================================================
                                    IMÁGENES
                                =================================================== -->
                                <div class="tab-pane fade" id="custom-tabs-two-settings" role="tabpanel" aria-labelledby="custom-tabs-two-settings-tab">

                                    <div class="row">

                                        <!-- FOTOS DEL VEHICULO -->
                                        <div class="col-md-6">
                                            <div class="row d-flex justify-content-center">
                                                <div class="col-12 col-md-8">
                                                    <div class="form-group">
                                                        <label>Fotos del vehículo</label>
                                                        <div class="input-group">
                                                            <div class="input-group-append">
                                                                <span class="input-group-text">
                                                                    <i class="fas fa-camera-retro"></i>
                                                                </span>
                                                            </div>
                                                            <input type="file" class="form-control" name="foto_vehiculo" id="foto_vehiculo" accept="image/png, image/jpeg">

                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- <div class="" id="colPrevisualizacion_fotos"> -->
                                                <div id="colPrevisualizacion_fotos" class="col-12 col-md-10 col-lg-8 carousel slide" data-ride="carousel">
                                                    <ol class="carousel-indicators">
                                                        <!-- SE LLENA DESDE JAVASCRIPT -->
                                                    </ol>
                                                    <div class="carousel-inner text-center">
                                                        <!-- SE LLENA DESDE JAVASCRIPT -->
                                                    </div>
                                                    <a class="carousel-control-prev" href="#colPrevisualizacion_fotos" role="button" data-slide="prev">
                                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                        <span class="sr-only">Previous</span>
                                                    </a>
                                                    <a class="carousel-control-next" href="#colPrevisualizacion_fotos" role="button" data-slide="next">
                                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                        <span class="sr-only">Next</span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- TARJETA DE PROPIEDAD -->
                                        <div class="col-md-6">
                                            <div class="row d-flex justify-content-center">
                                                <div class="col-12 col-md-8">
                                                    <div class="form-group">
                                                        <label>Tarjeta de propiedad (1 foto a la vez)</label>
                                                        <div class="input-group">
                                                            <div class="input-group-append">
                                                                <span class="input-group-text">
                                                                    <i class="fas fa-camera-retro"></i>
                                                                </span>
                                                            </div>
                                                            <input type="file" class="form-control" name="foto_tarjetapropiedad" id="foto_tarjetapropiedad" accept="image/png, image/jpeg">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12 text-center">
                                                    <a id="imagenPrevisualizacion_TarjetaPro" href="" target="_blank"><img class="img-fluid" src=""></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

                <!-- ===================================================
                            DETALLES
                        =================================================== -->
                <div class="card card-secondary card-tabs">
                    <div class="card-header p-0 pt-1">
                        <ul class="nav nav-tabs" id="custom-tabs-two-tab" role="tablist">

                            <li class="pt-2 px-3">
                                <h3 class="card-title">Detalles</h3>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link active" id="pills-Propietarios-tab" data-toggle="pill" href="#pills-Propietarios" role="tab" aria-controls="pills-Propietarios" aria-selected="true"><u>Propietarios</u></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="pills-Conductores-tab" data-toggle="pill" href="#pills-Conductores" role="tab" aria-controls="pills-Conductores" aria-selected="false"><u>Conductores</u></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="pills-Documentos-tab" data-toggle="pill" href="#pills-Documentos" role="tab" aria-controls="pills-Documentos" aria-selected="false"><u>Documentos</u></a>
                            </li>

                        </ul>
                    </div>

                    <div class="card-body">
                        <div class="tab-content" id="custom-tabs-two-tabContent">

                            <!-- TAB PROPIETARIOS -->
                            <div class="tab-pane fade show active" id="pills-Propietarios" role="tabpanel" aria-labelledby="pills-Propietarios-tab">
                                <div class="card">
                                    <div class="card-body">
                                        <label>PROPIETARIOS</label>

                                        <!-- FORMULARIO DE PROPIETARIOS -->
                                        <form class="formulario" id="frmPropietarios" method="post" enctype="multipart/form-data">
                                            <div class="row mt-2 border border-info rounded">
                                                <!-- ===================================================
                                                    **********
                                                =================================================== -->
                                                <div class="col-12 col-md-6 col-lg-4">
                                                    <div class="form-group">
                                                        <label for="exampleInput1"> *</label>
                                                        <input class="form-control" type="text">
                                                        <!-- <select id="my-select" class="form-control" name="contrato">
                                                            <option>Contrato inicial</option>
                                                            <option>Prorroga 1</option>
                                                            <option>Prorroga 2</option>
                                                            <option>Prorroga 3</option>
                                                            <option>Prorroga 4</option>
                                                        </select> -->
                                                    </div>
                                                </div>

                                                <!-- ===================================================
                                                    BOTON GUARDAR FORMULARIO
                                                =================================================== -->
                                                <div class="col-12 col-md-6 col-lg-4 text-right text-md-left align-self-center">
                                                    <button type="submit" class="btn btn-success">
                                                        <i class="fas fa-check-circle"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </form>

                                        <!-- TABLA PROPIETARIOS -->
                                        <div class="table-responsive mt-2">
                                            <table class="table table-sm table-striped table-bordered dt-responsive table-hover tablas w-100">
                                                <thead class="thead-light text-sm text-center">
                                                    <tr>
                                                        <th style="width:10px;">#</th>
                                                        <th>Nombre</th>
                                                        <th>Tipo</th>
                                                        <th>Documento</th>
                                                        <th>EMAIL</th>
                                                        <th>Telefono</th>
                                                        <th>Direccion</th>
                                                        <th>Ciudad</th>
                                                        <th>Acciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td>
                                                            <div class="btn-group" role="group" aria-label="Button group">
                                                                <button class="btn btn-sm btn-warning btnEditarVehiculo" data-toggle="modal" data-target="#VehiculosModal"><i class="fas fa-edit"></i></button>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- TAB CONDUCTORES -->
                            <div class="tab-pane fade" id="pills-Conductores" role="tabpanel" aria-labelledby="pills-Conductores-tab">
                                <div class="card">
                                    <div class="card-body">
                                        <label>CONDUCTORES</label>
                                        <div class="table-responsive">
                                            <table class="table table-sm table-striped table-bordered dt-responsive table-hover tablas w-100">
                                                <thead class="thead-light text-sm text-center">
                                                    <tr>
                                                        <th style="width:10px;">#</th>
                                                        <th>Nombre</th>
                                                        <th>Tipo</th>
                                                        <th>Documento</th>
                                                        <th>EMAIL</th>
                                                        <th>Telefono</th>
                                                        <th>Direccion</th>
                                                        <th>Ciudad</th>
                                                        <th>Acciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td>
                                                            <div class="btn-group" role="group" aria-label="Button group">
                                                                <button class="btn btn-sm btn-warning btnEditarVehiculo" data-toggle="modal" data-target="#VehiculosModal"><i class="fas fa-edit"></i></button>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- TAB DOCUMENTOS -->
                            <div class="tab-pane fade" id="pills-Documentos" role="tabpanel" aria-labelledby="pills-Documentos-tab">
                                <div class="card">
                                    <div class="card-body">
                                        <label>DOCUMENTOS</label>


                                        <div class="table-responsive">
                                            <table class="table table-sm table-striped table-bordered dt-responsive table-hover tablas w-100">
                                                <thead class="thead-light text-sm text-center">
                                                    <tr>
                                                        <th style="width:10px;">#</th>
                                                        <th>Nombre</th>
                                                        <th>Tipo</th>
                                                        <th>Documento</th>
                                                        <th>EMAIL</th>
                                                        <th>Telefono</th>
                                                        <th>Direccion</th>
                                                        <th>Ciudad</th>
                                                        <th>Acciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td>
                                                            <div class="btn-group" role="group" aria-label="Button group">
                                                                <button class="btn btn-sm btn-warning btnEditarVehiculo" data-toggle="modal" data-target="#VehiculosModal"><i class="fas fa-edit"></i></button>
                                                            </div>
                                                        </td>
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
            </div>

            <div class="modal-footer bg-dark">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-success" form="vehiculos_form">
                    <i class="fas fa-save"></i>
                    Guardar
                </button>
            </div>


        </div>
    </div>
</div>