$(function(){

    // get form object details
    $('[data-verify]').click(function(e){
        e.preventDefault();

        // Get route on div form
        console.log($('[data-verify]'));

        let route = $(this).data('route');
        let id = $(this).attr('id');

        $.ajax({
            type: 'POST',
            url: route,
            data: {
                'id': id
            },
            dataType: "json",
            cache: false,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            },

            beforeSend: function () {
                // Hide submit button
                $('#verify_form_fields'+id).fadeOut(200);

                // Show spinner
                $("#loader"+id).html("<i class='fa fa-spinner fa-spin fa-3x text-success text-center'></i>");
            },

            success:function (Response){
                console.log(Response);

                if(Response.success){
                    // Show submit button
                    $('#verify_form_fields'+id).fadeIn(200);

                    // Hide spinner
                    $("#loader"+id).empty();
                }

                if(Response.status === 1){
                    $("#status_modal"+id).html("Un-approve");
                    $("#status_btn"+id).html("Un-approve");
                    $("#notification"+id).html("<p class='bg-success text-white text-center p-1'>Approved</p>");
                }else{
                    $("#status_modal"+id).html("Approve");
                    $("#status_btn"+id).html("Approve");
                    $("#notification"+id).html("<p class='bg-danger text-white text-center p-1'>Pending</p>");
                }
            },

        });
    });


    // get form object details
    $('[data-delete]').click(function(e){
        e.preventDefault();

        // Get route on div form
        console.log($('[data-delete]'));

        let route = $(this).data('route');
        let id = $(this).attr('id');

        $.ajax({
            type: 'DELETE',
            url: route,
            data: {
                'id': id
            },
            dataType: "json",
            cache: false,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            },

            beforeSend: function () {
                // Hide submit button
                $('#delete_form_fields'+id).fadeOut(200);

                // Show spinner
                $("#delete_loader"+id).html("<i class='fa fa-spinner fa-spin fa-3x text-success text-center'></i>");
            },

            success:function (Response){
                console.log(Response);

                if(Response.success){
                    // Remove spinner
                    $("#delete_loader"+id).empty();
                    // Show submit button
                    $('#delete_form_fields'+id).fadeIn(200);
                    // hide row
                    $('#row'+id).fadeOut(200);

                    $('#delete_form_fields'+id).html("<p class='bg-danger text-white text-center p-1'>Deleted</p>");
                }

            },

        });
    });


});
