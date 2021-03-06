
/**
* Description: Cette méthode est déclenchée lorsque la section 'eac-addon-instagram-location' est chargée dans la page
*
* @param {selector} $scope. Le contenu de la section
* @since 1.4.0
* @since 1.4.1  (16/11/2019) Gestion de l'affichage des posts avec la lib Masonry en mode grille ou mosaïque
*							 Ajout de l'event afterClose sur la fancybox
* @since 1.4.6  (26/01/2020) Changement de librairie Isotope vs Masonry
* @since 1.5.2  Implémente la pagination
*               Gestion du download de la video
*               Gestion 'Enter ou Return' dans l'input text
*               Correctif suppression du test sur 'item.video_view_count'
* @since 1.5.4	Recherche la distance entre le client et la Location sélectionnée
*               Affiche le site web
*				Modification du nombre de paramètres pour télécharger une vidéo
* @since 1.6.0	Cache le bouton '$targetButtonNext' sur l'événement click
* @since 1.6.1	Test du callback des requêtes AJAX
*				Suppression des pictos Vidéo et Diaporama et du traitement des événements afférents
*				"The endpoints documented on this page were deprecated on October 24, 2020 and now return an error code 400"
*				Picto download vidéo est commenté pour trouver une solution
* @since 1.6.2	Suppression de la délégation des événements sur les liens likes et commentaires
*/

;(function($) {
    "use strict";
	
	var widgetInstagramLocation = window.widgetInstagramLocation = function($scope) {
		var $targetInstance = $scope.find('.eac-insta-location'),
			$target = $scope.find('.insta-location'),
			$targetSelect = $scope.find('#insta-location__options-items'),
			$targetSelectedItem = $scope.find('#insta-location__item-name'),
			$targetCheckBox1 = $scope.find('#insta-location__items-cb'),
			$targetCheckBox2 = $scope.find('#insta-location__items-cb2'),
			$targetButton = $scope.find('#insta-location__read-button'),
			$targetHeader = $scope.find('.insta-location__header'),
			$targetError = $scope.find('.insta-location__error'),
			$targetLoader = $scope.find('#insta-location__loader-wheel'),
			$targetButtonNext = $scope.find('#insta-location__read-button-next'),
			$targetLoaderNext = $scope.find('#insta-location__loader-wheel-next'),
			$targetItemsCount = $scope.find('.insta-location__read-button-next-paged'),
			isNextPage = false,
			$targetJqCloud = $scope.find('.insta-location__jqcloud'),
			$targetJqCloudSpan = $scope.find('.insta-location__jqcloud span'),
			$targetJqCloudPara = $scope.find('.insta-location__container-jqcloud p'),
			$targetContainerHiddenContent = $scope.find('.insta-location__container-hidden-content'),
			$targetHiddenContent = $targetContainerHiddenContent.find('.insta-location__hidden-content'),
			$targetMentionPara = $targetContainerHiddenContent.find('.insta-location__hd-mention'),
			$targetLikesPara = $targetContainerHiddenContent.find('.insta-location__hd-likes'),
			$targetCommentsPara = $targetContainerHiddenContent.find('.insta-location__hd-comments'),
			$targetContainerMap = $scope.find('.insta-location__container-map'),
			osmMap,
			$targetMap = $scope.find('.insta-location__map'),
			settings = $target.data('settings') || {},
			instanceAjax = {},
			instagram_uriLocation = 'https://www.instagram.com/explore/locations/',
			instagram_uriShortcode = 'https://www.instagram.com/p/',
			instagram_uriUser = 'https://www.instagram.com/',
			instagram_uriExplore = 'https://www.instagram.com/explore/tags/',
			proxy_location = 'proxy_location.php',
			proxy_shortcode = 'proxy_shortcode.php',
			ajaxOptionsUrlVideo = 'locationShortcodePage',
			prefixCache = 'location_',
			postfixCache = '.json',
			graphSidecar = 'GraphSidecar',
			locationCookie = 'eac-lselect#',
			isotopeActive = false,
			isotopeOptions = {
				itemSelector: '.insta-location__item', 
				percentPosition: true,
				masonry: {
					columnWidth: '.insta-location__item-sizer',
					horizontalOrder: true,
				},
				layoutMode: settings.data_layout,
				sortBy: 'original-order',
				visibleStyle: { transform: 'scale(1)', opacity: 1 }, // Transition
				hiddenStyle: { transform: 'scale(0.001)', opacity: 0 },
			};
			
		//if(!settings.data_nombre || !settings.data_length) {
		if(! settings.data_length) {
			return;
		}
		
		// Construction de l'objet de la requête Ajax
		instanceAjax = new ajaxCallFeed();
		
		// @since 1.4.0 Recherche des cookies pour les ajouter dans les options du select
		setSelectOptionsCookies(locationCookie, $targetSelect);
		
		// Première valeur de la liste par défaut
		$targetSelect.find('option:first').attr('selected', 'selected');
		$targetSelectedItem.val($targetSelect.eq(0).val());
		
		// Event change sur la liste des flux
		$targetSelect.on('change', function(e) {
			e.preventDefault();
			$targetSelectedItem.val($(this).val());
			$('.insta-location__item', $target).remove();
			$targetJqCloud.empty().css({width:0, height:0}).jQCloud('destroy');
			$targetJqCloudPara.add($targetButtonNext).hide();
			$targetCheckBox1.add($targetCheckBox2).prop('checked', false);
			$targetHeader.add($targetHiddenContent).add($targetError).html('');
			$targetContainerHiddenContent.removeClass('fancybox-content').removeAttr('style');
			$targetMap.html('').css('height', '');
			if(isotopeActive) {
				$target.isotope('destroy');
				isotopeActive = !isotopeActive;
			}
			$target.css('height', '');
			instanceAjax.resetNextPage();
			isNextPage = false;
			$targetItemsCount.text('0');
		});
		
		// Event click sur l'input checkbox 'Top posts' ou 'nuage de tags'
		$targetCheckBox1.add($targetCheckBox2).on('click', function(e) {
			$('.insta-location__item', $target).remove();
			$targetJqCloud.empty().css({width:0, height:0}).jQCloud('destroy');
			$targetJqCloudPara.add($targetButtonNext).hide();
			$targetHeader.add($targetHiddenContent).add($targetError).html('');
			$targetContainerHiddenContent.removeClass('fancybox-content').removeAttr('style');
			if(isotopeActive) {
				$target.isotope('destroy');
				isotopeActive = !isotopeActive;
			}
			$target.css('height', '');
			instanceAjax.resetNextPage();
			isNextPage = false;
			$targetItemsCount.text('0');
		});
		
		// Désactive les checkbox 'Top posts' et 'Nuage de tags'
		$targetCheckBox1.on('click', function(e) { $targetCheckBox2.prop('checked', false); });
		$targetCheckBox2.on('click', function(e) { $targetCheckBox1.prop('checked', false); });
		
		// @since 1.5.2 Enter ou return dans l'input text
		$targetSelectedItem.on("keyup", function(e) {
            if(e.which === 13) {
                e.preventDefault();
                $targetSelectedItem.blur();
                $targetButton.click();
            }
		});
		
		// Event click sur le bouton 'lire le flux'
		$targetButton.on('click touch', function(e) {
			e.preventDefault();
			$('.insta-location__item', $target).remove();
			$targetJqCloud.empty().css({width:0, height:0}).jQCloud('destroy');
			$targetJqCloudPara.add($targetButtonNext).hide();
			$targetHeader.add($targetHiddenContent).add($targetError).html('');
			$targetContainerHiddenContent.removeClass('fancybox-content').removeAttr('style');
			$targetMap.html('').css('height', '');
			if(isotopeActive) {
				$target.isotope('destroy');
				isotopeActive = !isotopeActive;
			}
			
			if($targetSelectedItem.val().length !== 0) {
				var instaTarget = $targetSelectedItem.val().replace(/\s+/g, '').toLocaleLowerCase();
				var cache = prefixCache + instaTarget + postfixCache;
				$targetLoader.show();
				
				// Les données sont dans le cache sessionStorage
				var localCache = sessionStorage && sessionStorage.getItem(cache) ? sessionStorage.getItem(cache) : false;
				if(localCache) {
					isNextPage = false;
					$targetItemsCount.text('0');
					publishDataLocation(JSON.parse(localCache));
				} else {
					// Initialisation de l'objet Ajax
					// avec l'url du flux comme paramètre et le proxy à utiliser
					instanceAjax.init('', proxy_location, '', instaTarget);
				}
			}
		});
		
		/** @since 1.4.9 Event click sur le bouton 'Plus d'articles' */
		$targetButtonNext.on('click touch', function(e) {
			e.preventDefault();
			$targetError.html('');
			var instaTarget = $targetSelectedItem.val().replace(/\s+/g, '').toLocaleLowerCase();
			isNextPage = true;
			$targetLoaderNext.show();
			
			/** @since 1.6.0 Chrome garde le focus sur le bouton
			 * Les items sont poussés vers le haut et non vers le bas
			 * Le bouton est caché
			 */
			$targetButtonNext.hide();
			
			// Initialisation de l'objet Ajax avec le username et le proxy à utiliser
			instanceAjax.init('', proxy_location, '', instaTarget);
		});
		
		/** Délégation event sur les span de JQCloud qui ne sont pas encore créés
		* @since 1.4.0 Le tag sélectionné dans le nuage est enregistré dans un cookie
		*/
		$targetInstance.on('click touch', '.insta-location__jqcloud span', function(e) {
			e.preventDefault();
			var jqcloudval = $(this).text().substring(1, 9999).trim();
			var jqcloudvalclean = jqcloudval.replace(/[\.,;:\'\"\*\(\)]/g, ' ').toLocaleLowerCase();
			var cookiename = locationCookie + jqcloudvalclean;
			// cookie location
			if (navigator.cookieEnabled) {
				if (document.cookie.indexOf(cookiename) === -1) {
					document.cookie = cookiename + '=' + jqcloudval + ' ;max-age=2462435;sameSite=strict';
					// Affecte la valeur du champ text
					$targetSelectedItem.val(jqcloudval);
					// Ajout de l'option dans le select
					$targetSelect.append('<option value="' + jqcloudval + '" selected="selected">' + jqcloudvalclean + '</option>');
				} else {
					return; // Le cookie existe, on sort de l'event. Pas de reset des champs
				}
			}
			
			// Reset des champs
			$('.insta-location__item', $target).remove();
			$targetJqCloud.empty().css({width:0, height:0}).jQCloud('destroy');
			$targetJqCloudPara.hide();
			$targetHeader.add($targetHiddenContent).add($targetError).html('');
			$targetContainerHiddenContent.removeClass('fancybox-content').removeAttr('style');
			$targetCheckBox1.add($targetCheckBox2).prop('checked', false);
			if(isotopeActive) {
				$target.isotope('destroy');
				isotopeActive = !isotopeActive;
			}
		});
		
		/** @since 1.6.2 Suppression de la délégation event sur les liens likes qui ne sont pas encore créés */
		/** @since 1.6.2 Suppression de la délégation event sur les liens commentaires qui ne sont pas encore créés */
		/** @since 1.6.1 Suppression de la délégation de l'événement sur les picto Vidéo/Diaporama */
		
		// Délégation event sur les liens hashtag qui ne sont pas encore créés
		$targetInstance.on('click touch', '.insta-location__meta-item.insta-location__hashtags-count', function(e) {
			var hashtag = $(this).attr('data-hashtags').split(',');
			if(hashtag.length > 0) {
				// Map chaque mot-dièse en lien
				var hashtags = $.map(hashtag, function(n, i) { return ('<div><a href="' + instagram_uriExplore + n.substring(1, 9999) + '/" target="_blank" rel="nofollow">' + n + '</a></div>'); });
				// Display flex de la div parent en colonne
				$targetHiddenContent.css('flex-direction', 'column');
				// Affiche les hashtags
				$targetHiddenContent.html(hashtags);
				$targetContainerHiddenContent.removeClass('fancybox-content').removeAttr('style');
				$targetLikesPara.add($targetCommentsPara).hide();
				$targetMentionPara.show();
				/** @since 1.4.1 gère l'événement de fermeture de la fancybox */
				$.fancybox.open([{src:$targetContainerHiddenContent, type:'inline', opts:{smallBtn:true, buttons:[''], afterClose:function() { $targetHiddenContent.html(''); }}}]);
			}
			return false;
		});
		
		/**
		* @since 1.5.1 Gestion du click sur le picto download de la video
		* @since 1.5.4 Ajout du paramètre 'instaTarget' pour la requête du proxy PHP
		*/
		$targetInstance.on('click touch', '.insta-location__download-video', function(e) {
			e.preventDefault();
			var shortcode = $(this).attr('data-shortcode');
			var instaTarget = $targetSelectedItem.val().replace(/\s+/g, '').toLocaleLowerCase();
			            
			if(shortcode.length > 0) {
				instanceAjax.init('', proxy_shortcode, ajaxOptionsUrlVideo, shortcode, '', instaTarget);
			}
			
		});
		
		/**
		* @since 1.3.1 Ajout de l'event 'change' sur l'input text.
		* L'événement est déclenché par le composant 'search'
		*/
		$targetSelectedItem.on('change', function(e) {
			e.preventDefault();
			$('.insta-location__item', $target).remove();
			$targetJqCloud.empty().css({width:0, height:0}).jQCloud('destroy');
			$targetJqCloudPara.add($targetButtonNext).hide();
			$targetCheckBox1.add($targetCheckBox2).prop('checked', false);
			$targetHeader.add($targetHiddenContent).add($targetError).html('');
			$targetContainerHiddenContent.removeClass('fancybox-content').removeAttr('style');
			$targetMap.html('').css('height', '');
			if(isotopeActive) {
				$target.isotope('destroy');
				isotopeActive = !isotopeActive;
			}
			$target.css('height', '');
			instanceAjax.resetNextPage();
			isNextPage = false;
			$targetItemsCount.text('0');
		});
		
		// L'appel Ajax est asynchrone, ajaxComplete, event global, est déclenché
		$(document).ajaxComplete(function(event, xhr, ajaxSettings) {
			if(ajaxSettings.ajaxOptions && ajaxSettings.ajaxOptions === instanceAjax.getOptions()) { // Le même random number généré lors de la création de l'objet Ajax
				event.stopImmediatePropagation();
				// Les items à afficher
				var Items = instanceAjax.getItems();
				
				// @since 1.6.1 Une erreur Ajax. La clé 'headError' est renseignée
				if(Items.headError) {
					$targetLoader.add($targetLoaderNext).hide();
					$targetError.html('<span>' + Items.headError + '</span>');
					return false;
				}
				
				// Les données des pictogrammes
				if(ajaxSettings.ajaxRequestedData && ajaxSettings.ajaxRequestedData === instanceAjax.getRequestedData()) {
					// Affichage des likeurs et des commentaires
					if(Items.likesComments && Items.likesComments.length > 0) {
						showLikesComments(Items.likesComments, $targetHiddenContent, instagram_uriUser);
						// Lancement de la Fancybox avec le contenu de la div des likeurs et comments
						/** @since 1.4.1 gère l'événement de fermeture de la fancybox */
						$.fancybox.open([{src:$targetContainerHiddenContent, type:'inline', opts:{smallBtn:true, buttons:[''], afterClose:function() { $targetHiddenContent.html(''); }}}]);
					
					/** @since 1.6.1 Suppression embed Vidéo/Diaporama */
					
					/** @since 1.5.1 Collecte l'url de la vidéo */
					} else if(Items.videoUrl && Items.videoUrl.url) {
						instanceAjax.callFetch(Items.videoUrl.url);
					}
				} else { // Affichage normal des posts
						publishDataLocation(Items);
				}
			}
		});
		
		// Procède aux tests. Construit et affiche le code HTML
		function publishDataLocation(allItems) {
			// Cacher les loader
			$targetLoader.add($targetLoaderNext).hide();
			
			var topPosts = $targetCheckBox1.is(':checked') ? true : false; // Type de post, 'Top' ou 'recent'
			var hashtagCloud = $targetCheckBox2.is(':checked') ? true : false; // Nuage de tags sélectionné
			
			// Une erreur Ajax ??
			if(allItems.headError) {
				$targetError.html('<span>' + allItems.headError + '</span>');
				return false;
			}
			
			// Pas d'item
			if(! allItems.medias) {
				$targetError.html('<span>Nothing to display</span>');
				return false;
			}
			
			// Data dans le cache
			var cache = prefixCache + $targetSelectedItem.val().replace(/\s+/g, '').toLocaleLowerCase() + postfixCache;
			if(sessionStorage && !sessionStorage.getItem(cache)) {
				try {
					sessionStorage.setItem(cache, JSON.stringify(allItems));
				} catch(ex) {
					console.log("EAC sessionStorage: dépassement de quota!");
				}
			}
			
			// Récents ou top posts
			var Items = topPosts === false ? allItems.medias : allItems.mediasTop;
			
			// Le profile du user account
			var Profile = allItems.profile;
			
			// Affichage du nuage de tags
			if(hashtagCloud === true) {
				if(allItems.jqcloud) {
					var containerWidth = $targetJqCloud.parent().width();
					var colorsReverse = ['#e41a1c','#377eb8','#4daf4a','#984ea3','#ff7f00','#c7cf00','#a65628','#f781bf','#999999']; //.reverse();
				    $targetJqCloudPara.show();
					$targetJqCloud.css({width:containerWidth, height:containerWidth/2});
					$targetJqCloud.jQCloud(allItems.jqcloud, {
						//shape: 'rectangular',
						autoResize: true,
						colors: colorsReverse,
						fontSize: {from: 0.05, to: 0.01}
					});
				} else {
					$targetError.html('<span>Nothing to display</span>');
				}
				return false;
			}
			
			/** @since 1.4.9 Montre ou cache le bouton 'Plus d'articles' */
			if(Profile.has_next_page && Profile.end_cursor) {
				instanceAjax.setNextPage(Profile.id, Profile.end_cursor);
				if(! topPosts) { $targetButtonNext.show(); }
			} else {
				instanceAjax.resetNextPage();
				$targetButtonNext.hide();
			}
			
			/** @since 1.4.9 page suivante pour le même username. On ne publie pas le header */
			if(! isNextPage) {
				publishHeaderLocation(Profile);
			}
			
			// Affiche le contenu
			publishContentLocation(Items, Profile);
		}
		
		// Construit et affiche le code HTML du header
		function publishHeaderLocation(Profile) {
			
			var topPosts = $targetCheckBox1.is(':checked') ? true : false; // Type de post, 'Top' ou 'recent'
			
			// Affiche l'image de la location
			var imgLoc =	'<div class="insta-location__header-img">' +
							'<a href="' + instagram_uriLocation + Profile.id + '" target="_blank" rel="nofollow">' +
								'<img class="eac-image-loaded" src="' + Profile.headLogo + '" alt="' + Profile.headTitle + '">' +
							'</a>' +
						'</div>';
			$targetHeader.append(imgLoc);
			
			// Affiche l'entête
			var $wrapperHeadContent = $('<div/>', { class: 'insta-location__header-content' });
			$wrapperHeadContent.append('<div><a href="' + instagram_uriLocation + Profile.id + '" target="_blank" rel="nofollow"><h3>' + Profile.headTitle.substring(0, 27) + '...</h3></a></div>');
			
			if(topPosts === false) {
				$wrapperHeadContent.append(
					'<div>' +
						'<span class="insta-location__header-info"><i class="fas fa-camera" aria-hidden="true"></i>' + Profile.headTotalCount + '</span>' +
						'<span class="insta-location__header-info"><i class="far fa-heart" aria-hidden="true"></i>' + Profile.headTotalLikes + '</span>' +
						'<span class="insta-location__header-info"><i class="far fa-comment" aria-hidden="true"></i>' + Profile.headTotalComments + '</span>' +
						'<span class="insta-location__header-info"><i class="fa fa-film" aria-hidden="true"></i>' + Profile.headTotalVideos + '</span>' +
						'<span class="insta-location__header-info"><i class="fa fa-hashtag" aria-hidden="true"></i>' + Profile.headTotalHashtags + '</span>' +
					'</div>');
					
				$wrapperHeadContent.append('<div><span class="insta-location__header-info">' + Profile.headDateDiff + '</span></div>');
			} else {
				$wrapperHeadContent.append(
					'<div>' +
						'<span class="insta-location__header-info"><i class="fas fa-camera" aria-hidden="true"></i>' + Profile.headTotalCountTop + '</span>' +
						'<span class="insta-location__header-info"><i class="far fa-heart" aria-hidden="true"></i>' + Profile.headTotalLikesTop + '</span>' +
						'<span class="insta-location__header-info"><i class="far fa-comment" aria-hidden="true"></i>' + Profile.headTotalCommentsTop + '</span>' +
						'<span class="insta-location__header-info"><i class="fa fa-film" aria-hidden="true"></i>' + Profile.headTotalVideosTop + '</span>' +
						'<span class="insta-location__header-info"><i class="fa fa-hashtag" aria-hidden="true"></i>' + Profile.headTotalHashtagsTop + '</span>' +
					'</div>');
			}
			
			/** @since 1.5.4 */
			if(Profile.website) {
				$wrapperHeadContent.append(
						'<span class="insta-location__header-info"><i class="fas fa-globe-europe" aria-hidden="true"></i>' +
							'<a href="' + Profile.website + '" target="_blank" rel="nofollow">' +
								'<span>Web site</span>' +
							'</a>' +
						'</span>');
			}
			
			$targetHeader.append($wrapperHeadContent);
		}
		
		// Construit et affiche le code HTML du contenu. Les posts
		function publishContentLocation(Items, Profile) {
			
			// Trie des données uniquement sur les likes et comments. Default == posts récents
			Items.sort(sort_by(settings.data_sort, true, parseInt));
			
			// Prépare le JSON pour la map OSM
			if(Profile.lat && Profile.lng) {
				
				// Une map est déjà construite
				if(typeof osmMap !== 'undefined') { osmMap.remove(); }
				
				// Affecte une hauteur à la div map
				$targetMap.css('height', '250px');
				
				var dataMap = {};
				dataMap.mapDiv = $targetMap.attr('id');
				dataMap.lat = Profile.lat;
				dataMap.lng = Profile.lng;
				dataMap.popupContent = Profile.nominatim !== '' ? Profile.nominatim : Profile.headTitle;
				JSON.stringify(dataMap);
				osmMap = showOsmMap(dataMap);
				
				// @since 1.5.4 Recherche la distance entre le client (navigateur) et la Location sélectionnée
				/*var ggp = getGeoPosition(Profile.lat, Profile.lng)
				.then(function(response) {
				    if(response) {
					    console.log("Distance THEN: " + response.km + " Kms" + "::" + response.miles + " Miles");
				    }
				});*/
			}
			
			/** @since 1.4.6 Instance Isotope avant imagesLoaded */
			$target.isotope(isotopeOptions);
			
			// Parcours de tous les items à afficher
			$.each(Items, function(indice, item) {
				/*if(indice >= settings.data_nombre) { // Nombre d'items à afficher
					return false;
				}*/
				
				var $wrapperItem = $('<div/>', { class: 'insta-location__item'});
				var $wrapperContent = $('<div/>', { class: 'insta-location__item-content ' + settings.data_style });
				var $wrapperIcones = $('<div/>', { class: 'insta-location__meta-items' });
				var $wrapperHeadIcones = $('<div/>', { class: 'insta-location__head-icon' }); // Le container du slideshow ou de la video
				
				/** @since 1.4.1 Affiche l'image du profile du username qui a posté l'image */
				if(item.username) {
					var pubpic = 
						'<div class="insta-location__username-picture">' +
							'<a href="' + instagram_uriUser + item.username + '" target="_blank" rel="nofollow">' +
								'<img class="eac-image-loaded" src="' + item.username_pic + '" alt="' + item.username + '" title="' + item.username + '"/>' +
							'</a>' +
						'</div>';
					$wrapperHeadIcones.append(pubpic);
				}
				
				// Affichage des pictos video ou slideshow
				if(settings.data_video) {
					/** @since 1.6.1 Suppression du picto video */
					
					/** @since 1.5.2 Ajout du picto download pour la video. Doit supporter l'API fetch */
					/** @since 1.6.1 Commenté pour trouver une solution */
					/*if(item.video && window.fetch) {
						var pictoDownloadVideo =
							'<div class="insta-location__meta-item insta-location__download-video" data-shortcode="' + item.linkNode + '">' + 
								'<span class="insta-location__download-video-icon">' +
									'<i class="fas fa-download" aria-hidden="true" title="Download video"></i>' +
								'</span>' +
							'</div>';
						$wrapperHeadIcones.append(pictoDownloadVideo);
					}*/
					
					/** @since 1.6.1 Suppression du picto diaporama */
				}
				
				// Lien page Instagram si le picto video est configuré ou le username est renseigné
				if(settings.data_link && (settings.data_video || item.username)) {
					var instaLink = instagram_uriShortcode + item.linkNode + '/';
					var readMore = 
						'<div class="insta-location__meta-item insta-location__link">' +
							'<span class="insta-location__link-icon">' +
								'<a href="' + instaLink + '" target="_blank" rel="nofollow">' +
									'<i class="fa fa-instagram fa-lg" aria-hidden="true"></i>' +
								'</a>' +
							'</span>' +
						'</div>';
					$wrapperHeadIcones.append(readMore);
				}
				
				// Il y a des pictos dans la div du haut
				if($wrapperHeadIcones.html().length !== 0) {
					$wrapperContent.append($wrapperHeadIcones);
				}
				
				// Ajout de l'image avec ou sans visionneuse
				var img = '';
				var imgsrcset = 'srcset="' + item.img_thumb + ' 150w,' + item.image240px + ' 240w,' + item.img_low + ' 320w,' + item.image480px + ' 480w,' + item.img_med + ' 640w" sizes="293px"';
				//var imageLayout = eval('item.' + settings.data_layout); /** @since 1.4.1 Affichage des images en mode grille ou mosaïque */
				var imageLayout = eval('item.' + settings.data_photo_size);
				
				if(settings.data_lightbox) {
					var dataCaption = item.caption ? item.caption.replace(/"/g, "'").substring(0, 100) + '...' : '...';
					dataCaption = item.username !== null ? item.username + "::" + dataCaption : dataCaption;
					img =	'<div class="insta-location__item-image">' +
								'<a href="' + eval('item.' + settings.data_photo_size) + '" data-elementor-open-lightbox="no" data-fancybox="insta-location-gallery" data-caption="' + dataCaption + '">' +
									'<img class="eac-image-loaded" src="' + imageLayout + '" alt="Hooops!!!">' +
								'</a>' +
							'</div>';
				} else { // Pas de bouton lien vers l'image Instagram. On place le lien sur l'image
					if(! settings.data_link) {
						var dataLink = instagram_uriShortcode + item.linkNode + '/';
						img =	'<div class="insta-location__item-image">' +
									'<a href="' + dataLink + '" target="_blank" rel="nofollow">' +
										'<img class="eac-image-loaded" src="' + imageLayout + '" alt="Hooops!!!">' +
									'</a>' +
								'</div>';
					} else {
						img =	'<div class="insta-location__item-image">' +
									'<img class="eac-image-loaded" src="' + imageLayout + '" alt="Hooops!!!">' +
								'</div>';
					}
				}
				$wrapperContent.append(img);
				
				// Ajout des likes & comments & hashtags & date de publication
				if(settings.data_likes && parseInt(item.likeCount) > 0) {
					var likes =
						'<div class="insta-location__meta-item insta-location__likes-count" data-likes="' + item.linkNode + '">' +
							'<span class="insta-location__likes-icon">' +
								'<i class="far fa-heart" aria-hidden="true"></i>' +
								'<span>' + item.likeCount + '</span>' +
							'</span>' +
						'</div>';
					$wrapperIcones.append(likes);
				}
				
				if(settings.data_comments && parseInt(item.commentCount) > 0) {
					var comments =
						'<div class="insta-location__meta-item insta-location__comments-count" data-comments="' + item.linkNode + '">' +
							'<span class="insta-location__comments-icon">' +
								'<i class="far fa-comment" aria-hidden="true"></i>' +
								'<span>' + item.commentCount +	'</span>' +
							'</span>' +
						'</div>';
					$wrapperIcones.append(comments);
				}
					
				if(settings.data_hashtag && parseInt(item.hashtagCount) > 0) {
					var hashtag =
						'<div class="insta-location__meta-item insta-location__hashtags-count" data-hashtags="' + item.hashtagList + '">' +
							'<span class="insta-location__hashtags-icon" title="Show hashtags">' +
								'<i class="fa fa-hashtag" aria-hidden="true"></i>' +
								'<span>' + item.hashtagCount + '</span>' +
							'</span>' +
						'</div>';
					$wrapperIcones.append(hashtag);
				}
				
				if(settings.data_date) {
					var update =
						'<div class="insta-location__meta-item insta-location__published">' +
							//'<span class="insta-location__published-icon">' +
								//'<i class="fa fa-calendar" aria-hidden="true"></i>' +
							//'</span>' +
							//'<span>' + new Date(item.update * 1000).toLocaleDateString() + '</span>' +
							'<span>' + item.updateEnJours + '</span>' +
						'</div>';
					$wrapperIcones.append(update);
				}
				
				// Lien page Instagram si le picto video n'est pas configuré et qu'il n'y a pas de usename
				if(settings.data_link && (!settings.data_video && !item.username)) {
					var instaLinkVid = instagram_uriShortcode + item.linkNode + '/';
					var readMoreVid = 
						'<div class="insta-location__meta-item insta-location__link">' +
							'<span class="insta-location__link-icon">' +
								'<a href="' + instaLinkVid + '" target="_blank" rel="nofollow">' +
									'<i class="fa fa-instagram fa-lg" aria-hidden="true"></i>' +
								'</a>' +
							'</span>' +
						'</div>';
					$wrapperIcones.append(readMoreVid);
				}
				
				if($wrapperIcones.html().length !== 0) {
					$wrapperContent.append($wrapperIcones);
				}
				
				// Ajout du nombre de mots du caption
				if(settings.data_caption) {
					if(item.caption !== '') {
						item.caption = removeEmojis(item.caption);
						// Peut pas découper en mots because les sinogrammes (chinois) Grrrr !!
						item.caption = item.caption.substring(0, settings.data_length) + '[...]';
					}
					// Ajout du caption
					var caption = '<div class="insta-location__item-description"><p>' + item.caption + '</p></div>';
					$wrapperContent.append(caption);
				}
				
				// Ajout dans les wrappers
				$wrapperItem.append($wrapperContent);
				
				/**  @since 1.4.6 Instancie la lib Isotope, charge l'image et redessine le layout */
				$target.append($wrapperItem).isotope('appended', $wrapperItem);
			});
			
			// Redessine après imagesLoaded
			$target.imagesLoaded(function() { $target.isotope('layout'); });
				
			/** @since 1.4.9 Inscrit le nombre de posts chargés, dans le bouton Next */
			var valueButton = parseInt($targetItemsCount.text()) + parseInt(Items.length);
			$targetItemsCount.text(' ' + valueButton);
			
			isotopeActive = !isotopeActive;
		}
	};
	
})(jQuery);