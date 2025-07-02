<?php
/**
 * Basic SEO enhancements.
 */

function dadecore_meta_tags() {
    if ( is_singular() ) {
        global $post;
        $description = has_excerpt( $post->ID ) ? get_the_excerpt() : get_bloginfo( 'description' );
        $image = get_the_post_thumbnail_url( $post->ID, 'large' );
    } else {
        $description = get_bloginfo( 'description' );
        $image = get_site_icon_url();
    }
    $description = wp_strip_all_tags( $description );
    echo '<meta name="description" content="' . esc_attr( $description ) . '" />';
    if ( $image ) {
        echo '<meta property="og:image" content="' . esc_url( $image ) . '" />';
    }
    echo '<link rel="canonical" href="' . esc_url( get_permalink() ) . '" />';
}
add_action( 'wp_head', 'dadecore_meta_tags', 1 );

function dadecore_schema_markup() {
    $schema = array(
        '@context' => 'https://schema.org',
        '@type'    => is_singular( 'post' ) ? 'Article' : 'Organization',
        'name'     => get_bloginfo( 'name' ),
        'url'      => home_url(),
    );
    echo '<script type="application/ld+json">' . wp_json_encode( $schema ) . '</script>';
}
add_action( 'wp_head', 'dadecore_schema_markup', 20 );
