$(document).ready(function () {
    $('#postalCode').bind('input', function () {
        $.ajax({
            url: 'ajax/citiesAjax.php', //ressource ciblée: controller ajax
            type: 'POST', //le type de la requête
            data: {
                idCity: $('#').val(),
                postalCode: $('#').val(),
                value: $(this).val()
            },
//            contentType: false,
//            cache: false,
//            processData: false,
            dataType: 'json', //le type de données à recevoir
            postalCodeSearch: $('#postalCode').val(),
            success: function (cities) {
                console.log(data['success']);
                //s'il n'y a pas d'erreur
                if (data['successFindCities'] === true) {
                    if (cities !== '') {
                        $('#citySelect').empty();
                        $('#citySelect').append('<option value="0" selected disabled>Ville</option>');
                        $.each(cities, function (cityKey, city) {
                            $('#citySelect').append('<option value="' + city.id + '"pCode="' + city.postalCode + '" >' + city.city + '</option>');
                        });
                    }
                } else {
                    //affichage du message d'erreur
                    $('#errorMessage').show();
                }
            }
        });
    });
    $('#citySelect').change(function () {
        $('#postalCode').val($('#citySelect option:selected').attr('pCode'));
    });
});




//code de fabien:
//$(function () {
//  $('#postalCode').bind('input', function () {
//        $.post('../../controllers/registerCtrl.php', {
//            postalSearch: $('#postalCode').val()
//        }, function (cities) {
//            if (cities !== '') {
//                $('#citySelect').empty();
//                $('#citySelect').append('<option selected disabled name="0" value="0">Votre ville</option>');
//               $.each(cities, function (cityKey, city) {
//                    $('#citySelect').append('<option value="' + city.id + '" zipCode="' + city.postalCode + '">' + city.city + '</option>');
//                });
//            }
//        },
//                'JSON');
//    });
//    $('#citySelect').change(function () {
//        $('#postalCode').val($('#citySelect option:selected').attr('zipcode'));
//    });
//});