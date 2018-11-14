<?php
//insertion du fichier path, du header et du controller
include_once 'classes/path.php';
include_once path::getRootPath() . 'header.php';
include_once path::getControllersPath() . 'addPlaceCtrl.php'
?>
<div>
    <h2 class="center-align">Ajout d'un nouveau site touristique</h2>
    <div class="row">
        <h3 class="col s10 offset-s2">1. Informations générales</h3>
        <?php
        //vérification de l'envoi du formulaire et qu'il n'y a pas d'erreurs puis affichage d'un message de succès
        //   if (isset($_POST['addPlaceSubmit']) && (count($formError) === 0)) {
        ?> 
        <div class="center-align">
            <p class="boldText green-text center-align">Les données ont bien été enregistrées</p>
            <a href="" class="boldText btn waves-effect waves-light lime darken-3" title="">Poursuivre</a>
            <p class="boldText green-text center-align">Lien vers la suite du formulaire (tarif et horaires à faire)</p>
        </div>
        <div class="row">
            <h3 class="col s10 offset-s2">2. Horaires</h3>
            <form action="#" method="POST" class="col s12" id="addTimetables">
                <!----------------------Horaires lundi---------------------->
                <div class="row">
                    <p class="col m1 offset-m2 s12">Lundi : </p>
                    <div class="input-field col m3 s12">
                        <select name="mondayTimetableType" required>
                            <option value="0" disabled selected>Période</option>
                            <?php
                            //boucle permettant d'afficher la liste des périodes horaires (timetableTypes)
                            foreach ($timetableTypesList as $timetableTypeDetail) {
                                ?>
                                <option value="<?= $timetableTypeDetail->id ?>" <?= ((isset($place->idCategories)) && ($place->idCategories == $timetableTypeDetail->id)) ? 'selected' : '' ?>><?= $timetableTypeDetail->name ?></option>
                            <?php } ?>
                        </select>
                        <label for="mondayTimetableType">Sélectionner une période horaire</label>
                    </div>
                    <div class="input-field col m1 s5 offset-s1">
                        <input id="mondayOpenning" type="time" placeholder="--:--" class="validate">
                        <label for="mondayOpenning">Horaire d'ouverture</label>
                    </div>
                    <div class="input-field col m1 s5">
                        <input id="mondayClosing" type="time" placeholder="--:--" class="validate">
                        <label for="mondayClosing">Horaire de fermeture</label>
                    </div>
                    <div class="col m2 s12 center-align">
                        <button class="btn waves-effect waves-light lime darken-3" type="button" name="addMondayTimetable" id="addMondayTimetable">Ajouter d'autres horaires</button>
                    </div>
                </div>
                <!--Lundi : plus d'horaires (2e ligne)-->
                <div class="row">
                    <div class="input-field col m3 offset-m3 s12">
                        <select name="mondayTimetableType2" required>
                            <option value="0" disabled selected>Période</option>
                            <?php
                            //boucle permettant d'afficher la liste des périodes horaires (timetableTypes)
                            foreach ($timetableTypesList as $timetableTypeDetail) {
                                ?>
                                <option value="<?= $timetableTypeDetail->id ?>" <?= ((isset($place->idCategories)) && ($place->idCategories == $timetableTypeDetail->id)) ? 'selected' : '' ?>><?= $timetableTypeDetail->name ?></option>
                            <?php } ?>
                        </select>
                        <label for="mondayTimetableType2">Sélectionner une période horaire</label>
                    </div>
                    <div class="input-field col m1 s5 offset-s1">
                        <input id="mondayOpenning2" type="time" placeholder="--:--" class="validate">
                        <label for="mondayOpenning2">Horaire d'ouverture</label>
                    </div>
                    <div class="input-field col m1 s5">
                        <input id="mondayClosing2" type="time" placeholder="--:--" class="validate">
                        <label for="mondayClosing2">Horaire de fermeture</label>
                    </div>
                </div>
                <!--Lundi : plus d'horaires (3e ligne)-->
                <div class="row">
                    <div class="input-field col m3 offset-m3 s12">
                        <select name="mondayTimetableType3" required>
                            <option value="0" disabled selected>Période</option>
                            <?php
                            //boucle permettant d'afficher la liste des périodes horaires (timetableTypes)
                            foreach ($timetableTypesList as $timetableTypeDetail) {
                                ?>
                                <option value="<?= $timetableTypeDetail->id ?>" <?= ((isset($place->idCategories)) && ($place->idCategories == $timetableTypeDetail->id)) ? 'selected' : '' ?>><?= $timetableTypeDetail->name ?></option>
                            <?php } ?>
                        </select>
                        <label for="mondayTimetableType3">Sélectionner une période horaire</label>
                    </div>
                    <div class="input-field col m1 s5 offset-s1">
                        <input id="mondayOpenning3" type="time" placeholder="--:--" class="validate">
                        <label for="mondayOpenning3">Horaire d'ouverture</label>
                    </div>
                    <div class="input-field col m1 s5">
                        <input id="mondayClosing3" type="time" placeholder="--:--" class="validate">
                        <label for="mondayClosing3">Horaire de fermeture</label>
                    </div>
                </div>
                <!--Lundi : plus d'horaires (4e ligne)-->
                <div class="row">
                    <div class="input-field col m3 offset-m3 s12">
                        <select name="mondayTimetableType4" required>
                            <option value="0" disabled selected>Période</option>
                            <?php
                            //boucle permettant d'afficher la liste des périodes horaires (timetableTypes)
                            foreach ($timetableTypesList as $timetableTypeDetail) {
                                ?>
                                <option value="<?= $timetableTypeDetail->id ?>" <?= ((isset($place->idCategories)) && ($place->idCategories == $timetableTypeDetail->id)) ? 'selected' : '' ?>><?= $timetableTypeDetail->name ?></option>
                            <?php } ?>
                        </select>
                        <label for="mondayTimetableType4">Sélectionner une période horaire</label>
                    </div>
                    <div class="input-field col m1 s5 offset-s1">
                        <input id="mondayOpenning4" type="time" placeholder="--:--" class="validate">
                        <label for="mondayOpenning4">Horaire d'ouverture</label>
                    </div>
                    <div class="input-field col m1 s5">
                        <input id="mondayClosing4" type="time" placeholder="--:--" class="validate">
                        <label for="mondayClosing4">Horaire de fermeture</label>
                    </div>
                </div>
                <!----------------------Horaires mardi---------------------->
                <div class="row">
                    <p class="col m1 offset-m2 s12">Mardi : </p>
                    <div class="input-field col m3 s12">
                        <select name="tuesdayTimetableType" required>
                            <option value="0" disabled selected>Période</option>
                            <?php
                            //boucle permettant d'afficher la liste des périodes horaires (timetableTypes)
                            foreach ($timetableTypesList as $timetableTypeDetail) {
                                ?>
                                <option value="<?= $timetableTypeDetail->id ?>" <?= ((isset($place->idCategories)) && ($place->idCategories == $timetableTypeDetail->id)) ? 'selected' : '' ?>><?= $timetableTypeDetail->name ?></option>
                            <?php } ?>
                        </select>
                        <label for="tuesdayTimetableType">Sélectionner une période horaire</label>
                    </div>
                    <div class="input-field col m1 s5 offset-s1">
                        <input id="tuesdayOpenning" type="time" placeholder="--:--" class="validate">
                        <label for="tuesdayOpenning">Horaire d'ouverture</label>
                    </div>
                    <div class="input-field col m1 s5">
                        <input id="tuesdayClosing" type="time" placeholder="--:--" class="validate">
                        <label for="tuesdayClosing">Horaire de fermeture</label>
                    </div>
                    <div class="col m2 s12 center-align">
                        <button class="btn waves-effect waves-light lime darken-3" type="button" name="addTuesdayTimetable" id="addTuesdayTimetable">Ajouter d'autres horaires</button>
                    </div>
                </div>
                <!--Mardi : plus d'horaires (2e ligne)-->
                <div class="row">
                    <div class="input-field col m3 offset-m3 s12">
                        <select name="tuesdayTimetableType2" required>
                            <option value="0" disabled selected>Période</option>
                            <?php
                            //boucle permettant d'afficher la liste des périodes horaires (timetableTypes)
                            foreach ($timetableTypesList as $timetableTypeDetail) {
                                ?>
                                <option value="<?= $timetableTypeDetail->id ?>" <?= ((isset($place->idCategories)) && ($place->idCategories == $timetableTypeDetail->id)) ? 'selected' : '' ?>><?= $timetableTypeDetail->name ?></option>
                            <?php } ?>
                        </select>
                        <label for="tuesdayTimetableType2">Sélectionner une période horaire</label>
                    </div>
                    <div class="input-field col m1 s5 offset-s1">
                        <input id="tuesdayOpenning2" type="time" placeholder="--:--" class="validate">
                        <label for="tuesdayOpenning2">Horaire d'ouverture</label>
                    </div>
                    <div class="input-field col m1 s5">
                        <input id="tuesdayClosing2" type="time" placeholder="--:--" class="validate">
                        <label for="tuesdayClosing2">Horaire de fermeture</label>
                    </div>
                </div>
                <!--Mardi : plus d'horaires (3e ligne)-->
                <div class="row">
                    <div class="input-field col m3 offset-m3 s12">
                        <select name="tuesdayTimetableType3" required>
                            <option value="0" disabled selected>Période</option>
                            <?php
                            //boucle permettant d'afficher la liste des périodes horaires (timetableTypes)
                            foreach ($timetableTypesList as $timetableTypeDetail) {
                                ?>
                                <option value="<?= $timetableTypeDetail->id ?>" <?= ((isset($place->idCategories)) && ($place->idCategories == $timetableTypeDetail->id)) ? 'selected' : '' ?>><?= $timetableTypeDetail->name ?></option>
                            <?php } ?>
                        </select>
                        <label for="tuesdayTimetableType3">Sélectionner une période horaire</label>
                    </div>
                    <div class="input-field col m1 s5 offset-s1">
                        <input id="tuesdayOpenning3" type="time" placeholder="--:--" class="validate">
                        <label for="tuesdayOpenning3">Horaire d'ouverture</label>
                    </div>
                    <div class="input-field col m1 s5">
                        <input id="tuesdayClosing3" type="time" placeholder="--:--" class="validate">
                        <label for="tuesdayClosing3">Horaire de fermeture</label>
                    </div>
                </div>
                <!--Mardi : plus d'horaires (4e ligne)-->
                <div class="row">
                    <div class="input-field col m3 offset-m3 s12">
                        <select name="tuesdayTimetableType4" required>
                            <option value="0" disabled selected>Période</option>
                            <?php
                            //boucle permettant d'afficher la liste des périodes horaires (timetableTypes)
                            foreach ($timetableTypesList as $timetableTypeDetail) {
                                ?>
                                <option value="<?= $timetableTypeDetail->id ?>" <?= ((isset($place->idCategories)) && ($place->idCategories == $timetableTypeDetail->id)) ? 'selected' : '' ?>><?= $timetableTypeDetail->name ?></option>
                            <?php } ?>
                        </select>
                        <label for="tuesdayTimetableType4">Sélectionner une période horaire</label>
                    </div>
                    <div class="input-field col m1 s5 offset-s1">
                        <input id="tuesdayOpenning4" type="time" placeholder="--:--" class="validate">
                        <label for="tuesdayOpenning4">Horaire d'ouverture</label>
                    </div>
                    <div class="input-field col m1 s5">
                        <input id="tuesdayClosing4" type="time" placeholder="--:--" class="validate">
                        <label for="tuesdayClosing4">Horaire de fermeture</label>
                    </div>
                </div>
                <!----------------------Horaires mercredi---------------------->
                <div class="row">
                    <p class="col m1 offset-m2 s12">Mercredi : </p>
                    <div class="input-field col m3 s12">
                        <select name="wednesdayTimetableType" required>
                            <option value="0" disabled selected>Période</option>
                            <?php
                            //boucle permettant d'afficher la liste des périodes horaires (timetableTypes)
                            foreach ($timetableTypesList as $timetableTypeDetail) {
                                ?>
                                <option value="<?= $timetableTypeDetail->id ?>" <?= ((isset($place->idCategories)) && ($place->idCategories == $timetableTypeDetail->id)) ? 'selected' : '' ?>><?= $timetableTypeDetail->name ?></option>
                            <?php } ?>
                        </select>
                        <label for="wednesdayTimetableType">Sélectionner une période horaire</label>
                    </div>
                    <div class="input-field col m1 s5 offset-s1">
                        <input id="wednesdayOpenning" type="time" placeholder="--:--" class="validate">
                        <label for="wednesdayOpenning">Horaire d'ouverture</label>
                    </div>
                    <div class="input-field col m1 s5">
                        <input id="wednesdayClosing" type="time" placeholder="--:--" class="validate">
                        <label for="wednesdayClosing">Horaire de fermeture</label>
                    </div>
                    <div class="col m2 s12 center-align">
                        <button class="btn waves-effect waves-light lime darken-3" type="button" name="addWednesdayTimetable" id="addWednesdayTimetable">Ajouter d'autres horaires</button>
                    </div>
                </div>
                <!--Mercredi : plus d'horaires (2e ligne)-->
                <div class="row">
                    <div class="input-field col m3 offset-m3 s12">
                        <select name="mondayTimetableType2" required>
                            <option value="0" disabled selected>Période</option>
                            <?php
                            //boucle permettant d'afficher la liste des périodes horaires (timetableTypes)
                            foreach ($timetableTypesList as $timetableTypeDetail) {
                                ?>
                                <option value="<?= $timetableTypeDetail->id ?>" <?= ((isset($place->idCategories)) && ($place->idCategories == $timetableTypeDetail->id)) ? 'selected' : '' ?>><?= $timetableTypeDetail->name ?></option>
                            <?php } ?>
                        </select>
                        <label for="mondayTimetableType2">Sélectionner une période horaire</label>
                    </div>
                    <div class="input-field col m1 s5 offset-s1">
                        <input id="mondayOpenning2" type="time" placeholder="--:--" class="validate">
                        <label for="mondayOpenning2">Horaire d'ouverture</label>
                    </div>
                    <div class="input-field col m1 s5">
                        <input id="mondayClosing2" type="time" placeholder="--:--" class="validate">
                        <label for="mondayClosing2">Horaire de fermeture</label>
                    </div>
                </div>
                <!--Mercredi : plus d'horaires (3e ligne)-->
                <div class="row">
                    <div class="input-field col m3 offset-m3 s12">
                        <select name="mondayTimetableType3" required>
                            <option value="0" disabled selected>Période</option>
                            <?php
                            //boucle permettant d'afficher la liste des périodes horaires (timetableTypes)
                            foreach ($timetableTypesList as $timetableTypeDetail) {
                                ?>
                                <option value="<?= $timetableTypeDetail->id ?>" <?= ((isset($place->idCategories)) && ($place->idCategories == $timetableTypeDetail->id)) ? 'selected' : '' ?>><?= $timetableTypeDetail->name ?></option>
                            <?php } ?>
                        </select>
                        <label for="mondayTimetableType3">Sélectionner une période horaire</label>
                    </div>
                    <div class="input-field col m1 s5 offset-s1">
                        <input id="mondayOpenning3" type="time" placeholder="--:--" class="validate">
                        <label for="mondayOpenning3">Horaire d'ouverture</label>
                    </div>
                    <div class="input-field col m1 s5">
                        <input id="mondayClosing3" type="time" placeholder="--:--" class="validate">
                        <label for="mondayClosing3">Horaire de fermeture</label>
                    </div>
                </div>
                <!--Mercredi : plus d'horaires (4e ligne)-->
                <div class="row">
                    <div class="input-field col m3 offset-m3 s12">
                        <select name="mondayTimetableType4" required>
                            <option value="0" disabled selected>Période</option>
                            <?php
                            //boucle permettant d'afficher la liste des périodes horaires (timetableTypes)
                            foreach ($timetableTypesList as $timetableTypeDetail) {
                                ?>
                                <option value="<?= $timetableTypeDetail->id ?>" <?= ((isset($place->idCategories)) && ($place->idCategories == $timetableTypeDetail->id)) ? 'selected' : '' ?>><?= $timetableTypeDetail->name ?></option>
                            <?php } ?>
                        </select>
                        <label for="mondayTimetableType4">Sélectionner une période horaire</label>
                    </div>
                    <div class="input-field col m1 s5 offset-s1">
                        <input id="mondayOpenning4" type="time" placeholder="--:--" class="validate">
                        <label for="mondayOpenning4">Horaire d'ouverture</label>
                    </div>
                    <div class="input-field col m1 s5">
                        <input id="mondayClosing4" type="time" placeholder="--:--" class="validate">
                        <label for="mondayClosing4">Horaire de fermeture</label>
                    </div>
                </div>
                <!----------------------Horaires jeudi---------------------->
                <div class="row">
                    <p class="col m1 offset-m2 s12">Jeudi : </p>
                    <div class="input-field col m3 s12">
                        <select name="thursdayTimetableType" required>
                            <option value="0" disabled selected>Période</option>
                            <?php
                            //boucle permettant d'afficher la liste des périodes horaires (timetableTypes)
                            foreach ($timetableTypesList as $timetableTypeDetail) {
                                ?>
                                <option value="<?= $timetableTypeDetail->id ?>" <?= ((isset($place->idCategories)) && ($place->idCategories == $timetableTypeDetail->id)) ? 'selected' : '' ?>><?= $timetableTypeDetail->name ?></option>
                            <?php } ?>
                        </select>
                        <label for="thursdayTimetableType">Sélectionner une période horaire</label>
                    </div>
                    <div class="input-field col m1 s5 offset-s1">
                        <input id="thursdayOpenning" type="time" placeholder="--:--" class="validate">
                        <label for="thursdayOpenning">Horaire d'ouverture</label>
                    </div>
                    <div class="input-field col m1 s5">
                        <input id="thursdayClosing" type="time" placeholder="--:--" class="validate">
                        <label for="thursdayClosing">Horaire de fermeture</label>
                    </div>
                    <div class="col m2 s12 center-align">
                        <button class="btn waves-effect waves-light lime darken-3" type="button" name="addThursdayTimetable" id="addThursdayTimetable">Ajouter d'autres horaires</button>
                    </div>
                </div>
                <!--Jeudi : plus d'horaires (2e ligne)-->
                <div class="row">
                    <div class="input-field col m3 offset-m3 s12">
                        <select name="mondayTimetableType2" required>
                            <option value="0" disabled selected>Période</option>
                            <?php
                            //boucle permettant d'afficher la liste des périodes horaires (timetableTypes)
                            foreach ($timetableTypesList as $timetableTypeDetail) {
                                ?>
                                <option value="<?= $timetableTypeDetail->id ?>" <?= ((isset($place->idCategories)) && ($place->idCategories == $timetableTypeDetail->id)) ? 'selected' : '' ?>><?= $timetableTypeDetail->name ?></option>
                            <?php } ?>
                        </select>
                        <label for="mondayTimetableType2">Sélectionner une période horaire</label>
                    </div>
                    <div class="input-field col m1 s5 offset-s1">
                        <input id="mondayOpenning2" type="time" placeholder="--:--" class="validate">
                        <label for="mondayOpenning2">Horaire d'ouverture</label>
                    </div>
                    <div class="input-field col m1 s5">
                        <input id="mondayClosing2" type="time" placeholder="--:--" class="validate">
                        <label for="mondayClosing2">Horaire de fermeture</label>
                    </div>
                </div>
                <!--Jeudi : plus d'horaires (3e ligne)-->
                <div class="row">
                    <div class="input-field col m3 offset-m3 s12">
                        <select name="mondayTimetableType3" required>
                            <option value="0" disabled selected>Période</option>
                            <?php
                            //boucle permettant d'afficher la liste des périodes horaires (timetableTypes)
                            foreach ($timetableTypesList as $timetableTypeDetail) {
                                ?>
                                <option value="<?= $timetableTypeDetail->id ?>" <?= ((isset($place->idCategories)) && ($place->idCategories == $timetableTypeDetail->id)) ? 'selected' : '' ?>><?= $timetableTypeDetail->name ?></option>
                            <?php } ?>
                        </select>
                        <label for="mondayTimetableType3">Sélectionner une période horaire</label>
                    </div>
                    <div class="input-field col m1 s5 offset-s1">
                        <input id="mondayOpenning3" type="time" placeholder="--:--" class="validate">
                        <label for="mondayOpenning3">Horaire d'ouverture</label>
                    </div>
                    <div class="input-field col m1 s5">
                        <input id="mondayClosing3" type="time" placeholder="--:--" class="validate">
                        <label for="mondayClosing3">Horaire de fermeture</label>
                    </div>
                </div>
                <!--Jeudi : plus d'horaires (4e ligne)-->
                <div class="row">
                    <div class="input-field col m3 offset-m3 s12">
                        <select name="mondayTimetableType4" required>
                            <option value="0" disabled selected>Période</option>
                            <?php
                            //boucle permettant d'afficher la liste des périodes horaires (timetableTypes)
                            foreach ($timetableTypesList as $timetableTypeDetail) {
                                ?>
                                <option value="<?= $timetableTypeDetail->id ?>" <?= ((isset($place->idCategories)) && ($place->idCategories == $timetableTypeDetail->id)) ? 'selected' : '' ?>><?= $timetableTypeDetail->name ?></option>
                            <?php } ?>
                        </select>
                        <label for="mondayTimetableType4">Sélectionner une période horaire</label>
                    </div>
                    <div class="input-field col m1 s5 offset-s1">
                        <input id="mondayOpenning4" type="time" placeholder="--:--" class="validate">
                        <label for="mondayOpenning4">Horaire d'ouverture</label>
                    </div>
                    <div class="input-field col m1 s5">
                        <input id="mondayClosing4" type="time" placeholder="--:--" class="validate">
                        <label for="mondayClosing4">Horaire de fermeture</label>
                    </div>
                </div>
                <!----------------------Horaires vendredi---------------------->
                <div class="row">
                    <p class="col m1 offset-m2 s12">Vendredi : </p>
                    <div class="input-field col m3 s12">
                        <select name="fridayTimetableType" required>
                            <option value="0" disabled selected>Période</option>
                            <?php
                            //boucle permettant d'afficher la liste des périodes horaires (timetableTypes)
                            foreach ($timetableTypesList as $timetableTypeDetail) {
                                ?>
                                <option value="<?= $timetableTypeDetail->id ?>" <?= ((isset($place->idCategories)) && ($place->idCategories == $timetableTypeDetail->id)) ? 'selected' : '' ?>><?= $timetableTypeDetail->name ?></option>
                            <?php } ?>
                        </select>
                        <label for="fridayTimetableType">Sélectionner une période horaire</label>
                    </div>
                    <div class="input-field col m1 s5 offset-s1">
                        <input id="fridayOpenning" type="time" placeholder="--:--" class="validate">
                        <label for="fridayOpenning">Horaire d'ouverture</label>
                    </div>
                    <div class="input-field col m1 s5">
                        <input id="fridayClosing" type="time" placeholder="--:--" class="validate">
                        <label for="fridayClosing">Horaire de fermeture</label>
                    </div>
                    <div class="col m2 s12 center-align">
                        <button class="btn waves-effect waves-light lime darken-3" type="button" name="addFridayTimetable" id="addFridayTimetable">Ajouter d'autres horaires</button>
                    </div>
                </div>
                <!--Vendredi : plus d'horaires (2e ligne)-->
                <div class="row">
                    <div class="input-field col m3 offset-m3 s12">
                        <select name="mondayTimetableType2" required>
                            <option value="0" disabled selected>Période</option>
                            <?php
                            //boucle permettant d'afficher la liste des périodes horaires (timetableTypes)
                            foreach ($timetableTypesList as $timetableTypeDetail) {
                                ?>
                                <option value="<?= $timetableTypeDetail->id ?>" <?= ((isset($place->idCategories)) && ($place->idCategories == $timetableTypeDetail->id)) ? 'selected' : '' ?>><?= $timetableTypeDetail->name ?></option>
                            <?php } ?>
                        </select>
                        <label for="mondayTimetableType2">Sélectionner une période horaire</label>
                    </div>
                    <div class="input-field col m1 s5 offset-s1">
                        <input id="mondayOpenning2" type="time" placeholder="--:--" class="validate">
                        <label for="mondayOpenning2">Horaire d'ouverture</label>
                    </div>
                    <div class="input-field col m1 s5">
                        <input id="mondayClosing2" type="time" placeholder="--:--" class="validate">
                        <label for="mondayClosing2">Horaire de fermeture</label>
                    </div>
                </div>
                <!--Vendredi : plus d'horaires (3e ligne)-->
                <div class="row">
                    <div class="input-field col m3 offset-m3 s12">
                        <select name="mondayTimetableType3" required>
                            <option value="0" disabled selected>Période</option>
                            <?php
                            //boucle permettant d'afficher la liste des périodes horaires (timetableTypes)
                            foreach ($timetableTypesList as $timetableTypeDetail) {
                                ?>
                                <option value="<?= $timetableTypeDetail->id ?>" <?= ((isset($place->idCategories)) && ($place->idCategories == $timetableTypeDetail->id)) ? 'selected' : '' ?>><?= $timetableTypeDetail->name ?></option>
                            <?php } ?>
                        </select>
                        <label for="mondayTimetableType3">Sélectionner une période horaire</label>
                    </div>
                    <div class="input-field col m1 s5 offset-s1">
                        <input id="mondayOpenning3" type="time" placeholder="--:--" class="validate">
                        <label for="mondayOpenning3">Horaire d'ouverture</label>
                    </div>
                    <div class="input-field col m1 s5">
                        <input id="mondayClosing3" type="time" placeholder="--:--" class="validate">
                        <label for="mondayClosing3">Horaire de fermeture</label>
                    </div>
                </div>
                <!--Vendredi : plus d'horaires (4e ligne)-->
                <div class="row">
                    <div class="input-field col m3 offset-m3 s12">
                        <select name="mondayTimetableType4" required>
                            <option value="0" disabled selected>Période</option>
                            <?php
                            //boucle permettant d'afficher la liste des périodes horaires (timetableTypes)
                            foreach ($timetableTypesList as $timetableTypeDetail) {
                                ?>
                                <option value="<?= $timetableTypeDetail->id ?>" <?= ((isset($place->idCategories)) && ($place->idCategories == $timetableTypeDetail->id)) ? 'selected' : '' ?>><?= $timetableTypeDetail->name ?></option>
                            <?php } ?>
                        </select>
                        <label for="mondayTimetableType4">Sélectionner une période horaire</label>
                    </div>
                    <div class="input-field col m1 s5 offset-s1">
                        <input id="mondayOpenning4" type="time" placeholder="--:--" class="validate">
                        <label for="mondayOpenning4">Horaire d'ouverture</label>
                    </div>
                    <div class="input-field col m1 s5">
                        <input id="mondayClosing4" type="time" placeholder="--:--" class="validate">
                        <label for="mondayClosing4">Horaire de fermeture</label>
                    </div>
                </div>
                <!----------------------Horaires samedi---------------------->
                <div class="row">
                    <p class="col m1 offset-m2 s12">Samedi : </p>
                    <div class="input-field col m3 s12">
                        <select name="saturdayTimetableType" required>
                            <option value="0" disabled selected>Période</option>
                            <?php
                            //boucle permettant d'afficher la liste des périodes horaires (timetableTypes)
                            foreach ($timetableTypesList as $timetableTypeDetail) {
                                ?>
                                <option value="<?= $timetableTypeDetail->id ?>" <?= ((isset($place->idCategories)) && ($place->idCategories == $timetableTypeDetail->id)) ? 'selected' : '' ?>><?= $timetableTypeDetail->name ?></option>
                            <?php } ?>
                        </select>
                        <label for="saturdayTimetableType">Sélectionner une période horaire</label>
                    </div>
                    <div class="input-field col m1 s5 offset-s1">
                        <input id="saturdayOpenning" type="time" placeholder="--:--" class="validate">
                        <label for="saturdayOpenning">Horaire d'ouverture</label>
                    </div>
                    <div class="input-field col m1 s5">
                        <input id="saturdayClosing" type="time" placeholder="--:--" class="validate">
                        <label for="saturdayClosing">Horaire de fermeture</label>
                    </div>
                    <div class="col m2 s12 center-align">
                        <button class="btn waves-effect waves-light lime darken-3" type="button" name="addSaturdayTimetable" id="addSaturdayTimetable">Ajouter d'autres horaires</button>
                    </div>
                </div>
                <!--Samedi : plus d'horaires (2e ligne)-->
                <div class="row">
                    <div class="input-field col m3 offset-m3 s12">
                        <select name="mondayTimetableType2" required>
                            <option value="0" disabled selected>Période</option>
                            <?php
                            //boucle permettant d'afficher la liste des périodes horaires (timetableTypes)
                            foreach ($timetableTypesList as $timetableTypeDetail) {
                                ?>
                                <option value="<?= $timetableTypeDetail->id ?>" <?= ((isset($place->idCategories)) && ($place->idCategories == $timetableTypeDetail->id)) ? 'selected' : '' ?>><?= $timetableTypeDetail->name ?></option>
                            <?php } ?>
                        </select>
                        <label for="mondayTimetableType2">Sélectionner une période horaire</label>
                    </div>
                    <div class="input-field col m1 s5 offset-s1">
                        <input id="mondayOpenning2" type="time" placeholder="--:--" class="validate">
                        <label for="mondayOpenning2">Horaire d'ouverture</label>
                    </div>
                    <div class="input-field col m1 s5">
                        <input id="mondayClosing2" type="time" placeholder="--:--" class="validate">
                        <label for="mondayClosing2">Horaire de fermeture</label>
                    </div>
                </div>
                <!--Samedi : plus d'horaires (3e ligne)-->
                <div class="row">
                    <div class="input-field col m3 offset-m3 s12">
                        <select name="mondayTimetableType3" required>
                            <option value="0" disabled selected>Période</option>
                            <?php
                            //boucle permettant d'afficher la liste des périodes horaires (timetableTypes)
                            foreach ($timetableTypesList as $timetableTypeDetail) {
                                ?>
                                <option value="<?= $timetableTypeDetail->id ?>" <?= ((isset($place->idCategories)) && ($place->idCategories == $timetableTypeDetail->id)) ? 'selected' : '' ?>><?= $timetableTypeDetail->name ?></option>
                            <?php } ?>
                        </select>
                        <label for="mondayTimetableType3">Sélectionner une période horaire</label>
                    </div>
                    <div class="input-field col m1 s5 offset-s1">
                        <input id="mondayOpenning3" type="time" placeholder="--:--" class="validate">
                        <label for="mondayOpenning3">Horaire d'ouverture</label>
                    </div>
                    <div class="input-field col m1 s5">
                        <input id="mondayClosing3" type="time" placeholder="--:--" class="validate">
                        <label for="mondayClosing3">Horaire de fermeture</label>
                    </div>
                </div>
                <!--Samedi : plus d'horaires (4e ligne)-->
                <div class="row">
                    <div class="input-field col m3 offset-m3 s12">
                        <select name="mondayTimetableType4" required>
                            <option value="0" disabled selected>Période</option>
                            <?php
                            //boucle permettant d'afficher la liste des périodes horaires (timetableTypes)
                            foreach ($timetableTypesList as $timetableTypeDetail) {
                                ?>
                                <option value="<?= $timetableTypeDetail->id ?>" <?= ((isset($place->idCategories)) && ($place->idCategories == $timetableTypeDetail->id)) ? 'selected' : '' ?>><?= $timetableTypeDetail->name ?></option>
                            <?php } ?>
                        </select>
                        <label for="mondayTimetableType4">Sélectionner une période horaire</label>
                    </div>
                    <div class="input-field col m1 s5 offset-s1">
                        <input id="mondayOpenning4" type="time" placeholder="--:--" class="validate">
                        <label for="mondayOpenning4">Horaire d'ouverture</label>
                    </div>
                    <div class="input-field col m1 s5">
                        <input id="mondayClosing4" type="time" placeholder="--:--" class="validate">
                        <label for="mondayClosing4">Horaire de fermeture</label>
                    </div>
                </div>
                <!----------------------Horaires dimanche---------------------->
                <div class="row">
                    <p class="col m1 offset-m2 s12">Dimanche : </p>
                    <div class="input-field col m3 s12">
                        <select name="sundayTimetableType" required>
                            <option value="0" disabled selected>Période</option>
                            <?php
                            //boucle permettant d'afficher la liste des périodes horaires (timetableTypes)
                            foreach ($timetableTypesList as $timetableTypeDetail) {
                                ?>
                                <option value="<?= $timetableTypeDetail->id ?>" <?= ((isset($place->idCategories)) && ($place->idCategories == $timetableTypeDetail->id)) ? 'selected' : '' ?>><?= $timetableTypeDetail->name ?></option>
                            <?php } ?>
                        </select>
                        <label for="sundayTimetableType">Sélectionner une période horaire</label>
                    </div>
                    <div class="input-field col m1 s5 offset-s1">
                        <input id="sundayOpenning" type="time" placeholder="--:--" class="validate">
                        <label for="sundayOpenning">Horaire d'ouverture</label>
                    </div>
                    <div class="input-field col m1 s5">
                        <input id="sundayClosing" type="time" placeholder="--:--" class="validate">
                        <label for="sundayClosing">Horaire de fermeture</label>
                    </div>
                    <div class="col m2 s12 center-align">
                        <button class="btn waves-effect waves-light lime darken-3" type="button" name="addSundayTimetable" id="addSundayTimetable">Ajouter d'autres horaires</button>
                    </div>
                </div>
                <!--Dimanche : plus d'horaires (2e ligne)-->
                <div class="row">
                    <div class="input-field col m3 offset-m3 s12">
                        <select name="mondayTimetableType2" required>
                            <option value="0" disabled selected>Période</option>
                            <?php
                            //boucle permettant d'afficher la liste des périodes horaires (timetableTypes)
                            foreach ($timetableTypesList as $timetableTypeDetail) {
                                ?>
                                <option value="<?= $timetableTypeDetail->id ?>" <?= ((isset($place->idCategories)) && ($place->idCategories == $timetableTypeDetail->id)) ? 'selected' : '' ?>><?= $timetableTypeDetail->name ?></option>
                            <?php } ?>
                        </select>
                        <label for="mondayTimetableType2">Sélectionner une période horaire</label>
                    </div>
                    <div class="input-field col m1 s5 offset-s1">
                        <input id="mondayOpenning2" type="time" placeholder="--:--" class="validate">
                        <label for="mondayOpenning2">Horaire d'ouverture</label>
                    </div>
                    <div class="input-field col m1 s5">
                        <input id="mondayClosing2" type="time" placeholder="--:--" class="validate">
                        <label for="mondayClosing2">Horaire de fermeture</label>
                    </div>
                </div>
                <!--Dimanche : plus d'horaires (3e ligne)-->
                <div class="row">
                    <div class="input-field col m3 offset-m3 s12">
                        <select name="mondayTimetableType3" required>
                            <option value="0" disabled selected>Période</option>
                            <?php
                            //boucle permettant d'afficher la liste des périodes horaires (timetableTypes)
                            foreach ($timetableTypesList as $timetableTypeDetail) {
                                ?>
                                <option value="<?= $timetableTypeDetail->id ?>" <?= ((isset($place->idCategories)) && ($place->idCategories == $timetableTypeDetail->id)) ? 'selected' : '' ?>><?= $timetableTypeDetail->name ?></option>
                            <?php } ?>
                        </select>
                        <label for="mondayTimetableType3">Sélectionner une période horaire</label>
                    </div>
                    <div class="input-field col m1 s5 offset-s1">
                        <input id="mondayOpenning3" type="time" placeholder="--:--" class="validate">
                        <label for="mondayOpenning3">Horaire d'ouverture</label>
                    </div>
                    <div class="input-field col m1 s5">
                        <input id="mondayClosing3" type="time" placeholder="--:--" class="validate">
                        <label for="mondayClosing3">Horaire de fermeture</label>
                    </div>
                </div>
                <!--Dimanche : plus d'horaires (4e ligne)-->
                <div class="row">
                    <div class="input-field col m3 offset-m3 s12">
                        <select name="mondayTimetableType4" required>
                            <option value="0" disabled selected>Période</option>
                            <?php
                            //boucle permettant d'afficher la liste des périodes horaires (timetableTypes)
                            foreach ($timetableTypesList as $timetableTypeDetail) {
                                ?>
                                <option value="<?= $timetableTypeDetail->id ?>" <?= ((isset($place->idCategories)) && ($place->idCategories == $timetableTypeDetail->id)) ? 'selected' : '' ?>><?= $timetableTypeDetail->name ?></option>
                            <?php } ?>
                        </select>
                        <label for="mondayTimetableType4">Sélectionner une période horaire</label>
                    </div>
                    <div class="input-field col m1 s5 offset-s1">
                        <input id="mondayOpenning4" type="time" placeholder="--:--" class="validate">
                        <label for="mondayOpenning4">Horaire d'ouverture</label>
                    </div>
                    <div class="input-field col m1 s5">
                        <input id="mondayClosing4" type="time" placeholder="--:--" class="validate">
                        <label for="mondayClosing4">Horaire de fermeture</label>
                    </div>
                </div>
                <!--Bouton de validation du formulaire-->
                <div class="center-align">
                    <button class="btn waves-effect waves-light lime darken-3" type="submit" name="addTimetablesSubmit" id="addTimetablesSubmit">Enregistrer les horaires</button>
                </div>
            </form>
        </div>

        <?php
        //sinon affichage des messages d'erreurs
        //      } else {
        ?>  
        <!--            <form action="#" method="POST" class="col s12" id="addPlace">
                        Champs nom et catégorie
                        <div class="row">
                            <div class="input-field col m5 offset-m2 s12">
                                <i class="material-icons prefix">location_on</i>
                                <input type="text" name="placeName" id="placeName" value="<?= /* garde en mémoire la saisie dans le champ */ isset($place->name) ? $place->name : '' ?>" required />
                                <label for="placeName">Nom du site touristique</label>
        <?php
        //affichage du message d'erreur si le tableau d'erreur existe
        if (isset($formError['placeName'])) {
            ?>
                                                            <p class="boldText red-text text-darken-1 center-align"><?= $formError['placeName']; ?></p>
        <?php } ?>
                            </div>
                            <div class="input-field col m3 s12">
                                <i class="material-icons prefix">assistant</i>
                                <select name="idCategories" required>
                                    <option value="0" disabled selected>Catégorie</option>
        <?php
        //boucle permettant d'afficher la liste des catégories
        foreach ($categoriesList as $categorieDetail) {
            ?>
                                                                <option value="<?= $categorieDetail->id ?>" <?= ((isset($place->idCategories)) && ($place->idCategories == $categorieDetail->id)) ? 'selected' : '' ?>><?= $categorieDetail->name ?></option>
        <?php } ?>
                                </select>
                                <label for="idCategories">Veuillez sélectionner une catégorie</label>
        <?php
        //affichage du message d'erreur si le tableau d'erreur existe
        if (isset($formError['idCategories'])) {
            ?>
                                                            <p class="boldText red-text text-darken-1 center-align"><?= $formError['idCategories']; ?></p>
        <?php } ?>
                            </div>
                        </div>
                        Champs adresse
                        <div class="row">
                            <div class="input-field col m4 offset-m2 s12">
                                <i class="material-icons prefix">explore</i>
                                <select name="regions" id="regions" required>
                                    <option value="0" disabled selected>Veuillez sélectionner une région</option>
        <?php
        //boucle permettant d'afficher la liste des régions
        foreach ($regionsList as $regionDetail) {
            ?>
                                                                <option value="<?= $regionDetail->id ?>" <?= ((isset($regions)) && ($regions == $regionDetail->id)) ? 'selected' : '' ?>><?= $regionDetail->region ?></option>
        <?php } ?>
                                </select>
                                <label for="regions">Adresse (Région)</label>
        <?php
        //affichage du message d'erreur si le tableau d'erreur existe
        if (isset($formError['regions'])) {
            ?>
                                                            <p class="boldText red-text text-darken-1 center-align"><?= $formError['regions']; ?></p>
        <?php } ?>
                            </div>
                            <div class="input-field col m4 s12">
                                <i class="material-icons prefix">explore</i>
                                <select name="departments" id="departments" required>
                                    <option value="0" disabled selected>Veuillez sélectionner un département</option>
        <?php
        //boucle permettant d'afficher la liste des départements
        foreach ($departmentsList as $departmentDetail) {
            ?>
                                                                <option value="<?= $departmentDetail->id ?>" <?= ((isset($departments)) && ($departments == $departmentDetail->id)) ? 'selected' : '' ?>><?= $departmentDetail->code ?> - <?= $departmentDetail->department ?></option>
        <?php } ?>
                                </select>
                                <label for="departments">Adresse (Département)</label>
        <?php
        //affichage du message d'erreur si le tableau d'erreur existe
        if (isset($formError['departments'])) {
            ?>
                                                            <p class="boldText red-text text-darken-1 center-align"><?= $formError['departments']; ?></p>
        <?php } ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col m4 offset-m2 s12">
                                <i class="material-icons prefix">explore</i>
                                <input type="text" name="postalCode" id="postalCode" value="<?= isset($postalCode) ? $postalCode : '' ?>" required />
                                <label for="postalCode">Adresse (Code postal)</label>
        <?php
        //affichage du message d'erreur si le tableau d'erreur existe
        if (isset($formError['postalCode'])) {
            ?>
                                                            <p class="boldText red-text text-darken-1 center-align"><?= $formError['postalCode']; ?></p>
        <?php } ?>
                            </div>
                            <div class="input-field col m4 s12">
                                <i class="material-icons prefix">explore</i>
                                <select name="idCities" id="idCities" required>
                                    <option value="0" disabled selected>Veuillez sélectionner une ville</option>
        <?php
        //boucle permettant d'afficher la liste des villes
        foreach ($citiesList as $cityDetail) {
            ?>
                                                                <option value="<?= $cityDetail->id ?>" <?= ((isset($place->idCities)) && ($place->idCities == $cityDetail->id)) ? 'selected' : '' ?>><?= $cityDetail->city ?></option>
        <?php } ?>
                                </select>
                                <label for="idCities">Adresse (Ville)</label>
        <?php
        //affichage du message d'erreur si le tableau d'erreur existe
        if (isset($formError['idCities'])) {
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
        //affichage du message d'erreur si le tableau d'erreur existe
        if (isset($formError['address'])) {
            ?>
                                                            <p class="boldText red-text text-darken-1 center-align"><?= $formError['address']; ?></p>
        <?php } ?>
                            </div>
                        </div>
                        Champs téléphone, mail et site web du lieu touristique
                        <div class="row">
                            <div class="input-field col m2 offset-m2 s12">
                                <i class="material-icons prefix">phone</i>
                                <input type="text" name="phone" id="phone" value="<?= isset($place->phone) ? $place->phone : '' ?>" />
                                <label for="phone">N° de téléphone (facultatif)</label>
        <?php
        //affichage du message d'erreur si le tableau d'erreur existe
        if (isset($formError['phone'])) {
            ?>
                                                            <p class="boldText red-text text-darken-1 center-align"><?= $formError['phone']; ?></p>
        <?php } ?>
                            </div>
                            <div class="input-field col m3 s12">
                                <i class="material-icons prefix">email</i>
                                <input type="email" name="mail" id="mail" value="<?= isset($place->mail) ? $place->mail : '' ?>" />
                                <label for="mail">Adresse mail (facultatif)</label>
        <?php
        //affichage du message d'erreur si le tableau d'erreur existe
        if (isset($formError['mail'])) {
            ?>
                                                            <p class="boldText red-text text-darken-1 center-align"><?= $formError['mail']; ?></p>
        <?php } ?>
                            </div>
                            <div class="input-field col m3 s12">
                                <i class="material-icons prefix">desktop_windows</i>
                                <input type="text" name="website" id="website" value="<?= isset($place->website) ? $place->website : '' ?>" />
                                <label for="placeWebsite">Site web du lieu touristique (facultatif)</label>
        <?php
        //affichage du message d'erreur si le tableau d'erreur existe
        if (isset($formError['website'])) {
            ?>
                                                            <p class="boldText red-text text-darken-1 center-align"><?= $formError['website']; ?></p>
        <?php } ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col m8 offset-m2 s12">
                                <i class="material-icons prefix">create</i>
                                <textarea class="materialize-textarea" name="description" id="description" value="<?= isset($place->description) ? $place->description : '' ?>" required></textarea>
                                <label for="description">Description du site touristique</label>
        <?php
        //affichage du message d'erreur si le tableau d'erreur existe
        if (isset($formError['description'])) {
            ?>
                                                            <p class="boldText red-text text-darken-1 center-align"><?= $formError['description']; ?></p>
        <?php } ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field center-align col s8 offset-s2">
                                <button class="btn waves-effect waves-light lime darken-3" type="submit" name="addPlaceSubmit" id="addPlaceSubmit">Suivant</button>
                            </div>
                        </div>
                    </form>
                    <p class="boldText red-text text-darken-1 center-align">
        <?php
        //ternaire permettant l'affichage du message d'erreur si la méthode ne s'exécute pas
        echo isset($formError['addPlaceSubmit']) ? $formError['addPlaceSubmit'] : '';
        ?>
                    </p>-->
        <?php // } ?>
    </div>
</div>
<?php
//insertion du footer
include_once path::getRootPath() . 'footer.php';
?>    