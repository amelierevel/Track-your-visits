<?php

/**
 * Création de la class cities héritière de database
 */
class cities extends database {

    //Liste des attributs
    public $id;
    public $city;
    public $postalCode;
    public $idDepartments;

    /**
     * Méthode magique construct héritée du parent database
     */
    public function __construct() {
        parent::__construct();
        $this->dbConnect();
    }

    /**
     * Méthode permettant d'afficher la liste des villes
     * @return type
     */
    public function getCitiesList() {
        //initialisation d'un tableau vide (car fetchAll nous donne un tableau)
        $resultArray = array();
        //déclaration de la requête sql
        $request = 'SELECT `id`,`city`,`postalCode`,`idDepartments` '
                . 'FROM `F396V_cities` '
                . 'ORDER BY `city` ASC';
        //appel de la requête avec un query que l'on stocke dans la variable $citiesResult
        $citiesResult = $this->db->query($request);
        //vérification que la requête s'est bien exécutée
        if ($citiesResult->execute()) {
            //on vérifie que $citiesResult est un objet
            if (is_object($citiesResult)) {
                //on stocke le résultat de la requête dans la variable $resultArray
                $resultArray = $citiesResult->fetchAll(PDO::FETCH_OBJ);
            }
        }
        return $resultArray;
    }

    public function getCitiesListByPostalCode() {
         //initialisation d'un tableau vide (car fetchAll nous donne un tableau)
        $resultArray = array();
        $request = 'SELECT `id`,`city`,`postalCode` '
                . 'FROM `F396V_cities` '
                . 'WHERE `postalCode` LIKE :postalCode '
                . 'ORDER BY `city` ASC';
        $citiesResult = $this->db->prepare($request);
        $citiesResult->bindValue(':postalCode', $this->postalCode . '%', PDO::PARAM_STR);
        if($citiesResult->execute()){
            $resultArray = $citiesResult->fetchAll(PDO::FETCH_OBJ);
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
