<?php
/**
 * Theme options page for DadeCore Theme.
 */

/**
 * Register the theme options page under Appearance.
 */
function dadecore_register_theme_options_page() {
    add_theme_page(
        __( 'DadeCore Options', 'dadecore-theme' ),
        __( 'DadeCore Options', 'dadecore-theme' ),
        'manage_options',
        'dadecore-theme-options',
        'dadecore_render_theme_options_page'
    );
}
add_action( 'admin_menu', 'dadecore_register_theme_options_page' );

/**
 * Register settings, sections and fields.
 */
function dadecore_register_theme_settings() {
    // Integrations section.
    register_setting( 'dadecore_integrations_settings', 'dadecore_gtm_id', array(
        'sanitize_callback' => 'sanitize_text_field',
    ) );

    add_settings_section( 'dadecore_integrations', '', '__return_false', 'dadecore_integrations' );
    add_settings_field( 'dadecore_gtm_id', __( 'Google Tag Manager ID', 'dadecore-theme' ), 'dadecore_gtm_id_field', 'dadecore_integrations', 'dadecore_integrations' );

    // Security section.
    register_setting( 'dadecore_security_settings', 'dadecore_enable_login_protection', array(
        'sanitize_callback' => 'wp_validate_boolean',
        'type'              => 'boolean',
        'default'           => true,
    ) );
    register_setting( 'dadecore_security_settings', 'dadecore_login_slug', array(
        'sanitize_callback' => 'sanitize_title_with_dashes',
        'default'           => 'login',
    ) );
    register_setting( 'dadecore_security_settings', 'dadecore_max_login_attempts', array(
        'sanitize_callback' => 'absint',
        'default'           => 5,
    ) );
    register_setting( 'dadecore_security_settings', 'dadecore_lockout_time', array(
        'sanitize_callback' => 'absint',
        'default'           => 60,
    ) );

    add_settings_section( 'dadecore_security', '', '__return_false', 'dadecore_security' );
    add_settings_field( 'dadecore_enable_login_protection', __( 'Enable Login Protection', 'dadecore-theme' ), 'dadecore_enable_login_protection_field', 'dadecore_security', 'dadecore_security' );
    add_settings_field( 'dadecore_login_slug', __( 'Login URL Slug', 'dadecore-theme' ), 'dadecore_login_slug_field', 'dadecore_security', 'dadecore_security' );
    add_settings_field( 'dadecore_max_login_attempts', __( 'Max Login Attempts', 'dadecore-theme' ), 'dadecore_max_login_attempts_field', 'dadecore_security', 'dadecore_security' );
    add_settings_field( 'dadecore_lockout_time', __( 'Lockout Time (minutes)', 'dadecore-theme' ), 'dadecore_lockout_time_field', 'dadecore_security', 'dadecore_security' );
}
add_action( 'admin_init', 'dadecore_register_theme_settings' );

/** Field callbacks */
function dadecore_gtm_id_field() {
    $value = get_option( 'dadecore_gtm_id', '' );
    echo '<input type="text" id="dadecore_gtm_id" name="dadecore_gtm_id" value="' . esc_attr( $value ) . '" class="regular-text" />';
}

function dadecore_enable_login_protection_field() {
    $value = get_option( 'dadecore_enable_login_protection', 1 );
    echo '<label><input type="checkbox" id="dadecore_enable_login_protection" name="dadecore_enable_login_protection" value="1" ' . checked( $value, 1, false ) . ' /> ' . esc_html__( 'Enable login attempt protection', 'dadecore-theme' ) . '</label>';
}

function dadecore_login_slug_field() {
    $value = get_option( 'dadecore_login_slug', 'login' );
    echo '<input type="text" id="dadecore_login_slug" name="dadecore_login_slug" value="' . esc_attr( $value ) . '" class="regular-text" />';
}

function dadecore_max_login_attempts_field() {
    $value = get_option( 'dadecore_max_login_attempts', 5 );
    echo '<input type="number" min="1" id="dadecore_max_login_attempts" name="dadecore_max_login_attempts" value="' . esc_attr( $value ) . '" class="small-text" />';
}

function dadecore_lockout_time_field() {
    $value = get_option( 'dadecore_lockout_time', 60 );
    echo '<input type="number" min="1" id="dadecore_lockout_time" name="dadecore_lockout_time" value="' . esc_attr( $value ) . '" class="small-text" />';
}

/**
 * Render the settings page markup.
 */
function dadecore_render_theme_options_page() {
    $tab = isset( $_GET['tab'] ) ? sanitize_text_field( wp_unslash( $_GET['tab'] ) ) : 'integrations';
    ?>
    <div class="wrap">
        <h1><?php esc_html_e( 'DadeCore Theme Options', 'dadecore-theme' ); ?></h1>
        <nav class="nav-tab-wrapper">
            <a href="?page=dadecore-theme-options&tab=integrations" class="nav-tab <?php echo ( 'integrations' === $tab ) ? 'nav-tab-active' : ''; ?>">
                <?php esc_html_e( 'Integrations', 'dadecore-theme' ); ?>
            </a>
            <a href="?page=dadecore-theme-options&tab=security" class="nav-tab <?php echo ( 'security' === $tab ) ? 'nav-tab-active' : ''; ?>">
                <?php esc_html_e( 'Security', 'dadecore-theme' ); ?>
            </a>
        </nav>
        <form method="post" action="options.php">
            <?php
            if ( 'security' === $tab ) {
                settings_fields( 'dadecore_security_settings' );
                do_settings_sections( 'dadecore_security' );
            } else {
                settings_fields( 'dadecore_integrations_settings' );
                do_settings_sections( 'dadecore_integrations' );
            }
            submit_button();
            ?>
        </form>
    </div>
    <?php
}
