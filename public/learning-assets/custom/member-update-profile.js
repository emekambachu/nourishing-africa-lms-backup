$(function(){

    $('#update-email-btn').click(function(event){
        event.preventDefault();

        let currentEmail = $('input[name="current_email"]').val();
        let newEmail = $('input[name="new_email"]').val();

        if(currentEmail === newEmail){
            $('#email-update-notification').addClass('bg-danger p-1 text-white text-center border-1 na-border-radius');
            $('#email-update-notification').html('The current and new email cannot be the same');
            return false;
        }else{
            $('#email-update-notification').empty().removeClass();
        }

        if(newEmail === ''){
            $('#email-update-notification').addClass('bg-danger p-1 text-white text-center border-1 na-border-radius');
            $('#email-update-notification').html('New email field cannot be empty');
            return false;
        }else{
            $('#email-update-notification').empty().removeClass();
        }

    });

    $('#update-email-btn').on('click', function(e){

        console.log('Working');
        e.preventDefault();

        let currentEmail = $('input[name="current_email"]').val();
        let newEmail = $('input[name="new_email"]').val();

        if(currentEmail === newEmail){
            $('#email-update-notification').addClass('bg-danger p-1 text-white text-center border-1 na-border-radius');
            $('#email-update-notification').html('The current and new email cannot be the same');
            return false;
        }else{
            $('#email-update-notification').empty().removeClass();
        }

        if(newEmail === ''){
            $('#email-update-notification').addClass('bg-danger p-1 text-white text-center border-1 na-border-radius');
            $('#email-update-notification').html('New email field cannot be empty');
            return false;
        }else{
            $('#email-update-notification').empty().removeClass();
        }

        let route = $(this).data('route');

        // get all form input data and create an instance
        // let formData = new FormData(this);

        $.ajax({
            type: 'POST',
            url: route,
            data: {
                'current_email': currentEmail,
                'new_email': newEmail,
            },
            dataType: "json",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            },
            // processData: false,
            // contentType: false,
            // cache: false,

            beforeSend: function (){
                console.log('beforeSend');
                $('#update-email-btn').prop("disabled",true);
                $('#update-email-btn').html("<i class='fas fa-circle-notch fa-2x fa-spin text-white'></i>");
            },

            success:function (response){

                if(response.errors){
                    console.log('errors');
                    $.each(response.errors, function(key, val) {
                        $('#email-update-notification').addClass('bg-success p-1 text-white text-center border-1 na-border-radius');
                        $('#email-update-notification').append(val);
                    });
                }

                if(response.success){
                    console.log('success');
                    $('#update-email-btn').html("<i class='fa fa-check fa-2x'></i>");
                    $('#email-update-notification').addClass('bg-success p-1 text-white text-center border-1 na-border-radius');
                    $('#email-update-notification').html(response.success);
                }
            },

            error: function (response) {
                console.log('error');
                console.log(JSON.parse(response.responseText));
                $('#email-update-notification').addClass('bg-danger p-1 text-white text-center border-1 na-border-radius');
                $('#email-update-notification').html(JSON.parse(response.responseText));
            }
        });
    });

    $('#updateMobileBtn').click(function(event){
        event.preventDefault();

        let currentMobile = $('input[name="current_mobile"]').val();
        let newMobile = $('input[name="new_mobile"]').val();

        if(newMobile === '' || currentMobile === ''){
            $('#mobileUpdateNotification').addClass('bg-danger p-1 text-white text-center border-1 na-border-radius');
            $('#mobileUpdateNotification').html('New or current mobile field cannot be empty');
            return false;
        }else{
            $('#mobileUpdateNotification').empty().removeClass();
        }

        if(currentMobile === newMoble){
            $('#mobileUpdateNotification').addClass('bg-danger p-1 text-white text-center border-1 na-border-radius');
            $('#mobileUpdateNotification').html('The current and new mobile cannot be the same');
            return false;
        }else{
            $('#mobileUpdateNotification').empty().removeClass();
        }

    });

    $('#updateMobileForm').on('submit', function(e){

        console.log('Working');
        e.preventDefault();

        let currentMobile = $('input[name="current_mobile"]').val();
        let newMobile = $('input[name="new_mobile"]').val();

        let route = $(this).data('route');

        // get all form input data and create an instance
        let formData = new FormData(this);

        $.ajax({
            type: 'POST',
            url: route,
            data: formData,
            // data: {
            //     'current_email': currentEmail,
            //     'new_email': newEmail,
            // },
            dataType: "json",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            },
            // processData: false,
            // contentType: false,
            // cache: false,

            beforeSend: function (){
                console.log('beforeSend');
                $('#updateMobileBtn').prop("disabled",true);
                $('#updateMobileBtn').html("<i class='fas fa-circle-notch fa-2x fa-spin text-white'></i>");
            },

            success:function (response){

                if(response.errors){
                    console.log('errors');
                    $.each(response.errors, function(key, val) {
                        $('#mobileUpdateNotification').addClass('bg-success p-1 text-white text-center border-1 na-border-radius');
                        $('#mobileUpdateNotification').append(val);
                    });
                }

                if(response.success){
                    console.log('success');
                    $('#updateMobileBtn').html("<i class='fa fa-check fa-2x'></i>");
                    $('#mobileUpdateNotification').addClass('bg-success p-1 text-white text-center border-1 na-border-radius');
                    $('#mobileUpdateNotification').html(response.success);
                }
            },

            error: function (response) {
                console.log('error');
                console.log(JSON.parse(response.responseText));
                $('#mobileUpdateNotification').addClass('bg-danger p-1 text-white text-center border-1 na-border-radius');
                $('#mobileUpdateNotification').html(JSON.parse(response.responseText));
            }
        });
    });

});
