<?php if (!array_search('M_DASHBOARD', $_SESSION['opciones'])) : ?>
    <!-- <pre> -->
    <?php
    //var_dump($_SESSION['opciones']);
    ?>
    <!-- </pre> -->
<?php endif ?>

<?php

?>

<!-- =================================================== CONTENT =================================================== -->

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mt-2 mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Dashboard</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div><!-- /.content-header -->
    <section class="content">
        <div class="container-fluid pt-4">

            <!-- =================================================== CONTENIDO =================================================== -->
            <div class="row">
                <!-- ===================================================
                    * Información de la empresa
                =================================================== -->
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <a href="#">
                        <div class="info-box border border-primary">
                            <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-building"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text font-weight-bold text-dark">Información empresa</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </a>
                </div>
                <!-- /.col -->

                <!-- ===================================================
                    * Gestión Humana
                =================================================== -->
                <?php if (validarModulo('M_GESTION_HUMANA')) : ?>
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                        <div class="dropdown" style="cursor: pointer;">
                            <div class="info-box border border-secondary" id="dropdownMenuGH" data-toggle="dropdown">
                                <span class="info-box-icon bg-secondary elevation-1"><i class="fas fa-user-friends"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text font-weight-bold text-dark">Gestión Humana</span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuGH">
                                <a class="dropdown-item font-weight-bold" href="gh-personal">Personal</a>
                                <a class="dropdown-item font-weight-bold" href="gh-perfil-sd">Perfil sociodemográfico</a>
                                <a class="dropdown-item font-weight-bold" href="gh-pago-ss">Pago seguridad social</a>
                                <a class="dropdown-item font-weight-bold" href="gh-alertas-contratos">Alertas de contrato</a>
                            </div>
                        </div>
                    </div>
                    <!-- /.col -->
                <?php endif ?>

                <!-- ===================================================
                    * Vehicular
                =================================================== -->
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <a href="#">
                        <div class="info-box border border-success">
                            <span class="info-box-icon bg-success elevation-1"><i class="fas fa-truck"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text font-weight-bold text-dark">Vehicular</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </a>
                </div>
                <!-- /.col -->

                <!-- ===================================================
                    * Extractos de contrato
                =================================================== -->
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <a href="#">
                        <div class="info-box border border-warning">
                            <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-folder-open"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text font-weight-bold text-dark">Extractos de contrato</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </a>
                </div>
                <!-- /.col -->

                <!-- ===================================================
                    * Mantenimiento
                =================================================== -->
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <a href="#">
                        <div class="info-box border border-danger">
                            <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-cogs"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text font-weight-bold text-dark">Mantenimiento</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </a>
                </div>
                <!-- /.col -->

                <!-- ===================================================
                    * Documentos Contable
                =================================================== -->
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <a href="#">
                        <div class="info-box border border-info">
                            <span class="info-box-icon bg-info elevation-1"><i class="fas fa-book"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text font-weight-bold text-dark">Documentos Contable</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </a>
                </div>
                <!-- /.col -->

                <!-- ===================================================
                    * Comercial
                =================================================== -->
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <a href="#">
                        <div class="info-box border border-dark">
                            <span class="info-box-icon bg-dark elevation-1"><i class="fas fa-chart-line"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text font-weight-bold text-dark">Comercial</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </a>
                </div>
                <!-- /.col -->

                <!-- ===================================================
                    * Escolar
                =================================================== -->
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <a href="#">
                        <div class="info-box border border-light">
                            <span class="info-box-icon bg-light elevation-1"><i class="fas fa-school"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text font-weight-bold text-dark">Escolar</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </a>
                </div>
                <!-- /.col -->

                <!-- ===================================================
                    * Contratos Fijos
                =================================================== -->
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <a href="#">
                        <div class="info-box border border-secondary">
                            <span class="info-box-icon bg-secondary elevation-1"><i class="fas fa-file-contract"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text font-weight-bold text-dark">Contratos Fijos</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </a>
                </div>
                <!-- /.col -->

                <!-- ===================================================
                    * Compras
                =================================================== -->
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <a href="#">
                        <div class="info-box border border-danger">
                            <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-shopping-cart"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text font-weight-bold text-dark">Compras</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </a>
                </div>
                <!-- /.col -->

                <!-- ===================================================
                    * Estandar. procesos calidad
                =================================================== -->
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <a href="#">
                        <div class="info-box border border-warning">
                            <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-tasks"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text font-weight-bold text-dark">Estandar. procesos calidad</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </a>
                </div>
                <!-- /.col -->

                <!-- ===================================================
                    * Formatos de calidad
                =================================================== -->
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <a href="#">
                        <div class="info-box border border-primary">
                            <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-clipboard-check"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text font-weight-bold text-dark">Formatos de calidad</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </a>
                </div>
                <!-- /.col -->

                <!-- ===================================================
                    * Control Usuarios
                =================================================== -->
                <?php if (validarModulo('M_USUARIOS')) : ?>
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                        <a href="usuarios">
                            <div class="info-box border border-success">
                                <span class="info-box-icon bg-success elevation-1"><i class="fas fa-users"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text font-weight-bold text-dark">Control Usuarios</span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </a>
                    </div>
                    <!-- /.col -->
                <?php endif ?>

                <!-- ===================================================
                    * Rastreo Satelital
                =================================================== -->
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <a href="#">
                        <div class="info-box border border-info">
                            <span class="info-box-icon bg-info elevation-1"><i class="fas fa-map-marked-alt"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text font-weight-bold text-dark">Rastreo Satelital</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </a>
                </div>
                <!-- /.col -->


            </div>

        </div>
    </section>
</div>
<!-- /.content-wrapper -->