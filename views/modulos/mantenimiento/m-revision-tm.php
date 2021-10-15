
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
                    <h1 class="m-0 text-dark "><b><i>Revisión tecnomecánica</i></b></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                        <li class="breadcrumb-item active">Revisión tecnomecánica</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <div class="content">
        <div class="container-fluid">
            <hr class="my-4">

            <div class="row">
                <div class="col-12">
                    <button type="button" class="btn bg-gradient-success btn-nuevaRevision" data-toggle="modal" data-target="#modal-nuevaRevisiontm"><i class="fas fa-bus"></i> Nuevo</button>
                </div>

                <div class="row mt-2">
                <div class="col-12">
                    <div class="card card-outline card-success">
                        <div class="card-body">
                            <!--|||TABLA PROTOCOLO DE ALISTAMIENTO|||-->
                            <table id="tblAlistamientos" class="table table-responsive table-bordered table-striped text-center w-100">
                                <thead class="text-nowrap text-sm">
                                    <tr>
                                        <th colspan="7">INFORMACIÓN GENERAL</th>
                                        <th colspan="13">SISTEMA DE POTENCIA</th>
                                        <th colspan="13">SISTEMA DE TRANSMISIÓN Y DIFERENCIA</th>
                                        <th colspan="10">SISTEMA MUELLES Y SUSPENSIÓN</th>
                                        <th colspan="10">SISTEMA DE DIRECCIÓN</th>
                                        <th colspan="24">SISTEMA DE FRENOS Y LLANTAS</th>
                                        <th colspan="22">SISTEMA ELÉCTRICO</th>
                                        <th colspan="29">CARROCERIA</th>
                                        <th colspan="31">ACCESORIOS Y OTROS</th>
                                        <th colspan="7">EQUIPO DE PREVENCION Y SEGURIDAD</th>
                                        <th colspan="5">HERRAMIENTA</th>
                                        <th colspan="1">Observación</th>
                                    </tr>

                                    <tr>
                                        <th>...</th>
                                        <th style="min-width:70px;">Placa</th>
                                        <th>Número interno</th>
                                        <th style="min-width:80px;">Modelo</th>
                                        <th>Clase de vehículo</th>
                                        <th>Kilometraje</th>
                                        <th>Seguro obligatorio</th>
                                        <th>Nivel de refrigerante </th>
                                        <th>Nivel de aceite motor</th>
                                        <th>Radiador</th>
                                        <th>Mangueras y conexiones</th>
                                        <th>Correas</th>
                                        <th>Motor</th>
                                        <th>Freno de ahogo</th>
                                        <th>Exosto</th>
                                        <th>Guaya de aceleración</th>
                                        <th>Turbo</th>
                                        <th>Tapa de radiador</th>
                                        <th>Fuga de aceite</th>
                                        <th>Fuga de combustible</th>
                                        <th>Nivel de aceite transmisión</th>
                                        <th>Transmisión</th>
                                        <th>Tapon drenaje de transmisión</th>
                                        <th>Revision sistema palanca de cambios</th>
                                        <th>Embrague</th>
                                        <th>Caucho pedal embrague</th>
                                        <th>Cruceta de cardan</th>
                                        <th>Cojinete intermedio de cardan</th>
                                        <th>Cadena de cardan</th>
                                        <th>Nivel de aceite diferencial</th>
                                        <th>Tapón drenaje de dierencial</th>
                                        <th>Fuga de aceite de transmisión</th>
                                        <th>Fuga de aceite diferencial</th>
                                        <th>Muelle delantero derecho</th>
                                        <th>Amortiguador delantero derecho</th>
                                        <th>Muelle delantero izquierdo</th>
                                        <th>Amortiguador delantero izquierdo</th>
                                        <th>Muelle trasero derecho</th>
                                        <th>Amortiguador trasero derecho</th>
                                        <th>Muelle trasero izquierdo</th>
                                        <th>Amortiguador trasero izquierdo</th>
                                        <th>Barra estabilizadora</th>
                                        <th>Grapas y tornillo pasador central</th>
                                        <th>Nivel de aceite hidráulico</th>
                                        <th>Mangueras y lineas</th>
                                        <th>Brazo pitman</th>
                                        <th>Barra entre ejes</th>
                                        <th>Tijeras</th>
                                        <th>Splinders</th>
                                        <th>Timón</th>
                                        <th>Cajas de dirección</th>
                                        <th>Cruceta de dirección</th>
                                        <th>Fugas caja de dirección</th>
                                        <th>Nivel de fluido</th>
                                        <th>Mangueras y tuberias</th>
                                        <th>Freno de parqueo</th>
                                        <th>Frenos</th>
                                        <th>Pedal de freno</th>
                                        <th>Compresor</th>
                                        <th>Fugas de aire</th>
                                        <th>Bandas delantera derecha</th>
                                        <th>Bandas delantera izquierda</th>
                                        <th>Bandas trasera derecha</th>
                                        <th>Bandas trasera izquierda</th>
                                        <th>Rachets</th>
                                        <th>Discos delanteros</th>
                                        <th>Discos traseros</th>
                                        <th>Pastillas de freno</th>
                                        <th>Rines</th>
                                        <th>Llantas R1</th>
                                        <th>Llantas R2</th>
                                        <th>Llantas R3</th>
                                        <th>Llantas R4</th>
                                        <th>Llantas R5</th>
                                        <th>Llantas R6</th>
                                        <th>Llanta de repuesto</th>
                                        <th>Chequeo tanques de aire</th>
                                        <th>Luces altas</th>
                                        <th>Luces bajas</th>
                                        <th>Luces direccionales</th>
                                        <th>Luces estacionarias</th>
                                        <th>Luces laterales</th>
                                        <th>Luces de reversa</th>
                                        <th>Luces internas</th>
                                        <th>Luces delimitadoras</th>
                                        <th>Alarma de reversa</th>
                                        <th>Motor de arranque</th>
                                        <th>Alternador</th>
                                        <th>Baterias</th>
                                        <th>Pito</th>
                                        <th>Rutero</th>
                                        <th>Cables y conexiones</th>
                                        <th>Fusibles</th>
                                        <th>Presión de aceite motor</th>
                                        <th>Temperatura motor</th>
                                        <th>Velocímetro</th>
                                        <th>Nivel de combustible</th>
                                        <th>Presión de aire</th>
                                        <th>Carga de batería</th>
                                        <th>Techo exterior</th>
                                        <th>Techo interior</th>
                                        <th>Bomper delantero</th>
                                        <th>Bomper trasero</th>
                                        <th>Frente</th>
                                        <th>Lamina lateral derecho</th>
                                        <th>Lamina lateral izquierdo</th>
                                        <th>Estado de puerta principal</th>
                                        <th>Estado de puerta lateral</th>
                                        <th>Estribos de puertas</th>
                                        <th>Sillas</th>
                                        <th>Descansabrazos</th>
                                        <th>Bocallanta</th>
                                        <th>Guardapolvos</th>
                                        <th>Piso</th>
                                        <th>Parabrisas derecho</th>
                                        <th>Brazo limpiaparabrizas derecho</th>
                                        <th>Plumillas limpiaparabrizas derecho</th>
                                        <th>Parabrisas izquierdo</th>
                                        <th>Brazo limpiaparabrizas izquierdo</th>
                                        <th>Plumillas limpiaparabrizas izquierdo</th>
                                        <th>Espejo retrovisor derecho</th>
                                        <th>Espejo retrovisor izquierdo</th>
                                        <th>Espejo central</th>
                                        <th>Ventanas laterales lado derecho</th>
                                        <th>Ventanas laterales lado izquierdo</th>
                                        <th>Parabrisas trasero</th>
                                        <th>Vidrios de puerta principal</th>
                                        <th>Vidrios de segunda puerta</th>
                                        <th>Manijas ventanas</th>
                                        <th>Claraboyas</th>
                                        <th>Airbag</th>
                                        <th>Aire acondicionado</th>
                                        <th>Limpieza</th>
                                        <th>Chapas de puertas</th>
                                        <th>Parales</th>
                                        <th>Booster de puertas</th>
                                        <th>Relog vigia</th>
                                        <th>Vigia rueda delantera derecha</th>
                                        <th>Vigia rueda delantera izquierda</th>
                                        <th>Vigia rueda trasera derecha</th>
                                        <th>Vigia rueda trasera izquierda</th>
                                        <th>Tapa motor</th>
                                        <th>Tapa bodegas</th>
                                        <th>Parasol</th>
                                        <th>Cenefas</th>
                                        <th>Emblema izquierdo empresa</th>
                                        <th>Emblema derecho empresa</th>
                                        <th>Emblema trasero empresa</th>
                                        <th>Equipo de audio</th>
                                        <th>Parlantes</th>
                                        <th>Cinturon sillas usuario</th>
                                        <th>Martillos salida de emergencia</th>
                                        <th>Dispositivo de velocidad</th>
                                        <th>Avisos</th>
                                        <th>Placa trasera</th>
                                        <th>Placa delantera</th>
                                        <th>Placa lateral derecha</th>
                                        <th>Placa lateral izquierda</th>
                                        <th>Balizas</th>
                                        <th>Cinturón</th>
                                        <th>Gato</th>
                                        <th>Cruceta o copa</th>
                                        <th>Señales de carretera</th>
                                        <th>Botiquin</th>
                                        <th>Extintor</th>
                                        <th>2 Tacos</th>
                                        <th>Alicate</th>
                                        <th>Destornilladores</th>
                                        <th>Llaves de expansión</th>
                                        <th>Llaves fijas</th>
                                        <th>Linterna con pila</th>
                                        <th></th>
                                        
                                    </tr>

                                </thead>


                                <tbody id="tbodyRevisionTM" class="text-sm">

                                   
                            </table>
                        </div>
                    </div>
                </div>
            </div>


            </div>
        </div>

        <!-- MODAL NUEVA REVISIÓN TECNOMECÁNICA -->

        <div class="modal" id="modal-nuevaRevisiontm" style="display: none; padding-right: 17px;" aria-modal="true" role="dialog" >
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header bg-info">
                        <h4 class="modal-title">Nueva revisión tecnomecánica <span id="TituloModal"></span></h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                    </div>

                    <div class="modal-body">
                        <div class="card card-secondary card-tabs">
                            <div class="card-header p-0 pt-1">
                                <ul class="nav nav-tabs" id="custom-tabs-two-tab" role="tablist">

                                    <li class="nav-item">
                                        <a class="nav-link active" id="documentos" data-toggle="pill" href="#custom-tabs-two-home" role="tab" aria-controls="custom-tabs-two-home" aria-selected="true"><u>Documentos</u></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="sistema_potencia" data-toggle="pill" href="#custom-tabs-two-sistema-potencia" role="tab" aria-controls="custom-tabs-two-sistema-potencia" aria-selected="false"><u>Sistema potencia</u></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="sistema_transmision" data-toggle="pill" href="#custom-tabs-two-sistema-transmision" role="tab" aria-controls="custom-tabs-two-sistema-transmision" aria-selected="false"><u>Sistema de transmisión y diferencial</u></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="sistema_muelles" data-toggle="pill" href="#custom-tabs-two-sistema-muelles" role="tab" aria-controls="custom-tabs-two-sistema-muelles" aria-selected="false"><u>Sistemas muelles y suspensión</u></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="sistema_direccion" data-toggle="pill" href="#custom-tabs-two-sistema-direccion" role="tab" aria-controls="custom-tabs-two-sistema-direccion" aria-selected="false"><u>Sistema dirección</u></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="sistema_frenos" data-toggle="pill" href="#custom-tabs-two-sistema-frenos" role="tab" aria-controls="custom-tabs-two-sistema-frenos" aria-selected="false"><u>Sisema de frenos y llantas</u></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="sistema_electrico" data-toggle="pill" href="#custom-tabs-two-sistema-electrico" role="tab" aria-controls="custom-tabs-two-sistema-electrico" aria-selected="false"><u>Sistema eléctrico</u></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="carroceria" data-toggle="pill" href="#custom-tabs-two-carroceria" role="tab" aria-controls="custom-tabs-two-carroceria" aria-selected="false"><u>Carroceria</u></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="accesorios" data-toggle="pill" href="#custom-tabs-two-accesorios" role="tab" aria-controls="custom-tabs-two-accesorios" aria-selected="false"><u>Accesorios y otros</u></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="equipo_seguridad" data-toggle="pill" href="#custom-tabs-two-seguridad" role="tab" aria-controls="custom-tabs-two-seguridad" aria-selected="false"><u>Equipo de prevención y seguridad</u></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="herramienta" data-toggle="pill" href="#custom-tabs-two-herramienta" role="tab" aria-controls="custom-tabs-two-herramienta" aria-selected="false"><u>Herramienta</u></a>
                                    </li>
                                </ul>
                            </div>

                            <div class="card-body">
                                <div class="row">
                                <!--==============================
                                    FORMULARIO
                                =================================  -->
                                <div class="col-12">
                                    <form id="revisiontm_form" method="post" enctype="multipart/form-data">
                                        <div class="tab-content" id="custom-tabs-two-tabContent">
                                            <!-- TAB DE DOCUMENTO -->
                                            <div class="tab-pane fade show active" id="custom-tabs-two-home" role="tabpanel" aria-labelledby="custom-tabs-two-home-tab">
                                                <div class="row">

                                                    <div class="col-12 col-sm-6 col-lg-4">
                                                        <div class="form-group">
                                                            <label>Placa</label>
                                                            <select id="placa" name="placa" class="form-control select2-single" type="number" style="width: 99%" required>
                                                                <option value="" selected>-Seleccione un vehículo</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 col-sm-6 col-lg-4">
                                                        <div class="form-group">
                                                            <label>Numero interno</label>
                                                            <input id="numinterno" name="numinterno" type="text" class="form-control datosVehiculo" readonly>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 col-sm-6 col-lg-4">
                                                        <div class="form-group">
                                                            <label>Marca</label>
                                                            <input id="marca" name="marca" type="text" class="form-control datosVehiculo" readonly>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 col-sm-6 col-lg-4">
                                                        <div class="form-group">
                                                            <label>Modelo</label>
                                                            <input id="modelo" name="modelo" type="text" class="form-control datosVehiculo" readonly>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 col-sm-6 col-lg-4">
                                                        <div class="form-group">
                                                            <label>Clase de vehículo</label>
                                                            <input id="tipo_vehiculo" name="tipo_vehiculo" type="text" class="form-control datosVehiculo" readonly>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 col-sm-6 col-lg-4">
                                                        <div class="form-group">
                                                            <label>Kilometraje</label>
                                                            <input id="kilometraje" name="kilometraje" type="text" class="form-control datosVehiculo" readonly>
                                                        </div>
                                                    </div>



                                                    <div class="col-12 col-sm-6 col-lg-4">
                                                        <div class="form-group">
                                                            <label>Tarjeta de operación</label>
                                                            <input id="tarjeta_operacion" name="tarjeta_operacion" type="text" class="form-control datosVehiculo" readonly>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 col-sm-6 col-lg-4">
                                                        <div class="form-group">
                                                            <label>Tarjeta de propiedad</label>
                                                            <input id="tarjeta_propiedad" name="tarjeta_propiedad" type="text" class="form-control datosVehiculo" readonly>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 col-sm-6 col-lg-4">
                                                        <div class="form-group">
                                                            <label>SOAT</label>
                                                            <input id="soat" name="soat" type="text" class="form-control datosVehiculo" readonly>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 col-sm-6 col-lg-4">
                                                        <div class="form-group">
                                                            <label>Poliza contractual - extracontractual</label>
                                                            <input id="poliza" name="poliza" type="text" class="form-control datosVehiculo" readonly>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 col-sm-6 col-lg-4">
                                                        <div class="form-group">
                                                            <label>Certificado revisión tecnomecánica</label>
                                                            <input id="certificadotm" name="certificadotm" type="text" class="form-control datosVehiculo" readonly>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 col-sm-6 col-lg-4">
                                                        <div class="form-group">
                                                            <label>Licencia de conducción</label>
                                                            <input id="soat" name="soat" type="text" class="form-control datosVehiculo" readonly>
                                                        </div>
                                                    </div>

                                                    


                                                </div>
                                            </div>

                                            <!-- TAB SISTEMA POTENCIA -->
                                            <div class="tab-pane fade show " id="custom-tabs-two-sistema-potencia" role="tabpanel" aria-labelledby="custom-tabs-two-sistema-potencia">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered text-center border-danger" nombre = "Sistema potencia">
                                                    <thead class="text-nowrap">
                                                        <tr>
                                                            <th>Nivel refrigerante</th>
                                                            <th>Nivel aceite motor</th>
                                                            <th>Radiador</th>
                                                            <th>Mangueras y conexiones</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody class="text-nowrap">
                                                        <tr>
                                                            <td>
                                                                <div class="form-group clearfix">
                                                                    <div class="icheck-success d-inline">
                                                                        <input type="radio" id="radionivelrefrigerante1" name="nivelrefrigerante" value="1" required>
                                                                        <label for="radionivelrefrigerante1">
                                                                            <i class="fas fa-thumbs-up"></i>
                                                                        </label>
                                                                    </div>

                                                                    <div class="icheck-danger d-inline">
                                                                        <input type="radio" id="radionivelrefrigerante2" name="nivelrefrigerante" value="0" required>
                                                                        <label for="radionivelrefrigerante2">
                                                                            <i class="fas fa-thumbs-down"></i>
                                                                        </label>
                                                                    </div>
                                                                    <div class="icheck-warning d-inline">
                                                                        <input type="radio" id="radionivelrefrigerante3" name="nivelrefrigerante" value="2" required>
                                                                        <label for="radionivelrefrigerante3">
                                                                            <i class="fas fa-ban"></i>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group clearfix">
                                                                    <div class="icheck-success d-inline">
                                                                        <input type="radio" id="radionivelaceite1" name="nivelaceite" value="1" required>
                                                                        <label for="radionivelaceite1">
                                                                            <i class="fas fa-thumbs-up"></i>
                                                                        </label>
                                                                    </div>

                                                                    <div class="icheck-danger d-inline">
                                                                        <input type="radio" id="radionivelaceite2" name="nivelaceite" value="0" required>
                                                                        <label for="radionivelaceite2">
                                                                            <i class="fas fa-thumbs-down"></i>
                                                                        </label>
                                                                    </div>

                                                                    <div class="icheck-warning d-inline">
                                                                        <input type="radio" id="radionivelaceite3" name="nivelaceite" value="2" required>
                                                                        <label for="radionivelaceite3">
                                                                            <i class="fas fa-ban"></i>
                                                                        </label>
                                                                    </div>
                                                                    
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group clearfix">
                                                                    <div class="icheck-success d-inline">
                                                                        <input type="radio" id="radioradiador1" name="radiador" value="1" required>
                                                                        <label for="radioradiador1">
                                                                            <i class="fas fa-thumbs-up"></i>
                                                                        </label>
                                                                    </div>

                                                                    <div class="icheck-danger d-inline">
                                                                        <input type="radio" id="radioradiador2" name="radiador" value="0" required>
                                                                        <label for="radionradiador2">
                                                                            <i class="fas fa-thumbs-down"></i>
                                                                        </label>
                                                                    </div>
                                                                    <div class="icheck-warning d-inline">
                                                                        <input type="radio" id="radionivelradiador3" name="nivelradiador" value="2" required>
                                                                        <label for="radionivelradiador3">
                                                                            <i class="fas fa-ban"></i>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            <td>
                                                                <div class="form-group clearfix">
                                                                    <div class="icheck-success d-inline">
                                                                        <input type="radio" id="radioMangueras1" name="Mangueras" value="1" required>
                                                                        <label for="radioMangueras1">
                                                                            <i class="fas fa-thumbs-up"></i>
                                                                        </label>
                                                                    </div>

                                                                    <div class="icheck-danger d-inline">
                                                                        <input type="radio" id="radioMangueras2" name="Mangueras" value="0" required>
                                                                        <label for="radionMangueras2">
                                                                            <i class="fas fa-thumbs-down"></i>
                                                                        </label>
                                                                    </div>
                                                                    <div class="icheck-warning d-inline">
                                                                        <input type="radio" id="radioMangueras3" name="Mangueras" value="2" required>
                                                                        <label for="radioMangueras3">
                                                                            <i class="fas fa-ban"></i>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr class="font-weight-bold">
                                                            <td>Correas</td>
                                                            <td>Motor</td>
                                                            <td>Freno de ahogo</td>
                                                            <td>Exosto</td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <div class="form-group clearfix">
                                                                    <div class="icheck-success d-inline">
                                                                        <input type="radio" id="radiocorreas1" name="correas" value="1" required>
                                                                        <label for="radiocorreas1">
                                                                            <i class="fas fa-thumbs-up"></i>
                                                                        </label>
                                                                    </div>

                                                                    <div class="icheck-danger d-inline">
                                                                        <input type="radio" id="radiocorreas2" name="correas" value="0" required>
                                                                        <label for="radiocorreas2">
                                                                            <i class="fas fa-thumbs-down"></i>
                                                                        </label>
                                                                    </div>
                                                                    <div class="icheck-warning d-inline">
                                                                        <input type="radio" id="radiocorreas3" name="correas" value="2" required>
                                                                        <label for="radiocorreas3">
                                                                            <i class="fas fa-ban"></i>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group clearfix">
                                                                    <div class="icheck-success d-inline">
                                                                        <input type="radio" id="radiomotor1" name="motor" value="1" required>
                                                                        <label for="radiomotor1">
                                                                            <i class="fas fa-thumbs-up"></i>
                                                                        </label>
                                                                    </div>

                                                                    <div class="icheck-danger d-inline">
                                                                        <input type="radio" id="radiomotor2" name="motor" value="0" required>
                                                                        <label for="radiomotor2">
                                                                            <i class="fas fa-thumbs-down"></i>
                                                                        </label>
                                                                    </div>
                                                                    <div class="icheck-warning d-inline">
                                                                        <input type="radio" id="radiomotor3" name="motor" value="2" required>
                                                                        <label for="radiomotor3">
                                                                            <i class="fas fa-ban"></i>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group clearfix">
                                                                    <div class="icheck-success d-inline">
                                                                        <input type="radio" id="radiofreno_ahogo1" name="freno_ahogo" value="1" required>
                                                                        <label for="radiofreno_ahogo1">
                                                                            <i class="fas fa-thumbs-up"></i>
                                                                        </label>
                                                                    </div>

                                                                    <div class="icheck-danger d-inline">
                                                                        <input type="radio" id="radiofreno_ahogo2" name="freno_ahogo" value="0" required>
                                                                        <label for="radiofreno_ahogo2">
                                                                            <i class="fas fa-thumbs-down"></i>
                                                                        </label>
                                                                    </div>
                                                                    <div class="icheck-warning d-inline">
                                                                        <input type="radio" id="radiofreno_ahogo3" name="freno_ahogo" value="2" required>
                                                                        <label for="radiofreno_ahogo3">
                                                                            <i class="fas fa-ban"></i>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group clearfix">
                                                                    <div class="icheck-success d-inline">
                                                                        <input type="radio" id="radioexosto1" name="exosto" value="1" required>
                                                                        <label for="radioexosto1">
                                                                            <i class="fas fa-thumbs-up"></i>
                                                                        </label>
                                                                    </div>

                                                                    <div class="icheck-danger d-inline">
                                                                        <input type="radio" id="radioexosto2" name="exosto" value="0" required>
                                                                        <label for="radioexosto2">
                                                                            <i class="fas fa-thumbs-down"></i>
                                                                        </label>
                                                                    </div>
                                                                    <div class="icheck-warning d-inline">
                                                                        <input type="radio" id="radioexosto3" name="exosto" value="2" required>
                                                                        <label for="radioexosto3">
                                                                            <i class="fas fa-ban"></i>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr class="font-weight-bold">
                                                            <td>Guaya de aceleración</td>
                                                            <td>Turbo</td>
                                                            <td>Tapa de radiador</td>
                                                            <td>Fuga de aceite</td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <div class="form-group clearfix">
                                                                    <div class="icheck-success d-inline">
                                                                        <input type="radio" id="radioguaya1" name="guaya" value="1" required>
                                                                        <label for="radioguaya1">
                                                                            <i class="fas fa-thumbs-up"></i>
                                                                        </label>
                                                                    </div>

                                                                    <div class="icheck-danger d-inline">
                                                                        <input type="radio" id="radioguaya2" name="guaya" value="0" required>
                                                                        <label for="radioguaya2">
                                                                            <i class="fas fa-thumbs-down"></i>
                                                                        </label>
                                                                    </div>
                                                                    <div class="icheck-warning d-inline">
                                                                        <input type="radio" id="radioguaya3" name="guaya" value="2" required>
                                                                        <label for="radioguaya3">
                                                                            <i class="fas fa-ban"></i>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group clearfix">
                                                                    <div class="icheck-success d-inline">
                                                                        <input type="radio" id="radioturbo1" name="turbo" value="1" required>
                                                                        <label for="radioturbo1">
                                                                            <i class="fas fa-thumbs-up"></i>
                                                                        </label>
                                                                    </div>

                                                                    <div class="icheck-danger d-inline">
                                                                        <input type="radio" id="radioturbo2" name="turbo" value="0" required>
                                                                        <label for="radioturbo2">
                                                                            <i class="fas fa-thumbs-down"></i>
                                                                        </label>
                                                                    </div>
                                                                    <div class="icheck-warning d-inline">
                                                                        <input type="radio" id="radioturbo3" name="turbo" value="2" required>
                                                                        <label for="radioturbo3">
                                                                            <i class="fas fa-ban"></i>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group clearfix">
                                                                    <div class="icheck-success d-inline">
                                                                        <input type="radio" id="radiotapa_radiador1" name="tapa_radiador" value="1" required>
                                                                        <label for="radiotapa_radiador1">
                                                                            <i class="fas fa-thumbs-up"></i>
                                                                        </label>
                                                                    </div>

                                                                    <div class="icheck-danger d-inline">
                                                                        <input type="radio" id="radiotapa_radiador2" name="tapa_radiador" value="0" required>
                                                                        <label for="radiotapa_radiador2">
                                                                            <i class="fas fa-thumbs-down"></i>
                                                                        </label>
                                                                    </div>
                                                                    <div class="icheck-warning d-inline">
                                                                        <input type="radio" id="radiotapa_radiador3" name="tapa_radiador" value="2" required>
                                                                        <label for="radiotapa_radiador3">
                                                                            <i class="fas fa-ban"></i>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group clearfix">
                                                                    <div class="icheck-success d-inline">
                                                                        <input type="radio" id="radiofuga_aceite1" name="fuga_aceite" value="1" required>
                                                                        <label for="radiofuga_aceite1">
                                                                            <i class="fas fa-thumbs-up"></i>
                                                                        </label>
                                                                    </div>

                                                                    <div class="icheck-danger d-inline">
                                                                        <input type="radio" id="radiofuga_aceite2" name="fuga_aceite" value="0" required>
                                                                        <label for="radiofuga_aceite2">
                                                                            <i class="fas fa-thumbs-down"></i>
                                                                        </label>
                                                                    </div>
                                                                    <div class="icheck-warning d-inline">
                                                                        <input type="radio" id="radiofuga_aceite3" name="fuga_aceite" value="2" required>
                                                                        <label for="radiofuga_aceite3">
                                                                            <i class="fas fa-ban"></i>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr class="font-weight-bold">
                                                            <td>Fuga de combustible</td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <div class="form-group clearfix">
                                                                    <div class="icheck-success d-inline">
                                                                        <input type="radio" id="radiofuga_combustible1" name="fuga_combustible" value="1" required>
                                                                        <label for="radiofuga_combustible1">
                                                                            <i class="fas fa-thumbs-up"></i>
                                                                        </label>
                                                                    </div>

                                                                    <div class="icheck-danger d-inline">
                                                                        <input type="radio" id="radiofuga_combustible2" name="fuga_combustible" value="0" required>
                                                                        <label for="radiofuga_combustible2">
                                                                            <i class="fas fa-thumbs-down"></i>
                                                                        </label>
                                                                    </div>
                                                                    <div class="icheck-warning d-inline">
                                                                        <input type="radio" id="radiofuga_combustible3" name="fuga_combustible" value="2" required>
                                                                        <label for="radiofuga_combustible3">
                                                                            <i class="fas fa-ban"></i>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </tbody>

                                                    </table>
                                                </div>
                                            </div>

                                            <!-- TAB SISTEMA TRANSMISIÓN DIGITAL -->
                                            <div class="tab-pane fade show" id="custom-tabs-two-sistema-transmision" role="tabpanel" aria-labelledby="custom-tabs-two-sistema-transmision">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered text-center border-danger" nombre = "Sistema potencia">
                                                        <thead class="text-nowrap">
                                                            <tr class="font-weight-bold">
                                                                <th>Nivel de aceite transmisión</th>
                                                                <th>Transmisión</th>
                                                                <th>Tapón drenaje transmisión</th>
                                                                <th>Revisión sistema palanca de cambios</th>
                                                            </tr>
                                                        </thead>

                                                        <tr>
                                                            <td>
                                                                <div class="form-group clearfix">
                                                                    <div class="icheck-success d-inline">
                                                                        <input type="radio" id="radionivel_aceite_transmision1" name="nivel_aceite_transmision" value="1" required>
                                                                        <label for="radionivel_aceite_transmision1">
                                                                            <i class="fas fa-thumbs-up"></i>
                                                                        </label>
                                                                    </div>

                                                                    <div class="icheck-danger d-inline">
                                                                        <input type="radio" id="radionivel_aceite_transmision2" name="nivel_aceite_transmision" value="0" required>
                                                                        <label for="radionivel_aceite_transmision2">
                                                                            <i class="fas fa-thumbs-down"></i>
                                                                        </label>
                                                                    </div>
                                                                    <div class="icheck-warning d-inline">
                                                                        <input type="radio" id="radionivel_aceite_transmision3" name="nivel_aceite_transmision" value="2" required>
                                                                        <label for="radionivel_aceite_transmision3">
                                                                            <i class="fas fa-ban"></i>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group clearfix">
                                                                    <div class="icheck-success d-inline">
                                                                        <input type="radio" id="radiotransmision1" name="transmision" value="1" required>
                                                                        <label for="radiotransmision1">
                                                                            <i class="fas fa-thumbs-up"></i>
                                                                        </label>
                                                                    </div>

                                                                    <div class="icheck-danger d-inline">
                                                                        <input type="radio" id="radiotransmision2" name="transmision" value="0" required>
                                                                        <label for="radiotransmision2">
                                                                            <i class="fas fa-thumbs-down"></i>
                                                                        </label>
                                                                    </div>
                                                                    <div class="icheck-warning d-inline">
                                                                        <input type="radio" id="radiotransmision3" name="transmision" value="2" required>
                                                                        <label for="radiotransmision3">
                                                                            <i class="fas fa-ban"></i>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group clearfix">
                                                                    <div class="icheck-success d-inline">
                                                                        <input type="radio" id="radiotapon_transmision1" name="tapon_transmision" value="1" required>
                                                                        <label for="radiotapon_transmision1">
                                                                            <i class="fas fa-thumbs-up"></i>
                                                                        </label>
                                                                    </div>

                                                                    <div class="icheck-danger d-inline">
                                                                        <input type="radio" id="radiotapon_transmision2" name="tapon_transmision" value="0" required>
                                                                        <label for="radiotapon_transmision2">
                                                                            <i class="fas fa-thumbs-down"></i>
                                                                        </label>
                                                                    </div>
                                                                    <div class="icheck-warning d-inline">
                                                                        <input type="radio" id="radiotapon_transmision3" name="tapon_transmision" value="2" required>
                                                                        <label for="radiotapon_transmision3">
                                                                            <i class="fas fa-ban"></i>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group clearfix">
                                                                    <div class="icheck-success d-inline">
                                                                        <input type="radio" id="radiopalanca_cambios1" name="palanca_cambios" value="1" required>
                                                                        <label for="radiopalanca_cambios1">
                                                                            <i class="fas fa-thumbs-up"></i>
                                                                        </label>
                                                                    </div>

                                                                    <div class="icheck-danger d-inline">
                                                                        <input type="radio" id="radiopalanca_cambios2" name="palanca_cambios" value="0" required>
                                                                        <label for="radiopalanca_cambios2">
                                                                            <i class="fas fa-thumbs-down"></i>
                                                                        </label>
                                                                    </div>
                                                                    <div class="icheck-warning d-inline">
                                                                        <input type="radio" id="radiopalanca_cambios3" name="palanca_cambios" value="2" required>
                                                                        <label for="radiopalanca_cambios3">
                                                                            <i class="fas fa-ban"></i>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>

                                                        <tbody class="text-nowrap">
                                                            
                                                            <tr class="font-weight-bold">
                                                                <th>Embrague</th>
                                                                <th>Caucho pedal embrague</th>
                                                                <th>Cruceta de cardan</th>
                                                                <th>Cojinete intermedio de cardan</th>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <div class="form-group clearfix">
                                                                        <div class="icheck-success d-inline">
                                                                            <input type="radio" id="radioembrague1" name="embrague" value="1" required>
                                                                            <label for="radioembrague1">
                                                                                <i class="fas fa-thumbs-up"></i>
                                                                            </label>
                                                                        </div>

                                                                        <div class="icheck-danger d-inline">
                                                                            <input type="radio" id="radioembrague2" name="embrague" value="0" required>
                                                                            <label for="radioembrague2">
                                                                                <i class="fas fa-thumbs-down"></i>
                                                                            </label>
                                                                        </div>
                                                                        <div class="icheck-warning d-inline">
                                                                            <input type="radio" id="radioembrague3" name="embrague" value="2" required>
                                                                            <label for="radioembrague3">
                                                                                <i class="fas fa-ban"></i>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-group clearfix">
                                                                        <div class="icheck-success d-inline">
                                                                            <input type="radio" id="radiopedal_embrague1" name="pedal_embrague" value="1" required>
                                                                            <label for="radiopedal_embrague1">
                                                                                <i class="fas fa-thumbs-up"></i>
                                                                            </label>
                                                                        </div>

                                                                        <div class="icheck-danger d-inline">
                                                                            <input type="radio" id="radiopedal_embrague2" name="pedal_embrague" value="0" required>
                                                                            <label for="radiopedal_embrague2">
                                                                                <i class="fas fa-thumbs-down"></i>
                                                                            </label>
                                                                        </div>
                                                                        <div class="icheck-warning d-inline">
                                                                            <input type="radio" id="radiopedal_embrague3" name="pedal_embrague" value="2" required>
                                                                            <label for="radiopedal_embrague3">
                                                                                <i class="fas fa-ban"></i>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-group clearfix">
                                                                        <div class="icheck-success d-inline">
                                                                            <input type="radio" id="radiocruceta_cardan1" name="cruceta_cardan" value="1" required>
                                                                            <label for="radiocruceta_cardan1">
                                                                                <i class="fas fa-thumbs-up"></i>
                                                                            </label>
                                                                        </div>

                                                                        <div class="icheck-danger d-inline">
                                                                            <input type="radio" id="radiocruceta_cardan2" name="cruceta_cardan" value="0" required>
                                                                            <label for="radiocruceta_cardan2">
                                                                                <i class="fas fa-thumbs-down"></i>
                                                                            </label>
                                                                        </div>
                                                                        <div class="icheck-warning d-inline">
                                                                            <input type="radio" id="radiocruceta_cardan3" name="cruceta_cardan" value="2" required>
                                                                            <label for="radiocruceta_cardan3">
                                                                                <i class="fas fa-ban"></i>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-group clearfix">
                                                                        <div class="icheck-success d-inline">
                                                                            <input type="radio" id="radiocojinete_cardam1" name="cojinete_cardam" value="1" required>
                                                                            <label for="radiocojinete_cardam1">
                                                                                <i class="fas fa-thumbs-up"></i>
                                                                            </label>
                                                                        </div>

                                                                        <div class="icheck-danger d-inline">
                                                                            <input type="radio" id="radiocojinete_cardam2" name="cojinete_cardam" value="0" required>
                                                                            <label for="radiocojinete_cardam2">
                                                                                <i class="fas fa-thumbs-down"></i>
                                                                            </label>
                                                                        </div>
                                                                        <div class="icheck-warning d-inline">
                                                                            <input type="radio" id="radiocojinete_cardam3" name="cojinete_cardam" value="2" required>
                                                                            <label for="radiocojinete_cardam3">
                                                                                <i class="fas fa-ban"></i>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr class="font-weight-bold">
                                                                <th>Cadena de cardan</th>
                                                                <th>Nivel de aceite diferencial</th>
                                                                <th>Tapón drenaje diferencial</th>
                                                                <th>Fuga de aceite transmisión</th>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <div class="form-group clearfix">
                                                                        <div class="icheck-success d-inline">
                                                                            <input type="radio" id="radiocadena_cardan1" name="cadena_cardan" value="1" required>
                                                                            <label for="radiocadena_cardan1">
                                                                                <i class="fas fa-thumbs-up"></i>
                                                                            </label>
                                                                        </div>

                                                                        <div class="icheck-danger d-inline">
                                                                            <input type="radio" id="radiocadena_cardan2" name="cadena_cardan" value="0" required>
                                                                            <label for="radiocadena_cardan2">
                                                                                <i class="fas fa-thumbs-down"></i>
                                                                            </label>
                                                                        </div>
                                                                        <div class="icheck-warning d-inline">
                                                                            <input type="radio" id="radiocadena_cardan3" name="cadena_cardan" value="2" required>
                                                                            <label for="radiocadena_cardan3">
                                                                                <i class="fas fa-ban"></i>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                <div class="form-group clearfix">
                                                                        <div class="icheck-success d-inline">
                                                                            <input type="radio" id="radioaceite_diferencial1" name="aceite_diferencial" value="1" required>
                                                                            <label for="radioaceite_diferencial1">
                                                                                <i class="fas fa-thumbs-up"></i>
                                                                            </label>
                                                                        </div>

                                                                        <div class="icheck-danger d-inline">
                                                                            <input type="radio" id="radioaceite_diferencial2" name="aceite_diferencial" value="0" required>
                                                                            <label for="radioaceite_diferencial2">
                                                                                <i class="fas fa-thumbs-down"></i>
                                                                            </label>
                                                                        </div>
                                                                        <div class="icheck-warning d-inline">
                                                                            <input type="radio" id="radioaceite_diferencial3" name="aceite_diferencial" value="2" required>
                                                                            <label for="radioaceite_diferencial3">
                                                                                <i class="fas fa-ban"></i>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                <div class="form-group clearfix">
                                                                        <div class="icheck-success d-inline">
                                                                            <input type="radio" id="radiodrenaje_diferencial1" name="drenaje_diferencial" value="1" required>
                                                                            <label for="radiodrenaje_diferencial1">
                                                                                <i class="fas fa-thumbs-up"></i>
                                                                            </label>
                                                                        </div>

                                                                        <div class="icheck-danger d-inline">
                                                                            <input type="radio" id="radiodrenaje_diferencial2" name="drenaje_diferencial" value="0" required>
                                                                            <label for="radiodrenaje_diferencial2">
                                                                                <i class="fas fa-thumbs-down"></i>
                                                                            </label>
                                                                        </div>
                                                                        <div class="icheck-warning d-inline">
                                                                            <input type="radio" id="radiodrenaje_diferencial3" name="drenaje_diferencial" value="2" required>
                                                                            <label for="radiodrenaje_diferencial3">
                                                                                <i class="fas fa-ban"></i>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                <div class="form-group clearfix">
                                                                        <div class="icheck-success d-inline">
                                                                            <input type="radio" id="radiofuga_transmision1" name="fuga_transmision" value="1" required>
                                                                            <label for="radiofuga_transmision1">
                                                                                <i class="fas fa-thumbs-up"></i>
                                                                            </label>
                                                                        </div>

                                                                        <div class="icheck-danger d-inline">
                                                                            <input type="radio" id="radiofuga_transmision2" name="fuga_transmision" value="0" required>
                                                                            <label for="radiofuga_transmision2">
                                                                                <i class="fas fa-thumbs-down"></i>
                                                                            </label>
                                                                        </div>
                                                                        <div class="icheck-warning d-inline">
                                                                            <input type="radio" id="radiofuga_transmision3" name="fuga_transmision" value="2" required>
                                                                            <label for="radiofuga_transmision3">
                                                                                <i class="fas fa-ban"></i>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr class="font-weight-bold">
                                                                <th>Fuga de aceite diferencial</th>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                <div class="form-group clearfix">
                                                                        <div class="icheck-success d-inline">
                                                                            <input type="radio" id="radiofuga_diferencial1" name="fuga_diferencial" value="1" required>
                                                                            <label for="radiofuga_diferencial1">
                                                                                <i class="fas fa-thumbs-up"></i>
                                                                            </label>
                                                                        </div>

                                                                        <div class="icheck-danger d-inline">
                                                                            <input type="radio" id="radiofuga_diferencial2" name="fuga_diferencial" value="0" required>
                                                                            <label for="radiofuga_diferencial2">
                                                                                <i class="fas fa-thumbs-down"></i>
                                                                            </label>
                                                                        </div>
                                                                        <div class="icheck-warning d-inline">
                                                                            <input type="radio" id="radiofuga_diferencial3" name="fuga_diferencial" value="2" required>
                                                                            <label for="radiofuga_diferencial3">
                                                                                <i class="fas fa-ban"></i>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>

                                                </div>
                                            </div>

                                            <!-- TAB MUELLES Y SUSPENSION -->
                                            <div class="tab-pane fade show" id="custom-tabs-two-sistema-muelles" role="tabpanel" aria-labelledby="custom-tabs-two-sistema-muelles">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered text-center border-danger" nombre = "Sistema potencia">
                                                        <thead class="text-nowrap">
                                                            <tr class="font-weight-bold">
                                                                <th>Muelle delantero derecho</th>
                                                                <th>Amortiguador delantero derecho</th>
                                                                <th>Muelle delantero izquierdo</th>
                                                                <th>Amortiguador delantero izquierdo</th>
                                                            </tr>
                                                        </thead>
                                                        <tr>
                                                            <td>
                                                                <div class="form-group clearfix">
                                                                    <div class="icheck-success d-inline">
                                                                        <input type="radio" id="radiomuelle_delantero_derecho1" name="muelle_delantero_derecho" value="1" required>
                                                                        <label for="radiomuelle_delantero_derecho1">
                                                                            <i class="fas fa-thumbs-up"></i>
                                                                        </label>
                                                                    </div>

                                                                    <div class="icheck-danger d-inline">
                                                                        <input type="radio" id="radiomuelle_delantero_derecho2" name="muelle_delantero_derecho" value="0" required>
                                                                        <label for="radiomuelle_delantero_derecho2">
                                                                            <i class="fas fa-thumbs-down"></i>
                                                                        </label>
                                                                    </div>
                                                                    <div class="icheck-warning d-inline">
                                                                        <input type="radio" id="radiomuelle_delantero_derecho3" name="muelle_delantero_derecho" value="2" required>
                                                                        <label for="radiomuelle_delantero_derecho3">
                                                                            <i class="fas fa-ban"></i>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group clearfix">
                                                                    <div class="icheck-success d-inline">
                                                                        <input type="radio" id="radioamortiguador_delantero_derecho1" name="amortiguador_delantero_derecho" value="1" required>
                                                                        <label for="radioamortiguador_delantero_derecho1">
                                                                            <i class="fas fa-thumbs-up"></i>
                                                                        </label>
                                                                    </div>

                                                                    <div class="icheck-danger d-inline">
                                                                        <input type="radio" id="radioamortiguador_delantero_derecho2" name="amortiguador_delantero_derecho" value="0" required>
                                                                        <label for="radioamortiguador_delantero_derecho2">
                                                                            <i class="fas fa-thumbs-down"></i>
                                                                        </label>
                                                                    </div>
                                                                    <div class="icheck-warning d-inline">
                                                                        <input type="radio" id="radioamortiguador_delantero_derecho3" name="amortiguador_delantero_derecho" value="2" required>
                                                                        <label for="radioamortiguador_delantero_derecho3">
                                                                            <i class="fas fa-ban"></i>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group clearfix">
                                                                    <div class="icheck-success d-inline">
                                                                        <input type="radio" id="radiomuelle_delantero_izquierdo1" name="muelle_delantero_izquierdo" value="1" required>
                                                                        <label for="radiomuelle_delantero_izquierdo1">
                                                                            <i class="fas fa-thumbs-up"></i>
                                                                        </label>
                                                                    </div>

                                                                    <div class="icheck-danger d-inline">
                                                                        <input type="radio" id="radiomuelle_delantero_izquierdo2" name="muelle_delantero_izquierdo" value="0" required>
                                                                        <label for="radiomuelle_delantero_izquierdo2">
                                                                            <i class="fas fa-thumbs-down"></i>
                                                                        </label>
                                                                    </div>
                                                                    <div class="icheck-warning d-inline">
                                                                        <input type="radio" id="radiomuelle_delantero_izquierdo3" name="muelle_delantero_izquierdo" value="2" required>
                                                                        <label for="radiomuelle_delantero_izquierdo3">
                                                                            <i class="fas fa-ban"></i>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group clearfix">
                                                                    <div class="icheck-success d-inline">
                                                                        <input type="radio" id="radioamortiguador_delantero_izquierdo1" name="amortiguador_delantero_izquierdo" value="1" required>
                                                                        <label for="radioamortiguador_delantero_izquierdo1">
                                                                            <i class="fas fa-thumbs-up"></i>
                                                                        </label>
                                                                    </div>

                                                                    <div class="icheck-danger d-inline">
                                                                        <input type="radio" id="radioamortiguador_delantero_izquierdo2" name="amortiguador_delantero_izquierdo" value="0" required>
                                                                        <label for="radioamortiguador_delantero_izquierdo2">
                                                                            <i class="fas fa-thumbs-down"></i>
                                                                        </label>
                                                                    </div>
                                                                    <div class="icheck-warning d-inline">
                                                                        <input type="radio" id="radioamortiguador_delantero_izquierdo3" name="amortiguador_delantero_izquierdo" value="2" required>
                                                                        <label for="radioamortiguador_delantero_izquierdo3">
                                                                            <i class="fas fa-ban"></i>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>

                                                        <tbody class="text-nowrap">
                                                            
                                                            <tr class="font-weight-bold">
                                                                <th>Muelle trasero derecho</th>
                                                                <th>Amortiguador trasero derecho</th>
                                                                <th>Muelle trasero izquierdo</th>
                                                                <th>Amortiguador trasero izquierdo</th>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <div class="form-group clearfix">
                                                                        <div class="icheck-success d-inline">
                                                                            <input type="radio" id="radiomuelle_trasero_derecho1" name="muelle_trasero_derecho" value="1" required>
                                                                            <label for="radiomuelle_trasero_derecho1">
                                                                                <i class="fas fa-thumbs-up"></i>
                                                                            </label>
                                                                        </div>

                                                                        <div class="icheck-danger d-inline">
                                                                            <input type="radio" id="radiomuelle_trasero_derecho2" name="muelle_trasero_derecho" value="0" required>
                                                                            <label for="radiomuelle_trasero_derecho2">
                                                                                <i class="fas fa-thumbs-down"></i>
                                                                            </label>
                                                                        </div>
                                                                        <div class="icheck-warning d-inline">
                                                                            <input type="radio" id="radiomuelle_trasero_derecho3" name="muelle_trasero_derecho" value="2" required>
                                                                            <label for="radiomuelle_trasero_derecho3">
                                                                                <i class="fas fa-ban"></i>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-group clearfix">
                                                                        <div class="icheck-success d-inline">
                                                                            <input type="radio" id="radioamortiguador_trasero_derecho1" name="amortiguador_trasero_derecho" value="1" required>
                                                                            <label for="radioamortiguador_trasero_derecho1">
                                                                                <i class="fas fa-thumbs-up"></i>
                                                                            </label>
                                                                        </div>

                                                                        <div class="icheck-danger d-inline">
                                                                            <input type="radio" id="radioamortiguador_trasero_derecho2" name="amortiguador_trasero_derecho" value="0" required>
                                                                            <label for="radioamortiguador_trasero_derecho2">
                                                                                <i class="fas fa-thumbs-down"></i>
                                                                            </label>
                                                                        </div>
                                                                        <div class="icheck-warning d-inline">
                                                                            <input type="radio" id="radioamortiguador_trasero_derecho3" name="amortiguador_trasero_derecho" value="2" required>
                                                                            <label for="radioamortiguador_trasero_derecho3">
                                                                                <i class="fas fa-ban"></i>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-group clearfix">
                                                                        <div class="icheck-success d-inline">
                                                                            <input type="radio" id="radiomuelle_trasero_izquierdo1" name="muelle_trasero_izquierdo" value="1" required>
                                                                            <label for="radiomuelle_trasero_izquierdo1">
                                                                                <i class="fas fa-thumbs-up"></i>
                                                                            </label>
                                                                        </div>

                                                                        <div class="icheck-danger d-inline">
                                                                            <input type="radio" id="radiomuelle_trasero_izquierdo2" name="muelle_trasero_izquierdo" value="0" required>
                                                                            <label for="radiomuelle_trasero_izquierdo2">
                                                                                <i class="fas fa-thumbs-down"></i>
                                                                            </label>
                                                                        </div>
                                                                        <div class="icheck-warning d-inline">
                                                                            <input type="radio" id="radiomuelle_trasero_izquierdo3" name="muelle_trasero_izquierdo" value="2" required>
                                                                            <label for="radiomuelle_trasero_izquierdo3">
                                                                                <i class="fas fa-ban"></i>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                <div class="form-group clearfix">
                                                                        <div class="icheck-success d-inline">
                                                                            <input type="radio" id="radioamortiguador_trasero_izquierdo1" name="amortiguador_trasero_izquierdo" value="1" required>
                                                                            <label for="radioamortiguador_trasero_izquierdo1">
                                                                                <i class="fas fa-thumbs-up"></i>
                                                                            </label>
                                                                        </div>

                                                                        <div class="icheck-danger d-inline">
                                                                            <input type="radio" id="radioamortiguador_trasero_izquierdo2" name="amortiguador_trasero_izquierdo" value="0" required>
                                                                            <label for="radioamortiguador_trasero_izquierdo2">
                                                                                <i class="fas fa-thumbs-down"></i>
                                                                            </label>
                                                                        </div>
                                                                        <div class="icheck-warning d-inline">
                                                                            <input type="radio" id="radioamortiguador_trasero_izquierdo3" name="amortiguador_trasero_izquierdo" value="2" required>
                                                                            <label for="radioamortiguador_trasero_izquierdo3">
                                                                                <i class="fas fa-ban"></i>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr class="font-weight-bold">
                                                                <th>Barra estabilizadora</th>
                                                                <th>Grapas y tornillo pasador central</th>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <div class="form-group clearfix">
                                                                        <div class="icheck-success d-inline">
                                                                            <input type="radio" id="radiobarra_estabilizadora1" name="barra_estabilizadora" value="1" required>
                                                                            <label for="radiobarra_estabilizadora1">
                                                                                <i class="fas fa-thumbs-up"></i>
                                                                            </label>
                                                                        </div>

                                                                        <div class="icheck-danger d-inline">
                                                                            <input type="radio" id="radiobarra_estabilizadora2" name="barra_estabilizadora" value="0" required>
                                                                            <label for="radiobarra_estabilizadora2">
                                                                                <i class="fas fa-thumbs-down"></i>
                                                                            </label>
                                                                        </div>
                                                                        <div class="icheck-warning d-inline">
                                                                            <input type="radio" id="radiobarra_estabilizadora3" name="barra_estabilizadora" value="2" required>
                                                                            <label for="radiobarra_estabilizadora3">
                                                                                <i class="fas fa-ban"></i>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-group clearfix">
                                                                        <div class="icheck-success d-inline">
                                                                            <input type="radio" id="radiotornillo_pasador_central1" name="tornillo_pasador_central" value="1" required>
                                                                            <label for="radiotornillo_pasador_central1">
                                                                                <i class="fas fa-thumbs-up"></i>
                                                                            </label>
                                                                        </div>

                                                                        <div class="icheck-danger d-inline">
                                                                            <input type="radio" id="radiotornillo_pasador_central2" name="tornillo_pasador_central" value="0" required>
                                                                            <label for="radiotornillo_pasador_central2">
                                                                                <i class="fas fa-thumbs-down"></i>
                                                                            </label>
                                                                        </div>
                                                                        <div class="icheck-warning d-inline">
                                                                            <input type="radio" id="radiotornillo_pasador_central3" name="tornillo_pasador_central" value="2" required>
                                                                            <label for="radiotornillo_pasador_central3">
                                                                                <i class="fas fa-ban"></i>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </tbody>

                                                    </table>
                                                </div>
                                            </div>

                                            <!-- TAB SISTEMA DE DIRECCIÓN -->
                                            <div class="tab-pane fade show" id="custom-tabs-two-sistema-direccion" role="tabpanel" aria-labelledby="custom-tabs-two-sistema-direccion">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered text-center border-danger" nombre = "Sistema potencia">
                                                            <thead class="text-nowrap">
                                                                <tr class="font-weight-bold">
                                                                    <th>Nivel de aceite hidráulico</th>
                                                                    <th>Mangueras y lineas</th>
                                                                    <th>Brazo pitman</th>
                                                                    <th>Barra entre ejes</th>
                                                                </tr>
                                                            </thead>
                                                            <tr>
                                                                <td>
                                                                    <div class="form-group clearfix">
                                                                        <div class="icheck-success d-inline">
                                                                            <input type="radio" id="radioaceite_hidraulico1" name="aceite_hidraulico" value="1" required>
                                                                            <label for="radioaceite_hidraulico1">
                                                                                <i class="fas fa-thumbs-up"></i>
                                                                            </label>
                                                                        </div>

                                                                        <div class="icheck-danger d-inline">
                                                                            <input type="radio" id="radioaceite_hidraulico2" name="aceite_hidraulico" value="0" required>
                                                                            <label for="radioaceite_hidraulico2">
                                                                                <i class="fas fa-thumbs-down"></i>
                                                                            </label>
                                                                        </div>
                                                                        <div class="icheck-warning d-inline">
                                                                            <input type="radio" id="radioaceite_hidraulico3" name="aceite_hidraulico" value="2" required>
                                                                            <label for="radioaceite_hidraulico3">
                                                                                <i class="fas fa-ban"></i>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            
                                                            
                                                                <td>
                                                                    <div class="form-group clearfix">
                                                                        <div class="icheck-success d-inline">
                                                                            <input type="radio" id="radiolineas1" name="lineas" value="1" required>
                                                                            <label for="radiolineas1">
                                                                                <i class="fas fa-thumbs-up"></i>
                                                                            </label>
                                                                        </div>

                                                                        <div class="icheck-danger d-inline">
                                                                            <input type="radio" id="radiolineas2" name="lineas" value="0" required>
                                                                            <label for="radiolineas2">
                                                                                <i class="fas fa-thumbs-down"></i>
                                                                            </label>
                                                                        </div>
                                                                        <div class="icheck-warning d-inline">
                                                                            <input type="radio" id="radiolineas3" name="lineas" value="2" required>
                                                                            <label for="radiolineas3">
                                                                                <i class="fas fa-ban"></i>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            
                                                           
                                                                <td>
                                                                    <div class="form-group clearfix">
                                                                        <div class="icheck-success d-inline">
                                                                            <input type="radio" id="radiopitman1" name="pitman" value="1" required>
                                                                            <label for="radiopitman1">
                                                                                <i class="fas fa-thumbs-up"></i>
                                                                            </label>
                                                                        </div>

                                                                        <div class="icheck-danger d-inline">
                                                                            <input type="radio" id="radiopitman2" name="pitman" value="0" required>
                                                                            <label for="radiopitman2">
                                                                                <i class="fas fa-thumbs-down"></i>
                                                                            </label>
                                                                        </div>
                                                                        <div class="icheck-warning d-inline">
                                                                            <input type="radio" id="radiopitman3" name="pitman" value="2" required>
                                                                            <label for="radiopitman3">
                                                                                <i class="fas fa-ban"></i>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-group clearfix">
                                                                        <div class="icheck-success d-inline">
                                                                            <input type="radio" id="radiobarra_ejes1" name="barra_ejes" value="1" required>
                                                                            <label for="radiobarra_ejes1">
                                                                                <i class="fas fa-thumbs-up"></i>
                                                                            </label>
                                                                        </div>

                                                                        <div class="icheck-danger d-inline">
                                                                            <input type="radio" id="radiobarra_ejes2" name="barra_ejes" value="0" required>
                                                                            <label for="radiobarra_ejes2">
                                                                                <i class="fas fa-thumbs-down"></i>
                                                                            </label>
                                                                        </div>
                                                                        <div class="icheck-warning d-inline">
                                                                            <input type="radio" id="radiobarra_ejes3" name="barra_ejes" value="2" required>
                                                                            <label for="radioaceite_hidraulico3">
                                                                                <i class="fas fa-ban"></i>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>


                                                            <tbody class="text-nowrap">
                                                                <tr class="font-weight-bold">
                                                                    <th>Tijeras</th>
                                                                    <th>Splinders</th>
                                                                    <th>Timón</th>
                                                                    <th>Caja de dirección</th>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <div class="form-group clearfix">
                                                                            <div class="icheck-success d-inline">
                                                                                <input type="radio" id="radiotijeras1" name="tijeras" value="1" required>
                                                                                <label for="radiotijeras1">
                                                                                    <i class="fas fa-thumbs-up"></i>
                                                                                </label>
                                                                            </div>

                                                                            <div class="icheck-danger d-inline">
                                                                                <input type="radio" id="radiotijeras2" name="tijeras" value="0" required>
                                                                                <label for="radiotijeras2">
                                                                                    <i class="fas fa-thumbs-down"></i>
                                                                                </label>
                                                                            </div>
                                                                            <div class="icheck-warning d-inline">
                                                                                <input type="radio" id="radiotijeras3" name="tijeras" value="2" required>
                                                                                <label for="radiotijeras3">
                                                                                    <i class="fas fa-ban"></i>
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="form-group clearfix">
                                                                            <div class="icheck-success d-inline">
                                                                                <input type="radio" id="radiosplinders1" name="splinders" value="1" required>
                                                                                <label for="radiosplinders1">
                                                                                    <i class="fas fa-thumbs-up"></i>
                                                                                </label>
                                                                            </div>

                                                                            <div class="icheck-danger d-inline">
                                                                                <input type="radio" id="radiosplinders2" name="splinders" value="0" required>
                                                                                <label for="radiosplinders2">
                                                                                    <i class="fas fa-thumbs-down"></i>
                                                                                </label>
                                                                            </div>
                                                                            <div class="icheck-warning d-inline">
                                                                                <input type="radio" id="radiosplinders3" name="splinders" value="2" required>
                                                                                <label for="radiosplinders3">
                                                                                    <i class="fas fa-ban"></i>
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="form-group clearfix">
                                                                            <div class="icheck-success d-inline">
                                                                                <input type="radio" id="radiotimon1" name="timon" value="1" required>
                                                                                <label for="radiotimon1">
                                                                                    <i class="fas fa-thumbs-up"></i>
                                                                                </label>
                                                                            </div>

                                                                            <div class="icheck-danger d-inline">
                                                                                <input type="radio" id="radiotimon2" name="timon" value="0" required>
                                                                                <label for="radiotimon2">
                                                                                    <i class="fas fa-thumbs-down"></i>
                                                                                </label>
                                                                            </div>
                                                                            <div class="icheck-warning d-inline">
                                                                                <input type="radio" id="radiotimon3" name="timon" value="2" required>
                                                                                <label for="radiotimon3">
                                                                                    <i class="fas fa-ban"></i>
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="form-group clearfix">
                                                                            <div class="icheck-success d-inline">
                                                                                <input type="radio" id="radiocaja_direccion1" name="caja_direccion" value="1" required>
                                                                                <label for="radiocaja_direccion1">
                                                                                    <i class="fas fa-thumbs-up"></i>
                                                                                </label>
                                                                            </div>

                                                                            <div class="icheck-danger d-inline">
                                                                                <input type="radio" id="radiocaja_direccion2" name="caja_direccion" value="0" required>
                                                                                <label for="radiocaja_direccion2">
                                                                                    <i class="fas fa-thumbs-down"></i>
                                                                                </label>
                                                                            </div>
                                                                            <div class="icheck-warning d-inline">
                                                                                <input type="radio" id="radiocaja_direccion3" name="caja_direccion" value="2" required>
                                                                                <label for="radiocaja_direccion3">
                                                                                    <i class="fas fa-ban"></i>
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr class="font-weight-bold">
                                                                    <th>Cruceta de dirección</th>
                                                                    <th>Fugas caja de dirección</th>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <div class="form-group clearfix">
                                                                            <div class="icheck-success d-inline">
                                                                                <input type="radio" id="radiocruceta_direccion1" name="cruceta_direccion" value="1" required>
                                                                                <label for="radiocruceta_direccion1">
                                                                                    <i class="fas fa-thumbs-up"></i>
                                                                                </label>
                                                                            </div>

                                                                            <div class="icheck-danger d-inline">
                                                                                <input type="radio" id="radiocruceta_direccion2" name="cruceta_direccion" value="0" required>
                                                                                <label for="radiocruceta_direccion2">
                                                                                    <i class="fas fa-thumbs-down"></i>
                                                                                </label>
                                                                            </div>
                                                                            <div class="icheck-warning d-inline">
                                                                                <input type="radio" id="radiocruceta_direccion3" name="cruceta_direccion" value="2" required>
                                                                                <label for="radiocruceta_direccion3">
                                                                                    <i class="fas fa-ban"></i>
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="form-group clearfix">
                                                                            <div class="icheck-success d-inline">
                                                                                <input type="radio" id="radiofuga_caja1" name="fuga_caja" value="1" required>
                                                                                <label for="radiofuga_caja1">
                                                                                    <i class="fas fa-thumbs-up"></i>
                                                                                </label>
                                                                            </div>

                                                                            <div class="icheck-danger d-inline">
                                                                                <input type="radio" id="radiofuga_caja2" name="fuga_caja" value="0" required>
                                                                                <label for="radiofuga_caja2">
                                                                                    <i class="fas fa-thumbs-down"></i>
                                                                                </label>
                                                                            </div>
                                                                            <div class="icheck-warning d-inline">
                                                                                <input type="radio" id="radiofuga_caja3" name="fuga_caja" value="2" required>
                                                                                <label for="radiofuga_caja3">
                                                                                    <i class="fas fa-ban"></i>
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>

                                                            </tbody>
                                                    </table>
                                                </div>
                                            </div>

                                            <!-- TAB SISTEMA DE FRENOS Y LLANTAS -->
                                            <div class="tab-pane fade show" id="custom-tabs-two-sistema-frenos" role="tabpanel" aria-labelledby="custom-tabs-two-sistema-frenos">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered text-center border-danger" nombre = "Sistema potencia">
                                                            <thead class="text-nowrap">
                                                                <tr class="font-weight-bold">
                                                                    <th>Nivel de fluido</th>
                                                                    <th>Mangueras y tuberias</th>
                                                                    <th>Freno de parqueo</th>
                                                                    <th>Frenos</th>
                                                                </tr>
                                                            </thead>

                                                            <tr>
                                                                <td>
                                                                    <div class="form-group clearfix">
                                                                        <div class="icheck-success d-inline">
                                                                            <input type="radio" id="radionivel_fluido1" name="nivel_fluido" value="1" required>
                                                                            <label for="radionivel_fluido1">
                                                                                <i class="fas fa-thumbs-up"></i>
                                                                            </label>
                                                                        </div>

                                                                        <div class="icheck-danger d-inline">
                                                                            <input type="radio" id="radionivel_fluido2" name="nivel_fluido" value="0" required>
                                                                            <label for="radionivel_fluido2">
                                                                                <i class="fas fa-thumbs-down"></i>
                                                                            </label>
                                                                        </div>
                                                                        <div class="icheck-warning d-inline">
                                                                            <input type="radio" id="radionivel_fluido3" name="nivel_fluido" value="2" required>
                                                                            <label for="radionivel_fluido3">
                                                                                <i class="fas fa-ban"></i>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-group clearfix">
                                                                        <div class="icheck-success d-inline">
                                                                            <input type="radio" id="radiotuberias1" name="tuberias" value="1" required>
                                                                            <label for="radiotuberias1">
                                                                                <i class="fas fa-thumbs-up"></i>
                                                                            </label>
                                                                        </div>

                                                                        <div class="icheck-danger d-inline">
                                                                            <input type="radio" id="radiotuberias2" name="tuberias" value="0" required>
                                                                            <label for="radiotuberias2">
                                                                                <i class="fas fa-thumbs-down"></i>
                                                                            </label>
                                                                        </div>
                                                                        <div class="icheck-warning d-inline">
                                                                            <input type="radio" id="radiotuberias3" name="tuberias" value="2" required>
                                                                            <label for="radiotuberias3">
                                                                                <i class="fas fa-ban"></i>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-group clearfix">
                                                                        <div class="icheck-success d-inline">
                                                                            <input type="radio" id="radiofreno_parqueo1" name="freno_parqueo" value="1" required>
                                                                            <label for="radiofreno_parqueo1">
                                                                                <i class="fas fa-thumbs-up"></i>
                                                                            </label>
                                                                        </div>

                                                                        <div class="icheck-danger d-inline">
                                                                            <input type="radio" id="radiofreno_parqueo2" name="freno_parqueo" value="0" required>
                                                                            <label for="radiofreno_parqueo2">
                                                                                <i class="fas fa-thumbs-down"></i>
                                                                            </label>
                                                                        </div>
                                                                        <div class="icheck-warning d-inline">
                                                                            <input type="radio" id="radiofreno_parqueo3" name="freno_parqueo" value="2" required>
                                                                            <label for="radiofreno_parqueo3">
                                                                                <i class="fas fa-ban"></i>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-group clearfix">
                                                                        <div class="icheck-success d-inline">
                                                                            <input type="radio" id="radiofrenos1" name="frenos" value="1" required>
                                                                            <label for="radiofrenos1">
                                                                                <i class="fas fa-thumbs-up"></i>
                                                                            </label>
                                                                        </div>

                                                                        <div class="icheck-danger d-inline">
                                                                            <input type="radio" id="radiofrenos2" name="frenos" value="0" required>
                                                                            <label for="radiofrenos2">
                                                                                <i class="fas fa-thumbs-down"></i>
                                                                            </label>
                                                                        </div>
                                                                        <div class="icheck-warning d-inline">
                                                                            <input type="radio" id="radiofrenos3" name="frenos" value="2" required>
                                                                            <label for="radiofrenos3">
                                                                                <i class="fas fa-ban"></i>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>

                                                            <tbody class="text-nowrap">
                                                                <tr class="font-weight-bold">
                                                                    <th>Pedal de freno</th>
                                                                    <th>Compresor</th>
                                                                    <th>Fugas de aire</th>
                                                                    <th>Bandas delantera derecha</th>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <div class="form-group clearfix">
                                                                            <div class="icheck-success d-inline">
                                                                                <input type="radio" id="radiopedal_freno1" name="pedal_freno" value="1" required>
                                                                                <label for="radiopedal_freno1">
                                                                                    <i class="fas fa-thumbs-up"></i>
                                                                                </label>
                                                                            </div>

                                                                            <div class="icheck-danger d-inline">
                                                                                <input type="radio" id="radiopedal_freno2" name="pedal_freno" value="0" required>
                                                                                <label for="radiopedal_freno2">
                                                                                    <i class="fas fa-thumbs-down"></i>
                                                                                </label>
                                                                            </div>
                                                                            <div class="icheck-warning d-inline">
                                                                                <input type="radio" id="radiopedal_freno3" name="pedal_freno" value="2" required>
                                                                                <label for="radiopedal_freno3">
                                                                                    <i class="fas fa-ban"></i>
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="form-group clearfix">
                                                                            <div class="icheck-success d-inline">
                                                                                <input type="radio" id="radiocompresor1" name="compresor" value="1" required>
                                                                                <label for="radiocompresor1">
                                                                                    <i class="fas fa-thumbs-up"></i>
                                                                                </label>
                                                                            </div>

                                                                            <div class="icheck-danger d-inline">
                                                                                <input type="radio" id="radiocompresor2" name="compresor" value="0" required>
                                                                                <label for="radiocompresor2">
                                                                                    <i class="fas fa-thumbs-down"></i>
                                                                                </label>
                                                                            </div>
                                                                            <div class="icheck-warning d-inline">
                                                                                <input type="radio" id="radiocompresor3" name="compresor" value="2" required>
                                                                                <label for="radiocompresor3">
                                                                                    <i class="fas fa-ban"></i>
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="form-group clearfix">
                                                                            <div class="icheck-success d-inline">
                                                                                <input type="radio" id="radiofuga_aire1" name="fuga_aire" value="1" required>
                                                                                <label for="radiofuga_aire1">
                                                                                    <i class="fas fa-thumbs-up"></i>
                                                                                </label>
                                                                            </div>

                                                                            <div class="icheck-danger d-inline">
                                                                                <input type="radio" id="radiofuga_aire2" name="fuga_aire" value="0" required>
                                                                                <label for="radiofuga_aire2">
                                                                                    <i class="fas fa-thumbs-down"></i>
                                                                                </label>
                                                                            </div>
                                                                            <div class="icheck-warning d-inline">
                                                                                <input type="radio" id="radiofuga_aire3" name="fuga_aire" value="2" required>
                                                                                <label for="radiofuga_aire3">
                                                                                    <i class="fas fa-ban"></i>
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="form-group clearfix">
                                                                            <div class="icheck-success d-inline">
                                                                                <input type="radio" id="radiobanda_delantera_derecha1" name="banda_delantera_derecha" value="1" required>
                                                                                <label for="radiobanda_delantera_derecha1">
                                                                                    <i class="fas fa-thumbs-up"></i>
                                                                                </label>
                                                                            </div>

                                                                            <div class="icheck-danger d-inline">
                                                                                <input type="radio" id="radiobanda_delantera_derecha2" name="banda_delantera_derecha" value="0" required>
                                                                                <label for="radiobanda_delantera_derecha2">
                                                                                    <i class="fas fa-thumbs-down"></i>
                                                                                </label>
                                                                            </div>
                                                                            <div class="icheck-warning d-inline">
                                                                                <input type="radio" id="radiobanda_delantera_derecha3" name="banda_delantera_derecha" value="2" required>
                                                                                <label for="radiobanda_delantera_derecha3">
                                                                                    <i class="fas fa-ban"></i>
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr class="font-weight-bold">
                                                                    <th>Bandas delantera izquierda</th>
                                                                    <th>Bandas trasera derecha</th>
                                                                    <th>Bandas trasera izquierda</th>
                                                                    <th>Rachets</th>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <div class="form-group clearfix">
                                                                            <div class="icheck-success d-inline">
                                                                                <input type="radio" id="radiobanda_delantera_izquierda1" name="banda_delantera_izquierda" value="1" required>
                                                                                <label for="radiobanda_delantera_izquierda1">
                                                                                    <i class="fas fa-thumbs-up"></i>
                                                                                </label>
                                                                            </div>

                                                                            <div class="icheck-danger d-inline">
                                                                                <input type="radio" id="radiobanda_delantera_izquierda2" name="banda_delantera_izquierda" value="0" required>
                                                                                <label for="radiobanda_delantera_izquierda2">
                                                                                    <i class="fas fa-thumbs-down"></i>
                                                                                </label>
                                                                            </div>
                                                                            <div class="icheck-warning d-inline">
                                                                                <input type="radio" id="radiobanda_delantera_izquierda3" name="banda_delantera_izquierda" value="2" required>
                                                                                <label for="radiobanda_delantera_izquierda3">
                                                                                    <i class="fas fa-ban"></i>
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="form-group clearfix">
                                                                            <div class="icheck-success d-inline">
                                                                                <input type="radio" id="radiobanda_trasera_derecha1" name="banda_trasera_derecha" value="1" required>
                                                                                <label for="radiobanda_trasera_derecha1">
                                                                                    <i class="fas fa-thumbs-up"></i>
                                                                                </label>
                                                                            </div>

                                                                            <div class="icheck-danger d-inline">
                                                                                <input type="radio" id="radiobanda_trasera_derecha2" name="banda_trasera_derecha" value="0" required>
                                                                                <label for="radiobanda_trasera_derecha2">
                                                                                    <i class="fas fa-thumbs-down"></i>
                                                                                </label>
                                                                            </div>
                                                                            <div class="icheck-warning d-inline">
                                                                                <input type="radio" id="radiobanda_trasera_derecha3" name="banda_trasera_derecha" value="2" required>
                                                                                <label for="radiobanda_trasera_derecha3">
                                                                                    <i class="fas fa-ban"></i>
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="form-group clearfix">
                                                                            <div class="icheck-success d-inline">
                                                                                <input type="radio" id="radiobanda_trasera_izquierda1" name="banda_trasera_izquierda" value="1" required>
                                                                                <label for="radiobanda_trasera_izquierda1">
                                                                                    <i class="fas fa-thumbs-up"></i>
                                                                                </label>
                                                                            </div>

                                                                            <div class="icheck-danger d-inline">
                                                                                <input type="radio" id="radiobanda_trasera_izquierda2" name="banda_trasera_izquierda" value="0" required>
                                                                                <label for="radiobanda_trasera_izquierda2">
                                                                                    <i class="fas fa-thumbs-down"></i>
                                                                                </label>
                                                                            </div>
                                                                            <div class="icheck-warning d-inline">
                                                                                <input type="radio" id="radiobanda_trasera_izquierda3" name="banda_trasera_izquierda" value="2" required>
                                                                                <label for="radiobanda_trasera_izquierda3">
                                                                                    <i class="fas fa-ban"></i>
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="form-group clearfix">
                                                                            <div class="icheck-success d-inline">
                                                                                <input type="radio" id="radiorachets1" name="rachets" value="1" required>
                                                                                <label for="radiorachets1">
                                                                                    <i class="fas fa-thumbs-up"></i>
                                                                                </label>
                                                                            </div>

                                                                            <div class="icheck-danger d-inline">
                                                                                <input type="radio" id="radiorachets2" name="rachets" value="0" required>
                                                                                <label for="radiorachets2">
                                                                                    <i class="fas fa-thumbs-down"></i>
                                                                                </label>
                                                                            </div>
                                                                            <div class="icheck-warning d-inline">
                                                                                <input type="radio" id="radiorachets3" name="rachets" value="2" required>
                                                                                <label for="radiorachets3">
                                                                                    <i class="fas fa-ban"></i>
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr class="font-weight-bold">
                                                                    <th>Discos delanteros</th>
                                                                    <th>Discos traseros</th>
                                                                    <th>Pastillas de freno</th>
                                                                    <th>Rines</th>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <div class="form-group clearfix">
                                                                            <div class="icheck-success d-inline">
                                                                                <input type="radio" id="radiodiscos_delanteros1" name="discos_delanteros" value="1" required>
                                                                                <label for="radiodiscos_delanteros1">
                                                                                    <i class="fas fa-thumbs-up"></i>
                                                                                </label>
                                                                            </div>

                                                                            <div class="icheck-danger d-inline">
                                                                                <input type="radio" id="radiodiscos_delanteros2" name="discos_delanteros" value="0" required>
                                                                                <label for="radiodiscos_delanteros2">
                                                                                    <i class="fas fa-thumbs-down"></i>
                                                                                </label>
                                                                            </div>
                                                                            <div class="icheck-warning d-inline">
                                                                                <input type="radio" id="radiodiscos_delanteros3" name="discos_delanteros" value="2" required>
                                                                                <label for="radiodiscos_delanteros3">
                                                                                    <i class="fas fa-ban"></i>
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="form-group clearfix">
                                                                            <div class="icheck-success d-inline">
                                                                                <input type="radio" id="radiodiscos_traseros1" name="discos_traseros" value="1" required>
                                                                                <label for="radiodiscos_traseros1">
                                                                                    <i class="fas fa-thumbs-up"></i>
                                                                                </label>
                                                                            </div>

                                                                            <div class="icheck-danger d-inline">
                                                                                <input type="radio" id="radiodiscos_traseros2" name="discos_traseros" value="0" required>
                                                                                <label for="radiodiscos_traseros2">
                                                                                    <i class="fas fa-thumbs-down"></i>
                                                                                </label>
                                                                            </div>
                                                                            <div class="icheck-warning d-inline">
                                                                                <input type="radio" id="radiodiscos_traseros3" name="discos_traseros" value="2" required>
                                                                                <label for="radiodiscos_traseros3">
                                                                                    <i class="fas fa-ban"></i>
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="form-group clearfix">
                                                                            <div class="icheck-success d-inline">
                                                                                <input type="radio" id="radiopastillas_freno1" name="pastillas_freno" value="1" required>
                                                                                <label for="radiopastillas_freno1">
                                                                                    <i class="fas fa-thumbs-up"></i>
                                                                                </label>
                                                                            </div>

                                                                            <div class="icheck-danger d-inline">
                                                                                <input type="radio" id="radiopastillas_freno2" name="pastillas_freno" value="0" required>
                                                                                <label for="radiopastillas_freno2">
                                                                                    <i class="fas fa-thumbs-down"></i>
                                                                                </label>
                                                                            </div>
                                                                            <div class="icheck-warning d-inline">
                                                                                <input type="radio" id="radiopastillas_freno3" name="pastillas_freno" value="2" required>
                                                                                <label for="radiopastillas_freno3">
                                                                                    <i class="fas fa-ban"></i>
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="form-group clearfix">
                                                                            <div class="icheck-success d-inline">
                                                                                <input type="radio" id="radiorines1" name="rines" value="1" required>
                                                                                <label for="radiorines1">
                                                                                    <i class="fas fa-thumbs-up"></i>
                                                                                </label>
                                                                            </div>

                                                                            <div class="icheck-danger d-inline">
                                                                                <input type="radio" id="radiorines2" name="rines" value="0" required>
                                                                                <label for="radiorines2">
                                                                                    <i class="fas fa-thumbs-down"></i>
                                                                                </label>
                                                                            </div>
                                                                            <div class="icheck-warning d-inline">
                                                                                <input type="radio" id="radiorines3" name="rines" value="2" required>
                                                                                <label for="radiorines3">
                                                                                    <i class="fas fa-ban"></i>
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr class="font-weight-bold">
                                                                    <th>Llanta R1</th>
                                                                    <th>Llanta R2</th>
                                                                    <th>Llanta R3</th>
                                                                    <th>Llanta R4</th>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <div class="form-group clearfix">
                                                                            <div class="icheck-success d-inline">
                                                                                <input type="radio" id="radiollantar11" name="llantar1" value="1" required>
                                                                                <label for="radiollantar11">
                                                                                    <i class="fas fa-thumbs-up"></i>
                                                                                </label>
                                                                            </div>

                                                                            <div class="icheck-danger d-inline">
                                                                                <input type="radio" id="radiollantar12" name="llantar1" value="0" required>
                                                                                <label for="radiollantar12">
                                                                                    <i class="fas fa-thumbs-down"></i>
                                                                                </label>
                                                                            </div>
                                                                            <div class="icheck-warning d-inline">
                                                                                <input type="radio" id="radiollantar13" name="llantar1" value="2" required>
                                                                                <label for="radiollantar13">
                                                                                    <i class="fas fa-ban"></i>
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="form-group clearfix">
                                                                            <div class="icheck-success d-inline">
                                                                                <input type="radio" id="radiollantar21" name="llantar2" value="1" required>
                                                                                <label for="radiollantar21">
                                                                                    <i class="fas fa-thumbs-up"></i>
                                                                                </label>
                                                                            </div>

                                                                            <div class="icheck-danger d-inline">
                                                                                <input type="radio" id="radiollantar22" name="llantar2" value="0" required>
                                                                                <label for="radiollantar22">
                                                                                    <i class="fas fa-thumbs-down"></i>
                                                                                </label>
                                                                            </div>
                                                                            <div class="icheck-warning d-inline">
                                                                                <input type="radio" id="radiollantar23" name="llantar2" value="2" required>
                                                                                <label for="radiollantar23">
                                                                                    <i class="fas fa-ban"></i>
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="form-group clearfix">
                                                                            <div class="icheck-success d-inline">
                                                                                <input type="radio" id="radiollantar31" name="llantar3" value="1" required>
                                                                                <label for="radiollantar31">
                                                                                    <i class="fas fa-thumbs-up"></i>
                                                                                </label>
                                                                            </div>

                                                                            <div class="icheck-danger d-inline">
                                                                                <input type="radio" id="radiollantar32" name="llantar3" value="0" required>
                                                                                <label for="radiollantar32">
                                                                                    <i class="fas fa-thumbs-down"></i>
                                                                                </label>
                                                                            </div>
                                                                            <div class="icheck-warning d-inline">
                                                                                <input type="radio" id="radiollantar33" name="llantar3" value="2" required>
                                                                                <label for="radiollantar33">
                                                                                    <i class="fas fa-ban"></i>
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="form-group clearfix">
                                                                            <div class="icheck-success d-inline">
                                                                                <input type="radio" id="radiollantar41" name="llantar4" value="1" required>
                                                                                <label for="radiollantar41">
                                                                                    <i class="fas fa-thumbs-up"></i>
                                                                                </label>
                                                                            </div>

                                                                            <div class="icheck-danger d-inline">
                                                                                <input type="radio" id="radiollantar42" name="llantar4" value="0" required>
                                                                                <label for="radiollantar42">
                                                                                    <i class="fas fa-thumbs-down"></i>
                                                                                </label>
                                                                            </div>
                                                                            <div class="icheck-warning d-inline">
                                                                                <input type="radio" id="radiollantar43" name="llantar4" value="2" required>
                                                                                <label for="radiollantar43">
                                                                                    <i class="fas fa-ban"></i>
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr class="font-weight-bold">
                                                                    <th>Llanta R5</th>
                                                                    <th>Llanta R6</th>
                                                                    <th>Llanta de repuesto</th>
                                                                    <th>Chequeo de tanques de aire</th>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <div class="form-group clearfix">
                                                                            <div class="icheck-success d-inline">
                                                                                <input type="radio" id="radiollantar51" name="llantar5" value="1" required>
                                                                                <label for="radiollantar51">
                                                                                    <i class="fas fa-thumbs-up"></i>
                                                                                </label>
                                                                            </div>

                                                                            <div class="icheck-danger d-inline">
                                                                                <input type="radio" id="radiollantar52" name="llantar5" value="0" required>
                                                                                <label for="radiollantar52">
                                                                                    <i class="fas fa-thumbs-down"></i>
                                                                                </label>
                                                                            </div>
                                                                            <div class="icheck-warning d-inline">
                                                                                <input type="radio" id="radiollantar53" name="llantar5" value="2" required>
                                                                                <label for="radiollantar53">
                                                                                    <i class="fas fa-ban"></i>
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="form-group clearfix">
                                                                            <div class="icheck-success d-inline">
                                                                                <input type="radio" id="radiollantar61" name="llantar6" value="1" required>
                                                                                <label for="radiollantar61">
                                                                                    <i class="fas fa-thumbs-up"></i>
                                                                                </label>
                                                                            </div>

                                                                            <div class="icheck-danger d-inline">
                                                                                <input type="radio" id="radiollantar62" name="llantar6" value="0" required>
                                                                                <label for="radiollantar62">
                                                                                    <i class="fas fa-thumbs-down"></i>
                                                                                </label>
                                                                            </div>
                                                                            <div class="icheck-warning d-inline">
                                                                                <input type="radio" id="radiollantar63" name="llantar6" value="2" required>
                                                                                <label for="radiollantar63">
                                                                                    <i class="fas fa-ban"></i>
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="form-group clearfix">
                                                                            <div class="icheck-success d-inline">
                                                                                <input type="radio" id="radiollanta_repuesto1" name="llanta_repuesto" value="1" required>
                                                                                <label for="radiollanta_repuesto1">
                                                                                    <i class="fas fa-thumbs-up"></i>
                                                                                </label>
                                                                            </div>

                                                                            <div class="icheck-danger d-inline">
                                                                                <input type="radio" id="radiollanta_repuesto2" name="llanta_repuesto" value="0" required>
                                                                                <label for="radiollanta_repuesto2">
                                                                                    <i class="fas fa-thumbs-down"></i>
                                                                                </label>
                                                                            </div>
                                                                            <div class="icheck-warning d-inline">
                                                                                <input type="radio" id="radiollanta_repuesto3" name="llanta_repuesto" value="2" required>
                                                                                <label for="radiollanta_repuesto3">
                                                                                    <i class="fas fa-ban"></i>
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="form-group clearfix">
                                                                            <div class="icheck-success d-inline">
                                                                                <input type="radio" id="radiotanques_aire1" name="tanques_aire" value="1" required>
                                                                                <label for="radiotanques_aire1">
                                                                                    <i class="fas fa-thumbs-up"></i>
                                                                                </label>
                                                                            </div>

                                                                            <div class="icheck-danger d-inline">
                                                                                <input type="radio" id="radiotanques_aire2" name="tanques_aire" value="0" required>
                                                                                <label for="radiotanques_aire2">
                                                                                    <i class="fas fa-thumbs-down"></i>
                                                                                </label>
                                                                            </div>
                                                                            <div class="icheck-warning d-inline">
                                                                                <input type="radio" id="radiotanques_aire3" name="tanques_aire" value="2" required>
                                                                                <label for="radiotanques_aire3">
                                                                                    <i class="fas fa-ban"></i>
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                    </table>
                                                </div>
                                            </div>

                                            <!-- TAB SISTEMA ELÉCTRICO -->
                                            <div class="tab-pane fade show" id="custom-tabs-two-sistema-electrico" role="tabpanel" aria-labelledby="custom-tabs-two-sistema-electrico">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered text-center border-danger" nombre = "Sistema potencia">
                                                            <thead class="text-nowrap">
                                                                <tr class="font-weight-bold">
                                                                    <th>Luces altas</th>
                                                                    <th>Luces bajas</th>
                                                                    <th>Luces direccionales</th>
                                                                    <th>Luces estacionarias</th>
                                                                </tr>
                                                            </thead>
                                                            <tr>
                                                                <td>
                                                                    <div class="form-group clearfix">
                                                                        <div class="icheck-success d-inline">
                                                                            <input type="radio" id="radioluces_altas1" name="luces_altas" value="1" required>
                                                                            <label for="radioluces_altas1">
                                                                                <i class="fas fa-thumbs-up"></i>
                                                                            </label>
                                                                        </div>

                                                                        <div class="icheck-danger d-inline">
                                                                            <input type="radio" id="radioluces_altas2" name="luces_altas" value="0" required>
                                                                            <label for="radioluces_altas2">
                                                                                <i class="fas fa-thumbs-down"></i>
                                                                            </label>
                                                                        </div>
                                                                        <div class="icheck-warning d-inline">
                                                                            <input type="radio" id="radioluces_altas3" name="luces_altas" value="2" required>
                                                                            <label for="radioluces_altas3">
                                                                                <i class="fas fa-ban"></i>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-group clearfix">
                                                                        <div class="icheck-success d-inline">
                                                                            <input type="radio" id="radioluces_bajas1" name="luces_bajas" value="1" required>
                                                                            <label for="radioluces_bajas1">
                                                                                <i class="fas fa-thumbs-up"></i>
                                                                            </label>
                                                                        </div>

                                                                        <div class="icheck-danger d-inline">
                                                                            <input type="radio" id="radioluces_bajas2" name="luces_bajas" value="0" required>
                                                                            <label for="radioluces_bajas2">
                                                                                <i class="fas fa-thumbs-down"></i>
                                                                            </label>
                                                                        </div>
                                                                        <div class="icheck-warning d-inline">
                                                                            <input type="radio" id="radioluces_bajas3" name="luces_bajas" value="2" required>
                                                                            <label for="radioluces_bajas3">
                                                                                <i class="fas fa-ban"></i>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-group clearfix">
                                                                        <div class="icheck-success d-inline">
                                                                            <input type="radio" id="radioluces_direccionales1" name="luces_direccionales" value="1" required>
                                                                            <label for="radioluces_direccionales1">
                                                                                <i class="fas fa-thumbs-up"></i>
                                                                            </label>
                                                                        </div>

                                                                        <div class="icheck-danger d-inline">
                                                                            <input type="radio" id="radioluces_direccionales2" name="luces_direccionales" value="0" required>
                                                                            <label for="radioluces_direccionales2">
                                                                                <i class="fas fa-thumbs-down"></i>
                                                                            </label>
                                                                        </div>
                                                                        <div class="icheck-warning d-inline">
                                                                            <input type="radio" id="radioluces_direccionales3" name="luces_direccionales" value="2" required>
                                                                            <label for="radioluces_direccionales3">
                                                                                <i class="fas fa-ban"></i>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-group clearfix">
                                                                        <div class="icheck-success d-inline">
                                                                            <input type="radio" id="radioluces_estacionarias1" name="luces_estacionarias" value="1" required>
                                                                            <label for="radioluces_estacionarias1">
                                                                                <i class="fas fa-thumbs-up"></i>
                                                                            </label>
                                                                        </div>

                                                                        <div class="icheck-danger d-inline">
                                                                            <input type="radio" id="radioluces_estacionarias2" name="luces_estacionarias" value="0" required>
                                                                            <label for="radioluces_estacionarias2">
                                                                                <i class="fas fa-thumbs-down"></i>
                                                                            </label>
                                                                        </div>
                                                                        <div class="icheck-warning d-inline">
                                                                            <input type="radio" id="radioluces_estacionarias3" name="luces_estacionarias" value="2" required>
                                                                            <label for="radioluces_estacionarias3">
                                                                                <i class="fas fa-ban"></i>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>

                                                            <tbody class="text-nowrap">
                                                                <tr class="font-weight-bold">
                                                                    <th>Luces laterales</th>
                                                                    <th>Luz de reversa</th>
                                                                    <th>Luces internas</th>
                                                                    <th>Luces delimitadoras</th>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <div class="form-group clearfix">
                                                                            <div class="icheck-success d-inline">
                                                                                <input type="radio" id="radioluces_laterales1" name="luces_laterales" value="1" required>
                                                                                <label for="radioluces_laterales1">
                                                                                    <i class="fas fa-thumbs-up"></i>
                                                                                </label>
                                                                            </div>

                                                                            <div class="icheck-danger d-inline">
                                                                                <input type="radio" id="radioluces_laterales2" name="luces_laterales" value="0" required>
                                                                                <label for="radioluces_laterales2">
                                                                                    <i class="fas fa-thumbs-down"></i>
                                                                                </label>
                                                                            </div>
                                                                            <div class="icheck-warning d-inline">
                                                                                <input type="radio" id="radioluces_laterales3" name="luces_laterales" value="2" required>
                                                                                <label for="radioluces_laterales3">
                                                                                    <i class="fas fa-ban"></i>
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="form-group clearfix">
                                                                            <div class="icheck-success d-inline">
                                                                                <input type="radio" id="radioluz_reversa1" name="luz_reversa" value="1" required>
                                                                                <label for="radioluz_reversa1">
                                                                                    <i class="fas fa-thumbs-up"></i>
                                                                                </label>
                                                                            </div>

                                                                            <div class="icheck-danger d-inline">
                                                                                <input type="radio" id="radioluz_reversa2" name="luz_reversa" value="0" required>
                                                                                <label for="radioluz_reversa2">
                                                                                    <i class="fas fa-thumbs-down"></i>
                                                                                </label>
                                                                            </div>
                                                                            <div class="icheck-warning d-inline">
                                                                                <input type="radio" id="radioluz_reversa3" name="luz_reversa" value="2" required>
                                                                                <label for="radioluz_reversa3">
                                                                                    <i class="fas fa-ban"></i>
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="form-group clearfix">
                                                                            <div class="icheck-success d-inline">
                                                                                <input type="radio" id="radioluces_internas1" name="luces_internas" value="1" required>
                                                                                <label for="radioluces_internas1">
                                                                                    <i class="fas fa-thumbs-up"></i>
                                                                                </label>
                                                                            </div>

                                                                            <div class="icheck-danger d-inline">
                                                                                <input type="radio" id="radioluces_internas2" name="luces_internas" value="0" required>
                                                                                <label for="radioluces_internas2">
                                                                                    <i class="fas fa-thumbs-down"></i>
                                                                                </label>
                                                                            </div>
                                                                            <div class="icheck-warning d-inline">
                                                                                <input type="radio" id="radioluces_internas3" name="luces_internas" value="2" required>
                                                                                <label for="radioluces_internas3">
                                                                                    <i class="fas fa-ban"></i>
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="form-group clearfix">
                                                                            <div class="icheck-success d-inline">
                                                                                <input type="radio" id="radioluces_delimitadoras1" name="luces_delimitadoras" value="1" required>
                                                                                <label for="radioluces_delimitadoras1">
                                                                                    <i class="fas fa-thumbs-up"></i>
                                                                                </label>
                                                                            </div>

                                                                            <div class="icheck-danger d-inline">
                                                                                <input type="radio" id="radioluces_delimitadoras2" name="luces_delimitadoras" value="0" required>
                                                                                <label for="radioluces_delimitadoras2">
                                                                                    <i class="fas fa-thumbs-down"></i>
                                                                                </label>
                                                                            </div>
                                                                            <div class="icheck-warning d-inline">
                                                                                <input type="radio" id="radioluces_delimitadoras3" name="luces_delimitadoras" value="2" required>
                                                                                <label for="radioluces_delimitadoras3">
                                                                                    <i class="fas fa-ban"></i>
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr class="font-weight-bold">
                                                                    <th>Alarma de reversa</th>
                                                                    <th>Motor de arranque</th>
                                                                    <th>Alternador</th>
                                                                    <th>Baterias</th>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <div class="form-group clearfix">
                                                                            <div class="icheck-success d-inline">
                                                                                <input type="radio" id="radioalarma_reversa1" name="alarma_reversa" value="1" required>
                                                                                <label for="radioalarma_reversa1">
                                                                                    <i class="fas fa-thumbs-up"></i>
                                                                                </label>
                                                                            </div>

                                                                            <div class="icheck-danger d-inline">
                                                                                <input type="radio" id="radioalarma_reversa2" name="alarma_reversa" value="0" required>
                                                                                <label for="radioalarma_reversa2">
                                                                                    <i class="fas fa-thumbs-down"></i>
                                                                                </label>
                                                                            </div>
                                                                            <div class="icheck-warning d-inline">
                                                                                <input type="radio" id="radioalarma_reversa3" name="alarma_reversa" value="2" required>
                                                                                <label for="radioalarma_reversa3">
                                                                                    <i class="fas fa-ban"></i>
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="form-group clearfix">
                                                                            <div class="icheck-success d-inline">
                                                                                <input type="radio" id="radiomotor_arranque1" name="motor_arranque" value="1" required>
                                                                                <label for="radiomotor_arranque1">
                                                                                    <i class="fas fa-thumbs-up"></i>
                                                                                </label>
                                                                            </div>

                                                                            <div class="icheck-danger d-inline">
                                                                                <input type="radio" id="radiomotor_arranque2" name="motor_arranque" value="0" required>
                                                                                <label for="radiomotor_arranque2">
                                                                                    <i class="fas fa-thumbs-down"></i>
                                                                                </label>
                                                                            </div>
                                                                            <div class="icheck-warning d-inline">
                                                                                <input type="radio" id="radiomotor_arranque3" name="motor_arranque" value="2" required>
                                                                                <label for="radiomotor_arranque3">
                                                                                    <i class="fas fa-ban"></i>
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="form-group clearfix">
                                                                            <div class="icheck-success d-inline">
                                                                                <input type="radio" id="radioalternador1" name="alternador" value="1" required>
                                                                                <label for="radioalternador1">
                                                                                    <i class="fas fa-thumbs-up"></i>
                                                                                </label>
                                                                            </div>

                                                                            <div class="icheck-danger d-inline">
                                                                                <input type="radio" id="radioalternador2" name="alternador" value="0" required>
                                                                                <label for="radioalternador2">
                                                                                    <i class="fas fa-thumbs-down"></i>
                                                                                </label>
                                                                            </div>
                                                                            <div class="icheck-warning d-inline">
                                                                                <input type="radio" id="radioalternador3" name="alternador" value="2" required>
                                                                                <label for="radioalternador3">
                                                                                    <i class="fas fa-ban"></i>
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="form-group clearfix">
                                                                            <div class="icheck-success d-inline">
                                                                                <input type="radio" id="radiobaterias1" name="baterias" value="1" required>
                                                                                <label for="radiobaterias1">
                                                                                    <i class="fas fa-thumbs-up"></i>
                                                                                </label>
                                                                            </div>

                                                                            <div class="icheck-danger d-inline">
                                                                                <input type="radio" id="radiobaterias2" name="baterias" value="0" required>
                                                                                <label for="radiobaterias2">
                                                                                    <i class="fas fa-thumbs-down"></i>
                                                                                </label>
                                                                            </div>
                                                                            <div class="icheck-warning d-inline">
                                                                                <input type="radio" id="radiobaterias3" name="baterias" value="2" required>
                                                                                <label for="radiobaterias3">
                                                                                    <i class="fas fa-ban"></i>
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr class="font-weight-bold">
                                                                    <th>Pito</th>
                                                                    <th>Rutero</th>
                                                                    <th>Cables y conexiones</th>
                                                                    <th>Fusibles</th>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <div class="form-group clearfix">
                                                                            <div class="icheck-success d-inline">
                                                                                <input type="radio" id="radiopito1" name="pito" value="1" required>
                                                                                <label for="radiopito1">
                                                                                    <i class="fas fa-thumbs-up"></i>
                                                                                </label>
                                                                            </div>

                                                                            <div class="icheck-danger d-inline">
                                                                                <input type="radio" id="radiopito2" name="pito" value="0" required>
                                                                                <label for="radiopito2">
                                                                                    <i class="fas fa-thumbs-down"></i>
                                                                                </label>
                                                                            </div>
                                                                            <div class="icheck-warning d-inline">
                                                                                <input type="radio" id="radiopito3" name="pito" value="2" required>
                                                                                <label for="radiopito3">
                                                                                    <i class="fas fa-ban"></i>
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="form-group clearfix">
                                                                            <div class="icheck-success d-inline">
                                                                                <input type="radio" id="radiorutero1" name="rutero" value="1" required>
                                                                                <label for="radiorutero1">
                                                                                    <i class="fas fa-thumbs-up"></i>
                                                                                </label>
                                                                            </div>

                                                                            <div class="icheck-danger d-inline">
                                                                                <input type="radio" id="radiorutero2" name="rutero" value="0" required>
                                                                                <label for="radiorutero2">
                                                                                    <i class="fas fa-thumbs-down"></i>
                                                                                </label>
                                                                            </div>
                                                                            <div class="icheck-warning d-inline">
                                                                                <input type="radio" id="radiorutero3" name="rutero" value="2" required>
                                                                                <label for="radiorutero3">
                                                                                    <i class="fas fa-ban"></i>
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="form-group clearfix">
                                                                            <div class="icheck-success d-inline">
                                                                                <input type="radio" id="radiocables_conexiones1" name="cables_conexiones" value="1" required>
                                                                                <label for="radiocables_conexiones1">
                                                                                    <i class="fas fa-thumbs-up"></i>
                                                                                </label>
                                                                            </div>

                                                                            <div class="icheck-danger d-inline">
                                                                                <input type="radio" id="radiocables_conexiones2" name="cables_conexiones" value="0" required>
                                                                                <label for="radiocables_conexiones2">
                                                                                    <i class="fas fa-thumbs-down"></i>
                                                                                </label>
                                                                            </div>
                                                                            <div class="icheck-warning d-inline">
                                                                                <input type="radio" id="radiocables_conexiones3" name="cables_conexiones" value="2" required>
                                                                                <label for="radiocables_conexiones3">
                                                                                    <i class="fas fa-ban"></i>
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="form-group clearfix">
                                                                            <div class="icheck-success d-inline">
                                                                                <input type="radio" id="radiofusibles1" name="fusibles" value="1" required>
                                                                                <label for="radiofusibles1">
                                                                                    <i class="fas fa-thumbs-up"></i>
                                                                                </label>
                                                                            </div>

                                                                            <div class="icheck-danger d-inline">
                                                                                <input type="radio" id="radiofusibles2" name="fusibles" value="0" required>
                                                                                <label for="radiofusibles2">
                                                                                    <i class="fas fa-thumbs-down"></i>
                                                                                </label>
                                                                            </div>
                                                                            <div class="icheck-warning d-inline">
                                                                                <input type="radio" id="radiofusibles3" name="fusibles" value="2" required>
                                                                                <label for="radiofusibles3">
                                                                                    <i class="fas fa-ban"></i>
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr class="font-weight-bold">
                                                                    <th>Presión de aceite motor</th>
                                                                    <th>Temperatura motor</th>
                                                                    <th>Velocímetro</th>
                                                                    <th>Nivel de combustible</th>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <div class="form-group clearfix">
                                                                            <div class="icheck-success d-inline">
                                                                                <input type="radio" id="radiopresion_aceite1" name="presion_aceite" value="1" required>
                                                                                <label for="radiopresion_aceite1">
                                                                                    <i class="fas fa-thumbs-up"></i>
                                                                                </label>
                                                                            </div>

                                                                            <div class="icheck-danger d-inline">
                                                                                <input type="radio" id="radiopresion_aceite2" name="presion_aceite" value="0" required>
                                                                                <label for="radiopresion_aceite2">
                                                                                    <i class="fas fa-thumbs-down"></i>
                                                                                </label>
                                                                            </div>
                                                                            <div class="icheck-warning d-inline">
                                                                                <input type="radio" id="radiopresion_aceite3" name="presion_aceite" value="2" required>
                                                                                <label for="radiopresion_aceite3">
                                                                                    <i class="fas fa-ban"></i>
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="form-group clearfix">
                                                                            <div class="icheck-success d-inline">
                                                                                <input type="radio" id="radiotemperatura_motor1" name="temperatura_motor" value="1" required>
                                                                                <label for="radiotemperatura_motor1">
                                                                                    <i class="fas fa-thumbs-up"></i>
                                                                                </label>
                                                                            </div>

                                                                            <div class="icheck-danger d-inline">
                                                                                <input type="radio" id="radiotemperatura_motor2" name="temperatura_motor" value="0" required>
                                                                                <label for="radiotemperatura_motor2">
                                                                                    <i class="fas fa-thumbs-down"></i>
                                                                                </label>
                                                                            </div>
                                                                            <div class="icheck-warning d-inline">
                                                                                <input type="radio" id="radiotemperatura_motor3" name="temperatura_motor" value="2" required>
                                                                                <label for="radiotemperatura_motor3">
                                                                                    <i class="fas fa-ban"></i>
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="form-group clearfix">
                                                                            <div class="icheck-success d-inline">
                                                                                <input type="radio" id="radiovelocimetro1" name="velocimetro" value="1" required>
                                                                                <label for="radiovelocimetro1">
                                                                                    <i class="fas fa-thumbs-up"></i>
                                                                                </label>
                                                                            </div>

                                                                            <div class="icheck-danger d-inline">
                                                                                <input type="radio" id="radiovelocimetro2" name="velocimetro" value="0" required>
                                                                                <label for="radiovelocimetro2">
                                                                                    <i class="fas fa-thumbs-down"></i>
                                                                                </label>
                                                                            </div>
                                                                            <div class="icheck-warning d-inline">
                                                                                <input type="radio" id="radiovelocimetro3" name="velocimetro" value="2" required>
                                                                                <label for="radiovelocimetro3">
                                                                                    <i class="fas fa-ban"></i>
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="form-group clearfix">
                                                                            <div class="icheck-success d-inline">
                                                                                <input type="radio" id="radionivel_combustible1" name="nivel_combustible" value="1" required>
                                                                                <label for="radionivel_combustible1">
                                                                                    <i class="fas fa-thumbs-up"></i>
                                                                                </label>
                                                                            </div>

                                                                            <div class="icheck-danger d-inline">
                                                                                <input type="radio" id="radionivel_combustible2" name="nivel_combustible" value="0" required>
                                                                                <label for="radionivel_combustible2">
                                                                                    <i class="fas fa-thumbs-down"></i>
                                                                                </label>
                                                                            </div>
                                                                            <div class="icheck-warning d-inline">
                                                                                <input type="radio" id="radionivel_combustible3" name="nivel_combustible" value="2" required>
                                                                                <label for="radionivel_combustible3">
                                                                                    <i class="fas fa-ban"></i>
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr class="font-weight-bold">
                                                                    <th>Presión de aire</th>
                                                                    <th>Carga bateria</th>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <div class="form-group clearfix">
                                                                            <div class="icheck-success d-inline">
                                                                                <input type="radio" id="radiopresion_aire1" name="presion_aire" value="1" required>
                                                                                <label for="radiopresion_aire1">
                                                                                    <i class="fas fa-thumbs-up"></i>
                                                                                </label>
                                                                            </div>

                                                                            <div class="icheck-danger d-inline">
                                                                                <input type="radio" id="radiopresion_aire2" name="presion_aire" value="0" required>
                                                                                <label for="radiopresion_aire2">
                                                                                    <i class="fas fa-thumbs-down"></i>
                                                                                </label>
                                                                            </div>
                                                                            <div class="icheck-warning d-inline">
                                                                                <input type="radio" id="radiopresion_aire3" name="presion_aire" value="2" required>
                                                                                <label for="radiopresion_aire3">
                                                                                    <i class="fas fa-ban"></i>
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="form-group clearfix">
                                                                            <div class="icheck-success d-inline">
                                                                                <input type="radio" id="radiocarga_bateria1" name="carga_bateria" value="1" required>
                                                                                <label for="radiocarga_bateria1">
                                                                                    <i class="fas fa-thumbs-up"></i>
                                                                                </label>
                                                                            </div>

                                                                            <div class="icheck-danger d-inline">
                                                                                <input type="radio" id="radiocarga_bateria2" name="carga_bateria" value="0" required>
                                                                                <label for="radiocarga_bateria2">
                                                                                    <i class="fas fa-thumbs-down"></i>
                                                                                </label>
                                                                            </div>
                                                                            <div class="icheck-warning d-inline">
                                                                                <input type="radio" id="radiocarga_bateria3" name="carga_bateria" value="2" required>
                                                                                <label for="radiocarga_bateria3">
                                                                                    <i class="fas fa-ban"></i>
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                    </table>
                                                </div>
                                            </div>

                                            <!-- TAB CARROCERIA -->
                                            <div class="tab-pane fade show" id="custom-tabs-two-carroceria" role="tabpanel" aria-labelledby="custom-tabs-two-carroceria">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered text-center border-danger" nombre = "Sistema potencia">
                                                            <thead class="text-nowrap">
                                                                <tr class="font-weight-bold">
                                                                    <th>Techo exterior</th>
                                                                    <th>Techo interior</th>
                                                                    <th>Bomper delantero</th>
                                                                    <th>Bomper trasero</th>
                                                                </tr>
                                                            </thead>

                                                            <tr>
                                                                <td>
                                                                        <div class="form-group clearfix">
                                                                            <div class="icheck-success d-inline">
                                                                                <input type="radio" id="radiotecho_exterior1" name="techo_exterior" value="1" required>
                                                                                <label for="radiotecho_exterior1">
                                                                                    <i class="fas fa-thumbs-up"></i>
                                                                                </label>
                                                                            </div>

                                                                            <div class="icheck-danger d-inline">
                                                                                <input type="radio" id="radiotecho_exterior2" name="techo_exterior" value="0" required>
                                                                                <label for="radiotecho_exterior2">
                                                                                    <i class="fas fa-thumbs-down"></i>
                                                                                </label>
                                                                            </div>
                                                                            <div class="icheck-warning d-inline">
                                                                                <input type="radio" id="radiotecho_exterior3" name="techo_exterior" value="2" required>
                                                                                <label for="radiotecho_exterior3">
                                                                                    <i class="fas fa-ban"></i>
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="form-group clearfix">
                                                                            <div class="icheck-success d-inline">
                                                                                <input type="radio" id="radiotecho_interior1" name="techo_interior" value="1" required>
                                                                                <label for="radiotecho_interior1">
                                                                                    <i class="fas fa-thumbs-up"></i>
                                                                                </label>
                                                                            </div>

                                                                            <div class="icheck-danger d-inline">
                                                                                <input type="radio" id="radiotecho_interior2" name="techo_interior" value="0" required>
                                                                                <label for="radiotecho_interior2">
                                                                                    <i class="fas fa-thumbs-down"></i>
                                                                                </label>
                                                                            </div>
                                                                            <div class="icheck-warning d-inline">
                                                                                <input type="radio" id="radiotecho_interior3" name="techo_interior" value="2" required>
                                                                                <label for="radiotecho_interior3">
                                                                                    <i class="fas fa-ban"></i>
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="form-group clearfix">
                                                                            <div class="icheck-success d-inline">
                                                                                <input type="radio" id="radiobomper_delantero1" name="bomper_delantero" value="1" required>
                                                                                <label for="radiobomper_delantero1">
                                                                                    <i class="fas fa-thumbs-up"></i>
                                                                                </label>
                                                                            </div>

                                                                            <div class="icheck-danger d-inline">
                                                                                <input type="radio" id="radiobomper_delantero2" name="bomper_delantero" value="0" required>
                                                                                <label for="radiobomper_delantero2">
                                                                                    <i class="fas fa-thumbs-down"></i>
                                                                                </label>
                                                                            </div>
                                                                            <div class="icheck-warning d-inline">
                                                                                <input type="radio" id="radiobomper_delantero3" name="bomper_delantero" value="2" required>
                                                                                <label for="radiobomper_delantero3">
                                                                                    <i class="fas fa-ban"></i>
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="form-group clearfix">
                                                                            <div class="icheck-success d-inline">
                                                                                <input type="radio" id="radiobomper_trasero1" name="bomper_trasero" value="1" required>
                                                                                <label for="radiobomper_trasero1">
                                                                                    <i class="fas fa-thumbs-up"></i>
                                                                                </label>
                                                                            </div>

                                                                            <div class="icheck-danger d-inline">
                                                                                <input type="radio" id="radiobomper_trasero2" name="bomper_trasero" value="0" required>
                                                                                <label for="radiobomper_trasero2">
                                                                                    <i class="fas fa-thumbs-down"></i>
                                                                                </label>
                                                                            </div>
                                                                            <div class="icheck-warning d-inline">
                                                                                <input type="radio" id="radiobomper_trasero3" name="bomper_trasero" value="2" required>
                                                                                <label for="radiobomper_trasero3">
                                                                                    <i class="fas fa-ban"></i>
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                            </tr>


                                                            <tbody class="text-nowrap">
                                                                <tr class="font-weight-bold">
                                                                    <th>Frente</th>
                                                                    <th>Lamina lateral derecho</th>
                                                                    <th>Lamina lateral izquierdo</th>
                                                                    <th>Estado de puerta principal</th>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <div class="form-group clearfix">
                                                                            <div class="icheck-success d-inline">
                                                                                <input type="radio" id="radioFrente1" name="Frente" value="1" required>
                                                                                <label for="radioFrente1">
                                                                                    <i class="fas fa-thumbs-up"></i>
                                                                                </label>
                                                                            </div>

                                                                            <div class="icheck-danger d-inline">
                                                                                <input type="radio" id="radioFrente2" name="Frente" value="0" required>
                                                                                <label for="radioFrente2">
                                                                                    <i class="fas fa-thumbs-down"></i>
                                                                                </label>
                                                                            </div>
                                                                            <div class="icheck-warning d-inline">
                                                                                <input type="radio" id="radioFrente3" name="Frente" value="2" required>
                                                                                <label for="radioFrente3">
                                                                                    <i class="fas fa-ban"></i>
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="form-group clearfix">
                                                                            <div class="icheck-success d-inline">
                                                                                <input type="radio" id="radiolamina_lateral_derecho1" name="lamina_lateral_derecho" value="1" required>
                                                                                <label for="radiolamina_lateral_derecho1">
                                                                                    <i class="fas fa-thumbs-up"></i>
                                                                                </label>
                                                                            </div>

                                                                            <div class="icheck-danger d-inline">
                                                                                <input type="radio" id="radiolamina_lateral_derecho2" name="lamina_lateral_derecho" value="0" required>
                                                                                <label for="radiolamina_lateral_derecho2">
                                                                                    <i class="fas fa-thumbs-down"></i>
                                                                                </label>
                                                                            </div>
                                                                            <div class="icheck-warning d-inline">
                                                                                <input type="radio" id="radiolamina_lateral_derecho3" name="lamina_lateral_derecho" value="2" required>
                                                                                <label for="radiolamina_lateral_derecho3">
                                                                                    <i class="fas fa-ban"></i>
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="form-group clearfix">
                                                                            <div class="icheck-success d-inline">
                                                                                <input type="radio" id="radiolamina_lateral_izquierdo1" name="lamina_lateral_izquierdo" value="1" required>
                                                                                <label for="radiolamina_lateral_izquierdo1">
                                                                                    <i class="fas fa-thumbs-up"></i>
                                                                                </label>
                                                                            </div>

                                                                            <div class="icheck-danger d-inline">
                                                                                <input type="radio" id="radiolamina_lateral_izquierdo2" name="lamina_lateral_izquierdo" value="0" required>
                                                                                <label for="radiolamina_lateral_izquierdo2">
                                                                                    <i class="fas fa-thumbs-down"></i>
                                                                                </label>
                                                                            </div>
                                                                            <div class="icheck-warning d-inline">
                                                                                <input type="radio" id="radiolamina_lateral_izquierdo3" name="lamina_lateral_izquierdo" value="2" required>
                                                                                <label for="radiolamina_lateral_izquierdo3">
                                                                                    <i class="fas fa-ban"></i>
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="form-group clearfix">
                                                                            <div class="icheck-success d-inline">
                                                                                <input type="radio" id="radiopuerta_principal1" name="puerta_principal" value="1" required>
                                                                                <label for="radiopuerta_principal1">
                                                                                    <i class="fas fa-thumbs-up"></i>
                                                                                </label>
                                                                            </div>

                                                                            <div class="icheck-danger d-inline">
                                                                                <input type="radio" id="radiopuerta_principal2" name="puerta_principal" value="0" required>
                                                                                <label for="radiopuerta_principal2">
                                                                                    <i class="fas fa-thumbs-down"></i>
                                                                                </label>
                                                                            </div>
                                                                            <div class="icheck-warning d-inline">
                                                                                <input type="radio" id="radiopuerta_principal3" name="puerta_principal" value="2" required>
                                                                                <label for="radiopuerta_principal3">
                                                                                    <i class="fas fa-ban"></i>
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr class="font-weight-bold">
                                                                    <th>Estado de puerta lateral</th>
                                                                    <th>Estribos de puertas</th>
                                                                    <th>Sillas</th>
                                                                    <th>Descansabrazos</th>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <div class="form-group clearfix">
                                                                            <div class="icheck-success d-inline">
                                                                                <input type="radio" id="radiopuerta_lateral1" name="puerta_lateral" value="1" required>
                                                                                <label for="radiopuerta_lateral1">
                                                                                    <i class="fas fa-thumbs-up"></i>
                                                                                </label>
                                                                            </div>

                                                                            <div class="icheck-danger d-inline">
                                                                                <input type="radio" id="radiopuerta_lateral2" name="puerta_lateral" value="0" required>
                                                                                <label for="radiopuerta_lateral2">
                                                                                    <i class="fas fa-thumbs-down"></i>
                                                                                </label>
                                                                            </div>
                                                                            <div class="icheck-warning d-inline">
                                                                                <input type="radio" id="radiopuerta_lateral3" name="puerta_lateral" value="2" required>
                                                                                <label for="radiopuerta_lateral3">
                                                                                    <i class="fas fa-ban"></i>
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="form-group clearfix">
                                                                            <div class="icheck-success d-inline">
                                                                                <input type="radio" id="radioestribos_puerta1" name="estribos_puerta" value="1" required>
                                                                                <label for="radioestribos_puerta1">
                                                                                    <i class="fas fa-thumbs-up"></i>
                                                                                </label>
                                                                            </div>

                                                                            <div class="icheck-danger d-inline">
                                                                                <input type="radio" id="radioestribos_puerta2" name="estribos_puerta" value="0" required>
                                                                                <label for="radioestribos_puerta2">
                                                                                    <i class="fas fa-thumbs-down"></i>
                                                                                </label>
                                                                            </div>
                                                                            <div class="icheck-warning d-inline">
                                                                                <input type="radio" id="radioestribos_puerta3" name="estribos_puerta" value="2" required>
                                                                                <label for="radioestribos_puerta3">
                                                                                    <i class="fas fa-ban"></i>
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="form-group clearfix">
                                                                            <div class="icheck-success d-inline">
                                                                                <input type="radio" id="radiosillas1" name="sillas" value="1" required>
                                                                                <label for="radiosillas1">
                                                                                    <i class="fas fa-thumbs-up"></i>
                                                                                </label>
                                                                            </div>

                                                                            <div class="icheck-danger d-inline">
                                                                                <input type="radio" id="radiosillas2" name="sillas" value="0" required>
                                                                                <label for="radiosillas2">
                                                                                    <i class="fas fa-thumbs-down"></i>
                                                                                </label>
                                                                            </div>
                                                                            <div class="icheck-warning d-inline">
                                                                                <input type="radio" id="radiosillas3" name="sillas" value="2" required>
                                                                                <label for="radiosillas3">
                                                                                    <i class="fas fa-ban"></i>
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="form-group clearfix">
                                                                            <div class="icheck-success d-inline">
                                                                                <input type="radio" id="radiodescansa_brazos1" name="descansa_brazos" value="1" required>
                                                                                <label for="radiodescansa_brazos1">
                                                                                    <i class="fas fa-thumbs-up"></i>
                                                                                </label>
                                                                            </div>

                                                                            <div class="icheck-danger d-inline">
                                                                                <input type="radio" id="radiodescansa_brazos2" name="descansa_brazos" value="0" required>
                                                                                <label for="radiodescansa_brazos2">
                                                                                    <i class="fas fa-thumbs-down"></i>
                                                                                </label>
                                                                            </div>
                                                                            <div class="icheck-warning d-inline">
                                                                                <input type="radio" id="radiodescansa_brazos3" name="descansa_brazos" value="2" required>
                                                                                <label for="radiodescansa_brazos3">
                                                                                    <i class="fas fa-ban"></i>
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr class="font-weight-bold">
                                                                    <th>Bocallanta</th>
                                                                    <th>Guardapolvos</th>
                                                                    <th>Piso</th>
                                                                    <th>Parabrisas derecho</th>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <div class="form-group clearfix">
                                                                            <div class="icheck-success d-inline">
                                                                                <input type="radio" id="radiobocallanta1" name="bocallanta" value="1" required>
                                                                                <label for="radiobocallanta1">
                                                                                    <i class="fas fa-thumbs-up"></i>
                                                                                </label>
                                                                            </div>

                                                                            <div class="icheck-danger d-inline">
                                                                                <input type="radio" id="radiobocallanta2" name="bocallanta" value="0" required>
                                                                                <label for="radiobocallanta2">
                                                                                    <i class="fas fa-thumbs-down"></i>
                                                                                </label>
                                                                            </div>
                                                                            <div class="icheck-warning d-inline">
                                                                                <input type="radio" id="radiobocallanta3" name="bocallanta" value="2" required>
                                                                                <label for="radiobocallanta3">
                                                                                    <i class="fas fa-ban"></i>
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="form-group clearfix">
                                                                            <div class="icheck-success d-inline">
                                                                                <input type="radio" id="radioguardapolvos1" name="guardapolvos" value="1" required>
                                                                                <label for="radioguardapolvos1">
                                                                                    <i class="fas fa-thumbs-up"></i>
                                                                                </label>
                                                                            </div>

                                                                            <div class="icheck-danger d-inline">
                                                                                <input type="radio" id="radioguardapolvos2" name="guardapolvos" value="0" required>
                                                                                <label for="radioguardapolvos2">
                                                                                    <i class="fas fa-thumbs-down"></i>
                                                                                </label>
                                                                            </div>
                                                                            <div class="icheck-warning d-inline">
                                                                                <input type="radio" id="radioguardapolvos3" name="guardapolvos" value="2" required>
                                                                                <label for="radioguardapolvos3">
                                                                                    <i class="fas fa-ban"></i>
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="form-group clearfix">
                                                                            <div class="icheck-success d-inline">
                                                                                <input type="radio" id="radiopiso1" name="piso" value="1" required>
                                                                                <label for="radiopiso1">
                                                                                    <i class="fas fa-thumbs-up"></i>
                                                                                </label>
                                                                            </div>

                                                                            <div class="icheck-danger d-inline">
                                                                                <input type="radio" id="radiopiso2" name="piso" value="0" required>
                                                                                <label for="radiopiso2">
                                                                                    <i class="fas fa-thumbs-down"></i>
                                                                                </label>
                                                                            </div>
                                                                            <div class="icheck-warning d-inline">
                                                                                <input type="radio" id="radiopiso3" name="piso" value="2" required>
                                                                                <label for="radiopiso3">
                                                                                    <i class="fas fa-ban"></i>
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="form-group clearfix">
                                                                            <div class="icheck-success d-inline">
                                                                                <input type="radio" id="radioparabrizas_derecho1" name="parabrizas_derecho" value="1" required>
                                                                                <label for="radioparabrizas_derecho1">
                                                                                    <i class="fas fa-thumbs-up"></i>
                                                                                </label>
                                                                            </div>

                                                                            <div class="icheck-danger d-inline">
                                                                                <input type="radio" id="radioparabrizas_derecho2" name="parabrizas_derecho" value="0" required>
                                                                                <label for="radioparabrizas_derecho2">
                                                                                    <i class="fas fa-thumbs-down"></i>
                                                                                </label>
                                                                            </div>
                                                                            <div class="icheck-warning d-inline">
                                                                                <input type="radio" id="radioparabrizas_derecho3" name="parabrizas_derecho" value="2" required>
                                                                                <label for="radioparabrizas_derecho3">
                                                                                    <i class="fas fa-ban"></i>
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr class="font-weight-bold">
                                                                    <th>Brazo limpiaparabrizas derecho</th>
                                                                    <th>Plumillas limpiaparabrisas derecho</th>
                                                                    <th>Parabrizas izquierdo</th>
                                                                    <th>Brazo limpiaparabrizas izquierdo</th>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <div class="form-group clearfix">
                                                                            <div class="icheck-success d-inline">
                                                                                <input type="radio" id="radiobrazo_limpiaparabrisas_derecho1" name="brazo_limpiaparabrisas_derecho" value="1" required>
                                                                                <label for="radiobrazo_limpiaparabrisas_derecho1">
                                                                                    <i class="fas fa-thumbs-up"></i>
                                                                                </label>
                                                                            </div>

                                                                            <div class="icheck-danger d-inline">
                                                                                <input type="radio" id="radiobrazo_limpiaparabrisas_derecho2" name="brazo_limpiaparabrisas_derecho" value="0" required>
                                                                                <label for="radiobrazo_limpiaparabrisas_derecho2">
                                                                                    <i class="fas fa-thumbs-down"></i>
                                                                                </label>
                                                                            </div>
                                                                            <div class="icheck-warning d-inline">
                                                                                <input type="radio" id="radiobrazo_limpiaparabrisas_derecho3" name="brazo_limpiaparabrisas_derecho" value="2" required>
                                                                                <label for="radiobrazo_limpiaparabrisas_derecho3">
                                                                                    <i class="fas fa-ban"></i>
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="form-group clearfix">
                                                                            <div class="icheck-success d-inline">
                                                                                <input type="radio" id="radioplumillas_limpiaparabrisas_derecho1" name="plumillas_limpiaparabrisas_derecho" value="1" required>
                                                                                <label for="radioplumillas_limpiaparabrisas_derecho1">
                                                                                    <i class="fas fa-thumbs-up"></i>
                                                                                </label>
                                                                            </div>

                                                                            <div class="icheck-danger d-inline">
                                                                                <input type="radio" id="radioplumillas_limpiaparabrisas_derecho2" name="plumillas_limpiaparabrisas_derecho" value="0" required>
                                                                                <label for="radioplumillas_limpiaparabrisas_derecho2">
                                                                                    <i class="fas fa-thumbs-down"></i>
                                                                                </label>
                                                                            </div>
                                                                            <div class="icheck-warning d-inline">
                                                                                <input type="radio" id="radioplumillas_limpiaparabrisas_derecho3" name="plumillas_limpiaparabrisas_derecho" value="2" required>
                                                                                <label for="radioplumillas_limpiaparabrisas_derecho3">
                                                                                    <i class="fas fa-ban"></i>
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="form-group clearfix">
                                                                            <div class="icheck-success d-inline">
                                                                                <input type="radio" id="radioparabrisas_izquierdo1" name="parabrisas_izquierdo" value="1" required>
                                                                                <label for="radioparabrisas_izquierdo1">
                                                                                    <i class="fas fa-thumbs-up"></i>
                                                                                </label>
                                                                            </div>

                                                                            <div class="icheck-danger d-inline">
                                                                                <input type="radio" id="radioparabrisas_izquierdo2" name="parabrisas_izquierdo" value="0" required>
                                                                                <label for="radioparabrisas_izquierdo2">
                                                                                    <i class="fas fa-thumbs-down"></i>
                                                                                </label>
                                                                            </div>
                                                                            <div class="icheck-warning d-inline">
                                                                                <input type="radio" id="radioparabrisas_izquierdo3" name="parabrisas_izquierdo" value="2" required>
                                                                                <label for="radioparabrisas_izquierdo3">
                                                                                    <i class="fas fa-ban"></i>
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="form-group clearfix">
                                                                            <div class="icheck-success d-inline">
                                                                                <input type="radio" id="radiobrazo_limpiaparabrisas_izquierdo1" name="brazo_limpiaparabrisas_izquierdo" value="1" required>
                                                                                <label for="radiobrazo_limpiaparabrisas_izquierdo1">
                                                                                    <i class="fas fa-thumbs-up"></i>
                                                                                </label>
                                                                            </div>

                                                                            <div class="icheck-danger d-inline">
                                                                                <input type="radio" id="radiobrazo_limpiaparabrisas_izquierdo2" name="brazo_limpiaparabrisas_izquierdo" value="0" required>
                                                                                <label for="radiobrazo_limpiaparabrisas_izquierdo2">
                                                                                    <i class="fas fa-thumbs-down"></i>
                                                                                </label>
                                                                            </div>
                                                                            <div class="icheck-warning d-inline">
                                                                                <input type="radio" id="radiobrazo_limpiaparabrisas_izquierdo3" name="brazo_limpiaparabrisas_izquierdo" value="2" required>
                                                                                <label for="radiobrazo_limpiaparabrisas_izquierdo3">
                                                                                    <i class="fas fa-ban"></i>
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr class="font-weight-bold">
                                                                    <th>Plumillas limpiaparabrizas izquierdo</th>
                                                                    <th>Espejo retrovisor derecho</th>
                                                                    <th>Espejo retrovisor izquierdo</th>
                                                                    <th>Espejo central</th>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <div class="form-group clearfix">
                                                                            <div class="icheck-success d-inline">
                                                                                <input type="radio" id="radioplumillas_limpiaparabrisas_izquierdo1" name="plumillas_limpiaparabrisas_izquierdo" value="1" required>
                                                                                <label for="radioplumillas_limpiaparabrisas_izquierdo1">
                                                                                    <i class="fas fa-thumbs-up"></i>
                                                                                </label>
                                                                            </div>

                                                                            <div class="icheck-danger d-inline">
                                                                                <input type="radio" id="radioplumillas_limpiaparabrisas_izquierdo2" name="plumillas_limpiaparabrisas_izquierdo" value="0" required>
                                                                                <label for="radioplumillas_limpiaparabrisas_izquierdo2">
                                                                                    <i class="fas fa-thumbs-down"></i>
                                                                                </label>
                                                                            </div>
                                                                            <div class="icheck-warning d-inline">
                                                                                <input type="radio" id="radioplumillas_limpiaparabrisas_izquierdo3" name="plumillas_limpiaparabrisas_izquierdo" value="2" required>
                                                                                <label for="radioplumillas_limpiaparabrisas_izquierdo3">
                                                                                    <i class="fas fa-ban"></i>
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="form-group clearfix">
                                                                            <div class="icheck-success d-inline">
                                                                                <input type="radio" id="radioespejo_retrovisor_derecho1" name="espejo_retrovisor_derecho" value="1" required>
                                                                                <label for="radioespejo_retrovisor_derecho1">
                                                                                    <i class="fas fa-thumbs-up"></i>
                                                                                </label>
                                                                            </div>

                                                                            <div class="icheck-danger d-inline">
                                                                                <input type="radio" id="radioespejo_retrovisor_derecho2" name="espejo_retrovisor_derecho" value="0" required>
                                                                                <label for="radioespejo_retrovisor_derecho2">
                                                                                    <i class="fas fa-thumbs-down"></i>
                                                                                </label>
                                                                            </div>
                                                                            <div class="icheck-warning d-inline">
                                                                                <input type="radio" id="radioespejo_retrovisor_derecho3" name="espejo_retrovisor_derecho" value="2" required>
                                                                                <label for="radioespejo_retrovisor_derecho3">
                                                                                    <i class="fas fa-ban"></i>
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="form-group clearfix">
                                                                            <div class="icheck-success d-inline">
                                                                                <input type="radio" id="radioespejo_retrovisor_izquierdo1" name="espejo_retrovisor_izquierdo" value="1" required>
                                                                                <label for="radioespejo_retrovisor_izquierdo1">
                                                                                    <i class="fas fa-thumbs-up"></i>
                                                                                </label>
                                                                            </div>

                                                                            <div class="icheck-danger d-inline">
                                                                                <input type="radio" id="radioespejo_retrovisor_izquierdo2" name="espejo_retrovisor_izquierdo" value="0" required>
                                                                                <label for="radioespejo_retrovisor_izquierdo2">
                                                                                    <i class="fas fa-thumbs-down"></i>
                                                                                </label>
                                                                            </div>
                                                                            <div class="icheck-warning d-inline">
                                                                                <input type="radio" id="radioespejo_retrovisor_izquierdo3" name="espejo_retrovisor_izquierdo" value="2" required>
                                                                                <label for="radioespejo_retrovisor_izquierdo3">
                                                                                    <i class="fas fa-ban"></i>
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="form-group clearfix">
                                                                            <div class="icheck-success d-inline">
                                                                                <input type="radio" id="radioespejo_central1" name="espejo_central" value="1" required>
                                                                                <label for="radioespejo_central1">
                                                                                    <i class="fas fa-thumbs-up"></i>
                                                                                </label>
                                                                            </div>

                                                                            <div class="icheck-danger d-inline">
                                                                                <input type="radio" id="radioespejo_central2" name="espejo_central" value="0" required>
                                                                                <label for="radioespejo_central2">
                                                                                    <i class="fas fa-thumbs-down"></i>
                                                                                </label>
                                                                            </div>
                                                                            <div class="icheck-warning d-inline">
                                                                                <input type="radio" id="radioespejo_central3" name="espejo_central" value="2" required>
                                                                                <label for="radioespejo_central3">
                                                                                    <i class="fas fa-ban"></i>
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr class="font-weight-bold">
                                                                    <th>Ventanas laterlas lado derecho</th>
                                                                    <th>Ventanas laterlas lado izquierdo</th>
                                                                    <th>Parabrisas trasero</th>
                                                                    <th>Vidrios de puerta principal</th>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <div class="form-group clearfix">
                                                                            <div class="icheck-success d-inline">
                                                                                <input type="radio" id="radioventanas_lado_derecho1" name="ventanas_lado_derecho" value="1" required>
                                                                                <label for="radioventanas_lado_derecho1">
                                                                                    <i class="fas fa-thumbs-up"></i>
                                                                                </label>
                                                                            </div>

                                                                            <div class="icheck-danger d-inline">
                                                                                <input type="radio" id="radioventanas_lado_derecho2" name="ventanas_lado_derecho" value="0" required>
                                                                                <label for="radioventanas_lado_derecho2">
                                                                                    <i class="fas fa-thumbs-down"></i>
                                                                                </label>
                                                                            </div>
                                                                            <div class="icheck-warning d-inline">
                                                                                <input type="radio" id="radioventanas_lado_derecho3" name="ventanas_lado_derecho" value="2" required>
                                                                                <label for="radioventanas_lado_derecho3">
                                                                                    <i class="fas fa-ban"></i>
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="form-group clearfix">
                                                                            <div class="icheck-success d-inline">
                                                                                <input type="radio" id="radioventanas_lado_izquierdo1" name="ventanas_lado_izquierdo" value="1" required>
                                                                                <label for="radioventanas_lado_izquierdo1">
                                                                                    <i class="fas fa-thumbs-up"></i>
                                                                                </label>
                                                                            </div>

                                                                            <div class="icheck-danger d-inline">
                                                                                <input type="radio" id="radioventanas_lado_izquierdo2" name="ventanas_lado_izquierdo" value="0" required>
                                                                                <label for="radioventanas_lado_izquierdo2">
                                                                                    <i class="fas fa-thumbs-down"></i>
                                                                                </label>
                                                                            </div>
                                                                            <div class="icheck-warning d-inline">
                                                                                <input type="radio" id="radioventanas_lado_izquierdo3" name="ventanas_lado_izquierdo" value="2" required>
                                                                                <label for="radioventanas_lado_izquierdo3">
                                                                                    <i class="fas fa-ban"></i>
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="form-group clearfix">
                                                                            <div class="icheck-success d-inline">
                                                                                <input type="radio" id="radioparabrisas_trasero1" name="parabrisas_trasero" value="1" required>
                                                                                <label for="radioparabrisas_trasero1">
                                                                                    <i class="fas fa-thumbs-up"></i>
                                                                                </label>
                                                                            </div>

                                                                            <div class="icheck-danger d-inline">
                                                                                <input type="radio" id="radioparabrisas_trasero2" name="parabrisas_trasero" value="0" required>
                                                                                <label for="radioparabrisas_trasero2">
                                                                                    <i class="fas fa-thumbs-down"></i>
                                                                                </label>
                                                                            </div>
                                                                            <div class="icheck-warning d-inline">
                                                                                <input type="radio" id="radioparabrisas_trasero3" name="parabrisas_trasero" value="2" required>
                                                                                <label for="radioparabrisas_trasero3">
                                                                                    <i class="fas fa-ban"></i>
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="form-group clearfix">
                                                                            <div class="icheck-success d-inline">
                                                                                <input type="radio" id="radiovidrio_puerta_principal1" name="vidrio_puerta_principal" value="1" required>
                                                                                <label for="radiovidrio_puerta_principal1">
                                                                                    <i class="fas fa-thumbs-up"></i>
                                                                                </label>
                                                                            </div>

                                                                            <div class="icheck-danger d-inline">
                                                                                <input type="radio" id="radiovidrio_puerta_principal2" name="vidrio_puerta_principal" value="0" required>
                                                                                <label for="radiovidrio_puerta_principal2">
                                                                                    <i class="fas fa-thumbs-down"></i>
                                                                                </label>
                                                                            </div>
                                                                            <div class="icheck-warning d-inline">
                                                                                <input type="radio" id="radiovidrio_puerta_principal3" name="vidrio_puerta_principal" value="2" required>
                                                                                <label for="radiovidrio_puerta_principal3">
                                                                                    <i class="fas fa-ban"></i>
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="form-group clearfix">
                                                                            <div class="icheck-success d-inline">
                                                                                <input type="radio" id="radiovidrio_segunda_puerta1" name="vidrio_segunda_puerta" value="1" required>
                                                                                <label for="radiovidrio_segunda_puerta1">
                                                                                    <i class="fas fa-thumbs-up"></i>
                                                                                </label>
                                                                            </div>

                                                                            <div class="icheck-danger d-inline">
                                                                                <input type="radio" id="radiovidrio_segunda_puerta2" name="vidrio_segunda_puerta" value="0" required>
                                                                                <label for="radiovidrio_segunda_puerta2">
                                                                                    <i class="fas fa-thumbs-down"></i>
                                                                                </label>
                                                                            </div>
                                                                            <div class="icheck-warning d-inline">
                                                                                <input type="radio" id="radiovidrio_segunda_puerta3" name="vidrio_segunda_puerta" value="2" required>
                                                                                <label for="radiovidrio_segunda_puerta3">
                                                                                    <i class="fas fa-ban"></i>
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr class="font-weight-bold">
                                                                    <th>Vidrios de segunda puerta</th>
                                                                </tr>
                                                            </tbody>
                                                    </table>
                                                </div>
                                            </div>

                                            <!-- TAB ACCESORIOS Y OTROS -->
                                            <div class="tab-pane fade show" id="custom-tabs-two-accesorios" role="tabpanel" aria-labelledby="custom-tabs-two-accesorios">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered text-center border-danger" nombre = "Sistema potencia">
                                                            <thead class="text-nowrap">
                                                                <tr class="font-weight-bold">
                                                                    <th>Manijas y ventanas</th>
                                                                    <th>Claraboyas</th>
                                                                    <th>Airbag</th>
                                                                    <th>Aire acondicionado</th>
                                                                </tr>
                                                            </thead>

                                                            <tr>
                                                                <td>
                                                                        <div class="form-group clearfix">
                                                                            <div class="icheck-success d-inline">
                                                                                <input type="radio" id="radiomanijas1" name="manijas" value="1" required>
                                                                                <label for="radiomanijas1">
                                                                                    <i class="fas fa-thumbs-up"></i>
                                                                                </label>
                                                                            </div>

                                                                            <div class="icheck-danger d-inline">
                                                                                <input type="radio" id="radiomanijas2" name="manijas" value="0" required>
                                                                                <label for="radiomanijas2">
                                                                                    <i class="fas fa-thumbs-down"></i>
                                                                                </label>
                                                                            </div>
                                                                            <div class="icheck-warning d-inline">
                                                                                <input type="radio" id="radiomanijas3" name="manijas" value="2" required>
                                                                                <label for="radiomanijas3">
                                                                                    <i class="fas fa-ban"></i>
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="form-group clearfix">
                                                                            <div class="icheck-success d-inline">
                                                                                <input type="radio" id="radioclaraboyas1" name="claraboyas" value="1" required>
                                                                                <label for="radioclaraboyas1">
                                                                                    <i class="fas fa-thumbs-up"></i>
                                                                                </label>
                                                                            </div>

                                                                            <div class="icheck-danger d-inline">
                                                                                <input type="radio" id="radioclaraboyas2" name="claraboyas" value="0" required>
                                                                                <label for="radioclaraboyas2">
                                                                                    <i class="fas fa-thumbs-down"></i>
                                                                                </label>
                                                                            </div>
                                                                            <div class="icheck-warning d-inline">
                                                                                <input type="radio" id="radioclaraboyas3" name="claraboyas" value="2" required>
                                                                                <label for="radioclaraboyas3">
                                                                                    <i class="fas fa-ban"></i>
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="form-group clearfix">
                                                                            <div class="icheck-success d-inline">
                                                                                <input type="radio" id="radioairbag1" name="airbag" value="1" required>
                                                                                <label for="radioairbag1">
                                                                                    <i class="fas fa-thumbs-up"></i>
                                                                                </label>
                                                                            </div>

                                                                            <div class="icheck-danger d-inline">
                                                                                <input type="radio" id="radioairbag2" name="airbag" value="0" required>
                                                                                <label for="radioairbag2">
                                                                                    <i class="fas fa-thumbs-down"></i>
                                                                                </label>
                                                                            </div>
                                                                            <div class="icheck-warning d-inline">
                                                                                <input type="radio" id="radioairbag3" name="airbag" value="2" required>
                                                                                <label for="radioairbag3">
                                                                                    <i class="fas fa-ban"></i>
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="form-group clearfix">
                                                                            <div class="icheck-success d-inline">
                                                                                <input type="radio" id="radioaire_acondicionado1" name="aire_acondicionado" value="1" required>
                                                                                <label for="radioaire_acondicionado1">
                                                                                    <i class="fas fa-thumbs-up"></i>
                                                                                </label>
                                                                            </div>

                                                                            <div class="icheck-danger d-inline">
                                                                                <input type="radio" id="radioaire_acondicionado2" name="aire_acondicionado" value="0" required>
                                                                                <label for="radioaire_acondicionado2">
                                                                                    <i class="fas fa-thumbs-down"></i>
                                                                                </label>
                                                                            </div>
                                                                            <div class="icheck-warning d-inline">
                                                                                <input type="radio" id="radioaire_acondicionado3" name="aire_acondicionado" value="2" required>
                                                                                <label for="radioaire_acondicionado3">
                                                                                    <i class="fas fa-ban"></i>
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                            </tr>


                                                            <tbody class="text-nowrap">
                                                                <tr class="font-weight-bold">
                                                                    <th>Limpieza</th>
                                                                    <th>Chapas de puertas</th>
                                                                    <th>Parales</th>
                                                                    <th>Booster de puertas</th>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <div class="form-group clearfix">
                                                                            <div class="icheck-success d-inline">
                                                                                <input type="radio" id="radiolimpieza1" name="limpieza" value="1" required>
                                                                                <label for="radiolimpieza1">
                                                                                    <i class="fas fa-thumbs-up"></i>
                                                                                </label>
                                                                            </div>

                                                                            <div class="icheck-danger d-inline">
                                                                                <input type="radio" id="radiolimpieza2" name="limpieza" value="0" required>
                                                                                <label for="radiolimpieza2">
                                                                                    <i class="fas fa-thumbs-down"></i>
                                                                                </label>
                                                                            </div>
                                                                            <div class="icheck-warning d-inline">
                                                                                <input type="radio" id="radiolimpieza3" name="limpieza" value="2" required>
                                                                                <label for="radiolimpieza3">
                                                                                    <i class="fas fa-ban"></i>
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="form-group clearfix">
                                                                            <div class="icheck-success d-inline">
                                                                                <input type="radio" id="radiochapas1" name="chapas" value="1" required>
                                                                                <label for="radiochapas1">
                                                                                    <i class="fas fa-thumbs-up"></i>
                                                                                </label>
                                                                            </div>

                                                                            <div class="icheck-danger d-inline">
                                                                                <input type="radio" id="radiochapas2" name="chapas" value="0" required>
                                                                                <label for="radiochapas2">
                                                                                    <i class="fas fa-thumbs-down"></i>
                                                                                </label>
                                                                            </div>
                                                                            <div class="icheck-warning d-inline">
                                                                                <input type="radio" id="radiochapas3" name="chapas" value="2" required>
                                                                                <label for="radiochapas3">
                                                                                    <i class="fas fa-ban"></i>
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="form-group clearfix">
                                                                            <div class="icheck-success d-inline">
                                                                                <input type="radio" id="radioparales1" name="parales" value="1" required>
                                                                                <label for="radioparales1">
                                                                                    <i class="fas fa-thumbs-up"></i>
                                                                                </label>
                                                                            </div>

                                                                            <div class="icheck-danger d-inline">
                                                                                <input type="radio" id="radioparales2" name="parales" value="0" required>
                                                                                <label for="radioparales2">
                                                                                    <i class="fas fa-thumbs-down"></i>
                                                                                </label>
                                                                            </div>
                                                                            <div class="icheck-warning d-inline">
                                                                                <input type="radio" id="radioparales3" name="parales" value="2" required>
                                                                                <label for="radioparales3">
                                                                                    <i class="fas fa-ban"></i>
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="form-group clearfix">
                                                                            <div class="icheck-success d-inline">
                                                                                <input type="radio" id="radiobooster_puertas1" name="booster_puertas" value="1" required>
                                                                                <label for="radiobooster_puertas1">
                                                                                    <i class="fas fa-thumbs-up"></i>
                                                                                </label>
                                                                            </div>

                                                                            <div class="icheck-danger d-inline">
                                                                                <input type="radio" id="radiobooster_puertas2" name="booster_puertas" value="0" required>
                                                                                <label for="radiobooster_puertas2">
                                                                                    <i class="fas fa-thumbs-down"></i>
                                                                                </label>
                                                                            </div>
                                                                            <div class="icheck-warning d-inline">
                                                                                <input type="radio" id="radiobooster_puertas3" name="booster_puertas" value="2" required>
                                                                                <label for="radiobooster_puertas3">
                                                                                    <i class="fas fa-ban"></i>
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr class="font-weight-bold">
                                                                    <th>Relog vigia</th>
                                                                    <th>Vigia rueda delantera derecha</th>
                                                                    <th>Vigia rueda delantera izquierda</th>
                                                                    <th>Vigia rueda trasera derecha</th>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <div class="form-group clearfix">
                                                                            <div class="icheck-success d-inline">
                                                                                <input type="radio" id="radiorelog_vigia1" name="relog_vigia" value="1" required>
                                                                                <label for="radiorelog_vigia1">
                                                                                    <i class="fas fa-thumbs-up"></i>
                                                                                </label>
                                                                            </div>

                                                                            <div class="icheck-danger d-inline">
                                                                                <input type="radio" id="radiorelog_vigia2" name="relog_vigia" value="0" required>
                                                                                <label for="radiorelog_vigia2">
                                                                                    <i class="fas fa-thumbs-down"></i>
                                                                                </label>
                                                                            </div>
                                                                            <div class="icheck-warning d-inline">
                                                                                <input type="radio" id="radiorelog_vigia3" name="relog_vigia" value="2" required>
                                                                                <label for="radiorelog_vigia3">
                                                                                    <i class="fas fa-ban"></i>
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="form-group clearfix">
                                                                            <div class="icheck-success d-inline">
                                                                                <input type="radio" id="radiovigia_delantera_derecha1" name="vigia_delantera_derecha" value="1" required>
                                                                                <label for="radiovigia_delantera_derecha1">
                                                                                    <i class="fas fa-thumbs-up"></i>
                                                                                </label>
                                                                            </div>

                                                                            <div class="icheck-danger d-inline">
                                                                                <input type="radio" id="radiovigia_delantera_derecha2" name="vigia_delantera_derecha" value="0" required>
                                                                                <label for="radiovigia_delantera_derecha2">
                                                                                    <i class="fas fa-thumbs-down"></i>
                                                                                </label>
                                                                            </div>
                                                                            <div class="icheck-warning d-inline">
                                                                                <input type="radio" id="radiovigia_delantera_derecha3" name="vigia_delantera_derecha" value="2" required>
                                                                                <label for="radioespejo_central3">
                                                                                    <i class="fas fa-ban"></i>
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="form-group clearfix">
                                                                            <div class="icheck-success d-inline">
                                                                                <input type="radio" id="radiovigia_delantera_izquierda1" name="vigia_delantera_izquierda" value="1" required>
                                                                                <label for="radiovigia_delantera_izquierda1">
                                                                                    <i class="fas fa-thumbs-up"></i>
                                                                                </label>
                                                                            </div>

                                                                            <div class="icheck-danger d-inline">
                                                                                <input type="radio" id="radiovigia_delantera_izquierda2" name="vigia_delantera_izquierda" value="0" required>
                                                                                <label for="radiovigia_delantera_izquierda2">
                                                                                    <i class="fas fa-thumbs-down"></i>
                                                                                </label>
                                                                            </div>
                                                                            <div class="icheck-warning d-inline">
                                                                                <input type="radio" id="radiovigia_delantera_izquierda3" name="vigia_delantera_izquierda" value="2" required>
                                                                                <label for="radiovigia_delantera_izquierda3">
                                                                                    <i class="fas fa-ban"></i>
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="form-group clearfix">
                                                                            <div class="icheck-success d-inline">
                                                                                <input type="radio" id="radiovigia_trasera_derecha1" name="vigia_trasera_derecha" value="1" required>
                                                                                <label for="radiovigia_trasera_derecha1">
                                                                                    <i class="fas fa-thumbs-up"></i>
                                                                                </label>
                                                                            </div>

                                                                            <div class="icheck-danger d-inline">
                                                                                <input type="radio" id="radiovigia_trasera_derecha2" name="vigia_trasera_derecha" value="0" required>
                                                                                <label for="radiovigia_trasera_derecha2">
                                                                                    <i class="fas fa-thumbs-down"></i>
                                                                                </label>
                                                                            </div>
                                                                            <div class="icheck-warning d-inline">
                                                                                <input type="radio" id="radiovigia_trasera_derecha3" name="vigia_trasera_derecha" value="2" required>
                                                                                <label for="radiovigia_trasera_derecha3">
                                                                                    <i class="fas fa-ban"></i>
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr class="font-weight-bold">
                                                                    <th>Vigia rueda trasera izquierda</th>
                                                                    <th>Tapa motor</th>
                                                                    <th>Tapa bodegas</th>
                                                                    <th>Parasol</th>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <div class="form-group clearfix">
                                                                            <div class="icheck-success d-inline">
                                                                                <input type="radio" id="radiovigia_trasera_izquierda1" name="vigia_trasera_izquierda" value="1" required>
                                                                                <label for="radiovigia_trasera_izquierda1">
                                                                                    <i class="fas fa-thumbs-up"></i>
                                                                                </label>
                                                                            </div>

                                                                            <div class="icheck-danger d-inline">
                                                                                <input type="radio" id="radiovigia_trasera_izquierda2" name="vigia_trasera_izquierda" value="0" required>
                                                                                <label for="radiovigia_trasera_izquierda2">
                                                                                    <i class="fas fa-thumbs-down"></i>
                                                                                </label>
                                                                            </div>
                                                                            <div class="icheck-warning d-inline">
                                                                                <input type="radio" id="radiovigia_trasera_izquierda3" name="vigia_trasera_izquierda" value="2" required>
                                                                                <label for="radiovigia_trasera_izquierda3">
                                                                                    <i class="fas fa-ban"></i>
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="form-group clearfix">
                                                                            <div class="icheck-success d-inline">
                                                                                <input type="radio" id="radiotapa_motor1" name="tapa_motor" value="1" required>
                                                                                <label for="radiotapa_motor1">
                                                                                    <i class="fas fa-thumbs-up"></i>
                                                                                </label>
                                                                            </div>

                                                                            <div class="icheck-danger d-inline">
                                                                                <input type="radio" id="radiotapa_motor2" name="tapa_motor" value="0" required>
                                                                                <label for="radiotapa_motor2">
                                                                                    <i class="fas fa-thumbs-down"></i>
                                                                                </label>
                                                                            </div>
                                                                            <div class="icheck-warning d-inline">
                                                                                <input type="radio" id="radiotapa_motor3" name="tapa_motor" value="2" required>
                                                                                <label for="radiotapa_motor3">
                                                                                    <i class="fas fa-ban"></i>
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="form-group clearfix">
                                                                            <div class="icheck-success d-inline">
                                                                                <input type="radio" id="radiotapa_bodegas1" name="tapa_bodegas" value="1" required>
                                                                                <label for="radiotapa_bodegas1">
                                                                                    <i class="fas fa-thumbs-up"></i>
                                                                                </label>
                                                                            </div>

                                                                            <div class="icheck-danger d-inline">
                                                                                <input type="radio" id="radiotapa_bodegas2" name="tapa_bodegas" value="0" required>
                                                                                <label for="radiotapa_bodegas2">
                                                                                    <i class="fas fa-thumbs-down"></i>
                                                                                </label>
                                                                            </div>
                                                                            <div class="icheck-warning d-inline">
                                                                                <input type="radio" id="radiotapa_bodegas3" name="tapa_bodegas" value="2" required>
                                                                                <label for="radiotapa_bodegas3">
                                                                                    <i class="fas fa-ban"></i>
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="form-group clearfix">
                                                                            <div class="icheck-success d-inline">
                                                                                <input type="radio" id="radioparasol1" name="parasol" value="1" required>
                                                                                <label for="radioparasol1">
                                                                                    <i class="fas fa-thumbs-up"></i>
                                                                                </label>
                                                                            </div>

                                                                            <div class="icheck-danger d-inline">
                                                                                <input type="radio" id="radioparasol2" name="parasol" value="0" required>
                                                                                <label for="radioparasol2">
                                                                                    <i class="fas fa-thumbs-down"></i>
                                                                                </label>
                                                                            </div>
                                                                            <div class="icheck-warning d-inline">
                                                                                <input type="radio" id="radioparasol3" name="parasol" value="2" required>
                                                                                <label for="radioparasol3">
                                                                                    <i class="fas fa-ban"></i>
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr class="font-weight-bold">
                                                                    <th>Cenefas</th>
                                                                    <th>Emblema izquierdo empresa</th>
                                                                    <th>Emblema derecho empresa</th>
                                                                    <th>Emblema trasero empresa</th>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <div class="form-group clearfix">
                                                                            <div class="icheck-success d-inline">
                                                                                <input type="radio" id="radiocenefas1" name="cenefas" value="1" required>
                                                                                <label for="radiocenefas1">
                                                                                    <i class="fas fa-thumbs-up"></i>
                                                                                </label>
                                                                            </div>

                                                                            <div class="icheck-danger d-inline">
                                                                                <input type="radio" id="radiocenefas2" name="cenefas" value="0" required>
                                                                                <label for="radiocenefas2">
                                                                                    <i class="fas fa-thumbs-down"></i>
                                                                                </label>
                                                                            </div>
                                                                            <div class="icheck-warning d-inline">
                                                                                <input type="radio" id="radiocenefas3" name="cenefas" value="2" required>
                                                                                <label for="radiocenefas3">
                                                                                    <i class="fas fa-ban"></i>
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="form-group clearfix">
                                                                            <div class="icheck-success d-inline">
                                                                                <input type="radio" id="radioemblema_izquierdo1" name="emblema_izquierdo" value="1" required>
                                                                                <label for="radioemblema_izquierdo1">
                                                                                    <i class="fas fa-thumbs-up"></i>
                                                                                </label>
                                                                            </div>

                                                                            <div class="icheck-danger d-inline">
                                                                                <input type="radio" id="radioemblema_izquierdo2" name="emblema_izquierdo" value="0" required>
                                                                                <label for="radioemblema_izquierdo2">
                                                                                    <i class="fas fa-thumbs-down"></i>
                                                                                </label>
                                                                            </div>
                                                                            <div class="icheck-warning d-inline">
                                                                                <input type="radio" id="radioemblema_izquierdo3" name="emblema_izquierdo" value="2" required>
                                                                                <label for="radioemblema_izquierdo3">
                                                                                    <i class="fas fa-ban"></i>
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="form-group clearfix">
                                                                            <div class="icheck-success d-inline">
                                                                                <input type="radio" id="radioemblema_derecho1" name="emblema_derecho" value="1" required>
                                                                                <label for="radioemblema_derecho1">
                                                                                    <i class="fas fa-thumbs-up"></i>
                                                                                </label>
                                                                            </div>

                                                                            <div class="icheck-danger d-inline">
                                                                                <input type="radio" id="radioemblema_derecho2" name="emblema_derecho" value="0" required>
                                                                                <label for="radioemblema_derecho2">
                                                                                    <i class="fas fa-thumbs-down"></i>
                                                                                </label>
                                                                            </div>
                                                                            <div class="icheck-warning d-inline">
                                                                                <input type="radio" id="radioemblema_derecho3" name="emblema_derecho" value="2" required>
                                                                                <label for="radioemblema_derecho3">
                                                                                    <i class="fas fa-ban"></i>
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="form-group clearfix">
                                                                            <div class="icheck-success d-inline">
                                                                                <input type="radio" id="radioemblema_trasero1" name="emblema_trasero" value="1" required>
                                                                                <label for="radioemblema_trasero1">
                                                                                    <i class="fas fa-thumbs-up"></i>
                                                                                </label>
                                                                            </div>

                                                                            <div class="icheck-danger d-inline">
                                                                                <input type="radio" id="radioemblema_trasero2" name="emblema_trasero" value="0" required>
                                                                                <label for="radioemblema_trasero2">
                                                                                    <i class="fas fa-thumbs-down"></i>
                                                                                </label>
                                                                            </div>
                                                                            <div class="icheck-warning d-inline">
                                                                                <input type="radio" id="radioemblema_trasero3" name="emblema_trasero" value="2" required>
                                                                                <label for="radioemblema_trasero3">
                                                                                    <i class="fas fa-ban"></i>
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr class="font-weight-bold">
                                                                    <th>Equipo de audio</th>
                                                                    <th>Parlantes</th>
                                                                    <th>Cinturón sillas usuario</th>
                                                                    <th>Martillos salida de emergencia</th>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <div class="form-group clearfix">
                                                                            <div class="icheck-success d-inline">
                                                                                <input type="radio" id="radioequipo_audio1" name="equipo_audio" value="1" required>
                                                                                <label for="radioequipo_audio1">
                                                                                    <i class="fas fa-thumbs-up"></i>
                                                                                </label>
                                                                            </div>

                                                                            <div class="icheck-danger d-inline">
                                                                                <input type="radio" id="radioequipo_audio2" name="equipo_audio" value="0" required>
                                                                                <label for="radioequipo_audio2">
                                                                                    <i class="fas fa-thumbs-down"></i>
                                                                                </label>
                                                                            </div>
                                                                            <div class="icheck-warning d-inline">
                                                                                <input type="radio" id="radioequipo_audio3" name="equipo_audio" value="2" required>
                                                                                <label for="radioequipo_audio3">
                                                                                    <i class="fas fa-ban"></i>
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="form-group clearfix">
                                                                            <div class="icheck-success d-inline">
                                                                                <input type="radio" id="radioparlantes1" name="parlantes" value="1" required>
                                                                                <label for="radioparlantes1">
                                                                                    <i class="fas fa-thumbs-up"></i>
                                                                                </label>
                                                                            </div>

                                                                            <div class="icheck-danger d-inline">
                                                                                <input type="radio" id="radioparlantes2" name="parlantes" value="0" required>
                                                                                <label for="radioparlantes2">
                                                                                    <i class="fas fa-thumbs-down"></i>
                                                                                </label>
                                                                            </div>
                                                                            <div class="icheck-warning d-inline">
                                                                                <input type="radio" id="radioparlantes3" name="parlantes" value="2" required>
                                                                                <label for="radioparlantes3">
                                                                                    <i class="fas fa-ban"></i>
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="form-group clearfix">
                                                                            <div class="icheck-success d-inline">
                                                                                <input type="radio" id="radiocinturon_usuario1" name="cinturon_usuario" value="1" required>
                                                                                <label for="radiocinturon_usuario1">
                                                                                    <i class="fas fa-thumbs-up"></i>
                                                                                </label>
                                                                            </div>

                                                                            <div class="icheck-danger d-inline">
                                                                                <input type="radio" id="radiocinturon_usuario2" name="cinturon_usuario" value="0" required>
                                                                                <label for="radiocinturon_usuario2">
                                                                                    <i class="fas fa-thumbs-down"></i>
                                                                                </label>
                                                                            </div>
                                                                            <div class="icheck-warning d-inline">
                                                                                <input type="radio" id="radiocinturon_usuario3" name="cinturon_usuario" value="2" required>
                                                                                <label for="radiocinturon_usuario3">
                                                                                    <i class="fas fa-ban"></i>
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="form-group clearfix">
                                                                            <div class="icheck-success d-inline">
                                                                                <input type="radio" id="radiomartillo_emergencia1" name="martillo_emergencia" value="1" required>
                                                                                <label for="radiomartillo_emergencia1">
                                                                                    <i class="fas fa-thumbs-up"></i>
                                                                                </label>
                                                                            </div>

                                                                            <div class="icheck-danger d-inline">
                                                                                <input type="radio" id="radiomartillo_emergencia2" name="martillo_emergencia" value="0" required>
                                                                                <label for="radiomartillo_emergencia2">
                                                                                    <i class="fas fa-thumbs-down"></i>
                                                                                </label>
                                                                            </div>
                                                                            <div class="icheck-warning d-inline">
                                                                                <input type="radio" id="radiomartillo_emergencia3" name="martillo_emergencia" value="2" required>
                                                                                <label for="radiomartillo_emergencia3">
                                                                                    <i class="fas fa-ban"></i>
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr class="font-weight-bold">
                                                                    <th>Dispositivo de velocidad</th>
                                                                    <th>Avisos</th>
                                                                    <th>Placa trasera</th>
                                                                    <th>Placa delantera</th>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <div class="form-group clearfix">
                                                                            <div class="icheck-success d-inline">
                                                                                <input type="radio" id="radiodispositivo_velocidad1" name="dispositivo_velocidad" value="1" required>
                                                                                <label for="radiodispositivo_velocidad1">
                                                                                    <i class="fas fa-thumbs-up"></i>
                                                                                </label>
                                                                            </div>

                                                                            <div class="icheck-danger d-inline">
                                                                                <input type="radio" id="radiodispositivo_velocidad2" name="dispositivo_velocidad" value="0" required>
                                                                                <label for="radiodispositivo_velocidad2">
                                                                                    <i class="fas fa-thumbs-down"></i>
                                                                                </label>
                                                                            </div>
                                                                            <div class="icheck-warning d-inline">
                                                                                <input type="radio" id="radiodispositivo_velocidad3" name="dispositivo_velocidad" value="2" required>
                                                                                <label for="radiodispositivo_velocidad3">
                                                                                    <i class="fas fa-ban"></i>
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="form-group clearfix">
                                                                            <div class="icheck-success d-inline">
                                                                                <input type="radio" id="radioavisos1" name="avisos" value="1" required>
                                                                                <label for="radioavisos1">
                                                                                    <i class="fas fa-thumbs-up"></i>
                                                                                </label>
                                                                            </div>

                                                                            <div class="icheck-danger d-inline">
                                                                                <input type="radio" id="radioavisos2" name="avisos" value="0" required>
                                                                                <label for="radioavisos2">
                                                                                    <i class="fas fa-thumbs-down"></i>
                                                                                </label>
                                                                            </div>
                                                                            <div class="icheck-warning d-inline">
                                                                                <input type="radio" id="radioavisos3" name="avisos" value="2" required>
                                                                                <label for="radioavisos3">
                                                                                    <i class="fas fa-ban"></i>
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="form-group clearfix">
                                                                            <div class="icheck-success d-inline">
                                                                                <input type="radio" id="radioplaca_trasera1" name="placa_trasera" value="1" required>
                                                                                <label for="radioplaca_trasera1">
                                                                                    <i class="fas fa-thumbs-up"></i>
                                                                                </label>
                                                                            </div>

                                                                            <div class="icheck-danger d-inline">
                                                                                <input type="radio" id="radioplaca_trasera2" name="placa_trasera" value="0" required>
                                                                                <label for="radioplaca_trasera2">
                                                                                    <i class="fas fa-thumbs-down"></i>
                                                                                </label>
                                                                            </div>
                                                                            <div class="icheck-warning d-inline">
                                                                                <input type="radio" id="radioplaca_trasera3" name="placa_trasera" value="2" required>
                                                                                <label for="radioplaca_trasera3">
                                                                                    <i class="fas fa-ban"></i>
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="form-group clearfix">
                                                                            <div class="icheck-success d-inline">
                                                                                <input type="radio" id="radioplaca_delantera1" name="placa_delantera" value="1" required>
                                                                                <label for="radioplaca_delantera1">
                                                                                    <i class="fas fa-thumbs-up"></i>
                                                                                </label>
                                                                            </div>

                                                                            <div class="icheck-danger d-inline">
                                                                                <input type="radio" id="radioplaca_delantera2" name="placa_delantera" value="0" required>
                                                                                <label for="radioplaca_delantera2">
                                                                                    <i class="fas fa-thumbs-down"></i>
                                                                                </label>
                                                                            </div>
                                                                            <div class="icheck-warning d-inline">
                                                                                <input type="radio" id="radioplaca_delantera3" name="placa_delantera" value="2" required>
                                                                                <label for="radioplaca_delantera3">
                                                                                    <i class="fas fa-ban"></i>
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr class="font-weight-bold">
                                                                    <th>Placa lateral derecha</th>
                                                                    <th>Placa lateral izquierda</th>
                                                                    <th>Balizas</th>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <div class="form-group clearfix">
                                                                            <div class="icheck-success d-inline">
                                                                                <input type="radio" id="radioplaca_lateral_derecha1" name="placa_lateral_derecha" value="1" required>
                                                                                <label for="radioplaca_lateral_derecha1">
                                                                                    <i class="fas fa-thumbs-up"></i>
                                                                                </label>
                                                                            </div>

                                                                            <div class="icheck-danger d-inline">
                                                                                <input type="radio" id="radioplaca_lateral_derecha2" name="placa_lateral_derecha" value="0" required>
                                                                                <label for="radioplaca_lateral_derecha2">
                                                                                    <i class="fas fa-thumbs-down"></i>
                                                                                </label>
                                                                            </div>
                                                                            <div class="icheck-warning d-inline">
                                                                                <input type="radio" id="radioplaca_lateral_derecha3" name="placa_lateral_derecha" value="2" required>
                                                                                <label for="radioplaca_lateral_derecha3">
                                                                                    <i class="fas fa-ban"></i>
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="form-group clearfix">
                                                                            <div class="icheck-success d-inline">
                                                                                <input type="radio" id="radioplaca_lateral_izquierda1" name="placa_lateral_izquierda" value="1" required>
                                                                                <label for="radioplaca_lateral_izquierda1">
                                                                                    <i class="fas fa-thumbs-up"></i>
                                                                                </label>
                                                                            </div>

                                                                            <div class="icheck-danger d-inline">
                                                                                <input type="radio" id="radioplaca_lateral_izquierda2" name="placa_lateral_izquierda" value="0" required>
                                                                                <label for="radioplaca_lateral_izquierda2">
                                                                                    <i class="fas fa-thumbs-down"></i>
                                                                                </label>
                                                                            </div>
                                                                            <div class="icheck-warning d-inline">
                                                                                <input type="radio" id="radioplaca_lateral_izquierda3" name="placa_lateral_izquierda" value="2" required>
                                                                                <label for="radioplaca_lateral_izquierda3">
                                                                                    <i class="fas fa-ban"></i>
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="form-group clearfix">
                                                                            <div class="icheck-success d-inline">
                                                                                <input type="radio" id="radiobalizas1" name="balizas" value="1" required>
                                                                                <label for="radiobalizas1">
                                                                                    <i class="fas fa-thumbs-up"></i>
                                                                                </label>
                                                                            </div>

                                                                            <div class="icheck-danger d-inline">
                                                                                <input type="radio" id="radiobalizas2" name="balizas" value="0" required>
                                                                                <label for="radiobalizas2">
                                                                                    <i class="fas fa-thumbs-down"></i>
                                                                                </label>
                                                                            </div>
                                                                            <div class="icheck-warning d-inline">
                                                                                <input type="radio" id="radiobalizas3" name="balizas" value="2" required>
                                                                                <label for="radiobalizas3">
                                                                                    <i class="fas fa-ban"></i>
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                    </table>
                                                </div>
                                            </div>

                                            <!-- TAB EQUIPO DE PREVENCIÓN Y SEGURIDAD -->
                                            <div class="tab-pane fade show" id="custom-tabs-two-seguridad" role="tabpanel" aria-labelledby="custom-tabs-two-seguridad">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered text-center border-danger" nombre = "Sistema potencia">
                                                            <thead class="text-nowrap">
                                                                <tr class="font-weight-bold">
                                                                    <th>Gato</th>
                                                                    <th>Cruceta o copa</th>
                                                                    <th>Señales de carretera</th>
                                                                    <th>Botiquin</th>
                                                                </tr>
                                                            </thead>

                                                            <tr>
                                                                <td>
                                                                    <div class="form-group clearfix">
                                                                        <div class="icheck-success d-inline">
                                                                            <input type="radio" id="radiogato1" name="gato" value="1" required>
                                                                            <label for="radiogato1">
                                                                                <i class="fas fa-thumbs-up"></i>
                                                                            </label>
                                                                        </div>

                                                                        <div class="icheck-danger d-inline">
                                                                            <input type="radio" id="radiogato2" name="gato" value="0" required>
                                                                            <label for="radiogato2">
                                                                                <i class="fas fa-thumbs-down"></i>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-group clearfix">
                                                                        <div class="icheck-success d-inline">
                                                                            <input type="radio" id="radiocopa1" name="copa" value="1" required>
                                                                            <label for="radiocopa1">
                                                                                <i class="fas fa-thumbs-up"></i>
                                                                            </label>
                                                                        </div>

                                                                        <div class="icheck-danger d-inline">
                                                                            <input type="radio" id="radiocopa2" name="copa" value="0" required>
                                                                            <label for="radiocopa2">
                                                                                <i class="fas fa-thumbs-down"></i>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-group clearfix">
                                                                        <div class="icheck-success d-inline">
                                                                            <input type="radio" id="radioseñales_carretera1" name="señales_carretera" value="1" required>
                                                                            <label for="radioseñales_carretera1">
                                                                                <i class="fas fa-thumbs-up"></i>
                                                                            </label>
                                                                        </div>

                                                                        <div class="icheck-danger d-inline">
                                                                            <input type="radio" id="radioseñales_carretera2" name="señales_carretera" value="0" required>
                                                                            <label for="radioseñales_carretera2">
                                                                                <i class="fas fa-thumbs-down"></i>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-group clearfix">
                                                                        <div class="icheck-success d-inline">
                                                                            <input type="radio" id="radiobotiquin1" name="botiquin" value="1" required>
                                                                            <label for="radiobotiquin1">
                                                                                <i class="fas fa-thumbs-up"></i>
                                                                            </label>
                                                                        </div>

                                                                        <div class="icheck-danger d-inline">
                                                                            <input type="radio" id="radiobotiquin2" name="botiquin" value="0" required>
                                                                            <label for="radiobotiquin2">
                                                                                <i class="fas fa-thumbs-down"></i>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>

                                                            <tbody class="text-nowrap">
                                                                <tr class="font-weight-bold">
                                                                    <th>Extintor</th>
                                                                    <th>2 tacos</th>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <div class="form-group clearfix">
                                                                            <div class="icheck-success d-inline">
                                                                                <input type="radio" id="radioextintor1" name="extintor" value="1" required>
                                                                                <label for="radioextintor1">
                                                                                    <i class="fas fa-thumbs-up"></i>
                                                                                </label>
                                                                            </div>

                                                                            <div class="icheck-danger d-inline">
                                                                                <input type="radio" id="radioextintor2" name="extintor" value="0" required>
                                                                                <label for="radioextintor2">
                                                                                    <i class="fas fa-thumbs-down"></i>
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="form-group clearfix">
                                                                            <div class="icheck-success d-inline">
                                                                                <input type="radio" id="radiotacos1" name="tacos" value="1" required>
                                                                                <label for="radiotacos1">
                                                                                    <i class="fas fa-thumbs-up"></i>
                                                                                </label>
                                                                            </div>

                                                                            <div class="icheck-danger d-inline">
                                                                                <input type="radio" id="radiotacos2" name="tacos" value="0" required>
                                                                                <label for="radiotacos2">
                                                                                    <i class="fas fa-thumbs-down"></i>
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                    </table>
                                                </div>
                                            </div>

                                            <!-- TAB HERRAMIENTA -->
                                            <div class="tab-pane fade show" id="custom-tabs-two-herramienta" role="tabpanel" aria-labelledby="custom-tabs-two-herramienta">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered text-center border-danger" nombre = "Sistema potencia">
                                                            <thead class="text-nowrap">
                                                                <tr class="font-weight-bold">
                                                                    <th>Alicate</th>
                                                                    <th>Destornilladores</th>
                                                                    <th>Llave de expansión</th>
                                                                    <th>Llaves fijas</th>
                                                                </tr>
                                                            </thead>
                                                            
                                                            <tr>
                                                                <td>
                                                                    <div class="form-group clearfix">
                                                                        <div class="icheck-success d-inline">
                                                                            <input type="radio" id="radioalicate1" name="alicate" value="1" required>
                                                                            <label for="radioalicate1">
                                                                                <i class="fas fa-thumbs-up"></i>
                                                                            </label>
                                                                        </div>

                                                                        <div class="icheck-danger d-inline">
                                                                            <input type="radio" id="radioalicate2" name="alicate" value="0" required>
                                                                            <label for="radioalicate2">
                                                                                <i class="fas fa-thumbs-down"></i>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-group clearfix">
                                                                        <div class="icheck-success d-inline">
                                                                            <input type="radio" id="radiodestornilladores1" name="destornilladores" value="1" required>
                                                                            <label for="radiodestornilladores1">
                                                                                <i class="fas fa-thumbs-up"></i>
                                                                            </label>
                                                                        </div>

                                                                        <div class="icheck-danger d-inline">
                                                                            <input type="radio" id="radiodestornilladores2" name="destornilladores" value="0" required>
                                                                            <label for="radiodestornilladores2">
                                                                                <i class="fas fa-thumbs-down"></i>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-group clearfix">
                                                                        <div class="icheck-success d-inline">
                                                                            <input type="radio" id="radiollave_expansion1" name="llave_expansion" value="1" required>
                                                                            <label for="radiollave_expansion1">
                                                                                <i class="fas fa-thumbs-up"></i>
                                                                            </label>
                                                                        </div>

                                                                        <div class="icheck-danger d-inline">
                                                                            <input type="radio" id="radiollave_expansion2" name="llave_expansion" value="0" required>
                                                                            <label for="radiollave_expansion2">
                                                                                <i class="fas fa-thumbs-down"></i>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-group clearfix">
                                                                        <div class="icheck-success d-inline">
                                                                            <input type="radio" id="radiollaves_fijas1" name="llaves_fijas" value="1" required>
                                                                            <label for="radiollaves_fijas1">
                                                                                <i class="fas fa-thumbs-up"></i>
                                                                            </label>
                                                                        </div>

                                                                        <div class="icheck-danger d-inline">
                                                                            <input type="radio" id="radiollaves_fijas2" name="llaves_fijas" value="0" required>
                                                                            <label for="radiollaves_fijas2">
                                                                                <i class="fas fa-thumbs-down"></i>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>

                                                            <tbody class="text-nowrap">
                                                                <tr class="font-weight-bold">
                                                                    <th>Linterna con pila</th>
                                                                    <th>Observaciones</th>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <div class="form-group clearfix">
                                                                            <div class="icheck-success d-inline">
                                                                                <input type="radio" id="radiolinterna1" name="linterna" value="1" required>
                                                                                <label for="radiolinterna1">
                                                                                    <i class="fas fa-thumbs-up"></i>
                                                                                </label>
                                                                            </div>

                                                                            <div class="icheck-danger d-inline">
                                                                                <input type="radio" id="radiolinterna2" name="linterna" value="0" required>
                                                                                <label for="radiolinterna2">
                                                                                    <i class="fas fa-thumbs-down"></i>
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="form-group clearfix">
                                                                            <div class="icheck-success d-inline">
                                                                            <textarea class="form-control" id="observacion" name="observacion" rows="2" required placeholder="..."></textarea>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                    </table>
                                                </div>
                                            </div>

                                        </div>
                                    </form>
                                </div>

                                </div>
                            </div>
                            




                        </div>



                    </div>



                        <!-- FIN MODAL CONTENT  -->
                </div> 
            </div>
        </div>





    </div>

</div>