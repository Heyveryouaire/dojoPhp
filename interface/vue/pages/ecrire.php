<form method="POST" action="validArticle">
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

        <input name="titleArticle" type="text" placeholder="Entrer votre nom d'utilisateur">
            <textarea name="contentArticle" placeholder="Ecrivez votre article">

            </textarea>
        <button type="submit">Ecrire !</button>
    </fieldset>
</form>