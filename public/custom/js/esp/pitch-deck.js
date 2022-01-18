$(function(){

    $('#pitch-terms-btn').click(function(event) {
        if($('#pitch-terms-check').is(':checked')){
            $('#pitch-terms-container').fadeOut();
            $('#pitch-submission-container').fadeIn();
        }else{
            $('#pitch-deck-notification').html('<p class="p-2 text-white bg-danger m-2 rounded-10">' +
                'select the check box to agree on our terms and conditions</p>');
        }
    });

    // get form ID
    $('#pitch-deck-submit-btn').click(function(e){

        // validate extension
        let document = $('#document').prop('files')[0];
        if(document){
            let doc_ext = $('#document').val().split('.').pop().toLowerCase();
            if($.inArray(doc_ext, ['pptx', 'ppt']) === -1) {
                let validateExt = "<p class='bg-danger p-2 text-center text-white'>" +
                    "Must be a powerpoint file (PPT)</p>"
                $('#validateUpload').html(validateExt);
                return false;
            }else{
                $('#validateUpload').empty();
            }
        }

        // Validate Size
        if (document.size > 5024000) {
            let validateSize = "<p class='bg-danger p-2 text-center text-white'>" +
                "Document must not be more than 5mb</p>"
            $('#validateUpload').html(validateSize);
            return false;
        }else{
            $('#validateUpload').empty();
        }

        // Validate Extension
        let video = $('#video').prop('files')[0];
        if(video){
            let vid_ext = $('#video').val().split('.').pop().toLowerCase();
            if($.inArray(vid_ext, ['mp4', 'wmv', 'mpeg', 'avi']) === -1) {
                let validateUpload = "<p class='bg-danger p-2 text-center text-white'>" +
                    "Must be a video file (mp4, wmv, mpeg, avi)</p>"
                $('#validateUpload').html(validateUpload);
                return false;
            }else{
                $('#validateUpload').empty();
            }
        }

        // Validate Size
        if (video.size > 100024000) {
            let validateSize = "<p class='bg-danger p-2 text-center text-white'>" +
                "Video must not be more than 100mb</p>"
            $('#validateUpload').html(validateSize);
            return false;
        }else{
            $('#validateUpload').empty();
        }
    });

    $('#pitch-deck-form').submit(function(e){
        e.preventDefault();

        // get all form data and create an instance
        let formData = new FormData(this);
        formData.append('document', $('#document')[0].files[0]);
        formData.append('video', $('#video')[0].files[0]);

        let route = $(this).data('route');

        $.ajax({
            type: 'POST',
            url: route,
            data: formData,
            processData: false,
            contentType: false,
            cache: false,
            dataType: "json",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            },

            beforeSend: function(){
                // Hide submission forms
                $('#pitch-deck-submit-btn').attr('disabled', true);
                // Show spinner
                let loader = '<div class="text-center mg-b-20">' +
                    '<div class="spinner-border text-success" role="status">' +
                    '<span class="sr-only">Loading...</span>' +
                    '</div>' + '</div>';
                $('#validateUpload').html(loader);
                $('#validateUpload').append("<p class='text-center'>Uploading.....Please wait</p>");
            },

            success:function (Response){
                console.log(Response);

                if(Response.success){
                    console.log("Uploads submitted");

                    $('#pitch-deck-submit-btn').attr('disabled', false);

                    let validateUpload = "<p class='bg-success p-2 text-center text-white'>"
                        +Response.success+
                        "</p>";
                    $('#validateUpload').html(validateUpload);
                }

                if(Response.already_submitted){
                    console.log("Already Submitted");

                    $('#pitch-deck-submit-btn').attr('disabled', false);

                    let validateUpload = "<p class='bg-success p-2 text-center text-white'>"
                        +Response.already_submitted+
                        "</p>";
                    $('#validateUpload').html(validateUpload);
                }

                if(Response.error){
                    console.log('#alert'+formId);

                    let alert = "<p class='bg-danger p-2 text-center text-white'>" +
                        "Unable to submit</p>"

                    $('#validateUpload').html(validateUpload);
                }
            },

            error: function (Response) {
                console.log(Response.responseText);
                $('#validateUpload').html("<p class='bg-danger p-2 text-center text-white'>" +
                    "Error occured, please contact the admin</p>");
            }

        });
    });

    $('[data-deletion-form]').submit(function(e){
        e.preventDefault();
        // Get route on div form
        console.log($('[data-deletion-form]'));

        let formId = $(this).attr('id');
        let route = $(this).data('route');

        $.ajax({
            type: 'DELETE',
            url: route,
            processData: false,
            contentType: false,
            cache: false,
            dataType: "json",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            },

            beforeSend: function(){
                // Hide submission field
                $('#form-fields'+formId).empty();
                $('#delete-form'+formId).fadeOut(1000);

                // Show spinner
                let loader = '<div class="text-center mg-b-20">' +
                    '<div class="spinner-border text-success" role="status">' +
                    '<span class="sr-only">Loading...</span>' +
                    '</div>' + '</div>'
                $('#alert'+formId).html(loader);
            },

            success:function (Response){
                console.log(Response);

                if(Response.success){
                    console.log("Assignment Deleted");

                    $('#form-fields'+formId).fadeOut(1000);
                    $('#assignment-submission-form'+formId).fadeIn(1000);

                    let alert = "<p class='bg-success p-2 text-center text-white'>" +
                        Response.success+"</p>"
                    $('#alert'+formId).html(alert);
                }

                if(Response.error){
                    console.log('#alert'+formId);

                    $('#delete-form'+formId).fadeIn(1000);

                    let alert = "<p class='bg-danger p-2 text-center text-white'>" +
                        "Unable to submit</p>"

                    $('#alert'+formId).html(alert);
                }
            },

        });
    });

});
