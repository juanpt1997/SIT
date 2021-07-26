<?php
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
                    <h1 class="m-0 text-dark "><i><b>Gestión de contratos fijos</b></i></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                        <li class="breadcrumb-item active">Fijos</li>
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

            <button type="button" class="btn btn-success btn-md btn-agregarfijo" data-toggle="modal" data-target="#fijosmodal">
                <i class="fas fa-user-plus"></i> Nuevo contrato fijo
            </button>

            <div class="row mt-2">
                <div class="col-12">
                    <div class="card card-outline card-success">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-sm table-striped table-bordered dt-responsive table-hover tablasBtnExport w-100">
                                    <thead class="text-sm text-center text-nowrap">
                                        <tr>
                                            <th>...</th>
                                            <th style="width:10px;"><b>ID</b></th>
                                            <th>Nombre de cliente</th>
                                            <th>Nro. Contrato</th>
                                            <th>Observaciones</th>
                                            <th>Fecha inicial</th>
                                            <th>Fecha final</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-sm">
                                        <?php foreach ($ListarClientes as $key => $value) : ?>
                                            <tr>
                                                <td>
                                                    <div class="btn-group" role="group" aria-label="Button group">
                                                        <button class="btn btn-toolbar btn-sm btn-info btn-editarfijo" data-toggle="modal" data-target="#fijosmodal"><i class="fas fa-edit"></i></button>
                                                    </div>
                                                    <div class="btn-group" role="group" aria-label="Button group">
                                                        <button class="btn btn-toolbar btn-sm btn-primary btn-verfijo" data-toggle="modal" data-target="#fijosmodal"><i class="fas fa-eye"></i></button>
                                                    </div>
                                                </td>
                                                <td><?= $value[''] ?></td>
                                                <td><?= $value[''] ?></td>
                                                <td><?= $value[''] ?></td>
                                                <td><?= $value[''] ?></td>
                                                <td><?= $value[''] ?></td>
                                                <td><?= $value[''] ?></td>
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


<div class="modal fade" id="fijosmodal" tabindex="-1" data-backdrop="true" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

            <div class="modal-header bg-success">
                <h3 class="modal-title" id="titulo_fijos"></h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form method="post" enctype="multipart/form-data" id="formulariofijos">

                <div class="modal-body">

                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="text-sm">ID</label>
                            <div class="input-group input-group-sm">
                                <input class="form-control" type="number" id="idconfijo" name="idconfijo" value="" readonly>
                            </div>
                        </div>
                    </div>

                    <hr class="my-4">

                    <div class="form-group">
                        <label class="text-sm">Nombre del cliente</label>
                        <div class="input-group input-group-sm">
                            <input class="form-control input-fijos" type="text" id="nom_clien" name="nom_clien" placeholder="Nombre del cliente" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Número de contrato</label>
                                <div class="input-group input-group-sm">
                                    <input class="form-control input-fijos" type="number" id="num_contrato" name="num_contrato" placeholder="Digite el número del contrato" required>
                                </div>
                            </div>
                        </div><!-- col-1-->

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="text-sm">Fecha inicial</label>
                                <div class="input-group input-group-sm">
                                    <input class="form-control input-fijos" type="date" id="f_inicial_fijos" name="f_inicial_fijos" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="text-sm">Fecha final</label>
                                <div class="input-group input-group-sm">
                                    <input class="form-control input-fijos" type="date" id="f_final_fijos" name="f_final_fijos" required>
                                </div>
                            </div>
                        </div>
                    </div><!-- row-->

                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="text-sm">Documento escaneado</label>
                            <div class="input-group input-group-sm">
                                <input class="form-control-file input-fijos" type="file" id="documento_es" name="documento_es" required>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="text-sm">Observaciones</label>
                            <div class="input-group input-group-sm">
                                <textarea name="observaciones_fijos" id="observaciones_fijos" cols="30" rows="10" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>

                </div><!-- fin modal-body-->

                <div class="modal-footer bg-dark">
                    <button type="button" class="btn btn-danger btn-cancelar" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save"></i>
                        Guardar
                    </button>
                </div>
                <?php
                $CrearCliente = new ControladorClientes();
                $CrearCliente->ctrAgregarEditar();
                ?>
            </form>
        </div>
    </div>
</div>