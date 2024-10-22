<?php
/**
 * Template Name: Blog List con contenido al principio
 * Description: Use with query_args to show the featured medium image only of all called posts/pages.
 * @author Robin Cornett
 * @package Lookout 2013
 * @link https://gist.github.com/robincornett/6051023
 */

remove_action ('genesis_loop', 'genesis_do_loop'); // Remove the standard loop
add_action( 'genesis_loop', 'genesis_standard_loop', 5 ); // show the editor content

add_action( 'genesis_loop', 'rgc_do_loop' ); // Add custom loop

function rgc_do_loop() {

    if ( 1 >= get_query_var( 'paged' ) ) {
        add_action( 'genesis_loop', 'genesis_standard_loop', 5 );
    }

    global $post;

    // arguments, adjust as needed
    $args = wp_parse_args(
        genesis_get_custom_field( 'query_args' ),
        array(
        'post_type'   => 'post',
        'post_status' => 'publish',
        'paged'       => get_query_var( 'paged' ) )
    );

    global $wp_query;
    $wp_query = new WP_Query( $args );

    if ( have_posts() ) :
        while ( have_posts() ) : the_post();
            $thumb = get_the_post_thumbnail_url( $post->ID, 'medium' );

            echo '<div class="rgc-featured-image" style="background-image: url('.$thumb.'); ">';
                echo '<h3><a href="' . get_permalink() . '"> ' . get_the_title() . ' </a> </h3>'; // show the title
                echo '<a href="' . get_permalink() . '" title="' . the_title_attribute( 'echo=0' ) . '">'; // Original Grid
                echo get_the_post_thumbnail( $post->ID, 'medium' );
                echo '</a>';
            echo '</div>';

        endwhile;
        do_action( 'genesis_after_endwhile' );
    endif;

    wp_reset_query();
}

genesis();
