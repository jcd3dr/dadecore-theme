    </div>
</div>
<footer id="colophon" class="site-footer" style="background-color: #111; padding: 40px 20px; text-align: center; color: #00e6c3;">
        <div class="site-info">
            <a href="<?php echo esc_url( __( 'https://dadecore.com/', 'dadecore-theme' ) ); ?>">
                <?php
                /* translators: %s: CMS name, i.e. WordPress. */
                printf( esc_html__( 'Proudly powered by %s', 'dadecore-theme' ), 'Dadecore.com' ); ?>
            </a>
            <span class="sep"> | </span>
            <?php
            /* translators: 1: Theme name, 2: Theme author. */
            printf( esc_html__( 'Theme: %1$s by %2$s.', 'dadecore-theme' ), 'DadeCore Theme', '<a href="https://www.dadecore.com/">DadeCore Bizz LLC</a>' );
            ?>
        </div></footer></div><?php wp_footer(); ?>

</body>
</html>
