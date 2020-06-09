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

class Fluent_form extends Widget_Base {

	public function get_name() {
		return 'ap-fluent-form';
	}

	public function get_title() {
		return __( 'Fluent Form', 'addon-pack' );
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
			'ap_fluent_form_warning_notice_tab',
			[
				'label' => defined('FLUENTFORM') ? __( 'Fluent Form', 'addon-pack' ) : __( 'Warning Notice', 'addon-pack' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
        );

        if ( ! defined('FLUENTFORM') ) {
            $this->add_control(
                'ap_fluent_form_warning_notice',
                [
                    'type' => Controls_Manager::RAW_HTML,
                    'raw' => sprintf(
                        __( ' %1$s is missing in your site. Please click on the link below and install/activate %1$s. Make sure to refresh this page after installation or activation.', 'addon-pack' ),
                        '<a href="'.esc_url( admin_url( 'plugin-install.php?s=fluent+form&tab=search&type=term' ) )
                        .'" target="_blank" rel="noopener">Fluent Form</a>',
                    ),
                    'content_classes' => 'elementor-panel-alert elementor-panel-alert-danger ap-alert-danger',
                ]
            );

            $this->add_control(
                'ap_fluent_form_install',
                [
                    'type' => Controls_Manager::RAW_HTML,
                    'raw' => '<a href="'.esc_url( admin_url( 'plugin-install.php?s=fluent+form&tab=search&type=term' ) ).'" target="_blank" rel="noopener">Click to install or activate Fluent Form 7</a>',
                ]
            );
            $this->end_controls_section();
            return;
		}

		$this->add_control(
            'ap_fluent_form_form_id',
            [
                'label' => __( 'Select Contact Form', 'addon-pack' ),
                'type' => Controls_Manager::SELECT,
				'options' => AddonPack_Helper::getFluentFormNames(),
				'label_block'   => true,
            ]
		);
		
		$this->add_control(
			'ap_fluent_form_title_enable',
			[
				'label' => __('Form Title', 'addon-pack'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __('On', 'addon-pack'),
				'label_off' => __('Off', 'addon-pack'),
				'return_value' => 'yes',
			]
		);

		$this->add_control(
			'ap_fluent_form_title',
			[
				'label' => esc_html__('Title', 'addon-pack'),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => __('Get in Touch', 'addon-pack'),
				'condition' => [
					'ap_fluent_form_title_enable' => 'yes',
				],
			]
		);

		$this->add_control(
			'ap_fluent_form_description_enable',
			[
				'label' => __('Form Description', 'addon-pack'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __('On', 'addon-pack'),
				'label_off' => __('Off', 'addon-pack'),
				'return_value' => 'yes',
			]
		);

		$this->add_control(
			'ap_fluent_form_description',
			[
				'label' => esc_html__('Description', 'addon-pack'),
				'type' => Controls_Manager::TEXTAREA,
				'default' => __('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore.', 'addon-pack'),
				'condition' => [
					'ap_fluent_form_description_enable' => 'yes',
				],
			]
        );

		$this->add_control(
            'ap_fluent_form_html_class',
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
            'ap_fluent_form_title_description_tab',
            [
                'label' => __('Title & Description', 'addon-pack'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'ap_fluent_form_title_heading',
            [
                'label' => __('Title', 'addon-pack'),
                'type' => Controls_Manager::HEADING,
            ]
        );

        $this->add_control(
            'ap_fluent_form_title_text_color',
            [
                'label' => __('Text Color', 'addon-pack'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .ap-fluent-form-title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'ap_fluent_form_title_typography',
                'label' => __('Typography', 'addon-pack'),
                'scheme' => Scheme_Typography::TYPOGRAPHY_4,
                'selector' => '{{WRAPPER}} .ap-fluent-form-title',
            ]
		);
		
		$this->add_responsive_control(
            'ap_fluent_form_title_bottom_spacing',
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
                    '{{WRAPPER}} .ap-fluent-form-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'ap_fluent_form_description_heading',
            [
                'label' => __('Description', 'addon-pack'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'ap_fluent_form_description_text_color',
            [
                'label' => __('Text Color', 'addon-pack'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .ap-fluent-form-description' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'ap_fluent_form_description_typography',
                'label' => __('Typography', 'addon-pack'),
                'scheme' => Scheme_Typography::TYPOGRAPHY_4,
                'selector' => '{{WRAPPER}} .ap-fluent-form-description',
            ]
		);
		
		$this->add_responsive_control(
            'ap_fluent_form_description_bottom_spacing',
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
                    '{{WRAPPER}} .ap-fluent-form-description' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
		);
		
		$this->add_responsive_control(
            'ap_fluent_form_content_alignment',
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
                    '{{WRAPPER}} .ap-fluent-form-content' => 'text-align: {{VALUE}};',
				],
				'separator' => 'before',
            ]
        );

		$this->end_controls_section();

		$this->start_controls_section(
            'ap_fluent_form_form_label',
            [
                'label' => __( 'Fields Label', 'addon-pack' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_control(
            'ap_fluent_form_labels_enable',
            [
                'label' => __('Labels', 'addon-pack'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'label_on' => __('Show', 'addon-pack'),
                'label_off' => __('Hide', 'addon-pack'),
                'return_value' => 'yes'
            ]
        );
		
		$this->add_control(
            'ap_fluent_form_label_color',
            [
                'label' => __( 'Text Color', 'addon-pack' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ff-el-group label' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'ap_fluent_form_labels_enable' => 'yes',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'ap_fluent_form_label_typography',
                'label' => __( 'Typography', 'addon-pack' ),
                'selector' => '{{WRAPPER}} .ff-el-group label',
                'scheme' => Scheme_Typography::TYPOGRAPHY_3,
                'condition' => [
                    'ap_fluent_form_labels_enable' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'ap_fluent_form_divider_1',
            [
                'type' => Controls_Manager::DIVIDER,
                'style' => 'thick',
            ]
        );

        $this->end_controls_section();

		$this->start_controls_section(
            'ap_fluent_form_fields_style',
            [
                'label' => __( 'Form Fields', 'addon-pack' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
		);
		
		$this->add_responsive_control(
            'ap_fluent_form_fields_padding',
            [
                'label' => __( 'Padding', 'addon-pack' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .ap-fluent-form input:not([type=radio]):not([type=checkbox]):not([type=submit]):not([type=button]):not([type=image]):not([type=file])' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .ap-fluent-form .ff-el-group textarea' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};', 
                    '{{WRAPPER}} .ap-fluent-form .ff-el-group select' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
		);
		
		$this->add_responsive_control(
            'ap_fluent_form_fields_border_radius',
            [
                'label' => __( 'Border Radius', 'addon-pack' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .ap-fluent-form input:not([type=radio]):not([type=checkbox]):not([type=submit]):not([type=button]):not([type=image]):not([type=file])' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};', 
                    '{{WRAPPER}} .ap-fluent-form .ff-el-group textarea' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};', 
                    '{{WRAPPER}} .ap-fluent-form .ff-el-group select' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'ap_fluent_form_fields_text_indent',
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
                    '{{WRAPPER}} .ap-fluent-form input:not([type=radio]):not([type=checkbox]):not([type=submit]):not([type=button]):not([type=image]):not([type=file])' => 'text-indent: {{SIZE}}{{UNIT}}',
                    '{{WRAPPER}} .ap-fluent-form .ff-el-group textarea' => 'text-indent: {{SIZE}}{{UNIT}}', 
                    '{{WRAPPER}} .ap-fluent-form .ff-el-group select' => 'text-indent: {{SIZE}}{{UNIT}}',
                ],
                'separator' => 'after',
            ]
        );

        $this->add_responsive_control(
            'ap_fluent_form_input_width',
            [
                'label' => __( 'Input Width', 'addon-pack' ),
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
                        'max' => 700,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .ap-fluent-form input:not([type=radio]):not([type=checkbox]):not([type=submit]):not([type=button]):not([type=image]):not([type=file])' => 'width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .ap-fluent-form .ff-el-group select' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'ap_fluent_form_input_height',
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
                    '{{WRAPPER}} .ap-fluent-form input:not([type=radio]):not([type=checkbox]):not([type=submit]):not([type=button]):not([type=image]):not([type=file])' => 'height: {{SIZE}}{{UNIT}}',
                    '{{WRAPPER}} .ap-fluent-form .ff-el-group select' => 'height: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->add_control(
            'ap_fluent_form_divider_5',
            [
                'type' => Controls_Manager::DIVIDER,
                'style' => 'thick',
            ]
        );

        $this->add_responsive_control(
            'ap_fluent_form_textarea_width',
            [
                'label' => __('Textarea Width', 'addon-pack'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1360,
                        'step' => 1,
                    ],
                ],
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .ap-fluent-form .ff-el-group textarea' => 'width: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'ap_fluent_form_textarea_height',
            [
                'label' => __('Textarea Height', 'addon-pack'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 500,
                        'step' => 1,
                    ],
                ],
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .ap-fluent-form .ff-el-group textarea' => 'height: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->add_control(
            'ap_fluent_form_divider_6',
            [
                'type' => Controls_Manager::DIVIDER,
                'style' => 'thick',
            ]
        );

        $this->add_responsive_control(
            'ap_fluent_form_fields_margin',
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
                    '{{WRAPPER}} .ap-fluent-form .ff-el-group' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
		);
		
		$this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'ap_fluent_form_fields_typography',
                'label' => __( 'Typography', 'addon-pack' ),
                'selector' => '{{WRAPPER}} .ap-fluent-form input:not([type=radio]):not([type=checkbox]):not([type=submit]):not([type=button]):not([type=image]):not([type=file]), {{WRAPPER}} .ap-fluent-form .ff-el-group textarea, {{WRAPPER}} .ap-fluent-form .ff-el-group select',
                'scheme' => Scheme_Typography::TYPOGRAPHY_3
            ]
        );

        $this->add_control(
            'ap_fluent_form_fields_color',
            [
                'label' => __( 'Text Color', 'addon-pack' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ap-fluent-form input:not([type=radio]):not([type=checkbox]):not([type=submit]):not([type=button]):not([type=image]):not([type=file])' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .ap-fluent-form .ff-el-group textarea' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .ap-fluent-form .ff-el-group select' => 'color: {{VALUE}}',
                ],
            ]
        );


		$this->start_controls_tabs( 'tabs_field_state' );

        $this->start_controls_tab(
            'ap_fluent_form_tab_fields_normal',
            [
                'label' => __( 'Normal', 'addon-pack' ),
            ]
		);

		$this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'ap_fluent_form_fields_border',
                'selector' => '{{WRAPPER}} .ap-fluent-form input:not([type=radio]):not([type=checkbox]):not([type=submit]):not([type=button]):not([type=image]):not([type=file]), {{WRAPPER}} .ap-fluent-form .ff-el-group textarea, {{WRAPPER}} .ap-fluent-form .ff-el-group select',
            ]
		);
		
		$this->add_control(
            'ap_fluent_form_fields_bg_color',
            [
                'label' => __( 'Background Color', 'addon-pack' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ap-fluent-form input:not([type=radio]):not([type=checkbox]):not([type=submit]):not([type=button]):not([type=image]):not([type=file])' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .ap-fluent-form .ff-el-group textarea' => 'background-color: {{VALUE}}', 
                    '{{WRAPPER}} .ap-fluent-form .ff-el-group select' => 'background-color: {{VALUE}}',
                ],
            ]
		);

		$this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'ap_fluent_form_fields_box_shadow',
                'selector' => '{{WRAPPER}} .ap-fluent-form input:not([type=radio]):not([type=checkbox]):not([type=submit]):not([type=button]):not([type=image]):not([type=file]), {{WRAPPER}} .ap-fluent-form .ff-el-group textarea, {{WRAPPER}} .ap-fluent-form .ff-el-group select',
            ]
        );

		$this->end_controls_tab();

		$this->start_controls_tab(
            'ap_fluent_form_tab_fields_focus',
            [
                'label' => __( 'Focus', 'addon-pack' ),
            ]
		);

		$this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'ap_fluent_form_fields_focus_border',
                'selector' => '{{WRAPPER}} .ap-fluent-form input:not([type=radio]):not([type=checkbox]):not([type=submit]):not([type=button]):not([type=image]):not([type=file]):focus, {{WRAPPER}} .ap-fluent-form .ff-el-group textarea:focus',
            ]
		);
		
		$this->add_control(
            'ap_fluent_form_fields_focus_bg_color',
            [
                'label' => __( 'Background Color', 'addon-pack' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ap-fluent-form input:not([type=radio]):not([type=checkbox]):not([type=submit]):not([type=button]):not([type=image]):not([type=file]):focus' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .ap-fluent-form .ff-el-group textarea:focus' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'ap_fluent_form_fields_focus_box_shadow',
                'exclude' => [
                    'box_shadow_position',
                ],
                'selector' => '{{WRAPPER}} .ap-fluent-form input:not([type=radio]):not([type=checkbox]):not([type=submit]):not([type=button]):not([type=image]):not([type=file]):focus, {{WRAPPER}} .ap-fluent-form .ff-el-group textarea:focus',
            ]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
            'ap_fluent_form_placeholder',
            [
                'label' => __('Placeholder', 'addon-pack'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'ap_fluent_form_placeholder_enable',
            [
                'label' => __('Show Placeholder', 'addon-pack'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'label_on' => __('Yes', 'addon-pack'),
                'label_off' => __('No', 'addon-pack'),
            ]
        );
		
		$this->add_control(
            'ap_fluent_form_placeholder_text_color',
            [
                'label' => __( 'Placeholder Text Color', 'addon-pack' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ff-el-group input::-webkit-input-placeholder' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .ff-el-group textarea::-webkit-input-placeholder' => 'color: {{VALUE}};',
				],
				'condition' => [
                    'ap_fluent_form_placeholder_enable' => 'yes',
                ],
            ]
        );
        
        $this->end_controls_section();
		
		$this->start_controls_section(
            'ap_fluent_form_button',
            [
                'label' => __( 'Submit Button', 'addon-pack' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
		);

		$this->add_responsive_control(
            'ap_fluent_form_button_align',
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
                'default' => '',
                'prefix_class' => 'ap-fluent-form-button-',
            ]
        );
        
        $this->add_responsive_control(
            'ap_fluent_form_button_width',
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
                    '{{WRAPPER}} .ap-fluent-form .ff-el-group .ff-btn-submit' => 'width: {{SIZE}}{{UNIT}}',
                ],
            ]
        );
		
		$this->add_control(
            'ap_fluent_form_divider_3',
            [
                'type' => Controls_Manager::DIVIDER,
                'style' => 'thick',
            ]
        );

		$this->add_responsive_control(
            'ap_fluent_form_button_padding',
            [
                'label' => __( 'Padding', 'addon-pack' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .ap-fluent-form .ff-el-group .ff-btn-submit' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
		);
		
		$this->add_responsive_control(
            'ap_fluent_form_button_margin',
            [
                'label' => __( 'Margin', 'addon-pack' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .ap-fluent-form .ff-el-group .ff-btn-submit' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'ap_fluent_form_button_typography',
                'selector' => '{{WRAPPER}} .ap-fluent-form .ff-el-group .ff-btn-submit',
                'scheme' => Scheme_Typography::TYPOGRAPHY_4
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'ap_fluent_form_button_border',
                'selector' => '{{WRAPPER}} .ap-fluent-form .ff-el-group .ff-btn-submit',
            ]
        );

        $this->add_control(
            'ap_fluent_form_button_border_radius',
            [
                'label' => __( 'Border Radius', 'addon-pack' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .ap-fluent-form .ff-el-group .ff-btn-submit' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
		
		$this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'ap_fluent_form_button_box_shadow',
                'selector' => '{{WRAPPER}} .ap-fluent-form .ff-el-group .ff-btn-submit',
            ]
		);

        $this->add_control(
            'ap_fluent_form_divider_2',
            [
                'type' => Controls_Manager::DIVIDER,
                'style' => 'thick',
            ]
        );

        $this->start_controls_tabs( 'tabs_button_style' );

        $this->start_controls_tab(
            'ap_fluent_form_button_tab_normal',
            [
                'label' => __( 'Normal', 'addon-pack' ),
            ]
        );

        $this->add_control(
            'ap_fluent_form_button_color',
            [
                'label' => __( 'Text Color', 'addon-pack' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .ap-fluent-form .ff-el-group .ff-btn-submit' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'ap_fluent_form_button_bg_color',
            [
                'label' => __( 'Background Color', 'addon-pack' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ap-fluent-form .ff-el-group .ff-btn-submit' => 'background-color: {{VALUE}};',
                ],
            ]
		);

        $this->end_controls_tab();

        $this->start_controls_tab(
            'ap_fluent_form_button_tab_hover',
            [
                'label' => __( 'Hover', 'addon-pack' ),
            ]
        );

        $this->add_control(
            'ap_fluent_form_button_hover_color',
            [
                'label' => __( 'Text Color', 'addon-pack' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ap-fluent-form .ff-el-group .ff-btn-submit:hover, {{WRAPPER}} .ap-fluent-form .ff-el-group .ff-btn-submit:focus' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'ap_fluent_form_button_hover_bg_color',
            [
                'label' => __( 'Background Color', 'addon-pack' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ap-fluent-form .ff-el-group .ff-btn-submit:hover, {{WRAPPER}} .ap-fluent-form .ff-el-group .ff-btn-submit:focus' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'ap_fluent_form_button_hover_border_color',
            [
                'label' => __( 'Border Color', 'addon-pack' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ap-fluent-form .ff-el-group .ff-btn-submit:hover, {{WRAPPER}} .ap-fluent-form .ff-el-group .ff-btn-submit:focus' => 'border-color: {{VALUE}};',
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
        if( !defined('FLUENTFORM')){
            return;
        }

		$settings = $this->get_settings();

		$this->add_inline_editing_attributes( 'ap_fluent_form_title', 'intermediate' );
		$this->add_render_attribute( 'ap_fluent_form_title', 'class', 'ap-fluent-form-title' );

		$this->add_inline_editing_attributes( 'ap_fluent_form_description', 'intermediate' );
		$this->add_render_attribute( 'ap_fluent_form_description', 'class', 'ap-fluent-form-description' );

        $this->add_render_attribute(
            'ap_fluent_form',
            [
                'class' => [
                    'ap-fluent-form',
                ]
            ]
        );

        if ( $settings['ap_fluent_form_placeholder_enable'] != 'yes' ) {
            $this->add_render_attribute( 'ap_fluent_form', 'class', 'ap-fluent-form-placeholder-hide' );
        }

        if( $settings['ap_fluent_form_labels_enable'] != 'yes' ) {
            $this->add_render_attribute( 'ap_fluent_form', 'class', 'ap-fluent-form-labels-hide' );
        }

        
        ?>

		<div class="ap-fluent-form"> 

				<div class="ap-fluent-form-content">
			
					<?php if($settings['ap_fluent_form_title_enable'] == 'yes'){ ?>
						<h3 <?php echo $this->get_render_attribute_string( 'ap_fluent_form_title' ); ?>><?php echo $settings['ap_fluent_form_title']; ?></h3>
					<?php } ?>

					<?php if($settings['ap_fluent_form_description_enable'] == 'yes'){ ?>
						<h6 <?php echo $this->get_render_attribute_string( 'ap_fluent_form_description' ); ?>><?php echo $settings['ap_fluent_form_description']; ?></h6>
					<?php } ?>
					
				</div>

				<div <?php echo $this->get_render_attribute_string('ap_fluent_form'); ?>>

					<?php
						if ( ! empty( $settings['ap_fluent_form_form_id'] ) ) {
							echo $this->ap_do_shortcode( 'fluentform', [
								'id' => $settings['ap_fluent_form_form_id'],
								'html_class' => 'ap-fluent-form' . $settings['ap_fluent_form_html_class'],
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