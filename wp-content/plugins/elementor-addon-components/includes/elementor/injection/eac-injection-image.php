<?php

// @since 1.6.3 Image widget
add_action('elementor/element/image/section_image/before_section_end', 'add_image_custom_injection', 10, 2);
// @since 1.6.5 Modalbox widget
add_action('elementor/element/eac-addon-modal-box/mb_param_trigger/before_section_end', 'add_modalbox_custom_injection', 10, 2);
// @since 1.6.6 Image-box widget
add_action('elementor/element/image-box/section_image/before_section_end', 'add_image_custom_injection', 10, 2);

/**
 * add_modalbox_custom_injection
 *
 * Inject le control TEXT pour valoriser l'attribut ALT dans le widget 'eac-addon-modal-box'
 * notamment lorsque le dynamic tag 'External image' est sélectionné
 *
 * @param Element_Base $element The edited element.
 * @param array  $args Section arguments.
 *
 * @since 1.6.5	Modalbox widget
 * @since 1.6.6	Ajour d'une condition
 */
function add_modalbox_custom_injection($element, $args) {
	
	// start injection of control before an other control
	$element->start_injection([
		'at' => 'after',
		'of' => 'mb_display_image',
	]);
		// Ajoute le control Attribut ALT
		$element->add_control('image_link_alt',
			[
				'label' => __('Attribut ALT', 'eac-components'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => '',
				'description' => __("Valoriser l'attribut 'ALT' pour une image externe (SEO)", 'eac-components'),
				'label_block' => true,
				'render_type' => 'none',
				'condition' => ['mb_origin_trigger' => 'image'],
			]
		);
		
	// end injection just after
	$element->end_injection();
}

/**
 * add_image_custom_injection
 *
 * Inject le control TEXT pour valoriser l'attribut ALT dans le widget 'image'
 * notamment lorsque le dynamic tag 'External image' est sélectionné
 *
 * @param Element_Base $element The edited element.
 * @param array  $args Section arguments.
 *
 * @since 1.6.3
 * @since 1.6.6	Image-box widget
 */
function add_image_custom_injection($element, $args) {
	
	// start injection of control before an other control
	$element->start_injection([
		'at' => 'after',
		'of' => 'image',
	]);
		// Ajoute le control Attribut ALT
		$element->add_control('image_link_alt',
			[
				'label' => __('Attribut ALT', 'eac-components'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => '',
				'description' => __("Valoriser l'attribut 'ALT' pour une image externe (SEO)", 'eac-components'),
				'label_block'	=> true,
				'render_type' => 'none',
				//'condition' => ['image[url]!' => '']
			]
		);
		
	// end injection just after
	$element->end_injection();
}

/**
 * add_image_custom_attribute
 *
 * Modifie l'attribut ALT du widget 'image'
 *
 * @param HTML Content
 * @param Widget settings
 * @since 1.6.3
 * @since 1.6.5	Modalbox widget
 * @since 1.6.6	Image-box widget
 */
add_action('elementor/widget/render_content', 'add_image_custom_attribute', 10, 2);
function add_image_custom_attribute($content, $widget) {
	// Wiget image, image-box ou Modalbox
	if('image' === $widget->get_name() || 'image-box' === $widget->get_name() || 'eac-addon-modal-box' === $widget->get_name()) {
		// get widget image setting
		$settings = $widget->get_settings_for_display();
		
		// Le champ n'est pas vide et l'attribut ALT n'est pas renseigné
		if(isset($settings['image_link_alt']) && !empty($settings['image_link_alt'])) {
			$content_attr_alt = str_replace('alt=""', 'alt="' . sanitize_text_field($settings['image_link_alt']) . '"', $content);
			$content = $content_attr_alt;
		}
	}
	// return modified content or original content
	return $content;
}