<?php

include_once path::getClassesPath() . 'database.php';
include_once path::getModelsPath() . 'users.php';

//instanciation de l'objet user
$user = NEW users();
//sécurisation en vérifiant la présence d'un id dans l'url 
if (isset($_GET['id'])) {
    $user->id = htmlspecialchars($_GET['id']);
}

//appel de la méthode getUserById() permettant l'affichage du profil de l'utilisateur connecté
$profileUser = $user->getUserById();
