<?php

session_start();

include_once 'functions/useful.php';
include_once 'db-functions/connexion.php';
include_once 'db-functions/reqs.php';
$db = createConnexion();
if (isset($_GET) && !empty($_GET['id'])) {
     deleteArticle($db, $_GET['id']);
    header('Location: catalogue2.php');
}
