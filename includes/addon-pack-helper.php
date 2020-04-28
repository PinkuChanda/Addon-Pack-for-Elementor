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
    

    
}
