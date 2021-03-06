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

    private $classes = [
        "MainControlleur",
        "UserControlleur",
        "ArticlesControlleur"
    ];

    private $method;
    private $link;

    function __construct()
    {
        $this->link = preg_replace(DIR, "", $_SERVER["REQUEST_URI"]);
        $this->link = preg_replace("/[?]?id=[0-9]*/", "", $this->link);
        $this->getControlleur();
    }

    function getControlleur()
    {
        $this->method = array_search($this->link, $this->REALINK);
        
        $valid_path = false;
        foreach($this->classes as $class){
            if(method_exists($class, $this->method)){
                $controller = new $class;
                $controller->{$this->method}();
                $valid_path = true;
            }
        }

        if($valid_path == false){
           $controller = new MainControlleur();
           $controller->notfound();
        }
    }
}
