<?php 
include_once 'header.php';
include_once 'controllers/profileCtrl.php'; 
?>
<div class=" container-fluid white">
    <h2 class="center-align">Profil utilisateur</h2>
    <div class="row">
        <div class="col s10 offset-s1">
            <ul>
                <li><span class="boldText">Nom d'utilisateur : </span><?= $profileUser->username ?></li>
                <li><span class="boldText">Type d'utilisateur : </span><?= $profileUser->name ?></li>
                <li><span class="boldText">Inscrit depuis le : </span><?= $profileUser->createDate ?></li>
                <li><span class="boldText">Nom : </span><?= $profileUser->lastname ?></li>
                <li><span class="boldText">Prénom : </span><?= $profileUser->firstname ?></li>
                <li><span class="boldText">Date de naissance : </span><?= $profileUser->birthDate ?></li>
                <li><span class="boldText">Mail : </span><?= $profileUser->mail ?></li>
                <li>Modifier le mot de passe</li>
            </ul>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>