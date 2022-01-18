$(function(){

    $('[data-accept]').click(function(e){
        e.preventDefault();

        // Get route on div form
        console.log($('[data-accept]'));

        // get intern assignment id and route from view
        let id = $(this).data('accept');
        let route = $(this).data('route');

        $.ajax({
            type: 'GET',
            url: route,
            data: {
                'id': id,
            },
            dataType: "json",
            cache: false,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            },

            beforeSend: function (){
                // Hide favorite button
                $('#submit-container').fadeOut(200);

                // Show spinner
                let loader = '<div class="text-center mg-b-20">' +
                    '<div class="spinner-border text-success" role="status">' +
                    '<span class="sr-only">Loading...</span>' +
                    '</div>' + '</div>'
                $('#loader').html(loader);
            },

            success:function (Response){
                console.log(Response);

                if(Response.success){
                    $('#loader').html('<button class="na-btn-disabled">Approved</button>');
                    $('#badge-status').removeClass('badge-danger').addClass('badge-success');
                    $('#badge-status').html('Approved');
                }
            },

            error: function (Response) {
                console.log(Response.responseText);
                $('#loader').html('Error occurred, reload page or contact the admin');
            }

        });
    });

    $('[data-delete]').click(function(e){
        e.preventDefault();

        // Get route on div form
        console.log($('[data-delete]'));

        // get intern assignment id and route from view
        let id = $(this).data('delete');
        let route = $(this).data('route');

        $.ajax({
            type: 'GET',
            url: route,
            data: {
                'id': id,
            },
            dataType: "json",
            cache: false,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            },

            beforeSend: function (){
                // Hide favorite button
                $('#submit-container').fadeOut(200);

                // Show spinner
                let loader = '<div class="text-center mg-b-20">' +
                    '<div class="spinner-border text-success" role="status">' +
                    '<span class="sr-only">Loading...</span>' +
                    '</div>' + '</div>'
                $('#loader').html(loader);
            },

            success:function (Response){
                console.log(Response);

                if(Response.success){
                    $('#row'+id).fadeOut(500);
                }
            },

            error: function (Response) {
                console.log(Response.responseText);
                $('#loader').html('Error occurred, reload page or contact the admin');
            }

        });
    });

});
