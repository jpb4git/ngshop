<?php
/**
 * fonctional debug function 
 * met en page le debugging
 */
function jdebug($var){
    highlight_string("<?php\n\$data =\n" . var_export($var, true) . ";\n?>");
}


function RandomString()
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randstring = '';
    for ($i = 0; $i < 10; $i++) {
        $randstring .= $characters[rand(0, strlen($characters))];
    }
    return $randstring;
}

/**
 * @param $devise  String de la device utilisée
 * @return string   la device avec la premiere lettre majuscule
 */
function MajDevise($devise)
{
    return ucfirst($devise);
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

function secureData($data){
    if(is_array($data)){
        $safeData = array_map ( 'htmlspecialchars' , $data );
    }else{
        $safeData =  htmlspecialchars($data);
    }
    return $safeData;
}