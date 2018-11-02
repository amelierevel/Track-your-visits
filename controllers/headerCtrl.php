<?php
include_once 'models/database.php';
include_once 'models/users.php';

//instanciation de l'objet user
$user = NEW users();

//déclaration d'un tableau d'erreur pour la connexion
$errorList = array();
//initialisation d'un message de connection vide
$messageConnection = '';
//vérification de l'envoi du formulaire de connexion
if (isset($_POST['connexionUserSubmit'])) {
    //instanciation de l'objet user
    $user = NEW users();
    //vérification que le champ username n'est pas vide et attribution de sa valeur à l'attribut username de l'objet $user avec la sécurité htmlspecialchars
    if (!empty($_POST['username'])) {
        $user->username = htmlspecialchars($_POST['username']);
        //si le champ est vide affichage d'un message d'erreur
    } else {
        $errorList['username'] = 'Erreur dans la saisie de l\'identifiant';
    }
//vérification que le champ password n'est pas vide et attribution de sa valeur à la variable $password avec la sécurité htmlspecialchars
    if (!empty($_POST['password'])) {
        $password = htmlspecialchars($_POST['password']);
        //si le champ est vide affichage d'un message d'erreur
    } else {
        $errorList['password'] = 'Veuillez indiquer votre mot de passe';
    }

//s'il n'y a pas d'erreur appel de la méthode permettant la connexion de l'utilisateur
    if (count($errorList) == 0) {
        if ($user->connectionUser()) {
            //vérification que le mot de passe correspond à l'utilisateur
            if (password_verify($password, $user->password)) {
                //affichage d'un message de succès
                $messageConnection = 'Connecté avec succès';
                //on rempli la session avec les attributs de l'objet issus de l'hydratation
                $_SESSION['id'] = $user->id;
                $_SESSION['lastname'] = $user->lastname;
                $_SESSION['firstname'] = $user->firstname;
                $_SESSION['username'] = $user->username;
                $_SESSION['isConnect'] = TRUE;
                //redirection de la page vers la page de profil
                header('Location: profile.php?id=' . $user->id);
                //si le mot de passe ne correspond pas affichage d'un message d'erreur
            } else {
                $messageConnection = 'Veuillez vérifier votre nom d\'utilisateur et votre mot de passe';
            }
        }
    }
}

//sécurisation en vérifiant la présence d'un id dans l'url 
if (isset($_GET['id'])) {
    $user->id = $_GET['id'];
}
//appel de la méthode getUserById() permettant l'affichage du profil de l'utilisateur connecté
$profileUser = $user->getUserById();

//vérification de la présence de "action" dans l'url pour la déconnexion
if (isset($_GET['action'])) {
    //si l'utilisateur veut se déconnecter
    if ($_GET['action'] == 'disconnect') {
        //destruction de la session
        session_destroy();
        //redirection de la page vers la page de connexion
        header('Location: registerUserForm.php');
    }
}
