<?php

//insertion de la class database et des models users et userTypes
include_once path::getClassesPath() . 'database.php';
include_once path::getModelsPath() . 'users.php';
include_once path::getModelsPath() . 'userTypes.php';

//instanciation pour l'affichage de la liste des types d'utilisateur
$userType = NEW userTypes();
$userTypeList = $userType->getUserType();

//déclaration d'un tableau d'erreur
$formError = array();

//verification que les données ont été envoyés
if (isset($_POST['updateUserSubmit'])) {
    //ouverture de la session pour pouvoir faire la modification du profil car elle ne s'ouvre qu'à partir du chargement de la page header (après le controller)
    session_start();
    //instanciation de l'objet user
    $user = NEW users();
    //récupération des valeurs non modifiables par l'utilisateur
    $user->id = $_SESSION['id'];
    $user->username = $_SESSION['username'];
    $user->lastname = $_SESSION['lastname'];
    $user->firstname = $_SESSION['firstname'];
    $user->birthDate = $_SESSION['birthDate'];
    $user->createDate = $_SESSION['createDate'];
    $user->password = $_SESSION['password'];
    /* vérification que le champ mail n'est pas vide et 
     * vérification de la validité du mail avec un filtre puis
     * attribution de sa valeur à l'attribut mail de l'objet $user avec la sécurité htmlspecialchars (évite injection de code)
     */
    if (!empty($_POST['mail']) && filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)) {
        $user->mail = htmlspecialchars($_POST['mail']);
        //si le champ est vide ou s'il n'est pas valide affichage d'un message d'erreur
    } else {
        $formError['mail'] = 'Veuillez indiquer votre mail';
    }
    //vérification que le champ idUserTypes n'est pas vide
    if (!empty($_POST['idUserTypes'])) {
        //vérification de la validité de la valeur (doit être un nombre) et attribution de sa valeur à l'attribut idUserTypes de l'objet $user avec la sécurité htmlspecialchars (évite injection de code)
        if (is_numeric($_POST['idUserTypes'])) {
            $user->idUserTypes = htmlspecialchars($_POST['idUserTypes']);
            //si la valeur n'est pas valide (pas un nombre) affichage d'un message d'erreur
        } else {
            $formError['idUserTypes'] = 'Veuillez sélectionner un type d\'utilisateur valide';
        }
        //si le champ est vide affichage d'un message d'erreur
    } else {
        $formError['idUserTypes'] = 'Veuillez sélectionner un type d\'utilisateur';
    }
    //s'il n'y a pas d'erreur on appelle la méthode pour la modification d'un utilisateur
    if (count($formError) == 0) {
        //affichage d'un message d'erreur si la méthode ne s'exécute pas
        if (!$user->updateProfileUser()) {
            $formError['updateUserSubmit'] = 'Il y a eu un problème veuillez contacter l\'administrateur du site';
        } else {
            $_SESSION['mail'] = $user->mail;
            $_SESSION['idUserTypes'] = $user->idUserTypes;
        }
    }
    //écriture des données de session et fermeture de la session (pour qu'elle puisse s'ouvrir correctement au chargement du header)
    session_write_close();
}
//-------------modification du mot de passe de l'utilisateur---------------
//verification que les données ont été envoyés
if (isset($_POST['updatePasswordSubmit'])) {
    //ouverture de la session pour pouvoir faire la modification du profil car elle ne s'ouvre qu'à partir du chargement de la page header (après le controller)
    session_start();
    //instanciation de l'objet user
    $updateUserPassword = NEW users();
    //récupération des valeurs non modifiables par l'utilisateur
    $updateUserPassword->id = $_SESSION['id'];
    $updateUserPassword->username = $_SESSION['username'];
    $updateUserPassword->lastname = $_SESSION['lastname'];
    $updateUserPassword->firstname = $_SESSION['firstname'];
    $updateUserPassword->birthDate = $_SESSION['birthDate'];
    $updateUserPassword->createDate = $_SESSION['createDate'];
    $updateUserPassword->mail = $_SESSION['mail'];
    $updateUserPassword->idUserTypes = $_SESSION['idUserTypes'];
    //appel de la méthode pour récupérer le password de l'user
    $getPassword = $updateUserPassword->getUserById();
    if (!empty($_POST['oldPassword'])) {
        $oldPassword = htmlspecialchars($_POST['oldPassword']);
    } else {
        $formError['password'] = 'Veuillez renseigner votre mot de passe actuel';
    }
    if (password_verify($oldPassword, $getPassword->password)) {
        if (!empty($_POST['newPassword']) && !empty($_POST['newPasswordVerify'])) {
            if ($_POST['newPassword'] == $_POST['newPasswordVerify']) {
                $updateUserPassword->password = password_hash($_POST['newPassword'], PASSWORD_DEFAULT);
            } else {
                $formError['password'] = 'Les mots de passe ne correspondent pas';
            }
        } else {
            $formError['password'] = 'Veuillez remplir tous les champs';
        }
    } else {
        $formError['password'] = 'Le mot de passe actuel est incorrect';
    }
    //s'il n'y a pas d'erreur on appelle la méthode pour la modification d'un utilisateur
    if (count($formError) == 0) {
        //affichage d'un message d'erreur si la méthode ne s'exécute pas
        if (!$updateUserPassword->updateProfileUser()) {
            $formError['updatePasswordSubmit'] = 'Il y a eu un problème veuillez contacter l\'administrateur du site';
        } else {
            $_SESSION['password'] = $updateUserPassword->password;
        }
    }
    //écriture des données de session et fermeture de la session (pour qu'elle puisse s'ouvrir correctement au chargement du header)
    session_write_close();
}

//-------------suppression de l'utilisateur---------------
if (isset($_GET['idDelete']) && is_numeric($_GET['idDelete'])) {
//instanciation pour la suppression
    $deleteUser = NEW users();
    $deleteUser->id = htmlspecialchars($_GET['idDelete']);
//appel de la méthode deleteUser() permettant la suppression d'un utilisateur
    $removeUser = $deleteUser->deleteUser();
//si la méthode s'exécute 
    if ($removeUser == TRUE) {
        //ouverture de la session pour pouvoir la détruire avant le chargement de la page header (car sinon elle s'ouvre qu'à partir du chargement de la page header)
        session_start();
        //destruction de la session
        session_destroy();
        //redirection vers la page d'inscription
        header('Location: Inscription-utilisateur');
        exit();
        //affichage d'un message d'erreur si la requête ne s'est pas exécutée
    } elseif ($removeUser === FALSE) {
        $deleteError = 'L\'utilisateur n\'a pas pu être supprimé, veuillez contacter l\'administrateur du site';
    }
}
