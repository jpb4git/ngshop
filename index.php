<?php
session_start();

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ngShop</title>
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
<main>
    <div class="container-fluid">
        <div class="row bandeau">
            <div class="col-lg-2 ml-4 mt-5 "></div>
            <div class="col-lg-4 ml-4 mt-5 text-center">
                <img class="img-fluid w-50" src="assets/icon-hub-yellow.svg" alt="">
            </div>
            <div class="col-lg-4  mt-5 ml-0 mb-5 text-center ">
                <h1 class="largeTxt text-white mt-5 p-5">ngShop</h1>
                <h2 class="text-white mt-5 p-5">Les apps que vous aimez. Et celles que vous allez adorer.
                </h2>
                <a class="infoBtn btn btn-warning" href="catalogue2.php">Go to the Shop !!!</a>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <h3 class="text-center mt-5 mb-1">
                    Les Atouts nbShop
                </h3>
                <h3 class="text-center mt-1 mb-5">

                </h3>
            </div>
            <div class="col-sm-12 green-bottom-line">

                <ul class="ul-features d-flex justify-content-center ">
                    <li class="ml-5 mr-5 text-center">

                        <img class="svg-icon" src="assets/icon-Cloud-green.svg" alt="">
                        <h5>Cloud</h5>
                    </li>
                    <li class="ml-5 mr-5 text-center">

                        <img class="svg-icon" src="assets/icon-Load-Balancing-green.svg" alt="">
                        <h5>portabilité</h5>
                    </li>
                    <li class="ml-5 mr-5 text-center">

                        <img class="svg-icon" src="assets/icon-Microservices-green.svg" alt="">
                        <h5>gestion des stocks</h5>
                    </li>
                    <li class="ml-5 mr-5 text-center">

                        <img class="svg-icon" src="assets/icon-Security-green.svg" alt="">
                        <h5>paiement sécurisé</h5>
                    </li>
                    <li class="ml-5 mr-5 text-center">

                        <img class="svg-icon" src="assets/icon-Web-and-Mobile-Applications-green.svg" alt="">
                        <h5>Livraison just-in-time </h5>
                    </li>
                </ul>

            </div>
            <div class="row">
                <div class="col-sm-12 green-bottom-line">
                    <div class="row p-5 d-flex justify-content-end">
                        <div class="col-lg-7 p-5 ml-3 d-flex flex-column justify-content-end">
                            <h2>Les apps ont le pouvoir de changer la façon dont vous faites tout ce qui vous passionne
                                : créer, apprendre, jouer… ou tout simplement être plus productif. ngShop est l’endroit
                                idéal pour découvrir de nouvelles apps qui vous feront vivre vos passions comme jamais.
                            </h2>
                            <a class=" infoBtn btn btn-warning" href="">Lorem </a>
                        </div>
                        <div class="col-lg-3 d-flex flex-column justify-content-center text-center">
                            <img class="img-head img-fluid rounded-circle text-center"
                                 src="assets/office-and-admin-work.jpg" alt="Aaron">
                            <h6 class="mt-3 ml-0">AARON MARY -- responsable Développement</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- modern application  -->
    <div class="container-fluid">
        <div class="row modern">
            <div class="col-md-12">

            </div>
            <div class="col-md-4">

            </div>
            <div class="col-md-4">

            </div>
            <div class="col-md-4">

            </div>
        </div>

    </div>
    <div class="container-fluid green-container">
        <div class="row trans pt-5">
            <dic class="col-sm-12"><h2 class="text-center w-100 text-white">Trusted by 66% of the world’s busiest
                    sites</h2></dic>
        </div>
        <div class="row trans pt-5">
            <div class="col-sm-12 col-md-3 d-flex justify-content-center">
                <img class="custom" src="assets/custom1.svg" alt="">
            </div>
            <div class="col-sm-12 col-md-3 d-flex justify-content-center">
                <img class="custom" src="assets/custom2.svg" alt="">
            </div>
            <div class="col-sm-12 col-md-3 d-flex justify-content-center">
                <img class="custom" src="assets/custom3.svg" alt="">
            </div>
            <div class="col-sm-12 col-md-3 d-flex justify-content-center">
                <img class="custom" src="assets/custom4.svg" alt="">
            </div>


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