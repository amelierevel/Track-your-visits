<?php

//insertion de la class database et du model places
include_once path::getClassesPath() . 'database.php';
include_once path::getModelsPath() . 'places.php';

//instanciation pour l'affichage des informations d'un site touristique
$getPlaceInfo = NEW places();
//vérification de la présence de l'id dans l'url
if (isset($_GET['id'])) {
    $getPlaceInfo->id = $_GET['id'];
}
//appel de la méthode permettant l'affichage des informations d'un site touristique
$placeInfo = $getPlaceInfo->getPlaceById();
$formError = array();

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
    if (!empty($_POST['idPlace'])) {
        $picture->idPlaces = htmlspecialchars($_POST['idPlace']);
    }
    if ($errorMessage != '') {
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