$(window).on('load', function () {
    let $preloader = $('.preloader');
    let $loader = $preloader.find('.preloader-load');
    $loader.fadeOut();
    $preloader.delay(100).fadeOut('slow');
});
