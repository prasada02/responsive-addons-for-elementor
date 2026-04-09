<?php
/**
 * Updates the RAEL widgets.
 *
 * @link  https://www.cyberchimps.com
 * @since 1.0.0
 *
 * @package    responsive-addons-for-elementor
 * @subpackage responsive-addons-for-elementor/includes
 * @author     CyberChimps <support@cyberchimps.com>
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Updates the RAEL widgets.
 *
 * @since      1.0.0
 * @package    responsive-addons-for-elementor
 * @subpackage responsive-addons-for-elementor/includes
 */
class Responsive_Addons_For_Elementor_Widgets_Updater {


	/**
	 * Retrives the RAEL widgets data.
	 *
	 * @since 1.0.0
	 */
	public function get_rael_widgets_data() {

		$widgets = array(
			array(
				'title'    => 'advanced-tabs',
				'name'     => 'Advanced Tabs',
				'docs'     => 'https://cyberchimps.com/docs/responsive-addons-for-elementor/widgets/rea-advanced-tabs/',
				'category' => 'content',
			),
			array(
				'title'    => 'animations',
				'name'     => 'Animations',
				'docs'     => 'https://cyberchimps.com/docs/responsive-addons-for-elementor/widgets/rae-animations/',
				'category' => 'extensions',
			),
			array(
				'title'    => 'audio',
				'name'     => 'Audio',
				'docs'     => 'https://cyberchimps.com/docs/responsive-addons-for-elementor/widgets/audio-player',
				'category' => 'content',
			),
			array(
				'title'    => 'theme-author-box',
				'name'     => 'Author box',
				'docs'     => 'https://cyberchimps.com/docs/responsive-addons-for-elementor/widgets/author-box/',
				'category' => 'marketing',
			),
			array(
				'title'    => 'woocommerce-theme-archive-product-description',
				'name'     => 'Archive description',
				'docs'     => 'https://cyberchimps.com/docs/responsive-addons-for-elementor/',
				'category' => 'themebuilder',
			),
			array(
				'title'    => 'woocommerce-theme-product-archive',
				'name'     => 'Product Archive',
				'docs'     => 'https://cyberchimps.com/docs/responsive-addons-for-elementor/',
				'category' => 'themebuilder',
			),

			array(
				'title'    => 'theme-archive-posts',
				'name'     => 'Archive posts',
				'docs'     => 'https://cyberchimps.com/docs/responsive-addons-for-elementor/widgets/archive-posts/',
				'category' => 'themebuilder',
			),
			array(
				'title'    => 'theme-archive-title',
				'name'     => 'Archive title',
				'docs'     => 'https://cyberchimps.com/docs/responsive-addons-for-elementor/widgets/archive-title/',
				'category' => 'themebuilder',
			),
			array(
				'title'    => 'back-to-top',
				'name'     => 'Back To Top',
				'docs'     => 'https://cyberchimps.com/docs/responsive-addons-for-elementor/widgets/back-to-top',
				'category' => 'content',
			),
			array(
				'title'    => 'banner',
				'name'     => 'Banner',
				'docs'     => 'https://cyberchimps.com/docs/responsive-addons-for-elementor/widgets/banner',
				'category' => 'marketing',
			),
			array(
				'title'    => 'before-after-slider',
				'name'     => 'Before After Slider',
				'docs'     => 'https://cyberchimps.com/docs/responsive-addons-for-elementor/widgets/before-after-slider/',
				'category' => 'creativity',
			),
			array(
				'title'    => 'breadcrumbs',
				'name'     => 'Breadcrumbs',
				'docs'     => 'https://cyberchimps.com/docs/responsive-addons-for-elementor/widgets/breadcrumbs',
				'category' => 'seo',
			),
			array(
				'title'    => 'business-hour',
				'name'     => 'Business Hour',
				'docs'     => 'https://cyberchimps.com/docs/responsive-addons-for-elementor/widgets/business-hour',
				'category' => 'marketing',
			),
			array(
				'title'    => 'button',
				'name'     => 'Button',
				'docs'     => 'https://cyberchimps.com/docs/responsive-addons-for-elementor/widgets/button',
				'category' => 'marketing',
			),
			array(
				'title'    => 'call-to-action',
				'name'     => 'Call To Action',
				'docs'     => 'https://cyberchimps.com/docs/responsive-addons-for-elementor/widgets/call-to-action',
				'category' => 'marketing',
			),
			array(
				'title'    => 'cf-styler',
				'name'     => 'Contact Form Styler',
				'docs'     => 'https://cyberchimps.com/docs/responsive-addons-for-elementor/widgets/contact-form-7-styler',
				'category' => 'form',
			),
			array(
				'title'    => 'content-switcher',
				'name'     => 'Content Switcher',
				'docs'     => 'https://cyberchimps.com/docs/responsive-addons-for-elementor/widgets/content-switcher',
				'category' => 'content',
			),
			array(
				'title'    => 'content-ticker',
				'name'     => 'Content Ticker',
				'docs'     => 'https://cyberchimps.com/docs/responsive-addons-for-elementor/widgets/content-ticker',
				'category' => 'content',
			),
			array(
				'title'    => 'countdown',
				'name'     => 'Countdown',
				'docs'     => 'https://cyberchimps.com/docs/responsive-addons-for-elementor/widgets/countdown',
				'category' => 'creativity',
			),
			array(
				'title'    => 'data-table',
				'name'     => 'Data Table',
				'docs'     => 'https://cyberchimps.com/docs/responsive-addons-for-elementor/widgets/data-table',
				'category' => 'creativity',
			),
			array(
				'title'    => 'divider',
				'name'     => 'Divider',
				'docs'     => 'https://cyberchimps.com/docs/responsive-addons-for-elementor/widgets/divider',
				'category' => 'creativity',
			),
			array(
				'title'    => 'dual-color-header',
				'name'     => 'Dual Color Header',
				'docs'     => 'https://cyberchimps.com/docs/responsive-addons-for-elementor/widgets/dual-color-header',
				'category' => 'creativity',
			),
			array(
				'title'    => 'duplicator',
				'name'     => 'Duplicator',
				'docs'     => 'https://cyberchimps.com/docs/responsive-addons-for-elementor/widgets/rae-duplicator/',
				'category' => 'extensions',
			),
			array(
				'title'    => 'facebook-feed',
				'name'     => 'Facebook Feed',
				'docs'     => 'https://cyberchimps.com/docs/responsive-addons-for-elementor/widgets/facebook-feed/',
				'category' => 'marketing',
			),
			array(
				'title'    => 'fancy-text',
				'name'     => 'Fancy Text',
				'docs'     => 'https://cyberchimps.com/docs/responsive-addons-for-elementor/widgets/fancy-text',
				'category' => 'content',
			),
			array(
				'title'    => 'faq',
				'name'     => 'FAQ',
				'docs'     => 'https://cyberchimps.com/docs/responsive-addons-for-elementor/widgets/faq',
				'category' => 'seo',
			),
			array(
				'title'    => 'feature-list',
				'name'     => 'Feature List',
				'docs'     => 'https://cyberchimps.com/docs/responsive-addons-for-elementor/widgets/feature-list',
				'category' => 'content',
			),

			array(
				'title'    => 'theme-post-featured-image',
				'name'     => 'Featured image',
				'docs'     => 'https://cyberchimps.com/docs/responsive-addons-for-elementor/widgets/featured-image/',
				'category' => 'themebuilder',
			),
			array(
				'title'    => 'flip-box',
				'name'     => 'Flip Box',
				'docs'     => 'https://cyberchimps.com/docs/responsive-addons-for-elementor/widgets/flipbox',
				'category' => 'creativity',
			),
			array(
				'title'    => 'gf-styler',
				'name'     => 'Gravity Forms Styler',
				'docs'     => 'https://cyberchimps.com/docs/responsive-addons-for-elementor/widgets/gravity-forms-styler',
				'category' => 'form',
			),
			array(
				'title'    => 'google-map',
				'name'     => 'Google Map',
				'docs'     => 'https://cyberchimps.com/docs/responsive-addons-for-elementor/widgets/google-map',
				'category' => 'content',
			),
			array(
				'title'    => 'icon-box',
				'name'     => 'Icon Box',
				'docs'     => 'https://cyberchimps.com/docs/responsive-addons-for-elementor/widgets/icon-box',
				'category' => 'content',
			),
			array(
				'title'    => 'image-gallery',
				'name'     => 'Image Gallery',
				'docs'     => 'https://cyberchimps.com/docs/responsive-addons-for-elementor/widgets/image-gallery',
				'category' => 'creativity',
			),
			array(
				'title'    => 'image-hotspot',
				'name'     => 'Image Hotspot',
				'docs'     => 'https://cyberchimps.com/docs/responsive-addons-for-elementor/widgets/image-hotspot',
				'category' => 'creativity',
			),
			array(
				'title'    => 'lottie',
				'name'     => 'Lottie',
				'docs'     => 'https://cyberchimps.com/docs/responsive-addons-for-elementor/widgets/lottie/',
				'category' => 'creativity',
			),
			array(
				'title'    => 'login-register',
				'name'     => 'Login Register',
				'docs'     => 'https://cyberchimps.com/docs/responsive-addons-for-elementor/widgets/login-register',
				'category' => 'marketing',
			),
			array(
				'title'    => 'logo-carousel',
				'name'     => 'Logo Carousel',
				'docs'     => 'https://cyberchimps.com/docs/responsive-addons-for-elementor/widgets/logo-carousel',
				'category' => 'content',
			),
			array(
				'title'    => 'mc-styler',
				'name'     => 'MailChimp Styler',
				'docs'     => 'https://cyberchimps.com/docs/responsive-addons-for-elementor/widgets/mailchimp-styler',
				'category' => 'form',
			),
			array(
				'title'    => 'media-carousel',
				'name'     => 'Media Carousel',
				'docs'     => 'https://cyberchimps.com/docs/responsive-addons-for-elementor/widgets/media-carousel',
				'category' => 'content',
			),
			array(
				'title'    => 'menu-cart',
				'name'     => 'Menu Cart',
				'docs'     => 'https://cyberchimps.com/docs/responsive-addons-for-elementor/widgets/menu-cart',
				'category' => 'woocommerce',
			),
			array(
				'title'    => 'modal-popup',
				'name'     => 'Modal Popup',
				'docs'     => 'https://cyberchimps.com/docs/responsive-addons-for-elementor/widgets/modal-popup',
				'category' => 'marketing',
			),
			array(
				'title'    => 'multi-button',
				'name'     => 'Multi Button',
				'docs'     => 'https://cyberchimps.com/docs/responsive-addons-for-elementor/widgets/multibutton',
				'category' => 'content',
			),
			array(
				'title'    => 'nav-menu',
				'name'     => 'Nav Menu',
				'docs'     => 'https://cyberchimps.com/docs/responsive-addons-for-elementor/widgets/nav-menu',
				'category' => 'content',
			),
			array(
				'title'    => 'offcanvas',
				'name'     => 'Offcanvas',
				'docs'     => 'https://cyberchimps.com/docs/responsive-addons-for-elementor/widgets/offcanvas',
				'category' => 'creativity',
			),
			array(
				'title'    => 'one-page-navigation',
				'name'     => 'One Page Navigation',
				'docs'     => 'https://cyberchimps.com/docs/responsive-addons-for-elementor/widgets/one-page-navigation',
				'category' => 'creativity',
			),
			array(
				'title'    => 'particle-backgrounds',
				'name'     => 'Particle Backgrounds',
				'docs'     => 'https://cyberchimps.com/docs/responsive-addons-for-elementor/widgets/particle-backgrounds-for-elementor/',
				'category' => 'extensions',
			),
			array(
				'title'    => 'portfolio',
				'name'     => 'Portfolio',
				'docs'     => 'https://cyberchimps.com/docs/responsive-addons-for-elementor/widgets/portfolio',
				'category' => 'content',
			),
			array(
				'title'    => 'post-carousel',
				'name'     => 'Post Carousel',
				'docs'     => 'https://cyberchimps.com/docs/responsive-addons-for-elementor/widgets/post-carousel',
				'category' => 'content',
			),
			array(
				'title'    => 'posts',
				'name'     => 'Posts',
				'docs'     => 'https://cyberchimps.com/docs/responsive-addons-for-elementor/widgets/posts',
				'category' => 'content',
			),
			array(
				'title'    => 'price-box',
				'name'     => 'Price Box',
				'docs'     => 'https://cyberchimps.com/docs/responsive-addons-for-elementor/widgets/price-box',
				'category' => 'content',
			),
			array(
				'title'    => 'price-list',
				'name'     => 'Price List',
				'docs'     => 'https://cyberchimps.com/docs/responsive-addons-for-elementor/widgets/price-list',
				'category' => 'content',
			),
			array(
				'title'    => 'pricing-table',
				'name'     => 'Pricing Table',
				'docs'     => 'https://cyberchimps.com/docs/responsive-addons-for-elementor/widgets/pricing-table',
				'category' => 'content',
			),
			array(
				'title'    => 'product-carousel',
				'name'     => 'Product Carousel',
				'docs'     => 'https://cyberchimps.com/docs/responsive-addons-for-elementor/widgets/product-carousel',
				'category' => 'woocommerce',
			),
			array(
				'title'    => 'product-category-grid',
				'name'     => 'Product Category Grid',
				'docs'     => 'https://cyberchimps.com/docs/responsive-addons-for-elementor/widgets/product-category-grid',
				'category' => 'woocommerce',
			),
			array(
				'title'    => 'progress-bar',
				'name'     => 'Progress Bar',
				'docs'     => 'https://cyberchimps.com/docs/responsive-addons-for-elementor/widgets/progress-bar',
				'category' => 'content',
			),

			array(
				'title'    => 'woocommerce-theme-product-content',
				'name'     => 'Product content',
				'docs'     => 'https://cyberchimps.com/docs/responsive-addons-for-elementor/widgets/product-content/',
				'category' => 'themebuilder',
			),
			array(
				'title'    => 'woocommerce-theme-product-data-tabs',
				'name'     => 'Product data tabs',
				'docs'     => 'https://cyberchimps.com/docs/responsive-addons-for-elementor/',
				'category' => 'themebuilder',
			),
			array(
				'title'    => 'woocommerce-theme-product-images',
				'name'     => 'Product images',
				'docs'     => 'https://cyberchimps.com/docs/responsive-addons-for-elementor/widgets/product-image/',
				'category' => 'themebuilder',
			),
			array(
				'title'    => 'woocommerce-theme-product-meta',
				'name'     => 'Product meta',
				'docs'     => 'https://cyberchimps.com/docs/responsive-addons-for-elementor/widgets/product-meta/',
				'category' => 'themebuilder',
			),
			array(
				'title'    => 'woocommerce-theme-product-price',
				'name'     => 'Product price',
				'docs'     => 'https://cyberchimps.com/docs/responsive-addons-for-elementor/widgets/product-price/',
				'category' => 'themebuilder',
			),
			array(
				'title'    => 'woocommerce-theme-product-rating',
				'name'     => 'Product rating',
				'docs'     => 'https://cyberchimps.com/docs/responsive-addons-for-elementor/widgets/product-rating/',
				'category' => 'themebuilder',
			),
			array(
				'title'    => 'woocommerce-theme-product-related',
				'name'     => 'Product related',
				'docs'     => 'https://cyberchimps.com/docs/responsive-addons-for-elementor/',
				'category' => 'themebuilder',
			),
			array(
				'title'    => 'woocommerce-theme-product-short-description',
				'name'     => 'Product short description',
				'docs'     => 'https://cyberchimps.com/docs/responsive-addons-for-elementor/widgets/short-description/',
				'category' => 'themebuilder',
			),
			array(
				'title'    => 'woocommerce-theme-product-stock',
				'name'     => 'Product stock',
				'docs'     => 'https://cyberchimps.com/docs/responsive-addons-for-elementor/widgets/product-stock/',
				'category' => 'themebuilder',
			),
			array(
				'title'    => 'woocommerce-theme-product-title',
				'name'     => 'Product title',
				'docs'     => 'https://cyberchimps.com/docs/responsive-addons-for-elementor/widgets/product-title/',
				'category' => 'themebuilder',
			),
			array(
				'title'    => 'woocommerce-theme-product-upsell',
				'name'     => 'Product upsells',
				'docs'     => 'https://cyberchimps.com/docs/responsive-addons-for-elementor/widgets/product-upsells/',
				'category' => 'themebuilder',
			),
			array(
				'title'    => 'woocommerce-theme-product-additional-info',
				'name'     => 'Product additional info',
				'docs'     => 'https://cyberchimps.com/docs/responsive-addons-for-elementor/widgets/product-additional-information/',
				'category' => 'themebuilder',
			),
			array(
				'title'    => 'theme-post-comments',
				'name'     => 'Post comments',
				'docs'     => 'https://cyberchimps.com/docs/responsive-addons-for-elementor/widgets/post-comments/',
				'category' => 'themebuilder',
			),
			array(
				'title'    => 'theme-post-content',
				'name'     => 'Post content',
				'docs'     => 'https://cyberchimps.com/docs/responsive-addons-for-elementor/widgets/post-content/',
				'category' => 'themebuilder',
			),
			array(
				'title'    => 'theme-post-excerpt',
				'name'     => 'Post excerpt',
				'docs'     => 'https://cyberchimps.com/docs/responsive-addons-for-elementor/widgets/post-excerpt/',
				'category' => 'themebuilder',
			),
			array(
				'title'    => 'theme-post-info',
				'name'     => 'Post info',
				'docs'     => 'https://cyberchimps.com/docs/responsive-addons-for-elementor/widgets/post-info/',
				'category' => 'themebuilder',
			),
			array(
				'title'    => 'theme-post-navigation',
				'name'     => 'Post navigation',
				'docs'     => 'https://cyberchimps.com/docs/responsive-addons-for-elementor/widgets/post-navigation/',
				'category' => 'themebuilder',
			),
			array(
				'title'    => 'theme-post-title',
				'name'     => 'Post title',
				'docs'     => 'https://cyberchimps.com/docs/responsive-addons-for-elementor/widgets/post-title/',
				'category' => 'themebuilder',
			),
			array(
				'title'    => 'reviews',
				'name'     => 'Reviews',
				'docs'     => 'https://cyberchimps.com/docs/responsive-addons-for-elementor/widgets/reviews',
				'category' => 'marketing',
			),
			array(
				'title'    => 'search-form',
				'name'     => 'Search Form',
				'docs'     => 'https://cyberchimps.com/docs/responsive-addons-for-elementor/widgets/search-form',
				'category' => 'form',
			),
			array(
				'title'    => 'theme-site-logo',
				'name'     => 'Site logo',
				'docs'     => 'https://cyberchimps.com/docs/responsive-addons-for-elementor/widgets/site-logo/',
				'category' => 'marketing',
			),
			array(
				'title'    => 'slider',
				'name'     => 'Slider',
				'docs'     => 'https://cyberchimps.com/docs/responsive-addons-for-elementor/widgets/slider',
				'category' => 'content',
			),
			array(
				'title'    => 'stacking-cards',
				'name'     => 'Stacking Cards',
				'docs'     => 'https://cyberchimps.com/docs/responsive-addons-for-elementor/widgets/stacking-cards/',
				'category' => 'creativity',
			),
			array(
				'title'    => 'sticky-section',
				'name'     => 'Sticky Section',
				'docs'     => 'https://cyberchimps.com/docs/responsive-addons-for-elementor/widgets/sticky-section/',
				'category' => 'extensions',
			),
			array(
				'title'    => 'sticky-video',
				'name'     => 'Sticky Video',
				'docs'     => 'https://cyberchimps.com/docs/responsive-addons-for-elementor/widgets/sticky-video',
				'category' => 'marketing',
			),
			array(
				'title'    => 'table-of-contents',
				'name'     => 'Table of Contents',
				'docs'     => 'https://cyberchimps.com/docs/responsive-addons-for-elementor/widgets/table-of-contents',
				'category' => 'content',
			),
			array(
				'title'    => 'team-member',
				'name'     => 'Team Member',
				'docs'     => 'https://cyberchimps.com/docs/responsive-addons-for-elementor/widgets/team-member',
				'category' => 'content',
			),
			array(
				'title'    => 'testimonial-slider',
				'name'     => 'Testimonial Slider',
				'docs'     => 'https://cyberchimps.com/docs/responsive-addons-for-elementor/widgets/testimonial-slider',
				'category' => 'marketing',
			),
			array(
				'title'    => 'timeline',
				'name'     => 'Timeline',
				'docs'     => 'https://cyberchimps.com/docs/responsive-addons-for-elementor/widgets/timeline',
				'category' => 'creativity',
			),
			array(
				'title'    => 'twitter-feed',
				'name'     => 'Twiter Feed',
				'docs'     => 'https://cyberchimps.com/docs/responsive-addons-for-elementor/widgets/twitter-feed',
				'category' => 'marketing',
			),
			array(
				'title'    => 'video',
				'name'     => 'Video',
				'docs'     => 'https://cyberchimps.com/docs/responsive-addons-for-elementor/widgets/video',
				'category' => 'content',
			),
			array(
				'title'    => 'woo-products',
				'name'     => 'WC Products',
				'docs'     => 'https://cyberchimps.com/docs/responsive-addons-for-elementor/widgets/products',
				'category' => 'woocommerce',
			),
			array(
				'title'    => 'wpf-styler',
				'name'     => 'WP Form Styler',
				'docs'     => 'https://cyberchimps.com/docs/responsive-addons-for-elementor/widgets/wp-forms-styler',
				'category' => 'form',
			),
			array(
				'title'    => 'wc-add-to-cart',
				'name'     => 'WC Add to Cart',
				'docs'     => 'https://cyberchimps.com/docs/responsive-addons-for-elementor/widgets/custom-add-to-cart',
				'category' => 'woocommerce',
			),
			array(
				'title'    => 'breadcrumb',
				'name'     => 'WC Breadcrumbs',
				'docs'     => 'https://cyberchimps.com/docs/responsive-addons-for-elementor/widgets/woocommerce-breadcrumbs',
				'category' => 'woocommerce',
			),
			array(
				'title'    => 'woo-checkout',
				'name'     => 'WC Checkout',
				'docs'     => 'https://cyberchimps.com/docs/responsive-addons-for-elementor/widgets/woo-checkout',
				'category' => 'woocommerce',
			),
		);

		return $widgets;
	}

	/**
	 * Check if RAEL widgets exists in database.
	 *
	 * @since 1.0.0
	 */
	public function is_widgets_in_db() {

		$rael_widgets = get_option( 'rael_widgets' );

		if ( ! $rael_widgets ) {
			return false;
		}
		return true;
	}

	/**
	 * Initial RAEL widgets array with status 1.
	 *
	 * @since 1.0.0
	 */
	public function initial_rael_widgets_data() {

		$widgets = $this->get_rael_widgets_data();

		foreach ( $widgets as &$widget ) {
			$widget['status'] = 1;
		}

		return $widgets;
	}

	/**
	 * Inserts the RAEL widgets into the database.
	 *
	 * @since 1.0.0
	 */
	public function insert_widgets_data() {

		$rael_widgets = $this->is_widgets_in_db();
		$widgets      = $this->initial_rael_widgets_data();

		if ( $rael_widgets ) {
			update_option( 'rael_widgets', $widgets );
		} else {
			add_option( 'rael_widgets', $widgets );
		}
	}
	/**
	 * Reset the RAEL widgets into the database.
	 */
	public function reset_widgets_data() {

		$delete_widgets = delete_option( 'rael_widgets' );
		if ( $delete_widgets ) {
			$widgets = $this->initial_rael_widgets_data();
			add_option( 'rael_widgets', $widgets );
		}
	}
}
