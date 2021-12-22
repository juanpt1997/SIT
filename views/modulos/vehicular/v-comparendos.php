<?php

if (!validarPermiso('M_VEHICULAR', 'R')) {
    echo "<script> window.location = 'inicio'; </script>";
}

?>
<!-- ===================== 
  MODELO PARA LA IMPLEMENTARCION EN EL DISEÑO DE LOS MODULOS
  ESTRUCTURA 
========================= -->

<style>
    body,
    html {
        width: 100%;
        height: 100%;
        margin: 0;
        padding: 0
    }

    .first-row {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 100px;
        background-color: lime;
    }

    .second-row {
        position: absolute;
        top: 100px;
        left: 100px;
        right: 50px;
        bottom: 50px;
    }

    .second-row iframe {
        display: block;
        width: 100%;
        height: 100%;
        border: none;
    }


    .parallax4 {

        background-image: url("<?= URL_APP ?>views/img/imgMultas/Version_1_multas_dashboard.jpeg");
        min-height: 500px;
        min-width: 500px;
        background-attachment: fixed;
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        display: grid;
    }

    .parallax5 {

        background-image: url("<?= URL_APP ?>views/img/imgMultas/cuerpo_multas.jpeg");
        min-height: 500px;
        min-width: 500px;
        background-attachment: fixed;
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        display: grid;
    }
</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark ">Comparendos, multas y acuerdos de pago</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                        <li class="breadcrumb-item active">Comparendos, multas y acuerdos de pago</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid pt-4">
            <!-- ===================== 
              IFRAME
            ========================= -->
            <!-- <div class="second-row">
                <iframe src="http://apps.tecnolab.com.co/sit/" title="Test"></iframe> -->
            <!-- <iframe src="https://fcm.org.co/simit/#/home-public" title="Test"></iframe> -->
            <!-- </div> -->


            <div class="card">
                <div class="parallax4">
                    <div class="card-body">
                        <div class="row"></div>
                    </div>
                </div>
            </div>
            <div style="height:100px;font-size:60px;"></div>

            <div class="card">
                <div class="parallax5">
                    <div class="card-body">
                        <div class="row">
                            <div class="dropdown " style="cursor: pointer; position:right;">
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
                                    <?php if (validarPermiso('M_OPCIONES', 'R')) : ?>
                                        <a class="dropdown-item font-weight-bold" href="cg-mantenimiento"><u>Matenimiento</u></a>
                                        <a class="dropdown-item font-weight-bold" href="cg-almacen"><u>Almacén</u></a>
                                        <a class="dropdown-item font-weight-bold" href="cg-seguridad"><u>Seguridad</u></a>
                                    <?php endif ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div style="height:100px;font-size:60px;"></div>




        </div><!-- /.container-fluid -->




    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->