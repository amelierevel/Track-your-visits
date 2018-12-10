<?php

//ouverture de la session
session_start();
//insertion de la class database et des models 
include_once path::getClassesPath() . 'database.php';
include_once path::getModelsPath() . 'places.php';
include_once path::getModelsPath() . 'placesToSee.php';
include_once path::getModelsPath() . 'visitedPlaces.php';
include_once path::getModelsPath() . 'timetables.php';
include_once path::getModelsPath() . 'days.php';
include_once path::getModelsPath() . 'timetableTypes.php';
include_once path::getModelsPath() . 'priceTypes.php';
include_once path::getModelsPath() . 'prices.php';
include_once path::getModelsPath() . 'pictures.php';

//instanciation pour l'affichage des informations du lieu
$getPlaceInfo = NEW places();
//vérification de la présence de l'id du lieu dans l'url et qu'il s'agit d'un nombre puis attribution de sa valeur à l'attribut id de l'objet $getPlaceInfo avec la sécurité htmlspecialchars
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $getPlaceInfo->id = htmlspecialchars($_GET['id']);
}
$placeInfo = $getPlaceInfo->getPlaceById(); //appel de la méthode permettant l'affichage des informations d'un lieu
//redirection vers la liste des lieux en cas de modification du nombre de l'id dans l'url
if ($placeInfo == FALSE) {
    header('Location: Liste-des-lieux');
    exit;
}
//déclaration d'un tableau d'erreur
$formError = array();

//----------------------------Ajout lieu à voir-----------------------------------
//vérification que les données ont été envoyés
if (isset($_POST['addPlaceToSeeSubmit'])) {
    $placeToSee = NEW placesToSee(); //instanciation de l'objet $placeToSee
    //vérification que chaque champ idPlace n'est pas vide et qu'il s'agit d'un nombre puis attribution de sa valeur à l'attribut idPlaces de l'objet $placeToSee avec la sécurité htmlspecialchars
    if (!empty($_POST['idPlace']) && is_numeric($_POST['idPlace'])) {
        $placeToSee->idPlaces = htmlspecialchars($_POST['idPlace']);
    } else { //sinon affichage d'un message d'erreur
        $formError['idPlace'] = 'Une erreur est survenue dans la sélection du lieu';
    }
    //attribution de la valeur de l'id (user) de la session à l'attribut idUsers de l'objet $placeToSee 
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
    $visitedPlace = NEW visitedPlaces(); //instanciation de l'objet $visitedPlace
    //vérification que chaque champ idPlace n'est pas vide et qu'il s'agit d'un nombre puis attribution de sa valeur à l'attribut idPlaces de l'objet $visitedPlace avec la sécurité htmlspecialchars
    if (!empty($_POST['idPlace']) && is_numeric($_POST['idPlace'])) {
        $visitedPlace->idPlaces = htmlspecialchars($_POST['idPlace']);
    } else { //sinon affichage d'un message d'erreur
        $formError['idPlace'] = 'Une erreur est survenue dans la sélection du lieu';
    }
    //attribution de la valeur de l'id (user) de la session à l'attribut idUsers de l'objet $visitedPlace
    $visitedPlace->idUsers = $_SESSION['id'];
    //s'il n'y a pas d'erreur on appelle la méthode pour l'ajout dans les lieux visités après avoir vérifié qu'il n'existait pas déjà
    if (count($formError) == 0) {
        //appel de la méthode vérifiant que le lieu n'est pas déjà ajouté dans les lieux visités par l'utilisateur dans la base de données
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

//------------------------------Affichage des horaires-------------------------
$getTimetable = NEW timetables(); //instanciation pour l'affichage des horaires 
//vérification de la présence de l'id du lieu dans l'url et qu'il s'agit d'un nombre puis attribution de sa valeur à l'attribut id de l'objet $getTimetable avec la sécurité htmlspecialchars
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $getTimetable->id = htmlspecialchars($_GET['id']);
}
$timetablesList = $getTimetable->getTimetablesList();

//-------------------------------Ajout d'horaire------------------------ 
$day = NEW days(); //instanciation pour l'affichage de la liste des jours de la semaine
$daysList = $day->getDaysList();

$timetableType = NEW timetableTypes(); //instanciation pour l'affichage de la liste des périodes horaires (timetableTypes)
$timetableTypesList = $timetableType->getTimetableTypesList();

//vérification que les données ont été envoyés
if (isset($_POST['addTimetablesSubmit'])) {
    $timetable = NEW timetables(); //instanciation de l'objet timetable
    $timetable->editDate = date('Y-m-d H:i:s'); //attribution de la date du jour au format sql (aaaa-mm-jj hh:mm:ss) à l'attribut editDate de l'objet $timetable
    //vérification de la présence d'un id dans l'url et qu'il s'agit d'un nombre puis attribution de sa valeur à l'attribut idPlaces de l'objet $timetable avec la sécurité htmlspecialchars
    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        $timetable->idPlaces = htmlspecialchars($_GET['id']);
    }
    //vérification que le champ idDays n'est pas vide
    if (!empty($_POST['idDays'])) {
        //vérification de la validité de la valeur (doit être un nombre) et attribution de sa valeur à l'attribut idDays de l'objet $timetable avec la sécurité htmlspecialchars (évite injection de code)
        if (is_numeric($_POST['idDays'])) {
            $timetable->idDays = htmlspecialchars($_POST['idDays']);
        } else { //si la valeur n'est pas valide (pas un nombre) affichage d'un message d'erreur
            $formError['idDays'] = 'Veuillez sélectionner un jour valide';
        }
    } else { //si le champ est vide affichage d'un message d'erreur
        $formError['idDays'] = 'Veuillez sélectionner un jour';
    }
    //vérification que le champ idTimetableTypes n'est pas vide
    if (!empty($_POST['idTimetableTypes'])) {
        //vérification de la validité de la valeur (doit être un nombre) et attribution de sa valeur à l'attribut idTimetableTypes de l'objet $timetable avec la sécurité htmlspecialchars (évite injection de code)
        if (is_numeric($_POST['idTimetableTypes'])) {
            $timetable->idTimetableTypes = htmlspecialchars($_POST['idTimetableTypes']);
            //vérification que la période sélectionnée est égale 5 (fermé) et attribution de la valeur NULL aux attributs opening et closing de l'objet $timetable
            if ($_POST['idTimetableTypes'] == 5) {
                $timetable->opening = NULL;
                $timetable->closing = NULL;
            } else { //si la période sélectionnée est différente de 5 (fermé)
                if (!empty($_POST['opening'])) { //vérification que le champ opening n'est pas vide
                    //vérification de la validité de la valeur et attribution de sa valeur à l'attribut opening de l'objet $timetable avec la sécurité htmlspecialchars (évite injection de code)
                    $timetable->opening = htmlspecialchars($_POST['opening']);
                } else { //si le champ est vide affichage d'un message d'erreur
                    $formError['opening'] = 'Veuillez sélectionner une horaire d\'ouveture';
                }
                if (!empty($_POST['closing'])) { //vérification que le champ closing n'est pas vide
                    //vérification de la validité de la valeur et attribution de sa valeur à l'attribut closing de l'objet $timetable avec la sécurité htmlspecialchars (évite injection de code)
                    $timetable->closing = htmlspecialchars($_POST['closing']);
                } else { //si le champ est vide affichage d'un message d'erreur
                    $formError['closing'] = 'Veuillez sélectionner une horaire de fermeture';
                }
            }
        } else { //si la valeur n'est pas valide (pas un nombre) affichage d'un message d'erreur
            $formError['idTimetableTypes'] = 'Veuillez sélectionner une période horaire valide';
        }
    } else { //si le champ est vide affichage d'un message d'erreur
        $formError['idTimetableTypes'] = 'Veuillez sélectionner une période horaire';
    }
    //s'il n'y a pas d'erreur on appelle la méthode pour l'ajout des horaires après avoir vérifié qu'ils n'existaient pas déjà
    if (count($formError) == 0) {
        //appel de la méthode vérifiant que l'horaire n'existe pas déjà dans la base de données
        $checkExistingTimetable = $timetable->checkIfTimetableExist();
        //si la méthode checkIfTimetableExist() retourne 0 l'horaire n'existe pas encore et il peut être ajouté à la base de données
        if ($checkExistingTimetable === '0') {
            if (!$timetable->addTimetable()) { //affichage d'un message d'erreur si la méthode addTimetable() ne s'exécute pas
                $formError['addTimetablesSubmit'] = 'Il y a eu un problème veuillez contacter l\'administrateur du site';
            } else { // si la méthode addTimetable() s'exécute redirection sur la page du lieu
                header('Location: Lieu?id=' . $timetable->idPlaces);
                exit;
            }
            //si la méthode checkIfTimetableExist() retourne false affichage d'un message d'erreur car la requête ne s'est pas exécutée correctement
        } elseif ($checkExistingTimetable === FALSE) {
            $formError['addTimetablesSubmit'] = 'Il y a eu un problème veuillez contacter l\'administrateur du site';
        } else { //sinon la méthode checkIfTimetableExist() retourne 1, l'horaire existe déjà dans la base de données, affichage d'un message d'erreur
            $formError['addTimetablesSubmit'] = 'Il y a déjà des horaires enregistrés pour ce jour à cette période';
        }
    }
}

//---------------------------Suppression d'un horaire---------------------------
//vérification de la présence de idTimetableDelete dans l'url et qu'il s'agit bien d'un nombre
if (isset($_GET['idTimetableDelete']) && is_numeric($_GET['idTimetableDelete'])) {
    $deleteTimetable = NEW timetables(); //instanciation pour la suppression d'un horaire
    $deleteTimetable->id = htmlspecialchars($_GET['idTimetableDelete']);
    $removeTimetable = $deleteTimetable->deleteTimetable(); //appel de la méthode deleteTimetable() permettant la suppression d'un horaire
    if ($removeTimetable == TRUE) { //si la méthode s'exécute redirection vers la page du lieu
        header('Location: Lieu?id=' . $getPlaceInfo->id);
        exit();
    } elseif ($removeTimetable === FALSE) { //affichage d'un message d'erreur si la requête ne s'est pas exécutée
        $deleteTimetableError = 'L\'horaire n\'a pas pu être supprimé, veuillez contacter l\'administrateur du site';
    }
}

//-------------------------------Affichage des tarifs-----------------------------
$getPrices = NEW prices(); //instanciation pour l'affichage des tarifs
//vérification de la présence de l'id du lieu dans l'url et qu'il s'agit d'un nombre puis attribution de sa valeur à l'attribut id de l'objet $getPrices avec la sécurité htmlspecialchars
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $getPrices->id = htmlspecialchars($_GET['id']);
}
$pricesList = $getPrices->getPricesList();

//---------------------------------Ajout d'un tarif-----------------------------------
$priceType = NEW priceTypes(); //instanciation pour l'affichage de la liste des types de tarifs
$priceTypesList = $priceType->getPriceTypesList();
//déclaration de la regex pour les tarifs
$regexPrice = '/^[0-9]+[.]?[0-9]{0,2}$/';

if (isset($_POST['addPricesSubmit'])) { //vérification que les données ont été envoyés
    $price = NEW prices(); //instanciation de l'objet $price
    $price->editDatePrices = date('Y-m-d H:i:s'); //attribution de la date du jour au format sql (aaaa-mm-jj hh:mm:ss) à l'attribut editDatePrices de l'objet $price
    //vérification de la présence de l'id dans l'url et qu'il s'agit d'un nombre puis attribution de sa valeur à l'attribut idPlaces de l'objet $price avec la sécurité htmlspecialchars
    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        $price->idPlaces = htmlspecialchars($_GET['id']);
    }
    if (!empty($_POST['price'])) { //vérification que le champ price n'est pas vide
        //vérification de la validité de la valeur et attribution de cette valeur à l'attribut price de l'objet $price avec la sécurité htmlspecialchars (évite injection de code)
        if (preg_match($regexPrice, $_POST['price'])) {
            $price->price = htmlspecialchars($_POST['price']);
        } else { //si la valeur n'est pas valide affichage d'un message d'erreur
            $formError['price'] = 'La saisie du tarif est invalide';
        }
    } else { //si le champ est vide affichage d'un message d'erreur
        $formError['price'] = 'Veuillez indiquer un tarif';
    }
    if (!empty($_POST['idPriceTypes'])) { //vérification que le champ idPriceTypes n'est pas vide
        //vérification de la validité de la valeur (doit être un nombre) et attribution de sa valeur à l'attribut idPriceTypes de l'objet $price avec la sécurité htmlspecialchars (évite injection de code)
        if (is_numeric($_POST['idPriceTypes'])) {
            $price->idPriceTypes = htmlspecialchars($_POST['idPriceTypes']);
        } else { //si la valeur n'est pas valide (pas un nombre) affichage d'un message d'erreur
            $formError['idPriceTypes'] = 'Veuillez sélectionner un type de tarif valide';
        }
    } else { //si le champ est vide affichage d'un message d'erreur
        $formError['idPriceTypes'] = 'Veuillez sélectionner un type de tarif';
    }
    //vérification que le champ priceName n'est pas vide (peut être vide) et attribution de sa valeur à l'attribut name de l'objet $price avec la sécurité htmlspecialchars (évite injection de code)
    if (!empty($_POST['priceName'])) {
        $price->name = htmlspecialchars($_POST['priceName']);
    }
    //s'il n'y a pas d'erreur on appelle la méthode pour l'ajout d'un tarif 
    if (count($formError) == 0) {
        if (!$price->addPrices()) { //affichage d'un message d'erreur si la méthode addPrices() ne s'exécute pas
            $formError['addPricesSubmit'] = 'Il y a eu un problème veuillez contacter l\'administrateur du site';
        } else { //si la méthode addPrices() s'exécute redirection vers la page du lieu
            header('Location: Lieu?id=' . $price->idPlaces);
            exit;
        }
    }
}

//----------------------------Suppression d'un tarif---------------------------
if (isset($_GET['idPriceDelete']) && is_numeric($_GET['idPriceDelete'])) { //vérification de la présence de idPriceDelete et qu'il s'agit bien d'un nombre
    $deletePrice = NEW prices(); //instanciation pour la suppression d'un tarif
    $deletePrice->id = htmlspecialchars($_GET['idPriceDelete']);
    $removePrice = $deletePrice->deletePrice(); //appel de la méthode deletePrice() permettant la suppression d'un tarif
    if ($removePrice == TRUE) { //si la méthode s'exécute redirection vers la page du lieu
        header('Location: Lieu?id=' . $getPlaceInfo->id);
        exit();
    } elseif ($removePrice === FALSE) { //affichage d'un message d'erreur si la requête ne s'est pas exécutée
        $deletePriceError = 'Le tarif n\'a pas pu être supprimé, veuillez contacter l\'administrateur du site';
    }
}

//----------------------------------Ajout photo---------------------------------
if (isset($_POST['addPictureSubmit'])) { //vérification que les données ont été envoyés
    if (!empty($_FILES['picture'])) { //vérification que le champ picture n'est pas vide
        $autorizedExtension = array('jpg', 'JPG', 'jpeg', 'JPEG', 'png', 'PNG'); //déclaration de la variable contenant le tableau des extensions autorisées
        $temporary = explode('.', $_FILES['picture']['name']); //découpage du nom du fichier au niveau des '.'
        $file_extension = end($temporary); //récupération de la partie finale du nom du fichier (l'extension)
        if ($_FILES['picture']['size'] <= 500000) { //vérification que la taille du fichier ne dépasse pas 500ko
            if (in_array($file_extension, $autorizedExtension)) { //vérification que l'extension du fichier fait bien partie du tableau d'extensions autorisées
                if (is_uploaded_file($_FILES['picture']['tmp_name'])) { //vérification que le fichier a été téléchargé 
                    $image = $_FILES['picture']; //stockage du fichier dans la variable $image
                    $sourcePath = $image['tmp_name'];
                    $targetPath = path::getPlaceImage() . $image['name'];
                    if (move_uploaded_file($sourcePath, $targetPath)) { //déplacement du fichier vers le dossier cible
                        $picture = NEW pictures(); //instanciation pour l'ajout de l'image
                        $picture->picture = $image['name']; //attribution du nom de l'image à l'attribut picture de l'objet $picture
                        //vérification de la présence de l'id du lieu dans l'url et qu'il s'agit d'un nombre puis attribution de sa valeur à l'attribut idPlaces de l'objet $picture avec la sécurité htmlspecialchars
                        if (isset($_GET['id']) && is_numeric($_GET['id'])) {
                            $picture->idPlaces = htmlspecialchars($_GET['id']);
                        } else { //si l'id n'est pas présent dans l'url ou s'il n'est pas un nom, affichage d'un message d'erreur
                            $formError['picture'] = 'Une erreur s\'est produite lors de l\'ajout de votre image';
                        }
                        //s'il n'y a pas d'erreur on appelle la méthode pour l'ajout d'une image après avoir vérifié qu'il n'en existe pas déjà une pour ce lieu
                        if (count($formError) == 0) {
                            $checkExistingPicturePlace = $picture->checkIfPicturePlaceExist(); //appel de la méthode vérifiant que le lieu ne possède pas déjà une image
                            //si la méthode checkIfPicturePlaceExist() retourne 0 le lieu n'a pas encore d'image et elle peut être ajoutée à la base de données
                            if ($checkExistingPicturePlace === '0') {
                                if (!$picture->addPicture()) { //affichage d'un message d'erreur si la méthode addPicture() ne s'exécute pas
                                    $formError['picture'] = 'Il y a eu un problème veuillez contacter l\'administrateur du site';
                                }
                                //si la méthode checkIfPicturePlaceExist() retourne false affichage d'un message d'erreur car la requête ne s'est pas exécutée correctement
                            } elseif ($checkExistingPicturePlace === FALSE) {
                                $formError['picture'] = 'Il y a eu un problème veuillez contacter l\'administrateur du site';
                            } else { //sinon la méthode checkIfPicturePlaceExist() retourne 1, le lieu a déjà une image répertoriée dans la base de données, affichage d'un message d'erreur
                                $formError['picture'] = 'Le lieu possède déjà une image';
                            }
                        }
                    }
                }
            } else { //si l'extension ne correspond pas aux extensions autorisées affichage d'un message d'erreur
                $formError['picture'] = 'L\'image sélectionnée n\'est pas au bon format, veuillez utiliser les formats .jpg, .jpeg ou .png';
            }
        } else { //si la taille du fichier est supérieure à 500ko affichage d'un message d'erreur
            $formError['picture'] = 'L\'image sélectionnée est trop volumineuse, veuillez en choisir une autre (500ko max)';
        }
    } else { //si le champ est vide affichage d'un message d'erreur
        $formError['picture'] = 'Veuillez sélectionner une image';
    }
}

//--------------------------------------Affichage photo---------------------------------
$getPicture = NEW pictures(); //instanciation pour l'affichage de l'image du lieu
//vérification de la présence de l'id du lieu dans l'url et qu'il s'agit d'un nombre puis attribution de sa valeur à l'attribut idPlaces de l'objet $getPicture avec la sécurité htmlspecialchars
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $getPicture->idPlaces = htmlspecialchars($_GET['id']);
}
$picturePlace = $getPicture->getPictureByPlace();

//écriture des données de session et fermeture de la session 
session_write_close();
