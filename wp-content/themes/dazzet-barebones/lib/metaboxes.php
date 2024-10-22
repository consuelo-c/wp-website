<?php


//* Opciones de la plantilla como poner imagen de fondo en el titulo y
// numero de posts a mostrar en la plantilla *Listado de Blog - Parametrizable*
add_action( 'add_meta_boxes', 'dz_meta_boxes_section');
function dz_meta_boxes_section() {
    add_meta_box('dz-meta-boxes-section', 'Opciones para la plantilla *Listado Blog - Parametrizable*', 'dz_meta_boxes_items', 'page', 'normal', 'high');
}

function dz_meta_boxes_items() {
	$posts_per_page = '';

	$post_custom = get_post_custom(get_the_ID());

	if (isset($post_custom['posts_per_page'])) {
		list($posts_per_page) = $post_custom['posts_per_page'];
	}

	if (isset($post_custom['use_featured_bg'])) {
		list($use_featured_bg) = $post_custom['use_featured_bg'];
	}
	echo '<p>';
	echo '<label for="posts-per-page">Número de posts en el listado</label> ';
	echo '<input type="number" name="posts_per_page" id="posts-per-page" value="'.$posts_per_page.'" />';
	echo '</p>';

	echo '<p>';
	echo '<label for="use-featured-bg">Usar imagen destacada como bg del título (vacio para no, full, thumbnail o tamaño)</label> ';
	echo '<input type="text" name="use_featured_bg" id="use-featured-bg" value="'.$use_featured_bg.'" />';
	echo '</p>';

}

add_action('save_post', 'dz_meta_boxes_save');
function dz_meta_boxes_save() {
    $ID = get_the_ID();
    if (defined('DOING_AUTOSAVE') && DOING_AUTO_SAVE) return;
    if (isset($_POST['posts_per_page'])) {
        update_post_meta($ID, 'posts_per_page', $_POST['posts_per_page']);
    }
    if (isset($_POST['use_featured_bg'])) {
        update_post_meta($ID, 'use_featured_bg', $_POST['use_featured_bg']);
    }
}

