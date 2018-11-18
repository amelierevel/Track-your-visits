<?php
//insertion du fichier path, du header et du controller
include_once 'classes/path.php';
include_once path::getRootPath() . 'header.php';
include_once path::getControllersPath() . 'placesListCtrl.php'
?>
<div class="row">
    <h2 class="center-align">Liste des sites touristiques</h2>
    <ul class="collection col s12 m10 offset-m1">
        <?php
        //boucle permettant d'afficher la liste des rdv
        foreach ($placesList as $placeDetail) {
            ?>
            <li class="collection-item avatar">
                <div class="row">
                    <div class="col s3">
                        <img src="assets/img/berger_picard.jpg" alt="" class="responsive-img" />
                    </div>
                    <div class="col s9">
                        <h3><?= $placeDetail->name ?></h3>
                        <p><?= $placeDetail->description ?></p>
                        <a href="Site-touristique?id=<?= $placeDetail->id ?>" class="secondary-content">Plus d'info</a>
                    </div>
                </div>
            </li>
        <?php } ?>
    </ul>
</div>
<?php
//insertion du footer
include_once path::getRootPath() . 'footer.php';
?>    