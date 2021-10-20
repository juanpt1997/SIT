  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- fullCalendar -->
  <link rel="stylesheet" href="../plugins/fullcalendar/main.min.css">
  <link rel="stylesheet" href="../plugins/fullcalendar-interaction/main.min.css">
  <link rel="stylesheet" href="../plugins/fullcalendar-daygrid/main.min.css">
  <link rel="stylesheet" href="../plugins/fullcalendar-timegrid/main.min.css">
  <link rel="stylesheet" href="../plugins/fullcalendar-bootstrap/main.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
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
            <div style="height:100px;font-size:60px;"></div>
            <div class="card bg-dark">
                <div class="parallax1">
                    <div class="card-body">
                        <div class="row">

                            <div class="col">
                                <div class="sticky-top mb-3">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4 class="card-title">Draggable Events</h4>
                                        </div>
                                        <div class="card-body">
                                            <!-- the events -->
                                            <div id="external-events">
                                                <div class="external-event bg-success ui-draggable ui-draggable-handle" style="position: relative;">Lunch</div>
                                                <div class="external-event bg-warning ui-draggable ui-draggable-handle" style="position: relative;">Go home</div>
                                                <div class="external-event bg-info ui-draggable ui-draggable-handle" style="position: relative;">Do homework</div>
                                                <div class="external-event bg-primary ui-draggable ui-draggable-handle" style="position: relative;">Work on UI design</div>
                                                <div class="external-event bg-danger ui-draggable ui-draggable-handle" style="position: relative;">Sleep tight</div>
                                                <div class="checkbox">
                                                    <label for="drop-remove">
                                                        <input type="checkbox" id="drop-remove">
                                                        remove after drop
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.card-body -->
                                    </div>
                                    <!-- /.card -->
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title">Create Event</h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="btn-group" style="width: 100%; margin-bottom: 10px;">
                                                <ul class="fc-color-picker" id="color-chooser">
                                                    <li><a class="text-primary" href="#"><i class="fas fa-square"></i></a></li>
                                                    <li><a class="text-warning" href="#"><i class="fas fa-square"></i></a></li>
                                                    <li><a class="text-success" href="#"><i class="fas fa-square"></i></a></li>
                                                    <li><a class="text-danger" href="#"><i class="fas fa-square"></i></a></li>
                                                    <li><a class="text-muted" href="#"><i class="fas fa-square"></i></a></li>
                                                </ul>
                                            </div>
                                            <!-- /btn-group -->
                                            <div class="input-group">
                                                <input id="new-event" type="text" class="form-control" placeholder="Event Title">

                                                <div class="input-group-append">
                                                    <button id="add-new-event" type="button" class="btn btn-primary">Add</button>
                                                </div>
                                                <!-- /btn-group -->
                                            </div>
                                            <!-- /input-group -->
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col">
                                <div class="card card-primary">
                                    <div class="card-body p-0">
                                        <!-- THE CALENDAR -->
                                        <div id="calendar" class="fc fc-media-screen fc-direction-ltr fc-theme-bootstrap fc-liquid-hack">
                                            <div class="fc-header-toolbar fc-toolbar fc-toolbar-ltr">
                                                <div class="fc-toolbar-chunk">
                                                    <div class="btn-group"><button class="fc-prev-button btn btn-primary" type="button" aria-label="prev"><span class="fa fa-chevron-left"></span></button><button class="fc-next-button btn btn-primary" type="button" aria-label="next"><span class="fa fa-chevron-right"></span></button></div><button disabled="" class="fc-today-button btn btn-primary" type="button">today</button>
                                                </div>
                                                <div class="fc-toolbar-chunk">
                                                    <h2 class="fc-toolbar-title">October 2021</h2>
                                                </div>
                                                <div class="fc-toolbar-chunk">
                                                    <div class="btn-group"><button class="fc-dayGridMonth-button btn btn-primary active" type="button">month</button><button class="fc-timeGridWeek-button btn btn-primary" type="button">week</button><button class="fc-timeGridDay-button btn btn-primary" type="button">day</button></div>
                                                </div>
                                            </div>
                                            <div class="fc-view-harness fc-view-harness-active" style="height: 395.556px;">
                                                <div class="fc-daygrid fc-dayGridMonth-view fc-view">
                                                    <table class="fc-scrollgrid table-bordered fc-scrollgrid-liquid">
                                                        <tbody>
                                                            <tr class="fc-scrollgrid-section fc-scrollgrid-section-header ">
                                                                <td>
                                                                    <div class="fc-scroller-harness">
                                                                        <div class="fc-scroller" style="overflow: hidden scroll;">
                                                                            <table class="fc-col-header " style="width: 515px;">
                                                                                <colgroup></colgroup>
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <th class="fc-col-header-cell fc-day fc-day-sun">
                                                                                            <div class="fc-scrollgrid-sync-inner"><a class="fc-col-header-cell-cushion ">Sun</a></div>
                                                                                        </th>
                                                                                        <th class="fc-col-header-cell fc-day fc-day-mon">
                                                                                            <div class="fc-scrollgrid-sync-inner"><a class="fc-col-header-cell-cushion ">Mon</a></div>
                                                                                        </th>
                                                                                        <th class="fc-col-header-cell fc-day fc-day-tue">
                                                                                            <div class="fc-scrollgrid-sync-inner"><a class="fc-col-header-cell-cushion ">Tue</a></div>
                                                                                        </th>
                                                                                        <th class="fc-col-header-cell fc-day fc-day-wed">
                                                                                            <div class="fc-scrollgrid-sync-inner"><a class="fc-col-header-cell-cushion ">Wed</a></div>
                                                                                        </th>
                                                                                        <th class="fc-col-header-cell fc-day fc-day-thu">
                                                                                            <div class="fc-scrollgrid-sync-inner"><a class="fc-col-header-cell-cushion ">Thu</a></div>
                                                                                        </th>
                                                                                        <th class="fc-col-header-cell fc-day fc-day-fri">
                                                                                            <div class="fc-scrollgrid-sync-inner"><a class="fc-col-header-cell-cushion ">Fri</a></div>
                                                                                        </th>
                                                                                        <th class="fc-col-header-cell fc-day fc-day-sat">
                                                                                            <div class="fc-scrollgrid-sync-inner"><a class="fc-col-header-cell-cushion ">Sat</a></div>
                                                                                        </th>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr class="fc-scrollgrid-section fc-scrollgrid-section-body  fc-scrollgrid-section-liquid">
                                                                <td>
                                                                    <div class="fc-scroller-harness fc-scroller-harness-liquid">
                                                                        <div class="fc-scroller fc-scroller-liquid-absolute" style="overflow: hidden scroll;">
                                                                            <div class="fc-daygrid-body fc-daygrid-body-unbalanced " style="width: 515px;">
                                                                                <table class="fc-scrollgrid-sync-table" style="width: 515px; height: 364px;">
                                                                                    <colgroup></colgroup>
                                                                                    <tbody>
                                                                                        <tr>
                                                                                            <td class="fc-daygrid-day fc-day fc-day-sun fc-day-past fc-day-other" data-date="2021-09-26">
                                                                                                <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                                    <div class="fc-daygrid-day-top"><a class="fc-daygrid-day-number">26</a></div>
                                                                                                    <div class="fc-daygrid-day-events"></div>
                                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                                </div>
                                                                                            </td>
                                                                                            <td class="fc-daygrid-day fc-day fc-day-mon fc-day-past fc-day-other" data-date="2021-09-27">
                                                                                                <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                                    <div class="fc-daygrid-day-top"><a class="fc-daygrid-day-number">27</a></div>
                                                                                                    <div class="fc-daygrid-day-events"></div>
                                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                                </div>
                                                                                            </td>
                                                                                            <td class="fc-daygrid-day fc-day fc-day-tue fc-day-past fc-day-other" data-date="2021-09-28">
                                                                                                <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                                    <div class="fc-daygrid-day-top"><a class="fc-daygrid-day-number">28</a></div>
                                                                                                    <div class="fc-daygrid-day-events"></div>
                                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                                </div>
                                                                                            </td>
                                                                                            <td class="fc-daygrid-day fc-day fc-day-wed fc-day-past fc-day-other" data-date="2021-09-29">
                                                                                                <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                                    <div class="fc-daygrid-day-top"><a class="fc-daygrid-day-number">29</a></div>
                                                                                                    <div class="fc-daygrid-day-events"></div>
                                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                                </div>
                                                                                            </td>
                                                                                            <td class="fc-daygrid-day fc-day fc-day-thu fc-day-past fc-day-other" data-date="2021-09-30">
                                                                                                <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                                    <div class="fc-daygrid-day-top"><a class="fc-daygrid-day-number">30</a></div>
                                                                                                    <div class="fc-daygrid-day-events"></div>
                                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                                </div>
                                                                                            </td>
                                                                                            <td class="fc-daygrid-day fc-day fc-day-fri fc-day-past" data-date="2021-10-01">
                                                                                                <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                                    <div class="fc-daygrid-day-top"><a class="fc-daygrid-day-number">1</a></div>
                                                                                                    <div class="fc-daygrid-day-events">
                                                                                                        <div class="fc-daygrid-event-harness"><a class="fc-daygrid-event fc-daygrid-block-event fc-h-event fc-event fc-event-draggable fc-event-resizable fc-event-start fc-event-end fc-event-past" style="border-color: rgb(245, 105, 84); background-color: rgb(245, 105, 84);">
                                                                                                                <div class="fc-event-main">
                                                                                                                    <div class="fc-event-main-frame">
                                                                                                                        <div class="fc-event-title-container">
                                                                                                                            <div class="fc-event-title fc-sticky">All Day Event</div>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                                <div class="fc-event-resizer fc-event-resizer-end"></div>
                                                                                                            </a></div>
                                                                                                    </div>
                                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                                </div>
                                                                                            </td>
                                                                                            <td class="fc-daygrid-day fc-day fc-day-sat fc-day-past" data-date="2021-10-02">
                                                                                                <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                                    <div class="fc-daygrid-day-top"><a class="fc-daygrid-day-number">2</a></div>
                                                                                                    <div class="fc-daygrid-day-events"></div>
                                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                                </div>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td class="fc-daygrid-day fc-day fc-day-sun fc-day-past" data-date="2021-10-03">
                                                                                                <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                                    <div class="fc-daygrid-day-top"><a class="fc-daygrid-day-number">3</a></div>
                                                                                                    <div class="fc-daygrid-day-events"></div>
                                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                                </div>
                                                                                            </td>
                                                                                            <td class="fc-daygrid-day fc-day fc-day-mon fc-day-past" data-date="2021-10-04">
                                                                                                <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                                    <div class="fc-daygrid-day-top"><a class="fc-daygrid-day-number">4</a></div>
                                                                                                    <div class="fc-daygrid-day-events"></div>
                                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                                </div>
                                                                                            </td>
                                                                                            <td class="fc-daygrid-day fc-day fc-day-tue fc-day-past" data-date="2021-10-05">
                                                                                                <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                                    <div class="fc-daygrid-day-top"><a class="fc-daygrid-day-number">5</a></div>
                                                                                                    <div class="fc-daygrid-day-events"></div>
                                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                                </div>
                                                                                            </td>
                                                                                            <td class="fc-daygrid-day fc-day fc-day-wed fc-day-past" data-date="2021-10-06">
                                                                                                <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                                    <div class="fc-daygrid-day-top"><a class="fc-daygrid-day-number">6</a></div>
                                                                                                    <div class="fc-daygrid-day-events"></div>
                                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                                </div>
                                                                                            </td>
                                                                                            <td class="fc-daygrid-day fc-day fc-day-thu fc-day-past" data-date="2021-10-07">
                                                                                                <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                                    <div class="fc-daygrid-day-top"><a class="fc-daygrid-day-number">7</a></div>
                                                                                                    <div class="fc-daygrid-day-events"></div>
                                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                                </div>
                                                                                            </td>
                                                                                            <td class="fc-daygrid-day fc-day fc-day-fri fc-day-past" data-date="2021-10-08">
                                                                                                <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                                    <div class="fc-daygrid-day-top"><a class="fc-daygrid-day-number">8</a></div>
                                                                                                    <div class="fc-daygrid-day-events"></div>
                                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                                </div>
                                                                                            </td>
                                                                                            <td class="fc-daygrid-day fc-day fc-day-sat fc-day-past" data-date="2021-10-09">
                                                                                                <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                                    <div class="fc-daygrid-day-top"><a class="fc-daygrid-day-number">9</a></div>
                                                                                                    <div class="fc-daygrid-day-events"></div>
                                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                                </div>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td class="fc-daygrid-day fc-day fc-day-sun fc-day-past" data-date="2021-10-10">
                                                                                                <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                                    <div class="fc-daygrid-day-top"><a class="fc-daygrid-day-number">10</a></div>
                                                                                                    <div class="fc-daygrid-day-events"></div>
                                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                                </div>
                                                                                            </td>
                                                                                            <td class="fc-daygrid-day fc-day fc-day-mon fc-day-past" data-date="2021-10-11">
                                                                                                <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                                    <div class="fc-daygrid-day-top"><a class="fc-daygrid-day-number">11</a></div>
                                                                                                    <div class="fc-daygrid-day-events"></div>
                                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                                </div>
                                                                                            </td>
                                                                                            <td class="fc-daygrid-day fc-day fc-day-tue fc-day-past" data-date="2021-10-12">
                                                                                                <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                                    <div class="fc-daygrid-day-top"><a class="fc-daygrid-day-number">12</a></div>
                                                                                                    <div class="fc-daygrid-day-events"></div>
                                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                                </div>
                                                                                            </td>
                                                                                            <td class="fc-daygrid-day fc-day fc-day-wed fc-day-past" data-date="2021-10-13">
                                                                                                <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                                    <div class="fc-daygrid-day-top"><a class="fc-daygrid-day-number">13</a></div>
                                                                                                    <div class="fc-daygrid-day-events"></div>
                                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                                </div>
                                                                                            </td>
                                                                                            <td class="fc-daygrid-day fc-day fc-day-thu fc-day-past" data-date="2021-10-14">
                                                                                                <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                                    <div class="fc-daygrid-day-top"><a class="fc-daygrid-day-number">14</a></div>
                                                                                                    <div class="fc-daygrid-day-events" style="padding-bottom: 25.4px;">
                                                                                                        <div class="fc-daygrid-event-harness fc-daygrid-event-harness-abs" style="right: -148.133px;"><a class="fc-daygrid-event fc-daygrid-block-event fc-h-event fc-event fc-event-draggable fc-event-start fc-event-end fc-event-past" style="border-color: rgb(243, 156, 18); background-color: rgb(243, 156, 18);">
                                                                                                                <div class="fc-event-main">
                                                                                                                    <div class="fc-event-main-frame">
                                                                                                                        <div class="fc-event-time">12a</div>
                                                                                                                        <div class="fc-event-title-container">
                                                                                                                            <div class="fc-event-title fc-sticky">Long Event</div>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </a></div>
                                                                                                    </div>
                                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                                </div>
                                                                                            </td>
                                                                                            <td class="fc-daygrid-day fc-day fc-day-fri fc-day-past" data-date="2021-10-15">
                                                                                                <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                                    <div class="fc-daygrid-day-top"><a class="fc-daygrid-day-number">15</a></div>
                                                                                                    <div class="fc-daygrid-day-events" style="padding-bottom: 25.4px;"></div>
                                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                                </div>
                                                                                            </td>
                                                                                            <td class="fc-daygrid-day fc-day fc-day-sat fc-day-past" data-date="2021-10-16">
                                                                                                <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                                    <div class="fc-daygrid-day-top"><a class="fc-daygrid-day-number">16</a></div>
                                                                                                    <div class="fc-daygrid-day-events" style="padding-bottom: 25.4px;"></div>
                                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                                </div>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td class="fc-daygrid-day fc-day fc-day-sun fc-day-past" data-date="2021-10-17">
                                                                                                <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                                    <div class="fc-daygrid-day-top"><a class="fc-daygrid-day-number">17</a></div>
                                                                                                    <div class="fc-daygrid-day-events"></div>
                                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                                </div>
                                                                                            </td>
                                                                                            <td class="fc-daygrid-day fc-day fc-day-mon fc-day-past" data-date="2021-10-18">
                                                                                                <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                                    <div class="fc-daygrid-day-top"><a class="fc-daygrid-day-number">18</a></div>
                                                                                                    <div class="fc-daygrid-day-events"></div>
                                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                                </div>
                                                                                            </td>
                                                                                            <td class="fc-daygrid-day fc-day fc-day-tue fc-day-today " data-date="2021-10-19">
                                                                                                <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                                    <div class="fc-daygrid-day-top"><a class="fc-daygrid-day-number">19</a></div>
                                                                                                    <div class="fc-daygrid-day-events">
                                                                                                        <div class="fc-daygrid-event-harness"><a class="fc-daygrid-event fc-daygrid-dot-event fc-event fc-event-draggable fc-event-resizable fc-event-start fc-event-end fc-event-today">
                                                                                                                <div class="fc-daygrid-event-dot" style="border-color: rgb(0, 115, 183);"></div>
                                                                                                                <div class="fc-event-time">10:30a</div>
                                                                                                                <div class="fc-event-title">Meeting</div>
                                                                                                            </a></div>
                                                                                                        <div class="fc-daygrid-event-harness"><a class="fc-daygrid-event fc-daygrid-dot-event fc-event fc-event-draggable fc-event-resizable fc-event-start fc-event-end fc-event-today">
                                                                                                                <div class="fc-daygrid-event-dot" style="border-color: rgb(0, 192, 239);"></div>
                                                                                                                <div class="fc-event-time">12p</div>
                                                                                                                <div class="fc-event-title">Lunch</div>
                                                                                                            </a></div>
                                                                                                    </div>
                                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                                </div>
                                                                                            </td>
                                                                                            <td class="fc-daygrid-day fc-day fc-day-wed fc-day-future" data-date="2021-10-20">
                                                                                                <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                                    <div class="fc-daygrid-day-top"><a class="fc-daygrid-day-number">20</a></div>
                                                                                                    <div class="fc-daygrid-day-events">
                                                                                                        <div class="fc-daygrid-event-harness"><a class="fc-daygrid-event fc-daygrid-dot-event fc-event fc-event-draggable fc-event-resizable fc-event-start fc-event-end fc-event-future">
                                                                                                                <div class="fc-daygrid-event-dot" style="border-color: rgb(0, 166, 90);"></div>
                                                                                                                <div class="fc-event-time">7p</div>
                                                                                                                <div class="fc-event-title">Birthday Party</div>
                                                                                                            </a></div>
                                                                                                    </div>
                                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                                </div>
                                                                                            </td>
                                                                                            <td class="fc-daygrid-day fc-day fc-day-thu fc-day-future" data-date="2021-10-21">
                                                                                                <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                                    <div class="fc-daygrid-day-top"><a class="fc-daygrid-day-number">21</a></div>
                                                                                                    <div class="fc-daygrid-day-events"></div>
                                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                                </div>
                                                                                            </td>
                                                                                            <td class="fc-daygrid-day fc-day fc-day-fri fc-day-future" data-date="2021-10-22">
                                                                                                <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                                    <div class="fc-daygrid-day-top"><a class="fc-daygrid-day-number">22</a></div>
                                                                                                    <div class="fc-daygrid-day-events"></div>
                                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                                </div>
                                                                                            </td>
                                                                                            <td class="fc-daygrid-day fc-day fc-day-sat fc-day-future" data-date="2021-10-23">
                                                                                                <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                                    <div class="fc-daygrid-day-top"><a class="fc-daygrid-day-number">23</a></div>
                                                                                                    <div class="fc-daygrid-day-events"></div>
                                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                                </div>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td class="fc-daygrid-day fc-day fc-day-sun fc-day-future" data-date="2021-10-24">
                                                                                                <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                                    <div class="fc-daygrid-day-top"><a class="fc-daygrid-day-number">24</a></div>
                                                                                                    <div class="fc-daygrid-day-events"></div>
                                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                                </div>
                                                                                            </td>
                                                                                            <td class="fc-daygrid-day fc-day fc-day-mon fc-day-future" data-date="2021-10-25">
                                                                                                <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                                    <div class="fc-daygrid-day-top"><a class="fc-daygrid-day-number">25</a></div>
                                                                                                    <div class="fc-daygrid-day-events"></div>
                                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                                </div>
                                                                                            </td>
                                                                                            <td class="fc-daygrid-day fc-day fc-day-tue fc-day-future" data-date="2021-10-26">
                                                                                                <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                                    <div class="fc-daygrid-day-top"><a class="fc-daygrid-day-number">26</a></div>
                                                                                                    <div class="fc-daygrid-day-events"></div>
                                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                                </div>
                                                                                            </td>
                                                                                            <td class="fc-daygrid-day fc-day fc-day-wed fc-day-future" data-date="2021-10-27">
                                                                                                <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                                    <div class="fc-daygrid-day-top"><a class="fc-daygrid-day-number">27</a></div>
                                                                                                    <div class="fc-daygrid-day-events"></div>
                                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                                </div>
                                                                                            </td>
                                                                                            <td class="fc-daygrid-day fc-day fc-day-thu fc-day-future" data-date="2021-10-28">
                                                                                                <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                                    <div class="fc-daygrid-day-top"><a class="fc-daygrid-day-number">28</a></div>
                                                                                                    <div class="fc-daygrid-day-events">
                                                                                                        <div class="fc-daygrid-event-harness"><a class="fc-daygrid-event fc-daygrid-dot-event fc-event fc-event-draggable fc-event-resizable fc-event-start fc-event-end fc-event-future" href="https://www.google.com/">
                                                                                                                <div class="fc-daygrid-event-dot" style="border-color: rgb(60, 141, 188);"></div>
                                                                                                                <div class="fc-event-time">12a</div>
                                                                                                                <div class="fc-event-title">Click for Google</div>
                                                                                                            </a></div>
                                                                                                    </div>
                                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                                </div>
                                                                                            </td>
                                                                                            <td class="fc-daygrid-day fc-day fc-day-fri fc-day-future" data-date="2021-10-29">
                                                                                                <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                                    <div class="fc-daygrid-day-top"><a class="fc-daygrid-day-number">29</a></div>
                                                                                                    <div class="fc-daygrid-day-events"></div>
                                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                                </div>
                                                                                            </td>
                                                                                            <td class="fc-daygrid-day fc-day fc-day-sat fc-day-future" data-date="2021-10-30">
                                                                                                <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                                    <div class="fc-daygrid-day-top"><a class="fc-daygrid-day-number">30</a></div>
                                                                                                    <div class="fc-daygrid-day-events"></div>
                                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                                </div>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td class="fc-daygrid-day fc-day fc-day-sun fc-day-future" data-date="2021-10-31">
                                                                                                <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                                    <div class="fc-daygrid-day-top"><a class="fc-daygrid-day-number">31</a></div>
                                                                                                    <div class="fc-daygrid-day-events"></div>
                                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                                </div>
                                                                                            </td>
                                                                                            <td class="fc-daygrid-day fc-day fc-day-mon fc-day-future fc-day-other" data-date="2021-11-01">
                                                                                                <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                                    <div class="fc-daygrid-day-top"><a class="fc-daygrid-day-number">1</a></div>
                                                                                                    <div class="fc-daygrid-day-events"></div>
                                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                                </div>
                                                                                            </td>
                                                                                            <td class="fc-daygrid-day fc-day fc-day-tue fc-day-future fc-day-other" data-date="2021-11-02">
                                                                                                <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                                    <div class="fc-daygrid-day-top"><a class="fc-daygrid-day-number">2</a></div>
                                                                                                    <div class="fc-daygrid-day-events"></div>
                                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                                </div>
                                                                                            </td>
                                                                                            <td class="fc-daygrid-day fc-day fc-day-wed fc-day-future fc-day-other" data-date="2021-11-03">
                                                                                                <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                                    <div class="fc-daygrid-day-top"><a class="fc-daygrid-day-number">3</a></div>
                                                                                                    <div class="fc-daygrid-day-events"></div>
                                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                                </div>
                                                                                            </td>
                                                                                            <td class="fc-daygrid-day fc-day fc-day-thu fc-day-future fc-day-other" data-date="2021-11-04">
                                                                                                <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                                    <div class="fc-daygrid-day-top"><a class="fc-daygrid-day-number">4</a></div>
                                                                                                    <div class="fc-daygrid-day-events"></div>
                                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                                </div>
                                                                                            </td>
                                                                                            <td class="fc-daygrid-day fc-day fc-day-fri fc-day-future fc-day-other" data-date="2021-11-05">
                                                                                                <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                                    <div class="fc-daygrid-day-top"><a class="fc-daygrid-day-number">5</a></div>
                                                                                                    <div class="fc-daygrid-day-events"></div>
                                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                                </div>
                                                                                            </td>
                                                                                            <td class="fc-daygrid-day fc-day fc-day-sat fc-day-future fc-day-other" data-date="2021-11-06">
                                                                                                <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                                    <div class="fc-daygrid-day-top"><a class="fc-daygrid-day-number">6</a></div>
                                                                                                    <div class="fc-daygrid-day-events"></div>
                                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                                </div>
                                                                                            </td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                                <!-- /.card -->
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
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

<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- jQuery UI -->
<script src="../plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
<!-- fullCalendar 2.2.5 -->
<script src="../plugins/moment/moment.min.js"></script>
<script src="../plugins/fullcalendar/main.min.js"></script>
<script src="../plugins/fullcalendar-daygrid/main.min.js"></script>
<script src="../plugins/fullcalendar-timegrid/main.min.js"></script>
<script src="../plugins/fullcalendar-interaction/main.min.js"></script>
<script src="../plugins/fullcalendar-bootstrap/main.min.js"></script>
<!-- Page specific script -->
<script>
  $(function () {

    /* initialize the external events
     -----------------------------------------------------------------*/
    function ini_events(ele) {
      ele.each(function () {

        // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
        // it doesn't need to have a start or end
        var eventObject = {
          title: $.trim($(this).text()) // use the element's text as the event title
        }

        // store the Event Object in the DOM element so we can get to it later
        $(this).data('eventObject', eventObject)

        // make the event draggable using jQuery UI
        $(this).draggable({
          zIndex        : 1070,
          revert        : true, // will cause the event to go back to its
          revertDuration: 0  //  original position after the drag
        })

      })
    }

    ini_events($('#external-events div.external-event'))

    /* initialize the calendar
     -----------------------------------------------------------------*/
    //Date for the calendar events (dummy data)
    var date = new Date()
    var d    = date.getDate(),
        m    = date.getMonth(),
        y    = date.getFullYear()

    var Calendar = FullCalendar.Calendar;
    var Draggable = FullCalendarInteraction.Draggable;

    var containerEl = document.getElementById('external-events');
    var checkbox = document.getElementById('drop-remove');
    var calendarEl = document.getElementById('calendar');

    // initialize the external events
    // -----------------------------------------------------------------

    new Draggable(containerEl, {
      itemSelector: '.external-event',
      eventData: function(eventEl) {
        console.log(eventEl);
        return {
          title: eventEl.innerText,
          backgroundColor: window.getComputedStyle( eventEl ,null).getPropertyValue('background-color'),
          borderColor: window.getComputedStyle( eventEl ,null).getPropertyValue('background-color'),
          textColor: window.getComputedStyle( eventEl ,null).getPropertyValue('color'),
        };
      }
    });

    var calendar = new Calendar(calendarEl, {
      plugins: [ 'bootstrap', 'interaction', 'dayGrid', 'timeGrid' ],
      header    : {
        left  : 'prev,next today',
        center: 'title',
        right : 'dayGridMonth,timeGridWeek,timeGridDay'
      },
      //Random default events
      events    : [
        {
          title          : 'All Day Event',
          start          : new Date(y, m, 1),
          backgroundColor: '#f56954', //red
          borderColor    : '#f56954' //red
        },
        {
          title          : 'Long Event',
          start          : new Date(y, m, d - 5),
          end            : new Date(y, m, d - 2),
          backgroundColor: '#f39c12', //yellow
          borderColor    : '#f39c12' //yellow
        },
        {
          title          : 'Meeting',
          start          : new Date(y, m, d, 10, 30),
          allDay         : false,
          backgroundColor: '#0073b7', //Blue
          borderColor    : '#0073b7' //Blue
        },
        {
          title          : 'Lunch',
          start          : new Date(y, m, d, 12, 0),
          end            : new Date(y, m, d, 14, 0),
          allDay         : false,
          backgroundColor: '#00c0ef', //Info (aqua)
          borderColor    : '#00c0ef' //Info (aqua)
        },
        {
          title          : 'Birthday Party',
          start          : new Date(y, m, d + 1, 19, 0),
          end            : new Date(y, m, d + 1, 22, 30),
          allDay         : false,
          backgroundColor: '#00a65a', //Success (green)
          borderColor    : '#00a65a' //Success (green)
        },
        {
          title          : 'Click for Google',
          start          : new Date(y, m, 28),
          end            : new Date(y, m, 29),
          url            : 'http://google.com/',
          backgroundColor: '#3c8dbc', //Primary (light-blue)
          borderColor    : '#3c8dbc' //Primary (light-blue)
        }
      ],
      editable  : true,
      droppable : true, // this allows things to be dropped onto the calendar !!!
      drop      : function(info) {
        // is the "remove after drop" checkbox checked?
        if (checkbox.checked) {
          // if so, remove the element from the "Draggable Events" list
          info.draggedEl.parentNode.removeChild(info.draggedEl);
        }
      }    
    });

    calendar.render();
    // $('#calendar').fullCalendar()

    /* ADDING EVENTS */
    var currColor = '#3c8dbc' //Red by default
    //Color chooser button
    var colorChooser = $('#color-chooser-btn')
    $('#color-chooser > li > a').click(function (e) {
      e.preventDefault()
      //Save color
      currColor = $(this).css('color')
      //Add color effect to button
      $('#add-new-event').css({
        'background-color': currColor,
        'border-color'    : currColor
      })
    })
    $('#add-new-event').click(function (e) {
      e.preventDefault()
      //Get value and make sure it is not null
      var val = $('#new-event').val()
      if (val.length == 0) {
        return
      }

      //Create events
      var event = $('<div />')
      event.css({
        'background-color': currColor,
        'border-color'    : currColor,
        'color'           : '#fff'
      }).addClass('external-event')
      event.html(val)
      $('#external-events').prepend(event)

      //Add draggable funtionality
      ini_events(event)

      //Remove event from text input
      $('#new-event').val('')
    })
  })
</script>