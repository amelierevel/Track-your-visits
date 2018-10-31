<?php include_once 'header.php'; ?>
<?php include_once 'controllers/updateProfileUserCtrl.php' ?>
<div class="bgText container z-depth-3">
    <h2 class="center-align">Modification du profil de <?= $profileUser->username ?></h2>
    <div class="row">
        <?php
        //vérification de l'envoi du formulaire et qu'il n'y a pas d'erreurs puis affichage d'un message de succès
        if (isset($_POST['registerUserSubmit']) && (count($formError) === 0)) {
            ?> 
            <p class="boldText green-text center-align">Vos modifications ont bien été prises en compte</p>
            <?php
            //sinon affichage des messages d'erreurs
        } else {
            ?>  
            <!--Formulaire d'inscription d'un utilisateur-->
            <form action="#" method="POST" class="col s12">
                <!--Champs nom et prénom-->
                <div class="row">
                    <div class="input-field col s6">
                        <i class="material-icons prefix">account_circle</i>
                        <input type="text" name="lastname" id="lastname" value="<?= /* garde en mémoire la saisie dans le champ */ isset($lastname) ? $lastname : '' ?>" required />
                        <label for="lastname">Nom</label>
                        <?php
                        //affichage du message d'erreur si le tableau d'erreur existe
                        if (isset($formError['lastname'])) {
                            ?>
                            <p class="boldText red-text text-darken-1 center-align"><?= $formError['lastname']; ?></p>
                        <?php } ?>
                    </div>
                    <div class="input-field col s6">
                        <i class="material-icons prefix">account_circle</i>
                        <input  type="text" name="firstname" id="firstname" value="<?= isset($firstname) ? $firstname : '' ?>" required />
                        <label for="firstname">Prénom</label>
                        <?php
                        //affichage du message d'erreur si le tableau d'erreur existe
                        if (isset($formError['firstname'])) {
                            ?>
                            <p class="boldText red-text text-darken-1 center-align"><?= $formError['firstname']; ?></p>
                        <?php } ?>
                    </div>
                </div>
                <!--Champs nom et type d'utilisateur-->
                <div class="row">
                    <div class="input-field col s6">
                        <i class="material-icons prefix">assignment_ind</i>
                        <input  type="text" name="username" id="username" value="<?= isset($username) ? $username : '' ?>" required />
                        <label for="username">Nom d'utilisateur</label>
                        <?php
                        //affichage du message d'erreur si le tableau d'erreur existe
                        if (isset($formError['username'])) {
                            ?>
                            <p class="boldText red-text text-darken-1 center-align"><?= $formError['username']; ?></p>
                        <?php } ?>
                    </div>
                    <div class="input-field col s6">
                        <i class="material-icons prefix">assignment_ind</i>
                        <select name="idUserType" required>
                            <option value="0" disabled selected>Type d'utilisateur</option>
                            <?php
                            //boucle permettant d'afficher la liste des types d'utilisateur
                            foreach ($userTypeList as $userTypeDetail) {
                                ?>
                                <option value="<?= $userTypeDetail->id ?>" <?= ((isset($idUserType)) && ($idUserType == $userTypeDetail->id)) ? 'selected' : '' ?>><?= $userTypeDetail->name ?></option>
                            <?php } ?>
                        </select>
                        <label for="idUserType">Veuillez sélectionner un type d'utilisateur : </label>
                        <?php
                        //affichage du message d'erreur si le tableau d'erreur existe
                        if (isset($formError['idUserType'])) {
                            ?>
                            <p class="boldText red-text text-darken-1 center-align"><?= $formError['idUserType']; ?></p>
                        <?php } ?>
                    </div>
                </div>
                <!--Champs date de naissance et email-->
                <div class="row">
                    <div class="input-field col s6">
                        <i class="material-icons prefix">date_range</i>
                        <input type="date" name="birthDate" id="birthDate" placeholder="jj/mm/aaaa" value="<?= isset($birthDate) ? $birthDate : '' ?>" required />
                        <label for="birthDate">Date de naissance</label>
                        <?php
                        //affichage du message d'erreur si le tableau d'erreur existe
                        if (isset($formError['birthDate'])) {
                            ?>
                            <p class="boldText red-text text-darken-1 center-align"><?= $formError['birthDate']; ?></p>
                        <?php } ?>
                    </div>
                    <div class="input-field col s6">
                        <i class="material-icons prefix">email</i>
                        <input  type="email" name="mail" id="mail" placeholder="exemple@exemple.fr" value="<?= isset($mail) ? $mail : '' ?>" required />
                        <label for="mail">Mail</label>
                        <?php
                        //affichage du message d'erreur si le tableau d'erreur existe
                        if (isset($formError['mail'])) {
                            ?>
                            <p class="boldText red-text text-darken-1 center-align"><?= $formError['mail']; ?></p>
                        <?php } ?>
                    </div>
                </div>
                <!--Champs mot de passe et vérification mot de passe-->
                <div class="row">
                    <div class="input-field col s6">
                        <i class="material-icons prefix">vpn_key</i>
                        <input type="password" name="password" id="password" required />
                        <label for="password">Mot de passe</label>
                    </div>
                    <div class="input-field col s6">
                        <i class="material-icons prefix">check</i>
                        <input  type="password" name="passwordVerify" id="passwordVerify" required />
                        <label for="passwordVerify">Vérification du mot de passe</label>
                        <?php
                        //affichage du message d'erreur si le tableau d'erreur existe
                        if (isset($formError['password'])) {
                            ?>
                            <p class="boldText red-text text-darken-1 center-align"><?= $formError['password']; ?></p>
                        <?php } ?>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s2 offset-s5">
                        <button class="btn waves-effect waves-light" type="submit" name="registerUserSubmit" id="registerUserSubmit">Créer un compte</button>
                    </div>
                </div>
            </form>
            <p class="boldText red-text text-darken-1 center-align">
                <?php
                //ternaire permettant l'affichage du message d'erreur si la méthode ne s'exécute pas
                echo isset($formError['registerUserSubmit']) ? $formError['registerUserSubmit'] : '';
                ?>
            </p>
        <?php } ?>
    </div>
</div>
<?php include_once 'footer.php'; ?>