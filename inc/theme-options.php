<?php
/**
 * Theme options page for DadeCore Theme.
 */

function dadecore_register_theme_options_page() {
    add_menu_page(
        __( 'DadeCore Options', 'dadecore-theme' ),
        __( 'DadeCore Theme', 'dadecore-theme' ),
        'manage_options',
        'dadecore-theme-options',
        'dadecore_render_theme_options_page',
        'dashicons-admin-generic',
        61
    );
}
add_action( 'admin_menu', 'dadecore_register_theme_options_page' );

function dadecore_register_theme_settings() {
    // Integrations section
    register_setting( 'dadecore_integrations_settings', 'dadecore_gtm_id', [
        'sanitize_callback' => 'sanitize_text_field',
    ] );
    add_settings_section( 'dadecore_integrations', '', '__return_false', 'dadecore_integrations' );
    add_settings_field( 'dadecore_gtm_id', __( 'Google Tag Manager ID', 'dadecore-theme' ), 'dadecore_gtm_id_field', 'dadecore_integrations', 'dadecore_integrations' );

    // Social Profiles for Organization Schema
    register_setting( 'dadecore_integrations_settings', 'dadecore_social_profiles', [
        'sanitize_callback' => 'dadecore_sanitize_social_profiles',
        'type' => 'array',
        'default' => []
    ] );
    add_settings_field( 'dadecore_social_profiles', __( 'Social Profiles (URLs for Organization Schema)', 'dadecore-theme' ), 'dadecore_social_profiles_field', 'dadecore_integrations', 'dadecore_integrations' );


    // Security section
    register_setting( 'dadecore_security_settings', 'dadecore_enable_login_protection', [
        'sanitize_callback' => 'wp_validate_boolean',
        'type'              => 'boolean',
        'default'           => true,
    ] );
    register_setting( 'dadecore_security_settings', 'dadecore_login_slug', [
        'sanitize_callback' => 'sanitize_title_with_dashes',
        'default'           => 'login',
    ] );
    register_setting( 'dadecore_security_settings', 'dadecore_max_login_attempts', [
        'sanitize_callback' => 'absint',
        'default'           => 5,
    ] );
    register_setting( 'dadecore_security_settings', 'dadecore_lockout_time', [
        'sanitize_callback' => 'absint',
        'default'           => 60,
    ] );
    register_setting( 'dadecore_security_settings', 'dadecore_enable_security_headers', [
        'sanitize_callback' => 'wp_validate_boolean',
        'type'              => 'boolean',
        'default'           => true,
    ] );

    add_settings_section( 'dadecore_security', '', '__return_false', 'dadecore_security' );
    add_settings_field( 'dadecore_enable_login_protection', __( 'Enable Login Protection', 'dadecore-theme' ), 'dadecore_enable_login_protection_field', 'dadecore_security', 'dadecore_security' );
    add_settings_field( 'dadecore_login_slug', __( 'Login URL Slug', 'dadecore-theme' ), 'dadecore_login_slug_field', 'dadecore_security', 'dadecore_security' );
    add_settings_field( 'dadecore_max_login_attempts', __( 'Max Login Attempts', 'dadecore-theme' ), 'dadecore_max_login_attempts_field', 'dadecore_security', 'dadecore_security' );
    add_settings_field( 'dadecore_lockout_time', __( 'Lockout Time (minutes)', 'dadecore-theme' ), 'dadecore_lockout_time_field', 'dadecore_security', 'dadecore_security' );
    add_settings_field( 'dadecore_enable_security_headers', __( 'Enable Security Headers', 'dadecore-theme' ), 'dadecore_enable_security_headers_field', 'dadecore_security', 'dadecore_security' );
}
add_action( 'admin_init', 'dadecore_register_theme_settings' );

function dadecore_gtm_id_field() {
    $value = get_option( 'dadecore_gtm_id', '' );
    echo '<input type="text" id="dadecore_gtm_id" name="dadecore_gtm_id" value="' . esc_attr( $value ) . '" class="regular-text" />';
    echo '<p class="description">' . esc_html__( 'Enter your Google Tag Manager ID (e.g., GTM-XXXXXX).', 'dadecore-theme' ) . '</p>';
}

function dadecore_social_profiles_field() {
    $profiles = get_option( 'dadecore_social_profiles', [] );
    // Define a list of common social networks
    $social_networks = ['facebook', 'twitter', 'instagram', 'linkedin', 'youtube', 'pinterest', 'github'];

    echo '<p class="description">' . esc_html__( 'Enter the full URLs for your organization\'s social media profiles.', 'dadecore-theme' ) . '</p>';
    foreach ( $social_networks as $network ) {
        $value = isset( $profiles[$network] ) ? $profiles[$network] : '';
        echo '<p><label style="display:inline-block; width:100px;" for="dadecore_social_' . esc_attr( $network ) . '">' . esc_html( ucfirst( $network ) ) . ':</label> ';
        echo '<input type="url" id="dadecore_social_' . esc_attr( $network ) . '" name="dadecore_social_profiles[' . esc_attr( $network ) . ']" value="' . esc_url( $value ) . '" class="regular-text" placeholder="https://' . esc_attr( $network ) . '.com/yourprofile" /></p>';
    }
}

function dadecore_sanitize_social_profiles( $input ) {
    $output = [];
    if ( is_array( $input ) ) {
        foreach ( $input as $network => $url ) {
            if ( ! empty( $url ) ) {
                $output[sanitize_key( $network )] = esc_url_raw( $url );
            }
        }
    }
    return $output;
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

function dadecore_enable_security_headers_field() {
    $value = get_option( 'dadecore_enable_security_headers', true );
    echo '<label><input type="checkbox" id="dadecore_enable_security_headers" name="dadecore_enable_security_headers" value="1" ' . checked( $value, 1, false ) . ' /> ';
    echo esc_html__( 'Inject security headers (X-Frame-Options, Content-Type, Referrer)', 'dadecore-theme' ) . '</label>';
    echo '<p class="description">' . esc_html__( 'Recommended only if you are not using Cloudflare or a firewall that already manages these headers.', 'dadecore-theme' ) . '</p>';
}
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
