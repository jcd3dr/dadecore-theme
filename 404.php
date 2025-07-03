<?php
/**
 * The template for displaying 404 pages (Not Found)
 * @package DadeCore Theme
 */

get_header();

$sidebar_position = get_theme_mod( 'dadecore_404_sidebar_position', 'right' );
?>

<div class="site-main-wrapper container section-padding sidebar-<?php echo esc_attr( $sidebar_position ); ?>">
    <main id="main" class="site-main" style="min-height: 80vh; display: flex; align-items: center; justify-content: center;">
        <div class="dadecore-404-wrapper" style="text-align:center; padding: 60px 20px;">
        <section class="error-404 not-found">
        
            <h1 style="font-size: 3rem; color: var(--color-accent);">
                <?php echo esc_html( get_theme_mod( 'dadecore_404_custom_title', __( 'Error 404', 'dadecore-theme' ) ) ); ?>
            </h1>

            <p style="font-size: 1.2rem; margin: 20px 0; color: #ccc;">
                <?php echo esc_html( get_theme_mod( 'dadecore_404_custom_message', __( 'Lo sentimos, la página que buscas no existe o ha sido movida.', 'dadecore-theme' ) ) ); ?>
            </p>

        <!-- Formulario de búsqueda -->
        <div style="max-width: 400px; margin: 0 auto 30px;">
            <?php get_search_form(); ?>
        </div>

        <!-- Botón de regreso al inicio -->
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>"
           style="display: inline-block; margin-top: 30px; padding: 12px 28px; background-color: var(--color-accent); color: #000; font-weight: bold; text-decoration: none; border-radius: 8px;">
            <?php esc_html_e( 'Volver al inicio', 'dadecore-theme' ); ?>
        </a>

    </section>
        </div>
    </main>

    <?php if ( get_theme_mod( 'dadecore_404_show_sidebar', true ) && is_active_sidebar( '404-sidebar' ) ) : ?>
        <aside class="widget-area" style="margin-top: 40px;">
            <?php dynamic_sidebar( '404-sidebar' ); ?>
        </aside>
    <?php endif; ?>
</div>

<?php get_footer();
