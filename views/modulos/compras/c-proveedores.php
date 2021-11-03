<?php

// if (!validarModulo('CARGAR_OPCION')) {
//     echo "<script> window.location = 'inicio'; </script>";
// }

$Municipios = ControladorGH::ctrDeparMunicipios();
$Proveedores = ControladorProveedores::ctrListarProveedores();

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
                    <h1 class="m-0 text-dark "><b><i>Proveedores <i class="fas fa-cart-arrow-down"></i></i></b></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                        <li class="breadcrumb-item active">Proveedores</li>
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

            <div class="row d-flex justify-content-center mb">
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-2 text-center">
                    <button type="button" class="btn btn-block bg-gradient-success btn_nuevo" data-toggle="modal" data-target="#modal-nuevo"><i class="fas fa-plus-circle"></i> Agregar proveedor</button>
                </div>
            </div>
            <!-- ===================== 
              AGREGAR FILAS Y COLUMNAS PARA EL DESARROLLO 
            ========================= -->
            <div class="row mt-2">
                <div class="col-12">
                    <div class="card card-outline card-success">
                        <div class="card-body">
                            <div class="col-sm-12">

                                <div class="table-responsive">
                                    <table id="tabla_proveedores" class="table table-sm table-bordered table-striped text-center tablasBtnExport">
                                        <thead>
                                            <tr>
                                                <th>Acciones</th>
                                                <th>ID</th>
                                                <th>CC / NIT</th>
                                                <th>Nombre o Razón social</th>
                                                <th>Dirección</th>
                                                <th>Teléfono</th>
                                                <th>Contacto</th>
                                                <th>Correo Electrónico</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php foreach ($Proveedores as $key => $value) : ?>
                                                <tr>
                                                    <td>
                                                        <button type="button" class="btn btn-success btn-sm btn_editar" data-toggle="modal" data-target="#modal-nuevo" nit_editar="<?= $value['documento'] ?>" id_prov="<?= $value['id'] ?>"><i class="fas fa-edit"></i></button>
                                                        <button type="button" class="btn btn-danger btn-sm btn_eliminar" id="<?= $value['id'] ?>"><i class="fas fa-trash"></i></button>

                                                    </td>
                                                    <td><?= $value['id'] ?></td>
                                                    <td><?= $value['documento'] ?></td>
                                                    <td><?= $value['razon_social'] ?></td>
                                                    <td><?= $value['direccion'] ?></td>
                                                    <td><?= $value['telefono'] ?></td>
                                                    <td><?= $value['nombre_contacto'] ?></td>
                                                    <td><?= $value['correo'] ?></td>
                                                </tr>
                                            <?php endforeach ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-dark"></div>
                    </div>
                </div>
            </div>
            <!-- ===================== 
              FIN DE LA DATA-TABLE
            ========================= -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->


<!-- ===================== 
              INICIO MODAL DEL BOTON NUEVO
            ========================= -->

<div class="modal fade show" id="modal-nuevo" style="display: none; padding-right: 17px;" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <form method="post" enctype="multipart/form-data">


                <div class="modal-header bg-info">
                    <h4 class="modal-title" id="titulo_modal_proveedores"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="row">

                        <div class="col-md-6">

                            <input class="input-proveedores" id="id_proveedor" type="hidden" name="id_proveedor" value="">

                            <div class="form-group">
                                <label>CC / NIT</label>
                                <input type="text" class="form-control input-proveedores" placeholder="Ingrese una cédula o NIT" id="cc_proveedor" name="cc_proveedor">
                            </div>

                            <div class="form-group">
                                <label>Nombre o razón Social</label>
                                <input type="text" class="form-control input-proveedores" placeholder="Escriba el nombre o razon social" id="nom_razonsocial" name="nom_razonsocial">
                            </div>

                            <div class="form-group">
                                <label>Dirección</label>
                                <input type="text" class="form-control input-proveedores" placeholder="Ingrese la dirección del proveedor" id="direccion_proveedor" name="direccion_proveedor">
                            </div>

                            <div class="form-group">
                                <label>Teléfono</label>
                                <input type="text" class="form-control input-proveedores" placeholder="Ingrese un número telefónico" id="telef_proveedor" name="telef_proveedor">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Contacto</label>
                                <input type="text" class="form-control input-proveedores" placeholder="Ingrese el nombre del contacto" id="contacto_proveedor" name="contacto_proveedor">
                            </div>

                            <div class="form-group">
                                <label>Correo electrónico</label>
                                <input type="text" class="form-control input-proveedores" placeholder="ejemplo@correo.com" id="correo_proveedor" name="correo_proveedor">
                            </div>

                            <div class="form-group">
                                <label>Ciudad</label>
                                <select id="ciudad_proveedor" class="form-control input-proveedores select2-single" name="ciudad_proveedor" type="number">
                                    <option selected value="">-Seleccione una ciudad-</option>
                                    <?php foreach ($Municipios as $key => $value) : ?>
                                        <option value="<?= $value['idmunicipio'] ?>"><?= $value['DeparMunic'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer justify-content-center bg-dark">
                    <button type="submit" class="btn btn-success">Guardar</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                </div>

                <?php
                $crearProveedor = new ControladorProveedores();
                $crearProveedor->ctrAgregarEditarProveedor();
                ?>

            </form>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- ===================== 
              FIN MODAL DEL BOTON NUEVO
            ========================= -->