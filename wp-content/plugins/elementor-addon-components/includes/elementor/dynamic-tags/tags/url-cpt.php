<?php

/*==================================================================================
* Class: Url_Cpts_Tag
*
*
* @return affiche la liste des URL de tous les articles personnalisées (CPT)
* @since 1.6.0
* @since 1.6.2	Exclusion des types de post Elementor, Formulaires
* @since 1.6.6	Change le GUID de l'url du CPT par 'get_permalink()'
*=================================================================================*/

namespace EACCustomWidgets\Includes\Elementor\DynamicTags\Tags;

use EACCustomWidgets\Includes\Elementor\DynamicTags\Eac_Dynamic_Tags;
use Elementor\Core\DynamicTags\Data_Tag;
use Elementor\Modules\DynamicTags\Module as TagsModule;
use Elementor\Controls_Manager;

if(!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

/**
 * Post Url
 */
Class Eac_Cpts_Tag extends Data_Tag {
	
	/**
	 * Liste des types de CPT qui ne seront pas affichés
	 *
	 * @since 1.6.2
	 */
	// Exclusion de types de post
	public static $exclude_posttype = array(
		'attachment',
		'elementor_library',
		'ae_global_templates',
		'sdm_downloads',
		'forminator_forms',
		'custom-css-js',
		'custom_css',
		'flamingo_contact',
		'flamingo_inbound',
		'mailpoet_page',
		'wpcf7_contact_form',
		'wpforms'
		
	);
	
	public function get_name() {
		return 'eac-addon-cpt-url-tag';
	}

	public function get_title() {
		return __('Articles personnalisés', 'eac-components');
	}

	public function get_group() {
		return 'eac-url';
	}

	public function get_categories() {
		return [TagsModule::URL_CATEGORY];
	}
	
	public function get_panel_template_setting_key() {
		return 'single_cpt_url';
	}
	
	protected function _register_controls() {
		$this->add_control('single_cpt_url',
			[
				'label' => __('Articles Url', 'eac-components'),
				'type' => Controls_Manager::SELECT,
				'options' => $this->get_custom_keys_array(),
			]
		);
	}
	
	public function get_value(array $options = []) {
		$param_name = $this->get_settings('single_cpt_url');
		if(empty($param_name)) { return ''; }
		return wp_kses_post($param_name);
	}
	
    private function get_custom_keys_array() {
        $cpttaxos = [];
        $options = array('' => __('Select...', 'eac-components'));
        
        $cpttaxos = Eac_Dynamic_Tags::get_all_cpts_url();
        if(!empty($cpttaxos)) {
			foreach($cpttaxos as $cpttaxo) {
				if(!in_array($cpttaxo->post_type, self::$exclude_posttype)) {
					//$options[$cpttaxo->guid] = $cpttaxo->post_type . "::" . $cpttaxo->post_title;
					$options[get_permalink($cpttaxo->ID)] = $cpttaxo->post_type . "::" . $cpttaxo->post_title; // @since 1.6.6
				}
            }
		}
		return $options;
    }
}