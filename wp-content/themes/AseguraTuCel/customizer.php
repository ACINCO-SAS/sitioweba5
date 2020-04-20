<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function a5_theme_customizer($wp_customize) {
    
    global $wpdb;


    /**** Header */
    $wp_customize->add_section( 'a5_logosamsung',
        array(
            'title' => esc_html__('Logo  Samsung', 'acinco' ),
            'priority' => 1,
        )
    );


    $wp_customize->add_setting('a5_logosamsung_image', ['default' => '']);
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'a5_logosamsung_image',
            array(
                'label'      => __( 'Escoger imagen', 'acinco' ),
                'section'    => 'a5_logosamsung',
            )
        )
    );

    $wp_customize->add_setting('a5_logosamsung_link', ['default' => '#','sanitize_callback' => 'sanitize_text_field']);
    $wp_customize->add_control('a5_logosamsung_link', array(
            'label' => esc_html__( 'URL', 'acinco' ),
            'section' => 'a5_logosamsung',
            'type' => 'text',
        )
    );
    

}
add_action( 'customize_register', 'a5_theme_customizer' );