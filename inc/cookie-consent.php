<?php
/**
 * Simple cookie consent banner with Google Consent Mode.
 */

function dadecore_cookie_consent_markup() {
    ?>
    <div id="cookie-consent" class="cookie-consent hide">
        <p><?php esc_html_e( 'This site uses cookies for analytics and marketing.', 'dadecore-theme' ); ?></p>
        <button id="cookie-accept" class="btn btn-primary"><?php esc_html_e( 'Accept', 'dadecore-theme' ); ?></button>
    </div>
    <?php
}
add_action( 'wp_footer', 'dadecore_cookie_consent_markup' );

function dadecore_cookie_consent_scripts() {
    wp_enqueue_style( 'dadecore-cookie', get_template_directory_uri() . '/assets/css/cookie-consent.css', array(), null );
    wp_enqueue_script( 'dadecore-cookie', get_template_directory_uri() . '/assets/js/cookie-consent.js', array(), null, true );
}
add_action( 'wp_enqueue_scripts', 'dadecore_cookie_consent_scripts' );
