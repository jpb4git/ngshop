<?php

include 'functions/useful.php';
// recuperer la listes des articles au format Array;
$articles = generateCatalogue();


?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catalogue ngSohp</title>
    <link href="https://fonts.googleapis.com/css?family=Ubuntu+Condensed" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css"
          integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link rel="stylesheet" href="css/app.css">
</head>

<body>
<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">NgShop</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item ">
                    <a class="nav-link" href="index.php">Home </a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="catalogue2.php">Catalogue<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="panier.php">Panier</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"></a>
                </li>

            </ul>
        </div>
    </nav>
</header>
<main>

    <div class="container-fluid">
        <?php include 'header.php'; ?>
    </div>
    <div class="container">


        <div class="row">
            <h1 class="badge badge-success w-100 p-3 m-3">Articles</h1>
        </div>
        <div class="row">
            <?php
            // parcourir les articles dans le catalogue
            foreach ($articles as $value) {

                ?>
                <div class="col-sm-12 col-lg-6">
                    <div class="card">
                        <div class="card-header d-flex justify-content-center bg-white">
                            <img src="<?php echo $value['url']; ?>" class="art-img  card-img-top " alt="...">
                        </div>

                        <div class="card-body">
                            <h5 class="card-title"><?= $value['nom'] ?></h5>
                            <p class="card-text"><?= $value['desc'] ?>
                                <span class="d-flex justify-content-center bg-primary text-white p-3"><?= $value['prix'] . "  " . MajDevise("euros") ?></span>
                            </p>
                            <div class="card-footer d-flex justify-content-center bg-white">
                                <a href="article.php?id=<?= $value['id'] ?>" class="btn btn-warning ml-1 p-3 d-flex justify-content-center align-items-center">
                                    <i class="material-icons">shopping_cart</i>
                                    ajouter au panier
                                </a>
                                <a href="article.php?id=<?= $value['id'] ?>" class="btn btn-secondary ml-1 p-3">visualiser le détail</a>

                            </div>

                        </div>
                    </div>
                </div>
                <?php
            }
            ?>


        </div>


    </div>

</main>
<footer>

</footer>


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"
        integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous">
</script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"
        integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous">
</script>
</body>

</html>