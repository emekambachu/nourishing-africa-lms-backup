$(function(){

    // on file upload
    $('.file_upload').change(function(){
        // Validate form fields
        let doc = $(this).prop('files')[0];
        if(doc){
            let ao_ext = $(this).val().split('.').pop().toLowerCase();
            if($.inArray(ao_ext, ['jpg', 'png', 'jpeg', 'gif', 'pdf', 'doc', 'docx']) === -1) {
                let notification = "<p class='bg-danger p-1 text-center text-white na-border-radius'>" +
                    "Unsupported file format</p>"
                $("#notification").html(notification);
                return false;
            }else{
                $("#notification").empty();
            }

            if(doc.size > 5024000){
                let notification = "<p class='bg-danger p-1 text-center text-white na-border-radius'>" +
                    "File must not be more than 2 mb</p>"
                $("#notification").html(notification);
                return false;
            }else{
                $("#notification").empty();
            }
        }
    });

    // Show identity on box check
    $("#identity").change(function() {
        if($('#identity').is(":checked")) {
            $("#identity-container").fadeIn(300);
        }else{
            $("#identity-container").fadeOut(300);
        }
    });

    // Submit whistle blowing form
    $('#whistleblowing-form').submit(function(event){
        event.preventDefault();
        let route = $(this).data('route');

        // get all form input data and create an instance
        // Check if file upload field is empty before submitting to server
        let formData = new FormData(this);
        if ($('#file_one').get(0).files.length > 0) {
            formData.append('file_one', $('#file_one')[0].files[0]);
        }
        if ($('#file_two').get(0).files.length > 0) {
            formData.append('file_two', $('#file_two')[0].files[0]);
        }


        $.ajax({
            type: 'POST',
            url: route,
            data: formData,
            processData: false,
            contentType: false,
            dataType: "json",
            cache: false,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            },

            beforeSend: function (){
                $("#form-fields :input").prop("disabled", true);
                $('#whistle-blowing-btn').html("<i class='fas fa-circle-notch fa-3x fa-spin text-white'></i>");
            },

            success:function (response){

                if(response.success){
                    $("#form-fields :input").prop("disabled", false);
                    $('#whistleblowing-form').trigger("reset");
                    $('#whistle-blowing-btn').html("Submit");
                    $('#notification').html("");
                    $('#notification').addClass('bg-success p-1 text-white text-center border-1 na-border-radius')
                        .html("<p>"+response.success+"</p>");
                }

                if (response.errors) {
                    $.each(response.errors, function(key, value) {
                        $('#notification').html("");
                        $('#notification').append("<p class='p-1 bg-danger text-white text-center'>"+value+"</p>");
                        $("#form-fields :input").prop("disabled", false);
                        $('#whistle-blowing-btn').html("Submit");
                    });
                }
            },

            error: function (response) {
                console.log(JSON.parse(response.responseText));
                $("#form-fields :input").prop("disabled", false);
                $('#whistle-blowing-btn').html("Submit");
                $('#notification').addClass('bg-danger p-1 text-white text-center border-1 na-border-radius')
                    .html('Error submitting');
            }
        });
    });

});
