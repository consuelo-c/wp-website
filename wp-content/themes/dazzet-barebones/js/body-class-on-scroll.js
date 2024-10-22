
/**
 * Adds the -scrolled- class to the body if user scrolls
 */
jQuery(document).ready(function($){
  var siteHeader = $(".site-header");
  var theWindow = $(window);
  var theBody = $('body');
  theWindow.scroll(function() {
    var scroll = theWindow.scrollTop();

    if (scroll >= 100) {
      theBody.addClass("scrolled scrolled-100");
    } else {
      theBody.removeClass("scrolled");
      theBody.removeClass("scrolled-100");
      theBody.removeClass("scrolled-300");
    }

    if (scroll >= 500) {
      theBody.addClass("scrolled scrolled-500");
    } else {
      theBody.removeClass("scrolled-500");
    }
  });

});
