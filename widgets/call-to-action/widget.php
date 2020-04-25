<?php
namespace AddonPack\Elementor\Widget;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;


if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Call_to_Action extends Widget_Base {

	public function get_name() {
		return 'ap-cta';
	}

	public function get_title() {
		return __( 'Call to Action', 'addon-pack' );
	}

	public function get_icon() {
		return 'eicon-call-to-action';
	}

	public function get_categories() {
		return array('addon-pack');
	}
	
	protected function _register_controls() {
		$this->register_general_controls();
		$this->register_title_style_controls();
	}
	
	protected function register_general_controls(){
		$this->start_controls_section(
			'ap_cta_settings',
			[
				'label' => __( 'Call to Action Settings', 'addon-pack' ),
			]
        );
        
        $this->add_control(
			'ap_cta_title',
			[
				'label' => __( 'Title', 'addon-pack' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => __('The Creative Addons for Elementor', 'addon-pack'),
				'placeholder' => __( 'Enter your title', 'addon-pack' ),
				'dynamic' => [
					'active' => true,
				],
			]
		);
		$this->add_control(
			'ap_cta_content',
			[
				'label' => __( 'Content', 'addon-pack' ),
				'type' => Controls_Manager::WYSIWYG,
				'default' => __('Enter a good one liner that supports the above heading and gives users a reason to click the button below.', 'addon-pack'),
				'placeholder' => __( 'Enter your content', 'addon-pack' ),
				'dynamic' => [
					'active' => true,
				],
			]
		);

		$this->add_control(
			'ap_cta_button_text',
			[
				'label' => __( 'Button Text', 'addon-pack' ),
				'type' => Controls_Manager::TEXT,
				'default' => __('Contact Us', 'addon-pack'),
				'placeholder' => __( 'Enter your button text', 'addon-pack' ),
				'dynamic' => [
					'active' => true,
				],
				'label_block' => true,
			]
		);
		
		$this->add_control(
            'ap_cta_button_icon_active',
            [
                'label' => __('Button Icon', 'addon-pack'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'addon-pack'),
                'label_off' => __('Hide', 'addon-pack'),
                'return_value' => 'yes',
				'default' => 'yes',
				'separator'   => 'before',
            ]
        );
        
        $this->add_control(
			'ap_cta_button_icon',
			[
				'label'       => esc_html__( 'Icon', 'addon-pack' ),
				'type'        => Controls_Manager::ICON,
				'label_block' => true,
				'condition' => [
                    'ap_cta_button_icon_active!' => '',
                ],
			]
		);

		$this->add_control(
			'ap_cta_button_icon_spacing',
			[
				'label' => esc_html__( 'Icon Spacing', 'addon-pack' ),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 50,
					],
				],
					'default' => [
						'size' => 8,
					],
				'condition' => [
					'ap_cta_button_icon_active!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .ap-cta-button .ap-cta-button-icon-right'  => 'margin-left: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'ap_cta_button_url',
			[
				'label' => __( 'Button Link', 'addon-pack' ),
				'type' => Controls_Manager::URL,
				'default' => [
                    'url' => '#',
                    'is_external' => 'true',
                ],
				'placeholder' => __( 'http://your-link.com', 'addon-pack' ),
				'dynamic' => [
					'active' => true,
				],
			]
		);

		
		$this->add_responsive_control(
			'ap_cta_align',
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
					'justify' => [
						'title' => __( 'Justified', 'addon-pack' ),
						'icon' => 'fa fa-align-justify',
					],
				],
				'default' => 'center',
				'selectors' => [
					'{{WRAPPER}} .ap-cta-wrapper' => 'text-align: {{VALUE}};',
				],
			]
		);
	
		
		$this->end_controls_section();
	}

	
	protected function register_title_style_controls(){
		$this->start_controls_section(
			'ap_cta_general_style',
			[
				'label' => __( 'General Style', 'addon-pack' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'ap_cta_bg',
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .ap-cta-wrapper',
			]
		);

		$this->add_control(
			'ap_cta_border_style',
			[
				'label'   => esc_html__( 'Border Style', 'addon-pack' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'none',
				'options' => [
					'none'   => esc_html__( 'None', 'addon-pack' ),
					'solid'  => esc_html__( 'Solid', 'addon-pack' ),
					'dotted' => esc_html__( 'Dotted', 'addon-pack' ),
					'dashed' => esc_html__( 'Dashed', 'addon-pack' ),
					'groove' => esc_html__( 'Groove', 'addon-pack' ),
				],
				'selectors'  => [
					'{{WRAPPER}} .ap-cta-wrapper' => 'border-style: {{VALUE}};',
				],
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'ap_cta_border_size',
			[
				'label' => esc_html__( 'Border Size', 'addon-pack' ),
				'type'  => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'default' => [
					'top'    => 3,
					'right'  => 3,
					'bottom' => 3,
					'left'   => 3,
				],
				'selectors'  => [
					'{{WRAPPER}} .ap-cta-wrapper' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'ap_cta_border_style!' => 'none'
				]
			]
		);

		$this->add_control(
			'ap_cta_border_color',
			[
				'label'     => esc_html__( 'Border Color', 'addon-pack' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#666',
				'selectors' => [
					'{{WRAPPER}} .ap-cta-wrapper' => 'border-color: {{VALUE}};',
				],
				'condition' => [
					'ap_cta_border_style!' => 'none'
				],
			]
		);

		$this->add_responsive_control(
			'ap_cta_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'addon-pack' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .ap-cta-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'ap_cta_shadow',
				'selector' => '{{WRAPPER}} .ap-cta-wrapper',
			]
		);

		$this->add_responsive_control(
            'ap_cta_padding',
            [
                'label' => esc_html__('Padding', 'addon-pack'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .ap-cta-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'ap_cta_margin',
            [
                'label' => esc_html__('Margin', 'addon-pack'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .ap-cta-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
		);

		$this->end_controls_section();
		
		$this->start_controls_section(
			'ap_cta_title_style',
			[
				'label' => __( 'Title Style', 'addon-pack' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'ap_cta_title_color',
			[
				'label'     => esc_html__( 'Title Color', 'addon-pack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ap-cta-title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'ap_cta_title_typography',
				'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .ap-cta-title',
			]
		);

		$this->add_responsive_control(
            'ap_cta_title_padding',
            [
                'label' => esc_html__('Padding', 'addon-pack'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .ap-cta-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
		);
		
        $this->add_responsive_control(
            'ap_cta_title_margin',
            [
                'label' => esc_html__('Margin', 'addon-pack'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .ap-cta-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'ap_cta_content_style',
			[
				'label' => __( 'Content Style', 'addon-pack' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'ap_cta_content_color',
			[
				'label'     => esc_html__( 'Content Color', 'addon-pack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ap-cta-content' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'ap_cta_content_typography',
				'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .ap-cta-content',
			]
		);

		$this->add_responsive_control(
            'ap_cta_content_padding',
            [
                'label' => esc_html__('Padding', 'addon-pack'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .ap-cta-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
		);
		
        $this->add_responsive_control(
            'ap_cta_content_margin',
            [
                'label' => esc_html__('Margin', 'addon-pack'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .ap-cta-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
		);
	
		$this->end_controls_section();

		$this->start_controls_section(
			'ap_cta_button_style',
			[
				'label' => __( 'Button Style', 'addon-pack' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'ap_cta_button_border_style',
			[
				'label'   => esc_html__( 'Border Style', 'addon-pack' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'none',
				'options' => [
					'none'   => esc_html__( 'None', 'addon-pack' ),
					'solid'  => esc_html__( 'Solid', 'addon-pack' ),
					'dotted' => esc_html__( 'Dotted', 'addon-pack' ),
					'dashed' => esc_html__( 'Dashed', 'addon-pack' ),
					'groove' => esc_html__( 'Groove', 'addon-pack' ),
				],
				'selectors'  => [
					'{{WRAPPER}} .ap-cta-button' => 'border-style: {{VALUE}};',
				],
				'label_block' => true,
			]
		);

		$this->add_responsive_control(
			'ap_cta_button_border_size',
			[
				'label' => esc_html__( 'Border Size', 'addon-pack' ),
				'type'  => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'default' => [
					'top'    => 3,
					'right'  => 3,
					'bottom' => 3,
					'left'   => 3,
				],
				'selectors'  => [
					'{{WRAPPER}} .ap-cta-button' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'ap_cta_border_style!' => ''
				],
				'separator' => 'after',
			]
		);

		$this->add_responsive_control(
            'ap_cta_button_padding',
            [
                'label' => esc_html__('Padding', 'addon-pack'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .ap-cta-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
		);
		
        $this->add_responsive_control(
            'ap_cta_button_margin',
            [
                'label' => esc_html__('Margin', 'addon-pack'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .ap-cta-button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
            ]
		);

		$this->start_controls_tabs( 'tabs_cta_button_style' );

		$this->start_controls_tab(
			'ap_tab_cta_button_normal',
			[
				'label' => esc_html__( 'Normal', 'addon-pack' ),
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'ap_cta_button_bg',
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .ap-cta-button',
			]
		);

		$this->add_control(
			'ap_cta_button_text_color',
			[
				'label'     => esc_html__( 'Text Color', 'addon-pack' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#4d4d4d',
				'selectors' => [
					'{{WRAPPER}} .ap-cta-button .ap-cta-button-text' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'ap_cta_button_icon_color',
			[
				'label'     => esc_html__( 'Icon Color', 'addon-pack' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#4d4d4d',
				'selectors' => [
					'{{WRAPPER}} .ap-cta-button .ap-cta-button-icon-right' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'ap_cta_button_border_color',
			[
				'label'     => esc_html__( 'Border Color', 'addon-pack' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#666',
				'selectors' => [
					'{{WRAPPER}} .ap-cta-button' => 'border-color: {{VALUE}};',
				],
				'condition' => [
					'ap_cta_button_border_style!' => 'none'
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'ap_tab_cta_button_hover',
			[
				'label' => esc_html__( 'Hover', 'addon-pack' ),
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'ap_cta_button_hover_background',
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .ap-cta-button:after, 
								{{WRAPPER}} .ap-cta-button:hover,',
			]
		);

		$this->add_control(
			'ap_cta_button_hover_text_color',
			[
				'label'     => esc_html__( 'Text Color', 'addon-pack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ap-cta-button:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'ap_cta_button_hover_icon_color',
			[
				'label'     => esc_html__( 'Icon Hover Color', 'addon-pack' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#4d4d4d',
				'selectors' => [
					'{{WRAPPER}} .ap-cta-button:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'ap_cta_button_border_hover_color',
			[
				'label'     => esc_html__( 'Border Color', 'addon-pack' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#666',
				'selectors' => [
					'{{WRAPPER}} .ap-cta-button:hover' => 'border-color: {{VALUE}};',
				],
				'condition' => [
					'ap_cta_button_border_style!' => 'none'
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
	protected function render() {

		$settings = $this->get_settings_for_display();

		$ap_cta_button_icon  = $settings['ap_cta_button_icon'];
		$ap_cta_content  = $settings['ap_cta_content'];

		$this->add_render_attribute( 'ap_cta_title', 'class', 'ap-cta-title' );
		$this->add_render_attribute( 'ap_cta_content', 'class', 'ap-cta-content' );

		$this->add_render_attribute( 'ap_cta_button', [
			'class'	=> 'ap-cta-button',
			'href'	=> esc_attr($settings['ap_cta_button_url']['url'] ),
		]);

		if( $settings['ap_cta_button_url']['is_external'] ) {
			$this->add_render_attribute( 'ap_cta_button', 'target', '_blank' );
		}
		
		if( $settings['ap_cta_button_url']['nofollow'] ) {
			$this->add_render_attribute( 'ap_cta_button', 'rel', 'nofollow' );
		}

	?>

	<div class="ap-cta-wrapper">

		<h3 <?php echo $this->get_render_attribute_string( 'ap_cta_title' ); ?>><?php echo $settings['ap_cta_title']; ?></h3>
		
		<?php if( !empty($ap_cta_content) ) { 
			$ap_cta_content = $this->parse_text_editor( $ap_cta_content );
		?>
		<div <?php echo $this->get_render_attribute_string( 'ap_cta_content' ); ?>><?php echo $ap_cta_content; ?></div>
		<?php } ?>
		<div class="d-flex align-items-center">
		
		<a <?php echo $this->get_render_attribute_string( 'ap_cta_button' ); ?>>
				<span class="ap-cta-button-text"><?php echo $settings['ap_cta_button_text']; ?></span>
				<?php if($ap_cta_button_icon): ?>
						<i class="<?php echo esc_attr($settings['ap_cta_button_icon'] ); ?> ap-cta-button-icon-right" aria-hidden="true"></i> 
				<?php endif; ?>
		</a>

		</div>
	</div>


<?php

	}

	protected function _content_template() {}
	
}