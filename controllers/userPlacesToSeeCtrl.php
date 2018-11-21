<?php

//démarrage de la session
session_start();
//insertion de la class database et du model placesToSee
include_once path::getClassesPath() . 'database.php';
include_once path::getModelsPath() . 'placesToSee.php';

//instanciation pour l'affichage des informations des lieux à voir
$placesToSee = NEW placesToSee();
$placesToSee->idUsers = $_SESSION['id']; //attribution de la valeur de l'id de la session à l'attribut idUsers de l'objet $placeToSee 
$placesToSeeList = $placesToSee->getPlacesToSeeListByUser(); //appel de la méthode permettant l'affichage des lieux à voir 

//---------------------Suppression d'un lieu à voir------------
//vérification de la présence de idPlaceDelete et qu'il s'agit bien d'un nombre
if (isset($_GET['idPlaceDelete']) && is_numeric($_GET['idPlaceDelete'])) {
    //instanciation pour la suppression
    $deletePlaceToSee = NEW placesToSee();
    $deletePlaceToSee->id = htmlspecialchars($_GET['idPlaceDelete']);
    //appel de la méthode deletePlaceToSee() permettant la suppression d'un lieu à voir d'un utilisateur
    $removePlaceToSee = $deletePlaceToSee->deletePlaceToSee();
    if ($removePlaceToSee == TRUE) { //si la méthode s'exécute redirection vers la page des lieux à voir de l'utilisateur
        header('Location: A-voir');
        exit();
    } elseif ($removePlaceToSee === FALSE) { //affichage d'un message d'erreur si la requête ne s'est pas exécutée
        $deleteError = 'Le lieu à voir n\'a pas pu être supprimé, veuillez contacter l\'administrateur du site';
    }
}
//écriture des données de session et fermeture de la session
session_write_close();
