<!-- =================================================== MODAL PARA CERRAR SESIÓN =================================================== -->
<div class="modal fade" id="cerrarSesionModal" tabindex="-1" role="dialog" aria-labelledby="cerrarSesionModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cerrarSesionModalLabel">Cerrar Sesión</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <div class="text-center">
                        <img class="img-thumbnail img-fluid" src="<?= $_SESSION['foto'] ?>" width="100">
                        <!-- <h5><?= $_SESSION['usuario']; ?></h5> -->
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Cancelar</button>
                <a href="<?= URL_APP ?>salir" class="btn btn-danger">Salir</a>
            </div>
        </div>
    </div>
</div>

<!-- ===================================================
    MODAL PARA VER PERFIL DEL USUARIO
=================================================== -->
<div id="modalPerfilUsuario" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="my-modal-title">Perfil</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Foto -->
                <div class="row d-flex justify-content-center">
                    <div class="col-12 text-center">
                        <img src="<?= $_SESSION['foto'] ?>" alt="..." class="profile-user-img img-fluid img-circle">
                    </div>
                    <div class="col-8 mt-2">
                        <ul class="list-group list-group-unbordered">
                            <!-- Nombre -->
                            <li class="list-group-item">
                                <b>Nombre: </b>
                                <span class="float-right"><?= $_SESSION['nombre'] ?></span>
                            </li>

                            <!-- Email -->
                            <li class="list-group-item">
                                <b>Email: </b>
                                <span class="float-right"><?= $_SESSION['email'] ?></span>
                            </li>

                            <!-- Rol -->
                            <li class="list-group-item">
                                <b>Rol: </b>
                                <span class="float-right"><?= $_SESSION['perfil'] ?></span>
                            </li>

                            <!-- Sucursal -->
                            <li class="list-group-item">
                                <b>Sucursal: </b>
                                <span class="float-right"><?= $_SESSION['sucursal'] ?></span>
                            </li>

                            <!-- Cambiar password -->
                            <li class="list-group-item">
                                <b>Cambiar contraseña: </b>
                                <span id="btnCambiarPass" class="float-right"><button class="btn btn-danger" type="button"><i class="fas fa-key"></i></button></span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<!-- ===================================================
    MODAL RUTAS
=================================================== -->
<div class="modal fade" id="modal_general" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="overflow-y: scroll;">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">

            <div class="modal-header bg-success">
                <h5 class="modal-title" id="titulo_modal_general"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-sm table-striped table-bordered dt-responsive table-hover tablasBtnExport w-100" id="tabla_general_rutas">
                        <thead class="thead-light text-uppercase text-sm text-center">
                            <tr>
                                <th style="width:10px;">#</th>
                                <th>Origen</th>
                                <th>Destino</th>
                                <th>Descripción</th>
                                <th>Selección</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm text-center" id="tbody_principal">
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="modal-footer bg-dark d-flex justify-content-center">
                <button type="button" class="btn btn-danger btn_cancelar_ruta" data-dismiss="modal">Cancelar</button>
                <a href="cg-vehicular" target="_blank"><span class='badge badge-info badge-md'>Nueva ruta</span></a>
            </div>

        </div>
    </div>
</div>

<!-- ===================================================
    MODAL LISTA DE CORREOS DIFUSION
=================================================== -->
<div id="difusion_correo" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="difusion_correo-title" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

            <div class="modal-header bg-gradient-info">
                <h4 class="modal-title" id="difusion_correo-title"><i class="fas fa-envelope-open"></i> Correos asociados en la difusión</h4>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-sm table-bordered table-striped text-center text-nowrap w-100" id="tabla_correos">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Correo</th>
                                <th>Usuario crea</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="tbody_correos">
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="modal-footer bg-gradient-dark justify-content-center">
                <div class="margin">
                    <div class="btn-group">
                        <button type="button" class="btn btn-sm bg-gradient-green btnAgregarCorreo">
                            <i class="fas fa-at"></i> Agregar correo
                        </button>
                    </div>

                    <div class="btn-group">
                        <button type="button" class="btn btn-sm bg-gradient-danger" data-dismiss="modal">
                            <i class="fas fa-times-circle"></i> Cerrar
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>