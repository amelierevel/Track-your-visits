<?php
//insertion du fichier path et du header
include_once 'classes/path.php';
include_once path::getRootPath() . 'header.php';
?>
<div class="content">
    <div class="row">
        <div class="col s10 offset-s1 center-align">
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
            <?php
            if ($_SESSION['name'] == 'Contributeur') { //Affichage des fonctionnalités propres aux contributeurs
                ?>
                <a href="Ajout-site-touristique" class="waves-effect waves-light btn lime darken-3 boldText"><i class="material-icons right">add_location</i>Ajouter un site touristique</a>
            <?php } ?>
        </div>
    </div>
</div>
<?php
//insertion du footer
include_once path::getRootPath() . 'footer.php';
?>