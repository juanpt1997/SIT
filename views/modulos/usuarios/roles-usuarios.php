<?php

// if(!validarModulo('CARGAR_OPCION')) {
//     echo "<script> window.location = 'inicio'; </script>";
// }

$Perfiles = ControladorUsuarios::ctrListadoPerfiles();
$Opciones = ControladorUsuarios::ctrListadoOpciones();



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
                    <h1 class="m-0 text-dark "><b><i>Roles de usuario <i class="fas fa-users-cog"></i></i></b></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                        <li class="breadcrumb-item active">Roles</li>
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
                    <button type="button" class="btn bg-gradient-success btn-nuevorol" data-toggle="modal" data-target="#modal-nuevorol"><i class="fas fa-paste"></i> Nuevo rol de usuario</button>
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
                                <!--|||TABLA CONTROLES DE LOS ROLES|||-->
                                <div class="table-responsive">
                                    <table id="tblroles" class="table table-bordered table-striped text-center nowrap tablasBtnExport">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Nombre</th>
                                                <th>Descripción</th>
                                                <th>Estado</th>
                                                <th>...</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php foreach ($Perfiles as $key => $value) : ?>

                                                <?php

                                                if ($value["activoPerfil"] == 1) {
                                                    $activo = '<button class="btn btn-sm btn-success btnActivar" idPerfil="' . $value["idPerfil"] . '" activo="1">Activo</button>';
                                                } else {
                                                    $activo = '<button class="btn btn-sm btn-danger btnActivar" idPerfil="' . $value["idPerfil"] . '" activo="0">Inactivo</button>';
                                                }

                                                ?>

                                                <tr>
                                                    <td><?= $value["idPerfil"] ?></td>
                                                    <td><?= $value["perfil"] ?></td>
                                                    <td><?= $value["descripcion"] ?></td>
                                                    <td><?= $activo ?></td>
                                                    <td>
                                                        <button type="button" class="btn btn-default btn-sm btn-permisoroles" idPerfil="<?= $value['idPerfil'] ?>"data-toggle="modal" data-target="#modal-permisoroles"><i class="fas fa-key"></i></button>
                                                        <button type="button" class="btn btn-success btn-sm btn-editarroles" idPerfil="<?= $value['idPerfil'] ?>" data-toggle="modal" data-target="#modal-nuevorol"><i class="fas fa-edit"></i></button>
                                                        <button type="button" class="btn btn-danger btn-sm btn-eliminarroles" idPerfil="<?= $value['idPerfil'] ?>"><i class="fas fa-trash"></i></button>
                                                    </td>
                                                </tr>
                                            <?php endforeach ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- ==============================
  MODAL DE INGRESO NUEVO Y EDITAR ROL
 ============================== -->

<div class="modal fade show" id="modal-nuevorol" style="display: none; padding-right: 17px;" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h4 class="modal-title"><b><i>Ingresar nuevo rol</i></b></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <div class="modal-body">
                <form action="" method="post" id="datosrol_form">
                    <input type="hidden" id="idPerfil" name="idPerfil" value="">

                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Perfil</label>
                                    <input id="Perfil" maxlength="50" name="Perfil" class="form-control datosrol" type="text" required>
                                </div>

                                <div class="form-group">
                                    <label>Descripción</label>
                                    <input id="Descripcion" name="Descripcion" class="form-control datosrol" type="text" required>
                                </div>

                                <div class="form-group">
                                    <label>Activo</label>
                                    <select class="form-control" id="activo" name="activo">
                                        <option value="1">Activo</option>
                                        <option value="0">Inactivo</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php

                    $ctrRol = new ControladorUsuarios();
                    $ctrRol->ctrAgregarEditarPerfil(NULL);




                    ?>
                </form>
            </div>
            <div class="modal-footer justify-content-center bg-info">
                <button type="submit" form="datosrol_form" class="btn btn-success"><i class="far fa-check-circle"></i> Guardar</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>

<!-- ==============================
  MODAL DE PERMISOS DEL ROL
 ============================== -->

<div class="modal fade show" id="modal-permisoroles" style="display: none; padding-right: 17px;" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h4 class="modal-title"><b><i>Permisos roles de usuarios</i></b></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="card-body">
                    <form id="permisos_form" method="post">
                        <input type="hidden" name="idpermisos" id="idpermisos" value="">

                        <div class="row">
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap text-center">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Módulo</th>
                                            <th>Ver</th>
                                            <th>Crear</th>
                                            <th>Actualizar</th>
                                            <th>Eliminar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($Opciones as $key => $value) : ?>
                                            <tr class="form-group">
                                                <td><?= $value['idOpcion'] ?></td>
                                                <td><?= $value['nombre'] ?></td>
                                                <td>
                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" type="checkbox" name="Ver[]" id="Ver<?= $key ?>" value="<?=$value['idOpcion']?>" >
                                                    <label class="custom-control-label" for="Ver<?= $key ?>"></label>
                                                </div>   
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-checkbox">
                                                        <input class="custom-control-input" type="checkbox" name="Crear[]" id="Crear<?= $key ?>" value="<?=$value['idOpcion']?>" >
                                                        <label class="custom-control-label" for="Crear<?= $key ?>"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-checkbox">
                                                        <input class="custom-control-input" type="checkbox" name="Actualizar[]" id="Actualizar<?= $key ?>" value="<?=$value['idOpcion']?>" >
                                                        <label class="custom-control-label" for="Actualizar<?= $key ?>"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-checkbox">
                                                        <input class="custom-control-input" type="checkbox" name="Eliminar[]" id="Eliminar<?= $key ?>" value="<?=$value['idOpcion']?>" >
                                                        <label class="custom-control-label" for="Eliminar<?= $key ?>"></label>
                                                    </div>
                                                </td>
                                                  
                                            </tr>
                                        <?php endforeach ?>
                                        <?php 
                                        $ctrPermisosRol = ControladorUsuarios::ctrAgregarPermisosRol();
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </form>

                    
                </div>
            </div>
            <div class="modal-footer justify-content-center bg-info">
                <button type="submit" form="permisos_form" class="btn btn-success" id="PermisosRoles"><i class="far fa-check-circle"></i> Guardar</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>