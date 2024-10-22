/*
 * Adds a checkbox with a label before each menu on the header and on each
 * sub-menu.
 *
 * You use this for adding drop down capabilities to the menus using CSS
 *
 * Author: Mario Yepes <marioy47@gmail.com>
 */
(function($) {

  $('.site-header .menu-item-has-children > a').each( function(i, obj) {

    // The menu or sub-menu as a jquery object
    var jquery_obj = $(obj);

    // Create the <label> as a jQuery object
    var label_toggle = $('<label />', {
      'for': 'menu-toggle-' + i,
      'class' : 'menu-toggle'
    });

    // Create the <checkbox> as a jQuery object
    var checkbox_toggle = $( '<input />', {
      'type': 'checkbox',
      'id': 'menu-toggle-' + i,
      'class' : 'menu-toggle',
      'checked': 'checked'
      } );

    // Add the checkbox and label to the dom
    jquery_obj.before(checkbox_toggle).before(label_toggle);
  });

  // The same but for menus
  $('.site-header ul.menu').each( function(i, obj) {

    // The menu or sub-menu as a jquery object
    var jquery_obj = $(obj);

    // Create the <label> as a jQuery object
    var label_toggle = $('<label />', {
      'for': 'top-menu-toggle-' + i,
      'class' : 'top-menu-toggle'
    });

    // Create the <checkbox> as a jQuery object
    var checkbox_toggle = $( '<input />', {
      'type': 'checkbox',
      'id': 'top-menu-toggle-' + i,
      'class' : 'top-menu-toggle',
      'checked': 'checked'
      } );

    // Add the checkbox and label to the dom
    jquery_obj.before(checkbox_toggle).before(label_toggle);
  });

})(jQuery);
