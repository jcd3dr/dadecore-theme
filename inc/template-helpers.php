<?php
/**
 * Template helper functions for DadeCore Theme.
 *
 * @package DadeCore_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Maybe displays an in-feed ad within the loop.
 *
 * Call this function inside the WordPress loop.
 * Example: dadecore_maybe_show_infeed_ad( $wp_query->current_post, $wp_query->post_count );
 *
 * @param int $current_post_index The index of the current post in the loop (0-indexed).
 * @param int $total_posts The total number of posts in the current query.
 */
function dadecore_maybe_show_infeed_ad( $current_post_index, $total_posts ) {
    // Ad positions: after the 2nd post, and then after every 5 posts (e.g., post 2, 7, 12...)
    // We use 0-indexed $current_post_index. So, after post with index 1 (2nd post), index 6 (7th post) etc.
    $first_ad_position = 1; // Show after the post with index 1 (2nd post)
    $repeat_interval = 5;   // Show every 5 posts thereafter

    // Don't show ad if it's the last post
    if ( $current_post_index === ( $total_posts - 1 ) ) {
        return;
    }

    $show_ad = false;
    if ( $current_post_index === $first_ad_position ) {
        $show_ad = true;
    } elseif ( $current_post_index > $first_ad_position && ( ( $current_post_index - $first_ad_position ) % $repeat_interval === 0 ) ) {
        $show_ad = true;
    }

	if ( $show_ad && is_active_sidebar( 'ads-infeed' ) ) {
		echo '<article class="blog-post-item post-ad ads-infeed-area">'; // Use similar wrapper as other posts for styling
		dynamic_sidebar( 'ads-infeed' );
		echo '</article>';
	}
}

/**
 * Function to get placeholder image if no featured image.
 * Example: <img src="<?php echo esc_url( dadecore_get_fallback_image_url() ); ?>" alt="">
 *
 * @return string URL of the placeholder image.
 */
function dadecore_get_fallback_image_url() {
    // Consider adding an option in theme settings for this placeholder
    return get_template_directory_uri() . '/assets/img/placeholder-project1.jpg'; // Re-use an existing placeholder
}

/**
 * Return an array of social links defined in the Customizer.
 */
function dadecore_get_social_links() {
    $networks = array( 'facebook', 'twitter', 'instagram', 'linkedin', 'github' );
    $links    = array();
    foreach ( $networks as $network ) {
        $url = get_theme_mod( 'dadecore_social_' . $network );
        if ( $url ) {
            $links[ $network ] = esc_url( $url );
        }
    }
    return $links;
}

/**
 * Echo list of social links.
 */
function dadecore_output_social_links() {
    $links = dadecore_get_social_links();
    if ( empty( $links ) ) {
        return;
    }
    echo '<ul class="social-links-list">';
    foreach ( $links as $network => $url ) {
        echo '<li class="social-link social-' . esc_attr( $network ) . '"><a href="' . esc_url( $url ) . '" target="_blank" rel="nofollow"><span class="dashicons dashicons-' . esc_attr( $network ) . '"></span></a></li>';
    }
    echo '</ul>';
}

/**
 * Custom excerpt length based on Customizer setting.
 */
function dadecore_custom_excerpt_length( $length ) {
    $custom = get_theme_mod( 'dadecore_blog_excerpt_length', 20 );
    return absint( $custom );
}
add_filter( 'excerpt_length', 'dadecore_custom_excerpt_length' );

/**
 * Helper to check if any social link exists.
 */
function dadecore_has_social_links() {
    $links = dadecore_get_social_links();
    return ! empty( $links );
}

?>
