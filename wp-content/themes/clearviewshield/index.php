<?php
/**
 * The main template file
 *
 * @package ClearViewShield
 */

get_header();
?>

<main id="primary" class="site-main">
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <h1 class="hero-headline">Fast Mobile Windshield Repair - $75, We Come to You!</h1>
            <p class="hero-pitch">Cracked windshield? We've got you—$75 fixes, lifetime warranty, your way. Call or book now!</p>
            
            <div class="promo-badge">First 5 Bookings - $10 Off!</div>
            
            <div class="cta-buttons">
                <a href="<?php echo esc_url(home_url('/booking')); ?>" class="btn btn-primary">Book Online</a>
                <a href="tel:3197750717" class="btn btn-outline">Call/Text 319-775-0717</a>
            </div>
            
            <div class="warranty-badge">
                <div class="warranty-badge-inner">
                    <span class="warranty-badge-text">Lifetime Warranty</span>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Before/After Section -->
    <section class="before-after-section">
        <div class="container">
            <h2 class="section-title">See Our Quality Repairs</h2>
            
            <div class="before-after-container">
                <?php
                // Display 3 before/after examples
                for ($i = 1; $i <= 3; $i++) :
                ?>
                <div class="before-after-item">
                    <div class="before-after-images">
                        <div class="before-image">
                            <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/before-after/before-' . $i . '.jpg'); ?>" alt="Before Repair">
                            <span class="image-label">Before</span>
                        </div>
                        <div class="after-image">
                            <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/before-after/after-' . $i . '.jpg'); ?>" alt="After Repair">
                            <span class="image-label">After</span>
                        </div>
                    </div>
                    <div class="before-after-text">
                        <p>Rock chip repair in Cedar Rapids, Iowa</p>
                    </div>
                </div>
                <?php endfor; ?>
            </div>
        </div>
    </section>
    
    <!-- About Section -->
    <section class="about-section">
        <div class="container">
            <h2 class="section-title">About ClearViewShield</h2>
            
            <div class="about-container">
                <div class="about-content">
                    <p>Since 2021, ClearViewShield has been serving Cedar Rapids, Marion, Hiawatha, and Linn County with professional mobile windshield repairs.</p>
                    <p>We come to your home or workplace to fix rock chips and cracks on the spot, saving you time and preventing further damage.</p>
                    <p>Our repairs are just $75 and backed by a lifetime warranty. We use professional-grade materials and techniques to ensure your windshield is safe and looks great.</p>
                    <p>Don't let that small chip turn into a costly replacement. Contact us today for fast, convenient service!</p>
                </div>
                <div class="about-image">
                    <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/repair-process.jpg'); ?>" alt="Windshield Repair Process">
                </div>
            </div>
        </div>
    </section>
    
    <!-- Blog Teaser Section -->
    <section class="blog-teaser-section">
        <div class="container">
            <h2 class="section-title">Windshield Repair Tips</h2>
            
            <div class="blog-teaser-container">
                <?php
                // Blog post titles and excerpts
$blog_posts = array(
    array(
        "title" => "Why Fix Rock Chips Fast",
        "excerpt" => "Learn why addressing rock chips quickly can save you money and prevent a full windshield replacement.",
        "image" => "blog-1.jpg"
    ),
    array(
        "title" => "Windshield Repair Dos and Don'ts",
        "excerpt" => "Follow these professional tips to maintain your windshield and know when it's time for a repair.",
        "image" => "blog-2.jpg"
    ),
    array(
        "title" => "How Our Lifetime Warranty Works",
        "excerpt" => "Discover the details of our lifetime warranty and how it protects your windshield repair investment.",
        "image" => "blog-3.jpg"
    )
);

foreach ($blog_posts as $post) :
?>
<div class="blog-teaser-item">
    <?php $image_url = esc_url(get_template_directory_uri() . '/assets/images/' . $post['image']); ?>
    <div class="blog-teaser-image" style="background-image: url('<?php echo $image_url; ?>')"></div>
    <div class="blog-teaser-content">
        <h3 class="blog-teaser-title"><?php echo esc_html($post['title']); ?></h3>
        <p class="blog-teaser-excerpt"><?php echo esc_html($post['excerpt']); ?></p>
        <a href="<?php echo esc_url(home_url('/blog')); ?>" class="read-more">Read More <i class="fas fa-arrow-right"></i></a>
    </div>
</div>
<?php endforeach; ?>
        "title" => "How Our Lifetime Warranty Works",
        "excerpt" => "Discover the details of our lifetime warranty and how it protects your windshield repair investment.",
        "image" => "blog-3.jpg"
    )
);
                        'title' => 'Windshield Repair Dos and Don\'ts',
                        'excerpt' => 'Follow these professional tips to maintain your windshield and know when it's time for a repair.',
                        'image' => 'blog-2.jpg'
                    ),
                    array(
                        'title' => 'How Our Lifetime Warranty Works',
                        'excerpt' => 'Discover the details of our lifetime warranty and how it protects your windshield repair investment.',
                        'image' => 'blog-3.jpg'
                    )
                );
                
                foreach ($blog_posts as $post) :
                ?>
                <div class="blog-teaser-item">
                    <div class="blog-teaser-image" style="background-image: url('<?php echo esc_url(get_template_directory_uri() . '/assets/images/' . $post['image']); ?>')"></div>
                    <div class="blog-teaser-content">
                        <h3 class="blog-teaser-title"><?php echo esc_html($post['title']); ?></h3>
                        <p class="blog-teaser-excerpt"><?php echo esc_html($post['excerpt']); ?></p>
                        <a href="#" class="read-more">Read More <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main><!-- #main -->

<?php
get_footer();
