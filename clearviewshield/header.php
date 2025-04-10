<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package ClearViewShield
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'clearviewshield' ); ?></a>

<header id="masthead" class="site-header">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="site-branding">
                    <?php the_custom_logo(); ?>
                </div><!-- .site-branding -->
            </div><!-- .col-md-3 -->
            <div class="col-md-9">
               <nav id="site-navigation" class="main-navigation">
    <button class="hamburger-toggle" aria-controls="primary-menu" aria-expanded="false">
        <span class="hamburger-line"></span>
        <span class="hamburger-line"></span>
        <span class="hamburger-line"></span>
        <span class="screen-reader-text"><?php esc_html_e( 'Menu', 'clearviewshield' ); ?></span>
    </button>
    <?php
    wp_nav_menu(
        array(
            'theme_location' => 'primary',
            'menu_id'        => 'primary-menu',
            'menu_class'     => 'primary-menu',
            'container_class' => 'primary-menu-container',
            'fallback_cb'    => false,
        )
    );
    ?>
    <div class="header-buttons">
        <a href="<?php echo esc_url( home_url( '/booking/' ) ); ?>" class="btn btn-primary book-now-btn">Book Now</a>
        <a href="tel:3197750717" class="btn btn-outline-primary call-now-btn">Call: 319-775-0717</a>
    </div>
</nav><!-- #site-navigation -->
            </div><!-- .col-md-9 -->
        </div><!-- .row -->
    </div><!-- .container -->
</header><!-- #masthead -->
	<div id="content" class="site-content">
