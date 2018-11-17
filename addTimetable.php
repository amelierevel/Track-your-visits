<?php
//insertion du fichier path, du header et du controller
include_once 'classes/path.php';
include_once path::getRootPath() . 'header.php';
include_once path::getControllersPath() . 'addTimetableCtrl.php'
?>
<div>
    <h2 class="center-align">Ajouter les horaires de <?= $placeInfo->name ?></h2>
    <?php
    //vérification de l'envoi du formulaire et qu'il n'y a pas d'erreurs puis affichage d'un message de succès
    if (isset($_POST['addTimetablesSubmit']) && (count($formError) === 0)) {
        ?>
        <div class="center-align">
            <p class="boldText green-text center-align">Les horaires ont bien été enregistrés</p>
        </div>
        <?php
    } else { //sinon affichage des messages d'erreurs
        ?>  
        <div class="row">
            <form action="#" method="POST" class="col s12" id="addTimetables">
                <?php for ($count = 1; $count <= 2; $count++) { ?>
                    <!-----------------Ajout d'horaire 1 (Lundi)----------------->
                    <div class="row">
                        <div class="input-field col m2 offset-m2 s12">
                            <select name="idDays[<?=$count?>]" required>
                                <option value="0" disabled selected>Jour</option>
                                <?php
                                foreach ($daysList as $dayDetail) { //boucle permettant d'afficher la liste des jours de la semaine
                                    ?>
                                    <option value="<?= $dayDetail->id ?>" <?= ((isset($timetable->idDays)) && ($timetable->idDays == $dayDetail->id)) ? 'selected' : '' ?>><?= $dayDetail->day ?></option>
                                <?php } ?>
                            </select>
                            <label for="idDays[]">Sélectionner un jour</label>
                            <?php
                            if (isset($formError['idDays'])) { //affichage du message d'erreur si le tableau d'erreur existe
                                ?>
                                <p class="boldText red-text text-darken-1 center-align"><?= $formError['idDays']; ?></p>
                            <?php } ?>
                        </div>
                        <div class="input-field col m2 s12">
                            <select name="idTimetableTypes[]" required>
                                <option value="0" disabled selected>Période</option>
                                <?php
                                foreach ($timetableTypesList as $timetableTypeDetail) { //boucle permettant d'afficher la liste des périodes horaires (timetableTypes)
                                    ?>
                                    <option value="<?= $timetableTypeDetail->id ?>" <?= ((isset($timetable->idTimetableTypes)) && ($timetable->idTimetableTypes == $timetableTypeDetail->id)) ? 'selected' : '' ?>><?= $timetableTypeDetail->name ?></option>
                                <?php } ?>
                            </select>
                            <label for="idTimetableTypes[]">Sélectionner une période horaire</label>
                            <?php
                            if (isset($formError['idTimetableTypes'])) { //affichage du message d'erreur si le tableau d'erreur existe
                                ?>
                                <p class="boldText red-text text-darken-1 center-align"><?= $formError['idTimetableTypes']; ?></p>
                            <?php } ?>
                        </div>
                        <div class="input-field col m2 s5 offset-s1">
                            <input type="time" name="opening[]" id="opening" placeholder="--:--" class="validate" value="<?= isset($timetable->opening) ? $timetable->opening : '' ?>" />
                            <label for="opening[]">Horaire d'ouverture</label>
                            <?php
                            if (isset($formError['opening'])) { //affichage du message d'erreur si le tableau d'erreur existe
                                ?>
                                <p class="boldText red-text text-darken-1 center-align"><?= $formError['opening']; ?></p>
                            <?php } ?>
                        </div>
                        <div class="input-field col m2 s5">
                            <input type="time" name="closing[]" id="closing" placeholder="--:--" class="validate" value="<?= isset($timetable->closing) ? $timetable->closing : '' ?>" />
                            <label for="closing[]">Horaire de fermeture</label>
                            <?php
                            if (isset($formError['closing'])) { //affichage du message d'erreur si le tableau d'erreur existe
                                ?>
                                <p class="boldText red-text text-darken-1 center-align"><?= $formError['closing']; ?></p>
                            <?php } ?>
                        </div>
                    </div>
                <?php } ?>
                <!--               ---------------Ajout d'horaire 2 (Mardi)---------------
                <div class="row">
                    <div class="input-field col m2 offset-m2 s12">
                        <select name="idDays[]" required>
                            <option value="0" disabled selected>Jour</option>
                <?php
                //boucle permettant d'afficher la liste des jours de la semaine 
                foreach ($daysList as $dayDetail) {
                    ?>
                                    <option value="<?= $dayDetail->id ?>" <?= ((isset($timetable->idDays)) && ($timetable->idDays == $dayDetail->id)) ? 'selected' : '' ?>><?= $dayDetail->day ?></option>
                <?php } ?>
                        </select>
                        <label for="idDays[]">Sélectionner un jour</label>
                <?php
                //affichage du message d'erreur si le tableau d'erreur existe
                if (isset($formError['idDays[]'])) {
                    ?>
                                <p class="boldText red-text text-darken-1 center-align"><?= $formError['idDays[]']; ?></p>
                <?php } ?>
                    </div>
                    <div class="input-field col m2 s12">
                        <select name="idTimetableTypes[]" required>
                            <option value="0" disabled selected>Période</option>
                <?php
                //boucle permettant d'afficher la liste des périodes horaires (timetableTypes)
                foreach ($timetableTypesList as $timetableTypeDetail) {
                    ?>
                                    <option value="<?= $timetableTypeDetail->id ?>" <?= ((isset($timetable->idTimetableTypes)) && ($timetable->idTimetableTypes == $timetableTypeDetail->id)) ? 'selected' : '' ?>><?= $timetableTypeDetail->name ?></option>
                <?php } ?>
                        </select>
                        <label for="idTimetableTypes[]">Sélectionner une période horaire</label>
                <?php
                //affichage du message d'erreur si le tableau d'erreur existe
                if (isset($formError['idTimetableTypes[]'])) {
                    ?>
                                <p class="boldText red-text text-darken-1 center-align"><?= $formError['idTimetableTypes[]']; ?></p>
                <?php } ?>
                    </div>
                    <div class="input-field col m2 s5 offset-s1">
                        <input type="time" name="opening[]" id="opening" placeholder="--:--" class="validate" value="<?= isset($timetable->opening) ? $timetable->opening : '' ?>" />
                        <label for="opening[]">Horaire d'ouverture</label>
                <?php
                //affichage du message d'erreur si le tableau d'erreur existe
                if (isset($formError['opening[]'])) {
                    ?>
                                <p class="boldText red-text text-darken-1 center-align"><?= $formError['opening[]']; ?></p>
                <?php } ?>
                    </div>
                    <div class="input-field col m2 s5">
                        <input type="time" name="closing[]" id="closing" placeholder="--:--" class="validate" value="<?= isset($timetable->closing) ? $timetable->closing : '' ?>" />
                        <label for="closing[]">Horaire de fermeture</label>
                <?php
                //affichage du message d'erreur si le tableau d'erreur existe
                if (isset($formError['closing[]'])) {
                    ?>
                                <p class="boldText red-text text-darken-1 center-align"><?= $formError['closing[]']; ?></p>
                <?php } ?>
                    </div>
                </div>-->
                <!--            ---------------Ajout d'horaire 3 (Mercredi)---------------
                <div class="row">
                    <div class="input-field col m2 offset-m2 s12">
                        <select name="idDays[]" required>
                            <option value="0" disabled selected>Jour</option>
                <?php
                //boucle permettant d'afficher la liste des jours de la semaine
                foreach ($daysList as $dayDetail) {
                    ?>
                                    <option value="<?= $dayDetail->id ?>" <?= ((isset($timetable->idDays)) && ($timetable->idDays == $dayDetail->id)) ? 'selected' : '' ?>><?= $dayDetail->day ?></option>
                <?php } ?>
                        </select>
                        <label for="idDays[]">Sélectionner un jour</label>
                <?php
                //affichage du message d'erreur si le tableau d'erreur existe
                if (isset($formError['idDays[]'])) {
                    ?>
                                <p class="boldText red-text text-darken-1 center-align"><?= $formError['idDays[]']; ?></p>
                <?php } ?>
                    </div>
                    <div class="input-field col m2 s12">
                        <select name="idTimetableTypes[]" required>
                            <option value="0" disabled selected>Période</option>
                <?php
                //boucle permettant d'afficher la liste des périodes horaires (timetableTypes)
                foreach ($timetableTypesList as $timetableTypeDetail) {
                    ?>
                                    <option value="<?= $timetableTypeDetail->id ?>" <?= ((isset($timetable->idTimetableTypes)) && ($timetable->idTimetableTypes == $timetableTypeDetail->id)) ? 'selected' : '' ?>><?= $timetableTypeDetail->name ?></option>
                <?php } ?>
                        </select>
                        <label for="idTimetableTypes[]">Sélectionner une période horaire</label>
                <?php
                //affichage du message d'erreur si le tableau d'erreur existe
                if (isset($formError['idTimetableTypes[]'])) {
                    ?>
                                <p class="boldText red-text text-darken-1 center-align"><?= $formError['idTimetableTypes[]']; ?></p>
                <?php } ?>
                    </div>
                    <div class="input-field col m2 s5 offset-s1">
                        <input type="time" name="opening[]" id="opening" placeholder="--:--" class="validate" value="<?= isset($timetable->opening) ? $timetable->opening : '' ?>" />
                        <label for="opening[]">Horaire d'ouverture</label>
                <?php
                //affichage du message d'erreur si le tableau d'erreur existe
                if (isset($formError['opening[]'])) {
                    ?>
                                <p class="boldText red-text text-darken-1 center-align"><?= $formError['opening[]']; ?></p>
                <?php } ?>
                    </div>
                    <div class="input-field col m2 s5">
                        <input type="time" name="closing[]" id="closing" placeholder="--:--" class="validate" value="<?= isset($timetable->closing) ? $timetable->closing : '' ?>" />
                        <label for="closing[]">Horaire de fermeture</label>
                <?php
                //affichage du message d'erreur si le tableau d'erreur existe
                if (isset($formError['closing[]'])) {
                    ?>
                                <p class="boldText red-text text-darken-1 center-align"><?= $formError['closing[]']; ?></p>
                <?php } ?>
                    </div>
                </div>
            ---------------Ajout d'horaire 4 (Jeudi)---------------
                <div class="row">
                    <div class="input-field col m2 offset-m2 s12">
                        <select name="idDays[]" required>
                            <option value="0" disabled selected>Jour</option>
                <?php
                //boucle permettant d'afficher la liste des jours de la semaine
                foreach ($daysList as $dayDetail) {
                    ?>
                                    <option value="<?= $dayDetail->id ?>" <?= ((isset($timetable->idDays)) && ($timetable->idDays == $dayDetail->id)) ? 'selected' : '' ?>><?= $dayDetail->day ?></option>
                <?php } ?>
                        </select>
                        <label for="idDays[]">Sélectionner un jour</label>
                <?php
                //affichage du message d'erreur si le tableau d'erreur existe
                if (isset($formError['idDays[]'])) {
                    ?>
                                <p class="boldText red-text text-darken-1 center-align"><?= $formError['idDays[]']; ?></p>
                <?php } ?>
                    </div>
                    <div class="input-field col m2 s12">
                        <select name="idTimetableTypes[]" required>
                            <option value="0" disabled selected>Période</option>
                <?php
                //boucle permettant d'afficher la liste des périodes horaires (timetableTypes)
                foreach ($timetableTypesList as $timetableTypeDetail) {
                    ?>
                                    <option value="<?= $timetableTypeDetail->id ?>" <?= ((isset($timetable->idTimetableTypes)) && ($timetable->idTimetableTypes == $timetableTypeDetail->id)) ? 'selected' : '' ?>><?= $timetableTypeDetail->name ?></option>
                <?php } ?>
                        </select>
                        <label for="idTimetableTypes[]">Sélectionner une période horaire</label>
                <?php
                //affichage du message d'erreur si le tableau d'erreur existe
                if (isset($formError['idTimetableTypes[]'])) {
                    ?>
                                <p class="boldText red-text text-darken-1 center-align"><?= $formError['idTimetableTypes[]']; ?></p>
                <?php } ?>
                    </div>
                    <div class="input-field col m2 s5 offset-s1">
                        <input type="time" name="opening[]" id="opening" placeholder="--:--" class="validate" value="<?= isset($timetable->opening) ? $timetable->opening : '' ?>" />
                        <label for="opening[]">Horaire d'ouverture</label>
                <?php
                //affichage du message d'erreur si le tableau d'erreur existe
                if (isset($formError['opening[]'])) {
                    ?>
                                <p class="boldText red-text text-darken-1 center-align"><?= $formError['opening[]']; ?></p>
                <?php } ?>
                    </div>
                    <div class="input-field col m2 s5">
                        <input type="time" name="closing[]" id="closing" placeholder="--:--" class="validate" value="<?= isset($timetable->closing) ? $timetable->closing : '' ?>" />
                        <label for="closing[]">Horaire de fermeture</label>
                <?php
                //affichage du message d'erreur si le tableau d'erreur existe
                if (isset($formError['closing[]'])) {
                    ?>
                                <p class="boldText red-text text-darken-1 center-align"><?= $formError['closing[]']; ?></p>
                <?php } ?>
                    </div>
                </div>
            ---------------Ajout d'horaire 5 (Vendredi)---------------
                <div class="row">
                    <div class="input-field col m2 offset-m2 s12">
                        <select name="idDays[]" required>
                            <option value="0" disabled selected>Jour</option>
                <?php
                //boucle permettant d'afficher la liste des jours de la semaine
                foreach ($daysList as $dayDetail) {
                    ?>
                                    <option value="<?= $dayDetail->id ?>" <?= ((isset($timetable->idDays)) && ($timetable->idDays == $dayDetail->id)) ? 'selected' : '' ?>><?= $dayDetail->day ?></option>
                <?php } ?>
                        </select>
                        <label for="idDays[]">Sélectionner un jour</label>
                <?php
                //affichage du message d'erreur si le tableau d'erreur existe
                if (isset($formError['idDays[]'])) {
                    ?>
                                <p class="boldText red-text text-darken-1 center-align"><?= $formError['idDays[]']; ?></p>
                <?php } ?>
                    </div>
                    <div class="input-field col m2 s12">
                        <select name="idTimetableTypes[]" required>
                            <option value="0" disabled selected>Période</option>
                <?php
                //boucle permettant d'afficher la liste des périodes horaires (timetableTypes)
                foreach ($timetableTypesList as $timetableTypeDetail) {
                    ?>
                                    <option value="<?= $timetableTypeDetail->id ?>" <?= ((isset($timetable->idTimetableTypes)) && ($timetable->idTimetableTypes == $timetableTypeDetail->id)) ? 'selected' : '' ?>><?= $timetableTypeDetail->name ?></option>
                <?php } ?>
                        </select>
                        <label for="idTimetableTypes[]">Sélectionner une période horaire</label>
                <?php
                //affichage du message d'erreur si le tableau d'erreur existe
                if (isset($formError['idTimetableTypes[]'])) {
                    ?>
                                <p class="boldText red-text text-darken-1 center-align"><?= $formError['idTimetableTypes[]']; ?></p>
                <?php } ?>
                    </div>
                    <div class="input-field col m2 s5 offset-s1">
                        <input type="time" name="opening[]" id="opening" placeholder="--:--" class="validate" value="<?= isset($timetable->opening) ? $timetable->opening : '' ?>" />
                        <label for="opening[]">Horaire d'ouverture</label>
                <?php
                //affichage du message d'erreur si le tableau d'erreur existe
                if (isset($formError['opening[]'])) {
                    ?>
                                <p class="boldText red-text text-darken-1 center-align"><?= $formError['opening[]']; ?></p>
                <?php } ?>
                    </div>
                    <div class="input-field col m2 s5">
                        <input type="time" name="closing[]" id="closing" placeholder="--:--" class="validate" value="<?= isset($timetable->closing) ? $timetable->closing : '' ?>" />
                        <label for="closing[]">Horaire de fermeture</label>
                <?php
                //affichage du message d'erreur si le tableau d'erreur existe
                if (isset($formError['closing[]'])) {
                    ?>
                                <p class="boldText red-text text-darken-1 center-align"><?= $formError['closing[]']; ?></p>
                <?php } ?>
                    </div>
                </div>
            ---------------Ajout d'horaire 6 (Samedi)---------------
                <div class="row">
                    <div class="input-field col m2 offset-m2 s12">
                        <select name="idDays[]" required>
                            <option value="0" disabled selected>Jour</option>
                <?php
                //boucle permettant d'afficher la liste des jours de la semaine
                foreach ($daysList as $dayDetail) {
                    ?>
                                    <option value="<?= $dayDetail->id ?>" <?= ((isset($timetable->idDays)) && ($timetable->idDays == $dayDetail->id)) ? 'selected' : '' ?>><?= $dayDetail->day ?></option>
                <?php } ?>
                        </select>
                        <label for="idDays[]">Sélectionner un jour</label>
                <?php
                //affichage du message d'erreur si le tableau d'erreur existe
                if (isset($formError['idDays[]'])) {
                    ?>
                                <p class="boldText red-text text-darken-1 center-align"><?= $formError['idDays[]']; ?></p>
                <?php } ?>
                    </div>
                    <div class="input-field col m2 s12">
                        <select name="idTimetableTypes[]" required>
                            <option value="0" disabled selected>Période</option>
                <?php
                //boucle permettant d'afficher la liste des périodes horaires (timetableTypes)
                foreach ($timetableTypesList as $timetableTypeDetail) {
                    ?>
                                    <option value="<?= $timetableTypeDetail->id ?>" <?= ((isset($timetable->idTimetableTypes)) && ($timetable->idTimetableTypes == $timetableTypeDetail->id)) ? 'selected' : '' ?>><?= $timetableTypeDetail->name ?></option>
                <?php } ?>
                        </select>
                        <label for="idTimetableTypes[]">Sélectionner une période horaire</label>
                <?php
                //affichage du message d'erreur si le tableau d'erreur existe
                if (isset($formError['idTimetableTypes[]'])) {
                    ?>
                                <p class="boldText red-text text-darken-1 center-align"><?= $formError['idTimetableTypes[]']; ?></p>
                <?php } ?>
                    </div>
                    <div class="input-field col m2 s5 offset-s1">
                        <input type="time" name="opening[]" id="opening" placeholder="--:--" class="validate" value="<?= isset($timetable->opening) ? $timetable->opening : '' ?>" />
                        <label for="opening[]">Horaire d'ouverture</label>
                <?php
                //affichage du message d'erreur si le tableau d'erreur existe
                if (isset($formError['opening[]'])) {
                    ?>
                                <p class="boldText red-text text-darken-1 center-align"><?= $formError['opening[]']; ?></p>
                <?php } ?>
                    </div>
                    <div class="input-field col m2 s5">
                        <input type="time" name="closing[]" id="closing" placeholder="--:--" class="validate" value="<?= isset($timetable->closing) ? $timetable->closing : '' ?>" />
                        <label for="closing[]">Horaire de fermeture</label>
                <?php
                //affichage du message d'erreur si le tableau d'erreur existe
                if (isset($formError['closing[]'])) {
                    ?>
                                <p class="boldText red-text text-darken-1 center-align"><?= $formError['closing[]']; ?></p>
                <?php } ?>
                    </div>
                </div>
            ---------------Ajout d'horaire 7 (Dimanche)---------------
                <div class="row">
                    <div class="input-field col m2 offset-m2 s12">
                        <select name="idDays[]" required>
                            <option value="0" disabled selected>Jour</option>
                <?php
                //boucle permettant d'afficher la liste des jours de la semaine
                foreach ($daysList as $dayDetail) {
                    ?>
                                    <option value="<?= $dayDetail->id ?>" <?= ((isset($timetable->idDays)) && ($timetable->idDays == $dayDetail->id)) ? 'selected' : '' ?>><?= $dayDetail->day ?></option>
                <?php } ?>
                        </select>
                        <label for="idDays[]">Sélectionner un jour</label>
                <?php
                //affichage du message d'erreur si le tableau d'erreur existe
                if (isset($formError['idDays[]'])) {
                    ?>
                                <p class="boldText red-text text-darken-1 center-align"><?= $formError['idDays[]']; ?></p>
                <?php } ?>
                    </div>
                    <div class="input-field col m2 s12">
                        <select name="idTimetableTypes[]" required>
                            <option value="0" disabled selected>Période</option>
                <?php
                //boucle permettant d'afficher la liste des périodes horaires (timetableTypes)
                foreach ($timetableTypesList as $timetableTypeDetail) {
                    ?>
                                    <option value="<?= $timetableTypeDetail->id ?>" <?= ((isset($timetable->idTimetableTypes)) && ($timetable->idTimetableTypes == $timetableTypeDetail->id)) ? 'selected' : '' ?>><?= $timetableTypeDetail->name ?></option>
                <?php } ?>
                        </select>
                        <label for="idTimetableTypes[]">Sélectionner une période horaire</label>
                <?php
                //affichage du message d'erreur si le tableau d'erreur existe
                if (isset($formError['idTimetableTypes[]'])) {
                    ?>
                                <p class="boldText red-text text-darken-1 center-align"><?= $formError['idTimetableTypes[]']; ?></p>
                <?php } ?>
                    </div>
                    <div class="input-field col m2 s5 offset-s1">
                        <input type="time" name="opening[]" id="opening" placeholder="--:--" class="validate" value="<?= isset($timetable->opening) ? $timetable->opening : '' ?>" />
                        <label for="opening[]">Horaire d'ouverture</label>
                <?php
                //affichage du message d'erreur si le tableau d'erreur existe
                if (isset($formError['opening[]'])) {
                    ?>
                                <p class="boldText red-text text-darken-1 center-align"><?= $formError['opening[]']; ?></p>
                <?php } ?>
                    </div>
                    <div class="input-field col m2 s5">
                        <input type="time" name="closing[]" id="closing" placeholder="--:--" class="validate" value="<?= isset($timetable->closing) ? $timetable->closing : '' ?>" />
                        <label for="closing[]">Horaire de fermeture</label>
                <?php
                //affichage du message d'erreur si le tableau d'erreur existe
                if (isset($formError['closing[]'])) {
                    ?>
                                <p class="boldText red-text text-darken-1 center-align"><?= $formError['closing[]']; ?></p>
                <?php } ?>
                    </div>
                </div>-->
                <!--Bouton de validation du formulaire-->
                <div class="center-align">
                    <button class="btn waves-effect waves-light lime darken-3" type="submit" name="addTimetablesSubmit" id="addTimetablesSubmit">Enregistrer les horaires</button>
                </div>
            </form>
            <p class="boldText red-text text-darken-1 center-align">
                <?php
                //ternaire permettant l'affichage du message d'erreur si la méthode ne s'exécute pas
                echo isset($formError['addTimetablesSubmit']) ? $formError['addTimetablesSubmit'] : '';
                ?>
            </p>
        <?php } ?>
    </div>
</div>
<?php
//insertion du footer
include_once path::getRootPath() . 'footer.php';
?>