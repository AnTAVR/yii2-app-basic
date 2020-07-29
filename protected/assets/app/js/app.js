// menu fixed js code
$(window).scroll(function () {
    const window_top = $(window).scrollTop() + 1;
    if (window_top > 50) {
        $('#navbar_home').addClass('fixed-top animated fadeInDown');
    } else {
        $('#navbar_home').removeClass('fixed-top animated fadeInDown');
    }
});
