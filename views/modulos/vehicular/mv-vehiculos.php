<?php
 
// if(!array_search('CARGAR_OPCION',$_SESSION['opciones'])) {
//     echo "<script> window.location = 'inicio'; </script>";
// }

$Listado = ControladorMV::ctrListaMV();
$ListadoMV=   array('objeto' =>$Listado);

?>
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
                    <h1 class="m-0 text-dark ">Modulo de Vehiculos</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                        <li class="breadcrumb-item active">Plantilla</li>
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
              AGREGAR FILAS Y COLUMNAS PARA EL DESARROLLO 
            ========================= -->            
            <div class="row">
                <div class="card-body">
              <button type="button" class="btn btn-outline-primary btn-lg" data-toggle="modal" data-target=".bd-example-modal-xl" idvh="<?= $value['idvehiculo'] ?>"><i class=" fas fa-truck-moving"><H2>+</H2></i></button>
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ACCIONES</th>
                  <th>PLACA</th>
                  <th>NUMERO INTERNO</th>
                  <th>DOCUMENTO</th>
                  <th>NOMBRE</th>
                  <th>TIPO DOC</th>
                  <th>MARCA</th>
                  <th>MODELO</th>
                </tr>
                </thead>
              
                <tbody>

                    <?php foreach ($ListadoMV as $value) :   ?>
                                 
                                <tr>
                                     <td><button type="button" class="btn btn-warning btn-editarPersonal "data-toggle="modal" data-target=".bd-example-modal-xl" id="vehiculo" value="<?= $value['idvehiculo'] ?>"><i class="fas fa-edit"></i></button></td>
                                   
                                    <td><?= $value['placa'] ?></td>
                                    <td><?= $value['numinterno'] ?></td>
                                    <td><?= $value['documento'] ?></td>
                                    <td><?= $value['nombre'] ?></td>
                                    <td><?= $value['chasis'] ?></td>
                                    <td><?= $value['numeromotor'] ?></td>
                                    <td><?= $value['modelo'] ?></td>
                                    
                                   
                                </tr>
                            <?php endforeach; ?>
                     </tbody>
                </tfoot>
                 </tfoot>
              </table>
            </div>
                
               
            </div> <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>

<div class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
    <from name=vehiculos>
      <div class="card card-primary card-outline">
          <div class="card-header">
            <h3 class="card-title">
              <i class="fas fa-edit"></i>
             VEHICULOS
            </h3>
          </div>
          <div class="card-body">
            <h4>MODULO DE VEHICULOS</h4>
            <ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
              <li class="nav-item">
                <a class="nav-link" id="custom-content-below-tipov-tab" data-toggle="pill" href="#custom-content-below-tipov" role="tab" aria-controls="custom-content-below-tipov" aria-selected="false">DATOS DEL VEHICULO</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" id="custom-content-below-inftec-tab" data-toggle="pill" href="#custom-content-below-inftec" role="tab" aria-controls="custom-content-below-inftec" aria-selected="true">INFO. TECNICA</a>
              </li>
           <li class="nav-item">
                <a class="nav-link" id="custom-content-below-caract-tab" data-toggle="pill" href="#custom-content-below-caract" role="tab" aria-controls="custom-content-below-caract" aria-selected="false">CARACTERISTICAS</a>
              </li>

              <li class="nav-item">
                <a class="nav-link" id="custom-content-below-messages-tab" data-toggle="pill" href="#custom-content-below-messages" role="tab" aria-controls="custom-content-below-messages" aria-selected="false">IMAGENES</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="custom-content-below-settings-tab" data-toggle="pill" href="#custom-content-below-settings" role="tab" aria-controls="custom-content-below-settings" aria-selected="false">DOCUMENTOS</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="custom-content-below-propietarios-tab" data-toggle="pill" href="#custom-content-below-propietarios" role="tab" aria-controls="custom-content-below-propietarios" aria-selected="false">PROPIETARIOS</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="custom-content-below-conductores-tab" data-toggle="pill" href="#custom-content-below-conductores" role="tab" aria-controls="custom-content-below-conductores" aria-selected="false">CONDUCTORES</a>
              </li>
            </ul>
         <div class="tab-content" id="custom-content-below-tabContent">
          <div class="tab-pane fade" id="custom-content-below-tipov" role="tabpanel" aria-labelledby="custom-content-below-tipov-tab">
               <div class="card card-danger">
              <div class="card-header">
                <h3 class="card-title">PLACA NUMERO </h3>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-3">
                    <input type="text" id="placa" name="placa" class="form-control" placeholder="PLACA">
                  </div>
                  <div class="col-4">
                    <input type="text" Id="nuemroin" class="form-control" placeholder="NUMERO INTERNO">
                  </div>
                  <div class="col-5">
               <div class="form-group">
               <select class="form-control select2" style="width: 100%;">
                    <option selected="selected">TIPO VINCULACION</option>
                    <option>Alaska</option>
                    <option disabled="disabled">California (disabled)</option>
                  </select>
                </div>
                  </div>
                </div>
                <br>
                <div class="row">
                </div>
                <br>
                <div class="row">
                  <div class="col-3">
                    <input type="text" id="nombre" class="form-control" placeholder="NOMBRE">
                  </div>
                  <div class="col-4">
                    <div class="form-group">
                   <select class="form-control select2" style="width: 100%;">
                    <option selected="selected">SUCURSAL</option>
                    <option>Alaska</option>
                    <option disabled="disabled">California (disabled)</option>
                  </select>
                </div>
                  </div>
                  <div class="col-5">
                    <div class="input-group date" id="reservationdate" data-target-input="nearest">
                        <input type="text" class="form-control datetimepicker-input" data-target="#reservationdate">
                        <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
       </div>  <!-- /.tb1 -->
        <div class="tab-pane fade active show" id="custom-content-below-inftec" role="tabpanel" aria-labelledby="custom-content-below-inftec-tab">
            <div class="row">
                  <div class="col-3">
                    <input type="text"  id="nmotor" class="form-control" placeholder="MOTOR">
                  </div>
                  <div class="col-4">
                    <input type="text" id="cilindraje" class="form-control" placeholder="CILINDRAJE">
                  </div>
                  <div class="col-5">
                    <input type="text" id="chasis" class="form-control" placeholder="CHASIS">
                  </div>
                </div>
                <br>
              <div class="row">
                  <div class="col-3">
                   <div class="form-group">
                   <select class="form-control select2" style="width: 100%;">
                    <option selected="selected">Tipo vhiculo</option>
                    <option>TRACTOR</option>
                    <option disabled="disabled">LANCHA (disabled)</option>
                  </select>
                </div>
                  </div>
                  <div class="col-4">
                    <input type="text" id="modelo" name="modelo" class="form-control" placeholder="MODELO">
                  </div>
                  <div class="col-5">
                      <div class="form-group">
                   <select class="form-control select2" style="width: 100%;">
                    <option selected="selected">Marca</option>
                    <option>CINCA</option>
                    <option disabled="disabled">BMW (disabled)</option>
                  </select>
                </div>
                  </div>
                </div>
                 <br>
                   <div class="row">
                  <div class="col-3">
                    <input type="text" id="color" name="color" class="form-control" placeholder="COLOR">
                  </div>
                  <div class="col-4">
                    <input type="text"  id="tpcarroceria" name="tpcarroceria" class="form-control" placeholder="TIPO DE CARROCERIA">
                  </div>
                  <div class="col-5">
                    <input type="text" id="capacidad" name="capacidad" class="form-control" placeholder=".col-5">
                  </div>
                      <div class="col-5">
                    <input type="text" id="potencia" name="potencia" class="form-control" placeholder=".col-5">
                  </div>
                </div>
        </div><!-- TB2 -->
        <div class="tab-pane fade" id="custom-content-below-caract" role="tabpanel" aria-labelledby="custom-content-below-conductores-tab">
                      <div class="row">
                  <div class="col-3">
                    <input type="text"  id="fechimp" nmae="fechaimportacion" class="form-control" placeholder="FECHA DE IMORTACION">
                  </div>
                  <div class="col-4">
                    <input type="text" id="fechaexp" name="fechaexpedicion" class="form-control" placeholder="FECHA DE EXPEDICION">
                  </div>
                  <div class="col-5">
                       <input type="text" id="limitacion" name="limitcion" class="form-control" placeholder="LIMITACION">
                  </div>
                </div>&abs
                <div class="row">
                  <div class="col-3">
                   <div class="form-group">
                   <select class="form-control select2" style="width: 100%;">
                    <option selected="selected">convenio</option>
                    <option>TRACTOR</option>
                    <option disabled="disabled">LANCHA (disabled)</option>
                  </select>
                  </div>
                  </div>
                  <div class="col-4">
                    <input type="text" id="fechaconv" name="fechafinconveniio" class="form-control" placeholder="FECHA DEL CONVENIO">
                  </div>
                  <div class="col-5">
                   <div class="col-5">
                    <input type="text" id="transito" name="trAnsito" class="form-control" placeholder="TRANSITO">
                  </div>
                  </div>
              </div>
                <div class="row">
                  <div class="col-3">
                    <input type="text" id="dimp" name="declaracionimpor" class="form-control" placeholder="DECLARACION IMPORTACION">
                  </div>
                  <div class="col-4">
                    <input type="text"  id="fechadesvinculacion" name="fechadesvinculacion" class="form-control" placeholder="FECHA DESVICULACION">
                  </div>
                  <div class="col-5">
                    <input type="text" id="fechamatricula" name="fechamatricula" class="form-control" placeholder="FECHA DE MATRICULA">
                  </div>
                      <div class="col-3">
                    <input type="text" id="potencia" name="potencia" class="form-control" placeholder="POTENCIA">
                  </div>
                </div>
      </div>
        <div class="tab-pane fade" id="custom-content-below-messages" role="tabpanel" aria-labelledby="custom-content-below-messages-tab">
                   <div class="row">
                   <form method="post" action="#" enctype="multipart/form-data">
                    <div class="card" style="width: 18rem;">
                        <img class="card-img-top" src="images/default-avatar.png">
                        <div class="card-body">
                            <h5 class="card-title">Sube una foto</h5>
                            <p class="card-text">Sube una imagen...</p>
                            <div class="form-group">
                                <label for="image">Nueva imagen</label>
                                <input type="file" id="" class="form-control-file" name="image" id="image">
                            </div>
                            <input type="button" class="btn btn-primary upload" value="Subir">
                        </div>
                    </div>
                </form>
                </div>
                <br>
                <div class="row">
               <form method="post" action="#" enctype="multipart/form-data">
                    <div class="card" style="width: 18rem;">
                        <img class="card-img-top" src="images/default-avatar.png">
                        <div class="card-body">
                            <h5 class="card-title">Sube una foto</h5>
                            <p class="card-text">Sube una imagen...</p>
                            <div class="form-group">
                                <label for="image">Nueva imagen</label>
                                <input type="file" id="" class="form-control-file" name="image" id="image">
                            </div>
                            <input type="button" id=""class="btn btn-primary upload" value="Subir">
                        </div>
                    </div>
                </form>
                </div> 
      </div> <!-- TB3 -->
      <div class="tab-pane fade" id="custom-content-below-messages" role="tabpanel" aria-labelledby="custom-content-below-messages-tab">
                   <div class="row">
                   <form method="post" action="#" enctype="multipart/form-data">
                    <div class="card" style="width: 18rem;">
                        <img class="card-img-top" src="images/default-avatar.png">
                        <div class="card-body">
                            <h5 class="card-title">Sube una foto</h5>
                            <p class="card-text">Sube una imagen...</p>
                            <div class="form-group">
                                <label for="image">Nueva imagen</label>
                                <input type="file" id=" class="form-control-file" name="image" id="image">
                            </div>
                            <input type="button" class="btn btn-primary upload" value="Subir">
                        </div>
                    </div>
                </form>
                </div>
                <br>
                <div class="row">
               <form method="post" action="#" enctype="multipart/form-data">
                    <div class="card" style="width: 18rem;">
                        <img class="card-img-top" src="images/default-avatar.png">
                        <div class="card-body">
                            <h5 class="card-title">Sube una foto</h5>
                            <p class="card-text">Sube una imagen...</p>
                            <div class="form-group">
                                <label for="image">Nueva imagen</label>
                                <input type="file" id=" class="form-control-file" name="image" id="image">
                            </div>
                            <input type="button" id="class="btn btn-primary upload" value="Subir">
                        </div>
                    </div>
                </form>
                </div> 
        </div> <!-- TB4 -->
        <div class="tab-pane fade" id="custom-content-below-settings" role="tabpanel" aria-labelledby="custom-content-below-settings-tab">
             <div class="row">
              <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Quick Example</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form>
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFile">File input</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="exampleInputFile">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text">Upload</span>
                      </div>
                    </div>
                  </div>
                  <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Check me out</label>
                  </div>
                </div>
                <!-- /.card-body -->
 
              </form>
            </div>
            </div>
            <div class="row">
            </div> <!-- TB6 -->
       </div>
      <div class="tab-pane fade" id="custom-content-below-propietarios" role="tabpanel" aria-labelledby="custom-content-below-propietarios-tab">
            <div class="row">
            </div>
            <div class="row">
            </div> <!-- TB6 -->
        </div>
      <div class="tab-pane fade" id="custom-content-below-conductores" role="tabpanel" aria-labelledby="custom-content-below-conductores-tab">
              <div class="row">
            </div>
            <div class="row">
            </div> <!-- TB6 -->
               </div>

            </div>
            <!--  -->

            
          </div>
          <!-- /.card -->
        </div>
    </from>
    </div>
  </div>
</div>

<!-- /.content-wrapper -->
