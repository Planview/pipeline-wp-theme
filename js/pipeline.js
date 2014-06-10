/**
 * Created by scrockett on 3/24/14.
 */

// Call webshims and force it to use our current jQuery
webshims.cfg.no$Switch = true;
webshims.polyfill("canvas details es5 filereader geolocation mediaelement picture promise track");

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
    $('html').on('click', 'a.scroll-anchor',function (e) {
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
jQuery(document).ready(function($){
    $('html').on('click', 'a.scroll-anchor-2',function (e) {
        e.preventDefault();

        var target = this.hash,
            $target = $(target),
            $this = $(this);

        $($this.data('scrollParent')).stop().animate({
            'scrollTop': $target.offset().top
        }, 900, 'swing');
    });
});

//  Fancybox
jQuery(document).ready(function($) {
    $('.fancybox').fancybox();
});

// Limelight Video
jQuery(document).ready(function ($) {
  $(window).on('resize', function(e) {
    $('.limelight-video-respond').each(function () {
      var $wrapper = $(this),
          $video = $(this).find('*[width]'),
          controlsHeight = $(this).data('controlsHeight') || 0,
          controlsWidth = $(this).data('controlsWidth') || 0,
          newHeight,
          newWidth;

      //  See if we have the aspect ratio already
      if ( ! $wrapper.data('aspectRatio') ) {
        var aspectRatio = ( $video.attr('height') - controlsHeight ) /
          ( $video.attr('width') - controlsWidth );
        $wrapper.data('aspectRatio', aspectRatio );
      }

      newWidth = $wrapper.width();
      newHeight = (newWidth - controlsWidth) * $wrapper.data('aspectRatio') + controlsHeight;

      $video.attr('height', newHeight);
      $video.attr('width', newWidth);
    });
  });
  $(window).trigger('resize');
});

// Ajax comment pages
jQuery(document).ready(function ($) {
  $('html').on('click', '#comment-pagination a', function(event) {
    event.preventDefault();
    var $this = $(this),
        regex = /(?:cpage=|comment-page-)(\d+)/i,
        result,
        commentPage;

    result = regex.exec($this.attr('href'));

    if (result.length > 1) {
      commentPage = result[1];

      $.ajax({
        url: pipeline.ajaxUrl,
        data: {
          'action': 'pipeline_comment_paging',
          'post_id': pipeline.post_id,
          'comment_page': commentPage,
          'post_type': pipeline.post_type,
        },
        method: 'post',
        success: function (data, dataType, status) {
          $('.presentations-comments-body').html(data);
        }
      });
    }
  });
});

// Presentation redirects
if ( typeof(pipelinePresentation) !== 'undefined' ) {
  pipelinePresentation.timeoutFunction = function () {
    pipelinePresentation.timeoutCallback();
  };
  pipelinePresentation.timeoutCallback = function () {
    var timeNow,
        timestamp,
        $ = jQuery,
        myHeight,
        overlayDiv,
        alertMessage;

    timeNow = new Date();
    timestamp = timeNow.valueOf() / 1000;

    if ( timestamp > pipelinePresentation.presentationEnds ) {
      if( typeof( window.innerWidth ) == 'number' ) {
        //Non-IE
        myHeight = window.innerHeight;
      } else if( document.documentElement && ( document.documentElement.clientWidth || document.documentElement.clientHeight ) ) {
        //IE 6+ in 'standards compliant mode'
        myHeight = document.documentElement.clientHeight;
      }

      alertMessage = $('<div />').addClass('alert alert-warning center-block alert-dismissable pipeline-alert');
      alertMessage.html('<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' +
          '<p class="lead">' + this.message + '</p>');
      alertMessage.find('a').addClass('alert-link');

      overlayDiv = $('<div />').css('height', myHeight + 'px').addClass('alert-overlay').append(alertMessage).appendTo('body');

      setTimeout(this.redirect, 300000);
    } else {
      setTimeout(this.timeoutFunction, 2000);
    }
  };
  pipelinePresentation.redirect = function () {
    window.location.replace(pipelinePresentation.nextPresentation);
  };
  pipelinePresentation.timeoutCallback();
  jQuery('html').on('closed.bs.alert', '.pipeline-alert', function () { jQuery('.alert-overlay').remove(); });
}

jQuery(document).ready(function ($) {
  var $header = $('.areas .entry-header'),
      $sponsorInfo = $header.find('.sponsor-info-header'),
      $title = $header.find('.title-inner').parent(),
      heightDiff;

  if ( ! $header ) return;

  heightDiff = $sponsorInfo.height() - $title.height();

  if ( heightDiff > 0 ) {
    $title.css('padding-top', heightDiff + 'px');
  }
})

// @codekit-append src/navigation.js
// @codekit-append src/skip-link-focus-fix.js