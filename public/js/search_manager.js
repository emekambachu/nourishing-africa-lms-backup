$(document).ready(function () {
    new SearchManager($('#search_loader'));
});

class SearchManager {
    field_count = 0;
    lang = {
        '>': 'is greater than',
        '<': 'is less than',
        '>=': 'is greater than or equal to',
        '<=': 'is less than or equal to',
        '=': 'is equal to',
        'like': 'is like',
        'in': 'can be found in',
        '^n': ',',
        '^o': 'or',
        '^(': '(',
        '^)': ')',
    };
    constructor(reference, config = {}) {
        this.config = $.extend(true, config, $(reference).data());
        this.container = $('<div class="card" style="padding: 10px;"></div>');
        //attach it
        $(reference).after(this.container);
        $(reference).remove();
        this.config.fields_container = config.fields_container ?? '#search_bank';
        $(this.config.fields_container).hide();
        this.fields = $(config.fields_container).children();

        //render the casket
        this.renderContainer();

        //get important fields to memory
        this.code = $('[name=code]', this.container);
        this.code.val(this.config.code);

        this.mode = $('[name=mode]', this.container);
        this.mode.val(this.config.mode);

        this.query = $('[name=query]', this.container);
        this.query.val(this.config.query);

        this.dquery = $('[name=dquery]', this.container);
        this.dquery.val(this.config.dquery);
        this.dquery_box = $('.dquery-box', this.container);
        this.updateQueryDisplay(this.config.dquery)

        //set token
        $('[name=_token]', this.container).val(this.config.token);

        this.simple_area = $('.simple-area', this.container);

        this.advanced_araea = $('.advanced-area', this.container);


        this.search_btn = $('.search_btn', this.container);
        this.clear_btn = $('.search_clear_btn', this.container);

        let obj = this;

        if (this.config.mode == 1) {
            this.loadSimple();
        }
        this.search_btn.on('click', function () {
            $('form', obj.container).submit();
        });
        this.clear_btn.on('click', function () {
            $('.search-field', obj.container).val('');
            $('form', obj.container).submit();
        });
    }
    loadSimple() {
        let obj = this;
        $.each(this.fields, function (i) {
            let field = $(this).clone(true);
            field.on('input change', function () {
                obj.buildSearch();
            });
            let data = field.data();
            let field_set = $(`
            <div class="col-12 col-md-6 col-lg-4 my-auto">
                <div class="form-group"></div>
            </div>
            `);
            let field_name = `input_set_${obj.field_count}`;
            let group = $('.form-group', field_set);
            //add the encoders
            group.append(`<input type="hidden" class="search-param" data-post="command" value="${data.command}" />`);
            group.append(`<input type="hidden" class="search-param" data-post="field" data-display="${data.friendly_name}" value="${data.id}" />`);
            group.append(`<input type="hidden" class="search-param" data-post="operator" value="${data.operator}" />`);
            //add the field
            switch (data.type) {
                case 'checkbox':
                    let inchk = $(`<div class="form-check-inline"></div>`);
                    group.append(inchk);
                    inchk.append(field);
                    inchk.append(`<label class="form-check-label">${data.friendly_name}</label>`);
                    break;
                case 'radio':
                    //set hidden input for updateing radio selcts
                    let radio_feedback = $(`<input type="hidden" class="search-param" data-post="operand" value="" />`)
                    group.append(radio_feedback);
                    //get all the radio inputs
                    let radios = $('input', field);

                    $.each(radios, function (i, v) {
                        let radio = $(this);
                        radio.attr('name', `${field_name}[]`);
                        //set id add attach to label
                        radio.attr('id', `${field_name}_${i}`);
                        $('label', $(this).parent()).attr('for', `${field_name}_${i}`);
                        radio.on('change', function () {
                            radio_feedback.val(radio.val()).change();
                        });
                    });
                    group.prepend(`<label for="">${data.friendly_name}</label>`);

                    group.append(field);
                    break;
                default:
                    group.prepend(`<label for="">${data.friendly_name}</label>`);
                    group.append(field);
                    break;
            }
            obj.simple_area.append(field_set);
            obj.field_count++;
        });
    }
    buildSearch() {
        let obj = this;
        //get all the fields
        let fields = $('.search-param', obj.container);

        let query = [];
        let dquery = [];
        let possible_lang = function (field, field_data, val) {
            switch (field_data.post) {
                case 'field':
                    return `<strong>${field_data.display}</strong>`;
                case 'command':
                case 'operator':
                    return obj.lang[val];
                default:
                    if (field_data.type == 'select') {
                        val = $(`[value="${val}"]`, field).html() ?? '';
                    }
                    if (field_data.type == 'checkbox') {
                        val = field.is(':checked') ? 'active' : '';
                    }
                    return val.length ? `\`${val} \`` : '';
            }
        }
        let get_value = function (field, field_data, val) {
            switch (field_data.type) {
                case 'checkbox':
                    val = field.is(':checked') ? '1' : '';
                    break;
                default:
            }
            return `${field_data.post}^=^${val}`;
        }
        let get_field_data = function (field) {
            let data = field.data();
            switch (data.type) {
                case 'checkbox':
                    data = field.parent.eq(0).data();
                    break;
                default:

            }
            return data;
        }
        let checker = {
            dquery: [],
            query: [],
        };
        $.each(fields, function (i, v) {
            let field = $(this);
            let field_data = get_field_data(field);
            let val = field.val();
            if (obj.config.mode == 1) {//simple mode
                if (dquery.length == 0 && checker.dquery.length == 0) {
                    checker.dquery.push('');
                } else {
                    checker.dquery.push(`${possible_lang(field, field_data, val)}`);
                }
                checker.query.push(get_value(field, field_data, val));
                if (checker.dquery.length == 4) {
                    if (checker.dquery[3].length) {
                        checker.dquery.forEach(v => dquery.push(v));
                        checker.query.forEach(v => query.push(v));
                    }
                    checker.query = [];
                    checker.dquery = [];
                }
            } else {//advanced search mode

            }
        });
        this.updateQueryDisplay(dquery.join(' '));
        this.updateQuery(query.join('~~'));
    }
    updateQueryDisplay(dquery = null) {
        this.dquery.val(dquery != null ? dquery : this.dquery.val());
        if (this.dquery.val().length) {
            this.dquery_box.html(`<div class="alert alert-info" role="alert"> ${this.dquery.val()} </div>`);
        } else {
            this.dquery_box.html(``);
        }
    }
    updateQuery(query = null) {
        this.query.val(query != null ? query : this.query.val());
    }
    renderContainer() {
        this.container.append(`
        <div class="card-body">
            <h4 class="card-title">Searching</h4>
            <form action="${this.config.action}" method="POST">
                <div class="row simple-area">
    
                </div>
                <div  class="row advanced-area">
    
                </div>
                <input type="hidden" name="_token" />
                <input type="hidden" class="search-field" name="query" />
                <input type="hidden" name="code" />
                <input type="hidden" class="search-field" name="dquery" />
                <input type="hidden" class="search-field" name="mode" value="" />
            </form>
            <div class="row">
                <div class="col-12 mb-2 dquery-box">
                </div>
                <div class="col-12 text-right">
                    <button class="btn btn-success search_btn mr-2">Search</button>
                    <button class="btn btn-danger search_clear_btn">Clear</button>
                </div>
            </div>
        </div>
        `);
    }
}