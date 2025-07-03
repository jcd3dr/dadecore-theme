<?php
/**
 * Gutenberg related functions and definitions.
 *
 * @package DadeCore_Theme
 */

if ( ! function_exists( 'dadecore_register_block_patterns' ) ) :
	/**
	 * Register Block Patterns.
	 */
	function dadecore_register_block_patterns() {

		// Hero Section Pattern
		register_block_pattern(
			'dadecore-theme/hero-section',
			array(
				'title'       => __( 'DadeCore Hero Section', 'dadecore-theme' ),
				'description' => _x( 'A full-width hero section with a title, subtitle, and buttons.', 'Block pattern description', 'dadecore-theme' ),
				'categories'  => array( 'dadecore-patterns', 'hero', 'header' ),
				'keywords'    => array( 'hero', 'header', 'banner' ),
				'viewportWidth' => 1400,
				'content'     => '<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|x-large","bottom":"var:preset|spacing|x-large"}},"elements":{"link":{"color":{"text":"var:preset|color|accent"}}}},"backgroundColor":"dark-grey","textColor":"contrast","layout":{"type":"constrained"}} -->
                                  <div class="wp-block-group alignfull has-contrast-color has-dark-grey-background-color has-text-color has-background has-link-color" style="padding-top:var(--wp--preset--spacing--x-large);padding-bottom:var(--wp--preset--spacing--x-large)"><!-- wp:heading {"textAlign":"center","level":1,"style":{"typography":{"fontStyle":"normal","fontWeight":"700","fontSize":"3rem"}},"textColor":"accent"} -->
                                  <h1 class="wp-block-heading has-text-align-center has-accent-color has-text-color" style="font-size:3rem;font-style:normal;font-weight:700">' . esc_html__( 'Digital Operations Hub', 'dadecore-theme' ) . '</h1>
                                  <!-- /wp:heading -->

                                  <!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"1.25rem"}},"textColor":"light-grey"} -->
                                  <p class="has-text-align-center has-light-grey-color has-text-color" style="font-size:1.25rem">' . esc_html__( 'Executing multiple digital business lines with efficiency and cutting-edge technology.', 'dadecore-theme' ) . '</p>
                                  <!-- /wp:paragraph -->

                                  <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center","orientation":"horizontal"},"style":{"spacing":{"margin":{"top":"var:preset|spacing|large"}}}} -->
                                  <div class="wp-block-buttons" style="margin-top:var(--wp--preset--spacing--large)"><!-- wp:button {"backgroundColor":"accent","textColor":"base","style":{"typography":{"fontFamily":"var(--wp--preset--font-family--poppins)"},"border":{"radius":"0.25rem"}},"className":"is-style-fill"} -->
                                  <div class="wp-block-button is-style-fill"><a class="wp-block-button__link has-base-color has-accent-background-color has-text-color has-background wp-element-button" href="#services" style="border-radius:0.25rem;font-family:var(--wp--preset--font-family--poppins)">' . esc_html__( 'Our Services', 'dadecore-theme' ) . '</a></div>
                                  <!-- /wp:button -->

                                  <!-- wp:button {"backgroundColor":"light-grey","textColor":"base","style":{"typography":{"fontFamily":"var(--wp--preset--font-family--poppins)"},"border":{"radius":"0.25rem"}},"className":"is-style-outline"} -->
                                  <div class="wp-block-button is-style-outline"><a class="wp-block-button__link has-base-color has-light-grey-background-color has-text-color has-background wp-element-button" href="#portfolio" style="border-radius:0.25rem;font-family:var(--wp--preset--font-family--poppins)">' . esc_html__( 'View Projects', 'dadecore-theme' ) . '</a></div>
                                  <!-- /wp:button --></div>
                                  <!-- /wp:buttons --></div>
                                  <!-- /wp:group -->',
			)
		);

		// Services Section Pattern
		register_block_pattern(
			'dadecore-theme/services-section',
			array(
				'title'       => __( 'DadeCore Services Section', 'dadecore-theme' ),
				'description' => _x( 'A section with a title, subtitle, and a grid of services.', 'Block pattern description', 'dadecore-theme' ),
				'categories'  => array( 'dadecore-patterns', 'services', 'features' ),
				'keywords'    => array( 'services', 'features', 'grid' ),
				'content'     => '<!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|x-large","bottom":"var:preset|spacing|x-large"}}},"layout":{"type":"constrained"}} -->
                                  <div class="wp-block-group" style="padding-top:var(--wp--preset--spacing--x-large);padding-bottom:var(--wp--preset--spacing--x-large)"><!-- wp:heading {"textAlign":"center"} -->
                                  <h2 class="wp-block-heading has-text-align-center">' . esc_html__( 'Our Services', 'dadecore-theme' ) . '</h2>
                                  <!-- /wp:heading -->

                                  <!-- wp:paragraph {"align":"center","textColor":"light-grey"} -->
                                  <p class="has-text-align-center has-light-grey-color has-text-color">' . esc_html__( 'Digital solutions that boost your business.', 'dadecore-theme' ) . '</p>
                                  <!-- /wp:paragraph -->

                                  <!-- wp:columns {"style":{"spacing":{"margin":{"top":"var:preset|spacing|large"}}}} -->
                                  <div class="wp-block-columns" style="margin-top:var(--wp--preset--spacing--large)"><!-- wp:column -->
                                  <div class="wp-block-column"><!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|medium","right":"var:preset|spacing|medium","bottom":"var:preset|spacing|medium","left":"var:preset|spacing|medium"}},"border":{"radius":"0.25rem"}},"backgroundColor":"dark-grey","className":"card card-glow"} -->
                                  <div class="wp-block-group card card-glow has-dark-grey-background-color has-background" style="border-radius:0.25rem;padding-top:var(--wp--preset--spacing--medium);padding-right:var(--wp--preset--spacing--medium);padding-bottom:var(--wp--preset--spacing--medium);padding-left:var(--wp--preset--spacing--medium)"><!-- wp:heading {"level":3,"textColor":"accent"} -->
                                  <h3 class="wp-block-heading has-accent-color has-text-color">' . esc_html__( 'Custom Web Development', 'dadecore-theme' ) . '</h3>
                                  <!-- /wp:heading -->

                                  <!-- wp:paragraph {"textColor":"contrast"} -->
                                  <p class="has-contrast-color has-text-color">' . esc_html__( 'We design and build custom websites, optimized for performance and user experience.', 'dadecore-theme' ) . '</p>
                                  <!-- /wp:paragraph --></div>
                                  <!-- /wp:group --></div>
                                  <!-- /wp:column -->

                                  <!-- wp:column -->
                                  <div class="wp-block-column"><!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|medium","right":"var:preset|spacing|medium","bottom":"var:preset|spacing|medium","left":"var:preset|spacing|medium"}},"border":{"radius":"0.25rem"}},"backgroundColor":"dark-grey","className":"card card-glow"} -->
                                  <div class="wp-block-group card card-glow has-dark-grey-background-color has-background" style="border-radius:0.25rem;padding-top:var(--wp--preset--spacing--medium);padding-right:var(--wp--preset--spacing--medium);padding-bottom:var(--wp--preset--spacing--medium);padding-left:var(--wp--preset--spacing--medium)"><!-- wp:heading {"level":3,"textColor":"accent"} -->
                                  <h3 class="wp-block-heading has-accent-color has-text-color">' . esc_html__( 'E-commerce Solutions', 'dadecore-theme' ) . '</h3>
                                  <!-- /wp:heading -->

                                  <!-- wp:paragraph {"textColor":"contrast"} -->
                                  <p class="has-contrast-color has-text-color">' . esc_html__( 'Create your powerful and scalable online store to sell your products or services effectively.', 'dadecore-theme' ) . '</p>
                                  <!-- /wp:paragraph --></div>
                                  <!-- /wp:group --></div>
                                  <!-- /wp:column -->

                                  <!-- wp:column -->
                                  <div class="wp-block-column"><!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|medium","right":"var:preset|spacing|medium","bottom":"var:preset|spacing|medium","left":"var:preset|spacing|medium"}},"border":{"radius":"0.25rem"}},"backgroundColor":"dark-grey","className":"card card-glow"} -->
                                  <div class="wp-block-group card card-glow has-dark-grey-background-color has-background" style="border-radius:0.25rem;padding-top:var(--wp--preset--spacing--medium);padding-right:var(--wp--preset--spacing--medium);padding-bottom:var(--wp--preset--spacing--medium);padding-left:var(--wp--preset--spacing--medium)"><!-- wp:heading {"level":3,"textColor":"accent"} -->
                                  <h3 class="wp-block-heading has-accent-color has-text-color">' . esc_html__( 'Monetizable Blog & Content', 'dadecore-theme' ) . '</h3>
                                  <!-- /wp:heading -->

                                  <!-- wp:paragraph {"textColor":"contrast"} -->
                                  <p class="has-contrast-color has-text-color">' . esc_html__( 'We develop blogs ready for monetization with AdSense and Amazon, with content strategies.', 'dadecore-theme' ) . '</p>
                                  <!-- /wp:paragraph --></div>
                                  <!-- /wp:group --></div>
                                  <!-- /wp:column --></div>
                                  <!-- /wp:columns --></div>
                                  <!-- /wp:group -->',
			)
		);

		// Portfolio Section Pattern
		register_block_pattern(
			'dadecore-theme/portfolio-section',
			array(
				'title'       => __( 'DadeCore Portfolio Section', 'dadecore-theme' ),
				'description' => _x( 'A section showcasing recent projects with images and descriptions.', 'Block pattern description', 'dadecore-theme' ),
				'categories'  => array( 'dadecore-patterns', 'portfolio', 'gallery' ),
				'keywords'    => array( 'portfolio', 'projects', 'gallery', 'showcase' ),
				'content'     => '<!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|x-large","bottom":"var:preset|spacing|x-large"}},"elements":{"link":{"color":{"text":"var:preset|color|accent"}}}},"backgroundColor":"base","textColor":"contrast","layout":{"type":"constrained"}} -->
                                  <div class="wp-block-group has-contrast-color has-base-background-color has-text-color has-background has-link-color" style="padding-top:var(--wp--preset--spacing|x-large);padding-bottom:var(--wp--preset--spacing|x-large)"><!-- wp:heading {"textAlign":"center","textColor":"contrast"} -->
                                  <h2 class="wp-block-heading has-text-align-center has-contrast-color has-text-color">' . esc_html__( 'Recent Projects', 'dadecore-theme' ) . '</h2>
                                  <!-- /wp:heading -->

                                  <!-- wp:paragraph {"align":"center","textColor":"light-grey"} -->
                                  <p class="has-text-align-center has-light-grey-color has-text-color">' . esc_html__( 'A look at our work.', 'dadecore-theme' ) . '</p>
                                  <!-- /wp:paragraph -->

                                  <!-- wp:columns {"style":{"spacing":{"margin":{"top":"var:preset|spacing|large"}}}} -->
                                  <div class="wp-block-columns" style="margin-top:var(--wp--preset--spacing--large)"><!-- wp:column -->
                                  <div class="wp-block-column"><!-- wp:image {"id":0,"sizeSlug":"large","linkDestination":"none","className":"card card-glow-border"} -->
                                  <figure class="wp-block-image size-large card card-glow-border"><img src="' . esc_url( get_template_directory_uri() . '/assets/img/placeholder-project1.jpg' ) . '" alt="' . esc_attr__( 'Placeholder Project Image 1', 'dadecore-theme' ) . '"/></figure>
                                  <!-- /wp:image -->
                                  <!-- wp:heading {"level":4,"textColor":"accent"} -->
                                  <h4 class="wp-block-heading has-accent-color has-text-color">' . esc_html__( 'E-commerce Sportswear', 'dadecore-theme' ) . '</h4>
                                  <!-- /wp:heading -->
                                  <!-- wp:paragraph {"textColor":"contrast"} -->
                                  <p class="has-contrast-color has-text-color">' . esc_html__( 'Online sales platform development.', 'dadecore-theme' ) . '</p>
                                  <!-- /wp:paragraph --></div>
                                  <!-- /wp:column -->

                                  <!-- wp:column -->
                                  <div class="wp-block-column"><!-- wp:image {"id":0,"sizeSlug":"large","linkDestination":"none","className":"card card-glow-border"} -->
                                  <figure class="wp-block-image size-large card card-glow-border"><img src="' . esc_url( get_template_directory_uri() . '/assets/img/placeholder-project2.jpg' ) . '" alt="' . esc_attr__( 'Placeholder Project Image 2', 'dadecore-theme' ) . '"/></figure>
                                  <!-- /wp:image -->
                                  <!-- wp:heading {"level":4,"textColor":"accent"} -->
                                  <h4 class="wp-block-heading has-accent-color has-text-color">' . esc_html__( 'Tech & Gadgets Blog', 'dadecore-theme' ) . '</h4>
                                  <!-- /wp:heading -->
                                  <!-- wp:paragraph {"textColor":"contrast"} -->
                                  <p class="has-contrast-color has-text-color">' . esc_html__( 'Optimization for monetization and SEO.', 'dadecore-theme' ) . '</p>
                                  <!-- /wp:paragraph --></div>
                                  <!-- /wp:column -->

                                  <!-- wp:column -->
                                  <div class="wp-block-column"><!-- wp:image {"id":0,"sizeSlug":"large","linkDestination":"none","className":"card card-glow-border"} -->
                                  <figure class="wp-block-image size-large card card-glow-border"><img src="' . esc_url( get_template_directory_uri() . '/assets/img/placeholder-project3.jpg' ) . '" alt="' . esc_attr__( 'Placeholder Project Image 3', 'dadecore-theme' ) . '"/></figure>
                                  <!-- /wp:image -->
                                  <!-- wp:heading {"level":4,"textColor":"accent"} -->
                                  <h4 class="wp-block-heading has-accent-color has-text-color">' . esc_html__( 'Consulting Services Web', 'dadecore-theme' ) . '</h4>
                                  <!-- /wp:heading -->
                                  <!-- wp:paragraph {"textColor":"contrast"} -->
                                  <p class="has-contrast-color has-text-color">' . esc_html__( 'Professional design and lead generation.', 'dadecore-theme' ) . '</p>
                                  <!-- /wp:paragraph --></div>
                                  <!-- /wp:column --></div>
                                  <!-- /wp:columns --></div>
                                  <!-- /wp:group -->',
			)
		);

		// Recent Blog Posts Pattern
		register_block_pattern(
			'dadecore-theme/recent-blog-posts',
			array(
				'title'       => __( 'DadeCore Recent Blog Posts', 'dadecore-theme' ),
				'description' => _x( 'A section displaying the latest blog posts.', 'Block pattern description', 'dadecore-theme' ),
				'categories'  => array( 'dadecore-patterns', 'query', 'posts' ),
				'keywords'    => array( 'blog', 'posts', 'latest', 'query' ),
				'content'     => '<!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|x-large","bottom":"var:preset|spacing|x-large"}}},"layout":{"type":"constrained"}} -->
                                  <div class="wp-block-group" style="padding-top:var(--wp--preset--spacing--x-large);padding-bottom:var(--wp--preset--spacing--x-large)"><!-- wp:heading {"textAlign":"center"} -->
                                  <h2 class="wp-block-heading has-text-align-center">' . esc_html__( 'Latest Blog Posts', 'dadecore-theme' ) . '</h2>
                                  <!-- /wp:heading -->

                                  <!-- wp:paragraph {"align":"center","textColor":"light-grey"} -->
                                  <p class="has-text-align-center has-light-grey-color has-text-color">' . esc_html__( 'Fresh insights and digital trends.', 'dadecore-theme' ) . '</p>
                                  <!-- /wp:paragraph -->

                                  <!-- wp:latest-posts {"postsToShow":3,"displayPostContent":true,"excerptLength":25,"displayFeaturedImage":true,"featuredImageAlign":"left","featuredImageSizeSlug":"medium","addLinkToFeaturedImage":true,"style":{"spacing":{"margin":{"top":"var:preset|spacing|large"}}},"className":"blog-posts-grid"} /--></div>
                                  <!-- /wp:group -->',
			)
		);

		// Register a block pattern category
		register_block_pattern_category(
			'dadecore-patterns',
			array( 'label' => __( 'DadeCore Patterns', 'dadecore-theme' ) )
		);
	}
endif;
add_action( 'init', 'dadecore_register_block_patterns' );

// Potentially add functions to register custom block styles here if needed later.
// function dadecore_register_block_styles() { ... }
// add_action( 'init', 'dadecore_register_block_styles' );

?>
