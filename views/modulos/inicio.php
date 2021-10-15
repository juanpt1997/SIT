<!-- =================================================== ESTILOS =================================================== -->
<style>
    .parallax1 {

        background-image: url("<?= URL_APP ?>views/img/inicio3.jpg");
        min-height: 500px;
        min-width: 500px;
        background-attachment: fixed;
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        display: grid;
        place-items: center;
    }

    .parallax2 {

        background-image: url("<?= URL_APP ?>views/img/inicio4.jpg");
        min-height: 500px;
        min-width: 500px;
        background-attachment: fixed;
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        display: grid;
        place-items: center;
    }

    .parallax3 {

        background-image: url("<?= URL_APP ?>views/img/inicio5.jpg");
        min-height: 500px;
        min-width: 500px;
        background-attachment: fixed;
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        display: grid;
        place-items: center;
    }
</style>
<!-- =================================================== CONTENT =================================================== -->
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mt-2 mb-2">
                <div class="col-sm-6">
                    <!-- <h1><b><i>Dashboard</i></b></h1> -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div><!-- /.content-header -->
    <section class="content">
        <div class="container-fluid pt-4">
            <!--MÓDULOS DE ENTRADA-->
            <div class="card">
                <div class="parallax1">
                    <div class="card-body">
                        <div class="row">
                            <!-- ===================================================
                            * Conceptos generales
                            =================================================== -->
                            <?php if (validarPermiso('M_GESTION_HUMANA', 'U') || validarPermiso('M_VEHICULAR', 'U')) : ?>
                                <div class="col-12 col-sm-6 col-md-4 col-xl-3">
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
                                            <?php if (validarPermiso('M_GESTION_HUMANA', 'U')) : ?>
                                                <a class="dropdown-item font-weight-bold" href="cg-gestion-humana"><u>Gestión humana</u></a>
                                            <?php endif ?>

                                            <?php if (validarPermiso('M_VEHICULAR', 'U')) : ?>
                                                <a class="dropdown-item font-weight-bold" href="cg-vehicular"><u>Vehicular</u></a>
                                            <?php endif ?>
                                            <?php if (validarPermiso('M_OPCIONES', 'R')) : ?>
                                                <a class="dropdown-item font-weight-bold" href="cg-mantenimiento"><u>Matenimiento</u></a>
                                                <a class="dropdown-item font-weight-bold" href="cg-seguridad"><u>Seguridad</u></a>
                                            <?php endif ?>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.col -->
                            <?php endif ?>

                            <!-- ===================================================
                            * Gestión Humana
                            =================================================== -->
                            <?php if (validarPermiso('M_GESTION_HUMANA', 'R')) : ?>
                                <div class="col-12 col-sm-6 col-md-4 col-xl-3">
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
                                            <a class="dropdown-item font-weight-bold" href="gh-bloqueo-personal"><u>Bloqueo de personal</u></a>

                                        </div>
                                    </div>
                                </div>
                                <!-- /.col -->
                            <?php endif ?>

                            <!-- ===================================================
                            * Vehicular
                            =================================================== -->
                            <?php if (validarPermiso('M_VEHICULAR', 'R')) : ?>
                                <div class="col-12 col-sm-6 col-md-4 col-xl-3">
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
                                            <a class="dropdown-item font-weight-bold" href="v-bloqueo-vehiculo"><u>Bloqueo de vehículos</u></a>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.col -->
                            <?php endif ?>

                            <!-- ===================================================
                            * Contratos
                            =================================================== -->
                            <?php if (validarPermiso('M_CONTRATOS', 'R')) : ?>
                                <div class="col-12 col-sm-6 col-md-4 col-xl-3">
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
                                        </div>
                                    </div>
                                </div>
                                <!-- /.col -->
                            <?php endif ?>


                            <!-- ===================================================
                            * Operaciones
                            =================================================== -->
                            <?php if (validarPermiso('M_OPERACIONES', 'R')) : ?>
                                <div class="col-12 col-sm-6 col-md-4 col-xl-3 d-none">
                                    <a href="#" class="d-none">
                                        <div class="info-box border border-danger">
                                            <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-cogs"></i></span>
                                            <div class="info-box-content">
                                                <span class="info-box-text font-weight-bold text-dark">Operaciones</span>
                                            </div>
                                            <!-- /.info-box-content -->
                                        </div>
                                        <!-- /.info-box -->
                                    </a>
                                </div>
                                <!-- /.col -->
                                <div class="col-12 col-sm-6 col-md-4 col-xl-3">
                                    <div class="dropdown" style="cursor: pointer;">
                                        <div class="info-box border border-dark" id="dropdownMenuOperaciones" data-toggle="dropdown">
                                            <span class="info-box-icon bg-default elevation-1"><i class="fas fa-road"></i></span>
                                            <div class="info-box-content">
                                                <span class="info-box-text font-weight-bold text-dark">Operaciones</span>
                                            </div>
                                            <!-- /.info-box-content -->
                                        </div>
                                        <!-- /.info-box -->
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuOperaciones">
                                            <a class="dropdown-item font-weight-bold" href="o-fuec"><u>FUEC</u></a>
                                            <a class="dropdown-item font-weight-bold" href="o-alistamiento"><u>Protocolo de alistamiento</u></a>
                                            <a class="dropdown-item font-weight-bold" href="o-rodamiento"><u>Plan de rodamiento</u></a>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.col -->
                            <?php endif ?>

                            <!-- ===================================================
                            * Control Usuarios
                            =================================================== -->
                            <?php if (validarPermiso('M_USUARIOS', 'R')) : ?>
                                <div class="col-12 col-sm-6 col-md-4 col-xl-3">
                                    <div class="dropdown" style="cursor: pointer;">
                                        <div class="info-box border border-info" id="dropdownMenuUsuarios" data-toggle="dropdown">
                                            <span class="info-box-icon bg-info elevation-1"><i class="fas fa-users"></i></span>
                                            <div class="info-box-content">
                                                <span class="info-box-text font-weight-bold text-dark">Control de usuarios</span>
                                            </div>
                                            <!-- /.info-box-content -->
                                        </div>
                                        <!-- /.info-box -->
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuUsuarios">
                                            <a class="dropdown-item font-weight-bold" href="usuarios"><u>Usuarios</u></a>
                                            <a class="dropdown-item font-weight-bold" href="roles-usuarios"><u>Roles de usuarios</u></a>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.col -->
                            <?php endif ?>

                            <!-- ===================================================
                            ** Mantenimiento
                            =================================================== -->
                            <?php if (validarPermiso('M_OPCIONES', 'R')) : ?>
                                <div class="col-12 col-sm-6 col-md-4 col-xl-3 d-none">
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
                                <div class="col-12 col-sm-6 col-md-4 col-xl-3">
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
                                            <a class="dropdown-item font-weight-bold" href="m-inventario"><u>Inventario</u></a>
                                            <a class="dropdown-item font-weight-bold" href="m-revision-tm"><u>Revisión tecnicomecánica</u></a>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.col -->
                            <?php endif ?>

                            <!-- ===================================================
                            ** Documentos Contable
                            =================================================== -->
                            <?php if (validarPermiso('M_OPCIONES', 'R')) : ?>
                                <div class="col-12 col-sm-6 col-md-4 col-xl-3">
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
                            <?php if (validarPermiso('M_OPCIONES', 'R')) : ?>
                                <div class="col-12 col-sm-6 col-md-4 col-xl-3">
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
                            <?php if (validarPermiso('M_OPCIONES', 'R')) : ?>
                                <div class="col-12 col-sm-6 col-md-4 col-xl-3">
                                    <a href="#">
                                        <div class="info-box border border-dark">
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
                            <?php if (validarPermiso('M_OPCIONES', 'R')) : ?>
                                <div class="col-12 col-sm-6 col-md-4 col-xl-3">
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
                            <?php if (validarPermiso('M_OPCIONES', 'R')) : ?>
                                <div class="col-12 col-sm-6 col-md-4 col-xl-3">
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
                            <?php if (validarPermiso('M_OPCIONES', 'R')) : ?>
                                <div class="col-12 col-sm-6 col-md-4 col-xl-3">
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
                            <?php if (validarPermiso('M_OPCIONES', 'R')) : ?>
                                <div class="col-12 col-sm-6 col-md-4 col-xl-3">
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
                            <?php if (validarPermiso('M_OPCIONES', 'R')) : ?>
                                <div class="col-12 col-sm-6 col-md-4 col-xl-3">
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
                </div>
            </div>
            <!--MODULO #2-->
            <!-- <div style="height:100px;font-size:60px;"></div>
            <div class="card bg-dark">
                <div class="parallax1">
                    <div class="card-body">
                        <div class="row"></div>
                    </div>
                </div>
            </div> -->
            <!--MODULO #3-->
            <!-- <div style="height:100px;font-size:60px;"></div>
            <div class="card">
                <div class="parallax1">
                    <div class="card-body">
                        <div class="row"></div>
                    </div>
                </div>
            </div> -->

        </div>
    </section>
</div>
<!-- /.content-wrapper -->