<?php

session_start();

include_once '../classes/path.php';
include_once path::getClassesPath() . 'database.php';
include_once path::getModelsPath() . 'users.php';

//déclaration d'un tableau d'erreur pour la connexion
$errorList = array();
//initialisation de la variable $success avec la valeur FALSE
$success = FALSE;
//initialisation de la variable $errorMessage avec la valeur FALSE
$errorMessage = FALSE;

//vérification que le champ username n'est pas vide et attribution de sa valeur à l'attribut username de l'objet $user avec la sécurité htmlspecialchars
if (!empty($_POST['username'])) {
    $username = htmlspecialchars($_POST['username']);
    //si le champ est vide affichage d'un message d'erreur
} else {
    $errorMessage = TRUE;
}
//vérification que le champ password n'est pas vide et attribution de sa valeur à la variable $password avec la sécurité htmlspecialchars
if (!empty($_POST['password'])) {
    $password = htmlspecialchars($_POST['password']);
    //si le champ est vide affichage d'un message d'erreur
} else {
    $errorMessage = TRUE;
}

//s'il n'y a pas d'erreur appel de la méthode permettant la connexion de l'utilisateur
if ($errorMessage == FALSE) {
    //instanciation de l'objet user
    $user = NEW users();
    $user->username = $username;
    if ($user->connectionUser()) {
        //vérification que le mot de passe correspond à l'utilisateur
        if (password_verify($password, $user->password)) {
            //on rempli la session avec les attributs de l'objet issus de l'hydratation
            $_SESSION['id'] = $user->id;
            $_SESSION['lastname'] = $user->lastname;
            $_SESSION['firstname'] = $user->firstname;
            $_SESSION['username'] = $user->username;
            $_SESSION['isConnect'] = TRUE;
            $success = TRUE;
            //redirection de la page vers la page de profil
       //      header('Location: profile.php?id=' . $user->id);
            //si le mot de passe ne correspond pas affichage d'un message d'erreur
        } else {
            $errorMessage = TRUE;
        }
    }
}

//lien avec l'ajax
echo json_encode(array('errorMessage' => $errorMessage, 'success' => $success));
