$('[data-notification]').click(function(event){

    // event.preventDefault();

    let route = $(this).data('route');
    let id = $(this).data('notification');

    $.ajax({
        type: 'GET',
        url: route,
        data: {
            'id': id,
        },
        dataType: "json",
        contentType: false,
        processData: false,
        cache: false,
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        },

        success:function (response){
            console.log('Opened');
        },
        error: function (Response) {
            console.log(Response.responseText);
        }
    });

});
