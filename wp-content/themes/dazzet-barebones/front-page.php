<?php

/**
 * Plantilla que se le aplica a la página principal
 */

add_filter('body_class', function($classes) {
    $classes[] = 'front-page';
    return $classes;
} );


genesis();
