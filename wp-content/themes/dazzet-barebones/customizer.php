<?php

/**
 * Funciones para que desde el customizer se pueda modifcar el comportamiento de la plantilla
 */

//* Agregar dos campos a la seccion header_image para especificar el alto y ancho de la imagen de cabecera
add_action( 'customize_register', 'dz_customizer_register');
function dz_customizer_register( $wp_customize) {

    //* Clase coon el nuevo tipo de widget
    class DZ_Customize_Number_Control extends WP_Customize_Control {
        public $type = 'textarea';

        public function render_content() {
            echo '<label>';
                echo '<span class="customize-control-title">'. esc_html($this->label).'</span>';
                echo '<textarea rows="1" ';
                $this->link();
                echo '>' . esc_textarea($this->value()).'</textarea>';
                echo '<small>Debes guardar, salir y regresar al customizer para ver las nuevas dimensiones</small>';
            echo '</label>';
        }
    } // class


    // Control para especificar el ancho de la cabecera
    $wp_customize->add_setting('dz_header_image_width',  array(
        'default' => 300
    ));

    $wp_customize->add_control( new DZ_Customize_Number_Control(
        $wp_customize,
        'dz_header_image_width',
        array(
            'label' => __('Ancho de la imagen', 'dazzet-barebones'),
            'section' => 'header_image',
            'settings' => 'dz_header_image_width'
        )
    ));

    // Control para especificar el alto de la cabecera
    $wp_customize->add_setting('dz_header_image_height', array(
        'default' => 100
    ));

    $wp_customize->add_control( new DZ_Customize_Number_Control(
        $wp_customize,
        'dz_header_image_height',
        array(
            'label' => __('Alto de la image', 'dazzet-barebones'),
            'section' => 'header_image',
            'settings' => 'dz_header_image_height'
        )
    ));

}
