<?php

class ControladorUsuarios
{

	/*=============================================
	INGRESO DE USUARIO
	=============================================*/
	public function ctrIngresoUsuario()
	{
		# SCRIPT QUE PERMITE LIMPIAR LOS DATOS DEL NAVEGADOR CUANDO SE RECARGUE LA PÁGINA
		$scriptLimpiarDatos = ' <script>
					if ( window.history.replaceState ) {
						window.history.replaceState( null, null, window.location.href );
					}							
				</script>';

		# Validamos si existe la variable de ingreso de usuario que corresponde a la cedula de la persona.
		if (isset($_POST["ingreso_usuario"])) {
			if (
				preg_match('/^[a-zA-Z0-9]+$/', $_POST["ingreso_usuario"]) &&
				preg_match('/^[a-zA-Z0-9]+$/', $_POST["ingreso_contrasenia"])
			) {

				$cedulaUsuario = $_POST["ingreso_usuario"];
				$respuesta = ModeloUsuarios::mdlMostrarUsuarios($cedulaUsuario);

				$encriptar = crypt($_POST["ingreso_contrasenia"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
				//$encriptar = $_POST['ingreso_contrasenia'];

				if ($respuesta !== false && $respuesta["Cedula"] == $cedulaUsuario && $respuesta["Password"] == $encriptar) {
					#SI EL USUARIO ESTA ACTIVO EN EL SISTEMA
					if ($respuesta['estado'] == 1) {
						$_SESSION['iniciarSesion'] = "ok";
						$_SESSION['idUsuario'] = $respuesta['UsuariosID'];
						$_SESSION['cedula'] = $respuesta['Cedula'];
						$_SESSION['nombre'] = $respuesta['Nombre'];
						$_SESSION['email'] = $respuesta['Email'];
						$_SESSION['sucursal'] = $respuesta['Sucursal'];

						if (isset($_SERVER['HTTPS'])) {
							$_SESSION['dominio'] = 'https://' . $_SERVER['SERVER_NAME'];
						} else {
							$_SESSION['dominio'] = 'http://' . $_SERVER['SERVER_NAME'];
						}
						/* 
						$_SESSION['urlApp'] = $_SESSION['dominio'] . '/elsaman'; */

						$_SESSION['foto'] = $respuesta['foto'] != "" ? URL_APP . $respuesta['foto'] : URL_APP . "views/img/fotosUsuarios/default/anonymous.png";

						/* ===================== 
							CARGAMOS OPCIONES DISPONBLES PARA EL USUARIO 
						========================= */
						$itemOpcion = "Cedula";
						$valorOpcion = $respuesta['Cedula'];
						$opciones = array();
						$opcionesBD = ModeloUsuarios::mdlMostrarPerfilOpcion($itemOpcion, $valorOpcion);
						# Dentro de un forech recorro y almaceno la opciones del Sio
						foreach ($opcionesBD as $key => $value) {
							array_push($opciones, $value['opcion']);
						}

						/* ===================== 
							CREO SESION DEL PERFIL PARA IDENTIFICAR QUE ROL TIENE
						========================= */
						$perfil = $opcionesBD[0]['perfil'];
						$_SESSION['perfil'] = $perfil;
						# Creo sesión para almacenar las opciones 
						$_SESSION['opciones'] = $opciones;


						# Página de inicio
						echo '<script>
									window.location = "inicio";
								</script>';
					} else {
						echo '<br><div class="alert alert-danger">El usuario no se encuentra activo</div>';
					}
				} else {
					echo "<script>
                            Swal.fire({
                                icon: 'error',
                                showConfirmButton: true,
								confirmButtonColor: '#5cb85c',
                                text: 'Usuario o contraseña incorrectos'
                            });
                        </script>";
				}
			} else {
				echo "<script>
                            Swal.fire({
                                icon: 'error',
                                showConfirmButton: true,
								confirmButtonColor: '#5cb85c',
                                text: 'Por favor digite correctamente el usuario y contraseña'
                            });
                        </script>";
			}
		}
	}

	/* ===================================================
	   MOSTRAR USUARIOS
	===================================================*/
	static public function ctrMostrarUsuarios()
	{
		$respuesta = ModeloUsuarios::mdlMostrarUsuarios(null);
		return $respuesta;
	}

	/* ===================================================
	   PERFILES DISPONIBLES
	===================================================*/
	static public function ctrListadoPerfiles()
	{
		$respuesta = ModeloUsuarios::mdlListadoPerfiles();
		return $respuesta;
	}

	/* ===================================================
	   AGREGAR/EDITAR USUARIO
	===================================================*/
	static public function ctrAgregarEditar()
	{
		if (isset($_POST['Identificacion'])) {
			$usuarioExistente = ModeloUsuarios::mdlMostrarUsuarios($_POST['Identificacion']);

			$encriptar = crypt($_POST['Identificacion'], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

			$datos = array(
				'Identificacion' => $_POST['Identificacion'],
				'Nombre' => $_POST['Nombre'],
				'Email' => $_POST['Email'],
				'Perfil' => $_POST['Perfil'],
				'Sucursal' => $_POST['Sucursal'],
				'Password' => $encriptar
			);

			/* ===================================================
			   * FOTO
			===================================================*/
			/* ===================== 
				CREAMOS DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL USUARIO 
			========================= */
			$directorio = "views/img/fotosUsuarios/" . $_POST['Identificacion'];
			//mkdir($directorio, 0755);
			if (!is_dir($directorio)) {
				mkdir($directorio, 0755);
			}

			/* ===================================================
                       GUARDAR LA IMAGEN EN EL SERVIDOR
                    ===================================================*/
			$GuardarImagen = new FilesController();
			$GuardarImagen->file = $_FILES['nuevaFoto'];
			$aleatorio = mt_rand(100, 999);
			$GuardarImagen->ruta = "views/img/fotosUsuarios/" . $_POST['Identificacion'] . "/" . $aleatorio;
			$ruta = $GuardarImagen->ctrImages(500, 500);

			if (is_array($usuarioExistente)) {
				//UPDATE DEL USUARIO
				$AddEditUsuario = ModeloUsuarios::mdlEditarUsuario($datos);
			} else {
				//INSERT DEL USUARIO
				$AddEditUsuario = ModeloUsuarios::mdlAgregarUsuario($datos);
			}

			if ($AddEditUsuario == "ok") {
				/* ===================================================
					ACTUALIZAR RUTA IMAGEN EN LA BD
				===================================================*/
				if ($ruta != "") {
					$rutaImg = str_replace("./views", "/views", $ruta);
					$tabla = "l_usuarios";
					$item1 = "foto";
					$valor1 = $rutaImg;
					$item2 = "Cedula";
					$valor2 = $_POST['Identificacion'];
					$actualizarRutaImg = ModeloUsuarios::mdlActualizarUsuario($tabla, $item1, $valor1, $item2, $valor2);
				}

				echo "
						<script>
							Swal.fire({
								icon: 'success',
								title: '¡El usuario ha sido guardado correctamente!',						
								showConfirmButton: true,
								confirmButtonText: 'Cerrar',
								
							}).then((result)=>{

								if(result.value){
									window.location = 'usuarios';
								}

							})
						</script>
					";
			} else {
				echo "
						<script>
							Swal.fire({
								icon: 'error',
								title: 'Problemas al guardar el usuario',						
								showConfirmButton: true,
								confirmButtonText: 'Cerrar',
								closeOnConfirm: false								
							})
						</script>
					";
			}
		}
	}

	/* ===================================================
	   RESTABLECER CONTRASEÑA
	===================================================*/
	static public function ctrRestablecerPswd($item, $value)
	{
		# Se encrita la cadena para luego actualizar el campo del usuario
		$encriptar = crypt($value, '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

		$tabla = "l_usuarios";
		$item1 = "Password";
		$valor1 = $encriptar;
		$item2 = $item;
		$valor2 = $value;
		# Actualizo la contraseña
		$actualizarPassword = ModeloUsuarios::mdlActualizarUsuario($tabla, $item1, $valor1, $item2, $valor2);

		return $actualizarPassword;
	}

	/* ===================================================
	   CAMBIAR CONTRASEÑA
	===================================================*/
	static public function ctrCambiarPswd($datos)
	{
		$validarPsswd = ModeloUsuarios::mdlMostrarUsuarios($datos['cedulaUsuario']);

		if (is_array($validarPsswd)) {
			$encriptarPassAnterior = crypt($datos['passAnterior'], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
			if ($encriptarPassAnterior == $validarPsswd['Password']) {
				# validar nueva contraseña, encriptar y guardarla
				$encriptarPassNueva = crypt($datos['passNueva'], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
				$encriptarConfirmPass = crypt($datos['confirmPass'], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
				// Volver a validar si coinciden las contraseñas
				if ($encriptarPassNueva == $encriptarConfirmPass) {
					$tabla = "l_usuarios";
					$item1 = "Password";
					$valor1 = $encriptarPassNueva;
					$item2 = "Cedula";
					$valor2 = $datos['cedulaUsuario'];
					# Actualizo la contraseña
					$actualizarPassword = ModeloUsuarios::mdlActualizarUsuario($tabla, $item1, $valor1, $item2, $valor2);

					return $actualizarPassword;
				} else {
					return "no coinciden";
				}
			} else {
				# Contraseña anterior incorrecta
				return "incorrecto";
			}
		} else {
			return "error";
		}
		// # Se encrita la cadena para luego actualizar el campo del usuario
		// $encriptar = crypt($value, '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

		// $tabla = "l_usuarios";
		// $item1 = "Password";
		// $valor1 = $encriptar;
		// $item2 = $item;
		// $valor2 = $value;
		// # Actualizo la contraseña
		// $actualizarPassword = ModeloUsuarios::mdlActualizarUsuario($tabla, $item1, $valor1, $item2, $valor2);

		// return $actualizarPassword;
	}
}
