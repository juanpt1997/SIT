<?php

if (!validarPermiso('M_GESTION_HUMANA', 'U')) {
    echo "<script> window.location = 'inicio'; </script>";
}

$empresa = ControladorEmpresa::ctrVerEmpresa();
$departamentos = ControladorCiudades::ctrListaDepar();
?>
<!-- ===================== 
  CONCEPTOS GENERALES - Gestion humana (modulo)
  ========================= -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mt-2 mb-2">
                <div class="col-sm-6">
                    <h2 class="m-0 text-dark "><i><b>Gestión humana</b></i></h2>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                        <li class="breadcrumb-item active">Gestión humana</li>
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
                <div class="col">
                    <div class="card border border-secondary">
                        <div class="card-header bg-success">
                            <h5>Crear / Editar / Eliminar / Visualizar </h5>
                        </div>
                        <div class="card-body">
                            <div class="row">

                                <div class="col-12 col-sm-6 col-md-4">
                                    <div class="info-box border border-secondary">
                                        <span class="info-box-icon bg-primary elevation-1"><i class="far fa-envelope"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text"><i>Tipo ausentismo</i></span>
                                            <span class="info-box-number" concepto="Tipo de ausentismo"></span>
                                        </div>
                                        <!-- /.info-box-content -->
                                        <div class="d-flex flex-column">
                                            <button concepto="Tipo de ausentismo" type="button" class="btn-toolbar btn-ver btn-sm btn-info float-right" style="margin: 1px;" data-toggle="modal" data-target="#VisualizarGH"><i class="far fa-eye"></i></button>
                                            <button concepto="Tipo de ausentismo" type="button" class="btn-toolbar btn-nuevo btn-sm btn-success float-right" style="margin: 1px;" data-toggle="modal" data-target="#AgregarEditarGH"><i class="fas fa-plus-circle"></i></button>
                                        </div>

                                        <div class="overlay d-none" concepto="Tipo de ausentismo">
                                            <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                                        </div>
                                    </div>
                                    <!-- /.info-box -->
                                </div>

                                <div class="col-12 col-sm-6 col-md-4 text-nowrap">
                                    <div class="info-box border border-secondary">
                                        <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-store-alt"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text"><i>Sucursales</i></span>
                                            <span class="info-box-number" concepto="Sucursales"></span>
                                        </div>
                                        <!-- /.info-box-content -->
                                        <div class="d-flex flex-column">
                                            <button concepto="Sucursales" type="button" class="btn-toolbar btn-ver btn-sm btn-info float-right" style="margin: 1px;" data-toggle="modal" data-target="#VisualizarGH"><i class="far fa-eye"></i></button>
                                            <button concepto="Sucursales" type="button" class="btn-toolbar btn-nuevo btn-sm btn-success float-right" style="margin: 1px;" data-toggle="modal" data-target="#AgregarEditarGH"><i class="fas fa-plus-circle"></i></button>
                                        </div>

                                        <div class="overlay d-none" concepto="Sucursales">
                                            <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                                        </div>
                                    </div>
                                    <!-- /.info-box -->
                                </div>

                                <div class="col-12 col-sm-6 col-md-4 text-nowrap">
                                    <div class="info-box border border-secondary">
                                        <span class="info-box-icon bg-dark elevation-1"><i class="fas fa-project-diagram"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text"><i>Procesos</i></span>
                                            <span class="info-box-number" concepto="Procesos"></span>
                                        </div>
                                        <!-- /.info-box-content -->
                                        <div class="d-flex flex-column">
                                            <button concepto="Procesos" type="button" class="btn-toolbar btn-ver btn-sm btn-info float-right" style="margin: 1px;" data-toggle="modal" data-target="#VisualizarGH"><i class="far fa-eye"></i></button>
                                            <button concepto="Procesos" type="button" class="btn-toolbar btn-nuevo btn-sm btn-success float-right" style="margin: 1px;" data-toggle="modal" data-target="#AgregarEditarGH"><i class="fas fa-plus-circle"></i></button>
                                        </div>

                                        <div class="overlay d-none" concepto="Procesos">
                                            <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                                        </div>

                                    </div>
                                    <!-- /.info-box -->
                                </div>

                                <div class="col-12 col-sm-6 col-md-4 text-nowrap">
                                    <div class="info-box border border-secondary">
                                        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-hand-holding-heart"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text"><i>ARL</i></span>
                                            <span class="info-box-number" concepto="ARL"></span>
                                        </div>
                                        <!-- /.info-box-content -->
                                        <div class="d-flex flex-column">
                                            <button concepto="ARL" type="button" class="btn-toolbar btn-ver btn-sm btn-info float-right" style="margin: 1px;" data-toggle="modal" data-target="#VisualizarGH"><i class="far fa-eye"></i></button>
                                            <button concepto="ARL" type="button" class="btn-toolbar btn-nuevo btn-sm btn-success float-right" style="margin: 1px;" data-toggle="modal" data-target="#AgregarEditarGH"><i class="fas fa-plus-circle"></i></button>
                                        </div>

                                        <div class="overlay d-none" concepto="ARL">
                                            <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                                        </div>
                                    </div>
                                    <!-- /.info-box -->
                                </div>

                                <div class="col-12 col-sm-6 col-md-4 text-nowrap">
                                    <div class="info-box border border-secondary">
                                        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-hand-holding-usd"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text"><i>AFP</i></span>
                                            <span class="info-box-number" concepto="AFP"></span>
                                        </div>
                                        <!-- /.info-box-content -->
                                        <div class="d-flex flex-column">
                                            <button concepto="AFP" type="button" class="btn-toolbar btn-ver btn-sm btn-info float-right" style="margin: 1px; max-height:25px" data-toggle="modal" data-target="#VisualizarGH"><i class="far fa-eye"></i></button>
                                            <button concepto="AFP" type="button" class="btn-toolbar btn-nuevo btn-sm btn-success float-right" style="margin: 1px; max-height:25px" data-toggle="modal" data-target="#AgregarEditarGH"><i class="fas fa-plus-circle"></i></button>
                                        </div>

                                        <div class="overlay d-none" concepto="AFP">
                                            <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                                        </div>
                                    </div>
                                    <!-- /.info-box -->
                                </div>

                                <div class="col-12 col-sm-6 col-md-4 text-nowrap">
                                    <div class="info-box border border-secondary">
                                        <span class="info-box-icon bg-info elevation-1"><i class="fas fa-map-marked-alt"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text"><i>Ciudades</i></span>
                                            <span class="info-box-number ciudades" concepto="Ciudades"></span>
                                        </div>
                                        <!-- /.info-box-content-->
                                        <div class="d-flex flex-column">
                                            <button concepto="Ciudades" type="button" class="btn-toolbar btn-ver-ciudad btn-sm btn-info float-right" style="margin: 1px;" data-toggle="modal" data-target="#VisualizarCiudades"><i class="far fa-eye"></i></button>
                                            <button concepto="Ciudades" type="button" class="btn-toolbar btn-nueva-ciudad btn-sm btn-success float-right" style="margin: 1px;" data-toggle="modal" data-target="#AgregarCiudad"><i class="fas fa-plus-circle"></i></button>
                                        </div>

                                        <div class="overlay d-none" concepto="Ciudades">
                                            <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                                        </div>
                                    </div>
                                    <!-- /.info-box-->
                                </div>


                                <div class="col-12 col-sm-6 col-md-4 text-nowrap">
                                    <div class="info-box border border-secondary">
                                        <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-map-marked-alt"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text"><i>Departamentos</i></span>
                                            <span class="info-box-number" concepto="Departamentos"></span>
                                        </div>
                                        <!-- /.info-box-content -->
                                        <div class="d-flex flex-column">
                                            <button concepto="Departamentos" type="button" class="btn-toolbar btn-ver btn-sm btn-info float-right" style="margin: 1px;" data-toggle="modal" data-target="#VisualizarGH"><i class="far fa-eye"></i></button>
                                            <button concepto="Departamentos" type="button" class="btn-toolbar btn-nuevo btn-sm btn-success float-right" style="margin: 1px;" data-toggle="modal" data-target="#AgregarEditarGH"><i class="fas fa-plus-circle"></i></button>
                                        </div>

                                        <div class="overlay d-none" concepto="Departamentos">
                                            <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                                        </div>
                                    </div>
                                    <!-- /.info-box -->
                                </div>

                                <div class="col-12 col-sm-6 col-md-4 text-nowrap">
                                    <div class="info-box border border-secondary">
                                        <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-clinic-medical"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text"><i>EPS</i></span>
                                            <span class="info-box-number" concepto="EPS"></span>

                                        </div>
                                        <!-- /.info-box-content -->
                                        <div class="d-flex flex-column">
                                            <button concepto="EPS" type="button" class="btn-toolbar btn-ver btn-sm btn-info float-right" style="margin: 1px;" data-toggle="modal" data-target="#VisualizarGH"><i class="far fa-eye"></i></button>
                                            <button concepto="EPS" type="button" class="btn-toolbar btn-nuevo btn-sm btn-success float-right" style="margin: 1px;" data-toggle="modal" data-target="#AgregarEditarGH"><i class="fas fa-plus-circle"></i></button>
                                        </div>

                                        <div class="overlay d-none" concepto="EPS">
                                            <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                                        </div>
                                    </div>
                                    <!-- /.info-box -->
                                </div>

                                <div class="col-12 col-sm-6 col-md-4 text-nowrap">
                                    <div class="info-box border border-secondary">
                                        <span class="info-box-icon bg-info elevation-1"><i class="fas fa-sitemap"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text"><i>Cargos</i></span>
                                            <span class="info-box-number" concepto="cargo"></span>

                                        </div>
                                        <!-- /.info-box-content -->
                                        <div class="d-flex flex-column">
                                            <button concepto="cargo" type="button" class="btn-toolbar btn-ver btn-sm btn-info float-right" style="margin: 1px;" data-toggle="modal" data-target="#VisualizarGH"><i class="far fa-eye"></i></button>
                                            <button concepto="cargo" type="button" class="btn-toolbar btn-nuevo btn-sm btn-success float-right" style="margin: 1px;" data-toggle="modal" data-target="#AgregarEditarGH"><i class="fas fa-plus-circle"></i></button>
                                        </div>

                                        <div class="overlay d-none" concepto="cargo">
                                            <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                                        </div>
                                    </div>
                                    <!-- /.info-box -->
                                </div>

                                <div class="col-12 col-sm-6 col-md-4 text-nowrap">
                                    <div class="info-box border border-secondary">
                                        <span class="info-box-icon bg-warning elevation-1"><i class="far fa-building"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text"><i>Empresa</i></span>
                                        </div>
                                        <!-- /.info-box-content -->
                                        <div class="d-flex flex-column">
                                            <button concepto="Empresa" type="button" class="btn-toolbar btn-ver-empresa btn-sm btn-info float-right" style="margin: 1px;" data-toggle="modal" data-target="#VisualizarEmpresa"><i class="far fa-eye"></i></button>
                                        </div>
                                        <div class="overlay d-none" concepto="Empresa">
                                            <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                                        </div>
                                    </div>
                                    <!-- /.info-box -->
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

<!-- =================================================================
     ========MODALS CREAR (MAESTRA GESTION HUMANA) ==========
     =================================================================-->

<div class="modal fade" id="AgregarEditarGH" tabindex="-1" data-backdrop="true" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header bg-success">
                <h5 class="modal-title" id="titulo_modalGH"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form method="post" enctype="multipart/form-data" id="formularioGH">

                <div class="modal-body">

                    <input type="hidden" id="idGH" name="idGH" value="">

                    <div class="form-group">
                        <label>Nuevo registro</label>
                        <div class="input-group">
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <i class="fas fa-address-card"></i>
                                </span>
                            </div>
                            <input class="form-control" type="text" min="0" id="inputGH" name="inputGH" placeholder="" required>
                        </div>
                    </div>

                </div>

                <div class="modal-footer bg-dark">
                    <button type="button" class="btn btn-danger btn-cancelar" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save"></i>
                        Guardar
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>

<!-- =================================================================
     ========MODALS VISUALIZAR - ELIMINAR ==========
     =================================================================-->

<div class="modal fade" id="VisualizarGH" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

            <div class="modal-header bg-success">
                <h5 class="modal-title" id="titulo_modalVer"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-sm table-striped table-bordered dt-responsive table-hover tablasBtnExport w-100" id="ver_concepto">
                        <thead class="thead-light text-uppercase text-sm text-center">
                            <tr>
                                <th style="width:10px;">#</th>
                                <th id="tipo"></th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm text-center" id="tbody_ver_concepto">
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="modal-footer bg-dark">
                <button type="button" class="btn btn-danger btn-cancelar" data-dismiss="modal">Cerrar</button>
            </div>

        </div>
    </div>
</div>

<!-- =================================================================
     ========MODALS VISUALIZAR EMPRESA ==========
     =================================================================-->

<div class="modal fade" id="VisualizarEmpresa" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">

            <div class="modal-header bg-success">
                <h5 class="modal-title" id="titulo_modalEmpresa"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-sm table-striped table-bordered dt-responsive table-hover tablasBtnExport w-100" id="tabla_empresa">
                        <thead class="thead-light text-sm text-center text-nowrap">
                            <tr>
                                <th style="width:10px;">#</th>
                                <th>Razón social</th>
                                <th>NIT</th>
                                <th>Num. Resolución</th>
                                <th>Año de resolución</th>
                                <th>Dirección territorial</th>
                                <th>Foto firma</th>
                                <th>Sitio WEB</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm text-center" id="tbody_tabla_empresa">
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="modal-footer bg-dark">
                <button type="button" class="btn btn-danger btn-cancelar" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<!-- =================================================================
     ========MODALS CREAR (CIUDAD) ==========
     =================================================================-->

<div class="modal fade" id="AgregarCiudad" tabindex="-1" data-backdrop="true" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header bg-success">
                <h5 class="modal-title" id="titulo_ciudad"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form method="post" enctype="multipart/form-data" id="formularioCiudades">

                <div class="modal-body">

                    <input type="hidden" id="idGH" name="idGH" value="">

                    <div class="form-group">
                        <label>Municipio</label>
                        <div class="input-group">
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <i class="fas fa-map-marker-alt"></i>
                                </span>
                            </div>
                            <input class="form-control" type="text" id="municipio" name="municipio" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Departamento</label>
                        <div class="input-group">
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <i class="fas fa-map-marker-alt"></i>
                                </span>
                            </div>
                            <select class="form-control select2-single" style="width: 92%" type="text" id="departamentos" name="departamentos" required>
                                <option selected value="">-Seleccione un departamento-</option>
                                <?php foreach ($departamentos as $key => $value) : ?>
                                    <option value="<?= $value['iddepartamento'] ?>"><?= $value['nombre'] ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>

                </div>

                <div class="modal-footer bg-dark">
                    <button type="button" class="btn btn-danger btn-cancelar" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save"></i>
                        Guardar
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>

<!-- =================================================================
     ========MODALS VISUALIZAR - CIUDAD ==========
     =================================================================-->

<div class="modal fade" id="VisualizarCiudades" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

            <div class="modal-header bg-success">
                <h5 class="modal-title" id="titulo_ciudades"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-sm table-striped table-bordered dt-responsive table-hover tablasBtnExport w-100" id="ver_ciudad">
                        <thead class="thead-light text-uppercase text-sm text-center">
                            <tr>
                                <th style="width:10px;">#</th>
                                <th>Departamento</th>
                                <th>Municipio</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm text-center" id="tbody_ver_ciudad">
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="modal-footer bg-dark">
                <button type="button" class="btn btn-danger btn-cancelar" data-dismiss="modal">Cerrar</button>
            </div>

        </div>
    </div>
</div>

<!-- =================================================================
     ========MODALS EDITAR (CIUDAD) ==========
     =================================================================-->

<div class="modal fade" id="EditarCiudad" tabindex="-1" data-backdrop="true" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

            <div class="modal-header bg-success">
                <h5 class="modal-title" id="titulo_ciudad_edit"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form method="post" enctype="multipart/form-data" id="formularioCiudadesEdit">

                <div class="modal-body">

                    <input type="hidden" id="idmunicipioedit" name="idmunicipioedit" value="">

                    <div class="form-group">
                        <label>Municipio</label>
                        <div class="input-group">
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <i class="fas fa-map-marker-alt"></i>
                                </span>
                            </div>
                            <input class="form-control" type="text" id="municipioEdit" name="municipioEdit" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Departamento</label>
                        <div class="input-group">
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <i class="fas fa-map-marker-alt"></i>
                                </span>
                            </div>
                            <select class="form-control input-lg select2-single" style="width: 92%" type="text" id="departamentosEdit" name="departamentosEdit" required>
                                <option selected value="">-Seleccione un departamento-</option>
                                <?php foreach ($departamentos as $key => $value) : ?>
                                    <option value="<?= $value['iddepar'] ?>"><?= $value['DeparMunic'] ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>

                </div>

                <div class="modal-footer bg-dark">
                    <button type="button" class="btn btn-danger btn-cancelar" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save"></i>
                        Guardar
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>