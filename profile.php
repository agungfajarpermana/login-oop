<?php

require_once "core/init.php";

if(!Session::exists('username')){
    header("Location: register.php");
}
echo Session::get('username');
?>