$(function(){

    $('#verify-email-form').submit(function(event){

        event.preventDefault();
        let route = $(this).data('route');

        // get all form input data and create an instance
        // let formData = new FormData(this);
        // formData.append('chat_file', $('#file-upload')[0].files[0]);
        // formData.append('connection_id', $(this).data('connection'));

        $.ajax({
            type: 'POST',
            url: route,
            // data: formData,
            processData: false,
            contentType: false,
            dataType: "json",
            cache: false,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            },

            beforeSend: function (){
                $('#verify-email-btn').prop("disabled",true);
                $('#verify-email-btn').html("<i class='fas fa-circle-notch fa-2x fa-spin text-white'></i>");
            },

            success:function (response){
                $('#verify-email-btn').html("<i class='fa fa-check fa-2x'></i>");
                $('#verify-email-notification').addClass('bg-success p-1 text-white text-center border-1 na-border-radius');
                $('#verify-email-notification').html('Email verification sent, please check your email');
            },

            error: function (response) {
                console.log(response.responseText);
                $('#verify-email-notification').addClass('bg-danger p-1 text-white text-center border-1 na-border-radius');
                $('#verify-email-notification').html('Error sending message');
            }
        });
    });

    // on file upload
    $('#primary-company-certificate').change(function(){
        // Validate form fields
        let companyDoc = $(this).prop('files')[0];
        if(companyDoc){
            let ao_ext = $(this).val().split('.').pop().toLowerCase();
            if($.inArray(ao_ext, ['jpg', 'png', 'jpeg', 'gif', 'pdf']) === -1) {
                let companyDocNotification = "<p class='bg-danger p-1 text-center text-white na-border-radius'>" +
                    "Unsupported file format</p>"
                $("#verify-company-notification").html(companyDocNotification);
                return false;
            }else{
                $("#verify-company-notification").empty();
            }

            if(companyDoc.size > 2024000){
                let companyDocNotification = "<p class='bg-danger p-1 text-center text-white na-border-radius'>" +
                    "File must not be more than 2 mb</p>"
                $("#verify-company-notification").html(companyDocNotification);
                return false;
            }else{
                $("#verify-company-notification").empty();
            }
        }
    });


    $('#verify-company-form').submit(function(event){

        event.preventDefault();
        let route = $(this).data('route');

        // get all form input data and create an instance
        let formData = new FormData(this);
        formData.append('primary_company_certificate', $('#primary-company-certificate')[0].files[0]);

        $.ajax({
            type: 'POST',
            url: route,
            data: formData,
            processData: false,
            contentType: false,
            dataType: "json",
            cache: false,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            },

            beforeSend: function (){
                $('#verify-company-btn').prop("disabled",true);
                $('#verify-company-btn').html("<i class='fas fa-circle-notch fa-2x fa-spin text-white'></i>");
            },

            success:function (response){
                $('#verify-company-btn').html("<i class='fa fa-check fa-2x'></i>");
                $('#verify-company-notification').addClass('bg-success p-1 text-white text-center border-1 na-border-radius');
                $('#verify-company-notification').html('Thank you for submitting your proof of company registration, we assure that your document is safe with us and being used for verification purposes');
                $('#primary-company-registration').prop('disabled', true);
                $('#primary-company-certificate').prop('disabled', true);
            },

            error: function (response) {
                console.log(response.responseText);
                $('#verify-company-notification').addClass('bg-danger p-1 text-white text-center border-1 na-border-radius');
                $('#verify-company-notification').html('Error sending message');
            }
        });
    });

    // Generate OTP
    $('#get-otp-btn').click(function(event){

        event.preventDefault();
        let route = $(this).data('route');
        let mobile = $('input[name="mobile"]').val();

        $.ajax({
            type: 'POST',
            url: route,
            data: {
                'mobile': mobile
            },
            dataType: "json",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            },

            beforeSend: function (){
                $('#get-otp-btn').prop("disabled",true);
                $('#get-otp-btn').html("<i class='fas fa-circle-notch fa-2x fa-spin text-white'></i>");
            },

            success:function (response){
                $('#get-otp-btn').html("<i class='fa fa-check fa-2x'></i>");
                $('#verifyOtpBtn').fadeIn(200);
                $('#verify-mobile-notification').addClass('bg-success p-1 text-white text-center border-1 na-border-radius');
                $('#verify-mobile-notification').html(response.success);
            },

            error: function (response) {
                console.log(JSON.parse(response.responseText));
                $('#get-otp-btn').prop("disabled",false);
                $('#get-otp-btn').html("Get OTP");
                $('#verify-mobile-notification').addClass('bg-danger p-1 text-white text-center border-1 na-border-radius');
                $('#verify-mobile-notification').html('Unable to receive OTP at this time, please try again later');
            }
        });
    });

    // Verify mobile OTP
    $('#verifyOtpBtn').click(function(event){

        event.preventDefault();
        let route = $(this).data('route');
        // let formData = new FormData(this);

        let otp = $('input[name="otp"]').val();
        let mobile = $('input[name="mobile"]').val();
        let userId = $('input[name="user_id"]').val();

        if(otp === ''){
            $('#verify-mobile-notification').addClass('bg-warning p-1 text-white text-center border-1 na-border-radius');
            $('#verify-mobile-notification').html('Include OTP');
            return false;
        }

        $.ajax({
            type: 'POST',
            url: route,
            data: {
                'otp': otp,
                'mobile': mobile,
                'user_id': userId
            },
            dataType: "json",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            },

            beforeSend: function (){
                $('#verifyOtpBtn').prop("disabled",true);
                $('#verifyOtpBtn').html("<i class='fas fa-circle-notch fa-2x fa-spin text-white'></i>");
            },

            success:function (response){

                if(response.success){
                    $('#verifyOtpBtn').html("<i class='fa fa-check fa-2x'></i>");
                    $('input[name="otp"]').prop('disabled', true);
                    $('#verify-mobile-notification').addClass('bg-success p-1 text-white text-center border-1 na-border-radius');
                    $('#verify-mobile-notification').html(response.success);
                }
                if(response.invalid_otp){
                    $('#verifyOtpBtn').prop("disabled",false);
                    $('#verifyOtpBtn').html("Verify OTP");
                    $('#verify-mobile-notification').addClass('bg-warning p-1 text-white text-center border-1 na-border-radius');
                    $('#verify-mobile-notification').html(response.invalid_otp);
                }

            },

            error: function (response){
                console.log(JSON.parse(response.responseText));
                $('#verifyOtpBtn').prop("disabled",false);
                $('#verifyOtpBtn').html("Verify OTP");
                $('#verify-mobile-notification').addClass('bg-danger p-1 text-white text-center border-1 na-border-radius');
                $('#verify-mobile-notification').html('Error encountered, try again later');
            }
        });
    });

});
