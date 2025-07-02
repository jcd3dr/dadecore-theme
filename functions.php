<?php
/**
 * DadeCore Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package DadeCore_Theme
 */

if ( ! function_exists( 'dadecore_theme_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function dadecore_theme_setup() {

		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on "DadeCore Theme", use a different
		 * text domain since you're making a derivative theme.
		 */
		load_theme_textdomain( 'dadecore-theme', get_template_directory() . '/languages' );

                // Add default posts and comments RSS feed links to head.
                add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
                add_theme_support( 'post-thumbnails' );

                // Gutenberg and block editor features.
                add_theme_support( 'wp-block-styles' );
                add_theme_support( 'responsive-embeds' );
                add_theme_support( 'editor-styles' );
                add_editor_style( 'assets/css/editor-style.css' );

                add_theme_support( 'align-wide' );
                add_theme_support( 'custom-logo', array( 'height' => 200, 'width' => 200, 'flex-height' => true, 'flex-width' => true ) );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'primary_menu' => esc_html__( 'Menú Principal', 'dadecore-theme' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'script',
			'style',
		) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );
	}
endif;
add_action( 'after_setup_theme', 'dadecore_theme_setup' );

/**
 * Enqueue scripts and styles.
 */
function dadecore_theme_scripts() {
	// Estilos principales del tema
	wp_enqueue_style( 'dadecore-theme-main-style', get_template_directory_uri() . '/assets/css/main.css', array(), null );

	// Fuentes de Google (Inter y Poppins)
	// Precarga para optimización
	wp_enqueue_style( 'google-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@400;700&family=Poppins:wght@400;700&display=swap', false );
	wp_style_add_data( 'google-fonts', 'precache', true );


	// Script principal del tema
	wp_enqueue_script( 'dadecore-theme-main-script', get_template_directory_uri() . '/assets/js/main.js', array(), null, true ); // 'true' para cargar en el footer

	// Asegúrate de que jQuery no se cargue por defecto si no lo necesitas,
	// o que se cargue de forma selectiva si algún plugin lo requiere.
	// Por ahora, WordPress cargará su versión si es necesaria.
        // Más adelante podemos desregistrarla si se necesita una solución Vanilla JS pura.
}
add_action( 'wp_enqueue_scripts', 'dadecore_theme_scripts' );

/** Google Tag Manager integration. */
function dadecore_gtm_head() {
        $id = get_theme_mod( 'dadecore_gtm_id' );
        if ( ! $id ) {
                return;
        }
        echo "<!-- Google Tag Manager -->\n";
        echo "<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src='https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);})(window,document,'script','dataLayer','" . esc_js( $id ) . "');</script>\n";
        echo "<!-- End Google Tag Manager -->\n";
}
add_action( 'wp_head', 'dadecore_gtm_head', 0 );

function dadecore_gtm_body() {
        $id = get_theme_mod( 'dadecore_gtm_id' );
        if ( ! $id ) {
                return;
        }
        echo "<!-- Google Tag Manager (noscript) --><noscript><iframe src='https://www.googletagmanager.com/ns.html?id=" . esc_attr( $id ) . "' height='0' width='0' style='display:none;visibility:hidden'></iframe></noscript><!-- End Google Tag Manager (noscript) -->";
}
add_action( 'wp_body_open', 'dadecore_gtm_body' );

// Include additional functionality files.
require get_template_directory() . '/inc/customizer.php';
require get_template_directory() . '/inc/seo.php';
require get_template_directory() . '/inc/security.php';
require get_template_directory() . '/inc/cookie-consent.php';
require get_template_directory() . '/inc/security-settings.php';
