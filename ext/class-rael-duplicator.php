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
		add_filter( 'post_row_actions', array( $this, 'rae_add_duplicate_link' ), 20, 2 );
		add_filter( 'page_row_actions', array( $this, 'rae_add_duplicate_link' ), 20, 2 );

		// Bulk action
		add_filter( 'bulk_actions-edit-post', array( $this, 'rae_register_bulk_action' ) );
		add_filter( 'handle_bulk_actions-edit-post', array( $this, 'rae_process_bulk_action' ), 10, 3 );
		add_action( 'quick_edit_custom_box', array( $this, 'rae_register_quick_edit_button' ), 20, 2 );
		add_action( 'admin_print_scripts-edit.php', [ $this, 'enqueue_quick_edit_js' ] );


		// Admin action for duplication
		add_action( 'admin_action_rael_duplicate_post', array( $this, 'rae_duplicate_post_handler' ) );
	}

	/**
	 * Add "Duplicate" link in row action
	 */
	public function rae_add_duplicate_link( $actions, $post ) {

		if ( ! current_user_can( 'edit_posts' ) ) {
			return $actions;
		}

		$url = wp_nonce_url(
			admin_url( 'admin.php?action=rael_duplicate_post&post=' . $post->ID ),
			'rael_duplicate_post_' . $post->ID
		);

		$actions['rael_duplicate'] = sprintf(
			'<a href="%s" class="rael-duplicate-link">%s</a>',
			esc_url( $url ),
			__( 'RAE Duplicator', 'responsive-addons-for-elementor' )
		);

		return $actions;
	}

	public function rae_register_quick_edit_button( $column_name, $post_type ) {

		if ( $column_name !== 'title' ) {
			return;
		}

		?>
		<fieldset class="inline-edit-col-right">
			<div class="inline-edit-col">
				<div class="inline-edit-group">
					<a href="#" class="button button-secondary rael-quick-duplicate-btn">
						<?php _e( 'RAE Duplicator', 'responsive-addons-for-elementor' ); ?>
					</a>
				</div>
			</div>
		</fieldset>
		<?php
	}
	public function enqueue_quick_edit_js() {

    // Create secure nonce
    $nonce = wp_create_nonce( 'rael_duplicate_quick_edit' );

    ?>
    <script>
        window.RAEDuplicator = {
            nonce: "<?php echo esc_js( $nonce ); ?>",
            duplicateUrl: "<?php echo esc_url( admin_url( 'admin.php' ) ); ?>"
        };
    </script>

    <script>
    jQuery(function($){

        $(document).on('click', '.rael-quick-duplicate-btn', function(e){
            e.preventDefault();

            // Get post ID from quick edit row
            let row = $('.inline-edit-row');

            if (!row.length) return;

            let postID = row.attr('id').replace('edit-', '');

            if (!postID) return;

            // Build safe URL with nonce
            let url = RAEDuplicator.duplicateUrl
                + '?action=rael_duplicate_post'
                + '&post=' + encodeURIComponent(postID)
                + '&_wpnonce=' + encodeURIComponent(RAEDuplicator.nonce);

            window.location.href = url;
        });

    });
    </script>
    <?php
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
	}

	RAEL_Duplicator::instance();
}