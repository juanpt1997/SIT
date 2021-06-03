<?php

if (!validarModulo('M_GESTION_HUMANA')) {
    echo "<script> window.location = 'inicio'; </script>";
}

$ContratosVencer = ControladorGH::ctrContratosVencer();

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
                    <h1 class="m-0 text-dark ">Alertas de contratos</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                        <li class="breadcrumb-item active">Gestión humana</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div id="ghTabs"></div>

            <div class="card card-secondary card-outline">
                <div class="card-body">
                    <!-- ===================== 
                        TABLA ALERTAS DE CONTRATOS
                    ========================= -->
                    <div class="row mt-2">
                        <div class="col-12">
                            <table class="table table-sm table-striped table-bordered tablasButtons dt-responsive w-100">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Documento</th>
                                        <th>Nombre</th>
                                        <th>Contrato</th>
                                        <th>Fecha fin</th>
                                        <th>Días para vencer</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($ContratosVencer as $key => $value) : ?>
                                        <tr>
                                            <td><?= $value['Documento'] ?></td>
                                            <td><?= $value['Nombre'] ?></td>
                                            <td><?= $value['contrato'] ?></td>
                                            <td><?= $value['fecha_fin'] ?></td>
                                            <td><span class="badge badge-danger"><?= $value['diferencia'] ?></span></td>
                                        </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->