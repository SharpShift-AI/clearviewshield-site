// Navigation JavaScript for ClearViewShield theme
jQuery(document).ready(function($) {
    // Mobile menu toggle
    $('.mobile-menu-toggle').click(function() {
        $(this).toggleClass('active');
        $('.main-navigation').toggleClass('active');
        
        // Update aria attributes for accessibility
        if ($(this).hasClass('active')) {
            $(this).attr('aria-expanded', 'true');
        } else {
            $(this).attr('aria-expanded', 'false');
        }
    });
    
    // Close mobile menu when clicking outside
    $(document).click(function(event) {
        if (!$(event.target).closest('.mobile-menu-toggle, .main-navigation').length) {
            $('.mobile-menu-toggle').removeClass('active');
            $('.main-navigation').removeClass('active');
            $('.mobile-menu-toggle').attr('aria-expanded', 'false');
        }
    });
    
    // Add dropdown functionality for submenus
    $('.menu-item-has-children > a').after('<span class="dropdown-toggle" aria-expanded="false"></span>');
    
    $('.dropdown-toggle').click(function(e) {
        e.preventDefault();
        $(this).toggleClass('active');
        $(this).next('.sub-menu').toggleClass('active');
        
        if ($(this).hasClass('active')) {
            $(this).attr('aria-expanded', 'true');
        } else {
            $(this).attr('aria-expanded', 'false');
        }
    });
    
    // Add active class to current menu item
    $('.current-menu-item, .current-menu-parent').addClass('active');
    
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
    
    // Add scroll class to header on scroll
    $(window).scroll(function() {
        if ($(this).scrollTop() > 50) {
            $('.site-header').addClass('scrolled');
        } else {
            $('.site-header').removeClass('scrolled');
        }
    });
    
    // Initialize on page load
    if ($(window).scrollTop() > 50) {
        $('.site-header').addClass('scrolled');
    }
});
