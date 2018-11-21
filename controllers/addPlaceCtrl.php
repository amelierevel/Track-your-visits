<?php

//insertion de la class database et des models categories, cities et places
include_once path::getClassesPath() . 'database.php';
include_once path::getModelsPath() . 'categories.php';
include_once path::getModelsPath() . 'cities.php';
include_once path::getModelsPath() . 'places.php';

//instanciation pour l'affichage de la liste des catégories de lieus
$categorie = NEW categories();
$categoriesList = $categorie->getCategoriesList();

//instanciation pour l'affichage de la liste des villes
$city = NEW cities();
$citiesList = $city->getCitiesList();

//déclaration de la regex code postal
$regexPostalCode = '/^[0-9]{5}$/';
//déclaration de la regex téléphone
$regexPhone = '/^[0][1-9][0-9]{8}$/';
//déclaration d'un tableau d'erreur
$formError = array();

//vérification que les données ont été envoyés
if (isset($_POST['addPlaceSubmit'])) {
    //instanciation de l'objet place
    $place = NEW places();
    //vérification que le champ placeName n'est pas vide et attribution de sa valeur à l'attribut name de l'objet $place avec la sécurité htmlspecialchars (évite injection de code)
    if (!empty($_POST['placeName'])) {
        $place->name = htmlspecialchars($_POST['placeName']);
    } else { //si le champ est vide affichage d'un message d'erreur
        $formError['placeName'] = 'Veuillez indiquer un nom pour le lieu';
    }
    //vérification que le champ idCategories n'est pas vide 
    if (!empty($_POST['idCategories'])) {
        //vérification de la validité de la valeur (doit être un nombre) et attribution de sa valeur à l'attribut idCategories de l'objet $place avec la sécurité htmlspecialchars (évite injection de code)
        if (is_numeric($_POST['idCategories'])) {
            $place->idCategories = htmlspecialchars($_POST['idCategories']);
        } else { //si la valeur n'est pas valide (pas un nombre) affichage d'un message d'erreur
            $formError['idCategories'] = 'Veuillez sélectionner une catégorie valide';
        }
    } else { //si le champ est vide affichage d'un message d'erreur
        $formError['idCategories'] = 'Veuillez indiquer une catégorie';
    }
    //vérification que le champ postalCode n'est pas vide 
    if (!empty($_POST['postalCode'])) {
        //vérification de la validité de la valeur et attribution de cette valeur à la variable $postalCode avec la sécurité htmlspecialchars (évite injection de code)
        if (preg_match($regexPostalCode, $_POST['postalCode'])) {
            $postalCode = htmlspecialchars($_POST['postalCode']);
        } else { //si la valeur n'est pas valide affichage d'un message d'erreur
            $formError['postalCode'] = 'La saisie du code postal est invalide';
        }
    } else { //si le champ est vide affichage d'un message d'erreur
        $formError['postalCode'] = 'Veuillez indiquer un code postal';
    }
    //vérification que le champ idCities n'est pas vide
    if (!empty($_POST['idCities'])) {
        //vérification de la validité de la valeur (doit être un nombre) et attribution de sa valeur à l'attribut idCities de l'objet $place avec la sécurité htmlspecialchars (évite injection de code)
        if (is_numeric($_POST['idCities'])) {
            $place->idCities = htmlspecialchars($_POST['idCities']);
        } else { //si la valeur n'est pas valide (pas un nombre) affichage d'un message d'erreur
            $formError['idCities'] = 'Veuillez sélectionner une ville valide';
        }
    } else { //si le champ est vide affichage d'un message d'erreur
        $formError['idCities'] = 'Veuillez sélectionner une ville';
    }
    //vérification que le champ address n'est pas vide 
    if (!empty($_POST['address'])) {
        //attribution de sa valeur à l'attribut address de l'objet $place avec la sécurité htmlspecialchars (évite injection de code)
        $place->address = htmlspecialchars($_POST['address']);
    } else { //si le champ est vide affichage d'un message d'erreur
        $formError['address'] = 'Veuillez indiquer une adresse';
    }
    //vérification que le champ phone n'est pas vide (peut être vide)
    if (!empty($_POST['phone'])) {
        //vérification de la validité de la valeur et attribution de cette valeur à l'attribut phone de l'objet $place avec la sécurité htmlspecialchars (évite injection de code)
        if (preg_match($regexPhone, $_POST['phone'])) {
            $place->phone = htmlspecialchars($_POST['phone']);
        } else { //si la valeur n'est pas valide affichage d'un message d'erreur
            $formError['phone'] = 'La saisie du numéro de téléphone est invalide';
        }
    }
    /* vérification que le champ mail n'est pas vide (peut être vide) et 
     * vérification de la validité du mail avec un filtre puis
     * attribution de sa valeur à l'attribut mail de l'objet $place avec la sécurité htmlspecialchars (évite injection de code)
     */
    if (!empty($_POST['mail'])) {
        if (filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)) {
            $place->mail = htmlspecialchars($_POST['mail']);
        } else { //si la valeur n'est pas valide affichage d'un message d'erreur
            $formError['mail'] = 'La saisie du mail est invalide';
        }
    }
    /* vérification que le champ website n'est pas vide (peut être vide) et 
     * vérification de la validité du website avec un filtre puis
     * attribution de sa valeur à l'attribut website de l'objet $place avec la sécurité htmlspecialchars (évite injection de code)
     */
    if (!empty($_POST['website'])) {
        if (filter_var($_POST['website'], FILTER_VALIDATE_URL)) {
            $place->website = htmlspecialchars($_POST['website']);
        } else { //si la valeur n'est pas valide affichage d'un message d'erreur
            $formError['website'] = 'La saisie du site web est invalide';
        }
    }
    //vérification que le champ description n'est pas vide et attribution de sa valeur à l'attribut description de l'objet $place avec la sécurité htmlspecialchars (évite injection de code)
    if (!empty($_POST['description'])) {
        $place->description = htmlspecialchars($_POST['description']);
    } else { //si le champ est vide affichage d'un message d'erreur
        $formError['description'] = 'Veuillez renseigner une description du lieu';
    }
    //s'il n'y a pas d'erreur on appelle la méthode pour l'ajout d'un lieu après avoir vérifié qu'il n'existe pas déjà
    if (count($formError) == 0) {
        //attribution de la date du jour au format sql (aaaa-mm-jj hh:mm:ss) à l'attribut createDate de l'objet $place
        $place->createDate = date('Y-m-d H:i:s');
        //appel de la méthode vérifiant que le lieu n'existe pas déjà dans la base de données
        $checkExistingPlace = $place->checkIfPlaceExist();
        //si la méthode checkIfPlaceExist() retourne 0 le lieu n'existe pas encore et il peut être ajouté à la base de données
        if ($checkExistingPlace === '0') {
            if (!$place->addPlace()) { //affichage d'un message d'erreur si la méthode addPlace() ne s'exécute pas
                $formError['addPlaceSubmit'] = 'Il y a eu un problème veuillez contacter l\'administrateur du site';
            } 
        } elseif ($checkExistingPlace === FALSE) { //si la méthode checkIfPlaceExist() retourne false affichage d'un message d'erreur car la requête ne s'est pas exécutée correctement
            $formError['addPlaceSubmit'] = 'Il y a eu un problème veuillez contacter l\'administrateur du site';
        } else { //sinon la méthode checkIfPlaceExist() retourne 1, le lieu existe déjà dans la base de données, affichage d'un message d'erreur
            $formError['placeName'] = 'Ce site touristique existe déjà';
        }
    }
    //instanciation pour récupérer l'id du dernier lieu ajouté
    $addedPlace = NEW places();
    $lastInsertIdPlace = $addedPlace->getLastInsertIdPlace();
}
