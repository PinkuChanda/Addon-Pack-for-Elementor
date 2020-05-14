<?php
namespace AddonPack\Elementor\Widget;

use Elementor\Widget_Base;
use AddonPack\Includes;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Dual_Heading extends Widget_Base {

	protected $templateInstance;

    public function getPostsInstance(){
        return $this->templateInstance = Includes\AddonPack_Helper::getInstance();
    }

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
			'ap-heading-one',
			[
				'label' => __( 'Heading ( First Part )', 'addon-pack' ),
				'type' => Controls_Manager::TEXT,
				'default' => __('Addon Pack', 'addon-pack'),
				'placeholder' => __( 'Enter your First Heading', 'addon-pack' ),
				'label_block'   => true,
			]
		);

		$this->add_control(
			'ap-heading-two',
			[
				'label' => __( 'Heading ( Second Part )', 'addon-pack' ),
				'type' => Controls_Manager::TEXT,
				'default' => __('Dual Heading', 'addon-pack'),
				'placeholder' => __( 'Enter your Second Heading', 'addon-pack' ),
				'label_block'   => true,
			]
		);

		$this->add_control(
			'ap_dual_heading_url_enable',
            [
                'label'         => __('Heading URL', 'addon-pack'),
                'type'          => Controls_Manager::SWITCHER,
                'description'   => __('Enable or disable link','addon-pack'),
            ]
        );

		$this->add_control('ap_dual_heading_link_selection', 
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
					'ap_dual_heading_url_enable' => 'yes',
				]
			]
		);
	
		$this->add_control('ap_dual_heading_url',
			[
				'label'         => __('Link', 'addon-pack'),
				'type'          => Controls_Manager::URL,
				'dynamic'       => [ 'active' => true ],
				'default'       => [
					'url'   => '#',
				],
				'label_block'   => true,
				'condition'     => [
					'ap_dual_heading_url_enable'     => 'yes',
					'ap_dual_heading_link_selection' => 'custom_url'
				]
			]
		);
	
		$this->add_control('ap_dual_heading_existing_url',
			[
				'label'         => __('Existing Page', 'addon-pack'),
				'type'          => Controls_Manager::SELECT2,
				'options'       => $this->getPostsInstance()->get_all_posts(),
				'condition'     => [
					'ap_dual_heading_url_enable'         => 'yes',
					'ap_dual_heading_link_selection'       => 'existing_url',
				],
				'multiple'      => false,
				'label_block'   => true,
			]
		);

		$this->add_control(
			'ap_dual_heading_existing_url_target_blank',
            [
                'label'         => __('Open a new Tab', 'addon-pack'),
                'type'          => Controls_Manager::SWITCHER,
				'description'   => __('Enable or disable open with tab','addon-pack'),
				'condition'     => [
					'ap_dual_heading_link_selection'       => 'existing_url',
				],
            ]
        );

		$this->add_control(
			'ap_dual_heading_tag',
			[
				'label' => __( 'Heading HTML Tag', 'addon-pack' ),
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
				'default' => 'h3',
				'label_block'   =>  true,
			]
		);

		$this->add_control(
			'ap-sub-heading',
			[
				'label' => esc_html__( 'Sub Heading', 'addon-pack' ),
				'type' => Controls_Manager::TEXTAREA,
				'label_block' => true,
				'default' => esc_html__( 'Insert a meaningful sentence for determining headline', 'addon-pack'),
				'placeholder' => __( 'Enter your sub heading', 'addon-pack' ),
				'separator'     => 'before',
			]
		);

		$this->add_control(
			'ap_dual_sub_heading_tag',
			[
				'label' => __( 'Sub Heading HTML Tag', 'addon-pack' ),
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
				'default' => 'span',
				'label_block'   =>  true,
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
			'ap_dual_heading_general_style',
			[
				'label' => __( 'General', 'addon-pack' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'ap_dual_heading_bg_color',
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .ap-dual-heading',
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

		$this->end_controls_section();

		$this->start_controls_section(
			'ap_dual_heading_style',
			[
				'label' => __( 'Dual Heading', 'addon-pack' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'ap_first_heading_color',
			[
				'label' => esc_html__( 'First Heading Color', 'addon-pack' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#1abc9c',
				'selectors' => [
					'{{WRAPPER}} .ap-heading-one' => 'color: {{VALUE}};',
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
					'{{WRAPPER}} .ap-heading-two' => 'color: {{VALUE}};',
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
			'ap_dual_heading_style_type',
			[
				'label'   => __( 'Dual Heading Style', 'addon-pack' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'none'     => esc_html__('None', 'addon-pack'),
					'ap-line' => esc_html__('AP Line', 'addon-pack'),
				],
				'default' => 'none',
				'separator' => 'before',
				'label_block'   =>  true,
			]
		);

		$this->add_control(
			'ap_dual_heading_style_color',
			[
				'label'     => __( 'Color', 'addon-pack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ap-dual-heading-title .ap-line:after' => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'ap_dual_heading_style_type' => 'ap-line',
				],
			]
		);

		$this->add_responsive_control(
			'ap_dual_heading_style_width',
			[
				'label' => __( 'Width', 'addon-pack' ),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min'  => 1,
						'max'  => 220,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .ap-dual-heading-title .ap-line:after' => 'width: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'ap_dual_heading_style_type' => 'ap-line',
				],
			]
		);

		$this->add_responsive_control(
			'ap_dual_heading_style_height',
			[
				'label' => __( 'Height', 'addon-pack' ),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min'  => 1,
						'max'  => 32,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .ap-dual-heading-title .ap-line:after' => 'height: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'ap_dual_heading_style_type' => 'ap-line',
				],
			]
		);

		$this->add_control(
			'ap_dual_heading_style_align',
			[
				'label'   => __( 'Style Position', 'addon-pack' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'bottom',
				'options' => [
					'left'       => __( 'Before', 'addon-pack' ),
					'right'      => __( 'After', 'addon-pack' ),
					'left-right' => __( 'After and Before', 'addon-pack' ),
					'bottom'     => __( 'Bottom', 'addon-pack' ),
				],
				'condition' => [
					'ap_dual_heading_style_type' => 'ap-line',
				],
			]
		);

		$this->add_responsive_control(
			'ap_dual_heading_style_indent',
			[
				'label'   => __( 'Style Spacing', 'addon-pack' ),
				'type'    => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 65,
					],
				],
				'default' => [
					'size' => 5,
				],
				'selectors' => [
					'{{WRAPPER}} .ap-dual-heading-title .ap-line-align-left'    => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .ap-dual-heading-title .ap-line-align-right'   => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .ap-dual-heading-title .ap-line-align-bottom' => 'margin-top: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'ap_dual_heading_style_type' => 'ap-line',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'ap_sub_heading_style',
			[
				'label' => __( 'Sub Heading', 'addon-pack' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'ap-sub-heading_color',
			[
				'label' => esc_html__( 'Text Color', 'addon-pack' ),
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
            'name' => 'ap-sub-heading_typography',
				'selector' => '{{WRAPPER}} .ap-sub-heading',
			]
		);

		$this->add_control(
			'ap_sub_heading_style_type',
			[
				'label'   => __( 'Sub Heading', 'addon-pack' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'none'     => esc_html__('None', 'addon-pack'),
					'ap-line' => esc_html__('AP Line', 'addon-pack'),
				],
				'default' => 'none',
				'separator' => 'before',
				'label_block'   =>  true,
			]
		);

		$this->add_control(
			'ap_sub_heading_style_color',
			[
				'label'     => __( 'Color', 'addon-pack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ap-sub-heading-dual .ap-line:after' => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'ap_sub_heading_style_type' => 'ap-line',
				],
			]
		);

		$this->add_responsive_control(
			'ap_sub_heading_style_width',
			[
				'label' => __( 'Width', 'addon-pack' ),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min'  => 1,
						'max'  => 220,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .ap-sub-heading-dual .ap-line:after' => 'width: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'ap_sub_heading_style_type' => 'ap-line',
				],
			]
		);

		$this->add_responsive_control(
			'ap_sub_heading_style_height',
			[
				'label' => __( 'Height', 'addon-pack' ),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min'  => 1,
						'max'  => 32,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .ap-sub-heading-dual .ap-line:after' => 'height: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'ap_sub_heading_style_type' => 'ap-line',
				],
			]
		);

		$this->add_control(
			'ap_sub_heading_style_align',
			[
				'label'   => __( 'Style Position', 'addon-pack' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'bottom',
				'options' => [
					'left'       => __( 'Before', 'addon-pack' ),
					'right'      => __( 'After', 'addon-pack' ),
					'left-right' => __( 'After and Before', 'addon-pack' ),
					'bottom'     => __( 'Bottom', 'addon-pack' ),
				],
				'condition' => [
					'ap_sub_heading_style_type' => 'ap-line',
				],
			]
		);

		$this->add_responsive_control(
			'ap_sub_heading_style_indent',
			[
				'label'   => __( 'Style Spacing', 'addon-pack' ),
				'type'    => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 65,
					],
				],
				'default' => [
					'size' => 5,
				],
				'selectors' => [
					'{{WRAPPER}} .ap-sub-heading-dual .ap-line-align-left'    => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .ap-sub-heading-dual .ap-line-align-right'   => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .ap-sub-heading-dual .ap-line-align-bottom'  => 'margin-top: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'ap_sub_heading_style_type' => 'ap-line',
				],
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

		$this->add_render_attribute( 'ap-heading-one', 'class', 'ap-heading-one' );
		$this->add_inline_editing_attributes( 'ap-heading-one', 'advanced' );

		$this->add_render_attribute( 'ap-heading-two', 'class', 'ap-heading-two' );
		$this->add_inline_editing_attributes( 'ap-heading-two', 'advanced' );

		$this->add_render_attribute( 'ap_dual_heading_existing_url_target_blank', 'target', '_blank' );

        $ap_first_heading  = $settings['ap-heading-one'] . ' ';
        $ap_second_heading = $settings['ap-heading-two'];

		$ap_dual_heading_tag = $settings['ap_dual_heading_tag'];
		$ap_dual_sub_heading_tag = $settings['ap_dual_sub_heading_tag'];

		$heading_style = '';

		if ('ap-line' === $settings['ap_dual_heading_style_type']) {
			if ('left-right' === $settings['ap_dual_heading_style_align']) {
				$heading_style = '<div class="ap-line ap-line-align-left"></div><div class="ap-line ap-line-align-right"></div>';
			} elseif ('bottom' === $settings['ap_dual_heading_style_align']) {
				$heading_style = '<div class="ap-line ap-line-align-'.$settings['ap_dual_heading_style_align'].'"></div>';
			} else {
				$heading_style = '<div class="ap-line ap-line-align-'.$settings['ap_dual_heading_style_align'].'"></div>';
			}
		}

		$main_heading = '<' . $ap_dual_heading_tag . ' class="ap-dual-heading-title"><span class="ap-heading-one">'. $ap_first_heading . '</span><span class="ap-heading-two">'. $ap_second_heading . '</span> '.$heading_style.'</' . $ap_dual_heading_tag . '> ';

		$sub_heading_style = '';

		if ('ap-line' === $settings['ap_sub_heading_style_type']) {
			if ('left-right' === $settings['ap_sub_heading_style_align']) {
				$sub_heading_style = '<div class="ap-line ap-line-align-left"></div><div class="ap-line ap-line-align-right"></div>';
			} elseif ('bottom' === $settings['ap_sub_heading_style_align']) {
				$sub_heading_style = '<div class="ap-line ap-line-align-'.$settings['ap_sub_heading_style_align'].'"></div>';
			} else {
				$sub_heading_style = '<div class="ap-line ap-line-align-'.$settings['ap_sub_heading_style_align'].'"></div>';
			}
		}

		$sub_heading = '<' . $ap_dual_sub_heading_tag . ' class="ap-sub-heading-main"><span class="ap-sub-heading-dual">'. $settings['ap-sub-heading'] . $sub_heading_style. '</span></' . $ap_dual_sub_heading_tag . '> ';

		$heading_link = '';
        if( $settings['ap_dual_heading_url_enable'] == 'yes' && $settings['ap_dual_heading_link_selection'] == 'existing_url' ) {
            $heading_link = get_permalink( $settings['ap_dual_heading_existing_url'] );
        } elseif( $settings['ap_dual_heading_url_enable'] == 'yes' && $settings['ap_dual_heading_link_selection'] == 'custom_url' ) {
            $heading_link = $settings['ap_dual_heading_url']['url'];
        }

		?>

		<div class="ap-dual-heading">

			<?php if( ! empty( $heading_link ) ) : ?>
				<a href="<?php echo esc_attr( $heading_link ); ?>" <?php if($settings['ap_dual_heading_existing_url_target_blank'] == 'yes'): echo $this->get_render_attribute_string( 'ap_dual_heading_existing_url_target_blank' ); endif; ?> <?php if( ! empty( $settings['ap_dual_heading_url']['is_external'] ) ) : ?> <?php endif; ?><?php if( ! empty( $settings['ap_dual_heading_url']['nofollow'] ) ) : ?> rel="nofollow" <?php endif; ?>>
			<?php endif; ?>
			
				<?php echo $main_heading; ?>

			<?php if( ! empty( $heading_link ) ) : ?>
				</a>
			<?php endif; ?>

			<?php if ( !empty( $settings['ap-sub-heading'] ) ) : ?>
				<?php echo $sub_heading; ?>
			<?php endif; ?>

		</div>

		<?php
		
	}

	protected function _content_template() {}
}
