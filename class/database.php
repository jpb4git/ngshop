<?php


/**
 * Class Database
 * gère la connexion à la base de donnée
 *
 */
class Database {
  private $_instance = null;
  private $_LOCAL_DNS = 'mysql:dbname=ngshop;host=localhost';
  private $_LOCAL_USER = 'jpb@localhost';
  private $_LOCAL_PASSWORD ='A-1234-test';
   
  public function __construct() {
    $this->createConnexion();
  }
  private function createConnexion(){
      $pDSN      = $this->_LOCAL_DNS;
      $pUserName = $this->_LOCAL_USER;
      $pPassword = $this->_LOCAL_PASSWORD;
  try {
      $this->_instance = new PDO($this->_LOCAL_DNS,$this->_LOCAL_USER,$this->_LOCAL_PASSWORD);
      $this->_instance->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
      $this->_instance->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
      $this->_instance->setAttribute(PDO::ATTR_EMULATE_PREPARES,false); 
      $this->_instance->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, "SET NAMES 'utf8'");

  }  catch (PDOException $e) {
      echo 'Base de Donnée Non Accessible ... veuillez reéessayer.';
  }
}
/**
 * revoie l'instance de la connexion
 * 
 */
  public function getInstance(){
      return $this->_instance;
  }
  /**
   * renvoie l'etat ok de la connexion
   */
  public function stateObj(){
    print_r("Obj Database Object created with success.<br>");
  }
}