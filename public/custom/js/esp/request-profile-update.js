$(document).ready(function() {

    $("#request_update_btn").on('click', function (event) {

        let dob = $('#request_update_form').find('input[name="dob"]').val();
        let mobile = $('#request_update_form').find('input[name="mobile"]').val();
        let gender = $('#request_update_form').find('select[name="gender"]').val();
        let business = $('#request_update_form').find('input[name="business"]').val();
        let business_location = $('#request_update_form').find('select[name="business_location"]').val();
        let business_address = $('#request_update_form').find('input[name="business_address"]').val();
        let reason = $('#request_update_form').find('textarea[name="reason"]').val();

        let business_reg = $('#request_update_form').find('input[name="business_reg"]').val();
        let tax_id = $('#request_update_form').find('input[name="tax_id"]').val();
        let nafdac = $('#request_update_form').find('input[name="nafdac"]').val();
        let business_lga = $('#request_update_form').find('input[name="business_lga"]').val();
        let headcount = $('#request_update_form').find('input[name="headcount"]').val();
        let male = $('#request_update_form').find('input[input="male"]').val();
        let female = $('#request_update_form').find('input[name="female"]').val();
        let fulltime = $('#request_update_form').find('input[name="fulltime"]').val();

        if (!dob && !mobile && !gender && !business && !business_location && !business_address &&!business_reg && !tax_id && !nafdac && !business_lga 
            && !headcount && !male && !female && !fulltime){
            let validationAlert = "<p style='width: 60%;' class='bg-danger p-2 text-center text-white'>" +
                "Atleast one field must be filled</p>"
            $("#validation-alert").html(validationAlert);
            return false;
        } else {
            $("#validation-alert").empty();
        }

        if(reason === ''){
            let validationAlert = "<p style='width: 60%;' class='bg-danger p-2 text-center text-white'>" +
                "Reason for change cannot be empty</p>"
            $("#validation-alert").html(validationAlert);
            return false
        }else{
            $("#validation-alert").empty();
        }

    });
});
