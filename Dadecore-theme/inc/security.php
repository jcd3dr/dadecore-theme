<?php
/**
 * Simple security utilities.
 */

function dadecore_limit_login_attempts( $user, $username ) {
    if ( ! get_theme_mod( 'dadecore_enable_login_protection', true ) ) {
        return $user;
    }

    $key       = 'dadecore_login_' . $_SERVER['REMOTE_ADDR'];
    $attempts  = (int) get_transient( $key );
    $max       = (int) get_option( 'dadecore_max_login_attempts', 5 );

    if ( $attempts >= $max ) {
        wp_die( __( 'Too many login attempts. Try again later.', 'dadecore-theme' ) );
    }

    return $user;
}
add_filter( 'authenticate', 'dadecore_limit_login_attempts', 30, 2 );

function dadecore_track_failed_login( $username ) {
    if ( ! get_theme_mod( 'dadecore_enable_login_protection', true ) ) {
        return;
    }

    $key      = 'dadecore_login_' . $_SERVER['REMOTE_ADDR'];
    $attempts = (int) get_transient( $key );
    $minutes  = (int) get_option( 'dadecore_lockout_time', 60 );

    set_transient( $key, $attempts + 1, $minutes * MINUTE_IN_SECONDS );
}
add_action( 'wp_login_failed', 'dadecore_track_failed_login' );

function dadecore_security_headers() {
    header( 'X-Frame-Options: SAMEORIGIN' );
    header( 'X-Content-Type-Options: nosniff' );
    header( 'Referrer-Policy: no-referrer-when-downgrade' );
}
add_action( 'send_headers', 'dadecore_security_headers' );

function dadecore_login_rewrite() {
    $slug = get_option( 'dadecore_login_slug', 'login' );
    add_rewrite_rule( '^' . $slug . '/?$', 'wp-login.php', 'top' );
}
add_action( 'init', 'dadecore_login_rewrite' );

function dadecore_custom_login_url( $login_url, $redirect, $force_reauth ) {
    $slug = get_option( 'dadecore_login_slug', 'login' );
    return home_url( '/' . trim( $slug, '/' ) . '/' );
}
add_filter( 'login_url', 'dadecore_custom_login_url', 10, 3 );
