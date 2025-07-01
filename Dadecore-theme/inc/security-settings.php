<?php
/**
 * Login security settings page.
 */

/**
 * Register the settings page under "Settings".
 */
function dadecore_register_security_settings_page() {
    add_options_page(
        __( 'Seguridad Login', 'dadecore-theme' ),
        __( 'Seguridad Login', 'dadecore-theme' ),
        'manage_options',
        'dadecore-login-security',
        'dadecore_render_security_settings_page'
    );

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
}
add_action( 'admin_menu', 'dadecore_register_security_settings_page' );

/**
 * Flush rewrite rules when the login slug changes.
 *
 * @param mixed $old Old value.
 * @param mixed $new New value.
 */
function dadecore_flush_rewrite_on_slug_change( $old, $new ) {
    if ( $old !== $new ) {
        flush_rewrite_rules();
    }
}
add_action( 'update_option_dadecore_login_slug', 'dadecore_flush_rewrite_on_slug_change', 10, 2 );

/**
 * Output the settings page HTML.
 */
function dadecore_render_security_settings_page() {
    ?>
    <div class="wrap">
        <h1><?php esc_html_e( 'Seguridad Login', 'dadecore-theme' ); ?></h1>
        <form method="post" action="options.php">
            <?php settings_fields( 'dadecore_security_settings' ); ?>
            <table class="form-table" role="presentation">
                <tr>
                    <th scope="row">
                        <label for="dadecore_login_slug"><?php esc_html_e( 'Login URL Slug', 'dadecore-theme' ); ?></label>
                    </th>
                    <td>
                        <input name="dadecore_login_slug" type="text" id="dadecore_login_slug" value="<?php echo esc_attr( get_option( 'dadecore_login_slug', 'login' ) ); ?>" class="regular-text" />
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="dadecore_max_login_attempts"><?php esc_html_e( 'Max Login Attempts', 'dadecore-theme' ); ?></label>
                    </th>
                    <td>
                        <input name="dadecore_max_login_attempts" type="number" id="dadecore_max_login_attempts" value="<?php echo esc_attr( get_option( 'dadecore_max_login_attempts', 5 ) ); ?>" class="small-text" min="1" />
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="dadecore_lockout_time"><?php esc_html_e( 'Lockout Time (minutes)', 'dadecore-theme' ); ?></label>
                    </th>
                    <td>
                        <input name="dadecore_lockout_time" type="number" id="dadecore_lockout_time" value="<?php echo esc_attr( get_option( 'dadecore_lockout_time', 60 ) ); ?>" class="small-text" min="1" />
                    </td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}
