<?php

spl_autoload_register(function($className){

    $className = str_replace("\\", "/", $className);

    $file = $className . ".php";

    $path = "classes/";

    require_once $path . $file;

});


// spl_autoload_register(function($className){
//
//     $className = str_replace("\\", "/", $className);
//
//     $file = $className . ".php";
//
//     $path = "vendor/google/";
//
//     require_once $path . $file;
//
// });
