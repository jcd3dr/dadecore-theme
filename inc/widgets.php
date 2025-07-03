<?php
/**
 * Register widget areas.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 * @package DadeCore_Theme
 */

function dadecore_widgets_init() {
	// Barra lateral principal
	register_sidebar(
		array(
			'name'          => esc_html__( 'Primary Sidebar', 'dadecore-theme' ),
			'id'            => 'primary-sidebar',
			'description'   => esc_html__( 'Add widgets here to appear in your main sidebar.', 'dadecore-theme' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	// Áreas de widgets para el pie de página (Ejemplo: 3 columnas)
	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer Column 1', 'dadecore-theme' ),
			'id'            => 'footer-1',
			'description'   => esc_html__( 'Add widgets here for the first footer column.', 'dadecore-theme' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
		)
	);
	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer Column 2', 'dadecore-theme' ),
			'id'            => 'footer-2',
			'description'   => esc_html__( 'Add widgets here for the second footer column.', 'dadecore-theme' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
		)
	);
	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer Column 3', 'dadecore-theme' ),
			'id'            => 'footer-3',
			'description'   => esc_html__( 'Add widgets here for the third footer column.', 'dadecore-theme' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
		)
	);

	// Áreas para anuncios
	register_sidebar(
		array(
			'name'          => esc_html__( 'Ads: Header', 'dadecore-theme' ),
			'id'            => 'ads-header',
			'description'   => esc_html__( 'Area for ads in the header. May require specific theme integration.', 'dadecore-theme' ),
			'before_widget' => '<div id="%1$s" class="widget_ads %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h5 class="widget-title-ads screen-reader-text">', // Oculto para ads
			'after_title'   => '</h5>',
		)
	);
    register_sidebar(
		array(
			'name'          => esc_html__( 'Ads: After Content', 'dadecore-theme' ),
			'id'            => 'ads-after-content',
			'description'   => esc_html__( 'Area for ads displayed after the main content of a post or page.', 'dadecore-theme' ),
			'before_widget' => '<div id="%1$s" class="widget_ads %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h5 class="widget-title-ads screen-reader-text">',
			'after_title'   => '</h5>',
		)
	);
    register_sidebar(
		array(
			'name'          => esc_html__( 'Ads: In-Feed (Blog/Archive)', 'dadecore-theme' ),
			'id'            => 'ads-infeed',
			'description'   => esc_html__( 'Area for ads to be placed between posts in blog or archive listings.', 'dadecore-theme' ),
			'before_widget' => '<div id="%1$s" class="widget_ads %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h5 class="widget-title-ads screen-reader-text">',
			'after_title'   => '</h5>',
		)
	);

}
add_action( 'widgets_init', 'dadecore_widgets_init' );
