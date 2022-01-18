$(document).ready(function() {

    $("#password-reset-btn").on('click', function(event) {

        let password = $('#password-reset-form').find('input[name="password"]').val();
        let password_confirm = $('#password-reset-form').find('input[name="password_confirm"]').val();

        if(password !== password_confirm){
            event.preventDefault();
            let validationAlert = "<p class='p-2 bg-deep-pink text-white border-radius-5 text-center'>" +
                "Password and confirm password does not match</p>"
            $("#validation-alert").html(validationAlert);
        }else{
            $("#validation-alert").empty();
        }

    });

    $('#password-reset-form').submit(function (event) {

        // get route
        let route = $(this).data('route');

        // prevent default form submission
        event.preventDefault();

        // get all form data and create an instance
        let formData = new FormData(this);

        $.ajax({
            type: 'POST',
            url: route,
            data: formData,
            contentType : false,
            processData : false,
            dataType: "json",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            },
            beforeSend: function () {
                // disable submission button and form field
                $('#password-reset-btn').attr("disabled", "disabled");

                $('#form-fields').fadeOut('1000');
                // Show image container
                $("#spinner").addClass('fa fa-4x fa-spinner brand-text');
            },
            success: function (Response) {
                console.log(Response);
                if (Response.success) {
                    $('#validation-alert').html(
                        '<div class="alert alert-success alert-dismissable" style="width: 80%; margin: 10px auto; padding: 10px;">'+Response.success+'</div>'
                    );
                    //clear all fields after submission
                    $("#password-reset-form")[0].reset();
                }
            },
            error: function (Response) {
                $('#validation-alert').html('');
                $.each(Response.responseJSON.errors, function(key,value) {
                    $('#validation-alert').append('<div class="alert alert-danger alert-dismissable">'+value+'</div>');
                });
            },
            complete: function (Response) {
                //after submission return opacity
                // $('#covid-experience-form').css("opacity","");
                $('#form-fields').fadeIn('1000');

                // Show image container
                $("#spinner").removeClass('fa fa-4x fa-spinner brand-text');

                //after submission remove disabled attribute
                $("#password-reset-btn").removeAttr("disabled");
            }
        });
    });

});
