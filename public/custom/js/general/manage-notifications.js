$(function() {

    // Open All Notifications
    $('[data-notifications]').click(function (e) {
        // e.preventDefault();

        // Get route on div form
        console.log('Open notifications');

        let userId = $(this).data('user');
        let route = $(this).data('route');

        $.ajax({
            type: 'GET',
            url: route,
            data: {
                'user': userId,
            },
            dataType: "json",
            cache: false,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            },

            beforeSend: function () {
                console.log('Opening Notifications');
            },

            success: function (Response) {
                console.log('Opened Notifications');
            },

        });
    });

    // Delete Notification
    $('[data-delete]').click(function(event){
        event.preventDefault();

        // Get route on div form
        console.log($('[data-delete]'));

        let route = $(this).data('route');
        let notificationId = $(this).attr('id');

        $.ajax({
            type: 'DELETE',
            url: route,
            data: {
                'notification': notificationId
            },
            dataType: "json",
            cache: false,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            },

            beforeSend: function () {
                // Show spinner
                let loader = '<div class="text-center mg-b-20">' +
                    '<div class="spinner-border text-success" role="status">' +
                    '<span class="sr-only">Loading...</span>' +
                    '</div>' + '</div>';

                // Show spinner
                $("#"+notificationId).html(loader);
            },

            success:function (Response){
                console.log(Response);
                if(Response.success){
                    // hide row
                    $('#notification'+notificationId).fadeOut();
                }
            },

        });
    });
});
