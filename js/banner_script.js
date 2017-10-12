$(document).ready(function() {
    $('.hide_banner:not(:first)').hide();
    $('a').click(function() {
        var id = $(this).attr('href');

        $(id).show();
        $('.hide_banner').not(id).hide();

    });

});