<?php

include_once path::getClassesPath() . 'database.php';
include_once path::getModelsPath() . 'categories.php';

//instanciation pour l'affichage de la liste des catégories de sites touristiques
$categorie = NEW categories();
$categoriesList = $categorie->getCategories();
