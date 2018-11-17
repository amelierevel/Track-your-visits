<?php
//insertion du fichier path, du header et du controller
include_once 'classes/path.php';
include_once path::getRootPath() . 'header.php';
include_once path::getControllersPath() . 'placesListCtrl.php'
?>
<div>
    <ul class="collection">
        <li class="collection-item avatar">
            <img src="" alt="" class="circle" />
            <span class="title">Title</span>
            <p>First Line <br>
                Second Line
            </p>
            <a href="#!" class="secondary-content"><i class="material-icons">grade</i></a>
        </li>
        <li class="collection-item avatar">
            <i class="material-icons circle">folder</i>
            <span class="title">Title</span>
            <p>First Line <br>
                Second Line
            </p>
            <a href="#!" class="secondary-content"><i class="material-icons">grade</i></a>
        </li>
        <li class="collection-item avatar">
            <i class="material-icons circle green">insert_chart</i>
            <span class="title">Title</span>
            <p>First Line <br>
                Second Line
            </p>
            <a href="#!" class="secondary-content"><i class="material-icons">grade</i></a>
        </li>
        <li class="collection-item avatar">
            <i class="material-icons circle red">play_arrow</i>
            <span class="title">Title</span>
            <p>First Line <br>
                Second Line
            </p>
            <a href="#!" class="secondary-content"><i class="material-icons">grade</i></a>
        </li>
    </ul>




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