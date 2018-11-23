<?php
//insertion du fichier path, du header
include_once 'classes/path.php';
include_once path::getRootPath() . 'header.php';
?>
<div class="container-fluid white">
    <h2 class="center-align">Inscription d'un nouvel utilisateur</h2>
    <div class="row center-align">
        <div class="col m5 offset-m1 s6">
            <div class="card">
                <div class="card-image">
                    <img src="assets/img/2.jpg" title="" alt="" />
                </div>
                <div class="card-content">
                    <p class="cardTitle">Visiteur</p>
                    <p>Vous cherchez un lieu à visiter</p>
                </div>
                <div class="card-action">
                    <a href="Inscription-visiteur" class="userChoiceButton btn waves-effect waves-light lime darken-3" title="Lien vers la page d'inscription d'un visiteur">Cliquer ici</a>
                </div>
            </div>
        </div> 
        <div class="col m5 s6">
            <div class="card">
                <div class="card-image">
                    <img src="assets/img/4.jpg" title="" alt="" />
                </div>
                <div class="card-content">
                    <p class="cardTitle">Contributeur</p>
                    <p>Vous souhaitez ajouter un site touristique</p>
                </div>
                <div class="card-action">
                    <a href="Inscription-contributeur" class="userChoiceButton btn waves-effect waves-light lime darken-3" title="Lien vers la page d'inscription d'un contributeur">Cliquer ici</a>
                </div>
            </div>
        </div> 
    </div>
</div>
<?php
//insertion du footer
include_once path::getRootPath() . 'footer.php';
?>