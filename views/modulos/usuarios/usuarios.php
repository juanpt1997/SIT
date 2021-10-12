<?php

if (!validarPermiso('M_USUARIOS', 'R')) {
    echo "<script> window.location = '" . URL_APP . "'; </script>";
}

$Usuarios = ControladorUsuarios::ctrMostrarUsuarios();
$Perfiles = ControladorUsuarios::ctrListadoPerfiles();
$Sucursales = ControladorGH::ctrSucursales();
?>

<!-- =================================================== CONTENT =================================================== -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><b><i>Control de usuarios <i class="fas fa-users"></i></i></b></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                        <li class="breadcrumb-item active">Usuarios</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <section class="content">
        <div class="container-fluid pt-4">
            <!-- ===================================================
                BOTON PARA AGREGAR NUEVO USUARIO
            =================================================== -->
            <div class="row">
                <div class="col">
                    <button type="button" class="btn btn-primary btn-agregarUsuario" data-toggle="modal" data-target="#UsuarioModal">
                        <i class="fas fa-user-plus"></i> Agregar usuario
                    </button>
                </div>
            </div>
            <hr class="my-4">


            <!-- ===================== 
                TABLA DE USUARIOS
            ========================= -->
            <div class="row mt-3">
                <div class="col-sm-12">
                    <table class="table table-sm table-striped table-bordered table-hover tablasBtnExport dt-responsive w-100">
                        <thead class="thead-light text-capitalize">
                            <tr>
                                <th style="width:10px;">#</th>
                                <th>Nombre</th>
                                <th>email</th>
                                <th>Foto</th>
                                <th>Perfil</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($Usuarios as $key => $value) : ?>
                                <?php

                                # Estado
                                if ($value['estado'] == 0) {
                                    /* Permiso de usuario */
                                    if (validarPermiso('M_USUARIOS', 'U')) {
                                        $estado = '<button class="btn btn-sm btn-danger btnActivar" idUsuario="' . $value["UsuariosID"] . '" estadoUsuario="1">Inactivo</button>';
                                    } else {
                                        $estado = '<button class="btn btn-sm btn-danger">Inactivo</button>';
                                    }
                                } else {
                                    /* Permiso de usuario */
                                    if (validarPermiso('M_USUARIOS', 'U')) {
                                        $estado = '<button class="btn btn-sm btn-success btnActivar" idUsuario="' . $value["UsuariosID"] . '" estadoUsuario="0">Activo</button>';
                                    } else {
                                        $estado = '<button class="btn btn-sm btn-success">Activo</button>';
                                    }
                                }

                                # Foto
                                if ($value['foto'] != '') {
                                    $foto = '<img src="' . $value['foto'] . '" class="img-fluid" width="35"></td>';
                                } else {
                                    $foto = '<img src="views/img/fotosUsuarios/default/anonymous.png" class="img-fluid" width="35">';
                                }
                                ?>
                                <tr>
                                    <td><?= $value['UsuariosID'] ?></td>
                                    <td><?= $value['Nombre'] ?></td>
                                    <td><?= $value['Email'] ?></td>
                                    <td><?= $foto ?></td>
                                    <td><?= $value['perfil'] ?></td>
                                    <td><?= $estado ?></td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Button group">
                                            <button class="btn btn-sm btn-info btnEditarUsuario" cedula="<?= $value['Cedula'] ?>" data-toggle="modal" data-target="#UsuarioModal"><i class="fas fa-edit"></i></button>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach ?>

                        </tbody>
                    </table>


                </div><!-- col-sm-12 -->



            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
</div>
<!-- /.content-wrapper -->

<!-- ===================================================
    MODALS
=================================================== -->

<!--================================================ 
        MODAL PARA AGREGAR/EDITAR USUARIO      
================================================-->
<div class="modal fade" id="UsuarioModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <form method="post" enctype="multipart/form-data">
                <!-- INICIO DEL FORMULARIO -->

                <div class="modal-header">
                    <h5 class="modal-title d-none" id="exampleModalLabel">Agregar nuevo usuario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <!-- CEDULA -->
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <i class="fas fa-address-card"></i>
                                </span>
                            </div>
                            <input class="form-control input-usuario" type="number" min="0" id="Identificacion" name="Identificacion" placeholder="Ingresar identificación" required>
                        </div>
                    </div>

                    <!-- Nombre -->
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <i class="fas fa-user"></i>
                                </span>
                            </div>
                            <input class="form-control input-usuario" type="text" id="Nombre" name="Nombre" placeholder="Ingresar nombre completo" required>
                        </div>
                    </div>

                    <!-- email -->
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <i class="fas fa-envelope-square"></i>
                                </span>
                            </div>
                            <input class="form-control input-usuario" type="email" id="Email" name="Email" placeholder="Ingresar email">
                        </div>
                    </div>

                    <!-- PERFIL -->
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <i class="fas fa-user-secret"></i>
                                </span>
                            </div>
                            <select class="form-control input-lg input-usuario" id="Perfil" name="Perfil" required>
                                <option value="" disabled selected>Seleccione el perfil</option>
                                <?php foreach ($Perfiles as $key => $value) : ?>
                                    <option value="<?= $value['idPerfil'] ?>"><?= $value['perfil'] ?></option>
                                <?php endforeach ?>

                            </select>
                        </div>
                    </div>

                    <!-- Sucursal -->
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <i class="fas fa-map-marker-alt"></i>
                                </span>
                            </div>
                            <select class="form-control input-lg input-usuario" id="Sucursal" name="Sucursal" required>
                                <option value="" disabled selected>Seleccione una sucursal</option>
                                <?php foreach ($Sucursales as $key => $value) : ?>
                                    <option value="<?= $value['ids'] ?>"><?= $value['sucursal'] ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>

                    <!-- subir foto -->
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <i class="fas fa-image"></i>
                                </span>
                            </div>
                            <input type="file" class="form-control input-usuario" name="nuevaFoto" id="nuevaFoto">
                        </div>
                        <p>Peso máximo de la foto 2 MB</p>
                        <img src="views/img/fotosUsuarios/default/anonymous.png" class="img-fluid previsualizar" width="100">
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    <?php if (validarPermiso('M_USUARIOS', 'U')) : ?>
                        <button class="btn btn-warning" type="button" id="restablecerPswd" data-dismiss="modal"><i class="fas fa-lock-open"></i> Restablecer Contraseña</button>
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-save"></i>
                            Guardar
                        </button>
                    <?php endif ?>
                </div>

                <?php
                #Dentro del objeto de php, ejecutamos el objeto del controlador para enviar los datos a la db
                ControladorUsuarios::ctrAgregarEditar();
                /* $crearUsuario = new ControladorUsuarios();
                $crearUsuario->ctrAgregarEditar(); */
                ?>
            </form> <!-- FIN FORMULARIO -->

        </div>
    </div>
</div>