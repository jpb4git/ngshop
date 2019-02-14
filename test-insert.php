<?php
session_start();
include_once 'functions/useful.php';
include_once 'db-functions/connexion.php';
include_once 'db-functions/reqs.php';

$db = createConnexion();

// VALIDATION PANIER 


   
    // creation user 
    $idUserCreated =  createUser($db,'DOE2','JOHN2','TES2T@TEST.COM','PSEUDO2');   
   
    // create adress one oR TWO (SAME PROCESS)
   $id_adr_L = createAdress($db,$idUserCreated,'Label fac2 ','52','rue du compte2','**','26000','VALENCE','FRANCE','doe','john');
   
   $id_adr_F = createAdress($db,$idUserCreated,'Label fac2 ','52','rue du compte2','**','26000','VALENCE','FRANCE','doe','john');
  
   

    // creation commande 
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
   


