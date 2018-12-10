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
    public $idUserTypes;

    /**
     * Méthode magique construct héritée du parent database
     */
    public function __construct() {
        parent::__construct();
        $this->dbConnect();
    }

    /**
     * Méthode permettant d'ajouter un nouvel utilisateur
     * @return type
     */
    public function addUser() {
        //déclaration de la requête sql
        $request = 'INSERT INTO `F396V_users`(`firstname`,`lastname`,`birthDate`,`mail`,`username`,`password`,`createDate`,`idUserTypes`) '
                . 'VALUES (:firstname, :lastname, :birthDate, :mail, :username, :password, :createDate, :idUserTypes)';
        //appel de la requête avec un prepare (car il y a des marqueurs nominatifs) que l'on stocke dans l'objet $insertUser
        $insertUser = $this->db->prepare($request);
        //attribution des valeurs aux marqueurs nominatifs avec bindValue (protection contre les injections de sql)
        $insertUser->bindValue(':firstname', $this->firstname, PDO::PARAM_STR);
        $insertUser->bindValue(':lastname', $this->lastname, PDO::PARAM_STR);
        $insertUser->bindValue(':birthDate', $this->birthDate, PDO::PARAM_STR);
        $insertUser->bindValue(':mail', $this->mail, PDO::PARAM_STR);
        $insertUser->bindValue(':username', $this->username, PDO::PARAM_STR);
        $insertUser->bindValue(':password', $this->password, PDO::PARAM_STR);
        $insertUser->bindValue(':createDate', $this->createDate, PDO::PARAM_STR);
        $insertUser->bindValue(':idUserTypes', $this->idUserTypes, PDO::PARAM_INT);
        //vérification que la requête s'est bien exécutée
        if ($insertUser->execute()) {
            return $insertUser;
        } else { //affichage d'un message d'erreur si la méthode ne s'exécute pas
            $formError['execute'] = 'Il y a eu un problème veuillez contacter l\'administrateur du site';
        }
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
        //appel de la requête avec un prepare (car il y a un marqueur nominatif) que l'on stocke dans l'objet $result
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
     * Méthode permettant d'afficher les informations d'un utilisateur après sa connexion
     * @return boolean
     */
    public function connectionUser() {
        //initialisation de la variable $state avec la valeur false
        $state = FALSE;
        //déclaration de la requête sql
        $request = 'SELECT `us`.`id`,`us`.`lastname`,`us`.`firstname`,DATE_FORMAT(`us`.`birthDate`, \'%d/%m/%Y\') AS `birthDate`,`us`.`mail`,'
                . '`us`.`username`,DATE_FORMAT(`us`.`createDate`, \'%d/%m/%Y\') AS `createDate`,`us`.`idUserTypes`,`us`.`password`, '
                . '`usTypes`.`name` '
                . 'FROM `F396V_users` AS `us` '
                . 'INNER JOIN `F396V_userTypes` AS `usTypes` ON `us`.`idUserTypes` = `usTypes`.`id` '
                . 'WHERE `us`.`username` = :username';
        //appel de la requête avec un prepare (car il y a un marqueur nominatif) que l'on stocke dans l'objet $result
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
                $this->birthDate = $selectResult->birthDate;
                $this->mail = $selectResult->mail;
                $this->username = $selectResult->username;
                $this->createDate = $selectResult->createDate;
                $this->idUserTypes = $selectResult->idUserTypes;
                $this->password = $selectResult->password;
                $this->name = $selectResult->name;
                $state = TRUE;
            }
        }
        return $state;
    }

    /**
     * Méthode permettant l'affichage du profil d'un utilisateur
     * @return type
     */
    public function getUserById() {
        //initialisation de la variable $userInfo avec la valeur false
        $userInfo = FALSE;
        //déclaration de la requête sql
        $request = 'SELECT `us`.`id`,`us`.`lastname`,`us`.`firstname`,DATE_FORMAT(`us`.`birthDate`, \'%d/%m/%Y\') AS `birthDate`,`us`.`mail`,'
                . '`us`.`username`,DATE_FORMAT(`us`.`createDate`, \'%d/%m/%Y\') AS `createDate`,`us`.`idUserTypes`,`us`.`password`,`usTypes`.`name` '
                . 'FROM `F396V_users` AS `us` '
                . 'INNER JOIN `F396V_userTypes` AS `usTypes` '
                . 'ON `us`.`idUserTypes` = `usTypes`.`id` '
                . 'WHERE `us`.`id` = :id';
        //appel de la requête avec un prepare (car il y a un marqueur nominatif) que l'on stocke dans l'objet $result
        $result = $this->db->prepare($request);
        //attribution de la valeur au marqueur nominatif avec bindValue (protection contre les injections de sql)
        $result->bindValue(':id', $this->id, PDO::PARAM_INT);
        //vérification que la requête s'est bien exécutée
        if ($result->execute()) {
            //vérification qu'il s'agit bien d'un objet
            if (is_object($result)) {
                $userInfo = $result->fetch(PDO::FETCH_OBJ);
            }
        }
        return $userInfo;
    }

    /**
     * Méthode permettant de modifier les informations (mail, type et mot de passe) de l'utilisateur
     * @return type
     */
    public function updateProfileUser() {
        //déclaration de la requête sql
        $request = 'UPDATE `F396V_users` '
                . 'SET `mail` = :mail,`idUserTypes` = :idUserTypes, `password` = :password '
                . 'WHERE `id` = :id';
        //appel de la requête avec un prepare (car il y a des marqueurs nominatifs) que l'on stocke dans l'objet $updateUser
        $updateUser = $this->db->prepare($request);
        //attribution des valeurs aux marqueurs nominatifs avec bindValue (protection contre les injections de sql)
        $updateUser->bindValue(':id', $this->id, PDO::PARAM_INT);
        $updateUser->bindValue(':mail', $this->mail, PDO::PARAM_STR);
        $updateUser->bindValue(':idUserTypes', $this->idUserTypes, PDO::PARAM_INT);
        $updateUser->bindValue(':password', $this->password, PDO::PARAM_STR);
        //vérification que la requête s'est bien exécutée
        if ($updateUser->execute()) {
            //vérification qu'il s'agit bien d'un objet
            if (is_object($updateUser)) {
                return $updateUser;
            }
        }
    }

    /**
     * Méthode permettant la suppression d'un utilisateur
     * @return boolean
     */
    public function deleteUser() {
        //initialisation de la variable $state avec la valeur false
        $state = FALSE;
        //déclaration de la requête sql
        $request = 'DELETE FROM `F396V_users` '
                . 'WHERE `id` = :id';
        //appel de la requête avec un prepare (car il y a un marqueur nominatif) que l'on stocke dans l'objet $deleteUser
        $deleteUser = $this->db->prepare($request);
        //attribution de la valeur au marqueur nominatif avec bindValue (protection contre les injections de sql)
        $deleteUser->bindValue(':id', $this->id, PDO::PARAM_INT);
        //vérification que la requête s'est bien exécutée
        if ($deleteUser->execute()) {
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
