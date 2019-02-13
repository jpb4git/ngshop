<?php



/**
 * getAllArticles    requête qui renvoie tous les articles de la base de donnée 
 * 
 * 
 */
function getAllArticles($instance){

    $sql = "SELECT * FROM Article";
    $stmt = $instance->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll();
    
    return $result;
}

/**
 * 
 * 
 * 
 */
function getArticle($instance ,$id){
    $sql = "SELECT * FROM Article WHERE idArticle =?";
    $stmt = $instance->prepare($sql);
    $stmt->execute([$id]);
    $result = $stmt->fetch();
    
    return $result;

}
/**
 * 
 * 
 * 
 * 
 */
function getComms($instance,$id){
    $sql = "SELECT * FROM Commentaire WHERE id_article =?";
    $stmt = $instance->prepare($sql);
    $stmt->execute([$id]);
    $result = $stmt->fetchAll();
    
    return $result;

}

/**
 * 
 * 
 * 
 */
function getAllArticlesWithNoStock($instance){

    $sql = "SELECT Article.Nom, Article.Prix, Article.Stock FROM Article WHERE Stock = 0";
    $stmt = $instance->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll();
    
    return $result;
}
/**
 * 
 * 
 * 
 * 
 */
function getTodayCommande($instance){

    $sql = "SELECT * FROM Commande where DATE(Date_de_Commande)=CURDATE()
    ORDER BY Commande.commande_num DESC ";
    $stmt = $instance->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll();
    
    return $result;
}
/**
 * 
 * 
 * 
 * 
 */
function getArticleForCat($instance,$id){

    $sql = "SELECT Article.Nom, Categorie.Nom,Article.Stock 
    FROM Article INNER JOIN Categorie ON Article.Categorie_id = Categorie.idCategorie 
    WHERE  Categorie.idCategorie =?";
    $stmt = $instance->prepare($sql);
    $stmt->execute([$id]);
    $result = $stmt->fetchAll();
    
    return $result;
}
/**
 * 
 * 
 * 
 * 
 */
function getCommandeLastTenDays($instance){
    $sql = "SELECT * FROM Commande  WHERE `Date_de_Commande` >= NOW() - INTERVAL 10 DAY;";
    $stmt = $instance->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll();
    
    return $result;

}
/**
 * 
 * 
 * 
 * 
 */
function ArticlesInCommande($instance,$id){
    $sql = "
    SELECT Article.Nom,
           ligne_cmd.ligne_cmd_Qts,
           Article.Prix 
    FROM Article,Commande ,ligne_cmd 
    WHERE ligne_cmd.Commande_id = Commande.idCommande 
    AND   ligne_cmd.Article_id = Article.idArticle
    AND   Commande.idCommande =?;	
    ";
    $stmt = $instance->prepare($sql);
    $stmt->execute([$id]);
    $result = $stmt->fetchAll();
    
    return $result;

}

/**
 * 
 * 
 * 
 * 
 * 
 */
function FindUserInTown($instance,$search){
    $sql = "
    SELECT  User.nom ,Adress.Ville
    FROM  User INNER JOIN Adress ON  User.idUser = Adress.User_id 
    WHERE  Adress.Ville =?";	
    
    $stmt = $instance->prepare($sql);
    $stmt->execute([$search]);
    $result = $stmt->fetchAll();
    
    return $result;

}

function totalLastCommand($instance){
    $sql = "
    SELECT ( SUM(ligne_table.ligne_cmd_Qts * ligne_table.ligne_cmd_prix) )AS tot
    FROM  ligne_cmd ligne_table, 
    (SELECT MAX(Commande.idCommande) as pId FROM Commande) com_table 
    where ligne_table.Commande_id = com_table.pId
    ";	
    
    $stmt = $instance->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll();
    
    return $result;

}


function totalPriceTodayCommande($instance){
    $sql = "
    SELECT SUM(ligne_cmd.ligne_cmd_Qts * ligne_cmd.ligne_cmd_prix) AS tot
    FROM  ligne_cmd ,Commande 
    WHERE DATE(Commande.Date_de_Commande)=CURDATE()
    and Commande.idCommande = ligne_cmd.Commande_id
    ";	
    
    $stmt = $instance->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll();
    
    return $result;

}
/**
 * 
 * 
 * 
 */
function getArticlePriceInterval($instance,$min,$max){
    $sql = "
    SELECT * from Article 
    WHERE Article.Prix >= ? 
    AND Article.Prix <= ?
    ";	
    
    $stmt = $instance->prepare($sql);
    $stmt->execute([$min,$max]);
    $result = $stmt->fetchAll();
    
    return $result;

}
/**
 * 
 * 
 * 
 */
function getUserCommandes($instance,$id){
    $sql = "
    SELECT * FROM Commande 
    WHERE Commande.User_id =?
    ";	
    
    $stmt = $instance->prepare($sql);
    $stmt->execute([$id]);
    $result = $stmt->fetchAll();
    
    return $result;


}
/**
 * 
 * 
 * 
 * 
 */
function countCommandByUser($instance,$id){
    $sql = "
    SELECT COUNT(Commande.idCommande) 
    FROM Commande 
    WHERE Commande.User_id =?
    ";	
    
    $stmt = $instance->prepare($sql);
    $stmt->execute([$id]);
    $result = $stmt->fetchAll();
    
    return $result;
    
}

function CommandSumByUser($instance,$id){
    $sql = "
    SELECT SUM(ligne_cmd.ligne_cmd_Qts * ligne_cmd.ligne_cmd_prix),User.Nom 
        FROM Commande INNER JOIN ligne_cmd ON Commande.idCommande = ligne_cmd.Commande_id 
        INNER JOIN User ON  User.idUser = Commande.User_id
        WHERE User_id = ?
    ";	
    
    $stmt = $instance->prepare($sql);
    $stmt->execute([$id]);
    $result = $stmt->fetchAll();
    
    return $result;
    
}
/**
 * Total panier 
 *  renvoie le total de la ligne  en Euros
 */
function totalPanier($instance,$arr)
{
    $k=0;
    $total = 0;
   
   var_dump('total panier : arr : ' . $arr);
    foreach ($arr as $key => $value) {
        // si l'on est sur un id
        if (substr($key, 0, 3) == "id_") {
            var_dump(substr($key, 0, 3));
            // on recupere l'id sans le prefixe
            $k = substr($key, 3);
            var_dump('ID ARTICLE TRAIT : ' . $k . ' --  ');  
            $tempPrice = (getLignePrix($instance,intval($k)));     
            var_dump('TEMP PRICE  : '. $tempPrice . ' -- ');                        
            $total += $tempPrice * intval($value['qts']) ; 
            var_dump('TOTAL : '. $total);         
            //$total += $articles[intval($k-1)]['prix'] * intval($value['qts']) ;
        }
    }
    return $total . " Euros";
}

/**  
 * getLignePrix   renvoie le prix d'un article 
 * 
 * $id int   : id de l'article
 * 
 */
function getLignePrix($instance,$id){
    $sql = "SELECT Prix FROM Article WHERE idArticle = ?"; 
    $stmt = $instance->prepare($sql);
    $stmt->execute([$id]);
    $result = $stmt->fetch();
    
    return $result;

}

/**
 *
 * @param $id   id de l'aticle
 * @return bool retourne si existant dans la base ou non
 */
function isExistArticle($instance, $id)
{
    $sql = "SELECT idArticle FROM Article WHERE idArticle = ?"; 
    $stmt = $instance->prepare($sql);
    $stmt->execute([$id]);
    $result = $stmt->fetch();
   
    return $result > 0 ;

}
