<?php

session_start();

include_once 'functions/useful.php';
include_once 'db-functions/connexion.php';
include_once 'db-functions/reqs.php';

$db = createConnexion();

if (isset($_SESSION['panier'])){
    $total = totalPanier($db,$_SESSION['panier']);
}else{
    $total = totalPanier($db,$_SESSION);
}



if (isset($_POST) && !empty($_POST)) {

    //-----------------------------------------------------------------------------------------------------------------
    // ajout article au panier
    //-----------------------------------------------------------------------------------------------------------------
    if (isset($_POST['ajout']) && $_POST['ajout'] == "Ajouter au panier") {

        $u = 0;
        foreach ($_POST as $key => $value) {
    
            if (is_numeric($value)) {
                $u = rtrim($key, "_") ;
                if (!array_key_exists('id_' . $u, $_SESSION['panier'])) {
                    $_SESSION['panier']['id_' . $u] = ['qts' => 1];
                }else{
                    $_SESSION['panier']['id_' . $u]['qts'] =  intval($_SESSION['panier']['id_' . $u]['qts']) + 1 ;
                }
            }
        }
    
    }
    //-----------------------------------------------------------------------------------------------------------------
    // delete dynamique----------------------------------------------------------------------------------------
    //-----------------------------------------------------------------------------------------------------------------

    foreach ($_POST as $key => $value) {
        if (substr($key, 0, 10) == "deleteItem") {
            // echo "method delete de ouf <br>" . 'id a delete : ' . substr($key, 10) . '<br>';
            unset ($_SESSION['panier']['id_' . substr($key, 10)]);
        }
    }

    //-----------------------------------------------------------------------------------------------------------------
    // recalcule du prix global
    //-----------------------------------------------------------------------------------------------------------------
   $total = totalPanier($db,$_SESSION['panier']);
    if (isset($_POST['recalcule'])) {
        //echo " method recalcule <br>";
        // mise à jour Qts et msgError
        foreach ($_POST as $key => $value) {
            // si on a un input du type modiQts
            if (substr($key, 0, 8) == "modifQts") {
                // si on est numeric
                if (is_numeric($value)) {
                    $_SESSION['panier']['id_' . substr($key, 8)] ['qts'] = $value;
                } else {
                    // echo "'msgError'.substr($key, 8)]";
                    $_SESSION['msgError' . substr($key, 8)] = "valeur numérique Obligatoire!";
                }
            }
        }
        // recalcule du prix final
        $total = totalPanier($db,$_SESSION['panier']);
    }

    //-----------------------------------------------------------------------------------------------------------------
    // vider le panier session destroy
    //-----------------------------------------------------------------------------------------------------------------
    if (isset($_POST['vider'])) {
        unset ($_SESSION['panier']);
        header('Location: catalogue2.php');

    }
}



?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panier ngShop</title>
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
                <li class="nav-item ">
                    <a class="nav-link" href="catalogue2.php">Catalogue<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
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
        <form action="panier.php" method="post">
            <div class="row">
                <h1 class="text-center w-100 p-3 m-3 rounded bg-success text-white">Panier</h1>
                <h1 class="badge  w-100 p-3 m-3">Article(s) ajouté(s)</h1>
            </div>
            <div class="w-100 d-flex justify-content-center p-2 m-2">
            <input class="w-25 btn btn-danger p-1 m-2" type="submit" id="" name="vider" value="vider le panier">  
                <input class="w-25 btn btn-outline-secondary p-1 m-2" type="submit" id="" name="recalcule" value="recalculer le panier">
            </div>
            <div class="row">
            <?php
            $err = false;
            if (isset($_SESSION['panier'])){

            foreach ($_SESSION['panier'] as $key => $value) {
                // on recupère  l'id sans le prefixe
                $k = substr($key, 3);

                // test si la cle n'est pas msgError
                if (substr($key, 0, 3) == "id_") {
                     
                    // l'article existe t'il dans la base
                    if (isExistArticle($db,$k)) {
                    //        
                    $art = getArticle($db,$k);

                    $err = isset($_SESSION['msgError' . $art->id_Article]);

                        if (isset($_SESSION['msgError' . $art->id_Article])) {
                            // on affiche le message d'erreur pour cette Qts
                            ?>
                            <span class="w-100 p-3 bg-danger text-white text-center"><?php echo $_SESSION['msgError' . $art->id_Article] ?></span>
                            <?php
                            //on supprime le message d'errur apres usage
                            unset($_SESSION['msgError' . $art->id_Article]);
                        }
                        if ($err){   ?>
                            <div class="wcolMax col-md-12 d-flex flex-inline justify-content-between align-items-center bg-warning">
                        <?php
                        }else{
                        ?>
                        <div class="wcolMax col-md-12 d-flex flex-inline justify-content-between align-items-center ">
                        <?php } ?>
                        <img src="<?php echo $art->Urlimage ; ?> " class="art-img-px" width="45" height="45" alt="...">
                            <?php echo $art->Nom; ?>
                            <p class="p-3 m-3">
                                <?= $art->Desc ?>
                                <input class="width-qts" type="text" name="modifQts<?php echo $art->id_Article ?>" value="<?php echo $_SESSION['panier']['id_' . $k]['qts'] ?>" size="4">
                                <input class="btn btn-outline-danger" type="submit" name="deleteItem<?php echo $art->id_Article ?>" value="supprimer cet article">
                                <span class="bg-primary text-white p-3"><?= $art->Prix . "  " . MajDevise("euros") ?></span>
                            </p>
                        </div>
                        <?php
                    }
                }
            }
            ?>
            <div class="mb-5 p-5 wcolMax col-md-12 d-flex flex-inline justify-content-end align-items-center">
              
                <div class="w-25 text-right p-3 text-white bg-success rounded">
                  <?php echo "Total  : " . $total ?>
              </div>
            </div>
           <div class="w-100 d-flex justify-content-center">
           <a href="validation.php" class="p-2 mb-5 w-75 btn btn-outline-success" type="submit" id="" name="valider-panier" >Valider mon panier</a>
           </div> 
        </form>
        <?php
        }else{
             ?>
              <div class="mb-5 p-5 wcolMax col-md-12 d-flex flex-inline justify-content-center align-items-center">
              <span><h1>panier vide</h1></span>
              </div>   
         <?php   
        }
        ?>
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