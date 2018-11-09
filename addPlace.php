<?php
include_once 'classes/path.php';
include_once path::getRootPath() . 'header.php';
include_once path::getControllersPath() . 'addPlaceCtrl.php'
?>
<div>
    <h2 class="center-align">Ajout d'un nouveau site touristique</h2>
    <div class="row">
        <form action="#" method="POST" class="col s12" id="addPlace">
            <div class="row">
                <div class="input-field col m5 offset-m2 s12">
                    <i class="material-icons prefix">account_circle</i>
                    <input type="text" name="placeName" id="placeName" value="<?= /* garde en mémoire la saisie dans le champ */ isset($user->placeName) ? $user->placeName : '' ?>" required />
                    <label for="placeName">Nom du site touristique</label>
                </div>
                <div class="input-field col m3 s12">
                    <i class="material-icons prefix">assignment_ind</i>
                    <select name="idUserTypes" required>
                        <option value="0" disabled selected>Catégorie</option>
                        <?php
                        //boucle permettant d'afficher la liste des types d'utilisateur
                        foreach ($categoriesList as $categorieDetail) {
                            ?>
                            <option value="<?= $categorieDetail->id ?>" <?= ((isset($user->idUserTypes)) && ($user->idUserTypes == $categorieDetail->id)) ? 'selected' : '' ?>><?= $categorieDetail->name ?></option>
                        <?php } ?>
                    </select>
                    <label for="idUserTypes">Veuillez sélectionner une catégorie : </label>
                </div>
                <!--Ajouter un select pour la categorie à coté du nom-->
            </div>
            <div class="row">
                <div class="input-field col m8 offset-m2 s12">
                    <i class="material-icons prefix">account_circle</i>
                    <input type="text" name="placeAddressStreet" id="placeAddressStreet" value="" required />
                    <label for="placeAddressStreet">Adresse (N° et rue)</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col m4 offset-m2 s12">
                    <i class="material-icons prefix">account_circle</i>
                    <input type="text" name="placeAddressPostalCode" id="placeAddressPostalCode" value="" required />
                    <label for="placeAddressPostalCode">Adresse (Code postal)</label>
                </div>
                <div class="input-field col m4 s12">
                    <i class="material-icons prefix">account_circle</i>
                    <input type="text" name="placeAddressCity" id="placeAddressCity" value="" required />
                    <label for="placeAddressCity">Adresse (Ville)</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col m2 offset-m2 s12">
                    <i class="material-icons prefix">account_circle</i>
                    <input type="text" name="placePhone" id="placePhone" value="" required />
                    <label for="placePhone">N° de téléphone</label>
                </div>
                <div class="input-field col m3 s12">
                    <i class="material-icons prefix">account_circle</i>
                    <input type="text" name="placeMail" id="placeMail" value="" required />
                    <label for="placeMail">Adresse mail</label>
                </div>
                <div class="input-field col m3 s12">
                    <i class="material-icons prefix">account_circle</i>
                    <input type="text" name="placeWebsite" id="placeWebsite" value="" required />
                    <label for="placeWebsite">Site web du lieu touristique</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col m5 s10 offset-m5 offset-s2">
                    <button class="btn waves-effect waves-light lime darken-3" type="submit" name="addPlaceSubmit" id="addPlaceSubmit">Ajouter un lieu</button>
                </div>
            </div>
        </form>
    </div>
</div>
<?php include_once path::getRootPath() . 'footer.php'; ?>    