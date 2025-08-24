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
use Elementor\Icons_Manager;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Text_Shadow;
use \Elementor\Group_Control_Css_Filter;

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
		// ================== General Section ==================
    $this->start_controls_section(
        'general_section',
        array(
            'label' => __( 'General', 'responsive-addons-for-elementor' ),
            'tab'   => Controls_Manager::TAB_CONTENT,
        )
    );

    $this->add_responsive_control(
        'sticky_position_top_space',
        array(
            'label' => __( 'Sticky Position Top Space', 'responsive-addons-for-elementor' ),
            'type' => Controls_Manager::SLIDER,
            'size_units' => array( 'px', 'vh', '%' ),
            'range' => array(
                'px' => array(
                    'min' => 0,
                    'max' => 500,
				),
				'vh' => array(
					'min' => 10,
					'max' => 100,
				),
				'%'  => array(
					'min' => 0,
					'max' => 100,
				),
			),
            'default' => array( 'size' => 150, 'unit' => 'px' ),
        )
    );

    $this->add_responsive_control(
        'card_gap',
        array(
            'label' => __( 'Card Gap', 'responsive-addons-for-elementor' ),
            'type' => Controls_Manager::SLIDER,
            'size_units' => array( 'px', 'vh', '%' ),
            'range' => array(
                'px' => array(
                    'min' => 0,
                    'max' => 200,
				),
				'vh' => array(
					'min' => 10,
					'max' => 100,
				),
				'%'  => array(
					'min' => 0,
					'max' => 100,
				),
			),
            'default' => array( 'size' => 100, 'unit' => 'px' ),
        )
    );

    $this->add_responsive_control(
        'card_top_offset',
        array(
            'label' => __( 'Card Top Offset', 'responsive-addons-for-elementor' ),
            'type' => Controls_Manager::SLIDER,
            'size_units' => array( 'px' ),
            'range' => array(
                'px' => array(
                    'min' => 0,
                    'max' => 200,
				),
			),
            'default' => array( 'size' => 20, 'unit' => 'px' ),
			'dynamic' => array( 'active' => true ), 
        )
    );

    $this->add_control(
        'enable_scroll_motion',
        array(
            'label' => __( 'Enable Scroll Motion', 'responsive-addons-for-elementor' ),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => __( 'Yes', 'responsive-addons-for-elementor' ),
            'label_off' => __( 'No', 'responsive-addons-for-elementor' ),
            'return_value' => 'yes',
            'default' => 'yes',
        )
    );

    $this->add_control(
        'hover_transition_duration',
        array(
            'label' => __( 'Hover Transition Duration (ms)', 'responsive-addons-for-elementor' ),
            'type' => Controls_Manager::NUMBER,
            'min' => 0,
            'max' => 2000,
            'default' => 300,
        )
    );

    $this->add_control(
        'item_image_size',
        array(
            'label' => __( 'Item Image Size', 'responsive-addons-for-elementor' ),
            'type' => Controls_Manager::SELECT,
            'default' => 'medium_large',
            'options' => array(
                'thumbnail'    => __( 'Thumbnail', 'responsive-addons-for-elementor' ),
                'medium'       => __( 'Medium', 'responsive-addons-for-elementor' ),
                'medium_large' => __( 'Medium Large (max width 768)', 'responsive-addons-for-elementor' ),
                'large'        => __( 'Large', 'responsive-addons-for-elementor' ),
                'full'         => __( 'Full', 'responsive-addons-for-elementor' ),
            ),
        )
    );

    $this->add_control(
        'rtl_enable',
        array(
            'label' => __( 'RTL', 'responsive-addons-for-elementor' ),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => __( 'Yes', 'responsive-addons-for-elementor' ),
            'label_off' => __( 'No', 'responsive-addons-for-elementor' ),
            'return_value' => 'yes',
            'default' => 'no',
        )
    );

    $this->end_controls_section();

    // ================== Layout Section ==================
    $this->start_controls_section(
        'layout_section',
        array(
            'label' => __( 'Layout', 'responsive-addons-for-elementor' ),
            'tab'   => Controls_Manager::TAB_CONTENT,
        )
    );

    $this->add_control(
        'show_title',
        array(
            'label' => __( 'Show Title', 'responsive-addons-for-elementor' ),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => __( 'Yes', 'responsive-addons-for-elementor' ),
            'label_off' => __( 'No', 'responsive-addons-for-elementor' ),
            'default' => 'yes',
        )
    );

    $this->add_control(
        'title_html_tag',
        array(
            'label' => __( 'Title HTML Tag', 'responsive-addons-for-elementor' ),
            'type' => Controls_Manager::SELECT,
            'default' => 'div',
            'options' => array(
                'h1' => 'H1',
                'h2' => 'H2',
                'h3' => 'H3',
                'h4' => 'H4',
                'h5' => 'H5',
                'h6' => 'H6',
                'div' => 'div',
                'span' => 'span',
                'p' => 'p',
            ),
        )
    );

    $this->add_control(
        'show_description',
        array(
            'label' => __( 'Show Description', 'responsive-addons-for-elementor' ),
            'type' => Controls_Manager::SWITCHER,
            'default' => 'yes',
        )
    );

    $this->add_control(
        'show_button',
        array(
            'label' => __( 'Show Button', 'responsive-addons-for-elementor' ),
            'type' => Controls_Manager::SWITCHER,
            'default' => 'yes',
        )
    );

    $this->add_control(
        'button_text',
        array(
            'label' => __( 'Button Text', 'responsive-addons-for-elementor' ),
            'type' => Controls_Manager::TEXT,
            'default' => __( 'Read More', 'responsive-addons-for-elementor' ),
            'condition' => array( 'show_button' => 'yes' ),
        )
    );

    $this->add_control(
        'show_image',
        array(
            'label' => __( 'Show Image', 'responsive-addons-for-elementor' ),
            'type' => Controls_Manager::SWITCHER,
            'default' => 'yes',
        )
    );

    $this->add_control(
        'show_graphic_element',
        array(
            'label' => __( 'Show Graphic Element', 'responsive-addons-for-elementor' ),
            'type' => Controls_Manager::SELECT,
            'default' => 'icon',
            'options' => array(
                'none'  => __( 'None', 'responsive-addons-for-elementor' ),
                'icon'  => __( 'Icon', 'responsive-addons-for-elementor' ),
                'image' => __( 'Image', 'responsive-addons-for-elementor' ),
                'text'  => __( 'Text', 'responsive-addons-for-elementor' ),
            ),
        )
    );

    $this->add_control(
        'graphic_element_image_size',
        array(
            'label' => __( 'Graphic Element Image Size', 'responsive-addons-for-elementor' ),
            'type' => Controls_Manager::SELECT,
            'default' => 'medium_large',
            'options' => array(
                'thumbnail'    => __( 'Thumbnail', 'responsive-addons-for-elementor' ),
                'medium'       => __( 'Medium', 'responsive-addons-for-elementor' ),
                'medium_large' => __( 'Medium Large (max width 768)', 'responsive-addons-for-elementor' ),
                'large'        => __( 'Large', 'responsive-addons-for-elementor' ),
                'full'         => __( 'Full', 'responsive-addons-for-elementor' ),
            ),
        )
    );

    $this->end_controls_section();

		// Items (visible only if source = items)
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
		// Scroll Motion
		$this->start_controls_section(
			'scroll_motion_style',
			array(
				'label' => __( 'Scroll Motion', 'responsive-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'transform_origin_x',
			array(
				'label' => __( 'Transform Origin X', 'responsive-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'default' => array( 'size' => 50 ),
				'range' => array(
					'px' => array( 'min' => 0, 'max' => 100 ),
				),
			)
		);

		$this->add_control(
			'transform_origin_y',
			array(
				'label' => __( 'Transform Origin Y', 'responsive-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'default' => array( 'size' => 0 ),
				'range' => array(
					'px' => array( 'min' => 0, 'max' => 100 ),
				),
			)
		);
		$this->start_controls_tabs( 'scroll_motion_tabs' );

		// ---------------- Normal Tab ----------------
		$this->start_controls_tab(
			'scroll_motion_normal',
			array(
				'label' => __( 'Normal', 'responsive-addons-for-elementor' ),
			)
		);
		$this->end_controls_tab();
		
		$this->add_control(
			'normal_greyscale', 
			array(
				'label'   => __( 'Greyscale', 'responsive-addons-for-elementor' ),
				'type'    => Controls_Manager::SLIDER,
				'size_units' => array( '%' ),
				'range' => array(
					'%' => array( 'min' => 0, 'max' => 100 ),
				),
				'default' => array( 'size' => 0, 'unit' => '%' ),
				'dynamic' => array( 'active' => true ), 
			),
		);
		$this->add_control(
			'normal_rotation',
			array(
				'label'   => __( 'Rotation (deg)', 'responsive-addons-for-elementor' ),
				'type'    => Controls_Manager::SLIDER,
				'size_units' => array( 'deg' ),
				'range'   => array(
					'deg' => array( 'min' => -360, 'max' => 360 ),
				),
				'default' => array( 'size' => 0, 'unit' => 'deg' ),
				'dynamic' => array( 'active' => true ), 
			),
		);

		$this->end_controls_tab();

// ---------------- Hover tab (Scale, Opacity, Blur, Greyscale, Rotation) ---------------- 
		$this->start_controls_tab(
			'scroll_motion_hover',
			array( 'label' => __( 'Hover', 'responsive-addons-for-elementor' ) )
		);

		$this->add_control(
			'hover_scale',
			array(
				'label'   => __( 'Scale', 'responsive-addons-for-elementor' ),
				'type'    => Controls_Manager::SLIDER,
				'range'   => array( 'px' => array( 'min' => -1, 'max' => 2, 'step' => 0.1 ) ),
				'default' => array( 'size' => 1 ),
				'dynamic' => array( 'active' => true ), 
			),
		);
		$this->add_control(
			'hover_opacity',
			array(
				'label'   => __( 'Opacity', 'responsive-addons-for-elementor' ),
				'type'    => Controls_Manager::SLIDER,
				'range'   => array( 'px' => array( 'min' => 0, 'max' => 100 ) ),
				'default' => array( 'size' => 100 ),
				'dynamic' => array( 'active' => true ), 
			),
		);
		$this->add_control(
			'hover_blur',
			array(
				'label'   => __( 'Blur', 'responsive-addons-for-elementor' ),
				'type'    => Controls_Manager::SLIDER,
				'range'   => array( 'px' => array( 'min' => 0, 'max' => 20 ) ),
				'default' => array( 'size' => 0 ),
				'dynamic' => array( 'active' => true ), 
			),
		);
		$this->add_control(
			'hover_greyscale',
			array(
				'label'   => __( 'Greyscale', 'responsive-addons-for-elementor' ),
				'type'    => Controls_Manager::SLIDER,
				'size_units' => array( '%' ),
				'range' => array(
					'%' => array( 'min' => 0, 'max' => 100 ),
				),
				'default' => array( 'size' => 0, 'unit' => '%' ),
				'dynamic' => array( 'active' => true ), 
			),
		);
		$this->add_control(
			'hover_rotation',
			array(
				'label'   => __( 'Rotation (deg)', 'responsive-addons-for-elementor' ),
				'type'    => Controls_Manager::NUMBER,
				'size_units' => array( 'deg' ),
				'range'   => array(
					'deg' => array( 'min' => -360, 'max' => 360 ),
				),
				'default' => array( 'size' => 0, 'unit' => 'deg' ),
				'dynamic' => array( 'active' => true ), 
			),
		);


		$this->end_controls_tab();

		$this->end_controls_tabs();
		$this->end_controls_section();

		// Card
		$this->start_controls_section(
			'card_style',
			array(
				'label' => __( 'Card', 'responsive-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'card_width',
			array(
				'label' => __( 'Card Width', 'responsive-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => array( 'px','%' ),
				'range' => array(
					'px' => array( 'min' => 0, 'max' => 1200 ),
					'%'  => array( 'min' => 0, 'max' => 100 ),
				),
			)
		);

		$this->add_responsive_control(
			'card_height',
			array(
				'label' => __( 'Card Height', 'responsive-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range' => array( 'px' => array( 'min' => 0, 'max' => 1200 ) ),
				'default' => array( 'size' => 600, 'unit' => 'px' ),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name' => 'card_background',
				'label' => __( 'Background', 'responsive-addons-for-elementor' ),
				'types' => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .your-card-class',
			)
		);
		// Box Shadow
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'card_box_shadow',
				'label'    => __( 'Box Shadow', 'responsive-addons-for-elementor' ),
				'selector' => '{{WRAPPER}} .your-card-class',
			)
		);
		// Border Radius
		$this->add_responsive_control(
			'card_border_radius',
			array(
				'label'      => __( 'Border Radius', 'responsive-addons-for-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .your-card-class' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name' => 'card_border',
				'selector' => '{{WRAPPER}} .your-card-class',
			)
		);

		$this->add_responsive_control(
			'card_padding',
			array(
				'label' => __( 'Card Padding', 'responsive-addons-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => array(
					'{{WRAPPER}} .your-card-class' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		// Content
		$this->start_controls_section(
			'content_style',
			array(
				'label' => __( 'Content', 'responsive-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_responsive_control(
			'content_width',
			array(
				'label' => __( 'Content Width', 'responsive-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => array( 'px','%' ),
				'range' => array(
					'px' => array( 'min' => 0, 'max' => 1200 ),
					'%'  => array( 'min' => 0, 'max' => 100 ),
				),
			)
		);
		$this->add_responsive_control(
			'content_padding',
			array(
				'label' => __( 'Content Padding', 'responsive-addons-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => array(
					'{{WRAPPER}} .your-content-class' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'content_alignment',
			 array(
				'label'   => __( 'Align Content', 'responsive-addons-for-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'options' => array(
					'left'   => __( 'Left', 'responsive-addons-for-elementor' ),
					'center' => __( 'Center', 'responsive-addons-for-elementor' ),
					'right'  => __( 'Right', 'responsive-addons-for-elementor' ),
				),
				'default'   => 'left',
				'selectors' => array(
					'{{WRAPPER}} .your-card-class' => 'text-align: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			'content_background_color',
			array(
				'label'     => __( 'Background Color', 'responsive-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'global'    => array( 'default' => Global_Colors::COLOR_PRIMARY),
				'selectors' => array(
					'{{WRAPPER}} .your-card-class' => 'background-color: {{VALUE}};',
				),
			)
		);

	
		$this->end_controls_section();
		// Graphic Element
		$this->start_controls_section(
			'graphic_element_style',
			array(
				'label' => __( 'Graphic Element', 'responsive-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_responsive_control(
			'graphic_element_width',
			array(
				'label' => __( 'Graphic Element Width', 'responsive-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => array( 'px','%' ),
				'range' => array(
					'px' => array( 'min' => 0, 'max' => 1200 ),
					'%'  => array( 'min' => 0, 'max' => 100 ),
				),
			)
		);
		$this->add_responsive_control(
			'graphic_element_height',
			array(
				'label' => __( 'Graphic Element Height', 'responsive-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => array( 'px','%' ),
				'range' => array(
					'px' => array( 'min' => 0, 'max' => 1200 ),
					'%'  => array( 'min' => 0, 'max' => 100 ),
				),
			)
		);
		$this->add_responsive_control(
			'graphic_element_icon_size',
			array(
				'label' => __( 'Graphic Icon Size', 'responsive-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => array( 'px','%' ),
				'range' => array(
					'px' => array( 'min' => 0, 'max' => 1200 ),
					'%'  => array( 'min' => 0, 'max' => 100 ),
				),
			)
		);
		
		$this->add_control(
			'graphic_element_background_color',
			array(
				'label'     => __( 'Background Color', 'responsive-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'global'    => array( 'default' => Global_Colors::COLOR_PRIMARY),
				'selectors' => array(
					'{{WRAPPER}} .your-card-class' => 'background-color: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			'graphic_element_title_color',
			array(
				'label' => __( 'Color', 'responsive-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .your-title-class' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_responsive_control(
			'graphic_element_border_radius',
			array(
				'label' => __( 'Border Radius', 'responsive-addons-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => array(
					'{{WRAPPER}} .your-image-class' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'graphic_element_box_shadow',
				'label'    => __( 'Box Shadow', 'responsive-addons-for-elementor' ),
				'selector' => '{{WRAPPER}} .your-card-class',
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'graphic_element_icon_text_shadow',
				'label'    => __( 'Icon/Text Shadow', 'responsive-addons-for-elementor' ),
				'selector' => '{{WRAPPER}} .your-card-class',
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name' => 'graphic_element_border',
				'selector' => '{{WRAPPER}} .your-graphic-element-class',
			)
		);

		$this->end_controls_section();

		// Style - Title Section
		$this->start_controls_section(
			'title_style',
			array(
				'label' => __( 'Title', 'responsive-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .your-title-class',
			)
		);

		$this->add_control(
			'title_color',
			array(
				'label' => __( 'Color', 'responsive-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .your-title-class' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'title_text_shadow',
				'label'    => __( 'Text Shadow', 'responsive-addons-for-elementor' ),
				'selector' => '{{WRAPPER}} .your-card-class',
			)
		);

		$this->add_responsive_control(
			'title_gap',
			array(
				'label' => __( 'Gap', 'responsive-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'default'    => array(
					'size' => 15,
					'unit' => 'px',
				),
				'size_units' => array( 'px','%' ),
				'range' => array(
					'px' => array( 'min' => 0, 'max' => 1200 ),
					'%'  => array( 'min' => 0, 'max' => 100 ),
				),
			)
		);

		$this->end_controls_section();

		// Style - Description
		$this->start_controls_section(
			'description_style',
			array(
				'label' => __( 'Description', 'responsive-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name' => 'description_typography',
				'selector' => '{{WRAPPER}} .your-description-class',
			)
		);

		$this->add_control(
			'description_color',
			array(
				'label' => __( 'Color', 'responsive-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .your-description-class' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'description_text_shadow',
				'label'    => __( 'Text Shadow', 'responsive-addons-for-elementor' ),
				'selector' => '{{WRAPPER}} .your-card-class',
			)
		);

		$this->add_responsive_control(
			'description_gap',
			array(
				'label' => __( 'Gap', 'responsive-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'default'    => array(
					'size' => 15,
					'unit' => 'px',
				),
				'size_units' => array( 'px','%' ),
				'range' => array(
					'px' => array( 'min' => 0, 'max' => 1200 ),
					'%'  => array( 'min' => 0, 'max' => 100 ),
				),
			)
		);

		$this->end_controls_section();

		// Style - Button
		$this->start_controls_section(
			'button_style',
			array(
				'label' => __( 'Button', 'responsive-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'button_width_type',
			array(
				'label'   => __( 'Button Width Type', 'responsive-addons-for-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'auto',
				'options' => array(
					'auto'   => __( 'Auto', 'responsive-addons-for-elementor' ),
					'full'   => __( 'Full Width', 'responsive-addons-for-elementor' ),
					'custom' => __( 'Custom', 'responsive-addons-for-elementor' ),
				),
			)
		);

		$this->add_responsive_control(
			'button_text_align',
			array(
				'label'   => __( 'Button Text Align', 'responsive-addons-for-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'center',
				'options' => array(
					'left'   => __( 'Left', 'responsive-addons-for-elementor' ),
					'center' => __( 'Center', 'responsive-addons-for-elementor' ),
					'right'  => __( 'Right', 'responsive-addons-for-elementor' ),
				),
				'selectors' => array(
					'{{WRAPPER}} .your-button-class' => 'text-align: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'button_padding',
			array(
				'label'      => __( 'Padding', 'responsive-addons-for-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .your-button-class' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'button_typography',
				'selector' => '{{WRAPPER}} .your-button-class',
			)
		);

		$this->add_responsive_control(
			'button_gap',
			array(
				'label'      => __( 'Button Gap', 'responsive-addons-for-elementor' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'default'    => array(
					'size' => 15,
					'unit' => 'px',
				),
				'selectors'  => array(
					'{{WRAPPER}} .your-button-class' => 'margin: 0 {{SIZE}}{{UNIT}};',
				),
			)
		);

		// Tabs: Normal & Hover
		$this->start_controls_tabs( 'button_tabs' );

		// Normal Tab
		$this->start_controls_tab(
			'button_tab_normal',
			array( 'label' => __( 'Normal', 'responsive-addons-for-elementor' ) )
		);

		$this->add_control(
			'button_text_color',
			array(
				'label'     => __( 'Text Color', 'responsive-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .your-button-class' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'button_background_color',
			array(
				'label'     => __( 'Background Color', 'responsive-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .your-button-class' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'button_border_radius',
			array(
				'label'      => __( 'Border Radius', 'responsive-addons-for-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .your-button-class' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'button_box_shadow',
				'selector' => '{{WRAPPER}} .your-button-class',
			)
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			array(
				'name'     => 'button_text_shadow',
				'selector' => '{{WRAPPER}} .your-button-class',
			)
		);

		$this->end_controls_tab();

		// Hover Tab
		$this->start_controls_tab(
			'button_tab_hover',
			array( 'label' => __( 'Hover', 'responsive-addons-for-elementor' ) )
		);

		$this->add_control(
			'button_hover_text_color',
			array(
				'label'     => __( 'Text Color', 'responsive-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .your-button-class:hover' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'button_hover_background_color',
			array(
				'label'     => __( 'Background Color', 'responsive-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .your-button-class:hover' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'button_hover_box_shadow',
				'selector' => '{{WRAPPER}} .your-button-class:hover',
			)
		);
		
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name' => 'button_border',
				'selector' => '{{WRAPPER}} .your-button-element-class',
			)
		);

		$this->end_controls_section();

		// Style - Image
		$this->start_controls_section(
			'image_style',
			array(
				'label' => __( 'Image', 'responsive-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		
		$this->add_responsive_control(
			'image_fit',
			array(
				'label'   => __( 'Image Fit', 'responsive-addons-for-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'cover',
				'options' => array(
					'cover'   => __( 'Cover', 'responsive-addons-for-elementor' ),
					'contain' => __( 'Contain', 'responsive-addons-for-elementor' ),
					'fill'    => __( 'Fill', 'responsive-addons-for-elementor' ),
					'none'    => __( 'None', 'responsive-addons-for-elementor' ),
				),
				'selectors' => array(
					'{{WRAPPER}} .your-image-class' => 'object-fit: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'image_position',
			array(
				'label'   => __( 'Image Position', 'responsive-addons-for-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'center',
				'options' => array(
					'left'   => __( 'Left', 'responsive-addons-for-elementor' ),
					'center' => __( 'Center', 'responsive-addons-for-elementor' ),
					'right'  => __( 'Right', 'responsive-addons-for-elementor' ),
					'top'    => __( 'Top', 'responsive-addons-for-elementor' ),
					'bottom' => __( 'Bottom', 'responsive-addons-for-elementor' ),
				),
				'selectors' => array(
					'{{WRAPPER}} .your-image-class' => 'object-position: {{VALUE}};',
				),
			)
		);

		// Tabs: Normal & Hover
		$this->start_controls_tabs( 'image_tabs' );

		// Normal Tab
		$this->start_controls_tab(
			'image_tab_normal',
			array(
				'label' => __( 'Normal', 'responsive-addons-for-elementor' ),
			)
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			array(
				'name'     => 'image_css_filters',
				'selector' => '{{WRAPPER}} .your-image-class',
			)
		);

		$this->end_controls_tab();

		// Hover Tab
		$this->start_controls_tab(
			'image_tab_hover',
			array(
				'label' => __( 'Hover', 'responsive-addons-for-elementor' ),
			)
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			array(
				'name'     => 'image_hover_css_filters',
				'selector' => '{{WRAPPER}} .your-image-class:hover',
			)
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->end_controls_section();

	}

	private function get_elementor_templates() {
		$templates = array();
		$template_library = \Elementor\Plugin::instance()->templates_manager->get_source( 'local' )->get_items();

		if ( ! empty( $template_library ) ) {
			foreach ( $template_library as $template ) {
				$templates[ $template['template_id'] ] = $template['title'];
			}
		}

		return $templates;
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		// ============ WRAPPER ============
		$this->add_render_attribute( 'wrapper', 'class', [
			'rae-stacking-cards',
			'your-widget-wrapper',
			( isset($settings['rtl_enable']) && 'yes' === $settings['rtl_enable'] ) ? 'is-rtl' : '',
		] );

		// Optional: expose a few style controls as CSS variables for your stacking/hover CSS/JS.
		$css_vars = [];
		if ( ! empty( $settings['transform_origin_x']['size'] ) ) { $css_vars[] = '--sm-ox:' . floatval($settings['transform_origin_x']['size']) . '%'; }
		if ( ! empty( $settings['transform_origin_y']['size'] ) ) { $css_vars[] = '--sm-oy:' . floatval($settings['transform_origin_y']['size']) . '%'; }
		if ( ! empty( $settings['hover_scale']['size'] ) )       { $css_vars[] = '--hover-scale:' . floatval($settings['hover_scale']['size']); }
		if ( ! empty( $settings['hover_opacity']['size'] ) )     { $css_vars[] = '--hover-opacity:' . floatval($settings['hover_opacity']['size'])/100; }
		if ( ! empty( $settings['hover_blur']['size'] ) )        { $css_vars[] = '--hover-blur:' . floatval($settings['hover_blur']['size']) . 'px'; }
		if ( ! empty( $settings['hover_rotation'] ) )            { $css_vars[] = '--hover-rotate:' . floatval($settings['hover_rotation']) . 'deg'; }
		if ( $css_vars ) {
			$this->add_render_attribute( 'wrapper', 'style', implode(';', $css_vars) . ';' );
		}

		// Build items array from repeater or posts.
		$items = $this->build_items_for_render( $settings );

		echo '<div ' . $this->get_render_attribute_string( 'wrapper' ) . '>';

		foreach ( $items as $index => $item ) {
			$card_key     = 'card_' . $index;
			$content_key  = 'content_' . $index;
			$media_key    = 'media_' . $index;
			$btnwrap_key  = 'btnwrap_' . $index;
			$btn_key      = 'btn_' . $index;

        // Card container (use the class you targeted in style controls)
        $this->add_render_attribute( $card_key, 'class', [ 'rae-card', 'your-card-class' ] );

        // Content & media regions
        $this->add_render_attribute( $content_key, 'class', [ 'rae-card-content', 'your-content-class' ] );
        $this->add_render_attribute( $media_key, 'class', [ 'rae-card-media' ] );

        // Button wrap respects text-align selector you set on .your-button-class
        $btn_wrap_classes = [ 'rae-btn-wrap', 'your-button-class' ];
        $this->add_render_attribute( $btnwrap_key, 'class', $btn_wrap_classes );

        // Button element (full width vs auto)
        $btn_classes = [ 'rae-btn', 'your-button-element-class' ];
        if ( isset($settings['button_width_type']) && 'full' === $settings['button_width_type'] ) {
            $btn_classes[] = 'is-full';
        }
        $this->add_render_attribute( $btn_key, 'class', $btn_classes );

        // Link attributes
        if ( ! empty( $item['link_url'] ) ) {
            $this->add_link_attributes( $btn_key, [
                'url'        => $item['link_url'],
                'is_external'=> ! empty( $item['link_external'] ),
                'nofollow'   => ! empty( $item['link_nofollow'] ),
            ] );
        }

        echo '<div ' . $this->get_render_attribute_string( $card_key ) . '>';

            // ---------- MEDIA (right side in your screenshot) ----------
            echo '<div ' . $this->get_render_attribute_string( $media_key ) . '>';
                if ( ! empty( $item['image_html'] ) ) {
                    // Ensure image has the class targeted by your selectors
                    // (Group_Control_Image_Size returns <img>; we inject our class)
                    echo str_replace( '<img ', '<img class="your-image-class" ', $item['image_html'] );
                } elseif ( ! empty( $item['image_url'] ) ) {
                    echo '<img class="your-image-class" src="' . esc_url( $item['image_url'] ) . '" alt="' . esc_attr( wp_strip_all_tags( $item['title'] ) ) . '">';
                }
            echo '</div>';

            // ---------- CONTENT (left side in your screenshot) ----------
            echo '<div ' . $this->get_render_attribute_string( $content_key ) . '>';

                // Graphic element (icon/image/text) — respects your Graphic Element style section
                if ( ! empty( $settings['show_graphic_element'] ) && 'none' !== $settings['show_graphic_element'] ) {
                    echo '<div class="rae-graphic your-graphic-element-class">';
                        if ( 'image' === $settings['show_graphic_element'] && ! empty( $item['graphic_image_html'] ) ) {
                            echo str_replace( '<img ', '<img class="your-image-class" ', $item['graphic_image_html'] );
                        } elseif ( 'icon' === $settings['show_graphic_element'] && ! empty( $item['graphic_icon'] ) ) {
                            Icons_Manager::render_icon( $item['graphic_icon'], [ 'aria-hidden' => 'true', 'class' => 'rae-icon' ] );
                        } elseif ( 'text' === $settings['show_graphic_element'] && isset( $item['graphic_text'] ) ) {
                            echo '<span class="rae-graphic-text your-title-class">' . esc_html( $item['graphic_text'] ) . '</span>';
                        }
                    echo '</div>';
                }

                // Title
                if ( ! empty( $item['title'] ) && ( ! isset($settings['show_title']) || 'yes' === $settings['show_title'] ) ) {
                    $tag = ! empty( $settings['title_html_tag'] ) ? tag_escape( $settings['title_html_tag'] ) : 'div';
                    echo '<' . $tag . ' class="rae-title your-title-class">' . wp_kses_post( $item['title'] ) . '</' . $tag . '>';
                }

                // Description
                if ( ! empty( $item['desc'] ) && ( ! isset($settings['show_description']) || 'yes' === $settings['show_description'] ) ) {
                    echo '<div class="rae-desc your-description-class">' . wp_kses_post( $item['desc'] ) . '</div>';
                }

                // Button
                if ( ( ! isset($settings['show_button']) || 'yes' === $settings['show_button'] ) && ! empty( $item['link_url'] ) ) {
                    echo '<div ' . $this->get_render_attribute_string( $btnwrap_key ) . '>';
                        $btn_text = ! empty( $item['button_text'] ) ? $item['button_text'] : ( ! empty($settings['button_text']) ? $settings['button_text'] : __( 'Read More', 'responsive-addons-for-elementor' ) );
                        echo '<a ' . $this->get_render_attribute_string( $btn_key ) . '>' . esc_html( $btn_text ) . '</a>';
                    echo '</div>';
                }

            echo '</div>'; // .rae-card-content

        echo '</div>'; // .rae-card
    	}

    	echo '</div>'; // .rae-stacking-cards
}

	/**
 * Build items from repeater (Items) or from Posts.
 * Keeps fields your renderer expects: title, desc, image_html/url, button_text, link_*, graphic_*
 */
private function build_items_for_render( array $settings ): array {
    $items = [];

    // ---------- Items (repeater) ----------
    if ( isset($settings['source_type']) && 'items' === $settings['source_type'] && ! empty( $settings['items_list'] ) ) {
        foreach ( $settings['items_list'] as $item ) {
            // Main image (uses repeater image-size group control)
            $image_html = '';
            if ( ! empty( $item['item_image']['id'] ) ) {
                $image_html = Group_Control_Image_Size::get_attachment_image_html( $item, 'item_image_size', 'item_image' );
            } elseif ( ! empty( $item['item_image']['url'] ) ) {
                $image_html = '<img src="' . esc_url( $item['item_image']['url'] ) . '" alt="">';
            }

            // Graphic image (optional)
            $graphic_image_html = '';
            if ( ! empty( $item['graphic_image']['id'] ) ) {
                $graphic_image_html = Group_Control_Image_Size::get_attachment_image_html( $item, 'graphic_image_size', 'graphic_image' );
            } elseif ( ! empty( $item['graphic_image']['url'] ) ) {
                $graphic_image_html = '<img src="' . esc_url( $item['graphic_image']['url'] ) . '" alt="">';
            }

            $link = is_array( $item['item_link'] ?? null ) ? $item['item_link'] : [];

            $items[] = [
                'title'               => $item['item_title'] ?? '',
                'desc'                => $item['item_desc'] ?? '',
                'image_html'          => $image_html,
                'image_url'           => '', // not needed because we have HTML
                'button_text'         => $item['button_text'] ?? '',
                'link_url'            => $link['url'] ?? '',
                'link_external'       => ! empty( $link['is_external'] ),
                'link_nofollow'       => ! empty( $link['nofollow'] ),
                'graphic_image_html'  => $graphic_image_html,
                'graphic_icon'        => $item['graphic_icon'] ?? null,
                'graphic_text'        => $item['graphic_text'] ?? '',
            ];
        }

        return $items;
    }

    // ---------- Posts (basic mapping) ----------
    $query = new \WP_Query( [
        'post_type'           => 'post',
        'posts_per_page'      => 3,
        'ignore_sticky_posts' => true,
        'no_found_rows'       => true,
    ] );

    if ( $query->have_posts() ) {
        while ( $query->have_posts() ) {
            $query->the_post();
            $post_id = get_the_ID();

            // Image size set in your "General › Item Image Size" select
            $img_size = ! empty( $settings['item_image_size'] ) ? $settings['item_image_size'] : 'medium_large';
            $img_url  = get_the_post_thumbnail_url( $post_id, $img_size );

            $items[] = [
                'title'         => get_the_title(),
                'desc'          => wp_trim_words( get_the_excerpt() ?: wp_strip_all_tags( get_the_content() ), 24 ),
                'image_html'    => '',
                'image_url'     => $img_url ?: '',
                'button_text'   => $settings['button_text'] ?? __( 'Read More', 'responsive-addons-for-elementor' ),
                'link_url'      => get_permalink( $post_id ),
                'link_external' => false,
                'link_nofollow' => false,
                // no graphic element by default for posts
                'graphic_image_html' => '',
                'graphic_icon'       => null,
                'graphic_text'       => '',
            ];
        }
        wp_reset_postdata();
    }

    return $items;
}
	protected function content_template() {
	?>
	<div class="rae-stacking-cards-wrapper">
		<# if ( settings.items_list && settings.items_list.length ) { #>
			<# jQuery.each( settings.items_list, function( item ) { #>
				<div class="rae-stacking-card elementor-repeater-item-{{ item._id }}">
					<div class="rae-card-media">
						<# if ( item.image && item.image.url ) { #>
							<img src="{{ item.image.url }}" alt="{{ item.title }}">
						<# } #>
					</div>
					<div class="rae-card-content">
						<# if ( item.title ) { #>
							<h3 class="rae-title">{{{ item.title }}}</h3>
						<# } #>
						<# if ( item.desc ) { #>
							<p class="rae-desc">{{{ item.desc }}}</p>
						<# } #>
						<# if ( item.button_text && item.link_url && item.link_url.url ) { #>
							<a href="{{ item.link_url.url }}" class="rae-btn">{{{ item.button_text }}}</a>
						<# } #>
					</div>
				</div>
			<# }); #>
		<# } #>
	</div>
	<?php
}


}