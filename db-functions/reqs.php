<?php


/**
 * getAllArticles    requête qui renvoie tous les articles de la base de donnée
 *
 *
 */
function getAllArticles($instance)
{

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
function getArticle($instance, $id)
{
    $sql = "SELECT * FROM Article WHERE id_Article =?";
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
function getComms($instance, $id)
{
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
function getAllArticlesWithNoStock($instance)
{

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
function getTodayCommande($instance)
{

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
function getArticleForCat($instance, $id)
{

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
function getCommandeLastTenDays($instance)
{
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
function ArticlesInCommande($instance, $id)
{
    $sql = "
    SELECT Article.Nom,
           ligne_cmd.ligne_cmd_Qts,
           Article.Prix,Article.Urlimage,
           Commande.Unique_Num_Command,ligne_cmd.ligne_cmd_Qts 
    FROM Article,Commande ,ligne_cmd 
    WHERE ligne_cmd.Commande_id = Commande.id_Commande 
    AND   ligne_cmd.Article_id = Article.id_Article
    AND   Commande.id_Commande =?;	
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
function FindUserInTown($instance, $search)
{
    $sql = "
    SELECT  User.nom ,Address.Ville
    FROM  User INNER JOIN Address ON  User.idUser = Address.User_id 
    WHERE  Address.Ville =?";

    $stmt = $instance->prepare($sql);
    $stmt->execute([$search]);
    $result = $stmt->fetchAll();

    return $result;

}

/**
 * @param $instance
 * @return mixed
 */
function totalLastCommand($instance)
{
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

/**
 * @param $instance
 * @return mixed
 */
function totalPriceTodayCommande($instance)
{
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
function getArticlePriceInterval($instance, $min, $max)
{
    $sql = "
    SELECT * from Article 
    WHERE Article.Prix >= ? 
    AND Article.Prix <= ?
    ";

    $stmt = $instance->prepare($sql);
    $stmt->execute([$min, $max]);
    $result = $stmt->fetchAll();

    return $result;

}

/**
 *
 *
 *
 */
function getUserCommandes($instance, $id)
{
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
function countCommandByUser($instance, $id)
{
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

function CommandSumByUser($instance, $id)
{
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
 * @param $instance : instance de la base de données
 * @param $id_Command : id de la commande
 * @return mixed
 */
function getAdressOnCommand($instance, $id_Command)
{

    $sql = "SELECT * FROM Commande, Address  WHERE Address.User_id  = Commande.User_id AND Commande.id_Commande =?";
    $stmt = $instance->prepare($sql);
    $stmt->execute([$id_Command]);
    $result = $stmt->fetchall();

    return $result;

}

/**
 * Total panier
 *  renvoie le total de la ligne  en Euros
 */
function totalPanier($instance, $arr)
{
    $k = 0;
    $total = 0;
    foreach ($arr as $key => $value) {
        // si l'on est sur un id
        if (substr($key, 0, 3) == "id_") {
            // on recupere l'id sans le prefixe
            $k = substr($key, 3);
            $tempPrice = floatval(getLignePrix($instance, intval($k)));
            $total += $tempPrice * intval($value['qts']);
        }
    }
    return $total;
}

/**
 * getLignePrix   renvoie le prix d'un article
 *
 * $id int   : id de l'article
 *
 */
function getLignePrix($instance, $id)
{

    $sql = "SELECT Prix FROM Article WHERE id_Article = ?";

    $stmt = $instance->prepare($sql);
    $stmt->execute([$id]);
    $result = $stmt->fetch();

    return $result->Prix;

}

/**
 *
 * @param $id   id de l'aticle
 * @return bool retourne si existant dans la base ou non
 */
function isExistArticle($instance, $id)
{

    $sql = "SELECT id_Article FROM Article WHERE id_Article = ?";
    $stmt = $instance->prepare($sql);
    $stmt->execute([$id]);
    $result = $stmt->fetch();

    return $result > 0; // renvoie false si pas present

}

/*******************************************************VALIDATION PANIER ********************************************************* */
/**
 * createUser
 * $instance : dbConnexion
 * $Nom
 * $Prenon
 * $Email
 * $Pseudo
 *
 */
function createUser($instance, $Nom, $Prenom, $Email, $Pseudo)
{

    $Pass = "AZERTYAZER";
    $stmt = $instance->prepare("INSERT INTO User (Nom,Prenom,Mail,Password,Pseudo) VALUES (?,?,?,?,?)");


    $stmt->bindParam(1, $Nom);
    $stmt->bindParam(2, $Prenom);
    $stmt->bindParam(3, $Email);
    $stmt->bindParam(4, $Pass);
    $stmt->bindParam(5, $Pseudo);

    $stmt->execute();
    return $instance->LastInsertId();

}


/**
 *  ajout d'une adresse dans la table adresse reliée à un User
 *
 *
 *
 */
function createAdress($instance, $idUser, $label, $num, $rue, $comp, $cp, $ville, $pays, $nom, $prenom)
{

    $stmt = $instance->prepare("INSERT INTO Address (Label_Adress,Nom_Address,Prenom_Adress,Num_Adress,Rue_Adress,Complement,Cp_Adress,Ville_Adress,Pays_Adress,User_id) VALUES (?,?,?,?,?,?,?,?,?,?)");
    $stmt->bindParam(1, $label);
    $stmt->bindParam(2, $nom);
    $stmt->bindParam(3, $prenom);
    $stmt->bindParam(4, $num);
    $stmt->bindParam(5, $rue);
    $stmt->bindParam(6, $comp);
    $stmt->bindParam(7, $cp);
    $stmt->bindParam(8, $ville);
    $stmt->bindParam(9, $pays);
    $stmt->bindParam(10, $idUser);

    $stmt->execute();
    return $instance->LastInsertId();

}


/**
 *  ajout d'une adresse dans la table adresse reliée à un User
 *
 *
 *
 */
function createCommande($instance, $idUserCreated, $id_adr_F, $id_adr_L)
{
    $isExist = true;

    $cmdUnique = RandomString();
    while ($isExist) {
        // num gen est dèjà en base ? 
        $isExist = isNumComExist($instance, $cmdUnique);
        // si oui on regenere 
        if ($isExist) {
            $cmdUnique = RandomString();
        }
    }
    $stmt = $instance->prepare("INSERT INTO Commande (Unique_Num_Command,Date_de_commande,Adress_id_livraison,Adress_id_facturation,User_id) VALUES (?,?,?,?,?)");
    $stmt->bindParam(1, $cmdUnique);
    $stmt->bindParam(2, date('Y-m-d H:i:s'));
    $stmt->bindParam(3, $id_adr_L);
    $stmt->bindParam(4, $id_adr_F);
    $stmt->bindParam(5, $idUserCreated);

    $stmt->execute();
    return $instance->LastInsertId();

}

/**
 * @param $instance
 * @param $idArticle
 * @param $idCommandCreated
 * @param $qts
 * @param $Prix
 */
function createLigneCommande($instance, $idArticle, $idCommandCreated, $qts, $Prix)
{

    $stmt = $instance->prepare("INSERT INTO ligne_cmd (Article_id,Commande_id,ligne_cmd_Qts,ligne_cmd_prix) VALUES (?,?,?,?)");
    $stmt->bindParam(1, $idArticle);
    $stmt->bindParam(2, $idCommandCreated);
    $stmt->bindParam(3, $qts);
    $stmt->bindParam(4, $Prix);

    $stmt->execute();


}


/**
 *
 *
 *
 */
function isNumComExist($instance, $numCom)
{
    $sql = "SELECT * FROM Commande  WHERE Unique_Num_Command =? ";
    $stmt = $instance->prepare($sql);
    $stmt->execute([$numCom]);
    return $stmt->rowCount() > 0;


}

/**
 * @param $montant_total
 * @return float|int
 */
function calculFraisPort($montant_total)
{
    $poidsTotal = 0;

    foreach ($_SESSION['panier'] as $articlePanier) {
        $poidsTotal += $articlePanier['poids'] * $articlePanier['qts'];
    }

    if ($poidsTotal <= 0.500) {
        $fraisport = 5;
        //echo 'frais de port : 5 euros';
    } else if ($poidsTotal > 0.500 && $poidsTotal <= 2) {
        $fraisport = $montant_total * 0.10;
        //echo 'frais de port :' . $fraisport . 'euros';

    } else {
        $fraisport = 0;
        //echo 'frais de port gratuit';
    }
    return $fraisport;
}

/**
 * @param $frais
 * @return string
 */
function labelingFraisDePort($frais)
{

    if ($frais == 0) {
        return 'frais de port Offerts';
    } else {
        return ' dont ' . $frais . ' Euros de frais de port';

    }
}

/**
 * @param $instance
 * @param $id_Article
 * @param $Prix
 */
function updateArticlePrix($instance, $id_Article, $Prix)
{
    $sql = "UPDATE Article SET 
           Prix = :Prix 
           WHERE id_Article = :id_Article";

    $stmt = $instance->prepare($sql);
    $stmt->bindParam('Prix', $Prix, PDO::PARAM_STR);
    $stmt->bindParam('id_Article', $id_Article, PDO::PARAM_INT);

    $stmt->execute();

}

/**
 * @param $instance
 * @param $id_Article
 * @param $stock
 */
function updateArticleStock($instance, $id_Article, $stock)
{

    $sql = "UPDATE Article SET 
           Stock = :Stock 
           WHERE id_Article = :id_Article";

    $stmt = $instance->prepare($sql);
    $stmt->bindParam(':Stock', $stock, PDO::PARAM_STR);
    $stmt->bindParam(':id_Article', $id_Article, PDO::PARAM_INT);

    $stmt->execute();
}

/**
 * @param $instance
 * @param $id_article
 */
function deleteArticle($instance, $id_article)
{
    $stmt = $instance->prepare("DELETE FROM Article WHERE id_Article = ?");
    $stmt->execute([$id_article]);

}
