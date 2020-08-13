$(function () {
    /**
     * @param {Array} options
     */
    $.fn.UrlTranslit = function (options) {
        const opts = $.extend({}, $.fn.UrlTranslit.defaults, options);
        let $this;
        return this.each(function () {
            $this = $(this);
            const o = $.meta ? $.extend({}, opts, $this.data()) : opts;
            const $destination = $('#' + opts.destination);
            o.destinationObject = $destination;

            // IE always sucks :)
            if (!Array.indexOf) {
                Array.prototype.indexOf = function (obj) {
                    for (let i = 0; i < this.length; i++) {
                        if (this[i] === obj) {
                            return i;
                        }
                    }
                    return -1;
                }
            }

            $this.keyup(function () {
                const str = $(this).val().trim();
                if ($destination.parent().children('.input-group-prepend').children('.input-group-text.btn').hasClass(opts.class_disable)) {
                    return;
                }
                let result = '';
                for (let i = 0; i < str.length; i++) {
                    result += $.fn.UrlTranslit.transliterate(str.charAt(i), o)
                }
                const regExp = new RegExp('[' + o.urlSeparator + ']{2,}', 'g');
                result = result.replace(regExp, o.urlSeparator);
                $destination.val(result);
            })
        });
    };

    /**
     * Transliterate character
     * @param {String} char
     * @param {Object} opts
     */
    $.fn.UrlTranslit.transliterate = function (char, opts) {
        let trChar = char.toLowerCase();
        const charIsLowerCase = trChar === char;

        for (let index = 0; index < opts.dictTranslate.length; index++) {
            if (trChar === opts.dictTranslate[index][0]) {
                trChar = opts.dictTranslate[index][1];
                break;
            }
        }

        if (opts.type === 'url') {
            const code = trChar.charCodeAt(0);
            if (code >= 33 && code <= 47 && code !== 45
                || code >= 58 && code <= 64
                || code >= 91 && code <= 96
                || code >= 123 && code <= 126
                || code >= 1072
            ) {
                return '';
            }
            if (trChar === ' ' || trChar === '-') {
                return opts.urlSeparator;
            }
        }

        // noinspection JSValidateTypes
        if ((opts.caseStyle === 'upper') || (opts.caseStyle === 'normal' && !charIsLowerCase)) {
            return trChar.toUpperCase();
        }
        return trChar;
    };

    $.fn.UrlTranslit.onclick = function () {
        $(this).toggleClass($.fn.UrlTranslit.defaults.class_enable);
        $(this).toggleClass($.fn.UrlTranslit.defaults.class_disable);
    }

    /**
     * Default options
     */
    $.fn.UrlTranslit.defaults = {
        /**
         * Dictionaries
         */
        dictTranslate: [],
        /*
         * Case transformation: normal, lower, upper
         */
        caseStyle: 'lower',

        /*
         * Words separator in url
         */
        urlSeparator: '-',

        /*
         * Transliteration type: raw or url
         *    url - used for transliterating text into url slug
         *    raw - raw transliteration (with special characters)
         */
        type: 'url',

        class_enable: 'text-info',
        class_disable: 'text-danger',
    };
})(jQuery);
