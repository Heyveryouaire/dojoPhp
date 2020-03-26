<?php

    class Article extends AbstractDatabase{

        protected $dsn;

        function __construct(){
            parent::__construct();

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

        public function addArticle(string $titre, string $content){
            $query = $this->dsn->prepare("INSERT INTO Article (titre, content, date) VALUES (:titre, :content, :date)");

            $date = date("Y-m-d");
            $query->bindParam(':titre', $titre);
            $query->bindParam(':content', $content);
            $query->bindParam(':date', $date);
            // géré le statut par la suite

            $query->execute();
        }


    }