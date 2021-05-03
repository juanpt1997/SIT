<nav class="main-header navbar navbar-expand navbar-light navbar-white">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="<?= URL_APP ?>inicio" class="nav-link">Inicio</a>
        </li>

    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

        <!-- Messages Dropdown Menu (Lo ideal seria usar el dropdown) -->
        <!-- <li class="nav-item dropdown mr-2">
            <img src="<?= $_SESSION['foto'] ?>" class="user-image img-circle elevation-2" style='width: 3rem;' alt="">
            <span class="d-none d-md-inline"></span>
        </li> -->
        <!-- <li class="nav-item dropdown">
            <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#cerrarSesionModal">
                <i class="fas fa-sign-out-alt" aria-hidden="true"> Salir</i>
            </button>
        </li> -->
        <li class="nav-item dropdown user-menu">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                <img src="<?= $_SESSION['foto'] ?>" class="user-image img-circle elevation-2">
                <span class="d-none d-md-inline"><?= $_SESSION['nombre'] ?></span>
            </a>
            <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <!-- User image -->
                <li class="user-header bg-light">
                    <img src="<?= $_SESSION['foto'] ?>" class="img-circle elevation-2">
                    <p>
                        <?= $_SESSION['nombre'] ?>
                    </p>
                    <hr>
                </li>

                <!-- Menu Footer-->
                <li class="user-footer mt-0">
                    <button data-toggle="modal" data-target="#modalPerfilUsuario" class="btn btn-outline-primary btn-flat">
                        <i class="fas fa-user-alt"></i> Perfil
                    </button>
                    <a href="<?= URL_APP ?>salir" class="btn btn-danger btn-flat float-right">
                        <i class="fas fa-sign-out-alt"></i> Salir
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</nav>
<!-- /.navbar -->