<?php
/**
 * Funciones de seguridad integradas en el tema DadeCore Theme.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class DadeCore_Security {

	private $login_slug;

	public function __construct() {
		$this->login_slug = get_option( 'dadecore_login_slug', 'login' );

		if ( get_option( 'dadecore_enable_login_protection', 1 ) ) {
			add_action( 'init', [ $this, 'bloquear_acceso_wp_admin' ] );
			add_action( 'wp_loaded', [ $this, 'interceptar_pagina_login' ] );

			add_filter( 'site_url', [ $this, 'filtrar_url_login' ], 10, 4 );
			add_filter( 'network_site_url', [ $this, 'filtrar_url_login' ], 10, 4 );
			add_filter( 'wp_redirect', [ $this, 'filtrar_url_login' ], 10, 2 );
			add_filter( 'lostpassword_url', [ $this, 'filtrar_url_login' ], 10, 2 );
		}

		// Protección fuerza bruta
		add_action( 'wp_login_failed', [ $this, 'manejar_intento_fallido' ] );
		add_filter( 'authenticate', [ $this, 'verificar_bloqueo_de_ip' ], 30, 3 );

		// Cabeceras de seguridad
		add_action( 'send_headers', [ $this, 'cabeceras_seguridad' ] );
	}

	// === LÓGICA ===

	public function bloquear_acceso_wp_admin() {
		if ( is_admin() && ! is_user_logged_in() && ! wp_doing_ajax() ) {
			$this->mostrar_404();
		}
	}

	public function interceptar_pagina_login() {
		global $pagenow;

		$path = trim( parse_url( $_SERVER['REQUEST_URI'], PHP_URL_PATH ), '/' );

		if ( basename( $path ) === $this->login_slug ) {
			if ( get_transient( 'dc_lockout_' . $this->ip() ) ) {
				wp_die( __( 'Demasiados intentos fallidos. Inténtalo más tarde.', 'dadecore-theme' ) );
			}
			require_once ABSPATH . 'wp-login.php';
			exit;
		}

		if ( $pagenow === 'wp-login.php' && ! isset( $_GET['action'] ) ) {
			$this->mostrar_404();
		}
	}

	public function manejar_intento_fallido( $username ) {
		$ip = $this->ip();
		$key = 'dc_failed_' . $ip;
		$attempts = (int) get_transient( $key );
		$max = (int) get_option( 'dadecore_max_login_attempts', 5 );
		$minutes = (int) get_option( 'dadecore_lockout_time', 60 );

		$attempts++;
		if ( $attempts >= $max ) {
			set_transient( 'dc_lockout_' . $ip, true, $minutes * MINUTE_IN_SECONDS );
			delete_transient( $key );
		} else {
			set_transient( $key, $attempts, 5 * MINUTE_IN_SECONDS );
		}
	}

	public function verificar_bloqueo_de_ip( $user, $username, $password ) {
		if ( get_transient( 'dc_lockout_' . $this->ip() ) ) {
			return new WP_Error( 'too_many_retries', __( '<strong>ERROR</strong>: Has superado el número de intentos. Tu IP está temporalmente bloqueada.', 'dadecore-theme' ) );
		}
		return $user;
	}

	public function cabeceras_seguridad() {
		if ( ! get_option( 'dadecore_enable_security_headers', true ) ) {
        		return;
    		}
		header( 'X-Frame-Options: SAMEORIGIN' );
		header( 'X-Content-Type-Options: nosniff' );
		header( 'Referrer-Policy: no-referrer-when-downgrade' );
	}

	// === FILTROS DE URL ===

	public function filtrar_url_login( $url ) {
		if ( strpos( $url, 'wp-login.php' ) !== false ) {
			$args = strpos( $url, '?' ) !== false ? '?' . parse_url( $url, PHP_URL_QUERY ) : '';
			$url = home_url( '/' . trim( $this->login_slug, '/' ) . '/' ) . $args;
		}
		return $url;
	}

	private function mostrar_404() {
    		status_header( 404 );
    		nocache_headers();

    		// Si el tema tiene una plantilla 404.php, la usamos. Si no, usamos wp_die()
   		 $template_404 = get_404_template();

    		if ( $template_404 && file_exists( $template_404 ) ) {
        		include $template_404;
    		} else {
     		   wp_die( __( 'No se encuentra la página solicitada.', 'dadecore-theme' ), '404', [ 'response' => 404 ] );
   			 }

  		  exit;
	}

	private function ip() {
		if ( ! empty( $_SERVER['HTTP_CLIENT_IP'] ) ) {
			return $_SERVER['HTTP_CLIENT_IP'];
		} elseif ( ! empty( $_SERVER['HTTP_X_FORWARDED_FOR'] ) ) {
			return $_SERVER['HTTP_X_FORWARDED_FOR'];
		}
		return $_SERVER['REMOTE_ADDR'];
	}
}

new DadeCore_Security();
