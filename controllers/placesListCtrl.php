<?php
//insertion de la class database et des models categories, regions, departments, cities et places
include_once path::getClassesPath() . 'database.php';
include_once path::getModelsPath() . 'places.php';

$place = NEW places();
$placesList = $place->getPlacesList();