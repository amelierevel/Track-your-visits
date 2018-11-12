<?php

include_once path::getClassesPath() . 'database.php';
include_once path::getModelsPath() . 'categories.php';
include_once path::getModelsPath() . 'regions.php';
include_once path::getModelsPath() . 'departments.php';
include_once path::getModelsPath() . 'cities.php';
include_once path::getModelsPath() . 'places.php';

//instanciation pour l'affichage de la liste des catégories de sites touristiques
$categorie = NEW categories();
$categoriesList = $categorie->getCategories();

//instanciation pour l'affichage de la liste des départements
$department = NEW departments();
$departmentsList = $department->getDepartmentsList();

//instanciation pour l'affichage de la liste des régions
$region = NEW regions();
$regionsList = $region->getRegionsList();

//instanciation pour l'affichage de la liste des villes
$city = NEW cities();
$citiesList = $city->getCitiesList();

//déclaration de la regex code postal
$regexPostalCode = '/^[0-9]{5}$/';
//déclaration de la regex téléphone
$regexPhone = '/^[0][1-9][0-9]{8}$/';
//déclaration d'un tableau d'erreur
$formError = array();

//---------------------formulaire d'ajout d'un lieu partie "Informations générales"--------------------
//vérification que les données ont été envoyés
if (isset($_POST['addPlaceSubmit'])) {
    //instanciation de l'objet place
    $place = NEW places();
    //vérification que le champ placeName n'est pas vide 
    if (!empty($_POST['placeName'])) {
        //attribution de sa valeur à l'attribut name de l'objet $place avec la sécurité htmlspecialchars (évite injection de code)
        $place->name = htmlspecialchars($_POST['placeName']);
        //si le champ est vide affichage d'un message d'erreur
    } else {
        $formError['placeName'] = 'Veuillez indiquer un nom pour le site touristique';
    }
    //vérification que le champ idCategories n'est pas vide 
    if (!empty($_POST['idCategories'])) {
        //vérification de la validité de la valeur (doit être un nombre) et attribution de sa valeur à l'attribut idCategories de l'objet $place avec la sécurité htmlspecialchars (évite injection de code)
        if (is_numeric($_POST['idCategories'])) {
            $place->idCategories = htmlspecialchars($_POST['idCategories']);
            //si la valeur n'est pas valide (pas un nombre) affichage d'un message d'erreur
        } else {
            $formError['idCategories'] = 'Veuillez sélectionner une catégorie valide';
        }
        //si le champ est vide affichage d'un message d'erreur
    } else {
        $formError['idCategories'] = 'Veuillez indiquer une catégorie';
    }
    //vérification que le champ regions n'est pas vide 
    if (!empty($_POST['regions'])) {
        //vérification de la validité de la valeur (doit être un nombre) et attribution de sa valeur à la variable $regions avec la sécurité htmlspecialchars (évite injection de code)
        if (is_numeric($_POST['regions'])) {
            $regions = htmlspecialchars($_POST['regions']);
            //si la valeur n'est pas valide (pas un nombre) affichage d'un message d'erreur
        } else {
            $formError['regions'] = 'Veuillez sélectionner une région valide';
        }
        //si le champ est vide affichage d'un message d'erreur
    } else {
        $formError['regions'] = 'Veuillez indiquer une région';
    }
    //vérification que le champ departments n'est pas vide 
    if (!empty($_POST['departments'])) {
        //vérification de la validité de la valeur (doit être un nombre) et attribution de sa valeur à la variable $departments avec la sécurité htmlspecialchars (évite injection de code)
        if (is_numeric($_POST['departments'])) {
            $departments = htmlspecialchars($_POST['departments']);
            //si la valeur n'est pas valide (pas un nombre) affichage d'un message d'erreur
        } else {
            $formError['departments'] = 'Veuillez sélectionner un département valide';
        }
        //si le champ est vide affichage d'un message d'erreur
    } else {
        $formError['departments'] = 'Veuillez indiquer un département';
    }
    //vérification que le champ postalCode n'est pas vide 
    if (!empty($_POST['postalCode'])) {
        //vérification de la validité de la valeur et attribution de cette valeur à la variable $postalCode avec la sécurité htmlspecialchars (évite injection de code)
        if (preg_match($regexPostalCode, $_POST['postalCode'])) {
            $postalCode = htmlspecialchars($_POST['postalCode']);
            //si la valeur n'est pas valide affichage d'un message d'erreur
        } else {
            $formError['postalCode'] = 'La saisie du code postal est invalide';
        }
    } else {
        $formError['postalCode'] = 'Veuillez sélectionner un code postal';
    }
    //vérification que le champ idCities n'est pas vide
    if (!empty($_POST['idCities'])) {
        //vérification de la validité de la valeur (doit être un nombre) et attribution de sa valeur à l'attribut idCities de l'objet $place avec la sécurité htmlspecialchars (évite injection de code)
        if (is_numeric($_POST['idCities'])) {
            $place->idCities = htmlspecialchars($_POST['idCities']);
            //si la valeur n'est pas valide (pas un nombre) affichage d'un message d'erreur
        } else {
            $formError['idCities'] = 'Veuillez sélectionner une ville valide';
        }
        //si le champ est vide affichage d'un message d'erreur
    } else {
        $formError['idCities'] = 'Veuillez sélectionner une ville';
    }
    //vérification que le champ address n'est pas vide 
    if (!empty($_POST['address'])) {
        //attribution de sa valeur à l'attribut address de l'objet $place avec la sécurité htmlspecialchars (évite injection de code)
        $place->address = htmlspecialchars($_POST['address']);
        //si le champ est vide affichage d'un message d'erreur
    } else {
        $formError['address'] = 'Veuillez indiquer une adresse';
    }
    //vérification que le champ phone n'est pas vide (peut être vide)
    if (!empty($_POST['phone'])) {
        //vérification de la validité de la valeur et attribution de cette valeur à l'attribut phone de l'objet $place avec la sécurité htmlspecialchars (évite injection de code)
        if (preg_match($regexPhone, $_POST['phone'])) {
            $place->phone = htmlspecialchars($_POST['phone']);
            //si la valeur n'est pas valide affichage d'un message d'erreur
        } else {
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
            //si la valeur n'est pas valide affichage d'un message d'erreur
        } else {
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
            //si la valeur n'est pas valide affichage d'un message d'erreur
        } else {
            $formError['website'] = 'Veuillez indiquer un website';
        }
    }
    //vérification que le champ description n'est pas vide 
    if (!empty($_POST['description'])) {
        //attribution de sa valeur à l'attribut description de l'objet $place avec la sécurité htmlspecialchars (évite injection de code)
        $place->description = htmlspecialchars($_POST['description']);
        //si le champ est vide affichage d'un message d'erreur
    } else {
        $formError['description'] = 'Veuillez renseigner une description du site touristique';
    }
    //s'il n'y a pas d'erreur on appelle la méthode pour l'ajout d'un lieu après avoir vérifié qu'il n'existe pas déjà
    if (count($formError) == 0) {
        //attribution de la date du jour au format sql (aaaa-mm-jj hh:mm:ss) à l'attribut editDate de l'objet $place
        $place->editDate = date('Y-m-d H:i:s');
        //appel de la méthode vérifiant que le lieu n'existe pas déjà dans la base de données
        $checkExistingPlace = $place->checkIfPlaceExist();
        //si la méthode retourne 0 le lieu n'existe pas encore et il peut être ajouté à la base de données
        if ($checkExistingPlace === '0') {
            //affichage d'un message d'erreur si la méthode ne s'exécute pas
            if (!$place->addPlace()) {
                $formError['addPlaceSubmit'] = 'Il y a eu un problème veuillez contacter l\'administrateur du site';
            }
            //si la méthode retourne false affichage d'un message d'erreur car la requête ne s'est pas exécutée correctement
        } elseif ($checkExistingPlace === FALSE) {
            $formError['addPlaceSubmit'] = 'Il y a eu un problème veuillez contacter l\'administrateur du site';
            //sinon la méthode retourne 1, le lieu existe déjà dans la base de données, affichage d'un message d'erreur
        } else {
            $formError['placeName'] = 'Ce site touristique existe déjà';
        }
    }
}
