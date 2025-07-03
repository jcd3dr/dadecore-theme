<?php
/**
 * SEO enhancements for DadeCore Theme.
 * Includes Meta Tags and Schema.org JSON-LD Markup.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Outputs general meta tags.
 */
function dadecore_meta_tags() {
	global $post;
	$site_name = get_bloginfo( 'name' );
	$title = wp_get_document_title(); // Gets the filtered title.
	$description = '';
	$image = '';
	$url = home_url( add_query_arg( null, null ) ); // Current URL
    $og_type = 'website';

	if ( is_singular() && isset($post) ) {
		$description = has_excerpt( $post->ID ) ? get_the_excerpt( $post->ID ) : wp_strip_all_tags( $post->post_content );
		$description = substr( trim( $description ), 0, 155 ); // Trim and limit length
		$image = get_the_post_thumbnail_url( $post->ID, 'large' );
        $url = get_permalink( $post->ID );
        if (is_singular('post')) {
            $og_type = 'article';
        } elseif (is_page()) {
            $og_type = 'object'; // Or 'website' if it's a main page
        }
	} elseif ( is_category() || is_tag() ) {
		$term_description = term_description();
		$description = $term_description ? wp_strip_all_tags( $term_description ) : get_bloginfo( 'description' );
	} else {
		$description = get_bloginfo( 'description' );
	}
    $description = trim( preg_replace( '/\s+/', ' ', $description ) );


	if ( empty( $image ) ) {
        $custom_logo_id = get_theme_mod( 'custom_logo' );
        if ( $custom_logo_id ) {
            $image = wp_get_attachment_image_src( $custom_logo_id , 'full' )[0];
        }
        if ( empty( $image ) ) {
            $image = get_site_icon_url(512, ''); // Fallback to site icon
        }
	}

	// Output Meta Tags
	echo '<meta name="description" content="' . esc_attr( $description ) . '" />' . "\n";
	echo '<link rel="canonical" href="' . esc_url( $url ) . '" />' . "\n";

	// Open Graph
	echo '<meta property="og:title" content="' . esc_attr( $title ) . '" />' . "\n";
	echo '<meta property="og:description" content="' . esc_attr( $description ) . '" />' . "\n";
	echo '<meta property="og:url" content="' . esc_url( $url ) . '" />' . "\n";
	echo '<meta property="og:site_name" content="' . esc_attr( $site_name ) . '" />' . "\n";
    echo '<meta property="og:type" content="' . esc_attr( $og_type ) . '" />' . "\n";
	if ( ! empty( $image ) ) {
		echo '<meta property="og:image" content="' . esc_url( $image ) . '" />' . "\n";
        // Potentially add og:image:width and og:image:height if easily obtainable
	}
    if ( $og_type === 'article' && isset($post)) {
        echo '<meta property="article:published_time" content="' . esc_attr( get_the_date( 'c', $post->ID ) ) . '" />' . "\n";
        echo '<meta property="article:modified_time" content="' . esc_attr( get_the_modified_date( 'c', $post->ID ) ) . '" />' . "\n";
        // TODO: Add article author, section (category)
    }


	// Twitter Card
	echo '<meta name="twitter:card" content="summary_large_image" />' . "\n"; // summary_large_image or summary
	echo '<meta name="twitter:title" content="' . esc_attr( $title ) . '" />' . "\n";
	echo '<meta name="twitter:description" content="' . esc_attr( $description ) . '" />' . "\n";
	if ( ! empty( $image ) ) {
		echo '<meta name="twitter:image" content="' . esc_url( $image ) . '" />' . "\n";
	}
	// Optional: echo '<meta name="twitter:site" content="@tuTwitterHandle" />' . "\n";
	// Optional: echo '<meta name="twitter:creator" content="@autorTwitterHandle" />' . "\n";
}
add_action( 'wp_head', 'dadecore_meta_tags', 1 );


/**
 * Outputs Schema.org JSON-LD.
 */
function dadecore_schema_markup() {
	$schemas = array();
    $site_name = get_bloginfo( 'name' );
    $home_url = home_url('/');
    $logo_url = '';
    $custom_logo_id = get_theme_mod( 'custom_logo' );
    if ( $custom_logo_id ) {
        $logo_src = wp_get_attachment_image_src( $custom_logo_id , 'full' );
        if ($logo_src) {
            $logo_url = $logo_src[0];
        }
    }
    if (empty($logo_url)) {
        $logo_url = get_site_icon_url(192); // Min size for logo in schema
    }


	// Organization Schema (Primarily for Home Page)
	if ( is_front_page() ) {
		$organization_schema = array(
			'@type' => 'Organization',
			'name'  => $site_name,
			'url'   => $home_url,
		);
		if ( ! empty( $logo_url ) ) {
			$organization_schema['logo'] = $logo_url;
		}
        $social_profiles = get_option('dadecore_social_profiles', []);
        $valid_social_urls = array_filter(array_values($social_profiles), function($url){ return !empty($url) && filter_var($url, FILTER_VALIDATE_URL); });
        if (!empty($valid_social_urls)) {
            $organization_schema['sameAs'] = $valid_social_urls;
        }
		// TODO: Add contactPoint if contact page exists or details are in theme options.
		$schemas[] = $organization_schema;


        // WebSite Schema (Primarily for Home Page)
        $website_schema = array(
            '@type' => 'WebSite',
            'url' => $home_url,
            'name' => $site_name,
            'potentialAction' => array(
                '@type' => 'SearchAction',
                'target' => home_url( '/?s={search_term_string}' ),
                'query-input' => 'required name=search_term_string',
            ),
        );
        $description = get_bloginfo( 'description' );
        if ( ! empty( $description ) ) {
            $website_schema['description'] = $description;
        }
        $schemas[] = $website_schema;
	}


	// Article/BlogPosting Schema
	if ( is_singular( 'post' ) ) {
		global $post;
		$article_schema = array(
			'@type'            => 'Article', // Or BlogPosting
			'mainEntityOfPage' => array(
				'@type' => 'WebPage',
				'@id'   => get_permalink( $post->ID ),
			),
			'headline'         => get_the_title( $post->ID ),
			'description'      => wp_strip_all_tags(has_excerpt( $post->ID ) ? get_the_excerpt( $post->ID ) : substr( $post->post_content, 0, 250) ),
			'datePublished'    => get_the_date( 'c', $post->ID ),
			'dateModified'     => get_the_modified_date( 'c', $post->ID ),
			'author'           => array(
				'@type' => 'Person',
				'name'  => get_the_author_meta( 'display_name', $post->post_author ),
                // Optional: 'url' => get_author_posts_url($post->post_author)
			),
			'publisher'        => array(
				'@type' => 'Organization',
				'name'  => $site_name,
				'logo'  => array(
					'@type' => 'ImageObject',
					'url'   => $logo_url ? $logo_url : get_site_icon_url(192), // Ensure logo URL
				),
			),
		);
		$image_url = get_the_post_thumbnail_url( $post->ID, 'large' );
		if ( $image_url ) {
			$article_schema['image'] = array(
                '@type' => 'ImageObject',
                'url' => $image_url,
                // TODO: Add width & height if easily obtainable
            );
		}
		$schemas[] = $article_schema;
	}
    // WebPage Schema (for generic pages)
    elseif ( is_page() && !is_front_page() ) { // Exclude front page if it already has Organization/WebSite
        global $post;
        $webpage_schema = array(
            '@type' => 'WebPage',
            'url' => get_permalink($post->ID),
            'name' => get_the_title($post->ID),
            'description' => wp_strip_all_tags(has_excerpt( $post->ID ) ? get_the_excerpt( $post->ID ) : substr( $post->post_content, 0, 250) ),
            // Potentially 'isPartOf' to link to WebSite schema
        );
        // TODO: Add 'Service' schema if this page is identified as a service page.
        // Example for Service:
        // if (is_page_template('template-service.php') || get_post_meta($post->ID, '_is_service_page', true)) {
        //     $service_schema = array(
        //         '@type' => 'Service',
        //         'name' => get_the_title($post->ID),
        //         'description' => get_the_excerpt($post->ID),
        //         'provider' => array('@type' => 'Organization', 'name' => $site_name),
        //         // Add more service-specific properties: serviceType, areaServed, etc.
        //     );
        //     $schemas[] = $service_schema;
        // }
        $schemas[] = $webpage_schema;
    }


	if ( empty( $schemas ) ) {
		return;
	}

	echo '<script type="application/ld+json" class="dadecore-schema-graph">' . "\n";
	echo wp_json_encode( count($schemas) === 1 ? $schemas[0] : array('@context' => 'https://schema.org', '@graph' => $schemas), JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT ) . "\n";
	echo '</script>' . "\n";
}
add_action( 'wp_head', 'dadecore_schema_markup', 20 );

?>
