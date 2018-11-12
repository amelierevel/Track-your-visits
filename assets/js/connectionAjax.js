$(document).ready(function () {
    //on initialise une chaine de caractères vide parce que c'est cool
    var key = '';
    $('#password').keypress(function (e) {
        //pour pas que ca actualise la page (?)
        e.preventDefault();
        //la touche appuyé doit etre = 1 (touche suppr = backspace = pleins de lettres)
        if (e.key.length == 1) {
            //key =  chaine de K vide + la touche appuyée
            key = key + e.key;
            //on donne la valeur • à key
            $(this).val($(this).val() + '•');
            //on fait que qd on click sur touche suppr ça suppr 
        } else if (e.key == 'Backspace') {
            key = key.slice(0, -1);
            //on redonne la nouvelle val avec le K suppr à key
            $(this).val($(this).val().slice(0, -1));
        }
    });
    //on cache le message d'erreur
    $('#errorMessage').hide();
    $('#connectionForm').on('submit', function (e) {
        //pour éviter que la modale se referme normalement (à vérifier?)
        e.preventDefault();
        //appel (ouverture) ajax 
        $.ajax({
            //on définit les paramètres
            url: 'ajax/connectionAjax.php', //chemin vers le controller ajax
            type: 'POST', //le type de la requête
            data: {
                password: key,
                username: $('#username').val()
            },
            dataType: 'json', //le type de données à recevoir
            //si la requête s'exécute
            success: function (data) {
                //s'il n'y a pas d'erreur
                if (data['successConnection'] == true) {
                    //fermeture de la fenêtre modale
                    $('#connectionModal').modal('close');
                    //redirection vers la page d'accueil
                    document.location.href = 'index.php';
                } else {
                    //affichage du message d'erreur
                    $('#errorMessage').show();
                }
            }
        });
    });
});

