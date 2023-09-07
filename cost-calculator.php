<?php
/**
 *
 * @since 1.0.0
 */
use Elementor\Repeater;
use Elementor\Group_Control_Css_Filter;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Background;

defined( 'ABSPATH' ) || die();

class Rsaddon_Elementor_pro_Cost_Calculator_Widget extends \Elementor\Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve counter widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'rs-cost-calculator';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve counter widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'RS Cost Calculator', 'rsaddon' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve counter widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'glyph-icon flaticon-spreadsheet';
	}

	/**
	 * Retrieve the list of scripts the counter widget depended on.
	 *
	 * Used to set scripts dependencies required to run the widget.
	 *
	 * @since 1.3.0
	 * @access public
	 *
	 * @return array Widget scripts dependencies.
	 */
	public function get_categories() {
        return [ 'rsaddon_category' ];
    }
	/**
	 * Register services widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */

	// Register Controlls
	protected function register_controls() {
		$this->register_cost_calculator_content_controls();
		$this->register_cost_calculator_wrapper_style_controls();
		$this->register_cost_calculator_range_slider_style_controls();
		$this->register_cost_calculator_label_style_controls();
		$this->register_cost_calculator_dropdown_style_controls();
		$this->register_cost_calculator_extra_charges_style_controls();
		$this->register_cost_calculator_price_result_lis_style_controls();
		$this->register_cost_calculator_total_amount_style_controls();
	}

	// Content Dynamic Input Start
	protected function register_cost_calculator_content_controls()
    {
		$this->start_controls_section(
			'section_cost_calculator_content',
			[
				'label' => esc_html__( 'Calculator', 'rsaddon' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
		// Price based area start
		$this->add_control(
			'curreny_sign',
			[
				'label'       => esc_html__( 'Curreny Sign', 'rsaddon' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'placeholder' => esc_html__( '$', 'rsaddon' ),
				'default' => '$',
			]
		);
		$this->add_control(
			'area_based_on',
			[
				'label'       => esc_html__( 'Area Based On', 'rsaddon' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'placeholder' => esc_html__( 'SQFT', 'rsaddon' ),
				'default' => 'SQFT',
			]
		);
		$this->add_control(
			'heading_area',
			[
				'label' => esc_html__( 'Area', 'rsaddon' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		
		$this->add_control(
			'area_title',
			[
				'label'       => esc_html__( 'Title', 'rsaddon' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'placeholder' => esc_html__( 'Roofing Area', 'rsaddon' ),
				'default' => 'Roofing Area',
			]
		);
		$this->add_control(
			'multiplyed_number',
			[
				'label'       => esc_html__( 'Multiply Area With', 'rsaddon' ),
				'type'        => Controls_Manager::NUMBER,
				'placeholder' => esc_html__( '3', 'rsaddon' ),
				'default' => '3',
			]
		);
		// Price based area End

		// Type of services start
		$this->add_control(
			'heading_services',
			[
				'label' => esc_html__( 'Services', 'rsaddon' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'service_title',
			[
				'label'       => esc_html__( 'Title', 'rsaddon' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'placeholder' => esc_html__( 'Type of Services', 'rsaddon' ),
				'default' => 'Type of Services',
			]
		);
		$repeater = new Repeater();
		$repeater->add_control(
			'service_option_list',
			[
				'label'       => esc_html__( 'Option List', 'rsaddon' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'placeholder' => esc_html__( 'Select Services', 'rsaddon' ),
				'default' => 'Select Services',
			]
		);
		$repeater->add_control(
			'service_option_value',
			[
				'label'       => esc_html__( 'Put The Value', 'rsaddon' ),
				'type'        => Controls_Manager::NUMBER,
				'placeholder' => esc_html__( 'Option Value', 'rsaddon' ),
				'default' => '0',
			]
		);
		$this->add_control(
			'services_options',
			[
				'label' => esc_html__( 'Services Options', 'rsaddon' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'service_option_list' => esc_html__( 'Select Services', 'rsaddon' ),
						'service_option_value' => esc_html__( '0', 'rsaddon' ),
					],
					[
						'service_option_list' => esc_html__( 'Roof Repair', 'rsaddon' ),
						'service_option_value' => esc_html__( '100', 'rsaddon' ),
					],
					[
						'service_option_list' => esc_html__( 'Roof Installation', 'rsaddon' ),
						'service_option_value' => esc_html__( '246', 'rsaddon' ),
					],
				],
				'title_field' => '{{{ service_option_list }}}',
			]
		);
		// Type of services end

		// Worker List start
		$this->add_control(
			'heading_workers',
			[
				'label' => esc_html__( 'Workers', 'rsaddon' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'worker_title',
			[
				'label'       => esc_html__( 'Title', 'rsaddon' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'placeholder' => esc_html__( 'Worker Number', 'rsaddon' ),
				'default' => 'Worker Number',
			]
		);
		$repeater2 = new Repeater();
		$repeater2->add_control(
			'worker_option_list',
			[
				'label'       => esc_html__( 'Option List', 'rsaddon' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'placeholder' => esc_html__( '1 Worker', 'rsaddon' ),
				'default' => '1 Worker',
			]
		);
		$repeater2->add_control(
			'worker_option_value',
			[
				'label'       => esc_html__( 'Put The Value', 'rsaddon' ),
				'type'        => Controls_Manager::NUMBER,
				'placeholder' => esc_html__( 'Option Value', 'rsaddon' ),
				'default' => '0',
			]
		);
		$this->add_control(
			'worker_options',
			[
				'label' => esc_html__( 'Worker Options', 'rsaddon' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater2->get_controls(),
				'default' => [
					[
						'worker_option_list' => esc_html__( '1 Worker', 'rsaddon' ),
						'worker_option_value' => esc_html__( '0', 'rsaddon' ),
					],
					[
						'worker_option_list' => esc_html__( '2 Worker', 'rsaddon' ),
						'worker_option_value' => esc_html__( '180', 'rsaddon' ),
					],
					[
						'worker_option_list' => esc_html__( '4 Worker', 'rsaddon' ),
						'worker_option_value' => esc_html__( '320', 'rsaddon' ),
					],
					[
						'worker_option_list' => esc_html__( '5 Worker', 'rsaddon' ),
						'worker_option_value' => esc_html__( '600', 'rsaddon' ),
					],
				],
				'title_field' => '{{{ worker_option_list }}}',
			]
		);
		// Worker List End

		// Extra Charge start
		$this->add_control(
			'heading_extra_charge',
			[
				'label' => esc_html__( 'Extra Charge', 'rsaddon' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'extra_charge_title',
			[
				'label'       => esc_html__( 'Title', 'rsaddon' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'placeholder' => esc_html__( 'Need Emergency', 'rsaddon' ),
				'default' => 'Need Emergency',
			]
		);
		$this->add_control(
			'extra_charge_amount',
			[
				'label'       => esc_html__( 'Extra Charge Amount', 'rsaddon' ),
				'type'        => Controls_Manager::NUMBER,
				'label_block' => false,
				'placeholder' => esc_html__( '50', 'rsaddon' ),
				'default' => '50',
			]
		);
		// Extra Charge End

		// Extra Charge start
		$this->add_control(
			'heading_total_amount',
			[
				'label' => esc_html__( 'Total Amount', 'rsaddon' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'total_amount_title',
			[
				'label'       => esc_html__( 'Title', 'rsaddon' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'placeholder' => esc_html__( 'Total Amount:', 'rsaddon' ),
				'default' => 'Total Amount:',
			]
		);
		$this->end_controls_section();
	}
	// Content Dynamic Input End

	// Content Wrapper Style Start
	protected function register_cost_calculator_wrapper_style_controls()
    {
		$this->start_controls_section(
			'_wrapper_style',
		    [
				'label' => esc_html__( 'Wrapper Style', 'rsaddon' ),
		        'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'wrapper_bg',
				'types' => [ 'classic', 'gradient'],
				'selector' => '{{WRAPPER}} .rs-addon-cost-calculator',
			]
		);
		$this->add_responsive_control(
            'wrapper_padding',
            [
                'label' => esc_html__( 'Padding', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-cost-calculator' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'wrapper_margin',
            [
                'label' => esc_html__( 'Margin', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-cost-calculator' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'wrapper_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-cost-calculator' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'wrapper_border',
				'selector' => '{{WRAPPER}} .rs-addon-cost-calculator',
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'wrapper_box_shadow',
				'exclude' => [
					'box_shadow_position',
				],
				'selector' => '{{WRAPPER}} .rs-addon-cost-calculator'
			]
		);

		$this->add_control(
			'heading_items_general',
			[
				'label' => esc_html__( 'Items Control', 'rsaddon' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
            'items_margin',
            [
                'label' => esc_html__( 'Margin', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-cost-calculator .cost_calculator .area-ctrol' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
		$this->add_responsive_control(
            'items_margin_first_child',
            [
                'label' => esc_html__( 'Margin (First Item)', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-cost-calculator .cost_calculator .area-ctrol:first-child' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
		$this->add_responsive_control(
            'items_margin_last_child',
            [
                'label' => esc_html__( 'Margin (Last Item)', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-cost-calculator .cost_calculator .area-ctrol:last-child' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
		$this->end_controls_section();
	}
	// Content Wrapper Style End

	// Range Slider Style Start
	protected function register_cost_calculator_range_slider_style_controls()
    {
		$this->start_controls_section(
			'_range_slider_style',
		    [
				'label' => esc_html__( 'Range Slider Style', 'rsaddon' ),
		        'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
            'range_slider_width',
            [
                'label' => esc_html__( 'Width', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'show_label' => true,
				'size_units' => [ '%', 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-cost-calculator .cost_calculator .area-ctrol input[type=range]' => 'width: {{SIZE}}{{UNIT}};',                   
                ],
            ]
        );
		$this->add_responsive_control(
            'range_slider_height',
            [
                'label' => esc_html__( 'Height', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'show_label' => true,
				'size_units' => [ '%', 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-cost-calculator .cost_calculator .area-ctrol input[type=range]' => 'height: {{SIZE}}{{UNIT}};',                   
                ],
            ]
        );
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'range_slider_bg_color',
				'label' => esc_html__( 'Background', 'rsaddon' ),
				'types' => [ 'classic', 'gradient'],
				'selector' => '{{WRAPPER}} .rs-addon-cost-calculator .cost_calculator .area-ctrol input[type=range]',  
			]
		);
		$this->add_responsive_control(
            'range_slider_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-cost-calculator .cost_calculator .area-ctrol input[type=range]' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
		$this->add_group_control(
		    Group_Control_Border::get_type(),
		    [
		        'name' => 'range_slider_border',
		        'selector' => '{{WRAPPER}} .rs-addon-cost-calculator .cost_calculator .area-ctrol input[type=range]',
		    ]
		);

		$this->add_control(
            'heading_range_slider_pointer',
            [
                'type' => Controls_Manager::HEADING,
                'label' => esc_html__( 'Slider Pointer', 'rsaddon' ),
                'separator' => 'before',
            ]
        );
		$this->add_responsive_control(
            'range_slider_pointer_width',
            [
                'label' => esc_html__( 'Width', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'show_label' => true,
				'size_units' => [ '%', 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-cost-calculator .cost_calculator .area-ctrol input[type=range]::-webkit-slider-thumb' => 'width: {{SIZE}}{{UNIT}};',                   
                    '{{WRAPPER}} .rs-addon-cost-calculator .cost_calculator .area-ctrol input[type=range]::-moz-range-thumb' => 'width: {{SIZE}}{{UNIT}};',                   
                ],
            ]
        );
		$this->add_responsive_control(
            'range_slider_pointer_height',
            [
                'label' => esc_html__( 'Height', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'show_label' => true,
				'size_units' => [ '%', 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-cost-calculator .cost_calculator .area-ctrol input[type=range]::-webkit-slider-thumb' => 'height: {{SIZE}}{{UNIT}};',                   
                    '{{WRAPPER}} .rs-addon-cost-calculator .cost_calculator .area-ctrol input[type=range]::-moz-range-thumb' => 'height: {{SIZE}}{{UNIT}};',                   
                ],
            ]
        );
		$this->add_control(
			'range_slider_pointer_bg',
			[
				'label' => esc_html__( 'Background Color', 'rsaddon' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rs-addon-cost-calculator .cost_calculator .area-ctrol input[type=range]::-webkit-slider-thumb' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .rs-addon-cost-calculator .cost_calculator .area-ctrol input[type=range]::-moz-range-thumb' => 'background-color: {{VALUE}}',
				]
			]
		);
		$this->add_responsive_control(
            'range_slider_pointer_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-cost-calculator .cost_calculator .area-ctrol input[type=range]::-webkit-slider-thumb' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .rs-addon-cost-calculator .cost_calculator .area-ctrol input[type=range]::-moz-range-thumb' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
		$this->add_control(
			'range_slider_pointer_box_shadow_color',
			[
				'label' => esc_html__( 'Shadow Color', 'rsaddon' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rs-addon-cost-calculator .cost_calculator .area-ctrol input[type=range]::-webkit-slider-thumb' => 'box-shadow: 0px 0px 10px 0px {{VALUE}}',
					'{{WRAPPER}} .rs-addon-cost-calculator .cost_calculator .area-ctrol input[type=range]::-moz-range-thumb' => 'box-shadow: 0px 0px 10px 0px {{VALUE}}',
				]
			]
		);

		$this->add_control(
            'heading_range_slider_result',
            [
                'type' => Controls_Manager::HEADING,
                'label' => esc_html__( 'Slider Result', 'rsaddon' ),
                'separator' => 'before',
            ]
        );
		$this->add_control(
			'range_slider_result_color',
			[
				'label' => esc_html__( 'Text Color', 'rsaddon' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rs-addon-cost-calculator .cost_calculator .area-ctrol.area-calculate .range-inner .range_result' => 'color: {{VALUE}}',
				]
			]
		);
		$this->add_group_control(
		    Group_Control_Typography::get_type(),
		    [
		        'name' => 'range_slider_result_typography',
		        'label' => esc_html__( 'Typography', 'rsaddon' ),
				'selector' => '.rs-addon-cost-calculator .cost_calculator .area-ctrol.area-calculate .range-inner .range_result',
		    ]
		);
		$this->end_controls_section();
	}
	// Range Slider Style End

	// Content Label Style Start
	protected function register_cost_calculator_label_style_controls()
    {
		$this->start_controls_section(
			'_label_style',
		    [
				'label' => esc_html__( 'Label Style', 'rsaddon' ),
		        'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
		    Group_Control_Typography::get_type(),
		    [
		        'name' => 'label_typography',
		        'label' => esc_html__( 'Typography', 'rsaddon' ),
		        'selector' => '{{WRAPPER}} .rs-addon-cost-calculator .cost_calculator .area-ctrol label',
		    ]
		);
		$this->add_control(
            'label_color',
            [
                'label' => esc_html__( 'Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-cost-calculator .cost_calculator .area-ctrol label' => 'color: {{VALUE}};',                   
                ],
            ]
        );
		$this->add_control(
            'label_bg_color',
            [
                'label' => esc_html__( 'Background Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-cost-calculator .cost_calculator .area-ctrol label' => 'background: {{VALUE}};',                   
                ],
            ]
        );
		$this->add_responsive_control(
            'label_padding',
            [
                'label' => esc_html__( 'Padding', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-cost-calculator .cost_calculator .area-ctrol label' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'label_margin',
            [
                'label' => esc_html__( 'Margin', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-cost-calculator .cost_calculator .area-ctrol label' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'label_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-cost-calculator .cost_calculator .area-ctrol label' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
		$this->end_controls_section();
	}
	// Content Label Style End

	// Content dropdown Style Start
	protected function register_cost_calculator_dropdown_style_controls()
    {
		$this->start_controls_section(
			'_dropdown_style',
		    [
				'label' => esc_html__( 'Dropdown Style', 'rsaddon' ),
		        'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
            'dropdown_width',
            [
                'label' => esc_html__( 'Width', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'show_label' => true,
				'size_units' => [ '%', 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-cost-calculator .cost_calculator .area-ctrol:not(.area-calculate) > *:not(label)' => 'width: {{SIZE}}{{UNIT}}; flex: 0 0 {{SIZE}}{{UNIT}};',                   
                ],
            ]
        );
		$this->add_responsive_control(
            'dropdown_height',
            [
                'label' => esc_html__( 'Height', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'show_label' => true,
				'size_units' => [ '%', 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-cost-calculator .cost_calculator .area-ctrol .select-option select' => 'height: {{SIZE}}{{UNIT}};',                   
                ],
            ]
        );
		$this->add_group_control(
		    Group_Control_Typography::get_type(),
		    [
		        'name' => 'dropdown_typography',
		        'label' => esc_html__( 'Typography', 'rsaddon' ),
		        'selector' => '{{WRAPPER}} .rs-addon-cost-calculator .cost_calculator .area-ctrol .select-option select',
		    ]
		);
		$this->add_control(
            'dropdown_color',
            [
                'label' => esc_html__( 'Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-cost-calculator .cost_calculator .area-ctrol .select-option select, {{WRAPPER}} .rs-addon-cost-calculator .cost_calculator .area-ctrol .select-option:after' => 'color: {{VALUE}};',                   
                ],
            ]
        );
		$this->add_control(
            'dropdown_bg_color',
            [
                'label' => esc_html__( 'Background Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-cost-calculator .cost_calculator .area-ctrol .select-option select' => 'background: {{VALUE}};',                   
                ],
            ]
        );
		$this->add_responsive_control(
            'dropdown_padding',
            [
                'label' => esc_html__( 'Padding', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-cost-calculator .cost_calculator .area-ctrol .select-option select' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'dropdown_margin',
            [
                'label' => esc_html__( 'Margin', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-cost-calculator .cost_calculator .area-ctrol .select-option select' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'dropdown_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-cost-calculator .cost_calculator .area-ctrol .select-option select' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'dropdown_border',
				'selector' => '{{WRAPPER}} .rs-addon-cost-calculator .cost_calculator .area-ctrol .select-option select',
			]
		);
		$this->end_controls_section();
	}
	// Content dropdown Style End

	// Extra Charges Part Style Start
	protected function register_cost_calculator_extra_charges_style_controls()
    {
		$this->start_controls_section(
			'_extra_charges_style',
		    [
				'label' => esc_html__( 'Extra Charges Part', 'rsaddon' ),
		        'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'check_box_color',
			[
				'label' => esc_html__( 'Check Box Color', 'rsaddon' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rs-addon-cost-calculator .cost_calculator .area-ctrol input[type=checkbox]' => 'border-color: {{VALUE}}',
					'{{WRAPPER}} .rs-addon-cost-calculator .cost_calculator .area-ctrol input[type=checkbox]:before' => 'box-shadow: inset 1.1em 1.1em {{VALUE}}',
				]
			]
		);
		$this->add_control(
			'charge_text_color',
			[
				'label' => esc_html__( 'Text Color', 'rsaddon' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rs-addon-cost-calculator .cost_calculator .area-ctrol.emergency-calculate .emergency-inner' => 'color: {{VALUE}}',
				]
			]
		);
		$this->add_group_control(
		    Group_Control_Typography::get_type(),
		    [
		        'name' => 'charge_text_typography',
		        'label' => esc_html__( 'Typography', 'rsaddon' ),
				'selector' => '{{WRAPPER}} .rs-addon-cost-calculator .cost_calculator .area-ctrol.emergency-calculate .emergency-inner',
		    ]
		);
		$this->end_controls_section();
	}
	// Extra Charges Part Style End

	// Price Result List Style Start
	protected function register_cost_calculator_price_result_lis_style_controls()
    {
		$this->start_controls_section(
			'_price_result_list_style',
		    [
				'label' => esc_html__( 'Result List Style', 'rsaddon' ),
		        'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'price_result_list_color',
			[
				'label' => esc_html__( 'Text Color', 'rsaddon' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rs-addon-cost-calculator .result-area .calculate_list, {{WRAPPER}} .rs-addon-cost-calculator .result-area .range_result2' => 'color: {{VALUE}}',
				]
			]
		);
		$this->add_group_control(
		    Group_Control_Typography::get_type(),
		    [
		        'name' => 'price_result_listt_typography',
		        'label' => esc_html__( 'Typography', 'rsaddon' ),
				'selector' => '{{WRAPPER}} .rs-addon-cost-calculator .result-area .calculate_list, {{WRAPPER}} .rs-addon-cost-calculator .result-area .range_result2',
		    ]
		);
		$this->end_controls_section();
	}
	// Price Result List Style End

	// Total Amount Style Start
	protected function register_cost_calculator_total_amount_style_controls()
    {
		$this->start_controls_section(
			'_total_amount_style',
		    [
				'label' => esc_html__( 'Total Amount', 'rsaddon' ),
		        'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'heading_total_amount_wrapper',
			[
				'label' => esc_html__( 'Wrapper', 'rsaddon' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
            'total_amount_wrapper_bg_color',
            [
                'label' => esc_html__( 'Background Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-cost-calculator .result-area .total' => 'background: {{VALUE}};',                   
                ],
            ]
        );
		$this->add_responsive_control(
            'total_amount_wrapper_padding',
            [
                'label' => esc_html__( 'Padding', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-cost-calculator .result-area .total' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'total_amount_wrapper_margin',
            [
                'label' => esc_html__( 'Margin', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-cost-calculator .result-area .total' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'total_amount_wrapper_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-cost-calculator .result-area .total' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
		$this->add_group_control(
		    Group_Control_Border::get_type(),
		    [
		        'name' => 'total_amount_wrapper_border',
		        'selector' => '{{WRAPPER}} .rs-addon-cost-calculator .result-area .total',
		    ]
		);

		$this->add_control(
			'heading_total_amount_title',
			[
				'label' => esc_html__( 'Title', 'rsaddon' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_group_control(
		    Group_Control_Typography::get_type(),
		    [
		        'name' => 'total_amount_title_typography',
		        'label' => esc_html__( 'Typography', 'rsaddon' ),
				'selector' => '{{WRAPPER}} .rs-addon-cost-calculator .result-area .total span',
		    ]
		);
		$this->add_control(
            'total_amount_title_color',
            [
                'label' => esc_html__( 'Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-cost-calculator .result-area .total span' => 'color: {{VALUE}};',                   
                ],
            ]
        );
		$this->add_responsive_control(
            'total_amount_title_margin',
            [
                'label' => esc_html__( 'Margin', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-cost-calculator .result-area .total span' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

		$this->add_control(
			'heading_total_amount_price',
			[
				'label' => esc_html__( 'Price', 'rsaddon' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_group_control(
		    Group_Control_Typography::get_type(),
		    [
		        'name' => 'total_amount_price_typography',
		        'label' => esc_html__( 'Typography', 'rsaddon' ),
				'selector' => '{{WRAPPER}} .rs-addon-cost-calculator .result-area .total p',
		    ]
		);
		$this->add_control(
            'total_amount_price_color',
            [
                'label' => esc_html__( 'Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-cost-calculator .result-area .total p' => 'color: {{VALUE}};',                   
                ],
            ]
        );
		$this->add_responsive_control(
            'total_amount_price_padding',
            [
                'label' => esc_html__( 'Padding', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-cost-calculator .result-area .total p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
		$this->add_responsive_control(
            'total_amount_price_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-cost-calculator .result-area .total p' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
		$this->add_group_control(
		    Group_Control_Border::get_type(),
		    [
		        'name' => 'total_amount_price_border',
		        'selector' => '{{WRAPPER}} .rs-addon-cost-calculator .result-area .total p',
		    ]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'total_amount_pricebg_color',
				'label' => esc_html__( 'Background', 'rsaddon' ),
				'types' => [ 'classic', 'gradient'],
				'selector' => '{{WRAPPER}} .rs-addon-cost-calculator .result-area .total p',  
			]
		);
		$this->end_controls_section();
	}
	// Total Amount Style End

	/**
	 * Render counter widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	/**
	 * Render counter widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		$multiplyed_number = $settings['multiplyed_number'];
		$curreny_sign = $settings['curreny_sign'];
		
		?>

		<div class="rs-addon-cost-calculator">
			<form class="cost_calculator" id="cost_calculator" method="post" action="#">
				<div class="area-calculate area-ctrol">
					<div class="range-inner">
						<label for="sqft"><?php echo esc_attr($settings['area_title']); ?></label>
						<div class="range_result"></div>
					</div>
					<input id="sqft" name="sqft" type="range" value="700" min="0" max="5000" step="1" data-label="<?php echo esc_attr($settings['area_based_on']); ?>">
				</div>
				<div class="type-calculate area-ctrol">
					<label for="type-service"><?php echo esc_attr($settings['service_title']); ?></label>
					<div class="select-option">
						<select name="Type" id="type-service">
						<?php
							foreach ( $settings['services_options'] as $item ) { 
								$service_option_list = $item['service_option_list'];
								$service_option_value = $item['service_option_value'];
							?>
							<option value="<?php echo esc_html($service_option_value);?>"><?php echo esc_html($service_option_list);?></option>
						<?php } ?>
						</select>
					</div>
				</div>
				<div class="worker-calculate area-ctrol">
					<label for="worker"><?php echo esc_attr($settings['worker_title']); ?></label>
					<div class="select-option">
						<select name="worker" id="worker">
						<?php
							foreach ( $settings['worker_options'] as $item ) { 
								$worker_option_list = $item['worker_option_list'];
								$worker_option_value = $item['worker_option_value'];
							?>
							<option value="<?php echo esc_html($worker_option_value);?>"><?php echo esc_html($worker_option_list);?></option>
						<?php } ?>
						</select>
					</div>
				</div>
				<div class="emergency-calculate area-ctrol">
					<label for="emergency"><?php echo esc_attr($settings['extra_charge_title']); ?></label>
					<div class="emergency-inner">
						<input id="emergency" type="checkbox" name="emergency" value="<?php echo esc_attr($settings['extra_charge_amount']); ?>">
						<?php echo esc_html__("Extra fees:","rsaddons");?> <?php echo $curreny_sign;?><?php echo esc_attr($settings['extra_charge_amount']); ?>
					</div>
				</div>
			</form>

			<div class="result-area">
				<div class="range_result2"></div>
				<div class="calculate_list"></div>
				<div class="total">
					<span><?php echo esc_attr($settings['total_amount_title']); ?></span>
					<p class="calculate_price"></p>
				</div>
			</div>
		</div>
		<script>
			jQuery(function() {
				var fields = jQuery('#cost_calculator :input').change(calculate);
				var currencySign = '<?php echo $curreny_sign; ?>';

				if (jQuery("#cost_calculator").length > 0) {
					jQuery("#cost_calculator option").text(function(i, t) {
						if (this.value !== "0")
							return t + " - <?php echo $curreny_sign; ?>" + this.value;
					}).first().change();
				}

				function calculate() {
					var price = 0;
					var rangeTotal = 0;
					var list = [];
					var rangeList = [];

					fields.each(function() {
						if (jQuery(this).is(":checkbox") && !jQuery(this).is(":checked")) {
							return;
						}
						if (jQuery(this).attr("type") === "range") {
							var rangeValue = +jQuery(this).val();
							price += rangeValue;
							rangeList.push(jQuery(this).attr("data-label") + ": " + rangeValue);
						} else {
							price += +jQuery(this).val();
							if (jQuery(this).val() > 0 && !jQuery(this).find("option:selected").text().includes("* 3"))
								list.push(jQuery(this).find("option:selected").text());
						}
					});

					if (jQuery(".calculate_list").length > 0) {
						jQuery(".calculate_list").html(list.join("<br>"));
					}

					var totalPrice = price + rangeTotal;

					if (jQuery('.calculate_price').length > 0) {
						jQuery('.calculate_price').html(totalPrice.toFixed(2));
					}

					if (jQuery(".range_result").length > 0) {
						var rangeResultOutput = rangeList.join("<br>");
						jQuery(".range_result").html(rangeResultOutput);
					}

					var multiplied = '<?php echo $multiplyed_number; ?>';

					if (jQuery(".range_result2").length > 0) {
						var rangeResult2Output = rangeList.map(function(item) {
							var value = parseInt(item.split(":")[1].trim());
							var multipliedValue = value * multiplied;
							return '<span>' + item + '</span>' + " (Area Cost: <?php echo $curreny_sign; ?>" + multipliedValue + ")";
						}).join("<br>");

						jQuery(".range_result2").html(rangeResult2Output);
					}

					var extractedValue = rangeList.reduce(function(sum, item) {
						var value = parseInt(item.split(":")[1].trim());
						return sum + value;
					}, 0);

					if (jQuery('.calculate_price').length > 0) {
						var totalPriceWithMultiplier = totalPrice - extractedValue + extractedValue * multiplied;
						jQuery('.calculate_price').html('<?php echo $curreny_sign; ?>' + totalPriceWithMultiplier.toFixed(2));
					}
				}
			});
		</script>
	<?php
	}
}