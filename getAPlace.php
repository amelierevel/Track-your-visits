<?php
//insertion du fichier path, du controller puis du header
include_once 'classes/path.php';
include_once path::getControllersPath() . 'getAPlaceCtrl.php';
include_once path::getRootPath() . 'header.php';
?>
<div class="row">
    <div class="row">
        <!--Card image--> 
        <div class="col m3 offset-m1 s12" id="placeImgCard">
            <div class="card">
                <div class="card-image">
                    <?php if (isset($picturePlace->picture)) { ?>
                        <img src="assets/img/placeImages/<?= $picturePlace->picture ?>" alt="" title="" class="responsive-img" />
                    <?php } else { ?>
                        <img src="assets/img/noImg.jpg" alt="Pas d'image disponible" title="Pas d'image disponible" class="responsive-img" />
                        <?php
                    }
                    if (isset($_SESSION['isConnect'])) {
                        if ($_SESSION['idUserTypes'] == 2) { //Affichage des fonctionnalités propres aux contributeurs
                            ?>
                            <a class="btn-floating halfway-fab waves-effect waves-light orange darken-3" id="addPictureFormButton"><i class="material-icons">add</i></a>
                            <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
        <!--Fin card image-->
        <!--Section Nom, catégorie et description du lieu-->
        <div class="col m7 s12">
            <h2><?= $placeInfo->name ?></h2>
            <p class="categoryText"><?= $placeInfo->category ?></p>
            <?php
            if (isset($_SESSION['isConnect'])) { //si l'utilisateur est connecté affichage des icones
                ?>
                <div class="row right-align">
                    <div class="iconPlaceForUser">
                        <form action="#" method="POST" class="col m1 offset-m10" id="addPlaceToSeeForm">
                            <?php
                            //vérification de l'envoi du formulaire et qu'il n'y a pas d'erreurs puis affichage de l'icone en vert
                            if (isset($_POST['addPlaceToSeeSubmit']) && (count($formError) === 0)) {
                                ?>
                                <button class="btn-flat btn-large white" title="Lieux à voir"><i class="fas fa-eye greenIcon"></i></button>
                            <?php } else { ?>
                                <div class="input-field hide">
                                    <input type="text" name="idPlace" id="idPlace" value="<?= $placeInfo->id ?>" required />
                                    <label for="idPlace"></label>
                                </div>
                                <button class="btn-flat btn-large white" type="submit" name="addPlaceToSeeSubmit" title="Ajouter aux lieux à voir" id="addPlaceToSeeSubmit">
                                    <i class="fas fa-eye blackIcon"></i>
                                </button>
                            <?php } ?>
                        </form>
                        <form action="#" method="POST" class="col m1" id="addVisitedPlaceForm">
                            <?php
                            //vérification de l'envoi du formulaire et qu'il n'y a pas d'erreurs puis affichage de l'icone en vert
                            if (isset($_POST['addVisitedPlaceSubmit']) && (count($formError) === 0)) {
                                ?>
                                <button class="btn-flat btn-large white" title="Lieux visités"><i class="fas fa-check-circle greenIcon"></i></button>
                            <?php } else { ?>
                                <div class="input-field hide">
                                    <input type="text" name="idPlace" id="idPlace" value="<?= $placeInfo->id ?>" required />
                                    <label for="idPlace"></label>
                                </div>
                                <button class="btn-flat btn-large white" type="submit" name="addVisitedPlaceSubmit" title="Ajouter aux lieux visités" id="addVisitedPlaceSubmit">
                                    <i class="fas fa-check-circle blackIcon"></i>
                                </button>
                            <?php } ?>
                        </form>
                    </div>
                    <p class="red-text text-darken-1 right-align">
                        <?php
                        //ternaire permettant l'affichage du message d'erreur si le lieu fait déjà parti des lieux à voir/visités de l'utilisateur
                        echo isset($formError['alreadyAdded']) ? $formError['alreadyAdded'] : '';
                        //ternaires permettant l'affichage des messages d'erreur si les tableaux d'erreur existent
                        echo isset($formError['idPlace']) ? $formError['idPlace'] : '';
                        echo isset($formError['idUser']) ? $formError['idUser'] : '';
                        //ternaires permettant l'affichage des messages d'erreur si les méthodes ne s'exécutent pas
                        echo isset($formError['addPlaceToSeeSubmit']) ? $formError['addPlaceToSeeSubmit'] : '';
                        echo isset($formError['addVisitedPlaceSubmit']) ? $formError['addVisitedPlaceSubmit'] : '';
                        ?>
                    </p>
                </div>
            <?php } ?>
            <p><span class="boldText">Description : </span><?= $placeInfo->description ?></p>
        </div> <!--Fin section Nom, catégorie et description du lieu-->
    </div> 
    <?php
    if (isset($formError['picture'])) { //affichage du message d'erreur si le tableau d'erreur existe
        ?>
        <p class="boldText red-text text-darken-1 center-align"><?= $formError['picture']; ?></p>
        <?php
    }
    if (isset($_SESSION['isConnect'])) {
        if ($_SESSION['idUserTypes'] == 2) { //Affichage des fonctionnalités propres aux contributeurs
            ?>
            <!--Formulaire ajout photo-->
            <div class="row" id="addPictureForm">
                <div class="col m10 offset-m1 s12 lime lighten-2">
                    <h3 class="sectionTitle center-align">Ajouter une photo</h3>
                    <form action="#" method="POST" enctype="multipart/form-data" class="col s12" id="addPicture">
                        <div class="row">
                            <div class="file-field input-field col s10 offset-s1">
                                <div class="btn orange darken-3 boldText ">
                                    <span>Parcourir</span>
                                    <input type="file" name="picture" id="picture" />
                                </div>
                                <div class="file-path-wrapper ">
                                    <input type="text"  class="file-path validate"  />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field center-align col s8 offset-s2">
                                <button class="btn waves-effect waves-light lime darken-3" type="submit" name="addPictureSubmit" id="addPictureSubmit">Ajouter la photo</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <?php
        }
    }
    ?>
    <!--Section contact-->
    <div class="row">
        <div class="col m10 offset-m1 s12 lime lighten-2">
            <h3 class="sectionTitle center-align boldText">Contact</h3>
            <div class="row">
                <ul class="collection col m10 offset-m1 s12 center-align">
                    <li class="collection-item"><i class="material-icons">home</i>Adresse : <?= $placeInfo->address ?> - <?= $placeInfo->postalCode ?> <?= $placeInfo->city ?></li>
                    <?php if (isset($placeInfo->phone)) { ?>
                        <li class="collection-item"><i class="material-icons">phone</i>Téléphone : <?= $placeInfo->phone ?></li>
                        <?php
                    }
                    if (isset($placeInfo->mail)) {
                        ?>
                        <li class="collection-item truncate"><i class="material-icons">email</i>Mail : <?= $placeInfo->mail ?></li>
                        <?php
                    }
                    if (isset($placeInfo->website)) {
                        ?>
                        <li class="collection-item"><i class="material-icons">desktop_windows</i>Site internet : <a href="<?= $placeInfo->website ?>" title="Lien vers le site de <?= $placeInfo->name ?>" target="_blank"><?= $placeInfo->website ?></a></li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>
    <!--Section horaires-->
    <div class="row">
        <div class="col m10 offset-m1 s12 lime lighten-2">
            <h3 class="sectionTitle center-align boldText">Horaires</h3>
            <div class="row">
                <?php if (empty($timetablesList)) { ?>
                    <p class="center-align"><span class="boldText red-text text-accent-4">Dommage...</span>
                        <br />Il n'y pas encore d'horaires enregistrés pour ce lieu pour le moment.</p> 
                    <?php
                } else {
                    ?>
                    <table class="striped centered responsive-table col m10 offset-m1">
                        <thead>
                            <tr class="white">
                                <th>Jour</th>
                                <th>Période</th>
                                <th>Ouverture</th>
                                <th>Fermeture</th>
                                <th>Dernière mise à jour</th>
                                <?php
                                if (isset($_SESSION['isConnect'])) {
                                    if ($_SESSION['idUserTypes'] == 2) { //Affichage des fonctionnalités propres aux contributeurs
                                        ?>
                                        <th>Supprimer l'horaire</th>
                                        <?php
                                    }
                                }
                                ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($timetablesList as $timetableDetail) { //boucle permettant d'afficher la liste des périodes horaires (timetableTypes)
                                ?>
                                <tr>
                                    <td class="boldText"><?= $timetableDetail->day ?></td>
                                    <td><?= $timetableDetail->period ?></td>
                                    <td><?= $timetableDetail->opening ?></td>
                                    <td><?= $timetableDetail->closing ?></td>
                                    <td><?= $timetableDetail->editDate ?></td>
                                    <?php
                                    if (isset($_SESSION['isConnect'])) {
                                        if ($_SESSION['idUserTypes'] == 2) { //Affichage des fonctionnalités propres aux contributeurs
                                            ?>
                                            <td>
                                                <a href="Lieu?id=<?= $placeInfo->id ?>&idTimetableDelete=<?= $timetableDetail->id ?>" class="btn-floating btn-small waves-effect waves-light red accent-4 deleteButton"><i class="material-icons">delete</i></a>
                                                <?php
                                                if (isset($deleteTimetableError)) { //affichage du message d'erreur s'il existe
                                                    ?>  
                                                    <p class="red-text text-darken-1 center-align"><?= $deleteTimetableError; ?></p>
                                                <?php } ?>
                                            </td>
                                            <?php
                                        }
                                    }
                                    ?>
                                </tr>
                                <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <?php
            if (isset($_SESSION['isConnect'])) {
                if ($_SESSION['idUserTypes'] == 2) { //Affichage des fonctionnalités propres aux contributeurs
                    ?>
                    <div class="left-align">
                        <h4 class="col m6 offset-m3 s12 center-align lime darken-3 white-text">Ajouter un horaire</h4>
                        <div id="timetableForm">
                            <!-----------------Formulaire d'ajout d'horaire----------------->
                            <form action="#" method="POST" class="col s12 bgForm">
                                <div class="input-field col m4 s12">
                                    <select name="idDays">
                                        <option value="0" disabled selected>Jour</option>
                                        <?php
                                        foreach ($daysList as $dayDetail) { //boucle permettant d'afficher la liste des jours de la semaine
                                            ?>
                                            <option value="<?= $dayDetail->id ?>" <?= ((isset($timetable->idDays)) && ($timetable->idDays == $dayDetail->id)) ? 'selected' : '' ?>><?= $dayDetail->day ?></option>
                                        <?php } ?>
                                    </select>
                                    <label for="idDays">Sélectionner un jour</label>
                                    <?php
                                    if (isset($formError['idDays'])) { //affichage du message d'erreur si le tableau d'erreur existe
                                        ?>
                                        <p class="boldText red-text text-darken-1 center-align"><?= $formError['idDays']; ?></p>
                                    <?php } ?>
                                </div>
                                <div class="input-field col m4 s12">
                                    <select name="idTimetableTypes">
                                        <option value="0" disabled selected>Période</option>
                                        <?php
                                        foreach ($timetableTypesList as $timetableTypeDetail) { //boucle permettant d'afficher la liste des périodes horaires (timetableTypes)
                                            ?>
                                            <option value="<?= $timetableTypeDetail->id ?>" <?= ((isset($timetable->idTimetableTypes)) && ($timetable->idTimetableTypes == $timetableTypeDetail->id)) ? 'selected' : '' ?>><?= $timetableTypeDetail->name ?></option>
                                        <?php } ?>
                                    </select>
                                    <label for="idTimetableTypes">Sélectionner une période horaire</label>
                                    <?php
                                    if (isset($formError['idTimetableTypes'])) { //affichage du message d'erreur si le tableau d'erreur existe
                                        ?>
                                        <p class="boldText red-text text-darken-1 center-align"><?= $formError['idTimetableTypes']; ?></p>
                                    <?php } ?>
                                </div>
                                <div class="input-field col m2 s5 offset-s1">
                                    <input type="time" name="opening" id="opening" placeholder="--:--" class="validate" value="<?= isset($timetable->opening) ? $timetable->opening : '' ?>" />
                                    <label for="opening">Horaire d'ouverture</label>
                                    <?php
                                    if (isset($formError['opening'])) { //affichage du message d'erreur si le tableau d'erreur existe
                                        ?>
                                        <p class="boldText red-text text-darken-1 center-align"><?= $formError['opening']; ?></p>
                                    <?php } ?>
                                </div>
                                <div class="input-field col m2 s5">
                                    <input type="time" name="closing" id="closing" placeholder="--:--" class="validate" value="<?= isset($timetable->closing) ? $timetable->closing : '' ?>" />
                                    <label for="closing">Horaire de fermeture</label>
                                    <?php
                                    if (isset($formError['closing'])) { //affichage du message d'erreur si le tableau d'erreur existe
                                        ?>
                                        <p class="boldText red-text text-darken-1 center-align"><?= $formError['closing']; ?></p>
                                    <?php } ?>
                                </div>
                                <p class="boldText red-text text-darken-1 center-align">
                                    <?php
                                    //ternaire permettant l'affichage du message d'erreur si la méthode ne s'exécute pas
                                    echo isset($formError['addTimetablesSubmit']) ? $formError['addTimetablesSubmit'] : '';
                                    ?>
                                </p>
                                <!--Bouton de validation du formulaire-->
                                <div class="center-align">
                                    <button class="btn waves-effect waves-light lime darken-3" type="submit" name="addTimetablesSubmit" id="addTimetablesSubmit">Enregistrer les horaires</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <?php
                }
            }
            ?>
        </div>
    </div> <!--Fin section horaires-->
    <!----------------------Section tarifs------------------------->
    <div class="row">
        <div class="col m10 offset-m1 s12 lime lighten-2">
            <h3 class="sectionTitle center-align boldText">Tarifs</h3>
            <div class="row">
                <?php if (empty($pricesList)) { ?>
                    <p class="center-align"><span class="boldText red-text text-accent-4">Dommage...</span>
                        <br />Il n'y pas encore de tarifs enregistrés pour ce lieu pour le moment.</p> 
                    <?php
                } else {
                    ?>
                    <table class="striped centered responsive-table col m10 offset-m1">
                        <thead>
                            <tr class="white">
                                <th>Prix</th>
                                <th>Tarif</th>
                                <th>Nom du tarif</th>
                                <th>Dernière mise à jour</th>
                                <?php
                                if (isset($_SESSION['isConnect'])) {
                                    if ($_SESSION['idUserTypes'] == 2) { //Affichage des fonctionnalités propres aux contributeurs
                                        ?>
                                        <th>Supprimer le tarif</th>
                                        <?php
                                    }
                                }
                                ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($pricesList as $priceDetail) { //boucle permettant d'afficher la liste des périodes horaires (timetableTypes)
                                ?>
                                <tr>
                                    <td><?= $priceDetail->price ?> €</td>
                                    <td><?= $priceDetail->priceType ?></td>
                                    <td><?= $priceDetail->name ?></td>
                                    <td><?= $priceDetail->editDatePrices ?></td>
                                    <?php
                                    if (isset($_SESSION['isConnect'])) {
                                        if ($_SESSION['idUserTypes'] == 2) { //Affichage des fonctionnalités propres aux contributeurs
                                            ?>
                                            <td>
                                                <a href="Lieu?id=<?= $placeInfo->id ?>&idPriceDelete=<?= $priceDetail->id ?>" class="btn-floating btn-small waves-effect waves-light red accent-4 deleteButton"><i class="material-icons">delete</i></a>
                                                <?php
                                                if (isset($deletePriceError)) { //affichage du message d'erreur s'il existe
                                                    ?>  
                                                    <p class="red-text text-darken-1 center-align"><?= $deletePriceError; ?></p>
                                                <?php } ?>
                                            </td>
                                            <?php
                                        }
                                    }
                                    ?>
                                </tr>
                                <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <?php
            if (isset($_SESSION['isConnect'])) {
                if ($_SESSION['idUserTypes'] == 2) { //Affichage des fonctionnalités propres aux contributeurs
                    ?>
                    <div class="left-align">
                        <h4 class="col m6 offset-m3 s12 center-align lime darken-3 white-text" >Ajouter un tarif</h4>
                        <div id="priceForm">
                            <form action="#" method="POST" class="col s12 bgForm">
                                <div class="input-field col m2 s12">
                                    <input type="text" name="price" id="price" placeholder="12.50€" class="validate" value="" />
                                    <label for="price">Tarif</label>
                                </div>
                                <div class="input-field col m4 s12">
                                    <select name="idPriceTypes">
                                        <option value="0" disabled selected>Type de tarif</option>
                                        <?php
                                        foreach ($priceTypesList as $priceTypeDetail) { //boucle permettant d'afficher la liste des jours de la semaine
                                            ?>
                                            <option value="<?= $priceTypeDetail->id ?>"><?= $priceTypeDetail->name ?></option>
                                        <?php } ?>
                                    </select>
                                    <label for="idPriceTypes">Sélectionner un type de tarif</label>
                                </div>
                                <div class="input-field col m6 s12">
                                    <input type="text" name="priceName" id="priceName" value="<?= isset($place->name) ? $place->name : '' ?>" />
                                    <label for="priceName">Nom du tarif (facultatif)</label>
                                </div>
                                <p class="boldText red-text text-darken-1 center-align">
                                    <?php
                                    //affichage des messages d'erreur si le tableau d'erreur existe
                                    echo isset($formError['price']) ? $formError['price'] : '';
                                    echo isset($formError['idPriceTypes']) ? $formError['idPriceTypes'] : '';
                                    //ternaire permettant l'affichage du message d'erreur si la méthode ne s'exécute pas
                                    echo isset($formError['addPricesSubmit']) ? $formError['addPricesSubmit'] : '';
                                    ?>
                                </p>
                                <!--Bouton de validation du formulaire-->
                                <div class="center-align">
                                    <button class="btn waves-effect waves-light lime darken-3" type="submit" name="addPricesSubmit" id="addPricesSubmit">Enregistrer le tarif</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <?php
                }
            }
            ?>
        </div>
    </div>
    <?php
    if (isset($_SESSION['isConnect'])) {
        if ($_SESSION['idUserTypes'] == 2) { //Affichage des fonctionnalités propres aux contributeurs
            ?>
            <div class="row">
                <div class="col m10 offset-m1 s12 center-align">
                    <a href="Modification-lieu?id=<?= $placeInfo->id ?>" class="boldText btn waves-effect waves-light lime darken-3" title="Lien vers la page de modification du lieu">Modifier les renseignements du lieu</a>
                </div>
            </div>
            <?php
        }
    }
    ?>
</div>
<p class="center-align grey-text" id="responsability">Ce contenu n'est ni rédigé, ni cautionné par Track your visits. Signaler un cas d'utilisation abusive.</p>
<?php
//insertion du footer
include_once path::getRootPath() . 'footer.php';
?>