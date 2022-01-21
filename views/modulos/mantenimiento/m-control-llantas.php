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
                                <table class="table table-sm table-bordered table-striped text-center">
                                    <thead>
                                        <tr>
                                            <th>...</th>
                                            <th>Número llanta</th>
                                            <th>Ciudad</th>
                                            <th>Placa vehículo</th>
                                            <th>Tamaño</th>
                                            <th>Marca</th>
                                            <th>Referencia</th>
                                            <th>Vida</th>
                                            <th>Cantidad</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div class='btn-group' role='group' aria-label='Button group'>
                                                    <button title='Control/Seguimiento' data-toggle="modal" data-target="#seguimiento-llantas" class='btn btn-sm bg-gradient-primary btn-seguimiento'><i class="fas fa-calendar-check"></i></button>
                                                </div>
                                                <div class="btn-group" role="group" aria-label="Button group">
                                                    <button title='Editar control' data-toggle="modal" data-target="#registro-llantas" class='btn btn-sm bg-gradient-info btn-editar-control'><i class="fas fa-edit"></i></button>
                                                </div>
                                                <div class="btn-group" role="group" aria-label="Button group">
                                                    <button title='Eliminar control' class='btn btn-sm bg-gradient-danger btn-eliminar-control'><i class="fas fa-trash"></i></button>
                                                </div>
                                            </td>
                                            <td>1</td>
                                            <td>RISARALDA - PEREIRA</td>
                                            <td>TEP997</td>
                                            <td>255/70R16</td>
                                            <td>Bridgstone</td>
                                            <td>1</td>
                                            <td></td>
                                            <td>6</td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <div class='btn-group' role='group' aria-label='Button group'>
                                                    <button title='Control/Seguimiento' data-toggle="modal" data-target="#seguimiento-llantas" class='btn btn-sm bg-gradient-primary btn-seguimiento'><i class="fas fa-calendar-check"></i></button>
                                                </div>
                                                <div class="btn-group" role="group" aria-label="Button group">
                                                    <button title='Editar control' data-toggle="modal" data-target="#registro-llantas" class='btn btn-sm bg-gradient-info btn-editar-control'><i class="fas fa-edit"></i></button>
                                                </div>
                                                <div class="btn-group" role="group" aria-label="Button group">
                                                    <button title='Eliminar control' class='btn btn-sm bg-gradient-danger btn-eliminar-control'><i class="fas fa-trash"></i></button>
                                                </div>
                                            </td>
                                            <td>2</td>
                                            <td>RISARALDA - PEREIRA</td>
                                            <td>JNE128</td>
                                            <td>215/75R17.5</td>
                                            <td>General</td>
                                            <td>2</td>
                                            <td></td>
                                            <td>4</td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <div class='btn-group' role='group' aria-label='Button group'>
                                                    <button title='Control/Seguimiento' data-toggle="modal" data-target="#seguimiento-llantas" class='btn btn-sm bg-gradient-primary btn-seguimiento'><i class="fas fa-calendar-check"></i></button>
                                                </div>
                                                <div class="btn-group" role="group" aria-label="Button group">
                                                    <button title='Editar control' data-toggle="modal" data-target="#registro-llantas" class='btn btn-sm bg-gradient-info btn-editar-control'><i class="fas fa-edit"></i></button>
                                                </div>
                                                <div class="btn-group" role="group" aria-label="Button group">
                                                    <button title='Eliminar control' class='btn btn-sm bg-gradient-danger btn-eliminar-control'><i class="fas fa-trash"></i></button>
                                                </div>
                                            </td>
                                            <td>3</td>
                                            <td>RISARALDA - PEREIRA</td>
                                            <td>LGH479</td>
                                            <td>255/70R16</td>
                                            <td>Bridgstone</td>
                                            <td>3</td>
                                            <td></td>
                                            <td>3</td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <div class='btn-group' role='group' aria-label='Button group'>
                                                    <button title='Control/Seguimiento' data-toggle="modal" data-target="#seguimiento-llantas" class='btn btn-sm bg-gradient-primary btn-seguimiento'><i class="fas fa-calendar-check"></i></button>
                                                </div>
                                                <div class="btn-group" role="group" aria-label="Button group">
                                                    <button title='Editar control' data-toggle="modal" data-target="#registro-llantas" class='btn btn-sm bg-gradient-info btn-editar-control'><i class="fas fa-edit"></i></button>
                                                </div>
                                                <div class="btn-group" role="group" aria-label="Button group">
                                                    <button title='Eliminar control' class='btn btn-sm bg-gradient-danger btn-eliminar-control'><i class="fas fa-trash"></i></button>
                                                </div>
                                            </td>
                                            <td>4</td>
                                            <td>RISARALDA - PEREIRA</td>
                                            <td>RFK405</td>
                                            <td>LT31X10,50R15</td>
                                            <td>Nankang</td>
                                            <td>4</td>
                                            <td></td>
                                            <td>3</td>
                                        </tr>

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

<div id="registro-llantas" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="registro-llantas-title" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">

            <div class="modal-header bg-gradient-info">
                <h5 class="modal-title" id="registro-llantas-title">Registrar llanta</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form id="formulario_LlantasControl" method="post" enctype="multipart/form-data">
                <div class="modal-body">

                    <h4><i class="fas fa-angle-double-right"></i> <b><i>Asociar llanta a vehículo</i></b></h4>
                    
                    <hr class="my-4 bg-dark">

                    <div class="col">
                        <div class="form-group">
                            <label><i>Número/Código de LLanta</i></label>
                            <input class="form-control" type="number" id="num_llanta" max="9999" name="num_llanta" required>
                        </div>
                    </div>

                    <div class="col">
                        <div class="form-group">
                            <label><i>Descripción</i></label>
                            <input type="text" class="form-control input_producto" id="descripcion" name="descripcion" placeholder="Descripción / Nombre de llanta" required>
                        </div>
                    </div>

                    <div class="col">
                        <div class="form-group">
                            <label><i>PLACA</i></label>
                            <select id="placa" name="placa" class="form-control select2-single" type="number" style="width: 99%" required>
                                <option value="" selected><b>-Lista de placas-</b></option>
                                <?php foreach ($Placas as $key => $value) : ?>
                                    <option value="<?= $value['idvehiculo'] ?>"><?= $value['placa'] ?> - <?= $value['numinterno'] ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>

                    <hr class="my-4">


                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label>Tamaño</label>
                                <select id="tama_llanta" name="tama_llanta" class="form-control" type="number" style="width: 99%" required>
                                    <option value="" selected><b>-Lista de tamaños llantas-</b></option>
                                    <option value="215/75R15">215/75R15</option>
                                    <option value="225/70R15">225/70R15</option>
                                    <option value="235/75R15">235/75R15</option>
                                    <option value="245/75R16">245/75R16</option>
                                    <option value="255/70R16">255/70R16</option>
                                    <option value="255/70R15C">255/70R15C</option>
                                    <option value="205/75R17.5">205/75R17.5</option>
                                    <option value="215/75R17.5">215/75R17.5</option>
                                    <option value="LT31X10,50R15">LT31X10,50R15</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label>Marca</label>
                                <select id="marca" name="marca" class="form-control" type="number" style="width: 99%" required>
                                </select>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label><i>Ciudad</i></label>
                                <select id="sucursal" name="sucursal" class="form-control select2-single" type="number" style="width: 99%" required>
                                    
                                </select>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label>Categoria</label>
                                <select id="categoria" name="categoria" class="form-control" type="number" style="width: 99%" required>
                                </select>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label>Medida</label>
                                <select id="medida" name="medida" class="form-control" type="number" style="width: 99%" required>
                                </select>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label for="kilo_invent">Vida</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-clock"></i></span>
                                    </div>
                                    <input class="form-control" type="number" id="vida_util" max="9999" name="vida_util" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label for="kilo_invent">Referencia</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-file-alt"></i></span>
                                    </div>
                                    <input class="form-control" type="text" id="referencia" max="9999" name="referencia" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label for="kilo_invent">Cantidad</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-cubes"></i></span>
                                    </div>
                                    <input class="form-control" type="number" id="cantidad" max="9999" name="cantidad" required>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="my-4">

                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="fecha_montaje">Fecha factura</label>
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
                                <label for="fecha_montaje">Num. Factura</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-bars"></i></span>
                                    </div>
                                    <input class="form-control" type="number" id="num_factura" name="num_factura" required>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="my-4">

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
                                <label for="kilo_invent">Kilometraje montaje</label>
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
                                <label for="kilo_invent">Lonas</label>
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
                                <select id="estado" name="estado" class="form-control" type="number" style="width: 99%" required>
                                    <option value="" selected><b>-Seleccione el estado actual-</b></option>
                                    <option value="montada">Montada</option>
                                    <option value="desmontada">Desmontada</option>
                                </select>
                            </div>
                        </div>


                    </div>

                </div>
            </form>

            <div class="modal-footer bg-gradient-dark">
                <button type="submit" class="btn bg-gradient-success btn-guardar-registro-llantas" form="formulario_LlantasControl"><i class="fas fa-share"></i> Guardar</button>
                <button type="button" class="btn bg-gradient-danger" data-dismiss="modal">Cancelar</button>
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