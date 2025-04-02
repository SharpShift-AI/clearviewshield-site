<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package ClearViewShield
 */

get_header();
?>

<main id="primary" class="site-main error-404">
    <div class="container">
        <section class="error-404-content">
            <header class="page-header">
                <h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'clearviewshield' ); ?></h1>
            </header><!-- .page-header -->

            <div class="page-content">
                <p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try searching?', 'clearviewshield' ); ?></p>

                <?php get_search_form(); ?>
                
                <div class="error-404-cta">
                    <h2>Looking for Windshield Repair in Cedar Rapids?</h2>
                    <p>We offer mobile windshield repair throughout Cedar Rapids, Marion, Hiawatha, and Linn County.</p>
                    <ul class="error-404-features">
                        <li><i class="fas fa-check"></i> $75 flat rate pricing</li>
                        <li><i class="fas fa-check"></i> We come to your location</li>
                        <li><i class="fas fa-check"></i> Lifetime warranty on all repairs</li>
                        <li><i class="fas fa-check"></i> Most repairs take less than an hour</li>
                    </ul>
                    
                    <div class="cta-buttons">
                        <?php clearviewshield_cta_button('Book Online', home_url('/booking'), 'btn-primary btn-large'); ?>
                        <?php clearviewshield_phone_button('Call/Text 319-775-0717', 'btn-outline btn-large'); ?>
                    </div>
                </div>
                
                <div class="error-404-navigation">
                    <h3><?php esc_html_e( 'Popular Pages', 'clearviewshield' ); ?></h3>
                    <ul>
                        <li><a href="<?php echo esc_url(home_url('/')); ?>"><i class="fas fa-home"></i> <?php esc_html_e( 'Home', 'clearviewshield' ); ?></a></li>
                        <li><a href="<?php echo esc_url(home_url('/about')); ?>"><i class="fas fa-info-circle"></i> <?php esc_html_e( 'About Us', 'clearviewshield' ); ?></a></li>
                        <li><a href="<?php echo esc_url(home_url('/booking')); ?>"><i class="fas fa-calendar-alt"></i> <?php esc_html_e( 'Book a Repair', 'clearviewshield' ); ?></a></li>
                        <li><a href="<?php echo esc_url(home_url('/contact')); ?>"><i class="fas fa-envelope"></i> <?php esc_html_e( 'Contact Us', 'clearviewshield' ); ?></a></li>
                    </ul>
                </div>
            </div><!-- .page-content -->
        </section>
    </div>
</main><!-- #main -->

<?php
get_footer();
