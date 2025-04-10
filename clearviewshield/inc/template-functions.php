<?php
/**
 * Custom template functions for ClearViewShield theme
 *
 * @package ClearViewShield
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function clearviewshield_body_classes_extended($classes) {
    // Add page slug as class
    global $post;
    if (isset($post)) {
        $classes[] = 'page-' . $post->post_name;
    }
    
    // Add class if sidebar is active
    if (is_active_sidebar('blog-sidebar')) {
        $classes[] = 'has-sidebar';
    } else {
        $classes[] = 'no-sidebar';
    }
    
    return $classes;
}
add_filter('body_class', 'clearviewshield_body_classes_extended');

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function clearviewshield_pingback_header() {
    if (is_singular() && pings_open()) {
        printf('<link rel="pingback" href="%s">', esc_url(get_bloginfo('pingback_url')));
    }
}
add_action('wp_head', 'clearviewshield_pingback_header');

/**
 * Adds custom classes to the array of post classes.
 *
 * @param array $classes Classes for the post element.
 * @return array
 */
function clearviewshield_post_classes($classes) {
    // Add 'has-post-thumbnail' class if post has thumbnail
    if (has_post_thumbnail()) {
        $classes[] = 'has-post-thumbnail';
    } else {
        $classes[] = 'no-post-thumbnail';
    }
    
    return $classes;
}
add_filter('post_class', 'clearviewshield_post_classes');

/**
 * Custom template for comments
 */
function clearviewshield_comment_template($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment;
    
    if ('div' === $args['style']) {
        $tag       = 'div';
        $add_below = 'comment';
    } else {
        $tag       = 'li';
        $add_below = 'div-comment';
    }
    ?>
    <<?php echo $tag; ?> <?php comment_class(empty($args['has_children']) ? '' : 'parent'); ?> id="comment-<?php comment_ID(); ?>">
    
    <?php if ('div' != $args['style']) : ?>
        <div id="div-comment-<?php comment_ID(); ?>" class="comment-body">
    <?php endif; ?>
    
        <div class="comment-author vcard">
            <?php if ($args['avatar_size'] != 0) echo get_avatar($comment, $args['avatar_size']); ?>
            <?php printf('<cite class="fn">%s</cite>', get_comment_author_link()); ?>
        </div>
        
        <div class="comment-meta commentmetadata">
            <a href="<?php echo htmlspecialchars(get_comment_link($comment->comment_ID)); ?>">
                <?php
                /* translators: 1: date, 2: time */
                printf(
                    __('%1$s at %2$s', 'clearviewshield'),
                    get_comment_date(),
                    get_comment_time()
                ); ?>
            </a>
            <?php edit_comment_link(__('(Edit)', 'clearviewshield'), '  ', ''); ?>
        </div>
        
        <?php if ($comment->comment_approved == '0') : ?>
            <em class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.', 'clearviewshield'); ?></em>
            <br />
        <?php endif; ?>
        
        <div class="comment-content">
            <?php comment_text(); ?>
        </div>
        
        <div class="reply">
            <?php
            comment_reply_link(
                array_merge(
                    $args,
                    array(
                        'add_below' => $add_below,
                        'depth'     => $depth,
                        'max_depth' => $args['max_depth']
                    )
                )
            ); ?>
        </div>
        
    <?php if ('div' != $args['style']) : ?>
        </div>
    <?php endif; ?>
    <?php
}

/**
 * Display post navigation
 */
function clearviewshield_post_navigation() {
    the_post_navigation(
        array(
            'prev_text' => '<span class="nav-subtitle">' . esc_html__('Previous:', 'clearviewshield') . '</span> <span class="nav-title">%title</span>',
            'next_text' => '<span class="nav-subtitle">' . esc_html__('Next:', 'clearviewshield') . '</span> <span class="nav-title">%title</span>',
        )
    );
}

/**
 * Display posts pagination
 */
function clearviewshield_posts_pagination() {
    the_posts_pagination(
        array(
            'mid_size'  => 2,
            'prev_text' => '<i class="fas fa-chevron-left"></i>',
            'next_text' => '<i class="fas fa-chevron-right"></i>',
        )
    );
}

/**
 * Display breadcrumbs
 */
function clearviewshield_breadcrumbs() {
    if (function_exists('yoast_breadcrumb')) {
        yoast_breadcrumb('<div class="breadcrumbs">', '</div>');
    } else {
        // Custom breadcrumbs if Yoast SEO is not active
        echo '<div class="breadcrumbs">';
        echo '<a href="' . esc_url(home_url('/')) . '">' . esc_html__('Home', 'clearviewshield') . '</a>';
        
        if (is_category() || is_single()) {
            echo ' » ';
            $categories = get_the_category();
            if ($categories) {
                echo '<a href="' . esc_url(get_category_link($categories[0]->term_id)) . '">' . esc_html($categories[0]->name) . '</a>';
            }
            
            if (is_single()) {
                echo ' » ';
                the_title();
            }
        } elseif (is_page()) {
            echo ' » ';
            the_title();
        } elseif (is_search()) {
            echo ' » ' . esc_html__('Search Results for: ', 'clearviewshield') . get_search_query();
        } elseif (is_404()) {
            echo ' » ' . esc_html__('404 Error', 'clearviewshield');
        }
        
        echo '</div>';
    }
}

/**
 * Display social sharing buttons
 */
function clearviewshield_social_sharing() {
    if (is_single()) {
        $post_url = urlencode(get_permalink());
        $post_title = urlencode(get_the_title());
        
        echo '<div class="social-sharing">';
        echo '<span class="share-title">' . esc_html__('Share:', 'clearviewshield') . '</span>';
        echo '<a href="https://www.facebook.com/sharer/sharer.php?u=' . $post_url . '" target="_blank" rel="nofollow" class="facebook"><i class="fab fa-facebook-f"></i></a>';
        echo '<a href="https://twitter.com/intent/tweet?url=' . $post_url . '&text=' . $post_title . '" target="_blank" rel="nofollow" class="twitter"><i class="fab fa-twitter"></i></a>';
        echo '<a href="https://www.linkedin.com/shareArticle?mini=true&url=' . $post_url . '&title=' . $post_title . '" target="_blank" rel="nofollow" class="linkedin"><i class="fab fa-linkedin-in"></i></a>';
        echo '<a href="mailto:?subject=' . $post_title . '&body=' . $post_url . '" class="email"><i class="fas fa-envelope"></i></a>';
        echo '</div>';
    }
}

/**
 * Display related posts
 */
function clearviewshield_related_posts() {
    if (is_single()) {
        $categories = get_the_category();
        
        if ($categories) {
            $category_ids = array();
            foreach ($categories as $category) {
                $category_ids[] = $category->term_id;
            }
            
            $args = array(
                'category__in'        => $category_ids,
                'post__not_in'        => array(get_the_ID()),
                'posts_per_page'      => 3,
                'ignore_sticky_posts' => 1,
            );
            
            $related_query = new WP_Query($args);
            
            if ($related_query->have_posts()) {
                echo '<div class="related-posts">';
                echo '<h3>' . esc_html__('Related Posts', 'clearviewshield') . '</h3>';
                echo '<div class="row">';
                
                while ($related_query->have_posts()) {
                    $related_query->the_post();
                    
                    echo '<div class="col-md-4">';
                    echo '<article class="related-post">';
                    
                    if (has_post_thumbnail()) {
                        echo '<div class="post-thumbnail">';
                        echo '<a href="' . esc_url(get_permalink()) . '">';
                        the_post_thumbnail('medium');
                        echo '</a>';
                        echo '</div>';
                    }
                    
                    echo '<h4 class="entry-title"><a href="' . esc_url(get_permalink()) . '">' . get_the_title() . '</a></h4>';
                    echo '<div class="entry-meta">' . get_the_date() . '</div>';
                    
                    echo '</article>';
                    echo '</div>';
                }
                
                echo '</div>';
                echo '</div>';
            }
            
            wp_reset_postdata();
        }
    }
}

/**
 * Display post author bio
 */
function clearviewshield_author_bio() {
    if (is_single() && get_the_author_meta('description')) {
        echo '<div class="author-bio">';
        echo '<div class="author-avatar">' . get_avatar(get_the_author_meta('ID'), 100) . '</div>';
        echo '<div class="author-content">';
        echo '<h4 class="author-name">' . esc_html__('About', 'clearviewshield') . ' ' . get_the_author() . '</h4>';
        echo '<p class="author-description">' . wp_kses_post(get_the_author_meta('description')) . '</p>';
        echo '<a href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '" class="author-link">' . esc_html__('View all posts by', 'clearviewshield') . ' ' . get_the_author() . '</a>';
        echo '</div>';
        echo '</div>';
    }
}

/**
 * Display featured image with proper markup
 */
function clearviewshield_post_thumbnail() {
    if (post_password_required() || is_attachment() || !has_post_thumbnail()) {
        return;
    }
    
    if (is_singular()) {
        echo '<div class="post-thumbnail">';
        the_post_thumbnail('large', array('class' => 'img-fluid'));
        echo '</div>';
    } else {
        echo '<div class="post-thumbnail">';
        echo '<a href="' . esc_url(get_permalink()) . '" aria-hidden="true" tabindex="-1">';
        the_post_thumbnail('medium', array(
            'class' => 'img-fluid',
            'alt'   => the_title_attribute(array('echo' => false)),
        ));
        echo '</a>';
        echo '</div>';
    }
}

/**
 * Display post meta information
 */
function clearviewshield_post_meta() {
    echo '<div class="entry-meta">';
    
    // Posted on
    $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
    if (get_the_time('U') !== get_the_modified_time('U')) {
        $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
    }
    
    $time_string = sprintf(
        $time_string,
        esc_attr(get_the_date(DATE_W3C)),
        esc_html(get_the_date()),
        esc_attr(get_the_modified_date(DATE_W3C)),
        esc_html(get_the_modified_date())
    );
    
    echo '<span class="posted-on"><i class="far fa-calendar-alt"></i> ' . $time_string . '</span>';
    
    // Author
    echo '<span class="byline"><i class="far fa-user"></i> <span class="author vcard"><a href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '">' . esc_html(get_the_author()) . '</a></span></span>';
    
    // Categories
    $categories_list = get_the_category_list(', ');
    if ($categories_list) {
        echo '<span class="cat-links"><i class="far fa-folder-open"></i> ' . $categories_list . '</span>';
    }
    
    // Comments
    if (!post_password_required() && (comments_open() || get_comments_number())) {
        echo '<span class="comments-link"><i class="far fa-comment"></i> ';
        comments_popup_link(
            esc_html__('Leave a comment', 'clearviewshield'),
            esc_html__('1 Comment', 'clearviewshield'),
            esc_html__('% Comments', 'clearviewshield')
        );
        echo '</span>';
    }
    
    echo '</div>';
}

/**
 * Display post tags
 */
function clearviewshield_post_tags() {
    $tags_list = get_the_tag_list('<div class="post-tags"><i class="fas fa-tags"></i> ', ', ', '</div>');
    if ($tags_list) {
        echo $tags_list;
    }
}

/**
 * Check if the current page is the booking page
 */
function clearviewshield_is_booking_page() {
    $booking_page_id = get_option('clearviewshield_booking_page_id');
    if ($booking_page_id && is_page($booking_page_id)) {
        return true;
    }
    return false;
}

/**
 * Get service areas as an array
 */
function clearviewshield_get_service_areas() {
    return array(
        'Cedar Rapids',
        'Marion',
        'Hiawatha',
        'Robins',
        'Fairfax',
        'Ely',
        'Swisher',
        'North Liberty',
        'Coralville',
        'Iowa City'
    );
}

/**
 * Get business hours as an array
 */
function clearviewshield_get_business_hours() {
    return array(
        'monday'    => array('08:00', '18:00'),
        'tuesday'   => array('08:00', '18:00'),
        'wednesday' => array('08:00', '18:00'),
        'thursday'  => array('08:00', '18:00'),
        'friday'    => array('08:00', '18:00'),
        'saturday'  => array('09:00', '16:00'),
        'sunday'    => array('closed', 'closed')
    );
}

/**
 * Format phone number for display
 */
function clearviewshield_format_phone($phone) {
    $phone = preg_replace('/[^0-9]/', '', $phone);
    if (strlen($phone) == 10) {
        return '(' . substr($phone, 0, 3) . ') ' . substr($phone, 3, 3) . '-' . substr($phone, 6);
    }
    return $phone;
}

/**
 * Get business phone number
 */
function clearviewshield_get_business_phone() {
    return '319-775-0717';
}

/**
 * Get business email
 */
function clearviewshield_get_business_email() {
    return 'info@clearviewshield.com';
}

/**
 * Get business address
 */
function clearviewshield_get_business_address() {
    return array(
        'street'  => '123 Main Street',
        'city'    => 'Cedar Rapids',
        'state'   => 'IA',
        'zip'     => '52401',
        'country' => 'US'
    );
}

/**
 * Get business social media profiles
 */
function clearviewshield_get_social_profiles() {
    return array(
        'facebook'  => 'https://www.facebook.com/clearviewshield',
        'instagram' => 'https://www.instagram.com/clearviewshield',
        'twitter'   => '',
        'linkedin'  => '',
        'youtube'   => ''
    );
}

/**
 * Display social media icons
 */
function clearviewshield_social_icons() {
    $profiles = clearviewshield_get_social_profiles();
    
    echo '<div class="social-icons">';
    
    foreach ($profiles as $platform => $url) {
        if (!empty($url)) {
            echo '<a href="' . esc_url($url) . '" target="_blank" rel="noopener noreferrer" class="' . esc_attr($platform) . '">';
            echo '<i class="fab fa-' . esc_attr($platform) . '"></i>';
            echo '</a>';
        }
    }
    
    echo '</div>';
}

/**
 * Display contact information
 */
function clearviewshield_contact_info() {
    $phone = clearviewshield_get_business_phone();
    $email = clearviewshield_get_business_email();
    $address = clearviewshield_get_business_address();
    
    echo '<div class="contact-info">';
    
    if ($phone) {
        echo '<div class="contact-phone">';
        echo '<i class="fas fa-phone"></i> ';
        echo '<a href="tel:' . preg_replace('/[^0-9]/', '', $phone) . '">' . esc_html(clearviewshield_format_phone($phone)) . '</a>';
        echo '</div>';
    }
    
    if ($email) {
        echo '<div class="contact-email">';
        echo '<i class="fas fa-envelope"></i> ';
        echo '<a href="mailto:' . antispambot($email) . '">' . antispambot($email) . '</a>';
        echo '</div>';
    }
    
    if ($address) {
        echo '<div class="contact-address">';
        echo '<i class="fas fa-map-marker-alt"></i> ';
        echo esc_html($address['street']) . ', ';
        echo esc_html($address['city']) . ', ';
        echo esc_html($address['state']) . ' ';
        echo esc_html($address['zip']);
        echo '</div>';
    }
    
    echo '</div>';
}

/**
 * Display business hours
 */
function clearviewshield_business_hours() {
    $hours = clearviewshield_get_business_hours();
    $days = array(
        'monday'    => __('Monday', 'clearviewshield'),
        'tuesday'   => __('Tuesday', 'clearviewshield'),
        'wednesday' => __('Wednesday', 'clearviewshield'),
        'thursday'  => __('Thursday', 'clearviewshield'),
        'friday'    => __('Friday', 'clearviewshield'),
        'saturday'  => __('Saturday', 'clearviewshield'),
        'sunday'    => __('Sunday', 'clearviewshield')
    );
    
    echo '<div class="business-hours">';
    
    foreach ($hours as $day => $time) {
        echo '<div class="hours-row">';
        echo '<span class="day">' . esc_html($days[$day]) . '</span>';
        
        if ($time[0] === 'closed') {
            echo '<span class="time">' . esc_html__('Closed', 'clearviewshield') . '</span>';
        } else {
            echo '<span class="time">' . esc_html($time[0]) . ' - ' . esc_html($time[1]) . '</span>';
        }
        
        echo '</div>';
    }
    
    echo '</div>';
}

/**
 * Display a call to action button
 */
function clearviewshield_cta_button($text = 'Book Now', $url = '', $class = 'btn-cta') {
    if (empty($url)) {
        $url = home_url('/booking/');
    }
    
    echo '<a href="' . esc_url($url) . '" class="btn ' . esc_attr($class) . '">' . esc_html($text) . '</a>';
}

/**
 * Display the price tag
 */
function clearviewshield_price_tag($price = '75', $class = 'price-tag') {
    echo '<span class="' . esc_attr($class) . '">$' . esc_html($price) . '</span>';
}

/**
 * Display the warranty badge
 */
function clearviewshield_warranty_badge($class = 'warranty-badge') {
    echo '<div class="' . esc_attr($class) . '">';
    echo '<span class="warranty-title">' . esc_html__('Lifetime', 'clearviewshield') . '</span>';
    echo '<span class="warranty-value">' . esc_html__('Warranty', 'clearviewshield') . '</span>';
    echo '</div>';
}

/**
 * Display a section heading with optional subtitle
 */
function clearviewshield_section_heading($title, $subtitle = '', $class = '') {
    echo '<div class="section-heading ' . esc_attr($class) . '">';
    echo '<h2>' . esc_html($title) . '</h2>';
    
    if (!empty($subtitle)) {
        echo '<p class="lead">' . esc_html($subtitle) . '</p>';
    }
    
    echo '</div>';
}

/**
 * Get Google Maps embed code
 */
function clearviewshield_google_map($address = '') {
    if (empty($address)) {
        $addr = clearviewshield_get_business_address();
        $address = $addr['street'] . ', ' . $addr['city'] . ', ' . $addr['state'] . ' ' . $addr['zip'];
    }
    
    $address = urlencode($address);
    
    return '<div class="google-map"><iframe width="100%" height="450" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/place?key=YOUR_API_KEY&q=' . $address . '" allowfullscreen></iframe></div>';
}

/**
 * Display a responsive video embed
 */
function clearviewshield_video_embed($url) {
    // Extract video ID from YouTube URL
    if (preg_match('/youtube\.com\/watch\?v=([a-zA-Z0-9_-]+)/', $url, $matches) || preg_match('/youtu\.be\/([a-zA-Z0-9_-]+)/', $url, $matches)) {
        $video_id = $matches[1];
        
        echo '<div class="video-container">';
        echo '<iframe width="560" height="315" src="https://www.youtube.com/embed/' . esc_attr($video_id) . '" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
        echo '</div>';
    } else {
        echo '<div class="video-container">';
        echo wp_oembed_get($url);
        echo '</div>';
    }
}

/**
 * Display a before/after slider
 */
function clearviewshield_before_after_slider($before_img, $after_img, $title = '') {
    echo '<div class="before-after-slider">';
    
    if (!empty($title)) {
        echo '<h4 class="slider-title">' . esc_html($title) . '</h4>';
    }
    
    echo '<img src="' . esc_url($before_img) . '" alt="Before repair" class="before-image img-fluid">';
    echo '<img src="' . esc_url($after_img) . '" alt="After repair" class="after-image img-fluid">';
    echo '<div class="slider-handle"></div>';
    
    echo '</div>';
}

/**
 * Display a service card
 */
function clearviewshield_service_card($title, $description, $icon, $price = '75', $link = '') {
    if (empty($link)) {
        $link = home_url('/booking/');
    }
    
    echo '<div class="service-card">';
    
    echo '<div class="service-icon">';
    echo '<i class="' . esc_attr($icon) . '"></i>';
    echo '</div>';
    
    echo '<h3 class="service-title">' . esc_html($title) . '</h3>';
    echo '<p class="service-description">' . esc_html($description) . '</p>';
    
    if (!empty($price)) {
        echo '<p><strong>Price: ';
        clearviewshield_price_tag($price);
        echo '</strong></p>';
    }
    
    echo '<a href="' . esc_url($link) . '" class="btn">Book Repair</a>';
    
    echo '</div>';
}

/**
 * Display a testimonial card
 */
function clearviewshield_testimonial_card($content, $author, $location = '', $rating = 5) {
    echo '<div class="testimonial-card">';
    
    echo '<div class="testimonial-rating">';
    for ($i = 1; $i <= 5; $i++) {
        if ($i <= $rating) {
            echo '<i class="fas fa-star"></i>';
        } else {
            echo '<i class="far fa-star"></i>';
        }
    }
    echo '</div>';
    
    echo '<div class="testimonial-content">';
    echo '"' . esc_html($content) . '"';
    echo '</div>';
    
    echo '<div class="testimonial-author">';
    echo '- ' . esc_html($author);
    
    if (!empty($location)) {
        echo ', ' . esc_html($location);
    }
    
    echo '</div>';
    
    echo '</div>';
}

/**
 * Display a process card
 */
function clearviewshield_process_card($number, $title, $description, $icon) {
    echo '<div class="process-card">';
    
    echo '<div class="process-icon">';
    echo '<span class="process-number">' . esc_html($number) . '</span>';
    echo '<i class="' . esc_attr($icon) . '"></i>';
    echo '</div>';
    
    echo '<h3 class="process-title">' . esc_html($title) . '</h3>';
    echo '<p>' . esc_html($description) . '</p>';
    
    echo '</div>';
}

/**
 * Display a feature item
 */
function clearviewshield_feature_item($title, $description, $icon = 'fas fa-check-circle text-success') {
    echo '<div class="feature-item">';
    echo '<h4><i class="' . esc_attr($icon) . '"></i> ' . esc_html($title) . '</h4>';
    echo '<p>' . esc_html($description) . '</p>';
    echo '</div>';
}

/**
 * Display a pricing box
 */
function clearviewshield_pricing_box($title, $price, $features = array(), $button_text = 'Book Now', $button_link = '') {
    if (empty($button_link)) {
        $button_link = home_url('/booking/');
    }
    
    echo '<div class="pricing-box" data-monthly-price="' . esc_attr($price) . '" data-annual-price="' . esc_attr($price * 12) . '">';
    
    echo '<h3 class="pricing-title">' . esc_html($title) . '</h3>';
    echo '<div class="pricing-price">$' . esc_html($price) . '</div>';
    
    if (!empty($features)) {
        echo '<ul class="pricing-features">';
        foreach ($features as $feature) {
            echo '<li>' . esc_html($feature) . '</li>';
        }
        echo '</ul>';
    }
    
    echo '<a href="' . esc_url($button_link) . '" class="btn">' . esc_html($button_text) . '</a>';
    
    echo '</div>';
}

/**
 * Display a FAQ item
 */
function clearviewshield_faq_item($question, $answer, $accordion_id, $item_id, $is_open = false) {
    echo '<div class="card">';
    
    echo '<div class="card-header" id="heading' . esc_attr($item_id) . '">';
    echo '<h5 class="mb-0">';
    echo '<button class="btn btn-link' . ($is_open ? '' : ' collapsed') . '" type="button" data-toggle="collapse" data-target="#collapse' . esc_attr($item_id) . '" aria-expanded="' . ($is_open ? 'true' : 'false') . '" aria-controls="collapse' . esc_attr($item_id) . '">';
    echo esc_html($question);
    echo '</button>';
    echo '</h5>';
    echo '</div>';
    
    echo '<div id="collapse' . esc_attr($item_id) . '" class="collapse' . ($is_open ? ' show' : '') . '" aria-labelledby="heading' . esc_attr($item_id) . '" data-parent="#' . esc_attr($accordion_id) . '">';
    echo '<div class="card-body">';
    echo esc_html($answer);
    echo '</div>';
    echo '</div>';
    
    echo '</div>';
}

/**
 * Display a sidebar widget
 */
function clearviewshield_sidebar_widget($title, $content) {
    echo '<div class="sidebar-widget">';
    echo '<h3>' . esc_html($title) . '</h3>';
    echo $content;
    echo '</div>';
}

/**
 * Display a check list
 */
function clearviewshield_check_list($items, $class = 'check-list') {
    echo '<ul class="' . esc_attr($class) . '">';
    
    foreach ($items as $item) {
        echo '<li>' . esc_html($item) . '</li>';
    }
    
    echo '</ul>';
}

/**
 * Display a booking form
 */
function clearviewshield_booking_form() {
    if (function_exists('bookly_shortcode')) {
        echo bookly_shortcode(array());
    } else {
        // Fallback form
        echo '<div id="fallback-booking-form">';
        echo '<form id="manual-booking-form" class="ajax-form">';
        echo '<input type="hidden" name="action" value="clearviewshield_booking_submit">';
        wp_nonce_field('clearviewshield_booking_nonce', 'booking_nonce');
        
        // Form content is in booking-template.php
        
        echo '</form>';
        echo '</div>';
    }
}

/**
 * Display a contact form
 */
function clearviewshield_contact_form() {
    if (function_exists('wpforms_display')) {
        wpforms_display(123); // Replace with your form ID
    } else {
        // Fallback form
        echo '<form id="contact-form" class="ajax-form">';
        echo '<input type="hidden" name="action" value="clearviewshield_contact_submit">';
        wp_nonce_field('clearviewshield_contact_nonce', 'contact_nonce');
        
        echo '<div class="form-group">';
        echo '<label for="contact-name" class="form-label">Name</label>';
        echo '<input type="text" id="contact-name" name="contact_name" class="form-control" required>';
        echo '</div>';
        
        echo '<div class="form-group">';
        echo '<label for="contact-email" class="form-label">Email</label>';
        echo '<input type="email" id="contact-email" name="contact_email" class="form-control" required>';
        echo '</div>';
        
        echo '<div class="form-group">';
        echo '<label for="contact-phone" class="form-label">Phone</label>';
        echo '<input type="tel" id="contact-phone" name="contact_phone" class="form-control">';
        echo '</div>';
        
        echo '<div class="form-group">';
        echo '<label for="contact-message" class="form-label">Message</label>';
        echo '<textarea id="contact-message" name="contact_message" class="form-control" rows="5" required></textarea>';
        echo '</div>';
        
        echo '<button type="submit" class="btn">Send Message</button>';
        
        echo '</form>';
    }
}

/**
 * Display a newsletter signup form
 */
function clearviewshield_newsletter_form() {
    echo '<form id="newsletter-form" class="ajax-form">';
    echo '<input type="hidden" name="action" value="clearviewshield_newsletter_submit">';
    wp_nonce_field('clearviewshield_newsletter_nonce', 'newsletter_nonce');
    
    echo '<div class="form-group">';
    echo '<label for="newsletter-email" class="form-label">Subscribe to our newsletter</label>';
    echo '<div class="input-group">';
    echo '<input type="email" id="newsletter-email" name="newsletter_email" class="form-control" placeholder="Your email address" required>';
    echo '<div class="input-group-append">';
    echo '<button type="submit" class="btn">Subscribe</button>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
    
    echo '</form>';
}

/**
 * Display a call to action section
 */
function clearviewshield_cta_section($title, $description, $button_text = 'Book Now', $button_link = '', $phone = true) {
    echo '<section class="cta-section">';
    echo '<div class="container">';
    echo '<div class="row">';
    echo '<div class="col-lg-10 mx-auto fade-in">';
    
    echo '<h2 class="cta-title">' . esc_html($title) . '</h2>';
    echo '<p class="cta-description">' . esc_html($description) . '</p>';
    
    clearviewshield_cta_button($button_text, $button_link, 'btn-cta');
    
    if ($phone) {
        echo '<p class="mt-3">Or call us at <a href="tel:' . preg_replace('/[^0-9]/', '', clearviewshield_get_business_phone()) . '" class="text-white"><strong>' . esc_html(clearviewshield_format_phone(clearviewshield_get_business_phone())) . '</strong></a></p>';
    }
    
    echo '</div>';
    echo '</div>';
    echo '</div>';
    echo '</section>';
}

/**
 * Get page ID by template
 */
function clearviewshield_get_page_by_template($template) {
    $pages = get_pages(array(
        'meta_key' => '_wp_page_template',
        'meta_value' => $template
    ));
    
    if (!empty($pages)) {
        return $pages[0]->ID;
    }
    
    return false;
}

/**
 * Get booking page URL
 */
function clearviewshield_get_booking_url() {
    $booking_page_id = get_option('clearviewshield_booking_page_id');
    
    if (!$booking_page_id) {
        $booking_page_id = clearviewshield_get_page_by_template('templates/booking-template.php');
        
        if ($booking_page_id) {
            update_option('clearviewshield_booking_page_id', $booking_page_id);
        }
    }
    
    if ($booking_page_id) {
        return get_permalink($booking_page_id);
    }
    
    return home_url('/booking/');
}

/**
 * Get services page URL
 */
function clearviewshield_get_services_url() {
    $services_page = get_page_by_path('services');
    
    if ($services_page) {
        return get_permalink($services_page->ID);
    }
    
    return home_url('/services/');
}

/**
 * Get about page URL
 */
function clearviewshield_get_about_url() {
    $about_page = get_page_by_path('about');
    
    if ($about_page) {
        return get_permalink($about_page->ID);
    }
    
    return home_url('/about/');
}

/**
 * Get contact page URL
 */
function clearviewshield_get_contact_url() {
    $contact_page = get_page_by_path('contact');
    
    if ($contact_page) {
        return get_permalink($contact_page->ID);
    }
    
    return home_url('/contact/');
}

/**
 * Get FAQ page URL
 */
function clearviewshield_get_faq_url() {
    $faq_page = get_page_by_path('faq');
    
    if ($faq_page) {
        return get_permalink($faq_page->ID);
    }
    
    return home_url('/faq/');
}

/**
 * Get terms page URL
 */
function clearviewshield_get_terms_url() {
    $terms_page = get_page_by_path('terms-of-service');
    
    if ($terms_page) {
        return get_permalink($terms_page->ID);
    }
    
    return home_url('/terms-of-service/');
}

/**
 * Get privacy page URL
 */
function clearviewshield_get_privacy_url() {
    $privacy_page = get_page_by_path('privacy-policy');
    
    if ($privacy_page) {
        return get_permalink($privacy_page->ID);
    }
    
    return home_url('/privacy-policy/');
}

add_shortcode('vehicle_booking_form', 'clearviewshield_vehicle_booking_form_shortcode');
function clearviewshield_vehicle_booking_form_shortcode() {
    ob_start();
    ?>
    <div class="vehicle-booking-wrapper">
        <!-- Step 1: Enter Details -->
        <div id="vehicle-step" class="booking-step active">
            <h3>Book Your Windshield Repair</h3>
            <p>Enter your vehicle and appointment details to schedule your $75 repair.</p>
            <div id="booking-error" class="alert alert-danger" style="display: none;"></div>
            <form id="custom-booking-form" class="custom-vehicle-form" enctype="multipart/form-data">
                <!-- Vehicle Details -->
                <div class="form-group">
                    <label for="vehicle-make">Vehicle Make *</label>
                    <input type="text" id="vehicle-make" name="vehicle_make" required>
                </div>
                <div class="form-group">
                    <label for="vehicle-model">Vehicle Model *</label>
                    <input type="text" id="vehicle-model" name="vehicle_model" required>
                </div>
                <div class="form-group">
                    <label for="vehicle-year">Vehicle Year *</label>
                    <input type="text" id="vehicle-year" name="vehicle_year" required>
                </div>
                <div class="form-group">
                    <label for="vehicle-color">Vehicle Color *</label>
                    <input type="text" id="vehicle-color" name="vehicle_color" required>
                </div>
                <div class="form-group">
                    <label for="license-plate">License Plate Number (optional)</label>
                    <input type="text" id="license-plate" name="license_plate">
                </div>
                <!-- Service Selection -->
                <div class="form-group">
                    <label for="service">Service *</label>
                    <select id="service" name="service" required>
                        <option value="">Select a service</option>
                        <?php
                        // Fetch services from Bookly (or a custom table if we create one)
                        if (class_exists('Bookly\Lib\Entities\Service')) {
                            $services = Bookly\Lib\Entities\Service::query()->fetchArray();
                            foreach ($services as $service) {
                                echo '<option value="' . esc_attr($service['id']) . '">' . esc_html($service['title']) . ' - $' . esc_html($service['price']) . '</option>';
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="damage-location">Damage Location *</label>
                    <select id="damage-location" name="damage_location" required>
                        <option value="">Select a location</option>
                        <option value="driver-side">Driver Side</option>
                        <option value="passenger-side">Passenger Side</option>
                        <option value="center">Center</option>
                    </select>
                </div>
                <!-- Photo Upload -->
                <div class="form-group">
                    <label for="damage-photo">Photo of Damage (optional)</label>
                    <p style="font-size: 14px; color: #666;">Please take a clear photo of the damage about 12" away while using your finger or another object to point at the damage to help your camera focus. Good lighting helps!</p>
                    <p id="camera-note" style="font-size: 14px; color: #666; display: none;">On mobile, clicking below will open your camera app to take a photo.</p>
                    <input type="file" id="damage-photo" name="damage_photo" accept="image/*" capture="camera">
                </div>
                <!-- Date and Time -->
                <div class="form-group">
                    <label for="booking-date">Preferred Date *</label>
                    <input type="date" id="booking-date" name="booking_date" required min="<?php echo date('Y-m-d'); ?>">
                </div>
                <div class="form-group">
                    <label for="booking-time">Preferred Time *</label>
                    <select id="booking-time" name="booking_time" required>
                        <option value="">Select a time</option>
                        <!-- Times will be populated dynamically via JavaScript -->
                    </select>
                    <div id="time-loading" style="display: none; font-size: 14px; color: #666; margin-top: 5px;">Loading available times...</div>
                </div>
                <!-- Customer Info -->
                <div class="form-group">
                    <label for="customer-name">Full Name *</label>
                    <input type="text" id="customer-name" name="customer_name" required>
                </div>
                <div class="form-group">
                    <label for="customer-email">Email Address *</label>
                    <input type="email" id="customer-email" name="customer_email" required>
                </div>
                <div class="form-group">
                    <label for="customer-phone">Phone Number *</label>
                    <input type="tel" id="customer-phone" name="customer_phone" required>
                </div>
                <div class="form-group">
                    <label for="customer-address">Service Address * <span style="font-size: 14px; color: #666;">(We come to you!)</span></label>
                    <input type="text" id="customer-address" name="customer_address" required placeholder="Street address">
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <input type="text" id="customer-city" name="customer_city" class="form-control" required placeholder="City">
                    </div>
                    <div class="form-group col-md-3">
                        <input type="text" id="customer-state" name="customer_state" class="form-control" required placeholder="State" value="IA">
                    </div>
                    <div class="form-group col-md-3">
                        <input type="text" id="customer-zip" name="customer_zip" class="form-control" required placeholder="Zip">
                    </div>
                </div>
                <div class="form-group">
                    <label for="contact-method">Preferred Contact Method *</label>
                    <select id="contact-method" name="contact_method" required>
                        <option value="">Select a method</option>
                        <option value="email">Email</option>
                        <option value="phone">Phone</option>
                        <option value="sms">SMS/Text</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="additional-comments">Additional Comments</label>
                    <textarea id="additional-comments" name="additional_comments" rows="3"></textarea>
                </div>
                <div class="form-group">
                    <label for="referral-source">How Did You Hear About Us? (optional)</label>
                    <select id="referral-source" name="referral_source">
                        <option value="">Select a source</option>
                        <option value="google-search">Google Search</option>
                        <option value="referral">Referral</option>
                        <option value="social-media">Social Media</option>
                        <option value="other">Other</option>
                    </select>
                </div>
                <!-- SMS Opt-In -->
                <div class="form-group">
                    <div class="custom-control custom-checkbox" style="padding: 10px; background-color: #f8f9fa; border-radius: 4px;">
                        <input type="checkbox" class="custom-control-input" id="sms-consent" name="sms_consent" style="width: 18px; height: 18px; border: 1px solid #666;">
                        <label class="custom-control-label" for="sms-consent" style="font-weight: 500;">I consent to receive SMS Text Notifications about my appointment. <a href="https://clearviewshield.com/sms-terms/" target="_blank" style="color: #0056b3;">(SMS Terms)</a></label>
                    </div>
                </div>
                <!-- Terms and Conditions -->
                <div class="form-group">
                    <div class="custom-control custom-checkbox" style="padding: 10px; background-color: #f8f9fa; border-radius: 4px;">
                        <input type="checkbox" class="custom-control-input" id="terms-consent" name="terms_consent" required style="width: 18px; height: 18px; border: 1px solid #666;">
                        <label class="custom-control-label" for="terms-consent" style="font-weight: 500;">I agree to the <a href="<?php echo esc_url(home_url('/terms-of-service/')); ?>" target="_blank" style="color: #0056b3;">Terms of Service</a> *</label>
                    </div>
                </div>
                <button type="button" class="btn btn-primary" onclick="showConfirmation()">Review Appointment</button>
            </form>
        </div>

        <!-- Step 2: Confirmation Step -->
        <div id="confirmation-step" class="booking-step" style="display: none;">
            <h3>Review Your Appointment</h3>
            <p>Please confirm the details below before submitting your booking.</p>
            <div id="confirmation-details" style="margin-bottom: 20px; font-size: 14px; border: 1px solid #e0e0e0; padding: 15px; border-radius: 5px; background-color: #f9f9f9;">
                <div style="margin-bottom: 10px;">
                    <strong>Appointment Date/Time:</strong> <span id="confirm-date-time"></span>
                </div>
                <hr style="border: 0; border-top: 1px solid #bbb; margin: 10px 0;">
                <div style="margin-bottom: 10px;">
                    <strong>Service Address:</strong> <span id="confirm-address"></span>
                </div>
                <hr style="border: 0; border-top: 1px solid #bbb; margin: 10px 0;">
                <div style="margin-bottom: 10px;">
                    <strong>Service:</strong> <span id="confirm-service"></span>
                </div>
                <hr style="border: 0; border-top: 1px solid #bbb; margin: 10px 0;">
                <div style="margin-bottom: 10px;">
                    <strong>Vehicle:</strong> <span id="confirm-vehicle"></span>
                </div>
                <hr style="border: 0; border-top: 1px solid #bbb; margin: 10px 0;">
                <div style="margin-bottom: 10px;">
                    <strong>Damage Location:</strong> <span id="confirm-damage-location"></span>
                </div>
                <hr style="border: 0; border-top: 1px solid #bbb; margin: 10px 0;">
                <div style="margin-bottom: 10px;">
                    <strong>Customer:</strong>
                    <div id="confirm-customer" style="margin-top: 5px;"></div>
                </div>
                <hr style="border: 0; border-top: 1px solid #bbb; margin: 10px 0;">
                <div style="margin-bottom: 10px;">
                    <strong>Additional Comments:</strong> <span id="confirm-comments"></span>
                </div>
                <hr style="border: 0; border-top: 1px solid #bbb; margin: 10px 0;">
                <div style="margin-bottom: 10px;">
                    <strong>How Did You Hear About Us:</strong> <span id="confirm-referral"></span>
                </div>
                <hr style="border: 0; border-top: 1px solid #bbb; margin: 10px 0;">
                <div style="margin-bottom: 10px;">
                    <strong>Photo of Damage:</strong> <span id="confirm-photo"></span>
                </div>
                <hr style="border: 0; border-top: 1px solid #bbb; margin: 10px 0;">
                <div style="margin-bottom: 10px;">
                    <strong>SMS Notifications:</strong> <span id="confirm-sms"></span>
                </div>
            </div>
            <div style="display: flex; gap: 10px;">
                <button type="button" class="btn btn-secondary" onclick="editDetails()" style="flex: 1; background-color: #6c757d; border-color: #6c757d; font-size: 16px;">Edit Details</button>
                <button type="button" class="btn btn-primary" id="confirm-booking-btn" onclick="submitBooking()" style="flex: 1; font-size: 16px; position: relative;">
                    <span id="confirm-btn-text">Confirm Booking</span>
                    <span id="confirm-btn-loading" style="display: none;">Processing...</span>
                </button>
            </div>
        </div>

        <!-- Step 3: Success Step -->
        <div id="success-step" class="booking-step" style="display: none;">
            <div id="booking-success" class="alert alert-success"></div>
            <div id="calendar-options" style="margin-top: 20px;">
                <h4>Add to Your Calendar</h4>
                <select id="calendar-select" onchange="if(this.value) window.open(this.value, '_blank');">
                    <option value="">Select a Calendar</option>
                    <option value="" data-ics="true">Download .ics File (Apple, Outlook, etc.)</option>
                    <option value="" data-google="true">Google Calendar</option>
                    <option value="" data-yahoo="true">Yahoo Calendar</option>
                </select>
            </div>
            <div style="margin-top: 20px;">
                <h4>What Happens Next</h4>
                <p>We will review your appointment details and confirm availability. You will receive a confirmation email or SMS (if opted in) with further instructions. If you need to cancel or reschedule, please do so at least 2 hours before your appointment time to avoid a cancellation fee.</p>
            </div>
        </div>
    </div>
    <style>
        /* Improve dropdown visibility on mobile */
        @media only screen and (max-width: 767px) {
            select {
                border: 2px solid #0056b3 !important;
                background-color: #f8f9fa !important;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2) !important;
                padding: 10px !important;
                font-size: 16px !important;
            }
        }
        /* Highlight missing fields */
        .field-error {
            border: 2px solid #dc3545 !important;
            background-color: #fff5f5 !important;
        }
    </style>
    <script>
    jQuery(document).ready(function($) {
        let formData = {};

        // Detect if the user is on a mobile device
        var isMobile = /iPhone|iPad|iPod|Android/i.test(navigator.userAgent);
        if (isMobile) {
            $('#camera-note').show();
        }

        // Close date picker on desktop when clicking outside
        $(document).on('click', function(e) {
            if (!$(e.target).closest('#booking-date').length) {
                $('#booking-date').blur();
            }
        });

        // Function to show the confirmation step
        window.showConfirmation = function() {
            var $form = $('#custom-booking-form');
            var missingFields = [];

            // Clear previous error highlights
            $form.find('[required]').removeClass('field-error');

            // Check required fields
            $form.find('[required]').each(function() {
                if (!$(this).val().trim() && $(this).attr('type') !== 'checkbox') {
                    missingFields.push($(this).prev('label').text().replace('*', '').trim());
                    $(this).addClass('field-error');
                }
                if ($(this).attr('type') === 'checkbox' && !$(this).is(':checked')) {
                    missingFields.push($(this).next('label').text().replace('*', '').trim());
                    $(this).closest('.custom-control').addClass('field-error');
                }
            });

            if (missingFields.length > 0) {
                $('#booking-error').text('Please fill in the following required fields: ' + missingFields.join(', ')).show();
                window.scrollTo(0, 0);
                return;
            }
            $('#booking-error').hide();

            // Collect form data
            formData = new FormData($form[0]);
            formData.append('action', 'clearviewshield_book_appointment');
            formData.append('nonce', '<?php echo wp_create_nonce('clearviewshield_book_appointment_nonce'); ?>');
            formData.append('customer_address', $('#customer-address').val() + ', ' + $('#customer-city').val() + ', ' + $('#customer-state').val() + ' ' + $('#customer-zip').val());
            formData.append('sms_consent', $('#sms-consent').is(':checked') ? 'yes' : 'no');

            // Reformat the date to MM/DD/YYYY
            var rawDate = $('#booking-date').val();
            var dateParts = rawDate.split('-');
            var formattedDate = dateParts[1] + '/' + dateParts[2] + '/' + dateParts[0];

            // Populate confirmation details
            $('#confirm-date-time').text(formattedDate + ' at ' + $('#booking-time option:selected').text());
            $('#confirm-address').text($('#customer-address').val() + ', ' + $('#customer-city').val() + ', ' + $('#customer-state').val() + ' ' + $('#customer-zip').val());
            $('#confirm-service').text($('#service option:selected').text());
            $('#confirm-vehicle').text($('#vehicle-make').val() + ' ' + $('#vehicle-model').val() + ' (' + $('#vehicle-year').val() + '), Color: ' + $('#vehicle-color').val() + ', License Plate: ' + ($('#license-plate').val() || 'N/A'));
            $('#confirm-damage-location').text($('#damage-location option:selected').text());
            $('#confirm-customer').html($('#customer-name').val() + '<br>' + $('#customer-email').val() + '<br>' + $('#customer-phone').val() + '<br>Preferred Contact Method: ' + $('#contact-method option:selected').text());
            $('#confirm-comments').text($('#additional-comments').val() || 'N/A');
            $('#confirm-referral').text($('#referral-source option:selected').text() || 'N/A');
            $('#confirm-photo').text($('#damage-photo').val() ? 'Uploaded' : 'Not provided');
            $('#confirm-sms').text($('#sms-consent').is(':checked') ? 'Yes' : 'No');

            // Show confirmation step
            $('#vehicle-step').hide();
            $('#confirmation-step').show();
            window.scrollTo(0, 0);
        };

        // Function to go back to editing
        window.editDetails = function() {
            $('#confirmation-step').hide();
            $('#vehicle-step').show();
            window.scrollTo(0, 0);
        };

        // Function to submit the booking
        window.submitBooking = function() {
            // Show loading state and disable the button
            $('#confirm-btn-text').hide();
            $('#confirm-btn-loading').show();
            $('#confirm-booking-btn').prop('disabled', true);

            $.ajax({
                url: '<?php echo admin_url('admin-ajax.php'); ?>',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    // Handle the "ad" prefix if present
                    var cleanResponse = response;
                    if (typeof response === 'string' && response.startsWith('ad')) {
                        cleanResponse = JSON.parse(response.substring(2));
                    } else if (typeof response === 'string') {
                        cleanResponse = JSON.parse(response);
                    }

                    if (cleanResponse.success) {
                        $('#booking-success').text('Booking confirmed! Add it to your calendar below.').show();
                        $('#confirmation-step').hide();
                        $('#success-step').show();
                        window.scrollTo(0, 0);

                        // Store appointment details for calendar links
                        var appointmentDetails = {
                            start_datetime: cleanResponse.data.start_datetime,
                            end_datetime: cleanResponse.data.end_datetime,
                            customer_name: formData.get('customer_name'),
                            customer_email: formData.get('customer_email'),
                            vehicle_make: formData.get('vehicle_make'),
                            vehicle_model: formData.get('vehicle_model'),
                            vehicle_year: formData.get('vehicle_year'),
                            vehicle_color: formData.get('vehicle_color'),
                            license_plate: formData.get('license_plate'),
                            damage_location: formData.get('damage_location'),
                            additional_comments: formData.get('additional_comments'),
                            contact_method: formData.get('contact_method'),
                            referral_source: formData.get('referral_source'),
                            customer_address: formData.get('customer_address'),
                            ics_url: cleanResponse.data.ics_url
                        };

                        // Update calendar links
                        var start = new Date(appointmentDetails.start_datetime);
                        var end = new Date(appointmentDetails.end_datetime);
                        var startFormatted = start.toISOString().replace(/-|:|\.\d\d\d/g, '');
                        var endFormatted = end.toISOString().replace(/-|:|\.\d\d\d/g, '');
                        var eventTitle = encodeURIComponent('Windshield Repair Appointment');
                        var eventDetails = encodeURIComponent('Customer: ' + appointmentDetails.customer_name + '\nVehicle: ' + appointmentDetails.vehicle_make + ' ' + appointmentDetails.vehicle_model + ' (' + appointmentDetails.vehicle_year + ')\nColor: ' + appointmentDetails.vehicle_color + '\nLicense Plate: ' + (appointmentDetails.license_plate || 'N/A') + '\nDamage Location: ' + appointmentDetails.damage_location + '\nComments: ' + (appointmentDetails.additional_comments || 'N/A') + '\nContact Method: ' + appointmentDetails.contact_method + '\nReferral Source: ' + (appointmentDetails.referral_source || 'N/A'));
                        var eventLocation = encodeURIComponent(appointmentDetails.customer_address);

                        // .ics file (Apple, Outlook, etc.)
                        $('#calendar-select option[data-ics="true"]').val(appointmentDetails.ics_url);

                        // Google Calendar
                        var googleUrl = 'https://www.google.com/calendar/render?action=TEMPLATE&text=' + eventTitle + '&dates=' + startFormatted + '/' + endFormatted + '&details=' + eventDetails + '&location=' + eventLocation;
                        $('#calendar-select option[data-google="true"]').val(googleUrl);

                        // Yahoo Calendar
                        var yahooUrl = 'https://calendar.yahoo.com/?v=60&title=' + eventTitle + '&st=' + startFormatted + '&et=' + endFormatted + '&desc=' + eventDetails + '&in_loc=' + eventLocation;
                        $('#calendar-select option[data-yahoo="true"]').val(yahooUrl);
                    } else {
                        $('#booking-error').text(cleanResponse.data.message || 'Booking failed. Please try again.').show();
                        $('#confirmation-step').hide();
                        $('#vehicle-step').show();
                        window.scrollTo(0, 0);
                    }
                },
                error: function(xhr) {
                    var errorMessage = 'An error occurred. Please try again.';
                    if (xhr.responseText) {
                        var responseText = xhr.responseText.startsWith('ad') ? xhr.responseText.substring(2) : xhr.responseText;
                        try {
                            var errorResponse = JSON.parse(responseText);
                            errorMessage = errorResponse.data.message || errorMessage;
                        } catch (e) {
                            errorMessage = responseText || errorMessage;
                        }
                    }
                    $('#booking-error').text(errorMessage).show();
                    $('#confirmation-step').hide();
                    $('#vehicle-step').show();
                    window.scrollTo(0, 0);
                },
                complete: function() {
                    // Reset button state
                    $('#confirm-btn-text').show();
                    $('#confirm-btn-loading').hide();
                    $('#confirm-booking-btn').prop('disabled', false);
                }
            });
        };

        // Function to populate available time slots based on selected date
        $('#booking-date').on('change', function() {
            var selectedDate = $(this).val();
            if (!selectedDate) {
                console.log('No date selected');
                return;
            }

            // Show loading indicator
            $('#time-loading').show();
            $('#booking-time').hide();

            // Get current date and time
            var now = new Date();
            var currentDate = now.toISOString().split('T')[0];
            var currentHours = now.getHours();
            var currentMinutes = now.getMinutes();
            var currentTime = currentHours * 60 + currentMinutes;

            // Calculate minimum lead time (2 hours from now)
            var leadTime = 2 * 60; // 2 hours in minutes
            var minTime = currentTime + leadTime;

            // Fetch available times from Bookly
            $.ajax({
                url: '<?php echo admin_url('admin-ajax.php'); ?>',
                type: 'POST',
                data: {
                    action: 'clearviewshield_get_available_times',
                    date: selectedDate,
                    nonce: '<?php echo wp_create_nonce('clearviewshield_get_available_times_nonce'); ?>'
                },
                success: function(response) {
                    console.log('Available times response:', response);
                    if (!response.success) {
                        $('#booking-error').text('Error fetching available times: ' + (response.data.message || 'Unknown error')).show();
                        window.scrollTo(0, 0);
                        $('#time-loading').hide();
                        $('#booking-time').show();
                        return;
                    }

                    var times = response.data.times || [];
                    var workingHours = response.data.working_hours || { start: 8, end: 19 }; // Default to 8 AM - 7 PM
                    var $timeSelect = $('#booking-time');
                    $timeSelect.empty();
                    $timeSelect.append('<option value="">Select a time</option>');

                    // Generate time slots based on working hours
                    var startHour = workingHours.start;
                    var endHour = workingHours.end;
                    var interval = 30; // 30 minutes
                    var hasAvailableTimes = false;

                    for (var hour = startHour; hour < endHour; hour++) {
                        for (var minute = 0; minute < 60; minute += interval) {
                            var timeMinutes = hour * 60 + minute;
                            var timeString = (hour % 12 || 12) + ':' + (minute < 10 ? '0' : '') + minute + ' ' + (hour < 12 ? 'AM' : 'PM');
                            var timeValue = (hour < 10 ? '0' : '') + hour + ':' + (minute < 10 ? '0' : '') + minute + ':00';

                            // Check if the time slot is available
                            if (!times.includes(timeValue)) {
                                // Check lead time (2 hours from now)
                                if (selectedDate === currentDate && timeMinutes < minTime) {
                                    console.log('Skipping time slot (past lead time): ' + timeString);
                                    continue; // Skip past times and times within 2 hours
                                }
                                if (hour === endHour - 1 && minute > 0) {
                                    console.log('Skipping time slot (after end hour): ' + timeString);
                                    continue; // Skip times after the end hour
                                }
                                $timeSelect.append('<option value="' + timeValue + '">' + timeString + '</option>');
                                hasAvailableTimes = true;
                            } else {
                                console.log('Time slot booked: ' + timeString);
                            }
                        }
                    }

                    // If no times are available, show a message
                    if (!hasAvailableTimes) {
                        $('#booking-error').text('No available time slots for the selected date. Please choose another date.').show();
                        window.scrollTo(0, 0);
                    } else {
                        $('#booking-error').hide();
                    }

                    // Hide loading indicator and show the dropdown
                    $('#time-loading').hide();
                    $('#booking-time').show();
                },
                error: function(xhr) {
                    console.log('Error fetching available times:', xhr);
                    $('#booking-error').text('Error fetching available times. Please try again.').show();
                    window.scrollTo(0, 0);
                    $('#time-loading').hide();
                    $('#booking-time').show();
                }
            });
        });
    });
    </script>
    <?php
    return ob_get_clean();
}