<?php

/*===============================================================================
* Class: Eac_Elementor_Template
*
*  
* @return récupère la liste de tous modèles Elementor (Page, Section)
* et retourne le template sélectionné
* @since 1.6.0
*===============================================================================*/

namespace EACCustomWidgets\Includes\Elementor\DynamicTags\Tags;

use EACCustomWidgets\Includes\Elementor\DynamicTags\Eac_Dynamic_Tags;
use Elementor\Core\DynamicTags\Data_Tag;
use Elementor\Modules\DynamicTags\Module as TagsModule;
use Elementor\Controls_Manager;

if(!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

class Eac_Elementor_Template extends Data_Tag {

	public function get_name() {
		return 'eac-addon-elementor-template';
	}

	public function get_title() {
		return __('Modèles Elementor', 'eac-components');
	}

	public function get_group() {
		return 'eac-post';
	}

	public function get_categories() {
		return [
			TagsModule::TEXT_CATEGORY,
		];
	}

	public function get_panel_template_setting_key() {
		return 'select_template';
	}

	protected function _register_controls() {
		
		$this->add_control('select_template',
			[
				'label'   => __('Type', 'eac-components'),
				'type'    => Controls_Manager::SELECT,
				'default' => 'page',
				'options' => [
					'page'      => __('Page', 'eac-components'),
					'section'	=> __('Section', 'eac-components'),
				],
			]
		);
			
		$this->add_control('select_template_page',
			[
				'label' => __('Clé', 'eac-components'),
				'type' => Controls_Manager::SELECT,
				'label_block' => true,
				'options' => Eac_Dynamic_Tags::get_elementor_templates('page'),
				'condition' => ['select_template' => 'page'],
			]
		);
		
		$this->add_control('select_template_section',
			[
				'label' => __('Clé', 'eac-components'),
				'type' => Controls_Manager::SELECT,
				'label_block' => true,
				'options' => Eac_Dynamic_Tags::get_elementor_templates('section'),
				'condition' => ['select_template' => 'section'],
			]
		);
	}
    
    public function get_value(array $options = []) {
		if($this->get_settings('select_template') === 'page') {
			$id = $this->get_settings('select_template_page');
		} else {
		    $id = $this->get_settings('select_template_section');
		}
		// Existe pas
		if(empty($id) || !get_post($id)) {
			return '';
		}
		
		// Évite la récursivité
		if(get_the_ID() === (int) $id) {
			//return 'Hoops!!!::' . \Elementor\Plugin::$instance->editor->is_edit_mode() . "==" . \Elementor\Plugin::$instance->preview->is_preview_mode() . "\\" . \Elementor\Plugin::$instance->db->is_built_with_elementor($id);
			return __('ID du modèle ne peut pas être le même que le modèle actuel', 'eac-components');
		}
		
		// Filtre wpml
		$id = apply_filters('wpml_object_id', $id, 'elementor_library', true);
		
	    $content = \Elementor\Plugin::$instance->frontend->get_builder_content_for_display($id, true);
		return $content;
	}
}