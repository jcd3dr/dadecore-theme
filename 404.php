<?php
/**
 * Plantilla 404 personalizada para DadeCore Theme
 */

get_header(); ?>

<main id="primary" class="site-main page-404">
    <section class="error-404 not-found">
        <h1><?php esc_html_e( 'Error 404', 'dadecore-theme' ); ?></h1>
        <p><?php esc_html_e( 'Lo sentimos, la página que buscas no existe o ha sido movida.', 'dadecore-theme' ); ?></p>
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn-primary">
            <?php esc_html_e( 'Volver al inicio', 'dadecore-theme' ); ?>
        </a>
    </section>
</main>

<?php get_footer(); ?>
