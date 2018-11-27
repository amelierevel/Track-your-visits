<?php

/**
 * Création de la class timetableTypes héritière de database
 */
class timetableTypes extends database {

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
     * Méthode permettant d'afficher la liste des types d'horaires (période horaire)
     * @return type
     */
    public function getTimetableTypesList() {
        //initialisation d'un tableau vide (car fetchAll nous donne un tableau)
        $resultArray = array();
        //déclaration de la requête sql
        $request = 'SELECT `id`,`name` FROM `F396V_timetableTypes`';
        //appel de la requête avec un query que l'on stocke dans l'objet $timetableTypesResult
        $timetableTypesResult = $this->db->query($request);
        //vérification que la requête s'est bien exécutée
        if ($timetableTypesResult->execute()) {
            //on vérifie que $timetableTypesResult est un objet
            if (is_object($timetableTypesResult)) {
                //on stocke le résultat de la requête dans la variable $resultArray
                $resultArray = $timetableTypesResult->fetchAll(PDO::FETCH_OBJ);
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
