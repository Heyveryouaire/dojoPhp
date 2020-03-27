<?php
    
    abstract class AbstractControlleur{

        protected $path; 

        // Retirer la valeur par défault
        protected function render(string $path = "accueil") :void{
            $this->path = "vue/pages/" . $path . ".php";
            require "vue/base.php";
        }

        protected function redirectToRoute(string $route) :void{
            header("Location:/dojoPhp/interface/" . $route);
        }
        protected function setError(string $error) :void{
            $_SESSION["error"] = $error;
        }

        protected function deleteError() :void{
            $_SESSION["error"] = "";
        }

    }