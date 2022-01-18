$(document).ready(function(){

    // Validate Filter
    $('#btn-data-form').on('click', function(event) {

        // Validate youtube link
        function validateYoutube(url) {
            let p = /^(?:https?:\/\/)?(?:www\.)?youtube\.com\/watch\?(?=.*v=((\w|-){11}))(?:\S+)?$/;
            return (url.match(p)) ? RegExp.$1 : false;
        }

        let title = $('#data-form').find('input[name="title"]').val();
        let publisher = $('#data-form').find('input[name="publisher"]').val();
        let author = $('#data-form').find('input[name="author"]').val();
        let publication_year = $('#data-form').find('input[name="publication_year"]').val();
        let country = $('#data-form').find('select[name="country_id"]').val();
        let publication_link = $('#data-form').find('input[name="publication_link"]').val();
        let embed = $('#data-form').find('input[name="embed_link"]').val();
        let abstract = $('#data-form').find('textarea[name="abstract"]').val();
        // let abstract = $('textarea#data-form-abstract').val();

        if(publication_link === "" && $('.data_document').get(0).files.length === 0 && embed === ""){
            let resourceAlert = "<p class='text-danger text-center'>" +
                "Publication link, Document or Youtube url can't be empty</p>"
            $("#resource_alert").html(resourceAlert);
            event.preventDefault();
        }else{
            $("#resource_alert").empty();
        }

        if(embed !== '' && validateYoutube(embed) === false){
            let validateYoutube = "<p class='text-danger text-left'>" + "invalid url</p>"
            $("#validate_youtube").html(validateYoutube);
            event.preventDefault();
        }else{
            $("#validate_youtube").empty();
        }

        if(title === ''){
            let titleAlert = "<p class='text-danger text-left'>" + "Title is required</p>"
            $("#title_alert").html(titleAlert);
            event.preventDefault();
        }else{
            $("#title_alert").empty();
        }

        if(publisher === ''){
            let publisherAlert = "<p class='text-danger text-left'>" + "Publisher is required</p>"
            $("#publisher_alert").html(publisherAlert);
            event.preventDefault();
        }else{
            $("#publisher_alert").empty();
        }

        if(publication_year === ''){
            let publicationYearAlert = "<p class='text-danger text-left'>" + "Publication year is required</p>"
            $("#publisher_year_alert").html(publicationYearAlert);
            event.preventDefault();
        }else{
            $("#publisher_year_alert").empty();
        }

        if(author === ''){
            let authorAlert = "<p class='text-danger text-left'>" + "Author is required</p>"
            $("#author_alert").html(authorAlert);
            event.preventDefault();
        }else{
            $("#author_alert").empty();
        }

        if(country === ''){
            let countryAlert = "<p class='text-danger text-left'>" + "Country is required</p>"
            $("#country_alert").html(countryAlert);
            event.preventDefault();
        }else{
            $("#country_alert").empty();
        }

        if(abstract === ''){
            let abstractAlert = "<p class='text-danger text-left'>" + "Abstract is required</p>"
            $("#abstract_alert").html(abstractAlert);
            event.preventDefault();
        }else{
            $("#abstract_alert").empty();
        }

        // let requiredFields = [title, publisher, author, publication_year, country, abstract];
        // $.each(requiredFields, function( index, value ) {
        //     console.log( index + ": " + value );
        // });

        // for(let i=0; i < requiredFields.length; i++) {
        //     if(requiredFields[i].value === '') {
        //
        //         alert(requiredFields[i].placeholder);
        //         let validationAlert = "<p class='text-danger text-left'>" + requiredFields[i].placeholder + "can't be empty</p>"
        //         $(this).parent().find("#validation_alert").html(validationAlert);
        //         $(this).addClass('na-form-input-error');
        //         return false;
        //
        //     }else{
        //         $(this).parent().find("#validation_alert").empty();
        //         $(this).removeClass('na-form-input-error');
        //     }
        // }

    });
});
