<?php
//insertion de la class database et du model users
include_once path::getClassesPath() . 'database.php';
include_once path::getRootPath() . 'models/users.php';

//instanciation de l'objet user
$user = NEW users();

//sécurisation en vérifiant la présence d'un id dans l'url 
if (isset($_GET['id'])) {
    $user->id = htmlspecialchars($_GET['id']);
}
//appel de la méthode getUserById() permettant l'affichage des infos de l'utilisateur connecté
$profileUser = $user->getUserById();

//vérification de la présence de "action" dans l'url pour la déconnexion
if (isset($_GET['action'])) {
    //si l'utilisateur veut se déconnecter
    if ($_GET['action'] == 'disconnect') {
        //destruction de la session
        session_destroy();
        //redirection de la page vers la page d'accueil
        header('Location: Accueil');
        exit;
    }
}
