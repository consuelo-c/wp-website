<?php

/**
 * Funciones para que desde el customizer se pueda modifcar el comportamiento de la plantilla
 */

//* Agregar dos campos a la seccion header_image para especificar el alto y ancho de la imagen de cabecera
add_action( 'customize_register', 'dz_customizer_styling');
function dz_customizer_styling( $wp_customize) {

    /** Imagen de cabecera **/
    // Control para especificar el ancho de la cabecera
    $wp_customize->add_setting('dz_header_image_width',  array(
        'default' => 300,
        'transport' => 'postMessage'
    ));
    $wp_customize->add_control('dz_header_image_width', array(
        'section' => 'header_image',
        'label' => __('Ancho de la imagen', 'dazzet-barebones'),
        'type' => 'number'
    ));

    // Control para especificar el alto de la cabecera
    $wp_customize->add_setting('dz_header_image_height', array(
        'default' => 100,
        'transport' => 'postMessage'
    ));
    $wp_customize->add_control('dz_header_image_height', array(
        'section' => 'header_image',
        'label' => __('Alto de la image', 'dazzet-barebones'),
        'type' => 'number'
    ));

    // Cambiar algunos estilos
    $wp_customize->add_section('dz_styling', array(
        'title' => __('Dazzet - Estilos varios', 'dazzet-barebones')
    ));

    // Agregar fondo a las entradas de blog
    $wp_customize->add_setting('dz_blog_title_background', array(
        'default' => false,
        'transport' => 'postMessage'
    ));
    $wp_customize->add_control('dz_blog_title_background', array(
        'section' => 'dz_styling',
        'label' => __('Agregar imagen destacada como imagen de fondo en el titulo del art de blog?', 'dazzet-barebones'),
        'type' => 'checkbox'
    ));

    // Agregar texto READ_MORE al final de la sinopsis de blog
    $wp_customize->add_setting('dz_content_more_link',  array(
        'default' => '...&nbsp;<a href="[permalink]">Leer Más</a><i class="fa fa-arrow-right"></i>',
        'transport' => 'postMessage'
    ));
    $wp_customize->add_control('dz_content_more_link', array(
        'section' => 'dz_styling',
        'label' => __('Texto "Leer Mas" en el listado de entradas de blog', 'dazzet-barebones'),
        'type' => 'text',
        'description' => __('Puede usar algo como <strong>...&lt;a href="[permalink]"&gt;Leer Más&lt;/a&gt;</strong>')
    ));

    // En woocommerce mover el título a la parte superior
    $wp_customize->add_setting('dz_woo_title_top', array(
        'default' => false,
        'transport' => 'postMessage'
    ));
    $wp_customize->add_control('dz_woo_title_top', array(
        'section' => 'dz_styling',
        'label' => __('En WooCommerce mover el título al principio de la página', 'dazzet-barebones'),
        'type' => 'checkbox',
        'description' => __('En WooCommerce el título del producto esta al lado derecho. Con esta opción se mueve a la parte superior de la página', 'dazzet-barebones')
    ));

    // En Woocommerce Elminar CSS Original de Woocommerce
    $wp_customize->add_setting('dz_woo_remove_css', array(
        'default' => false,
        'transport' => 'postMessage'
    ));
    $wp_customize->add_control('dz_woo_remove_css', array(
        'section' => 'dz_styling',
        'label' => __('Eliminar hoja de estilos nativa de WooCommerce', 'dazzet-barebones'),
        'type' => 'checkbox'
    ));

}

// Funcion para detectar si un elemento es blog
if (!function_exists('is_blog')) {
    function is_blog () {
        global  $post;
        $posttype = get_post_type($post );
        return ( ((is_archive()) || (is_author()) || (is_category()) || (is_home()) || (is_single()) || (is_tag())) && ( $posttype == 'post')  ) ? true : false ;
    }
}

// Funcion para agregar "Leer mas" un una seccion
if (!function_exists('get_read_more_link')) {
    function get_read_more_link() {
       return str_replace('[permalink]', get_permalink(), $read_more_link);
    }
}


//* Agregar imagen destacada comoo fondo en el listado de blog
add_action( 'genesis_before_content', function() {

    if (!get_theme_mod('dz_blog_title_background', false)) return;
    if (!is_blog()) return;

    //* Hacemos que el titulo tenga una imagen de fondo
    remove_action( 'genesis_entry_header', 'genesis_do_post_title' );

    echo '<header class=" hero-title" style="background-image:url('. get_the_post_thumbnail_url().')">';
        genesis_do_post_title();
    echo '</header>';

}, 5 );


add_action('init', function() {

    // Mover el titulo de WooCommerce
    if (get_theme_mod('dz_woo_title_top', false)){
        // http://computing.ingreatway.com/2013/10/08/customise-woocommerce-move-your-title-to-above-the-thumbnail-in-product-page/
        remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
        add_action( 'woocommerce_before_single_product_summary', 'woocommerce_template_single_title', 5 );
    }

    // Eliminar la hoja de estilo que viene con WooCommerce
    if (get_theme_mod('dz_woo_remove_css', true)){
        add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );
    }

    $read_more_link = get_theme_mod('dz_content_more_link', '');
    if (!empty($read_more_link)) {
        add_filter( 'excerpt_more'          , 'get_read_more_link');
        add_filter( 'the_content_more_link' , 'get_read_more_link' );
    }

});



