<?php
/**
 * createConnexion   :connexion à la base de donnée
 *
 *  return   une instance de la connexion à la base de donnée.
 */
function createConnexion()
{
    //$instance = null;
    $_LOCAL_DNS = 'mysql:dbname=ngshop;host=localhost';
    $_LOCAL_USER = 'jpb@localhost';
    $_LOCAL_PASSWORD = 'A-1234-test';
    try {
        $instance = new PDO($_LOCAL_DNS, $_LOCAL_USER, $_LOCAL_PASSWORD);
        $instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $instance->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $instance->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $instance->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, "SET NAMES 'utf8'");


    } catch (PDOException $e) {
        echo 'Base de Données Non Accessible ... veuillez reéessayer.';
    }
    return $instance;
}
