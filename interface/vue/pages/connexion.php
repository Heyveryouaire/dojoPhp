<form method="POST" action="validConnexion">
    <fieldset>
        <legend>
            Connexion
        </legend>

        <?php
            if(isset($_SESSION["error"])){
                echo $_SESSION["error"];
                $this->deleteError();
            }
        ?>

        <input name="connexionPseudo" type="text" placeholder="Entrer votre nom d'utilisateur">
        <input name="connexionPassword" type="password" placeholder="Entrer votre mot de passe">
        <button type="submit">Se connecter</button>
    </fieldset>
</form>