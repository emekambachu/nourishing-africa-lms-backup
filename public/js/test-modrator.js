$(document).ready(function () {
    let tests = $('.test-moderator');
    for (let i = 0; i < tests.length; i++) {
        let config = tests.eq(i).data();
        new TestModrator({
            container: tests.eq(i),
            title: config.title,
            desc: config.desc,
            info: config.info,
            load_url: config.load,
            token: config.token,
            start_url: config.start,
            save_url: config.save,
            login_url: config.login,
            register_url: config.register,
            auth: config.auth,
            terms: config.terms,
            nav: config.nav,
            anonymous: config.anonymous,
        });
    }
})

class TestModrator {
    constructor(data) {
        let df = {
            container: $('.test-moderator'),
            data: {},
            title: '',
            desc: '',
            load_url: '',
            start_url: '',
            save_url: '',
            auth: 1,
            nav: 1,
            terms: 1,
        };
        $.extend(df, data);
        $.extend(this, df);
        this.actionNav = {};
        this.questionCnt = 0;
        this.total_numbering = 0
        this.prog = 0;
        this.question_skip = [];
        this.stop = false;
        this.initialize(df);
    }
    initialize(df) {
        this.container.empty();
        if (Object.keys(df.data).length) {
            this.title = df.data.title;
            this.rawData = df.data;
            this.render();
            this.sections = this.mapSections(df.data.subjects);
        } else {
            if (!this.auth) return this.container.append(this.renderAuth());
            this.container.append(this.renderLogin());
        }
    }
    renderAuth() {
        let auth = $(`
        <form class="auth-form">
            <div class="row">
                <div class="col-12 col-md-7 col-lg-6 login-form">
                    <div role="alert" class="alert alert-danger mt-2">
                        <span>You have to login to proceed.</span>
                    </div>
                    <a class="btn btn-success" href="${this.login_url}"> Login </a>
                    <a class="btn btn-success" href="${this.register_url}"> Register </a>
                </div>
            </div>
        </form>`);
        return auth;
    }
    renderLogin() {
        let obj = this;
        let login = $(`<div class="row assesment-intro"></div>`);
        if (this.desc.length) {
            login.append(`<div class="col-12 col-md-7 col-lg-8 border-right">${this.desc}</div>`);
        }
        login.append(`
        <div class="col text-center my-auto">
            <form class="auth-form d-inline-block" style="max-width:400px;">
                <div class="row">
                    <div class="col-12 login-form text-center">
                        <input type="hidden" name="_token" value="${this.token}" />
                    </div>
                </div>
            </form>
        </div>`);
        if (!obj.anonymous) {
            login.find('.login-form').append(`
            <div role="alert" class="alert alert-success mt-2">
                <span>You can start or resume with an email and password.</span>
            </div>
            <input type="email" name="email" required class="input-bg mt-2" placeholder="Email" />
            <input type="password" name="password" required class="input-bg mt-2" placeholder="Password" />
        `);
        }
        let start_but = $(`<button class="btn button-brand-color mt-2" type="button">Start <i class=""></i></button>`);
        login.find('.login-form').append(start_but);
        if (obj.info) {
            $(start_but).before(`<div role="alert" class="alert alert-success mt-2"><span>${obj.info}</span></div>`);
        }
        login.find('.login-form').append(`<div class="logging-alert pt-2"></div>`);
        start_but.on('click', function () {
            let form_dom = $('.auth-form', login);
            if (start_but.data('clicked')) return;
            if (!form_dom[0].reportValidity() && !start_but.data('clicked')) return;
            start_but.data('clicked', true);
            start_but.find('i').addClass('fa fa-spinner fa-spin')
            let form = new FormData(form_dom[0]);
            $.ajax({
                url: obj.start_url,
                method: 'POST',
                data: form,
                processData: false,
                contentType: false,
                success: function (data) {
                    start_but.data('clicked', false);
                    obj.rawData = data;
                    obj.total_numbering = data.numbering ? data.numbering : 1;
                    obj.prerequisites = data.prerequisites;
                    obj.sections = obj.mapSections(data.sections);
                    obj.render();
                    obj.container.find('.assesment-intro').hide();
                    obj.container.find('.test-group').show(1000);
                },
                error: function (data) {
                    start_but.data('clicked', false);
                    let l_alert = obj.container.find('.logging-alert');
                    let msg = data.responseJSON.error;
                    l_alert.html(`
                    <div role="alert" class="alert alert-danger mt-2">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <span><strong>${(msg && msg.length ? msg : 'sorry an error occured')}</strong>.</span>
                    </div>`);
                },
                complete: function () {
                    start_but.find('i').removeClass('fa fa-spinner fa-spin')
                    start_but.data('clicked', false);
                }
            });
        })
        return login;
    }
    //question render function
    render() {
        //reder pre form if any
        let preform = false;
        //build top section
        this.container.append(this.renderTopNav());
        this.container.append(this.renderBody());
        //show the first question set
        this.showDisplay(0);
        this.actionNavEvents();
        setTimeout(() => {
            this.vetCompletion();
        }, 2000);
        if (preform) this.container.find('.test-group').hide();
    }
    renderTopNav() {
        let top = $(`
        <div class="row test-group">
            <div class="col">
                <ul class="test-top-nav arrow-set arrow-set-success"></ul>
            </div>
        </div>`);
        if (this.nav == 0) {
            top.addClass('d-none');
        }
        let nav = top.find('.test-top-nav');
        for (let i = 0; i < this.rawData.sections.length; i++) {
            let sec = this.rawData.sections[i];
            let li = $(`<li class="secondary set-test-section-${sec.id} set-test-section" >
                            <span>${sec.title}</span>
                        </li>`);
            li.data('id', sec.id)
            li.data('title', sec.title)
            this.makeNavEvent(li);
            nav.append(li);
        }
        return top;
    }
    renderBody() {
        this.progressBar = $(`<div class="progress-bar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">0%</div>`);
        let body = $(`
        <div class="row  test-group">
            <div class="col-md-3 d-none d-md-block mt-2 test-side-nav"></div>
            <div class="col mt-2">
                <div class="row">
                    <div class="col">
                        <div class="progress mb-3 mt-3"></div>
                        <div class="test-alert"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col test-display" style="font-size:15px;"></div>
                </div>
                <div class="disclaimer mt-2 mb-2 p-1 border"></div>
                <div class="row">
                    <div class="col text-right test-bottom-nav"></div>
                </div>
            </div>
        </div>`);

        if (!this.anonymous && this.terms) {
            body.find('.disclaimer').append(`
                <h5>Terms of Submission</h5>
                <p>
                By submitting this form, I hereby agree to the terms and conditions, and confirm that the information contained in this form is true and correct to the best of my knowledge
                </p>
                <div class="form-check form-check-inline">
                    <input type="checkbox" class="form-check-input submit-acknowledge" id="terms_of_submisssion">
                    <label class="form-check-label" for="#terms_of_submisssion">I have read the terms and wish to submit</label>
                </div>
            `);
        }


        body.find('.progress').append(this.progressBar);
        let nav = body.find('.test-side-nav');
        // if (this.nav == 0) {
        if (true) {
            nav.removeClass('d-md-block');
            nav.addClass('d-none');
        }
        let bottomNav = body.find('.test-bottom-nav');
        let testDisplay = body.find('.test-display');
        for (let i = 0; i < this.rawData.sections.length; i++) {
            let sec = this.rawData.sections[i];
            let li = $(`<button style="font-size: 1vw;" class="btn btn-secondary btn-block text-nowrap text-truncate text-uppercase set-test-section-${sec.id} set-test-section" type="button">${sec.title}</button>`);
            li.data('id', sec.id);
            li.data('title', sec.title);
            this.makeNavEvent(li);
            nav.append(li);
            let dom_sec = this.renderSection(sec);
            testDisplay.append(dom_sec);
            //hide if not the first
            dom_sec.hide();
        }
        //add review screen
        testDisplay.append(`
        <div class="test-section test-review" data-id="review"></div>`);
        //Side navigation extra
        if (!this.anonymous) {
            this.actionNav.sideSave = $(`<button style="font-size: 1vw;" class="btn btn-warning btn-block text-nowrap text-truncate" type="button"> Save & Exit</button>`);
            this.actionNav.sideSave.data('type', 'save');
            nav.append(this.actionNav.sideSave);
        }

        this.actionNav.sideReview = $(`<button style="font-size: 1vw;" class="btn btn-success btn-block text-nowrap text-truncate" type="button">Review & Submit</button>`);
        this.actionNav.sideReview.data('type', 'review');
        nav.append(this.actionNav.sideReview);

        this.actionNav.sideSubmit = $(`<button style="font-size: 1vw;" class="btn btn-success btn-block text-nowrap text-truncate" type="button">Submit</button>`);
        this.actionNav.sideSubmit.data('type', 'submit');
        nav.append(this.actionNav.sideSubmit);

        //bottom navigation
        this.actionNav.prev = $(`<button class="float-left btn btn-sm btn-secondary mr-2" type="button">Previous</button>`);
        this.actionNav.prev.data('type', 'previous');
        bottomNav.append(this.actionNav.prev);

        if (!this.anonymous) {
            this.actionNav.save = $(`<button class="float-left btn btn-sm btn-warning mr-2" type="button">Save & Exit</button>`);
            this.actionNav.save.data('type', 'save');
            bottomNav.append(this.actionNav.save);
        }

        this.actionNav.next = $(`<button class="btn btn-sm btn-secondary mr-2"" type="button">Save & Continue</button>`);
        this.actionNav.next.data('type', 'next');
        bottomNav.append(this.actionNav.next);

        this.actionNav.review = $(`<button class="btn btn-sm btn-success mr-2" type="button">Review & Submit</button>`);
        this.actionNav.review.data('type', 'review');
        bottomNav.append(this.actionNav.review);

        this.actionNav.submit = $(`<button class="btn btn-sm btn-success" type="button">Submit</button>`);
        this.actionNav.submit.data('type', 'submit');
        bottomNav.append(this.actionNav.submit);
        return body;
    }

    renderSection(sect) {
        let dom = $(`<div class="test-section"></div>`);
        if (sect.instruction) dom.append(`
        <div role="alert" class="alert alert-info mt-2">
           ${sect.instruction}
        </div>`)
        dom.data('id', sect.id);
        for (let i = 0; i < sect.questions.length; i++) {
            let quest = sect.questions[i];
            let number = this.total_numbering ? ++this.questionCnt : i + 1;

            dom.append(this.renderQuenstion(quest, number));
        }
        return dom;
    }

    renderQuenstion(quest, cnt = 0) {
        let dom = $(`<div class="test-question test-question-${quest.id} border-bottom mb-3"></div>`);
        dom.data('id', quest.id);
        dom.data('type', quest.type);
        dom.data('subject', quest.subject_id);
        if (quest.word_limit) dom.data('wordLimit', quest.word_limit);
        let show = this.checkVisibility(quest.subject_id, quest.id);
        if (!show) {
            dom.addClass('d-none');
        }
        dom.append(`
        <span class="d-block">
            <span style="vertical-align: top;"><span class="q-num">${cnt}</span>.</span><span class="d-inline-block">${quest.question}</span>
        </span>`);
        let input = {};
        if (quest.answers) {
            quest.answers = quest.answers;
        } else if (quest.referee_answers) {
            quest.answers = quest.referee_answers;
        } else if (quest.survey_answers) {
            quest.answers = quest.survey_answers;
        } else {
            quest.answers = [];
        }
        let wasChoice = function (answ, id) {
            for (let i = 0; i < answ.length; i++) {
                if (id == answ[i].option_id) return true;
            }
            return false;
        }
        let getOther = function (answ, id) {
            for (let i = 0; i < answ.length; i++) {
                if (id == answ[i].option_id) {
                    if (answ[i].others == null || answ[i].others == 'null') return "";
                    return answ[i].others;
                }
            }
            return "";
        }
        let wasValueChoice = function (answ, value) {
            for (let i = 0; i < answ.length; i++) {
                if (value == answ[i].value) return true;
            }
            return false;
        }
        let obj = this;
        let createOthersField = function (input, opt, append_to, current_answer = "", show = false) {
            let o_id = `${opt.id}-others`;
            let sother = $(`<input type="text" class="w-100 others ${o_id}" placeholder="${(opt.placeholder ? opt.placeholder : '')}" value="${current_answer}" />`);
            sother.data('opt', opt.id);
            //indicate that this is an other field/relation type of field
            sother.data('is_other', true);
            if (!(current_answer.length > 0)) {
                sother.hide();
            }
            if (show) {
                sother.show();
            }
            //leasten to changes on the answer
            obj.makeAnswerEvent(sother);
            append_to.append(sother);
            input.data('others', o_id);
        }
        let other = $(`<div class="other-options"></div>`);
        let skip = ['date', 'email', 'phone', 'long-text'];
        if (quest.options.length == 0 && skip.indexOf(quest.type) < 0) quest.type = 'short-text';

        switch (quest.type) {
            case "radio":
                for (let i = 0; i < quest.options.length; i++) {
                    let opt = quest.options[i];
                    let id = `${this.questionCnt}-${i}`;
                    input = $(`<input type="radio" class="form-check-input test-answer" id="${id}" name="q${this.questionCnt}" />`);
                    switch ((opt.title ? opt.title : opt.name)) {
                        case 'N/A':
                            input.prop("checked", wasValueChoice(quest.answers, (opt.title ? opt.title : opt.name)));
                            break;
                        default:
                            input.prop("checked", wasChoice(quest.answers, opt.id));
                            break;
                    }
                    if (opt.others) createOthersField(input, opt, other, getOther(quest.answers, opt.id), wasChoice(quest.answers, opt.id));
                    this.makeAnswerEvent(input);
                    let domOpt = $(`
                    <label class="container_radio version_2" for="${id}">${(opt.title ? opt.title : opt.name)}
                    </label>`);
                    input.data('id', opt.id);
                    domOpt.prepend(input);
                    domOpt.prepend(`<span class="checkmark"></span>`);
                    dom.append(domOpt);
                }
                break;
            case "check":
                for (let i = 0; i < quest.options.length; i++) {
                    let opt = quest.options[i];
                    let id = `${this.questionCnt}-${i}`;
                    input = $(`<input type="checkbox" class="form-check-input test-answer" id="${id}" name="${id}" />`);
                    switch ((opt.title ? opt.title : opt.name)) {
                        case 'N/A':
                            input.prop("checked", wasValueChoice(quest.answers, (opt.title ? opt.title : opt.name)));
                            break;
                        default:
                            input.prop("checked", wasChoice(quest.answers, opt.id));
                            break;
                    }
                    if (opt.others) createOthersField(input, opt, other, getOther(quest.answers, opt.id), wasChoice(quest.answers, opt.id));
                    this.makeAnswerEvent(input);
                    let domOpt = $(`
                    <label class="container_check version_2" for="${id}">${(opt.title ? opt.title : opt.name)}
                    </label>`);
                    input.data('id', opt.id);
                    domOpt.prepend(input);
                    domOpt.prepend(`<span class="checkmark"></span>`);
                    dom.append(domOpt);
                }
                break;
            case "select":
            case "cselect":
            case "multi-select":
            case "cmulti-select":
                let id = this.questionCnt;
                switch (quest.type) {
                    case "multi-select":
                    case "cmulti-select":
                        input = $(`<select class="input-bg test-answer" multiple id="${id}" name="${id}"></select>`);
                        break;

                    default:
                        input = $(`<select class="input-bg test-answer" id="${id}" name="${id}"></select>`);
                        input.append(`<option value="">Select an option</option>`);
                        break;
                }
                for (let i = 0; i < quest.options.length; i++) {
                    let opt = quest.options[i];
                    let dom_opt = $(`<option value="${opt.id}">${(opt.title ? opt.title : opt.name)}</option>`);
                    switch (quest.type) {
                        case "cselect":
                        case "cmulti-select":
                            if (wasValueChoice(quest.answers, (opt.title ? opt.title : opt.name))) dom_opt.attr('selected', 'selected');
                            break;

                        default:
                            switch ((opt.title ? opt.title : opt.name)) {
                                case 'N/A':
                                    if (wasValueChoice(quest.answers, (opt.title ? opt.title : opt.name))) dom_opt.attr('selected', 'selected');
                                    break;
                                default:
                                    if (wasChoice(quest.answers, opt.id)) dom_opt.attr('selected', 'selected');
                                    break;
                            }
                            break;
                    }
                    if (opt.others) createOthersField(input, opt, other, getOther(quest.answers, opt.id), wasChoice(quest.answers, opt.id));
                    input.append(dom_opt);
                    dom.append(input);
                }
                this.makeAnswerEvent(input);
                break;
            case "email":
                input = $(`<input type="email" class="input-bg test-answer" placeholder="${(quest.placeholder ? quest.placeholder : '')}" />`);
                if (quest.default_value) input.val(quest.default_value)
                if (quest.answers.length) input.val(quest.answers[0].value);
                this.makeAnswerEvent(input);
                dom.append(input);
                break;
            case "phone":
                input = $(`<input type="phone" class="input-bg test-answer" placeholder="${(quest.placeholder ? quest.placeholder : '')}" />`);
                if (quest.default_value) input.val(quest.default_value)
                if (quest.answers.length) input.val(quest.answers[0].value);
                this.makeAnswerEvent(input);
                dom.append(input);
                break;
            case "short-text":
                input = $(`<input type="text" class="input-bg test-answer" placeholder="${(quest.placeholder ? quest.placeholder : '')}" />`);
                if (quest.default_value) input.val(quest.default_value)
                if (quest.answers.length) input.val(quest.answers[0].value);
                this.makeAnswerEvent(input);
                dom.append(input);
                break;
            case "date":
                input = $(`<input type="date" class="input-bg test-answer" placeholder="${(quest.placeholder ? quest.placeholder : '')}" />`);
                if (quest.default_value) input.val(quest.default_value)
                if (quest.answers.length) input.val(quest.answers[0].value);
                this.makeAnswerEvent(input);
                dom.append(input);
                break;
            default:
                input = $(`<textarea class="input-bg test-answer" placeholder="${(quest.placeholder ? quest.placeholder : '')}"></textarea>`);
                if (quest.default_value) input.val(quest.default_value)
                if (quest.answers.length) input.val(quest.answers[0].value)
                this.makeAnswerEvent(input);
                dom.append(input);
                break;
        }
        if (other.children().length) dom.append(other);
        if (quest.word_limit) {
            dom.append(`<div class="word-limit text-right">Word-Limit : ${this.countWords(input.val())}/${quest.word_limit}</div>`);
        }
        dom.append(`<div class="question-alert"></div>`)
        return dom;
    }
    countWords(value) {
        let sval = value.replace(/[.?]/gi, '').split(' ');
        return sval.length;
    }

    renderReviews() {
        //get review screen
        let screen = this.container.find('.test-review').eq(0);
        //clear screen
        screen.html('');
        //get all questions with there various answers
        //get the section keys first
        let s_cnt = 0;
        let t_cnt = 0;
        for (let sec_key in this.sections) {
            ++s_cnt;
            let q_cnt = 0;
            for (let quest_key in this.sections[sec_key].questions) {
                let quest = this.sections[sec_key].questions[quest_key];
                if (this.question_skip.indexOf(quest.id) >= 0) continue;
                let dom_quest = $(`<div class="border-bottom pb-3"></div>`);
                let number = this.total_numbering ? ++t_cnt : `${s_cnt} - ${++q_cnt}`;
                dom_quest.append(`<span class="d-block pb-1">${number}. ${quest.question}</span>`);
                dom_quest.append(`<span style="font-size:14px;">Answer:</span>`);
                if (quest.answers && quest.answers.length) {
                    for (let i = 0; i < quest.answers.length; i++) {
                        dom_quest.append(`<span class="text-success d-block">${quest.answers[i].value}</span>`);
                    }
                } else {
                    dom_quest.append(`<span class="text-danger">Not answered</span>`);
                }
                screen.append(dom_quest);
            }
        }
        //display review screeen
        this.showDisplay(this.rawData.sections.length);
    }

    scrollToView(dom_elms) {
        for (let i = 0; i < dom_elms.length; i++) {
            let dom_elem = dom_elms.eq(i);
            let container = dom_elem.parent();


        }
    }
    //used for knowing answered questions
    vetCompletion() {
        let ans = 0;
        let tot = 0;
        this.validatePrerequisit();
        for (let sec_key in this.sections) {
            let sec = this.sections[sec_key];
            let sec_ans = 0;
            let sec_tot = 0;
            for (let quest_key in sec.questions) {
                let quest = sec.questions[quest_key];
                if (this.question_skip.indexOf(quest.id) >= 0) continue;
                if (quest.answers && quest.answers.length) {
                    sec_ans++;
                    ans++;
                }
                sec_tot++;
                tot++;
            }
            let sec_state = sec_ans == sec_tot;
            let dom_secs = this.container.find(`.set-test-section-${sec.id}`);
            if (sec_state) {
                //top
                dom_secs.eq(0).removeClass('secondary');
                dom_secs.eq(0).addClass('success');
                //side
                dom_secs.eq(1).removeClass('btn-secondary');
                dom_secs.eq(1).addClass('btn-success');
            } else {
                //top
                dom_secs.eq(0).addClass('secondary');
                dom_secs.eq(0).removeClass('success');
                //side
                dom_secs.eq(1).removeClass('btn-success');
                dom_secs.eq(1).addClass('btn-secondary');
            }
        }
        this.prog = ans / tot * 100;
        this.updateProgress(parseInt(`${this.prog}`));
        this.validatePrerequisit();
        this.manageNavButtons();
    }
    //update progress
    updateProgress(per) {
        this.progressBar.attr('aria-valuenow', per);
        this.progressBar.css('width', `${per}%`);
        this.progressBar.text(`${per}%`);
        this.progressBar.data('state', per);
    }
    //used to toggle between test screen display
    showDisplay(id) {
        //hide all
        let allSecs = this.container.find('.test-section');
        let disclaimer = this.container.find('.disclaimer');
        if ((allSecs.length - 1) == id) {
            if (disclaimer.length) disclaimer.show();
        } else {
            if (disclaimer.length) disclaimer.hide();
            this.vetCompletion();
        }
        allSecs.hide();
        // show the one we want
        let v_sec = allSecs.eq(id);
        v_sec.show(1000);
        //stop blinking all buttons
        this.container.find('.set-test-section').removeClass('active').addClass('d-none')
            .find('a')
            .removeClass('active');
        //blink the current section in view
        let v_sec_id = v_sec.data('id');
        if (v_sec_id) {
            let dom_v_sec = this.container.find(`.set-test-section-${v_sec_id}`);
            dom_v_sec.addClass('active').removeClass('d-none').find('a').addClass('active');
            this.scrollToView(dom_v_sec);
        }

        // if the display is last, hide next
        if (id == allSecs.length - 1) {
            this.actionNav.next.hide();
            this.actionNav.prev.show();
        } else if (id == 0) {
            this.actionNav.next.show();
            this.actionNav.prev.hide();
        } else {
            this.actionNav.next.show();
            this.actionNav.prev.show();
        }
        this.manageNavButtons();
    }
    //save the test
    saveTest(cl = false, sc = null, sub = false) {
        let obj = this;
        //get the submission and inject form token
        let submition = this.compileTest(sub);
        obj.container.find('.test-alert').html(`<div class="text-danger text-right d-block w-100"><i class="fa fa-spinner fa-spin"></i></div>`);
        submition._token = this.token;

        $.ajax({
            url: this.save_url,
            method: 'POST',
            data: submition,
            success: function (data) {
                obj.actionNav.next.find('.loading').remove();
                if (sc != null) obj.showDisplay(sc);
                if (cl) {
                    obj.questionCnt = 0;
                    obj.closeWith('Save successful, you can continue at a later time.')
                }
                if (sub) {
                    obj.questionCnt = 0;
                    obj.closeWith('Thanks for your submission!');
                }
                obj.container.find('.test-alert').html(`
                    <div role="alert" class="alert alert-success mt-2">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <span><strong>${data.success}</strong>.</span>
                    </div>
                `);
            },
            error: function (data) {
                obj.actionNav.next.find('.loading').remove();
                let msg = 'Sorry an error occured, try saving again';
                if (data.responseJSON.error) {
                    msg = data.responseJSON.error;
                }
                obj.container.find('.test-alert').html(`
                    <div role="alert" class="alert alert-danger mt-2">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <span><strong>${msg}</strong>.</span>
                    </div>
                `);
            },
        });
    }
    //close the survey
    closeWith(msg) {
        let obj = this;
        obj.container.find('.assesment-intro').show(1000);
        obj.container.find('.test-group').hide(1000, function () {
            let l_alert = obj.container.find('.logging-alert');
            l_alert.html(`
            <div role="alert" class="alert alert-success mt-2">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <span><strong>${msg}</strong></span>
            </div>`);
            //house cleaning time
            obj.container.find('.test-group').remove();
            obj.rawData = null;
            obj.sections = null;
        });
    }
    //submit test
    submitTest() {
        let vet = $('.submit-acknowledge', this.container)
        if (vet.length && !vet.is(':checked')) {
            this.container.find('.test-alert').html(`
                <div role="alert" class="alert alert-danger mt-2">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <span><strong>You have to agree to our submission terms and conditions</strong>.</span>
                </div>
            `);
            return vet.focus();
        }
        if (this.anonymous) {
            this.saveTest(false, null, true);
        } else {
            let obj = this;
            dual_act("Are you sure you want to submit?", {
                callback: function () {
                    obj.saveTest(false, null, true);
                },
                title: "Yes",
                style: 'success',
            }, {
                callback: function () { },
                title: "No",
                style: 'danger',
            });
        }
    }
    //compile test
    compileTest(sub = false) {
        let obj = this;
        //get active screen
        let allSecs = obj.container.find('.test-section');
        let activeSection;
        $.each(allSecs, function (i) {
            if ($(this).is(':visible')) {
                activeSection = $(this).data('id');
            }
        });
        //get preform data
        let subm = {};
        subm.id = obj.rawData.id;
        subm.answers = [];
        subm.submit = sub ? 1 : 0;
        //set submission id for save
        if (obj.rawData.sub_id) subm.sub_id = this.rawData.sub_id;
        //get the survey/test entry
        for (let sec_key in obj.sections) {
            let sec = obj.sections[sec_key];
            for (let quest_key in sec.questions) {
                let quest = sec.questions[quest_key];
                if (quest.answers && quest.answers.length) {
                    quest.answers.forEach(function (ans) {
                        subm.answers.push(ans);
                        if (ans.option_id) {
                            let other_id = `${ans.option_id}-others`;
                            $(`.${other_id}-alert`).remove();
                            let other = $(`.${other_id}`);
                            let otherVal = other.val();
                            if (other.is(':visible') && !otherVal.length) {
                                other.after(`
                                <div role="alert" class="alert alert-danger ${other_id}-alert">
                                    <span><strong>This input is required</strong>.</span>
                                </div>`);
                                $('html,body').animate({
                                    scrollTop: other.offset().top - 100
                                }, 1000);
                                obj.actionNav.next.find('.loading').remove();
                                throw new Error('A required question has not been answered')
                            }
                        }
                    });
                } else if (sec.id == activeSection) {
                    let domRef = $(`.test-question-${quest.id}`);
                    $('.question-alert', domRef).html(`
                    <div role="alert" class="alert alert-danger mt-2">
                        <span><strong>This question requires an answer</strong>.</span>
                    </div>`);
                    $('html,body').animate({
                        scrollTop: domRef.offset().top - 100
                    }, 1000);
                    obj.actionNav.next.find('.loading').remove();
                    throw new Error('A required question has not been answered')
                }
            }
        }
        return subm;
    }

    //bind question option event
    makeAnswerEvent(dom) {
        let obj = this;
        dom.on('change input', function () {
            //get the section data
            let sData = $(this).closest('.test-section').eq(0).data();
            //get the dom reference to the question
            let domQuest = $(this).closest('.test-question').eq(0);
            $('.question-alert', domQuest).empty();
            //get the qustion data
            let qData = domQuest.data();
            //get the question reference
            let quest = obj.sections[`sec_${sData.id}`].questions[`quest_${qData.id}`];

            let cval = $(this).val();
            let cdata = $(this).data();
            let skip = ['date', 'email', 'phone', 'long-text'];
            qData.type = quest.type;
            if (quest.options.length == 0 && skip.indexOf(quest.type) < 0) qData.type = 'short-text';
            let type = cdata.is_other ? 'others' : qData.type;

            //clear the current answer key
            if (type != 'others') quest.answers = [];
            //regex for email
            const re = /\S+@\S+\.\S+/;

            switch (type) {
                case 'radio':
                    //hide all other filds in this question
                    $('.others', domQuest).hide();
                    //get option title
                    let opt = quest.options[`opt_${cdata.id}`]
                    let ans = {
                        option_id: opt.id,
                        question_id: qData.id,
                        value: (opt.title ? opt.title : opt.name),
                    }
                    if ($(`.${cdata.id}-others`, domQuest).length) {
                        $(`.${cdata.id}-others`, domQuest).show();
                    }
                    if (cdata.others) ans.others = $(`.${cdata.others}`, domQuest).val();
                    if (opt.title == 'N/A') delete ans.option_id
                    quest.answers.push(ans);
                    break;
                case 'cmulti-select':
                case 'cselect':
                    //hide all other filds in this question
                    $('.others', domQuest).hide();
                    if (cval.length) {
                        //make answer array if no array so as to serve for multiple
                        if (!Array.isArray(cval)) cval = [cval];
                        for (let i = 0; i < cval.length; i++) {
                            let opt = quest.options[`opt_${cval[i]}`];
                            let ans = {
                                option_id: opt.id,
                                question_id: qData.id,
                                value: (opt.title ? opt.title : opt.name),
                            }
                            if (opt.title == 'N/A') delete ans.option_id
                            quest.answers.push(ans);
                        }
                    }
                    break;
                case 'multi-select':
                case 'select':
                    //hide all other filds in this question
                    $('.others', domQuest).hide();
                    if (cval.length) {
                        if ($(`.${cval}-others`, domQuest).length) {
                            $(`.${cval}-others`, domQuest).show();
                        }
                        //make anser array if no array so as to serve for multiple
                        if (!Array.isArray(cval)) cval = [cval];
                        for (let i = 0; i < cval.length; i++) {
                            let opt = quest.options[`opt_${cval[i]}`];
                            let ans = {
                                option_id: opt.id,
                                question_id: qData.id,
                                value: (opt.title ? opt.title : opt.name),
                            }
                            if (opt.title == 'N/A') delete ans.option_id
                            quest.answers.push(ans);
                        }
                    }
                    break;
                case 'check':
                    //hide all other filds in this question
                    $('.others', domQuest).hide();
                    //get all the checked answers
                    let opts = domQuest.find('.test-answer');
                    for (let i = 0; i < opts.length; i++) {
                        let domOpt = opts.eq(i);
                        if (!domOpt.is(':checked')) continue;
                        let optID = domOpt.data('id');
                        if ($(`.${optID}-others`, domQuest).length) {
                            $(`.${optID}-others`, domQuest).show();
                        }
                        //get the local option data
                        let opt = quest.options[`opt_${optID}`]
                        quest.answers.push({
                            option_id: opt.id,
                            question_id: qData.id,
                            value: (opt.title ? opt.title : opt.name),
                        });
                    }
                    break;
                case "email":
                    if (re.test(String(cval).toLowerCase())) {
                        quest.answers.push({
                            value: cval,
                            question_id: qData.id,
                        });
                    } else {
                        $('.question-alert', domQuest).html(`
                        <div role="alert" class="alert alert-danger mt-2">
                            <span><strong>Invalid email</strong>.</span>
                        </div>`);
                    }
                    break;
                case "phone":
                    if (cval.length > 10) {
                        quest.answers.push({
                            value: cval,
                            question_id: qData.id,
                        });
                    } else {
                        $('.question-alert', domQuest).html(`
                        <div role="alert" class="alert alert-danger mt-2">
                            <span><strong>Invalid mobile number</strong>.</span>
                        </div>`);
                    }
                    break;
                case 'others': //for appending infor from the other field
                    let other = $(this).data();
                    //get the relevant anser and append the value
                    for (let i = 0; i < quest.answers.length; i++) {
                        let ans = quest.answers[i];
                        if (ans.option_id && ans.option_id == other.opt) ans.others = cval;
                    }
                    break;
                case 'short-text':
                default:
                    if (cval.length) {
                        //limit word count
                        if (qData['wordLimit']) {
                            if (obj.countWords(cval) > qData['wordLimit']) {
                                let excess = (obj.countWords(cval) - qData['wordLimit']);
                                let sval = cval.split(' ');
                                sval.splice(excess * -1);
                                cval = sval.join(' ');
                                $(this).val(cval);
                            }
                            //update word count display
                            $('.word-limit', domQuest).html(`Word-Limit : ${obj.countWords(cval)}/${qData['wordLimit']}`)
                        }
                        quest.answers.push({
                            value: cval,
                            question_id: qData.id,
                        });
                    }
            }
            obj.vetCompletion();
        });
    }
    checkVisibility(dep_subject, dep_question) {
        let obj = this;
        let valid = true;
        if (obj.prerequisites) {
            for (let i = 0; i < obj.prerequisites.length; i++) {
                let pr = obj.prerequisites[i];
                if (pr.dep_subject_id == dep_subject && pr.dep_question_id == dep_question) {
                    //ensure the required question has been answered
                    let quest = obj.sections[`sec_${pr.req_subject_id}`].questions[`quest_${pr.req_question_id}`];
                    valid = quest.answers.find(el => el.value == pr.req_answer) != undefined;
                    break;
                }
            }
        }

        return valid;
    }
    manageNavButtons() {
        let obj = this;
        let allSecs = obj.container.find('.test-section');
        let activeSection;
        $.each(allSecs, function (i) {
            if ($(this).is(':visible')) {
                activeSection = i;
            }
        });
        if ((allSecs.length - 1) == activeSection) {
            obj.actionNav.review.hide();
            obj.actionNav.sideReview.hide();
            obj.actionNav.next.hide();
            obj.actionNav.prev.show();

            if (obj.prog == 100) {
                obj.actionNav.sideSubmit.show();
                obj.actionNav.submit.show();
            } else {
                obj.actionNav.sideSubmit.hide();
                obj.actionNav.submit.hide();
            }
        } else {
            obj.actionNav.submit.hide();
            obj.actionNav.sideSubmit.hide();

            obj.actionNav.prev.hide();
            obj.actionNav.next.show();
            if (activeSection > 0) {
                obj.actionNav.prev.show();
            }
            if (obj.prog == 100) {
                obj.actionNav.review.show();
                obj.actionNav.sideReview.show();
                if (obj.anonymous) {
                    obj.actionNav.review.hide();
                    obj.actionNav.sideReview.hide();
                    obj.actionNav.submit.show();
                    obj.actionNav.sideSubmit.show();
                }
            }
        }
        if (obj.prog != 100) {
            obj.actionNav.next.addClass('btn-secondery');
            obj.actionNav.next.removeClass('btn-success');
        } else {
            obj.actionNav.next.addClass('btn-success');
            obj.actionNav.next.removeClass('btn-secondery');
        }
        if (obj.stop) {
            //hide next buton
            obj.actionNav.next.hide();
            obj.actionNav.review.hide();
            obj.actionNav.sideReview.hide();
            obj.actionNav.submit.hide();
            obj.actionNav.sideSubmit.hide();
            if (activeSection > 0) {
                obj.actionNav.prev.hide();
            }
        }
    }
    validatePrerequisit() {
        let obj = this;
        let dom_questions = $('.test-question');
        obj.stop = false;
        if (obj.prerequisites) {
            for (let i = 0; i < obj.prerequisites.length; i++) {
                let pr = obj.prerequisites[i];
                let num = 1;
                $.each(dom_questions, function () {
                    let data = $(this).data();
                    if (pr.stop) {
                        if (pr.req_subject_id == data.subject && pr.req_question_id == data.id) {
                            let quest = obj.sections[`sec_${pr.req_subject_id}`].questions[`quest_${pr.req_question_id}`];
                            let valid = quest.answers.find(el => el.value == pr.req_answer) != undefined;
                            $('.stop-msg', $(this)).remove();
                            if (!valid && quest.answers.length) {
                                obj.stop = true;
                                $(this).append(`<div class="alert alert-primary stop-msg" role="alert">${pr.stop_msg}</div>`);
                            }
                        }
                    } else {
                        let visible = obj.checkVisibility(data.subject, data.id);
                        let skip_index = obj.question_skip.indexOf(data.id);
                        if (visible) {
                            if (skip_index >= 0) {
                                obj.question_skip.splice(skip_index, 1);
                            }
                            $(this).removeClass('d-none');
                        } else {
                            if (skip_index < 0) {
                                obj.question_skip.push(data.id)
                            }
                            $(this).addClass('d-none');
                        }
                    }
                    if (!$(this).hasClass('d-none')) {
                        $('.q-num', $(this)).html(num++);
                    }
                });
            }
        }
    }
    //bind action nav events
    actionNavEvents() {
        this.makeActionNavEvent(this.actionNav.next);
        this.makeActionNavEvent(this.actionNav.prev);
        this.makeActionNavEvent(this.actionNav.review);
        if (this.actionNav.save) {
            this.makeActionNavEvent(this.actionNav.save);
        }
        this.makeActionNavEvent(this.actionNav.submit);
        if (this.actionNav.sideSave) {
            this.makeActionNavEvent(this.actionNav.sideSave);
        }
        this.makeActionNavEvent(this.actionNav.sideReview);
        this.makeActionNavEvent(this.actionNav.sideSubmit);
    }
    makeActionNavEvent(nav) {
        let obj = this;
        let callback = function () {
            let data = $(this).data();
            var now = false;
            let allSecs = obj.container.find('.test-section');
            switch (data.type) {
                case 'next':
                    nav.append(`<i class="loading fa fa-spinner fa-spin"></i>`);
                case 'previous':
                    for (let i = 0; i < allSecs.length; i++) {
                        if (now) {
                            if (i == allSecs.length - 1) {
                                obj.saveTest(false, i);
                                return obj.renderReviews();
                            }
                            if (now && data.type == 'previous') return obj.showDisplay(i);
                            return obj.saveTest(false, i);
                        }
                        now = allSecs.eq(i).is(':visible');

                        if (now && data.type == 'previous') {
                            i = i - 2;
                        }
                    };
                    break;
                case 'save':
                    obj.saveTest(true);
                    break;
                case 'submit':
                    obj.submitTest();
                    break;
                case 'review':
                    obj.renderReviews();
                    break;
            }
        }
        //next button
        nav.on('click', callback);
    }

    //bind section navigation events
    makeNavEvent(nav) {
        let obj = this;
        $(nav).on('click', function () {
            let data = $(this).data();
            let allSecs = obj.container.find('.test-section');
            for (let i = 0; i < allSecs.length; i++) {
                let set = allSecs.eq(i);
                let id = set.data('id');
                if (data.id != id) continue;
                obj.showDisplay(i);
            }
        });
    }
    //Questions mappers
    mapSections(secs) {
        let mapped = {};
        for (let i = 0; i < secs.length; i++) {
            let sec = Object.assign({}, secs[i]);
            sec.questions = this.mapQuestions(sec.questions);
            mapped[`sec_${secs[i].id}`] = sec;
        }
        return mapped;
    }
    mapQuestions(quests) {
        let mapped = {};
        for (let i = 0; i < quests.length; i++) {
            let quest = Object.assign({}, quests[i]);
            if (quest.answers) {
                quest.answers = quest.answers;
            } else if (quest.referee_answers) {
                quest.answers = quest.referee_answers;
            } else if (quest.survey_answers) {
                quest.answers = quest.survey_answers;
            }
            quest.options = this.mapOptions(quest.options);
            mapped[`quest_${quests[i].id}`] = quest;
        }
        return mapped;
    }
    mapOptions(opt) {
        let mapped = {};
        for (let i = 0; i < opt.length; i++) {
            mapped[`opt_${opt[i].id}`] = opt[i];
        }
        return mapped;
    }
}
