<?php
//insertion du fichier path, du controller puis du controller
include_once 'classes/path.php';
include_once path::getControllersPath() . 'getAPlaceCtrl.php';
include_once path::getRootPath() . 'header.php';
?>
<div class="row">
    <div class="row">
        <div class="col m3 offset-m1 s12 placeImgCard">
            <div class="card">
                <div class="card-image">
                    <img src="assets/img/berger_picard.jpg">
                    <a href="#addPictureModal" class="btn-floating halfway-fab waves-effect waves-light orange darken-3 modal-trigger"><i class="material-icons">add</i></a>
                </div>
            </div>
        </div>
        <div class="col m7 s12">
            <h2 class="PlaceTitle"><?= $placeInfo->name ?></h2>
            <p class="categoryText"><?= $placeInfo->category ?></p>
            <?php
            if (isset($_SESSION['isConnect'])) { //si l'utilisateur est connecté affichage des icones
                ?>
                <div class="row right-align">
                    <div class="iconPlaceForUser">
                        <form action="#" method="POST" class="col m1 offset-m10" id="addPlaceToSeeForm">
                            <?php
                            //vérification de l'envoi du formulaire et qu'il n'y a pas d'erreurs puis affichage d'un message de succès
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
                            //vérification de l'envoi du formulaire et qu'il n'y a pas d'erreurs puis affichage d'un message de succès
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
                        //ternaire permettant l'affichage du message d'erreur si le lieu fait déjà parti des lieux à voir de l'utilisateur
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
        </div>
    </div>
    <div class="row">
        <div class="col m10 offset-m1 s12 lime lighten-2">
            <h3 class="sectionTitle">Contact</h3>
            <ul class="collapsible">
                <li>
                    <div class="collapsible-header"><i class="material-icons">home</i>Adresse</div>
                    <div class="collapsible-body white"><?= $placeInfo->address ?> - <?= $placeInfo->postalCode ?> <?= $placeInfo->city ?></div>
                </li>
                <?php if (isset($placeInfo->phone)) { ?>
                    <li>
                        <div class="collapsible-header"><i class="material-icons">phone</i>Téléphone</div>
                        <div class="collapsible-body white"><?= $placeInfo->phone ?></div>
                    </li>
                    <?php
                }
                if (isset($placeInfo->mail)) {
                    ?>
                    <li>
                        <div class="collapsible-header"><i class="material-icons">email</i>Mail</div>
                        <div class="collapsible-body white"><?= $placeInfo->mail ?></div>
                    </li>
                    <?php
                }
                if (isset($placeInfo->website)) {
                    ?>
                    <li>
                        <div class="collapsible-header"><i class="material-icons">desktop_windows</i>Site internet</div>
                        <div class="collapsible-body white">
                            <a href="<?= $placeInfo->website ?>" title="Lien vers le site de <?= $placeInfo->name ?>" target="_blank"><?= $placeInfo->website ?></a>
                        </div>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col m10 offset-m1 s12 lime lighten-2">
            <h3 class="sectionTitle">Horaires</h3>
            <div class="row">
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
                                            <a href="Lieu?id=<?= $placeInfo->id ?>&idTimetableDelete=<?= $timetableDetail->id ?>" class="btn-floating waves-effect waves-light red accent-4"><i class="material-icons">delete</i></a>
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
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <?php
            if (isset($_SESSION['isConnect'])) {
                if ($_SESSION['idUserTypes'] == 2) { //Affichage des fonctionnalités propres aux contributeurs
                    ?>
                    <div class="center-align">
                        <a title="Lien pour l'ajout d'un horaire" class="btn lime darken-3 boldText" id="addTimetableButton"><i class="large material-icons right">expand_more</i>Ajouter un horaire</a>
                        <div id="timetableForm">
                            <!-----------------Formulaire d'ajout d'horaire----------------->
                            <form action="#" method="POST" class="col s12">
                                <div class="input-field col m2 offset-m2 s12">
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
                                <div class="input-field col m2 s12">
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
                                <!--Bouton de validation du formulaire-->
                                <div class="center-align">
                                    <button class="btn waves-effect waves-light lime darken-3" type="submit" name="addTimetablesSubmit" id="addTimetablesSubmit">Enregistrer les horaires</button>
                                </div>
                            </form>
                        </div>
                        <p class="boldText red-text text-darken-1 center-align">
                            <?php
                            //ternaire permettant l'affichage du message d'erreur si la méthode ne s'exécute pas
                            echo isset($formError['addTimetablesSubmit']) ? $formError['addTimetablesSubmit'] : '';
                            ?>
                        </p>
                    </div>
                    <?php
                }
            }
            ?>
        </div>
    </div>
    <div class="row">
        <div class="col m10 offset-m1 s12 lime lighten-2">
            <h3 class="sectionTitle">Tarifs</h3>
            <div class="row">
                <table class="striped centered responsive-table col m10 offset-m1">
                    <thead>
                        <tr class="white">
                            <th>Tarif</th>
                            <th>Type de tarif</th>
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
                                <td><?= $priceDetail->price ?></td>
                                <td><?= $priceDetail->priceType ?></td>
                                <td><?= $priceDetail->name ?></td>
                                <td><?= $priceDetail->editDatePrices ?></td>
                                <?php
                                if (isset($_SESSION['isConnect'])) {
                                    if ($_SESSION['idUserTypes'] == 2) { //Affichage des fonctionnalités propres aux contributeurs
                                        ?>
                                        <td>
                                            <a href="Lieu?id=<?= $placeInfo->id ?>&idPriceDelete=<?= $priceDetail->id ?>" class="btn-floating waves-effect waves-light red accent-4"><i class="material-icons">delete</i></a>
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
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <?php
            if (isset($_SESSION['isConnect'])) {
                if ($_SESSION['idUserTypes'] == 2) { //Affichage des fonctionnalités propres aux contributeurs
                    ?>
                    <div class="center-align">
                        <a title="Lien pour l'ajout d'un tarif" class="btn lime darken-3 boldText" id="addPriceButton"><i class="large material-icons right">expand_more</i>Ajouter un tarif</a>
                        <div id="priceForm">
                            <form action="#" method="POST" class="col s12" id="pricesForm">
                                <div class="row">
                                    <div class="input-field col m2 offset-m2 s12">
                                        <input type="text" name="price" id="price" placeholder="12.50€" class="validate" value="" />
                                        <label for="price">Tarif</label>
                                        <?php
                                        if (isset($formError['price'])) { //affichage du message d'erreur si le tableau d'erreur existe
                                            ?>
                                            <p class="boldText red-text text-darken-1 center-align"><?= $formError['price']; ?></p>
                                        <?php } ?>
                                    </div>
                                    <div class="input-field col m2 s12">
                                        <select name="idPriceTypes">
                                            <option value="0" disabled selected>Type de tarif</option>
                                            <?php
                                            foreach ($priceTypesList as $priceTypeDetail) { //boucle permettant d'afficher la liste des jours de la semaine
                                                ?>
                                                <option value="<?= $priceTypeDetail->id ?>"><?= $priceTypeDetail->name ?></option>
                                            <?php } ?>
                                        </select>
                                        <label for="idPriceTypes">Sélectionner un type de tarif</label>
                                        <?php
                                        if (isset($formError['idPriceTypes'])) { //affichage du message d'erreur si le tableau d'erreur existe
                                            ?>
                                            <p class="boldText red-text text-darken-1 center-align"><?= $formError['idPriceTypes']; ?></p>
                                        <?php } ?>
                                    </div>
                                    <div class="input-field col m4 s12">
                                        <input type="text" name="priceName" id="priceName" value="<?= isset($place->name) ? $place->name : '' ?>" />
                                        <label for="priceName">Nom du tarif (facultatif)</label>
                                        <?php
                                        if (isset($formError['priceName'])) { //affichage du message d'erreur si le tableau d'erreur existe
                                            ?>
                                            <p class="boldText red-text text-darken-1 center-align"><?= $formError['priceName']; ?></p>
                                        <?php } ?>
                                    </div>
                                </div>
                                <!--Bouton de validation du formulaire-->
                                <div class="center-align">
                                    <button class="btn waves-effect waves-light lime darken-3" type="submit" name="addPricesSubmit" id="addPricesSubmit">Enregistrer les tarifs</button>
                                </div>
                            </form>
                        </div>
                        <p class="boldText red-text text-darken-1 center-align">
                            <?php
                            //ternaire permettant l'affichage du message d'erreur si la méthode ne s'exécute pas
                            echo isset($formError['addPricesSubmit']) ? $formError['addPricesSubmit'] : '';
                            ?>
                        </p>
                    </div>
                    <?php
                }
            }
            ?>
        </div>
    </div>


    <!--Modal pour l'ajout d'une photo-->
    <div id="addPictureModal" class="modal">
        <div class="modal-content">
            <h3 class="center-align">Ajouter une photo</h3>
            <form action="#" method="POST" enctype="multipart/form-data" class="col s12" id="addPicture">
                <div class="row">
                    <div class="file-field input-field">
                        <div class="btn orange darken-3 boldText col m2 s12">
                            <span>Parcourir</span>
                            <input type="file" />
                        </div>
                        <div class="file-path-wrapper col m10 s12">
                            <input type="text" name="picture" class="file-path validate"  />
                        </div>
                        <?php
                        if (isset($formError['picture'])) { //affichage du message d'erreur si le tableau d'erreur existe
                            ?>
                            <p class="boldText red-text text-darken-1 center-align"><?= $formError['picture']; ?></p>
                        <?php } ?>
                    </div>
                    <div class="input-field hide">
                        <input type="text" name="idPlace" id="idPlace" value="<?= $placeInfo->id ?>" required />
                        <label for="idPlace"></label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field center-align col s8 offset-s2">
                        <button class="btn waves-effect waves-light lime darken-3" type="submit" name="addPictureSubmit" id="addPictureSubmit">Ajouter la photo</button>
                    </div>
                </div>
            </form>
            <div class="modal-footer col s12">
                <a href="#!" class="modal-close waves-effect waves-green btn grey boldText">Annuler</a>
            </div>
        </div>
    </div>

</div>
<?php
//insertion du footer
include_once path::getRootPath() . 'footer.php';
?>