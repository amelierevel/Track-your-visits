<?php
//insertion du fichier path, du controller puis du header 
include_once 'classes/path.php';
include_once path::getControllersPath() . 'updateProfileUserCtrl.php';
include_once path::getRootPath() . 'header.php';
?>
<div>
    <?php if (isset($_SESSION['isConnect'])) { //vérification que l'utilisateur est connecté ?>
        <h2 class="center-align">Modification du profil de <?= $_SESSION['username'] ?></h2>
        <div class="row">
            <?php
            //vérification de l'envoi du formulaire de modification du profil et qu'il n'y a pas d'erreurs puis affichage d'un message de succès
            if (isset($_POST['updateUserSubmit']) && (count($formError) === 0)) {
                ?> 
                <p class="boldText green-text center-align">Vos modifications ont bien été prises en compte</p>
            <?php } else { //sinon affichage des messages d'erreurs dans le formulaire ?>  
                <!--Formulaire de modification d'un utilisateur-->
                <form action="#" method="POST" class="col s12">
                    <!--Champs email et type d'utilisateur-->
                    <div class="row">
                        <div class="input-field col m4 offset-m2 s12">
                            <i class="material-icons prefix">email</i>
                            <input  type="email" name="mail" id="mail" placeholder="exemple@exemple.fr" value="<?= $_SESSION['mail'] ?>" required />
                            <label for="mail">Mail</label>
                            <?php if (isset($formError['mail'])) { //affichage du message d'erreur si le tableau d'erreur existe ?>
                                <p class="boldText red-text text-darken-1 center-align"><?= $formError['mail'] ?></p>
                            <?php } ?>
                        </div>
                        <div class="input-field col m4 s12">
                            <i class="material-icons prefix">assignment_ind</i>
                            <select name="idUserTypes" required>
                                <option value="0" disabled selected>Type d'utilisateur</option>
                                <?php foreach ($userTypeList as $userTypeDetail) { //boucle permettant d'afficher la liste des types d'utilisateur ?>
                                    <option value="<?= $userTypeDetail->id ?>" <?= ($_SESSION['idUserTypes'] == $userTypeDetail->id) ? 'selected' : '' ?>><?= $userTypeDetail->name ?></option>
                                <?php } ?>
                            </select>
                            <label for="idUserTypes">Veuillez sélectionner un type d'utilisateur</label>
                            <?php if (isset($formError['idUserTypes'])) { //affichage du message d'erreur si le tableau d'erreur existe ?>
                                <p class="boldText red-text text-darken-1 center-align"><?= $formError['idUserTypes'] ?></p>
                            <?php } ?>
                        </div>
                    </div>
                    <!--Bouton pour l'enregistrement des modifications-->
                    <div class="input-field col s12 center-align">
                        <button class="btn waves-effect waves-light lime darken-3" type="submit" name="updateUserSubmit" id="updateUserSubmit">Enregistrer les modifications</button>
                    </div>
                </form>
                <p class="boldText red-text text-darken-1 center-align">
                    <?php
                    // ternaire permettant l'affichage du message d'erreur si la méthode ne s'exécute pas
                    echo isset($formError['updateUserSubmit']) ? $formError['updateUserSubmit'] : '';
                    ?>
                </p>
            <?php } ?>
        </div>
        <!--Section modification du mot de passe-->
        <div class="row">
            <?php
            //vérification de l'envoi du formulaire et qu'il n'y a pas d'erreurs puis affichage d'un message de succès
            if (isset($_POST['updatePasswordSubmit']) && (count($formError) === 0)) {
                ?> 
                <p class="boldText green-text center-align">Votre nouveau mot de passe est bien enregistré</p>
            <?php } else { //sinon affichage des messages d'erreurs dans le formulaire ?>  
                <!--Formulaire de modification du mot de passe-->
                <form action="#" method="POST" class="col s12">
                    <div class="row">
                        <div class="input-field col m2 offset-m2 s12">
                            <i class="material-icons prefix">vpn_key</i>
                            <input  type="password" name="oldPassword" id="oldPassword" required />
                            <label for="oldPassword">Mot de passe actuel</label>
                        </div>
                        <div class="input-field col m3 s12">
                            <i class="material-icons prefix">vpn_key</i>
                            <input  type="password" name="newPassword" id="newPassword" />
                            <label for="newPassword">Nouveau mot de passe</label>
                        </div>
                        <div class="input-field col m3 s12">
                            <i class="material-icons prefix">vpn_key</i>
                            <input  type="password" name="newPasswordVerify" id="newPasswordVerify" />
                            <label for="newPasswordVerify">Vérification du nouveau mot de passe</label>
                        </div>
                        <?php if (isset($formError['password'])) { //affichage du message d'erreur si le tableau d'erreur existe ?>
                            <p class="boldText red-text text-darken-1 center-align"><?= $formError['password'] ?></p>
                        <?php } ?>
                        <!--Bouton pour l'enregistrement de la modification du mot de passe-->
                        <div class="input-field col s12 center-align">
                            <button class="btn waves-effect waves-light lime darken-3" type="submit" name="updatePasswordSubmit" id="updatePasswordSubmit">Changer de mot de passe</button>
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
        <!--Section suppression utilisateur-->
        <div class="row">
            <div class="center-align">
                Supprimer le compte
                <a href="#deleteVerify" class="btn-floating waves-effect waves-light red accent-4 pulse modal-trigger" title="Lien vers la fenêtre de confirmation de suppression de l'utilisateur"><i class="material-icons">delete</i></a>
            </div>
        </div>
        <?php if (isset($deleteError)) { //affichage du message d'erreur s'il existe ?>  
            <p class="boldText red-text text-darken-1 center-align"><?= $deleteError ?></p>
        <?php } ?>
        <!--Modal pour confirmation suppression du compte utilisateur-->
        <div id="deleteVerify" class="modal">
            <div class="modal-content">
                <h3 class="center-align">Supprimer le compte</h3>
                <p class="center-align">La suppression est irréversible, elle entraînera la perte de toutes vos informations.</p>
                <p class="center-align">Voulez-vous vraiment supprimer votre compte ?</p>
                <div class="modal-footer">
                    <a href="Modification-profil?idDelete=<?= $_SESSION['id'] ?>" class="waves-effect waves-green btn red accent-4 boldText" title="Lien pour la suppression de l'utilisateur">Suppression du compte</a>
                    <a href="#" class="modal-close waves-effect waves-green btn grey boldText" title="Lien pour annuler et retourner sur la page de modification du profil">Annuler</a>
                </div>
            </div>
        </div>
        <!--Fin modal-->
    <?php } else { //si l'utilisateur n'est pas connecté affichage d'un message d'erreur ?>
        <div class="row">
            <h3 class="red-text text-accent-4">Dommage...</h3>
            <p>Connectez-vous pour avoir accès à cette page</p>
            <p>Si vous n'avez pas encore de compte utilisateur vous pouvez vous inscrire en cliquant ci-dessous</p>
            <a href="Inscription-utilisateur" class="waves-effect waves-light btn lime darken-3 boldText" title="Lien vers la page d'inscription">Inscription</a>
        </div>
    <?php } ?>
</div>
<?php
//insertion du footer
include_once path::getRootPath() . 'footer.php';
?>