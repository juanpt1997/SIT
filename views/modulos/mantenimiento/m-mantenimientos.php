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
$Correctivos = ControladorVehiculos::ctrListadoCorrectivos();
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
                            <a class="nav-link h4" id="pills-programacion-tab" data-toggle="tab" href="#pills-programacion" role="tab" aria-controls="pills-programacion" aria-selected="false">Rutinas <i class="fas fa-clipboard-check"></i></a>
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
                                            <a class="nav-link" id="custom-tabs-one-historial_orden-tab" data-toggle="pill" href="#custom-tabs-one-historial_orden" role="tab" aria-controls="custom-tabs-one-historial_orden" aria-selected="false">Historial de ordenes de servicio</a>
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
                                                                    <a class="nav-link border-bottom rounded" id="v-pills-repuestos-tab" data-toggle="pill" href="#v-pills-repuestos" role="tab" aria-controls="v-pills-repuestos" aria-selected="false"><b><i class="fas fa-screwdriver"></i> Repuestos / Mano de obra</b></a>
                                                                    <!-- <a class="nav-link border-bottom rounded" id="v-pills-manoObra-tab" data-toggle="pill" href="#v-pills-manoObra" role="tab" aria-controls="v-pills-manoObra" aria-selected="false"><b><i class="fas fa-fist-raised"></i> Mano de obra</b></a> -->
                                                                    <a class="nav-link border-bottom rounded" id="v-pills-observaciones-tab" data-toggle="pill" href="#v-pills-observaciones" role="tab" aria-controls="v-pills-observaciones" aria-selected="false"><b><i class="far fa-comment-alt"></i> Observaciones</b></a>
                                                                    <!-- <a class="nav-link" id="v-pills-firmas-tab" data-toggle="pill" href="#v-pills-firmas" role="tab" aria-controls="v-pills-firmas" aria-selected="false"><b>Nombres y firmas</b></a> -->
                                                                </div>
                                                            </div>



                                                        </nav>
                                                        <div class="col-9">
                                                            <select name="estado" id="estado" class="custom-select text-center" data-style="btn-warning">
                                                                <option selected value="3">Estados de la orden</option>
                                                                <option value="0">Cancelada</option>
                                                                <option value="1">Abierta</option>
                                                                <option value="2">Aprobada</option>
                                                            </select>
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
                                                                            <input type="date" class="form-control" id="fechainicio_ordSer" name="fechaInic_ordSer">
                                                                        </div>
                                                                    </div>

                                                                    <!-- <div class="col-12 col-sm-6 col-lg-4">
                                                                        <div class="form-group text-center">
                                                                            <label><i>Fecha de aprobación</i></label>
                                                                            <input type="date" class="form-control" id="fechainicio_ordSer" name="fechaApro_ordSer" required>
                                                                        </div>
                                                                    </div> -->



                                                                    <!-- <div class="col-12 col-sm-6 col-lg-4">
                                                                        <div class="form-group text-center">
                                                                            <label><i>Tipo de mantenimiento</i></label>
                                                                            <select id="tipo_mantenimiento" name="tipo_mantenimiento" class="form-control select2-single" type="number" style="width: 99%" required>
                                                                                <option selected value="">Seleccione un tipo de mantenimiento</option>
                                                                                <option>Preventivo</option>
                                                                                <option>Correctivo</option>
                                                                                <option>GPS</option>
                                                                                <option>Servicios logísticos</option>
                                                                            </select>
                                                                        </div>
                                                                    </div> -->

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

                                                                <div class="card card-info collapsed-card" id="card-programacion">
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
                                                                        <div class="row">
                                                                            <div class="col-lg-12 col-sm-12 justify-content-center">
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
                                                                    </div>
                                                                    <!--CARD BODY-->
                                                                </div>
                                                            </div>
                                                            <!-- DIAGNÓSTICO -->
                                                            <div class="tab-pane fade" id="v-pills-diagnostico" role="tabpanel" aria-labelledby="v-pills-diagnostico-tab">
                                                                <div class="callout callout-info col-md-12 col-sm-8">
                                                                    <div class="row">
                                                                        <div class="col-md-12 col-sm-9 ">
                                                                            <div class="form-group text-center" id="diagnostico_solicitud">
                                                                                <label>Descripción</label>
                                                                                <textarea class="form-control diagno-resu" name="diagnostico" rows="5" placeholder="Digite una leve descripción ..." required></textarea>
                                                                            </div>
                                                                            <!-- <div class="row">
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

                                                                                                <?php foreach ($Correctivos as $key => $value) : ?>
                                                                                                    <option value="<?= $value['idservicio'] ?>"><?= $value['servicio'] ?></option>
                                                                                                <?php endforeach ?>
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div> -->
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
                                                                                <div class="row" id="servicios_externos">
                                                                                    <?php foreach ($ServExt as $key => $value) : ?>
                                                                                        <div class="col-12 col-sm-6 col-lg-4">
                                                                                            <div class="custom-control custom-checkbox">
                                                                                                <input class="custom-control-input input-servext" type="checkbox" id="servicioexter_<?= $value['idservicio_externo'] ?>" idservicioexterno="<?= $value['idservicio_externo'] ?>">
                                                                                                <label for="servicioexter_<?= $value['idservicio_externo'] ?>" class="custom-control-label "><?= $value['nombre'] ?></label>
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
                                                                            <div class="table-responsive" id="repuesto_solicitud">
                                                                                <table class="table table-bordered table-striped text-center text-nowrap">
                                                                                    <thead>
                                                                                        <tr>
                                                                                            <th style="width:990px;">REPUESTO ORDEN SERVICIO</th>
                                                                                            <th>REFERENCIA</th>
                                                                                            <th>CÓDIGO</th>
                                                                                            <th>VALOR UNITARIO</th>
                                                                                            <th>CANTIDAD</th>
                                                                                            <th>DIAGNÓSTICO ORDEN SERVICIO</th>
                                                                                            <th>TIPO DE SISTEMA ORDEN SERVICIO</th>
                                                                                            <th>TIPO DE MANTENIMIENTO</th>
                                                                                        </tr>
                                                                                    </thead>
                                                                                    <tbody id="filas_tabla_repuestoSolicitud">
                                                                                        <tr id="contenido_filas_repuestoSolicitud">
                                                                                            <td style="width: 900px;">
                                                                                                <div class="input-group">
                                                                                                    <input class="form-control" type="text" id="repuesto_1" name="repuesto[]" placeholder="Seleccione un repuesto" maxlength="0">
                                                                                                    <div class="input-group-append">
                                                                                                        <button type="button" class="btn btn-success btn-md btn-repuestos" consecutivo="1" title="lista repuestos" data-toggle="modal" data-target="#modal-repuestos"><i class="fas fa-business-time"></i></button>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </td>
                                                                                            <input type="hidden" id="inventario_1" name="inventario[]">
                                                                                            <td> <input type="text" class="form-control" id="refrepuestos_1" name="referencia_repuesto[]" readonly></td>
                                                                                            <td> <input type="text" class="form-control" id="codrepuestos_1" name="codigo_repuesto[]" readonly></td>
                                                                                            <td> <input type="text" class="form-control" id="valorrepuestos_1" readonly></td>
                                                                                            <td> <input type="text" class="form-control input-cantrepuesto" id="cantrepuestos_1" name="cantidad_repuesto[]"></td>
                                                                                            <td>
                                                                                                <input type="hidden" id="servicio_repuesto_1" name="servicio_repuesto[]">
                                                                                                <div class="input-group">
                                                                                                    <input class="form-control" type="text" id="servrepuesto_1" name="servrepuesto[]" placeholder="Seleccione un servicio" maxlength="0">
                                                                                                    <div class="input-group-append">
                                                                                                        <button type="button" class="btn btn-success btn-md btn-servicios" seccion="repuesto" consecutivo="1" title="lista de servicios" data-toggle="modal" data-target="#modal-servicios"><i class="fab fa-cloudsmith"></i></button>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </td>
                                                                                            <td style="width: 900px;">
                                                                                                <div class="input-group">
                                                                                                    <input class="form-control" type="text" id="sistemarepuesto_1" name="sistemarepuesto[]" placeholder="Seleccione el tipo de sistema" maxlength="0">
                                                                                                    <div class="input-group-append">
                                                                                                        <button type="button" class="btn btn-success btn-md btn-sistema" seccion="repuesto" consecutivo="1" title="lista de sistemas" data-toggle="modal" data-target="#modal-sistema"><i class="fas fa-drafting-compass"></i></button>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </td>
                                                                                            <td style="width: 900px;">
                                                                                                <div class="input-group">
                                                                                                    <input class="form-control" type="text" id="mantenimientorepuesto_1" name="mantenimientorepuesto[]" placeholder="Seleccione un mantenimiento" maxlength="0">
                                                                                                    <div class="input-group-append">
                                                                                                        <button type="button" class="btn btn-success btn-md btn-mantenimiento" seccion="repuesto" consecutivo="1" title="lista de mantenimientos" data-toggle="modal" data-target="#modal-mantenimiento"><i class="fas fa-wrench"></i></button>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </td>
                                                                                            <!-- <td style="width: 900px">
                                                                                                <select id="ServPre" class="select2-primary form-control select2-multiple input-sm" data-placeholder="Lista de mantenimientos preventivos" multiple="multiple" style="width: 99%" name="serviciosPrev[]">
                                                                                                    <?php foreach ($Servicios as $key => $value) : ?>
                                                                                                        <option value="<?= $value['idservicio'] ?>"><?= $value['servicio'] ?></option>
                                                                                                    <?php endforeach ?>
                                                                                                </select>
                                                                                            </td>
                                                                                            <td >
                                                                                                <select name="sistema" id="sistema" class="form-control select2-single" type="number" style="width: 99%" required>
                                                                                                    <option selected value="">Seleccione el sistema</option>
                                                                                                    <option>Sistema motor</option>
                                                                                                    <option>Sistema transmisión</option>
                                                                                                    <option>Sistema de frenos y llantas</option>
                                                                                                    <option>Sistema eléctrico</option>
                                                                                                    <option>Sistema de suspensión</option>
                                                                                                    <option>Sistema de dirección</option>
                                                                                                    <option>Carrocería</option>
                                                                                                    <option>Sistema diferencial</option>
                                                                                                    <option>General vehículo</option>
                                                                                                    <option">Logístico</option>
                                                                                                        <option">Aire acondicionado</option>
                                                                                                </select>
                                                                                            </td>
                                                                                            <td style="width: 300px"> <select id="tipo_mantenimiento" name="tipo_mantenimiento" class="form-control select2-single" type="number" style="width: 99%" required>
                                                                                                    <option selected value="">Seleccione un tipo de mantenimiento</option>
                                                                                                    <option>Preventivo</option>
                                                                                                    <option>Correctivo</option>
                                                                                                    <option>GPS</option>
                                                                                                    <option>Servicios logísticos</option>
                                                                                                </select>
                                                                                            </td> -->
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                            </div>


                                                                        </div>
                                                                        <div class="btn-tool-bar">
                                                                            <button type="button" class="btn btn-primary btn-md btn-agregarRepuestoSolicitud mt-3">
                                                                                <i class="fas fa-plus"></i>
                                                                            </button>
                                                                            <button type="button" class="btn btn-danger btn-md btn-EliminarRepuestoSolicitud mt-3">
                                                                                <i class="fas fa-times"></i>
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                    <!--CARD BODY-->


                                                                </div>

                                                                <!-- MANO DE OBRA COLLAPSE -->
                                                                <div class="card card-info collapsed-card" id="card-manoObra">
                                                                    <div class="card-header" data-card-widget="collapse" style="cursor:pointer;">
                                                                        <h3 class="card-title"><b><i>Mano de obra</i></b>
                                                                            <i class="fas fa-fist-raised"></i>
                                                                        </h3>
                                                                        <div class="card-tools">
                                                                            <button type="button" title="Abrir mano de obra" data-toggle="tooltip" data-placement="top" class="btn btn-tool">
                                                                                <i class="fas fa-plus"></i>
                                                                            </button>
                                                                        </div>
                                                                    </div>

                                                                    <div class="card-body" style="display: none;">
                                                                        <div class="row d-flex justify-content-center">

                                                                            <div class="table-responsive">
                                                                                <table class="table table table-responsive table-bordered table-striped text-center text-nowrap">
                                                                                    <thead>
                                                                                        <tr>
                                                                                            <th style="width: 900px">PROVEEDOR ORDEN SERVICIO</th>
                                                                                            <th>DESCRIPCIÓN</th>
                                                                                            <th>VALOR ORDEN SERVICIO</th>
                                                                                            <th style="width: 900px">DIAGNÓSTICO ORDEN SERVICIO</th>
                                                                                            <th>TIPO DE SISTEMA</th>
                                                                                            <th>TIPO DE MANTENIMIENTO</th>
                                                                                        </tr>
                                                                                    </thead>
                                                                                    <tbody id="filas_tabla_manoObra">
                                                                                        <tr id="Contenido_tabla_manoObra">
                                                                                            <td style="width: 600px">
                                                                                                <div class="input-group">
                                                                                                    <input class="form-control" type="text" id="proveedor_1" placeholder="Seleccione un proveedor" maxlength="0>
                                                                                                    <div class=" input-group-append">
                                                                                                    <button type="button" class="btn btn-success btn-md btn-proveedor" consecutivo="1" title="lista proveedores" data-toggle="modal" data-target="#modal-proveedores"><i class="fas fa-parachute-box"></i></button>
                                                                                                </div>
                                                                                            </td>
                                                                                            <input type="hidden" id="idproveedor_1" name="proveedor[]">
                                                                                            <td style="width: 300px"><input type="text" class="form-control" id="descrip_1" name="descrip_mano[]"></td>
                                                                                            <td style="width: 300px"><input type="text" class="form-control" id="valor_1" name="valor_mano[]"></td>
                                                                                            <td style="width: 300px">
                                                                                                <input type="hidden" id="servicio_mano_1" name="servicio_mano[]">
                                                                                                <div class="input-group">
                                                                                                    <input class="form-control" type="text" id="servmanoObra_1" name="servmanoObra[]" placeholder="Seleccione un servicio" maxlength="0>
                                                                                                    <div class=" input-group-append">
                                                                                                    <button type="button" class="btn btn-success btn-md btn-servicios" seccion="manoObra" consecutivo="1" title="lista de servicios" data-toggle="modal" data-target="#modal-servicios"><i class="fab fa-cloudsmith"></i></button>
                                                                                                </div>

                                                                                            </td>
                                                                                            <td style="width: 900px;">
                                                                                                <div class="input-group">
                                                                                                    <input class="form-control" type="text" id="sistemanoObra_1" name="sistmanoobra[]" placeholder="Seleccione el tipo de sistema" maxlength="0>
                                                                                                    <div class=" input-group-append">
                                                                                                    <button type="button" class="btn btn-success btn-md btn-sistema" seccion="manoObra" consecutivo="1" title="lista de sistemas" data-toggle="modal" data-target="#modal-sistema"><i class="fas fa-drafting-compass"></i></button>
                                                                                                </div>

                                                                                            </td>
                                                                                            <td style="width: 900px;">
                                                                                                <div class="input-group">
                                                                                                    <input class="form-control" type="text" id="mantenimientoManoObra_1" name="mantenimientomanobra[]" placeholder="Seleccione un mantenimiento" maxlength="0">
                                                                                                    <div class="input-group-append">
                                                                                                        <button type="button" class="btn btn-success btn-md btn-mantenimiento" seccion="manoObra" consecutivo="1" title="lista de mantenimientos" data-toggle="modal" data-target="#modal-mantenimiento"><i class="fas fa-wrench"></i></button>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </td>

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
                                                                    <!--CARD BODY-->



                                                                </div>


                                                                <div class=" col-md-6 d-md-flex justify-content-md-end mb-3">
                                                                    <button class="btn btn-secondary col" id="btn-crearSolicitud" data-toggle="modal" data-target="#modal-solicitud" disabled>
                                                                        <i class="far fa-file-pdf"></i>
                                                                        <span>Crear solicitud de servicio</span>
                                                                    </button>
                                                                </div>



                                                            </div>
                                                            <!-- MANO DE OBRA  -->
                                                            <!-- <div class="tab-pane fade" id="v-pills-manoObra" role="tabpanel" aria-labelledby="v-pills-manoObra-tab">
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
                                                                                            <input class="form-control" type="text" id="proveedor_1" placeholder="Seleccione un proveedor" readonly>
                                                                                            <div class="input-group-append">
                                                                                                <button type="button" class="btn btn-success btn-md btn-proveedor" consecutivo="1" title="lista proveedores" data-toggle="modal" data-target="#modal-proveedores"><i class="fas fa-parachute-box"></i></button>
                                                                                            </div>
                                                                                        </div>

                                                                                    </td>
                                                                                    <input type="hidden" id="idproveedor_1" name="proveedor[]">
                                                                                    <td style="width: 300px"><input type="text" class="form-control" id="descrip_1" name="descrip_mano[]"></td>
                                                                                    <td style="width: 300px"><input type="text" class="form-control" id="valor_1" name="valor_mano[]"></td>
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
                                                            </div> -->

                                                            <!-- OBSERVACIONES -->
                                                            <div class="tab-pane fade" id="v-pills-observaciones" role="tabpanel" aria-labelledby="v-pills-observaciones-tab">
                                                                <div class="card-body">
                                                                    <div class="callout callout-info">
                                                                        <h5>Digite su observación</h5>
                                                                        <textarea class="form-control" rows="5" id="observacion" name="observacion"></textarea>
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
                                            <div class="card-body">
                                                <div class="col-12">
                                                    <div class="card card-outline card-success">
                                                        <div class="card-body">

                                                            <div class="table-responsive">
                                                                <table class="table table-bordered text-center tablasBtnExport">
                                                                    <thead class="text-nowrap">
                                                                        <tr>
                                                                            <th>...</th>
                                                                            <th># Orden</th>
                                                                            <th>Vehículo</th>
                                                                            <th>Fecha entrada</th>
                                                                            <th>Fecha salida</th>
                                                                            <th>Fecha inicios de trabajo</th>
                                                                            <th>Tipo de mantenimiento</th>
                                                                            <th>Sistema</th>
                                                                            <th>Diagnóstico</th>
                                                                            <th>Observación</th>
                                                                            <th>Estado</th>
                                                                        </tr>
                                                                    </thead>

                                                                    <tbody class="text-nowrap">
                                                                        <?php foreach ($OrdenesServicio as $key => $value) : ?>
                                                                            <?php
                                                                            if ($value['estado'] == 0) {
                                                                                $Estado = "<span class='badge badge-danger'>Cancelada</span>";
                                                                            } elseif ($value['estado'] == 1) {
                                                                                $Estado = "<span class='badge badge-warning'>Abierta</span>";
                                                                            } else {
                                                                                $Estado = "<span class='badge badge-success'>Aprobada</span>";
                                                                            }
                                                                            ?>
                                                                            <tr>
                                                                                <td><a><i class="far fa-file-pdf text-danger"></i></a></td>
                                                                                <td><button class="btn btn-outline-dark btn-editarOrden" idorden="<?= $value['idorden'] ?>" title="Ir a la orden" data-toggle="tooltip" data-placement="top" type="button"><?= $value['idorden'] ?></button></td>
                                                                                <td><?= $value['placa'] ?></td>
                                                                                <td><?= $value['Ffecha_entrada'] ?></td>
                                                                                <td><?= $value['Ffecha_aprobacion'] ?></td>
                                                                                <td><?= $value['Ffecha_trabajos'] ?></td>
                                                                                <td><?= $value['tipo_mantenimiento'] ?></td>
                                                                                <td><?= $value['sistema'] ?></td>
                                                                                <td><?= $value['diagnostico'] ?></td>
                                                                                <td><?= $value['observacion'] ?></td>
                                                                                <td><?= $Estado ?></td>


                                                                            </tr>
                                                                        <?php endforeach ?>
                                                                    </tbody>
                                                                </table>
                                                            </div>


                                                            <!-- <div class="table-reponsive">
                                                                <table class="table table-responsive table-bordered table-striped text-center tablasBtnExport w-100">
                                                                    <thead class="text-nowrap">
                                                                        <th>...</th>
                                                                        <th># Orden</th>
                                                                        <th>Vehículo</th>
                                                                        <th>Fecha entrada</th>
                                                                        <th>Fecha salida</th>
                                                                        <th>Fecha inicios de trabajo</th>
                                                                        <th>Tipo de mantenimiento</th>
                                                                        <th>Sistema</th>
                                                                        <th>Diagnóstico</th>
                                                                        <th>Observación</th>
                                                                        <th>Estado</th>
                                                                    </thead>
                                                                    <tbody>
                                                                        
                                                                    </tbody>
                                                                </table>
                                                            </div> -->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--HISTORICO  -->
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
                </div> <!-- Programacion -->
            </div>
        </div>
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->



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
                                    <th>Stock</th>
                                    <th>Sucursal</th>
                                    <th>Posición</th>
                                    <th>Descripción</th>
                                    <th>Categoría</th>
                                    <th>Marca</th>
                                    <th>Medida</th>
                                    <th>Valor (Unitario)</th>
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

<!-- MODAL SOLICITUD  -->
<div class="modal fade show" id="modal-solicitud" arial-modal="true" role="dialog">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h4 class="modal-title">Resumen solicitud</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="col-12">
                        <div class="table-responsive">
                            <table class="table table-sm table-striped table-bordered dt-responsive text-center table-hover  w-100">
                                <thead class="text-nowrap">
                                    <th>Placa</th>
                                    <th>Número interno</th>
                                    <th>Repuestos</th>
                                    <th>Servicios externos</th>
                                    <th>Fecha entrada</th>
                                    <th>Fecha de la solicitud</th>

                                </thead>
                                <tbody id="tbodyResumen" class="text-nowrap">
                                    <tr>

                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="card card-outline">
                            <div class="card-body" id="diagnosticoResu">

                            </div>
                        </div>

                        <div class="card card-outline">
                            <div class="card-body" id="servExternosResu">

                            </div>
                        </div>
                        <div class="card card-outline">
                            <div class="card-body" id="RepuestoResu">

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>

<!-- MODAL PARA GENERAL -->
<div class="modal fade show" id="modal-servicios" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h4 class="modal-title">Seleccione un servicio</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>


            <div class="table-responsive">
                <table id="tablaServicios" class="table table-sm table-striped table-bordered dt-responsive text-center table-hover  w-100">
                    <thead class="text-nowrap">
                        <th>Servicio</th>
                        <th>Selección</th>
                    </thead>
                    <tbody id="tBodyServicios" class="text-nowrap">

                    </tbody>
                </table>
            </div>


            <!-- <div class="card-body" id="Card-bodygeneral">
                 <div class="form-group text-center">
                        <label>Lista de servicios</label>
                        <select id="ServPre" class="form-control select2-single" style="width: 99%" name="serviciosPrev[]">
                        </select>
                        </div>
            </div> -->

            <!-- <div class="modal-footer">
                <button type="button" class="btn btn-success">Guardar</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
            </div> -->

        </div>
    </div>
</div>

<!-- MODAL SISTEMA -->
<div class="modal fade show" id="modal-sistema" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h4 class="modal-title ">Seleccione un sistema</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>


            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm table-striped table-bordered dt-responsive text-center table-hover  w-100">
                        <thead>
                            <th>Sistema</th>
                            <th>Selección</th>
                        </thead>
                        <tbody class="text-nowrap">
                            <tr>
                                <td>Sistema motor</td>
                                <td>
                                    <div class='btn-group' role='group' aria-label='Button group'>
                                        <button data-toggle='tooltip' data-placement='top' title='Seleccionar sistema' class='btn btn-sm btn-success btn-SeleccionarSistema' nombre="Sistema motor"><i class='fas fa-check'></i></button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Sistema transmisión</td>
                                <td>
                                    <div class='btn-group' role='group' aria-label='Button group'>
                                        <button data-toggle='tooltip' data-placement='top' title='Seleccionar sistema' class='btn btn-sm btn-success btn-SeleccionarSistema' nombre="Sistema transmisión"><i class='fas fa-check'></i></button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Sistema de frenos y llantas</td>
                                <td>
                                    <div class='btn-group' role='group' aria-label='Button group'>
                                        <button data-toggle='tooltip' data-placement='top' title='Seleccionar sistema' class='btn btn-sm btn-success btn-SeleccionarSistema' nombre="Sistema de frenos y llantas"><i class='fas fa-check'></i></button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Sistema eléctrico</td>
                                <td>
                                    <div class='btn-group' role='group' aria-label='Button group'>
                                        <button data-toggle='tooltip' data-placement='top' title='Seleccionar sistema' class='btn btn-sm btn-success btn-SeleccionarSistema' nombre="Sistema eléctrico"><i class='fas fa-check'></i></button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Sistema de suspensión</td>
                                <td>
                                    <div class='btn-group' role='group' aria-label='Button group'>
                                        <button data-toggle='tooltip' data-placement='top' title='Seleccionar sistema' class='btn btn-sm btn-success btn-SeleccionarSistema' nombre="Sistema de suspensión"><i class='fas fa-check'></i></button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Sistema de dirección</td>
                                <td>
                                    <div class='btn-group' role='group' aria-label='Button group'>
                                        <button data-toggle='tooltip' data-placement='top' title='Seleccionar sistema' class='btn btn-sm btn-success btn-SeleccionarSistema' nombre="Sistema de dirección"><i class='fas fa-check'></i></button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Carrocería</td>
                                <td>
                                    <div class='btn-group' role='group' aria-label='Button group'>
                                        <button data-toggle='tooltip' data-placement='top' title='Seleccionar sistema' class='btn btn-sm btn-success btn-SeleccionarSistema' nombre="Carrocería"><i class='fas fa-check'></i></button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Sistema diferencial</td>
                                <td>
                                    <div class='btn-group' role='group' aria-label='Button group'>
                                        <button data-toggle='tooltip' data-placement='top' title='Seleccionar sistema' class='btn btn-sm btn-success btn-SeleccionarSistema' nombre="Sistema diferencial"><i class='fas fa-check'></i></button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>General vehículo</td>
                                <td>
                                    <div class='btn-group' role='group' aria-label='Button group'>
                                        <button data-toggle='tooltip' data-placement='top' title='Seleccionar sistema' class='btn btn-sm btn-success btn-SeleccionarSistema' nombre="General vehículo"><i class='fas fa-check'></i></button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Logístico</td>
                                <td>
                                    <div class='btn-group' role='group' aria-label='Button group'>
                                        <button data-toggle='tooltip' data-placement='top' title='Seleccionar sistema' class='btn btn-sm btn-success btn-SeleccionarSistema' nombre="Logístico"><i class='fas fa-check'></i></button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Aire acondicionado</td>
                                <td>
                                    <div class='btn-group' role='group' aria-label='Button group'>
                                        <button data-toggle='tooltip' data-placement='top' title='Seleccionar sistema' class='btn btn-sm btn-success btn-SeleccionarSistema' nombre="Aire acondicionado"><i class='fas fa-check'></i></button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- <select name="sistmanoObra" id="sistmanoObra" class="form-control select2-single" type="number" style="width: 99%" required>
                    <option selected value="">Seleccione el sistema</option>
                    <option>Sistema motor</option>
                    <option>Sistema transmisión</option>
                    <option>Sistema de frenos y llantas</option>
                    <option>Sistema eléctrico</option>
                    <option>Sistema de suspensión</option>
                    <option>Sistema de dirección</option>
                    <option>Carrocería</option>
                    <option>Sistema diferencial</option>
                    <option>General vehículo</option>
                    <option">Logístico</option>
                    <option">Aire acondicionado</option>
                </select> -->
            </div>

            <!-- <div class="modal-footer">
                <button type="button" class="btn btn-success">Guardar</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
            </div> -->

        </div>
    </div>
</div>

<!-- SELECCIONAR MANTENIMIENTO -->
<div class="modal fade show" id="modal-mantenimiento" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h4 class="modal-title ">Seleccione el mantenimiento</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <!-- <div class="card">
                <div class="card-body">
                    <select id="tipo_mantenimiento" name="tipo_mantenimiento" class="form-control select2-single" type="number" style="width: 99%" required>
                        <option selected value="">Seleccione un tipo de mantenimiento</option>
                        <option>Preventivo</option>
                        <option>Correctivo</option>
                        <option>GPS</option>
                        <option>Servicios logísticos</option>
                    </select>
                </div>
            </div> -->

            <div class="card">
                <div class="table-responsive">
                    <table class="table table-sm table-striped table-bordered dt-responsive text-center table-hover  w-100">
                        <thead>
                            <th>Mantenimiento</th>
                            <th>Selección</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Preventivo</td>
                                <td>
                                    <div class='btn-group' role='group' aria-label='Button group'>
                                        <button data-toggle='tooltip' data-placement='top' title='Seleccionar mantenimiento' class='btn btn-sm btn-success btn-SeleccionarMantenimiento' nombre="Preventivo"><i class='fas fa-check'></i></button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Correctivo</td>
                                <td>
                                    <div class='btn-group' role='group' aria-label='Button group'>
                                        <button data-toggle='tooltip' data-placement='top' title='Seleccionar mantenimiento' class='btn btn-sm btn-success btn-SeleccionarMantenimiento' nombre="Correctivo"><i class='fas fa-check'></i></button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>GPS</td>
                                <td>
                                    <div class='btn-group' role='group' aria-label='Button group'>
                                        <button data-toggle='tooltip' data-placement='top' title='Seleccionar mantenimiento' class='btn btn-sm btn-success btn-SeleccionarMantenimiento' nombre="GPS"><i class='fas fa-check'></i></button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Servicios logísticos</td>
                                <td>
                                    <div class='btn-group' role='group' aria-label='Button group'>
                                        <button data-toggle='tooltip' data-placement='top' title='Seleccionar mantenimiento' class='btn btn-sm btn-success btn-SeleccionarMantenimiento' nombre="Servicios logísticos"><i class='fas fa-check'></i></button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-success">Guardar</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
            </div>

        </div>
    </div>
</div>