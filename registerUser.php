<?php
//insertion du fichier path, du header
include_once 'classes/path.php';
include_once path::getRootPath() . 'header.php';
?>
<div class="container-fluid white">
    <h2 class="center-align">Inscription d'un nouvel utilisateur</h2>
    <div id="userCategoryChoice">
        <div class="row center-align">
            <div class="col s6">
                <h3>Visiteur</h3>
                <p>Vous cherchez un lieu à visiter</p>
                <a href="Inscription-visiteur" class="userChoiceButton btn waves-effect waves-light lime darken-3" title="">Cliquer ici</a>
            </div>
            <div class="col s6">
                <h3>Contributeur</h3>
                <p>Vous souhaitez ajouter un site touristique</p>
                <a href="Inscription-contributeur" class="userChoiceButton btn waves-effect waves-light lime darken-3" title="">Cliquer ici</a>
            </div>
        </div>
    </div>
</div>
<?php
//insertion du footer
include_once path::getRootPath() . 'footer.php';
?>