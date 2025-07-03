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

<!-- Layout principal del sitio (Flex vertical) -->
<div id="page">
    <?php
    $logo_pos   = get_theme_mod( 'dadecore_logo_position', 'left' );
    $nav_align  = get_theme_mod( 'dadecore_nav_alignment', 'right' );
    $sticky     = get_theme_mod( 'dadecore_enable_sticky_header', true );
    $header_cls = 'site-header';
    $header_cls .= $sticky ? '' : ' no-sticky';
    $header_cls .= ' logo-' . $logo_pos . ' nav-' . $nav_align;
    ?>
    <header id="masthead" class="<?php echo esc_attr( $header_cls ); ?>">
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

            <?php $dadecore_theme_description = get_bloginfo( 'description', 'display' );
            if ( $dadecore_theme_description || is_customize_preview() ) : ?>
                <p class="site-description"><?php echo $dadecore_theme_description; ?></p>
            <?php endif; ?>
        </div>

        <nav id="site-navigation" class="main-navigation">
            <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
                <?php esc_html_e( 'Menu', 'dadecore-theme' ); ?>
            </button>
            <?php
            wp_nav_menu( array(
                'theme_location' => 'primary_menu',
                'menu_id'        => 'primary-menu',
                'container'      => 'div',
                'container_class'=> 'primary-menu-container',
            ) );
            ?>
        </nav>
        <?php if ( function_exists( 'dadecore_has_social_links' ) && dadecore_has_social_links() ) : ?>
            <div class="header-social-links">
                <?php dadecore_output_social_links(); ?>
            </div>
        <?php endif; ?>
    </header>
    <?php
    if ( is_active_sidebar( 'ads-header' ) ) : ?>
        <div class="container ads-header-area">
            <?php dynamic_sidebar( 'ads-header' ); ?>
        </div>
    <?php endif; ?>

<!-- Contenedor principal del contenido -->
<main id="content" class="site-content">
