$(document).ready(function () {
    //on cache le message d'erreur
    $('#errorMessage').hide();
    $('#connectionForm').on('submit', function (e) {
        //pour éviter que la modale se referme normalement (à vérifier?)
        e.preventDefault();
        //appel (ouverture) ajax 
        $.ajax({
            //on définit les paramètres
            url: 'ajax/connectionAjax.php', //chemin vers le controller
            type: 'POST', //le type de la requête
            data: new FormData(this), //les données transmises/qu'on analyse (à vérifier?)
            contentType: false, //Le type de contenu utilisé lors de l'envoi de données au serveur
            cache: false, //Impossible de demander la mise en cache des pages
            processData: false, //
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

