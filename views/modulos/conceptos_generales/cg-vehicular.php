
<!-- ===================== 
  CONCEPTOS GENERALES - Vehicular (modulo)
  ========================= --> 

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mt-2 mb-2">
                <div class="col-sm-6">
                    <h2 class="m-0 text-dark "><i><b>Vehicular</b></i></h2>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                        <li class="breadcrumb-item active">Vehicular</li>
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
                        <div class="card-header bg-success"><h5>Crear / Editar / Eliminar / Visualizar</h5></div>
                        <div class="card-body">
                            <div class="row">

                                <div class="col-12 col-sm-6 col-md-3">
                                    <div class="info-box border border-secondary">
                                      <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-file-signature"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text"><i>Objeto de contrato</i></span>
                                            <span class="info-box-number" concepto="Objeto de contrato"></span>        
                                        </div>
                                        <!-- /.info-box-content -->
                                            <div>
                                                <button concepto="Objeto de contrato" type="button" class="btn-toolbar btn-ver btn-sm btn-info float-right" style="margin: 1px;" data-toggle="modal" data-target="#VisualizarV"><i class="far fa-eye"></i></button>
                                                <button concepto="Objeto de contrato" type="button" class="btn-toolbar btn-nuevo btn-sm btn-success float-right" style="margin: 1px;" data-toggle="modal" data-target="#AgregarEditarV" id="btn-tausentismo"><i class="fas fa-plus-circle"></i></button>  
                                            </div>

                                            <div class="overlay d-none" concepto="Objeto de contrato">
                                                <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                                            </div>
                                    </div>
                                    <!-- /.info-box -->
                                </div>

                                <div class="col-12 col-sm-6 col-md-3">
                                    <div class="info-box border border-secondary">
                                      <span class="info-box-icon bg-info elevation-1"><i class="fas fa-road"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text"><i>Rutas y recorridos</i></span>
                                            <span class="info-box-number" concepto="Rutas y recorridos"></span>        
                                        </div>
                                        <!-- /.info-box-content -->
                                            <div>
                                                <button concepto="Rutas y recorridos" type="button" class="btn-toolbar btn-ver-ruta btn-sm btn-info float-right" style="margin: 1px;" data-toggle="modal" data-target="#VisualizarRutas"><i class="far fa-eye"></i></button>
                                                <button concepto="Rutas y recorridos" type="button" class="btn-toolbar btn-nueva-ruta btn-sm btn-success float-right" style="margin: 1px;" data-toggle="modal" data-target="#AgregarRuta" id="btn-tausentismo"><i class="fas fa-plus-circle"></i></button>  
                                            </div>

                                            <div class="overlay d-none" concepto="Rutas y recorridos">
                                                <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                                            </div>
                                    </div>
                                    <!-- /.info-box -->
                                </div>

                                <!-- <div class="col-12 col-sm-6 col-md-3">
                                    <div class="info-box border border-secondary">
                                      <span class="info-box-icon bg-success elevation-1"><i class="fas fa-dollar-sign"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text"><i>Recorridos y precios</i></span>
                                            <span class="info-box-number">
                                                    10
                                                <small>registros</small>
                                            </span>        
                                        </div> -->
                                        <!-- /.info-box-content -->
                                            <!-- <div>
                                                <button concepto="Recorridos y precios" type="button" class="btn-toolbar btn-ver btn-sm btn-info float-right" style="margin: 1px;" data-toggle="modal" data-target="#VisualizarV"><i class="far fa-eye"></i></button>
                                                <button concepto="Recorridos y precios" type="button" class="btn-toolbar btn-nuevo btn-sm btn-success float-right" style="margin: 1px;" data-toggle="modal" data-target="#AgregarEditarV" id="btn-tausentismo"><i class="fas fa-plus-circle"></i></button>  
                                            </div>

                                            <div class="overlay d-none" concepto="Recorridos y precios">
                                                <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                                            </div>
                                    </div> -->
                                    <!-- /.info-box -->
                                <!-- </div> -->

                                <div class="col-12 col-sm-6 col-md-3">
                                    <div class="info-box border border-secondary">
                                      <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-id-badge"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text"><i>Categorias de licencias</i></span>
                                            <span class="info-box-number" concepto="Categorias de licencias"></span>        
                                        </div>
                                        <!-- /.info-box-content -->
                                            <div>
                                                <button concepto="Categorias de licencias" type="button" class="btn-toolbar btn-ver-2 btn-sm btn-info float-right" style="margin: 1px;" data-toggle="modal" data-target="#VisualizarV1"><i class="far fa-eye"></i></button>
                                                <button concepto="Categorias de licencias" type="button" class="btn-toolbar btn-nuevo-2 btn-sm btn-success float-right" style="margin: 1px;" data-toggle="modal" data-target="#AgregarEditarV2" id="btn-tausentismo"><i class="fas fa-plus-circle"></i></button>  
                                            </div>

                                            <div class="overlay d-none" concepto="Categorias de licencias">
                                                <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                                            </div>
                                    </div>
                                    <!-- /.info-box -->
                                </div>

                                <div class="col-12 col-sm-6 col-md-3">
                                    <div class="info-box border border-secondary">
                                      <span class="info-box-icon bg-success elevation-1"><i class="fas fa-registered"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text"><i>Marcas de vehículos</i></span>
                                            <span class="info-box-number" concepto="Marcas de vehículos"></span>        
                                        </div>
                                        <!-- /.info-box-content -->
                                            <div>
                                                <button concepto="Marcas de vehículos" type="button" class="btn-toolbar btn-ver btn-sm btn-info float-right" style="margin: 1px;" data-toggle="modal" data-target="#VisualizarV"><i class="far fa-eye"></i></button>
                                                <button concepto="Marcas de vehículos" type="button" class="btn-toolbar btn-nuevo btn-sm btn-success float-right" style="margin: 1px;" data-toggle="modal" data-target="#AgregarEditarV" id="btn-tausentismo"><i class="fas fa-plus-circle"></i></button>  
                                            </div>

                                            <div class="overlay d-none" concepto="Marcas de vehículos">
                                                <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                                            </div>
                                    </div>
                                    <!-- /.info-box -->
                                </div>

                                <div class="col-12 col-sm-6 col-md-3">
                                    <div class="info-box border border-secondary">
                                      <span class="info-box-icon bg-dark elevation-1"><i class="fas fa-file-alt"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text"><i>Documento vehicular</i></span>
                                            <span class="info-box-number" concepto="Documento vehicular"></span>        
                                        </div>
                                        <!-- /.info-box-content -->
                                            <div>
                                                <button concepto="Documento vehicular" type="button" class="btn-toolbar btn-ver-documento btn-sm btn-info float-right" style="margin: 1px;" data-toggle="modal" data-target="#VisualizarV1"><i class="far fa-eye"></i></button>
                                                <button concepto="Documento vehicular" type="button" class="btn-toolbar btn-nuevo-documento btn-sm btn-success float-right" style="margin: 1px;" data-toggle="modal" data-target="#AgregarEditarV3" id="btn-tausentismo"><i class="fas fa-plus-circle"></i></button>  
                                            </div>

                                            <div class="overlay d-none" concepto="Documento vehicular">
                                                <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                                            </div>
                                    </div>
                                    <!-- /.info-box -->
                                </div>

                                <div class="col-12 col-sm-6 col-md-3">
                                    <div class="info-box border border-secondary">
                                      <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-bus-alt"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text"><i>Tipos de vehículos</i></span>
                                            <span class="info-box-number" concepto="Tipos de vehiculos"></span>        
                                        </div>
                                        <!-- /.info-box-content -->
                                            <div>
                                                <button concepto="Tipos de vehiculos" type="button" class="btn-toolbar btn-ver btn-sm btn-info float-right" style="margin: 1px;" data-toggle="modal" data-target="#VisualizarV"><i class="far fa-eye"></i></button>
                                                <button concepto="Tipos de vehiculos" type="button" class="btn-toolbar btn-nuevo btn-sm btn-success float-right" style="margin: 1px;" data-toggle="modal" data-target="#AgregarEditarV" id="btn-tausentismo"><i class="fas fa-plus-circle"></i></button>  
                                            </div>

                                            <div class="overlay d-none" concepto="Tipos de vehiculos">
                                                <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                                            </div>
                                    </div>
                                    <!-- /.info-box -->
                                </div>

                                <div class="col-12 col-sm-6 col-md-3">
                                    <div class="info-box border border-secondary">
                                      <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-id-card-alt"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text"><i>Tipos de identificación</i></span>
                                            <span class="info-box-number" concepto="Tipos de identificación"><small>registros</small>
                                            </span>        
                                        </div>
                                        <!-- /.info-box-content -->
                                            <div>
                                                <button concepto="Tipos de identificación" type="button" class="btn-toolbar btn-ver-2 btn-sm btn-info float-right" style="margin: 1px;" data-toggle="modal" data-target="#VisualizarV1"><i class="far fa-eye"></i></button>
                                                <button concepto="Tipos de identificación" type="button" class="btn-toolbar btn-nuevo-2 btn-sm btn-success float-right" style="margin: 1px;" data-toggle="modal" data-target="#AgregarEditarV2" id="btn-tausentismo"><i class="fas fa-plus-circle"></i></button>  
                                            </div>

                                            <div class="overlay d-none" concepto="Tipos de identificación">
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

<!-- ===================================================================
     ========MODALS CREAR / EDTIAR (MAESTRA VEHICULAR) =================
     =================================================================-->
     <div class="modal fade" id="AgregarEditarV" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-header bg-success">
                    <h5 class="modal-title" id ="titulo_modalV"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form method="post" enctype="multipart/form-data" id="formularioV">

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
     ========MODALS VISUALIZAR - ELIMINAR ================================
     ==================================================================-->
     <div class="modal fade" id="VisualizarV" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">

                <div class="modal-header bg-success">
                    <h5 class="modal-title" id ="titulo_modalVerV"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-sm table-striped table-bordered dt-responsive table-hover tablasBtnExport w-100" id="ver_conceptoV">
                            <thead class="thead-light text-uppercase text-sm text-center">
                                <tr>
                                    <th style="width:10px;">#</th>
                                    <th id="tipoV"></th>
                                    <th>Acciones</th>
                                </tr>
                            </thead> 
                            <tbody class="text-sm text-center" id="tbody_ver_conceptoV">
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
     ========MODALS CREAR / EDITAR 2 =====================================
     ==================================================================-->
    <div class="modal fade" id="AgregarEditarV2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-header bg-success">
                    <h5 class="modal-title" id ="titulo_modalV2"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form method="post" enctype="multipart/form-data" id="formularioV2">

                    <div class="modal-body">

                        <input type="hidden" id="idGH" name="idGH" value="">

                        <div class="form-group">
                            <label>Tipo</label>
                            <div class="input-group">
                                <div class="input-group-append">
                                    <span class="input-group-text">
                                        <i class="fas fa-address-card"></i>
                                    </span>
                                </div>
                                <input class="form-control" type="text" id="input_campo_uno" name="input_campo_uno" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Descripción</label>
                            <div class="input-group">
                                <div class="input-group-append">
                                    <span class="input-group-text">
                                        <i class="fas fa-address-card"></i>
                                    </span>
                                </div>
                                <input class="form-control" type="text" id="input_campo_dos" name="input_campo_dos" required>
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
     ========MODALS CREAR / EDITAR 3======================================
     ==================================================================-->
     <div class="modal fade" id="AgregarEditarV3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-header bg-success">
                    <h5 class="modal-title" id ="titulo_modalV3"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form method="post" enctype="multipart/form-data" id="formularioV3">

                    <div class="modal-body">
                        <input type="hidden" id="idGH" name="idGH" value="">

                        <div class="form-group">
                            <label>Tipo de documento</label>
                            <div class="input-group">
                                <div class="input-group-append">
                                    <span class="input-group-text">
                                        <i class="fas fa-address-card"></i>
                                    </span>
                                </div>
                                <input class="form-control" type="text" id="input_tipo" name="input_tipo" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Días (alerta)</label>
                            <div class="input-group">
                                <div class="input-group-append">
                                    <span class="input-group-text">
                                        <i class="fas fa-address-card"></i>
                                    </span>
                                </div>
                                <input class="form-control" type="number" id="input_dias" name="input_dias" required>
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
     ========MODALS VISUALIZAR - ELIMINAR 2 ================================
     ==================================================================-->
     <div class="modal fade" id="VisualizarV1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">

                <div class="modal-header bg-success">
                    <h5 class="modal-title" id ="titulo_modalVerV2"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-sm table-striped table-bordered dt-responsive table-hover tablasBtnExport w-100" id="ver_conceptoV2">
                            <thead class="thead-light text-uppercase text-sm text-center">
                                <tr>
                                    <th style="width:10px;">#</th>
                                    <th id="tipoV1"></th>
                                    <th id="tipoV2"></th>
                                    <th>Acciones</th>
                                </tr>
                            </thead> 
                            <tbody class="text-sm text-center" id="tbody_ver_conceptoV2">
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

    <!-- ===================================================================
     ========MODALS CREAR / EDTIAR (RUTAS) =================
     =================================================================-->
     <div class="modal fade" id="AgregarRuta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-header bg-success">
                    <h5 class="modal-title" id ="titulo_modal_ruta"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form method="post" enctype="multipart/form-data" id="formularioRuta">

                    <div class="modal-body">

                        <input type="hidden" id="idGH" name="idGH" value="">

                        <div class="form-group">
                            <label>Origen</label>
                            <div class="input-group">
                                <div class="input-group-append">
                                    <span class="input-group-text">
                                        <i class="fas fa-address-card"></i>
                                    </span>
                                </div>
                                <input class="form-control" type="text" id="origen" name="origen" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Destino</label>
                            <div class="input-group">
                                <div class="input-group-append">
                                    <span class="input-group-text">
                                        <i class="fas fa-address-card"></i>
                                    </span>
                                </div>
                                <input class="form-control" type="text" id="destino" name="destino" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Ruta</label>
                            <div class="input-group">
                                <div class="input-group-append">
                                    <span class="input-group-text">
                                        <i class="fas fa-address-card"></i>
                                    </span>
                                </div>
                                <input class="form-control" type="text" id="id_ruta" name="id_ruta" required>
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
     ========MODALS VISUALIZAR - ELIMINAR RUTAS ================================
     ==================================================================-->
     <div class="modal fade" id="VisualizarRutas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">

                <div class="modal-header bg-success">
                    <h5 class="modal-title" id ="titulo_ver_rutas"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-sm table-striped table-bordered dt-responsive table-hover tablasBtnExport w-100" id="ver_ruta">
                            <thead class="thead-light text-uppercase text-sm text-center">
                                <tr>
                                    <th style="width:10px;">#</th>
                                    <th>Origen</th>
                                    <th>Destino</th>
                                    <th>Ruta</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead> 
                            <tbody class="text-sm text-center" id="tbody_ver_ruta">
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