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
                    * Conceptos generales
                =================================================== -->
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <div class="dropdown" style="cursor: pointer;">
                        <div class="info-box border border-primary" id="dropdownMenuCG" data-toggle="dropdown">
                            <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-building"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text font-weight-bold text-dark">Conceptos generales</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuCG">
                            <a class="dropdown-item font-weight-bold" href="cg-gestion-humana"><u>Gestión humana</u></a>
                            <a class="dropdown-item font-weight-bold" href="cg-vehicular"><u>Vehicular</u></a>
                            <?php if (validarModulo('M_OPCIONES')) : ?>
                                <a class="dropdown-item font-weight-bold" href="cg-mantenimiento"><u>Matenimiento</u></a>
                                <a class="dropdown-item font-weight-bold" href="cg-seguridad"><u>Seguridad</u></a>
                            <?php endif ?>
                        </div>
                    </div>
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
                                <a class="dropdown-item font-weight-bold" href="gh-personal"><u>Personal</u></a>
                                <a class="dropdown-item font-weight-bold" href="gh-perfil-sd"><u>Perfil sociodemográfico</u></a>
                                <a class="dropdown-item font-weight-bold" href="gh-pago-ss"><u>Pago seguridad social</u></a>
                                <a class="dropdown-item font-weight-bold" href="gh-alertas-contratos"><u>Alertas de contrato</u></a>
                                <a class="dropdown-item font-weight-bold" href="gh-ausentismo"><u>Control de ausentismo</u></a>
                            </div>
                        </div>
                    </div>
                    <!-- /.col -->
                <?php endif ?>

                <!-- ===================================================
                    * Vehicular
                =================================================== -->
                <?php if (validarModulo('M_VEHICULAR')) : ?>
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                        <div class="dropdown" style="cursor: pointer;">
                            <div class="info-box border border-success" id="dropdownMenuVehicular" data-toggle="dropdown">
                                <span class="info-box-icon bg-success elevation-1"><i class="fas fa-truck"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text font-weight-bold text-dark">Vehicular</span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuVehicular">
                                <a class="dropdown-item font-weight-bold" href="v-vehiculos"><u>Vehículos</u></a>
                                <a class="dropdown-item font-weight-bold" href="v-propietarios"><u>Propietarios</u></a>
                                <a class="dropdown-item font-weight-bold" href="v-convenios"><u>Convenios</u></a>
                                <a class="dropdown-item font-weight-bold" href="v-bloqueo-personal"><u>Bloqueo de personal</u></a>
                                <a class="dropdown-item font-weight-bold" href="v-bloqueo-vehiculo"><u>Bloqueo de vehículos</u></a>
                            </div>
                        </div>
                    </div>
                    <!-- /.col -->
                <?php endif ?>

                <!-- ===================================================
                    * Contratos
                =================================================== -->
                <?php if (validarModulo('M_CONTRATOS')) : ?>
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                        <div class="dropdown" style="cursor: pointer;">
                            <div class="info-box border border-warning" id="dropdownMenuContratos" data-toggle="dropdown">
                                <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-folder-open"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text font-weight-bold text-dark">Contratos</span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuContratos">
                                <a class="dropdown-item font-weight-bold" href="contratos-clientes"><u>Clientes</u></a>
                                <a class="dropdown-item font-weight-bold" href="contratos-fijos"><u>Fijos</u></a>
                                <a class="dropdown-item font-weight-bold" href="contratos-cotizaciones"><u>Cotizaciones</u></a>
                                <a class="dropdown-item font-weight-bold" href="contratos-ordenservicio"><u>Orden de servicio</u></a>
                                <a class="dropdown-item font-weight-bold" href="contratos-fuec"><u>FUEC</u></a>
                            </div>
                        </div>
                    </div>
                    <!-- /.col -->
                <?php endif ?>

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
                    ** Mantenimiento
                =================================================== -->
                <?php if (validarModulo('M_OPCIONES')) : ?>
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3 d-none">
                        <a href="#" class="d-none">
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
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                        <div class="dropdown" style="cursor: pointer;">
                            <div class="info-box border border-danger" id="dropdownMenuMantenimiento" data-toggle="dropdown">
                                <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-cogs"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text font-weight-bold text-dark">Mantenimiento</span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuMantenimiento">
                                <a class="dropdown-item font-weight-bold" href="m-proveedores"><u>Proveedores</u></a>
                                <a class="dropdown-item font-weight-bold" href="m-alistamiento"><u>Protocolo de Alistamiento</u></a>
                                <a class="dropdown-item font-weight-bold" href="m-inventario"><u>Inventario</u></a>
                                <a class="dropdown-item font-weight-bold" href="m-rodamiento"><u>Plan de Rodamiento</u></a>
                            </div>
                        </div>
                    </div>
                    <!-- /.col -->
                <?php endif ?>

                <!-- ===================================================
                    ** Documentos Contable
                =================================================== -->
                <?php if (validarModulo('M_OPCIONES')) : ?>
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
                <?php endif ?>

                <!-- ===================================================
                    ** Comercial
                =================================================== -->
                <?php if (validarModulo('M_OPCIONES')) : ?>
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
                <?php endif ?>

                <!-- ===================================================
                    ** Escolar
                =================================================== -->
                <?php if (validarModulo('M_OPCIONES')) : ?>
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
                <?php endif ?>

                <!-- ===================================================
                    ** Contratos Fijos
                =================================================== -->
                <?php if (validarModulo('M_OPCIONES')) : ?>
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
                <?php endif ?>

                <!-- ===================================================
                    ** Compras
                =================================================== -->
                <?php if (validarModulo('M_OPCIONES')) : ?>
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
                <?php endif ?>

                <!-- ===================================================
                    ** Estandar. procesos calidad
                =================================================== -->
                <?php if (validarModulo('M_OPCIONES')) : ?>
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
                <?php endif ?>

                <!-- ===================================================
                    ** Formatos de calidad
                =================================================== -->
                <?php if (validarModulo('M_OPCIONES')) : ?>
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
                <?php endif ?>

                <!-- ===================================================
                    ** Rastreo Satelital
                =================================================== -->
                <?php if (validarModulo('M_OPCIONES')) : ?>
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
                <?php endif ?>


            </div>

        </div>
    </section>
</div>
<!-- /.content-wrapper -->