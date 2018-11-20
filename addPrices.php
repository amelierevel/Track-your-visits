<?php
//insertion du fichier path, du header et du controller
include_once 'classes/path.php';
include_once path::getRootPath() . 'header.php';
include_once path::getControllersPath() . 'addPricesCtrl.php'
?>
<div>
    <h2 class="center-align">Ajouter les tarifs de <?= $placeInfo->name ?></h2>
    <?php
    //vérification de l'envoi du formulaire et qu'il n'y a pas d'erreurs puis affichage d'un message de succès
    if (isset($_POST['addPricesSubmit']) && (count($formError) === 0)) {
        ?>
        <div class="center-align">
            <p class="boldText green-text center-align">Les tarifs ont bien été enregistrés</p>
        </div>
        <?php
    } else { //sinon affichage des messages d'erreurs
        ?>  
        <div class="row">
            <form action="#" method="POST" class="col s12" id="addPrices">
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
            <p class="boldText red-text text-darken-1 center-align">
                <?php
                //ternaire permettant l'affichage du message d'erreur si la méthode ne s'exécute pas
                echo isset($formError['addPricesSubmit']) ? $formError['addPricesSubmit'] : '';
                ?>
            </p>
        <?php } ?>
    </div>
</div>
<?php
//insertion du footer
include_once path::getRootPath() . 'footer.php';
?>