<?php
// INCLUIMOS LA CONFIGURACIÓN PARA ACCEDER AL CANAL DE TELGRAM
include_once $_SERVER['DOCUMENT_ROOT'] . '/ti/sio/srm/config/telegram.php';

class ControladorTelegram
{

    static public function ctrNotificaciones($msgTelegram)
    {

        #Mensaje para el canal de telegram de oficina técnica
        #$msgTelegram = "";

        # Instanciamos la clase de telegram para incluir las credenciales 
        $telegram = new Telegram();

        $token = $telegram->token;
        $id = $telegram->idCanal;
        $urlMsg = "https://api.telegram.org/bot{$token}/sendMessage";
        $msg = $msgTelegram;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $urlMsg);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "chat_id={$id}&parse_mode=HTML&text=$msg");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);


        $server_output = curl_exec($ch);
        curl_close($ch);
        return 'ok';
    }
}
