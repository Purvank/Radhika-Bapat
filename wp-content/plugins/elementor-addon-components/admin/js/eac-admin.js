
(function($) {
    "use strict";
    
	// Événement sur la checkbox global
	// Change la valeur de tous les checkbox
    $('#all-components').on('click', function(){
       if($(this).prop('checked') == true) {
           $('.eac-elements-table input').prop('checked', 1);
       } else if($(this).prop('checked') == false){
           $('.eac-elements-table input').prop('checked', 0);
       }
	   $('#eac-elements-saved').css('display', 'none');
	   $('#eac-elements-notsaved').css('display', 'none');
    });
	
	// L'état d'un checkbox a changé
	$('.switch').on('change', ':checkbox', function(){
		$('#eac-elements-saved').css('display', 'none');
		$('#eac-elements-notsaved').css('display', 'none');
	});
	
	// Le formulaire des options par défaut est soumis
    $('form#eac-form-settings').on('submit', function(e) {
		e.preventDefault();
		$.ajax({
			url: settings.ajaxurl,
			type: 'post',
			data: {
				action: settings.ajaxaction,
				fields: $('form#eac-form-settings').serialize(),
			},
            success: function(response) {
				//console.log('Settings Saved!');
				$('#eac-elements-saved').css('display', 'block');
			},
			error: function() {
				//console.log('Failure!');
				$('#eac-elements-notsaved').css('display', 'block');
			}
		});
	});
	
	// Gestion des events sur les tabs
	$('.tabs-nav a').on('click', function(event) {
		event.preventDefault();
		$('.tab-active').removeClass('tab-active');
		$(this).parent().addClass('tab-active');
		$('.tabs-stage > div').hide();
		$($(this).attr('href')).show();
		$('#eac-elements-saved').css('display', 'none');
		$('#eac-elements-notsaved').css('display', 'none');
	});

	$('.tabs-nav a:first').trigger('click'); // Default
	
})(jQuery);