<style>






</style>


<form class="form" method="POST" action="validArticle">
    <fieldset>
        <legend>
            Créer un nouvel article
        </legend>

        <?php
            if(isset($_SESSION["error"])){
                echo $_SESSION["error"];
                $this->deleteError();
            }
        ?>
        <div class="form">
            <label for="titleArticle">Titre de l'article</label>
            <input name="titleArticle" id="titleArticle" type="text" placeholder="Entrer votre nom d'utilisateur">
            <label for="contentArticle">Contenu de l'article</label>
            <textarea name="contentArticle" id="contentArticle" placeholder="Ecrivez votre article"></textarea>
            <button type="submit" class="button">Envoyer</button>
        </div>
    </fieldset>
</form>