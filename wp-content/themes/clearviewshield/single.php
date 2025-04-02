<?php
/**
 * The template for displaying all single posts
 *
 * @package ClearViewShield
 */

get_header();
?>

<main id="primary" class="site-main">
    <div class="container">
        <?php
        while ( have_posts() ) :
            the_post();
            ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <header class="entry-header">
                    <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
                    <div class="entry-meta">
                        <?php
                        clearviewshield_posted_on();
                        clearviewshield_posted_by();
                        ?>
                    </div><!-- .entry-meta -->
                </header><!-- .entry-header -->

                <?php clearviewshield_post_thumbnail(); ?>

                <div class="entry-content">
                    <?php
                    the_content();

                    wp_link_pages(
                        array(
                            'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'clearviewshield' ),
                            'after'  => '</div>',
                        )
                    );
                    ?>
                </div><!-- .entry-content -->

                <footer class="entry-footer">
                    <?php clearviewshield_entry_footer(); ?>
                    <?php clearviewshield_social_sharing(); ?>
                    
                    <div class="post-cta">
                        <h3>Need Windshield Repair in Cedar Rapids?</h3>
                        <p>Book your mobile repair today - just $75 with our lifetime warranty!</p>
                        <div class="cta-buttons">
                            <?php clearviewshield_cta_button(); ?>
                            <?php clearviewshield_phone_button(); ?>
                        </div>
                    </div>
                </footer><!-- .entry-footer -->
            </article><!-- #post-<?php the_ID(); ?> -->

            <?php
            // If comments are open or we have at least one comment, load up the comment template.
            if ( comments_open() || get_comments_number() ) :
                comments_template();
            endif;

            the_post_navigation(
                array(
                    'prev_text' => '<span class="nav-subtitle">' . esc_html__( 'Previous:', 'clearviewshield' ) . '</span> <span class="nav-title">%title</span>',
                    'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Next:', 'clearviewshield' ) . '</span> <span class="nav-title">%title</span>',
                )
            );
        endwhile; // End of the loop.
        ?>
    </div>
</main><!-- #main -->

<?php
get_sidebar();
get_footer();
