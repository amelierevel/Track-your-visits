<?php
//insertion du fichier path et du header
include_once 'classes/path.php';
include_once path::getRootPath() . 'header.php';
?>
<div class="bgText container z-depth-3">
    <h2 class="center-align" id="textError404">ERREUR 404</h2>
    <p class="center-align" id="textPageNotFound">Page non trouvée</p>
</div>
<?php 
//insertion du footer
include path::getRootPath() . 'footer.php'; 
?>

