<?php
//insertion du fichier path, du header et du controller
include_once 'classes/path.php';
include_once path::getRootPath() . 'header.php';
include_once path::getControllersPath() . 'addPlaceCtrl.php'
?>
<div>
    <h2 class="center-align">Ajout d'un nouveau lieu</h2>
    <div class="row">
        <h3 class="col s10 offset-s2">Informations générales</h3>
        <?php
        //vérification de l'envoi du formulaire et qu'il n'y a pas d'erreurs puis affichage d'un message de succès
        if (isset($_POST['addPlaceSubmit']) && (count($formError) === 0)) {
            ?> 
            <div class="center-align">
                <p>Votre lieu <span class="boldText">"<?= $place->name ?>"</span> a bien été enregistré. Vous pouvez désormais ajouter ses horaires et ses tarifs</p>
                <a href="Ajout-horaires?id=<?= $lastInsertIdPlace->id ?>" class="boldText btn waves-effect waves-light lime darken-3" title="Lien vers l'ajout des horaires">Ajouter les horaires</a>
                <a href="Ajout-tarifs?id=<?= $lastInsertIdPlace->id ?>" class="boldText btn waves-effect waves-light lime darken-3" title="Lien vers l'ajout des tarifs">Ajouter les tarifs</a>
            </div>
            <?php
        } else { //sinon affichage des messages d'erreurs
            ?>  
            <form action="#" method="POST" class="col s12" id="addPlace">
                <!--Champs nom et catégorie-->
                <div class="row">
                    <div class="input-field col m5 offset-m2 s12">
                        <i class="material-icons prefix">location_on</i>
                        <input type="text" name="placeName" id="placeName" value="<?= /* garde en mémoire la saisie dans le champ */ isset($place->name) ? $place->name : '' ?>" required />
                        <label for="placeName">Nom du lieu</label>
                        <?php
                        if (isset($formError['placeName'])) { //affichage du message d'erreur si le tableau d'erreur existe
                            ?>
                            <p class="boldText red-text text-darken-1 center-align"><?= $formError['placeName']; ?></p>
                        <?php } ?>
                    </div>
                    <div class="input-field col m3 s12">
                        <i class="material-icons prefix">assistant</i>
                        <select name="idCategories" required>
                            <option value="0" disabled selected>Catégorie</option>
                            <?php
                            foreach ($categoriesList as $categorieDetail) { //boucle permettant d'afficher la liste des catégories
                                ?>
                                <option value="<?= $categorieDetail->id ?>" <?= ((isset($place->idCategories)) && ($place->idCategories == $categorieDetail->id)) ? 'selected' : '' ?>><?= $categorieDetail->name ?></option>
                            <?php } ?>
                        </select>
                        <label for="idCategories">Veuillez sélectionner une catégorie</label>
                        <?php
                        if (isset($formError['idCategories'])) { //affichage du message d'erreur si le tableau d'erreur existe
                            ?>
                            <p class="boldText red-text text-darken-1 center-align"><?= $formError['idCategories']; ?></p>
                        <?php } ?>
                    </div>
                </div>
                <!--Champs adresse-->
                <div class="row">
                    <div class="input-field col m4 offset-m2 s12">
                        <i class="material-icons prefix">explore</i>
                        <input type="text" name="postalCode" id="postalCode" value="<?= isset($postalCode) ? $postalCode : '' ?>" required />
                        <label for="postalCode">Adresse (Code postal)</label>
                        <?php
                        if (isset($formError['postalCode'])) { //affichage du message d'erreur si le tableau d'erreur existe
                            ?>
                            <p class="boldText red-text text-darken-1 center-align"><?= $formError['postalCode']; ?></p>
                        <?php } ?>
                    </div>
                    <div class="input-field col m4 s12">
                        <i class="material-icons prefix">explore</i>
                        <select name="idCities" id="idCities" required>
                            <option value="0" disabled selected>Veuillez sélectionner une ville</option>
                            <?php
                            foreach ($citiesList as $cityDetail) { //boucle permettant d'afficher la liste des villes
                                ?>
                                <option value="<?= $cityDetail->id ?>" <?= ((isset($place->idCities)) && ($place->idCities == $cityDetail->id)) ? 'selected' : '' ?>><?= $cityDetail->city ?></option>
                            <?php } ?>
                        </select>
                        <label for="idCities">Adresse (Ville)</label>
                        <?php
                        if (isset($formError['idCities'])) { //affichage du message d'erreur si le tableau d'erreur existe
                            ?>
                            <p class="boldText red-text text-darken-1 center-align"><?= $formError['idCities']; ?></p>
                        <?php } ?>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col m8 offset-m2 s12">
                        <i class="material-icons prefix">home</i>
                        <input type="text" name="address" id="address" value="<?= isset($place->address) ? $place->address : '' ?>" required />
                        <label for="address">Adresse (N° et rue)</label>
                        <?php
                        if (isset($formError['address'])) { //affichage du message d'erreur si le tableau d'erreur existe
                            ?>
                            <p class="boldText red-text text-darken-1 center-align"><?= $formError['address']; ?></p>
                        <?php } ?>
                    </div>
                </div>
                <!--Champs téléphone, mail et site web du lieu touristique-->
                <div class="row">
                    <div class="input-field col m2 offset-m2 s12">
                        <i class="material-icons prefix">phone</i>
                        <input type="text" name="phone" id="phone" value="<?= isset($place->phone) ? $place->phone : '' ?>" />
                        <label for="phone">N° de téléphone (facultatif)</label>
                        <?php
                        if (isset($formError['phone'])) { //affichage du message d'erreur si le tableau d'erreur existe
                            ?>
                            <p class="boldText red-text text-darken-1 center-align"><?= $formError['phone']; ?></p>
                        <?php } ?>
                    </div>
                    <div class="input-field col m3 s12">
                        <i class="material-icons prefix">email</i>
                        <input type="email" name="mail" id="mail" value="<?= isset($place->mail) ? $place->mail : '' ?>" />
                        <label for="mail">Adresse mail (facultatif)</label>
                        <?php
                        if (isset($formError['mail'])) { //affichage du message d'erreur si le tableau d'erreur existe
                            ?>
                            <p class="boldText red-text text-darken-1 center-align"><?= $formError['mail']; ?></p>
                        <?php } ?>
                    </div>
                    <div class="input-field col m3 s12">
                        <i class="material-icons prefix">desktop_windows</i>
                        <input type="text" name="website" id="website" value="<?= isset($place->website) ? $place->website : '' ?>" />
                        <label for="placeWebsite">Site web du lieu (facultatif)</label>
                        <?php
                        if (isset($formError['website'])) { //affichage du message d'erreur si le tableau d'erreur existe
                            ?>
                            <p class="boldText red-text text-darken-1 center-align"><?= $formError['website']; ?></p>
                        <?php } ?>
                    </div>
                </div>
                <!--Champ description-->
                <div class="row">
                    <div class="input-field col m8 offset-m2 s12">
                        <i class="material-icons prefix">create</i>
                        <textarea class="materialize-textarea" name="description" id="description" value="<?= isset($place->description) ? $place->description : '' ?>" required></textarea>
                        <label for="description">Description du lieu</label>
                        <?php
                        if (isset($formError['description'])) { //affichage du message d'erreur si le tableau d'erreur existe
                            ?>
                            <p class="boldText red-text text-darken-1 center-align"><?= $formError['description']; ?></p>
                        <?php } ?>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field center-align col s8 offset-s2">
                        <button class="btn waves-effect waves-light lime darken-3" type="submit" name="addPlaceSubmit" id="addPlaceSubmit">Ajouter le lieu</button>
                    </div>
                </div>
            </form>
            <p class="boldText red-text text-darken-1 center-align">
                <?php
                //ternaire permettant l'affichage du message d'erreur si la méthode ne s'exécute pas
                echo isset($formError['addPlaceSubmit']) ? $formError['addPlaceSubmit'] : '';
                ?>
            </p>
        <?php } ?>
    </div>
</div>
<?php
//insertion du footer
include_once path::getRootPath() . 'footer.php';
?>    