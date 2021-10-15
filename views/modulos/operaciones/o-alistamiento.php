<?php

if (!validarPermiso('M_OPERACIONES', 'R')) {
    echo "<script> window.location = 'inicio'; </script>";
}

$Alistamientos = ControladorAlistamiento::ctrListaAlistamientos();
$Vehiculos = ControladorVehiculos::ctrListaVehiculos();
$tiposDocumentacion = ControladorVehiculos::ctrTiposDocumentacion();

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
                    <h1 class="m-0 text-dark"><b><i>Protocolo de Alistamientos <i class="fas fa-briefcase"></i></i></b></h1>
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
            <div class="row">
                <div class="col-12">
                    <button type="button" class="btn bg-gradient-success btn-nuevoAlistamiento" data-toggle="modal" data-target="#modal-nuevoAlistamiento"><i class="fas fa-bus"></i> Nuevo</button>
                </div>
            </div>
            <!-- ===================== 
              AGREGAR FILAS Y COLUMNAS PARA EL DESARROLLO 
            ========================= -->
            <div class="row mt-2">
                <div class="col-12">
                    <div class="card card-outline card-success">
                        <div class="card-body">
                            <!--|||TABLA PROTOCOLO DE ALISTAMIENTO|||-->
                            <table id="tblAlistamientos" class="table table-responsive table-bordered table-striped text-center w-100">
                                <thead class="text-nowrap text-sm">
                                    <tr>
                                        <th colspan="7">INFORMACIÓN GENERAL</th>
                                        <th colspan="12">SISTEMA DE LUCES</th>
                                        <th colspan="24">CARROCERÍA</th>
                                        <th colspan="12">SISTEMAS</th>
                                        <th colspan="6">INDICADORES DE TABLERO</th>
                                        <th colspan="6">MANTENIMIENTO</th>
                                        <th colspan="11">LLANTAS</th>
                                        <th colspan="14">EQUIPO DE SEGURIDAD</th>
                                    </tr>

                                    <tr>
                                        <th>...</th>
                                        <th style="min-width:70px;">ID</th>
                                        <th>Fecha - Hora</th>
                                        <th style="min-width:80px;">Placa</th>
                                        <th>Número interno</th>
                                        <th>Nombre del conductor</th>
                                        <th>Cédula del conductor</th>
                                        <th>Luces bajas</th>
                                        <th>Luces altas</th>
                                        <th>Luces reversa</th>
                                        <th>Direccionales delanteras</th>
                                        <th>Iluminación cabina</th>
                                        <th>Luces internas</th>
                                        <th>Luces medias</th>
                                        <th>Luces de Stop</th>
                                        <th>Luces de Parqueo</th>
                                        <th>Direccionales traseras</th>
                                        <th>Luz escala</th>
                                        <th>Baliza / Licuadora</th>
                                        <th>Retrovisores izquierdo</th>
                                        <th>Espejo interno</th>
                                        <th>Apoya cabeza - Conductor</th>
                                        <th>Equipo de Audio</th>
                                        <th>Claraboyas</th>
                                        <th>Alarma de Retroceso</th>
                                        <th>Parabrisas</th>
                                        <th>Retrovisor derecho</th>
                                        <th>Apoya cabeza Pasajero</th>
                                        <th>Placas</th>
                                        <th>Limpia parabrisas Derecho</th>
                                        <th>Limpia parabrizas Izquierdo</th>
                                        <th>Piso</th>
                                        <th>Sillas</th>
                                        <th> Escaleras Antideslizante</th>
                                        <th> Puertas</th>
                                        <th> Bomper trasero</th>
                                        <th> Bomper delantero</th>
                                        <th> Claxon</th>
                                        <th>Cinturones de seguridad Pasajeros</th>
                                        <th> Pasamanos interno </th>
                                        <th> Indicador de Velocidad</th>
                                        <th> Ventanería</th>
                                        <th> Cinturones de seguridad Conductor</th>
                                        <th>Nivel de Refrigerante</th>
                                        <th>Nivel de Combustible</th>
                                        <th>Baterías</th>
                                        <th>Freno principal</th>
                                        <th>Líquido Hidráulico</th>
                                        <th>Sistema Hidráulico</th>
                                        <th>Estado de correas
                                        <th>Nivel líquido de Frenos</th>
                                        <th>Caja de Cambios</th>
                                        <th>Dirección</th>
                                        <th>Nivel de Aceite</th>
                                        <th>Freno de Emergencia</th>
                                        <th>Velocímetro</th>
                                        <th>Carga de la Batería</th>
                                        <th> Presión de Aceite</th>
                                        <th>Combustible</th>
                                        <th>Presión de Aire</th>
                                        <th>Temperatura</th>
                                        <th>Cambio de Aceite</th>
                                        <th>Engrase</th>
                                        <th>Rotación de Llantas</th>
                                        <th>Filtro de Aire</th>
                                        <th>Sincronización</th>
                                        <th>Alineacion y Balaneceo</th>
                                        <th>Delanteras</th>
                                        <th>Traseras</th>
                                        <th>Cortes</th>
                                        <th>Espárragos</th>
                                        <th>Profundidad de huella 2mm</th>
                                        <th>Llanta de Repuesto</th>
                                        <th>Presión de Inflado</th>
                                        <th>Abultamientos</th>
                                        <th>Chaleco reflectivo</th>
                                        <th>Linterna</th>
                                        <th>Conos 2 o Triángulos</th>
                                        <th>Tacos de Bloques</th>
                                        <th>Gato</th>
                                        <th>Cruceta o Copa</th>
                                        <th>Alicate</th>
                                        <th>Destornilladores</th>
                                        <th>Llaves fijas</th>
                                        <th>Botiquín</th>
                                        <th>Llave de Expansión</th>
                                        <th>Extintor</th>
                                        <th>Kilometraje total</th>
                                        <th>Observaciones</th>
                                    </tr>

                                </thead>


                                <tbody id="tbodyAlistamientos" class="text-sm">
                                    <?php foreach ($Alistamientos as $key => $value) : ?>
                                        <tr>
                                            <td>
                                                <button type="button" class="btn btn-success btn-sm btn-editarAlistamiento" idalistamiento="<?= $value['id'] ?>" placa="<?= $value['placa'] ?>" data-toggle="modal" data-target="#modal-nuevoAlistamiento"><i class="fas fa-edit"></i></button>
                                            </td>
                                            <td><?= $value['id'] ?></td>
                                            <td><?= $value['fechaalista'] ?></td>
                                            <td><?= $value['placa'] ?></td>
                                            <td><?= $value['numinterno'] ?></td>
                                            <td><?= $value['conductor'] ?></td>
                                            <td><?= $value['cedulaConductor'] ?></td>
                                            <td><?= ControladorAlistamiento::FTraducirEstado($value['lucesbajas']) ?></td>
                                            <td><?= ControladorAlistamiento::FTraducirEstado($value['lucesaltas']) ?></td>
                                            <td><?= ControladorAlistamiento::FTraducirEstado($value['lucesreversa']) ?></td>
                                            <td><?= ControladorAlistamiento::FTraducirEstado($value['direccionales_delanteras']) ?></td>
                                            <td><?= ControladorAlistamiento::FTraducirEstado($value['iluminacioncabina']) ?>
                                            </td>
                                            <td><?= ControladorAlistamiento::FTraducirEstado($value['lucesinternas']) ?>
                                            </td>
                                            <td><?= ControladorAlistamiento::FTraducirEstado($value['lucesmedias']) ?>
                                            </td>
                                            <td><?= ControladorAlistamiento::FTraducirEstado($value['lucesdestop']) ?>
                                            </td>
                                            <td><?= ControladorAlistamiento::FTraducirEstado($value['lucesdeparqueo']) ?>
                                            </td>
                                            <td><?= ControladorAlistamiento::FTraducirEstado($value['direccionales_traseras']) ?>
                                            </td>
                                            <td><?= ControladorAlistamiento::FTraducirEstado($value['luzescala']) ?>
                                            </td>
                                            <td><?= ControladorAlistamiento::FTraducirEstado($value['baliza_licuadora']) ?>
                                            </td>
                                            <td><?= ControladorAlistamiento::FTraducirEstado($value['retrovisor_izquierdo']) ?>
                                            </td>
                                            <td><?= ControladorAlistamiento::FTraducirEstado($value['espejointerno']) ?>
                                            </td>
                                            <td><?= ControladorAlistamiento::FTraducirEstado($value['apoyacabeza_conductor']) ?>
                                            </td>
                                            <td><?= ControladorAlistamiento::FTraducirEstado($value['equipoaudio']) ?>
                                            </td>
                                            <td><?= ControladorAlistamiento::FTraducirEstado($value['claraboya']) ?>
                                            </td>
                                            <td><?= ControladorAlistamiento::FTraducirEstado($value['alarmareversa']) ?>
                                            </td>
                                            <td><?= ControladorAlistamiento::FTraducirEstado($value['parabrisas']) ?>
                                            </td>
                                            <td><?= ControladorAlistamiento::FTraducirEstado($value['retrovisor_derecho']) ?>
                                            </td>
                                            <td><?= ControladorAlistamiento::FTraducirEstado($value['retrovisor_izquierdo']) ?>
                                            </td>
                                            <td><?= ControladorAlistamiento::FTraducirEstado($value['placas']) ?>
                                            </td>
                                            <td><?= ControladorAlistamiento::FTraducirEstado($value['limpiaparabrisas_derecho']) ?>
                                            </td>
                                            <td><?= ControladorAlistamiento::FTraducirEstado($value['limpiaparabrisas_izquierdo']) ?>
                                            </td>
                                            <td><?= ControladorAlistamiento::FTraducirEstado($value['piso']) ?>
                                            </td>
                                            <td><?= ControladorAlistamiento::FTraducirEstado($value['sillas']) ?>
                                            </td>
                                            <td><?= ControladorAlistamiento::FTraducirEstado($value['antideslizante_escaleras']) ?>
                                            </td>
                                            <td><?= ControladorAlistamiento::FTraducirEstado($value['puertas']) ?>
                                            </td>
                                            <td><?= ControladorAlistamiento::FTraducirEstado($value['bomper_trasero']) ?>
                                            </td>
                                            <td><?= ControladorAlistamiento::FTraducirEstado($value['bomper_delantero']) ?>
                                            </td>
                                            <td><?= ControladorAlistamiento::FTraducirEstado($value['claxon']) ?>
                                            </td>
                                            <td><?= ControladorAlistamiento::FTraducirEstado($value['cinturones_pasajero']) ?>
                                            </td>
                                            <td><?= ControladorAlistamiento::FTraducirEstado($value['pasamanos_interno']) ?>
                                            </td>
                                            <td><?= ControladorAlistamiento::FTraducirEstado($value['indicador_velocidad']) ?>
                                            </td>
                                            <td><?= ControladorAlistamiento::FTraducirEstado($value['ventaneria']) ?>
                                            </td>
                                            <td><?= ControladorAlistamiento::FTraducirEstado($value['cinturones_conductor']) ?>
                                            </td>
                                            <td><?= ControladorAlistamiento::FTraducirEstado($value['nivel_refrigerante']) ?>
                                            </td>
                                            </td>
                                            <td><?= ControladorAlistamiento::FTraducirEstado($value['nivel_combustible']) ?>
                                            </td>
                                            </td>
                                            <td><?= ControladorAlistamiento::FTraducirEstado($value['baterias']) ?>
                                            </td>
                                            </td>
                                            <td><?= ControladorAlistamiento::FTraducirEstado($value['freno_principal']) ?>
                                            </td>
                                            </td>
                                            <td><?= ControladorAlistamiento::FTraducirEstado($value['liquido_hidraulico']) ?>
                                            </td>
                                            <td><?= ControladorAlistamiento::FTraducirEstado($value['sistema_hidraulico']) ?>
                                            </td>
                                            </td>
                                            <td><?= ControladorAlistamiento::FTraducirEstado($value['estado_correas']) ?>
                                            </td>
                                            </td>
                                            <td><?= ControladorAlistamiento::FTraducirEstado($value['nivel_liquido_frenos']) ?>
                                            </td>
                                            </td>
                                            <td><?= ControladorAlistamiento::FTraducirEstado($value['caja_cambios']) ?>
                                            </td>
                                            </td>
                                            <td><?= ControladorAlistamiento::FTraducirEstado($value['direccion']) ?>
                                            </td>
                                            </td>
                                            <td><?= ControladorAlistamiento::FTraducirEstado($value['nivel_aceite']) ?>
                                            </td>
                                            </td>
                                            <td><?= ControladorAlistamiento::FTraducirEstado($value['freno_emergencia']) ?>
                                            </td>
                                            </td>
                                            <td><?= ControladorAlistamiento::FTraducirEstado($value['velocimetro']) ?>
                                            </td>
                                            </td>
                                            <td><?= ControladorAlistamiento::FTraducirEstado($value['carga_bateria']) ?>
                                            </td>
                                            </td>
                                            <td><?= ControladorAlistamiento::FTraducirEstado($value['presion_aceite']) ?>
                                            </td>
                                            </td>
                                            <td><?= ControladorAlistamiento::FTraducirEstado($value['combustible']) ?>
                                            </td>
                                            </td>
                                            <td><?= ControladorAlistamiento::FTraducirEstado($value['presion_aire']) ?>
                                            </td>
                                            </td>
                                            <td><?= ControladorAlistamiento::FTraducirEstado($value['temperatura']) ?>
                                            </td>
                                            <td><?= $value['cambio_aceite'] ?>
                                            </td>
                                            <td><?= $value['engrase'] ?>
                                            </td>
                                            <td><?= $value['rotacion_llantas'] ?>
                                            </td>
                                            <td><?= $value['filtro_aire'] ?>
                                            </td>
                                            <td><?= $value['sincronizacion'] ?>
                                            </td>
                                            <td><?= $value['alineacion_balanceo'] ?>
                                            </td>
                                            <td><?= ControladorAlistamiento::FTraducirEstado($value['llantas_delanteras']) ?>
                                            </td>
                                            <td><?= ControladorAlistamiento::FTraducirEstado($value['llantas_traseras']) ?>
                                            </td>
                                            <td><?= ControladorAlistamiento::FTraducirEstado($value['cortes']) ?>
                                            </td>
                                            <td><?= ControladorAlistamiento::FTraducirEstado($value['esparragos']) ?>
                                            </td>
                                            <td><?= ControladorAlistamiento::FTraducirEstado($value['profundidad_huella']) ?>
                                            </td>
                                            <td><?= ControladorAlistamiento::FTraducirEstado($value['llanta_repuesto']) ?>
                                            </td>
                                            <td><?= ControladorAlistamiento::FTraducirEstado($value['presion_inflado']) ?>
                                            </td>
                                            <td><?= ControladorAlistamiento::FTraducirEstado($value['abultamientos']) ?>
                                            </td>
                                            <td><?= ControladorAlistamiento::FTraducirEstado($value['chalecoreflectivo']) ?>
                                            </td>
                                            <td><?= ControladorAlistamiento::FTraducirEstado($value['linterna']) ?>
                                            </td>
                                            <td><?= ControladorAlistamiento::FTraducirEstado($value['conos_triangulos']) ?>
                                            </td>
                                            <td><?= ControladorAlistamiento::FTraducirEstado($value['tacos_bloques']) ?>
                                            </td>
                                            <td><?= ControladorAlistamiento::FTraducirEstado($value['gato']) ?>
                                            </td>
                                            <td><?= ControladorAlistamiento::FTraducirEstado($value['cruceta_copa']) ?>
                                            </td>
                                            <td><?= ControladorAlistamiento::FTraducirEstado($value['alicate']) ?>
                                            </td>
                                            <td><?= ControladorAlistamiento::FTraducirEstado($value['destornilladores']) ?>
                                            </td>
                                            <td><?= ControladorAlistamiento::FTraducirEstado($value['llavesfijas']) ?>
                                            </td>
                                            <td><?= ControladorAlistamiento::FTraducirEstado($value['botiquin']) ?>
                                            </td>
                                            <td><?= ControladorAlistamiento::FTraducirEstado($value['llave_expansion']) ?>
                                            </td>
                                            <td><?= ControladorAlistamiento::FTraducirEstado($value['extintor']) ?>
                                            </td>
                                            <td><?= ControladorAlistamiento::FTraducirEstado($value['kilometraje_total']) ?>
                                            </td>
                                            <td><?= ControladorAlistamiento::FTraducirEstado($value['observaciones']) ?>
                                            </td>



                                        </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- ==============================
  MODAL DE INGRESO NUEVO VEHICULO
 ============================== -->
<div class="modal fade show" id="modal-nuevoAlistamiento" style="display: none; padding-right: 17px;" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h4 class="modal-title">Ingreso - Vehículo <span id="TituloModal"></span></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <div class="modal-body">

                <div class="card card-secondary card-tabs">
                    <div class="card-header p-0 pt-1">
                        <ul class="nav nav-tabs" id="custom-tabs-two-tab" role="tablist">

                            <li class="nav-item">
                                <a class="nav-link active" id="datos_vehiculos" data-toggle="pill" href="#custom-tabs-two-home" role="tab" aria-controls="custom-tabs-two-home" aria-selected="true"><u>Vehículo Documentos</u></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-two-sistemaluces-tab" data-toggle="pill" href="#custom-tabs-two-sistemaluces" role="tab" aria-controls="custom-tabs-two-sistemaluces" aria-selected="false"><u>Sistema Luces</u></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-two-carroceria-tab" data-toggle="pill" href="#custom-tabs-two-carroceria" role="tab" aria-controls="custom-tabs-two-carroceria" aria-selected="false"><u>Carrocería</u></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-two-sistemas-tab" data-toggle="pill" href="#custom-tabs-two-sistemas" role="tab" aria-controls="custom-tabs-two-sistemas" aria-selected="false"><u>Sistemas</u></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-two-indicadorestableros-tab" data-toggle="pill" href="#custom-tabs-two-indicadorestableros" role="tab" aria-controls="custom-tabs-two-indicadorestableros" aria-selected="false"><u>Indicadores Tablero</u></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-two-mantenimiento-tab" data-toggle="pill" href="#custom-tabs-two-mantenimiento" role="tab" aria-controls="custom-tabs-two-mantenimiento" aria-selected="false"><u>Mantenimiento</u></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-two-llantas-tab" data-toggle="pill" href="#custom-tabs-two-llantas" role="tab" aria-controls="custom-tabs-two-llantas" aria-selected="false"><u>Llantas</u></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-two-equiposeguridad-tab" data-toggle="pill" href="#custom-tabs-two-equiposeguridad" role="tab" aria-controls="custom-tabs-two-equiposeguridad" aria-selected="false"><u>Equipo de Seguridad</u></a>
                            </li>
                        </ul>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <!-- ===================================================
                                    FORMULARIO
                                =================================================== -->
                            <div class="col-12">
                                <form id="alistamiento_form" method="post" enctype="multipart/form-data">
                                    <div class="tab-content" id="custom-tabs-two-tabContent">
                                        <!-- ===================================================
                                        TAB VEHICULO / DOCUMENTOS
                                        =================================================== -->
                                        <div class="tab-pane fade show active" id="custom-tabs-two-home" role="tabpanel" aria-labelledby="custom-tabs-two-home-tab">
                                            <div class="row">
                                                <input type="hidden" id="idalistamiento" name="id" value="">
                                                <input type="hidden" id="observador_conductoresAlistamiento" idconductor="">

                                                <div class="col-12 col-sm-6 col-lg-4">
                                                    <div class="form-group">
                                                        <label>ID</label>
                                                        <input id="idvehiculo" name="idvehiculo" type="text" class="form-control datosVehiculo" readonly>
                                                    </div>
                                                </div>

                                                <div class="col-12 col-sm-6 col-lg-4">
                                                    <div class="form-group">
                                                        <label>Placa</label>
                                                        <select id="placa" name="placa" class="form-control select2-single" type="number" style="width: 99%" required>
                                                            <option value="" selected>-Seleccione un vehículo</option>
                                                            <?php foreach ($Vehiculos as $key => $value) : ?>
                                                                <option value="<?= $value['placa'] ?>"><?= $value['placa'] ?> - <?= $value['numinterno'] ?></option>
                                                            <?php endforeach ?>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-12 col-sm-6 col-lg-4">
                                                    <div class="form-group">
                                                        <label># Interno de Afiliado</label>
                                                        <input id="numinterno" type="text" class="form-control datosVehiculo" placeholder="Numero de afiliado" readonly>
                                                    </div>
                                                </div>

                                                <div class="col-12 col-sm-6 col-lg-4">
                                                    <div class="form-group">
                                                        <label>Marca</label>
                                                        <input id="marca" type="text" class="form-control datosVehiculo" placeholder="Digite marca del vehículo" readonly>
                                                    </div>
                                                </div>

                                                <div class="col-12 col-sm-6 col-lg-4">
                                                    <div class="form-group">
                                                        <label>Modelo</label>
                                                        <input id="modelo" type="text" class="form-control datosVehiculo" placeholder="Año modelo del vehículo" readonly>
                                                    </div>
                                                </div>

                                                <div class="col-12 col-sm-6 col-lg-4">
                                                    <div class="form-group">
                                                        <label>Sucursal</label>
                                                        <input id="sucursal" type="text" class="form-control datosVehiculo" placeholder="Digite la sucursal" readonly>
                                                    </div>
                                                </div>

                                                <div class="col-12 col-sm-6 col-lg-4">
                                                    <div class="form-group">
                                                        <label>Conductor</label>
                                                        <select id="idconductor" class="form-control datosVehiculo" name="idconductor" required>
                                                            <option value=""></option>
                                                        </select>
                                                        <div class="overlay overlay-conductores d-none">
                                                            <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                                                        </div>
                                                    </div>
                                                </div>

                                                <?php foreach ($tiposDocumentacion as $key => $value) : ?>
                                                    <div class="col-12 col-sm-6 col-lg-4">
                                                        <div class="form-group">
                                                            <label><?= $value['tipodocumento'] ?></label>
                                                            <input id="documento_<?= $value['idtipo'] ?>" type="date" class="form-control documentos" readonly>
                                                        </div>
                                                    </div>
                                                <?php endforeach ?>

                                            </div>
                                        </div>

                                        <!--|||TAB SISTEMA DE LUCES|||-->
                                        <div class="tab-pane fade" id="custom-tabs-two-sistemaluces" role="tabpanel" aria-labelledby="custom-tabs-two-sistemaluces-tab">
                                            <div class="table-responsive">
                                                <table class="table table-bordered text-center border-danger" nombre="Sistema Luces">
                                                    <thead class="text-nowrap">
                                                        <tr>
                                                            <th>Luces bajas</th>
                                                            <th>Luces altas</th>
                                                            <th>Luces de reversa</th>
                                                            <th>Direccionales delanteras</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody class="text-nowrap">
                                                        <tr>
                                                            <td>
                                                                <div class="form-group clearfix">
                                                                    <div class="icheck-success d-inline">
                                                                        <input type="radio" id="radiolucesbajas1" name="lucesbajas" value="1" required>
                                                                        <label for="radiolucesbajas1">
                                                                            <i class="fas fa-thumbs-up"></i>
                                                                        </label>
                                                                    </div>

                                                                    <div class="icheck-danger d-inline">
                                                                        <input type="radio" id="radiolucesbajas2" name="lucesbajas" value="0" required>
                                                                        <label for="radiolucesbajas2">
                                                                            <i class="fas fa-thumbs-down"></i>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </td>

                                                            <td>
                                                                <div class="form-group clearfix">
                                                                    <div class="icheck-success d-inline">
                                                                        <input type="radio" id="radiolucesaltas1" name="lucesaltas" value="1" required>
                                                                        <label for="radiolucesaltas1">
                                                                            <i class="fas fa-thumbs-up"></i>
                                                                        </label>
                                                                    </div>

                                                                    <div class="icheck-danger d-inline">
                                                                        <input type="radio" id="radiolucesaltas2" name="lucesaltas" value="0" required>
                                                                        <label for="radiolucesaltas2">
                                                                            <i class="fas fa-thumbs-down"></i>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </td>

                                                            <td>
                                                                <div class="form-group clearfix">
                                                                    <div class="icheck-success d-inline">
                                                                        <input type="radio" id="radiolucesreversa1" name="lucesreversa" value="1" required>
                                                                        <label for="radiolucesreversa1">
                                                                            <i class="fas fa-thumbs-up"></i>
                                                                        </label>
                                                                    </div>

                                                                    <div class="icheck-danger d-inline">
                                                                        <input type="radio" id="radiolucesreversa2" name="lucesreversa" value="0" required>
                                                                        <label for="radiolucesreversa2">
                                                                            <i class="fas fa-thumbs-down"></i>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </td>

                                                            <td>
                                                                <div class="form-group clearfix">
                                                                    <div class="icheck-success d-inline">
                                                                        <input type="radio" id="radiodiredelanteras1" name="direccionales_delanteras" value="1" required>
                                                                        <label for="radiodiredelanteras1">
                                                                            <i class="fas fa-thumbs-up"></i>
                                                                        </label>
                                                                    </div>

                                                                    <div class="icheck-danger d-inline">
                                                                        <input type="radio" id="radiodiredelanteras2" name="direccionales_delanteras" value="0" required>
                                                                        <label for="radiodiredelanteras2">
                                                                            <i class="fas fa-thumbs-down"></i>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>

                                                        <tr class="font-weight-bold">
                                                            <td>Iluminación cabina</td>
                                                            <td>Luces internas</td>
                                                            <td>Luces medias</td>
                                                            <td>Luces de Stop</td>
                                                        </tr>

                                                        <tr>
                                                            <td>
                                                                <div class="form-group clearfix">
                                                                    <div class="icheck-success d-inline">
                                                                        <input type="radio" id="iluminacioncabina1" name="iluminacioncabina" value="1" required>
                                                                        <label for="iluminacioncabina1">
                                                                            <i class="fas fa-thumbs-up"></i>
                                                                        </label>
                                                                    </div>

                                                                    <div class="icheck-danger d-inline">
                                                                        <input type="radio" id="iluminacioncabina2" name="iluminacioncabina" value="0" required>
                                                                        <label for="iluminacioncabina2">
                                                                            <i class="fas fa-thumbs-down"></i>
                                                                        </label>
                                                                    </div>

                                                                    <div class="icheck-danger d-inline">
                                                                        <input type="radio" id="iluminacioncabina3" name="iluminacioncabina" value="2" required>
                                                                        <label for="iluminacioncabina3">
                                                                            <i class="fas fa-ban"></i>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group clearfix">
                                                                    <div class="icheck-success d-inline">
                                                                        <input type="radio" id="radiolucesinternas1" name="lucesinternas" value="1" required>
                                                                        <label for="radiolucesinternas1">
                                                                            <i class="fas fa-thumbs-up"></i>
                                                                        </label>
                                                                    </div>

                                                                    <div class="icheck-danger d-inline">
                                                                        <input type="radio" id="radiolucesinternas2" name="lucesinternas" value="0" required>
                                                                        <label for="radiolucesinternas2">
                                                                            <i class="fas fa-thumbs-down"></i>
                                                                        </label>
                                                                    </div>

                                                                    <div class="icheck-warning d-inline">
                                                                        <input type="radio" id="radiolucesinternas3" name="lucesinternas" value="2" required>
                                                                        <label for="radiolucesinternas3">
                                                                            <i class="fas fa-ban"></i>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group clearfix">
                                                                    <div class="icheck-success d-inline">
                                                                        <input type="radio" id="radiolucesmedias1" name="lucesmedias" value="1" required>
                                                                        <label for="radiolucesmedias1">
                                                                            <i class="fas fa-thumbs-up"></i>
                                                                        </label>
                                                                    </div>

                                                                    <div class="icheck-danger d-inline">
                                                                        <input type="radio" id="radiolucesmedias2" name="lucesmedias" value="0" required>
                                                                        <label for="radiolucesmedias2">
                                                                            <i class="fas fa-thumbs-down"></i>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group clearfix">
                                                                    <div class="icheck-success d-inline">
                                                                        <input type="radio" id="radiolucesstop1" name="lucesdestop" value="1" required>
                                                                        <label for="radiolucesstop1">
                                                                            <i class="fas fa-thumbs-up"></i>
                                                                        </label>
                                                                    </div>

                                                                    <div class="icheck-danger d-inline">
                                                                        <input type="radio" id="radiolucesstop2" name="lucesdestop" value="0" required>
                                                                        <label for="radiolucesstop2">
                                                                            <i class="fas fa-thumbs-down"></i>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <td><b>Luces de Parqueo</b></td>
                                                            <td><b>Direccionales traseras</b></td>
                                                            <td><b>Luz escala</b></td>
                                                            <td><b>Baliza / Licuadora</b></td>
                                                        </tr>

                                                        <tr>
                                                            <td>
                                                                <div class="form-group clearfix">
                                                                    <div class="icheck-success d-inline">
                                                                        <input type="radio" id="radiolucesparqueo1" name="lucesdeparqueo" value="1" required>
                                                                        <label for="radiolucesparqueo1">
                                                                            <i class="fas fa-thumbs-up"></i>
                                                                        </label>
                                                                    </div>

                                                                    <div class="icheck-danger d-inline">
                                                                        <input type="radio" id="radiolucesparqueo2" name="lucesdeparqueo" value="0" required>
                                                                        <label for="radiolucesparqueo2">
                                                                            <i class="fas fa-thumbs-down"></i>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group clearfix">
                                                                    <div class="icheck-success d-inline">
                                                                        <input type="radio" id="radiodireccionalestraseras1" name="direccionales_traseras" value="1" required>
                                                                        <label for="radiodireccionalestraseras1">
                                                                            <i class="fas fa-thumbs-up"></i>
                                                                        </label>
                                                                    </div>

                                                                    <div class="icheck-danger d-inline">
                                                                        <input type="radio" id="radiodireccionalestraseras2" name="direccionales_traseras" value="0" required>
                                                                        <label for="radiodireccionalestraseras2">
                                                                            <i class="fas fa-thumbs-down"></i>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group clearfix">
                                                                    <div class="icheck-success d-inline">
                                                                        <input type="radio" id="radioluzescala1" name="luzescala" value="1" required>
                                                                        <label for="radioluzescala1">
                                                                            <i class="fas fa-thumbs-up"></i>
                                                                        </label>
                                                                    </div>

                                                                    <div class="icheck-danger d-inline">
                                                                        <input type="radio" id="radioluzescala2" name="luzescala" value="0" required>
                                                                        <label for="radioluzescala2">
                                                                            <i class="fas fa-thumbs-down"></i>
                                                                        </label>
                                                                    </div>

                                                                    <div class="icheck-warning d-inline">
                                                                        <input type="radio" id="radioluzescala3" name="luzescala" value="2" required>
                                                                        <label for="radioluzescala3">
                                                                            <i class="fas fa-ban"></i>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group clearfix">
                                                                    <div class="icheck-success d-inline">
                                                                        <input type="radio" id="radiolicuadora1" name="baliza_licuadora" value="1" required>
                                                                        <label for="radiolicuadora1">
                                                                            <i class="fas fa-thumbs-up"></i>
                                                                        </label>
                                                                    </div>

                                                                    <div class="icheck-danger d-inline">
                                                                        <input type="radio" id="radiolicuadora2" name="baliza_licuadora" value="0" required>
                                                                        <label for="radiolicuadora2">
                                                                            <i class="fas fa-thumbs-down"></i>
                                                                        </label>
                                                                    </div>

                                                                    <div class="icheck-warning d-inline">
                                                                        <input type="radio" id="radiolicuadora3" name="baliza_licuadora" value="2" required>
                                                                        <label for="radiolicuadora3">
                                                                            <i class="fas fa-ban"></i>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                        <!--|||TAB CARROCERIA|||-->
                                        <div class="tab-pane fade" id="custom-tabs-two-carroceria" role="tabpanel" aria-labelledby="custom-tabs-two-carroceria-tab">
                                            <div class="table table-responsive">
                                                <table class="table table-bordered text-center" nombre="Carrocería">
                                                    <thead class="text-nowrap">
                                                        <tr>
                                                            <th style="width: px">Retrovisores izquierdo</th>
                                                            <th style="width: px">Espejo interno</th>
                                                            <th style="width: px">Apoya cabeza - Conductor</th>
                                                            <th style="width: px">Equipo de Audio</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody class="text-nowrap">
                                                        <tr>
                                                            <td>
                                                                <div class="form-group clearfix">
                                                                    <div class="icheck-success d-inline">
                                                                        <input type="radio" id="radioretroizq1" name="retrovisor_izquierdo" value="1" required>
                                                                        <label for="radioretroizq1">
                                                                            <i class="fas fa-thumbs-up"></i>
                                                                        </label>
                                                                    </div>

                                                                    <div class="icheck-danger d-inline">
                                                                        <input type="radio" id="radioretroizq2" name="retrovisor_izquierdo" value="0" required>
                                                                        <label for="radioretroizq2">
                                                                            <i class="fas fa-thumbs-down"></i>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group clearfix">
                                                                    <div class="icheck-success d-inline">
                                                                        <input type="radio" id="radioespint1" name="espejointerno" value="1" required>
                                                                        <label for="radioespint1">
                                                                            <i class="fas fa-thumbs-up"></i>
                                                                        </label>
                                                                    </div>

                                                                    <div class="icheck-danger d-inline">
                                                                        <input type="radio" id="radioespint2" name="espejointerno" value="0" required>
                                                                        <label for="radioespint2">
                                                                            <i class="fas fa-thumbs-down"></i>
                                                                        </label>
                                                                    </div>

                                                                    <div class="icheck-warning d-inline">
                                                                        <input type="radio" id="radioespint3" name="espejointerno" value="2" required>
                                                                        <label for="radioespint3">
                                                                            <i class="fas fa-ban"></i>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group clearfix">
                                                                    <div class="icheck-success d-inline">
                                                                        <input type="radio" id="radioapocondu1" name="apoyacabeza_conductor" value="1" required>
                                                                        <label for="radioapocondu1">
                                                                            <i class="fas fa-thumbs-up"></i>
                                                                        </label>
                                                                    </div>

                                                                    <div class="icheck-danger d-inline">
                                                                        <input type="radio" id="radioapocondu2" name="apoyacabeza_conductor" value="0" required>
                                                                        <label for="radioapocondu2">
                                                                            <i class="fas fa-thumbs-down"></i>
                                                                        </label>
                                                                    </div>

                                                                    <div class="icheck-warning d-inline">
                                                                        <input type="radio" id="radioapocondu3" name="apoyacabeza_conductor" value="2" required>
                                                                        <label for="radioapocondu3">
                                                                            <i class="fas fa-ban"></i>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group clearfix">
                                                                    <div class="icheck-success d-inline">
                                                                        <input type="radio" id="radioaudio1" name="equipoaudio" value="1" required>
                                                                        <label for="radioaudio1">
                                                                            <i class="fas fa-thumbs-up"></i>
                                                                        </label>
                                                                    </div>

                                                                    <div class="icheck-danger d-inline">
                                                                        <input type="radio" id="radioaudio2" name="equipoaudio" value="0" required>
                                                                        <label for="radioaudio2">
                                                                            <i class="fas fa-thumbs-down"></i>
                                                                        </label>
                                                                    </div>

                                                                    <div class="icheck-warning d-inline">
                                                                        <input type="radio" id="radioaudio3" name="equipoaudio" value="2" required>
                                                                        <label for="radioaudio3">
                                                                            <i class="fas fa-ban"></i>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <td><b>Claraboyas</b></td>
                                                            <td><b>Alarma de Retroceso</b></td>
                                                            <td><b>Parabrisas</b></td>
                                                            <td><b>Retrovisor derecho</b></td>
                                                        </tr>

                                                        <tr>
                                                            <td>
                                                                <div class="form-group clearfix">
                                                                    <div class="icheck-success d-inline">
                                                                        <input type="radio" id="radioclaraboya1" name="claraboya" value="1" required>
                                                                        <label for="radioclaraboya1">
                                                                            <i class="fas fa-thumbs-up"></i>
                                                                        </label>
                                                                    </div>

                                                                    <div class="icheck-danger d-inline">
                                                                        <input type="radio" id="radioclaraboya2" name="claraboya" value="0" required>
                                                                        <label for="radioclaraboya2">
                                                                            <i class="fas fa-thumbs-down"></i>
                                                                        </label>
                                                                    </div>

                                                                    <div class="icheck-warning d-inline">
                                                                        <input type="radio" id="radioclaraboya3" name="claraboya" value="2" required>
                                                                        <label for="radioclaraboya3">
                                                                            <i class="fas fa-ban"></i>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group clearfix">
                                                                    <div class="icheck-success d-inline">
                                                                        <input type="radio" id="radioretro1" name="alarmareversa" value="1" required>
                                                                        <label for="radioretro1">
                                                                            <i class="fas fa-thumbs-up"></i>
                                                                        </label>
                                                                    </div>

                                                                    <div class="icheck-danger d-inline">
                                                                        <input type="radio" id="radioretro2" name="alarmareversa" value="0" required>
                                                                        <label for="radioretro2">
                                                                            <i class="fas fa-thumbs-down"></i>
                                                                        </label>
                                                                    </div>

                                                                    <div class="icheck-warning d-inline">
                                                                        <input type="radio" id="radioretro3" name="alarmareversa" value="2" required>
                                                                        <label for="radioretro3">
                                                                            <i class="fas fa-ban"></i>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group clearfix">
                                                                    <div class="icheck-success d-inline">
                                                                        <input type="radio" id="radioparabirsas1" name="parabrisas" value="1" required>
                                                                        <label for="radioparabirsas1">
                                                                            <i class="fas fa-thumbs-up"></i>
                                                                        </label>
                                                                    </div>

                                                                    <div class="icheck-danger d-inline">
                                                                        <input type="radio" id="radioparabirsas2" name="parabrisas" value="0" required>
                                                                        <label for="radioparabirsas2">
                                                                            <i class="fas fa-thumbs-down"></i>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group clearfix">
                                                                    <div class="icheck-success d-inline">
                                                                        <input type="radio" id="radioretroder1" name="retrovisor_derecho" value="1" required>
                                                                        <label for="radioretroder1">
                                                                            <i class="fas fa-thumbs-up"></i>
                                                                        </label>
                                                                    </div>

                                                                    <div class="icheck-danger d-inline">
                                                                        <input type="radio" id="radioretroder2" name="retrovisor_derecho" value="0" required>
                                                                        <label for="radioretroder2">
                                                                            <i class="fas fa-thumbs-down"></i>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <td><b>Apoya cabeza Pasajero</b></td>
                                                            <td><b>Placas</b></td>
                                                            <td><b>Limpia parabrisas Derecho</b></td>
                                                            <td><b>Limpia parabrizas Izquierdo</b></td>
                                                        </tr>

                                                        <tr>
                                                            <td>
                                                                <div class="form-group clearfix">
                                                                    <div class="icheck-success d-inline">
                                                                        <input type="radio" id="radioapoyapasa1" name="apoyacabeza_pasajero" value="1" required>
                                                                        <label for="radioapoyapasa1">
                                                                            <i class="fas fa-thumbs-up"></i>
                                                                        </label>
                                                                    </div>

                                                                    <div class="icheck-danger d-inline">
                                                                        <input type="radio" id="radioapoyapasa2" name="apoyacabeza_pasajero" value="0" required>
                                                                        <label for="radioapoyapasa2">
                                                                            <i class="fas fa-thumbs-down"></i>
                                                                        </label>
                                                                    </div>

                                                                    <div class="icheck-warning d-inline">
                                                                        <input type="radio" id="radioapoyapasa3" name="apoyacabeza_pasajero" value="2" required>
                                                                        <label for="radioapoyapasa3">
                                                                            <i class="fas fa-ban"></i>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </td>

                                                            <td>
                                                                <div class="form-group clearfix">
                                                                    <div class="icheck-success d-inline">
                                                                        <input type="radio" id="radioplacas1" name="placas" value="1" required>
                                                                        <label for="radioplacas1">
                                                                            <i class="fas fa-thumbs-up"></i>
                                                                        </label>
                                                                    </div>

                                                                    <div class="icheck-danger d-inline">
                                                                        <input type="radio" id="radioplacas2" name="placas" value="0" required>
                                                                        <label for="radioplacas2">
                                                                            <i class="fas fa-thumbs-down"></i>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </td>

                                                            <td>
                                                                <div class="form-group clearfix">
                                                                    <div class="icheck-success d-inline">
                                                                        <input type="radio" id="radiolimpder1" name="limpiaparabrisas_derecho" value="1" required>
                                                                        <label for="radiolimpder1">
                                                                            <i class="fas fa-thumbs-up"></i>
                                                                        </label>
                                                                    </div>

                                                                    <div class="icheck-danger d-inline">
                                                                        <input type="radio" id="radiolimpder2" name="limpiaparabrisas_derecho" value="0" required>
                                                                        <label for="radiolimpder2">
                                                                            <i class="fas fa-thumbs-down"></i>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group clearfix">
                                                                    <div class="icheck-success d-inline">
                                                                        <input type="radio" id="radiolimpizq1" name="limpiaparabrisas_izquierdo" value="1" required>
                                                                        <label for="radiolimpizq1">
                                                                            <i class="fas fa-thumbs-up"></i>
                                                                        </label>
                                                                    </div>

                                                                    <div class="icheck-danger d-inline">
                                                                        <input type="radio" id="radiolimpizq2" name="limpiaparabrisas_izquierdo" value="0" required>
                                                                        <label for="radiolimpizq2">
                                                                            <i class="fas fa-thumbs-down"></i>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <td><b>Piso</b></td>
                                                            <td><b>Bomper delantero</b></td>
                                                            <td><b>Cinturones de Seguridad conductor</b></td>
                                                            <td><b>Sillas</b></td>
                                                        </tr>

                                                        <tr>
                                                            <td>
                                                                <div class="form-group clearfix">
                                                                    <div class="icheck-success d-inline">
                                                                        <input type="radio" id="radiopiso1" name="piso" value="1" required>
                                                                        <label for="radiopiso1">
                                                                            <i class="fas fa-thumbs-up"></i>
                                                                        </label>
                                                                    </div>

                                                                    <div class="icheck-danger d-inline">
                                                                        <input type="radio" id="radiopiso2" name="piso" value="0" required>
                                                                        <label for="radiopiso2">
                                                                            <i class="fas fa-thumbs-down"></i>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group clearfix">
                                                                    <div class="icheck-success d-inline">
                                                                        <input type="radio" id="radiobomperdel1" name="bomper_delantero" value="1" required>
                                                                        <label for="radiobomperdel1">
                                                                            <i class="fas fa-thumbs-up"></i>
                                                                        </label>
                                                                    </div>

                                                                    <div class="icheck-danger d-inline">
                                                                        <input type="radio" id="radiobomperdel2" name="bomper_delantero" value="0" required>
                                                                        <label for="radiobomperdel2">
                                                                            <i class="fas fa-thumbs-down"></i>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group clearfix">
                                                                    <div class="icheck-success d-inline">
                                                                        <input type="radio" id="radiosegucondu1" name="cinturones_conductor" value="1" required>
                                                                        <label for="radiosegucondu1">
                                                                            <i class="fas fa-thumbs-up"></i>
                                                                        </label>
                                                                    </div>

                                                                    <div class="icheck-danger d-inline">
                                                                        <input type="radio" id="radiosegucondu2" name="cinturones_conductor" value="0" required>
                                                                        <label for="radiosegucondu2">
                                                                            <i class="fas fa-thumbs-down"></i>
                                                                        </label>
                                                                    </div>

                                                                    <div class="icheck-warning d-inline">
                                                                        <input type="radio" id="radiosegucondu3" name="cinturones_conductor" value="2" required>
                                                                        <label for="radiosegucondu3">
                                                                            <i class="fas fa-ban"></i>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group clearfix">
                                                                    <div class="icheck-success d-inline">
                                                                        <input type="radio" id="radiosillas1" name="sillas" value="1" required>
                                                                        <label for="radiosillas1">
                                                                            <i class="fas fa-thumbs-up"></i>
                                                                        </label>
                                                                    </div>

                                                                    <div class="icheck-danger d-inline">
                                                                        <input type="radio" id="radiosillas2" name="sillas" value="0" required>
                                                                        <label for="radiosillas2">
                                                                            <i class="fas fa-thumbs-down"></i>
                                                                        </label>
                                                                    </div>

                                                                    <div class="icheck-warning d-inline">
                                                                        <input type="radio" id="radiosillas3" name="sillas" value="2" required>
                                                                        <label for="radiosillas3">
                                                                            <i class="fas fa-ban"></i>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <td><b>Antideslizante escaleras</b></td>
                                                            <td><b>Puertas</b></td>
                                                            <td><b>Bomper trasero</b></td>
                                                            <td><b>Claxon</b></td>
                                                        </tr>

                                                        <tr>
                                                            <td>
                                                                <div class="form-group clearfix">
                                                                    <div class="icheck-success d-inline">
                                                                        <input type="radio" id="radioantidesli1" name="antideslizante_escaleras" value="1" required>
                                                                        <label for="radioantidesli1">
                                                                            <i class="fas fa-thumbs-up"></i>
                                                                        </label>
                                                                    </div>

                                                                    <div class="icheck-danger d-inline">
                                                                        <input type="radio" id="radioantidesli2" name="antideslizante_escaleras" value="0" required>
                                                                        <label for="radioantidesli2">
                                                                            <i class="fas fa-thumbs-down"></i>
                                                                        </label>
                                                                    </div>

                                                                    <div class="icheck-warning d-inline">
                                                                        <input type="radio" id="radioantidesli3" name="antideslizante_escaleras" value="2" required>
                                                                        <label for="radioantidesli3">
                                                                            <i class="fas fa-ban"></i>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group clearfix">
                                                                    <div class="icheck-success d-inline">
                                                                        <input type="radio" id="radiopuertas1" name="puertas" value="1" required>
                                                                        <label for="radiopuertas1">
                                                                            <i class="fas fa-thumbs-up"></i>
                                                                        </label>
                                                                    </div>

                                                                    <div class="icheck-danger d-inline">
                                                                        <input type="radio" id="radiopuertas2" name="puertas" value="0" required>
                                                                        <label for="radiopuertas2">
                                                                            <i class="fas fa-thumbs-down"></i>
                                                                        </label>
                                                                    </div>

                                                                    <div class="icheck-warning d-inline">
                                                                        <input type="radio" id="radiopuertas3" name="puertas" value="2" required>
                                                                        <label for="radiopuertas3">
                                                                            <i class="fas fa-ban"></i>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group clearfix">
                                                                    <div class="icheck-success d-inline">
                                                                        <input type="radio" id="radiobompertra1" name="bomper_trasero" value="1" required>
                                                                        <label for="radiobompertra1">
                                                                            <i class="fas fa-thumbs-up"></i>
                                                                        </label>
                                                                    </div>

                                                                    <div class="icheck-danger d-inline">
                                                                        <input type="radio" id="radiobompertra2" name="bomper_trasero" value="0" required>
                                                                        <label for="radiobompertra2">
                                                                            <i class="fas fa-thumbs-down"></i>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group clearfix">
                                                                    <div class="icheck-success d-inline">
                                                                        <input type="radio" id="radioclaxon1" name="claxon" value="1" required>
                                                                        <label for="radioclaxon1">
                                                                            <i class="fas fa-thumbs-up"></i>
                                                                        </label>
                                                                    </div>

                                                                    <div class="icheck-danger d-inline">
                                                                        <input type="radio" id="radioclaxon2" name="claxon" value="0" required>
                                                                        <label for="radioclaxon2">
                                                                            <i class="fas fa-thumbs-down"></i>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <td><b>Cinturones de seguridad Pasajeros</b></td>
                                                            <td><b>Pasamanos interno</b></td>
                                                            <td><b>Indicador de Velocidad</b></td>
                                                            <td><b>Ventanería</b></td>
                                                        </tr>

                                                        <tr>
                                                            <td>
                                                                <div class="form-group clearfix">
                                                                    <div class="icheck-success d-inline">
                                                                        <input type="radio" id="radiocinturonpasaje1" name="cinturones_pasajero" value="1" required>
                                                                        <label for="radiocinturonpasaje1">
                                                                            <i class="fas fa-thumbs-up"></i>
                                                                        </label>
                                                                    </div>

                                                                    <div class="icheck-danger d-inline">
                                                                        <input type="radio" id="radiocinturonpasaje2" name="cinturones_pasajero" value="0" required>
                                                                        <label for="radiocinturonpasaje2">
                                                                            <i class="fas fa-thumbs-down"></i>
                                                                        </label>
                                                                    </div>

                                                                    <div class="icheck-warning d-inline">
                                                                        <input type="radio" id="radiocinturonpasaje3" name="cinturones_pasajero" value="2" required>
                                                                        <label for="radiocinturonpasaje3">
                                                                            <i class="fas fa-ban"></i>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group clearfix">
                                                                    <div class="icheck-success d-inline">
                                                                        <input type="radio" id="radiopasamainter1" name="pasamanos_interno" value="1" required>
                                                                        <label for="radiopasamainter1">
                                                                            <i class="fas fa-thumbs-up"></i>
                                                                        </label>
                                                                    </div>

                                                                    <div class="icheck-danger d-inline">
                                                                        <input type="radio" id="radiopasamainter2" name="pasamanos_interno" value="0" required>
                                                                        <label for="radiopasamainter2">
                                                                            <i class="fas fa-thumbs-down"></i>
                                                                        </label>
                                                                    </div>

                                                                    <div class="icheck-warning d-inline">
                                                                        <input type="radio" id="radiopasamainter3" name="pasamanos_interno" value="2" required>
                                                                        <label for="radiopasamainter3">
                                                                            <i class="fas fa-ban"></i>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group clearfix">
                                                                    <div class="icheck-success d-inline">
                                                                        <input type="radio" id="radioindivelo1" name="indicador_velocidad" value="1" required>
                                                                        <label for="radioindivelo1">
                                                                            <i class="fas fa-thumbs-up"></i>
                                                                        </label>
                                                                    </div>

                                                                    <div class="icheck-danger d-inline">
                                                                        <input type="radio" id="radioindivelo2" name="indicador_velocidad" value="0" required>
                                                                        <label for="radioindivelo2">
                                                                            <i class="fas fa-thumbs-down"></i>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group clearfix">
                                                                    <div class="icheck-success d-inline">
                                                                        <input type="radio" id="radioventaneria1" name="ventaneria" value="1" required>
                                                                        <label for="radioventaneria1">
                                                                            <i class="fas fa-thumbs-up"></i>
                                                                        </label>
                                                                    </div>

                                                                    <div class="icheck-danger d-inline">
                                                                        <input type="radio" id="radioventaneria2" name="ventaneria" value="0" required>
                                                                        <label for="radioventaneria2">
                                                                            <i class="fas fa-thumbs-down"></i>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                        <!--|||TAB SISTEMAS|||-->
                                        <div class="tab-pane fade" id="custom-tabs-two-sistemas" role="tabpanel" aria-labelledby="custom-tabs-two-sistemas-tab">
                                            <div class="table table-responsive">
                                                <table class="table table-bordered text-center" nombre="Sistemas">
                                                    <thead class="text-nowrap">
                                                        <tr>
                                                            <th style="width: 278px">Nivel de Refrigerante</th>
                                                            <th style="width: 278px;">Nivel de Combustible</th>
                                                            <th style="width: 278px;">Baterías</th>
                                                            <th style="width: 278px;">Freno principal</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody class="text-nowrap">
                                                        <tr>
                                                            <td>
                                                                <div class="form-group clearfix">
                                                                    <div class="icheck-success d-inline">
                                                                        <input type="radio" id="radionivrefri1" name="nivel_refrigerante" value="1" required>
                                                                        <label for="radionivrefri1">
                                                                            <i class="fas fa-thumbs-up"></i>
                                                                        </label>
                                                                    </div>

                                                                    <div class="icheck-danger d-inline">
                                                                        <input type="radio" id="radionivrefri2" name="nivel_refrigerante" value="0" required>
                                                                        <label for="radionivrefri2">
                                                                            <i class="fas fa-thumbs-down"></i>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group clearfix">
                                                                    <div class="icheck-success d-inline">
                                                                        <input type="radio" id="radionivcombus1" name="nivel_combustible" value="1" required>
                                                                        <label for="radionivcombus1">
                                                                            <i class="fas fa-thumbs-up"></i>
                                                                        </label>
                                                                    </div>

                                                                    <div class="icheck-danger d-inline">
                                                                        <input type="radio" id="radionivcombus2" name="nivel_combustible" value="0" required>
                                                                        <label for="radionivcombus2">
                                                                            <i class="fas fa-thumbs-down"></i>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group clearfix">
                                                                    <div class="icheck-success d-inline">
                                                                        <input type="radio" id="radiobateria1" name="baterias" value="1" required>
                                                                        <label for="radiobateria1">
                                                                            <i class="fas fa-thumbs-up"></i>
                                                                        </label>
                                                                    </div>

                                                                    <div class="icheck-danger d-inline">
                                                                        <input type="radio" id="radiobateria2" name="baterias" value="0" required>
                                                                        <label for="radiobateria2">
                                                                            <i class="fas fa-thumbs-down"></i>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group clearfix">
                                                                    <div class="icheck-success d-inline">
                                                                        <input type="radio" id="radiofrenoprin1" name="freno_principal" value="1" required>
                                                                        <label for="radiofrenoprin1">
                                                                            <i class="fas fa-thumbs-up"></i>
                                                                        </label>
                                                                    </div>

                                                                    <div class="icheck-danger d-inline">
                                                                        <input type="radio" id="radiofrenoprin2" name="freno_principal" value="0" required>
                                                                        <label for="radiofrenoprin2">
                                                                            <i class="fas fa-thumbs-down"></i>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td><b>Nivel líquido Hidráulico</b></td>
                                                            <td><b>Estado de correas</b></td>
                                                            <td><b>Nivel líquido de Frenos</b></td>
                                                            <td><b>Caja de Cambios</b></td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <div class="form-group clearfix">
                                                                    <div class="icheck-success d-inline">
                                                                        <input type="radio" id="radioliqhidra1" name="liquido_hidraulico" value="1" required>
                                                                        <label for="radioliqhidra1">
                                                                            <i class="fas fa-thumbs-up"></i>
                                                                        </label>
                                                                    </div>

                                                                    <div class="icheck-danger d-inline">
                                                                        <input type="radio" id="radioliqhidra2" name="liquido_hidraulico" value="0" required>
                                                                        <label for="radioliqhidra2">
                                                                            <i class="fas fa-thumbs-down"></i>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group clearfix">
                                                                    <div class="icheck-success d-inline">
                                                                        <input type="radio" id="radioestcorreas1" name="estado_correas" value="1" required>
                                                                        <label for="radioestcorreas1">
                                                                            <i class="fas fa-thumbs-up"></i>
                                                                        </label>
                                                                    </div>

                                                                    <div class="icheck-danger d-inline">
                                                                        <input type="radio" id="radioestcorreas2" name="estado_correas" value="0" required>
                                                                        <label for="radioestcorreas2">
                                                                            <i class="fas fa-thumbs-down"></i>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group clearfix">
                                                                    <div class="icheck-success d-inline">
                                                                        <input type="radio" id="radionivliqufrenos1" name="nivel_liquido_frenos" value="1" required>
                                                                        <label for="radionivliqufrenos1">
                                                                            <i class="fas fa-thumbs-up"></i>
                                                                        </label>
                                                                    </div>

                                                                    <div class="icheck-danger d-inline">
                                                                        <input type="radio" id="radionivliqufrenos2" name="nivel_liquido_frenos" value="0" required>
                                                                        <label for="radionivliqufrenos2">
                                                                            <i class="fas fa-thumbs-down"></i>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group clearfix">
                                                                    <div class="icheck-success d-inline">
                                                                        <input type="radio" id="radiocajcambios1" name="caja_cambios" value="1" required>
                                                                        <label for="radiocajcambios1">
                                                                            <i class="fas fa-thumbs-up"></i>
                                                                        </label>
                                                                    </div>

                                                                    <div class="icheck-danger d-inline">
                                                                        <input type="radio" id="radiocajcambios2" name="caja_cambios" value="0" required>
                                                                        <label for="radiocajcambios2">
                                                                            <i class="fas fa-thumbs-down"></i>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <td><b>Barra de Dirección</b></td>
                                                            <td><b>Nivel de Aceite</b></td>
                                                            <td><b>Freno de Emergencia</b></td>
                                                            <td><b>Sistema Hidráulico</b></td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <div class="form-group clearfix">
                                                                    <div class="icheck-success d-inline">
                                                                        <input type="radio" id="radiodireccion1" name="direccion" value="1" required>
                                                                        <label for="radiodireccion1">
                                                                            <i class="fas fa-thumbs-up"></i>
                                                                        </label>
                                                                    </div>

                                                                    <div class="icheck-danger d-inline">
                                                                        <input type="radio" id="radiodireccion2" name="direccion" value="0" required>
                                                                        <label for="radiodireccion2">
                                                                            <i class="fas fa-thumbs-down"></i>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group clearfix">
                                                                    <div class="icheck-success d-inline">
                                                                        <input type="radio" id="radionivaceite1" name="nivel_aceite" value="1" required>
                                                                        <label for="radionivaceite1">
                                                                            <i class="fas fa-thumbs-up"></i>
                                                                        </label>
                                                                    </div>

                                                                    <div class="icheck-danger d-inline">
                                                                        <input type="radio" id="radionivaceite2" name="nivel_aceite" value="0" required>
                                                                        <label for="radionivaceite2">
                                                                            <i class="fas fa-thumbs-down"></i>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group clearfix">
                                                                    <div class="icheck-success d-inline">
                                                                        <input type="radio" id="radiofrenoemerge1" name="freno_emergencia" value="1" required>
                                                                        <label for="radiofrenoemerge1">
                                                                            <i class="fas fa-thumbs-up"></i>
                                                                        </label>
                                                                    </div>

                                                                    <div class="icheck-danger d-inline">
                                                                        <input type="radio" id="radiofrenoemerge2" name="freno_emergencia" value="0" required>
                                                                        <label for="radiofrenoemerge2">
                                                                            <i class="fas fa-thumbs-down"></i>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group clearfix">
                                                                    <div class="icheck-success d-inline">
                                                                        <input type="radio" id="radiosistemahidra1" name="sistema_hidraulico" value="1" required>
                                                                        <label for="radiosistemahidra1">
                                                                            <i class="fas fa-thumbs-up"></i>
                                                                        </label>
                                                                    </div>

                                                                    <div class="icheck-danger d-inline">
                                                                        <input type="radio" id="radiosistemahidra12" name="sistema_hidraulico" value="0" required>
                                                                        <label for="radiosistemahidra12">
                                                                            <i class="fas fa-thumbs-down"></i>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                        <!--|||TAB INDICADORES TABLERO|||-->
                                        <div class="tab-pane fade" id="custom-tabs-two-indicadorestableros" role="tabpanel" aria-labelledby="custom-tabs-two-indicadorestableros-tab">
                                            <div class="table table-responsive">
                                                <table class="table table-bordered text-center" nombre="Indicadores Tablero">
                                                    <thead class="text-nowrap">
                                                        <tr>
                                                            <th>Velocímetro</th>
                                                            <th>Carga de la Batería</th>
                                                            <th>Presión de Aceite</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody class="text-nowrap">
                                                        <tr>
                                                            <td>
                                                                <div class="form-group clearfix">
                                                                    <div class="icheck-success d-inline">
                                                                        <input type="radio" id="radiovelocimetro1" name="velocimetro" value="1" required>
                                                                        <label for="radiovelocimetro1">
                                                                            <i class="fas fa-thumbs-up"></i>
                                                                        </label>
                                                                    </div>

                                                                    <div class="icheck-danger d-inline">
                                                                        <input type="radio" id="radiovelocimetro2" name="velocimetro" value="0" required>
                                                                        <label for="radiovelocimetro2">
                                                                            <i class="fas fa-thumbs-down"></i>
                                                                        </label>
                                                                    </div>

                                                                    <div class="icheck-warning d-inline">
                                                                        <input type="radio" id="radiovelocimetro3" name="velocimetro" value="2" required>
                                                                        <label for="radiovelocimetro3">
                                                                            <i class="fas fa-ban"></i>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </td>

                                                            <td>
                                                                <div class="form-group clearfix">
                                                                    <div class="icheck-success d-inline">
                                                                        <input type="radio" id="radiocargabateria1" name="carga_bateria" value="1" required>
                                                                        <label for="radiocargabateria1">
                                                                            <i class="fas fa-thumbs-up"></i>
                                                                        </label>
                                                                    </div>

                                                                    <div class="icheck-danger d-inline">
                                                                        <input type="radio" id="radiocargabateria2" name="carga_bateria" value="0" required>
                                                                        <label for="radiocargabateria2">
                                                                            <i class="fas fa-thumbs-down"></i>
                                                                        </label>
                                                                    </div>

                                                                    <div class="icheck-warning d-inline">
                                                                        <input type="radio" id="radiocargabateria3" name="carga_bateria" value="2" required>
                                                                        <label for="radiocargabateria3">
                                                                            <i class="fas fa-ban"></i>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </td>

                                                            <td>
                                                                <div class="form-group clearfix">
                                                                    <div class="icheck-success d-inline">
                                                                        <input type="radio" id="radioprecionaceite1" name="presion_aceite" value="1" required>
                                                                        <label for="radioprecionaceite1">
                                                                            <i class="fas fa-thumbs-up"></i>
                                                                        </label>
                                                                    </div>

                                                                    <div class="icheck-danger d-inline">
                                                                        <input type="radio" id="radioprecionaceite2" name="presion_aceite" value="0" required>
                                                                        <label for="radioprecionaceite2">
                                                                            <i class="fas fa-thumbs-down"></i>
                                                                        </label>
                                                                    </div>

                                                                    <div class="icheck-warning d-inline">
                                                                        <input type="radio" id="radiopresionaceite3" name="presion_aceite" value="2" required>
                                                                        <label for="radiopresionaceite3">
                                                                            <i class="fas fa-ban"></i>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <td><b>Combustible</b></td>
                                                            <td><b>Presión de Aire</b></td>
                                                            <td><b>Temperatura</b></td>
                                                        </tr>

                                                        <tr>
                                                            <td>
                                                                <div class="form-group clearfix">
                                                                    <div class="icheck-success d-inline">
                                                                        <input type="radio" id="radiocombustible1" name="combustible" value="1" required>
                                                                        <label for="radiocombustible1">
                                                                            <i class="fas fa-thumbs-up"></i>
                                                                        </label>
                                                                    </div>

                                                                    <div class="icheck-danger d-inline">
                                                                        <input type="radio" id="radiocombustible2" name="combustible" value="0" required>
                                                                        <label for="radiocombustible2">
                                                                            <i class="fas fa-thumbs-down"></i>
                                                                        </label>
                                                                    </div>

                                                                    <div class="icheck-warning d-inline">
                                                                        <input type="radio" id="radiocombustible3" name="combustible" value="2" required>
                                                                        <label for="radiocombustible3">
                                                                            <i class="fas fa-ban"></i>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group clearfix">
                                                                    <div class="icheck-success d-inline">
                                                                        <input type="radio" id="radiopresionaire1" name="presion_aire" value="1" required>
                                                                        <label for="radiopresionaire1">
                                                                            <i class="fas fa-thumbs-up"></i>
                                                                        </label>
                                                                    </div>

                                                                    <div class="icheck-danger d-inline">
                                                                        <input type="radio" id="radiopresionaire2" name="presion_aire" value="0" required>
                                                                        <label for="radiopresionaire2">
                                                                            <i class="fas fa-thumbs-down"></i>
                                                                        </label>
                                                                    </div>

                                                                    <div class="icheck-warning d-inline">
                                                                        <input type="radio" id="radiopresionaire3" name="presion_aire" value="2" required>
                                                                        <label for="radiopresionaire3">
                                                                            <i class="fas fa-ban"></i>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </td>

                                                            <td>
                                                                <div class="form-group clearfix">
                                                                    <div class="icheck-success d-inline">
                                                                        <input type="radio" id="radiotemperatura1" name="temperatura" value="1" required>
                                                                        <label for="radiotemperatura1">
                                                                            <i class="fas fa-thumbs-up"></i>
                                                                        </label>
                                                                    </div>

                                                                    <div class="icheck-danger d-inline">
                                                                        <input type="radio" id="radiotemperatura2" name="temperatura" value="0" required>
                                                                        <label for="radiotemperatura2">
                                                                            <i class="fas fa-thumbs-down"></i>
                                                                        </label>
                                                                    </div>

                                                                    <div class="icheck-warning d-inline">
                                                                        <input type="radio" id="radiotemperatura3" name="temperatura" value="2" required>
                                                                        <label for="radiotemperatura3">
                                                                            <i class="fas fa-ban"></i>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                        <!--|||TAB MANTENIMIENTO|||-->
                                        <div class="tab-pane fade table-responsive" id="custom-tabs-two-mantenimiento" role="tabpanel" aria-labelledby="custom-tabs-two-mantenimiento-tab">
                                            <div class="table table-responsive">
                                                <table class="table table-bordered text-center" nombre="Mantenimiento">
                                                    <thead class="text-nowrap">
                                                        <tr>
                                                            <th style="width: 278px">Cambio de Aceite</th>
                                                            <th style="width: 278px;">Engrase</th>
                                                            <th style="width: 278px;">Rotación de Llantas</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody class="text-nowrap">
                                                        <tr>
                                                            <td>
                                                                <div class="input-group date" data-target-input="nearest">
                                                                    <input type="date" class="form-control" id="cambio_aceite" name="cambio_aceite" required>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="input-group date" data-target-input="nearest">
                                                                    <input type="date" class="form-control" id="engrase" name="engrase" required>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="input-group date" data-target-input="nearest">
                                                                    <input type="date" class="form-control" id="rotacion_llantas" name="rotacion_llantas" required>
                                                                </div>
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <td><b>Filtro de Aire</b></td>
                                                            <td><b>Sincronización</b></td>
                                                            <td><b>Alineacion y Balaneceo</b></td>
                                                        </tr>

                                                        <tr>
                                                            <td>
                                                                <div class="input-group date" data-target-input="nearest">
                                                                    <input type="date" class="form-control" id="filtro_aire" name="filtro_aire" required>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="input-group date" data-target-input="nearest">
                                                                    <input type="date" class="form-control" id="sincronizacion" name="sincronizacion" required>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="input-group date" data-target-input="nearest">
                                                                    <input type="date" class="form-control" id="alineacion_balanceo" name="alineacion_balanceo" required>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                        <!--|||TAB LLANTAS|||-->
                                        <div class="tab-pane fade" id="custom-tabs-two-llantas" role="tabpanel" aria-labelledby="custom-tabs-two-llantas-tab">
                                            <div class="table table-responsive">
                                                <table class="table table-bordered text-center" nombre="Llantas">
                                                    <thead class="text-nowrap">
                                                        <tr>
                                                            <th style="width: 278px">Delanteras</th>
                                                            <th style="width: 278px;">Traseras</th>
                                                            <th style="width: 278px;">Cortes</th>
                                                            <th style="width: 278px;">Espárragos</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody class="text-nowrap">
                                                        <tr>
                                                            <td>
                                                                <div class="form-group clearfix">
                                                                    <div class="icheck-success d-inline">
                                                                        <input type="radio" id="radiodelanteras1" name="llantas_delanteras" value="1" required>
                                                                        <label for="radiodelanteras1">
                                                                            <i class="fas fa-thumbs-up"></i>
                                                                        </label>
                                                                    </div>

                                                                    <div class="icheck-danger d-inline">
                                                                        <input type="radio" id="radiodelanteras2" name="llantas_delanteras" value="0" required>
                                                                        <label for="radiodelanteras2">
                                                                            <i class="fas fa-thumbs-down"></i>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group clearfix">
                                                                    <div class="icheck-success d-inline">
                                                                        <input type="radio" id="radiotraseras1" name="llantas_traseras" value="1" required>
                                                                        <label for="radiotraseras1">
                                                                            <i class="fas fa-thumbs-up"></i>
                                                                        </label>
                                                                    </div>

                                                                    <div class="icheck-danger d-inline">
                                                                        <input type="radio" id="radiotraseras2" name="llantas_traseras" value="0" required>
                                                                        <label for="radiotraseras2">
                                                                            <i class="fas fa-thumbs-down"></i>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group clearfix">
                                                                    <div class="icheck-success d-inline">
                                                                        <input type="radio" id="radiocortes1" name="cortes" value="1" required>
                                                                        <label for="radiocortes1">
                                                                            <i class="fas fa-thumbs-up"></i>
                                                                        </label>
                                                                    </div>

                                                                    <div class="icheck-danger d-inline">
                                                                        <input type="radio" id="radiocortes2" name="cortes" value="0" required>
                                                                        <label for="radiocortes2">
                                                                            <i class="fas fa-thumbs-down"></i>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group clearfix">
                                                                    <div class="icheck-success d-inline">
                                                                        <input type="radio" id="radioesparragos1" name="esparragos" value="1" required>
                                                                        <label for="radioesparragos1">
                                                                            <i class="fas fa-thumbs-up"></i>
                                                                        </label>
                                                                    </div>

                                                                    <div class="icheck-danger d-inline">
                                                                        <input type="radio" id="radioesparragos2" name="esparragos" value="0" required>
                                                                        <label for="radioesparragos2">
                                                                            <i class="fas fa-thumbs-down"></i>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <td><b>Profundidad de huella 2mm</b></td>
                                                            <td><b>Llanta de Repuesto</b></td>
                                                            <td><b>Presión de Inflado</b></td>
                                                            <td><b>Abultamientos</b></td>
                                                        </tr>

                                                        <tr>
                                                            <td>
                                                                <div class="form-group clearfix">
                                                                    <div class="icheck-success d-inline">
                                                                        <input type="radio" id="radiohuellas2mm1" name="profundidad_huella" value="1" required>
                                                                        <label for="radiohuellas2mm1">
                                                                            <i class="fas fa-thumbs-up"></i>
                                                                        </label>
                                                                    </div>

                                                                    <div class="icheck-danger d-inline">
                                                                        <input type="radio" id="radiohuellas2mm2" name="profundidad_huella" value="0" required>
                                                                        <label for="radiohuellas2mm2">
                                                                            <i class="fas fa-thumbs-down"></i>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group clearfix">
                                                                    <div class="icheck-success d-inline">
                                                                        <input type="radio" id="radiorepuesto1" name="llanta_repuesto" value="1" required>
                                                                        <label for="radiorepuesto1">
                                                                            <i class="fas fa-thumbs-up"></i>
                                                                        </label>
                                                                    </div>

                                                                    <div class="icheck-danger d-inline">
                                                                        <input type="radio" id="radiorepuesto2" name="llanta_repuesto" value="0" required>
                                                                        <label for="radiorepuesto2">
                                                                            <i class="fas fa-thumbs-down"></i>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group clearfix">
                                                                    <div class="icheck-success d-inline">
                                                                        <input type="radio" id="radioinflado1" name="presion_inflado" value="1" required>
                                                                        <label for="radioinflado1">
                                                                            <i class="fas fa-thumbs-up"></i>
                                                                        </label>
                                                                    </div>

                                                                    <div class="icheck-danger d-inline">
                                                                        <input type="radio" id="radioinflado2" name="presion_inflado" value="0" required>
                                                                        <label for="radioinflado2">
                                                                            <i class="fas fa-thumbs-down"></i>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group clearfix">
                                                                    <div class="icheck-success d-inline">
                                                                        <input type="radio" id="radioabultamiento1" name="abultamientos" value="1" required>
                                                                        <label for="radioabultamiento1">
                                                                            <i class="fas fa-thumbs-up"></i>
                                                                        </label>
                                                                    </div>

                                                                    <div class="icheck-danger d-inline">
                                                                        <input type="radio" id="radioabultamiento2" name="abultamientos" value="0" required>
                                                                        <label for="radioabultamiento2">
                                                                            <i class="fas fa-thumbs-down"></i>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <td><b>Reloj / Braza viga</b></td>
                                                            <td><b>Boca de la Llanta</b></td>
                                                            <td><b>Rines</b></td>
                                                        </tr>

                                                        <tr>
                                                            <td>
                                                                <div class="form-group clearfix">
                                                                    <div class="icheck-success d-inline">
                                                                        <input type="radio" id="radioreloj1" name="reloj_braza" value="1" required>
                                                                        <label for="radioreloj1">
                                                                            <i class="fas fa-thumbs-up"></i>
                                                                        </label>
                                                                    </div>

                                                                    <div class="icheck-danger d-inline">
                                                                        <input type="radio" id="radioreloj2" name="reloj_braza" value="0" required>
                                                                        <label for="radioreloj2">
                                                                            <i class="fas fa-thumbs-down"></i>
                                                                        </label>
                                                                    </div>

                                                                    <div class="icheck-warning d-inline">
                                                                        <input type="radio" id="radioreloj3" name="reloj_braza" value="2" required>
                                                                        <label for="radioreloj3">
                                                                            <i class="fas fa-ban"></i>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group clearfix">
                                                                    <div class="icheck-success d-inline">
                                                                        <input type="radio" id="radiobocallanta1" name="boca_llanta" value="1" required>
                                                                        <label for="radiobocallanta1">
                                                                            <i class="fas fa-thumbs-up"></i>
                                                                        </label>
                                                                    </div>

                                                                    <div class="icheck-danger d-inline">
                                                                        <input type="radio" id="radiobocallanta2" name="boca_llanta" value="0" required>
                                                                        <label for="radiobocallanta2">
                                                                            <i class="fas fa-thumbs-down"></i>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group clearfix">
                                                                    <div class="icheck-success d-inline">
                                                                        <input type="radio" id="radiorines1" name="rines" value="1" required>
                                                                        <label for="radiorines1">
                                                                            <i class="fas fa-thumbs-up"></i>
                                                                        </label>
                                                                    </div>

                                                                    <div class="icheck-danger d-inline">
                                                                        <input type="radio" id="radiorines2" name="rines" value="0" required>
                                                                        <label for="radiorines2">
                                                                            <i class="fas fa-thumbs-down"></i>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                        <!--|||TAB EQUIPO DE SEGURIDAD|||-->
                                        <div class="tab-pane fade" id="custom-tabs-two-equiposeguridad" role="tabpanel" aria-labelledby="custom-tabs-two-equiposeguridad-tab">
                                            <div class="table table-responsive">
                                                <table class="table table-bordered text-center" nombre="Equipo de Seguridad">
                                                    <thead class="text-nowrap">
                                                        <tr>
                                                            <th style="width: 278px">Chaleco reflectivo</th>
                                                            <th style="width: 278px;">Linterna</th>
                                                            <th style="width: 278px;">Conos 2 o Triángulos</th>
                                                            <th style="width: 278px;">Tacos de Bloqueo</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody class="text-nowrap">
                                                        <tr>
                                                            <td>
                                                                <div class="form-group clearfix">
                                                                    <div class="icheck-success d-inline">
                                                                        <input type="radio" id="radiochaleco1" name="chalecoreflectivo" value="1" required>
                                                                        <label for="radiochaleco1">
                                                                            <i class="fas fa-thumbs-up"></i>
                                                                        </label>
                                                                    </div>

                                                                    <div class="icheck-danger d-inline">
                                                                        <input type="radio" id="radiochaleco2" name="chalecoreflectivo" value="0" required>
                                                                        <label for="radiochaleco2">
                                                                            <i class="fas fa-thumbs-down"></i>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group clearfix">
                                                                    <div class="icheck-success d-inline">
                                                                        <input type="radio" id="radiolinterna1" name="linterna" value="1" required>
                                                                        <label for="radiolinterna1">
                                                                            <i class="fas fa-thumbs-up"></i>
                                                                        </label>
                                                                    </div>

                                                                    <div class="icheck-danger d-inline">
                                                                        <input type="radio" id="radiolinterna2" name="linterna" value="0" required>
                                                                        <label for="radiolinterna2">
                                                                            <i class="fas fa-thumbs-down"></i>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group clearfix">
                                                                    <div class="icheck-success d-inline">
                                                                        <input type="radio" id="radioconos1" name="conos_triangulos" value="1" required>
                                                                        <label for="radioconos1">
                                                                            <i class="fas fa-thumbs-up"></i>
                                                                        </label>
                                                                    </div>

                                                                    <div class="icheck-danger d-inline">
                                                                        <input type="radio" id="radioconos2" name="conos_triangulos" value="0" required>
                                                                        <label for="radioconos2">
                                                                            <i class="fas fa-thumbs-down"></i>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group clearfix">
                                                                    <div class="icheck-success d-inline">
                                                                        <input type="radio" id="radiobloques1" name="tacos_bloques" value="1" required>
                                                                        <label for="radiobloques1">
                                                                            <i class="fas fa-thumbs-up"></i>
                                                                        </label>
                                                                    </div>

                                                                    <div class="icheck-danger d-inline">
                                                                        <input type="radio" id="radiobloques2" name="tacos_bloques" value="0" required>
                                                                        <label for="radiobloques2">
                                                                            <i class="fas fa-thumbs-down"></i>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <td><b>Gato</b></td>
                                                            <td><b>Cruceta o Copa</b></td>
                                                            <td><b>Alicate</b></td>
                                                            <td><b>Destornilladores</b></td>
                                                        </tr>

                                                        <tr>
                                                            <td>
                                                                <div class="form-group clearfix">
                                                                    <div class="icheck-success d-inline">
                                                                        <input type="radio" id="radiogato1" name="gato" value="1" required>
                                                                        <label for="radiogato1">
                                                                            <i class="fas fa-thumbs-up"></i>
                                                                        </label>
                                                                    </div>

                                                                    <div class="icheck-danger d-inline">
                                                                        <input type="radio" id="radiogato2" name="gato" value="0" required>
                                                                        <label for="radiogato2">
                                                                            <i class="fas fa-thumbs-down"></i>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group clearfix">
                                                                    <div class="icheck-success d-inline">
                                                                        <input type="radio" id="radiocruceta1" name="cruceta_copa" value="1" required>
                                                                        <label for="radiocruceta1">
                                                                            <i class="fas fa-thumbs-up"></i>
                                                                        </label>
                                                                    </div>

                                                                    <div class="icheck-danger d-inline">
                                                                        <input type="radio" id="radiocruceta2" name="cruceta_copa" value="0" required>
                                                                        <label for="radiocruceta2">
                                                                            <i class="fas fa-thumbs-down"></i>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group clearfix">
                                                                    <div class="icheck-success d-inline">
                                                                        <input type="radio" id="radioalicate1" name="alicate" value="1" required>
                                                                        <label for="radioalicate1">
                                                                            <i class="fas fa-thumbs-up"></i>
                                                                        </label>
                                                                    </div>

                                                                    <div class="icheck-danger d-inline">
                                                                        <input type="radio" id="radioalicate2" name="alicate" value="0" required>
                                                                        <label for="radioalicate2">
                                                                            <i class="fas fa-thumbs-down"></i>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group clearfix">
                                                                    <div class="icheck-success d-inline">
                                                                        <input type="radio" id="radiodestornilladores1" name="destornilladores" value="1" required>
                                                                        <label for="radiodestornilladores1">
                                                                            <i class="fas fa-thumbs-up"></i>
                                                                        </label>
                                                                    </div>

                                                                    <div class="icheck-danger d-inline">
                                                                        <input type="radio" id="radiodestornilladores2" name="destornilladores" value="0" required>
                                                                        <label for="radiodestornilladores2">
                                                                            <i class="fas fa-thumbs-down"></i>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <td><b>Llaves fijas</b></td>
                                                            <td><b>Botiquín</b></td>
                                                            <td><b>Llave de Expansión</b></td>
                                                            <td><b>Extintor</b></td>
                                                        </tr>

                                                        <tr>
                                                            <td>
                                                                <div class="form-group clearfix">
                                                                    <div class="icheck-success d-inline">
                                                                        <input type="radio" id="radiollavesfijas1" name="llavesfijas" value="1" required>
                                                                        <label for="radiollavesfijas1">
                                                                            <i class="fas fa-thumbs-up"></i>
                                                                        </label>
                                                                    </div>

                                                                    <div class="icheck-danger d-inline">
                                                                        <input type="radio" id="radiollavesfijas2" name="llavesfijas" value="0" required>
                                                                        <label for="radiollavesfijas2">
                                                                            <i class="fas fa-thumbs-down"></i>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group clearfix">
                                                                    <div class="icheck-success d-inline">
                                                                        <input type="radio" id="radiobotiquin1" name="botiquin" value="1" required>
                                                                        <label for="radiobotiquin1">
                                                                            <i class="fas fa-thumbs-up"></i>
                                                                        </label>
                                                                    </div>

                                                                    <div class="icheck-danger d-inline">
                                                                        <input type="radio" id="radiobotiquin2" name="botiquin" value="0" required>
                                                                        <label for="radiobotiquin2">
                                                                            <i class="fas fa-thumbs-down"></i>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group clearfix">
                                                                    <div class="icheck-success d-inline">
                                                                        <input type="radio" id="radioexpansion1" name="llave_expansion" value="1" required>
                                                                        <label for="radioexpansion1">
                                                                            <i class="fas fa-thumbs-up"></i>
                                                                        </label>
                                                                    </div>

                                                                    <div class="icheck-danger d-inline">
                                                                        <input type="radio" id="radioexpansion2" name="llave_expansion" value="0" required>
                                                                        <label for="radioexpansion2">
                                                                            <i class="fas fa-thumbs-down"></i>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group clearfix">
                                                                    <div class="icheck-success d-inline">
                                                                        <input type="radio" id="radioextintor1" name="extintor" value="1" required>
                                                                        <label for="radioextintor1">
                                                                            <i class="fas fa-thumbs-up"></i>
                                                                        </label>
                                                                    </div>

                                                                    <div class="icheck-danger d-inline">
                                                                        <input type="radio" id="radioextintor2" name="extintor" value="0" required>
                                                                        <label for="radioextintor2">
                                                                            <i class="fas fa-thumbs-down"></i>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <td><b>Kilometraje total</b></td>
                                                            <td><b>Observaciones</b></td>
                                                        </tr>

                                                        <tr>
                                                            <td>
                                                                <textarea class="form-control" id="kmtotal" name="kilometraje_total" rows="2" required placeholder="..."></textarea>
                                                            </td>
                                                            <td>
                                                                <textarea class="form-control" id="observaciones" name="observaciones" rows="2" required placeholder="..."></textarea>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <!-- ===================================================
                                    BOTON GUARDAR
                                =================================================== -->
                            <?php if (validarPermiso('M_OPERACIONES', 'U')) : ?>
                                <div class="col-12 mb-1">
                                    <button type="submit" form="alistamiento_form" class="btn btn-sm btn-success float-center btn-alistamientoguardar">
                                        <i class="fas fa-print"></i>
                                        Guardar
                                    </button>
                                </div>

                            <?php endif ?>

                            <!-- ===================================================
                                    REGISTRO FOTOGRAFICO
                                =================================================== -->
                            <div class="col-12">
                                <div class="card card-secondary card-tabs">
                                    <div class="card-header p-0 pt-1">
                                        <ul class="nav nav-tabs" id="custom-tabs-two-tab" role="tablist">

                                            <li class="pt-2 px-3">
                                                <h3 class="card-title">Detalles</h3>
                                            </li>

                                            <li class="nav-item">
                                                <a class="nav-link active" id="pills-observaimagenes-tab" data-toggle="pill" href="#pills-observaimagenes" role="tab" aria-controls="pills-observaimagenes" aria-selected="true"><u>Registro fotográfico</u></a>
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="card-body">
                                        <div class="tab-content" id="custom-tabs-two-tabContent">
                                            <div class="row d-flex justify-content-center">
                                                <div class="col-12 col-md-6">
                                                    <div class="form-group">
                                                        <label>Imagen de Evidencia (1 Foto a la vez)</label>
                                                        <div class="input-group">
                                                            <div class="input-group-append">
                                                                <span class="input-group-text">
                                                                    <i class="fas fa-camera-retro"></i>
                                                                </span>
                                                            </div>
                                                            <input type="file" class="form-control" name="foto_evidencia" id="foto_evidencia" accept="image/png, image/jpeg">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12 col-md-6">
                                                    <div class="form-group">
                                                        <label>Observaciones</label>
                                                        <textarea id="observacion_evidencia" name="observacion_evidencia" class="form-control" rows="2" placeholder="Digite las observaciones vistas en la inspeccion."></textarea>
                                                    </div>
                                                </div>

                                                <?php if (validarPermiso('M_OPERACIONES', 'U')) : ?>
                                                    <div class="col-12 col-md-8 col-lg-6 col-xl-4">
                                                        <button type="button" id="btnGuardarEvidencia" class="btn btn-block bg-gradient-success"><i class="far fa-save"> Cargar información</i></button>
                                                        <div class="overlay d-none" id="overlayBtnGuardarEvidencia">
                                                            <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                                                        </div>
                                                    </div>
                                                <?php endif ?>
                                            </div>

                                            <br>

                                            <!-- ===================================================
                                                    TABLA EVIDENCIAS
                                                =================================================== -->
                                            <div class="table-responsive">
                                                <table id="tblEvidencias" class="table table-striped text-center table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>Fecha</th>
                                                            <th>Imágenes de Evidencia</th>
                                                            <th>Observaciones</th>
                                                            <th>Estado</th>
                                                            <th>Autor</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody id="tbodyEvidencias">

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

            <div class="modal-footer justify-content-center bg-info">
                <?php if (validarPermiso('M_OPERACIONES', 'U')) : ?>
                    <button type="submit" form="alistamiento_form" class="btn btn-success"><i class="fas fa-print"></i> Guardar</button>
                <?php endif ?>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Volver</button>
            </div>
        </div>
    </div>
</div>