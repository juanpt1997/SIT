<link rel="stylesheet" href="<?= URL_APP ?>views/css/tracker.css?v=<?= time() ?>">

<!-- API KEY -->
<script src="<?= URL_APP ?>views/js/tecnolab-tracker.js?v=<?= time() ?>"></script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCB9pRTDe9mPjJ9YyqRNHopoG2S8A9sCGc&map_ids=768187b9c45dab96&callback=initMap"></script>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark "><strong><i>Rastreo satelital <i class="fas fa-globe-americas"></i></i></strong></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                        <li class="breadcrumb-item active">Rastreo satelital</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <hr class="my-4">
            <!-- ===================== 
              AGREGAR FILAS Y COLUMNAS PARA EL DESARROLLO 
            ========================= -->
            <div class="row">
                <div class="col-12">
                    <div class="lista_vehiculos">
                        <strong>Vehículos</strong>
                    </div>
                    <div id="map" class="gmap">
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
