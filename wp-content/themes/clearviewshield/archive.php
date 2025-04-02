<?php
/**
 * The template for displaying archive pages
 *
 * @package ClearViewShield
 */

get_header();
?>

<main id="primary" class="site-main">
    <div class="container">
        <header class="page-header">
            <?php
            the_archive_title( '<h1 class="page-title">', '</h1>' );
            the_archive_description( '<div class="archive-description">', '</div>' );
            ?>
        </header><!-- .page-header -->

        <?php if ( have_posts() ) : ?>
            <div class="archive-posts">
                <?php
                /* Start the Loop */
                while ( have_posts() ) :
                    the_post();
                    ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class('archive-post'); ?>>
                        <?php if (has_post_thumbnail()) : ?>
                            <div class="post-thumbnail">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail('medium'); ?>
                                </a>
                            </div>
                        <?php endif; ?>
                        
                        <div class="post-content">
                            <header class="entry-header">
                                <?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>

                                <div class="entry-meta">
                                    <?php
                                    clearviewshield_posted_on();
                                    clearviewshield_posted_by();
                                    ?>
                                </div><!-- .entry-meta -->
                            </header><!-- .entry-header -->

                            <div class="entry-summary">
                                <?php the_excerpt(); ?>
                                <a href="<?php the_permalink(); ?>" class="read-more">Read More <i class="fas fa-arrow-right"></i></a>
                            </div><!-- .entry-summary -->
                        </div>
                    </article><!-- #post-<?php the_ID(); ?> -->
                <?php
                endwhile;

                the_posts_navigation();
                ?>
            </div>
        <?php else : ?>
            <p><?php esc_html_e( 'No posts found.', 'clearviewshield' ); ?></p>
        <?php endif; ?>
    </div>
</main><!-- #main -->

<?php
get_sidebar();
get_footer();
