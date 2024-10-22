<?php

/**
 * Modifica el comportamiento de una página recibiendo un parametro:
 * - use_featured_bg: Si este parametro esta presente se le agrega la imagen
 *   destacada como fondo al título
 */

$post_meta = get_post_meta(get_the_ID());

//* Si está activada la opcion de usar la featured image como background
if (!empty($post_meta['use_featured_bg'][0])) {
    // Quitamos la imagen del post
    remove_action( 'genesis_entry_content', 'genesis_do_post_image', 8 );

    //* Agregamos un wrapper a los articulo con la imagen destacada
    add_action( 'genesis_before_entry', function() {
        $style = '';
        $class = 'article-wrapper';
        $class .= is_sticky() ? ' is-sticky ' : ' is-regular';
        if (has_post_thumbnail() && !is_sticky())  {
            $style = sprintf('background-image: url(%s);', get_the_post_thumbnail_url(null, 'blog-image-md'));
        }

        printf('<div class="%s" style="%s">', $class, $style);
    }, 100);

    //* Cerramos el div de article-wrapper
    add_action( 'genesis_after_entry', function() {
        echo '</div>';
        echo '<hr class="article-separator" />';
    }, 1);

    //* Los articulos stiky se ven diferente
    add_action('genesis_entry_header', function() {
        if (!is_sticky()) return;
        if (has_post_thumbnail()) {
            echo '<div class="sticky-header-image article-has-image" style="background-image: url(';
                the_post_thumbnail_url('blog-image-md');
            echo ')">&nbsp;</div>';
        }
    }, 20);
}

//* Agregamos un widget antes del listado
add_action( 'genesis_before_content', function() {
    genesis_widget_area( 'page-cta', array(
        'before' => '<div id="page-cta" class="before-content-cta page-cta"><div class="wrap">',
        'after' => '</div></div>'
    ));
}, 1);

// The blog page loop logic is located in lib/structure/loops.php.
genesis();
