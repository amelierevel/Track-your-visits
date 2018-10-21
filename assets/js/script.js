//script pour l'affichage du menu de navigation en responsive
$(document).ready(function () {
    $('.sidenav').sidenav();
});

//script permettant l'effet sticky-top de la barre de navigation
$(window).scroll(function (event) {
    //récupération de la valeur du scroll vertical lorsque l'utilisateur réalise l'action scroll
    var scroll = $(this).scrollTop(); 
    //condition ajoutant la class fixed à la barre de navigation lorsque la valeur du scoll est supérieure ou égale 300px (hauteur du header)
    if (scroll >= 300){
      $('nav').addClass('fixed');
    } else {
      //sinon on enlève la class fixed
      $('nav').removeClass('fixed');
    }
  });
  
  //script permettant l'affichage du select du formulaire d'inscription utilisateur
  $(document).ready(function(){
    $('select').formSelect();
  });