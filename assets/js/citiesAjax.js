$(document).ready(function () {
    $(function () {
        $('#postalCode').keyup(function (e) {
            e.preventDefault();
            if ($('#postalCode').val().length >= 3) {
                //appel ajax 
                $.ajax({
                    //on définit les paramètres
                    url: 'ajax/citiesAjax.php', //chemin vers le controller ajax
                    type: 'POST', //le type de la requête
                    data: {
                        postalCode: $('#postalCode').val()
                    },
                    dataType: 'json', //le type de données à recevoir
                    //fonction si la requête s'exécute
                    success: function (city) {
                        $('#idCities').empty();
                        $.each(city, function(id, cityValue){
                            $('#idCities').append('<option value="'+ cityValue['id'] +'">' + cityValue['city'] + ' ' + '</option>')
                        });
                        $('#idCities').formSelect();
                    }
                });
            }
        });
    });
});
