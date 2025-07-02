    </div> <!-- Cierra #content -->

    <!-- Pie de página -->
    <footer id="colophon" class="site-footer">
        <div class="site-info">
            <a href="<?php echo esc_url( __( 'https://wordpress.org/', 'dadecore-theme' ) ); ?>">
                <?php printf( esc_html__( 'Orgullosamente impulsado por %s', 'dadecore-theme' ), 'WordPress' ); ?>
            </a>
            <span class="sep"> | </span>
            <?php printf( esc_html__( 'Tema: %1$s por %2$s.', 'dadecore-theme' ), 'DadeCore Theme', '<a href="https://dadecore.com/">DadeCore Bizz LLC</a>' ); ?>
        </div>
    </footer><!-- #colophon -->

    <?php wp_footer(); ?>
</body>
</html>
