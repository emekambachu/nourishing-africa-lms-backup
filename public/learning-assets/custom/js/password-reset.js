$(document).ready(function(){

    let formSubmission = (event, route, buttonId, formFields) => {
        // prevent default form submission
        event.preventDefault();

        // create an instance of form data
        let formData = new FormData();
        // Loop through all fields and add them to the name and field value to the formData instance
        $(formFields).each(function(){
            console.log($(this).attr('name'));
            formData.append($(this).attr('name'), $(this).val());
        });

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
                $('#'+buttonId).attr("disabled", "disabled");
                $('#form-fields').fadeOut(1000);
                // Show image container
                $('#loader').fadeIn(1000);
            },

            success: function (Response) {
                console.log(Response);
                if (Response.success) {
                    $('#validation-alert').html(
                        '<div class="alert alert-success alert-dismissable" style="width: 80%; margin: 10px auto; padding: 10px;">'+Response.success+'</div>'
                    );
                    $('#form-fields').fadeIn(1000);
                    //clear all fields after submission
                    // $("#password-reset-form")[0].reset();
                    // Show image container
                    $('#loader').fadeOut(1000);
                    //after submission remove disabled attribute
                    $('#'+buttonId).removeAttr("disabled");
                }
            },

            error: function (response){
                $("#loader").fadeOut(1000);
                $('#validation-alert').html(
                    '<div class="alert alert-danger alert-dismissable" style="width: 80%; margin: 10px auto; padding: 10px;">'+response.error+'</div>'
                );
                $('#form-fields').fadeIn('1000');
                //after submission remove disabled attribute
                $('#'+buttonId).removeAttr("disabled");
                console.log(response.error);
            },

        });
    }

    $("#password-token-btn").on('click', function(event){

        let route = $(this).data('route');
        let buttonId = $(this).attr('id');
        let formFields = $('.login-form');

        // Email Validation
        function validEmail(email) {
            let regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            return regex.test(email);
        }

        let email = $('#password-token-form').find('input[name="email"]').val();
        if(!validEmail(email)){
            event.preventDefault();
            let validationAlert = "<p class='p-2 bg-deep-pink text-white border-radius-5 text-center'>" +
                "Incorrect email format</p>"
            $("#validation-alert").html(validationAlert);
        }else{
            $("#validation-alert").empty();
            formSubmission(event, route, buttonId, formFields);
        }
    });

    $("#password-update-btn").on('click', function(event) {

        let route = $(this).data('route');
        let buttonId = $(this).attr('id');
        let formFields = $('.login-form');

        let password = $('#password-update-form').find('input[name="password"]').val();
        let password_confirm = $('#password-update-form').find('input[name="password_confirm"]').val();

        if(password !== password_confirm){
            event.preventDefault();
            let validationAlert = "<p class='p-2 bg-deep-pink text-white border-radius-5 text-center'>" +
                "Password and confirm password does not match</p>"
            $("#validation-alert").html(validationAlert);
        }else{
            $("#validation-alert").empty();
            formSubmission(event, route, buttonId, formFields);
        }

    });

    // $('#password-reset-form').submit(function (event) {
    //     // prevent default form submission
    //     event.preventDefault();
    //     // get route
    //     let route = $(this).data('route');
    //
    //     // get all form data and create an instance
    //     let formData = new FormData(this);
    //
    //     $.ajax({
    //         type: 'POST',
    //         url: route,
    //         data: formData,
    //         contentType : false,
    //         processData : false,
    //         dataType: "json",
    //         headers: {
    //             "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
    //         },
    //         beforeSend: function () {
    //             // disable submission button and form field
    //             $('#password-reset-btn').attr("disabled", "disabled");
    //
    //             $('#form-fields').fadeOut('1000');
    //             // Show image container
    //             $("#spinner").addClass('fa fa-4x fa-spin fa-spinner brand-text aligncenter');
    //         },
    //         success: function (Response) {
    //             console.log(Response);
    //             if (Response.success) {
    //                 $('#validation-alert').html(
    //                     '<div class="alert alert-success alert-dismissable" style="width: 80%; margin: 10px auto; padding: 10px;">'+Response.success+'</div>'
    //                 );
    //
    //                 $('#form-fields').fadeIn('1000');
    //                 //clear all fields after submission
    //                 $("#password-reset-form")[0].reset();
    //                 // Show image container
    //                 $("#spinner").removeClass('fa fa-4x fa-spinner brand-text aligncenter');
    //                 //after submission remove disabled attribute
    //                 $("#password-reset-btn").removeAttr("disabled");
    //             }
    //         },
    //
    //         error: function (response) {
    //             $("#spinner").removeClass('fa fa-4x fa-spinner brand-text');
    //             $('#validation-alert').html(
    //                 '<div class="alert alert-danger alert-dismissable" style="width: 80%; margin: 10px auto; padding: 10px;">'+response.responseJSON.errors+'</div>'
    //             );
    //
    //             $('#form-fields').fadeIn('1000');
    //
    //             //after submission remove disabled attribute
    //             $("#password-reset-btn").removeAttr("disabled");
    //
    //             console.log(response.responseJSON.errors);
    //         },
    //
    //     });
    // });

    // $('#password-update-form').submit(function (event) {
    //
    //     // get route
    //     let route = $(this).data('route');
    //
    //     // prevent default form submission
    //     event.preventDefault();
    //
    //     // get all form data and create an instance
    //     let formData = new FormData(this);
    //
    //     $.ajax({
    //         type: 'POST',
    //         url: route,
    //         data: formData,
    //         contentType : false,
    //         processData : false,
    //         dataType: "json",
    //         headers: {
    //             "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
    //         },
    //         beforeSend: function () {
    //             // disable submission button and form field
    //             $('#password-update-btn').attr("disabled", "disabled");
    //
    //             $('#form-fields').fadeOut('1000');
    //             // Show image container
    //             $("#spinner").addClass('fa fa-4x fa-spinner brand-text');
    //         },
    //         success: function (Response) {
    //             console.log(Response);
    //             if (Response.success) {
    //                 $('#validation-alert').html(
    //                     '<div class="alert alert-success alert-dismissable" style="width: 80%; margin: 10px auto; padding: 10px;">'+Response.success+'</div>'
    //                 );
    //                 //clear all fields after submission
    //                 $("#password-update-form")[0].reset();
    //             }
    //
    //             $('#form-fields').fadeIn('1000');
    //
    //             // Show image container
    //             $("#spinner").removeClass('fa fa-4x fa-spinner brand-text');
    //
    //             //after submission remove disabled attribute
    //             $(this).attr('id').removeAttr("disabled");
    //         },
    //         error: function (Response) {
    //             $('#validation-alert').html('');
    //             $.each(Response.responseJSON.errors, function(key,value) {
    //                 $('#validation-alert').append('<div class="alert alert-danger alert-dismissable">'+value+'</div>');
    //             });
    //         },
    //     });
    // });

});
