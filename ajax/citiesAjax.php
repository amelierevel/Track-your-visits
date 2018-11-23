<?php

//démarrage de la session
session_start();
//insertion du fichier path, de la class database et du model users
include_once '../classes/path.php';
include_once path::getClassesPath() . 'database.php';
include_once path::getModelsPath() . 'cities.php';
include_once path::getModelsPath() . 'places.php';

//déclaration de la regex code postal
$regexPostalCode = '/^[0-9]+$/';
//déclaration d'un tableau d'erreur
$formError = array();
$citiesResearch=array();
//vérification que le champ postalCode n'est pas vide 
if (!empty($_POST['postalCode'])) {
    $city = NEW cities();
    //vérification de la validité de la valeur et attribution de cette valeur à la variable $postalCode avec la sécurité htmlspecialchars (évite injection de code)
    if (preg_match($regexPostalCode, $_POST['postalCode'])) {
        $postalCode = htmlspecialchars($_POST['postalCode']);
        $city->postalCode = $postalCode;
        $citiesResearch = $city->getCitiesListByPostalCode();
    } else { //si la valeur n'est pas valide affichage d'un message d'erreur
        $formError['postalCode'] = 'La saisie du code postal est invalide';
    }
} else { //si le champ est vide affichage d'un message d'erreur
    $formError['postalCode'] = 'Veuillez indiquer un code postal';
}

echo json_encode($citiesResearch);
