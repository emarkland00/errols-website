(function($, undefined) {
    'use strict'

    var contentContainer = $('#latest-entry-content'),
        contentHeader = $('#latest-entry-header'),
        contentContainerItem = 'latest-entry-container-item';

    function fetchContent(json) {
        $.ajax({
            type: 'GET',
            url: '/handlers/latest.php',
            data: json,
            dataType: 'json'
        })
        .done(function(data) {
            console.log('SUCCESS');
            appendContentToPage(data);
        })
        .fail(function(data) {
            console.log('FAIL')
        }).always(function(data) {
            console.log(data);
        });
    }

    function appendContentToPage(json) {
        for (var i = 0; i < json.length; ++i) {
            var entry = $(createEntry((json[i])));
            contentContainer.append(entry);
        }
    };

    var template =
        "<div class='" + contentContainerItem + "'>" +
            "<div>Title: {{title}}</div>" +
            "<div>URL: {{url}}</div>" +
            "<div>Source: {{source}}</div>" +
            "<div>Timestamp: {{timestamp}}</div>" +
        "</div>",
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
            token: tkn
        });
    }
}(jQuery));