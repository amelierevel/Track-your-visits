<?php
include_once 'models/database.php';
include_once 'models/users.php';

//instanciation de l'objet user
$user = NEW users();
//sécurisation en vérifiant la présence d'un id dans l'url 
if (isset($_GET['id'])) {
    $user->id = $_GET['id'];
}
//appel de la méthode getUserById() permettant l'affichage du profil de l'utilisateur connecté
$profileUser = $user->getUserById();

//vérification de la présence de "action" dans l'url
if (isset($_GET['action'])) {
    //si l'utilisateur veut se déconnecter
    if ($_GET['action'] == 'disconnect') {
        //destruction de la session
        session_destroy();
        //redirection de la page vers la page de connexion
        header('Location: connexion.php');
    }
}
