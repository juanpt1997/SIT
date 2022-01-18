<!-- <link rel="stylesheet" href="<?= URL_APP ?>views/css/tracker.css?v=<?= time() ?>"> -->
<link rel="stylesheet" href="<?= URL_APP ?>views/css/tracker.css?v=<?= time() ?>">
<!-- API KEY -->
<!-- <script src="<?= URL_APP ?>views/js/tecnolab-tracker.js?v=<?= time() ?>"></script> -->
<!-- <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCB9pRTDe9mPjJ9YyqRNHopoG2S8A9sCGc&map_ids=768187b9c45dab96&callback=initMap"></script> -->

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


                    <div id="map"></div>

                    <!-- <div class="row mt-3">
                        <div class="col-6">
                            <div class="card justify-content-center">
                                <div class="card-header bg-success text-center">
                                    <strong>Lista de vehículos <i class="fas fa-car"></i></strong>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive mt-2">
                                        <table id="tablaVehiculos" class="table table-sm table-striped table-bordered dt-responsive table-hover tablas w-100">
                                            <thead class="thead-light text-sm text-center">
                                                <tr>
                                                    <th>Acciones</th>
                                                    <th>Vehículo</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tbodyVehiculos" class="text-center">

                                            </tbody>
                                        </table>
                                    </div>

                                </div>

                            </div>
                        </div>
                        <div class="col-6">
                            <div class="card">
                                <div class="card-header bg-navy text-center">
                                    <strong>Funcionalidades <i class="far fa-map"></i></strong>
                                </div>
                                <div class="card-body">
                                </div>
                            </div>
                        </div>
                    </div> -->



                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->