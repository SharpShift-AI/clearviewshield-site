<?php
/**
 * Custom template tags for ClearViewShield theme
 *
 * @package ClearViewShield
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

if (!function_exists('clearviewshield_posted_on')) :
    /**
     * Prints HTML with meta information for the current post-date/time.
     */
    function clearviewshield_posted_on() {
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

        $posted_on = sprintf(
            /* translators: %s: post date. */
            esc_html_x('Posted on %s', 'post date', 'clearviewshield'),
            '<a href="' . esc_url(get_permalink()) . '" rel="bookmark">' . $time_string . '</a>'
        );

        echo '<span class="posted-on">' . $posted_on . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
    }
endif;

if (!function_exists('clearviewshield_posted_by')) :
    /**
     * Prints HTML with meta information for the current author.
     */
    function clearviewshield_posted_by() {
        $byline = sprintf(
            /* translators: %s: post author. */
            esc_html_x('by %s', 'post author', 'clearviewshield'),
            '<span class="author vcard"><a class="url fn n" href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '">' . esc_html(get_the_author()) . '</a></span>'
        );

        echo '<span class="byline"> ' . $byline . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
    }
endif;

if (!function_exists('clearviewshield_entry_footer')) :
    /**
     * Prints HTML with meta information for the categories, tags and comments.
     */
    function clearviewshield_entry_footer() {
        // Hide category and tag text for pages.
        if ('post' === get_post_type()) {
            /* translators: used between list items, there is a space after the comma */
            $categories_list = get_the_category_list(esc_html__(', ', 'clearviewshield'));
            if ($categories_list) {
                /* translators: 1: list of categories. */
                printf('<span class="cat-links">' . esc_html__('Posted in %1$s', 'clearviewshield') . '</span>', $categories_list); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
            }

            /* translators: used between list items, there is a space after the comma */
            $tags_list = get_the_tag_list('', esc_html_x(', ', 'list item separator', 'clearviewshield'));
            if ($tags_list) {
                /* translators: 1: list of tags. */
                printf('<span class="tags-links">' . esc_html__('Tagged %1$s', 'clearviewshield') . '</span>', $tags_list); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
            }
        }

        if (!is_single() && !post_password_required() && (comments_open() || get_comments_number())) {
            echo '<span class="comments-link">';
            comments_popup_link(
                sprintf(
                    wp_kses(
                        /* translators: %s: post title */
                        __('Leave a Comment<span class="screen-reader-text"> on %s</span>', 'clearviewshield'),
                        array(
                            'span' => array(
                                'class' => array(),
                            ),
                        )
                    ),
                    wp_kses_post(get_the_title())
                )
            );
            echo '</span>';
        }

        edit_post_link(
            sprintf(
                wp_kses(
                    /* translators: %s: Name of current post. Only visible to screen readers */
                    __('Edit <span class="screen-reader-text">%s</span>', 'clearviewshield'),
                    array(
                        'span' => array(
                            'class' => array(),
                        ),
                    )
                ),
                wp_kses_post(get_the_title())
            ),
            '<span class="edit-link">',
            '</span>'
        );
    }
endif;

if (!function_exists('clearviewshield_post_thumbnail')) :
    /**
     * Displays an optional post thumbnail.
     *
     * Wraps the post thumbnail in an anchor element on index views, or a div
     * element when on single views.
     */
    function clearviewshield_post_thumbnail() {
        if (post_password_required() || is_attachment() || !has_post_thumbnail()) {
            return;
        }

        if (is_singular()) :
            ?>

            <div class="post-thumbnail">
                <?php the_post_thumbnail(); ?>
            </div><!-- .post-thumbnail -->

        <?php else : ?>

            <a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
                <?php
                the_post_thumbnail(
                    'post-thumbnail',
                    array(
                        'alt' => the_title_attribute(
                            array(
                                'echo' => false,
                            )
                        ),
                    )
                );
                ?>
            </a>

            <?php
        endif; // End is_singular().
    }
endif;

if (!function_exists('wp_body_open')) :
    /**
     * Shim for sites older than 5.2.
     *
     * @link https://core.trac.wordpress.org/ticket/12563
     */
    function wp_body_open() {
        do_action('wp_body_open');
    }
endif;

if (!function_exists('clearviewshield_entry_meta')) :
    /**
     * Prints HTML with meta information for the current post.
     */
    function clearviewshield_entry_meta() {
        // Hide meta information on pages.
        if ('post' !== get_post_type()) {
            return;
        }

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
endif;

if (!function_exists('clearviewshield_post_tags')) :
    /**
     * Prints HTML with meta information for the tags.
     */
    function clearviewshield_post_tags() {
        // Hide tag text for pages.
        if ('post' !== get_post_type()) {
            return;
        }

        /* translators: used between list items, there is a space after the comma */
        $tags_list = get_the_tag_list('', esc_html_x(', ', 'list item separator', 'clearviewshield'));
        if ($tags_list) {
            echo '<div class="post-tags"><i class="fas fa-tags"></i> ' . $tags_list . '</div>';
        }
    }
endif;

if (!function_exists('clearviewshield_comment_template')) :
    /**
     * Template for comments and pingbacks.
     *
     * Used as a callback by wp_list_comments() for displaying the comments.
     *
     * @param object $comment Comment to display.
     * @param array  $args    Arguments passed to wp_list_comments().
     * @param int    $depth   Depth of comment.
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
endif;

if (!function_exists('clearviewshield_post_navigation')) :
    /**
     * Display navigation to next/previous post when applicable.
     */
    function clearviewshield_post_navigation() {
        the_post_navigation(
            array(
                'prev_text' => '<span class="nav-subtitle">' . esc_html__('Previous:', 'clearviewshield') . '</span> <span class="nav-title">%title</span>',
                'next_text' => '<span class="nav-subtitle">' . esc_html__('Next:', 'clearviewshield') . '</span> <span class="nav-title">%title</span>',
            )
        );
    }
endif;

if (!function_exists('clearviewshield_posts_pagination')) :
    /**
     * Display pagination for archive pages.
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
endif;

if (!function_exists('clearviewshield_breadcrumbs')) :
    /**
     * Display breadcrumbs.
     */
    function clearviewshield_breadcrumbs() {
        if (function_exists('yoast_breadcrumb')) {
            yoast_breadcrumb('<div class="breadcrumbs">', '</div>');
        } else {
            // Custom breadcrumbs if Yoast SEO is not active
            echo '<div class="breadcrumbs">';
            echo '<a href="' . esc_url(home_url('/')) . '">' . esc_html__('Home', 'clearviewshield') . '</a>';
            
            if (is_category() || is_single()) {
                echo ' &raquo; ';
                $categories = get_the_category();
                if ($categories) {
                    echo '<a href="' . esc_url(get_category_link($categories[0]->term_id)) . '">' . esc_html($categories[0]->name) . '</a>';
                }
                
                if (is_single()) {
                    echo ' &raquo; ';
                    the_title();
                }
            } elseif (is_page()) {
                echo ' &raquo; ';
                the_title();
            } elseif (is_search()) {
                echo ' &raquo; ' . esc_html__('Search Results for: ', 'clearviewshield') . get_search_query();
            } elseif (is_404()) {
                echo ' &raquo; ' . esc_html__('404 Error', 'clearviewshield');
            }
            
            echo '</div>';
        }
    }
endif;

if (!function_exists('clearviewshield_social_sharing')) :
    /**
     * Display social sharing buttons.
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
endif;

if (!function_exists('clearviewshield_related_posts')) :
    /**
     * Display related posts.
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
endif;

if (!function_exists('clearviewshield_author_bio')) :
    /**
     * Display author bio.
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
endif;

if (!function_exists('clearviewshield_social_icons')) :
    /**
     * Display social media icons.
     */
    function clearviewshield_social_icons() {
        $profiles = array(
            'facebook'  => get_theme_mod('clearviewshield_facebook_url', 'https://www.facebook.com/clearviewshield'),
            'instagram' => get_theme_mod('clearviewshield_instagram_url', 'https://www.instagram.com/clearviewshield'),
            'twitter'   => get_theme_mod('clearviewshield_twitter_url', ''),
            'linkedin'  => get_theme_mod('clearviewshield_linkedin_url', ''),
            'youtube'   => get_theme_mod('clearviewshield_youtube_url', '')
        );
        
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
endif;

if (!function_exists('clearviewshield_contact_info')) :
    /**
     * Display contact information.
     */
    function clearviewshield_contact_info() {
        $phone = get_theme_mod('clearviewshield_phone', '319-775-0717');
        $email = get_theme_mod('clearviewshield_email', 'info@clearviewshield.com');
        $address = array(
            'street'  => get_theme_mod('clearviewshield_street', '123 Main Street'),
            'city'    => get_theme_mod('clearviewshield_city', 'Cedar Rapids'),
            'state'   => get_theme_mod('clearviewshield_state', 'IA'),
            'zip'     => get_theme_mod('clearviewshield_zip', '52401'),
            'country' => get_theme_mod('clearviewshield_country', 'US')
        );
        
        echo '<div class="contact-info">';
        
        if ($phone) {
            echo '<div class="contact-phone">';
            echo '<i class="fas fa-phone"></i> ';
            echo '<a href="tel:' . preg_replace('/[^0-9]/', '', $phone) . '">' . esc_html($phone) . '</a>';
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
endif;

if (!function_exists('clearviewshield_business_hours')) :
    /**
     * Display business hours.
     */
    function clearviewshield_business_hours() {
        $hours = array(
            'monday'    => array(get_theme_mod('clearviewshield_monday_open', '08:00'), get_theme_mod('clearviewshield_monday_close', '18:00')),
            'tuesday'   => array(get_theme_mod('clearviewshield_tuesday_open', '08:00'), get_theme_mod('clearviewshield_tuesday_close', '18:00')),
            'wednesday' => array(get_theme_mod('clearviewshield_wednesday_open', '08:00'), get_theme_mod('clearviewshield_wednesday_close', '18:00')),
            'thursday'  => array(get_theme_mod('clearviewshield_thursday_open', '08:00'), get_theme_mod('clearviewshield_thursday_close', '18:00')),
            'friday'    => array(get_theme_mod('clearviewshield_friday_open', '08:00'), get_theme_mod('clearviewshield_friday_close', '18:00')),
            'saturday'  => array(get_theme_mod('clearviewshield_saturday_open', '09:00'), get_theme_mod('clearviewshield_saturday_close', '16:00')),
            'sunday'    => array(get_theme_mod('clearviewshield_sunday_open', 'closed'), get_theme_mod('clearviewshield_sunday_close', 'closed'))
        );
        
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
endif;

if (!function_exists('clearviewshield_cta_button')) :
    /**
     * Display a call to action button.
     */
    function clearviewshield_cta_button($text = 'Book Now', $url = '', $class = 'btn-cta') {
        if (empty($url)) {
            $url = home_url('/booking/');
        }
        
        echo '<a href="' . esc_url($url) . '" class="btn ' . esc_attr($class) . '">' . esc_html($text) . '</a>';
    }
endif;

if (!function_exists('clearviewshield_price_tag')) :
    /**
     * Display the price tag.
     */
    function clearviewshield_price_tag($price = '75', $class = 'price-tag') {
        echo '<span class="' . esc_attr($class) . '">$' . esc_html($price) . '</span>';
    }
endif;

if (!function_exists('clearviewshield_warranty_badge')) :
    /**
     * Display the warranty badge.
     */
    function clearviewshield_warranty_badge($class = 'warranty-badge') {
        echo '<div class="' . esc_attr($class) . '">';
        echo '<span class="warranty-title">' . esc_html__('Lifetime', 'clearviewshield') . '</span>';
        echo '<span class="warranty-value">' . esc_html__('Warranty', 'clearviewshield') . '</span>';
        echo '</div>';
    }
endif;

if (!function_exists('clearviewshield_section_heading')) :
    /**
     * Display a section heading with optional subtitle.
     */
    function clearviewshield_section_heading($title, $subtitle = '', $class = '') {
        echo '<div class="section-heading ' . esc_attr($class) . '">';
        echo '<h2>' . esc_html($title) . '</h2>';
        
        if (!empty($subtitle)) {
            echo '<p class="lead">' . esc_html($subtitle) . '</p>';
        }
        
        echo '</div>';
    }
endif;

if (!function_exists('clearviewshield_service_card')) :
    /**
     * Display a service card.
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
endif;

if (!function_exists('clearviewshield_testimonial_card')) :
    /**
     * Display a testimonial card.
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
endif;

if (!function_exists('clearviewshield_before_after_slider')) :
    /**
     * Display a before/after slider.
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
endif;
