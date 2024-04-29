<?php
/**
 * Fired during plugin activation
 *
 * @link  https://www.cyberchimps.com
 * @since 1.0.0
 *
 * @package    responsive-addons-for-elementor
 * @subpackage responsive-addons-for-elementor/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    responsive-addons-for-elementor
 * @subpackage responsive-addons-for-elementor/includes
 * @author     CyberChimps <support@cyberchimps.com>
 */
class Responsive_Addons_For_Elementor_Activator {


	/**
	 * Short Description.
	 *
	 * Long Description.
	 *
	 * @since 1.0.0
	 */
	public static function activate() {
		set_transient( 'responsive_addons_for_elementor_activation_redirect', true, MINUTE_IN_SECONDS );

		flush_rewrite_rules();

		include_once RAEL_DIR . 'includes/class-responsive-addons-for-elementor-widgets-updater.php';

		$rael_widgets_data = new Responsive_Addons_For_Elementor_Widgets_Updater();

		$rael_widgets_data->insert_widgets_data();
	}
}
