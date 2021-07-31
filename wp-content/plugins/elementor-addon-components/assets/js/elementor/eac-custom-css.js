/**
 * Description: Implémente le filtre et les événements pour gérer le champ CSS personnalisé
 *
 * @since 1.6.0
 * @since 1.7.0	Erreur 'elementor.settings.page' undefined version 3.1.3 Elementor
 *				Suppression de l'événement 'change' sur 'elementor.settings.page.model'
 *				Modification complète de la méthode 'addCustomCss'
 *				Test ok avec la version 2.9.14 Elementor
 */
(function($) {
    "use strict";
	
	/** editor-pro.js 5305 */
    function addCustomCss(css, context) {
		if(!context) { return; }
		
		var model = context.model,
			customCSS = model.get('settings').get('custom_css'); // 'control' ACE Editor
		var selector = '.elementor-element.elementor-element-' + model.get('id');
		
		if('document' === model.get('elType')) {
			selector = elementor.config.document.settings.cssWrapperSelector;
		}
				
		if(customCSS) {
			css += customCSS.replace(/selector/g, selector);
		}
		
		return css;
	}
	
	elementor.hooks.addFilter('editor/style/styleText', addCustomCss);
	
    function addPageCustomCss() {
        var customCSS = elementor.settings.page.model.get('custom_css');
        if(customCSS) {
            customCSS = customCSS.replace(/selector/g, elementor.config.settings.page.cssWrapperSelector);
            elementor.settings.page.getControlsCSS().elements.$stylesheetElement.append(customCSS);
        }
    }
	
	elementor.on('preview:loaded', addPageCustomCss);
	
})(jQuery);
