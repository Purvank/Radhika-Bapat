<div id="tab-1" style="display: none;" class="wrap">
	<form action="" method="POST" id="eac-form-settings" name="eac-form-settings">
		<div class="eac-settings-tabs">
			<table class="eac-elements-table eac-all-settings">
				<tbody>
					<tr>
						<th><?php _e('Active/Désactive tous les composants', 'eac-components'); ?></th>
						<td>
							<label class="switch">
								<input type="checkbox" class="ios-switch bigswitch" id="all-components" name="all-components" <?php checked(1, $this->eac_get_settings['all-components'], true) ?>>
								<div><div></div></div>
							</label>
						</td>
					</tr>
				</tbody>
			</table>
			<table class="eac-elements-table">
				<tbody>
					<tr>
						<th><?php _e("Grille d'articles", 'eac-components'); ?></th>
						<td>
							<label class="switch">
								<input type="checkbox" class="ios-switch bigswitch" id="articles-liste" name="articles-liste" <?php checked(1, $this->eac_get_settings['articles-liste'], true) ?>>
								<div><div></div></div>
							</label>
						</td>
						<th><?php _e("Galerie d'images", 'eac-components'); ?></th>
						<td>
							<label class="switch">
								<input type="checkbox" class="ios-switch bigswitch" id="image-galerie" name="image-galerie" <?php checked(1, $this->eac_get_settings['image-galerie'], true) ?> />
								<div><div></div></div>
							</label>
						</td>
						<th><?php _e("Carrousel d'images", 'eac-components'); ?></th>
						<td>
							<label class="switch">
								<input type="checkbox" class="ios-switch bigswitch" id="slider-pro" name="slider-pro" <?php checked(1, $this->eac_get_settings['slider-pro'], true) ?>>
								<div><div></div></div>
							</label>
						</td>
						<th><?php _e('Diagrammes', 'eac-components'); ?></th>
						<td>
							<label class="switch">
								<input type="checkbox" class="ios-switch bigswitch" id="chart" name="chart" <?php checked(1, $this->eac_get_settings['chart'], true) ?>>
								<div><div></div></div>
							</label>
						</td>
					</tr>
					
					<tr>
						<th><?php _e('Boîte modale', 'eac-components'); ?></th>
						<td>
							<label class="switch">
								<input type="checkbox" class="ios-switch bigswitch" id="modal-box" name="modal-box" <?php checked(1, $this->eac_get_settings['modal-box'], true) ?>>
								<div><div></div></div>
							</label>
						</td>
						<th><?php _e('Coloration syntaxique', 'eac-components'); ?></th>
						<td>
							<label class="switch">
								<input type="checkbox" class="ios-switch bigswitch" id="syntax-highlight" name="syntax-highlight" <?php checked(1, $this->eac_get_settings['syntax-highlight'], true) ?>>
								<div><div></div></div>
							</label>
						</td>
						<th><?php _e('Recherche Instagram', 'eac-components'); ?></th>
						<td>
							<label class="switch">
								<input type="checkbox" class="ios-switch bigswitch" id="instagram-search" name="instagram-search" <?php checked(1, $this->eac_get_settings['instagram-search'], true) ?>>
								<div><div></div></div>
							</label>
						</td>
						<th><?php _e('Utilisateur Instagram', 'eac-components'); ?></th>
						<td>
							<label class="switch">
								<input type="checkbox" class="ios-switch bigswitch" id="instagram-user" name="instagram-user" <?php checked(1, $this->eac_get_settings['instagram-user'], true) ?>>
								<div><div></div></div>
							</label>
						</td>
					</tr>
					
					<tr>
						<th><?php _e('Hashtag Instagram', 'eac-components'); ?></th>
						<td>
							<label class="switch">
								<input type="checkbox" class="ios-switch bigswitch" id="instagram-explore" name="instagram-explore" <?php checked(1, $this->eac_get_settings['instagram-explore'], true) ?>>
								<div><div></div></div>
							</label>
						</td>
						<th><?php _e('Lieu Instagram', 'eac-components'); ?></th>
						<td>
							<label class="switch">
								<input type="checkbox" class="ios-switch bigswitch" id="instagram-location" name="instagram-location" <?php checked(1, $this->eac_get_settings['instagram-location'], true) ?>>
								<div><div></div></div>
							</label>
						</td>
						<th><?php _e('HTML Sitemap', 'eac-components'); ?></th>
						<td>
							<label class="switch">
								<input type="checkbox" class="ios-switch bigswitch" id="html-sitemap" name="html-sitemap" <?php checked(1, $this->eac_get_settings['html-sitemap'], true) ?>>
								<div><div></div></div>
							</label>
						</td>
						<th><?php _e('Lecteur RSS', 'eac-components'); ?></th>
						<td>
							<label class="switch">
								<input type="checkbox" class="ios-switch bigswitch" id="lecteur-rss" name="lecteur-rss" <?php checked(1, $this->eac_get_settings['lecteur-rss'], true) ?>>
								<div><div></div></div>
							</label>
						</td>
					</tr>
					
					<tr>
						<th><?php _e('Lecteur audio', 'eac-components'); ?></th>
						<td>
							<label class="switch">
								<input type="checkbox" class="ios-switch bigswitch" id="lecteur-audio" name="lecteur-audio" <?php checked(1, $this->eac_get_settings['lecteur-audio'], true) ?>>
								<div><div></div></div>
							</label>
						</td>
						<th><?php _e('Pinterest RSS', 'eac-components'); ?></th>
						<td>
							<label class="switch">
								<input type="checkbox" class="ios-switch bigswitch" id="pinterest-rss" name="pinterest-rss" <?php checked(1, $this->eac_get_settings['pinterest-rss'], true) ?>>
								<div><div></div></div>
							</label>
						</td>
						<th><?php _e("Diaporama d'arrière-plan", 'eac-components'); ?></th>
						<td>
							<label class="switch">
								<input type="checkbox" class="ios-switch bigswitch" id="image-diaporama" name="image-diaporama" <?php checked(1, $this->eac_get_settings['image-diaporama'], true) ?>>
								<div><div></div></div>
							</label>
						</td>
						<th><?php _e('Carrousel avec effet Ken Burn', 'eac-components'); ?></th>
						<td>
							<label class="switch">
								<input type="checkbox" class="ios-switch bigswitch" id="kenburn-slider" name="kenburn-slider" <?php checked(1, $this->eac_get_settings['kenburn-slider'], true) ?>>
								<div><div></div></div>
							</label>
						</td>
					</tr>
					
					<tr>
						<th><?php _e('Images Avant/Après', 'eac-components'); ?></th>
						<td>
							<label class="switch">
								<input type="checkbox" class="ios-switch bigswitch" id="images-comparison" name="images-comparison" <?php checked(1, $this->eac_get_settings['images-comparison'], true) ?>>
								<div><div></div></div>
							</label>
						</td>
						<th><?php _e('Effets sur des images', 'eac-components'); ?></th>
						<td>
							<label class="switch">
								<input type="checkbox" class="ios-switch bigswitch" id="image-effects" name="image-effects" <?php checked(1, $this->eac_get_settings['image-effects'], true) ?> />
								<div><div></div></div>
							</label>
						</td>
						<th><?php _e('Image avec ruban', 'eac-components'); ?></th>
						<td>
							<label class="switch">
								<input type="checkbox" class="ios-switch bigswitch" id="image-ribbon" name="image-ribbon" <?php checked(1, $this->eac_get_settings['image-ribbon'], true) ?>>
								<div><div></div></div>
							</label>
						</td>
						<th><?php _e('Image ronde', 'eac-components'); ?></th>
						<td>
							<label class="switch">
								<input type="checkbox" class="ios-switch bigswitch" id="image-ronde" name="image-ronde" <?php checked(1, $this->eac_get_settings['image-ronde'], true) ?>>
								<div><div></div></div>
							</label>
						</td>	
					</tr>
					<tr>
						<th><?php _e('Promotion de produit', 'eac-components'); ?></th>
						<td>
							<label class="switch">
								<input type="checkbox" class="ios-switch bigswitch" id="image-promotion" name="image-promotion" <?php checked(1, $this->eac_get_settings['image-promotion'], true) ?>>
								<div><div></div></div>
							</label>
						</td>
						<th><?php _e('Réseaux sociaux', 'eac-components'); ?></th>
						<td colspan="6">
							<label class="switch">
								<input type="checkbox" class="ios-switch bigswitch" id="reseaux-sociaux" name="reseaux-sociaux" <?php checked(1, $this->eac_get_settings['reseaux-sociaux'], true) ?>>
								<div><div></div></div>
							</label>
						</td>
					</tr>
					<tr><td colspan="8" style="background-color:gray;"></td></tr>
				</tbody>
			</table>
			<div class="eac-saving-box">
				<input id="eac-sumit" type="submit" value="<?php _e('Enregistrer les modifications', 'eac-components'); ?>">
				<div id="eac-elements-saved"><?php _e('Réglages enregistrés', 'eac-components'); ?></div>
				<div id="eac-elements-notsaved"><?php _e('Erreur lors de la sauvegarde...', 'eac-components'); ?></div>
			</div>
		</div>
	</form>
</div>