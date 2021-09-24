<?php

if (!validarModulo('M_GESTION_HUMANA')) {
    echo "<script> window.location = '" . URL_APP . "'; </script>";
}


//$Personal = ControladorGH::ctrListaPersonal();
$DeparMunicipios = ControladorGH::ctrDeparMunicipios();
$Cargos = ControladorGH::ctrCargos();
$Procesos = ControladorGH::ctrProcesos();
$ListadoEPS = ControladorGH::ctrListadoEPS();
$ListadoAFP = ControladorGH::ctrListadoAFP();
$ListadoARL = ControladorGH::ctrListadoARL();
$Sucursales = ControladorGH::ctrSucursales();
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
                    <h1 class="m-0 text-dark "><b><i>Personal</i></b></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                        <li class="breadcrumb-item active">Gestión humana</li>
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
            <div id="ghTabs"></div>


            <!-- ===================================================
                BOTON PARA AGREGAR NUEVO EMPLEADO
            =================================================== -->
            <div class="row d-none">
                <div class="col">
                    <button type="button" class="btn btn-primary btn-agregarPersonal" data-toggle="modal" data-target="#PersonalModal">
                        <i class="fas fa-user-plus"></i> Nuevo
                    </button>
                </div>
            </div>

            <!-- ===================== 
              TABLA EMPLEADOS
            ========================= -->
            <div class="row mt-2">
                <div class="col-12">
                    <div id="spinnerTablaPersonal" class="spinner-border" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                    <div class="table-responsive text-center">
                        <table id="tblPersonal" class="table table-sm text-sm table-light table-striped table-bordered tablas w-100">
                            <thead class="text-capitalize">
                                <tr>
                                    <th style="width:90px;">Id</th>
                                    <th>Foto</th>
                                    <th>Nombre</th>
                                    <th>Documento</th>
                                    <th>Dirección</th>
                                    <th>Telefono 1</th>
                                    <th>Telefono 2</th>
                                    <th>Correo</th>
                                    <th>Tipo sangre</th>
                                    <th>Activo</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody id="tbodyPersonal">

                            </tbody>
                        </table>
                    </div>
                </div><!-- col -->


            </div> <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- ===================================================
    MODALS
=================================================== -->
<div id="PersonalModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title font-weight-bold" id="titulo-modal-personal"></h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <ul class="nav nav-tabs navbar-light" id="myTab" role="tablist">
                    <!-- ===================================================
                        PRIMER TAB
                    =================================================== -->
                    <li class="nav-item">
                        <a class="nav-link active font-weight-bold" id="personal-tab" data-toggle="tab" href="#personal" role="tab" aria-controls="personal" aria-selected="true">Personal</a>
                    </li>

                    <!-- ===================================================
                        SEGUNDO TAB
                    =================================================== -->
                    <li class="nav-item">
                        <a class="nav-link font-weight-bold" id="contratos-tab" data-toggle="tab" href="#contratos" role="tab" aria-controls="contratos" aria-selected="false">Contratos y prórrogas</a>
                    </li>

                    <!-- ===================================================
                        TERCER TAB
                    =================================================== -->
                    <li class="nav-item">
                        <a class="nav-link font-weight-bold" id="hijos-tab" data-toggle="tab" href="#hijos" role="tab" aria-controls="hijos" aria-selected="false">Hijos</a>
                    </li>

                    <!-- ===================================================
                        CUARTO TAB
                    =================================================== -->
                    <li class="nav-item">
                        <a class="nav-link font-weight-bold" id="licencias-tab" data-toggle="tab" href="#licencias" role="tab" aria-controls="licencias" aria-selected="false">Licencias de conducción</a>
                    </li>

                    <!-- ===================================================
                        QUINTO TAB
                    =================================================== -->
                    <li class="nav-item">
                        <a class="nav-link font-weight-bold" id="examenes-tab" data-toggle="tab" href="#examenes" role="tab" aria-controls="examenes" aria-selected="false">Exámenes médicos</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <!-- ===================================================
                        CONTENIDO PRIMER TAB CON LOS DATOS GENERALES DEL EMPLEADO
                    =================================================== -->
                    <div class="tab-pane fade show active" id="personal" role="tabpanel" aria-labelledby="personal-tab">
                        <form class="formulario" id="frmPersonal" method="post" enctype="multipart/form-data">
                            <div class="row mt-4">
                                <!-- ===================================================
                                    ID Empleado
                                =================================================== -->
                                <input type="hidden" name="idPersonal" id="idPersonal" value="">

                                <!-- ===================================================
                                        Consentimiento Informado
                                =================================================== -->
                                <div class="col-12 col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="exampleInput1">Consentimiento Informado *</label>
                                        <div class="form-group clearfix">
                                            <div class="icheck-primary d-inline">
                                                <input type="radio" class="consentimiento_informado" id="consentInform1" name="consentimiento_informado" checked value="S">
                                                <label class="font-weight-normal" for="consentInform1">Si
                                                </label>
                                            </div>
                                            <div class="icheck-primary d-inline">
                                                <input type="radio" class="consentimiento_informado" id="consentInform2" name="consentimiento_informado" value="N">
                                                <label class="font-weight-normal" for="consentInform2">No
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <!-- ===================================================
                                    Nombre Completo
                                =================================================== -->
                                <div class="col-12 col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="exampleInput1">Nombre Completo *</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                                            </div>
                                            <input type="text" class="form-control" name="Nombre" id="Nombre" maxlength="100" required>
                                        </div>
                                        <!-- /.input group -->
                                    </div>
                                </div>

                                <!-- ===================================================
                                Tipo Documento
                                =================================================== -->
                                <div class="col-12 col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="exampleInput1">Tipo Documento *</label>
                                        <div class="form-group clearfix">
                                            <div class="icheck-primary d-inline">
                                                <input type="radio" class="tipo_doc" id="tipoDoc1" name="tipo_doc" value="CC" required>
                                                <label class="font-weight-normal" for="tipoDoc1">CC
                                                </label>
                                            </div>
                                            <div class="icheck-primary d-inline">
                                                <input type="radio" class="tipo_doc" id="tipoDoc2" name="tipo_doc" value="CE">
                                                <label class="font-weight-normal" for="tipoDoc2">CE
                                                </label>
                                            </div>
                                            <div class="icheck-primary d-inline">
                                                <input type="radio" class="tipo_doc" id="tipoDoc3" name="tipo_doc" value="NIT">
                                                <label class="font-weight-normal" for="tipoDoc3">NIT
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- ===================================================
                                    Documento
                                =================================================== -->
                                <div class="col-12 col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="exampleInput1">Documento *</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                                            </div>
                                            <input type="text" class="form-control" name="Documento" id="Documento" maxlength="20" required>
                                        </div>
                                        <!-- /.input group -->
                                    </div>
                                </div>

                                <!-- ===================================================
                                    Lugar de Expedición
                                =================================================== -->
                                <div class="col-12 col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="exampleInput1">Lugar de Expedición *</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend d-none d-sm-block d-md-none d-xl-block" style="width: 10%;">
                                                <span class="input-group-text" style="height: 100%;"><i class="fas fa-map-marker-alt"></i></span>
                                            </div>
                                            <select id="lugar_expedicion" class="form-control select2-single" style="width: 90%" name="lugar_expedicion" required>
                                                <option value="" selected>DEPARTAMENTO - MUNICIPIO</option>
                                                <?php foreach ($DeparMunicipios as $key => $value) : ?>
                                                    <option value="<?= $value['idmunicipio'] ?>"><?= $value['DeparMunic'] ?></option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                        <!-- /.input group -->
                                    </div>
                                </div>

                                <!-- ===================================================
                                    Fecha de Nacimiento
                                =================================================== -->
                                <div class="col-12 col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="exampleInput1">Fecha de Nacimiento *</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                            </div>
                                            <input type="date" class="form-control" name="fecha_nacimiento" id="fecha_nacimiento" max="<?php echo date('Y-m-d', strtotime(date("Y-m-d"))); ?>" required>
                                        </div>
                                        <!-- /.input group -->
                                    </div>
                                </div>

                                <!-- ===================================================
                                    Lugar de Nacimiento
                                =================================================== -->
                                <div class="col-12 col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="exampleInput1">Lugar de Nacimiento *</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend d-none d-sm-block d-md-none d-xl-block" style="width: 10%;">
                                                <span class="input-group-text" style="height: 100%;"><i class="fas fa-map-marker-alt"></i></span>
                                            </div>
                                            <select id="lugar_nacimiento" class="form-control select2-single" style="width: 90%" name="lugar_nacimiento" required>
                                                <option value="" selected>DEPARTAMENTO - MUNICIPIO</option>
                                                <?php foreach ($DeparMunicipios as $key => $value) : ?>
                                                    <option value="<?= $value['idmunicipio'] ?>"><?= $value['DeparMunic'] ?></option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                        <!-- /.input group -->
                                    </div>
                                </div>

                                <!-- ===================================================
                                    Edad
                                =================================================== -->
                                <div class="col-12 col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="exampleInput1">Edad *</label>
                                        <input type="text" class="form-control" name="edad" id="edad" maxlength="10" required>
                                    </div>
                                </div>

                                <!-- ===================================================
                                    Lugar de Residencia
                                =================================================== -->
                                <div class="col-12 col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="exampleInput1">Lugar de Residencia *</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend d-none d-sm-block d-md-none d-xl-block" style="width: 10%;">
                                                <span class="input-group-text" style="height: 100%;"><i class="fas fa-map-marker-alt"></i></span>
                                            </div>
                                            <select id="lugar_residencia" class="form-control select2-single" style="width: 90%" name="lugar_residencia" required>
                                                <option value="" selected>DEPARTAMENTO - MUNICIPIO</option>
                                                <?php foreach ($DeparMunicipios as $key => $value) : ?>
                                                    <option value="<?= $value['idmunicipio'] ?>"><?= $value['DeparMunic'] ?></option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                        <!-- /.input group -->
                                    </div>
                                </div>

                                <!-- ===================================================
                                    Dirección
                                =================================================== -->
                                <div class="col-12 col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="exampleInput1">Dirección *</label>
                                        <input type="text" class="form-control" name="direccion" id="direccion" maxlength="100" required>
                                    </div>
                                </div>

                                <!-- ===================================================
                                    Barrio
                                =================================================== -->
                                <div class="col-12 col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="exampleInput1">Barrio *</label>
                                        <input type="text" class="form-control" name="barrio" id="barrio" maxlength="45" required>
                                    </div>
                                </div>

                                <!-- ===================================================
                                    Estrato Social
                                =================================================== -->
                                <div class="col-12 col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="exampleInput1">Estrato Social *</label>
                                        <select id="estrato_social" class="form-control" name="estrato_social" required>
                                            <option value="" selected>Seleccione una opción</option>
                                            <option>1</option>
                                            <option>2</option>
                                            <option>3</option>
                                            <option>4</option>
                                            <option>5</option>
                                            <option>6</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- ===================================================
                                    Tipo de Vivienda
                                =================================================== -->
                                <div class="col-12 col-md-6 col-lg-4">
                                    <div class="form-group d-inline">
                                        <label for="exampleInput1">Tipo de Vivienda *</label>
                                        <div class="form-group clearfix">
                                            <div class="icheck-primary d-inline">
                                                <input class="tipo_vivienda" type="radio" id="radioPrimary1" name="tipo_vivienda" value="Propia" required>
                                                <label class="font-weight-normal" for="radioPrimary1">Propia
                                                </label>
                                            </div>
                                            <div class="icheck-primary d-inline">
                                                <input class="tipo_vivienda" type="radio" id="radioPrimary2" name="tipo_vivienda" value="Arrendada">
                                                <label class="font-weight-normal" for="radioPrimary2">Arrendada
                                                </label>
                                            </div>
                                            <div class="icheck-primary d-inline">
                                                <input class="tipo_vivienda" type="radio" id="radioPrimary3" name="tipo_vivienda" value="Multifamiliar">
                                                <label class="font-weight-normal" for="radioPrimary3">Multifamiliar
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- ===================================================
                                    Teléfono 1
                                =================================================== -->
                                <div class="col-12 col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="exampleInput1">Teléfono 1 *</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-phone-alt"></i></span>
                                            </div>
                                            <input type="text" class="form-control" name="telefono1" id="telefono1" maxlength="10" required>
                                        </div>
                                        <!-- /.input group -->
                                    </div>
                                </div>

                                <!-- ===================================================
                                    Teléfono 2
                                =================================================== -->
                                <div class="col-12 col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="exampleInput1">Teléfono 2</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-phone-alt"></i></span>
                                            </div>
                                            <input type="text" class="form-control" name="telefono2" id="telefono2" maxlength="10">
                                        </div>
                                        <!-- /.input group -->
                                    </div>
                                </div>

                                <!-- ===================================================
                                    Estado Civil
                                =================================================== -->
                                <div class="col-12 col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="exampleInput1">Estado Civil *</label>
                                        <select id="estado_civil" class="form-control" name="estado_civil" required>
                                            <option value="" selected>Seleccione una opción</option>
                                            <option>Soltero</option>
                                            <option>Casado</option>
                                            <option>Union libre</option>
                                            <option>Otro</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- ===================================================
                                    Género
                                =================================================== -->
                                <div class="col-12 col-md-6 col-lg-4">
                                    <div class="form-group d-inline">
                                        <label for="exampleInput1">Género *</label>
                                        <div class="form-group clearfix">
                                            <div class="icheck-primary d-inline">
                                                <input class="genero" type="radio" id="genero1" name="genero" value="Masculino" required>
                                                <label class="font-weight-normal" for="genero1">Masculino
                                                </label>
                                            </div>
                                            <div class="icheck-primary d-inline">
                                                <input class="genero" type="radio" id="genero2" name="genero" value="Femenino">
                                                <label class="font-weight-normal" for="genero2">Femenino
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- ===================================================
                                    Tipo de Sangre
                                =================================================== -->
                                <div class="col-12 col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="exampleInput1">Tipo de Sangre *</label>
                                        <select id="tipo_sangre" class="form-control" name="tipo_sangre" required>
                                            <option value="" selected>Seleccione una opción</option>
                                            <option>O+</option>
                                            <option>O-</option>
                                            <option>A+</option>
                                            <option>A-</option>
                                            <option>AB+</option>
                                            <option>AB-</option>
                                            <option>B+</option>
                                            <option>B-</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- ===================================================
                                    Raza
                                =================================================== -->
                                <div class="col-12 col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="exampleInput1">Raza *</label>
                                        <select id="raza" class="form-control" name="raza" required>
                                            <option value="" selected>Seleccione una opción</option>
                                            <option>Mulato</option>
                                            <option>Mestizo</option>
                                            <option>Blanco</option>
                                            <option>Indio</option>
                                            <option>Zambo</option>
                                            <option>Negro</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- ===================================================
                                    Correo
                                =================================================== -->
                                <div class="col-12 col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="exampleInput1">Correo *</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-at"></i></span>
                                            </div>
                                            <input type="text" class="form-control" name="correo" id="correo" maxlength="45" required>
                                        </div>
                                        <!-- /.input group -->
                                    </div>
                                </div>

                                <!-- ===================================================
                                    Nivel de Escolaridad
                                =================================================== -->
                                <div class="col-12 col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="exampleInput1">Nivel de Escolaridad *</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-graduation-cap"></i></span>
                                            </div>
                                            <select id="nivel_escolaridad" class="form-control" name="nivel_escolaridad" required>
                                                <option>Ninguna</option>
                                                <option>Primaria</option>
                                                <option>Secundaria</option>
                                                <option>Tecnico</option>
                                                <option>Tecnologo</option>
                                                <option>Universitario</option>
                                                <option>Posgrado</option>
                                            </select>
                                        </div>
                                        <!-- /.input group -->
                                    </div>
                                </div>

                                <!-- ===================================================
                                    Cargo
                                =================================================== -->
                                <div class="col-12 col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="exampleInput1">Cargo *</label>
                                        <select id="cargo" class="form-control" name="cargo" required>
                                            <option value="" selected>Seleccione una opción</option>
                                            <?php foreach ($Cargos as $key => $value) : ?>
                                                <option value="<?= $value['idCargo'] ?>"><?= $value['cargo'] ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                </div>

                                <!-- ===================================================
                                    Área
                                =================================================== -->
                                <div class="col-12 col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="exampleInput1">Área *</label>
                                        <div class="form-group clearfix">
                                            <div class="icheck-primary d-inline">
                                                <input class="area" type="radio" id="area1" name="area" value="Operativo" required>
                                                <label class="font-weight-normal" for="area1">Operativo
                                                </label>
                                            </div>
                                            <div class="icheck-primary d-inline">
                                                <input class="area" type="radio" id="area2" name="area" value="Administrativo">
                                                <label class="font-weight-normal" for="area2">Administrativo
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- ===================================================
                                    Proceso *
                                =================================================== -->
                                <div class="col-12 col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="exampleInput1">Proceso *</label>
                                        <select id="proceso" class="form-control" name="proceso" required>
                                            <option value="" selected>Seleccione una opción</option>
                                            <?php foreach ($Procesos as $key => $value) : ?>
                                                <option value="<?= $value['idProceso'] ?>"><?= $value['proceso'] ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                </div>

                                <!-- ===================================================
                                    Antigüedad
                                =================================================== -->
                                <div class="col-12 col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="exampleInput1">Antigüedad *</label>
                                        <input type="text" class="form-control" name="antiguedad" id="antiguedad" maxlength="45" required>
                                    </div>
                                </div>

                                <!-- ===================================================
                                    Turno de Trabajo
                                =================================================== -->
                                <div class="col-12 col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="exampleInput1">Turno de Trabajo *</label>
                                        <div class="form-group clearfix">
                                            <div class="icheck-primary d-inline">
                                                <input class="turno_trabajo" type="radio" id="turnoTrabajo1" name="turno_trabajo" value="Diurno" required>
                                                <label class="font-weight-normal" for="turnoTrabajo1">Diurno
                                                </label>
                                            </div>
                                            <div class="icheck-primary d-inline">
                                                <input class="turno_trabajo" type="radio" id="turnoTrabajo2" name="turno_trabajo" value="Nocturno">
                                                <label class="font-weight-normal" for="turnoTrabajo2">Nocturno
                                                </label>
                                            </div>
                                            <div class="icheck-primary d-inline">
                                                <input class="turno_trabajo" type="radio" id="turnoTrabajo3" name="turno_trabajo" value="Rotativo">
                                                <label class="font-weight-normal" for="turnoTrabajo3">Rotativo
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- ===================================================
                                    Tipo de contrato
                                =================================================== -->
                                <div class="col-12 col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="exampleInput1">Tipo de contrato</label>
                                        <select id="tipo_contrato" class="form-control" name="tipo_contrato">
                                            <option value="" selected>Seleccione una opción</option>
                                            <option>Definido</option>
                                            <option>Indefinido</option>
                                            <option>Prestación de servicios</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- ===================================================
                                    Tipo de vinculación
                                =================================================== -->
                                <div class="col-12 col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="exampleInput1">Tipo de vinculación *</label>
                                        <div class="form-group clearfix">
                                            <div class="icheck-primary d-inline">
                                                <input class="tipo_vinculacion" type="radio" id="tipo_vinculacion1" name="tipo_vinculacion" value="Propio" required>
                                                <label class="font-weight-normal" for="tipo_vinculacion1">Propio
                                                </label>
                                            </div>
                                            <div class="icheck-primary d-inline">
                                                <input class="tipo_vinculacion" type="radio" id="tipo_vinculacion2" name="tipo_vinculacion" value="Afiliado">
                                                <label class="font-weight-normal" for="tipo_vinculacion2">Afiliado
                                                </label>
                                            </div>
                                            <div class="icheck-primary d-inline">
                                                <input class="tipo_vinculacion" type="radio" id="tipo_vinculacion3" name="tipo_vinculacion" value="Convenio">
                                                <label class="font-weight-normal" for="tipo_vinculacion3">Convenio
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- ===================================================
                                    Pago de seguridad social
                                =================================================== -->
                                <div class="col-12 col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="exampleInput1">Pago de seguridad social</label>
                                        <select id="pago_seguridadsocial" class="form-control" name="pago_seguridadsocial">
                                            <option value="" selected>Seleccione una opción</option>
                                            <option>Por la empresa</option>
                                            <option>Independiente</option>
                                            <option>Independiente con permiso</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- ===================================================
                                    Años Experiencia
                                =================================================== -->
                                <div class="col-12 col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="exampleInput1">Años Experiencia *</label>
                                        <input type="number" class="form-control" name="anios_experiencia" id="anios_experiencia" min="0" max="999" required>
                                    </div>
                                </div>

                                <!-- ===================================================
                                    Personas a cargo
                                =================================================== -->
                                <div class="col-12 col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="exampleInput1">Personas a cargo *</label>
                                        <input type="text" class="form-control" name="dependientes" id="dependientes" maxlength="45" required>
                                    </div>
                                </div>

                                <!-- ===================================================
                                    Eps
                                =================================================== -->
                                <div class="col-12 col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="exampleInput1">Eps *</label>
                                        <select id="eps" class="form-control" name="eps" required>
                                            <option value="" selected>Seleccione una opción</option>
                                            <?php foreach ($ListadoEPS as $key => $value) : ?>
                                                <option value="<?= $value['ideps'] ?>"><?= $value['eps'] ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                </div>

                                <!-- ===================================================
                                    Afp
                                =================================================== -->
                                <div class="col-12 col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="exampleInput1">Afp *</label>
                                        <select id="afp" class="form-control" name="afp" required>
                                            <option value="" selected>Seleccione una opción</option>
                                            <?php foreach ($ListadoAFP as $key => $value) : ?>
                                                <option value="<?= $value['idfondo'] ?>"><?= $value['fondo'] ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                </div>

                                <!-- ===================================================
                                    Arl
                                =================================================== -->
                                <div class="col-12 col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="exampleInput1">Arl *</label>
                                        <select id="arl" class="form-control" name="arl" required>
                                            <option value="" selected>Seleccione una opción</option>
                                            <?php foreach ($ListadoARL as $key => $value) : ?>
                                                <option value="<?= $value['idarl'] ?>"><?= $value['arl'] ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                </div>

                                <!-- ===================================================
                                    Salario Básico
                                =================================================== -->
                                <div class="col-12 col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="exampleInput1">Salario Básico *</label>
                                        <input type="number" class="form-control" name="salario_basico" id="salario_basico" min="0" required>
                                    </div>
                                </div>

                                <!-- ===================================================
                                    Beneficio Fijo
                                =================================================== -->
                                <div class="col-12 col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="exampleInput1">Beneficio Fijo</label>
                                        <input type="number" class="form-control" name="beneficio_fijo" id="beneficio_fijo" min="0">
                                    </div>
                                </div>

                                <!-- ===================================================
                                    Bonificación Variable
                                =================================================== -->
                                <div class="col-12 col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="exampleInput1">Bonificación Variable</label>
                                        <input type="number" class="form-control" name="bonificacion_variable" id="bonificacion_variable" min="0">
                                    </div>
                                </div>

                                <!-- ===================================================
                                    Ciudad
                                =================================================== -->
                                <div class="col-12 col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="exampleInput1">Ciudad</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend d-none d-sm-block d-md-none d-xl-block" style="width: 10%;">
                                                <span class="input-group-text" style="height: 100%;"><i class="fas fa-map-marker-alt"></i></span>
                                            </div>
                                            <select id="ciudad" class="form-control select2-single" style="width: 90%" name="ciudad">
                                                <option value="" selected>DEPARTAMENTO - MUNICIPIO</option>
                                                <?php foreach ($DeparMunicipios as $key => $value) : ?>
                                                    <option value="<?= $value['idmunicipio'] ?>"><?= $value['DeparMunic'] ?></option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                        <!-- /.input group -->
                                    </div>
                                </div>

                                <!-- ===================================================
                                    Sucursal
                                =================================================== -->
                                <div class="col-12 col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="exampleInput1">Sucursal *</label>
                                        <select id="sucursal" class="form-control" name="sucursal" required>
                                            <option value="" selected>Seleccione una opción</option>
                                            <?php foreach ($Sucursales as $key => $value) : ?>
                                                <option value="<?= $value['ids'] ?>"><?= $value['sucursal'] ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                </div>

                                <!-- ===================================================
                                    Activo
                                =================================================== -->
                                <div class="col-12 col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="exampleInput1">Activo *</label>
                                        <div class="form-group clearfix">
                                            <div class="icheck-primary d-inline">
                                                <input class="activo" type="radio" id="activo1" value="S" name="activo" checked>
                                                <label class="font-weight-normal" for="activo1">Activo
                                                </label>
                                            </div>
                                            <div class="icheck-primary d-inline">
                                                <input class="activo" type="radio" id="activo2" value="N" name="activo">
                                                <label class="font-weight-normal" for="activo2">Inactivo
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- ===================================================
                                    Fecha Ingreso
                                =================================================== -->
                                <div class="col-12 col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="exampleInput1">Fecha Ingreso</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                            </div>
                                            <input type="date" class="form-control" name="fecha_ingreso" id="fecha_ingreso" min="<?php echo date('Y-m-d', strtotime("1900-01-01")); ?>">
                                        </div>
                                        <!-- /.input group -->
                                    </div>
                                </div>

                                <!-- ===================================================
                                    Empresa
                                =================================================== -->
                                <div class="col-12 col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="exampleInput1">Empresa</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-building"></i></span>
                                            </div>
                                            <input type="text" class="form-control" name="empresa" id="empresa" maxlength="100">
                                        </div>
                                        <!-- /.input group -->
                                    </div>
                                </div>

                                <!-- ===================================================
                                    FOTO
                                =================================================== -->
                                <div class="col-12 col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="exampleInput1">Foto</label>
                                        <br>
                                        <img src="views/img/fotosUsuarios/default/anonymous.png" class="img-fluid previsualizar" width="100">
                                        <div class="input-group mt-1">
                                            <div class="input-group-append">
                                                <span class="input-group-text">
                                                    <i class="fas fa-image"></i>
                                                </span>
                                            </div>
                                            <input type="file" class="form-control" name="nuevaFoto" id="nuevaFoto">
                                        </div>
                                        <p>Peso máximo de la foto 2 MB</p>
                                    </div>
                                </div>

                            </div>

                            <!-- ===================================================
                                BOTON GUARDAR FORMULARIO
                            =================================================== -->
                            <div class="row">
                                <div class="col-12 text-right">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                                    <button type="submit" class="btn btn-success">
                                        <i class="fas fa-save"></i>
                                        Guardar
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- ===================================================
                        CONTENIDO SEGUNDO TAB CON CONTRATOS Y PRÓRROGAS
                    =================================================== -->
                    <div class="tab-pane fade" id="contratos" role="tabpanel" aria-labelledby="contratos-tab">
                        <form class="formulario" id="frmProrrogas" method="post" enctype="multipart/form-data">
                            <div class="row mt-2 border border-info rounded">
                                <!-- ===================================================
                                    Contrato
                                =================================================== -->
                                <div class="col-12 col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="exampleInput1">Contrato *</label>
                                        <select id="my-select" class="form-control" name="contrato">
                                            <option>Contrato inicial</option>
                                            <option>Prorroga 1</option>
                                            <option>Prorroga 2</option>
                                            <option>Prorroga 3</option>
                                            <option>Prorroga 4</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- ===================================================
                                    Fecha Inicial
                                =================================================== -->
                                <div class="col-12 col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="exampleInput1">Fecha inicial *</label>
                                        <input type="date" class="form-control" name="fecha_inicial" min="<?php echo date('Y-m-d', strtotime("1900-01-01")); ?>" required>
                                    </div>
                                </div>

                                <!-- ===================================================
                                    Fecha Fin
                                =================================================== -->
                                <div class="col-12 col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="exampleInput1">Fecha fin *</label>
                                        <input type="date" class="form-control" name="fecha_fin" min="<?php echo date('Y-m-d', strtotime("1900-01-01")); ?>" required>
                                    </div>
                                </div>

                                <!-- ===================================================
                                    Meses Prorroga
                                =================================================== -->
                                <div class="col-12 col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="exampleInput1">Meses prorroga *</label>
                                        <select id="my-select" class="form-control" name="meses_prorroga" required>
                                            <option value="" selected></option>
                                            <option>1</option>
                                            <option>2</option>
                                            <option>3</option>
                                            <option>4</option>
                                            <option>5</option>
                                            <option>6</option>
                                            <option>12</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- ===================================================
                                    Cargar contrato
                                =================================================== -->
                                <div class="col-12 col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="exampleInput1">Cargar contrato</label>
                                        <div class="input-group mt-1">
                                            <div class="input-group-append">
                                                <span class="input-group-text">
                                                    <i class="fas fa-file-alt"></i>
                                                </span>
                                            </div>
                                            <input type="file" class="form-control" name="" id="inputfile-prorrogas" accept="image/png, image/jpeg, application/pdf">
                                        </div>
                                    </div>
                                </div>

                                <!-- ===================================================
                                BOTON GUARDAR FORMULARIO
                            =================================================== -->
                                <div class="col-12 col-md-6 col-lg-4 text-right text-md-left align-self-center">
                                    <button type="submit" class="btn btn-success">
                                        <i class="fas fa-check-circle"></i>
                                    </button>
                                </div>
                            </div>
                        </form>

                        <!-- ===================================================
                            TABLA CONTRATOS Y PRORROGAS
                        =================================================== -->
                        <div class="row mt-3">
                            <div class="col-12 table-responsive">
                                <table id="tblProrrogas" class="table table-sm table-light table-bordered table-hover w-100 tablas-dinamicas">
                                    <thead class="thead-light text-center">
                                        <tr>
                                            <th>Contrato</th>
                                            <th>Documento</th>
                                            <th>Fecha inicial</th>
                                            <th>Fecha fin</th>
                                            <th>Meses prorroga</th>
                                            <th>Eliminar</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbodyProrrogas" class="tbody-tablas-dinamicas text-center">
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- ===================================================
                            CERRAR MODAL
                        =================================================== -->
                        <div class="row mt-2">
                            <div class="col-12 text-right">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </div>

                    <!-- ===================================================
                        CONTENIDO TERCER TAB HIJOS
                    =================================================== -->
                    <div class="tab-pane fade" id="hijos" role="tabpanel" aria-labelledby="hijos-tab">
                        <form class="formulario" id="frmHijos" method="post" enctype="multipart/form-data">
                            <div class="row mt-2 border border-info rounded">
                                <!-- ===================================================
                                    Nombre
                                =================================================== -->
                                <div class="col-12 col-md-6 col-lg-4 col-xl-3">
                                    <div class="form-group">
                                        <label for="exampleInput1">Nombre *</label>
                                        <input type="text" class="form-control" name="Nombre" id="Nombre_hijo" maxlength="100" required>
                                    </div>
                                </div>

                                <!-- ===================================================
                                    Fecha nacimiento
                                =================================================== -->
                                <div class="col-12 col-md-6 col-lg-4 col-xl-3">
                                    <div class="form-group">
                                        <label for="exampleInput1">Fecha nacimiento *</label>
                                        <input type="date" class="form-control" name="fecha_nacimiento" id="fecha_nacimiento_hijo" min="<?php echo date('Y-m-d', strtotime("1900-01-01")); ?>" max="<?php echo date('Y-m-d', strtotime(date("Y-m-d"))); ?>" required>
                                    </div>
                                </div>

                                <!-- ===================================================
                                Edad
                            =================================================== -->
                                <div class="col-12 col-md-6 col-lg-4 col-xl-2">
                                    <div>
                                        <div class="form-group">
                                            <label for="exampleInput1">Edad</label>
                                            <input type="text" class="form-control" name="edad" id="edad_hijo" maxlength="10">
                                        </div>
                                    </div>
                                </div>

                                <!-- ===================================================
                                    Genero
                                =================================================== -->
                                <div class="col-6 col-lg-4 col-xl-3">
                                    <div class="form-group d-inline">
                                        <label for="exampleInput1">Género *</label>
                                        <div class="form-group clearfix">
                                            <div class="icheck-primary d-inline">
                                                <input type="radio" id="generohijo1" name="genero" value="Masculino" required>
                                                <label class="font-weight-normal" for="generohijo1">Masculino
                                                </label>
                                            </div>
                                            <div class="icheck-primary d-inline">
                                                <input type="radio" id="generohijo2" name="genero" value="Femenino">
                                                <label class="font-weight-normal" for="generohijo2">Femenino
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- ===================================================
                                    Boton submit                                    
                                =================================================== -->
                                <div class="col-6 col-md-12 col-lg-4 col-xl-1 text-center text-md-right text-lg-left align-self-center">
                                    <button class="btn btn-success" type="submit"><i class="fas fa-check-circle"></i></button>
                                </div>

                            </div>
                        </form>

                        <!-- ===================================================
                            TABLA HIJOS
                        =================================================== -->
                        <div class="row mt-2">
                            <div class="col-12 table-responsive">
                                <table id="tblHijos" class="table table-sm table-light table-bordered table-hover w-100 tablas-dinamicas">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Fecha nacimiento</th>
                                            <th>Edad</th>
                                            <th>Género</th>
                                            <th>Eliminar</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbodyHijos" class="tbody-tablas-dinamicas">
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- ===================================================
                            CERRAR MODAL
                        =================================================== -->
                        <div class="row mt-2">
                            <div class="col-12 text-right">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </div>

                    <!-- ===================================================
                        CONTENIDO CUARTO TAB CON LICENCIA DE CONDUCCIÓN
                    =================================================== -->
                    <div class="tab-pane fade" id="licencias" role="tabpanel" aria-labelledby="licencias-tab">
                        <form class="formulario" id="frmLicencias" method="post" enctype="multipart/form-data">
                            <div class="row mt-2 border border-info rounded">
                                <!-- ===================================================
                                    Nro licencia
                                =================================================== -->
                                <div class="col-12 col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="exampleInput1">Nro licencia *</label>
                                        <input type="text" class="form-control" name="nro_licencia" maxlength="50" required>
                                    </div>
                                </div>

                                <!-- ===================================================
                                    Licencia escaneada
                                =================================================== -->
                                <div class="col-12 col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="exampleInput1">Licencia escaneada</label>
                                        <div class="input-group mt-1">
                                            <div class="input-group-append">
                                                <span class="input-group-text">
                                                    <i class="fas fa-file-alt"></i>
                                                </span>
                                            </div>
                                            <input type="file" class="form-control" name="" id="inputfile-licencias" accept="image/png, image/jpeg">
                                        </div>
                                    </div>
                                </div>

                                <!-- ===================================================
                                    Fecha expedición
                                =================================================== -->
                                <div class="col-12 col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="exampleInput1">Fecha expedición *</label>
                                        <input type="date" class="form-control" name="fecha_expedicion" min="<?php echo date('Y-m-d', strtotime("1900-01-01")); ?>" required>
                                    </div>
                                </div>

                                <!-- ===================================================
                                    Fecha vencimiento
                                =================================================== -->
                                <div class="col-12 col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="exampleInput1">Fecha vencimiento *</label>
                                        <input type="date" class="form-control" name="fecha_vencimiento" min="<?php echo date('Y-m-d', strtotime("1900-01-01")); ?>" required>
                                    </div>
                                </div>

                                <!-- ===================================================
                                    Categoría
                                =================================================== -->
                                <div class="col-12 col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="exampleInput1">Categoría *</label>
                                        <select id="my-select" class="form-control" name="categoria" required>
                                            <option value="" selected>Seleccione una opción</option>
                                            <option>A1</option>
                                            <option>A2</option>
                                            <option>B1</option>
                                            <option>B2</option>
                                            <option>B3</option>
                                            <option>C1</option>
                                            <option>C2</option>
                                            <option>C3</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- ===================================================
                                BOTON GUARDAR FORMULARIO
                            =================================================== -->
                                <div class="col-12 col-md-6 col-lg-4 text-right text-md-left align-self-center">
                                    <button type="submit" class="btn btn-success">
                                        <i class="fas fa-check-circle"></i>
                                    </button>
                                </div>
                            </div>
                        </form>

                        <!-- ===================================================
                            TABLA LICENCIAS DE CONDUCCION
                        =================================================== -->
                        <div class="row mt-3">
                            <div class="col-12 table-responsive">
                                <table id="tblLicencias" class="table table-sm table-light table-bordered table-hover w-100 tablas-dinamicas">
                                    <thead class="thead-light text-center">
                                        <tr>
                                            <th>Nro Licencia</th>
                                            <th>Documento</th>
                                            <th>Fecha exped.</th>
                                            <th>Fecha venc.</th>
                                            <th>Categoría</th>
                                            <th>Eliminar</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbodyLicencias" class="tbody-tablas-dinamicas text-center">
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- ===================================================
                            CERRAR MODAL
                        =================================================== -->
                        <div class="row mt-2">
                            <div class="col-12 text-right">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </div>

                    <!-- ===================================================
                        CONTENIDO QUINTO TAB CON EXAMENES MEDICOS
                    =================================================== -->
                    <div class="tab-pane fade" id="examenes" role="tabpanel" aria-labelledby="examenes-tab">
                        <form class="formulario" id="frmExamenes" method="post" enctype="multipart/form-data">
                            <div class="row mt-2 border border-info rounded">
                                <!-- ===================================================
                                    Tipo examen
                                =================================================== -->
                                <div class="col-12 col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="exampleInput1">Tipo examen *</label>
                                        <select id="my-select" class="form-control" name="tipo_examen" required>
                                            <option value="" selected>Seleccione una opción</option>
                                            <option>Examenes ocupacionales</option>
                                            <option>Examenes psicotecnicos</option>
                                            <option>Certificado de seguridad vial</option>
                                            <option>Examenes psicosensometrico</option>
                                            <option>Panel de drogas</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- ===================================================
                                    Fecha inicial
                                =================================================== -->
                                <div class="col-12 col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="exampleInput1">Fecha inicial *</label>
                                        <input type="date" class="form-control" name="fecha_inicial" min="<?php echo date('Y-m-d', strtotime("1900-01-01")); ?>" required>
                                    </div>
                                </div>

                                <!-- ===================================================
                                    Fecha final
                                =================================================== -->
                                <div class="col-12 col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="exampleInput1">Fecha final *</label>
                                        <input type="date" class="form-control" name="fecha_final" min="<?php echo date('Y-m-d', strtotime("1900-01-01")); ?>" required>
                                    </div>
                                </div>

                                <!-- ===================================================
                                    Cargar documento
                                =================================================== -->
                                <div class="col-12 col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="exampleInput1">Cargar documento</label>
                                        <div class="input-group mt-1">
                                            <div class="input-group-append">
                                                <span class="input-group-text">
                                                    <i class="fas fa-file-alt"></i>
                                                </span>
                                            </div>
                                            <input type="file" class="form-control" name="" id="inputfile-examenes" accept="image/png, image/jpeg, application/pdf">
                                        </div>
                                    </div>
                                </div>

                                <!-- ===================================================
                                BOTON GUARDAR FORMULARIO
                            =================================================== -->
                                <div class="col-12 col-lg-4 text-right text-lg-left align-self-center">
                                    <button type="submit" class="btn btn-success">
                                        <i class="fas fa-check-circle"></i>
                                    </button>
                                </div>
                            </div>
                        </form>

                        <!-- ===================================================
                            TABLA EXAMENES MEDICOS
                        =================================================== -->
                        <div class="row mt-3">
                            <div class="col-12 table-responsive">
                                <table id="tblExamenes" class="table table-sm table-light table-bordered table-hover w-100 tablas-dinamicas">
                                    <thead class="thead-light text-center">
                                        <tr>
                                            <th>Documento</th>
                                            <th>Tipo exámen</th>
                                            <th>Fecha inicial</th>
                                            <th>Fecha final</th>
                                            <th>Eliminar</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbodyExamenes" class="tbody-tablas-dinamicas text-center">
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- ===================================================
                            CERRAR MODAL
                        =================================================== -->
                        <div class="row mt-2">
                            <div class="col-12 text-right">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>