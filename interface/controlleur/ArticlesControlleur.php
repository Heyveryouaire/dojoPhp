<?php

    class ArticlesControlleur extends AbstractControlleur{

        public function ecrire(){
            $this->render("ecrire");
        }

        public function showArticles() :void{
            $article = new Article();

            $articles = $article->getAllArticle();
            forEach($articles as $article){
                $this->content[] = [ "article" => $article];
            }

            $this->render("showArticles");
        }

        public function restCommentaires(){
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
                $this->render("accueil");
            }
        }
    }