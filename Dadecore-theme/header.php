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

    <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'dadecore-theme' ); ?></a>

    <header id="masthead" class="site-header">
        <div class="site-branding">
            <?php
            // Lógica para el logo (texto o imagen)
            if ( is_front_page() && is_home() ) :
                ?>
                <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
                <?php
            else :
                ?>
                <p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
                <?php
            endif;
            $dadecore_theme_description = get_bloginfo( 'description', 'display' );
            if ( $dadecore_theme_description || is_customize_preview() ) :
                ?>
                <p class="site-description"><?php echo $dadecore_theme_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
            <?php endif; ?>        </div>
        <nav id="site-navigation" class="main-navigation">
            <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Menu', 'dadecore-theme' ); ?></button>
            <?php
            wp_nav_menu( array(
                'theme_location' => 'primary_menu',
                'menu_id'        => 'primary-menu',
                'container'      => 'div',
                'container_class'=> 'primary-menu-container',
            ) );
            ?>
        </nav>
        </header>
        <div id="content" class="site-content">
