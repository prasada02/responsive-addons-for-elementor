<?php
/**
 * Theme Builder Util;
 *
 * @package  Responsive_Addons_For_Elementor
 */

use Responsive_Addons_For_Elementor\ModulesManager\Theme_Builder\RAEL_Theme_Builder;

/**
 * Get RAEL Header ID
 *
 * @since  1.3.0
 *
 * @return (String|boolean) Header ID or false.
 */
function get_rael_header_id() {
	$header_id = RAEL_Theme_Builder::get_settings( 'header', '' );

	if ( '' === $header_id ) {
		$header_id = false;
	}

	return apply_filters( 'get_rael_header_id', $header_id );
}

/**
 * Get RAEL Footer ID
 *
 * @since  1.3.0
 *
 * @return (String|boolean) Footer ID or false.
 */
function get_rael_footer_id() {
	$footer_id = RAEL_Theme_Builder::get_settings( 'footer', '' );

	if ( '' === $footer_id ) {
		$footer_id = false;
	}

	return apply_filters( 'get_rael_footer_id', $footer_id );
}

/**
 * Get RAEL Single Page ID
 *
 * @since  1.3.0
 *
 * @return (String|boolean) Single Page ID or false.
 */
function get_rael_single_page_id() {
	$single_page_id = RAEL_Theme_Builder::get_settings( 'single-page', '' );

	if ( '' === $single_page_id ) {
		$single_page_id = false;
	}

	return apply_filters( 'get_rael_single_page_id', $single_page_id );
}

/**
 * Get RAEL Single Post ID
 *
 * @since  1.3.0
 *
 * @return (String|boolean) Single Post ID or false.
 */
function get_rael_single_post_id() {
	$single_post_id = RAEL_Theme_Builder::get_settings( 'single-post', '' );

	if ( '' === $single_post_id ) {
		$single_post_id = false;
	}

	return apply_filters( 'get_rael_single_post_id', $single_post_id );
}

/**
 * Get RAEL Error 404 ID
 *
 * @since  1.4.0
 *
 * @return (String|boolean) Error_404 ID or false.
 */
function get_rael_error_404_id() {
	$error_404_id = RAEL_Theme_Builder::get_settings( 'error-404', '' );

	if ( '' === $error_404_id ) {
		$error_404_id = false;
	}

	return apply_filters( 'get_rael_error_404_id', $error_404_id );
}

/**
 * Get RAEL Archive ID
 *
 * @since  1.5.0
 *
 * @return (String|boolean) Error_404 ID or false.
 */
function get_rael_archive_id() {
	$error_404_id = RAEL_Theme_Builder::get_settings( 'archive', '' );

	if ( '' === $error_404_id ) {
		$error_404_id = false;
	}

	return apply_filters( 'get_rael_archive_id', $error_404_id );
}

function get_rael_single_product_id() {
	$single_product_id = false;

	if ( is_product() ) {
		if ( '' !== $single_product_id ) {
			$single_product_id = RAEL_Theme_Builder::get_settings( 'single-product', '' );
		}
	}

	return apply_filters( 'get_rael_single_product_id', $single_product_id );
}

/**
 * Get RAEL Product Archive id
 *
 * @since  1.8.0
 *
 * @return (String|boolean) Error_404 ID or false.
 */
function get_rael_product_archive_id() {
	$product_archive_id = false;
	if ( is_shop() || is_archive() || is_product_taxonomy() || is_product_category() || is_product_tag() || is_woocommerce() ) {
		if ( '' !== $product_archive_id ) {
			$product_archive_id = RAEL_Theme_Builder::get_settings( 'product-archive', '' );
		}
	}

	return apply_filters( 'get_rael_product_archive_id', $product_archive_id );

}

/**
 * Render RAEL Theme location.
 *
 * @since 1.7.0
 *
 * @param string $location RAEL Theme location.
 * @return boolean
 */
function rea_theme_template_render_at_location( $location ) {
	$module  = RAEL_Theme_Builder::instance();
	$content = false;

	switch ( $location ) {
		case 'header':
			$content = $module::get_header_content();
			break;
		case 'footer':
			$content = $module::get_footer_content();
			break;
		case 'single':
			$content = $module::get_single_content();
			break;
		case 'archive':
			$content = $module::get_archive_content();
			break;
		// Locations other than Header, Footer, Single Post, Single Page or Archive will render Single template.
		case 'default':
			$content = $module::get_single_content();
	}

	return $content;
}
