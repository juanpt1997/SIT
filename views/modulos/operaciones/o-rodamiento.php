<?php

// if(!validarModulo('CARGAR_OPCION')) {
//     echo "<script> window.location = 'inicio'; </script>";
// }

$Vehiculos = ControladorVehiculos::ctrListaVehiculos();
$Marca = ControladorVehiculos::ctrMostrarMarca();
$Rutas = ControladorRutas::ctrListarRutas();
$Clientes = ControladorClientes::ctrVerCliente();





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
                    <h1 class="m-0 text-dark "><b><i>Plan de rodamiento <i class="fas fa-road"></i></i></b></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                        <li class="breadcrumb-item active">Plan de rodamiento</li>
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
                    <button type="button" class="btn btn-md bg-gradient-success btn-nuevoplanrodamiento" data-toggle="modal" data-target="#modal-nuevoplanrodamiento"><i class="fas fa-map-marked-alt"></i> Añadir plan de rodamiento</button>
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
                                <!--|||TABLA PLAN DE RODAMIENTO|||-->
                                <div class="table-responsive">
                                    <table id="tblplanrodamiento" class="table table-bordered table-striped text-center nowrap tablasBtnExport">
                                        <thead>
                                            <tr>
                                                <th>...</th>
                                                <th>ID</th>
                                                <th>Placa</th>
                                                <th>Num. Interno afiliado</th>
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

                    <hr class="my-4">

                    <div class="col-md text-center">
                        <div class="form-group">
                            <label><i>RUTA (origen y destino)</i></label>
                            <select id="ruta" name="idruta" class="form-control select2-single" type="number" style="width: 99%;border:1px solid #ff0000" required>
                                <option value="" selected>Seleccione una ruta</option>
                                <?php foreach ($Rutas as $key => $value) : ?>
                                    <option value="<?= $value['id'] ?>"><?= $value['nombreruta'] ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>


                    <hr class="my-4">

                    <div class="row">


                        <div class="col-12 col-sm-6 col-lg-4">
                            <div class="form-group">
                                <label><i>ID</i></label>
                                <input id="id_rodamiento" name="id_rodamiento" class="form-control" type="text" readonly>
                            </div>
                        </div>

                        <div class="col-12 col-sm-6 col-lg-4">
                            <div class="form-group">
                                <label><i>Placa</i></label>
                                <select id="placa_roda" name="placa" class="form-control select2-single" type="number" style="width: 99%" required>
                                    <option value="" selected>Seleccione un vehículo</option>
                                    <?php foreach ($Vehiculos as $key => $value) : ?>
                                        <option value="<?= $value['idvehiculo'] ?>"><?= $value['placa'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-12 col-sm-6 col-lg-4">
                            <div class="form-group">
                                <label><i>Conductor</i></label>
                                <select id="idconductor" name="idconductor" class="form-control select2-single conductores" type="number" style="width: 99%" required>
                                    <option value="" selected>Seleccione un conductor</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-12 col-sm-6 col-lg-4">
                            <div class="form-group">
                                <label><i>Cliente</i></label>
                                <select id="idcliente" name="idcliente" class="form-control select2-single" type="number" style="width: 99%" required>
                                    <option value="" selected>Seleccione un cliente</option>
                                    <?php foreach ($Clientes as $key => $value) : ?>
                                        <option value="<?= $value['idcliente'] ?>"><?= $value['clientexist'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>


                        <div class="col-12 col-sm-6 col-lg-4">
                            <div class="form-group">
                                <label>Num. Interno de Afiliado</label>
                                <input id="numinterno" name="numinterno" type="text" class="form-control datosroda" placeholder="Número interno de afiliado" required readonly>
                            </div>
                        </div>

                        <div class="col-12 col-sm-6 col-lg-4">
                            <div class="form-group">
                                <label>Marca</label>
                                <input id="marca" name="marca" type="text" class="form-control datosroda" placeholder="Marca del vehículo" required readonly>
                            </div>
                        </div>

                        <div class="col-12 col-sm-6 col-lg-4">
                            <div class="form-group">
                                <label>Modelo</label>
                                <input id="modelo" name="modelo" type="text" class="form-control datosroda" placeholder="Modelo del vehículo" required readonly>
                            </div>
                        </div>

                        <div class="col-12 col-sm-6 col-lg-4">
                            <div class="form-group">
                                <label>Capacidad</label>
                                <input id="capacidad" type="text" class="form-control datosroda" placeholder="Capacidad del vehículo" required readonly>
                            </div>
                        </div>

                        <div class="col-12 col-sm-6 col-lg-4">
                            <div class="form-group">
                                <label>Tipo de vinculación</label>
                                <input id="tipo_vinculacion" name="tipo_vinculacion" type="text" class="form-control datosroda" placeholder="Tipo de vinculación" required readonly>
                            </div>
                        </div>

                        <div class="col-12 col-sm-6 col-lg-4">
                            <div class="form-group">
                                <label>Fecha del servicio</label>
                                <div class="input-group date" data-target-input="nearest">
                                    <input type="date" class="form-control datosroda" id="fecha_servicio" name="fecha_servicio" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-sm-6 col-lg-4">
                            <div class="form-group">
                                <label>Tipo de servicio</label>
                                <select id="tipo_servicio" name="tipo_servicio" class="form-control select2-single datosroda" type="number" style="width: 99%" required>
                                    <option value="Entrada">Entrada</option>
                                    <option value="Salida">Salida</option>
                                </select>
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
                                    <input type="time" class="form-control datosroda" id="hora_inicio" name="h_inicio" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-sm-6 col-lg-4">
                            <div class="form-group">
                                <label>Hora de final</label>
                                <div class="input-group time" data-target-input="nearest">
                                    <input type="time" class="form-control datosroda" id="hora_final" name="h_final" required>
                                </div>
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