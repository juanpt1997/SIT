<?php

// if (!validarModulo('CARGAR_OPCION')) {
//     echo "<script> window.location = 'inicio'; </script>";
// }
$Vehiculos = ControladorVehiculos::ctrListaVehiculos();
$TipoVehiculos = ControladorVehiculos::ctrMostrarTipoVehiculo();
$marca = ControladorVehiculos::ctrMostrarMarca();
$tiposDocumentacion = ControladorVehiculos::ctrTiposDocumentacion();
$ListaInventario = ControladorInventario::ctrListaInventario();
?>
<!-- ===================== 
    INVENTARIO VEHICULAR
========================= -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark "><b><i>Inventario Vehicular <i class="fas fa-boxes"></i></i></b></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                        <li class="breadcrumb-item active">Inventario vehicular</li>
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
              CONTENIDO
            ========================= -->
            <div class="row mt-2">
                <div class="col-12 col-lg">
                    <div class="card card-outline card-success">
                        <div class="card-body">
                            <!-- =====================                             
                                CARD DE INVENTARIO 
                            ========================-->
                            <div class="card card-success collapsed-card" id="card-inventario">
                                <div class="card-header" data-card-widget="collapse" style="cursor: pointer;">
                                    <h3 class="card-title"><b><i>Inventario</i></b>
                                        <i class="fas fa-boxes"></i>
                                    </h3>
                                    <div class="card-tools">
                                        <button type="button" title="Abrir inventario" data-toggle="tooltip" data-placement="top" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                </div>

                                <div class="card-body" style="display: none;">
                                    <!--ROW QUE SEPARA LAS IMAGENES DE LOS DATOS DEL INVENTARIO-->
                                    <div class="row d-flex justify-content-center">

                                        <!--VISUALIZAR IMAGENES EN COMPUTADORAS-->
                                        <div class="col-8 col-lg-3 d-none d-lg-block" id="col_computador">
                                            <hr class="my-5">
                                            <h4><b><i>Imágenes del vehículo</i></b>
                                                <i class="fas fa-shuttle-van"></i>
                                            </h4>
                                            <div id="col_fotos_inventario1">
                                            </div>
                                        </div>

                                        <!--VISUALIZAR IMAGENES EN CELULARES Y TABLETS  -->
                                        <div class="col-12 col-sm-8 col-md-6 d-lg-none" id="col_celulares">
                                            <hr class="my-5">
                                            <h4><b><i>Imágenes del vehículo</i></b> <i class="fas fa-shuttle-van"></i></h4>

                                            <div id="col_fotos_inventario" class="col-12 carousel slide" data-ride="carousel">
                                                <ol class="carousel-indicators">
                                                    <!-- SE LLENA DESDE JAVASCRIPT -->
                                                </ol>
                                                <div class="carousel-inner text-center">
                                                    <!-- SE LLENA DESDE JAVASCRIPT -->
                                                </div>
                                                <a class="carousel-control-prev" href="#col_fotos_inventario" role="button" data-slide="prev">
                                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                    <span class="sr-only">Previous</span>
                                                </a>
                                                <a class="carousel-control-next" href="#col_fotos_inventario" role="button" data-slide="next">
                                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                    <span class="sr-only">Next</span>
                                                </a>
                                            </div>
                                        </div>
                                        <!--COL DATOS INVENTARIO-->
                                        <div class="col-12 col-lg">
                                            <!-- /.ESTE ES EL TAB MADRE DEL CUESTIONARIO-->
                                            <div class="tab-content" id="vert-tabs-tabContent">
                                                <div class="tab-pane text-left fade active show" id="vert-tabs-homesaman" role="tabpanel" aria-labelledby="vert-tabs-homesaman-tab">

                                                    <hr class="my-5">
                                                    <!--FORMULARIO INVENTARIO-->
                                                    <form method="post" enctype="multipart/form-data" id="formulario_inventario">

                                                        <div class="row">
                                                            <div class="col">

                                                                <!--PLACA-->
                                                                <div class="col">
                                                                    <div class="form-group">
                                                                        <label for=""><b><i>Placa</i></b></label>
                                                                        <div class="input-group">
                                                                            <select id="placa_invent" class="form-control select2-single inventario" name="idvehiculo" style="width: 99%" required>
                                                                                <option value="" selected>-Seleccione la placa deseada-</option>
                                                                                <?php foreach ($Vehiculos as $key => $value) : ?>
                                                                                    <option value="<?= $value['idvehiculo'] ?>"><?= $value['placa'] ?> - <?= $value['numinterno'] ?></option>
                                                                                <?php endforeach ?>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!--TIPO VEHICULO-->
                                                                <div class="col">
                                                                    <div class="form-group">
                                                                        <label for="tipo_vel">Tipo de vehículo</label>
                                                                        <div class="input-group">
                                                                            <div class="input-group-prepend">
                                                                                <span class="input-group-text"><i class="fas fa-bus"></i></span>
                                                                            </div>
                                                                            <select id="tipo_vel" class="form-control inventario" name="tipo_vel" readonly>
                                                                                <option>-Seleccione el tipo de vehículo-</option>
                                                                                <?php foreach ($TipoVehiculos as $key => $value) : ?>
                                                                                    <option value="<?= $value['idtipovehiculo'] ?>"><?= $value['tipovehiculo'] ?></option>
                                                                                <?php endforeach ?>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!--N INTERNO-->
                                                                <div class="col">
                                                                    <div class="form-group">
                                                                        <label for="numinter_invent">Num. interno</label>
                                                                        <div class="input-group">
                                                                            <div class="input-group-prepend">
                                                                                <span class="input-group-text"><i class="fas fa-hashtag"></i></span>
                                                                            </div>
                                                                            <input class="form-control inventario" type="number" id="numinter_invent" name="numinter_invent" readonly>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!--MARCA-->
                                                                <div class="col">
                                                                    <div class="form-group">
                                                                        <label for="marca_invent">Marca</label>
                                                                        <div class="input-group">
                                                                            <div class="input-group-prepend">
                                                                                <span class="input-group-text"><i class="far fa-registered"></i></span>
                                                                            </div>
                                                                            <select id="marca_invent" class="form-control inventario" name="marca_invent" readonly>
                                                                                <option>-Marca del vehículo-</option>
                                                                                <?php foreach ($marca as $key => $value) : ?>
                                                                                    <option value="<?= $value['idmarca'] ?>"><?= $value['marca'] ?></option>
                                                                                <?php endforeach ?>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!--MODELO-->
                                                                <div class="col">
                                                                    <div class="form-group">
                                                                        <label for="modelo_invent">Modelo</label>
                                                                        <div class="input-group">
                                                                            <div class="input-group-prepend">
                                                                                <span class="input-group-text"><i class="fas fa-bus"></i></span>
                                                                            </div>
                                                                            <input class="form-control inventario" type="text" id="modelo_invent" name="modelo_invent" readonly>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col">

                                                                <input type="hidden" id="observador_conductoresInventario" idconductor="">
                                                                <input type="hidden" id="inventario_id" name="inventario_id" value="">

                                                                <!--CONDUCTOR-->
                                                                <div class="col">
                                                                    <div class="form-group">
                                                                        <label for="conductor_invent"><b><i>Conductor</i></b></label>
                                                                        <div class="input-group">
                                                                            <select id="conductor_invent" class="form-control select2-single conductores" name="idconductor" style="width: 99%" required>
                                                                                <option value="" selected>-Seleccione un conductor</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!--CATEGORIA LICENCIA-->
                                                                <div class="col">
                                                                    <div class="form-group">
                                                                        <label for="categoria_invent">Categoria de licencia</label>
                                                                        <div class="input-group">
                                                                            <div class="input-group-prepend">
                                                                                <span class="input-group-text"><i class="far fa-list-alt"></i></span>
                                                                            </div>
                                                                            <input class="form-control inventario" type="text" id="categoria_invent" name="categoria_invent" readonly>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!--VENCIMIENTO DE LICENCIA-->
                                                                <div class="col">
                                                                    <div class="form-group">
                                                                        <label for="vencimineto_inventario">Vencimiento de licencia</label>
                                                                        <div class="input-group">
                                                                            <div class="input-group-prepend">
                                                                                <span class="input-group-text"><i class="far fa-calendar-times"></i></span>
                                                                            </div>
                                                                            <input class="form-control inventario" type="date" id="vencimineto_inventario" name="vencimineto_inventario" readonly>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!--KILOMETRAJE-->
                                                                <div class="col">
                                                                    <div class="form-group">
                                                                        <label for="kilo_invent">Kilometraje (km)</label>
                                                                        <div class="input-group">
                                                                            <div class="input-group-prepend">
                                                                                <span class="input-group-text"><i class="fas fa-tachometer-alt"></i></span>
                                                                            </div>
                                                                            <input class="form-control inventario" type="number" id="kilo_invent" max="9999" name="kilometraje" required>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!--FECHA INVENTARIO-->
                                                                <div class="col">
                                                                    <div class="form-group">
                                                                        <label for="fecha_invent">Fecha</label>
                                                                        <div class="input-group">
                                                                            <div class="input-group-prepend">
                                                                                <span class="input-group-text"><i class="fas fa-calendar-week"></i></span>
                                                                            </div>
                                                                            <input class="form-control inventario" type="date" id="fecha_invent" name="fecha_inventario" required>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <br>
                                                                <!--ENTREGA RECIBE-->
                                                                <div class="col">
                                                                    <div class="form-check form-check-inline">
                                                                        <input class="form-check-input inventario" type="radio" value="8" id="entrega_invent" name="recepcion_entrega_vehiculo" required>
                                                                        <label class="form-check-label text-nowrap" for="defaultCheck1">
                                                                            <b>ENTREGA DE VEHÍCULO</b>
                                                                        </label>
                                                                    </div>

                                                                    <div class="form-check form-check-inline">
                                                                        <input class="form-check-input inventario" type="radio" value="9" id="recep_invent" name="recepcion_entrega_vehiculo" required>
                                                                        <label class="form-check-label text-nowrap" for="defaultCheck2">
                                                                            <b>RECEPCIÓN DE VEHÍCULO</b>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--FIN ROW - DATOS INVENTARIO-->

                                                        <hr class="my-4 bg-dark">

                                                        <div class="row">
                                                            <!--TITULO DOCUMENTOS VEHICULOS-->
                                                            <div class="col">
                                                                <div class="form-group">
                                                                    <div class="input-group">
                                                                        <h4><b><i>Documentos vehículo</i></b></h4>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--TIPOS DE DOCUMENTOS-->
                                                        <div class="row">
                                                            <?php foreach ($tiposDocumentacion as $key => $value) : ?>
                                                                <div class="col-12 col-sm-6 col-lg-4">
                                                                    <div class="form-group">
                                                                        <label><?= $value['tipodocumento'] ?></label>
                                                                        <input id="documento_<?= $value['idtipo'] ?>" type="date" class="form-control documentos" readonly>
                                                                    </div>
                                                                </div>
                                                            <?php endforeach ?>
                                                        </div>

                                                        <hr class="my-4 bg-dark">
                                                        <!--TITULO INVENTARIO-->
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <div class="input-group">
                                                                    <h4><b><i>Inventario</i></b></h4>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--TABS DE INVENTARIO-->
                                                        <div class="row">
                                                            <div class="col">
                                                                <!--INVENTARIO - SELECCION-->
                                                                <div class="card card-info card-tabs">
                                                                    <!--HEADER-->
                                                                    <div class="card-header p-0 pt-1">
                                                                        <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist" style="text-decoration: none;">
                                                                            <li class="pt-2 px-3">
                                                                                <h3 class="card-title">Registro</h3>
                                                                            </li>
                                                                            <li class="nav-item">
                                                                                <a class="nav-link active" id="custom-tabs-one-lamina-tab" data-toggle="pill" href="#custom-tabs-one-lamina" role="tab" aria-controls="custom-tabs-one-lamina" aria-selected="true">Láminas</a>
                                                                            </li>
                                                                            <li class="nav-item">
                                                                                <a class="nav-link" id="custom-tabs-one-vidriosespejos-tab" data-toggle="pill" href="#custom-tabs-one-vidriosespejos" role="tab" aria-controls="custom-tabs-one-vidriosespejos" aria-selected="false">Vidrios y espejos</a>
                                                                            </li>
                                                                            <li class="nav-item">
                                                                                <a class="nav-link" id="custom-tabs-one-luces-tab" data-toggle="pill" href="#custom-tabs-one-luces" role="tab" aria-controls="custom-tabs-one-luces" aria-selected="false">Luces</a>
                                                                            </li>
                                                                            <li class="nav-item">
                                                                                <a class="nav-link" id="custom-tabs-one-llantas-tab" data-toggle="pill" href="#custom-tabs-one-llantas" role="tab" aria-controls="custom-tabs-one-llantas" aria-selected="false">Llantas</a>
                                                                            </li>
                                                                            <li class="nav-item">
                                                                                <a class="nav-link" id="custom-tabs-one-preveseguridad-tab" data-toggle="pill" href="#custom-tabs-one-preveseguridad" role="tab" aria-controls="custom-tabs-one-preveseguridad" aria-selected="false">Prevención y Seguridad</a>
                                                                            </li>
                                                                            <li class="nav-item">
                                                                                <a class="nav-link" id="custom-tabs-one-accesorios-tab" data-toggle="pill" href="#custom-tabs-one-accesorios" role="tab" aria-controls="custom-tabs-one-accesorios" aria-selected="false">Accesorios</a>
                                                                            </li>
                                                                            <li class="nav-item">
                                                                                <a class="nav-link" id="custom-tabs-one-emblemas-tab" data-toggle="pill" href="#custom-tabs-one-emblemas" role="tab" aria-controls="custom-tabs-one-emblemas" aria-selected="false">Emblemas</a>
                                                                            </li>
                                                                            <li class="nav-item">
                                                                                <a class="nav-link" id="custom-tabs-one-otros-tab" data-toggle="pill" href="#custom-tabs-one-otros" role="tab" aria-controls="custom-tabs-one-otros" aria-selected="false">Otros</a>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                    <!--BODY-->
                                                                    <div class="card-body">
                                                                        <div class="tab-content" id="custom-tabs-one-tabContent">
                                                                            <!-- /.TAB DE LAMINAS -->
                                                                            <div class="tab-pane fade active show" id="custom-tabs-one-lamina" role="tabpanel" aria-labelledby="custom-tabs-one-lamina-tab">

                                                                                <div class="row">
                                                                                    <div class="col">
                                                                                        <!--TABLA LAMINAS-->
                                                                                        <div class="p-3 table-responsive">
                                                                                            <table class="table table-bordered text-center text-nowrap" nombre="Láminas">
                                                                                                <tbody>
                                                                                                    <tr>
                                                                                                        <td><b>LÁMINAS</b></td>
                                                                                                        <td style="width: 15px;">Bueno</td>
                                                                                                        <td style="width: 15px;">Rayado</td>
                                                                                                        <td style="width: 15px;">Golpe</td>
                                                                                                    </tr>
                                                                                                    <!--TECHO EXTERIOR-->
                                                                                                    <tr>
                                                                                                        <td>Techo exterior</td>
                                                                                                        <td>
                                                                                                            <div class="icheck-success d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="Techo_exterior1" name="Techo_exterior" value="1">
                                                                                                                <label for="Techo_exterior1">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <div class="icheck-warning d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="Techo_exterior4" name="Techo_exterior" value="4">
                                                                                                                <label for="Techo_exterior4">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <div class="icheck-danger d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="Techo_exterior5" name="Techo_exterior" value="5">
                                                                                                                <label for="Techo_exterior5">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <!--TECHO INTERIOR-->
                                                                                                    <tr>
                                                                                                        <td>Techo interior</td>
                                                                                                        <td>
                                                                                                            <div class="icheck-success d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="Techo_interior1" name="Techo_interior" value="1">
                                                                                                                <label for="Techo_interior1">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <div class="icheck-warning d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="Techo_interior4" name="Techo_interior" value="4">
                                                                                                                <label for="Techo_interior4">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <div class="icheck-danger d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="Techo_interior5" name="Techo_interior" value="5">
                                                                                                                <label for="Techo_interior5">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <!--FRENTE-->
                                                                                                    <tr>
                                                                                                        <td>Frente</td>
                                                                                                        <td>
                                                                                                            <div class="icheck-success d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="Frente1" name="Frente" value="1">
                                                                                                                <label for="Frente1">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <div class="icheck-warning d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="Frente4" name="Frente" value="4">
                                                                                                                <label for="Frente4">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <div class="icheck-danger d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="Frente5" name="Frente" value="5">
                                                                                                                <label for="Frente5">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <!--BOMPER DELANTERO-->
                                                                                                    <tr>
                                                                                                        <td>Bomper delantero</td>
                                                                                                        <td>
                                                                                                            <div class="icheck-success d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="Bomper_delantero1" name="Bomper_delantero" value="1">
                                                                                                                <label for="Bomper_delantero1">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <div class="icheck-warning d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="Bomper_delantero4" name="Bomper_delantero" value="4">
                                                                                                                <label for="Bomper_delantero4">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <div class="icheck-danger d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="Bomper_delantero5" name="Bomper_delantero" value="5">
                                                                                                                <label for="Bomper_delantero5">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <!--BOMBER TRASERO-->
                                                                                                    <tr>
                                                                                                        <td>Bomper trasero</td>
                                                                                                        <td>
                                                                                                            <div class="icheck-success d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="Bomper_trasero1" name="Bomper_trasero" value="1">
                                                                                                                <label for="Bomper_trasero1">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <div class="icheck-warning d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="Bomper_trasero4" name="Bomper_trasero" value="4">
                                                                                                                <label for="Bomper_trasero4">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <div class="icheck-danger d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="Bomper_trasero5" name="Bomper_trasero" value="5">
                                                                                                                <label for="Bomper_trasero5">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <!--LATERAL DERECHO-->
                                                                                                    <tr>
                                                                                                        <td>Lateral derecho</td>
                                                                                                        <td>
                                                                                                            <div class="icheck-success d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="Lateral_derecho1" name="Lateral_derecho" value="1">
                                                                                                                <label for="Lateral_derecho1">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <div class="icheck-warning d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="Lateral_derecho4" name="Lateral_derecho" value="4">
                                                                                                                <label for="Lateral_derecho4">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <div class="icheck-danger d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="Lateral_derecho5" name="Lateral_derecho" value="5">
                                                                                                                <label for="Lateral_derecho5">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <!--LATERAL IZQUIERDO-->
                                                                                                    <tr>
                                                                                                        <td>Lateral izquierdo</td>
                                                                                                        <td>
                                                                                                            <div class="icheck-success d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="Lateral_izquierdo1" name="Lateral_izquierdo" value="1">
                                                                                                                <label for="Lateral_izquierdo1">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <div class="icheck-warning d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="Lateral_izquierdo4" name="Lateral_izquierdo" value="4">
                                                                                                                <label for="Lateral_izquierdo4">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <div class="icheck-danger d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="Lateral_izquierdo5" name="Lateral_izquierdo" value="5">
                                                                                                                <label for="Lateral_izquierdo5">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <!--PUERTA DERECHA-->
                                                                                                    <tr>
                                                                                                        <td>Puerta derecha</td>
                                                                                                        <td>
                                                                                                            <div class="icheck-success d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="Puerta_derecho1" name="puerta_derecha" value="1">
                                                                                                                <label for="Puerta_derecho1">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <div class="icheck-warning d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="Puerta_derecho4" name="puerta_derecha" value="4">
                                                                                                                <label for="Puerta_derecho4">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <div class="icheck-danger d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="Puerta_derecho5" name="puerta_derecha" value="5">
                                                                                                                <label for="Puerta_derecho5">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <!--PUERTA IZQUIERDA-->
                                                                                                    <tr>
                                                                                                        <td>Puerta izquierda</td>
                                                                                                        <td>
                                                                                                            <div class="icheck-success d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="Puerta_izquierda1" name="Puerta_izquierda" value="1">
                                                                                                                <label for="Puerta_izquierda1">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <div class="icheck-warning d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="Puerta_izquierda4" name="Puerta_izquierda" value="4">
                                                                                                                <label for="Puerta_izquierda4">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <div class="icheck-danger d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="Puerta_izquierda5" name="Puerta_izquierda" value="5">
                                                                                                                <label for="Puerta_izquierda5">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                </tbody>
                                                                                            </table>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <!-- /.TAB VIDRIOS Y ESPEJOS -->
                                                                            <div class="tab-pane fade" id="custom-tabs-one-vidriosespejos" role="tabpanel" aria-labelledby="custom-tabs-one-vidriosespejos-tab">

                                                                                <div class="row">
                                                                                    <div class="col">
                                                                                        <div class="p-3 table-responsive">
                                                                                            <table class="table table-bordered text-center text-nowrap" nombre="Vidrios y espejos">
                                                                                                <tbody>
                                                                                                    <tr>
                                                                                                        <td colspan="1"><b>VIDRIOS Y ESPEJOS</b></td>
                                                                                                        <td style="width: 15px;">Bueno</td>
                                                                                                        <td style="width: 15px;">Malo</td>
                                                                                                    </tr>
                                                                                                    <!--PARABRISAS IZQUIERDO-->
                                                                                                    <tr>
                                                                                                        <td>Parabrisas izquierdo</td>
                                                                                                        <td>
                                                                                                            <div class="icheck-success d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="parabrisas_izquierdo1" name="Parabrisas_izquierdo" value="1">
                                                                                                                <label for="parabrisas_izquierdo1">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <div class="icheck-danger d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="parabrisas_izquierdo2" name="Parabrisas_izquierdo" value="0">
                                                                                                                <label for="parabrisas_izquierdo2">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <!--PARABRISAS DERECHO-->
                                                                                                    <tr>
                                                                                                        <td>Parabrisas derecho</td>
                                                                                                        <td>
                                                                                                            <div class="icheck-success d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="parabrisas_derecho1" name="Parabrisas_derecho" value="1">
                                                                                                                <label for="parabrisas_derecho1">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <div class="icheck-danger d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="parabrisas_derecho2" name="Parabrisas_derecho" value="0">
                                                                                                                <label for="parabrisas_derecho2">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <!--ESPEJO RETROVISOR DERECHO-->
                                                                                                    <tr>
                                                                                                        <td>Espejo retrovisor derecho</td>
                                                                                                        <td>
                                                                                                            <div class="icheck-success d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="Espejo_retrovisor_derecho1" name="Espejo_retrovisor_derecho" value="1">
                                                                                                                <label for="Espejo_retrovisor_derecho1">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <div class="icheck-danger d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="Espejo_retrovisor_derecho2" name="Espejo_retrovisor_derecho" value="0">
                                                                                                                <label for="Espejo_retrovisor_derecho2">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <!--ESPEJO RETROVISOR IZQUIERDO-->
                                                                                                    <tr>
                                                                                                        <td>Espejo retrovisor izquierdo</td>
                                                                                                        <td>
                                                                                                            <div class="icheck-success d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="Espejo_retrovisor_izquierdo1" name="Espejo_retrovisor_izquierdo" value="1">
                                                                                                                <label for="Espejo_retrovisor_izquierdo1">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <div class="icheck-danger d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="Espejo_retrovisor_izquierdo2" name="Espejo_retrovisor_izquierdo" value="0">
                                                                                                                <label for="Espejo_retrovisor_izquierdo2">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <!--VIDRIOS VENTANAS LATERAL DERECHO-->
                                                                                                    <tr>
                                                                                                        <td>Vidrios ventanas lateral derecho</td>
                                                                                                        <td>
                                                                                                            <div class="icheck-success d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="Vidrios_ventanas_lateral_derecho1" name="Vidrios_ventanas_lateral_derecho" value="1">
                                                                                                                <label for="Vidrios_ventanas_lateral_derecho1">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <div class="icheck-danger d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="Vidrios_ventanas_lateral_derecho2" name="Vidrios_ventanas_lateral_derecho" value="0">
                                                                                                                <label for="Vidrios_ventanas_lateral_derecho2">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <!--VIDRIOS VENTANAS LATERAL IZQUIERDO-->
                                                                                                    <tr>
                                                                                                        <td>Vidrios ventanas lateral izquierdo</td>
                                                                                                        <td>
                                                                                                            <div class="icheck-success d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="Vidrios_ventanas_lateral_izquierdo1" name="Vidrios_ventanas_lateral_izquierdo" value="1">
                                                                                                                <label for="Vidrios_ventanas_lateral_izquierdo1">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <div class="icheck-danger d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="Vidrios_ventanas_lateral_izquierdo2" name="Vidrios_ventanas_lateral_izquierdo" value="0">
                                                                                                                <label for="Vidrios_ventanas_lateral_izquierdo2">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <!--PARABRISAS TRASERO-->
                                                                                                    <tr>
                                                                                                        <td>Parabrisas trasero</td>
                                                                                                        <td>
                                                                                                            <div class="icheck-success d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="Parabrisas_trasero1" name="parabrisas_trasero" value="1">
                                                                                                                <label for="Parabrisas_trasero1">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <div class="icheck-danger d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="Parabrisas_trasero2" name="parabrisas_trasero" value="0">
                                                                                                                <label for="Parabrisas_trasero2">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <!--VIDRIOS DE PUERTAS-->
                                                                                                    <tr>
                                                                                                        <td>Vidrios de puertas</td>
                                                                                                        <td>
                                                                                                            <div class="icheck-success d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="Vidrios_puertas1" name="Vidrios_puertas" value="1">
                                                                                                                <label for="Vidrios_puertas1">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <div class="icheck-danger d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="Vidrios_puertas2" name="Vidrios_puertas" value="0">
                                                                                                                <label for="Vidrios_puertas2">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                </tbody>
                                                                                            </table>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <!-- /.TAB DE LUCES -->
                                                                            <div class="tab-pane fade" id="custom-tabs-one-luces" role="tabpanel" aria-labelledby="custom-tabs-one-luces-tab">

                                                                                <div class="row">
                                                                                    <div class="col">
                                                                                        <div class="p-3 table-responsive">
                                                                                            <table class="table table-bordered text-center text-nowrap" nombre="Luces">
                                                                                                <tbody>
                                                                                                    <tr>
                                                                                                        <td colspan="1"><b>LUCES</b></td>
                                                                                                        <td style="width: 15px;">Bueno</td>
                                                                                                        <td style="width: 15px;">Malo</td>
                                                                                                        <td style="width: 15px;">N/A</td>
                                                                                                    </tr>
                                                                                                    <!--DIRECCIONAL DELANTERA IZQUIERDA-->
                                                                                                    <tr>
                                                                                                        <td>Direccional delantera izquierda</td>
                                                                                                        <td>
                                                                                                            <div class="icheck-success d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="Direccional_izquierda1" name="Direccional_delantera_izquierda" value="1">
                                                                                                                <label for="Direccional_izquierda1">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <div class="icheck-danger d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="Direccional_izquierda4" name="Direccional_delantera_izquierda" value="0">
                                                                                                                <label for="Direccional_izquierda4">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <div class="icheck-secondary d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="Direccional_izquierda5" name="Direccional_delantera_izquierda" value="2">
                                                                                                                <label for="Direccional_izquierda5">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <!--DIRECCIONAL DELANTERA DERECHA-->
                                                                                                    <tr>
                                                                                                        <td>Direccional delantera derecha</td>
                                                                                                        <td>
                                                                                                            <div class="icheck-success d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="Direccional_derecha1" name="Direccional_delantera_derecha" value="1">
                                                                                                                <label for="Direccional_derecha1">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <div class="icheck-danger d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="Direccional_derecha4" name="Direccional_delantera_derecha" value="0">
                                                                                                                <label for="Direccional_derecha4">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <div class="icheck-secondary d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="Direccional_derecha5" name="Direccional_delantera_derecha" value="2">
                                                                                                                <label for="Direccional_derecha5">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <!--STOP TRASERO DERECHO-->
                                                                                                    <tr>
                                                                                                        <td>Stop trasero derecho</td>
                                                                                                        <td>
                                                                                                            <div class="icheck-success d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="Stop_trasero_derecho1" name="Stop_trasero_derecho" value="1">
                                                                                                                <label for="Stop_trasero_derecho1">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <div class="icheck-danger d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="Stop_trasero_derecho4" name="Stop_trasero_derecho" value="0">
                                                                                                                <label for="Stop_trasero_derecho4">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <div class="icheck-secondary d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="Stop_trasero_derecho5" name="Stop_trasero_derecho" value="2">
                                                                                                                <label for="Stop_trasero_derecho5">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <!--STOP TRASERO IZQUIERDO-->
                                                                                                    <tr>
                                                                                                        <td>Stop trasero izquierdo</td>
                                                                                                        <td>
                                                                                                            <div class="icheck-success d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="Stop_trasero_izquierdo1" name="Stop_trasero_izquierdo" value="1">
                                                                                                                <label for="Stop_trasero_izquierdo1">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <div class="icheck-danger d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="Stop_trasero_izquierdo4" name="Stop_trasero_izquierdo" value="0">
                                                                                                                <label for="Stop_trasero_izquierdo4">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <div class="icheck-secondary d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="Stop_trasero_izquierdo5" name="Stop_trasero_izquierdo" value="2">
                                                                                                                <label for="Stop_trasero_izquierdo5">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <!--CUCUYO LATERAL DERECHO-->
                                                                                                    <tr>
                                                                                                        <td>Cucuyo lateral derecho</td>
                                                                                                        <td>
                                                                                                            <div class="icheck-success d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="Cucuyo_lateral_derecho1" name="Cucuyo_lateral_derecho" value="1">
                                                                                                                <label for="Cucuyo_lateral_derecho1">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <div class="icheck-danger d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="Cucuyo_lateral_derecho4" name="Cucuyo_lateral_derecho" value="0">
                                                                                                                <label for="Cucuyo_lateral_derecho4">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <div class="icheck-secondary d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="Cucuyo_lateral_derecho5" name="Cucuyo_lateral_derecho" value="2">
                                                                                                                <label for="Cucuyo_lateral_derecho5">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <!--CUCUYO LATERAL IZQUIERDO-->
                                                                                                    <tr>
                                                                                                        <td>Cucuyo lateral izquierdo</td>
                                                                                                        <td>
                                                                                                            <div class="icheck-success d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="Cucuyo_lateral_izquierdo1" name="Cucuyo_lateral_izquierdo" value="1">
                                                                                                                <label for="Cucuyo_lateral_izquierdo1">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <div class="icheck-danger d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="Cucuyo_lateral_izquierdo4" name="Cucuyo_lateral_izquierdo" value="0">
                                                                                                                <label for="Cucuyo_lateral_izquierdo4">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <div class="icheck-secondary d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="Cucuyo_lateral_izquierdo5" name="Cucuyo_lateral_izquierdo" value="2">
                                                                                                                <label for="Cucuyo_lateral_izquierdo5">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <!--LUCES INTERNAS-->
                                                                                                    <tr>
                                                                                                        <td>
                                                                                                            <div class="col">
                                                                                                                <div class="form-group">
                                                                                                                    <div class="input-group">
                                                                                                                        <div class="input-group-prepend">
                                                                                                                            <span class="input-group-text">Luces internas</span>
                                                                                                                        </div>
                                                                                                                        <input class="form-control" type="number" id="numero_luces" name="numero_luces_internas" max="9999" placeholder="Digite el número de luces">
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <div class="icheck-success d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="Luces_internas1" name="Luces_internas" value="1">
                                                                                                                <label for="Luces_internas1">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <div class="icheck-danger d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="Luces_internas4" name="Luces_internas" value="0">
                                                                                                                <label for="Luces_internas4">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <div class="icheck-secondary d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="Luces_internas5" name="Luces_internas" value="2">
                                                                                                                <label for="Luces_internas5">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <!--BALIZAS-->
                                                                                                    <tr class="input-camioneta">
                                                                                                        <td>Balizas ( Licuadoras )</td>
                                                                                                        <td>
                                                                                                            <div class="icheck-success d-inline">
                                                                                                                <input type="radio" class="form-control inventario camioneta" required id="Balizas1" name="balizas" value="1">
                                                                                                                <label for="Balizas1">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <div class="icheck-danger d-inline">
                                                                                                                <input type="radio" class="form-control inventario camioneta" required id="Balizas4" name="balizas" value="0">
                                                                                                                <label for="Balizas4">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <div class="icheck-secondary d-inline">
                                                                                                                <input type="radio" class="form-control inventario camioneta" required id="Balizas5" name="balizas" value="2">
                                                                                                                <label for="Balizas5">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                </tbody>
                                                                                            </table>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <!-- /.TAB DE LLANTAS -->
                                                                            <div class="tab-pane fade" id="custom-tabs-one-llantas" role="tabpanel" aria-labelledby="custom-tabs-one-llantas-tab">

                                                                                <div class="row">
                                                                                    <div class="col">
                                                                                        <div class="p-3 table-responsive">
                                                                                            <table class="table table-bordered text-center text-nowrap" nombre="Llantas">
                                                                                                <tbody>
                                                                                                    <tr>
                                                                                                        <td colspan="1"><b>LLANTAS</b></td>
                                                                                                        <td style="width: 15px;">Regular</td>
                                                                                                        <td style="width: 15px;">Bueno</td>
                                                                                                        <td style="width: 15px;">Malo</td>
                                                                                                    </tr>
                                                                                                    <!--DELANTERA IZQUIERDA-->
                                                                                                    <tr>
                                                                                                        <td>Delantera izquierda ( R1 )</td>
                                                                                                        <td>
                                                                                                            <div class="icheck-warning d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="Delantera_izquierda_R11" name="Delantera_izquierda_R1" value="3">
                                                                                                                <label for="Delantera_izquierda_R11">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <div class="icheck-success d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="Delantera_izquierda_R14" name="Delantera_izquierda_R1" value="1">
                                                                                                                <label for="Delantera_izquierda_R14">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <div class="icheck-danger d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="Delantera_izquierda_R15" name="Delantera_izquierda_R1" value="0">
                                                                                                                <label for="Delantera_izquierda_R15">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <!--DELANTERA DERECHA-->
                                                                                                    <tr>
                                                                                                        <td>Delantera derecha ( R2 )</td>
                                                                                                        <td>
                                                                                                            <div class="icheck-warning d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="Delantera_derecha_R21" name="Delantera_derecha_R2" value="3">
                                                                                                                <label for="Delantera_derecha_R21">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <div class="icheck-success d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="Delantera_izquierda_R24" name="Delantera_derecha_R2" value="1">
                                                                                                                <label for="Delantera_izquierda_R24">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <div class="icheck-danger d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="Delantera_izquierda_R25" name="Delantera_derecha_R2" value="0">
                                                                                                                <label for="Delantera_izquierda_R25">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <!--TRASERA INTERIOR IZQUIERDA-->
                                                                                                    <tr>
                                                                                                        <td>Trasera interior izquierda ( R3 )</td>
                                                                                                        <td>
                                                                                                            <div class="icheck-warning d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="Trasera_interior_izquierda_R31" name="Trasera_interior_izquierda_R3" value="3">
                                                                                                                <label for="Trasera_interior_izquierda_R31">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <div class="icheck-success d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="Trasera_interior_izquierda_R34" name="Trasera_interior_izquierda_R3" value="1">
                                                                                                                <label for="Trasera_interior_izquierda_R34">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <div class="icheck-danger d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="Trasera_interior_izquierda_R3_5" name="Trasera_interior_izquierda_R3" value="0">
                                                                                                                <label for="Trasera_interior_izquierda_R3_5">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <!--TRASERA EXTERIOR IZQUIERDA-->
                                                                                                    <tr>
                                                                                                        <td>Trasera exterior izquierda ( R4 )</td>
                                                                                                        <td>
                                                                                                            <div class="icheck-warning d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="Trasera_exterior_izquierda_R41" name="Trasera_exterior_izquierda_R4" value="3">
                                                                                                                <label for="Trasera_exterior_izquierda_R41">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <div class="icheck-success d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="Trasera_exterior_izquierda_R44" name="Trasera_exterior_izquierda_R4" value="1">
                                                                                                                <label for="Trasera_exterior_izquierda_R44">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <div class="icheck-danger d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="Trasera_exterior_izquierda_R4_5" name="Trasera_exterior_izquierda_R4" value="0">
                                                                                                                <label for="Trasera_exterior_izquierda_R4_5">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <!--TRASERA INTERIOR DERECHA-->
                                                                                                    <tr class="input-camioneta">
                                                                                                        <td>Trasera interior derecha ( R5 )</td>
                                                                                                        <td>
                                                                                                            <div class="icheck-warning d-inline">
                                                                                                                <input type="radio" class="form-control inventario camioneta" required id="Trasera_interior_derecha_R51" name="Trasera_interior_derecha_R5" value="3">
                                                                                                                <label for="Trasera_interior_derecha_R51">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <div class="icheck-success d-inline">
                                                                                                                <input type="radio" class="form-control inventario camioneta" required id="Trasera_interior_derecha_R54" name="Trasera_interior_derecha_R5" value="1">
                                                                                                                <label for="Trasera_interior_derecha_R54">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <div class="icheck-danger d-inline">
                                                                                                                <input type="radio" class="form-control inventario camioneta" required id="Trasera_interior_derecha_R55" name="Trasera_interior_derecha_R5" value="0">
                                                                                                                <label for="Trasera_interior_derecha_R55">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <!--TRASERA EXTERIOR DERECHA-->
                                                                                                    <tr class="input-camioneta">
                                                                                                        <td>Trasera exterior derecha ( R6 )</td>
                                                                                                        <td>
                                                                                                            <div class="icheck-warning d-inline">
                                                                                                                <input type="radio" class="form-control inventario camioneta" required id="Trasera_exterior_derecha_R61" name="Trasera_exterior_derecha_R6" value="3">
                                                                                                                <label for="Trasera_exterior_derecha_R61">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <div class="icheck-success d-inline">
                                                                                                                <input type="radio" class="form-control inventario camioneta" required id="Trasera_exterior_derecha_R64" name="Trasera_exterior_derecha_R6" value="1">
                                                                                                                <label for="Trasera_exterior_derecha_R64">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <div class="icheck-danger d-inline">
                                                                                                                <input type="radio" class="form-control inventario camioneta" required id="Trasera_exterior_derecha_R65" name="Trasera_exterior_derecha_R6" value="0">
                                                                                                                <label for="Trasera_exterior_derecha_R65">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                </tbody>
                                                                                            </table>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <!-- /.TAB DE PREVENCION Y SEGURIDAD -->
                                                                            <div class="tab-pane fade" id="custom-tabs-one-preveseguridad" role="tabpanel" aria-labelledby="custom-tabs-one-preveseguridad-tab">
                                                                                <div class="row">
                                                                                    <div class="col">
                                                                                        <div class="p-3 table-responsive">
                                                                                            <table class="table table-bordered text-center text-nowrap" nombre="Equipo de prevención y seguridad">
                                                                                                <tbody>
                                                                                                    <tr>
                                                                                                        <td colspan="1"><b>EQUIPO DE PREVENCIÓN Y SEGURIDAD</b></td>
                                                                                                        <td style="width: 15px;">Si</td>
                                                                                                        <td style="width: 15px;">No</td>
                                                                                                    </tr>
                                                                                                    <!--GATO-->
                                                                                                    <tr>
                                                                                                        <td>Gato</td>
                                                                                                        <td>
                                                                                                            <div class="icheck-success d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="Gato1" name="Gato" value="6">
                                                                                                                <label for="Gato1">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <div class="icheck-danger d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="Gato2" name="Gato" value="7">
                                                                                                                <label for="Gato2">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <!--CRUCETA COPA-->
                                                                                                    <tr>
                                                                                                        <td>Cruceta o Copa</td>
                                                                                                        <td>
                                                                                                            <div class="icheck-success d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="Cruceta__Copa1" name="Cruceta_Copa" value="6">
                                                                                                                <label for="Cruceta__Copa1">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <div class="icheck-danger d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="Cruceta__Copa2" name="Cruceta_Copa" value="7">
                                                                                                                <label for="Cruceta__Copa2">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <!--CONOS TRIANGULOS-->
                                                                                                    <tr>
                                                                                                        <td>2 Conos o Triángulos</td>
                                                                                                        <td>
                                                                                                            <div class="icheck-success d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="2Conos__Triangulos1" name="2Conos_Triangulos" value="6">
                                                                                                                <label for="2Conos__Triangulos1">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <div class="icheck-danger d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="2Conos__Triangulos2" name="2Conos_Triangulos" value="7">
                                                                                                                <label for="2Conos__Triangulos2">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <!--BOTIQUIN-->
                                                                                                    <tr>
                                                                                                        <td>Botiquín</td>
                                                                                                        <td>
                                                                                                            <div class="icheck-success d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="Botiquin1" name="Botiquin" value="6">
                                                                                                                <label for="Botiquin1">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <div class="icheck-danger d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="Botiquin2" name="Botiquin" value="7">
                                                                                                                <label for="Botiquin2">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <!--EXTINTOR-->
                                                                                                    <tr>
                                                                                                        <td>Extintor</td>
                                                                                                        <td>
                                                                                                            <div class="icheck-success d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="Extintor1" name="Extintor" value="6">
                                                                                                                <label for="Extintor1">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <div class="icheck-danger d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="Extintor2" name="Extintor" value="7">
                                                                                                                <label for="Extintor2">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <!--TACOS O BLOQUES-->
                                                                                                    <tr>
                                                                                                        <td>2 Tacos o Bloques</td>
                                                                                                        <td>
                                                                                                            <div class="icheck-success d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="2Tacos_Bloques1" name="2Tacos_Bloques" value="6">
                                                                                                                <label for="2Tacos_Bloques1">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <div class="icheck-danger d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="2Tacos_Bloques2" name="2Tacos_Bloques" value="7">
                                                                                                                <label for="2Tacos_Bloques2">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <!--ALICATE DESTORNILLADOR-->
                                                                                                    <tr>
                                                                                                        <td>Alicate, destornillador</td>
                                                                                                        <td>
                                                                                                            <div class="icheck-success d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="1Alicate_destornillaodor1" name="Alicate_destornillador" value="6">
                                                                                                                <label for="1Alicate_destornillaodor1">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <div class="icheck-danger d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="1Alicate_destornillaodor2" name="Alicate_destornillador" value="7">
                                                                                                                <label for="1Alicate_destornillaodor2">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <!--LLAVE EXPANSION LLAVES FIJAS-->
                                                                                                    <tr>
                                                                                                        <td>Llave de expansión, llaves fijas</td>
                                                                                                        <td>
                                                                                                            <div class="icheck-success d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="2PLlave_expancion_LLaves_fijas1" name="Llave_expancion_Llaves_fijas" value="6">
                                                                                                                <label for="2PLlave_expancion_LLaves_fijas1">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <div class="icheck-danger d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="2PLlave_expancion_LLaves_fijas2" name="Llave_expancion_Llaves_fijas" value="7">
                                                                                                                <label for="2PLlave_expancion_LLaves_fijas2">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <!--LLANTA RESPUESTO-->
                                                                                                    <tr>
                                                                                                        <td>Llanta de repuesto</td>
                                                                                                        <td>
                                                                                                            <div class="icheck-success d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="LLanta_repuesto1" name="Llanta_repuesto" value="6">
                                                                                                                <label for="LLanta_repuesto1">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <div class="icheck-danger d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="LLanta_repuesto2" name="Llanta_repuesto" value="7">
                                                                                                                <label for="LLanta_repuesto2">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <!--LINTERNA PILA-->
                                                                                                    <tr>
                                                                                                        <td>Linterna con pila</td>
                                                                                                        <td>
                                                                                                            <div class="icheck-success d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="Linterna_pila1" name="Linterna_pila" value="6">
                                                                                                                <label for="Linterna_pila1">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <div class="icheck-danger d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="Linterna_pila2" name="Linterna_pila" value="7">
                                                                                                                <label for="Linterna_pila2">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <!--CINTURON DEL CONDUCTOR-->
                                                                                                    <tr>
                                                                                                        <td>Cinturón del conductor</td>
                                                                                                        <td>
                                                                                                            <div class="icheck-success d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="Cinturon_conductor1" name="Cinturon_conductor" value="6">
                                                                                                                <label for="Cinturon_conductor1">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <div class="icheck-danger d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="Cinturon_conductor2" name="Cinturon_conductor" value="7">
                                                                                                                <label for="Cinturon_conductor2">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                </tbody>
                                                                                            </table>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <!-- /.TAB DE ACCESORIOS -->
                                                                            <div class="tab-pane fade" id="custom-tabs-one-accesorios" role="tabpanel" aria-labelledby="custom-tabs-one-accesorios-tab">

                                                                                <div class="row">
                                                                                    <div class="col">
                                                                                        <div class="p-3 table-responsive">
                                                                                            <table class="table table-bordered text-center text-nowrap" nombre="Accesorios">
                                                                                                <tbody>
                                                                                                    <tr>
                                                                                                        <td colspan="1"><b>ACCESORIOS</b></td>
                                                                                                        <td style="width: 15px;">Bueno</td>
                                                                                                        <td style="width: 15px;">Malo</td>
                                                                                                        <td style="width: 15px;">N/A</td>
                                                                                                    </tr>
                                                                                                    <!-- RADIOTELEFONO -->
                                                                                                    <tr class="input-camioneta">
                                                                                                        <td>Radioteléfono</td>
                                                                                                        <td>
                                                                                                            <div class="icheck-success d-inline">
                                                                                                                <input type="radio" class="form-control inventario camioneta" required id="Radioteléfono1" name="Radiotelefono" value="1">
                                                                                                                <label for="Radioteléfono1">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <div class="icheck-danger d-inline">
                                                                                                                <input type="radio" class="form-control inventario camioneta" required id="Radioteléfono2" name="Radiotelefono" value="0">
                                                                                                                <label for="Radioteléfono2">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <div class="icheck-secondary d-inline">
                                                                                                                <input type="radio" class="form-control inventario camioneta" required id="Radioteléfono5" name="Radiotelefono" value="2">
                                                                                                                <label for="Radioteléfono5">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <!-- ANTENA -->
                                                                                                    <tr>
                                                                                                        <td>Antena</td>
                                                                                                        <td>
                                                                                                            <div class="icheck-success d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="Antena1" name="Antena" value="1">
                                                                                                                <label for="Antena1">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <div class="icheck-danger d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="Antena2" name="Antena" value="0">
                                                                                                                <label for="Antena2">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <div class="icheck-secondary d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="Antena5" name="Antena" value="2">
                                                                                                                <label for="Antena5">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <!-- EQUIPO SONIDO -->
                                                                                                    <tr>
                                                                                                        <td>Equipo de Sonido
                                                                                                            <div class="row">
                                                                                                                <div class="col-sm-6">
                                                                                                                    <div class="form-check form-check-inline">
                                                                                                                        <input class="form-check-input inventario" type="radio" value="1" id="usb" name="usb_cd" required>
                                                                                                                        <label class="form-check-label text-nowrap" for="usb">
                                                                                                                            <b>USB</b>
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                                <div class="col-sm-6">
                                                                                                                    <div class="form-check form-check-inline">
                                                                                                                        <input class="form-check-input inventario" type="radio" value="0" id="cd" name="usb_cd" required>
                                                                                                                        <label class="form-check-label text-nowrap" for="cd">
                                                                                                                            <b>CD</b>
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <div class="icheck-success d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="Equipo_Sonido1" name="Equipo_Sonido" value="1">
                                                                                                                <label for="Equipo_Sonido1">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <div class="icheck-danger d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="Equipo_Sonido2" name="Equipo_Sonido" value="0">
                                                                                                                <label for="Equipo_Sonido2">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <div class="icheck-secondary d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="Equipo_Sonido5" name="Equipo_Sonido" value="2">
                                                                                                                <label for="Equipo_Sonido5">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <!-- PARLANTES -->
                                                                                                    <tr>
                                                                                                        <td>
                                                                                                            <div class="col">
                                                                                                                <div class="form-group">
                                                                                                                    <div class="input-group">
                                                                                                                        <div class="input-group-prepend">
                                                                                                                            <span class="input-group-text">Parlantes</span>
                                                                                                                        </div>
                                                                                                                        <input class="form-control" type="number" id="numeroparlantes" name="num_parlantes" max="9999" placeholder="# Digite el número de parlantes">
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <div class="icheck-success d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="Parlantes1" name="Parlantes" value="1">
                                                                                                                <label for="Parlantes1">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <div class="icheck-danger d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="Parlantes2" name="Parlantes" value="0">
                                                                                                                <label for="Parlantes2">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <div class="icheck-secondary d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="Parlantes5" name="Parlantes" value="2">
                                                                                                                <label for="Parlantes5">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <!-- MANGUERA AGUA -->
                                                                                                    <tr class="input-camioneta">
                                                                                                        <td>Manguera de agua</td>
                                                                                                        <td>
                                                                                                            <div class="icheck-success d-inline">
                                                                                                                <input type="radio" class="form-control inventario camioneta" required id="Manguera_agua1" name="Manguera_agua" value="1">
                                                                                                                <label for="Manguera_agua1">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <div class="icheck-danger d-inline">
                                                                                                                <input type="radio" class="form-control inventario camioneta" required id="Manguera_agua2" name="Manguera_agua" value="0">
                                                                                                                <label for="Manguera_agua2">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <div class="icheck-secondary d-inline">
                                                                                                                <input type="radio" class="form-control inventario camioneta" required id="Manguera_agua5" name="Manguera_agua" value="2">
                                                                                                                <label for="Manguera_agua5">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <!-- MANGUERA AIRE -->
                                                                                                    <tr class="input-camioneta">
                                                                                                        <td>Manguera de aire</td>
                                                                                                        <td>
                                                                                                            <div class="icheck-success d-inline">
                                                                                                                <input type="radio" class="form-control inventario camioneta" required id="Manguera_aire1" name="Manguera_aire" value="1">
                                                                                                                <label for="Manguera_aire1">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <div class="icheck-danger d-inline">
                                                                                                                <input type="radio" class="form-control inventario camioneta" required id="Manguera_aire2" name="Manguera_aire" value="0">
                                                                                                                <label for="Manguera_aire2">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <div class="icheck-secondary d-inline">
                                                                                                                <input type="radio" class="form-control inventario camioneta" required id="Manguera_aire5" name="Manguera_aire" value="2">
                                                                                                                <label for="Manguera_aire5">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <!-- PANTALLA TELEVISOR -->
                                                                                                    <tr class="input-camioneta">
                                                                                                        <td>Pantalla / Televisor</td>
                                                                                                        <td>
                                                                                                            <div class="icheck-success d-inline">
                                                                                                                <input type="radio" class="form-control inventario camioneta" required id="Pantalla_Televisor1" name="Pantalla_Televisor" value="1">
                                                                                                                <label for="Pantalla_Televisor1">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <div class="icheck-danger d-inline">
                                                                                                                <input type="radio" class="form-control inventario camioneta" required id="Pantalla_Televisor2" name="Pantalla_Televisor" value="0">
                                                                                                                <label for="Pantalla_Televisor2">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <div class="icheck-secondary d-inline">
                                                                                                                <input type="radio" class="form-control inventario camioneta" required id="Pantalla_Televisor5" name="Pantalla_Televisor" value="2">
                                                                                                                <label for="Pantalla_Televisor5">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <!-- RELOJ -->
                                                                                                    <tr class="input-camioneta">
                                                                                                        <td>Reloj</td>
                                                                                                        <td>
                                                                                                            <div class="icheck-success d-inline">
                                                                                                                <input type="radio" class="form-control inventario camioneta" required id="Reloj1" name="Reloj" value="1">
                                                                                                                <label for="Reloj1">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <div class="icheck-danger d-inline">
                                                                                                                <input type="radio" class="form-control inventario camioneta" required id="Reloj2" name="Reloj" value="0">
                                                                                                                <label for="Reloj2">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <div class="icheck-secondary d-inline">
                                                                                                                <input type="radio" class="form-control inventario camioneta" required id="Reloj5" name="Reloj" value="2">
                                                                                                                <label for="Reloj5">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <!-- BRAZO 1 IZQUIERDO -->
                                                                                                    <tr class="input-camioneta">
                                                                                                        <td>Brazo 1 Izquierdo R1</td>
                                                                                                        <td>
                                                                                                            <div class="icheck-success d-inline">
                                                                                                                <input type="radio" class="form-control inventario camioneta" required id="Brazo_1_Izquierdo_R11" name="Brazo_1_Izquierdo_R1" value="1">
                                                                                                                <label for="Brazo_1_Izquierdo_R11">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <div class="icheck-danger d-inline">
                                                                                                                <input type="radio" class="form-control inventario camioneta" required id="Brazo_1_Izquierdo_R12" name="Brazo_1_Izquierdo_R1" value="0">
                                                                                                                <label for="Brazo_1_Izquierdo_R12">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <div class="icheck-secondary d-inline">
                                                                                                                <input type="radio" class="form-control inventario camioneta" required id="Brazo_1_Izquierdo_R15" name="Brazo_1_Izquierdo_R1" value="2">
                                                                                                                <label for="Brazo_1_Izquierdo_R15">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <!-- BRAZO 2 DERECHO -->
                                                                                                    <tr class="input-camioneta">
                                                                                                        <td>Brazo 2 Derecho R2</td>
                                                                                                        <td>
                                                                                                            <div class="icheck-success d-inline">
                                                                                                                <input type="radio" class="form-control inventario camioneta" required id="Brazo_2_Derecho_R21" name="Brazo_2_Derecho_R2" value="1">
                                                                                                                <label for="Brazo_2_Derecho_R21">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <div class="icheck-danger d-inline">
                                                                                                                <input type="radio" class="form-control inventario camioneta" required id="Brazo_2_Derecho_R22" name="Brazo_2_Derecho_R2" value="0">
                                                                                                                <label for="Brazo_2_Derecho_R22">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <div class="icheck-secondary d-inline">
                                                                                                                <input type="radio" class="form-control inventario camioneta" required id="Brazo_2_Derecho_R25" name="Brazo_2_Derecho_R2" value="2">
                                                                                                                <label for="Brazo_2_Derecho_R25">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <!-- BRAZO 3 IZQUIERDO -->
                                                                                                    <tr class="input-camioneta">
                                                                                                        <td>Brazo 3 Izquierdo R3</td>
                                                                                                        <td>
                                                                                                            <div class="icheck-success d-inline">
                                                                                                                <input type="radio" class="form-control inventario camioneta" required id="Brazo_3_Izquierdo_R31" name="Brazo_3_Izquierdo_R3" value="1">
                                                                                                                <label for="Brazo_3_Izquierdo_R31">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <div class="icheck-danger d-inline">
                                                                                                                <input type="radio" class="form-control inventario camioneta" required id="Brazo_3_Izquierdo_R32" name="Brazo_3_Izquierdo_R3" value="0">
                                                                                                                <label for="Brazo_3_Izquierdo_R32">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <div class="icheck-secondary d-inline">
                                                                                                                <input type="radio" class="form-control inventario camioneta" required id="Brazo_3_Izquierdo_R35" name="Brazo_3_Izquierdo_R3" value="2">
                                                                                                                <label for="Brazo_3_Izquierdo_R35">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <!-- BRAZO 4 DERECHO -->
                                                                                                    <tr class="input-camioneta">
                                                                                                        <td>Brazo 4 Derecho R6</td>
                                                                                                        <td>
                                                                                                            <div class="icheck-success d-inline">
                                                                                                                <input type="radio" class="form-control inventario camioneta" required id="Brazo_4_Derecho_R61" name="Brazo_4_Derecho_R6" value="1">
                                                                                                                <label for="Brazo_4_Derecho_R61">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <div class="icheck-danger d-inline">
                                                                                                                <input type="radio" class="form-control inventario camioneta" required id="Brazo_4_Derecho_R62" name="Brazo_4_Derecho_R6" value="0">
                                                                                                                <label for="Brazo_4_Derecho_R62">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <div class="icheck-secondary d-inline">
                                                                                                                <input type="radio" class="form-control inventario camioneta" required id="Brazo_4_Derecho_R65" name="Brazo_4_Derecho_R6" value="2">
                                                                                                                <label for="Brazo_4_Derecho_R65">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                </tbody>
                                                                                            </table>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <!-- /.TAB DE EMBLEMAS -->
                                                                            <div class="tab-pane fade" id="custom-tabs-one-emblemas" role="tabpanel" aria-labelledby="custom-tabs-one-emblemas-tab">
                                                                                <div class="row">
                                                                                    <div class="col">
                                                                                        <div class="p-3 table-responsive">
                                                                                            <table class="table table-bordered text-center text-nowrap" nombre="Emblemas">
                                                                                                <tbody>
                                                                                                    <tr>
                                                                                                        <td colspan="1"><b>EMBLEMAS</b></td>
                                                                                                        <td style="width: 15px;">Bueno</td>
                                                                                                        <td style="width: 15px;">Malo</td>
                                                                                                        <td style="width: 15px;">N/A</td>
                                                                                                    </tr>
                                                                                                    <!-- Emblema izquierdo de la empresa -->
                                                                                                    <tr>
                                                                                                        <td>Emblema izquierdo de la empresa</td>
                                                                                                        <td>
                                                                                                            <div class="icheck-success d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="Emblema_izquierdo_empresa1" name="Emblema_izquierdo_empresa" value="1">
                                                                                                                <label for="Emblema_izquierdo_empresa1">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <div class="icheck-danger d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="Emblema_izquierdo_empresa2" name="Emblema_izquierdo_empresa" value="0">
                                                                                                                <label for="Emblema_izquierdo_empresa2">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <div class="icheck-secondary d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="Emblema_izquierdo_empresa5" name="Emblema_izquierdo_empresa" value="2">
                                                                                                                <label for="Emblema_izquierdo_empresa5">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <!-- Emblema derecho de la empresa -->
                                                                                                    <tr>
                                                                                                        <td>Emblema derecho de la empresa</td>
                                                                                                        <td>
                                                                                                            <div class="icheck-success d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="Emblema_derecho_empresa1" name="Emblema_derecho_empresa" value="1">
                                                                                                                <label for="Emblema_derecho_empresa1">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <div class="icheck-danger d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="Emblema_derecho_empresa2" name="Emblema_derecho_empresa" value="0">
                                                                                                                <label for="Emblema_derecho_empresa2">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <div class="icheck-secondary d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="Emblema_derecho_empresa5" name="Emblema_derecho_empresa" value="2">
                                                                                                                <label for="Emblema_derecho_empresa5">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <!-- ESCOLAR -->
                                                                                                    <tr class="input-camioneta">
                                                                                                        <td>Escolar
                                                                                                            <div class="row">
                                                                                                                <div class="col-sm-6">
                                                                                                                    <div class="form-check form-check-inline">
                                                                                                                        <input class="form-check-input inventario camioneta" type="radio" value="1" id="escolardelantero4" name="escolar_delantero_trasero" required>
                                                                                                                        <label class="form-check-label text-nowrap" for="escolardelantero4">
                                                                                                                            <b>Delantero</b>
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </div>

                                                                                                                <div class="col-sm-6">
                                                                                                                    <div class="form-check form-check-inline">
                                                                                                                        <input class="form-check-input inventario camioneta" type="radio" value="0" id="escolardelantero5" name="escolar_delantero_trasero" required>
                                                                                                                        <label class="form-check-label text-nowrap" for="escolardelantero5">
                                                                                                                            <b>Trasero</b>
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <div class="icheck-success d-inline">
                                                                                                                <input type="radio" class="form-control inventario camioneta" required id="escolar" name="escolar" value="1">
                                                                                                                <label for="escolar">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <div class="icheck-danger d-inline">
                                                                                                                <input type="radio" class="form-control inventario camioneta" required id="escolar2" name="escolar" value="0">
                                                                                                                <label for="escolar2">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <div class="icheck-secondary d-inline">
                                                                                                                <input type="radio" class="form-control inventario camioneta" required id="escolar3" name="escolar" value="2">
                                                                                                                <label for="escolar3">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <!-- LOGO IZQUIERDO -->
                                                                                                    <tr>
                                                                                                        <td>Logo izquierdo</td>
                                                                                                        <td>
                                                                                                            <div class="icheck-success d-inline">
                                                                                                                <input type="radio" class="form-control inventario" id="Logo_izquierdo1" name="Logo_izquierdo" value="1" required>
                                                                                                                <label for="Logo_izquierdo1">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <div class="icheck-danger d-inline">
                                                                                                                <input type="radio" class="form-control inventario" id="Logo_izquierdo2" name="Logo_izquierdo" value="0" required>
                                                                                                                <label for="Logo_izquierdo2">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <div class="icheck-secondary d-inline">
                                                                                                                <input type="radio" class="form-control inventario" id="Logo_izquierdo5" name="Logo_izquierdo" value="2" required>
                                                                                                                <label for="Logo_izquierdo5">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <!-- LOGO DERECHO -->
                                                                                                    <tr>
                                                                                                        <td>Logo derecho</td>
                                                                                                        <td>
                                                                                                            <div class="icheck-success d-inline">
                                                                                                                <input type="radio" class="form-control inventario" id="Logo_derecho1" name="Logo_derecho" value="1" required>
                                                                                                                <label for="Logo_derecho1">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <div class="icheck-danger d-inline">
                                                                                                                <input type="radio" class="form-control inventario" id="Logo_derecho2" name="Logo_derecho" value="0" required>
                                                                                                                <label for="Logo_derecho2">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <div class="icheck-secondary d-inline">
                                                                                                                <input type="radio" class="form-control inventario" id="Logo_derecho5" name="Logo_derecho" value="2" required>
                                                                                                                <label for="Logo_derecho5">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <!-- N INTERNO DELANTERO -->
                                                                                                    <tr>
                                                                                                        <td>N° Interno delantero</td>
                                                                                                        <td>
                                                                                                            <div class="icheck-success d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="N_Interno_delantero1" name="N_Interno_delantero" value="1">
                                                                                                                <label for="N_Interno_delantero1">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <div class="icheck-danger d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="N_Interno_delantero2" name="N_Interno_delantero" value="0">
                                                                                                                <label for="N_Interno_delantero2">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <div class="icheck-secondary d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="N_Interno_delantero5" name="N_Interno_delantero" value="2">
                                                                                                                <label for="N_Interno_delantero5">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <!-- N INTERNO TRASERO -->
                                                                                                    <tr>
                                                                                                        <td>N° Interno trasero</td>
                                                                                                        <td>
                                                                                                            <div class="icheck-success d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="N_Interno_trasero1" name="N_Interno_trasero" value="1">
                                                                                                                <label for="N_Interno_trasero1">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <div class="icheck-danger d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="N_Interno_trasero2" name="N_Interno_trasero" value="0">
                                                                                                                <label for="N_Interno_trasero2">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <div class="icheck-secondary d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="N_Interno_trasero5" name="N_Interno_trasero" value="2">
                                                                                                                <label for="N_Interno_trasero5">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <!-- N INTERNO IZQUIERDO -->
                                                                                                    <tr>
                                                                                                        <td>N° Interno izquierdo</td>
                                                                                                        <td>
                                                                                                            <div class="icheck-success d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="N_Interno_izquierdo1" name="N_Interno_izquierdo" value="1">
                                                                                                                <label for="N_Interno_izquierdo1">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <div class="icheck-danger d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="N_Interno_izquierdo2" name="N_Interno_izquierdo" value="0">
                                                                                                                <label for="N_Interno_izquierdo2">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <div class="icheck-secondary d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="N_Interno_izquierdo5" name="N_Interno_izquierdo" value="2">
                                                                                                                <label for="N_Interno_izquierdo5">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <!-- N INTERNO DERECHO -->
                                                                                                    <tr>
                                                                                                        <td>N° Interno derecho</td>
                                                                                                        <td>
                                                                                                            <div class="icheck-success d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="N_Interno_derecho1" name="N_Interno_derecho" value="1">
                                                                                                                <label for="N_Interno_derecho1">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <div class="icheck-danger d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="N_Interno_derecho2" name="N_Interno_derecho" value="0">
                                                                                                                <label for="N_Interno_derecho2">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <div class="icheck-secondary d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="N_Interno_derecho5" name="N_Interno_derecho" value="2">
                                                                                                                <label for="N_Interno_derecho5">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <!-- SALIDAS DE EMERGENCIA Y MARTILLOS-->
                                                                                                    <tr class="input-camioneta">
                                                                                                        <td>
                                                                                                            <div class="col">
                                                                                                                <div class="form-group">
                                                                                                                    <div class="input-group">
                                                                                                                        <div class="input-group-prepend">
                                                                                                                            <span class="input-group-text">Salidas de emergencia y martillos</span>
                                                                                                                        </div>
                                                                                                                        <input class="form-control inventario camioneta" type="number" max="999" id="numsalimarti" name="Nsalidas_martillos" placeholder="Digite el número de salidas">
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <div class="icheck-success d-inline">
                                                                                                                <input type="radio" class="form-control inventario camioneta" required id="Salidas_emergencia_martillos1" name="Salidas_emergencia_martillos" value="1">
                                                                                                                <label for="Salidas_emergencia_martillos1">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <div class="icheck-danger d-inline">
                                                                                                                <input type="radio" class="form-control inventario camioneta" required id="Salidas_emergencia_martillos2" name="Salidas_emergencia_martillos" value="0">
                                                                                                                <label for="Salidas_emergencia_martillos2">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <div class="icheck-secondary d-inline">
                                                                                                                <input type="radio" class="form-control inventario camioneta" required id="Salidas_emergencia_martillos5" name="Salidas_emergencia_martillos" value="2">
                                                                                                                <label for="Salidas_emergencia_martillos5">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <!-- DISPOSITIVO DE VELOCIDAD -->
                                                                                                    <tr>
                                                                                                        <td>Dispositivo de velocidad</td>
                                                                                                        <td>
                                                                                                            <div class="icheck-success d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="Dispositivo_velocidad1" name="Dispositivo_velocidad" value="1">
                                                                                                                <label for="Dispositivo_velocidad1">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <div class="icheck-danger d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="Dispositivo_velocidad2" name="Dispositivo_velocidad" value="0">
                                                                                                                <label for="Dispositivo_velocidad2">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <div class="icheck-secondary d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="Dispositivo_velocidad5" name="Dispositivo_velocidad" value="2">
                                                                                                                <label for="Dispositivo_velocidad5">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <!-- AVISO COMO CONDUZCO -->
                                                                                                    <tr>
                                                                                                        <td>Aviso como conduzco
                                                                                                            <div class="row">
                                                                                                                <div class="col-sm-6">
                                                                                                                    <div class="form-check form-check-inline">
                                                                                                                        <input class="form-check-input inventario" type="radio" value="1" id="comoconduinter" name="interno_externo_comoConduzco" required>
                                                                                                                        <label class="form-check-label text-nowrap" for="comoconduinter">
                                                                                                                            <b>Interno</b>
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                                <div class="col-sm-6">
                                                                                                                    <div class="form-check form-check-inline">
                                                                                                                        <input class="form-check-input inventario" type="radio" value="0" id="comoconduexter" name="interno_externo_comoConduzco" required>
                                                                                                                        <label class="form-check-label text-nowrap" for="comoconduexter">
                                                                                                                            <b>Externo</b>
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <div class="icheck-success d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="Av_Como_conduzco1" name="Av_Como_conduzco" value="1">
                                                                                                                <label for="Av_Como_conduzco1">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <div class="icheck-danger d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="Av_Como_conduzco2" name="Av_Como_conduzco" value="0">
                                                                                                                <label for="Av_Como_conduzco2">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <div class="icheck-secondary d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="Av_Como_conduzco5" name="Av_Como_conduzco" value="2">
                                                                                                                <label for="Av_Como_conduzco5">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                </tbody>
                                                                                            </table>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <!-- /.TAB DE OTROS -->
                                                                            <div class="tab-pane fade" id="custom-tabs-one-otros" role="tabpanel" aria-labelledby="custom-tabs-one-otros-tab">

                                                                                <div class="row">
                                                                                    <div class="col">
                                                                                        <div class="p-3 table-responsive">
                                                                                            <table class="table table-bordered text-center text-nowrap" nombre="Otros elementos">
                                                                                                <tbody>
                                                                                                    <tr>
                                                                                                        <td colspan="1"><b>OTROS ELEMENTOS</b></td>
                                                                                                        <td style="width: 15px;">Bueno</td>
                                                                                                        <td style="width: 15px;">Malo</td>
                                                                                                        <td style="width: 15px;">N/A</td>
                                                                                                    </tr>
                                                                                                    <!--BRAZO LIMPIAPARABRISAS IZQUIERDO-->
                                                                                                    <tr>
                                                                                                        <td>Brazo limpiaparabrisas izquierdo</td>
                                                                                                        <td>
                                                                                                            <div class="icheck-success d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="Brazo_limpiaparabrisas_izquierdo1" name="Brazo_limpiaparabrisas_izquierdo" value="1">
                                                                                                                <label for="Brazo_limpiaparabrisas_izquierdo1">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <div class="icheck-danger d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="Brazo_limpiaparabrisas_izquierdo2" name="Brazo_limpiaparabrisas_izquierdo" value="0">
                                                                                                                <label for="Brazo_limpiaparabrisas_izquierdo2">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <div class="icheck-secondary d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="Brazo_limpiaparabrisas_izquierdo5" name="Brazo_limpiaparabrisas_izquierdo" value="2">
                                                                                                                <label for="Brazo_limpiaparabrisas_izquierdo5">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <!--PLUMILLA LIMPIAPARABRISAS IZQUIERDO-->
                                                                                                    <tr>
                                                                                                        <td>Plumilla limpiaparabrisas izquierdo</td>
                                                                                                        <td>
                                                                                                            <div class="icheck-success d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="Plumilla_limpiaparabrisas_izquierdo1" name="Plumilla_limpiaparabrisas_izquierdo" value="1">
                                                                                                                <label for="Plumilla_limpiaparabrisas_izquierdo1">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <div class="icheck-danger d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="Plumilla_limpiaparabrisas_izquierdo2" name="Plumilla_limpiaparabrisas_izquierdo" value="0">
                                                                                                                <label for="Plumilla_limpiaparabrisas_izquierdo2">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <div class="icheck-secondary d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="Plumilla_limpiaparabrisas_izquierdo5" name="Plumilla_limpiaparabrisas_izquierdo" value="2">
                                                                                                                <label for="Plumilla_limpiaparabrisas_izquierdo5">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <!--BRAZO LIMPIAPARABRISAS DERECHO-->
                                                                                                    <tr>
                                                                                                        <td>Brazo limpiaparabrisas derecho</td>
                                                                                                        <td>
                                                                                                            <div class="icheck-success d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="7Brazo_limpiaparabrisas_derecho1" name="Brazo_limpiaparabrisas_derecho" value="1">
                                                                                                                <label for="7Brazo_limpiaparabrisas_derecho1">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <div class="icheck-danger d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="7Brazo_limpiaparabrisas_derecho2" name="Brazo_limpiaparabrisas_derecho" value="0">
                                                                                                                <label for="7Brazo_limpiaparabrisas_derecho2">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <div class="icheck-secondary d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="7Brazo_limpiaparabrisas_derecho52" name="Brazo_limpiaparabrisas_derecho" value="2">
                                                                                                                <label for="7Brazo_limpiaparabrisas_derecho52">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <!--PLUMILLA LIMPIAPARABRISAS DERECHO-->
                                                                                                    <tr>
                                                                                                        <td>Plumilla limpiaparabrisas derecho</td>
                                                                                                        <td>
                                                                                                            <div class="icheck-success d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="Plumilla_limpiaparabrisas_derecho1" name="Plumilla_limpiaparabrisas_derecho" value="1">
                                                                                                                <label for="Plumilla_limpiaparabrisas_derecho1">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <div class="icheck-danger d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="Plumilla_limpiaparabrisas_derecho2" name="Plumilla_limpiaparabrisas_derecho" value="0">
                                                                                                                <label for="Plumilla_limpiaparabrisas_derecho2">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <div class="icheck-secondary d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="Plumilla_limpiaparabrisas_derecho5" name="Plumilla_limpiaparabrisas_derecho" value="2">
                                                                                                                <label for="Plumilla_limpiaparabrisas_derecho5">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <!--BATERIAS-->
                                                                                                    <tr>
                                                                                                        <td>Baterías</td>
                                                                                                        <td>
                                                                                                            <div class="icheck-success d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="Baterias1" name="Baterias" value="1">
                                                                                                                <label for="Baterias1">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <div class="icheck-danger d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="Baterias2" name="Baterias" value="0">
                                                                                                                <label for="Baterias2">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <div class="icheck-secondary d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="Baterias5" name="Baterias" value="2">
                                                                                                                <label for="Baterias5">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <!--BOTONES DE TABLERO Y TIMON-->
                                                                                                    <tr>
                                                                                                        <td>Botones de tablerón y timón</td>
                                                                                                        <td>
                                                                                                            <div class="icheck-success d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="Botones_tableron_timon1" name="Botones_tablero_timon" value="1">
                                                                                                                <label for="Botones_tableron_timon1">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <div class="icheck-danger d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="Botones_tableron_timon2" name="Botones_tablero_timon" value="0">
                                                                                                                <label for="Botones_tableron_timon2">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <div class="icheck-secondary d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="Botones_tableron_timon5" name="Botones_tablero_timon" value="2">
                                                                                                                <label for="Botones_tableron_timon5">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <!--TAPA RADIADOR-->
                                                                                                    <tr>
                                                                                                        <td>Tapa radiador</td>
                                                                                                        <td>
                                                                                                            <div class="icheck-success d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="Tapa_radiador1" name="Tapa_radiador" value="1">
                                                                                                                <label for="Tapa_radiador1">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <div class="icheck-danger d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="Tapa_radiador2" name="Tapa_radiador" value="0">
                                                                                                                <label for="Tapa_radiador2">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <div class="icheck-secondary d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="Tapa_radiador5" name="Tapa_radiador" value="2">
                                                                                                                <label for="Tapa_radiador5">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <!--TAPA DEPOSITO HIDRAULICO-->
                                                                                                    <tr>
                                                                                                        <td>Tapa deposito hidráulico</td>
                                                                                                        <td>
                                                                                                            <div class="icheck-success d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="Tapa_deposito_hidráulico1" name="Tapa_deposito_hidraulico" value="1">
                                                                                                                <label for="Tapa_deposito_hidráulico1">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <div class="icheck-danger d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="Tapa_deposito_hidráulico2" name="Tapa_deposito_hidraulico" value="0">
                                                                                                                <label for="Tapa_deposito_hidráulico2">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <div class="icheck-secondary d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="Tapa_deposito_hidráulico5" name="Tapa_deposito_hidraulico" value="2">
                                                                                                                <label for="Tapa_deposito_hidráulico5">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <!--COJINERIA GENERAL-->
                                                                                                    <tr>
                                                                                                        <td>Cojineria en general</td>
                                                                                                        <td>
                                                                                                            <div class="icheck-success d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="Cojineria_general1" name="Cojineria_general" value="1">
                                                                                                                <label for="Cojineria_general1">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <div class="icheck-danger d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="Cojineria_general2" name="Cojineria_general" value="0">
                                                                                                                <label for="Cojineria_general2">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <div class="icheck-secondary d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="Cojineria_general5" name="Cojineria_general" value="2">
                                                                                                                <label for="Cojineria_general5">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <!--CINTURON SILLAS-->
                                                                                                    <tr>
                                                                                                        <td>Cinturón sillas calidad</td>
                                                                                                        <td>
                                                                                                            <div class="icheck-success d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="Cinturon_sillas_calidad1" name="Cinturon_sillas_calidad" value="1">
                                                                                                                <label for="Cinturon_sillas_calidad1">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <div class="icheck-danger d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="Cinturon_sillas_calidad2" name="Cinturon_sillas_calidad" value="0">
                                                                                                                <label for="Cinturon_sillas_calidad2">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <div class="icheck-secondary d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="Cinturon_sillas_calidad5" name="Cinturon_sillas_calidad" value="2">
                                                                                                                <label for="Cinturon_sillas_calidad5">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <!--PASAMANOS-->
                                                                                                    <tr>
                                                                                                        <td>Pasamanos</td>
                                                                                                        <td>
                                                                                                            <div class="icheck-success d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="Pasamanos1" name="Pasamanos" value="1">
                                                                                                                <label for="Pasamanos1">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <div class="icheck-danger d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="Pasamanos2" name="Pasamanos" value="0">
                                                                                                                <label for="Pasamanos2">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <div class="icheck-secondary d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="Pasamanos5" name="Pasamanos" value="2">
                                                                                                                <label for="Pasamanos5">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <!--CLAXON-->
                                                                                                    <tr>
                                                                                                        <td>Claxón</td>
                                                                                                        <td>
                                                                                                            <div class="icheck-success d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="Claxon1" name="Claxon" value="1">
                                                                                                                <label for="Claxon1">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <div class="icheck-danger d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="Claxon2" name="Claxon" value="0">
                                                                                                                <label for="Claxon2">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <div class="icheck-secondary d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="Claxon5" name="Claxon" value="2">
                                                                                                                <label for="Claxon5">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <!--PLACAS REGLAMENTARIAS-->
                                                                                                    <tr>
                                                                                                        <td>Placas reglamentarias</td>
                                                                                                        <td>
                                                                                                            <div class="icheck-success d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="Placas_reglamentarias1" name="Placas_reglamentarias" value="1">
                                                                                                                <label for="Placas_reglamentarias1">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <div class="icheck-danger d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="Placas_reglamentarias2" name="Placas_reglamentarias" value="0">
                                                                                                                <label for="Placas_reglamentarias2">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <div class="icheck-secondary d-inline">
                                                                                                                <input type="radio" class="form-control inventario" required id="Placas_reglamentarias5" name="Placas_reglamentarias" value="2">
                                                                                                                <label for="Placas_reglamentarias5">
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                </tbody>
                                                                                            </table>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <hr class="my-4 bg-dark">
                                                                            <!-- BOTONES SUBMIT FORMULARIO INVENTARIO -->
                                                                            <div class="row d-flex justify-content-center">
                                                                                <div class="col-3">
                                                                                    <button type="submit" class="btn btn-block btn-success btn-agregar-inventario" form="formulario_inventario">
                                                                                        <i class="fas fa-save"></i> Guardar inventario</button>
                                                                                    <input class="form-control input-sm" type="reset" id="restablecer" style="background-color: red;color: white;">
                                                                                </div>
                                                                            </div>

                                                                            <?php
                                                                            $guardarInventario = new ControladorInventario();
                                                                            $guardarInventario->ctrAgregarEditarInventario();
                                                                            ?>
                                                                            <script>
                                                                                $("#inventario_id").val("");
                                                                            </script>

                                                                        </div>
                                                                        <!--TAN CONTENT CIERRE-->
                                                                    </div>
                                                                    <!--CARD BODY CIERRE-->
                                                                </div>
                                                                <!--CARD CIERRE-->
                                                            </div>
                                                        </div>
                                                        <!--ROW CIERRE-->
                                                    </form>
                                                    <!--FORM CIERRE-->
                                                    <hr class="my-5 bg-black">            
                                                    <!-- EVIDENCIAS -->
                                                    <div class="row">
                                                        <!--TITULO EVIDENCIAS-->
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <div class="input-group">
                                                                    <h4><b><i>Evidencias</i></b></h4>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- /.TAB REGISTRO FOTOGRAFICO Y OBSERVACIONES -->
                                                        <div class="col-12">
                                                            <!--CARD EVIDENCIAS-->
                                                            <div class="card card-info card-tabs">
                                                                <!--CARD HEADER-->
                                                                <div class="card-header p-0 pt-1">
                                                                    <ul class="nav nav-tabs" id="custom-tabs-two-tab" role="tablist">
                                                                        <li class="pt-2 px-3">
                                                                            <h3 class="card-title">Evidencias</h3>
                                                                        </li>
                                                                        <li class="nav-item">
                                                                            <a class="nav-link active" id="pills-evidencias-tab" data-toggle="pill" href="#pills-evidencias" role="tab" aria-controls="pills-evidencias" aria-selected="true">Registro fotográfico y observaciones</a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                                <div class="card-body">
                                                                    <div class="tab-content" id="custom-tabs-two-tabContent">
                                                                        <form method="post" enctype="multipart/form-data" id="formulario_evidencias">
                                                                            <div class="row">
                                                                                <!--SUBIR IMAGEN-->
                                                                                <div class="col-md-6">
                                                                                    <div class="form-group">
                                                                                        <label>SUBIR / TOMAR imagen de evidencia (1 Foto a la vez)</label>
                                                                                        <div class="input-group">
                                                                                            <div class="input-group-append">
                                                                                                <span class="input-group-text">
                                                                                                    <i class="fas fa-camera"></i>
                                                                                                </span>
                                                                                            </div>
                                                                                            <input type="file" class="form-control" name="foto_evidencia_inventario" id="foto_evidencia_inventario" accept="image/png, image/jpeg" required>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <!--OBSERVACIONES-->
                                                                                <div class="col-md-6">
                                                                                    <div class="form-group">
                                                                                        <label>Observaciones</label>
                                                                                        <textarea class="form-control" rows="4" placeholder="Digite las observaciones vistas en la inspeccion." id="observaciones" name="observaciones" required></textarea>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <hr class="my-4">
                                                                            <!--BOTON GUARDAR EVIDENCIA-->
                                                                            <div class="text-center">
                                                                                <button type="submit" class="btn btn-lg bg-gradient-success btn_evidencias_inventario" form="formulario_evidencias"><i class="far fa-save"><b> Guardar información</b></i></button>
                                                                            </div>
                                                                        </form>

                                                                        <hr class="my-5 bg-dark">
                                                                        <!--TITULO IMAGENES SUBIDAS-->
                                                                        <div class="col">
                                                                            <div class="form-group">
                                                                                <div class="input-group">
                                                                                    <h5><b><i>Imágenes subidas</i></b></h5>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <!--TABLA IMAGENES SUBIDAS-->
                                                                        <div class="table-responsive">
                                                                            <table class="table table-sm table-striped table-bordered table-hover text-center" id="tabla_fotos">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th>Fecha</th>
                                                                                        <th>Imágenes de evidencia</th>
                                                                                        <th>Observaciones</th>
                                                                                        <th>Estado</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody id="tbody_tabla_fotos">

                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!--CARD BODY - CARD EVIDENCIAS-->
                                                            </div>
                                                            <!--CIERRE CARD EVIDENCIAS-->
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--TAB PANE CIERRE-->
                                            </div>
                                            <!--TAB CONTENT CIERRE-->
                                        </div>
                                        <!--COL CIERRE-->
                                    </div>
                                    <!--ROW FLEX CIERRE-->
                                </div>
                                <!--CARD BODY-->
                            </div>
                            <!-- ===================== 
                                CARD DE TABLA RESUMEN
                            ========================-->
                            <div class="card card-success collapsed-card">
                                <div class="card-header" data-card-widget="collapse" style="cursor: pointer;">
                                    <h3 class="card-title"><b><i>Vehículos</i></b>
                                        <i class="fas fa-car-alt"></i>
                                    </h3>
                                    <div class="card-tools">
                                        <button type="button" title="Abrir tabla de inventarios"  data-toggle="tooltip" data-placement="top" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="tabla_resumen_inventario" class="table table-sm table-bordered table-striped text-center nowrap">
                                            <thead>
                                                <tr>
                                                    <th colspan="4"></th>
                                                    <th colspan="3">VEHÍCULO</th>
                                                    <th colspan="9">LÁMINAS</th>
                                                    <th colspan="8">VIDRIOS Y ESPEJOS</th>
                                                    <th colspan="9">LUCES</th>
                                                    <th colspan="6">LLANTAS</th>
                                                    <th colspan="11">PREVENCIÓN Y SEGURIDAD</th>
                                                    <th colspan="14">ACCESORIOS</th>
                                                    <th colspan="15">EMBLEMAS</th>
                                                    <th colspan="13">OTROS ELEMENTOS</th>
                                                </tr>
                                                <tr>
                                                    <th>...</th>
                                                    <th>ID</th>
                                                    <th>Fecha</th>
                                                    <th>Entrega/Recibe</th>
                                                    <th>Placa</th>
                                                    <th>Número interno</th>
                                                    <th>Conductor</th>
                                                    <!--LAMINAS-->
                                                    <th>Techo exterior</th>
                                                    <th>Techo interior</th>
                                                    <th>Frente</th>
                                                    <th>Bomper delantero</th>
                                                    <th>Bomper trasero</th>
                                                    <th>Lateral derecho</th>
                                                    <th>Lateral izquierdo</th>
                                                    <th>Puerta derecha</th>
                                                    <th>Puerta izquierda</th>
                                                    <!--VIDRIOS Y ESPEJOS-->
                                                    <th>Parabrisas izquierdo</th>
                                                    <th>Parabrisas derecho</th>
                                                    <th>Espejo retrovisor derecho</th>
                                                    <th>Espejo retrovisor izquierdo</th>
                                                    <th>Vidrios ventanas lateral derecho</th>
                                                    <th>Vidrios ventanas lateral izquierdo</th>
                                                    <th>Parabrisas trasero</th>
                                                    <th>Vidrios puertas</th>
                                                    <!--LUCES-->
                                                    <th>Direccional delantera izquierda</th>
                                                    <th>Direccional delantera derecha</th>
                                                    <th>Stop trasero derecho</th>
                                                    <th>Stop trasero izquierdo</th>
                                                    <th>Cucuyo lateral derecho</th>
                                                    <th>Cucuyo lateral izquierdo</th>
                                                    <th>Número de luces internas</th>
                                                    <th>Luces internas</th>
                                                    <th>Balizas (Licuadoras)</th>
                                                    <!--LLANTAS-->
                                                    <th>Delantera izquierda (R1)</th>
                                                    <th>Delantera derecha (R2)</th>
                                                    <th>Trasera interior izquierda (R3)</th>
                                                    <th>Trasera exterior izquierda (R4)</th>
                                                    <th>Trasera interior derecha (R5)</th>
                                                    <th>Trasera exterior derecha (R6)</th>
                                                    <!--Prevencion y seguridad-->
                                                    <th>Gato</th>
                                                    <th>Cruceta o Copa</th>
                                                    <th>2 Conos o Triángulos</th>
                                                    <th>Botiquín</th>
                                                    <th>Extintor</th>
                                                    <th>2 Tacos o bloques</th>
                                                    <th>Alicate/Destornillador</th>
                                                    <th>Llave de expansión/llaves fijas</th>
                                                    <th>Llanta de repuesto</th>
                                                    <th>Linterna con pila</th>
                                                    <th>Cinturón del conductor</th>

                                                    <!--ACCESORIOS-->
                                                    <th>Radioteléfono</th>
                                                    <th>Antena</th>
                                                    <th>Equipo de sonido</th>
                                                    <th>CD/USB</th>
                                                    <th>Parlantes</th>
                                                    <th>Número de parlantes</th>
                                                    <th>Manguera de agua</th>
                                                    <th>Manguera de aire</th>
                                                    <th>Pantalla / Televisor</th>
                                                    <th>Reloj</th>
                                                    <th>Brazo 1 izquierdo R1</th>
                                                    <th>Brazo 2 derecho R2</th>
                                                    <th>Brazo 3 izquierdo R3</th>
                                                    <th>Brazo 4 derecho R6</th>
                                                    <!--EMBLEMAS-->
                                                    <th>Emblema izquierdo de la empresa</th>
                                                    <th>Emblema derecho de la empresa</th>
                                                    <th>Escolar</th>
                                                    <th>Escolar: delantero/trasero</th>
                                                    <th>Logo izquierdo</th>
                                                    <th>Logo derecho</th>
                                                    <th>Número interno delantero</th>
                                                    <th>Número interno trasero</th>
                                                    <th>Número interno izquierdo</th>
                                                    <th>Número interno derecho</th>
                                                    <th>Salidas de emergencia y martillos</th>
                                                    <th>Número de salidas de emergencia y martillos</th>
                                                    <th>Dispositivo de velocidad</th>
                                                    <th>Aviso como conduzco</th>
                                                    <th>Aviso: interno/externo</th>
                                                    <!--OTROS ELEMENTOS-->
                                                    <th>Brazo limpiaparabrisas izquierdo</th>
                                                    <th>Plumillas limpiaparabrisas izquierdo</th>
                                                    <th>Brazo limpiaparabrisas derecho</th>
                                                    <th>Plumilla limpiaparabrisas derecho</th>
                                                    <th>Baterias</th>
                                                    <th>Botones de tablero y timón</th>
                                                    <th>Tapa de radiador</th>
                                                    <th>Tapa deposito hidráulico</th>
                                                    <th>Cojineria en general</th>
                                                    <th>Cinturón sillas cantidad</th>
                                                    <th>Pasamanos</th>
                                                    <th>Claxón</th>
                                                    <th>Placas reglamentarias</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($ListaInventario as $key => $value) : ?>

                                                    <?php
                                                    if ($value['usb_cd'] == 0) {

                                                        $usb_cd = "CD";
                                                    } else {

                                                        $usb_cd = "USB";
                                                    }
                                                    if ($value['escolar_delantero_trasero'] == 0) {

                                                        $escolar = "Trasero";
                                                    } else {

                                                        $escolar = "Delantero";
                                                    }
                                                    if ($value['interno_externo_comoConduzco'] == 0) {

                                                        $avconduzco = "Externo";
                                                    } else {

                                                        $avconduzco = "Interno";
                                                    }
                                                    ?>
                                                    <tr>
                                                        <td>
                                                            <button type="button" title="PDF inventario" data-toggle="tooltip" data-placement="top" class="btn btn-danger btn-sm btn-verInventario" id_inventario="<?= $value['id'] ?>"><i class="fas fa-file-pdf"></i></button>
                                                            <button type="button" title="Editar inventario actual" data-toggle="tooltip" data-placement="top" class="btn btn-info btn-sm btn-editarInventario" id_inventario="<?= $value['id'] ?>"><i class="fas fa-edit"></i></button>
                                                            <button type="button" title="Eliminar registro" data-toggle="tooltip" data-placement="top" class="btn btn-secondary btn-sm btn-eliminar" id_inventario="<?= $value['id'] ?>"><i class="fas fa-trash"></i></button>
                                                        </td>
                                                        <td><?= $value['id'] ?></td>
                                                        <td><?= $value['fecha_inventario'] ?></td>
                                                        <td><?= ControladorInventario::TraducirEstadoInventario($value['recepcion_entrega_vehiculo']) ?></td>
                                                        <td><?= $value['placa'] ?></td>
                                                        <td><?= $value['numinterno'] ?></td>
                                                        <td><?= $value['conductor'] ?></td>
                                                        <td><?= ControladorInventario::TraducirEstadoInventario($value['Techo_exterior']) ?></td>
                                                        <td><?= ControladorInventario::TraducirEstadoInventario($value['Techo_interior']) ?></td>
                                                        <td><?= ControladorInventario::TraducirEstadoInventario($value['Frente']) ?></td>
                                                        <td><?= ControladorInventario::TraducirEstadoInventario($value['Bomper_delantero']) ?></td>
                                                        <td><?= ControladorInventario::TraducirEstadoInventario($value['Bomper_trasero']) ?></td>
                                                        <td><?= ControladorInventario::TraducirEstadoInventario($value['Lateral_derecho']) ?></td>
                                                        <td><?= ControladorInventario::TraducirEstadoInventario($value['Lateral_izquierdo']) ?></td>
                                                        <td><?= ControladorInventario::TraducirEstadoInventario($value['puerta_derecha']) ?></td>
                                                        <td><?= ControladorInventario::TraducirEstadoInventario($value['Puerta_izquierda']) ?></td>
                                                        <td><?= ControladorInventario::TraducirEstadoInventario($value['Parabrisas_izquierdo']) ?></td>
                                                        <td><?= ControladorInventario::TraducirEstadoInventario($value['Parabrisas_derecho']) ?></td>
                                                        <td><?= ControladorInventario::TraducirEstadoInventario($value['Espejo_retrovisor_derecho']) ?></td>
                                                        <td><?= ControladorInventario::TraducirEstadoInventario($value['Espejo_retrovisor_izquierdo']) ?></td>
                                                        <td><?= ControladorInventario::TraducirEstadoInventario($value['Vidrios_ventanas_lateral_derecho']) ?></td>
                                                        <td><?= ControladorInventario::TraducirEstadoInventario($value['Vidrios_ventanas_lateral_izquierdo']) ?></td>
                                                        <td><?= ControladorInventario::TraducirEstadoInventario($value['parabrisas_trasero']) ?></td>
                                                        <td><?= ControladorInventario::TraducirEstadoInventario($value['Vidrios_puertas']) ?></td>
                                                        <td><?= ControladorInventario::TraducirEstadoInventario($value['Direccional_delantera_izquierda']) ?></td>
                                                        <td><?= ControladorInventario::TraducirEstadoInventario($value['Direccional_delantera_derecha']) ?></td>
                                                        <td><?= ControladorInventario::TraducirEstadoInventario($value['Stop_trasero_derecho']) ?></td>
                                                        <td><?= ControladorInventario::TraducirEstadoInventario($value['Stop_trasero_izquierdo']) ?></td>
                                                        <td><?= ControladorInventario::TraducirEstadoInventario($value['Cucuyo_lateral_derecho']) ?></td>
                                                        <td><?= ControladorInventario::TraducirEstadoInventario($value['Cucuyo_lateral_izquierdo']) ?></td>
                                                        <td><?= $value['numero_luces_internas'] ?></td>
                                                        <td><?= ControladorInventario::TraducirEstadoInventario($value['Luces_internas']) ?></td>
                                                        <td><?= ControladorInventario::TraducirEstadoInventario($value['balizas']) ?></td>
                                                        <td><?= ControladorInventario::TraducirEstadoInventario($value['Delantera_izquierda_R1']) ?></td>
                                                        <td><?= ControladorInventario::TraducirEstadoInventario($value['Delantera_derecha_R2']) ?></td>
                                                        <td><?= ControladorInventario::TraducirEstadoInventario($value['Trasera_interior_izquierda_R3']) ?></td>
                                                        <td><?= ControladorInventario::TraducirEstadoInventario($value['Trasera_exterior_izquierda_R4']) ?></td>
                                                        <td><?= ControladorInventario::TraducirEstadoInventario($value['Trasera_interior_derecha_R5']) ?></td>
                                                        <td><?= ControladorInventario::TraducirEstadoInventario($value['Trasera_exterior_derecha_R6']) ?></td>
                                                        <td><?= ControladorInventario::TraducirEstadoInventario($value['Gato']) ?></td>
                                                        <td><?= ControladorInventario::TraducirEstadoInventario($value['Cruceta_Copa']) ?></td>
                                                        <td><?= ControladorInventario::TraducirEstadoInventario($value['2Conos_Triangulos']) ?></td>
                                                        <td><?= ControladorInventario::TraducirEstadoInventario($value['Botiquin']) ?></td>
                                                        <td><?= ControladorInventario::TraducirEstadoInventario($value['Extintor']) ?></td>
                                                        <td><?= ControladorInventario::TraducirEstadoInventario($value['2Tacos_Bloques']) ?></td>
                                                        <td><?= ControladorInventario::TraducirEstadoInventario($value['Alicate_destornillador']) ?></td>
                                                        <td><?= ControladorInventario::TraducirEstadoInventario($value['Llave_expancion_Llaves_fijas']) ?></td>
                                                        <td><?= ControladorInventario::TraducirEstadoInventario($value['Llanta_repuesto']) ?></td>
                                                        <td><?= ControladorInventario::TraducirEstadoInventario($value['Linterna_pila']) ?></td>
                                                        <td><?= ControladorInventario::TraducirEstadoInventario($value['Cinturon_conductor']) ?></td>
                                                        <td><?= ControladorInventario::TraducirEstadoInventario($value['Radiotelefono']) ?></td>
                                                        <td><?= ControladorInventario::TraducirEstadoInventario($value['Antena']) ?></td>
                                                        <td><?= ControladorInventario::TraducirEstadoInventario($value['Equipo_Sonido']) ?></td>
                                                        <td><?= $usb_cd ?></td>
                                                        <td><?= ControladorInventario::TraducirEstadoInventario($value['Parlantes']) ?></td>
                                                        <td><?= $value['num_parlantes'] ?></td>
                                                        <td><?= ControladorInventario::TraducirEstadoInventario($value['Manguera_agua']) ?></td>
                                                        <td><?= ControladorInventario::TraducirEstadoInventario($value['Manguera_aire']) ?></td>
                                                        <td><?= ControladorInventario::TraducirEstadoInventario($value['Pantalla_Televisor']) ?></td>
                                                        <td><?= ControladorInventario::TraducirEstadoInventario($value['Reloj']) ?></td>
                                                        <td><?= ControladorInventario::TraducirEstadoInventario($value['Brazo_1_Izquierdo_R1']) ?></td>
                                                        <td><?= ControladorInventario::TraducirEstadoInventario($value['Brazo_2_Derecho_R2']) ?></td>
                                                        <td><?= ControladorInventario::TraducirEstadoInventario($value['Brazo_3_Izquierdo_R3']) ?></td>
                                                        <td><?= ControladorInventario::TraducirEstadoInventario($value['Brazo_4_Derecho_R6']) ?></td>
                                                        <td><?= ControladorInventario::TraducirEstadoInventario($value['Emblema_izquierdo_empresa']) ?></td>
                                                        <td><?= ControladorInventario::TraducirEstadoInventario($value['Emblema_derecho_empresa']) ?></td>
                                                        <td><?= ControladorInventario::TraducirEstadoInventario($value['escolar']) ?></td>
                                                        <td><?= $escolar ?></td>
                                                        <td><?= ControladorInventario::TraducirEstadoInventario($value['Logo_izquierdo']) ?></td>
                                                        <td><?= ControladorInventario::TraducirEstadoInventario($value['Logo_derecho']) ?></td>
                                                        <td><?= ControladorInventario::TraducirEstadoInventario($value['N_Interno_delantero']) ?></td>
                                                        <td><?= ControladorInventario::TraducirEstadoInventario($value['N_Interno_trasero']) ?></td>
                                                        <td><?= ControladorInventario::TraducirEstadoInventario($value['N_Interno_izquierdo']) ?></td>
                                                        <td><?= ControladorInventario::TraducirEstadoInventario($value['N_Interno_derecho']) ?></td>
                                                        <td><?= ControladorInventario::TraducirEstadoInventario($value['Salidas_emergencia_martillos']) ?></td>
                                                        <td><?= $value['Nsalidas_martillos'] ?></td>
                                                        <td><?= ControladorInventario::TraducirEstadoInventario($value['Dispositivo_velocidad']) ?></td>
                                                        <td><?= ControladorInventario::TraducirEstadoInventario($value['Av_Como_conduzco']) ?></td>
                                                        <td><?= $avconduzco ?></td>
                                                        <td><?= ControladorInventario::TraducirEstadoInventario($value['Brazo_limpiaparabrisas_izquierdo']) ?></td>
                                                        <td><?= ControladorInventario::TraducirEstadoInventario($value['Plumilla_limpiaparabrisas_izquierdo']) ?></td>
                                                        <td><?= ControladorInventario::TraducirEstadoInventario($value['Brazo_limpiaparabrisas_derecho']) ?></td>
                                                        <td><?= ControladorInventario::TraducirEstadoInventario($value['Plumilla_limpiaparabrisas_derecho']) ?></td>
                                                        <td><?= ControladorInventario::TraducirEstadoInventario($value['Baterias']) ?></td>
                                                        <td><?= ControladorInventario::TraducirEstadoInventario($value['Botones_tablero_timon']) ?></td>
                                                        <td><?= ControladorInventario::TraducirEstadoInventario($value['Tapa_radiador']) ?></td>
                                                        <td><?= ControladorInventario::TraducirEstadoInventario($value['Tapa_deposito_hidraulico']) ?></td>
                                                        <td><?= ControladorInventario::TraducirEstadoInventario($value['Cojineria_general']) ?></td>
                                                        <td><?= ControladorInventario::TraducirEstadoInventario($value['Cinturon_sillas_calidad']) ?></td>
                                                        <td><?= ControladorInventario::TraducirEstadoInventario($value['Pasamanos']) ?></td>
                                                        <td><?= ControladorInventario::TraducirEstadoInventario($value['Claxon']) ?></td>
                                                        <td><?= ControladorInventario::TraducirEstadoInventario($value['Placas_reglamentarias']) ?></td>
                                                    </tr>
                                                <?php endforeach ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>