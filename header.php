<?php
//démarrage de la session
session_start();
include_once 'controllers/headerCtrl.php';
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
        <!--CDN icone fontawesome-->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" />
        <!--Script JQuery-->
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        <!--Script Materialize-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
        <!--Feuille de script-->
        <script src="assets/js/script.js"></script>
        <title>Track Your Visits</title>
    </head>
    <body class="teal accent-1">
        <!--Header-->
        <div class="container">
            <div class="center-align">
                <img src="assets/img/logo.png" alt="Logo du site Track your visits représentant un renard" title="Logo de Track your visits" class="responsive-img" />
                <h1 id="titleSite">Track your visits</h1>
            </div>
        </div>
        <!--Affichage du dropdown de connexion de la barre de navigation-->
        <ul id="dropdownConnection" class="dropdown-content">
            <li><a href="#">Profil</a></li>
            <li class="divider"></li>
            <li><a href="<?= /* ajout de l'action disconnect dans l'url */ $_SERVER['PHP_SELF'] ?>?action=disconnect">Déconnexion</a></li>
        </ul>
        <!--Barre de navigation-->
        <nav class="deep-orange lighten-2">
            <div class="nav-wrapper">
                <a href="../index.php" class="brand-logo">
                    <img src="assets/img/logo.png" alt="Logo du site Track your visits représentant un renard" title="Logo de Track your visits" id='logoNavbar' />
                </a>
                <a href="index.php" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">Menu</i></a>
                <ul class="right hide-on-med-and-down">
                    <li><a href="sass.html" class="boldText">Sass</a></li>
                    <li><a href="badges.html" class="boldText">Components</a></li>
                    <li><a href="registerUserForm.php" class="boldText">Inscription</a></li>
                    <?php
                    //si l'utilisateur est connecté affichage de son menu de connexion
                    if (isset($_SESSION['isConnect'])) {
                        ?>
                        <li><a class="dropdown-trigger" href="#" data-target="dropdownConnection" class="boldText"><?= $_SESSION['username'] ?><i class="material-icons right">arrow_drop_down</i></a></li>
                        <?php
                        //si l'utilisateur n'est pas connecté affichage de l'onglet connexion
                    } else {
                        ?>
                        <li><a href="connexion.php" class="boldText">Connexion</a></li>
                    <?php } ?>
                </ul>
            </div>
        </nav>
        <!--Affichage du menu de navigation en responsive-->
        <ul class="sidenav" id="mobile-demo">
            <li><a href="sass.html">Sass</a></li>
            <li><a href="badges.html">Components</a></li>
            <li><a href="registerUserForm.php">Inscription</a></li>
            <li><a href="connexion.php">Connexion</a></li>
        </ul>

