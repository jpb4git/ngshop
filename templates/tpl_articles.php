
<?php 


?>
<div class="row">
            <h1 class="badge badge-success w-100 p-3 m-3">Articles</h1>
        </div>
        <div class="row">
            <?php
            // parcourir les articles dans le catalogue
            for ($i = 0 ; $i < count($articles);$i++) {
                ?>
                <div class="col-sm-12 col-lg-6">
                    <div class="card">
                        <div class="card-header d-flex justify-content-center bg-white">
                            <img src="<?php echo $articles[$i]->Image; ?>" class="art-img  card-img-top " alt="...">
                        </div>

                        <div class="card-body">
                            <h5 class="card-title"><?= $articles[$i]->Nom ?></h5>
                            <p class="card-text"><?= $articles[$i]->Desc ?>
                                <span class="d-flex justify-content-center bg-primary text-white p-3"><?= $articles[$i]->Prix . "  " . MajDevise("euros") ?></span>
                            </p>
                            <div class="card-footer d-flex justify-content-center bg-white">
                                <a href="article.php?id=<?= $articles[$i]->idArticle ;?>" class="btn btn-warning ml-1 p-3 d-flex justify-content-center align-items-center">
                                    <i class="material-icons">shopping_cart</i>
                                    ajouter au panier
                                </a>
                                <a href="article.php?id=<?= $articles[$i]->idArticle ?>" class="btn btn-secondary ml-1 p-3">visualiser le détail</a>

                            </div>

                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>