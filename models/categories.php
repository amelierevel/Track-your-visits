<?php

/**
 * Création de la class categories héritière de database
 */
class categories extends database {

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
     * Méthode permettant d'afficher la liste des catégories de sites touristiques
     * @return type
     */
    public function getCategories() {
        //initialisation d'un tableau vide
        $resultArray = array();
        //déclaration de la requête sql
        $request = 'SELECT `id`,`name` FROM `F396V_categories`';
        //appel de la requête avec un query que l'on stocke dans la variable $categoriesResult
        $categoriesResult = $this->db->query($request);
        //on vérifie que $categoriesResult est un objet
        if (is_object($categoriesResult)) {
            $resultArray = $categoriesResult->fetchAll(PDO::FETCH_OBJ);
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
