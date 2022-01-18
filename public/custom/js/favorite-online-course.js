$(function(){
    // get form ID
    $('[data-favorite]').submit(function(e){
        e.preventDefault();
        // Get route on div form
        console.log($('[data-favorite]'))
        let formId = $(this).attr('id')
        let route = $(this).data('route');
        $.ajax({
            type: 'POST',
            url: route,
            data: $(this).serialize(),
            dataType: "json",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            },

            beforeSend: function () {
                // Hide favorite button
                $('#favorite-button'+formId).fadeOut('1000');

                // Show spinner
                let loader = "<button id='favorite-button"+formId+"' type='submit' " +
                    "class='btn border-radius-4 text-extra-small na-text-pink'>" +
                    "<i class='fa fa-spinner'></i></button>"

                $("#favorite-button"+formId).replaceWith(loader);
            },

            success:function (Response){
                console.log(Response);

                if(Response.success){
                    console.log("#favorite-button"+formId);

                    let addedToFavorite = "<button id='favorite-button"+formId+"' type='submit' " +
                        "class='btn border-radius-4 text-extra-small na-text-pink'>" +
                        "<i class='fa fa-heart'></i>Un-Favorite</button>"

                    $("#favorite-button"+formId).replaceWith(addedToFavorite);
                }

                if(Response.error){
                    console.log("#favorite-button"+formId);

                    let removeFromFavorite = "<button id='favorite-button"+formId+"' type='submit' " +
                        "class='btn border-radius-4 text-extra-small na-text-pink'>" +
                        "<i class='fa fa-heart'></i>Favorite</button>"

                    $("#favorite-button"+formId).replaceWith(removeFromFavorite);
                }
            },

        });
    })
});
