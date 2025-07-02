        </div><!-- #content -->

        <!-- 🔧 Solución del error: cerramos correctamente #page -->
    </div><!-- #page -->

    <footer id="colophon" class="site-footer">
        <div class="site-info">
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
        </div>
    </footer>
    <?php wp_footer(); ?>
</body>
</html>
