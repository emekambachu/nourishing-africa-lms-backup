$(function(){

    $('.nav-link').click(function(event){
        event.preventDefault();

        // remove active class from all links
        $('.nav-link').removeClass('active');

        // check for id, make current element active and hide the rest
        if($(this).attr('id') === 'headerContacts'){
            $(this).addClass('active');
            $('#contactList').fadeIn(500);
            $('#ChatList').fadeOut(500);
        }else if($(this).attr('id') === 'headerChats'){
            $(this).addClass('active');
            $('#ChatList').fadeIn(500);
            $('#contactList').fadeOut(500);

        }
    });

    $('[data-contact]').click(function(event){
        // event.preventDefault();

        $('.chatContact').removeClass('selected');
        $(this).addClass('selected');

        $('#chatEmptyBody').fadeOut(200);
        $('#chatHeader').fadeIn(200);
        $('#ChatBody').fadeIn(200);

        let route = $(this).data('route');
        let loadChatsRoute = $(this).data('load-route');
        let connectionId = $(this).data('connection');
        let receiverId = $(this).data('contact');
        let senderId = $(this).data('sender');

            $.ajax({
                type: 'GET',
                url: route,
                data: {
                    'receiver_id': receiverId,
                    'sender_id': senderId
                },
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

                    $('#blockContactForm').attr('action', '/member/chat/block/'+receiverId);
                    $('#blockContactForm')[0].setAttribute('action', '/member/chat/block/'+receiverId);
                    $('#deleteContactForm').attr('action', '/member/chat/delete/'+receiverId);
                    $('#deleteContactForm')[0].setAttribute('action', '/member/chat/delete/'+receiverId);
                    $('#submitMessageForm').fadeIn(200);
                    $('#submitMessageForm').attr('data-route', '/member/chat/send-message/'+receiverId);
                    $('#submitMessageForm').data('route', '/member/chat/send-message/'+receiverId);
                    $('#submitMessageForm').attr('data-connection', connectionId);
                    $('#submitMessageForm').data('connection', connectionId);
                },

                success:function (response){
                    console.log(response);

                    // Assign all these to the various elements when a contact data is fetched
                    // Check if image is empty and add a replacement
                    if(response.receiver_image === ''){
                        $('#contactImage').attr("src", "/images/no-image.jpg");
                    }else{
                        $('#contactImage').attr("src", "/photos/"+response.receiver_image);
                    }

                    $('#contactName').html(response.receiver_name);
                    $('#contactSeen').html('Last Seen: '+response.receiver_seen);
                    $('#blockContactModalHeader').html(response.receiver_name);
                    $('#deleteContactModalHeader').html(response.receiver_name);

                    if(response.conversations.length > 0){
                        let messages = "";
                        $.each(response.conversations, function(k, v){
                            // do something
                            if(v.from_id === receiverId){

                                // If file is an image
                                if(['jpg', 'jpeg', 'png', 'bnp'].includes(v.file_ext)){
                                    messages += '<div class="media">\n' +
                                    '  <div class="media-body">\n' +
                                    '   <div class="main-msg-wrapper">\n ' +
                                    '         <a href="'+ v.file_base +'" download="'+ v.file +'">' +
                                    '           <i class="fa fa-download text-success"' +
                                    '                title="download"></i></a> \n' +
                                    '      <img class="rounded-10" width="250" src="'+ v.file_base +'" />' +
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
                                    '         <div class="main-msg-wrapper">\n' + v.message + '</div>\n' +
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
                                    '           <a href="'+ v.file_base +'" download="'+ v.file +'">' +
                                    '               <i class="fa fa-download text-success"' +
                                    '                   title="download"></i></a> \n' +
                                    '               <img class="rounded-10" width="250" src="'+ v.file_base +'" />' +
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
                                    '         <div class="main-msg-wrapper">\n' + v.message + '</div>\n' +
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
                            $('#ChatBody').scrollTop($('#chatBodyInner')[0].scrollHeight - $('#ChatBody')[0].clientHeight);
                        });

                    }else{
                        let noChats = "<div style='margin: 100px 0;'>" +
                                        "<i class='fas fa-comment-slash fa-5x text-success d-flex justify-content-center'></i>" +
                                      "</div>";
                        $('#chatBodyInner').html(noChats);
                        $('#chatBodyInner').append("<p class='text-center'>You currently have no chat with "+ response.receiver_name +", send them a message</p>");
                    }
                },

                error: function (Response) {
                    console.log(Response.responseText);
                    let chatError = "<div style='margin: 100px 0;'>" +
                        "<i class='fas fa-exclamation-triangle fa-5x text-success d-flex justify-content-center'></i>" +
                        "</div>";
                    $('#chatBodyInner').html(chatError);
                    $('#chatBodyInner').append("<p class='text-center'>An error occurred, contact info@nourishingafrica.com for support</p>");
                }
        });

    });

    // auto load chats
    var intervals = []; // create array variable to store intervals
    $('[data-contact]').click(function(){

        let loadChatsRoute = $(this).data('load-route');
        let receiverId = $(this).data('contact');
        let senderId = $(this).data('sender');

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
                url: loadChatsRoute,
                contentType: false,
                processData: false,
                data: {
                    receiver_id: receiverId,
                    sender_id: senderId
                },
                dataType: "json",
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                },

                success: function (response) {
                    // if the stored conversation count is less than or equal to
                    if(window.sessionStorage.getItem('count-conversations'+receiverId+senderId) >= response.conversations.length){
                        return false;
                    }

                    if(response.conversations.length > 0){
                        console.log('auto load begun for '+response.receiver_name+' '+response.conversations.length);

                        let messages = "";
                        $.each(response.conversations, function(k, v){
                            // do something
                            if(v.from_id === receiverId){
                                // If file is an image
                                if(['jpg', 'jpeg', 'png', 'bnp'].includes(v.file_ext)){
                                    messages += '<div class="media">\n' +
                                        '  <div class="media-body">\n' +
                                        '   <div class="main-msg-wrapper">\n ' +
                                        '         <a href="'+ v.file_base +'" download="'+ v.file +'">' +
                                        '           <i class="fa fa-download text-success"' +
                                        '                title="download"></i></a> \n' +
                                        '      <img class="rounded-10" width="250" src="'+ v.file_base +'" />' +
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
                                    '   <div class="main-msg-wrapper">\n ' +
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
                                    messages += '<div class="media">\n' +
                                    '       <div class="media-body">\n' +
                                    '         <div class="main-msg-wrapper">\n' + v.message + '</div>\n' +
                                    '          <div>\n' +
                                    '         <span>'+ v.message_date +'</span>\n' +
                                    '      <a href=""><i class="icon ion-android-more-horizontal"></i></a>\n' +
                                    '    </div>\n' +
                                    '  </div>\n' +
                                    ' </div>';
                                }

                            }else{
                                // If file is an image
                                if(['jpg', 'jpeg', 'png', 'bnp'].includes(v.file_ext)){
                                    messages += '<div class="media flex-row-reverse">\n' +
                                    '  <div class="media-body">\n' +
                                    '   <div class="main-msg-wrapper">\n ' +
                                    '         <a href="'+ v.file_base +'" download="'+ v.file +'">' +
                                    '           <i class="fa fa-download text-success"' +
                                    '                title="download"></i></a> \n' +
                                    '      <img class="rounded-10" width="250" src="'+ v.file_base +'" />' +
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
                                    '         <div class="main-msg-wrapper">\n' + v.message + '</div>\n' +
                                    '          <div>\n' +
                                    '         <span>'+ v.message_date +'</span>\n' +
                                    '      <a href=""><i class="icon ion-android-more-horizontal"></i></a>\n' +
                                    '    </div>\n' +
                                    '  </div>\n' +
                                    ' </div>';
                                }
                            }

                            // if there are conversations, remove loader and insert messages
                            $('#chatBodyInner').html(messages);

                            // auto scroll to latest chats
                            $('#ChatBody').scrollTop($('#chatBodyInner')[0].scrollHeight - $('#ChatBody')[0].clientHeight);
                        });

                    }else{
                        let noChats = "<div style='margin: 100px 0;'>" +
                            "<i class='fas fa-comment-slash fa-5x text-success d-flex justify-content-center'></i>" +
                            "</div>";
                        $('#chatBodyInner').html(noChats);
                        $('#chatBodyInner').append("<p class='text-center'>You currently have no chat with "+ response.receiver_name +", send them a message</p>");
                    }

                    // Store number of conversations per user using the receiver id in session storage
                    if (window.sessionStorage) {
                        window.sessionStorage.setItem('count-conversations'+receiverId+senderId, response.conversations.length);
                    }
                    console.log(sessionStorage.getItem('count-conversations'+receiverId+senderId));
                },

                error: function (response) {
                    console.log(response.responseText);
                    let chatError = "<div style='margin: 100px 0;'>" +
                        "<i class='fas fa-exclamation-triangle fa-5x text-success d-flex justify-content-center'></i>" +
                        "</div>";
                    $('#chatBodyInner').html(chatError);
                    $('#chatBodyInner').append("<p class='text-center'>An error occurred, contact info@nourishingafrica.com for support</p>");
                }
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

    $('#submitMessageForm').submit(function(event){

        event.preventDefault();
        let route = $(this).data('route');

        // get all form input data and create an instance
        let formData = new FormData(this);
        formData.append('chat_file', $('#file-upload')[0].files[0]);
        formData.append('connection_id', $(this).data('connection'));

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
                $('#chatUploadedFileName').removeClass();
                $('#chatUploadedFileName').empty();
            },

            success:function (response){
                let showSubmitBtn = "<i class='far fa-paper-plane'></i>";
                $('#submitMessageBtn').html(showSubmitBtn);
                $('#submitMessageBtn').prop("disabled",false);
                $("#submitMessageForm")[0].reset(); // reset form
                $('#chatUploadedFileName').removeClass();
                $('#chatUploadedFileName').empty();
            },

            error: function (response) {
                console.log(response.responseText);
                $('#chatUploadedFileName').addClass('bg-danger p-1 text-white text-center border-1 na-border-radius');
                $('#chatUploadedFileName').html('Error sending message');
            }
        });
    });

});
