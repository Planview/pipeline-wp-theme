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


// @codekit-append src/navigation.js
// @codekit-append src/skip-link-focus-fix.js