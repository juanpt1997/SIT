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
        <div class="container-fluid">
            <!-- ===================== 
              IFRAME
            ========================= -->
            <div class="second-row">
                <iframe src="http://apps.tecnolab.com.co/sit/" title="Test"></iframe>
                <!-- <iframe src="https://fcm.org.co/simit/#/home-public" title="Test"></iframe> -->
            </div>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->