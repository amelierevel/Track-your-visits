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
        <link href="https://fonts.googleapis.com/css?family=Handlee" rel="stylesheet" />
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
    <body class="teal accent-1">
        <!--Header-->
        <div class="container">
            <div class="center-align">
                <img src="../assets/img/logo.png" alt="Logo du site Track your visits représentant un renard" title="Logo de Track your visits" class="responsive-img" />
                <h1 id="titleSite">Track your visits</h1>
            </div>
        </div>
        <!--Barre de navigation-->
        <nav class="deep-orange lighten-2">
            <div class="nav-wrapper">
                <a href="../index.php" class="brand-logo">
                    <img src="../assets/img/logo.png" alt="Logo du site Track your visits représentant un renard" title="Logo de Track your visits" id='logoNavbar' />
                </a>
                <a href="../index.php" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">Menu</i></a>
                <ul class="right hide-on-med-and-down">
                    <li><a href="sass.html" class="boldText">Sass</a></li>
                    <li><a href="badges.html" class="boldText">Components</a></li>
                    <li><a href="views/registerUserForm.php" class="boldText">Inscription</a></li>
                    <li><a href="views/connexion.php" class="boldText">Connexion</a></li>
                </ul>
            </div>
        </nav>
        <!--Affichage du menu de navigation en responsive-->
        <ul class="sidenav" id="mobile-demo">
            <li><a href="sass.html">Sass</a></li>
            <li><a href="badges.html">Components</a></li>
            <li><a href="views/registerUserForm.php">Inscription</a></li>
            <li><a href="views/connexion.php">Connexion</a></li>
        </ul>
        <p>
            Le Chien (Canis lupus familiaris) est la sous-espèce domestique de Canis lupus, un mammifère de la famille 
            des Canidés (Canidae), laquelle comprend également le Loup gris et le dingo, chien domestique redevenu sauvage.
            Le Loup est la première espèce animale à avoir été domestiquée par l'Homme pour l'usage de la chasse dans une société
            humaine paléolithique qui ne maitrise alors ni l'agriculture ni l'élevage. La lignée du Chien s'est différenciée génétiquement de celle 
            du Loup gris il y a environ 100 000 ans1, et les plus anciens restes confirmés de canidé différencié de la lignée du Loup sont vieux, selon les sources, 
            de 33 000 ans2,3 ou de 12 000 ans4, donc antérieurs de plusieurs dizaines de milliers d'années à ceux de toute autre espèce domestique connue. 
            Depuis la Préhistoire, le Chien a accompagné l'être humain durant toute sa phase de sédentarisation, marquée par l'apparition des premières 
            civilisations agricoles. C'est à ce moment qu'il a acquis la capacité de digérer l'amidon5, et que ses fonctions d'auxiliaire d'Homo sapiens se sont 
            étendues. Ces nouvelles fonctions ont entrainé une différenciation accrue de la sous-espèce et l'apparition progressive de races canines identifiables. 
            Le Chien est aujourd'hui utilisé à la fois comme animal de travail et comme animal de compagnie. Son instinct de meute, sa domestication 
            précoce et les caractéristiques comportementales qui en découlent lui valent familièrement le surnom de « meilleur ami de l'Homme ».
            Cette place particulière dans la société humaine a conduit à l'élaboration d'une règlementation spécifique. Ainsi, là où les critères de la 
            Fédération cynologique internationale ont une reconnaissance légale, l'appellation chien de race est conditionnée à l'enregistrement du
            chien dans les livres des origines de son pays de naissance7,8. Selon le pays, des vaccins peuvent être obligatoires et certains types de chien, 
            jugés dangereux, sont soumis à des restrictions. Le Chien est généralement soumis aux différentes législations sur les carnivores domestiques. 
            C'est notamment le cas en Europe, où sa circulation est facilitée grâce à l'instauration du passeport européen pour animal de compagnie. 
        </p>
        <p>
            Le Chien (Canis lupus familiaris) est la sous-espèce domestique de Canis lupus, un mammifère de la famille 
            des Canidés (Canidae), laquelle comprend également le Loup gris et le dingo, chien domestique redevenu sauvage.
            Le Loup est la première espèce animale à avoir été domestiquée par l'Homme pour l'usage de la chasse dans une société
            humaine paléolithique qui ne maitrise alors ni l'agriculture ni l'élevage. La lignée du Chien s'est différenciée génétiquement de celle 
            du Loup gris il y a environ 100 000 ans1, et les plus anciens restes confirmés de canidé différencié de la lignée du Loup sont vieux, selon les sources, 
            de 33 000 ans2,3 ou de 12 000 ans4, donc antérieurs de plusieurs dizaines de milliers d'années à ceux de toute autre espèce domestique connue. 
            Depuis la Préhistoire, le Chien a accompagné l'être humain durant toute sa phase de sédentarisation, marquée par l'apparition des premières 
            civilisations agricoles. C'est à ce moment qu'il a acquis la capacité de digérer l'amidon5, et que ses fonctions d'auxiliaire d'Homo sapiens se sont 
            étendues. Ces nouvelles fonctions ont entrainé une différenciation accrue de la sous-espèce et l'apparition progressive de races canines identifiables. 
            Le Chien est aujourd'hui utilisé à la fois comme animal de travail et comme animal de compagnie. Son instinct de meute, sa domestication 
            précoce et les caractéristiques comportementales qui en découlent lui valent familièrement le surnom de « meilleur ami de l'Homme ».
            Cette place particulière dans la société humaine a conduit à l'élaboration d'une règlementation spécifique. Ainsi, là où les critères de la 
            Fédération cynologique internationale ont une reconnaissance légale, l'appellation chien de race est conditionnée à l'enregistrement du
            chien dans les livres des origines de son pays de naissance7,8. Selon le pays, des vaccins peuvent être obligatoires et certains types de chien, 
            jugés dangereux, sont soumis à des restrictions. Le Chien est généralement soumis aux différentes législations sur les carnivores domestiques. 
            C'est notamment le cas en Europe, où sa circulation est facilitée grâce à l'instauration du passeport européen pour animal de compagnie. 
        </p>
        <p>
            Le Chien (Canis lupus familiaris) est la sous-espèce domestique de Canis lupus, un mammifère de la famille 
            des Canidés (Canidae), laquelle comprend également le Loup gris et le dingo, chien domestique redevenu sauvage.
            Le Loup est la première espèce animale à avoir été domestiquée par l'Homme pour l'usage de la chasse dans une société
            humaine paléolithique qui ne maitrise alors ni l'agriculture ni l'élevage. La lignée du Chien s'est différenciée génétiquement de celle 
            du Loup gris il y a environ 100 000 ans1, et les plus anciens restes confirmés de canidé différencié de la lignée du Loup sont vieux, selon les sources, 
            de 33 000 ans2,3 ou de 12 000 ans4, donc antérieurs de plusieurs dizaines de milliers d'années à ceux de toute autre espèce domestique connue. 
            Depuis la Préhistoire, le Chien a accompagné l'être humain durant toute sa phase de sédentarisation, marquée par l'apparition des premières 
            civilisations agricoles. C'est à ce moment qu'il a acquis la capacité de digérer l'amidon5, et que ses fonctions d'auxiliaire d'Homo sapiens se sont 
            étendues. Ces nouvelles fonctions ont entrainé une différenciation accrue de la sous-espèce et l'apparition progressive de races canines identifiables. 
            Le Chien est aujourd'hui utilisé à la fois comme animal de travail et comme animal de compagnie. Son instinct de meute, sa domestication 
            précoce et les caractéristiques comportementales qui en découlent lui valent familièrement le surnom de « meilleur ami de l'Homme ».
            Cette place particulière dans la société humaine a conduit à l'élaboration d'une règlementation spécifique. Ainsi, là où les critères de la 
            Fédération cynologique internationale ont une reconnaissance légale, l'appellation chien de race est conditionnée à l'enregistrement du
            chien dans les livres des origines de son pays de naissance7,8. Selon le pays, des vaccins peuvent être obligatoires et certains types de chien, 
            jugés dangereux, sont soumis à des restrictions. Le Chien est généralement soumis aux différentes législations sur les carnivores domestiques. 
            C'est notamment le cas en Europe, où sa circulation est facilitée grâce à l'instauration du passeport européen pour animal de compagnie. 
        </p>
        <p>
            Le Chien (Canis lupus familiaris) est la sous-espèce domestique de Canis lupus, un mammifère de la famille 
            des Canidés (Canidae), laquelle comprend également le Loup gris et le dingo, chien domestique redevenu sauvage.
            Le Loup est la première espèce animale à avoir été domestiquée par l'Homme pour l'usage de la chasse dans une société
            humaine paléolithique qui ne maitrise alors ni l'agriculture ni l'élevage. La lignée du Chien s'est différenciée génétiquement de celle 
            du Loup gris il y a environ 100 000 ans1, et les plus anciens restes confirmés de canidé différencié de la lignée du Loup sont vieux, selon les sources, 
            de 33 000 ans2,3 ou de 12 000 ans4, donc antérieurs de plusieurs dizaines de milliers d'années à ceux de toute autre espèce domestique connue. 
            Depuis la Préhistoire, le Chien a accompagné l'être humain durant toute sa phase de sédentarisation, marquée par l'apparition des premières 
            civilisations agricoles. C'est à ce moment qu'il a acquis la capacité de digérer l'amidon5, et que ses fonctions d'auxiliaire d'Homo sapiens se sont 
            étendues. Ces nouvelles fonctions ont entrainé une différenciation accrue de la sous-espèce et l'apparition progressive de races canines identifiables. 
            Le Chien est aujourd'hui utilisé à la fois comme animal de travail et comme animal de compagnie. Son instinct de meute, sa domestication 
            précoce et les caractéristiques comportementales qui en découlent lui valent familièrement le surnom de « meilleur ami de l'Homme ».
            Cette place particulière dans la société humaine a conduit à l'élaboration d'une règlementation spécifique. Ainsi, là où les critères de la 
            Fédération cynologique internationale ont une reconnaissance légale, l'appellation chien de race est conditionnée à l'enregistrement du
            chien dans les livres des origines de son pays de naissance7,8. Selon le pays, des vaccins peuvent être obligatoires et certains types de chien, 
            jugés dangereux, sont soumis à des restrictions. Le Chien est généralement soumis aux différentes législations sur les carnivores domestiques. 
            C'est notamment le cas en Europe, où sa circulation est facilitée grâce à l'instauration du passeport européen pour animal de compagnie. 
        </p>
        <footer class="page-footer deep-orange lighten-2">
            <div class="container">
                <div class="row">
                    <div class="col l6 s12">
                        <h5 class="white-text">Footer Content</h5>
                        <p class="grey-text text-lighten-4">You can use rows and columns here to organize your footer content.</p>
                    </div>
                    <div class="col l4 offset-l2 s12">
                        <h5 class="white-text">Links</h5>
                        <ul>
                            <li><a class="grey-text text-lighten-3" href="#">Link 1</a></li>
                            <li><a class="grey-text text-lighten-3" href="#">Link 2</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="footer-copyright">
                <div class="container">
                    © 2018 Copyright Text
                    <a class="grey-text text-lighten-4 right" href="#">More Links</a>
                </div>
            </div>
        </footer>
    </body>
</html>