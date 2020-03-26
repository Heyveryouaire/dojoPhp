<?php

    require "modele/AbstractDatabase.php";
    require "modele/Article.php";
    require "modele/Identification.php";

    class Controlleur{

        public $content = [];
        public $path;

       public function test(){
            $test = new Article();
            dd($test->db);
    
       }
        // All links 
        public function accueil() :void{
            $this->path = "accueil";
            $this->render();
        }

            // A Activer
        public function showArticles() :void{
            $article = new Article();
            forEach($article->getArticle() as $article){
                $this->content[] = [ "article" => $article];
            }
            $this->path = "showArticles";
            $this->render();
        }

        public function article(){
            $article = new Article();
            $id = (int)$_GET["id"];
            $articles = $article->getOneArticle($id);
            $commentaires = $article->getCommentaire($articles["id"]);

            $this->content[] = [
                "article" => $articles,
                "commentaires" => $commentaires
            ];

            echo json_encode($this->content);
            die();
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

        public function ecrire(){
            
            $this->path = "ecrire";
            $this->render();
        }

        public function validArticle(){
            $article = new Article();
            if(isset($_SESSION["pseudo"]) && $_SESSION["role"] == "user" || $_SESSION["role"] == "admin"){
                if(isset($_POST)){
                    $title = sanitize($_POST["titleArticle"]);
                    $content = sanitize($_POST["contentArticle"]);

                    $article->addArticle($title, $content);
                    $this->redirectToRoute("showarticles");
                }
            }else{
                $this->setError("Il faut etre connecter pour poster un article");
                $this->path = "accueil";
                $this->render();
            }
        }

        public function inscription(){
            $this->path = "inscription";
            $this->render();
        }

        // Connexion

        public function validConnexion() :void{
            $user = new Identification();
            $pseudo = sanitize($_POST["connexionPseudo"]);
            $password = $_POST["connexionPassword"];

            $userDb = $user->getUser($pseudo);

            if($userDb){
                if(password_verify($password, $userDb["password"])){
                    $this->connectUser($userDb);
                    $this->redirectToRoute("");
                }else{
                    $this->setError("Impossible de trouver une correspondance entre le pseudo et le mot de passe ! ");
                    $this->redirectToRoute("connexion");
                }
            }else{
                $this->setError("Impossible de trouver une correspondance entre le pseudo et le mot de passe ! ");
                $this->redirectToRoute("connexion");
            }
        }

        public function validInscription(){
            $user = new Identification();
            $pseudo = sanitize($_POST["inscriptionPseudo"]);
            $password = password_hash($_POST["inscriptionPassword"], PASSWORD_DEFAULT);

            $pseudoDb = $user->getUser($pseudo);
 
            if(empty($pseudoDb)){
               
                $user->addUser($pseudo, $password);
                $this->setError("Votre compte à bien été créer, vous pouvez à présent vous connectez");
                $this->path = "connexion";
                $this->render();


            }else{
                $this->setError("Le nom d'utilisateur existe déjà");
                $this->redirectToRoute("inscription");

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