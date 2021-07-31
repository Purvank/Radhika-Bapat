<?php

/*=================================================================
* Class: Images_Comparison_Widget
* Name: Comparaison d'images
* Slug: eac-addon-images-comparison
*
* Description: Images_Comparison_Widget affiche deux images à titre de comparaison
*
* @since 0.0.9
* @since 1.7.0	Active les Dynamic Tags pour les images
*==================================================================*/
 
namespace EACCustomWidgets\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Scheme_Color;
use Elementor\Control_Media;
use Elementor\Utils;

if(! defined('ABSPATH')) exit; // Exit if accessed directly

class Images_Comparison_Widget extends Widget_Base {

    /*
    * Retrieve widget name.
    *
    * @access public
    *
    * @return widget name.
    */
    public function get_name() {
        return 'eac-addon-images-comparison';
    }

    /*
    * Retrieve widget title.
    *
    * @access public
    *
    * @return widget title.
    */
    public function get_title() {
        return __("Comparaison d'images", 'eac-components');
    }

    /*
    * Retrieve widget icon.
    *
    * @access public
    *
    * @return widget icon.
    */
    public function get_icon() {
        return 'eicon-image-before-after';
    }
	
	/* 
	* Affecte le composant à la catégorie définie dans plugin.php
	* 
	* @access public
    *
    * @return widget category.
	*/
	public function get_categories() {
		return ['eac-elements'];
	}
	
	/* 
	* Load dependent libraries
	* 
	* @access public
    *
    * @return libraries list.
	*/
	public function get_script_depends() {
		return ['eac-images-comparison', 'eac-imagesloaded', 'eac-waypoint'];
	}
	
    /*
    * Register widget controls.
    *
    * Adds different input fields to allow the user to change and customize the widget settings.
    *
    * @access protected
    */
    protected function _register_controls() {
        $this->start_controls_section('ic_gallery_content',
				[
					'label'     => __('Images & Étiquettes', 'eac-components'),
				]
			);
			
			// @since 1.7.0
			$this->add_control('ic_img_content_modified',
				[
					'name' => 'img_modified',
					'label' => __("Image de gauche", 'eac-components'),
					'type' => Controls_Manager::MEDIA,
					'dynamic' => ['active' => true],
					'default'       => [
						'url'	=> Utils::get_placeholder_image_src(),
					],
					'separator' => 'before',
				]
			);
			
			$this->add_control('ic_img_name_original',
				[
					'name' => 'name_original',
					'label' =>  __("Étiquette de gauche", 'eac-components'),
					'type' => Controls_Manager::TEXT,
					'default' => __('Étiquette de gauche', 'eac-components'),
					'placeholder' => __('Gauche', 'eac-components'),
					'label_block' => true,
				]
			);
			
			// @since 1.7.0
			$this->add_control('ic_img_content_original',
				[
					'name' => 'img_original',
					'label' => __("Image de droite", 'eac-components'),
					'type' => Controls_Manager::MEDIA,
					'dynamic' => ['active' => true],
					'default'       => [
						'url'	=> Utils::get_placeholder_image_src(),
					],
					'separator' => 'before',
				]
			);
			
			$this->add_control('ic_img_name_modified',
				[
					'name' => 'name_modified',
					'label' => __("Étiquette de droite", 'eac-components'),
					'type' => Controls_Manager::TEXT,
					'default' => __('Étiquette de droite', 'eac-components'),
					'placeholder' => __('Droite', 'eac-components'),
					'label_block'   => true,
				]
			);
			
		$this->end_controls_section();
		
		/**
		 * Generale Style Section
		 */
		$this->start_controls_section('etiquette_section_style',
			[
               'label' => __("Étiquettes", 'eac-components'),
               'tab' => Controls_Manager::TAB_STYLE,
			]
		);
			
			$this->add_control('ic_etiquette_color',
				[
					'label' => __("Couleur du texte", 'eac-components'),
					'type' => Controls_Manager::COLOR,
					'scheme' => [
						'type' => Scheme_Color::get_type(),
						'value' => Scheme_Color::COLOR_3,
					],
					'default' => '#FFF',
					'selectors' => [
						'{{WRAPPER}} .b-diff__title_before, {{WRAPPER}} .b-diff__title_after' => 'color: {{VALUE}};',
					],
					'separator' => 'none',
				]
			);
			
			$this->add_control('ic_etiquette_bgcolor',
				[
					'label' => __('Couleur du fond', 'eac-components'),
					'type' => Controls_Manager::COLOR,
					'scheme' => [
						'type' 	=> Scheme_Color::get_type(),
						'value' => Scheme_Color::COLOR_1,
					],
					'default' => '#919ca7',
					'selectors' => [
						'{{WRAPPER}} .b-diff__title_before, {{WRAPPER}} .b-diff__title_after' => 'background-color: {{VALUE}};',
					]
				]
			);
			
			$this->add_group_control(
			Group_Control_Typography::get_type(),
				[
					'name' => 'ic_etiquette_typography',
					'label' => __('Typographie', 'eac-components'),
					'scheme' => Scheme_Typography::TYPOGRAPHY_1,
					'selector' => '{{WRAPPER}} .b-diff__title_before, {{WRAPPER}} .b-diff__title_after',
				]
			);
			
		$this->end_controls_section();
    }

    /*
    * Render widget output on the frontend.
    *
    * Written in PHP and used to generate the final HTML.
    *
    * @access protected
    */
    protected function render() {
		$settings = $this->get_settings_for_display();
		
		$id = "a" . uniqid();
		$this->add_render_attribute('data_diff', 'class', 'images-comparison');
		$this->add_render_attribute('data_diff', 'data-diff', $id);
		$this->add_render_attribute('data_diff', 'data-settings', $this->get_settings_json($id));
		
		if(! $settings['ic_img_content_original'] && ! $settings['ic_img_content_modified']) {
			return;
		}
	?>
		<div class="eac-images-comparison">
			<div <?php echo $this->get_render_attribute_string('data_diff'); ?>>
				<?php $this->render_galerie(); ?>
			</div>
		</div>
		
	<?php
    }
	
	protected function render_galerie() {
		$settings = $this->get_settings_for_display();
		
		$original = $settings['ic_img_content_original']['url'] ? $settings['ic_img_content_original']['url'] : false;
		$original_alt = Control_Media::get_image_alt($settings['ic_img_content_original']);
		$image_original = wp_get_attachment_image_src($settings['ic_img_content_original']['id'], 'full');
		
		$modified = $settings['ic_img_content_modified']['url'] ? $settings['ic_img_content_modified']['url'] : false;
		$modified_alt = Control_Media::get_image_alt($settings['ic_img_content_modified']);
		$image_modified = wp_get_attachment_image_src($settings['ic_img_content_modified']['id'], 'full');
		
		$html = '';
		
		if($original && $modified) {
			// Image de gauche
			$this->add_render_attribute('img_src_1', 'class', 'eac-image-loaded');
			$this->add_render_attribute('img_src_1', 'src', $original);
			$this->add_render_attribute('img_src_1', 'width', $image_original[1]);
			$this->add_render_attribute('img_src_1', 'height', $image_original[2]);
			$this->add_render_attribute('img_src_1', 'data-title', $settings['ic_img_name_original']);
			$this->add_render_attribute('img_src_1', 'alt', $original_alt);
		
			// Image de droite
			$this->add_render_attribute('img_src_2', 'class', 'eac-image-loaded');
			$this->add_render_attribute('img_src_2', 'src', $modified);
			$this->add_render_attribute('img_src_2', 'width', $image_modified[1]);
			$this->add_render_attribute('img_src_2', 'height', $image_modified[2]);
			$this->add_render_attribute('img_src_2', 'data-title', $settings['ic_img_name_modified']);
			$this->add_render_attribute('img_src_2', 'alt', $modified_alt);
		
			$html .= '<img ' . $this->get_render_attribute_string('img_src_1') . ' />';
			$html .= '<img ' . $this->get_render_attribute_string('img_src_2') . ' />';
		}
			
		// nullifie les attributs html
		$this->set_render_attribute('img_src_1', 'data-src', null);
		$this->set_render_attribute('img_src_2', 'data-src', null);
		
		echo $html;
	}
	
	/*
	* get_settings_json()
	*
	* Retrieve fields values to pass at the widget container
    * Convert on JSON format
    * Read by 'eac-components.js' file when the component is loaded on the frontend
	*
	* @uses      json_encode()
	*
	* @return    JSON oject
	*
	* @access    protected
	* @since     0.0.9
	* @updated   1.0.7
	*/
	protected function get_settings_json($ordre) {		
		$settings = array(
			"data_diff" => "[data-diff=" . $ordre . "]",
		);
		
		$settings = json_encode($settings);
		return $settings;
	}
	
	protected function content_template() {}
}