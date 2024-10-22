<?php

/**
 * Funciones para que desde el customizer se pueda modifcar el comportamiento de la plantilla
 */

//* Agregar dos campos a la seccion header_image para especificar el alto y ancho de la imagen de cabecera
add_action( 'customize_register', 'dz_customizer_libraries');
function dz_customizer_libraries( $wp_customize) {

    //* Seccion para librarias externas
    $wp_customize->add_section('dz_external_libraries', array(
        'title' => __('Dazzet - Usar librerías CSS y JS externas', 'dazzet-barebones')
    ));

    // Libreria HoverCSS
    $wp_customize->add_setting('dz_hover_css', array(
        'default '=> false,
    ));
    $wp_customize->add_control('dz_hover_css', array(
        'section' => 'dz_external_libraries',
        'label' => __('Incluir Hover CSS?', 'dazzet-barebones'),
        'type' => 'checkbox',
        'description' => '<a href="http://ianlunn.github.io/Hover/" target="_blank">http://ianlunn.github.io/Hover/</a>'
    ));

    // Agregar Bootstrap JS
    $wp_customize->add_setting( 'dz_bootstrap_js', array(
        'default' => false,
    ));
    $wp_customize->add_control('dz_bootstrap_js', array(
        'section' => 'dz_external_libraries',
        'label' => __('Incluir JavaScript de Bootstrap?', 'dazzet-barebones'),
        'type' => 'checkbox'
    ));

    // Agregar responsive menu en el header
    $wp_customize->add_setting('dz_responsive_menu', array(
        'default' => true
    ));
    $wp_customize->add_control('dz_responsive_menu', array(
        'section' => 'dz_external_libraries',
        'label' => __('Habilitar "Responsive Menu"', 'dazzet-barebones'),
        'type' => 'checkbox',
        'description' => __('Hacer que los menus que se agreguen al encabezado sean responsive y funcionen como meus?', 'dazzet-barebones')
    ));

    // Agregar clase scrolled al <body>
    $wp_customize->add_setting('dz_body_scrolled_class', array(
        'default' => false
    ));
    $wp_customize->add_control('dz_body_scrolled_class', array(
        'section' => 'dz_external_libraries',
        'label' => __('Agregar clase scrolled?', 'dazzet-barebones'),
        'type' => 'checkbox',
        'description' => __('Agregar al &lt;body&gt; la clase <strong>scrolled</strong> cuando el usuario haga scroll?', 'dazzet-barebones')
    ));

    // Agregar clase window-height y half-window-heigth
    $wp_customize->add_setting('dz_set_window_height', array(
        'default' => true
    ));
    $wp_customize->add_control('dz_set_window_height', array(
        'section' => 'dz_external_libraries',
        'label' => __('Agregar la clase window-height y half-window-height', 'dazzet-barebones'),
        'type' => 'checkbox',
        'description' => __('Inclur la libreria JS que generan las clases CSS window-height y half-window-height?', 'dazzet-barebones')
    ));

    // Incluir CSS para que el menú ppal use FontAesome
    $wp_customize->add_setting('dz_fa_heading_menu', array(
        'default' => false
    ));
    $wp_customize->add_control('dz_fa_heading_menu', array(
        'section' => 'dz_external_libraries',
        'label' => __('Cambiar los íconos del menu por iconos de FontAwesome', 'dazzet-barebones'),
        'type' => 'checkbox',
        'description' => __('Usar iconos como <a target="_blank" href="http://fontawesome.io/icon/bars/">el de barras</a> para el menu responsive? Necesita tener activado el plugin <string>Better Font Awesome</strong>', 'dazzet-barebones')
    ));

    $wp_customize->add_setting('dz_bxslider', array(
        'default' => false
    ));
    $wp_customize->add_control('dz_bxslider', array(
        'section' => 'dz_external_libraries',
        'label' => __('Agregar la librería JS bxSlider?', 'dazzet-barebones'),
        'type' => 'checkbox',
        'description' => sprintf(__('Libería para sliders livianos. Documentacion: <a href="%s" target="_top">aquí</a>', 'dazzet-barebones'), 'http://bxslider.com/options')
    ));

    $wp_customize->add_setting('dz_owls_carousel', array(
        'default' => false
    ));
    $wp_customize->add_control('dz_owl_carousel', array(
        'section' => 'dz_external_libraries',
        'label' => __('Agregar la librería JS OwlCarousel?', 'dazzet-barebones'),
        'type' => 'checkbox',
        'description' => sprintf(__('Libería para sliders y carousels livianos. Documentacion: <a href="%s" target="_top">aquí</a>', 'dazzet-barebones'), 'https://owlcarousel2.github.io/OwlCarousel2/demos/demos.html')
    ));

    $wp_customize->add_setting('dz_stellar', array(
        'default' => false,
    ));
    $wp_customize->add_control('dz_stellar', array(
        'section' => 'dz_external_libraries',
        'label' => __('Agregar la librería JS Stellar.js', 'dazzet-barebeones'),
        'type' => 'checkbox',
        'description' => sprintf(__('Libería para efectos parallax. Documentacion: <a href="%s" target="_blank">aquí</a>', 'dazzet-barebeones'), 'http://markdalgleish.com/projects/stellar.js/docs/')
    ));

    $wp_customize->add_setting('dz_greensock', array(
        'default' => false
    ));
    $wp_customize->add_control('dz_greensock', array(
        'section' => 'dz_external_libraries',
        'label' => __('Agregar la librería TweenLite the Greensock?', 'dazzet-barebones'),
        'type' => 'checkbox',
        'description' => sprintf(__('Librería para animaciones avazadas. Documentación <a href="%s" target="_blank">aquí</a>', 'dazzet-barebones'), 'https://greensock.com/get-started-js#basics')
    ));

    $wp_customize->add_setting('dz_vegas', array(
        'default' => false
    ));
    $wp_customize->add_control('dz_vegas', array(
        'section' => 'dz_external_libraries',
        'label' => __('Agregar la librería JS Vegas?', 'dazzet-barebones'),
        'type' => 'checkbox',
        'description' => sprintf(__('Librería JS para hacer que un background se comporte com un slider. Documentación <a href="%s" target="_blank">aquí</a>', 'dazzet-barebones'), 'http://vegas.jaysalvat.com/documentation/')
    ));

    $wp_customize->add_control( 'dz_additional_js', array(
        'section' => 'dz_external_libraries',
        'label' => __('URL de librerías JS adicionales', 'dazzet-barebones'),
        'type' => 'textarea',
        'input_attrs' => array(
            'placeholder' => 'https://cdn.jsdelivr.net/npm/vegas@2/dist/vegas.min.js',
        ),
        'description' => __('Aquí se pueden agregar las URLs de librerías JavaScript para ser adicionadas en el footer.<br>Se pueden buscar librerias en https://jsdelivr.com', 'dazzet-barebones')
    ));

    $wp_customize->add_setting( 'dz_additional_css', array(
        'default' => ''
    ));
    $wp_customize->add_control( 'dz_additional_css', array(
        'section' => 'dz_external_libraries',
        'label' => __('Librerías CSS adicionales', 'dazzet-barebones'),
        'type' => 'textarea',
        'input_attrs' => array(
            'placeholder' => 'https://cdn.jsdelivr.net/npm/vegas@2/dist/vegas.min.css',
        ),
        'description' => __('Igual que el item anterior pero para archivos CSS.', 'dazzet-barebones')
    ));

    // Usar fuentes de Google
    $wp_customize->add_setting('dz_google_fonts', array(
        'default' => ''
    ));
    $wp_customize->add_control('dz_google_fonts', array(
        'section' => 'dz_external_libraries',
        'label' => __('Google fonts URL (si no usa "Easy google Fonts")', 'dazzet-barebeones'),
        'type' => 'url',
        'description' => __('Use la URL completa. P.e: https://fonts.googleapis.com/css?family=Open+Sans:400,700', 'dazzet-barebones')
    ));
}

add_action( 'wp_enqueue_scripts', function() {
    // Si agregar hover.css si en el personalizador se especificó
    if (get_theme_mod('dz_hover_css', false)) {
        wp_enqueue_style( 'hover',
            'https://cdnjs.cloudflare.com/ajax/libs/hover.css/2.1.1/css/hover-min.css',
            array(), CHILD_THEME_VERSION);
    }
    // Agregar el JS de Bootsrap si se especificó en bootstrap
    if (get_theme_mod('dz_bootstrap_js', false)) {
        wp_enqueue_script( 'bootstrap',
            'https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js',
            array('jquery'), CHILD_THEME_VERSION, true);
    }

    // Enqueue Responsive Menu Script
    if (get_theme_mod('dz_responsive_menu', true)) {
        wp_enqueue_script( 'dz-responsive-menu',
            get_stylesheet_directory_uri() . '/js/responsive-menu.js',
            array('jquery'), CHILD_THEME_VERSION, true);
    }

    // Agregar la libreria body-class-scrolled
    if (get_theme_mod('dz_body_scrolled_class', false)) {
        wp_enqueue_script( 'body-class-on-scroll',
            get_stylesheet_directory_uri() . '/js/body-class-on-scroll.js',
            array('jquery'), CHILD_THEME_VERSION, true);

    }

    if (get_theme_mod('dz_set_window_height', true)) {
        wp_enqueue_script('set-window-height',
            get_stylesheet_directory_uri() . '/js/set-window-height.js',
            array('jquery'), CHILD_THEME_VERSION, true);
    }

    if (get_theme_mod('dz_fa_heading_menu', false)) {
        wp_enqueue_style('fa-heading-menu',
            get_stylesheet_directory_uri() . '/fa-heading-menu.css',
            array('barebones'), CHILD_THEME_VERSION);
    }

    if (get_theme_mod('dz_bxslider', false)) {
        wp_enqueue_style('bxslider',
            'https://cdnjs.cloudflare.com/ajax/libs/bxslider/4.2.12/jquery.bxslider.min.css',
            array(), null
        );
        wp_enqueue_script('bxslider',
            'https://cdnjs.cloudflare.com/ajax/libs/bxslider/4.2.12/jquery.bxslider.min.js',
            array('jquery'), null, true
        );
    }

    if (get_theme_mod('dz_owl_carousel', false)) {
        wp_enqueue_script('owl-carousel',
            'https://cdn.jsdelivr.net/npm/owl.carousel@2/dist/owl.carousel.min.js',
            array('jquery'), null, true
        );
    }

    if (get_theme_mod('dz_stellar', false)) {
        wp_enqueue_script('stellar',
            'https://cdnjs.cloudflare.com/ajax/libs/stellar.js/0.6.2/jquery.stellar.min.js',
            array('jquery'), null, true
        );
    }

    if (get_theme_mod('dz_greensock', false)) {
        wp_enqueue_script('tween-lite',
            'https://cdn.jsdelivr.net/npm/greensock@1/dist/TweenMax.min.js',
            array(), null, true
        );
    }

    if (get_theme_mod('dz_vegas', false)) {
        wp_enqueue_style('vegas',
            'https://cdn.jsdelivr.net/npm/vegas@2/dist/vegas.min.css',
            array(), null
        );
        wp_enqueue_script('vegas',
            'https://cdn.jsdelivr.net/npm/vegas@2/dist/vegas.min.js',
            array('jquery'), null, true
        );
    }

    $additional_js = get_theme_mod( 'dz_additional_js', '');
    if ( !empty($additional_js) ) {
        $counter = 0;
        foreach (explode("\n", str_replace("\r", "", $additional_js)) as $lib ) {
            wp_enqueue_script( 'additional-'.$counter++, $lib, array('jquery'), null, true);
        }
    }

    $additional_css = get_theme_mod( 'dz_additional_css', '');
    if ( !empty($additional_css) ) {
        $counter = 0;
        foreach (explode("\n", str_replace("\r", "", $additional_css)) as $lib ) {
            wp_enqueue_style ( 'additional-'.$counter++, $lib, array(), CHILD_THEME_VERSION);
        }
    }

    wp_enqueue_style('google-fonts', get_theme_mod('dz_google_fonts'),
        array(), CHILD_THEME_VERSION);

}, 500);


