<?php

/**
 * By Emmanuel Lucio Urbina 2023
 */

class EventManager
{
    public static function token_validation(String $token)
    {
        /**
         * Valida el token de formulario
         * @token String 
         * @return boolean
         */
        if (!$token || $token !== $_SESSION['token']) {
            // show an error message 
            echo json_encode(["message" => "Token invalido"]);
            exit;
        }
        return true;
    }

    public static function valid_get()
    {
        /**
         * Valida  que el metodo sea get
         */
        if ($_SERVER['REQUEST_METHOD'] != "GET") {
            /** only get method is allowed */
            echo json_encode(array("Message" => "method not allowed"));
            exit;
        }
    }
    public static function valid_post()
    {
        /**
         * Valida  que el metodo sea post
         */
        if ($_SERVER['REQUEST_METHOD'] != "POST") {
            /** only post method is allowed */
            echo json_encode(array("Message" => "method not allowed"));
            exit;
        }
    }
}
