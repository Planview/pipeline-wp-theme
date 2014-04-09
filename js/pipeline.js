/**
 * Created by scrockett on 3/24/14.
 */

// Call webshims and force it to use our current jQuery
webshims.cfg.no$Switch = true;
webshims.polyfill();

// Hack for IE8 font-face in pseudo-elements aka icons
(function ($) {
    'use strict';
    if ( $('html').hasClass('lt-ie9') ) {
        $("<style>*:before,*:after{content:none !important;}</style>")
            .attr('id', 'icon-fix').attr('type', 'text/css').appendTo('head');
    }
})(jQuery);
jQuery(document).ready(function ($) {
    'use strict';
    if ( $('html').hasClass('lt-ie9') ) {
        $('#icon-fix').remove();
    }
});

//  Smooth scroll for page anchors
jQuery(document).ready(function($){
    $('html').on('click', 'a[href^="#"]',function (e) {
        e.preventDefault();

        var target = this.hash,
            $target = $(target);

        $('html, body').stop().animate({
            'scrollTop': $target.offset().top
        }, 900, 'swing', function () {
            window.location.hash = target;
        });
    });
});

// @codekit-append src/navigation.js
// @codekit-append src/skip-link-focus-fix.js