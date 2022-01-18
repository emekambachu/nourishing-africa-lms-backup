$(document).ready(function () {
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    $('.smart-search').each(function name(i) {
        let search_input = $(this);
        var cache = {};
        let data = $(this).data();
        $(this).autocomplete({
            source: function (request, response) {
                let term = request.term;
                if (term in cache) return response(cache[term]);
                // Fetch data
                $.ajax({
                    url: data.url,
                    type: 'post',
                    dataType: "json",
                    data: {
                        _token: CSRF_TOKEN,
                        search: request.term
                    },
                    success: function (data) {
                        // cache[term] = data;
                        response(data);
                    },
                    error: function (data) {
                        console.log(data);
                    }
                });
            },
            minLength: 2,
            select: function (event, ui) {
                search_input.val(ui.item.title);
                search_input.closest('form').trigger('submit')
                return false;
            }
        }).autocomplete("instance")._renderItem = function (ul, item) {
            var reg = new RegExp(search_input.val(), 'gi');
            var label = item.title.replace(reg, '<span class="text-success">' + search_input.val() + '</span>');
            return $(`<li class="text-nowrap text-truncate">`)
                .append(`<span class="w-100 d-block">${label}</span>`)
                .width(search_input.css('width'))
                .appendTo(ul);
        };
    })
});
