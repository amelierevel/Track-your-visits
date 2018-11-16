<?php
//insertion du fichier path, du header et du controller
include_once 'classes/path.php';
include_once path::getRootPath() . 'header.php';
include_once path::getControllersPath() . 'placesListCtrl.php'
?>
<div>
    <h2 class="">Liste des rendez-vous</h2>
    <!--Création d'un tableau qui affichera tous les rendez-vous-->
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Nom</th>
                <th scope="col">Adresse</th>
                <th scope="col">Date de création</th>
                <th scope="col">En savoir plus</th>
            </tr>
        </thead>
        <tbody>
            <?php
            //boucle permettant d'afficher la liste des rdv
            foreach ($placesList as $placeDetail) {
                ?>
                <tr>
                    <td><?= $placeDetail->id ?></td>
                    <td><?= $placeDetail->name ?></td>
                    <td><?= $placeDetail->address ?></td>
                    <td><?= $placeDetail->createDate ?></td>
                    <td><a href="Site-touristique?id=<?= $placeDetail->id ?>">Cliquez ici</a></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<?php
//insertion du footer
include_once path::getRootPath() . 'footer.php';
?>    