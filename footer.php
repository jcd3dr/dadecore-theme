    </main><!-- #content -->

<footer id="colophon" class="site-footer"><!-- SOLUCIÓN FOOTER: Ahora el footer queda dentro de #page -->
    <div class="site-info">
        <a href="<?php echo esc_url( __( 'https://dadecore.com', 'dadecore-theme' ) ); ?>">
            <?php printf( esc_html__( 'Proudly powered by %s', 'dadecore-theme' ), 'DadeCore Bizz LLC' ); ?>
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
<!-- SOLUCIÓN FOOTER: cerramos #page después del footer para el layout flex -->
</div><!-- #page -->
<?php wp_footer(); ?>
</body>
</html>
