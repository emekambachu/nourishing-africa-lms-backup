$(function(){

    // get form ID
    $('[data-group]').click(function(e){

        e.preventDefault();

        let groupId = $(this).attr('id');
        let route = $(this).data('route');
        let csrf = $('meta[name="csrf-token"]').attr("content");

        $.ajax({
            type: 'GET',
            url: route,
            data : {
                'group_id': groupId,
            },
            dataType: "json",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            },

            beforeSend: function () {
                // Show spinner
                let loader = '<div class="text-center mg-b-20">' +
                    '<div class="spinner-border text-success" role="status">' +
                    '<span class="sr-only">Loading...</span>' +
                    '</div>' + '</div>'

                $('#group_info_body').html(loader);
            },

            success:function (Response){

                let contents = '<div class="main-contact-info-header pt-3">' +
                    '                            <div class="media">' +
                    '                                <div class="main-img-user">' +
                    '                                    <img alt="avatar" src="/photos/esp_groups/"'+Response.group_image+'>' +
                    '                                </div>' +
                    '                                <div class="media-body">' +
                    '                                    <h5>'+Response.group_name+'</h5>' +
                    '                                    <p></p>' +
                    '                                </div>' +
                    '                            </div>' +
                    '                            <div class="main-contact-action btn-list pt-3 pr-3">' +
                    '                                <form method="post" action="/esp/account/group/join/'+groupId+'">' +
                    '                                   <input type="hidden" name="_token" ' +
                    '                                       value="'+this.headers["X-CSRF-TOKEN"]+'">'+
                    '                                    <button type="submit" class="btn btn-success btn-rounded mr-2">' +
                    '                                        Join' +
                    '                                    </button>' +
                    '                                </form>' +
                    '                            </div>' +
                    '                        </div>' +
                    '                        <div class="main-contact-info-body p-4">' +
                    '                            <div>' +
                    '                                <h6></h6>' +
                    '                                <p>'+Response.group_description+'</p>' +
                    '                            </div>' +
                    '                        </div>';

                $('#group_info_body').html(contents);

                console.log(Response.group_name);
            },

        });
    })
});
