$(function(){

    // Add product to cart
    $('[data-product]').click(function(event){

        event.preventDefault();
        let route = $(this).data('route');
        let id = $(this).data('product');

        $.ajax({
            type: 'get',
            url: route,
            data: {
                'id':id
            },
            dataType: "json",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            },

            beforeSend: function (){
                $('#addToCartBtn'+id).html("<i class='fa fa-spinner fa-spin fa-2x text-white'></i>");
            },

            success:function (response){
                $('#addToCartBtn'+id).html("Add to cart");
                $('#cartNotification'+id)
                    .addClass('na-bg-light-green-2 text-dark text-center border-radius-3 width-60 aligncenter')
                    .html(response.success+", <a class='na-text-orange2' href='/supergifthampers/cart'" +
                        " target='_blank'/>view cart</a>");
                $('#cart-count').html("("+response.items+")");
            },

            error: function (response) {
                console.log(JSON.parse(response.responseText));
                $('#cartNotification'+id).addClass('bg-danger p-1 text-white text-center border-1 na-border-radius');
                $('#cartNotification'+id).html(JSON.parse(response.responseText));
            }
        });
    });


    $('[data-delete-cart]').click(function(event){
        event.preventDefault();
        let route = $(this).data('route');
        let id = $(this).data('delete-cart');

        $.ajax({
            type: 'get',
            url: route,
            data: {
                'id':id
            },
            dataType: "json",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            },

            beforeSend: function (){
                $('#removeProduct'+id).html("<i class='fa fa-spinner fa-spin fa-2x text-danger'></i>");
            },

            success:function (response){
                $('#cartRow'+id).fadeOut(500);
                $('#cartNotification').addClass('bg-danger text-white padding-5px-all').html("Item removed");
                $('#cart-count').html("("+response.items+")");
                $('#cartTotal').html(response.cart_total);
            },

            error: function (response) {
                console.log(JSON.parse(response.responseText));
                $('#cartNotification'+id).addClass('bg-danger p-1 text-white text-center border-1 na-border-radius');
                $('#cartNotification'+id).html(JSON.parse(response.responseText));
            }
        });
    });

});
