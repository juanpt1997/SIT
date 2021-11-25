<?php

// if (!validarPermiso('CARGAR_OPCION', 'R')) {
//     echo "<script> window.location = 'inicio'; </script>";
// }

$Placas = ControladorVehiculos::ctrListaVehiculos();
$Servicios = ControladorVehiculos::ctrListadoServicios();
$Productos = ControladorMantenimientos::ctrListadoProductos();
$ServExt = ControladorMantenimientos::ctrListadoServiciosExternos();
$tiposDocumentacion = ControladorVehiculos::ctrTiposDocumentacion();
$OrdenesServicio = ControladorMantenimientos::ctrListadoOrdenesServicio();
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
                            <a class="nav-link active h4" id="pills-ordenserv-tab" data-toggle="tab" href="#pills-ordenserv" role="tab" aria-controls="pills-ordenserv" aria-selected="active">Orden de servicio <i class="fas fa-sticky-note"></i></a>
                        </li>
                        <li class="nav-item border border-info rounded ml-2 mb-1 mb-md-0">
                            <a class="nav-link h4" id="pills-programacion-tab" data-toggle="tab" href="#pills-programacion" role="tab" aria-controls="pills-programacion" aria-selected="false">Programación <i class="fas fa-clipboard-check"></i></a>
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
                                        <li class="nav-item">
                                            <a class="nav-link" id="custom-tabs-one-historial_orden-tab" data-toggle="pill" href="#custom-tabs-one-historial_orden" role="tab" aria-controls="custom-tabs-one-historial_orden" aria-selected="false">Historial</a>
                                        </li>

                                    </ul>
                                </div>

                                <div class="card-body">
                                    <div class="tab-content" id="custom-tabs-one-tabContent">
                                        <!-- ==============================================
                                        TAB ORDEN SERVICIO 
                                        ==================================================-->
                                        <div class="tab-pane fade active show" id="custom-tabs-one-ordenserv_mante" role="tabpanel" aria-labelledby="custom-tabs-one-ordenserv_mante-tab">
                                            <form id="ordenServ_form" method="post" enctype="multipart/form-data">
                                                <input type="hidden" id="idorden" name="idorden" value="">
                                                <div class="row">
                                                    <div class="col-lg-3 col-sm-6">

                                                        <!-- NAVBAR VERTICAL -->
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
                                                        <div class="col-9">
                                                            <a href="#" class="btn btn-warning btn-block">Abierta</a>

                                                        </div>


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
                                                                            <input type="text" class="form-control" id="numinterno_ordSer" name="numinterno_ordSer" required readonly>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-12 col-sm-6 col-lg-4">
                                                                        <div class="form-group text-center">
                                                                            <label><i>Marca</i></label>
                                                                            <input type="text" class="form-control" id="marca_ordSer" name="marca_ordSer" required readonly>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-12 col-sm-6 col-lg-4">
                                                                        <div class="form-group text-center">
                                                                            <label><i>Clase de vehículo</i></label>
                                                                            <input type="text" class="form-control" id="clasevehiculo_ordSer" name="clasevehiculo_ordSer" required readonly>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-12 col-sm-6 col-lg-4">
                                                                        <div class="form-group text-center">
                                                                            <label><i>Modelo</i></label>
                                                                            <input type="text" class="form-control" id="modelo_ordSer" name="modelo_ordSer" required readonly>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-12 col-sm-6 col-lg-4">
                                                                        <div class="form-group text-center">
                                                                            <label><i>Kilometraje</i></label>
                                                                            <input type="number" class="form-control" id="kilome_ordSer" name="kilome_ordSer" required readonly>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-12 col-sm-6 col-lg-4">
                                                                        <div class="form-group text-center">
                                                                            <label><i>Fecha de entrada</i></label>
                                                                            <input type="date" class="form-control" id="fechaentrada_ordSer" name="fechaentrada_OrdSer" required readonly>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-12 col-sm-6 col-lg-4">
                                                                        <div class="form-group text-center">
                                                                            <label><i>Hora de entrada</i></label>
                                                                            <input type="time" class="form-control" id="horaentra_ordSer" name="horaentra_ordSer" required>
                                                                        </div>
                                                                    </div>


                                                                    <div class="col-12 col-sm-6 col-lg-4">
                                                                        <div class="form-group text-center">
                                                                            <label><i># Orden de servicio</i></label>
                                                                            <input type="text" class="form-control" id="numOrden_ordSer" name="numOrden_ordSer" readonly>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-12 col-sm-6 col-lg-4">
                                                                        <div class="form-group text-center">
                                                                            <label><i>Fecha de inicio de trabajos</i></label>
                                                                            <input type="date" class="form-control" id="fechainicio_ordSer" name="fechaInic_ordSer" required>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-12 col-sm-6 col-lg-4">
                                                                        <div class="form-group text-center">
                                                                            <label><i>Fecha de aprobación</i></label>
                                                                            <input type="date" class="form-control" id="fechainicio_ordSer" name="fechaApro_ordSer" required>
                                                                        </div>
                                                                    </div>




                                                                    <div class="col-12 col-sm-6 col-lg-4">
                                                                        <div class="form-group text-center">
                                                                            <label><i>Sistema</i></label>
                                                                            <select name="sistema" id="sistema" class="form-control select2-single" type="number" style="width: 99%" required>
                                                                                <option selected value="">Seleccione el sistema</option>
                                                                                <option value="1">Sistema motor</option>
                                                                                <option value="2">Sistema transmisión</option>
                                                                                <option value="3">Sistema de frenos y llantas</option>
                                                                                <option value="4">Sistema eléctrico</option>
                                                                                <option value="5">Sistema de suspensión</option>
                                                                                <option value="6">Sistema de dirección</option>
                                                                                <option value="7">Carrocería</option>
                                                                                <option value="8">Sistema diferencial</option>
                                                                                <option value="9">General vehículo</option>
                                                                                <option value="10">Logístico</option>
                                                                                <option value="11">Aire acondicionado</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-12 col-sm-6 col-lg-4">
                                                                        <div class="form-group text-center">
                                                                            <label><i>Tipo de mantenimiento</i></label>
                                                                            <select id="tipo_mantenimiento" name="tipo_mantenimiento" class="form-control select2-single" type="number" style="width: 99%" required>
                                                                                <option selected value="">Seleccione un tipo de mantenimiento</option>
                                                                                <option value="1">Preventivo</option>
                                                                                <option value="2">Correctivo</option>
                                                                                <option value="3">GPS</option>
                                                                                <option value="4">Servicios logísticos</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>

                                                                </div>

                                                                <div class="card card-info collapsed-card" id="card-documentosVehiculo">
                                                                    <div class="card-header" data-card-widget="collapse" style="cursor:pointer;">
                                                                        <h3 class="card-title"><b><i>Fechas de vencimiento</i></b>
                                                                            <i class="fas fa-folder-open"></i>
                                                                        </h3>
                                                                        <div class="card-tools">
                                                                            <button type="button" title="Abrir documentos del vehículo" data-toggle="tooltip" data-placement="top" class="btn btn-tool">
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

                                                                <div class="card card-info collapsed-card" id="card-programacion" data-card-widget="collapse">
                                                                    <div class="card-header" data-card-widget="collapse" style="cursor:pointer;">
                                                                        <h3 class="card-title"><b><i>Mantenimiento preventivo</i></b>
                                                                            <i class="far fa-calendar-alt"></i>
                                                                        </h3>
                                                                        <div class="card-tools">
                                                                            <button type="button" title="Abrir programación del vehículo" data-toggle="tooltip" data-placement="top" class="btn btn-tool">
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
                                                                        <div class="col-md-12 col-sm-9 ">
                                                                            <div class="form-group text-center">
                                                                                <label>Descripción</label>
                                                                                <textarea class="form-control" name="diagnostico" rows="5" placeholder="Digite una leve descripción ..." required></textarea>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-6">
                                                                                    <h5>Mantenimientos preventivos a realizar</h5>
                                                                                    <div class="form-group">
                                                                                        <div class="input-group ">
                                                                                            <select id="ServPre" class="select2-primary form-control select2-multiple input-sm" data-placeholder="Lista de mantenimientos preventivos" multiple="multiple" style="width: 99%" name="serviciosPrev[]">

                                                                                                <?php foreach ($Servicios as $key => $value) : ?>
                                                                                                    <option value="<?= $value['idservicio'] ?>"><?= $value['servicio'] ?></option>
                                                                                                <?php endforeach ?>
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-6">
                                                                                    <h5>Mantenimientos correctivos a realizar</h5>
                                                                                    <div class="form-group">
                                                                                        <div class="input-group input-group-sm">
                                                                                            <select id="correctivo" class="select2-primary form-control select2-multiple input-sm" data-placeholder="Lista de mantenimientos preventivos" multiple="multiple" style="width: 99%" name="correctivo[]">

                                                                                                <?php foreach ($Servicios as $key => $value) : ?>
                                                                                                    <option value="<?= $value['idservicio'] ?>"><?= $value['servicio'] ?></option>
                                                                                                <?php endforeach ?>
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>


                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- REPUESTOS / SOLICITUD SERVICIO -->
                                                            <div class="tab-pane fade" id="v-pills-repuestos" role="tabpanel" aria-labelledby="v-pills-repuestos-tab">

                                                                <!-- SERVICIOS EXTERNOS COLLAPSE -->
                                                                <div class="card card-info collapsed-card" id="card-serviciosext">
                                                                    <div class="card-header" data-card-widget="collapse" style="cursor:pointer;">
                                                                        <h3 class="card-title"><b><i>Servicios externos</i></b>
                                                                            <i class="fas fa-boxes"></i>
                                                                        </h3>
                                                                        <div class="card-tools">
                                                                            <button type="button" title="Abrir servicios externos" data-toggle="tooltip" data-placement="top" class="btn btn-tool">
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
                                                                <div class="card card-info collapsed-card" id="card-repuesto">
                                                                    <div class="card-header" data-card-widget="collapse" style="cursor:pointer;">
                                                                        <h3 class="card-title"><b><i>Repuesto</i></b>
                                                                            <i class="fas fa-tools nav-icon"></i>
                                                                        </h3>
                                                                        <div class="card-tools">
                                                                            <button type="button" title="Abrir repuesto" data-toggle="tooltip" data-placement="top" class="btn btn-tool">
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
                                                                <div class=" col-md-6 d-md-flex justify-content-md-end mb-3">
                                                                    <button class="btn btn-secondary col">
                                                                        <i class="far fa-file-pdf"></i>
                                                                        <span>Crear solicitud de servicio</span>
                                                                    </button>
                                                                </div>



                                                            </div>
                                                            <!-- MANO DE OBRA  -->
                                                            <div class="tab-pane fade" id="v-pills-manoObra" role="tabpanel" aria-labelledby="v-pills-manoObra-tab">
                                                                <div class="card-body">
                                                                    <div class="table-responsive">
                                                                        <table class="table table table-responsive table-bordered table-striped text-center">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th style="width: 600px">Proveedor</th>
                                                                                    <th>Descripción de la actividad</th>
                                                                                    <th>Valor</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody id="filas_tabla_manoObra">
                                                                                <tr id="Contenido_tabla_manoObra">
                                                                                    <td style="width: 300px">
                                                                                        <div class="input-group">
                                                                                            <input class="form-control" type="text" id="proveedor_1" name="repuesto[]" placeholder="Seleccione un repuesto" readonly>
                                                                                            <div class="input-group-append">
                                                                                                <button type="button" class="btn btn-success btn-md btn-proveedor" consecutivo="1" title="lista proveedores" data-toggle="modal" data-target="#modal-proveedores"><i class="fas fa-parachute-box"></i></button>
                                                                                            </div>
                                                                                        </div>

                                                                                    </td>
                                                                                    <td style="width: 300px"><input type="text" class="form-control" id="valor_1" name="valor_mano"></td>
                                                                                    <td style="width: 300px"><input type="text" class="form-control" id="descrip_1" name="descrip_mano"></td>
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
                                                                        <textarea class="form-control" rows="5" id="observacion" name="observacion"></textarea>
                                                                    </div>

                                                                </div>
                                                            </div>



                                                            <!-- NOMBRES Y FIRMAS -->
                                                            <!-- <div class="tab-pane fade" id="v-pills-firmas" role="tabpanel" aria-labelledby="v-pills-firmas-tab">
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
                                                        </div> -->

                                                        </div>
                                                    </div>

                                                </div>
                                                <!-- =====================================
                                                    ************BOTONES *****************
                                                    ========================================== -->
                                                <div class="row d-flex justify-content-center">
                                                    <div class="col-md-6">
                                                        <div class="btn-group w-100">
                                                            <button type="submit" form="ordenServ_form" class="btn btn-success col fileinput-button dz-clickable">
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
                                            </form>
                                        </div>

                                        <!-- HISTORICO DE ORDENES DE SERVICIO -->
                                        <div class="tab-pane fade" id="custom-tabs-one-historial_orden" role="tabpanel" aria-labelledby="custom-tabs-one-historial_orden-tab">
                                            <div class="card-body"">
                                                <div class=" col-12">
                                                <div class="card card-outline card-success">
                                                    <div class="card-body">
                                                        <div class="table-responsive">
                                                            <table id="" class="table table-bordered text-center tablasBtnExport">
                                                                <thead class="text-nowrap">
                                                                    <th>id Orden</th>
                                                                    <th>Vehículo</th>
                                                                    <th>Fecha entrada</th>
                                                                    <th>Fecha salida</th>
                                                                    <th>Fecha inicios de trabajo</th>
                                                                    <th>Tipo de mantenimiento</th>
                                                                    <th>Sistema</th>
                                                                    <th>Diagnóstico</th>
                                                                    <th>Observación</th>
                                                                </thead>
                                                                <tbody id="" class="text-nowrap">
                                                                    <?php foreach ($OrdenesServicio as $key => $value) : ?>
                                                                        <tr>
                                                                            <td><?= $value['idorden'] ?></td>
                                                                            <td><?= $value['placa'] ?></td>
                                                                            <td><?= $value['fecha_entrada'] ?></td>
                                                                            <td><?= $value['fecha_aprobacion'] ?></td>
                                                                            <td><?= $value['fecha_trabajos'] ?></td>
                                                                            <td><?= $value['tipo_mantenimiento'] ?></td>
                                                                            <td><?= $value['sistema'] ?></td>
                                                                            <td><?= $value['diagnostico'] ?></td>
                                                                            <td><?= $value['observacion'] ?></td>
                                                                        </tr>
                                                                    <?php endforeach ?>

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
                        </div>
                    </div>
                </div>
            </div>


            <!-- PROGRAMACIÓN -->
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
                                            <input type="number" class="form-control" id="kilometraje_serv" name="kilometraje_serv" required>
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
                                    <th>Stock</th>
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

<!-- ================================
    MODAL PARA SELECCIONAR PROVEEDOR
====================================== -->

<div class="modal fade show" id="modal-proveedores" arial-modal="true" role="dialog">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h4 class="modal-title">Lista de proveedores</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <div class="card card-outline ">
                <div class="card-body">
                    <div class="col-12">
                        <div class="table-responsive">
                            <table id="tablaProveedores" class="table table-sm table-striped table-bordered dt-responsive text-center table-hover  w-100">
                                <thead class="text-nowrap">
                                    <th>Documento</th>
                                    <th>Nombre</th>
                                    <th>Razón social</th>
                                    <th>Dirección</th>
                                    <th>Teléfono</th>
                                    <th>Correo</th>
                                    <th>Selección</th>
                                </thead>
                                <tbody id="tBodyProveedores" class="text-nowrap">

                                </tbody>
                            </table>
                        </div>
                        <a href="c-proveedores" target="_blank">
                            <button type="" class="btn btn-sm btn-warning float-center btn-nuevoProveedor">
                                <i class="fas fa-parachute-box"></i>
                                Nuevo proveedor
                            </button>

                        </a>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.modal-content -->
    </div>
</div>