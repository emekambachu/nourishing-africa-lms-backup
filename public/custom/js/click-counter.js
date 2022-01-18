$(function(){
    // get form ID
    $('[data-click]').click(function(e){

        // e.preventDefault();
        // console.log($('[data-click]'));

        let route = $(this).data('route');
        let itemId = $(this).attr('id');
        let type = $(this).data('type');

        $.ajax({
            type: 'GET',
            url: route,
            data : {
                'type': type,
                'item_id': itemId,
            },
            dataType: "json",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            },

            success:function (Response){
                if(Response.success){
                    console.log('success '+type +'-'+itemId);
                }
            },

        });
    })
});
