<?php

    abstract class AbstractDatabase{

        protected $dsn;

        function __construct(){
            $this->dsn = new PDO("mysql:host=localhost;dbname=dojoPhp;charset=utf8", USER, PASSWORD);
        }
        
    }