<?php

//insertion de la class database et des models users et userTypes
include_once path::getClassesPath() . 'database.php';
include_once path::getModelsPath() . 'users.php';
include_once path::getModelsPath() . 'userTypes.php';

//instanciation de l'objet user
$user = NEW users();

//instanciation pour l'affichage de la liste des types d'utilisateur
$userType = NEW userTypes();
$userTypeList = $userType->getUserType();

//déclaration de la regex nom
$regexName = '/^[A-Za-zäâéèëêîïôöüÿç\-\']+$/';
//déclaration de la regex username
$regexUsername = '/^[a-zA-Z0-9àáâãäéèêëîïìíØøòóôõöùúûüýÿñçßæœ_\'\-]{1,25}$/';
//déclaration de la regex date de naissance autorisant la naissance de 1920 à 2018
$regexBirthDate = '/^(([1][9][2-9][0-9])|([2][0][0][0-9])|([2][0][1][0-8]))\-(([0][\d])|([1][0-2]))\-(([0-2][\d])|([3][0-1]))$/';
//déclaration d'un tableau d'erreur
$formError = array();

//verification que les données ont été envoyés
if (isset($_POST['updateUserSubmit'])) {
    //récupération des valeurs non modifiables par l'utilisateur
    $user->id = $user->id;
    $user->username = $user->username;
    $user->createDate = $user->createDate;
    $user->password = $user->password;
        var_dump($_POST['updateUserSubmit']);
    //vérification que le champ lastname n'est pas vide 
    if (!empty($_POST['lastname'])) {
        //vérification de la validité de la valeur et attribution de sa valeur à l'attribut lastname de l'objet $user avec la sécurité htmlspecialchars (évite injection de code)
        if (preg_match($regexName, $_POST['lastname'])) {
            $user->lastname = htmlspecialchars($_POST['lastname']);
            //si la valeur n'est pas valide affichage d'un message d'erreur
        } else {
            $formError['lastname'] = 'La saisie de votre nom est invalide';
        }
        //si le champ est vide affichage d'un message d'erreur
    } else {
        $formError['lastname'] = 'Veuillez indiquer votre nom';
    }
    //vérification que le champ firstname n'est pas vide 
    if (!empty($_POST['firstname'])) {
        //vérification de la validité de la valeur et attribution de sa valeur à l'attribut firstname de l'objet $user avec la sécurité htmlspecialchars (évite injection de code)
        if (preg_match($regexName, $_POST['firstname'])) {
            $user->firstname = htmlspecialchars($_POST['firstname']);
            //si la valeur n'est pas valide affichage d'un message d'erreur
        } else {
            $formError['firstname'] = 'La saisie de votre prénom est invalide';
        }
        //si le champ est vide affichage d'un message d'erreur
    } else {
        $formError['firstname'] = 'Veuillez indiquer votre prénom';
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
    //vérification que le champ birthDate n'est pas vide 
    if (!empty($_POST['birthDate'])) {
        //vérification de la validité de la valeur et attribution de cette valeur à l'attribut birthDate de l'objet $user avec la sécurité htmlspecialchars (évite injection de code)
        if (preg_match($regexBirthDate, $_POST['birthDate'])) {
            $user->birthDate = htmlspecialchars($_POST['birthDate']);
            //si la valeur n'est pas valide affichage d'un message d'erreur
        } else {
            $formError['birthDate'] = 'La saisie de votre date de naissance est invalide';
        }
        //si le champ est vide affichage d'un message d'erreur
    } else {
        $formError['birthDate'] = 'Veuillez indiquer votre date de naissance';
    }
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
    //s'il n'y a pas d'erreur on appelle la méthode pour la modification d'un utilisateur
    if (count($formError) == 0) {
        var_dump($_POST['updateUserSubmit']);
        //affichage d'un message d'erreur si la méthode ne s'exécute pas
        if (!$user->updateProfileUser()) {
            $formError['updateUserSubmit'] = 'Il y a eu un problème veuillez contacter l\'administrateur du site';
        }
    }
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
    header('Location: registerUser.php');
    exit();
    //affichage d'un message d'erreur si la requête ne s'est pas exécutée
} elseif ($removeUser === FALSE) {
    $deleteError = 'L\'utilisateur n\'a pas pu être supprimé, veuillez contacter l\'administrateur du site';
}
}
