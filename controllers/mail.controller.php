<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
/* use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception; */
# INCLUIMOS CONFIGURACION DE CORREO DEL USUARIO Y CONTRASEÑA
//include  DIR_APP . 'config/credenciales_correo.php';

// Load Composer's autoloader
# Se requiere en el index.php 

    class ControladorCorreo
    {
        static public function ctrEnviarCorreo($to, $subject, $message)
        {
            $headers = "From: tecnolab@tecnolab.com.co" . "\r\n";
            $headers .= "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            mail($to, $subject, $message, $headers);
        }
    }