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
use Responsive_Addons_For_Elementor\Helper\Helper;

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

	protected function register_controls() {

		$this->start_controls_section(
			'section_content',
			array(
				'label' => __( 'Source', 'responsive-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'source_type',
			array(
				'label'   => __( 'Items Source', 'responsive-addons-for-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'posts',
				'options' => array(
					'posts' => __( 'Posts', 'responsive-addons-for-elementor' ),
					'items' => __( 'Items', 'responsive-addons-for-elementor' ),
				),
			)
		);

		$source_options = array(
			'static'        => __( '-- Static Value --', 'responsive-addons-for-elementor' ),
			'before'        => __( '-- Text Before --', 'responsive-addons-for-elementor' ),
			'after'         => __( '-- Text After --', 'responsive-addons-for-elementor' ),
			'separator'     => __( '-- Separator --', 'responsive-addons-for-elementor' ),
			'post_title'    => __( 'Post Title', 'responsive-addons-for-elementor' ),
			'post_name'     => __( 'Post Name', 'responsive-addons-for-elementor' ),
			'post_intro'    => __( 'Post Intro', 'responsive-addons-for-elementor' ),
			'post_content'  => __( 'Post Content', 'responsive-addons-for-elementor' ),
			'post_image'    => __( 'Post Featured Image', 'responsive-addons-for-elementor' ),
			'post_date'     => __( 'Post Date', 'responsive-addons-for-elementor' ),
			'post_url'      => __( 'Post URL', 'responsive-addons-for-elementor' ),
			'post_meta'     => __( 'Post Meta Field', 'responsive-addons-for-elementor' ),
			'post_term'     => __( 'Post Term', 'responsive-addons-for-elementor' ),
			'truncate'      => __( '-- Truncate Text --', 'responsive-addons-for-elementor' ),
		);

		$this->add_control(
			'title_source',
			array(
				'label'     => __( 'Title Source', 'responsive-addons-for-elementor' ),
				'label_block' => true,
				'type'      => Controls_Manager::SELECT2,
				'multiple'  => true,
				'default'   => 'post_title',
				'options'   => $source_options,
				'condition'   => array(
					'source_type' => 'posts',
				),
			)
		);

		$this->add_control(
			'description_source',
			array(
				'label'     => __( 'Description Source', 'responsive-addons-for-elementor' ),
				'label_block' => true,
				'type'      => Controls_Manager::SELECT2,
				'multiple'  => true,
				'default'   => 'post_content',
				'options'   => $source_options,
				'condition'   => array(
					'source_type' => 'posts',
				),
			)
		);

		$this->add_control(
			'link_source',
			array(
				'label'     => __( 'Link Source', 'responsive-addons-for-elementor' ),
				'label_block' => true,
				'type'      => Controls_Manager::SELECT2,
				'multiple'  => true,
				'default'   => 'post_url',
				'options'   => $source_options,
				'condition'   => array(
					'source_type' => 'posts',
				),
			)
		);

		$this->add_control(
			'button_text_source',
			array(
				'label'     => __( 'Button Text Source', 'responsive-addons-for-elementor' ),
				'label_block' => true,
				'type'      => Controls_Manager::SELECT2,
				'multiple'  => true,
				'options'   => $source_options,
				'condition'   => array(
					'source_type' => 'posts',
				),
			)
		);

		$this->add_control(
			'image_source',
			array(
				'label'     => __( 'Image Source', 'responsive-addons-for-elementor' ),
				'type'      => Controls_Manager::SELECT2,
				'label_block' => true,
				'multiple'  => true,
				'default'   => 'post_image',
				'options'   => $source_options,
				'condition'   => array(
					'source_type' => 'posts',
				),
			)
		);

		$this->add_control(
			'graphic_image_source',
			array(
				'label'     => __( 'Graphic Image Source', 'responsive-addons-for-elementor' ),
				'type'      => Controls_Manager::SELECT2,
				'label_block' => true,
				'multiple'  => true,
				'options'   => $source_options,
				'condition'   => array(
					'source_type' => 'posts',
				),
			)
		);

		$this->add_control(
			'graphic_icon_source',
			array(
				'label'     => __( 'Graphic Icon Source', 'responsive-addons-for-elementor' ),
				'type'      => Controls_Manager::SELECT2,
				'label_block' => true,
				'multiple'  => true,
				'options'   => $source_options,
				'condition'   => array(
					'source_type' => 'posts',
				),
			)
		);

		$this->add_control(
			'graphic_text_source',
			array(
				'label'     => __( 'Graphic Text Source', 'responsive-addons-for-elementor' ),
				'type'      => Controls_Manager::SELECT2,
				'label_block' => true,
				'multiple'  => true,
				'options'   => $source_options,
				'condition'   => array(
					'source_type' => 'posts',
				),
			)
		);

		$this->add_control(
			'background_color_source',
			array(
				'label'     => __( 'Background Color Source', 'responsive-addons-for-elementor' ),
				'type'      => Controls_Manager::SELECT2,
				'label_block' => true,
				'multiple'  => true,
				'options'   => $source_options,
				'condition'   => array(
					'source_type' => 'posts',
				),
			)
		);
		$this->end_controls_section();
		// ================== Source = Post ==================
		$this->start_controls_section(
			'post_source_section',
			array(
				'label'     => __( 'Items Post Query', 'responsive-addons-for-elementor' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
				'condition' => array( 'source_type' => 'posts' ),
			)
		);


		$this->end_controls_section();
	// ================== End Post Source ==================
		// Items Repeater (visible only if source = items)
		$this->start_controls_section(
			'item_section',
			array(
				'label'     => __( 'Items', 'responsive-addons-for-elementor' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
				'condition' => array(
					'source_type' => 'items',
				),
			)
		);

		$repeater = new Repeater();

		// ================== Tabs inside Items ==================
		$repeater->start_controls_tabs( 'item_tabs' );

		// ------------------ Content Tab ------------------
		$repeater->start_controls_tab(
			'tab_content',
			array( 'label' => __( 'Content', 'responsive-addons-for-elementor' ) )
		);

		$repeater->add_control(
			'item_title',
			array(
				'label'   => __( 'Title', 'responsive-addons-for-elementor' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Innovative Solution', 'responsive-addons-for-elementor' ),
			)
		);

		$repeater->add_control(
			'content_type',
			array(
				'label'   => __( 'Content Type', 'responsive-addons-for-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'editor',
				'options' => array(
					'editor' => __( 'Text Editor', 'responsive-addons-for-elementor' ),
					'template' => __( 'Template', 'responsive-addons-for-elementor' ),
            		'section'  => __( 'Section ID', 'responsive-addons-for-elementor' ),
				),
			)
		);
		

		$repeater->add_control(
			'item_desc',
			array(
				'label'   => __( 'Description', 'responsive-addons-for-elementor' ),
				'type'    => Controls_Manager::TEXTAREA,
				'default' => __( 'Explore cutting-edge technologies...', 'responsive-addons-for-elementor' ),
				'condition' => array( 'content_type' => 'editor' ),
			)
		);

		$repeater->add_control(
			'item_link',
			array(
				'label'       => __( 'Link', 'responsive-addons-for-elementor' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'responsive-addons-for-elementor' ),
				'condition' => array( 'content_type' => 'editor' ),
			)
		);

		$repeater->add_control(
			'show_button',
			array(
				'label'        => __( 'Show Button', 'responsive-addons-for-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'responsive-addons-for-elementor' ),
				'label_off'    => __( 'No', 'responsive-addons-for-elementor' ),
				'return_value' => 'yes',
				'default'      => 'no',
				'condition' => array( 'content_type' => 'editor' ),
			)
		);

		$repeater->add_control(
			'button_text',
			array(
				'label'     => __( 'Button Text', 'responsive-addons-for-elementor' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => __( 'Learn More', 'responsive-addons-for-elementor' ),
				'condition' => array( 'show_button' => 'yes', 'content_type' => 'editor', ),
			)
		);

		$repeater->add_control(
			'item_image',
			array(
				'label'   => __( 'Image', 'responsive-addons-for-elementor' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => array( 'url' => Utils::get_placeholder_image_src() ),
				'condition' => array( 'content_type' => 'editor' ),
			)
		);

		$repeater->add_group_control(
			Group_Control_Image_Size::get_type(),
			array(
				'name'      => 'item_image_size',
				'default'   => 'medium_large',
				'separator' => 'none',
				'condition' => array( 'content_type' => 'editor' ),
			)
		);
		// === Field for Template ===

		$repeater->add_control(
			'item_template',
			array(
				'label'     => __( 'Template', 'responsive-addons-for-elementor' ),
				'type'      => Controls_Manager::SELECT2,
				'options'   => $this->get_elementor_templates(),
				'condition' => array( 'content_type' => 'template' ),
			)
		);
		// === Field for Section ID ===

		$repeater->add_control(
			'item_section',
			array(
				'label'       => __( 'Section ID', 'responsive-addons-for-elementor' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => __( 'my-section', 'responsive-addons-for-elementor' ),
				'description' => __( 'Use CSS ID of a section available in the same page.', 'responsive-addons-for-elementor' ),
				'condition'   => array( 'content_type' => 'section' ),
			)
		);
		$repeater->end_controls_tab();

		// ------------------ Graphic Tab ------------------
		$repeater->start_controls_tab(
			'tab_graphic',
			array( 'label' => __( 'Graphic', 'responsive-addons-for-elementor' ) )
		);

		$repeater->add_control(
			'graphic_image',
			array(
				'label'   => __( 'Graphic Image', 'responsive-addons-for-elementor' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => array( 'url' => Utils::get_placeholder_image_src() ),
			)
		);

		$repeater->add_group_control(
			Group_Control_Image_Size::get_type(),
			array(
				'name'    => 'graphic_image_size',
				'default' => 'medium_large',
			)
		);

		$repeater->add_control(
			'graphic_icon',
			array(
				'label' => __( 'Graphic Icon', 'responsive-addons-for-elementor' ),
				'type'  => Controls_Manager::ICONS,
			)
		);

		$repeater->add_control(
			'graphic_text',
			array(
				'label'   => __( 'Graphic Text', 'responsive-addons-for-elementor' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'D', 'responsive-addons-for-elementor' ),
			)
		);

		$repeater->end_controls_tab();

		// ------------------ Background Tab ------------------
		$repeater->start_controls_tab(
			'tab_background',
			array( 'label' => __( 'Background', 'responsive-addons-for-elementor' ) )
		);

		$repeater->add_control(
			'background_type',
			array(
				'label'   => __( 'Background Type', 'responsive-addons-for-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'color',
				'options' => array(
					'color' => __( 'Color', 'responsive-addons-for-elementor' ),
					'image' => __( 'Image', 'responsive-addons-for-elementor' ),
				),
			)
		);

		$repeater->add_control(
			'background_color',
			array(
				'label'     => __( 'Background Color', 'responsive-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => array( 'background_type' => 'color' ),
			)
		);

		$repeater->add_control(
			'background_image',
			array(
				'label'     => __( 'Background Image', 'responsive-addons-for-elementor' ),
				'type'      => Controls_Manager::MEDIA,
				'condition' => array( 'background_type' => 'image' ),
			)
		);

		$repeater->end_controls_tab();

		$repeater->end_controls_tabs();
		// ================== Tabs End ==================

		// Add repeater to control
		$this->add_control(
			'items_list',
			array(
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => array(
					array( 'item_title' => __( 'Item #1', 'responsive-addons-for-elementor' ) ),
					array( 'item_title' => __( 'Item #2', 'responsive-addons-for-elementor' ) ),
					array( 'item_title' => __( 'Item #3', 'responsive-addons-for-elementor' ) ),
				),
				'title_field' => '{{{ item_title }}}',
			)
		);

    	$this->end_controls_section();
	}

	private function get_elementor_templates() {
		$templates = [];
		$template_library = \Elementor\Plugin::instance()->templates_manager->get_source( 'local' )->get_items();

		if ( ! empty( $template_library ) ) {
			foreach ( $template_library as $template ) {
				$templates[ $template['template_id'] ] = $template['title'];
			}
		}

		return $templates;
	}

}