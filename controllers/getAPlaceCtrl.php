<?php

//insertion de la class database et des models places, placesToSee, visitedPlaces
include_once path::getClassesPath() . 'database.php';
include_once path::getModelsPath() . 'places.php';
include_once path::getModelsPath() . 'placesToSee.php';
include_once path::getModelsPath() . 'visitedPlaces.php';

//instanciation pour l'affichage des informations d'un site touristique
$getPlaceInfo = NEW places();
//vérification de la présence de l'id dans l'url
if (isset($_GET['id'])) {
    $getPlaceInfo->id = $_GET['id'];
}
//appel de la méthode permettant l'affichage des informations d'un site touristique
$placeInfo = $getPlaceInfo->getPlaceById();

//déclaration d'un tableau d'erreur
$formError = array();

//----------------------------Ajout lieu à voir-----------------------------------
//vérification que les données ont été envoyés
if (isset($_POST['addPlaceToSeeSubmit'])) {
    //instanciation de l'objet $placeToSee
    $placeToSee = NEW placesToSee();
    //vérification que chaque champ idPlace n'est pas vide et qu'il s'agit d'un nombre puis attribution de sa valeur à l'attribut idPlaces de l'objet $placeToSee avec la sécurité htmlspecialchars
    if (!empty($_POST['idPlace']) && is_numeric($_POST['idPlace'])) {
        $placeToSee->idPlaces = htmlspecialchars($_POST['idPlace']);
    } else { //sinon affichage d'un message d'erreur
        $formError['idPlace'] = 'Une erreur est survenue dans la sélection du lieu';
    }
    //attribution de la valeur de l'id de la session à l'attribut idUsers de l'objet $placeToSee 
    $placeToSee->idUsers = $_SESSION['id'];
    //s'il n'y a pas d'erreur on appelle la méthode pour l'ajout dans les lieux à voir après avoir vérifié qu'il n'existait pas déjà
    if (count($formError) == 0) {
        //appel de la méthode vérifiant que le lieu n'est pas déjà ajouté dans les lieux à voir par l'utilisateur dans la base de données
        $checkExistingPlaceToSee = $placeToSee->checkIfPlaceToSeeExist();
        //si la méthode checkIfPlaceToSeeExist() retourne 0 le lieu n'est pas déjà ajouté et il peut être ajouté à la base de données
        if ($checkExistingPlaceToSee === '0') {
            if (!$placeToSee->addPlaceToSee()) { //affichage d'un message d'erreur si la méthode addPlaceToSee() ne s'exécute pas
                $formError['addPlaceToSeeSubmit'] = 'Il y a eu un problème veuillez contacter l\'administrateur du site';
            }
            //si la méthode checkIfPlaceToSeeExist() retourne false affichage d'un message d'erreur car la requête ne s'est pas exécutée correctement
        } elseif ($checkExistingPlaceToSee === FALSE) {
            $formError['addPlaceToSeeSubmit'] = 'Il y a eu un problème veuillez contacter l\'administrateur du site';
        } else { //sinon la méthode checkIfPlaceToSeeExist() retourne 1, le lieu est déjà dans la base de données, affichage d'un message d'erreur
            $formError['alreadyAdded'] = 'Ce lieu fait déjà parti de votre liste de lieux à voir';
        }
    }
}

//----------------------------Ajout lieu visité-----------------------------------
//vérification que les données ont été envoyés
if (isset($_POST['addVisitedPlaceSubmit'])) {
    //instanciation de l'objet $visitedPlace
    $visitedPlace = NEW visitedPlaces();
    //vérification que chaque champ idPlace n'est pas vide et qu'il s'agit d'un nombre puis attribution de sa valeur à l'attribut idPlaces de l'objet $visitedPlace avec la sécurité htmlspecialchars
    if (!empty($_POST['idPlace']) && is_numeric($_POST['idPlace'])) {
        $visitedPlace->idPlaces = htmlspecialchars($_POST['idPlace']);
    } else { //sinon affichage d'un message d'erreur
        $formError['idPlace'] = 'Une erreur est survenue dans la sélection du lieu';
    }
    //attribution de la valeur de l'id de la session à l'attribut idUsers de l'objet $visitedPlace
    $visitedPlace->idUsers = $_SESSION['id'];
    //s'il n'y a pas d'erreur on appelle la méthode pour l'ajout dans les lieux à voir après avoir vérifié qu'il n'existait pas déjà
    if (count($formError) == 0) {
        //appel de la méthode vérifiant que le lieu n'est pas déjà ajouté dans les lieux à voir par l'utilisateur dans la base de données
        $checkExistingVisitedPlace = $visitedPlace->checkIfVisitedPlaceExist();
        //si la méthode checkIfVisitedPlaceExist() retourne 0 le lieu n'est pas déjà ajouté et il peut être ajouté à la base de données
        if ($checkExistingVisitedPlace === '0') {
            if (!$visitedPlace->addVisitedPlace()) { //affichage d'un message d'erreur si la méthode addVisitedPlace() ne s'exécute pas
                $formError['addVisitedPlaceSubmit'] = 'Il y a eu un problème veuillez contacter l\'administrateur du site';
            }
            //si la méthode checkIfVisitedPlaceExist() retourne false affichage d'un message d'erreur car la requête ne s'est pas exécutée correctement
        } elseif ($checkExistingVisitedPlace === FALSE) {
            $formError['addVisitedPlaceSubmit'] = 'Il y a eu un problème veuillez contacter l\'administrateur du site';
        } else { //sinon la méthode checkIfVisitedPlaceExist() retourne 1, le lieu est déjà dans la base de données, affichage d'un message d'erreur
            $formError['alreadyAdded'] = 'Ce lieu fait déjà parti de votre liste de lieux visités';
        }
    }
}


if (isset($_POST['addPictureSubmit'])) {
    $picture = NEW pictures();
    if (!empty($_FILES['picture'])) {
        //variable qui stock les infos du fichier récupérées par la fonction pathinfo
        $fileInfo = pathinfo($_FILES['picture']['name']);
        //variable qui récupère la valeur de l'extension du fichier
        $extensionUpload = $fileInfo['extension'];
        //déclaration de la variable contenant l'extension autorisée
        $autorizedExtension = array('jpg', 'jpeg', 'png');
        //vérification de la validité de l'extension
        if ($extensionUpload == $autorizedExtension) {
            if ($_FILES['picture']['size'] <= 500000) { //500ko max par image 
                $picture->picture = htmlspecialchars($_FILES['picture']);
            } else {
                $formError['picture'] = 'L\'image sélectionnée est trop volumineuse, veuillez en choisir une autre (500ko max)';
            }
        } else {
            $formError['picture'] = 'L\'image sélectionnée n\'est pas au bon format, veuillez utiliser les formats .jpg, .jpeg ou .png';
        }
    } else {
        $formError['picture'] = 'Veuillez sélectionner une image';
    }
    if (!empty($_POST['idPlace']) && is_numeric($_POST['idPlace'])) {
        $picture->idPlaces = htmlspecialchars($_POST['idPlace']);
    }
    if (count($formError) == 0) {
        $addPicture = $picture->addPicture();
    }
}    



//  if (!empty($_FILES['file']) && isset($_POST['submit'])) {
//  if (is_uploaded_file($_FILES['file']['tmp_name'])) {
//    $img = $_FILES['file'];
//    $start_path = $img['tmp_name'];
//    $end_path = 'files/' . $img['name'];
//    if (move_uploaded_file($start_path, $end_path)) {
//      //insertion en base du nom
//      $photo = new photo();
//      $photo->name = $img['name'];
//      $photo->uploadFile();
//    }
//  }
//}