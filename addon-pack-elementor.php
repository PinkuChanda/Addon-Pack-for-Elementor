<?php
/**
 * Plugin Name: AddonPack - Essential Addons for Elementor Page Builder
 * Plugin URI: http://devutpol.com/wp/plugins/addon-pack-for-elementor
 * Description: 
 * Author: AddonPack
 * Author URI: https://www.facebook.com/addon-pack
 * Version: 1.0.0
 * Text Domain: addon-pack
 * Domain Path: /languages
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

define('ADDON_PACK', '1.0.0');
define('ADDON_PACK_DIR_PATH', plugin_dir_path(__FILE__));
define('ADDON_PACK_DIR_URL', plugin_dir_url(__FILE__));

require ADDON_PACK_DIR_PATH . 'classes/class-base.php';




