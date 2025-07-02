<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<?php wp_body_open(); ?>

<!-- Enlace accesible para saltar al contenido -->
<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Saltar al contenido', 'dadecore-theme' ); ?></a>

<!-- Cabecera del sitio -->
<header id="masthead" class="site-header">
    <div class="site-branding">
        <?php if ( is_front_page() && is_home() ) : ?>
            <h1 class="site-title">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
            </h1>
        <?php else : ?>
            <p class="site-title">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
            </p>
        <?php endif; ?>

        <?php $description = get_bloginfo( 'description', 'display' ); ?>
        <?php if ( $description || is_customize_preview() ) : ?>
            <p class="site-description"><?php echo esc_html( $description ); ?></p>
        <?php endif; ?>
    </div>

    <!-- Menú de navegación -->
    <nav id="site-navigation" class="main-navigation">
        <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
            <?php esc_html_e( 'Menú', 'dadecore-theme' ); ?>
        </button>
        <?php
        wp_nav_menu( array(
            'theme_location'  => 'primary_menu',
            'menu_id'         => 'primary-menu',
            'container'       => 'div',
            'container_class' => 'primary-menu-container',
        ) );
        ?>
    </nav>
</header>

<!-- Contenedor principal del contenido -->
<div id="content" class="site-content site-wrapper">
