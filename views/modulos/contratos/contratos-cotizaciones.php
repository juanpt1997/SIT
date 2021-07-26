<?php
$tvehiculos = ControladorVehiculos::ctrMostrarTipoVehiculo();
$Sucursales = ControladorGH::ctrSucursales();
$Cotizaciones = ControladorCotizaciones::ctrVerCotizacion();
$clientes = ControladorClientes::ctrVerCliente();
$DeparMunicipios = ControladorGH::ctrDeparMunicipios();
?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark "><i><b>Gestión de cotizaciones</b></i></h1>
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
        <div class=container-fluid"">

            <hr class="my-4">

            <button type="button" class="btn btn-success btn-md btn-agregarcotizacion" data-toggle="modal" data-target="#cotizacionmodal">
                <i class="fas fa-user-plus"></i> Agregar nueva cotización
            </button>

            <div class="row mt-2">
                <div class="col-12">
                    <div class="card card-outline card-success">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-sm table-striped table-bordered dt-responsive table-hover tablasBtnExport w-100">
                                    <thead class="text-sm text-center text-nowrap">
                                        <tr>
                                            <th>...</th>
                                            <th style="width:10px;">ID</th>
                                            <th>Nombre contratante</th>
                                            <th>NIT/CC</th>
                                            <th>Dirección</th>
                                            <th>Teléfono 1</th>
                                            <th>Teléfono 2</th>
                                            <th>Nombre contacto</th>
                                            <th>Empresa</th>
                                            <th>Origen</th>
                                            <th>Destino</th>
                                            <th>Ruta</th>
                                            <th>Fecha recepción</th>
                                            <th>Fecha respuesta</th>
                                            <th>Fecha inicio</th>
                                            <th>Fecha final</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-sm">
                                        <?php foreach ($Cotizaciones as $key => $value) : ?>
                                            <tr>
                                                <td>
                                                    <div class="btn-group" role="group" aria-label="Button group">
                                                        <button class="btn btn-toolbar btn-sm btn-info btn-editarcotizacion" id_cot="<?= $value['idcotizacion'] ?>" document="<?= $value['Documento'] ?>" data-toggle="modal" data-target="#cotizacionmodal"><i class="fas fa-edit"></i></button>
                                                    </div>
                                                    <div class="btn-group" role="group" aria-label="Button group">
                                                        <button class="btn btn-toolbar btn-sm btn-primary btn-vercotizacion float-right" data-toggle="modal" data-target="#cotizacionmodal"><i class="fas fa-eye"></i></button>
                                                    </div>
                                                </td>
                                                <td><?= $value['idcotizacion'] ?></td>
                                                <td><?= $value['nombre'] ?></td>
                                                <td><?= $value['Documento'] ?></td>
                                                <td><?= $value['direccion'] ?></td>
                                                <td><?= $value['telefono'] ?></td>
                                                <td><?= $value['telefono2'] ?></td>
                                                <td><?= $value['nombrerespons'] ?></td>
                                                <td><?= $value['empresa'] ?></td>
                                                <td><?= $value['origen'] ?></td>
                                                <td><?= $value['destino'] ?></td>
                                                <td><?= $value['descripcion'] ?></td>
                                                <td><?= $value['fecha_solicitud'] ?></td>
                                                <td><?= $value['fecha_solucion'] ?></td>
                                                <td><?= $value['fecha_inicio'] ?></td>
                                                <td><?= $value['fecha_fin'] ?></td>
                                            </tr>
                                        <?php endforeach ?>
                                    </tbody>
                                </table>
                            </div>
                        </div><!-- card-body-->
                    </div><!-- card-->
                </div><!-- col-->
            </div><!-- row-->
        </div><!-- FIN container-fluid-->
    </div><!-- /.content -->
</div><!-- /.content-wrapper -->


<div class="modal fade" id="cotizacionmodal" tabindex="-1" data-backdrop="true" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

            <div class="modal-header bg-success">
                <h3 class="modal-title" id="titulo_cotizacion"></h3>
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

                    <hr class="my-4">

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
                                    <select class="form-control" id="listaclientes" style="width: 99%" name="listaclientes" readonly>
                                        <option value="" selected><b>-Seleccione un cliente existente-</b></option>
                                        <?php foreach ($clientes as $key => $value) : ?>
                                            <option value="<?= $value['idcliente'] ?>"><?= $value['clientexist'] ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="my-4">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="text-sm">Nombre de la empresa</label>
                                <div class="input-group input-group-sm">
                                    <input class="form-control input-clientes" type="text" min="0" id="nom_contrata" name="nom_contrata" placeholder="Ingrese el nombre de la empresa" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="text-sm">NIT/CC</label>
                                <div class="input-group input-group-sm">
                                    <input class="form-control input-clientes" type="text" min="0" id="document" name="document" placeholder="Ingrese el documento" required>
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
                                    <select class="form-control input-sm select2-single input-clientes" style="width: 99%" type="number" id="ciudadcliente" name="ciudadcliente" required>
                                        <option selected value="">-Seleccione una ciudad-</option>
                                        <?php foreach ($DeparMunicipios as $key => $value) : ?>
                                            <option value="<?= $value['idmunicipio'] ?>"><?= $value['DeparMunic'] ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="form-group">
                        <label class="text-sm">Dirección</label>
                        <div class="input-group input-group-sm">
                            <input class="form-control input-clientes" type="text" min="0" id="direcci" name="direcci" placeholder="Ingrese la dirección" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="text-sm">Teléfono 1</label>
                                <div class="input-group input-group-sm">
                                    <input class="form-control input-clientes" type="text" min="0" id="tel1" name="tel1" placeholder="Ingrese un teléfono" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="text-sm">Nombre del responsable</label>
                                <div class="input-group input-group-sm">
                                    <input class="form-control input-clientes" type="text" min="0" id="nom_respo" name="nom_respo" placeholder="Nombre del responsable" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="text-sm">Documento</label>
                                <div class="input-group input-group-sm">
                                    <input class="form-control input-clientes" type="text" min="0" id="docum_respo" name="docum_respo" placeholder="Documento del responsable" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="text-sm">Ciudad responsable</label>
                                <div class="input-group input-group-sm">
                                    <select class="form-control input-sm select2-single input-clientes" style="width: 99%" type="number" id="ciudadresponsable" name="ciudadresponsable" required>
                                        <option selected value="">-Seleccione una ciudad-</option>
                                        <?php foreach ($DeparMunicipios as $key => $value) : ?>
                                            <option value="<?= $value['idmunicipio'] ?>"><?= $value['DeparMunic'] ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>

                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="text-sm">Teléfono 2</label>
                                <div class="input-group input-group-sm">
                                    <input class="form-control input-clientes" type="text" min="0" id="tel2" name="tel2" placeholder="Ingrese un segundo teléfono" required>
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
                                    <select class="form-control input-sm select2-single input-clientes" style="width: 99%" type="number" id="expedicion" name="expedicion" required>
                                        <option selected value="">-Seleccione una ciudad-</option>
                                        <?php foreach ($DeparMunicipios as $key => $value) : ?>
                                            <option value="<?= $value['idmunicipio'] ?>"><?= $value['DeparMunic'] ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="my-4">

                    <div class="row">
              
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="text-sm">Empresa</label>
                                <div class="input-group input-group-sm">
                                    <input class="form-control" type="text" min="0" id="empres" name="empres" placeholder="Escriba el nombre de la empresa" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="text-sm">Fecha de solicitud</label>
                                <div class="input-group input-group-sm">
                                    <input class="form-control" type="date" min="0" id="f_sol" name="f_sol" required>
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
                                    <input class="form-control" type="number" min="0" id="capaci" name="capaci" placeholder="Digite la capacidad" required>
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
                                <label class="text-sm">Origen</label>
                                <div class="input-group input-group-sm">
                                    <input class="form-control" type="text" min="0" id="origin" name="origin" placeholder="Ingrese el origen" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="text-sm">Destino</label>
                                <div class="input-group input-group-sm">
                                    <input class="form-control" type="text" min="0" id="destin" name="destin" placeholder="Escriba el destino" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="text-sm">Fecha en que resuelve</label>
                                <div class="input-group input-group-sm">
                                    <input class="form-control" type="date" min="0" id="f_resuelve" name="f_resuelve" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="text-sm">Duración</label>
                                <div class="input-group input-group-sm">
                                    <input class="form-control" type="text" min="0" id="durac" name="durac" placeholder="Escriba la duración del viaje" required>
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
                                            <option value="<?= $value['idtipovehiculo'] ?>"><?= $value['tipovehiculo'] ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="text-sm">Valor por vehículo</label>
                                <div class="input-group input-group-sm">
                                    <input class="form-control" type="number" min="0" id="valor_vel" name="valor_vel" placeholder="Digite un valor por vehículo" required>
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
                                <label class="text-sm">Descripción de la solicitud</label>
                                <div class="input-group input-group-sm">
                                    <textarea class="form-control" type="text" id="des_sol" name="des_sol" placeholder="Describa la solicitud" style="min-height:70px"></textarea requiered>
                                </div>
                            </div>
                        </div>


                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="text-sm">Fecha de inicio</label>
                                <div class="input-group input-group-sm">
                                    <input class="form-control" type="date" min="0" id="f_inicio" name="f_inicio" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="text-sm">Fecha de final</label>
                                <div class="input-group input-group-sm">
                                    <input class="form-control" type="date" min="0" id="f_fin" name="f_fin" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="text-sm">Nro. de vehículos</label>
                                <div class="input-group input-group-sm">
                                    <input class="form-control" type="number" min="0" id="n_vehiculos" name="n_vehiculos" placeholder="Escriba el número de vehículos" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="text-sm">Valor total</label>
                                <div class="input-group input-group-sm">
                                    <input class="form-control" type="number" min="0" id="vtotal" name="vtotal" placeholder="Escriba el valor total" required>
                                </div>
                            </div>
                        </div>
                        
                    </div>

                    <hr class="my-4">

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

                <div class="modal-footer bg-dark">
                    <button type="button" class="btn btn-danger btn-cancelar" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save"></i>
                        Guardar
                    </button>
                </div>
                <?php
                $CrearCotizacion = new ControladorCotizaciones();
                $CrearCotizacion->ctrAgregarCotizacionCliente();
                ?>
            </form>
        </div>
    </div>
</div>