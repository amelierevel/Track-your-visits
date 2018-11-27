<?php
//insertion du fichier path, du header et du controller
include_once 'classes/path.php';
include_once path::getRootPath() . 'header.php';
include_once path::getControllersPath() . 'updatePlaceCtrl.php'
?>
<div>
    <h2 class="center-align">Modification du lieu <?= $placeInfo->name ?></h2>
    <div class="row">
        <?php
        //vérification de l'envoi du formulaire et qu'il n'y a pas d'erreurs puis affichage d'un message de succès
        if (isset($_POST['updatePlaceSubmit']) && (count($formError) === 0)) {
            ?> 
            <div class="center-align">
                <h3 class="green-text boldText">Félicitations !</h3>
                <p>Les informations de <span class="boldText">"<?= $placeInfo->name ?>"</span> ont bien été modifiées.</p>
                <p>Vous pouvez désormais consulter la page de ce lieu pour y modifier les horaires et les tarifs.</p>
                <a href="Lieu?id=<?= $placeInfo->id ?>" class="boldText btn waves-effect waves-light lime darken-3" title="Lien vers la page du lieu <?= $placeInfo->name ?>">Accéder à la page de <?= $placeInfo->name ?></a>
            </div>
            <?php
        } else { //sinon affichage des messages d'erreurs
            ?>
            <form action="#" method="POST" class="col s12" id="updatePlace">
                <!--Champ catégorie-->
                <div class="row">
                    <div class="input-field col m8 offset-m2 s12">
                        <i class="material-icons prefix">assistant</i>
                        <select name="idCategories" required>
                            <option value="0" disabled selected>Catégorie</option>
                            <?php
                            foreach ($categoriesList as $categorieDetail) { //boucle permettant d'afficher la liste des catégories
                                ?>
                                <option value="<?= $categorieDetail->id ?>" <?= ($placeInfo->idCategories == $categorieDetail->id) ? 'selected' : '' ?>><?= $categorieDetail->name ?></option>
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
                <!--Champs téléphone, mail et site web du lieu touristique-->
                <div class="row">
                    <div class="input-field col m2 offset-m2 s12">
                        <i class="material-icons prefix">phone</i>
                        <input type="text" name="phone" id="phone" value="<?= $placeInfo->phone ?>" />
                        <label for="phone">N° de téléphone (facultatif)</label>
                        <?php
                        if (isset($formError['phone'])) { //affichage du message d'erreur si le tableau d'erreur existe
                            ?>
                            <p class="boldText red-text text-darken-1 center-align"><?= $formError['phone']; ?></p>
                        <?php } ?>
                    </div>
                    <div class="input-field col m3 s12">
                        <i class="material-icons prefix">email</i>
                        <input type="email" name="mail" id="mail" value="<?= $placeInfo->mail ?>" />
                        <label for="mail">Adresse mail (facultatif)</label>
                        <?php
                        if (isset($formError['mail'])) { //affichage du message d'erreur si le tableau d'erreur existe
                            ?>
                            <p class="boldText red-text text-darken-1 center-align"><?= $formError['mail']; ?></p>
                        <?php } ?>
                    </div>
                    <div class="input-field col m3 s12">
                        <i class="material-icons prefix">desktop_windows</i>
                        <input type="text" name="website" id="website" value="<?= $placeInfo->website ?>" placeholder="https://materializecss.com/" />
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
                        <textarea class="materialize-textarea" name="description" id="description" required><?= $placeInfo->description ?></textarea>
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
                        <button class="btn waves-effect waves-light lime darken-3" type="submit" name="updatePlaceSubmit" id="updatePlaceSubmit">Enregistrer les modifications</button>
                    </div>
                </div>
            </form>
            <p class="boldText red-text text-darken-1 center-align">
                <?php
                //ternaire permettant l'affichage du message d'erreur si la méthode ne s'exécute pas
                echo isset($formError['updatePlaceSubmit']) ? $formError['updatePlaceSubmit'] : '';
                ?>
            </p>
        <?php } ?>
    </div>
</div>
<?php
//insertion du footer
include_once path::getRootPath() . 'footer.php';
?>    
