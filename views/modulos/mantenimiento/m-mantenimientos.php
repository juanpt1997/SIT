<?php

// if (!validarPermiso('CARGAR_OPCION', 'R')) {
//     echo "<script> window.location = 'inicio'; </script>";
// }

$Placas = ControladorVehiculos::ctrListaVehiculos();
$Servicios = ControladorVehiculos::ctrListadoServicios();
$Productos = ControladorMantenimientos::ctrListadoProductos();
$ServExt = ControladorMantenimientos::ctrListadoServiciosExternos();
$tiposDocumentacion = ControladorVehiculos::ctrTiposDocumentacion();
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
                    <ul class="nav nav-tabs mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item border border-info rounded ml-2 mb-1 mb-md-0">
                            <a class="nav-link active h4" id="pills-ordenserv-tab" data-toggle="tab" href="#pills-ordenserv" role="tab" aria-controls="pills-ordenserv" aria-selected="active">Orden de servicio <i class="fas fa-building"></i></a>
                        </li>
                        <li class="nav-item border border-info rounded ml-2 mb-1 mb-md-0">
                            <a class="nav-link h4" id="pills-programacion-tab" data-toggle="tab" href="#pills-programacion" role="tab" aria-controls="pills-programacion" aria-selected="false">Programación <i class="fas fa-file-contract"></i></a>
                        </li>
                    </ul>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                        <li class="breadcrumb-item active">Mantenimientos</li>
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
            <div class="tab-content" id="pills-tabcontent">
                <div class="tab-pane fade show active" id="pills-ordenserv" role="tabpanel" aria-labelledby="pills-ordenserv-tab">
                    <div class="row">
                        <div class="col-12 col-sm-6 col-lg-12">
                            <div class="card card-info card-tabs">
                                <div class="card-header p-0 pt-1">
                                    <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                                        <!-- <li class="nav-item">
                                    <a class="nav-link active" id="custom-tabs-one-solicitudserv_exter_repues-tab" data-toggle="pill" href="#custom-tabs-one-solicitudserv_exter_repues" role="tab" aria-controls="custom-tabs-one-solicitudserv_exter_repues" aria-selected="false">Solicitud de servicio / Repuestos</a>
                                </li> -->
                                        <li class="nav-item ">
                                            <!-- TABS HORIZONTALES-->
                                            <a class="nav-link active" id="custom-tabs-one-ordenserv_mante-tab" data-toggle="pill" href="#custom-tabs-one-ordenserv_mante" role="tab" aria-controls="custom-tabs-one-ordenserv_mante" aria-selected="true">Orden de servicio / Mantenimiento</a>
                                        </li>
                                        
                                    </ul>
                                </div>

                                <div class="card-body">
                                    <div class="tab-content" id="custom-tabs-one-tabContent">
                                        <!-- ==============================================
                                    TAB ORDEN SERVICIO 
                                ==================================================-->
                                        <div class="tab-pane fade active show" id="custom-tabs-one-ordenserv_mante" role="tabpanel" aria-labelledby="custom-tabs-one-ordenserv_mante-tab">
                                            <div class="row">
                                                <div class="col-lg-3 col-sm-6">
                                                    <!-- ================================================
                                                    NAVBAR VERTICAL
                                                =============================================== -->


                                                    <nav class="navbar navbar-expand-lg">
                                                        <button class="navbar-toggler navbar-light bg-light" type="button" data-toggle="collapse" data-target="#ContenidoOrdenServicio" aria-controls="ContenidoOrdenServicio" aria-expanded="false" aria-label="Toggle navigation">
                                                            <span class="navbar-toggler-icon "></span>
                                                        </button>

                                                        <div class="collapse navbar-collapse" id="ContenidoOrdenServicio">
                                                            <div class=" nav nav-tabs navbar-expand-lg flex-column nav-pills " id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                                                <a class="nav-link active border-bottom rounded" id="v-pills-general-tab" data-toggle="pill" href="#v-pills-general" role="tab" aria-controls="v-pills-general" aria-selected="true"><b><i class="fas fa-info-circle"></i> Datos generales</b></a>
                                                                <a class="nav-link border-bottom rounded" id="v-pills-diagnostico-tab" data-toggle="pill" href="#v-pills-diagnostico" role="tab" aria-controls="v-pills-diagnostico" aria-selected="false"><b><i class="far fa-file-alt"></i> Diagnóstico</b></a>
                                                                <a class="nav-link border-bottom rounded" id="v-pills-repuestos-tab" data-toggle="pill" href="#v-pills-repuestos" role="tab" aria-controls="v-pills-repuestos" aria-selected="false"><b><i class="fas fa-screwdriver"></i> Repuestos / Solicitud de servicio</b></a>
                                                                <a class="nav-link border-bottom rounded" id="v-pills-manoObra-tab" data-toggle="pill" href="#v-pills-manoObra" role="tab" aria-controls="v-pills-manoObra" aria-selected="false"><b><i class="fas fa-fist-raised"></i> Mano de obra</b></a>
                                                                <a class="nav-link border-bottom rounded" id="v-pills-observaciones-tab" data-toggle="pill" href="#v-pills-observaciones" role="tab" aria-controls="v-pills-observaciones" aria-selected="false"><b><i class="far fa-comment-alt"></i> Observaciones</b></a>
                                                                <!-- <a class="nav-link" id="v-pills-firmas-tab" data-toggle="pill" href="#v-pills-firmas" role="tab" aria-controls="v-pills-firmas" aria-selected="false"><b>Nombres y firmas</b></a> -->
                                                            </div>
                                                        </div>
                                                    </nav>



                                                </div>
                                                <div class="col-lg-9 col-sm-12">
                                                    <!-- ==============================================================================================
                                                *********************************** ORDEN DE SERVICIO MANTENIMIENTO ***************************
                                            ==================================================================================================== -->
                                                    <div class="tab-content" id="v-pills-tabContent">
                                                        <!-- DATOS GENERALES -->
                                                        <div class="tab-pane fade show active " id="v-pills-general" role="tabpanel" aria-labelledby="v-pills-general-tab">
                                                            <div class="row">
                                                                <div class="col-12 col-sm-6 col-lg-4">
                                                                    <div class="form-group text-center">
                                                                        <label><i>Placa</i></label>
                                                                        <select id="placa_OrdServ" name="idvehiculo_OrdServ" class="form-control select2-single" type="number" style="width: 99%" required>
                                                                            <option selected value="">Seleccione un vehículo</option>
                                                                            <?php foreach ($Placas as $key => $value) : ?>
                                                                                <option value="<?= $value['idvehiculo'] ?>"><?= $value['placa'] ?> - <?= $value['numinterno'] ?> </option>
                                                                            <?php endforeach ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12 col-sm-6 col-lg-4">
                                                                    <div class="form-group text-center">
                                                                        <label><i>Número interno</i></label>
                                                                        <input type="text" class="form-control" id="numinterno_man" name="numinterno_man" required readonly>
                                                                    </div>
                                                                </div>

                                                                <div class="col-12 col-sm-6 col-lg-4">
                                                                    <div class="form-group text-center">
                                                                        <label><i>Marca</i></label>
                                                                        <input type="text" class="form-control" id="marca_man" name="marca_man" required readonly>
                                                                    </div>
                                                                </div>

                                                                <div class="col-12 col-sm-6 col-lg-4">
                                                                    <div class="form-group text-center">
                                                                        <label><i>Clase de vehículo</i></label>
                                                                        <input type="text" class="form-control" id="clasevehiculo_man" name="clasevehiculo_man" required readonly>
                                                                    </div>
                                                                </div>

                                                                <div class="col-12 col-sm-6 col-lg-4">
                                                                    <div class="form-group text-center">
                                                                        <label><i>Fecha</i></label>
                                                                        <input type="date" class="form-control" id="fecha_man" name="fecha_man" required readonly>
                                                                    </div>
                                                                </div>


                                                                <div class="col-12 col-sm-6 col-lg-4">
                                                                    <div class="form-group text-center">
                                                                        <label><i>Modelo</i></label>
                                                                        <input type="text" class="form-control" id="modelo_man" name="modelo_man" required readonly>
                                                                    </div>
                                                                </div>

                                                                <div class="col-12 col-sm-6 col-lg-4">
                                                                    <div class="form-group text-center">
                                                                        <label><i>Kilometraje</i></label>
                                                                        <input type="text" class="form-control" id="kilome_man" name="kilome_man" required readonly>
                                                                    </div>
                                                                </div>

                                                                <div class="col-12 col-sm-6 col-lg-4">
                                                                    <div class="form-group text-center">
                                                                        <label><i># Orden de servicio</i></label>
                                                                        <input type="text" class="form-control" id="kilome_man" name="kilome_man" required>
                                                                    </div>
                                                                </div>

                                                                <div class="col-12 col-sm-6 col-lg-4">
                                                                    <div class="form-group text-center">
                                                                        <label><i>Fecha de entrada</i></label>
                                                                        <input type="date" class="form-control" id="fechaentra_man" name="fechaentra_man" required>
                                                                    </div>
                                                                </div>



                                                                <div class="col-12 col-sm-6 col-lg-4">
                                                                    <div class="form-group text-center">
                                                                        <label><i>Hora de entrada</i></label>
                                                                        <input type="time" class="form-control" id="horaentra_man" name="horaentra_man" required>
                                                                    </div>
                                                                </div>

                                                                <div class="col-12 col-sm-6 col-lg-4">
                                                                    <div class="form-group text-center">
                                                                        <label><i>Sistema</i></label>
                                                                        <select name="sistema" id="sistema" class="form-control select2-single" type="number" style="width: 99%" required>
                                                                            <option selected value="">Seleccione el sistema</option>
                                                                            <option>Sistema eléctrico</option>
                                                                            <option>Sistema hidráulico</option>
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <div class="col-12 col-sm-6 col-lg-4">
                                                                    <div class="form-group text-center">
                                                                        <label><i>Tipo de mantenimiento</i></label>
                                                                        <select id="tipo_mantenimiento" name="tipo_mantenimiento" class="form-control select2-single" type="number" style="width: 99%" required>
                                                                            <option selected value="">Seleccione un tipo de mantenimiento</option>
                                                                            <option value="">Preventivo</option>
                                                                            <option value="">Correctivo</option>
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                            </div>

                                                            <div class="card card-info collapsed-card" id="card-documentosVehiculo" data-toggle="tooltip" data-placement="top" data-card-widget="collapse">
                                                                <div class="card-header">
                                                                    <h3 class="card-title"><b><i>Documentos del vehículo</i></b>
                                                                        <i class="fas fa-folder-open"></i>
                                                                    </h3>
                                                                    <div class="card-tools">
                                                                        <button type="button" title="Abrir documentos del vehículo" class="btn btn-tool">
                                                                            <i class="fas fa-plus"></i>
                                                                        </button>
                                                                    </div>
                                                                </div>

                                                                <div class="card-body" style="display: none;">
                                                                    <div class="row">
                                                                        <div class="col-lg-12 col-sm-12 justify-content-center">
                                                                            <div class="row">
                                                                                <?php foreach ($tiposDocumentacion as $key => $value) : ?>
                                                                                    <div class="col-12 col-sm-6 col-lg-4">
                                                                                        <div class="form-group">
                                                                                            <label><?= $value['tipodocumento'] ?></label>
                                                                                            <input id="documento_<?= $value['idtipo'] ?>" type="date" class="form-control documentos" readonly>
                                                                                        </div>
                                                                                    </div>
                                                                                <?php endforeach ?>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!--CARD BODY-->
                                                            </div>

                                                            <div class="card card-info collapsed-card" id="card-programacion" data-toggle="tooltip" data-placement="top" data-card-widget="collapse">
                                                                <div class="card-header">
                                                                    <h3 class="card-title"><b><i>Programación del vehículo</i></b>
                                                                        <i class="far fa-calendar-alt"></i>
                                                                    </h3>
                                                                    <div class="card-tools">
                                                                        <button type="button" title="Abrir programación del vehículo" class="btn btn-tool">
                                                                            <i class="fas fa-plus"></i>
                                                                        </button>
                                                                    </div>
                                                                </div>

                                                                <div class="card-body" style="display: none;">
                                                                    <div class="col-12">
                                                                        <div class="card card-outline card-success">


                                                                            <div class="table-responsive">
                                                                                <table id="tablaProgramacionServ" class="table table-sm table-striped table-bordered dt-responsive text-center table-hover  w-100">
                                                                                    <thead class="text-nowrap">
                                                                                        <th>...</th>
                                                                                        <th>Placa</th>
                                                                                        <th>Servicio</th>
                                                                                        <th>Kilometraje actual</th>
                                                                                        <th>Kilometraje para cambio</th>
                                                                                        <th>Fecha para cambio</th>
                                                                                    </thead>
                                                                                    <tbody id="tbodyProgramacionServ" class="text-nowrap">


                                                                                    </tbody>
                                                                                </table>
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!--CARD BODY-->
                                                            </div>


                                                        </div>
                                                        <!-- DIAGNÓSTICO -->
                                                        <div class="tab-pane fade" id="v-pills-diagnostico" role="tabpanel" aria-labelledby="v-pills-diagnostico-tab">
                                                            <div class="callout callout-info col-md-12 col-sm-8">
                                                                <div class="row">
                                                                    <div class="col-sm-9 text-center">
                                                                        <div class="form-group">
                                                                            <label>Descripción</label>
                                                                            <textarea class="form-control" rows="5" placeholder="Digite una leve descripción ..."></textarea>
                                                                        </div>
                                                                    </div>


                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- REPUESTOS / SOLICITUD SERVICIO -->
                                                        <div class="tab-pane fade" id="v-pills-repuestos" role="tabpanel" aria-labelledby="v-pills-repuestos-tab">

                                                            <!-- SERVICIOS EXTERNOS COLLAPSE -->
                                                            <div class="card card-info collapsed-card" id="card-serviciosext" data-toggle="tooltip" data-placement="top" data-card-widget="collapse">
                                                                <div class="card-header">
                                                                    <h3 class="card-title"><b><i>Servicios externos</i></b>
                                                                        <i class="fas fa-boxes"></i>
                                                                    </h3>
                                                                    <div class="card-tools">
                                                                        <button type="button" title="Abrir servicios externos" class="btn btn-tool">
                                                                            <i class="fas fa-plus"></i>
                                                                        </button>
                                                                    </div>
                                                                </div>

                                                                <div class="card-body" style="display: none;">
                                                                    <div class="row">
                                                                        <div class="col-lg-12 col-sm-12 justify-content-center">
                                                                            <div class="row">
                                                                                <?php foreach ($ServExt as $key => $value) : ?>
                                                                                    <div class="col-12 col-sm-6 col-lg-4">
                                                                                        <div class="custom-control custom-checkbox">
                                                                                            <input class="custom-control-input" type="checkbox" id="servicioexter_<?= $value['idservicio_externo'] ?>" name="servicioexterno_<?= $value['idservicio_externo'] ?>">
                                                                                            <label for="servicioexter_<?= $value['idservicio_externo'] ?>" class="custom-control-label"><?= $value['nombre'] ?></label>
                                                                                        </div>
                                                                                    </div>
                                                                                <?php endforeach ?>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!--CARD BODY-->
                                                            </div>

                                                            <!-- REPUESTO COLLAPSE -->
                                                            <div class="card card-info collapsed-card" id="card-repuesto" data-toggle="tooltip" data-placement="top" data-card-widget="collapse">
                                                                <div class="card-header">
                                                                    <h3 class="card-title"><b><i>Repuesto</i></b>
                                                                        <i class="fas fa-tools nav-icon"></i>
                                                                    </h3>
                                                                    <div class="card-tools">
                                                                        <button type="button" title="Abrir repuesto" class="btn btn-tool">
                                                                            <i class="fas fa-plus"></i>
                                                                        </button>
                                                                    </div>
                                                                </div>

                                                                <div class="card-body" style="display: none;">
                                                                    <div class="row d-flex justify-content-center">
                                                                        <div class="table-responsive">
                                                                            <table class="table table table-responsive table-bordered table-striped text-center">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th style="width: 500px">REPUESTO</th>
                                                                                        <th>REFERENCIA</th>
                                                                                        <th>CÓDIGO</th>
                                                                                        <th>CANTIDAD</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody id="filas_tabla_repuestoSolicitud">
                                                                                    <tr id="contenido_filas_repuestoSolicitud">
                                                                                        <td style="width: 300px">

                                                                                            <div class="input-group">
                                                                                                <input class="form-control" type="text" id="repuesto_1" name="repuesto[]" placeholder="Seleccione un repuesto" readonly>
                                                                                                <div class="input-group-append">
                                                                                                    <button type="button" class="btn btn-success btn-md btn-repuestos" consecutivo="1" title="lista repuestos" data-toggle="modal" data-target="#modal-repuestos"><i class="fas fa-business-time"></i></button>
                                                                                                </div>
                                                                                            </div>

                                                                                        </td>
                                                                                        <td style="width: 300px"> <input type="text" class="form-control" id="refrepuestos_1" name="referencia_repuesto[]" readonly></td>
                                                                                        <td style="width: 300px"> <input type="text" class="form-control" id="codrepuestos_1" name="codigo_repuesto[]" readonly></td>
                                                                                        <td style="width: 300px"> <input type="text" class="form-control" id="cantrepuestos_1" name="cantidad_repuesto[]"></td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                        <div class="btn-tool-bar">
                                                                            <button type="button" class="btn btn-primary btn-md btn-agregarRepuestoSolicitud mb-3">
                                                                                <i class="fas fa-plus"></i>
                                                                            </button>
                                                                            <button type="button" class="btn btn-danger btn-md btn-EliminarRepuestoSolicitud mb-3">
                                                                                <i class="fas fa-times"></i>
                                                                            </button>
                                                                        </div>


                                                                    </div>
                                                                </div>
                                                                <!--CARD BODY-->
                                                            </div>





                                                            <!-- <div class="row d-flex justify-content-center">
                                                        <div class="card card-info" id="">
                                                            <div class="card-header">
                                                                <h3 class="card-title"><b><i>Repuesto</i></b>
                                                                    <i class="fas fa-car-alt"></i>
                                                                </h3>
                                                            </div>
                                                            <div class="card-body">
                                                                <div class="table-responsive">
                                                                    <table class="table table table-responsive table-bordered table-striped text-center">
                                                                        <thead>
                                                                            <tr>
                                                                                <th style="width: 500px">REPUESTO</th>
                                                                                <th>REFERENCIA</th>
                                                                                <th>CÓDIGO</th>
                                                                                <th>CANTIDAD</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody id="filas_tabla_repuestoSolicitud">
                                                                            <tr id="contenido_filas_repuestoSolicitud">
                                                                                <td style="width: 300px">

                                                                                    <div class="input-group">
                                                                                        <input class="form-control" type="text" id="repuesto_1" name="repuesto[]" placeholder="Seleccione un repuesto" readonly>
                                                                                        <div class="input-group-append">
                                                                                            <button type="button" class="btn btn-success btn-md btn-repuestos" consecutivo="1" title="lista repuestos" data-toggle="modal" data-target="#modal-repuestos"><i class="fas fa-business-time"></i></button>
                                                                                        </div>
                                                                                    </div>

                                                                                </td>
                                                                                <td style="width: 300px"> <input type="text" class="form-control" id="refrepuestos_1" name="referencia_repuesto[]" readonly></td>
                                                                                <td style="width: 300px"> <input type="text" class="form-control" id="codrepuestos_1" name="codigo_repuesto[]" readonly></td>
                                                                                <td style="width: 300px"> <input type="text" class="form-control" id="cantrepuestos_1" name="cantidad_repuesto[]"></td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                                <button type="button" class="btn btn-primary btn-md btn-agregarRepuestoSolicitud mb-3">
                                                                    <i class="fas fa-plus"></i>
                                                                </button>
                                                                <button type="button" class="btn btn-danger btn-md btn-EliminarRepuestoSolicitud mb-3">
                                                                    <i class="fas fa-times"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div> -->



                                                        </div>
                                                        <!-- MANO DE OBRA  -->
                                                        <div class="tab-pane fade" id="v-pills-manoObra" role="tabpanel" aria-labelledby="v-pills-manoObra-tab">
                                                            <div class="card-body">
                                                                <div class="table-responsive">
                                                                    <table class="table table table-responsive table-bordered table-striped text-center">
                                                                        <thead>
                                                                            <tr>
                                                                                <th style="width: 600px">Descripción de la actividad</th>
                                                                                <th>Proveedor</th>
                                                                                <th>Valor</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody id="filas_tabla_manoObra">
                                                                            <tr id="Contenido_tabla_manoObra">
                                                                                <td style="width: 200px"> <input type="text" class="form-control" id="descrip_mano" name="descrip_mano"></td>
                                                                                <td><input type="text" class="form-control" id="descrip_mano" name="descrip_mano"></td>
                                                                                <td><input type="text" class="form-control" id="valor_mano" name="valor_mano"></td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                            <button type="button" class="btn btn-primary btn-md btn-agregarManoObra mb-3" ">
                                                        <i class=" fas fa-plus"></i>
                                                            </button>
                                                            <button type="button" class="btn btn-danger btn-md btn-EliminarManoObra mb-3" ">
                                                        <i class=" fas fa-times"></i>
                                                            </button>
                                                        </div>
                                                        <!-- OBSERVACIONES -->
                                                        <div class="tab-pane fade" id="v-pills-observaciones" role="tabpanel" aria-labelledby="v-pills-observaciones-tab">
                                                            <div class="card-body">
                                                                <div class="callout callout-info">
                                                                    <h5>Digite su observación</h5>
                                                                    <textarea class="form-control" rows="5" id="oberser_observ" name="oberser_observ"></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- NOMBRES Y FIRMAS -->
                                                        <div class="tab-pane fade" id="v-pills-firmas" role="tabpanel" aria-labelledby="v-pills-firmas-tab">
                                                            <div class="callout callout-info">
                                                                <h5 class="text-center"><i>Nombres</i></h5>
                                                                <hr class="my-4">
                                                                <div class="row">
                                                                    <div class="col-12 col-sm-6 col-lg-4 text-center">
                                                                        <label><i>Conductor</i></label>
                                                                        <input type="text" class="form-control" id="nom_conductor" name="nom_conductor" required>
                                                                    </div>

                                                                    <div class="col-12 col-sm-6 col-lg-4 text-center">
                                                                        <label><i>Mecánico</i></label>
                                                                        <input type="text" class="form-control" id="nom_mecanico" name="nom_mecanico" required>
                                                                    </div>

                                                                    <div class="col-12 col-sm-6 col-lg-4 text-center">
                                                                        <label><i>Coordinador mecánico</i></label>
                                                                        <input type="text" class="form-control" id="nom_coormecani" name="nom_coormecani" required>
                                                                    </div>
                                                                </div>
                                                                <br>
                                                                <h5 class="text-center"><i>Firmas</i></h5>
                                                                <hr class="my-4">
                                                                <div class="row">
                                                                    <div class="col-12 col-sm-6 col-lg-4 text-center">
                                                                        <textarea class="form-control" rows="2" placeholder="Firme aqui conductor ..."></textarea>
                                                                    </div>

                                                                    <div class="col-12 col-sm-6 col-lg-4 text-center">
                                                                        <textarea class="form-control" rows="2" placeholder="Firme aqui Mecánico ..."></textarea>
                                                                    </div>

                                                                    <div class="col-12 col-sm-6 col-lg-4 text-center">
                                                                        <textarea class="form-control" rows="2" placeholder="Firme aqui Coordinador mecánico ..."></textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>

                                            </div>
                                            <!-- =====================================
                                        ************BOTONES *****************
                                    ========================================== -->
                                            <div class="row d-flex justify-content-center">
                                                <div class="col-md-6">
                                                    <div class="btn-group w-100">
                                                        <button class="btn btn-success col fileinput-button dz-clickable">
                                                            <i class="fas fa-plus"></i>
                                                            <span>Guardar</span>
                                                        </button>

                                                        <button type="reset" class="btn btn-danger col cancel">
                                                            <i class="fas fa-times-circle"></i>
                                                            <span>Cancelar</span>
                                                        </button>

                                                        <button class="btn btn-info col">
                                                            <i class="far fa-file-pdf"></i>
                                                            <span>Crear solicitud de servicio</span>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- ===================================================
                                      SOLICITUD DE SERVICIO REPUESTOS 
                                    =================================================== -->
                                        <!-- <div class="tab-pane fade active show" id="custom-tabs-one-solicitudserv_exter_repues" role="tabpanel" aria-labelledby="custom-tabs-one-solicitudserv_exter_repues-tab">
                                    <form id="solicitudServ_form" method="post" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-lg-3 col-sm-6">
                                                <nav class="navbar navbar-expand-lg">
                                                    <button class="navbar-toggler navbar-light bg-light" type="button" data-toggle="collapse" data-target="#ContenidoOrdenServicio" aria-controls="ContenidoOrdenServicio" aria-expanded="false" aria-label="Toggle navigation">
                                                        <span class="navbar-toggler-icon "></span>
                                                    </button>

                                                    <div class="collapse navbar-collapse" id="ContenidoOrdenServicio">
                                                        <div class=" nav navbar-expand-lg flex-column nav-pills " id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                                            <a class="nav-link active" id="v-pills-generalSolicitud-tab" data-toggle="pill" href="#v-pills-generalSolicitud" role="tab" aria-controls="v-pills-generalSolicitud" aria-selected="true">Datos generales</a>
                                                            <a class="nav-link" id="v-pills-Externo-tab" data-toggle="pill" href="#v-pills-Externo" role="tab" aria-controls="v-pills-Externo" aria-selected="false">Servicio externo</a>
                                                            <a class="nav-link" id="v-pills-repuestoSolicitud-tab" data-toggle="pill" href="#v-pills-repuestoSolicitud" role="tab" aria-controls="v-pills-repuestoSolicitud" aria-selected="false">Repuestos</a>
                                                        </div>
                                                    </div>
                                                </nav>
                                            </div>

                                            <div class="col-lg-9 col-sm-12">
                                                <div class="tab-content" id="v-pills-tabContent">
                                                    <!-- DATOS GENERALES -->
                                        <!-- <div class="tab-pane fade show active " id="v-pills-generalSolicitud" role="tabpanel" aria-labelledby="v-pills-generalSolicitud-tab">

                                                        <div class="row">
                                                            <div class="col-12 col-sm-6 col-lg-4">
                                                                <div class="form-group text-center">
                                                                    <label><i>Número de orden</i></label>
                                                                    <input type="text" class="form-control" id="num_orden" name="num_orden" readonly required>
                                                                </div>
                                                            </div>

                                                            <div class="col">
                                                                <div class="form-group text-center col-12 col-sm-6 col-lg-12">
                                                                    <label><i>Placa</i></label>
                                                                    <select id="placa_repuestos" name="idvehiculo_repuestos" class="form-control select2-single" type="number" style="width: 99%" required>
                                                                        <option selected value="">Seleccione un vehículo</option>
                                                                        <?php foreach ($Placas as $key => $value) : ?>
                                                                            <option value="<?= $value['idvehiculo'] ?>"><?= $value['placa'] ?> - <?= $value['numinterno'] ?> </option>
                                                                        <?php endforeach ?>
                                                                    </select>
                                                                </div>
                                                            </div>


                                                            <div class="col-12 col-sm-6 col-lg-4">
                                                                <div class="form-group text-center">
                                                                    <label><i>Número interno</i></label>
                                                                    <input type="text" class="form-control" id="numinterno_repuestos" name="numinterno_repuestos" required readonly>
                                                                </div>
                                                            </div>

                                                            <div class="col-12 col-sm-6 col-lg-4">
                                                                <div class="form-group text-center">
                                                                    <label><i>Marca</i></label>
                                                                    <input type="text" class="form-control" id="marca_repuestos" name="marca_repuestos" required readonly>
                                                                </div>
                                                            </div>

                                                            <div class="col-12 col-sm-6 col-lg-4">
                                                                <div class="form-group text-center">
                                                                    <label><i>Clase de vehículo</i></label>
                                                                    <input type="text" class="form-control" id="clasevehiculo_repuestos" name="clasevehiculo_repuestos" required readonly>
                                                                </div>
                                                            </div>


                                                            <div class="col-12 col-sm-6 col-lg-4">
                                                                <div class="form-group text-center">
                                                                    <label><i>Modelo</i></label>
                                                                    <input type="text" class="form-control" id="modelo_repuestos" name="modelo_repuestos" required readonly>
                                                                </div>
                                                            </div>

                                                            <div class="col-12 col-sm-6 col-lg-4">
                                                                <div class="form-group text-center">
                                                                    <label><i>Kilometraje</i></label>
                                                                    <input type="text" class="form-control" id="km_repuestos" name="km_repuestos" required readonly>
                                                                </div>
                                                            </div>

                                                            <div class="col-12 col-sm-6 col-lg-4">
                                                                <div class="form-group text-center">
                                                                    <label><i>Fecha</i></label>
                                                                    <input type="date" class="form-control" id="fecha_repuestos" name="fecha_repuestos" required>
                                                                </div>
                                                            </div>


                                                        </div>
                                                    </div> -->


                                        <!-- <div class="tab-pane fade" id="v-pills-Externo" role="tabpanel" aria-labelledby="v-pills-Externo-tab">
                                                        <div class="row">
                                                            <div class="col-lg-12 col-sm-12 justify-content-center">
                                                                <div class="card card-outline card-info">
                                                                    <div class="card-body">
                                                                        <div class="row">
                                                                            <?php foreach ($ServExt as $key => $value) : ?>
                                                                                <div class="col-12 col-sm-6 col-lg-4">
                                                                                    <div class="custom-control custom-checkbox">
                                                                                        <input class="custom-control-input" type="checkbox" id="servicioexter_<?= $value['idservicio_externo'] ?>" name="servicioexterno_<?= $value['idservicio_externo'] ?>">
                                                                                        <label for="servicioexter_<?= $value['idservicio_externo'] ?>" class="custom-control-label"><?= $value['nombre'] ?></label>
                                                                                    </div>
                                                                                </div>
                                                                            <?php endforeach ?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    
                                                    <div class="tab-pane fade" id="v-pills-repuestoSolicitud" role="tabpanel" aria-labelledby="v-pills-repuestoSolicitud-tab">
                                                        <div class="row d-flex justify-content-center">
                                                            <div class="card card-info" id="">
                                                                <div class="card-header">
                                                                    <h3 class="card-title"><b><i>Repuesto</i></b>
                                                                        <i class="fas fa-car-alt"></i>
                                                                    </h3>
                                                                </div>
                                                                <div class="card-body">
                                                                    <div class="table-responsive">
                                                                        <table class="table table table-responsive table-bordered table-striped text-center">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th style="width: 500px">REPUESTO</th>
                                                                                    <th>REFERENCIA</th>
                                                                                    <th>CÓDIGO</th>
                                                                                    <th>CANTIDAD</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody id="filas_tabla_repuestoSolicitud">
                                                                                <tr id="contenido_filas_repuestoSolicitud">
                                                                                    <td style="width: 300px">

                                                                                        <div class="input-group">
                                                                                            <input class="form-control" type="text" id="repuesto_1" name="repuesto[]" placeholder="Seleccione un repuesto" readonly>
                                                                                            <div class="input-group-append">
                                                                                                <button type="button" class="btn btn-success btn-md btn-repuestos" consecutivo="1" title="lista repuestos" data-toggle="modal" data-target="#modal-repuestos"><i class="fas fa-business-time"></i></button>
                                                                                            </div>
                                                                                        </div>

                                                                                    </td>
                                                                                    <td style="width: 300px"> <input type="text" class="form-control" id="refrepuestos_1" name="referencia_repuesto[]" readonly></td>
                                                                                    <td style="width: 300px"> <input type="text" class="form-control" id="codrepuestos_1" name="codigo_repuesto[]" readonly></td>
                                                                                    <td style="width: 300px"> <input type="text" class="form-control" id="cantrepuestos_1" name="cantidad_repuesto[]"></td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                    <button type="button" class="btn btn-primary btn-md btn-agregarRepuestoSolicitud mb-3">
                                                                        <i class="fas fa-plus"></i>
                                                                    </button>
                                                                    <button type="button" class="btn btn-danger btn-md btn-EliminarRepuestoSolicitud mb-3">
                                                                        <i class="fas fa-times"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> -->
                                        <hr class="my-4">


                                        <!-- <div class="row d-flex justify-content-center">
                                            <div class="col-lg-6 col-sm-12">
                                                <div class="card card-info collapsed-card" id="card-servicio">
                                                    <div class="card-header">
                                                        <h3 class="card-title"><b><i>Diagnóstico</i></b>
                                                            <i class="fas fa-search"></i>
                                                        </h3>
                                                        <div class="card-tools">
                                                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                                <i class="fas fa-plus"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <div class="card-body" style="display: none;">
                                                        <div class="form-group">
                                                            <textarea class="form-control" rows="5" placeholder="Digite su diagnostico ..." name="observacion_repuesto"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Solicitado por:</span>
                                                    </div>
                                                    <input type="text" class="form-control" name="solicitado_repuesto">
                                                </div>
                                            </div>
                                        </div> -->

                                        <!-- <br>

                                    </form> -->




                                        <!-- <div class="row d-flex justify-content-center">
                                        <div class="col-md-6">
                                            <div class="btn-group w-100">
                                                <button form="solicitudServ_form" class="btn btn-info col fileinput-button dz-clickable">
                                                    <i class="fas fa-plus"></i>
                                                    <span>Guardar</span>
                                                </button>

                                                <button type="reset" class="btn btn-danger col cancel">
                                                    <i class="fas fa-times-circle"></i>
                                                    <span>Cancelar</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>  -->

                                       
                                        
                                    </div>


                                </div>

                            </div>
                        </div>

                    </div>
                </div>
                <div class="tab-pane fade" id="pills-programacion" role="tabpanel" aria-labelledby="pills-programacion-tab">
                    <form id="programacion_form" method="post" enctype="multipart/form-data">
                        <input type="hidden" id="idserviciovehiculo" name="idserviciovehiculo" value="">

                        <div class="row">
                            <div class="col-12 col-sm-6 col-lg-12">


                                <!-- INGRESO -->
                                <div class="tab-pane fade show active " id="v-pills-Ingreso" role="tabpanel" aria-labelledby="v-pills-Ingreso-tab">
                                    <div class="row">
                                        <div class="col">

                                            <div class="form-group text-center col-12 col-sm-6 col-lg-12">
                                                <label><i>Servicio</i></label>
                                                <select type="text" class="form-control select2-single" id="servicio" name="idservicio" required>
                                                    <option value="" selected>Seleccione un servicio</option>
                                                    <option value="todo">Todos los servicios</option>
                                                    <?php foreach ($Servicios as $key => $value) : ?>
                                                        <option value="<?= $value['idservicio'] ?>"><?= $value['servicio'] ?></option>
                                                    <?php endforeach ?>
                                                </select>
                                            </div>
                                            <p class="text-sm font-italic font-weight-bold">
                                                NOTA: Para añadir o editar un servicio debe realizarse desde la opción de
                                                <a href="cg-mantenimiento" target="_blank">servicios menores</a>
                                                y volver a abrir esta ventana.
                                            </p>
                                        </div>

                                        <div class="col">
                                            <div class="form-group text-center col-12 col-sm-6 col-lg-12">
                                                <label><i>Placa</i></label>
                                                <select id="placa" name="idvehiculo_serv" class="form-control select2-single" type="number" style="width: 99%" required>
                                                    <option selected value="">Seleccione un vehículo</option>
                                                    <?php foreach ($Placas as $key => $value) : ?>
                                                        <option value="<?= $value['idvehiculo'] ?>"><?= $value['placa'] ?> - <?= $value['numinterno'] ?></option>
                                                    <?php endforeach ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col">
                                            <div class="form-group text-center col-12 col-sm-6 col-lg-12">
                                                <label><i>Kilometraje actual</i></label>
                                                <input type="text" class="form-control" id="kilometraje_serv" name="kilometraje_serv" required>
                                            </div>
                                        </div>


                                        <div class="col">
                                            <div class="form-group text-center col-12 col-sm-6 col-lg-12">
                                                <label><i>Fecha de realización</i></label>
                                                <input type="date" class="form-control" id="fecha" name="fecha" required>
                                            </div>
                                        </div>

                                    </div>
                                    <?php if (validarPermiso('M_OPCIONES', 'U')) : ?>
                                        <div class="col-12 mb-1">
                                            <button type="submit" form="programacion_form" id="btn-guardarProgra" class="btn btn-sm btn-success float-center">
                                                <i class="fas fa-print"></i>
                                                Guardar
                                            </button>
                                        </div>

                                    <?php endif ?>



                                </div>
                            </div>
                        </div>

                    </form>
                    <!-- TABLA -->
                    <div class="col-12">
                        <div class="card card-outline card-success">
                            <div class="card-body">
                                <h5 class="text-center"><i>Vehiculos</i></h5>
                                <div class="table-responsive">
                                    <table id="tablaProgramacion" class="table table-sm table-striped table-bordered dt-responsive text-center table-hover  w-100">
                                        <thead class="text-nowrap">
                                            <th>...</th>
                                            <th>Placa</th>
                                            <th>Servicio</th>
                                            <th>Kilometraje actual</th>
                                            <th>Kilometraje para cambio</th>
                                            <th>Fecha para cambio</th>
                                        </thead>
                                        <tbody id="tbodyProgramacion" class="text-nowrap">


                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
</div>


<!-- ==============================
    Modal para selecionar repuesto 
==================================-->

<div class="modal fade show" id="modal-repuestos" aria-modal="true" role="dialog">

    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h4 class="modal-title">Lista de repuestos</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <div class="card card-outline ">
                <div class="card-body">
                    <div class="col-12">
                        <div class="table-responsive">
                            <table id="tablaRepuesto" class="table table-sm table-striped table-bordered dt-responsive text-center table-hover  w-100">
                                <thead class="text-nowrap">
                                    <th>Código</th>
                                    <th>Referencia</th>
                                    <th>Descripción</th>
                                    <th>Categoría</th>
                                    <th>Marca</th>
                                    <th>Medida</th>
                                    <th>Selección</th>
                                </thead>
                                <tbody id="tBodyRepuesto" class="text-nowrap">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.modal-content -->
    </div>

</div>