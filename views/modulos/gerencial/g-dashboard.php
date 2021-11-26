<?php

if (!validarPermiso('M_GERENCIAL', 'R')) {
    echo "<script> window.location = 'inicio'; </script>";
}


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
                    <h1 class="m-0 text-dark d-none">Gerencial</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                        <li class="breadcrumb-item active">Gerencial</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <!-- ===================== 
              AGREGAR FILAS Y COLUMNAS PARA EL DESARROLLO 
            ========================= -->
            <div class="row">
                <!-- =================================================== GESTION HUMANA (LINEA) =================================================== -->
                <div class="col-12 col-md-6 col-lg-8">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title font-weight-bold text-uppercase">Gestión Humana</h5>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body pl-0">
                            <div class="chart">
                                <div class="spinner-grow float-left spinner-scIngresosPersonal" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>
                                <!-- IngresosPersonal Chart Canvas -->
                                <canvas id="scIngresosPersonal" style="height: 15rem;"></canvas>
                            </div>
                            <!-- /.chart-responsive -->
                        </div>
                        <!-- ./card-body -->

                        <!-- /.card-footer -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->

                <!-- =================================================== VEHICULAR  =================================================== -->
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title font-weight-bold text-uppercase">Vehículos</h5>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body pl-0">
                            <div class="chart">
                                <div class="spinner-grow float-left spinner-scTiposVehiculos" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>
                                <!-- Tipos Vehiculos Chart Canvas -->
                                <canvas id="scTiposVehiculos" style="height: 15rem;"></canvas>
                            </div>
                            <!-- /.chart-responsive -->
                        </div>
                        <!-- ./card-body -->

                        <!-- /.card-footer -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->

            </div>

            <!-- =================================================== CONTRATOS =================================================== -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title font-weight-bold text-uppercase">Contratos</h5>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body px-0">
                            <div class="row d-flex justify-content-lg-between align-items-center">
                                <div class="col-md-5 mx-2">
                                    <div class="spinner-grow float-left spinner-scTiposContrato" role="status">
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                    <div id='scTiposContrato_progreso'>

                                    </div>
                                </div>
                                <!-- /.col -->
                                <div class="col-md-6">
                                    <div class="chart">
                                        <div class="spinner-grow float-left spinner-scViajesOcasionales" role="status">
                                            <span class="sr-only">Loading...</span>
                                        </div>
                                        <!-- Sales Chart Canvas -->
                                        <canvas id="scViajesOcasionales" style="height: 15rem;"></canvas>
                                    </div>
                                    <!-- /.chart-responsive -->
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- ./card-body -->

                        <!-- /.card-footer -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>


        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->