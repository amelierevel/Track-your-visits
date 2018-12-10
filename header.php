<?php
//démarrage de la session
session_start();
//insertion du fichier path et du controller
include_once 'classes/path.php';
include_once path::getControllersPath() . 'headerCtrl.php';
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
        <!--Feuille de style-->
        <link rel="stylesheet" href="assets/css/style.css" />
        <!-- CDN Materialize -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css" />
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
        <!--CDN Font-->
        <link href="https://fonts.googleapis.com/css?family=Handlee" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css?family=Archivo+Narrow" rel="stylesheet" /> 
        <!--CDN icone fontawesome-->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" />   
        <title>Track Your Visits</title>
    </head>
    <body class="white">
        <!--Header-->
        <div class="lime lighten-3" id="header">
            <div class="center-align">
                <img src="assets/img/logo.png" alt="Logo du site Track your visits représentant un renard" title="Logo de Track your visits" class="responsive-img" id="headerLogo" />
                <h1 id="titleSite">Track your visits</h1>
            </div>
        </div>
        <!--Affichage du dropdown de connexion de la barre de navigation-->
        <ul class="dropdown-content orange darken-1" id="dropdownConnection">
            <li><a href="Profil" class="white-text boldText" title="Lien vers la page Profil">Profil</a></li>
            <li><a href="Mes-visites" class="white-text boldText" title="Lien vers la page Mes visites">Mes visites</a></li>
            <li><a href="A-voir" class="white-text boldText" title="Lien vers la page des lieux A voir">A voir</a></li>
            <li><a href="Modification-profil" class="white-text boldText" title="Lien vers la page Modifier mon profil">Modifier mon profil</a></li>
            <li class="divider"></li>
            <li><a href="<?= /* ajout de l'action disconnect dans l'url après le chemin du fichier courant */ $_SERVER['PHP_SELF'] ?>?action=disconnect" class="white-text boldText" title="Lien pour la déconnexion">Déconnexion</a></li>
        </ul>
        <!--Barre de navigation-->
        <nav class="orange darken-3 z-depth-3">
            <div class="nav-wrapper">
                <a href="Accueil" class="brand-logo" title="Lien vers la page d'accueil">
                    <img src="assets/img/logoNavbar.png" alt="Logo du site Track your visits représentant un renard" title="Logo de Track your visits" id='logoNavbar' />
                </a>
                <a href="Accueil" data-target="mobileNavbar" class="sidenav-trigger" title="Lien vers la page d'accueil"><i class="material-icons">menu</i></a>
                <ul class="right hide-on-med-and-down">
                    <li><a href="Liste-des-lieux" class="boldText" title="Lien vers la liste des lieux">Voir tous les lieux</a></li>
                    <?php
                    if (isset($_SESSION['isConnect'])) { //si l'utilisateur est connecté affichage de son menu de connexion
                        if ($_SESSION['idUserTypes'] == 2) { //Affichage des fonctionnalités propres aux contributeurs
                            ?>
                            <li><a href="Ajout-lieu" class="boldText" title="Lien vers la page d'ajout d'un lieu">Ajouter un lieu</a></li>
                        <?php } ?>
                        <li><a href="#" data-target="dropdownConnection" class="dropdown-trigger boldText" title="Affichage du menu déroulant"><?= $_SESSION['username'] ?><i class="material-icons right">arrow_drop_down</i></a></li>
                    <?php } else { //si l'utilisateur n'est pas connecté affichage des onglets inscription/connexion ?>
                        <li><a href="Inscription-utilisateur" class="boldText" title="Lien vers la page d'inscription">Créer un compte</a></li>
                        <li><a href="#connectionModal" class="boldText modal-trigger" title="Lien vers la fenêtre de connexion">Se connecter</a></li>
                    <?php } ?>
                </ul>
            </div>
        </nav>
        <!--Affichage du menu de navigation en responsive-->
        <ul class="sidenav" id="mobileNavbar">
            <li><a href="Liste-des-lieux" title="Lien vers la liste des lieux">Voir tous les lieux</a></li>
            <?php
            if (isset($_SESSION['isConnect'])) { //si l'utilisateur est connecté affichage de son menu de connexion
                if ($_SESSION['idUserTypes'] == 2) { //Affichage des fonctionnalités propres aux contributeurs
                    ?>
                    <li><a href="Ajout-lieu" title="Lien vers la page d'ajout d'un lieu">Ajouter un lieu</a></li>
                <?php } ?>
                <li><a href="Profil" title="Lien vers la page Profil">Profil <?= $_SESSION['username'] ?></a></li>
                <li><a href="Mes-visites" title="Lien vers la page Mes visites">Mes visites</a></li>
                <li><a href="A-voir" title="Lien vers la page des lieux A voir">A voir</a></li>
                <li><a href="Modification-profil" title="Lien vers la page Modifier mon profil">Modifier mon profil</a></li>
                <li class="divider"></li>
                <li><a href="<?= /* ajout de l'action disconnect dans l'url */ $_SERVER['PHP_SELF'] ?>?action=disconnect" title="Lien pour la déconnexion">Se déconnecter</a></li>
            <?php } else { //si l'utilisateur n'est pas connecté affichage des onglets inscription/connexion ?>
                <li><a href="Inscription-utilisateur" title="Lien vers la page d'inscription">Créer un compte</a></li>
                <li><a href="#connectionModal" class="modal-trigger" title="Lien vers la fenêtre de connexion">Se connecter</a></li>
            <?php } ?>
        </ul>
        <!-- Modal pour la connexion -->
        <div id="connectionModal" class="modal">
            <div class="modal-content">
                <h2 class="center-align">Connexion</h2>
                <!--formulaire de connexion-->
                <form action="#" method="POST"  class="col m10 s12" id="connectionForm">
                    <div class="row">
                        <p class="boldText red-text text-darken-1 center-align" id="errorMessage">Veuillez vérifier votre nom d'utilisateur et votre mot de passe</p>
                        <div class="input-field col m8 offset-m2 s12">
                            <i class="material-icons prefix">assignment_ind</i>
                            <input  type="text" name="username" id="username" value="<?= isset($username) ? $username : '' ?>" class="validate" required />
                            <label for="username">Nom d'utilisateur</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col m8 offset-m2 s12">
                            <i class="material-icons prefix">vpn_key</i>
                            <input type="text" name="password" id="password" class="validate" required />
                            <label for="password">Mot de passe</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn waves-effect waves-light lime darken-3" type="submit" name="connectionUserSubmit">Se connecter</button>
                    </div>
                </form>
            </div>
        </div>
