<?php

if (!validarPermiso('M_VEHICULAR', 'R')) {
    echo "<script> window.location = 'inicio'; </script>";
}

?>
<style>
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
                    <h1 class="m-0 text-dark "><strong><i>Comparendos y acuerdos de pago </i></strong></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                        <li class="breadcrumb-item active">Comparendos y acuerdos de pago</li>
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
                <img src="views/img/imgMultas/Version_2_multas_dashboard.jpeg" alt="" class="card-img-top">
            </div>
            <h3 class="m-0 text-dark "><strong><i>Consultas </i></strong></h3>

            <div class="card">
                <div class="parallax5">
                    <div class="card-body">
                        <div class="row justify-content-end" style="margin-left:620px; margin-top:90px;">
                            <!-- CONSULTAS GENERALES  -->
                            <div class="col-12 justify-content-end">

                                <div class="dropdown col-lg-12 col-md-6 col-sm-3" style="cursor: pointer;">
                                    <div class="info-box border border-warning" id="ConsultasGenerales" data-toggle="dropdown">
                                        <span class="info-box-icon bg-warning"><i class="fas fa-search"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text font-weight-bold text-dark">Consultas
                                                generales</span>
                                        </div>
                                        <!-- /.info-box-content -->
                                    </div>
                                    <!-- /.info-box -->
                                    <div class="dropdown-menu" aria-labelledby="ConsultasGenerales" style="font-size: 14px;">
                                        <?php if (validarPermiso('M_VEHICULAR', 'R')) : ?>
                                            <a class="dropdown-item font-weight-bold" target="_blank" href="https://www.runt.com.co/consultaCiudadana/#/consultaVehiculo"><u>Por placas de vehículo</u></a>
                                            <a class="dropdown-item font-weight-bold" target="_blank" href="https://www.runt.com.co/consultaCiudadana/#/consultaPersona"><u>Licencia de conducción</u></a>
                                            <a class="dropdown-item font-weight-bold" target="_blank" href="https://fcm.org.co/simit/#/home-public"><u>Infracciones de tránsito</u></a>
                                            <a class="dropdown-item font-weight-bold" target="_blank" href="https://www.runt.com.co/registros-runt/rnat"><u>De accidentalidad</u></a>
                                            <a class="dropdown-item font-weight-bold" target="_blank" href="https://www.runt.com.co/directorio-de-actores"><u>Directorio de actores de tránsito</u></a>
                                            <a class="dropdown-item font-weight-bold" target="_blank" href="https://mintransporte.gov.co/publicaciones/4464/devolucion-de-dineros-por-tramites-cancelados-y-no-realizados/"><u>Procedimiento devolución de dineros por trámites cancelados y no realizados</u></a>
                                            <a class="dropdown-item font-weight-bold" target="_blank" href="https://mintransporte.gov.co/publicaciones/5544/bases-gravables-para-pago-de-impuesto-de-vehiculos-automotores/"><u>Bases gravables para pago de impuesto de vehículos automotores</u></a>

                                        <?php endif ?>


                                    </div>
                                </div>
                            </div>



                            <!-- TRANSPORTE Y TRANSITO NACIONAL -->
                            <div class="col-12 justify-content-end">

                                <div class="dropdown col-lg-12 col-md-6 col-sm-3" style="cursor: pointer;">
                                    <div class="info-box border border-primary" id="ConsultasGenerales" data-toggle="dropdown">
                                        <span class="info-box-icon bg-primary"><i class="fas fa-directions"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text font-weight-bold text-dark ">
                                                Transporte y tránsito nacional</span>
                                        </div>
                                        <!-- /.info-box-content -->
                                    </div>
                                    <!-- /.info-box -->
                                    <div class="dropdown-menu" aria-labelledby="ConsultasGenerales" style="font-size: 14px;">
                                        <?php if (validarPermiso('M_VEHICULAR', 'R')) : ?>
                                            <a class="dropdown-item font-weight-bold" target="_blank" href="https://web.mintransporte.gov.co/consultas_mod/cambioServicio.jsp"><u>Estado cambio de servicio</u></a>
                                            <a class="dropdown-item font-weight-bold" target="_blank" href="https://mintransporte.gov.co/publicaciones/4334/programa_de_reposicion_integral_de_vehiculos/"><u>Estado de trámites chatarrización</u></a>
                                            <a class="dropdown-item font-weight-bold" target="_blank" href="https://web.mintransporte.gov.co/Consultas/empresas/home.htm"><u>Empresas de Transporte Terrestre Automotor</u></a>
                                            <a class="dropdown-item font-weight-bold" target="_blank" href="https://web.mintransporte.gov.co/Consultas/venales/home.htm"><u>Pago de especies venales SIREV</u></a>
                                            <a class="dropdown-item font-weight-bold" target="_blank" href="https://web.mintransporte.gov.co/peajes/seguridad/wf_iniciosesion.aspx"><u>Aplicación Modelo de costos para peaje</u></a>
                                            <a class="dropdown-item font-weight-bold" target="_blank" href="https://consulta-to.mintransporte.gov.co/"><u>Consulta estado tarjeta de operación</u></a>

                                        <?php endif ?>


                                    </div>
                                </div>
                            </div>

                            <!-- TRANSPORTE Y TRANSITO INTERNACIONAL -->
                            <div class="col-12 justify-content-end">
                                <div class="dropdown col-lg-12 col-md-6 col-sm-3" style="cursor: pointer;">
                                    <div class="info-box border border-danger" id="ConsultasGenerales" data-toggle="dropdown">
                                        <span class="info-box-icon bg-danger"><i class="fas fa-truck"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text font-weight-bold text-dark ">
                                                Transporte y tránsito internacional</span>
                                        </div>
                                        <!-- /.info-box-content -->
                                    </div>
                                    <!-- /.info-box -->
                                    <div class="dropdown-menu" aria-labelledby="ConsultasGenerales" style="font-size: 14px;">
                                        <?php if (validarPermiso('M_VEHICULAR', 'R')) : ?>
                                            <a class="dropdown-item font-weight-bold" target="_blank" href="https://web.mintransporte.gov.co/consultas_mod/servicioInternacional.jsp"><u>Vehículos y Unidades de Carga</u></a>
                                            <a class="dropdown-item font-weight-bold" target="_blank" href="https://web.mintransporte.gov.co/consulta_spain/Consultas.aspx"><u>Licencias España</u></a>

                                        <?php endif ?>


                                    </div>
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