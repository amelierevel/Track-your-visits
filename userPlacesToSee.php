<?php
//insertion du fichier path, du controller puis du header
include_once 'classes/path.php';
include_once path::getControllersPath() . 'userPlacesToSeeCtrl.php';
include_once path::getRootPath() . 'header.php';
?>
<div class="row">
    <div class="col m10 offset-m1 s12">
        <h2 class="center-align">Mes lieux à voir</h2>
        <div class="row">
            <?php
            foreach ($placesToSeeList as $placeDetail) { //boucle permettant d'afficher la liste des lieux
                ?>
                <div class="card  col m4 s12">
                    <div class="card-image">
                        <img src="assets/img/berger_picard.jpg" class="responsive-img" />
                    </div>
                    <div class="card-stacked">
                        <div class="card-content">
                            <a href="A-voir?idPlaceDelete=<?= $placeDetail->idPlaceToSee ?>" class="btn-floating waves-effect waves-light red accent-4 secondary-content deleteButton"><i class="material-icons">delete</i></a>
                            <?php
                            if (isset($deleteError)) { //affichage du message d'erreur s'il existe
                                ?>  
                                <p class="red-text text-darken-1 center-align"><?= $deleteError; ?></p>
                            <?php } ?>
                            <h3><?= $placeDetail->name ?></h3>
                            <p><?= $placeDetail->category ?></p>
                            <p class="grey-text text-darken-1"><?= $placeDetail->city ?> (<?= $placeDetail->postalCode ?>)</p>
                        </div>
                        <div class="card-action center-align">
                            <a href="Lieu?id=<?= $placeDetail->id ?>">Voir les informations de ce lieu</a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
<?php
//insertion du footer
include_once path::getRootPath() . 'footer.php';
?>    