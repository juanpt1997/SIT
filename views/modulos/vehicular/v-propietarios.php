<?php
 
if(!validarModulo('M_VEHICULAR')) {
   echo "<script> window.location = 'inicio'; </script>";
}
$Propietarios = ControladorPropietarios::ctrMostrar(); 
$DeparMunicipios = ControladorGH::ctrDeparMunicipios();

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark "><i><b>Propietarios</b></i></h1>
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
                    <div class="card">
                        <div class="card-header bg-info"></div>
                        <div class="card-body">

                            <div class="table-responsive">
                                <table class="table table-sm table-striped table-bordered dt-responsive table-hover tablasBtnExport w-100">
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
                                                    <div class="btn-group" role="group" aria-label="Button group">
                                                        <button class="btn btn-sm btn-warning btnEditarProp" idxp="<?= $value['idxp'] ?>" cedula="<?= $value['documento'] ?>" data-toggle="modal" data-target="#PropietarioModal"><i class="fas fa-edit"></i></button>
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
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <form method="post" enctype="multipart/form-data">
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

                    <!--TIPO DE DOCUMENTO-->
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <i class="fas fa-address-card"></i>
                                </span>
                            </div>
                                <select class="form-control input-lg input-propietario" type="text" id="tdocumento" name="tdocumento" required>
                                  <option>-Seleccione un documento-</option>
                                  <option>NIT</option>
                                  <option>CC</option>
                                  <option>CE</option>
                                </select>
                        </div>
                    </div>

                    <!-- DOCUMENTO -->
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

                    <!-- NOMBRE -->
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

                      <!-- TELEFONO -->
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

                      <!-- DIRECCION -->
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

                    <!-- EMAIL -->
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

                      <!-- CIUDAD -->
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <i class="fas fa-map-marker-alt"></i>
                                </span>
                            </div>

                            <select class="form-control input-lg input-propietario select2-single" style="width: 92%" type="text" id="ciudadpro" name="ciudadpro" required>
                              <option selected value="">-Seleccione una ciudad-</option>
                                <?php foreach ($DeparMunicipios as $key => $value) : ?>
                                    <option value="<?= $value['idmunicipio'] ?>"><?= $value['DeparMunic'] ?></option>
                                <?php endforeach ?>
                            </select>


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
                #Dentro del objeto de php, ejecutamos el objeto del controlador para enviar los datos a la db
                //ControladorPropietarios::ctrAgregarEditarPropietario();
                $crearPropietario = new ControladorPropietarios();
                $crearPropietario->ctrAgregarEditar();
                ?>
            </form> <!-- FIN FORMULARIO -->

        </div>
    </div>
</div>