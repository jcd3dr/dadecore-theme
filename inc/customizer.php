<?php
/**
 * Theme Customizer enhancements for DadeCore Theme.
 *
 * This file is temporarily commented out as its functionality (accent color)
 * has been migrated to theme.json. It can be repurposed later for other
 * Customizer options not suitable for theme.json.
 */

/*
function dadecore_customize_register( $wp_customize ) {
    $wp_customize->add_setting( 'dadecore_accent_color', array(
        'default' => '#00FFC2',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'postMessage',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'dadecore_accent_color', array(
        'label' => __( 'Accent Color', 'dadecore-theme' ),
        'section' => 'colors',
    ) ) );

}
add_action( 'customize_register', 'dadecore_customize_register' );

function dadecore_customizer_live_preview() {
    wp_enqueue_script( 'dadecore-customizer', get_template_directory_uri() . '/assets/js/customizer-preview.js', array( 'customize-preview' ), null, true );
}
add_action( 'customize_preview_init', 'dadecore_customizer_live_preview' );

function dadecore_customizer_css() {
    $accent = get_theme_mod( 'dadecore_accent_color', '#00FFC2' );
    echo '<style>:root{--color-green-tech:' . esc_attr( $accent ) . ';}</style>';
}
add_action( 'wp_head', 'dadecore_customizer_css' );
*/
