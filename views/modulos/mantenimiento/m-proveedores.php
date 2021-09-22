<?php

// if (!validarModulo('CARGAR_OPCION')) {
//     echo "<script> window.location = 'inicio'; </script>";
// }

$Municipios = ControladorGH::ctrDeparMunicipios();
$Proveedores = ControladorProveedores::ctrListarProveedores();

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
                    <h1 class="m-0 text-dark "><b><i>Proveedores</i></b></h1>
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
            <hr class="my-4">
            <!-- ===================== 
              AGREGAR FILAS Y COLUMNAS PARA EL DESARROLLO 
            ========================= -->
            <div class="row">
                <div class="col-12">
                    <div class="card card-outline card-success">
                        <div class="card-body">
                            <div class="col-sm-12">

                                <div class="row mb">
                                    <div class="col-sm text-center">
                                        <button type="button" class="btn bg-gradient-warning btn_nuevo" data-toggle="modal" data-target="#modal-nuevo"><i class="fas fa-dolly"></i></i> Nuevo proveedor</button>
                                        <button type="button" class="btn bg-gradient-success" data-toggle="modal" data-target="#modal-guardar"><i class="far fa-save"></i> Guardar</button>
                                    </div>
                                </div>

                                <hr class="my-4">

                                <div class="table-responsive">
                                    <table id="tabla_proveedores" class="table table-sm table-bordered table-striped text-center tablasBtnExport">
                                        <thead>
                                            <tr>
                                                <th>Acciones</th>
                                                <th>ID</th>
                                                <th>CC / NIT</th>
                                                <th>Nombre o Razón social</th>
                                                <th>Dirección</th>
                                                <th>Teléfono</th>
                                                <th>Contacto</th>
                                                <th>Correo Electrónico</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php foreach ($Proveedores as $key => $value) : ?>
                                                <tr>
                                                    <td>
                                                        <button type="button" class="btn btn-info btn-sm btn_imprimir" data-toggle="modal" data-target="#modal-imprimir"><i class="fas fa-print"></i></button>
                                                        <button type="button" class="btn btn-success btn-sm btn_editar" data-toggle="modal" data-target="#modal-nuevo" nit_editar="<?= $value['documento'] ?>" id_prov="<?= $value['id'] ?>"><i class="fas fa-edit"></i></button>
                                                        <button type="button" class="btn btn-danger btn-sm btn_eliminar" id="<?= $value['id'] ?>"><i class="fas fa-trash"></i></button>

                                                    </td>
                                                    <td><?= $value['id'] ?></td>
                                                    <td><?= $value['documento'] ?></td>
                                                    <td><?= $value['razon_social'] ?></td>
                                                    <td><?= $value['direccion'] ?></td>
                                                    <td><?= $value['telefono'] ?></td>
                                                    <td><?= $value['nombre_contacto'] ?></td>
                                                    <td><?= $value['correo'] ?></td>
                                                </tr>
                                            <?php endforeach ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ===================== 
              FIN DE LA DATA-TABLE
            ========================= -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->


<!-- ===================== 
              INICIO MODAL DEL BOTON NUEVO
            ========================= -->

<div class="modal fade show" id="modal-nuevo" style="display: none; padding-right: 17px;" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <form method="post" enctype="multipart/form-data">


                <div class="modal-header bg-info">
                    <h4 class="modal-title" id="titulo_modal_proveedores"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="row">

                        <div class="col-md-6">

                            <input class="input-proveedores" id="id_proveedor" type="hidden" name="id_proveedor" value="">

                            <div class="form-group">
                                <label>CC / NIT</label>
                                <input type="text" class="form-control input-proveedores" placeholder="Ingrese una cédula o NIT" id="cc_proveedor" name="cc_proveedor">
                            </div>

                            <div class="form-group">
                                <label>Nombre o razón Social</label>
                                <input type="text" class="form-control input-proveedores" placeholder="Escriba el nombre o razon social" id="nom_razonsocial" name="nom_razonsocial">
                            </div>

                            <div class="form-group">
                                <label>Dirección</label>
                                <input type="text" class="form-control input-proveedores" placeholder="Ingrese la dirección del proveedor" id="direccion_proveedor" name="direccion_proveedor">
                            </div>

                            <div class="form-group">
                                <label>Teléfono</label>
                                <input type="text" class="form-control input-proveedores" placeholder="Ingrese un número telefónico" id="telef_proveedor" name="telef_proveedor">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Contacto</label>
                                <input type="text" class="form-control input-proveedores" placeholder="Ingrese el nombre del contacto" id="contacto_proveedor" name="contacto_proveedor">
                            </div>

                            <div class="form-group">
                                <label>Correo electrónico</label>
                                <input type="text" class="form-control input-proveedores" placeholder="ejemplo@correo.com" id="correo_proveedor" name="correo_proveedor">
                            </div>

                            <div class="form-group">
                                <label>Ciudad</label>
                                <select id="ciudad_proveedor" class="form-control input-proveedores select2-single" name="ciudad_proveedor" type="number">
                                    <option selected value="">-Seleccione una ciudad-</option>
                                    <?php foreach ($Municipios as $key => $value) : ?>
                                        <option value="<?= $value['idmunicipio'] ?>"><?= $value['DeparMunic'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer justify-content-center bg-dark">
                    <button type="submit" class="btn btn-success">Guardar</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                </div>

                <?php
                $crearProveedor = new ControladorProveedores();
                $crearProveedor->ctrAgregarEditarProveedor();
                ?>

            </form>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- ===================== 
              FIN MODAL DEL BOTON NUEVO
            ========================= -->


<!-- ===================== 
              INICIO MODAL DE TODOS LOS BOTONES DE EDITAR EN LA TABLA
            ========================= -->

<!-- <div class="modal fade show" id="modal-editar" style="display: none; padding-right: 17px;" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h4 class="modal-title">Editar Proveedor</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="row">

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>CC o NIT</label>
                            <input type="text" class="form-control" placeholder="Digite cedula o NIT">
                        </div>


                        <div class="form-group">
                            <label>Nombre o Razon Social</label>
                            <input type="text" class="form-control" placeholder="Escriba nombre o razon social">
                        </div>

                        <div class="form-group">
                            <label>Direccion</label>
                            <input type="text" class="form-control" placeholder="Escriba una direccion">
                        </div>

                        <div class="form-group">
                            <label>Telefono</label>
                            <input type="text" class="form-control" data-inputmask="'mask': ['999-999-9999 [x99999]', '+099 99 99 9999[9]-9999']" data-mask="" inputmode="text" placeholder="Digite numero telefonico">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Contacto</label>
                            <input type="text" class="form-control" placeholder="Escriba nombre de contacto">
                        </div>


                        <div class="form-group">
                            <label>Correo Electronico</label>
                            <input type="text" class="form-control" placeholder="Escriba un Correo">
                        </div>

                        <div class="form-group">
                            <label>Departamento</label>
                            <select id="depto" name="depto" class="form-control input-lg" required="">
                                <option value="Vichada">Vichada</option>
                                <option value="Vaupés">Vaupés</option>
                                <option value="Valle del Cauca">Valle del Cauca</option>
                                <option value="Tolima">Tolima</option>
                                <option value="Sucre">Sucre</option>
                                <option value="Santander">Santander</option>
                                <option value="San Andrés y Providencia">San Andrés y Providencia</option>
                                <option value="Risaralda">Risaralda</option>
                                <option value="Quindío">Quindío</option>
                                <option value="Putumayo">Putumayo</option>
                                <option value="Norte de Santander">Norte de Santander</option>
                                <option value="Nariño">Nariño</option>
                                <option value="Meta">Meta</option>
                                <option value="Magdalena">Magdalena</option>
                                <option value="La Guajira">La Guajira</option>
                                <option value="Huila">Huila</option>
                                <option value="Guaviare">Guaviare</option>
                                <option value="Guainía">Guainía</option>
                                <option value="Córdoba">Córdoba</option>
                                <option value="Cundinamarca">Cundinamarca</option>
                                <option value="Chocó">Chocó</option>
                                <option value="Cesar">Cesar</option>
                                <option value="Cauca">Cauca</option>
                                <option value="Casanare">Casanare</option>
                                <option value="Caquetá">Caquetá</option>
                                <option value="Caldas">Caldas</option>
                                <option value="Boyacá">Boyacá</option>
                                <option value="Bolívar">Bolívar</option>
                                <option value="Atlántico">Atlántico</option>
                                <option value="Arauca">Arauca</option>
                                <option value="Antioquia">Antioquia</option>
                                <option value="Amazonas">Amazonas</option>
                                <option value="" selected="">Escoja un departamento</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Ciudad</label>
                            <select class="form-control input-lg" id="ciudad" name="ciudad" style="width: 100%;" data-select2-id="9" tabindex="-1" aria-hidden="true" aria-labelledby="select2-single-container" aria-owns="select2-single-results" aria-activedescendant="select2-single-result-3oxl-AK">
                                <option value="Santa Rosalía">Santa Rosalía</option>
                                <option value="Puerto Carreño">Puerto Carreño</option>
                                <option value="La Primavera">La Primavera</option>
                                <option value="Cumaribo">Cumaribo</option>
                                <option value="Taraira">Taraira</option>
                                <option value="Mitú">Mitú</option>
                                <option value="Carurú">Carurú</option>
                                <option value="Zarzal">Zarzal</option>
                                <option value="Yumbo">Yumbo</option>
                                <option value="Yotoco">Yotoco</option>
                                <option value="Vijes">Vijes</option>
                                <option value="Versalles">Versalles</option>
                                <option value="Ulloa">Ulloa</option>
                                <option value="Tuluá">Tuluá</option>
                                <option value="Trujillo">Trujillo</option>
                                <option value="Toro">Toro</option>
                                <option value="Sevilla">Sevilla</option>
                                <option value="San Pedro">San Pedro</option>
                                <option value="Roldanillo">Roldanillo</option>
                                <option value="Riofrío">Riofrío</option>
                                <option value="Restrepo">Restrepo</option>
                                <option value="Pradera">Pradera</option>
                                <option value="Palmira">Palmira</option>
                                <option value="Obando">Obando</option>
                                <option value="La Victoria">La Victoria</option>
                                <option value="La Unión">La Unión</option>
                                <option value="La Cumbre">La Cumbre</option>
                                <option value="Jamundí">Jamundí</option>
                                <option value="Guacarí">Guacarí</option>
                                <option value="Ginebra">Ginebra</option>
                                <option value="Florida">Florida</option>
                                <option value="El Dovio">El Dovio</option>
                                <option value="El Cerrito">El Cerrito</option>
                                <option value="El Cairo">El Cairo</option>
                                <option value="El Águila">El Águila</option>
                                <option value="Dagua">Dagua</option>
                                <option value="Cartago">Cartago</option>
                                <option value="Candelaria">Candelaria</option>
                                <option value="Calima">Calima</option>
                                <option value="Cali">Cali</option>
                                <option value="Caicedonia">Caicedonia</option>
                                <option value="Bugalagrande">Bugalagrande</option>
                                <option value="Buga">Buga</option>
                                <option value="Buenaventura">Buenaventura</option>
                                <option value="Bolívar">Bolívar</option>
                                <option value="Argelia">Argelia</option>
                                <option value="Ansermanuevo">Ansermanuevo</option>
                                <option value="Andalucía">Andalucía</option>
                                <option value="Alcalá">Alcalá</option>
                                <option value="Villarrica">Villarrica</option>
                                <option value="Villahermosa">Villahermosa</option>
                                <option value="Venadillo">Venadillo</option>
                                <option value="Valle de San Juan">Valle de San Juan</option>
                                <option value="Suárez">Suárez</option>
                                <option value="Santa Isabel">Santa Isabel</option>
                                <option value="San Luis">San Luis</option>
                                <option value="San Antonio">San Antonio</option>
                                <option value="Saldaña">Saldaña</option>
                                <option value="Rovira">Rovira</option>
                                <option value="Roncesvalles">Roncesvalles</option>
                                <option value="Rioblanco">Rioblanco</option>
                                <option value="Purificación">Purificación</option>
                                <option value="Prado">Prado</option>
                                <option value="Planadas">Planadas</option>
                                <option value="Piedras">Piedras</option>
                                <option value="Palocabildo">Palocabildo</option>
                                <option value="Ortega">Ortega</option>
                                <option value="Natagaima">Natagaima</option>
                                <option value="Murillo">Murillo</option>
                                <option value="Melgar">Melgar</option>
                                <option value="Mariquita">Mariquita</option>
                                <option value="Líbano">Líbano</option>
                                <option value="Lérida">Lérida</option>
                                <option value="Icononzo">Icononzo</option>
                                <option value="Ibagué">Ibagué</option>
                                <option value="Honda">Honda</option>
                                <option value="Herveo">Herveo</option>
                                <option value="Guamo">Guamo</option>
                                <option value="Fresno">Fresno</option>
                                <option value="Flandes">Flandes</option>
                                <option value="Falán">Falán</option>
                                <option value="El Espinal">El Espinal</option>
                                <option value="Dolores">Dolores</option>
                                <option value="Cunday">Cunday</option>
                                <option value="Coyaima">Coyaima</option>
                                <option value="Coello">Coello</option>
                                <option value="Chaparral">Chaparral</option>
                                <option value="Casabianca">Casabianca</option>
                                <option value="Carmen de Apicalá">Carmen de Apicalá</option>
                                <option value="Cajamarca">Cajamarca</option>
                                <option value="Ataco">Ataco</option>
                                <option value="Armero">Armero</option>
                                <option value="Anzoátegui">Anzoátegui</option>
                                <option value="Ambalema">Ambalema</option>
                                <option value="Alvarado">Alvarado</option>
                                <option value="Alpujarra">Alpujarra</option>
                                <option value="Tolú Viejo">Tolú Viejo</option>
                                <option value="Tolú">Tolú</option>
                                <option value="Sucre">Sucre</option>
                                <option value="Sincelejo">Sincelejo</option>
                                <option value="Sincé">Sincé</option>
                                <option value="San Pedro">San Pedro</option>
                                <option value="San Onofre">San Onofre</option>
                                <option value="San Marcos">San Marcos</option>
                                <option value="San Juan de Betulia">San Juan de Betulia</option>
                                <option value="San Benito Abad">San Benito Abad</option>
                                <option value="San Antonio de Palmito">San Antonio de Palmito</option>
                                <option value="Sampués">Sampués</option>
                                <option value="Ovejas">Ovejas</option>
                                <option value="Morroa">Morroa</option>
                                <option value="Majagual">Majagual</option>
                                <option value="Los Palmitos">Los Palmitos</option>
                                <option value="La Unión">La Unión</option>
                                <option value="Guaranda">Guaranda</option>
                                <option value="Galeras">Galeras</option>
                                <option value="El Roble">El Roble</option>
                                <option value="Coveñas">Coveñas</option>
                                <option value="Corozal">Corozal</option>
                                <option value="Colosó">Colosó</option>
                                <option value="Chalán">Chalán</option>
                                <option value="Caimito">Caimito</option>
                                <option value="Buenavista">Buenavista</option>
                                <option value="Zapatoca">Zapatoca</option>
                                <option value="Villanueva">Villanueva</option>
                                <option value="Vetas">Vetas</option>
                                <option value="Vélez">Vélez</option>
                                <option value="Valle de San José">Valle de San José</option>
                                <option value="Tona">Tona</option>
                                <option value="Suratá">Suratá</option>
                                <option value="Sucre">Sucre</option>
                                <option value="Suaita">Suaita</option>
                                <option value="Simacota">Simacota</option>
                                <option value="Santa Helena del Opón">Santa Helena del Opón</option>
                                <option value="Santa Bárbara">Santa Bárbara</option>
                                <option value="San Vicente de Chucurí">San Vicente de Chucurí</option>
                                <option value="San Miguel">San Miguel</option>
                                <option value="San José de Miranda">San José de Miranda</option>
                                <option value="San Joaquín">San Joaquín</option>
                                <option value="San Gil">San Gil</option>
                                <option value="San Benito">San Benito</option>
                                <option value="San Andrés">San Andrés</option>
                                <option value="Sabana de Torres">Sabana de Torres</option>
                                <option value="Rionegro">Rionegro</option>
                                <option value="Puerto Wilches">Puerto Wilches</option>
                                <option value="Puerto Parra">Puerto Parra</option>
                                <option value="Puente Nacional">Puente Nacional</option>
                                <option value="Pinchote">Pinchote</option>
                                <option value="Piedecuesta">Piedecuesta</option>
                                <option value="Páramo">Páramo</option>
                                <option value="Palmas del Socorro">Palmas del Socorro</option>
                                <option value="Palmar">Palmar</option>
                                <option value="Onzaga">Onzaga</option>
                                <option value="Oiba">Oiba</option>
                                <option value="Ocamonte">Ocamonte</option>
                                <option value="Molagavita">Molagavita</option>
                                <option value="Mogotes">Mogotes</option>
                                <option value="Matanza">Matanza</option>
                                <option value="Málaga">Málaga</option>
                                <option value="Macaravita">Macaravita</option>
                                <option value="Los Santos">Los Santos</option>
                                <option value="Lebrija">Lebrija</option>
                                <option value="Landázuri">Landázuri</option>
                                <option value="La Paz">La Paz</option>
                                <option value="La Belleza">La Belleza</option>
                                <option value="Jordán">Jordán</option>
                                <option value="Jesús María">Jesús María</option>
                                <option value="Hato">Hato</option>
                                <option value="Güepsa">Güepsa</option>
                                <option value="Guavatá">Guavatá</option>
                                <option value="Guapotá">Guapotá</option>
                                <option value="Guadalupe">Guadalupe</option>
                                <option value="Guaca">Guaca</option>
                                <option value="Girón">Girón</option>
                                <option value="Gámbita">Gámbita</option>
                                <option value="Galán">Galán</option>
                                <option value="Floridablanca">Floridablanca</option>
                                <option value="Florián">Florián</option>
                                <option value="Enciso">Enciso</option>
                                <option value="Encino">Encino</option>
                                <option value="El Socorro">El Socorro</option>
                                <option value="El Playón">El Playón</option>
                                <option value="El Peñón">El Peñón</option>
                                <option value="El Guacamayo">El Guacamayo</option>
                                <option value="El Carmen de Chucurí">El Carmen de Chucurí</option>
                                <option value="Curití">Curití</option>
                                <option value="Coromoro">Coromoro</option>
                                <option value="Contratación">Contratación</option>
                                <option value="Confines">Confines</option>
                                <option value="Concepción">Concepción</option>
                                <option value="Cimitarra">Cimitarra</option>
                                <option value="Chipatá">Chipatá</option>
                                <option value="Chima">Chima</option>
                                <option value="Charta">Charta</option>
                                <option value="Charalá">Charalá</option>
                                <option value="Cerrito">Cerrito</option>
                                <option value="Cepitá">Cepitá</option>
                                <option value="Carcasí">Carcasí</option>
                                <option value="Capitanejo">Capitanejo</option>
                                <option value="California">California</option>
                                <option value="Cabrera">Cabrera</option>
                                <option value="Bucaramanga">Bucaramanga</option>
                                <option value="Bolívar">Bolívar</option>
                                <option value="Betulia">Betulia</option>
                                <option value="Barrancabermeja">Barrancabermeja</option>
                                <option value="Barichara">Barichara</option>
                                <option value="Barbosa">Barbosa</option>
                                <option value="Aratoca">Aratoca</option>
                                <option value="Albania">Albania</option>
                                <option value="Aguada">Aguada</option>
                                <option value="San Andrés">San Andrés</option>
                                <option value="Providencia y Santa Catalina Islas">Providencia y Santa Catalina Islas</option>
                                <option value="Santuario">Santuario</option>
                                <option value="Santa Rosa de Cabal">Santa Rosa de Cabal</option>
                                <option value="Quinchía">Quinchía</option>
                                <option value="Pueblo Rico">Pueblo Rico</option>
                                <option value="Pereira">Pereira</option>
                                <option value="Mistrató">Mistrató</option>
                                <option value="Marsella">Marsella</option>
                                <option value="La Virginia">La Virginia</option>
                                <option value="La Celia">La Celia</option>
                                <option value="Guática">Guática</option>
                                <option value="Dosquebradas">Dosquebradas</option>
                                <option value="Belén de Umbría">Belén de Umbría</option>
                                <option value="Balboa">Balboa</option>
                                <option value="Apía">Apía</option>
                                <option value="Salento">Salento</option>
                                <option value="Quimbaya">Quimbaya</option>
                                <option value="Pijao">Pijao</option>
                                <option value="Montenegro">Montenegro</option>
                                <option value="La Tebaida">La Tebaida</option>
                                <option value="Génova">Génova</option>
                                <option value="Filandia">Filandia</option>
                                <option value="Córdoba">Córdoba</option>
                                <option value="Circasia">Circasia</option>
                                <option value="Calarcá">Calarcá</option>
                                <option value="Buenavista">Buenavista</option>
                                <option value="Armenia">Armenia</option>
                                <option value="Villagarzón">Villagarzón</option>
                                <option value="Valle del Guamuez">Valle del Guamuez</option>
                                <option value="Sibundoy">Sibundoy</option>
                                <option value="Santiago">Santiago</option>
                                <option value="San Miguel">San Miguel</option>
                                <option value="San Francisco">San Francisco</option>
                                <option value="Puerto Leguízamo">Puerto Leguízamo</option>
                                <option value="Puerto Guzmán">Puerto Guzmán</option>
                                <option value="Puerto Caicedo">Puerto Caicedo</option>
                                <option value="Puerto Asís">Puerto Asís</option>
                                <option value="Orito">Orito</option>
                                <option value="Mocoa">Mocoa</option>
                                <option value="Colón">Colón</option>
                                <option value="Villa del Rosario">Villa del Rosario</option>
                                <option value="Villa Caro">Villa Caro</option>
                                <option value="Toledo">Toledo</option>
                                <option value="Tibú">Tibú</option>
                                <option value="Teorama">Teorama</option>
                                <option value="Sardinata">Sardinata</option>
                                <option value="Santo Domingo de Silos">Santo Domingo de Silos</option>
                                <option value="Santiago">Santiago</option>
                                <option value="San Cayetano">San Cayetano</option>
                                <option value="San Calixto">San Calixto</option>
                                <option value="Salazar de Las Palmas">Salazar de Las Palmas</option>
                                <option value="Ragonvalia">Ragonvalia</option>
                                <option value="Puerto Santander">Puerto Santander</option>
                                <option value="Pamplonita">Pamplonita</option>
                                <option value="Pamplona">Pamplona</option>
                                <option value="Ocaña">Ocaña</option>
                                <option value="Mutiscua">Mutiscua</option>
                                <option value="Lourdes">Lourdes</option>
                                <option value="Los Patios">Los Patios</option>
                                <option value="Labateca">Labateca</option>
                                <option value="La Playa de Belén">La Playa de Belén</option>
                                <option value="La Esperanza">La Esperanza</option>
                                <option value="Herrán">Herrán</option>
                                <option value="Hacarí">Hacarí</option>
                                <option value="Gramalote">Gramalote</option>
                                <option value="El Zulia">El Zulia</option>
                                <option value="El Tarra">El Tarra</option>
                                <option value="El Carmen">El Carmen</option>
                                <option value="Duranía">Duranía</option>
                                <option value="Cucutilla">Cucutilla</option>
                                <option value="Cúcuta">Cúcuta</option>
                                <option value="Convención">Convención</option>
                                <option value="Chitagá">Chitagá</option>
                                <option value="Chinácota">Chinácota</option>
                                <option value="Cácota">Cácota</option>
                                <option value="Cáchira">Cáchira</option>
                                <option value="Bucarasica">Bucarasica</option>
                                <option value="Bochalema">Bochalema</option>
                                <option value="Arboledas">Arboledas</option>
                                <option value="Ábrego">Ábrego</option>
                                <option value="Yacuanquer">Yacuanquer</option>
                                <option value="Túquerres">Túquerres</option>
                                <option value="Tumaco">Tumaco</option>
                                <option value="Tangua">Tangua</option>
                                <option value="Taminango">Taminango</option>
                                <option value="Sapuyes">Sapuyes</option>
                                <option value="Santacruz">Santacruz</option>
                                <option value="Santa Bárbara">Santa Bárbara</option>
                                <option value="Sandoná">Sandoná</option>
                                <option value="San Pedro de Cartago">San Pedro de Cartago</option>
                                <option value="San Pablo">San Pablo</option>
                                <option value="San Lorenzo">San Lorenzo</option>
                                <option value="San José de Albán">San José de Albán</option>
                                <option value="San Bernardo">San Bernardo</option>
                                <option value="Samaniego">Samaniego</option>
                                <option value="Roberto Payán">Roberto Payán</option>
                                <option value="Ricaurte">Ricaurte</option>
                                <option value="Pupiales">Pupiales</option>
                                <option value="Puerres">Puerres</option>
                                <option value="Providencia">Providencia</option>
                                <option value="Potosí">Potosí</option>
                                <option value="Policarpa">Policarpa</option>
                                <option value="Pasto">Pasto</option>
                                <option value="Ospina">Ospina</option>
                                <option value="Olaya Herrera">Olaya Herrera</option>
                                <option value="Nariño">Nariño</option>
                                <option value="Mosquera">Mosquera</option>
                                <option value="Mallama">Mallama</option>
                                <option value="Magüí Payán">Magüí Payán</option>
                                <option value="Los Andes">Los Andes</option>
                                <option value="Linares">Linares</option>
                                <option value="Leiva">Leiva</option>
                                <option value="La Unión">La Unión</option>
                                <option value="La Tola">La Tola</option>
                                <option value="La Llanada">La Llanada</option>
                                <option value="La Florida">La Florida</option>
                                <option value="La Cruz">La Cruz</option>
                                <option value="Ipiales">Ipiales</option>
                                <option value="Imués">Imués</option>
                                <option value="Iles">Iles</option>
                                <option value="Gualmatán">Gualmatán</option>
                                <option value="Guaitarilla">Guaitarilla</option>
                                <option value="Guachucal">Guachucal</option>
                                <option value="Funes">Funes</option>
                                <option value="Francisco Pizarro">Francisco Pizarro</option>
                                <option value="El Tambo">El Tambo</option>
                                <option value="El Tablón">El Tablón</option>
                                <option value="El Rosario">El Rosario</option>
                                <option value="El Peñol">El Peñol</option>
                                <option value="El Charco">El Charco</option>
                                <option value="Cumbitara">Cumbitara</option>
                                <option value="Cumbal">Cumbal</option>
                                <option value="Cuaspud">Cuaspud</option>
                                <option value="Córdoba">Córdoba</option>
                                <option value="Contadero">Contadero</option>
                                <option value="Consacá">Consacá</option>
                                <option value="Colón">Colón</option>
                                <option value="Chachagüí">Chachagüí</option>
                                <option value="Buesaco">Buesaco</option>
                                <option value="Belén">Belén</option>
                                <option value="Barbacoas">Barbacoas</option>
                                <option value="Arboleda">Arboleda</option>
                                <option value="Ancuyá">Ancuyá</option>
                                <option value="Aldana">Aldana</option>
                                <option value="Vista Hermosa">Vista Hermosa</option>
                                <option value="Villavicencio">Villavicencio</option>
                                <option value="San Martín">San Martín</option>
                                <option value="San Juanito">San Juanito</option>
                                <option value="San Juan de Arama">San Juan de Arama</option>
                                <option value="San Carlos de Guaroa">San Carlos de Guaroa</option>
                                <option value="Restrepo">Restrepo</option>
                                <option value="Puerto Rico">Puerto Rico</option>
                                <option value="Puerto López">Puerto López</option>
                                <option value="Puerto Lleras">Puerto Lleras</option>
                                <option value="Puerto Gaitán">Puerto Gaitán</option>
                                <option value="Puerto Concordia">Puerto Concordia</option>
                                <option value="Mesetas">Mesetas</option>
                                <option value="Mapiripán">Mapiripán</option>
                                <option value="Lejanías">Lejanías</option>
                                <option value="La Uribe">La Uribe</option>
                                <option value="La Macarena">La Macarena</option>
                                <option value="Guamal">Guamal</option>
                                <option value="Granada">Granada</option>
                                <option value="Fuente de Oro">Fuente de Oro</option>
                                <option value="El Dorado">El Dorado</option>
                                <option value="El Castillo">El Castillo</option>
                                <option value="El Calvario">El Calvario</option>
                                <option value="Cumaral">Cumaral</option>
                                <option value="Cubarral">Cubarral</option>
                                <option value="Castilla la Nueva">Castilla la Nueva</option>
                                <option value="Cabuyaro">Cabuyaro</option>
                                <option value="Barranca de Upía">Barranca de Upía</option>
                                <option value="Acacías">Acacías</option>
                                <option value="Zona Bananera">Zona Bananera</option>
                                <option value="Zapayán">Zapayán</option>
                                <option value="Tenerife">Tenerife</option>
                                <option value="Sitionuevo">Sitionuevo</option>
                                <option value="Santa Marta">Santa Marta</option>
                                <option value="Santa Bárbara de Pinto">Santa Bárbara de Pinto</option>
                                <option value="Santa Ana">Santa Ana</option>
                                <option value="San Zenón">San Zenón</option>
                                <option value="San Sebastián de Buenavista">San Sebastián de Buenavista</option>
                                <option value="Salamina">Salamina</option>
                                <option value="Sabanas de San Ángel">Sabanas de San Ángel</option>
                                <option value="Remolino">Remolino</option>
                                <option value="Pueblo Viejo">Pueblo Viejo</option>
                                <option value="Plato">Plato</option>
                                <option value="Pivijay">Pivijay</option>
                                <option value="Pijiño del Carmen">Pijiño del Carmen</option>
                                <option value="Pedraza">Pedraza</option>
                                <option value="Nueva Granada">Nueva Granada</option>
                                <option value="Guamal">Guamal</option>
                                <option value="Fundación">Fundación</option>
                                <option value="El Retén">El Retén</option>
                                <option value="El Piñón">El Piñón</option>
                                <option value="El Banco">El Banco</option>
                                <option value="Concordia">Concordia</option>
                                <option value="Ciénaga">Ciénaga</option>
                                <option value="Chibolo">Chibolo</option>
                                <option value="Chibolo">Chibolo</option>
                                <option value="Cerro de San Antonio">Cerro de San Antonio</option>
                                <option value="Ariguaní">Ariguaní</option>
                                <option value="Aracataca">Aracataca</option>
                                <option value="Algarrobo">Algarrobo</option>
                                <option value="Villanueva">Villanueva</option>
                                <option value="Urumita">Urumita</option>
                                <option value="Uribia">Uribia</option>
                                <option value="San Juan del Cesar">San Juan del Cesar</option>
                                <option value="Riohacha">Riohacha</option>
                                <option value="Manaure">Manaure</option>
                                <option value="Maicao">Maicao</option>
                                <option value="La Jagua del Pilar">La Jagua del Pilar</option>
                                <option value="Hatonuevo">Hatonuevo</option>
                                <option value="Fonseca">Fonseca</option>
                                <option value="El Molino">El Molino</option>
                                <option value="Distracción">Distracción</option>
                                <option value="Dibulla">Dibulla</option>
                                <option value="Barrancas">Barrancas</option>
                                <option value="Albania">Albania</option>
                                <option value="Yaguará">Yaguará</option>
                                <option value="Villavieja">Villavieja</option>
                                <option value="Timaná">Timaná</option>
                                <option value="Tesalia">Tesalia</option>
                                <option value="Teruel">Teruel</option>
                                <option value="Tello">Tello</option>
                                <option value="Tarqui">Tarqui</option>
                                <option value="Suaza">Suaza</option>
                                <option value="Santa María">Santa María</option>
                                <option value="San Agustín">San Agustín</option>
                                <option value="Saladoblanco">Saladoblanco</option>
                                <option value="Rivera">Rivera</option>
                                <option value="Pitalito">Pitalito</option>
                                <option value="Palestina">Palestina</option>
                                <option value="Palermo">Palermo</option>
                                <option value="Paicol">Paicol</option>
                                <option value="Oporapa">Oporapa</option>
                                <option value="Neiva">Neiva</option>
                                <option value="Nátaga">Nátaga</option>
                                <option value="La Plata">La Plata</option>
                                <option value="La Argentina">La Argentina</option>
                                <option value="Isnos">Isnos</option>
                                <option value="Íquira">Íquira</option>
                                <option value="Hobo">Hobo</option>
                                <option value="Guadalupe">Guadalupe</option>
                                <option value="Gigante">Gigante</option>
                                <option value="Garzón">Garzón</option>
                                <option value="Elías">Elías</option>
                                <option value="El Pital">El Pital</option>
                                <option value="Colombia">Colombia</option>
                                <option value="Campoalegre">Campoalegre</option>
                                <option value="Baraya">Baraya</option>
                                <option value="Altamira">Altamira</option>
                                <option value="Algeciras">Algeciras</option>
                                <option value="Aipe">Aipe</option>
                                <option value="Agrado">Agrado</option>
                                <option value="Acevedo">Acevedo</option>
                                <option value="San José del Guaviare">San José del Guaviare</option>
                                <option value="Miraflores">Miraflores</option>
                                <option value="El Retorno">El Retorno</option>
                                <option value="Calamar">Calamar</option>
                                <option value="Inírida">Inírida</option>
                                <option value="Valencia">Valencia</option>
                                <option value="Tuchín">Tuchín</option>
                                <option value="Tierralta">Tierralta</option>
                                <option value="San Pelayo">San Pelayo</option>
                                <option value="San José de Uré">San José de Uré</option>
                                <option value="San Carlos">San Carlos</option>
                                <option value="San Bernardo del Viento">San Bernardo del Viento</option>
                                <option value="San Antero">San Antero</option>
                                <option value="San Andrés de Sotavento">San Andrés de Sotavento</option>
                                <option value="Sahagún">Sahagún</option>
                                <option value="Purísima">Purísima</option>
                                <option value="Puerto Libertador">Puerto Libertador</option>
                                <option value="Puerto Escondido">Puerto Escondido</option>
                                <option value="Pueblo Nuevo">Pueblo Nuevo</option>
                                <option value="Planeta Rica">Planeta Rica</option>
                                <option value="Moñitos">Moñitos</option>
                                <option value="Montería">Montería</option>
                                <option value="Montelíbano">Montelíbano</option>
                                <option value="Momil">Momil</option>
                                <option value="Los Córdobas">Los Córdobas</option>
                                <option value="Lorica">Lorica</option>
                                <option value="La Apartada">La Apartada</option>
                                <option value="Cotorra">Cotorra</option>
                                <option value="Ciénaga de Oro">Ciénaga de Oro</option>
                                <option value="Chinú">Chinú</option>
                                <option value="Chimá">Chimá</option>
                                <option value="Cereté">Cereté</option>
                                <option value="Canalete">Canalete</option>
                                <option value="Buenavista">Buenavista</option>
                                <option value="Ayapel">Ayapel</option>
                                <option value="Zipaquirá">Zipaquirá</option>
                                <option value="Zipacón">Zipacón</option>
                                <option value="Yacopí">Yacopí</option>
                                <option value="Viotá">Viotá</option>
                                <option value="Villeta">Villeta</option>
                                <option value="Villapinzón">Villapinzón</option>
                                <option value="Villagómez">Villagómez</option>
                                <option value="Vianí">Vianí</option>
                                <option value="Vergara">Vergara</option>
                                <option value="Venecia">Venecia</option>
                                <option value="Útica">Útica</option>
                                <option value="Une">Une</option>
                                <option value="Ubaté">Ubaté</option>
                                <option value="Ubaque">Ubaque</option>
                                <option value="Ubalá">Ubalá</option>
                                <option value="Topaipí">Topaipí</option>
                                <option value="Tocancipá">Tocancipá</option>
                                <option value="Tocaima">Tocaima</option>
                                <option value="Tibirita">Tibirita</option>
                                <option value="Tibacuy">Tibacuy</option>
                                <option value="Tenjo">Tenjo</option>
                                <option value="Tena">Tena</option>
                                <option value="Tausa">Tausa</option>
                                <option value="Tabio">Tabio</option>
                                <option value="Sutatausa">Sutatausa</option>
                                <option value="Susa">Susa</option>
                                <option value="Supatá">Supatá</option>
                                <option value="Suesca">Suesca</option>
                                <option value="Subachoque">Subachoque</option>
                                <option value="Sopó">Sopó</option>
                                <option value="Soacha">Soacha</option>
                                <option value="Simijaca">Simijaca</option>
                                <option value="Silvania">Silvania</option>
                                <option value="Sibaté">Sibaté</option>
                                <option value="Sesquilé">Sesquilé</option>
                                <option value="Sasaima">Sasaima</option>
                                <option value="San Juan de Rioseco">San Juan de Rioseco</option>
                                <option value="San Francisco">San Francisco</option>
                                <option value="San Cayetano">San Cayetano</option>
                                <option value="San Bernardo">San Bernardo</option>
                                <option value="San Antonio del Tequendama">San Antonio del Tequendama</option>
                                <option value="Ricaurte">Ricaurte</option>
                                <option value="Quipile">Quipile</option>
                                <option value="Quetame">Quetame</option>
                                <option value="Quebradanegra">Quebradanegra</option>
                                <option value="Pulí">Pulí</option>
                                <option value="Puerto Salgar">Puerto Salgar</option>
                                <option value="Pasca">Pasca</option>
                                <option value="Paratebueno">Paratebueno</option>
                                <option value="Pandi">Pandi</option>
                                <option value="Paime">Paime</option>
                                <option value="Pacho">Pacho</option>
                                <option value="Nocaima">Nocaima</option>
                                <option value="Nimaima">Nimaima</option>
                                <option value="Nilo">Nilo</option>
                                <option value="Nemocón">Nemocón</option>
                                <option value="Nariño">Nariño</option>
                                <option value="Mosquera">Mosquera</option>
                                <option value="Medina">Medina</option>
                                <option value="Manta">Manta</option>
                                <option value="Madrid">Madrid</option>
                                <option value="Machetá">Machetá</option>
                                <option value="Lenguazaque">Lenguazaque</option>
                                <option value="La Vega">La Vega</option>
                                <option value="La Peña">La Peña</option>
                                <option value="La Palma">La Palma</option>
                                <option value="La Mesa">La Mesa</option>
                                <option value="La Calera">La Calera</option>
                                <option value="Junín">Junín</option>
                                <option value="Jerusalén">Jerusalén</option>
                                <option value="Gutiérrez">Gutiérrez</option>
                                <option value="Guayabetal">Guayabetal</option>
                                <option value="Guayabal de Síquima">Guayabal de Síquima</option>
                                <option value="Guatavita">Guatavita</option>
                                <option value="Guataquí">Guataquí</option>
                                <option value="Guasca">Guasca</option>
                                <option value="Guaduas">Guaduas</option>
                                <option value="Guachetá">Guachetá</option>
                                <option value="Granada">Granada</option>
                                <option value="Girardot">Girardot</option>
                                <option value="Gama">Gama</option>
                                <option value="Gachetá">Gachetá</option>
                                <option value="Gachancipá">Gachancipá</option>
                                <option value="Gachalá">Gachalá</option>
                                <option value="Fusagasugá">Fusagasugá</option>
                                <option value="Fúquene">Fúquene</option>
                                <option value="Funza">Funza</option>
                                <option value="Fosca">Fosca</option>
                                <option value="Fómeque">Fómeque</option>
                                <option value="Facatativá">Facatativá</option>
                                <option value="El Rosal">El Rosal</option>
                                <option value="El Peñón">El Peñón</option>
                                <option value="El Colegio">El Colegio</option>
                                <option value="Cucunubá">Cucunubá</option>
                                <option value="Cota">Cota</option>
                                <option value="Cogua">Cogua</option>
                                <option value="Chocontá">Chocontá</option>
                                <option value="Choachí">Choachí</option>
                                <option value="Chipaque">Chipaque</option>
                                <option value="Chía">Chía</option>
                                <option value="Chaguaní">Chaguaní</option>
                                <option value="Carmen de Carupa">Carmen de Carupa</option>
                                <option value="Cáqueza">Cáqueza</option>
                                <option value="Caparrapí">Caparrapí</option>
                                <option value="Cajicá">Cajicá</option>
                                <option value="Cachipay">Cachipay</option>
                                <option value="Cabrera">Cabrera</option>
                                <option value="Bojacá">Bojacá</option>
                                <option value="Bogotá">Bogotá</option>
                                <option value="Bituima">Bituima</option>
                                <option value="Beltrán">Beltrán</option>
                                <option value="Arbeláez">Arbeláez</option>
                                <option value="Apulo">Apulo</option>
                                <option value="Anolaima">Anolaima</option>
                                <option value="Anapoima">Anapoima</option>
                                <option value="Albán">Albán</option>
                                <option value="Agua de Dios">Agua de Dios</option>
                                <option value="Unguía">Unguía</option>
                                <option value="Unión Panamericana">Unión Panamericana</option>
                                <option value="Tadó">Tadó</option>
                                <option value="Sipí">Sipí</option>
                                <option value="San José del Palmar">San José del Palmar</option>
                                <option value="Riosucio">Riosucio</option>
                                <option value="Río Quito">Río Quito</option>
                                <option value="Río Iró">Río Iró</option>
                                <option value="Quibdó">Quibdó</option>
                                <option value="Nuquí">Nuquí</option>
                                <option value="Nóvita">Nóvita</option>
                                <option value="Medio San Juan">Medio San Juan</option>
                                <option value="Medio Baudó">Medio Baudó</option>
                                <option value="Medio Atrato">Medio Atrato</option>
                                <option value="Lloró">Lloró</option>
                                <option value="Litoral de San Juan">Litoral de San Juan</option>
                                <option value="Juradó">Juradó</option>
                                <option value="Istmina">Istmina</option>
                                <option value="El Carmen del Darién">El Carmen del Darién</option>
                                <option value="El Carmen de Atrato">El Carmen de Atrato</option>
                                <option value="El Atrato">El Atrato</option>
                                <option value="Condoto">Condoto</option>
                                <option value="Cértegui">Cértegui</option>
                                <option value="Cantón de San Pablo">Cantón de San Pablo</option>
                                <option value="Bojayá">Bojayá</option>
                                <option value="Bajo Baudó">Bajo Baudó</option>
                                <option value="Bahía Solano">Bahía Solano</option>
                                <option value="Bagadó">Bagadó</option>
                                <option value="Alto Baudó">Alto Baudó</option>
                                <option value="Acandí">Acandí</option>
                                <option value="Valledupar">Valledupar</option>
                                <option value="Tamalameque">Tamalameque</option>
                                <option value="San Martín">San Martín</option>
                                <option value="San Diego">San Diego</option>
                                <option value="San Alberto">San Alberto</option>
                                <option value="Río de Oro">Río de Oro</option>
                                <option value="Pueblo Bello">Pueblo Bello</option>
                                <option value="Pelaya">Pelaya</option>
                                <option value="Pailitas">Pailitas</option>
                                <option value="Manaure Balcón del Cesar">Manaure Balcón del Cesar</option>
                                <option value="La Paz">La Paz</option>
                                <option value="La Jagua de Ibirico">La Jagua de Ibirico</option>
                                <option value="La Gloria (Cesar)">La Gloria (Cesar)</option>
                                <option value="González">González</option>
                                <option value="Gamarra">Gamarra</option>
                                <option value="El Paso">El Paso</option>
                                <option value="El Copey">El Copey</option>
                                <option value="Curumaní">Curumaní</option>
                                <option value="Chiriguaná">Chiriguaná</option>
                                <option value="Chimichagua">Chimichagua</option>
                                <option value="Bosconia">Bosconia</option>
                                <option value="Becerril">Becerril</option>
                                <option value="Astrea">Astrea</option>
                                <option value="Agustín Codazzi">Agustín Codazzi</option>
                                <option value="Aguachica">Aguachica</option>
                                <option value="Villa Rica">Villa Rica</option>
                                <option value="Totoró">Totoró</option>
                                <option value="Toribío">Toribío</option>
                                <option value="Timbiquí">Timbiquí</option>
                                <option value="Timbío">Timbío</option>
                                <option value="Sucre">Sucre</option>
                                <option value="Suárez">Suárez</option>
                                <option value="Sotará">Sotará</option>
                                <option value="Silvia">Silvia</option>
                                <option value="Santander de Quilichao">Santander de Quilichao</option>
                                <option value="Santa Rosa">Santa Rosa</option>
                                <option value="San Sebastián">San Sebastián</option>
                                <option value="Rosas">Rosas</option>
                                <option value="Puracé">Puracé</option>
                                <option value="Puerto Tejada">Puerto Tejada</option>
                                <option value="Popayán">Popayán</option>
                                <option value="Piendamó">Piendamó</option>
                                <option value="Piamonte">Piamonte</option>
                                <option value="Patía">Patía</option>
                                <option value="Páez">Páez</option>
                                <option value="Padilla">Padilla</option>
                                <option value="Morales">Morales</option>
                                <option value="Miranda">Miranda</option>
                                <option value="Mercaderes">Mercaderes</option>
                                <option value="López de Micay">López de Micay</option>
                                <option value="La Vega">La Vega</option>
                                <option value="La Sierra">La Sierra</option>
                                <option value="Jambaló">Jambaló</option>
                                <option value="Inzá">Inzá</option>
                                <option value="Guapí">Guapí</option>
                                <option value="Guachené">Guachené</option>
                                <option value="Florencia">Florencia</option>
                                <option value="El Tambo">El Tambo</option>
                                <option value="Corinto">Corinto</option>
                                <option value="Caloto">Caloto</option>
                                <option value="Caldono">Caldono</option>
                                <option value="Cajibío">Cajibío</option>
                                <option value="Buenos Aires">Buenos Aires</option>
                                <option value="Bolívar">Bolívar</option>
                                <option value="Balboa">Balboa</option>
                                <option value="Argelia">Argelia</option>
                                <option value="Almaguer">Almaguer</option>
                                <option value="Yopal">Yopal</option>
                                <option value="Villanueva">Villanueva</option>
                                <option value="Trinidad">Trinidad</option>
                                <option value="Tauramena">Tauramena</option>
                                <option value="Támara">Támara</option>
                                <option value="San Luis de Palenque">San Luis de Palenque</option>
                                <option value="Sácama">Sácama</option>
                                <option value="Sabanalarga">Sabanalarga</option>
                                <option value="Recetor">Recetor</option>
                                <option value="Pore">Pore</option>
                                <option value="Paz de Ariporo">Paz de Ariporo</option>
                                <option value="Orocué">Orocué</option>
                                <option value="Nunchía">Nunchía</option>
                                <option value="Monterrey">Monterrey</option>
                                <option value="Maní">Maní</option>
                                <option value="La Salina">La Salina</option>
                                <option value="Hato Corozal">Hato Corozal</option>
                                <option value="Chámeza">Chámeza</option>
                                <option value="Aguazul">Aguazul</option>
                                <option value="Valparaíso">Valparaíso</option>
                                <option value="Solita">Solita</option>
                                <option value="Solano">Solano</option>
                                <option value="San Vicente del Caguán">San Vicente del Caguán</option>
                                <option value="San José del Fragua">San José del Fragua</option>
                                <option value="Puerto Rico">Puerto Rico</option>
                                <option value="Morelia">Morelia</option>
                                <option value="Milán">Milán</option>
                                <option value="La Montañita">La Montañita</option>
                                <option value="Florencia">Florencia</option>
                                <option value="El Paujil">El Paujil</option>
                                <option value="El Doncello">El Doncello</option>
                                <option value="Curillo">Curillo</option>
                                <option value="Cartagena del Chairá">Cartagena del Chairá</option>
                                <option value="Belén de los Andaquíes">Belén de los Andaquíes</option>
                                <option value="Albania">Albania</option>
                                <option value="Viterbo">Viterbo</option>
                                <option value="Villamaría">Villamaría</option>
                                <option value="Victoria">Victoria</option>
                                <option value="Supía">Supía</option>
                                <option value="San José">San José</option>
                                <option value="Samaná">Samaná</option>
                                <option value="Salamina">Salamina</option>
                                <option value="Risaralda">Risaralda</option>
                                <option value="Riosucio">Riosucio</option>
                                <option value="Pensilvania">Pensilvania</option>
                                <option value="Palestina">Palestina</option>
                                <option value="Pácora">Pácora</option>
                                <option value="Norcasia">Norcasia</option>
                                <option value="Neira">Neira</option>
                                <option value="Marulanda">Marulanda</option>
                                <option value="Marquetalia">Marquetalia</option>
                                <option value="Marmato">Marmato</option>
                                <option value="Manzanares">Manzanares</option>
                                <option value="Manizales">Manizales</option>
                                <option value="La Merced">La Merced</option>
                                <option value="La Dorada">La Dorada</option>
                                <option value="Filadelfia">Filadelfia</option>
                                <option value="Chinchiná">Chinchiná</option>
                                <option value="Belalcázar">Belalcázar</option>
                                <option value="Aranzazu">Aranzazu</option>
                                <option value="Anserma">Anserma</option>
                                <option value="Aguadas">Aguadas</option>
                                <option value="Zetaquira">Zetaquira</option>
                                <option value="Viracachá">Viracachá</option>
                                <option value="Villa de Leyva">Villa de Leyva</option>
                                <option value="Ventaquemada">Ventaquemada</option>
                                <option value="Úmbita">Úmbita</option>
                                <option value="Tutazá">Tutazá</option>
                                <option value="Tuta">Tuta</option>
                                <option value="Turmequé">Turmequé</option>
                                <option value="Tununguá">Tununguá</option>
                                <option value="Tunja">Tunja</option>
                                <option value="Tota">Tota</option>
                                <option value="Tópaga">Tópaga</option>
                                <option value="Togüí">Togüí</option>
                                <option value="Toca">Toca</option>
                                <option value="Tipacoque">Tipacoque</option>
                                <option value="Tinjacá">Tinjacá</option>
                                <option value="Tibasosa">Tibasosa</option>
                                <option value="Tibaná">Tibaná</option>
                                <option value="Tenza">Tenza</option>
                                <option value="Tasco">Tasco</option>
                                <option value="Sutatenza">Sutatenza</option>
                                <option value="Sutamarchán">Sutamarchán</option>
                                <option value="Susacón">Susacón</option>
                                <option value="Sotaquirá">Sotaquirá</option>
                                <option value="Soracá">Soracá</option>
                                <option value="Sora">Sora</option>
                                <option value="Somondoco">Somondoco</option>
                                <option value="Sogamoso">Sogamoso</option>
                                <option value="Socotá">Socotá</option>
                                <option value="Socha">Socha</option>
                                <option value="Soatá">Soatá</option>
                                <option value="Siachoque">Siachoque</option>
                                <option value="Sativasur">Sativasur</option>
                                <option value="Sativanorte">Sativanorte</option>
                                <option value="Santana">Santana</option>
                                <option value="Santa Sofía">Santa Sofía</option>
                                <option value="Santa Rosa de Viterbo">Santa Rosa de Viterbo</option>
                                <option value="Santa María">Santa María</option>
                                <option value="San Pablo de Borbur">San Pablo de Borbur</option>
                                <option value="San Miguel de Sema">San Miguel de Sema</option>
                                <option value="San Mateo">San Mateo</option>
                                <option value="San Luis de Gaceno">San Luis de Gaceno</option>
                                <option value="San José de Pare">San José de Pare</option>
                                <option value="San Eduardo">San Eduardo</option>
                                <option value="Samacá">Samacá</option>
                                <option value="Sáchica">Sáchica</option>
                                <option value="Saboyá">Saboyá</option>
                                <option value="Rondón">Rondón</option>
                                <option value="Ráquira">Ráquira</option>
                                <option value="Ramiriquí">Ramiriquí</option>
                                <option value="Quípama">Quípama</option>
                                <option value="Puerto Boyacá">Puerto Boyacá</option>
                                <option value="Pisba">Pisba</option>
                                <option value="Pesca">Pesca</option>
                                <option value="Paz del Río">Paz del Río</option>
                                <option value="Paya">Paya</option>
                                <option value="Pauna">Pauna</option>
                                <option value="Panqueba">Panqueba</option>
                                <option value="Pajarito">Pajarito</option>
                                <option value="Paipa">Paipa</option>
                                <option value="Páez">Páez</option>
                                <option value="Pachavita">Pachavita</option>
                                <option value="Otanche">Otanche</option>
                                <option value="Oicatá">Oicatá</option>
                                <option value="Nuevo Colón">Nuevo Colón</option>
                                <option value="Nobsa">Nobsa</option>
                                <option value="Muzo">Muzo</option>
                                <option value="Motavita">Motavita</option>
                                <option value="Moniquirá">Moniquirá</option>
                                <option value="Monguí">Monguí</option>
                                <option value="Mongua">Mongua</option>
                                <option value="Miraflores">Miraflores</option>
                                <option value="Maripí">Maripí</option>
                                <option value="Macanal">Macanal</option>
                                <option value="Labranzagrande">Labranzagrande</option>
                                <option value="La Victoria">La Victoria</option>
                                <option value="La Uvita">La Uvita</option>
                                <option value="La Capilla">La Capilla</option>
                                <option value="Jericó">Jericó</option>
                                <option value="Jenesano">Jenesano</option>
                                <option value="Iza">Iza</option>
                                <option value="Güicán">Güicán</option>
                                <option value="Guayatá">Guayatá</option>
                                <option value="Guateque">Guateque</option>
                                <option value="Guacamayas">Guacamayas</option>
                                <option value="Garagoa">Garagoa</option>
                                <option value="Gámeza">Gámeza</option>
                                <option value="Gachantivá">Gachantivá</option>
                                <option value="Floresta">Floresta</option>
                                <option value="Firavitoba">Firavitoba</option>
                                <option value="El Espino">El Espino</option>
                                <option value="El Cocuy">El Cocuy</option>
                                <option value="Duitama">Duitama</option>
                                <option value="Cuítiva">Cuítiva</option>
                                <option value="Cucaita">Cucaita</option>
                                <option value="Cubará">Cubará</option>
                                <option value="Covarachía">Covarachía</option>
                                <option value="Corrales">Corrales</option>
                                <option value="Coper">Coper</option>
                                <option value="Cómbita">Cómbita</option>
                                <option value="Ciénega">Ciénega</option>
                                <option value="Chivor">Chivor</option>
                                <option value="Chivatá">Chivatá</option>
                                <option value="Chitaraque">Chitaraque</option>
                                <option value="Chita">Chita</option>
                                <option value="Chiscas">Chiscas</option>
                                <option value="Chíquiza">Chíquiza</option>
                                <option value="Chiquinquirá">Chiquinquirá</option>
                                <option value="Chinavita">Chinavita</option>
                                <option value="Cerinza">Cerinza</option>
                                <option value="Campohermoso">Campohermoso</option>
                                <option value="Caldas">Caldas</option>
                                <option value="Busbanzá">Busbanzá</option>
                                <option value="Buenavista">Buenavista</option>
                                <option value="Briceño">Briceño</option>
                                <option value="Boyacá">Boyacá</option>
                                <option value="Boavita">Boavita</option>
                                <option value="Betéitiva">Betéitiva</option>
                                <option value="Berbeo">Berbeo</option>
                                <option value="Belén">Belén</option>
                                <option value="Arcabuco">Arcabuco</option>
                                <option value="Aquitania">Aquitania</option>
                                <option value="Almeida">Almeida</option>
                                <option value="Zambrano">Zambrano</option>
                                <option value="Villanueva">Villanueva</option>
                                <option value="Turbaná">Turbaná</option>
                                <option value="Turbaco">Turbaco</option>
                                <option value="Tiquisio">Tiquisio</option>
                                <option value="Talaigua Nuevo">Talaigua Nuevo</option>
                                <option value="Soplaviento">Soplaviento</option>
                                <option value="Simití">Simití</option>
                                <option value="Santa Rosa del Sur">Santa Rosa del Sur</option>
                                <option value="Santa Rosa">Santa Rosa</option>
                                <option value="Santa Catalina">Santa Catalina</option>
                                <option value="San Pablo">San Pablo</option>
                                <option value="San Martín de Loba">San Martín de Loba</option>
                                <option value="San Juan Nepomuceno">San Juan Nepomuceno</option>
                                <option value="San Jacinto">San Jacinto</option>
                                <option value="San Jacinto del Cauca">San Jacinto del Cauca</option>
                                <option value="San Fernando">San Fernando</option>
                                <option value="San Estanislao">San Estanislao</option>
                                <option value="San Cristóbal">San Cristóbal</option>
                                <option value="Río Viejo">Río Viejo</option>
                                <option value="Regidor">Regidor</option>
                                <option value="Pinillos">Pinillos</option>
                                <option value="Norosí">Norosí</option>
                                <option value="Morales">Morales</option>
                                <option value="Montecristo">Montecristo</option>
                                <option value="Mompós">Mompós</option>
                                <option value="María la Baja">María la Baja</option>
                                <option value="Margarita">Margarita</option>
                                <option value="Mahates">Mahates</option>
                                <option value="Magangué">Magangué</option>
                                <option value="Hatillo de Loba">Hatillo de Loba</option>
                                <option value="El Peñón">El Peñón</option>
                                <option value="El Guamo">El Guamo</option>
                                <option value="El Carmen de Bolívar">El Carmen de Bolívar</option>
                                <option value="Córdoba">Córdoba</option>
                                <option value="Clemencia">Clemencia</option>
                                <option value="Cicuco">Cicuco</option>
                                <option value="Cartagena de Indias">Cartagena de Indias</option>
                                <option value="Cantagallo">Cantagallo</option>
                                <option value="Calamar">Calamar</option>
                                <option value="Brazuelo de Papayal">Brazuelo de Papayal</option>
                                <option value="Barranco de Loba">Barranco de Loba</option>
                                <option value="Arroyohondo">Arroyohondo</option>
                                <option value="Arjona">Arjona</option>
                                <option value="Arenal">Arenal</option>
                                <option value="Altos del Rosario">Altos del Rosario</option>
                                <option value="Achí">Achí</option>
                                <option value="Usiacurí">Usiacurí</option>
                                <option value="Tubará">Tubará</option>
                                <option value="Suán">Suán</option>
                                <option value="Soledad">Soledad</option>
                                <option value="Santo Tomás">Santo Tomás</option>
                                <option value="Santa Lucía">Santa Lucía</option>
                                <option value="Sabanalarga">Sabanalarga</option>
                                <option value="Sabanagrande">Sabanagrande</option>
                                <option value="Repelón">Repelón</option>
                                <option value="Puerto Colombia">Puerto Colombia</option>
                                <option value="Ponedera">Ponedera</option>
                                <option value="Polonuevo">Polonuevo</option>
                                <option value="Piojó">Piojó</option>
                                <option value="Palmar de Varela">Palmar de Varela</option>
                                <option value="Manatí">Manatí</option>
                                <option value="Malambo">Malambo</option>
                                <option value="Luruaco">Luruaco</option>
                                <option value="Juan de Acosta">Juan de Acosta</option>
                                <option value="Galapa">Galapa</option>
                                <option value="Candelaria">Candelaria</option>
                                <option value="Campo de la Cruz">Campo de la Cruz</option>
                                <option value="Barranquilla">Barranquilla</option>
                                <option value="Baranoa">Baranoa</option>
                                <option value="Tame">Tame</option>
                                <option value="Saravena">Saravena</option>
                                <option value="Puerto Rondón">Puerto Rondón</option>
                                <option value="Fortul">Fortul</option>
                                <option value="Cravo Norte">Cravo Norte</option>
                                <option value="Arauquita">Arauquita</option>
                                <option value="Arauca">Arauca</option>
                                <option value="Zaragoza">Zaragoza</option>
                                <option value="Yondó">Yondó</option>
                                <option value="Yolombó">Yolombó</option>
                                <option value="Yarumal">Yarumal</option>
                                <option value="Yalí">Yalí</option>
                                <option value="Vigía del Fuerte">Vigía del Fuerte</option>
                                <option value="Venecia">Venecia</option>
                                <option value="Vegachí">Vegachí</option>
                                <option value="Valparaíso">Valparaíso</option>
                                <option value="Valdivia">Valdivia</option>
                                <option value="Urrao">Urrao</option>
                                <option value="Uramita">Uramita</option>
                                <option value="Turbo">Turbo</option>
                                <option value="Toledo">Toledo</option>
                                <option value="Titiribí">Titiribí</option>
                                <option value="Tarso">Tarso</option>
                                <option value="Tarazá">Tarazá</option>
                                <option value="Támesis">Támesis</option>
                                <option value="Sopetrán">Sopetrán</option>
                                <option value="Sonsón">Sonsón</option>
                                <option value="Segovia">Segovia</option>
                                <option value="Santo Domingo">Santo Domingo</option>
                                <option value="Santa Rosa de Osos">Santa Rosa de Osos</option>
                                <option value="Santa Fe de Antioquia">Santa Fe de Antioquia</option>
                                <option value="Santa Bárbara">Santa Bárbara</option>
                                <option value="San Vicente">San Vicente</option>
                                <option value="San Roque">San Roque</option>
                                <option value="San Rafael">San Rafael</option>
                                <option value="San Pedro de los Milagros">San Pedro de los Milagros</option>
                                <option value="San Pedro de Urabá">San Pedro de Urabá</option>
                                <option value="San Luis">San Luis</option>
                                <option value="San Juan de Urabá">San Juan de Urabá</option>
                                <option value="San José de la Montaña">San José de la Montaña</option>
                                <option value="San Jerónimo">San Jerónimo</option>
                                <option value="San Francisco">San Francisco</option>
                                <option value="San Carlos">San Carlos</option>
                                <option value="San Andrés de Cuerquia">San Andrés de Cuerquia</option>
                                <option value="Salgar">Salgar</option>
                                <option value="Sabaneta">Sabaneta</option>
                                <option value="Sabanalarga">Sabanalarga</option>
                                <option value="Rionegro">Rionegro</option>
                                <option value="Remedios">Remedios</option>
                                <option value="Puerto Triunfo">Puerto Triunfo</option>
                                <option value="Puerto Nare">Puerto Nare</option>
                                <option value="Puerto Berrío">Puerto Berrío</option>
                                <option value="Pueblorrico">Pueblorrico</option>
                                <option value="Peque">Peque</option>
                                <option value="Olaya">Olaya</option>
                                <option value="Necoclí">Necoclí</option>
                                <option value="Nechí">Nechí</option>
                                <option value="Nariño">Nariño</option>
                                <option value="Mutatá">Mutatá</option>
                                <option value="Murindó">Murindó</option>
                                <option value="Montebello">Montebello</option>
                                <option value="Medellín">Medellín</option>
                                <option value="Marinilla">Marinilla</option>
                                <option value="Maceo">Maceo</option>
                                <option value="Liborina">Liborina</option>
                                <option value="La Unión">La Unión</option>
                                <option value="La Pintada">La Pintada</option>
                                <option value="La Estrella">La Estrella</option>
                                <option value="La Ceja">La Ceja</option>
                                <option value="Jericó">Jericó</option>
                                <option value="Jardín">Jardín</option>
                                <option value="Ituango">Ituango</option>
                                <option value="Itagüí">Itagüí</option>
                                <option value="Hispania">Hispania</option>
                                <option value="Heliconia">Heliconia</option>
                                <option value="Guatapé">Guatapé</option>
                                <option value="Guarne">Guarne</option>
                                <option value="Guadalupe">Guadalupe</option>
                                <option value="Granada">Granada</option>
                                <option value="Gómez Plata">Gómez Plata</option>
                                <option value="Girardota">Girardota</option>
                                <option value="Giraldo">Giraldo</option>
                                <option value="Frontino">Frontino</option>
                                <option value="Fredonia">Fredonia</option>
                                <option value="Envigado">Envigado</option>
                                <option value="Entrerríos">Entrerríos</option>
                                <option value="El Santuario">El Santuario</option>
                                <option value="El Retiro">El Retiro</option>
                                <option value="El Peñol">El Peñol</option>
                                <option value="El Carmen de Viboral">El Carmen de Viboral</option>
                                <option value="El Bagre">El Bagre</option>
                                <option value="Ebéjico">Ebéjico</option>
                                <option value="Donmatías">Donmatías</option>
                                <option value="Dabeiba">Dabeiba</option>
                                <option value="Copacabana">Copacabana</option>
                                <option value="Concordia">Concordia</option>
                                <option value="Concepción">Concepción</option>
                                <option value="Cocorná">Cocorná</option>
                                <option value="Ciudad Bolívar">Ciudad Bolívar</option>
                                <option value="Cisneros">Cisneros</option>
                                <option value="Chigorodó">Chigorodó</option>
                                <option value="Caucasia">Caucasia</option>
                                <option value="Carolina del Príncipe">Carolina del Príncipe</option>
                                <option value="Carepa">Carepa</option>
                                <option value="Caramanta">Caramanta</option>
                                <option value="Caracolí">Caracolí</option>
                                <option value="Cañasgordas">Cañasgordas</option>
                                <option value="Campamento">Campamento</option>
                                <option value="Caldas">Caldas</option>
                                <option value="Caicedo">Caicedo</option>
                                <option value="Cáceres">Cáceres</option>
                                <option value="Buriticá">Buriticá</option>
                                <option value="Briceño">Briceño</option>
                                <option value="Betulia">Betulia</option>
                                <option value="Betania">Betania</option>
                                <option value="Belmira">Belmira</option>
                                <option value="Bello">Bello</option>
                                <option value="Barbosa">Barbosa</option>
                                <option value="Armenia">Armenia</option>
                                <option value="Argelia">Argelia</option>
                                <option value="Arboletes">Arboletes</option>
                                <option value="Apartadó">Apartadó</option>
                                <option value="Anzá">Anzá</option>
                                <option value="Anorí">Anorí</option>
                                <option value="Angostura">Angostura</option>
                                <option value="Angelópolis">Angelópolis</option>
                                <option value="Andes">Andes</option>
                                <option value="Amalfi">Amalfi</option>
                                <option value="Amagá">Amagá</option>
                                <option value="Alejandría">Alejandría</option>
                                <option value="Abriaquí">Abriaquí</option>
                                <option value="Abejorral">Abejorral</option>
                                <option value="Puerto Nariño">Puerto Nariño</option>
                                <option value="Leticia">Leticia</option>
                                <option value="" selected="">Seleccione una ciudad</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer justify-content-center bg-dark">
                <button type="button" class="btn btn-success">Guardar</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
            </div>
        </div> -->
<!-- /.modal-content -->
<!-- </div> -->
<!-- /.modal-dialog -->
<!-- </div>
</div> -->
<!-- ===================== 
              FIN MODAL DE LOS BOTONES EDITAR
            ========================= -->

<!-- ===================== 
              INICIO MODAL DE TODOS LOS BOTONES DE IMPRIMIR
            ========================= -->

<!-- <div class="modal fade show" id="modal-imprimir" style="display: none; padding-right: 17px;" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h4 class="modal-title">Imprimir informacion del Proveedor</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="row">

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>CC o NIT</label>
                            <input type="text" class="form-control" placeholder="Digite cedula o NIT">
                        </div>


                        <div class="form-group">
                            <label>Nombre o Razon Social</label>
                            <input type="text" class="form-control" placeholder="Escriba nombre o razon social">
                        </div>

                        <div class="form-group">
                            <label>Direccion</label>
                            <input type="text" class="form-control" placeholder="Escriba una direccion">
                        </div>

                        <div class="form-group">
                            <label>Telefono</label>
                            <input type="text" class="form-control" data-inputmask="'mask': ['999-999-9999 [x99999]', '+099 99 99 9999[9]-9999']" data-mask="" inputmode="text" placeholder="Digite numero telefonico">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Contacto</label>
                            <input type="text" class="form-control" placeholder="Escriba nombre de contacto">
                        </div>


                        <div class="form-group">
                            <label>Correo Electronico</label>
                            <input type="text" class="form-control" placeholder="Escriba un Correo">
                        </div>

                        <div class="form-group">
                            <label>Departamento</label>
                            <select id="depto" name="depto" class="form-control input-lg" required="">
                                <option value="Vichada">Vichada</option>
                                <option value="Vaupés">Vaupés</option>
                                <option value="Valle del Cauca">Valle del Cauca</option>
                                <option value="Tolima">Tolima</option>
                                <option value="Sucre">Sucre</option>
                                <option value="Santander">Santander</option>
                                <option value="San Andrés y Providencia">San Andrés y Providencia</option>
                                <option value="Risaralda">Risaralda</option>
                                <option value="Quindío">Quindío</option>
                                <option value="Putumayo">Putumayo</option>
                                <option value="Norte de Santander">Norte de Santander</option>
                                <option value="Nariño">Nariño</option>
                                <option value="Meta">Meta</option>
                                <option value="Magdalena">Magdalena</option>
                                <option value="La Guajira">La Guajira</option>
                                <option value="Huila">Huila</option>
                                <option value="Guaviare">Guaviare</option>
                                <option value="Guainía">Guainía</option>
                                <option value="Córdoba">Córdoba</option>
                                <option value="Cundinamarca">Cundinamarca</option>
                                <option value="Chocó">Chocó</option>
                                <option value="Cesar">Cesar</option>
                                <option value="Cauca">Cauca</option>
                                <option value="Casanare">Casanare</option>
                                <option value="Caquetá">Caquetá</option>
                                <option value="Caldas">Caldas</option>
                                <option value="Boyacá">Boyacá</option>
                                <option value="Bolívar">Bolívar</option>
                                <option value="Atlántico">Atlántico</option>
                                <option value="Arauca">Arauca</option>
                                <option value="Antioquia">Antioquia</option>
                                <option value="Amazonas">Amazonas</option>
                                <option value="" selected="">Escoja un departamento</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Ciudad</label>
                            <select class="form-control input-lg" id="ciudad" name="ciudad" style="width: 100%;" data-select2-id="9" tabindex="-1" aria-hidden="true" aria-labelledby="select2-single-container" aria-owns="select2-single-results" aria-activedescendant="select2-single-result-3oxl-AK">
                                <option value="Santa Rosalía">Santa Rosalía</option>
                                <option value="Puerto Carreño">Puerto Carreño</option>
                                <option value="La Primavera">La Primavera</option>
                                <option value="Cumaribo">Cumaribo</option>
                                <option value="Taraira">Taraira</option>
                                <option value="Mitú">Mitú</option>
                                <option value="Carurú">Carurú</option>
                                <option value="Zarzal">Zarzal</option>
                                <option value="Yumbo">Yumbo</option>
                                <option value="Yotoco">Yotoco</option>
                                <option value="Vijes">Vijes</option>
                                <option value="Versalles">Versalles</option>
                                <option value="Ulloa">Ulloa</option>
                                <option value="Tuluá">Tuluá</option>
                                <option value="Trujillo">Trujillo</option>
                                <option value="Toro">Toro</option>
                                <option value="Sevilla">Sevilla</option>
                                <option value="San Pedro">San Pedro</option>
                                <option value="Roldanillo">Roldanillo</option>
                                <option value="Riofrío">Riofrío</option>
                                <option value="Restrepo">Restrepo</option>
                                <option value="Pradera">Pradera</option>
                                <option value="Palmira">Palmira</option>
                                <option value="Obando">Obando</option>
                                <option value="La Victoria">La Victoria</option>
                                <option value="La Unión">La Unión</option>
                                <option value="La Cumbre">La Cumbre</option>
                                <option value="Jamundí">Jamundí</option>
                                <option value="Guacarí">Guacarí</option>
                                <option value="Ginebra">Ginebra</option>
                                <option value="Florida">Florida</option>
                                <option value="El Dovio">El Dovio</option>
                                <option value="El Cerrito">El Cerrito</option>
                                <option value="El Cairo">El Cairo</option>
                                <option value="El Águila">El Águila</option>
                                <option value="Dagua">Dagua</option>
                                <option value="Cartago">Cartago</option>
                                <option value="Candelaria">Candelaria</option>
                                <option value="Calima">Calima</option>
                                <option value="Cali">Cali</option>
                                <option value="Caicedonia">Caicedonia</option>
                                <option value="Bugalagrande">Bugalagrande</option>
                                <option value="Buga">Buga</option>
                                <option value="Buenaventura">Buenaventura</option>
                                <option value="Bolívar">Bolívar</option>
                                <option value="Argelia">Argelia</option>
                                <option value="Ansermanuevo">Ansermanuevo</option>
                                <option value="Andalucía">Andalucía</option>
                                <option value="Alcalá">Alcalá</option>
                                <option value="Villarrica">Villarrica</option>
                                <option value="Villahermosa">Villahermosa</option>
                                <option value="Venadillo">Venadillo</option>
                                <option value="Valle de San Juan">Valle de San Juan</option>
                                <option value="Suárez">Suárez</option>
                                <option value="Santa Isabel">Santa Isabel</option>
                                <option value="San Luis">San Luis</option>
                                <option value="San Antonio">San Antonio</option>
                                <option value="Saldaña">Saldaña</option>
                                <option value="Rovira">Rovira</option>
                                <option value="Roncesvalles">Roncesvalles</option>
                                <option value="Rioblanco">Rioblanco</option>
                                <option value="Purificación">Purificación</option>
                                <option value="Prado">Prado</option>
                                <option value="Planadas">Planadas</option>
                                <option value="Piedras">Piedras</option>
                                <option value="Palocabildo">Palocabildo</option>
                                <option value="Ortega">Ortega</option>
                                <option value="Natagaima">Natagaima</option>
                                <option value="Murillo">Murillo</option>
                                <option value="Melgar">Melgar</option>
                                <option value="Mariquita">Mariquita</option>
                                <option value="Líbano">Líbano</option>
                                <option value="Lérida">Lérida</option>
                                <option value="Icononzo">Icononzo</option>
                                <option value="Ibagué">Ibagué</option>
                                <option value="Honda">Honda</option>
                                <option value="Herveo">Herveo</option>
                                <option value="Guamo">Guamo</option>
                                <option value="Fresno">Fresno</option>
                                <option value="Flandes">Flandes</option>
                                <option value="Falán">Falán</option>
                                <option value="El Espinal">El Espinal</option>
                                <option value="Dolores">Dolores</option>
                                <option value="Cunday">Cunday</option>
                                <option value="Coyaima">Coyaima</option>
                                <option value="Coello">Coello</option>
                                <option value="Chaparral">Chaparral</option>
                                <option value="Casabianca">Casabianca</option>
                                <option value="Carmen de Apicalá">Carmen de Apicalá</option>
                                <option value="Cajamarca">Cajamarca</option>
                                <option value="Ataco">Ataco</option>
                                <option value="Armero">Armero</option>
                                <option value="Anzoátegui">Anzoátegui</option>
                                <option value="Ambalema">Ambalema</option>
                                <option value="Alvarado">Alvarado</option>
                                <option value="Alpujarra">Alpujarra</option>
                                <option value="Tolú Viejo">Tolú Viejo</option>
                                <option value="Tolú">Tolú</option>
                                <option value="Sucre">Sucre</option>
                                <option value="Sincelejo">Sincelejo</option>
                                <option value="Sincé">Sincé</option>
                                <option value="San Pedro">San Pedro</option>
                                <option value="San Onofre">San Onofre</option>
                                <option value="San Marcos">San Marcos</option>
                                <option value="San Juan de Betulia">San Juan de Betulia</option>
                                <option value="San Benito Abad">San Benito Abad</option>
                                <option value="San Antonio de Palmito">San Antonio de Palmito</option>
                                <option value="Sampués">Sampués</option>
                                <option value="Ovejas">Ovejas</option>
                                <option value="Morroa">Morroa</option>
                                <option value="Majagual">Majagual</option>
                                <option value="Los Palmitos">Los Palmitos</option>
                                <option value="La Unión">La Unión</option>
                                <option value="Guaranda">Guaranda</option>
                                <option value="Galeras">Galeras</option>
                                <option value="El Roble">El Roble</option>
                                <option value="Coveñas">Coveñas</option>
                                <option value="Corozal">Corozal</option>
                                <option value="Colosó">Colosó</option>
                                <option value="Chalán">Chalán</option>
                                <option value="Caimito">Caimito</option>
                                <option value="Buenavista">Buenavista</option>
                                <option value="Zapatoca">Zapatoca</option>
                                <option value="Villanueva">Villanueva</option>
                                <option value="Vetas">Vetas</option>
                                <option value="Vélez">Vélez</option>
                                <option value="Valle de San José">Valle de San José</option>
                                <option value="Tona">Tona</option>
                                <option value="Suratá">Suratá</option>
                                <option value="Sucre">Sucre</option>
                                <option value="Suaita">Suaita</option>
                                <option value="Simacota">Simacota</option>
                                <option value="Santa Helena del Opón">Santa Helena del Opón</option>
                                <option value="Santa Bárbara">Santa Bárbara</option>
                                <option value="San Vicente de Chucurí">San Vicente de Chucurí</option>
                                <option value="San Miguel">San Miguel</option>
                                <option value="San José de Miranda">San José de Miranda</option>
                                <option value="San Joaquín">San Joaquín</option>
                                <option value="San Gil">San Gil</option>
                                <option value="San Benito">San Benito</option>
                                <option value="San Andrés">San Andrés</option>
                                <option value="Sabana de Torres">Sabana de Torres</option>
                                <option value="Rionegro">Rionegro</option>
                                <option value="Puerto Wilches">Puerto Wilches</option>
                                <option value="Puerto Parra">Puerto Parra</option>
                                <option value="Puente Nacional">Puente Nacional</option>
                                <option value="Pinchote">Pinchote</option>
                                <option value="Piedecuesta">Piedecuesta</option>
                                <option value="Páramo">Páramo</option>
                                <option value="Palmas del Socorro">Palmas del Socorro</option>
                                <option value="Palmar">Palmar</option>
                                <option value="Onzaga">Onzaga</option>
                                <option value="Oiba">Oiba</option>
                                <option value="Ocamonte">Ocamonte</option>
                                <option value="Molagavita">Molagavita</option>
                                <option value="Mogotes">Mogotes</option>
                                <option value="Matanza">Matanza</option>
                                <option value="Málaga">Málaga</option>
                                <option value="Macaravita">Macaravita</option>
                                <option value="Los Santos">Los Santos</option>
                                <option value="Lebrija">Lebrija</option>
                                <option value="Landázuri">Landázuri</option>
                                <option value="La Paz">La Paz</option>
                                <option value="La Belleza">La Belleza</option>
                                <option value="Jordán">Jordán</option>
                                <option value="Jesús María">Jesús María</option>
                                <option value="Hato">Hato</option>
                                <option value="Güepsa">Güepsa</option>
                                <option value="Guavatá">Guavatá</option>
                                <option value="Guapotá">Guapotá</option>
                                <option value="Guadalupe">Guadalupe</option>
                                <option value="Guaca">Guaca</option>
                                <option value="Girón">Girón</option>
                                <option value="Gámbita">Gámbita</option>
                                <option value="Galán">Galán</option>
                                <option value="Floridablanca">Floridablanca</option>
                                <option value="Florián">Florián</option>
                                <option value="Enciso">Enciso</option>
                                <option value="Encino">Encino</option>
                                <option value="El Socorro">El Socorro</option>
                                <option value="El Playón">El Playón</option>
                                <option value="El Peñón">El Peñón</option>
                                <option value="El Guacamayo">El Guacamayo</option>
                                <option value="El Carmen de Chucurí">El Carmen de Chucurí</option>
                                <option value="Curití">Curití</option>
                                <option value="Coromoro">Coromoro</option>
                                <option value="Contratación">Contratación</option>
                                <option value="Confines">Confines</option>
                                <option value="Concepción">Concepción</option>
                                <option value="Cimitarra">Cimitarra</option>
                                <option value="Chipatá">Chipatá</option>
                                <option value="Chima">Chima</option>
                                <option value="Charta">Charta</option>
                                <option value="Charalá">Charalá</option>
                                <option value="Cerrito">Cerrito</option>
                                <option value="Cepitá">Cepitá</option>
                                <option value="Carcasí">Carcasí</option>
                                <option value="Capitanejo">Capitanejo</option>
                                <option value="California">California</option>
                                <option value="Cabrera">Cabrera</option>
                                <option value="Bucaramanga">Bucaramanga</option>
                                <option value="Bolívar">Bolívar</option>
                                <option value="Betulia">Betulia</option>
                                <option value="Barrancabermeja">Barrancabermeja</option>
                                <option value="Barichara">Barichara</option>
                                <option value="Barbosa">Barbosa</option>
                                <option value="Aratoca">Aratoca</option>
                                <option value="Albania">Albania</option>
                                <option value="Aguada">Aguada</option>
                                <option value="San Andrés">San Andrés</option>
                                <option value="Providencia y Santa Catalina Islas">Providencia y Santa Catalina Islas</option>
                                <option value="Santuario">Santuario</option>
                                <option value="Santa Rosa de Cabal">Santa Rosa de Cabal</option>
                                <option value="Quinchía">Quinchía</option>
                                <option value="Pueblo Rico">Pueblo Rico</option>
                                <option value="Pereira">Pereira</option>
                                <option value="Mistrató">Mistrató</option>
                                <option value="Marsella">Marsella</option>
                                <option value="La Virginia">La Virginia</option>
                                <option value="La Celia">La Celia</option>
                                <option value="Guática">Guática</option>
                                <option value="Dosquebradas">Dosquebradas</option>
                                <option value="Belén de Umbría">Belén de Umbría</option>
                                <option value="Balboa">Balboa</option>
                                <option value="Apía">Apía</option>
                                <option value="Salento">Salento</option>
                                <option value="Quimbaya">Quimbaya</option>
                                <option value="Pijao">Pijao</option>
                                <option value="Montenegro">Montenegro</option>
                                <option value="La Tebaida">La Tebaida</option>
                                <option value="Génova">Génova</option>
                                <option value="Filandia">Filandia</option>
                                <option value="Córdoba">Córdoba</option>
                                <option value="Circasia">Circasia</option>
                                <option value="Calarcá">Calarcá</option>
                                <option value="Buenavista">Buenavista</option>
                                <option value="Armenia">Armenia</option>
                                <option value="Villagarzón">Villagarzón</option>
                                <option value="Valle del Guamuez">Valle del Guamuez</option>
                                <option value="Sibundoy">Sibundoy</option>
                                <option value="Santiago">Santiago</option>
                                <option value="San Miguel">San Miguel</option>
                                <option value="San Francisco">San Francisco</option>
                                <option value="Puerto Leguízamo">Puerto Leguízamo</option>
                                <option value="Puerto Guzmán">Puerto Guzmán</option>
                                <option value="Puerto Caicedo">Puerto Caicedo</option>
                                <option value="Puerto Asís">Puerto Asís</option>
                                <option value="Orito">Orito</option>
                                <option value="Mocoa">Mocoa</option>
                                <option value="Colón">Colón</option>
                                <option value="Villa del Rosario">Villa del Rosario</option>
                                <option value="Villa Caro">Villa Caro</option>
                                <option value="Toledo">Toledo</option>
                                <option value="Tibú">Tibú</option>
                                <option value="Teorama">Teorama</option>
                                <option value="Sardinata">Sardinata</option>
                                <option value="Santo Domingo de Silos">Santo Domingo de Silos</option>
                                <option value="Santiago">Santiago</option>
                                <option value="San Cayetano">San Cayetano</option>
                                <option value="San Calixto">San Calixto</option>
                                <option value="Salazar de Las Palmas">Salazar de Las Palmas</option>
                                <option value="Ragonvalia">Ragonvalia</option>
                                <option value="Puerto Santander">Puerto Santander</option>
                                <option value="Pamplonita">Pamplonita</option>
                                <option value="Pamplona">Pamplona</option>
                                <option value="Ocaña">Ocaña</option>
                                <option value="Mutiscua">Mutiscua</option>
                                <option value="Lourdes">Lourdes</option>
                                <option value="Los Patios">Los Patios</option>
                                <option value="Labateca">Labateca</option>
                                <option value="La Playa de Belén">La Playa de Belén</option>
                                <option value="La Esperanza">La Esperanza</option>
                                <option value="Herrán">Herrán</option>
                                <option value="Hacarí">Hacarí</option>
                                <option value="Gramalote">Gramalote</option>
                                <option value="El Zulia">El Zulia</option>
                                <option value="El Tarra">El Tarra</option>
                                <option value="El Carmen">El Carmen</option>
                                <option value="Duranía">Duranía</option>
                                <option value="Cucutilla">Cucutilla</option>
                                <option value="Cúcuta">Cúcuta</option>
                                <option value="Convención">Convención</option>
                                <option value="Chitagá">Chitagá</option>
                                <option value="Chinácota">Chinácota</option>
                                <option value="Cácota">Cácota</option>
                                <option value="Cáchira">Cáchira</option>
                                <option value="Bucarasica">Bucarasica</option>
                                <option value="Bochalema">Bochalema</option>
                                <option value="Arboledas">Arboledas</option>
                                <option value="Ábrego">Ábrego</option>
                                <option value="Yacuanquer">Yacuanquer</option>
                                <option value="Túquerres">Túquerres</option>
                                <option value="Tumaco">Tumaco</option>
                                <option value="Tangua">Tangua</option>
                                <option value="Taminango">Taminango</option>
                                <option value="Sapuyes">Sapuyes</option>
                                <option value="Santacruz">Santacruz</option>
                                <option value="Santa Bárbara">Santa Bárbara</option>
                                <option value="Sandoná">Sandoná</option>
                                <option value="San Pedro de Cartago">San Pedro de Cartago</option>
                                <option value="San Pablo">San Pablo</option>
                                <option value="San Lorenzo">San Lorenzo</option>
                                <option value="San José de Albán">San José de Albán</option>
                                <option value="San Bernardo">San Bernardo</option>
                                <option value="Samaniego">Samaniego</option>
                                <option value="Roberto Payán">Roberto Payán</option>
                                <option value="Ricaurte">Ricaurte</option>
                                <option value="Pupiales">Pupiales</option>
                                <option value="Puerres">Puerres</option>
                                <option value="Providencia">Providencia</option>
                                <option value="Potosí">Potosí</option>
                                <option value="Policarpa">Policarpa</option>
                                <option value="Pasto">Pasto</option>
                                <option value="Ospina">Ospina</option>
                                <option value="Olaya Herrera">Olaya Herrera</option>
                                <option value="Nariño">Nariño</option>
                                <option value="Mosquera">Mosquera</option>
                                <option value="Mallama">Mallama</option>
                                <option value="Magüí Payán">Magüí Payán</option>
                                <option value="Los Andes">Los Andes</option>
                                <option value="Linares">Linares</option>
                                <option value="Leiva">Leiva</option>
                                <option value="La Unión">La Unión</option>
                                <option value="La Tola">La Tola</option>
                                <option value="La Llanada">La Llanada</option>
                                <option value="La Florida">La Florida</option>
                                <option value="La Cruz">La Cruz</option>
                                <option value="Ipiales">Ipiales</option>
                                <option value="Imués">Imués</option>
                                <option value="Iles">Iles</option>
                                <option value="Gualmatán">Gualmatán</option>
                                <option value="Guaitarilla">Guaitarilla</option>
                                <option value="Guachucal">Guachucal</option>
                                <option value="Funes">Funes</option>
                                <option value="Francisco Pizarro">Francisco Pizarro</option>
                                <option value="El Tambo">El Tambo</option>
                                <option value="El Tablón">El Tablón</option>
                                <option value="El Rosario">El Rosario</option>
                                <option value="El Peñol">El Peñol</option>
                                <option value="El Charco">El Charco</option>
                                <option value="Cumbitara">Cumbitara</option>
                                <option value="Cumbal">Cumbal</option>
                                <option value="Cuaspud">Cuaspud</option>
                                <option value="Córdoba">Córdoba</option>
                                <option value="Contadero">Contadero</option>
                                <option value="Consacá">Consacá</option>
                                <option value="Colón">Colón</option>
                                <option value="Chachagüí">Chachagüí</option>
                                <option value="Buesaco">Buesaco</option>
                                <option value="Belén">Belén</option>
                                <option value="Barbacoas">Barbacoas</option>
                                <option value="Arboleda">Arboleda</option>
                                <option value="Ancuyá">Ancuyá</option>
                                <option value="Aldana">Aldana</option>
                                <option value="Vista Hermosa">Vista Hermosa</option>
                                <option value="Villavicencio">Villavicencio</option>
                                <option value="San Martín">San Martín</option>
                                <option value="San Juanito">San Juanito</option>
                                <option value="San Juan de Arama">San Juan de Arama</option>
                                <option value="San Carlos de Guaroa">San Carlos de Guaroa</option>
                                <option value="Restrepo">Restrepo</option>
                                <option value="Puerto Rico">Puerto Rico</option>
                                <option value="Puerto López">Puerto López</option>
                                <option value="Puerto Lleras">Puerto Lleras</option>
                                <option value="Puerto Gaitán">Puerto Gaitán</option>
                                <option value="Puerto Concordia">Puerto Concordia</option>
                                <option value="Mesetas">Mesetas</option>
                                <option value="Mapiripán">Mapiripán</option>
                                <option value="Lejanías">Lejanías</option>
                                <option value="La Uribe">La Uribe</option>
                                <option value="La Macarena">La Macarena</option>
                                <option value="Guamal">Guamal</option>
                                <option value="Granada">Granada</option>
                                <option value="Fuente de Oro">Fuente de Oro</option>
                                <option value="El Dorado">El Dorado</option>
                                <option value="El Castillo">El Castillo</option>
                                <option value="El Calvario">El Calvario</option>
                                <option value="Cumaral">Cumaral</option>
                                <option value="Cubarral">Cubarral</option>
                                <option value="Castilla la Nueva">Castilla la Nueva</option>
                                <option value="Cabuyaro">Cabuyaro</option>
                                <option value="Barranca de Upía">Barranca de Upía</option>
                                <option value="Acacías">Acacías</option>
                                <option value="Zona Bananera">Zona Bananera</option>
                                <option value="Zapayán">Zapayán</option>
                                <option value="Tenerife">Tenerife</option>
                                <option value="Sitionuevo">Sitionuevo</option>
                                <option value="Santa Marta">Santa Marta</option>
                                <option value="Santa Bárbara de Pinto">Santa Bárbara de Pinto</option>
                                <option value="Santa Ana">Santa Ana</option>
                                <option value="San Zenón">San Zenón</option>
                                <option value="San Sebastián de Buenavista">San Sebastián de Buenavista</option>
                                <option value="Salamina">Salamina</option>
                                <option value="Sabanas de San Ángel">Sabanas de San Ángel</option>
                                <option value="Remolino">Remolino</option>
                                <option value="Pueblo Viejo">Pueblo Viejo</option>
                                <option value="Plato">Plato</option>
                                <option value="Pivijay">Pivijay</option>
                                <option value="Pijiño del Carmen">Pijiño del Carmen</option>
                                <option value="Pedraza">Pedraza</option>
                                <option value="Nueva Granada">Nueva Granada</option>
                                <option value="Guamal">Guamal</option>
                                <option value="Fundación">Fundación</option>
                                <option value="El Retén">El Retén</option>
                                <option value="El Piñón">El Piñón</option>
                                <option value="El Banco">El Banco</option>
                                <option value="Concordia">Concordia</option>
                                <option value="Ciénaga">Ciénaga</option>
                                <option value="Chibolo">Chibolo</option>
                                <option value="Chibolo">Chibolo</option>
                                <option value="Cerro de San Antonio">Cerro de San Antonio</option>
                                <option value="Ariguaní">Ariguaní</option>
                                <option value="Aracataca">Aracataca</option>
                                <option value="Algarrobo">Algarrobo</option>
                                <option value="Villanueva">Villanueva</option>
                                <option value="Urumita">Urumita</option>
                                <option value="Uribia">Uribia</option>
                                <option value="San Juan del Cesar">San Juan del Cesar</option>
                                <option value="Riohacha">Riohacha</option>
                                <option value="Manaure">Manaure</option>
                                <option value="Maicao">Maicao</option>
                                <option value="La Jagua del Pilar">La Jagua del Pilar</option>
                                <option value="Hatonuevo">Hatonuevo</option>
                                <option value="Fonseca">Fonseca</option>
                                <option value="El Molino">El Molino</option>
                                <option value="Distracción">Distracción</option>
                                <option value="Dibulla">Dibulla</option>
                                <option value="Barrancas">Barrancas</option>
                                <option value="Albania">Albania</option>
                                <option value="Yaguará">Yaguará</option>
                                <option value="Villavieja">Villavieja</option>
                                <option value="Timaná">Timaná</option>
                                <option value="Tesalia">Tesalia</option>
                                <option value="Teruel">Teruel</option>
                                <option value="Tello">Tello</option>
                                <option value="Tarqui">Tarqui</option>
                                <option value="Suaza">Suaza</option>
                                <option value="Santa María">Santa María</option>
                                <option value="San Agustín">San Agustín</option>
                                <option value="Saladoblanco">Saladoblanco</option>
                                <option value="Rivera">Rivera</option>
                                <option value="Pitalito">Pitalito</option>
                                <option value="Palestina">Palestina</option>
                                <option value="Palermo">Palermo</option>
                                <option value="Paicol">Paicol</option>
                                <option value="Oporapa">Oporapa</option>
                                <option value="Neiva">Neiva</option>
                                <option value="Nátaga">Nátaga</option>
                                <option value="La Plata">La Plata</option>
                                <option value="La Argentina">La Argentina</option>
                                <option value="Isnos">Isnos</option>
                                <option value="Íquira">Íquira</option>
                                <option value="Hobo">Hobo</option>
                                <option value="Guadalupe">Guadalupe</option>
                                <option value="Gigante">Gigante</option>
                                <option value="Garzón">Garzón</option>
                                <option value="Elías">Elías</option>
                                <option value="El Pital">El Pital</option>
                                <option value="Colombia">Colombia</option>
                                <option value="Campoalegre">Campoalegre</option>
                                <option value="Baraya">Baraya</option>
                                <option value="Altamira">Altamira</option>
                                <option value="Algeciras">Algeciras</option>
                                <option value="Aipe">Aipe</option>
                                <option value="Agrado">Agrado</option>
                                <option value="Acevedo">Acevedo</option>
                                <option value="San José del Guaviare">San José del Guaviare</option>
                                <option value="Miraflores">Miraflores</option>
                                <option value="El Retorno">El Retorno</option>
                                <option value="Calamar">Calamar</option>
                                <option value="Inírida">Inírida</option>
                                <option value="Valencia">Valencia</option>
                                <option value="Tuchín">Tuchín</option>
                                <option value="Tierralta">Tierralta</option>
                                <option value="San Pelayo">San Pelayo</option>
                                <option value="San José de Uré">San José de Uré</option>
                                <option value="San Carlos">San Carlos</option>
                                <option value="San Bernardo del Viento">San Bernardo del Viento</option>
                                <option value="San Antero">San Antero</option>
                                <option value="San Andrés de Sotavento">San Andrés de Sotavento</option>
                                <option value="Sahagún">Sahagún</option>
                                <option value="Purísima">Purísima</option>
                                <option value="Puerto Libertador">Puerto Libertador</option>
                                <option value="Puerto Escondido">Puerto Escondido</option>
                                <option value="Pueblo Nuevo">Pueblo Nuevo</option>
                                <option value="Planeta Rica">Planeta Rica</option>
                                <option value="Moñitos">Moñitos</option>
                                <option value="Montería">Montería</option>
                                <option value="Montelíbano">Montelíbano</option>
                                <option value="Momil">Momil</option>
                                <option value="Los Córdobas">Los Córdobas</option>
                                <option value="Lorica">Lorica</option>
                                <option value="La Apartada">La Apartada</option>
                                <option value="Cotorra">Cotorra</option>
                                <option value="Ciénaga de Oro">Ciénaga de Oro</option>
                                <option value="Chinú">Chinú</option>
                                <option value="Chimá">Chimá</option>
                                <option value="Cereté">Cereté</option>
                                <option value="Canalete">Canalete</option>
                                <option value="Buenavista">Buenavista</option>
                                <option value="Ayapel">Ayapel</option>
                                <option value="Zipaquirá">Zipaquirá</option>
                                <option value="Zipacón">Zipacón</option>
                                <option value="Yacopí">Yacopí</option>
                                <option value="Viotá">Viotá</option>
                                <option value="Villeta">Villeta</option>
                                <option value="Villapinzón">Villapinzón</option>
                                <option value="Villagómez">Villagómez</option>
                                <option value="Vianí">Vianí</option>
                                <option value="Vergara">Vergara</option>
                                <option value="Venecia">Venecia</option>
                                <option value="Útica">Útica</option>
                                <option value="Une">Une</option>
                                <option value="Ubaté">Ubaté</option>
                                <option value="Ubaque">Ubaque</option>
                                <option value="Ubalá">Ubalá</option>
                                <option value="Topaipí">Topaipí</option>
                                <option value="Tocancipá">Tocancipá</option>
                                <option value="Tocaima">Tocaima</option>
                                <option value="Tibirita">Tibirita</option>
                                <option value="Tibacuy">Tibacuy</option>
                                <option value="Tenjo">Tenjo</option>
                                <option value="Tena">Tena</option>
                                <option value="Tausa">Tausa</option>
                                <option value="Tabio">Tabio</option>
                                <option value="Sutatausa">Sutatausa</option>
                                <option value="Susa">Susa</option>
                                <option value="Supatá">Supatá</option>
                                <option value="Suesca">Suesca</option>
                                <option value="Subachoque">Subachoque</option>
                                <option value="Sopó">Sopó</option>
                                <option value="Soacha">Soacha</option>
                                <option value="Simijaca">Simijaca</option>
                                <option value="Silvania">Silvania</option>
                                <option value="Sibaté">Sibaté</option>
                                <option value="Sesquilé">Sesquilé</option>
                                <option value="Sasaima">Sasaima</option>
                                <option value="San Juan de Rioseco">San Juan de Rioseco</option>
                                <option value="San Francisco">San Francisco</option>
                                <option value="San Cayetano">San Cayetano</option>
                                <option value="San Bernardo">San Bernardo</option>
                                <option value="San Antonio del Tequendama">San Antonio del Tequendama</option>
                                <option value="Ricaurte">Ricaurte</option>
                                <option value="Quipile">Quipile</option>
                                <option value="Quetame">Quetame</option>
                                <option value="Quebradanegra">Quebradanegra</option>
                                <option value="Pulí">Pulí</option>
                                <option value="Puerto Salgar">Puerto Salgar</option>
                                <option value="Pasca">Pasca</option>
                                <option value="Paratebueno">Paratebueno</option>
                                <option value="Pandi">Pandi</option>
                                <option value="Paime">Paime</option>
                                <option value="Pacho">Pacho</option>
                                <option value="Nocaima">Nocaima</option>
                                <option value="Nimaima">Nimaima</option>
                                <option value="Nilo">Nilo</option>
                                <option value="Nemocón">Nemocón</option>
                                <option value="Nariño">Nariño</option>
                                <option value="Mosquera">Mosquera</option>
                                <option value="Medina">Medina</option>
                                <option value="Manta">Manta</option>
                                <option value="Madrid">Madrid</option>
                                <option value="Machetá">Machetá</option>
                                <option value="Lenguazaque">Lenguazaque</option>
                                <option value="La Vega">La Vega</option>
                                <option value="La Peña">La Peña</option>
                                <option value="La Palma">La Palma</option>
                                <option value="La Mesa">La Mesa</option>
                                <option value="La Calera">La Calera</option>
                                <option value="Junín">Junín</option>
                                <option value="Jerusalén">Jerusalén</option>
                                <option value="Gutiérrez">Gutiérrez</option>
                                <option value="Guayabetal">Guayabetal</option>
                                <option value="Guayabal de Síquima">Guayabal de Síquima</option>
                                <option value="Guatavita">Guatavita</option>
                                <option value="Guataquí">Guataquí</option>
                                <option value="Guasca">Guasca</option>
                                <option value="Guaduas">Guaduas</option>
                                <option value="Guachetá">Guachetá</option>
                                <option value="Granada">Granada</option>
                                <option value="Girardot">Girardot</option>
                                <option value="Gama">Gama</option>
                                <option value="Gachetá">Gachetá</option>
                                <option value="Gachancipá">Gachancipá</option>
                                <option value="Gachalá">Gachalá</option>
                                <option value="Fusagasugá">Fusagasugá</option>
                                <option value="Fúquene">Fúquene</option>
                                <option value="Funza">Funza</option>
                                <option value="Fosca">Fosca</option>
                                <option value="Fómeque">Fómeque</option>
                                <option value="Facatativá">Facatativá</option>
                                <option value="El Rosal">El Rosal</option>
                                <option value="El Peñón">El Peñón</option>
                                <option value="El Colegio">El Colegio</option>
                                <option value="Cucunubá">Cucunubá</option>
                                <option value="Cota">Cota</option>
                                <option value="Cogua">Cogua</option>
                                <option value="Chocontá">Chocontá</option>
                                <option value="Choachí">Choachí</option>
                                <option value="Chipaque">Chipaque</option>
                                <option value="Chía">Chía</option>
                                <option value="Chaguaní">Chaguaní</option>
                                <option value="Carmen de Carupa">Carmen de Carupa</option>
                                <option value="Cáqueza">Cáqueza</option>
                                <option value="Caparrapí">Caparrapí</option>
                                <option value="Cajicá">Cajicá</option>
                                <option value="Cachipay">Cachipay</option>
                                <option value="Cabrera">Cabrera</option>
                                <option value="Bojacá">Bojacá</option>
                                <option value="Bogotá">Bogotá</option>
                                <option value="Bituima">Bituima</option>
                                <option value="Beltrán">Beltrán</option>
                                <option value="Arbeláez">Arbeláez</option>
                                <option value="Apulo">Apulo</option>
                                <option value="Anolaima">Anolaima</option>
                                <option value="Anapoima">Anapoima</option>
                                <option value="Albán">Albán</option>
                                <option value="Agua de Dios">Agua de Dios</option>
                                <option value="Unguía">Unguía</option>
                                <option value="Unión Panamericana">Unión Panamericana</option>
                                <option value="Tadó">Tadó</option>
                                <option value="Sipí">Sipí</option>
                                <option value="San José del Palmar">San José del Palmar</option>
                                <option value="Riosucio">Riosucio</option>
                                <option value="Río Quito">Río Quito</option>
                                <option value="Río Iró">Río Iró</option>
                                <option value="Quibdó">Quibdó</option>
                                <option value="Nuquí">Nuquí</option>
                                <option value="Nóvita">Nóvita</option>
                                <option value="Medio San Juan">Medio San Juan</option>
                                <option value="Medio Baudó">Medio Baudó</option>
                                <option value="Medio Atrato">Medio Atrato</option>
                                <option value="Lloró">Lloró</option>
                                <option value="Litoral de San Juan">Litoral de San Juan</option>
                                <option value="Juradó">Juradó</option>
                                <option value="Istmina">Istmina</option>
                                <option value="El Carmen del Darién">El Carmen del Darién</option>
                                <option value="El Carmen de Atrato">El Carmen de Atrato</option>
                                <option value="El Atrato">El Atrato</option>
                                <option value="Condoto">Condoto</option>
                                <option value="Cértegui">Cértegui</option>
                                <option value="Cantón de San Pablo">Cantón de San Pablo</option>
                                <option value="Bojayá">Bojayá</option>
                                <option value="Bajo Baudó">Bajo Baudó</option>
                                <option value="Bahía Solano">Bahía Solano</option>
                                <option value="Bagadó">Bagadó</option>
                                <option value="Alto Baudó">Alto Baudó</option>
                                <option value="Acandí">Acandí</option>
                                <option value="Valledupar">Valledupar</option>
                                <option value="Tamalameque">Tamalameque</option>
                                <option value="San Martín">San Martín</option>
                                <option value="San Diego">San Diego</option>
                                <option value="San Alberto">San Alberto</option>
                                <option value="Río de Oro">Río de Oro</option>
                                <option value="Pueblo Bello">Pueblo Bello</option>
                                <option value="Pelaya">Pelaya</option>
                                <option value="Pailitas">Pailitas</option>
                                <option value="Manaure Balcón del Cesar">Manaure Balcón del Cesar</option>
                                <option value="La Paz">La Paz</option>
                                <option value="La Jagua de Ibirico">La Jagua de Ibirico</option>
                                <option value="La Gloria (Cesar)">La Gloria (Cesar)</option>
                                <option value="González">González</option>
                                <option value="Gamarra">Gamarra</option>
                                <option value="El Paso">El Paso</option>
                                <option value="El Copey">El Copey</option>
                                <option value="Curumaní">Curumaní</option>
                                <option value="Chiriguaná">Chiriguaná</option>
                                <option value="Chimichagua">Chimichagua</option>
                                <option value="Bosconia">Bosconia</option>
                                <option value="Becerril">Becerril</option>
                                <option value="Astrea">Astrea</option>
                                <option value="Agustín Codazzi">Agustín Codazzi</option>
                                <option value="Aguachica">Aguachica</option>
                                <option value="Villa Rica">Villa Rica</option>
                                <option value="Totoró">Totoró</option>
                                <option value="Toribío">Toribío</option>
                                <option value="Timbiquí">Timbiquí</option>
                                <option value="Timbío">Timbío</option>
                                <option value="Sucre">Sucre</option>
                                <option value="Suárez">Suárez</option>
                                <option value="Sotará">Sotará</option>
                                <option value="Silvia">Silvia</option>
                                <option value="Santander de Quilichao">Santander de Quilichao</option>
                                <option value="Santa Rosa">Santa Rosa</option>
                                <option value="San Sebastián">San Sebastián</option>
                                <option value="Rosas">Rosas</option>
                                <option value="Puracé">Puracé</option>
                                <option value="Puerto Tejada">Puerto Tejada</option>
                                <option value="Popayán">Popayán</option>
                                <option value="Piendamó">Piendamó</option>
                                <option value="Piamonte">Piamonte</option>
                                <option value="Patía">Patía</option>
                                <option value="Páez">Páez</option>
                                <option value="Padilla">Padilla</option>
                                <option value="Morales">Morales</option>
                                <option value="Miranda">Miranda</option>
                                <option value="Mercaderes">Mercaderes</option>
                                <option value="López de Micay">López de Micay</option>
                                <option value="La Vega">La Vega</option>
                                <option value="La Sierra">La Sierra</option>
                                <option value="Jambaló">Jambaló</option>
                                <option value="Inzá">Inzá</option>
                                <option value="Guapí">Guapí</option>
                                <option value="Guachené">Guachené</option>
                                <option value="Florencia">Florencia</option>
                                <option value="El Tambo">El Tambo</option>
                                <option value="Corinto">Corinto</option>
                                <option value="Caloto">Caloto</option>
                                <option value="Caldono">Caldono</option>
                                <option value="Cajibío">Cajibío</option>
                                <option value="Buenos Aires">Buenos Aires</option>
                                <option value="Bolívar">Bolívar</option>
                                <option value="Balboa">Balboa</option>
                                <option value="Argelia">Argelia</option>
                                <option value="Almaguer">Almaguer</option>
                                <option value="Yopal">Yopal</option>
                                <option value="Villanueva">Villanueva</option>
                                <option value="Trinidad">Trinidad</option>
                                <option value="Tauramena">Tauramena</option>
                                <option value="Támara">Támara</option>
                                <option value="San Luis de Palenque">San Luis de Palenque</option>
                                <option value="Sácama">Sácama</option>
                                <option value="Sabanalarga">Sabanalarga</option>
                                <option value="Recetor">Recetor</option>
                                <option value="Pore">Pore</option>
                                <option value="Paz de Ariporo">Paz de Ariporo</option>
                                <option value="Orocué">Orocué</option>
                                <option value="Nunchía">Nunchía</option>
                                <option value="Monterrey">Monterrey</option>
                                <option value="Maní">Maní</option>
                                <option value="La Salina">La Salina</option>
                                <option value="Hato Corozal">Hato Corozal</option>
                                <option value="Chámeza">Chámeza</option>
                                <option value="Aguazul">Aguazul</option>
                                <option value="Valparaíso">Valparaíso</option>
                                <option value="Solita">Solita</option>
                                <option value="Solano">Solano</option>
                                <option value="San Vicente del Caguán">San Vicente del Caguán</option>
                                <option value="San José del Fragua">San José del Fragua</option>
                                <option value="Puerto Rico">Puerto Rico</option>
                                <option value="Morelia">Morelia</option>
                                <option value="Milán">Milán</option>
                                <option value="La Montañita">La Montañita</option>
                                <option value="Florencia">Florencia</option>
                                <option value="El Paujil">El Paujil</option>
                                <option value="El Doncello">El Doncello</option>
                                <option value="Curillo">Curillo</option>
                                <option value="Cartagena del Chairá">Cartagena del Chairá</option>
                                <option value="Belén de los Andaquíes">Belén de los Andaquíes</option>
                                <option value="Albania">Albania</option>
                                <option value="Viterbo">Viterbo</option>
                                <option value="Villamaría">Villamaría</option>
                                <option value="Victoria">Victoria</option>
                                <option value="Supía">Supía</option>
                                <option value="San José">San José</option>
                                <option value="Samaná">Samaná</option>
                                <option value="Salamina">Salamina</option>
                                <option value="Risaralda">Risaralda</option>
                                <option value="Riosucio">Riosucio</option>
                                <option value="Pensilvania">Pensilvania</option>
                                <option value="Palestina">Palestina</option>
                                <option value="Pácora">Pácora</option>
                                <option value="Norcasia">Norcasia</option>
                                <option value="Neira">Neira</option>
                                <option value="Marulanda">Marulanda</option>
                                <option value="Marquetalia">Marquetalia</option>
                                <option value="Marmato">Marmato</option>
                                <option value="Manzanares">Manzanares</option>
                                <option value="Manizales">Manizales</option>
                                <option value="La Merced">La Merced</option>
                                <option value="La Dorada">La Dorada</option>
                                <option value="Filadelfia">Filadelfia</option>
                                <option value="Chinchiná">Chinchiná</option>
                                <option value="Belalcázar">Belalcázar</option>
                                <option value="Aranzazu">Aranzazu</option>
                                <option value="Anserma">Anserma</option>
                                <option value="Aguadas">Aguadas</option>
                                <option value="Zetaquira">Zetaquira</option>
                                <option value="Viracachá">Viracachá</option>
                                <option value="Villa de Leyva">Villa de Leyva</option>
                                <option value="Ventaquemada">Ventaquemada</option>
                                <option value="Úmbita">Úmbita</option>
                                <option value="Tutazá">Tutazá</option>
                                <option value="Tuta">Tuta</option>
                                <option value="Turmequé">Turmequé</option>
                                <option value="Tununguá">Tununguá</option>
                                <option value="Tunja">Tunja</option>
                                <option value="Tota">Tota</option>
                                <option value="Tópaga">Tópaga</option>
                                <option value="Togüí">Togüí</option>
                                <option value="Toca">Toca</option>
                                <option value="Tipacoque">Tipacoque</option>
                                <option value="Tinjacá">Tinjacá</option>
                                <option value="Tibasosa">Tibasosa</option>
                                <option value="Tibaná">Tibaná</option>
                                <option value="Tenza">Tenza</option>
                                <option value="Tasco">Tasco</option>
                                <option value="Sutatenza">Sutatenza</option>
                                <option value="Sutamarchán">Sutamarchán</option>
                                <option value="Susacón">Susacón</option>
                                <option value="Sotaquirá">Sotaquirá</option>
                                <option value="Soracá">Soracá</option>
                                <option value="Sora">Sora</option>
                                <option value="Somondoco">Somondoco</option>
                                <option value="Sogamoso">Sogamoso</option>
                                <option value="Socotá">Socotá</option>
                                <option value="Socha">Socha</option>
                                <option value="Soatá">Soatá</option>
                                <option value="Siachoque">Siachoque</option>
                                <option value="Sativasur">Sativasur</option>
                                <option value="Sativanorte">Sativanorte</option>
                                <option value="Santana">Santana</option>
                                <option value="Santa Sofía">Santa Sofía</option>
                                <option value="Santa Rosa de Viterbo">Santa Rosa de Viterbo</option>
                                <option value="Santa María">Santa María</option>
                                <option value="San Pablo de Borbur">San Pablo de Borbur</option>
                                <option value="San Miguel de Sema">San Miguel de Sema</option>
                                <option value="San Mateo">San Mateo</option>
                                <option value="San Luis de Gaceno">San Luis de Gaceno</option>
                                <option value="San José de Pare">San José de Pare</option>
                                <option value="San Eduardo">San Eduardo</option>
                                <option value="Samacá">Samacá</option>
                                <option value="Sáchica">Sáchica</option>
                                <option value="Saboyá">Saboyá</option>
                                <option value="Rondón">Rondón</option>
                                <option value="Ráquira">Ráquira</option>
                                <option value="Ramiriquí">Ramiriquí</option>
                                <option value="Quípama">Quípama</option>
                                <option value="Puerto Boyacá">Puerto Boyacá</option>
                                <option value="Pisba">Pisba</option>
                                <option value="Pesca">Pesca</option>
                                <option value="Paz del Río">Paz del Río</option>
                                <option value="Paya">Paya</option>
                                <option value="Pauna">Pauna</option>
                                <option value="Panqueba">Panqueba</option>
                                <option value="Pajarito">Pajarito</option>
                                <option value="Paipa">Paipa</option>
                                <option value="Páez">Páez</option>
                                <option value="Pachavita">Pachavita</option>
                                <option value="Otanche">Otanche</option>
                                <option value="Oicatá">Oicatá</option>
                                <option value="Nuevo Colón">Nuevo Colón</option>
                                <option value="Nobsa">Nobsa</option>
                                <option value="Muzo">Muzo</option>
                                <option value="Motavita">Motavita</option>
                                <option value="Moniquirá">Moniquirá</option>
                                <option value="Monguí">Monguí</option>
                                <option value="Mongua">Mongua</option>
                                <option value="Miraflores">Miraflores</option>
                                <option value="Maripí">Maripí</option>
                                <option value="Macanal">Macanal</option>
                                <option value="Labranzagrande">Labranzagrande</option>
                                <option value="La Victoria">La Victoria</option>
                                <option value="La Uvita">La Uvita</option>
                                <option value="La Capilla">La Capilla</option>
                                <option value="Jericó">Jericó</option>
                                <option value="Jenesano">Jenesano</option>
                                <option value="Iza">Iza</option>
                                <option value="Güicán">Güicán</option>
                                <option value="Guayatá">Guayatá</option>
                                <option value="Guateque">Guateque</option>
                                <option value="Guacamayas">Guacamayas</option>
                                <option value="Garagoa">Garagoa</option>
                                <option value="Gámeza">Gámeza</option>
                                <option value="Gachantivá">Gachantivá</option>
                                <option value="Floresta">Floresta</option>
                                <option value="Firavitoba">Firavitoba</option>
                                <option value="El Espino">El Espino</option>
                                <option value="El Cocuy">El Cocuy</option>
                                <option value="Duitama">Duitama</option>
                                <option value="Cuítiva">Cuítiva</option>
                                <option value="Cucaita">Cucaita</option>
                                <option value="Cubará">Cubará</option>
                                <option value="Covarachía">Covarachía</option>
                                <option value="Corrales">Corrales</option>
                                <option value="Coper">Coper</option>
                                <option value="Cómbita">Cómbita</option>
                                <option value="Ciénega">Ciénega</option>
                                <option value="Chivor">Chivor</option>
                                <option value="Chivatá">Chivatá</option>
                                <option value="Chitaraque">Chitaraque</option>
                                <option value="Chita">Chita</option>
                                <option value="Chiscas">Chiscas</option>
                                <option value="Chíquiza">Chíquiza</option>
                                <option value="Chiquinquirá">Chiquinquirá</option>
                                <option value="Chinavita">Chinavita</option>
                                <option value="Cerinza">Cerinza</option>
                                <option value="Campohermoso">Campohermoso</option>
                                <option value="Caldas">Caldas</option>
                                <option value="Busbanzá">Busbanzá</option>
                                <option value="Buenavista">Buenavista</option>
                                <option value="Briceño">Briceño</option>
                                <option value="Boyacá">Boyacá</option>
                                <option value="Boavita">Boavita</option>
                                <option value="Betéitiva">Betéitiva</option>
                                <option value="Berbeo">Berbeo</option>
                                <option value="Belén">Belén</option>
                                <option value="Arcabuco">Arcabuco</option>
                                <option value="Aquitania">Aquitania</option>
                                <option value="Almeida">Almeida</option>
                                <option value="Zambrano">Zambrano</option>
                                <option value="Villanueva">Villanueva</option>
                                <option value="Turbaná">Turbaná</option>
                                <option value="Turbaco">Turbaco</option>
                                <option value="Tiquisio">Tiquisio</option>
                                <option value="Talaigua Nuevo">Talaigua Nuevo</option>
                                <option value="Soplaviento">Soplaviento</option>
                                <option value="Simití">Simití</option>
                                <option value="Santa Rosa del Sur">Santa Rosa del Sur</option>
                                <option value="Santa Rosa">Santa Rosa</option>
                                <option value="Santa Catalina">Santa Catalina</option>
                                <option value="San Pablo">San Pablo</option>
                                <option value="San Martín de Loba">San Martín de Loba</option>
                                <option value="San Juan Nepomuceno">San Juan Nepomuceno</option>
                                <option value="San Jacinto">San Jacinto</option>
                                <option value="San Jacinto del Cauca">San Jacinto del Cauca</option>
                                <option value="San Fernando">San Fernando</option>
                                <option value="San Estanislao">San Estanislao</option>
                                <option value="San Cristóbal">San Cristóbal</option>
                                <option value="Río Viejo">Río Viejo</option>
                                <option value="Regidor">Regidor</option>
                                <option value="Pinillos">Pinillos</option>
                                <option value="Norosí">Norosí</option>
                                <option value="Morales">Morales</option>
                                <option value="Montecristo">Montecristo</option>
                                <option value="Mompós">Mompós</option>
                                <option value="María la Baja">María la Baja</option>
                                <option value="Margarita">Margarita</option>
                                <option value="Mahates">Mahates</option>
                                <option value="Magangué">Magangué</option>
                                <option value="Hatillo de Loba">Hatillo de Loba</option>
                                <option value="El Peñón">El Peñón</option>
                                <option value="El Guamo">El Guamo</option>
                                <option value="El Carmen de Bolívar">El Carmen de Bolívar</option>
                                <option value="Córdoba">Córdoba</option>
                                <option value="Clemencia">Clemencia</option>
                                <option value="Cicuco">Cicuco</option>
                                <option value="Cartagena de Indias">Cartagena de Indias</option>
                                <option value="Cantagallo">Cantagallo</option>
                                <option value="Calamar">Calamar</option>
                                <option value="Brazuelo de Papayal">Brazuelo de Papayal</option>
                                <option value="Barranco de Loba">Barranco de Loba</option>
                                <option value="Arroyohondo">Arroyohondo</option>
                                <option value="Arjona">Arjona</option>
                                <option value="Arenal">Arenal</option>
                                <option value="Altos del Rosario">Altos del Rosario</option>
                                <option value="Achí">Achí</option>
                                <option value="Usiacurí">Usiacurí</option>
                                <option value="Tubará">Tubará</option>
                                <option value="Suán">Suán</option>
                                <option value="Soledad">Soledad</option>
                                <option value="Santo Tomás">Santo Tomás</option>
                                <option value="Santa Lucía">Santa Lucía</option>
                                <option value="Sabanalarga">Sabanalarga</option>
                                <option value="Sabanagrande">Sabanagrande</option>
                                <option value="Repelón">Repelón</option>
                                <option value="Puerto Colombia">Puerto Colombia</option>
                                <option value="Ponedera">Ponedera</option>
                                <option value="Polonuevo">Polonuevo</option>
                                <option value="Piojó">Piojó</option>
                                <option value="Palmar de Varela">Palmar de Varela</option>
                                <option value="Manatí">Manatí</option>
                                <option value="Malambo">Malambo</option>
                                <option value="Luruaco">Luruaco</option>
                                <option value="Juan de Acosta">Juan de Acosta</option>
                                <option value="Galapa">Galapa</option>
                                <option value="Candelaria">Candelaria</option>
                                <option value="Campo de la Cruz">Campo de la Cruz</option>
                                <option value="Barranquilla">Barranquilla</option>
                                <option value="Baranoa">Baranoa</option>
                                <option value="Tame">Tame</option>
                                <option value="Saravena">Saravena</option>
                                <option value="Puerto Rondón">Puerto Rondón</option>
                                <option value="Fortul">Fortul</option>
                                <option value="Cravo Norte">Cravo Norte</option>
                                <option value="Arauquita">Arauquita</option>
                                <option value="Arauca">Arauca</option>
                                <option value="Zaragoza">Zaragoza</option>
                                <option value="Yondó">Yondó</option>
                                <option value="Yolombó">Yolombó</option>
                                <option value="Yarumal">Yarumal</option>
                                <option value="Yalí">Yalí</option>
                                <option value="Vigía del Fuerte">Vigía del Fuerte</option>
                                <option value="Venecia">Venecia</option>
                                <option value="Vegachí">Vegachí</option>
                                <option value="Valparaíso">Valparaíso</option>
                                <option value="Valdivia">Valdivia</option>
                                <option value="Urrao">Urrao</option>
                                <option value="Uramita">Uramita</option>
                                <option value="Turbo">Turbo</option>
                                <option value="Toledo">Toledo</option>
                                <option value="Titiribí">Titiribí</option>
                                <option value="Tarso">Tarso</option>
                                <option value="Tarazá">Tarazá</option>
                                <option value="Támesis">Támesis</option>
                                <option value="Sopetrán">Sopetrán</option>
                                <option value="Sonsón">Sonsón</option>
                                <option value="Segovia">Segovia</option>
                                <option value="Santo Domingo">Santo Domingo</option>
                                <option value="Santa Rosa de Osos">Santa Rosa de Osos</option>
                                <option value="Santa Fe de Antioquia">Santa Fe de Antioquia</option>
                                <option value="Santa Bárbara">Santa Bárbara</option>
                                <option value="San Vicente">San Vicente</option>
                                <option value="San Roque">San Roque</option>
                                <option value="San Rafael">San Rafael</option>
                                <option value="San Pedro de los Milagros">San Pedro de los Milagros</option>
                                <option value="San Pedro de Urabá">San Pedro de Urabá</option>
                                <option value="San Luis">San Luis</option>
                                <option value="San Juan de Urabá">San Juan de Urabá</option>
                                <option value="San José de la Montaña">San José de la Montaña</option>
                                <option value="San Jerónimo">San Jerónimo</option>
                                <option value="San Francisco">San Francisco</option>
                                <option value="San Carlos">San Carlos</option>
                                <option value="San Andrés de Cuerquia">San Andrés de Cuerquia</option>
                                <option value="Salgar">Salgar</option>
                                <option value="Sabaneta">Sabaneta</option>
                                <option value="Sabanalarga">Sabanalarga</option>
                                <option value="Rionegro">Rionegro</option>
                                <option value="Remedios">Remedios</option>
                                <option value="Puerto Triunfo">Puerto Triunfo</option>
                                <option value="Puerto Nare">Puerto Nare</option>
                                <option value="Puerto Berrío">Puerto Berrío</option>
                                <option value="Pueblorrico">Pueblorrico</option>
                                <option value="Peque">Peque</option>
                                <option value="Olaya">Olaya</option>
                                <option value="Necoclí">Necoclí</option>
                                <option value="Nechí">Nechí</option>
                                <option value="Nariño">Nariño</option>
                                <option value="Mutatá">Mutatá</option>
                                <option value="Murindó">Murindó</option>
                                <option value="Montebello">Montebello</option>
                                <option value="Medellín">Medellín</option>
                                <option value="Marinilla">Marinilla</option>
                                <option value="Maceo">Maceo</option>
                                <option value="Liborina">Liborina</option>
                                <option value="La Unión">La Unión</option>
                                <option value="La Pintada">La Pintada</option>
                                <option value="La Estrella">La Estrella</option>
                                <option value="La Ceja">La Ceja</option>
                                <option value="Jericó">Jericó</option>
                                <option value="Jardín">Jardín</option>
                                <option value="Ituango">Ituango</option>
                                <option value="Itagüí">Itagüí</option>
                                <option value="Hispania">Hispania</option>
                                <option value="Heliconia">Heliconia</option>
                                <option value="Guatapé">Guatapé</option>
                                <option value="Guarne">Guarne</option>
                                <option value="Guadalupe">Guadalupe</option>
                                <option value="Granada">Granada</option>
                                <option value="Gómez Plata">Gómez Plata</option>
                                <option value="Girardota">Girardota</option>
                                <option value="Giraldo">Giraldo</option>
                                <option value="Frontino">Frontino</option>
                                <option value="Fredonia">Fredonia</option>
                                <option value="Envigado">Envigado</option>
                                <option value="Entrerríos">Entrerríos</option>
                                <option value="El Santuario">El Santuario</option>
                                <option value="El Retiro">El Retiro</option>
                                <option value="El Peñol">El Peñol</option>
                                <option value="El Carmen de Viboral">El Carmen de Viboral</option>
                                <option value="El Bagre">El Bagre</option>
                                <option value="Ebéjico">Ebéjico</option>
                                <option value="Donmatías">Donmatías</option>
                                <option value="Dabeiba">Dabeiba</option>
                                <option value="Copacabana">Copacabana</option>
                                <option value="Concordia">Concordia</option>
                                <option value="Concepción">Concepción</option>
                                <option value="Cocorná">Cocorná</option>
                                <option value="Ciudad Bolívar">Ciudad Bolívar</option>
                                <option value="Cisneros">Cisneros</option>
                                <option value="Chigorodó">Chigorodó</option>
                                <option value="Caucasia">Caucasia</option>
                                <option value="Carolina del Príncipe">Carolina del Príncipe</option>
                                <option value="Carepa">Carepa</option>
                                <option value="Caramanta">Caramanta</option>
                                <option value="Caracolí">Caracolí</option>
                                <option value="Cañasgordas">Cañasgordas</option>
                                <option value="Campamento">Campamento</option>
                                <option value="Caldas">Caldas</option>
                                <option value="Caicedo">Caicedo</option>
                                <option value="Cáceres">Cáceres</option>
                                <option value="Buriticá">Buriticá</option>
                                <option value="Briceño">Briceño</option>
                                <option value="Betulia">Betulia</option>
                                <option value="Betania">Betania</option>
                                <option value="Belmira">Belmira</option>
                                <option value="Bello">Bello</option>
                                <option value="Barbosa">Barbosa</option>
                                <option value="Armenia">Armenia</option>
                                <option value="Argelia">Argelia</option>
                                <option value="Arboletes">Arboletes</option>
                                <option value="Apartadó">Apartadó</option>
                                <option value="Anzá">Anzá</option>
                                <option value="Anorí">Anorí</option>
                                <option value="Angostura">Angostura</option>
                                <option value="Angelópolis">Angelópolis</option>
                                <option value="Andes">Andes</option>
                                <option value="Amalfi">Amalfi</option>
                                <option value="Amagá">Amagá</option>
                                <option value="Alejandría">Alejandría</option>
                                <option value="Abriaquí">Abriaquí</option>
                                <option value="Abejorral">Abejorral</option>
                                <option value="Puerto Nariño">Puerto Nariño</option>
                                <option value="Leticia">Leticia</option>
                                <option value="" selected="">Seleccione una ciudad</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer justify-content-center bg-dark">
                <button type="button" class="btn btn-success"><i class="far fa-file-pdf"></i> PDF</button>
                <button type="button" class="btn btn-success"><i class="fas fa-print"></i> Imprimir</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Volver</button>
            </div>
        </div> -->
<!-- /.modal-content -->
<!-- </div> -->
<!-- /.modal-dialog -->
<!-- </div>
</div> -->
<!-- ===================== 
              FIN MODAL DEL TODOS LOS BOTONES DE IMPRIMIR
            ========================= -->