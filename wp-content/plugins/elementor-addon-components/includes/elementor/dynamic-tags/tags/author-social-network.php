<?php

/*===============================================================================
* Class: Eac_Author_Social_network
*
* 
* @return PAS ENCORE UTILISÉ
* @since 1.6.0
*===============================================================================*/

namespace EACCustomWidgets\Includes\Elementor\DynamicTags\Tags;

use Elementor\Controls_Manager;
use Elementor\Core\DynamicTags\Tag;
use Elementor\Modules\DynamicTags\Module as TagsModule;

if(!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

class Eac_Author_Social_network extends Tag {

	public function get_name() {
		return 'eac-addon-author-social-network';
	}

	public function get_title() {
		return __('Auteur réseaux sociaux', 'eac-components');
	}

	public function get_group() {
		return 'eac-author-groupe';
	}

	public function get_categories() {
		return [
			TagsModule::TEXT_CATEGORY,
			TagsModule::POST_META_CATEGORY,
		];
	}
    
	public function get_panel_template_setting_key() {
		return 'author_social_network';
	}

	protected function _register_controls() {
		$this->add_control('author_social_network',
			[
				'label' => __('Champs', 'eac-components'),
				'type' => Controls_Manager::SELECT2,
				'label_block' => true,
				'multiple' => true,
				'default' => '',
				'options' => [
					'twitter' => __('Twitter', 'eac-components'),
					'facebook' => __('Facebook', 'eac-components'),
					'instagram' => __('Instagram', 'eac-components'),
					'linkedin' => __('Linkedin', 'eac-components'),
					'youtube' => __('Youtube', 'eac-components'),
					'pinterest' => __('Pinterest', 'eac-components'),
					'tumblr' => __('Tumblr', 'eac-components'),
					'flickr' => __('Flickr', 'eac-components'), 
				],
			]
		);
	}
	
	public function render() {
		global $authordata;
		if(!isset($authordata->ID)) { // La variable globale n'est pas définie
			$post = get_post();
			$authordata = get_userdata($post->post_author);
		}
		
	    $values = '<div class="dynamic-tags_author-social-network">';
		$keys = $this->get_settings('author_social_network');
		
		if(empty($keys)) { return; }
	    
		foreach($keys as $key) {
		    $value = get_the_author_meta($key);
		    if($value !== '') {
    		    if($key === 'twitter') { $values .= '<div class="dynamic-tags_author-social-icon"><a href="' . $value .'" target="_blank" rel="nofollow"><i class="fa fa-twitter" aria-hidden="true"></i></a></div>'; }
    		    else if($key === 'facebook') { $values .= '<div class="dynamic-tags_author-social-icon"><a href="' . $value .'" target="_blank" rel="nofollow"><i class="fa fa-facebook" aria-hidden="true"></i></a></div>'; }
    		    else if($key === 'instagram') { $values .= '<div class="dynamic-tags_author-social-icon"><a href="' . $value .'" target="_blank" rel="nofollow"><i class="fa fa-instagram fa-lg" aria-hidden="true"></i></a></div>'; }
    		    else if($key === 'linkedin') { $values .= '<div class="dynamic-tags_author-social-icon"><a href="' . $value .'" target="_blank" rel="nofollow"><i class="fa fa-linkedin" aria-hidden="true"></i></a></div>'; }
    		    else if($key === 'youtube') { $values .= '<div class="dynamic-tags_author-social-icon"><a href="' . $value .'" target="_blank" rel="nofollow"><i class="fa fa-youtube" aria-hidden="true"></i></a></div>'; }
				else if($key === 'pinterest') { $values .= '<div class="dynamic-tags_author-social-icon"><a href="' . $value .'" target="_blank" rel="nofollow"><i class="fa fa-pinterest" aria-hidden="true"></i></a></div>'; }
				else if($key === 'tumblr') { $values .= '<div class="dynamic-tags_author-social-icon"><a href="' . $value .'" target="_blank" rel="nofollow"><i class="fa fa-tumblr" aria-hidden="true"></i></a></div>'; }
				else if($key === 'flickr') { $values .= '<div class="dynamic-tags_author-social-icon"><a href="' . $value .'" target="_blank" rel="nofollow"><i class="fa fa-flickr" aria-hidden="true"></i></a></div>'; }
		    }
		}
		$values .= '</div>';
		
		echo wp_kses_post($values);
	}
}