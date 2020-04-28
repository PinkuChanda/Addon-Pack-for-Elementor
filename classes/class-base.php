<?php
namespace AddonPack\Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Main Plugin Class
 *
 * Register new elementor widget.
 *
 * @since 1.0.0
 */
class Base {
	const MINIMUM_ELEMENTOR_VERSION = '2.5.0';
	const MINIMUM_PHP_VERSION = '5.4';

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

	/**
	 * Constructor
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function __construct() {
		add_action( 'init', array( $this, 'i18n') );
		add_action( 'plugins_loaded', array( $this, 'init') );
	}
	

	public function i18n(){
		load_plugin_textdomain( 'addon-pack' );
	}

	/**
	 * init
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function init() {

		// Check if Elementor installed and activated
		if ( ! did_action( 'elementor/loaded' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_missing_elementor_plugin' ] );
			return;
		}

		// Check required Elementor version
		if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_elementor_version' ] );
			return;
		}

		// Check required PHP version
		if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_php_version' ] );
			return;
		}

		$this->includes();

		add_action( 'elementor/widgets/widgets_registered', array($this, 'init_widgets') );

		// register custom category
		add_action( 'elementor/elements/categories_registered', array($this, 'add_category') );

	}


	public function includes() {
		require_once ( ADDON_PACK_DIR_PATH.'classes/class-assets-manager.php' );
		require_once ( ADDON_PACK_DIR_PATH . 'includes/addon-pack-helper.php' );
	}

	public function init_widgets(){
		require_once( ADDON_PACK_DIR_PATH . 'classes/class-widget-manager.php' );
	}

	/**
	 * Add custom category.
	 *
	 * @param $elements_manager
	 *
	 * @access public
	 */
	public function add_category($elements_manager) {
		$elements_manager->add_category(
			'addon-pack',
			[
				'title' => __('Addon Pack', 'addon-pack'),
				'icon' => 'fa fa-plug',
			]);
	}


	public function is_plugins_active( $plugin_file_path = NULL ){
		$installed_plugins_list = get_plugins();
		return isset( $installed_plugins_list[$plugin_file_path] );
	}

	public function admin_notice_missing_elementor_plugin() {
		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$elementor = 'elementor/elementor.php';
		if( $this->is_plugins_active( $elementor ) ) {
			if( ! current_user_can( 'activate_plugins' ) ) { return; }

			$activation_url = wp_nonce_url( 'plugins.php?action=activate&amp;plugin=' . $elementor . '&amp;plugin_status=all&amp;paged=1&amp;s', 'activate-plugin_' . $elementor );

			$message = '<p>' . __( 'Addon Pack - Essential Addons for Elementor Page Builder not working because you need to activate the Elementor plugin.', 'addon-pack' ) . '</p>';
			$message .= '<p>' . sprintf( '<a href="%s" class="button-primary">%s</a>', $activation_url, __( 'Elementor Activate Now', 'addon-pack' ) ) . '</p>';
		} else {
			if ( ! current_user_can( 'install_plugins' ) ) { return; }

			$install_url = wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=elementor' ), 'install-plugin_elementor' );

			$message = '<p>' . __( 'Addon Pack - Essential Addons for Elementor Page Builder not working because you need to install the Elementor plugin', 'addon-pack' ) . '</p>';

			$message .= '<p>' . sprintf( '<a href="%s" class="button-primary">%s</a>', $install_url, __( 'Elementor Install Now', 'addon-pack' ) ) . '</p>';
		}
		echo '<div class="error"><p>' . $message . '</p></div>';

	}

	public function admin_notice_minimum_elementor_version(){
		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );
		$message = sprintf(
			__( '"%1$s" requires "%2$s" version %3$s or greater.', 'addon-pack' ),
			'<strong>' . __( 'Addon Pack - Essential Addons for Elementor Page Builder', 'addon-pack' ) . '</strong>',
			'<strong>' . __( 'Elementor', 'addon-pack' ) . '</strong>',
			self::MINIMUM_ELEMENTOR_VERSION
		);
		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
	}

	public function admin_notice_minimum_php_version() {
		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );
		$message = sprintf(
			__( '"%1$s" requires "%2$s" version %3$s or greater.', 'addon-pack' ),
			'<strong>' . __( 'Addon Pack - Essential Addons for Elementor Page Builder', 'addon-pack' ) . '</strong>',
			'<strong>' . __( 'PHP', 'addon-pack' ) . '</strong>',
			self::MINIMUM_PHP_VERSION
		);
		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
	}

}

new Base();