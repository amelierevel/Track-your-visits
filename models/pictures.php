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
     * Méthode permettant l'ajout d'une photo
     * @return type
     */
    public function addPicture() {
        $request = 'INSERT INTO `F396V_pictures`(`picture`,`idPlaces`) '
                . 'VALUES (:picture, :idPlaces)';
        $insertPicture = $this->db->prepare($request);
        $insertPicture->bindValue(':picture', $this->picture, PDO::PARAM_STR);
        $insertPicture->bindValue(':idPlaces', $this->idPlaces, PDO::PARAM_INT);
        if ($insertPicture->execute()) {
            return $insertPicture;
        }
    }

    /**
     * Méthode magique destruct héritière du parent database
     */
    public function __destruct() {
        parent::__destruct();
        $this->dbConnect();
    }

}
