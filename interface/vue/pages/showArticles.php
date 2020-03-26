<?php forEach($this->content as $content){ ?>
    <?php $x=1; ?>
    <article>

            <h2>
                <?= $content["article"]["titre"] ?>
            </h2>
            <small>
                <?php
                    $date = $content["article"]["date"];
                    echo "Publié le " . date("d/m/Y", strtotime($date));
                ?>
            </small>
        <p>
            <?= $content["article"]["content"] ?>
        </p>
        <a data-val=<?= $x ?> data-do="false" href=<?= "article?id=" . $content["article"]["id"]?>> Voir les commentaires </a>

    </article>
  
    <?php
    $x++;
    }
    ?>

    <script src="assets/main.js" type="module"></script>