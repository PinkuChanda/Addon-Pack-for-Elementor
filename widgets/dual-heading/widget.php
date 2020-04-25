<?php
namespace AddonPack\Elementor\Widget;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Typography;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Dual_Heading extends Widget_Base {

	public function get_name() {
		return 'addon-pack-heading';
	}

	public function get_title() {
		return __( 'Dual Heading', 'addon-pack' );
	}

	public function get_icon() {
		return 'eicon-heading';
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
			'ap_dual_heading_settings',
			[
				'label' => __( 'Dual Heading Settings', 'addon-pack' ),
			]
		);

		$this->add_control(
			'ap_heading_one',
			[
				'label' => __( 'Heading ( First Part )', 'addon-pack' ),
				'type' => Controls_Manager::TEXT,
				'default' => __('Addon Pack', 'addon-pack'),
				'placeholder' => __( 'Enter your First Heading', 'addon-pack' ),
				'label_block'   => true,
			]
		);

		$this->add_control(
			'ap_heading_two',
			[
				'label' => __( 'Heading ( Second Part )', 'addon-pack' ),
				'type' => Controls_Manager::TEXT,
				'default' => __('Dual Heading', 'addon-pack'),
				'placeholder' => __( 'Enter your Second Heading', 'addon-pack' ),
				'label_block'   => true,
			]
		);

		$this->add_control(
			'ap_sub_heading',
			[
				'label' => esc_html__( 'Sub Heading', 'addon-pack' ),
				'type' => Controls_Manager::TEXTAREA,
				'label_block' => true,
				'default' => esc_html__( 'Insert a meaningful sentence for determining headline', 'addon-pack'),
				'placeholder' => __( 'Enter your sub heading', 'addon-pack' ),
			]
		);

		$this->add_responsive_control(
			'ap_align',
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
				'default'       => 'center',
				'selectors' => [
					'{{WRAPPER}} .ap-dual-heading' => 'text-align: {{VALUE}};',
				],
			]
		);
		
		$this->end_controls_section();
	}

	
	protected function register_heading_style_controls(){
		$this->start_controls_section(
			'ap_dual_heading_style',
			[
				'label' => __( 'Dual Heading', 'addon-pack' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'ap_dual_heading_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'addon-pack' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .ap-dual-heading' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'ap_dual_heading_padding',
			[
				'label' => __('Padding', 'addon-pack'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default' => [],
				'selectors' => [
					'{{WRAPPER}} .ap-dual-heading-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'ap_dual_heading_margin',
			[
				'label' => __('Margin', 'addon-pack'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default' => [],
				'selectors' => [
					'{{WRAPPER}} .ap-dual-heading-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'ap_dual_heading_border',
				'label' => esc_html__( 'Border', 'addon-pack' ),
				'selector' => '{{WRAPPER}} .ap-dual-heading-title',
			]
		);

		$this->add_control(
			'ap_dual_heading_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'addon-pack' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 500,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .ap-dual-heading-title' => 'border-radius: {{SIZE}}px;',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name'     => 'ap_dual_heading_shadow',
				'selector' => '{{WRAPPER}} .ap-dual-heading-title',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'ap_dual_heading_box_shadow',
				'selector' => '{{WRAPPER}} .ap-dual-heading-title',
			]
		);

		$this->add_control(
			'ap_blend_mode',
			[
				'label' => __( 'Blend Mode', 'addon-pack' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'' => __( 'Normal', 'addon-pack' ),
					'multiply' => 'Multiply',
					'screen' => 'Screen',
					'overlay' => 'Overlay',
					'darken' => 'Darken',
					'lighten' => 'Lighten',
					'color-dodge' => 'Color Dodge',
					'saturation' => 'Saturation',
					'color' => 'Color',
					'difference' => 'Difference',
					'exclusion' => 'Exclusion',
					'hue' => 'Hue',
					'luminosity' => 'Luminosity',
				],
				'selectors' => [
					'{{WRAPPER}} .ap-dual-heading-title' => 'mix-blend-mode: {{VALUE}}',
				],
				'separator' => 'none',
			]
		);


		$this->end_controls_section();

		$this->start_controls_section(
			'ap_color_and_typegraphy_style',
			[
				'label' => __( 'Color & Typography', 'addon-pack' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'ap_dual_heading',
			[
				'label' => esc_html__( 'Heading', 'addon-pack' ),
				'type' => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'ap_first_heading_color',
			[
				'label' => esc_html__( 'First Heading Color', 'addon-pack' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#1abc9c',
				'selectors' => [
					'{{WRAPPER}} .ap_heading_one' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'ap_second_heading_color',
			[
				'label' => esc_html__( 'Second Heading Color', 'addon-pack' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#4d4d4d',
				'selectors' => [
					'{{WRAPPER}} .ap_heading_two' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
			'name' => 'ap_dual_heading_typography',
			'selector' => '.ap-dual-heading .ap-dual-heading-title, {{WRAPPER}}'
			]
		);

		$this->add_control(
			'ap_sub_heading',
			[
				'label' => esc_html__( 'Sub Heading ', 'addon-pack' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);

		$this->add_control(
			'ap_sub_heading_color',
			[
				'label' => esc_html__( 'Color', 'addon-pack' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#4d4d4d',
				'selectors' => [
					'{{WRAPPER}} .ap-sub-heading' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
            'name' => 'ap_sub_heading_typography',
				'selector' => '{{WRAPPER}} .ap-sub-heading',
			]
		);

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


		$this->get_settings( 'ap_heading_one' );
		$this->add_render_attribute( 'ap_heading_one', 'class', 'ap_heading_one' );
		$this->add_inline_editing_attributes( 'ap_heading_one' );

	    $this->get_settings( 'ap_heading_two' );
		$this->add_render_attribute( 'ap_heading_two', 'class', 'ap_heading_two' );
		$this->add_inline_editing_attributes( 'ap_heading_two' );


		if ( empty( $settings['ap_sub_heading'] ) ) {
			return;
		}

		?>

		<div class="ap-dual-heading">
			<div class="ap-dual-heading-title">
				<span <?php echo $this->get_render_attribute_string( 'ap_heading_one' ) ?>>
				<?php echo $settings['ap_heading_one']; ?>
				</span> 
				<span <?php echo $this->get_render_attribute_string( 'ap_heading_two' ) ?>>
				<?php echo $settings['ap_heading_two']; ?>
				</span>
			</div>
			
			<span class="ap-sub-heading">
				<?php echo $settings['ap_sub_heading']; ?>
			</span>

		</div>

		<?php
		
	}

	protected function _content_template() { ?>

		<#
			view.addRenderAttribute('ap_heading_one', 'class', 'title');
			view.addInlineEditingAttributes( 'ap_heading_one', 'basic' );

			view.addRenderAttribute('ap_heading_two', 'class', 'subtitle');
			view.addInlineEditingAttributes( 'ap_heading_two', 'basic' );
		#>

	<div class="ap-dual-heading">
		<div class="ap-dual-heading-title">
			<span {{{ view.getRenderAttributeString( 'ap_heading_one' ) }}}>
			{{ settings.ap_heading_one }}
			</span> 
			<span {{{ view.getRenderAttributeString( 'ap_heading_two' ) }}}>
			{{ settings.ap_heading_two }}
			</span>
		</div>
			<# if ( settings.ap_sub_heading ) { #>
			<span class="ap-sub-heading">
			{{ settings.ap_sub_heading }}
			</span>
			<# } #>
		</div>

		<?php
    }
}
