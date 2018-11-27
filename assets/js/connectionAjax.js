$(document).ready(function () {
    //----------------script pour masquer le mot de passe dans l'input de la modal pour la connexion
    //initialisation d'une chaine de caractères vide
    var key = '';
    //déclaration de la fonction permettant la transformation des caractères tapés par l'utilisateur
    $('#password').keypress(function (e) {
        //e.preventDefault() bloque l'actualisation de la page
        e.preventDefault();
        //si la longueur de la touche appuyée = 1 (ex: touche suppr = backspace = 9 lettres)
        if (e.key.length == 1) {
            //la variable key prend la valeur de la touche appuyée (key =  '' + la touche appuyée)
            key = key + e.key;
            //transformation de la valeur de key en •
            $(this).val($(this).val() + '•');
            //si on appuie sur la touche de suppression (backspace) on supprime le caractère (en attribuant la valeur de key moins 1 caractère, le dernier ajouté)
        } else if (e.key == 'Backspace') {
            key = key.slice(0, -1);
            //réattribution de la nouvelle valeur 
            $(this).val($(this).val().slice(0, -1));
        }
    });
    //-----------------script pour la connexion de l'utilisateur dans la modal
    //on cache le message d'erreur
    $('#errorMessage').hide();
    //déclaration de la fonction permettant la connexion de l'utilisateur 
    $('#connectionForm').on('submit', function (e) {
        //e.preventDefault() bloque la fermeture de la modal
        e.preventDefault();
        //appel ajax 
        $.ajax({
            //définition des paramètres
            url: 'ajax/connectionAjax.php', //chemin vers le controller ajax
            type: 'POST', //le type de la requête
            data: {
                password: key,  //mot de passe entré par l'utilisateur 
                username: $('#username').val()  //valeur de l'input username
            },
            dataType: 'json', //le type de données à recevoir
            //fonction si la requête s'exécute
            success: function (data) {
                //s'il n'y a pas d'erreur
                if (data['successConnection'] == true) {
                    //fermeture de la fenêtre modale
                    $('#connectionModal').modal('close');
                    //redirection vers la page d'accueil
                    document.location.href = 'Profil';
                } else {
                    //affichage du message d'erreur
                    $('#errorMessage').show();
                }
            }
        });
    });
});

