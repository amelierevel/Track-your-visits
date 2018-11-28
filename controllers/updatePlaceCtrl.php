<?php

//insertion de la class database et des models categories et places
include_once path::getClassesPath() . 'database.php';
include_once path::getModelsPath() . 'categories.php';
include_once path::getModelsPath() . 'places.php';

//instanciation pour l'affichage de la liste des catégories de lieux
$categorie = NEW categories();
$categoriesList = $categorie->getCategoriesList();

//instanciation pour l'affichage des informations du lieu
$getPlaceInfo = NEW places();

//vérification de la présence de l'id du lieu dans l'url et qu'il s'agit d'un nombre puis attribution de sa valeur à l'attribut id de l'objet $getPlaceInfo avec la sécurité htmlspecialchars
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $getPlaceInfo->id = htmlspecialchars($_GET['id']);
}
//appel de la méthode permettant l'affichage des informations d'un lieu
$placeInfo = $getPlaceInfo->getPlaceById();

//déclaration de la regex téléphone
$regexPhone = '/^[0][1-9][0-9]{8}$/';
//déclaration d'un tableau d'erreur
$formError = array();

//vérification que les données ont été envoyés
if (isset($_POST['updatePlaceSubmit'])) {
    //instanciation de l'objet $updatePlace
    $updatePlace = NEW places();
    //récupération des informations qui ne peuvent pas être modifiées par l'utilisateur
    $updatePlace->id = $placeInfo->id;
    $updatePlace->name = $placeInfo->name;
    $updatePlace->address = $placeInfo->address;
    $updatePlace->idCities = $placeInfo->idCities;
    $updatePlace->createDate = $placeInfo->createDate;
    //vérification que le champ idCategories n'est pas vide 
    if (!empty($_POST['idCategories'])) {
        //vérification de la validité de la valeur (doit être un nombre) et attribution de sa valeur à l'attribut idCategories de l'objet $updatePlace avec la sécurité htmlspecialchars (évite injection de code)
        if (is_numeric($_POST['idCategories'])) {
            $updatePlace->idCategories = htmlspecialchars($_POST['idCategories']);
        } else { //si la valeur n'est pas valide (pas un nombre) affichage d'un message d'erreur
            $formError['idCategories'] = 'Veuillez sélectionner une catégorie valide';
        }
    } else { //si le champ est vide affichage d'un message d'erreur
        $formError['idCategories'] = 'Veuillez indiquer une catégorie';
    }
    //vérification que le champ phone n'est pas vide (peut être vide)
    if (!empty($_POST['phone'])) {
        //vérification de la validité de la valeur et attribution de cette valeur à l'attribut phone de l'objet $updatePlace avec la sécurité htmlspecialchars (évite injection de code)
        if (preg_match($regexPhone, $_POST['phone'])) {
            $updatePlace->phone = htmlspecialchars($_POST['phone']);
        } else { //si la valeur n'est pas valide affichage d'un message d'erreur
            $formError['phone'] = 'La saisie du numéro de téléphone est invalide';
        }
    }
    /* vérification que le champ mail n'est pas vide (peut être vide) et 
     * vérification de la validité du mail avec un filtre puis
     * attribution de sa valeur à l'attribut mail de l'objet $updatePlace avec la sécurité htmlspecialchars (évite injection de code)
     */
    if (!empty($_POST['mail'])) {
        if (filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)) {
            $updatePlace->mail = htmlspecialchars($_POST['mail']);
        } else { //si la valeur n'est pas valide affichage d'un message d'erreur
            $formError['mail'] = 'La saisie du mail est invalide';
        }
    }
    /* vérification que le champ website n'est pas vide (peut être vide) et 
     * vérification de la validité du website avec un filtre puis
     * attribution de sa valeur à l'attribut website de l'objet $updatePlace avec la sécurité htmlspecialchars (évite injection de code)
     */
    if (!empty($_POST['website'])) {
        if (filter_var($_POST['website'], FILTER_VALIDATE_URL)) {
            $updatePlace->website = htmlspecialchars($_POST['website']);
        } else { //si la valeur n'est pas valide affichage d'un message d'erreur
            $formError['website'] = 'La saisie du site web est invalide';
        }
    }
    //vérification que le champ description n'est pas vide et attribution de sa valeur à l'attribut description de l'objet $updatePlace avec la sécurité htmlspecialchars (évite injection de code)
    if (!empty($_POST['description'])) {
        $updatePlace->description = htmlspecialchars($_POST['description']);
    } else { //si le champ est vide affichage d'un message d'erreur
        $formError['description'] = 'Veuillez renseigner une description du lieu';
    }
    //s'il n'y a pas d'erreur on appelle la méthode pour l'ajout d'un lieu après avoir vérifié qu'il n'existe pas déjà
    if (count($formError) == 0) {
        if (!$updatePlace->updatePlace()) { //affichage d'un message d'erreur si la méthode addPlace() ne s'exécute pas
            $formError['updatePlaceSubmit'] = 'Il y a eu un problème veuillez contacter l\'administrateur du site';
        }
    }
}
