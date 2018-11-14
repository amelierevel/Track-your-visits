<?php
//insertion de la class database et du model users
include_once path::getClassesPath() . 'database.php';
include_once path::getRootPath() . 'models/users.php';

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
