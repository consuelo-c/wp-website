<?php

/**
 * Template Name: Pagina - Titulo con img fondo
 * @author Mario Yepes <mario.yepes@dazzet.co>
 * @url http://dazzet.co
 */

//* Agregamos un widget antes del listado
add_action( 'genesis_before_content', function() {
    genesis_widget_area( 'archive-cta', array(
        'before' => '<div id="archive-cta" class="before-content-cta archive-cta"><div class="wrap">',
        'after' => '</div></div>'
    ));
}, 1);



//* Hacemos que el titulo tenga una imagen de fondo
remove_action( 'genesis_entry_header', 'genesis_do_post_title' );
add_action( 'genesis_before_content', function() {
?>
<div class="page-hero" style="background-image:url(<?php the_post_thumbnail_url()?>)">
    <div class="wrap">
        <?php genesis_do_post_title() ?>
    </div>
</div>

<?php
}, 5 );

// The blog page loop logic is located in lib/structure/loops.php.
genesis();
