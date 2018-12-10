<?php
//insertion du fichier path et du header
include_once 'classes/path.php';
include_once path::getRootPath() . 'header.php';
?>
<div class="row">
    <div class="col s10 offset-s1 center-align">
        <?php if (isset($_SESSION['isConnect'])) { //vérification que l'utilisateur est connecté ?>
            <h2 class="center-align">Profil de <?= $_SESSION['username'] ?></h2>
            <ul>
                <li><span class="boldText">Nom d'utilisateur : </span><?= $_SESSION['username'] ?></li>
                <li><span class="boldText">Type d'utilisateur : </span><?= $_SESSION['name'] ?></li>
                <li><span class="boldText">Inscrit depuis le : </span><?= $_SESSION['createDate'] ?></li>
                <li><span class="boldText">Nom : </span><?= $_SESSION['lastname'] ?></li>
                <li><span class="boldText">Prénom : </span><?= $_SESSION['firstname'] ?></li>
                <li><span class="boldText">Date de naissance : </span><?= $_SESSION['birthDate'] ?></li>
                <li><span class="boldText">Mail : </span><?= $_SESSION['mail'] ?></li>
            </ul>
            <?php if ($_SESSION['idUserTypes'] == 2) { //Affichage des fonctionnalités propres aux contributeurs ?>
                <a href="Ajout-lieu" class="waves-effect waves-light btn lime darken-3 boldText" title="Lien vers la page d'ajout d'un lieu"><i class="material-icons right">add_location</i>Ajouter un lieu</a>
                <?php
            }
        } else { //si l'utilisateur n'est pas connecté affichage d'un message d'erreur
            ?>
            <h3 class="red-text text-accent-4">Dommage...</h3>
            <p>Connectez-vous pour avoir accès à cette page</p>
            <p>Si vous n'avez pas encore de compte utilisateur vous pouvez vous inscrire en cliquant ci-dessous</p>
            <a href="Inscription-utilisateur" class="waves-effect waves-light btn lime darken-3 boldText" title="Lien vers la page d'inscription">Inscription</a>
        <?php } ?>
    </div>
</div>
<?php
//insertion du footer
include_once path::getRootPath() . 'footer.php';
?>