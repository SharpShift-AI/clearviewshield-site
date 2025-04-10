<?php
/**
 * Template for the booking page
 *
 * @package ClearViewShield
 */

get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">
        
        <!-- Booking Hero Section -->
        <section class="booking-hero-section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 mx-auto text-center fade-in">
                        <h1>Book Your Mobile Windshield Repair</h1>
                        <p class="lead">Schedule your $75 windshield repair service in Cedar Rapids and surrounding areas. We'll come to your location!</p>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Booking Form Section -->
        <section class="booking-section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 mx-auto fade-in">
                        <div class="booking-form">
                            <!-- Elementor Content -->
                            <?php
                            while (have_posts()) :
                                the_post();
                                the_content();
                            endwhile;
                            ?>
                        </div>
                    </div>
                    
                    <div class="col-lg-4 fade-in">
                        <div class="booking-sidebar">
                            <div class="sidebar-widget">
                                <h3>Why Choose Us</h3>
                                <ul class="check-list">
                                    <li>Mobile service - we come to you</li>
                                    <li>Flat rate pricing - just $75 per repair</li>
                                    <li>Lifetime warranty on all repairs</li>
                                    <li>Most repairs take 30-45 minutes</li>
                                    <li>Insurance approved techniques</li>
                                    <li>Serving Cedar Rapids and surrounding areas</li>
                                </ul>
                            </div>
                            
                            <div class="sidebar-widget">
                                <h3>Service Areas</h3>
                                <?php echo do_shortcode('[clearviewshield_service_areas]'); ?>
                            </div>
                            
                            <div class="sidebar-widget">
                                <h3>Questions?</h3>
                                <p>Call us at <a href="tel:3197750717"><strong>(319) 775-0717</strong></a> or <a href="<?php echo esc_url(home_url('/contact/')); ?>">contact us online</a>.</p>
                            </div>
                            
                            <div class="sidebar-widget">
                                <?php echo do_shortcode('[clearviewshield_warranty]'); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- How It Works Section -->
        <section class="how-it-works-section">
            <div class="container">
                <div class="row text-center mb-5">
                    <div class="col-lg-8 mx-auto fade-in">
                        <h2>How It Works</h2>
                        <p class="lead">Our mobile windshield repair process is simple and convenient.</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-6 mb-4 fade-in">
                        <div class="process-card">
                            <div class="process-icon">
                                <span class="process-number">1</span>
                                <i class="fas fa-calendar-alt"></i>
                            </div>
                            <h3 class="process-title">Book Online</h3>
                            <p>Schedule your appointment using our simple online booking system.</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-4 fade-in">
                        <div class="process-card">
                            <div class="process-icon">
                                <span class="process-number">2</span>
                                <i class="fas fa-car"></i>
                            </div>
                            <h3 class="process-title">We Come To You</h3>
                            <p>Our technician arrives at your location at the scheduled time.</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-4 fade-in">
                        <div class="process-card">
                            <div class="process-icon">
                                <span class="process-number">3</span>
                                <i class="fas fa-tools"></i>
                            </div>
                            <h3 class="process-title">Quick Repair</h3>
                            <p>We repair your windshield in about 30-45 minutes.</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-4 fade-in">
                        <div class="process-card">
                            <div class="process-icon">
                                <span class="process-number">4</span>
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <h3 class="process-title">Drive Away</h3>
                            <p>You're back on the road with a safe, repaired windshield.</p>
                        </div>
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
                            "The booking process was so easy! I scheduled online, received text confirmations, and the technician arrived right on time. Great service from start to finish."
                        </div>
                        <div class="testimonial-author">
                            - Amanda K., Cedar Rapids
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
                            "I was able to book same-day service for a chip I noticed that morning. The technician came to my office parking lot and fixed it while I continued working. Couldn't be more convenient!"
                        </div>
                        <div class="testimonial-author">
                            - Robert T., Marion
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
                            "The text reminders were great, and I appreciated being able to upload a photo of the damage when booking. The technician knew exactly what to expect and had all the right tools ready."
                        </div>
                        <div class="testimonial-author">
                            - Lisa M., Hiawatha
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
                        <h2>Booking FAQs</h2>
                        <p class="lead">Common questions about our booking process and service.</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 fade-in">
                        <div class="accordion" id="bookingFaqAccordion1">
                            <div class="card">
                                <div class="card-header" id="bookingFaqHeading1">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#bookingFaqCollapse1" aria-expanded="true" aria-controls="bookingFaqCollapse1">
                                            How soon can I get an appointment?
                                        </button>
                                    </h5>
                                </div>
                                <div id="bookingFaqCollapse1" class="collapse show" aria-labelledby="bookingFaqHeading1" data-parent="#bookingFaqAccordion1">
                                    <div class="card-body">
                                        We often have same-day or next-day appointments available. During peak seasons (spring and summer), we recommend booking 1-2 days in advance for the best availability.
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="bookingFaqHeading2">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#bookingFaqCollapse2" aria-expanded="false" aria-controls="bookingFaqCollapse2">
                                            Do I need to be present during the repair?
                                        </button>
                                    </h5>
                                </div>
                                <div id="bookingFaqCollapse2" class="collapse" aria-labelledby="bookingFaqHeading2" data-parent="#bookingFaqAccordion1">
                                    <div class="card-body">
                                        No, you don't need to be present as long as we have access to your vehicle. Many customers book appointments at their workplace and leave their keys with a receptionist or colleague.
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="bookingFaqHeading3">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#bookingFaqCollapse3" aria-expanded="false" aria-controls="bookingFaqCollapse3">
                                            What happens if it rains on my appointment day?
                                        </button>
                                    </h5>
                                </div>
                                <div id="bookingFaqCollapse3" class="collapse" aria-labelledby="bookingFaqHeading3" data-parent="#bookingFaqAccordion1">
                                    <div class="card-body">
                                        We can perform repairs in light rain, but heavy rain or storms may require rescheduling. We'll monitor the weather and contact you if we need to reschedule. We can also perform the repair in a garage or covered area if available.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 fade-in">
                        <div class="accordion" id="bookingFaqAccordion2">
                            <div class="card">
                                <div class="card-header" id="bookingFaqHeading4">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#bookingFaqCollapse4" aria-expanded="true" aria-controls="bookingFaqCollapse4">
                                            How do I pay for the service?
                                        </button>
                                    </h5>
                                </div>
                                <div id="bookingFaqCollapse4" class="collapse show" aria-labelledby="bookingFaqHeading4" data-parent="#bookingFaqAccordion2">
                                    <div class="card-body">
                                        We accept payment after the service is completed. We take all major credit cards, debit cards, cash, and mobile payment options like Apple Pay and Google Pay. If your insurance is covering the repair, we can bill them directly in most cases.
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="bookingFaqHeading5">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#bookingFaqCollapse5" aria-expanded="false" aria-controls="bookingFaqCollapse5">
                                            Can I reschedule my appointment?
                                        </button>
                                    </h5>
                                </div>
                                <div id="bookingFaqCollapse5" class="collapse" aria-labelledby="bookingFaqHeading5" data-parent="#bookingFaqAccordion2">
                                    <div class="card-body">
                                        Yes, you can reschedule through our online system or by calling us at (319) 775-0717. We appreciate at least 24 hours notice for rescheduling when possible.
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="bookingFaqHeading6">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#bookingFaqCollapse6" aria-expanded="false" aria-controls="bookingFaqCollapse6">
                                            Will I receive appointment reminders?
                                        </button>
                                    </h5>
                                </div>
                                <div id="bookingFaqCollapse6" class="collapse" aria-labelledby="bookingFaqHeading6" data-parent="#bookingFaqAccordion2">
                                    <div class="card-body">
                                        Yes, you'll receive an email confirmation immediately after booking, an SMS reminder 24 hours before your appointment, and another SMS when our technician is on the way to your location.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- CTA Section -->
        <section class="cta-section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-10 mx-auto fade-in">
                        <h2 class="cta-title">Questions About Booking?</h2>
                        <p class="cta-description">If you have any questions or need assistance with booking your windshield repair, don't hesitate to contact us.</p>
                        <a href="tel:3197750717" class="btn btn-cta">Call (319) 775-0717</a>
                        <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn btn-outline ml-3">Contact Us</a>
                    </div>
                </div>
            </div>
        </section>
        
    </main><!-- #main -->
</div><!-- #primary -->

<?php get_footer(); ?>