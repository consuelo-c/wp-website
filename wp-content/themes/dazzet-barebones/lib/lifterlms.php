<?php

//* Adicionamos compatibilidad con LifterLMS
//* LifterLMS https://lifterlms.readme.io/v1.5.0/docs/course-and-lesson-sidebars-on-genesis-theme
//Register new Course sidebar
genesis_register_sidebar( array(
    'id' => 'llms-course-sidebar',
    'name' => 'Genesis Course Sidebar',
    'description' => 'Genesis theme Course sidebar.',
) );
add_action('get_header','cd_change_genesis_course_sidebar');
function cd_change_genesis_course_sidebar() {
    if ( is_singular('course')) {
        remove_action( 'genesis_sidebar', 'genesis_do_sidebar' ); //remove the default genesis sidebar
        add_action( 'genesis_sidebar', 'cd_course_sidebar' ); //add an action hook to call the function
    }
}
//Function to output my custom sidebar
function cd_course_sidebar() {
    dynamic_sidebar( 'llms-course-sidebar' );
}

//Register new Lesson sidebar
genesis_register_sidebar( array(
    'id' => 'llms-lesson-sidebar',
    'name' => 'Genesis Lesson Sidebar',
    'description' => 'Genesis theme Lesson sidebar.',
) );
add_action('get_header','cd_change_genesis_lesson_sidebar');
function cd_change_genesis_lesson_sidebar() {
    if ( is_singular('lesson')) {
        remove_action( 'genesis_sidebar', 'genesis_do_sidebar' ); //remove the default genesis sidebar
        add_action( 'genesis_sidebar', 'cd_lesson_sidebar' ); //add an action hook to call the function
    }
}
//Function to output my custom sidebar
function cd_lesson_sidebar() {
    dynamic_sidebar( 'llms-lesson-sidebar' );
}
//* Fin LifterLMS

// Agregamos un nuevo tamaño de imagen para los cursos
add_image_size( 'lifter-list-image', 280, 160, TRUE );
add_filter('image_size_names_choose', function($sizes) {
    $sizes['lifter-list-image'] = __('Lifter thumbnail', 'dazzet');
    return $sizes;
});

