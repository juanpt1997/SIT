<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

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
        
        static public function ctrEnviarCorreoComplejo($correos, $asunto, $mensajeHtml, $mensajeSimple = "")
        {
    
            // Instantiation and passing `true` enables exceptions
            $mail = new PHPMailer(true);
    
            try {
                //Server settings
                //$mail->SMTPDebug = 2;                                       // Enable verbose debug output
                $mail->isSMTP();                                            // Set mailer to use SMTP
                //$mail->Host       = '192.168.100.1';                    // Specify main and backup SMTP servers
                $mail->Host       = 'tecnolab.com.co';                    // Specify main and backup SMTP servers
                $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
                $mail->Username   = EMAIL;                     // SMTP username
                $mail->Password   = PASSWORD_EMAIL;                               // SMTP password
                $mail->SMTPSecure = false;
                $mail->SMTPAutoTLS = false;
                //$mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
                $mail->Port       = 25;                                    // TCP port to connect to
    
                //Recipients
                $mail->setFrom(SETFROM_EMAIL, 'NOTIFICACIONES TECNOLAB');
                foreach ($correos as $correo) {
                    $mail->addAddress($correo, $correo);
                }
    
    
                #$mail->setFrom('fabio.cardona@coytex.com.co', 'Desarrollador Web');
                //$mail->addAddress('fabio.cardona@coytex.com.co', 'Fabio Cardona');     // Add a recipient
                //$mail->addAddress('CO&TEX S.A.S.');               // Name is optional
                //$mail->addReplyTo('info@example.com', 'Information');
                //$mail->addCC('cc@example.com');
                //$mail->addBCC('bcc@example.com');
    
                // Attachments
                //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
                //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
    
                // Content
                $mail->isHTML(true);  // Set email format to HTML
                $mail->CharSet = 'UTF-8'; // Activo condificacción utf-8
                $mail->Subject = $asunto; //Asunto
                $mail->Body    = $mensajeHtml; //Cuerspo del correo           
                $mail->AltBody = $mensajeSimple;
    
                $mail->send();
                //echo 'Mensaje enviado';
                return "ok";
            } catch (Exception $e) {
                return "Problemas al enviar el mensaje.  Mailer Error: {$mail->ErrorInfo}";
                // return "error";
            }
        }
    }