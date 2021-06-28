<?php
 
//if(!validarModulo('CARGAR_OPCION')) {
//    echo "<script> window.location = 'inicio'; </script>";
//}

$listaPersonal = ControladorBloqueos::ctrListaPersonal();
$listaUltimo = ControladorBloqueos::ctrUltimoBloqueo();
//$historial = ControladorBloqueos::ctrHIstorial();



?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark ">Bloqueo de personal</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                        <li class="breadcrumb-item active">Bloqueo de personal</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                <!--BOTON NUEVO CONVENIO-->
                    <button type="button" class="btn btn-danger btn-md btn-agregarBloqueo" data-toggle="modal" data-target="#AgregarBloqueo">
                        <i class="fas fa-user-alt-slash"></i> Bloquear personal
                    </button>
                </div><!-- col -->
            </div> <!-- /.row -->
            <!-- ===================== 
              AGREGAR FILAS Y COLUMNAS PARA EL DESARROLLO 
            ========================= -->            
            <div class="row mt-2">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header bg-info"></div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-sm table-striped table-bordered dt-responsive table-hover tablasBtnExport w-100">
                                    <thead class="thead-light text-sm text-center">
                                        <tr>
                                            <th style="width:10px;">#</th>
                                            <th>Conductor</th>
                                            <th>Motivo</th>
                                            <th>Estado</th>
                                            <th>Fecha desbloqueo</th>
                                            <th>Usuario</th>
                                            <th>Acciones</th>
                                        </tr>                 
                                    </thead>
                                    <tbody>
                                        <?php foreach ($listaUltimo as $key => $value) : ?>
                                        <tr>
                                            <td><?= $value['idbloqueo'] ?></td>
                                            <td><?= $value['conductor'] ?></td>
                                            <td><?= $value['motivo'] ?></td>
                                            <td><?= $value['estado'] ?></td>
                                            <td><?= $value['fecha'] ?></td>
                                            <td><?= $value['nomUsuario'] ?></td>
                                            <td>
                                                <div class="btn-group" role="group" aria-label="Button group">
                                                    <button class="btn btn-sm btn-info btnHistorial" id_bloq="<?= $value['idPersonal'] ?>" data-toggle="modal" data-target="#BloqueoHistorial"><i class="fas fa-user-clock"></i></button>
                                                </div>

                                                <div class="btn-group" role="group" aria-label="Button group">
                                                    <button class="btn btn-sm btn-warning btnEditarBloqueo" data-toggle="modal" data-target="#AgregarBloqueo"><i class="fas fa-edit"></i></button>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php endforeach ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer bg-dark"></div>
                    </div>
                </div><!-- col -->
            </div> <!-- /.row -->

        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->


<!-- ==================================
     ========MODALS BLOQUEOS ==========
     ==================================-->


     <!--MODAL AGREGAR BLOQUEO-->

<div class="modal fade" id="AgregarBloqueo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header bg-info">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form method="post" enctype="multipart/form-data">

                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <i class="fas fa-map-marker-alt"></i>
                                </span>
                            </div>
                                <select class="form-control input-convenio select2-single" style="width: 92%" type="text" id="conductorB" name="conductorB" required>
                                    <option selected value="">-Seleccione un conductor-</option>
                                        <?php foreach ($listaPersonal as $key => $value) : ?>
                                            <option value="<?= $value['idPersonal'] ?>"><?= $value['Nombre'] ?></option>
                                        <?php endforeach ?>
                                </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <i class="fas fa-user"></i>
                                </span>
                            </div>
                                <input class="form-control input-convenio" type="text" id="motivob" name="motivob" placeholder="Escriba los motivos." required>
                        </div>
                    </div>

                    <div class="form-group clearfix">
                        <label>Estado</label>  
                                <div class="icheck-danger d-inline">
                                    <input class="form-control input-convenio" type="checkbox" id="cb1" name="cb1" checked value="0">
                                    <label class="font-weight-normal" for="cb1">Bloquear</label>
                                </div>
                                <div class="icheck-success d-inline">
                                    <input class="form-control input-convenio" type="checkbox" id="cb2" name="cb2" checked value="1">
                                    <label class="font-weight-normal" for="cb2">Desbloquear</label>
                                </div>
                    </div>

                    <div class="form-group">
                        <label>Fecha de desbloqueo</label>
                        <div class="input-group">
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <i class="far fa-calendar-alt"></i>
                                </span>
                            </div>
                            <input class="form-control input-propietario" type="date" id="fecha_vin" name="fecha_vin" placeholder="Seleccione una fecha" required>
                        </div>
                    </div>

                </form>
            </div>

            <div class="modal-footer bg-dark">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save"></i>
                        Guardar
                    </button>
            </div>
        </div>
    </div>
</div>

<!--MODAL VER HISTORIAL DE UNA PERSONA -->

<div class="modal fade" id="BloqueoHistorial" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header bg-info">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <!--ID REGISTRO-->  
                    <input type="hidden" id="idbloqueo" name="idbloqueo" value=""> 

                <div class="table-responsive">
                    <table class="table table-sm table-striped table-bordered dt-responsive table-hover tablas w-100" id="tabla-historial">
                        <thead class="thead-light text-sm text-center">
                            <tr>
                                <th style="width:10px;">#</th>
                                <th>Conductor</th>
                                <th>Motivo</th>
                                <th>Estado</th>
                                <th>Fecha desbloqueo</th>
                                <th>Usuario</th>
                            </tr>                 
                        </thead>
                        <tbody id="tbodyhistorial">
                        
                        </tbody>
                    </table>
                </div>
                
            </div>
            <div class="modal-footer bg-dark"></div>

        </div>
    </div>
</div>




