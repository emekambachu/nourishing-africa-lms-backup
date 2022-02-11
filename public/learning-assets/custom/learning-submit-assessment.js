$(function() {

    $('#submit-form').submit(function (e) {
        e.preventDefault();

        console.log('Submitting....');

        // Get route on div form
        let route = $(this).data('route');
        // get all form data and create an instance
        let formData = new FormData(this);

        $.ajax({
            type: 'Post',
            url: route,
            data: formData,
            processData: false,
            contentType: false,
            cache: false,
            dataType: "json",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            },

            beforeSend: function (){
                // Hide form
                $('#questions-container').fadeOut(200);
                // Show spinner
                $('.assessment-loader').fadeIn(200);
                $('.assessment-loader').removeClass('d-none');
                // $('#loader').append("<i class='fa fa-spinner fa-spin fa-4x na-text-dark-green text-center'></i>");
                $('#loader').append("<p class='text-center d-flex'>Getting your score, wait a moment.......</p>");
            },

            success: function (response){
                console.log(response);
                if (response.success) {
                    $('#loader').html("<h1 class='na-text-dark-green tx-100 text-center'>" + response.percent + "</h1><br>");
                    $('#loader').append("<p class='text-center'>" + response.comment + "</p>");
                    let moduleBtn = '<a href="/yaedp/account/modules">\n' +
                        '        <button style="width: 200px;" class="module-btn bg-light-brown d-flex justify-content-center mt-2">\n' +
                        '            Modules</button>\n' +
                        '</a>'
                    $('#questions-container').after(moduleBtn);
                }

                if (response.errors){
                    $.each(response.errors, function(key, value) {
                        $('#loader').html("");
                        $('#loader').append("<p class='p-1 bg-danger text-white text-center'>"+value+"</p>");
                        // Show form
                        $('#questions-container').fadeIn(200);
                    });
                }
            },

            error: function (Response) {
                console.log(Response.responseText);
                $('#loader').html("<p class='p-1 bg-danger text-white text-center'>" +
                    "An error occurred, reload this page or contact yaedp@nourishingafrica.com</p>");
                // Show form
                $('#questions-container').fadeIn(200);
            }

        });
    });

});
