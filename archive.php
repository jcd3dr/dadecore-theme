<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package DadeCore_Theme
 */

get_header();
$blog_view   = get_theme_mod( 'dadecore_blog_view', 'grid' );
$show_sidebar = get_theme_mod( 'dadecore_blog_sidebar', true );
?>

<div class="site-main-wrapper container section-padding">
    <main id="primary" class="site-main content-area">
        <header class="page-header">
            <?php
            the_archive_title( '<h1 class="page-title section-title">', '</h1>' );
            the_archive_description( '<div class="archive-description section-subtitle">', '</div>' );
            ?>
        </header><!-- .page-header -->

        <div class="blog-posts-grid <?php echo ( 'list' === $blog_view ) ? 'blog-posts-list' : ''; ?>">
            <?php
            if ( have_posts() ) :
                /* Start the Loop */
                while ( have_posts() ) :
                    the_post();
                    global $wp_query;
            ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class( 'blog-post-item card card-glow' ); ?>>
                        <?php if ( has_post_thumbnail() ) : ?>
                            <div class="post-thumbnail">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail( 'medium' ); // Consider 'dadecore_card_thumbnail' ?>
                                </a>
                            </div>
                        <?php else : ?>
                            <div class="post-thumbnail">
                                <a href="<?php the_permalink(); ?>">
                                    <img src="<?php echo esc_url( dadecore_get_fallback_image_url() ); ?>" alt="<?php the_title_attribute(); ?>" />
                                </a>
                            </div>
                        <?php endif; ?>
                        <header class="entry-header">
                            <?php the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' ); ?>
                        </header>
                        <div class="entry-summary">
                            <?php the_excerpt(); ?>
                        </div>
                        <footer class="entry-footer">
                            <a href="<?php the_permalink(); ?>" class="read-more-btn"><?php esc_html_e( 'Read More &rarr;', 'dadecore-theme' ); ?></a>
                        </footer>
                    </article>
            <?php
                    // Show in-feed ad
                    if ( function_exists( 'dadecore_maybe_show_infeed_ad' ) ) {
                        dadecore_maybe_show_infeed_ad( $wp_query->current_post, $wp_query->post_count );
                    }
                endwhile;

                // Paginación
                the_posts_pagination( array(
                    'prev_text'          => esc_html__( '&laquo; Previous Posts', 'dadecore-theme' ),
                    'next_text'          => esc_html__( 'Next &raquo;', 'dadecore-theme' ),
                    'before_page_number' => '<span class="meta-nav screen-reader-text">' . esc_html__( 'Page', 'dadecore-theme' ) . ' </span>',
                ) );

            else :
                 // Si no hay contenido, podríamos incluir una plantilla para "nada encontrado"
                get_template_part( 'template-parts/content', 'none' );
            endif;
            ?>
        </div><!-- .blog-posts-grid -->
    </main><!-- #primary .content-area -->

    <?php if ( $show_sidebar ) { get_sidebar(); } ?>

</div><!-- .site-main-wrapper -->
<?php
get_footer();
?>
