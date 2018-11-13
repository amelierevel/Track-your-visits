<?php
//insertion du fichier path, du header et du controller
include_once 'classes/path.php';
include_once path::getRootPath() . 'header.php';
include_once path::getControllersPath() . 'profileCtrl.php';
?>
<div class="content">
    <div class="row">
        <div class="col s10 offset-s1 center-align">
            <h2 class="center-align">Profil utilisateur</h2>
            <ul>
                <li><span class="boldText">Nom d'utilisateur : </span><?= $profileUser->username ?></li>
                <li><span class="boldText">Type d'utilisateur : </span><?= $profileUser->name ?></li>
                <li><span class="boldText">Inscrit depuis le : </span><?= $profileUser->createDate ?></li>
                <li><span class="boldText">Nom : </span><?= $profileUser->lastname ?></li>
                <li><span class="boldText">Prénom : </span><?= $profileUser->firstname ?></li>
                <li><span class="boldText">Date de naissance : </span><?= $profileUser->birthDate ?></li>
                <li><span class="boldText">Mail : </span><?= $profileUser->mail ?></li>
            </ul>
        <?php
        //Affichage des fonctionnalités propres aux contributeurs
        if($profileUser->name == 'Contributeur'){
            ?>
            <a href="Ajout-site-touristique" class="waves-effect waves-light btn lime darken-3 boldText"><i class="material-icons right">add_location</i>Ajouter un site touristique</a>
        <?php
        }
        ?>
        </div>
    </div>
</div>
<?php 
//insertion du footer
include_once path::getRootPath() . 'footer.php'; 
?>