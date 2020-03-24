<header>
    <a href=<?= INDEX ?>><h1>Dojo Php.</h1></a>
    <a href="showarticles">Liste des articles</a>
    <?php
        if(isset($_SESSION["pseudo"])){ ?>
            <a href="deconnexion"><button>Se déconnecter</button></a>
    <?php
        }else{ ?>
    <a href="connexion"><button>Se connecter</button></a>
    <?php  
        }
    ?>
   
</header>