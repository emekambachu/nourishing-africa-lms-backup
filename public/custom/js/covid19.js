
$(document).ready(function() {

    $('#covid-experience-form').submit(function (e) {
        let route = $('#covid-experience-form').data('route');
        e.preventDefault();
        // let form_data = $(this);
        $('.alert').remove();
        $.ajax({
            type: 'POST',
            url: route,
            data: $(this).serialize(),
            dataType: "json",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            },
            beforeSend: function () {
                // disable submission button and form field
                $('#covid-experience-button').attr("disabled", "disabled");
                // make form transparent
                // $('#covid-experience-form').css("opacity",".3");
                $('#form-fields').fadeOut('1000');
                // Show image container
                $("#loader").show();
            },
            success: function (Response) {
                console.log(Response);
                if (Response.success) {
                    $('#status').append(
                        '<div class="alert alert-success alert-dismissable" style="width: 60%; margin: 0 auto; padding: 10px;">'
                        + Response.success +
                        '</div>'
                    );
                    //clear all fields after submission
                    $("#covid-experience-form")[0].reset();
                }
            },
            error: function (Response) {
                $('#status').html('');
                $.each(Response.responseJSON.errors, function(key,value) {
                    $('#status').append('<div class="alert alert-danger alert-dismissable">'+value+'</div');
                });
            },
            complete: function (Response) {
                //after submission return opacity
                // $('#covid-experience-form').css("opacity","");
                $('#form-fields').fadeIn('1000');

                // Show image container
                $("#loader").hide();

                //after submission remove disabled attribute
                $("#covid-experience-button").removeAttr("disabled");
            }
        });
        e.preventDefault();
    });

    $('#select-resource').on('change', function () {

        // assign variable to the selected value of select_method id
        let selected = $('#select-resource').find(":selected").val()

        // All
        if (selected === 'all') {
            // Show show these divs
            $("#all").fadeIn();

            // Hide Div
            $("#report").fadeOut();
            $("#articles").fadeOut();
            $("#tools").fadeOut();
        }

        // Report
        if (selected === 'report') {
            // Show show these divs
            $("#report").fadeIn();

            // Hide Div
            $("#all").fadeOut();
            $("#articles").fadeOut();
            $("#tools").fadeOut();
        }

        // Articles
        if (selected === 'articles') {
            // Show these divs
            $("#articles").fadeIn();

            // Hide Div
            $("#all").fadeOut();
            $("#report").fadeOut();
            $("#tools").fadeOut();
        }

        // Tools
        if (selected === 'tools') {
            // Show these divs
            $("#tools").fadeIn();

            // Hide these divs
            $("#all").fadeOut();
            $("#articles").fadeOut();
            $("#reports").fadeOut();
        }

    });

});
