<?php

if (!validarPermiso('M_GESTION_HUMANA', 'R')) {
    echo "<script> window.location = 'inicio'; </script>";
}

$FechasPagoSS = ControladorPagoSS::ctrMostrarFechas();

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
                    <h1 class="m-0 text-dark "><b><i>Pago seguridad social <i class="fas fa-file-invoice-dollar"></i></i></b></h1>
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
                    <div class="row">
                        <div class="col-12">
                            <button type="button" class="btn btn-primary btn-nuevoPagoSS" data-toggle="modal" data-target="#PagoSSModal">
                                <i class="fas fa-plus-circle"></i> Nuevo
                            </button>
                        </div>
                    </div>

                    <!-- ===================== 
                        TABLA RANGOS DE PAGO SEGURIDAD SOCIAL
                    ========================= -->
                    <div class="row mt-2">
                        <div class="col-12">
                            <table class="table table-responsive table-sm table-striped table-bordered tablasBtnExport w-100 text-center">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Id</th>
                                        <th>Fecha ini.</th>
                                        <th>Fecha fin.</th>
                                        <th>Observaciones</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($FechasPagoSS as $key => $value) : ?>
                                        <tr>
                                            <td><?= $value['idFechas'] ?></td>
                                            <td><?= $value['fechaini'] ?></td>
                                            <td><?= $value['fechafin'] ?></td>
                                            <td><?= $value['observaciones'] ?></td>
                                            <td><button type="button" class="btn btn-info btn-editarPagoSS" idFechas="<?= $value['idFechas'] ?>" data-toggle="modal" data-target="#PagoSSModal" fechaini="<?= $value['fechaini'] ?>" fechafin="<?= $value['fechafin'] ?>" observaciones="<?= $value['observaciones'] ?>"><i class="fas fa-edit"></i></button></td>
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

<div id="PagoSSModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
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
                        <form id="frmRangoFechas" method="post" enctype="multipart/form-data">
                            <div class="card border border-info">
                                <div class="card-body">
                                    <div class="row d-flex justify-content-center">
                                        <div class="col-12 col-md-6 col-lg-4">
                                            <div class="form-group">
                                                <label for="exampleInput1">Id</label>
                                                <input class="form-control" type="number" name="idFechas" id="idFechas" readonly value="">
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-6 col-lg-4">
                                            <div class="form-group">
                                                <label for="exampleInput1">Fechas</label>
                                                <input class="form-control" type="text" name="rangoFechas" id="rangoFechas" required>
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-6 col-lg-4">
                                            <div class="form-group">
                                                <label for="exampleInput1">Observaciones</label>
                                                <input class="form-control" type="text" name="observaciones" id="observaciones" maxlength="50" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <?php if (validarPermiso('M_GESTION_HUMANA', 'U')) : ?>
                                        <button class="btn btn-success float-right" type="submit"><i class="fas fa-save"></i> Guardar</button>
                                    <?php endif ?>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- ===================================================
                    TABLA CON LOS REGISTROS
                =================================================== -->
                <div class="row">
                    <div class="col-12 table-responsive">
                        <table id="tblPagoSS" class="table table-sm table-hover row-border w-100">
                            <thead class="thead-light">
                                <tr>
                                    <th>Cédula</th>
                                    <th>Empleado</th>
                                    <th>Seguridad social</th>
                                    <th>Pago</th>
                                    <th>Eps</th>
                                    <th>Arl</th>
                                    <th>Afp</th>
                                    <th>Cargo</th>
                                    <th>Sucursal</th>

                                </tr>
                            </thead>
                            <tbody id="tbodyPagoSS">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="col-12 text-right">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
</div>