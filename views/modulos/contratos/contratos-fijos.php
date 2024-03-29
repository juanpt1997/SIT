<?php

if (!validarPermiso('M_CONTRATOS', 'R')) {
    echo "<script> window.location = 'inicio'; </script>";
}

$ListarFijos = ControladorFijos::ctrVerFijos();
$clientes = ControladorClientes::ctrVerCliente("clientes");
$TiposVehiculo = ControladorVehiculos::ctrMostrarTipoVehiculo();
$Placas = ControladorVehiculos::ctrListaVehiculos();

?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark "><i><b>Gestión de contratos fijos <i class="fas fa-file-signature"></i></b></i></h1>
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
                                            <th>NIT/CC</th>
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
                                                        <button class="btn btn-toolbar btn-sm btn-secondary btn-editarfijo" idcliente="<?= $value['idcliente'] ?>" idfijos="<?= $value['idfijos'] ?>" data-toggle="modal" data-target="#fijosmodal" title="Editar"><i class="fas fa-edit"></i></button>
                                                        <button class="btn btn-toolbar btn-sm btn-primary btn-verRutas ml-1" idcliente="<?= $value['idcliente'] ?>" nombreCliente="<?= $value['nombre_cliente'] ?>" data-toggle="modal" data-target="#modalRutasCliente" title="Ver rutas"><i class="fas fa-route"></i></button>
                                                        <button class="btn btn-toolbar btn-sm btn-success btn-verVehiculosRutas ml-1" idcliente="<?= $value['idcliente'] ?>" nombreCliente="<?= $value['nombre_cliente'] ?>" data-toggle="modal" data-target="#modalVehiculosRutas" title="Ver vehículo"><i class="fas fa-bus"></i></button>
                                                    </div>
                                                </td>
                                                <td><?= $value['idfijos'] ?></td>
                                                <td><?= $value['nombre_cliente'] ?></td>
                                                <td><?= $value['nit'] ?></td>
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
                            <label class="text-sm">Número de contrato</label>
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
                                    <option value="<?= $value['idcliente'] ?>"><?= $value['clientexist'] ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 d-none">
                            <div class="form-group">
                                <label class="text-sm">Número de contrato</label>
                                <div class="input-group input-group-sm">
                                    <input class="form-control input-fijos" type="number" id="num_contrato" name="num_contrato" placeholder="Número del contrato" maxlength="10" readonly>
                                </div>
                            </div>
                        </div><!-- col-1-->

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="text-sm">Fecha inicial</label>
                                <div class="input-group input-group-sm">
                                    <input class="form-control input-fijos" type="date" id="f_inicial_fijos" name="f_inicial_fijos" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
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
                                <input class="form-control-file input-fijos" type="file" id="documento_es" name="documento_es" accept="image/png, image/jpeg, application/pdf" >
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
                    <?php if (validarPermiso('M_CONTRATOS', 'U')) : ?>
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-save"></i>
                            Guardar
                        </button>
                    <?php endif ?>
                </div>
                <?php
                $CrearCliente = new ControladorFijos();
                $CrearCliente->ctrAgregarEditarFijos();
                ?>
            </form>
        </div>
    </div>
</div>

<div id="modalRutasCliente" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title text-uppercase font-weight-bold" id="my-modal-title">Rutas - <span id="nombreClienteRutas" class="badge badge-info"></span></h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formRutasCliente" enctype="multipart/form-data" method="post">
                    <!-- ===================================================
                        CAMPOS RUTAS
                    =================================================== -->
                    <input type="hidden" id="idrutacliente" name="idrutacliente" value="">
                    <input type="hidden" id="idclienteRutas" name="idcliente" value="">
                    <div class="row mt-3">
                        <!-- Ruta -->
                        <div class="col-12">
                            <div class="form-group">
                                <label for="idruta" class="d-flex justify-content-center"><i>DESCRIPCIÓN RUTA</i></label>
                                <div class="input-group">
                                    <input type="hidden" id="idruta" name="idruta">
                                    <input class="form-control" type="text" id="descripcion" name="descripcion" placeholder="Seleccione una ruta de la lista" required>
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-secondary btn-md btn-ruta" title="Buscar una ruta existente" data-toggle="modal" data-target="#modal_general"><i class="fas fa-route"></i></button>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <!-- Origen -->
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label>Origen</label>
                                <div class="input-group">
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <i class="fas fa-route"></i>
                                        </span>
                                    </div>
                                    <input class="form-control" type="text" id="origen" name="origen" readonly>
                                </div>
                            </div>

                        </div><!-- /.col -->

                        <!-- Destino -->
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label>Destino</label>
                                <div class="input-group">
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <i class="fas fa-route"></i>
                                        </span>
                                    </div>
                                    <input class="form-control" type="text" id="destino" name="destino" readonly>
                                </div>
                            </div>
                        </div><!-- /.col -->
                    </div>

                    <div class="row">
                        <!-- ===================================================
                            Tipo vehículo
                        =================================================== -->
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="tipoVehiculo">Tipo Vehículo</label>
                                <select id="tipoVehiculo" class="form-control" name="idtipovehiculo" required>
                                    <option value="" disabled selected>-Seleccione un tipo de vehículo-</option>
                                    <?php foreach ($TiposVehiculo as $key => $value) : ?>
                                        <option value="<?= $value['idtipovehiculo'] ?>"><?= $value['tipovehiculo'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                        <!-- ===================================================
                            Valor recorrido
                        =================================================== -->
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="valor_recorrido">Valor Recorrido Día</label>
                                <input id="valor_recorrido" class="form-control" type="number" name="valor_recorrido" min="1" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 text-right">
                            <button class="btn btn-success" id="btnGuardarRuta" type="submit"><i class="fas fa-save"></i> Guardar</button>
                        </div>
                    </div>
                </form>



                <hr class="my-4 bg-secondary">

                <!-- ===================================================
                    RESUMEN DE RUTAS
                =================================================== -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header text-uppercase font-weight-bold">
                                Resumen Rutas
                            </div>
                            <div class="card-body table-responsive">
                                <table id="tblRutasxCliente" class="table-sm table-striped table-bordered table-hover w-100">
                                    <thead>
                                        <tr>
                                            <th>Cliente</th>
                                            <th>Origen</th>
                                            <th>Destino</th>
                                            <th>Descripción</th>
                                            <th>Tipo vehículo</th>
                                            <th>Valor recorrido día</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbodyRutasxCliente" class="tbody-light">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<div id="modalVehiculosRutas" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h5 class="modal-title text-uppercase font-weight-bold" id="my-modal-title">Vehículos</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form id="form_contrutas" method="post" enctype="multipart/form-data">

                    <!-- SELECCIÓN DE VEHÍCULO -->
                    <div class="row">
                        <div class="col-12 col-sm-6 col-lg-4">
                            <div class="form-group">
                                <label for="placa_contrutas" class="d-flex justify-content-center"><i>Placa</i></label>
                                <select id="placa_contrutas" name="idvehiculo_contrutas" class="form-control select2-single" type="number" style="width: 99%" required>
                                    <option selected value="">Seleccione un vehículo</option>
                                    <?php foreach ($Placas as $key => $value) : ?>
                                        <option value="<?= $value['idvehiculo'] ?>"><?= $value['placa'] ?> - <?= $value['numinterno'] ?> </option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>



                        <div class="col-12 col-sm-6 col-lg-4">
                            <div class="form-group text-center">
                                <label><i>Número interno</i></label>
                                <input type="text" class="form-control" id="num_internocontrutas" required readonly>
                            </div>
                        </div>

                        <div class="col-12 col-sm-6 col-lg-4">
                            <div class="form-group text-center">
                                <label><i>Marca</i></label>
                                <input type="text" class="form-control" id="marca_contrutas" required readonly>
                            </div>
                        </div>

                        <div class="col-12 col-sm-6 col-lg-4">
                            <div class="form-group text-center">
                                <label><i>Clase de vehículo</i></label>
                                <input type="text" class="form-control" id="clase_contrutas" required readonly>
                            </div>
                        </div>

                        <div class="col-12 col-sm-6 col-lg-4">
                            <div class="form-group text-center">
                                <label><i>Modelo</i></label>
                                <input type="text" class="form-control" id="modelo_contrutas" required readonly>
                            </div>
                        </div>

                        <div class="col-12 col-sm-6 col-lg-4">
                            <div class="form-group text-center">
                                <label><i>Kilometraje</i></label>
                                <input type="number" class="form-control" id="kilometraje_contrutas" required readonly>
                            </div>
                        </div>
                    </div>
                </form>

                <div class="d-flex justify-content-center">
                    <div class="form-group">
                        <button type="submit" class="btn btn-sm btn-success btn-block btn-guardarvehiculosclientes" form="form_contrutas"><i class="fas fa-plus"></i> Agregar al vehículo</button>
                    </div>
                </div>



                <hr class="my-4 bg-secondary">

                <!-- RESUMEN VEHÍCULOS POR RUTA -->

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header bg-success text-uppercase font-weight-bold">
                                Resumen vehículos por contratos
                            </div>
                            <div class="card-body table-responsive">
                                <table class="table-sm table-striped table-bordered table-hover w-100">
                                    <thead class="text-nowrap text-center" >
                                        <tr>
                                            <th>...</th>
                                            <th>Placa</th>
                                            <th>Número interno</th>
                                            <th>Cliente</th>
                                           
                                        </tr>
                                    </thead>
                                    <tbody id="tbodyresuRutasContratos" class="text-nowrap text-center">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>