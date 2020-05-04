<?php
namespace AddonPack\Elementor\Widget;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Utils;
use \Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Background;
use \Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Scheme_Typography;


if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Testimonial extends Widget_Base {

	public function get_name() {
		return 'addon-pack-testimonial';
	}

	public function get_title() {
		return __( 'Testimonial', 'addon-pack' );
	}

	public function get_icon() {
		return 'eicon-testimonial';
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
			'ap_testimonial_layouts',
			[
				'label' => __( 'Layouts', 'addon-pack' ),
			]
        );
        
        $this->add_control(
            'ap_testimonial_style',
            [
               'label'       => __( 'Select Style', 'addon-pack'),
               'type' => Controls_Manager::SELECT,
               'default' => 'default-style',
               'options' => [
                   'default-style'  => __( 'Default', 'addon-pack'),
                   'classic-style'  => __( 'Classic', 'addon-pack'),
               ],
            ]
		);

		$this->end_controls_section();
		
		$this->start_controls_section(
			'ap_testimonial_settings',
			[
				'label' => __( 'Testimonial Settings', 'addon-pack' ),
			]
        );
        
        $this->add_control(
			'ap_testimonial_content',
			[
				'label' => esc_html__( 'Testimoial Content', 'addon-pack' ),
				'type' => Controls_Manager::TEXTAREA,
				'label_block' => true,
				'default' => esc_html__( 'Lorem ipsum dolor sit amet, consectetur elit, eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim.Minim veniam, quis nostrud ullamco laboris nisi .', 'addon-pack'),
			]
		);

        $this->add_control(
			'ap_testimonial_name',
			[
				'label' => __( 'Name', 'addon-pack' ),
				'type' => Controls_Manager::TEXT,
				'default' => __('Jhone Doe', 'addon-pack'),
				'label_block'   => true,
			]
		);

		$this->add_control(
			'ap_testimonial_designation',
			[
				'label' => __( 'Designation', 'addon-pack' ),
				'type' => Controls_Manager::TEXT,
				'default' => __('Manager of Addon Pack', 'addon-pack'),
				'label_block'   => true,
			]
		);
		
		$this->add_control(
			'ap_testimonial_company',
			[
				'label' => __( 'Company', 'addon-pack' ),
				'type' => Controls_Manager::TEXT,
				'default' => __('companyname.com', 'addon-pack'),
				'label_block'   => true,
			]
        );
        
        $this->add_control(
            'ap_testimonial_display_rating',
            [
                'label' => __('Rating', 'addon-pack'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'addon-pack'),
                'label_off' => __('Hide', 'addon-pack'),
                'return_value' => 'yes',
				'default' => 'yes',
            ]
        );
		  
		$this->add_control(
            'ap_testimonial_rating_number',
            [
                'label' => __( 'Ratting', 'addon-pack' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'unit' => 'px',
                    'size' => 3.5,
                ],
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 5,
                        'step' => .5,
                    ],
                ],
                'dynamic' => [
                    'active' => true,
				],
				'condition' => [
                  'ap_testimonial_display_rating' => 'yes',
              ],
            ]
        );
        
        
        $this->end_controls_section();

        $this->start_controls_section(
			'ap_testimonial_image_settings',
			[
				'label' => __( 'Image Settings', 'addon-pack' ),
			]
        );

        $this->add_control(
			'ap_testimonial_enable_avatar',
			[
				'label' => esc_html__( 'Enable Avatar?', 'addon-pack'),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
        );
        
        $this->add_control(
            'ap_testimonial_avatar_style',
            [
               'label'       => __( 'Avatar Style', 'addon-pack'),
               'type' => Controls_Manager::SELECT,
               'default' => 'circle',
               'options' => [
                   'circle'  => __( 'Circle', 'addon-pack'),
                   'square' => __( 'Square', 'addon-pack'),
               ],
              'condition' => [
                  'ap_testimonial_enable_avatar' => 'yes',
              ],
            ]
        );

		$this->add_control(
			'ap_testimonial_image',
			[
				'label' => __( 'Testimonial Avatar', 'addon-pack'),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'condition' => [
					'ap_testimonial_enable_avatar' => 'yes',
				],
			]
		);


		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name'		=> 'ap_testimonial_image',
				'default'	=> 'thumbnail',
				'condition' => [
					'ap_testimonial_image[url]!' => '',
					'ap_testimonial_enable_avatar' => 'yes',
				],
			]
        );

        $this->end_controls_section();
	
	}
	
	protected function register_heading_style_controls(){
        $this->start_controls_section(
			'ap_testimonial_general_style',
			[
				'label' => __( 'General Style', 'addon-pack' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
        );

        $this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'ap_testimonial_bg',
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .ap-testimonial-main-container',
			]
		);
		
		$this->add_control(
			'ap_testimonial_shape_default_color',
			[
				'label'     => esc_html__( 'Style Color', 'addon-pack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ap-testimonial-main-container::after' => 'border-top: 44px solid {{VALUE}} ;',
					'{{WRAPPER}} .ap-testimonial-default-style .ap-reviewer-content .ap-reviewer-content-details' => 'border-bottom: 1px solid {{VALUE}} ;',
					'{{WRAPPER}} .ap-testimonial-default-style .ap-reviewer-content .ap-reviewer-content-details::before' => 'background: {{VALUE}} ;',
					'{{WRAPPER}} .ap-testimonial-wrapper .ap-testimonial-main-container' => 'border-left: 3px solid {{VALUE}} ;',
				],
				'condition' => [
					'ap_testimonial_style' => 'default-style'
				]

			]
		);

		$this->add_control(
			'ap_testimonial_shape_classic_color',
			[
				'label'     => esc_html__( 'Style Color', 'addon-pack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ap-testimonial-main-container::after' => 'border-top: 44px solid {{VALUE}} ;',
					'{{WRAPPER}} .ap-testimonial-classic-style .ap-reviewer-content .ap-reviewer-content-details' => 'border-top: 1px solid {{VALUE}} ;',
					'{{WRAPPER}} .ap-testimonial-classic-style .ap-reviewer-content .ap-reviewer-content-details::before' => 'background: {{VALUE}} ;',
					'{{WRAPPER}} .ap-testimonial-wrapper .ap-testimonial-main-container' => 'border-left: 3px solid {{VALUE}} ;',
				],
				'condition' => [
					'ap_testimonial_style' => 'classic-style'
				]

			]
		);
        
        $this->add_control(
			'ap_testimonial_border_style',
			[
				'label'   => esc_html__( 'Border Style', 'addon-pack' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'solid',
				'options' => [
					'none'   => esc_html__( 'None', 'addon-pack' ),
					'solid'  => esc_html__( 'Solid', 'addon-pack' ),
					'dotted' => esc_html__( 'Dotted', 'addon-pack' ),
					'dashed' => esc_html__( 'Dashed', 'addon-pack' ),
					'groove' => esc_html__( 'Groove', 'addon-pack' ),
				],
				'selectors'  => [
					'{{WRAPPER}} .ap-testimonial-main-container' => 'border-style: {{VALUE}};',
				],
				'separator'  => 'before',
			]
		);

		$this->add_responsive_control(
			'ap_testimonial_border_size',
			[
				'label' => esc_html__( 'Border Size', 'addon-pack' ),
				'type'  => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'default' => [
					'top'    => 0,
					'right'  => 0,
					'bottom' => 0,
					'left'   => 3,
				],
				'selectors'  => [
					'{{WRAPPER}} .ap-testimonial-main-container' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'ap_testimonial_border_style!' => 'none'
				]
			]
		);

		$this->add_control(
			'ap_testimonial_border_color',
			[
				'label'     => esc_html__( 'Border Color', 'addon-pack' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#1abc9c',
				'selectors' => [
					'{{WRAPPER}} .ap-testimonial-main-container' => 'border-color: {{VALUE}};',
				],
				'condition' => [
					'ap_testimonial_border_style!' => 'none'
				],
			]
		);

		$this->add_responsive_control(
			'ap_testimonial_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'addon-pack' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'default' => [
					'top'    => 5,
					'right'  => 5,
					'bottom' => 5,
					'left'   => 5,
				],
				'selectors'  => [
					'{{WRAPPER}} .ap-testimonial-main-container' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'ap_testimonial_shadow',
				'selector' => '{{WRAPPER}} .ap-testimonial-main-container',
			]
		);

		$this->add_responsive_control(
            'ap_testimonial_padding',
            [
                'label' => esc_html__('Padding', 'addon-pack'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .ap-testimonial-main-container' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
		);
		
        $this->add_responsive_control(
            'ap_testimonial_margin',
            [
                'label' => esc_html__('Margin', 'addon-pack'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .ap-testimonial-main-container' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->end_controls_section();

        $this->start_controls_section(
			'ap_testimonial_image_style',
			[
				'label' => __( 'Image Style', 'addon-pack' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'ap_testimonial_image_border',
                'selector' => '{{WRAPPER}} .ap-reviewer-thumbnail',
            ]
		);

		$this->add_responsive_control(
            'ap_testimonial_image_border_radius',
            [
                'label' => __( 'Border Radius', 'addon-pack' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .ap-reviewer-thumbnail' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
		);

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'ap_testimonial_image_box_shadow',
                'selector' => '.ap-reviewer-thumbnail',
            ]
		);
		
		$this->end_controls_section();
        
        $this->start_controls_section(
			'ap_testimonial_content_style',
			[
				'label' => __( 'Content Style', 'addon-pack' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
        );

		$this->add_control(
            'ap_testimonial_content_color',
            [
                'label' => __( 'Text Color', 'addon-pack' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ap-reviewer-content-details' => 'color: {{VALUE}}',
                ],
            ]
		);

		$this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'ap_testimonial_content_typography',
                'label' => __( 'Typography', 'addon-pack' ),
				'selector' => '{{WRAPPER}} .ap-reviewer-content-details',
				'scheme' => Scheme_Typography::TYPOGRAPHY_3,
            ]
		);

		$this->add_responsive_control(
            'ap_testimonial_content_padding',
            [
                'label' => esc_html__('Padding', 'addon-pack'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .ap-reviewer-content-details' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
		);
		
        $this->add_responsive_control(
            'ap_testimonial_content_margin',
            [
                'label' => esc_html__('Margin', 'addon-pack'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .ap-reviewer-content-details' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

		$this->end_controls_section();
        
        $this->start_controls_section(
			'ap_testimonial_name_style',
			[
				'label' => __( 'Name Style', 'addon-pack' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		
		$this->add_control(
            'ap_testimonial_color_name',
            [
                'label' => __( 'Text Color', 'addon-pack' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ap-testimonial-name' => 'color: {{VALUE}}',
                ],
            ]
		);
	
		$this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'ap_testimonial_name_typography',
                'label' => __( 'Typography', 'addon-pack' ),
				'selector' => '{{WRAPPER}} .ap-testimonial-name',
				'scheme' => Scheme_Typography::TYPOGRAPHY_3,
            ]
		);

		$this->add_responsive_control(
            'ap_testimonial_name_padding',
            [
                'label' => esc_html__('Padding', 'addon-pack'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .ap-testimonial-name' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
		);
		
        $this->add_responsive_control(
            'ap_testimonial_name_margin',
            [
                'label' => esc_html__('Margin', 'addon-pack'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .ap-testimonial-name' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
        
        $this->start_controls_section(
			'ap_testimonial_designation_style',
			[
				'label' => __( 'Designation Style', 'addon-pack' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
            'ap_testimonial_designation_color',
            [
                'label' => __( 'Text Color', 'addon-pack' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ap-testimonial-designation' => 'color: {{VALUE}}',
                ],
            ]
		);

		$this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'ap_testimonial_designation_typography',
                'label' => __( 'Typography', 'addon-pack' ),
				'selector' => '{{WRAPPER}} .ap-testimonial-designation',
				'scheme' => Scheme_Typography::TYPOGRAPHY_3,
            ]
		);
		
		$this->add_responsive_control(
            'ap_testimonial_designation_padding',
            [
                'label' => esc_html__('Padding', 'addon-pack'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .ap-testimonial-designation' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
		);
		
        $this->add_responsive_control(
            'ap_testimonial_designation_margin',
            [
                'label' => esc_html__('Margin', 'addon-pack'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .ap-testimonial-designation' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
		);

		$this->end_controls_section();
        
        $this->start_controls_section(
			'ap_testimonial_company_style',
			[
				'label' => __( 'Company Style', 'addon-pack' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
            'ap_testimonial_company_color',
            [
                'label' => __( 'Text Color', 'addon-pack' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ap-testimonial-company' => 'color: {{VALUE}}',
                ],
            ]
		);

		$this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'ap_testimonial_company_typography',
                'label' => __( 'Typography', 'addon-pack' ),
				'selector' => '{{WRAPPER}} .ap-testimonial-company',
				'scheme' => Scheme_Typography::TYPOGRAPHY_4,
            ]
		);
		
		$this->add_responsive_control(
            'ap_testimonial_company_padding',
            [
                'label' => esc_html__('Padding', 'addon-pack'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .ap-testimonial-company' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
		);
		
        $this->add_responsive_control(
            'ap_testimonial_company_margin',
            [
                'label' => esc_html__('Margin', 'addon-pack'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .ap-testimonial-company' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
		);

		$this->end_controls_section();
		
		$this->start_controls_section(
			'ap_testimonial_rating_style',
			[
				'label' => __( 'Rating Style', 'addon-pack' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		
		$this->add_responsive_control(
            'ap_testimonial_ratting_size',
            [
                'label' => __( 'Size', 'addon-pack' ),
                'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'max' => 40,
					],
				],
				'default' => [
					'size' => 16,
				],
                'selectors' => [
                    '{{WRAPPER}} .ap-reviewer-rating li i' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'ap_testimonial_ratting_color',
            [
                'label' => __( 'Rating Color', 'addon-pack' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#ffd203',
                'selectors' => [
                    '{{WRAPPER}} .ap-reviewer-rating li i' => 'color: {{VALUE}};',
                ],
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

	protected function thumbnail_image(){ 
		$settings = $this->get_settings();
		if ( ! empty( $settings['ap_testimonial_image']['url'] ) && 'yes' == $settings['ap_testimonial_enable_avatar'] ) : ?>
			<div class="ap-reviewer-thumbnail <?php if('circle' == $settings['ap_testimonial_avatar_style']): ?> ap-testimonial-image-circle <?php endif; ?> ">
				<?php echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'thumbnail', 'ap_testimonial_image' ); ?>
			</div>
		<?php endif; 
	}

	 protected function reviewer_name_and_title(){
		$settings = $this->get_settings();
		$this->add_inline_editing_attributes( 'ap_testimonial_name', 'basic' );
		$this->add_render_attribute( 'ap_testimonial_name', 'class', 'ap-testimonial-name' );

		$this->add_inline_editing_attributes( 'ap_testimonial_designation', 'basic' );
		$this->add_render_attribute( 'ap_testimonial_designation', 'class', 'ap-testimonial-designation' );
		
		$this->add_inline_editing_attributes( 'ap_testimonial_company', 'basic' );
		$this->add_render_attribute( 'ap_testimonial_company', 'class', 'ap-testimonial-company' );
		
		?>

		<h4 <?php $this->print_render_attribute_string( 'ap_testimonial_name' ); ?>><?php echo $settings['ap_testimonial_name']; ?></h4>
		<h6 <?php $this->print_render_attribute_string( 'ap_testimonial_designation' ); ?>><?php echo $settings['ap_testimonial_designation']; ?> - <span <?php $this->print_render_attribute_string( 'ap_testimonial_company' ); ?>><?php echo $settings['ap_testimonial_company']; ?></span></h6>
	
	<?php

	 }

	protected function testimonial_content(){
		$settings = $this->get_settings();
		$this->add_inline_editing_attributes( 'ap_testimonial_content', 'basic' );
		$this->add_render_attribute( 'ap_testimonial_content', 'class', 'ap-reviewer-content-details' );
	?>

	<div class="ap-reviewer-content">
		<p <?php $this->print_render_attribute_string( 'ap_testimonial_content' ); ?>> 
			<span class="ap-quotation-icon">
				<i class="fa fa-quote-left"></i>
			</span> 
				<?php echo $settings['ap_testimonial_content'] ; ?>
			<span class="ap-quotation-icon">
				<i class="fa fa-quote-right"></i>
			</span> 
		</p>
	</div>

	<?php 	

	 }

	protected function rating(){

		$settings = $this->get_settings();

		$ratting = max( 0, $settings['ap_testimonial_rating_number']['size'] );
	?>

	<ul class="ap-reviewer-rating">
		<?php 
			for ( $i = 1; $i <= 5; ++$i ) :
				if ( $i <= $ratting ) {
					echo '<li><i class="fa fa-star" aria-hidden="true"></i></li>';
				} else {
					echo '<li><i class="fa fa-star-o" aria-hidden="true"></i></li>';
				}
			endfor;
		?>
	</ul>

	<?php 
		
	}
	
	protected function render() {

        $settings = $this->get_settings_for_display();
		$rating_enable = $settings['ap_testimonial_display_rating'];

		?>


        <div class="ap-testimonial-wrapper">
			<?php if('default-style' == $settings['ap_testimonial_style']) : ?>
				
				<div class="ap-testimonial-main-container">
					<div class="ap-testimonial-default-style">

						<div class="ap-reviewer-info">
							
							<?php $this->testimonial_content(); ?>

							<?php $this->reviewer_name_and_title(); ?>
					
							<?php 
								if ( $rating_enable == 'yes' ) :
							?>
							<?php $this->rating(); ?>
							<?php 
								endif;
							?>

						</div>

						<?php $this->thumbnail_image(); ?>
					</div>
				</div>

			<?php endif; ?>

			<?php if('classic-style' == $settings['ap_testimonial_style']) : ?>
				
				<div class="ap-testimonial-main-container">
					<div class="ap-testimonial-classic-style">

						<div class="ap-reviewer-info">
							
							<div class="ap-classic-reviewer-details">

								<div class="ap-classic-reviewer-info">

									<?php $this->reviewer_name_and_title(); ?>
					
									<?php 
										if ( $rating_enable == 'yes' ) :
									?>
									<?php $this->rating(); ?>
									<?php 
										endif;
									?>
								</div>

								<div class="ap-classic-reviewer-image">
									<?php $this->thumbnail_image(); ?>
								</div>

							</div>

							<?php $this->testimonial_content(); ?>
							
						</div>

					</div>
				</div>

			<?php endif; ?>
			
        </div>

<?php 
    
    }

	protected function _content_template() { }
    
}
