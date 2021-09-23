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
                    <h2 class="m-0 text-dark "><i><b>Mantenimiento</b></i></h2>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                        <li class="breadcrumb-item active">Mantenimiento</li>
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
                            <h5>Crear / Editar / Eliminar / Visualizar
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="row">

                                <!-- <div class="col-12 col-sm-6 col-md-3">
                                    <div class="info-box border border-secondary">
                                      <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-cogs"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text"><i>Sistema</i></span>
                                            <span class="info-box-number">
                                                    10
                                                <small>registros</small>
                                            </span>        
                                        </div> -->
                                <!-- /.info-box-content -->
                                <!-- <div>
                                                <button concepto="Sistema" type="button" class="btn-toolbar btn-ver btn-sm btn-info float-right" style="margin: 1px;" data-toggle="modal" data-target="#VisualizarM" disabled="true"><i class="far fa-eye"></i></button>
                                                <button concepto="Sistema" type="button" class="btn-toolbar btn-nuevo btn-sm btn-success float-right" style="margin: 1px;" data-toggle="modal" data-target="#AgregarEditarM" disabled="true"><i class="fas fa-plus-circle"></i></button>  
                                            </div>

                                            <div class="overlay d-none" concepto="Sistema">
                                                <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                                            </div>
                                    </div> -->
                                <!-- /.info-box -->
                                <!-- </div> -->

                                <div class="col-12 col-sm-12 col-md-6 text-nowrap">
                                    <div class="info-box border border-secondary">
                                        <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-people-carry"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text"><i>Descripción de actividades</i></span>
                                            <span class="info-box-number" concepto="Descripción de actividades"></span>
                                        </div>
                                        <!-- /.info-box-content -->
                                        <div class="d-flex flex-column">
                                            <button concepto="Descripción de actividades" type="button" class="btn-toolbar btn-ver btn-sm btn-info float-right" style="margin: 1px;" data-toggle="modal" data-target="#VisualizarM"><i class="far fa-eye"></i></button>
                                            <button concepto="Descripción de actividades" type="button" class="btn-toolbar btn-nuevo btn-sm btn-success float-right" style="margin: 1px;" data-toggle="modal" data-target="#AgregarEditarM"><i class="fas fa-plus-circle"></i></button>
                                        </div>

                                        <div class="overlay d-none" concepto="Descripción de actividades">
                                            <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                                        </div>
                                    </div>
                                    <!-- /.info-box -->
                                </div>

                                <div class="col-12 col-sm-12 col-md-6 text-nowrap">
                                    <div class="info-box border border-secondary">
                                        <span class="info-box-icon bg-dark elevation-1"><i class="fas fa-file-medical-alt"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text"><i>Mantenimiento diagnostico</i></span>
                                            <span class="info-box-number" concepto="Mantenimiento diagnostico"></span>
                                        </div>
                                        <!-- /.info-box-content -->
                                        <div class="d-flex flex-column">
                                            <button concepto="Mantenimiento diagnostico" type="button" class="btn-toolbar btn-ver btn-sm btn-info float-right" style="margin: 1px;" data-toggle="modal" data-target="#VisualizarM"><i class="far fa-eye"></i></button>
                                            <button concepto="Mantenimiento diagnostico" type="button" class="btn-toolbar btn-nuevo btn-sm btn-success float-right" style="margin: 1px;" data-toggle="modal" data-target="#AgregarEditarM"><i class="fas fa-plus-circle"></i></button>
                                        </div>

                                        <div class="overlay d-none" concepto="Mantenimiento diagnostico">
                                            <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                                        </div>
                                    </div>
                                    <!-- /.info-box -->
                                </div>

                                <div class="col-12 col-sm-12 col-md-6 text-nowrap">
                                    <div class="info-box border border-secondary">
                                        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-dolly-flatbed"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text"><i>Repuestos</i></span>
                                            <span class="info-box-number" concepto="Repuestos"></span>
                                        </div>
                                        <!-- /.info-box-content -->
                                        <div class="d-flex flex-column">
                                            <button concepto="Repuestos" type="button" class="btn-toolbar btn-ver btn-sm btn-info float-right" style="margin: 1px;" data-toggle="modal" data-target="#VisualizarM"><i class="far fa-eye"></i></button>
                                            <button concepto="Repuestos" type="button" class="btn-toolbar btn-nuevo btn-sm btn-success float-right" style="margin: 1px;" data-toggle="modal" data-target="#AgregarEditarM"><i class="fas fa-plus-circle"></i></button>
                                        </div>

                                        <div class="overlay d-none" concepto="Repuestos">
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
     ========MODALS CREAR / EDTIAR (MAESTRA MANTENIMIENTO) ==========
     =================================================================-->

<div class="modal fade" id="AgregarEditarM" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header bg-success">
                <h5 class="modal-title" id="titulo_modalM"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form method="post" enctype="multipart/form-data" id="formularioM">

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

<div class="modal fade" id="VisualizarM" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

            <div class="modal-header bg-success">
                <h5 class="modal-title" id="titulo_modalVerM"></h5>
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