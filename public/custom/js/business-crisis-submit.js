$(document).ready(function(){

    let company_logo = "";
    let image = "";
    let image_two = "";

    $("#business-crisis-button").click(function () {

        // get input file for "company_logo"
        company_logo = document.getElementById("company_logo").files[0];
        // validate
        let cl = company_logo.type.split('/').pop().toLowerCase();
        if (cl !== "jpeg" && cl !== "jpg" && cl !== "png") {
            $('#company_logo_validation').html('<div class="alert alert-danger alert-dismissable">'+'Invalid File Type'+'</div>');
            return false;
        }
        if (company_logo.size > 1024000) {
            $('#company_logo_validation').html('<div class="alert alert-danger alert-dismissable">'+'File Size Limit is 1mb'+'</div>');
            return false;
        }

        // get input file for "image"
        image = document.getElementById("image").files[0];
        // Validate
        let img = image.type.split('/').pop().toLowerCase();
        if (img !== "jpeg" && img !== "jpg" && img !== "png") {
            $('#image_validation').html('<div class="alert alert-danger alert-dismissable">'+'Invalid File Type'+'</div>');
            return false;
        }
        if (image.size > 1024000) {
            $('#image_validation').html('<div class="alert alert-danger alert-dismissable">'+'File Size Limit is 1mb'+'</div>');
            return false;
        }

        // get input file for "image"
        image_two = document.getElementById("image_two").files[0];
        // Validate
        let img_two = image_two.type.split('/').pop().toLowerCase();
        if (img_two !== "jpeg" && img_two !== "jpg" && img_two !== "png") {
            $('#image_validation_two').html('<div class="alert alert-danger alert-dismissable">'+'Invalid File Type'+'</div>');
            return false;
        }
        if (image_two.size > 1024000) {
            $('#image_validation_two').html('<div class="alert alert-danger alert-dismissable">'+'File Size Limit is 1mb'+'</div>');
            return false;
        }

    });

    $('#business-crisis-form').submit(function (e) {

        // get route
        let route = $(this).data('route');

        // prevent default form submission
        e.preventDefault();

        $('.alert').remove();

        // get all form data and create an instance
        let formData = new FormData(this);

        // add company_logo and image file input to the form data
        formData.append('company_logo', $('#company_logo')[0].files[0]);
        formData.append('image', $('#image')[0].files[0]);
        formData.append('image_two', $('#image_two')[0].files[0]);

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
                $('#business-crisis-button').attr("disabled", "disabled");
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
                        '<div class="alert alert-success alert-dismissable" style="width: 80%; margin: 10px auto; padding: 10px;">'+Response.success+'</div>'
                    );
                    //clear all fields after submission
                    $("#business-crisis-form")[0].reset();
                }
            },
            error: function (Response) {
                $('#status').html('');
                $.each(Response.responseJSON.errors, function(key,value) {
                    $('#status').append('<div class="alert alert-danger alert-dismissable">'+value+'</div>');
                });
            },
            complete: function (Response) {
                //after submission return opacity
                // $('#covid-experience-form').css("opacity","");
                $('#form-fields').fadeIn('1000');

                // Show image container
                $("#loader").hide();

                //after submission remove disabled attribute
                $("#business-crisis-button").removeAttr("disabled");
            }
        });
    });

});
