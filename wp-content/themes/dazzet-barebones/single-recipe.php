<?php

// Plantilla para las recetas

//* Agregamos un widget antes del listado
add_action( 'genesis_before_content', function() {
    genesis_widget_area( 'recipe-cta', array(
        'before' => '<div id="recipe-cta" class="before-content-cta recipe-cta"><div class="wrap">',
        'after' => '</div></div>'
    ));

}, 2);

//* Hacemos que el titulo tenga una imagen de fondo
remove_action( 'genesis_entry_header', 'genesis_do_post_title' );
add_action( 'genesis_before_content', function() {
?>
<div class="container recipe-hero" style="background-image:url(<?php the_post_thumbnail_url()?>)">
    <div class="row">
        <div class="col-xs-12">
            <?php genesis_do_post_title() ?>
        </div>
    </div>
</div>

<?php
}, 5 );


genesis();
