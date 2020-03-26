<?php

    class Identification extends AbstractDatabase{

        protected $dsn;

        function __construct(){
            parent::__construct();

        }
     
        public function getUser(string $pseudo) {
            $query = $this->dsn->prepare("SELECT * FROM Utilisateur WHERE pseudo = :pseudo");
            $query->execute([
                ":pseudo" => $pseudo
            ]);

            return $query->fetch(PDO::FETCH_ASSOC);
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