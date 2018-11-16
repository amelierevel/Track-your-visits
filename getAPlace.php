<?php
//insertion du fichier path, du header et du controller
include_once 'classes/path.php';
include_once path::getRootPath() . 'header.php';
include_once path::getControllersPath() . 'getAPlaceCtrl.php';
?>
<div class="content">
    <div class="row">
        <div class="col s10 offset-s1 center-align">
            <h2 class="center-align">Profil de <?= $placeInfo->name ?></h2>
            <ul>
                <li><span class="boldText">Nom d'utilisateur : </span><?= $placeInfo->description ?></li>
                <li><span class="boldText">Type d'utilisateur : </span><?= $placeInfo->name ?></li>
                <li><span class="boldText">Inscrit depuis le : </span><?= $placeInfo->address ?></li>
                <li><a href="Ajout-horaires?id=<?= $placeInfo->id ?>">Horaires</a></li>
            </ul>
        </div>
    </div>
</div>
<?php 
//insertion du footer
include_once path::getRootPath() . 'footer.php'; 
?>