<?php
//insertion du fichier path, du header et du controller
include_once 'classes/path.php';
include_once path::getRootPath() . 'header.php';
include_once path::getControllersPath() . 'getAPlaceCtrl.php';
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
                                <button class="btn-flat btn-large white"><a href="#" title="Lieux à voir"><i class="fas fa-eye greenIcon"></i></a></button>
                            <?php } else { ?>
                                <div class="input-field hide">
                                    <input type="text" name="idPlace" id="idPlace" value="<?= $placeInfo->id ?>" required />
                                    <label for="idPlace"></label>
                                </div>
                                <div class="input-field hide">
                                    <input type="text" name="idUser" id="idUser" value="<?= $_SESSION['id'] ?>" required />
                                    <label for="idUser"></label>
                                </div>
                                <button class="btn-flat btn-large white" type="submit" name="addPlaceToSeeSubmit" id="addPlaceToSeeSubmit">
                                    <a href="#" title="Ajouter aux lieux à voir"><i class="fas fa-eye fa-lg blackIcon"></i></a>
                                </button>
                            <?php } ?>
                        </form>
                        <form action="#" method="POST" class="col m1">
                            <div class="input-field hide">
                                <input type="text" name="idPlace" id="idPlace" value="<?= $placeInfo->id ?>" required />
                                <label for="idPlace"></label>
                            </div>
                            <div class="input-field hide">
                                <input type="text" name="idUser" id="idUser" value="<?= $_SESSION['id'] ?>" required />
                                <label for="idUser"></label>
                            </div>
                            <button class="btn-flat btn-large white" type="submit" name="addVisitedPlaceSubmit" id="addVisitedPlaceSubmit">
                                <a href="#" title="Ajouter aux lieux vus"><i class="far fa-check-circle fa-lg blackIcon"></i></a>
                            </button>
                        </form>
                    </div>
                    <p class="red-text text-darken-1 right-align">
                        <?php
                        //ternaire permettant l'affichage du message d'erreur si le lieu fait déjà parti des lieux à voir de l'utilisateur
                        echo isset($formError['alreadyAdded']) ? $formError['alreadyAdded'] : '';
                        ?>
                    </p>
                </div>
            <?php } ?>
            <p><span class="boldText">Description : </span><?= $placeInfo->description ?></p>
        </div>
    </div>
    <div class="row">
        <div class="col m3 offset-m1 s12 lime lighten-2">
            <h3 class="sectionTitle">Contact</h3>
            <ul class="collapsible">
                <li>
                    <div class="collapsible-header"><i class="material-icons">home</i>Adresse</div>
                    <div class="collapsible-body white"><?= $placeInfo->address ?> - <?= $placeInfo->postalCode ?> <?= $placeInfo->city ?></div>
                </li>
                <li>
                    <div class="collapsible-header"><i class="material-icons">phone</i>Téléphone</div>
                    <div class="collapsible-body white"><?= $placeInfo->phone ?></div>
                </li>
                <li>
                    <div class="collapsible-header"><i class="material-icons">email</i>Mail</div>
                    <div class="collapsible-body white"><?= $placeInfo->mail ?></div>
                </li>
                <li>
                    <div class="collapsible-header"><i class="material-icons">desktop_windows</i>Site internet</div>
                    <div class="collapsible-body white">
                        <a href="<?= $placeInfo->website ?>" title="Lien vers le site de <?= $placeInfo->name ?>" target="_blank"><?= $placeInfo->website ?></a>
                    </div>
                </li>
            </ul>
        </div>
        <div class="col m4 s12 lime lighten-2">
            <h3 class="sectionTitle">Horaires</h3>
        </div>
        <div class="col m3 s12 lime lighten-2">
            <h3 class="sectionTitle">Tarifs</h3>
        </div>
    </div>
    <div class="row">
        <div class="col m10 offset-m1">
            <a href="Ajout-horaires?id=<?= $placeInfo->id ?>">Ajouter les horaires</a>
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