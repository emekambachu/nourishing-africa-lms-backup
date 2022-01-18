$(document).ready(function() {

    $("#update-password-btn").on('click', function (event) {

        let password = $('#update-password-form').find('input[name="new_password"]').val();
        let password_confirm = $('#update-password-form').find('input[name="new_password_confirm"]').val();

        if (password !== password_confirm) {
            event.preventDefault();
            let validationAlert = "<p class='bg-danger p-2 text-center text-white'>" +
                "Password and confirm password does not match</p>"
            $("#validation-alert").html(validationAlert);
        } else {
            $("#validation-alert").empty();
        }

    });

    $("#upload-company-doc-btn").on('click', function (event) {

        let name = $('#upload-company-doc-form').find('input[name="name"]').val();
        let description = $('#upload-company-doc-form').find('textarea[name="description"]').val();
        let image = $('#image').prop('files')[0];

        alert(image);

        if(name === ''){
            let validationAlert = "<p class='bg-danger p-2 text-center text-white'>" +
                "Name can't be empty</p>"
            $("#validation-alert").html(validationAlert);
            event.preventDefault();
        }

        // if(description === ''){
        //     let validationAlert = "<p class='bg-danger p-2 text-center text-white'>" +
        //         "Description can't be empty</p>"
        //     $("#validation-alert").html(validationAlert);
        //     event.preventDefault();
        // }

        if(image === ''){
            let validationAlert = "<p class='bg-danger p-2 text-center text-white'>" +
                "Image can't be empty</p>"
            $("#validation-alert").html(validationAlert);
            event.preventDefault();
        }

        // validate
        let im = image.type.split('/').pop().toLowerCase();
        if (im !== "jpeg" && im !== "jpg" && im !== "png" && im !== "pdf") {
            let validationAlert = "<p class='bg-danger p-2 text-center text-white'>" +
                "Document must be jpeg, jpg, png and pdf</p>"
            $("#validation-alert").html(validationAlert);
            event.preventDefault();
        }

        if (image.size > 2024000) {
            let validationAlert = "<p class='bg-danger p-2 text-center text-white'>" +
                "Document must not be more than 2 mb</p>"
            $("#validation-alert").html(validationAlert);
            event.preventDefault();
        }
    });


    $('#upload-company-doc-form').submit(function (event) {

        // get route
        let route = $(this).data('route');

        // prevent default form submission
        event.preventDefault();

        // get all form data and create an instance
        let formData = new FormData(this);

        // add company_logo and image file input to the form data
        formData.append('image', $('#image')[0].files[0]);

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
                $('#validation-alert').empty();

                // disable submission button and form field
                $('#upload-company-doc-btn').attr("disabled", "disabled");
                // make form transparent
                // $('#covid-experience-form').css("opacity",".3");
                $('#form-fields').fadeOut('1000');
                // Show image container
                $("#spinner").fadeIn('1000');
            },
            success: function (Response) {
                console.log(Response);
                if (Response.success) {
                    $('#validation-alert').html(
                        '<div class="bg-success text-white" style="width: 80%; margin: 10px auto; padding: 10px;">'+Response.success+'</div>'
                    );
                    //clear all fields after submission
                    $("#upload-company-doc-form")[0].reset();
                }
            },
            error: function (Response) {
                $('#validation-alert').html(
                    '<div class="bg-danger text-white p-2" style="width: 80%; margin: 10px auto; padding: 10px;">'+response.responseJSON.errors+'</div>'
                );
            },
            complete: function (Response) {
                //after submission return opacity
                // $('#covid-experience-form').css("opacity","");
                $('#form-fields').fadeIn('1000');

                // Show image container
                $("#spinner").fadeOut('1000');

                //after submission remove disabled attribute
                $("#upload-company-doc-btn").removeAttr("disabled");
            }
        });
    });

    // reload page after closing modal popup
    $(".reload-page").click(function(){
        location.reload(true);
    });


});
