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
                    <h1 class="m-0 text-dark ">Inventario Vehicular</h1>
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
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="parabriizq1" name="parabriizq1" value="option1">
                                                                                                                        <label for="parabriizq1" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="parabriizq2" name="parabriizq2" value="option1">
                                                                                                                        <label for="parabriizq2" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                            </tr>

                                                                                                            <tr>
                                                                                                                <td style="width: 10px;">11.</td>
                                                                                                                <td>Parabrisas derecho</td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="parabrider1" name="parabrider1" value="option1">
                                                                                                                        <label for="parabrider1" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="parabrider2" name="parabrider2" value="option1">
                                                                                                                        <label for="parabrider2" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                            </tr>

                                                                                                            <tr>
                                                                                                                <td style="width: 10px;">12.</td>
                                                                                                                <td>Espejo retrovisor derecho</td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="esperetroder1" name="esperetroder1" value="option1">
                                                                                                                        <label for="esperetroder1" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="esperetroder2" name="esperetroder2" value="option1">
                                                                                                                        <label for="esperetroder2" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                            </tr>

                                                                                                            <tr>
                                                                                                                <td style="width: 10px;">13.</td>
                                                                                                                <td>Espejo retrovisor izquierdo</td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="esperetroizq1" name="esperetroizq1" value="option1">
                                                                                                                        <label for="esperetroizq1" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="esperetroizq2" name="esperetroizq2" value="option1">
                                                                                                                        <label for="esperetroizq2" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                            </tr>

                                                                                                            <tr>
                                                                                                                <td style="width: 10px;">14.</td>
                                                                                                                <td>Vidrios ventanas lateral derecho</td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="vilateralder1" name="vilateralder1" value="option1">
                                                                                                                        <label for="vilateralder1" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="vilateralder2" name="vilateralder2" value="option1">
                                                                                                                        <label for="vilateralder2" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                            </tr>

                                                                                                            <tr>
                                                                                                                <td style="width: 10px;">15.</td>
                                                                                                                <td>Vidrios ventanas lateral izquierdo</td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="vilateralizq1" name="vilateralizq1" value="option1">
                                                                                                                        <label for="vilateralizq1" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="vilateralizq2" name="vilateralizq2" value="option1">
                                                                                                                        <label for="vilateralizq2" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                            </tr>

                                                                                                            <tr>
                                                                                                                <td style="width: 10px;">16.</td>
                                                                                                                <td>Parabrisas trasero</td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="parabritrasero1" name="parabritrasero1" value="option1">
                                                                                                                        <label for="parabritrasero1" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="parabritrasero2" name="parabritrasero2" value="option1">
                                                                                                                        <label for="parabritrasero2" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                            </tr>

                                                                                                            <tr>
                                                                                                                <td style="width: 10px;">17.</td>
                                                                                                                <td>Vidrios de puertas</td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="vidriospuertas1" name="vidriospuertas1" value="option1">
                                                                                                                        <label for="vidriospuertas1" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="vidriospuertas2" name="vidriospuertas2" value="option1">
                                                                                                                        <label for="vidriospuertas2" class="custom-control-label"></label>
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
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="dirdelanizq1" name="dirdelanizq1" value="option1">
                                                                                                                        <label for="dirdelanizq1" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="dirdelanizq2" name="dirdelanizq2" value="option1">
                                                                                                                        <label for="dirdelanizq2" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="dirdelanizq3" name="dirdelanizq3" value="option1">
                                                                                                                        <label for="dirdelanizq3" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                            </tr>

                                                                                                            <tr>
                                                                                                                <td style="width: 10px;">19.</td>
                                                                                                                <td>Direccional delantera derecha</td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="dirdelander1" name="dirdelander1" value="option1">
                                                                                                                        <label for="dirdelander1" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="dirdelander2" name="dirdelander2" value="option1">
                                                                                                                        <label for="dirdelander2" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="dirdelander3" name="dirdelander3" value="option1">
                                                                                                                        <label for="dirdelander3" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                            </tr>

                                                                                                            <tr>
                                                                                                                <td style="width: 10px;">20.</td>
                                                                                                                <td>Stop trasero derecho</td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="stoptraseroder1" name="stoptraseroder1" value="option1">
                                                                                                                        <label for="stoptraseroder1" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="stoptraseroder2" name="stoptraseroder2" value="option1">
                                                                                                                        <label for="stoptraseroder2" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="stoptrasero3der" name="stoptrasero3der" value="option1">
                                                                                                                        <label for="stoptrasero3der" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                            </tr>

                                                                                                            <tr>
                                                                                                                <td style="width: 10px;">21.</td>
                                                                                                                <td>Stop trasero izquierdo</td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="stoptraseroizq1" name="stoptraseroizq1" value="option1">
                                                                                                                        <label for="stoptraseroizq1" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="stoptraseroizq2" name="stoptraseroizq2" value="option1">
                                                                                                                        <label for="stoptraseroizq2" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="stoptraseroizq3" name="stoptraseroizq3" value="option1">
                                                                                                                        <label for="stoptraseroizq3" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                            </tr>

                                                                                                            <tr>
                                                                                                                <td style="width: 10px;">22.</td>
                                                                                                                <td>Cucuyo lateral derecho</td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="cucuyolateder1" name="cucuyolateder1" value="option1">
                                                                                                                        <label for="cucuyolateder1" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="cucuyolateder2" name="cucuyolateder2" value="option1">
                                                                                                                        <label for="cucuyolateder2" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="cucuyolateder3" name="cucuyolateder3" value="option1">
                                                                                                                        <label for="cucuyolateder3" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                            </tr>

                                                                                                            <tr>
                                                                                                                <td style="width: 10px;">23.</td>
                                                                                                                <td>Cucuyo lateral izquierdo</td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="cucuyolaterizq1" name="cucuyolaterizq1" value="option1">
                                                                                                                        <label for="cucuyolaterizq1" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="cucuyolaterizq2" name="cucuyolaterizq2" value="option1">
                                                                                                                        <label for="cucuyolaterizq2" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="cucuyolaterizq3" name="cucuyolaterizq3" value="option1">
                                                                                                                        <label for="cucuyolaterizq3" class="custom-control-label"></label>
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
                                                                                                                    <div class="custom-control custom-checkbox ">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="lucesinternas1" name="lucesinternas1" value="option1">
                                                                                                                        <label for="lucesinternas1" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="lucesinternas2" name="lucesinternas2" value="option1">
                                                                                                                        <label for="lucesinternas2" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="lucesinternas3" name="lucesinternas3" value="option1">
                                                                                                                        <label for="lucesinternas3" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                            </tr>

                                                                                                            <tr>
                                                                                                                <td style="width: 10px;">25.</td>
                                                                                                                <td>Balizas ( Licuadoras )</td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="customCheckbox1" value="option1">
                                                                                                                        <label for="customCheckbox1" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="customCheckbox1" value="option1">
                                                                                                                        <label for="customCheckbox1" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="customCheckbox1" value="option1">
                                                                                                                        <label for="customCheckbox1" class="custom-control-label"></label>
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
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="delanizq1" name="delanizq1" value="option1">
                                                                                                                        <label for="delanizq1" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="delanizq2" name="delanizq2" value="option1">
                                                                                                                        <label for="delanizq2" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="delanizq3" name="delanizq3" value="option1">
                                                                                                                        <label for="delanizq3" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                            </tr>

                                                                                                            <tr>
                                                                                                                <td style="width: 10px;">27.</td>
                                                                                                                <td>Delantera derecha ( R2 )</td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="delander1" name="delander1" value="option1">
                                                                                                                        <label for="delander1" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="delander2" name="delander2" value="option1">
                                                                                                                        <label for="delander2" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="delander3" name="delander3" value="option1">
                                                                                                                        <label for="delander3" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                            </tr>

                                                                                                            <tr>
                                                                                                                <td style="width: 10px;">28.</td>
                                                                                                                <td>Trasera interior izquierda ( R3 )</td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="traserinterizq1" name="traserinterizq1" value="option1">
                                                                                                                        <label for="traserinterizq1" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="traserinterizq2" name="traserinterizq2" value="option1">
                                                                                                                        <label for="traserinterizq2" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="traserinterizq3" name="traserinterizq3" value="option1">
                                                                                                                        <label for="traserinterizq3" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                            </tr>

                                                                                                            <tr>
                                                                                                                <td style="width: 10px;">29.</td>
                                                                                                                <td>Trasera exterior izquierda ( R4 )</td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="traserexteizq1" name="traserexteizq1" value="option1">
                                                                                                                        <label for="traserexteizq1" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="traserexteizq2" name="traserexteizq2" value="option1">
                                                                                                                        <label for="traserexteizq2" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="traserexteizq3" name="traserexteizq3" value="option1">
                                                                                                                        <label for="traserexteizq3" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                            </tr>

                                                                                                            <tr>
                                                                                                                <td style="width: 10px;">30.</td>
                                                                                                                <td>Trasera interior derecha ( R5 )</td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="traserinteder1" name="traserinteder1" value="option1">
                                                                                                                        <label for="traserinteder1" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="traserinteder2" name="traserinteder2" value="option1">
                                                                                                                        <label for="traserinteder2" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="traserinteder3" name="traserinteder3" value="option1">
                                                                                                                        <label for="traserinteder3" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                            </tr>

                                                                                                            <tr>
                                                                                                                <td style="width: 10px;">31.</td>
                                                                                                                <td>Trasera exterior derecha ( R6 )</td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="traserexteder1" name="traserexteder1" value="option1">
                                                                                                                        <label for="traserexteder1" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="traserexteder2" name="traserexteder2" value="option1">
                                                                                                                        <label for="traserexteder2" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="traserexteder3" name="traserexteder3" value="option1">
                                                                                                                        <label for="traserexteder3" class="custom-control-label"></label>
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
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="gato1" name="gato1" value="option1">
                                                                                                                        <label for="gato1" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="gato2" name="gato2" value="option1">
                                                                                                                        <label for="gato2" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                            </tr>

                                                                                                            <tr>
                                                                                                                <td style="width: 10px;">33.</td>
                                                                                                                <td>Cruceta o Copa</td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="crucecopa1" name="crucecopa1" value="option1">
                                                                                                                        <label for="crucecopa1" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="crucecopa2" name="crucecopa2" value="option1">
                                                                                                                        <label for="crucecopa2" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                            </tr>

                                                                                                            <tr>
                                                                                                                <td style="width: 10px;">34.</td>
                                                                                                                <td>2 Conos o Triangulos</td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="conotriangu1" name="conotriangu1" value="option1">
                                                                                                                        <label for="conotriangu1" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="conotriangu2" name="conotriangu2" value="option1">
                                                                                                                        <label for="conotriangu2" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                            </tr>

                                                                                                            <tr>
                                                                                                                <td style="width: 10px;">35.</td>
                                                                                                                <td>Botiquin</td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="botiquin1" name="botiquin1" value="option1">
                                                                                                                        <label for="botiquin1" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="botiquin2" name="botiquin1" value="option1">
                                                                                                                        <label for="botiquin2" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                            </tr>

                                                                                                            <tr>
                                                                                                                <td style="width: 10px;">36.</td>
                                                                                                                <td>Extintor</td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="extintor1" name="extintor1" value="option1">
                                                                                                                        <label for="extintor1" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="extintor2" name="extintor2" value="option1">
                                                                                                                        <label for="extintor2" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                            </tr>

                                                                                                            <tr>
                                                                                                                <td style="width: 10px;">37.</td>
                                                                                                                <td>2 Tacos o Bloques</td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="tacosbloques1" name="tacosbloques1" value="option1">
                                                                                                                        <label for="tacosbloques1" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="tacosbloques2" name="tacosbloques1" value="option1">
                                                                                                                        <label for="tacosbloques2" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                            </tr>

                                                                                                            <tr>
                                                                                                                <td style="width: 10px;">38.1</td>
                                                                                                                <td>Alicate, destornillaodor</td>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="alicatedestor1" name="alicatedestor1" value="option1">
                                                                                                                        <label for="alicatedestor1" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="alicatedestor2" name="alicatedestor2" value="option1">
                                                                                                                        <label for="alicatedestor2" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                            </tr>

                                                                                                            <tr>
                                                                                                                <td style="width: 10px;">38.2</td>
                                                                                                                <td>PLlave de expancion, LLaves fijas</td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="expafijas1" name="expafijas1" value="option1">
                                                                                                                        <label for="expafijas1" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="expafijas2" name="expafijas2" value="option1">
                                                                                                                        <label for="expafijas2" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                            </tr>

                                                                                                            <tr>
                                                                                                                <td style="width: 10px;">39.</td>
                                                                                                                <td>LLanta de repuesto</td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="llantarepuesto1" name="llantarepuesto1" value="option1">
                                                                                                                        <label for="llantarepuesto1" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="llantarepuesto2" name="llantarepuesto2" value="option1">
                                                                                                                        <label for="llantarepuesto2" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                            </tr>

                                                                                                            <tr>
                                                                                                                <td style="width: 10px;">40.</td>
                                                                                                                <td>Linterna con pila</td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="linterna1" name="linterna1" value="option1">
                                                                                                                        <label for="linterna1" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="linterna2" name="linterna2" value="option1">
                                                                                                                        <label for="linterna2" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                            </tr>

                                                                                                            <tr>
                                                                                                                <td style="width: 10px;">41.</td>
                                                                                                                <td>Cinturon del conductor</td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="cinturonconductor1" name="cinturonconductor1" value="option1">
                                                                                                                        <label for="cinturonconductor1" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="cinturonconductor2" name="cinturonconductor2" value="option1">
                                                                                                                        <label for="cinturonconductor2" class="custom-control-label"></label>
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
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="radiotel1" name="radiotel1" value="option1">
                                                                                                                        <label for="radiotel1" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="radiotel2" name="radiotel2" value="option1">
                                                                                                                        <label for="radiotel2" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="radiotel3" name="radiotel3" value="option1">
                                                                                                                        <label for="radiotel3" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                            </tr>

                                                                                                            <tr>
                                                                                                                <td style="width: 10px;">50.</td>
                                                                                                                <td>Antena</td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="antena1" name="antena1" value="option1">
                                                                                                                        <label for="antena1" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="antena2" name="antena2" value="option1">
                                                                                                                        <label for="antena2" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="antena3" name="antena3" value="option1">
                                                                                                                        <label for="antena3" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                            </tr>

                                                                                                            <tr>
                                                                                                                <td style="width: 10px;">51.</td>
                                                                                                                <td>Equipo de Sonido</td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="sonido1" name="sonido1" value="option1">
                                                                                                                        <label for="sonido1" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="sonido2" name="sonido2" value="option1">
                                                                                                                        <label for="sonido2" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="sonido3" name="sonido3" value="option1">
                                                                                                                        <label for="sonido3" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td style="width: 150px;">
                                                                                                                    <div class="row">
                                                                                                                        <div class="col-sm-6">
                                                                                                                            <div class="custom-control custom-checkbox">
                                                                                                                                <input class="custom-control-input" type="checkbox" id="usb" name="usb" value="option1">
                                                                                                                                <label for="usb" class="custom-control-label">USB</label>
                                                                                                                            </div>
                                                                                                                        </div>

                                                                                                                        <div class="col-sm-6">
                                                                                                                            <div class="custom-control custom-checkbox">
                                                                                                                                <input class="custom-control-input" type="checkbox" id="cd" name="cd" value="option1">
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
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="parlantes1" name="parlantes1" value="option1">
                                                                                                                        <label for="parlantes1" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="parlantes2" name="parlantes2" value="option1">
                                                                                                                        <label for="parlantes2" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="parlantes3" name="parlantes3" value="option1">
                                                                                                                        <label for="parlantes3" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                            </tr>

                                                                                                            <tr>
                                                                                                                <td style="width: 10px;">53.</td>
                                                                                                                <td>Manguera de agua</td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="mangueraagua1" name="mangueraagua1" value="option1">
                                                                                                                        <label for="mangueraagua1" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="mangueraagua2" name="mangueraagua2" value="option1">
                                                                                                                        <label for="mangueraagua2" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="mangueraagua3" name="mangueraagua3" value="option1">
                                                                                                                        <label for="mangueraagua3" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                            </tr>

                                                                                                            <tr>
                                                                                                                <td style="width: 10px;">54.</td>
                                                                                                                <td>Manguera de aire</td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="mangueraaire1" name="mangueraaire1" value="option1">
                                                                                                                        <label for="mangueraaire1" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="mangueraaire2" name="mangueraaire2" value="option1">
                                                                                                                        <label for="mangueraaire2" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="mangueraaire3" name="mangueraaire3" value="option1">
                                                                                                                        <label for="mangueraaire3" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                            </tr>

                                                                                                            <tr>
                                                                                                                <td style="width: 10px;">55.</td>
                                                                                                                <td>Pantalla / Televisor</td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="pantallatv1" name="pantallatv1" value="option1">
                                                                                                                        <label for="pantallatv1" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="pantallatv2" name="pantallatv2" value="option1">
                                                                                                                        <label for="pantallatv2" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="pantallatv3" name="pantallatv3" value="option1">
                                                                                                                        <label for="pantallatv3" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                            </tr>

                                                                                                            <tr>
                                                                                                                <td style="width: 10px;">56.</td>
                                                                                                                <td>Reloj</td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="reloj1" name="reloj1" value="option1">
                                                                                                                        <label for="reloj1" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="reloj2" name="reloj2" value="option1">
                                                                                                                        <label for="reloj2" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="reloj3" name="reloj3" value="option1">
                                                                                                                        <label for="reloj3" class="custom-control-label"></label>
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
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="brazoizq1" name="brazoizq1" value="option1">
                                                                                                                        <label for="brazoizq1" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="brazoizq2" name="brazoizq2" value="option1">
                                                                                                                        <label for="brazoizq2" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="brazoizq3" name="brazoizq3" value="option1">
                                                                                                                        <label for="brazoizq3" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                            </tr>

                                                                                                            <tr>
                                                                                                                <td style="width: 10px;">58.</td>
                                                                                                                <td>Brazo 2 Derecho R2</td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="brazoder1" name="brazoder1" value="option1">
                                                                                                                        <label for="brazoder1" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="brazoder2" name="brazoder2" value="option1">
                                                                                                                        <label for="brazoder2" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="brazoder3" name="brazoder3" value="option1">
                                                                                                                        <label for="brazoder3" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                            </tr>

                                                                                                            <tr>
                                                                                                                <td style="width: 10px;">59.</td>
                                                                                                                <td>Brazo 3 Izquierdo R3</td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="brazoizqdos1" name="brazoizqdos1" value="option1">
                                                                                                                        <label for="brazoizqdos1" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="brazoizqdos2" name="brazoizqdos2" value="option1">
                                                                                                                        <label for="brazoizqdos2" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="brazoizqdos3" name="brazoizqdos3" value="option1">
                                                                                                                        <label for="brazoizqdos3" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                            </tr>

                                                                                                            <tr>
                                                                                                                <td style="width: 10px;">60.</td>
                                                                                                                <td>Brazo 4 Derecho R6</td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="brazoderdos1" name="brazoderdos1" value="option1">
                                                                                                                        <label for="brazoderdos1" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="brazoderdos2" name="brazoderdos2" value="option1">
                                                                                                                        <label for="brazoderdos2" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="brazoderdos3" name="brazoderdos3" value="option1">
                                                                                                                        <label for="brazoderdos3" class="custom-control-label"></label>
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
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="emblemaizq1" name="emblemaizq1" value="option1">
                                                                                                                        <label for="emblemaizq1" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="emblemaizq2" name="emblemaizq2" value="option1">
                                                                                                                        <label for="emblemaizq2" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="emblemaizq3" name="emblemaizq3" value="option1">
                                                                                                                        <label for="emblemaizq3" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                            </tr>

                                                                                                            <tr>
                                                                                                                <td style="width: 10px;">62.</td>
                                                                                                                <td>Emblema derecho de la empresa</td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="emblemader1" name="emblemader1" value="option1">
                                                                                                                        <label for="emblemader1" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="emblemader2" name="emblemader2" value="option1">
                                                                                                                        <label for="emblemader2" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="emblemader3" name="emblemader3" value="option1">
                                                                                                                        <label for="emblemader3" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                            </tr>

                                                                                                            <tr>
                                                                                                                <td style="width: 10px;">63.</td>
                                                                                                                <td>Escolar delantero</td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="escolardelantero1" name="escolardelantero1" value="option1">
                                                                                                                        <label for="escolardelantero1" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="escolardelantero2" name="escolardelantero2" value="option1">
                                                                                                                        <label for="escolardelantero2" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="escolardelantero3" name="escolardelantero3" value="option1">
                                                                                                                        <label for="escolardelantero3" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="escolardelantero4" name="escolardelantero4" value="option1">
                                                                                                                        <label for="escolardelantero4" class="custom-control-label">Delantero</label>
                                                                                                                    </div>

                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="escolardelantero5" name="escolardelantero5" value="option1">
                                                                                                                        <label for="escolardelantero5" class="custom-control-label">Trasero</label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                            </tr>

                                                                                                            <tr>
                                                                                                                <td style="width: 10px;">64.</td>
                                                                                                                <td>Logo izquierdo</td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="logoizq1" name="logoizq1" value="option1">
                                                                                                                        <label for="logoizq1" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="logoizq2" name="logoizq2" value="option1">
                                                                                                                        <label for="logoizq2" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="logoizq3" name="logoizq3" value="option1">
                                                                                                                        <label for="logoizq3" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                            </tr>

                                                                                                            <tr>
                                                                                                                <td style="width: 10px;">65.</td>
                                                                                                                <td>Logo derecho</td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="logoder1" name="logoder1" value="option1">
                                                                                                                        <label for="logoder1" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="logoder2" name="logoder2" value="option1">
                                                                                                                        <label for="logoder2" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="logoder3" name="logoder3" value="option1">
                                                                                                                        <label for="logoder3" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                            </tr>

                                                                                                            <tr>
                                                                                                                <td style="width: 10px;">66.</td>
                                                                                                                <td>N° Interno delantero</td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="internoder1" name="internoder1" value="option1">
                                                                                                                        <label for="internoder1" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="internoder2" name="internoder2" value="option1">
                                                                                                                        <label for="internoder2" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="internoder3" name="internoder3" value="option1">
                                                                                                                        <label for="internoder3" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                            </tr>

                                                                                                            <tr>
                                                                                                                <td style="width: 10px;">67.</td>
                                                                                                                <td>N° Interno trasero</td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="internotrasero1" name="internotrasero1" value="option1">
                                                                                                                        <label for="internotrasero1" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="internotrasero2" name="internotrasero2" value="option1">
                                                                                                                        <label for="internotrasero2" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="internotrasero3" name="internotrasero3" value="option1">
                                                                                                                        <label for="internotrasero3" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                            </tr>

                                                                                                            <tr>
                                                                                                                <td style="width: 10px;">68.</td>
                                                                                                                <td>N° Interno izquierdo</td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="internoizq1" name="internoizq1" value="option1">
                                                                                                                        <label for="internoizq1" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="internoizq2" name="internoizq2" value="option1">
                                                                                                                        <label for="internoizq2" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="internoizq3" name="internoizq3" value="option1">
                                                                                                                        <label for="internoizq3" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                            </tr>

                                                                                                            <tr>
                                                                                                                <td style="width: 10px;">69.</td>
                                                                                                                <td>N° Interno derecho</td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="internoder1" name="internoder1" value="option1">
                                                                                                                        <label for="internoder1" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="internoder2" name="internoder2" value="option1">
                                                                                                                        <label for="internoder2" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="internoder3" name="internoder3" value="option1">
                                                                                                                        <label for="internoder3" class="custom-control-label"></label>
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
                                                                                                                        <input type="text" class="form-control" placeholder="# ..." id="numsalimarti" name="numsalimarti">
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="salidasmartillos1" name="salidasmartillos1" value="option1">
                                                                                                                        <label for="salidasmartillos1" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="salidasmartillos2" name="salidasmartillos2" value="option1">
                                                                                                                        <label for="salidasmartillos2" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="salidasmartillos3" name="salidasmartillos3" value="option1">
                                                                                                                        <label for="salidasmartillos3" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                            </tr>

                                                                                                            <tr>
                                                                                                                <td style="width: 10px;">71.</td>
                                                                                                                <td>Dispositivo de velocidad</td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="disvelocidad1" name="disvelocidad1" value="option1">
                                                                                                                        <label for="disvelocidad1" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="disvelocidad2" name="disvelocidad2" value="option1">
                                                                                                                        <label for="disvelocidad2" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="disvelocidad3" name="disvelocidad3" value="option1">
                                                                                                                        <label for="disvelocidad3" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                            </tr>

                                                                                                            <tr>
                                                                                                                <td style="width: 10px;">72.</td>
                                                                                                                <td>Aviso: Como conduzco </td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="avisocomocondu1" name="avisocomocondu1" value="option1">
                                                                                                                        <label for="avisocomocondu1" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="avisocomocondu2" name="avisocomocondu2" value="option1">
                                                                                                                        <label for="avisocomocondu2" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="avisocomocondu3" name="avisocomocondu3" value="option1">
                                                                                                                        <label for="avisocomocondu3" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="comoconduinter" name="comoconduinter" value="option1">
                                                                                                                        <label for="comoconduinter" class="custom-control-label">Interno</label>
                                                                                                                    </div>

                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="comoconduexter" name="comoconduexter" value="option1">
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
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="limpiabriizq1" name="limpiabriizq1" value="option1">
                                                                                                                        <label for="limpiabriizq1" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="limpiabriizq2" name="limpiabriizq2" value="option1">
                                                                                                                        <label for="limpiabriizq2" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="limpiabriizq3" name="limpiabriizq3" value="option1">
                                                                                                                        <label for="limpiabriizq3" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                            </tr>

                                                                                                            <tr>
                                                                                                                <td style="width: 10px;">74.</td>
                                                                                                                <td>Plumilla limpiaparabrisas izquierdo</td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="plumilimpiaizq1" name="plumilimpiaizq1" value="option1">
                                                                                                                        <label for="plumilimpiaizq1" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="plumilimpiaizq2" name="plumilimpiaizq2" value="option1">
                                                                                                                        <label for="plumilimpiaizq2" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="plumilimpiaizq3" name="plumilimpiaizq2" value="option1">
                                                                                                                        <label for="plumilimpiaizq3" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                            </tr>

                                                                                                            <tr>
                                                                                                                <td style="width: 10px;">75.</td>
                                                                                                                <td>Brazo limpiaparabrisas derecho</td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="brazolimpibrider1" name="brazolimpibrider1" value="option1">
                                                                                                                        <label for="brazolimpibrider1" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="brazolimpibrider2" name="brazolimpibrider2" value="option1">
                                                                                                                        <label for="brazolimpibrider2" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="brazolimpibrider3" name="brazolimpibrider3" value="option1">
                                                                                                                        <label for="brazolimpibrider3" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                            </tr>

                                                                                                            <tr>
                                                                                                                <td style="width: 10px;">76.</td>
                                                                                                                <td>Plumilla limpiaparabrisas derecho</td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="plumilimpiader1" name="plumilimpiader1" value="option1">
                                                                                                                        <label for="plumilimpiader1" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="plumilimpiader2" name="plumilimpiader2" value="option1">
                                                                                                                        <label for="plumilimpiader2" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="plumilimpiader3" name="plumilimpiader3" value="option1">
                                                                                                                        <label for="plumilimpiader3" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                            </tr>

                                                                                                            <tr>
                                                                                                                <td style="width: 10px;">77.</td>
                                                                                                                <td>Baterias</td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="baterias1" name="baterias1" value="option1">
                                                                                                                        <label for="baterias1" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="baterias2" name="baterias2" value="option1">
                                                                                                                        <label for="baterias2" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="baterias3" name="baterias3" value="option1">
                                                                                                                        <label for="baterias3" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                            </tr>

                                                                                                            <tr>
                                                                                                                <td style="width: 10px;">78.</td>
                                                                                                                <td>Botones de tableron y timon</td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="botonestabletimon1" name="botonestabletimon1" value="option1">
                                                                                                                        <label for="botonestabletimon1" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="botonestabletimon2" name="botonestabletimon2" value="option1">
                                                                                                                        <label for="botonestabletimon2" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="botonestabletimon3" name="botonestabletimon3" value="option1">
                                                                                                                        <label for="botonestabletimon3" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                            </tr>

                                                                                                            <tr>
                                                                                                                <td style="width: 10px;">79.</td>
                                                                                                                <td>Tapa radiador</td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="taparadiador1" value="option1">
                                                                                                                        <label for="taparadiador1" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="taparadiador2" value="option1">
                                                                                                                        <label for="taparadiador2" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="taparadiador3" value="option1">
                                                                                                                        <label for="taparadiador3" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                            </tr>

                                                                                                            <tr>
                                                                                                                <td style="width: 10px;">80.</td>
                                                                                                                <td>Tapa deposito hidráulico</td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="tapahidraulico1" name="tapahidraulico1" value="option1">
                                                                                                                        <label for="tapahidraulico1" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="tapahidraulico2" name="tapahidraulico2" value="option1">
                                                                                                                        <label for="tapahidraulico2" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="tapahidraulico3" name="tapahidraulico3" value="option1">
                                                                                                                        <label for="tapahidraulico3" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                            </tr>

                                                                                                            <tr>
                                                                                                                <td style="width: 10px;">81.</td>
                                                                                                                <td>Cojineria en general</td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="cojineria1" name="cojineria1" value="option1">
                                                                                                                        <label for="cojineria1" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="cojineria2" name="cojineria2" value="option1">
                                                                                                                        <label for="cojineria2" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="cojineria3" name="cojineria3" value="option1">
                                                                                                                        <label for="cojineria3" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                            </tr>

                                                                                                            <tr>
                                                                                                                <td style="width: 10px;">82.</td>
                                                                                                                <td>Cinturon sillas calidad</td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="sillascalidad1" name="sillascalidad1" value="option1">
                                                                                                                        <label for="sillascalidad1" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="sillascalidad2" name="sillascalidad2" value="option1">
                                                                                                                        <label for="sillascalidad2" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="sillascalidad3" name="sillascalidad3" value="option1">
                                                                                                                        <label for="sillascalidad3" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                            </tr>

                                                                                                            <tr>
                                                                                                                <td style="width: 10px;">83.</td>
                                                                                                                <td>Pasamanos</td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="pasamanos1" name="pasamanos1" value="option1">
                                                                                                                        <label for="pasamanos1" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="pasamanos2" name="pasamanos2" value="option1">
                                                                                                                        <label for="pasamanos2" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="pasamanos3" name="pasamanos3" value="option1">
                                                                                                                        <label for="pasamanos3" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                            </tr>

                                                                                                            <tr>
                                                                                                                <td style="width: 10px;">84.</td>
                                                                                                                <td>Claxon</td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="claxon1" name="claxon1" value="option1">
                                                                                                                        <label for="claxon1" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="claxon2" name="claxon2" value="option1">
                                                                                                                        <label for="claxon2" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="claxon3" name="claxon3" value="option1">
                                                                                                                        <label for="claxon3" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                            </tr>

                                                                                                            <tr>
                                                                                                                <td style="width: 10px;">85.</td>
                                                                                                                <td>Placas reglamentarias</td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="placasregla1" name="placasregla1" value="option1">
                                                                                                                        <label for="placasregla1" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="placasregla2" name="placasregla2" value="option1">
                                                                                                                        <label for="placasregla2" class="custom-control-label"></label>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                                        <input class="custom-control-input" type="checkbox" id="placasregla3" name="placasregla3" value="option1">
                                                                                                                        <label for="placasregla3" class="custom-control-label"></label>
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