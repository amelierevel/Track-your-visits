<?php
include_once 'classes/path.php';
include_once path::getControllersPath() . 'updateProfileUserCtrl.php';
include_once path::getRootPath() . 'header.php';
?>
<div>
    <h2 class="center-align">Modification du profil de <?= $profileUser->username ?></h2>
    <div class="row">
        <?php
        //vérification de l'envoi du formulaire et qu'il n'y a pas d'erreurs puis affichage d'un message de succès
        if (isset($_POST['updateUserSubmit']) && (count($formError) === 0)) {
            ?> 
            <p class="boldText green-text center-align">Vos modifications ont bien été prises en compte</p>
            <?php
            //sinon affichage des messages d'erreurs
        } else {
            ?>  
            <!--Formulaire de modification d'un utilisateur-->
            <form action="updateProfileUser.php?id=<?= $profileUser->id ?>" method="POST" class="col s12" id="updateForm">
                <!--Champs nom et prénom-->
                <div class="row">
                    <div class="input-field col m6 s12">
                        <i class="material-icons prefix">account_circle</i>
                        <input type="text" name="lastname" id="lastname" value="<?= $profileUser->lastname ?>" required />
                        <label for="lastname">Nom</label>
                        <?php
                        //affichage du message d'erreur si le tableau d'erreur existe
                        if (isset($formError['lastname'])) {
                            ?>
                            <p class="boldText red-text text-darken-1 center-align"><?= $formError['lastname']; ?></p>
                        <?php } ?>
                    </div>
                    <div class="input-field col m6 s12">
                        <i class="material-icons prefix">account_circle</i>
                        <input  type="text" name="firstname" id="firstname" value="<?= $profileUser->firstname ?>" required />
                        <label for="firstname">Prénom</label>
                        <?php
                        //affichage du message d'erreur si le tableau d'erreur existe
                        if (isset($formError['firstname'])) {
                            ?>
                            <p class="boldText red-text text-darken-1 center-align"><?= $formError['firstname']; ?></p>
                        <?php } ?>
                    </div>
                </div>
                <!--Champs date de naissance et email-->
                <div class="row">
                    <div class="input-field col m6 s12">
                        <i class="material-icons prefix">date_range</i>
                        <input type="date" name="birthDate" id="birthDate" placeholder="jj/mm/aaaa" value="<?= $profileUser->birthDate ?>" required />
                        <label for="birthDate">Date de naissance</label>
                        <?php
                        //affichage du message d'erreur si le tableau d'erreur existe
                        if (isset($formError['birthDate'])) {
                            ?>
                            <p class="boldText red-text text-darken-1 center-align"><?= $formError['birthDate']; ?></p>
                        <?php } ?>
                    </div>
                    <div class="input-field col m6 s12">
                        <i class="material-icons prefix">email</i>
                        <input  type="email" name="mail" id="mail" placeholder="exemple@exemple.fr" value="<?= $profileUser->mail ?>" required />
                        <label for="mail">Mail</label>
                        <?php
                        //affichage du message d'erreur si le tableau d'erreur existe
                        if (isset($formError['mail'])) {
                            ?>
                            <p class="boldText red-text text-darken-1 center-align"><?= $formError['mail']; ?></p>
                        <?php } ?>
                    </div>
                </div>
                <!--Champ type d'utilisateur et bouton pour l'enregistrement des modifications-->
                <div class="row">
                    <div class="input-field col m6 s12">
                        <i class="material-icons prefix">assignment_ind</i>
                        <select name="idUserTypes" required>
                            <option value="0" disabled selected>Type d'utilisateur</option>
                            <?php
                            //boucle permettant d'afficher la liste des types d'utilisateur
                            foreach ($userTypeList as $userTypeDetail) {
                                ?>
                                <option value="<?= $userTypeDetail->id ?>" <?= ($profileUser->idUserTypes == $userTypeDetail->id) ? 'selected' : '' ?>><?= $userTypeDetail->name ?></option>
                            <?php } ?>
                        </select>
                        <label for="idUserTypes">Veuillez sélectionner un type d'utilisateur : </label>
                        <?php
                        //affichage du message d'erreur si le tableau d'erreur existe
                        if (isset($formError['idUserTypes'])) {
                            ?>
                            <p class="boldText red-text text-darken-1 center-align"><?= $formError['idUserTypes']; ?></p>
                        <?php } ?>
                    </div>
                    <div class="input-field col m5 s7 offset-m1 offset-s4">
                        <button class="btn waves-effect waves-light" type="submit" name="updateUserSubmit" id="updateUserSubmit">Enregistrer les modifications</button>
                    </div>
                </div>
            </form>
            <p class="boldText red-text text-darken-1 center-align">
                <?php
                //ternaire permettant l'affichage du message d'erreur si la méthode ne s'exécute pas
                echo isset($formError['updateUserSubmit']) ? $formError['updateUserSubmit'] : '';
                ?>
            </p>
        <?php } ?>
    </div>
</div>
<?php include_once path::getRootPath() . 'footer.php'; ?>