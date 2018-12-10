$(document).ready(function () {
//--------script pour materialize-------------------
    $('.sidenav').sidenav();    //pour l'affichage du menu de navigation en responsive
    $(".dropdown-trigger").dropdown();  //pour l'affichage du dropdown de la barre de navigation
    $('select').formSelect();  //pour l'affichage du select du formulaire d'inscription utilisateur
    $('.modal').modal();    //pour l'affichage de la modal pour la connexion dans la barre de navigation
    $('textarea#priceName').characterCounter(); //pour le calcul du nombre de caractères

//fonction permettant de confirmer ou d'annuler la suppression au clic sur le bouton de suppression
    $('.deleteButton').click(function () {
        var conf = confirm('Voulez-vous vraiment supprimer ?');
        if (conf == true) {
            return true;
        } else {
            return false;
        }
    });
    //on masque le formulaire d'ajout de photo de la page getAPlace
    $('#addPictureForm').hide();
    //fonction permettant l'affichage au clic du formulaire d'ajout de photo de la page getAPlace
    $('#addPictureFormButton').click(function () {
        $('#addPictureForm').show();
    });
});