<?php

/**
 * Création de la class priceTypes héritière de database
 */
class priceTypes extends database {

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
     * Méthode permettant d'afficher la liste des types de tarifs
     * @return type
     */
    public function getPriceTypesList() {
        //initialisation d'un tableau vide (car fetchAll nous donne un tableau)
        $resultArray = array();
        //déclaration de la requête sql
        $request = 'SELECT `id`,`name` FROM `F396V_priceTypes`';
        //appel de la requête avec un query que l'on stocke dans l'objet $priceTypesResult
        $priceTypesResult = $this->db->query($request);
        //vérification que la requête s'est bien exécutée
        if ($priceTypesResult->execute()) {
            //on vérifie que $priceTypesResult est un objet
            if (is_object($priceTypesResult)) {
                //on stocke le résultat de la requête dans la variable $resultArray
                $resultArray = $priceTypesResult->fetchAll(PDO::FETCH_OBJ);
            }
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
