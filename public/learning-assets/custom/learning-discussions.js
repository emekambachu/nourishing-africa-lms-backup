$(document).ready(function () {
    $(".course-tab").click(function (e) {
        $(".course-tab").removeClass("active");
        $(".tab-bodies").addClass("d-none");

        $(this).addClass("active");

        if ($(this).attr("id") == "description") {
            $("#description-tab-body").removeClass("d-none");
        }

        if ($(this).attr("id") == "instructor") {
            $("#instructor-tab-body").removeClass("d-none");
        }

        if ($(this).attr("id") == "resources") {
            $("#resources-tab-body").removeClass("d-none");
        }

        if ($(this).attr("id") == "discussion") {
            $("#discussion-tab-body").removeClass("d-none");
        }
    });

    $("#exampleModalCenter").on("show.bs.modal", function (event) {
        const button = $(event.relatedTarget); // Button that triggered the modal
        const data_type = button.data("type"); // Extract info from data-* attributes
        const modal = $(this);
        modal.find(".comment-title").text(data_type);
        if (data_type == "Comment") {
            modal.find("#ReplyID").val("");
            modal.find("#comment").val("");
            modal.find("#type").val("comment");
        } else if (data_type == "Reply") {
            const data_id = button.data("commentid");
            modal.find("#comment").val("");
            modal.find("#type").val("reply");
            modal.find("#ReplyID").val(data_id);
        }
    });

    $("#comment-submit-btn").on("click", function () {
        const modal = $(this);
        let type = $("#type").val();
        let data = {};
        let message = $("#comment").val();

        if (message == "" || message === "") {
            $("#msg").addClass("text-warning");
            $("#msg").text("This field is required.");
            return false;
        } else {
            $("#msg").removeClass("text-warning");
            $("#msg").text("");
        }

        if (type == "comment") {
            data = {
                type: type,
                message: message,
                learning_course_id: $("#courseId").val(),
                learning_category_id: $("#LCID").val(),
                learning_module_id: $("#LMID").val(),
            };
            //data.push(type, message, courseId, lmID, lcID);
        } else if (type == "reply") {
            data = {
                type: type,
                message: message,
                reply_id: $("#ReplyID").val(),
            };
            //let reply_id = $('#ReplyID').val();
            //data.push(type, message, reply_id);
        }

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        $.ajax({
            url: "/yaedp/account/discussion",
            type: "POST",
            data: data,
            timeout: 5000,
            beforeSend: function () {
                $("#submit-img").removeClass("d-none");
            },
            success: function (data) {
                $("#submit-img").addClass("d-none");
                $("#msg").addClass("text-success");
                $("#msg").text(
                    "Your comment was successfully submitted and will be reviewed before made public."
                );
                $("#comment").val("");
            },
            error: function (e, textStatus) {
                $("#submit-img").addClass("d-none");
                $("#msg").addClass("text-warning");
                $("#msg").text(
                    "There was an issue submitting your comment, please check your internet connection and try again."
                );
            },
        });
    });

    $(".discussion-comment-reply").on("click", function (event) {
        const button = $(event.target); // Button that triggered the modal
        const subcommentdiv = button.data("commentdiv"); // Extract info from data-* attributes
        $("#" + subcommentdiv).toggleClass("d-none");
    });

    $(".discussion-comment-like").on("click", function (event) {
        const button = $(this);
        const discussionId = button.data("commentid");
        const type = button.data("type");
        let replyId;
        let data = {};

        if (type == "comment") {
            data = {
                type: type,
                learning_course_id: $("#courseId").val(),
                learning_discussion_id: discussionId,
            };
        } else if (type == "reply") {
            replyId = button.data("replyid");
            data = {
                type: type,
                learning_course_id: $("#courseId").val(),
                learning_discussion_id: discussionId,
                learning_discussion_reply_id: replyId,
            };
        }

        $.ajax({
            url: "/yaedp/account/discussion/like",
            type: "POST",
            data: data,
            timeout: 5000,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            beforeSend: function () {
                //$("#submit-img").removeClass('d-none');
            },
            success: function (data) {
                if (data.result == "like") {
                    if (type == "comment") {
                        $("#commentlike" + discussionId).attr(
                            "src",
                            "/images/icons/chkdfav.png"
                        );
                    } else if (type == "reply") {
                        $("#replylike" + replyId).attr(
                            "src",
                            "/images/icons/chkdfav.png"
                        );
                    }
                } else {
                    if (type == "comment") {
                        $("#commentlike" + discussionId).attr(
                            "src",
                            "/images/icons/like.png"
                        );
                    } else if (type == "reply") {
                        $("#replylike" + replyId).attr(
                            "src",
                            "/images/icons/like.png"
                        );
                    }
                }
            },
            error: function (e, textStatus) {
                console.log(
                    "There was an issue submitting your comment, please check your internet connection and try again."
                );
            },
        });
    });
});
