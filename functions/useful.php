<?php
/**
 * fonctionnal debug function 
 * met en page le debugging
 */
function jdebug($var){
    highlight_string("<?php\n\$data =\n" . var_export($var, true) . ";\n?>");
}
/**
 * @param $devise  String de la device utilisée
 * @return string   la device avec la premiere lettre majuscule
 */
function MajDevise($devise)
{
    return ucfirst($devise);
}

function RecalculatePanier($arr)
{
    $total = 0;

    $articles = generateCatalogue();
    foreach ($arr as $key => $value) {
        if (is_numeric($value)) {
            $total += intval($articles[$key - 1]['prix']) * intval($value);
        }
    }
    return $total . " Euros";


}

/**
 * @param $arr
 * @return string
 */
function totalPanier($arr)
{
    $k=0;
    $total = 0;
    $articles = generateCatalogue();
    foreach ($arr as $key => $value) {
        // si l'on est sur un id
        if (substr($key, 0, 3) == "id_") {
            // on recupere l'id sans le prefixe
            $k = substr($key, 3);
            $total += $articles[intval($k-1)]['prix'] * intval($value['qts']) ;
        }
    }
    return $total . " Euros";
}

/**
 *  renvoie les informations d'un article selectionné
 *
 * @param $id   id de l'article
 * @return array detail de l'article
 */
function getArticleInfo($id)
{
    $art1 = [];
    $articles = generateCatalogue();
    if (isExistArticle($id)) {
        for ($i = 0; $i < count($articles); $i++) {
            // si nous sommes sur l'article traité
            if ($articles[$i]['id'] == $id) {
                $arr1 = array('id' => $articles[$i]['id'], 'nom' => $articles[$i]['nom'], 'prix' => $articles[$i]['prix'], 'descFull' => $articles[$i]['descFull'], 'desc' => $articles[$i]['desc'], 'url' => $articles[$i]['url']);
            }
        }

    } else {
        $arr1 = array('id' => "0", 'nom' => "article inconnu", 'prix' => '', 'descFull' => "il semble que vous tentez de visualiser un article inconnu.", 'desc' => 'Article inconnu', 'url' => 'assets/notFound.svg');
    }

    return $arr1;

}

/**
 *  generateCatalogue  fonction qui renvoie le catalogue des articles
 *
 * @return array
 */
function generateCatalogue()
{
    $articles = array(

        array(
            'id' => "1",
            'nom' => 'App shield power !  ',
            'prix' => 599,
            'url' => 'assets/icon-shield-orange.svg',
            'desc' => 'lorem ipsum',
            'descFull' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Reprehenderit laudantium repellat soluta pariatur modi suscipit obcaecati ducimus dolorem accusamus quasi minus, officia incidunt sit vitae asperiores facilis est vero? In.',
            'qts' => '1'),
        array(
            'id' => "2",
            'nom' => "App hub Green ",
            'prix' => 15,
            'url' => 'assets/icon-hub-green.svg',
            'desc' => "App hub Green ",
            'descFull' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Reprehenderit laudantium repellat soluta pariatur modi suscipit obcaecati ducimus dolorem accusamus quasi minus, officia incidunt sit vitae asperiores facilis est vero? In.',
            'qts' => '1'),
        array(
            'id' => "3",
            'nom' => "App hub blue",
            'prix' => 75,
            'url' => 'assets/icon-hub-blue.svg',
            'desc' => "Modèle emblématique",
            'descFull' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Reprehenderit laudantium repellat soluta pariatur modi suscipit obcaecati ducimus dolorem accusamus quasi minus, officia incidunt sit vitae asperiores facilis est vero? In.',
            'qts' => '1'),
        array(
            'id' => "4",
            'nom' => "App Gps gLue",
            'prix' => 90,
            'url' => 'assets/icon-direction-blue.svg',
            'desc' => "Modèle emblématique ",
            'descFull' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Reprehenderit laudantium repellat soluta pariatur modi suscipit obcaecati ducimus dolorem accusamus quasi minus, officia incidunt sit vitae asperiores facilis est vero? In.',
            'qts' => '1'),
    );

    return $articles;

}

/**
 * @param $id  id de l'article selectionné
 *
 *
 */
function getcommentairesByArt($id)
{
    $arr1 = [];
    $coms = getCommentaires();

    if (isExistArticle($id)) {

        foreach ($coms as $value) {
            if (intval($value['id']) == intval($id)) {
                $arr1 = array('id' => $value['id'],
                    'name' => $value['name'],
                    'url_avatar' => $value['url_avatar'],
                    'commentaire' => $value['commentaire'],
                    'stars' => $value['stars']);

            }

        }

    }
    return $arr1;
}

/**
 *
 * @return array     la liste des articles
 */
function getCommentaires()
{
    $com = array(
        1 => array(
            'id' => "1",
            'name' => "myrthe",
            'url_avatar' => "assets/avatar1.png",
            'commentaire' => 'super produit 1!!! ',
            'stars' => '0'
        ),
        2 => array(
            'id' => "1",
            'name' => "Olphat",
            'url_avatar' => "assets/avatar2.png",
            'commentaire' => ' ouais ... super produit 1 ... faut voir. ',
            'stars' => '3'
        ),
        3 => array(
            'id' => "2",
            'name' => "chiita",
            'url_avatar' => "assets/avatar3.png",
            'commentaire' => 'super produit 2!!!',
            'stars' => '2'
        ),
        4 => array(
            'id' => "2",
            'name' => "Tarzan",
            'url_avatar' => "assets/avatar4.png",
            'commentaire' => 'The super produit 2 ! ',
            'stars' => '4'
        ),
        5 => array(
            'id' => "3",
            'name' => "balast",
            'url_avatar' => "assets/avatar3.png",
            'commentaire' => 'super produit 3!!!',
            'stars' => '2'
        ),


    );

    return $com;
}

/**
 *
 * @param $id   id de l'aticle
 * @return bool retourne si existant dans la base ou non
 */
function isExistArticle($id)
{
    $articles = generateCatalogue();
    for ($i = 0; $i < count($articles); $i++) {
        // si nous sommes sur l'article traité
        if ($articles[$i]['id'] == $id) {
            return true;
        }

    }
    return false;

}

/**
 * function Setcolor coté ligne de commande
 * @param $color
 * @return string
 */
function SetColor($color)
{
    switch ($color) {
        case "white" :
            return "\e[1;37m";
        case "red" :
            return "\e[0;31m";

            break;
        case "green" :
            return "\e[0;32m";
            break;
        case "yellow" :
            return "\e[1;33m";
            break;
        case "blue" :
            return "\e[0;34m";
            break;
        case "magenta" :
            return "\e[0;35m";
            break;
    }
    return "\e[1;37";
}