<?php
/**
 * Dazzet Barebones
 * Template Name: Listado Blog - Parametrizable
 *
 * Acepta dos parametros de pagina
 * - content_archive: <excerpts, full, ###> Que tanta informacion se muestra, full es todo el contenido, excerpt es solo una parte, y un numero es cuantos caracteres
 * - posts_per_page: <###>, Numero de posts por pagina
 * - use_featured_bg: <1/0> Si se usa el background en la paga
 */

$post_meta = get_post_meta(get_the_ID());

//* Remplazamos el loop con uno que muestre articulos
// https://wordpress.stackexchange.com/questions/108649/custom-blog-post-listing-in-genesis-sample-child-theme
remove_action( 'genesis_loop',  'genesis_do_loop' );
add_action( 'genesis_loop',  'genesis_custom_loop' );

// Change the content archive and loop args.
add_action( 'genesis_pre_get_option_content_archive', 'child_post_content_archive' );
add_filter( 'genesis_custom_loop_args', 'child_loop_args' );


/**
 * Change default content to excerpts on this page.
 * - excerpts
 * - full
 */
function child_post_content_archive() {
    $content_archive = 'excerpts';
    global $post_meta;

    if (!empty($post_meta['content_archive'])) {
        list($content_archive) = $post_meta['content_archive'];
    }

    return $content_archive;
}

/**
 * Use WP_Query args.
 *
 * @link {http://codex.wordpress.org/Function_Reference/WP_Query}
 */
function child_loop_args() {

    $per_page = 5;
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    global $post_meta;

    if (!empty($post_meta['posts_per_page'])) {
        list($per_page) = $post_meta['posts_per_page'];
    }

    return array(
        'posts_per_page' => $per_page,
        'paged' => $paged
    );
}

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
    genesis_widget_area( 'blog-cta', array(
        'before' => '<div id="blog-cta" class="before-content-cta blog-cta"><div class="wrap">',
        'after' => '</div></div>'
    ));
}, 1);

// The blog page loop logic is located in lib/structure/loops.php.
genesis();
