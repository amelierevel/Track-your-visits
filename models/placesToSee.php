<?php

/**
 * Création de la class placesToSee héritière de database
 */
class placesToSee extends database {

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
     * Méthode permettant à l'utilisateur d'ajouter un lieu dans ses lieux à voir 
     * @return type
     */
    public function addPlaceToSee() {
        //déclaration de la requête sql
        $request = 'INSERT INTO `F396V_placesToSee`(`idUsers`,`idPlaces`) '
                . 'VALUES (:idUsers, :idPlaces)';
        //appel de la requête avec un prepare (car il y a des marqueurs nominatifs) que l'on stocke dans l'objet $insertPlaceToSee
        $insertPlaceToSee = $this->db->prepare($request);
        //attribution des valeurs aux marqueurs nominatifs avec bindValue (protection contre les injections de sql)
        $insertPlaceToSee->bindValue(':idUsers', $this->idUsers, PDO::PARAM_INT);
        $insertPlaceToSee->bindValue(':idPlaces', $this->idPlaces, PDO::PARAM_INT);
        //vérification que la requête s'est bien exécutée
        if ($insertPlaceToSee->execute()) {
            return $insertPlaceToSee;
        }
    }

    /**
     * Méthode permettant de vérifier que l'utilisateur n'a pas déjà ajouté le lieu dans ses lieux à voir
     * @return type
     */
    public function checkIfPlaceToSeeExist() {
        //initialisation de la variable $state avec la valeur false
        $state = FALSE;
        //déclaration de la requête sql
        $request = 'SELECT COUNT(`id`) AS `count` '
                . 'FROM `F396V_placesToSee` '
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
     * Méthode permettant d'afficher la liste des lieux à voir d'un utilisateur
     * @return type
     */
    public function getPlacesToSeeListByUser() {
        //initialisation d'un tableau vide
        $resultArray = array();
        //déclaration de la requête sql
        $request = 'SELECT `pTs`.`idPlaces`,`pTs`.`id` AS `idPlaceToSee`,'
                . '`pl`.`id`,`pl`.`name`,`pl`.`idCities`, '
                . '`cit`.`city`,`cit`.`postalCode`, '
                . '`cat`.`name` AS `category`, '
                . '`pic`.`picture` '
                . 'FROM `F396V_placesToSee` AS `pTs` '
                . 'INNER JOIN `F396V_places` AS `pl` ON `pTs`.`idPlaces` = `pl`.`id` '
                . 'INNER JOIN `F396V_cities` AS `cit` ON `pl`.`idCities` = `cit`.`id` '
                . 'INNER JOIN `F396V_categories` AS `cat` ON `pl`.`idCategories` = `cat`.`id` '
                . 'LEFT JOIN `F396V_pictures` AS `pic` ON `pic`.`idPlaces` = `pl`.`id` ' //left join car on affiche aussi les lieux sans image
                . 'WHERE `pTs`.`idUsers` = :idUsers';
        //appel de la requête avec un prepare (car il y a un marqueur nominatif) que l'on stocke dans l'objet $placesToSeeList
        $placesToSeeList = $this->db->prepare($request);
        //attribution de la valeur au marqueur nominatif avec bindValue (protection contre les injections de sql)
        $placesToSeeList->bindValue(':idUsers', $this->idUsers, PDO::PARAM_INT);
        //vérification que la requête s'est bien exécutée
        if ($placesToSeeList->execute()) {
            //on vérifie que $placesToSeeList est un objet
            if (is_object($placesToSeeList)) {
                $resultArray = $placesToSeeList->fetchAll(PDO::FETCH_OBJ);
            }
        }
        return $resultArray;
    }

    /**
     * Méthode permettant la suppression d'un lieu de la liste des lieux à voir par l'utilisateur
     * @return boolean
     */
    public function deletePlaceToSee() {
        //initialisation de la variable $state avec la valeur false
        $state = FALSE;
        //déclaration de la requête sql
        $request = 'DELETE FROM `F396V_placesToSee` '
                . 'WHERE `id` = :id';
        //appel de la requête avec un prepare (car il y a un marqueur nominatif) que l'on stocke dans l'objet $deletePlaceToSee
        $deletePlaceToSee = $this->db->prepare($request);
        //attribution de la valeur au marqueur nominatif avec bindValue (protection contre les injections de sql)
        $deletePlaceToSee->bindValue(':id', $this->id, PDO::PARAM_INT);
        //vérification que la requête s'est bien exécutée
        if ($deletePlaceToSee->execute()) {
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
