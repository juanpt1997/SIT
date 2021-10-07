<?php

// if(!validarModulo('CARGAR_OPCION')) {
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
                    <h1 class="m-0 text-dark "><b><i>Plan de rodamiento</i></b></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                        <li class="breadcrumb-item active">Plantilla</li>
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
                <div class="col-12">
                    <button type="button" class="btn bg-gradient-success btn-nuevoplanrodamiento" data-toggle="modal" data-target="#modal-nuevoplanrodamiento"><i class="fas fa-paste"></i> Nuevo plan de rodamiento</button>
                </div>
            </div>
            <!-- ===================== 
              AGREGAR FILAS Y COLUMNAS PARA EL DESARROLLO 
            ========================= -->
            <div class="row mt-2">
                <div class="col-12">
                    <div class="card">
                        <div class="card card-outline card-success">
                            <div class="card-body">
                                <!--|||TABLA PROTOCOLO DE ALISTAMIENTO|||-->
                                <div class="table-responsive">
                                    <table id="tblplanrodamiento" class="table table-bordered table-striped text-center nowrap tablasBtnExport">
                                        <thead>
                                            <tr>
                                                <th>...</th>
                                                <th>ID</th>
                                                <th>Placa</th>
                                                <th># Interno afiliado</th>
                                                <th>Marca</th>
                                                <th>Modelo</th>
                                                <th>Capacidad</th>
                                                <th>Fecha de Servicio</th>
                                                <th>Empresa cliente</th>
                                                <th>Cantidad de Pasajeros</th>
                                                <th>Hora de Inicio</th>
                                                <th>Hora final</th>
                                                <th>Origen</th>
                                                <th>Destino</th>
                                                <th>Kilómetros recorridos</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <tr>
                                                <td>
                                                    <button type="button" class="btn btn-success btn-sm btn-editarAlistamiento" data-toggle="modal" data-target="#modal-nuevoplanrodamiento"><i class="fas fa-edit"></i></button>
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
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- ==============================
  MODAL DE INGRESO NUEVO PLAN DE RODAMIENTO
 ============================== -->

<div class="modal fade show" id="modal-nuevoplanrodamiento" style="display: none; padding-right: 17px;" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h4 class="modal-title">Ingreso de Datos</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-sm-6 col-lg-4">
                            <div class="form-group">
                                <label>ID</label>
                                <input id="iddatosroda" name="idvehiculo" class="form-control datosrodamiento" type="text" required>
                            </div>
                        </div>

                        <div class="col-12 col-sm-6 col-lg-4">
                            <div class="form-group">
                                <label>Placa</label>
                                <select id="placadatosroda" name="placa" class="form-control select2-single" type="number" style="width: 99%" required>

                                </select>
                            </div>
                        </div>

                        <div class="col-12 col-sm-6 col-lg-4">
                            <div class="form-group">
                                <label># Interno de Afiliado</label>
                                <input id="numinternodatosroda" name="numinterno" type="text" class="form-control datosroda" placeholder="Numero de afiliado" required>
                            </div>
                        </div>

                        <div class="col-12 col-sm-6 col-lg-4">
                            <div class="form-group">
                                <label>Marca</label>
                                <input id="marcadatosroda" name="idmarca" type="text" class="form-control datosroda" placeholder="Digite marca del vehículo" required>
                            </div>
                        </div>

                        <div class="col-12 col-sm-6 col-lg-4">
                            <div class="form-group">
                                <label>Modelo</label>
                                <input id="modelodatosroda" type="text" class="form-control datosroda" placeholder="Año modelo del vehículo" required>
                            </div>
                        </div>

                        <div class="col-12 col-sm-6 col-lg-4">
                            <div class="form-group">
                                <label>Capacidad</label>
                                <input id="capacidaddatosroda" type="text" class="form-control datosroda" placeholder="Capacidad del Vehículo" required>
                            </div>
                        </div>

                        <!-- ******* SELECT2 DE RUTAS (esto debe ir de primero) ******* -->
                        <!-- ******* TIPO DE VINCULACION (se trae del vehiculo) ******* -->
                        <!-- ******* CONDUCTOR ******* -->
                        <!-- ******* CLIENTE (lista clientes)******* -->
                        <!-- ******* TIPO DE SERVICIO (ENTRADA / SALIDA)******* -->


                        <div class="col-12 col-sm-6 col-lg-4">
                            <div class="form-group">
                                <label>Fecha de Servicio</label>
                                <div class="input-group date" data-target-input="nearest">
                                    <input type="date" class="form-control" id="fecha_servicio" name="fecha_servicio" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-sm-6 col-lg-4">
                            <div class="form-group">
                                <label>Empresa</label>
                                <input id="Empresadatosroda" type="text" class="form-control datosroda" placeholder="Digite nombre de la empresa" required>
                            </div>
                        </div>

                        <div class="col-12 col-sm-6 col-lg-4">
                            <div class="form-group">
                                <label>Cantidad de Pasajeros</label>
                                <input id="cantidadpasajerosdatosroda" type="text" class="form-control datosroda" placeholder="Digite cantidad de pasajeros" required>
                            </div>
                        </div>

                        <div class="col-12 col-sm-6 col-lg-4">
                            <div class="form-group">
                                <label>Hora de inicio</label>
                                <div class="input-group time" data-target-input="nearest">
                                    <input type="time" class="form-control" id="hora_inicio" name="h_salida" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-sm-6 col-lg-4">
                            <div class="form-group">
                                <label>Hora de final</label>
                                <div class="input-group time" data-target-input="nearest">
                                    <input type="time" class="form-control" id="hora_final" name="h_llegada" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-sm-6 col-lg-4">
                            <div class="form-group">
                                <label>Origen</label>
                                <input id="origendatosroda" name="idorigne" type="text" class="form-control datosroda" placeholder="Digite el origien del vehículo" required>
                            </div>
                        </div>

                        <div class="col-12 col-sm-6 col-lg-4">
                            <div class="form-group">
                                <label>Destino</label>
                                <input id="destinodatosroda" name="iddestino" type="text" class="form-control datosroda" placeholder="Digite el destino del vehículo" required>
                            </div>
                        </div>

                        <div class="col-12 col-sm-6 col-lg-4">
                            <div class="form-group">
                                <label>Kilometros recorridos</label>
                                <input id="kmrecorridosdatosroda" name="kmrecorrido" type="text" class="form-control datosroda" placeholder="Digite los Kilometros recorridos" required>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer justify-content-center bg-info">
                <button type="submit" form="datosroda_form" class="btn btn-success"><i class="fas fa-print"></i> Guardar</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
</div>