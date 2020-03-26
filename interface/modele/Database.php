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

        public function addArticle(string $titre, string $content){
            $query = $this->dsn->prepare("INSERT INTO Article (titre, content, date) VALUES (:titre, :content, :date)");

            $date = date("Y-m-d");
            $query->bindParam(':titre', $titre);
            $query->bindParam(':content', $content);
            $query->bindParam(':date', $date);
            // géré le statut par la suite

            $query->execute();
        }

        public function addUser(string $pseudo, string $password, string $email ="adresse.email@bidon.fr", string $role = "user"){
            $query = $this->dsn->prepare("INSERT INTO Utilisateur (pseudo, email, password, role) VALUES (:pseudo, :email, :password, :role)");
        
            $query->bindParam(':pseudo', $pseudo);
            $query->bindParam(':email', $email);
            $query->bindParam(':password', $password);
            $query->bindParam(':role', $role);

            $query->execute();

        }


    }