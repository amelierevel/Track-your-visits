<?php

/**
 * Création de la class places héritière de database
 */
class places extends database {

    //Liste des attributs
    public $id;
    public $name;
    public $address;
    public $phone;
    public $mail;
    public $website;
    public $description;
    public $createDate;
    public $idCategories;
    public $idCities;

    /**
     * Méthode magique construct héritière du parent database
     */
    public function __construct() {
        parent::__construct();
        $this->dbConnect();
    }

    /**
     * Méthode permettant d'ajouter un nouveau lieu
     * @return type
     */
    public function addPlace() {
        //déclaration de la requête sql
        $request = 'INSERT INTO `F396V_places`(`name`,`address`,`phone`,`mail`,`website`,`description`,`createDate`,`idCategories`,`idCities`) '
                . 'VALUES (:name, :address, :phone, :mail, :website, :description, :createDate, :idCategories, :idCities)';
        //appel de la requête avec un prepare (car il y a des marqueurs nominatifs) que l'on stocke dans l'objet $insertPlace
        $insertPlace = $this->db->prepare($request);
        //attribution des valeurs aux marqueurs nominatifs avec bindValue (protection contre les injections de sql)
        $insertPlace->bindValue(':name', $this->name, PDO::PARAM_STR);
        $insertPlace->bindValue(':address', $this->address, PDO::PARAM_STR);
        $insertPlace->bindValue(':phone', $this->phone, PDO::PARAM_STR);
        $insertPlace->bindValue(':mail', $this->mail, PDO::PARAM_STR);
        $insertPlace->bindValue(':website', $this->website, PDO::PARAM_STR);
        $insertPlace->bindValue(':description', $this->description, PDO::PARAM_STR);
        $insertPlace->bindValue(':createDate', $this->createDate, PDO::PARAM_STR);
        $insertPlace->bindValue(':idCategories', $this->idCategories, PDO::PARAM_STR);
        $insertPlace->bindValue(':idCities', $this->idCities, PDO::PARAM_STR);
        //vérification que la requête s'est bien exécutée
        if ($insertPlace->execute()) {
            return $insertPlace;
        }
    }

    /**
     * Méthode permettant de vérifier qu'un lieu n'existe pas déjà
     * @return type
     */
    public function checkIfPlaceExist() {
        //initialisation de la variable $state avec la valeur false
        $state = FALSE;
        //déclaration de la requête sql
        $request = 'SELECT COUNT(`id`) AS `count` '
                . 'FROM `F396V_places` '
                . 'WHERE `name` = :name AND `address` = :address AND `idCities` = :idCities';
        //appel de la requête avec un prepare (car il y a des marqueurs nominatifs) que l'on stocke dans l'objet $result
        $result = $this->db->prepare($request);
        //attribution des valeurs aux marqueurs nominatifs avec bindValue (protection contre les injections de sql)
        $result->bindValue(':name', $this->name, PDO::PARAM_STR);
        $result->bindValue(':address', $this->address, PDO::PARAM_STR);
        $result->bindValue(':idCities', $this->idCities, PDO::PARAM_INT);
        //vérification que la requête s'est bien exécutée
        if ($result->execute()) {
            $selectResult = $result->fetch(PDO::FETCH_OBJ);
            //attribution du résultat du count (0 ou 1) à la variable $state
            $state = $selectResult->count;
        }
        return $state;
    }

    /**
     * Méthode permettant l'affichage de la liste des lieux
     * @return type
     */
    public function getPlacesList() {
        //initialisation d'un tableau vide
        $resultArray = array();
        //déclaration de la requête sql
        $request = 'SELECT `pl`.`id`,`pl`.`name`,`pl`.`address`,`pl`.`phone`,`pl`.`mail`,`pl`.`website`,`pl`.`description`,`pl`.`createDate`,`pl`.`idCategories`,`pl`.`idCities`, '
                . '`cit`.`city`,`cit`.`postalCode`, '
                . '`cat`.`name` AS `category` '
                . 'FROM `F396V_places` AS `pl` '
                . 'LEFT JOIN `F396V_cities` AS `cit` ON `pl`.`idCities` = `cit`.`id` '
                . 'LEFT JOIN `F396V_categories` AS `cat` ON `pl`.`idCategories` = `cat`.`id`';
        //appel de la requête avec un query que l'on stocke dans l'objet $placesList
        $placesList = $this->db->query($request);
        //vérification que la requête s'est bien exécutée
        if ($placesList->execute()) {
            //on vérifie que $placesList est un objet
            if (is_object($placesList)) {
                $resultArray = $placesList->fetchAll(PDO::FETCH_OBJ);
            }
        }
        return $resultArray;
    }

    /**
     * Méthode permettant d'afficher toutes les données d'un lieu
     * @return type
     */
    public function getPlaceById() {
        //initialisation de la variable $result avec la valeur false
        $result = FALSE;
        //déclaration de la requête sql
        $request = 'SELECT `pl`.`id`,`pl`.`name`,`pl`.`address`,`pl`.`phone`,`pl`.`mail`,`pl`.`website`,`pl`.`description`,`pl`.`createDate`,`pl`.`idCategories`,`pl`.`idCities`, '
                . '`cit`.`city`,`cit`.`postalCode`, '
                . '`cat`.`name` AS `category` '
                . 'FROM `F396V_places` AS `pl` '
                . 'LEFT JOIN `F396V_cities` AS `cit` ON `pl`.`idCities` = `cit`.`id` '
                . 'LEFT JOIN `F396V_categories` AS `cat` ON `pl`.`idCategories` = `cat`.`id` '
                . 'WHERE `pl`.`id` = :id';
        //appel de la requête avec un prepare (car il y a un marqueur nominatif) que l'on stocke dans l'objet $infoPlace
        $infoPlace = $this->db->prepare($request);
        //attribution de la valeur au marqueur nominatif avec bindValue (protection contre les injections de sql)
        $infoPlace->bindValue(':id', $this->id, PDO::PARAM_INT);
        //vérification que la requête s'est bien exécutée
        if ($infoPlace->execute()) {
            //vérification qu'il s'agit bien d'un objet
            if (is_object($infoPlace)) {
                $result = $infoPlace->fetch(PDO::FETCH_OBJ);
            }
        }
        return $result;
    }

    /**
     * Méthode permettant de récupérer le dernier id inséré pour faire les liens vers l'ajout des horaires et des tarifs
     * @return type
     */
    public function getLastInsertIdPlace() {
        //déclaration de la requête sql
        $request = 'SELECT MAX(`id`) AS `id`'
                . 'FROM `F396V_places`';
        //appel de la requête avec un query que l'on stocke dans l'objet $lastId
        $lastId = $this->db->query($request);
        //vérification que la requête s'est bien exécutée
        if ($lastId->execute()) {
            //on vérifie que $lastId est un objet
            if (is_object($lastId)) {
                $result = $lastId->fetch(PDO::FETCH_OBJ);
            }
        }
        return $result;
    }

    /**
     * Méthode permettant de compter le nombre de lieux
     * @return type
     */
    public function countPlaces() {
        //initialisation de la variable $result avec la valeur false
        $result = FALSE;
        //déclaration de la requête sql
        $request = 'SELECT COUNT(`id`) AS `placesNumber` '
                . 'FROM `F396V_places`';
        //appel de la requête avec un query que l'on stocke dans l'objet PDO $placesCount
        $placesCount = $this->db->query($request);
        //vérification que la requête s'est bien exécutée
        if ($placesCount->execute()) {
            //on vérifie que $placesCount est un objet
            if (is_object($placesCount)) {
                $result = $placesCount->fetch(PDO::FETCH_OBJ);
            }
        }
        return $result;
    }

    /**
     * Méthode permettant la pagination pour l'affichage des lieux
     * @param type $limit
     * @param type $offset
     * @return boolean
     */
    public function pagingPlaces($limit, $offset) {
        //initialisation d'un tableau vide
        $resultPaging = array();
        //déclaration de la requête sql
        $request = 'SELECT `pl`.`id`,`pl`.`name`,`pl`.`address`,`pl`.`phone`,`pl`.`mail`,`pl`.`website`,`pl`.`description`,`pl`.`createDate`,`pl`.`idCategories`,`pl`.`idCities`, '
                . '`cit`.`city`,`cit`.`postalCode`, '
                . '`cat`.`name` AS `category` '
                . 'FROM `F396V_places` AS `pl` '
                . 'LEFT JOIN `F396V_cities` AS `cit` ON `pl`.`idCities` = `cit`.`id` '
                . 'LEFT JOIN `F396V_categories` AS `cat` ON `pl`.`idCategories` = `cat`.`id` '
                . 'ORDER BY `pl`.`name` ASC '
                . 'LIMIT :limit OFFSET :offset ';
        //appel de la requête avec un prepare (car il y a des marqueurs nominatifs) que l'on stocke dans l'objet $placesPaging
        $placesPaging = $this->db->prepare($request);
        //attribution des valeurs aux marqueurs nominatifs avec bindValue (protection contre les injections de sql)
        $placesPaging->bindValue(':limit', $limit, PDO::PARAM_INT);
        $placesPaging->bindValue(':offset', $offset, PDO::PARAM_INT);
        //vérification que la requête s'est bien exécutée
        if ($placesPaging->execute()) {
            //on vérifie que $placesPaging est un objet
            if (is_object($placesPaging)) {
                $resultPaging = $placesPaging->fetchAll(PDO::FETCH_OBJ);
            } else {
                $resultPaging = FALSE;
            }
        } else {
            $resultPaging = FALSE;
        }
        return $resultPaging;
    }

    public function searchPlaces() {
        //initialisation d'un tableau vide
        $resultArray = array();
        //déclaration de la requête sql
        $request = 'SELECT `pl`.`id`,`pl`.`name`,`pl`.`address`,`pl`.`description`,`pl`.`createDate`,`pl`.`idCategories`,`pl`.`idCities`, '
                . '`cit`.`city`,`cit`.`postalCode`, '
                . '`cat`.`name` AS `category` '
                . 'FROM `F396V_places` AS `pl` '
                . 'LEFT JOIN `F396V_cities` AS `cit` ON `pl`.`idCities` = `cit`.`id` '
                . 'LEFT JOIN `F396V_categories` AS `cat` ON `pl`.`idCategories` = `cat`.`id` '
                . 'WHERE `pl`.`name` LIKE :searchName '
                . 'ORDER BY `pl`.`name` ASC';
        //appel de la requête avec un prepare (car il y a un marqueur nominatif) que l'on stocke dans l'objet $searchPlaces
        $searchPlaces = $this->db->prepare($request);
        //attribution de la valeur au marqueur nominatif avec bindValue (protection contre les injections de sql)
        $searchPlaces->bindValue(':searchName', '%' . $this->searchName . '%', PDO::PARAM_STR);
        //vérification que la requête s'est bien exécutée
        if ($searchPlaces->execute()) {
            //on vérifie que $searchPlaces est un objet
            if (is_object($searchPlaces)) {
                $resultArray = $searchPlaces->fetchAll(PDO::FETCH_OBJ);
            } else {
                $resultArray = FALSE;
            }
        }else{
            $resultArray =FALSE;
        }
        return$resultArray;
    }

    /**
     * Méthode magique destruct héritière du parent database
     */
    public function __destruct() {
        parent::__destruct();
        $this->dbConnect();
    }

}
