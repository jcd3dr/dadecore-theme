<?php
/**
 * The template for displaying 404 pages (Not Found)
 * @package DadeCore Theme
 */

get_header(); ?>

<!-- ✅ SOLUCIÓN DEL ERROR: estructura con clase container y padding -->
<div class="container section-padding text-light">
    <div class="not-found-content" style="text-align: center; max-width: 800px; margin: 0 auto;">
        <h1 class="section-title">Página no encontrada</h1>
        <p class="section-subtitle">Lo sentimos, la página que estás buscando no existe o ha sido movida.</p>

        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn-primary">
            Volver al inicio
        </a>
    </div>
</div>

<?php
get_footer();
