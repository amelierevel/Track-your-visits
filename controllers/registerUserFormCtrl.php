<?php
include_once '../configuration.php';

//instanciation pour l'affichage de la liste des types d'utilisateur
$userType = NEW userType();
$userTypeList = $userType->getUserType();

var_dump($_POST);
//déclaration de la regex username
$regexUsername = '^[a-zA-Z0-9àáâãäéèêëîïìíØøòóôõöùúûüýÿñçßæœ_\'\-]{1,25}$';
//déclaration de la regex date de naissance autorisant la naissance de 1920 à 2018
$regexBirthDate = '/^(([0-2][\d])|([3][0-1]))\/(([0][\d])|([1][0-2]))\/(([1][9][2-9][0-9])|([2][0]([0][0-9])|([1][0-8])))$/';
//déclaration d'un tableau d'erreur
$formError = array();

//verification que les données ont été envoyés sans forcément vérifier chaque champ
if (isset($_POST['inscriptionUserSubmit'])) {
    $user = NEW users();
    //vérification que le champ lastname n'est pas vide et attribution de sa valeur à la variable $lastname avec la sécurité htmlspecialchars (évite injection de code)
    if (!empty($_POST['lastname'])) {
        $user->lastname = htmlspecialchars($_POST['lastname']);
        //si le champ est vide affichage d'un message d'erreur
    } else {
        $formError['lastname'] = 'Veuillez indiquer votre nom';
    }
    //vérification que le champ firstname n'est pas vide et attribution de sa valeur à la variable $firstname avec la sécurité htmlspecialchars (évite injection de code)
    if (!empty($_POST['firstname'])) {
        $user->firstname = htmlspecialchars($_POST['firstname']);
        //si le champ est vide affichage d'un message d'erreur
    } else {
        $formError['firstname'] = 'Veuillez indiquer votre prénom';
    }
    //vérification que le champ username n'est pas vide et attribution de sa valeur à la variable $username avec la sécurité htmlspecialchars (évite injection de code)
    if (!empty($_POST['username'])) {
        $user->username = htmlspecialchars($_POST['username']);
        //si le champ est vide affichage d'un message d'erreur
    } else {
        $formError['username'] = 'Veuillez indiquer un nom d\'utilisateur';
    }
    //vérification que le champ userType n'est pas vide
    if (!empty($_POST['idUserType'])){
        //vérification de la validité de la valeur (doit être un nombre) et attribution de sa valeur à la variable $userType avec la sécurité htmlspecialchars (évite injection de code)
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
        //vérification de la validité de la valeur et attribution de cette valeur à la variable $birthDate avec la sécurité htmlspecialchars (évite injection de code)
        if (!preg_match($regexBirthDate, $_POST['birthDate'])) {
            $user->birthDate = htmlspecialchars($_POST['birthDate']);
            //si la valeur n'est pas valide affichage d'un message d'erreur
        } else {
            $formError['birthDate'] = 'La saisie de votre date de naissance est invalide';
        } 
         //si le champ est vide affichage d'un message d'erreur
    } else {
        $formError['birthDate'] = 'Veuillez indiquer votre date de naissance';
    }
    /*vérification que le champ mail n'est pas vide et 
     * vérification de la validité du mail avec un filtre puis
     * attribution de sa valeur à la variable $username avec la sécurité htmlspecialchars (évite injection de code)
     */
    if (!empty($_POST['mail']) && filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)) {
        $user->mail = htmlspecialchars($_POST['mail']);
         //si le champ est vide ou s'il n'est pas valide affichage d'un message d'erreur
    } else {
        $formError['mail'] = 'Veuillez indiquer votre mail';
    }
    /*vérification que les champs password et passwordVerify ne sont pas vides et 
     * vérification qu'ils sont identiques
     * puis attribution de la valeur hachée à la variable $password 
     */
    if (!empty($_POST['password']) && !empty($_POST['passwordVerify']) && $_POST['password'] == $_POST['passwordVerify']) {
        $user->password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        //si les champs sont vides ou s'il ne sont pas identiques affichage d'un message d'erreur
    } else {
        $formError['password'] = 'Veuillez vérifier votre mot de passe';
    }
    //s'il n'y a pas d'erreur on appelle la méthode pour l'ajout d'un utilisateur
    if (count($formError) == 0){
        $user->createDate = date('Y-m-d');
        //affichage d'un message d'erreur si la méthode ne s'exécute pas
        if (!$user->addUser()){
            $formError['inscriptionUserSubmit'] = 'Il y a eu un problème veuillez contacter l\'administrateur du site';
        }
    }
}