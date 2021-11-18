<?php

// if (!validarPermiso('CARGAR_OPCION', 'R')) {
//     echo "<script> window.location = 'inicio'; </script>";
// }

$Placas = ControladorVehiculos::ctrListaVehiculos();
$Servicios = ControladorVehiculos::ctrListadoServicios();

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
                    <h1 class="m-0 text-dark "><i>Mantenimientos</i> <i class="fas fa-tools nav-icon"></i></h1>
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
            <div class="row">
                <div class="col-12 col-sm-6 col-lg-12">
                    <div class="card card-info card-tabs">
                        <div class="card-header p-0 pt-1">
                            <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                                <li class="nav-item">
                                    <!-- TABS HORIZONTALES-->
                                    <a class="nav-link active" id="custom-tabs-one-ordenserv_mante-tab" data-toggle="pill" href="#custom-tabs-one-ordenserv_mante" role="tab" aria-controls="custom-tabs-one-ordenserv_mante" aria-selected="true">Orden de servicio / Mantenimiento</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="custom-tabs-one-solicitudserv_exter_repues-tab" data-toggle="pill" href="#custom-tabs-one-solicitudserv_exter_repues" role="tab" aria-controls="custom-tabs-one-solicitudserv_exter_repues" aria-selected="false">Solicitud de servicio / Repuestos</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="custom-tabs-one-programacion-tab" data-toggle="pill" href="#custom-tabs-one-programacion" role="tab" aria-controls="custom-tabs-one-programacion" aria-selected="false">Programación</a>
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
                                                    <div class=" nav navbar-expand-lg flex-column nav-pills " id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                                        <a class="nav-link active" id="v-pills-general-tab" data-toggle="pill" href="#v-pills-general" role="tab" aria-controls="v-pills-general" aria-selected="true">Datos generales</a>
                                                        <a class="nav-link" id="v-pills-diagnostico-tab" data-toggle="pill" href="#v-pills-diagnostico" role="tab" aria-controls="v-pills-diagnostico" aria-selected="false">Diagnóstico</a>
                                                        <a class="nav-link" id="v-pills-repuestos-tab" data-toggle="pill" href="#v-pills-repuestos" role="tab" aria-controls="v-pills-repuestos" aria-selected="false">Repuestos</a>
                                                        <a class="nav-link" id="v-pills-manoObra-tab" data-toggle="pill" href="#v-pills-manoObra" role="tab" aria-controls="v-pills-manoObra" aria-selected="false">Mano de obra</a>
                                                        <a class="nav-link" id="v-pills-observaciones-tab" data-toggle="pill" href="#v-pills-observaciones" role="tab" aria-controls="v-pills-observaciones" aria-selected="false">Observaciones</a>
                                                        <a class="nav-link" id="v-pills-firmas-tab" data-toggle="pill" href="#v-pills-firmas" role="tab" aria-controls="v-pills-firmas" aria-selected="false">Nombres y firmas</a>
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
                                                                <label><i>Número interno</i></label>
                                                                <input type="text" class="form-control" id="numinterno_man" name="numinterno_man" required>
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
                                                                <label><i>Placa</i></label>
                                                                <input type="text" class="form-control" id="placa_man" name="placa_man" required readonly>
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
                                                                <label><i>Fecha de salida</i></label>
                                                                <input type="date" class="form-control" id="fechasalida_man" name="fechasalida_man" required>
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
                                                                <label><i>Hora de salida</i></label>
                                                                <input type="time" class="form-control" id="horasalida_man" name="horasalida_man" required>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row d-flex justify-content-center">
                                                        <div class="col-12 col-sm-6 col-lg-4">
                                                            <div class="form-group text-center">
                                                                <label><i>Sistema</i></label>
                                                                <input type="text" class="form-control" id="sistema_man" name="sistema_man" required>
                                                            </div>
                                                        </div>

                                                        <div class="col-12 col-sm-6 col-lg-4">
                                                            <div class="form-group text-center">
                                                                <label><i>Tipo de mantenimiento</i></label>
                                                                <input type="text" class="form-control" id="tipo_man" name="tipo_man" required>
                                                            </div>
                                                        </div>
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

                                                            <div class="row d-flex justify-content-center">
                                                                <div class="col-sm-8">
                                                                    <div class="form-group text-center">
                                                                        <label><i># Orden externa</i></label>
                                                                        <input type="text" class="form-control" id="tipo_man" name="tipo_man" required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- REPUESTOS -->
                                                <div class="tab-pane fade" id="v-pills-repuestos" role="tabpanel" aria-labelledby="v-pills-repuestos-tab">
                                                    <div class="table-responsive">
                                                        <table class="table table table-responsive table-bordered table-striped text-center">
                                                            <thead>
                                                                <tr>
                                                                    <th style="width: 600px">Descripción</th>
                                                                    <th>Cantidad</th>
                                                                    <th>Precio</th>
                                                                    <th>Referencia</th>
                                                                    <th>Proveedor</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="tbody_repuesto">
                                                                <tr id="contenido_filas_repuesto">
                                                                    <td style="width: 200px"> <input type="text" class="form-control" id="descripcion" name="descripcion1"></td>
                                                                    <td><input type="text" class="form-control" id="cantidad" name="cantidad"></td>
                                                                    <td><input type="text" class="form-control" id="precio" name="precio"></td>
                                                                    <td><input type="text" class="form-control" id="referencia" name="referencia"></td>
                                                                    <td><input type="text" class="form-control" id="proveedor" name="proveedor"></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <button type="button" class="btn btn-primary btn-md btn-agregarRepuesto mb-3" >
                                                        <i class="fas fa-plus"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-danger btn-md btn-EliminarRepuesto mb-3" >
                                                        <i class="fas fa-times"></i>
                                                    </button>
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
                                                                    </tr>
                                                                </thead>
                                                                <tbody id="filas_tabla_manoObra">
                                                                    <tr id="Contenido_tabla_manoObra">
                                                                        <td style="width: 200px"> <input type="text" class="form-control" id="descrip_mano" name="descrip_mano"></td>
                                                                        <td><input type="text" class="form-control" id="descrip_mano" name="descrip_mano"></td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <button type="button" class="btn btn-primary btn-md btn-agregarManoObra mb-3" ">
                                                        <i class="fas fa-plus"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-danger btn-md btn-EliminarManoObra mb-3" ">
                                                        <i class="fas fa-times"></i>
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
                                                <span class="btn btn-success col fileinput-button dz-clickable">
                                                    <i class="fas fa-plus"></i>
                                                    <span>Guardar</span>
                                                </span>

                                                <button type="reset" class="btn btn-danger col cancel">
                                                    <i class="fas fa-times-circle"></i>
                                                    <span>Cancelar</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- ===================================================
                                      SOLICITUD DE SERVICIO REPUESTOS 
                                    =================================================== -->
                                <div class="tab-pane fade" id="custom-tabs-one-solicitudserv_exter_repues" role="tabpanel" aria-labelledby="custom-tabs-one-solicitudserv_exter_repues-tab">
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
                                                <div class="tab-pane fade show active " id="v-pills-generalSolicitud" role="tabpanel" aria-labelledby="v-pills-generalSolicitud-tab">
                                                    <div class="row">
                                                        <div class="col-12 col-sm-6 col-lg-4">
                                                            <div class="form-group text-center">
                                                                <label><i>Número de orden</i></label>
                                                                <input type="text" class="form-control" id="num_orden" name="num_orden" required>
                                                            </div>
                                                        </div>

                                                        <div class="col">
                                                            <div class="form-group text-center col-12 col-sm-6 col-lg-12">
                                                                <label><i>Placa</i></label>
                                                                <select id="placa_repuestos" name="idvehiculo_repuestos" class="form-control select2-single" type="number" style="width: 99%" required>
                                                                    <option selected value="">Seleccione un vehículo</option>
                                                                    <?php foreach ($Placas as $key => $value) : ?>
                                                                        <option value="<?= $value['idvehiculo'] ?>"><?= $value['placa'] ?> </option>
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

                                                        <div class="col-12 col-sm-6 col-lg-4">
                                                            <div class="form-group text-center">
                                                                <label><i>Solicitado por</i></label>
                                                                <input type="text" class="form-control" id="solicitud_repuestos" name="solicitud_repuestos" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- EXTERNO -->
                                                <div class="tab-pane fade" id="v-pills-Externo" role="tabpanel" aria-labelledby="v-pills-Externo-tab">
                                                    <div class="row">
                                                        <div class="col-lg-12 col-sm-12 justify-content-center">
                                                            <div class="card card-outline card-info">
                                                                <div class="card-body">
                                                                    <div class="row">
                                                                        <div class="col-12 col-sm-6 col-lg-4">
                                                                            <div class="custom-control custom-checkbox">
                                                                                <input class="custom-control-input" type="checkbox" id="check_montallant" name="montallantas_repuestos">
                                                                                <label for="check_montallant" class="custom-control-label">Montallantas</label>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-12 col-sm-6 col-lg-4">
                                                                            <div class="custom-control custom-checkbox">
                                                                                <input class="custom-control-input" type="checkbox" id="check_lubricacion" name="lubricacion_repuestos">
                                                                                <label for="check_lubricacion" class="custom-control-label">Lubricación</label>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-12 col-sm-6 col-lg-4">
                                                                            <div class="custom-control custom-checkbox">
                                                                                <input class="custom-control-input" type="checkbox" id="check_lampintu" name="lamina_repuestos">
                                                                                <label for="check_lampintu" class="custom-control-label">Lámina y pintura</label>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-12 col-sm-6 col-lg-4">
                                                                            <div class="custom-control custom-checkbox">
                                                                                <input class="custom-control-input" type="checkbox" id="check_elec" name="electrico_repuestos">
                                                                                <label for="check_elec" class="custom-control-label">Eléctrico</label>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-12 col-sm-6 col-lg-4">
                                                                            <div class="custom-control custom-checkbox">
                                                                                <input class="custom-control-input" type="checkbox" id="check_alinbalan" name="alineacion_repuestos">
                                                                                <label for="check_alinbalan" class="custom-control-label">Alineación y balanceo</label>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-12 col-sm-6 col-lg-4">
                                                                            <div class="custom-control custom-checkbox">
                                                                                <input class="custom-control-input" type="checkbox" id="check_frenos" name="frenos_repuestos">
                                                                                <label for="check_frenos" class="custom-control-label">Frenos</label>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-12 col-sm-6 col-lg-4">
                                                                            <div class="custom-control custom-checkbox">
                                                                                <input class="custom-control-input" type="checkbox" id="check_muellsuspen" name="muelles_repuestos">
                                                                                <label for="check_muellsuspen" class="custom-control-label">Muelles y suspensión</label>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-12 col-sm-6 col-lg-4">
                                                                            <div class="custom-control custom-checkbox">
                                                                                <input class="custom-control-input" type="checkbox" id="check_vidrios" name="vidrios_repuestos">
                                                                                <label for="check_vidrios" class="custom-control-label">Vidrios</label>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-12 col-sm-6 col-lg-4">
                                                                            <div class="custom-control custom-checkbox">
                                                                                <input class="custom-control-input" type="checkbox" id="check_radio" name="radio_repuestos">
                                                                                <label for="check_radio" class="custom-control-label">Radio</label>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-12 col-sm-6 col-lg-4">
                                                                            <div class="custom-control custom-checkbox">
                                                                                <input class="custom-control-input" type="checkbox" id="check_otro" name="otro_repuestos">
                                                                                <label for="check_otro" class="custom-control-label">Otro</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- REPUESTO -->
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
                                                                                <th style="width: 500px">DESCRIPCIÓN</th>
                                                                                <th>REFERENCIA</th>
                                                                                <th>CANTIDAD</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody id="filas_tabla_repuestoSolicitud">
                                                                            <tr id="contenido_filas_repuestoSolicitud">
                                                                                <td style="width: 300px"> <input type="text" class="form-control" id="descripcion_repuestos1" name="descripcion_repuestos1"></td>
                                                                                <td style="width: 300px"> <input type="text" class="form-control" id="referencia_repuestos1" name="referencia_repuestos1"></td>
                                                                                <td style="width: 300px"> <input type="text" class="form-control" id="proveedor1" name="proveedor1"></td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                                <button type="button" class="btn btn-primary btn-md btn-agregarRepuestoSolicitud mb-3" data-toggle="modal" data-target="#EmpresasModal">
                                                                    <i class="fas fa-plus"></i>
                                                                </button>
                                                                <button type="button" class="btn btn-danger btn-md btn-EliminarRepuestoSolicitud mb-3" data-toggle="modal" data-target="#EmpresasModal">
                                                                    <i class="fas fa-times"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr class="my-4">

                            
                                    <div class="row d-flex justify-content-center">
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
                                                    <span class="input-group-text">Recibido por:</span>
                                                </div>
                                                <input type="text" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <br>

                                    <div class="row d-flex justify-content-center">
                                        <div class="col-md-6">
                                            <div class="btn-group w-100">
                                                <span class="btn btn-info col fileinput-button dz-clickable">
                                                    <i class="fas fa-plus"></i>
                                                    <span>Guardar</span>
                                                </span>

                                                <button type="reset" class="btn btn-danger col cancel">
                                                    <i class="fas fa-times-circle"></i>
                                                    <span>Cancelar</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- /.container-fluid -->

                                <!-- ====================================================
                                            PROGRAMACIÓN
                                    =====================================================-->
                                <div class="tab-pane fade" id="custom-tabs-one-programacion" role="tabpanel" aria-labelledby="custom-tabs-one-programacion-tab">
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
                                                                        <option value="<?= $value['idvehiculo'] ?>"><?= $value['placa'] ?> </option>
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

                    </div>
                </div>

            </div>
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
</div>