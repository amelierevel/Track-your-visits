<?php

/**
 * Création de la class users héritière de database
 */
class users extends database {

    //Liste des attributs
    public $id;
    public $firstname;
    public $lastname;
    public $birthDate;
    public $mail;
    public $username;
    public $password;
    public $createDate;
    public $idUserType;

    /**
     * Méthode magique construct héritée du parent database
     */
    public function __construct() {
        parent::__construct();
        $this->dbConnect();
    }

    /**
     * Méthode permettant d'ajout un nouvel utilisateur
     * @return type
     */
    public function addUser() {
        //déclaration de la requête sql
        $request = 'INSERT INTO `F396V_users`(`firstname`,`lastname`,`birthDate`,`mail`,`username`,`password`,`createDate`,`idUserType`) '
                . 'VALUES (:firstname, :lastname, :birthDate, :mail, :username, :password, :createDate, :idUserType)';
        //appel de la requête avec un prepare (car il y a des marqueurs nominatifs) que l'on stocke dans la variable $insertUser
        $insertUser = $this->db->prepare($request);
        //attribution des valeurs aux marqueurs nominatifs avec bindValue (protection contre les injections de sql)
        $insertUser->bindValue(':firstname', $this->firstname, PDO::PARAM_STR);
        $insertUser->bindValue(':lastname', $this->lastname, PDO::PARAM_STR);
        $insertUser->bindValue(':birthDate', $this->birthDate, PDO::PARAM_STR);
        $insertUser->bindValue(':mail', $this->mail, PDO::PARAM_STR);
        $insertUser->bindValue(':username', $this->username, PDO::PARAM_STR);
        $insertUser->bindValue(':password', $this->password, PDO::PARAM_STR);
        $insertUser->bindValue(':createDate', $this->createDate, PDO::PARAM_STR);
        $insertUser->bindValue(':idUserType', $this->idUserType, PDO::PARAM_INT);
        return $insertUser->execute();
    }

    public function checkIfUserExist() {
        $state = FALSE;
        $request = 'SELECT COUNT(`id`) AS `count` '
                . 'FROM `F396V_users` '
                . 'WHERE `username` = :username';
        $result = $this->db->prepare($request);
        $result->bindValue(':username', $this->username, PDO::PARAM_STR);
        if ($result->execute()) {
            $selectResult = $result->fetch(PDO::FETCH_OBJ);
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
