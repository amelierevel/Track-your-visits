<?php

/**
 * Création de la class pictures héritière de database
 */
class pictures extends database {

    //Liste des attributs
    public $id;
    public $picture;
    public $idPlaces;

    /**
     * Méthode magique construct héritière du parent database
     */
    public function __construct() {
        parent::__construct();
        $this->dbConnect();
    }

    /**
     * Méthode permettant l'ajout d'une photo pour un lieu
     * @return type
     */
    public function addPicture() {
        //déclaration de la requête sql
        $request = 'INSERT INTO `F396V_pictures`(`picture`,`idPlaces`) '
                . 'VALUES (:picture, :idPlaces)';
        //appel de la requête avec un prepare (car il y a des marqueurs nominatifs) que l'on stocke dans l'objet $insertPicture
        $insertPicture = $this->db->prepare($request);
        //attribution des valeurs aux marqueurs nominatifs avec bindValue (protection contre les injections de sql)
        $insertPicture->bindValue(':picture', $this->picture, PDO::PARAM_STR);
        $insertPicture->bindValue(':idPlaces', $this->idPlaces, PDO::PARAM_INT);
        //vérification que la requête s'est bien exécutée
        if ($insertPicture->execute()) {
            return $insertPicture;
        }
    }

    /**
     * Méthode permettant de vérifier si un lieu possède déjà une photo
     * @return type
     */
    public function checkIfPicturePlaceExist() {
        //initialisation de la variable $state avec la valeur false
        $state = FALSE;
        //déclaration de la requête sql
        $request = 'SELECT COUNT(`id`) AS `count` '
                . 'FROM `F396V_pictures` '
                . 'WHERE `idPlaces` = :idPlaces';
        //appel de la requête avec un prepare (car il y a un marqueur nominatif) que l'on stocke dans l'objet $result
        $result = $this->db->prepare($request);
        //attribution des valeurs au marqueur nominatif avec bindValue (protection contre les injections de sql)
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
     * Méthode permettant l'affichage de la photo d'un lieu
     * @return type
     */
    public function getPictureByPlace() {
        //initialisation de la variable $result avec la valeur false
        $result = FALSE;
        //déclaration de la requête sql
        $request = 'SELECT `id`,`picture`,`idPlaces` '
                . 'FROM `F396V_pictures` '
                . 'WHERE `idPlaces` = :idPlaces';
        //appel de la requête avec un prepare (car il y a un marqueur nominatif) que l'on stocke dans l'objet $picturePlace
        $picturePlace = $this->db->prepare($request);
        //attribution de la valeur au marqueur nominatif avec bindValue (protection contre les injections de sql)
        $picturePlace->bindValue(':idPlaces', $this->idPlaces, PDO::PARAM_INT);
        //vérification que la requête s'est bien exécutée
        if ($picturePlace->execute()) {
            //vérification qu'il s'agit bien d'un objet
            if (is_object($picturePlace)) {
                $result = $picturePlace->fetch(PDO::FETCH_OBJ);
            }
        }
        return $result;
    }

    /**
     * Méthode magique destruct héritière du parent database
     */
    public function __destruct() {
        parent::__destruct();
        $this->dbConnect();
    }

}
