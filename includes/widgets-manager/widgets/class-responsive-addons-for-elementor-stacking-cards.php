<?php
/**
 * RAEL Stacking Cards widget
 *
 * @since   1.0.0
 * @package Responsive_Addons_For_Elementor
 */

namespace Responsive_Addons_For_Elementor\WidgetsManager\Widgets;

use Elementor\Widget_Base;
use Elementor\Utils;
use Elementor\Repeater;
use Elementor\Control_Media;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use Elementor\Icons_Manager;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * RAEL Timeline widget class.
 *
 * @since 1.0.0
 */
class Responsive_Addons_For_Elementor_Stacking_Cards extends Widget_Base
{

	public function get_name(): string {
		return 'rael-stacking-cards';
	}

	public function get_title(): string {
		return __( 'Stacking Cards', 'responsive-addons-for-elementor' );
	}

	public function get_icon(): string {
		return 'eicon-parallax rael-badge';
	}

	public function get_categories(): array {
		return array( 'responsive-addons-for-elementor' );
	}

	public function get_keywords(): array {
		return [ 'hello', 'world' ];
	}

	protected function render(): void {
		?>
		<p> Hello World </p>
		<?php
	}

	protected function content_template(): void {
		?>
		<p> Hello World </p>
		<?php
	}
	
}