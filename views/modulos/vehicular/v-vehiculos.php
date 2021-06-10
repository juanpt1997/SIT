<?php
 
/* if(!array_search('CARGAR_OPCION',$_SESSION['opciones'])) {
    echo "<script> window.location = 'inicio'; </script>";
} */


?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark ">Vehiculos</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                        <li class="breadcrumb-item active">Vehiculos</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            
            <!--|||TABLA VEHICULOS|||-->

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-info"></div>
                        <div class="card-body">

                            <div class="row">
                                <div class="col">
                                    <!--BOTON NUEVO VEHICULO-->
                                    <button type="button" class="btn btn-success btn-lg btn-agregarVehiculo" data-toggle="modal" data-target="#VehiculoModal">

                                        <i class="fas fa-car-side"></i> Añadir Vehiculo
                                    </button>
                                </div><!-- col -->
                            </div> <!-- /.row -->

                                <div class="table-responsive">
                                    <table class="table table-sm table-striped table-bordered dt-responsive table-hover tablasBtnExport w-100">
                                        <thead class="thead-light text-sm text-center">
                                            <tr>
                                                <th style="width:10px;">#</th>
                                                <th>Placa</th>
                                                <th>Nro. Interno</th>
                                                <th>Nombre</th>
                                                <th>Documento</th>
                                                <th>Sucursal</th>
                                                <th>Fecha vinculacion</th>
                                                <th>Chasis</th>
                                                <th>Nro. Motor</th>
                                                <th>Modelo</th>
                                                <th>Color</th>
                                                <th>Capacidad</th>
                                                <th>Cilindraje</th>
                                                <th>Tipo vinculacion</th>
                                                <th>Fecha importación</th>
                                                <th>Potencia</th>
                                                <th>Limitacion propiedad</th>
                                                <th>Tipo de vehiculo</th>
                                                <th>Marca</th>
                                                <th>Fecha matricula</th>
                                                <th>Activo</th>
                                                <th>Empresa Convenio</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td>
                                                    <div class="btn-group" role="group" aria-label="Button group">
                                                        <button class="btn btn-sm btn-warning btnEditarVehiculo" data-toggle="modal" data-target="#VehiculosModal"><i class="fas fa-edit"></i></button>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>

                                    </table>

                                </div>
                        </div>
                        <div class="card-footer bg-dark"></div>
                    </div>
                </div><!-- col -->
            </div> <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div><!-- /.content -->  
</div><!-- /.content-wrapper -->

<!--MODALS-->

<div class="modal fade" id="VehiculosModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <form method="post" enctype="multipart/form-data">

                <div class="modal-header bg-secondary">
                    <h5 class="modal-title d-none" id="exampleModalLabel">Agregar vehiculo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="card">
                    <div class="card-header"></div>
                    <div class="card-body"></div>
                </div>


                
            </form>


        </div>
    </div>
</div>
