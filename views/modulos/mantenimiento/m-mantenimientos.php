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
                    <h1 class="m-0 text-dark ">Mantenimientos <i class="fas fa-tools nav-icon"></i></h1>
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
                    <div class="card card-success card-tabs">
                        <div class="card-header p-0 pt-1">
                            <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="custom-tabs-one-ordenserv_mante-tab" data-toggle="pill" href="#custom-tabs-one-ordenserv_mante" role="tab" aria-controls="custom-tabs-one-ordenserv_mante" aria-selected="true">Orden de servicio / Mantenimiento</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="custom-tabs-one-solicitudserv_exter_repues-tab" data-toggle="pill" href="#custom-tabs-one-solicitudserv_exter_repues" role="tab" aria-controls="custom-tabs-one-solicitudserv_exter_repues" aria-selected="false">Solicitud de servicio / Repuestos</a>
                                </li>
                            </ul>
                        </div>

                        <div class="card-body">
                            <div class="tab-content" id="custom-tabs-one-tabContent">
                                <div class="tab-pane fade active show" id="custom-tabs-one-ordenserv_mante" role="tabpanel" aria-labelledby="custom-tabs-one-ordenserv_mante-tab">
                                    <div class="row">
                                        <div class="col-12 col-sm-6 col-lg-4">
                                            <div class="form-group text-center">
                                                <label><i>Numero interno</i></label>
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

                                    <!-- ===================================================
                                      MENU COLAPSABLES ORDEN DE SERVICIO
                                    =================================================== -->
                                    <div class="card card-outline card-success">
                                        <div class="card-body">
                                            <div id="accordion">
                                                <div class="card card-primary">
                                                    <div class="card-header text-center">
                                                        <h4 class="card-title w-100">
                                                            <a class="d-block w-100" data-toggle="collapse" href="#collapseOne">
                                                                Diagnostico
                                                            </a>
                                                        </h4>
                                                    </div>

                                                    <div id="collapseOne" class="collapse" data-parent="#accordion">
                                                        <div class="card-body">
                                                            <div class="callout callout-info">
                                                                <div class="row">
                                                                    <div class="col-sm-9 text-center">
                                                                        <!-- textarea -->
                                                                        <div class="form-group">
                                                                            <label>Descripcion</label>
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
                                                    </div>
                                                </div>

                                                <div class="card card-gray">
                                                    <div class="card-header text-center">
                                                        <h4 class="card-title w-100">
                                                            <a class="d-block w-100" data-toggle="collapse" href="#collapseTwo">
                                                                Repuestos
                                                            </a>
                                                        </h4>
                                                    </div>

                                                    <div id="collapseTwo" class="collapse" data-parent="#accordion">
                                                        <div class="card-body">
                                                            <table class="table table-bordered text-center">
                                                                <thead>
                                                                    <tr>
                                                                        <th style="width: 600px">Descripción</th>
                                                                        <th>Cantidad</th>
                                                                        <th>Precio</th>
                                                                        <th>Referencia</th>
                                                                        <th>Proveedor</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <td style="width: 200px"> <input type="text" class="form-control" id="descripcion1" name="descripcion1"></td>
                                                                        <td><input type="text" class="form-control" id="descripcion2" name="descripcion2"></td>
                                                                        <td><input type="text" class="form-control" id="descripcion3" name="descripcion3"></td>
                                                                        <td><input type="text" class="form-control" id="descripcion4" name="descripcion4"></td>
                                                                        <td><input type="text" class="form-control" id="descripcion5" name="descripcion5"></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td style="width: 200px"> <input type="text" class="form-control" id="cantidad1" name="cantidad1"></td>
                                                                        <td><input type="text" class="form-control" id="cantidad2" name="cantidad2"></td>
                                                                        <td><input type="text" class="form-control" id="cantidad3" name="cantidad3"></td>
                                                                        <td><input type="text" class="form-control" id="cantidad4" name="cantidad4"></td>
                                                                        <td><input type="text" class="form-control" id="cantidad5" name="cantidad5"></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td style="width: 200px"> <input type="text" class="form-control" id="precio1" name="precio1"></td>
                                                                        <td><input type="text" class="form-control" id="precio2" name="precio2"></td>
                                                                        <td><input type="text" class="form-control" id="precio3" name="precio3"></td>
                                                                        <td><input type="text" class="form-control" id="precio4" name="precio4"></td>
                                                                        <td><input type="text" class="form-control" id="precio5" name="precio5"></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td style="width: 200px"> <input type="text" class="form-control" id="proveedor1" name="proveedor1"></td>
                                                                        <td><input type="text" class="form-control" id="proveedor2" name="proveedor2"></td>
                                                                        <td><input type="text" class="form-control" id="proveedor3" name="proveedor3"></td>
                                                                        <td><input type="text" class="form-control" id="proveedor4" name="proveedor4"></td>
                                                                        <td><input type="text" class="form-control" id="proveedor5" name="proveedor5"></td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="card card-success">
                                                    <div class="card-header text-center">
                                                        <h4 class="card-title w-100">
                                                            <a class="d-block w-100" data-toggle="collapse" href="#collapseThree">
                                                                Mano de obra
                                                            </a>
                                                        </h4>
                                                    </div>
                                                    <div id="collapseThree" class="collapse" data-parent="#accordion">
                                                        <div class="card-body">
                                                            <table class="table table-bordered text-center">
                                                                <thead>
                                                                    <tr>
                                                                        <th style="width: 600px">Descripción de la actividad</th>
                                                                        <th>Proveedor</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <td style="width: 200px"> <input type="text" class="form-control" id="descrip_mano1" name="descrip_mano1"></td>
                                                                        <td><input type="text" class="form-control" id="descrip_mano2" name="descrip_mano2"></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td style="width: 200px"> <input type="text" class="form-control" id="cantidad_mano1" name="cantidad_mano1"></td>
                                                                        <td><input type="text" class="form-control" id="cantidad_mano2" name="cantidad_mano2"></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td style="width: 200px"> <input type="text" class="form-control" id="precio_mano1" name="precio_mano1"></td>
                                                                        <td><input type="text" class="form-control" id="precio_mano2" name="precio_mano2"></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td style="width: 200px"> <input type="text" class="form-control" id="proveedor_mano1" name="proveedor_mano1"></td>
                                                                        <td><input type="text" class="form-control" id="proveedor_mano2" name="proveedor_mano2"></td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="card card-warning">
                                                    <div class="card-header text-center">
                                                        <h4 class="card-title w-100">
                                                            <a class="d-block w-100" data-toggle="collapse" href="#collapsefour">
                                                                Observaciones
                                                            </a>
                                                        </h4>
                                                    </div>
                                                    <div id="collapsefour" class="collapse" data-parent="#accordion">
                                                        <div class="card-body">
                                                            <div class="callout callout-warning">
                                                                <h5>Digite su observación</h5>
                                                                <textarea class="form-control" rows="5" id="oberser_observ" name="oberser_observ"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="card card-info">
                                                    <div class="card-header text-center">
                                                        <h4 class="card-title w-100">
                                                            <a class="d-block w-100" data-toggle="collapse" href="#collapsefive">
                                                                Nombres y Firmas
                                                            </a>
                                                        </h4>
                                                    </div>
                                                    <div id="collapsefive" class="collapse" data-parent="#accordion">
                                                        <div class="callout callout-info">
                                                            <h5 class="text-center"><i>Nombre</i></h5>
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
                                                            <h5 class="text-center"><i>Firma</i></h5>
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
                                        </div>
                                    </div>
                                </div>

                                <!-- ===================================================
                                      MENU COLAPSABLES SOLICITUD DE SERVICIOS
                                    =================================================== -->
                                <div class="tab-pane fade" id="custom-tabs-one-solicitudserv_exter_repues" role="tabpanel" aria-labelledby="custom-tabs-one-solicitudserv_exter_repues-tab">
                                    <div class="row">
                                        <div class="col-12 col-sm-6 col-lg-4">
                                            <div class="form-group text-center">
                                                <label><i>Numero interno</i></label>
                                                <input type="text" class="form-control" id="numinterno_repuestos" name="numinterno_repuestos" required>
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
                                                <label><i>Numero de orden</i></label>
                                                <input type="text" class="form-control" id="numorden_repuestos" name="numorden_repuestos" required>
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6 col-lg-4">
                                            <div class="form-group text-center">
                                                <label><i>Placa</i></label>
                                                <input type="text" class="form-control" id="placa_repuestos" name="placa_repuestos" required readonly>
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
                                    <hr class="my-4">

                                    <div class="row">
                                        <div class="col-2 text-center">
                                            <h4><i><b>Servicios:</b></i></h4>
                                        </div>

                                        <div class="col-2">
                                            <div class="custom-control custom-checkbox">
                                                <input class="custom-control-input" type="checkbox" id="check_externo">
                                                <label for="check_externo" class="custom-control-label">Externo</label>
                                            </div>


                                            <div class="custom-control custom-checkbox">
                                                <input class="custom-control-input" type="checkbox" id="check_repuestos">
                                                <label for="check_repuestos" class="custom-control-label">Repuestos</label>
                                            </div>
                                        </div>

                                        <div class="col-7 justify-content-center">
                                            <div class="card card-outline card-success">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-12 col-sm-6 col-lg-4">
                                                            <div class="custom-control custom-checkbox">
                                                                <input class="custom-control-input" type="checkbox" id="check_montallant">
                                                                <label for="check_montallant" class="custom-control-label">Monta llantas</label>
                                                            </div>
                                                        </div>

                                                        <div class="col-12 col-sm-6 col-lg-4">
                                                            <div class="custom-control custom-checkbox">
                                                                <input class="custom-control-input" type="checkbox" id="check_lubricacion">
                                                                <label for="check_lubricacion" class="custom-control-label">Lubricacion</label>
                                                            </div>
                                                        </div>

                                                        <div class="col-12 col-sm-6 col-lg-4">
                                                            <div class="custom-control custom-checkbox">
                                                                <input class="custom-control-input" type="checkbox" id="check_lampintu">
                                                                <label for="check_lampintu" class="custom-control-label">Lamina y pintura</label>
                                                            </div>
                                                        </div>

                                                        <div class="col-12 col-sm-6 col-lg-4">
                                                            <div class="custom-control custom-checkbox">
                                                                <input class="custom-control-input" type="checkbox" id="check_elec">
                                                                <label for="check_elec" class="custom-control-label">Electrico</label>
                                                            </div>
                                                        </div>

                                                        <div class="col-12 col-sm-6 col-lg-4">
                                                            <div class="custom-control custom-checkbox">
                                                                <input class="custom-control-input" type="checkbox" id="check_alinbalan">
                                                                <label for="check_alinbalan" class="custom-control-label">Alineacion y balanceo</label>
                                                            </div>
                                                        </div>

                                                        <div class="col-12 col-sm-6 col-lg-4">
                                                            <div class="custom-control custom-checkbox">
                                                                <input class="custom-control-input" type="checkbox" id="check_frenos">
                                                                <label for="check_frenos" class="custom-control-label">Frenos</label>
                                                            </div>
                                                        </div>

                                                        <div class="col-12 col-sm-6 col-lg-4">
                                                            <div class="custom-control custom-checkbox">
                                                                <input class="custom-control-input" type="checkbox" id="check_muellsuspen">
                                                                <label for="check_muellsuspen" class="custom-control-label">Muelles y suspencion</label>
                                                            </div>
                                                        </div>

                                                        <div class="col-12 col-sm-6 col-lg-4">
                                                            <div class="custom-control custom-checkbox">
                                                                <input class="custom-control-input" type="checkbox" id="check_vidrios">
                                                                <label for="check_vidrios" class="custom-control-label">Vidrios</label>
                                                            </div>
                                                        </div>

                                                        <div class="col-12 col-sm-6 col-lg-4">
                                                            <div class="custom-control custom-checkbox">
                                                                <input class="custom-control-input" type="checkbox" id="check_radio">
                                                                <label for="check_radio" class="custom-control-label">Radio</label>
                                                            </div>
                                                        </div>

                                                        <div class="col-12 col-sm-6 col-lg-4">
                                                            <div class="custom-control custom-checkbox">
                                                                <input class="custom-control-input" type="checkbox" id="check_otro">
                                                                <label for="check_otro" class="custom-control-label">Otro</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <hr class="my-4">

                                    <div class="row">
                                        <div class="col-3">
                                            <div id="accordion">
                                                <div class="card card-primary">
                                                    <div class="card-header text-center">
                                                        <h4 class="card-title w-100">
                                                            <a class="d-block w-100" data-toggle="collapse" href="#collapsediagonostico">
                                                                Diagnostico
                                                            </a>
                                                        </h4>
                                                    </div>

                                                    <div id="collapsediagonostico" class="collapse" data-parent="#accordion">
                                                        <div class="card-body">
                                                            <div class="form-group">
                                                                <textarea class="form-control" rows="10" placeholder="Digite su diagnostico ..."></textarea>
                                                            </div>
                                                        </div>
                                                        <!-- /.card -->
                                                    </div>
                                                </div>
                                            </div> <!-- /.row -->
                                        </div>

                                        <div class="col-9">
                                            <div id="accordion">
                                                <div class="card card-success">
                                                    <div class="card-header text-center">
                                                        <h4 class="card-title w-100">
                                                            <a class="d-block w-100" data-toggle="collapse" href="#collapserepuestos">
                                                                Repuestos
                                                            </a>
                                                        </h4>
                                                    </div>

                                                    <div id="collapserepuestos" class="collapse" data-parent="#accordion">
                                                        <div class="card-body">
                                                            <table class="table table-bordered text-center">
                                                                <thead>
                                                                    <tr>
                                                                        <th style="width: 500px">DESCRIPCIÓN</th>
                                                                        <th>REFERENCIA</th>
                                                                        <th>CANTIDAD</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <td style="width: 300px"> <input type="text" class="form-control" id="descripcion_repuestos1" name="descripcion_repuestos1"></td>
                                                                        <td><input type="text" class="form-control" id="descripcion_repuestos2" name="descripcion_repuestos2"></td>
                                                                        <td><input type="text" class="form-control" id="descripcion_repuestos3" name="descripcion_repuestos3"></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td style="width: 300px"> <input type="text" class="form-control" id="referencia_repuestos1" name="referencia_repuestos1"></td>
                                                                        <td><input type="text" class="form-control" id="referencia_repuestos2" name="referencia_repuestos2"></td>
                                                                        <td><input type="text" class="form-control" id="referencia_repuestos3" name="referencia_repuestos3"></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td style="width: 300px"> <input type="text" class="form-control" id="cantidad_repuestos2" name="cantidad_repuestos2"></td>
                                                                        <td><input type="text" class="form-control" id="precio2" name="precio2"></td>
                                                                        <td><input type="text" class="form-control" id="precio3" name="precio3"></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td style="width: 300px"> <input type="text" class="form-control" id="proveedor1" name="proveedor1"></td>
                                                                        <td><input type="text" class="form-control" id="proveedor2" name="proveedor2"></td>
                                                                        <td><input type="text" class="form-control" id="proveedor3" name="proveedor3"></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td style="width: 300px"> <input type="text" class="form-control" id="proveedor1" name="proveedor1"></td>
                                                                        <td><input type="text" class="form-control" id="proveedor2" name="proveedor2"></td>
                                                                        <td><input type="text" class="form-control" id="proveedor3" name="proveedor3"></td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <!-- /.card -->
                                                    </div>
                                                </div>
                                            </div> <!-- /.row -->
                                        </div>
                                    </div>

                                    <hr class="my-4 bg-dark">

                                    <div class="row d-flex justify-content-center">
                                        <div class="col-6">
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
                                </div><!-- /.container-fluid -->
                            </div>
                            <!-- /.content -->
                        </div>
                        <!-- /.content-wrapper -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>