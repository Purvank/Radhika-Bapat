<?php

/*=================================================================
* Class: Lecteur_Audio_Widget
* Name: Lecteur audio
* Slug: eac-addon-lecteur-audio
*
* Description: Lecteur_Audio_Widget affiche une liste de web-radios
* qui peuvent être écoutés
*
* @since 1.0.0
*==================================================================*/

namespace EACCustomWidgets\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Control_Media;
use Elementor\Utils;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Scheme_Color;
use Elementor\Repeater;

if (! defined('ABSPATH')) exit; // Exit if accessed directly

class Lecteur_Audio_Widget extends Widget_Base {

    /*
    * Retrieve widget name.
    *
    * @access public
    *
    * @return widget name.
    */
    public function get_name() {
        return 'eac-addon-lecteur-audio';
    }

    /*
    * Retrieve widget title.
    *
    * @access public
    *
    * @return widget title.
    */
    public function get_title() {
        return __("Flux WebRadio", 'eac-components');
    }

     /*
    * Retrieve widget icon.
    *
    * @access public
    *
    * @return widget icon.
    */
    public function get_icon() {
        return 'eicon-headphones';
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
		return ['eac-lecteur-audio'];
	}
	
    /*
    * Register widget controls.
    *
    * Adds different input fields to allow the user to change and customize the widget settings.
    *
    * @access protected
    */
    protected function _register_controls() {
		
		$this->start_controls_section('la_audio_settings',
			[
				'label'     => __('Flux Audio', 'eac-components'),
			]
		);
			
			$this->add_control('la_unique_instance',
				[
					'type' => Controls_Manager::RAW_HTML,
					'content_classes' => 'eac-editor-panel_info',
					'raw'  => __("Atlas des flux audio des radios de langue Française - <a href='http://fluxradios.blogspot.com/' target='_blank' rel='nofolow'>Consulter ce site</a>", 'eac-components'),
				]
			);
		
			$repeater = new Repeater();
			
			$repeater->add_control('la_item_title',
				[
					'label'   => __('Titre', 'eac-components'),
					'type'    => Controls_Manager::TEXT,
				]
			);
			
			$repeater->add_control('la_item_url',
				[
					'label'       => __('URL', 'eac-components'),
					'type'        => Controls_Manager::URL,
					'placeholder' => 'http://your-link.com/xxxx.mp3/',
					'default' => [
						'is_external' => true,
						'nofollow' => true,
					],
				]
			);
			
			$this->add_control('la_radio_list',
				[
					'type'        => Controls_Manager::REPEATER,
					'fields'      => $repeater->get_controls(),
					'default'     => [
						[
							'la_item_title'	=> 'France - France Inter',
							'la_item_url'	=> ['url' => 'http://direct.franceinter.fr/live/franceinter-midfi.mp3'],
						],
						[
							'la_item_title'	=> 'France - FIP',
							'la_item_url'	=> ['url' => 'http://direct.fipradio.fr/live/fip-midfi.mp3'],
						],
						[
							'la_item_title'	=> 'France - FIP Rock',
							'la_item_url'	=> ['url' => 'http://direct.fipradio.fr/live/fip-webradio1.mp3'],
						],
						[
							'la_item_title'	=> 'France - FIP Tout nouveau',
							'la_item_url'	=> ['url' => 'http://direct.fipradio.fr/live/fip-webradio5.mp3'],
						],
						[
							'la_item_title'	=> 'France - France Culture',
							'la_item_url'	=> ['url' => 'http://direct.franceculture.fr/live/franceculture-midfi.mp3'],
						],
						[
							'la_item_title'	=> 'France - France Info',
							'la_item_url'	=> ['url' => 'http://direct.franceinfo.fr/live/franceinfo-midfi.mp3'],
						],
						[
							'la_item_title'	=> 'France - RFI',
							'la_item_url'	=> ['url' => 'http://live02.rfi.fr/rfimonde-96k.mp3'],
						],
						[
							'la_item_title'	=> 'France - Radio Classique',
							'la_item_url'	=> ['url' => 'http://radioclassique.ice.infomaniak.ch/radioclassique-high.mp3'],
						],
						[
							'la_item_title'	=> 'France - NRJ',
							'la_item_url'	=> ['url' => 'http://cdn.nrjaudio.fm/audio1/fr/30001/mp3_128.mp3?origine=fluxradios'],
						],
						[
							'la_item_title'	=> 'Canada - Montréal',
							'la_item_url'	=> ['url' => 'http://newcap.leanstream.co/CHBMFM'],
						],
						[
							'la_item_title'	=> 'Luxembourg : Eldoradio',
							'la_item_url'	=> ['url' => 'http://sc-eldolive.newmedia.lu/;stream.nvs'],
						],
						[
							'la_item_title'	=> "Guyane - 1ère",
							'la_item_url'	=> ['url' => 'http://radios.la1ere.fr/guyane'],
						],
						[
							'la_item_title'	=> "Guyane - Media Tropique FM",
							'la_item_url'	=> ['url' => 'http://manager2.streaming-ingenierie.fr:8020/stream?r=408167'],
						],
						[
							'la_item_title'	=> "Belgique - VivaCité Bruxelles",
							'la_item_url'	=> ['url' => 'https://radios.rtbf.be/vivabxl-128.mp3'],
						],
						[
							'la_item_title'	=> "Belgique - DH Radio",
							'la_item_url'	=> ['url' => 'http://dhradio.ice.infomaniak.ch/dhradio-192.mp3'],
						],
						[
							'la_item_title'	=> "Suisse - RTS La Première",
							'la_item_url'	=> ['url' => 'http://stream.srg-ssr.ch/m/la-1ere/mp3_128'],
						],
						[
							'la_item_title'	=> "Guadeloupe - Radio Haute Tension",
							'la_item_url'	=> ['url' => 'http://haute-tension.ice.infomaniak.ch/haute-tension-high.mp3'],
						],
						[
							'la_item_title'	=> "England - BBC World Service",
							'la_item_url'	=> ['url' => 'http://bbcwssc.ic.llnwd.net/stream/bbcwssc_mp1_ws-eieuk'],
						],
						[
							'la_item_title'	=> "Scotland - BBC Radio Scotland",
							'la_item_url'	=> ['url' => 'http://bbcmedia.ic.llnwd.net/stream/bbcmedia_scotlandfm_mf_p'],
						],
						[
							'la_item_title'	=> "Italia - RAI UNO",
							'la_item_url'	=> ['url' => 'http://icestreaming.rai.it/1.mp3'],
						],
						[
							'la_item_title'	=> "Spain - RNE Radio Nacional",
							'la_item_url'	=> ['url' => 'http://195.10.10.206/rtve/rtve-rne.mp3'],
						],
						[
							'la_item_title'	=> "Deutschland - Deutschlandfunk",
							'la_item_url'	=> ['url' => 'http://st01.dlf.de/dlf/01/128/mp3/stream.mp3'],
						],
						[
							'la_item_title'	=> "USA - NPR",
							'la_item_url'	=> ['url' => 'https://nprdmp-live01-mp3.akacast.akamaistream.net/7/998/364916/v1/npr.akacast.akamaistream.net/nprdmp_live01_mp3'],
						],
					],
					'title_field' => '{{{ la_item_title }}}',
				]
			);
			
		$this->end_controls_section();
		
		$this->start_controls_section('la_general_style',
			[
				'label'      => __('Global', 'eac-components'),
				'tab'        => Controls_Manager::TAB_STYLE,
			]
		);
		
			$this->add_control('la_wrapper_bg_color',
				[
					'label' => __('Couleur du fond', 'eac-components'),
					'type' => Controls_Manager::COLOR,
					'scheme' => [
						'type' => Scheme_Color::get_type(),
						'value' => Scheme_Color::COLOR_4,
					],
					'selectors' => [ '{{WRAPPER}} .eac-lecteur-audio' => 'background-color: {{VALUE}};' ],
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
		if(! $settings['la_radio_list']) {
			return;
		}
		
		?>
		<div class='eac-lecteur-audio'>
			<?php $this->render_galerie(); ?>
			<div class='la-lecteur-audio'>
				<audio class="listen" preload="none" data-size="150" src="<?php echo $settings['la_radio_list'][0]['la_item_url']['url']; ?>"></audio>
			</div>
			<div class="la-item-header"></div>
		</div>
		<?php
    }

    protected function render_galerie() {
		$settings = $this->get_settings_for_display();
		
		?>
		<div class="la-select-item-list">
			<div class="la-options-items-list">
				<select id="la_options_items" class="la-options-items">
					<?php foreach($settings['la_radio_list'] as $item) { ?>
						<?php if(! empty($item['la_item_url']['url'])) : ?>
							<option value="<?php echo $item['la_item_url']['url']; ?>"><?php echo $item['la_item_title']; ?></option>
						<?php endif; ?>
					<?php } ?>
				</select>
			</div>
		</div>
		<?php
	}
	
	protected function content_template() {}
	
}