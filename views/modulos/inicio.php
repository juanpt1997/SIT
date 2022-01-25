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
    }

    .calendar-responsive {
        display: grid;
        grid-gap: 5px;
        grid-template-columns: repeat(auto-fit, minmax(100px, 1fr));
        grid-template-rows: repeat(2, 100px);
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
            <div class="card card-navy card-tabs">

                <div class="card-header p-0 pt-1">
                    <ul class="nav nav-tabs" id="custom-tabs-five-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="custom-tabs-five-overlay-tab" data-toggle="pill" href="#custom-tabs-five-overlay" role="tab" aria-controls="custom-tabs-five-overlay" aria-selected="true"><i class="fas fa-th-large"></i> <strong><i>MENÚ</i></strong> </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="custom-tabs-five-normal-tab" data-toggle="pill" href="#custom-tabs-five-normal" role="tab" aria-controls="custom-tabs-five-normal" aria-selected="false"><i class="far fa-calendar-alt"></i> <i>CALENDARIO - TAREAS</i> </a>
                        </li>
                    </ul>
                </div>

                <div class="parallax2">
                    <div class="card-body">
                        <div class="tab-content" id="custom-tabs-five-tabContent">

                            <div class="tab-pane fade active show" id="custom-tabs-five-overlay" role="tabpanel" aria-labelledby="custom-tabs-five-overlay-tab">
                                <div class="row">
                                    <!-- ===================================================
                                        ** Gerencial
                                        =================================================== -->
                                    <?php if (validarPermiso('M_GERENCIAL', 'R')) : ?>
                                        <div class="col-12 col-sm-6 col-md-4 col-xl-3">
                                            <a href="g-dashboard">
                                                <div class="info-box border border-dark">
                                                    <span class="info-box-icon bg-dark elevation-1"><i class="fas fa-chalkboard-teacher"></i></span>
                                                    <div class="info-box-content">
                                                        <span class="info-box-text font-weight-bold text-dark">Gerencial</span>
                                                    </div>
                                                    <!-- /.info-box-content -->
                                                </div>
                                            </a>
                                        </div>
                                        <!-- /.col -->
                                    <?php endif ?>
                                    <!-- ===================================================
                                            * Conceptos generales
                                            =================================================== -->
                                    <?php if (validarPermiso('M_GESTION_HUMANA', 'U') || validarPermiso('M_VEHICULAR', 'U')) : ?>
                                        <div class="col-12 col-sm-6 col-md-4 col-xl-3">
                                            <div class="dropdown" style="cursor: pointer;">
                                                <div class="info-box border border-primary" id="dropdownMenuCG" data-toggle="dropdown">
                                                    <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-building"></i></span>
                                                    <div class="info-box-content">
                                                        <span class="info-box-text font-weight-bold text-dark">Conceptos
                                                            generales</span>
                                                    </div>
                                                    <!-- /.info-box-content -->
                                                </div>
                                                <!-- /.info-box -->
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuCG">
                                                    <?php if (validarPermiso('M_GESTION_HUMANA', 'U')) : ?>
                                                        <a class="dropdown-item font-weight-bold" href="cg-gestion-humana"><u>Gestión
                                                                humana</u></a>
                                                    <?php endif ?>

                                                    <?php if (validarPermiso('M_VEHICULAR', 'U')) : ?>
                                                        <a class="dropdown-item font-weight-bold" href="cg-vehicular"><u>Vehicular</u></a>
                                                    <?php endif ?>
                                                    <?php if (validarPermiso('M_MANTENIMIENTO', 'R')) : ?>
                                                        <a class="dropdown-item font-weight-bold" href="cg-mantenimiento"><u>Matenimiento</u></a>
                                                    <?php endif ?>
                                                    <?php if (validarPermiso('M_ALMACEN', 'R')) : ?>
                                                        <a class="dropdown-item font-weight-bold" href="cg-almacen"><u>Almacén</u></a>
                                                    <?php endif ?>
                                                    <?php if (validarPermiso('M_OPCIONES', 'R')) : ?>
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
                                                        <span class="info-box-text font-weight-bold text-dark">Gestión
                                                            Humana</span>
                                                    </div>
                                                    <!-- /.info-box-content -->
                                                </div>
                                                <!-- /.info-box -->
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuGH">
                                                    <a class="dropdown-item font-weight-bold" href="gh-personal"><u>Personal</u></a>
                                                    <a class="dropdown-item font-weight-bold" href="gh-perfil-sd"><u>Perfil
                                                            sociodemográfico</u></a>
                                                    <a class="dropdown-item font-weight-bold" href="gh-pago-ss"><u>Pago seguridad
                                                            social</u></a>
                                                    <a class="dropdown-item font-weight-bold" href="gh-alertas-contratos"><u>Alertas de contrato</u></a>
                                                    <a class="dropdown-item font-weight-bold" href="gh-ausentismo"><u>Control de
                                                            ausentismo</u></a>
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
                                                    <a class="dropdown-item font-weight-bold" href="v-bloqueo-vehiculo"><u>Bloqueo
                                                            de vehículos</u></a>
                                                    <a class="dropdown-item font-weight-bold" href="v-comparendos"><u>Consulta de comparendos</u></a>
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
                                                    <a class="dropdown-item font-weight-bold" href="o-alistamiento"><u>Protocolo
                                                            de alistamiento</u></a>
                                                    <a class="dropdown-item font-weight-bold" href="o-rodamiento"><u>Plan de
                                                            rodamiento</u></a>
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
                                                        <span class="info-box-text font-weight-bold text-dark">Control de
                                                            usuarios</span>
                                                    </div>
                                                    <!-- /.info-box-content -->
                                                </div>
                                                <!-- /.info-box -->
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuUsuarios">
                                                    <a class="dropdown-item font-weight-bold" href="usuarios"><u>Usuarios</u></a>
                                                    <a class="dropdown-item font-weight-bold" href="roles-usuarios"><u>Roles de
                                                            usuarios</u></a>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.col -->
                                    <?php endif ?>

                                    <!-- ===================================================
                                            ** Almacen
                                            =================================================== -->
                                    <?php if (validarPermiso('M_ALMACEN', 'R')) : ?>
                                        <div class="col-12 col-sm-6 col-md-4 col-xl-3 d-none">
                                            <a href="a-inventario">
                                                <div class="info-box border border-dark">
                                                    <span class="info-box-icon bg-dark elevation-1"><i class="fas fa-warehouse"></i>
                                                        <div class="info-box-content">
                                                            <span class="info-box-text font-weight-bold text-dark">Almacén</span>
                                                        </div>
                                                        <!-- /.info-box-content -->
                                                </div>
                                                <!-- /.info-box -->
                                            </a>
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-12 col-sm-6 col-md-4 col-xl-3">
                                            <a href="a-inventario">
                                                <div class="info-box border border-dark">
                                                    <span class="info-box-icon bg-dark elevation-1"><i class="fas fa-warehouse"></i></span>
                                                    <div class="info-box-content">
                                                        <span class="info-box-text font-weight-bold text-dark">Almacén</span>
                                                    </div>
                                                    <!-- /.info-box-content -->
                                                </div>
                                            </a>
                                            <!-- /.info-box -->
                                            <!-- <div class="dropdown-menu" aria-labelledby="dropdownMenuAlmacen">
                                              <a class="dropdown-item font-weight-bold" href="a-inventario"><u>Inventario</u></a>
                                          </div> -->
                                        </div>
                                        <!-- /.col -->
                                    <?php endif ?>
                                    <!-- ===================================================
                                            ** Mantenimiento
                                            =================================================== -->
                                    <?php if (validarPermiso('M_MANTENIMIENTO', 'R')) : ?>
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
                                                    <a class="dropdown-item font-weight-bold" href="m-mantenimientos"><u>Mantenimientos</u></a>
                                                    <a class="dropdown-item font-weight-bold" href="m-inventario"><u>Inventario</u></a>
                                                    <a class="dropdown-item font-weight-bold" href="m-revision-tm"><u>Revisión
                                                            tecnicomecánica</u></a>
                                                    <a class="dropdown-item font-weight-bold" href="m-control-llantas   "><u>Control de llantas</u></a>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.col -->
                                    <?php endif ?>

                                    <!-- ===================================================
                                            ** Rastreo Satelital
                                            =================================================== -->
                                    <?php if (validarPermiso('M_TRACKER', 'R')) : ?>
                                        <div class="col-12 col-sm-6 col-md-4 col-xl-3">
                                            <a href="tr-gps">
                                                <div class="info-box border border-info">
                                                    <span class="info-box-icon bg-info elevation-1"><i class="fas fa-map-marked-alt"></i></span>
                                                    <div class="info-box-content">
                                                        <span class="info-box-text font-weight-bold text-dark">Tecnolab Tracker</span>
                                                    </div>
                                                </div>
                                            </a>
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
                                                        <span class="info-box-text font-weight-bold text-dark">Documentos
                                                            Contable</span>
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
                                            <a href="e-escolar">
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
                                        ** Compras
                                        =================================================== -->
                                    <?php if (validarPermiso('M_OPCIONES', 'R')) : ?>
                                        <div class="col-12 col-sm-6 col-md-4 col-xl-3 d-none">
                                            <div class="dropdown" style="cursor: pointer;">
                                                <div class="info-box border border-danger" id="dropdownMenuCompras" data-toggle="dropdown">
                                                    <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-shopping-cart"></i></span>
                                                    <div class="info-box-content">
                                                        <span class="info-box-text font-weight-bold text-dark">Compras</span>
                                                    </div>
                                                    <!-- /.info-box-content -->
                                                </div>
                                                <!-- /.info-box -->
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuCompras">
                                                    <a class="dropdown-item font-weight-bold" href="c-proveedores"><u>Proveedores</u></a>
                                                    <a class="dropdown-item font-weight-bold" href="c-orden-compra"><u>Orden de compra</u></a>
                                                </div>
                                            </div>
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
                                                        <span class="info-box-text font-weight-bold text-dark">Estandar. procesos
                                                            calidad</span>
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
                                                        <span class="info-box-text font-weight-bold text-dark">Formatos de
                                                            calidad</span>
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
                            <div class="tab-pane fade calendar-responsive" id="custom-tabs-five-normal" role="tabpanel" aria-labelledby="custom-tabs-five-normal-tab">
                                <div class="row">
                                    <!--SECCION PARA AÑADIR TAREAS-->
                                    <div class="col-lg-3 col-12">
                                        <div class="card border border-dark">
                                            <div class="card-header bg-gradient-lightblue">
                                                <h1 class="card-title"><i class="fas fa-thumbtack" style="color: white; "></i> <strong><i>CREAR TAREA</i></strong></h1>
                                            </div>
                                            <div class="card-body">

                                                <div class="col">
                                                    <div class="form-group">
                                                        <label class="col-form-label" for="titulo_tarea"><i>Título</i></label>
                                                        <input type="text" class="form-control is-valid" id="titulo_tarea" name="titulo_tarea">
                                                    </div>
                                                </div>

                                                <div class="col">
                                                    <div class="form-group">
                                                        <label class="col-form-label" for="descripcion_tarea"><i>Descripción</i></label>
                                                        <textarea type="text" class="form-control is-valid" id="descripcion_tarea" name="descripcion_tarea" maxlength="100"></textarea>
                                                    </div>
                                                </div>

                                                <div class="col">
                                                    <div class="form-group">
                                                        <label class="col-form-label" for="fecha_inicio"><i>Fecha inicio</i></label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"><i class="fas fa-calendar-week"></i></span>
                                                            </div>
                                                            <input class="form-control is-valid" type="datetime-local" id="fecha_inicio" name="fecha_inicio" required>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col">
                                                    <div class="form-group">
                                                        <label class="col-form-label" for="fecha_final"><i>Fecha final</i></label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"><i class="fas fa-calendar-week"></i></span>
                                                            </div>
                                                            <input class="form-control is-valid" type="datetime-local" id="fecha_final" name="fecha_final" required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-footer bg-gradient-lightblue">
                                                <div class="d-flex justify-content-center">
                                                    <div class="form-group">
                                                        <button type="button" data-toggle="tooltip" data-placement="top" class="btn btn-sm btn-block bg-gradient-light btn-flat btn-crearTarea" data-original-title="Agregar nueva tarea.">
                                                            <i class="fas fa-plus"></i> <strong>Añadir</strong>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <hr class="bg-dark">

                                        <div class="card card-tabs border border-dark">
                                            <div class="card-header">
                                                <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist" style="text-decoration: none;">
                                                    <li class="pt-2 px-3">
                                                        <h3 class="card-title"><strong>Tareas</strong></h3>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link active" id="tab-pendientes" data-toggle="pill" href="#pendientes" role="tab" aria-controls="pendientes" aria-selected="true"><span class="badge badge-warning"><i class="fas fa-clock"></i> pendientes</span></a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" id="tab-finalizadas" data-toggle="pill" href="#finalizadas" role="tab" aria-controls="finalizadas" aria-selected="false"><span class="badge badge-success">finalizadas <i class="fas fa-check-circle"></i></span></a>
                                                    </li>
                                                </ul>
                                            </div>

                                            <div class="card-body">
                                                <div class="tab-content" id="custom-tabs-one-tabContent">
                                                    <!-- /.PENDIENTES -->
                                                    <div class="tab-pane fade active show" id="pendientes" role="tabpanel" aria-labelledby="pendientes">

                                                        <ol id="lista_pendientes">

                                                        </ol>
                                                    </div>
                                                    <!-- /.FINALIZADOS -->
                                                    <div class="tab-pane fade" id="finalizadas" role="tabpanel" aria-labelledby="finalizadas">
                                                        <ol id="lista_finalizadas">

                                                        </ol>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--SECCION PARA EL CALENDARIO-->
                                    <div class="col-lg-9 col-12">
                                        <div class="card card-light border border-dark">
                                            <div class="card-body">
                                                <div id="calendar">

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- /.content-wrapper -->

<!--MODAL PARA EDITAR FINALIZAR/PENDIENTE UNA TAREA-->
<div id="modal_tarea" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal_tarea-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-light border-dark">
                <h5 class="modal-title" id="modal_tarea-title"><strong>Descripción de la tarea</strong></h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <input id="id_evento" type="hidden" name="id_evento">

                <div class="col">
                    <div class="form-group text-center">
                        <label><i>Título</i></label>
                        <input type="text" class="form-control" id="modal_titulo_tarea" name="modal_titulo_tarea">
                    </div>
                </div>

                <div class="col">
                    <div class="form-group text-center">
                        <label><i>Descripción</i></label>
                        <textarea type="text" class="form-control" id="modal_descripcion" name="modal_descripcion" maxlength="100"></textarea>
                    </div>
                </div>

                <div class="col">
                    <div class="form-group text-center">
                        <label><i>Fecha inicial</i></label>
                        <input type="datetime-local" class="form-control" id="modal_fecha_inicio" name="modal_fecha_inicio">
                    </div>
                </div>

                <div class="col">
                    <div class="form-group text-center">
                        <label><i>Fecha final</i></label>
                        <input type="datetime-local" class="form-control" id="modal_fecha_final" name="modal_fecha_final">
                    </div>
                </div>
            </div>
            <div class="modal-footer bg-light border-dark d-flex justify-content-center">
                <div class="form-group" id="btn_finalizada">
                    <button type="button" data-toggle="tooltip" data-placement="top" class="btn btn-sm btn-block bg-gradient-success btn-flat btn-finalizar" style="color: white;" data-original-title="Finalizar tarea.">
                        <i class="fas fa-check-circle"></i> Tarea finalizada
                    </button>
                </div>
                <div class="form-group d-none" id="btn_pendiente">
                    <button type="button" data-toggle="tooltip" data-placement="top" class="btn btn-sm btn-block bg-gradient-warning btn-flat btn-pendiente" style="color: black;" data-original-title="Tarea pendiente.">
                        <i class="fas fa-clock"></i> Posponer
                    </button>
                </div>
                <div class="form-group ">
                    <button type="button" data-toggle="tooltip" data-placement="top" class="btn btn-sm btn-block bg-gradient-info btn-flat btn-editar" style="color: white;" data-original-title="Editar tarea.">
                        <i class="fas fa-redo-alt"></i> Editar tarea
                    </button>
                </div>
                <div class="form-group ">
                    <button type="button" data-toggle="tooltip" data-placement="top" class="btn btn-sm btn-block bg-gradient-danger btn-flat btn-eliminar" style="color: white;" data-original-title="Eliminar del calendario.">
                        <i class="fas fa-trash"></i> Eliminar
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!--MODAL PARA VISUALIZAR LAS TAREAS DEL DIA ACTUAL-->
<div id="tareas_del_dia" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="tareas_del_dia-title" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

            <div class="modal-header bg-light border-dark">
                <h5 class="modal-title" id="tareas_del_dia-title"><i class="fas fa-clipboard-list"></i> <i>TAREAS DEL DÍA</i> </h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <p>
                <ul id="ingresar_tareas">

                </ul>
                </p>
            </div>

            <div class="modal-footer bg-light border-dark d-flex justify-content-center">
                <div class="form-group" id="btn_finalizada">
                    <button type="button" class="btn btn-info" data-dismiss="modal">
                        <i class="fas fa-check-circle"></i> Continuar.
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>