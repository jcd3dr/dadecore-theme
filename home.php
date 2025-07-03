<?php
/**
 * The blog archive template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
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
    <div class="content-with-sidebar">
        <main id="primary" class="site-main content-area">
            <div class="blog-archive-container">
            <header class="page-header">
                <h1 class="page-title section-title"><?php single_post_title(); ?></h1>
                <p class="section-subtitle">Explora nuestras últimas publicaciones y recursos.</p>
            </header>
            <div class="blog-posts-grid <?php echo ( 'list' === $blog_view ) ? 'blog-posts-list' : ''; ?>">
                <?php
                if ( have_posts() ) :
                    /* Start the Loop */
                    while ( have_posts() ) :
                        the_post(); // Configura los datos del post actual
                ?>
                        <article id="post-<?php the_ID(); ?>" <?php post_class( 'blog-post-item card card-glow' ); ?>>
                            <?php if ( has_post_thumbnail() ) : ?>
                                <div class="post-thumbnail">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_post_thumbnail( 'medium' ); ?>
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
                                <a href="<?php the_permalink(); ?>" class="read-more-btn">Leer Más →</a>
                            </footer>
                        </article>
                <?php
                    endwhile;

                    // Paginación
                    the_posts_pagination( array(
                        'prev_text'          => esc_html__( '« Anterior', 'dadecore-theme' ),
                        'next_text'          => esc_html__( 'Siguiente »', 'dadecore-theme' ),
                        'before_page_number' => '<span class="meta-nav screen-reader-text">' . esc_html__( 'Página', 'dadecore-theme' ) . ' </span>',
                    ) );

                else :
                    get_template_part( 'template-parts/content', 'none' );
                endif;
                ?>
            </div><!-- .blog-posts-grid -->
            </div><!-- .blog-archive-container -->
        </main><!-- #primary -->

        <?php if ( $show_sidebar ) { get_sidebar(); } ?>
    </div>
</div>

<?php get_footer();
