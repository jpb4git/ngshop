<div class="row ">
            <h1 class="badge  w-100 p-3 m-3">Articles</h1>
        </div>
        <div class="row panier-row">
            <form action="panier.php" method="post">
                <?php
                for ($i = 0 ; $i < count($articles); $i++) { ?>
                    <div class="col-sm-12 ">
                        <div class="div row">
                            <div class="col-md-2 mb-5">
                                <img src="<?php echo $articles[$i]->Image; ?> " class="art-img-px" width="45" height="45" alt="...">
                            </div>
                            <div class="col-md-3">
                            <a href="article.php?id=<?= $articles[$i]->idArticle ?>" class="d-flex justify-content-between  btn btn-info w-100 text-center"> 
                                <?= $articles[$i]->Nom ?>
                                <i class="d-flex ml-1 material-icons">visibility</i>
                            </a>    
                            
                            </div>
                            <div class="col-md-5 d-flex justify-content-end">
                                <p class=""><?= $articles[$i]->Desc ?>
                                    <span class="bg-primary text-white p-3"><?= $articles[$i]->Prix . "  " . MajDevise("euros") ?></span>
                                </p>
                            </div>
                            <div class="col-md-2">
                                <label>Add </label>
                                <input type="checkbox" id="<?php echo $articles[$i]->idArticle;?>" name="<?php echo $articles[$i]->idArticle; ?> "value="<?php echo $articles[$i]->idArticle; ?>"><br>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                ?>
                <div class="col-sm-12 m-3 d-flex justify-content-center">
                    <input class="btn btn-outline-success" type="submit" id="ajout" name="ajout" value="Ajouter au panier">
                </div>
            </form>
        </div>