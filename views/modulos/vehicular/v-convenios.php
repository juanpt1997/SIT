<?php

if (!validarPermiso('M_VEHICULAR', 'R')) {
    echo "<script> window.location = 'inicio'; </script>";
}

$Empresas = ControladorConvenios::ctrMostrar();
$DeparMunicipios = ControladorGH::ctrDeparMunicipios();
$Vehiculos = ControladorVehiculos::ctrMostrarTipoVehiculo();
$Placas = ControladorVehiculos::ctrListaVehiculos();
$Sucursales = ControladorGH::ctrSucursales();
$Convenios = ControladorConvenios::ctrMostrarConvenios();
$ConveniosVencer = ControladorConvenios::ctrVencimientosConvenios();

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
                    <ul class="nav nav-tabs mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item border border-info rounded ml-2 mb-1 mb-md-0">
                            <a class="nav-link h4" id="pills-empresas-tab" data-toggle="tab" href="#pills-empresas" role="tab" aria-controls="pills-empresas" aria-selected="false">Empresas <i class="fas fa-building"></i></a>
                        </li>
                        <li class="nav-item border border-info rounded ml-2 mb-1 mb-md-0">
                            <a class="nav-link active h4" id="pills-convenios-tab" data-toggle="tab" href="#pills-convenios" role="tab" aria-controls="pills-convenios" aria-selected="true">Convenios <i class="fas fa-file-contract"></i></a>
                        </li>

                        <li class="nav-item border border-info rounded ml-2 mb-1 mb-md-0">
                            <a class="nav-link h4" id="pills-vencimientos-tab" data-toggle="tab" href="#pills-vencimientos" role="tab" aria-controls="pills-vencimientos" aria-selected="true">Vencimientos <i class="fas fa-hourglass-end"></i></a>
                        </li>
                    </ul>
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

            <hr class="my-4">



            <!-- ===================== 
              AGREGAR FILAS Y COLUMNAS PARA EL DESARROLLO 
            ========================= -->
            <div class="tab-content" id="pills-tabcontent">
                <div class="tab-pane fade" id="pills-empresas" role="tabpanel" aria-labelledby="pills-empresas-tab">
                    <div class="row">
                        <div class="col">
                            <!--BOTON NUEVO CONVENIO-->
                            <button type="button" class="btn btn-success btn-md btn-agregarEmpresa" data-toggle="modal" data-target="#EmpresasModal">
                                <i class="fas fa-user-plus"></i> Añadir Empresa
                            </button>
                        </div><!-- col -->
                    </div> <!-- /.row -->
                    <div class="row mt-2">
                        <div class="col-12">
                            <div class="card card-outline card-info">

                                <div class="card-body">

                                    <div class="table-responsive">
                                        <table class="table table-sm table-striped table-bordered dt-responsive table-hover tablasBtnExport w-100">
                                            <thead class="thead-light text-sm text-center">
                                                <tr>
                                                    <th style="width:10px;">#</th>
                                                    <th>Documento</th>
                                                    <th>NIT</th>
                                                    <th>Nombre</th>
                                                    <th>Direccion</th>
                                                    <th>Telefono 1</th>
                                                    <th>Telefono 2</th>
                                                    <th>Ciudad</th>
                                                    <th>Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody class="text-sm">
                                                <?php foreach ($Empresas as $key => $value) : ?>
                                                    <?php
                                                    if ($value['ruta_documento'] != null) {

                                                        $btnDoc = "<a href='" . URL_APP . $value['ruta_documento'] . "' target='_blank' class='btn btn-sm btn-info m-1' type='button'><i class='fas fa-file-contract'></i></a>";
                                                    } else {

                                                        $btnDoc = "<span class='badge badge-secondary'>sin documento</span>";
                                                    }

                                                    ?>
                                                    <tr>
                                                        <td><?= $value['idxc'] ?></td>
                                                        <td class='text-center'><?= $btnDoc ?></td>
                                                        <td><?= $value['nit'] ?></td>
                                                        <td><?= $value['nombre'] ?></td>
                                                        <td><?= $value['direccion'] ?></td>
                                                        <td><?= $value['telefono1'] ?></td>
                                                        <td><?= $value['telefono2'] ?></td>
                                                        <td><?= $value['ciudad'] ?></td>
                                                        <td>
                                                            <div class="row d-flex flex-nowrap justify-content-center">
                                                                <div class="col-md-6">
                                                                    <div class="btn-group" role="group" aria-label="Button group">
                                                                        <button class="btn btn-toolbar btn-sm btn-info btnEditarEmpresa" title="Editar empresa." idxc="<?= $value['idxc'] ?>" nit="<?= $value['nit'] ?>" data-toggle="modal" data-target="#EmpresasModal"><i class="fas fa-edit"></i></button>
                                                                        <?php if (validarPermiso('M_VEHICULAR', 'D')) : ?>
                                                                            <button class="btn btn-toolbar btn-sm btn-danger btnBorrarEmpresa ml-1" title="Eliminar empresa." idxc="<?= $value['idxc'] ?>" nit="<?= $value['nit'] ?>"> <i class="fas fa-trash"></i> </button>
                                                                        <?php endif ?>
                                                                    </div>
                                                                </div>
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
                </div>


                <div class="tab-pane fade show active" id="pills-convenios" role="tabpanel" aria-labelledby="pills-convenios-tab">
                    <div class="row">
                        <div class="col">
                            <!--BOTON NUEVO CONVENIO-->
                            <button type="button" class="btn btn-success btn-md btn-agregarConvenio" data-toggle="modal" data-target="#ConvenioModal">
                                <i class="fas fa-user-plus"></i> Añadir Convenio
                            </button>
                        </div><!-- col -->
                    </div> <!-- /.row -->

                    <div class="row mt-2">
                        <div class="col-12">
                            <div class="card card-outline card-info">

                                <div class="card-body">

                                    <div class="table-responsive">
                                        <table class="table table-sm table-striped table-bordered table-hover tablasBtnExport text-nowrap w-100">
                                            <thead class="thead-light text-sm text-center text-nowrap">
                                                <tr>
                                                    <th>...</th>
                                                    <th style="width:10px;">#</th>
                                                    <th>Vehículos</th>
                                                    <th>Documento</th>
                                                    <th>Placa</th>
                                                    <th>NIT</th>
                                                    <th>Empresa contratante</th>
                                                    <th>NIT</th>
                                                    <th>Empresa contratista</th>
                                                    <th>Contrato a ejecutar</th>
                                                    <th>Sucursal</th>
                                                    <th>Fecha inicio del convenio</th>
                                                    <th>Fecha terminación del convenio</th>
                                                    <th>Estado en empresa</th>
                                                    <th>Fecha radicado ministerio</th>
                                                    <th>Número Radicado</th>
                                                    <th>Observación</th>
                                                </tr>
                                            </thead>

                                            <tbody class="text-sm">
                                                <?php foreach ($Convenios as $key => $value) : ?>
                                                    <?php
                                                    if ($value['ruta_documento'] != null) {

                                                        $btnDoc = "<a href='" . URL_APP . $value['ruta_documento'] . "' target='_blank' class='btn btn-sm btn-info m-1' type='button'><i class='fas fa-file-contract'></i></a>";
                                                    } else {

                                                        $btnDoc = "<span class='badge badge-secondary'>sin documento</span>";
                                                    }

                                                    ?>
                                                    <tr>
                                                        <td>
                                                            <div class="row d-flex flex-nowrap justify-content-center">
                                                                <div class="col-md-6">
                                                                    <div class="btn-group" role="group" aria-label="Button group">
                                                                        <button class="btn btn-xs btn-info btnEditarConv" title="Editar convenio." idConvenio="<?= $value['idconvenio'] ?>" data-toggle="modal" data-target="#ConvenioModal"><i class="fas fa-edit"></i></button>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <?php if (validarPermiso('M_VEHICULAR', 'D')) : ?>
                                                                        <div class="btn-group" role="group" aria-label="Button group">
                                                                            <button class="btn btn-xs btn-danger btnBorrarConv" title="Eliminar convenio." idConvenio="<?= $value['idconvenio'] ?>"> <i class="fas fa-trash"></i> </button>
                                                                        </div>
                                                                    <?php endif ?>
                                                                </div>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div class="row d-flex flex-nowrap justify-content-center">
                                                                <div class="col-md-6">
                                                                    <?= $value['idconvenio'] ?>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="text-center">
                                                            <div class="btn-group mr-2" role="group" aria-label="Button group">
                                                                <button class="btn btn-xs btn-success btnPlacas" idConvenio="<?= $value['idconvenio'] ?>"><i class="fas fa-bus"></i></button>
                                                            </div>
                                                        </td>
                                                        <td class="text-center"><?= $btnDoc ?></td>
                                                        <td><?= $value['placa'] ?></td>
                                                        <td><?= $value['nitContratante'] ?></td>
                                                        <td><?= $value['nomContratante'] ?></td>
                                                        <td><?= $value['nitContratista'] ?></td>
                                                        <td><?= $value['nomContratista'] ?></td>
                                                        <td><?= $value['contrato'] ?></td>
                                                        <td><?= $value['sucursal'] ?></td>
                                                        <td><?= $value['fecha_inicio'] ?></td>
                                                        <td><?= $value['fecha_terminacion'] ?></td>
                                                        <td><?= $value['estado'] ?></td>
                                                        <td><?= $value['fecha_radicado'] ?></td>
                                                        <td><?= $value['num_radicado'] ?></td>
                                                        <td><?= $value['observacion'] ?></td>
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



                </div>

                <div class="tab-pane fade" id="pills-vencimientos" role="tabpanel" aria-labelledby="pills-vencimientos-tab">
                    <div class="row mt-2">
                        <div class="col-12">
                            <div class="card card-outline card-info">

                                <div class="card-body">

                                    <div class="table-responsive">
                                        <table class="table table-sm table-striped table-bordered table-hover tablasBtnExport text-nowrap w-100">
                                            <thead class="thead-light text-sm text-center text-nowrap">
                                                <tr>
                                                    <th style="width:10px;">#</th>
                                                    <th>Fecha inicio</th>
                                                    <th>Fecha terminación</th>
                                                    <th>Días para vencer</th>
                                                    <th>Vehículos</th>
                                                    <th>Documento</th>
                                                    <th>Placa</th>
                                                    <th>NIT</th>
                                                    <th>Empresa contratante</th>
                                                    <th>NIT</th>
                                                    <th>Empresa contratista</th>
                                                    <th>Contrato a ejecutar</th>
                                                    <th>Sucursal</th>
                                                    <th>Estado en empresa</th>
                                                    <th>Fecha radicado ministerio</th>
                                                    <th>Número Radicado</th>
                                                    <th>Observación</th>
                                                </tr>
                                            </thead>

                                            <tbody class="text-sm">
                                                <?php foreach ($ConveniosVencer as $key => $value) : ?>
                                                    <?php
                                                    if ($value['ruta_documento'] != null) {

                                                        $btnDoc = "<a href='" . URL_APP . $value['ruta_documento'] . "' target='_blank' class='btn btn-sm btn-info m-1' type='button'><i class='fas fa-file-contract'></i></a>";
                                                    } else {

                                                        $btnDoc = "<span class='badge badge-secondary'>sin documento</span>";
                                                    }

                                                    $badgecolor = ControladorVehiculos::Semaforo_tipo2($value['fecha_terminacion'], date("Y-m-d"));


                                                    ?>
                                                    <tr>
                                                        <td>
                                                            <div class="row d-flex flex-nowrap justify-content-center">
                                                                <div class="col-md-6">
                                                                    <?= $value['idconvenio'] ?>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td><?= $value['fecha_inicio'] ?></td>
                                                        <td><?= $value['fecha_terminacion'] ?></td>
                                                        <td><span class="badge badge-<?= $badgecolor ?> "><?= $value['diferencia'] ?></span></td>
                                                        <td class="text-center">
                                                            <div class="btn-group mr-2" role="group" aria-label="Button group">
                                                                <button class="btn btn-xs btn-success btnPlacas" idConvenio="<?= $value['idconvenio'] ?>"><i class="fas fa-bus"></i></button>
                                                            </div>
                                                        </td>
                                                        <td class="text-center"><?= $btnDoc ?></td>
                                                        <td><?= $value['placa'] ?></td>
                                                        <td><?= $value['nitContratante'] ?></td>
                                                        <td><?= $value['nomContratante'] ?></td>
                                                        <td><?= $value['nitContratista'] ?></td>
                                                        <td><?= $value['nomContratista'] ?></td>
                                                        <td><?= $value['contrato'] ?></td>
                                                        <td><?= $value['sucursal'] ?></td>
                                                        <td><?= $value['estado'] ?></td>
                                                        <td><?= $value['fecha_radicado'] ?></td>
                                                        <td><?= $value['num_radicado'] ?></td>
                                                        <td><?= $value['observacion'] ?></td>
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
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!--MODALS-->

<!-- MODAL NUEVA EMPRESA -->

<div class="modal fade" id="EmpresasModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <form method="post" enctype="multipart/form-data" id="formulario_empresa">
                <!-- INICIO DEL FORMULARIO -->

                <div class="modal-header bg-info">
                    <h5 class="modal-title" id="titulo-modal-empresas"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">

                    <input type="hidden" id="idxc" name="idxc">

                    <!--nit-->
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <i class="fas fa-address-card"></i>
                                </span>
                            </div>
                            <input class="form-control input-convenio" type="text" min="0" id="nit" name="nit" placeholder="NIT de la empresa" required>
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
                            <input class="form-control input-convenio" type="text" id="nombre" name="nombre" placeholder="Nombre del convenio" maxlength="70" required>
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
                            <input class="form-control input-convenio" type="text" id="dirco" name="dirco" placeholder="Dirección" maxlength="80" required>
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
                            <input class="form-control input-convenio" type="text" id="telco" name="telco" placeholder="Teléfono 1" maxlength="16" required>
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
                            <input class="form-control input-convenio" type="text" id="telco2" name="telco2" placeholder="Teléfono 2 (opcional)" maxlength="16">
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
                            <select class="form-control input-convenio select2-single" style="width: 92%" type="text" id="ciudadcon" name="ciudadcon" data-placeholder="Seleccione una ciudad" required>
                                <?php foreach ($DeparMunicipios as $key => $value) : ?>
                                    <option value="<?= $value['idmunicipio'] ?>"><?= $value['DeparMunic'] ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Subir documento escaneado (1 archivo a la vez)</label>
                        <div class="input-group">
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <i class="fas fa-file-alt"></i>
                                </span>
                            </div>
                            <input type="file" class="form-control input-sm" name="foto_documento_empresa" id="foto_documento_empresa" accept="image/png, image/jpeg, application/pdf">
                        </div>
                    </div>
                </div>

                <div class="modal-footer bg-dark">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    <?php if (validarPermiso('M_VEHICULAR', 'U')) : ?>
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-save"></i> Guardar</button>
                    <?php endif ?>
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


<!-- MODAL NUEVO CONVENIO -->

<div class="modal fade" id="ConvenioModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">


            <div class="modal-header bg-info">
                <h5 class="modal-title" id="titulo-modal-convenios"></h5>
                <button class="btn btn-app bg-success btn-copy-convenio d-none"><i class="fas fa-copy"></i>Copiar</button>
                <!-- <button class="btn btn-secondary ml-2 d-none btn-copy-" type="button"><i class="far fa-copy"></i> Copia
                </button> -->
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form method="post" enctype="multipart/form-data" id="datosconvenio_form">
                    <!-- INICIO DEL FORMULARIO -->
                    <input type="hidden" id="idConvenio" name="idConvenio">
                    <div class="row">
                        <!-- EMPRESA CONTRATANTE -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="text-sm">Empresa contratante</label>
                                <div class="input-group input-group-sm">
                                    <select class="form-control select2-single" id="empresacontratante" type="text" style="width: 99%" data-placeholder="-Lista de empresas-" name="idcontratante" required>
                                        <?php foreach ($Empresas as $key => $value) : ?>
                                            <option value="<?= $value['idxc'] ?>"><?= $value['nombre'] ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>
                        </div>


                        <!-- EMPRESA CONTRATISTA -->

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="text-sm">Empresa contratista</label>
                                <div class="input-group input-group-sm">
                                    <select class="form-control select2-single" id="empresacontratista" data-placeholder="-Lista de empresas-" style="width: 99%" name="idcontratista" required>
                                        <?php foreach ($Empresas as $key => $value) : ?>
                                            <option value="<?= $value['idxc'] ?>"><?= $value['nombre'] ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>


                    <hr class="my-4 bg-dark">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="text-sm">Contrato a ejecutar</label>
                                <div class="input-group input-group-sm">
                                    <input class="form-control input-sm" type="text" id="convenioContrato" name="contrato" placeholder="Ingrese el contrato a ejecutar" maxlength="45" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="text-sm">Sucursal</label>
                                <div class="input-group input-group-sm">
                                    <select class="form-control select2-single select-clientes input-sm" id="sucursal" data-placeholder="-Lista de sucursales-" style="width: 99%" name="idsucursal">
                                        <?php foreach ($Sucursales as $key => $value) : ?>
                                            <option value="<?= $value['ids'] ?>"><?= $value['sucursal'] ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Subir documento escaneado (1 archivo a la vez)</label>
                        <div class="input-group">
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <i class="fas fa-file-alt"></i>
                                </span>
                            </div>
                            <input type="file" class="form-control input-sm" name="foto_documento_convenio" id="foto_documento_convenio" accept="image/png, image/jpeg, application/pdf">
                        </div>
                    </div>

                    <hr class="my-4 bg-dark">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="text-sm">Vehiculos</label>
                                <div class="input-group input-group-sm">
                                    <select id="placa" class="select2-primary form-control select2-multiple input-sm" data-placeholder="-Lista de placas-" multiple="multiple" style="width: 99%" name="idvehiculo[]" required>
                                        <?php foreach ($Placas as $key => $value) : ?>
                                            <option value="<?= $value['idvehiculo'] ?>"><?= $value['placa'] ?> - <?= $value['numinterno'] ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>


                    <hr class="my-4 bg-dark">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="text-sm">Fecha inicio del convenio</label>
                                <div class="input-group input-group-sm">
                                    <input class="form-control" type="date" id="fecha_inicio" name="fecha_inicio" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="text-sm">Fecha terminación del convenio</label>
                                <div class="input-group input-group-sm">
                                    <input class="form-control" type="date" id="fecha_terminacion" name="fecha_terminacion" required>
                                </div>
                            </div>
                        </div>


                    </div>

                    <hr class="my-4 bg-dark">

                    <div class="row">
                        <div class="col-md-6">
                            <label class="text-sm">Estado en empresa</label>
                            <div class="input-group input-group-sm">
                                <select id="estado" class="form-control select2-single select-clientes input-sm" data-placeholder="-Lista de estados-" style="width: 99%" name="estado">
                                    <option class="text-sm" value="" selected></option>
                                    <option class="text-sm" value="Firmado">Firmado</option>
                                    <option class="text-sm" value="Pendiente firma cartera">Pendiente firma cartera</option>
                                    <option class="text-sm" value="Pendiente firma ss">Pendiente firma ss</option>
                                    <option class="text-sm" value="Pendiente firma doc">Pendiente firma doc</option>
                                    <option class="text-sm" value="Devuelto a suc">Devuelto a suc</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="text-sm">Fecha radicado ministerio</label>
                                <div class="input-group input-group-sm">
                                    <input class="form-control" type="date" id="fecha_radicado" name="fecha_radicado" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="text-sm">Número radicado</label>
                                <div class="input-group input-group-sm">
                                    <input class="form-control input-clientes" type="text" id="num_radicado" name="num_radicado" placeholder="Número radicado" maxlength="45" required>
                                </div>
                            </div>
                        </div>

                    </div>


                    <hr class="my-4 bg-dark">

                    <div class="form-group">
                        <label class="text-sm">Observaciones</label>
                        <div class="input-group input-group-sm">
                            <textarea class="form-control" type="text" id="observacion" name="observacion" placeholder="Escriba los motivos" style="min-height:70px"></textarea requiered>
                            </div>
                        </div>
                        <?php
                        $ctrAdd = new ControladorConvenios();
                        $ctrAdd->ctrAgregarEditarConvenios();
                        ?>
                    </form> <!-- FIN FORMULARIO-->  
                </div>


                <div class="modal-footer bg-dark">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    <?php if (validarPermiso('M_VEHICULAR', 'U')) : ?>
                    <button type="submit" form="datosconvenio_form" class="btn btn-success">
                        <i class="fas fa-save"></i> Guardar</button>
                    <?php endif ?>
                </div>


             
            <!-- FIN DEL MODAL CONVENIOS -->
        </div>
    </div>
</div>