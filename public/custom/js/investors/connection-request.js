$(function(){

    // get form object details
    $('[data-connection]').click(function(e){
        e.preventDefault();

        // Get route on div form
        console.log($('[data-connection]'));

        let companyId = $(this).attr('id');
        let userId = $(this).data('user');
        let route = $(this).data('route');
        let investorId = $(this).data('investor');

        $.ajax({
            type: 'GET',
            url: route,
            data: {
                'user': userId,
                'company': companyId,
                'investor': investorId
            },
            dataType: "json",
            cache: false,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            },

            beforeSend: function () {
                // Hide favorite button
                $('#connect_user'+companyId).empty();
                $('#conn-notification'+companyId).empty();
                $('.remove_conn'+companyId).fadeOut(200);
                $('.add_conn'+companyId).fadeOut(200);

                // Show spinner
                let loader = '<div class="text-center mg-b-20">' +
                    '<div class="spinner-border text-success" role="status">' +
                    '<span class="sr-only">Loading...</span>' +
                    '</div>' + '</div>'
                $('#connect_user'+companyId).html(loader);
            },

            success:function (Response){
                console.log(Response);

                if(Response.success){
                    console.log('#connect_user'+companyId);

                    $('#connect_user'+companyId).empty();
                    $('.remove_conn'+companyId).fadeIn(200);
                    $('#conn-notification'+companyId).html("<p class='bg-success p-2 text-center text-white tx-12'>You just sent a connection request to this company, an email confirmation will be sent to you upon approval</p>");
                }

                if(Response.delete_connection){
                    console.log('#connect_user'+companyId);

                    $('#connect_user'+companyId).empty();
                    $('.add_conn'+companyId).fadeIn(200);
                }

                if(Response.error){
                    console.log('#connect_user'+companyId);

                    let connectBtn = '<button id="'+companyId+'" data-connection="'+companyId+'"' +
                        'data-route="'+this.url+'" data-investor="'+investorId+'"' +
                        'class="btn na-investor-bg-dark-green na-investor-btn-radius btn-with-icon btn-block na-investor-text3 text-white">'+
                        '<i class="typcn typcn-contacts"></i> Connect</button>';

                    $('#connect_user'+companyId).html(connectBtn);
                    $('#connect_user'+companyId).append('<span class="p-5 bg-danger text-white">Error sending connection</span>');
                }
            },

        });
    });

    $('[data-shortlist]').click(function(e){
        e.preventDefault();

        // Get route on div form
        console.log($('[data-shortlist]'));

        let companyId = $(this).attr('id');
        let userId = $(this).data('user');
        let route = $(this).data('route');
        let investorId = $(this).data('investor');

        $.ajax({
            type: 'GET',
            url: route,
            data: {
                'user': userId,
                'company': companyId,
                'investor': investorId
            },
            dataType: "json",
            cache: false,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            },

            beforeSend: function () {
                // Hide favorite button
                $('#shortlist_user'+companyId).empty();
                $('.remove_short'+companyId).fadeOut(200);
                $('.add_short'+companyId).fadeOut(200);

                // Show spinner
                let loader = '<div class="text-center mg-b-20">' +
                    '<div class="spinner-border text-success" role="status">' +
                    '<span class="sr-only">Loading...</span>' +
                    '</div>' + '</div>'
                $('#shortlist_user'+companyId).html(loader);
            },

            success:function (Response){
                console.log(Response);

                if(Response.success){
                    console.log('#shortlist_user'+companyId);

                    $('#shortlist_user'+companyId).empty();
                    $('.remove_short'+companyId).fadeIn(200);

                    // let shortlisted = '<button class="btn btn-with-icon btn-block text-black">'+
                    //     '<i class="typcn typcn-contacts"></i> Shortlisted</button>';

                    // let removeShortlist = '<button id="'+userId+'" data-shortlist="'+userId+'"' +
                    //     'data-route="'+route+'" data-investor="'+investorId+'"' +
                    // 'class="btn btn-danger na-investor-btn-radius btn-with-icon btn-block na-investor-text3 na-inv-hover-text">'+
                    // '<i class="typcn typcn-minus"></i> Remove From Shortlist</button>';
                    //
                    // $('#shortlist_user'+userId).html(removeShortlist);
                }

                if(Response.delete_shortlist){
                    console.log('#shortlist_user'+companyId);

                    $('#shortlist_user'+companyId).empty();
                    $('.add_short'+companyId).fadeIn(200);

                    // let shortlisted = '<button class="btn btn-with-icon btn-block text-black">'+
                    //     '<i class="typcn typcn-contacts"></i> Shortlisted</button>';

                    // let addShortlist = '<button id="'+userId+'" data-shortlist="'+userId+'"' +
                    //     'data-route="'+route+'" data-investor="'+investorId+'"' +
                    //     'class="btn na-btn-outline-green na-investor-btn-radius btn-with-icon btn-block na-investor-text3 na-inv-hover-text">'+
                    //     '<i class="typcn typcn-plus"></i> Shortlist</button>';
                    //
                    // $('#shortlist_user'+userId).html(addShortlist);
                }

                if(Response.error){
                    console.log('#shortlist_user'+companyId);

                    let notShortlisted = '<button class="btn btn-with-icon btn-block text-black">'+
                        '<i class="typcn typcn-contacts"></i> Error sending request</button>'

                    $('#shortlist_user'+companyId).append(notShortlisted);
                }
            },

        });
    });

    $('[data-deal]').submit(function(e){
        e.preventDefault();

        // Get route on div form
        console.log($('[data-deal]'));

        let connectionId = $(this).attr('id');
        let route = $(this).data('route');

        $.ajax({
            type: 'Post',
            url: route,
            data: {
                'connection': connectionId,
            },
            dataType: "json",
            cache: false,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            },

            beforeSend: function () {
                // Hide favorite button
                $('.deal-btn'+connectionId).fadeOut(200);

                // Show spinner
                let loader = '<div class="text-center mg-b-20">' +
                    '<div class="spinner-border text-success" role="status">' +
                    '<span class="sr-only">Loading...</span>' +
                    '</div>' + '</div>'
                $('#deal-status'+connectionId).html(loader);
            },

            success:function (Response){
                console.log(Response);

                if(Response.success){
                    // empty status
                    $('#deal-status'+connectionId).empty();

                    $('.deal-btn'+connectionId).html('Deal Accepted');
                    $('.deal-btn'+connectionId).attr('disabled', true);
                    $('.deal-btn'+connectionId).removeClass('btn-success');
                    $('.deal-btn'+connectionId).addClass('bg-dark text-white');

                    // show button
                    $('.deal-btn'+connectionId).fadeIn(200);
                }
            },

            error: function (Response) {
                console.log(Response.responseText);
                $('#deal-status'+connectionId).html('Error occurred, reload page or contact the admin');
            }

        });
    });

});
