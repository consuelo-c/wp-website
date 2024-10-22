(function($) {

  var window_height = $(window).height();
  var header_height = $('.site-header').height();

  if (isNaN(parseInt(window_height))) window_height = 500;
  if (isNaN(parseInt(header_height))) header_height = 0;

  var css = ".window-height { min-height: " + (window_height - header_height) + "px;}" +
    " .half-window-height { min-height: " + (window_height - header_height)/2 + "px;}" ;

  var head = document.head || document.getElementsByTagName('head')[0];
  var style = document.createElement('style');

  style.type = 'text/css';
  if (style.styleSheet){
    style.styleSheet.cssText = css;
  } else {
    style.appendChild(document.createTextNode(css));
  }

  head.appendChild(style);

})(jQuery);
