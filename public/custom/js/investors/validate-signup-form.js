$(document).ready(function(){

    // Trigger auto form pop-up
    let hash = $(location).attr('hash');
    if (hash === '#signup-form') {
        $('a.popup-with-form')[0].click();
    }

    // Start form validation
    document.getElementById("sign-up-button").addEventListener("click", function(event){

        let website = document.forms["signup-form"]["website"].value;
        // let facebook = document.forms["signup-form"]["facebook"].value;
        // let twitter = document.forms["signup-form"]["twitter"].value;
        // let instagram = document.forms["signup-form"]["instagram"].value;
        // let linkedin = document.forms["signup-form"]["linkedin"].value;

        let focusAreas = document.forms["signup-form"]["focus_areas"].value;
        let country = document.forms["signup-form"]["country"].value;
        // let companyStage = document.forms["signup-form"]["company_stage"].value;
        // let companyType = document.forms["signup-form"]["company_type"].value;

        let password = document.forms["signup-form"]["password"].value;
        let password_confirmation = document.forms["signup-form"]["password_confirmation"].value;

        // URL Validator function
        function validURL(str) {
            let pattern = new RegExp(/^(?:(?:(?:https?|ftp):)?\/\/)(?:\S+(?::\S*)?@)?(?:(?!(?:10|127)(?:\.\d{1,3}){3})(?!(?:169\.254|192\.168)(?:\.\d{1,3}){2})(?!172\.(?:1[6-9]|2\d|3[0-1])(?:\.\d{1,3}){2})(?:[1-9]\d?|1\d\d|2[01]\d|22[0-3])(?:\.(?:1?\d{1,2}|2[0-4]\d|25[0-5])){2}(?:\.(?:[1-9]\d?|1\d\d|2[0-4]\d|25[0-4]))|(?:(?:[a-z\u00a1-\uffff0-9]-*)*[a-z\u00a1-\uffff0-9]+)(?:\.(?:[a-z\u00a1-\uffff0-9]-*)*[a-z\u00a1-\uffff0-9]+)*(?:\.(?:[a-z\u00a1-\uffff]{2,})))(?::\d{2,5})?(?:[/?#]\S*)?$/i);
            return !!pattern.test(str);
        }

        if (focusAreas === "") {
            document.getElementsByName("focus_areas")[0].classList.add('na-form-input-error');
            document.getElementById("focus-area-error").
                innerHTML = "<p class='text-danger text-md-left'>Focus Area is required</p>";

            // general error notification
            document.getElementById("error-notification").
                innerHTML = "<p class='text-white text-md-center bg-danger padding-5px-all border-radius-6'>" +
                "One or more errors have been identified, check your fields</p>";

            event.preventDefault();
        }else{
            document.getElementById("focus-area-error").innerHTML = "";
            document.getElementsByName("focus_areas")[0].classList.remove('na-form-input-error');

            // general error notification
            document.getElementById("error-notification").innerHTML = "";
        }

        if (country === "") {
            document.getElementsByName("country")[0].classList.add('na-form-input-error');
            document.getElementById("country-error").
                innerHTML = "<p class='text-danger text-md-left'>Country is required</p>";

            // general error notification
            document.getElementById("error-notification").
                innerHTML = "<p class='text-white text-md-center bg-danger padding-5px-all border-radius-6'>" +
                "One or more errors have been identified, check your fields</p>";

            return false;
        }else{
            document.getElementById("country-error").innerHTML = "";
            document.getElementsByName("country")[0].classList.remove('na-form-input-error');

            // general error notification
            document.getElementById("error-notification").innerHTML = "";
        }

        // if (companyStage === "") {
        //     document.getElementsByName("company_stage")[0].classList.add('na-form-input-error');
        //     document.getElementById("company-stage-error").
        //         innerHTML = "<p class='text-danger text-md-left'>Company Stage is required</p>";
        //
        //     // general error notification
        //     document.getElementById("error-notification").
        //         innerHTML = "<p class='text-white text-md-center bg-danger padding-5px-all border-radius-6'>" +
        //         "One or more errors have been identified, check your fields</p>";
        //
        //     event.preventDefault();
        // }else{
        //     document.getElementById("company-stage-error").innerHTML = "";
        //     document.getElementsByName("company_stage")[0].classList.remove('na-form-input-error');
        //
        //     // general error notification
        //     document.getElementById("error-notification").innerHTML = "";
        // }
        //
        // if (companyType === "") {
        //     document.getElementsByName("company_type")[0].classList.add('na-form-input-error');
        //     document.getElementById("company-type-error").
        //         innerHTML = "<p class='text-danger text-md-left'>Company Type is required</p>";
        //
        //     // general error notification
        //     document.getElementById("error-notification").
        //         innerHTML = "<p class='text-white text-md-center bg-danger padding-5px-all border-radius-6'>" +
        //         "One or more errors have been identified, check your fields</p>";
        //
        //     event.preventDefault();
        // }else{
        //     document.getElementById("company-type-error").innerHTML = "";
        //     document.getElementsByName("company_type")[0].classList.remove('na-form-input-error');
        //
        //     // general error notification
        //     document.getElementById("error-notification").innerHTML = "";
        // }

        // if (website === "" && facebook === "" && twitter === "" && instagram === "" && linkedin === "") {
        //     document.getElementById("link-alert").style.display = "block";
        //
        //     // general error notification
        //     document.getElementById("error-notification").
        //         innerHTML = "<p class='text-white text-md-center bg-danger padding-5px-all border-radius-6'>" +
        //         "One or more errors have been identified, check your fields</p>";
        //
        //     event.preventDefault();
        // }else{
        //     document.getElementById("link-alert").style.display = "none";
        //
        //     // general error notification
        //     document.getElementById("error-notification").innerHTML = "";
        // }

        if (password !== password_confirmation) {
            document.getElementById("password-alert").
                innerHTML = "<p class='text-white text-md-center bg-danger padding-5px-all border-radius-6'>" +
                "Password and Confirm password does not match</p>";

            document.getElementsByName("password")[0].classList.add('na-form-input-error');
            document.getElementsByName("password_confirmation")[0].classList.add('na-form-input-error');

            // general error notification
            document.getElementById("error-notification").
                innerHTML = "<p class='text-white text-md-center bg-danger padding-5px-all border-radius-6'>" +
                "One or more errors have been identified, check your fields</p>";

            return false;
        }else{
            document.getElementById("password-alert").innerHTML = "";

            document.getElementsByName("password")[0].classList.remove('na-form-input-error');
            document.getElementsByName("password_confirmation")[0].classList.remove('na-form-input-error');

            // general error notification
            document.getElementById("error-notification").innerHTML = "";
        }

        // Check all links and validate their url
        // let links = [website, facebook, twitter, instagram, linkedin];
        //
        // for(let i=0; i < links.length; i++) {
        //     if(links[i] !== '' && validURL(links[i]) === false) {
        //
        //         // document.querySelector("#signup-form").querySelector("#invalid-url").innerHTML = "<p id='link-alert' style='display: none; background-color: #FF1635;' class='mt-1 text-white padding-5px-all text-md-center'>url is invalid</p>"
        //
        //         document.getElementById("invalid-url").
        //             innerHTML = "<p class='mt-1 text-danger text-md-center'>"+links[i]+" url is invalid</p>";
        //
        //         // general error notification
        //         document.getElementById("error-notification").
        //             innerHTML = "<p class='text-white text-md-center bg-danger padding-5px-all border-radius-6'>" +
        //             "One or more errors have been identified, check your fields</p>";
        //
        //         event.preventDefault();
        //     }else{
        //         document.getElementById("invalid-url").innerHTML = "";
        //
        //         // general error notification
        //         document.getElementById("error-notification").innerHTML = "";
        //     }
        // }

    });

    // Validate Image
    $('#signup-form input[name=image]').on('change', function(){

        let formData = new FormData();
        let file = document.getElementsByName("image")[0].files[0];

        formData.append("Filedata", file);

        let fileType = file.type.split('/').pop().toLowerCase();
        if (fileType !== "jpeg" && fileType !== "jpg" && fileType !== "png" && fileType !== "bmp") {

            document.getElementsByName("image")[0].classList.add('na-form-input-error');
            document.getElementById("image-error").
                innerHTML = "<p class='text-danger text-md-left'>Image format can only be jpg, jpeg, png, bmp</p>";

            // general error notification
            document.getElementById("error-notification").
                innerHTML = "<p class='text-white text-md-center bg-danger padding-5px-all border-radius-6'>" +
                "One or more errors have been identified, check your fields</p>";

            return false;
        }else{

            document.getElementById("image-error").innerHTML = "";

            // general error notification
            document.getElementById("error-notification").innerHTML = "";
        }

        if (file.size > 1024000) {

            document.getElementsByName("image")[0].classList.add('na-form-input-error');
            document.getElementById("image-error").
                innerHTML = "<p class='text-danger text-md-left'>Image Exceeds 1mb</p>";

            // general error notification
            document.getElementById("error-notification").
                innerHTML = "<p class='text-white text-md-center bg-danger padding-5px-all border-radius-6'>" +
                "One or more errors have been identified, check your fields</p>";

            return false;
        }else{
            document.getElementById("image-error").innerHTML = "";

            // general error notification
            document.getElementById("error-notification").innerHTML = "";
        }

        return true;
    });

    // Validate Filter
    $('#filter-ent-btn').on('click', function() {

        let country = $('#filter-ent').find('select[name="country"]').val();
        let focus_area = $('#filter-ent').find('select[name="focus_area"]').val();

        if(country === "" && focus_area === ""){

            let filterWarning = "<p class='p-2 bg-deep-pink text-white border-radius-5 text-center'>" +
                "Select a country or focus area</p>"
            $("#filter-warning").html(filterWarning);

            return false;
        }
    });

    // Social media select dropdown
    $('#social_media').on('change', function() {

        // assign variable to the selected value of select_method id
        let selected = $('#social_media').find(":selected").val()

        // Technology and Innovation
        if (selected === 'linkedin'){
            // Show show these divs
            $("#linkedin").show();

            // Enable these fields
            $("#linkedin :input").prop("disabled", false);

            // Hide Div
            $("#twitter").hide();
            $("#instagram").hide();
            $("#facebook").hide();

            // Disable Field
            // $("#twitter :input").prop("disabled", true);
            // $("#instagram :input").prop("disabled", true);
            // $("#facebook :input").prop("disabled", true);
        }

        // Podcasts and Vlogs
        if (selected === 'twitter') {
            // Show show these divs
            $("#twitter").show();

            // Enable these fields
            $("#twitter :input").prop("disabled", false);

            // Hide Div
            $("#linkedin").hide();
            $("#facebook").hide();
            $("#instagram").hide();

            // Disable Field
            // $("#linkedin :input").prop("disabled", true);
            // $("#facebook :input").prop("disabled", true);
            // $("#instagram :input").prop("disabled", true);
        }

        // E-Learning
        if(selected === 'instagram'){
            // Show these divs
            $("#instagram").show();

            // Enable these fields
            $("#instagram :input").prop("disabled", false);

            // Hide Div
            $("#twitter").hide();
            $("#linkedin").hide();
            $("#facebook").hide();

            // Disable these fields
            // $("#twitter :input").prop("disabled", true);
            // $("#linkedin :input").prop("disabled", true);
            // $("#facebook :input").prop("disabled", true);
        }

        // Data
        if(selected === 'facebook'){
            // Show these divs
            $("#facebook").show();

            // Enable these fields
            $("#facebook :input").prop("disabled", false);

            // Hide these divs
            $("#linkedin").hide();
            $("#twitter").hide();
            $("#instagram").hide();

            // Disable these fields
            // $("#linkedin :input").prop("disabled", true);
            // $("#twitter :input").prop("disabled", true);
            // $("#instagram :input").prop("disabled", true);
        }

    });
});
