$(function() {

// Add new experience field
    let i = 0;
    let limit = 2;
    $("#add-field").click(function (event) {
        event.preventDefault();
        if (i !== limit) {
            ++i;
            $("#member-referees").append('<div class="row mt-2">\n' +
                '                                   <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">\n' +
                '                                       <input type="text" name="member_referee[' + i + '][name]"\n' +
                '                                              class="na-intern-form-input" placeholder="Referee Name" required>\n' +
                '                                   </div>\n' +
                '                                   <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12">\n' +
                '                                       <input type="email" name="member_referee[' + i + '][email]"\n' +
                '                                              class="na-intern-form-input" placeholder="Referee Email" required>\n' +
                '                                   </div>\n' +
                '                                   <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12">\n' +
                '                                       <input type="text" name="member_referee[' + i + '][company]"\n' +
                '                                              class="na-intern-form-input" placeholder="Referee Company" required>\n' +
                '                                   </div>\n' +
                '                                   <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12">\n' +
                '                                       <input type="text" name="member_referee[' + i + '][position]"\n' +
                '                                              class="na-intern-form-input" placeholder="Referee Company Position" required>\n' +
                '                                   </div>\n' +
                '                                   <div id="remove-field" class="col-xl-1 col-lg-1 col-md-1 col-sm-12">\n' +
                '                                       <button class="btn btn-with-icon na-remove-form-btn">\n' +
                '                                           <i class="typcn typcn-minus"></i></button>\n' +
                '                                   </div>\n' +
                '                               </div>');
        } else {
            $("#referee-alert").html('<p class="bg-danger p-1 text-center text-white" style="width:70%;">Limit reached</p>');
        }
    });

    $(document).on('click', '#remove-field', function (event) {
        event.preventDefault();
        i--
        $(this).closest('.row').remove();
    });

    $(document).on('click', '#form-btn', function (event) {
        if(i < 2){
            $('#loader').html("<p class='p-1 bg-danger text-white text-center'>" +
                "You are to submit a minimum of 3 referees</p>");
            return false;
        }
    });

    $('#submit-referees').submit(function (e) {
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
                $('#submit-referees').fadeOut(200);

                // Show spinner
                let loader = '<div class="text-center mg-b-20">' +
                    '<div class="spinner-border text-success" role="status">' +
                    '<span class="sr-only">Loading...</span>' +
                    '</div>' + '</div>'
                $('#loader').html(loader);
                $('#loader').append('Loading....Please wait');
            },

            success: function (response) {
                console.log(response);

                if (response.success) {
                    $('#loader').html("<p class='p-1 bg-success text-white text-center'>" +
                        "A survey has been sent to your referees via email, which has to be completed before you can be confirmed</p>");
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
                    "An error occured, please contact info@nourishingafrica.com</p>");
            }

        });
    });

});
