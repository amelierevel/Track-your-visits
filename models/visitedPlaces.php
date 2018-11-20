<?php

/**
 * Création de la class visitedPlaces héritière de database
 */
class visitedPlaces extends database {

    //Liste des attributs
    public $id;
    public $idUsers;
    public $idPlaces;

    /**
     * Méthode magique construct héritière du parent database
     */
    public function __construct() {
        parent::__construct();
        $this->dbConnect();
    }

    /**
     * Méthode permettant à l'utilisateur d'ajouter un lieu dans ses lieux visités
     * @return type
     */
    public function addVisitedPlace() {
        //déclaration de la requête sql
        $request = 'INSERT INTO `F396V_visitedPlaces`(`idUsers`,`idPlaces`) '
                . 'VALUES (:idUsers, :idPlaces)';
        //appel de la requête avec un prepare (car il y a des marqueurs nominatifs) que l'on stocke dans l'objet $insertVisitedPlace
        $insertVisitedPlace = $this->db->prepare($request);
        //attribution des valeurs aux marqueurs nominatifs avec bindValue (protection contre les injections de sql)
        $insertVisitedPlace->bindValue(':idUsers', $this->idUsers, PDO::PARAM_INT);
        $insertVisitedPlace->bindValue(':idPlaces', $this->idPlaces, PDO::PARAM_INT);
        //vérification que la requête s'est bien exécutée
        if ($insertVisitedPlace->execute()) {
            return $insertVisitedPlace;
        }
    }

    /**
     * Méthode permettant de vérifier que l'utilisateur n'a pas déjà ajouté le lieu dans ses lieux visités
     * @return type
     */
    public function checkIfVisitedPlaceExist() {
        //initialisation de la variable $state avec la valeur false
        $state = FALSE;
        //déclaration de la requête sql
        $request = 'SELECT COUNT(`id`) AS `count` '
                . 'FROM `F396V_visitedPlaces` '
                . 'WHERE `idUsers` = :idUsers AND `idPlaces` = :idPlaces';
        //appel de la requête avec un prepare (car il y a des marqueurs nominatifs) que l'on stocke dans l'objet $result
        $result = $this->db->prepare($request);
        //attribution des valeurs aux marqueurs nominatifs avec bindValue (protection contre les injections de sql)
        $result->bindValue(':idUsers', $this->idUsers, PDO::PARAM_INT);
        $result->bindValue(':idPlaces', $this->idPlaces, PDO::PARAM_INT);
        //vérification que la requête s'est bien exécutée
        if ($result->execute()) {
            $selectResult = $result->fetch(PDO::FETCH_OBJ);
            //attribution du résultat du count (0 ou 1) à la variable $state
            $state = $selectResult->count;
        }
        return $state;
    }

    /**
     * Méthode permettant d'afficher la liste des lieux visités d'un utilisateur
     * @return type
     */
    public function getVisitedPlacesListByUser() {
        //initialisation d'un tableau vide
        $resultArray = array();
        //déclaration de la requête sql
        $request = 'SELECT `vPl`.`idPlaces`,`vPl`.`id` AS `idVisitedPlace`,'
                . '`pl`.`id`,`pl`.`name`,`pl`.`idCities`, '
                . '`cit`.`city`,`cit`.`postalCode`, '
                . '`cat`.`name` AS `category` '
                . 'FROM `F396V_visitedPlaces` AS `vPl` '
                . 'LEFT JOIN `F396V_places` AS `pl` ON `vPl`.`idPlaces` = `pl`.`id` '
                . 'LEFT JOIN `F396V_cities` AS `cit` ON `pl`.`idCities` = `cit`.`id` '
                . 'LEFT JOIN `F396V_categories` AS `cat` ON `pl`.`idCategories` = `cat`.`id` '
                . 'WHERE `vPl`.`idUsers` = :idUsers';
        //appel de la requête avec un prepare (car il y a un marqueur nominatif) que l'on stocke dans l'objet $visitedPlacesList
        $visitedPlacesList = $this->db->prepare($request);
        //attribution de la valeur au marqueur nominatif avec bindValue (protection contre les injections de sql)
        $visitedPlacesList->bindValue(':idUsers', $this->idUsers, PDO::PARAM_INT);
        //vérification que la requête s'est bien exécutée
        if ($visitedPlacesList->execute()) {
            //on vérifie que $visitedPlacesList est un objet
            if (is_object($visitedPlacesList)) {
                $resultArray = $visitedPlacesList->fetchAll(PDO::FETCH_OBJ);
            }
        }
        return $resultArray;
    }

    /**
     * Méthode permettant la suppression d'un lieu de la liste des lieux visités par l'utilisateur
     * @return boolean
     */
    public function deleteVisitedPlaces() {
        //initialisation de la variable $state avec la valeur false
        $state = FALSE;
        //déclaration de la requête sql
        $request = 'DELETE FROM `F396V_visitedPlaces` '
                . 'WHERE `id` = :id';
        //appel de la requête avec un prepare (car il y a un marqueur nominatif) que l'on stocke dans l'objet $deleteVisitedPlace
        $deleteVisitedPlace = $this->db->prepare($request);
        //attribution de la valeur au marqueur nominatif avec bindValue (protection contre les injections de sql)
        $deleteVisitedPlace->bindValue(':id', $this->id, PDO::PARAM_INT);
        //vérification que la requête s'est bien exécutée
        if ($deleteVisitedPlace->execute()) {
            $state = TRUE;
        }
        return $state;
    }

    /**
     * Méthode magique destruct héritière du parent database
     */
    public function __destruct() {
        parent::__destruct();
        $this->dbConnect();
    }

}
