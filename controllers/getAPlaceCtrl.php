<?php

//insertion de la class database et du model places
include_once path::getClassesPath() . 'database.php';
include_once path::getModelsPath() . 'places.php';

//instanciation pour l'affichage des informations d'un site touristique
$getPlaceInfo = NEW places();
//vérification de la présence de l'id dans l'url
if (isset($_GET['id'])) {
    $getPlaceInfo->id = $_GET['id'];
}
//appel de la méthode permettant l'affichage des informations d'un site touristique
$placeInfo = $getPlaceInfo->getPlaceById();
