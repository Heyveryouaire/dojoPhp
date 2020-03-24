<?php

    require "modele/Database.php";

    class Controlleur{

        private $db;
        public $content = [];
        public $path;

        function __construct(){
            $this->db = new Database();       
        }

        // All links 
        public function accueil() :void{
            $this->path = "accueil";
            $this->render();
        }

            // A Activer
        public function showArticles() :void{
            forEach($this->db->getArticle() as $article){
                $this->content[] = [ "article" => $article];
            }
            $this->path = "showArticles";
            $this->render();
        }

        public function article(){
            // $filter = "/([\/a-zA-Z]+){1,}/";

            // $num = preg_replace($filter, "", $_SERVER["REQUEST_URI"]);
            $id = (int)$_GET["id"];
            $article = $this->db->getOneArticle($id);
            $commentaires = $this->db->getCommentaire($article["id"]);

            $this->content[] = [
                "article" => $article,
                "commentaires" => $commentaires
            ];

            $this->path = "article";
            $this->render();

        }
        

        public function connexion() :void{
            $this->path = "connexion";
            $this->render();
        }

        public function deconnexion() :void{
            session_destroy();
            $this->redirectToRoute("");
        }

        public function admin() :void{
            if(isset($_SESSION["role"])){
                if($_SESSION["role"] == "admin"){
                    $this->path = "admin";
                    $this->render();
                }else{
                    $this->redirectToRoute("");
                }
            }else{
                $this->redirectToRoute("");
            }
        }

        // Connexion

        public function validConnexion() :void{

            $pseudo = sanitize($_POST["connexionPseudo"]);
            $password = sanitize($_POST["connexionPassword"]);

            $userDb = $this->db->getUser($pseudo);
    
            if($userDb){
                if($userDb["password"] == $password){
                    $this->connectUser($userDb);
                    $this->redirectToRoute("");
                }
            }else{
                $this->setError("Impossible de trouver une correspondance entre le pseudo et le mot de passe ! ");
                $this->redirectToRoute("connexion");
            }
        }

        private function connectUser(array $user) :void{
            $_SESSION["pseudo"] = $user["pseudo"];
            $_SESSION["role"] = $user["role"];
            $_SESSION["email"] = $user["mail"];
            $this->deleteError();    
        }

        private function setError(string $error) :void{
            $_SESSION["error"] = $error;
        }

        private function deleteError() :void{
            $_SESSION["error"] = "";
        }
        
        // Render
        private function render() :void{
            $this->path = "vue/pages/" . $this->path . ".php";
            require "vue/base.php";
        }

        private function redirectToRoute($route) :void{
            header("Location:/dojoPhp/interface/" . $route);
        }
       
    }