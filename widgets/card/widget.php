<?php
namespace AddonPack\Elementor\Widget;

use Elementor\Widget_Base;
use AddonPack\Includes;
use Elementor\Utils;
use Elementor\Control_Media;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Css_Filter;
use Elementor\Group_Control_Border;
use Elementor\Scheme_Typography;


if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Card extends Widget_Base {

	protected $templateInstance;

    public function getPostsInstance(){
        return $this->templateInstance = Includes\AddonPack_Helper::getInstance();
    }

	public function get_name() {
		return 'ap-card';
	}

	public function get_title() {
		return __( 'Card', 'addon-pack' );
	}

	public function get_icon() {
		return ' eicon-image-box';
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
			'ap_card_layout',
			[
				'label' => __( 'Layouts', 'addon-pack' ),
			]
        );
        
        $this->add_control(
            'ap_card_style',
            [
               'label'       => __( 'Select Style', 'addon-pack'),
               'type' => Controls_Manager::SELECT,
               'default' => 'design-one',
               'options' => [
                   'design-one'      => __( 'Design 1', 'addon-pack'),
                   'design-two'      => __( 'Design 2', 'addon-pack'),
                   'design-three'    => __( 'Design 3', 'addon-pack'),
                   'design-four'     => __( 'Design 4', 'addon-pack'),
               ],
            ]
		);

        $this->end_controls_section();

        $this->start_controls_section(
			'ap_card_image_badge',
			[
				'label' => __( 'Image & Badge', 'addon-pack' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

        $this->add_control(
            'ap_card_image',
            [
                'label' => __( 'Image', 'addon-pack' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail',
                'default' => 'large',
                'separator' => 'none',
            ]
		);

        $this->add_control(
			'ap_card_badge_enable',
            [
                'label'         => __('Badge Enable', 'addon-pack'),
                'type'          => Controls_Manager::SWITCHER,
				'description'   => __('Enable or disable badge','addon-pack'),
				'default'       =>  'yes',
				'separator' => 'before',
            ]
        );

        $this->add_control(
            'ap_card_badge_text',
            [
                'label' => __( 'Badge Text', 'addon-pack' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => __( 'Addon Pack', 'addon-pack' ),
                'description' => __( 'Badget position and control set from Style tab', 'addon-pack' ),
                'dynamic' => [
                    'active' => true,
                ],
                'condition'     => [
					'ap_card_badge_enable' => 'yes',
				]
            ]
        );

        $this->end_controls_section();
        
        $this->start_controls_section(
			'ap_card_title_desc',
			[
				'label' => __( 'Title & Description', 'addon-pack' ),
			]
        );

        $this->add_control(
			'ap_card_title',
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
			'ap_card_description',
			[
				'label' => __( 'Description', 'addon-pack' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => __('Enter a good one liner that supports the above heading and gives users a reason to click the Button below.', 'addon-pack'),
				'dynamic' => [
					'active' => true,
                ],
                'label_block' => true,
			]
		);
		
		$this->add_control(
			'ap_card_title_url_enable',
            [
                'label'         => __('Title URL', 'addon-pack'),
                'type'          => Controls_Manager::SWITCHER,
                'description'   => __('Enable or disable title link','addon-pack'),
            ]
        );

		$this->add_control('ap_card_title_link_selection', 
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
					'ap_card_title_url_enable' => 'yes',
				]
			]
		);
	
		$this->add_control('ap_card_title_url',
			[
				'label'         => __('Link', 'addon-pack'),
				'type'          => Controls_Manager::URL,
				'dynamic'       => [ 'active' => true ],
				'default'       => [
					'url'   => '#',
				],
				'label_block'   => true,
				'condition'     => [
					'ap_card_title_url_enable'     => 'yes',
					'ap_card_title_link_selection' => 'custom_url'
				]
			]
		);
	
		$this->add_control('ap_card_title_existing_url',
			[
				'label'         => __('Existing Page', 'addon-pack'),
				'type'          => Controls_Manager::SELECT2,
				'options'       => $this->getPostsInstance()->get_all_posts(),
				'condition'     => [
					'ap_card_title_url_enable'         => 'yes',
					'ap_card_title_link_selection'     => 'existing_url',
				],
				'multiple'      => false,
				'label_block'   => true,
			]
		);

		$this->add_control(
			'ap_card_title_existing_url_target_blank',
            [
                'label'         => __('Open a new Tab', 'addon-pack'),
                'type'          => Controls_Manager::SWITCHER,
				'description'   => __('Enable or disable open with tab','addon-pack'),
				'condition'     => [
					'ap_card_title_link_selection'     => 'existing_url',
				],
            ]
        );

        $this->add_control(
			'ap_card_tag',
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
			'ap_card_align',
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
					'{{WRAPPER}} .ap-card-body' => 'text-align: {{VALUE}};',
				],
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
				'default' => 'fas fa-atom',
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
                'default' => 'left',
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
					'{{WRAPPER}} .ap-card-body .ap-card-icon-right'  => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .ap-card-body .ap-card-icon-left'   => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->end_controls_section();

	}

	
	protected function register_heading_style_controls(){

		$this->start_controls_section(
			'ap_card_image_style',
			[
				'label' => __( 'Image', 'addon-pack' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'ap_card_image_width',
			[
				'label' => __( 'Width', 'addon-pack' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'%' => [
						'min' => 1,
						'max' => 100,
					],
					'px' => [
						'min' => 50,
						'max' => 1500,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .ap-card-img' => 'max-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'ap_card_image_height',
			[
				'label' => __( 'Height', 'addon-pack' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 100,
						'max' => 500,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .ap-card-img' => 'max-height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'ap_card_image_border',
				'selector' => '{{WRAPPER}} .ap-card-img img',
			]
		);

		$this->add_responsive_control(
			'ap_card_image_border_radius',
			[
				'label' => __( 'Border Radius', 'addon-pack' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .ap-card-img img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'ap_card_image_box_shadow',
				'exclude' => [
					'box_shadow_position',
				],
				'selector' => '{{WRAPPER}} .ap-card-img img',
				'separator' => 'after'
			]
		);

		$this->add_responsive_control(
			'ap_card_image_padding',
			[
				'label' => __( 'Padding', 'addon-pack' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .ap-card-img img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs(
			'ap_card_image_effects_tabs',
			[
				'separator' => 'before'
			]
		);

		$this->start_controls_tab(
			'ap_card_image_effects_tab_normal',
			[
				'label' => __( 'Normal', 'addon-pack' ),
			]
		);

		$this->add_control(
			'ap_card_image_opacity',
			[
				'label' => __( 'Opacity', 'addon-pack' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 2,
						'min' => 0.10,
						'step' => 0.01,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .ap-card-img img' => 'opacity: {{SIZE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => 'ap_card_image_css_filters',
				'selector' => '{{WRAPPER}} .ap-card-img img',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab( 'hover',
			[
				'label' => __( 'Hover', 'addon-pack' ),
			]
		);

		$this->add_control(
			'ap_card_image_opacity_hover',
			[
				'label' => __( 'Opacity', 'addon-pack' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 2,
						'min' => 0.10,
						'step' => 0.01,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .ap-card-img:hover img' => 'opacity: {{SIZE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => 'ap_card_image_css_filters_hover',
				'selector' => '{{WRAPPER}} .ap-card-img:hover img',
			]
		);

		$this->add_control(
			'ap_card_image_background_hover_transition',
			[
				'label' => __( 'Transition Duration', 'addon-pack' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 5,
						'step' => 0.1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .ap-card-img img' => 'transition-duration: {{SIZE}}s;',
				],
			]
		);

		$this->add_control(
			'ap_card_image_hover_animation',
			[
				'label' => __( 'Hover Animation', 'addon-pack' ),
				'type' => Controls_Manager::HOVER_ANIMATION,
				'label_block' => true,
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
            'ap_card_badge_style',
            [
                'label' => __( 'Badge', 'addon-pack' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition' => [
					'ap_card_badge_enable' => 'yes',
				],
            ]
        );

        $this->add_control(
            'ap_card_badge_position',
            [
                'label' => __( 'Position', 'addon-pack' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'top-left'  => __( 'Top Left', 'addon-pack' ),
                    'top-right'  => __( 'Top Right', 'addon-pack' ),
                    'bottom-left'  => __( 'Bottom Left', 'addon-pack' ),
                    'bottom-right'  => __( 'Bottom Right', 'addon-pack' ),
                ],
                'default' => 'top-right',
            ]
        );

        $this->add_responsive_control(
            'ap_card_badge_padding',
            [
                'label' => __( 'Padding', 'addon-pack' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .ap-card-badge' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'ap_card_badge_color',
            [
                'label' => __( 'Text Color', 'addon-pack' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ap-card-badge' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'ap_card_badge_bg_color',
            [
                'label' => __( 'Background Color', 'addon-pack' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ap-card-badge' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'ap_card_badge_border',
                'selector' => '{{WRAPPER}} .ap-card-badge',
            ]
        );

        $this->add_responsive_control(
            'ap_card_badge_border_radius',
            [
                'label' => __( 'Border Radius', 'addon-pack' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .ap-card-badge' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'ap_card_badge_box_shadow',
                'exclude' => [
                    'box_shadow_position',
                ],
                'selector' => '{{WRAPPER}} .ap-card-badge',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'ap_card_badge_typography',
                'label' => __( 'Typography', 'addon-pack' ),
                'exclude' => [
                    'line_height'
                ],
                'default' => [
                    'font_size' => ['']
                ],
                'selector' => '{{WRAPPER}} .ap-card-badge',
                'scheme' => Scheme_Typography::TYPOGRAPHY_3,
            ]
        );

        $this->end_controls_section();
		
		$this->start_controls_section(
            'ap_card_content_style',
            [
                'label' => __( 'Title & Description', 'addon-pack' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'ap_content_padding',
            [
                'label' => __( 'Content Padding', 'addon-pack' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .ap-card-body' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'ap_card_title_heading',
            [
                'type' => Controls_Manager::HEADING,
                'label' => __( 'Title', 'addon-pack' ),
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'ap_card_title_color',
            [
                'label' => __( 'Text Color', 'addon-pack' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ap-card-title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'ap_card_title_typography',
                'label' => __( 'Typography', 'addon-pack' ),
                'selector' => '{{WRAPPER}} .ap-card-title',
                'scheme' => Scheme_Typography::TYPOGRAPHY_2,
            ]
		);
		
		$this->add_responsive_control(
            'ap_card_title_spacing',
            [
                'label' => __( 'Bottom Spacing', 'addon-pack' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .ap-card-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'ap_card_description_heading',
            [
                'type' => Controls_Manager::HEADING,
                'label' => __( 'Description', 'addon-pack' ),
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'ap_card_description_color',
            [
                'label' => __( 'Text Color', 'addon-pack' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ap-card-description' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'ap_card_description_typography',
                'label' => __( 'Typography', 'addon-pack' ),
                'selector' => '{{WRAPPER}} .ap-card-description',
                'scheme' => Scheme_Typography::TYPOGRAPHY_3,
            ]
		);
		
		$this->add_responsive_control(
            'ap_card_description_spacing',
            [
                'label' => __( 'Bottom Spacing', 'addon-pack' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .ap-card-description' => 'margin-bottom: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .ap-card-body .ap-card-btn-text, {{WRAPPER}} .ap-card-body .ap-card-btn-icon' => 'color: {{VALUE}};',
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
					'{{WRAPPER}} .ap-card-button' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'        => 'ap_button_border',
				'separator'   => 'before',
				'selector'    => '{{WRAPPER}} .ap-card-button'
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
					'{{WRAPPER}} .ap-card-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'ap_button_shadow',
				'selector' => '{{WRAPPER}} .ap-card-button',
			]
		);

		$this->add_responsive_control(
			'ap_button_padding',
			[
				'label'      => __( 'Padding', 'addon-pack' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .ap-card-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'ap_button_typography',
				'selector' => '{{WRAPPER}} .ap-card-body .ap-card-btn-text',
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
					'{{WRAPPER}} .ap-card-body .ap-card-button:hover .ap-card-body .ap-card-btn-text, {{WRAPPER}} .ap-card-body .ap-card-button:hover .ap-card-body .ap-card-btn-icon' => 'color: {{VALUE}};',				],
			]
		);

		$this->add_control(
			'ap_button_hover_background',
			[
				'label' => __( 'Background Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .ap-card-body .ap-card-button:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'ap_button_hover_border_color',
			[
				'label'     => __( 'Border Color', 'addon-pack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ap-card-button:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'ap_button_hover_shadow',
				'selector' => '{{WRAPPER}} .ap-card-button:hover',
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

    protected function card_image(){ 
        $settings = $this->get_settings_for_display();

		if ( ! empty( $settings['ap_card_image']['url'] ) ) {
			$this->add_render_attribute( 'ap_card_image', 'src', $settings['ap_card_image']['url'] );
			$this->add_render_attribute( 'ap_card_image', 'alt', Control_Media::get_image_alt( $settings['ap_card_image'] ) );
			$this->add_render_attribute( 'ap_card_image', 'title', Control_Media::get_image_title( $settings['ap_card_image'] ) );
			
			if ( $settings['ap_card_image_hover_animation'] ) {
				$this->add_render_attribute( 'ap_card_image', 'class', 'elementor-animation-' . $settings['ap_card_image_hover_animation'] );
			}

			echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'ap_card_image' );
		}
		 
		$badge_enable = $settings['ap_card_badge_enable'];
        $this->add_render_attribute( 'ap_card_badge_text', 'class', 'ap-card-badge' );
		$this->add_render_attribute(
            'ap_card_badge_text',
            'class',
            ['ap-card-badge', sprintf( 'ap-card-badge-%s', esc_attr( $settings['ap_card_badge_position'] ) )]
		);
		
		if($badge_enable): ?>
            <div <?php echo $this->get_render_attribute_string( 'ap_card_badge_text' ); ?>><?php echo $settings['ap_card_badge_text']; ?></div>
		<?php endif; 

    }

    protected function card_title(){
		$settings = $this->get_settings_for_display();

		$this->add_inline_editing_attributes( 'ap_card_title', 'basic' );
		$this->add_render_attribute( 'ap_card_title', 'class', 'ap-card-title' );
		$this->add_render_attribute( 'ap_card_title_existing_url_target_blank', 'target', '_blank' );

		$ap_card_title_tag = $settings['ap_card_tag'];

		$ap_card_title = '<' . $ap_card_title_tag. ' class="ap-card-title" >'. $settings['ap_card_title'] . '</' . $ap_card_title_tag . '> ';
		
		$ap_title_link = '';
        if( $settings['ap_card_title_url_enable'] == 'yes' && $settings['ap_card_title_link_selection'] == 'existing_url' ) {
            $ap_title_link = get_permalink( $settings['ap_card_title_existing_url'] );
        } elseif( $settings['ap_card_title_url_enable'] == 'yes' && $settings['ap_card_title_link_selection'] == 'custom_url' ) {
            $ap_title_link = $settings['ap_card_title_url']['url'];
		}
		
		?>

		<?php if( ! empty( $ap_title_link ) ) : ?>
			<a href="<?php echo esc_attr( $ap_title_link ); ?>" <?php if($settings['ap_card_title_existing_url_target_blank'] == 'yes'): echo $this->get_render_attribute_string( 'ap_card_title_existing_url_target_blank' ); endif; ?> <?php if( ! empty( $settings['ap_card_title_url']['is_external'] ) ) : ?> <?php endif; ?><?php if( ! empty( $settings['ap_card_title_url']['nofollow'] ) ) : ?> rel="nofollow" <?php endif; ?>>
		<?php endif; ?>
		
			<?php echo $ap_card_title; ?>

		<?php if( ! empty( $ap_title_link ) ) : ?>
			</a>
		<?php endif; ?>

        
	 <?php 
	 
    }
    
    protected function card_description(){
		$settings = $this->get_settings_for_display();

        $this->add_inline_editing_attributes( 'ap_card_description', 'intermediate' );
		$this->add_render_attribute( 'ap_card_description', 'class', 'ap-card-description' );

		?>

		<p <?php echo $this->get_render_attribute_string( 'ap_card_description' ); ?>><?php echo $settings['ap_card_description']; ?></p>
    
    <?php 

	}

    protected function card_link(){
		$settings = $this->get_settings_for_display();
		$readmore_icon_alignment = $settings['ap_button_icon_align'];

		if($settings['ap_button_enable'] == 'yes'){
			$this->add_render_attribute( 'ap_button_existing_url_target_blank', 'target', '_blank' );

			$this->add_render_attribute( 'ap_button_rander', 'class', 'ap-card-button');
			$this->add_render_attribute( 'ap_button_rander', 'class', 'ap-button-' . esc_attr($settings['ap_button_size']) );

			if ( $settings['ap_button_hover_animation'] ) {
				$this->add_render_attribute( 'ap_button_rander', 'class', 'elementor-animation-' . $settings['ap_button_hover_animation'] );
			} 
		}

		$card_link = '';
        if( $settings['ap_button_enable'] == 'yes' && $settings['ap_button_link_selection'] == 'existing_url' ) {
            $card_link = get_permalink( $settings['ap_button_existing_url'] );
        } elseif( $settings['ap_button_enable'] == 'yes' && $settings['ap_button_link_selection'] == 'custom_url' ) {
            $card_link = $settings['ap_button_url']['url'];
		}

		?>

			<?php if( ! empty( $card_link ) ) : ?>
				<a href="<?php echo esc_attr( $card_link ); ?>" <?php echo $this->get_render_attribute_string( 'ap_button_existing_url_target_blank' ); ?> <?php if( ! empty( $settings['ap_button_url']['is_external'] ) ) : ?> <?php endif; ?><?php if( ! empty( $settings['ap_button_url']['nofollow'] ) ) : ?> rel="nofollow" <?php endif; ?>>
			<?php endif; ?>

				<div <?php echo $this->get_render_attribute_string( 'ap_button_rander' ); ?>>

					<?php if($readmore_icon_alignment == 'left'): ?>
						<i class="ap-card-btn-icon <?php echo esc_attr($settings['ap_button_icon'] ); ?> ap-card-icon-left" aria-hidden="true"></i> 
						<span class="ap-card-btn-text"><?php echo $settings['ap_button_text']; ?></span>					
					<?php elseif($readmore_icon_alignment == 'right'): ?>
						<span class="ap-card-btn-text"><?php echo $settings['ap_button_text']; ?></span>					
						<i class="ap-card-btn-icon <?php echo esc_attr($settings['ap_button_icon'] ); ?> ap-card-icon-right" aria-hidden="true"></i> 
					<?php else: ?>	
						<span class="ap-card-btn-text"><?php echo $settings['ap_button_text']; ?></span>					
					<?php endif; ?>

				</div>

			<?php if( ! empty( $card_link ) ) : ?>
				</a>
			<?php endif; ?>
	 
	<?php }

	protected function render() {
        $settings = $this->get_settings_for_display();
        
        ?>

        <?php if('design-one' == $settings['ap_card_style']) { ?>
			
            <div class="ap-card-design-1"> 
    
                    <div class="ap-card">

                        <div class="ap-card-img">
                            <?php $this->card_image(); ?>
                        </div>
                        
                        <div class="ap-card-body">

                            <?php $this->card_title(); ?>
                            <?php $this->card_description(); ?>
                            <?php $this->card_link(); ?>

                        </div>
        
                    </div>
         
            </div>

        <?php } elseif('design-two' == $settings['ap_card_style']) { ?>

            <div class="ap-card-design-2"> 
    
                    <div class="ap-card">

						<div class="ap-card-img">
							<?php $this->card_image(); ?>
						</div>
                        
                        <div class="ap-card-body">

                            <?php $this->card_title(); ?>
                            <?php $this->card_description(); ?>
                            <?php $this->card_link(); ?>

                        </div>
        
                    </div>
         
            </div>

            
            <?php } elseif('design-three' == $settings['ap_card_style']) { ?>

                <div class="ap-card-design-3"> 
    
                    <div class="ap-card">

						<div class="ap-card-img">
							<?php $this->card_image(); ?>
						</div>
                        
                        <div class="ap-card-body">

                            <?php $this->card_title(); ?>
                            <?php $this->card_description(); ?>
                            <?php $this->card_link(); ?>

                        </div>

                    </div>

                </div>

        <?php } elseif('design-four' == $settings['ap_card_style']) { ?>

			<div class="ap-card-design-4"> 
    
				<div class="ap-card">

					<div class="ap-card-body">

						<?php $this->card_title(); ?>
						<?php $this->card_description(); ?>
						<?php $this->card_link(); ?>

					</div>

					<div class="ap-card-img">
						<?php $this->card_image(); ?>
					</div>

				</div>

			</div>
	 
	<?php  
	 
		} 

    }

    
    protected function _content_template() {

	}
	
}