    </main> <!-- #content -->

    <footer id="colophon" class="site-footer">
        <?php if ( get_theme_mod( 'dadecore_footer_show_widgets', true ) && ( is_active_sidebar( 'footer-1' ) || is_active_sidebar( 'footer-2' ) || is_active_sidebar( 'footer-3' ) ) ) : ?>
            <div class="footer-widgets-area">
                <div class="container">
                    <div class="footer-widgets-grid">
                        <?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
                            <div class="footer-widget-column">
                                <?php dynamic_sidebar( 'footer-1' ); ?>
                            </div>
                        <?php endif; ?>
                        <?php if ( is_active_sidebar( 'footer-2' ) ) : ?>
                            <div class="footer-widget-column">
                                <?php dynamic_sidebar( 'footer-2' ); ?>
                            </div>
                        <?php endif; ?>
                        <?php if ( is_active_sidebar( 'footer-3' ) ) : ?>
                            <div class="footer-widget-column">
                                <?php dynamic_sidebar( 'footer-3' ); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <div class="site-info">
            <div class="container">
                <a href="<?php echo esc_url( __( 'https://wordpress.org/', 'dadecore-theme' ) ); ?>">
                    <?php printf( esc_html__( 'Proudly powered by %s', 'dadecore-theme' ), 'WordPress' ); ?>
                </a>
                <span class="sep"> | </span>
                <?php
                printf(
                    esc_html__( 'Theme: %1$s by %2$s.', 'dadecore-theme' ),
                    'DadeCore Theme',
                    '<a href="https://www.dadecore.com/">DadeCore Bizz LLC</a>'
                );
                ?>
                <p>&copy; <?php echo date_i18n( 'Y' ); ?> <?php bloginfo( 'name' ); ?>. <?php esc_html_e( 'All rights reserved.', 'dadecore-theme' ); ?></p>
                <?php if ( get_theme_mod( 'dadecore_footer_custom_text' ) ) : ?>
                    <p class="custom-footer-text"><?php echo wp_kses_post( get_theme_mod( 'dadecore_footer_custom_text' ) ); ?></p>
                <?php endif; ?>
                <?php if ( function_exists( 'dadecore_has_social_links' ) && dadecore_has_social_links() ) : ?>
                    <div class="footer-social-links">
                        <?php dadecore_output_social_links(); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div><!-- .site-info -->
    </footer><!-- #colophon -->

</div><!-- #page -->

<?php wp_footer(); ?>
</body>
</html>
