<?php

include_once path::getClassesPath() . 'database.php';
include_once path::getModelsPath() . 'users.php';

//instanciation de l'objet user
$user = NEW users();
//sécurisation en vérifiant la présence d'un id dans l'url 
if (isset($_GET['id'])) {
    $user->id = htmlspecialchars($_GET['id']);
}

//suppression de l'utilisateur
if (isset($_GET['idDelete']) && is_numeric($_GET['idDelete'])) {
    $deleteUser =NEW users();
    $deleteUser->id = htmlspecialchars($_GET['idDelete']);
    if ($removeUser = $deleteUser->deleteUser()) {
        //faire detruire la session ????????????????????!!!!!!!!!!!!!!!!!!!!!!!!
        header('Location: registerUserForm.php');
        exit;
    }
    // à revoir ça marche pas
    if ($removeUser === FALSE) {
        $deleteError = 'L\'utilisateur n\'a pas pu être supprimé.';
    }
    // fin du à revoir
}

//appel de la méthode getUserById() permettant l'affichage du profil de l'utilisateur connecté
$profileUser = $user->getUserById();
//redirection vers la page d'inscription si l'id dans l'url n'existe pas 
if ($profileUser === FALSE) {
    header('Location: registerUserForm.php');
    exit;
}