$(function(){

    // get form object details
    $('[data-verify-investor]').click(function(e){
        e.preventDefault();

        // Get route on div form
        console.log($('[data-verify-investor]'));

        let route = $(this).data('route');
        let investorId = $(this).attr('id');

        $.ajax({
            type: 'POST',
            url: route,
            data: {
                'investor': investorId
            },
            dataType: "json",
            cache: false,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            },

            beforeSend: function () {
                // Hide submit button
                $('#verify_form_fields'+investorId).fadeOut(200);

                // Show spinner
                $("#loader"+investorId).html("<i class='fa fa-spinner fa-spin fa-3x text-success text-center'></i>");
            },

            success:function (Response){
                console.log(Response);

                if(Response.success){
                    // Show submit button
                    $('#verify_form_fields'+investorId).fadeIn(200);

                    // Hide spinner
                    $("#loader"+investorId).empty();
                }

                if(Response.status === 1){
                    $("#status_modal"+investorId).html("Deactivate");
                    $("#status_btn"+investorId).html("Deactivate");
                    $("#notification"+investorId).html("<p class='bg-success text-white text-center p-1'>Investor approved</p>");
                }else{
                    $("#status_modal"+investorId).html("Verify");
                    $("#status_btn"+investorId).html("Verify");
                    $("#notification"+investorId).html("<p class='bg-danger text-white text-center p-1'>Investor Deactivated</p>");
                }

            },

        });
    });


    // get form object details
    $('[data-delete-investor]').click(function(e){
        e.preventDefault();

        // Get route on div form
        console.log($('[data-delete-investor]'));

        let route = $(this).data('route');
        let investorId = $(this).attr('id');

        $.ajax({
            type: 'DELETE',
            url: route,
            data: {
                'investor': investorId
            },
            dataType: "json",
            cache: false,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            },

            beforeSend: function () {
                // Hide submit button
                $('#delete_form_fields'+investorId).fadeOut(200);

                // Show spinner
                $("#delete_loader"+investorId).html("<i class='fa fa-spinner fa-spin fa-3x text-success text-center'></i>");
            },

            success:function (Response){
                console.log(Response);

                if(Response.success){
                    // Remove spinner
                    $("#delete_loader"+investorId).empty();
                    // Show submit button
                    $('#delete_form_fields'+investorId).fadeIn(200);
                    // hide row
                    $('#row'+investorId).fadeOut(200);

                    $('#delete_form_fields'+investorId).html("<p class='bg-danger text-white text-center p-1'>Deleted</p>");
                }

            },

        });
    });


});
