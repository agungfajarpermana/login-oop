<?php

// start session
session_start();

// load file automatic on folder class
spl_autoload_register(function($class){
    require_once "classes/".$class.".php";
});

$user = new User();