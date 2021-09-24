<?php

if (!validarModulo('M_GESTION_HUMANA')) {
    echo "<script> window.location = 'inicio'; </script>";
}

$Ausentismos = ControladorAusentismo::ctrListaAusentismo();
$ListaEmpleados = ControladorAusentismo::ctrListaPersonal();
$TiposAusentismo = ControladorAusentismo::ctrTiposAusentismo();

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
                    <h1 class="m-0 text-dark "><b><i>Control de ausentismo</i></b></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                        <li class="breadcrumb-item active">Gestión humana</li>
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
            <div id="ghTabs"></div>

            <div class="card card-secondary card-outline">
                <div class="card-body">
                    <!-- ===================================================
                        BOTON PARA AGREGAR NUEVO EMPLEADO
                    =================================================== -->
                    <div class="row d-none">
                        <div class="col-12">
                            <button type="button" class="btn btn-primary btn-nuevoAusentismo" data-toggle="modal" data-target="#AusentismoModal">
                                <i class="fas fa-plus-circle"></i> Nuevo
                            </button>
                        </div>
                    </div>

                    <!-- ===================== 
                        TABLA CONTROL DE AUSENTISMO
                    ========================= -->
                    <div class="row mt-2">
                        <div class="col-12">
                            <table id="tblAusentismo" class="table table-sm table-striped table-bordered dt-responsive w-100">
                                <thead class="thead-light text-sm text-nowrap">
                                    <tr>
                                        <th>Id</th>
                                        <th>Fecha</th>
                                        <th>Cédula</th>
                                        <th>Empleado</th>
                                        <th>Cargo</th>
                                        <th>Area</th>
                                        <th>Tipo ausentismo</th>
                                        <th>Fecha inicio</th>
                                        <th>Fecha fin</th>
                                        <th>Nro días</th>
                                        <th>Hora inicio</th>
                                        <th>Hora fin</th>
                                        <th>Total horas</th>
                                        <th>Total Días</th>
                                        <th>Total Hora</th>
                                        <th>Dx Incapacidad</th>
                                        <th>Descripción</th>
                                        <th>Eps</th>
                                        <th>Salario</th>
                                    </tr>
                                </thead>
                                <tbody class="text-sm">
                                    <?php foreach ($Ausentismos as $key => $value) : ?>
                                        <?php
                                        $BotonEditar = "<div class='btn-group'>
                                                            {$value['idAusentismo']}
                                                            <button type='button' class='btn btn-editAusentismo' data-toggle='modal' data-target='#AusentismoModal' idAusentismo='{$value['idAusentismo']}'>
                                                                <i class='fas fa-edit text-info'></i>
                                                            </button>
                                                        </div>";

                                        ?>
                                        <tr>
                                            <!-- <td style="vertical-align: middle;"><?= $value['idAusentismo'] ?><button class="btn" type="button"><i class="fas fa-edit text-warning"></i></button></td> -->
                                            <td style="vertical-align: middle;"><?= $BotonEditar ?></td>
                                            <td><?= $value['fecha'] ?></td>
                                            <td><?= $value['Documento'] ?></td>
                                            <td><?= $value['Nombre'] ?></td>
                                            <td><?= $value['Cargo'] ?></td>
                                            <td><?= $value['Proceso'] ?></td>
                                            <td><?= $value['tipoAusentismo'] ?></td>
                                            <td><?= $value['fechaini'] ?></td>
                                            <td><?= $value['fechafin'] ?></td>
                                            <td><?= $value['ndias_laborales'] ?></td>
                                            <td><?= $value['hora_inicio'] ?></td>
                                            <td><?= $value['hora_fin'] ?></td>
                                            <td><?= $value['total_horas'] ?></td>
                                            <td><?= $value['total_dias_laborales'] ?></td>
                                            <td><?= $value['total_hora'] ?></td>
                                            <td><?= $value['dx_incapacidad'] ?></td>
                                            <td><?= $value['descripcion'] ?></td>
                                            <td><?= $value['Eps'] ?></td>
                                            <td><?= $value['salario_basico'] ?></td>
                                        </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- ===================================================
    MODALS
=================================================== -->
<div id="AusentismoModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title font-weight-bold" id="titulo-modal-ausentismo">NUEVO</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- ===================================================
                    FORMULARIO
                =================================================== -->
                <div class="row">
                    <div class="col-12">
                        <form id="frmAusentismo" method="post" enctype="multipart/form-data">
                            <input type="hidden" id="idAusentismo" name="idAusentismo" value="">
                            <!-- ===================================================
                                CONTROL AUSENTISMO
                            =================================================== -->
                            <div class="card card-info card-outline">
                                <div class="card-header font-weight-bold">
                                    Control ausentismo
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <!-- ===================================================
                                            Fecha *
                                        =================================================== -->
                                        <div class="col-12 col-md-6 col-lg-4">
                                            <div class="form-group">
                                                <label for="exampleInput1">Fecha *</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                                    </div>
                                                    <input type="date" class="form-control" name="fecha" id="fecha" value="<?php echo date('Y-m-d'); ?>" required>
                                                </div>
                                                <!-- /.input group -->
                                            </div>
                                        </div>

                                        <!-- ===================================================
                                            Empleado *
                                        =================================================== -->
                                        <div class="col-12 col-md-6 col-lg-4">
                                            <div class="form-group">
                                                <label for="idPersonal">Empleado *</label>
                                                <div class="input-group">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                                    </div>
                                                    <select class="form-control select2-single select2-hidden-accessible" style="width: 70%;" name="idPersonal" id="idPersonal" required>
                                                        <option value="" selected>Seleccione un empleado</option>
                                                        <?php foreach ($ListaEmpleados as $key => $value) : ?>
                                                            <option value="<?= $value['idPersonal'] ?>"><?= $value['Nombre'] ?></option>
                                                        <?php endforeach ?>
                                                    </select>
                                                </div>
                                                <!-- /.input group -->
                                            </div>
                                        </div>

                                        <!-- ===================================================
                                            Cédula
                                        =================================================== -->
                                        <div class="col-12 col-md-6 col-lg-4">
                                            <div class="form-group">
                                                <label for="exampleInput1">Cédula</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                                                    </div>
                                                    <input class="form-control datosEmpleado" type="text" id="cedula" readonly>
                                                </div>
                                                <!-- /.input group -->
                                            </div>
                                        </div>

                                        <!-- ===================================================
                                            Cargo
                                        =================================================== -->
                                        <div class="col-12 col-md-6 col-lg-4">
                                            <div class="form-group">
                                                <label for="exampleInput1">Cargo</label>
                                                <input class="form-control datosEmpleado" type="text" id="cargo" readonly>
                                            </div>
                                        </div>


                                        <!-- ===================================================
                                            Area
                                        =================================================== -->
                                        <div class="col-12 col-md-6 col-lg-4">
                                            <div class="form-group">
                                                <label for="exampleInput1">Área</label>
                                                <input class="form-control datosEmpleado" type="text" id="area" readonly>
                                            </div>
                                        </div>

                                        <!-- ===================================================
                                            Tipo de ausentismo *
                                        =================================================== -->
                                        <div class="col-12 col-md-6 col-lg-4">
                                            <div class="form-group">
                                                <label for="exampleInput1">Tipo de ausentismo *</label>
                                                <select id="idtipo" class="form-control" name="idtipo" required>
                                                    <option value="" selected>Seleccione una opción</option>
                                                    <?php foreach ($TiposAusentismo as $key => $value) : ?>
                                                        <option value="<?= $value['idtipo'] ?>"><?= $value['descripcion'] ?></option>
                                                    <?php endforeach ?>
                                                </select>
                                            </div>
                                        </div>

                                        <!-- ===================================================
                                            Fecha de inicio *
                                        =================================================== -->
                                        <div class="col-12 col-md-6 col-lg-4">
                                            <div class="form-group">
                                                <label for="exampleInput1">Fecha inicio *</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                                    </div>
                                                    <input type="date" class="form-control" name="fechaini" id="fechaini" required>
                                                </div>
                                                <!-- /.input group -->
                                            </div>
                                        </div>

                                        <!-- ===================================================
                                            Fecha fin *
                                        =================================================== -->
                                        <div class="col-12 col-md-6 col-lg-4">
                                            <div class="form-group">
                                                <label for="exampleInput1">Fecha fin *</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                                    </div>
                                                    <input type="date" class="form-control" name="fechafin" id="fechafin" required>
                                                </div>
                                                <!-- /.input group -->
                                            </div>
                                        </div>

                                        <!-- ===================================================
                                            Número días laborales
                                        =================================================== -->
                                        <div class="col-12 col-md-6 col-lg-4">
                                            <div class="form-group">
                                                <label for="exampleInput1">Número días laborales</label>
                                                <input class="form-control" type="text" id="ndias_laborales" name="ndias_laborales" maxlength="50">
                                            </div>
                                        </div>

                                        <!-- ===================================================
                                            Hora inicio
                                        =================================================== -->
                                        <div class="col-12 col-md-6 col-lg-4">
                                            <div class="form-group">
                                                <label for="exampleInput1">Hora inicio</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="far fa-clock"></i></span>
                                                    </div>
                                                    <input class="form-control" type="time" id="hora_inicio" name="hora_inicio">
                                                </div>
                                                <!-- /.input group -->
                                            </div>
                                        </div>

                                        <!-- ===================================================
                                            Hora fin
                                        =================================================== -->
                                        <div class="col-12 col-md-6 col-lg-4">
                                            <div class="form-group">
                                                <label for="exampleInput1">Hora fin</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="far fa-clock"></i></span>
                                                    </div>
                                                    <input class="form-control" type="time" id="hora_fin" name="hora_fin">
                                                </div>
                                                <!-- /.input group -->
                                            </div>
                                        </div>

                                        <!-- ===================================================
                                            Total horas
                                        =================================================== -->
                                        <div class="col-12 col-md-6 col-lg-4">
                                            <div class="form-group">
                                                <label for="exampleInput1">Total horas</label>
                                                <input class="form-control" type="text" id="total_horas" name="total_horas" maxlength="50">
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>


                            <!-- ===================================================
                                CONSOLIDADO
                            =================================================== -->
                            <div class="card card-info card-outline">
                                <div class="card-header font-weight-bold">
                                    Consolidado
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <!-- ===================================================
                                            Total hora
                                        =================================================== -->
                                        <div class="col-12 col-md-6 col-lg-4">
                                            <div class="form-group">
                                                <label for="exampleInput1">Total hora</label>
                                                <input class="form-control" type="number" id="total_hora" name="total_hora" min="0" max="999999999">
                                            </div>
                                        </div>

                                        <!-- ===================================================
                                            Total días laborales
                                        =================================================== -->
                                        <div class="col-12 col-md-6 col-lg-4">
                                            <div class="form-group">
                                                <label for="exampleInput1">Total días laborales</label>
                                                <input class="form-control" type="number" id="total_dias_laborales" name="total_dias_laborales" min="0" max="999999999">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- ===================================================
                                SOLO CUANDO ES ACCIDENTE DE TRABAJO
                            =================================================== -->
                            <div class="card card-info card-outline">
                                <div class="card-header font-weight-bold">
                                    Solo cuando es accidente de trabajo
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <!-- ===================================================
                                            Dx incapacidad
                                        =================================================== -->
                                        <div class="col-12 col-md-6 col-lg-4">
                                            <div class="form-group">
                                                <label for="exampleInput1">Dx incapacidad</label>
                                                <input class="form-control" type="text" id="dx_incapacidad" name="dx_incapacidad" maxlength="50">
                                            </div>
                                        </div>

                                        <!-- ===================================================
                                            Eps
                                        =================================================== -->
                                        <div class="col-12 col-md-6 col-lg-4">
                                            <div class="form-group">
                                                <label for="exampleInput1">Eps</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-clinic-medical"></i></span>
                                                    </div>
                                                    <input class="form-control datosEmpleado" type="text" id="eps" readonly>
                                                </div>
                                                <!-- /.input group -->
                                            </div>
                                        </div>

                                        <!-- ===================================================
                                            Salario
                                        =================================================== -->
                                        <div class="col-12 col-md-6 col-lg-4">
                                            <div class="form-group">
                                                <label for="exampleInput1">Salario</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-hand-holding-usd"></i></span>
                                                    </div>
                                                    <input class="form-control datosEmpleado" type="text" id="salario" readonly>
                                                </div>
                                                <!-- /.input group -->
                                            </div>
                                        </div>

                                        <!-- ===================================================
                                            Descripción
                                        =================================================== -->
                                        <div class="col-12 col-md-6 col-lg-4">
                                            <div class="form-group">
                                                <label for="exampleInput1">Descripción</label>
                                                <textarea id="descripcion" class="form-control" name="descripcion" rows="3" maxlength="300"></textarea>
                                            </div>
                                        </div>


                                    </div>
                                </div>
                            </div>


                    </div>
                </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                <button class="btn btn-success float-right" type="submit" form="frmAusentismo"><i class="fas fa-save"></i> Guardar</button>
            </div>
            <?php
            $guardarAusentismo = ControladorAusentismo::ctrGuardarAusentismo();
            ?>
        </div>
    </div>
</div>