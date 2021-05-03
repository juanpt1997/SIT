<?php
/* ===================== 
  IGNORAMOS LOS ERRORES PARA EL AMBIENTE PRODUCTIVO
========================= */
// if ($_SERVER['HTTP_HOST'] == 'www.coytex.com.co' && $_SERVER['SERVER_NAME'] == 'www.coytex.com.co') {
//     error_reporting(0);
// }

/* ===================== 
  VARIABLES GLOBALES 
========================= */
$proyecto = "elsaman";
define('URL', "{$_SERVER['REQUEST_SCHEME']}://{$_SERVER['SERVER_NAME']}/{$proyecto}/");
define('URL_APP', "{$_SERVER['REQUEST_SCHEME']}://{$_SERVER['SERVER_NAME']}/{$proyecto}/");
define('DIR_APP', "{$_SERVER['DOCUMENT_ROOT']}/{$proyecto}/");
define('DOCUMENTOS', "{$_SERVER['DOCUMENT_ROOT']}/documentos/");
define('DIR_DOCUMENTOS', "{$_SERVER['DOCUMENT_ROOT']}/documentos/");
define('DOMINIO_APP', "{$_SERVER['REQUEST_SCHEME']}://{$_SERVER['SERVER_NAME']}");

/* ===================== 
  CONFIUGRACION DE SESIONES DEL PROYECTO 
========================= */
# NOMBRE DE LA SESION
session_name('elsaman');
$duracion_sesion = 28800; // 7200 => 2 HORAS TRANSFORMADAS EN SEGUNDOS
ini_set("session.use_cookies", 1);
ini_set("session.use_only_cookies", 1);
ini_set("session.cookie_lifetime", $duracion_sesion);
ini_set('session.gc_maxlifetime', $duracion_sesion);
session_cache_expire($duracion_sesion);
session_set_cookie_params($duracion_sesion);

# ruta de la sesion 
if (!is_dir(DIR_APP . 'sessions')) {
    mkdir(DIR_APP . 'sessions', 0777);
}

session_save_path(DIR_APP . 'sessions');

session_start();

/* ===================== 
  FUNCION PARA VALIDAR EL ROL ASIGNADO 
========================= */
function validarModulo($permiso)
{
    $key = array_search($permiso, $_SESSION['opciones']);
    if (false === $key){
        return false;
        /* echo "<script> window.location = '" . URL . "'; </script>"; */
    }else{
        return true;
    }
}