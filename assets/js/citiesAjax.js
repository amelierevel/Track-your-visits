$(document).ready(function () {
    $(function () { 
        $('#postalCode').keyup(function (e) {
            //e.preventDefault() empêche la page de se réactualisée
            e.preventDefault();
            //vérification que la valeur du champ postalCode est supérieure ou égale à 3 caractères
            if ($('#postalCode').val().length >= 3) {
                //appel ajax 
                $.ajax({
                    //définition des paramètres
                    url: 'ajax/citiesAjax.php', //chemin vers le controller ajax
                    type: 'POST', //le type de la requête
                    data: {
                        postalCode: $('#postalCode').val() //valeur du champ postalCode
                    },
                    dataType: 'json', //le type de données à recevoir
                    //fonction si la requête s'exécute
                    success: function (city) {
                        $('#idCities').empty(); //on vide le champ idCities
                        //fonction permettant l'ajout d'une option (html) avec le nom de la ville et son id pour chaque valeur retournée par la méthode
                        $.each(city, function(id, cityValue){ 
                            $('#idCities').append('<option value="'+ cityValue['id'] +'">' + cityValue['city'] + ' ' + '</option>')
                        });
                        $('#idCities').formSelect(); //permet d'éviter les conflits avec materialize (sans cette ligne l'ajax ne fonctionne pas)
                    }
                });
            }
        });
    });
});
