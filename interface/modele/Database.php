<?php

    class Database{

        private $dsn;

        function __construct(){

            try{
                $this->dsn = new PDO("mysql:host=localhost;dbname=dojoPhp;charset=utf8", USER, PASSWORD);
            }catch(PDOException $e){
                echo "Impossible " . $e;
                die();
            } 

        }

        public function getArticle() :array{
            $query = $this->dsn->prepare("SELECT * FROM Article");
            $query->execute();

            $response = $query->fetchAll(PDO::FETCH_ASSOC);

            return $response;
        }

        public function getOneArticle(int $id){
            $query = $this->dsn->prepare("SELECT * FROM Article WHERE id = :id");
            $query->execute([
                ":id" => $id
            ]);

            return $query->fetch(PDO::FETCH_ASSOC);
        }

        public function getCommentaire(int $article) :array{
            $query = $this->dsn->prepare("SELECT * FROM Commentaire WHERE id_Article = :article");
            $query->execute(
                [":article" => $article]
            );

            $response = $query->fetchAll(PDO::FETCH_ASSOC);

            return $response;
        }

        public function getUser(string $pseudo) {
            $query = $this->dsn->prepare("SELECT * FROM Utilisateur WHERE pseudo = :pseudo");
            $query->execute([
                ":pseudo" => $pseudo
            ]);

            return $query->fetch(PDO::FETCH_ASSOC);
        }


    }