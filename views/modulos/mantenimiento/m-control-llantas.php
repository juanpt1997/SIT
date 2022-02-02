<?php

// if (!validarPermiso('CARGAR_OPCION', 'R')) {
//     echo "<script> window.location = 'inicio'; </script>";
// }
$Placas = ControladorVehiculos::ctrListaVehiculos();
$DeparMunicipios = ControladorGH::ctrDeparMunicipios();
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
                    <h1 class="m-0 text-dark "><strong><i>Control de llantas</i></strong> <i class="fas fa-truck-monster"></i></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                        <li class="breadcrumb-item active">Control de llantas</li>
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
                    <button type="button" class="btn bg-gradient-success btn-nuevoregistro-llantas" data-toggle="modal" data-target="#registro-llantas"><i class="fas fa-plus"></i> Ingresar registro</button>
                    <button type="button" class="btn bg-gradient-cyan btn-ordenTrabajo" data-toggle="modal" data-target="#ordenTrabajo_llantas"><i class="fas fa-briefcase"></i> Orden de trabajo</button>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-12">
                    <div class="card card-outline card-info">
                        <div class="card-header">
                            <strong><i>Listado general de llantas</i></strong>
                        </div>
                        <div class="card-body">

                            <div class="table-responsive">
                                <table class="table table-sm table-bordered table-striped text-center text-nowrap" id="tabla_llantas">
                                    <thead>
                                        <tr>
                                            <th>...</th>
                                            <th>Placa</th>
                                            <th>Número llanta</th>
                                            <th>Tamaño</th>
                                            <th>Marca</th>
                                            <th>Código</th>
                                            <th>Referencia</th>
                                            <th>Descripción</th>
                                            <th>Categoria</th>
                                            <th>Medida</th>
                                            <th>Vida</th>
                                            <th>Fecha montaje</th>
                                            <th>Kilometraje montaje</th>
                                            <th>Lonas</th>
                                            <th>Estado actual</th>
                                            <th>Fecha factura</th>
                                            <th>Número de factura</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody_tabla_llantas">
                                    </tbody>
                                </table>
                            </div>

                        </div>
                        <div class="card-footer bg-dark"></div>
                    </div>
                </div>
            </div>

        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<div id="registro-llantas" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="registro-llantas-title" aria-hidden="true" style="overflow-y: scroll;">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">

            <div class="modal-header bg-gradient-info">
                <h4 class="modal-title" id="registro-llantas-title">Registrar llanta</h4>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form id="formulario_LlantasControl" method="post" enctype="multipart/form-data">
                <div class="modal-body">

                    <h4><i class="fas fa-angle-double-right"></i> <b><i>Asociar llanta a vehículo</i></b></h4>

                    <hr class="my-4 bg-dark">

                    <input type="hidden" name="id_llanta" id="id_llanta" value="">

                    <div class="form-group">
                        <label><i>Lista de LLantas</i></label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="my-addon"><i class="fas fa-list"></i></span>
                            </div>
                            <!-- <input class="form-control" type="number" id="num_llanta" max="9999" name="num_llanta" required> -->
                            <select class="custom-select rounded-0 input_producto select2-single" id="num_llanta" name="num_llanta" required>
                            </select>
                            <div class="input-group-append">
                                <a><button type="button" class="btn btn-success btn-md btn_add_llanta" title="Crear nueva llanta" data-toggle="tooltip" data-placement="top"><i class="fas fa-plus"></i></button></a>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label><i>Descripción</i></label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="my-addon"><i class="fas fa-align-left"></i></span>
                            </div>
                            <input type="text" class="form-control input_producto" id="descripcion" name="descripcion" placeholder="Descripción o nombre del producto" required readonly>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label>Tamaño</label>
                                <div class="input-group">
                                    <select id="tama_llanta" name="tama_llanta" class="custom-select rounded-0" type="number" required readonly>
                                    </select>
                                    <div class="input-group-append">
                                        <a href="cg-almacen" target="_blank"><button type="button" class="btn btn-success btn-md" title="Crear nuevo tamaño de llantas" data-toggle="tooltip" data-placement="top"><i class="fas fa-plus"></i></button></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label for="referencia">Referencia</label>
                                <div class="input-group">
                                    <input class="form-control" type="text" id="referencia" max="9999" name="referencia" required readonly>
                                </div>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label><i>Marca</i></label>
                                <div class="input-group">
                                    <select class="custom-select rounded-0 input_producto" id="marca" name="marca" required readonly>
                                    </select>
                                    <div class="input-group-append">
                                        <a href="cg-almacen" target="_blank"><button type="button" class="btn btn-success btn-md" title="Crear nueva marca" data-toggle="tooltip" data-placement="top"><i class="fas fa-plus"></i></button></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label><i>Categoría</i></label>
                                <div class="input-group">
                                    <select class="custom-select rounded-0" id="categoria" name="categoria" required readonly>
                                    </select>
                                    <div class="input-group-append">
                                        <a href="cg-almacen" target="_blank"><button type="button" class="btn btn-success btn-md" title="Crear nueva categoria" data-toggle="tooltip" data-placement="top"><i class="fas fa-plus"></i></button></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label><i>Medida</i></label>
                                <div class="input-group">
                                    <select class="custom-select rounded-0 input_producto" id="medida" name="medida" required readonly>
                                    </select>
                                    <div class="input-group-append">
                                        <a href="cg-almacen" target="_blank"><button type="button" class="btn btn-success btn-md" title="Crear nueva medida" data-toggle="tooltip" data-placement="top"><i class="fas fa-plus"></i></button></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="my-4">

                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label><i>Sucursal</i></label>
                                <select id="sucursal" name="sucursal" class="form-control select2-single" type="number" style="width: 99%" required>
                                </select>
                            </div>
                        </div>

                        <div class="col-3">
                            <div class="form-group">
                                <label for="vida_util">Vida</label>
                                <div class="input-group">
                                    <input class="form-control" type="text" id="vida_util" max="9999" name="vida_util" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-3" id="col_cantidad">
                            <div class="form-group">
                                <label for="cantidad">Cantidad de llantas a vincular</label>
                                <div class="input-group">
                                    <input class="form-control" type="number" id="cantidad" max="9999" name="cantidad" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-3 d-none" id="col_num_llanta">
                            <div class="form-group">
                                <label for="cantidad">Número de llanta</label>
                                <div class="input-group">
                                    <input class="form-control" type="number" id="numero_llanta_edit" max="9999" name="numero_llanta_edit">
                                </div>
                            </div>
                        </div>


                    </div>

                    <hr class="my-4 bg-dark d-none" id="hr-llantas">

                    <div class="row" id="inputs_numero_llantas">

                    </div>

                    <hr class="my-4 bg-dark">

                    <div class="form-group">
                        <label><i>PLACA del vehículo a relacionar</i></label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-car-side"></i></span>
                            </div>
                            <select id="placa" name="placa" class="form-control select2-single" type="number" required>
                                <option value="" selected><b>-Lista de placas-</b></option>
                                <?php foreach ($Placas as $key => $value) : ?>
                                    <option value="<?= $value['idvehiculo'] ?>"><?= $value['placa'] ?> - <?= $value['numinterno'] ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="fecha_factura">Fecha factura</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-calendar-week"></i></span>
                                    </div>
                                    <input class="form-control" type="date" id="fecha_factura" name="fecha_factura" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label for="num_factura">Núm. Factura</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-bars"></i></span>
                                    </div>
                                    <input class="form-control" type="number" id="num_factura" name="num_factura" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label for="precio">Precio de compra</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                                    </div>
                                    <input class="form-control" type="number" id="precio" name="precio" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label>Proveedor</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-truck"></i></span>
                                    </div>
                                    <select class="select2-single rounded-0" id="proveedor" name="proveedor" required>
                                    </select>
                                    <div class="input-group-append">
                                        <a href="c-proveedores" target="_blank"><button type="button" class="btn btn-success btn-md" title="Crear nuevo proveedor" data-toggle="tooltip" data-placement="top"><i class="fas fa-plus"></i></button></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label for="observaciones">Observaciones</label>
                                <textarea class="form-control" name="observaciones_salida" id="observaciones_salida" rows="2"></textarea>
                            </div>
                        </div>

                    </div>

                    <hr class="my-4 bg-dark">

                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="fecha_montaje">Fecha montaje</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-calendar-week"></i></span>
                                    </div>
                                    <input class="form-control" type="date" id="fecha_montaje" name="fecha_montaje" required>
                                </div>
                            </div>
                        </div>


                        <div class="col-6">
                            <div class="form-group">
                                <label for="kilo_montaje">Kilometraje montaje</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-tachometer-alt"></i></span>
                                    </div>
                                    <input class="form-control" type="number" id="kilo_montaje" max="9999" name="kilo_montaje" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label for="lonas">Lonas</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-poll"></i></span>
                                    </div>
                                    <input class="form-control" type="number" id="lonas" max="9999" name="lonas" required>
                                </div>
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-group">
                                <label>Estado actual llanta</label>

                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-toggle-on"></i></span>
                                    </div>
                                    <select id="estado" name="estado" class="form-control" type="text" required>
                                        <option value="" selected><b>-Seleccione el estado actual-</b></option>
                                        <option value="montada">Montada</option>
                                        <option value="desmontada">Desmontada</option>
                                    </select>
                                </div>
                            </div>
                        </div>


                    </div>

                </div>
            </form>

            <div class="modal-footer bg-gradient-dark">
                <div class="form-group">
                    <button type="submit" class="btn bg-gradient-info btn_actualizarllanta d-none" form="formulario_LlantasControl"><i class="fas fa-sync-alt"></i> Actualizar</button>
                    <button type="submit" class="btn bg-gradient-success btn-guardar-registro-llantas" form="formulario_LlantasControl"><i class="fas fa-share"></i> Guardar</button>
                    <button type="button" class="btn bg-gradient-danger btn_cancelarRegistro" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="seguimiento-llantas" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="seguimiento-llantas-title" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

            <div class="modal-header bg-gradient-info">
                <h5 class="modal-title" id="seguimiento-llantas-title">Registrar inspección</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="fecha_montaje">Fecha inspección</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-calendar-week"></i></span>
                                </div>
                                <input class="form-control" type="date" id="fecha_inspeccion" name="fecha_inspeccion" required>
                            </div>
                        </div>
                    </div>


                    <div class="col-6">
                        <div class="form-group">
                            <label for="kilo_invent">Kilometraje inspección</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-tachometer-alt"></i></span>
                                </div>
                                <input class="form-control" type="number" id="kilo_inspeccion" max="9999" name="kilo_inspeccion" required>
                            </div>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-group">
                            <label for="prof_inter">Profundidad interna</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-sort-amount-down-alt"></i></span>
                                </div>
                                <input class="form-control" type="number" id="prof_inter" max="9999" name="prof_inter" required>
                            </div>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-group">
                            <label for="prof_exter">Profundidad externa</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-sort-amount-up-alt"></i></span>
                                </div>
                                <input class="form-control" type="number" id="prof_exter" max="9999" name="prof_exter" required>
                            </div>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-group">
                            <label for="promedio">Promedio</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-percentage"></i></span>
                                </div>
                                <input class="form-control" type="number" id="promedio" max="9999" name="promedio" required>
                            </div>
                        </div>
                    </div>

                </div>


            </div>

            <div class="modal-footer bg-gradient-dark">
                <button type="submit" class="btn bg-gradient-success btn-guardar-seguimiento"><i class="fas fa-share"></i> Guardar</button>
                <button type="button" class="btn bg-gradient-danger" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>

<div id="crear_llanta" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="crear_llanta-title" aria-hidden="true" style="overflow-y: scroll;">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">

            <div class="modal-header bg-gradient-info">
                <h4 class="modal-title" id="crear_llanta-title">Crear nueva llanta</h4>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form id="formulario_crear_nuevaLlanta" method="post" enctype="multipart/form-data">
                <div class="modal-body">

                    <hr class="my-4 bg-dark">

                    <input type="hidden" name="id_llanta" id="id_llanta" value="">




                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label><i>Código de LLanta</i></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="my-addon"><i class="fas fa-list"></i></span>
                                    </div>
                                    <input class="form-control" type="number" id="nuevo_num_llanta" max="9999" name="nuevo_num_llanta" required>
                                </div>

                            </div>
                        </div>

                        <div class="col">
                            <div class="form-group">
                                <label><i>Descripción</i></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="my-addon"><i class="fas fa-align-left"></i></span>
                                    </div>
                                    <input type="text" class="form-control input_producto" id="nuevo_descripcion" name="nuevo_descripcion" placeholder="Descripción / Nombre de llanta" required>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="my-4">

                    <div class="row">

                        <div class="col-6">
                            <div class="form-group">
                                <label>Tamaño</label>
                                <div class="input-group">
                                    <select id="nuevo_tama_llanta" name="nuevo_tama_llanta" class="custom-select rounded-0" type="number" required>
                                    </select>
                                    <div class="input-group-append">
                                        <a href="cg-almacen" target="_blank"><button type="button" class="btn btn-success btn-md" title="Crear nuevo tamaño de llantas" data-toggle="tooltip" data-placement="top"><i class="fas fa-plus"></i></button></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label><i>Marca</i></label>
                                <div class="input-group">
                                    <select class="custom-select rounded-0 input_producto" id="marca2" name="marca2" required>
                                    </select>
                                    <div class="input-group-append">
                                        <a href="cg-almacen" target="_blank"><button type="button" class="btn btn-success btn-md" title="Crear nueva marca" data-toggle="tooltip" data-placement="top"><i class="fas fa-plus"></i></button></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label><i>Categoría</i></label>
                                <div class="input-group">
                                    <select class="custom-select rounded-0" id="categoria2" name="categoria2" required>
                                    </select>
                                    <div class="input-group-append">
                                        <a href="cg-almacen" target="_blank"><button type="button" class="btn btn-success btn-md" title="Crear nueva categoria" data-toggle="tooltip" data-placement="top"><i class="fas fa-plus"></i></button></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label><i>Medida</i></label>
                                <div class="input-group">
                                    <select class="custom-select rounded-0 input_producto" id="medida2" name="medida2" required>
                                    </select>
                                    <div class="input-group-append">
                                        <a href="cg-almacen" target="_blank"><button type="button" class="btn btn-success btn-md" title="Crear nueva medida" data-toggle="tooltip" data-placement="top"><i class="fas fa-plus"></i></button></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label for="kilo_invent">Referencia</label>
                                <div class="input-group">
                                    <input class="form-control" type="text" id="nuevo_referencia" max="9999" name="nuevo_referencia" required>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </form>

            <div class="modal-footer">
                <div class="form-group">
                    <button type="submit" class="btn bg-gradient-success btn_nueva_llanta" form="formulario_crear_nuevaLlanta"><i class="fas fa-share"></i> Agregar</button>
                    <button type="button" class="btn bg-gradient-danger btn_cancelar_add" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="ordenTrabajo_llantas" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="ordenTrabajo_llantas-title" aria-hidden="true" style="overflow-y: scroll;">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">

            <div class="modal-header bg-gradient-info">
                <h4 class="modal-title" id="ordenTrabajo_llantas-title">Orden de trabajo para llantas <i class="fas fa-cog"></i></h4>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <h5>Buscar llantas montadas en vehículos</h5>
                <hr>
                <div class="form-group">
                    <label><i>Vehículo</i></label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-car-side"></i></span>
                        </div>
                        <select id="placa_orden" name="placa_orden" class="form-control select2-single" type="number" required>
                            <option value="" selected><b>-Lista de placas-</b></option>
                            <?php foreach ($Placas as $key => $value) : ?>
                                <option value="<?= $value['idvehiculo'] ?>"><?= $value['placa'] ?> - <?= $value['numinterno'] ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                </div>

                <hr>

                <h5><strong>Ubicación</strong></h5>

                <div class="row">
                    <div class="col-5">
                        <div class="jumbotron jumbotron-fluid">
                            <div class="text-center">
                                <img src="./views/img/llantas/ubicacion.png" class="img-fluid">
                            </div>
                        </div>
                    </div>
                    <div class="col-7">
                        <div class="row" id="row_listaDatos">

                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <label> Alineación de vehículo  </label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" value="1" id="si_ali" name="alineacion">
                            <label class="form-check-label text-nowrap">
                                <b>Si</b>
                            </label>
                        </div>
    
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" value="0" id="no_ali" name="alineacion">
                            <label class="form-check-label text-nowrap">
                                <b>No</b>
                            </label>
                        </div>
                    </div>
                </div>



                <hr>
                <div class="table-responsive">
                    <table class="table table-sm table-bordered table-striped text-center text-nowrap" id="tabla_ordenTrabajo_llanta">
                        <thead>
                            <tr>
                                <th colspan="11"></th>
                                <th colspan="6">Ubicación final</th>
                            </tr>
                            <tr>
                                <th>ID llanta</th>
                                <th>Núm. Llanta</th>
                                <th>Marca</th>
                                <th>Banda</th>
                                <th>Tamaño</th>
                                <th>Prof 1</th>
                                <th>Prof 2</th>
                                <th>Prof 3</th>
                                <th>Promedio</th>
                                <th>Presión</th>
                                <th>Trabajo realizado</th>
                                <th>1</th>
                                <th>2</th>
                                <th>3</th>
                                <th>4</th>
                                <th>5</th>
                                <th>6</th>
                            </tr>
                        </thead>
                        <tbody id="tbody_tabla_ordenTrabajo">

                        </tbody>
                    </table>
                </div>
            </div>

            <div class="modal-footer modal-footer bg-gradient-dark">
                <div class="form-group">
                    <button type="submit" class="btn bg-gradient-success btn_agregarOrden"><i class="fas fa-share"></i> Agregar</button>
                    <button type="button" class="btn bg-gradient-danger btn_cancelarOrden" data-dismiss="modal">Cancelar</button>
                </div>
            </div>

        </div>
    </div>
</div>

<div id="trabajosRealizados" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="trabajosRealizados-title" aria-hidden="true" style="overflow-y: scroll;">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">

            <div class="modal-header bg-gradient-info">
                <h5 class="modal-title" id="trabajosRealizados-title">Lista de trabajos</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-sm table-bordered table-striped text-center text-nowrap" id="tablaTrabajos">
                        <thead>
                            <tr>
                                <th>Trabajo</th>
                                <th>Selección</th>
                            </tr>
                        </thead>
                        <tbody id="tbody_tablaTrabajos">

                        </tbody>
                    </table>
                </div>
            </div>

            <div class="modal-footer modal-footer bg-gradient-dark">
                <div class="form-group">
                    <a href="cg-mantenimiento" target="_blank"><span class="badge badge-info badge-md">Nuevo trabajo</span></a>
                    <button type="button" class="btn btn-sm bg-gradient-danger btn_cancelarTrabajo" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
</div>