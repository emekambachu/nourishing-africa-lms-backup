$(function(){

    // get form object details
    $('[data-approve-conn]').click(function(e){
        e.preventDefault();

        // Get route on div form
        console.log($('[data-approve-conn]'));

        let route = $(this).data('route');
        let connectionId = $(this).attr('id');

        $.ajax({
            type: 'POST',
            url: route,
            data: {
                'connection': connectionId
            },
            dataType: "json",
            cache: false,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            },

            beforeSend: function () {
                // Hide submit button
                $('#verify_form_fields'+connectionId).fadeOut(200);

                // Show spinner
                $("#loader"+connectionId).html("<i class='fa fa-spinner fa-spin fa-3x text-success text-center'></i>");
            },

            success:function (Response){
                console.log(Response);

                if(Response.success){
                    // Show submit button
                    $('#verify_form_fields'+connectionId).fadeIn(200);

                    // Hide spinner
                    $("#loader"+connectionId).empty();
                }

                if(Response.status === 1){
                    $("#status_modal"+connectionId).html("Un-approve");
                    $("#status_btn"+connectionId).html("Un-approve");
                    $("#status_table"+connectionId).html("Approved");
                    $("#notification"+connectionId).html("<p class='bg-success text-white text-center p-1'>Connection approved</p>");
                }else{
                    $("#status_modal"+connectionId).html("Approve");
                    $("#status_btn"+connectionId).html("Approve");
                    $("#status_table"+connectionId).html("Pending");
                    $("#notification"+connectionId).html("<p class='bg-danger text-white text-center p-1'>Connection Unapproved</p>");
                }

            },

        });
    });


    // get form object details
    $('[data-delete-conn]').click(function(e){
        e.preventDefault();

        // Get route on div form
        console.log($('[data-delete-conn]'));

        let route = $(this).data('route');
        let connectionId = $(this).attr('id');

        $.ajax({
            type: 'DELETE',
            url: route,
            data: {
                'connection': connectionId
            },
            dataType: "json",
            cache: false,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            },

            beforeSend: function () {
                // Hide submit button
                $('#delete_form_fields'+connectionId).fadeOut(200);

                // Show spinner
                $("#delete_loader"+connectionId).html("<i class='fa fa-spinner fa-spin fa-3x text-success text-center'></i>");
            },

            success:function (Response){
                console.log(Response);

                if(Response.success){
                    // Remove spinner
                    $("#delete_loader"+connectionId).empty();
                    // Show submit button
                    $('#delete_form_fields'+connectionId).fadeIn(200);
                    // hide row
                    $('#row'+connectionId).fadeOut(200);

                    $('#delete_form_fields'+connectionId).html("<p class='bg-danger text-white text-center p-1'>Deleted</p>");
                }

            },

        });
    });


});
