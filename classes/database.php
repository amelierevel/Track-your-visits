<?php

//insertion du fichier configuration
include_once path::getRootPath() . 'configuration.php';

/**
 * création de la classe database parent des autres classes et permettant de se connecter à la base de données MYSQL
 */
class database {
    /*     * Liste des attributs
      Attribut $db en protected pour que toutes les classes enfants y aient accès */

    protected $db;
    private $host;
    private $login;
    private $password;
    private $dbname;

    /**
     * Méthode magique construct
     */
    public function __construct() {
        $this->host = HOST;
        $this->login = LOGIN;
        $this->password = PASSWORD;
        $this->dbname = DBNAME;
    }

    /**
     * Méthode permettant de créer l'instance PDO
     * connexion à la base de données après avoir testé les erreurs avec le try/catch 
     */
    protected function dbConnect() {
        try {
            $this->db = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->dbname . ';charset=UTF8;', $this->login, $this->password);
            //affichage des erreurs SQL
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //affichage d'un message d'erreur
        } catch (Exception $ex) {
            die($ex->getMessage());
        }
    }

    /**
     * Méthode magique destruct
     */
    public function __destruct() {
        $this->db = NULL;
    }

}
