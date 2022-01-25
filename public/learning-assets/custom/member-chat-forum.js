$(function(){

    $(document).ready(function(){

        $('#chatEmptyBody').fadeOut(200);
        $('#ChatBody').fadeIn(200);

        // Get route and current user id from .main-content-body class using data attributes
        let route = $('.main-content-body').data('chats-route');
        let userId = $('.main-content-body').data('user-id');

        $.ajax({
            type: 'GET',
            url: route,
            dataType: "json",
            contentType: false,
            processData: false,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            },

            beforeSend: function (){
                let chatSpinner = "<div style='margin: 100px 0;'>" +
                    "<i class='fas fa-circle-notch fa-spin fa-2x text-success d-flex justify-content-center'></i>" +
                    "</div>";
                $('#chatBodyInner').html(chatSpinner);
                $('#chatBodyInner').append("<p class='text-center'>Loading chats......Please wait</p>");
            },

            success:function (response){
                console.log(response);

                if(response.conversations.length > 0){
                    let messages = "";
                    $.each(response.conversations, function(k, v){

                        // If sender id is not equal to the logged in user
                        if(v.user_id !== userId){

                            // If file is an image
                            if(['jpg', 'jpeg', 'png', 'bnp'].includes(v.file_ext)){
                                messages += '<div class="media">\n' +
                                    '  <div class="media-body">\n' +
                                    '   <div class="main-msg-wrapper">\n ' +
                                    '      <span class="member-text-8 tag tag-rounded tag-yellow text-dark mr-1">' +
                                    v.user_name + '</span>' +
                                    '         <a href="'+ v.file_base +'" download="'+ v.file +'">' +
                                    '           <i class="fa fa-download text-success"' +
                                    '                title="download"></i></a> \n' +
                                    '      <img class="rounded-10" width="150" src="'+ v.file_base +'" />' +
                                    '           </div>\n' +
                                    '          <div>\n' +
                                    '         <span>' + v.message_date + '</span>\n' +
                                    '      <a href=""><i class="icon ion-android-more-horizontal"></i></a>\n' +
                                    '    </div>\n' +
                                    '  </div>\n' +
                                    ' </div>';
                            }

                            // If file is a document
                            if(['doc', 'docx', 'pdf', 'xlsx'].includes(v.file_ext)){
                                messages += '<div class="media">\n' +
                                    '  <div class="media-body">\n' +
                                    '      <span class="member-text-8 tag tag-rounded tag-yellow text-dark mr-1">' +
                                    v.user_name + '</span>' +
                                    '   <div class="main-msg-wrapper">\n ' +
                                    '         <a href="'+ v.file_base +'" download="'+ v.file +'">' +
                                    '           <i class="fa fa-download text-success"' +
                                    '                title="download"></i></a> \n' +
                                    '      <img class="rounded-10" width="20" src="/images/document.jpg" />' +
                                    '           <span class="chat-text-small">'+ v.file +'</span> \n' +
                                    '           </div>\n' +
                                    '          <div>\n' +
                                    '         <span>' + v.message_date + '</span>\n' +
                                    '      <a href=""><i class="icon ion-android-more-horizontal"></i></a>\n' +
                                    '    </div>\n' +
                                    '  </div>\n' +
                                    ' </div>';
                            }

                            if(v.message !== null){
                                messages += '<div class="media">\n' +
                                    '       <div class="media-body">\n' +
                                    '         <div class="main-msg-wrapper">' +
                                    '      <span class="member-text-8 tag tag-rounded tag-yellow text-dark mr-1">' +
                                    v.user_name + '</span>' +
                                    v.message + '</div>\n' +
                                    '          <div>\n' +
                                    '         <span>'+ v.message_date +'</span>\n' +
                                    '      <a href=""><i class="icon ion-android-more-horizontal"></i></a>\n' +
                                    '    </div>\n' +
                                    '  </div>\n' +
                                    ' </div>';
                            }

                        }else{
                            if(['jpg', 'jpeg', 'png', 'bnp'].includes(v.file_ext)){
                                messages += '<div class="media flex-row-reverse">\n' +
                                    '  <div class="media-body">\n' +
                                    '   <div class="main-msg-wrapper">\n ' +
                                    '      <span class="member-text-8 tag tag-rounded tag-yellow text-dark mr-1">' +
                                    '       You' + '</span>' +
                                    '           <a href="'+ v.file_base +'" download="'+ v.file +'">' +
                                    '               <i class="fa fa-download text-success"' +
                                    '                   title="download"></i></a> \n' +
                                    '               <img class="rounded-10" width="150" src="'+ v.file_base +'" />' +
                                    '           </div>\n' +
                                    '          <div>\n' +
                                    '         <span>' + v.message_date + '</span>\n' +
                                    '      <a href=""><i class="icon ion-android-more-horizontal"></i></a>\n' +
                                    '    </div>\n' +
                                    '  </div>\n' +
                                    ' </div>';
                            }

                            // If file is a document
                            if(['doc', 'docx', 'pdf', 'xlsx'].includes(v.file_ext)){
                                messages += '<div class="media flex-row-reverse">\n' +
                                    '  <div class="media-body">\n' +
                                    '   <div class="main-msg-wrapper">\n ' +
                                    '      <span class="member-text-8 tag tag-rounded tag-yellow text-dark mr-1">' +
                                    '       You' + '</span>' +
                                    '         <a href="'+ v.file_base +'" download="'+ v.file +'">' +
                                    '           <i class="fa fa-download text-success"' +
                                    '                title="download"></i></a> \n' +
                                    '      <img class="rounded-10" width="30" src="/images/document.jpg" />' +
                                    '           <span class="chat-text-small">'+ v.file +'</span> \n' +
                                    '           </div>\n' +
                                    '          <div>\n' +
                                    '         <span>' + v.message_date + '</span>\n' +
                                    '      <a href=""><i class="icon ion-android-more-horizontal"></i></a>\n' +
                                    '    </div>\n' +
                                    '  </div>\n' +
                                    ' </div>';
                            }

                            if(v.message !== null){
                                messages += '<div class="media flex-row-reverse">\n' +
                                    '       <div class="media-body">\n' +
                                    '         <div class="main-msg-wrapper">' +
                                    '      <span class="member-text-8 tag tag-rounded tag-yellow text-dark mr-1">' +
                                    '       You' + '</span>' +
                                                    v.message + '</div>\n' +
                                    '          <div>\n' +
                                    '         <span>'+ v.message_date +'</span>\n' +
                                    '      <a href=""><i class="icon ion-android-more-horizontal"></i></a>\n' +
                                    '    </div>\n' +
                                    '  </div>\n' +
                                    ' </div>';
                            }
                        }

                        // if there are conversations, remove loader and insert messages
                        $('#chatBodyInner').empty();
                        $('#chatBodyInner').html(messages);

                        // auto scroll to latest chats
                        // $('#ChatBody').scrollTop($('#chatBodyInner')[0].scrollHeight - $('#ChatBody')[0].clientHeight);
                        $('#chatBodyInner').scrollTop($('#chatBodyInner').prop('scrollHeight'));

                    });

                }else{
                    let noChats = "<div style='margin: 100px 0;'>" +
                        "<i class='fas fa-comment-slash fa-5x text-success d-flex justify-content-center'></i>" +
                        "</div>";
                    $('#chatBodyInner').html(noChats);
                    $('#chatBodyInner').append("<p class='text-center'>No chats available in this thread</p>");
                }
            },

            // error: function (Response) {
            //     console.log(Response.responseText);
            //     let chatError = "<div style='margin: 100px 0;'>" +
            //         "<i class='fas fa-exclamation-triangle fa-5x text-success d-flex justify-content-center'></i>" +
            //         "</div>";
            //     $('#chatBodyInner').html(chatError);
            //     $('#chatBodyInner').append("<p class='text-center'>An error occurred, contact membership@nourishingafrica.com for support</p>");
            // }
        });

    });

    // auto load chats
    var intervals = []; // create array variable to store intervals
    $(document).ready(function(){

        $('#chatEmptyBody').fadeOut(200);
        $('#ChatBody').fadeIn(200);

        // Get route and current user id from .main-content-body class using data attributes
        let route = $('.main-content-body').data('chats-route');
        let userId = $('.main-content-body').data('user-id');
        let forumId = $('.main-content-body').data('forum-id');

        // loop through stored intervals and clear them
        for (let i=0; i < intervals.length; i++) {
            clearInterval(intervals[i]);
        }

        // assign variable to interval and store in intervals array
        let intervalId = setInterval(autoLoad, 3000);
        intervals.push(intervalId);
        console.log(intervals);

        // load data from controller every 3 seconds
        function autoLoad (){
            $.ajax({
                type: 'GET',
                url: route,
                contentType: false,
                processData: false,
                dataType: "json",
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                },

                success: function (response) {
                    // if the stored conversation count is greater or equal to database conversation count, do nothing
                    if(window.sessionStorage.getItem('count-conversations'+forumId) >= response.conversations.length){
                        return false;
                    }

                    if(response.conversations.length > 0){
                        console.log('auto load begun for '+response.member_chat_forum_id+' '+response.conversations.length);

                        let messages = "";
                        $.each(response.conversations, function(k, v){
                            // do something
                            if(v.user_id !== userId){

                                // If uploaded file is an image
                                if(['jpg', 'jpeg', 'png', 'bnp'].includes(v.file_ext)){
                                    messages += '<div class="media">\n' +
                                        '  <div class="media-body">\n' +
                                        '   <div class="main-msg-wrapper">\n ' +
                                        '      <span class="member-text-8 tag tag-rounded tag-yellow text-dark mr-1">' +
                                        v.user_name + '</span>' +
                                        '         <a href="'+ v.file_base +'" download="'+ v.file +'">' +
                                        '           <i class="fa fa-download text-success"' +
                                        '                title="download"></i></a> \n' +
                                        '      <img class="rounded-10" width="150" src="'+ v.file_base +'" />' +
                                        '           </div>\n' +
                                        '          <div>\n' +
                                        '         <span>' + v.message_date + '</span>\n' +
                                        '      <a href=""><i class="icon ion-android-more-horizontal"></i></a>\n' +
                                        '    </div>\n' +
                                        '  </div>\n' +
                                        ' </div>';
                                }

                                // If uploaded file is a document
                                if(['doc', 'docx', 'pdf', 'xlsx'].includes(v.file_ext)){
                                    messages += '<div class="media">\n' +
                                        '  <div class="media-body">\n' +
                                        '      <span class="member-text-8 tag tag-rounded tag-yellow text-dark mr-1">' +
                                        v.user_name + '</span>' +
                                        '   <div class="main-msg-wrapper">\n ' +
                                        '         <a href="'+ v.file_base +'" download="'+ v.file +'">' +
                                        '           <i class="fa fa-download text-success"' +
                                        '                title="download"></i></a> \n' +
                                        '      <img class="rounded-10" width="20" src="/images/document.jpg" />' +
                                        '           <span class="chat-text-small">'+ v.file +'</span> \n' +
                                        '           </div>\n' +
                                        '          <div>\n' +
                                        '         <span>' + v.message_date + '</span>\n' +
                                        '      <a href=""><i class="icon ion-android-more-horizontal"></i></a>\n' +
                                        '    </div>\n' +
                                        '  </div>\n' +
                                        ' </div>';
                                }

                                if(v.message !== null){
                                    // If a plain message was sent
                                    messages += '<div class="media">\n' +
                                        '       <div class="media-body">\n' +
                                        '         <div class="main-msg-wrapper">' +
                                        '      <span class="member-text-8 tag tag-rounded tag-yellow text-dark mr-1">' +
                                        v.user_name + '</span>' +
                                        v.message + '</div>\n' +
                                        '          <div>\n' +
                                        '         <span>'+ v.message_date +'</span>\n' +
                                        '      <a href=""><i class="icon ion-android-more-horizontal"></i></a>\n' +
                                        '    </div>\n' +
                                        '  </div>\n' +
                                        ' </div>';
                                }

                            }else{
                                // If uploaded file is an image
                                if(['jpg', 'jpeg', 'png', 'bnp'].includes(v.file_ext)){
                                    messages += '<div class="media flex-row-reverse">\n' +
                                        '  <div class="media-body">\n' +
                                        '   <div class="main-msg-wrapper">\n ' +
                                        '      <span class="member-text-8 tag tag-rounded tag-yellow text-dark mr-1">' +
                                        '       You' + '</span>' +
                                        '           <a href="'+ v.file_base +'" download="'+ v.file +'">' +
                                        '               <i class="fa fa-download text-success"' +
                                        '                   title="download"></i></a> \n' +
                                        '               <img class="rounded-10" width="150" src="'+ v.file_base +'" />' +
                                        '           </div>\n' +
                                        '          <div>\n' +
                                        '         <span>' + v.message_date + '</span>\n' +
                                        '      <a href=""><i class="icon ion-android-more-horizontal"></i></a>\n' +
                                        '    </div>\n' +
                                        '  </div>\n' +
                                        ' </div>';
                                }

                                // If uploaded file is a document
                                if(['doc', 'docx', 'pdf', 'xlsx'].includes(v.file_ext)){
                                    messages += '<div class="media flex-row-reverse">\n' +
                                        '  <div class="media-body">\n' +
                                        '   <div class="main-msg-wrapper">\n ' +
                                        '      <span class="member-text-8 tag tag-rounded tag-yellow text-dark mr-1">' +
                                        '       You' + '</span>' +
                                        '         <a href="'+ v.file_base +'" download="'+ v.file +'">' +
                                        '           <i class="fa fa-download text-success"' +
                                        '                title="download"></i></a> \n' +
                                        '      <img class="rounded-10" width="30" src="/images/document.jpg" />' +
                                        '           <span class="chat-text-small">'+ v.file +'</span> \n' +
                                        '           </div>\n' +
                                        '          <div>\n' +
                                        '         <span>' + v.message_date + '</span>\n' +
                                        '      <a href=""><i class="icon ion-android-more-horizontal"></i></a>\n' +
                                        '    </div>\n' +
                                        '  </div>\n' +
                                        ' </div>';
                                }

                                if(v.message !== null){
                                    // If a plaoin message was sent
                                    messages += '<div class="media flex-row-reverse">\n' +
                                        '       <div class="media-body">\n' +
                                        '         <div class="main-msg-wrapper">' +
                                        '      <span class="member-text-8 tag tag-rounded tag-yellow text-dark mr-1">' +
                                        '       You' + '</span>' +
                                        v.message + '</div>\n' +
                                        '          <div>\n' +
                                        '         <span>'+ v.message_date +'</span>\n' +
                                        '      <a href=""><i class="icon ion-android-more-horizontal"></i></a>\n' +
                                        '    </div>\n' +
                                        '  </div>\n' +
                                        ' </div>';
                                }
                            }

                            // if there are conversations, remove loader and insert messages
                            $('#chatBodyInner').empty();
                            $('#chatBodyInner').html(messages);

                            // auto scroll to latest chats
                            // $('#ChatBody').scrollTop($('#chatBodyInner')[0].scrollHeight - $('#ChatBody')[0].clientHeight);
                            $('#chatBodyInner').scrollTop($('#chatBodyInner').prop('scrollHeight'));
                        });

                    }else{
                        let noChats = "<div style='margin: 100px 0;'>" +
                            "<i class='fas fa-comment-slash fa-5x text-success d-flex justify-content-center'></i>" +
                            "</div>";
                        $('#chatBodyInner').html(noChats);
                        $('#chatBodyInner').append("<p class='text-center'>There are no chats available for this thread</p>");
                    }

                    // Store number of conversations per user using the receiver id in session storage
                    if (window.sessionStorage) {
                        window.sessionStorage.setItem('count-conversations'+userId, response.conversations.length);
                    }
                    console.log(sessionStorage.getItem('count-conversations'+userId));
                },

                // error: function (response) {
                //     console.log(response.responseText);
                //     let chatError = "<div style='margin: 100px 0;'>" +
                //         "<i class='fas fa-exclamation-triangle fa-5x text-success d-flex justify-content-center'></i>" +
                //         "</div>";
                //     $('#chatBodyInner').html(chatError);
                //     $('#chatBodyInner').append("<p class='text-center'>An error occurred, contact membership@nourishingafrica.com for support</p>");
                // }
            });
        }
    });

    // on file upload
    $('#file-upload').change(function(){
        // Validate form fields
        let chatFile = $('#file-upload').prop('files')[0];
        if(chatFile){
            let ao_ext = $('#file-upload').val().split('.').pop().toLowerCase();
            if($.inArray(ao_ext, ['jpg', 'png', 'jpeg', 'gif', 'pdf', 'doc', 'docx', 'xlsx']) === -1) {
                let chatNotification = "<p class='bg-danger p-1 text-center text-white na-border-radius'>" +
                    "Unsupported file format</p>"
                $("#chatUploadedFileName").html(chatNotification);
                return false;
            }else{
                $("#chatUploadedFileName").empty();
            }

            if(chatFile.size > 2024000){
                let chatNotification = "<p class='bg-danger p-1 text-center text-white na-border-radius'>" +
                    "File must not be more than 2 mb</p>"
                $("#chatUploadedFileName").html(chatNotification);
                return false;
            }else{
                $("#chatUploadedFileName").empty();
            }
        }

        let chatFileName = this.files[0].name;
        $('#chatUploadedFileName').addClass('bg-success p-1 text-white text-center border-1 na-border-radius');
        $('#chatUploadedFileName').text(chatFileName);

    });

    $('#submitMessageBtn').click(function(){
        let chatMessage = $('#submitMessageForm').find('input[name="chat_message"]').val();

        // if message or file is empty
        if(!chatMessage && !chatFile){
            return false;
        }
    });

    $('#submitThreadMessageForm').submit(function(event){

        event.preventDefault();
        let route = $(this).data('route');

        // get all form input data and create an instance
        let formData = new FormData(this);
        formData.append('chat_file', $('#file-upload')[0].files[0]);

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
                $('#submitMessageBtn').prop("disabled",true);
                let chatBtnSpinner = "<i class='fas fa-circle-notch fa-spin'></i>";
                $('#submitMessageBtn').html(chatBtnSpinner);
                $('#chatUploadedFileName').removeClass().empty();
                // $('#chatUploadedFileName').empty();
            },

            success:function (response){
                let showSubmitBtn = "<i class='far fa-paper-plane'></i>";
                $('#submitMessageBtn').html(showSubmitBtn);
                $('#submitMessageBtn').prop("disabled",false);
                $("#submitThreadMessageForm")[0].reset(); // reset form
                $('#chatUploadedFileName').removeClass().empty();
                // $('#chatUploadedFileName').empty();
            },

            error: function (response) {
                console.log(response.responseText);
                $('#chatUploadedFileName').addClass('bg-danger p-1 text-white text-center border-1 na-border-radius');
                $('#chatUploadedFileName').html('Error sending message');
            }
        });
    });

});
