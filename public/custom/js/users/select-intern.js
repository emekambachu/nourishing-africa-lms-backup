$(function(){

    $('[data-submit]').click(function(e){
        e.preventDefault();

        // Get route on div form
        console.log($('[data-submit]'));

        let userId = $(this).data('user');
        let route = $(this).data('route');

        $.ajax({
            type: 'GET',
            url: route,
            data: {
                'user': userId,
            },
            dataType: "json",
            cache: false,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            },

            beforeSend: function (){
                // Hide favorite button
                $('#submit-form').fadeOut(200);

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
                    $('#loader').html("<p class='p-1 bg-success text-white text-center'>You just selected this intern for hire, once approved by the institution you will get an email notification on your next steps</p>");
                    $('#submit-form').fadeIn(200);
                    $('#submit-btn').removeClass();
                    $('#submit-btn').addClass('na-intern-form-btn-danger');
                    $('#submit-btn').html('Withdraw Request');
                }

                if(Response.cancelled){
                    $('#loader').html("<p class='p-1 bg-danger text-white text-center'>You cancelled the request to hire this intern</p>");
                    $('#submit-form').fadeIn(200);
                    $('#submit-btn').removeClass();
                    $('#submit-btn').addClass('na-intern-form-btn');
                    $('#submit-btn').html('Hire');
                }
            },

            error: function (Response) {
                console.log(Response.responseText);
                $('#loader').html('Error occurred, reload page or contact the admin');
            }

        });
    });

});
