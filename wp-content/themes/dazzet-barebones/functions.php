<?php

include_once( get_template_directory() . '/lib/init.php' );
include_once( __DIR__ . '/lib/customizer-libraries.php');
include_once( __DIR__ . '/lib/customizer-styling.php');
//include_once( __DIR__ . '/lib/lifter.php');
include_once( __DIR__ . '/lib/metaboxes.php');


define( 'CHILD_THEME_NAME', 'dazzet-barebones' );
define( 'CHILD_THEME_URL', 'http://dazzet.co/' );
define( 'CHILD_THEME_VERSION', '2.0.0' );


//* Enqueue Wordpress styles like image-centering, letter-spacing, and image-width
add_action( 'wp_enqueue_scripts', 'dz_genesis_wordpress_classes', 500);
function dz_genesis_wordpress_classes() {
    wp_enqueue_style( 'genesis-wordpress-classes',
        get_stylesheet_directory_uri() . '/genesis-wordpress-classes.css',
        array(), CHILD_THEME_VERSION );
}

//* Enqueue Bootstrap styles and javascripts
add_action( 'wp_enqueue_scripts', 'dz_barebones', 501 );
function dz_barebones () {
    wp_enqueue_style( 'barebones',
        get_stylesheet_directory_uri() . '/barebones.css',
        array(), CHILD_THEME_VERSION );
}

//* Remove superfish js menu (is deprecated by studiopress)
add_action( 'wp_enqueue_scripts', function() {
    wp_deregister_script( 'superfish'  ); // Remove superfish on genesis
    wp_deregister_script( 'superfish-args'  );
}, 999);

//* Remove Blog and Archive templates (http://www.billerickson.net/remove-genesis-page-templates)
function dz_remove_genesis_page_templates( $page_templates ) {
    unset( $page_templates['page_archive.php'] );
    unset( $page_templates['page_blog.php'] );
    return $page_templates;
}
//add_filter( 'theme_page_templates', 'dz_remove_genesis_page_templates' );

//* Habilitar opciones de genesis
add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );
add_theme_support( 'genesis-accessibility', array( '404-page', 'drop-down-menu', 'headings', 'rems', 'search-form' )  );

//* Remove genesis native menus (menu below the header)
/* remove_theme_support( 'genesis-menus' ); */

add_theme_support( 'custom-background' );
add_theme_support( 'genesis-responsive-viewport' );
add_theme_support( 'genesis-footer-widgets', 3 );


//* Opciones de woocommerce
add_theme_support( 'wc-product-gallery-zoom' );
add_theme_support( 'wc-product-gallery-lightbox' );
add_theme_support( 'wc-product-gallery-slider' );

//*  Custom image sizes (ADJUST THIS TO YOU THEME)
add_image_size( 'hero-image', 1200, 400, TRUE );
add_image_size( 'blog-image-sm', 640, 480, TRUE );
add_image_size( 'blog-image-md', 800, 600, TRUE );
add_image_size( 'blog-image-lg', 1024, 768, TRUE );
add_filter('image_size_names_choose', function($sizes) {
    $sizes['hero-image'] = __('Hero Image', 'dazzet-bootstrap');
    $sizes['blog-image-sm'] = __('Small blog image', 'dazzet-bootstrap');
    $sizes['blog-image-md'] = __('Medum blog image', 'dazzet-bootstrap');
    $sizes['blog-image-lg'] = __('Large blog image', 'dazzet-bootstrap');
    return $sizes;
});

//* Logo on the right of the header (ADJUST THE SIZE)
add_theme_support( 'custom-header', array(
	/* 'height'          => 130, */
	'height'          => get_theme_mod('dz_header_image_height', 50),
	'flex-height'     => true,
	/* 'width'           => 265, */
	'width'           => get_theme_mod('dz_header_image_width', 50),
    'flex-width'      => true,
	'header-selector' => '.site-title a',
	'header-text'     => false,
) );

//* Add support for structural wraps
add_theme_support( 'genesis-structural-wraps', array(
	'header',
	'nav',
	'subnav',
	'footer-widgets',
	'footer',
) );

//* Habilitamos widgets al final de los posts
add_theme_support( 'genesis-after-entry-widget-area' );


//* Eliminar emojis ya que ponen lenta la página y no se usan
add_action( 'init', function() {
  // all actions related to emojis
  remove_action( 'admin_print_styles', 'print_emoji_styles' );
  remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
  remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
  remove_action( 'wp_print_styles', 'print_emoji_styles' );
  remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
  remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
  remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );

} );

//* Remove edit link from posts
add_filter ( 'genesis_edit_post_link' , '__return_false' );

//* Add scroll to top link
add_action( 'genesis_after_footer', 'dz_to_top');
function dz_to_top() {
    echo '<div class="scroll-to-top">';
        echo '<a href="#" class="scroll-to-top-link" title="Volver al principio" rel="m_PageScroll2id"><span class="scroll-to-top-content"></span></a>';
    echo '</div>';
}

//* Creamos areas de widgets para llamados a la acción
genesis_register_sidebar( array(
    'id' => 'blog-cta',
    'name' => 'Blog List - CTA Before Content',
) );
genesis_register_sidebar( array(
    'id' => 'post-cta',
    'name' => 'Blog Post - CTA Before Content',
) );
genesis_register_sidebar( array(
    'id' => 'archive-cta',
    'name' => 'Archives - CTA Before Content',
) );
genesis_register_sidebar( array(
    'id' => 'page-cta',
    'name' => 'Page - CTA Before Content',
) );
genesis_register_sidebar( array(
    'id' => 'recipe-cta',
    'name' => 'Recipe - CTA Before Content',
) );



//* Creamos secciones antes y despues del .site-header
genesis_register_sidebar(array(
    'id' => 'before-header',
    'name' => __( 'Antes del Header', 'dazzet-barebones'),
    'description' => __( 'Widgets antes del header', 'dazzet-barebones')
));
add_action( 'genesis_before_header', 'ihs_before_header_widget_area' );
function ihs_before_header_widget_area() {
    genesis_widget_area( 'before-header', array(
        'before' => '<div class="widget-area before-header before-header-widget-area"><div class="wrap">',
        'after' => '</div></div>'
    ));
}
genesis_register_sidebar(array(
    'id' => 'after-header',
    'name' => __( 'Después del Header', 'dazzet-barebones'),
    'description' => __( 'Widgets después del header', 'dazzet-barebones')
));
add_action( 'genesis_after_header', 'ihs_after_header_widget_area' );
function ihs_after_header_widget_area() {
    genesis_widget_area( 'after-header', array(
        'before' => '<div class="widget-area after-header after-header-widget-area"><div class="wrap">',
        'after' => '</div></div>'
    ));
}

// Agregar TagManager después del body
if ( function_exists( 'gtm4wp_the_gtm_tag' ) ) {
    add_action( 'genesis_before', 'gtm4wp_the_gtm_tag' );
}
