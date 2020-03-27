<?php

    class UserControlleur extends AbstractControlleur{

        public function inscription(){
            $this->render("inscription");
        }
        public function connexion() :void{
            $this->render("connexion");
        }
        public function deconnexion() :void{
            session_destroy();
            $this->redirectToRoute("");
        }

        private function connectUser(array $user) :void{
            $_SESSION["pseudo"] = $user["pseudo"];
            $_SESSION["role"] = $user["role"];
            $_SESSION["email"] = $user["mail"];
            $this->deleteError();    
        }

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
                $this->render("connexion");
            }else{
                $this->setError("Le nom d'utilisateur existe déjà");
                $this->redirectToRoute("inscription");
            }
        }

        public function admin() :void{
            if(isset($_SESSION["role"])){
                if($_SESSION["role"] == "admin"){
                    $this->render("admin");
                }else{
                    $this->redirectToRoute("");
                }
            }else{
                $this->redirectToRoute("");
            }
        }
    }