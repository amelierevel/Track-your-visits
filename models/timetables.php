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
        //appel de la requête avec un prepare (car il y a des marqueurs nominatifs) que l'on stocke dans l'objet $insertTimetable
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
     * Méthode permettant de vérifier qu'un horaire n'existe pas déjà pour un lieu
     * @return type
     */
    public function checkIfTimetableExist() {
        //initialisation de la variable $state avec la valeur false
        $state = FALSE;
        //déclaration de la requête sql
        $request = 'SELECT COUNT(`id`) AS `count` '
                . 'FROM `F396V_timetables` '
                . 'WHERE `idPlaces` = :idPlaces AND `idDays` = :idDays AND `idTimetableTypes` = :idTimetableTypes';
        //appel de la requête avec un prepare (car il y a des marqueurs nominatifs) que l'on stocke dans l'objet $result
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
     * Méthode permettant d'afficher la liste des horaires d'un lieu par ordre alphabétique
     * @return type
     */
    public function getTimetablesList() {
        //initialisation d'un tableau vide
        $resultArray = array();
        //déclaration de la requête sql
        $request = 'SELECT `tim`.`id`,DATE_FORMAT(`tim`.`opening`, \'%Hh%i\') AS `opening`,DATE_FORMAT(`tim`.`closing`, \'%Hh%i\') AS `closing`, '
                . '`tim`.`idDays`,`tim`.`idPlaces`,`tim`.`idTimetableTypes`,DATE_FORMAT(`tim`.`editDate`, \'%d/%m/%Y\') AS `editDate`, '
                . '`timT`.`name` AS `period`, '
                . '`d`.`day` '
                . 'FROM `F396V_timetables` AS `tim` '
                . 'LEFT JOIN `F396V_timetableTypes` AS `timT` ON `tim`.`idTimetableTypes` = `timT`.`id` '
                . 'LEFT JOIN `F396V_days` AS `d` ON `tim`.`idDays` = `d`.`id` '
                . 'LEFT JOIN `F396V_places` AS `pl` ON `tim`.`idPlaces` = `pl`.`id` '
                . 'WHERE `pl`.`id` = :id '
                . 'ORDER BY `tim`.`idDays` ASC';
        //appel de la requête avec un prepare (car il y a un marqueur nominatif) que l'on stocke dans l'objet $timetableList
        $timetableList = $this->db->prepare($request);
        //attribution de la valeur au marqueur nominatif avec bindValue (protection contre les injections de sql)
        $timetableList->bindValue(':id', $this->id, PDO::PARAM_INT);
        //vérification que la requête s'est bien exécutée
        if ($timetableList->execute()) {
            //vérification qu'il s'agit bien d'un objet
            if (is_object($timetableList)) {
                $resultArray = $timetableList->fetchAll(PDO::FETCH_OBJ);
            }
        }
        return $resultArray;
    }

    /**
     * Méthode permettant de modifier un horaire
     * @return type
     */
    public function updateTimetable() {
        //déclaration de la requête sql
        $request = 'UPDATE `F396V_timetables` '
                . 'SET `idDays` = :idDays,`idTimetableTypes` = :idTimetableTypes, `opening` = :opening, `closing` = :closing, `editDate` = :editDate '
                . 'WHERE `id` = :id';
        //appel de la requête avec un prepare (car il y a des marqueurs nominatifs) que l'on stocke dans l'objet $updateTimetable
        $updateTimetable = $this->db->prepare($request);
        //attribution des valeurs aux marqueurs nominatifs avec bindValue (protection contre les injections de sql)
        $updateTimetable->bindValue(':idDays', $this->idDays, PDO::PARAM_INT);
        $updateTimetable->bindValue(':idTimetableTypes', $this->idTimetableTypes, PDO::PARAM_INT);
        $updateTimetable->bindValue(':opening', $this->opening, PDO::PARAM_STR);
        $updateTimetable->bindValue(':closing', $this->closing, PDO::PARAM_STR);
        $updateTimetable->bindValue(':editDate', $this->editDate, PDO::PARAM_STR);
        //vérification que la requête s'est bien exécutée
        if ($updateTimetable->execute()) {
            //vérification qu'il s'agit bien d'un objet
            if (is_object($updateTimetable)) {
                return $updateTimetable;
            }
        }
    }

    /**
     * Méthode permettant la suppression d'un horaire
     * @return boolean 
     */
    public function deleteTimetable() {
        //initialisation de la variable $state avec la valeur false
        $state = FALSE;
        //déclaration de la requête sql
        $request = 'DELETE FROM `F396V_timetables` '
                . 'WHERE `id` = :id';
        //appel de la requête avec un prepare (car il y a un marqueur nominatif) que l'on stocke dans l'objet $deleteTimetable
        $deleteTimetable = $this->db->prepare($request);
        //attribution de la valeur au marqueur nominatif avec bindValue (protection contre les injections de sql)
        $deleteTimetable->bindValue(':id', $this->id, PDO::PARAM_INT);
        //vérification que la requête s'est bien exécutée
        if ($deleteTimetable->execute()) {
            $state = TRUE;
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
