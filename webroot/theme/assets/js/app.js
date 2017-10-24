$(window).on('load', function() {

    $('#content').css('opacity', '1');

    $(window).bind('beforeunload', function() {
        $('#content').css('opacity', '0');
        setTimeout(function() {}, 200);
    });

    $('.pmd-tabs').pmdTab();

    $('.select-simple').select2({
        theme: 'bootstrap',
        minimumResultsForSearch: Infinity
    });

});