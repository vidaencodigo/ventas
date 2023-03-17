<?php
/**
 * By Emmanuel Lucio Urbina 2023
 */

class EventManager
{
    public static function token_validation($token)
    {
        /**
         * Valida el token de formulario
         */
        if (!$token || $token !== $_SESSION['token']) {
            // show an error message 
            echo json_encode(["message" => "Token invalido"]);
            exit;
        }
    }
}
