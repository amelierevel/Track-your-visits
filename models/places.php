<?php

class places extends database {

    //Liste des attributs
    public $id;
    public $name;
    public $address;
    public $phone;
    public $mail;
    public $website;
    public $description;
    public $createDate;
    public $idCategories;
    public $idCities;

    /**
     * Méthode magique construct héritière du parent database
     */
    public function __construct() {
        parent::__construct();
        $this->dbConnect();
    }

    /**
     * Méthode permettant d'ajouter un nouvel site touristique
     * @return type
     */
    public function addPlace() {
        //déclaration de la requête sql
        $request = 'INSERT INTO `F396V_places`(`name`,`address`,`phone`,`mail`,`website`,`description`,`createDate`,`idCategories`,`idCities`) '
                . 'VALUES (:name, :address, :phone, :mail, :website, :description, :createDate, :idCategories, :idCities)';
        //appel de la requête avec un prepare (car il y a des marqueurs nominatifs) que l'on stocke dans la variable $insertPlace
        $insertPlace = $this->db->prepare($request);
        //attribution des valeurs aux marqueurs nominatifs avec bindValue (protection contre les injections de sql)
        $insertPlace->bindValue(':name', $this->name, PDO::PARAM_STR);
        $insertPlace->bindValue(':address', $this->address, PDO::PARAM_STR);
        $insertPlace->bindValue(':phone', $this->phone, PDO::PARAM_STR);
        $insertPlace->bindValue(':mail', $this->mail, PDO::PARAM_STR);
        $insertPlace->bindValue(':website', $this->website, PDO::PARAM_STR);
        $insertPlace->bindValue(':description', $this->description, PDO::PARAM_STR);
        $insertPlace->bindValue(':createDate', $this->createDate, PDO::PARAM_STR);
        $insertPlace->bindValue(':idCategories', $this->idCategories, PDO::PARAM_STR);
        $insertPlace->bindValue(':idCities', $this->idCities, PDO::PARAM_STR);
        //vérification que la requête s'est bien exécutée
        if ($insertPlace->execute()) {
            return $insertPlace;
        }
    }

    /**
     * Méthode permettant de vérifier qu'un lieu n'existe pas déjà
     * @return type
     */
    public function checkIfPlaceExist() {
        //initialisation de la variable $state avec la valeur false
        $state = FALSE;
        //déclaration de la requête sql
        $request = 'SELECT COUNT(`id`) AS `count` '
                . 'FROM `F396V_places` '
                . 'WHERE `name` = :name AND `address` = :address AND `idCities` = :idCities';
        //appel de la requête avec un prepare (car il y a un marqueur nominatif) que l'on stocke dans la variable $result
        $result = $this->db->prepare($request);
        //attribution des valeurs aux marqueurs nominatifs avec bindValue (protection contre les injections de sql)
        $result->bindValue(':name', $this->name, PDO::PARAM_STR);
        $result->bindValue(':address', $this->address, PDO::PARAM_STR);
        $result->bindValue(':idCities', $this->idCities, PDO::PARAM_INT);
        //vérification que la requête s'est bien exécutée
        if ($result->execute()) {
            $selectResult = $result->fetch(PDO::FETCH_OBJ);
            //attribution du résultat du count (0 ou 1) à la variable $state
            $state = $selectResult->count;
        }
        return $state;
    }

    public function getPlacesList() {
        $resultArray = array();
        $request = 'SELECT `id`,`name`,`address`,`phone`,`mail`,`website`,`description`,`createDate`,`idCategories`,`idCities` '
                . 'FROM `F396V_places`';
        $placesList = $this->db->query($request);
        if ($placesList->execute()) {
            if (is_object($placesList)) {
                $resultArray = $placesList->fetchAll(PDO::FETCH_OBJ);
            }
        }
        return $resultArray;
    }

    /**
     * Méthode permettant d'afficher toutes les données d'un site touristique
     * @return type
     */
    public function getPlaceById() {
        $request = 'SELECT `id`,`name`,`address`,`phone`,`mail`,`website`,`description`,`createDate`,`idCategories`,`idCities` '
                . 'FROM `F396V_places` '
                . 'WHERE `id` = :id';
        $infoPlace = $this->db->prepare($request);
        $infoPlace->bindValue(':id', $this->id, PDO::PARAM_INT);
        if ($infoPlace->execute()) {
            if (is_object($infoPlace)) {
                $result = $infoPlace->fetch(PDO::FETCH_OBJ);
            }
        }
        return $result;
    }

    public function getLastInsertIdPlace() {
        $request = 'SELECT LAST_INSERT_ID() AS `id` '
                . 'FROM `F396V_places`';
        $lastId = $this->db->query($request);
        if ($lastId->execute()) {
            if (is_object($lastId)) {
                $result = $lastId->fetch(PDO::FETCH_OBJ);
            }
        }
        return $result;
    }

    /**
     * Méthode magique destruct héritière du parent database
     */
    public function __destruct() {
        parent::__destruct();
        $this->dbConnect();
    }

}
