<?php

include_once path::getClassesPath() . 'database.php';
include_once path::getModelsPath() . 'userTypes.php';
include_once path::getModelsPath() . 'users.php';

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
if (isset($_POST['registerUserSubmit'])) {
    //instanciation de l'objet user
        $user = NEW users();
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
    //vérification que le champ username n'est pas vide
    if (!empty($_POST['username'])) {
        //vérification de la validité de la valeur et attribution de cette valeur à l'attribut username de l'objet $user avec la sécurité htmlspecialchars (évite injection de code)
        if (preg_match($regexUsername, $_POST['username'])) {
            $user->username = htmlspecialchars($_POST['username']);
            //si la valeur n'est pas valide affichage d'un message d'erreur
        } else {
            $formError['username'] = 'La saisie de votre nom d\'utilisateur est invalide';
        }
        //si le champ est vide affichage d'un message d'erreur
    } else {
        $formError['username'] = 'Veuillez indiquer un nom d\'utilisateur';
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
    /* vérification que les champs password et passwordVerify ne sont pas vides et 
     * vérification qu'ils sont identiques
     * puis attribution de la valeur hachée du mot de passe à l'attribut password de l'objet $user 
     */
    if (!empty($_POST['password']) && !empty($_POST['passwordVerify']) && $_POST['password'] == $_POST['passwordVerify']) {
        $user->password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        //si les champs sont vides ou s'il ne sont pas identiques affichage d'un message d'erreur
    } else {
        $formError['password'] = 'Veuillez vérifier votre mot de passe';
    }
    //s'il n'y a pas d'erreur on appelle la méthode pour l'ajout d'un utilisateur après vérification de la disponibilité du nom d'utilisateur
    if (count($formError) == 0) {
        //attribution de la date du jour au format sql (aaaa-mm-jj hh:mm:ss) à l'attribut createDate de l'objet $user
        $user->createDate = date('Y-m-d H:i:s');
        //appel de la méthode vérifiant la disponibilité du nom d'utilisateur
        $checkUsername = $user->checkIfUserExist();
        //si la méthode retourne 0 le nom d'utilisateur est disponible et l'utilisateur peut être ajouté à la base de données
        if ($checkUsername === '0') {
            //affichage d'un message d'erreur si la méthode ne s'exécute pas
            if (!$user->addUser()) {
                $formError['registerUserSubmit'] = 'Il y a eu un problème veuillez contacter l\'administrateur du site';
            }
            //si la méthode retourne false affichage d'un message d'erreur car la requête ne s'est pas exécutée correctement
        } elseif ($checkUsername === FALSE) {
            $formError['registerUserSubmit'] = 'Il y a eu un problème veuillez contacter l\'administrateur du site';
            //sinon la méthode retourne 1, le nom d'utilisateur n'est pas disponible, affichage d'un message d'erreur
        } else {
            $formError['username'] = 'Ce nom d\'utilisateur est déjà utilisé';
        }
    }
}