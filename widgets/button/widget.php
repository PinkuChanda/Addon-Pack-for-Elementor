<?php
namespace AddonPack\Elementor\Widget;

use \Elementor\Group_Control_Box_Shadow;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Typography;
use \Elementor\Scheme_Typography;


if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Button extends Widget_Base {

	public function get_name() {
		return 'ap-button';
	}

	public function get_title() {
		return __( 'Button', 'addon-pack' );
	}

	public function get_icon() {
		return 'eicon-button';
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
			'ap_button_settings',
			[
				'label' => __( 'Button Settings', 'addon-pack' ),
			]
		);

		$this->add_control(
			'ap_button_text',
			[
				'label' => __( 'Text', 'addon-pack' ),
				'type' => Controls_Manager::TEXT,
				'default' => __('Addon Pack', 'addon-pack'),
				'placeholder' => __( 'Enter Your Text', 'addon-pack' ),
				'label_block'   => true,
			]
		);

		$this->add_control(
			'ap_button_url',
			[
				'label'       => esc_html__( 'Link URL', 'addon-pack' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => esc_html__( 'Enter Your Vaild URL', 'addon-pack' ),
				'default'     => [
					'url' => '#',
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
			]
		);

		$this->add_control(
			'ap_button_icon',
			[
				'label'       => esc_html__( 'Icon', 'addon-pack' ),
				'type'        => Controls_Manager::ICON,
				'label_block' => true,
				'separator'   => 'before',
			]
		);

		$this->add_control(
			'ap_button_icon_align',
			[
				'label'   => esc_html__( 'Icon Alignment', 'addon-pack' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'left',
				'options' => [
					'left'   => esc_html__( 'Left', 'addon-pack' ),
					'right'  => esc_html__( 'Right', 'addon-pack' ),
					'none'   => esc_html__( 'None', 'addon-pack' ),
				],
				'condition' => [
					'ap_button_icon!' => '',
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
						'size' => 8,
					],
				'condition' => [
					'ap_button_icon!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .ap-button .ap-button-icon-right'  => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .ap-button .ap-button-icon-left'   => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'ap_button_align',
			[
				'label' => __( 'Alignment', 'addon-pack' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'flex-start' => [
						'title' => __( 'Left', 'addon-pack' ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'addon-pack' ),
						'icon' => 'fa fa-align-center',
					],
					'flex-end' => [
						'title' => __( 'Right', 'addon-pack' ),
						'icon' => 'fa fa-align-right',
					]
				],
				'default'       => 'center',
				'selectors' => [
					'{{WRAPPER}} .ap-button-wrapper' => 'justify-content: {{VALUE}};',
				],
			]
		);
		
		$this->end_controls_section();
	}

	
	protected function register_heading_style_controls(){
		
		$this->start_controls_section(
			'ap_button_style',
			[
				'label' => __( 'Button', 'addon-pack' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		
		$this->start_controls_tabs( 'tabs_button_style' );

		$this->start_controls_tab(
			'ap_tab_button_normal',
			[
				'label' => esc_html__( 'Normal', 'addon-pack' ),
			]
		);

		$this->add_control(
			'ap_button_text_color',
			[
				'label'     => esc_html__( 'Text Color', 'addon-pack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ap-button .ap-button-text' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'ap_button_bg',
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .ap-button',
			]
		);

		$this->add_control(
			'ap_button_border_style',
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
					'{{WRAPPER}} .ap-button' => 'border-style: {{VALUE}};',
				],
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'ap_button_border_size',
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
					'{{WRAPPER}} .ap-button' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'ap_button_border_style!' => 'none'
				]
			]
		);

		$this->add_control(
			'ap_button_border_color',
			[
				'label'     => esc_html__( 'Border Color', 'addon-pack' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#666',
				'selectors' => [
					'{{WRAPPER}} .ap-button' => 'border-color: {{VALUE}};',
				],
				'condition' => [
					'ap_button_border_style!' => 'none'
				],
				'separator' => 'after',
			]
		);

		$this->add_responsive_control(
			'ap_button_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'addon-pack' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .ap-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'ap_button_shadow',
				'selector' => '{{WRAPPER}} .ap-button',
			]
		);

		$this->add_responsive_control(
			'ap_button_padding',
			[
				'label'      => esc_html__( 'Padding', 'addon-pack' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .ap-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'ap_button_typography',
				'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .ap-button .ap-button-text',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'ap_tab_button_hover',
			[
				'label' => esc_html__( 'Hover', 'addon-pack' ),
			]
		);

		$this->add_control(
			'ap_button_hover_text_color',
			[
				'label'     => esc_html__( 'Text Color', 'addon-pack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ap-button:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'ap_button_hover_background',
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .ap-button:after, 
								{{WRAPPER}} .ap-button:hover,',
			]
		);

		$this->add_control(
			'ap_button_hover_border_style',
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
					'{{WRAPPER}} .ap-button:hover' => 'border-style: {{VALUE}};',
				],
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'ap_button_hover_border_size',
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
					'{{WRAPPER}} .ap-button:hover' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'button_hover_border_style!' => 'none'
				]
			]
		);

		$this->add_control(
			'ap_button_hover_border_color',
			[
				'label'     => esc_html__( 'Border Color', 'addon-pack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ap-button:hover' => 'border-color: {{VALUE}};',
				],
				'condition' => [
					'button_hover_border_style!' => 'none'
				]
			]
		);

		$this->add_responsive_control(
			'ap_button_hover_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'addon-pack' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .ap-button:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'ap_button_hover_shadow',
				'selector' => '{{WRAPPER}} .ap-button:hover',
			]
		);

		$this->add_control(
			'ap_hover_animation',
			[
				'label' => esc_html__( 'Hover Animation', 'addon-pack' ),
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
	protected function render() {

		$settings = $this->get_settings_for_display();
		$button_icon_alignment = $settings['ap_button_icon_align'];

		$this->add_render_attribute( 'ap_button', [
			'class'	=> 'ap-button',
			'href'	=> esc_attr($settings['ap_button_url']['url'] ),
		]);

		if( $settings['ap_button_url']['is_external'] ) {
			$this->add_render_attribute( 'ap_button', 'target', '_blank' );
		}
		
		if( $settings['ap_button_url']['nofollow'] ) {
			$this->add_render_attribute( 'ap_button', 'rel', 'nofollow' );
		}

		$this->add_render_attribute( 'ap_button', 'class', esc_attr($settings['ap_button_text'] ));
		$this->add_render_attribute( 'ap_button', 'class', 'ap-button-' . esc_attr($settings['ap_button_size']) );

		if ( $settings['ap_hover_animation'] ) {
			$this->add_render_attribute( 'ap_button', 'class', 'elementor-animation-' . $settings['ap_hover_animation'] );
		}

		?>

		<div class="ap-button-wrapper">

			<a <?php echo $this->get_render_attribute_string( 'ap_button' ); ?>>
				<div class="ap-button-main">

					<?php if($button_icon_alignment == 'left'): ?>
						<i class="<?php echo esc_attr($settings['ap_button_icon'] ); ?> ap-button-icon-left" aria-hidden="true"></i> 
						<span class="ap-button-text"><?php echo $settings['ap_button_text']; ?></span>
					<?php elseif($button_icon_alignment == 'right'): ?>
						<span class="ap-button-text"><?php echo $settings['ap_button_text']; ?></span>
						<i class="<?php echo esc_attr($settings['ap_button_icon'] ); ?> ap-button-icon-right" aria-hidden="true"></i> 
					<?php else: ?>	
						<span class="ap-button-text"><?php echo $settings['ap_button_text']; ?></span>
					<?php endif; ?>

				</div>
			</a>

		</div>

<?php
	}
	protected function _content_template() {

		
	}
	
}