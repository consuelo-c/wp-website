<?php

/*
 * Plantillas para UNA entradas de blog
 */


//* Agregamos un widget antes del listado
add_action( 'genesis_before_content', function() {
    genesis_widget_area( 'post-cta', array(
        'before' => '<div id="post-cta" class="before-content-cta post-cta"><div class="wrap">',
        'after' => '</div></div>'
    ));

}, 1);

genesis();
