<?php include_once 'header.php'; ?>
<?php include_once 'controllers/connexionCtrl.php'; ?>
<div class="bgText container">
    <h2 class="center-align">Connexion utilisateur</h2>
    <?php
    //vérification que le message de connexion n'est pas vide et l'afficher
    if ($messageConnection != '') {
        ?>
        <p class="boldText center-align"><?= $messageConnection ?></p>
    <?php } ?>
    <!--formulaire de connexion-->
    <form action="#" method="POST"  class="col s10">
        <div class="row">
            <div class="input-field col s8 offset-s2">
                <i class="material-icons prefix">assignment_ind</i>
                <input  type="text" name="username" id="username" value="<?= isset($username) ? $username : '' ?>" class="validate" required />
                <label for="username">Nom d'utilisateur</label>
                <?php
                //affichage du message d'erreur si le tableau d'erreur existe
                if (isset($errorList['username'])) {
                    ?>
                    <p class="boldText red-text text-darken-1 center-align"><?= $errorList['username']; ?></p>
                <?php } ?>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s8 offset-s2">
                <i class="material-icons prefix">vpn_key</i>
                <input type="password" name="password" id="password" class="validate" required />
                <label for="password">Mot de passe</label>
                <?php
                //affichage du message d'erreur si le tableau d'erreur existe
                if (isset($errorList['password'])) {
                    ?>
                    <p class="boldText red-text text-darken-1 center-align"><?= $errorList['password']; ?></p>
                <?php } ?>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s2 offset-s8">
                <button class="btn waves-effect waves-light" type="submit" name="connexionUserSubmit">Se connecter</button>
            </div>
        </div>
    </form>
</div>
<?php include 'footer.php'; ?>