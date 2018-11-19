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
     * Méthode magique destruct héritière du parent database
     */
    public function __destruct() {
        parent::__destruct();
        $this->dbConnect();
    }

}
