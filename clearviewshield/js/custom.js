/**
 * Custom JavaScript for ClearViewShield Theme
 * 
 * This file contains all custom JavaScript functionality for the ClearViewShield theme
 * including animations, interactive elements, and form enhancements.
 */

(function($) {
    'use strict';

    // Document Ready
    $(document).ready(function() {
        // Initialize animations
        initAnimations();
        
        // Initialize before/after slider
        initBeforeAfterSlider();
        
        // Initialize testimonial slider
        initTestimonialSlider();
        
        // Initialize mobile menu
        initMobileMenu();
        
        // Initialize form validation
        initFormValidation();
        
        // Initialize scroll to top button
        initScrollToTop();
        
        // Initialize pricing toggle
        initPricingToggle();
    });

    /**
     * Initialize scroll animations
     */
    function initAnimations() {
        // Fade in elements as they enter the viewport
        $('.fade-in').each(function() {
            var $element = $(this);
            
            // Create an Intersection Observer
            var observer = new IntersectionObserver(function(entries) {
                entries.forEach(function(entry) {
                    if (entry.isIntersecting) {
                        $element.addClass('visible');
                        observer.unobserve(entry.target);
                    }
                });
            }, {
                threshold: 0.1
            });
            
            observer.observe(this);
        });
        
        // Add animation to CTA buttons
        $('.btn-cta').hover(
            function() {
                $(this).addClass('pulse');
            },
            function() {
                $(this).removeClass('pulse');
            }
        );
    }

    /**
     * Initialize before/after slider
     */
    function initBeforeAfterSlider() {
        $('.before-after-slider').each(function() {
            var $container = $(this);
            var $beforeImage = $container.find('.before-image');
            var $afterImage = $container.find('.after-image');
            var $handle = $container.find('.slider-handle');
            var containerWidth = $container.width();
            var isDragging = false;
            
            // Set initial position
            $handle.css('left', '50%');
            $afterImage.css('clip-path', 'inset(0 0 0 50%)');
            
            // Handle mouse events
            $handle.on('mousedown touchstart', function(e) {
                isDragging = true;
                e.preventDefault();
            });
            
            $(document).on('mouseup touchend', function() {
                isDragging = false;
            });
            
            $(document).on('mousemove touchmove', function(e) {
                if (!isDragging) return;
                
                var containerOffset = $container.offset();
                var relX = (e.pageX || e.originalEvent.touches[0].pageX) - containerOffset.left;
                var percent = Math.max(0, Math.min(100, relX / containerWidth * 100));
                
                $handle.css('left', percent + '%');
                $afterImage.css('clip-path', 'inset(0 0 0 ' + percent + '%)');
            });
            
            // Handle window resize
            $(window).on('resize', function() {
                containerWidth = $container.width();
            });
        });
    }

    /**
     * Initialize testimonial slider
     */
    function initTestimonialSlider() {
        if ($('.testimonial-slider').length && typeof $.fn.slick !== 'undefined') {
            $('.testimonial-slider').slick({
                dots: true,
                arrows: false,
                infinite: true,
                speed: 500,
                slidesToShow: 3,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 5000,
                responsive: [
                    {
                        breakpoint: 992,
                        settings: {
                            slidesToShow: 2
                        }
                    },
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 1
                        }
                    }
                ]
            });
        }
    }

$(document).ready(function() {
    /**
     * Initialize before/after slider
     */
    function initBeforeAfterSlider() {
        $('.before-after-slider').each(function() {
            var $slider = $(this);
            var $before = $slider.find('.before-image');
            var $after = $slider.find('.after-image');
            var $handle = $slider.find('.slider-handle');
            var isDragging = false;

            $handle.on('mousedown', function(e) {
                isDragging = true;
                e.preventDefault();
            });

            $(document).on('mousemove', function(e) {
                if (isDragging) {
                    var sliderWidth = $slider.width();
                    var offsetX = e.pageX - $slider.offset().left;
                    var percentage = (offsetX / sliderWidth) * 100;

                    if (percentage >= 0 && percentage <= 100) {
                        $before.css('clip-path', `inset(0 ${100 - percentage}% 0 0)`);
                        $after.css('clip-path', `inset(0 0 0 ${percentage}%)`);
                        $handle.css('left', percentage + '%');
                    }
                }
            });

            $(document).on('mouseup', function() {
                isDragging = false;
            });
        });
    }

    /**
     * Initialize testimonial slider
     */
    function initTestimonialSlider() {
        $('.testimonial-slider').slick({
            dots: true,
            arrows: false,
            infinite: true,
            speed: 500,
            slidesToShow: 3,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 5000,
            responsive: [
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 2
                    }
                },
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 1
                    }
                }
            ]
        });
    }

    /**
     * Initialize mobile menu
     */
    function initMobileMenu() {
        var $hamburgerToggle = $('.hamburger-toggle');
        var $menuContainer = $('.primary-menu-container');
        
        $hamburgerToggle.on('click', function() {
            $(this).toggleClass('active');
            $menuContainer.toggleClass('active');
            $('body').toggleClass('menu-open');
        });
    }

    // Close menu when clicking outside
    $(document).on('click', function(e) {
        var $hamburgerToggle = $('.hamburger-toggle');
        var $menuContainer = $('.primary-menu-container');
        if (!$(e.target).closest('.primary-menu-container, .hamburger-toggle').length && $menuContainer.hasClass('active')) {
            $hamburgerToggle.removeClass('active');
            $menuContainer.removeClass('active');
            $('body').removeClass('menu-open');
        }
    });

    // Add dropdown functionality
    $('.primary-menu .menu-item-has-children > a').on('click', function(e) {
        e.preventDefault();
        $(this).parent().toggleClass('submenu-open');
        $(this).next('.sub-menu').slideToggle(200);
    });

    // Initialize functions
    initBeforeAfterSlider();
    initTestimonialSlider();
    initMobileMenu();
});

    /**
     * Initialize form validation
     */
    function initFormValidation() {
        // Validate contact form
        $('#contact-form').on('submit', function(e) {
            var isValid = true;
            var $form = $(this);
            
            // Reset error messages
            $form.find('.error-message').remove();
            $form.find('.is-invalid').removeClass('is-invalid');
            
            // Validate required fields
            $form.find('[required]').each(function() {
                var $field = $(this);
                
                if (!$field.val().trim()) {
                    isValid = false;
                    $field.addClass('is-invalid');
                    $field.after('<div class="error-message">This field is required</div>');
                }
            });
            
            // Validate email
            var $email = $form.find('input[type="email"]');
            if ($email.length && $email.val().trim() && !isValidEmail($email.val())) {
                isValid = false;
                $email.addClass('is-invalid');
                $email.after('<div class="error-message">Please enter a valid email address</div>');
            }
            
            // Validate phone
            var $phone = $form.find('input[type="tel"]');
            if ($phone.length && $phone.val().trim() && !isValidPhone($phone.val())) {
                isValid = false;
                $phone.addClass('is-invalid');
                $phone.after('<div class="error-message">Please enter a valid phone number</div>');
            }
            
            if (!isValid) {
                e.preventDefault();
            }
        });
        
        // Real-time validation
        $('input, textarea').on('blur', function() {
            var $field = $(this);
            
            // Remove existing error
            $field.removeClass('is-invalid');
            $field.next('.error-message').remove();
            
            // Check if required
            if ($field.prop('required') && !$field.val().trim()) {
                $field.addClass('is-invalid');
                $field.after('<div class="error-message">This field is required</div>');
            }
            
            // Check email
            if ($field.attr('type') === 'email' && $field.val().trim() && !isValidEmail($field.val())) {
                $field.addClass('is-invalid');
                $field.after('<div class="error-message">Please enter a valid email address</div>');
            }
            
            // Check phone
            if ($field.attr('type') === 'tel' && $field.val().trim() && !isValidPhone($field.val())) {
                $field.addClass('is-invalid');
                $field.after('<div class="error-message">Please enter a valid phone number</div>');
            }
        });
    }

    /**
     * Initialize scroll to top button
     */
    function initScrollToTop() {
        var $scrollToTop = $('<a href="#" id="scroll-to-top" aria-label="Scroll to top"><i class="fas fa-chevron-up"></i></a>');
        $('body').append($scrollToTop);
        
        $(window).on('scroll', function() {
            if ($(this).scrollTop() > 300) {
                $scrollToTop.addClass('show');
            } else {
                $scrollToTop.removeClass('show');
            }
        });
        
        $scrollToTop.on('click', function(e) {
            e.preventDefault();
            $('html, body').animate({
                scrollTop: 0
            }, 500);
        });
    }

    /**
     * Initialize pricing toggle
     */
    function initPricingToggle() {
        $('.pricing-toggle').on('click', function() {
            var $toggle = $(this);
            var $pricingBoxes = $('.pricing-box');
            
            $toggle.toggleClass('active');
            
            if ($toggle.hasClass('active')) {
                // Show annual pricing
                $pricingBoxes.each(function() {
                    var $box = $(this);
                    var annualPrice = $box.data('annual-price');
                    $box.find('.pricing-price').text('$' + annualPrice);
                    $box.find('.pricing-period').text('/year');
                });
            } else {
                // Show monthly pricing
                $pricingBoxes.each(function() {
                    var $box = $(this);
                    var monthlyPrice = $box.data('monthly-price');
                    $box.find('.pricing-price').text('$' + monthlyPrice);
                    $box.find('.pricing-period').text('/month');
                });
            }
        });
    }

    /**
     * Validate email address
     */
    function isValidEmail(email) {
        var pattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
        return pattern.test(email);
    }

    /**
     * Validate phone number
     */
    function isValidPhone(phone) {
        var pattern = /^[\d\s\-\(\)]+$/;
        return pattern.test(phone);
    }

    /**
     * AJAX form submission
     */
    $('.ajax-form').on('submit', function(e) {
        e.preventDefault();
        
        var $form = $(this);
        var formData = $form.serialize();
        var $submitButton = $form.find('button[type="submit"]');
        var buttonText = $submitButton.text();
        
        // Disable button and show loading state
        $submitButton.prop('disabled', true).text('Sending...');
        
        // Send AJAX request
        $.ajax({
            url: clearviewshield_vars.ajaxurl,
            type: 'POST',
            data: formData + '&action=clearviewshield_form_submit&nonce=' + clearviewshield_vars.nonce,
            success: function(response) {
                if (response.success) {
                    // Show success message
                    $form.html('<div class="alert alert-success">' + response.data.message + '</div>');
                } else {
                    // Show error message
                    $form.prepend('<div class="alert alert-danger">' + response.data.message + '</div>');
                    $submitButton.prop('disabled', false).text(buttonText);
                }
            },
            error: function() {
                // Show error message
                $form.prepend('<div class="alert alert-danger">An error occurred. Please try again later.</div>');
                $submitButton.prop('disabled', false).text(buttonText);
            }
        });
    });

    /**
     * Booking form enhancements
     */
    if ($('.bookly-form').length) {
        // Add custom fields to Bookly form
        $(document).on('bookly.render.step_details', function(event, details) {
            // Add vehicle information fields if they don't exist
            if ($('#bookly-vehicle-info').length === 0) {
                var vehicleFields = '<div id="bookly-vehicle-info" class="bookly-custom-fields-container">' +
                    '<h4>Vehicle Information</h4>' +
                    '<div class="bookly-custom-field">' +
                    '<label for="bookly-vehicle-make">Vehicle Make</label>' +
                    '<input type="text" id="bookly-vehicle-make" name="bookly_vehicle_make" required>' +
                    '</div>' +
                    '<div class="bookly-custom-field">' +
                    '<label for="bookly-vehicle-model">Vehicle Model</label>' +
                    '<input type="text" id="bookly-vehicle-model" name="bookly_vehicle_model" required>' +
                    '</div>' +
                    '<div class="bookly-custom-field">' +
                    '<label for="bookly-vehicle-year">Vehicle Year</label>' +
                    '<input type="text" id="bookly-vehicle-year" name="bookly_vehicle_year" required>' +
                    '</div>' +
                    '<div class="bookly-custom-field">' +
                    '<label for="bookly-damage-description">Damage Description</label>' +
                    '<textarea id="bookly-damage-description" name="bookly_damage_description" required></textarea>' +
                    '</div>' +
                    '</div>';
                
                $('.bookly-details-step').append(vehicleFields);
            }
        });
        
        // Add SMS consent checkbox
        $(document).on('bookly.render.step_details', function(event, details) {
            if ($('#bookly-sms-consent').length === 0) {
                var smsConsent = '<div id="bookly-sms-consent" class="bookly-custom-field">' +
                    '<label>' +
                    '<input type="checkbox" name="bookly_sms_consent" checked>' +
                    'I consent to receive SMS notifications about my appointment' +
                    '</label>' +
                    '</div>';
                
                $('.bookly-details-step').append(smsConsent);
            }
        });
    }

})(jQuery);
