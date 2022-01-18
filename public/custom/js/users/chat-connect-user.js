$(function(){

    $('[data-submit]').submit(function(e){
        e.preventDefault();

        let userId = $(this).data('submit');
        let route = $(this).data('route');

        $.ajax({
            type: 'POST',
            url: route,
            data: {
                'user': userId,
            },
            dataType: "json",
            cache: false,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            },

            beforeSend: function (){
                // Hide favorite button
                $('#connectForm'+userId).fadeOut(200);

                // Show spinner
                $('#connectLoader'+userId).html("<i class='fas fa-circle-notch fa-spin fa-2x text-success'></i>");
                $('#connectLoader'+userId).append("<p class='text-left'>Loading......Please wait</p>");
            },

            success:function (response){
                console.log(response);

                if(response.success){
                    let notification = "<p class='p-1 m-2 bg-success text-white text-center border-radius-2'>" +
                        "You started a chat connection with "+ response.receiver_name +", go to the chat page on your membership portal to initiate a conversation</p>";
                    $('#connectLoader'+userId).html(notification);
                    $('#connectLoader'+userId).after("<a href='/member/chat'>\n" +
                        "      <button class='text-white btn btn-very-small btn-rounded na-bg-orange'>\n" +
                        "   Chat</button></a>");
                }
            },

            error: function (Response) {
                console.log(Response.responseText);
                $('#connectLoader'+userId).html("<p class='p-1 bg-danger text-white text-center'>" +
                    "An error occurred, please reload the page or contact us on info@nourishingafrica.com</p>");
            }

        });
    });

});
