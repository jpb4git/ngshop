<?php
session_start();
include_once 'functions/useful.php';
include_once 'db-functions/connexion.php';
include_once 'db-functions/reqs.php';

$db = createConnexion();

if (isset($_GET['commande'])) {

    $id_commande = $_GET['commande'];
    $articles = ArticlesInCommande($db, $id_commande);

    $addrs = getAdressOnCommand($db, $id_commande);

}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facture Client ngShop</title>
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
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="catalogue2.php">Catalogue</a>
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
<div class="container-fluid">
    <?php include 'header.php'; ?>
</div>
<main>
    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-sm-12 mb-1 mt-5">
                <h5 class="w-100 text-center bg-info text-white p-3">votre commande a bien été enregistrée. </h5>
            </div>
            <div class="col-sm-12 mt-1">
                <h4 class="w-100 text-center bg-warning text-white p-3"> Numéro Unique de votre Commande :
                    <strong> <?php echo $articles[0]->Unique_Num_Command; ?> </strong></h4>
            </div>
        </div>

        <div class="row  p-1">
            <?php
            $n = 0;
            foreach ($addrs as $addr) { ?>
                <div class="col-sm-12 col-md-6 w-50 bg-light text-center">
                    <h4> <?php if ($n % 2 == 0) {
                            echo('Adresse de Facturation');
                        } else {
                            echo('Adresse de Livraison');
                        }
                        $n++; ?></h4>
                    <h4> <?php echo($addr->Label_Adress); ?></h4>
                    <hr class="my-4">

                    <p>
                        <?php echo($addr->Nom_Address . ' ' . $addr->Prenom_Adress . "<br>"); ?>
                    </p>
                    <p>
                        <?php echo($addr->Num_Adress . ' ' . $addr->Rue_Adress . "<br>"); ?>
                    </p>
                    <p>
                        <?php echo($addr->Complement . "<br>"); ?>
                    </p>
                    <p>
                        <?php echo($addr->Cp_Adress . ' ' . $addr->Ville_Adress . "<br>"); ?>
                    </p>
                    <p>
                        <?php echo($addr->Pays_Adress . "<br>"); ?>
                    </p>


                    <hr class="my-4">
                    <p>

                    </p>

                </div>
            <?php } ?>

        </div>
        <div class="row">

            <?php foreach ($articles as $article) { ?>
                <div class="wcolMax col-md-12 d-flex flex-inline justify-content-between align-items-center">
                    <img src="<?php echo $article->Urlimage; ?> " class="art-img-px" width="45" height="45"
                         alt="...">
                    <?php echo $article->Nom; ?>
                    <p class="p-3 m-3">
                        <?php $article->Desc ?>
                        <span>Qts : 
                        <?php echo $article->ligne_cmd_Qts; ?></span>

                        <span class="bg-primary text-white p-3">
                            Prix Unitaire :<?php echo $article->Prix . "  " . MajDevise("euros") ?>
                        </span>
                        <span class="bg-secondary text-white p-3"><?= $article->Prix * $article->ligne_cmd_Qts . "  " . MajDevise("euros") ?></span>
                    </p>
                </div>
            <?php } ?>

            <div class="col-sm-12">

            </div>

        </div>
</main>
<footer>
    <div class="container">
        <div class="row row-footer d-flex justify-content-center align-items-end">

            <div class="col-md-6 d-flex justify-content-center align-items-end mt-4">
                <a class="btn btn-warning" href="">Essayez gratuitement notre site</a>
            </div>
            <div class="col-md-6 d-flex justify-content-center align-items-end mt-4">
                <a class="btn btn-warning" href="">Posez nous vos Questions</a>
            </div>

        </div>
    </div>


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