<?php
/**
 * The front page template file.
 *
 * This template is used for the site's front page, whether it's set to display
 * a static page or the latest blog posts. It prioritizes content from the
 * WordPress editor.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#front-page-display
 *
 * @package DadeCore_Theme
 */

get_header();
?>

<main id="primary" class="site-main">
    <?php
    // Start the Loop.
    while ( have_posts() ) :
        the_post();

        // Display page content from the editor.
        // If you want to add specific sections above or below the editor content,
        // you can do so here, or encourage users to use Block Patterns.
        get_template_part( 'template-parts/content', 'page' );

        // If comments are open or there is at least one comment, load the comment template.
        // (Typically not used on a front page, but included for completeness if needed)
        if ( comments_open() || get_comments_number() ) {
            comments_template();
        }

    endwhile; // End of the loop.
    ?>
</main><!-- #primary -->

<?php
// Not including get_sidebar() by default on front-page,
// as it's often a full-width design.
// It can be added if a sidebar is desired for the front page.
get_footer();
