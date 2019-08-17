<?php

class Input {
    public static function get($action)
    {
        if(isset($_POST[$action])){

            return $_POST[$action];

        }else if(isset($_GET[$action])){

            return $_GET[$action];

        }

        return false;
    }
}