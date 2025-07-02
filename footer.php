    </div><!-- #content -->

<footer id="colophon" class="site-footer"><!-- SOLUCIÓN FOOTER: Ahora el footer queda dentro de #page -->
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
</body>
</html>