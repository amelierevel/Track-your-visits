//script materialize
$(document).ready(function () {
    $('.sidenav').sidenav();    //pour l'affichage du menu de navigation en responsive
    $(".dropdown-trigger").dropdown();  //pour l'affichage du dropdown de la barre de navigation
    $('select').formSelect();  //pour l'affichage du select du formulaire d'inscription utilisateur
    $('.modal').modal();    //pour l'affichage de la modal pour la connexion dans la barre de navigation
});

//script permettant l'effet sticky-top de la barre de navigation
$(window).scroll(function (event) {
    //récupération de la valeur du scroll vertical lorsque l'utilisateur réalise l'action scroll
    var scroll = $(this).scrollTop();
    //condition ajoutant la class fixed à la barre de navigation lorsque la valeur du scoll est supérieure ou égale 300px (hauteur du header)
    if (scroll >= 300) {
        $('nav').addClass('fixed');
    } else {
        //sinon on enlève la class fixed
        $('nav').removeClass('fixed');
    }
});
