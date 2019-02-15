<?php
$coms = getComms($db, $art->id_Article);
//lister les commentaires pour cet article
foreach ($coms as $com) { ?>
    <div class="col-md-2 mb-3">
        <img class=" w-25" src="<?php echo $com->Url_avatar ?>" alt="">
        <span class="ml-1 text-success"><?php echo $com->Name ?></span>
    </div>
    <div class="col-md-7 mb-3"><?php echo $com->Commentaire ?></div>
    <div class="col-md-3">
        <span>
            <?php
            for ($i = 0; $i < 5; $i++) {

                if (intval($com->Stars) >= $i) {
                    ?>
                    <i class="material-icons text-success">star</i>
                    <?php
                } else { ?>
                    <i class="material-icons text-success">star_border</i>
                    <?php
                }
            }

            ?>
        </span>
    </div>
    <?php

}
?>