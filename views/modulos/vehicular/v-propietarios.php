<?php

if (!validarPermiso('M_VEHICULAR', 'R')) {
    echo "<script> window.location = 'inicio'; </script>";
}
$Propietarios = ControladorPropietarios::ctrMostrar();
$DeparMunicipios = ControladorGH::ctrDeparMunicipios();
$Placas = ControladorVehiculos::ctrListaVehiculos();

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark "><i><b>Propietarios <i class="fas fa-user-tie"></i></b></i></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                        <li class="breadcrumb-item active">Propietarios</li>
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
                <div class="col">
                    <!-- BOTON NUEVO PROVEEDOR-->
                    <button type="button" class="btn btn-success btn-md btn-agregarPropietario" data-toggle="modal" data-target="#PropietarioModal">
                        <i class="fas fa-user-plus"></i> Agregar propietario
                    </button>
                </div>
            </div>

            <!--|||TABLA PROPIETARIOS|||-->

            <div class="row mt-2">
                <div class="col-12">
                    <div class="card card-outline card-info">

                        <div class="card-body">

                            <div class="table-responsive">
                                <table class="table table-sm table-striped table-bordered dt-responsive table-hover tablasBtnExport w-100 text-center">
                                    <thead class="thead-light text-uppercase text-sm text-center">
                                        <tr>
                                            <th style="width:10px;">#</th>
                                            <th>Nombre</th>
                                            <th>Tipo</th>
                                            <th>Documento</th>
                                            <th>EMAIL</th>
                                            <th>Telefono</th>
                                            <th>Direccion</th>
                                            <th>Ciudad</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-sm">
                                        <?php foreach ($Propietarios as $key => $value) : ?>
                                            <tr>
                                                <td><?= $value['idxp'] ?></td>
                                                <td><?= $value['nombre'] ?></td>
                                                <td><?= $value['tipodoc'] ?></td>
                                                <td><?= $value['documento'] ?></td>
                                                <td><?= $value['email'] ?></td>
                                                <td><?= $value['telef'] ?></td>
                                                <td><?= $value['direccion'] ?></td>
                                                <td><?= $value['ciudad'] ?></td>
                                                <td>
                                                    <div class="row d-flex flex-nowrap justify-content-center">

                                                        <div class="btn-group" role="group" aria-label="Button group">
                                                            <button class="btn btn-sm btn-info btnEditarProp m-1" title="Editar propietario." idxp="<?= $value['idxp'] ?>" cedula="<?= $value['documento'] ?>" data-toggle="modal" data-target="#PropietarioModal"><i class="fas fa-edit"></i></button>
                                                            <?php if (validarPermiso('M_VEHICULAR', 'D')) : ?>
                                                                <button class="btn btn-sm btn-danger btnBorrarProp m-1" title="Eliminar propietario." idxp="<?= $value['idxp'] ?>" cedula="<?= $value['documento'] ?>"> <i class="fas fa-trash"></i> </button>

                                                            <?php endif ?>

                                                        </div>


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
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div><!-- /.content -->
</div><!-- /.content-wrapper -->


<!--MODALS-->

<div class="modal fade" id="PropietarioModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">

            <form id="propietario_form" method="post" enctype="multipart/form-data">
                <!-- INICIO DEL FORMULARIO -->

                <div class="modal-header bg-info">
                    <h5 class="modal-title" id="titulo-modal-propietario"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <!--ID REGISTRO-->
                    <input type="hidden" id="idxp" name="idxp" value="">

                    <!-- FORMULARIO PROPIETARIO -->
                    <div class="row">
                        <!--TIPO DE DOCUMENTO-->
                        <div class="col-12 col-sm-6 col-lg-4">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <i class="fas fa-address-card"></i>
                                        </span>
                                    </div>
                                    <select class="form-control input-lg input-propietario" type="text" id="tdocumento" name="tdocumento" required>
                                        <option value="">-Seleccione un documento-</option>
                                        <option>NIT</option>
                                        <option>CC</option>
                                        <option>CE</option>
                                    </select>
                                </div>
                            </div>
                        </div>


                        <!-- DOCUMENTO -->

                        <div class="col-12 col-sm-6 col-lg-4">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <i class="fas fa-address-card"></i>
                                        </span>
                                    </div>
                                    <input class="form-control input-propietario" type="number" id="documento" name="documento" placeholder="Ingresar documento" maxlength="11" required>
                                </div>
                            </div>
                        </div>


                        <!-- NOMBRE -->

                        <div class="col-12 col-sm-6 col-lg-4">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <i class="fas fa-user"></i>
                                        </span>
                                    </div>
                                    <input class="form-control input-propietario" type="text" id="nombre" name="nombre" placeholder="Ingresar nombre completo" maxlength="52" required>
                                </div>
                            </div>
                        </div>


                        <!-- TELEFONO -->
                        <div class="col-12 col-sm-6 col-lg-4">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <i class="fas fa-phone-square-alt"></i>
                                        </span>
                                    </div>
                                    <input class="form-control input-propietario" type="text" id="telpro" name="telpro" placeholder="Ingresar telefono" required>
                                </div>
                            </div>
                        </div>

                        <!-- DIRECCION -->
                        <div class="col-12 col-sm-6 col-lg-4">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <i class="fas fa-map-marker-alt"></i>
                                        </span>
                                    </div>
                                    <input class="form-control input-propietario" type="text" id="dirpro" name="dirpro" placeholder="Ingresar direccion" maxlength="74" required>
                                </div>
                            </div>
                        </div>

                        <!-- EMAIL -->
                        <div class="col-12 col-sm-6 col-lg-4">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <i class="fas fa-envelope-square"></i>
                                        </span>
                                    </div>
                                    <input class="form-control input-propietario" type="email" id="emailp" name="emailp" placeholder="Ingresar email">
                                </div>
                            </div>
                        </div>

                        <!-- CIUDAD -->
                        <div class="col-12 col-sm-6 col-lg-4">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <i class="fas fa-map-marker-alt"></i>
                                        </span>
                                    </div>

                                    <select class="form-control input-lg input-propietario select2-single" style="width: 89%" type="text" id="ciudadpro" name="ciudadpro" required>
                                        <option selected value="">-Seleccione una ciudad-</option>
                                        <?php foreach ($DeparMunicipios as $key => $value) : ?>
                                            <option value="<?= $value['idmunicipio'] ?>"><?= $value['DeparMunic'] ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="d-flex justify-content-center">
                        <?php if (validarPermiso('M_VEHICULAR', 'U')) : ?>
                            <button type="submit" form="propietario_form" class="btn btn-success">
                                <i class="fas fa-save"></i>
                                Guardar
                            </button>
                        <?php endif ?>
                    </div>


            </form> <!-- FIN FORMULARIO -->





            <hr class="my-4">

            <!-- FORMULARIO DE VEHICULO PROPIETARIO -->
            <form class="formulario" id="frmVehiculoxPropietarios" method="post" enctype="multipart/form-data">
                <div class="row mt-2 border border-info rounded">
                    <!-- ===================================================
                                                        VEHÍCULO
                                                    =================================================== -->
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="form-group">
                            <label for="exampleInput1">Vehículo</label>
                            <select class="form-control select2-single" id="idvehiculo" name="idvehiculo">
                                <option value="" selected>-Seleccione un vehículo-</option>
                                <?php foreach ($Placas as $key => $value) : ?>
                                    <option value="<?= $value['idvehiculo'] ?>"><?= $value['placa'] ?> - <?= $value['numinterno'] ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>

                    <!-- ===================================================
                                                        Porcentaje de participación
                                                    =================================================== -->
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="form-group">
                            <label for="exampleInput1">Porcentaje de participación</label>
                            <input class="form-control" type="number" id="participacion" name="participacion" min=0 max=100 value="0">
                        </div>
                    </div>

                    <!-- ===================================================
                                                        Observaciones
                                                    =================================================== -->
                    <div class="col-12 col-md-8 col-lg-4">
                        <div class="form-group">
                            <label for="exampleInput1">Observaciones</label>
                            <textarea class="form-control" id="observacion" name="observacion" rows="1" style="min-height:70px"></textarea>
                        </div>
                    </div>

                    <!-- ===================================================
                                                        BOTON GUARDAR FORMULARIO
                                                    =================================================== -->
                    <?php if (validarPermiso('M_VEHICULAR', 'U')) : ?>
                        <div class="col-12 col-md-4 col-lg-1 text-right text-md-left align-self-center">
                            <button type="submit" form="frmVehiculoxPropietarios" class="btn btn-success"><i class="fas fa-check-circle"></i></button>
                            <div class="overlay d-none" id="">
                                <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                            </div>
                        </div>
                    <?php endif ?>
                </div>



            </form>

            <hr class="my-4 bg-dark">

            <div class="table-responsive">
                <table class="table table-sm table-striped table-bordered dt-responsive table-hover tablasBtnExport w-100 text-center" id="tablaVehiculosxPropietarios">
                    <thead class="thead-light text-uppercase text-sm text-center">
                        <tr>
                            <th>...</th>
                            <th>Vehículo</th>
                            <th>Porcentaje de participación</th>
                            <th>observación</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm" id="tbodyVehiculosxPropietarios">
                        
                    </tbody>
                </table>
            </div>





            <!-- VEHICULOS -->
            <!-- <div class="form-group">
                        <div class="input-group">
                        <div class="input-group-append">
                                <span class="input-group-text">
                                <i class="fas fa-car"></i>
                                </span>
                            </div>

                            <select class="form-control input-lg input-propietario select2-single" style="width: 90%" type="text" id="idvehiculo" name="idvehiculo">
                                <option selected value="">-Seleccione un vehículo-</option>
                                <?php foreach ($Placas as $key => $value) : ?>
                                    <option value="<?= $value['idvehiculo'] ?>"><?= $value['placa'] ?> - <?= $value['numinterno'] ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div> -->

            <!-- PARTICIPACION -->
            <!-- <div class="form-group d-none" id="form-participacion" >
                        <div class="input-group">
                            <div class="input-group-append">
                                <span class="input-group-text">
                                <i class="fas fa-hands-helping"></i>
                                </span>
                            </div>
                            <input class="form-control input-propietario" type="text" id="participacion" name="participacion" placeholder="Ingresar el porcentaje de participación">
                        </div>
                    </div> -->

            <!-- OBSERVACION -->
            <!-- <div class="form-group d-none" id="form-observacion" >
                        <div class="input-group">
                            <div class="input-group-append">
                                <span class="input-group-text">
                                <i class="fas fa-comment-medical"></i>
                                </span>
                            </div>
                            <textarea class="form-control input-propietario" rows="5" type="textarea" id="observacion" name="observacion" placeholder="Digite leve observación sobre el vehículo"></textarea>
                        </div>
                    </div> -->

        </div>



    </div>
</div>
</div>