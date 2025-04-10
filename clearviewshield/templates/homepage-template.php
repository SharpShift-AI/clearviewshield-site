<?php
/**
 * Template for the homepage
 *
 * @package ClearViewShield
 */

get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">
        
        <!-- Hero Section -->
        <section class="hero-section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 hero-content fade-in">
                        <h1 class="hero-title">Mobile Windshield Repair in Cedar Rapids</h1>
                        <h2 class="hero-subtitle">We come to you and fix rock chips & cracks for just $75</h2>
                        <div class="hero-cta">
                            <a href="<?php echo esc_url(home_url('/booking/')); ?>" class="btn btn-cta">Book Now</a>
                            <a href="<?php echo esc_url(home_url('/services/')); ?>" class="btn btn-outline">Learn More</a>
                        </div>
                    </div>
                    <div class="col-lg-6 fade-in">
                        <img src="<?php echo esc_url(get_stylesheet_directory_uri()); ?>/images/hero-image.jpg" alt="Mobile windshield repair in Cedar Rapids" class="img-fluid">
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Services Section -->
        <section class="services-section">
            <div class="container">
                <div class="row text-center mb-5">
                    <div class="col-lg-8 mx-auto fade-in">
                        <h2>Our Windshield Repair Services</h2>
                        <p class="lead">We specialize in repairing rock chips and cracks to save you time and money compared to full windshield replacement.</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 mb-4 fade-in">
                        <div class="service-card">
                            <div class="service-icon">
                                <i class="fas fa-bullseye"></i>
                            </div>
                            <h3 class="service-title">Rock Chip Repair</h3>
                            <p class="service-description">We repair star breaks, bull's-eyes, and combination breaks quickly and effectively.</p>
                            <p><strong>Price: <?php echo do_shortcode('[clearviewshield_price]'); ?></strong></p>
                            <a href="<?php echo esc_url(home_url('/booking/')); ?>" class="btn">Book Repair</a>
                        </div>
                    </div>
                    <div class="col-lg-4 mb-4 fade-in">
                        <div class="service-card">
                            <div class="service-icon">
                                <i class="fas fa-ruler"></i>
                            </div>
                            <h3 class="service-title">Crack Repair</h3>
                            <p class="service-description">We can repair cracks up to 6 inches long, preventing them from spreading further.</p>
                            <p><strong>Price: <?php echo do_shortcode('[clearviewshield_price]'); ?></strong></p>
                            <a href="<?php echo esc_url(home_url('/booking/')); ?>" class="btn">Book Repair</a>
                        </div>
                    </div>
                    <div class="col-lg-4 mb-4 fade-in">
                        <div class="service-card">
                            <div class="service-icon">
                                <i class="fas fa-car"></i>
                            </div>
                            <h3 class="service-title">Mobile Service</h3>
                            <p class="service-description">We come to your home or office throughout Cedar Rapids and surrounding areas.</p>
                            <p><strong>Service Areas:</strong></p>
                            <?php echo do_shortcode('[clearviewshield_service_areas]'); ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Why Choose Us Section -->
        <section class="about-section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 fade-in">
                        <div class="about-image">
                            <img src="<?php echo esc_url(get_stylesheet_directory_uri()); ?>/images/why-choose-us.jpg" alt="Professional windshield repair" class="img-fluid">
                        </div>
                    </div>
                    <div class="col-lg-6 fade-in">
                        <div class="about-content">
                            <h2>Why Choose ClearViewShield?</h2>
                            <p class="lead">We make windshield repair convenient, affordable, and stress-free.</p>
                            
                            <div class="feature-item">
                                <h4><i class="fas fa-check-circle text-success"></i> Convenient Mobile Service</h4>
                                <p>We come to your location in Cedar Rapids, Marion, Hiawatha, and throughout Linn County.</p>
                            </div>
                            
                            <div class="feature-item">
                                <h4><i class="fas fa-check-circle text-success"></i> Flat-Rate Pricing</h4>
                                <p>Just <?php echo do_shortcode('[clearviewshield_price]'); ?> per repair with no hidden fees or surprises.</p>
                            </div>
                            
                            <div class="feature-item">
                                <h4><i class="fas fa-check-circle text-success"></i> Lifetime Warranty</h4>
                                <p>All our repairs are backed by a lifetime warranty for your peace of mind.</p>
                                <?php echo do_shortcode('[clearviewshield_warranty]'); ?>
                            </div>
                            
                            <div class="feature-item">
                                <h4><i class="fas fa-check-circle text-success"></i> Insurance Approved</h4>
                                <p>Our repairs meet all insurance standards and we can work directly with your insurance company.</p>
                            </div>
                            
                            <div class="mt-4">
                                <a href="<?php echo esc_url(home_url('/about/')); ?>" class="btn">Learn More About Us</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Before/After Section -->
        <section class="before-after-section">
            <div class="container">
                <div class="row text-center mb-5">
                    <div class="col-lg-8 mx-auto fade-in">
                        <h2>See Our Results</h2>
                        <p class="lead">Drag the slider to see before and after examples of our windshield repairs.</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 mb-4 fade-in">
                        <div class="before-after-slider">
                            <img src="<?php echo esc_url(get_stylesheet_directory_uri()); ?>/images/before-1.jpg" alt="Before repair" class="before-image img-fluid">
                            <img src="<?php echo esc_url(get_stylesheet_directory_uri()); ?>/images/after-1.jpg" alt="After repair" class="after-image img-fluid">
                            <div class="slider-handle"></div>
                        </div>
                        <h4 class="text-center mt-3">Rock Chip Repair</h4>
                    </div>
                    <div class="col-lg-6 mb-4 fade-in">
                        <div class="before-after-slider">
                            <img src="<?php echo esc_url(get_stylesheet_directory_uri()); ?>/images/before-2.jpg" alt="Before repair" class="before-image img-fluid">
                            <img src="<?php echo esc_url(get_stylesheet_directory_uri()); ?>/images/after-2.jpg" alt="After repair" class="after-image img-fluid">
                            <div class="slider-handle"></div>
                        </div>
                        <h4 class="text-center mt-3">Crack Repair</h4>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Testimonials Section -->
        <section class="testimonials-section">
            <div class="container">
                <div class="row text-center mb-5">
                    <div class="col-lg-8 mx-auto fade-in">
                        <h2>What Our Customers Say</h2>
                        <p class="lead">Don't just take our word for it. Here's what our satisfied customers have to say.</p>
                    </div>
                </div>
                <div class="testimonial-slider fade-in">
                    <div class="testimonial-card">
                        <div class="testimonial-rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <div class="testimonial-content">
                            "I was amazed at how quick and easy the process was. They came to my office, repaired the chip in my windshield in about 30 minutes, and I was able to continue working. Great service!"
                        </div>
                        <div class="testimonial-author">
                            - Michael S., Cedar Rapids
                        </div>
                    </div>
                    <div class="testimonial-card">
                        <div class="testimonial-rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <div class="testimonial-content">
                            "I had a crack in my windshield that I was worried would spread. ClearViewShield came to my house, repaired it perfectly, and saved me hundreds compared to replacement. Highly recommend!"
                        </div>
                        <div class="testimonial-author">
                            - Jennifer L., Marion
                        </div>
                    </div>
                    <div class="testimonial-card">
                        <div class="testimonial-rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <div class="testimonial-content">
                            "Professional, prompt, and reasonably priced. The technician explained everything clearly and did a fantastic job repairing the chip in my windshield. You can barely see where it was!"
                        </div>
                        <div class="testimonial-author">
                            - David R., Hiawatha
                        </div>
                    </div>
                    <div class="testimonial-card">
                        <div class="testimonial-rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <div class="testimonial-content">
                            "I was quoted over $400 for a windshield replacement. ClearViewShield repaired it for just $75 and it looks perfect. The lifetime warranty gives me peace of mind too!"
                        </div>
                        <div class="testimonial-author">
                            - Sarah T., North Liberty
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- FAQ Section -->
        <section class="faq-section">
            <div class="container">
                <div class="row text-center mb-5">
                    <div class="col-lg-8 mx-auto fade-in">
                        <h2>Frequently Asked Questions</h2>
                        <p class="lead">Get answers to common questions about our windshield repair services.</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 fade-in">
                        <div class="accordion" id="faqAccordion1">
                            <div class="card">
                                <div class="card-header" id="faqHeading1">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#faqCollapse1" aria-expanded="true" aria-controls="faqCollapse1">
                                            How long does a windshield repair take?
                                        </button>
                                    </h5>
                                </div>
                                <div id="faqCollapse1" class="collapse show" aria-labelledby="faqHeading1" data-parent="#faqAccordion1">
                                    <div class="card-body">
                                        Most windshield repairs take 30-45 minutes to complete. The resin needs time to cure properly, but you can drive your vehicle immediately after the repair is finished.
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="faqHeading2">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#faqCollapse2" aria-expanded="false" aria-controls="faqCollapse2">
                                            Can all windshield damage be repaired?
                                        </button>
                                    </h5>
                                </div>
                                <div id="faqCollapse2" class="collapse" aria-labelledby="faqHeading2" data-parent="#faqAccordion1">
                                    <div class="card-body">
                                        Not all damage can be repaired. Generally, chips smaller than a quarter and cracks up to 6 inches long can be repaired. Damage in the driver's direct line of sight may still require replacement. We'll assess your damage and provide an honest recommendation.
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="faqHeading3">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#faqCollapse3" aria-expanded="false" aria-controls="faqCollapse3">
                                            Will my insurance cover windshield repair?
                                        </button>
                                    </h5>
                                </div>
                                <div id="faqCollapse3" class="collapse" aria-labelledby="faqHeading3" data-parent="#faqAccordion1">
                                    <div class="card-body">
                                        Many insurance companies cover windshield repairs at 100% with no deductible because it prevents them from having to pay for a more expensive replacement later. We can help verify your coverage and work directly with your insurance company.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 fade-in">
                        <div class="accordion" id="faqAccordion2">
                            <div class="card">
                                <div class="card-header" id="faqHeading4">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#faqCollapse4" aria-expanded="true" aria-controls="faqCollapse4">
                                            How soon should I repair a chip or crack?
                                        </button>
                                    </h5>
                                </div>
                                <div id="faqCollapse4" class="collapse show" aria-labelledby="faqHeading4" data-parent="#faqAccordion2">
                                    <div class="card-body">
                                        You should repair chips and cracks as soon as possible. Damage can spread quickly due to temperature changes, road vibrations, and pressure. What starts as a small, repairable chip can quickly become a crack requiring full replacement.
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="faqHeading5">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#faqCollapse5" aria-expanded="false" aria-controls="faqCollapse5">
                                            What areas do you serve?
                                        </button>
                                    </h5>
                                </div>
                                <div id="faqCollapse5" class="collapse" aria-labelledby="faqHeading5" data-parent="#faqAccordion2">
                                    <div class="card-body">
                                        We provide mobile windshield repair services throughout Cedar Rapids, Marion, Hiawatha, and all of Linn County. We also serve surrounding areas including North Liberty, Coralville, and Iowa City.
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="faqHeading6">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#faqCollapse6" aria-expanded="false" aria-controls="faqCollapse6">
                                            What is your warranty policy?
                                        </button>
                                    </h5>
                                </div>
                                <div id="faqCollapse6" class="collapse" aria-labelledby="faqHeading6" data-parent="#faqAccordion2">
                                    <div class="card-body">
                                        All our repairs come with a lifetime warranty. If a repaired area ever cracks or spreads, we'll refund your money. Our warranty is transferable if you sell your vehicle, adding value to your car.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-12 text-center fade-in">
                        <p>Have more questions? <a href="<?php echo esc_url(home_url('/contact/')); ?>">Contact us</a> or check out our <a href="<?php echo esc_url(home_url('/faq/')); ?>">full FAQ page</a>.</p>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- CTA Section -->
        <section class="cta-section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-10 mx-auto fade-in">
                        <h2 class="cta-title">Ready to Fix That Windshield?</h2>
                        <p class="cta-description">Book your mobile windshield repair today and we'll come to your location in Cedar Rapids or surrounding areas. Just $75 per repair with a lifetime warranty!</p>
                        <a href="<?php echo esc_url(home_url('/booking/')); ?>" class="btn btn-cta">Book Your Repair Now</a>
                        <p class="mt-3">Or call us at <a href="tel:3197750717" class="text-white"><strong>(319) 775-0717</strong></a></p>
                    </div>
                </div>
            </div>
        </section>
        
    </main><!-- #main -->
</div><!-- #primary -->

<?php get_footer(); ?>
