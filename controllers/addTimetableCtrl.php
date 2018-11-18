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
            //vérification de la validité de chaque valeur (doit être un nombre) et attribution de leurs valeurs à l'attribut idDays de l'objet $timetable avec la sécurité htmlspecialchars (évite injection de code)
            if (is_numeric($_POST['idDays'][$i])) {
                $timetable->idDays = htmlspecialchars($_POST['idDays'][$i]);
            } else { //si chaque valeur n'est pas valide (pas un nombre) affichage d'un message d'erreur
                $formError['idDays'][$i] = 'Veuillez sélectionner un jour valide';
            }
        } else { //si chaque champ est vide affichage d'un message d'erreur
            $formError['idDays'][$i] = 'Veuillez sélectionner un jour';
        }
        //vérification que chaque champ idTimetableTypes n'est pas vide
        if (!empty($_POST['idTimetableTypes'][$i])) {
            //vérification de la validité de chaque valeur (doit être un nombre) et attribution de leurs valeurs à l'attribut idTimetableTypes de l'objet $timetable avec la sécurité htmlspecialchars (évite injection de code)
            if (is_numeric($_POST['idTimetableTypes'][$i])) {
                $timetable->idTimetableTypes = htmlspecialchars($_POST['idTimetableTypes'][$i]);
                //vérification que la période sélectionnée est égale 5 (fermé) et attribution de la valeur NULL aux attributs opening et closing de l'objet $timetable
                if ($_POST['idTimetableTypes'][$i] == 5) {
                    $timetable->opening = NULL;
                    $timetable->closing = NULL;
                } else { //si la période sélectionnée est différente de 5 (fermé)
                    if (!empty($_POST['opening'][$i])) { //vérification que chaque champ opening n'est pas vide
                        //vérification de la validité de chaque valeur et attribution de leurs valeurs à l'attribut opening de l'objet $timetable avec la sécurité htmlspecialchars (évite injection de code)
                        $timetable->opening = htmlspecialchars($_POST['opening'][$i]);
                    } else { //si chaque champ est vide affichage d'un message d'erreur
                        $formError['opening'][$i] = 'Veuillez sélectionner une horaire d\'ouveture';
                    }
                    if (!empty($_POST['closing'][$i])) { //vérification que chaque champ closing n'est pas vide
                        //vérification de la validité de chaque valeur et attribution de leurs valeurs à l'attribut closing de l'objet $timetable avec la sécurité htmlspecialchars (évite injection de code)
                        $timetable->closing = htmlspecialchars($_POST['closing'][$i]);
                    } else { //si chaque champ est vide affichage d'un message d'erreur
                        $formError['closing'][$i] = 'Veuillez sélectionner une horaire de fermeture';
                    }
                }
            } else { //si chaque valeur n'est pas valide (pas un nombre) affichage d'un message d'erreur
                $formError['idTimetableTypes'][$i] = 'Veuillez sélectionner une période horaire valide';
            }
        } else { //si chaque champ est vide affichage d'un message d'erreur
            $formError['idTimetableTypes'][$i] = 'Veuillez sélectionner une période horaire';
        }
        var_dump($formError);
        //s'il n'y a pas d'erreur on appelle la méthode pour l'ajout des horaires après avoir vérifié qu'ils n'existaient pas déjà
        if (count($formError) == 0) {
            echo 'poule';
            //appel de la méthode vérifiant que l'horaire n'existe pas déjà dans la base de données
            $checkExistingTimetable = $timetable->checkIfTimetableExist();
            //si la méthode checkIfTimetableExist() retourne 0 le lieu n'existe pas encore et il peut être ajouté à la base de données
            if ($checkExistingTimetable === '0') {
                echo 'banana';
                if (!$timetable->addTimetable()) { //affichage d'un message d'erreur si la méthode addTimetable() ne s'exécute pas
                    $formError['addTimetablesSubmit'] = 'Il y a eu un problème veuillez contacter l\'administrateur du site';
                }
                //si la méthode checkIfTimetableExist() retourne false affichage d'un message d'erreur car la requête ne s'est pas exécutée correctement
            } elseif ($checkExistingTimetable === FALSE) {
                echo 'raton';
                $formError['addTimetablesSubmit'] = 'Il y a eu un problème veuillez contacter l\'administrateur du site';
                //sinon la méthode checkIfTimetableExist() retourne 1, l'horaire existe déjà dans la base de données, affichage d'un message d'erreur
            } else {
                echo 'baleine';
                $formError['timetableExist'][$i] = 'Ce site touristique a déjà des horaires enregistrés pour ce jour à cette période, veuillez les modifier sur la page du site touristique';
            }
        }
    }
}    