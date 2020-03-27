<header>
    <a href=<?= INDEX ?>><h1>Dojo Php.</h1></a>
    <?php if(isset($_SESSION["pseudo"])){ ?>
        <a href="ecrire">Ecrire un article</a>
    <?php
        }
    ?>
    <a href="showarticles">Liste des articles</a>
    <?php
        if(isset($_SESSION["pseudo"])){ ?>

            <a href="deconnexion"><button class="button inverted">Se déconnecter</button></a>
    <?php
        }else{ ?>
    <a href="connexion"><button class="button inverted">Se connecter</button></a>
    <a href="inscription"><button class="button inverted">S'inscrire</button></a>
    <?php  
        }
    ?>
   
</header>