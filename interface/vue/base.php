<?php require "vue/template_parts/header.php"; ?>

<?php require "vue/template_parts/navBar.php"; ?>

<main>
    
<?php if(!empty($_SESSION["pseudo"])){ ?>
        <span>Vous etes identifié sous le nom de : <?= htmlspecialchars($_SESSION["pseudo"]) ?> </span>
    <?php
    }
    ?>

<?php require $this->path ?>
    
</main>
<?php require "vue/template_parts/footer.php"; ?>
