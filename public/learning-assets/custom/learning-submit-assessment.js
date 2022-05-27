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
                $('#loader').append("<p class='text-center tx-18'>Getting your score, wait a moment.......</p>");
            },

            success: function (response){
                console.log(response);

                if(response.success){
                    $('#loader').html("<p class='na-text-dark-green tx-30 text-center'>Module Score</p>");
                    $('#loader').append("<h3 class='na-text-dark-green tx-80 text-center'>" + response.percent + "</h3>");
                    $('#loader').append("<p class='text-center tx-18'>" + response.comment + "</p>");
                    console.log(response.success);

                    if(response.result === 'failed'){
                        if(response.retakes < 3){
                            let moduleBtn = '<a href="/yaedp/account/assessment/'+ response.module_id +'/questions">\n' +
                                '        <button style="width: 200px;" class="module-btn bg-danger text-white d-flex justify-content-center mt-2">\n' +
                                '            Retake</button>\n' +
                                '</a>'
                            $('#loader').after(moduleBtn);
                        }else{
                            $('#loader').after("<p class='na-text-dark-green tx-50 text-center'>" +
                                "Sorry, you have no re-takes left</p>");
                        }
                    }else{
                        let moduleBtn = '<a href="/yaedp/account/modules">\n' +
                            '        <button style="width: 200px;" class="module-btn bg-light-brown d-flex justify-content-center mt-2">\n' +
                            '            Modules</button>\n' +
                            '</a>'
                        $('#loader').after(moduleBtn);
                        if(response.retakes < 3){
                            let moduleBtn = '<a href="/yaedp/account/assessment/'+ response.module_id +'/questions">\n' +
                                '        <button style="width: 200px;" class="module-btn bg-danger text-white d-flex justify-content-center mt-2">\n' +
                                '            Retake</button>\n' +
                                '</a>'
                            $('#loader').after(moduleBtn);
                        }
                    }
                }

                if(response.accumulated){
                    $('#accumulated').html("<p class='na-text-dark-green tx-30 text-center'>" +
                        "Overall Score</p>");
                    $('#accumulated').append("<h3 class='na-text-dark-green tx-80 text-center'>" +
                         response.accumulated_percent + "%</h3>");
                    $('#accumulated').append("<p class='text-center tx-18'>" + response.accumulated_comment + "</p>");
                    console.log(response.accumulated);
                    if(response.accumulated_passed === 1){
                        $('#accumulated').after("<img class='d-flex justify-content-center' src='/images/icons/medal.png' width='100' alt=''/>");
                        let moduleBtn = '<a href="/yaedp/account/assessments/">\n' +
                            '        <button style="width: 200px;" class="module-btn bg-light-brown d-flex justify-content-center mt-3">\n' +
                            '            Accumulated scores</button>\n' +
                            '</a>'
                        $('#accumulated').after(moduleBtn);
                    }
                }

                if(response.no_retakes){
                    $('#loader').html("<h1 class='na-text-dark-green tx-100 text-center'>" + response.percent + "</h1><br>");
                    $('#loader').append("<p class='text-center tx-18'>" + response.comment + "</p>");
                    let moduleBtn = '<a href="/yaedp/account/modules">\n' +
                        '        <button style="width: 200px;" class="module-btn bg-light-brown d-flex justify-content-center mt-2">\n' +
                        '            Modules</button>\n' +
                        '</a>'
                    $('#loader').after(moduleBtn);
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
