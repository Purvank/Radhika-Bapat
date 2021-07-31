<?php

/*=====================================================================================
* Description: Gère l'interface d'administration des composantrs EAC 'EAC Components'
* et des options de la BDD.
* Cette class est instanciée dans 'plugin.php' par le rôle administrateur.
* 
* Charge le css 'admin-css' et le script 'admin-js' d'administration des composants.
* Ajoute l'item 'EAC Components' dans les menus de la barre latérale
* Charge le formulaire HTML de la page d'admin.
*
* Pour ajouter/supprimer un élément :
* - Le tableau '$eac_elements_keys' dans 'plugin.php' doit être modifié
* - Ajouter/Supprimer une entrée dans le formulaire respectif 'eac-components_tabX.php'
* - Modifier la méthode 'eac_save_settings'
*
* @since 0.0.9
* @since 1.4.0	Amélioration de la gestion des options
* @since 1.4.1	Gestion des options Instagram
* @since 1.6.2	Suppression de la gestion et des options Instagram
* @since 1.6.3	Ajout de l'option 'all-components' et 'modal-box'
* @since 1.6.4	Ajout de l'option 'syntax-highlight'
* @since 1.7.1	Ajout de l'option 'html-sitemap'
*=====================================================================================*/

namespace EACCustomWidgets\Admin\Settings;

if(! defined('ABSPATH')) exit(); // Exit if accessed directly

class EAC_Admin_Settings {
    
    private $page_slug = 'eac-components';	// Le slug du plugin
	private $eac_elements_keys;				// La liste des composants par leur slug
    private $eac_default_settings;
    private $eac_settings_keys;
    private $eac_get_settings;
	private $eac_options_settings = 'eac_options_settings';
	private $eac_options_instagram = 'eac_options_instagram';
	
	/**
	 * Constructor
	 *
	 * @param La liste des composants par leur slug
	 * 
	 * @since 0.0.9
	 */
    public function __construct(array $elements_keys = []) {
		if(empty($elements_keys)) {
			exit;
		}
		// Affecte le tableau d'éléments
		$this->eac_elements_keys = $elements_keys;
		
		// @since 1.6.2 Suppression des options Instagram si elles existent
		if(get_option($this->eac_options_instagram)) { delete_option($this->eac_options_instagram); }
		
		// Lancement des actions
		add_action('admin_menu', array($this, 'eac_admin_menu'));
		add_action('admin_enqueue_scripts', array($this, 'eac_admin_page_scripts'));
		add_action('wp_ajax_eac_save_settings', array($this, 'eac_save_settings'));
    }
	
	/**
	 * eac_admin_menu
	 *
	 * Création du nouveau menu dans la barre latérale
	 *
	 * @since 0.0.9
	 */
    public function eac_admin_menu() {
		$plugin_name = __('EAC composants', 'eac-components');
        add_menu_page($plugin_name, $plugin_name , 'manage_options', $this->page_slug, array($this , 'eac_admin_page'), 'dashicons-admin-tools', 100);
    }
	
	/**
	 * eac_admin_page_scripts
	 *
	 * Charge le css 'admin-css' et le script 'admin-js' d'administration des composants
	 * Lance le chargement des options
	 *
	 * @since 0.0.9
	 */
	public function eac_admin_page_scripts() {
		wp_enqueue_style('admin-css', plugins_url('/admin/css/eac-admin.css', EAC_CUSTOM_FILE));
		wp_register_script('admin-js', EAC_ADDONS_URL . 'admin/js/eac-admin.js', array('jquery'), EAC_ADDONS_VERSION, true);
		wp_enqueue_script('admin-js');
		
		// Sauve les options par défaut si elles n'existent pas
		if(get_option($this->eac_options_settings) == false) {
			$eac_dflt_sets = array_fill_keys($this->eac_elements_keys, true);
			update_option($this->eac_options_settings, $eac_dflt_sets);
		} else {
			// Charge les options
			$this->eac_admin_options();
		}
	}
	
	/**
	 * eac_admin_page
	 *
	 * Passe les paramètres au script 'admin-js' 'eac-admin.js'
	 * Charge les templates de la page d'administration
	 *
	 * @since 0.0.9
	 */
    public function eac_admin_page() {
		// Paramètres passés au script Ajax
        $settings_dflt = array(
			'ajaxurl'		=> admin_url('admin-ajax.php'),	// Le chemin 'admin-ajax.php'
			'ajaxaction'	=> 'eac_save_settings',			// Action/Méthode appelé en fin de script Ajax
		);
		wp_localize_script('admin-js', 'settings', $settings_dflt);
		
		// Charge les options
		$this->eac_admin_options();
		
		// Charge les templates
		include_once('eac-components_header.php');
		include_once('eac-components_tabs-nav.php');
	?>
		<div class="tabs-stage">
			<?php include_once('eac-components_tab1.php'); ?>
		</div>
	<?php
	}
	
	/**
	 * eac_admin_options
	 *
	 * Charge les options après comparaison 'EAC components' et BDD
	 * Méthode appelée au chargement de l'administration et ouverture de la page de configuration
	 *
	 * @since 1.4.0
	 */
	private function eac_admin_options() {
		
		// Toutes les options sont à true par défaut
        $this->eac_default_settings = array_fill_keys($this->eac_elements_keys, true);
		
		// Récupère les options dans la BDD
        $this->eac_get_settings = get_option($this->eac_options_settings, $this->eac_default_settings);
		
		// Compare les options par défaut et celles de la BDD
        $eac_new_settings = array_diff_key($this->eac_default_settings, $this->eac_get_settings);
		
		// Si c'est différent, mets à jour la BDD
        if(! empty($eac_new_settings)) {
            $eac_updated_settings = array_merge($this->eac_get_settings, $eac_new_settings);
            update_option($this->eac_options_settings, $eac_updated_settings);
        }
		// Maintenant on charge les options
		$this->eac_get_settings = get_option($this->eac_options_settings, $this->eac_default_settings);
	}
	
	/**
	 * eac_save_settings
	 *
	 * Méthode appelée depuis le script 'admin-js'
	 * Sauvegarde les options dans la table Options de la BDD
	 * Cette méthode est corrélée avec les options définies dans '$eac_elements_keys'
	 *
	 * @since 0.0.9
	 * @since 1.5.4	Composant 'chart'
	 * @since 1.6.3	Composant 'modal-box'
	 * @since 1.6.4	Composant 'syntax-highlight'
	 * @since 1.7.1	Composant 'html-sitemap'
	 */
    public function eac_save_settings() {
		// Les champs 'fields' sont serializés dans 'admin-js'
		if(isset($_POST['fields'])) {
			parse_str($_POST['fields'], $settings);
		} else {
			return;
		}
		
		// La liste des options de tous les composants activés ou pas (true ou false)
		$this->eac_settings_keys = array(
			'all-components'		=> intval(isset($settings['all-components']) ? 1 : 0),
			'articles-liste'		=> intval(isset($settings['articles-liste']) ? 1 : 0),
			'image-effects'			=> intval(isset($settings['image-effects']) ? 1 : 0),
			'image-galerie'			=> intval(isset($settings['image-galerie']) ? 1 : 0),
			'image-promotion'		=> intval(isset($settings['image-promotion']) ? 1 : 0),
			'image-ribbon'			=> intval(isset($settings['image-ribbon']) ? 1 : 0),
			'image-ronde'			=> intval(isset($settings['image-ronde']) ? 1 : 0),
			'images-comparison'		=> intval(isset($settings['images-comparison']) ? 1 : 0),
			'kenburn-slider'		=> intval(isset($settings['kenburn-slider']) ? 1 : 0),
			'slider-pro'			=> intval(isset($settings['slider-pro']) ? 1 : 0),
			'reseaux-sociaux'		=> intval(isset($settings['reseaux-sociaux']) ? 1 : 0),
			'lecteur-rss'			=> intval(isset($settings['lecteur-rss']) ? 1 : 0),
			'lecteur-audio'			=> intval(isset($settings['lecteur-audio']) ? 1 : 0),
			'image-diaporama'		=> intval(isset($settings['image-diaporama']) ? 1 : 0),
			'pinterest-rss'			=> intval(isset($settings['pinterest-rss']) ? 1 : 0),
			'instagram-explore'		=> intval(isset($settings['instagram-explore']) ? 1 : 0),
			'instagram-search'		=> intval(isset($settings['instagram-search']) ? 1 : 0),
			'instagram-user'		=> intval(isset($settings['instagram-user']) ? 1 : 0),
			'instagram-location'	=> intval(isset($settings['instagram-location']) ? 1 : 0),
			'chart'					=> intval(isset($settings['chart']) ? 1 : 0),
			'modal-box'				=> intval(isset($settings['modal-box']) ? 1 : 0),
			'syntax-highlight'		=> intval(isset($settings['syntax-highlight']) ? 1 : 0),
			'html-sitemap'			=> intval(isset($settings['html-sitemap']) ? 1 : 0),
		);
            
		update_option($this->eac_options_settings, $this->eac_settings_keys);
            
		return true;
		die();
	}
}