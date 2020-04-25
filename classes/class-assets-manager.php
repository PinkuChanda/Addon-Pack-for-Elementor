<?php
namespace AddonPack\Elementor\Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if( !class_exists( 'Assets_Manager' ) ){
	class Assets_Manager{
		/**
		 * Member Variable
		 *
		 * @var instance
		 */
		private static $instance = null;

		/**
		 *  Initiator
		 */
		public static function get_instance() {
			if( is_null( self::$instance ) ){
				self::$instance = new self();
			}
			return self::$instance;
		}

		public function __construct(){
			add_action( 'elementor/frontend/after_register_styles', array ( $this, 'register_frontend_styles' ), 10 );
			add_action( 'elementor/frontend/after_register_scripts', array ( $this, 'register_fronted_scripts' ), 10 );

			add_action( 'elementor/frontend/after_enqueue_styles', array ( $this, 'enqueue_frontend_styles' ), 10 );
			add_action( 'elementor/frontend/after_enqueue_scripts', array ( $this, 'enqueue_frontend_scripts' ), 10 );
		}
		
		public function register_frontend_styles(){
			// wp_register_style(
			// 	'main-css',
			// 	ADDON_PACK_DIR_URL . 'assets/css/main.css',
			// 	array(),
			// 	TRUE
			// );
		}
		
		public function register_fronted_scripts(){
//			wp_register_script(
//				'slick',
//				ADDON_PACK_DIR_URL . 'assets/js/slick.min.js',
//				array('jquery'),
//				ADDON_PACK_,
//				TRUE
//			);
		}
		
		public function enqueue_frontend_styles(){
			wp_enqueue_style('main-css', ADDON_PACK_DIR_URL . 'assets/css/main.css');
		}
		
		public function enqueue_frontend_scripts(){
			//wp_enqueue_script( 'bootstrap' );
		}
	}

	Assets_Manager::get_instance();
}