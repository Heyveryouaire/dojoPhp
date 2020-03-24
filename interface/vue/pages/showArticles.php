<?php forEach($this->content as $content){ ?>
    <article>
        <h2>
            <?= $content["article"]["titre"] ?>
        </h2>
        <p>
            <?= $content["article"]["content"] ?>
        </p>
        <a href=<?= "article?id=" . $content["article"]["id"]?>> Voir les commentaires </a>

    </article>
  
    <?php
    }
    ?>