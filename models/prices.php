<?php

/**
 * Création de la class prices héritière de database
 */
class prices extends database {

    //Liste des attributs
    public $id;
    public $price;
    public $name;
    public $idPlaces;
    public $idPriceTypes;
    public $editDatePrices;

    /**
     * Méthode magique construct héritée du parent database
     */
    public function __construct() {
        parent::__construct();
        $this->dbConnect();
    }

    /**
     * Méthode permettant d'ajouter un tarif à un lieu
     * @return type
     */
    public function addPrices() {
        //déclaration de la requête sql
        $request = 'INSERT INTO `F396V_prices`(`price`,`name`,`idPlaces`,`idPriceTypes`,`editDatePrices`) '
                . 'VALUES (:price, :name, :idPlaces, :idPriceTypes, :editDatePrices)';
        //appel de la requête avec un prepare (car il y a des marqueurs nominatifs) que l'on stocke dans l'objet $insertPrice
        $insertPrice = $this->db->prepare($request);
        //attribution des valeurs aux marqueurs nominatifs avec bindValue (protection contre les injections de sql)
        $insertPrice->bindValue(':price', $this->price, PDO::PARAM_STR);
        $insertPrice->bindValue(':name', $this->name, PDO::PARAM_STR);
        $insertPrice->bindValue(':idPlaces', $this->idPlaces, PDO::PARAM_INT);
        $insertPrice->bindValue(':idPriceTypes', $this->idPriceTypes, PDO::PARAM_INT);
        $insertPrice->bindValue(':editDatePrices', $this->editDatePrices, PDO::PARAM_STR);
        //vérification que la requête s'est bien exécutée
        if ($insertPrice->execute()) {
            return $insertPrice;
        }
    }

    /**
     * Méthode permettant de vérifier qu'un tarif n'existe pas déjà pour un lieu
     * @return type
     */
    public function checkIfPriceExist() {
        //initialisation de la variable $state avec la valeur false
        $state = FALSE;
        //déclaration de la requête sql
        $request = 'SELECT COUNT(`id`) AS `count` '
                . 'FROM `F396V_prices` '
                . 'WHERE `idPriceTypes` = :idPriceTypes AND `idPlaces` = :idPlaces';
        //appel de la requête avec un prepare (car il y a des marqueurs nominatifs) que l'on stocke dans l'objet $result
        $result = $this->db->prepare($request);
        //attribution des valeurs aux marqueurs nominatifs avec bindValue (protection contre les injections de sql)
        $result->bindValue(':idPriceTypes', $this->idPriceTypes, PDO::PARAM_INT);
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
     * Méthode permettant d'afficher la liste des tarifs d'un lieu
     * @return type
     */
    public function getPricesList() {
        //initialisation d'un tableau vide
        $resultArray = array();
        //déclaration de la requête sql
        $request = 'SELECT `pr`.`id`,`pr`.`price`,`pr`.`name`,`pr`.`idPlaces`,`pr`.`idPriceTypes`,DATE_FORMAT(`pr`.`editDatePrices`, \'%d/%m/%Y\') AS `editDatePrices`, '
                . '`prT`.`name` AS `priceType` '
                . 'FROM `F396V_prices` AS `pr` '
                . 'LEFT JOIN `F396V_priceTypes` AS `prT` ON `pr`.`idPriceTypes` = `prT`.`id` '
                . 'LEFT JOIN `F396V_places` AS `pl` ON `pr`.`idPlaces` = `pl`.`id` '
                . 'WHERE `pl`.`id` = :id '
                . 'ORDER BY `prT`.`name` ASC';
        //appel de la requête avec un prepare (car il y a un marqueur nominatif) que l'on stocke dans l'objet $pricesList
        $pricesList = $this->db->prepare($request);
        //attribution de la valeur au marqueur nominatif avec bindValue (protection contre les injections de sql)
        $pricesList->bindValue(':id', $this->id, PDO::PARAM_INT);
        //vérification que la requête s'est bien exécutée
        if ($pricesList->execute()) {
            //vérification qu'il s'agit bien d'un objet
            if (is_object($pricesList)) {
                $resultArray = $pricesList->fetchAll(PDO::FETCH_OBJ);
            }
        }
        return $resultArray;
    }

    /**
     * Méthode permettant la suppression d'un tarif
     * @return boolean
     */
    public function deletePrice() {
        //initialisation de la variable $state avec la valeur false
        $state = FALSE;
        //déclaration de la requête sql
        $request = 'DELETE FROM `F396V_prices` '
                . 'WHERE `id` = :id';
        //appel de la requête avec un prepare (car il y a un marqueur nominatif) que l'on stocke dans l'objet $deletePrice
        $deletePrice = $this->db->prepare($request);
        //attribution de la valeur au marqueur nominatif avec bindValue (protection contre les injections de sql)
        $deletePrice->bindValue(':id', $this->id, PDO::PARAM_INT);
        //vérification que la requête s'est bien exécutée
        if ($deletePrice->execute()) {
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
