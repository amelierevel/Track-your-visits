<?php

/**
 * Création de la class timetables héritière de database
 */
class timetables extends database {

    //Liste des attributs
    public $id;
    public $opening;
    public $closing;
    public $idDays;
    public $idPlaces;
    public $idTimetableTypes;
    public $editDate;

    /**
     * Méthode magique construct héritée du parent database
     */
    public function __construct() {
        parent::__construct();
        $this->dbConnect();
    }

    /**
     * Méthode permettant d'ajouter un nouvel horaire
     * @return type
     */
    public function addTimetable() {
        //déclaration de la requête sql
        $request = 'INSERT INTO `F396V_timetables`(`opening`,`closing`,`idDays`,`idPlaces`,`idTimetableTypes`,`editDate`) '
                . 'VALUES (:opening, :closing, :idDays, :idPlaces, :idTimetableTypes, :editDate)';
        //appel de la requête avec un prepare (car il y a des marqueurs nominatifs) que l'on stocke dans la variable $insertTimetable
        $insertTimetable = $this->db->prepare($request);
        //attribution des valeurs aux marqueurs nominatifs avec bindValue (protection contre les injections de sql)
        $insertTimetable->bindValue(':opening', $this->opening, PDO::PARAM_STR);
        $insertTimetable->bindValue(':closing', $this->closing, PDO::PARAM_STR);
        $insertTimetable->bindValue(':idDays', $this->idDays, PDO::PARAM_INT);
        $insertTimetable->bindValue(':idPlaces', $this->idPlaces, PDO::PARAM_INT);
        $insertTimetable->bindValue(':idTimetableTypes', $this->idTimetableTypes, PDO::PARAM_INT);
        $insertTimetable->bindValue(':editDate', $this->editDate, PDO::PARAM_STR);
        //vérification que la requête s'est bien exécutée
        if ($insertTimetable->execute()) {
            return $insertTimetable;
        }
    }

    /**
     * Méthode permettant de vérifier qu'un horaire n'existe pas déjà pour proposer à l'utilisateur de la modifier si elle existe
     * @return type
     */
    public function checkIfTimetableExist() {
        //initialisation de la variable $state avec la valeur false
        $state = FALSE;
        //déclaration de la requête sql
        $request = 'SELECT COUNT(`id`) AS `count` '
                . 'FROM `F396V_timetables` '
                . 'WHERE `idPlaces` = :idPlaces AND `idDays` = :idDays AND `idTimetableTypes` = :idTimetableTypes';
        //appel de la requête avec un prepare (car il y a des marqueurs nominatifs) que l'on stocke dans la variable $result
        $result = $this->db->prepare($request);
        //attribution des valeurs aux marqueurs nominatifs avec bindValue (protection contre les injections de sql)
        $result->bindValue(':idPlaces', $this->idPlaces, PDO::PARAM_INT);
        $result->bindValue(':idDays', $this->idDays, PDO::PARAM_INT);
        $result->bindValue(':idTimetableTypes', $this->idTimetableTypes, PDO::PARAM_INT);
        //vérification que la requête s'est bien exécutée
        if ($result->execute()) {
            $selectResult = $result->fetch(PDO::FETCH_OBJ);
            //attribution du résultat du count (0 ou 1) à la variable $state
            $state = $selectResult->count;
        }
        return $state;
    }

    /**
     * Méthode magique destruct héritée du parent database
     */
    public function __destruct() {
        parent::__destruct();
        $this->dbConnect();
    }

}
