<?php

if (!validarPermiso('M_VEHICULAR', 'R')) {
    echo "<script> window.location = 'inicio'; </script>";
}

$Convenios = ControladorConvenios::ctrMostrar();
$DeparMunicipios = ControladorGH::ctrDeparMunicipios();


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
                            <a class="nav-link active h4" id="pills-empresas-tab" data-toggle="tab" href="#pills-empresas" role="tab" aria-controls="pills-empresas" aria-selected="true">Empresas</a>
                        </li>
                        <li class="nav-item border border-info rounded ml-2 mb-1 mb-md-0">
                            <a class="nav-link h4" id="pills-convenios-tab" data-toggle="tab" href="#pills-convenios" role="tab" aria-controls="pills-convenios" aria-selected="false">Convenios</a>
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
                <div class="tab-pane fade show active" id="pills-empresas" role="tabpanel" aria-labelledby="pills-empresas-tab">
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
                            <div class="card">
                                <div class="card-header bg-info"></div>
                                <div class="card-body">

                                    <div class="table-responsive">
                                        <table class="table table-sm table-striped table-bordered dt-responsive table-hover tablasBtnExport w-100">
                                            <thead class="thead-light text-sm text-center">
                                                <tr>
                                                    <th style="width:10px;">#</th>
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
                                                <?php foreach ($Convenios as $key => $value) : ?>
                                                    <tr>
                                                        <td><?= $value['idxc'] ?></td>
                                                        <td><?= $value['nit'] ?></td>
                                                        <td><?= $value['nombre'] ?></td>
                                                        <td><?= $value['direccion'] ?></td>
                                                        <td><?= $value['telefono1'] ?></td>
                                                        <td><?= $value['telefono2'] ?></td>
                                                        <td><?= $value['ciudad'] ?></td>
                                                        <td>
                                                            <div class="btn-group" role="group" aria-label="Button group">
                                                                <button class="btn btn-sm btn-warning btnEditarEmpresa" nit="<?= $value['nit'] ?>" data-toggle="modal" data-target="#EmpresasModal"><i class="fas fa-edit"></i></button>
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
                
                
                <div class="tab-pane fade" id="pills-convenios" role="tabpanel" aria-labelledby="pills-convenios-tab">
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
                            <div class="card">
                                <div class="card-header bg-info"></div>
                                <div class="card-body">

                                    <div class="table-responsive">
                                        <table class="table table-sm table-striped table-bordered dt-responsive table-hover tablasBtnExport w-100">
                                            <thead class="thead-light text-sm text-center text-nowrap">
                                                <tr>
                                                    <th>...</th>
                                                    <th style="width:10px;">#</th>
                                                    <th>NIT</th>
                                                    <th>Empresa contratante</th>
                                                    <th>NIT</th>
                                                    <th>Empresa contratista</th>
                                                    <th>Contrato a ejecutar</th>
                                                    <th>Sucursal</th>
                                                    <th>Tipo de vehículo</th>
                                                    <th>Placa</th>
                                                    <th>Interno</th>
                                                    <th>Fecha inicio del convenio</th>
                                                    <th>Fecha terminación del convenio</th>
                                                    <th>Estado en empresa</th>
                                                    <th>Fecha radicado ministerio</th>
                                                    <th>Número Radicado</th>
                                                    <th>Observación</th>
                                                </tr>
                                            </thead>
                                            <tbody class="text-sm">
                    
                                                    <tr>
                
                                                        <td>
                                                            <div class="btn-group" role="group" aria-label="Button group">
                                                                <button class="btn btn-sm btn-warning btnEditarConv" nit="<?= $value['nit'] ?>" data-toggle="modal" data-target="#ConvenioModal"><i class="fas fa-edit"></i></button>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                
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

<div class="modal fade" id="EmpresasModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <form method="post" enctype="multipart/form-data">
                <!-- INICIO DEL FORMULARIO -->

                <div class="modal-header bg-info">
                    <h5 class="modal-title" id="titulo-modal-empresas"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">

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
                            <input class="form-control input-convenio" type="text" id="nombre" name="nombre" placeholder="Ingresar nombre de convenio" maxlength="70" required>
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
                            <input class="form-control input-convenio" type="text" id="dirco" name="dirco" placeholder="Ingresar direccion" maxlength="80" required>
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
                            <input class="form-control input-convenio" type="text" id="telco" name="telco" placeholder="Ingresar telefono" maxlength="16" required>
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
                            <input class="form-control input-convenio" type="text" id="telco2" name="telco2" placeholder="telefono 2 / Opcional" maxlength="16">
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
                            <select class="form-control input-convenio select2-single" style="width: 92%" type="text" id="ciudadcon" name="ciudadcon" required>
                                <option selected value="">-Seleccione una ciudad-</option>
                                <?php foreach ($DeparMunicipios as $key => $value) : ?>
                                    <option value="<?= $value['idmunicipio'] ?>"><?= $value['DeparMunic'] ?></option>
                                <?php endforeach ?>
                            </select>
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
             <form method="post" enctype="multipart/form-data">
                <!-- INICIO DEL FORMULARIO -->

                <div class="modal-header bg-info">
                    <h5 class="modal-title" id="titulo-modal-convenios"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="row">
                    <!-- EMPRESA CONTRATANTE -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="text-sm"><i>Empresa contratante</i></label>
                                <div class="input-group input-group-sm">
                                    <select class="form-control select2-single select-clientes input-sm" id="listaempresas" style="width: 99%" name="listaclientes">
                                        <option value="" selected><b>-Lista de empresas-</b></option>
                                        <!-- <?php foreach ($clientes as $key => $value) : ?>
                                            <option value="<?= $value['idcliente'] ?>"><?= $value['clientexist'] ?></option>
                                        <?php endforeach ?> -->
                                    </select>
                                </div>
                            </div>
                        </div>


                        <!-- EMPRESA CONTRATISTA -->

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="text-sm"><i>Empresa contratista</i></label>
                                <div class="input-group input-group-sm">
                                    <select class="form-control select2-single select-clientes input-sm" id="listaempresas" style="width: 99%" name="listaclientes">
                                        <option value="" selected><b>-Lista de empresas-</b></option>
                                        <!-- <?php foreach ($clientes as $key => $value) : ?>
                                            <option value="<?= $value['idcliente'] ?>"><?= $value['clientexist'] ?></option>
                                        <?php endforeach ?> -->
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
                                    <input class="form-control input-clientes" type="text" id="tipo_contrato" name="tipo_contrato" placeholder="Ingrese el contrato a ejecutar" maxlength="45" required>
                                </div>
                            </div>
                        </div>    
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="text-sm">Sucursal</label>
                                <div class="input-group input-group-sm">
                                    <input class="form-control input-clientes" type="text" id="tipo_contrato" name="tipo_contrato" placeholder="Ingrese la sucursal" maxlength="45" required>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="my-4 bg-dark">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="test-sm">Tipo de vehículo</label>
                                <div class="input-group input-group-sm">
                                    <select id="listaempresas" class="form-control select2-single select-clientes input-sm"style="width: 99%" name="listaclientes">
                                    <option value="" selected><b>-Tipo de vehículo-</b></option>
                                        <!-- <?php foreach ($clientes as $key => $value) : ?>
                                            <option value="<?= $value['idcliente'] ?>"><?= $value['clientexist'] ?></option>
                                        <?php endforeach ?> -->
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="test-sm">Placa</label>
                                <div class="input-group input-group-sm">
                                    <select id="listaempresas" class="form-control select2-single select-clientes input-sm"style="width: 99%" name="listaclientes">
                                    <option value="" selected><b>-Placa-</b></option>
                                        <!-- <?php foreach ($clientes as $key => $value) : ?>
                                            <option value="<?= $value['idcliente'] ?>"><?= $value['clientexist'] ?></option>
                                        <?php endforeach ?> -->
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                        <label class="text-sm">Número interno</label>
                            <div class="input-group input-group-sm">
                                <input class="form-control input-clientes" type="text" id="tipo_contrato" name="tipo_contrato" placeholder="Ingrese el interno" maxlength="45" required>
                            </div>
                        </div>
                    </div>

                    <hr class="my-4 bg-dark">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="text-sm">Fecha inicio del convenio</label>
                                <div class="input-group input-group-sm">
                                    <input class="form-control" type="date" id="f_resuelve" name="f_resuelve" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="text-sm">Fecha terminación del convenio</label>
                                <div class="input-group input-group-sm">
                                    <input class="form-control" type="date" id="f_resuelve" name="f_resuelve" required>
                                </div>
                            </div>
                        </div>


                    </div>         
                    
                    <hr class="my-4 bg-dark">

                    <div class="row">
                        <div class="col-md-6">
                            <label class="test-sm">Estado en empresa</label>
                                <div class="input-group input-group-sm">
                                    <select id="listaempresas" class="form-control select2-single select-clientes input-sm"style="width: 99%" name="listaclientes">
                                    <option value="" selected><b>-Estado-</b></option>
                                    <option value=""><b>Firmado</b></option>
                                    <option value=""><b>Pendiente firma cartera</b></option>
                                    <option value=""><b>Pendiente firma ss</b></option>
                                    <option value=""><b>Pendiente firma doc</b></option>
                                    <option value=""><b>Devuelto a suc </b></option>
                                
                                    </select>
                                </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="text-sm">Fecha radicado ministerio</label>
                                <div class="input-group input-group-sm">
                                    <input class="form-control" type="date" id="f_resuelve" name="f_resuelve" required>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                        <label class="text-sm">Número radicado</label>
                            <div class="input-group input-group-sm">
                                <input class="form-control input-clientes" type="text" id="tipo_contrato" name="tipo_contrato" placeholder="Número radicado" maxlength="45" required>
                            </div>
                        </div>
                    </div>

                    <hr class="my-4 bg-dark">

                    <div class="form-group">
                        <label class="text-sm">Observaciones</label>
                            <div class="input-group input-group-sm">
                                <textarea class="form-control" type="text" id="porque" name="porque" placeholder="Escriba los motivos" style="min-height:70px"></textarea requiered>
                            </div>
                    </div>








                    
                    <!-- FIN DEL MODAL CONVENIOS -->
                </div>


                <div class="modal-footer bg-dark">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    <?php if (validarPermiso('M_VEHICULAR', 'U')) : ?>
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save"></i> Guardar</button>
                    <?php endif ?>
                </div>


             </form>
            
        </div>
    </div>
</div>