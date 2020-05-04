<?php
namespace AddonPack\Elementor\Widget;

use Elementor\Widget_Base;
use AddonPack\Includes;
use Elementor\Utils;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Scheme_Typography;


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
			'ap_infobox_layouts',
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
                   'design-three'  => __( 'Design 3', 'addon-pack'),
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

        $this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name'		=> 'ap_infobox_image_size',
				'default'	=> 'thumbnail',
				'condition' => [
					'ap_infobox_icon_type' => 'ap_infobox_image'
				],
			]
        );

        $this->add_control(
			'ap_infobox_title',
			[
				'label' => __( 'Title', 'addon-pack' ),
				'type' => Controls_Manager::TEXT,
				'default' => __('The Creative Addons for Elementor', 'addon-pack'),
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
				'default' => 'h2',
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
				'default' => 'center',
				'selectors' => [
					'{{WRAPPER}} .ap-infobox-wrapper' => 'text-align: {{VALUE}};',
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
			'ap_infobox_read_more_text',
			[
				'label' => __( 'Read More Text', 'addon-pack' ),
				'type' => Controls_Manager::TEXT,
				'default' => __('Service', 'addon-pack'),
				'dynamic' => [
					'active' => true,
				],
				'label_block' => true,
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
					'ap_infobox_read_more_link_selection'     => 'existing_url',
				],
				'multiple'      => false,
				'label_block'   => true,
			]
		);

        $this->end_controls_section();


	}

	
	protected function register_heading_style_controls(){
		
		$this->start_controls_section(
			'ap_infobox_general_style',
			[
				'label' => __( 'Info Box', 'addon-pack' ),
				'tab' => Controls_Manager::TAB_STYLE,
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
	protected function render() {
        $settings = $this->get_settings_for_display();

        ?>

        <div class="ap-infobox-wrapper"> 

        <?php if('design-one' == $settings['ap_infobox_style']) : ?>
            <div class="ap-infobox-design-1"> 
                <div class="ap-infobox-thumb">
                    <i class="fa fa-atom"></i>
                    <img src="assets/images/service-icons/s_icon_2.png" alt="" draggable="false">
                </div>

                <div class="ap-infobox-details">
                    <h4>Transportation</h4>
                    <p>Whether you are travelling through Air, Sea or Land, Emigrar can arrange transportation according to.</p>
                </div>

                <div class="ap-infobox-link">
                    <a href="">Read more <i class="fas fa-angle-double-right"></i></a> 
                </div>
            </div>
        <?php endif; ?>

        <?php if('design-two' == $settings['ap_infobox_style']) : ?>
            <div class="ap-infobox-design-2"> 
                    
                    <div class="ap-infobox-thumb">
                        <i class="fa fa-atom"></i>
                        <img src="assets/images/service-icons/s_icon_2.png" alt="" draggable="false">
                    </div>

                    <div class="ap-infobox-details">
                        <h4>Transportation</h4>
                        <p>Whether you are travelling through Air, Sea or Land, Emigrar can arrange transportation according to.</p>
                    </div>

                    <div class="ap-infobox-link">
                        <a href="">Read more <i class="fas fa-arrow-right"></i></a> 
                    </div>

            </div>
        <?php endif; ?>

        </div>

	<?php }
	protected function _content_template() {

		
	}
	
}