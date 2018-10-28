<?php

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
