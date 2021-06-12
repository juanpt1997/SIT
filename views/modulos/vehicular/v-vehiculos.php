<?php
 
/* if(!array_search('CARGAR_OPCION',$_SESSION['opciones'])) {
    echo "<script> window.location = 'inicio'; </script>";
} */

$Propietarios = ControladorPropietarios::ctrMostrar();
$Sucursales = ControladorGH::ctrSucursales();
$tvehiculos = ControladorVehiculos::ctrMostrarTipoVehiculo();
$marca = ControladorVehiculos::ctrMostrarMarca();
$empresaconvenio = ControladorConvenios::ctrMostrar();

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark ">Vehiculos</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                        <li class="breadcrumb-item active">Vehiculos</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            
            <!--|||TABLA VEHICULOS|||-->

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-info"></div>
                        <div class="card-body">

                            <div class="row">
                                <div class="col">
                                    <!--BOTON NUEVO VEHICULO-->
                                    <button type="button" class="btn btn-success btn-lg btn-agregarVehiculo" data-toggle="modal" data-target="#VehiculosModal">

                                        <i class="fas fa-car-side"></i> Añadir Vehiculo
                                    </button>
                                </div><!-- col -->
                            </div> <!-- /.row -->

                                <div class="table-responsive">
                                    <table class="table table-sm table-striped table-bordered dt-responsive table-hover tablasBtnExport w-100">
                                        <thead class="thead-light text-sm text-center">
                                            <tr>
                                                <th style="width:10px;">#</th>
                                                <th>Placa</th>
                                                <th>Nro. Interno</th>
                                                <th>Nombre</th>
                                                <th>Documento</th>
                                                <th>Sucursal</th>
                                                <th>Fecha vinculacion</th>
                                                <th>Chasis</th>
                                                <th>Nro. Motor</th>
                                                <th>Modelo</th>
                                                <th>Color</th>
                                                <th>Capacidad</th>
                                                <th>Cilindraje</th>
                                                <th>Tipo vinculacion</th>
                                                <th>Fecha importación</th>
                                                <th>Potencia</th>
                                                <th>Limitacion propiedad</th>
                                                <th>Tipo de vehiculo</th>
                                                <th>Marca</th>
                                                <th>Fecha matricula</th>
                                                <th>Activo</th>
                                                <th>Empresa Convenio</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td>
                                                    <div class="btn-group" role="group" aria-label="Button group">
                                                        <button class="btn btn-sm btn-warning btnEditarVehiculo" data-toggle="modal" data-target="#VehiculosModal"><i class="fas fa-edit"></i></button>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>

                                    </table>

                                </div>
                        </div>
                        <div class="card-footer bg-dark"></div>
                    </div>
                </div><!-- col -->
            </div> <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div><!-- /.content -->  
</div><!-- /.content-wrapper -->

<!--MODALS-->

<div class="modal fade" id="VehiculosModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">

            <form id="vehiculos_form" method="post" enctype="multipart/form-data">
                
                <div class="modal-header bg-info">
                    <!--<h5 class="modal-title d-none" id="exampleModalLabel">Agregar vehiculo</h5>-->
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">

                    <div class="card card-secondary card-tabs">
                        <div class="card-header p-0 pt-1">
                            <ul class="nav nav-tabs" id="custom-tabs-two-tab" role="tablist">

                                <li class="pt-2 px-3"><h3 class="card-title">Información general</h3></li>
                                
                                <li class="nav-item">
                                    <a class="nav-link active" id="datos_vehiculos" data-toggle="pill" href="#custom-tabs-two-home" role="tab" aria-controls="custom-tabs-two-home" aria-selected="true">Datos vehículos</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="custom-tabs-two-profile-tab" data-toggle="pill" href="#custom-tabs-two-profile" role="tab" aria-controls="custom-tabs-two-profile" aria-selected="false">Información técnica</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="custom-tabs-two-messages-tab" data-toggle="pill" href="#custom-tabs-two-messages" role="tab" aria-controls="custom-tabs-two-messages" aria-selected="false">Características</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="custom-tabs-two-settings-tab" data-toggle="pill" href="#custom-tabs-two-settings" role="tab" aria-controls="custom-tabs-two-settings" aria-selected="false">Imágenes</a>
                                </li>
                            </ul>
                        </div>

                        <div class="card-body">
                            <div class="tab-content" id="custom-tabs-two-tabContent">
                                <div class="tab-pane fade show active" id="custom-tabs-two-home" role="tabpanel" aria-labelledby="custom-tabs-two-home-tab">

                                    <div class="row">
                                        <div class="col-md-6">
                                        
                                            <div class="form-group">
                                                <label>Placa</label>
                                                <div class="input-group">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">
                                                            <i class="fas fa-ad"></i>
                                                        </span>
                                                    </div>
                                                        <input class="form-control input-propietario" type="text" id="placa" name="placa" placeholder="Ingresar placa" required>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label>Nro. Interno afiliado</label>
                                                <div class="input-group">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">
                                                            <i class="fas fa-hashtag"></i>
                                                        </span>
                                                    </div>
                                                        <input class="form-control input-propietario" type="text" id="num_afiliado" name="num_afiliado" placeholder="Ingresar número interno afiliado" required>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label>Tipo de vinculación</label>
                                                <div class="input-group">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">
                                                            <i class="fas fa-clipboard-list"></i>
                                                        </span>
                                                    </div>
                                                        <select class="form-control input-lg input-propietario" type="text" id="t_vinculacion" name="t_vinculacion" required>
                                                            <option>-Seleccione una vinculación-</option>
                                                            <option>Propio</option>
                                                            <option>Propio afiliado</option>
                                                            <option>Convenio</option>
                                                            <option>Propio tercero</option>
                                                            <option>Administrado</option>
                                                            <option>Afiliado</option>
                                                            <option>Propio vendido</option>
                                                        </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label>Fecha de vinculación</label>
                                                <div class="input-group">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">
                                                            <i class="far fa-calendar-alt"></i>
                                                        </span>
                                                    </div>
                                                        <input class="form-control input-propietario" type="date" id="fecha_vin" name="fecha_vin" placeholder="Seleccione una fecha" required>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="col-md-6">

                                            <div class="form-group">
                                                <label>Nombre</label>
                                                <div class="input-group">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">
                                                            <i class="fas fa-address-card"></i>
                                                        </span>
                                                    </div>
                                                        <input class="form-control input-propietario" type="text" id="v_nombre" name="v_nombre" placeholder="Ingresar nombre" required>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label>Documento</label>
                                                <div class="input-group">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">
                                                            <i class="fas fa-address-card"></i>
                                                        </span>
                                                    </div>
                                                        <input class="form-control input-propietario" type="text" id="v_documento" name="v_documento" placeholder="Ingresar documento" required>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label>Sucursal</label>
                                                <div class="input-group">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">
                                                            <i class="fas fa-map-marker-alt"></i>
                                                        </span>
                                                    </div>
                                                        <select class="form-control input-lg input-propietario" type="text" id="v_sucursal" name="v_sucursal" required>
                                                                <option>-Seleccione una sucursal-</option>
                                                            <?php foreach ($Sucursales as $key => $value) : ?>
                                                                <option value="<?= $value['sucursal'] ?>"><?= $value['sucursal'] ?></option>
                                                            <?php endforeach ?>
                                                        </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label>Conductor</label>
                                                <div class="input-group">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">
                                                            <i class="fas fa-user"></i>
                                                        </span>
                                                    </div>
                                                        <input class="form-control input-propietario" type="text" id="v_conductor" name="v_conductor" required>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="custom-tabs-two-profile" role="tabpanel" aria-labelledby="custom-tabs-two-profile-tab">

                                    <div class="row">
                                        <div class="col-md-6">
                                        
                                            <div class="form-group">
                                                <label>Número del motor</label>
                                                <div class="input-group">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">
                                                            <i class="fas fa-hashtag"></i>
                                                        </span>
                                                    </div>
                                                        <input class="form-control input-propietario" type="text" id="num_motor" name="num_motor" placeholder="Ingresar número del motor" required>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label>Chasis</label>
                                                <div class="input-group">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">
                                                            <i class="fas fa-car-alt"></i>
                                                        </span>
                                                    </div>
                                                        <input class="form-control input-propietario" type="text" id="v_chasis" name="v_chasis" placeholder="Ingresar chasis" required>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label>Modelo del vehículo</label>
                                                <div class="input-group">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">
                                                           <i class="fas fa-car-alt"></i>
                                                        </span>
                                                    </div>
                                                        <input class="form-control input-propietario" type="text" id="v_modelo" name="v_modelo" placeholder="Ingresar modelo del vehículo" required>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label>Color</label>
                                                <div class="input-group">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">
                                                            <i class="fas fa-palette"></i>
                                                        </span>
                                                    </div>
                                                        <input class="form-control input-propietario" type="text" id="v_color" name="v_color" placeholder="Ingresar color del vehículo" required>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label>Capacidad</label>
                                                <div class="input-group">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">
                                                            <i class="fas fa-weight"></i>  
                                                        </span>
                                                    </div>
                                                        <input class="form-control input-propietario" type="text" id="v_capacidad" name="v_capacidad" placeholder="Ingresar capacidad del vehículo" required>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="col-md-6">

                                            <div class="form-group">
                                                <label>Cilindraje</label>
                                                <div class="input-group">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">
                                                            <i class="fas fa-tachometer-alt"></i>
                                                        </span>
                                                    </div>
                                                        <input class="form-control input-propietario" type="text" id="v_cilindraje" name="v_cilindraje" placeholder="Ingresar cilindraje del vehículo" required>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label>Tipo de vehículo</label>
                                                <div class="input-group">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">
                                                            <i class="fas fa-car-alt"></i>
                                                        </span>
                                                    </div>
                                                        <select class="form-control input-lg input-propietario" type="text" id="v_tipov" name="v_tipov" required>
                                                            <option>-Seleccione un tipo-</option>
                                                            <?php foreach ($tvehiculos as $key => $value) : ?>
                                                                <option><?= $value['vehiculo'] ?></option>
                                                            <?php endforeach ?>
                                                        </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label>Marca</label>
                                                <div class="input-group">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">
                                                            <i class="fas fa-car-alt"></i>
                                                        </span>
                                                    </div>
                                                        <select class="form-control input-lg input-propietario" type="text" id="v_marca" name="v_marca" required>
                                                            <option>-Seleccione una marca-</option>
                                                            <?php foreach ($marca as $key => $value) : ?>
                                                                <option><?= $value['marca'] ?></option>
                                                            <?php endforeach ?>
                                                        </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label>Carrocería</label>
                                                <div class="input-group">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">
                                                            <i class="fas fa-car-alt"></i>
                                                        </span>
                                                    </div>
                                                        <input class="form-control input-propietario" type="text" id="v_carroceria" name="v_carroceria" placeholder="Ingresar el tipo de carrecoria" required>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label>Potencia (hp)</label>
                                                <div class="input-group">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">
                                                            <i class="fas fa-tachometer-alt"></i>
                                                        </span>
                                                    </div>
                                                        <input class="form-control input-propietario" type="text" id="v_potencia" name="v_potencia" placeholder="Ingresar potencia  " required>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="custom-tabs-two-messages" role="tabpanel" aria-labelledby="custom-tabs-two-messages-tab">


                                    <div class="row">
                                       <div class="col-md-6">

                                                <div class="form-group">
                                                    <label>Fecha de importanción</label>
                                                    <div class="input-group">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">
                                                                <i class="far fa-calendar-alt"></i>
                                                            </span>
                                                        </div>
                                                            <input class="form-control input-propietario" type="date" id="v_fecha_imp" name="v_fecha_imp" placeholder="Ingresar fecha de importación" required>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label>Limitación</label>
                                                    <div class="input-group">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">
                                                               <i class="fas fa-file-alt"></i>
                                                            </span>
                                                        </div>
                                                            <input class="form-control input-propietario" type="text" id="v_limitacion" name="v_limitacion" placeholder="Ingresar limitación" required>
                                                            
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label>Estado</label>
                                                    <div class="input-group">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">
                                                                <i class="fas fa-check-circle"></i>
                                                            </span>
                                                        </div>
                                                            <select class="form-control input-lg input-propietario" type="text" id="v_estado" name="v_estado" required>
                                                                <option>-Seleccione un estado-</option>
                                                                <option>Activo</option>
                                                                <option>Inactivo</option>
                                                                <option>Desvinculado</option>
                                                            </select>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label>Empresa convenio</label>
                                                    <div class="input-group">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">
                                                                <i class="fas fa-building"></i>
                                                            </span>
                                                        </div>
                                                            <select class="form-control input-lg input-propietario" type="text" id="v_em_convenio" name="v_em_convenio" required>
                                                                    <option>-Seleccione una empresa-</option>
                                                                <?php foreach ($empresaconvenio as $key => $value) : ?>
                                                                    <option><?= $value['nombre'] ?></option>
                                                                <?php endforeach ?>
                                                            </select>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label>Declaración imp.</label>
                                                    <div class="input-group">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">
                                                                <i class="fas fa-file-alt"></i>
                                                            </span>
                                                        </div>
                                                            <input class="form-control input-propietario" type="text" id="v_declaracion" name="v_declaracion" placeholder="Ingresar declaracion" required>
                                                            
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label>Fecha matrícula</label>
                                                    <div class="input-group">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">
                                                                <i class="far fa-calendar-alt"></i>
                                                            </span>
                                                        </div>
                                                            <input class="form-control input-propietario" type="date" id="v_fmatricula" name="v_fmatricula" placeholder="Ingresar fecha de matrícula" required>
                                                            
                                                    </div>
                                                </div>
                                        </div>

                                       <div class="col-md-6">

                                            <div class="form-group">
                                                <label>Fecha de expedición</label>
                                                    <div class="input-group">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">
                                                                <i class="far fa-calendar-alt"></i>
                                                            </span>
                                                        </div>
                                                            <input class="form-control input-propietario" type="date" id="v_fexpedicion" name="v_fexpedicion" placeholder="Ingresar fecha de expedición" required>
                                                            
                                                    </div>
                                            </div>

                                            <div class="form-group">
                                                    <label>Transito</label>
                                                    <div class="input-group">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">
                                                                <i class="fas fa-file-alt"></i>
                                                            </span>
                                                        </div>
                                                            <input class="form-control input-propietario" type="text" id="v_transito" name="v_transito" placeholder="Ingresar transito" required>
                                                            
                                                    </div>
                                            </div>

                                            <div class="form-group">
                                                <label>Fecha convenio</label>
                                                    <div class="input-group">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">
                                                                <i class="far fa-calendar-alt"></i>
                                                            </span>
                                                        </div>
                                                            <input class="form-control input-propietario" type="date" id="v_fconvenio" name="v_fconvenio" placeholder="Ingresar fecha de convenio" required>
                                                            
                                                    </div>
                                            </div>

                                            <div class="form-group">
                                                    <label>Clave APP</label>
                                                    <div class="input-group">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">
                                                                <i class="fas fa-key"></i>
                                                            </span>
                                                        </div>
                                                            <input class="form-control input-propietario" type="text" id="v_claveapp" name="v_claveapp" placeholder="Ingresar clave" required>
                                                            
                                                    </div>
                                            </div>

                                            <div class="form-group">
                                                <label>Fecha de desvinculación</label>
                                                    <div class="input-group">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">
                                                                <i class="far fa-calendar-alt"></i>
                                                            </span>
                                                        </div>
                                                            <input class="form-control input-propietario" type="date" id="v_fdesvinculacion" name="v_fdesvinculacion" placeholder="Ingresar fecha de desvinculación" required>
                                                            
                                                    </div>
                                            </div>

                                            <div class="form-group">
                                                    <label>Observaciones</label>
                                                    <div class="input-group">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">
                                                                <i class="fas fa-comment"></i>
                                                            </span>
                                                        </div>
                                                            <input class="form-control input-propietario" type="text" id="v_observaciones" name="v_observaciones" placeholder="Escriba una observación">
                                                            
                                                    </div>
                                            </div>

                                       </div>
                                    </div>
                                </div>
                                
                                <div class="tab-pane fade" id="custom-tabs-two-settings" role="tabpanel" aria-labelledby="custom-tabs-two-settings-tab">

                                    <div class="row">
                                        <div class="col-md-5">

                                            <div class="form-group">
                                                <label>Fotos del vehículo</label>
                                                    <div class="input-group">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">
                                                                <i class="fas fa-camera-retro"></i>
                                                            </span>
                                                        </div>
                                                            <input class="form-control input-propietario" type="file" id="v_foto" name="v_foto" required multiple accept="image/*">
                                               
                                                    </div>
                                            </div>

                                            <div class="form-group">
                                                <label>Tarjeta de propiedad</label>
                                                    <div class="input-group">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">
                                                                <i class="fas fa-camera-retro"></i>
                                                            </span>
                                                        </div>
                                                            <input class="form-control input-propietario" type="file" id="v_fotopro" name="v_fotopro" required multiple accept="image/*">
                                               
                                                    </div>
                                            </div>

                                        <div class="col-md-7">
                                            <p>
                                                <img id="imagenPrevisualizacion_fotos">
                                            </p>

                                            <p>
                                                <img id="imagenPrevisualizacion_TarjetaPro">
                                            </p> 
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card card-secondary card-tabs">
                        <div class="card-header p-0 pt-1">
                            <ul class="nav nav-tabs" id="custom-tabs-two-tab" role="tablist">

                                <li class="pt-2 px-3"><h3 class="card-title">Detalles</h3></li>

                                <li class="nav-item">
                                    <a class="nav-link active" id="datos_vehiculos" data-toggle="pill" role="tab" aria-controls="custom-tabs-two-home" aria-selected="true">Visualización</a>
                                </li>
                            </ul>
                        </div>

                        <div class="card-body">
                            <div class="tab-content" id="custom-tabs-two-tabContent">
                                <div class="tab-pane fade show active" id="custom-tabs-two-home" role="tabpanel" aria-labelledby="custom-tabs-two-home-tab">

                                    <div class="card">
                                        <div class="card-body">
                                            <label>PROPIETARIOS</label>


                                                <div class="table-responsive">
                                                    <table class="table table-sm table-striped table-bordered dt-responsive table-hover tablas w-100">
                                                        <thead class="thead-light text-sm text-center">
                                                            <tr>
                                                                <th style="width:10px;">#</th>
                                                                <th>Nombre</th>
                                                                <th>Tipo</th>
                                                                <th>Documento</th>
                                                                <th>EMAIL</th>
                                                                <th>Telefono</th>
                                                                <th>Direccion</th>
                                                                <th>Ciudad</th>
                                                                <th>Acciones</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php foreach ($Propietarios as $key => $value) : ?>
                                                            <tr>
                                                                <td><?= $value['idxp'] ?></td>
                                                                <td><?= $value['nombre'] ?></td>
                                                                <td><?= $value['tipodoc'] ?></td>
                                                                <td><?= $value['documento'] ?></td>
                                                                <td><?= $value['email'] ?></td>
                                                                <td><?= $value['telef'] ?></td>
                                                                <td><?= $value['direccion'] ?></td>
                                                                <td><?= $value['ciudad'] ?></td>
                                                                <td> 
                                                                    <div class="btn-group" role="group" aria-label="Button group">
                                                                        <button class="btn btn-sm btn-warning btnEditarVehiculo" data-toggle="modal" data-target="#VehiculosModal"><i class="fas fa-edit"></i></button>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        <?php endforeach ?>
                                                        </tbody>
                                                    </table>
                                                </div>

                                                <br>
                                                <br>

                                                <label>CONDUCTORES</label>


                                                <div class="table-responsive">
                                                    <table class="table table-sm table-striped table-bordered dt-responsive table-hover tablas w-100">
                                                        <thead class="thead-light text-sm text-center">
                                                            <tr>
                                                                <th style="width:10px;">#</th>
                                                                <th>Nombre</th>
                                                                <th>Tipo</th>
                                                                <th>Documento</th>
                                                                <th>EMAIL</th>
                                                                <th>Telefono</th>
                                                                <th>Direccion</th>
                                                                <th>Ciudad</th>
                                                                <th>Acciones</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td>
                                                                    <div class="btn-group" role="group" aria-label="Button group">
                                                                        <button class="btn btn-sm btn-warning btnEditarVehiculo" data-toggle="modal" data-target="#VehiculosModal"><i class="fas fa-edit"></i></button>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>

                                                <br>
                                                <br>

                                                <label>DOCUMENTOS</label>


                                                <div class="table-responsive">
                                                    <table class="table table-sm table-striped table-bordered dt-responsive table-hover tablas w-100">
                                                        <thead class="thead-light text-sm text-center">
                                                            <tr>
                                                                <th style="width:10px;">#</th>
                                                                <th>Nombre</th>
                                                                <th>Tipo</th>
                                                                <th>Documento</th>
                                                                <th>EMAIL</th>
                                                                <th>Telefono</th>
                                                                <th>Direccion</th>
                                                                <th>Ciudad</th>
                                                                <th>Acciones</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td>
                                                                    <div class="btn-group" role="group" aria-label="Button group">
                                                                        <button class="btn btn-sm btn-warning btnEditarVehiculo" data-toggle="modal" data-target="#VehiculosModal"><i class="fas fa-edit"></i></button>
                                                                    </div>
                                                                </td>
                                                            </tr>
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

                <div class="modal-footer bg-dark">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save"></i>
                        Guardar
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
