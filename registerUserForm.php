<?php
include_once 'classes/path.php';
include_once path::getRootPath() . 'header.php';
include_once path::getControllersPath() . 'registerUserFormCtrl.php';
?>
<div class="container-fluid white">
    <h2 class="center-align">Inscription d'un nouvel utilisateur</h2>
    <div class="row">
        <?php
        //vérification de l'envoi du formulaire et qu'il n'y a pas d'erreurs puis affichage d'un message de succès
        if (isset($_POST['registerUserSubmit']) && (count($formError) === 0)) {
            ?> 
            <p class="boldText green-text center-align">Votre inscription a bien été prise en compte</p>
            <?php
            //sinon affichage des messages d'erreurs
        } else {
            ?>  
            <!--Formulaire d'inscription d'un utilisateur-->
            <form action="#" method="POST" class="col s12" id="registerForm">
                <!--Champs nom et prénom-->
                <div class="row">
                    <div class="input-field col m6 s12">
                        <i class="material-icons prefix">account_circle</i>
                        <input type="text" name="lastname" id="lastname" value="<?= /* garde en mémoire la saisie dans le champ */ isset($user->lastname) ? $user->lastname : '' ?>" required />
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
                        <input  type="text" name="firstname" id="firstname" value="<?= isset($user->firstname) ? $user->firstname : '' ?>" required />
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
                    <div class="input-field col m6 s12">
                        <i class="material-icons prefix">assignment_ind</i>
                        <input  type="text" name="username" id="username" value="<?= isset($user->username) ? $user->username : '' ?>" required />
                        <label for="username">Nom d'utilisateur</label>
                        <?php
                        //affichage du message d'erreur si le tableau d'erreur existe
                        if (isset($formError['username'])) {
                            ?>
                            <p class="boldText red-text text-darken-1 center-align"><?= $formError['username']; ?></p>
                        <?php } ?>
                    </div>
                    <div class="input-field col m6 s12">
                        <i class="material-icons prefix">assignment_ind</i>
                        <select name="idUserTypes" required>
                            <option value="0" disabled selected>Type d'utilisateur</option>
                            <?php
                            //boucle permettant d'afficher la liste des types d'utilisateur
                            foreach ($userTypeList as $userTypeDetail) {
                                ?>
                                <option value="<?= $userTypeDetail->id ?>" <?= ((isset($user->idUserTypes)) && ($user->idUserTypes == $userTypeDetail->id)) ? 'selected' : '' ?>><?= $userTypeDetail->name ?></option>
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
                </div>
                <!--Champs date de naissance et email-->
                <div class="row">
                    <div class="input-field col m6 s12">
                        <i class="material-icons prefix">date_range</i>
                        <input type="date" name="birthDate" id="birthDate" placeholder="jj/mm/aaaa" value="<?= isset($user->birthDate) ? $user->birthDate : '' ?>" required />
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
                        <input  type="email" name="mail" id="mail" placeholder="exemple@exemple.fr" value="<?= isset($user->mail) ? $user->mail : '' ?>" required />
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
                    <div class="input-field col m6 s12">
                        <i class="material-icons prefix">vpn_key</i>
                        <input type="password" name="password" id="password" required />
                        <label for="password">Mot de passe</label>
                    </div>
                    <div class="input-field col m6 s12">
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
                    <div class="input-field col m5 s10 offset-m5 offset-s2">
                        <button class="btn waves-effect waves-light lime darken-3" type="submit" name="registerUserSubmit" id="registerUserSubmit">Créer un compte</button>
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
<?php include_once path::getRootPath() . 'footer.php'; ?>