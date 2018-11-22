<?php

//insertion de la class database et des models cities et places
include_once path::getClassesPath() . 'database.php';
include_once path::getModelsPath() . 'cities.php';
include_once path::getModelsPath() . 'places.php';

//-------------Recherche de lieu par nom----------
//vérification que les données ont été envoyés
if (isset($_POST['searchPlaceSubmit'])) {
    //instanciation pour l'affichage du résultat de la recherche
    $placeNameSearch = NEW places();
    //vérification que le champ searchName n'est pas vide
    if (!empty($_POST['searchName'])) {
        //attribution de la valeur à l'attribut searchName (créé dans la méthode) de l'objet $placeNameSearch avec la sécurité htmlspecialchars
        $placeNameSearch->searchName = htmlspecialchars($_POST['searchName']);
    } else { //si le champ est vide affichage d'un message d'erreur
        $errorMessage = 'Veuillez remplir le champ pour faire une recherche';
    }
    $placesFindList = $placeNameSearch->searchPlaces();
}

//--------------Affichage des lieux avec la pagination-----------
//déclaration de la variable indiquant le nombre de lieux par page (notre choix)
$limit = 10;
//instanciation de l'objet $place pour l'affichage de la liste des lieux et la pagination
$place = NEW places();
//appel de la méthode countPlaces() indiquant le nombre de lieux
$numberOfResult = $place->countPlaces();
//calcul du nombre de pages total (ceil pour arrondir à l'entier supérieur pour ajouter une page de plus)
$totalPages = ceil($numberOfResult->placesNumber / $limit);
//vérification de la présence de "page" dans l'url et qu'il n'est pas vide
if (!empty($_GET['page'])) {
    //si ce n'est pas un nombre ou qu'il est supérieur au nombre total de page ou qu'il est inférieur à 0, attribution de la valeur 1 à la variable $page
    if (!is_numeric($_GET['page']) || $_GET['page'] > $totalPages || $_GET['page'] <= 0) {
        $page = 1;
    } else { //si tout va bien attribution de la valeur de la page à la variable $page
        $page = $_GET['page'];
    }
} else { //si $_GET['page'] est vide on lui attribue la valeur 1
    $page = 1;
}
//calcul du premier élément de chaque page (on calcule le nombre de resultat qu'on ne prend pas en compte)
$offset = ($page - 1) * $limit;
//appel de la méthode pagingPlaces() prenant pour paramètres les variables $limit et $offset permettant l'affichage du nombre de notre de choix de lieux par page
$pagingPlacesList = $place->pagingPlaces($limit, $offset);

