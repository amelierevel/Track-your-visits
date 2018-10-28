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

    /**
     * Méthode permettant de vérifier la disponibilité d'un nom utilisateur
     * @return type
     */
    public function checkIfUserExist() {
        //initialisation de la variable $state avec la valeur false
        $state = FALSE;
        //déclaration de la requête sql
        $request = 'SELECT COUNT(`id`) AS `count` '
                . 'FROM `F396V_users` '
                . 'WHERE `username` = :username';
        //appel de la requête avec un prepare (car il y a un marqueur nominatif) que l'on stocke dans la variable $result
        $result = $this->db->prepare($request);
        //attribution de la valeur au marqueur nominatif avec bindValue (protection contre les injections de sql)
        $result->bindValue(':username', $this->username, PDO::PARAM_STR);
        //vérification que la requête s'est bien exécutée
        if ($result->execute()) {
            $selectResult = $result->fetch(PDO::FETCH_OBJ);
            //attribution du résultat du count (0 ou 1) à la variable $state
            $state = $selectResult->count;
        }
        return $state;
    }

    /**
     * Méthode permettant de faire la connexion de l'utilisateur
     * @return boolean
     */
    public function connectionUser() {
        //initialisation de la variable $state avec la valeur false
        $state = FALSE;
        //déclaration de la requête sql
        $request = 'SELECT `id`,`lastname`,`firstname`,`username`,`password` '
                . 'FROM `F396V_users` '
                . 'WHERE `username` = :username';
        //appel de la requête avec un prepare (car il y a un marqueur nominatif) que l'on stocke dans la variable $result
        $result = $this->db->prepare($request);
        //attribution de la valeur au marqueur nominatif avec bindValue (protection contre les injections de sql)
        $result->bindValue(':username', $this->username, PDO::PARAM_STR);
        //vérification que la requête s'est bien exécutée
        if ($result->execute()) {
            $selectResult = $result->fetch(PDO::FETCH_OBJ);
            //vérification que l'on a bien trouvé l'utilisateur recherché et qu'il s'agit bien d'un objet
            if (is_object($selectResult)) {
                //hydratation
                $this->id = $selectResult->id;
                $this->lastname = $selectResult->lastname;
                $this->firstname = $selectResult->firstname;
                $this->username = $selectResult->username;
                $this->password = $selectResult->password;
                $state = TRUE;
            }
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
