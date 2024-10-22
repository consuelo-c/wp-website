<?php
/**
 * Plantilla que se le aplica a las entradas de blog
 */


//* Agregamos un widget antes del listado
add_action( 'genesis_before_content', function() {
    genesis_widget_area( 'blog-cta', array(
        'before' => '<div id="blog-cta" class="before-content-cta blog-cta"><div class="wrap">',
        'after' => '</div></div>'
    ));
}, 1);

// The blog page loop logic is located in lib/structure/loops.php.
genesis();
