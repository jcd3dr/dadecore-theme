<?php
/**
 * Theme Customizer enhancements for DadeCore Theme.
 */

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

    $wp_customize->add_setting( 'dadecore_gtm_id', array(
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'dadecore_gtm_id', array(
        'label' => __( 'Google Tag Manager ID', 'dadecore-theme' ),
        'section' => 'title_tagline',
        'type' => 'text',
    ) );

    // Login slug setting
    $wp_customize->add_setting( 'dadecore_login_slug', array(
        'sanitize_callback' => 'sanitize_title_with_dashes',
        'default' => 'login',
    ) );
    $wp_customize->add_control( 'dadecore_login_slug', array(
        'label' => __( 'Login URL Slug', 'dadecore-theme' ),
        'section' => 'title_tagline',
        'type' => 'text',
    ) );

    // Security section
    $wp_customize->add_section( 'dadecore_security', array(
        'title'    => __( 'Security', 'dadecore-theme' ),
        'priority' => 160,
    ) );

    // Enable/disable login protection
    $wp_customize->add_setting( 'dadecore_enable_login_protection', array(
        'default'           => true,
        'sanitize_callback' => 'wp_validate_boolean',
    ) );
    $wp_customize->add_control( 'dadecore_enable_login_protection', array(
        'label'   => __( 'Enable Login Protection', 'dadecore-theme' ),
        'section' => 'dadecore_security',
        'type'    => 'checkbox',
    ) );

    // Max login attempts
    $wp_customize->add_setting( 'dadecore_max_login_attempts', array(
        'default'           => 5,
        'sanitize_callback' => 'absint',
    ) );
    $wp_customize->add_control( 'dadecore_max_login_attempts', array(
        'label'       => __( 'Max Login Attempts', 'dadecore-theme' ),
        'section'     => 'dadecore_security',
        'type'        => 'number',
        'input_attrs' => array(
            'min' => 1,
        ),
    ) );

    // Lockout duration
    $wp_customize->add_setting( 'dadecore_lockout_time', array(
        'default'           => 60,
        'sanitize_callback' => 'absint',
    ) );
    $wp_customize->add_control( 'dadecore_lockout_time', array(
        'label'       => __( 'Lockout Time (minutes)', 'dadecore-theme' ),
        'section'     => 'dadecore_security',
        'type'        => 'number',
        'input_attrs' => array(
            'min' => 1,
        ),
    ) );
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
