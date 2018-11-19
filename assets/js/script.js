$(document).ready(function () {
//--------script pour materialize-------------------
    $('.sidenav').sidenav();    //pour l'affichage du menu de navigation en responsive
    $(".dropdown-trigger").dropdown();  //pour l'affichage du dropdown de la barre de navigation
    $('select').formSelect();  //pour l'affichage du select du formulaire d'inscription utilisateur
    $('.modal').modal();    //pour l'affichage de la modal pour la connexion dans la barre de navigation
    $('.collapsible').collapsible();
});