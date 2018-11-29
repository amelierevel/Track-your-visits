<?php
//insertion du fichier path, du header et du controller
include_once 'classes/path.php';
include_once path::getControllersPath() . 'placesListCtrl.php';
include_once path::getRootPath() . 'header.php';
?>
<div class="row">
    <h2 class="center-align">Liste des sites touristiques</h2>
    <div class="row">
        <form method="POST" action="#">
            <div class="center-align col m10 offset-m1 s12" id="bgSearchForm">
                Rechercher un lieu :
                <div class="input-field inline">
                    <input type="text" name="searchName" id="searchName" class="validate" />
                    <label for="searchName">Nom</label>
                </div>
                <button class="btn waves-effect waves-light lime darken-3" type="submit" name="searchPlaceSubmit" id="searchPlaceSubmit">
                    <i class="material-icons">search</i>
                </button>
                <p class="red-text text-darken-1 center-align"><?= isset($errorMessage) ? $errorMessage : ''; //ternaire permettant l'affichage du message d'erreur s'il existe     ?></p>
            </div>
        </form>
    </div>
    <ul class="collection col m10 offset-m1 s12">
        <?php
        if (!empty($_POST['searchName'])) {
            foreach ($placesFindList as $placeFindDetail) {
                ?>
                <li class="collection-item avatar">
                    <div class="row">
                        <div class="col m3 s12">
                            <?php if (isset($placeFindDetail->picture)) { ?>
                                <img src="assets/img/placeImages/<?= $placeFindDetail->picture ?>" title="" alt="" class="responsive-img" />
                            <?php } else { ?>
                                <img src="assets/img/noImg.jpg" title="Pas d'image disponible" alt="Pas d'image disponible" class="responsive-img" />
                            <?php } ?>
                        </div>
                        <div class="col m9 s12">
                            <h3 class="placesName truncate"><a href="Lieu?id=<?= $placeFindDetail->id ?>" title="" class="black-text"><?= $placeFindDetail->name ?></a></h3>
                            <p class="categoryText"><?= $placeFindDetail->category ?></p>
                            <p><?= $placeFindDetail->description ?></p>
                            <p class="grey-text text-darken-1"><?= $placeFindDetail->city ?> (<?= $placeFindDetail->postalCode ?>)</p>
                            <a href="Lieu?id=<?= $placeFindDetail->id ?>" title="" class="secondary-content hide-on-small-only">Plus d'info</a>
                        </div>
                    </div>
                </li>
                <?php
            }
        } else {
            foreach ($pagingPlacesList as $placeDetail) { //boucle permettant d'afficher la liste des lieux
                ?>
                <li class="collection-item avatar">
                    <div class="row">
                        <div class="col m3 s12">
                            <?php if (isset($placeDetail->picture)) { ?>
                                <img src="assets/img/placeImages/<?= $placeDetail->picture ?>" title="" alt="" class="responsive-img" />
                            <?php } else { ?>
                                <img src="assets/img/noImg.jpg" title="Pas d'image disponible" alt="Pas d'image disponible" class="responsive-img" />
                            <?php } ?>
                        </div>
                        <div class="col m9 s12">
                            <h3 class="placesName truncate"><a href="Lieu?id=<?= $placeDetail->id ?>" title="Lien vers la page du lieu <?= $placeDetail->name ?>" class="black-text"><?= $placeDetail->name ?></a></h3>
                            <p class="categoryText"><?= $placeDetail->category ?></p>
                            <p><?= $placeDetail->description ?></p>
                            <p class="grey-text text-darken-1"><?= $placeDetail->city ?> (<?= $placeDetail->postalCode ?>)</p>
                            <a href="Lieu?id=<?= $placeDetail->id ?>" class="secondary-content hide-on-small-only">Plus d'info</a>
                        </div>
                    </div>
                </li>
                <?php
            }
        }
        ?>
    </ul>
</div>
<!--Pagination-->
<ul class="pagination center-align">
    <?php if ($offset > 1) { ?>
        <li class="waves-effect">
            <a href="Liste-des-lieux?page=<?= $page - 1 ?>"><i class="material-icons">chevron_left</i></a>
        </li>
        <?php
    }
    for ($pageNumber = 1; $pageNumber <= $totalPages; $pageNumber++) { //boucle permettant d'afficher le nombre de page
        ?>
        <li class="waves-effect">
            <a href="Liste-des-lieux?page=<?= $pageNumber ?>"><?= $pageNumber ?></a>
        </li>
        <?php
    }
    if ($offset < $totalPages) {
        ?>
        <li class="waves-effect">
            <a href="Liste-des-lieux?page=<?= $page + 1 ?>"><i class="material-icons">chevron_right</i></a>
        </li>
<?php } ?>
</ul>
<?php
//insertion du footer
include_once path::getRootPath() . 'footer.php';
?>    