<?php

// if (!validarPermiso('CARGAR_OPCION', 'R')) {
//     echo "<script> window.location = 'inicio'; </script>";
// }

$empresa = ControladorEmpresa::ctrListaEmpresa();
$proveedores = ControladorProveedores::ctrListarProveedores();
$vehiculos = ControladorVehiculos::ctrListaVehiculos();
?>

<!-- ===================== 
  ORDEN DE COMPRA  
========================= -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark "><b><i></i></b></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                        <li class="breadcrumb-item active">Orden de compra</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">

            <div class="invoice p-3 mb-3">

                <div class="row">
                    <div class="col-12">
                        <h4>
                            <i class="fas fa-dollar-sign"></i><i> <b>Orden de compra</b></i>
                            <small class="float-right"></small>
                        </h4>
                    </div>
                </div>
                <!-- info row -->
                <div class="row invoice-info">
                    <div class="col-sm-4 invoice-col">
                        <address>
                            <?php foreach ($empresa as $key => $value) : ?>
                                <strong><?= $value['razon_social'] ?></strong>
                                <br>
                                <i>NIT: </i><?= $value['nit'] ?>
                                <br>
                                <i>Nro. resolución: </i><?= $value['nro_resolucion'] ?>
                                <br>
                                <i>Año de resolución: </i><?= $value['anio_resolucion'] ?>
                                <br>
                                <i>Dirección territorial: </i><?= $value['dir_territorial'] ?>

                            <?php endforeach ?>

                        </address>
                    </div>
                    <div class="col-md-6">
                        <address>
                            <div>
                                <form id="formulario_orden" method="post" enctype="multipart/form-data">

                                    <div class="form-group">
                                        <label for="proveedor_orden"><i>Proveedor</i></label>
                                        <select id="proveedor_orden" class="form-control select2-single" name="proveedor_orden" type="text">
                                            <option selected value="">-Seleccione un proveedor-</option>
                                            <?php foreach ($proveedores as $key => $value) : ?>
                                                <option value="<?= $value['id'] ?>"><?= $value['razon_social'] ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for=""><i>NIT</i></label>
                                        <input class="form-control" type="text" id="nit_orden" name="nit_orden">
                                    </div>

                                    <div class="row">

                                        <div class="col">

                                            <div class="form-group">
                                                <label for="fecha_orden"><i>Fecha</i></label>
                                                <input class="form-control" type="date" id="fecha_orden" name="fecha_orden">
                                            </div>

                                            <div class="form-group">
                                                <label for=""><i>Cantidad</i></label>
                                                <input class="form-control" type="number" id="nit_orden" name="nit_orden">
                                            </div>

                                            <div class="form-group">
                                                <label for=""><i>Valor unitario</i></label>
                                                <input class="form-control" type="number" id="nit_orden" name="nit_orden">
                                            </div>

                                        </div>

                                        <div class="col">

                                            <div class="form-group">
                                                <label for=""><i>Cliente</i></label></label>
                                                <input class="form-control" type="text" name="">
                                            </div>

                                            <div class="form-group">
                                                <label for="detalle_orden"><i>Detalle</i></label>
                                                <textarea id="detalle_orden" class="form-control" name="detalle_orden" rows="4"></textarea>
                                            </div>

                                        </div>

                                        <div class="col">

                                            <div class="form-group">
                                                <label for=""><i>Placa</i></label>
                                                <div class="input-group">
                                                    <select id="placa_orden" class="form-control select2-single" name="idvehiculo" style="width: 99%">
                                                        <option value="" selected>-Seleccione la placa deseada-</option>
                                                        <?php foreach ($vehiculos as $key => $value) : ?>
                                                            <option value="<?= $value['idvehiculo'] ?>"><?= $value['placa'] ?> - <?= $value['numinterno'] ?></option>
                                                        <?php endforeach ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group no-print">
                                                <label for=""><i>Valor total</i></label>
                                                <input class="form-control" type="number" step="any" id="nit_orden" name="nit_orden">
                                            </div>

                                            <div class="form-group no-print">
                                                <a class="btn btn-app bg-success">
                                                    <i class="fas fa-plus"></i> Añadir Orden
                                                </a>

                                                <a class="btn btn-app bg-info">
                                                    <i class="fas fa-cart-arrow-down"></i> Crear proveedor
                                                </a>
                                            </div>

                                        </div>
                                    </div>
                                </form>

                            </div>

                        </address>

                    </div>                 
                </div>

                <hr class="my-4"> 

                <!-- TABLA DE PRODUCTOS -->
                <div class="row no-print">
                    <div class="col-12 table-responsive">
                        <table class="table table-sm table-bordered table-striped text-center nowrap tablasBtnExport">
                            <thead>
                                <tr>
                                    <th>Qty</th>
                                    <th>Product</th>
                                    <th>Serial #</th>
                                    <th>Description</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Call of Duty</td>
                                    <td>455-981-221</td>
                                    <td>El snort testosterone trophy driving gloves handsome</td>
                                    <td>$64.50</td>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>Need for Speed IV</td>
                                    <td>247-925-726</td>
                                    <td>Wes Anderson umami biodiesel</td>
                                    <td>$50.00</td>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>Monsters DVD</td>
                                    <td>735-845-642</td>
                                    <td>Terry Richardson helvetica tousled street art master</td>
                                    <td>$10.70</td>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>Grown Ups Blue Ray</td>
                                    <td>422-568-642</td>
                                    <td>Tousled lomo letterpress</td>
                                    <td>$25.99</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <hr class="my-5">

                <!-- ESTA FILA NO SE IMPRIME -->
                <div class="row no-print">
                    <div class="col-12">
                        <button rel="noopener" target="_blank" class="btn btn-default btn_print_orden"><i class="fas fa-print"></i> Imprimir</button>
                        <button type="button" class="btn btn-success float-right"><i class="far fa-credit-card"></i> Entregar orden
                        </button>
                        <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                            <i class="fas fa-download"></i> Generar PDF
                        </button>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->