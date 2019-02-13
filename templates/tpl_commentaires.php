<?php
$com = getComms($db,$art->idArticle);
                                //lister les commentaires pour cet article
                                for ($i = 0; $i < count($com); $i++ )   {
                                    
                                        ?>
                                        <div class="col-md-2 mb-3">
                                            <img class=" w-25" src="<?php echo $com[$i]->url_avatar ?>" alt="">
                                            <span class="ml-1 text-success"><?php echo $com[$i]->name ?></span>
                                        </div>
                                        <div class="col-md-7 mb-3"><?php echo $com[$i]->commentaire ?></div>
                                        <div class="col-md-3">
                                            <span>
                                         <?php
                                         for ($i = 0; $i < 5; $i++) {

                                             if (intval($com[$i]->stars) >= $i) {
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