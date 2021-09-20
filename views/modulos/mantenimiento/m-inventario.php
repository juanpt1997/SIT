<?php

// if (!validarModulo('CARGAR_OPCION')) {
//     echo "<script> window.location = 'inicio'; </script>";
// }


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
                    <h1 class="m-0 text-dark "><b><i>Inventario Vehicular</i></b></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                        <li class="breadcrumb-item active">Plantilla</li>
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
            <div class="row mt-2">
                <div class="col-12 col-lg">
                    <div class="card card-outline card-success">
                        <div class="card-body">
                            <!-- ===================== 
                            CARD DE INVENTARIO SAMAN
                            ========================= -->
                            <div class="card card-success collapsed-card">
                                <div class="card-header">
                                    <h3 class="card-title">SAMAN</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body" style="display: none;">
                                    <div class="chart">
                                        <div class="chartjs-size-monitor">
                                            <div class="chartjs-size-monitor-expand">
                                                <div class=""></div>
                                            </div>
                                            <div class="chartjs-size-monitor-shrink">
                                                <div class=""></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-5 col-sm-3">
                                                    <div class="nav flex-column nav-tabs h-100" id="vert-tabs-tab" role="tablist" aria-orientation="vertical">
                                                        <a class="nav-link active" id="vert-tabs-homesaman-tab" data-toggle="pill" href="#vert-tabs-homesaman" role="tab" aria-controls="vert-tabs-homesaman" aria-selected="true">Inventario</a>
                                                    </div>
                                                </div>

                                                <div class="col col-lg">

                                                    <div class="form-group">
                                                        <label for="exampleSelectRounded0">Seleccione tipo de vehiculo</label>
                                                        <select class="custom-select rounded-0" id="selectbusocamioneta" name="selectbusocamioneta">
                                                            <option>Bus - Buseta</option>
                                                            <option>Camioneta - Microbus</option>
                                                        </select>
                                                    </div>

                                                    <!-- /.ESTE ES EL TAB MADRE DEL CUESTIONARIO-->
                                                    <div class="tab-content table-responsive" id="vert-tabs-tabContent">
                                                        <div class="tab-pane text-left fade active show" id="vert-tabs-homesaman" role="tabpanel" aria-labelledby="vert-tabs-homesaman-tab">
                                                            <table class="table table-bordered text-center text-nowrap">
                                                                <tbody>
                                                                    <tr>
                                                                        <td colspan="13">
                                                                            <h4>INVENTARIO DE VEHÍCULO</h4>
                                                                        </td>
                                                                        <td colspan="4">Codigo: GH-FR-04 <br> Version: 2</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td colspan="5">
                                                                            <label>Numero interno</label>
                                                                            <div class="col">
                                                                                <input type="text" class="form-control" placeholder="Numero interno:" id="Numero_interno" name="Numero_interno">
                                                                            </div>
                                                                        </td>
                                                                        <td colspan="5">
                                                                            <label>Marca</label>
                                                                            <div class="col">
                                                                                <input type="text" class="form-control" placeholder="Marca:" id="marca" name="marca">
                                                                            </div>
                                                                        </td>
                                                                        <td colspan="3">
                                                                            <label>Clase de Vehículo</label>
                                                                            <div class="col">
                                                                                <input type="text" class="form-control" placeholder="Clade de Vehiculo" id="clasevehiculo" name="clasevehiculo">
                                                                            </div>
                                                                        </td>
                                                                        <td colspan="4">
                                                                            <label>Fecha</label>
                                                                            <div class="col">
                                                                                <input type="date" class="form-control" placeholder="Fecha" id="fecha" name="fecha">
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td colspan="5">
                                                                            <label>Placa</label>
                                                                            <div class="col">
                                                                                <input type="text" class="form-control" placeholder="Placa:" id="placa" name="placa">
                                                                            </div>
                                                                        </td>
                                                                        <td colspan="5">
                                                                            <label>Modelo</label>
                                                                            <div class="col">
                                                                                <input type="text" class="form-control" placeholder="Modelo:" id="modelo" name="modelo">
                                                                            </div>
                                                                        </td>
                                                                        <td colspan="3">
                                                                            <label>Kilometraje</label>
                                                                            <div class="col">
                                                                                <input type="text" class="form-control" placeholder="Kilometraje:" id="kilometraje" name="kilometraje">
                                                                            </div>
                                                                        </td>
                                                                        <td><b>Entrega de vehículo</b></td>
                                                                        <td>
                                                                            <div class="custom-control custom-checkbox">
                                                                                <input class="custom-control-input" type="checkbox" id="entregaveh" name="entregaveh" value="option1">
                                                                                <label for="entregaveh" class="custom-control-label"></label>
                                                                            </div>
                                                                        </td>
                                                                        <td><b>Recepción de vehículo</b></td>
                                                                        <td>
                                                                            <div class="custom-control custom-checkbox">
                                                                                <input class="custom-control-input" type="checkbox" id="recepveh" name="recepveh" value="option1">
                                                                                <label for="recepveh" class="custom-control-label"></label>
                                                                            </div>
                                                                        </td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td colspan="6">
                                                                            <label>Conductor</label>
                                                                            <div class="col">
                                                                                <input type="text" class="form-control" placeholder="Ingrese nombre conductor" id="conductor" name="conductor">
                                                                            </div>
                                                                        </td>
                                                                        <td colspan="6">
                                                                            <label>Categoría licencia</label>
                                                                            <div class="col">
                                                                                <input type="text" class="form-control" placeholder="Ingrese categoria" id="categolicencia" name="categolicencia">
                                                                            </div>
                                                                        </td>
                                                                        <td colspan="5">
                                                                            <label>Vencimiento licencia</label>
                                                                            <div class="col">
                                                                                <input type="date" class="form-control" id="vencilicencia" name="vencilicencia">
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                            <div class="row">
                                                                <div class="col">
                                                                    <div class="card card-info card-tabs">
                                                                        <div class="card-header p-0 pt-1">
                                                                            <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist" style="text-decoration: none;">
                                                                                <li class="nav-item">
                                                                                    <a class="nav-link active" id="custom-tabs-one-lamina-tab" data-toggle="pill" href="#custom-tabs-one-lamina" role="tab" aria-controls="custom-tabs-one-lamina" aria-selected="true">Lamina</a>
                                                                                </li>
                                                                                <li class="nav-item">
                                                                                    <a class="nav-link" id="custom-tabs-one-vidriosespejos-tab" data-toggle="pill" href="#custom-tabs-one-vidriosespejos" role="tab" aria-controls="custom-tabs-one-vidriosespejos" aria-selected="false">Vidrios y Espejos</a>
                                                                                </li>
                                                                                <li class="nav-item">
                                                                                    <a class="nav-link" id="custom-tabs-one-luces-tab" data-toggle="pill" href="#custom-tabs-one-luces" role="tab" aria-controls="custom-tabs-one-luces" aria-selected="false">Luces</a>
                                                                                </li>
                                                                                <li class="nav-item">
                                                                                    <a class="nav-link" id="custom-tabs-one-llantas-tab" data-toggle="pill" href="#custom-tabs-one-llantas" role="tab" aria-controls="custom-tabs-one-llantas" aria-selected="false">Llantas</a>
                                                                                </li>
                                                                                <li class="nav-item">
                                                                                    <a class="nav-link" id="custom-tabs-one-preveseguridad-tab" data-toggle="pill" href="#custom-tabs-one-preveseguridad" role="tab" aria-controls="custom-tabs-one-preveseguridad" aria-selected="false">Prevencion y Seguridad</a>
                                                                                </li>
                                                                                <li class="nav-item">
                                                                                    <a class="nav-link" id="custom-tabs-one-documentosveh-tab" data-toggle="pill" href="#custom-tabs-one-documentosveh" role="tab" aria-controls="custom-tabs-one-documentosveh" aria-selected="false">Documentos Vehiculo</a>
                                                                                </li>
                                                                                <li class="nav-item">
                                                                                    <a class="nav-link" id="custom-tabs-one-extintor-tab" data-toggle="pill" href="#custom-tabs-one-extintor" role="tab" aria-controls="custom-tabs-one-extintor" aria-selected="false">Extintor</a>
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
                                                                        <div class="card-body">
                                                                            <div class="tab-content" id="custom-tabs-one-tabContent">
                                                                                <!-- /.TAB DE LAMINAS -->
                                                                                <div class="tab-pane fade active show" id="custom-tabs-one-lamina" role="tabpanel" aria-labelledby="custom-tabs-one-lamina-tab">
                                                                                    <div class="table table-responsive">
                                                                                        <div class="row">
                                                                                            <div class="col">
                                                                                                <div class="position-relative p-3 bg-transparent" style="height: 520px">
                                                                                                    <table class="table table-bordered text-center text-nowrap">
                                                                                                        <tbody>
                                                                                                            <tr>
                                                                                                                <td colspan="2"><b>LAMINAS</b></td>
                                                                                                                <td style="width: 15px;">Bueno</td>
                                                                                                                <td style="width: 15px;">Rayado</td>
                                                                                                                <td style="width: 15px;">Golpe</td>
                                                                                                            </tr>

                                                                                                            <tr>
                                                                                                                <td style="width: 10px;">1.</td>
                                                                                                                <td>Techo_exterior</td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-success d-inline">
                                                                                                                        <input type="radio" id="Techo_exterior1" name="Techo_exterior" value="1">
                                                                                                                        <label for="Techo_exterior1">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-danger d-inline">
                                                                                                                        <input type="radio" id="Techo_exterior4" name="Techo_exterior" value="4">
                                                                                                                        <label for="Techo_exterior4">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-danger d-inline">
                                                                                                                        <input type="radio" id="Techo_exterior5" name="Techo_exterior" value="5">
                                                                                                                        <label for="Techo_exterior5">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                            </tr>

                                                                                                            <tr>
                                                                                                                <td style="width: 10px;">2.</td>
                                                                                                                <td>Techo interior</td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-success d-inline">
                                                                                                                        <input type="radio" id="Techo_interior1" name="Techo_interior" value="1">
                                                                                                                        <label for="Techo_interior1">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-danger d-inline">
                                                                                                                        <input type="radio" id="Techo_interior4" name="Techo_interior" value="4">
                                                                                                                        <label for="Techo_interior4">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-danger d-inline">
                                                                                                                        <input type="radio" id="Techo_interior5" name="Techo_interior" value="5">
                                                                                                                        <label for="Techo_interior5">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                            </tr>

                                                                                                            <tr>
                                                                                                                <td style="width: 10px;">3.</td>
                                                                                                                <td>Frente</td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-success d-inline">
                                                                                                                        <input type="radio" id="Frente1" name="Frente" value="1">
                                                                                                                        <label for="Frente1">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-danger d-inline">
                                                                                                                        <input type="radio" id="Frente4" name="Frente" value="4">
                                                                                                                        <label for="Frente4">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-danger d-inline">
                                                                                                                        <input type="radio" id="Frente5" name="Frente" value="5">
                                                                                                                        <label for="Frente5">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                            </tr>

                                                                                                            <tr>
                                                                                                                <td style="width: 10px;">4.</td>
                                                                                                                <td>Bomper delantero</td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-success d-inline">
                                                                                                                        <input type="radio" id="Bomper_delantero1" name="Bomper_delantero" value="1">
                                                                                                                        <label for="Bomper_delantero1">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-danger d-inline">
                                                                                                                        <input type="radio" id="Bomper_delantero4" name="Bomper_delantero" value="4">
                                                                                                                        <label for="Bomper_delantero4">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-danger d-inline">
                                                                                                                        <input type="radio" id="Bomper_delantero5" name="Bomper_delantero" value="5">
                                                                                                                        <label for="Bomper_delantero5">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                            </tr>

                                                                                                            <tr>
                                                                                                                <td style="width: 10px;">5.</td>
                                                                                                                <td>Bomper trasero</td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-success d-inline">
                                                                                                                        <input type="radio" id="Bomper_trasero1" name="Bomper_trasero" value="1">
                                                                                                                        <label for="Bomper_trasero1">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-danger d-inline">
                                                                                                                        <input type="radio" id="Bomper_trasero4" name="Bomper_trasero" value="4">
                                                                                                                        <label for="Bomper_trasero4">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-danger d-inline">
                                                                                                                        <input type="radio" id="Bomper_trasero5" name="Bomper_trasero" value="5">
                                                                                                                        <label for="Bomper_trasero5">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                            </tr>

                                                                                                            <tr>
                                                                                                                <td style="width: 10px;">6.</td>
                                                                                                                <td>Lateral derecho</td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-success d-inline">
                                                                                                                        <input type="radio" id="Lateral_derecho1" name="Lateral_derecho" value="1">
                                                                                                                        <label for="Lateral_derecho1">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-danger d-inline">
                                                                                                                        <input type="radio" id="Lateral_derecho4" name="Lateral_derecho" value="4">
                                                                                                                        <label for="Lateral_derecho4">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-danger d-inline">
                                                                                                                        <input type="radio" id="Lateral_derecho5" name="Lateral_derecho" value="5">
                                                                                                                        <label for="Lateral_derecho5">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                            </tr>

                                                                                                            <tr>
                                                                                                                <td style="width: 10px;">7.</td>
                                                                                                                <td>Lateral izquierdo</td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-success d-inline">
                                                                                                                        <input type="radio" id="Lateral_izquierdo1" name="Lateral_izquierdo" value="1">
                                                                                                                        <label for="Lateral_izquierdo1">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-danger d-inline">
                                                                                                                        <input type="radio" id="Lateral_izquierdo4" name="Lateral_izquierdo" value="4">
                                                                                                                        <label for="Lateral_izquierdo4">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-danger d-inline">
                                                                                                                        <input type="radio" id="Lateral_izquierdo5" name="Lateral_izquierdo" value="5">
                                                                                                                        <label for="Lateral_izquierdo5">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                            </tr>

                                                                                                            <tr>
                                                                                                                <td style="width: 10px;">8.</td>
                                                                                                                <td>Puerta derecha</td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-success d-inline">
                                                                                                                        <input type="radio" id="Puerta_derecho1" name="Puerta_derecho" value="1">
                                                                                                                        <label for="Puerta_derecho1">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-danger d-inline">
                                                                                                                        <input type="radio" id="Puerta_derecho4" name="Puerta_derecho" value="4">
                                                                                                                        <label for="Puerta_derecho4">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-danger d-inline">
                                                                                                                        <input type="radio" id="Puerta_derecho5" name="Puerta_derecho" value="5">
                                                                                                                        <label for="Puerta_derecho5">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                            </tr>

                                                                                                            <tr>
                                                                                                                <td style="width: 10px;">9.</td>
                                                                                                                <td>Puerta izquierda</td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-success d-inline">
                                                                                                                        <input type="radio" id="Puerta_izquierda1" name="Puerta_izquierda" value="1">
                                                                                                                        <label for="Puerta_izquierda1">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-danger d-inline">
                                                                                                                        <input type="radio" id="Puerta_izquierda4" name="Puerta_izquierda" value="4">
                                                                                                                        <label for="Puerta_izquierda4">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-danger d-inline">
                                                                                                                        <input type="radio" id="Puerta_izquierda5" name="Puerta_izquierda" value="5">
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
                                                                                </div>

                                                                                <!-- /.TAB VIDRIOS Y ESPEJOS -->
                                                                                <div class="tab-pane fade" id="custom-tabs-one-vidriosespejos" role="tabpanel" aria-labelledby="custom-tabs-one-vidriosespejos-tab">
                                                                                    <div class="table table-responsive">
                                                                                        <div class="row">
                                                                                            <div class="col">
                                                                                                <div class="position-relative p-3 bg-transparent" style="height: 480px">
                                                                                                    <table class="table table-bordered text-center text-nowrap">
                                                                                                        <tbody>
                                                                                                            <tr>
                                                                                                                <td colspan="2"><b>VIDRIOS Y ESPEJOS</b></td>
                                                                                                                <td style="width: 15px;">Bueno</td>
                                                                                                                <td style="width: 15px;">Malo</td>
                                                                                                            </tr>

                                                                                                            <tr>
                                                                                                                <td style="width: 10px;">10.</td>
                                                                                                                <td>Parabrisas izquierdo</td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-success d-inline">
                                                                                                                        <input type="radio" id="parabrisas_izquierdo1" name="parabrisas_izquierdo" value="1">
                                                                                                                        <label for="parabrisas_izquierdo1">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-success d-inline">
                                                                                                                        <input type="radio" id="parabrisas_izquierdo2" name="parabrisas_izquierdo" value="0">
                                                                                                                        <label for="parabrisas_izquierdo2">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                            </tr>

                                                                                                            <tr>
                                                                                                                <td style="width: 10px;">11.</td>
                                                                                                                <td>Parabrisas derecho</td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-success d-inline">
                                                                                                                        <input type="radio" id="parabrisas_derecho1" name="parabrisas_derecho" value="1">
                                                                                                                        <label for="parabrisas_derecho1">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-success d-inline">
                                                                                                                        <input type="radio" id="parabrisas_derecho2" name="parabrisas_derecho" value="0">
                                                                                                                        <label for="parabrisas_derecho2">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                            </tr>

                                                                                                            <tr>
                                                                                                                <td style="width: 10px;">12.</td>
                                                                                                                <td>Espejo retrovisor derecho</td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-success d-inline">
                                                                                                                        <input type="radio" id="Espejo_retrovisor_derecho1" name="Espejo_retrovisor_derecho" value="1">
                                                                                                                        <label for="Espejo_retrovisor_derecho1">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-success d-inline">
                                                                                                                        <input type="radio" id="Espejo_retrovisor_derecho2" name="Espejo_retrovisor_derecho" value="0">
                                                                                                                        <label for="Espejo_retrovisor_derecho2">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                            </tr>

                                                                                                            <tr>
                                                                                                                <td style="width: 10px;">13.</td>
                                                                                                                <td>Espejo retrovisor izquierdo</td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-success d-inline">
                                                                                                                        <input type="radio" id="Espejo_retrovisor_izquierdo1" name="Espejo_retrovisor_izquierdo" value="1">
                                                                                                                        <label for="Espejo_retrovisor_izquierdo1">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-success d-inline">
                                                                                                                        <input type="radio" id="Espejo_retrovisor_izquierdo2" name="Espejo_retrovisor_izquierdo" value="0">
                                                                                                                        <label for="Espejo_retrovisor_izquierdo2">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                            </tr>

                                                                                                            <tr>
                                                                                                                <td style="width: 10px;">14.</td>
                                                                                                                <td>Vidrios ventanas lateral derecho</td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-success d-inline">
                                                                                                                        <input type="radio" id="Vidrios_ventanas_lateral_derecho1" name="Vidrios_ventanas_lateral_derecho" value="1">
                                                                                                                        <label for="Vidrios_ventanas_lateral_derecho1">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-success d-inline">
                                                                                                                        <input type="radio" id="Vidrios_ventanas_lateral_derecho2" name="Vidrios_ventanas_lateral_derecho" value="0">
                                                                                                                        <label for="Vidrios_ventanas_lateral_derecho2">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                            </tr>

                                                                                                            <tr>
                                                                                                                <td style="width: 10px;">15.</td>
                                                                                                                <td>Vidrios ventanas lateral izquierdo</td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-success d-inline">
                                                                                                                        <input type="radio" id="Vidrios_ventanas_lateral_izquierdo1" name="Vidrios_ventanas_lateral_izquierdo" value="1">
                                                                                                                        <label for="Vidrios_ventanas_lateral_izquierdo1">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-success d-inline">
                                                                                                                        <input type="radio" id="Vidrios_ventanas_lateral_izquierdo2" name="Vidrios_ventanas_lateral_izquierdo" value="0">
                                                                                                                        <label for="Vidrios_ventanas_lateral_izquierdo2">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                            </tr>

                                                                                                            <tr>
                                                                                                                <td style="width: 10px;">16.</td>
                                                                                                                <td>Parabrisas trasero</td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-success d-inline">
                                                                                                                        <input type="radio" id="Parabrisas_trasero1" name="Parabrisas_trasero" value="1">
                                                                                                                        <label for="Parabrisas_ trasero1">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-success d-inline">
                                                                                                                        <input type="radio" id="Parabrisas_trasero2" name="Parabrisas_trasero" value="0">
                                                                                                                        <label for="Parabrisas_trasero2">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                            </tr>

                                                                                                            <tr>
                                                                                                                <td style="width: 10px;">17.</td>
                                                                                                                <td>Vidrios de puertas</td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-success d-inline">
                                                                                                                        <input type="radio" id="Vidrios_puertas1" name="Vidrios_puertas" value="1">
                                                                                                                        <label for="Vidrios_puertas1">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-success d-inline">
                                                                                                                        <input type="radio" id="Vidrios_puertas2" name="Vidrios_puertas" value="0">
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
                                                                                </div>

                                                                                <!-- /.TAB DE LUCES -->
                                                                                <div class="tab-pane fade" id="custom-tabs-one-luces" role="tabpanel" aria-labelledby="custom-tabs-one-luces-tab">
                                                                                    <div class="table table-responsive">
                                                                                        <div class="row">
                                                                                            <div class="col">
                                                                                                <div class="position-relative p-3 bg-transparent" style="height: 510px">
                                                                                                    <table class="table table-bordered text-center text-nowrap">
                                                                                                        <tbody>
                                                                                                            <tr>
                                                                                                                <td colspan="2"><b>LUCES</b></td>
                                                                                                                <td style="width: 15px;">Bueno</td>
                                                                                                                <td style="width: 15px;">Malo</td>
                                                                                                                <td style="width: 15px;">N/A</td>
                                                                                                            </tr>

                                                                                                            <tr>
                                                                                                                <td style="width: 10px;">18.</td>
                                                                                                                <td>Direccional delantera izquierda</td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-success d-inline">
                                                                                                                        <input type="radio" id="Direccional_izquierda1" name="Direccionalelantera_izquierda" value="1">
                                                                                                                        <label for="Direccional_izquierda1">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-danger d-inline">
                                                                                                                        <input type="radio" id="Direccional_izquierda4" name="Direccionalelantera_izquierda" value=" 0">
                                                                                                                        <label for="Direccional_izquierda4">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-danger d-inline">
                                                                                                                        <input type="radio" id="Direccional_izquierda5" name="Direccionalelantera_izquierda" value="2">
                                                                                                                        <label for="Direccional_izquierda5">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                            </tr>

                                                                                                            <tr>
                                                                                                                <td style="width: 10px;">19.</td>
                                                                                                                <td>Direccional delantera derecha</td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-success d-inline">
                                                                                                                        <input type="radio" id="Direccional_derecha1" name="Direccional_elantera_derecha" value="1">
                                                                                                                        <label for="Direccional_derecha1">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-danger d-inline">
                                                                                                                        <input type="radio" id="Direccional_derecha4" name="Direccional_elantera_derecha" value=" 0">
                                                                                                                        <label for="Direccional_derecha4">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-danger d-inline">
                                                                                                                        <input type="radio" id="Direccional_derecha5" name="Direccional_elantera_derecha" value="2">
                                                                                                                        <label for="Direccional_derecha5">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                            </tr>

                                                                                                            <tr>
                                                                                                                <td style="width: 10px;">20.</td>
                                                                                                                <td>Stop trasero derecho</td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-success d-inline">
                                                                                                                        <input type="radio" id="Stop_trasero_derecho1" name="Stop_trasero_derecho" value="1">
                                                                                                                        <label for="Stop_trasero_derecho1">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-danger d-inline">
                                                                                                                        <input type="radio" id="Stop_trasero_derecho4" name="Stop_trasero_derecho" value=" 0">
                                                                                                                        <label for="Stop_trasero_derecho4">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-danger d-inline">
                                                                                                                        <input type="radio" id="Stop_trasero_derecho5" name="Stop_trasero_derecho" value="2">
                                                                                                                        <label for="Stop_trasero_derecho5">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                            </tr>

                                                                                                            <tr>
                                                                                                                <td style="width: 10px;">21.</td>
                                                                                                                <td>Stop trasero izquierdo</td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-success d-inline">
                                                                                                                        <input type="radio" id="Stop_trasero_izquierdo1" name="Stop_trasero_izquierdo" value="1">
                                                                                                                        <label for="Stop_trasero_izquierdo1">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-danger d-inline">
                                                                                                                        <input type="radio" id="Stop_trasero_izquierdo4" name="Stop_trasero_izquierdo" value=" 0">
                                                                                                                        <label for="Stop_trasero_izquierdo4">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-danger d-inline">
                                                                                                                        <input type="radio" id="Stop_trasero_izquierdo5" name="Stop_trasero_izquierdo" value="2">
                                                                                                                        <label for="Stop_trasero_izquierdo5">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                            </tr>

                                                                                                            <tr>
                                                                                                                <td style="width: 10px;">22.</td>
                                                                                                                <td>Cucuyo lateral derecho</td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-success d-inline">
                                                                                                                        <input type="radio" id="Cucuyo_lateral_derecho1" name="Cucuyo_lateral_derecho" value="1">
                                                                                                                        <label for="Cucuyo_lateral_derecho1">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-danger d-inline">
                                                                                                                        <input type="radio" id="Cucuyo_lateral_derecho4" name="Cucuyo_lateral_derecho" value=" 0">
                                                                                                                        <label for="Cucuyo_lateral_derecho4">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-danger d-inline">
                                                                                                                        <input type="radio" id="Cucuyo_lateral_derecho5" name="Cucuyo_lateral_derecho" value="2">
                                                                                                                        <label for="Cucuyo_lateral_derecho5">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                            </tr>

                                                                                                            <tr>
                                                                                                                <td style="width: 10px;">23.</td>
                                                                                                                <td>Cucuyo lateral izquierdo</td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-success d-inline">
                                                                                                                        <input type="radio" id="Cucuyo_lateral_izquierdo1" name="Cucuyo_lateral_izquierdo" value="1">
                                                                                                                        <label for="Cucuyo_lateral_izquierdo1">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-danger d-inline">
                                                                                                                        <input type="radio" id="Cucuyo_lateral_izquierdo4" name="Cucuyo_lateral_izquierdo" value=" 0">
                                                                                                                        <label for="Cucuyo_lateral_izquierdo4">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-danger d-inline">
                                                                                                                        <input type="radio" id="Cucuyo_lateral_izquierdo5" name="Cucuyo_lateral_izquierdo" value="2">
                                                                                                                        <label for="Cucuyo_lateral_izquierdo5">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                            </tr>

                                                                                                            <tr>
                                                                                                                <td style="width: 10px;">24.</td>
                                                                                                                <td>
                                                                                                                    Luces internas
                                                                                                                    <div class="input-group sm-3">
                                                                                                                        <div class="input-group-prepend">
                                                                                                                            <button type="button" class="btn btn-default" id="numlucesinter" name="numlucesinter">Digite numero de luces internas</button>
                                                                                                                        </div>
                                                                                                                        <!-- /btn-group -->
                                                                                                                        <input type="text" class="form-control" placeholder="# ...">
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-danger d-inline">
                                                                                                                        <input type="radio" id="Luces_internas1" name="Luces_internas" value="1">
                                                                                                                        <label for="Luces_internas1">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-danger d-inline">
                                                                                                                        <input type="radio" id="Luces_internas4" name="Luces_internas" value="0">
                                                                                                                        <label for="Luces_internas4">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-danger d-inline">
                                                                                                                        <input type="radio" id="Luces_internas5" name="Luces_internas" value="2">
                                                                                                                        <label for="Luces_internas5">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                            </tr>

                                                                                                            <tr>
                                                                                                                <td style="width: 10px;">25.</td>
                                                                                                                <td>Balizas ( Licuadoras )</td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-danger d-inline">
                                                                                                                        <input type="radio" id="Balizas1" name="Balizas" value="1">
                                                                                                                        <label for="Balizas1">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-danger d-inline">
                                                                                                                        <input type="radio" id="Balizas4" name="Balizas" value="0">
                                                                                                                        <label for="Balizas4">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-danger d-inline">
                                                                                                                        <input type="radio" id="Balizas5" name="Balizas" value="2">
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
                                                                                </div>

                                                                                <!-- /.TAB DE LLANTAS -->
                                                                                <div class="tab-pane fade" id="custom-tabs-one-llantas" role="tabpanel" aria-labelledby="custom-tabs-one-llantas-tab">
                                                                                    <div class="table table-responsive">
                                                                                        <div class="row">
                                                                                            <div class="col">
                                                                                                <div class="position-relative p-3 bg-transparent" style="height: 380px">
                                                                                                    <table class="table table-bordered text-center text-nowrap">
                                                                                                        <tbody>
                                                                                                            <tr>
                                                                                                                <td colspan="2"><b>LLANTAS</b></td>
                                                                                                                <td style="width: 15px;">Reg/</td>
                                                                                                                <td style="width: 15px;">Bueno</td>
                                                                                                                <td style="width: 15px;">Malo</td>
                                                                                                            </tr>

                                                                                                            <tr>
                                                                                                                <td style="width: 10px;">26.</td>
                                                                                                                <td>Delantera izquierda ( R1 )</td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-danger d-inline">
                                                                                                                        <input type="radio" id="Delantera_izquierda_R11" name="Delantera_izquierda_R1" value="3">
                                                                                                                        <label for="Delantera_izquierda_R11">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-success d-inline">
                                                                                                                        <input type="radio" id="Delantera_izquierda_R14" name="Delantera_izquierda_R1" value="1">
                                                                                                                        <label for="Delantera_izquierda_R14">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-danger d-inline">
                                                                                                                        <input type="radio" id="Delantera_izquierda_R15" name="Delantera_izquierda_R1" value="0">
                                                                                                                        <label for="Delantera_izquierda_R15">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>

                                                                                                            </tr>

                                                                                                            <tr>
                                                                                                                <td style="width: 10px;">27.</td>
                                                                                                                <td>Delantera derecha ( R2 )</td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-danger d-inline">
                                                                                                                        <input type="radio" id="Delantera_derecha_R21" name="Delantera_izquierda_R2" value="3">
                                                                                                                        <label for="Delantera_derecha_R21">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-success d-inline">
                                                                                                                        <input type="radio" id="Delantera_izquierda_R24" name="Delantera_izquierda_R2" value="1">
                                                                                                                        <label for="Delantera_izquierda_R24">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-danger d-inline">
                                                                                                                        <input type="radio" id="Delantera_izquierda_R25" name="Delantera_izquierda_R2" value="0">
                                                                                                                        <label for="Delantera_izquierda_R25">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                            </tr>

                                                                                                            <tr>
                                                                                                                <td style="width: 10px;">28.</td>
                                                                                                                <td>Trasera interior izquierda ( R3 )</td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-danger d-inline">
                                                                                                                        <input type="radio" id="Trasera_interior_izquierda_R31" name="Trasera_interior_izquierda_R3" value="3">
                                                                                                                        <label for="Trasera_interior_izquierda_R31">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-success d-inline">
                                                                                                                        <input type="radio" id="Trasera_interior_izquierda_R34" name="Trasera_interior_izquierda_R3" value="1">
                                                                                                                        <label for="Trasera_interior_izquierda_R34">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-danger d-inline">
                                                                                                                        <input type="radio" id="Trasera_interior_izquierda_R3_5" name="Trasera_interior_izquierda_R3" value="0">
                                                                                                                        <label for="Trasera_interior_izquierda_R3_5">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                            </tr>

                                                                                                            <tr>
                                                                                                                <td style="width: 10px;">29.</td>
                                                                                                                <td>Trasera exterior izquierda ( R4 )</td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-danger d-inline">
                                                                                                                        <input type="radio" id="Trasera_exterior_izquierda_R41" name="Trasera_exterior_izquierda_R4" value="3">
                                                                                                                        <label for="Trasera_exterior_izquierda_R41">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-success d-inline">
                                                                                                                        <input type="radio" id="Trasera_exterior_izquierda_R44" name="Trasera_exterior_izquierda_R4" value="1">
                                                                                                                        <label for="Trasera_exterior_izquierda_R44">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-danger d-inline">
                                                                                                                        <input type="radio" id="Trasera_exterior_izquierda_R4_5" name="Trasera_exterior_izquierda_R4" value="0">
                                                                                                                        <label for="Trasera_exterior_izquierda_R4_5">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                            </tr>

                                                                                                            <tr>
                                                                                                                <td style="width: 10px;">30.</td>
                                                                                                                <td>Trasera interior derecha ( R5 )</td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-danger d-inline">
                                                                                                                        <input type="radio" id="Trasera_interior_derecha_R51" name="Trasera_interior_derecha_R5" value="3">
                                                                                                                        <label for="Trasera_interior_derecha_R51">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-success d-inline">
                                                                                                                        <input type="radio" id="Trasera_interior_derecha_R54" name="Trasera_interior_derecha_R5" value="1">
                                                                                                                        <label for="Trasera_interior_derecha_R54">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-danger d-inline">
                                                                                                                        <input type="radio" id="Trasera_interior_derecha_R55" name="Trasera_interior_derecha_R5" value="0">
                                                                                                                        <label for="Trasera_interior_derecha_R55">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                            </tr>

                                                                                                            <tr>
                                                                                                                <td style="width: 10px;">31.</td>
                                                                                                                <td>Trasera exterior derecha ( R6 )</td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-danger d-inline">
                                                                                                                        <input type="radio" id="Trasera_exterior_derecha_R61" name="Trasera_exterior_derecha_R6" value="3">
                                                                                                                        <label for="Trasera_exterior_derecha_R61">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-success d-inline">
                                                                                                                        <input type="radio" id="Trasera_exterior_derecha_R64" name="Trasera_exterior_derecha_R6" value="1">
                                                                                                                        <label for="Trasera_exterior_derecha_R64">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-danger d-inline">
                                                                                                                        <input type="radio" id="Trasera_exterior_derecha_R65" name="Trasera_exterior_derecha_R6" value="0">
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
                                                                                </div>

                                                                                <!-- /.TAB DE PREVENCION Y SEGURIDAD -->
                                                                                <div class="tab-pane fade" id="custom-tabs-one-preveseguridad" role="tabpanel" aria-labelledby="custom-tabs-one-preveseguridad-tab">
                                                                                    <div class="table table-responsive">
                                                                                        <div class="row">
                                                                                            <div class="col">
                                                                                                <div class="position-relative p-3 bg-transparent" style="height: 620px">
                                                                                                    <table class="table table-bordered text-center text-nowrap">
                                                                                                        <tbody>
                                                                                                            <tr>
                                                                                                                <td colspan="2"><b>EQUIPO DE PREVENCION Y SEGURIDAD (Art. 30 Ley 799102)</b></td>
                                                                                                                <td style="width: 15px;">Si</td>
                                                                                                                <td style="width: 15px;">No</td>
                                                                                                            </tr>

                                                                                                            <tr>
                                                                                                                <td style="width: 10px;">32.</td>
                                                                                                                <td>Gato</td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-success d-inline">
                                                                                                                        <input type="radio" id="Gato1" name="Gato" value="1">
                                                                                                                        <label for="Gato1">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-danger d-inline">
                                                                                                                        <input type="radio" id="Gato2" name="Gato" value="0">
                                                                                                                        <label for="Gato2">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                            </tr>

                                                                                                            <tr>
                                                                                                                <td style="width: 10px;">33.</td>
                                                                                                                <td>Cruceta o Copa</td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-success d-inline">
                                                                                                                        <input type="radio" id="Cruceta__Copa1" name="Cruceta__Copa" value="1">
                                                                                                                        <label for="Cruceta__Copa1">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-danger d-inline">
                                                                                                                        <input type="radio" id="Cruceta__Copa2" name="Cruceta__Copa" value="0">
                                                                                                                        <label for="Cruceta__Copa2">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                            </tr>

                                                                                                            <tr>
                                                                                                                <td style="width: 10px;">34.</td>
                                                                                                                <td>2 Conos o Triangulos</td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-success d-inline">
                                                                                                                        <input type="radio" id="2Conos__Triangulos1" name="2Conos__Triangulos" value="1">
                                                                                                                        <label for="2Conos__Triangulos1">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-danger d-inline">
                                                                                                                        <input type="radio" id="2Conos__Triangulos2" name="2Conos__Triangulos" value="0">
                                                                                                                        <label for="2Conos__Triangulos2">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                            </tr>

                                                                                                            <tr>
                                                                                                                <td style="width: 10px;">35.</td>
                                                                                                                <td>Botiquin</td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-success d-inline">
                                                                                                                        <input type="radio" id="Botiquin1" name="Botiquin" value="1">
                                                                                                                        <label for="Botiquin1">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-danger d-inline">
                                                                                                                        <input type="radio" id="Botiquin2" name="Botiquin" value="0">
                                                                                                                        <label for="Botiquin2">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                            </tr>

                                                                                                            <tr>
                                                                                                                <td style="width: 10px;">36.</td>
                                                                                                                <td>Extintor</td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-success d-inline">
                                                                                                                        <input type="radio" id="Extintor1" name="Extintor" value="1">
                                                                                                                        <label for="Extintor1">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-danger d-inline">
                                                                                                                        <input type="radio" id="Extintor2" name="Extintor" value="0">
                                                                                                                        <label for="Extintor2">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                            </tr>

                                                                                                            <tr>
                                                                                                                <td style="width: 10px;">37.</td>
                                                                                                                <td>2 Tacos o Bloques</td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-success d-inline">
                                                                                                                        <input type="radio" id="2Tacos_Bloques1" name="2Tacos_Bloques" value="1">
                                                                                                                        <label for="2Tacos_Bloques1">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-danger d-inline">
                                                                                                                        <input type="radio" id="2Tacos_Bloques2" name="2Tacos_Bloques" value="0">
                                                                                                                        <label for="2Tacos_Bloques2">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                            </tr>

                                                                                                            <tr>
                                                                                                                <td style="width: 10px;">38.1</td>
                                                                                                                <td>Alicate, destornillaodor</td>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-success d-inline">
                                                                                                                        <input type="radio" id="1Alicate_destornillaodor1" name="1Alicate_destornillaodor" value="1">
                                                                                                                        <label for="1Alicate_destornillaodor1">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-danger d-inline">
                                                                                                                        <input type="radio" id="1Alicate_destornillaodor2" name="1Alicate_destornillaodor" value="0">
                                                                                                                        <label for="1Alicate_destornillaodor2">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                            </tr>

                                                                                                            <tr>
                                                                                                                <td style="width: 10px;">38.2</td>
                                                                                                                <td>PLlave de expancion, LLaves fijas</td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-success d-inline">
                                                                                                                        <input type="radio" id="2PLlave_expancion_LLaves_fijas1" name="2PLlave_expancion_LLaves_fijas" value="1">
                                                                                                                        <label for="2PLlave_expancion_LLaves_fijas1">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-danger d-inline">
                                                                                                                        <input type="radio" id="2PLlave_expancion_LLaves_fijas2" name="2PLlave_expancion_LLaves_fijas" value="0">
                                                                                                                        <label for="2PLlave_expancion_LLaves_fijas2">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                            </tr>

                                                                                                            <tr>
                                                                                                                <td style="width: 10px;">39.</td>
                                                                                                                <td>LLanta de repuesto</td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-success d-inline">
                                                                                                                        <input type="radio" id="LLanta_repuesto1" name="LLanta_repuesto" value="1">
                                                                                                                        <label for="LLanta_repuesto1">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-danger d-inline">
                                                                                                                        <input type="radio" id="LLanta_repuesto2" name="LLanta_repuesto" value="0">
                                                                                                                        <label for="LLanta_repuesto2">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                            </tr>

                                                                                                            <tr>
                                                                                                                <td style="width: 10px;">40.</td>
                                                                                                                <td>Linterna con pila</td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-success d-inline">
                                                                                                                        <input type="radio" id="Linterna_pila1" name="Linterna_pila" value="1">
                                                                                                                        <label for="Linterna_pila1">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-danger d-inline">
                                                                                                                        <input type="radio" id="Linterna_pila2" name="Linterna_pila" value="0">
                                                                                                                        <label for="Linterna_pila2">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                            </tr>

                                                                                                            <tr>
                                                                                                                <td style="width: 10px;">41.</td>
                                                                                                                <td>Cinturon del conductor</td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-success d-inline">
                                                                                                                        <input type="radio" id="Cinturon_conductor1" name="Cinturon_conductor" value="1">
                                                                                                                        <label for="Cinturon_conductor1">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-danger d-inline">
                                                                                                                        <input type="radio" id="Cinturon_conductor2" name="Cinturon_conductor" value="0">
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
                                                                                </div>

                                                                                <!-- /.TAB DE DOCUMENTOS VEHICULO -->
                                                                                <div class="tab-pane fade" id="custom-tabs-one-documentosveh" role="tabpanel" aria-labelledby="custom-tabs-one-documentosveh-tab">
                                                                                    <div class="table table-responsive">
                                                                                        <div class="row">
                                                                                            <div class="col">
                                                                                                <div class="position-relative p-3 bg-transparent" style="height: 500px">
                                                                                                    <table class="table table-bordered text-center">
                                                                                                        <tbody>
                                                                                                            <tr>
                                                                                                                <td colspan="2"><b>DOCUMENTOS VEHÍCULOS</b></td>
                                                                                                                <h5 class="text-right">Vencimiento</h5>
                                                                                                                <td style="width: 95px;">Dia</td>
                                                                                                                <td style="width: 95px;">Mes</td>
                                                                                                                <td style="width: 95px;">Año</td>
                                                                                                            </tr>

                                                                                                            <tr>
                                                                                                                <td style="width: 10px;">42.</td>
                                                                                                                <td>Tarjeta de propiedad (Fecha de matricula)</td>
                                                                                                                <td>
                                                                                                                    <input type="text" class="form-control" id="tarjepropie1" name="tarjepropie1">
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <input type="text" class="form-control" id="tarjepropie2" name="tarjepropie2">
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <input type="text" class="form-control" id="tarjepropie3" name="tarjepropie3">
                                                                                                                </td>
                                                                                                            </tr>

                                                                                                            <tr>
                                                                                                                <td style="width: 10px;">43.</td>
                                                                                                                <td>Tarjeta de operacion</td>
                                                                                                                <td>
                                                                                                                    <input type="text" class="form-control" id="tarjeopera1" name="tarjeopera1">
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <input type="text" class="form-control" id="tarjeopera2" name="tarjeopera2">
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <input type="text" class="form-control" id="tarjeopera3" name="tarjeopera3">
                                                                                                                </td>
                                                                                                            </tr>

                                                                                                            <tr>
                                                                                                                <td style="width: 10px;">44.</td>
                                                                                                                <td>Seguro obligatorio (SOAT)</td>
                                                                                                                <td>
                                                                                                                    <input type="text" class="form-control" id="soat1" name="soat1">
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <input type="text" class="form-control" id="soat2" name="soat2">
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <input type="text" class="form-control" id="soat3" name="soat3">
                                                                                                                </td>
                                                                                                            </tr>

                                                                                                            <tr>
                                                                                                                <td style="width: 10px;">45.</td>
                                                                                                                <td>Revision tecnico mecanica</td>
                                                                                                                <td>
                                                                                                                    <input type="text" class="form-control" id="tecno1" name="tecno1">
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <input type="text" class="form-control" id="tecno2" name="tecno2">
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <input type="text" class="form-control" id="tecno3" name="tecno3">
                                                                                                                </td>
                                                                                                            </tr>

                                                                                                            <tr>
                                                                                                                <td style="width: 10px;">46.</td>
                                                                                                                <td>Poliza contractual</td>
                                                                                                                <td>
                                                                                                                    <input type="text" class="form-control" id="polizacontra1" name="polizacontra1">
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <input type="text" class="form-control" id="polizacontra2" name="polizacontra2">
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <input type="text" class="form-control" id="polizacontra3" name="polizacontra3">
                                                                                                                </td>
                                                                                                            </tr>

                                                                                                            <tr>
                                                                                                                <td style="width: 10px;">47.</td>
                                                                                                                <td>Poliza extracontractual</td>
                                                                                                                <td>
                                                                                                                    <input type="text" class="form-control" id="polizaextra1" name="polizaextra1">
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <input type="text" class="form-control" id="polizaextra2" name="polizaextra2">
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <input type="text" class="form-control" id="polizaextra3" name="polizaextra3">
                                                                                                                </td>
                                                                                                            </tr>
                                                                                                        </tbody>
                                                                                                    </table>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                <!-- /.TAB DE EXTINTOR -->
                                                                                <div class="tab-pane fade" id="custom-tabs-one-extintor" role="tabpanel" aria-labelledby="custom-tabs-one-extintor-tab">
                                                                                    <div class="table table-responsive">
                                                                                        <div class="row">
                                                                                            <div class="col">
                                                                                                <div class="position-relative p-3 bg-transparent" style="height: 150px">
                                                                                                    <table class="table table-bordered text-center text-nowrap">
                                                                                                        <tbody>
                                                                                                            <tr>
                                                                                                                <td colspan="2"><b>EXTINTOR</b></td>
                                                                                                                <td style="width: 95px;">Mes</td>
                                                                                                                <td style="width: 95px;">Año</td>
                                                                                                            </tr>

                                                                                                            <tr>
                                                                                                                <td style="width: 10px;">48.</td>
                                                                                                                <td>Extintor tipo: ABC</td>
                                                                                                                <td>
                                                                                                                    <input type="text" class="form-control" id="extintor1" name="extintor1">
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <input type="text" class="form-control" id="extintor2" name="extintor2">
                                                                                                                </td>
                                                                                                            </tr>
                                                                                                        </tbody>
                                                                                                    </table>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                <!-- /.TAB DE ACCESORIOS -->
                                                                                <div class="tab-pane fade" id="custom-tabs-one-accesorios" role="tabpanel" aria-labelledby="custom-tabs-one-accesorios-tab">
                                                                                    <div class="table table-responsive">
                                                                                        <div class="row">
                                                                                            <div class="col">
                                                                                                <div class="position-relative p-3 bg-transparent" style="height: 710px">
                                                                                                    <table class="table table-bordered text-center text-nowrap">
                                                                                                        <tbody>
                                                                                                            <tr>
                                                                                                                <td colspan="2"><b>ACCESORIOS</b></td>
                                                                                                                <td style="width: 15px;">Bueno</td>
                                                                                                                <td style="width: 15px;">Malo</td>
                                                                                                                <td style="width: 15px;">N/A</td>
                                                                                                            </tr>

                                                                                                            <tr>
                                                                                                                <td style="width: 10px;">49.</td>
                                                                                                                <td>Radioteléfono</td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-success d-inline">
                                                                                                                        <input type="radio" id="Radioteléfono1" name="Radioteléfono" value="1">
                                                                                                                        <label for="Radioteléfono1">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-danger d-inline">
                                                                                                                        <input type="radio" id="Radioteléfono2" name="Radioteléfono" value="0">
                                                                                                                        <label for="Radioteléfono2">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-danger d-inline">
                                                                                                                        <input type="radio" id="Radioteléfono5" name="Radioteléfono" value="2">
                                                                                                                        <label for="Radioteléfono5">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                            </tr>

                                                                                                            <tr>
                                                                                                                <td style="width: 10px;">50.</td>
                                                                                                                <td>Antena</td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-success d-inline">
                                                                                                                        <input type="radio" id="Antena1" name="Antena" value="1">
                                                                                                                        <label for="Antena1">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-danger d-inline">
                                                                                                                        <input type="radio" id="Antena2" name="Antena" value="0">
                                                                                                                        <label for="Antena2">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-danger d-inline">
                                                                                                                        <input type="radio" id="Antena5" name="Antena" value="2">
                                                                                                                        <label for="Antena5">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                            </tr>

                                                                                                            <tr>
                                                                                                                <td style="width: 10px;">51.</td>
                                                                                                                <td>Equipo de Sonido</td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-success d-inline">
                                                                                                                        <input type="radio" id="Equipo_Sonido1" name="Equipo_Sonido" value="1">
                                                                                                                        <label for="Equipo_Sonido1">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-danger d-inline">
                                                                                                                        <input type="radio" id="Equipo_Sonido2" name="Equipo_Sonido" value="0">
                                                                                                                        <label for="Equipo_Sonido2">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-danger d-inline">
                                                                                                                        <input type="radio" id="Equipo_Sonido5" name="Equipo_Sonido" value="2">
                                                                                                                        <label for="Equipo_Sonido5">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td style="width: 150px;">
                                                                                                                    <div class="row">
                                                                                                                        <div class="col-sm-6">
                                                                                                                            <div class="custom-control custom-checkbox">
                                                                                                                                <input class="custom-control-input" type="checkbox" id="usb" name="USB" value="option1">
                                                                                                                                <label for="usb" class="custom-control-label">USB</label>
                                                                                                                            </div>
                                                                                                                        </div>

                                                                                                                        <div class="col-sm-6">
                                                                                                                            <div class="custom-control custom-checkbox">
                                                                                                                                <input class="custom-control-input" type="checkbox" id="cd" name="CD" value="option1">
                                                                                                                                <label for="cd" class="custom-control-label">CD</label>
                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                            </tr>

                                                                                                            <tr>
                                                                                                                <td style="width: 10px;">52.</td>
                                                                                                                <td>
                                                                                                                    Parlantes
                                                                                                                    <div class="input-group sm-3">
                                                                                                                        <div class="input-group-prepend">
                                                                                                                            <button type="button" class="btn btn-default"># Parlantes</button>
                                                                                                                        </div>
                                                                                                                        <!-- /btn-group -->
                                                                                                                        <input type="text" class="form-control" placeholder="Digite el numero de parlantes" id="numeroparlantes" name="numeroparlantes">
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-success d-inline">
                                                                                                                        <input type="radio" id="Parlantes1" name="Parlantes" value="1">
                                                                                                                        <label for="Parlantes1">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-danger d-inline">
                                                                                                                        <input type="radio" id="Parlantes2" name="Parlantes" value="0">
                                                                                                                        <label for="Parlantes2">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-danger d-inline">
                                                                                                                        <input type="radio" id="Parlantes5" name="Parlantes" value="2">
                                                                                                                        <label for="Parlantes5">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                            </tr>

                                                                                                            <tr>
                                                                                                                <td style="width: 10px;">53.</td>
                                                                                                                <td>Manguera de agua</td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-success d-inline">
                                                                                                                        <input type="radio" id="Manguera_agua1" name="Manguera_agua" value="1">
                                                                                                                        <label for="Manguera_agua1">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-danger d-inline">
                                                                                                                        <input type="radio" id="Manguera_agua2" name="Manguera_agua" value="0">
                                                                                                                        <label for="Manguera_agua2">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-danger d-inline">
                                                                                                                        <input type="radio" id="Manguera_agua5" name="Manguera_agua" value="2">
                                                                                                                        <label for="Manguera_agua5">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                            </tr>

                                                                                                            <tr>
                                                                                                                <td style="width: 10px;">54.</td>
                                                                                                                <td>Manguera de aire</td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-success d-inline">
                                                                                                                        <input type="radio" id="Manguera_aire1" name="Manguera_aire" value="1">
                                                                                                                        <label for="Manguera_aire1">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-danger d-inline">
                                                                                                                        <input type="radio" id="Manguera_aire2" name="Manguera_aire" value="0">
                                                                                                                        <label for="Manguera_aire2">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-danger d-inline">
                                                                                                                        <input type="radio" id="Manguera_aire5" name="Manguera_aire" value="2">
                                                                                                                        <label for="Manguera_aire5">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                            </tr>

                                                                                                            <tr>
                                                                                                                <td style="width: 10px;">55.</td>
                                                                                                                <td>Pantalla / Televisor</td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-success d-inline">
                                                                                                                        <input type="radio" id="Pantalla_Televisor1" name="Pantalla_Televisor" value="1">
                                                                                                                        <label for="Pantalla_Televisor1">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-danger d-inline">
                                                                                                                        <input type="radio" id="Pantalla_Televisor2" name="Pantalla_Televisor" value="0">
                                                                                                                        <label for="Pantalla_Televisor2">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-danger d-inline">
                                                                                                                        <input type="radio" id="Pantalla_Televisor5" name="Pantalla_Televisor" value="2">
                                                                                                                        <label for="Pantalla_Televisor5">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                            </tr>

                                                                                                            <tr>
                                                                                                                <td style="width: 10px;">56.</td>
                                                                                                                <td>Reloj</td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-success d-inline">
                                                                                                                        <input type="radio" id="Reloj1" name="Reloj" value="1">
                                                                                                                        <label for="Reloj1">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-danger d-inline">
                                                                                                                        <input type="radio" id="Reloj2" name="Reloj" value="0">
                                                                                                                        <label for="Reloj2">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-danger d-inline">
                                                                                                                        <input type="radio" id="Reloj5" name="Reloj" value="2">
                                                                                                                        <label for="Reloj5">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td rowspan="5">
                                                                                                                    <br>
                                                                                                                    <br>
                                                                                                                    <br>
                                                                                                                    <br>
                                                                                                                    <h4>SISTEMA VIGIA</h4>
                                                                                                                </td>
                                                                                                            </tr>

                                                                                                            <tr>
                                                                                                                <td style="width: 10px;">57.</td>
                                                                                                                <td>Brazo 1 Izquierdo R1</td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-success d-inline">
                                                                                                                        <input type="radio" id="Brazo_1_Izquierdo_R11" name="Brazo_1_Izquierdo_R1" value="1">
                                                                                                                        <label for="Brazo_1_Izquierdo_R11">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-danger d-inline">
                                                                                                                        <input type="radio" id="Brazo_1_Izquierdo_R12" name="Brazo_1_Izquierdo_R1" value="0">
                                                                                                                        <label for="Brazo_1_Izquierdo_R12">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-danger d-inline">
                                                                                                                        <input type="radio" id="Brazo_1_Izquierdo_R15" name="Brazo_1_Izquierdo_R1" value="2">
                                                                                                                        <label for="Brazo_1_Izquierdo_R15">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                            </tr>

                                                                                                            <tr>
                                                                                                                <td style="width: 10px;">58.</td>
                                                                                                                <td>Brazo 2 Derecho R2</td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-success d-inline">
                                                                                                                        <input type="radio" id="Brazo_2_Derecho_R21" name="Brazo_2_Derecho_R2" value="1">
                                                                                                                        <label for="Brazo_2_Derecho_R21">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-danger d-inline">
                                                                                                                        <input type="radio" id="Brazo_2_Derecho_R22" name="Brazo_2_Derecho_R2" value="0">
                                                                                                                        <label for="Brazo_2_Derecho_R22">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-danger d-inline">
                                                                                                                        <input type="radio" id="Brazo_2_Derecho_R25" name="Brazo_2_Derecho_R2" value="2">
                                                                                                                        <label for="Brazo_2_Derecho_R25">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                            </tr>

                                                                                                            <tr>
                                                                                                                <td style="width: 10px;">59.</td>
                                                                                                                <td>Brazo 3 Izquierdo R3</td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-success d-inline">
                                                                                                                        <input type="radio" id="Brazo_3_Izquierdo_R31" name="Brazo_3_Izquierdo_R3" value="1">
                                                                                                                        <label for="Brazo_3_Izquierdo_R31">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-danger d-inline">
                                                                                                                        <input type="radio" id="Brazo_3_Izquierdo_R32" name="Brazo_3_Izquierdo_R3" value="0">
                                                                                                                        <label for="Brazo_3_Izquierdo_R32">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-danger d-inline">
                                                                                                                        <input type="radio" id="Brazo_3_Izquierdo_R35" name="Brazo_3_Izquierdo_R3" value="2">
                                                                                                                        <label for="Brazo_3_Izquierdo_R35">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                            </tr>

                                                                                                            <tr>
                                                                                                                <td style="width: 10px;">60.</td>
                                                                                                                <td>Brazo 4 Derecho R6</td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-success d-inline">
                                                                                                                        <input type="radio" id="Brazo_4_Derecho_R61" name="Brazo_4_Derecho_R6" value="1">
                                                                                                                        <label for="Brazo_4_Derecho_R61">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-danger d-inline">
                                                                                                                        <input type="radio" id="Brazo_4_Derecho_R62" name="Brazo_4_Derecho_R6" value="0">
                                                                                                                        <label for="Brazo_4_Derecho_R62">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-danger d-inline">
                                                                                                                        <input type="radio" id="Brazo_4_Derecho_R65" name="Brazo_4_Derecho_R6" value="2">
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
                                                                                </div>

                                                                                <!-- /.TAB DE EMBLEMAS -->
                                                                                <div class="tab-pane fade" id="custom-tabs-one-emblemas" role="tabpanel" aria-labelledby="custom-tabs-one-emblemas-tab">
                                                                                    <div class="table table-responsive">
                                                                                        <div class="row">
                                                                                            <div class="col">
                                                                                                <div class="position-relative p-3 bg-transparent" style="height: 750px">
                                                                                                    <table class="table table-bordered text-center text-nowrap">
                                                                                                        <tbody>
                                                                                                            <tr>
                                                                                                                <td colspan="2"><b>EMBLEMAS</b></td>
                                                                                                                <td style="width: 15px;">Bueno</td>
                                                                                                                <td style="width: 15px;">Malo</td>
                                                                                                                <td style="width: 15px;">N/A</td>
                                                                                                            </tr>

                                                                                                            <tr>
                                                                                                                <td style="width: 10px;">61.</td>
                                                                                                                <td>Emblema izquierdo de la empresa</td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-success d-inline">
                                                                                                                        <input type="radio" id="Emblema_izquierdo_empresa1" name="Emblema_izquierdo_empresa" value="1">
                                                                                                                        <label for="Emblema_izquierdo_empresa1">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-danger d-inline">
                                                                                                                        <input type="radio" id="Emblema_izquierdo_empresa2" name="Emblema_izquierdo_empresa" value="0">
                                                                                                                        <label for="Emblema_izquierdo_empresa2">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-danger d-inline">
                                                                                                                        <input type="radio" id="Emblema_izquierdo_empresa5" name="Emblema_izquierdo_empresa" value="2">
                                                                                                                        <label for="Emblema_izquierdo_empresa5">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                            </tr>

                                                                                                            <tr>
                                                                                                                <td style="width: 10px;">62.</td>
                                                                                                                <td>Emblema derecho de la empresa</td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-success d-inline">
                                                                                                                        <input type="radio" id="Emblema_derecho_empresa1" name="Emblema_derecho_empresa" value="1">
                                                                                                                        <label for="Emblema_derecho_empresa1">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-danger d-inline">
                                                                                                                        <input type="radio" id="Emblema_izquierdo_empresa2" name="Emblema_derecho_empresa" value="0">
                                                                                                                        <label for="Emblema_derecho_empresa2">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-danger d-inline">
                                                                                                                        <input type="radio" id="Emblema_derecho_empresa5" name="Emblema_derecho_empresa" value="2">
                                                                                                                        <label for="Emblema_derecho_empresa5">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                            </tr>

                                                                                                            <tr>
                                                                                                                <td style="width: 10px;">63.</td>
                                                                                                                <td>Escolar delantero</td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-success d-inline">
                                                                                                                        <input type="radio" id="Escolar_delantero1" name="Escolar_delantero" value="1">
                                                                                                                        <label for="Escolar_delantero1">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-danger d-inline">
                                                                                                                        <input type="radio" id="Escolar_delantero2" name="Escolar_delantero" value="0">
                                                                                                                        <label for="Escolar_delantero2">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-danger d-inline">
                                                                                                                        <input type="radio" id="Escolar_delantero5" name="Escolar_delantero" value="2">
                                                                                                                        <label for="Escolar_delantero5">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="escolardelantero4" name="E_delantero" value="option1">
                                                                                                                        <label for="escolardelantero4" class="custom-control-label">Delantero</label>
                                                                                                                    </div>

                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="escolardelantero5" name="E_trasero" value="option1">
                                                                                                                        <label for="escolardelantero5" class="custom-control-label">Trasero</label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                            </tr>

                                                                                                            <tr>
                                                                                                                <td style="width: 10px;">64.</td>
                                                                                                                <td>Logo izquierdo</td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-success d-inline">
                                                                                                                        <input type="radio" id="Logo_izquierdo1" name="Logo_izquierdo" value="1">
                                                                                                                        <label for="Logo_izquierdo1">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-danger d-inline">
                                                                                                                        <input type="radio" id="Logo_izquierdo2" name="Logo_izquierdo" value="0">
                                                                                                                        <label for="Logo_izquierdo2">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-danger d-inline">
                                                                                                                        <input type="radio" id="Logo_izquierdo5" name="Logo_izquierdo" value="2">
                                                                                                                        <label for="Logo_izquierdo5">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                            </tr>

                                                                                                            <tr>
                                                                                                                <td style="width: 10px;">65.</td>
                                                                                                                <td>Logo derecho</td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-success d-inline">
                                                                                                                        <input type="radio" id="Logo_derecho1" name="Logo_derecho" value="1">
                                                                                                                        <label for="Logo_derecho1">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-danger d-inline">
                                                                                                                        <input type="radio" id="Logo_derecho2" name="Logo_derecho" value="0">
                                                                                                                        <label for="Logo_derecho2">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-danger d-inline">
                                                                                                                        <input type="radio" id="Logo_derecho5" name="Logo_derecho" value="2">
                                                                                                                        <label for="Logo_derecho5">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                            </tr>

                                                                                                            <tr>
                                                                                                                <td style="width: 10px;">66.</td>
                                                                                                                <td>N° Interno delantero</td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-success d-inline">
                                                                                                                        <input type="radio" id="N_Interno_delantero1" name="N_Interno_delantero" value="1">
                                                                                                                        <label for="N_Interno_delantero1">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-danger d-inline">
                                                                                                                        <input type="radio" id="N_Interno_delantero2" name="N_Interno_delantero" value="0">
                                                                                                                        <label for="N_Interno_delantero2">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-danger d-inline">
                                                                                                                        <input type="radio" id="N_Interno_delantero5" name="N_Interno_delantero" value="2">
                                                                                                                        <label for="N_Interno_delantero5">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                            </tr>

                                                                                                            <tr>
                                                                                                                <td style="width: 10px;">67.</td>
                                                                                                                <td>N° Interno trasero</td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-success d-inline">
                                                                                                                        <input type="radio" id="N_Interno_trasero1" name="N_Interno_trasero" value="1">
                                                                                                                        <label for="N_Interno_trasero1">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-danger d-inline">
                                                                                                                        <input type="radio" id="N_Interno_trasero2" name="N_Interno_trasero" value="0">
                                                                                                                        <label for="N_Interno_trasero2">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-danger d-inline">
                                                                                                                        <input type="radio" id="N_Interno_trasero5" name="N_Interno_trasero" value="2">
                                                                                                                        <label for="N_Interno_trasero5">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                            </tr>

                                                                                                            <tr>
                                                                                                                <td style="width: 10px;">68.</td>
                                                                                                                <td>N° Interno izquierdo</td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-success d-inline">
                                                                                                                        <input type="radio" id="N_Interno_izquierdo1" name="N_Interno_izquierdo" value="1">
                                                                                                                        <label for="N_Interno_izquierdo1">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-danger d-inline">
                                                                                                                        <input type="radio" id="N_Interno_izquierdo2" name="N_Interno_izquierdo" value="0">
                                                                                                                        <label for="N_Interno_izquierdo2">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-danger d-inline">
                                                                                                                        <input type="radio" id="N_Interno_izquierdo5" name="N_Interno_izquierdo" value="2">
                                                                                                                        <label for="N_Interno_izquierdo5">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                            </tr>

                                                                                                            <tr>
                                                                                                                <td style="width: 10px;">69.</td>
                                                                                                                <td>N° Interno derecho</td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-success d-inline">
                                                                                                                        <input type="radio" id="N_Interno_derecho1" name="N_Interno_derecho" value="1">
                                                                                                                        <label for="N_Interno_derecho1">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-danger d-inline">
                                                                                                                        <input type="radio" id="N_Interno_derecho2" name="N_Interno_derecho" value="0">
                                                                                                                        <label for="N_Interno_derecho2">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-danger d-inline">
                                                                                                                        <input type="radio" id="N_Interno_derecho5" name="N_Interno_derecho" value="2">
                                                                                                                        <label for="N_Interno_derecho5">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                            </tr>

                                                                                                            <tr>
                                                                                                                <td style="width: 10px;">70.</td>
                                                                                                                <td>
                                                                                                                    Salidas de emergencia y martillos
                                                                                                                    <div class="input-group sm-3">
                                                                                                                        <div class="input-group-prepend">
                                                                                                                            <button type="button" class="btn btn-danger">Numero de salidas y martillos</button>
                                                                                                                        </div>
                                                                                                                        <!-- /btn-group -->
                                                                                                                        <input type="text" class="form-control" placeholder="# ..." id="numsalimarti" name="Nsaliadas_martillos">
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-success d-inline">
                                                                                                                        <input type="radio" id="Salidas_emergencia_martillos1" name="Salidas_emergencia_martillos" value="1">
                                                                                                                        <label for="Salidas_emergencia_martillos1">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-danger d-inline">
                                                                                                                        <input type="radio" id="Salidas_emergencia_martillos2" name="Salidas_emergencia_martillos" value="0">
                                                                                                                        <label for="Salidas_emergencia_martillos2">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-danger d-inline">
                                                                                                                        <input type="radio" id="Salidas_emergencia_martillos5" name="Salidas_emergencia_martillos" value="2">
                                                                                                                        <label for="Salidas_emergencia_martillos5">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                            </tr>

                                                                                                            <tr>
                                                                                                                <td style="width: 10px;">71.</td>
                                                                                                                <td>Dispositivo de velocidad</td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-success d-inline">
                                                                                                                        <input type="radio" id="Dispositivo_velocidad1" name="Dispositivo_velocidad" value="1">
                                                                                                                        <label for="Dispositivo_velocidad1">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-danger d-inline">
                                                                                                                        <input type="radio" id="Dispositivo_velocidad2" name="Dispositivo_velocidad" value="0">
                                                                                                                        <label for="Dispositivo_velocidad2">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-danger d-inline">
                                                                                                                        <input type="radio" id="Dispositivo_velocidad5" name="Dispositivo_velocidad" value="2">
                                                                                                                        <label for="Dispositivo_velocidad5">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                            </tr>

                                                                                                            <tr>
                                                                                                                <td style="width: 10px;">72.</td>
                                                                                                                <td>Aviso: Como conduzco </td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-success d-inline">
                                                                                                                        <input type="radio" id="Av_Como_conduzco1" name="Av_Como_conduzco" value="1">
                                                                                                                        <label for="Av_Como_conduzco1">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-danger d-inline">
                                                                                                                        <input type="radio" id="Av_Como_conduzco2" name="Av_Como_conduzco" value="0">
                                                                                                                        <label for="Av_Como_conduzco2">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-danger d-inline">
                                                                                                                        <input type="radio" id="Av_Como_conduzco5" name="Av_Como_conduzco" value="2">
                                                                                                                        <label for="Av_Como_conduzco5">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="comoconduinter" name="Av_int_conduzco" value="option1">
                                                                                                                        <label for="comoconduinter" class="custom-control-label">Interno</label>
                                                                                                                    </div>

                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="comoconduexter" name="Av_ext_conduzco" value="option1">
                                                                                                                        <label for="comoconduexter" class="custom-control-label">Externo</label>
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

                                                                                <!-- /.TAB DE OTROS -->
                                                                                <div class="tab-pane fade" id="custom-tabs-one-otros" role="tabpanel" aria-labelledby="custom-tabs-one-otros-tab">
                                                                                    <div class="table table-responsive">
                                                                                        <div class="row">
                                                                                            <div class="col">
                                                                                                <div class="position-relative p-3 bg-transparent" style="height: 720px">
                                                                                                    <table class="table table-bordered text-center text-nowrap">
                                                                                                        <tbody>
                                                                                                            <tr>
                                                                                                                <td colspan="2"><b>OTROS ELEMENTOS</b></td>
                                                                                                                <td style="width: 15px;">Bueno</td>
                                                                                                                <td style="width: 15px;">Malo</td>
                                                                                                                <td style="width: 15px;">N/A</td>
                                                                                                            </tr>

                                                                                                            <tr>
                                                                                                                <td style="width: 10px;">73.</td>
                                                                                                                <td>Brazo limpiaparabrisas izquierdo</td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-success d-inline">
                                                                                                                        <input type="radio" id="Brazo_limpiaparabrisas_izquierdo1" name="Brazo_limpiaparabrisas_izquierdo" value="1">
                                                                                                                        <label for="Brazo_limpiaparabrisas_izquierdo1">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-danger d-inline">
                                                                                                                        <input type="radio" id="Brazo_limpiaparabrisas_izquierdo2" name="Brazo_limpiaparabrisas_izquierdo" value="0">
                                                                                                                        <label for="Brazo_limpiaparabrisas_izquierdo2">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-danger d-inline">
                                                                                                                        <input type="radio" id="Brazo_limpiaparabrisas_izquierdo5" name="Brazo_limpiaparabrisas_izquierdo" value="2">
                                                                                                                        <label for="Brazo_limpiaparabrisas_izquierdo5">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                            </tr>

                                                                                                            <tr>
                                                                                                                <td style="width: 10px;">74.</td>
                                                                                                                <td>Plumilla limpiaparabrisas izquierdo</td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-success d-inline">
                                                                                                                        <input type="radio" id="Plumilla_limpiaparabrisas_izquierdo1" name="Plumilla_limpiaparabrisas_izquierdo" value="1">
                                                                                                                        <label for="Plumilla_limpiaparabrisas_izquierdo1">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-danger d-inline">
                                                                                                                        <input type="radio" id="Plumilla_limpiaparabrisas_izquierdo2" name="Plumilla_limpiaparabrisas_izquierdo" value="0">
                                                                                                                        <label for="Plumilla_limpiaparabrisas_izquierdo2">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-danger d-inline">
                                                                                                                        <input type="radio" id="Plumilla_limpiaparabrisas_izquierdo5" name="Plumilla_limpiaparabrisas_izquierdo" value="2">
                                                                                                                        <label for="Plumilla_limpiaparabrisas_izquierdo5">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                            </tr>

                                                                                                            <tr>
                                                                                                                <td style="width: 10px;">75.</td>
                                                                                                                <td>Brazo limpiaparabrisas derecho</td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-success d-inline">
                                                                                                                        <input type="radio" id="7Brazo_limpiaparabrisas_derecho1" name="7Brazo_limpiaparabrisas_derecho" value="1">
                                                                                                                        <label for="7Brazo_limpiaparabrisas_derecho1">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-danger d-inline">
                                                                                                                        <input type="radio" id="7Brazo_limpiaparabrisas_derecho2" name="7Brazo_limpiaparabrisas_derecho" value="0">
                                                                                                                        <label for="7Brazo_limpiaparabrisas_derecho2">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-danger d-inline">
                                                                                                                        <input type="radio" id="7Brazo_limpiaparabrisas_derecho52" name="7Brazo_limpiaparabrisas_derecho" value="2">
                                                                                                                        <label for="7Brazo_limpiaparabrisas_derecho52">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                            </tr>

                                                                                                            <tr>
                                                                                                                <td style="width: 10px;">76.</td>
                                                                                                                <td>Plumilla limpiaparabrisas derecho</td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-success d-inline">
                                                                                                                        <input type="radio" id="Plumilla_limpiaparabrisas_derecho1" name="Plumilla_limpiaparabrisas_derecho" value="1">
                                                                                                                        <label for="Plumilla_limpiaparabrisas_derecho1">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-danger d-inline">
                                                                                                                        <input type="radio" id="Plumilla_limpiaparabrisas_derecho2" name="Plumilla_limpiaparabrisas_derecho" value="0">
                                                                                                                        <label for="Plumilla_limpiaparabrisas_derecho2">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-danger d-inline">
                                                                                                                        <input type="radio" id="Plumilla_limpiaparabrisas_derecho5" name="Plumilla_limpiaparabrisas_derecho" value="2">
                                                                                                                        <label for="Plumilla_limpiaparabrisas_derecho5">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                            </tr>

                                                                                                            <tr>
                                                                                                                <td style="width: 10px;">77.</td>
                                                                                                                <td>Baterias</td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-success d-inline">
                                                                                                                        <input type="radio" id="Baterias1" name="Baterias" value="1">
                                                                                                                        <label for="Baterias1">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-danger d-inline">
                                                                                                                        <input type="radio" id="Baterias2" name="Baterias" value="0">
                                                                                                                        <label for="Baterias2">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-danger d-inline">
                                                                                                                        <input type="radio" id="Baterias5" name="Baterias" value="2">
                                                                                                                        <label for="Baterias5">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                            </tr>

                                                                                                            <tr>
                                                                                                                <td style="width: 10px;">78.</td>
                                                                                                                <td>Botones de tableron y timon</td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-success d-inline">
                                                                                                                        <input type="radio" id="Botones_tableron_timon1" name="Botones_tableron_timon" value="1">
                                                                                                                        <label for="Botones_tableron_timon1">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-danger d-inline">
                                                                                                                        <input type="radio" id="Botones_tableron_timon2" name="Botones_tableron_timon" value="0">
                                                                                                                        <label for="Botones_tableron_timon2">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-danger d-inline">
                                                                                                                        <input type="radio" id="Botones_tableron_timon5" name="Botones_tableron_timon" value="2">
                                                                                                                        <label for="Botones_tableron_timon5">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                            </tr>

                                                                                                            <tr>
                                                                                                                <td style="width: 10px;">79.</td>
                                                                                                                <td>Tapa radiador</td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-success d-inline">
                                                                                                                        <input type="radio" id="Tapa_radiador1" name="Tapa_radiador" value="1">
                                                                                                                        <label for="Tapa_radiador1">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-danger d-inline">
                                                                                                                        <input type="radio" id="Tapa_radiador2" name="Tapa_radiador" value="0">
                                                                                                                        <label for="Tapa_radiador2">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-danger d-inline">
                                                                                                                        <input type="radio" id="Tapa_radiador5" name="Tapa_radiador" value="2">
                                                                                                                        <label for="Tapa_radiador5">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                            </tr>

                                                                                                            <tr>
                                                                                                                <td style="width: 10px;">80.</td>
                                                                                                                <td>Tapa deposito hidráulico</td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-success d-inline">
                                                                                                                        <input type="radio" id="Tapa_deposito_hidráulico1" name="Tapa_deposito_hidráulico" value="1">
                                                                                                                        <label for="Tapa_deposito_hidráulico1">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-danger d-inline">
                                                                                                                        <input type="radio" id="Tapa_deposito_hidráulico2" name="Tapa_deposito_hidráulico" value="0">
                                                                                                                        <label for="Tapa_deposito_hidráulico2">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-danger d-inline">
                                                                                                                        <input type="radio" id="Tapa_deposito_hidráulico5" name="Tapa_deposito_hidráulico" value="2">
                                                                                                                        <label for="Tapa_deposito_hidráulico5">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                            </tr>

                                                                                                            <tr>
                                                                                                                <td style="width: 10px;">81.</td>
                                                                                                                <td>Cojineria en general</td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-success d-inline">
                                                                                                                        <input type="radio" id="Cojineria_general1" name="Cojineria_general" value="1">
                                                                                                                        <label for="Cojineria_general1">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-danger d-inline">
                                                                                                                        <input type="radio" id="Cojineria_general2" name="Cojineria_general" value="0">
                                                                                                                        <label for="Cojineria_general2">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-danger d-inline">
                                                                                                                        <input type="radio" id="Cojineria_general5" name="Cojineria_general" value="2">
                                                                                                                        <label for="Cojineria_general5">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                            </tr>

                                                                                                            <tr>
                                                                                                                <td style="width: 10px;">82.</td>
                                                                                                                <td>Cinturon sillas calidad</td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-success d-inline">
                                                                                                                        <input type="radio" id="Cinturon_sillas_calidad1" name="Cinturon_sillas_calidad" value="1">
                                                                                                                        <label for="Cinturon_sillas_calidad1">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-danger d-inline">
                                                                                                                        <input type="radio" id="Cinturon_sillas_calidad2" name="Cinturon_sillas_calidad" value="0">
                                                                                                                        <label for="Cinturon_sillas_calidad2">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-danger d-inline">
                                                                                                                        <input type="radio" id="Cinturon_sillas_calidad5" name="Cinturon_sillas_calidad" value="2">
                                                                                                                        <label for="Cinturon_sillas_calidad5">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                            </tr>

                                                                                                            <tr>
                                                                                                                <td style="width: 10px;">83.</td>
                                                                                                                <td>Pasamanos</td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-success d-inline">
                                                                                                                        <input type="radio" id="Pasamanos1" name="Pasamanos" value="1">
                                                                                                                        <label for="Pasamanos1">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-danger d-inline">
                                                                                                                        <input type="radio" id="Pasamanos2" name="Pasamanos" value="0">
                                                                                                                        <label for="Pasamanos2">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-danger d-inline">
                                                                                                                        <input type="radio" id="Pasamanos5" name="Pasamanos" value="2">
                                                                                                                        <label for="Pasamanos5">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                            </tr>

                                                                                                            <tr>
                                                                                                                <td style="width: 10px;">84.</td>
                                                                                                                <td>Claxon</td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-success d-inline">
                                                                                                                        <input type="radio" id="Claxon1" name="Claxon" value="1">
                                                                                                                        <label for="Claxon1">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-danger d-inline">
                                                                                                                        <input type="radio" id="Claxon2" name="Claxon" value="0">
                                                                                                                        <label for="Claxon2">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-danger d-inline">
                                                                                                                        <input type="radio" id="Claxon5" name="Claxon" value="2">
                                                                                                                        <label for="Claxon5">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                            </tr>

                                                                                                            <tr>
                                                                                                                <td style="width: 10px;">85.</td>
                                                                                                                <td>Placas reglamentarias</td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-success d-inline">
                                                                                                                        <input type="radio" id="Placas_reglamentarias1" name="Placas_reglamentarias" value="1">
                                                                                                                        <label for="Placas_reglamentarias1">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-danger d-inline">
                                                                                                                        <input type="radio" id="Placas_reglamentarias2" name="Placas_reglamentarias" value="0">
                                                                                                                        <label for="Placas_reglamentarias2">
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="icheck-danger d-inline">
                                                                                                                        <input type="radio" id="Placas_reglamentarias5" name="Placas_reglamentarias" value="2">
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
                                                                                </div>

                                                                                <!-- /.TAB REGISTRO FOTOGRAFICO Y OBSERVACIONES -->
                                                                                <div class="col-12">
                                                                                    <div class="card card-info card-tabs">
                                                                                        <div class="card-header p-0 pt-1">
                                                                                            <ul class="nav nav-tabs" id="custom-tabs-two-tab" role="tablist">

                                                                                                <li class="pt-2 px-3">
                                                                                                    <h3 class="card-title">Evidencias</h3>
                                                                                                </li>

                                                                                                <li class="nav-item">
                                                                                                    <a class="nav-link active" id="pills-evidencias-tab" data-toggle="pill" href="#pills-evidencias" role="tab" aria-controls="pills-evidencias" aria-selected="true"><u>Registro fotografico y Observaciones</u></a>
                                                                                                </li>
                                                                                            </ul>
                                                                                        </div>

                                                                                        <div class="card-body">
                                                                                            <div class="tab-content" id="custom-tabs-two-tabContent">
                                                                                                <div class="row">
                                                                                                    <div class="col-md-6">
                                                                                                        <div class="form-group">
                                                                                                            <label>Imagen de Evidencia (1 Foto a la vez)</label>
                                                                                                            <div class="input-group">
                                                                                                                <div class="input-group-append">
                                                                                                                    <span class="input-group-text">
                                                                                                                        <i class="fas fa-camera-retro"></i>
                                                                                                                    </span>
                                                                                                                </div>
                                                                                                                <input type="file" class="form-control" name="foto_evidenciabusbuseta" id="foto_evidenciabusbuseta" accept="image/png, image/jpeg">
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>

                                                                                                    <div class="col-md-6">
                                                                                                        <div class="form-group">
                                                                                                            <label>Observaciones</label>
                                                                                                            <textarea class="form-control" rows="2" placeholder="Digite las observaciones vistas en la inspeccion."></textarea>
                                                                                                        </div>
                                                                                                    </div>

                                                                                                    <div class="col-md-4">

                                                                                                    </div>

                                                                                                    <div class="col-md-4 align-center">
                                                                                                        <button type="button" class="btn btn-block bg-gradient-success"><i class="far fa-save"> Cargar informacion</i></button>
                                                                                                    </div>

                                                                                                    <div class="col-md-4">

                                                                                                    </div>
                                                                                                </div>

                                                                                                <br>

                                                                                                <table class="table table-striped text-center">
                                                                                                    <thead>
                                                                                                        <tr>
                                                                                                            <th>Imagenes de Evidencia</th>
                                                                                                            <th>Observaciones</th>
                                                                                                        </tr>
                                                                                                    </thead>

                                                                                                    <tbody>
                                                                                                        <tr>
                                                                                                            <td>
                                                                                                                #
                                                                                                            </td>
                                                                                                            <td>
                                                                                                                #
                                                                                                            </td>
                                                                                                        </tr>
                                                                                                    </tbody>

                                                                                                </table>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                <!-- /.BOTONES DE GUARDAR O CANCELAR DE LOS TABS -->
                                                                                <div class="text-center">
                                                                                    <a class="btn btn-app bg-success">
                                                                                        <i class="far fa-save"></i> Guardar
                                                                                    </a>

                                                                                    <a class="btn btn-app bg-danger">
                                                                                        <i class="fas fa-ban"></i> Cancelar
                                                                                    </a>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <!-- /.card -->
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
                                <!-- /.card-body -->
                            </div>

                            <!-- ===================== 
                            CARD DE TABLA RESUMEN
                            ========================= -->
                            <div class="card card-success collapsed-card">
                                <div class="card-header">
                                    <h3 class="card-title">TABLA RESUMEN</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                </div>

                                <div class="card-body" style="display: none;">
                                    <div class="chart">
                                        <div class="chartjs-size-monitor">
                                            <div class="chartjs-size-monitor-expand">
                                                <div class=""></div>
                                            </div>
                                            <div class="chartjs-size-monitor-shrink">
                                                <div class=""></div>
                                            </div>

                                            <!-- TABLAS RESUMENES -->

                                            <!-- TABLA RESUMEN LAMINAS -->
                                            <h3 class="text-center">Laminas</h3>
                                            <div class="table-responsive">
                                                <table id="tablaresulaminas" class="table table-bordered table-striped text-center nowrap tablas">
                                                    <thead>
                                                        <tr>
                                                            <th>...</th>
                                                            <th>Placa</th>
                                                            <th>Fecha</th>
                                                            <th>Numero interno</th>
                                                            <th>Conductor</th>
                                                            <th>Techo exterior</th>
                                                            <th>Techo interior</th>
                                                            <th>Frente</th>
                                                            <th>Bomper delantero</th>
                                                            <th>Bomper trasero</th>
                                                            <th>Lateral derecho</th>
                                                            <th>Lateral izquierdo</th>
                                                            <th>Puerta derecha</th>
                                                            <th>Puerta izquierda</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-editar"><i class="fas fa-edit"></i></button>
                                                            </td>
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
                                                        </tr>
                                                    </tbody>

                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-editar"><i class="fas fa-edit"></i></button>
                                                            </td>
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
                                                        </tr>
                                                    </tbody>

                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-editar"><i class="fas fa-edit"></i></button>
                                                            </td>
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
                                                        </tr>
                                                    </tbody>

                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-editar"><i class="fas fa-edit"></i></button>
                                                            </td>
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
                                                        </tr>
                                                    </tbody>

                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-editar"><i class="fas fa-edit"></i></button>
                                                            </td>
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
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>

                                            <br>

                                            <!-- TABLA RESUMEN VIDRIOS Y ESPEJOS -->
                                            <h3 class="text-center">Vidrios y Espejos</h3>
                                            <div class="table-responsive">
                                                <table id="tablaresuvidriosespejos" class="table table-bordered table-striped text-center nowrap tablas">
                                                    <thead>
                                                        <tr>
                                                            <th>...</th>
                                                            <th>Placa</th>
                                                            <th>Fecha</th>
                                                            <th>Numero interno</th>
                                                            <th>Conductor</th>
                                                            <th>Parabrisas izquierdo</th>
                                                            <th>Parabrisas derecho</th>
                                                            <th>Espejo retrovisor derecho</th>
                                                            <th>Espejo retrovisor izquierdo</th>
                                                            <th>Vidrios ventanas lateral derecho</th>
                                                            <th>Parabrisas trasero</th>
                                                            <th>Vidrios de puertas</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-editar"><i class="fas fa-edit"></i></button>
                                                            </td>
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
                                                        </tr>
                                                    </tbody>

                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-editar"><i class="fas fa-edit"></i></button>
                                                            </td>
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
                                                        </tr>
                                                    </tbody>

                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-editar"><i class="fas fa-edit"></i></button>
                                                            </td>
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
                                                        </tr>
                                                    </tbody>

                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-editar"><i class="fas fa-edit"></i></button>
                                                            </td>
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
                                                        </tr>
                                                    </tbody>

                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-editar"><i class="fas fa-edit"></i></button>
                                                            </td>
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
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>

                                            <br>

                                            <!-- TABLA RESUMEN LUCES -->
                                            <h3 class="text-center">Luces</h3>
                                            <div class="table-responsive">
                                                <table id="tablaresuluces" class="table table-bordered table-striped text-center nowrap tablas">
                                                    <thead>
                                                        <tr>
                                                            <th>...</th>
                                                            <th>Placa</th>
                                                            <th>Fecha</th>
                                                            <th>Numero interno</th>
                                                            <th>Conductor</th>
                                                            <th>Direccionales delanteras izquierda</th>
                                                            <th>Direccionales delanteras derecha</th>
                                                            <th>Stop trasero derecho</th>
                                                            <th>Stop trasero izquierdo</th>
                                                            <th>Cucuyo lateral derecho</th>
                                                            <th>Cucuyo lateral izquierdo</th>
                                                            <th>Luces internas</th>
                                                            <th>Balizas (Licuadoras)</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-editar"><i class="fas fa-edit"></i></button>
                                                            </td>
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
                                                        </tr>
                                                    </tbody>

                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-editar"><i class="fas fa-edit"></i></button>
                                                            </td>
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
                                                        </tr>
                                                    </tbody>

                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-editar"><i class="fas fa-edit"></i></button>
                                                            </td>
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
                                                        </tr>
                                                    </tbody>

                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-editar"><i class="fas fa-edit"></i></button>
                                                            </td>
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
                                                        </tr>
                                                    </tbody>

                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-editar"><i class="fas fa-edit"></i></button>
                                                            </td>
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
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>

                                            <br>

                                            <!-- TABLA RESUMEN LLANTAS -->
                                            <h3 class="text-center">Llantas</h3>
                                            <div class="table-responsive">
                                                <table id="tablaresullantas" class="table table-bordered table-striped text-center nowrap tablas">
                                                    <thead>
                                                        <tr>
                                                            <th>...</th>
                                                            <th>Placa</th>
                                                            <th>Fecha</th>
                                                            <th>Numero interno</th>
                                                            <th>Conductor</th>
                                                            <th>Delantera izquierda (R1)</th>
                                                            <th>Delantera derecha (R2)</th>
                                                            <th>Trasera interior izquierda (R3)</th>
                                                            <th>Trasera exterior izquierda (R4)</th>
                                                            <th>Trasera interior derecha (R5)</th>
                                                            <th>Trasera exterior derecha (R6)</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-editar"><i class="fas fa-edit"></i></button>
                                                            </td>
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
                                                        </tr>
                                                    </tbody>

                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-editar"><i class="fas fa-edit"></i></button>
                                                            </td>
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
                                                        </tr>
                                                    </tbody>

                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-editar"><i class="fas fa-edit"></i></button>
                                                            </td>
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
                                                        </tr>
                                                    </tbody>

                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-editar"><i class="fas fa-edit"></i></button>
                                                            </td>
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
                                                        </tr>
                                                    </tbody>

                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-editar"><i class="fas fa-edit"></i></button>
                                                            </td>
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
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>

                                            <br>

                                            <!-- TABLA RESUMEN EQUIPO DE PREVENCION Y SEGURIDAD -->
                                            <h3 class="text-center">Equipo de prevecion y seguridad</h3>
                                            <div class="table-responsive">
                                                <table id="tablaresuprevenseguridad" class="table table-bordered table-striped text-center nowrap tablas">
                                                    <thead>
                                                        <tr>
                                                            <th>...</th>
                                                            <th>Placa</th>
                                                            <th>Fecha</th>
                                                            <th>Numero interno</th>
                                                            <th>Conductor</th>
                                                            <th>Gato</th>
                                                            <th>Cruceta o Copa</th>
                                                            <th>2 Conos o Triangulos</th>
                                                            <th>Botiquin</th>
                                                            <th>Extintor</th>
                                                            <th>2 Tacos</th>
                                                            <th>Alicate, destornillador</th>
                                                            <th>Llave de expansion, llaves fijas</th>
                                                            <th>Llanta de repuesto</th>
                                                            <th>Linterna con pila</th>
                                                            <th>Cinturon del conductor</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-editar"><i class="fas fa-edit"></i></button>
                                                            </td>
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
                                                        </tr>
                                                    </tbody>

                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-editar"><i class="fas fa-edit"></i></button>
                                                            </td>
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
                                                        </tr>
                                                    </tbody>

                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-editar"><i class="fas fa-edit"></i></button>
                                                            </td>
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
                                                        </tr>
                                                    </tbody>

                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-editar"><i class="fas fa-edit"></i></button>
                                                            </td>
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
                                                        </tr>
                                                    </tbody>

                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-editar"><i class="fas fa-edit"></i></button>
                                                            </td>
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
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>

                                            <br>

                                            <!-- TABLA RESUMEN DOCUMENTOS VEHICULOS -->
                                            <h3 class="text-center">Documentos vehiculos</h3>
                                            <div class="table-responsive">
                                                <table id="tablaresudocvehiculos" class="table table-bordered table-striped text-center nowrap tablas">
                                                    <thead>
                                                        <tr>
                                                            <th>...</th>
                                                            <th>Placa</th>
                                                            <th>Fecha</th>
                                                            <th>Numero interno</th>
                                                            <th>Conductor</th>
                                                            <th>Tarjeta de propiedad</th>
                                                            <th>Tarjeta de operacion</th>
                                                            <th>Seguro Obliogatorio</th>
                                                            <th>Revision tecnico mecanica</th>
                                                            <th>Poliza contractual</th>
                                                            <th>Poliza extracontractual</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-editar"><i class="fas fa-edit"></i></button>
                                                            </td>
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
                                                        </tr>
                                                    </tbody>

                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-editar"><i class="fas fa-edit"></i></button>
                                                            </td>
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
                                                        </tr>
                                                    </tbody>

                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-editar"><i class="fas fa-edit"></i></button>
                                                            </td>
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
                                                        </tr>
                                                    </tbody>

                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-editar"><i class="fas fa-edit"></i></button>
                                                            </td>
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
                                                        </tr>
                                                    </tbody>

                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-editar"><i class="fas fa-edit"></i></button>
                                                            </td>
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
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>

                                            <br>

                                            <!-- TABLA RESUMEN EXTINTOR -->
                                            <h3 class="text-center">Extintor</h3>
                                            <div class="table-responsive">
                                                <table id="tablaresuextintor" class="table table-bordered table-striped text-center nowrap tablas">
                                                    <thead>
                                                        <tr>
                                                            <th>...</th>
                                                            <th>Placa</th>
                                                            <th>Fecha</th>
                                                            <th>Numero interno</th>
                                                            <th>Conductor</th>
                                                            <th>Extintor tipo ABC</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-editar"><i class="fas fa-edit"></i></button>
                                                            </td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                    </tbody>

                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-editar"><i class="fas fa-edit"></i></button>
                                                            </td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                    </tbody>

                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-editar"><i class="fas fa-edit"></i></button>
                                                            </td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                    </tbody>

                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-editar"><i class="fas fa-edit"></i></button>
                                                            </td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                    </tbody>

                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-editar"><i class="fas fa-edit"></i></button>
                                                            </td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>

                                            <br>

                                            <!-- TABLA RESUMEN ACCESORIOS -->
                                            <h3 class="text-center">Accesorios</h3>
                                            <div class="table-responsive">
                                                <table id="tablaresuaccesorios" class="table table-bordered table-striped text-center nowrap tablas">
                                                    <thead>
                                                        <tr>
                                                            <th>...</th>
                                                            <th>Placa</th>
                                                            <th>Fecha</th>
                                                            <th>Numero interno</th>
                                                            <th>Conductor</th>
                                                            <th>Radiotelefono</th>
                                                            <th>Antena</th>
                                                            <th>Equipo de Sonido</th>
                                                            <th>Sonido CD o USB</th>
                                                            <th>Parlantes</th>
                                                            <th>Numero de parlantes</th>
                                                            <th>Manguera de agua</th>
                                                            <th>Pantalla / Televisor</th>
                                                            <th>Reloj</th>
                                                            <th>Brazo 1 izquierdo R1</th>
                                                            <th>Brazo 2 derecho R2</th>
                                                            <th>Brazo 3 izquierdo R3</th>
                                                            <th>Brazo 4 derecho R6</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-editar"><i class="fas fa-edit"></i></button>
                                                            </td>
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
                                                        </tr>
                                                    </tbody>

                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-editar"><i class="fas fa-edit"></i></button>
                                                            </td>
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
                                                        </tr>
                                                    </tbody>

                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-editar"><i class="fas fa-edit"></i></button>
                                                            </td>
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
                                                        </tr>
                                                    </tbody>

                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-editar"><i class="fas fa-edit"></i></button>
                                                            </td>
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
                                                        </tr>
                                                    </tbody>

                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-editar"><i class="fas fa-edit"></i></button>
                                                            </td>
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
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>

                                            <br>

                                            <!-- TABLA RESUMEN EMBLEMAS -->
                                            <h3 class="text-center">Emblemas</h3>
                                            <div class="table-responsive">
                                                <table id="tablaresuemblemas" class="table table-bordered table-striped text-center nowrap tablas">
                                                    <thead>
                                                        <tr>
                                                            <th>...</th>
                                                            <th>Placa</th>
                                                            <th>Fecha</th>
                                                            <th>Numero interno</th>
                                                            <th>Conductor</th>
                                                            <th>Emblema izquierdo de la empresa</th>
                                                            <th>Emblema derecho de la empresa</th>
                                                            <th>Escolar: delantero - trasero</th>
                                                            <th>Logo izquierdo</th>
                                                            <th>Logo derecho</th>
                                                            <th>Numero interno delantero</th>
                                                            <th>Numero interno trasero</th>
                                                            <th>Numero interno izquierdo</th>
                                                            <th>Numero interno derecho</th>
                                                            <th>Salidas de emergencia y martillos</th>
                                                            <th>Dispositivo de velocidad</th>
                                                            <th>Aviso: como conduzco interno - externo</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-editar"><i class="fas fa-edit"></i></button>
                                                            </td>
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
                                                        </tr>
                                                    </tbody>

                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-editar"><i class="fas fa-edit"></i></button>
                                                            </td>
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
                                                        </tr>
                                                    </tbody>

                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-editar"><i class="fas fa-edit"></i></button>
                                                            </td>
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
                                                        </tr>
                                                    </tbody>

                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-editar"><i class="fas fa-edit"></i></button>
                                                            </td>
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
                                                        </tr>
                                                    </tbody>

                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-editar"><i class="fas fa-edit"></i></button>
                                                            </td>
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
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>

                                            <br>

                                            <!-- TABLA RESUMEN OTROS ELEMENTOS -->
                                            <h3 class="text-center">Otros elementos</h3>
                                            <div class="table-responsive">
                                                <table id="tablaresuotroselementos" class="table table-bordered table-striped text-center nowrap tablas">
                                                    <thead>
                                                        <tr>
                                                            <th>...</th>
                                                            <th>Placa</th>
                                                            <th>Fecha</th>
                                                            <th>Numero interno</th>
                                                            <th>Conductor</th>
                                                            <th>Brazo limpiaparabrisas izquierdo</th>
                                                            <th>Plumillas limpiaparabrisas izquierdo</th>
                                                            <th>Brazo limpiaparabrisas derecho</th>
                                                            <th>Plumilla limpiaparabrisas derecho</th>
                                                            <th>Baterias</th>
                                                            <th>Botones de tablero y timon</th>
                                                            <th>Tapa de radiador</th>
                                                            <th>Tapa deposito hidraulico</th>
                                                            <th>Cojineria en general</th>
                                                            <th>Cinturon sillas cantidad</th>
                                                            <th>Pasamanos</th>
                                                            <th>Claxon</th>
                                                            <th>Placas reglamentarias</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-editar"><i class="fas fa-edit"></i></button>
                                                            </td>
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
                                                        </tr>
                                                    </tbody>

                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-editar"><i class="fas fa-edit"></i></button>
                                                            </td>
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
                                                        </tr>
                                                    </tbody>

                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-editar"><i class="fas fa-edit"></i></button>
                                                            </td>
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
                                                        </tr>
                                                    </tbody>

                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-editar"><i class="fas fa-edit"></i></button>
                                                            </td>
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
                                                        </tr>
                                                    </tbody>

                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-editar"><i class="fas fa-edit"></i></button>
                                                            </td>
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
            </div><!-- col -->
        </div> <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->