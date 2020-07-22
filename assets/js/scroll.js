$(document).ready(function() {
    $('.scroll').click(function(e) {

        var targetHref = $(this).attr('data-href');
        console.log('ok');
        $('html, body').animate({
            scrollTop: $(targetHref).offset().top
        }, 1000);

        e.preventDefault();
    });
});
