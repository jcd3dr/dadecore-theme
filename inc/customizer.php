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
<?php
/**
 * Theme Customizer enhancements for DadeCore Theme.
 *
 * Este archivo contiene:
 * - Soporte para cambiar colores clave (accent, accent-secondary, fondo)
 * - Opciones dinámicas para la página 404
 * - Vista previa en vivo con postMessage
 */

// ===================================================================
// ✅ BLOQUE 1: Colores Personalizables (Acento, Secundario, Fondo)
// ===================================================================

function dadecore_customize_register_colors( $wp_customize ) {

    // 🎨 Color de acento principal
    $wp_customize->add_setting( 'dadecore_accent_color', array(
        'default'           => '#00FFC2',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'dadecore_accent_color', array(
        'label'    => __( 'Color Principal de Acento', 'dadecore-theme' ),
        'section'  => 'colors',
        'settings' => 'dadecore_accent_color',
    ) ) );

    // 🎨 Color de acento secundario
    $wp_customize->add_setting( 'dadecore_accent_secondary_color', array(
        'default'           => '#64FFDA',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'dadecore_accent_secondary_color', array(
        'label'    => __( 'Color Secundario de Acento', 'dadecore-theme' ),
        'section'  => 'colors',
        'settings' => 'dadecore_accent_secondary_color',
    ) ) );

    // 🎨 Color de fondo principal
    $wp_customize->add_setting( 'dadecore_bg_color', array(
        'default'           => '#0A1128',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'dadecore_bg_color', array(
        'label'    => __( 'Color de Fondo Principal', 'dadecore-theme' ),
        'section'  => 'colors',
        'settings' => 'dadecore_bg_color',
    ) ) );
}
add_action( 'customize_register', 'dadecore_customize_register_colors' );

// Inyectar los colores como variables CSS en el <head>
function dadecore_customizer_css_variables() {
    $accent = get_theme_mod( 'dadecore_accent_color', '#00FFC2' );
    $accent_secondary = get_theme_mod( 'dadecore_accent_secondary_color', '#64FFDA' );
    $bg_color = get_theme_mod( 'dadecore_bg_color', '#0A1128' );

    echo '<style>:root {';
    echo '--color-accent: ' . esc_attr( $accent ) . ';';
    echo '--color-accent-secondary: ' . esc_attr( $accent_secondary ) . ';';
    echo '--color-dark-blue-bg: ' . esc_attr( $bg_color ) . ';';
    echo '}</style>';
}
add_action( 'wp_head', 'dadecore_customizer_css_variables' );


// ===================================================================
// ✅ BLOQUE 2: Personalización dinámica de la página 404
// ===================================================================

function dadecore_customize_register_404( $wp_customize ) {

    $wp_customize->add_section('dadecore_404_layout', array(
        'title'       => __('Página 404', 'dadecore-theme'),
        'priority'    => 130,
        'description' => __('Personaliza el diseño de la página de error 404.', 'dadecore-theme'),
    ));

    $wp_customize->add_setting('dadecore_404_show_sidebar', array(
        'default'   => true,
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('dadecore_404_show_sidebar', array(
        'label'    => __('¿Mostrar barra lateral?', 'dadecore-theme'),
        'section'  => 'dadecore_404_layout',
        'type'     => 'checkbox',
    ));

    $wp_customize->add_setting('dadecore_404_sidebar_position', array(
        'default'   => 'right',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('dadecore_404_sidebar_position', array(
        'label'    => __('Posición de la barra lateral', 'dadecore-theme'),
        'section'  => 'dadecore_404_layout',
        'type'     => 'radio',
        'choices'  => array(
            'left'  => __('Izquierda', 'dadecore-theme'),
            'right' => __('Derecha', 'dadecore-theme'),
        ),
    ));

    $wp_customize->add_setting('dadecore_404_custom_title', array(
        'default'   => __('Error 404', 'dadecore-theme'),
        'transport' => 'postMessage',
    ));
    $wp_customize->add_control('dadecore_404_custom_title', array(
        'label'    => __('Título personalizado', 'dadecore-theme'),
        'section'  => 'dadecore_404_layout',
        'type'     => 'text',
    ));

    $wp_customize->add_setting('dadecore_404_custom_message', array(
        'default'   => __('Lo sentimos, la página que buscas no existe.', 'dadecore-theme'),
        'transport' => 'postMessage',
    ));
    $wp_customize->add_control('dadecore_404_custom_message', array(
        'label'    => __('Mensaje personalizado', 'dadecore-theme'),
        'section'  => 'dadecore_404_layout',
        'type'     => 'textarea',
    ));
}
add_action( 'customize_register', 'dadecore_customize_register_404' );


// ===================================================================
// ✅ BLOQUE 3: Vista previa en vivo con postMessage
// ===================================================================

function dadecore_customizer_live_preview() {
    wp_enqueue_script( 
        'dadecore-customizer-preview', 
        get_template_directory_uri() . '/assets/js/customizer-preview.js', 
        array( 'customize-preview' ), 
        null, 
        true 
    );
}
add_action( 'customize_preview_init', 'dadecore_customizer_live_preview' );

