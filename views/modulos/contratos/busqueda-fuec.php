<?php

// if(!validarModulo('CARGAR_OPCION')) {
//     echo "<script> window.location = 'inicio'; </script>";
// }


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
            <div class="row d-flex justify-content-center">
                <div class="col-md-6">
                    <div class="card card-outline card-success text-center">
                        <div class="card-body">
                            <label>Consulta - Busqueda de FUEC</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <button type="" class="btn btn-success">Codigo de seguridad</button>
                                </div>
                                <!-- /btn-group -->
                                <input type="text" class="form-control" placeholder="Digite su codigo de seguridad">
                            </div>
                            <button type="submit" id="busquedafuec" class="btn btn-default">Busqueda</button>
                            <button type="submit" id="limpiarfiltros" class="btn btn-default">Limpiar Filtros</button>
                            <button type="submit" id="salir" class="btn btn-default">Salir</button>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->