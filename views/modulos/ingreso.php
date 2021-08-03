<!-- <div id="div_video">
    <video id="videoFondo" src="views/video/trans-especiales-el-saman.mp4" autoplay loop muted poster=""></video>
</div> -->
<style>
    body {
        background: url("<?= URL_APP ?>views/img/plantilla/Login-Demo.jpg") no-repeat center center fixed;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;

    }
</style>
<div class="login-box">
    <div class="login-logo">
        <img src="<?= URL_APP ?>views/img/plantilla/logo.png" alt="">
    </div>
    <!-- /.login-logo -->

    <!-- login card -->
    <div class="card ml-4">
        <div class="card-body login-card-body">
            <h5 class="login-box-msg font-weight-bold">Inicio de sesión</h5>

            <form method="post">
                <div class="input-group mb-3">
                    <input type="number" class="form-control" placeholder="Usuario" name="ingreso_usuario">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" class="form-control" placeholder="Contraseña" name="ingreso_contrasenia">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <?php
                $ingreso = new ControladorUsuarios();
                $ingreso->ctrIngresoUsuario();
                ?>
                <button type="submit" class="btn btn-success btn-block">Ingresar</button>
            </form>

            <small class="">
                <a href="#" data-toggle="modal" data-target="#modalRecuperarPassword">He olvidado mi contraseña</a>
            </small>
        </div>
        <!-- /.login-card-body -->
    </div>
    <!-- /.login card -->
</div>
<!-- /.login-box -->


<!-- ===================== 
  MODAL DE FORMULARIO PARA RECUPERAR LA CONTRASEÑA 
========================= -->
<div class="modal fade" id="modalRecuperarPassword" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">

            <div class="modal-body">

                <div class="container">
                    <div class="row ">
                        <!-- <div class="col-12 text-center">
                            <img src="views/img/plantilla/logoTI.png" alt="logoTI" class="img-fluid" width="80">
                        </div> -->
                        <!-- col -->

                        <div class="col-12">
                            <p class="" style="font-size: 14px;">
                                Por favor ingrese su identificación y de clic en el botón restaurar contraseña, posteriormente el sistema le enviará una nueva contraseña temporal.
                            </p>

                            <form method="post">
                                <div class="input-group mb-3">
                                    <input type="number" name="ingCambiarPassowrd" class="form-control" placeholder="Ingrese su identificación" required>
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-user"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-success btn-block">
                                            <i class="fas fa-user-lock"></i>
                                            Restaurar contraseña
                                        </button>
                                    </div>
                                    <!-- /.col -->
                                </div>

                                <?php
                                # Ejecutamos el controlador para que realice la accion
                                // $restaurarPassword = new ControladorUsuarios();
                                // $restaurarPassword->ctrFrmRestablecerPassword();
                                ?>

                            </form>
                        </div>



                    </div><!-- row -->
                </div><!-- container -->

            </div>

        </div>
    </div>
</div>