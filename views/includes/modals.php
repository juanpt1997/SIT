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