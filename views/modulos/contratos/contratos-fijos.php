<?php
$ListarFijos = ControladorFijos::ctrVerFijos();
$clientes = ControladorClientes::ctrVerCliente("clientes");
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
                <i class="fas fa-file-invoice"></i> Nuevo contrato fijo
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
                                        <?php foreach ($ListarFijos as $key => $value) : ?>
                                            <tr>
                                                <td class="text-center">
                                                    <div class="btn-group" role="group" aria-label="Button group">
                                                        <button class="btn btn-toolbar btn-sm btn-info btn-editarfijo" idcliente="<?= $value['idcliente'] ?>" idfijos="<?= $value['idfijos'] ?>" data-toggle="modal" data-target="#fijosmodal"><i class="fas fa-edit"></i></button>
                                                    </div>
                                                </td>
                                                <td><?= $value['idfijos'] ?></td>
                                                <td><?= $value['nombre_cliente'] ?></td>
                                                <td><?= $value['numcontrato'] ?></td>
                                                <td><?= $value['observaciones'] ?></td>
                                                <td><?= $value['fecha_inicial'] ?></td>
                                                <td><?= $value['fecha_final'] ?></td>
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

            <div class="modal-header bg-info">
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
                                <input class="form-control input-fijos" type="number" id="idconfijo" name="idconfijo" value="" readonly>
                            </div>
                        </div>
                    </div>

                    <hr class="my-4 bg-dark">

                    <div class="form-group">
                        <label class="text-sm"><i>Nombre del cliente</i></label>
                        <div class="input-group input-group-sm">
                            <select class="form-control input-fijos select2-single" id="nom_clien" style="width: 99%" name="nom_clien" required>
                                <option value="" selected><b>-Seleccione un cliente-</b></option>
                                <?php foreach ($clientes as $key => $value) : ?>
                                    <option value="<?= $value['idcliente'] ?>"><?= $value['nombre'] ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="text-sm">Número de contrato</label>
                                <div class="input-group input-group-sm">
                                    <input class="form-control input-fijos" type="number" id="num_contrato" name="num_contrato" placeholder="Número del contrato" maxlength="10" readonly>
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

                    <hr class="my-4 bg-dark">

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="text-sm">Documento escaneado</label>
                            <div class="input-group input-group-sm">
                                <input class="form-control-file input-fijos" type="file" id="documento_es" name="documento_es" accept="image/png, image/jpeg, application/pdf">
                            </div>
                            <a id="visualizDocumento" href="" target="_blank"></a>
                        </div>
                    </div>

                    <hr class="my-4 bg-dark">

                    <div class="form-group">
                        <label class="text-sm">Observaciones</label>
                        <div class="input-group input-group-sm">
                            <textarea name="observaciones_fijos" type="text" id="observaciones_fijos" cols="30" rows="5" class="form-control input-fijos" maxlength="50"></textarea>
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
                $CrearCliente = new ControladorFijos();
                $CrearCliente->ctrAgregarEditarFijos();
                ?>
            </form>
        </div>
    </div>
</div>