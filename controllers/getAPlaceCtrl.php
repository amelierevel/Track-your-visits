<?php

include_once path::getClassesPath() . 'database.php';
include_once path::getModelsPath() . 'places.php';

$getPlaceInfo = NEW places();
//vérification de la présence de l'id dans l'url
if (isset($_GET['id'])) {
    $getPlaceInfo->id = $_GET['id'];
}
$placeInfo = $getPlaceInfo->getPlaceById();