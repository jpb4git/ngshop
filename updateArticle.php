<?php

include_once 'functions/useful.php';
include_once 'db-functions/connexion.php';
include_once 'db-functions/reqs.php';

$db = createConnexion();


if (isset($_GET) && !empty($_GET['id'])) {
    $art = getArticle($db, $_GET['id']);

}

if (isset($_POST['submit']) && !empty($_POST['submit'])) {

    updateArticlePrix($db,$_POST['id'],$_POST['Prix']);
    updateArticleStock($db,$_POST['id'],$_POST['Stock'])  ;
    $art = getArticle($db,$_POST['id']);
    //var_dump($_POST);
    //die();



}


?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Boutique en Ligne</title>
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
                    <a class="nav-link" href="catalogue.php">Articles<span class="sr-only">(current)</span></a>
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
            <div class="col">
                <a href="catalogue2.php" class="btn btn-success m-1 p-3"> Retour au catalogue</a>
                <h1 class="p-3 mt-3 mb-3 mr-1 ml-1 badge  w-100"><?= $art->Nom ?></span></h1>
            </div>

        </div>
        <div class="row">
            <form action="updateArticle.php" method="post">
                <div class="col-sm-12 ">
                    <div class="card">
                        <div class="card-header d-flex justify-content-center bg-white">
                            <img src="<?php echo $art->Urlimage; ?>" class="art-img img-fluid w-25 card-img-top"
                                 alt="...">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title"><?= $art->Nom ?></h5>
                            <p class="card-text"><?= $art->Desc ?></p>
                            <!--<p class="card-text"><?PHP //$art['descFull'] ?></p> -->
                            <p class="bg-secondary rounded p-3 text-white text-center">
                                <input type="text" value="<?php echo $art->Prix ?>" name="Prix"> Euros
                            </p>
                            <p class="bg-secondary rounded p-3 text-white text-center">
                                <input type="text" value="<?php echo $art->Stock ?>" name="Stock"> Unités
                                <input type="hidden" value="<?php echo $art->id_Article ?>" name="id">
                            </p>
                            <div class="card-footer d-flex justify-content-center bg-white">
                                <div class="col-sm-12 d-flex justify-content-center">
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <input type="submit" name="submit" value="Modifier">
            </form>
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