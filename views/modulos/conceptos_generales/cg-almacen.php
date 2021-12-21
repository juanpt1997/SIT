<!-- ===================== 
  CONCEPTOS GENERALES - ALMACEN (modulo)
  ========================= -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mt-2 mb-2">
                <div class="col-sm-6">
                    <h2 class="m-0 text-dark "><i><b>Almacén </b></i><i class="fas fa-warehouse"></i></h2>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                        <li class="breadcrumb-item active">Almacén</li>
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

                                <div class="col-12 col-sm-12 col-md-6 text-nowrap">
                                    <div class="info-box border border-secondary">
                                        <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-bezier-curve"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text"><i>Categorias</i></span>
                                            <span class="info-box-number" concepto="Categorias"></span>
                                        </div>
                                        <!-- /.info-box-content -->
                                        <div class="d-flex flex-column">
                                            <button concepto="Categorias" type="button" class="btn-toolbar btn-ver btn-sm btn-info float-right" style="margin: 1px;" data-toggle="modal" data-target="#VisualizarA"><i class="far fa-eye"></i></button>
                                            <button concepto="Categorias" type="button" class="btn-toolbar btn-nuevo btn-sm btn-success float-right" style="margin: 1px;" data-toggle="modal" data-target="#AgregarEditarA"><i class="fas fa-plus-circle"></i></button>
                                        </div>

                                        <div class="overlay d-none" concepto="Categorias">
                                            <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                                        </div>
                                    </div>
                                    <!-- /.info-box -->
                                </div>

                                <div class="col-12 col-sm-12 col-md-6 text-nowrap">
                                    <div class="info-box border border-secondary">
                                        <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-tags"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text"><i>Marcas productos</i></span>
                                            <span class="info-box-number" concepto="Marcas productos"></span>
                                        </div>
                                        <!-- /.info-box-content -->
                                        <div class="d-flex flex-column">
                                            <button concepto="Marcas productos" type="button" class="btn-toolbar btn-ver btn-sm btn-info float-right" style="margin: 1px;" data-toggle="modal" data-target="#VisualizarA"><i class="far fa-eye"></i></button>
                                            <button concepto="Marcas productos" type="button" class="btn-toolbar btn-nuevo btn-sm btn-success float-right" style="margin: 1px;" data-toggle="modal" data-target="#AgregarEditarA"><i class="fas fa-plus-circle"></i></button>
                                        </div>

                                        <div class="overlay d-none" concepto="Marcas productos">
                                            <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                                        </div>
                                    </div>
                                    <!-- /.info-box -->
                                </div>

                                <div class="col-12 col-sm-12 col-md-6 text-nowrap">
                                    <div class="info-box border border-secondary">
                                        <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-ruler"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text"><i>Medidas</i></span>
                                            <span class="info-box-number" concepto="Medidas"></span>
                                        </div>
                                        <!-- /.info-box-content -->
                                        <div class="d-flex flex-column">
                                            <button concepto="Medidas" type="button" class="btn-toolbar btn-ver btn-sm btn-info float-right" style="margin: 1px;" data-toggle="modal" data-target="#VisualizarA"><i class="far fa-eye"></i></button>
                                            <button concepto="Medidas" type="button" class="btn-toolbar btn-nuevo btn-sm btn-success float-right" style="margin: 1px;" data-toggle="modal" data-target="#AgregarEditarA"><i class="fas fa-plus-circle"></i></button>
                                        </div>

                                        <div class="overlay d-none" concepto="Medidas">
                                            <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                                        </div>
                                    </div>
                                    <!-- /.info-box -->
                                </div>

                                <div class="col-12 col-sm-12 col-md-6 text-nowrap">
                                    <div class="info-box border border-secondary">
                                        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-user-plus"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text"><i>Tipo de proveedor</i></span>
                                            <span class="info-box-number" concepto="Tipo de proveedor"></span>
                                        </div>
                                        <!-- /.info-box-content -->
                                        <div class="d-flex flex-column">
                                            <button concepto="Tipo de proveedor" type="button" class="btn-toolbar btn-ver btn-sm btn-info float-right" style="margin: 1px;" data-toggle="modal" data-target="#VisualizarA"><i class="far fa-eye"></i></button>
                                            <button concepto="Tipo de proveedor" type="button" class="btn-toolbar btn-nuevo btn-sm btn-success float-right" style="margin: 1px;" data-toggle="modal" data-target="#AgregarEditarA"><i class="fas fa-plus-circle"></i></button>
                                        </div>

                                        <div class="overlay d-none" concepto="Tipo de proveedor">
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
     ========MODALS CREAR (MAESTRA ALMACEN) ==========
     =================================================================-->

<div class="modal fade" id="AgregarEditarA" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header bg-success">
                <h5 class="modal-title" id="titulo_modalA"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form method="post" enctype="multipart/form-data" id="formularioAlmacen">

                <div class="modal-body">

                    <input type="hidden" id="id" name="id" value="">

                    <div class="form-group">
                        <label>Agregar registro</label>
                        <div class="input-group">
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <i class="fas fa-plus-circle"></i>
                                </span>
                            </div>
                            <input class="form-control" type="text" id="entrada1" name="entrada1" required>
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

<div class="modal fade" id="VisualizarA" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

            <div class="modal-header bg-success">
                <h5 class="modal-title" id="titulo_modalVerA"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-sm table-striped table-bordered dt-responsive table-hover tablasBtnExport w-100" id="ver_concepto_a">
                        <thead class="thead-light text-uppercase text-sm text-center">
                            <tr>
                                <th style="width:10px;">#</th>
                                <th id="tipo"></th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm text-center" id="tbody_ver_concepto_a">
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
