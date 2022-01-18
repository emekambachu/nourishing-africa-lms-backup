$(function() {

    $('#submit-questionnaire').submit(function (e) {
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

            beforeSend: function () {
                // Hide favorite button
                $('#submit-questionnaire').fadeOut(200);

                // Show spinner
                $('#loader').fadeIn(200);
                $('#loader').append("<p class='text-center'>Loading......Please wait</p>");
            },

            success: function (response) {
                console.log(response);

                if (response.success) {
                    $('#loader').html("<p class='p-1 bg-success text-white text-center'>" +
                        "Completed! Thank you for takng the time to fill out this survey</p>");
                }

                if (response.errors) {
                    $.each(response.errors, function(key, value) {
                        $('#loader').html("");
                        $('#loader').append("<p class='p-1 bg-danger text-white text-center'>"+value+"</p>");
                    });
                }
            },

            error: function (Response) {
                console.log(Response.responseText);
                $('#loader').html("<p class='p-1 bg-danger text-white text-center'>" +
                    "An error occured, reload this page or contact info@nourishingafrica.com</p>");
            }

        });
    });

});
