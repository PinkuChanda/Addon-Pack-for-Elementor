<?php
namespace AddonPack\Elementor\Widget;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use AddonPack\Includes;
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

class Pricing_table extends Widget_Base {

    protected $templateInstance;

    public function getPostsInstance(){
        return $this->templateInstance = Includes\AddonPack_Helper::getInstance();
    }

	public function get_name() {
		return 'ap-pricing-table';
	}

	public function get_title() {
		return __( 'Pricing Table', 'addon-pack' );
	}

	public function get_icon() {
		return 'eicon-price-table';
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
			'ap_pricing_layout',
			[
				'label' => __( 'Layouts', 'addon-pack' ),
			]
        );
        
        $this->add_control(
            'ap_pricing_design_style',
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
			'ap_pricing_header',
			[
				'label' => __( 'Header', 'addon-pack' ),
			]
		);

		$this->add_control(
			'ap_pricing_heading',
			[
				'label' => __( 'Title', 'addon-pack' ),
				'type' => Controls_Manager::TEXT,
                'default' => __( 'Enter your title', 'addon-pack' ),
                'label_block' => true,
			]
        );
        
        $this->add_control(
			'ap_pricing_sub_heading_enable',
			[
				'label' => __( 'Sub Heading Enable?', 'addon-pack' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'On', 'addon-pack' ),
				'label_off' => __( 'Off', 'addon-pack' ),
				'default' => 'no',
			]
		);
        
        $this->add_control(
			'ap_pricing_sub_heading',
			[
				'label' => __( 'Description', 'addon-pack' ),
				'type' => Controls_Manager::TEXTAREA,
                'default' => __( 'Enter your description', 'addon-pack' ),
                'rows' => 2,
                'label_block' => true,
                'condition' => [
					'ap_pricing_sub_heading_enable' => 'yes',
				],
			]
		);

		$this->add_control(
			'ap_pricing_heading_tag',
			[
				'label' => __( 'Heading Tag', 'addon-pack' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'h2' => 'H2',
					'h3' => 'H3',
					'h4' => 'H4',
					'h5' => 'H5',
					'h6' => 'H6',
				],
                'default' => 'h3',
                'condition' => [
					'ap_pricing_sub_heading_enable' => 'yes',
				],
			]
		);

        $this->end_controls_section();
        
        $this->start_controls_section(
            'ap_pricing_price_section',
            [
                'label' => __( 'Price', 'addon-pack' ),
            ]
        );

        $this->add_control(
			'currency_symbol',
			[
				'label' => __( 'Currency', 'addon-pack' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'' => __( 'None', 'addon-pack' ),
					'dollar' => '&#36; ' . __( 'Dollar', 'Currency Symbol', 'addon-pack' ),
					'euro' => '&#128; ' . __( 'Euro', 'Currency Symbol', 'addon-pack' ),
					'baht' => '&#3647; ' . __( 'Baht', 'Currency Symbol', 'addon-pack' ),
					'franc' => '&#8355; ' . __( 'Franc', 'Currency Symbol', 'addon-pack' ),
					'guilder' => '&fnof; ' . __( 'Guilder', 'Currency Symbol', 'addon-pack' ),
					'krona' => 'kr ' . __( 'Krona', 'Currency Symbol', 'addon-pack' ),
					'lira' => '&#8356; ' . __( 'Lira', 'Currency Symbol', 'addon-pack' ),
					'peseta' => '&#8359 ' . __( 'Peseta', 'Currency Symbol', 'addon-pack' ),
					'peso' => '&#8369; ' . __( 'Peso', 'Currency Symbol', 'addon-pack' ),
					'pound' => '&#163; ' . __( 'Pound Sterling', 'Currency Symbol', 'addon-pack' ),
					'real' => 'R$ ' . __( 'Real', 'Currency Symbol', 'addon-pack' ),
					'ruble' => '&#8381; ' . __( 'Ruble', 'Currency Symbol', 'addon-pack' ),
					'rupee' => '&#8360; ' . __( 'Rupee', 'Currency Symbol', 'addon-pack' ),
					'indian_rupee' => '&#8377; ' . __( 'Rupee (Indian)', 'Currency Symbol', 'addon-pack' ),
					'shekel' => '&#8362; ' . __( 'Shekel', 'Currency Symbol', 'addon-pack' ),
					'yen' => '&#165; ' . __( 'Yen/Yuan', 'Currency Symbol', 'addon-pack' ),
					'won' => '&#8361; ' . __( 'Won', 'Currency Symbol', 'addon-pack' ),
					'custom' => __( 'Custom', 'addon-pack' ),
				],
                'default' => 'dollar',
			]
		);


        $this->add_control(
            'ap_pricing_currency_placement',
            [
                'label'       => __( 'Currency Alignment', 'addon-pack' ),
                'type'        => Controls_Manager::SELECT,
                'default'     => 'left',
                'label_block' => false,
                'options'     => [
                    'left'  => __( 'Left', 'addon-pack' ),
                    'right' => __( 'Right', 'addon-pack' ),
                ],
            ]
        );

        $this->add_control(
            'ap_pricing_price',
            [
                'label'       => __( 'Price', 'addon-pack' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => false,
                'default'     => __( '89', 'addon-pack' ),
            ]
        );
        $this->add_control(
            'ap_pricing_onsale_enable',
            [
                'label'        => __( 'On Sale?', 'addon-pack' ),
                'type'         => Controls_Manager::SWITCHER,
                'default'      => 'no',
                'label_on'     => __( 'Yes', 'addon-pack' ),
                'label_off'    => __( 'No', 'addon-pack' ),
                'return_value' => 'yes',
            ]
        );

        $this->add_control(
            'ap_pricing_onsale_price',
            [
                'label'       => __( 'Sale Price', 'addon-pack' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => false,
                'default'     => __( '59', 'addon-pack' ),
                'condition'   => [
                    'ap_pricing_onsale_enable' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'ap_pricing_period',
            [
                'label'       => __( 'Price Period (per)', 'addon-pack' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => false,
                'default'     => __( 'month', 'addon-pack' ),
            ]
        );

        $this->add_control(
            'ap_pricing_period_separator',
            [
                'label'       => __( 'Period Separator', 'addon-pack' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => false,
                'default'     => __( '/', 'addon-pack' ),
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'ap_pricing_feature',
            [
                'label' => __( 'Features', 'addon-pack' ),
            ]
        );

        $this->add_control(
            'ap_pricing_feature_items',
            [
                'type'        => Controls_Manager::REPEATER,
                'fields'      => [
                    [
                        'name'        => 'ap_pricing_feature_item',
                        'label'       => __( 'Text', 'addon-pack' ),
                        'type'        => Controls_Manager::TEXT,
                        'label_block' => true,
                        'default'     => __( 'Pricing table list item', 'addon-pack' ),
                    ],
                    [
                        'name'             => 'ap_pricing_list_icon_new',
                        'label'            => __( 'Icon', 'addon-pack' ),
                        'type'             => Controls_Manager::ICONS,
                        'fa4compatibility' => 'ap_pricing_list_icon',
                        'default'          => [
                            'value'   => 'fas fa-check',
                            'library' => 'fa-solid',
                        ],
                    ],
                    [
                        'name'         => 'ap_pricing_icon_enable',
                        'label'        => __( 'Active?', 'addon-pack' ),
                        'type'         => Controls_Manager::SWITCHER,
                        'return_value' => 'yes',
                        'default'      => 'yes',
                    ],
                    [
                        'name'    => 'ap_pricing_list_icon_color',
                        'label'   => __( 'Icon Color', 'addon-pack' ),
                        'type'    => Controls_Manager::COLOR,
                        'default' => '#00C853',
                    ],
                    [
                        'name'         => 'ap_pricing_item_tooltip_enable',
                        'label'        => __( 'Enable Tooltip?', 'addon-pack' ),
                        'type'         => Controls_Manager::SWITCHER,
                        'return_value' => 'yes',
                        'default'      => false,
                    ],
                    [
                        'name'      => 'ap_pricing_item_tooltip_content',
                        'label'     => __( 'Tooltip Content', 'addon-pack' ),
                        'type'      => Controls_Manager::TEXTAREA,
                        'default'   => __( "I'm a awesome tooltip!!", 'addon-pack' ),
                        'condition' => [
                            'ap_pricing_item_tooltip_enable' => 'yes',
                        ],
                    ],
                   
                ],
                'seperator'   => 'before',
                'default'     => [
                    ['ap_pricing_item' => 'Unlimited calls'],
                    ['ap_pricing_item' => 'Free hosting'],
                    ['ap_pricing_item' => '500 MB of storage space'],
                    ['ap_pricing_item' => '500 MB Bandwidth'],
                    ['ap_pricing_item' => '24/7 support'],
                ],
                'title_field' => '{{ap_pricing_item}}',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
			'ap_pricing_footer',
			[
				'label' => __( 'Footer', 'addon-pack' ),
			]
		);

		$this->add_control(
			'ap_pricing_button_text',
			[
				'label' => __( 'Button Text', 'addon-pack' ),
				'type' => Controls_Manager::TEXT,
				'default' => __('Select Plan', 'addon-pack'),
				'placeholder' => __( 'Enter Your Text', 'addon-pack' ),
				'label_block'   => true,
			]
		);

		$this->add_control('ap_pricing_button_link_selection', 
			[
				'label'         => __('Link Type', 'addon-pack'),
				'type'          => Controls_Manager::SELECT,
				'options'       => [
					'custom_url'   => __('URL', 'addon-pack'),
					'existing_url'  => __('Existing Page', 'addon-pack'),
				],
				'default'       => 'custom_url',
				'label_block'   => true,
			]
		);

		$this->add_control('ap_pricing_button_url',
			[
				'label'         => __('Link', 'addon-pack'),
				'type'          => Controls_Manager::URL,
				'dynamic'       => [ 'active' => true ],
				'default'       => [
					'url'   => '#',
				],
				'label_block'   => true,
				'condition'     => [
					'ap_pricing_link_selection' => 'custom_url'
				]
			]
		);

		$this->add_control('ap_pricing_button_existing_url',
			[
				'label'         => __('Existing Page', 'addon-pack'),
				'type'          => Controls_Manager::SELECT2,
				'options'       => $this->getPostsInstance()->get_all_posts(),
				'condition'     => [
					'ap_pricing_link_selection'  => 'existing_url',
				],
				'multiple'      => false,
				'label_block'   => true,
			]
		);

		$this->add_control(
			'ap_pricing_existing_button_url_target_blank',
            [
                'label'         => __('Open a new Tab', 'addon-pack'),
                'type'          => Controls_Manager::SWITCHER,
				'description'   => __('Enable or disable open with tab','addon-pack'),
				'condition'     => [
					'ap_pricing_link_selection'  => 'existing_url',
				],
            ]
        );

		$this->add_control(
			'ap_pricing_button_size',
			[
				'label'   => __( 'Button Size', 'addon-pack' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'md',
				'options' => [
					'xs' => __( 'Extra Small', 'addon-pack' ),
					'sm' => __( 'Small', 'addon-pack' ),
					'md' => __( 'Medium', 'addon-pack' ),
					'lg' => __( 'Large', 'addon-pack' ),
					'xl' => __( 'Extra Large', 'addon-pack' ),
				],
			]
		);

		$this->add_control(
			'ap_pricing_button_icon',
			[
				'label'       => __( 'Button Icon', 'addon-pack' ),
				'type'        => Controls_Manager::ICON,
				'default' => 'fa fa-heart',
				'separator'   => 'before',
				'label_block' => true,
			]
		);

		$this->add_control(
			'ap_pricing_button_icon_align',
			[
				'label'   => __( 'Icon Alignment', 'addon-pack' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'left',
				'options' => [
					'left'   => __( 'Left', 'addon-pack' ),
					'right'  => __( 'Right', 'addon-pack' ),
					'none'   => __( 'None', 'addon-pack' ),
				],
				'condition' => [
					'ap_pricing_button_icon!' => '',
				],
			]
		);

		$this->add_control(
			'ap_pricing_button_icon_spacing',
			[
				'label' => __( 'Icon Spacing', 'addon-pack' ),
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
					'ap_pricing_button_icon!' => '',
					'ap_pricing_button_icon_align!' => 'none',
				],
				'selectors' => [
					'{{WRAPPER}} .ap-button .ap-button-icon-right'  => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .ap-button .ap-button-icon-left'   => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'ap_pricing_footer_additional_info',
			[
				'label' => __( 'Additional Info', 'addon-pack' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => __( 'This is text element', 'addon-pack' ),
                'rows' => 3,
                'separator'   => 'before',
			]
		);
		
        $this->end_controls_section();
        
        $this->start_controls_section(
            'ap_pricing_badge',
            [
                'label' => __( 'Badge', 'addon-pack' ),
            ]
        );

        $this->add_control(
            'ap_pricing_badge_enable',
            [
                'label'        => __( 'Badge?', 'addon-pack' ),
                'type'         => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        $this->add_control(
            'ap_pricing_badge_styles',
            [
                'label'     => __( 'Badge Style', 'addon-pack' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'badge-1',
                'options'   => [
                    'badge-1' => __( 'Style 1', 'addon-pack' ),
                    'badge-2' => __( 'Style 2', 'addon-pack' ),
                ],
                'condition' => [
                    'ap_pricing_badge_enable' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'ap_pricing_badge_text',
            [
                'label'       => __( 'Badge Tag Text', 'addon-pack' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => false,
                'default'     => __( 'Featured', 'addon-pack' ),
                'selectors'   => [
                    '{{WRAPPER}} .eael-pricing.style-1 .eael-pricing-item.badge:before' => 'content: "{{VALUE}}";',
                    '{{WRAPPER}} .eael-pricing.style-2 .eael-pricing-item.badge:before' => 'content: "{{VALUE}}";',
                ],
                'condition' => [
                    'ap_pricing_badge_enable' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'ap_pricing_badge_position',
            [
                'label' => __( 'Position', 'addon-pack' ),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options' => [
                    'left' => [
                        'title' => __( 'Left', 'addon-pack' ),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'right' => [
                        'title' => __( 'Right', 'addon-pack' ),
                        'icon' => 'eicon-h-align-right',
                    ],
                ],
                'toggle' => false,
                'default' => 'right',
                'condition' => [
                    'ap_pricing_badge_enable' => 'yes'
                ]
            ]
        );


        $this->end_controls_section();
		
	}
	
	protected function register_heading_style_controls(){


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

    }
	protected function _content_template() {

	}
	
}