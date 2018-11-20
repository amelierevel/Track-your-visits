<?php

//insertion de la class database et des models categories, regions, departments, cities et places
include_once path::getClassesPath() . 'database.php';
include_once path::getModelsPath() . 'places.php';
include_once path::getModelsPath() . 'priceTypes.php';
include_once path::getModelsPath() . 'prices.php';

//instanciation et appel de la méthode getPlaceById() pour récupérer l'id du lieu
$getPlaceInfo = NEW places();
//vérification de la présence de l'id dans l'url
if (isset($_GET['id'])) {
    $getPlaceInfo->id = $_GET['id'];
}
$placeInfo = $getPlaceInfo->getPlaceById();

//instanciation pour l'affichage de la liste des jours de la semaine
$priceType = NEW priceTypes();
$priceTypesList = $priceType->getPriceTypesList();

$regexPrice = '/^[0-9]+[.]?[0-9]{0,2}$/';
//déclaration d'un tableau d'erreur
$formError = array();

//vérification que les données ont été envoyés
if (isset($_POST['addPricesSubmit'])) {
    //instanciation de l'objet timetable
    $price = NEW prices();
    //attribution de la date du jour au format sql (aaaa-mm-jj hh:mm:ss) à l'attribut editDate de l'objet $timetable
    $price->editDatePrices = date('Y-m-d H:i:s');
    //vérification de la présence d'un id dans l'url et attribution de sa valeur à l'attribut idPlaces de l'objet $timetable
    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        $price->idPlaces = htmlspecialchars($_GET['id']);
    }
    //
    if (!empty($_POST['price'])) {
        if (preg_match($regexPrice, $_POST['price'])) {
            $price->price = htmlspecialchars($_POST['price']);
        } else { //si la valeur n'est pas valide affichage d'un message d'erreur
            $formError['price'] = 'La saisie du tarif est invalide';
        }
    } else { //si le champ est vide affichage d'un message d'erreur
        $formError['price'] = 'Veuillez indiquer un tarif';
    }
    //
    if (!empty($_POST['idPriceTypes'])) {
        //vérification de la validité de chaque valeur (doit être un nombre) et attribution de leurs valeurs à l'attribut idDays de l'objet $timetable avec la sécurité htmlspecialchars (évite injection de code)
        if (is_numeric($_POST['idPriceTypes'])) {
            $price->idPriceTypes = htmlspecialchars($_POST['idPriceTypes']);
        } else { //si chaque valeur n'est pas valide (pas un nombre) affichage d'un message d'erreur
            $formError['idPriceTypes'] = 'Veuillez sélectionner un type de tarif valide';
        }
    } else { //si chaque champ est vide affichage d'un message d'erreur
        $formError['idPriceTypes'] = 'Veuillez sélectionner un type de tarif';
    }
    //vérification que le champ phone n'est pas vide (peut être vide)
    if (!empty($_POST['priceName'])) {
        //vérification de la validité de la valeur et attribution de cette valeur à l'attribut phone de l'objet $place avec la sécurité htmlspecialchars (évite injection de code)
        if (preg_match($regexPhone, $_POST['priceName'])) {
            $price->name = htmlspecialchars($_POST['priceName']);
        } else { //si la valeur n'est pas valide affichage d'un message d'erreur
            $formError['priceName'] = 'La saisie du numéro de téléphone est invalide';
        }
    }
    //s'il n'y a pas d'erreur on appelle la méthode pour l'ajout des horaires après avoir vérifié qu'ils n'existaient pas déjà
    if (count($formError) == 0) {
        //appel de la méthode vérifiant que l'horaire n'existe pas déjà dans la base de données
        $checkExistingPrice = $price->checkIfPriceExist();
        //si la méthode checkIfTimetableExist() retourne 0 le lieu n'existe pas encore et il peut être ajouté à la base de données
        if ($checkExistingPrice === '0') {
            if (!$price->addPrices()) { //affichage d'un message d'erreur si la méthode addTimetable() ne s'exécute pas
                $formError['addPricesSubmit'] = 'Il y a eu un problème veuillez contacter l\'administrateur du site';
            }
            //si la méthode checkIfTimetableExist() retourne false affichage d'un message d'erreur car la requête ne s'est pas exécutée correctement
        } elseif ($checkExistingPrice === FALSE) {
            $formError['addPricesSubmit'] = 'Il y a eu un problème veuillez contacter l\'administrateur du site';
            //sinon la méthode checkIfTimetableExist() retourne 1, l'horaire existe déjà dans la base de données, affichage d'un message d'erreur
        } else {
            $formError['addPricesSubmit'] = 'Ce site touristique a déjà des horaires enregistrés pour ce jour à cette période, veuillez les modifier sur la page du site touristique';
        }
    }
}