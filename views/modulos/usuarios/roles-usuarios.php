<?php

// if(!validarModulo('CARGAR_OPCION')) {
//     echo "<script> window.location = 'inicio'; </script>";
// }

$Perfiles = ControladorUsuarios::ctrListadoPerfiles();




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
                    <h1 class="m-0 text-dark "><b><i>Roles de usuario</i></b></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                        <li class="breadcrumb-item active">Plantilla</li>
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
                                            <?php foreach ($Perfiles as $key => $value): ?>
                                            
                                            <?php 
                                                
                                                if($value["estadoPerfil"] == 1){
                                                    $estado = '<button class="btn btn-sm btn-success btnActivar" idPerfil="' . $value["idPerfil"] . '" estado="1">Activo</button>';
                                                }else {
                                                    $estado = '<button class="btn btn-sm btn-danger btnActivar" idPerfil="' . $value["idPerfil"] . '" estado="0">Inactivo</button>';
                                                }

                                            ?>

                                            <tr>
                                                <td><?= $value["idPerfil"] ?></td>
                                                <td><?= $value["perfil"]?></td>
                                                <td><?= $value["descripcion"]?></td>
                                                <td><?= $estado?></td>
                                                <td>
                                                    <button type="button" class="btn btn-default btn-sm btn-permisoroles" data-toggle="modal" data-target="#modal-permisoroles"><i class="fas fa-key"></i></button>
                                                    <button type="button" class="btn btn-success btn-sm btn-editarroles" data-toggle="modal" data-target="#modal-nuevorol"><i class="fas fa-edit"></i></button>
                                                    <button type="button" class="btn btn-danger btn-sm btn-eliminarroles"><i class="fas fa-trash"></i></button>
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
                                    <label>Estado</label>
                                    <select class="form-control" id="EstadoRol" name="EstadoRol">
                                        <option value="1">Activo</option>
                                        <option value="0">Inactivo</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php 
                    
                    $ctrRol = new ControladorUsuarios();
                    $ctrRol->ctrAgregarEditarRol();
                    // ControladorUsuarios::ctrAgregarEditarRol();
                    
                    

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
                                    <tr>
                                        <td>1.</td>
                                        <td>Usuarios</td>
                                        <td>
                                            <div class="custom-control custom-checkbox">
                                                <input class="custom-control-input" type="checkbox" id="checkver1" value="option1">
                                                <label for="checkver1" class="custom-control-label"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="custom-control custom-checkbox">
                                                <input class="custom-control-input" type="checkbox" id="checkcrear1" value="option1">
                                                <label for="checkcrear1" class="custom-control-label"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="custom-control custom-checkbox">
                                                <input class="custom-control-input" type="checkbox" id="checkactualizar1" value="option1">
                                                <label for="checkactualizar1" class="custom-control-label"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="custom-control custom-checkbox">
                                                <input class="custom-control-input" type="checkbox" id="checkeliminar1" value="option1">
                                                <label for="checkeliminar1" class="custom-control-label"></label>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>2.</td>
                                        <td>Roles</td>
                                        <td>
                                            <div class="custom-control custom-checkbox">
                                                <input class="custom-control-input" type="checkbox" id="checkver2" value="option1">
                                                <label for="checkver2" class="custom-control-label"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="custom-control custom-checkbox">
                                                <input class="custom-control-input" type="checkbox" id="checkcrear2" value="option1">
                                                <label for="checkcrear2" class="custom-control-label"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="custom-control custom-checkbox">
                                                <input class="custom-control-input" type="checkbox" id="checkactualizar2" value="option1">
                                                <label for="checkactualizar2" class="custom-control-label"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="custom-control custom-checkbox">
                                                <input class="custom-control-input" type="checkbox" id="checkeliminar2" value="option1">
                                                <label for="checkeliminar2" class="custom-control-label"></label>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-center bg-info">
                <button type="submit" form="permisos_form" class="btn btn-success"><i class="far fa-check-circle"></i> Guardar</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>