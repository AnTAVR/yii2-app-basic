$(function () {
    $.fn.LinkPager = function () {
    };

    $.fn.LinkPager.onclick = function (element) {
        const pageNum = $(element).parent().children("input").val();
        $.fn.LinkPager.location(pageNum);
    };

    $.fn.LinkPager.onkeydown = function (element, e) {
        if (e.keyCode === 13) {
            const pageNum = $(element).val();
            $.fn.LinkPager.location(pageNum);
        }
    };

    $.fn.LinkPager.location = function (pageNum) {
        const url = $.fn.LinkPager.url.replace($.fn.LinkPager.jumpPageReplace, pageNum);
        $(location).attr("href", url);
    };

    $.fn.LinkPager.url = '';

    $.fn.LinkPager.jumpPageReplace = '';
})(jQuery);
