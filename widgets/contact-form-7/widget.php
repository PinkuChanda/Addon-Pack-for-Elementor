<?php
namespace AddonPack\Elementor\Widget;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Scheme_Typography;
use AddonPack\Includes\AddonPack_Helper;


if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Contact_form_7 extends Widget_Base {

	public function get_name() {
		return 'ap-cf7';
	}

	public function get_title() {
		return __( 'Contact Form 7', 'addon-pack' );
	}

	public function get_icon() {
		return 'eicon-form-horizontal';
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
			'ap_cf7_warning_notice_tab',
			[
				'label' => function_exists('wpcf7') ? __( 'Contact Form 7', 'addon-pack' ) : __( 'Warning Notice', 'addon-pack' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
        );

        if ( ! function_exists('wpcf7') ) {
            $this->add_control(
                'ap_cf7_warning_notice',
                [
                    'type' => Controls_Manager::RAW_HTML,
                    'raw' => sprintf(
                        __( ' %1$s is missing in your site. Please click on the link below and install/activate %1$s. Make sure to refresh this page after installation or activation.', 'addon-pack' ),
                        '<a href="'.esc_url( admin_url( 'plugin-install.php?s=Contact+Form+7&tab=search&type=term' ) )
                        .'" target="_blank" rel="noopener">Contact Form 7</a>',
                    ),
                    'content_classes' => 'elementor-panel-alert elementor-panel-alert-danger ap-alert-danger',
                ]
            );

            $this->add_control(
                'ap_cf7_install',
                [
                    'type' => Controls_Manager::RAW_HTML,
                    'raw' => '<a href="'.esc_url( admin_url( 'plugin-install.php?s=Contact+Form+7&tab=search&type=term' ) ).'" target="_blank" rel="noopener">Click to install or activate Contact Form 7</a>',
                ]
            );
            $this->end_controls_section();
            return;
		}

		$this->add_control(
            'ap_cf7_form_id',
            [
                'label' => __( 'Select Contact Form', 'addon-pack' ),
                'type' => Controls_Manager::SELECT,
				'options' => AddonPack_Helper::getCf7FormNames(),
				'label_block'   => true,
            ]
		);
		
		$this->add_control(
			'ap_cf7_title_enable',
			[
				'label' => __('Form Title', 'addon-pack'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __('On', 'addon-pack'),
				'label_off' => __('Off', 'addon-pack'),
				'return_value' => 'yes',
			]
		);

		$this->add_control(
			'ap_cf7_title',
			[
				'label' => __('Title', 'addon-pack'),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => __('Get in Touch', 'addon-pack'),
				'condition' => [
					'ap_cf7_title_enable' => 'yes',
				],
			]
		);

		$this->add_control(
			'ap_cf7_description_enable',
			[
				'label' => __('Form Description', 'addon-pack'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __('On', 'addon-pack'),
				'label_off' => __('Off', 'addon-pack'),
				'return_value' => 'yes',
			]
		);

		$this->add_control(
			'ap_cf7_description',
			[
				'label' => __('Description', 'addon-pack'),
				'type' => Controls_Manager::TEXTAREA,
				'default' => __('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore.', 'addon-pack'),
				'condition' => [
					'ap_cf7_description_enable' => 'yes',
				],
			]
		);

		$this->add_control(
            'ap_cf7_html_class',
            [
                'label' => __( 'HTML Class', 'addon-pack' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'description' => __( 'Add custom class to the form.', 'addon-pack' ),
            ]
		);
		
		$this->end_controls_section();

	}

	
	protected function register_heading_style_controls(){
		
		$this->start_controls_section(
            'ap_cf7_title_description_tab',
            [
                'label' => __('Title & Description', 'addon-pack'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'ap_cf7_title_heading',
            [
                'label' => __('Title', 'addon-pack'),
                'type' => Controls_Manager::HEADING,
            ]
        );

        $this->add_control(
            'ap_cf7_title_text_color',
            [
                'label' => __('Text Color', 'addon-pack'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .ap-cf7-title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'ap_cf7_title_typography',
                'label' => __('Typography', 'addon-pack'),
                'scheme' => Scheme_Typography::TYPOGRAPHY_4,
                'selector' => '{{WRAPPER}} .ap-cf7-title',
            ]
		);
		
		$this->add_responsive_control(
            'ap_cf7_title_bottom_spacing',
            [
                'label' => __( 'Bottom Spacing', 'addon-pack' ),
                'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'max' => 50,
					],
				],
				'default' => [
					'size' => 10,
				],
                'selectors' => [
                    '{{WRAPPER}} .ap-cf7-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'ap_cf7_description_heading',
            [
                'label' => __('Description', 'addon-pack'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'ap_cf7_description_text_color',
            [
                'label' => __('Text Color', 'addon-pack'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .ap-cf7-description' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'ap_cf7_description_typography',
                'label' => __('Typography', 'addon-pack'),
                'scheme' => Scheme_Typography::TYPOGRAPHY_4,
                'selector' => '{{WRAPPER}} .ap-cf7-description',
            ]
		);
		
		$this->add_responsive_control(
            'ap_cf7_description_bottom_spacing',
            [
                'label' => __( 'Bottom Spacing', 'addon-pack' ),
                'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'max' => 50,
					],
				],
				'default' => [
					'size' => 10,
				],
                'selectors' => [
                    '{{WRAPPER}} .ap-cf7-description' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
		);
		
		$this->add_responsive_control(
            'ap_cf7_content_alignment',
            [
                'label' => __('Alignment', 'addon-pack'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'addon-pack'),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'addon-pack'),
                        'icon' => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'addon-pack'),
                        'icon' => 'fa fa-align-right',
                    ],
                ],
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .ap-cf7-content' => 'text-align: {{VALUE}};',
				],
				'separator' => 'before',
            ]
        );

		$this->end_controls_section();

		$this->start_controls_section(
            'ap_cf7_form_label',
            [
                'label' => __( 'Fields Label', 'addon-pack' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
		);
		
		$this->add_control(
            'ap_cf7_label_color',
            [
                'label' => __( 'Text Color', 'addon-pack' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} label' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'ap_cf7_label_typography',
                'label' => __( 'Typography', 'addon-pack' ),
                'selector' => '{{WRAPPER}} label',
                'scheme' => Scheme_Typography::TYPOGRAPHY_3
            ]
        );

        $this->add_control(
            'ap_cf7_divider_1',
            [
                'type' => Controls_Manager::DIVIDER,
                'style' => 'thick',
            ]
        );

		$this->add_responsive_control(
            'ap_cf7_label_margin',
            [
                'label' => __( 'Bottom Spacing', 'addon-pack' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .wpcf7-form-control:not(.wpcf7-submit)' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

		$this->start_controls_section(
            'ap_cf7_fields_style',
            [
                'label' => __( 'Form Fields', 'addon-pack' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
		);
		
		$this->add_responsive_control(
            'ap_cf7_fields_padding',
            [
                'label' => __( 'Padding', 'addon-pack' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .wpcf7-form-control:not(.wpcf7-submit)' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
		);
		
		$this->add_responsive_control(
            'ap_cf7_fields_border_radius',
            [
                'label' => __( 'Border Radius', 'addon-pack' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .wpcf7-form-control:not(.wpcf7-submit)' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'ap_cf7_fields_text_indent',
            [
                'label' => __('Text Indent', 'addon-pack'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 60,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 30,
                        'step' => 1,
                    ],
                ],
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .wpcf7-form-control.wpcf7-text'     => 'text-indent: {{SIZE}}{{UNIT}}', 
                    '{{WRAPPER}} .wpcf7-form-control.wpcf7-textarea' => 'text-indent: {{SIZE}}{{UNIT}}',
                    '{{WRAPPER}} .wpcf7-form-control.wpcf7-date'     => 'text-indent: {{SIZE}}{{UNIT}}',
                    '{{WRAPPER}} .wpcf7-form-control.wpcf7-select'   => 'text-indent: {{SIZE}}{{UNIT}}',
                ],
                'separator' => 'after',
            ]
        );

        $this->add_responsive_control(
            'ap_cf7_fields_width',
            [
                'label' => __( 'Width', 'addon-pack' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'unit' => '%',
                ],
                'tablet_default' => [
                    'unit' => '%',
                ],
                'mobile_default' => [
                    'unit' => '%',
                ],
                'size_units' => [ '%', 'px' ],
                'range' => [
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 1,
                        'max' => 500,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .wpcf7-form-control:not(.wpcf7-submit)' => 'width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .ha-cf7-form label' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'ap_cf7_fields_input_height',
            [
                'label' => __('Input Height', 'addon-pack'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 60,
                        'step' => 1,
                    ],
                ],
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .wpcf7-form-control:not(.wpcf7-submit):not(.wpcf7-textarea)' => 'height: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'ap_cf7_fields_textarea_height',
            [
                'label' => __('Textarea Height', 'addon-pack'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 700,
                        'step' => 1,
                    ],
                ],
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .wpcf7-textarea' => 'height: {{SIZE}}{{UNIT}}',
                ],
                'separator' => 'after',
            ]
        );

        $this->add_responsive_control(
            'ap_cf7_fields_margin',
            [
                'label' => __( 'Bottom Spacing', 'addon-pack' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .wpcf7-form-control:not(.wpcf7-submit)' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
		);
		
		$this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'ap_cf7_fields_typography',
                'label' => __( 'Typography', 'addon-pack' ),
                'selector' => '{{WRAPPER}} .wpcf7-form-control:not(.wpcf7-submit)',
                'scheme' => Scheme_Typography::TYPOGRAPHY_3
            ]
        );

        $this->add_control(
            'ap_cf7_fields_color',
            [
                'label' => __( 'Text Color', 'addon-pack' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wpcf7-form-control:not(.wpcf7-submit)' => 'color: {{VALUE}}',
                ],
            ]
        );


		$this->start_controls_tabs( 'tabs_field_state' );

        $this->start_controls_tab(
            'ap_cf7_tab_fields_normal',
            [
                'label' => __( 'Normal', 'addon-pack' ),
            ]
		);

		$this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'ap_cf7_fields_border',
                'selector' => '{{WRAPPER}} .wpcf7-form-control:not(.wpcf7-submit)',
            ]
		);
		
		$this->add_control(
            'ap_cf7_fields_bg_color',
            [
                'label' => __( 'Background Color', 'addon-pack' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wpcf7-form-control:not(.wpcf7-submit)' => 'background-color: {{VALUE}}',
                ],
            ]
		);

		$this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'ap_cf7_fields_box_shadow',
                'selector' => '{{WRAPPER}} .wpcf7-form-control:not(.wpcf7-submit)',
            ]
        );

		$this->end_controls_tab();

		$this->start_controls_tab(
            'ap_cf7_tab_fields_focus',
            [
                'label' => __( 'Focus', 'addon-pack' ),
            ]
		);

		$this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'ap_cf7_fields_focus_border',
                'selector' => '{{WRAPPER}} .wpcf7-form-control:not(.wpcf7-submit):focus',
            ]
		);
		
		$this->add_control(
            'ap_cf7_fields_focus_bg_color',
            [
                'label' => __( 'Background Color', 'addon-pack' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wpcf7-form-control:not(.wpcf7-submit):focus' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'ap_cf7_fields_focus_box_shadow',
                'exclude' => [
                    'box_shadow_position',
                ],
                'selector' => '{{WRAPPER}} .wpcf7-form-control:not(.wpcf7-submit):focus',
            ]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
            'ap_cf7_fields_placeholder',
            [
                'label' => __('Placeholder', 'addon-pack'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'ap_cf7_fields_placeholder_enable',
            [
                'label' => __('Show Placeholder', 'addon-pack'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'label_on' => __('Yes', 'addon-pack'),
                'label_off' => __('No', 'addon-pack'),
            ]
        );
		
		$this->add_control(
            'ap_cf7_fields_placeholder_text_color',
            [
                'label' => __( 'Placeholder Text Color', 'addon-pack' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} ::-webkit-input-placeholder' => 'color: {{VALUE}};',
                    '{{WRAPPER}} ::-moz-placeholder' => 'color: {{VALUE}};',
                    '{{WRAPPER}} ::-ms-input-placeholder' => 'color: {{VALUE}};',
				],
				'condition' => [
                    'ap_cf7_fields_placeholder_enable' => 'yes',
                ],
            ]
		);

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'ap_cf7_fields_placeholder_typography',
                'label' => __('Typography', 'addon-pack'),
                'scheme' => Scheme_Typography::TYPOGRAPHY_4,
				'selector' => '{{WRAPPER}} .wpcf7-form-control::-webkit-input-placeholder, {{WRAPPER}} .wpcf7-form-control::-moz-placeholder, {{WRAPPER}} .wpcf7-form-control::-ms-input-placeholder',
                'condition' => [
                    'ap_cf7_fields_placeholder_enable' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();
		
		$this->start_controls_section(
            'ap_cf7_button',
            [
                'label' => __( 'Submit Button', 'addon-pack' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
		);

		$this->add_responsive_control(
            'ap_cf7_button_align',
            [
                'label' => __('Alignment', 'addon-pack'),
                'type' => Controls_Manager::CHOOSE,
                'default' => 'left',
                'options' => [
                    'left' => [
                        'title' => __('Left', 'addon-pack'),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'addon-pack'),
                        'icon' => 'eicon-h-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'addon-pack'),
                        'icon' => 'eicon-h-align-right',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .wpcf7-form p:nth-last-of-type(1)' => 'text-align: {{VALUE}};',
                    '{{WRAPPER}} .wpcf7-submit' => 'display:inline-block;',
                ],
                
            ]
        );
        
        $this->add_responsive_control(
            'ap_cf7_button_width',
            [
                'label' => __('Width', 'addon-pack'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1200,
                        'step' => 1,
                    ],
                ],
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .wpcf7-submit' => 'width: {{SIZE}}{{UNIT}}',
                ],
            ]
        );
		
		$this->add_control(
            'ap_cf7_divider_3',
            [
                'type' => Controls_Manager::DIVIDER,
                'style' => 'thick',
            ]
        );

		$this->add_responsive_control(
            'ap_cf7_button_padding',
            [
                'label' => __( 'Padding', 'addon-pack' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .wpcf7-submit' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
		);
		
		$this->add_responsive_control(
            'ap_cf7_button_margin',
            [
                'label' => __( 'Margin', 'addon-pack' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .wpcf7-submit' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'ap_cf7_button_typography',
                'selector' => '{{WRAPPER}} .wpcf7-submit',
                'scheme' => Scheme_Typography::TYPOGRAPHY_4
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'ap_cf7_button_border',
                'selector' => '{{WRAPPER}} .wpcf7-submit',
            ]
        );

        $this->add_control(
            'ap_cf7_button_border_radius',
            [
                'label' => __( 'Border Radius', 'addon-pack' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .wpcf7-submit' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
		
		$this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'ap_cf7_button_box_shadow',
                'selector' => '{{WRAPPER}} .wpcf7-submit',
            ]
		);

        $this->add_control(
            'ap_cf7_divider_2',
            [
                'type' => Controls_Manager::DIVIDER,
                'style' => 'thick',
            ]
        );

        $this->start_controls_tabs( 'tabs_button_style' );

        $this->start_controls_tab(
            'ap_cf7_button_tab_normal',
            [
                'label' => __( 'Normal', 'addon-pack' ),
            ]
        );

        $this->add_control(
            'ap_cf7_button_color',
            [
                'label' => __( 'Text Color', 'addon-pack' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .wpcf7-submit' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'ap_cf7_button_bg_color',
            [
                'label' => __( 'Background Color', 'addon-pack' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wpcf7-submit' => 'background-color: {{VALUE}};',
                ],
            ]
		);

        $this->end_controls_tab();

        $this->start_controls_tab(
            'ap_cf7_button_tab_hover',
            [
                'label' => __( 'Hover', 'addon-pack' ),
            ]
        );

        $this->add_control(
            'ap_cf7_button_hover_color',
            [
                'label' => __( 'Text Color', 'addon-pack' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wpcf7-submit:hover, {{WRAPPER}} .wpcf7-submit:focus' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'ap_cf7_button_hover_bg_color',
            [
                'label' => __( 'Background Color', 'addon-pack' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wpcf7-submit:hover, {{WRAPPER}} .wpcf7-submit:focus' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'ap_cf7_button_hover_border_color',
            [
                'label' => __( 'Border Color', 'addon-pack' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wpcf7-submit:hover, {{WRAPPER}} .wpcf7-submit:focus' => 'border-color: {{VALUE}};',
				],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

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

	function ap_do_shortcode( $tag, array $atts = array(), $content = null ) {
		global $shortcode_tags;
		if ( ! isset( $shortcode_tags[ $tag ] ) ) {
			return false;
		}
		return call_user_func( $shortcode_tags[ $tag ], $atts, $content, $tag );
	}

	protected function render() {
        if (!function_exists('wpcf7')) {
            return;
		}

		$settings = $this->get_settings();

		$this->add_inline_editing_attributes( 'ap_cf7_title', 'intermediate' );
		$this->add_render_attribute( 'ap_cf7_title', 'class', 'ap-cf7-title' );

		$this->add_inline_editing_attributes( 'ap_cf7_description', 'intermediate' );
		$this->add_render_attribute( 'ap_cf7_description', 'class', 'ap-cf7-description' );

		?>

		<div class="ap-cf7"> 

				<div class="ap-cf7-content">
			
					<?php if($settings['ap_cf7_title_enable'] == 'yes'){ ?>
						<h3 <?php echo $this->get_render_attribute_string( 'ap_cf7_title' ); ?>><?php echo $settings['ap_cf7_title']; ?></h3>
					<?php } ?>

					<?php if($settings['ap_cf7_description_enable'] == 'yes'){ ?>
						<h6 <?php echo $this->get_render_attribute_string( 'ap_cf7_description' ); ?>><?php echo $settings['ap_cf7_description']; ?></h6>
					<?php } ?>
					
				</div>

				<div class="ap-cf7-form">

					<?php
						if ( ! empty( $settings['ap_cf7_form_id'] ) ) {
							echo $this->ap_do_shortcode( 'contact-form-7', [
								'id' => $settings['ap_cf7_form_id'],
								'html_class' => 'ap-cf7-form ' . $settings['ap_cf7_html_class'],
							] );
						}
					?>

				</div>
				
		</div>

		<?php
				
	}

	protected function _content_template() {

		
	}
	
}