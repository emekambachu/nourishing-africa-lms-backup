$(function(){

    $('[data-coinvestor]').click(function(e){
        e.preventDefault();

        // Get route on div form
        console.log($('[data-coinvestor]'));

        let coInvestorId = $(this).data('coinvestor');
        let connectionId = $(this).data('connection');
        let companyId = $(this).data('company');
        let route = $(this).data('route');

        $.ajax({
            type: 'GET',
            url: route,
            data: {
                'connection': connectionId,
                'co-investor': coInvestorId,
                'company': companyId,
            },
            dataType: "json",
            cache: false,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            },

            beforeSend: function () {
                // Hide favorite button
                $('.co-investor-btn'+coInvestorId).fadeOut(200);

                // Show spinner
                let loader = '<div class="text-center mg-b-20">' +
                    '<div class="spinner-border text-success" role="status">' +
                    '<span class="sr-only">Loading...</span>' +
                    '</div>' + '</div>'
                $('#co-investor-status'+coInvestorId).html(loader);
            },

            success:function (Response){
                console.log(Response);

                $('#co-investor-status'+coInvestorId).empty();

                if(Response.request_sent){
                    $('.cancel-btn' + coInvestorId).fadeIn(200);
                }

                if(Response.delete_co_investment){
                    $('.add-btn' + coInvestorId).fadeIn(200);
                }
            },

            error: function (Response) {
                console.log(Response.responseText);
                $('#co-investor-status'+coInvestorId).html('Error occurred, reload page or contact the admin');
            }

        });
    });

});
