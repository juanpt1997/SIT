<?php

if (!validarPermiso('M_GESTION_HUMANA', 'R')) {
    echo "<script> window.location = '" . URL_APP . "'; </script>";
}

//$PerfilSD = ControladorGH::ctrMostrarPerfilSD();
$CantidadColumnasHijos = ControladorGH::ctrMayorCantidadHijos()['cantidad'];

?>
<!-- =====================  
    VISTA PERFIL SOCIODEMOGRAFICO
========================= -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark "><b><i>Perfil sociodemográfico <i class="fas fa-chart-area"></i></i></b></h1>
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
            <hr class="my-4">
            <div id="ghTabs"></div>

            <!-- ===================================================
                TABS
            =================================================== -->
            <div class="row">
                <div class="col-12 col-md-3 col-lg-2">
                    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <a class="nav-link active font-weight-bold border-bottom border-right rounded text-uppercase" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true"><i class="fas fa-table"></i> Tabla</a>
                        <a class="nav-link font-weight-bold border-bottom border-right rounded text-uppercase" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false"><i class="fas fa-chart-bar"></i> Gráficos</a>
                    </div>
                </div>
                <div class="col-12 col-md-9 col-lg-10">
                    <div class="tab-content" id="v-pills-tabContent">
                        <!-- ===================== 
                            TABLA PERFIL SOCIODEMOGRAFICO
                        ========================= -->
                        <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                            <div class="row">
                                <div id="spinnerTablaPerfilSD" class="spinner-border" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>

                                <div class="col">
                                    <table id="tblPerfilSD" class="table table-responsive table-sm text-sm table-striped table-bordered tablasBtnExport w-100 text-center text-nowrap">
                                        <thead class="text-capitalize text-nowrap" style="font-size: 13px;">
                                            <tr>
                                                <th style="min-width:90px;">Id</th>
                                                <th style="min-width:60px;">Consentimiento</th>
                                                <th style="min-width:90px;">Nombre</th>
                                                <th style="min-width:60px;">Fecha ingreso</th>
                                                <th style="min-width:60px;">Tipo documento</th>
                                                <th style="min-width:60px;">Documento</th>
                                                <th style="min-width:60px;">Lugar exped.</th>
                                                <th style="min-width:60px;">Fec. nacimiento</th>
                                                <th style="min-width:60px;">Lugar nacim.</th>
                                                <th style="min-width:90px;">Edad</th>
                                                <th style="min-width:60px;">Lugar resid.</th>
                                                <th style="min-width:90px;">Direccion</th>
                                                <th style="min-width:90px;">Barrio</th>
                                                <th style="min-width:60px;">Estrato social</th>
                                                <th style="min-width:90px;">Telefono 1</th>
                                                <th style="min-width:90px;">Telefono 2</th>
                                                <th style="min-width:60px;">Correo</th>
                                                <th style="min-width:90px;">Eps</th>
                                                <th style="min-width:90px;">Afp</th>
                                                <th style="min-width:90px;">Arl</th>
                                                <th style="min-width:90px;">Escolaridad</th>
                                                <th style="min-width:90px;">Raza</th>
                                                <th style="min-width:60px;">Pago segur. social</th>
                                                <th style="min-width:90px;">Cargo</th>
                                                <th style="min-width:60px;">Turno trabajo</th>
                                                <th style="min-width:90px;">Área</th>
                                                <th style="min-width:90px;">Género</th>
                                                <th style="min-width:60px;">Tipo sangre</th>
                                                <th style="min-width:60px;">Salario básico</th>
                                                <th style="min-width:60px;">Beneficio fijo</th>
                                                <th style="min-width:60px;">Bonif. variable</th>
                                                <th style="min-width:60px;">Tipo contrato</th>
                                                <th style="min-width:60px;">Tipo vinculac.</th>
                                                <th style="min-width:60px;">Antigüedad</th>
                                                <th style="min-width:60px;">Años experiencia</th>
                                                <th style="min-width:60px;">Tipo vivienda</th>
                                                <th style="min-width:60px;">Estado civil</th>
                                                <th style="min-width:60px;">Personas a cargo</th>
                                                <th style="min-width:60px;">Ciudad</th>
                                                <th style="min-width:60px;">Departamento</th>
                                                <th style="min-width:90px;">Sucursal</th>
                                                <th style="min-width:60px;">Número licencia</th>
                                                <th style="min-width:90px;">Categoría</th>
                                                <th style="min-width:60px;">Fecha vencim.</th>
                                                <?php for ($i = 0; $i < $CantidadColumnasHijos; $i++) : ?>
                                                    <th style="min-width:60px;">Nombre hijo <?= $i + 1 ?></th>
                                                    <th style="min-width:60px;">Fec. nacimiento</th>
                                                    <th style="min-width:90px;">Edad</th>
                                                    <th style="min-width:90px;">Género</th>
                                                <?php endfor ?>
                                                <th style="min-width:90px;">Activo</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbodyPerfilSD" style="font-size: 13px;">

                                        </tbody>
                                    </table>
                                </div>

                            </div> <!-- /.row -->
                        </div>
                        <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                            <!-- ===================================================
                                GRÁFICOS
                            =================================================== -->
                            <div class="row d-flex justify-content-center">
                                <div class="col-9">
                                    <div class="card">
                                        <div class="card-header bg-info">
                                        </div>
                                        <div class="card-body">
                                            <div class="row d-flex justify-content-center">
                                                <div class="col-6">
                                                    <select id="selectGraf" class="form-control" name="">
                                                        <option value="" selected disabled>-SELECCIONE UNA OPCIÓN-</option>
                                                        <option value="cargo">CARGO</option>
                                                        <option value="nivel_escolaridad">NIVEL DE ESCOLARIDAD</option>
                                                        <option value="turno_trabajo">TURNO DE TRABAJO</option>
                                                        <option value="genero">GÉNERO</option>
                                                        <option value="tipo_vinculacion">TIPO DE VINCULACIÓN</option>
                                                        <option value="tipo_contrato">TIPO DE CONTRATO</option>
                                                    </select>
                                                </div>
                                                <div class="col-12" id="colGrafPerfilSD">
                                                    <canvas id="scGrafPerfilSD" style="height:300px;"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->