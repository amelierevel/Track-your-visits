<?php

include_once path::getClassesPath() . 'database.php';
include_once path::getModelsPath() . 'users.php';
include_once path::getModelsPath() . 'userType.php';

//instanciation de l'objet user
$user = NEW users();
//sécurisation en vérifiant la présence d'un id dans l'url pour afficher le profil de l'utilisateur correspondant
if (isset($_GET['id'])) {
    $user->id = $_GET['id'];
}
//instanciation pour l'affichage de la liste des types d'utilisateur
$userType = NEW userType();
$userTypeList = $userType->getUserType();

//appel de la méthode getUserById() permettant l'affichage du profil de l'utilisateur connecté
$profileUser = $user->getUserById();
//redirection vers la page d'inscription si l'id dans l'url n'existe pas 
if ($profileUser == FALSE) {
    header('Location: registerUserForm.php');
    exit;
}

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
    $user->username = $profileUser->username;
    $user->createDate = $profileUser->createDate;
    $user->password = $profileUser->password;
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
    //vérification que le champ userType n'est pas vide
    if (!empty($_POST['idUserType'])) {
        //vérification de la validité de la valeur (doit être un nombre) et attribution de sa valeur à l'attribut idUserType de l'objet $user avec la sécurité htmlspecialchars (évite injection de code)
        if (is_numeric($_POST['idUserType'])) {
            $user->idUserType = htmlspecialchars($_POST['idUserType']);
            //si la valeur n'est pas valide (pas un nombre) affichage d'un message d'erreur
        } else {
            $formError['idUserType'] = 'Veuillez sélectionner un type d\'utilisateur valide';
        }
        //si le champ est vide affichage d'un message d'erreur
    } else {
        $formError['idUserType'] = 'Veuillez sélectionner un type d\'utilisateur';
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
    //s'il n'y a pas d'erreur on appelle la méthode pour l'ajout d'un utilisateur après vérification de la disponibilité du nom d'utilisateur
    if (count($formError) == 0) {
        //affichage d'un message d'erreur si la méthode ne s'exécute pas
        if (!$user->updateProfileUser()) {
            $formError['updateUserSubmit'] = 'Il y a eu un problème veuillez contacter l\'administrateur du site';
        }
    }
}

