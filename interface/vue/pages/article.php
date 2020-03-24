<?php forEach($this->content as $content){ ?>
    <article>
        <h2>
            <?= $content["article"]["titre"] ?>
        </h2>
        <p>
            <?= $content["article"]["content"] ?>
        </p>

        <div class="commentaires">  
            <?php 
                forEach($content["commentaires"] as $commentaire){ ?>
                <h3>
                    <?= $commentaire["titre"] ?>
                </h3>
                <p>
                    <?= $commentaire["content"] ?>
                </p>
                <div class="jump"></div>
                <?php
                }
                ?>
        </div>
    </article>
  
    <?php
    }
    ?>