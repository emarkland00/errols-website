(function($, undefined) {
    var handlerUrl = "/handlers/latest.php",
        contentContainer = '#latest-entry-container'
        contentHeader = '#latest-entry-header'
        contentContainerItem = '.latest-entry-container-item';

    var fetchContent = function(json) {
        $.ajax({
            type: 'GET',
            url: '/handlers/latest',
            data: json,
            dataType: 'json'
        })
        .done(function(data) {
            appendContentToPage(data);
        })
        .fail(function(data) {

        });
    };

    var appendContentToPage = function(json) {

    };

    var tkn = $('#csrf-token').val();
    if (tkn) {
        fetchContent({
            token: tkn
        });
    }
}(jQuery));