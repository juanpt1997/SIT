<?php

if (!validarPermiso('M_CONTRATOS', 'R')) {
    echo "<script> window.location = 'inicio'; </script>";
}

$tvehiculos = ControladorVehiculos::ctrMostrarTipoVehiculo();
$Sucursales = ControladorGH::ctrSucursales();
$Cotizaciones = ControladorCotizaciones::ctrVerCotizacion();
$clientes = ControladorClientes::ctrVerCliente();
$DeparMunicipios = ControladorGH::ctrDeparMunicipios();
$Rutas = ControladorRutas::ctrListarRutas();
?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark "><i><b>Gestión de cotizaciones <i class="fas fa-comments-dollar"></i></b></i></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                        <li class="breadcrumb-item active">Cotizaciones</li>
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

            <button type="button" class="btn btn-success btn-md btn-agregarcotizacion" data-toggle="modal" data-target="#cotizacionmodal">
                <i class="fas fa-file-invoice-dollar"></i> Agregar nueva cotización
            </button>

            <div class="row mt-2">
                <div class="col-12">
                    <div class="card card-outline card-success">
                        <div class="card-body">

                            <table id="tblCotizaciones" class="table table-responsive table-sm table-striped table-bordered table-hover w-100 text-center">
                                <thead class="text-sm text-center text-nowrap">
                                    <tr>
                                        <th>...</th>
                                        <th style="min-width:90px;">ID</th>
                                        <th>Nombre contratante</th>
                                        <th style="min-width:90px;">NIT/CC</th>
                                        <th>Tipo documento</th>
                                        <th>Dirección</th>
                                        <th>Ciudad</th>
                                        <th style="min-width:90px;">Teléfono 1</th>
                                        <th style="min-width:90px;">Teléfono 2</th>
                                        <th>Nombre contacto</th>
                                        <th>Tipo documento</th>
                                        <th>Documento contacto</th>
                                        <th>Cc. Expedida</th>
                                        <th style="min-width:90px;">Ciudad</th>
                                        <th style="min-width:90px;">Empresa</th>
                                        <th>Origen</th>
                                        <th>Destino</th>
                                        <th style="min-width:70px;">Ruta</th>
                                        <th>Fecha recepción</th>
                                        <th>Fecha respuesta</th>
                                        <th>Fecha inicio</th>
                                        <th style="min-width:90px;">Fecha final</th>
                                        <th>Sucursal</th>
                                        <th style="min-width:90px;">Duración</th>
                                        <th>Hora salida</th>
                                        <th>Hora recogida</th>
                                        <th>Tipo vehículo</th>
                                        <th>Otro vehiculo</th>
                                        <th>Nro. Vehículos</th>
                                        <th style="min-width:90px;">Capacidad</th>
                                        <th>Valor / vehículo</th>
                                        <th style="min-width:90px;">Valor total</th>
                                        <th style="min-width:90px;">Cotización</th>
                                        <th>Clasificación</th>
                                        <th style="min-width:90px;">Música</th>
                                        <th style="min-width:90px;">Aire</th>
                                        <th style="min-width:90px;">Wi-Fi</th>
                                        <th>Silla reclinable</th>
                                        <th style="min-width:90px;">Baño</th>
                                        <th style="min-width:90px;">Bodega</th>
                                        <th style="min-width:90px;">Otro</th>
                                        <th>Realiza viaje</th>
                                        <th style="min-width:90px;">Por qué</th>
                                    </tr>
                                </thead>
                                <tbody id="tbodyCotizaciones" class="text-sm">
                                    <?php foreach ($Cotizaciones as $key => $value) : ?>
                                        <tr>
                                            <td class="text-center">
                                                <div class="btn-group" role="group" aria-label="Button group">
                                                    <button class="btn btn-toolbar btn-sm btn-info btn-editarcotizacion" id_cot="<?= $value['idcotizacion'] ?>" document="<?= $value['Documento'] ?>" data-toggle="modal" data-target="#cotizacionmodal"><i class="fas fa-edit"></i></button>
                                                </div>
                                            </td>
                                            <td><?= $value['idcotizacion'] ?></td>
                                            <td><?= $value['nombre_con'] ?></td>
                                            <td><?= $value['documento_con'] ?></td>
                                            <td><?= $value['tipo_doc_con'] ?></td>
                                            <td><?= $value['direccion_con'] ?></td>
                                            <td><?= $value['ciudadcon'] ?></td>
                                            <td><?= $value['tel_1'] ?></td>
                                            <td><?= $value['tel_2'] ?></td>
                                            <td><?= $value['nombre_respo'] ?></td>
                                            <td><?= $value['tipo_doc_respo'] ?></td>
                                            <td><?= $value['documento_res'] ?></td>
                                            <td><?= $value['cedulaexpe'] ?></td>
                                            <td><?= $value['ciudadres'] ?></td>
                                            <td><?= $value['empresa'] ?></td>
                                            <td><?= $value['origen'] ?></td>
                                            <td><?= $value['destino'] ?></td>
                                            <td><?= $value['descripcion'] ?></td>
                                            <td><?= $value['fecha_solicitud'] ?></td>
                                            <td><?= $value['fecha_solucion'] ?></td>
                                            <td><?= $value['fecha_inicio'] ?></td>
                                            <td><?= $value['fecha_fin'] ?></td>
                                            <td><?= $value['sucursal'] ?></td>
                                            <td><?= $value['duracion'] ?></td>
                                            <td><?= $value['hora_salida'] ?></td>
                                            <td><?= $value['hora_recogida'] ?></td>
                                            <td><?= $value['tipov'] ?></td>
                                            <td><?= $value['otro_v'] ?></td>
                                            <td><?= $value['nro_vehiculos'] ?></td>
                                            <td><?= $value['capacidad'] ?></td>
                                            <td><?= $value['valorxvehiculo'] ?></td>
                                            <td><?= $value['valortotal'] ?></td>
                                            <td><?= $value['cotizacion'] ?></td>
                                            <td><?= $value['clasificacion'] ?></td>
                                            <td><?= $value['musica'] ?></td>
                                            <td><?= $value['aire'] ?></td>
                                            <td><?= $value['wifi'] ?></td>
                                            <td><?= $value['silleriareclinable'] ?></td>
                                            <td><?= $value['bano'] ?></td>
                                            <td><?= $value['bodega'] ?></td>
                                            <td><?= $value['otro'] ?></td>
                                            <td><?= $value['realiza_viaje'] ?></td>
                                            <td><?= $value['porque'] ?></td>
                                        </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>

                        </div><!-- card-body-->
                    </div><!-- card-->
                </div><!-- col-->
            </div><!-- row-->
        </div><!-- FIN container-fluid-->
    </div><!-- /.content -->
</div><!-- /.content-wrapper -->


<div class="modal fade" id="cotizacionmodal" tabindex="-1" data-backdrop="true" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="overflow-y: scroll;">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

            <div class="modal-header bg-info">
                <h3 class="modal-title" id="titulo_cotizacion"></h3>
                <button class="btn btn-secondary ml-2 d-none btn-copy-cotizacion" type="button"><i class="far fa-copy"></i> Copia</button>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form method="post" enctype="multipart/form-data" id="formulariocotizacion">

                <div class="modal-body">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="text-sm">ID</label>
                            <div class="input-group input-group-sm">
                                <input class="form-control" type="number" id="id_cot" name="id_cot" readonly>
                            </div>
                        </div>
                    </div>

                    <hr class="my-4 bg-dark">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="pcliente" class="text-sm"><i>Tipo de cliente</i></label>
                                <div class="input-group input-group-sm">
                                    <select id="pcliente" class="form-control" required>
                                        <option value="" selected>-Seleccione una opción-</option>
                                        <option value="cliente">Cliente existente</option>
                                        <option value="posible">Posible cliente</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="text-sm"><i>Lista de clientes</i></label>
                                <div class="input-group input-group-sm">
                                    <select class="form-control select2-single select-clientes input-sm" id="listaclientes" style="width: 99%" name="listaclientes" readonly>
                                        <option value="" selected><b>-Seleccione un cliente existente-</b></option>
                                        <?php foreach ($clientes as $key => $value) : ?>
                                            <option value="<?= $value['idcliente'] ?>"><?= $value['clientexist'] ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="my-4 bg-dark">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="text-sm">Nombre de la empresa</label>
                                <div class="input-group input-group-sm">
                                    <input class="form-control input-clientes" type="text" id="nom_contrata" name="nom_contrata" placeholder="Ingrese el nombre de la empresa" maxlength="45" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="text-sm">NIT/CC</label>
                                <div class="input-group input-group-sm">
                                    <input class="form-control input-clientes" type="text" id="document" name="document" placeholder="Ingrese el documento" maxlength="15" required>
                                </div>
                            </div>
                        </div>
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

                            <div class="form-group">
                                <label class="text-sm">Ciudad</label>
                                <div class="input-group input-group-sm">
                                    <select class="form-control input-sm select2-single select-ciudad input-clientes" style="width: 99%" type="number" id="ciudadcliente" name="ciudadcliente" required>
                                        <option selected value="">-Seleccione una ciudad-</option>
                                        <?php foreach ($DeparMunicipios as $key => $value) : ?>
                                            <option value="<?= $value['idmunicipio'] ?>"><?= $value['DeparMunic'] ?>
                                            </option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="form-group">
                        <label class="text-sm">Dirección</label>
                        <div class="input-group input-group-sm">
                            <input class="form-control input-clientes" type="text" id="direcci" name="direcci" placeholder="Ingrese la dirección" maxlength="100" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="text-sm">Teléfono 1</label>
                                <div class="input-group input-group-sm">
                                    <input class="form-control input-clientes" type="text" id="tel1" name="tel1" placeholder="Ingrese un teléfono" maxlength="10" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="text-sm">Nombre del responsable</label>
                                <div class="input-group input-group-sm">
                                    <input class="form-control input-clientes" type="text" id="nom_respo" name="nom_respo" placeholder="Nombre del responsable" maxlength="100" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="text-sm">Documento</label>
                                <div class="input-group input-group-sm">
                                    <input class="form-control input-clientes" type="text" id="docum_respo" name="docum_respo" placeholder="Documento del responsable" maxlength="15" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="text-sm">Ciudad responsable</label>
                                <div class="input-group input-group-sm">
                                    <select class="form-control input-sm select2-single select-ciudad input-clientes" style="width: 99%" type="number" id="ciudadresponsable" name="ciudadresponsable" required>
                                        <option selected value="">-Seleccione una ciudad-</option>
                                        <?php foreach ($DeparMunicipios as $key => $value) : ?>
                                            <option value="<?= $value['idmunicipio'] ?>"><?= $value['DeparMunic'] ?>
                                            </option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>

                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="text-sm">Teléfono 2</label>
                                <div class="input-group input-group-sm">
                                    <input class="form-control input-clientes" type="text" id="tel2" name="tel2" placeholder="Ingrese un segundo teléfono" maxlength="10" required>
                                </div>
                            </div>

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
                                <label class="text-sm">Cédula expedida en</label>
                                <div class="input-group input-group-sm">
                                    <select class="form-control input-sm select2-single select-ciudad input-clientes" style="width: 99%" type="number" id="expedicion" name="expedicion" required>
                                        <option selected value="">-Seleccione una ciudad-</option>
                                        <?php foreach ($DeparMunicipios as $key => $value) : ?>
                                            <option value="<?= $value['idmunicipio'] ?>"><?= $value['DeparMunic'] ?>
                                            </option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="my-4 bg-dark">

                    <div class="row">

                        <div class="col-12 text-sm">
                            <div class="form-group">
                                <label for="idruta" class="d-flex justify-content-center">Ruta</label>
                                <div class="input-group">
                                    <!-- <select class="form-control input-sm select2-single" id="idruta" name="idruta" required>
                                        <option selected value="">-Seleccione una ruta-</option>
                                        <?php foreach ($Rutas as $key => $value) : ?>
                                            <option value="<?= $value['id'] ?>"><?= $value['origendestino'] ?></option>
                                        <?php endforeach ?>
                                    </select> -->
                                    <input type="hidden" id="idruta" name="idruta">

                                    <input class="form-control" type="text" id="descrip" name="descrip" placeholder="Seleccione una ruta de la lista" required>

                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-success btn-md btn-ruta" title="Buscar una ruta existente" data-toggle="modal" data-target="#modal_general"><i class="fas fa-route"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="text-sm">Origen</label>
                                <div class="input-group input-group-sm">
                                    <input class="form-control" type="text" id="origin" name="origin" maxlength="100" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="text-sm">Destino</label>
                                <div class="input-group input-group-sm">
                                    <input class="form-control" type="text" id="destin" name="destin" maxlength="100" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 d-none">
                            <div class="form-group">
                                <label class="text-sm">Descripción de la solicitud</label>
                                <div class="input-group input-group-sm">
                                    <textarea class="form-control" type="text" id="des_sol" name="des_sol" placeholder="Describa la solicitud" style="min-height:70px"></textarea>
                                </div>
                            </div>
                        </div>

                    </div>

                    <hr class="my-4 bg-dark">

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="text-sm">Empresa</label>
                                <div class="input-group input-group-sm">
                                    <select class="form-control" type="text" id="empres" name="empres" required>
                                        <option selected value="">-Seleccione una opción-</option>
                                        <option>El SAMAN</option>
                                        <option>JOMAR</option>
                                        <option>AGRECON</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="text-sm">Fecha de solicitud</label>
                                <div class="input-group input-group-sm">
                                    <input class="form-control" type="date" id="f_sol" name="f_sol" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="text-sm">Hora de salida</label>
                                <div class="input-group input-group-sm">
                                    <input class="form-control" type="time" id="h_salida" name="h_salida" step="any" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="text-sm">Hora de recogida</label>
                                <div class="input-group input-group-sm">
                                    <input class="form-control" type="time" id="h_recog" name="h_recog" step="any" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="text-sm">Capacidad</label>
                                <div class="input-group input-group-sm">
                                    <input class="form-control" type="number" id="capaci" name="capaci" placeholder="Digite la capacidad" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="text-sm">Cotización</label>
                                <div class="input-group input-group-sm">
                                    <select class="form-control" type="text" id="cotiz" name="cotiz" required>
                                        <option value="" selected>-Seleccione una opción-</option>
                                        <option>Telefonica</option>
                                        <option>Personal</option>
                                        <option>Escrita</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="text-sm">Fecha en que resuelve</label>
                                <div class="input-group input-group-sm">
                                    <input class="form-control" type="date" id="f_resuelve" name="f_resuelve" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="text-sm">Duración</label>
                                <div class="input-group input-group-sm">
                                    <input class="form-control" type="text" id="durac" name="durac" placeholder="Escriba la duración del viaje" maxlength="45" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="text-sm">Tipo de vehículo</label>
                                <div class="input-group input-group-sm">
                                    <select class="form-control" id="tipovehiculocot" name="tipovehiculocot">
                                        <option value="" selected>-Seleccione un tipo-</option>
                                        <?php foreach ($tvehiculos as $key => $value) : ?>
                                            <option value="<?= $value['idtipovehiculo'] ?>"><?= $value['tipovehiculo'] ?>
                                            </option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="text-sm">Otro tipo de vehículo</label>
                                <div class="input-group input-group-sm">
                                    <input class="form-control" type="text" id="otro_v" name="otro_v" placeholder="Ingrese otro tipo de vehículo (opcional)" maxlength="15">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="text-sm">Valor por vehículo</label>
                                <div class="input-group input-group-sm">
                                    <input class="form-control" type="number" id="valor_vel" name="valor_vel" placeholder="Digite un valor por vehículo" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="text-sm">Clasificación cotización</label>
                                <div class="input-group input-group-sm">
                                    <select class="form-control" type="text" id="clasi_cot" name="clasi_cot" required>
                                        <option value="" selected>-Seleccione una opción-</option>
                                        <option>Contrato ocasional</option>
                                        <option>Contrato fijo</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="text-sm">Sucursal</label>
                                <div class="input-group input-group-sm">
                                    <select class="form-control" type="number" id="sucursalcot" name="sucursalcot">
                                        <option value="" selected>-Seleccione una sucursal-</option>
                                        <?php foreach ($Sucursales as $key => $value) : ?>
                                            <option value="<?= $value['ids'] ?>"><?= $value['sucursal'] ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>
                        </div>


                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="text-sm">Fecha de inicio</label>
                                <div class="input-group input-group-sm">
                                    <input class="form-control" type="date" id="f_inicio" name="f_inicio" required min="" max="">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="text-sm">Fecha de final</label>
                                <div class="input-group input-group-sm">
                                    <input class="form-control" type="date" id="f_fin" name="f_fin" required min="" max="">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="text-sm">Nro. de vehículos</label>
                                <div class="input-group input-group-sm">
                                    <input class="form-control" type="number" id="n_vehiculos" name="n_vehiculos" placeholder="Escriba el número de vehículos" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="text-sm">Valor total</label>
                                <div class="input-group input-group-sm">
                                    <input class="form-control" type="number" id="vtotal" name="vtotal" placeholder="Escriba el valor total" required>
                                </div>
                            </div>
                        </div>

                    </div>

                    <hr class="my-4 bg-dark">

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="text-sm">Música</label>
                                <div class="input-group input-group-sm">
                                    <select class="form-control" type="text" id="music" name="music" required>
                                        <option value="" selected>-Seleccione una opción-</option>
                                        <option>SI</option>
                                        <option>NO</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="text-sm">Bodega</label>
                                <div class="input-group input-group-sm">
                                    <select class="form-control" type="text" id="bodeg" name="bodeg" required>
                                        <option value="" selected>-Seleccione una opción-</option>
                                        <option>SI</option>
                                        <option>NO</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="text-sm">Otro</label>
                                <div class="input-group input-group-sm">
                                    <select class="form-control" type="text" id="another" name="another" required>
                                        <option value="" selected>-Seleccione una opción-</option>
                                        <option>SI</option>
                                        <option>NO</option>
                                    </select>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-4">

                            <div class="form-group">
                                <label class="text-sm">Aire</label>
                                <div class="input-group input-group-sm">
                                    <select class="form-control" type="text" id="air" name="air" required>
                                        <option value="" selected>-Seleccione una opción-</option>
                                        <option>SI</option>
                                        <option>NO</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="text-sm">Baño</label>
                                <div class="input-group input-group-sm">
                                    <select class="form-control" type="text" id="baño" name="baño" required>
                                        <option value="" selected>-Seleccione una opción-</option>
                                        <option>SI</option>
                                        <option>NO</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="text-sm">Se realiza el viaje</label>
                                <div class="input-group input-group-sm">
                                    <select class="form-control" type="text" id="realizav" name="realizav" required>
                                        <option value="" selected>-Seleccione una opción-</option>
                                        <option>SI</option>
                                        <option>NO</option>
                                        <option>PENDIENTE</option>
                                    </select>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-4">

                            <div class="form-group">
                                <label class="text-sm">Wi-Fi</label>
                                <div class="input-group input-group-sm">
                                    <select class="form-control" type="text" id="wi_fi" name="wi_fi" required>
                                        <option value="" selected>-Seleccione una opción-</option>
                                        <option>SI</option>
                                        <option>NO</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="text-sm">Silleteria Reclinable</label>
                                <div class="input-group input-group-sm">
                                    <select class="form-control" type="text" id="silleteriar" name="silleteriar" required>
                                        <option value="" selected>-Seleccione una opción-</option>
                                        <option>SI</option>
                                        <option>NO</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="text-sm">¿Por qué?</label>
                                <div class="input-group input-group-sm">
                                    <textarea class="form-control" type="text" id="porque" name="porque" placeholder="Escriba los motivos" style="min-height:70px"></textarea requiered>
                                </div>
                            </div>

                        </div>
                    </div>
                </div><!-- fin modal-body-->

                <div class="modal-footer bg-dark d-flex justify-content-center">
                    <button type="button" class="btn btn-danger btn-cancelar" data-dismiss="modal">Cancelar</button>
                    <?php if (validarPermiso('M_CONTRATOS', 'U')) : ?>
                    <button type="submit" class="btn btn-success btn-guardar-cotizacion">
                        <i class="fas fa-save"></i>
                        Guardar
                    </button>
                    <?php endif ?>
                </div>
                <?php
                $CrearCotizacion = new ControladorCotizaciones();
                $CrearCotizacion->ctrAgregarCotizacionCliente();
                ?>
            </form>
        </div>
    </div>
</div>