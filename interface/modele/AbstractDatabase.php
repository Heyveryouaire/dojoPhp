<?php

    abstract class AbstractDatabase{

        protected $dsn;
        function __construct(){
            try{
                $this->dsn = new PDO("mysql:host=localhost;dbname=dojoPhp;charset=utf8", USER, PASSWORD);
            }catch(PDOException $e){
                echo "Impossible " . $e;
                die();
            } 
        }
    }