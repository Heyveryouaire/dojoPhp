<?php

spl_autoload_register("autoload");

function autoload($class){
        require_once "controlleur/" . $class . ".php";
}


function dd($element){
        var_dump($element);
        die();
}

function sanitize($post){
        return htmlspecialchars($post);
}