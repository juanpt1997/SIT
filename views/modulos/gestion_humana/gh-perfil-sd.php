<?php

if (!validarModulo('M_GESTION_HUMANA')) {
    echo "<script> window.location = '" . URL_APP . "'; </script>";
}


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
                    <h1 class="m-0 text-dark ">Perfil sociodemográfico</h1>
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

            <!-- ===================== 
                TABLA PERFIL SOCIODEMOGRAFICO
            ========================= -->
            <div class="row mt-5">
                <div class="col-12 table-responsive">
                    
                    <table class="table table-sm table-light table-striped table-bordered tablas dt-responsive w-100">
                        <thead class="thead-light text-capitalize">
                            <tr>
                                <th style="width:10px;">Id</th>
                                <th>Consentimiento</th>
                                <th>fecha ingreso</th>
                                <th>tipo documento</th>
                                <th>documento</th>
                                <th>nombre</th>
                                <th>lugar exped.</th>
                                <th>fec. nacimiento</th>
                                <th>lugar nacim.</th>
                                <th>edad</th>
                                <th>lugar resid.</th>
                                <th>direccion</th>
                                <th>barrio</th>
                                <th>estrato social</th>
                                <th>telefono 1</th>
                                <th>telefono 2</th>
                                <th>correo</th>
                                <th>eps</th>
                                <th>afp</th>
                                <th>arl</th>
                                <th>escolaridad</th>
                                <th>raza</th>
                                <th>pago segur. soc.</th>
                                <th>cargo</th>
                                <th>turno trabajo</th>
                                <th>area</th>
                                <th>sexo</th>
                                <th>tipo sangre</th>
                                <th>salario basico</th>
                                <th>beneficio fijo</th>
                                <th>bonif. variable</th>
                                <th>tipo contrato</th>
                                <th>tipo vinculac.</th>
                                <th>antigüedad</th>
                                <th>años experiencia</th>
                                <th>tipo vivienda</th>
                                <th>estado civil</th>
                                <th>personas a cargo</th>
                                <th>ciudades</th>
                                <th>departamento</th>
                                <th>sucursal</th>
                                <th>número licencia</th>
                                <th>categoría</th>
                                <th>fecha vencim.</th>
                                <th>nombre hijo</th>
                                <th>fec. nacimiento</th>
                                <th>edad</th>
                                <th>genero</th>
                                <th>activo</th>
                            </tr>
                        </thead>
                        <tbody class="">
                            <tr>
                                <td>test</td>
                                <td>test</td>
                                <td>test</td>
                                <td>test</td>
                                <td>test</td>
                                <td>test</td>
                                <td>test</td>
                                <td>test</td>
                                <td>test</td>
                                <td>test</td>
                                <td>test</td>
                                <td>test</td>
                                <td>test</td>
                                <td>test</td>
                                <td>test</td>
                                <td>test</td>
                                <td>test</td>
                                <td>test</td>
                                <td>test</td>
                                <td>test</td>
                                <td>test</td>
                                <td>test</td>
                                <td>test</td>
                                <td>test</td>
                                <td>test</td>
                                <td>test</td>
                                <td>test</td>
                                <td>test</td>
                                <td>test</td>
                                <td>test</td>
                                <td>test</td>
                                <td>test</td>
                                <td>test</td>
                                <td>test</td>
                                <td>test</td>
                                <td>test</td>
                                <td>test</td>
                                <td>test</td>
                                <td>test</td>
                                <td>test</td>
                                <td>test</td>
                                <td>test</td>
                                <td>test</td>
                                <td>test</td>
                                <td>test</td>
                                <td>test</td>
                                <td>test</td>
                                <td>test</td>
                                <td>test</td>
                            </tr>
                        </tbody>
                    </table>
                </div><!-- col -->


            </div> <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->