<?php

/**
 * Création de la class userTypes héritière de database
 */
class userTypes extends database {

    //Liste des attributs
    public $id;
    public $name;

    /**
     * Méthode magique construct héritée du parent database
     */
    public function __construct() {
        parent::__construct();
        $this->dbConnect();
    }

    /**
     * Méthode permettant d'afficher la liste des types d'utilisateur
     * @return type
     */
    public function getUserType() {
        //initialisation d'un tableau vide (car fetchAll nous donne un tableau)
        $resultArray = array();
        //déclaration de la requête sql
        $request = 'SELECT `id`,`name` FROM `F396V_userTypes`';
        //appel de la requête avec un query que l'on stocke dans la variable $userTypeResult
        $userTypeResult = $this->db->query($request);
        //on vérifie que $userTypeResult est un objet
        if (is_object($userTypeResult)) {
            //on stocke le résultat de la requête dans la variable $resultArray
            $resultArray = $userTypeResult->fetchAll(PDO::FETCH_OBJ);
        }
        return $resultArray;
    }

    /**
     * Méthode magique destruct héritée du parent database
     */
    public function __destruct() {
        parent::__destruct();
        $this->dbConnect();
    }

}
