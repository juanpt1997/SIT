<?php

if (!validarPermiso('M_CONTRATOS', 'R')) {
    echo "<script> window.location = 'inicio'; </script>";
}

$cotizaciones = ControladorCotizaciones::ctrVerCotizacion();
$listaordenes = ControladorOrdenServicio::ctrVerListaOrden();
?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark "><i><b>Gestión de Órdenes de servicio <i class="fas fa-folder-plus"></i></b></i></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                        <li class="breadcrumb-item active">Órdenes de servicio</li>
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

            <button type="button" class="btn btn-success btn-md btn-agregarorden" data-toggle="modal" data-target="#ordenserviciomodal">
                <i class="fas fa-book"></i> Agregar nueva Orden
            </button>

            <div class="row mt-2">
                <div class="col-12">
                    <div class="card card-outline card-success">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="tblOrdenServicio" class="table table-sm table-striped table-bordered table-hover w-100">
                                    <thead class="text-sm text-center text-nowrap">
                                        <tr>
                                            <th>...</th>
                                            <th>PDF</th>
                                            <th style="min-width:90px;">ID</th>
                                            <th>Nombre contratante</th>
                                            <th>NIT/CC</th>
                                            <th>Dirección</th>
                                            <th>Teléfono 1</th>
                                            <th>Teléfono 2</th>
                                            <th>Nombre del contacto</th>
                                            <th>Correo</th>
                                            <th>Número del contrato</th>
                                            <th>Número de la factura</th>
                                            <th>Fecha de facturación</th>
                                            <th>Código de autorización</th>
                                            <th>Fecha de inicio</th>
                                            <th>Fecha final</th>
                                            <th>Origen</th>
                                            <th>Destino</th>
                                            <th>Hora inicio</th>
                                            <th>Hora final</th>
                                            <th>Valor a facturar</th>
                                            <th>Ruta</th>
                                            <th>Música</th>
                                            <th>Bodega</th>
                                            <th>Baño</th>
                                            <th>Wi-fi</th>
                                            <th>Aire acondicionado</th>
                                            <th>Silleteria reclinable</th>
                                            <th>Viaje ocasional</th>
                                            <th>Cancelada</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-sm">
                                        <?php foreach ($listaordenes as $key => $value) : ?>
                                            <tr>
                                                <td class="text-center">
                                                    <div class="btn-group" role="group" aria-label="Button group">
                                                        <button class="btn btn-toolbar btn-sm btn-info btn-editarorden" data-toggle="modal" data-target="#ordenserviciomodal" idorden="<?= $value['idorden'] ?>"><i class="fas fa-edit"></i></button>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <div class="btn-group" role="group" aria-label="Button group">
                                                        <button class="btn btn-toolbar btn-sm btn-secondary btn-verorden float-right" idorden="<?= $value['idorden'] ?>"><i class="fas fa-book"></i></button>
                                                    </div>
                                                </td>
                                                <td><?= $value['idorden'] ?></td>
                                                <td><?= $value['nomContrata'] ?></td>
                                                <td><?= $value['doContrata'] ?></td>
                                                <td><?= $value['direccion_con'] ?></td>
                                                <td><?= $value['tel_1'] ?></td>
                                                <td><?= $value['tel_2'] ?></td>
                                                <td><?= $value['nombre_respo'] ?></td>
                                                <td><?= $value['correo'] ?></td>
                                                <td><?= $value['nro_contrato'] ?></td>
                                                <td><?= $value['nro_factura'] ?></td>
                                                <td><?= $value['fecha_facturacion'] ?></td>
                                                <td><?= $value['cod_autoriz'] ?></td>
                                                <td><?= $value['fecha_inicio'] ?></td>
                                                <td><?= $value['fecha_fin'] ?></td>
                                                <td><?= $value['origen'] ?></td>
                                                <td><?= $value['destino'] ?></td>
                                                <td><?= $value['hora_salida'] ?></td>
                                                <td><?= $value['hora_recogida'] ?></td>
                                                <td><?= $value['valortotal'] ?></td>
                                                <td><?= $value['descripcion'] ?></td>
                                                <td><?= $value['musica'] ?></td>
                                                <td><?= $value['bodega'] ?></td>
                                                <td><?= $value['bano'] ?></td>
                                                <td><?= $value['wifi'] ?></td>
                                                <td><?= $value['aire'] ?></td>
                                                <td><?= $value['silleriareclinable'] ?></td>
                                                <td><?= $value['viaje_ocasional'] ?></td>
                                                <td><?= $value['cancelada'] ?></td>
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


<div class="modal fade" id="ordenserviciomodal" tabindex="-1" data-backdrop="true" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

            <div class="modal-header bg-info">
                <h3 class="modal-title" id="titulo_orden"></h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form method="post" enctype="multipart/form-data" id="formulario_orden">

                <div class="modal-body">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="text-sm">ID</label>
                            <div class="input-group input-group-sm">
                                <input class="form-control" type="number" id="idorden" name="idorden" readonly>
                            </div>
                        </div>
                    </div>

                    <hr class="my-4 bg-success">

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="text-sm"><i>Cotizaciones</i></label>
                            <div class="input-group input-group-sm">
                                <select class="form-control select2-single" id="listacotizaciones" style="width: 99%" name="listacotizaciones">
                                    <option value="" selected><b>-Seleccione una cotización disponible-</b></option>
                                    <?php foreach ($cotizaciones as $key => $value) : ?>
                                        <option value="<?= $value['idcotizacion'] ?>"><?= $value['clientexist'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <hr class="my-4 bg-dark">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="text-sm">Nombre del contratante</label>
                                <div class="input-group input-group-sm">
                                    <input class="form-control input-clientes" type="text" id="nomcontrataorden" name="nomcontrataorden" placeholder="Ingrese el nombre del contratante" required readonly>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="text-sm">NIT/CC</label>
                                <div class="input-group input-group-sm">
                                    <input class="form-control" type="text" id="documentorden" name="documentorden" placeholder="Ingrese el documento" maxlength="45" required readonly>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="text-sm">Dirección</label>
                        <div class="input-group input-group-sm">
                            <input class="form-control" type="text" id="direcciorden" name="direcciorden" placeholder="Ingrese la dirección" required readonly>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="text-sm">Teléfono 1</label>
                                <div class="input-group input-group-sm">
                                    <input class="form-control input-clientes" type="text" id="telefono1" name="telefono1" placeholder="Ingrese un teléfono" maxlength="10" required readonly>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="text-sm">Teléfono 2</label>
                                <div class="input-group input-group-sm">
                                    <input class="form-control" type="text" id="telefono2" name="telefono2" placeholder="Ingrese un segundo teléfono" maxlength="10" required readonly>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="text-sm">Nombre del contacto</label>
                        <div class="input-group input-group-sm">
                            <input class="form-control" type="text" id="nomcontacto" name="nomcontacto" placeholder="Ingrese el nombre del contacto" required readonly>
                        </div>
                    </div>

                    <hr class="my-4 bg-dark">

                    <div class="form-group">
                        <label class="text-sm">Número del contrato</label>
                        <div class="input-group input-group-sm">
                            <input class="form-control" type="number" id="numcontrato" name="numcontrato" placeholder="Ingrese el número  del contrato" maxlength="10" required>
                        </div>
                    </div>

                    <hr class="my-4 bg-dark">

                    <div class="row">

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="text-sm">Fecha de inicio</label>
                                <div class="input-group input-group-sm">
                                    <input class="form-control" type="date" id="f_inicio_orden" name="f_inicio_orden" required readonly>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="text-sm">Fecha de final</label>
                                <div class="input-group input-group-sm">
                                    <input class="form-control" type="date" id="f_fin_orden" name="f_fin_orden" required readonly>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="text-sm">Destino</label>
                                <div class="input-group input-group-sm">
                                    <input class="form-control" type="text" id="destino_orden" name="destino_orden" placeholder="Escriba el destino" required readonly>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="text-sm">Hora de inicio</label>
                                <div class="input-group input-group-sm">
                                    <input class="form-control" type="time" id="h_incio_orden" name="h_incio_orden" step="any" required readonly>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="text-sm">Hora de final</label>
                                <div class="input-group input-group-sm">
                                    <input class="form-control" type="time" id="h_final_orden" name="h_final_orden" step="any" required readonly>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="text-sm">Origen</label>
                                <div class="input-group input-group-sm">
                                    <input class="form-control" type="text" id="origen_orden" name="origen_orden" placeholder="Ingrese el origen" required readonly>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="text-sm">Valor a facturar</label>
                                <div class="input-group input-group-sm">
                                    <input class="form-control" type="number" id="valor_facturar" name="valor_facturar" placeholder="Ingrese el valor a facturar" required readonly>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-8">
                            <div class="form-group">
                                <label class="text-sm">Ruta</label>
                                <div class="input-group input-group-sm">
                                    <input class="form-control" type="text" id="ruta_orden" name="ruta_orden" placeholder="Describa la ruta a seguir" required readonly>
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
                                    <select class="form-control" type="text" id="musica_orden" name="musica_orden" required readonly>
                                        <option value="" selected>-Seleccione una opción-</option>
                                        <option>SI</option>
                                        <option>NO</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="text-sm">Bodega</label>
                                <div class="input-group input-group-sm">
                                    <select class="form-control" type="text" id="bodega_orden" name="bodega_orden" required readonly>
                                        <option value="" selected>-Seleccione una opción-</option>
                                        <option>SI</option>
                                        <option>NO</option>
                                    </select>
                                </div>
                            </div>



                            <div class="form-group">
                                <label class="text-sm">Otro</label>
                                <div class="input-group input-group-sm">
                                    <select class="form-control" type="text" id="otro_orden" name="otro_orden" required readonly>
                                        <option value="" selected>-Seleccione una opción-</option>
                                        <option>SI</option>
                                        <option>NO</option>
                                    </select>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-4">

                            <div class="form-group">
                                <label class="text-sm">Baño</label>
                                <div class="input-group input-group-sm">
                                    <select class="form-control" type="text" id="baño" name="baño" required readonly>
                                        <option value="" selected>-Seleccione una opción-</option>
                                        <option>SI</option>
                                        <option>NO</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="text-sm">Wi-Fi</label>
                                <div class="input-group input-group-sm">
                                    <select class="form-control" type="text" id="wi_fi" name="wi_fi" required readonly>
                                        <option value="" selected>-Seleccione una opción-</option>
                                        <option>SI</option>
                                        <option>NO</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-group">
                                <label class="text-sm">Aire acondicionado</label>
                                <div class="input-group input-group-sm">
                                    <select class="form-control" type="text" id="aire" name="aire" required readonly>
                                        <option value="" selected>-Seleccione una opción-</option>
                                        <option>SI</option>
                                        <option>NO</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="text-sm">Silleteria Reclinable</label>
                                <div class="input-group input-group-sm">
                                    <select class="form-control" type="text" id="silleteria_orden" name="silleteria_orden" required readonly>
                                        <option value="" selected>-Seleccione una opción-</option>
                                        <option>SI</option>
                                        <option>NO</option>
                                    </select>
                                </div>
                            </div>
                        </div>


                    </div>

                    <hr class="my-4 bg-dark">

                    <div class="form-group">
                        <label class="text-sm">Número de la factura</label>
                        <div class="input-group input-group-sm">
                            <input class="form-control" type="text" id="numfacturaorden" name="numfacturaorden" placeholder="Ingrese el número de la factura" maxlength="30" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="text-sm">Fecha de facturación</label>
                        <div class="input-group input-group-sm">
                            <input class="form-control" type="date" id="f_facturacion" name="f_facturacion" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <hr class="my-4">
                                <label class="text-sm">Cancelada</label>
                                <div class="input-group input-group-sm">
                                    <select class="form-control" type="text" id="cancelacion" name="cancelacion" required>
                                        <option value="" selected>-Seleccione una opción-</option>
                                        <option>SI</option>
                                        <option>NO</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <hr class="my-4">
                            <div class="form-group">
                                <label class="text-sm">Código de autorización</label>
                                <div class="input-group input-group-sm">
                                    <input class="form-control" type="number" id="cod_autorizacion" name="cod_autorizacion" placeholder="Ingrese el codigo de autorización" maxlength="30" required>
                                </div>
                            </div>
                        </div>
                    </div>

                </div><!-- fin modal-body-->

                <div class="modal-footer bg-dark">
                    <button type="button" class="btn btn-danger btn-cancelar" data-dismiss="modal">Cancelar</button>
                    <?php if (validarPermiso('M_CONTRATOS', 'U')) : ?>
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-save"></i>
                            Guardar
                        </button>
                    <?php endif ?>
                </div>
                <?php
                $CrearOrden = new ControladorOrdenServicio();
                $CrearOrden->ctrAgregarEditarOrden();
                ?>
            </form>
        </div>
    </div>
</div>