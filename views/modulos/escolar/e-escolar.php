<?php
$Placas = ControladorVehiculos::ctrListaVehiculos();
$instituciones = ControladorEscolar::ctrListaInstituciones();
$personal = ControladorGH::ctrListaPersonal();
?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark "><strong><i>Escolar</i></strong> <i class="fas fa-chalkboard-teacher"></i></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                        <li class="breadcrumb-item active">Escolar</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <!-- ===================== 
              AGREGAR FILAS Y COLUMNAS PARA EL DESARROLLO 
            ========================= -->

            <div class="tab-content" id="pills-tabcontent">
                <div class="tab-pane fade show active" id="pills-escolar" role="tabpanel" aria-labelledby="pills-escolar-tab">
                    <div class="row">
                        <div class="col-12 col-sm-6 col-lg-12">
                            <div class="card card-info">
                                <div class="card-header">
                                    <ul class="nav nav-tabs card-header-tabs" id="custom-tabs-one-tab" role="tablist">
                                        <!-- <li class="nav-item">
                                         <a class="nav-link active" id="custom-tabs-one-solicitudserv_exter_repues-tab" data-toggle="pill" href="#custom-tabs-one-solicitudserv_exter_repues" role="tab" aria-controls="custom-tabs-one-solicitudserv_exter_repues" aria-selected="false">Solicitud de servicio / Repuestos</a>
                                        </li> -->
                                        <li class="nav-item ">
                                            <!-- TABS HORIZONTALES-->
                                            <a class="nav-link active" id="custom-tabs-one-escolar-tab" data-toggle="pill" href="#custom-tabs-one-escolar" role="tab" aria-controls="custom-tabs-one-escolar" aria-selected="true"><i class="fas fa-route"></i> Rutas y seguimiento</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="custom-tabs-one-historial_escolar-tab" data-toggle="pill" href="#custom-tabs-one-historial_escolar" role="tab" aria-controls="custom-tabs-one-historial_escolar" aria-selected="false"><i class="fas fa-history"></i> Historial de recorridos</a>
                                        </li>

                                    </ul>
                                </div>

                                <div class="card-body">
                                    <div class="tab-content" id="custom-tabs-one-tabContent">
                                        <!-- ==============================================
                                        TAB ESCOLAR
                                        ==================================================-->
                                        <div class="tab-pane fade active show" id="custom-tabs-one-escolar" role="tabpanel" aria-labelledby="custom-tabs-one-escolar-tab">

                                            <div class="row">
                                                <div class="col-md-12">


                                                    <!-- <hr class="my-4"> -->
                                                    <div class="justify-content-start mt-2">
                                                        <!-- BOTON NUEVA RUTA-->
                                                        <button type="button" class="btn btn-info btn-md btn-nuevaRuta" data-toggle="modal" data-target="#modalRuta">
                                                            <i class="fas fa-road"></i> Agregar ruta
                                                        </button>

                                                    </div>
                                                    <!-- <button type="button" class="btn btn-success btn-md" data-toggle="modal" data-target="#modalRuta">
                                                    <i class="fas fa-user-plus"></i> Agregar estudiante
                                                        </button> -->





                                                    <!--|||TABLA|||-->
                                                    <div class="row mt-2">
                                                        <div class="col-12">
                                                            <div class="card card-outline card-info">

                                                                <div class="card-body">

                                                                    <div class="table-responsive">
                                                                        <table id="tablaruta" class="table table-sm table-striped table-bordered dt-responsive table-hover tablasBtnExport w-100 text-center">
                                                                            <thead class="thead-light text-uppercase text-sm text-center">
                                                                                <tr>
                                                                                    <th style="width:10px;">Acciones</th>
                                                                                    <th># Ruta</th>
                                                                                    <th>Sector</th>
                                                                                    <th>Vehículo</th>
                                                                                    <th>Cantidad</th>
                                                                                    <th>Institución</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody class="text-sm" id="tbodyRuta">
                                                                                <!-- <td>
                                                                                    <div class="btn-group" role="group" aria-label="Button group">
                                                                                        <button class="btn btn-info" data-toggle="modal" data-target="#modalRuta"><i class="fas fa-edit"></i></button>
                                                                                        <button class="btn btn-success" data-toggle="modal" data-target="#modal-listar"><i class="fas fa-user-check"></i></button>
                                                                                        <button class="btn btn-warning" data-toggle="modal" data-target="#modal-seguimiento"><i class="fas fa-clipboard-check"></i></button>
                                                                                    </div>
                                                                                </td>
                                                                                <td>7N</td>
                                                                                <td>ÁLAMOS</td>
                                                                                <td>INI109</td>
                                                                                <td>29</td>
                                                                                <td>San Pablo</td> -->
                                                                            </tbody>
                                                                        </table>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>





                                                </div><!-- col -->


                                            </div> <!-- /.row -->


                                        </div>

                                        <!-- ============================================
                                            TAB HISTORIAL ESCOLAR
                                        ================================================ -->
                                        <div class="tab-pane fade active" id="custom-tabs-one-historial_escolar" role="tabpanel" aria-labelledby="custom-tabs-one-historial_escolar-tab">
                                            <div class="row">


                                                <div class="col-12">
                                                    <div class="card card-outline card-info">

                                                        <div class="card-body col-12">

                                                            <div class="table-responsive">
                                                                <table id="tableHistorialRecorrido" class="table table-sm table-striped table-bordered dt-responsive table-hover tablasBtnExport w-100 text-center">
                                                                    <thead class="thead-light text-uppercase text-sm text-center">
                                                                        <tr>
                                                                            <th style="width:10px;">Pasajeros</th>
                                                                            <th># Ruta</th>
                                                                            <th>Sector</th>
                                                                            <th>Vehículo</th>
                                                                            <th>Conductor</th>
                                                                            <th>Institución</th>
                                                                            <th>Fecha</th>
                                                                            <th>Final entrega</th>
                                                                            <th>Final recogida</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody class="text-sm" id="tbodyHistorialRecorrido">
                                                                        <!-- <tr>
                                                                                <td>
                                                                                    <div class="btn-group" role="group" aria-label="Button group">
                                                                                        <button class="btn btn-warning" data-toggle="modal" data-target="#modal"><i class="fas fa-clipboard-check"></i></button>
                                                                                    </div>
                                                                                </td>
                                                                                <td>7N</td>
                                                                                <td>ÁLAMOS</td>
                                                                                <td>INI109</td>
                                                                                <td>29</td>
                                                                                <td>San Pablo</td>
                                                                                <td>San Pablo</td>
                                                                            </tr> -->
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







        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- MODAL NUEVA RUTA ESCOLAR -->
<div id="modalRuta" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title" id="title-modal-ruta"><span class="badge badge-light">RUTA <i class="fas fa-road"></i></span></h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="ruta_form" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">

                        <input type="hidden" id="idruta" name="idruta" value="">

                        <div class="col-12 col-sm-6 col-lg-4">
                            <div class="form-group text-center ">
                                <label><i># Ruta</i></label>
                                <input type="text" class="form-control" id="numruta" name="numruta" required>
                            </div>
                        </div>

                        <div class="col-12 col-sm-6 col-lg-4">
                            <div class="form-group text-center ">
                                <label><i>Sector</i></label>
                                <input type="text" class="form-control" id="sector" name="sector" required>
                            </div>
                        </div>

                        <div class="col-12 col-sm-6 col-lg-4">
                            <div class="form-group text-center ">
                                <label><i>Institución</i></label>
                                <select id="institucion" name="idinstitucion" class="form-control form-control-sm select2-single" type="number" style="width: 99%" required>

                                </select>
                            </div>
                        </div>


                        <div class="col-12 col-sm-6 col-lg-4">
                            <div class="form-group text-center ">
                                <label><i>Placa</i></label>
                                <select id="placa" name="idvehiculo" class="form-control form-control-sm select2-single" type="number" style="width: 99%" required>

                                </select>
                            </div>
                        </div>

                        <div class="col-12 col-sm-6 col-lg-4">
                            <div class="form-group text-center ">
                                <label><i>Conductor</i></label>
                                <select id="idconductor" name="idconductor" class="form-control form-control-sm select2-single" type="number" style="width: 99%" required>

                                </select>
                            </div>
                        </div>


                        <div class="col-12 col-sm-6 col-lg-4">
                            <div class="form-group text-center ">
                                <label><i>Número interno</i></label>
                                <input type="text" class="form-control" id="numinterno" name="numinterno" readonly required>
                            </div>
                        </div>

                        <div class="col-12 col-sm-6 col-lg-4">
                            <div class="form-group text-center ">
                                <label><i>Tipo de vehículo</i></label>
                                <input type="text" class="form-control" id="tipovehiculo" name="tipovehiculo" readonly required>
                            </div>
                        </div>

                        <div class="col-12 col-sm-6 col-lg-4">
                            <div class="form-group text-center ">
                                <label><i>Cantidad</i></label>
                                <input type="text" class="form-control" id="cantidad" name="cantidad" readonly required>
                            </div>
                        </div>



                    </div>


                </div>
                <div class="modal-footer">
                    <button type="submit" form="ruta_form" id="btn-guardarProgra" class="btn btn-sm btn-success float-center">
                        <i class="fas fa-print"></i>
                        Guardar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- MODAL PARA LISTAR ESTUDIANTES EN UNA RUTA -->
<div id="modal-listar" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h5 class="modal-title" id="my-modal-title"><span class="badge badge-light">ESTUDIANTES <i class="fas fa-book-reader"></i></span></h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="justify-content-start">
                <button class="btn btn-info m-2 btn-EstudianteTemp" data-toggle="modal" data-target="#modalEstudianteTemporal">Asociar pasajero temporal <i class="fas fa-user-clock"></i></button>
                <button class="btn btn-success m-2 btn-nuevoEstudiante" data-toggle="modal" data-target="#modalEstudiante">Crear nuevo estudiante <i class="fas fa-user-check"></i></button>
                <button class="btn btn-danger m-2 btn-eliminarEstudiante" data-toggle="modal" data-target="#modalEliminarEstudiante">Desvincular estudiante <i class="fas fa-user-minus"></i></button>
            </div>

            <div class="card">
                <div class="card-body">


                    <div>
                        <h3><i>Asociar estudiante existente</i></h3>
                    </div>

                    <!-- FORMULARIO PARA ASOCIAR ESTUDIANTE A RUTA -->
                    <form class="" id="formulario_estudianteRuta" method="post" enctype="multipart/form-data">
                        <div class="row mt-2 mb-2 border border-info rounded">
                            <!-- ===================================================
                                ESTUDIANTE
                            =================================================== -->
                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="form-group text-center">
                                    <label for="exampleInput1">Estudiante</label>
                                    <select class="form-control select2-single" id="estudiante" name="idpasajero">
                                        <option value="" selected>-Seleccione un estudiante-</option>

                                    </select>
                                </div>
                            </div>

                            <!-- ===================================================
                            NUM RUTA
                            =================================================== -->
                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="form-group text-center">
                                    <label for="exampleInput1">Ruta</label>
                                    <select class="form-control select2-single" id="ruta2" name="idruta">

                                    </select>
                                </div>
                            </div>

                            <!-- ======================================
                                 ORDEN
                                ========================================= -->
                            <div class="col-12 col-md-6 col-lg-4 hide" id="despuesDe">
                                <div class="form-group text-center ">
                                    <label for="exampleInput1">Después de</label>
                                    <select class="form-control select2-single" id="estudianteOrden" name="estudianteOrden">

                                    </select>
                                </div>
                            </div>

                            <!-- ===================================================
                                                        BOTON GUARDAR FORMULARIO
                                                    =================================================== -->
                            <?php if (validarPermiso('M_VEHICULAR', 'U')) : ?>
                                <div class="col-12 col-md-4 col-lg-1 text-right text-md-left align-self-center m-1">
                                    <button type="submit" form="formulario_estudianteRuta" class="btn btn-success"><i class="fas fa-check-circle"></i></button>
                                    <div class="overlay d-none" id="">
                                        <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                                    </div>
                                </div>
                            <?php endif ?>
                        </div>



                    </form>

                    <!-- TABLA DE ESTUDIANTES -->
                    <div class="table-responsive">
                        <table id="tablaEstudiantesxRuta" class="table table-sm table-striped table-bordered dt-responsive table-hover tablasBtnExport w-100 text-center">
                            <thead class="thead-light text-uppercase text-sm text-center">
                                <tr>
                                    <th>Código</th>
                                    <th>Año</th>
                                    <th>Grado</th>
                                    <th>Grupo</th>
                                    <th>Nombre</th>
                                    <th>Nivel</th>
                                    <th>Barrio</th>
                                    <th>Dirección</th>
                                    <th>Nombre primer acudiente</th>
                                    <th>Celular primer acudiente</th>
                                    <th>Nombre segundo acudiente</th>
                                    <th>Celular segundo acudiente</th>
                                </tr>
                            </thead>
                            <tbody id="tbodyEstudiantesxRuta" class="text-sm">
                                <!-- <td>101010101</td>
                                <td>2022A</td>
                                <td>K4</td>
                                <td>K4</td>
                                <td>Osorio Castillo</td>
                                <td>Simón Eduardo</td>
                                <td>Preescolar</td>
                                <td>Alamos</td>
                                <td>Altos de canaan</td>
                                <td>Osorio Rivera Luis Alberto</td>
                                <td>3117736856</td>
                                <td></td>
                                <td></td> -->
                            </tbody>
                        </table>
                    </div>


                    <hr class="my-4 bg-dark">
                    <div class="justify-content-center">
                        <h3 class="text-center"><i>Posibles estudiantes en esta ruta</i> <i class="fas fa-route"></i></h3>
                    </div>

                    <!-- TABLA DE ESTUDIANTES TEMPORALES -->
                    <div class="table-responsive">
                        <table id="tablaEstudiantesTemporalxRuta" class="table table-sm table-striped table-bordered dt-responsive table-hover tablasBtnExport w-100 text-center">
                            <thead class="thead-light text-uppercase text-sm text-center">
                                <tr>
                                    <th>Código</th>
                                    <th>Año</th>
                                    <th>Grado</th>
                                    <th>Grupo</th>
                                    <th>Nombre</th>
                                    <th>Nivel</th>
                                    <th>Barrio</th>
                                    <th>Dirección</th>
                                    <th>Nombre primer acudiente</th>
                                    <th>Celular primer acudiente</th>
                                    <th>Nombre segundo acudiente</th>
                                    <th>Celular segundo acudiente</th>
                                </tr>
                            </thead>
                            <tbody id="tbodyEstudiantesTemporalxRuta" class="text-sm">
                                <!-- <td>101010101</td>
                                <td>2022A</td>
                                <td>K4</td>
                                <td>K4</td>
                                <td>Osorio Castillo</td>
                                <td>Simón Eduardo</td>
                                <td>Preescolar</td>
                                <td>Alamos</td>
                                <td>Altos de canaan</td>
                                <td>Osorio Rivera Luis Alberto</td>
                                <td>3117736856</td>
                                <td></td>
                                <td></td> -->
                            </tbody>
                        </table>
                    </div>


                </div>
            </div>





        </div>
    </div>
</div>

<!-- MODAL PARA CREAR NUEVO ESTUDIANTE -->
<div id="modalEstudiante" class="modal fade" style="overflow-y: scroll;" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title" id="my-modal-title">Nuevo estudiante <i class="fas fa-user-check"></i></h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="formulario" id="estudianteNuevo_form" method="post" enctype="multipart/form-data">
                    <div class="row">

                        <div class="col-12 col-sm-6 col-lg-4">
                            <div class="form-group text-center">
                                <label># Documento</label>
                                <input type="text" class="form-control" id="documentoEstudiante" name="documentoEstudiante" required>
                            </div>
                        </div>

                        <div class="col-12 col-sm-6 col-lg-4">
                            <div class="form-group text-center">
                                <label>Nombre</label>
                                <input type="text" class="form-control" id="nombreEstudiante" name="nombreEstudiante" required>
                            </div>
                        </div>

                        <div class="col-12 col-sm-6 col-lg-4">
                            <div class="form-group text-center">
                                <label for="exampleInput1">Ruta</label>
                                <select class="form-control select2-single" id="ruta" name="idruta" required>

                                </select>
                            </div>
                        </div>

                        <div class="col-12 col-sm-6 col-lg-4">
                            <div class="form-group text-center">
                                <label>Año</label>
                                <input type="text" class="form-control" id="anoEstudiante" name="anoEstudiante" required>
                            </div>
                        </div>

                        <div class="col-12 col-sm-6 col-lg-4">
                            <div class="form-group text-center">
                                <label>Grado</label>
                                <input type="text" class="form-control" id="gradoEstudiante" name="gradoEstudiante" required>
                            </div>
                        </div>

                        <div class="col-12 col-sm-6 col-lg-4">
                            <div class="form-group text-center">
                                <label>Grupo</label>
                                <input type="text" class="form-control" id="grupoEstudiante" name="grupoEstudiante" required>
                            </div>
                        </div>

                        <div class="col-12 col-sm-6 col-lg-4">
                            <div class="form-group text-center">
                                <label>Nivel</label>
                                <input type="text" class="form-control" id="nivelEstudiante" name="nivelEstudiante" required>
                            </div>
                        </div>

                        <div class="col-12 col-sm-6 col-lg-4">
                            <div class="form-group text-center">
                                <label>Barrio</label>
                                <input type="text" class="form-control" id="barrioEstudiante" name="barrioEstudiante" required>
                            </div>
                        </div>

                        <div class="col-12 col-sm-6 col-lg-4">
                            <div class="form-group text-center">
                                <label>Dirección</label>
                                <input type="text" class="form-control" id="direccionEstudiante" name="direccionEstudiante" required>
                            </div>
                        </div>

                        <div class="col-12 col-sm-6 col-lg-4">
                            <div class="form-group text-center">
                                <label>Nombre primer acudiente</label>
                                <input type="text" class="form-control" id="nombrePAcudienteEstudiante" name="nombrePAcudienteEstudiante" required>
                            </div>
                        </div>

                        <div class="col-12 col-sm-6 col-lg-4">
                            <div class="form-group text-center">
                                <label>Celular primer acudiente</label>
                                <input type="text" class="form-control" id="celularPAcudienteEstudiante" name="celularPAcudienteEstudiante" required>
                            </div>
                        </div>

                        <div class="col-12 col-sm-6 col-lg-4">
                            <div class="form-group text-center">
                                <label>Nombre segundo acudiente</label>
                                <input type="text" class="form-control" id="nombreSAcudienteEstudiante" name="nombreSAcudienteEstudiante">
                            </div>
                        </div>


                        <div class="col-12 col-sm-6 col-lg-4">
                            <div class="form-group text-center">
                                <label>Celular segundo acudiente</label>
                                <input type="text" class="form-control" id="celularSAcudienteEstudiante" name="celularSAcudienteEstudiante">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <div class="d-flex justify-content-center">
                    <button type="submit" form="estudianteNuevo_form" class="btn btn-info">
                        <i class="fas fa-save"></i>
                        Guardar
                    </button>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- MODAL PARA EL SEGUIMIENTO ESTUDIANTE  -->
<div id="modal-seguimiento" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h5 class="modal-title" id="my-modal-title"><span class="badge badge-light">SEGUIMIENTO <i class="fas fa-shuttle-van"></i></span></h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="card">
                <div class="card-body">

                    <div class="justify-content-center">
                        <h3 class="text-center"><i>Recorrido</i> <i class="fas fa-route"></i></h3>
                    </div>
                    <form class="" id="auxiliar_form" method="post" enctype="multipart/form-data">
                        <div class="row">


                            <input type="hidden" id="idruta_aux" name="idruta_aux" value="">

                            <div class="col-12 col-sm-6 col-lg-6">
                                <div class="form-group text-center">
                                    <label><i>Nombre auxiliar de recogida</i></label>
                                    <select class="form-control select2-single" id="nom_auxiliar" name="nom_auxiliar" type="number">
                                        <option value="">--Seleccione un auxiliar</option>
                                        <?php foreach ($personal as $key => $value) : ?>
                                            <option value="<?= $value['idPersonal'] ?>"> <?= $value['Nombre'] ?></option>
                                        <?php endforeach ?>
                                    </select>
                                    <!-- <input type="text" class="form-control" id="nom_auxiliar" name="nom_auxiliar" required> -->
                                </div>
                            </div>

                            <div class="col-12 col-sm-6 col-lg-6">
                                <div class="form-group text-center">
                                    <label for="observaciones"><i>Observaciones</i></label>
                                    <textarea class="form-control" name="observaciones_auxiliar" id="observaciones_auxiliar" rows="2"></textarea>
                                </div>
                            </div>


                            <div class="col-12 col-sm-6 col-lg-6">
                                <div class="form-group text-center">
                                    <label><i>Nombre auxiliar de entrega</i></label>
                                    <select class="form-control select2-single" id="nom_auxiliar2" name="nom_auxiliar2" type="number">
                                        <option value="">--Seleccione un auxiliar</option>
                                        <?php foreach ($personal as $key => $value) : ?>
                                            <option value="<?= $value['idPersonal'] ?>"> <?= $value['Nombre'] ?></option>
                                        <?php endforeach ?>
                                    </select>

                                    <!-- <input type="text" class="form-control" id="nom_auxiliar2" name="nom_auxiliar2"> -->
                                </div>
                            </div>

                            <div class="col-12 col-sm-6 col-lg-6">
                                <div class="form-group text-center">
                                    <label for="observaciones"><i>Observaciones</i></label>
                                    <textarea class="form-control" name="observaciones_auxiliar2" id="observaciones_auxiliar2" rows="2"></textarea>
                                </div>
                            </div>

                            <div class="text-center justify-content-center">
                                <button type="submit" class="btn btn-md bg-gradient-success " form="auxiliar_form"><i class="fas fa-plus"></i> Guardar</button>
                                <button type="button" class="btn btn-md bg-info" id="fin_recorrido"><i class="fas fa-hourglass-end"></i> Marcar fin del recorrido</button>
                            </div>
                        </div>
                    </form>

                    <hr class="my-4">

                    <!-- TABLA DE ESTUDIANTES -->
                    <div class="table-responsive">
                        <table id="tablaSeguimiento" class="table table-sm table-striped table-bordered dt-responsive table-hover tablasBtnExport w-100 text-center">
                            <thead class="thead-light text-uppercase text-sm text-center">
                                <tr>
                                    <th>Recoge</th>
                                    <th>Entrega</th>
                                    <th>Código</th>
                                    <th>Nombre</th>
                                    <th>Nivel</th>
                                    <th>Barrio</th>
                                    <th>Dirección</th>
                                    <th>...</th>
                                </tr>
                            </thead>
                            <tbody id="tbodySeguimiento" class="text-sm">
                                <!-- <td>
                                    <div class="btn-group">
                                        <button class="btn btn-success"><i class="fas fa-sign-in-alt"></i></button>
                                        <button class="btn btn-danger"><i class="fas fa-sign-out-alt"></i></button>
                                    </div>
                                </td>
                                <td>101010101</td>
                                <td>Osorio Castillo</td>
                                <td>Simón Eduardo</td>
                                <td>Preescolar</td>
                                <td>Alamos</td>
                                <td>Altos de canaan</td> -->
                            </tbody>
                        </table>
                    </div>

                    <hr class="my-4 bg-dark">
                    <div class="justify-content-center">
                        <h3 class="text-center"><i>Posibles estudiantes en esta ruta</i> <i class="fas fa-route"></i></h3>
                    </div>


                    <!-- TABLA DE ESTUDIANTES TEMPORALES -->
                    <div class="table-responsive">
                        <table id="tablaSeguimientoEstudiantesTemporalxRuta" class="table table-sm table-striped table-bordered dt-responsive table-hover tablasBtnExport w-100 text-center">
                            <thead class="thead-light text-uppercase text-sm text-center">
                                <tr>
                                    <th>Recoge</th>
                                    <th>Entrega</th>
                                    <th>Código</th>
                                    <th>Nombre</th>
                                    <th>Nivel</th>
                                    <th>Barrio</th>
                                    <th>Dirección</th>
                                    <th>...</th>
                                </tr>
                            </thead>
                            <tbody id="tbodySeguimientoEstudiantesTemporalxRuta" class="text-sm">
                                <!-- <td>101010101</td>
                                <td>2022A</td>
                                <td>K4</td>
                                <td>K4</td>
                                <td>Osorio Castillo</td>
                                <td>Simón Eduardo</td>
                                <td>Preescolar</td>
                                <td>Alamos</td>
                                <td>Altos de canaan</td>
                                <td>Osorio Rivera Luis Alberto</td>
                                <td>3117736856</td>
                                <td></td>
                                <td></td> -->
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>





        </div>
    </div>
</div>

<!-- MODAL ESTUDIANTE TEMPORAL -->
<div id="modalEstudianteTemporal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title" id="my-modal-title">Asociar estudiante temporal</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>


            <div class="card">
                <div class="card-body">
                    <form class="" id="estudianteTemp_form" method="post" enctype="multipart/form-data">

                        <div class="row mt-2 mb-2 border border-info rounded">
                            <!-- ===================================================
                                ESTUDIANTE
                            =================================================== -->
                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="form-group text-center">
                                    <label for="exampleInput1">Estudiante</label>
                                    <select class="form-control select2-single" id="estudiante2" name="idpasajero">
                                        <option value="" selected>-Seleccione un estudiante-</option>

                                    </select>
                                </div>
                            </div>

                            <!-- ===================================================
                            NUM RUTA
                            =================================================== -->
                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="form-group text-center">
                                    <label for="exampleInput1">Ruta</label>
                                    <select class="form-control select2-single" id="ruta3" name="idruta">

                                    </select>
                                </div>
                            </div>



                            <!-- ===================================================
                                                        BOTON GUARDAR FORMULARIO
                                                    =================================================== -->
                            <?php if (validarPermiso('M_VEHICULAR', 'U')) : ?>
                                <div class="col-12 col-md-4 col-lg-1 text-right text-md-left align-self-center m-1">
                                    <button type="submit" form="estudianteTemp_form" class="btn btn-success"><i class="fas fa-check-circle"></i></button>
                                    <div class="overlay d-none" id="">
                                        <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                                    </div>
                                </div>
                            <?php endif ?>
                        </div>
                    </form>
                </div>
            </div>



        </div>
    </div>
</div>

<!-- MODAL ELIMINAR ESTUDIANTE -->
<div id="modalEliminarEstudiante" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title" id="my-modal-title">Desvincular ruta</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="card">
                <div class="card-body">
                    <form class="" id="Eliminarestudiante_form" method="post" enctype="multipart/form-data">

                        <div class="row mt-2 mb-2 border border-info rounded">
                            <!-- ===================================================
                                ESTUDIANTE
                            =================================================== -->
                            <div class="col-12">
                                <div class="form-group text-center">
                                    <label for="exampleInput1">Estudiante</label>
                                    <select class="form-control select2-single" id="estudiante3" name="idpasajero">
                                        <option value="" selected>-Seleccione un estudiante-</option>

                                    </select>
                                </div>
                            </div>



                            <!-- ===================================================
                                                        BOTON GUARDAR FORMULARIO
                                                    =================================================== -->
                            <?php if (validarPermiso('M_VEHICULAR', 'U')) : ?>
                                <div class="col-12 col-md-4 col-lg-1 text-right text-md-left align-self-center m-1">
                                    <button type="submit" form="Eliminarestudiante_form" class="btn btn-danger"><i class="fas fa-check-circle"></i></button>
                                    <div class="overlay d-none" id="">
                                        <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                                    </div>
                                </div>
                            <?php endif ?>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- MODAL PASAJEROS HISTORIAL RECORRIDOS -->
<div id="modalHistorialRecorrido" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title" id="my-modal-title">Pasajeros</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="card">
                <div class="card-body">

                    <!-- TABLA DE ESTUDIANTES -->
                    <div class="table-responsive">
                        <table id="tablaPasajerosxRecorrido" class="table table-sm table-striped table-bordered dt-responsive table-hover tablasBtnExport w-100 text-center">
                            <thead class="thead-light text-uppercase text-sm text-center">
                                <tr>
                                    <th>Código</th>
                                    <th>Nombre</th>
                                    <th>Hora recoge</th>
                                    <th>Hora entrega</th>
                                    <th>Nivel</th>
                                    <th>Barrio</th>
                                    <th>Dirección</th>
                                </tr>
                            </thead>
                            <tbody id="tbodyPasajerosxRecorrido" class="text-sm">

                            </tbody>
                        </table>
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>