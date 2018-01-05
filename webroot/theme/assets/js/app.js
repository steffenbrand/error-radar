$(window).on('load', function() {

    $('#content').css('opacity', '1');

    $(window).bind('beforeunload', function() {
        $('#content').css('opacity', '0');
        setTimeout(function() {}, 200);
    });

    var serverSelect = $('#server-id');
    serverSelect.change(function() {
        window.location = 'plans?serverId=' + $(this).val();
    });

    var serverId = getUrlParameter('serverId');
    if (serverId !== undefined) {
        serverSelect.val(serverId);
    }

    $('.pmd-tabs').pmdTab();

    /*$('.select-simple').select2({
        theme: 'bootstrap',
        minimumResultsForSearch: 7
    });*/

});

var getUrlParameter = function getUrlParameter(sParam) {
    var sPageURL = decodeURIComponent(window.location.search.substring(1)),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : sParameterName[1];
        }
    }
};