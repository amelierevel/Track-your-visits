<?php
//insertion du fichier path, du header
include_once 'classes/path.php';
include_once path::getRootPath() . 'header.php';
?>
<div class="white">
    <h2 class="center-align">Inscription d'un nouvel utilisateur</h2>
    <div class="row center-align">
        <div class="col m5 offset-m1 s12">
            <div class="card">
                <div class="card-image">
                    <img src="assets/img/visitorCard.jpg" alt="Image représentant une carte avec des punaises" title="Image visiteur" />
                </div>
                <div class="card-content">
                    <p class="cardTitle">Visiteur</p>
                    <p>Vous cherchez un lieu à visiter.</p>
                    <p>Vous voulez enregistrer des lieux à voir ou ceux que vous avez déjà visité.</p>
                </div>
                <div class="card-action">
                    <a href="Inscription-visiteur" class="btn waves-effect waves-light lime darken-3" title="Lien vers la page d'inscription d'un visiteur">Cliquer ici</a>
                </div>
            </div>
        </div> 
        <div class="col m5 s12">
            <div class="card">
                <div class="card-image">
                    <img src="assets/img/contributorCard.jpg" alt="Image représentant le château de Pierrefonds" title="Image contributeur" />
                </div>
                <div class="card-content">
                    <p class="cardTitle">Contributeur</p>
                    <p>Vous êtes un professionnel ou un particulier engagé.</p>
                    <p>Vous souhaitez ajouter un nouveau lieu.</p>
                </div>
                <div class="card-action">
                    <a href="Inscription-contributeur" class="btn waves-effect waves-light lime darken-3" title="Lien vers la page d'inscription d'un contributeur">Cliquer ici</a>
                </div>
            </div>
        </div> 
    </div>
</div>
<?php
//insertion du footer
include_once path::getRootPath() . 'footer.php';
?>