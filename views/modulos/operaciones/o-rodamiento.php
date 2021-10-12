<?php

if (!validarPermiso('M_OPERACIONES', 'R')) {
    echo "<script> window.location = 'inicio'; </script>";
}

$Vehiculos = ControladorVehiculos::ctrListaVehiculos();
$Marca = ControladorVehiculos::ctrMostrarMarca();
$Rutas = ControladorRutas::ctrListarRutas();
$Clientes = ControladorClientes::ctrVerCliente();
$Plan_r = ControladorRodamientos::ctrListarRodamientos();




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
                                    <table id="tblplanrodamiento" class="table table-responsive table-bordered table-striped text-center text-nowrap">
                                        <thead>
                                            <tr>
                                                <th>...</th>
                                                <th>ID</th>
                                                <th>Conductor</th>
                                                <th>Placa</th>
                                                <th>Cliente</th>
                                                <th>Num. Interno afiliado</th>
                                                <th>Marca</th>
                                                <th>Modelo</th>
                                                <th>Capacidad</th>
                                                <th>Tipo de vinculación</th>
                                                <th>Ruta (origen y destino)</th>
                                                <th>Fecha del servicio</th>
                                                <th>Tipo de servicio</th>
                                                <th>Cantidad de Pasajeros</th>
                                                <th>Hora de Inicio</th>
                                                <th>Hora final</th>
                                                <th>Kilómetros recorridos</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php foreach ($Plan_r as $key => $value) : ?>
                                                <tr>
                                                    <td>
                                                        <button type="button" class="btn btn-success btn-sm btn-editarRodamiento" id_rodamiento="<?= $value['id'] ?>" data-toggle="modal" data-target="#modal-nuevoplanrodamiento"><i class="fas fa-edit"></i></button>
                                                        <?php if (validarPermiso('M_OPERACIONES', 'D')) : ?>
                                                            <button type="button" class="btn btn-danger btn-sm btn-eliminar-rodamiento" id_rodamiento="<?= $value['id'] ?>"><i class="fas fa-trash"></i></button>
                                                        <?php endif ?>
                                                    </td>
                                                    <td><?= $value['id'] ?></td>
                                                    <td><?= $value['conductor'] ?></td>
                                                    <td><?= $value['placa'] ?></td>
                                                    <td><?= $value['cliente'] ?></td>
                                                    <td><?= $value['numinterno'] ?></td>
                                                    <td><?= $value['marca'] ?></td>
                                                    <td><?= $value['modelo'] ?></td>
                                                    <td><?= $value['capacidad'] ?></td>
                                                    <td><?= $value['tipovinculacion'] ?></td>
                                                    <td><?= $value['ruta'] ?></td>
                                                    <td><?= $value['fecha_servicio'] ?></td>
                                                    <td><?= $value['tipo_servicio'] ?></td>
                                                    <td><?= $value['cantidad_pasajeros'] ?></td>
                                                    <td><?= $value['h_inicio'] ?></td>
                                                    <td><?= $value['h_final'] ?></td>
                                                    <td><?= $value['kmrecorridos'] ?></td>
                                                </tr>
                                            <?php endforeach ?>
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
                <h4 class="modal-title">
                    <span id="titulo_modal_rodamiento"></span>
                    <a class="btn btn-app bg-success btn-copiar-rodamiento d-none" id="btn-copiar">
                        <i class="fas fa-copy"></i> Copiar
                    </a>
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <form method="post" enctype="multipart/form-data" id="formulario_rodamiento">
                <div class="modal-body">
                    <div class="card-body">

                        <input type="hidden" id="observador_conductoresRodamiento" idconductor="">

                        <hr class="my-4">

                        <div class="col-md text-center">
                            <div class="form-group">
                                <label><i>RUTA (origen y destino)</i></label>
                                <select id="ruta" name="idruta" class="form-control select2-single" type="number" style="width: 99%;border:1px solid #ff0000" required>
                                    <option value="" selected>Seleccione una ruta</option>
                                    <?php foreach ($Rutas as $key => $value) : ?>
                                        <option value="<?= $value['id'] ?>"><?= $value['origendestino'] ?></option>
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
                                    <input id="capacidad" name="capacidad" type="text" class="form-control datosroda" placeholder="Capacidad del vehículo" required readonly>
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
                                        <option value="">Seleccione un tipo de servicio</option>
                                        <option value="Entrada">Entrada</option>
                                        <option value="Salida">Salida</option>
                                    </select>
                                </div>
                            </div>



                            <div class="col-12 col-sm-6 col-lg-4">
                                <div class="form-group">
                                    <label>Cantidad de Pasajeros</label>
                                    <input id="cantidadpasajerosdatosroda" name="cantidadpasajeros" type="text" class="form-control datosroda" placeholder="Digite cantidad de pasajeros" required>
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
                    <?php if (validarPermiso('M_OPERACIONES', 'U')) : ?>
                        <button type="submit" class="btn btn-success"><i class="fas fa-print"></i> Guardar</button>
                    <?php endif ?>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                </div>
                <?php
                $crearPlanRodamiento = new ControladorRodamientos();
                $crearPlanRodamiento->ctrAgregarEditarRodamiento();
                ?>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
</div>