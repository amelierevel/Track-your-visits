<?php
//insertion du fichier path, du header et du controller
include_once 'classes/path.php';
include_once path::getRootPath() . 'header.php';
include_once path::getControllersPath() . 'addPlaceCtrl.php'
?>
<div>
    <h2 class="center-align">Ajout d'un nouveau site touristique</h2>
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
                    <select name="wednesdayTimetableType2" required>
                        <option value="0" disabled selected>Période</option>
                        <?php
                        //boucle permettant d'afficher la liste des périodes horaires (timetableTypes)
                        foreach ($timetableTypesList as $timetableTypeDetail) {
                            ?>
                            <option value="<?= $timetableTypeDetail->id ?>" <?= ((isset($place->idCategories)) && ($place->idCategories == $timetableTypeDetail->id)) ? 'selected' : '' ?>><?= $timetableTypeDetail->name ?></option>
                        <?php } ?>
                    </select>
                    <label for="wednesdayTimetableType2">Sélectionner une période horaire</label>
                </div>
                <div class="input-field col m1 s5 offset-s1">
                    <input id="wednesdayOpenning2" type="time" placeholder="--:--" class="validate">
                    <label for="wednesdayOpenning2">Horaire d'ouverture</label>
                </div>
                <div class="input-field col m1 s5">
                    <input id="wednesdayClosing2" type="time" placeholder="--:--" class="validate">
                    <label for="wednesdayClosing2">Horaire de fermeture</label>
                </div>
            </div>
            <!--Mercredi : plus d'horaires (3e ligne)-->
            <div class="row">
                <div class="input-field col m3 offset-m3 s12">
                    <select name="wednesdayTimetableType3" required>
                        <option value="0" disabled selected>Période</option>
                        <?php
                        //boucle permettant d'afficher la liste des périodes horaires (timetableTypes)
                        foreach ($timetableTypesList as $timetableTypeDetail) {
                            ?>
                            <option value="<?= $timetableTypeDetail->id ?>" <?= ((isset($place->idCategories)) && ($place->idCategories == $timetableTypeDetail->id)) ? 'selected' : '' ?>><?= $timetableTypeDetail->name ?></option>
                        <?php } ?>
                    </select>
                    <label for="wednesdayTimetableType3">Sélectionner une période horaire</label>
                </div>
                <div class="input-field col m1 s5 offset-s1">
                    <input id="wednesdayOpenning3" type="time" placeholder="--:--" class="validate">
                    <label for="wednesdayOpenning3">Horaire d'ouverture</label>
                </div>
                <div class="input-field col m1 s5">
                    <input id="wednesdayClosing3" type="time" placeholder="--:--" class="validate">
                    <label for="wednesdayClosing3">Horaire de fermeture</label>
                </div>
            </div>
            <!--Mercredi : plus d'horaires (4e ligne)-->
            <div class="row">
                <div class="input-field col m3 offset-m3 s12">
                    <select name="wednesdayTimetableType4" required>
                        <option value="0" disabled selected>Période</option>
                        <?php
                        //boucle permettant d'afficher la liste des périodes horaires (timetableTypes)
                        foreach ($timetableTypesList as $timetableTypeDetail) {
                            ?>
                            <option value="<?= $timetableTypeDetail->id ?>" <?= ((isset($place->idCategories)) && ($place->idCategories == $timetableTypeDetail->id)) ? 'selected' : '' ?>><?= $timetableTypeDetail->name ?></option>
                        <?php } ?>
                    </select>
                    <label for="wednesdayTimetableType4">Sélectionner une période horaire</label>
                </div>
                <div class="input-field col m1 s5 offset-s1">
                    <input id="wednesdayOpenning4" type="time" placeholder="--:--" class="validate">
                    <label for="wednesdayOpenning4">Horaire d'ouverture</label>
                </div>
                <div class="input-field col m1 s5">
                    <input id="wednesdayClosing4" type="time" placeholder="--:--" class="validate">
                    <label for="wednesdayClosing4">Horaire de fermeture</label>
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
                    <select name="thursdayTimetableType2" required>
                        <option value="0" disabled selected>Période</option>
                        <?php
                        //boucle permettant d'afficher la liste des périodes horaires (timetableTypes)
                        foreach ($timetableTypesList as $timetableTypeDetail) {
                            ?>
                            <option value="<?= $timetableTypeDetail->id ?>" <?= ((isset($place->idCategories)) && ($place->idCategories == $timetableTypeDetail->id)) ? 'selected' : '' ?>><?= $timetableTypeDetail->name ?></option>
                        <?php } ?>
                    </select>
                    <label for="thursdayTimetableType2">Sélectionner une période horaire</label>
                </div>
                <div class="input-field col m1 s5 offset-s1">
                    <input id="thursdayOpenning2" type="time" placeholder="--:--" class="validate">
                    <label for="thursdayOpenning2">Horaire d'ouverture</label>
                </div>
                <div class="input-field col m1 s5">
                    <input id="thursdayClosing2" type="time" placeholder="--:--" class="validate">
                    <label for="thursdayClosing2">Horaire de fermeture</label>
                </div>
            </div>
            <!--Jeudi : plus d'horaires (3e ligne)-->
            <div class="row">
                <div class="input-field col m3 offset-m3 s12">
                    <select name="thursdayTimetableType3" required>
                        <option value="0" disabled selected>Période</option>
                        <?php
                        //boucle permettant d'afficher la liste des périodes horaires (timetableTypes)
                        foreach ($timetableTypesList as $timetableTypeDetail) {
                            ?>
                            <option value="<?= $timetableTypeDetail->id ?>" <?= ((isset($place->idCategories)) && ($place->idCategories == $timetableTypeDetail->id)) ? 'selected' : '' ?>><?= $timetableTypeDetail->name ?></option>
                        <?php } ?>
                    </select>
                    <label for="thursdayTimetableType3">Sélectionner une période horaire</label>
                </div>
                <div class="input-field col m1 s5 offset-s1">
                    <input id="thursdayOpenning3" type="time" placeholder="--:--" class="validate">
                    <label for="thursdayOpenning3">Horaire d'ouverture</label>
                </div>
                <div class="input-field col m1 s5">
                    <input id="thursdayClosing3" type="time" placeholder="--:--" class="validate">
                    <label for="thursdayClosing3">Horaire de fermeture</label>
                </div>
            </div>
            <!--Jeudi : plus d'horaires (4e ligne)-->
            <div class="row">
                <div class="input-field col m3 offset-m3 s12">
                    <select name="thursdayTimetableType4" required>
                        <option value="0" disabled selected>Période</option>
                        <?php
                        //boucle permettant d'afficher la liste des périodes horaires (timetableTypes)
                        foreach ($timetableTypesList as $timetableTypeDetail) {
                            ?>
                            <option value="<?= $timetableTypeDetail->id ?>" <?= ((isset($place->idCategories)) && ($place->idCategories == $timetableTypeDetail->id)) ? 'selected' : '' ?>><?= $timetableTypeDetail->name ?></option>
                        <?php } ?>
                    </select>
                    <label for="thursdayTimetableType4">Sélectionner une période horaire</label>
                </div>
                <div class="input-field col m1 s5 offset-s1">
                    <input id="thursdayOpenning4" type="time" placeholder="--:--" class="validate">
                    <label for="thursdayOpenning4">Horaire d'ouverture</label>
                </div>
                <div class="input-field col m1 s5">
                    <input id="thursdayClosing4" type="time" placeholder="--:--" class="validate">
                    <label for="thursdayClosing4">Horaire de fermeture</label>
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
                    <select name="fridayTimetableType2" required>
                        <option value="0" disabled selected>Période</option>
                        <?php
                        //boucle permettant d'afficher la liste des périodes horaires (timetableTypes)
                        foreach ($timetableTypesList as $timetableTypeDetail) {
                            ?>
                            <option value="<?= $timetableTypeDetail->id ?>" <?= ((isset($place->idCategories)) && ($place->idCategories == $timetableTypeDetail->id)) ? 'selected' : '' ?>><?= $timetableTypeDetail->name ?></option>
                        <?php } ?>
                    </select>
                    <label for="fridayTimetableType2">Sélectionner une période horaire</label>
                </div>
                <div class="input-field col m1 s5 offset-s1">
                    <input id="fridayOpenning2" type="time" placeholder="--:--" class="validate">
                    <label for="fridayOpenning2">Horaire d'ouverture</label>
                </div>
                <div class="input-field col m1 s5">
                    <input id="fridayClosing2" type="time" placeholder="--:--" class="validate">
                    <label for="fridayClosing2">Horaire de fermeture</label>
                </div>
            </div>
            <!--Vendredi : plus d'horaires (3e ligne)-->
            <div class="row">
                <div class="input-field col m3 offset-m3 s12">
                    <select name="fridayTimetableType3" required>
                        <option value="0" disabled selected>Période</option>
                        <?php
                        //boucle permettant d'afficher la liste des périodes horaires (timetableTypes)
                        foreach ($timetableTypesList as $timetableTypeDetail) {
                            ?>
                            <option value="<?= $timetableTypeDetail->id ?>" <?= ((isset($place->idCategories)) && ($place->idCategories == $timetableTypeDetail->id)) ? 'selected' : '' ?>><?= $timetableTypeDetail->name ?></option>
                        <?php } ?>
                    </select>
                    <label for="fridayTimetableType3">Sélectionner une période horaire</label>
                </div>
                <div class="input-field col m1 s5 offset-s1">
                    <input id="fridayOpenning3" type="time" placeholder="--:--" class="validate">
                    <label for="fridayOpenning3">Horaire d'ouverture</label>
                </div>
                <div class="input-field col m1 s5">
                    <input id="fridayClosing3" type="time" placeholder="--:--" class="validate">
                    <label for="fridayClosing3">Horaire de fermeture</label>
                </div>
            </div>
            <!--Vendredi : plus d'horaires (4e ligne)-->
            <div class="row">
                <div class="input-field col m3 offset-m3 s12">
                    <select name="fridayTimetableType4" required>
                        <option value="0" disabled selected>Période</option>
                        <?php
                        //boucle permettant d'afficher la liste des périodes horaires (timetableTypes)
                        foreach ($timetableTypesList as $timetableTypeDetail) {
                            ?>
                            <option value="<?= $timetableTypeDetail->id ?>" <?= ((isset($place->idCategories)) && ($place->idCategories == $timetableTypeDetail->id)) ? 'selected' : '' ?>><?= $timetableTypeDetail->name ?></option>
                        <?php } ?>
                    </select>
                    <label for="fridayTimetableType4">Sélectionner une période horaire</label>
                </div>
                <div class="input-field col m1 s5 offset-s1">
                    <input id="fridayOpenning4" type="time" placeholder="--:--" class="validate">
                    <label for="fridayOpenning4">Horaire d'ouverture</label>
                </div>
                <div class="input-field col m1 s5">
                    <input id="fridayClosing4" type="time" placeholder="--:--" class="validate">
                    <label for="fridayClosing4">Horaire de fermeture</label>
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
                    <select name="saturdayTimetableType2" required>
                        <option value="0" disabled selected>Période</option>
                        <?php
                        //boucle permettant d'afficher la liste des périodes horaires (timetableTypes)
                        foreach ($timetableTypesList as $timetableTypeDetail) {
                            ?>
                            <option value="<?= $timetableTypeDetail->id ?>" <?= ((isset($place->idCategories)) && ($place->idCategories == $timetableTypeDetail->id)) ? 'selected' : '' ?>><?= $timetableTypeDetail->name ?></option>
                        <?php } ?>
                    </select>
                    <label for="saturdayTimetableType2">Sélectionner une période horaire</label>
                </div>
                <div class="input-field col m1 s5 offset-s1">
                    <input id="saturdayOpenning2" type="time" placeholder="--:--" class="validate">
                    <label for="saturdayOpenning2">Horaire d'ouverture</label>
                </div>
                <div class="input-field col m1 s5">
                    <input id="saturdayClosing2" type="time" placeholder="--:--" class="validate">
                    <label for="saturdayClosing2">Horaire de fermeture</label>
                </div>
            </div>
            <!--Samedi : plus d'horaires (3e ligne)-->
            <div class="row">
                <div class="input-field col m3 offset-m3 s12">
                    <select name="saturdayTimetableType3" required>
                        <option value="0" disabled selected>Période</option>
                        <?php
                        //boucle permettant d'afficher la liste des périodes horaires (timetableTypes)
                        foreach ($timetableTypesList as $timetableTypeDetail) {
                            ?>
                            <option value="<?= $timetableTypeDetail->id ?>" <?= ((isset($place->idCategories)) && ($place->idCategories == $timetableTypeDetail->id)) ? 'selected' : '' ?>><?= $timetableTypeDetail->name ?></option>
                        <?php } ?>
                    </select>
                    <label for="saturdayTimetableType3">Sélectionner une période horaire</label>
                </div>
                <div class="input-field col m1 s5 offset-s1">
                    <input id="saturdayOpenning3" type="time" placeholder="--:--" class="validate">
                    <label for="saturdayOpenning3">Horaire d'ouverture</label>
                </div>
                <div class="input-field col m1 s5">
                    <input id="saturdayClosing3" type="time" placeholder="--:--" class="validate">
                    <label for="saturdayClosing3">Horaire de fermeture</label>
                </div>
            </div>
            <!--Samedi : plus d'horaires (4e ligne)-->
            <div class="row">
                <div class="input-field col m3 offset-m3 s12">
                    <select name="saturdayTimetableType4" required>
                        <option value="0" disabled selected>Période</option>
                        <?php
                        //boucle permettant d'afficher la liste des périodes horaires (timetableTypes)
                        foreach ($timetableTypesList as $timetableTypeDetail) {
                            ?>
                            <option value="<?= $timetableTypeDetail->id ?>" <?= ((isset($place->idCategories)) && ($place->idCategories == $timetableTypeDetail->id)) ? 'selected' : '' ?>><?= $timetableTypeDetail->name ?></option>
                        <?php } ?>
                    </select>
                    <label for="saturdayTimetableType4">Sélectionner une période horaire</label>
                </div>
                <div class="input-field col m1 s5 offset-s1">
                    <input id="saturdayOpenning4" type="time" placeholder="--:--" class="validate">
                    <label for="saturdayOpenning4">Horaire d'ouverture</label>
                </div>
                <div class="input-field col m1 s5">
                    <input id="saturdayClosing4" type="time" placeholder="--:--" class="validate">
                    <label for="saturdayClosing4">Horaire de fermeture</label>
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
                    <select name="sundayTimetableType2" required>
                        <option value="0" disabled selected>Période</option>
                        <?php
                        //boucle permettant d'afficher la liste des périodes horaires (timetableTypes)
                        foreach ($timetableTypesList as $timetableTypeDetail) {
                            ?>
                            <option value="<?= $timetableTypeDetail->id ?>" <?= ((isset($place->idCategories)) && ($place->idCategories == $timetableTypeDetail->id)) ? 'selected' : '' ?>><?= $timetableTypeDetail->name ?></option>
                        <?php } ?>
                    </select>
                    <label for="sundayTimetableType2">Sélectionner une période horaire</label>
                </div>
                <div class="input-field col m1 s5 offset-s1">
                    <input id="sundayOpenning2" type="time" placeholder="--:--" class="validate">
                    <label for="sundayOpenning2">Horaire d'ouverture</label>
                </div>
                <div class="input-field col m1 s5">
                    <input id="sundayClosing2" type="time" placeholder="--:--" class="validate">
                    <label for="sundayClosing2">Horaire de fermeture</label>
                </div>
            </div>
            <!--Dimanche : plus d'horaires (3e ligne)-->
            <div class="row">
                <div class="input-field col m3 offset-m3 s12">
                    <select name="sundayTimetableType3" required>
                        <option value="0" disabled selected>Période</option>
                        <?php
                        //boucle permettant d'afficher la liste des périodes horaires (timetableTypes)
                        foreach ($timetableTypesList as $timetableTypeDetail) {
                            ?>
                            <option value="<?= $timetableTypeDetail->id ?>" <?= ((isset($place->idCategories)) && ($place->idCategories == $timetableTypeDetail->id)) ? 'selected' : '' ?>><?= $timetableTypeDetail->name ?></option>
                        <?php } ?>
                    </select>
                    <label for="sundayTimetableType3">Sélectionner une période horaire</label>
                </div>
                <div class="input-field col m1 s5 offset-s1">
                    <input id="sundayOpenning3" type="time" placeholder="--:--" class="validate">
                    <label for="sundayOpenning3">Horaire d'ouverture</label>
                </div>
                <div class="input-field col m1 s5">
                    <input id="sundayClosing3" type="time" placeholder="--:--" class="validate">
                    <label for="sundayClosing3">Horaire de fermeture</label>
                </div>
            </div>
            <!--Dimanche : plus d'horaires (4e ligne)-->
            <div class="row">
                <div class="input-field col m3 offset-m3 s12">
                    <select name="sundayTimetableType4" required>
                        <option value="0" disabled selected>Période</option>
                        <?php
                        //boucle permettant d'afficher la liste des périodes horaires (timetableTypes)
                        foreach ($timetableTypesList as $timetableTypeDetail) {
                            ?>
                            <option value="<?= $timetableTypeDetail->id ?>" <?= ((isset($place->idCategories)) && ($place->idCategories == $timetableTypeDetail->id)) ? 'selected' : '' ?>><?= $timetableTypeDetail->name ?></option>
                        <?php } ?>
                    </select>
                    <label for="sundayTimetableType4">Sélectionner une période horaire</label>
                </div>
                <div class="input-field col m1 s5 offset-s1">
                    <input id="sundayOpenning4" type="time" placeholder="--:--" class="validate">
                    <label for="sundayOpenning4">Horaire d'ouverture</label>
                </div>
                <div class="input-field col m1 s5">
                    <input id="sundayClosing4" type="time" placeholder="--:--" class="validate">
                    <label for="sundayClosing4">Horaire de fermeture</label>
                </div>
            </div>
            <!--Bouton de validation du formulaire-->
            <div class="center-align">
                <button class="btn waves-effect waves-light lime darken-3" type="submit" name="addTimetablesSubmit" id="addTimetablesSubmit">Enregistrer les horaires</button>
            </div>
        </form>
    </div>
</div>
<?php
//insertion du footer
include_once path::getRootPath() . 'footer.php';
?>    