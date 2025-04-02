<?php
/**
 * Template Name: Booking Page
 *
 * @package ClearViewShield
 */

get_header();
?>

<main id="primary" class="site-main booking-page">
    <div class="container">
        <header class="page-header">
            <h1 class="page-title"><?php the_title(); ?></h1>
        </header>

        <div class="booking-page-content">
            <div class="booking-intro">
                <p>Schedule your mobile windshield repair service with ClearViewShield. We'll come to your location in Cedar Rapids, Marion, Hiawatha, or anywhere in Linn County.</p>
                <p>All repairs are just $75 and come with our lifetime warranty. Most repairs take 30-45 minutes to complete.</p>
                
                <div class="booking-features">
                    <div class="booking-feature">
                        <i class="fas fa-car"></i>
                        <h3>Mobile Service</h3>
                        <p>We come to your home or workplace</p>
                    </div>
                    <div class="booking-feature">
                        <i class="fas fa-dollar-sign"></i>
                        <h3>Fixed Price</h3>
                        <p>$75 flat rate, no hidden fees</p>
                    </div>
                    <div class="booking-feature">
                        <i class="fas fa-shield-alt"></i>
                        <h3>Lifetime Warranty</h3>
                        <p>All repairs are guaranteed</p>
                    </div>
                </div>
            </div>

            <div class="booking-form-container">
                <h2>Book Your Repair</h2>
                <?php get_template_part('template-parts/booking-form'); ?>
            </div>
        </div>

        <div class="booking-faq">
            <h2>Frequently Asked Questions</h2>
            
            <div class="faq-item">
                <h3>How long does a windshield repair take?</h3>
                <p>Most windshield repairs take between 30-45 minutes to complete. For multiple damage points, it may take up to an hour.</p>
            </div>
            
            <div class="faq-item">
                <h3>Can all windshield damage be repaired?</h3>
                <p>We can repair most rock chips and cracks up to 6 inches long. Damage in the driver's direct line of sight or damage that extends to the edge of the windshield may require replacement instead of repair.</p>
            </div>
            
            <div class="faq-item">
                <h3>What areas do you service?</h3>
                <p>We provide mobile windshield repair throughout Cedar Rapids, Marion, Hiawatha, and all of Linn County, Iowa.</p>
            </div>
            
            <div class="faq-item">
                <h3>How does your lifetime warranty work?</h3>
                <p>Our lifetime warranty covers the repair for as long as you own the vehicle. If the repair ever fails or spreads, we'll fix it for free.</p>
            </div>
            
            <div class="faq-item">
                <h3>Do you work with insurance?</h3>
                <p>Yes, we can work with your insurance company. Many insurance companies will waive your deductible for windshield repairs (not replacements). Contact your insurance provider to verify your coverage.</p>
            </div>
        </div>
    </div>
</main><!-- #main -->

<?php
get_footer();
