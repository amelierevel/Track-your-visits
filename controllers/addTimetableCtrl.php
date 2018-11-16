<?php

//insertion de la class database et des models categories, regions, departments, cities et places
include_once path::getClassesPath() . 'database.php';
include_once path::getModelsPath() . 'places.php';
include_once path::getModelsPath() . 'days.php';
include_once path::getModelsPath() . 'timetableTypes.php';
include_once path::getModelsPath() . 'timetables.php';

//instanciation et appel de la méthode getPlaceById() pour récupérer l'id du lieu
$getPlaceInfo = NEW places();
//vérification de la présence de l'id dans l'url
if (isset($_GET['id'])) {
    $getPlaceInfo->id = $_GET['id'];
}
$placeInfo = $getPlaceInfo->getPlaceById();

//instanciation pour l'affichage de la liste des jours de la semaine
$day = NEW days();
$daysList = $day->getDaysList();

//instanciation pour l'affichage de la liste des périodes horaires (timetableTypes)
$timetableType = NEW timetableTypes();
$timetableTypesList = $timetableType->getTimetableTypesList();

//déclaration d'un tableau d'erreur
$formError = array();

//vérification que les données ont été envoyés
if (isset($_POST['addTimetablesSubmit'])) {
    //instanciation de l'objet timetable
    $timetable = NEW timetables();
    //attribution de la date du jour au format sql (aaaa-mm-jj hh:mm:ss) à l'attribut editDate de l'objet $timetable
    $timetable->editDate = date('Y-m-d H:i:s');
    //vérification de la présence d'un id dans l'url et attribution de sa valeur à l'attribut idPlaces de l'objet $timetable
    if (isset($_GET['id'])) {
        $timetable->idPlaces = htmlspecialchars($_GET['id']);
    }
    //calcul du nombre de lignes d'ajout d'horaire (longueur du tableau)
    $arrayTimetableSize = count($_POST['idDays']);
    //boucle for permettant de faire l'enregistrement de chaque ligne d'ajout d'horaire
    for ($i = 0; $i < $arrayTimetableSize; $i++) {
        //vérification que chaque champ idDays n'est pas vide
        if (!empty($_POST['idDays'][$i])) {
            //vérification 
            if (is_numeric($_POST['idDays'][$i])) {
                $timetable->idDays = htmlspecialchars($_POST['idDays'][$i]);
            } else {
                $formError['idDays'][$i] = 'Veuillez sélectionner un jour valide';
            }
        } else {
            $formError['idDays'][$i] = 'Veuillez sélectionner un jour';
        }
        //
        if (!empty($_POST['idTimetableTypes'][$i])) {
            if (is_numeric($_POST['idTimetableTypes'][$i])) {
                $timetable->idTimetableTypes = htmlspecialchars($_POST['idTimetableTypes'][$i]);
            } else {
                $formError['idTimetableTypes'][$i] = 'Veuillez sélectionner une période horaire valide';
            }
        } else {
            $formError['idTimetableTypes'][$i] = 'Veuillez sélectionner une période horaire';
        }
        //
        //vérification que le champ opening n'est pas vide
        if (!empty($_POST['opening'][$i])) {
            //vérification de la validité de la valeur et attribution de sa valeur à l'attribut opening de l'objet $timetable avec la sécurité htmlspecialchars (évite injection de code)
            $timetable->opening = htmlspecialchars($_POST['opening'][$i]);
        } else {
            $formError['opening'][$i] = 'Veuillez sélectionner une horaire d\'ouveture';
        }
        //vérification que le champ closing n'est pas vide
        if (!empty($_POST['closing'][$i])) {
            //vérification de la validité de la valeur et attribution de sa valeur à l'attribut closing de l'objet $timetable avec la sécurité htmlspecialchars (évite injection de code)
            $timetable->closing = htmlspecialchars($_POST['closing'][$i]);
        } else {
            $formError['closing'][$i] = 'Veuillez sélectionner une horaire de fermeture';
        }
        //******
        var_dump($_POST);

        if (count($formError) == 0) {
            if (!$timetable->addTimetable()) {
                $formError['addTimetablesSubmit'] = 'Il y a eu un problème veuillez contacter l\'administrateur du site';
            }
        }
    }
}
