<?php

if (!validarPermiso('M_CONTRATOS', 'R')) {
    echo "<script> window.location = 'inicio'; </script>";
}

$DeparMunicipios = ControladorGH::ctrDeparMunicipios();
$ListarClientes = ControladorClientes::ctrVerCliente();
$tiposClientes = ControladorClientes::ctrTiposClientes();
$tipovehiculos = ControladorVehiculos::ctrMostrarTipoVehiculo();
?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">

                    <ul class="nav nav-tabs mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item border border-info rounded ml-2 mb-1 mb-md-0">
                            <a class="nav-link active h4" id="gestion-clientes-tab" data-toggle="tab" href="#gestion-clientes" role="tab" aria-controls="gestion-clientes" aria-selected="active">Gestión de clientes <i class="fas fa-user-tag"></i></a>
                        </li>


                        <li class="nav-item border border-info rounded ml-2 mb-1 mb-md-0">
                            <a class="nav-link h4" id="visitas-tab" data-toggle="tab" href="#visitas" role="tab" aria-controls="visitas" aria-selected="false">Visitas <i class="far fa-calendar-alt"></i></a>
                        </li>
                    </ul>



                    <!-- <h1 class="m-0 text-dark "><i><b>Gestión de clientes <i class="fas fa-user-tag"></i></b></i></h1> -->
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

            <div class="tab-content" id="pills-tabcontent">

                <div class="tab-pane fade show active" id="gestion-clientes" role="tabpanel" aria-labelledby="gestion-clientes-tab">
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
                                        <table class="table table-sm table-striped table-bordered table-hover tablasBtnExport w-100">
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
                                                    <th style="width:120px;">Estado</th>
                                                    <th>Documento del responsable</th>
                                                    <th>Teléfono</th>
                                                    <th>Tipo</th>
                                                    <th>Nombre del responsable</th>
                                                    <th>Correo</th>
                                                </tr>
                                            </thead>
                                            <tbody class="text-sm text-center">
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
                                                        <td><?= $value['correo'] ?></td>
                                                    </tr>
                                                <?php endforeach ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div><!-- card-body-->
                            </div><!-- card-->
                        </div><!-- col-->
                    </div><!-- row-->
                </div>

                <div class="tab-pane fade " id="visitas" role="tabpanel" aria-labelledby="visitas-tab">

                    <div class="row">
                        <div class="col-12 col-sm-6 col-lg-12">
                            <div class="card card-info">
                                <div class="card-header">
                                    <ul class="nav nav-tabs card-header-tabs" id="custom-tabs-one-tab" role="tablist">

                                        <li class="nav-item ">
                                            <!-- TABS HORIZONTALES-->
                                            <a class="nav-link active" id="llamadas-tab" data-toggle="pill" href="#llamadas" role="tab" aria-controls="llamadas" aria-selected="true"><i class="fas fa-phone-alt"></i> Seguimiento llamadas</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="clientes-tab" data-toggle="pill" href="#clientes" role="tab" aria-controls="clientes" aria-selected="false"><i class="fas fa-history"></i> Seguimiento clientes</a>
                                        </li>

                                    </ul>
                                </div>


                                <div class="card-body">
                                    <div class="tab-content" id="custom-tabs-one-tabContent">

                                        <div class="tab-pane fade show active" id="llamadas" role="tabpanel" aria-labelledby="llamadas-tab">

                                            <button type="button" class="btn btn-success btn-md" data-toggle="modal" data-target="#modalLlamadas">
                                                <i class="fas fa-plus"></i> Agregar llamada
                                            </button>

                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-lg-12 col-sm-12 justify-content-center">
                                                        <div class="card card-outline ">
                                                            <div class="table-responsive">
                                                                <table id="" class="table table-sm table-striped table-bordered dt-responsive text-center table-hover  w-100">
                                                                    <thead class="text-nowrap">
                                                                        <th>Fecha</th>
                                                                        <th>Cliente</th>
                                                                        <th>Teléfono</th>
                                                                        <th>Contacto</th>
                                                                        <th>Fecha cita concretada</th>
                                                                        <th>Hora</th>
                                                                        <th>Nombre</th>
                                                                        <th>Telefono</th>
                                                                        <th>Observación</th>
                                                                    </thead>
                                                                    <tbody id="" class="text-nowrap">
                                                                        <td>07/02/2022</td>
                                                                        <td>Colegio filadelfia</td>
                                                                        <td>2485980</td>
                                                                        <td>Contacto</td>
                                                                        <td>29/02/2022</td>
                                                                        <td>3:30 pm</td>
                                                                        <td>Luis Rodriguez</td>
                                                                        <td>3219365448</td>
                                                                        <td>Observaciones</td>


                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>





                                        </div>

                                        <div class="tab-pane fade" id="clientes" role="tabpanel" aria-labelledby="clientes-tab">


                                            <button type="button" class="btn btn-success btn-md" data-toggle="modal" data-target="#SeguimientoClientes">
                                                <i class="fas fa-plus"></i> Agregar visita a cliente
                                            </button>

                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-lg-12 col-sm-12 justify-content-center">
                                                        <div class="card card-outline ">
                                                            <div class="table-responsive">
                                                                <table id="" class="table table-sm table-striped table-bordered dt-responsive text-center table-hover  w-100">
                                                                    <thead class="text-nowrap">
                                                                        <th>Fecha visita</th>
                                                                        <th>Razón social</th>
                                                                        <th>Contacto</th>
                                                                        <th># Celular - Teléfono</th>
                                                                        <th>Correo</th>
                                                                        <th>Tipo de vehículo</th>
                                                                        <th>Sector</th>
                                                                        <th>Promedio vehículos</th>
                                                                        <th>Tarifa promedio</th>
                                                                        <th>Proveedor</th>
                                                                        <th>Nivel de satisfación</th>
                                                                        <th>Tipifación</th>
                                                                        <th>Próximo contacto</th>
                                                                        <th>Observaciones</th>
                                                                    </thead>
                                                                    <tbody id="" class="text-nowrap">
                                                                        <td>07/02/2022</td>
                                                                        <td>Razón social</td>
                                                                        <td>Contacto</td>
                                                                        <td>3113937120</td>
                                                                        <td>Contacto@gmail.com</td>
                                                                        <td>Busetones</td>
                                                                        <td>Industria</td>
                                                                        <td>5</td>
                                                                        <td>400000</td>
                                                                        <td>Proveedor</td>
                                                                        <td>Bueno</td>
                                                                        <td>Cliente prospecto</td>
                                                                        <td>28/03/2022</td>
                                                                        <td>Observaciones</td>

                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>





                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>



                </div>
            </div>


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



                        </div><!-- col-1-->
                        <div class="col-6">

                            <div class="form-group">
                                <label class="text-sm">Documento</label>
                                <div class="input-group input-group-sm">
                                    <input class="form-control input-clientes" type="text" id="docum_empre" name="docum_empre" placeholder="Ingrese el documento de la empresa" maxlength="15" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-6">
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
                        </div>

                        <div class="col-6">

                            <div class="form-group">
                                <label class="text-sm">Teléfono</label>
                                <div class="input-group input-group-sm">
                                    <input class="form-control input-clientes" type="text" id="telclient" name="telclient" placeholder="Ingrese un teléfono" maxlength="10" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-6">

                            <div class="form-group">
                                <label class="text-sm">Dirección</label>
                                <div class="input-group input-group-sm">
                                    <input class="form-control input-clientes" type="text" id="dir_empre" name="dir_empre" placeholder="Dirección de la empresa" maxlength="100" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label class="text-sm">Teléfono 2</label>
                                <div class="input-group input-group-sm">
                                    <input class="form-control input-clientes" type="text" id="telclient2" name="telclient2" placeholder="Ingrese un segundo teléfono" maxlength="10">
                                </div>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label class="text-sm">Tipo de cliente</label>
                                <select class="form-control input-sm select2-single input-clientes" style="width: 99%" type="number" id="tipocliente" name="tipocliente">
                                    <option selected value="">-Seleccione el tipo de cliente-</option>
                                    <?php foreach ($tiposClientes as $key => $value) : ?>
                                        <option value="<?= $value['id'] ?>"><?= $value['tipo'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>




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
                        <div class="form-group text-center col-12 col-sm-6 col-lg-12">
                            <label class="text-sm">Correo electrónico</label>
                            <div class="input-group input-group-sm">
                                <input class="form-control input-clientes" type="email" id="correo" name="correo" placeholder="Ejemplo@gmail.com" maxlength="100" required>
                            </div>
                        </div>
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


<!-- MODAL SEGUIMIENTO CLIENTES -->
<div id="SeguimientoClientes" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h5 class="modal-title" id="my-modal-title">Nuevo seguimiento a cliente <i class="fas fa-user-clock"></i></h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form method="post" enctype="multipart/form-data" id="formularioclientes">
                <div class="modal-body">

                    <div class="row">
                        <div class="col col-12 col-sm-12 col-lg-4">
                            <div class="form-group text-center ">
                                <label><i>Fecha visita</i></label>
                                <input type="date" class="form-control">
                            </div>
                        </div>

                        <div class="col col-12 col-sm-12 col-lg-4">
                            <div class="form-group text-center ">
                                <label><i>Empresa</i></label>
                                <input type="text" class="form-control">
                            </div>
                        </div>


                        <div class="col col-12 col-sm-12 col-lg-4">
                            <div class="form-group text-center ">
                                <label><i>Sector</i></label>
                                <select id="" name="" class="form-control select2-single" type="number" style="width: 99%" required>
                                    <option selected value="">Seleccione un sector</option>
                                    <?php foreach ($tiposClientes as $key => $value) : ?>
                                        <option value="<?= $value['id'] ?>"><?= $value['tipo'] ?> </option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>


                        <div class="col col-12 col-sm-12 col-lg-4">
                            <div class="form-group text-center ">
                                <label><i>Contacto</i></label>
                                <input type="text" class="form-control">
                            </div>
                        </div>

                        <div class="col col-12 col-sm-12 col-lg-4">
                            <div class="form-group text-center ">
                                <label><i># Celular - Teléfono</i></label>
                                <input type="number" class="form-control">
                            </div>
                        </div>

                        <div class="col col-12 col-sm-12 col-lg-4">
                            <div class="form-group text-center ">
                                <label><i>Dirección</i></label>
                                <input type="number" class="form-control">
                            </div>
                        </div>

                        <div class="col col-12 col-sm-12 col-lg-4">
                            <div class="form-group text-center ">
                                <label><i>Correo</i></label>
                                <input type="email" class="form-control">
                            </div>
                        </div>

                        <div class="col col-12 col-sm-12 col-lg-4">
                            <div class="form-group text-center ">
                                <label><i>Tipo de vehículo</i></label>
                                <select id="" name="" class="form-control select2-single" type="number" style="width: 99%" required>
                                    <option selected value="">Seleccione un tipo vehículo</option>
                                    <?php foreach ($tipovehiculos as $key => $value) : ?>
                                        <option value="<?= $value['idtipovehiculo'] ?>"><?= $value['tipovehiculo'] ?> </option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>




                        <div class="col col-12 col-sm-12 col-lg-4">
                            <div class="form-group text-center ">
                                <label><i>Promedio vehículos</i></label>
                                <input type="text" class="form-control">
                            </div>
                        </div>

                        <div class="col col-12 col-sm-12 col-lg-4">
                            <div class="form-group text-center ">
                                <label><i>Tarifa promedio</i></label>
                                <input type="text" class="form-control">
                            </div>
                        </div>

                        <div class="col col-12 col-sm-12 col-lg-4">
                            <div class="form-group text-center ">
                                <label><i>Proveedor</i></label>
                                <input type="text" class="form-control">
                            </div>
                        </div>

                        <div class="col col-12 col-sm-12 col-lg-4">
                            <div class="form-group text-center ">
                                <label><i>Nivel de satisfación</i></label>
                                <input type="text" class="form-control">
                            </div>
                        </div>

                        <div class="col col-12 col-sm-12 col-lg-4">
                            <div class="form-group text-center ">
                                <label><i>Tipifación</i></label>
                                <input type="text" class="form-control">
                            </div>
                        </div>

                        <div class="col col-12 col-sm-12 col-lg-4">
                            <div class="form-group text-center ">
                                <label><i>Próximo contacto</i></label>
                                <input type="date" class="form-control">
                            </div>
                        </div>


                        <div class="col col-12 col-sm-12 col-lg-4">
                            <div class="form-group text-center ">
                                <label><i>Observaciones</i></label>
                                <textarea rows="3" cols="3" class="form-control form-control-sm" id="" name=""> </textarea>
                            </div>
                        </div>





                    </div>


                </div>


            </form>
            <div class="modal-footer">
                <button type="submit" form="Guardarprogramacion_form" class="btn btn-success">Guardar</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>

            </div>
        </div>
    </div>
</div>

<!-- MODAL SGUIMIENTO LLAMADAS -->
<div id="modalLlamadas" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h5 class="modal-title" id="my-modal-title">Nueva llamada <i class="fas fa-headset"></i></h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col col-12 col-sm-12 col-lg-4">
                        <div class="form-group text-center ">
                            <label><i>Fecha</i></label>
                            <input type="date" class="form-control">
                        </div>
                    </div>

                    <div class="col col-12 col-sm-12 col-lg-4">
                        <div class="form-group text-center ">
                            <label><i>Cliente</i></label>
                            <input type="text" class="form-control">
                        </div>
                    </div>

                    <div class="col col-12 col-sm-12 col-lg-4">
                        <div class="form-group text-center ">
                            <label><i>Teléfono</i></label>
                            <input type="text" class="form-control">
                        </div>
                    </div>


                    <div class="col col-12 col-sm-12 col-lg-4">
                        <div class="form-group text-center ">
                            <label><i>Contacto</i></label>
                            <input type="text" class="form-control">
                        </div>
                    </div>

                    <div class="col col-12 col-sm-12 col-lg-4">
                        <div class="form-group text-center ">
                            <label><i>Fecha cita concretada</i></label>
                            <input type="date" class="form-control">
                        </div>
                    </div>

                    <div class="col col-12 col-sm-12 col-lg-4">
                        <div class="form-group text-center ">
                            <label><i>Hora</i></label>
                            <input type="time" class="form-control">
                        </div>
                    </div>



                    <div class="col col-12 col-sm-12 col-lg-4">
                        <div class="form-group text-center ">
                            <label><i>Nombre</i></label>
                            <input type="text" class="form-control">

                        </div>
                    </div>


                    <div class="col col-12 col-sm-12 col-lg-4">
                        <div class="form-group text-center ">
                            <label><i>Teléfono</i></label>
                            <input type="date" class="form-control">
                        </div>
                    </div>

                    <div class="col col-12 col-sm-12 col-lg-4">
                        <div class="form-group text-center ">
                            <label><i>Observación</i></label>
                            <textarea rows="3" cols="3" class="form-control form-control-sm" id="" name=""> </textarea>
                        </div>
                    </div>








                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" form="Guardarprogramacion_form" class="btn btn-success">Guardar</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>