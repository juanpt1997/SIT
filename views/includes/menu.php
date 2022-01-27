<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <div class="brand-link">
        <img src="<?= URL_APP ?>views/img/plantilla/isotipoTL.jpg" alt="" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-bold">SIT</span>
    </div>
    <!-- <a href="<?= URL_APP ?>inicio" class="brand-link">
    </a> -->

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- <div class="user-panel d-flex">
            <a href="<?= URL_APP ?>inicio" class="d-block font-weight-bold">Trans Especiales El Samán</a>
        </div>
         -->
        <a href="<?= URL_APP ?>inicio">
            <div class="image text-center mt-4">
                <img src="<?= URL_APP ?>views/img/plantilla/logo.png" class="img-fluid img-circle elevation-2 w-50" alt="User Image">
            </div>
        </a>

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel d-flex">
            <!-- <div class="image">
                <img src="<?= URL_APP ?>views/img/plantilla/logo.png" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">El Saman</a>
            </div> -->
            <div class="info">
                <a href="<?= URL_APP ?>inicio" class="d-block font-weight-bold text-sm"><?= NOM_MENU ?></a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Buscar" aria-label="Buscar">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column nav-compact text-sm nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
                <!-- ===================================================
                    Listado de opciones del side bar
                =================================================== -->

                <!-- ===================================================
                    * Gerencial
                =================================================== -->
                <?php if (validarPermiso('M_GERENCIAL', 'R')) : ?>
                    <li class="nav-item has-treeview">
                        <a href="g-dashboard" class="nav-link">
                            <i class="fas fa-chalkboard-teacher nav-icon"></i>
                            <p>
                                Gerencial
                            </p>
                        </a>
                    </li>
                <?php endif ?>

                <!-- ===================================================
                    * Conceptos generales
                =================================================== -->
                <?php if (validarPermiso('M_GESTION_HUMANA', 'U') || validarPermiso('M_VEHICULAR', 'U')) : ?>
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-building"></i>
                            <p>
                                Conceptos generales
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <?php if (validarPermiso('M_GESTION_HUMANA', 'U')) : ?>
                                <!-- ===================================================
                                        Gestión humana
                                    =================================================== -->
                                <li class="nav-item">
                                    <a href="cg-gestion-humana" class="nav-link" target="_blank">
                                        <i class="fas fa-user-friends nav-icon"></i>
                                        <p>Gestión humana</p>
                                    </a>
                                </li>
                            <?php endif ?>

                            <?php if (validarPermiso('M_VEHICULAR', 'U')) : ?>
                                <!-- ===================================================
                                        Vehicular
                                    =================================================== -->
                                <li class="nav-item">
                                    <a href="cg-vehicular" class="nav-link" target="_blank">
                                        <i class="fas fa-bus-alt nav-icon"></i>
                                        <p>Vehicular</p>
                                    </a>
                                </li>
                            <?php endif ?>

                            <?php if (validarPermiso('M_MANTENIMIENTO', 'U')) : ?>
                                <!-- ===================================================
                                    Mantenimiento
                                =================================================== -->
                                <li class="nav-item">
                                    <a href="cg-mantenimiento" class="nav-link" target="_blank">
                                        <i class="fas fa-tools nav-icon"></i>
                                        <p>Mantenimiento</p>
                                    </a>
                                </li>
                            <?php endif ?>

                            <?php if (validarPermiso('M_ALMACEN', 'U')) : ?>
                                <!-- ===================================================
                                    Almacen
                                =================================================== -->
                                <li class="nav-item">
                                    <a href="cg-almacen" class="nav-link" target="_blank">
                                        <i class="fas fa-warehouse nav-icon"></i>
                                        <p>Almacén</p>
                                    </a>
                                </li>
                            <?php endif ?>

                            <?php if (validarPermiso('M_OPCIONES', 'R')) : ?>
                                <!-- ===================================================
                                    Seguridad
                                =================================================== -->
                                <li class="nav-item">
                                    <a href="cg-seguridad" class="nav-link" target="_blank">
                                        <i class="fas fa-shield-alt nav-icon"></i>
                                        <p>Seguridad</p>
                                    </a>
                                </li>
                            <?php endif ?>
                        </ul>
                    </li>
                <?php endif ?>

                <!-- ===================================================
                    * Gestión Humana
                =================================================== -->
                <?php if (validarPermiso('M_GESTION_HUMANA', 'R')) : ?>
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-user-friends"></i>
                            <p>
                                Gestión Humana
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <!-- ===================================================
                                    Personal
                                =================================================== -->
                            <li class="nav-item">
                                <a href="gh-personal" class="nav-link" target="_blank">
                                    <i class="far fa-id-card nav-icon"></i>
                                    <p>Personal</p>
                                </a>
                            </li>

                            <!-- ===================================================
                                    Perfil sociodemográfico
                                =================================================== -->
                            <li class="nav-item">
                                <a href="gh-perfil-sd" class="nav-link" target="_blank">
                                    <i class="fas fa-chart-area nav-icon"></i>
                                    <p>Perfil sociodemográfico</p>
                                </a>
                            </li>

                            <!-- ===================================================
                                    Pago seguridad social
                                =================================================== -->
                            <li class="nav-item">
                                <a href="gh-pago-ss" class="nav-link" target="_blank">
                                    <i class="fas fa-file-invoice-dollar nav-icon"></i>
                                    <p>Pago seguridad social</p>
                                </a>
                            </li>

                            <!-- ===================================================
                                    Alertas de contratos
                                =================================================== -->
                            <li class="nav-item">
                                <a href="gh-alertas-contratos" class="nav-link" target="_blank">
                                    <i class="fas fa-file-signature nav-icon"></i>
                                    <p>Alertas de contratos</p>
                                </a>
                            </li>

                            <!-- ===================================================
                                    Control Ausentismo
                                =================================================== -->
                            <li class="nav-item">
                                <a href="gh-ausentismo" class="nav-link" target="_blank">
                                    <i class="fas fa-users-cog nav-icon"></i>
                                    <p>Control Ausentismo</p>
                                </a>
                            </li>

                            <!-- ===================================================
                                    Gráficos perfil sociodemográfico
                                =================================================== -->
                            <li class="nav-item d-none">
                                <a href="#" class="nav-link" target="_blank">
                                    <i class="far fa-circle nav-icon nav-icon"></i>
                                    <p>Gráficos perfil sociodemográfico</p>
                                </a>
                            </li>
                            <!-- ===================================================
                                    Bloqueo de personal
                                =================================================== -->
                            <li class="nav-item">
                                <a href="gh-bloqueo-personal" class="nav-link" target="_blank">
                                    <i class="fas fa-user-alt-slash nav-icon"></i>
                                    <p>Bloqueo de personal</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php endif ?>

                <!-- ===================================================
                    * Vehicular
                =================================================== -->
                <?php if (validarPermiso('M_VEHICULAR', 'R')) : ?>
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-truck"></i>
                            <p>
                                Vehicular
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <!-- ===================================================
                                    Bloqueo de vehículo
                                =================================================== -->
                            <li class="nav-item">
                                <a href="v-bloqueo-vehiculo" class="nav-link" target="_blank">
                                    <i class="fas fa-ban nav-icon"></i>
                                    <p>Bloqueo de vehículo</p>
                                </a>
                            </li>
                            <!-- ===================================================
                                    Propietarios
                                =================================================== -->
                            <li class="nav-item">
                                <a href="v-propietarios" class="nav-link" target="_blank">
                                    <i class="fas fa-user-tie nav-icon"></i>
                                    <p>Propietarios</p>
                                </a>
                            </li>

                            <!-- ===================================================
                                    Convenios a hora primero yo miro aca como es y ya luego  le hago en git
                                =================================================== -->
                            <li class="nav-item">
                                <a href="v-convenios" class="nav-link" target="_blank">
                                    <i class="fas fa-file-contract nav-icon"></i>
                                    <p>Convenios</p>
                                </a>
                            </li>

                            <!-- ===================================================
                                    Vehículos
                                =================================================== -->
                            <li class="nav-item">
                                <a href="v-vehiculos" class="nav-link" target="_blank">
                                    <i class="fas fa-truck-pickup nav-icon"></i>
                                    <p>Vehículos</p>
                                </a>
                            </li>

                            <!-- ===================================================
                                    Consulta comparendos
                                =================================================== -->
                            <li class="nav-item">
                                <a href="v-comparendos" class="nav-link" target="_blank">
                                    <i class="fas fa-search nav-icon"></i>
                                    <p>Comparendos</p>
                                </a>
                            </li>



                        </ul>
                    </li>
                <?php endif ?>

                <!-- ===================================================
                    * Contratos
                =================================================== -->
                <?php if (validarPermiso('M_CONTRATOS', 'R')) : ?>
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-folder-open"></i>
                            <p>
                                Contratos
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">

                            <!-- ===================================================
                                    Clientes
                                =================================================== -->
                            <li class="nav-item">
                                <a href="contratos-clientes" class="nav-link" target="_blank">
                                    <i class="fas fa-user-tag nav-icon"></i>
                                    <p>Clientes</p>
                                </a>
                            </li>

                            <!-- ===================================================
                                    Fijos
                                =================================================== -->
                            <li class="nav-item">
                                <a href="contratos-fijos" class="nav-link" target="_blank">
                                    <i class="fas fa-file-signature nav-icon"></i>
                                    <p>Fijos</p>
                                </a>
                            </li>

                            <!-- ===================================================
                                    Cotizaciones
                                =================================================== -->
                            <li class="nav-item">
                                <a href="contratos-cotizaciones" class="nav-link" target="_blank">
                                    <i class="fas fa-comments-dollar nav-icon"></i>
                                    <p>Cotizaciones</p>
                                </a>
                            </li>

                            <!-- ===================================================
                                    Orden de servicio
                                =================================================== -->
                            <li class="nav-item">
                                <a href="contratos-ordenservicio" class="nav-link" target="_blank">
                                    <i class="fas fa-folder-plus nav-icon"></i>
                                    <p>Orden de servicio</p>
                                </a>
                            </li>

                        </ul>
                    </li>
                <?php endif ?>


                <!-- ===================================================
                    * Operaciones
                =================================================== -->
                <?php if (validarPermiso('M_OPERACIONES', 'R')) : ?>
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-road"></i>
                            <p>
                                Operaciones
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <!-- ===================================================
                                    FUEC
                                =================================================== -->
                            <li class="nav-item">
                                <a href="o-fuec" class="nav-link" target="_blank">
                                    <i class="fas fa-book nav-icon"></i>
                                    <p>FUEC</p>
                                </a>
                            </li>
                            <!-- ===================================================
                                    Protocolo de Alistamiento
                                =================================================== -->
                            <li class="nav-item">
                                <a href="o-alistamiento" class="nav-link" target="_blank">
                                    <i class="fas fa-briefcase nav-icon"></i>
                                    <p>Protocolo de alistamiento</p>
                                </a>
                            </li>
                            <!-- ===================================================
                                    Plan de Rodamiento
                                =================================================== -->
                            <li class="nav-item">
                                <a href="o-rodamiento" class="nav-link" target="_blank">
                                    <i class="fas fa-road nav-icon"></i>
                                    <p>Plan de rodamiento</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php endif ?>

                <!-- ===================================================
                    * Control Usuarios
                =================================================== -->
                <?php if (validarPermiso('M_USUARIOS', 'R')) : ?>
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                Control de usuarios
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <!-- ===================================================
                                    Usuarios
                                =================================================== -->
                            <li class="nav-item">
                                <a href="usuarios" class="nav-link" target="_blank">
                                    <i class="fas fa-users nav-icon"></i>
                                    <p>Usuarios</p>
                                </a>
                            </li>
                            <!-- ===================================================
                                    Roles
                                =================================================== -->
                            <li class="nav-item">
                                <a href="roles-usuarios" class="nav-link" target="_blank">
                                    <i class="fas fa-users-cog nav-icon"></i>
                                    <p>Roles</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php endif ?>

                <!-- ===================================================
                    ** Almacen
                =================================================== -->
                <?php if (validarPermiso('M_ALMACEN', 'R')) : ?>
                    <li class="nav-item has-treeview">
                        <a href="a-inventario" class="nav-link" target="_blank">
                            <i class="fas fa-warehouse nav-icon"></i>
                            <p>
                                Almacén
                            </p>
                        </a>

                    </li>
                <?php endif ?>

                <!-- ===================================================
                    ** Mantenimiento
                =================================================== -->
                <?php if (validarPermiso('M_MANTENIMIENTO', 'R')) : ?>
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-cogs"></i>
                            <p>
                                Mantenimiento
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <!-- ===================================================
                                    Mantenimientos
                                =================================================== -->
                            <li class="nav-item">
                                <a href="m-mantenimientos" class="nav-link" target="_blank">
                                    <i class="fas fa-toolbox nav-icon"></i>
                                    <p>Mantenimientos</p>
                                </a>
                            </li>
                            <!-- ===================================================
                                    Inventario
                                =================================================== -->
                            <li class="nav-item">
                                <a href="m-inventario" class="nav-link" target="_blank">
                                    <i class="fas fa-boxes nav-icon"></i>
                                    <p>Inventario</p>
                                </a>
                            </li>

                            <!-- ===================================================
                                    Revison tecnomecánica 
                                =================================================== -->

                            <li class="nav-item">
                                <a href="m-revision-tm" class="nav-link" target="_blank">
                                    <i class="fas fa-wrench nav-icon"></i>
                                    <p>Revision TM</p>
                                </a>
                            </li>

                            <!-- ===================================================
                                    Control de llantas 
                                =================================================== -->
                            <li class="nav-item">
                                <a href="m-control-llantas" class="nav-link" target="_blank">
                                <i class="fas fa-truck-monster nav-icon"></i>
                                    <p>Control de llantas</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php endif ?>

                <!-- ===================================================
                    ** Rastreo Satelital
                =================================================== -->
                <?php if (validarPermiso('M_TRACKER', 'R')) : ?>
                    <li class="nav-item">
                        <a href="tr-gps" class="nav-link">
                            <i class="nav-icon fas fa-map-marked-alt"></i>
                            <p>Rastreo Satelital</p>
                        </a>
                    </li>
                <?php endif ?>

                <!-- ===================================================
                    ** COMPRAS
                =================================================== -->
                <?php if (validarPermiso('M_OPCIONES', 'R')) : ?>
                    <li class="nav-item has-treeview d-none">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-shopping-cart"></i>
                            <p>Compras
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <!-- ===================================================
                                    ORDEN DE COMPRA
                        =================================================== -->
                            <li class="nav-item">
                                <a href="c-orden-compra" class="nav-link" target="_blank">
                                    <i class="fas fa-dollar-sign nav-icon"></i>
                                    <p>Orden de compra</p>
                                </a>
                            </li>
                            <!-- ===================================================
                                    Proveedores
                        =================================================== -->
                            <li class="nav-item">
                                <a href="c-proveedores" class="nav-link" target="_blank">
                                    <i class="fas fa-truck-moving nav-icon"></i>
                                    <p>Proveedores</p>
                                </a>
                            </li>


                        </ul>
                    </li>

                <?php endif ?>

                <!-- ===================================================
                    ** DOCUMENTOS CONTABLE
                =================================================== -->
                <?php if (validarPermiso('M_OPCIONES', 'R')) : ?>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-book"></i>
                            <p>Documentos Contable</p>
                        </a>

                    </li>
                <?php endif ?>

                <!-- ===================================================
                    ** COMERCIAL
                =================================================== -->
                <?php if (validarPermiso('M_OPCIONES', 'R')) : ?>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-chart-line"></i>
                            <p>Comercial</p>
                        </a>
                    </li>
                <?php endif ?>

                <!-- ===================================================
                    ** ESCOLAR
                =================================================== -->
                <?php if (validarPermiso('M_OPCIONES', 'R')) : ?>
                    <li class="nav-item">
                        <a href="e-escolar" class="nav-link">
                            <i class="nav-icon fas fa-school"></i>
                            <p>Escolar</p>
                        </a>
                    </li>
                <?php endif ?>

                <!-- ===================================================
                    ** ESTANDAR PROCESOS DE CALIDAD
                =================================================== -->
                <?php if (validarPermiso('M_OPCIONES', 'R')) : ?>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-tasks"></i>
                            <p>Estandar. procesos calidad</p>
                        </a>
                    </li>
                <?php endif ?>

                <!-- ===================================================
                    ** FORMATOS DE CALIDAD
                =================================================== -->
                <?php if (validarPermiso('M_OPCIONES', 'R')) : ?>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-clipboard-check"></i>
                            <p>Formatos de calidad</p>
                        </a>
                    </li>
                <?php endif ?>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>