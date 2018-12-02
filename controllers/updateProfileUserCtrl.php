<?php

//ouverture de la session
session_start();
//insertion de la class database et des models users et userTypes
include_once path::getClassesPath() . 'database.php';
include_once path::getModelsPath() . 'users.php';
include_once path::getModelsPath() . 'userTypes.php';

//instanciation pour l'affichage de la liste des types d'utilisateur
$userType = NEW userTypes();
$userTypeList = $userType->getUserType();
//déclaration d'un tableau d'erreur
$formError = array();

//redirection sur la page 404 si un user non connecté essaye d'accéder à la page
if($_SESSION['isConnect'] == FALSE){
    header('Location: error404.php');
    exit;
}

if (isset($_POST['updateUserSubmit'])) { //verification que les données ont été envoyés
    $user = NEW users(); //instanciation de l'objet user
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
     * attribution de sa valeur à l'attribut mail de l'objet $user avec la sécurité htmlspecialchars (évite injection de code) */
    if (!empty($_POST['mail']) && filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)) {
        $user->mail = htmlspecialchars($_POST['mail']);
    } else { //si le champ est vide ou s'il n'est pas valide affichage d'un message d'erreur
        $formError['mail'] = 'Veuillez indiquer votre mail';
    }
    if (!empty($_POST['idUserTypes'])) { //vérification que le champ idUserTypes n'est pas vide
        /* vérification de la validité de la valeur (doit être un nombre) et attribution de sa valeur à l'attribut idUserTypes de 
          l'objet $user avec la sécurité htmlspecialchars (évite injection de code) */
        if (is_numeric($_POST['idUserTypes'])) {
            $user->idUserTypes = htmlspecialchars($_POST['idUserTypes']);
        } else { //si la valeur n'est pas valide (pas un nombre) affichage d'un message d'erreur
            $formError['idUserTypes'] = 'Veuillez sélectionner un type d\'utilisateur valide';
        }
    } else { //si le champ est vide affichage d'un message d'erreur
        $formError['idUserTypes'] = 'Veuillez sélectionner un type d\'utilisateur';
    }
    if (count($formError) == 0) { //s'il n'y a pas d'erreur on appelle la méthode pour la modification d'un utilisateur
        if (!$user->updateProfileUser()) { //affichage d'un message d'erreur si la méthode ne s'exécute pas
            $formError['updateUserSubmit'] = 'Il y a eu un problème veuillez contacter l\'administrateur du site';
        } else { //si la méthode s'exécute, réattribution des nouvelles valeurs (modifiées par l'utilisateur) à la session
            $_SESSION['mail'] = $user->mail;
            $_SESSION['idUserTypes'] = $user->idUserTypes;
        }
    }
}

//-------------modification du mot de passe de l'utilisateur---------------
if (isset($_POST['updatePasswordSubmit'])) { //verification que les données ont été envoyés
    $updateUserPassword = NEW users(); //instanciation de l'objet user pour la modification
    //récupération des valeurs non modifiables par l'utilisateur
    $updateUserPassword->id = $_SESSION['id'];
    $updateUserPassword->username = $_SESSION['username'];
    $updateUserPassword->lastname = $_SESSION['lastname'];
    $updateUserPassword->firstname = $_SESSION['firstname'];
    $updateUserPassword->birthDate = $_SESSION['birthDate'];
    $updateUserPassword->createDate = $_SESSION['createDate'];
    $updateUserPassword->mail = $_SESSION['mail'];
    $updateUserPassword->idUserTypes = $_SESSION['idUserTypes'];
    $getPassword = $updateUserPassword->getUserById(); //appel de la méthode pour récupérer le password de l'user
    /* vérification que le champ oldPassword n'est pas vide et attribution de sa valeur à la variable $oldPassword 
      avec la sécurité htmlspecialchars (évite injection de code) */
    if (!empty($_POST['oldPassword'])) {
        $oldPassword = htmlspecialchars($_POST['oldPassword']);
    } else { //si le champ est vide affichage d'un message d'erreur
        $formError['password'] = 'Veuillez renseigner votre mot de passe actuel';
    }
    if (password_verify($oldPassword, $getPassword->password)) {  //vérification que le mot de passe correspond à celui de l'utilisateur
        //vérification que les champs newPassword et newPasswordVerify ne sont pas vides
        if (!empty($_POST['newPassword']) && !empty($_POST['newPasswordVerify'])) {
            /* vérification que les champs sont identiques 
              et attribution de la nouvelle valeur hachée du mot de passe à l'attribut password de l'objet $updateUserPassword */
            if ($_POST['newPassword'] == $_POST['newPasswordVerify']) {
                $updateUserPassword->password = password_hash($_POST['newPassword'], PASSWORD_DEFAULT);
            } else { //si les champs ne sont pas identiques affichage d'un message d'erreur
                $formError['password'] = 'Les mots de passe ne correspondent pas';
            }
        } else { //si les champs sont vides affichage d'un message d'erreur
            $formError['password'] = 'Veuillez remplir tous les champs';
        }
    } else { //si le mot de passe ne correspond pas à celui de l'utilisateur affichage d'un message d'erreur
        $formError['password'] = 'Le mot de passe actuel est incorrect';
    }
    if (count($formError) == 0) { //s'il n'y a pas d'erreur on appelle la méthode pour la modification d'un utilisateur
        if (!$updateUserPassword->updateProfileUser()) { //affichage d'un message d'erreur si la méthode ne s'exécute pas
            $formError['updatePasswordSubmit'] = 'Il y a eu un problème veuillez contacter l\'administrateur du site';
        } else { //réattribution de la nouvelle valeur du mot de passe à la session
            $_SESSION['password'] = $updateUserPassword->password;
        }
    }
}

//-------------suppression de l'utilisateur---------------
//vérification de la présence de idDelete et qu'il s'agit bien d'un nombre
if (isset($_GET['idDelete']) && is_numeric($_GET['idDelete'])) {
    //instanciation pour la suppression
    $deleteUser = NEW users();
    $deleteUser->id = $_SESSION['id'];
    //appel de la méthode deleteUser() permettant la suppression d'un utilisateur
    $removeUser = $deleteUser->deleteUser();
    if ($removeUser == TRUE) { //si la méthode s'exécute 
        //destruction de toutes les variables de la session
        session_unset();
        //destruction de la session
        session_destroy();
        //redirection vers la page d'inscription
        header('Location: Inscription-utilisateur');
        exit();
    } elseif ($removeUser === FALSE) { //affichage d'un message d'erreur si la requête ne s'est pas exécutée
        $deleteError = 'L\'utilisateur n\'a pas pu être supprimé, veuillez contacter l\'administrateur du site';
    }
}

//écriture des données de session et fermeture de la session 
session_write_close();
