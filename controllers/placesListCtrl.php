<?php

//insertion de la class database et du model places
include_once path::getClassesPath() . 'database.php';
include_once path::getModelsPath() . 'places.php';

//instanciation pour l'affichage de la liste des lieux touristiques
$place = NEW places();
$placesList = $place->getPlacesList();
