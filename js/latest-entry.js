(function($, undefined) {
    'use strict'

    var contentContainer = $('#latest-entry-content'),
        contentHeader = $('#latest-entry-header'),
        contentContainerItem = 'latest-entry-content-item',
        contentItemSource = 'latest-entry-content-item-source';

    function fetchContent(json) {
        contentContainer.addClass('loader');
        $.ajax({
            type: 'GET',
            url: '/handlers/latest.php',
            data: json,
            dataType: 'json'
        })
        .done(function(data) {
            var hasData = false;
            contentContainer.removeClass('loader');
            /*for (var i in data) {
                hasData = true;
                var json = data[i];
                json.date = moment(json.timestamp).format('MMM D, YYYY');
            }*/
                if (hasData) {
            appendContentToPage(data);
                } else {
                    contentContainer.append("Content coming soon!");
                }
        })
        .fail(function(data) {
                contentContainer.append("Content coming soon!");
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
                "<div>" +
                    "<span class='" + contentItemSource + "'>[{{source}}]</span> {{title}}" + "" +
                "</div>" +
                "<div>{{date}}</div>" +
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