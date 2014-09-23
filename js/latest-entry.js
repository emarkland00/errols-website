(function($, undefined) {
    'use strict'

    var contentContainer = $('#latest-entry-content'),
        contentHeader = $('#latest-entry-header'),
        contentContainerItem = 'latest-entry-content-item';

    function fetchContent(json) {
        contentContainer.addClass('loader');
        $.ajax({
            type: 'GET',
            url: '/handlers/latest.php',
            data: json,
            dataType: 'json'
        })
        .done(function(data) {
            contentContainer.removeClass('loader');
            appendContentToPage(data);
        })
        .fail(function(data) {

        });
    }

    function appendContentToPage(json) {
        for (var i = 0; i < json.length; ++i) {
            var entry = $(createEntry((json[i])));
            contentContainer.append(entry);
        }
    };

    var template =
        "<a href='{{url}}' target='_blank'>" +
            "<div class='" + contentContainerItem + "'>" +
                "<div>Title: {{title}}</div>" +
                "<div>URL: {{url}}</div>" +
                "<div>Source: {{source}}</div>" +
                "<div>Timestamp: {{timestamp}}</div>" +
            "</div>" +
        "</a>",
    _compiledTemplate = null,
    createEntry = function(json) {
        if (_compiledTemplate === null) {
            _compiledTemplate = Handlebars.compile(template);
        }
        return _compiledTemplate(json);
    };

    var tkn = $('#tkn').val();
    if (tkn) {
        fetchContent({
            token: tkn,
            count: 3
        });
    }
}(jQuery));