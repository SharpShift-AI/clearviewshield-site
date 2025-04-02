<?php
/**
 * Template Name: About Page
 *
 * @package ClearViewShield
 */

get_header();
?>

<main id="primary" class="site-main about-page">
    <div class="container">
        <header class="page-header">
            <h1 class="page-title"><?php the_title(); ?></h1>
        </header>

        <div class="about-page-content">
            <div class="about-intro">
                <div class="about-image">
                    <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/about-image.jpg'); ?>" alt="ClearViewShield Windshield Repair">
                </div>
                <div class="about-text">
                    <h2>Cedar Rapids' Trusted Mobile Windshield Repair Service</h2>
                    <p>Since 2021, ClearViewShield has been providing professional mobile windshield repair services to Cedar Rapids, Marion, Hiawatha, and throughout Linn County, Iowa.</p>
                    <p>We specialize in repairing rock chips, cracks, and other windshield damage at your location—whether that's your home, workplace, or anywhere else convenient for you.</p>
                    <p>Our mission is simple: provide convenient, high-quality windshield repairs at a fair price with exceptional customer service.</p>
                </div>
            </div>

            <div class="about-values">
                <h2>Our Values</h2>
                <div class="values-container">
                    <div class="value-item">
                        <i class="fas fa-handshake"></i>
                        <h3>Integrity</h3>
                        <p>We're honest about what can and cannot be repaired. If a repair isn't the right solution, we'll tell you.</p>
                    </div>
                    <div class="value-item">
                        <i class="fas fa-star"></i>
                        <h3>Quality</h3>
                        <p>We use professional-grade materials and techniques to ensure your repair is done right the first time.</p>
                    </div>
                    <div class="value-item">
                        <i class="fas fa-clock"></i>
                        <h3>Convenience</h3>
                        <p>Our mobile service comes to you, saving you time and hassle. Most repairs take less than an hour.</p>
                    </div>
                    <div class="value-item">
                        <i class="fas fa-dollar-sign"></i>
                        <h3>Value</h3>
                        <p>Our $75 flat rate pricing means no surprises. We offer the best value for professional windshield repair.</p>
                    </div>
                </div>
            </div>

            <div class="about-process">
                <h2>Our Repair Process</h2>
                <div class="process-steps">
                    <div class="process-step">
                        <div class="step-number">1</div>
                        <h3>Assessment</h3>
                        <p>We evaluate the damage to determine if repair is the right solution.</p>
                    </div>
                    <div class="process-step">
                        <div class="step-number">2</div>
                        <h3>Preparation</h3>
                        <p>We clean the damaged area and prepare it for the repair resin.</p>
                    </div>
                    <div class="process-step">
                        <div class="step-number">3</div>
                        <h3>Injection</h3>
                        <p>We inject special repair resin into the damaged area using professional equipment.</p>
                    </div>
                    <div class="process-step">
                        <div class="step-number">4</div>
                        <h3>Curing</h3>
                        <p>The resin is cured with UV light to create a strong, clear bond.</p>
                    </div>
                    <div class="process-step">
                        <div class="step-number">5</div>
                        <h3>Finishing</h3>
                        <p>We polish the repair area to blend with the surrounding glass for a smooth finish.</p>
                    </div>
                </div>
            </div>

            <div class="about-warranty">
                <h2>Our Lifetime Warranty</h2>
                <div class="warranty-content">
                    <div class="warranty-icon">
                        <i class="fas fa-certificate"></i>
                    </div>
                    <div class="warranty-text">
                        <p>Every repair we perform comes with a lifetime warranty for as long as you own your vehicle.</p>
                        <p>If a repaired chip or crack ever spreads or fails, we'll fix it at no charge. That's our promise to you.</p>
                        <p>Our warranty reflects our confidence in the quality of our repairs and our commitment to customer satisfaction.</p>
                    </div>
                </div>
            </div>

            <div class="about-service-area">
                <h2>Our Service Area</h2>
                <p>ClearViewShield provides mobile windshield repair throughout Cedar Rapids, Marion, Hiawatha, and all of Linn County, Iowa. We come to your location for maximum convenience.</p>
                <div id="service-area-map" class="service-area-map"></div>
                <p class="service-area-note">Don't see your location? Give us a call at <a href="tel:3197750717">319-775-0717</a> to check if we can come to you!</p>
            </div>

            <div class="about-cta">
                <h2>Ready to Fix That Windshield?</h2>
                <p>Book your mobile windshield repair today and save time and money.</p>
                <div class="cta-buttons">
                    <?php clearviewshield_cta_button('Book Online', home_url('/booking'), 'btn-primary btn-large'); ?>
                    <?php clearviewshield_phone_button('Call/Text 319-775-0717', 'btn-outline btn-large'); ?>
                </div>
            </div>
        </div>
    </div>
</main><!-- #main -->

<?php
get_footer();
