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
                                     <td><button type="button" class="btn btn-warning btn-editarPersonal "data-toggle="modal" data-target=".bd-example-modal-xl" id="<?= $value['idvehiculo'] ?>"><i class="fas fa-edit"></i></button></td>
                                   
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
                <a class="nav-link" id="custom-content-below-home-tab" data-toggle="pill" href="#custom-content-below-home" role="tab" aria-controls="custom-content-below-home" aria-selected="false">DATOS DEL VEHICULO</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" id="custom-content-below-profile-tab" data-toggle="pill" href="#custom-content-below-profile" role="tab" aria-controls="custom-content-below-profile" aria-selected="true">INFO. TECNICA</a>
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
              <div class="tab-pane fade" id="custom-content-below-home" role="tabpanel" aria-labelledby="custom-content-below-home-tab">
               <div class="card card-danger">
              <div class="card-header">
                <h3 class="card-title">PLACA NUMERO </h3>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-3">
                    <input type="text" class="form-control" placeholder=".col-3">
                  </div>
                  <div class="col-4">
                    <input type="text" class="form-control" placeholder=".col-4">
                  </div>
                  <div class="col-5">
                    <input type="text" class="form-control" placeholder=".col-5">
                  </div>
                </div>
                <br>
                <div class="row">
                </div>
                <br>
                <div class="row">
                  <div class="col-3">
                    <input type="text" class="form-control" placeholder=".col-3">
                  </div>
                  <div class="col-4">
                    <input type="text" class="form-control" placeholder=".col-4">
                  </div>
                  <div class="col-5">
                    <input type="text" class="form-control" placeholder=".col-5">
                  </div>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
              </div>
        <div class="tab-pane fade active show" id="custom-content-below-profile" role="tabpanel" aria-labelledby="custom-content-below-profile-tab">
            <div class="row">
                  <div class="col-3">
                    <input type="text" class="form-control" placeholder=".col-3">
                  </div>
                  <div class="col-4">
                    <input type="text" class="form-control" placeholder=".col-4">
                  </div>
                  <div class="col-5">
                    <input type="text" class="form-control" placeholder=".col-5">
                  </div>
                </div>
                <br>
                <div class="row">
                  <div class="col-3">
                    <input type="text" class="form-control" placeholder=".col-3">
                  </div>
                  <div class="col-4">
                    <input type="text" class="form-control" placeholder=".col-4">
                  </div>
                  <div class="col-5">
                    <input type="text" class="form-control" placeholder=".col-5">
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
                                <input type="file" class="form-control-file" name="image" id="image">
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
                                <input type="file" class="form-control-file" name="image" id="image">
                            </div>
                            <input type="button" class="btn btn-primary upload" value="Subir">
                        </div>
                    </div>
                </form>
                </div> 
              </div>
              <div class="tab-pane fade" id="custom-content-below-settings" role="tabpanel" aria-labelledby="custom-content-below-settings-tab">
             <div class="row">
                <div class="form-group">
                    <label for="exampleInputFile"><i class="fas fa-money-check ">SOAT</label></i>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="exampleInputFile">
                        <label class="custom-file-label" for="exampleInputFile">CLICK PARA  LA SELECIONAR LA IMAGENe</label>
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text" id="">SUBIR</span>
                      </div>
                    </div>
                  </div>&nbsp
                  <div class="form-group">
                    <label for="exampleInputFile"><i class="fas fa-money-check ">TECNO MECANICA</label></i>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="exampleInputFile">
                        <label class="custom-file-label" for="exampleInputFile">CLICK PARA  LA SELECIONAR LA IMAGEN</label>
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text" id="">SUBIR</span>
                      </div>
                    </div>
                  </div> 
                </div>
                 <div class="row">
                  <div class="form-group">
                    <label for="exampleInputFile"><i class="fas fa-money-check ">REVISION</label></i>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="exampleInputFile">
                        <label class="custom-file-label" for="exampleInputFile">CLICK PARA  LA SELECIONAR LA IMAGEN</label>
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text" id="">SUBIR</span>
                      </div>
                    </div>
                  </div>&nbsp
                  <div class="form-group">
                    <label for="exampleInputFile"><i class="fas fa-money-check ">TARJETA DE PROPEIDAD</label></i>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="exampleInputFile">
                        <label class="custom-file-label" for="exampleInputFile">CLICK PARA  LA SELECIONAR LA IMAGEN</label>
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text" id="">SUBIR</span>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFile">POLIZA</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="exampleInputFile">
                        <label class="custom-file-label" for="exampleInputFile">CLICK PARA  LA SELECIONAR LA IMAGEN</label>
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text" id="">SUBIR</span>
                      </div>
                    </div>
                  </div>&nbsp
                    <div class="form-group">
                    <label for="exampleInputFile">EXTINTIOR</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="exampleInputFile">
                        <label class="custom-file-label" for="exampleInputFile">CLICK PARA  LA SELECIONAR LA IMAGEN</label>
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text" id="">SUBIR</span>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="tab-custom-content">
              <p class="lead mb-0">IMAGENES SUBIDAS </p>
            </div>
              </div>
               <div class="tab-pane fade" id="custom-content-below-propietarios" role="tabpanel" aria-labelledby="custom-content-below-propietarios-tab">
               <div class="card bg-light">
                 <div class="col-md-7">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                           <i class="fas fa-key "></label></i>
                </div>

                <div class="form-group">
                        <label>NOMBRE </label>
                        <input type="text" class="form-control" placeholder="Enter ...">
                        <label>APELLIDO </label>
                        <input type="text" class="form-control" placeholder="Enter ...">
                </div>
             <div class="form-group">
                        <label>CEDULA</label>
                        <input type="text" class="form-control" placeholder="Enter ...">
                      </div>
             <div class="form-group">
                        <label>TELEFONO</label>
                        <input type="text" class="form-control" placeholder="Enter ...">
                      </div>
                 
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- About Me Box -->
             
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
               </div>
               <div class="tab-pane fade" id="custom-content-below-conductores" role="tabpanel" aria-labelledby="custom-content-below-conductores-tab">
                HOLA MUND
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
