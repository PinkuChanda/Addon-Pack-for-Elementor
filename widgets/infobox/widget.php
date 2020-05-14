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
			'ap_infobox_icon_view',
			[
				'label' => __( 'View', 'elementor' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'default' => __( 'Default', 'elementor' ),
					'stacked' => __( 'Stacked', 'elementor' ),
					'framed'  => __( 'Framed', 'elementor' ),
					'classic' => __( 'Classic', 'elementor' ),
				],
				'condition' => [
                    'ap_infobox_icon_type' => 'ap_infobox_icon'
                ],
				'default' => 'default',
				'prefix_class' => 'ap-infobox-icon-view-',
			]
		);

		$this->add_control(
			'ap_infobox_icon_shape',
			[
				'label' => __( 'Shape', 'elementor' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'circle' => __( 'Circle', 'elementor' ),
					'square' => __( 'Square', 'elementor' ),
				],
				'default' => 'circle',
				'condition' => [
					'ap_infobox_icon_view!' => 'default',
					'ap_infobox_icon_view!' => 'classic',
					'ap_infobox_icon_type' => 'ap_infobox_icon',
				],
				'prefix_class' => 'ap-infobox-icon-shape-',
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
			'ap_infobox_title_url_enable',
            [
                'label'         => __('Title URL', 'addon-pack'),
                'type'          => Controls_Manager::SWITCHER,
                'description'   => __('Enable or disable title link','addon-pack'),
            ]
        );

		$this->add_control('ap_infobox_title_link_selection', 
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
					'ap_infobox_title_url_enable' => 'yes',
				]
			]
		);
	
		$this->add_control('ap_infobox_title_url',
			[
				'label'         => __('Link', 'addon-pack'),
				'type'          => Controls_Manager::URL,
				'dynamic'       => [ 'active' => true ],
				'default'       => [
					'url'   => '#',
				],
				'label_block'   => true,
				'condition'     => [
					'ap_infobox_title_url_enable'     => 'yes',
					'ap_infobox_title_link_selection' => 'custom_url'
				]
			]
		);
	
		$this->add_control('ap_infobox_title_existing_url',
			[
				'label'         => __('Existing Page', 'addon-pack'),
				'type'          => Controls_Manager::SELECT2,
				'options'       => $this->getPostsInstance()->get_all_posts(),
				'condition'     => [
					'ap_infobox_title_url_enable'         => 'yes',
					'ap_infobox_title_link_selection'     => 'existing_url',
				],
				'multiple'      => false,
				'label_block'   => true,
			]
		);

		$this->add_control(
			'ap_infobox_title_existing_url_target_blank',
            [
                'label'         => __('Open a new Tab', 'addon-pack'),
                'type'          => Controls_Manager::SWITCHER,
				'description'   => __('Enable or disable open with tab','addon-pack'),
				'condition'     => [
					'ap_infobox_title_link_selection'     => 'existing_url',
				],
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
					'{{WRAPPER}} .ap-infobox'       => 'text-align: {{VALUE}};',
					'{{WRAPPER}} .ap-infobox-thumb' => 'text-align: {{VALUE}};',
				],
				'condition'     => [
					'ap_infobox_style' => 'design-one',
				]
			]
		);


        $this->end_controls_section();

		$this->start_controls_section(
			'ap_button',
			[
				'label' => __( 'Button', 'addon-pack' ),
			]
		);
		
		$this->add_control(
			'ap_button_enable',
            [
                'label'         => __('Button Enable', 'addon-pack'),
                'type'          => Controls_Manager::SWITCHER,
				'description'   => __('Enable or disable button','addon-pack'),
				'default'       =>  'yes',
            ]
        );

        $this->add_control(
			'ap_button_text',
			[
				'label' => __( 'Button Text', 'addon-pack' ),
				'type' => Controls_Manager::TEXT,
				'default' => __('Read More', 'addon-pack'),
				'dynamic' => [
					'active' => true,
				],
				'label_block' => true,
				'condition'     => [
					'ap_button_enable' => 'yes',
				]
			]
		);

		
		$this->add_control('ap_button_link_selection', 
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
				'ap_button_enable' => 'yes',
			]
		]
		);

		$this->add_control('ap_button_url',
			[
				'label'         => __('Link', 'addon-pack'),
				'type'          => Controls_Manager::URL,
				'dynamic'       => [ 'active' => true ],
				'default'       => [
					'url'   => '#',
				],
				'label_block'   => true,
				'condition'     => [
					'ap_button_enable' => 'yes',
					'ap_button_link_selection' => 'custom_url'
				]
			]
		);

		$this->add_control('ap_button_existing_url',
			[
				'label'         => __('Existing Page', 'addon-pack'),
				'type'          => Controls_Manager::SELECT2,
				'options'       => $this->getPostsInstance()->get_all_posts(),
				'condition'     => [
					'ap_button_enable' => 'yes',
					'ap_button_link_selection'     => 'existing_url',
				],
				'multiple'      => false,
				'label_block'   => true,
			]
		);

		$this->add_control(
			'ap_button_existing_url_target_blank',
            [
                'label'         => __('Open a new Tab', 'addon-pack'),
                'type'          => Controls_Manager::SWITCHER,
				'description'   => __('Enable or disable open with tab','addon-pack'),
				'condition'     => [
					'ap_button_link_selection'   => 'existing_url',
				],
            ]
        );

		$this->add_control(
			'ap_button_size',
			[
				'label'   => esc_html__( 'Button Size', 'addon-pack' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'md',
				'options' => [
					'xs' => esc_html__( 'Extra Small', 'addon-pack' ),
					'sm' => esc_html__( 'Small', 'addon-pack' ),
					'md' => esc_html__( 'Medium', 'addon-pack' ),
					'lg' => esc_html__( 'Large', 'addon-pack' ),
					'xl' => esc_html__( 'Extra Large', 'addon-pack' ),
				],
				'condition'     => [
					'ap_button_enable' => 'yes',
				],
			]
		);

		$this->add_control(
            'ap_button_icon_heading',
            [
                'type' => Controls_Manager::HEADING,
                'label' => __( 'Icon', 'addon-pack' ),
				'separator' => 'before',
				'condition' => [
                    'ap_button_enable' => 'yes',
				],
            ]
		);
		
		$this->add_control(
			'ap_button_icon_enable',
            [
                'label'         => __('Icon Enable', 'addon-pack'),
                'type'          => Controls_Manager::SWITCHER,
				'description'   => __('Enable or disable Icon','addon-pack'),
				'condition' => [
                    'ap_button_enable' => 'yes',
				],
				'default' => 'yes',
            ]
        );

		$this->add_control(
			'ap_button_icon',
			[
				'label'       => esc_html__( 'Icon', 'addon-pack' ),
				'type'        => Controls_Manager::ICON,
				'default' => 'fas fa-angle-right',
				'label_block' => true,
				'condition' => [
					'ap_button_icon_enable' => 'yes',
					'ap_button_enable' => 'yes',
				],
			]
		);
		

		$this->add_control(
            'ap_button_icon_align',
            [
                'label' => __( 'Icon Position', 'addon-pack' ),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options' => [
                    'left' => [
                        'title' => __( 'Before', 'addon-pack' ),
                        'icon' => 'eicon-h-align-left',
					],
					'none' => [
                        'title' => __( 'None', 'addon-pack' ),
                        'icon' => 'eicon-close-circle',
                    ],
                    'right' => [
                        'title' => __( 'After', 'addon-pack' ),
                        'icon' => 'eicon-h-align-right',
                    ],
                ],
                'default' => 'right',
                'condition' => [
					'ap_button_icon_enable' => 'yes',
					'ap_button_enable' => 'yes',
				],
            ]
        );

		$this->add_control(
			'ap_button_icon_spacing',
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
					'ap_button_icon!' => '',
					'ap_button_icon_align!' => 'none',
					'ap_button_icon_enable' => 'yes',
					'ap_button_enable' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}} .ap-infobox-button .ap-button-icon-right'  => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .ap-infobox-button .ap-button-icon-left'   => 'margin-right: {{SIZE}}{{UNIT}};',
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

		// General Style

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'ap_infobox_bg',
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .ap-infobox-design-1, {{WRAPPER}} .ap-infobox-design-2',
			]
		);

		$this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'ap_infobox_border_color',
				'selector' => '{{WRAPPER}} .ap-infobox-design-1, {{WRAPPER}} .ap-infobox-design-2',
            ]
        );

		$this->add_responsive_control(
			'ap_infobox_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'addon-pack' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .ap-infobox-design-1' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .ap-infobox-design-2' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'ap_infobox_shadow',
				'selector' => '{{WRAPPER}} .ap-infobox-design-1, {{WRAPPER}} .ap-infobox-design-2',
			]
		);

		$this->add_responsive_control(
            'ap_infobox_padding',
            [
                'label' => esc_html__('Padding', 'addon-pack'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .ap-infobox-design-1' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .ap-infobox-design-2' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
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

		$this->start_controls_tabs( 'icon_colors' );

		$this->start_controls_tab(
			'ap_infobox_icon_colors_normal',
			[
				'label' => __( 'Normal', 'addon-pack' ),
			]
		);

		$this->add_control(
			'ap_infobox_icon_primary_color',
			[
				'label' => __( 'Primary Color', 'addon-pack' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}}.ap-infobox-icon-view-stacked .ap-infobox-icon' => 'background-color: {{VALUE}};',
					'{{WRAPPER}}.ap-infobox-icon-view-classic .ap-infobox-icon' => 'background-color: {{VALUE}};',
					'{{WRAPPER}}.ap-infobox-icon-view-framed .ap-infobox-icon, {{WRAPPER}}.ap-infobox-icon-view-default .ap-infobox-icon' => 'fill: {{VALUE}}; color: {{VALUE}}; border-color: {{VALUE}};',
				],
				'condition' => [
                    'ap_infobox_icon_type' => 'ap_infobox_icon'
                ]
			]
		);

		$this->add_control(
			'ap_infobox_icon_secondary_color',
			[
				'label' => __( 'Secondary Color', 'addon-pack' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}}.ap-infobox-icon-view-framed .ap-infobox-icon' => 'background-color: {{VALUE}};',
					'{{WRAPPER}}.ap-infobox-icon-view-stacked .ap-infobox-icon' => 'fill: {{VALUE}}; color: {{VALUE}};',
					'{{WRAPPER}}.ap-infobox-icon-view-classic .ap-infobox-icon' => 'fill: {{VALUE}}; color: {{VALUE}};',
				],
				'condition' => [
					'ap_infobox_icon_type' => 'ap_infobox_icon',
					'ap_infobox_icon_view!' => 'default',
                ]
				
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'ap_card_image_border',
				'selector' => '{{WRAPPER}} .ap-infobox-thumb img',
				'condition' => [
					'ap_infobox_icon_type' => 'ap_infobox_image'
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'ap_infobox_icon_colors_hover',
			[
				'label' => __( 'Hover', 'addon-pack' ),
			]
		);

		$this->add_control(
			'ap_infobox_icon_hover_primary_color',
			[
				'label' => __( 'Primary Color', 'addon-pack' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}}.ap-infobox-icon-view-stacked .ap-infobox-icon:hover' => 'background-color: {{VALUE}};',
					'{{WRAPPER}}.ap-infobox-icon-view-classic .ap-infobox-icon:hover' => 'background-color: {{VALUE}};',
					'{{WRAPPER}}.ap-infobox-icon-view-framed .ap-infobox-icon:hover, {{WRAPPER}}.ap-infobox-icon-view-default .ap-infobox-icon:hover' => 'fill: {{VALUE}}; color: {{VALUE}}; border-color: {{VALUE}};',
				],
				'condition' => [
                    'ap_infobox_icon_type' => 'ap_infobox_icon'
                ]
			]
		);

		$this->add_control(
			'ap_infobox_icon_hover_secondary_color',
			[
				'label' => __( 'Secondary Color', 'addon-pack' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}}.ap-infobox-icon-view-framed .ap-infobox-icon:hover' => 'background-color: {{VALUE}};',
					'{{WRAPPER}}.ap-infobox-icon-view-stacked .ap-infobox-icon:hover' => 'fill: {{VALUE}}; color: {{VALUE}};',
					'{{WRAPPER}}.ap-infobox-icon-view-classic .ap-infobox-icon:hover' => 'fill: {{VALUE}}; color: {{VALUE}};',
				],
				'condition' => [
					'ap_infobox_icon_type' => 'ap_infobox_icon',
					'ap_infobox_icon_view!' => 'default',
                ]
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'ap_card_image_border_hover',
				'selector' => '{{WRAPPER}} .ap-infobox-thumb img:hover',
				'condition' => [
					'ap_infobox_icon_type' => 'ap_infobox_image'
				],
			]
		);

		$this->add_control(
			'ap_infobox_icon_hover_animation',
			[
				'label' => __( 'Hover Animation', 'addon-pack' ),
				'type' => Controls_Manager::HOVER_ANIMATION,
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'ap_infobox_icon_space',
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
					'{{WRAPPER}} .ap-infobox-thumb' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					'(mobile){{WRAPPER}} .ap-infobox-thumb' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'ap_infobox_icon_size',
			[
				'label' => __( 'Size', 'addon-pack' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 6,
						'max' => 300,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .ap-infobox-icon' => 'font-size: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'ap_infobox_icon_type' => 'ap_infobox_icon'
				],
			]
		);

		$this->add_control(
			'ap_infobox_icon_rotate',
			[
				'label' => __( 'Rotate', 'addon-pack' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 0,
					'unit' => 'deg',
				],
				'selectors' => [
					'{{WRAPPER}} .ap-infobox-icon' => 'transform: rotate({{SIZE}}{{UNIT}});',
					'{{WRAPPER}} .ap-infobox-thumb img' => 'transform: rotate({{SIZE}}{{UNIT}});',
				],
			]
		);

		$this->add_control(
			'ap_infobox_icon_border_width',
			[
				'label' => __( 'Border Width', 'addon-pack' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .ap-infobox-icon' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .ap-infobox-thumb img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'ap_infobox_icon_view' => 'framed',
				],
			]
		);

		$this->add_control(
			'ap_infobox_icon_border_radius',
			[
				'label' => __( 'Border Radius', 'addon-pack' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .ap-infobox-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .ap-infobox-thumb img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'ap-infobox-icon-view!' => 'default',
					'ap_infobox_icon_type' => 'ap_infobox_image'
				],
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
			'ap_button_style',
			[
				'label'     => __( 'Button', 'addon-pack' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'ap_button_enable' => 'yes',
				],
			]
		);

		$this->start_controls_tabs( 'tabs_button_style' );

		$this->start_controls_tab(
			'ap_button_normal',
			[
				'label' => __( 'Normal', 'addon-pack' ),
			]
		);

		$this->add_control(
			'ap_button_text_color',
			[
				'label'     => __( 'Text Color', 'addon-pack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ap-infobox .ap-btn-text, {{WRAPPER}} .ap-infobox .ap-btn-icon' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'ap_button_background',
			[
				'label' => __( 'Background Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .ap-infobox-button' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'        => 'ap_button_border',
				'separator'   => 'before',
				'selector'    => '{{WRAPPER}} .ap-infobox-button'
			]
		);

		$this->add_responsive_control(
			'ap_button_radius',
			[
				'label'      => __( 'Border Radius', 'addon-pack' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'separator'  => 'after', 
				'selectors'  => [
					'{{WRAPPER}} .ap-infobox-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'ap_button_shadow',
				'selector' => '{{WRAPPER}} .ap-infobox-button',
			]
		);

		$this->add_responsive_control(
			'ap_button_padding',
			[
				'label'      => __( 'Padding', 'addon-pack' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .ap-infobox-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'ap_button_typography',
				'selector' => '{{WRAPPER}} .ap-infobox .ap-btn-text',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'ap_button_hover',
			[
				'label' => __( 'Hover', 'addon-pack' ),
			]
		);

		$this->add_control(
			'ap_button_hover_text_color',
			[
				'label'     => __( 'Text Color', 'addon-pack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ap-infobox .ap-infobox-button:hover .ap-btn-text, {{WRAPPER}} .ap-infobox .ap-infobox-button:hover .ap-btn-icon' => 'color: {{VALUE}};',				
				],
			]
		);

		$this->add_control(
			'ap_button_hover_background',
			[
				'label' => __( 'Background Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .ap-infobox .ap-infobox-button:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'ap_button_hover_shadow',
				'selector' => '{{WRAPPER}} .ap-infobox-button:hover',
			]
		);

		$this->add_control(
			'ap_button_hover_animation',
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

		$this->add_render_attribute( 'thumb', 'class', 'ap-infobox-thumb' );
		if ( $settings['ap_infobox_icon_hover_animation'] ) {
			$this->add_render_attribute( 'thumb', 'class', 'elementor-animation-' . $settings['ap_infobox_icon_hover_animation'] );
		}

		if ( $is_icon and 'ap_infobox_icon' == $settings['ap_infobox_icon_type'] ) {
			$this->add_render_attribute( 'i', 'class', 'ap-infobox-icon' );
			$this->add_render_attribute( 'i', 'class', $settings['ap_infobox_icon'] );
			$this->add_render_attribute( 'i', 'aria-hidden', 'true' );			
		} elseif ( $is_image and 'ap_infobox_image' == $settings['ap_infobox_icon_type'] ) {
			$this->add_render_attribute( 'img', 'src', $settings['ap_infobox_image']['url'] );
			$this->add_render_attribute( 'img', 'alt', $settings['ap_infobox_title'] );
		}
		
		if ( $is_icon or $is_image ) : ?>

		<div <?php echo $this->get_render_attribute_string( 'thumb' ); ?>>
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
		$this->add_render_attribute( 'ap_infobox_title_existing_url_target_blank', 'target', '_blank' );

		$ap_infobox_title_tag = $settings['ap_infobox_tag'];

		$ap_infobox_title = '<' . $ap_infobox_title_tag. ' class="ap-infobox-title" >'. $settings['ap_infobox_title'] . '</' . $ap_infobox_title_tag . '> ';
		
		$ap_title_link = '';
        if( $settings['ap_infobox_title_url_enable'] == 'yes' && $settings['ap_infobox_title_link_selection'] == 'existing_url' ) {
            $ap_title_link = get_permalink( $settings['ap_infobox_title_existing_url'] );
        } elseif( $settings['ap_infobox_title_url_enable'] == 'yes' && $settings['ap_infobox_title_link_selection'] == 'custom_url' ) {
            $ap_title_link = $settings['ap_infobox_title_url']['url'];
		}
		
		?>

		<?php if( ! empty( $ap_title_link ) ) : ?>
			<a href="<?php echo esc_attr( $ap_title_link ); ?>" <?php if($settings['ap_infobox_title_existing_url_target_blank'] == 'yes'): echo $this->get_render_attribute_string( 'ap_infobox_title_existing_url_target_blank' ); endif; ?> <?php if( ! empty( $settings['ap_infobox_title_url']['is_external'] ) ) : ?> <?php endif; ?><?php if( ! empty( $settings['ap_infobox_title_url']['nofollow'] ) ) : ?> rel="nofollow" <?php endif; ?>>
		<?php endif; ?>
		
			<?php echo $ap_infobox_title; ?>

		<?php if( ! empty( $ap_title_link ) ) : ?>
			</a>
		
		<?php endif; 
		
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
		$readmore_icon_alignment = $settings['ap_button_icon_align'];

		if($settings['ap_button_enable'] == 'yes'){
			$this->add_render_attribute( 'ap_button_existing_url_target_blank', 'target', '_blank' );

			$this->add_render_attribute( 'ap_button_rander', 'class', 'ap-infobox-button');
			$this->add_render_attribute( 'ap_button_rander', 'class', 'ap-button-' . esc_attr($settings['ap_button_size']) );

			if ( $settings['ap_button_hover_animation'] ) {
				$this->add_render_attribute( 'ap_button_rander', 'class', 'elementor-animation-' . $settings['ap_button_hover_animation'] );
			} 
		}

		$infobox_link = '';
		if( $settings['ap_button_enable'] == 'yes' && $settings['ap_button_link_selection'] == 'existing_url' ) {
			$infobox_link = get_permalink( $settings['ap_button_existing_url'] );
		} elseif( $settings['ap_button_enable'] == 'yes' && $settings['ap_button_link_selection'] == 'custom_url' ) {
			$infobox_link = $settings['ap_button_url']['url'];
		}

	?>

		<?php if( ! empty( $infobox_link ) ) : ?>
			<a href="<?php echo esc_attr( $infobox_link ); ?>" <?php echo $this->get_render_attribute_string( 'ap_button_existing_url_target_blank' ); ?> <?php if( ! empty( $settings['ap_button_url']['is_external'] ) ) : ?> <?php endif; ?><?php if( ! empty( $settings['ap_button_url']['nofollow'] ) ) : ?> rel="nofollow" <?php endif; ?>>
		<?php endif; ?>

			<div <?php echo $this->get_render_attribute_string( 'ap_button_rander' ); ?>>

				<?php if($readmore_icon_alignment == 'left'): ?>
					<i class="ap-btn-icon <?php echo esc_attr($settings['ap_button_icon'] ); ?> ap-button-icon-left" aria-hidden="true"></i> 
					<span class="ap-btn-text"><?php echo $settings['ap_button_text']; ?></span>					
				<?php elseif($readmore_icon_alignment == 'right'): ?>
					<span class="ap-btn-text"><?php echo $settings['ap_button_text']; ?></span>					
					<i class="ap-btn-icon <?php echo esc_attr($settings['ap_button_icon'] ); ?> ap-button-icon-right" aria-hidden="true"></i> 
				<?php else: ?>	
					<span class="ap-btn-text"><?php echo $settings['ap_button_text']; ?></span>					
				<?php endif; ?>

			</div>

		<?php if( ! empty( $infobox_link ) ) : ?>
			</a>
		<?php endif; ?>
 
<?php }

	protected function render() {

		$settings = $this->get_settings_for_display();

        ?>


		<?php if('design-one' == $settings['ap_infobox_style']) { ?>
			
		<div class="ap-infobox"> 

				<div class="ap-infobox-design-1">
			
					<?php $this->infobox_icon_or_image(); ?>
					<?php $this->infobox_title(); ?>
					<?php $this->infobox_description(); ?>
					<?php $this->infobox_link(); ?>
	
				</div>
				
		</div>
		
        <?php } elseif('design-two' == $settings['ap_infobox_style']) { ?>
            <div class="ap-infobox"> 
                    
				<div class="ap-infobox-design-2">

					<div class="ap-infobox-icon-wrapper">
						<?php $this->infobox_icon_or_image(); ?>
					</div>

					<div class="ap-infobox-info-wrapper">
						<?php $this->infobox_title(); ?>
						<?php $this->infobox_description(); ?>
						<?php $this->infobox_link(); ?>
					</div>

				</div>

			</div>
			
		<?php } ?>

        

	<?php }
	protected function _content_template() {

		
	}
	
}