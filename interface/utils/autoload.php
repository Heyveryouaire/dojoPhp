<?php

spl_autoload_register("autoload");

function autoload($class){
    foreach(FOLDERS as $folder){
        if(file_exists($folder . $class . ".php")){
            require_once $folder . $class . ".php";
        }
    }
}

function dd($element){
    var_dump($element);
    die();
}

function sanitize($post){
    $data = trim($post);
    return htmlspecialchars($data);
}