$(document).ready(function(){

    // setInterval(function(){
    //     $.ajax({
    //         type: 'GET',
    //         url: 'getChats',
    //         contentType : false,
    //         processData : false,
    //         dataType: "json",
    //         headers: {
    //             "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
    //         },
    //         success: function (Response) {
    //             console.log(Response);
    //             $("#chat_message").val('');
    //         },
    //     });
    // }, 3000);

    // Check if message box is empty
    $("#chat_button").on('click', function(event) {

        let message = $('#chat_form').find('input[name="chat_message"]').val();
        if(!message){
            return false;
        }
    });

    $('#chat_form').submit(function (event) {

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
                $('#chat_button').attr("disabled", "disabled");

                // Show image container
                $("#chat_button").html("<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span>" +
                    "<span class='sr-only'>Loading...</span>");
            },
            success: function (Response) {
                console.log(Response);
                $("#chat_message").val('');
            },
            complete: function (Response) {
                $("#chat_button").html('Send');
                $("#chat_button").removeAttr("disabled");
            }
        });
    });

});
