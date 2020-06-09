<?php

namespace AddonPack\Includes;

if ( ! defined( 'ABSPATH' ) ) exit; 

class AddonPack_Helper {

	protected static $instance;
	
	protected $options;

	public static function getInstance() {
		if( !static::$instance ) {
			static::$instance = new self;
		}
		return static::$instance;
	}


	public function get_all_posts() {

		$all_posts = get_posts( array(
                'posts_per_page'    => -1,
				'post_type'         => array ( 'page', 'post' ),
			)
		);
		if( !empty( $all_posts ) && !is_wp_error( $all_posts ) ) {
			foreach ( $all_posts as $post ) {
				$this->options[ $post->ID ] = strlen( $post->post_title ) > 25 ? substr( $post->post_title, 0, 25 ).'...' : $post->post_title;
			}
		}
		return $this->options;
	}

	public static function getCf7FormNames(){
		$options = array();

        if (function_exists('wpcf7')) {
            $ap_cf7_form_list = get_posts(array(				
				'post_type'      => 'wpcf7_contact_form',
				'post_status'    => 'publish',
				'posts_per_page' => -1,
				'orderby'        => 'title',
				'order'          => 'ASC',
            ));
            $options[0] = esc_html__('Select Contact Form', 'addon-pack');
            if (!empty($ap_cf7_form_list)) {
                foreach ($ap_cf7_form_list as $post) {
                    $options[$post->ID] = $post->post_title;
                }
            } else {
                $options[0] = esc_html__('Create a Form First', 'addon-pack');
            }
        }
        return $options;

	}

	public static function getFluentFormNames(){

		if( !defined('FLUENTFORM')){
			return;
		}

		global $wpdb;
		$table_name = $wpdb->prefix . 'fluentform_forms';
		$fluent_cf_list = $wpdb->get_results(
			"	
				SELECT id, title 
				FROM `$table_name`
			"
		);

		$fluent_cf_value = array();

		if( $fluent_cf_list ){
			$fluent_cf_value[0] = esc_html__( 'Select Contact Form', 'elementor-kits');

			foreach ( $fluent_cf_list as $value ) {
				$fluent_cf_value[$value->id] = $value->title;
			}
		} else {
			$fluent_cf_value[0] = esc_html__( 'Create a Form First', 'elementor-kits');
		}

		return $fluent_cf_value;

	}

}
