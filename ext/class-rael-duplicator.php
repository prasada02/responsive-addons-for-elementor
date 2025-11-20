<?php
/**
 * RAEL Duplicator Extension
 *
 * Adds RAE Duplicator link on post type (post, page, custom post types) — useful for creating multiple similar posts or creating a draft copy for editing.
 *
 * @package Responsive Addons for Elementor
 */

if ( ! defined( 'WPINC' ) ) {
	exit; // Exit if accessed directly.
}

use Elementor\Controls_Manager;
use Elementor\Plugin;
use Responsive_Addons_For_Elementor\Helper\Helper;

if ( ! class_exists( 'RAEL_Duplicator' ) ) {
	/**
	 * RAEL Duplicator class
	 *
	 * Handles the RAEL_ Duplicator functionality for post type (post, page, custom post types).
	 */
	class RAEL_Duplicator {
		private static $instance = null;
		public static function instance() {
			if ( is_null( self::$instance ) ) {
				self::$instance = new self();
			}
			return self::$instance;
		}
		 
		public function __construct() {
			// Load only if enabled in RAE Extensions
			if ( ! Helper::is_extension_active('duplicator') ) {
				return;
			}
			
			// Row actions for posts/pages
			add_filter( 'manage_posts_columns', array( $this, 'rae_add_custom_column' ) );
			add_filter( 'manage_pages_columns', array( $this, 'rae_add_custom_column' ) );


			
			add_filter( 'post_row_actions', array( $this, 'rae_add_duplicator_action' ), 10, 2 );
			add_filter( 'page_row_actions', array( $this, 'rae_add_duplicator_action' ), 10, 2 );

			// Bulk action
			add_filter( 'bulk_actions-edit-post', array( $this, 'rae_register_bulk_action' ) );
			add_filter( 'handle_bulk_actions-edit-post', array( $this, 'rae_process_bulk_action' ), 10, 3 );
			

			// Admin action for duplication
			add_action( 'admin_action_rael_duplicate_post', array( $this, 'rae_duplicate_post_handler' ) );

			add_filter( 'post_row_actions', array( $this, 'rae_add_duplicate_nonce_field' ), 10, 2 );
			add_filter( 'page_row_actions', array( $this, 'rae_add_duplicate_nonce_field' ), 10, 2 );

	}

	public function rae_add_duplicator_action( $actions, $post ) {

		// Get allowed post types saved from popup
		$allowed = get_option( 'rael_duplicator_allowed_post_types', array( 'all' ) );

		// If "all" selected → show for everything
		if ( in_array( 'all', $allowed ) ) {
			$actions['rael_duplicate'] = $this->rae_get_duplicate_link( $post->ID );
			return $actions;
		}

		// Otherwise show only for selected post types
		if ( in_array( $post->post_type, $allowed ) ) {
			$actions['rael_duplicate'] = $this->rae_get_duplicate_link( $post->ID );
		}

		return $actions;
	}
	/**
	 * Add "Duplicate" link in row action
	 */
	public function rae_get_duplicate_link( $post_id ) {

		 $url = wp_nonce_url(
			admin_url( 'admin.php?action=rael_duplicate_post&post=' . $post_id ),
			'rael_duplicate_post_' . $post_id
		);

		return '<a href="' . esc_url( $url ) . '">RAE Duplicator</a>';
	}


	/**
	 * Add bulk action
	 */
	public function rae_register_bulk_action( $bulk_actions ) {
		$bulk_actions['rael_duplicate'] = __( 'Duplicate', 'responsive-addons-for-elementor' );
		return $bulk_actions;
	}


	/**
	 * Process bulk action
	 */
	public function rae_process_bulk_action( $redirect_url, $action, $post_ids ) {

		if ( $action !== 'rael_duplicate' ) {
			return $redirect_url;
		}

		foreach ( $post_ids as $post_id ) {
			$this->rae_duplicate( $post_id );
		}

		return add_query_arg(
			'rael_duplicated',
			count( $post_ids ),
			$redirect_url
		);
	}

	/**
	 * Handle single duplication via admin action link
	 */
	public function rae_duplicate_post_handler() {

		$post_id = isset( $_GET['post'] ) ? intval( $_GET['post'] ) : 0;
		$nonce   = isset( $_GET['_wpnonce'] ) ? sanitize_text_field( $_GET['_wpnonce'] ) : '';

		if ( ! wp_verify_nonce( $nonce, 'rael_duplicate_post_' . $post_id ) ) {
			wp_die( __( 'Invalid request.', 'responsive-addons-for-elementor' ) );
		}

		$new_id = $this->rae_duplicate( $post_id );

		if ( is_wp_error( $new_id ) ) {
			wp_die( $new_id->get_error_message() );
		}

		wp_redirect( admin_url( "post.php?action=edit&post=$new_id" ) );
		exit;
	}
	public function rae_add_duplicate_nonce_field( $actions, $post ) {
		$nonce = wp_create_nonce( 'rael_duplicate_post_' . $post->ID );

		echo '<input type="hidden" class="rae-dup-nonce" data-post="' . esc_attr( $post->ID ) . '" value="' . esc_attr( $nonce ) . '">';

		return $actions;
	}
	/**
	 * Core duplication logic
	 */
	private function rae_duplicate( $post_id ) {

		$original = get_post( $post_id );

		if ( ! $original ) {
			return new WP_Error( 'invalid_post', __( 'Post not found.', 'responsive-addons-for-elementor' ) );
		}

		// Create new post
		$new_post = [
			'post_title'   => $original->post_title . ' (Copy)',
			'post_content' => $original->post_content,
			'post_excerpt' => $original->post_excerpt,
			'post_status'  => 'draft',
			'post_type'    => $original->post_type,
			'post_author'  => get_current_user_id(),
		];

		$new_post_id = wp_insert_post( $new_post );

		if ( ! $new_post_id ) {
			return new WP_Error( 'db_error', __( 'Failed to duplicate post.', 'responsive-addons-for-elementor' ) );
		}

		// Copy taxonomies
		$taxonomies = get_object_taxonomies( $original->post_type );
		foreach ( $taxonomies as $taxonomy ) {
			$terms = wp_get_object_terms( $post_id, $taxonomy, [ 'fields' => 'ids' ] );
			wp_set_object_terms( $new_post_id, $terms, $taxonomy );
		}

		// Copy all meta
		$meta = get_post_meta( $post_id );
		foreach ( $meta as $key => $values ) {

			// Skip WordPress internal meta
			if ( in_array( $key, [ '_edit_lock', '_edit_last' ] ) ) {
				continue;
			}

			foreach ( $values as $value ) {
				add_post_meta( $new_post_id, $key, maybe_unserialize( $value ) );
			}
		}

		// Copy featured image
		$thumb = get_post_thumbnail_id( $post_id );
		if ( $thumb ) {
			set_post_thumbnail( $new_post_id, $thumb );
		}

		return $new_post_id;
	}

	public function rae_add_custom_column( $columns ) {
		$columns['rae_duplicator'] = 'RAE Duplicator';
		return $columns;
	}
	
	}

	new RAEL_Duplicator();
}