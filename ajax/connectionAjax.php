<?php
//démarrage de la session
session_start();
//insertion du fichier path, de la class database et du model users
include_once '../classes/path.php';
include_once path::getClassesPath() . 'database.php';
include_once path::getModelsPath() . 'users.php';

//initialisation de la variable $successConnection avec la valeur FALSE
$successConnection = FALSE;
//initialisation de la variable $errorMessage avec la valeur FALSE (paragraphe dans la vue sera hide)
$errorMessage = FALSE;

//vérification que le champ username n'est pas vide et attribution de sa valeur à la variable $username avec la sécurité htmlspecialchars
if (!empty($_POST['username'])) {
    $username = htmlspecialchars($_POST['username']);
} else { //si le champ est vide affichage d'un message d'erreur (paragraphe dans la vue sera show)
    $errorMessage = TRUE;
}
//vérification que le champ password n'est pas vide et attribution de sa valeur à la variable $password avec la sécurité htmlspecialchars
if (!empty($_POST['password'])) {
    $password = htmlspecialchars($_POST['password']);
} else { //si le champ est vide affichage d'un message d'erreur (paragraphe dans la vue sera show)
    $errorMessage = TRUE;
}
//s'il n'y a pas d'erreur appel de la méthode connectionUser() permettant la connexion de l'utilisateur
if ($errorMessage == FALSE) {
    //instanciation de l'objet user
    $user = NEW users();
    $user->username = $username;
    if ($user->connectionUser()) {
        //vérification que le mot de passe correspond à celui de l'utilisateur
        if (password_verify($password, $user->password)) {
            //on rempli la session avec les attributs de l'objet issus de l'hydratation
            $_SESSION['id'] = $user->id;
            $_SESSION['lastname'] = $user->lastname;
            $_SESSION['firstname'] = $user->firstname;
            $_SESSION['username'] = $user->username;
            $_SESSION['birthDate'] = $user->birthDate;
            $_SESSION['createDate'] = $user->createDate;
            $_SESSION['mail'] = $user->mail;
            $_SESSION['idUserTypes'] = $user->idUserTypes;
            $_SESSION['password'] = $user->password;
            $_SESSION['name'] = $user->name;
            $_SESSION['isConnect'] = TRUE;
            $successConnection = TRUE;
        } else { //si le mot de passe ne correspond pas, affichage du message d'erreur
            $errorMessage = TRUE;
        }
    }
}

//lien avec l'ajax
echo json_encode(array('errorMessage' => $errorMessage, 'successConnection' => $successConnection));
