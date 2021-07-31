<?php

/*=====================================================================================================================================
* Class: Plugin
*
* Description:  Active l'administration du plugin avec les droit d'Admin
*               Charge les fichiers CSS des composants
*               Enregistre les scripts JS des composants
*               Enregistre 'eac-components.js' avec le frontend Elementor
*               Enregistre les composants en fonction du paramétrage '$eac_elements_keys'
*               Enregistre la catégorie des composants du plugin
*
* @since 0.0.9
* @since 1.6.0  Ajout de script pour l'implémentation de l'éditeur en ligne du CSS 'Custom CSS' dans l'onglet 'Advanced'
*               Correctif ajout de la lib jqcloud pour le composant Instagram Location
* @since 1.6.2	Force le chargement de la Fancybox pour le 'Shortcode Image' et le Dynamic Tags 'External image'
* @since 1.6.3	Ajout de l'options 'all-components'
* @since 1.6.4	Ajout du composant 'syntax-highlight'
* @since 1.6.7	Correctif sur tous les repeater des widgets. Suppression de 'array_values'
*				Ajout du prefixe de debug sur les scripts
*				Changement de la méthode dépréciée '_content_template' Planned Deprecations 2.9.0
* @since 1.7.0	Ajout d'un fichier CSS pour styliser le panel de l'éditeur
* @since 1.7.1	Ajout du composant 'HTML Sitemap'
* @since 1.7.2	Décomposition de la class 'Eac_Helper_Utils' en deux class 'Eac_Helpers_Util' et 'Eac_Tools_Util'
* @since 1.X.X	TODO
*				Prévoir le changement du nom de la méthode dépréciée '_register_controls' Planned Deprecations 3.0
*				par sa version sans underscore '_' (Elementor v3.1.0)
*				Nomme le handler du script ISOTOPE 'isotope-js' pour éviter la collision avec 'PAFE' qui l'intègre aussi
*=====================================================================================================================================*/

namespace EACCustomWidgets;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * Main Plugin Class
 *
 * Enregistre les nouveaux composants.
 *
 * @since 0.0.9
 */
class Plugin {
	
	/**
	 * La liste des composants par leur slug
	 * Ajouter/Supprimer parallèlement les composants
	 * dans admin/settings/eac-components.php méthode 'eac_save_settings'
	 *
	 * @since 0.0.9
	 * @since 1.6.4
	 * @since 1.6.7
	 * @since 1.7.1
	 * 
	 * @access protected
	 */
	protected $eac_elements_keys = ['all-components', 'articles-liste', 'image-effects', 'image-galerie','image-promotion',
	'image-ribbon','image-ronde','images-comparison','kenburn-slider','slider-pro', 'reseaux-sociaux',
	'lecteur-rss', 'lecteur-audio', 'image-diaporama', 'pinterest-rss', 'instagram-explore', 'instagram-search',
	'instagram-user', 'instagram-location', 'chart', 'modal-box', 'syntax-highlight', 'html-sitemap'];
	
	// Instance de la page des réglages
	private $admin_settings;
	
	/**
	 * Constructor
	 *
	 * @since 0.0.9
	 *
	 * @access public
	 */
	public function __construct() {
		//  C'est un role Admin, chargement de la page de configuration des composants
		if(is_admin()) {
			require_once(__DIR__ . '/admin/settings/eac-components.php');
			$this->admin_settings = new \EACCustomWidgets\Admin\Settings\EAC_Admin_Settings($this->eac_elements_keys);
		}
		
		// Charge les outils, helper, shortcode et les extensions
		$this->load_features();
		
		// Charge les styles, scripts et les composants
		$this->add_actions();
	}
	
	/**
	 * Actions principales pour charger les styles, les scripts et les composants
	 *
	 * @since 0.0.9
	 *
	 * @access private
	 */
	private function add_actions() {
		// Crée le groupe de composants
		add_action('elementor/init', array($this, 'register_groups_components'));
		
		/**
		 * Actions pour enregistrer les scripts des composants
		 * 
		 * @since 0.0.9
		 */
		add_action('elementor/frontend/after_register_scripts', array($this, 'register_scripts'));
		
		/**
		 * Actions pour insérer les scripts obligatoires dans la file
		 * 
		 * @since 0.0.9
		 */
		add_action('elementor/frontend/before_enqueue_scripts', array($this, 'enqueue_scripts'));
		
		/**
		 * Actions pour enregistrer les styles et les mettre dans la file
		 * 
		 * @since 0.0.9
		 */
		add_action('elementor/frontend/after_register_styles', array($this, 'register_styles'));
		add_action('elementor/frontend/after_enqueue_styles', array($this, 'enqueue_styles'));
		//add_action('elementor/preview/enqueue_styles', array($this, 'enqueue_styles'));
		
		/**
		 * Enqueue les styles du panel Elementor
		 *
		 * @since 1.7.0
		 */
		add_action('elementor/editor/wp_head', array($this, 'eac_add_panel_admin'));
		
		/**
		 * Charge les outils et les extensions
		 * Enregistre les classes des composants
		 *
		 * @since 0.0.9
		 */
		add_action('elementor/widgets/widgets_registered', array($this, 'widgets_registered'));
	}
	
	/**
	 * Enregistre les styles dans le panel de l'éditeur Elementor
	 * Propriété 'content_classes' du control
	 * 
	 * @since 1.7.0
	 */
    public function eac_add_panel_admin(){
	    wp_enqueue_style('eac-editor-panel', plugins_url('/assets/css/eac-editor-panel.css', EAC_CUSTOM_FILE), false, '1.7.0');
    }
	
	/**
	 * Enregistre tous les styles
	 * 
	 * @since 0.0.9
	 */
	public function register_styles() {
		wp_register_style('eac', plugins_url('/assets/css/eac-components.css', EAC_CUSTOM_FILE), false, '0.0.9');
		wp_register_style('eac-image-fancybox', plugins_url('/assets/css/jquery.fancybox.css', EAC_CUSTOM_FILE), array('eac'), '3.5.7');
		wp_register_style('eac-tooltip', plugins_url('/assets/css/spiketip.min.css', EAC_CUSTOM_FILE), array('eac'), '1.0.6');
		
		wp_register_style('eac-articles-liste', plugins_url('/assets/css/articles-liste.css', EAC_CUSTOM_FILE), array('eac'), '0.0.9');
		wp_register_style('eac-image-ribbon', plugins_url('/assets/css/image-ribbon.css', EAC_CUSTOM_FILE), array('eac'), '0.0.9');
		wp_register_style('eac-images-comparison', plugins_url('/assets/css/images-comparison.css', EAC_CUSTOM_FILE), array('eac'), '0.0.9');
		wp_register_style('eac-image-effects', plugins_url('/assets/css/image-effects.css', EAC_CUSTOM_FILE), array('eac'), '0.0.9');
		wp_register_style('eac-image-promotion', plugins_url('/assets/css/image-promotion.css', EAC_CUSTOM_FILE), array('eac'), '0.0.9');
		wp_register_style('eac-image-ronde', plugins_url('/assets/css/image-ronde.css', EAC_CUSTOM_FILE), array('eac'), '0.0.9');
		wp_register_style('eac-image-galerie', plugins_url('/assets/css/image-galerie.css', EAC_CUSTOM_FILE), array('eac'), '0.0.9');
		wp_register_style('eac-smoothslides', plugins_url('/assets/css/kenburn-slider.css', EAC_CUSTOM_FILE), array('eac'), '0.0.9');
		wp_register_style('eac-slider-pro', plugins_url('/assets/css/slider-pro.css', EAC_CUSTOM_FILE), array('eac'), '0.0.9');
		wp_register_style('eac-reseaux-sociaux', plugins_url('/assets/css/reseaux-sociaux.css', EAC_CUSTOM_FILE), array('eac'), '0.0.9');
		wp_register_style('eac-lecteur-rss', plugins_url('/assets/css/lecteur-rss.css', EAC_CUSTOM_FILE), array('eac'), '1.0.0');
		wp_register_style('eac-pinterest-rss', plugins_url('/assets/css/pinterest-rss.css', EAC_CUSTOM_FILE), array('eac'), '1.2.0');
		wp_register_style('eac-audioplayer', plugins_url('/assets/css/lecteur-audio.css', EAC_CUSTOM_FILE), array('eac'), '1.0.0');
		wp_register_style('eac-diaporama', plugins_url('/assets/css/image-diaporama.css', EAC_CUSTOM_FILE), array('eac'), '1.0.0');
		wp_register_style('eac-instagram-explore', plugins_url('/assets/css/instagram-explore.css', EAC_CUSTOM_FILE), array('eac'), '1.3.0');
		wp_register_style('eac-instagram-search', plugins_url('/assets/css/instagram-search.css', EAC_CUSTOM_FILE), array('eac'), '1.3.0');
		wp_register_style('eac-instagram-user', plugins_url('/assets/css/instagram-user.css', EAC_CUSTOM_FILE), array('eac'), '1.3.0');
		wp_register_style('eac-instagram-location', plugins_url('/assets/css/instagram-location.css', EAC_CUSTOM_FILE), array('eac'), '1.4.0');
		wp_register_style('eac-jqcloud', plugins_url('/assets/css/jqcloud.css', EAC_CUSTOM_FILE), false, '2.0.3');
		wp_register_style('eac-leaflet', plugins_url('/assets/css/leaflet.css', EAC_CUSTOM_FILE), array('eac'), '1.5.1');
		wp_register_style('eac-chart', plugins_url('/assets/css/chart.css', EAC_CUSTOM_FILE), array('eac'), '2.9.3');
		wp_register_style('eac-modalbox', plugins_url('/assets/css/modal-box.css', EAC_CUSTOM_FILE), array('eac'), '1.6.1');
		wp_register_style('eac-syntax-highlight', plugins_url('/assets/css/prism.css', EAC_CUSTOM_FILE), array('eac'), '1.22.0');
		wp_register_style('eac-html-sitemap', plugins_url('/assets/css/html-sitemap.css', EAC_CUSTOM_FILE), array('eac'), '1.7.1');
	}
	
	/**
	 * Enqueue les styles pour les composants activés
	 * 
	 * @since 0.0.9
	 */
	public function enqueue_styles() {
		$eac_default_settings = array_fill_keys($this->eac_elements_keys, true);
		$check_component_active = get_option('eac_options_settings', $eac_default_settings);
			
		// Pour tous les composants
		wp_enqueue_style('eac');
		wp_enqueue_style('eac-image-fancybox');
		wp_enqueue_style('eac-tooltip');
		
		// ¨Pour les composants actifs
		if($check_component_active['articles-liste']) { wp_enqueue_style('eac-articles-liste'); }
		if($check_component_active['image-ribbon']) { wp_enqueue_style('eac-image-ribbon'); }
		if($check_component_active['images-comparison']) { wp_enqueue_style('eac-images-comparison'); }
		if($check_component_active['image-effects']) { wp_enqueue_style('eac-image-effects'); }
		if($check_component_active['image-ronde']) { wp_enqueue_style('eac-image-ronde'); }
		if($check_component_active['image-promotion']) { wp_enqueue_style('eac-image-promotion'); wp_enqueue_style('eac-image-ribbon'); }
		if($check_component_active['instagram-explore']) { wp_enqueue_style('eac-instagram-explore'); wp_enqueue_style('eac-jqcloud'); }
		if($check_component_active['instagram-search']) { wp_enqueue_style('eac-instagram-search'); }
		if($check_component_active['instagram-user']) { wp_enqueue_style('eac-instagram-user'); wp_enqueue_style('eac-jqcloud'); }
		if($check_component_active['instagram-location']) { wp_enqueue_style('eac-instagram-location'); wp_enqueue_style('eac-jqcloud'); wp_enqueue_style('eac-leaflet'); }
		if($check_component_active['image-galerie']) { wp_enqueue_style('eac-image-galerie'); }
		if($check_component_active['kenburn-slider']) { wp_enqueue_style('eac-smoothslides'); }
		if($check_component_active['slider-pro']) { wp_enqueue_style('eac-slider-pro'); }
		if($check_component_active['reseaux-sociaux']) { wp_enqueue_style('eac-reseaux-sociaux'); }
		if($check_component_active['lecteur-rss']) { wp_enqueue_style('eac-lecteur-rss'); }
		if($check_component_active['pinterest-rss']) { wp_enqueue_style('eac-pinterest-rss'); }
		if($check_component_active['lecteur-audio']) { wp_enqueue_style('eac-audioplayer'); }
		if($check_component_active['image-diaporama']) { wp_enqueue_style('eac-diaporama'); }
		if($check_component_active['chart']) { wp_enqueue_style('eac-chart'); }
		if($check_component_active['modal-box']) { wp_enqueue_style('eac-modalbox'); }
		if($check_component_active['syntax-highlight']) { wp_enqueue_style('eac-syntax-highlight'); }
		if($check_component_active['html-sitemap']) { wp_enqueue_style('eac-html-sitemap'); }
	}
	
	/**
	 * Enregistre les scripts pour les composants activés
	 * Chargés comme dépendance de chaque widget. Méthode 'get_script_depends'
	 * 
	 * @since 0.0.9
	 * @since 1.6.4 Le script "prism.js" est directement chargé comme "Syntaxe Heredoc" dans la class "Syntax_Highlighter_Widget"
	 */
	public function register_scripts() {
		// @since 1.6.7
		$suffix = EAC_SCRIPT_DEBUG ? '.js' : '.min.js';
		
		$eac_default_settings = array_fill_keys($this->eac_elements_keys, true);
		$check_component_active = get_option('eac_options_settings', $eac_default_settings);
		
		// Le gestionnaires d'image est toujours enregistré
		wp_register_script('eac-imagesloaded', EAC_ADDONS_URL . 'assets/js/masonry/imagesloaded.pkgd.min.js', array('jquery'), '4.1.4', true);
		
		if($check_component_active['articles-liste']) {
			wp_register_script('isotope-js', EAC_ADDONS_URL . 'assets/js/isotope/isotope.pkgd.min.js', array('jquery'), '3.0.6', true);
			wp_register_script('eac-infinite-scroll', EAC_ADDONS_URL . 'assets/js/isotope/infinite-scroll.pkgd.min.js', array('jquery'), '3.0.5', true);
		}
		if($check_component_active['images-comparison']) {
			wp_register_script('eac-waypoint', EAC_ADDONS_URL . 'assets/js/waypoint/jquery.waypoints.min.js', array('jquery'), '4.0.1', true);
			wp_register_script('eac-images-comparison', EAC_ADDONS_URL . 'assets/js/comparison/images-comparison.min.js', array('jquery'), EAC_ADDONS_VERSION, true);
		}
		if($check_component_active['image-galerie']) {
			wp_register_script('isotope-js', EAC_ADDONS_URL . 'assets/js/isotope/isotope.pkgd.min.js', array('jquery'), '3.0.6', true);
			wp_register_script('eac-collageplus', EAC_ADDONS_URL . 'assets/js/masonry/jquery.collagePlus.min.js', array('jquery'), '0.3.3', true);
		}
		if($check_component_active['kenburn-slider']) {
			wp_register_script('eac-smoothslides', EAC_ADDONS_URL . 'assets/js/kenburnslider/smoothslides.min.js', array('jquery'), '2.2.1', true);
		}
		if($check_component_active['slider-pro']) {
			wp_register_script('eac-sliderpro', EAC_ADDONS_URL . 'assets/js/sliderpro/jquery.sliderPro.min.js', array('jquery'), '1.4.0', true);
			wp_register_script('eac-transit', EAC_ADDONS_URL . 'assets/js/transit/jquery.transit.min.js', array('jquery'), '0.9.12', true);
		}
		if($check_component_active['reseaux-sociaux']) {
			wp_register_script('eac-reseaux-sociaux', EAC_ADDONS_URL . 'assets/js/socialshare/floating-social-share.min.js', array('jquery'),  EAC_ADDONS_VERSION, true);
		}
		if($check_component_active['lecteur-audio']) {
			wp_register_script('eac-lecteur-audio', EAC_ADDONS_URL . 'assets/js/audioplayer/player.min.js', array('jquery'),  EAC_ADDONS_VERSION, true);
		}
		if($check_component_active['instagram-search']) {
			wp_register_script('isotope-js', EAC_ADDONS_URL . 'assets/js/isotope/isotope.pkgd.min.js', array('jquery'), '3.0.6', true);
			wp_register_script('eac-instagram-search', EAC_ADDONS_URL . 'assets/js/instagram/instagram-search' . $suffix, array('jquery'), EAC_ADDONS_VERSION, true);
		}
		if($check_component_active['instagram-explore']) {
			wp_register_script('isotope-js', EAC_ADDONS_URL . 'assets/js/isotope/isotope.pkgd.min.js', array('jquery'), '3.0.6', true);
			wp_register_script('eac-jqcloud', EAC_ADDONS_URL . 'assets/js/jqcloud/jqcloud.min.js', array('jquery'), '2.0.3', true);
			wp_register_script('eac-instagram-explore', EAC_ADDONS_URL . 'assets/js/instagram/instagram-explore' . $suffix, array('jquery'), EAC_ADDONS_VERSION, true);
		}
		if($check_component_active['instagram-user']) {
			wp_register_script('isotope-js', EAC_ADDONS_URL . 'assets/js/isotope/isotope.pkgd.min.js', array('jquery'), '3.0.6', true);
			wp_register_script('eac-jqcloud', EAC_ADDONS_URL . 'assets/js/jqcloud/jqcloud.min.js', array('jquery'), '2.0.3', true);
			wp_register_script('eac-instagram-user', EAC_ADDONS_URL . 'assets/js/instagram/instagram-user' . $suffix, array('jquery'), EAC_ADDONS_VERSION, true);
		}
		if($check_component_active['instagram-location']) {
			wp_register_script('isotope-js', EAC_ADDONS_URL . 'assets/js/isotope/isotope.pkgd.min.js', array('jquery'), '3.0.6', true);
			wp_register_script('eac-jqcloud', EAC_ADDONS_URL . 'assets/js/jqcloud/jqcloud.min.js', array('jquery'), '2.0.3', true);
			wp_register_script('eac-leaflet', EAC_ADDONS_URL . 'assets/js/leaflet/leaflet.js', array(), '1.5.1', true);
			wp_register_script('eac-instagram-location', EAC_ADDONS_URL . 'assets/js/instagram/instagram-location' . $suffix, array('jquery'), EAC_ADDONS_VERSION, true);
		}
		if($check_component_active['chart']) {
			wp_register_script('eac-chart-src', EAC_ADDONS_URL . 'assets/js/chart/chart.min.js', '', '2.9.3', true);
			wp_register_script('eac-chart-color', EAC_ADDONS_URL . 'assets/js/color/randomColor.min.js', '', '2.9.3', true);
			wp_register_script('eac-chart-label', EAC_ADDONS_URL . 'assets/js/chart/chartjs-plugin-datalabels.min.js', '', '0.7.0', true);
			wp_register_script('eac-chart-style', EAC_ADDONS_URL . 'assets/js/chart/chartjs-plugin-style.min.js', '', '0.5.0', true);
			wp_register_script('eac-chart', EAC_ADDONS_URL . 'assets/js/chart/eac-chart' . $suffix, array('jquery'), EAC_ADDONS_VERSION, true);
		}
	}
	
	/**
	 * Enregistre les scripts obligatoires
	 * 
	 * @since 0.0.9
	 */
	public function enqueue_scripts() {
		// @since 1.6.7
		$suffix = EAC_SCRIPT_DEBUG ? '.js' : '.min.js';
		/**
		 * @since 1.6.2 La Fancybox est toujours chargée pour le 'Shortcode Image' et le Dynamic Tags 'External image'
		 * qui peuvent être insérés dans un article/page sans composant
		 */
		wp_enqueue_script('eac-fancybox', EAC_ADDONS_URL . 'assets/js/fancybox/jquery.fancybox' . $suffix, array('jquery'), '3.5.7', true);
		
		// Le script principal qui exécute le code de chaque composant quand il est affiché dans la page
		wp_enqueue_script('eac-elements', EAC_ADDONS_URL . 'assets/js/eac-components' . $suffix, array('jquery', 'elementor-frontend'), EAC_ADDONS_VERSION, true);
		
		// Passe l'url absolue du plugin aux objects javascript -> ajaxCallRss
		wp_localize_script('eac-elements', 'eacElements', array('pluginsUrl' => plugins_url('', __FILE__)));
	}
    
	/**
	 * Event On Widgets Registered
	 *
	 * @since 0.0.9
	 *
	 * @access public
	 */
	public function widgets_registered() {
		$this->register_components();
	}
    
	/**
	 * Exclusion Lazyload de WP Rocket des images portants la class 'eac-image-loaded'
	 * 
	 * @since 1.0.0
	 */
	public function rocket_lazyload_exclude_class($attributes) {
		$attributes[] = 'class="eac-image-loaded'; // Ne pas fermer les doubles quotes
		return $attributes;
	}
	
	/**
	 * Charge les outils, helper, les shortcodes et les extensions (CSS, Dynamic Tags, Attributs)
	 *
	 * @since 1.7.3
	 *
	 * @access private
	 */
	private function load_features() {
		/**
		 * Filtre Lazyload de WP Rocket
		 * 
		 * @since 1.0.0
		 */
		add_filter('rocket_lazyload_excluded_attributes', array($this, 'rocket_lazyload_exclude_class'));
		
		/**
		 * Ajout des shortcodes Image externe, Templates Elementor et colonne vue Templates Elementor
		 * 
		 * @since 1.5.3	Instagram
		 * @since 1.6.0	Image externe, Image media et Templates Elementor
		 * @since 1.6.1 Suppression du shortcode 'Instagram'
		 * @since 1.6.3 Suppression du shortcode 'Image media'
		 */
		require_once(__DIR__ . '/includes/eac-shortcode.php');
		
		/**
		 * Implémente la mise à jour du plugin ainsi que sa fiche détails
		 * 
		 * @since 1.6.5
		 */
		require_once(__DIR__ . '/includes/eac-update-plugin.php');
		
		/**
		 * Utils pour tous les composants et les extensions
		 * 
		 * @since 1.7.2
		 */
		require_once(__DIR__ . '/includes/eac-tools.php');
		
		/**
		 * Helper pour le composant Post Grid
		 * 
		 * @since 1.7.2
		 */
		require_once(__DIR__ . '/includes/eac-helpers.php');
		
		/**
		 * Ajout de l'éditeur CSS en ligne à Elementor (Textarea Custom CSS 'Onglet Avancé')
		 * L'éditeur sera toujours actif même en désactivant tous les composants
		 * 
		 * @since 1.6.0
		 */
		require_once(__DIR__ . '/includes/elementor/custom-css/eac-custom-css.php');
		
		/**
		 * Ajout des balises dynamiques (Dynamic Tags for Elementor)
		 * Les balises dynamiques seront toujours actives même en désactivant tous les composants
		 * 
		 * @since 1.6.0
		 */
		require_once(__DIR__ . '/includes/elementor/dynamic-tags/eac-dynamic-tags.php');
		
		/**
		 * Injection d'un champ texte pour valoriser l'attribut ALT notamment du Dynamic Tags 'External image'
		 * Champ injecté dans les widgets 'Image', 'Image-box' et 'Modalbox'
		 * 
		 * @since 1.6.3
		 * @since 1.6.6
		 */
		require_once(__DIR__ . '/includes/elementor/injection/eac-injection-image.php');
		
		/**
		 * Ajout d'un champ 'Attributs' onglet 'Advanced' à Elementor pour les Sections, Columns et Widgets
		 * Le champ sera toujours actif même en désactivant tous les composants
		 * 
		 * @since 1.6.6
		 */
		require_once(__DIR__ . '/includes/elementor/custom-attributes/eac-custom-attributes.php');
	}
	
	/**
	 * Enregistre les composants actifs
	 *
	 * @since 0.0.9
	 *
	 * @access private
	 */
	private function register_components() {
		$eac_default_settings = array_fill_keys($this->eac_elements_keys, true);
		$check_component_active = get_option('eac_options_settings', $eac_default_settings);
		
		if($check_component_active['articles-liste']) {
			require_once(__DIR__ . '/widgets/articles-liste.php');
			\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new \EACCustomWidgets\Widgets\Articles_Liste_Widget());
		}
		if($check_component_active['image-galerie']) {
			require_once(__DIR__ . '/widgets/image-galerie.php');
			\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new \EACCustomWidgets\Widgets\Image_Galerie_Widget());
		}
		if($check_component_active['slider-pro']) {
			require_once(__DIR__ . '/widgets/slider-pro.php');
			\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new \EACCustomWidgets\Widgets\Slider_Pro_Widget());
		}
		if($check_component_active['chart']) {
			require_once(__DIR__ . '/widgets/chart.php');
			\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new \EACCustomWidgets\Widgets\Chart_Widget());
		}
		if($check_component_active['modal-box']) {
			require_once(__DIR__ . '/widgets/modal-box.php');
			\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new \EACCustomWidgets\Widgets\Modal_Box_Widget());
		}
		if($check_component_active['syntax-highlight']) {
			require_once(__DIR__ . '/widgets/syntax-highlighter.php');
			\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new \EACCustomWidgets\Widgets\Syntax_Highlighter_Widget());
		}
		if($check_component_active['instagram-search']) {
			require_once(__DIR__ . '/widgets/instagram-search.php');
			\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new \EACCustomWidgets\Widgets\Instagram_Search_Widget());
		}
		if($check_component_active['instagram-user']) {
			require_once(__DIR__ . '/widgets/instagram-user.php');
			\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new \EACCustomWidgets\Widgets\Instagram_User_Widget());
		}
		if($check_component_active['instagram-explore']) {
			require_once(__DIR__ . '/widgets/instagram-explore.php');
			\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new \EACCustomWidgets\Widgets\Instagram_Explore_Widget());
		}
		if($check_component_active['instagram-location']) {
			require_once(__DIR__ . '/widgets/instagram-location.php');
			\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new \EACCustomWidgets\Widgets\Instagram_Location_Widget());
		}
		/** @since 1.7.1 */
		if($check_component_active['html-sitemap']) {
			require_once(__DIR__ . '/widgets/html-sitemap.php');
			\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new \EACCustomWidgets\Widgets\Html_Sitemap_Widget());
		}
		if($check_component_active['lecteur-rss']) {
			require_once(__DIR__ . '/widgets/lecteur-rss.php');
			\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new \EACCustomWidgets\Widgets\Lecteur_Rss_Widget());
		}
		if($check_component_active['lecteur-audio']) {
			require_once(__DIR__ . '/widgets/lecteur-audio.php');
			\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new \EACCustomWidgets\Widgets\Lecteur_Audio_Widget());
		}
		if($check_component_active['pinterest-rss']) {
			require_once(__DIR__ . '/widgets/pinterest-rss.php');
			\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new \EACCustomWidgets\Widgets\Pinterest_Rss_Widget());
		}
		if($check_component_active['image-diaporama']) {
			require_once(__DIR__ . '/widgets/image-diaporama.php');
			\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new \EACCustomWidgets\Widgets\Image_Diaporama_Widget());
		}
		if($check_component_active['kenburn-slider']) {
			require_once(__DIR__ . '/widgets/kenburn-slider.php');
			\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new \EACCustomWidgets\Widgets\KenBurn_Slider_Widget());
		}
		if($check_component_active['images-comparison']) {
			require_once(__DIR__ . '/widgets/images-comparison.php');
			\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new \EACCustomWidgets\Widgets\Images_Comparison_Widget());
		}
		if($check_component_active['image-effects']) {
			require_once(__DIR__ . '/widgets/image-effects.php');
			\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new \EACCustomWidgets\Widgets\Image_Effects_Widget());
		}
		if($check_component_active['image-ribbon']) {
			require_once(__DIR__ . '/widgets/image-ribbon.php');
			\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new \EACCustomWidgets\Widgets\Image_Ribbon_Widget());
		}
		if($check_component_active['image-ronde']) {
			require_once(__DIR__ . '/widgets/image-ronde.php');
			\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new \EACCustomWidgets\Widgets\Image_Ronde_Widget());
		}
		if($check_component_active['image-promotion']) {
			require_once(__DIR__ . '/widgets/image-promotion.php');
			\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new \EACCustomWidgets\Widgets\Image_Promotion_Widget());
		}
		if($check_component_active['reseaux-sociaux']) {
			require_once(__DIR__ . '/widgets/reseaux-sociaux.php');
			\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new \EACCustomWidgets\Widgets\Reseaux_Sociaux_Widget());
		}
	}
	
	/**
	 * Crée la catégorie des composants
	 * 
	 * @since 0.0.9
	 */
	public function register_groups_components() {
		\Elementor\Plugin::instance()->elements_manager->add_category('eac-elements',
			array('title' => __('EAC Composants', 'eac-components'), 'icon' => 'fa fa-plug'), 1);
	}
}

new Plugin();