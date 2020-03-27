<?php

    class MainControlleur extends AbstractControlleur{

        public $content = [];

        public function test(){ 
            $this->render();
    
       }
        // All links 
        public function accueil() :void{
            $this->render("accueil");
        }

        public function notfound() :void{
            $this->render("not_found");
        }
    }