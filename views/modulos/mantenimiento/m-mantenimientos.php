<?php

if (!validarPermiso('M_MANTENIMIENTO', 'R')) {
    echo "<script> window.location = '" . URL_APP . "'; </script>";
}

$Placas = ControladorVehiculos::ctrListaVehiculos();
$Servicios = ControladorVehiculos::ctrListadoServicios();
$Productos = ControladorMantenimientos::ctrListadoProductos();
$ServExt = ControladorMantenimientos::ctrListadoServiciosExternos();
$tiposDocumentacion = ControladorVehiculos::ctrTiposDocumentacion();
$OrdenesServicio = ControladorMantenimientos::ctrListadoOrdenesServicio();
$Correctivos = ControladorVehiculos::ctrListadoCorrectivos();
$DeparMunicipios = ControladorGH::ctrDeparMunicipios();
$Empresas = ControladorConvenios::ctrMostrar();
$clientes = ControladorClientes::ctrVerCliente("clientes");
$cuentas = ControladorMantenimientos::ctrListaCuentasContables();
$Programacion = ControladorMantenimientos::ctrListaProgramacion();


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
                        <!-- <li class="nav-item border border-info rounded ml-2 mb-1 mb-md-0">
                            <a class="nav-link h4" id="pills-rutinas-tab" data-toggle="tab" href="#pills-rutinas" role="tab" aria-controls="pills-rutinas" aria-selected="false">Rutinas <i class="fas fa-clipboard-check"></i></a>
                        </li> -->

                        <li class="nav-item border border-info rounded ml-2 mb-1 mb-md-0">
                            <a class="nav-link h4" id="pills-programacion-tab" data-toggle="tab" href="#pills-programacion" role="tab" aria-controls="pills-programacion" aria-selected="false">Programación <i class="far fa-calendar-alt"></i></a>
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

            <!-- ===================== 
              AGREGAR FILAS Y COLUMNAS PARA EL DESARROLLO 
            ========================= -->

            <div class="tab-content" id="pills-tabcontent">
                <div class="tab-pane fade show active" id="pills-ordenserv" role="tabpanel" aria-labelledby="pills-ordenserv-tab">
                    <div class="row">
                        <div class="col-12 col-sm-6 col-lg-12">
                            <div class="card card-info">
                                <div class="card-header">
                                    <ul class="nav nav-tabs card-header-tabs" id="custom-tabs-one-tab" role="tablist">
                                        <!-- <li class="nav-item">
                                         <a class="nav-link active" id="custom-tabs-one-solicitudserv_exter_repues-tab" data-toggle="pill" href="#custom-tabs-one-solicitudserv_exter_repues" role="tab" aria-controls="custom-tabs-one-solicitudserv_exter_repues" aria-selected="false">Solicitud de servicio / Repuestos</a>
                                        </li> -->
                                        <li class="nav-item ">
                                            <!-- TABS HORIZONTALES-->
                                            <a class="nav-link active" id="custom-tabs-one-ordenserv_mante-tab" data-toggle="pill" href="#custom-tabs-one-ordenserv_mante" role="tab" aria-controls="custom-tabs-one-ordenserv_mante" aria-selected="true"><i class="fas fa-envelope-open-text"></i> Orden de servicio / Mantenimiento</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="custom-tabs-one-historial_orden-tab" data-toggle="pill" href="#custom-tabs-one-historial_orden" role="tab" aria-controls="custom-tabs-one-historial_orden" aria-selected="false"><i class="fas fa-history"></i> Historial ordenes de servicio</a>
                                        </li>
                                        <li>
                                            <a class="nav-link" id="custom-tabs-one-control-tab" data-toggle="pill" href="#custom-tabs-one-control" role="tab" aria-controls="custom-tabs-one-control" aria-selected="false"><i class="fas fa-tasks"></i> Control de actividades</a>
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

                                                <div class="row">
                                                    <!-- NAV Y BOTOENES DE GUARDAR Y RESTABLECER -->
                                                    <div class="col-lg-3 col-sm-6">

                                                        <!-- NAVBAR VERTICAL -->
                                                        <nav class="navbar navbar-expand-lg">
                                                            <button class="navbar-toggler navbar-light bg-light" type="button" data-toggle="collapse" data-target="#ContenidoOrdenServicio" aria-controls="ContenidoOrdenServicio" aria-expanded="false" aria-label="Toggle navigation">
                                                                <span class="navbar-toggler-icon "></span>
                                                            </button>

                                                            <div class="collapse navbar-collapse" id="ContenidoOrdenServicio">
                                                                <div class=" nav nav-tabs navbar-expand-lg flex-column nav-pills " id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                                                    <a class="nav-link active border-bottom rounded text-dark" id="v-pills-general-tab" data-toggle="pill" href="#v-pills-general" role="tab" aria-controls="v-pills-general" aria-selected="true"><i class="fas fa-info-circle"></i><strong> Datos generales</strong></a>
                                                                    <a class="nav-link border-bottom rounded text-dark" id="v-pills-diagnostico-tab" data-toggle="pill" href="#v-pills-diagnostico" role="tab" aria-controls="v-pills-diagnostico" aria-selected="false"><i class="far fa-file-alt"></i><strong> Diagnóstico</strong> </a>
                                                                    <a class="nav-link border-bottom rounded text-dark" id="v-pills-repuestos-tab" data-toggle="pill" href="#v-pills-repuestos" role="tab" aria-controls="v-pills-repuestos" aria-selected="false"><i class="fas fa-screwdriver"></i><strong> Repuestos / Mano de obra</strong> </a>
                                                                    <!-- <a class="nav-link border-bottom rounded" id="v-pills-manoObra-tab" data-toggle="pill" href="#v-pills-manoObra" role="tab" aria-controls="v-pills-manoObra" aria-selected="false"><b><i class="fas fa-fist-raised"></i> Mano de obra</b></a> -->
                                                                    <!-- <a class="nav-link border-bottom rounded" id="v-pills-observaciones-tab" data-toggle="pill" href="#v-pills-observaciones" role="tab" aria-controls="v-pills-observaciones" aria-selected="false"><b><i class="far fa-comment-alt"></i> Observaciones</b></a> -->
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

                                                        <div class="col-9 mt-3">
                                                            <button type="submit" id="guardar_orden" form="ordenServ_form" class="btn btn-success mb-2 col fileinput-button dz-clickable">
                                                                <i class="fas fa-plus"></i>
                                                                <span>Guardar</span>
                                                            </button>

                                                            <button type="reset" class="btn btn-warning col cancel mb-2" id="btn-restablecer">
                                                                <i class="fas fa-broom"></i>
                                                                <span>Restablecer</span>
                                                            </button>
                                                            <button class="btn btn-secondary col invisible " id="btn-crearSolicitud" data-toggle="modal" data-target="#modal-solicitud" disabled>
                                                                <i class="far fa-file-alt"></i>
                                                                <span> Crear solicitud de servicio</span>
                                                            </button>

                                                        </div>





                                                    </div>
                                                    <div class="col-lg-9 col-sm-12">


                                                        <!-- ==============================================================================================
                                                         *********************************** ORDEN DE SERVICIO MANTENIMIENTO ***************************
                                                        ==================================================================================================== -->
                                                        <div class="tab-content" id="v-pills-tabContent">

                                                            <!-- DATOS GENERALES -->
                                                            <div class="tab-pane fade show active " id="v-pills-general" role="tabpanel" aria-labelledby="v-pills-general-tab" nombre="Datos generales" style="overflow-y: scroll; height: 600px; overflow-x: hidden;">
                                                                <div class="row">

                                                                    <div class="col-3 ">
                                                                        <div class="form-group text-center">
                                                                            <label><i># Orden de servicio</i></label>
                                                                            <input type="text" class="form-control form-control-sm" id="numOrden_ordSer" name="numOrden_ordSer" readonly>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-3 ">
                                                                        <div class="form-group text-center">
                                                                            <label><i>Placa</i></label>
                                                                            <select id="placa_OrdServ" name="idvehiculo_OrdServ" class="form-control form-control-sm select2-single" type="number" style="width: 99%" required>
                                                                                <option selected value="">Seleccione un vehículo</option>
                                                                                <?php foreach ($Placas as $key => $value) : ?>
                                                                                    <option value="<?= $value['idvehiculo'] ?>"><?= $value['placa'] ?> - <?= $value['numinterno'] ?> </option>
                                                                                <?php endforeach ?>
                                                                            </select>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-3 ">
                                                                        <div class="form-group text-center">
                                                                            <label><i># Factura</i></label>
                                                                            <input type="text" class="form-control form-control-sm" id="numFactura_ordSer" name="numFactura_ordSer">
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-3 ">
                                                                        <div class="form-group text-center">
                                                                            <label><i>Ciudad</i></label>
                                                                            <select id="ciudad_OrdServ" name="ciudad_OrdServ" class="form-control form-control-sm select2-single" type="number" style="width: 99%" required>
                                                                                <option selected value="">Seleccione una ciudad</option>
                                                                                <?php foreach ($DeparMunicipios as $key => $value) : ?>
                                                                                    <option value="<?= $value['idmunicipio'] ?>"><?= $value['DeparMunic'] ?>
                                                                                    </option>
                                                                                <?php endforeach ?>
                                                                            </select>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-3 ">
                                                                        <div class="form-group text-center">
                                                                            <label><i>Número interno</i></label>
                                                                            <input type="text" class="form-control form-control-sm" id="numinterno_ordSer" name="numinterno_ordSer" required readonly>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-3 ">
                                                                        <div class="form-group text-center">
                                                                            <label><i>Cliente</i></label>
                                                                            <input type="text" class="form-control form-control-sm" id="cliente_orderServ" required readonly>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-3 ">
                                                                        <div class="form-group text-center">
                                                                            <label><i>Marca</i></label>
                                                                            <input type="text" class="form-control form-control-sm" id="marca_ordSer" name="marca_ordSer" required readonly>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-3 ">
                                                                        <div class="form-group text-center">
                                                                            <label><i>Clase de vehículo</i></label>
                                                                            <input type="text" class="form-control form-control-sm" id="clasevehiculo_ordSer" name="clasevehiculo_ordSer" required readonly>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-3 ">
                                                                        <div class="form-group text-center">
                                                                            <label><i>Modelo</i></label>
                                                                            <input type="text" class="form-control form-control-sm" id="modelo_ordSer" name="modelo_ordSer" required readonly>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-3 ">
                                                                        <div class="form-group text-center">
                                                                            <label><i>Kilometraje</i></label>
                                                                            <input type="number" class="form-control form-control-sm" id="kilome_ordSer" name="kilome_ordSer" required readonly>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-3 ">
                                                                        <div class="form-group text-center">
                                                                            <label><i>Fecha de entrada</i></label>
                                                                            <?php
                                                                            $fecha =  date('Y/m/d');
                                                                            ?>
                                                                            <input type="text" class="form-control form-control-sm" id="fechaentrada_ordSer" name="fechaentrada_OrdSer" value="<?= $fecha ?>" readonly>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-3 ">
                                                                        <div class="form-group text-center">
                                                                            <label><i>Hora de entrada</i></label>
                                                                            <input type="time" class="form-control form-control-sm" id="horaentra_ordSer" name="horaentra_ordSer" required>
                                                                        </div>
                                                                    </div>




                                                                    <div class="col-3 ">
                                                                        <div class="form-group text-center">
                                                                            <label><i>Fecha de inicio de trabajos</i></label>
                                                                            <input type="date" class="form-control form-control-sm" id="fechainicio_ordSer" name="fechaInic_ordSer">
                                                                        </div>
                                                                    </div>

                                                                    <!-- <input type="hidden" id="fecha_aprobacion" name="fecha_aprobacion"> -->




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
                                                                                                <div class="input-group">
                                                                                                    <input id="documento_<?= $value['idtipo'] ?>" type="date" class="form-control documentos" readonly>
                                                                                                    <div class="input-group-append">
                                                                                                        <button class="btn info-semaforotipo1" type="button">
                                                                                                            <i class="fas fa-exclamation-triangle"></i>

                                                                                                        </button>
                                                                                                    </div>
                                                                                                </div>
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
                                                                        <h3 class="card-title"><b><i>Programación</i></b>
                                                                            <i class="far fa-calendar-alt"></i>
                                                                        </h3>
                                                                        <div class="card-tools">
                                                                            <button type="button" title="Abrir programación del vehículo" data-toggle="tooltip" data-placement="top" class="btn btn-tool" data-card-widget="collapse">
                                                                                <i class="fas fa-plus"></i>
                                                                            </button>
                                                                        </div>
                                                                    </div>

                                                                    <div class="card-body" style="display: none;">
                                                                        <div class="row">
                                                                            <div class="col-lg-12 col-sm-12 justify-content-center">
                                                                                <div class="table-responsive">
                                                                                    <table id="tablaProgramacionServ" class="datatable-multi-row table table-sm table-striped table-hover table-bordered text-center w-100">
                                                                                        <thead class="text-nowrap">
                                                                                            <th>Kilometraje</th>
                                                                                            <th>Actividad</th>
                                                                                            <th>Kilometraje para cambio</th>
                                                                                            <th>Fecha para cambio</th>
                                                                                            <th>Evidencia</th>
                                                                                            <th>Fecha de programación</th>
                                                                                        </thead>
                                                                                        <tbody id="tbodyProgramacionServ" class="text-nowrap">


                                                                                        </tbody>
                                                                                    </table>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>


                                                                    <!-- <div class="card-body" style="display: none;">
                                                                        <div class="row">
                                                                            <div class="col-lg-12 col-sm-12 justify-content-center">
                                                                                <div class="card card-outline card-success">
                                                                                    <div class="table-responsive">
                                                                                        <table id="tablaEvidenciasServ" class="table table-sm table-striped table-bordered dt-responsive text-center table-hover  w-100">
                                                                                            <thead class="text-nowrap">
                                                                                                <th>Fecha</th>
                                                                                                <th>Imágenes de evidencia</th>
                                                                                                <th>Observaciones</th>
                                                                                                <th>Estado</th>
                                                                                                <th>Autor</th>
                                                                                            </thead>
                                                                                            <tbody id="tbodyEvidenciaServ" class="text-nowrap">


                                                                                            </tbody>
                                                                                        </table>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div> -->
                                                                    <!--CARD BODY-->
                                                                </div>
                                                            </div>
                                                            <!-- DIAGNÓSTICO -->
                                                            <div class="tab-pane fade" id="v-pills-diagnostico" role="tabpanel" aria-labelledby="v-pills-diagnostico-tab" nombre="Diagnóstico">
                                                                <div class="callout callout-info col-md-12 col-sm-8">
                                                                    <div class="row">
                                                                        <div class="col-md-12 col-sm-9 ">
                                                                            <div class="form-group text-center" id="diagnostico_solicitud">
                                                                                <label>Diágnostico</label>
                                                                                <textarea class="form-control diagno-resu" name="diagnostico" rows="3" placeholder="Digite una leve diágnostico ..." required></textarea>
                                                                            </div>
                                                                            <div class="form-group text-center">
                                                                                <label>Digite su observación</label>
                                                                                <textarea class="form-control" rows="3" id="observacion" name="observacion" placeholder="Digite una leve observación"></textarea>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- REPUESTOS / SOLICITUD SERVICIO -->
                                                            <div class="tab-pane fade" id="v-pills-repuestos" role="tabpanel" aria-labelledby="v-pills-repuestos-tab" style="overflow-y: scroll; height: 600px;">



                                                                <!-- SERVICIOS EXTERNOS COLLAPSE -->
                                                                <div class="card card-info collapsed-card" id="card-serviciosext">
                                                                    <div class="card-header" data-card-widget="collapse" style="cursor:pointer; ">
                                                                        <h3 class="card-title"><b><i>Servicios externos</i></b>
                                                                            <i class="fas fa-boxes"></i>
                                                                        </h3>
                                                                        <div class="card-tools">
                                                                            <button type="button" title="Abrir servicios externos" data-toggle="tooltip" data-placement="top" class="btn btn-tool" data-card-widget="collapse">
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
                                                                </div>

                                                                <!-- REPUESTO COLLAPSE -->
                                                                <div class="card card-info collapsed-card" id="card-repuesto">
                                                                    <div class="card-header" data-card-widget="collapse" style="cursor:pointer;">
                                                                        <h3 class="card-title"><b><i>Repuesto</i></b>
                                                                            <i class="fas fa-tools nav-icon"></i>
                                                                        </h3>
                                                                        <div class="card-tools">
                                                                            <button type="button" title="Abrir repuesto" data-toggle="tooltip" data-placement="top" class="btn btn-tool" data-card-widget="collapse">
                                                                                <i class="fas fa-plus"></i>
                                                                            </button>
                                                                        </div>
                                                                    </div>

                                                                    <div class="card-body" style="display: none;">
                                                                        <div class="row d-flex justify-content-center">
                                                                            <div class="table-responsive" id="repuesto_solicitud" style="font-size: 12px;">
                                                                                <table class="table table-bordered table-striped text-center text-nowrap" id="tabla_repuesto_orden">
                                                                                    <thead>
                                                                                        <tr>
                                                                                            <th style="min-width:300px;">REPUESTO</th>
                                                                                            <th>REFERENCIA</th>
                                                                                            <th>CÓDIGO</th>
                                                                                            <th>VALOR UNITARIO</th>
                                                                                            <th>CANTIDAD</th>
                                                                                            <th style="min-width: 100px;">IVA %</th>
                                                                                            <th style="min-width: 200px;">TOTAL</th>
                                                                                            <th style="min-width: 200px;">PROVEEDOR</th>
                                                                                            <th style="min-width: 300px;">DIAGNÓSTICO</th>
                                                                                            <th style="min-width: 300px;">TIPO DE SISTEMA</th>
                                                                                            <th style="min-width: 300px;">TIPO DE MANTENIMIENTO</th>
                                                                                            <!-- <th style="min-width: 300px;">CÓDIGO CUENTA CONTABLE</th> -->
                                                                                        </tr>
                                                                                    </thead>
                                                                                    <tbody id="filas_tabla_repuestoSolicitud">
                                                                                        <tr id="contenido_filas_repuestoSolicitud" consecutivo="1">
                                                                                            <td style="width: 900px;">
                                                                                                <div class="input-group">
                                                                                                    <input class="form-control form-control-sm" type="text" id="repuesto_1" name="repuesto[]" placeholder="Seleccione un repuesto" maxlength="0">
                                                                                                    <div class="input-group-append">
                                                                                                        <button type="button" class="btn btn-success btn-sm btn-md btn-repuestos" consecutivo="1" title="lista repuestos" data-toggle="modal" data-target="#modal-repuestos"><i class="fas fa-business-time"></i></button>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </td>
                                                                                            <input type="hidden" id="inventario_1" name="inventario[]">
                                                                                            <td> <input type="text" class="form-control form-control-sm" id="refrepuestos_1" name="referencia_repuesto[]" readonly></td>
                                                                                            <td> <input type="text" class="form-control form-control-sm" id="codrepuestos_1" name="codigo_repuesto[]" readonly></td>
                                                                                            <td> <input type="text" class="form-control form-control-sm input-valorrepuesto" id="valorrepuestos_1" consecutivo="1" name="valor_repuesto[]"></td>
                                                                                            <td> <input type="text" class="form-control form-control-sm input-cantrepuesto" consecutivo="1" id="cantrepuestos_1" name="cantidad_repuesto[]" readonly></td>
                                                                                            <td> <input type="text" class="form-control form-control-sm input-ivarepuesto" id="iva_repuesto_1" consecutivo="1" name="iva_repuesto[]"></td>
                                                                                            <td> <input type="text" class="form-control form-control-sm" id="total_repuesto_1" name="total_repuesto[]" readonly></td>
                                                                                            <input type="hidden" name="idproveedor_repuesto[]" id="idproveedor_repuesto_1">
                                                                                            <td><input type="text" class="form-control form-control-sm" id="proveedor_repuesto_1" name="proveedor_repuesto[]" readonly></td>
                                                                                            <td>
                                                                                                <input type="hidden" id="servicio_repuesto_1" name="servicio_repuesto[]">
                                                                                                <div class="input-group">
                                                                                                    <input class="form-control form-control-sm" type="text" id="servrepuesto_1" name="servrepuesto[]" placeholder="Seleccione un servicio" maxlength="0">
                                                                                                    <div class="input-group-append">
                                                                                                        <button type="button" class="btn btn-sm btn-success btn-md btn-servicios" seccion="repuesto" consecutivo="1" title="lista de servicios" data-toggle="modal" data-target="#modal-servicios"><i class="fab fa-cloudsmith"></i></button>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </td>
                                                                                            <td style="width: 900px;">
                                                                                                <div class="input-group">
                                                                                                    <input class="form-control form-control-sm" type="text" id="sistemarepuesto_1" name="sistemarepuesto[]" placeholder="Seleccione el tipo de sistema" maxlength="0">
                                                                                                    <div class="input-group-append">
                                                                                                        <button type="button" class="btn btn-sm btn-success btn-md btn-sistema" seccion="repuesto" consecutivo="1" title="lista de sistemas" data-toggle="modal" data-target="#modal-sistema"><i class="fas fa-drafting-compass"></i></button>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </td>
                                                                                            <td style="width: 900px;">
                                                                                                <div class="input-group">
                                                                                                    <input class="form-control form-control-sm" type="text" id="mantenimientorepuesto_1" name="mantenimientorepuesto[]" placeholder="Seleccione un mantenimiento" maxlength="0">
                                                                                                    <div class="input-group-append">
                                                                                                        <button type="button" class="btn btn-success btn-sm btn-md btn-mantenimiento" seccion="repuesto" consecutivo="1" title="lista de mantenimientos" data-toggle="modal" data-target="#modal-mantenimiento"><i class="fas fa-wrench"></i></button>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </td>
                                                                                            <td style="display: none;">
                                                                                                <input type="hidden" id="idcuenta_repuesto_1" name="idcuenta[]">
                                                                                                <div class="input-group">
                                                                                                    <input class="form-control form-control-sm" type="text" id="cuenta_repuesto_1" name="cuenta_repuesto[]" placeholder="Seleccione una cuenta" maxlength="0">
                                                                                                    <div class="input-group-append">
                                                                                                        <button type="button" class="btn btn-success btn-sm btn-md btn-cuenta" seccion="repuesto" consecutivo="1" title="lista de cuentas" data-toggle="modal" data-target="#modal-cuentas"><i class="fas fa-money-check-alt"></i></button>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </td>
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



                                                                </div>

                                                                <!-- MANO DE OBRA COLLAPSE -->
                                                                <div class="card card-info collapsed-card" id="card-manoObra">
                                                                    <div class="card-header" data-card-widget="collapse" style="cursor:pointer;">
                                                                        <h3 class="card-title"><b><i>Mano de obra</i></b>
                                                                            <i class="fas fa-fist-raised"></i>
                                                                        </h3>
                                                                        <div class="card-tools">
                                                                            <button type="button" title="Abrir mano de obra" data-toggle="tooltip" data-placement="top" class="btn btn-tool" data-card-widget="collapse">
                                                                                <i class="fas fa-plus"></i>
                                                                            </button>
                                                                        </div>
                                                                    </div>

                                                                    <div class="card-body" style="display: none;">
                                                                        <div class="row d-flex justify-content-center">

                                                                            <div class="table-responsive" style="font-size: 12px;">
                                                                                <table class="table table table-responsive table-bordered table-striped text-center text-nowrap">
                                                                                    <thead>
                                                                                        <tr>
                                                                                            <th style="min-width:300px;">PROVEEDOR</th>
                                                                                            <th style="min-width:300px;">ITEM</th>
                                                                                            <th>VALOR UNITARIO</th>
                                                                                            <th>CANTIDAD</th>
                                                                                            <th style="min-width:100px">IVA %</th>
                                                                                            <th style="min-width: 200px;">TOTAL</th>
                                                                                            <th style=" min-width:300px;">DIAGNÓSTICO</th>
                                                                                            <th style="min-width:300px;">TIPO DE SISTEMA</th>
                                                                                            <th style="min-width:300px;">TIPO DE MANTENIMIENTO</th>
                                                                                            <!-- <th style="min-width:300px;">CÓDIGO CUENTA CONTABLE</th> -->
                                                                                        </tr>
                                                                                    </thead>
                                                                                    <tbody id="filas_tabla_manoObra">
                                                                                        <tr id="Contenido_tabla_manoObra" consecutivo="1">
                                                                                            <td style="width: 600px">
                                                                                                <div class="input-group">
                                                                                                    <input class="form-control form-control-sm" type="text" id="proveedor_1" placeholder="Seleccione un proveedor" maxlength="0">
                                                                                                    <div class=" input-group-append">
                                                                                                        <button type="button" class="btn btn-sm btn-success btn-md btn-proveedor" consecutivo="1" title="lista proveedores" data-toggle="modal" data-target="#modal-proveedores"><i class="fas fa-parachute-box"></i></button>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </td>
                                                                                            <input type="hidden" id="idproveedor_1" name="proveedor[]">
                                                                                            <td style="width: 300px"><input type="text" class="form-control form-control-sm" id="descrip_1" name="descrip_mano[]"></td>
                                                                                            <td style="width: 300px"><input type="text" class="form-control form-control-sm input-valorMano" consecutivo="1" id="valor_1" name="valor_mano[]"></td>
                                                                                            <td style="width: 300px"><input type="text" class="form-control form-control-sm input-cantMano" id="cantmanoObra_1" name="cantmanoObra[]" consecutivo="1" readonly></td>
                                                                                            <td><input type="text" class="form-control form-control-sm input-ivaMano" id="iva_mano_1" name="iva_mano[]" consecutivo="1"></td>
                                                                                            <td><input type="text" class="form-control form-control-sm" id="total_mano_1" name="total_mano[]" readonly></td>
                                                                                            <td style="width: 300px">
                                                                                                <input type="hidden" id="servicio_mano_1" name="servicio_mano[]">
                                                                                                <div class="input-group">
                                                                                                    <input class="form-control form-control-sm" type="text" id="servmanoObra_1" name="servmanoObra[]" placeholder="Seleccione un servicio" maxlength="0">
                                                                                                    <div class=" input-group-append">
                                                                                                        <button type="button" class="btn btn-sm btn-success btn-md btn-servicios" seccion="manoObra" consecutivo="1" title="lista de servicios" data-toggle="modal" data-target="#modal-servicios"><i class="fab fa-cloudsmith"></i></button>
                                                                                                    </div>
                                                                                                </div>

                                                                                            </td>
                                                                                            <td style="width: 900px;">
                                                                                                <div class="input-group">
                                                                                                    <input class="form-control form-control-sm" type="text" id="sistemanoObra_1" name="sistmanoobra[]" placeholder="Seleccione el tipo de sistema" maxlength="0">
                                                                                                    <div class=" input-group-append">
                                                                                                        <button type="button" class="btn btn-sm btn-success btn-md btn-sistema" seccion="manoObra" consecutivo="1" title="lista de sistemas" data-toggle="modal" data-target="#modal-sistema"><i class="fas fa-drafting-compass"></i></button>
                                                                                                    </div>
                                                                                                </div>

                                                                                            </td>
                                                                                            <td style="width: 900px;">
                                                                                                <div class="input-group">
                                                                                                    <input class="form-control form-control-sm" type="text" id="mantenimientoManoObra_1" name="mantenimientomanobra[]" placeholder="Seleccione un mantenimiento" maxlength="0">
                                                                                                    <div class="input-group-append">
                                                                                                        <button type="button" class="btn btn-sm btn-success btn-md btn-mantenimiento" seccion="manoObra" consecutivo="1" title="lista de mantenimientos" data-toggle="modal" data-target="#modal-mantenimiento"><i class="fas fa-wrench"></i></button>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </td>
                                                                                            <td style="display: none;">
                                                                                                <input type="hidden" id="idcuenta_mano_1" name="idcuenta_mano[]">
                                                                                                <div class="input-group">
                                                                                                    <input class="form-control form-control-sm" type="text" id="cuenta_mano_1" name="cuenta_mano[]" placeholder="Seleccione una cuenta" maxlength="0">
                                                                                                    <div class="input-group-append">
                                                                                                        <button type="button" class="btn btn-sm btn-success btn-md btn-cuenta" seccion="manoObra" consecutivo="1" title="lista de cuentas" data-toggle="modal" data-target="#modal-cuentas"><i class="fas fa-money-check-alt"></i></button>
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




                                                                </div>

                                                                <!-- <div class=" col-md-6 d-md-flex justify-content-md-end mb-3">
                                                                    <button class="btn btn-secondary col" id="btn-crearSolicitud" data-toggle="modal" data-target="#modal-solicitud" disabled>
                                                                        <i class="far fa-file-alt"></i>
                                                                        <span>Crear solicitud de servicio</span>
                                                                    </button>
                                                                </div> -->
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
                                                            <!-- <div class="tab-pane fade" id="v-pills-observaciones" role="tabpanel" aria-labelledby="v-pills-observaciones-tab">
                                                                <div class="card-body">
                                                                    <div class="callout callout-info">
                                                                        <h5>Digite su observación</h5>
                                                                        <textarea class="form-control" rows="5" id="observacion" name="observacion"></textarea>
                                                                    </div>

                                                                </div>
                                                            </div> -->

                                                        </div>
                                                    </div>

                                                </div>
                                                <!-- =====================================
                                                    ************BOTONES *****************
                                                    ========================================== -->
                                                <!-- <div class="row d-flex justify-content-center">
                                                    <div class="col-md-6">
                                                        <div class="btn-group w-100">
                                                            <button type="submit" form="ordenServ_form" class="btn btn-success col fileinput-button dz-clickable">
                                                                <i class="fas fa-plus"></i>
                                                                <span>Guardar</span>
                                                            </button>

                                                            <button type="reset" class="btn btn-warning col cancel" id="btn-restablecer">
                                                                <i class="fas fa-broom"></i>
                                                                <span>Restablecer</span>
                                                            </button>



                                                        </div>
                                                    </div>
                                                </div> -->
                                            </form>
                                        </div>

                                        <!-- HISTORICO DE ORDENES DE SERVICIO -->
                                        <div class="tab-pane fade" id="custom-tabs-one-historial_orden" role="tabpanel" aria-labelledby="custom-tabs-one-historial_orden-tab">
                                            <div class="card-body">
                                                <div class="col-12">
                                                    <div class="card card-outline card-success">
                                                        <div class="card-body">

                                                            <div class="table-responsive" style="font-size: 14px;">
                                                                <table class="table table-bordered text-center tablasBtnExport">
                                                                    <thead class="text-nowrap">
                                                                        <tr>
                                                                            <th>...</th>
                                                                            <th># Orden</th>
                                                                            <th>Vehículo</th>
                                                                            <th>Fecha entrada</th>
                                                                            <th>Fecha salida</th>
                                                                            <th>Fecha inicios de trabajo</th>
                                                                            <th>Diagnóstico</th>
                                                                            <th>Ciudad</th>
                                                                            <th>Observación</th>
                                                                            <th>Estado</th>
                                                                            <th>Emitida</th>
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
                                                                                <td><button class="btn btn-outline-dark btn-pdforden bg-secondary" title="Ver PDF Orden." data-toggle="tooltip" data-placement="top" idorden="<?= $value['idorden'] ?>" tipo_mantenimiento="orden"><i class="fas fa-file-pdf"></i></button></td>
                                                                                <td><button class="btn btn-outline-dark btn-editarOrden" idorden="<?= $value['idorden'] ?>" title="Ir a la orden" data-toggle="tooltip" data-placement="top" type="button"><?= $value['idorden'] ?></button></td>
                                                                                <td><?= $value['placa'] ?></td>
                                                                                <td><?= $value['Ffecha_entrada'] ?></td>
                                                                                <td><?= $value['Ffecha_aprobacion'] ?></td>
                                                                                <td><?= $value['Ffecha_trabajos'] ?></td>
                                                                                <td><?= $value['diagnostico'] ?></td>
                                                                                <td><?= $value['municipio'] ?></td>
                                                                                <td><?= $value['observacion'] ?></td>
                                                                                <td><?= $Estado ?></td>
                                                                                <td><?= $value['Nombre'] ?></td>


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

                                        <!-- CONTROL DE ACTIVIDADES TAB -->
                                        <div class="tab-pane fade" id="custom-tabs-one-control" role="tabpanel" aria-labelledby="custom-tabs-one-control-tab">
                                            <div class="card-body">
                                                <div class="col-12">
                                                    <div class="card card-outline card-success">
                                                        <div class="card-body">

                                                            <div class="table-responsive" style="font-size: 14px;">
                                                                <!-- <table id="tableControlActividades" class="datatable-multi-row table table-sm table-striped table-hover table-bordered text-center w-100">
                                                                    <thead class="text-nowrap">
                                                                        <tr>
                                                                            <th># Orden</th>
                                                                            <th>Vehículo</th>
                                                                            <th>Kilometraje</th>
                                                                            <th>Cliente</th>
                                                                            <th># Factura</th>
                                                                            <th>Ciudad</th>
                                                                            <th>Fecha de solicitud</th>
                                                                            <th>Fecha ejecución</th>
                                                                            <th>Fecha entrega</th>
                                                                            <th>Diagnóstico</th>
                                                                            <th>Proveedor</th>
                                                                            <th>Item</th>
                                                                            <th>Descripción</th>
                                                                            <th>Sistema</th>
                                                                            <th>Cantidad</th>
                                                                            <th>Precio unitario</th>
                                                                            <th>Iva</th>
                                                                            <th>Cliente</th>
                                                                            <th>% que asume</th>
                                                                            <th>Empresa</th>
                                                                            <th>% que asume</th>
                                                                            <th>Contratista</th>
                                                                            <th>% que asume</th>
                                                                            <th>Precio total</th>
                                                                            <th>Clasificación</th>
                                                                            <th>Nombre de cuenta</th>
                                                                            <th>Código cuenta</th>
                                                                            <th>Asume</th>
                                                                        </tr>
                                                                    </thead>

                                                                    <tbody id="tbodyControlActividades" class="text-nowrap">
                                                                    </tbody>
                                                                </table> -->
                                                                <table id="tableControlActividades" class="datatable-multi-row table table-sm table-striped table-hover table-bordered text-center w-100">
                                                                    <thead class="text-nowrap">
                                                                        <tr>
                                                                            <th># Orden</th>
                                                                            <th>Vehículo</th>
                                                                            <th>Kilometraje</th>
                                                                            <th>Cliente</th>
                                                                            <th># Factura</th>
                                                                            <th>Ciudad</th>
                                                                            <th>Fecha de solicitud</th>
                                                                            <th>Fecha ejecución</th>
                                                                            <th>Fecha entrega</th>
                                                                            <th>Diagnóstico</th>
                                                                            <th>Proveedor</th>
                                                                            <th>Item</th>
                                                                            <th>Descripción</th>
                                                                            <th>Sistema</th>
                                                                            <th>Cantidad</th>
                                                                            <th>Precio unitario</th>
                                                                            <th>Iva</th>
                                                                            <th>Cliente</th>
                                                                            <th>% que asume</th>
                                                                            <th>Empresa</th>
                                                                            <th>% que asume</th>
                                                                            <th>Contratista</th>
                                                                            <th>% que asume</th>
                                                                            <th>Precio total</th>
                                                                            <th>Clasificación</th>
                                                                            <th>Nombre de cuenta</th>
                                                                            <th>Código cuenta</th>
                                                                            <th>Asume</th>
                                                                        </tr>
                                                                    </thead>

                                                                    <tbody id="tbodyControlActividades" class="text-nowrap">

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

                <div class="tab-pane fade" id="pills-rutinas" role="tabpanel" aria-labelledby="pills-rutinas-tab">
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
                                    <table id="tablaProgramacion" class="table table-sm table-striped table-bordered text-center table-hover  w-100">
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
                </div> <!-- RUTINAS -->



                <!-- PROGRAMACIÓN -->
                <div class="tab-pane fade" id="pills-programacion" role="tabpanel" aria-labelledby="pills-programacion-tab">
                    <div class="row">
                        <div class="col-12 col-sm-6 col-lg-12">
                            <div class="card card-info">
                                <div class="card-header">
                                    <ul class="nav nav-tabs card-header-tabs" id="custom-tabs-one-tab" role="tablist">
                                        <!-- <li class="nav-item">
                                         <a class="nav-link active" id="custom-tabs-one-solicitudserv_exter_repues-tab" data-toggle="pill" href="#custom-tabs-one-solicitudserv_exter_repues" role="tab" aria-controls="custom-tabs-one-solicitudserv_exter_repues" aria-selected="false">Solicitud de servicio / Repuestos</a>
                                        </li> -->
                                        <li class="nav-item ">
                                            <!-- TABS HORIZONTALES-->
                                            <a class="nav-link active" id="v-pills-vehiculos-tab" data-toggle="pill" href="#v-pills-vehiculos" role="tab" aria-controls="v-pills-vehiculos" aria-selected="true"><i class="fas fa-car"></i> Mantenimientos pendientes</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="historialSolicitudesProgramacion-tab" data-toggle="pill" href="#historialSolicitudesProgramacion" role="tab" aria-controls="custom-tabs-one-historial_orden" aria-selected="false"><i class="fas fa-history"></i> Historial de programaciones</a>
                                        </li>

                                    </ul>
                                </div>

                                <div class="card-body">
                                    <div class="tab-content" id="custom-tabs-one-tabContent">

                                        <!-- <div class="card card-outline card-info">

                                            <div class="card-header">
                                                <h3 class="card-title"><b><i>ACTUALIZAR</i></b>
                                                    <i class="far fa-edit"></i>
                                                </h3>
                                            </div>


                                            <div class="card-body">
                                                <div class="row">

                                                    <div class="col-3 ">
                                                        <div class="form-group text-center">
                                                            <label><i>Placa</i></label>
                                                            <select id="placa_programacion" name="" class="form-control select2-single" type="number" style="height: 99%" required>
                                                                <option selected value="">Seleccione un vehículo</option>
                                                                <?php foreach ($Placas as $key => $value) : ?>
                                                                    <option value="<?= $value['idvehiculo'] ?>"><?= $value['placa'] ?> - <?= $value['numinterno'] ?> </option>
                                                                <?php endforeach ?>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-3 ">
                                                        <div class="form-group text-center">
                                                            <label><i>Número interno</i></label>
                                                            <input type="text" class="form-control form-control-sm" id="num_interno_progra" name="num_interno_progra" required readonly>
                                                        </div>
                                                    </div>


                                                    <div class="col-3 ">
                                                        <div class="form-group text-center">
                                                            <label><i>Marca</i></label>
                                                            <input type="text" class="form-control form-control-sm" id="marca_progra" name="marca_progra" required readonly>
                                                        </div>
                                                    </div>

                                                    <div class="col-3 ">
                                                        <div class="form-group text-center">
                                                            <label><i>Clase de vehículo</i></label>
                                                            <input type="text" class="form-control form-control-sm" id="tipo_vehiculo_progra" name="tipo_vehiculo_progra" required readonly>
                                                        </div>
                                                    </div>

                                                    <div class="col-3 ">
                                                        <div class="form-group text-center">
                                                            <label><i>Modelo</i></label>
                                                            <input type="text" class="form-control form-control-sm" id="modelo_progra" name="modelo_progra" required readonly>
                                                        </div>
                                                    </div>

                                                    <div class="col-3 ">
                                                        <div class="form-group text-center">
                                                            <label><i>Kilometraje</i></label>
                                                            <input type="number" class="form-control form-control-sm" id="kilometraje_progra" name="kilometraje_progra" required readonly>
                                                        </div>
                                                    </div>

                                                    <div class="col-3 ">
                                                        <div class="form-group text-center">
                                                            <label><i>Fecha programación</i></label>
                                                            <input type="date" class="form-control form-control-sm" id="fecha_progra" name="fecha_progra">
                                                        </div>
                                                    </div>

                                                    <div class="col-3">
                                                        <div class="form-group text-center">
                                                            <label>Tiempo mantenimiento</label>
                                                            <input type="number" class="form-control form-control-sm" id="tiempo_progra" name="tiempo_progra">
                                                        </div>
                                                    </div>



                                                </div>





                                            </div>
                                        </div> -->


                                        <!-- MANTENIMIENTOS PENDIENTES  -->
                                        <div class="tab-pane fade show active " id="v-pills-vehiculos" role="tabpanel" aria-labelledby="v-pills-vehiculos-tab">
                                            <div class="row m-2">


                                                <!-- TABLA VEHICULOS -->
                                                <div class="table-responsive">
                                                    <table id="tablaSolicitudesProgramacion" class="datatable-multi-row table table-sm table-striped table-hover table-bordered text-center w-100">
                                                        <thead class="text-nowrap">
                                                            <tr>
                                                                <th>...</th>
                                                                <th>Placa</th>
                                                                <th>Número interno</th>
                                                                <th>Kilometraje</th>
                                                                <th>Fecha de solicitud</th>
                                                                <th>Fecha de programación</th>
                                                                <th>Actividad</th>
                                                                <th>Tiempo mantenimiento</th>
                                                                <th>Observaciones</th>
                                                            </tr>
                                                        </thead>

                                                        <tbody id="tbodyprogramacion" class="text-nowrap">

                                                        </tbody>
                                                    </table>
                                                    <!-- <table id="tablaSolicitudesProgramacion" class="datatable-multi-row w-100">
                                                        <thead>
                                                            <tr>
                                                                <th>Name</th>
                                                                <th>Contact Date</th>
                                                                <th>City</th>
                                                                <th>Family Members</th>
                                                                <th>Est. Value</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="tbodyprogramacion" class="text-nowrap">
                                                            
                                                            </tbody>
                                                    </table> -->
                                                </div>

                                            </div>
                                        </div>

                                        <div class="tab-pane fade show" id="historialSolicitudesProgramacion" role="tabpanel" aria-labelledby="historialSolicitudesProgramacion-tab">
                                            <!-- HISTORICO DE SOLICITUDES DE SERVICIO  -->
                                            <div class="row m-2">


                                                <!-- TABLA -->
                                                <div class="table-responsive">
                                                    <table id="tablaHistorialSolicitudesProgramacion" class=" table table-sm table-striped table-hover table-bordered text-center w-100 tablasBtnExport">
                                                        <thead class="text-nowrap">
                                                            <tr>
                                                                <th># Solicitud</th>
                                                                <th>Placa</th>
                                                                <th>Actividades</th>
                                                                <th>Fecha de la solicitud</th>
                                                                <th>Fecha de programación</th>
                                                                <th>Tiempo de mantenimiento</th>
                                                                <th>Estado</th>
                                                                <th>Observaciones</th>
                                                            </tr>
                                                        </thead>

                                                        <tbody id="tbodyHistorialSolicitudesProgramacion" class="text-nowrap">
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
                </div> <!-- PROGRAMACIÓN-->
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
                            <table id="tablaRepuesto" class="table-sm table-striped table-bordered  text-center table-hover  w-100">
                                <thead class="text-nowrap">
                                    <th>Sucursales</th>
                                    <th>Descripción</th>
                                    <th>Código</th>
                                    <th>Referencia</th>
                                    <th>Stock</th>
                                    <th>Posición</th>
                                    <th>Categoría</th>
                                    <th>Marca</th>
                                    <th>Medida</th>
                                </thead>
                                <tbody id="tBodyRepuesto" class="text-nowrap">

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-12 mt-2">
                        <button type="button" class="btn btn-sm btn-info btn_addRepuesto float-center">
                            <i class="fas fa-warehouse"></i>
                            Agregar nuevo respuesto
                        </button>
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
                                    <th># Orden de servicio</th>
                                    <th>Placa</th>
                                    <th>Número interno</th>
                                    <th>Marca</th>
                                    <th>Clase de vehículo</th>
                                    <th>Modelo</th>
                                    <th>Kilometraje</th>
                                    <th>Fecha entrada</th>


                                </thead>
                                <tbody id="tbodyResumen" class="text-nowrap">

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
                    <div class="card-footer d-flex ">
                        <button type="button" class="btn bg-gradient-olive ml-auto btn-exportar-solicitud" tipo_mantenimiento="solicitud"><i class="fas fa-file-pdf"></i> Exportar</button>
                        <button type="button" class="btn btn-danger ml-2" data-dismiss="modal">Cerrar</button>
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

            <!-- <div class="modal-footer">
                <button type="button" class="btn btn-success">Guardar</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
            </div> -->

        </div>
    </div>
</div>


<!-- MODAL CUENTAS CONTABLES  -->
<div id="modal-cuentas" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h5 class="modal-title" id="my-modal-title">CUENTAS CONTABLES</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-sm table-striped table-bordered dt-responsive text-center table-hover  w-100">
                        <thead>
                            <th>CÓDIGO CUENTA CONTABLE</th>
                            <th>NOMBRE CUENTA CONTABLE</th>
                            <th>SELECCIÓN</th>
                        </thead>
                        <tbody id="tbodycuentas">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ASUME MODAL -->
<div id="modalAsume" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h5 class="modal-title" id="my-modal-title">ASUME</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="asume_form" method="post" enctype="multipart/form-data">
                <input type="hidden" id="idcontrol" name="idcontrol">
                <input type="hidden" id="descripcion" name="descripcion">
                <div class="modal-body">
                    <div class="row">

                        <div class="col">
                            <div class="form-group text-center col-12 col-sm-6 col-lg-12">
                                <label><i>Cliente</i></label>
                                <input type="text" class="form-control" id="cliente_asume" name="cliente_asume" readonly>
                                <!-- <select id="" name="cliente_asume" class="form-control " type="number" style="width: 99%" readonly>
                                    <?php foreach ($clientes as $key => $value) : ?>
                                        <option value="<?= $value['idcliente'] ?>"><?= $value['clientexist'] ?></option>
                                    <?php endforeach ?>
                                </select> -->
                            </div>

                            <div class="form-group text-center col-12 col-sm-6 col-lg-12">
                                <label><i>% que asume el cliente</i></label>
                                <input type="number" class="form-control" id="porcentaje_cliente" name="porcentaje_cliente" required>
                            </div>
                            <div class="form-group text-center col-12 col-sm-6 col-lg-12">
                                <label><i>Valor que asume el cliente</i></label>
                                <input type="number" class="form-control" id="valor_cliente" name="valor_cliente" readonly>
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-group text-center col-12 col-sm-6 col-lg-12">
                                <label><i>Empresa</i></label>
                                <input id="empresa_asume" name="empresa_asume" class="form-control" type="text" style="width: 99%" readonly>

                                </input>
                            </div>

                            <div class="form-group text-center col-12 col-sm-6 col-lg-12">
                                <label><i>% que asume la empresa</i></label>
                                <input type="number" class="form-control" id="porcentaje_empresa" name="porcentaje_empresa" required>
                            </div>

                            <div class="form-group text-center col-12 col-sm-6 col-lg-12">
                                <label><i>Valor que asume la empresa</i></label>
                                <input type="number" class="form-control" id="valor_empresa" name="valor_empresa" readonly>
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-group text-center col-12 col-sm-6 col-lg-12">
                                <label><i>Contratista</i></label>
                                <input type="text" class="form-control" id="contratista_asume" name="contratista_asume" readonly>
                                <!--  -->
                            </div>


                            <div class="form-group text-center col-12 col-sm-6 col-lg-12">
                                <label><i>% que asume la empresa contratista</i></label>
                                <input type="number" class="form-control" id="porcentaje_contratista" name="porcentaje_contratista" required>
                            </div>

                            <div class="form-group text-center col-12 col-sm-6 col-lg-12">
                                <label><i>Valor que asume la empresa contratista</i></label>
                                <input type="number" class="form-control" id="valor_contratista" name="valor_contratista" readonly>
                            </div>
                        </div>
                    </div>

                    <hr class="my-4">

                    <div class="row d-flex justify-content-center">

                        <div class="col">
                            <div class="form-group text-center col-12 col-sm-6 col-lg-12">
                                <label><i>Cantidad</i></label>
                                <input type="number" class="form-control" id="cantidad_ctrActividades" readonly>
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-group text-center col-12 col-sm-6 col-lg-12">
                                <label><i>Precio (unitario)</i></label>
                                <input type="number" class="form-control" id="valor_ctrActividades" readonly>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group text-center col-12 col-sm-6 col-lg-12">
                                <label><i>Iva</i></label>
                                <input type="number" class="form-control" id="iva_ctrActividades" readonly>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group text-center col-12 col-sm-6 col-lg-12">
                                <label><i>Total</i></label>
                                <input type="number" class="form-control" id="total_ctrActividades" readonly>
                            </div>
                        </div>
                    </div>

                    <hr class="my-4">

                    <div class="row d-flex justify-content-center">
                        <div class="col">
                            <div class="form-group text-center col-12 col-sm-6 col-lg-12">
                                <label><i>Nombre cuenta contable</i></label>
                                <select id="nombre_cuenta_ctrActividades" name="nombre_cuenta" class="form-control select2-single" type="number" style="width: 99%" disabled>
                                    <?php foreach ($cuentas as $key => $value) : ?>
                                        <option value="<?= $value['id'] ?>"><?= $value['nombre_cuenta'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group text-center col-12 col-sm-6 col-lg-12">
                                <label><i>Código cuenta contable</i></label>
                                <select id="codigo_cuenta_ctrActividades" name="codigo_cuenta" class="form-control select2-single" type="number" style="width: 99%">
                                    <?php foreach ($cuentas as $key => $value) : ?>
                                        <option value="<?= $value['id'] ?>"><?= $value['num_cuenta'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                    </div>




                    <div class="modal-footer">
                        <button type="submit" form="asume_form" class="btn btn-success">Guardar</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- MODAL SUCURSALES PRODUCTOS -->
<div id="sucursalesProductos" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h5 class="modal-title" id="my-modal-title">Sucursales</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="card card-outline ">
                <div class="card-body">
                    <div class="col-12">
                        <div class="table-responsive">
                            <table id="tablaProveedores" class="table table-sm table-striped table-bordered dt-responsive text-center table-hover  w-100">
                                <thead class="text-nowrap">
                                    <th>Selección</th>
                                    <th>Descripción</th>
                                    <th>Referencia</th>
                                    <th>Stock</th>
                                    <th>Posición</th>
                                    <th>Sucursal</th>
                                    <th>Valor (Unitario)</th>
                                </thead>
                                <tbody id="tBodySucursalesProductos" class="text-nowrap">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- MODAL CON LISTA DE SERVICIOS -->

<div id="servicios" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h5 class="modal-title ">Lista de rutinas <i class="far fa-list-alt"></i></h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>


            <div class="card-body">
                <div class="col-12">
                    <div class="table-responsive">
                        <table id="" class="table table-sm table-striped table-bordered dt-responsive text-center table-hover  w-100">
                            <thead class="text-nowrap">
                                <th>Rutina</th>
                                <th>Días para cambio </th>
                                <th>Kilometraje para cambio</th>
                            </thead>
                            <tbody id="" class="text-nowrap">
                                <?php foreach ($Servicios as $key => $value) : ?>
                                    <tr>
                                        <td><?= $value['servicio'] ?></td>
                                        <td><?= $value['dias_cambio'] ?></td>
                                        <td><?= $value['kilometraje_cambio'] ?></td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-12 mt-2">
                    <a href="cg-mantenimiento" target="_blank">
                        <button class="btn btn-sm btn-warning float-center"><i class="fas fa-plus-circle"></i>
                            Crear nueva rutina
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- MODAL CON LISTA DE SERVICIOS X VEHICULO -->
<div id="serviciosxvehiculo" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h5 class="modal-title ">Rutinas realizadas</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>


            <div class="card-body">
                <div class="col-12">
                    <div class="table-responsive">
                        <table id="tablaserviciosxvehiculoprogramacion" class="datatable-multi-row table table-sm table-striped table-hover table-bordered text-center w-100">
                            <thead class="text-nowrap">
                                <th>Rutina</th>
                                <th>Kilometraje actual</th>
                                <th>Kilometraje para cambio</th>
                                <th>Fecha para cambio</th>
                                <th>Evidencia</th>
                                <th>Fecha programación</th>
                            </thead>
                            <tbody id="tbodyserviciosxvehiculoprogramacion" class="text-nowrap">
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- MODAL QUE CARGA SOLICITUDES POR VEHÍCULO  -->
<!-- <div id="solicitudessxvehiculo" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h5 class="modal-title ">Solicitudes</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>


            <div class="card-body">
                <div class="col-12">
                    <div class="table-responsive" id="">
                        <table id="table-evidenciasprogramacion" class="table table-sm table-striped table-bordered dt-responsive text-center table-hover  w-100">
                            <thead class="text-nowrap">
                                <th>Fecha</th>
                                <th>Imágenes de evidencia</th>
                                <th>Observaciones</th>
                                <th>Estado</th>
                                <th>Autor</th>
                            </thead>
                            <tbody id="tbodyevidenciasprogramacion" class="text-nowrap">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> -->

<!-- MODAL PARA GUARDAR PROGRAMACIÓN -->
<!-- <div id="Programacion" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <Title class="modal-title"><b><i>Actualizar</i></b>
                    <i class="far fa-edit"></i>
                    </h5>
                    <button class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="card-body">
                <div class="row">

                    <div class="col-3 ">
                        <div class="form-group text-center">
                            <label><i>Placa</i></label>
                            <select id="placa_programacion" name="" class="form-control select2-single" type="number" style="height: 99%" required>
                                <option selected value="">Seleccione un vehículo</option>
                                <?php foreach ($Placas as $key => $value) : ?>
                                    <option value="<?= $value['idvehiculo'] ?>"><?= $value['placa'] ?> - <?= $value['numinterno'] ?> </option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-3 ">
                        <div class="form-group text-center">
                            <label><i>Número interno</i></label>
                            <input type="text" class="form-control form-control-sm" id="num_interno_progra" name="num_interno_progra" required readonly>
                        </div>
                    </div>


                    <div class="col-3 ">
                        <div class="form-group text-center">
                            <label><i>Marca</i></label>
                            <input type="text" class="form-control form-control-sm" id="marca_progra" name="marca_progra" required readonly>
                        </div>
                    </div>

                    <div class="col-3 ">
                        <div class="form-group text-center">
                            <label><i>Clase de vehículo</i></label>
                            <input type="text" class="form-control form-control-sm" id="tipo_vehiculo_progra" name="tipo_vehiculo_progra" required readonly>
                        </div>
                    </div>

                    <div class="col-3 ">
                        <div class="form-group text-center">
                            <label><i>Modelo</i></label>
                            <input type="text" class="form-control form-control-sm" id="modelo_progra" name="modelo_progra" required readonly>
                        </div>
                    </div>

                    <div class="col-3 ">
                        <div class="form-group text-center">
                            <label><i>Kilometraje</i></label>
                            <input type="number" class="form-control form-control-sm" id="kilometraje_progra" name="kilometraje_progra" required readonly>
                        </div>
                    </div>

                    <div class="col-3 ">
                        <div class="form-group text-center">
                            <label><i>Fecha programación</i></label>
                            <input type="date" class="form-control form-control-sm" id="fecha_progra" name="fecha_progra">
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="form-group text-center">
                            <label>Tiempo mantenimiento</label>
                            <input type="number" class="form-control form-control-sm" id="tiempo_progra" name="tiempo_progra">
                        </div>
                    </div>



                </div>





            </div>
        </div>
    </div>
</div> -->

<div id="Programacion" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h5 class="modal-title"><b><i>Solicitud de mantenimiento</i></b>
                    <i class="far fa-edit"></i>
                </h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="card-body">
                <form id="Guardarprogramacion_form" method="post" enctype="multipart/form-data">
                    <input type="hidden" id="idsolicitud" name="idsolicitud">
                    <div class="row">

                        <div class="col-3 ">
                            <div class="form-group text-center">
                                <label><i>Placa</i></label>
                                <select id="placa_programacion" name="placa_programacion" class="form-control" type="number" style="height: 99%" readonly required>
                                    <option selected value="">Seleccione un vehículo</option>
                                    <?php foreach ($Placas as $key => $value) : ?>
                                        <option value="<?= $value['idvehiculo'] ?>"><?= $value['placa'] ?> - <?= $value['numinterno'] ?> </option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-3 ">
                            <div class="form-group text-center">
                                <label><i>Número interno</i></label>
                                <input type="text" class="form-control form-control-sm" id="num_interno_progra" name="num_interno_progra" readonly>
                            </div>
                        </div>


                        <div class="col-3 ">
                            <div class="form-group text-center">
                                <label><i>Marca</i></label>
                                <input type="text" class="form-control form-control-sm" id="marca_progra" name="marca_progra" readonly>
                            </div>
                        </div>

                        <div class="col-3 ">
                            <div class="form-group text-center">
                                <label><i>Clase de vehículo</i></label>
                                <input type="text" class="form-control form-control-sm" id="tipo_vehiculo_progra" name="tipo_vehiculo_progra" readonly>
                            </div>
                        </div>

                        <div class="col-3 ">
                            <div class="form-group text-center">
                                <label><i>Modelo</i></label>
                                <input type="text" class="form-control form-control-sm" id="modelo_progra" name="modelo_progra" readonly>
                            </div>
                        </div>

                        <div class="col-3 ">
                            <div class="form-group text-center">
                                <label><i>Kilometraje</i></label>
                                <input type="number" class="form-control form-control-sm" id="kilometraje_progra" name="kilometraje_progra" required readonly>
                            </div>
                        </div>

                        <div class="col-3 ">
                            <div class="form-group text-center">
                                <label><i>Fecha programación</i></label>
                                <input type="date" class="form-control form-control-sm" id="fecha_progra" name="fecha_progra" required>
                            </div>
                        </div>

                        <div class="col-3">
                            <div class="form-group text-center">
                                <label>Tiempo mantenimiento (Días)</label>
                                <input type="number" class="form-control form-control-sm" id="tiempo_progra" name="tiempo_progra">
                            </div>
                        </div>
                        <input type="hidden" class="form-control form-control-sm" id="descripcion_progra" name="descripcion_progra" readonly>

                        <div class="col-3 ">
                            <div class="form-group text-center">
                                <label><i>Estado</i></label>
                                <select id="estado_programacion" name="estado_programacion" class="form-control" type="number" style="height: 99%" required>
                                    <option></option>
                                    <option>NUEVO</option>
                                    <option>REPROGRAMADO</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-3">
                            <div class="form-group text-center">
                                <label id="label_observacion">Observación</label>
                                <textarea rows="3" cols="3" class="form-control form-control-sm" id="observacion_progra" name="observacion_progra"> </textarea>
                            </div>
                        </div>


                    </div>
                </form>

                <hr class="my-4 bg-dark">

                <div class="row">
                    <div class="col-lg-12 col-sm-12 justify-content-center">
                        <div class="table-responsive">
                            <table id="tablaProgramacionSolicitud" class="datatable-multi-row table table-sm table-striped table-hover table-bordered text-center w-100">
                                <thead class="text-nowrap">
                                    <th>Kilometraje</th>
                                    <th>Actividad</th>
                                    <th>Kilometraje para cambio</th>
                                    <th>Fecha para cambio</th>
                                    <th>Evidencia</th>
                                    <th>Fecha de programación</th>
                                </thead>
                                <tbody id="tbodyProgramacionSolicitud" class="text-nowrap">


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>



            </div>

            <div class="modal-footer">
                <button type="submit" form="Guardarprogramacion_form" class="btn btn-success">Guardar</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
            </div>

        </div>
    </div>
</div>

<div id="AgregarRepuesto" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="AgregarRepuesto-title" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">

            <div class="modal-header bg-info">
                <h5 class="modal-title" id="AgregarRepuesto-title">Agregar nuevo repuesto</h5>
                <button class="close" id="cerrar" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="card-body">

                    <!--INGRESO DATOS PRODUCTOS-->
                    <h4><i class="fas fa-info-circle"></i> <b><i>Datos del repuesto</i></b></h4>
                    <hr class="my-4">

                    <form id="formulario_addRepuesto" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <!-- <input type="hidden" id="id_producto" name="id_producto" value=""> -->

                            <div class="col-12 col-sm-6 col-lg-4">
                                <div class="form-group text-center">
                                    <label><i>Código del repuesto</i> <i class="fas fa-barcode"></i></label>
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

                        <hr class="bg-dark">

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
                                    <label><i>Número de factura repuesto</i></label>
                                    <input type="text" class="form-control input_inventario" id="num_factura" name="num_factura" placeholder="#" required>
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
                                    <input type="number" class="form-control input_inventario" id="cantidad" name="cantidad" placeholder="-" min="0" step="1" title="Ingrese solo valores positivos" required>
                                </div>
                            </div>

                            <div class="col-12 col-sm-6 col-lg-4">
                                <div class="form-group text-center">
                                    <label><i>Posición</i> <i class="fas fa-sitemap"></i></label>
                                    <input type="text" class="form-control input_inventario" id="posicion" name="posicion" placeholder="-">
                                </div>
                            </div>

                            <div class="col-12 col-sm-6 col-lg-4">
                                <div class="form-group text-center">
                                    <label><i>Precio de compra (valor unitario)</i> <i class="fas fa-dollar-sign"></i></label>
                                    <input type="text" class="form-control input_inventario" id="precio-compra-producto" name="precio-compra-producto" placeholder="$" required>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-center">
                            <div class="form-group">
                                <button type="submit" class="btn btn-sm bg-gradient-info btn-block" form="formulario_addRepuesto"><i class="fas fa-plus"></i> Agregar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="modal-footer justify-content-center bg-dark">
                <a class="btn btn-sm btn-cerrar2 bg-danger" data-dismiss="modal">
                    <i class="fas fa-ban"></i> Cancelar
                </a>


            </div>

        </div>
    </div>
</div>