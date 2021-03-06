<?php

/*===============================================================================
* Class: Eac_Post_Stats
*
* 
* @return affiche la valeur d'une variable interne du site
* @since 1.6.0
*===============================================================================*/

namespace EACCustomWidgets\Includes\Elementor\DynamicTags\Tags;

use Elementor\Core\DynamicTags\Tag;
use Elementor\Modules\DynamicTags\Module as TagsModule;
use Elementor\Controls_Manager;

if(!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

class Eac_Post_Stats extends Tag {

	public function get_name() {
		return 'eac-addon-post-stats';
	}

	public function get_title() {
		return __('Statistiques', 'eac-components');
	}

	public function get_group() {
		return 'eac-site-groupe';
	}

	public function get_categories() {
		return [
			TagsModule::TEXT_CATEGORY,
		];
	}

	public function get_panel_template_setting_key() {
		return 'select_stats';
	}

	protected function _register_controls() {
		
		$this->add_control('select_stats',
			[
				//'label'   => __('Select...', 'eac-components'),
				'type'    => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
				    ''              => __('Select...', 'eac-components'),
					'wpv'	        => __('Version Wordpress', 'eac-components'),
					'phpv'	        => __('Version PHP', 'eac-components'),
					'siteurl'		=> __('URL du site', 'eac-components'),
					'language'		=> __('Langage', 'eac-components'),
					'timezone'		=> __('Fuseau horaire', 'eac-components'),
					'dataformat'	=> __('Format de la date', 'eac-components'),
					'user'	        => __('Inscrits', 'eac-components'),
					'post'	        => __('Articles', 'eac-components'),
					'page'	        => __('Pages', 'eac-components'),
					'cpt'           => __("Types d'articles personnalisés", 'eac-components'),  // Nombre de types d'articles personnalisés
					'countcpt'	    => __("Nombre d'articles personnalisés", 'eac-components'), // Nombre d'articles personnalisés
					'attachment'	=> __('Médias', 'eac-components'),
					'comment'       => __('Commentaires', 'eac-components'),
					'comment_pending'	=> __('Commentaires en attente', 'eac-components'),
					'category'      => __('Catégories', 'eac-components'),
					'post_tag'      => __('Étiquettes', 'eac-components'),
					'elem_lib'      => __('Modèles Elementor', 'eac-components'),
					'elem_category' => __('Catégories Elementor', 'eac-components'),
					'plugins'       => __('Plugins actifs', 'eac-components'),
				],
			]
		);
	}
    
    public function render() {
        global $wpdb;
        $stats = 0;
        
		if($this->get_settings('select_stats') === 'wpv') {
			$stats = get_bloginfo('version');
		} else if($this->get_settings('select_stats') === 'phpv') {
			$stats = phpversion(); 
		} else if($this->get_settings('select_stats') === 'siteurl') {
			$stats = get_site_url();
		} else if($this->get_settings('select_stats') === 'language') {
			$stats = get_bloginfo('language');
		} else if($this->get_settings('select_stats') === 'timezone') {
			$timezone = get_option('timezone_string');
			if(!$timezone) {
				$timezone = get_option('gmt_offset');
			}
			$stats = $timezone;
		} else if($this->get_settings('select_stats') === 'dataformat') {
			$stats = get_option('date_format');
		} else if($this->get_settings('select_stats') === 'user') {
			$stats = $wpdb->get_var("SELECT COUNT(*) FROM $wpdb->users");
		} else if($this->get_settings('select_stats') === 'post') {
		    $stats = $wpdb->get_var("SELECT COUNT(*) FROM $wpdb->posts WHERE post_type = 'post' AND post_status = 'publish'");
		} else if($this->get_settings('select_stats') === 'page') {
		    $stats = $wpdb->get_var("SELECT COUNT(*) FROM $wpdb->posts WHERE post_type = 'page' AND post_status = 'publish'");
		} else if($this->get_settings('select_stats') === 'cpt') {
		    $stats = count(get_post_types(array('_builtin' => false)));
		} else if($this->get_settings('select_stats') === 'countcpt') {
		    $post_types = get_post_types(array('_builtin' => false), 'objects');
            foreach ($post_types as $post_type) {
                $stats += wp_count_posts($post_type->name)->publish;
            }
		} else if($this->get_settings('select_stats') === 'attachment') {
		    $stats = $wpdb->get_var("SELECT COUNT(*) FROM $wpdb->posts WHERE post_type = 'attachment' AND post_status = 'inherit'");
		} else if($this->get_settings('select_stats') === 'comment') {
		    $stats = $wpdb->get_var("SELECT COUNT(*) FROM $wpdb->comments WHERE comment_approved = '1'");
		} else if($this->get_settings('select_stats') === 'comment_pending') {
		    $stats = $wpdb->get_var("SELECT COUNT(*) FROM $wpdb->comments WHERE comment_approved = '0'");
		} else if($this->get_settings('select_stats') === 'category') {
		    $stats = wp_count_terms('category');
		} else if($this->get_settings('select_stats') === 'post_tag') {
		    $stats = wp_count_terms('post_tag');
		} else if($this->get_settings('select_stats') === 'elem_lib') {
		    $stats = $wpdb->get_var("SELECT COUNT(*) FROM $wpdb->posts WHERE post_type = 'elementor_library' AND post_status = 'publish'");
		} else if($this->get_settings('select_stats') === 'elem_category') {
		    $stats = wp_count_terms('elementor_library_category');
		} else if($this->get_settings('select_stats') === 'plugins') {
		    $stats = 0;
            if(!function_exists('get_plugins')) {
                require_once ABSPATH . 'wp-admin/includes/plugin.php';
            }
            
            $active_plugins = get_option('active_plugins');
            $all_plugins = get_plugins();
            $activated_plugins = array();
            
            foreach ($active_plugins as $plugin) {           
                if(isset($all_plugins[$plugin])) {
                    array_push($activated_plugins, $all_plugins[$plugin]);
                }           
            }
            $stats = count($activated_plugins);
        }
        
		echo wp_kses_post($stats);
	}
}