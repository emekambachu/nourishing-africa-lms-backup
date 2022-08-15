var input = document.querySelector("#phone-part-1");
var iti;
try {
    this.iti = window.intlTelInput(input, {
        initialCountry: "auto",
        geoIpLookup: function (callback) {
            $.get("https://ipinfo.io", function () {}, "jsonp").always(
                function (resp) {
                    var countryCode =
                        resp && resp.country ? resp.country : "ng";
                    callback(countryCode);
                }
            );
        },
        autoPlaceholder: "aggressive",
        customPlaceholder: function (
            selectedCountryPlaceholder,
            selectedCountryData
        ) {
            return "e.g. " + selectedCountryPlaceholder;
        },
        onlyCountries: [
            "us",
            "gb",
            "dz",
            "ao",
            "bj",
            "bw",
            "bf",
            "bi",
            "cm",
            "cv",
            "cf",
            "td",
            "cd",
            "cg",
            "ci",
            "dj",
            "eg",
            "gq",
            "er",
            "et",
            "ga",
            "gm",
            "gh",
            "gn",
            "gw",
            "ke",
            "ls",
            "lr",
            "ly",
            "mg",
            "mw",
            "ml",
            "mr",
            "mu",
            "ma",
            "mz",
            "na",
            "ne",
            "ng",
            "rw",
            "rs",
            "sy",
            "rc",
            "ri",
            "rw",
            "st",
            "sn",
            "sc",
            "sl",
            "so",
            "za",
            "ss",
            "sd",
            "sz",
            "tz",
            "tg",
            "tn",
            "ug",
            "zm",
            "zw",
        ],
        utilsScript: "../js/utils.js?1613236686837", // just for formatting/placeholders etc
    });
} catch (err) {
    console.log(err.message);
}

function preliminaryQuestion(question, val) {
    var q1;
    var q2;
    var q3;
    var q4;
    if (question == "q1") {
        q1 = val;

        if (q1 == "yes") {
            $("#stage-area-checkbox-1").removeClass(
                "stage-area-checkbox-active"
            );
            $("#stage-area-checkbox-1").addClass("stage-area-checkbox");
            $("#stage-area-checkbox-2").removeClass("stage-area-checkbox");
            $("#stage-area-checkbox-2").addClass("stage-area-checkbox-active");
            $(".progress-bar").addClass("ten");
        } else {
            $("#stage-area-checkbox-1").removeClass(
                "stage-area-checkbox-active"
            );
            $("#stage-area-checkbox-1").addClass("stage-area-checkbox");
            $("#stage-area-checkbox-backhome").removeClass("d-none");
        }
    }
    if (question == "q2") {
        q2 = val;

        if (q2 == "yes") {
            $("#stage-area-checkbox-2").removeClass(
                "stage-area-checkbox-active"
            );
            $("#stage-area-checkbox-2").addClass("stage-area-checkbox");
            $("#stage-area-checkbox-3").removeClass("stage-area-checkbox");
            $("#stage-area-checkbox-3").addClass("stage-area-checkbox-active");
            $(".progress-bar").removeClass("ten");
            $(".progress-bar").addClass("twenty");
        } else {
            $("#stage-area-checkbox-2").removeClass(
                "stage-area-checkbox-active"
            );
            $("#stage-area-checkbox-2").addClass("stage-area-checkbox");
            $("#stage-area-checkbox-backhome").removeClass("d-none");
        }
    }
    if (question == "q3") {
        q3 = val;

        if (q3 >= "25" && q3 <= "40") {
            $("#dob-part-1-clone").val(q3);
            $("#stage-area-checkbox-3").removeClass(
                "stage-area-checkbox-active"
            );
            $("#stage-area-checkbox-3").addClass("stage-area-checkbox");
            $("#stage-area-part-1").addClass("d-none");
            $("#stage-area-checkbox-1-form").addClass("d-none");
            $("#indicator2").removeClass("d-none");
            $("#stages-div").removeClass("d-none");
            $("#card-def-head").addClass("pb-1");
            $(".progress-bar").removeClass("twenty");
            $(".progress-bar").addClass("thirty");
        } else {
            $("#stage-area-checkbox-3").removeClass(
                "stage-area-checkbox-active"
            );
            $("#stage-area-checkbox-3").addClass("stage-area-checkbox");
            $("#stage-area-checkbox-backhome").removeClass("d-none");
        }

        //$('#stage-area-checkbox-4').removeClass('stage-area-checkbox');
        //$('#stage-area-checkbox-4').addClass('stage-area-checkbox-active');
    }
    if (question == "q4") {
        q4 = val;
        $("#stage-area-checkbox-4").removeClass("stage-area-checkbox-active");
        $("#stage-area-checkbox-4").addClass("stage-area-checkbox");
    }

    if (
        q1 == "yes" &&
        q2 == "yes" &&
        q3 == "yes" &&
        (q4 == "yes" || q4 == "no")
    ) {
        $("#info-text").text("Sign Up");
        $("#stage-area-checkbox-intro").removeClass("d-none");
    } else if (
        question === "q4" &&
        (q1 === "no" || q2 === "no" || q3 === "no") &&
        (q4 === "yes" || q4 === "no")
    ) {
        $("#stage-area-checkbox-backhome").removeClass("d-none");
    }
}

function CompanyLegal(val) {
    if (val == "1") {
        $("#legalPane1").removeClass("d-none");
        $("#legalPane2").removeClass("d-none");
    } else {
        $("#legalPane1").addClass("d-none");
        $("#legalPane2").addClass("d-none");
        document.getElementById("registration-number-part-2").value = "";
        document.getElementById("registration-number-doc-part-2").value = "";

        $("#registration-number-part-2").removeClass("is-invalid");
        $("#registration-number-part-2-fb").removeClass("invalid-feedback");
        $("#registration-number-part-2").removeClass("invalid");
        $("#registration-number-part-2-fb").removeClass("valid-feedback");
        $("#registration-number-part-2-fb").text("");
    }
}

function OtherLocation(elem) {
    if (elem.value == "others") {
    }
}

function BusinessAssociation(val) {
    if (val == "1") {
        $("#baPane").removeClass("d-none");
    } else {
        $("#baPane").addClass("d-none");
        document.getElementById("business-association-name-part-2").value = "";

        $("#business-association-name-part-2").removeClass("is-invalid");
        $("#business-association-name-part-2-fb").removeClass(
            "invalid-feedback"
        );
        $("#business-association-name-part-2").removeClass("invalid");
        $("#business-association-name-part-2-fb").removeClass("valid-feedback");
        $("#business-association-name-part-2-fb").text("");
    }
}

function otherDiv(value, div, clone) {
    if (value == "Others") {
        $("#" + div).removeClass("d-none");
    } else {
        $("#" + div).addClass("d-none");
    }
    $("#" + clone).val(value);
}

function SignUp() {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    $("#membership-form").submit();
}

var name;
var lname;
var fname;
var email;
var id_card;
var confirm_email;
var dob;
var phone;
var state_origin;
var state_residence;
var education_level;
var gender;
var globalBool;
var password;
var password_confirmation;

function isEmpty(str) {
    return !str || str.length === 0 || /^\s*$/.test(str);
}

function emailExist(email) {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $.ajax({
        url: "/register/confirm-yedp-email",
        type: "POST",
        data: { email: email },
        timeout: 5000,
        beforeSend: function () {
            $("#email-part-1-fb").text("Validating email, please wait ...");
        },
        success: function (data) {
            const result = data["result"];
            $("#email-part-1-fb").text("");

            if (result == "exist") {
                invalidFeedbackPart("1", "email", "Email Address is taken");
                invalidFeedbackPart("1", "confirm-email", "This is required");
                $("#myModal").modal();
                $("#email-part-1").val("");
                $("#confirm-email-part-1").val("");
            } else {
                validFeedbackPart("1", "email");
                validFeedbackPart("1", "confirm-email");
                $("#stage-link-1").addClass("stage-link");
                $("#stage-link-1").removeClass("stage-link-active");
                $("#stage-link-icon-1").removeClass("d-none");
                $("#indicator2").addClass("d-none");

                $("#stage-link-2").addClass("stage-link-active");
                $("#stage-link-2").removeClass("stage-link");
                $("#indicator3").removeClass("d-none");
                $(".progress-bar").removeClass("thirty");
                $(".progress-bar").addClass("fifty");
                $("html, body").animate(
                    {
                        scrollTop: $("#myAnchor").offset().top,
                    },
                    500
                );
            }
        },
        error: function (e, textStatus) {
            $("#myModal").modal();
            console.log(e);
            invalidFeedbackPart(
                "1",
                "email",
                "Sorry, there was an error verifying your email address, please check your internet connection and refresh your browser to try again."
            );
            //$('#email-part-1-fb').text('Sorry, there was an error verifying your email address, please refresh your browser and try again.');
        },
    });
}

function processFile(document) {
    if (document) {
        let doc_ext = document.value.split(".").pop().toLowerCase();
        if (
            $.inArray(doc_ext, ["jpg", "jpeg", "png", "pdf", "doc", "docx"]) ===
            -1
        ) {
            let validateExt =
                "<p class='bg-danger p-2 text-center text-white'>" +
                "Must be a JPG/JPEG/PNG/PDF/DOC/DOCX file</p>";
            $("#" + document.id + "-fb").html(validateExt);
            document.value = "";
            return false;
        } else {
            $("#" + document.id + "-fb").empty();
        }
    }

    // Validate Size
    if (document.files[0].size > 3024000) {
        let validateSize =
            "<p class='bg-danger p-2 text-center text-white'>" +
            "File must not be more than 3mb</p>";
        $("#" + document.id + "-fb").html(validateSize);
        document.value = "";
        return false;
    } else {
        $("#" + document.id + "-fb").empty();
    }
}

function processFile2(document) {
    if (document) {
        let doc_ext = document.value.split(".").pop().toLowerCase();
        if ($.inArray(doc_ext, ["jpg", "jpeg", "png"]) === -1) {
            let validateExt =
                "<p class='bg-danger p-2 text-center text-white'>" +
                "Must be a JPG/JPEG/PNG file</p>";
            $("#" + document.id + "-fb").html(validateExt);
            document.value = "";
            return false;
        } else {
            $("#" + document.id + "-fb").empty();
        }
    }

    // Validate Size
    if (document.files[0].size > 1024000) {
        let validateSize =
            "<p class='bg-danger p-2 text-center text-white'>" +
            "File must not be more than 1mb</p>";
        $("#" + document.id + "-fb").html(validateSize);
        document.value = "";
        return false;
    } else {
        $("#" + document.id + "-fb").empty();
    }
}

function invalidFeedbackPart(part, id, msg) {
    $("#" + id + "-part-" + part).addClass("is-invalid");
    $("#" + id + "-part-" + part).removeClass("is-valid");
    $("#" + id + "-part-" + part + "-fb").addClass("invalid-feedback");
    $("#" + id + "-part-" + part + "-fb").removeClass("valid-feedback");
    $("#" + id + "-part-" + part + "-fb").text(msg);
}

function validFeedbackPart(part, id) {
    $("#" + id + "-part-" + part).addClass("is-valid");
    $("#" + id + "-part-" + part).removeClass("is-invalid");
    $("#" + id + "-part-" + part + "-fb").addClass("valid-feedback");
    $("#" + id + "-part-" + part + "-fb").removeClass("invalid-feedback");
    $("#" + id + "-part-" + part + "-fb").text("Looks good!");
}

function validFeedbackSocial(part, id) {
    $("#" + id + "-part-" + part).removeClass("is-invalid");
    $("#" + id + "-part-" + part + "-fb").removeClass("invalid-feedback");
    $("#" + id + "-part-" + part + "-fb").text("");
}

function is_url(str) {
    regexp =
        /^(?:(?:https?|ftp):\/\/)?(?:(?!(?:10|127)(?:\.\d{1,3}){3})(?!(?:169\.254|192\.168)(?:\.\d{1,3}){2})(?!172\.(?:1[6-9]|2\d|3[0-1])(?:\.\d{1,3}){2})(?:[1-9]\d?|1\d\d|2[01]\d|22[0-3])(?:\.(?:1?\d{1,2}|2[0-4]\d|25[0-5])){2}(?:\.(?:[1-9]\d?|1\d\d|2[0-4]\d|25[0-4]))|(?:(?:[a-z\u00a1-\uffff0-9]-*)*[a-z\u00a1-\uffff0-9]+)(?:\.(?:[a-z\u00a1-\uffff0-9]-*)*[a-z\u00a1-\uffff0-9]+)*(?:\.(?:[a-z\u00a1-\uffff]{2,})))(?::\d{2,5})?(?:\/\S*)?$/;
    if (regexp.test(str.toLowerCase())) {
        return true;
    } else {
        return false;
    }
}

function referralevent() {
    var val = $("#referral-type-part-3").val();
    if (
        val == "other" ||
        val == "From another organisation" ||
        val == "Invitation from a African Food Changemakers Team Member"
    ) {
        $("#referred_by_suffix_part").removeClass("d-none");
    } else {
        $("#referred_by_suffix_part").addClass("d-none");
    }
}

function disabilityChange() {
    var val = $("#disabilities-part-3").val();
    if (val == "1") {
        $("#disabilityPane").removeClass("d-none");
    } else {
        $("#disabilityPane").addClass("d-none");

        $("#disability-type-part-3").removeClass("is-invalid");
        $("#disability-type-part-3-fb").removeClass("invalid-feedback");
        $("#disability-type-part-3").removeClass("invalid");
        $("#disability-type-part-3-fb").removeClass("valid-feedback");
        $("#disability-type-part-3-fb").text("");
    }
}

function ValidateEmail(mail) {
    var mailformat =
        /(?:[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*|"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])/;
    if (mail.match(mailformat)) {
        //alert("Valid email address!");
        return true;
    } else {
        return false;
    }
}

function phonenumber(inputtxt) {
    var phoneno =
        /^\+?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/;
    if (inputtxt.match(phoneno)) {
        return true;
    } else {
        return false;
    }
}

function stagecontentpart1form() {
    event.preventDefault();
    var boolvalue = 0;

    this.lname = $("#lname-part-1").val();
    if (isEmpty(this.lname)) {
        invalidFeedbackPart("1", "lname", "Surname is required!");
        boolvalue += 1;
    } else {
        validFeedbackPart("1", "lname");
    }

    this.fname = $("#fname-part-1").val();
    if (isEmpty(this.fname)) {
        invalidFeedbackPart("1", "fname", "First name is required!");
        boolvalue += 1;
    } else {
        validFeedbackPart("1", "fname");
    }

    this.phone = $("#phone-part-1").val();
    if (isEmpty(this.phone)) {
        $("#phone-part-1").removeClass("is-invalid");
        $("#phone-part-1-fb").removeClass("invalid-feedback");
        $("#phone-part-1-fb").text("");
        invalidFeedbackPart("1", "phone", "Phone is required!");
        boolvalue += 1;
    } else {
        // here, the index maps to the error code returned from getValidationError - see readme
        var errorMap = [
            "Invalid number",
            "Invalid country code",
            "Too short",
            "Too long",
            "Invalid number",
        ];

        if (this.input.value.trim()) {
            try {
                if (this.iti.isValidNumber()) {
                    validFeedbackPart("1", "phone");
                    $("#phone-part-1-fb").addClass("text-success");
                    $("#phone-part-1-fb").removeClass("text-danger");
                    var number = iti.getNumber(
                        intlTelInputUtils.numberFormat.E164
                    );
                    $("#phone-part-1-clone").val(number);
                } else {
                    var errorCode = this.iti.getValidationError();
                    $("#phone-part-1-fb").removeClass("text-success");
                    $("#phone-part-1-fb").addClass("text-danger");
                    if (
                        this.phone.length < 11 &&
                        this.iti.getSelectedCountryData().name == "Nigeria"
                    ) {
                        //boolvalue += 1;
                        invalidFeedbackPart(
                            "1",
                            "phone",
                            "Warning: Incomplete number"
                        );
                    } else {
                        invalidFeedbackPart(
                            "1",
                            "phone",
                            "Warning: " + errorMap[errorCode]
                        );
                    }
                }
            } catch (err) {
                console.log(err.message);
            }
        }
    }

    this.dob = $("#dob-part-1").val();
    if (isEmpty(this.dob)) {
        boolvalue += 1;
        invalidFeedbackPart("1", "dob", "Date Of Birth is required");
    } else {
        validFeedbackPart("1", "dob");
    }

    this.state_origin = $("#state-origin-part-1").val();
    if (isEmpty(this.state_origin)) {
        invalidFeedbackPart("1", "state-origin", "State of origin is required");
        boolvalue += 1;
    } else {
        validFeedbackPart("1", "state-origin");
    }

    this.state_residence = $("#state-residence-part-1").val();
    if (isEmpty(this.state_residence)) {
        invalidFeedbackPart(
            "1",
            "state-residence",
            "State of residence is required"
        );
        boolvalue += 1;
    } else {
        validFeedbackPart("1", "state-residence");
    }

    this.gender = $("#gender-part-1").val();
    if (isEmpty(this.gender)) {
        invalidFeedbackPart("1", "gender", "Gender is required");
        boolvalue += 1;
    } else {
        validFeedbackPart("1", "gender");
    }

    this.education_level = $("#education-level-part-1").val();

    if (isEmpty(this.education_level)) {
        invalidFeedbackPart(
            "1",
            "education-level",
            "Higest level of education is required"
        );
        boolvalue += 1;
    } else {
        validFeedbackPart("1", "education-level");
    }

    this.password = $("#password-part-1").val();
    if (isEmpty(this.password)) {
        invalidFeedbackPart("1", "password", "Password is required");
        boolvalue += 1;
    } else {
        if (this.password.length < 6) {
            invalidFeedbackPart(
                "1",
                "password",
                "Minimum of six characters is required"
            );
            boolvalue += 1;
        } else {
            validFeedbackPart("1", "password");
        }
    }

    this.password_confirmation = $("#password-confirmation-part-1").val();
    if (isEmpty(this.password_confirmation)) {
        invalidFeedbackPart(
            "1",
            "password-confirmation",
            "Password confirmation is required"
        );
        boolvalue += 1;
    } else {
        if (this.password_confirmation.length < 6) {
            invalidFeedbackPart(
                "1",
                "password-confirmation",
                "Minimum of six characters is required"
            );
            boolvalue += 1;
        } else {
            validFeedbackPart("1", "password-confirmation");
        }
    }

    if (
        !isEmpty(this.password) &&
        !isEmpty(this.password_confirmation) &&
        this.password.length >= 6 &&
        this.password_confirmation.length >= 6
    ) {
        if (this.password === this.password_confirmation) {
            validFeedbackPart("3", "password");
            validFeedbackPart("3", "password-confirmation");
        } else {
            invalidFeedbackPart(
                "3",
                "password-confirmation",
                "Password does not match"
            );
            invalidFeedbackPart("3", "password", "Password does not match");
            boolvalue += 1;
        }
    }

    this.email = $("#email-part-1").val();
    if (isEmpty(this.email)) {
        invalidFeedbackPart("1", "email", "Email is required");
        boolvalue += 1;
    } else {
        if (!ValidateEmail(this.email)) {
            invalidFeedbackPart("1", "email", "Invalid Email Address!");
            boolvalue += 1;
        } else {
            validFeedbackPart("1", "email");
        }
    }

    this.confirm_email = $("#confirm-email-part-1").val();
    if (isEmpty(this.confirm_email)) {
        invalidFeedbackPart(
            "1",
            "confirm-email",
            "Confirm email field is required"
        );
        boolvalue += 1;
    } else {
        validFeedbackPart("1", "confirm-email");
        if (!ValidateEmail(this.confirm_email)) {
            invalidFeedbackPart("1", "confirm-email", "Invalid Email Address!");
            boolvalue += 1;
        } else if (this.email !== this.confirm_email) {
            invalidFeedbackPart(
                "1",
                "confirm-email",
                "Email Addresses does not match!"
            );
            boolvalue += 1;
        } else {
            if (boolvalue == 0) {
                emailExist(this.confirm_email);
            }
        }
    }

    if (boolvalue > 0) {
        $("#myModal").modal();
    }
}

function backstagecontentpart1form() {
    $("#stage-link-1").removeClass("stage-link");
    $("#stage-link-1").addClass("stage-link-active");
    $("#indicator2").removeClass("d-none");

    $("#stage-link-2").removeClass("stage-link-active");
    $("#stage-link-2").addClass("stage-link");
    $("#indicator3").addClass("d-none");
    $("html, body").animate(
        {
            scrollTop: $("#myAnchor").offset().top,
        },
        500
    );
}

var business_name;
var registering_as;
var busstop_landmark;
var biz_location;
var value_chain;
var business_running;
var reg_number;
var business_association;
var business_association_name;
var referral_type;
var referral_other;
var vc_other;
var loc_other;
var fa_other;
var br_other;
var reg_number_doc;
var business_address;
var company_legal;
var company_type;
var focus_area;
var company_stage;
var tags;
var company_description;
var product_capacity;
var website;
var def_social_media_link;
var def_social_media_link_2;
var def_social_media_link_3;
var def_social_media_link_4;

function stagecontentpart2form() {
    event.preventDefault();
    var boolvalue = 0;

    this.registering_as = $("#registering-as-part-2").val();
    if (isEmpty(this.registering_as)) {
        invalidFeedbackPart("2", "registering-as", "This field is required");
        boolvalue += 1;
    } else {
        validFeedbackPart("2", "registering-as");
    }

    this.business_name = $("#business-name-part-2").val();
    if (isEmpty(this.business_name)) {
        invalidFeedbackPart("2", "business-name", "Business name is required");
        boolvalue += 1;
    } else {
        validFeedbackPart("2", "business-name");
    }

    this.business_address = $("#business-address-part-2").val();
    if (isEmpty(this.business_address)) {
        invalidFeedbackPart(
            "2",
            "business-address",
            "Business address is required"
        );
        boolvalue += 1;
    } else {
        validFeedbackPart("2", "business-address");
    }

    /*this.busstop_landmark = $('#bus-stop-landmark-part-2').val();
    if(isEmpty(this.busstop_landmark)){
        invalidFeedbackPart('2','bus-stop-landmark', 'Bus stop landmark is required');
        boolvalue += 1;
    }else{
        validFeedbackPart('2','bus-stop-landmark');
    }*/

    this.biz_location = $("#location-part-2").val();
    if (isEmpty(this.biz_location)) {
        invalidFeedbackPart("2", "location", "Location is required");
        boolvalue += 1;
    } else {
        validFeedbackPart("2", "location");
    }

    this.loc_other = $("#loc-other-part-2").val();
    if (isEmpty(this.loc_other)) {
        if (this.biz_location == "Others") {
            invalidFeedbackPart("2", "loc-other", "This field is required");
            boolvalue += 1;
        } else {
            //$('#value-chain-part-2-clone').val(this.vc_other);
            $("#loc-other-part-2").removeClass("is-invalid");
            $("#loc-other-part-2-fb").removeClass("invalid-feedback");
        }
    } else {
        $("#loc-other-part-2-clone").val(this.loc_other);
        validFeedbackPart("2", "loc-other");
    }

    this.value_chain = $("#value-chain-part-2").val();
    if (isEmpty(this.value_chain)) {
        invalidFeedbackPart("2", "value-chain", "Value chain is required");
        boolvalue += 1;
    } else {
        validFeedbackPart("2", "value-chain");
    }

    this.vc_other = $("#vc-other-part-2").val();
    if (isEmpty(this.vc_other)) {
        if (this.value_chain == "Others") {
            invalidFeedbackPart("2", "vc-other", "This field is required");
            boolvalue += 1;
        } else {
            //$('#value-chain-part-2-clone').val(this.vc_other);
            $("#vc-other-part-2").removeClass("is-invalid");
            $("#vc-other-part-2-fb").removeClass("invalid-feedback");
        }
    } else {
        $("#value-chain-part-2-clone").val(this.vc_other);
        validFeedbackPart("2", "vc-other");
    }

    this.focus_area = $("#focus-area-part-2").val();
    if (isEmpty(this.focus_area)) {
        invalidFeedbackPart("2", "focus-area", "Focus area is required");
        boolvalue += 1;
    } else {
        validFeedbackPart("2", "focus-area");
    }

    this.fa_other = $("#fa-other-part-2").val();
    if (isEmpty(this.fa_other)) {
        if (this.focus_area == "Others") {
            invalidFeedbackPart("2", "fa-other", "This field is required");
            boolvalue += 1;
        } else {
            //$('#focus-area-part-2-clone').val(this.fa_other);
            $("#fa-other-part-2").removeClass("is-invalid");
            $("#fa-other-part-2-fb").removeClass("invalid-feedback");
        }
    } else {
        $("#focus-area-part-2-clone").val(this.fa_other);
        validFeedbackPart("2", "fa-other");
    }

    /*this.product_capacity = $('#prod-cap-part-2').val();
    if(isEmpty(this.product_capacity)){
        invalidFeedbackPart('2','prod-cap', 'This field is required');
        boolvalue += 1;
    }else{
        validFeedbackPart('2','prod-cap');
    }

    this.business_running = $('#business-running-part-2').val();
    if(isEmpty(this.business_running)){
        invalidFeedbackPart('2','business-running', 'This field is required');
        boolvalue += 1;
    }else{
        validFeedbackPart('2','business-running');
    }

    this.br_other = $('#br-other-part-2').val();
    if(isEmpty(this.br_other)){
        if(this.business_running == "Others"){
            invalidFeedbackPart('2','br-other', 'This field is required');
            boolvalue += 1;
        }else{
            //$('#business-running-part-2-clone').val(this.br_other);
            $('#br-other-part-2').removeClass('is-invalid');
            $('#br-other-part-2-fb').removeClass('invalid-feedback');
        }
    }else{
        $('#business-running-part-2-clone').val(this.br_other);
        validFeedbackPart('2','br-other');
    } */

    this.company_legal = $("#company-legal-part-2").val();
    if (isEmpty(this.company_legal)) {
        invalidFeedbackPart("2", "company-legal", "This field is required");
        boolvalue += 1;
    } else {
        validFeedbackPart("2", "company-legal");
    }

    /*this.reg_number = $('#registration-number-part-2').val();
    if(isEmpty(this.reg_number)){
        if(this.company_legal == "1"){
            invalidFeedbackPart('2','registration-number', 'This field is required');
            boolvalue += 1;
        }else{
            $('#registration-number-part-2').removeClass('is-invalid');
            $('#registration-number-part-2-fb').removeClass('invalid-feedback');
        }
    }else{
        validFeedbackPart('2','registration-number');
    }

    this.reg_number_doc = $('#registration-number-doc-part-2').val();
    if(isEmpty(this.reg_number_doc)){
        if(this.company_legal == "1"){
            invalidFeedbackPart('2','registration-number-doc', 'This field is required');
            boolvalue += 1;
        }else{
            $('#registration-number-doc-part-2').removeClass('is-invalid');
            $('#registration-number-doc-part-2-fb').removeClass('invalid-feedback');
        }
    }else{
        validFeedbackPart('2','registration-number-doc');
    }*/

    this.company_type = $("#company-type-part-2").val();
    if (isEmpty(this.company_type)) {
        invalidFeedbackPart("2", "company-type", "This field is required");
        boolvalue += 1;
    } else {
        validFeedbackPart("2", "company-type");
    }

    /*this.business_association = $('#business-association-part-2').val();
    if(isEmpty(this.business_association)){
        invalidFeedbackPart('2','business-association', 'This field is required');
        boolvalue += 1;
    }else{
        validFeedbackPart('2','business-association');
    }

    this.business_association_name = $('#business-association-name-part-2').val();
    if(isEmpty(this.business_association_name)){
        if(this.business_association == "1"){
            invalidFeedbackPart('2','business-association-name', 'This field is required');
            boolvalue += 1;
        }else{
            $('#business-association-name-part-2').removeClass('is-invalid');
            $('#business-association-name-part-2-fb').removeClass('invalid-feedback');
        }
    }else{
        validFeedbackPart('2','business-association-name');
    }*/

    this.website = $("#website-part-2").val();
    if (!isEmpty(this.website)) {
        if (is_url(this.website) && !ValidateEmail(this.website)) {
            validFeedbackPart("2", "website");
        } else {
            boolvalue += 1;
            invalidFeedbackPart("2", "website", "Invalid website");
        }
    }

    this.def_social_media_link = $("#def_social_media_link-part-2").val();
    if (!isEmpty(this.def_social_media_link)) {
        if (is_url(this.def_social_media_link)) {
            validFeedbackPart("2", "def_social_media_link");
        } else {
            boolvalue += 1;
            invalidFeedbackPart("2", "def_social_media_link", "Invalid URL");
        }
    }

    this.def_social_media_link_2 = $("#def_social_media_link_2-part-2").val();
    if (!isEmpty(this.def_social_media_link_2)) {
        if (is_url(this.def_social_media_link_2)) {
            validFeedbackPart("2", "def_social_media_link_2");
        } else {
            boolvalue += 1;
            invalidFeedbackPart("2", "def_social_media_link_2", "Invalid URL");
        }
    }

    this.def_social_media_link_3 = $("#def_social_media_link_3-part-2").val();
    if (!isEmpty(this.def_social_media_link_3)) {
        if (is_url(this.def_social_media_link_3)) {
            validFeedbackPart("2", "def_social_media_link_3");
        } else {
            boolvalue += 1;
            invalidFeedbackPart("2", "def_social_media_link_3", "Invalid URL");
        }
    }

    this.def_social_media_link_4 = $("#def_social_media_link_4-part-2").val();
    if (!isEmpty(this.def_social_media_link_4)) {
        if (is_url(this.def_social_media_link_4)) {
            validFeedbackPart("2", "def_social_media_link_4");
        } else {
            boolvalue += 1;
            invalidFeedbackPart("2", "def_social_media_link_4", "Invalid URL");
        }
    }

    if (
        isEmpty(this.website) &&
        isEmpty(this.def_social_media_link) &&
        isEmpty(this.def_social_media_link_2) &&
        isEmpty(this.def_social_media_link_3) &&
        isEmpty(this.def_social_media_link_4)
    ) {
        boolvalue += 1;
        invalidFeedbackPart("2", "website", "");
        invalidFeedbackPart("2", "def_social_media_link", "");
        invalidFeedbackPart("2", "def_social_media_link_2", "");
        invalidFeedbackPart("2", "def_social_media_link_3", "");
        invalidFeedbackPart("2", "def_social_media_link_4", "");
        $("#social-info").removeClass("d-none");
    } else {
        $("#social-info").addClass("d-none");
        validFeedbackSocial("2", "def_social_media_link");
        validFeedbackSocial("2", "def_social_media_link_2");
        validFeedbackSocial("2", "def_social_media_link_3");
        validFeedbackSocial("2", "website");
        validFeedbackSocial("2", "def_social_media_link_4");
    }

    if (boolvalue === 0) {
        $("#stage-link-2").addClass("stage-link");
        $("#stage-link-2").removeClass("stage-link-active");
        $("#stage-link-icon-2").removeClass("d-none");
        $("#indicator3").addClass("d-none");

        $("#stage-link-3").addClass("stage-link-active");
        $("#stage-link-3").removeClass("stage-link");
        $("#indicator4").removeClass("d-none");
        $(".progress-bar").removeClass("fifty");
        $(".progress-bar").addClass("eighty");
        $("html, body").animate(
            {
                scrollTop: $("#myAnchor").offset().top,
            },
            500
        );
    } else {
        $("#myModal").modal();
        return false;
    }
}

function backstagecontentpart2form() {
    $("#stage-link-2").removeClass("stage-link");
    $("#stage-link-2").addClass("stage-link-active");
    $("#indicator3").removeClass("d-none");

    $("#stage-link-3").removeClass("stage-link-active");
    $("#stage-link-3").addClass("stage-link");
    $("#indicator4").addClass("d-none");
    $("html, body").animate(
        {
            scrollTop: $("#myAnchor").offset().top,
        },
        500
    );
}
var business_description,
    business_operation,
    number_employees,
    number_ft_employees,
    number_pt_employees,
    number_women_employees,
    export_interest,
    buisness_revenue_projection;
var new_jobs_projection,
    job_creation_summary,
    business_ownership_stake,
    business_revenue,
    disabilities,
    disability_type,
    export_license,
    referral_type,
    referral_other;

function stagecontentpart3form() {
    event.preventDefault();
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    var boolvalue = 0;

    this.business_description = $("#business-description-part-3").val();
    if (isEmpty(this.business_description)) {
        invalidFeedbackPart(
            "3",
            "business-description",
            "This field is required"
        );
        boolvalue += 1;
    } else {
        var res = this.business_description.split(" ");
        if (res.length < 10 || res.length > 100) {
            invalidFeedbackPart(
                "3",
                "business-description",
                "Minimum of 10 words and maximum of 100 words."
            );
            boolvalue += 1;
        } else {
            validFeedbackPart("3", "business-description");
        }
    }

    this.business_operation = $("#business-operation-part-3").val();
    if (isEmpty(this.business_operation)) {
        invalidFeedbackPart(
            "3",
            "business-operation",
            "This field is required"
        );
        boolvalue += 1;
    } else {
        validFeedbackPart("3", "business-operation");
    }

    this.number_employees = $("#number-employees-part-3").val();
    if (isEmpty(this.number_employees)) {
        invalidFeedbackPart("3", "number-employees", "This field is required");
        boolvalue += 1;
    } else {
        validFeedbackPart("3", "number-employees");
    }

    /*this.number_employees = $('#number-employees-part-3').val();
    if(isEmpty(this.number_employees)){
        invalidFeedbackPart('3','number-employees', 'This field is required');
        boolvalue += 1;
    }else{
        validFeedbackPart('3','number-employees');
    }

    this.number_ft_employees = $('#number-ft-employees-part-3').val();
    if(isEmpty(this.number_ft_employees)){
        invalidFeedbackPart('3','number-ft-employees', 'This field is required');
        boolvalue += 1;
    }else{
        validFeedbackPart('3','number-ft-employees');
    }

    this.number_pt_employees = $('#number-pt-employees-part-3').val();
    if(isEmpty(this.number_pt_employees)){
        invalidFeedbackPart('3','number-pt-employees', 'This field is required');
        boolvalue += 1;
    }else{
        validFeedbackPart('3','number-pt-employees');
    }*/

    this.number_women_employees = $("#number-women-employees-part-3").val();
    if (isEmpty(this.number_women_employees)) {
        invalidFeedbackPart(
            "3",
            "number-women-employees",
            "This field is required"
        );
        boolvalue += 1;
    } else {
        validFeedbackPart("3", "number-women-employees");
    }

    this.export_interest = $("#export-interest-part-3").val();
    if (isEmpty(this.export_interest)) {
        invalidFeedbackPart("3", "export-interest", "This field is required");
        boolvalue += 1;
    } else {
        validFeedbackPart("3", "export-interest");
    }

    /*this.buisness_revenue_projection = $('#buisness-revenue-projection-part-3').val();
    if(isEmpty(this.buisness_revenue_projection)){
        invalidFeedbackPart('3','buisness-revenue-projection', 'This field is required');
        boolvalue += 1;
    }else{
        var res = this.buisness_revenue_projection.split(" ");
        if(res.length < 10 || res.length > 100){
            invalidFeedbackPart('3','buisness-revenue-projection', 'Minimum of 10 words and maximum of 100 words.');
            boolvalue += 1;
        }else{
            validFeedbackPart('3','buisness-revenue-projection');
        }
    }*/

    /*this.new_jobs_projection = $('#new-jobs-projection-part-3').val();
    if(isEmpty(this.new_jobs_projection)){
        invalidFeedbackPart('3','new-jobs-projection', 'This field is required');
        boolvalue += 1;
    }else{
        validFeedbackPart('3','new-jobs-projection');
    }

    this.job_creation_summary = $('#job-creation-summary-part-3').val();
    if(isEmpty(this.job_creation_summary)){
        invalidFeedbackPart('3','job-creation-summary', 'This field is required');
        boolvalue += 1;
    }else{
        validFeedbackPart('3','job-creation-summary');
    }

    this.business_ownership_stake = $('#business-ownership-stake-part-3').val();
    if(isEmpty(this.business_ownership_stake)){
        invalidFeedbackPart('3','business-ownership-stake', 'This field is required');
        boolvalue += 1;
    }else{
        validFeedbackPart('3','business-ownership-stake');
    }

    this.business_revenue = $('#business-revenue-part-3').val();
    if(isEmpty(this.business_revenue)){
        invalidFeedbackPart('3','business-revenue', 'This field is required');
        boolvalue += 1;
    }else{
        validFeedbackPart('3','business-revenue');
    }

    this.business_profit = $('#business-profit-part-3').val();
    if(isEmpty(this.business_revenue)){
        invalidFeedbackPart('3','business-profit', 'This field is required');
        boolvalue += 1;
    }else{
        validFeedbackPart('3','business-profit');
    }*/

    this.disabilities = $("#disabilities-part-3").val();
    if (isEmpty(this.disabilities)) {
        invalidFeedbackPart("3", "disabilities", "This field is required");
        boolvalue += 1;
    } else {
        validFeedbackPart("3", "disabilities");
    }

    this.disability_type = $("#disability-type-part-3").val();
    if (isEmpty(this.disability_type)) {
        if (this.disabilities == "1") {
            invalidFeedbackPart(
                "3",
                "disability-type",
                "This field is required"
            );
            boolvalue += 1;
        } else {
            $("#disability-type-part-3").removeClass("is-invalid");
            $("#disability-type-part-3-fb").removeClass("invalid-feedback");
        }
    } else {
        validFeedbackPart("3", "disability-type");
    }

    this.export_license = $("#export-license-part-3").val();
    if (isEmpty(this.export_license)) {
        invalidFeedbackPart("3", "export-license", "This field is required");
        boolvalue += 1;
    } else {
        validFeedbackPart("3", "export-license");
    }

    this.referral_type = $("#referral-type-part-3").val();
    if (isEmpty(this.referral_type)) {
        invalidFeedbackPart("3", "referral-type", "Referral type is required");
        boolvalue += 1;
    } else {
        validFeedbackPart("3", "referral-type");
    }

    this.referral_other = $("#referred_by_suffix-part-3").val();
    if (
        isEmpty(this.referral_other) &&
        this.referral_type == "From another organisation"
    ) {
        invalidFeedbackPart("3", "referred_by_suffix", "This is required");
        boolvalue += 1;
    } else {
        if (!isEmpty(this.referral_other)) {
            validFeedbackPart("3", "referred_by_suffix");
        }
    }

    if (boolvalue === 0) {
        $("#info-text").text("Disclaimer");
        $("#stage-area-checkbox-intro").removeClass("d-none");
        $(".progress-bar").removeClass("eighty");
        $(".progress-bar").addClass("hundred");
        if (
            !confirm(
                "Are you sure you would like to go ahead with the submission."
            )
        ) {
            return false;
        } else {
            $("#yedpTemplateForm").submit();
        }
    } else {
        $("#myModal").modal();
        return false;
    }
}
