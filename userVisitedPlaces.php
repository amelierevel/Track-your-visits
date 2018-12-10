<?php
//insertion du fichier path, du controller puis du header
include_once 'classes/path.php';
include_once path::getControllersPath() . 'userVisitedPlacesCtrl.php';
include_once path::getRootPath() . 'header.php';
?>
<div class="row">
    <div class="col m10 offset-m1 s12">
        <h2 class="center-align">Mes visites</h2>
        <div class="row center-align">
            <?php
            if (isset($_SESSION['isConnect'])) { //vérification que l'utilisateur est connecté
                if (empty($visitedPlacesList)) { //s'il n'a aucun lieu visité enregistré affichage d'un message d'erreur
                    ?>
                    <h3 class="red-text text-accent-4">Dommage...</h3>
                    <p>Vous n'avez pas encore de lieux enregistrés pour le moment.</p> 
                    <p>Vous pouvez consulter la liste des lieux pour commencer à remplir cette section.</p>
                    <a href="Liste-des-lieux" class="boldText btn waves-effect waves-light lime darken-3" title="Lien vers la liste des lieux">Voir la liste des lieux</a>
                    <?php
                } else { // sinon l'utilisateur a des lieux visités enregistrés et ils s'affichent
                    foreach ($visitedPlacesList as $placeDetail) { //boucle permettant d'afficher la liste des lieux
                        ?>
                        <div class="card col m4 s12">
                            <div class="card-image">
                                <?php if (isset($placeDetail->picture)) { //si le lieu a une image l'afficher ?>
                                    <img src="assets/img/placeImages/<?= $placeDetail->picture ?>" alt="Image représentant <?= $placeDetail->name ?>" title="Image de <?= $placeDetail->name ?>" class="responsive-img imgSize" />
                                <?php } else { //sinon afficher une image par défaut ?>
                                    <img src="assets/img/noImg.jpg" alt="Pas d'image disponible" title="Pas d'image disponible" class="responsive-img imgSize" />
                                <?php } ?>
                            </div>
                            <div class="card-stacked">
                                <div class="card-content">
                                    <a href="Mes-visites?idPlaceDelete=<?= $placeDetail->idVisitedPlace ?>" class="btn-floating waves-effect waves-light red accent-4 secondary-content deleteButton" title="Lien pour la suppression du lieu"><i class="material-icons">delete</i></a>
                                    <?php
                                    if (isset($deleteError)) { //affichage du message d'erreur s'il existe
                                        ?>  
                                        <p class="red-text text-darken-1 center-align"><?= $deleteError ?></p>
                                    <?php } ?>
                                    <h3 class="truncate"><?= $placeDetail->name ?></h3>
                                    <p><?= $placeDetail->category ?></p>
                                    <p class="grey-text text-darken-1"><?= $placeDetail->city ?> (<?= $placeDetail->postalCode ?>)</p>
                                </div>
                                <div class="card-action center-align">
                                    <a href="Lieu?id=<?= $placeDetail->id ?>" title="Lien vers la page <?= $placeDetail->name ?>">Voir les informations de ce lieu</a>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
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
</div>
<?php
//insertion du footer
include_once path::getRootPath() . 'footer.php';
?>    