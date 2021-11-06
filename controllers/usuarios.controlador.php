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
						// $opciones = array();
						$opcionesBD = ModeloUsuarios::mdlMostrarPerfilOpcion($itemOpcion, $valorOpcion);
						// # Dentro de un forech recorro y almaceno la opciones
						// foreach ($opcionesBD as $key => $value) {
						// 	array_push($opciones, $value['opcion']);
						// }
						// # Creo sesión para almacenar las opciones 
						// $_SESSION['opciones'] = $opciones;

						/* ===================== 
							CREO SESION DEL PERFIL PARA IDENTIFICAR QUE ROL TIENE
						========================= */
						$perfil = $opcionesBD[0]['perfil'];
						$_SESSION['perfil'] = $perfil;

						/* ===================================================
						   NUEVA VERSION PARA GUARDAR OPCIONES Y PERMISOS DISPONIBLES
						===================================================*/
						$_SESSION['permisos'] = ModeloUsuarios::mdlPermisos($respuesta['Cedula']);


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
		}else{
			//echo '<br><div class="alert alert-danger">Página en mantenimiento ☹, vuelva a intentar más tarde</div>';
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
	   ACTUALIZAR ROL
	===================================================*/

	static public function ctrActualizarPerfil($idPerfil, $activo)
	{
		$nuevoActivo = $activo == 1 ? 0 : 1;
		$respuesta = ModeloUsuarios::mdlActualizarPerfil($idPerfil, $nuevoActivo, "activo");
		return $respuesta;
	}


	/* ===================================================
	   AGREGAR  ROL
	===================================================*/

	static public function ctrAgregarEditarPerfil($value)
	{
		if (isset($_POST['idPerfil'])) {
			if ($_POST['idPerfil'] == "") {
				$AddEditRol = ModeloUsuarios::mdlAgregarPerfil($_POST);
				if ($AddEditRol == "ok") {
					echo "
							<script>
								Swal.fire({
								icon: 'success',
								title: 'Perfil creado correctamente',						
								showConfirmButton: true,
								confirmButtonText: 'Cerrar',
											
								}).then((result)=>{
		
									if(result.value){
										window.location = 'roles-usuarios';
									}
		
								})
							</script>
								";
				}
			} else {
				$AddEditRol = ModeloUsuarios::mdlEditarPerfil($_POST);
				if ($AddEditRol == "ok") {
					echo "
							<script>
								Swal.fire({
								icon: 'success',
								title: 'Perfil actualizado correctamente',						
								showConfirmButton: true,
								confirmButtonText: 'Cerrar',
											
								}).then((result)=>{
		
									if(result.value){
										window.location = 'roles-usuarios';
									}
		
								})
							</script>
								";
				}
			}
		}
	}

	/* ===================================================
	   VISUALIZAR DATOS PERFIL
	===================================================*/

	static public function ctrDatosPerfil($idPerfil)
	{
		$respuesta = ModeloUsuarios::mdlDatosPerfil($idPerfil);
		return $respuesta;
	}

	/* ===================================================
	   BORRADO LOGICO PERFIL
	===================================================*/

	static public function ctrBorrarPerfil($idPerfil)
	{
		$nuevoEstado = 0;
		$respuesta = ModeloUsuarios::mdlActualizarPerfil($idPerfil, $nuevoEstado, "estado");
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
				'idUsuario' => $_POST['idUsuario'],
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

			// if (is_array($usuarioExistente)) {
			// 	//UPDATE DEL USUARIO
			// 	$AddEditUsuario = ModeloUsuarios::mdlEditarUsuario($datos);
			// } else {
			// 	//INSERT DEL USUARIO
			// 	$AddEditUsuario = ModeloUsuarios::mdlAgregarUsuario($datos);
			// }

			# INSERT
			if ($datos['idUsuario'] == "") {
				if (is_array($usuarioExistente)) {
					# mensaje al usuario
					$AddEditUsuario = "existe";
				} else {
					# INSERT
					$AddEditUsuario = ModeloUsuarios::mdlAgregarUsuario($datos);
				}
			}
			# UPDATE
			else {
				if (is_array($usuarioExistente) && $usuarioExistente['UsuariosID'] != $datos['idUsuario']) {
					# mensaje al usuario
					$AddEditUsuario = "existe";
				} else {
					# UPDATE
					$AddEditUsuario = ModeloUsuarios::mdlEditarUsuario($datos);
				}
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
			} elseif ($AddEditUsuario == "existe") {
				echo "
						<script>
							Swal.fire({
								icon: 'warning',
								title: 'Ya existe un usuario con el mismo número de cédula',						
								showConfirmButton: true,
								confirmButtonText: 'Cerrar',
								closeOnConfirm: false								
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

	/* ===================== 
	  SOLICITAR CAMBIO DE CONTRASEÑA  DESDE EL FORMULARIO ("olvidé mi contraseña")
	========================= */
	public function ctrFrmRestablecerPassword()
	{

		if (isset($_POST['ingCambiarPassowrd'])) {

			# SE PERMITE INGRESAR CARACTERES NUMERICOS
			if (preg_match('/^[0-9]+$/', $_POST["ingCambiarPassowrd"])) {

				# Valido si el usuario existe para cambiar la contraseña
				$valor = $_POST["ingCambiarPassowrd"];

				$usuario = ModeloUsuarios::mdlMostrarUsuarios($valor);

				if ($usuario !== false && $usuario['Cedula'] != '') {

					/* GENERAR EL CODIGO ALETORIO */
					/*  http://www.elcodigofuente.com/usando-rand-crear-cadena-aleatoria-806/ */
					$caracteres = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890"; //posibles caracteres a usar
					$numerodeletras = 6; //numero de letras para generar el texto
					$cadena = ""; //variable para almacenar la cadena generada
					for ($i = 0; $i < $numerodeletras; $i++) {
						$cadena .= substr($caracteres, rand(0, strlen($caracteres)), 1); /*Extraemos 1 caracter de los caracteres entre el rango 0 a Numero de letras que tiene la cadena */
					}

					# Se encripta la cadena para luego actualizar el campo del usuario
					$encriptar = crypt($cadena, '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
					//$encriptar = crypt($usuario['Cedula'], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

					# Actualizo la contraseña con el codigo generado 
					$tabla = "l_usuarios";
					$item1 = "Password";
					$valor1 = $encriptar;
					$item2 = "Cedula";
					$valor2 = $usuario['Cedula'];
					# Actualizo la contraseña
					$actualizarPassword = ModeloUsuarios::mdlActualizarUsuario($tabla, $item1, $valor1, $item2, $valor2);

					if ($actualizarPassword == "ok") {


						$correoOculto = substr_replace($usuario['Email'], "********", 0, 8);

						$to = $usuario['Email'];
						$subject = "Restauración de contraseña";
						$message = "<html>
                                    <body>
                                    <p>
									Su contraseña ha sido restaurada.<br><br>
                                    USUARIO: Su número de identificación, CONTRASEÑA: $cadena<br>
                                    <a href='" . URL_APP . "'>Enlace para ir al sitio web.</a><br>
                                    Gracias,<br>
                                    Equipo de Tecnolab.</p><br>
                                    </body>
                                    </html>";
						ControladorCorreo::ctrEnviarCorreo($to, $subject, $message);

						//IMPRIMO MENSAJE DE EXITO
						echo "
							<script>
								Swal.fire({
									icon: 'success',
									title: 'Ingrese con la constraseña que se envió a este correo {$correoOculto}',
									footer: 'Si no reconoce el correo electrónico o el mensaje no llega después de unos minutos, comuníquese con soporte.',						
									showConfirmButton: true,
									confirmButtonText: 'Cerrar',
									
								}).then((result)=>{

									if(result.value){
										window.location = 'inicio';
									}

								})
							</script>
						";
					} else {
						echo "
							<script>
								Swal.fire({
									icon: 'error',
									title: '¡Error!',						
									footer: 'Por favor intente de nuevo más tarde o comuníquese con soporte',
									showConfirmButton: true,
									confirmButtonText: 'Cerrar',
									closeOnConfirm: false
									
								}).then((result)=>{

									if(result.value){
										window.location = 'inicio';
									}

								})
							</script>
						";
					}
				} else {
					echo "
						<script>
							Swal.fire({
								icon: 'error',
								title: '¡El usuario no existe por favor verfique su identificación!',						
								showConfirmButton: true,
								confirmButtonText: 'Cerrar',
								closeOnConfirm: false
								
							}).then((result)=>{

								if(result.value){
									window.location = 'inicio';
								}

							})
						</script>
					";
				}
			}
		}
	}

	/* ===================== 
	  MOSTRAR LISTADO OPCIONES
	========================= */

	static public function ctrListadoOpciones()
	{
		$respuesta = ModeloUsuarios::mdlListadoOpciones();
		return $respuesta;
	}

	/* ===================== 
	  GUARDAR PERMISOS ROL
	========================= */

	static public function ctrAgregarPermisosRol()
	{
		if (isset($_POST['Ver']) || isset($_POST['Crear']) || isset($_POST['Actualizar']) || isset($_POST['Eliminar'])) {
			ModeloUsuarios::mdlEliminarPermisosRol($_POST['idpermisos']);


			// Arreglo de opciones
			$arrayop = ModeloUsuarios::mdlListadoOpciones();


			// Recorrer el arreglo y realizar la busqueda por cada posicion
			foreach ($arrayop as $key => $value) {
				$idOpcion = $value['idOpcion'];

				if (isset($_POST['Ver'])) {
					if (self::BuscarOpcionPermiso($_POST['Ver'], $idOpcion)) {
						$datos = array(
							'idPerfil' => $_POST['idpermisos'],
							'idOpcion' => $idOpcion,
							'Crear' => 0,
							'Ver' => 1,
							'Actualizar' => 0,
							'Borrar' => 0
						);
					}
				} else {
					$datos['Ver'] = 0;
				}

				if (isset($_POST['Crear'])) {
					if (self::BuscarOpcionPermiso($_POST['Crear'], $idOpcion)) {
						$datos['Crear'] = 1;
					}
				} else {
					$datos['Crear'] = 0;
				}


				if (isset($_POST['Actualizar'])) {
					if (self::BuscarOpcionPermiso($_POST['Actualizar'], $idOpcion)) {
						$datos['Actualizar'] = 1;
					}
				} else {
					$datos['Actualizar'] = 0;
				}


				if (isset($_POST['Eliminar'])) {
					if (self::BuscarOpcionPermiso($_POST['Eliminar'], $idOpcion)) {
						$datos['Borrar'] = 1;
					}
				} else {
					$datos['Borrar'] = 0;
				}

				$idPerfil = $_POST['idpermisos'];
				$datos['idPerfil'] = $idPerfil;
				$datos['idOpcion'] = $idOpcion;


				if ($datos['Crear'] == 0 && $datos['Ver'] == 0 && $datos['Actualizar'] == 0 && $datos['Borrar'] == 0) {
					echo "no hay cambios";
				} else {

					$respuesta = ModeloUsuarios::mdlAgregarPermisosRol($datos);
					if ($respuesta == "ok") {
						echo "
						<script>
							Swal.fire({
								icon: 'success',
								title: 'Permisos modificados correctamente',
								showConfirmButton: true,
								confirmButtonText: 'Cerrar',
								
							}).then((result)=>{

								if(result.value){
									window.location = 'roles-usuarios';
								}

							})
						</script>
					";
					} else {
						echo "
						<script>
							Swal.fire({
								icon: 'error',
								title: '¡Los permisos no puedieron ser modificados!',						
								showConfirmButton: true,
								confirmButtonText: 'Cerrar',
								closeOnConfirm: false
								
							}).then((result)=>{

								if(result.value){
									window.location = 'roles-usuarios';
								}

							})
						</script>
					";
					}
				}


				//Se ponen las opciones en 0 para evitar que inserte por cada ciclo que haga  
				$datos['Crear'] = 0;
				$datos['Ver'] = 0;
				$datos['Actualizar'] = 0;
				$datos['Borrar'] = 0;
			}
		}
	}

	/* =============================
		FUNCION BUSCAR OPCION
	================================*/
	static public function BuscarOpcionPermiso($arreglo, $opcion)
	{
		$key = array_search($opcion, $arreglo);
		if (false === $key) {
			return false;
		} else {
			return true;
		}
	}


	/* ===================================================
	   CARGAR DATOS PERMISOS ROL
	===================================================*/

	static public function ctrDatosPermisosRol($idPerfil)
	{
		$respuesta = ModeloUsuarios::mdlDatosPermisosRol($idPerfil);
		return $respuesta;
	}
}
