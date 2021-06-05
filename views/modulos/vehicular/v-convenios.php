<?php
 
/*if(!array_search('CARGAR_OPCION',$_SESSION['opciones'])) {
    echo "<script> window.location = 'inicio'; </script>";
}*/

$Convenios = ControladorConvenios::ctrMostrar();


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
                    <h1 class="m-0 text-dark ">Convenios</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                        <li class="breadcrumb-item active">Convenios</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <!-- ===================== 
              AGREGAR FILAS Y COLUMNAS PARA EL DESARROLLO 
            ========================= -->            
            <div class="row">
                <div class="col">
                    <!--BOTON NUEVO CONVENIO-->
                    <button type="button" class="btn btn-info btn-agregarConvenio" data-toggle="modal" data-target="#ConveniosModal">
                        <i class="fas fa-user-plus"></i>Añadir Convenio
                    </button>
                </div><!-- col -->
            </div> <!-- /.row -->

            <div class="row mt-2">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header bg-primary"></div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-sm table-striped table-bordered dt-responsive table-hover tablas w-100">
                                    <thead class="thead-light text-uppercase text-sm text-center">
                                        <tr>
                                            <th style="width:10px;">#</th>
                                            <th>NIT</th>
                                            <th>Nombre</th>
                                            <th>Direccion</th>
                                            <th>Telefono 1</th>
                                            <th>Telefono 2</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead> 
                                    <tbody class="text-sm">
                                        <?php foreach ($Convenios as $key => $value):?>
                                            <tr>
                                                <td><?= $value['idxc'] ?></td>
                                                <td><?= $value['nit'] ?></td>
                                                <td><?= $value['nombre'] ?></td>
                                                <td><?= $value['direccion'] ?></td>
                                                <td><?= $value['telefono1'] ?></td>
                                                <td><?= $value['telefono2'] ?></td>
                                                <td> 
                                                    <div class="btn-group" role="group" aria-label="Button group">
                                                        <button class="btn btn-sm btn-warning btnEditarConv" nit="<?= $value['nit'] ?>" data-toggle="modal" data-target="#ConveniosModal"><i class="fas fa-edit"></i></button>
                                                    </div>
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
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!--MODALS-->

<div class="modal fade" id="ConveniosModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <form method="post" enctype="multipart/form-data">
                <!-- INICIO DEL FORMULARIO -->

                <div class="modal-header bg-info">
                    <h3 class="modal-title d-none" id="exampleModalLabel">Añadir Convenio</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">

                    <!--IDCONVENIO-->
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <i class="fas fa-address-card"></i>
                                </span>
                            </div>
                            <input class="form-control input-convenio" type="number" min="0" id="idcon" name="idcon" placeholder="Ingresar Identificador" required>
                        </div>
                    </div>

                    <!--nit-->
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <i class="fas fa-address-card"></i>
                                </span>
                            </div>
                            <input class="form-control input-convenio" type="text" min="0" id="nit" name="nit" placeholder="Ingresar NIT" required>
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
                            <input class="form-control input-convenio" type="text" id="nombre" name="nombre" placeholder="Ingresar nombre de convenio" required>
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
                            <input class="form-control input-convenio" type="text" id="dirco" name="dirco" placeholder="Ingresar direccion" required>
                        </div>
                    </div>

                      <!-- TELEFONO 1   -->
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <i class="fas fa-phone-square-alt"></i>
                                </span>
                            </div>
                            <input class="form-control input-convenio" type="text" id="telco" name="telco" placeholder="Ingresar telefono" required>
                        </div>
                    </div>

                    <!-- TELEFONO 2   -->
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <i class="fas fa-phone-square-alt"></i>
                                </span>
                            </div>
                            <input class="form-control input-convenio" type="text" id="telco2" name="telco2" placeholder="Ingresar telefono" required>
                        </div>
                    </div>
                </div>

                <div class="modal-footer bg-info">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save"></i>Guardar</button>
                </div>

                <?php
                #Dentro del objeto de php, ejecutamos el objeto del controlador para enviar los datos a la db
                //ControladorPropietarios::ctrAgregarEditarPropietario();
                $crearConvenio = new ControladorConvenios();
                $crearConvenio->ctrAgregarEditar();
                ?>
            </form> <!-- FIN FORMULARIO -->

        </div>
    </div>
</div>

