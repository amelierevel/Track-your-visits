<?php

/**
 * Création de la class regions héritière de database
 */
class regions extends database {

    //Liste des attributs
    public $id;
    public $region;

    /**
     * Méthode magique construct héritée du parent database
     */
    public function __construct() {
        parent::__construct();
        $this->dbConnect();
    }

    /**
     * Méthode permettant d'afficher la liste des régions par ordre alphabétique
     * @return type
     */
    public function getRegionsList() {
        //initialisation d'un tableau vide (car fetchAll nous donne un tableau)
        $resultArray = array();
        //déclaration de la requête sql
        $request = 'SELECT `id`,`region` '
                . 'FROM `F396V_regions` '
                . 'ORDER BY `region` ASC';
        //appel de la requête avec un query que l'on stocke dans l'objet $regionsResult
        $regionsResult = $this->db->query($request);
        //vérification que la requête s'est bien exécutée
        if ($regionsResult->execute()) {
        //on vérifie que $regionsResult est un objet
            if (is_object($regionsResult)) {
                //on stocke le résultat de la requête dans la variable $resultArray
                $resultArray = $regionsResult->fetchAll(PDO::FETCH_OBJ);
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
