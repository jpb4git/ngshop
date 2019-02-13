<?php
session_start();

include_once'class/database.php';
include_once 'functions/useful.php';
include_once 'db-functions/connexion.php';


// class call
$db = new \classes\Database();



//function call
$db2 = createConnexion();






$res = getAllArticles($db2);
jdebug($res);

for ($i = 0 ;$i < count($res);$i++) {
    echo $res[$i]->idArticle;
    echo $res[$i]->nom;
    echo $res[$i]->prenom;
    echo $res[$i]->Description;
    echo $res[$i]->Poids;

 }






?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NgShop Test db connexion</title>
    <link href="https://fonts.googleapis.com/css?family=Ubuntu+Condensed" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS"crossorigin="anonymous">
    <link rel="stylesheet" href="css/app.css">
</head>

<body>
  <header>
     <nav class="navbar navbar-expand-lg navbar-light bg-light">
       <a class="navbar-brand" href="#">NgShop</a>
       <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
         <span class="navbar-toggler-icon"></span>
       </button>
       <div class="collapse navbar-collapse" id="navbarNav">
         <ul class="navbar-nav">
           <li class="nav-item active">
             <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
           </li>
           <li class="nav-item">
             <a class="nav-link" href="#">Catalogue</a>
           </li>
           <li class="nav-item">
             <a class="nav-link" href="#">panier</a>
           </li>
           <li class="nav-item">
             <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Test db code </a>
           </li>
         </ul>
       </div>
     </nav>   
  </header>
  <main>

  </main>  
  <footer>

  </footer>  


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
</body>

</html>