
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
                                        <a class="nav-link" id="custom-tabs-two-carroceria-tab" data-toggle="pill" href="#custom-tabs-two-carroceria" role="tab" aria-controls="custom-tabs-two-carroceria" aria-selected="false"><u>Sistema de transmisión y diferencial</u></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="custom-tabs-two-sistemas-tab" data-toggle="pill" href="#custom-tabs-two-sistemas" role="tab" aria-controls="custom-tabs-two-sistemas" aria-selected="false"><u>Sistemas muelles y suspensión</u></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="custom-tabs-two-indicadorestableros-tab" data-toggle="pill" href="#custom-tabs-two-indicadorestableros" role="tab" aria-controls="custom-tabs-two-indicadorestableros" aria-selected="false"><u>Sistema dirección</u></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="custom-tabs-two-mantenimiento-tab" data-toggle="pill" href="#custom-tabs-two-mantenimiento" role="tab" aria-controls="custom-tabs-two-mantenimiento" aria-selected="false"><u>Sisema de frenos y llantas</u></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="custom-tabs-two-llantas-tab" data-toggle="pill" href="#custom-tabs-two-llantas" role="tab" aria-controls="custom-tabs-two-llantas" aria-selected="false"><u>Sistema eléctrico</u></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="custom-tabs-two-equiposeguridad-tab" data-toggle="pill" href="#custom-tabs-two-equiposeguridad" role="tab" aria-controls="custom-tabs-two-equiposeguridad" aria-selected="false"><u>Carroceria</u></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="custom-tabs-two-equiposeguridad-tab" data-toggle="pill" href="#custom-tabs-two-equiposeguridad" role="tab" aria-controls="custom-tabs-two-equiposeguridad" aria-selected="false"><u>Accesorios y otros</u></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="custom-tabs-two-equiposeguridad-tab" data-toggle="pill" href="#custom-tabs-two-equiposeguridad" role="tab" aria-controls="custom-tabs-two-equiposeguridad" aria-selected="false"><u>Equipo de prevención y seguridad</u></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="custom-tabs-two-equiposeguridad-tab" data-toggle="pill" href="#custom-tabs-two-equiposeguridad" role="tab" aria-controls="custom-tabs-two-equiposeguridad" aria-selected="false"><u>iHerramienta</u></a>
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
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </tbody>

                                                    </table>
                                                </div>
                                            </div>

                                            <!-- TAB SISTEMA TRANSMISIÓN DIGITAL -->
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