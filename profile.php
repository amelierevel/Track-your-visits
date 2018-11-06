<?php
include_once 'classes/path.php';
include_once path::getControllersPath() . 'profileCtrl.php';
include_once path::getRootPath() . 'header.php';
?>
<div class="content">
    <div class="row">
<!--        <div class="col s3 orange darken-1 white-text">
            <ul>
                <li><a href="#" class="white-text">Favoris</a></li>
                <li class="divider"></li>
                <li><a href="#" class="white-text">Mes visites</a></li>
                <li class="divider"></li>
                <li><a href="#" class="white-text">A voir</a></li>
                <li class="divider"></li>
                <li><a href="updateProfileUser.php?id=<?= $profileUser->id ?>" class="white-text">Modifier mon profil</a></li>
            </ul>
        </div>-->
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
            <p>
                Modifier le mot de passe
                <a href="#" class="btn-floating pulse"><i class="material-icons">edit</i></a>
            </p>
            <p>
                Supprimer le compte
                <a href="profile.php?idDelete=<?= $profileUser->id ?>" class="btn-floating waves-effect waves-light pulse"><i class="material-icons">delete</i></a>
                <?php
                //affichage du message d'erreur s'il existe MAIS CA MARCHE PAS
                if (isset($deleteError)) {
                    echo $deleteError;
                }
                ?>
            </p>
        </div>
    </div>
</div>
<?php include_once path::getRootPath() . 'footer.php'; ?>