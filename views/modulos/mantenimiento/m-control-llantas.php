<?php

// if (!validarPermiso('CARGAR_OPCION', 'R')) {
//     echo "<script> window.location = 'inicio'; </script>";
// }
$Placas = ControladorVehiculos::ctrListaVehiculos();
$DeparMunicipios = ControladorGH::ctrDeparMunicipios();
?>

<style>
    .switch {
        position: relative;
        display: inline-block;
        width: 60px;
        height: 34px;
    }

    /* Hide default HTML checkbox */
    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    /* The slider */
    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: .4s;
        transition: .4s;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 26px;
        width: 26px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
    }

    input:checked+.slider {
        background-color: #2196F3;
    }

    input:focus+.slider {
        box-shadow: 0 0 1px #2196F3;
    }

    input:checked+.slider:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
    }

    /* Rounded sliders */
    .slider.round {
        border-radius: 34px;
    }

    .slider.round:before {
        border-radius: 50%;
    }

    /* Chrome, Safari, Edge, Opera */
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    /* Firefox */
    input[type=number] {
        -moz-appearance: textfield;
    }
</style>
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
                    <div class="form-group">
                        <button type="button" class="btn bg-gradient-success btn-nuevoregistro-llantas mb-2 mr-2" data-toggle="modal" data-target="#registro-llantas"><i class="fas fa-clipboard-check"></i> Registrar llantas a vehículo</button>
                        <button type="button" class="btn bg-gradient-cyan btn-ordenTrabajo mb-2 mr-2" data-toggle="modal" data-target="#ordenTrabajo_llantas"><i class="fas fa-briefcase"></i> Crear orden de trabajo</button>
                    </div>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-12">
                    <div class="card card-navy card-tabs">
                        <div class="card-header p-0 border-bottom-0">
                            <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="custom-tabs-four-home-tab" data-toggle="pill" href="#custom-tabs-four-home" role="tab" aria-controls="custom-tabs-four-home" aria-selected="true"><i class="fas fa-angle-double-right"></i> Llantas en vehículos</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="custom-tabs-four-profile-tab" data-toggle="pill" href="#custom-tabs-four-profile" role="tab" aria-controls="custom-tabs-four-profile" aria-selected="false"><i class="fas fa-angle-double-right"></i> Órdenes de trabajo</a>
                                </li>
                            </ul>
                        </div>

                        <div class="card-body">
                            <div class="tab-content" id="custom-tabs-four-tabContent">
                                <div class="tab-pane fade show active" id="custom-tabs-four-home" role="tabpanel" aria-labelledby="custom-tabs-four-home-tab">
                                    <div class="table-responsive">
                                        <table class="table table-sm table-bordered table-striped text-center text-nowrap" id="tabla_llantas">
                                            <thead>
                                                <tr>
                                                    <th>...</th>
                                                    <th>Placa</th>
                                                    <th>Número llanta</th>
                                                    <th>Ubicación actual</th>
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
                                <div class="tab-pane fade" id="custom-tabs-four-profile" role="tabpanel" aria-labelledby="custom-tabs-four-profile-tab">
                                    <div class="table-responsive">
                                        <table class="datatable-multi-row table table-sm table-bordered table-striped text-center text-nowrap w-100" id="tabla_controlOrdenes">
                                            <thead>
                                                <tr>
                                                    <th>Núm. Orden</th>
                                                    <th>Acciones</th>
                                                    <th>ID llanta</th>
                                                    <th>Núm. Llanta</th>
                                                    <th>Ubicación anterior</th>
                                                    <th>Ubicación actual</th>
                                                    <th>Fecha orden</th>
                                                    <th>Placa del vehículo</th>
                                                    <th>Núm. Interno</th>
                                                    <th>Alineación</th>
                                                    <th>Kilometraje de inspección</th>
                                                    <th>Proveedor servicio</th>
                                                    <th>Promedio de profundidad (mm)</th>
                                                    <th>Presión de aire</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tbody_controlOrdenes">
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
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
                <h4 class="modal-title" id="registro-llantas-title">Registro de llantas</h4>
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
                            <!-- <input class="form-control" type="number" id="num_llanta" max="999999" name="num_llanta" required> -->
                            <!-- <select class="custom-select rounded-0 input_producto select2-single" id="num_llanta" name="num_llanta" required>
                            </select> -->

                            <input class="form-control" type="text" placeholder="Seleccione una llanta de la lista para asociarla a un vehículo" id="datos_llanta" name="datos_llanta" readonly required>
                            <input class="form-control" type="hidden" id="num_llanta" name="num_llanta">

                            <div class="input-group-append">
                                <div class='btn-group' role='group' aria-label='Button group'>
                                    <button title='Abrir lista de llantas' data-toggle='tooltip' data-placement='top' type="button" class='btn btn-info btn-md btn_listarLlantas'><i class="fas fa-clipboard-list"></i></button>
                                </div>
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
                                    <input class="form-control" type="text" id="referencia" max="999999" name="referencia" required readonly>
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

                        <div class="col-md-12 col-lg-3 col-xl-3 col-sm-12 ">
                            <div class="form-group">
                                <label for="vida_util">Vida(Km/h)</label>
                                <div class="input-group">
                                    <input class="form-control" type="text" id="vida_util" max="999999" name="vida_util" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 col-lg-3 col-xl-3 col-sm-12 col-xs-12" id="col_cantidad">
                            <div class="form-group">
                                <label for="cantidad">Cantidad de llantas a vincular</label>
                                <div class="input-group">
                                    <input class="form-control" type="number" id="cantidad" max="999999" name="cantidad" required>
                                </div>
                            </div>
                            <label><span class="badge badge-light">Agregar llanta de repuesto</span></label>
                            <label class="switch">
                                <input type="checkbox" id="agregar_llanta_repuesto">
                                <span class="slider round"></span>
                            </label>
                        </div>

                        <div class="col-3 d-none" id="col_num_llanta">
                            <div class="form-group">
                                <label for="cantidad">Número de llanta</label>
                                <div class="input-group">
                                    <input class="form-control" type="number" id="numero_llanta_edit" max="999999" name="numero_llanta_edit">
                                </div>
                            </div>
                        </div>


                    </div>

                    <hr class="my-4 bg-dark">
                    <div class="text-center">
                        <h5 id="titulo_ubicacionLlantas"><b>Ubicación de las llantas</b></h5>
                        <div><img src="./views/img/llantas/ubicacion.png" class="img-fluid" id="img_llantas_6"></div>
                        <div><img src="./views/img/llantas/llantas_4.png" class="img-fluid d-none" id="img_llantas_4"></div>

                        <hr class="my-4 bg-dark d-none" id="linea_llanta_repuesto">

                        <div class="row d-none" id="input_llanta_repuesto">
                            <div class="col-4"></div>
                            <div class="col-4">
                                <div class="form-group"><label for="llanta_repuesto">Número llanta de REPUESTO</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-hashtag"></i></span></div><input class="form-control" type="number" id="llanta_repuesto" name="llanta_repuesto">
                                    </div>
                                </div>
                            </div>
                            <div class="col-4"></div>
                        </div>
                    </div>

                    <div class="row" id="inputs_numero_llantas">

                    </div>

                    <div class="row d-none" id="input_ubicacion_llanta">
                        <div class="col-4"></div>
                        <div class="col-4">
                            <div class="form-group text-center"><label for="ubicacion_llanta">Ubicación</label>
                                <div class="input-group">
                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fab fa-buromobelexperte"></i></span></div><input class="form-control" type="number" id="ubicacion_llanta" name="ubicacion_llanta">
                                </div>
                                <p class="text-sm font-italic font-weight-bold">NOTA: Si la ubicación de la llanta es de repuesto debe ingresar el valor = 0</p>
                            </div>

                        </div>
                        <div class="col-4"></div>


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

                        <div class="col-md-12 col-lg-6 col-xl-6 col-sm-12 col-xs-12">
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
                                    <input class="form-control" type="number" id="kilo_montaje" max="999999" name="kilo_montaje" required>
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
                                    <input class="form-control" type="number" id="lonas" max="999999" name="lonas" required>
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
                                        <option value=""><b>-Seleccione el estado actual-</b></option>
                                        <option value="montada" selected>Montada</option>
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

<div id="seguimiento-llantas" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="seguimiento-llantas-title" aria-hidden="true" style="overflow-y: scroll;">
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
                                <input class="form-control" type="number" id="kilo_inspeccion" max="999999" name="kilo_inspeccion" required>
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
                                <input class="form-control" type="number" id="prof_inter" max="999999" name="prof_inter" required>
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
                                <input class="form-control" type="number" id="prof_exter" max="999999" name="prof_exter" required>
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
                                <input class="form-control" type="number" id="promedio" max="999999" name="promedio" required>
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
                                    <input class="form-control" type="number" id="nuevo_num_llanta" max="999999" name="nuevo_num_llanta" required>
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
                                    <input class="form-control" type="text" id="nuevo_referencia" max="999999" name="nuevo_referencia" required>
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

            <form method="post" enctype="multipart/form-data" id="formulario_orden_trabajo">

                <input id="idcontrol" type="hidden" name="idcontrol" value="">

                <div class="modal-body">
                    <h5>Buscar llantas montadas en vehículos</h5>
                    <hr class="bg-dark">

                    <div class="row">

                        <div class="col-md-12 col-lg-6 col-xl-6 col-sm-12">
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

                        </div>
                        <div class="col-md-12 col-lg-6 col-xl-6 col-sm-12">
                            <div class="form-group">
                                <label for="razon_social">Proveedor de servicio</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-dolly-flatbed"></i></span>
                                    </div>
                                    <input type="hidden" id="idproveedor" name="idproveedor" class="campos_ordenTrabajo">
                                    <input class="form-control campos_ordenTrabajo" type="text" id="razon_social" name="razon_social" placeholder="Seleccione un proveedor de servicio" required readonly>
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-success btn-md btn_seleccionar_proveedor" title="Visualizar lista de proveedores." data-toggle="modal" data-target="#listaProveedores"><i class="fas fa-info-circle"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-md-12 col-lg-6 col-xl-6 col-sm-12">
                            <div class="form-group">
                                <label for="fecha_factura">Fecha de la orden</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-calendar-week"></i></span>
                                    </div>
                                    <input class="form-control campos_ordenTrabajo" type="date" id="fecha_orden" name="fecha_orden" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 col-lg-6 col-xl-6 col-sm-12">
                            <div class="form-group">
                                <label for="fecha_factura">Kilometraje</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-tachometer-alt"></i></span>
                                    </div>
                                    <input class="form-control campos_ordenTrabajo" type="number" id="kilo_orden" name="kilo_orden" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 col-lg-6 col-xl-6 col-sm-12">
                            <label> Alineación de vehículo </label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" value="SI" id="si_ali" name="alineacion" required>
                                <label class="form-check-label text-nowrap">
                                    <strong>SI</strong>
                                </label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" value="NO" id="no_ali" name="alineacion" required>
                                <label class="form-check-label text-nowrap">
                                    <strong>NO</strong>
                                </label>
                            </div>
                        </div>


                    </div>


                    <hr>

                    <h5><strong>Ubicación</strong></h5>

                    <div class="row">
                        <div class="col-md-12 col-lg-5 col-xl-5 col-sm-12">
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

                    <hr class="bg-dark">
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered table-striped text-center text-nowrap" id="tabla_ordenTrabajo_llanta">
                            <thead>
                                <tr>
                                    <th colspan="12"></th>
                                    <th colspan="7">Nueva ubicación</th>
                                </tr>
                                <tr>
                                    <th>ID llanta</th>
                                    <th>Núm. Llanta</th>
                                    <th>Marca</th>
                                    <th>Tamaño</th>
                                    <th>Banda</th>
                                    <th>Profundidad 1 (mm)</th>
                                    <th>Profundidad 2 (mm)</th>
                                    <th>Profundidad 3 (mm)</th>
                                    <th>Promedio (mm)</th>
                                    <th>Presión (PSI)</th>
                                    <th>Trabajos realizados</th>
                                    <th>Ubicación actual</th>
                                    <th>1</th>
                                    <th>2</th>
                                    <th>3</th>
                                    <th>4</th>
                                    <th>5</th>
                                    <th>6</th>
                                    <th>Repuesto</th>
                                </tr>
                            </thead>
                            <tbody id="tbody_tabla_ordenTrabajo">

                            </tbody>
                        </table>
                    </div>
                </div>
            </form>

            <div class="modal-footer modal-footer bg-gradient-dark">
                <div class="form-group">
                    <button type="submit" class="btn bg-gradient-success btn_agregarOrden" form="formulario_orden_trabajo"><i class="fas fa-share"></i> Agregar</button>
                    <button type="button" class="btn bg-gradient-danger btn_cancelarOrden" data-dismiss="modal">Cancelar</button>
                </div>
            </div>

        </div>
    </div>
</div>

<div id="listaProveedores" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="listaProveedores-title" aria-hidden="true" style="overflow-y: scroll;">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">

            <div class="modal-header bg-gradient-info">
                <h3 class="modal-title" id="listaProveedores-title">Lista de proveedores de servicios/productos <i class="fas fa-dolly-flatbed"></i></h3>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-sm table-bordered table-striped text-center text-nowrap" id="tablalistaProveedores">
                        <thead>
                            <tr>
                                <th>Documento</th>
                                <th>Nombre</th>
                                <th>Razón social</th>
                                <th>Dirección</th>
                                <th>Teléfono</th>
                                <th>Correo</th>
                                <th>Selección</th>
                            </tr>
                        </thead>
                        <tbody id="tbody_listaProveedores">
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="modal-footer bg-gradient-dark">
                <div class="form-group">
                    <a href="c-proveedores" target="_blank">
                        <button type="" class="btn btn-sm btn-warning float-center btn-nuevoProveedor">
                            <i class="fas fa-parachute-box"></i>
                            Nuevo proveedor
                        </button></a>
                    <button type="button" class="btn btn-sm bg-gradient-danger btn_cancelar_proveedor" id="btn_cancelar_edit" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="HistorialTrabajos" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="HistorialTrabajos-title" aria-hidden="true" style="overflow-y: scroll;">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-gradient-info">
                <h4 class="modal-title" id="HistorialTrabajos-title">Trabajos realizados <i class="fas fa-toolbox"></i></h4>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-sm table-bordered table-striped text-center text-nowrap" id="tablaTrabajosRealizados">
                        <thead>
                            <tr>
                                <th>Número de control</th>
                                <th>Número de llanta</th>
                                <th>Trabajo realizado</th>
                            </tr>
                        </thead>
                        <tbody id="tbody_trabajosRealizados">
                        </tbody>
                    </table>
                </div>

            </div>
            <div class="modal-footer bg-gradient-dark">
                <div class="form-group">
                    <!-- <button type="submit" class="btn bg-gradient-success" form="formulario_orden_trabajo"><i class="fas fa-share"></i> Agregar</button> -->
                    <button type="button" class="btn bg-gradient-danger" data-dismiss="modal">Continuar</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="listaLlantas" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="listaLlantastitle" aria-hidden="true" style="overflow-y: scroll;">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header bg-gradient-info">
                <h4 class="modal-title" id="listaLlantastitle">Listado de llantas</h4>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-sm table-bordered table-striped w-100 text-center text-nowrap" id="tablaListaLlantas">
                        <thead>
                            <tr>
                                <th>Seleccionar</th>
                                <th>ID</th>
                                <th>Descripción</th>
                                <th>Código</th>
                                <th>Referencia</th>
                                <th>Tamaño</th>
                                <th>Medida</th>
                                <th>Marca</th>
                                <th>Categoria</th>
                            </tr>
                        </thead>
                        <tbody id="tbodyListaLlantas">
                        </tbody>
                    </table>
                </div>

            </div>
            <div class="modal-footer bg-gradient-dark">
                <div class="form-group">
                    <button type="" class="btn btn-md btn-info float-center btn_add_llanta"><i class="fas fa-plus-circle"></i> Crear nueva llanta</button>
                    <button type="button" class="btn btn-md bg-gradient-danger btn_regresar" data-dismiss="modal">Regresar</button>
                </div>

            </div>
        </div>
    </div>
</div>

<div id="editarOrdenTrabajo" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="editarOrdenTrabajo-title" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

            <div class="modal-header bg-gradient-info">
                <h3 class="modal-title" id="editarOrdenTrabajo-title"></h3>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form id="actualizar_datosLlanta_orden" method="post" enctype="multipart/form-data">
                <div class="modal-body">

                    <input type="hidden" name="editar_id_orden" id="editar_id_orden" value="">
                    <input type="hidden" name="editar_id_control" id="editar_id_control" value="">

                    <div class="row">
                        <div class="col-md-12 col-lg-6 col-xl-6 col-sm-12">
                            <div class="form-group">
                                <label for="fecha_factura">ID llanta</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-hashtag"></i></span>
                                    </div>
                                    <input class="form-control campos_ordenTrabajo" type="number" id="editar_id_llanta" name="editar_id_llanta" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-6 col-xl-6 col-sm-12">
                            <div class="form-group">
                                <label for="fecha_factura">Fecha de la orden</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-calendar-week"></i></span>
                                    </div>
                                    <input class="form-control campos_ordenTrabajo" type="date" id="editar_fecha_orden" name="editar_fecha_orden">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 col-lg-6 col-xl-6 col-sm-12">
                            <div class="form-group">
                                <label for="fecha_factura">Profundidad 1(mm)</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-arrows-alt-v"></i></span>
                                    </div>
                                    <input type='text' class='form-control form-control-sm calcular2' id='editar_prof1' name='editar_prof1'>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 col-lg-6 col-xl-6 col-sm-12">
                            <div class="form-group">
                                <label for="fecha_factura">Profundidad 2(mm)</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-arrows-alt-v"></i></span>
                                    </div>
                                    <input type='text' class='form-control form-control-sm calcular2' id='editar_prof2' name='editar_prof2'>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 col-lg-6 col-xl-6 col-sm-12">
                            <div class="form-group">
                                <label for="fecha_factura">Profundidad 3(mm)</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-arrows-alt-v"></i></span>
                                    </div>
                                    <input type='text' class='form-control form-control-sm calcular2' id='editar_prof3' name='editar_prof3'>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 col-lg-6 col-xl-6 col-sm-12">
                            <div class="form-group">
                                <label for="fecha_factura">Promedio(mm)</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-percentage"></i></span>
                                    </div>
                                    <input type='text' class='form-control form-control-sm calcular2' id='editar_promedio' name='editar_promedio' readonly>

                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 col-lg-6 col-xl-6 col-sm-12">
                            <div class="form-group">
                                <label for="fecha_factura">Presión(PSI)</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-compress-arrows-alt"></i></span>
                                    </div>
                                    <input type='text' class='form-control form-control-sm' id='editar_presion' name='editar_presion'>

                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 col-lg-6 col-xl-6 col-sm-12">
                            <div class="form-group">
                                <label for="fecha_factura">Banda</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-ring"></i></span>
                                    </div>
                                    <input type='text' class='form-control form-control-sm' id='editar_banda' name='editar_banda'>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="bg-dark">

                    <div class="row">
                        <div class="col-md-12 col-lg-6 col-xl-6 col-sm-12">
                            <div class="form-group">
                                <label for="fecha_factura">Ubicación actual</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-map-marker"></i></span>
                                    </div>
                                    <input class="form-control" type="number" id="editar_ubicacion_actual" name="editar_ubicacion_actual">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 col-lg-6 col-xl-6 col-sm-12">
                            <div class="form-group">
                                <table class=" table table-sm table-bordered table-striped text-center text-nowrap">
                                    <thead>
                                        <tr>
                                            <th colspan="7">Nueva ubicación</th>
                                        </tr>
                                        <tr>
                                            <th>1</th>
                                            <th>2</th>
                                            <th>3</th>
                                            <th>4</th>
                                            <th>5</th>
                                            <th>6</th>
                                            <th>Repuesto</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <input class='check' type='radio' id='edit_ubicacion1' name='edit_ubicacion' value='1'>
                                            </td>

                                            <td>
                                                <input class='check' type='radio' id='edit_ubicacion2' name='edit_ubicacion' value='2'>
                                            </td>

                                            <td>
                                                <input class='check' type='radio' id='edit_ubicacion3' name='edit_ubicacion' value='3'>
                                            </td>

                                            <td>
                                                <input class='check' type='radio' id='edit_ubicacion4' name='edit_ubicacion' value='4'>
                                            </td>

                                            <td>
                                                <input class='check' type='radio' id='edit_ubicacion5' name='edit_ubicacion' value='5'>
                                            </td>

                                            <td>
                                                <input class='check' type='radio' id='edit_ubicacion6' name='edit_ubicacion' value='6'>
                                            </td>

                                            <td>
                                                <input class='check' type='radio' id='edit_ubicacion0' name='edit_ubicacion' value='0'>
                                            </td>

                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            <div class="modal-footer bg-gradient-dark">
                <div class="form-group">
                    <button type="submit" class="btn bg-gradient-success btn_actualizar_datosLlanta_orden" form="actualizar_datosLlanta_orden"><i class="fas fa-sync-alt"></i> Actualizar</button>
                    <button type="button" class="btn bg-gradient-danger" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
</div>