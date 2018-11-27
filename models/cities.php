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
     * Méthode permettant d'afficher la liste des villes en fonction du code postal
     * @return type
     */
    public function getCitiesListByPostalCode() {
        //initialisation d'un tableau vide (car fetchAll nous donne un tableau)
        $resultArray = array();
        //déclaration de la requête sql
        $request = 'SELECT `id`,`city`,`postalCode` '
                . 'FROM `F396V_cities` '
                . 'WHERE `postalCode` LIKE :postalCode '
                . 'ORDER BY `city` ASC';
        //appel de la requête avec un prepare (car il y a un marqueur nominatif) que l'on stocke dans l'objet $citiesResult
        $citiesResult = $this->db->prepare($request);
        //attribution de la valeur au marqueur nominatif avec bindValue (protection contre les injections de sql)
        $citiesResult->bindValue(':postalCode', $this->postalCode . '%', PDO::PARAM_STR);
        //vérification que la requête s'est bien exécutée
        if ($citiesResult->execute()) {
            //on stocke le résultat de la requête dans la variable $resultArray
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
