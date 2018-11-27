<?php

/**
 * Création de la class days héritière de database
 */
class days extends database {

    //Liste des attributs
    public $id;
    public $day;

    /**
     * Méthode magique construct héritée du parent database
     */
    public function __construct() {
        parent::__construct();
        $this->dbConnect();
    }

    /**
     * Méthode permettant d'afficher la liste des jours de la semaine
     * @return type
     */
    public function getDaysList() {
        //initialisation d'un tableau vide (car fetchAll nous donne un tableau)
        $resultArray = array();
        //déclaration de la requête sql
        $request = 'SELECT `id`,`day` FROM `F396V_days`';
        //appel de la requête avec un query que l'on stocke dans l'objet $daysResult
        $daysResult = $this->db->query($request);
        //vérification que la requête s'est bien exécutée
        if ($daysResult->execute()) {
            //on vérifie que $daysResult est un objet
            if (is_object($daysResult)) {
                //on stocke le résultat de la requête dans la variable $resultArray
                $resultArray = $daysResult->fetchAll(PDO::FETCH_OBJ);
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
