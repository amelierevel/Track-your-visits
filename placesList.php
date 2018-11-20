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
        foreach ($pagingPlacesList as $placeDetail) { //boucle permettant d'afficher la liste des lieux
            ?>
            <li class="collection-item avatar">
                <div class="row">
                    <div class="col s3">
                        <img src="assets/img/noImg.jpg" alt="" class="responsive-img" />
                    </div>
                    <div class="col s9">
                        <h3 class="placesName"><?= $placeDetail->name ?></h3>
                        <p class="categoryText"><?= $placeDetail->category ?></p>
                        <p><?= $placeDetail->description ?></p>
                        <p class="grey-text text-darken-1"><?= $placeDetail->city ?> (<?= $placeDetail->postalCode ?>)</p>
                        <a href="Lieu?id=<?= $placeDetail->id ?>" class="secondary-content">Plus d'info</a>
                    </div>
                </div>
            </li>
        <?php } ?>
    </ul>
</div>
<!--Pagination-->
<ul class="pagination center-align">
    <li class="waves-effect <?= $offset <= 1 ? 'disabled' : '' ?>">
        <a href="Liste-des-lieux?page=<?= $page - 1 ?>"><i class="material-icons">chevron_left</i></a>
    </li>
    <?php
    for ($pageNumber = 1; $pageNumber <= $totalPages; $pageNumber++) { //boucle permettant d'afficher le nombre de page
        ?>
        <li class="waves-effect">
            <a href="Liste-des-lieux?page=<?= $pageNumber ?>"><?= $pageNumber ?></a>
        </li>
    <?php } ?>
    <li class="waves-effect <?= $offset >= $totalPages ? 'disabled' : '' ?>">
        <a href="Liste-des-lieux?page=<?= $page + 1 ?>"><i class="material-icons">chevron_right</i></a>
    </li>
</ul>
<?php
//insertion du footer
include_once path::getRootPath() . 'footer.php';
?>    