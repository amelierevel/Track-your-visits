<?php

// Définition des informations de connexion à la base de données
define('HOST', 'localhost');
define('DBNAME', 'trackYourVisits');
define('LOGIN', 'newUser');
define('PASSWORD', '123');

// Ajout des fichiers nécessaires au bon fonctionnement du site
include_once 'models/database.php';
include_once 'models/users.php';
include_once 'models/userType.php';
