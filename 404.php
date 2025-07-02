<?php
/**
 * Plantilla 404 personalizada para DadeCore Theme
 */

get_header(); ?>

<main id="main" class="site-main">
    <section class="error-404 not-found" style="text-align:center; padding: 60px 20px;">
        <h1><?php esc_html_e( 'Página no encontrada', 'dadecore-theme' ); ?></h1>
        <p><?php esc_html_e( 'Lo sentimos, la página que buscas no existe o ha sido movida.', 'dadecore-theme' ); ?></p>
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="button"><?php esc_html_e( 'Volver al inicio', 'dadecore-theme' ); ?></a>
    </section>
</main>

<?php get_footer(); ?>