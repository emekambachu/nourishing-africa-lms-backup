//type value must correspond to standard bootstrap style
function pop_alert_call(message = '', type = 'info', clear = false, timer = 0) {
    //clear previous pop alert display
    $('#pop-alert').remove();
    //write new pop alert  
    if (!clear) {
        let msg = $(`
		<div class="align-content-center pop-alert" id="pop-alert">
			<div role="alert" class="alert alert-${type} pop-alert-text">
			</div>
        </div>`);
        let close = $(`
        <button class="btn btn-${type}' btn-sm close-pop-alert" type="button">
                <i class="fa fa-close"></i>
        </button>`).on('click', function(){
            $('#pop-alert').remove();
            $(this).closest('#pop-alert').remove();
        })
        $('.alert', msg).append(close);
        $('.alert', msg).append(message);
        $('body').append(msg);
        if (timer > 0) {
            setTimeout(function() {
                pop_alert_call('', '', true);
            }, timer);
        }
    }
}
//position_id is the id of the element you want it to show in
function inline_alert(message, type = 'info', position_id) {
    var alert_id = position_id.replace('#', '');
    alert_id = alert_id.replace('[name="', '');
    alert_id = alert_id.replace('"]', '') + '_alert';
    //clear previous pop alert display
    $('#' + alert_id).remove();
    message = '\n\
		<div role="alert" class="alert alert-' + type + '" id="' + alert_id + '">\n\
			<button class="btn btn-' + type + ' btn-sm close-inline-error" onClick="$(\'#' + alert_id + '\').remove()" type="button"><i class="fa fa-close"></i></button>\n\
			<span><strong>' + message + '</strong></span>\n\
			<i class="fa fa-exclamation-triangle"></i>\n\
		</div>'
    $(message).insertAfter(position_id);
}
//position_id is the id of the element you want it to show in
function box_alert(message, type = 'info', position_id) {
    var alert_id = position_id.replace('#', '');
    alert_id = alert_id.replace('[name="', '');
    alert_id = alert_id.replace('"]', '') + '_alert';
    //clear previous pop alert display
    $('#' + alert_id).remove();
    message = '\n\
		<div role="alert" class="alert alert-' + type + '" id="' + alert_id + '">\n\
			<button class="btn btn-' + type + ' btn-sm close-inline-error" onClick="$(\'#' + alert_id + '\').remove()" type="button"><i class="fa fa-close"></i></button>\n\
			<span><strong>' + message + '</strong></span>\n\
		</div>';
    $('#' + alert_id + '_box').append(message);
}
var popover_alert_log = [];
//used to generate popover alerts
function popover_alert(message, type = 'info', position_id) {
    var alert_id = (jQuery.type(position_id) === 'object') ? position_id : $(position_id);
    //log the alert_id's
    popover_alert_log.push(alert_id);
    //clear previous pop alert display
    let opt = {
        'content': message,
        'placement': "right",
        'template': '<div class="popover" elm="' + alert_id.attr('id') + '" role="tooltip"><div class="arrow"></div><h3 class="popover-header"></h3><div class="popover-body alert-' + type + '"></div></div>'
    };
    alert_id.popover(opt);
    alert_id.popover('show');
}
//clear all pop over alerts
function clear_popover_alert() {
    for (var i = 0; i < popover_alert_log.length; i++) {
        clr_popover(popover_alert_log[i].eq(0));
    }
}
//clear  pop over alerts
function clr_popover_alert(elm) {
    if (elm.data("bs.popover")) {
        clr_popover(elm);
    }
}
//clear  pop over alerts
function clr_popover(elm) {
    elm.popover('dispose');
}

//clear inline_alert once the input box is on focus
$(document).on('keypress click', 'input, textarea, checkbox, radio', function() {
    clr_popover_alert($(this));
});

$(document).on('click', '.popover', function() {
    clr_popover_alert($('#' + $(this).attr('elm')));
});

//listen for confirmation request
/**
 * This event runs the functions that are needed to confirm a users request
 * NOTE: multiple functions can be passed, but must be seperated by ||
 */
$(document).on('click', '.confirm_act', function() {
    var callback = $(this).data('callback');
    var close = $(this).data('close');
    if(close) close();
    if (callback) callback();
});

//custom confirmation alert
function confirm_act(callback, msg = "Are you sure?") {
    pop_alert_call(msg + ' <button type="button" class="confirm_act btn btn-success btn-sm" data-callback="' + callback + '||$(\'.close-pop-alert\').click()">Yes</button>\n\
                        <button type="button" class="btn btn-danger btn-sm btn-close-ns" data-element="#pop-alert">No</button>', 'light');
}
//custom confirmation alert
function dual_act(msg = "Do you want to ", btn1CallBack = { callback: function() {}(), title: "" }, btn2CallBack = { callback: function() {}(), title: "" }) {
    if (!("title" in btn1CallBack) || !("callback" in btn1CallBack) || !("title" in btn2CallBack) || !("callback" in btn2CallBack)) return console.log("dual_act miss use")
    user_interact(msg, [btn1CallBack, btn2CallBack])
}

function user_interact(msg = "Do you want to ", buttons = [{ callback: function() {}, title: "", style: 'info', separator: ' OR ' }, ], style) {
    if (!$.isArray(buttons)) return console.error('buttons must be an array in  this format [{ callback: function() {}, title: "" },]');
    msg = $(`<div>${msg}</div>`)
    let btns = $(`<span class="d-block"></span>`)
    for (let i = 0; i < buttons.length; i++) {
        let but = buttons[i];
        but = $.extend(true, { callback: function() {}, title: "", style: 'info', separator: ' - ', }, but);
        let btn = $(`<button type="button" class="btn btn-${(but.style || "info")} btn-sm mt-2 mr-1">${but.title}</button>`);
        btn.on('click', function(){
            but.callback();
            $('.close-pop-alert').click();
        });
        btns.append(btn);
    }
    msg.append(btns);
    pop_alert_call(msg, style ? style : 'light');
}
/**
 * 
 * @param {*} msg 
 * @param {*} btns  
 */
function multi_act(msg = "Do you want to ", btns = [{ callback: `function() {}()`, title: "" }], style) {
    user_interact(msg, btns, style);
}

// $(document).ready(function() {
//     createStackBar({ title: 'Hey, 1 min to go', msg: 'We find it friendly to say your test remains 5 minutes' });
// });
/**
 * Stackbar alert system fo smart notofication
 * data.action = {
 *  "attr": {"data-id":12,},
 *  "type":"primary",
 *  "text":"OK",
 * }
 */
var createStackBar = function(data) {

        let toWrite = '',
            title = data.title ? data.title : '',
            msg = data.msg ? data.msg : '',
            type = data.type ? data.type : 'dark',
            noOk = 'noOk' in data ? data.noOk : true,
            action = '',
            btnAction = data.actions ? data.actions : [],
            timer = data.timer ? data.timer : 0;

        if (noOk) {
            let attrs = [];

            if (Array.isArray(btnAction))
                for (var i = 0; i < btnAction.length; i++) processActions(btnAction[i]);
            else if (Object.keys(btnAction).length) processActions(btnAction);
            else action = '<button class="btn btn-primary action hide-stack" type="button">OK!</button>';

            function processActions(btnAction) {
                if (Array.isArray(btnAction.attrs) && btnAction.attrs.length)
                    attrs = btnAction.attrs.map(attr => ` ${attr.name}="${attr.value}"`);

                action += `<button class="btn btn-sm btn-${btnAction.type ? btnAction.type : 'primary'} action hide-stack ${btnAction.class ? ' ' + btnAction.class : ''}" type="button"${attrs.join('')}>${btnAction.text ? btnAction.text :
                'OK!'}</button>`;
            }
        }

        let stacks = $('.stack-bar'),
            stacksLen = stacks.length;

        if (stacksLen >= 5) closeStackBar($('.stack-bar').eq(0).attr('id'));

        var barsPar = $('#stacks-bar');
        if (!barsPar[0]) {
            $('body').append('<div id="stacks-bar" class="stacks-bar"></div>');
            barsPar = $('#stacks-bar');
        }

        return new Promise((resolve, reject) => {
                    if (!title && !msg) return console.error('One of Title or Message must be passed');
                    let stackInd = 1,
                        stackID = 'stack-bar_' + stackInd;
                    while (document.getElementById(stackID)) stackID = 'stack-bar_' + stackInd++;
                    toWrite += `
            <div id="${stackID}" style="bottom: -500px" class="stack-bar notif d-block alert-${type} text-white text-center">
                ${action.length ? "" : `<button class="btn btn-danger btn-sm hide-stack closer" type="button"><i class="fa fa-sign-out"></i></button>`}
                <div class="row">
                    <div class="col notif-body">
                        ${title ? '<span class="h3 text-nowrap text-truncate heading">' + title + '</span>' : ''}
                        ${msg ? '<div class="text-nowrap text-truncate msg"><span>' + msg + '</span></div>' : ''}${action}
                    </div>
                </div>
            </div>`;
        barsPar.append(toWrite);
        if (timer > 0) setTimeout(function () { closeStackBar($('#' + stackID).attr('id')); }, timer * 1000);

        // barsPar.animate({ scrollLeft: barsPar[0].scrollWidth });
        activateStackBars(stackID);
        resolve((function () {
            $('#' + stackID).animate({ bottom: '0px' }, 500);
        })());
    });
},
    activateStackBars = function (stackID) {
        (function () {
            var stBlcks = $('.stack-bar.blocker'),
                stBlcksLen = stBlcks.length,
                thisBlck;

            for (var i = 0; i < stBlcksLen; i++) {
                thisBlck = stBlcks.eq(i);
                thisBlck.css('height', thisBlck.next().outerHeight() + 'px');
            }
        })();
    },
    closeStackBar = function (id) {
        let stack = $('#' + id),
            barsPar = stack.parent();
        stack.animate({
            right: "-300"
        }, 500, function () {
            stack.remove();
        });
    };

$(document).on('click', '.stack-bar.notif .hide-stack', function () {
    //notify server that the notification was
    let id = $(this).data("id");
    if (id) {
        $.post("/notification/api/seen.php", { id: id, stack: $(this).closest('.stack-bar').attr('id') }, function (data) {
            closeStackBar(data.stack);
        });
    } else {
        closeStackBar($(this).closest('.stack-bar').attr('id'));
    }
});