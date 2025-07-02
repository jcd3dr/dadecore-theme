<?php
/**
 * The template for displaying 404 pages (Not Found)
 * @package DadeCore Theme
 */

get_header(); ?>

<!-- ✅ SOLUCIÓN DEL ERROR: estructura con clase container y padding -->
<main id="main" class="site-main" style="min-height: 80vh; display: flex; align-items: center; justify-content: center;">
    <section class="error-404 not-found" style="text-align:center; padding: 60px 20px;">
        <h1 style="font-size: 3rem; color: #00e6c3;"><?php esc_html_e( 'Error 404', 'dadecore-theme' ); ?></h1>
        <p style="font-size: 1.2rem; margin: 20px 0; color: #ccc;"><?php esc_html_e( 'Lo sentimos, la página que buscas no existe o ha sido movida.', 'dadecore-theme' ); ?></p>
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" 
           style="display: inline-block; margin-top: 20px; padding: 12px 28px; background-color: #00e6c3; color: #000; font-weight: bold; text-decoration: none; border-radius: 8px;">
            <?php esc_html_e( 'Volver al inicio', 'dadecore-theme' ); ?>
        </a>
    </section>
</main>

<?php get_footer();
