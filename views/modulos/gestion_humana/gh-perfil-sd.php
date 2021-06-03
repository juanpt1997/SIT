<?php

if (!validarModulo('M_GESTION_HUMANA')) {
    echo "<script> window.location = '" . URL_APP . "'; </script>";
}

$PerfilSD = ControladorGH::ctrMostrarPerfilSD();
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
                    <table class="table table-sm table-light table-striped table-bordered tablasButtons dt-responsive w-100">
                        <thead class="text-capitalize text-sm text-nowrap">
                            <tr>
                                <th style="width:10px;">Id</th>
                                <th>Consentimiento</th>
                                <th>Nombre</th>
                                <th>Fecha ingreso</th>
                                <th>Tipo documento</th>
                                <th>Documento</th>
                                <th>Lugar exped.</th>
                                <th>Fec. nacimiento</th>
                                <th>Lugar nacim.</th>
                                <th>Edad</th>
                                <th>Lugar resid.</th>
                                <th>Direccion</th>
                                <th>Barrio</th>
                                <th>Estrato social</th>
                                <th>Telefono 1</th>
                                <th>Telefono 2</th>
                                <th>Correo</th>
                                <th>Eps</th>
                                <th>Afp</th>
                                <th>Arl</th>
                                <th>Escolaridad</th>
                                <th>Raza</th>
                                <th>Pago segur. social</th>
                                <th>Cargo</th>
                                <th>Turno trabajo</th>
                                <th>Área</th>
                                <th>Género</th>
                                <th>Tipo sangre</th>
                                <th>Salario básico</th>
                                <th>Beneficio fijo</th>
                                <th>Bonif. variable</th>
                                <th>Tipo contrato</th>
                                <th>Tipo vinculac.</th>
                                <th>Antigüedad</th>
                                <th>Años experiencia</th>
                                <th>Tipo vivienda</th>
                                <th>Estado civil</th>
                                <th>Personas a cargo</th>
                                <th>Ciudad</th>
                                <th>Departamento</th>
                                <th>Sucursal</th>
                                <th>Número licencia</th>
                                <th>Categoría</th>
                                <th>Fecha vencim.</th>
                                <?php for ($i=0; $i < $CantidadColumnasHijos; $i++) : ?>
                                    <th>Nombre hijo <?= $i + 1 ?></th>
                                    <th>Fec. nacimiento</th>
                                    <th>Edad</th>
                                    <th>Género</th>
                                <?php endfor ?>
                                <th>Activo</th>
                            </tr>
                        </thead>
                        <span></span>
                        <tbody class="text-sm">
                            <?php foreach ($PerfilSD as $key => $empleado) : ?>
                                <?php 
                                    /* ===================================================
                                       ACTIVO
                                    ===================================================*/
                                    $activo = $empleado['activo'] == "S" ? "<span class='badge badge-success'>Activo</span>" : "<span class='badge badge-danger'>Inactivo</span>";
                                    /* ===================================================
                                       CONSENTIMIENTO
                                    ===================================================*/
                                    $consentimiento = $empleado['consentimiento_informado'] == "S" ? "<span class='badge badge-success'>Si</span>" : "<span class='badge badge-secondary'>No</span>";
                                    /* ===================================================
                                       HIJOS
                                    ===================================================*/
                                    $tdHijos = "";
                                    $contadorHijos = 0;
                                    if (!empty($empleado['hijos'])){
                                        foreach ($empleado['hijos'] as $key2 => $hijo) {
                                            $tdHijos .= "<td>{$hijo['Nombre']}</td>";
                                            $tdHijos .= "<td>{$hijo['fecha_nacimiento']}</td>";
                                            $tdHijos .= "<td>{$hijo['edad']}</td>";
                                            $tdHijos .= "<td>{$hijo['genero']}</td>";
                                            $contadorHijos++;
                                        }
                                    }

                                    // Completar los demas campos vacios
                                    for ($i=$contadorHijos; $i < $CantidadColumnasHijos; $i++) { 
                                        $tdHijos .= "<td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>";
                                    }
                                ?>
                                <tr>
                                    <td><?= $empleado['idPersonal'] ?></td>
                                    <td class="text-lg"><?= $consentimiento ?></td>
                                    <td><?= $empleado['Nombre'] ?></td>
                                    <td><?= $empleado['fecha_ingreso'] ?></td>
                                    <td><?= $empleado['tipo_doc'] ?></td>
                                    <td><?= $empleado['Documento'] ?></td>
                                    <td><?= $empleado['lugarExpedicion'] ?></td>
                                    <td><?= $empleado['fecha_nacimiento'] ?></td>
                                    <td><?= $empleado['lugarNacimiento'] ?></td>
                                    <td><?= $empleado['edad'] ?></td>
                                    <td><?= $empleado['lugarResidencia'] ?></td>
                                    <td><?= $empleado['direccion'] ?></td>
                                    <td><?= $empleado['barrio'] ?></td>
                                    <td><?= $empleado['estrato_social'] ?></td>
                                    <td><?= $empleado['telefono1'] ?></td>
                                    <td><?= $empleado['telefono2'] ?></td>
                                    <td><?= $empleado['correo'] ?></td>
                                    <td><?= $empleado['Eps'] ?></td>
                                    <td><?= $empleado['Afp'] ?></td>
                                    <td><?= $empleado['Arl'] ?></td>
                                    <td><?= $empleado['nivel_escolaridad'] ?></td>
                                    <td><?= $empleado['raza'] ?></td>
                                    <td><?= $empleado['pago_seguridadsocial'] ?></td>
                                    <td><?= $empleado['Cargo'] ?></td>
                                    <td><?= $empleado['turno_trabajo'] ?></td>
                                    <td><?= $empleado['Proceso'] ?></td>
                                    <td><?= $empleado['genero'] ?></td>
                                    <td><?= $empleado['tipo_sangre'] ?></td>
                                    <td><?= $empleado['salario_basico'] ?></td>
                                    <td><?= $empleado['beneficio_fijo'] ?></td>
                                    <td><?= $empleado['bonificacion_variable'] ?></td>
                                    <td><?= $empleado['tipo_contrato'] ?></td>
                                    <td><?= $empleado['tipo_vinculacion'] ?></td>
                                    <td><?= $empleado['antiguedad'] ?></td>
                                    <td><?= $empleado['anios_experiencia'] ?></td>
                                    <td><?= $empleado['tipo_vivienda'] ?></td>
                                    <td><?= $empleado['estado_civil'] ?></td>
                                    <td><?= $empleado['dependientes'] ?></td>
                                    <td><?= $empleado['Ciudad'] ?></td>
                                    <td><?= $empleado['Departamento'] ?></td>
                                    <td><?= $empleado['Sucursal'] ?></td>
                                    <td><?= $empleado['nro_licencia'] ?></td>
                                    <td><?= $empleado['categoria'] ?></td>
                                    <td><?= $empleado['fecha_vencimiento'] ?></td>
                                    <?= $tdHijos ?>
                                    <td class="text-lg"><?= $activo ?></td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div><!-- col -->


            </div> <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->