<?php
/**
 * Theme Customizer enhancements for DadeCore Theme.
 *
 * This file houses Customizer options beyond what is defined in theme.json.
 */

// ===================================================================
// ✅ BLOQUE 4: Opciones extra de tema (Header, Blog, Single, Footer, Social)
// ===================================================================

function dadecore_customize_register_extra_sections( $wp_customize ) {
    // -----------------------------
    // Header & Navigation
    // -----------------------------
    $wp_customize->add_section( 'dadecore_header_nav', array(
        'title'    => __( 'Header & Navigation', 'dadecore-theme' ),
        'priority' => 25,
    ) );

    $wp_customize->add_setting( 'dadecore_logo_position', array(
        'default'           => 'left',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'dadecore_logo_position', array(
        'label'   => __( 'Logo position', 'dadecore-theme' ),
        'section' => 'dadecore_header_nav',
        'type'    => 'radio',
        'choices' => array(
            'left'   => __( 'Left', 'dadecore-theme' ),
            'center' => __( 'Center', 'dadecore-theme' ),
        ),
    ) );

    $wp_customize->add_setting( 'dadecore_nav_alignment', array(
        'default'           => 'right',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'dadecore_nav_alignment', array(
        'label'   => __( 'Navbar alignment', 'dadecore-theme' ),
        'section' => 'dadecore_header_nav',
        'type'    => 'radio',
        'choices' => array(
            'left'   => __( 'Left', 'dadecore-theme' ),
            'center' => __( 'Center', 'dadecore-theme' ),
            'right'  => __( 'Right', 'dadecore-theme' ),
        ),
    ) );

    $wp_customize->add_setting( 'dadecore_enable_sticky_header', array(
        'default'           => true,
        'sanitize_callback' => 'wp_validate_boolean',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'dadecore_enable_sticky_header', array(
        'label'   => __( 'Enable sticky header', 'dadecore-theme' ),
        'section' => 'dadecore_header_nav',
        'type'    => 'checkbox',
    ) );

    $wp_customize->add_setting( 'dadecore_header_bg_color', array(
        'default'           => '#0A1128',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'dadecore_header_bg_color', array(
        'label'    => __( 'Header background color', 'dadecore-theme' ),
        'section'  => 'dadecore_header_nav',
        'settings' => 'dadecore_header_bg_color',
    ) ) );

    $wp_customize->add_setting( 'dadecore_header_text_color', array(
        'default'           => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'dadecore_header_text_color', array(
        'label'    => __( 'Header text color', 'dadecore-theme' ),
        'section'  => 'dadecore_header_nav',
        'settings' => 'dadecore_header_text_color',
    ) ) );

    // -----------------------------
    // Blog Layout
    // -----------------------------
    $wp_customize->add_section( 'dadecore_blog_layout', array(
        'title'    => __( 'Blog Layout', 'dadecore-theme' ),
        'priority' => 40,
    ) );

    $wp_customize->add_setting( 'dadecore_blog_sidebar', array(
        'default'           => true,
        'sanitize_callback' => 'wp_validate_boolean',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'dadecore_blog_sidebar', array(
        'label'   => __( 'Display sidebar', 'dadecore-theme' ),
        'section' => 'dadecore_blog_layout',
        'type'    => 'checkbox',
    ) );

    $wp_customize->add_setting( 'dadecore_blog_excerpt_length', array(
        'default'           => 20,
        'sanitize_callback' => 'absint',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'dadecore_blog_excerpt_length', array(
        'label'       => __( 'Excerpt length (words)', 'dadecore-theme' ),
        'section'     => 'dadecore_blog_layout',
        'type'        => 'number',
        'input_attrs' => array( 'min' => 5, 'max' => 100 ),
    ) );

    $wp_customize->add_setting( 'dadecore_blog_view', array(
        'default'           => 'grid',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'dadecore_blog_view', array(
        'label'   => __( 'Blog view', 'dadecore-theme' ),
        'section' => 'dadecore_blog_layout',
        'type'    => 'radio',
        'choices' => array(
            'grid' => __( 'Grid', 'dadecore-theme' ),
            'list' => __( 'List', 'dadecore-theme' ),
        ),
    ) );

    // -----------------------------
    // Single Post
    // -----------------------------
    $wp_customize->add_section( 'dadecore_single_post', array(
        'title'    => __( 'Single Post', 'dadecore-theme' ),
        'priority' => 45,
    ) );

    $wp_customize->add_setting( 'dadecore_single_show_meta', array(
        'default'           => true,
        'sanitize_callback' => 'wp_validate_boolean',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'dadecore_single_show_meta', array(
        'label'   => __( 'Show post metadata', 'dadecore-theme' ),
        'section' => 'dadecore_single_post',
        'type'    => 'checkbox',
    ) );

    $wp_customize->add_setting( 'dadecore_single_sidebar_position', array(
        'default'           => 'right',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'dadecore_single_sidebar_position', array(
        'label'   => __( 'Sidebar position', 'dadecore-theme' ),
        'section' => 'dadecore_single_post',
        'type'    => 'radio',
        'choices' => array(
            'left'  => __( 'Left', 'dadecore-theme' ),
            'right' => __( 'Right', 'dadecore-theme' ),
        ),
    ) );

    // -----------------------------
    // Footer
    // -----------------------------
    $wp_customize->add_section( 'dadecore_footer', array(
        'title'    => __( 'Footer', 'dadecore-theme' ),
        'priority' => 50,
    ) );

    $wp_customize->add_setting( 'dadecore_footer_show_widgets', array(
        'default'           => true,
        'sanitize_callback' => 'wp_validate_boolean',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'dadecore_footer_show_widgets', array(
        'label'   => __( 'Display footer widgets', 'dadecore-theme' ),
        'section' => 'dadecore_footer',
        'type'    => 'checkbox',
    ) );

    $wp_customize->add_setting( 'dadecore_footer_custom_text', array(
        'default'           => '',
        'sanitize_callback' => 'wp_kses_post',
        'transport'         => 'postMessage',
    ) );
    $wp_customize->add_control( 'dadecore_footer_custom_text', array(
        'label'   => __( 'Custom footer text', 'dadecore-theme' ),
        'section' => 'dadecore_footer',
        'type'    => 'text',
    ) );

    // -----------------------------
    // Social Links
    // -----------------------------
    $wp_customize->add_section( 'dadecore_social_links', array(
        'title'    => __( 'Social Links', 'dadecore-theme' ),
        'priority' => 55,
    ) );

    $networks = array( 'facebook', 'twitter', 'instagram', 'linkedin', 'github' );
    foreach ( $networks as $network ) {
        $wp_customize->add_setting( 'dadecore_social_' . $network, array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
            'transport'         => 'postMessage',
        ) );
        $wp_customize->add_control( 'dadecore_social_' . $network, array(
            'label'   => ucfirst( $network ) . ' URL',
            'section' => 'dadecore_social_links',
            'type'    => 'url',
        ) );
    }
}
add_action( 'customize_register', 'dadecore_customize_register_extra_sections' );

function dadecore_customizer_css() {
    $accent = get_theme_mod( 'dadecore_accent_color', '#00FFC2' );
    echo '<style>:root{--color-green-tech:' . esc_attr( $accent ) . ';}</style>';
}
add_action( 'wp_head', 'dadecore_customizer_css' );
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
    $header_bg = get_theme_mod( 'dadecore_header_bg_color', '#0A1128' );
    $header_text = get_theme_mod( 'dadecore_header_text_color', '#ffffff' );

    echo '<style>:root {';
    echo '--color-accent: ' . esc_attr( $accent ) . ';';
    echo '--color-accent-secondary: ' . esc_attr( $accent_secondary ) . ';';
    echo '--color-dark-blue-bg: ' . esc_attr( $bg_color ) . ';';
    echo '--header-bg-color: ' . esc_attr( $header_bg ) . ';';
    echo '--header-text-color: ' . esc_attr( $header_text ) . ';';
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
        array( 'jquery', 'customize-preview' ),
        null,
        true
    );
}
add_action( 'customize_preview_init', 'dadecore_customizer_live_preview' );

