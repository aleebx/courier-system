$(document).ready(function() {
    $('#departamento_id').on('change', function () {
        var id = $(this).val();

        if (id) {
            $.ajax({
                url: '/obtenerProvincia/' + id,
                type: 'GET',
                dataType: 'json',
                success: function (data) {
                    $('#provincia_id').empty();
                    $('#provincia_id').append('<option value="">Selecciona una Provincia</option>');
                    $.each(data, function (key, value) {
                        $('#provincia_id').append('<option value="' + value.id + '">' + value.name + '</option>');
                    });
                }
            });
        } else {
            $('#provincia_id').empty();
            $('#provincia_id').append('<option value="">Selecciona una Provincia</option>');
        }
    });
    $('#provincia_id').on('change', function () {
        var id = $(this).val();

        if (id) {
            $.ajax({
                url: '/obtenerDistrito/' + id,
                type: 'GET',
                dataType: 'json',
                success: function (data) {
                    $('#distrito_id').empty();
                    $('#distrito_id').append('<option value="">Selecciona un distrito </option>');
                    $.each(data, function (key, value) {
                        $('#distrito_id').append('<option value="' + value.id + '">' + value.name + ' - S/ '+ value.tarifa +'</option>');
                    });
                }
            });
        } else {
            $('#distrito_id').empty();
            $('#distrito_id').append('<option value="">Selecciona un distrito </option>');
        }
    });
} );