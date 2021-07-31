<?php
/**
 * Header file for the Twenty Twenty WordPress default theme.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

?><!DOCTYPE html>

<html class="no-js" <?php language_attributes(); ?>>

	<head>

		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1.0" >

		<link rel="profile" href="https://gmpg.org/xfn/11">

		<?php wp_head(); ?>

	</head>
	<?php $podclass = get_the_category()[0]->term_id == 8 ? 'podbean_episodes':''; ?>
	<body <?php body_class($podclass); ?>>

		<?php
		wp_body_open();
		?>

		<header id="site-header" class="header-footer-group" role="banner">
			
			<div class="navibar">

			<div class="header-inner p_header section-inner">
				
				<div class="main_logo">
					<a href="/">
					<svg class="light-svg" id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 242.5 165.71">

	<g stroke="none" stroke-width="1">
		<g fill-rule="nonzero" fill="#FFFFFF">

   <path d="M264.5,457.83v1.71h-.73a4,4,0,0,0-2.73,1,3.31,3.31,0,0,0-1.12,2.62v6.94H258V457.83h1.81v1.74a4.71,4.71,0,0,1,4.7-1.74Z" transform="translate(-257.59 -451.22)"/>
   <path d="M280,462.53v7.55h-1.81v-1.59a4.87,4.87,0,0,1-4.13,1.86,4.8,4.8,0,0,1-3.09-.94,3,3,0,0,1-1.18-2.5,3,3,0,0,1,1.21-2.49,5.08,5.08,0,0,1,3.19-.93h3.87v-1.06a3.08,3.08,0,0,0-.79-2.28,2.9,2.9,0,0,0-2.18-.81,4.42,4.42,0,0,0-3.57,2l-1.28-1.05a5.42,5.42,0,0,1,5-2.69,4.72,4.72,0,0,1,3.5,1.29A5,5,0,0,1,280,462.53Zm-1.94,2.85v-.31h-3.64q-2.64,0-2.64,1.74a1.64,1.64,0,0,0,.71,1.42,3.09,3.09,0,0,0,1.83.52,3.83,3.83,0,0,0,2.64-1A3.08,3.08,0,0,0,278.1,465.38Z" transform="translate(-257.59 -451.22)"/>
   <path d="M297.87,451.22h1.93v18.86H298v-1.94a4.73,4.73,0,0,1-2,1.62,6.07,6.07,0,0,1-2.68.59,5.66,5.66,0,0,1-4.32-1.84,6.82,6.82,0,0,1,0-9.11,5.69,5.69,0,0,1,4.31-1.84,6.11,6.11,0,0,1,2.59.55,5,5,0,0,1,1.94,1.53Zm0,12.75a4.53,4.53,0,0,0-1.24-3.42,4.17,4.17,0,0,0-3-1.21,4.13,4.13,0,0,0-3.11,1.31,4.58,4.58,0,0,0-1.24,3.29,4.63,4.63,0,0,0,1.24,3.31,4.1,4.1,0,0,0,3.11,1.32,4.17,4.17,0,0,0,3-1.21A4.49,4.49,0,0,0,297.89,464Z" transform="translate(-257.59 -451.22)"/>
   <path d="M318.21,462.38v7.7h-1.94v-7.45a3.45,3.45,0,0,0-.81-2.4,2.9,2.9,0,0,0-2.23-.89,3.07,3.07,0,0,0-2.31.93,3.23,3.23,0,0,0-.91,2.36v7.45h-1.94V451.22H310v8a4.46,4.46,0,0,1,3.67-1.65,4.29,4.29,0,0,1,3.31,1.32A5,5,0,0,1,318.21,462.38Z" transform="translate(-257.59 -451.22)"/>
   <path d="M325.85,453.15a1.33,1.33,0,0,1,.43-1,1.47,1.47,0,0,1,2,0,1.35,1.35,0,0,1,.42,1,1.33,1.33,0,0,1-.41,1,1.41,1.41,0,0,1-1,.4,1.43,1.43,0,0,1-1-.4A1.31,1.31,0,0,1,325.85,453.15Zm.48,16.93V457.83h1.94v12.25Z" transform="translate(-257.59 -451.22)"/>
   <path d="M336.54,470.08V451.22h1.94v18.86Zm4.48-6.87,5.78,6.87h-2.49l-5.63-6.89,5.1-5.36h2.54Z" transform="translate(-257.59 -451.22)"/>
   <path d="M362.21,462.53v7.55H360.4v-1.59a4.85,4.85,0,0,1-4.12,1.86,4.77,4.77,0,0,1-3.09-.94,3,3,0,0,1-1.19-2.5,3,3,0,0,1,1.21-2.49,5.1,5.1,0,0,1,3.19-.93h3.88v-1.06a3.09,3.09,0,0,0-.8-2.28,2.88,2.88,0,0,0-2.17-.81,4.39,4.39,0,0,0-3.57,2l-1.28-1.05a5.42,5.42,0,0,1,5-2.69,4.7,4.7,0,0,1,3.5,1.29A5,5,0,0,1,362.21,462.53Zm-1.93,2.85v-.31h-3.65q-2.64,0-2.64,1.74a1.65,1.65,0,0,0,.72,1.42,3,3,0,0,0,1.82.52,3.83,3.83,0,0,0,2.64-1A3.06,3.06,0,0,0,360.28,465.38Z" transform="translate(-257.59 -451.22)"/>
   <path d="M380.24,468l1.23-1.29a8.49,8.49,0,0,0,1.75,1.44,3.53,3.53,0,0,0,1.77.45,2.86,2.86,0,0,0,1.69-.47,1.48,1.48,0,0,0,.65-1.27,1.34,1.34,0,0,0-.46-1.09,6.63,6.63,0,0,0-1.67-.87l-1.19-.5a6.75,6.75,0,0,1-2.31-1.43,2.75,2.75,0,0,1-.73-2,3,3,0,0,1,1.17-2.49,4.59,4.59,0,0,1,2.95-.93,5.09,5.09,0,0,1,4.1,1.93L388,460.7a4.16,4.16,0,0,0-3-1.36,2.52,2.52,0,0,0-1.48.4,1.32,1.32,0,0,0-.55,1.13,1.23,1.23,0,0,0,.41.95,6.35,6.35,0,0,0,1.57.84l1.14.48a7.23,7.23,0,0,1,2.5,1.57,3,3,0,0,1,.74,2.05,3.14,3.14,0,0,1-1.26,2.66,4.89,4.89,0,0,1-3,.93A5.76,5.76,0,0,1,380.24,468Z" transform="translate(-257.59 -451.22)"/>
   <path d="M397.1,469.9a1.62,1.62,0,0,1,0-2.26,1.62,1.62,0,0,1,2.24,0,1.62,1.62,0,0,1,0,2.26,1.62,1.62,0,0,1-2.24,0Z" transform="translate(-257.59 -451.22)"/>
   <path d="M429.72,459.4a6.43,6.43,0,0,1,1.74,4.57,6.36,6.36,0,0,1-1.73,4.55,5.69,5.69,0,0,1-4.3,1.83,6.15,6.15,0,0,1-2.69-.59,4.7,4.7,0,0,1-2-1.62v1.94H419V451.22h1.93v8.4a5,5,0,0,1,1.93-1.51,6,6,0,0,1,2.57-.55A5.72,5.72,0,0,1,429.72,459.4Zm-1.49,7.85a4.63,4.63,0,0,0,1.25-3.31,4.59,4.59,0,0,0-1.25-3.29,4.37,4.37,0,0,0-6.13-.11,4.55,4.55,0,0,0-1.22,3.43,4.49,4.49,0,0,0,1.24,3.39,4.14,4.14,0,0,0,3,1.21A4.08,4.08,0,0,0,428.23,467.25Z" transform="translate(-257.59 -451.22)"/>
   <path d="M448.06,462.53v7.55h-1.81v-1.59a4.87,4.87,0,0,1-4.13,1.86,4.8,4.8,0,0,1-3.09-.94,3,3,0,0,1-1.18-2.5,3,3,0,0,1,1.21-2.49,5.08,5.08,0,0,1,3.19-.93h3.87v-1.06a3.08,3.08,0,0,0-.79-2.28,2.9,2.9,0,0,0-2.17-.81,4.42,4.42,0,0,0-3.58,2l-1.28-1.05a5.42,5.42,0,0,1,5-2.69,4.72,4.72,0,0,1,3.5,1.29A5,5,0,0,1,448.06,462.53Zm-1.94,2.85v-.31h-3.64q-2.64,0-2.64,1.74a1.67,1.67,0,0,0,.71,1.42,3.09,3.09,0,0,0,1.83.52,3.83,3.83,0,0,0,2.64-1A3.08,3.08,0,0,0,446.12,465.38Z" transform="translate(-257.59 -451.22)"/>
   <path d="M467,459.39a6.86,6.86,0,0,1,0,9.12,5.69,5.69,0,0,1-4.31,1.84,5.39,5.39,0,0,1-4.5-2v6.28h-1.94V457.83H458v2a4.73,4.73,0,0,1,1.94-1.64,6.06,6.06,0,0,1,2.69-.59A5.72,5.72,0,0,1,467,459.39Zm-1.51,7.87a4.58,4.58,0,0,0,1.24-3.29,4.63,4.63,0,0,0-1.24-3.31,4.32,4.32,0,0,0-6.11-.11,4.49,4.49,0,0,0-1.25,3.39,4.59,4.59,0,0,0,1.22,3.43,4.38,4.38,0,0,0,6.14-.11Z" transform="translate(-257.59 -451.22)"/>
   <path d="M485.27,462.53v7.55h-1.81v-1.59a4.85,4.85,0,0,1-4.12,1.86,4.79,4.79,0,0,1-3.09-.94,3,3,0,0,1-1.19-2.5,3,3,0,0,1,1.21-2.49,5.1,5.1,0,0,1,3.19-.93h3.88v-1.06a3.09,3.09,0,0,0-.8-2.28,2.88,2.88,0,0,0-2.17-.81,4.42,4.42,0,0,0-3.57,2l-1.28-1.05a5.42,5.42,0,0,1,5-2.69,4.7,4.7,0,0,1,3.49,1.29A5,5,0,0,1,485.27,462.53Zm-1.93,2.85v-.31h-3.65q-2.64,0-2.64,1.74a1.65,1.65,0,0,0,.72,1.42,3.06,3.06,0,0,0,1.82.52,3.83,3.83,0,0,0,2.64-1A3.06,3.06,0,0,0,483.34,465.38Z" transform="translate(-257.59 -451.22)"/>
   <path d="M500.08,468.44v1.64a9.87,9.87,0,0,1-2,.27,4.29,4.29,0,0,1-3-1,3.83,3.83,0,0,1-1.09-3v-6.81h-2.06v-1.74h2.06v-3.34h1.94v3.34h3.82v1.74h-3.82v6.69a2.22,2.22,0,0,0,.64,1.79,3,3,0,0,0,1.95.54A10.37,10.37,0,0,0,500.08,468.44Z" transform="translate(-257.59 -451.22)"/>
   <path d="M303.63,510.23v-4c-18.89,1.35-34.9,14.66-42,33.2v-60h-4V616.93h4V558.57h.05C262.77,532.8,280.92,512,303.63,510.23Z" transform="translate(-257.59 -451.22)"/>
   <path d="M308.38,506.14v4c24.21.94,43.64,23.44,43.64,51,0,28.13-20.28,51-45.22,51-14.53,0-27.47-7.78-35.75-19.83l-3.34,2.18c9,13.15,23.17,21.65,39.09,21.65,27.14,0,49.22-24.68,49.22-55C356,531.36,334.79,507.08,308.38,506.14Z" transform="translate(-257.59 -451.22)"/>

</g>
</g>

</svg></a>
					<a href="/">
					<svg class="rb_logo_two" xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1" viewBox="0 0 98.39 137.5"><path d="M46,59V55c-18.89,1.35-34.9,14.66-42,33.2v-60H0v137.5H4V107.35h0C5.18,81.58,23.33,60.78,46,59Z" transform="translate(-0.04 -28.21)"/><path d="M50.79,54.92v4c24.21.94,43.64,23.44,43.64,51,0,28.13-20.28,51-45.22,51-14.53,0-27.47-7.78-35.75-19.83l-3.34,2.18c9,13.15,23.17,21.65,39.09,21.65,27.14,0,49.22-24.68,49.22-55C98.41,80.14,77.2,55.86,50.79,54.92Z" transform="translate(-0.04 -28.21)"/></svg>
						</a>

				</div>

			<!--<div class="menu-icon" onmousedown="bleep.play()">-->
				<div class="menu-icon">
	<span class="menu-icon__line menu-icon__line-left"></span>
	<span class="menu-icon__line"></span>
	<span class="menu-icon__line menu-icon__line-right"></span>
</div>



				<div class="header-titles-wrapper" style="display:block;">

					<?php

					// Check whether the header search is activated in the customizer.
					$enable_header_search = get_theme_mod( 'enable_header_search', true );

					if ( true === $enable_header_search ) {

						?>

						<button class="toggle search-toggle mobile-search-toggle searchbtn" data-toggle-target=".search-modal" data-toggle-body-class="showing-search-modal" data-set-focus=".search-modal .search-field" aria-expanded="false">
							<span class="toggle-inner">
								<span class="toggle-icon">
									<?php twentytwenty_the_theme_svg( 'search' ); ?>
								</span>
								<span class="toggle-text"><?php _ex( 'Search', 'toggle text', 'twentytwenty' ); ?></span>
							</span>
						</button><!-- .search-toggle -->

					<?php } ?>

					<div class="header-titles">

						<?php
							// Site title or logo.
							twentytwenty_site_logo();

							// Site description.
							twentytwenty_site_description();
						?>

					</div><!-- .header-titles -->

					<button class="toggle nav-toggle mobile-nav-toggle" data-toggle-target=".menu-modal"  data-toggle-body-class="showing-menu-modal" aria-expanded="false" data-set-focus=".close-nav-toggle">
						<span class="toggle-inner">
							<span class="toggle-icon">
								<?php twentytwenty_the_theme_svg( 'ellipsis' ); ?>
							</span>
							<span class="toggle-text"><?php _e( 'Menu', 'twentytwenty' ); ?></span>
						</span>
					</button><!-- .nav-toggle -->

				</div><!-- .header-titles-wrapper -->

				<div class="header-navigation-wrapper" style="display:none;">

					<?php
					if ( has_nav_menu( 'primary' ) || ! has_nav_menu( 'expanded' ) ) {
						?>

							<nav class="primary-menu-wrapper" aria-label="<?php echo esc_attr_x( 'Horizontal', 'menu', 'twentytwenty' ); ?>" role="navigation">

								<ul class="primary-menu reset-list-style">

								<?php
								if ( has_nav_menu( 'primary' ) ) {

									wp_nav_menu(
										array(
											'container'  => '',
											'items_wrap' => '%3$s',
											'theme_location' => 'primary',
										)
									);

								} elseif ( ! has_nav_menu( 'expanded' ) ) {

									wp_list_pages(
										array(
											'match_menu_classes' => true,
											'show_sub_menu_icons' => true,
											'title_li' => false,
											'walker'   => new TwentyTwenty_Walker_Page(),
										)
									);

								}
								?>

								</ul>

							</nav><!-- .primary-menu-wrapper -->

						<?php
					}

					if ( true === $enable_header_search || has_nav_menu( 'expanded' ) ) {
						?>

						<div class="header-toggles hide-no-js">

						<?php
						if ( has_nav_menu( 'expanded' ) ) {
							?>

							<div class="toggle-wrapper nav-toggle-wrapper has-expanded-menu">

								<button onmousedown="bleep.play()" class="toggle nav-toggle desktop-nav-toggle" data-toggle-target=".menu-modal" data-toggle-body-class="showing-menu-modal" aria-expanded="false" data-set-focus=".close-nav-toggle">
									<span class="toggle-inner">
										<span class="toggle-text"><?php _e( 'Menu', 'twentytwenty' ); ?></span>
										<span class="toggle-icon">
											<span class="lineone"></span>
										  	<span class="lineone linetwo"></span>
										  	<span class="lineone linethree"></span>
										</span>
									</span>
								</button><!-- .nav-toggle -->

							</div><!-- .nav-toggle-wrapper -->

							<?php
						}

						if ( true === $enable_header_search ) {
							?>

							<div class="toggle-wrapper search-toggle-wrapper">

								<button class="toggle search-toggle desktop-search-toggle" data-toggle-target=".search-modal" data-toggle-body-class="showing-search-modal" data-set-focus=".search-modal .search-field" aria-expanded="false">
									<span class="toggle-inner">
										<?php twentytwenty_the_theme_svg( 'search' ); ?>
										<span class="toggle-text"><?php _ex( 'Search', 'toggle text', 'twentytwenty' ); ?></span>
									</span>
								</button><!-- .search-toggle -->

							</div>

							<?php
						}
						?>

						</div><!-- .header-toggles -->
						<?php
					}
					?>

				</div><!-- .header-navigation-wrapper -->

			</div><!-- .header-inner -->

			
				
			</div>

		</header><!-- #site-header -->
		
		<div class="nav">
	<div class="nav__content">
		<ul class="nav__list">
			<li class="nav__list-item"><a href="/">Home</a></li>
			<li class="nav__list-item"><a href="/about-us">About</a></li>
			<li class="nav__list-item"><a href="/blog">Blog</a></li>
			<li class="nav__list-item"><a href="/self-help-recommendations">Self-Help Recommendations</a></li>
			<li class="nav__list-item"><a href="/podcasts">Podcast</a></li>
			<li class="nav__list-item"><a href="/news-and-journalism">News</a></li>
			<li class="nav__list-item"><a href="/contact-us">Contact</a></li>
		</ul>
	</div>
</div>

			<?php
			// Output the search modal (if it is activated in the customizer).
			if ( true === $enable_header_search ) {
				get_template_part( 'template-parts/modal-search' );
			}
			?>


		<?php
		// Output the menu modal.
		get_template_part( 'template-parts/modal-menu' );
