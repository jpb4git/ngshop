<?php
session_start();
include_once 'functions/useful.php';
include_once 'db-functions/connexion.php';
include_once 'db-functions/reqs.php';

$db = createConnexion();

// VALIDATION PANIER 
if (isset($_POST) && !empty($_POST)){

   // creation user 
   $idUserCreated =  createUser($db,$_POST['InputName'],$_POST['prenom'],$_POST['email'],$_POST['Pseudo']);   
   // CREATION ADRESSES 
   // facturation
   $id_adr_L = createAdress($db,
                 $idUserCreated,
                 $_POST['fLabelAdresse'],
                 $_POST['fnum'],
                 $_POST['frue'],
                 $_POST['fcomp'],
                 $_POST['fcp'],
                 $_POST['fville'],
                 $_POST['fpays'],
                 $_POST['fnom'],
                 $_POST['fprenom']
                );
    //livraison 
    $id_adr_F =  createAdress($db,
                $idUserCreated,               
                $_POST['lLabelAdresse'],
                $_POST['lnum'],
                $_POST['lrue'],
                $_POST['lcomp'],
                $_POST['lcp'],
                $_POST['lville'],
                $_POST['lpays'],
                $_POST['lnom'],
                $_POST['lprenom']
               );
   
               

       

    // creation ligne de commande 
    $idCommandCreated =  createCommande($db,$idUserCreated,$id_adr_F,$id_adr_L);  
    
   // creation ligne de commande 
   if (isset($_SESSION['panier'])){
        foreach ($_SESSION['panier'] as $key => $value) {
            // on recupère  l'id sans le prefixe
            $k = substr($key, 3);
            $Prix = floatval(getLignePrix($db,$k));
            // le prefixe est bien id_
            if (substr($key, 0, 3) == "id_") {
                createLigneCommande($db,$k,$idCommandCreated,$_SESSION['panier']['id_' . $k]['qts'],$Prix);     
            }
        }
    }    
    header('Location: facture.php?commande='.$idCommandCreated); 
}

if (isset($_SESSION['panier'])){
    $total = totalPanier($db,$_SESSION['panier']);
}else{
    $total = totalPanier($db,$_SESSION);
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validation Panier ngShop</title>
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
        <div class="container">
            <div class="row w-100">
                <form class="w-100" action="validation.php" method="post">

                    <div class=" user-info col-sm-12">

                        <div class="form-group p-3">
                            <label class="ml-1" for="InputEmail1">adresse Email<strong class="text-danger"> *
                                </strong></label>
                            <input type="email" class="form-control" id="InputEmail1" name="email"
                                aria-describedby="emailHelp" placeholder="Enter email" required>

                            <hr>
                            <label for="Pseudo">Pseudo <strong class="text-danger"> * </strong></label>
                            <input type="input" class="form-control" name="Pseudo" id="Pseudo" placeholder="Pseudo"
                                required>
                            <label class="ml-1" for="InputName">Nom<strong class="text-danger"> * </strong></label>
                            <input type="input" class="form-control" name="InputName" id="InputName" placeholder="Doe"
                                required>
                            <label class="ml-1" for="prenom">Prénom<strong class="text-danger"> * </strong></label>
                            <input type="input" class="form-control" name="prenom" id="prenom" placeholder="john"
                                required>
                            <hr>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center">
                        <div class=" user-info col-sm-6">
                            <div class="form-group p-3">
                                <h3>Adresse de Facturation </h3>
                                <label class="ml-1" for="LabelAdresse">Reminder Adresse</label>
                                <input type="input" class="form-control" name="fLabelAdresse" id="LabelAdresse"
                                    placeholder="Adresse Facturation" required>
                                <hr>
                                <label class="ml-1" for="fnom">Nom<strong class="text-danger"> * </strong></label>
                                <input type="input" class="form-control" name="fnom" id="fnom" placeholder="" required>

                                <label class="ml-1" for="fprenom">Prénom<strong class="text-danger"> * </strong></label>
                                <input type="input" class="form-control" name="fprenom" id="fprenom" placeholder=""
                                    required>
                                <hr class="mb-5">
                                <label class="ml-1" for="fnum">Numéro<strong class="text-danger"> * </strong></label>
                                <input type="input" class="form-control" name="fnum" id="fnum" placeholder="" required>

                                <label class="ml-1" for="frue">Rue<strong class="text-danger"> * </strong></label>
                                <input type="input" class="form-control" name="frue" id="frue" placeholder="" required>

                                <label class="ml-1" for="fcomp">Complément</label>
                                <input type="input" class="form-control" name="fcomp" id="fcomp" placeholder="">

                                <label class="ml-1" for="fcp">Code Postal<strong class="text-danger"> *
                                    </strong></label>
                                <input type="input" class="form-control" name="fcp" id="fcp" placeholder="" required>

                                <label class="ml-1" for="fville">Ville<strong class="text-danger"> * </strong></label>
                                <input type="input" class="form-control" name="fville" id="fville" placeholder=""
                                    required>

                                <label class="ml-1" for="fpays">Pays<strong class="text-danger"> * </strong></label>
                                <input type="input" class="form-control" name="fpays" id="fpays" placeholder=""
                                    required>
                            </div>
                        </div>
                        <div class=" user-info col-sm-6">
                            <div class="form-group p-3">
                                <h3>Adresse de Livraison </h3>
                                <label class="ml-1" for="lLabelAdresse">Reminder Adresse</label>
                                <input type="input" class="form-control" name="lLabelAdresse" id="lLabelAdresse"
                                    placeholder="Adresse livraison maison" required>
                                <hr>
                                <label class="ml-1" for="lnom">Nom<strong class="text-danger"> * </strong></label>
                                <input type="input" class="form-control" name="lnom" id="lnom" placeholder="" required>

                                <label class="ml-1" for="lprenom">Prénom<strong class="text-danger"> * </strong></label>
                                <input type="input" class="form-control" name="lprenom" id="lprenom" placeholder=""
                                    required>
                                <hr class="mb-5">
                                <label class="ml-1" for="lnum">Numéro <strong class="text-danger"> * </strong></label>
                                <input type="input" class="form-control" name="lnum" id="lnum" placeholder="" required>

                                <label class="ml-1" for="lrue">Rue <strong class="text-danger"> * </strong></label>
                                <input type="input" class="form-control" name="lrue" id="lrue" placeholder="" required>

                                <label class="ml-1" for="lcomp">Complément</label>
                                <input type="input" class="form-control" name="lcomp" id="lcomp" placeholder="">

                                <label class="ml-1" for="lcp">Code Postal <strong class="text-danger"> *
                                    </strong></label>
                                <input type="input" class="form-control" name="lcp" id="lcp" placeholder="" required>

                                <label class="ml-1" for="lville">Ville <strong class="text-danger"> * </strong></label>
                                <input type="input" class="form-control" name="lville" id="lville" placeholder=""
                                    required>

                                <label class="ml-1" for="lpays">Pays <strong class="text-danger"> * </strong></label>
                                <input type="input" class="form-control" name="lpays" id="lpays" placeholder=""
                                    required>
                            </div>
                        </div>
                    </div>
                    <hr class="mb-5">
                    <hr class="mb-5">
                    <!-- RECAP PANIER  -->
                    <div class=" panier-info col-sm-12">
                        <h3 class="w-100 text-center">Récapitulatif Aticles </h3>
                        <hr class="mb-5">
                        <hr class="mb-5">
                        <!-- RECAP PANIER  -->
                        <div class=" panier-info col-sm-12">
                            <?php
                       
                        if (isset($_SESSION['panier'])){
                        foreach ($_SESSION['panier'] as $key => $value) {
                            // on recupère  l'id sans le prefixe
                            $k = substr($key, 3);
                            // test si la cle n'est pas msgError
                            if (substr($key, 0, 3) == "id_") {
                                // l'article existe t'il dans l'array d'article
                                if (isExistArticle($db,$k)) {      
                                    $art = getArticle($db,$k);
                                    ?>
                            <div class="wcolMax col-md-12 d-flex flex-inline justify-content-between align-items-center">
                                <img src="<?php echo $art->Image ;?> " class="art-img-px" width="45" height="45"
                                    alt="...">
                                <?php echo $art->Nom; ?>
                                <p class="p-3 m-3">
                                    <?= $art->Desc ?>
                                    <span>Qts : <?php echo $_SESSION['panier']['id_' . $k]['qts'] ?></span>
                                    <span class="bg-primary text-white p-3">
                                        Prix Unitaire :
                                        <?= $art->Prix . "  " . MajDevise("euros") ?>
                                    </span>
                                </p>
                            </div>
                            <?php
                                }
                            }
                        }

                        ?>
                            <div
                                class="mb-5 p-5 wcolMax col-md-12 d-flex flex-inline justify-content-end align-items-center">

                                <div class="w-25 text-right p-3 text-green btn btn-outline-success rounded">
                                    <?php echo "Total  : " . $total ?>
                                </div>
                            </div>
                            <div class="w-100 d-flex justify-content-center">
                                <input type="submit" class="p-2 mb-5 w-75 btn btn-outline-success" type="submit"
                                    name="valider-panier" value="valider ma Commande">
                            </div>
                </form>
                <?php
                }else{
                    ?>
                <div class="mb-5 p-5 wcolMax col-md-12 d-flex flex-inline justify-content-center align-items-center">
                    <span>
                        <h1>panier vide</h1>
                    </span>
                </div>
                <?php   
                }
                ?>


            </div>
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