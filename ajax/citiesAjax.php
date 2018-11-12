<?php

include_once '../classes/path.php';
include_once path::getClassesPath() . 'database.php';
include_once path::getModelsPath() . 'cities.php';

//initialisation de la variable $successFindCities avec la valeur FALSE
$successFindCities = FALSE;
//
$formError = array();

//
if (!empty($_POST['postalCode'])) {
    //attribution de la valeur du champ à l'attribut postalCode de l'objet $city avec la sécurité htmlspecialchars (évite injection de code)
    $postalCode = htmlspecialchars($_POST['postalCode']);
//appel de la méthode permettant d'afficher la liste des villes correspondant au code postal entré
    $citiesList = $city->getCitiesListByPostalCode();
} else {
     $formError['postalCode'] = 'Veuillez sélectionner un type d\'utilisateur';
}
//vérification que le champ idCities n'est pas vide
if (!empty($_POST['idCities'])) {
    //vérification de la validité de la valeur (doit être un nombre) et attribution de sa valeur à l'attribut idUserTypes de l'objet $user avec la sécurité htmlspecialchars (évite injection de code)
    if (is_numeric($_POST['idCities'])) {
        $place->idCities = htmlspecialchars($_POST['idCities']);
        //si la valeur n'est pas valide (pas un nombre) affichage d'un message d'erreur
    } else {
        $formError['idCities'] = 'Veuillez sélectionner un type d\'utilisateur valide';
    }
    //si le champ est vide affichage d'un message d'erreur
} else {
    $formError['idCities'] = 'Veuillez sélectionner un type d\'utilisateur';
}

//lien avec le script de l'ajax
echo json_encode(array('successFindCities' => $successFindCities, 'formError' => $formError));
