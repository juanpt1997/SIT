<?php
 
if(!validarModulo('M_VEHICULAR')) {
   echo "<script> window.location = 'inicio'; </script>";
}

$listavehiculos = ControladorVehiculos::ctrListaVehiculos();
$listaUltimo = ControladorBloqueosV::ctrUltimoBloqueoV();



?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark "><i><b>Bloqueo de vehículos</b></i></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                        <li class="breadcrumb-item active">Bloqueo de vehículos</li>
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
                    <button type="button" class="btn btn-danger btn-md btn-agregarBloqueov" data-toggle="modal" data-target="#AgregarBloqueov">
                        <i class="fas fa-ban"></i> Bloquear vehículo
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
                                            <th>Vehículo (Placa)</th>
                                            <th>Motivo</th>
                                            <th>Estado actual</th>
                                            <th>Fecha desbloqueo</th>
                                            <th>Usuario</th>
                                            <th>Historial</th>
                                        </tr>                 
                                    </thead>
                                    <tbody>
                                        <?php foreach ($listaUltimo as $key => $value) : ?>

                                            <?php
                                            if( $value['estado'] == 1){

                                                $estado = '<button class="btn btn-sm btn-success btndesbloqueadov" data-toggle="modal" data-target="#AgregarBloqueov" idveh="' . $value["idvehiculo"] . '">Desloqueado <i class="fas fa-lock-open"></i></button>';

                                            } else {

                                                $estado = '<button class="btn btn-sm btn-danger btnbloqueadov" data-toggle="modal" data-target="#AgregarBloqueov" idveh="' . $value["idvehiculo"] . '">Bloqueado <i class="fas fa-lock"></i></button>';
                                            }

                                             ?>

                                        <tr>
                                            <td><?= $value['idbloqueov'] ?></td>
                                            <td><?= $value['placa'] ?></td>
                                            <td><?= $value['motivo'] ?></td>
                                            <td class="text-center"><b><?= $estado ?></b></td>
                                            <td><?= $value['fecha'] ?></td>
                                            <td><?= $value['nomUsuario'] ?></td>
                                            <td class="text-center">
                                                <div class="btn-group" role="group" aria-label="Button group">
                                                    <button class="btn btn-md btn-info btnHistorialv" id_v="<?= $value['idvehiculo'] ?>" data-toggle="modal" data-target="#BloqueoHistorialv"><i class="fas fa-bus-alt"></i></i></button>
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


     <!--MODAL AGREGAR BLOQUEO DE VEHICULO-->

<div class="modal fade" id="AgregarBloqueov" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header bg-info">
                <h5 class="modal-title" id = "titulo_modal_1"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form method="post" enctype="multipart/form-data" id="formulario-bloqueo">

                    <div class="modal-body">
                        <div class="form-group">
                            <label>Vehículo</label>
                            <div class="input-group">
                                <div class="input-group-append">
                                    <span class="input-group-text">
                                        <i class="fas fa-map-marker-alt"></i>
                                    </span>
                                </div>
                                <select class="form-control input-convenio select2-single" style="width: 92%" type="text" id="vehiculo" name="vehiculo" required>
                                    <option selected value="">-Seleccione un vehículo-</option>
                                    <?php foreach ($listavehiculos as $key => $value) : ?>
                                        <option value="<?= $value['idvehiculo'] ?>"><?= $value['placa'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="form-group clearfix">
                                <label id="titulo-estado">ESTADO</label>  
                                <div class="form-check-inline">
                                    <input class="form-check-input" type="radio" id="opcion1" name="estadobloqueov" value="0">
                                    <label class="form-check-label" for="opcion1"> Bloquear</label>
                                </div>
                                <div class="form-check-inline">
                                    <input class="form-check-input" type="radio" id="opcion2" name="estadobloqueov"  value="1">
                                    <label class="form-check-label" for="opcion2"> Desbloquear</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Motivo</label>
                            <div class="input-group">
                                <div class="input-group-append">
                                    <span class="input-group-text">
                                        <i class="fas fa-align-left"></i>
                                    </span>
                                </div>
                                <textarea class="form-control input-convenio" type="text" id="motivobv" name="motivobv" placeholder="Escriba los motivos del bloqueo/desbloqueo." required></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Fecha de bloque/desbloqueo</label>
                            <div class="input-group">
                                <div class="input-group-append">
                                    <span class="input-group-text">
                                        <i class="far fa-calendar-alt"></i>
                                    </span>
                                </div>
                                <input class="form-control input-propietario" type="date" id="fecha_des" name="fecha_des" placeholder="Seleccione una fecha" required>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer bg-dark">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-save"></i>
                            Guardar
                        </button>
                    </div>  

                    <?php
                    $nuevobloqueov = new ControladorBloqueosV();
                    $nuevobloqueov->ctrNuevoBloqueoV();
                    ?>

            </form>

                    
        </div>
    </div>
</div>

<!--MODAL VER HISTORIAL DE UN VEHICULO -->

<div class="modal fade" id="BloqueoHistorialv" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

            <div class="modal-header bg-info">
                <h5 class="modal-title" id = "titulo_modalv">Historial de bloqueos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <!--ID REGISTRO-->  
                    <input type="hidden" id="idbloqueo" name="idbloqueo" value=""> 

                <div class="table-responsive">
                    <table class="table table-sm table-striped table-bordered dt-responsive table-hover tablas w-100" id="tabla-historialv">
                        <thead class="thead-light text-sm text-center text-nowrap">
                            <tr>
                                <th style="width:10px;">#</th>
                                <th>Vehículo (Placa)</th>
                                <th>Motivo</th>
                                <th>Estado</th>
                                <th>Fecha desbloqueo</th>
                                <th>Usuario</th>
                            </tr>                 
                        </thead>
                        <tbody id="tbodyhistorialv">
                        </tbody>
                    </table>
                </div>           
            </div>
            <div class="modal-footer bg-dark"></div>
        </div>
    </div>
</div>




