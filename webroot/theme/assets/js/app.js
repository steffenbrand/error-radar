$(window).on('load', function() {

    setTimeout(function() {
        $('#content').css('opacity', '1');
    }, 200);

    $('.pmd-tabs').pmdTab();

    $('.select-simple').select2({
        theme: 'bootstrap',
        minimumResultsForSearch: Infinity
    });

});