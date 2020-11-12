<?php

spl_autoload_register(function($className){

    $className = str_replace("\\", "/", $className);

    $path = "classes/";

    $file = $path . $className . ".php";

    if (file_exists($file)) {

        require_once $file;

    }
    
});

// spl_autoload_register(function($className){
//
//     $className = str_replace("\\", "/", $className);
//
//     $file = $className . ".php";
//
//     $path = "classes/DB/";
//
//     require_once $path . $file;
//
// });

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
