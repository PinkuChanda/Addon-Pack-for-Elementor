<?php
namespace AddonPack\Elementor\Widget;

use Elementor\Widget_Base;
use AddonPack\Includes;
use Elementor\Utils;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Border;


if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Infobox extends Widget_Base {

	protected $templateInstance;

    public function getPostsInstance(){
        return $this->templateInstance = Includes\AddonPack_Helper::getInstance();
    }

	public function get_name() {
		return 'ap-infobox';
	}

	public function get_title() {
		return __( 'Info Box', 'addon-pack' );
	}

	public function get_icon() {
		return 'eicon-info-box';
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
			'ap_infobox_layout',
			[
				'label' => __( 'Layouts', 'addon-pack' ),
			]
        );
        
        $this->add_control(
            'ap_infobox_style',
            [
               'label'       => __( 'Select Style', 'addon-pack'),
               'type' => Controls_Manager::SELECT,
               'default' => 'design-one',
               'options' => [
                   'design-one'    => __( 'Design 1', 'addon-pack'),
                   'design-two'    => __( 'Design 2', 'addon-pack'),
               ],
            ]
		);

        $this->end_controls_section();
        
        $this->start_controls_section(
			'ap_infobox_settings',
			[
				'label' => __( 'Info Box', 'addon-pack' ),
			]
        );

        $this->add_control(
            'ap_infobox_icon_type',
            [
                'label' => __( 'Icon Type', 'addon-pack' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'ap_infobox_icon' => [
                        'title' => __( 'Icon', 'addon-pack' ),
                        'icon' => 'fa fa-surprise',
                    ],
                    'ap_infobox_image' => [
                        'title' => __( 'Image', 'addon-pack' ),
                        'icon' => 'fa fa-image',
                    ],
                ],
				'default' => 'ap_infobox_icon',
				'toggle' => false,
            ]
        );

        $this->add_control(
            'ap_infobox_icon',
            [
                'type' => Controls_Manager::ICONS,
                'fa4compatibility' => 'icon',
                'label_block' => true,
                'render_type' => 'template',
                'default' => [
                    'value' => 'fas fa-surprise',
                    'library' => 'fa-solid',
                ],
                'condition' => [
                    'ap_infobox_icon_type' => 'ap_infobox_icon'
                ]
            ]
        );

        $this->add_control(
            'ap_infobox_image',
            [
                'label' => __( 'Image', 'addon-pack' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'ap_infobox_icon_type' => 'ap_infobox_image'
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
			'ap_infobox_title',
			[
				'label' => __( 'Title', 'addon-pack' ),
				'type' => Controls_Manager::TEXT,
				'default' => __('The Creative Addons', 'addon-pack'),
				'dynamic' => [
					'active' => true,
                ],
                'label_block' => true,
			]
		);
		$this->add_control(
			'ap_infobox_description',
			[
				'label' => __( 'Description', 'addon-pack' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => __('Enter a good one liner that supports the above heading and gives users a reason to click the read_more below.', 'addon-pack'),
				'dynamic' => [
					'active' => true,
                ],
                'label_block' => true,
			]
        );

        $this->add_control(
			'ap_infobox_tag',
			[
				'label' => __( 'HTML Tag', 'addon-pack' ),
				'type' => Controls_Manager::SELECT,
				'options'       => [
					'h1'    => 'H1',
					'h2'    => 'H2',
					'h3'    => 'H3',
					'h4'    => 'H4',
					'h5'    => 'H5',
					'h6'    => 'H6',
					'p'     => 'p',
					'span'  => 'span',
				],
				'default' => 'h4',
				'label_block'   =>  true,
			]
		);
        
        $this->add_responsive_control(
			'ap_infobox_align',
			[
				'label' => __( 'Alignment', 'addon-pack' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'addon-pack' ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'addon-pack' ),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'addon-pack' ),
						'icon' => 'fa fa-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .ap-infobox-details' => 'text-align: {{VALUE}};',
					'{{WRAPPER}} .ap-infobox-thumb'   => 'text-align: {{VALUE}};',
				],
			]
		);


        $this->end_controls_section();

        $this->start_controls_section(
			'ap_infobox_read_more',
			[
				'label' => __( 'Read More', 'addon-pack' ),
			]
		);
		
		$this->add_control(
			'ap_infobox_url_enable',
            [
                'label'         => __('Read More Button Enable', 'addon-pack'),
                'type'          => Controls_Manager::SWITCHER,
				'description'   => __('Enable or disable button','addon-pack'),
				'default'       =>  'yes',
            ]
        );

        $this->add_control(
			'ap_infobox_read_more_text',
			[
				'label' => __( 'Read More Text', 'addon-pack' ),
				'type' => Controls_Manager::TEXT,
				'default' => __('Service', 'addon-pack'),
				'dynamic' => [
					'active' => true,
				],
				'label_block' => true,
				'condition'     => [
					'ap_infobox_url_enable' => 'yes',
				]
			]
		);

		
		$this->add_control('ap_infobox_read_more_link_selection', 
		[
			'label'         => __('Link Type', 'addon-pack'),
			'type'          => Controls_Manager::SELECT,
			'options'       => [
				'custom_url'   => __('URL', 'addon-pack'),
				'existing_url'  => __('Existing Page', 'addon-pack'),
			],
			'default'       => 'custom_url',
			'label_block'   => true,
			'condition'     => [
				'ap_infobox_url_enable' => 'yes',
			]
		]
		);

		$this->add_control('ap_infobox_read_more_url',
			[
				'label'         => __('Link', 'addon-pack'),
				'type'          => Controls_Manager::URL,
				'dynamic'       => [ 'active' => true ],
				'default'       => [
					'url'   => '#',
				],
				'label_block'   => true,
				'condition'     => [
					'ap_infobox_url_enable' => 'yes',
					'ap_infobox_read_more_link_selection' => 'custom_url'
				]
			]
		);

		$this->add_control('ap_infobox_read_more_existing_url',
			[
				'label'         => __('Existing Page', 'addon-pack'),
				'type'          => Controls_Manager::SELECT2,
				'options'       => $this->getPostsInstance()->get_all_posts(),
				'condition'     => [
					'ap_infobox_url_enable' => 'yes',
					'ap_infobox_read_more_link_selection'     => 'existing_url',
				],
				'multiple'      => false,
				'label_block'   => true,
			]
		);

		$this->add_control(
            'ap_infobox_read_more_icon_heading',
            [
                'type' => Controls_Manager::HEADING,
                'label' => __( 'Icon', 'addon-pack' ),
                'separator' => 'before'
            ]
		);
		
		$this->add_control(
			'ap_infobox_read_more_icon_enable',
            [
                'label'         => __('Icon Enable', 'addon-pack'),
                'type'          => Controls_Manager::SWITCHER,
				'description'   => __('Enable or disable Icon','addon-pack'),
				'default'       =>  'yes',
            ]
        );

		$this->add_control(
			'ap_infobox_read_more_icon',
			[
				'label'       => esc_html__( 'Icon', 'addon-pack' ),
				'type'        => Controls_Manager::ICON,
				'default' => 'fas fa-angle-right',
				'label_block' => true,
				'condition' => [
					'ap_infobox_read_more_icon_enable' => 'yes',
				],
			]
		);
		

		$this->add_control(
			'ap_infobox_read_more_icon_align',
			[
				'label'   => esc_html__( 'Icon Alignment', 'addon-pack' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'right',
				'options' => [
					'left'   => esc_html__( 'Left', 'addon-pack' ),
					'right'  => esc_html__( 'Right', 'addon-pack' ),
					'none'   => esc_html__( 'None', 'addon-pack' ),
				],
				'condition' => [
					'ap_infobox_read_more_icon_enable' => 'yes',
				],
				'label_block' => true,
			]
		);

		$this->add_control(
			'ap_infobox_read_more_icon_spacing',
			[
				'label' => esc_html__( 'Icon Spacing', 'addon-pack' ),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 50,
					],
				],
				'default' => [
					'size' => 5,
				],
				'condition' => [
					'ap_infobox_read_more_icon!' => '',
					'ap_infobox_read_more_icon_align!' => 'none',
				],
				'selectors' => [
					'{{WRAPPER}} .ap-infobox-details .ap-infobox-icon-right'  => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .ap-infobox-details .ap-infobox-icon-left'   => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->end_controls_section();


	}

	
	protected function register_heading_style_controls(){

		$this->start_controls_section(
			'ap_infobox_general_style',
			[
				'label' => __( 'General', 'addon-pack' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		// Design 1 General Style


		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'ap_infobox_design_1_bg',
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .ap-infobox-design-1',
				'condition' => [
					'ap_infobox_style' => 'design-one'
				]
			]
		);

		$this->add_control(
			'ap_infobox_design_1_border_color',
			[
				'label'     => esc_html__( 'Border Top Color', 'addon-pack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ap-infobox-design-1' => 'border-top: 3px solid {{VALUE}} ;',
				],
				'condition' => [
					'ap_infobox_style' => 'design-one'
				]

			]
		);

		$this->add_responsive_control(
			'ap_infobox_design_1_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'addon-pack' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .ap-infobox-design-1' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'ap_infobox_style' => 'design-one'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'ap_infobox_design_1_shadow',
				'selector' => '{{WRAPPER}} .ap-infobox-design-1',
				'condition' => [
					'ap_infobox_style' => 'design-one'
				]
			]
		);

		$this->add_responsive_control(
            'ap_infobox_design_1_padding',
            [
                'label' => esc_html__('Padding', 'addon-pack'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .ap-infobox-design-1' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'ap_infobox_style' => 'design-one'
				]
            ]
		);

			// Design 2 General Style

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'ap_infobox_design_2_bg',
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .ap-infobox-design-2',
				'condition' => [
					'ap_infobox_style' => 'design-two'
				]
			]
		);

		$this->add_control(
			'ap_infobox_design_2_border_color',
			[
				'label'     => esc_html__( 'Border Color', 'addon-pack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ap-infobox-design-2' => 'border-color: {{VALUE}};',
				],
				'condition' => [
					'ap_infobox_style' => 'design-two'
				]

			]
		);

		$this->add_responsive_control(
			'ap_infobox_design_2_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'addon-pack' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .ap-infobox-design-2' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'ap_infobox_style' => 'design-two'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'ap_infobox_design_2_shadow',
				'selector' => '{{WRAPPER}} .ap-infobox-design-2',
				'condition' => [
					'ap_infobox_style' => 'design-two'
				]
			]
		);

		$this->add_responsive_control(
            'ap_infobox_design_2_padding',
            [
                'label' => esc_html__('Padding', 'addon-pack'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .ap-infobox-design-2' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'ap_infobox_style' => 'design-two'
				]
            ]
		);

		$this->add_control(
            'ap_infobox_design_2_hover_color',
            [
                'type' => Controls_Manager::HEADING,
                'label' => __( ' Shape & Hover Color', 'addon-pack' ),
                'separator' => 'before'
            ]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'ap_infobox_design_2_hover_bg',
				'label'     => esc_html__( 'Hover Color', 'addon-pack' ),
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .ap-infobox-design-2:before',
				'condition' => [
					'ap_infobox_style' => 'design-two'
				]
			]
		);

		$this->end_controls_section();
		
		$this->start_controls_section(
			'ap_infobox_icon_image_style',
			[
				'label' => __( 'Icon / Image', 'addon-pack' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
            'ap_flexbox_icon_size',
            [
                'label' => __( 'Icon Size', 'addon-pack' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 20,
                        'max' => 250,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .ap-infobox-thumb i' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                     'ap_infobox_icon_type' => 'ap_infobox_icon'
                ]
            ]
        );

        $this->add_responsive_control(
            'ap_flexbox_image_width',
            [
                'label' => __( 'Width', 'addon-pack' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 350,
                    ],
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .ap-infobox-thumb img' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'ap_infobox_icon_type' => 'ap_infobox_image'
                ]
            ]
        );

        $this->add_responsive_control(
            'ap_flexbox_image_height',
            [
                'label' => __( 'Height', 'addon-pack' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 350,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .ap-infobox-thumb img' => 'height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'ap_infobox_icon_type' => 'ap_infobox_image'
                ]
            ]
        );

		$this->add_control(
            'ap_infobox_icon_bg_color',
            [
                'label' => __( 'Icon Background Color', 'addon-pack' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ap-infobox-thumb i' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'ap_infobox_icon_type' => 'ap_infobox_icon'
                ]
            ]
        );

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'ap_infobox_icon_border',
				'label' => esc_html__( 'Border', 'addon-pack' ),
				'selector' => '{{WRAPPER}} .ap-infobox-thumb img, {{WRAPPER}} .ap-infobox-thumb i',
			]
		);

		$this->add_control(
			'ap_infobox_icon_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'addon-pack' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 500,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .ap-infobox-thumb img' => 'border-radius: {{SIZE}}px;',
					'{{WRAPPER}} .ap-infobox-thumb i' => 'border-radius: {{SIZE}}px;',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'ap_infobox_icon_box_shadow',
				'selector' => '{{WRAPPER}} .ap-infobox-thumb img, {{WRAPPER}} .ap-infobox-thumb i',
			]
		);

		$this->add_responsive_control(
			'ap_infobox_icon_padding',
			[
				'label' => __('Padding', 'addon-pack'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default' => [],
				'selectors' => [
					'{{WRAPPER}} .ap-infobox-thumb i' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .ap-infobox-thumb img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'ap_infobox_icon_margin',
			[
				'label' => __('Margin', 'addon-pack'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default' => [],
				'selectors' => [
					'{{WRAPPER}} .ap-infobox-thumb i' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .ap-infobox-thumb img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
            'ap_infobox_content_style',
            [
                'label' => __( 'Title & Description', 'addon-pack' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'ap_infobox_content_padding',
            [
                'label' => __( 'Content Padding', 'addon-pack' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .ap-infobox-details' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .ap-infobox-details'    => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'ap_infobox_title_heading',
            [
                'type' => Controls_Manager::HEADING,
                'label' => __( 'Title', 'addon-pack' ),
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'ap_infobox_title_color',
            [
                'label' => __( 'Text Color', 'addon-pack' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ap-infobox-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'ap_infobox_title_typography',
                'label' => __( 'Typography', 'addon-pack' ),
                'selector' => '{{WRAPPER}} .ap-infobox-title',
                'scheme' => Scheme_Typography::TYPOGRAPHY_2
            ]
		);
		
		$this->add_responsive_control(
            'ap_infobox_title_spacing',
            [
                'label' => __( 'Bottom Spacing', 'addon-pack' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .ap-infobox-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'ap_infobox_description_heading',
            [
                'type' => Controls_Manager::HEADING,
                'label' => __( 'Description', 'addon-pack' ),
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'ap_infobox_description_color',
            [
                'label' => __( 'Text Color', 'addon-pack' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ap-infobox-description' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'ap_infobox_description_typography',
                'label' => __( 'Typography', 'addon-pack' ),
                'selector' => '{{WRAPPER}} .ap-infobox-description',
                'scheme' => Scheme_Typography::TYPOGRAPHY_3,
            ]
		);
		
		$this->add_responsive_control(
            'ap_infobox_description_spacing',
            [
                'label' => __( 'Bottom Spacing', 'addon-pack' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .ap-infobox-description' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

		$this->end_controls_section();
		
		$this->start_controls_section(
			'ap_infobox_read_more_style',
			[
				'label'     => __( 'Read More', 'addon-pack' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'ap_infobox_url_enable' => 'yes',
				],
			]
		);

		$this->start_controls_tabs( 'tabs_readmore_style' );

		$this->start_controls_tab(
			'ap_infobox_read_more_normal',
			[
				'label' => __( 'Normal', 'addon-pack' ),
			]
		);

		$this->add_control(
			'ap_infobox_read_more_text_color',
			[
				'label'     => __( 'Text Color', 'addon-pack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ap-infobox-details a, {{WRAPPER}} .ap-infobox-details a i' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'ap_infobox_read_more_background',
				'selector'  => '{{WRAPPER}} .ap-infobox-details a', 
				'separator' => 'before', 
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'        => 'ap_infobox_read_more_border',
				'separator'   => 'before',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} .ap-infobox-details a'
			]
		);

		$this->add_responsive_control(
			'ap_infobox_read_more_radius',
			[
				'label'      => __( 'Border Radius', 'addon-pack' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'separator'  => 'after', 
				'selectors'  => [
					'{{WRAPPER}} .ap-infobox-details a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'ap_infobox_read_more_shadow',
				'selector' => '{{WRAPPER}} .ap-infobox-details a',
			]
		);

		$this->add_responsive_control(
			'ap_infobox_read_more_padding',
			[
				'label'      => __( 'Padding', 'addon-pack' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .ap-infobox-details a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'ap_infobox_read_more_typography',
				'selector' => '{{WRAPPER}} .ap-infobox-details a, {{WRAPPER}} .ap-infobox-details a i',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'ap_infobox_read_more_hover',
			[
				'label' => __( 'Hover', 'addon-pack' ),
			]
		);

		$this->add_control(
			'ap_infobox_read_more_hover_text_color',
			[
				'label'     => __( 'Text Color', 'addon-pack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ap-infobox-details a:hover' => 'color: {{VALUE}};',
					'{{WRAPPER}} .ap-infobox-details a:hover i' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'ap_infobox_read_more_hover_background',
				'selector'  => '{{WRAPPER}} .ap-infobox-details a:hover',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'ap_infobox_read_more_hover_border_color',
			[
				'label'     => __( 'Border Color', 'addon-pack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ap-infobox-details a:hover' => 'border-color: {{VALUE}};',
				],
				'condition' => [
					'readmore_border_border!' => ''
				]
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'ap_infobox_read_more_hover_shadow',
				'selector' => '{{WRAPPER}} .ap-infobox-details a:hover',
			]
		);

		$this->add_control(
			'ap_infobox_read_more_hover_animation',
			[
				'label' => __( 'Hover Animation', 'addon-pack' ),
				'type' => Controls_Manager::HOVER_ANIMATION,
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

	 protected function infobox_icon_or_image(){
		$settings = $this->get_settings_for_display();
		$is_icon = ! empty( $settings['ap_infobox_icon'] );
		$is_image = ! empty( $settings['ap_infobox_image']['url'] );

		if ( $is_icon and 'ap_infobox_icon' == $settings['ap_infobox_icon_type'] ) {
			$this->add_render_attribute( 'i', 'class', $settings['ap_infobox_icon'] );
			$this->add_render_attribute( 'i', 'aria-hidden', 'true' );			
		} elseif ( $is_image and 'ap_infobox_image' == $settings['ap_infobox_icon_type'] ) {
			$this->add_render_attribute( 'img', 'src', $settings['ap_infobox_image']['url'] );
			$this->add_render_attribute( 'img', 'alt', $settings['ap_infobox_title'] );
		}
		
		if ( $is_icon or $is_image ) : ?>

		<div class="ap-infobox-thumb">
			<?php if ( $is_icon and 'ap_infobox_icon' == $settings['ap_infobox_icon_type'] ) { ?>
				<i <?php echo $this->get_render_attribute_string( 'i' ); ?>></i>
				<?php } elseif ( $is_image and 'ap_infobox_image' == $settings['ap_infobox_icon_type'] ) { ?>
				<img <?php echo $this->get_render_attribute_string( 'img' ); ?>>
			<?php } ?>
		</div>
				
		<?php endif;

	 }

	 protected function infobox_title(){
		$settings = $this->get_settings_for_display();

		$this->add_inline_editing_attributes( 'ap_infobox_title', 'basic' );
		$this->add_render_attribute( 'ap_infobox_title', 'class', 'ap-infobox-title' );
		
		$ap_infobox_title_tag = $settings['ap_infobox_tag'];

		$ap_infobox_title = '<' . $ap_infobox_title_tag. ' class="ap-infobox-title" >'. $settings['ap_infobox_title'] . '</' . $ap_infobox_title_tag . '> ';

		echo $ap_infobox_title;
		
		?>
		
	 <?php 
	 
	}

	protected function infobox_description(){
		$settings = $this->get_settings_for_display();

        $this->add_inline_editing_attributes( 'ap_infobox_description', 'intermediate' );
		$this->add_render_attribute( 'ap_infobox_description', 'class', 'ap-infobox-description' );

		?>

		<p <?php echo $this->get_render_attribute_string( 'ap_infobox_description' ); ?>><?php echo $settings['ap_infobox_description']; ?></p>
<?php 

	}
	 
	 protected function infobox_link(){
		$settings = $this->get_settings_for_display();
		$readmore_icon_alignment = $settings['ap_infobox_read_more_icon_align'];

		$this->add_render_attribute( 'ap_infobox_existing_url_target_blank', 'target', '_blank' );

		$infobox_link = '';
        if( $settings['ap_infobox_url_enable'] == 'yes' && $settings['ap_infobox_read_more_link_selection'] == 'existing_url' ) {
            $infobox_link = get_permalink( $settings['ap_infobox_read_more_existing_url'] );
        } elseif( $settings['ap_infobox_url_enable'] == 'yes' && $settings['ap_infobox_read_more_link_selection'] == 'custom_url' ) {
            $infobox_link = $settings['ap_infobox_read_more_url']['url'];
		}

		if ( $settings['ap_infobox_read_more_hover_animation'] ) {
			$this->add_render_attribute( 'ap_infobox_hover_animation', 'class', 'elementor-animation-' . $settings['ap_infobox_read_more_hover_animation'] );
		} ?>

		<?php if( ! empty( $infobox_link ) ) : ?>
			<a href="<?php echo esc_attr( $infobox_link ); ?>" <?php echo $this->get_render_attribute_string( 'ap_infobox_hover_animation' ); ?> <?php echo $this->get_render_attribute_string( 'ap_infobox_existing_url_target_blank' ); ?> <?php if( ! empty( $settings['ap_infobox_read_more_url']['is_external'] ) ) : ?> <?php endif; ?><?php if( ! empty( $settings['ap_infobox_read_more_url']['nofollow'] ) ) : ?> rel="nofollow" <?php endif; ?>>
		<?php endif; ?>

		<?php if($readmore_icon_alignment == 'left'): ?>
			<i class="<?php echo esc_attr($settings['ap_infobox_read_more_icon'] ); ?> ap-infobox-icon-left" aria-hidden="true"></i> 
			<?php echo $settings['ap_infobox_read_more_text']; ?>					
		<?php elseif($readmore_icon_alignment == 'right'): ?>
			<?php echo $settings['ap_infobox_read_more_text']; ?>					
			<i class="<?php echo esc_attr($settings['ap_infobox_read_more_icon'] ); ?> ap-infobox-icon-right" aria-hidden="true"></i> 
		<?php else: ?>	
			<?php echo $settings['ap_infobox_read_more_text']; ?>					
		<?php endif; ?>

		<?php if( ! empty( $infobox_link ) ) : ?>
				</a>
		<?php endif; ?>
	
	 
	<?php }

	protected function render() {

		$settings = $this->get_settings_for_display();

        ?>

        <div class="ap-infobox-wrapper"> 

		<?php if('design-one' == $settings['ap_infobox_style']) { ?>
			
		<div class="ap-infobox-design-1"> 

				<div class="ap-infobox-details">
			
					<?php $this->infobox_icon_or_image(); ?>
					<?php $this->infobox_title(); ?>
					<?php $this->infobox_description(); ?>
					<?php $this->infobox_link(); ?>
	
				</div>

				
		</div>
		
        <?php } elseif('design-two' == $settings['ap_infobox_style']) { ?>
            <div class="ap-infobox-design-2"> 
                    
				<div class="ap-infobox-details">
			
					<?php $this->infobox_icon_or_image(); ?>
					<?php $this->infobox_title(); ?>
					<?php $this->infobox_description(); ?>
					<?php $this->infobox_link(); ?>

				</div>

			</div>
			
		<?php } ?>

		</div>

        

	<?php }
	protected function _content_template() {

		
	}
	
}