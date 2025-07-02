<?php get_header(); ?>

<section class="error-404 not-found" style="text-align: center; padding: 80px 20px;">
    <header class="page-header">
        <h1 class="page-title">Error 404</h1>
    </header>

    <div class="page-content">
        <p>Lo sentimos, la página que buscas no existe o ha sido movida.</p>
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn-primary">Volver al inicio</a>
    </div>
</section>

<?php get_footer(); ?>
