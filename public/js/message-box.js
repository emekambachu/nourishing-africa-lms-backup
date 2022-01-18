$(document).on('click', '.msg-box', function () {
    my_msg_box($(this).data());
});
$(document).on('click', '.msg-box-reload', function () {
    let data = $(this).data();
    data.closeCallback = function () {
        location.reload(true);
    }
    my_msg_box(data);
});

function fallbackCopyTextToClipboard(text) {
    var textArea = document.createElement("textarea");
    textArea.value = text;

    // Avoid scrolling to bottom
    textArea.style.top = "0";
    textArea.style.left = "0";
    textArea.style.position = "fixed";

    document.body.appendChild(textArea);
    textArea.focus();
    textArea.select();

    try {
        var successful = document.execCommand('copy');
        var msg = successful ? 'successful' : 'unsuccessful';
        console.log('Fallback: Copying text command was ' + msg);
    } catch (err) {
        console.error('Fallback: Oops, unable to copy', err);
    }

    document.body.removeChild(textArea);
}
function copyTextToClipboard(text) {
    if (!navigator.clipboard) {
        fallbackCopyTextToClipboard(text);
        return;
    }
    navigator.clipboard.writeText(text).then(function () {
        console.log('Async: Copying to clipboard was successful!');
    }, function (err) {
        console.error('Async: Could not copy text: ', err);
    });
}

//used to ask questions before delete
$(document).on('click', '.record-delete, .record-update', function () {
    let rdata = $(this).data();
    if (!rdata.form) return console.error('this element must have data attribute form');
    let msg = rdata.msg ?? 'Are you sure you want to delete this record';
    let data = {
        title: rdata.title ?? 'Delete',
        contents: `
        <div class="text-center">
            ${msg}
        </div>`,
        footer: `
        <div>
            <button class="btn ripple btn-danger form-trigger" data-form="${rdata.form}" type="button">Yes</button>
            <button class="btn ripple btn-success" data-dismiss="modal" type="button">Close</button>
        </div>`,
        size: 'sm',
    }
    my_msg_box(data);
});

//trigger a form submission
$(document).on('click', '.form-trigger', function () {
    let rdata = $(this).data();
    if (!rdata.form) return console.error('this element must have data attribute form');
    $(rdata.form, document).submit();
});

function my_msg_box(data) {
    return new Promise((resolve, reject) => {
        let keys;
        if (!data || !(keys = Object.keys(data)))
            reject("Data Object must be passed");
        if (
            keys.indexOf("title") < 0 &&
            keys.indexOf("url") < 0 &&
            keys.indexOf("contents") < 0
        )
            reject("One of title, url or contents must to be passed");

        msg_box(
            "title" in data ? data.title : "",
            "url" in data ? data.url : "",
            "placeholder" in data ? data.placeholder : "",
            "size" in data ? data.size : "big",
            "contents" in data ? data.contents : "",
            "id" in data ? data.id : "msg_box",
            "style" in data ? data.style : "",
            "checkExist" in data ? data.checkExist : false,
            "openCallback" in data ? data.openCallback : "",
            "closeCallback" in data ? data.closeCallback : "",
            "footer" in data ? data.footer : ""
        ).then(x => resolve(x));
    });
}

function msg_box(
    title = "",
    url = "",
    placeholder = "",
    size = "big",
    contents = "",
    id = "msg_box",
    style = "",
    checkExist = false,
    openCallback = "",
    closeCallback = "",
    footer
) {
    return new Promise((resolve, reject) => {
        switch (size) {
            case "s":
            case "small":
                modal_size = "modal-sm"
                break;
            case "b":
            case "big":
                modal_size = "modal-lg"
                break;
            default:
                modal_size = ""
                break;
        }
        if (checkExist) {
            if ($("#" + id) !== undefined) {
                $("#" + id).modal({
                    keyboard: true,
                    show: true,
                    backdrop: "static"
                });
                return;
            }
        } else {
            let a = $("#" + id);
            if (a.length) {
                if (a.css("display") != "none") {
                    a.find("[data-dismiss=modal]").eq(0).click();
                }
                a.remove();
            }
        }
        var content = $(`
        <div role="dialog" tabindex="-1" class="modal fade show" id="${id}" style="z-index:2000;">
            <div class="modal-dialog modal-dialog-centered ${modal_size}" role="document">\n\
                <div class="modal-content" style="${style}">
                </div>
            </div>
        </div>`);
        let modal_container = content.find('.modal-content').eq(0);
        if (title !== "") modal_container.append(`
            <div class="modal-header a_msg_box">
                <h5>${title}</h5>
                <button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">×</span></button>
            </div>`);
        if (url.length) modal_container.append(`<iframe src="${url}" width="100%" height="${$(window).height() - 150}" style="border:none;"></iframe>`);
        else modal_container.append(contents);
        if (footer) {
            modal_container.append(`<div class="modal-footer"></div>`);
            modal_container.find('.modal-footer').eq(0).append(footer)
        }

        content = $(content);
        switch (typeof placeholder) {
            case "object":
                if (placeholder) {
                    placeholder.append(content);
                } else {
                    $("body").append(content);
                }
                break;
            case "string":
                if (placeholder.length) {
                    $(placeholder).append(content);
                } else {
                    $("body").append(content);
                }
                break;
            default:
                $("body").append(content);
                break;
        }
        resolve(
            (function () {

                if (typeof openCallback === "function") openCallback();

                if (typeof closeCallback === "function") {
                    $("[data-dismiss]", content).on("click", function () {
                        closeCallback();
                        $("[data-dismiss]", content).off("click", closeCallback);
                    });
                }
                content.modal({
                    // keyboard: true,
                    // show: true,
                    backdrop: "static"
                });
            })()
        );
    });
}
