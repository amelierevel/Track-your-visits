<?php
//insertion du fichier path, du header et du controller
include_once 'classes/path.php';
include_once path::getRootPath() . 'header.php';
include_once path::getControllersPath() . 'registerContributorFormCtrl.php';
?>
<div class="white center-align">
    <h2>Inscription d'un nouvel utilisateur</h2>
    <div class="row">
        <?php
        //vérification de l'envoi du formulaire et qu'il n'y a pas d'erreurs puis affichage d'un message de succès
        if (isset($_POST['registerContributorSubmit']) && (count($formError) === 0)) {
            ?>
            <h3 class="boldText green-text center-align">Félicitations !</h3>
            <p class="center-align">Votre inscription a bien été prise en compte.</p>
            <p class="center-align">Vous pouvez maintenant vous connecter pour découvrir toutes les fonctionnalités du site.</p>
        <?php } else { //sinon affichage des messages d'erreurs ?>
            <!--Formulaire d'inscription d'un utilisateur contributeur-->
            <form action="#" method="POST" class="col s8 offset-s2">
                <!--Champ nom-->
                <div class="row">
                    <div class="input-field col s12">
                        <i class="material-icons prefix">account_circle</i>
                        <input type="text" name="lastname" id="lastname" value="<?= /* garde en mémoire la saisie dans le champ */ isset($user->lastname) ? $user->lastname : '' ?>" required />
                        <label for="lastname">Nom</label>
                        <?php if (isset($formError['lastname'])) { //affichage du message d'erreur si le tableau d'erreur existe ?>
                            <p class="boldText red-text text-darken-1 center-align"><?= $formError['lastname'] ?></p>
                        <?php } ?>
                    </div>
                </div>
                <!--Champ prénom-->
                <div class="row">
                    <div class="input-field col s12">
                        <i class="material-icons prefix">account_circle</i>
                        <input  type="text" name="firstname" id="firstname" value="<?= isset($user->firstname) ? $user->firstname : '' ?>" required />
                        <label for="firstname">Prénom</label>
                        <?php if (isset($formError['firstname'])) { //affichage du message d'erreur si le tableau d'erreur existe ?>
                            <p class="boldText red-text text-darken-1 center-align"><?= $formError['firstname'] ?></p>
                        <?php } ?>
                    </div>
                </div>
                <!--Champ nom d'utilisateur-->
                <div class="row">
                    <div class="input-field col s12">
                        <i class="material-icons prefix">assignment_ind</i>
                        <input  type="text" name="username" id="username" value="<?= isset($user->username) ? $user->username : '' ?>" required />
                        <label for="username">Nom d'utilisateur</label>
                        <?php if (isset($formError['username'])) { //affichage du message d'erreur si le tableau d'erreur existe ?>
                            <p class="boldText red-text text-darken-1 center-align"><?= $formError['username'] ?></p>
                        <?php } ?>
                    </div>
                </div>
                <!--Champ date de naissance-->
                <div class="row">
                    <div class="input-field col s12">
                        <i class="material-icons prefix">date_range</i>
                        <input type="date" name="birthDate" id="birthDate" placeholder="jj/mm/aaaa" value="<?= isset($user->birthDate) ? $user->birthDate : '' ?>" required />
                        <label for="birthDate">Date de naissance</label>
                        <?php if (isset($formError['birthDate'])) { //affichage du message d'erreur si le tableau d'erreur existe ?>
                            <p class="boldText red-text text-darken-1 center-align"><?= $formError['birthDate'] ?></p>
                        <?php } ?>
                    </div>
                </div>
                <!--Champ email-->
                <div class="row">
                    <div class="input-field col s12">
                        <i class="material-icons prefix">email</i>
                        <input  type="email" name="mail" id="mail" placeholder="exemple@exemple.fr" value="<?= isset($user->mail) ? $user->mail : '' ?>" required />
                        <label for="mail">Mail</label>
                        <?php if (isset($formError['mail'])) { //affichage du message d'erreur si le tableau d'erreur existe ?>
                            <p class="boldText red-text text-darken-1 center-align"><?= $formError['mail'] ?></p>
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
                    </div>
                    <?php if (isset($formError['password'])) { //affichage du message d'erreur si le tableau d'erreur existe ?>
                        <p class="boldText red-text text-darken-1 center-align"><?= $formError['password'] ?></p>
                    <?php } ?>
                </div>
                <!--Bouton de validation du formulaire-->
                <button class="btn waves-effect waves-light lime darken-3" type="submit" name="registerContributorSubmit" id="registerContributorSubmit">Créer un compte</button>
            </form>
        <?php } ?>
        <p class="boldText red-text text-darken-1 center-align">
            <?php
            //ternaires permettant l'affichage du message d'erreur si la méthode ne s'exécute pas correctement
            echo isset($formError['registerContributorSubmit']) ? $formError['registerContributorSubmit'] : '';
            echo isset($formError['execute']) ? $formError['execute'] : '';
            ?>
        </p>
    </div>
</div>
<?php
//insertion du footer
include_once path::getRootPath() . 'footer.php';
?>