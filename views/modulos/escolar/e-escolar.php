<?php
$Placas = ControladorVehiculos::ctrListaVehiculos();
$instituciones = ControladorEscolar::ctrListaInstituciones();

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
            <div class="row">
                <div class="col-md-12  card ">


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
                <h5 class="modal-title" id="title-modal-ruta">Ruta <i class="fas fa-road"></i></h5>
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
                <h5 class="modal-title" id="my-modal-title">Estudiantes</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="justify-content-start">
                <button class="btn btn-success m-2 btn-nuevoEstudiante" data-toggle="modal" data-target="#modalEstudiante">Crear nuevo estudiante</button>
            </div>

            <div class="card">
                <div class="card-body">


                    <div>
                        <h3><i>Asociar estudiante existente</i></h3>
                    </div>

                    <!-- FORMULARIO PARA ASOCIAR ESTUDIANTE A RUTA -->
                    <form class="formulario" id="" method="post" enctype="multipart/form-data">
                        <div class="row mt-2 mb-2 border border-info rounded">
                            <!-- ===================================================
                                ESTUDIANTE
                            =================================================== -->
                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="form-group">
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
                                <div class="form-group">
                                    <label for="exampleInput1">Ruta</label>
                                    <select class="form-control select2-single" id="idruta" name="idruta">

                                    </select>
                                </div>
                            </div>

                            <!-- ===================================================
                                                        BOTON GUARDAR FORMULARIO
                                                    =================================================== -->
                            <?php if (validarPermiso('M_VEHICULAR', 'U')) : ?>
                                <div class="col-12 col-md-4 col-lg-1 text-right text-md-left align-self-center">
                                    <button type="submit" form="" class="btn btn-success"><i class="fas fa-check-circle"></i></button>
                                    <div class="overlay d-none" id="">
                                        <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                                    </div>
                                </div>
                            <?php endif ?>
                        </div>



                    </form>

                    <!-- TABLA DE ESTUDIANTES -->
                    <div class="table-responsive">
                        <table  id="tablaEstudiantesxRuta" class="table table-sm table-striped table-bordered dt-responsive table-hover tablasBtnExport w-100 text-center">
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

                </div>
            </div>





        </div>
    </div>
</div>

<!-- MODAL PARA CREAR NUEVO ESTUDIANTE -->
<div id="modalEstudiante" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title" id="my-modal-title">Nuevo estudiante</h5>
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
                <h5 class="modal-title" id="my-modal-title">SEGUIMIENTO</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="card">
                <div class="card-body">

                    <div class="justify-content-start">
                        <h3><i>Recorrido</i> <i class="fas fa-route"></i></h3>
                    </div>
                    <div class="row">


                        <div class="col-12 col-sm-6 col-lg-6">
                            <div class="form-group text-center">
                                <label><i>Nombre auxiliar</i></label>
                                <input type="text" class="form-control" id="cod_producto" name="cod_producto" required>
                            </div>
                        </div>

                        <div class="col-12 col-sm-6 col-lg-6">
                            <div class="form-group text-center">
                                <label for="observaciones"><i>Observaciones</i></label>
                                <textarea class="form-control" name="observaciones_salida" id="observaciones_salida" rows="2"></textarea>
                            </div>
                        </div>

                        <div class="text-center justify-content-center">
                            <button type="submit" class="btn btn-md bg-gradient-success " form=""><i class="fas fa-plus"></i> Guardar</button>
                        </div>

                    </div>

                    <hr class="my-4">

                    <!-- TABLA DE ESTUDIANTES -->
                    <div class="table-responsive">
                        <table class="table table-sm table-striped table-bordered dt-responsive table-hover tablasBtnExport w-100 text-center">
                            <thead class="thead-light text-uppercase text-sm text-center">
                                <tr>
                                    <th>...</th>
                                    <th>Código</th>
                                    <th>Apellidos</th>
                                    <th>Nombres</th>
                                    <th>Nivel</th>
                                    <th>Barrio</th>
                                    <th>Dirección</th>
                                </tr>
                            </thead>
                            <tbody class="text-sm">
                                <td>
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
                                <td>Altos de canaan</td>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>





        </div>
    </div>
</div>