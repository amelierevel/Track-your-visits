<?php

/**
 * Création de la class departments héritière de database
 */
class departments extends database {

    //Liste des attributs
    public $id;
    public $department;
    public $code;
    public $idRegions;

    /**
     * Méthode magique construct héritée du parent database
     */
    public function __construct() {
        parent::__construct();
        $this->dbConnect();
    }

    /**
     * Méthode permettant d'afficher la liste des départements
     * @return type
     */
    public function getDepartmentsList() {
        //initialisation d'un tableau vide (car fetchAll nous donne un tableau)
        $resultArray = array();
        //déclaration de la requête sql
        $request = 'SELECT `id`,`department`,`code`,`idRegions` '
                . 'FROM `F396V_departments` '
                . 'ORDER BY `code` ASC';
        //appel de la requête avec un query que l'on stocke dans la variable $departmentsResult
        $departmentsResult = $this->db->query($request);
        //vérification que la requête s'est bien exécutée
        if ($departmentsResult->execute()) {
        //on vérifie que $departmentsResult est un objet
            if (is_object($departmentsResult)) {
                //on stocke le résultat de la requête dans la variable $resultArray
                $resultArray = $departmentsResult->fetchAll(PDO::FETCH_OBJ);
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
