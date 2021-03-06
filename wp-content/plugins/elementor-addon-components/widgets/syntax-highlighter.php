<?php

/*========================================================================================================
* Class: Syntax_Highlighter_Widget
* Name: Surligneur de syntaxe
* Slug: eac-addon-syntax-highlighter
*
* Description: Mise en relief de la syntaxe d'un code source dans différentes couleurs et polices (Thème)
* relatif au language utilisé.
*
* 
* @since 1.6.4
* @since 1.6.5 Ajout du thème Oceanic
*========================================================================================================*/

namespace EACCustomWidgets\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Scheme_Color;

if(! defined('ABSPATH')) exit; // Exit if accessed directly

class Syntax_Highlighter_Widget extends Widget_Base {
	
	public function __construct($data = [], $args = null) {
      parent::__construct($data, $args);

      //wp_enqueue_script('eac-prism', EAC_ADDONS_URL . 'assets/js/syntax/prism.js', ['elementor-editor'], '1.22.0', true);
	  //wp_register_style('eac-prism', plugins_url('/assets/css/prism.css', EAC_CUSTOM_FILE), false, '1.22.0');
   }
   
    /*
    * Retrieve widget name.
    *
    * @access public
    *
    * @return widget name.
    */
    public function get_name() {
        return 'eac-addon-syntax-highlighter';
    }

    /*
    * Retrieve widget title.
    *
    * @access public
    *
    * @return widget title.
    */
    public function get_title() {
        return __("Coloration syntaxique", 'eac-components');
    }

    /*
    * Retrieve widget icon.
    *
    * @access public
    *
    * @return widget icon.
	* https://char-map.herokuapp.com/
    */
    public function get_icon() {
        return 'eicon-code';
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
		return [''];
	}
	
	/* 
	 * Load dependent styles
	 * 
	 * Les styles sont chargés dans le footer !!
     *
     * @return libraries list.
	 */
	public function get_style_depends() {
		return [''];
	}
	
    /*
    * Register widget controls.
    *
    * Adds different input fields to allow the user to change and customize the widget settings.
    *
    * @access protected
    */
	protected function _register_controls() {
        
		/**
		 * Generale Style Section
		 */
        $this->start_controls_section('sh_syntax_highlighter',
			[
				'label'     => __('Contenu', 'eac-components'),
				'tab'        => Controls_Manager::TAB_CONTENT,
			]
		);
			
			$this->add_control('sh_syntax_language',
				[
					'label' => __('Langage', 'eac-components'),
					'type' => Controls_Manager::SELECT,
					'default' => 'php',
					'options' => [
						'css'		=> 'CSS',
						'html'		=> 'HTML',
						'javascript' => 'Javascript',
						'json'		=> 'JSON',
						'markdown'	=> 'MD',
						'php'		=> 'PHP',
						'python'	=> 'Python',
						'rss'		=> 'RSS',
						'sass'		=> 'Sass',
						'scss'		=> 'Scss',
						'sql'		=> 'SQL',
						'svg'		=> 'SVG',
						'twig'		=> 'Twig',
						'xml'		=> 'XML',
					],
				]
			);
			
			$this->add_control('sh_syntax_linenumbers',
				[
					'label' => __("Numéros de ligne", 'eac-components'),
					'type' => Controls_Manager::SWITCHER,
					'label_on' => __('oui', 'eac-components'),
					'label_off' => __('non', 'eac-components'),
					'return_value' => 'yes',
					'default' => '',
				]
			);
			
			$this->add_control('sh_syntax_code',
				[
					'label' => __('Code', 'eac-components'),
					'type' => Controls_Manager::CODE,
					'language' => 'text',
					'rows' => 30,
				]
			);
			
		$this->end_controls_section();
		
		/**
		 * Generale Style Section
		 */
		$this->start_controls_section('sh_general_style',
			[
				'label'      => __('Style', 'eac-components'),
				'tab'        => Controls_Manager::TAB_STYLE,
			]
		);
			
			$this->add_control('sh_syntax_height',
				[
					'label' => __('Hauteur', 'eac-components'),
					'type' => Controls_Manager::SLIDER,
					'size_units' => ['px'],
					'range' => ['px' => ['min' => 200, 'max' => 1500, 'step' => 10]],
					'label_block' => true,
					'selectors' => ['{{WRAPPER}} pre[class*="language-"]' => 'max-height: {{SIZE}}{{UNIT}};'],
				]
			);
			
			/** @since 1.6.5 Thème Oceanic */
			$this->add_control('sh_syntax_theme',
				[
					'label' => __('Choix du thème', 'eac-components'),
					'type' => Controls_Manager::SELECT,
					'default' => 'default',
					'options' => [
						'default'	=> __('Défaut', 'eac-components'),
						'coy'		=> 'Coy',
						'dark'		=> 'Dark',
						'funky'		=> 'Funky',
						'oceanic'	=> 'Oceanic',
						'okaidia'	=> 'Okaidia',
						'tomorrow-night' => 'Tomorrow-night',
						'twilight'	=> 'Twilight',
					],
				]
			);
			
			$this->add_control('sh_syntax_typo_alert',
				[
					'type' => Controls_Manager::RAW_HTML,
					'raw'  => __('<span style="font-size:11px;font-style:italic;color:#B7B2B2;line-height:1.4em">Ne modifier pas la taille de la fonte si les numéros de ligne sont affichés</span>', 'eac-components'),
				]
			);
			
			$this->add_group_control(
			Group_Control_Typography::get_type(),
				[
					'name' => 'sh_syntax_typo',
					'label' => __('Typographie', 'eac-components'),
					'scheme' => Scheme_Typography::TYPOGRAPHY_1,
					'selector' => '{{WRAPPER}} pre[class*="language-"]',
				]
			);
			
			$this->add_control('sh_syntax_bg_color',
				[
					'label' => __('Couleur du fond', 'eac-components'),
					'type' => Controls_Manager::COLOR,
					'scheme' => [
						'type' => Scheme_Color::get_type(),
						'value' => Scheme_Color::COLOR_4,
					],
					'selectors' => ['{{WRAPPER}} pre[class*="language-"]' => 'background-color: {{VALUE}};'],
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
		$pre_class = '';
		$code_class = '';
		if(empty($settings['sh_syntax_code'])) { return; }
		
		// Le language sélectionné
		$language = $settings['sh_syntax_language'];
		
		// Convertit tous les caractères éligibles en entités HTML
		$syntax_code = htmlentities($settings['sh_syntax_code']);
		
		// Numérotage des lignes
		$line_num = $settings['sh_syntax_linenumbers'] === 'yes' ? 'line-numbers' : '';
		
		$pre_class .= $settings['sh_syntax_theme'];
		$pre_class .= ' language-' . $language;
		$pre_class .= $settings['sh_syntax_linenumbers'] === 'yes' ? ' line-numbers' : '';
		
		$code_class .= $settings['sh_syntax_theme'];
		$code_class .= ' language-' . $language;
		
		$this->add_render_attribute('pre_class', 'class', $pre_class);
		$this->add_render_attribute('code_class', 'class', $code_class);
		
		$pre = "<pre " . $this->get_render_attribute_string('pre_class') . ">";
		$code = $pre . "<code " . $this->get_render_attribute_string('code_class') . ">" . $syntax_code . "</code></pre>";
		
		echo $code;
		echo $this->load_script_code();
	}

	// Rrrrh !!! On doit charger le script sous le widget 'code' sinon le preview dans l'éditeur ne s'affiche pas
	// Syntaxe Heredoc
	private function load_script_code() {
		$id = $this->get_id();
		$url = EAC_ADDONS_URL . 'assets/js/syntax/prism.js?ver=1.22.0';
		return <<<EOT
<script>
var eac_core_prism = document.createElement('script');
eac_core_prism.setAttribute('type', 'text/javascript');
eac_core_prism.setAttribute('src', '$url');
eac_core_prism.setAttribute('id', '$id');
document.body.appendChild(eac_core_prism);
</script>
EOT;
	}
	
	protected function content_template() {}
	
}