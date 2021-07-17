
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
                    <h2 class="m-0 text-dark "><i><b>Seguridad</b></i></h2>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                        <li class="breadcrumb-item active">Seguridad</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">          
            <div class="row">
                <div class="col">
                    <div class="card border border-secondary">
                        <div class="card-header bg-success"><h5>Crear / Editar / Eliminar / Visualizar </h5></div>
                        <div class="card-body">
                            <div class="row">

                                <div class="col-12 col-sm-6 col-md-3">
                                    <div class="info-box border border-secondary">
                                      <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-users"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text"><i>Usuarios</i></span>
                                            <span class="info-box-number">
                                                    10
                                                <small>registros</small>
                                            </span>        
                                        </div>
                                        <!-- /.info-box-content -->
                                            <div>
                                                <button concepto="Usuarios" type="button" class="btn-toolbar btn-ver btn-sm btn-info float-right" style="margin: 1px;" data-toggle="modal" data-target="#VisualizarS"><i class="far fa-eye"></i></button>
                                                <button concepto="Usuarios" type="button" class="btn-toolbar btn-nuevo btn-sm btn-success float-right" style="margin: 1px;" data-toggle="modal" data-target="#AgregarEditarS"><i class="fas fa-plus-circle"></i></button>  
                                            </div>

                                            <div class="overlay dark d-none">
                                                <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                                            </div>

                                            <div class="overlay d-none" concepto="Usuarios">
                                                <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                                            </div>
                                    </div>
                                    <!-- /.info-box -->
                                </div>

                                <div class="col-12 col-sm-6 col-md-3">
                                    <div class="info-box border border-primary">
                                      <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-globe"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text"><i>Aplicaciones</i></span>
                                            <span class="info-box-number">
                                                    10
                                                <small>registros</small>
                                            </span>        
                                        </div>
                                        <!-- /.info-box-content -->
                                            <div>
                                                <button concepto="Aplicaciones" type="button" class="btn-toolbar btn-ver btn-sm btn-info float-right" style="margin: 1px;" data-toggle="modal" data-target="#VisualizarS"><i class="far fa-eye"></i></button>
                                                <button concepto="Aplicaciones" type="button" class="btn-toolbar btn-nuevo btn-sm btn-success float-right" style="margin: 1px;" data-toggle="modal" data-target="#AgregarEditarS"><i class="fas fa-plus-circle"></i></button>  
                                            </div>

                                            <div class="overlay d-none" concepto="Aplicaciones">
                                                <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                                            </div>
                                    </div>
                                    <!-- /.info-box -->
                                </div>

                                <div class="col-12 col-sm-6 col-md-3">
                                    <div class="info-box border border-secondary">
                                      <span class="info-box-icon bg-success elevation-1"><i class="fas fa-users-cog"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text"><i>Grupos</i></span>
                                            <span class="info-box-number">
                                                    10
                                                <small>registros</small>
                                            </span>        
                                        </div>
                                        <!-- /.info-box-content -->
                                            <div>
                                                <button concepto="Grupos" type="button" class="btn-toolbar btn-ver btn-sm btn-info float-right" style="margin: 1px;" data-toggle="modal" data-target="#VisualizarS"><i class="far fa-eye"></i></button>
                                                <button concepto="Grupos" type="button" class="btn-toolbar btn-nuevo btn-sm btn-success float-right" style="margin: 1px;" data-toggle="modal" data-target="#AgregarEditarS"><i class="fas fa-plus-circle"></i></button>  
                                            </div>

                                            <div class="overlay d-none" concepto="Grupos">
                                                <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                                            </div>
                                    </div>
                                    <!-- /.info-box -->
                                </div>

                                <div class="col-12 col-sm-6 col-md-3">
                                    <div class="info-box border border-secondary">
                                      <span class="info-box-icon bg-info elevation-1"><i class="far fa-object-group"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text"><i>Grupo / Aplicaciones</i></span>
                                            <span class="info-box-number">
                                                    10
                                                <small>registros</small>
                                            </span>        
                                        </div>
                                        <!-- /.info-box-content -->
                                            <div>
                                                <button concepto="Grupo / Aplicaciones" type="button" class="btn-toolbar btn-ver btn-sm btn-info float-right" style="margin: 1px;" data-toggle="modal" data-target="#VisualizarS"><i class="far fa-eye"></i></button>
                                                <button concepto="Grupo / Aplicaciones" type="button" class="btn-toolbar btn-nuevo btn-sm btn-success float-right" style="margin: 1px;" data-toggle="modal" data-target="#AgregarEditarS"><i class="fas fa-plus-circle"></i></button>  
                                            </div>

                                            <div class="overlay d-none" concepto="Grupo / Aplicaciones">
                                                <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                                            </div>
                                    </div>
                                    <!-- /.info-box -->
                                </div>

                                <div class="col-12 col-sm-6 col-md-3">
                                    <div class="info-box border border-secondary">
                                      <span class="info-box-icon bg-secondary elevation-1"><i class="fas fa-sync-alt"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text"><i>Sincronizar aplicaciones</i></span>
                                            <span class="info-box-number">
                                                    10
                                                <small>registros</small>
                                            </span>        
                                        </div>
                                        <!-- /.info-box-content -->
                                            <div>
                                                <button concepto="Sincronizar aplicaciones" type="button" class="btn-toolbar btn-ver btn-sm btn-info float-right" style="margin: 1px;" data-toggle="modal" data-target="#VisualizarS"><i class="far fa-eye"></i></button>
                                                <button concepto="Sincronizar aplicaciones" type="button" class="btn-toolbar btn-nuevo btn-sm btn-success float-right" style="margin: 1px;" data-toggle="modal" data-target="#AgregarEditarS"><i class="fas fa-plus-circle"></i></button>  
                                            </div>

                                            <div class="overlay d-none" concepto="Sincronizar aplicaciones">
                                                <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                                            </div>
                                    </div>
                                    <!-- /.info-box -->
                                </div>

                                <div class="col-12 col-sm-6 col-md-3">
                                    <div class="info-box border border-secondary">
                                      <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-key"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text"><i>Cambiar contraseña</i></span>
                                            <span class="info-box-number">
                                                    10
                                                <small>registros</small>
                                            </span>        
                                        </div>
                                        <!-- /.info-box-content -->
                                            <div>
                                                <button concepto="Cambiar contraseña" type="button" class="btn-toolbar btn-ver btn-sm btn-info float-right" style="margin: 1px;" data-toggle="modal" data-target="#VisualizarS"><i class="far fa-eye"></i></button>
                                                <button concepto="Cambiar contraseña" type="button" class="btn-toolbar btn-nuevo btn-sm btn-success float-right" style="margin: 1px;" data-toggle="modal" data-target="#AgregarEditarS"><i class="fas fa-plus-circle"></i></button>  
                                            </div>

                                            <div class="overlay d-none" concepto="Cambiar contraseña">
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
     ========MODALS CREAR / EDTIAR (MAESTRA SEGURIDAD) ==========
     =================================================================-->

     <div class="modal fade" id="AgregarEditarS" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-header bg-success">
                    <h5 class="modal-title" id ="titulo_modalS"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form method="post" enctype="multipart/form-data" id="formularioS">

                    <div class="modal-body">

                        <input type="hidden" id="idGH" name="idGH" value="">

                        <div class="form-group">
                            <label>HOLA</label>
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
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
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

     <div class="modal fade" id="VisualizarS" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">

                <div class="modal-header bg-success">
                    <h5 class="modal-title" id ="titulo_modalVerS"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-sm table-striped table-bordered dt-responsive table-hover tablasBtnExport w-100" id="ver_concepto">
                            <thead class="thead-light text-uppercase text-sm text-center">
                                <tr>
                                    <!--<th style="width:10px;">#</th>-->
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
                    <button type="button" class="btn btn-danger btn-cancelar" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save"></i>
                            Guardar
                    </button>
                </div>

            </div>
        </div>
    </div>