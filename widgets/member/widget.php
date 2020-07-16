<?php
namespace AddonPack\Elementor\Widget;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Scheme_Typography;
use Elementor\Utils;
use Elementor\Control_Media;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Text_Shadow;


if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Member extends Widget_Base {

	public function get_name() {
		return 'ap-member';
	}

	public function get_title() {
		return __( 'Team Member', 'addon-pack' );
	}

	public function get_icon() {
		return 'eicon-person';
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
			'ap_member_layout',
			[
				'label' => __( 'Layouts', 'addon-pack' ),
			]
        );
        
        $this->add_control(
            'ap_member_design_style',
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
			'ap_member',
			[
				'label' => __( 'Team Member', 'addon-pack' ),
			]
		);

		$this->add_control(
            'ap_member_image',
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
            'ap_member_name',
            [
                'label' => __( 'Name', 'addon-pack' ),
                'label_block' => true,
                'type' => Controls_Manager::TEXT,
                'default' => 'Jhone Doe',
                'placeholder' => __( 'Type Member Name', 'addon-pack' ),
                'separator' => 'before',
                'dynamic' => [
                    'active' => true,
                ]
            ]
		);
		
		$this->add_control(
			'ap_member_name_tag',
			[
				'label' => __( 'Name HTML Tag', 'addon-pack' ),
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

        $this->add_control(
            'ap_member_job_title',
            [
                'label' => __( 'Job Title', 'addon-pack' ),
                'label_block' => true,
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Chief Executive Officer', 'addon-pack' ),
                'placeholder' => __( 'Type Job Title', 'addon-pack' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
		);

		$this->add_control(
			'ap_member_title_tag',
			[
				'label' => __( 'Title HTML Tag', 'addon-pack' ),
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
				'default' => 'h6',
				'label_block'   =>  true,
			]
		);
		
		$this->add_control(
			'ap_memeber_bio_enable',
            [
                'label'         => __('Bio Enable', 'addon-pack'),
                'type'          => Controls_Manager::SWITCHER,
				'description'   => __('Enable or disable short bio','addon-pack'),
				'default'       =>  'no',
            ]
        );

        $this->add_control(
            'ap_member_bio',
            [
                'label' => __( 'Short Bio', 'addon-pack' ),
                'type' => Controls_Manager::TEXTAREA,
                'placeholder' => __( 'Write short bio about the team member', 'addon-pack' ),
                'rows' => 5,
                'dynamic' => [
                    'active' => true,
				],
				'condition'     => [
					'ap_memeber_bio_enable' => 'yes',
                ],
                'default'  =>  'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed accumsan sagittis nunc ac tempus.',
            ]
		);
        
        $this->add_responsive_control(
			'ap_member_align',
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
					'{{WRAPPER}} .ap-member'  => 'text-align: {{VALUE}};',
				],
				
			]
		);
		
        $this->end_controls_section();

		$this->start_controls_section(
            'ap_member_socials',
            [
                'label' => __( 'Social Profiles', 'addon-pack' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );		

        $this->add_control(
			'ap_socials_visibility',
			[	
				'label' => __( 'Show Social Profile?', 'addon-pack' ),
				'type'  => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'label_on' => __( 'Show', 'addon-pack' ),
				'label_off' => __( 'Hide', 'addon-pack' ),
			]
		);

        $this->add_control(
            'ap_social_profiles',
            [
                'show_label' => false,
                'type' => Controls_Manager::REPEATER,
                'fields' => [
                    [
						'name' => 'title',
						'label' => __( 'Title', 'addon-pack' ),
						'type' => Controls_Manager::TEXT,
                        'label_block' => true,
                        'dynamic' => [
							'active' => true,
						],
					],
					[
						'name' => 'link',
						'label' => __( 'Social Link', 'addon-pack' ),
						'type' => Controls_Manager::URL,
						'placeholder' => __( 'http://your-link.com', 'addon-pack' ),
						'dynamic' => [
							'active' => true,
						],
                    ],

					[
						'name' => 'icon',
						'label' => __( 'Social Icon', 'addon-pack' ),
						'type' => Controls_Manager::ICON,
						'label_block' => true,
                    ],
                    
				],
                'title_field' => '{{{ icon }}}',
                'default' => [
                    [
                        'link' => ['url' => 'https://facebook.com/'],
                        'name' => 'facebook',
                        'icon' => 'fa fa-facebook'
                    ],
                    [
                        'link' => ['url' => 'https://twitter.com/'],
                        'name' => 'twitter',
                        'icon' => 'fa fa-twitter'
                    ],
                    [
                        'link' => ['url' => 'https://linkedin.com/'],
                        'name' => 'linkedin',
                        'icon' => 'fa fa-linkedin'
                    ]
                ],
            ]
        );

        $this->end_controls_section();
		
	}
	
	protected function register_heading_style_controls(){

        $this->start_controls_section(
            'ap_member_style_photo',
            [
                'label' => __( 'Photo', 'addon-pack' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'ap_member_photo_width',
            [
                'label' => __( 'Width', 'addon-pack' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%'],
                'range' => [
                    '%' => [
                        'min' => 25,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 150,
                        'max' => 800,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .ap-image img' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'ap_member_photo_height',
            [
                'label' => __( 'Height', 'addon-pack' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 100,
                        'max' => 800,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .ap-image img' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'ap_member_photo_spacing',
            [
                'label' => __( 'Bottom Spacing', 'addon-pack' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .ap-image' => 'margin-bottom: {{SIZE}}{{UNIT}} !important;',
                ],
            ]
        );

        $this->add_responsive_control(
            'ap_member_photo_padding',
            [
                'label' => __( 'Padding', 'addon-pack' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .ap-image img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'ap_member_photo_border',
                'selector' => '{{WRAPPER}} .ap-image img'
            ]
        );

        $this->add_responsive_control(
            'ap_member_photo_border_radius',
            [
                'label' => __( 'Border Radius', 'addon-pack' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .ap-image img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'ap_member_photo_box_shadow',
                'exclude' => [
                    'box_shadow_position',
                ],
                'selector' => '{{WRAPPER}} .ap-image img'
            ]
        );

        $this->add_control(
            'ap_member_photo_bg_color',
            [
                'label' => __( 'Background Color', 'addon-pack' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ap-image img' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->start_controls_tabs('ap_member_photo_style');

		$this->start_controls_tab(
			'ap_member_tab_photo_normal',
			[
				'label' => __( 'Normal', 'addon-pack' ),
			]
        );

        $this->add_control(
			'ap_member_photo_opacity',
			[
				'label'   => __( 'Opacity (%)', 'addon-pack' ),
				'type'    => Controls_Manager::SLIDER,
				'default' => [
					'size' => 1,
				],
				'range' => [
					'px' => [
						'max'  => 1,
						'min'  => 0.10,
						'step' => 0.01,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .ap-image img' => 'opacity: {{SIZE}};',
				],
			]
        );
        
        $this->end_controls_tab();
        
        $this->start_controls_tab(
			'ap_member_tab_photo_hover',
			[
				'label' => __( 'Hover', 'addon-pack' ),
			]
        );
        
        $this->add_control(
			'ap_member_photo_hover_opacity',
			[
				'label'   => __( 'Opacity (%)', 'addon-pack' ),
				'type'    => Controls_Manager::SLIDER,
				'default' => [
					'size' => 1,
				],
				'range' => [
					'px' => [
						'max'  => 1,
						'min'  => 0.10,
						'step' => 0.01,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .ap-image:hover img' => 'opacity: {{SIZE}};',
				],
			]
        );
        
        $this->add_control(
			'ap_member_photo_hover_animation',
			[
				'label'   => __( 'Animation', 'addon-pack' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					''     => 'None',
					'in'   => 'Zoom In',
					'out'  => 'Zoom Out',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

        $this->end_controls_section();
		
		$this->start_controls_section(
            'ap_member_content_style',
            [
                'label' => __( 'Content', 'addon-pack' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'ap_member_content_padding',
            [
                'label' => __( 'Content Padding', 'addon-pack' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .ap-member-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'ap_member_title_heading',
            [
                'type' => Controls_Manager::HEADING,
                'label' => __( 'Name', 'addon-pack' ),
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'ap_member_title_spacing',
            [
                'label' => __( 'Bottom Spacing', 'addon-pack' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .ap-name' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'ap_member_title_color',
            [
                'label' => __( 'Text Color', 'addon-pack' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ap-name' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'ap_member_title_typography',
                'selector' => '{{WRAPPER}} .ap-name',
                'scheme' => Scheme_Typography::TYPOGRAPHY_2,
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'ap_member_title_text_shadow',
                'selector' => '{{WRAPPER}} .ap-name',
            ]
        );

        $this->add_control(
            'ap_member_job_title_heading',
            [
                'type' => Controls_Manager::HEADING,
                'label' => __( 'Job Title', 'addon-pack' ),
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'ap_member_job_title_spacing',
            [
                'label' => __( 'Bottom Spacing', 'addon-pack' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .ap-job-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'ap_member_job_title_color',
            [
                'label' => __( 'Text Color', 'addon-pack' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ap-job-title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'ap_member_job_title_typography',
                'selector' => '{{WRAPPER}} .ap-job-title',
                'scheme' => Scheme_Typography::TYPOGRAPHY_3,
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'ap_member_job_title_text_shadow',
                'selector' => '{{WRAPPER}} .ap-job-title',
            ]
        );

        $this->add_control(
            'ap_member_bio_heading',
            [
                'type' => Controls_Manager::HEADING,
                'label' => __( 'Bio', 'addon-pack' ),
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'ap_member_bio_spacing',
            [
                'label' => __( 'Bottom Spacing', 'addon-pack' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .ap-bio' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'ap_member_bio_color',
            [
                'label' => __( 'Text Color', 'addon-pack' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ap-bio' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'ap_member_bio_typography',
                'selector' => '{{WRAPPER}} .ap-bio',
                'scheme' => Scheme_Typography::TYPOGRAPHY_3,
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'ap_member_bio_text_shadow',
                'selector' => '{{WRAPPER}} .ap-bio',
            ]
        );
		
        $this->end_controls_section();

        $this->start_controls_section(
            'ap_member_social_style',
            [
                'label' => __( 'Social Icons', 'addon-pack' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
			'ap_member_icons_background',
			[
				'label'     => __( 'Background', 'addon-pack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ap-social' => 'background-color: {{VALUE}}',
				],
			]
		);

        $this->add_responsive_control(
			'ap_member_socials_padding',
			[
				'label'      => __( 'Padding', 'addon-pack' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .ap-social' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->add_responsive_control(
            'ap_member_social_spacing',
            [
                'label' => __( 'Right Spacing', 'addon-pack' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .ap-social li > a' => 'margin-right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'ap_member_social_icon_size',
            [
                'label' => __( 'Icon Size', 'addon-pack' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .ap-social li > a' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'ap_member_social_links_padding',
            [
                'label' => __( 'Icon Padding', 'addon-pack' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .ap-social li > a' => 'padding: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'ap_member_social_link_border',
                'selector' => '{{WRAPPER}} .ap-social li > a'
            ]
        );

        $this->add_responsive_control(
            'ap_member_social_link_border_radius',
            [
                'label' => __( 'Border Radius', 'addon-pack' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .ap-social li > a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs( 'ap_member_social_links_colors_tab' );
        $this->start_controls_tab(
            'ap_member_social_links_normal_tab',
            [
                'label' => __( 'Normal', 'addon-pack' ),
            ]
        );

        $this->add_control(
            'ap_member_social_links_color',
            [
                'label' => __( 'Icon Color', 'addon-pack' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ap-social li a i' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'ap_member_social_links_bg_color',
            [
                'label' => __( 'Background Color', 'addon-pack' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ap-social li a' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->start_controls_tab(
            'ap_member_social_links_hover_tab',
            [
                'label' => __( 'Hover', 'addon-pack' ),
            ]
        );

        $this->add_control(
            'ap_member_social_links_hover_color',
            [
                'label' => __( 'Icon Color', 'addon-pack' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ap-social li a:hover i, {{WRAPPER}} .ap-social li a:focus i' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'ap_member_social_links_hover_bg_color',
            [
                'label' => __( 'Background Color', 'addon-pack' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ap-social li a:hover, {{WRAPPER}} .ap-social li a:focus' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'ap_member_social_links_hover_border_color',
            [
                'label' => __( 'Border Color', 'addon-pack' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ap-social li > a:hover, {{WRAPPER}} .ap-social li > a:focus' => 'border-color: {{VALUE}};',
                ],
                'condition' => [
                    'ap_member_social_link_border!' => '',
                ]
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

    protected function mamber_content(){

        $settings = $this->get_settings_for_display();

        $this->add_inline_editing_attributes( 'ap_member_name', 'basic' );
        $this->add_render_attribute( 'ap_member_name', 'class', 'ap-name' );

        $this->add_inline_editing_attributes( 'ap_member_job_title', 'basic' );
        $this->add_render_attribute( 'ap_member_job_title', 'class', 'ap-job-title' );

        $this->add_inline_editing_attributes( 'ap_member_bio', 'basic' );
        $this->add_render_attribute( 'ap_member_bio', 'class', 'ap-bio' );

        $ap_member_name_tag = $settings['ap_member_name_tag'];
        $ap_memeber_title_tag = $settings['ap_member_title_tag'];
		$ap_member_name = '<' . $ap_member_name_tag. ' class="ap-name" >'. $settings['ap_member_name'] . '</' . $ap_member_name_tag . '> ';
		$ap_member_title = '<' . $ap_memeber_title_tag. ' class="ap-job-title" >'. $settings['ap_member_job_title'] . '</' . $ap_memeber_title_tag . '> ';
        
         echo $ap_member_name; 
         echo $ap_member_title; 
        ?>
        <span class="ap-bio"><?php echo $settings['ap_member_bio']; ?></span>

    <?php
    }

    protected function member_image(){ 
		$settings = $this->get_settings();
		if ( ! empty( $settings['ap_member_image']['url'] ) ) : ?>
		    <?php echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'thumbnail', 'ap_member_image' ); ?>
		<?php endif; 
	}

	protected function render() {
        $settings = $this->get_settings_for_display();
        $photo_hover_animation = ( '' != $settings['ap_member_photo_hover_animation'] ) ? ' ap-member-image-transition-zoom-'.$settings['ap_member_photo_hover_animation'] : ''; 

        $this->add_render_attribute( 'ap_image', 'class', 'ap-image' );
        $this->add_render_attribute( 'ap_image', 'class', $photo_hover_animation );

        ?>

        <?php if('design-one' == $settings['ap_member_design_style']) { ?>
			
            <div class="ap-member"> 
    
                    <div class="ap-member-design-1">
                
                        <div <?php echo $this->get_render_attribute_string( 'ap_image' ); ?>>
                            <?php $this->member_image(); ?>

                            <?php if( (!empty($settings['ap_social_profiles']) && is_array($settings['ap_social_profiles']) ) && !empty($settings['ap_socials_visibility'])) : ?>
                                <ul class="ap-social">
                                    <?php 
                                    foreach ( $settings['ap_social_profiles'] as $link ) : 
                                        $target = ($link['link']['is_external']) ? 'target="_blank"' : 'target="self"';
                                    ?>
                                        <li>
                                            <a href="<?php echo esc_url($link['link']['url']); ?>" <?php echo esc_attr($target); ?> class="elementor-repeater-item-<?php echo $link['_id']; ?>">
                                                <i class="<?php echo esc_html( $link['icon'] ); ?>"></i>
                                            </a>
                                        </li>

                                    <?php endforeach; ?>
                                    
                                </ul>
                            <?php endif; ?>

                        </div>

                        <div class="ap-member-content">
                            <?php $this->mamber_content(); ?>
                        </div>
        
                    </div>
                    
            </div>
        
        <?php 
    
        }elseif('design-two' == $settings['ap_member_design_style']){ ?>

        <div class="ap-member"> 
            
            <div class="ap-member-design-2">

                <div <?php echo $this->get_render_attribute_string( 'ap_image' ); ?>>
                    <?php $this->member_image(); ?>
                </div>
                <div class="ap-member-content">
                    <?php $this->mamber_content(); ?>

                    <?php if( (!empty($settings['ap_social_profiles']) && is_array($settings['ap_social_profiles']) ) && !empty($settings['ap_socials_visibility'])) : ?>
                        <ul class="ap-social">
                            <?php 
                            foreach ( $settings['ap_social_profiles'] as $link ) : 
                                $target = ($link['link']['is_external']) ? 'target="_blank"' : 'target="self"';
                            ?>
                                <li>
                                    <a href="<?php echo esc_url($link['link']['url']); ?>" <?php echo esc_attr($target); ?> class="elementor-repeater-item-<?php echo $link['_id']; ?>">
                                        <i class="<?php echo esc_html( $link['icon'] ); ?>"></i>
                                    </a>
                                </li>

                            <?php endforeach; ?>
                            
                        </ul>
                    <?php endif; ?>
                
                </div>

            </div>
            
        </div>
    
    <?php
       }
    }
	protected function _content_template() {

	}
	
}