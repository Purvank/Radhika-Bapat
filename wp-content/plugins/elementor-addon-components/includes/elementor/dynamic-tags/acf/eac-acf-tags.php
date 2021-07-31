<?php

/*=============================================================================
* Class: Eac_Acf_Tags
*
* Description:
*
* @since 1.7.5
=============================================================================*/

namespace EACCustomWidgets\Includes\Elementor\DynamicTags\ACF;

use EACCustomWidgets\Includes\Eac_Tools_Util;

if(!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

class Eac_Acf_Tags {
	
	/**
	 * @var $instance
	 *
	 * Garantir une seule instance de la class
	 *
	 * @since 1.7.5
	 */
	public static $instance = null;
	
	/**
	 * Constructeur de la class
	 *
	 * @since 1.7.5
	 *
	 * @access public
	 */
	public function __construct() {
		Eac_Acf_Tags::instance();
	}
	
	/**
	 * get_control_options
	 *
	 * @param array $field_type
	 * @return array
	 *
	 * @since 1.7.5
	 */
	public static function get_acf_fields_options($field_type) {
		$groups = array();
		$options = array('' => __('Select...', 'eac-components'));
		
		/*remove_all_actions('restrict_manage_posts');
		remove_all_filters('acf/get_field_groups');
		remove_all_filters('acf/field_group/get_fields');
		remove_all_filters('acf/load_value/type=select');
		remove_all_filters('acf/load_value');
		remove_all_filters('acf/update_value');
		// disable JSON to avoid conflicts between DB and JSON
		acf_disable_local();*/
		
		// ACF >= 5.0.0 Quelques tests
		if(function_exists('acf_get_field_groups')) {
			$acf_groups = acf_get_field_groups();
		} else { // ACF <= 5.0.0
			$acf_groups = apply_filters('acf/get_field_groups', []);
		}
		
		foreach($acf_groups as $group) {
			// Le groupe n'est pas désactivé
			if(!$group['active']) {
				continue;
			}
			
			// ACF >= 5.0.0 Quelques tests
			if(function_exists('acf_get_fields')) {
				if(isset($group['ID']) && !empty($group['ID'])) {
					$fields = acf_get_fields($group['ID']);
				} else {
					$fields = acf_get_fields($group);
				}
			} else { // ACF <= 5.0.0
				$fields = apply_filters('acf/field_group/get_fields', [], $group['id']);
			}
			
			// Pas de champ
			if(!is_array($fields)) {
				continue;
			}
			
			foreach($fields as $field) {
				// C'est le bon type de champ ACF
				if(!in_array($field['type'], $field_type, true)) {
					continue;
				}
				
				// Clé unique et slug comme indice du tableau
				$key = $field['key'] . '::' . $field['name'];
				$options[$key] = $group['title'] . "::" . $field['label'];
			}
		}
		
		return $options;
	}
	
	/**
	 * get_all_acf_fields
	 *
	 * @return array des champs ACF par leur groupe
	 *
	 * @since 1.7.5
	 */
	public static function get_all_acf_fields($posttype) {
		$options = array();
		$acf_field_groups = array();
		$acf_supported_field_types = Eac_Tools_Util::get_acf_supported_fields();
		
		// ACF >= 5.0.0
		if(function_exists('acf_get_field_groups')) {
			$acf_groups = acf_get_field_groups(array('post_type' => $posttype));
		} else {
			$acf_groups = apply_filters('acf/get_field_groups', array());
		}
		
		if(!empty($acf_groups)) {
			foreach($acf_groups as $group) {
				if(!$group['active']) {
					continue;
				}
				
				//foreach($group['location'] as $group_locations) {
					//foreach($group_locations as $rule) {
						//if($rule['param'] == 'post_type' && $rule['operator'] == '==' && $rule['value'] == $posttype) {
							$fields = get_posts(array(
							'posts_per_page'   => -1,
							'post_type'        => 'acf-field',
							'orderby'          => 'menu_order',
							'order'            => 'ASC',
							'suppress_filters' => true, // DO NOT allow WPML to modify the query
							'post_parent'      => $group['ID'],
							'post_status'      => 'publish',
							'update_post_meta_cache' => false
							));
							
							foreach($fields as $field) {
								$pcontent = (array) maybe_unserialize($field->post_content);
								if(is_array($acf_supported_field_types) && in_array($pcontent['type'], $acf_supported_field_types)) {
									//$options[(int) $group['ID'] . "::" . (int) $field->ID . "::" . $field->post_excerpt] = $group['title'] . "::" . $field->post_title . "::" . $pcontent['type'];
									$options[] = ['group_title' => $group['title'], 'excerpt' => $field->post_excerpt, 'post_title' => $field->post_title];
								}
							}
						//}
					//}
				//}
			}
		}
		
		return $options;
	}
	
	/**
	 * instance.
	 *
	 * Garantir une seule instance de la class
	 *
	 * @since 1.0.0
	 *
	 * @return Eac_Acf_Tags une instance de la class
	 */
	public static function instance() {
		if(is_null(self::$instance)) {
			self::$instance = new self();
		}
		return self::$instance;
	}
}