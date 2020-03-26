<?php

class Router
{

    private $REALINK = [
        "accueil" => "/",
        "showArticles" => "/showarticles",
        "connexion" => "/connexion",
        "deconnexion" => "/deconnexion",
        "validConnexion" => "/validConnexion",
        "inscription" => "/inscription",
        "validInscription" => "/validInscription",
        "admin" => "/admin",
        "restCommentaires" => "/article",
        "ecrire" => "/ecrire",
        "validArticle" => "/validArticle",
        "test" => "/test"
    ];

    function __construct()
    {
        $link = preg_replace(DIR, "", $_SERVER["REQUEST_URI"]);

        $link = preg_replace("/[?]?id=[0-9]*/", "", $link);
        $this->getControlleur($link);
    }

    function getControlleur($link)
    {
        $controller = new Controlleur();

        if (array_search($link, $this->REALINK)) {
            $path = array_search($link, $this->REALINK);
            $controller->$path();
        } else {
            echo "impossible de trouver ce lien";
            dd($_SERVER);
        }
    }
}
