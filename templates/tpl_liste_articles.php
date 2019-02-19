<div class="row ">
            <h1 class="badge  w-100 p-3 m-3">Articles</h1>
        </div>
        <div class="row panier-row">
            <form action="panier.php" method="post">
                <?php
                foreach ($articles as $article){ ?>
                    <div class="col-sm-12 ">
                        <div class="div row">
                            <div class="col-md-2 mb-5">

                                <img src="<?php echo $article->Urlimage; ?> " class="art-img-px" width="45" height="45" alt="...">
                            </div>
                            <div class="col-md-3">
                            <a href="article.php?id=<?= $article->id_Article ?>" class="d-flex justify-content-between  btn btn-info w-100 text-center">
                                <?= $article->Nom ?>
                                <i class="d-flex ml-1 material-icons">visibility</i>
                            </a>    
                            
                            </div>
                            <div class="col-md-5 d-flex justify-content-end">
                                <p class=""><?= $article->Description ?>
                                    <span class="bg-primary text-white p-3"><?= $article->Prix . "  " . MajDevise("euros") ?></span>
                                </p>
                            </div>
                            <div class="col-md-2">
                                <label>Add </label>
                                <input type="checkbox"  name="article_select[]" value="<?php echo $article->id_Article; ?>"><br>

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