$(document).ready(function() {

    $("#upload_documents_btn").on('click', function (event) {

        let valid_id = $('#valid_id').prop('files')[0];
        let birth_certificate = $('#birth_certificate').prop('files')[0];
        let certificate_of_incorporation = $('#certificate_of_incorporation').prop('files')[0];
        let evidence_belonging_association = $('#evidence_belonging_association').prop('files')[0];
        let reference_letter = $('#reference_letter').prop('files')[0];
        let consent_form = $('#consent_form').prop('files')[0];
        let validationAlert = "<p style='width: 60%; margin: 0 auto;' class='bg-danger p-2 text-center text-white'>" +
            "One or more errors have been identified, please check all fields</p>"

        if(!valid_id && !birth_certificate && !certificate_of_incorporation && !evidence_belonging_association && !reference_letter && !consent_form){
            let empty_fields_alert = "<p style='width: 60%; margin: 0 auto;' class='bg-danger p-2 text-center text-white'>" +
                "Upload atleast one document</p>"
            $("#validation-alert-top").html(empty_fields_alert);
            $("#validation-alert-bottom").html(empty_fields_alert);
            return false;
        }

        if(valid_id){
            let vi_ext = $('#valid_id').val().split('.').pop().toLowerCase();
            if($.inArray(vi_ext, ['gif','png','jpg','jpeg', 'pdf']) === -1) {
                let valid_alert = "<p class='bg-danger p-2 text-center text-white'>" +
                    "Valid ID must be jpeg, jpg, png or pdf</p>"
                $("#valid_alert").html(valid_alert);
                $("#validation-alert-bottom").html(validationAlert);
                return false;
            }else{
                $("#valid_alert").empty();
            }

            if (valid_id.size > 2024000) {
                let valid_alert = "<p class='bg-danger p-2 text-center text-white'>" +
                    "Valid ID must not be more than 2 mb</p>"
                $("#valid_alert").html(valid_alert);
                $("#validation-alert-bottom").html(validationAlert);
                return false;
            }else{
                $("#valid_alert").empty();
            }
        }

        if(birth_certificate){
            let bc_ext = $('#birth_certificate').val().split('.').pop().toLowerCase();
            if($.inArray(bc_ext, ['gif','png','jpg','jpeg', 'pdf']) === -1) {
                let birth_alert = "<p class='bg-danger p-2 text-center text-white'>" +
                    "Birth Certificate must be jpeg, jpg, png or pdf</p>"
                $("#birth_alert").html(birth_alert);
                $("#validation-alert-bottom").html(validationAlert);
                return false;
            }else{
                $("#birth_alert").empty();
            }

            if (birth_certificate.size > 2024000) {
                let birth_alert = "<p class='bg-danger p-2 text-center text-white'>" +
                    "Birth certificate must not be more than 2 mb</p>"
                $("#birth_alert").html(birth_alert);
                $("#validation-alert-bottom").html(validationAlert);
                return false;
            }else{
                $("#birth_alert").empty();
            }
        }

        if(certificate_of_incorporation){
            let coi_ext = $('#certificate_of_incorporation').val().split('.').pop().toLowerCase();
            if($.inArray(coi_ext, ['gif','png','jpg','jpeg', 'pdf']) === -1) {
                let certificate_alert = "<p class='bg-danger p-2 text-center text-white'>" +
                    "Certificate of incorporation must be jpeg, jpg, png or pdf</p>"
                $("#certificate_alert").html(certificate_alert);
                $("#validation-alert-bottom").html(validationAlert);
                return false;
            }else{
                $("#certificate_alert").empty();
            }

            if (certificate_of_incorporation.size > 2024000) {
                let certificate_alert = "<p class='bg-danger p-2 text-center text-white'>" +
                    "Certificate of incorporation must not be more than 2 mb</p>"
                $("#certificate_alert").html(certificate_alert);
                $("#validation-alert-bottom").html(validationAlert);
                return false;
            }else{
                $("#certificate_alert").empty();
            }
        }

        if(evidence_belonging_association){
            let eba_ext = $('#evidence_belonging_association').val().split('.').pop().toLowerCase();
            if($.inArray(eba_ext, ['gif','png','jpg','jpeg', 'pdf']) === -1) {
                let evidence_alert = "<p class='bg-danger p-2 text-center text-white'>" +
                    "Evidence belonging to an association must be jpeg, jpg, png or pdf</p>"
                $("#evidence_alert").html(evidence_alert);
                $("#validation-alert-bottom").html(validationAlert);
                return false;
            }else{
                $("#evidence_alert").empty();
            }

            if (evidence_belonging_association.size > 2024000) {
                let evidence_alert = "<p class='bg-danger p-2 text-center text-white'>" +
                    "Evidence belonging to an association must not be more than 2 mb</p>"
                $("#evidence_alert").html(evidence_alert);
                $("#validation-alert-bottom").html(validationAlert);
                return false;
            }else{
                $("#evidence_alert").empty();
            }
        }

        if(reference_letter){
            let rl_ext = $('#reference_letter').val().split('.').pop().toLowerCase();
            if($.inArray(rl_ext, ['gif','png','jpg','jpeg', 'pdf']) === -1) {
                let reference_alert = "<p class='bg-danger p-2 text-center text-white'>" +
                    "Reference letter must be jpeg, jpg, png or pdf</p>"
                $("#reference_alert").html(reference_alert);
                $("#validation-alert-bottom").html(validationAlert);
                return false;
            }else{
                $("#reference_alert").empty();
            }

            if (reference_letter.size > 2024000) {
                let reference_alert = "<p class='bg-danger p-2 text-center text-white'>" +
                    "Reference letter must not be more than 2 mb</p>"
                $("#reference_alert").html(reference_alert);
                $("#validation-alert-bottom").html(validationAlert);
                return false;
            }else{
                $("#reference_alert").empty();
            }
        }

        if(consent_form){
            let cf_ext = $('#consent_form').val().split('.').pop().toLowerCase();
            if($.inArray(cf_ext, ['gif','png','jpg','jpeg', 'pdf']) === -1) {
                let consent_alert = "<p class='bg-danger p-2 text-center text-white'>" +
                    "Terms and Conditions of Participation must be jpeg, jpg, png or pdf</p>"
                $("#consent_alert").html(consent_alert);
                $("#validation-alert-bottom").html(validationAlert);
                return false;
            }else{
                $("#consent_alert").empty();
            }

            if (consent_form.size > 2024000) {
                let consent_alert = "<p class='bg-danger p-2 text-center text-white'>" +
                    "Terms and Conditions of Participation must not be more than 2 mb</p>"
                $("#consent_alert").html(consent_alert);
                $("#validation-alert-bottom").html(validationAlert);
                return false;
            }else{
                $("#consent_alert").empty();
            }
        }

    });

    // $("#update-documents-btn").on('click', function (event) {
    //
    //     if(!valid_id && !birth_certificate && !certificate_of_incorporation && !evidence_belonging_association && !reference_letter && !consent_form){
    //         let validationAlert = "<p style='width: 60%' class='bg-danger p-2 text-center text-white'>" +
    //             "All fields can't be empty, upload atleast one document</p>"
    //         $("#validation-alert-top").html(validationAlert);
    //         $("#validation-alert-bottom").html(validationAlert);
    //         event.preventDefault();
    //     }
    //
    //     // validate
    //     let vi = valid_id.type.split('/').pop().toLowerCase();
    //     if (vi !== "jpeg" && vi !== "jpg" && vi !== "png" && vi !== "pdf") {
    //         let validationAlert = "<p class='bg-danger p-2 text-center text-white'>" +
    //             "Valid ID must be jpeg, jpg, png or pdf</p>"
    //         $("#validation-alert-top").html(validationAlert);
    //         $("#validation-alert-bottom").html(validationAlert);
    //         event.preventDefault();
    //     }
    //     if (valid_id.size > 2024000) {
    //         let validationAlert = "<p class='bg-danger p-2 text-center text-white'>" +
    //             "Valid ID must not be more than 2 mb</p>"
    //         $("#validation-alert-top").html(validationAlert);
    //         $("#validation-alert-bottom").html(validationAlert);
    //         event.preventDefault();
    //     }
    //
    //     let bc = birth_certificate.type.split('/').pop().toLowerCase();
    //     if (bc !== "jpeg" && bc !== "jpg" && bc !== "png" && bc !== "pdf") {
    //         let validationAlert = "<p class='bg-danger p-2 text-center text-white'>" +
    //             "Birth Certificate must be jpeg, jpg, png or pdf</p>"
    //         $("#validation-alert-top").html(validationAlert);
    //         $("#validation-alert-bottom").html(validationAlert);
    //         event.preventDefault();
    //     }
    //     if (birth_certificate.size > 2024000) {
    //         let validationAlert = "<p style='width: 60%' class='bg-danger p-2 text-center text-white'>" +
    //             "Birth Certificate must not be more than 2 mb</p>"
    //         $("#validation-alert-top").html(validationAlert);
    //         $("#validation-alert-bottom").html(validationAlert);
    //         event.preventDefault();
    //     }
    //
    //     let coi = certificate_of_incorporation.type.split('/').pop().toLowerCase();
    //     if (coi !== "jpeg" && coi !== "jpg" && coi !== "png" && coi !== "pdf") {
    //         let validationAlert = "<p style='width: 60%' class='bg-danger p-2 text-center text-white'>" +
    //             "Certificate of Incorporation must be jpeg, jpg, png or pdf</p>"
    //         $("#validation-alert-top").html(validationAlert);
    //         $("#validation-alert-bottom").html(validationAlert);
    //         event.preventDefault();
    //     }
    //     if (certificate_of_incorporation.size > 2024000) {
    //         let validationAlert = "<p style='width: 60%' class='bg-danger p-2 text-center text-white'>" +
    //             "Certification of Incorporation must not be more than 2 mb</p>"
    //         $("#validation-alert-top").html(validationAlert);
    //         $("#validation-alert-bottom").html(validationAlert);
    //         event.preventDefault();
    //     }
    //
    //     let eba = evidence_belonging_association.type.split('/').pop().toLowerCase();
    //     if (eba !== "jpeg" && eba !== "jpg" && eba !== "png" && eba !== "pdf") {
    //         let validationAlert = "<p style='width: 60%' class='bg-danger p-2 text-center text-white'>" +
    //             "Evidence Belonging to an Association must be jpeg, jpg, png or pdf</p>"
    //         $("#validation-alert-top").html(validationAlert);
    //         $("#validation-alert-bottom").html(validationAlert);
    //         event.preventDefault();
    //     }
    //     if (evidence_belonging_association.size > 2024000) {
    //         let validationAlert = "<p style='width: 60%' class='bg-danger p-2 text-center text-white'>" +
    //             "Evidence Belonging to an Association must not be more than 2 mb</p>"
    //         $("#validation-alert-top").html(validationAlert);
    //         $("#validation-alert-bottom").html(validationAlert);
    //         event.preventDefault();
    //     }
    //
    //     let rl = reference_letter.type.split('/').pop().toLowerCase();
    //     if (rl !== "jpeg" && rl !== "jpg" && rl !== "png" && rl !== "pdf" && rl !== "doc" && rl !== "docx") {
    //         let validationAlert = "<p style='width: 60%' class='bg-danger p-2 text-center text-white'>" +
    //             "Reference Letter must be jpeg, jpg, png, pdf, doc or docx</p>"
    //         $("#validation-alert-top").html(validationAlert);
    //         $("#validation-alert-bottom").html(validationAlert);
    //         event.preventDefault();
    //     }
    //     if (reference_letter.size > 2024000) {
    //         let validationAlert = "<p class='bg-danger p-2 text-center text-white'>" +
    //             "Reference Letter must not be more than 2 mb</p>"
    //         $("#validation-alert-top").html(validationAlert);
    //         $("#validation-alert-bottom").html(validationAlert);
    //         event.preventDefault();
    //     }
    //
    //     let cf = consent_form.type.split('/').pop().toLowerCase();
    //     if (cf !== "jpeg" && cf !== "jpg" && cf !== "png" && cf !== "pdf") {
    //
    //         alert('not the right doc');
    //
    //         let validationAlert = "<p style='width: 60%' class='bg-danger p-2 text-center text-white'>" +
    //             "Consent Form must be jpeg, jpg, png or pdf</p>"
    //         $("#validation-alert-top").html(validationAlert);
    //         $("#validation-alert-bottom").html(validationAlert);
    //         event.preventDefault();
    //     }
    //     if (consent_form.size > 2024000) {
    //         let validationAlert = "<p class='bg-danger p-2 text-center text-white'>" +
    //             "Consent Form must not be more than 2 mb</p>"
    //         $("#validation-alert-top").html(validationAlert);
    //         $("#validation-alert-bottom").html(validationAlert);
    //         event.preventDefault();
    //     }
    //
    // });

});
