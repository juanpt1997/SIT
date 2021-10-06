<?php

if (!validarPermiso('M_CONTRATOS', 'R')) {
    echo "<script> window.location = 'inicio'; </script>";
}

$DeparMunicipios = ControladorGH::ctrDeparMunicipios();
$ListarClientes = ControladorClientes::ctrVerCliente();
?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark "><i><b>Gestión de clientes</b></i></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                        <li class="breadcrumb-item active">Clientes</li>
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

            <!--BUTON AGREGAR CLIENTE-->
            <button type="button" class="btn btn-success btn-md btn-agregarcliente" data-toggle="modal" data-target="#clientesmodal">
                <i class="fas fa-user-plus"></i> Agregar nuevo cliente
            </button>

            <div class="row mt-2">
                <div class="col-12">
                    <div class="card card-outline card-success">
                        <div class="card-body">
                            <!--TABLA PARA VISUALIZAR CLIENTES-->
                            <div class="table-responsive">
                                <table class="table table-sm table-striped table-bordered dt-responsive table-hover tablasBtnExport w-100">
                                    <thead class="text-sm text-center text-nowrap">
                                        <tr>
                                            <th>...</th>
                                            <th style="width:10px;">ID</th>
                                            <th>Nombre</th>
                                            <th>Documento</th>
                                            <th>Tipo</th>
                                            <th>Telefono</th>
                                            <th>Dirección</th>
                                            <th>Ciudad</th>
                                            <th>Estado</th>
                                            <th>Documento del responsable</th>
                                            <th>Teléfono</th>
                                            <th>Tipo</th>
                                            <th>Nombre del responsable</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-sm">
                                        <?php foreach ($ListarClientes as $key => $value) : ?>

                                            <?php
                                            if ($value['tipo'] == "LEAD") {

                                                $estado = '<button class="btn btn-sm btn-warning btn-estado" idcliente="' . $value["idcliente"] . '">Volver cliente <i class="fas fa-user-check"></i></button>';
                                            } else {

                                                $estado = "<span class='badge badge-success'>Cliente</span>";
                                            }

                                            ?>


                                            <tr>
                                                <td class="text-center">
                                                    <div class="btn-group" role="group" aria-label="Button group">
                                                        <button class="btn btn-toolbar btn-sm btn-info btn-editarcliente" idcliente="<?= $value['idcliente'] ?>" docum="<?= $value['Documento'] ?>" data-toggle="modal" data-target="#clientesmodal"><i class="fas fa-edit"></i></button>
                                                    </div>
                                                </td>
                                                <td><?= $value['idcliente'] ?></td>
                                                <td><?= $value['nombre'] ?></td>
                                                <td><?= $value['Documento'] ?></td>
                                                <td><?= $value['tipo_doc'] ?></td>
                                                <td><?= $value['telefono'] ?></td>
                                                <td><?= $value['direccion'] ?></td>
                                                <td><?= $value['ciudad'] ?></td>
                                                <td><?= $estado ?></td>
                                                <td><?= $value['Documentorespons'] ?></td>
                                                <td><?= $value['telefono2'] ?></td>
                                                <td><?= $value['tipo_docrespons'] ?></td>
                                                <td><?= $value['nombrerespons'] ?></td>
                                            </tr>
                                        <?php endforeach ?>
                                    </tbody>
                                </table>
                            </div>
                        </div><!-- card-body-->
                    </div><!-- card-->
                </div><!-- col-->
            </div><!-- row-->
        </div><!-- FIN container-->
    </div><!-- /.content -->
</div><!-- /.content-wrapper -->

<!--_-----------------------------------
----------MODAL CLIENTES AGREGAR/EDITAR-
---------------------------------------->
<div class="modal fade" id="clientesmodal" tabindex="-1" data-backdrop="true" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

            <div class="modal-header bg-info">
                <h3 class="modal-title" id="titulo_clientes"></h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form method="post" enctype="multipart/form-data" id="formularioclientes">

                <div class="modal-body">

                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="text-sm">ID</label>
                            <div class="input-group input-group-sm">
                                <input class="form-control" type="number" id="idcliente" name="idcliente" value="" readonly>
                            </div>
                        </div>
                    </div>

                    <hr class="my-4 bg-dark">

                    <div class="form-group">
                        <label class="text-sm">Nombre de la empresa</label>
                        <div class="input-group input-group-sm">
                            <input class="form-control input-clientes" type="text" id="nom_empre" name="nom_empre" placeholder="Nombre de la empresa" maxlength="100" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">

                            <div class="form-group">
                                <label class="text-sm">Tipo de documento</label>
                                <div class="input-group input-group-sm">
                                    <select class="form-control input-clientes" type="text" id="t_document_empre" name="t_document_empre" required>
                                        <option selected value="">-Seleccione una opción-</option>
                                        <option>NIT</option>
                                        <option>CC</option>
                                        <option>CE</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="text-sm">Ciudad</label>
                                <div class="input-group input-group-sm">
                                    <select class="form-control input-sm select2-single input-clientes" style="width: 99%" type="number" id="ciudadcliente" name="ciudadcliente" required>
                                        <option selected value="">-Seleccione una ciudad-</option>
                                        <?php foreach ($DeparMunicipios as $key => $value) : ?>
                                            <option value="<?= $value['idmunicipio'] ?>"><?= $value['DeparMunic'] ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="text-sm">Teléfono</label>
                                <div class="input-group input-group-sm">
                                    <input class="form-control input-clientes" type="text" id="telclient" name="telclient" placeholder="Ingrese un teléfono" maxlength="10" required>
                                </div>
                            </div>
                        </div><!-- col-1-->

                        <div class="col-md-6">

                            <div class="form-group">
                                <label class="text-sm">Documento</label>
                                <div class="input-group input-group-sm">
                                    <input class="form-control input-clientes" type="text" id="docum_empre" name="docum_empre" placeholder="Ingrese el documento de la empresa" maxlength="15" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="text-sm">Dirección</label>
                                <div class="input-group input-group-sm">
                                    <input class="form-control input-clientes" type="text" id="dir_empre" name="dir_empre" placeholder="Dirección de la empresa" maxlength="100" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="text-sm">Teléfono 2</label>
                                <div class="input-group input-group-sm">
                                    <input class="form-control input-clientes" type="text" id="telclient2" name="telclient2" placeholder="Ingrese un segundo teléfono" maxlength="10" required>
                                </div>
                            </div>
                        </div><!-- col-2-->
                    </div><!-- row-->

                    <hr class="my-4 bg-dark">

                    <div class="form-group">
                        <label class="text-sm">Nombre del responsable</label>
                        <div class="input-group input-group-sm">
                            <input class="form-control input-clientes" type="text" id="nom_respo" name="nom_respo" placeholder="Nombre del responsable" maxlength="100" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">

                            <div class="form-group">
                                <label class="text-sm">Tipo de documento del responsable</label>
                                <div class="input-group input-group-sm">
                                    <select class="form-control input-clientes" type="text" id="t_document_respo" name="t_document_respo" required>
                                        <option selected value="">-Seleccione una opción-</option>
                                        <option>NIT</option>
                                        <option>CC</option>
                                        <option>CE</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="text-sm">Ciudad responsable</label>
                                <div class="input-group input-group-sm">
                                    <select class="form-control input-sm select2-single input-clientes" style="width: 99%" type="number" id="ciudadresponsable" name="ciudadresponsable" required>
                                        <option selected value="">-Seleccione una ciudad-</option>
                                        <?php foreach ($DeparMunicipios as $key => $value) : ?>
                                            <option value="<?= $value['idmunicipio'] ?>"><?= $value['DeparMunic'] ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>

                        </div>
                        <!--col-1-->
                        <div class="col-md-6">

                            <div class="form-group">
                                <label class="text-sm">Cédula expedida en:</label>
                                <div class="input-group input-group-sm">
                                    <select class="form-control input-sm select2-single input-clientes" style="width: 99%" type="number" id="expedicion" name="expedicion" required>
                                        <option selected value="">-Seleccione una ciudad-</option>
                                        <?php foreach ($DeparMunicipios as $key => $value) : ?>
                                            <option value="<?= $value['idmunicipio'] ?>"><?= $value['DeparMunic'] ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="text-sm">Documento</label>
                                <div class="input-group input-group-sm">
                                    <input class="form-control input-clientes" type="text" id="docum_respo" name="docum_respo" placeholder="Documento del responsable" maxlength="15" required>
                                </div>
                            </div>
                        </div><!-- col-2-->
                    </div><!-- row-2-->
                </div><!-- fin modal-body-->

                <div class="modal-footer bg-dark">
                    <button type="button" class="btn btn-danger btn-cancelar" data-dismiss="modal">Cancelar</button>
                    <?php if (validarPermiso('M_CONTRATOS', 'U')) : ?>
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-save"></i>
                            Guardar
                        </button>
                    <?php endif ?>
                </div>
                <?php
                $CrearCliente = new ControladorClientes();
                $CrearCliente->ctrAgregarEditar();
                ?>
            </form>
        </div>
    </div>
</div>