<?php

//* Agregamos un widget antes del listado
add_action( 'genesis_before_content', function() {
    genesis_widget_area( 'archive-cta', array(
        'before' => '<div id="archive-cta" class="before-content-cta archive-cta"><div class="wrap">',
        'after' => '</div></div>'
    ));
}, 1);

// The blog page loop logic is located in lib/structure/loops.php.
genesis();
