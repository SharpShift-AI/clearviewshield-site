<?php
/**
 * The template for displaying search results pages
 *
 * @package ClearViewShield
 */

get_header();
?>

<main id="primary" class="site-main search-results">
    <div class="container">
        <header class="page-header">
            <h1 class="page-title">
                <?php
                /* translators: %s: search query. */
                printf( esc_html__( 'Search Results for: %s', 'clearviewshield' ), '<span>' . get_search_query() . '</span>' );
                ?>
            </h1>
        </header><!-- .page-header -->

        <?php if ( have_posts() ) : ?>
            <div class="search-results-container">
                <?php
                /* Start the Loop */
                while ( have_posts() ) :
                    the_post();
                    ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class('search-result-item'); ?>>
                        <header class="entry-header">
                            <?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

                            <?php if ( 'post' === get_post_type() ) : ?>
                            <div class="entry-meta">
                                <?php
                                clearviewshield_posted_on();
                                clearviewshield_posted_by();
                                ?>
                            </div><!-- .entry-meta -->
                            <?php endif; ?>
                        </header><!-- .entry-header -->

                        <?php clearviewshield_post_thumbnail(); ?>

                        <div class="entry-summary">
                            <?php the_excerpt(); ?>
                        </div><!-- .entry-summary -->

                        <footer class="entry-footer">
                            <a href="<?php the_permalink(); ?>" class="read-more">Read More <i class="fas fa-arrow-right"></i></a>
                        </footer><!-- .entry-footer -->
                    </article><!-- #post-<?php the_ID(); ?> -->
                <?php
                endwhile;

                the_posts_navigation();
                ?>
            </div>
        <?php else : ?>
            <div class="no-results">
                <p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'clearviewshield' ); ?></p>
                <?php get_search_form(); ?>
                
                <div class="search-cta">
                    <h2>Looking for Windshield Repair in Cedar Rapids?</h2>
                    <p>We offer mobile windshield repair throughout Cedar Rapids, Marion, Hiawatha, and Linn County.</p>
                    
                    <div class="cta-buttons">
                        <?php clearviewshield_cta_button('Book Online', home_url('/booking')); ?>
                        <?php clearviewshield_phone_button('Call/Text 319-775-0717'); ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</main><!-- #main -->

<?php
get_sidebar();
get_footer();
