<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
        <!--Feuille de style-->
        <link rel="stylesheet" href="../assets/css/style.css" />
        <!-- CDN Materialize -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css" />
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
        <!--CDN Font-->
        <link href="https://fonts.googleapis.com/css?family=Courgette" rel="stylesheet" /> 
        <!--CDN icone fontawesome-->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" />
        <!--Script JQuery-->
        <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
        <!--Script Materialize-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
        <!--Feuille de script-->
        <script src="../assets/js/script.js"></script>
        <title>Track Your Visits</title>
    </head>
    <body>
        <!--Header-->
        <div class="container">
            <div class="center-align">
                <img src="../assets/img/logo.png" alt="Logo du site Track your visits représentant un renard" title="Logo de Track your visits" class="responsive-img" />
                <h1 id="titleSite">Track your visits</h1>
            </div>
        </div>
        <!--Barre de navigation-->
        <nav>
            <div class="nav-wrapper">
                <a href="../index.php" class="brand-logo">
                    <img src="../assets/img/logo.png" alt="Logo du site Track your visits représentant un renard" title="Logo de Track your visits" id='logoNavbar' />
                </a>
                <a href="../index.php" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
                <ul class="right hide-on-med-and-down">
                    <li><a href="sass.html">Sass</a></li>
                    <li><a href="badges.html">Components</a></li>
                    <li><a href="views/inscriptionUserForm.php">Inscription</a></li>
                    <li><a href="#">Connexion</a></li>
                </ul>
            </div>
        </nav>
        <!--Affichage du menu de navigation en responsive-->
        <ul class="sidenav" id="mobile-demo">
            <li><a href="sass.html">Sass</a></li>
            <li><a href="badges.html">Components</a></li>
            <li><a href="views/inscriptionUserForm.php">Inscription</a></li>
            <li><a href="#">Connexion</a></li>
        </ul>

