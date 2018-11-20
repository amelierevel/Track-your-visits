<?php

//démarrage de la session
session_start();
//insertion de la class database et du model visitedPlaces
include_once path::getClassesPath() . 'database.php';
include_once path::getModelsPath() . 'visitedPlaces.php';

//instanciation pour l'affichage des informations des lieux visités
$visitedPlaces = NEW visitedPlaces();
$visitedPlaces->idUsers = $_SESSION['id']; //attribution de la valeur de l'id de la session à l'attribut idUsers de l'objet $visitedPlaces
$visitedPlacesList = $visitedPlaces->getVisitedPlacesListByUser(); //appel de la méthode permettant l'affichage des lieux visités

//---------------------Suppression d'un lieu visité------------
//vérification de la présence de idPlaceDelete et qu'il s'agit bien d'un nombre
if (isset($_GET['idPlaceDelete']) && is_numeric($_GET['idPlaceDelete'])) {
    //instanciation pour la suppression
    $deleteVisitedPlace = NEW visitedPlaces();
    $deleteVisitedPlace->id = htmlspecialchars($_GET['idPlaceDelete']);
    //appel de la méthode deleteVisitedPlaces() permettant la suppression d'un lieu visité d'un utilisateur
    $removeVisitedPlace = $deleteVisitedPlace->deleteVisitedPlaces();
    if ($removeVisitedPlace == TRUE) { //si la méthode s'exécute 
    //redirection vers la page des lieux visités de l'utilisateur
        header('Location: Mes-visites');
        exit();
    } elseif ($removeVisitedPlace === FALSE) { //affichage d'un message d'erreur si la requête ne s'est pas exécutée
        $deleteError = 'Le lieu visité n\'a pas pu être supprimé, veuillez contacter l\'administrateur du site';
    }
}
//écriture des données de session et fermeture de la session
session_write_close();
