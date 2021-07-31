
=== Elementor Addon Components ===
Contributors: EAC Team
Tags: page-builder, elementor, components, addon, widget, dynamic tags, custom css, template, external image, syntax highlighter
Elementor tested up to: 3.1.0
Wordpress Tested up to: 5.7.1
Stable tag: 1.7.3
License: GPLv3
'Elementor Addon Components' is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
See the GPL General Public License for more details. 

=== Installation ===
Requirement: The plugin 'Elementor' is installed and activated.
Unzip the content of the 'zip' in the plugins directory and then proceed to activate it.

=== Components ===
You can Activate / Deactivate each of the components in the 'EAC Components' configuration page to avoid loading unnecessary resources.
If you deactivate all the components, you will still keep the Dynamic Tags as well as the widget 'EAC Custom CSS'.

=== Change Log ===
V1.7.5 – 19/04/2020 – 04/19/2020 -- WP => 5.7.1 Elementor => 3.1.0 PHP => 7.4+
Added: 'Post Grid' component can be filtered with ACF field keys/values.
Fix: Because of use ACF fields for filtering 'Post Grid' component, refactored 'Custom Fields' features for better compability.
This can cause inconsistencies for old versions.
Fix: Custom Fields/ACF Fields, change the separator character. Pipe '|' in place of comma ','
Fix: Code refactored for better performance and security.
Checked: Compatibility with latest versions of WordPress 5.7.1
Checked: Compatibility with latest versions of Elementor 3.1.4
Added: Compatibility Tag for Elementor

V1.7.3 – 02/04/2020 – 04/02/2020 -- WP => 5.6.2 Elementor => 3.0.16 PHP => 7.3+
Fix: 'Post Grid' Bug fix. Did not check the content type of the serialized 'meta_value' field.
Fix: 'Post Grid' Bug fix. Cast the 'NUMERIC' and 'DECIMAL' value types.
Added: 'Post Grid' REGEXP and NOT REGEXP comparison operators to prepare the implementation of the ACF plugin.

V1.7.2 – 21/03/2020 – 03/21/2020 -- WP => 5.6.2 Elementor => 3.0.16 PHP => 7.3+
Notice: 'Post Grid' does not support yet ACF plugin.
Fix: 'Post Grid' Bug fix. The filter feature didn't work if the ACF plugin was installed and active.
Fix: 'Post Grid' The 'Align Text right/left' controls are not hidden when the 'excerpt' content is disabled.
Fix: 'Post Grid' and 'Image gallery' Filter alignment for mobiles.
Fix: The list of post types was incomplete.
Added: 'Post Grid' Option to display query arguments in edit mode.
Added: Of a filter to limit the list of post types displayed.
Added: 'Post Grid' and 'Image gallery' Vertical align option with the image ratio.
Updated: 'Advanced query feature' The meta_value field, of date type, accepts now three formats '2021-03-21' '2021/03/21' '20210321'

V1.7.1 – 15/03/2020 – 03/15/2020 -- WP => 5.6.2 Elementor => 2.9.0 PHP => 7.0+
Added: A new component 'HTML Sitemap' which will allow you to create your fully customizable Sitemap in HTML format.
Notice: 22 components available for free.

V1.7.0 – 09/03/2020 – 03/09/2020 -- WP => 5.0+ Elementor => 2.9.0+ PHP => 7.0+
Updated: 'Post Grid' You can now create your own Query on Custom fields for Posts, Custom post types, and Pages.
- Implementation of a selector for the Post type, Taxonomies, and associated Tags.
- Posts can be filtered by their author.
- Implementation of a list of distinct meta_key and their related meta_value by using the Dynamic Tags feature from Elementor.
- Implementation of the Data type and the Comparison operator.
- Implementation of the Relation between Queries.
- You can apply aspect ratio to the images on Grid mode.
Pay attention: The interface of the widget "Post Grid" has been completely rewamped that could lead to inconsistencies with the previous versions of the component,
in particular for the selection of Custom fields keys.
Check and follow this tutorial.
Updated: 'Post Grid' You can apply a ratio to images only in grid mode.
Updated: 'Post Grid' Removing the overlay on images. The lightbox is directly open when you click/touch on the image.
Fix: 'Modalbox' The content of an HTML page is not displayed.
Added: 'Modalbox' Specific entry 'Link HTML' in the content type list.
Added: 'Post Grid' && 'Image gallery' four new styles

V1.6.8 – 18/01/2020 – 01/18/2020 … WP => 5.0+ Elementor => 2.9.0+ PHP => 7.0+
Updated: Add filter for the component Image gallery.
Each item of the repeater has a field in which you can enter one or more labels, separated by a comma, which will be used as a filter for the image gallery.
You can enable or disable the filter and align it with the images in the gallery.
Updated: 'Post grid' You can align the filter with the items of the post grid.

=== Change Log ===
V1.6.7 – 15/01/2020 – 01/15/2020 … WP => 5.0+ Elementor => 2.9.0+ PHP => 7.0+
Added: You can now enable 'Metro' mode for layout in Image gallery.
'Metro' mode only applies to the first image to highlight it.
Fix: Controls repeater. Removed 'array_values'.
Fix: Changed deprecated '_content_template' method. Planned Elementor Deprecations 2.9.0

V1.6.6 – 07/01/2020 – 01/07/2020 … WP => 5.0+ Elementor => 2.9.0+ PHP => 7.0+
Added: Implements the feature 'Custom attributes'. Now you can add your own attributes to the section, column and widget.
Fix: Dynamic tags "External Image" do not return an empty array when no URL has been set.
Fix: Dynamic tags "Custom CPT" Change url 'guid' by 'get_permalink'.
Fix: Modalbox widget add condition to show/hide the control "ALT attribute".

V1.6.5 – 31/12/2020 – 12/31/2020 … WP => 5.0+ Elementor => 2.9.0+ PHP => 7.0+
Added: Implements the feature 'Update plugin' as well as the popup 'Show the details' under the view plugins.
Added: 'ALT' attribute for the widget 'image' when you are using the components 'Post grid, Image gallery' and the Dynamic Tag 'External image'.

V1.6.4 – 10/12/2020 – 12/10/2020 … WP => 5.0+ Elementor => 2.9.0+ PHP => 7.0+
Added: A new component 'Syntax Highlighter for Elementor' which will allow you to publish and share the source of your code.
You have 14 languages most used with Wordpress ​​as well as related themes with full of customization.
Added: A new option with the 'Chart' component with which you can load the current palette of your colors (Saved colors)
Each of the palette color will be affected automaticaly to a serie. For that enable "Style Tab/Global/Global colors".
Updated: Set "placeholder.png" as the default image for the Dynamic Tag "External image".
Updated: The 'Fancybox' viewer toolbar is positioned vertically.
Notice: 21 components available

V1.6.3 – 30/11/2020 – 11/30/2020 … WP => 5.0+ Elementor => 2.9.0+ PHP => 7.0+
Added: A new text field under the widget 'Image' in which you can enter the content of the 'ALT' attribute of the image.
This field should be normally filled when you add an image with the Dynamic Tag 'External image' to improve the SEO of the page.
Updated: The components 'Image gallery' and 'Image carousel' have been updated to reflect the changes.
Updated: The Dynamic Tag 'Shortcode media' is deleted.
Fix: Some settings, in the component configuration page, was not being saved.

V1.6.2 - 02/10/2020 - 10/2/2020 ... WP => 5.0+ Elementor => 2.9.0+ PHP => 7.0+
Added: a new Dynamic Tags 'External image' to access Images from ext. URL with the widget 'Image'
This is a fastest way to create them by inserting an URL without using the Media library
Replaces the Dynamic Tag 'Shortcode media' which will be removed in the next release (v1.6.3)
Follow this link for the documentation
Updated: 'Instagram' the search component is operational again
Updated: 'Instagram' due to the more recent deprecation, the links on the pictograms 'likes and comments' are deactivated
Fix: removal pieces of CSS code especially for the image caption

V1.6.1 - 02/10/2020 - 10/2/2020 ... WP => 5.0+ Elementor => 3.0+ PHP => 7.0+
Added: "Modal Box" component allow you to add content in a popup with Elementor free version.
You will be able to display a Custom Text, Video, Form and Elementor Template from different triggers like Button, Image, simple Text or automatiquely after the page is loaded.
You will find full examples following this link and documentation with this link.
Updated: "Dynamic Tags" add the 'Role' to the list of Author/User informations.
Updated: "Fancybox" the slideshow option is enable in the toolbar.
Fix: 'Instagram' Instagram Shortcode is suppressed and the Video and Slideshow pictograms are deleted due to the recent deprecation (10/24/2020) of the embed object endpoint.
Fix: removal pieces of CSS code especially for titles H1 to H6.
Notice: 20 components are ready to use.

V1.6.0 - 02/10/2020 - 10/2/2020 ... WP => 5.0+ Elementor => 3.0+ PHP => 7.0+
Added: Dynamic Tags knows as 'Dynamic content' for the Free version of Elementor
Added: Custom CSS for the Free version of Elementor
Added: Use your own Elementor Templates anywhere on the Posts, Pages or Sidebar
Added: Easily link and display the external images from a CDN or other websites
Added: Easily link and display the external images form a CDN when the widget 'Image' is used
Updated: 'Post grid' Display post author Avatar/Gravatar
Updated: 'Post grid' Apply filters on post Authors
Updated: 'Post grid' Apply filters on post Custom Fields
Updated: 'Post grid' Filters 'Term, Author, Custom Fields' are visible for mobiles
Fix: 'Post grid' Remove duplicates 'slug' for CPT filters
Updated: 'Image gallery' Image ratio can be used to display images with grid mode
Updated: 'Image gallery' The Fancybox is available for all modes (Masonry, Grid, Justify)
Updated: 'Instagram component Search' not yet available following changes to Instagram's graphQl API (Look at)
Fix: 'Instagram Location' The 'jqCloud' library is correctely loaded
Note: All 'Read more' can be consulted in component 'Post Grid'
Note: Next release implements a 'Modal Box' component 
Note: This version is not compatible with Elementor Pro.

V1.5.4 - 13/06/2020 - 06/13/2020
Instagram: Les composants 'Instagram' ont un fonctionnement erratique dû à la migration vers le nouvel API (GraphQl Facebook). Les travaux de mise à jour débuteront lorsque l'environnement sera stabilisé.
"Instagram made an important announcement about upcoming changes in operating API, which will affect Instagram users and delevopers. It will be on March 31, 2020."
Please read this Guide Line.

V1.5.4 - 13/06/2020 - 06/13/2020
Added:  Création et ajout du composant "Chart".
- 7 types de graphiques et leurs variations (Empilé) sont disponibles pour produire et publier facilement des diagrammes interactifs 
- Les données peuvent être saisies directement dans le widget ou en important un fichier de format JSON. Consulter l'aide pour le format des fichiers.
- Des fichiers préformatés vous aideront à bien débuter la construction et la publication de vos graphiques  (Rép :  assets/js/chart/json).
Updated: "Instagram Location Feeds" Les résultats de l'appel de service 'Nominatim OpenStreetMap' sont enregistrés dans la base de données pendant un mois (Transient).
Updated:  "Instagram Location Feeds" Lien vers le site web de la 'Location'.
Fix:  Défilement (Swipe) et zoom des images dans la Fancybox pour les mobiles.
Notice: 19 composants disponibles.

V1.5.3 - 22/04/2020 - 04/22/2020
Added: 'Shortcode Instagram' Afficher un article dans un bloc ou dans une barre latérale (Consulter cet article).
Fix:  "Image gallery" L'affichage du mode justifié (justify) sur les mobiles n'était pas conforme.

V1.5.2 - 05/04/2020 - 04/05/2020
Added: "Instagram Location Feeds" Pagination (Instagram Location feeds paging). 
Added: "Instagram Location Feeds" Téléchargement des vidéos. Pictogramme standard en haut de l'image (Download Instagram Hashtag feeds videos). 
Added: 'Instagram User Account Feeds' Option pour visualiser le nuage de Hashtags.
Added: Variable unique pour gérer le CSS des champs 'input' des Listes, des champs texte, séparateurs et loader spin. Fichier '/assets/css/eac-components.css' variable ':root'.
Added: Lancement des requêtes avec les touches 'Enter ou return'.
Fix: Chevauchement des images sur les mobiles.
Fix: Suppression du test du nombre de vues des vidéos.

V1.5.1 - 09/03/2020 - 03/09/2020
Added: "Instagram Hashtag Feeds" Ajout de la fonctionnalité de téléchargement des vidéos. Pictogramme standard en haut de l'image (Download Instagram Hashtag feeds videos).

V1.5.0 - 02/03/2020
Added: "Instagram User Account Feeds" Ajout de la fonctionnalité de téléchargement des vidéos. Pictogramme standard en haut de l'image (Download Instagram User feeds videos).

V1.4.9 - 24/02/2020
Added: "Instagram User Account Feeds" Ajout de la fonctionnalité de pagination (Instagram User feeds paging).
Added: "Instagram Hashtag Feeds" Ajout de la fonctionnalité de pagination (Instagram hashtag feeds paging).

V1.4.7 - 08/02/2020
Fix: "Instagram User Account Feeds" Correctif pour la recherche de l'identifiant d'un compte utilisateur.

V1.4.6 - 05/02/2020
Fix: Correctif de la lib. Isotope. La prévisualisation en mode Masonry dans l'éditeur est maintenant conforme.
Added: "Instagram Search Feeds " Ajout du picto standard des comptes vérifiés.
Improve: Les composants 'Instagram' ont chacun leur propre lib.
Improve mobile: Affichage correct dans la Fancybox des likes, commentaires et tagged posts.

V1.4.5 - 06/01/2020
Added: "Instagram User Account Feeds" Ajout d'un picto qui localise le lieu (Location) de prise de la photo.
- Ce picto est visible si les coordonnées du lieu sont enregistrées et si le composant "Instagram Lieux (Location Feeds)"  est dans la page.
Added: "Instagram Hashtags (Explore Hashtag Feeds)" Ajout des hashtags associés (Related hashtags) dans le profile.
Improve: Consolidation des styles de ces deux composants.

V1.4.4 - 28/12/2019
Added:   "Instagram User Account Feeds" Visualiser la liste des articles (Photos, Vidéos) dont le propriétaire a enregistré votre nom Instagram dans sa publication.  (Tagged post).
Fix:  "Instagram User Account Feeds" Changement de méthode pour récupérer les articles d'un compte utilisateur.
- Requête 'query_hash' vs Page HTML et extraction du contenu ' sharedData'.
- Implique la perte de certaines informations du profile du user account.

V1.4.3 - 28/11/2019
Added:   "Instagram User Account Feeds" Visualiser les utilisateurs identifiés dans chaque article (Tagged user).

V1.4.2 - 22/11/2019
Added:   "Instagram User Account Feeds" Visualiser la liste des comptes suggérés par Instagram (Suggested account).

V1.4.1 - 15/11/2019
Added: Composants Instagram: Ajout des modes d'affichage Grille ou Mosaïque (Grid or Masonry).
Fix:  "Instagram Location Feeds"  Changement de méthode pour récupérer les articles d'un lieu.
- 'cURL' vs 'file_get_contents'.

V1.4.0 - 05/11/2019
Added: Création et ajout du composant "Instagram Lieux (Location Feeds)".
- Constituer une liste de lieux et visualiser leurs dernières publications (Posts).
Added: Gestion d'un journal (includes/proxy/eac-log) pour enregistrer les éventuelles erreurs de connexion à Instagram.
Added: Intégration de la dernière version de la lib. pour générer les nuages de tags des composants 'User' & 'Explore'.
- Les 'tags' sélectionnés dans le nuage sont enregistrés dans un cookie (Expiration: 1 mois).
Updated: Mise à jour de la langue 'en_US'.
Fix: Diverses modifications des styles.
Notice: 18 composants disponibles.

V1.3.1 - 07/10/2019
Added: "Instagram Search Feeds" Ajout d'un lien (Send to) pour copier le libellé 'User' ou 'hashtag' vers le composant correspondant.
Added: "Instagram User Account Feeds" Ajout d'un bouton pour visualiser la liste des 'stories'.
Added: "Flux RSS/ATOM" Ajout du support pour les flux 'Podcast' et 'Videocast'.
Notice: "Instagram Search Feeds" Le nombre de followers d'un utilisateur a été supprimé dans l'API Instagram.
Fix: "Instagram Search Feeds" Suppression de la fonction de tri par 'Nom/Nombre de followers'.
Fix: Consolidation de la gestion des erreurs HTTP.

V1.3.0 - 09/09/2019
Updated: Suppression du composant 'Galerie Instagram'.
Added: Ajout des liens 'Configuration' et 'Vérifier les mises à jour' pour EAC dans la page des Extensions (plugins).
Added: Création et ajout du composant "Instagram Recherche (Search Feeds)".
Added: Création et ajout du composant "Instagram Utilisateurs (User Account Feeds)".
Added: Création et ajout du composant "Instagram Hashtags (Explore Hashtag Feeds)".
Fix: Correctifs apportés pour des bugs mineurs.
Notice: 17 composants disponibles.

V1.2.1 - 08/05/2019
Added: "Galerie Instagram - Pinterest - Flux RSS" ajout de trois nouveaux styles.

V1.20 - 06/05/2019
Added: Création et ajout du composant "Flux Pinterest".
Notice: 15 composants disponibles.

V1.1.1 - 02/03/2019
Added: "Grille d'articles" ajout de trois nouveaux styles.
Added: "Flux RSS" ajout du contrôle 'Visionneuse' sur les images.
Added: "Flux RSS" ajout du contrôle 'Columns gap'.

V1.1.0 - 01/02/2019
Added: Internationalisation. Création et ajout de la langue 'en_US'.

V1.0.0 - 21/11/2018
Added: Création et ajout du composant "Flux RSS".
Added: Création et ajout du composant "Flux Radio" (WebRadio).
Added: Création et ajout du composant "Background Slideshow".
Notice: 14 composants disponibles.

V0.0.9 - 01/10/2018
Mise à disposition de la version initiale de Elementor Addon Components (EAC).
11 composants disponibles et gratuits.

La Team EAC

// To make the site work, we log user data. You agree to our Privacy Policy, including cookie policy.
// Pour faire fonctionner le site, nous enregistrons les données des utilisateurs. Vous acceptez notre politique de confidentialité, y compris la politique de cookies.