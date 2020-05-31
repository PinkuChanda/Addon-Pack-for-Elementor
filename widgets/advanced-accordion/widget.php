<?php
namespace AddonPack\Elementor\Widget;

use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;


if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Advanced_Accordion extends Widget_Base {

	public function get_name() {
		return 'addon-pack-advanced-accordion';
	}

	public function get_title() {
		return __( 'Advanced Accordion', 'addon-pack' );
	}

	public function get_icon() {
		return 'eicon-accordion';
	}

	public function get_categories() {
		return array('addon-pack');
	}
	
	protected function _register_controls() {
		$this->register_general_controls();
		$this->register_heading_style_controls();
	}
	
	protected function register_general_controls(){

        $this->start_controls_section(
			'ap_general_settings',
			[
				'label' => __( 'General', 'addon-pack' ),
			]
        );

		$this->add_control(
			'ap_accordion_multiple',
			[
				'label' => __( 'Multiple Open', 'addon-pack' ),
				'type'  => Controls_Manager::SWITCHER,
			]
        );
        
        $this->add_control(
			'ap_accordion_icon',
			[
				'label'       => __( 'Icon', 'addon-pack' ),
				'type'        => Controls_Manager::ICON,
				'default'     => 'fa fa-plus',
				'label_block' => true,
			]
		);

		$this->add_control(
			'ap_accordion_icon_active',
			[
				'label'       => __( 'Active Icon', 'addon-pack' ),
				'type'        => Controls_Manager::ICON,
				'default'     => 'fa fa-minus',
				'label_block' => true,
				'condition'   => [
					'ap_accordion_icon!' => '',
				],
			]
		);
		
		$this->add_control(
            'ap_accordion_icon_position',
            [
                'type' => Controls_Manager::CHOOSE,
                'label' => __( 'Icon Position', 'addon-pack' ),
                'default' => 'left',
                'toggle' => false,
                'options' => [
                    'left' => [
                        'title' =>  __( 'Left', 'addon-pack' ),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'right' => [
                        'title' =>  __( 'Right', 'addon-pack' ),
                        'icon' => 'eicon-h-align-right',
                    ],
                ],
                'prefix_class' => 'ap-accordion-icon-',
            ]
		);
		
		$this->add_responsive_control(
			'ap_accordion_align',
			[
				'label'   => __( 'Content Alignment', 'addon-pack' ),
				'type'    => Controls_Manager::CHOOSE,
				'options' => [
					'left'    => [
						'title' => __( 'Left', 'addon-pack' ),
						'icon'  => 'fa fa-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'addon-pack' ),
						'icon'  => 'fa fa-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'addon-pack' ),
						'icon'  => 'fa fa-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .ap-accordion .ap-accordion-title'   => 'text-align: {{VALUE}};',
					'{{WRAPPER}} .ap-accordion .ap-accordion-content' => 'text-align: {{VALUE}};',
				],
			]
		);

        $this->end_controls_section();

		$this->start_controls_section(
			'ap_accordion_item_settings',
			[
				'label' => __( 'Accordion Item', 'addon-pack' ),
			]
		);

        $this->add_control(
			'ap_accordion_item_tabs',
			[
				'label'   => __( 'Items', 'addon-pack' ),
				'type'    => Controls_Manager::REPEATER,
				'default' => [
					[
						'tab_title'   => __( 'Accordion Title 1', 'addon-pack' ),
						'tab_content' => __( 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Optio, neque qui velit. Magni dolorum quidem ipsam eligendi, totam, facilis laudantium cum accusamus ullam voluptatibus commodi numquam, error, est. Ea, consequatur.', 'addon-pack' ),
					],
					[
						'tab_title'   => __( 'Accordion Title 2', 'addon-pack' ),
						'tab_content' => __( 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Optio, neque qui velit. Magni dolorum quidem ipsam eligendi, totam, facilis laudantium cum accusamus ullam voluptatibus commodi numquam, error, est. Ea, consequatur.', 'addon-pack' ),
					],
					[
						'tab_title'   => __( 'Accordion Title 3', 'addon-pack' ),
						'tab_content' => __( 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Optio, neque qui velit. Magni dolorum quidem ipsam eligendi, totam, facilis laudantium cum accusamus ullam voluptatibus commodi numquam, error, est. Ea, consequatur.', 'addon-pack' ),
					],
				],
				'fields' => [
                    [
                        'name' => 'eael_adv_accordion_tab_default_active',
                        'label' => esc_html__('Active as Default', 'addon-pack'),
                        'type' => Controls_Manager::SWITCHER,
                        'default' => 'no',
                        'return_value' => 'yes',
                    ],
					[
						'name'        => 'tab_title',
						'label'       => __( 'Title & Content', 'addon-pack' ),
						'type'        => Controls_Manager::TEXT,
						'dynamic'     => [ 'active' => true ],
						'default'     => __( 'Accordion Title' , 'addon-pack' ),
						'label_block' => true,
					],
					[
						'name'    => 'source',
						'label'   => esc_html__( 'Select Source', 'addon-pack' ),
						'type'    => Controls_Manager::SELECT,
						'default' => 'custom',
						'options' => [
							'custom'    => esc_html__( 'Custom', 'addon-pack' ),
							"elementor" => esc_html__( 'Elementor Template', 'addon-pack' ),
						],
					],
					[
						'name'       => 'tab_content',
						'label'      => __( 'Content', 'addon-pack' ),
						'type'       => Controls_Manager::WYSIWYG,
						'dynamic'    => [ 'active' => true ],
						'default'    => __( 'Accordion Content', 'addon-pack' ),
						'show_label' => false,
						'condition'  => ['source' => 'custom'],
					],
					
				],
				'title_field' => '{{{ tab_title }}}',
			]
        );
        
        
        $this->end_controls_section();
        
	}

	protected function register_heading_style_controls(){
		$this->start_controls_section(
			'ap_accordion_general_style',
			[
				'label' => __( 'General Style', 'addon-pack' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
            'ap_accordion_padding',
            [
                'label' => esc_html__('Padding', 'addon-pack'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .ap-accordion' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'ap_accordion_margin',
            [
                'label' => esc_html__('Margin', 'addon-pack'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .ap-accordion' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'ap_accordion_border',
                'label' => esc_html__('Border', 'addon-pack'),
                'selector' => '{{WRAPPER}} .ap-accordion',
            ]
        );
        $this->add_responsive_control(
            'ap_accordion_border_radius',
            [
                'label' => esc_html__('Border Radius', 'addon-pack'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .ap-accordion' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'ap_accordion_box_shadow',
                'selector' => '{{WRAPPER}} .ap-accordion',
            ]
        );
		$this->end_controls_section();
		
		$this->start_controls_section(
			'ap_accordion_title_style',
			[
				'label' => __( 'Title Style', 'addon-pack' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs( 'tabs_title_style' );

		$this->start_controls_tab(
			'ap_accordion_tab_title_normal',
			[
				'label' => __( 'Normal', 'addon-pack' ),
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'ap_accordion_title_background_normal',
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .ap-accordion .ap-accordion-title',
			]
		);

		$this->add_control(
			'ap_accordion_title_color_normal',
			[
				'label'     => __( 'Text Color', 'addon-pack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ap-accordion .ap-accordion-title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'ap_accordion_title_shadow_normal',
				'selector' => '{{WRAPPER}} .ap-accordion .ap-accordion-item .ap-accordion-title',
			]
		);

		$this->add_responsive_control(
			'ap_accordion_title_padding',
			[
				'label'      => __( 'Padding', 'addon-pack' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .ap-accordion .ap-accordion-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'        => 'ap_accordion_title_border_normal',
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} .ap-accordion .ap-accordion-item .ap-accordion-title',
			]
		);

		$this->add_control(
			'ap_accordion_title_radius_normal',
			[
				'label'      => __( 'Border Radius', 'addon-pack' ),
				'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
				'selectors'  => [
					'{{WRAPPER}} .ap-accordion .ap-accordion-item .ap-accordion-title' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'ap_accordion_title_typography_normal',
				'selector' => '{{WRAPPER}} .ap-accordion .ap-accordion-title',
				'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
            'ap_accordion_tab_title_hover',
            [
                'label' => esc_html__('Hover', 'addon-pack'),
            ]
		);
		
		$this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'ap_accordion_title_background_hover',
                'types' => ['classic', 'gradient'],
				'selector' => '{{WRAPPER}} .eael-adv-accordion .eael-accordion-list .eael-accordion-header:hover',
			],
		);
		
		$this->add_control(
            'ap_accordion_title_color_hover',
            [
                'label' => esc_html__('Text Color', 'addon-pack'),
                'type' => Controls_Manager::COLOR,
                'default' => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .eael-adv-accordion .eael-accordion-list .eael-accordion-header:hover' => 'color: {{VALUE}};',
                ],
            ]
		);
		
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'ap_accordion_title_shadow_hover',
				'selector' => '{{WRAPPER}} .ap-accordion .ap-accordion-item.ap-open .ap-accordion-title',
			]
		);

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'ap_accordion_title_border_hover',
                'label' => esc_html__('Border', 'addon-pack'),
                'selector' => '{{WRAPPER}} .eael-adv-accordion .eael-accordion-list .eael-accordion-header:hover',
            ]
		);
		
		$this->add_responsive_control(
            'ap_accordion_title_radius_hover',
            [
                'label' => esc_html__('Border Radius', 'addon-pack'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .eael-adv-accordion .eael-accordion-list .eael-accordion-header:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

		$this->end_controls_tab();

		$this->start_controls_tab(
			'ap_accordion_tab_title_active',
			[
				'label' => __( 'Active', 'addon-pack' ),
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'ap_accordion_title_background_active',
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .ap-accordion .ap-accordion-item.ap-open .ap-accordion-title',
			]
		);

		$this->add_control(
			'ap_accordion_title_color_active',
			[
				'label'     => __( 'Text Color', 'addon-pack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ap-accordion .ap-accordion-item.ap-open .ap-accordion-title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'ap_accordion_title_shadow_active',
				'selector' => '{{WRAPPER}} .ap-accordion .ap-accordion-item.ap-open .ap-accordion-title',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'        => 'ap_accordion_title_border_active',
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} .ap-accordion .ap-accordion-item.ap-open .ap-accordion-title',
			]
		);

		$this->add_control(
			'ap_accordion_title_radius_active',
			[
				'label'      => __( 'Border Radius', 'addon-pack' ),
				'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
				'selectors'  => [
					'{{WRAPPER}} .ap-accordion .ap-accordion-item.ap-open .ap-accordion-title' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'ap_accordion_icon_style',
			[
				'label'     => __( 'Icon Style', 'addon-pack' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'ap_accordion_icon!' => '',
				],
			]
		);

		$this->start_controls_tabs( 'tabs_icon_style' );

		$this->start_controls_tab(
			'tab_icon_normal',
			[
				'label' => __( 'Normal', 'addon-pack' ),
			]
		);

		$this->add_control(
			'ap_accordion_icon_align',
			[
				'label'   => __( 'Alignment', 'addon-pack' ),
				'type'    => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Start', 'addon-pack' ),
						'icon'  => 'eicon-h-align-left',
					],
					'right' => [
						'title' => __( 'End', 'addon-pack' ),
						'icon'  => 'eicon-h-align-right',
					],
				],
				'default'     => is_rtl() ? 'left' : 'right',
				'toggle'      => false,
				'label_block' => false,
				'condition'   => [
					'ap_accordion_icon!' => '',
				],
			]
		);

		$this->add_control(
			'ap_accordion_icon_color',
			[
				'label'     => __( 'Color', 'addon-pack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ap-accordion .ap-accordion-title .ap-accordion-icon .fa:before' => 'color: {{VALUE}};',
				],
				'condition' => [
					'ap_accordion_icon!' => '',
				],
			]
		);

		$this->add_responsive_control(
			'ap_accordion_icon_space',
			[
				'label' => __( 'Spacing', 'addon-pack' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .ap-accordion .ap-accordion-icon.ap-accordion-icon-left'  => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .ap-accordion .ap-accordion-icon.ap-accordion-icon-right' => 'margin-left: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'ap_accordion_icon!' => '',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'ap_accordion_tab_icon_hover',
			[
				'label' => __( 'Hover', 'addon-pack' ),
			]
		);

		$this->add_control(
			'ap_accordion_icon_hover_color',
			[
				'label'     => __( 'Color', 'addon-pack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ap-accordion .ap-accordion-item.ap-open .ap-accordion-icon .fa:before' => 'color: {{VALUE}};',
				],
				'condition' => [
					'ap_accordion_icon!' => '',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'ap_accordion_tab_icon_active',
			[
				'label' => __( 'Active', 'addon-pack' ),
			]
		);

		$this->add_control(
			'ap_accordion_icon_active_color',
			[
				'label'     => __( 'Color', 'addon-pack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ap-accordion .ap-accordion-item.ap-open .ap-accordion-icon .fa:before' => 'color: {{VALUE}};',
				],
				'condition' => [
					'ap_accordion_icon!' => '',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'ap_accordion_content_style',
			[
				'label'     => __( 'Content Style', 'addon-pack' ),
				'tab'       => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'ap_accordion_content_background_color',
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .ap-accordion .ap-accordion-content',
			]
		);

		$this->add_control(
			'ap_accordion_content_color',
			[
				'label'     => __( 'Text Color', 'addon-pack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ap-accordion .ap-accordion-content' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'ap_accordion_content_padding',
			[
				'label'      => __( 'Padding', 'addon-pack' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .ap-accordion .ap-accordion-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'ap_accordion_content_radius',
			[
				'label'      => __( 'Border Radius', 'addon-pack' ),
				'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
				'selectors'  => [
					'{{WRAPPER}} .ap-accordion .ap-accordion-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
				],
			]
		);

		$this->add_control(
			'ap_accordion_content_spacing',
			[
				'label' => __( 'Spacing', 'addon-pack' ),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .ap-accordion .ap-accordion-content' => 'margin-top: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'ap_accordion_content_typography',
				'selector' => '{{WRAPPER}} .ap-accordion .ap-accordion-content',
				'scheme'   => Scheme_Typography::TYPOGRAPHY_3,
			]
		);

		$this->end_controls_section();

	}
	
	/**
	 * Render the widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function render() {


	}

	protected function _content_template() {}
	
}