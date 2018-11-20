$(document).ready(function () {
//--------script pour materialize-------------------
    $('.sidenav').sidenav();    //pour l'affichage du menu de navigation en responsive
    $(".dropdown-trigger").dropdown();  //pour l'affichage du dropdown de la barre de navigation
    $('select').formSelect();  //pour l'affichage du select du formulaire d'inscription utilisateur
    $('.modal').modal();    //pour l'affichage de la modal pour la connexion dans la barre de navigation
    $('.collapsible').collapsible();
    
    //----------va peut être disparaitre
    //function permettant de cloner les lignes pour l'ajout des horaires et masquer le bouton pour le clonage
    $('#addTimetableLign').click(function(){
        $('.timetableLign').clone().appendTo('#newTimetableAfter');
        $('#addTimetableLign').hide();
    });
    //--------------
    //on masque le formulaire d'ajout d'horaire de la page getAPlace
    $('#timetableForm').hide();
    //fonction permettant l'affichage au click du formulaire d'ajout d'horaire de la page getAPlace
    $('#addTimetableButton').click(function(){
        $('#timetableForm').show();
    });
    //on masque le formulaire d'ajout d'un tarif de la page getAPlace
    $('#pricesForm').hide();
    //fonction permettant l'affichage au click du formulaire d'ajout d'horaire de la page getAPlace
    $('#addPriceButton').click(function(){
        $('#pricesForm').show();
    });
});