// Main JavaScript for ClearViewShield theme
jQuery(document).ready(function($) {
    // Mobile menu toggle
    $('.mobile-menu-toggle').click(function() {
        $('body').toggleClass('mobile-menu-active');
        $(this).attr('aria-expanded', $('body').hasClass('mobile-menu-active'));
    });
    
    // Smooth scroll for anchor links
    $('a[href*="#"]:not([href="#"])').click(function() {
        if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
            var target = $(this.hash);
            target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
            if (target.length) {
                $('html, body').animate({
                    scrollTop: target.offset().top - 80
                }, 1000);
                return false;
            }
        }
    });
    
    // Booking form validation
    $('#clearviewshield-booking-form').submit(function(e) {
        var form = $(this);
        var isValid = true;
        
        // Basic validation
        form.find('input[required], select[required], textarea[required]').each(function() {
            if (!$(this).val()) {
                $(this).addClass('error');
                isValid = false;
            } else {
                $(this).removeClass('error');
            }
        });
        
        // Phone validation
        var phone = form.find('#customer-phone');
        var phonePattern = /^\d{3}-\d{3}-\d{4}$/;
        if (phone.length && !phonePattern.test(phone.val())) {
            phone.addClass('error');
            isValid = false;
        }
        
        if (!isValid) {
            e.preventDefault();
            $('<div class="form-error">Please fill in all required fields correctly.</div>').insertBefore(form.find('.form-submit')).fadeOut(5000);
        }
    });
    
    // Before/After image hover effect
    $('.before-after-item').hover(
        function() {
            $(this).find('.image-label').addClass('hover');
        },
        function() {
            $(this).find('.image-label').removeClass('hover');
        }
    );
    
    // Add animation for warranty badge
    function animateWarrantyBadge() {
        $('.warranty-badge').addClass('pulse');
        setTimeout(function() {
            $('.warranty-badge').removeClass('pulse');
        }, 1000);
    }
    
    // Animate warranty badge periodically
    setInterval(animateWarrantyBadge, 5000);
    
    // Initialize on page load
    animateWarrantyBadge();
    
    // Highlight promo badge
    function highlightPromoBadge() {
        $('.promo-badge').addClass('highlight');
        setTimeout(function() {
            $('.promo-badge').removeClass('highlight');
        }, 1000);
    }
    
    // Highlight promo badge periodically
    setInterval(highlightPromoBadge, 7000);
    
    // Initialize on page load
    highlightPromoBadge();
    
    // Add scroll animations
    $(window).scroll(function() {
        var windowBottom = $(this).scrollTop() + $(this).innerHeight();
        
        $('.fade-in').each(function() {
            var objectBottom = $(this).offset().top + $(this).outerHeight();
            
            if (objectBottom < windowBottom) {
                if ($(this).css('opacity') == 0) {
                    $(this).fadeTo(500, 1);
                }
            }
        });
    }).scroll();
    
    // Add date picker enhancement for booking form
    if ($.fn.datepicker && $('#booking-date').length) {
        $('#booking-date').datepicker({
            minDate: 0,
            maxDate: '+2M',
            beforeShowDay: function(date) {
                var day = date.getDay();
                // Disable Sundays (0)
                return [day != 0, ''];
            }
        });
    }
    
    // Add phone formatter
    $('#customer-phone').on('input', function() {
        var input = $(this).val().replace(/\D/g, '');
        var formatted = '';
        
        if (input.length > 0) {
            formatted += input.substring(0, 3);
        }
        if (input.length > 3) {
            formatted += '-' + input.substring(3, 6);
        }
        if (input.length > 6) {
            formatted += '-' + input.substring(6, 10);
        }
        
        $(this).val(formatted);
    });
    
    // Add Google Maps integration for service area
    if ($('#service-area-map').length && typeof google !== 'undefined') {
        var map = new google.maps.Map(document.getElementById('service-area-map'), {
            center: {lat: 41.9779, lng: -91.6656},
            zoom: 10,
            styles: [
                {
                    featureType: 'all',
                    elementType: 'all',
                    stylers: [{color: '#f5f5f5'}]
                },
                {
                    featureType: 'road',
                    elementType: 'geometry',
                    stylers: [{color: '#ffffff'}]
                },
                {
                    featureType: 'water',
                    elementType: 'geometry',
                    stylers: [{color: '#c9c9c9'}]
                }
            ]
        });
        
        // Add Cedar Rapids marker
        var marker = new google.maps.Marker({
            position: {lat: 41.9779, lng: -91.6656},
            map: map,
            title: 'ClearViewShield Service Area',
            icon: {
                path: google.maps.SymbolPath.CIRCLE,
                scale: 10,
                fillColor: '#2061B7',
                fillOpacity: 1,
                strokeColor: '#ffffff',
                strokeWeight: 2
            }
        });
        
        // Add service area circle
        var serviceArea = new google.maps.Circle({
            strokeColor: '#2061B7',
            strokeOpacity: 0.8,
            strokeWeight: 2,
            fillColor: '#2061B7',
            fillOpacity: 0.1,
            map: map,
            center: {lat: 41.9779, lng: -91.6656},
            radius: 40233 // 25 miles in meters
        });
    }
});
