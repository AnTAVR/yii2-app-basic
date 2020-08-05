// menu fixed js code
$(window).scroll(function () {
    const window_top = $(window).scrollTop() + 1;
    if (window_top > 150) {
        $('#navbar_home').removeClass('animated fadeIn');
        $('#navbar_home').addClass('fixed-top animated fadeInDown');
    } else {
        $('#navbar_home').removeClass('fixed-top animated fadeInDown');
        $('#navbar_home').addClass('animated fadeIn');
    }
});
