<?php
//insertion du fichier path et du header
include_once 'classes/path.php';
include_once path::getRootPath() . 'header.php';
?>
<div class="center-align">
    <h2 id="textPageNotFound">Page non trouvée</h2>
    <img src="assets/img/erreur-404-1.png" title="Image d'erreur 404" alt="Image représentant une erreur 404" class="responsive-img" id="imgError404"/>
    <p>Nous avons cherché votre page partout. Mais il y a peut-être encore une chance de trouver ce que vous cherchez : </p>
    <ul>
        <li><a href="Accueil">Revenez à la page d'accueil du site</a></li>
        <li><a href="Contact">Contactez l'assistance</a></li>
    </ul>
</div>
<?php 
//insertion du footer
include path::getRootPath() . 'footer.php'; 
?>

